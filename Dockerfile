#syntax=docker/dockerfile:1.4

# The different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target

FROM php:8.5-fpm-alpine AS app_php

WORKDIR /srv

RUN apk add --no-cache libstdc++ libgcc

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# persistent / runtime deps
RUN apk add --no-cache \
		git \
		make \
		openssh \
		zip libzip-dev \
		wget gnupg \
		libpng-dev libwebp-dev \
	;

RUN set -eux; \
	install-php-extensions \
		intl \
		zip \
		apcu \
		opcache \
		gd \
		exif \
		ftp \
		curl \
		bcmath \
		soap  \
		xsl \
		imagick \
		sysvsem \
		calendar \
	;

COPY --from=node:24-alpine /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:24-alpine /usr/local/include/node /usr/local/include/node
COPY --from=node:24-alpine /usr/local/share/man/man1/node.1 /usr/local/share/man/man1/node.1
COPY --from=node:24-alpine /usr/local/share/doc/node /usr/local/share/doc/node
COPY --from=node:24-alpine /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
RUN ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

RUN npm install -g sass

# PHP configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY .docker/php/conf.d/app.ini $PHP_INI_DIR/conf.d/

# PHP-FPM configuration
COPY .docker/php/php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
RUN mkdir -p /var/run/php

# Entrypoint
COPY .docker/php/entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer/composer:2-bin /composer /usr/bin/composer

ARG COMPOSER_GITHUB_TOKEN=""
RUN set -eux; \
	if [ -n "${COMPOSER_GITHUB_TOKEN}" ]; then \
		composer config -g github-oauth.github.com "${COMPOSER_GITHUB_TOKEN}"; \
	fi

# Nginx
FROM nginx:1-alpine AS app_nginx

# Copy nginx conf
COPY .docker/nginx/*.conf /etc/nginx/
#COPY .docker/nginx/certs/*.pem /etc/nginx/ssl/
COPY .docker/nginx/templates/ /etc/nginx/templates/
