.SILENT:
.PHONY: build

include ./.make/text.mk
include ./.make/help.mk

HAS_DOCKER:=$(shell command -v docker 2> /dev/null)
# Executables (local)
DOCKER_COMP = docker compose

# Docker containers
# Check if docker is present, allow usage of this makefile inside the containers
ifdef HAS_DOCKER
	PHP_CONT = $(DOCKER_COMP) exec php
	SLIDES_CONT = $(DOCKER_COMP) exec slides
else
	PHP_CONT =
	SLIDES_CONT =
endif

# Executables
PHP = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY = $(PHP_CONT) bin/console
NPM = $(PHP_CONT) npm
NPX = $(PHP_CONT) npx

.DEFAULT_GOAL = help # make without any arguments will exec help task

###########
# Install #
###########

## Install dependencies
install: install.composer install.npm install.assets

install.npm:
	$(NPM) install

install.assets:
	$(SYMFONY) importmap:install

## Update dependencies
update: update.composer update.npm

update.composer:
	$(COMPOSER) update

update.npm:
	$(NPM) update

install@dist:
	composer install
	composer dump-env prod
	npm install
	php bin/console importmap:install

###############
# Development #
###############

## Dev - Start the whole application for development purposes (local only)
serve: clear.assets up logs
.PHONY: serve

## Dev - Build Saas files
serve.assets:
	$(SYMFONY) sass:build --watch

## Dev - Build Saas files
serve.slides:
	$(DOCKER_COMP) up --remove-orphans slides

## Clear - Clear the assets
clear.assets:
	rm -rf public/assets

## Clear - Clear the build dir and assets
clear.build: clear.assets
	rm -rf build

## Clear - Clear resized images cache
clear.images:
	rm -rf public/resized

## Clear - Clear symfony cache
clear.cache:
	$(SYMFONY) cache:clear

#########
# Build #
#########

## Build - Build assets
build.assets: export APP_ENV = prod
build.assets:
	$(SYMFONY) asset-map:compile

## Build - Build static site
build.content: export APP_ENV = prod
build.content: clear.images clear.cache
	$(SYMFONY) stenope:build

## Build - Build static site without resizing images, for moar speed
build.content.without-images: export APP_ENV = prod
build.content.without-images: clear.cache
	$(SYMFONY) stenope:build

## Build - Build static site with assets
build.static: export APP_ENV = prod
build.static: clear.cache build.assets build.content build.slides

## Build - Build slides with assets
build.slides:
	mkdir -p ./slides/images
	cp -r ./assets/images/slides/* ./slides/images/
	$(NPM) run build

build@dist: export APP_ENV = prod
build@dist:
	php bin/console cache:clear
	rm -rf public/assets
	php bin/console asset-map:compile
	rm -rf public/resized
	rm -rf build
	php bin/console stenope:build
	npm run build

########
# Lint #
########

## Lint - Lint
lint: lint.php-cs-fixer lint.phpstan lint.twig lint.yaml lint.eslint lint.container lint.composer

lint@integration: lint.php-cs-fixer@integration lint.phpstan@integration lint.twig@integration lint.yaml@integration lint.eslint@integration lint.container@integration lint.composer@integration

lint.composer:
	$(COMPOSER) validate --no-check-publish

lint.composer@integration:
	$(COMPOSER) validate --no-check-publish --ansi --no-interaction

lint.container:
	$(SYMFONY) lint:container

lint.container@integration:
	$(SYMFONY) lint:container --ansi --no-interaction

lint.php-cs-fixer:
	$(PHP) vendor/bin/php-cs-fixer fix

lint.php-cs-fixer@integration:
	$(PHP) vendor/bin/php-cs-fixer fix --dry-run --diff

lint.twig: lint.twig@integration

lint.twig@integration:
	$(SYMFONY) lint:twig templates --show-deprecations --ansi --no-interaction

lint.yaml: lint.yaml@integration

lint.yaml@integration:
	$(SYMFONY) lint:yaml config content --parse-tags --ansi --no-interaction

lint.phpstan: export APP_ENV = test
lint.phpstan:
	$(SYMFONY) cache:clear --ansi
	$(SYMFONY) cache:warmup --ansi
	$(PHP) vendor/bin/phpstan analyse --memory-limit=-1

lint.phpstan@integration: export APP_ENV = test
lint.phpstan@integration:
	$(PHP) vendor/bin/phpstan --no-progress --no-interaction analyse

lint.eslint:
	$(NPX) eslint assets --fix

lint.eslint@integration:
	$(NPX) eslint assets


## —— Docker 🐳 ————————————————————————————————————————————————————————————————
docker.build: ## Builds the Docker images
	@$(DOCKER_COMP) build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: docker.build up ## Build and start the containers

down: ## Stop the docker hub
	@$(DOCKER_COMP) down --remove-orphans

logs: ## Show live logs
	@$(DOCKER_COMP) logs --tail=0 --follow

sh: ## Connect to the FrankenPHP container
	@$(PHP_CONT) sh

bash: ## Connect to the FrankenPHP container via bash so up and down arrows go to previous commands
	@$(PHP_CONT) bash

test: ## Start tests with phpunit, pass the parameter "c=" to add options to phpunit, example: make test c="--group e2e --stop-on-failure"
	@$(eval c ?=)
	@$(PHP_CONT) php bin/phpunit $(c)

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

install.composer: ## Install Composer vendors (dev included)
install.composer: c=install --prefer-dist --no-progress --no-scripts --no-interaction
install.composer: composer

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)

cc: c=c:c ## Clear the cache
cc: sf

##########
# Deploy #
##########

## Deploy - Deploy to production server
deploy:
	$(PHP) vendor/bin/dep deploy
