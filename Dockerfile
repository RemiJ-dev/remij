#syntax=docker/dockerfile:1

# Versions
FROM dunglas/frankenphp:1-php8.5 AS frankenphp_upstream

# The different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/build/building/multi-stage/#stop-at-a-specific-build-stage
# https://docs.docker.com/reference/compose-file/build/#target


# Base FrankenPHP image
FROM frankenphp_upstream AS frankenphp_base

SHELL ["/bin/bash", "-euxo", "pipefail", "-c"]

WORKDIR /app

# persistent deps
# hadolint ignore=DL3008
RUN <<-EOF
	apt-get update
	apt-get install -y --no-install-recommends \
		file \
		git \
		make
	install-php-extensions \
		@composer \
		apcu \
		intl \
		opcache \
		zip
	rm -rf /var/lib/apt/lists/*
EOF

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

ENV PHP_INI_SCAN_DIR=":$PHP_INI_DIR/app.conf.d"

###> recipes ###
###< recipes ###

COPY --link frankenphp/conf.d/10-app.ini $PHP_INI_DIR/app.conf.d/
COPY --link --chmod=755 frankenphp/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
COPY --link frankenphp/Caddyfile /etc/frankenphp/Caddyfile

ENTRYPOINT ["docker-entrypoint"]

HEALTHCHECK --start-period=60s CMD php -r 'exit(false === @file_get_contents("http://localhost:2019/metrics", context: stream_context_create(["http" => ["timeout" => 5]])) ? 1 : 0);'
CMD [ "frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile" ]

# Dev FrankenPHP image
FROM frankenphp_base AS frankenphp_dev

ENV APP_ENV=dev
ENV XDEBUG_MODE=off
ENV FRANKENPHP_WORKER_CONFIG=watch

# dev dependencies
# hadolint ignore=DL3008
RUN <<-EOF
	mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
	apt-get update
	apt-get install -y --no-install-recommends \
		aggregate \
		curl \
		dnsmasq \
		dnsutils \
		iproute2 \
		ipset \
		iptables \
		jq \
		sudo
	install-php-extensions xdebug
	rm -rf /var/lib/apt/lists/*
	useradd -m -s /bin/bash nonroot
	echo "nonroot ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/nonroot
	git config --system --add safe.directory /app
EOF

COPY --from=node:24-bookworm-slim /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:24-bookworm-slim /usr/local/include/node /usr/local/include/node
COPY --from=node:24-bookworm-slim /usr/local/share/man/man1/node.1 /usr/local/share/man/man1/node.1
COPY --from=node:24-bookworm-slim /usr/local/share/doc/node /usr/local/share/doc/node
COPY --from=node:24-bookworm-slim /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
	&& ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx \
	&& npm install -g sass


COPY --link frankenphp/conf.d/20-app.dev.ini $PHP_INI_DIR/app.conf.d/

CMD [ "frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile", "--watch" ]

