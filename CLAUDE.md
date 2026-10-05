# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is **RémiJ** — a personal blog and static website built with [Stenope](https://stenopephp.github.io/Stenope/) (a Symfony-based static site generator). The site is a French-language PHP/Symfony developer blog. Content is written in Markdown and compiled into a static site.

**Stack:** PHP 8.5, Symfony 8.0, Stenope (fork RemiJ-dev/Stenope, branche `update-to-sf-80-php-85`), Symfony AssetMapper, Sass, Turbo/Stimulus. Dev environment runs in **Docker: nginx + PHP-FPM (Alpine)** (see [Docker development environment](#docker-development-environment)).

## Commands

The `Makefile` is the single entry point and is **Docker-aware**: when the `docker` binary is detected on the host, every PHP/Composer/Symfony command runs inside the `php` container (`docker compose exec php …`) and every npm/npx command in a throwaway `assets` container (`docker compose run --rm assets …`). When `docker` is absent — inside a container, or with `HAS_DOCKER=` (GitHub Actions) — the same targets run the binaries directly. Always drive the project through `make`, not the `symfony` CLI. `make` (no argument) prints the help.

Naming follows the Wid project's Makefile: `/`-namespaced targets (`npm/install`, `site/build`…), `c=` to pass arguments (`make sf c=about`, `make phpunit c="--testdox"`), `s=` to pick a service (`make logs s=nginx`).

### Setup & everyday
```shell
make setup            # From scratch (destroys containers AND volumes): build, start, npm/install, vendor
make update           # Every day (after a pull / branch switch): same without destroying anything, idempotent
make certs            # Once: trusted HTTPS certificate for localhost (needs mkcert on the host)
make perms            # Once: give back to you files left owned by root (containers used to run as root)
```

### Docker
```shell
make start            # Start the stack in the foreground (logs) — make start/daemon: detached
make build            # Build images (with cache) — make rebuild: without cache
make stop / down / downv / uninstall   # Levels 1→4: stop, + containers, + volumes, + images
make logs s=php       # Follow logs (all services without s=)
make php              # Shell in the php container (make sh s=<service> for another one)
make node             # Shell in a throwaway node container
```

### Development
```shell
make assets/watch     # Watch & compile Sass (bin/console sass:build --watch, php container)
make assets/install   # importmap:install
make slides/start     # Marp slides watch server (http://localhost:8080)
make sf c="…"         # Symfony console — make cc: cache:clear
make composer c="…"   # Composer — make vendor: composer install
make npm c="…"        # npm (assets container) — make npm/install: npm install
```

### Build (static site)
```shell
make site/build              # Full production build: assets + content + slides
make site/assets             # Compile assets for production
make site/content            # Build static site (APP_ENV=prod, clears resized images)
make site/content-fast       # Same, keeps resized images
make slides/build            # Copy slide images, then compile Marp slides
make site/clear              # Remove build/ and public/assets/ — site/clear-images: public/resized/ (Glide cache)
```

### Quality
```shell
make tests                   # Everything, without modifying any file: phpcs-check phpstan lint eslint-check phpunit check_composer
make phpcs / make eslint     # Fix code style (PHP / JS) — *-check variants: dry-run
make phpstan                 # Static analysis (level max), on a freshly warmed test container
make lint                    # lint:twig + lint:yaml (config + content) + lint:container
make phpunit c="--testdox"   # PHPUnit, options via c=
make check_php_dependencies  # composer audit
```

## Docker development environment

The dev environment is fully containerized via Docker Compose — no host PHP, Node or `symfony` CLI required. Host dependencies: Docker + Compose, `make`, and optionally [mkcert](https://github.com/FiloSottile/mkcert) for a trusted HTTPS certificate.

**`compose.yaml` / `compose.override.yaml` services:**
- **`php`** — `app_php` Dockerfile stage (`php:8.5-fpm-alpine`); project bind-mounted at `/srv`; PHP-FPM listens on a unix socket shared with nginx through the `php-socket` volume. Also mounts `~/.ssh` and the SSH agent socket (for `deploy/prod`) and a `composercache` volume. All PHP CLI commands run here.
- **`nginx`** — `app_nginx` stage (`nginx:1-alpine`); serves `public/` (read-only mount) and passes `index.php` to PHP-FPM. Port 80 redirects (302) to 443. Site on **https://localhost**.
- **`assets`** — `node:24-alpine`, profile `node` (never started by `up`): used by `make` through `docker compose run --rm assets` for npm/npx (install, ESLint, Marp build).
- **`slides`** — `marpteam/marp-cli`; Marp watch server on **http://localhost:8080** (`make slides/start`).
- **`mailpit`** — catches the mails sent in dev: **http://localhost:8025**.

**Host user, not root:** `php`, `assets` and `slides` run with the host UID/GID, so everything they write in the bind-mounted project (`vendor/`, `node_modules/`, `var/`…) belongs to the host user. The `Makefile` exports `UID`/`GID` (`id -u`/`id -g`); `compose.yaml` passes them as build args to the `php` image (user `app`, home `/home/app`), as `user:` to `assets` and as `MARP_USER` to `slides`. Without `make` (raw `docker compose`), they default to 1000. **After a UID change, rebuild** (`make build`) — and if `php-socket`/`composercache` were created by another user, remove them (`docker volume rm remij_php-socket remij_composercache`). nginx keeps its own users (it only reads `public/`).

**HTTPS:** nginx reads `docker/nginx/certs/localhost.pem` + `localhost-key.pem` (bind-mounted, `*.pem` gitignored). `make certs` creates them with mkcert on the host (`mkcert -install` puts its CA in the host trust stores — that host step is why mkcert is not run inside Docker: a CA installed in a container is trusted by nobody). Without them, `docker/nginx/docker-entrypoint.d/40-ssl-certificate.sh` generates a self-signed certificate at nginx startup (browser warning) so a fresh clone still starts.

**`.env.docker.local`** (gitignored by `/.env.*.local`, optional — `required: false`) is loaded with `env_file` into `php`, `assets` and `slides`. It holds `FONTAWESOME_PACKAGE_TOKEN`, used by `.npmrc` to install Font Awesome Pro from its private registry.

**`Dockerfile`** (multi-stage):
- **`app_php`** — extensions (intl, zip, apcu, opcache, gd, imagick, exif, ftp, curl), git/make/openssh, Composer, **Dart Sass** (musl build in `/opt/dart-sass`, on the `PATH`), the **`node` binary** (copied from `node:24-alpine`, + `libstdc++`), `docker/php/` config (`conf.d/app.ini`, `php-fpm.d/zz-docker.conf`, `entrypoint.sh`), then the `app` user.
- **`app_nginx`** — `docker/nginx/` config (`nginx.conf`, `gzip.conf`, `templates/default.conf.template` rendered by envsubst at startup) + `openssl` for the self-signed fallback.

**Why `node` in the php image:** Stenope's Prism highlighter (`vendor/stenope/stenope/src/Highlighter/Prism.php`) spawns `node` from PHP. Without it, any page with a code block hangs 60 s then returns a 500 (`ProcessTimedOutException`), and `stenope:build` fails the same way. npm itself lives in the `assets` service.

**Why Dart Sass in the php image:** `symfonycasts/sass-bundle` (`search_for_binary`, default `true`) uses a `sass` found on the `PATH` before its own download in `var/dart-sass/`. That download path is fixed (`var/dart-sass/sass`) whatever the libc, and `var/` is bind-mounted: a glibc build left there (by the host or an older Debian image) does not run on Alpine (`dart: not found`). With `sass` on the `PATH`, `var/dart-sass/` is never used. Version: `DART_SASS_VERSION` build arg.

**Order `npm/install` → `vendor`:** Composer's `auto-scripts` run `sass:build`, which resolves Bootstrap from `node_modules/` (`load_path` in `symfonycasts_sass.yaml`) — same constraint in `install@dist` and `tests.yaml`.

**No auto-reload:** PHP-FPM boots a fresh kernel per request, so edited `content/**/*.md` or templates show up on a manual reload (no Stenope in-memory cache surviving between requests). Nothing pushes changes to the browser.

## Verification workflow

After any code change, always verify with:

```shell
make tests     # phpcs-check phpstan lint eslint-check phpunit check_composer — must pass
```

Use `make phpcs` / `make eslint` to fix code style. Never use `bin/phpunit` directly — always go through `make phpunit`.

## Continuous integration & deployment (GitHub Actions)

Two workflows under `.github/workflows/`, both running **without Docker**. GitHub runners ship the `docker` binary, so the Docker-aware Makefile would otherwise route through `docker compose exec php`; every `make` call in CI therefore passes **`HAS_DOCKER=`**, which empties `PHP_CONT` and `NODE_CONT` at once and forces the direct, non-container path. **When editing or adding a `make` step in a workflow, always append `HAS_DOCKER=`** — forgetting it makes the step try to exec into a non-existent container.

**`tests.yaml` (« Tests »)** — on push to `main`, pull requests, and manual dispatch. Sets up PHP 8.5 + Node 24 via `shivammathur/setup-php` and `actions/setup-node` (no Docker), installs deps, then runs the checks through the Makefile (`make phpcs-check phpstan lint eslint-check check_composer HAS_DOCKER=`, `make phpunit HAS_DOCKER=`) plus a production static-build smoke check (`sass:build` + `asset-map:compile` + `stenope:build`).

**`deploy.yaml` (« Deploy to server »)** — server deployment via Deployer, **gated on Tests**:
- Triggered by `workflow_run` when the **Tests** workflow completes on `main`; the job's `if` proceeds only when `github.event.workflow_run.conclusion == 'success'`. `workflow_dispatch` allows a manual deploy that bypasses the gate. Note: `workflow_run` only fires from the workflow file on the **default branch** — it won't trigger from a feature branch, so the gate is testable only once merged to `main`.
- The runner is only an **orchestrator**: installs Composer deps (Deployer is in `require-dev` → `vendor/bin/dep`), loads the `DEPLOY_SSH_KEY` secret into `ssh-agent` (`webfactory/ssh-agent`), trusts the server host key (`ssh-keyscan`), and runs `make deploy/prod HAS_DOCKER=` (= `php vendor/bin/dep deploy`). No assets/site are built in CI.
- The actual build happens **on the server**: Deployer's `update` task runs `make install@dist` + `make build@dist` in the new release dir. The `@dist` Makefile targets are the raw, Docker-free variants made for this.

**Deployer recipe — `deploy.yaml` at the repo root** (not to be confused with `.github/workflows/deploy.yaml`): a Deployer 7 YAML recipe importing `recipe/symfony.php`. Single host `prod` (`162.19.44.51`, user `ubuntu`, `deploy_path: /var/www/remij.dev`), clones `git@github.com:RemiJ-dev/remij.git` on `branch: main`, `forward_agent: true` (the server reuses the runner's forwarded SSH agent to clone from GitHub — so `DEPLOY_SSH_KEY`'s public half must also be a read-only **deploy key** on the GitHub repo, in addition to `ubuntu@…:~/.ssh/authorized_keys`), keeps 2 releases, and posts start/success/fail notifications to a Mattermost webhook.

**Required GitHub secret:** `DEPLOY_SSH_KEY` (private deploy key, no passphrase). `CACHE_VERSION` is also referenced by the image-cache key in `tests.yaml`.

## Architecture

### How Stenope Works

Stenope reads content files (Markdown with YAML front matter) from `content/`, deserializes them into PHP model objects, and then renders static HTML pages via Symfony controllers and Twig templates. The `ContentManagerInterface` is the main entry point for fetching content in actions.

Content types and their source directories are configured in `config/packages/stenope.yaml`:
- `App\Domain\Article\Model\Article` ← `content/articles/`
- `App\Domain\Publication\Model\Author` ← `content/authors/`
- `App\Domain\Page\Model\Page` ← `content/pages/`
- `App\Domain\Page\Model\Section` ← `content/sections/`
- `App\Domain\Tutorial\Model\Tutorial` ← `content/tutoriels/` avec `depth: '== 0'` (fichiers racine)
- `App\Domain\Tutorial\Model\Chapter` ← `content/tutoriels/` avec `depth: '>= 1'` (fichiers en sous-dossier)

**Tutoriels — deux providers sur le même dossier :** la config étendue d'un provider accepte `path`, `depth`, `patterns`, `excludes` (options du `Finder`). `Tutorial` et `Chapter` lisent tous deux `content/tutoriels/`, séparés par la profondeur. Le slug Stenope étant le chemin relatif sans extension, un chapitre a un slug `<serie>/<partie>` et retrouve sa série via `dirname(slug)` — la relation série/partie est portée par l'arborescence, sans champ de liaison dans le front matter.

### Architecture ADR

Le projet suit le pattern **Action–Domain–Responder** :

```
src/
├── Action/          ← reçoit la requête HTTP, orchestre Domain + Responder
├── Domain/          ← modèles métier, DTOs et repositories
├── Responder/       ← construit la Response HTTP (rendu Twig, headers)
└── Infrastructure/  ← adaptateurs framework (Form, Twig, Stenope)
```

**Responsabilités :**
- L'**Action** fait le minimum : récupère les données via le Repository, passe au Responder.
- Le **Responder** construit entièrement la `Response` : rendu Twig, headers (`Content-Type`, `Last-Modified`), calcul du `lastModified` via `ContentUtils`.
- Le **Domain** contient les value objects (Models, DTOs) et les Repositories.

### Domain (`src/Domain/`)

**Modèles (value objects, exclus du container Symfony) :**
- **`Domain/Article/Model/Article`** — articles de blog : `slug`, `title`, `description`, `content`, `authors[]`, `tags[]`, `publishedAt`, `image`, `lastModified`, `tableOfContent`. Implémente `PublicationInterface`, utilise `PublishableTrait`.
- **`Domain/Tutorial/Model/Tutorial`** — un tutoriel : soit une **série** (fichier racine = intro + sommaire, parties dans un sous-dossier du même nom), soit un **contenu autonome** (fichier racine seul). Mêmes champs qu'`Article` (sans `nextArticle`). Implémente `PublicationInterface`, utilise `PublishableTrait`.
- **`Domain/Tutorial/Model/Chapter`** — une partie de série : `slug` (`<serie>/<partie>`), `title`, `description`, `content`, `position` (ordre dans la série), `publishedAt`, `lastModified`, `tableOfContent`, et `getTutorialSlug()` (= `dirname(slug)`). **Pas** de tags/auteurs (hérités de la série) → n'implémente **pas** `PublicationInterface`.
- **`Domain/Publication/Model/Author`** — profils auteurs : `slug`, `name`, `avatar`, `active`, `since`. Partagé entre articles et tutoriels (anciennement dans `Domain/Article`).
- **`Domain/Publication/Model/PublicationInterface`** — contrat des contenus « listables » sur les pages transversales (tag, auteur) et dans le flux Atom : propriétés communes via **property hooks** (`public string $slug { get; }`…, satisfaites par les propriétés publiques natives), + `isPublished()`, `getLastModifiedOrCreated()`, `getType(): PublicationType`.
- **`Domain/Publication/Model/PublicationType`** — enum `Article|Tutorial` ; `getShowRoute()` donne la route de détail (`article_show`/`tutorial_show`), `->value` sert au dispatch des cartes Twig.
- **`Domain/Publication/Model/PublishableTrait`** — `isPublished()` (date future = brouillon) et `getLastModifiedOrCreated()`, partagé par `Article`, `Tutorial`, `Chapter`.
- **`Domain/Publication/DTO/FeedEntry`** — une entrée Atom uniforme (`title`, `routeName`/`routeParams`, `publishedAt`, `updated`, `authors[]` = noms résolus, `tags[]`). Named constructors : `fromPublication()` et `fromChapter()` (titre contextualisé « Série : Partie », tags/auteurs hérités de la série).
- **`Domain/Page/Model/Page`** — pages statiques génériques.
- **`Domain/Seo/Model/MetaTrait`** — champs SEO/réseaux sociaux partagés (`metaTitle`, `metaDescription`), utilisé par `Article`, `Tutorial`, `Chapter` et `Page`.
- **`Domain/Page/DTO/ContactDTO`** — DTO du formulaire de contact avec contraintes de validation (`NotBlank`, `Email`, `Length`).

**Repositories (services autowirés) :**
- **`Domain/Article/Repository/ArticleRepository`** — `findPublished()`, `findByTag(string $tag)`, `findByAuthor(Author $author)`. Wraps `ContentManagerInterface`.
- **`Domain/Tutorial/Repository/TutorialRepository`** — `findPublished()`, `findBySlug()`, `findByTag()`, `findByAuthor()`, `findChapters(Tutorial)` (**toutes** les parties, publiées ou non — le sommaire tease les parties à venir — triées par `position`), `findPublishedChapters()` (parties publiées de séries publiées). Wraps `ContentManagerInterface`.
- **`Domain/Publication/Repository/PublicationRepository`** — vue transversale : **compose** `ArticleRepository` + `TutorialRepository` + `AuthorRepository` (aucune dépendance croisée entre domaines de contenu). `findPublished()`, `findByTag()`, `findByAuthor()` (fusion triée par date décroissante, typée `list<PublicationInterface>`), `findTags()`/`findAuthors()` (agrégation « slug → date la plus récente », consommée par le sitemap), `findFeedEntries()` (articles + tutoriels + parties publiées de séries publiées, en `FeedEntry` triés).
- **`Domain/Publication/Repository/AuthorRepository`** — `findAll()`. Wraps `ContentManagerInterface`.
- **`Domain/Page/Repository/PageRepository`** — `findBySlug(string $slug)` (peut lever `ContentNotFoundException`), `findAll()`. Wraps `ContentManagerInterface`.

### Infrastructure (`src/Infrastructure/`)

- **`Infrastructure/Form/ContactType`** — Symfony Form type pour la page contact, lié à `ContactDTO`.
- **`Infrastructure/Form/Handler/ContactFormHandler`** — gère la soumission du formulaire de contact (validation + envoi).
- **`Infrastructure/Mailer/ContactMailer`** — envoie l'email de contact via Brevo.
- **`Infrastructure/Twig/MenuBuilder`** — construit le fil d'Ariane pour la requête courante. Lit `_route` et `_route_params` depuis `RequestStack`. Gère : `page_home`, `page_contact`, `page_content`, `article_list`, `article_show`, `tutorial_list`, `tutorial_show`, `tutorial_chapter`, `publication_list_by_tag`, `publication_list_by_author`. Pour `tutorial_chapter`, injecte `TutorialRepository` afin d'insérer un crumb intermédiaire « série » libellé avec le **titre** du tutoriel (flag `translate: false` dans l'item, honoré par `layout/_breadcrumb.html.twig` pour ne pas passer le titre dans `|trans`). Les routes non gérées (ex: `rss`, `seo_robots`, `seo_sitemap`) retournent uniquement l'entrée home.
- **`Infrastructure/Twig/MenuExtension`** — expose `MenuBuilder::breadcrumb()` via la fonction Twig `breadcrumb()`.
- **`Infrastructure/Stenope/Processor/AssetsProcessor`** — post-traite le HTML des articles pour résoudre les URLs d'assets locaux pour les éléments `<source>` et `<video>` via le composant Asset de Symfony.

### Hooks Planka (`hooks.remij.dev`)

Seule partie **dynamique en prod** avec `/contact` : des webhooks reçus du Planka auto-hébergé (`projet.remij.dev`), servis par PHP-FPM via le vhost nginx `hooks.remij.dev.conf` (seul `/planka/` en POST est exposé, le reste répond 404). Les routes portent `options: ['stenope' => ['ignore' => true]]` et sont POST-only : absentes du build statique et du sitemap.

- **`POST /planka/create`** (`hook_planka_create`, événement `cardCreate`) — numérote la carte dans son titre (`#42 · Titre`, compteur **par projet**) et remplit le champ personnalisé `Branche` (`feat/42-titre-en-slug`). Une carte dupliquée reçoit un nouveau numéro.
- **`POST /planka/labels`** (`hook_planka_labels`, `cardLabelCreate`/`cardLabelDelete`) — recalcule le préfixe du champ `Branche` en gardant numéro et slug. Préfixes par étiquette dans `config/services.yaml` (`planka.branch_prefixes` : `Bug` → `fix`, `Evolution` → `feat`, première étiquette de la liste gagnante ; défaut `feat`). Nécessaire car une carte est presque toujours créée **sans** étiquette.
- **`bin/console app:planka:number-cards <board-id> [--dry-run]`** — rattrapage des cartes existantes, dans l'ordre de création. Ne couvre pas la liste système d'archive : sa pagination renvoie un 500 en Planka 2.1.1 (plankanban/planka#1761).

Pièces : `Domain/Planka/` (`Model/CardTitle`, `Model/BranchName`, DTOs, `Service/CardNumberer`, `Repository/CardCounterRepository`), `Infrastructure/Planka/PlankaClient` (client HTTP scopé `planka.client`, en-tête `X-Api-Key` — un `Authorization: Bearer` avec la clé API renvoie 401), `Infrastructure/Planka/WebhookRequestReader` (vérifie `Authorization: Bearer <PLANKA_WEBHOOK_TOKEN>`, refuse tout si le jeton n'est pas configuré ; n'accepte que des ids numériques, concaténés dans les chemins d'API), `Responder/Hook/WebhookResponder` (JSON du résultat), `Infrastructure/Console/PlankaNumberCardsCommand`.

- **Activation par adhésion** : le compte `hooks@remij.dev` n'agit que sur les tableaux dont il est membre *éditeur* ; ailleurs Planka répond 404/403 et le hook renvoie `ignored` (le webhook Planka est global, sans filtre par tableau).
- **Champ `Branche`** : défini dans un groupe **de base** du projet, exposé sur le tableau par un groupe de tableau basé dessus ; retrouvé **par nom** (`planka.branch_field`), aucun id en config. Sans ce groupe sur le tableau, seul le titre est numéroté.
- **Compteur** : `%kernel.share_dir%/planka/card-counters.json` (`var/share/<env>/`, dans les `shared_dirs` Deployer), incrément sous `flock`. Il ne redescend jamais sous le plus grand `#N` visible sur le tableau. **Il fait foi** : à copier en cas de changement de serveur.
- **Env** : `PLANKA_URL`, `PLANKA_API_KEY`, `PLANKA_WEBHOOK_TOKEN` — valeurs réelles dans `.env.local` (dev) et `shared/.env.local` (prod, mode 600 ; prises en compte au déploiement suivant via `composer dump-env`).
- **Traces en prod** : les logs `info` ne sont pas persistés (`fingers_crossed` au niveau `error`) ; la trace d'un appel est sa réponse JSON, les exceptions remontent dans GlitchTip.

### Content Files Format

Articles in `content/articles/` follow the naming convention `YYYY-MM-topic.md` with YAML front matter:
```yaml
---
title:          "Article title"
description:    "Short description"
publishedAt:    "YYYY-MM-DD"
lastModified:   ~
tableOfContent: true
authors:        ["remij"]
tags:           ["tag1", "tag2"]
---
```
A future `publishedAt` date means the article is not yet published (draft).

### Tutorial Content (`content/tutoriels/`)

Un fichier **à la racine** est un tutoriel (`Tutorial`) : soit une **série** quand un sous-dossier du même nom contient ses parties, soit un **tutoriel autonome** d'une seule page. Les fichiers **en sous-dossier** sont les parties (`Chapter`) :

```
content/tutoriels/
├── symfony-les-bases.md         ← série : front matter identique aux articles (sans nextArticle)
└── symfony-les-bases/
    ├── architecture.md          ← partie, front matter réduit (voir ci-dessous)
    └── controllers.md
```

Front matter d'une partie — pas de `authors`/`tags` (portés par la série) :
```yaml
---
title:          "Titre de la partie"
description:    "Description courte"
position:       1
publishedAt:    "YYYY-MM-DD"
lastModified:   ~
tableOfContent: true
---
```

Règles :
- L'ordre des parties vient du champ `position` (pas de préfixe numérique dans les noms de fichiers → URLs stables, insertion sans renommage).
- Publication progressive : chaque partie a son `publishedAt`. Le sommaire de la série liste **toutes** les parties, les non-publiées grisées « à venir » **sans lien** — donc jamais crawlées par `stenope:build`, absentes du site statique.
- Deux niveaux maximum (série → parties), pas de sous-parties.

### Video Content (`content/videos/`)

All content related to video productions (YouTube, conferences, workshops) lives under `content/videos/`. Each video gets its own subdirectory containing up to three files:
- `slides.md` — Marp presentation source
- `script.md` — spoken script for the recording
- `textes.md` — supporting texts (YouTube description, social media posts)

Videos are organized by theme:
```
content/videos/
├── general/          ← channel-level videos
├── cours/            ← course series (e.g. cours/Symfony/, cours/hb/)
├── outils/           ← tool-focused videos
├── ateliers/         ← workshop videos
├── projets/          ← project series (e.g. projets/recettes/)
└── interne/          ← internal notes (not published)
```

A series can nest: `cours/Symfony/5-doctrine/` contains both `slides.md` (the top-level episode) and subdirectories for sub-episodes (`5-1-install/`, `5-2-entite/`, …).

**Slides front matter** uses Marp directives (not Stenope YAML):
```yaml
---
headingDivider: 2
paginate: true
auto-scaling: true
header: "Slide header"
---
```

**Assets for slides:**
- Theme CSS: `assets/styles/slides/theme.css` (registered as custom Marp theme `remij`)
- Shared images: `assets/images/slides/` (copied to `slides/images/` during build)

#### Slides compilation

Slides are compiled with [Marp CLI](https://github.com/marp-team/marp-cli) (configured in `package.json`):
```shell
make slides/start   # Watch mode via Docker (marpteam/marp-cli image, port 8080)
make slides/build   # Copy images to slides/images/, then npx marp (assets container)
```
The `marp` config in `package.json`: `inputDir: ./content/videos`, `glob: **/slides.md`, `output: ./slides`, `themeSet: ./assets/styles/slides`, theme `remij`, lang `fr`.

### Responders (`src/Responder/`)

Hiérarchie des classes de base :
```
AbstractResponder                  ← base commune : injecte ControllerHelper::addFlash() et redirectToRoute() via #[AutowireMethodOf] comme \Closure protégés
└── AbstractTwigResponder          ← ajoute ControllerHelper::render() (même mécanisme), expose render(): Response
    │                                et getLastModified(array): ?DateTimeInterface (max des lastModifiedOrCreated via ContentUtils)
    ├── Article/ListResponder
    ├── Article/ShowResponder      ← utilise $article->getLastModifiedOrCreated() directement
    ├── Tutorial/ListResponder
    ├── Tutorial/ShowResponder     ← Last-Modified = max(série + toutes ses parties, y compris non publiées : le sommaire les tease)
    ├── Tutorial/ChapterResponder  ← calcule previousChapter/nextChapter parmi les seules parties publiées (triées par position)
    ├── Publication/ListByTagResponder
    ├── Publication/ListByAuthorResponder
    ├── Publication/RssResponder   ← reçoit list<FeedEntry> ; Content-Type: application/atom+xml ; Last-Modified = max(updated)
    ├── Page/HomeResponder
    ├── Page/ContactResponder      ← délègue à ContactFormHandler ; addFlash + redirectToRoute('page_contact') on success, status 422 si invalide
    ├── Page/ContentResponder      ← sélection template custom vs fallback via twig loader ; surcharge le constructeur pour injecter Twig\Environment séparément
    ├── Seo/RobotsResponder        ← Content-Type: text/plain
    ├── Hook/WebhookResponder      ← étend AbstractResponder (pas Twig) : JsonResponse du NumberingResult
    └── Seo/SitemapResponder       ← Content-Type: application/xml (l'agrégation tags/auteurs vit dans PublicationRepository, pas ici)
```

**`AbstractResponder`** porte les closures `addFlash` et `redirectToRoute` (autowirées via `#[AutowireMethodOf(ControllerHelper::class)]`) pour les Responders qui doivent rediriger ou poser un flash (ex: `ContactResponder`). **`AbstractTwigResponder`** en hérite et y ajoute la closure `render`. Un Responder qui surcharge le constructeur (ex: `ContentResponder`) reçoit les trois closures en paramètres simples — **non promus** — et les transmet via `parent::__construct($addFlash, $redirectToRoute, $render)` (les promouvoir à nouveau réassignerait la propriété `readonly` `$render` du parent → erreur).

**Point d'entrée :** chaque Responder concret est **invokable** — une unique méthode publique **`__invoke(): Response`** ; l'Action l'appelle via `$responder(...)` (ou `($this->responder)(...)` quand le Responder est une propriété promue). Les signatures de `__invoke()` diffèrent d'un Responder à l'autre (pas d'interface typée commune possible, ni souhaitée). La méthode `render()` reste `protected` sur `AbstractTwigResponder`. Les **Actions sont aussi invokables** (`__invoke`) car ce sont les contrôleurs Symfony.

**Règle :** le `Last-Modified` et les headers de Content-Type sont calculés et posés dans le Responder, pas dans l'Action.

### Actions (`src/Action/`)

Un fichier par action, organisé en sous-dossiers. Chaque action est une `readonly class` avec une seule méthode `__invoke()`. Les actions se limitent à : récupérer les données via le Repository, invoquer le Responder — `($this->responder)(...)` (ou `$responder(...)` quand le Responder est injecté en argument de méthode). `ContactAction` reste minimal : il récupère la page `contact` et passe la `Request` à `ContactResponder::__invoke()` — c'est le Responder qui gère le formulaire (flash, redirect, status 422) via les closures `addFlash`/`redirectToRoute` d'`AbstractResponder`.

**Convention de nommage des routes :** préfixées par le sous-dossier (ex: `seo_robots`, `seo_sitemap`). Exception explicite : `Publication/RssAction` conserve le nom `rss` (pas de préfixe `publication_`).

- **`Page/HomeAction`** — `GET /` → `page_home`
- **`Page/ContactAction`** — `GET|POST /contact` → `page_contact` (délègue tout le traitement du formulaire à `ContactResponder`, qui envoie l'email via Brevo et redirige on success)
- **`Page/ContentAction`** — `GET /{slug}` → `page_content` (catch-all, priority -500 ; redirige le slug `home` vers `page_home` ; convertit `ContentNotFoundException` en `NotFoundHttpException`)
- **`Article/ListAction`** — `GET /articles/` → `article_list`
- **`Article/ShowAction`** — `GET /articles/{slug:article}` → `article_show` (requirements `.+` : les slugs contiennent le dossier année, ex. `2026/02-controllers-symfony`)
- **`Tutorial/ListAction`** — `GET /tutoriels/` → `tutorial_list`
- **`Tutorial/ShowAction`** — `GET /tutoriels/{slug:tutorial}` → `tutorial_show` (segment unique, requirement par défaut sans slash)
- **`Tutorial/ChapterAction`** — `GET /tutoriels/{slug:chapter}` → `tutorial_chapter`, requirements `['slug' => '.+/.+']` : le slash obligatoire désambiguïse avec `tutorial_show` sans dépendre de l'ordre des routes. Convertit en `NotFoundHttpException` le cas « partie sans fichier de série ».
- **`Publication/ListByTagAction`** — `GET /tag/{tag}` → `publication_list_by_tag` (articles + tutoriels ; un tag inconnu rend une liste vide, 200)
- **`Publication/ListByAuthorAction`** — `GET /auteur/{slug:author}` → `publication_list_by_author`
- **`Publication/RssAction`** — `GET /rss.xml` → `rss`, flux Atom transversal (`Content-Type: application/atom+xml`) : articles + tutoriels + parties publiées de séries publiées, via `PublicationRepository::findFeedEntries()`
- **`Seo/RobotsAction`** — `GET /robots.txt` → `seo_robots`
- **`Hook/PlankaCreateAction`** — `POST /planka/create` → `hook_planka_create` ; **`Hook/PlankaLabelsAction`** — `POST /planka/labels` → `hook_planka_labels` (webhooks Planka, voir [Hooks Planka](#hooks-planka-hooksremijdev))
- **`Seo/SitemapAction`** — `GET /sitemap.xml` → `seo_sitemap`, liste toutes les URLs publiques (articles, tutoriels, parties, pages, tags, auteurs) sauf `seo_robots` et `seo_sitemap`

### Templates (`templates/`)

- `base.html.twig` / layout partials in `templates/layout/` — global layout with header, footer, breadcrumb (`_breadcrumb.html.twig` honore le flag `translate: false` des items de `MenuBuilder`).
- `templates/pages/` — page templates: `home.html.twig`, `page.html.twig` (generic fallback), `contact.html.twig`. Custom page templates go here, named after the content slug.
- `templates/articles/` — `list`, `show`, la carte article (`_macros.html.twig`), `_toc.html.twig` (table des matières, réutilisé par les tutoriels) et `_author_card.html.twig` (réutilisé par les pages auteur).
- `templates/tutorials/` — `list`, `show` (intro + sommaire avec teasing des parties à venir), `chapter` (ToC + nav précédent/suivant), carte tutoriel (`_macros.html.twig`).
- `templates/publications/` — pages transversales : `list.html.twig` (layout commun), `list_by_tag`, `list_by_author`, et `_macros.html.twig` qui dispatche la carte selon `publication.type.value` (carte article ou carte tutoriel).
- `templates/rss/rss.xml.twig` — flux Atom, boucle uniquement sur des `FeedEntry` (URL générée via `url(entry.routeName, entry.routeParams)`).
- `templates/seo/` — `robots.txt.twig`, `sitemap.xml.twig`.

### Assets (`assets/`)

- `app.js` — main JS entry point with Stimulus/Turbo via `bootstrap.js`.
- `assets/styles/app.scss` — main Sass entry point.
- `assets/styles/prism.scss` — syntax highlighting styles.
- `assets/controllers/` — Stimulus controllers.
- Managed via Symfony AssetMapper + sass-bundle (no webpack/vite). The `sass` binary (Dart Sass, musl build) is installed in the php image and found on the `PATH` via the bundle's `search_for_binary` — see « Why Dart Sass in the php image » in [Docker development environment](#docker-development-environment).

### Site Configuration (`config/site.yaml`)

Global site metadata (title, description) and navigation menus (main + footer) are defined here and exposed to all Twig templates via `{{ site }}` global.

### Tests (`tests/`)

- **PHPUnit 13** is used for tests via `bin/phpunit` (run through `make phpunit`).
- `phpunit.xml.dist` uses `Symfony\Bridge\PhpUnit\SymfonyExtension` (replaces the old `SymfonyTestsListener`).
- **Every new service** in `src/` must have a corresponding unit test in `tests/` (mirroring the `src/` directory structure). Use plain `PHPUnit\Framework\TestCase` for services with no kernel dependency.
- Data providers use `symfony/finder` (`Finder`) to scan directories dynamically — no hardcoded slugs or route names.

**Mock vs Stub (règle PHPUnit 13) :**
- `$this->createMock()` uniquement quand on pose un `expects(...)` dessus.
- `self::createStub()` pour tout ce qui est juste configuré avec `method()->willReturn()` sans expectation.
- Les Domain Models (`Article`, `Page`, `Author`) ne se mockent pas — ce sont des value objects, instancier directement.
- Ne pas utiliser `$this->createMock()` / `$this->createStub()` — préférer la forme statique `self::createMock()` / `self::createStub()` (PHPStan niveau max).
- Ne pas utiliser `$this->callback()` dans `->with()` — préférer `self::callback()` (idem).

**Tests fonctionnels (WebTestCase) :**
- `tests/Action/ArticleActionsTest.php` — tests `/articles/` list (200), all slugs from `content/articles/` (200 each), and a non-existent slug (`ContentNotFoundException` via `catchExceptions(false)`).
- `tests/Action/TutorialActionsTest.php` — même approche pour `/tutoriels/` : list (200), chaque slug de `Tutorial` et de `Chapter` (200, brouillons compris — accessibles par URL directe), slugs inexistants (`ContentNotFoundException`).
- `tests/Action/PublicationActionsTest.php` — pages transversales : `/tag/{tag}` (200) pour chaque tag des contenus publiés (articles + tutoriels), tag inconnu (200, liste vide), `/auteur/{slug}` (200) pour chaque auteur, auteur inconnu (`ContentNotFoundException`).
- `tests/Action/DefaultActionsTest.php` — tests `/` home (200), all slugs from `content/pages/` except `home` (redirects) and `contact` (dedicated route), and a non-existent slug (`NotFoundHttpException`).
- `tests/Action/RssActionTest.php` — tests `/rss.xml` (200, correct Content-Type, valid Atom XML, ordering, Last-Modified header). Le nombre d'entrées attendu = articles publiés + tutoriels publiés + parties publiées de séries publiées, recalculé dynamiquement via `ContentManagerInterface`.
- `tests/Action/RobotsActionTest.php` — tests `/robots.txt` (200).
- `tests/Action/SitemapActionTest.php` — tests `/sitemap.xml` (200) and verifies every expected URL is present: static routes discovered via `#[Route]` attributes (excluding `Seo/` actions and non-HTML routes), plus one URL per published article, tutorial, chapter (of a published tutorial), tag and author (agrégés sur articles + tutoriels), and page.

**Tests unitaires (TestCase) :**
- `tests/Infrastructure/Twig/MenuBuilderTest.php` — unit tests for `MenuBuilder::breadcrumb()`. Data provider discovers routes dynamically from action `#[Route]` attributes via PHP Reflection (using `RouteDiscoveryTrait`); asserts exact breadcrumb item count per route. `EXPECTED_BREADCRUMB_COUNTS` must be updated when a new action route is added. `MenuBuilder` reçoit un `TutorialRepository` stubé (`findBySlug` → `Tutorial` réel) pour le crumb série des pages de partie.
- `tests/Infrastructure/Form/ContactFormHandlerTest.php` — unit tests for `ContactFormHandler`.
- `tests/Infrastructure/Mailer/ContactMailerTest.php` — unit tests for `ContactMailer`.
- `tests/Domain/Article/Repository/ArticleRepositoryTest.php` — unit tests for `ArticleRepository`: vérifie les expressions de filtrage transmises à `ContentManagerInterface` et le filtrage effectif des résultats.
- `tests/Domain/Tutorial/Repository/TutorialRepositoryTest.php` — même approche pour `TutorialRepository`, y compris `findChapters()` (filtrage par slug de série) et `findPublishedChapters()` (exclusion des parties de séries non publiées).
- `tests/Domain/Publication/Repository/PublicationRepositoryTest.php` — l'agrégateur, avec les repositories composés **stubés** (`self::createStub()` sur les classes concrètes) : fusion + tri par date, agrégations `findTags()`/`findAuthors()`, `findFeedEntries()` (brouillons exclus, titres contextualisés, noms d'auteurs résolus — slug inconnu conservé tel quel).
- `tests/Domain/Publication/Repository/AuthorRepositoryTest.php` et `tests/Domain/Publication/DTO/FeedEntryTest.php` — les named constructors de `FeedEntry` (routes par type, héritage tags/auteurs de la série, fallback `updated` = `publishedAt`).
- `tests/Responder/` — un test par Responder, miroir de `src/Responder/`. Chaque test couvre : le bon template appelé, les headers HTTP spécifiques (Content-Type, Last-Modified), et les cas limites (liste vide, template fallback). Utilise de vraies instances de Domain Models plutôt que des mocks. Le constructeur reçoit les **trois closures** d'`AbstractResponder`/`AbstractTwigResponder` dans l'ordre **`addFlash`, `redirectToRoute`, `render`** (car ils utilisent `AutowireMethodOf`). Les Responders qui n'en ont pas l'usage reçoivent des no-op : `static fn () => null` pour `addFlash`, `static fn (): RedirectResponse => new RedirectResponse('/')` pour `redirectToRoute` (le retour doit être un `RedirectResponse` pour PHPStan), et un vrai closure `render(string, array, ?Response): Response`. `ContentResponder` reçoit en plus un `Twig\Environment` stub pour le check du loader. `ContactResponderTest` couvre les trois branches de `__invoke()` : non soumis (rendu, 200), succès (flash + redirect, pas de rendu), invalide (rendu, 422), en stubbant `ContactFormHandler`.
- `tests/Domain/Planka/`, `tests/Infrastructure/Planka/`, `tests/Infrastructure/Console/`, `tests/Responder/Hook/` — hooks Planka : `PlankaClient` contre `MockHttpClient`, `CardNumberer` avec `PlankaClient` mocké et un vrai compteur dans un dossier temporaire. `tests/Action/HookActionsTest.php` ne couvre que les branches sans appel à Planka (401, 400, événement ignoré, GET non servi) ; `SitemapActionTest` exclut le dossier `Action/Hook`.
- `tests/Helper/RouteDiscoveryTrait.php` — shared trait that scans `src/Action/` via Reflection to extract route names, paths, and parameter names. Supports excluding subdirectories and handles `{param:mapping}` syntax.
- Adding a new file to `content/` automatically adds an action test case — no code change needed.

### Git Commit Style

- Always start commit messages with the 🤖 emoji.

### Code Style Rules

- All PHP files must have `declare(strict_types=1)`.
- PHP-CS-Fixer uses `@Symfony` ruleset with `declare_strict_types`, `ordered_imports`, short array syntax.
- PHPStan runs at level `max` with strict-rules, symfony extension, and banned-code extension.
- PHPStan uses the `test` environment container for analysis (run `cache:clear` + `cache:warmup` in test env first).
