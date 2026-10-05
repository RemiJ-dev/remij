# RémiJ

Blog personnel et site statique généré avec [Stenope](https://stenopephp.github.io/Stenope/) (Symfony 8).

**Stack :** PHP 8.5, Symfony 8.1, Stenope, Symfony AssetMapper, Sass, Turbo/Stimulus, Docker (nginx + PHP-FPM).

## Prérequis

- [Docker](https://docs.docker.com/get-docker/) et Docker Compose
- `make`
- [mkcert](https://github.com/FiloSottile/mkcert#installation) — recommandé, pour un certificat HTTPS reconnu par le navigateur
  (sans lui, le site démarre avec un certificat auto-signé et le navigateur affiche un avertissement).
  Sur Ubuntu (20.04 et plus), il est dans les dépôts `universe` :

  ```shell
  sudo apt update
  sudo apt install mkcert libnss3-tools   # libnss3-tools (certutil) : pour que Firefox et Chrome reconnaissent l'autorité
  mkcert -version                         # vérification
  ```

  Pas besoin de lancer `mkcert -install` à la main : `make certs` s'en charge. Redémarre ensuite le navigateur pour
  qu'il prenne en compte la nouvelle autorité.

PHP, Composer, Node et Sass tournent dans les conteneurs Docker, avec ton utilisateur (pas root) : les fichiers qu'ils
créent dans le projet t'appartiennent.

Pour installer Font Awesome Pro, crée un fichier `.env.docker.local` (non versionné) avec le jeton du registre npm :

```dotenv
FONTAWESOME_PACKAGE_TOKEN=xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
```

## Installation

```shell
make setup          # Construit les images, démarre la stack, installe node_modules et vendor (repart de zéro)
make certs          # Une fois : certificat HTTPS localhost via mkcert
```

> Tu viens d'une version où les conteneurs tournaient en root ? `make perms` te rend la propriété des fichiers
> du projet (`vendor/`, `node_modules/`, `var/`…).

## Au quotidien

```shell
make update         # Après un pull ou un changement de branche : rebuild + start + npm/install + vendor
make start/daemon   # Démarre la stack en arrière-plan (make start : au premier plan, avec les logs)
make assets/watch   # Watcher Sass (second terminal)
make slides/start   # Serveur Marp slides
make logs s=php     # Suivre les logs (tous les services sans s=)
make stop           # Arrête la stack
```

`make` sans argument affiche toutes les commandes.

### Accès aux services

| Service     | URL                    |
|-------------|------------------------|
| Site        | https://localhost      |
| Mailpit     | http://localhost:8025  |
| Slides Marp | http://localhost:8080  |

### Commandes utiles

```shell
make php                 # Shell dans le conteneur php (make sh s=<service> pour un autre)
make sf c="…"            # Commande Symfony console (ex: make sf c=about)
make cc                  # Vide le cache Symfony
make composer c="…"      # Commande Composer (ex: make composer c='req monolog')
make npm c="…"           # Commande npm (ex: make npm c='install -D bootstrap')
```

### Docker

```shell
make build / rebuild     # Construit les images (rebuild : sans cache)
make stop                # Niveau 1 : arrête les conteneurs
make down                # Niveau 2 : + supprime conteneurs et réseau
make downv               # Niveau 3 : + supprime les volumes
make uninstall           # Niveau 4 : + supprime les images
```

## Qualité

```shell
make tests                    # Toute la suite, sans modifier de fichier
make phpcs / make eslint      # Corrige le style PHP / JS (variantes *-check : sans modifier)
make phpstan                  # PHPStan niveau max
make lint                     # Twig, YAML (config + contenu), container
make phpunit c="--testdox"    # Tests PHPUnit, options via c=
make check_php_dependencies   # composer audit
```

## Build

```shell
make site/build          # Build complet : assets + contenu + slides
make site/assets         # Compile les assets (production)
make site/content        # Génère le site statique (recalcule les images redimensionnées)
make site/content-fast   # Idem, en gardant les images redimensionnées
make slides/build        # Compile les slides Marp
make site/clear          # Supprime build/ et public/assets/
make site/clear-images   # Supprime public/resized/ (cache Glide)
```

## Déploiement

Automatique après les tests sur `main` (GitHub Actions + Deployer). À la main :

```shell
make deploy/prod
make unlock/prod         # Si un déploiement interrompu a laissé le verrou
```
