# RémiJ

Blog personnel et site statique généré avec [Stenope](https://stenopephp.github.io/Stenope/) (Symfony 8 + FrankenPHP).

**Stack :** PHP 8.5, Symfony 8.1, Stenope, Symfony AssetMapper, Sass, Turbo/Stimulus, Docker/FrankenPHP.

## Prérequis

- [Docker](https://docs.docker.com/get-docker/) et Docker Compose
- `make`

C'est tout. PHP, Composer, Node et Sass tournent dans le conteneur Docker.

## Installation

```shell
make install
```

## Développement

```shell
make serve          # Lance FrankenPHP en arrière-plan → https://localhost
make serve.assets   # Watcher Sass (second terminal)
make logs           # Suivre les logs FrankenPHP
make serve.slides   # Serveur Marp slides → http://localhost:8080
```

> Après un changement de `Dockerfile`, utiliser `make start` à la place de `make serve` pour forcer le rebuild de l'image.

### Accès aux services

| Service     | URL                       |
|-------------|---------------------------|
| Site        | https://localhost         |
| Mailpit     | http://localhost:8025     |
| Slides Marp | http://localhost:8080     |

### Commandes utiles

```shell
make sh             # Shell dans le conteneur php
make sf c="…"       # Commande Symfony console (ex: make sf c=about)
make composer c="…" # Commande Composer (ex: make composer c='req monolog')
make test           # Tests PHPUnit
make test c="--testdox"  # Tests avec options
```

## Lint & qualité

```shell
make lint                  # Tous les linters
make lint.php-cs-fixer     # PHP CS Fixer (auto-fix)
make lint.phpstan          # PHPStan niveau max
make lint.twig             # Lint templates Twig
make lint.yaml             # Lint YAML (config + contenu)
make lint.eslint           # ESLint (auto-fix)
```

## Build

```shell
make build.assets  # Compile les assets (production)
make build.content # Génère le site statique
make build.static  # Build complet : assets + contenu + slides
make build.slides  # Compile les slides Marp
```

Servir le site statique généré :

```shell
make serve.static
```

## Cache

```shell
make clear.cache   # Vide le cache Symfony
make clear.assets  # Supprime public/assets/
make clear.build   # Supprime build/ et public/assets/
make clear.images  # Supprime public/resized/ (cache Glide)
```
