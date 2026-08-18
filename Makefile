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

# D2 crée ses fichiers en 0600. Exécuté en root dans le conteneur, les SVG générés
# seraient illisibles depuis l'hôte (ni copiables, ni versionnables) : on force donc
# l'UID/GID de l'hôte. Le `$(if $(PHP_CONT),…)` garantit qu'un `PHP_CONT=` (CI,
# ou exécution depuis le conteneur) neutralise aussi ce chemin.
D2_EXEC = $(if $(PHP_CONT),$(DOCKER_COMP) exec -u $(shell id -u):$(shell id -g) php)
D2 = $(D2_EXEC) d2

# `--scale=1` désactive le « fit to screen » de D2 (défaut `--scale=-1`), qui omet
# `width`/`height` sur la racine du SVG. Sans taille intrinsèque, un SVG chargé via
# `<img>` retombe sur la taille par défaut des éléments remplacés (300×150) : les
# slides Marp affichaient le diagramme en ~100×150 px. Le dimensionnement responsive
# reste géré en CSS (`max-width`), pas par l'absence d'attributs.
D2_FLAGS_BASE = --scale=1

# Thèmes D2 : 0 = Neutral default (clair), 200 = Dark Mauve (sombre).
# Les deux palettes sont embarquées dans un seul SVG (media query), cf. build.diagrams.
# Ces flags CLI écrasent tout bloc `d2-config` présent dans les sources : le thème
# se pilote donc ici, et nulle part ailleurs.
D2_FLAGS = $(D2_FLAGS_BASE) --theme=0 --dark-theme=200

# Les slides Marp sont rendues sur fond sombre (`class: invert`) et n'ont pas de
# bascule clair/sombre : on force la palette sombre dans les deux cas.
D2_FLAGS_SLIDES = $(D2_FLAGS_BASE) --theme=200 --dark-theme=200

# Sources des diagrammes : diagrams/<chemin>.d2 -> assets/images/<chemin>.svg
D2_SOURCES := $(shell find diagrams -type f -name '*.d2' 2>/dev/null)
D2_TARGETS := $(patsubst diagrams/%.d2,assets/images/%.svg,$(D2_SOURCES))

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
	$(SYMFONY) cache:clear --env=prod

#########
# Build #
#########

## Build - Build assets
build.assets:
	$(SYMFONY) cache:clear --env=prod
	$(SYMFONY) asset-map:compile --env=prod
	cp -r assets/images/ build/

## Build - Build static site
build.content: clear.images clear.cache
	$(SYMFONY) stenope:build --env=prod

## Build - Build static site without resizing images, for moar speed
build.content.without-images: clear.cache
	$(SYMFONY) stenope:build --env=prod

## Build - Render D2 diagram sources to SVG (incremental: only changed sources)
build.diagrams: $(D2_TARGETS)
.PHONY: build.diagrams

# `d2` écrit sa cible en place : tué en cours d'écriture (OOM, conteneur arrêté,
# disque plein), il laisserait un SVG tronqué avec un mtime frais, que le rendu
# incrémental considérerait à jour. Les SVG étant versionnés et régénérés à la
# main, ce fichier corrompu partirait en commit. On demande donc à make de
# supprimer toute cible dont la recette a échoué.
.DELETE_ON_ERROR:

# Le Makefile est prérequis des deux règles : il porte les flags D2 (thème,
# échelle), donc en changer doit suffire à déclencher un nouveau rendu. Sans
# cette dépendance, `make build.diagrams` ne verrait que des sources inchangées
# et laisserait les SVG de l'ancienne palette en place, sans rien signaler.

# Règle plus spécifique (stem plus court) : GNU Make la préfère pour les slides.
assets/images/slides/%.svg: diagrams/slides/%.d2 Makefile
	mkdir -p $(dir $@)
	$(D2) $(D2_FLAGS_SLIDES) $< $@
	chmod 644 $@

assets/images/%.svg: diagrams/%.d2 Makefile
	mkdir -p $(dir $@)
	$(D2) $(D2_FLAGS) $< $@
	chmod 644 $@

## Build - Build static site with assets
build.static: clear.cache build.diagrams build.assets build.content build.slides

## Build - Build slides with assets
build.slides:
	mkdir -p ./slides/images
	cp -r ./assets/images/slides/* ./slides/images/
	$(NPM) run build

build@dist:
	php bin/console cache:clear --env=prod
	rm -rf public/assets
	php bin/console asset-map:compile --env=prod
	rm -rf public/resized
	rm -rf build
	php bin/console stenope:build --env=prod
	npm run build
	cp -r assets/images/ build/

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

lint.phpstan:
	$(SYMFONY) cache:clear --ansi --env=test
	$(SYMFONY) cache:warmup --ansi --env=test
	$(PHP) vendor/bin/phpstan analyse --memory-limit=-1

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
