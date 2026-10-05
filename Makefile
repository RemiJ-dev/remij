HAS_DOCKER:=$(shell command -v docker 2> /dev/null)
# Executables (local)
DOCKER_COMP = docker compose

# Host user: the containers run with it (see compose.yaml), so the files they write belong to you, not root
export UID := $(shell id -u)
export GID := $(shell id -g)

# Docker containers
# Check if docker is present, allow usage of this makefile inside the containers
# (and in CI: `make <target> HAS_DOCKER=` forces the direct, non-container path)
ifdef HAS_DOCKER
	PHP_CONT = $(DOCKER_COMP) exec php
	NODE_CONT = $(DOCKER_COMP) run --rm assets
else
	PHP_CONT =
	NODE_CONT =
endif

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP_CONT) bin/console
NPM      = $(NODE_CONT) npm
NPX      = $(NODE_CONT) npx

.DEFAULT_GOAL = help

##  ✩  First step if you are new: Setup the project
##     If the project is already installed, it will be entirely destroy and rebuild from scratch
##
setup: ## Setup all the project for dev: docker hub, node_modules, vendor, assets
setup: downv build start/daemon certs npm/install vendor
.PHONY: setup

##
## ✩✩  Update the project (no need if you just setup)
##     This is the every day command to update the project installation on current sources (after pull or branch switch for ex.)
##
update: ## Same as setup but without destroying things that exist, idem potent
update: build start/daemon npm/install vendor
.PHONY: update

# tasks used by Deployer on the server, see ./deploy.yaml
install@dist:
	npm install
	composer install
	composer dump-env prod
	php bin/console importmap:install
.PHONY: install@dist

build@dist:
	php bin/console cache:clear --env=prod
	rm -rf public/assets
	php bin/console asset-map:compile --env=prod
	rm -rf public/resized
	rm -rf build
	php bin/console stenope:build --env=prod
	npm run build
	cp -r assets/images/ build/
.PHONY: build@dist

##
## ✩✩✩ Start the docker hub the way you left it
##     make stop, to stop the hub
##
start: ## Start the docker hub
	$(DOCKER_COMP) up --remove-orphans
.PHONY: start

start/daemon: ## Start the docker hub in detached mode (no logs displayed)
	$(DOCKER_COMP) up -d --remove-orphans
.PHONY: start/daemon

##
## —— 🐳 Docker ——————————————————————————————————————————————————————————
##
build: ## Builds the Docker images (with cache if any)
	$(DOCKER_COMP) build --pull
.PHONY: build

rebuild: ## Builds the Docker images from scratch without cache
	$(DOCKER_COMP) build --pull --no-cache
.PHONY: rebuild

stop: ## Level 1. Stop the docker hub without touching anything
	$(DOCKER_COMP) stop
.PHONY: stop

down: ## Level 2. + destroy containers and networking
	$(DOCKER_COMP) down --remove-orphans
.PHONY: down

downv: ## Level 3. + destroy all volumes.
	$(DOCKER_COMP) down --remove-orphans --volumes
.PHONY: downv

uninstall: ## Level 4. + remove project docker images
	$(DOCKER_COMP) down --remove-orphans --volumes --rmi all
.PHONY: uninstall

logs: ## Show live logs, pass the parameter "s=" to select the service, example: make logs s=nginx
	@$(eval s ?=)
	$(DOCKER_COMP) logs --tail=100 --follow $(s)
.PHONY: logs

sh: ## Connect to a container, pass the parameter "s=" to select the service, example: make sh s=nginx
	@$(eval s ?=)
	$(DOCKER_COMP) exec $(s) sh
.PHONY: sh

php: ## Short cut to connect to the php container, equivalent to make sh s=php
php: s=php
php: sh
.PHONY: php

certs: ## Generate a localhost HTTPS certificate trusted by the browser (needs mkcert on the host, see README), then restart nginx
	@command -v mkcert > /dev/null || { echo "mkcert is not installed, see https://github.com/FiloSottile/mkcert#installation"; exit 1; }
	mkcert -install
	rm -f docker/nginx/certs/localhost.pem docker/nginx/certs/localhost-key.pem
	mkcert -cert-file docker/nginx/certs/localhost.pem -key-file docker/nginx/certs/localhost-key.pem localhost 127.0.0.1 ::1
	$(DOCKER_COMP) restart nginx
.PHONY: certs

perms: ## Give back to the host user the project files owned by another user (left by containers that ran as root)
	$(DOCKER_COMP) run --rm --no-deps --user root --entrypoint find php /srv ! -user $(UID) -exec chown $(UID):$(GID) {} +
.PHONY: perms

##
## —— 🧙 Composer ——————————————————————————————————————————————————————————
##
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)
.PHONY: composer

vendor: ## Install vendors according to the current composer.lock file for a dev environment (needs node_modules: auto-scripts run sass:build)
vendor: c=install --prefer-dist --no-interaction
vendor: composer
.PHONY: vendor

##
## —— 🎵 Symfony ——————————————————————————————————————————————————————————
##
sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)
.PHONY: sf

cc: c=cache:clear ## Clear the cache
cc: sf
.PHONY: cc

##
## —— 🧶 Front ——————————————————————————————————————————————————————————
##
node: ## Start a temporary node container and connect to it
	$(NODE_CONT) sh
.PHONY: node

npm: ## Run npm, pass the parameter "c=" to run a given command, example: make npm c='install -D bootstrap'
	@$(eval c ?=)
	@$(NPM) $(c)
.PHONY: npm

npm/install: ## npm install
	$(NPM) install --no-audit
.PHONY: npm/install

assets/install: ## Download the importmap vendor assets
	$(SYMFONY) importmap:install
.PHONY: assets/install

assets/watch: ## Watch and build Sass files for dev
	$(SYMFONY) sass:build --watch
.PHONY: assets/watch

assets/clear: ## Remove the compiled assets (public/assets/)
	rm -rf public/assets
.PHONY: assets/clear

slides/start: ## Start the Marp slides watch server (http://localhost:8080)
	$(DOCKER_COMP) up slides
.PHONY: slides/start

slides/build: ## Build Marp slides with their images
	mkdir -p ./slides/images
	cp -r ./assets/images/slides/* ./slides/images/
	$(NPM) run build
.PHONY: slides/build

##
## —— 📰 Static site ——————————————————————————————————————————————————————
##
site/build: ## Full production build: assets + content + slides
site/build: site/assets site/content slides/build
.PHONY: site/build

site/assets: ## Build assets for prod
	$(SYMFONY) cache:clear --env=prod
	$(SYMFONY) asset-map:compile --env=prod
	cp -r assets/images/ build/
.PHONY: site/assets

site/content: ## Build static site (clears resized images, so they are all rebuilt)
site/content: site/clear-images
	$(SYMFONY) cache:clear --env=prod
	$(SYMFONY) stenope:build --env=prod
.PHONY: site/content

site/content-fast: ## Build static site keeping resized images, for moar speed
	$(SYMFONY) cache:clear --env=prod
	$(SYMFONY) stenope:build --env=prod
.PHONY: site/content-fast

site/clear: ## Remove the build dir and the compiled assets
site/clear: assets/clear
	rm -rf build
.PHONY: site/clear

site/clear-images: ## Remove resized images cache (public/resized/)
	rm -rf public/resized
.PHONY: site/clear-images

##
## —— 🐛 Tests ——————————————————————————————————————————————————————————
##
tests: ## Run the full test suite, without modifying any file
tests: phpcs-check phpstan lint eslint-check phpunit check_composer
.PHONY: tests

phpcs: ## Run PHP CS fixer (config file ./.php-cs-fixer.dist.php)
	$(PHP) vendor/bin/php-cs-fixer fix
.PHONY: phpcs

phpcs-check: ## Run PHP CS fixer without modifying the files (config file ./.php-cs-fixer.dist.php)
	$(PHP) vendor/bin/php-cs-fixer fix --dry-run --diff
.PHONY: phpcs-check

phpstan: ## Run phpstan on a fresh test container (config file ./phpstan.dist.neon)
	$(SYMFONY) cache:clear --env=test
	$(SYMFONY) cache:warmup --env=test
	$(PHP) vendor/bin/phpstan analyse --memory-limit=-1
.PHONY: phpstan

phpunit: ## Run the whole phpunit test suite, pass options with c=: make phpunit c="--filter MyTest"
	@$(eval c ?=)
	$(PHP) bin/phpunit $(c)
.PHONY: phpunit

eslint: ## Run ESLint on assets and fix what can be fixed
	$(NPX) eslint assets --fix
.PHONY: eslint

eslint-check: ## Run ESLint on assets without modifying the files
	$(NPX) eslint assets
.PHONY: eslint-check

lint: ## Check the syntax of Twig templates, yaml files (config + content) and the container
	$(SYMFONY) lint:twig templates --show-deprecations
	$(SYMFONY) lint:yaml config content --parse-tags
	$(SYMFONY) lint:container
.PHONY: lint

check_composer: ## Check the composer.json file
	$(COMPOSER) validate --no-check-publish
.PHONY: check_composer

check_php_dependencies: ## Check if php dependencies have known vulnerabilities
	$(COMPOSER) audit
.PHONY: check_php_dependencies

##
## —— 🚀 Deployments ———————————————————————————————————————————————————
##
deploy/prod: ## Deploy to the production server (Deployer, see ./deploy.yaml)
	$(PHP) vendor/bin/dep deploy
.PHONY: deploy/prod

unlock/prod: ## Unlock deployment (prod)
	$(PHP) vendor/bin/dep deploy:unlock
.PHONY: unlock/prod

## —————————————————————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m %-25s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m ##/[33m/' && echo ""
.PHONY: help
