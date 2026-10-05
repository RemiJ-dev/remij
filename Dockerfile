#syntax=docker/dockerfile:1.4

# The different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target

FROM php:8.5-fpm-alpine AS app_php

WORKDIR /srv

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# persistent / runtime deps
RUN apk add --no-cache \
		git \
		make \
		openssh \
	;

RUN set -eux; \
	install-php-extensions \
		intl \
		zip \
		apcu \
		opcache \
		gd \
		imagick \
		exif \
		ftp \
		curl \
	;

# Dart Sass (musl build), found on the PATH by symfonycasts/sass-bundle (search_for_binary):
# the bundle then never uses var/dart-sass/, which may hold a glibc build downloaded from elsewhere
ARG DART_SASS_VERSION=1.105.1
ARG TARGETARCH
RUN set -eux; \
	case "${TARGETARCH:-amd64}" in \
		amd64) arch=x64 ;; \
		arm64) arch=arm64 ;; \
		*) echo "Unsupported architecture: ${TARGETARCH}" >&2; exit 1 ;; \
	esac; \
	wget -qO- "https://github.com/sass/dart-sass/releases/download/${DART_SASS_VERSION}/dart-sass-${DART_SASS_VERSION}-linux-${arch}-musl.tar.gz" \
		| tar -xz -C /opt; \
	/opt/dart-sass/sass --version
ENV PATH="/opt/dart-sass:${PATH}"

# Node binary only (npm runs in the "assets" service): Stenope's Prism highlighter runs `node` from PHP
RUN apk add --no-cache libstdc++
COPY --from=node:24-alpine /usr/local/bin/node /usr/local/bin/node

# PHP configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY docker/php/conf.d/app.ini $PHP_INI_DIR/conf.d/

# PHP-FPM configuration
COPY docker/php/php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Entrypoint
COPY docker/php/entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

COPY --from=composer/composer:2-bin /composer /usr/bin/composer

# The project is bind-mounted: git refuses to work in a directory owned by another user
RUN git config --system --add safe.directory /srv

# Host user: the container runs with the host UID/GID (passed by the Makefile),
# so that files written in the bind-mounted project belong to the host user, not root
ARG UID=1000
ARG GID=1000
RUN set -eux; \
	group="$(getent group "${GID}" | cut -d: -f1)"; \
	if [ -z "${group}" ]; then \
		group=app; \
		addgroup -g "${GID}" "${group}"; \
	fi; \
	adduser -D -u "${UID}" -G "${group}" -h /home/app -s /bin/sh app; \
	mkdir -p /var/run/php /home/app/.composer /home/app/.ssh; \
	chown -R "${UID}:${GID}" /var/run/php /home/app

ENV COMPOSER_HOME=/home/app/.composer
ENV PATH="${PATH}:/home/app/.composer/vendor/bin"

USER app

ARG COMPOSER_GITHUB_TOKEN=""
RUN set -eux; \
	if [ -n "${COMPOSER_GITHUB_TOKEN}" ]; then \
		composer config -g github-oauth.github.com "${COMPOSER_GITHUB_TOKEN}"; \
	fi

# Nginx
FROM nginx:1-alpine AS app_nginx

# openssl: self-signed certificate fallback for HTTPS, see docker/nginx/docker-entrypoint.d/
RUN apk add --no-cache openssl

# Copy nginx conf
COPY docker/nginx/*.conf /etc/nginx/
COPY docker/nginx/templates/ /etc/nginx/templates/
COPY --chmod=755 docker/nginx/docker-entrypoint.d/ /docker-entrypoint.d/
