# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is **RémiJ** — a personal blog and static website built with [Stenope](https://stenopephp.github.io/Stenope/) (a Symfony-based static site generator). The site is a French-language PHP/Symfony developer blog. Content is written in Markdown and compiled into a static site.

**Stack:** PHP 8.5, Symfony 8.0, Stenope (fork RemiJ-dev/Stenope, branche `update-to-sf-80-php-85`), Symfony AssetMapper, Sass, Turbo/Stimulus. Dev environment runs in **Docker** (see [Docker development environment](#docker-development-environment)).

## Commands

The `Makefile` is the single entry point and is **Docker-aware**: when the `docker` binary is detected on the host, every PHP/Composer/Symfony/npm command is transparently run inside the `php` container (`docker compose exec php …`). When `docker` is absent — inside the container itself, or on GitHub Actions — the same targets run the binaries directly (this is why CI needs no Docker). Always drive the project through `make`, not the `symfony` CLI.

### Setup
```shell
make install          # Install all dependencies (Composer + npm + importmap assets)
```

### Development
```shell
make serve            # Start the Docker stack: php + nginx + mailhog (site on http://localhost:8000)
make serve.assets     # Watch & compile Sass (bin/console sass:build --watch, runs in the php container)
make serve.slides     # Start the Marp slides watch server (Docker, http://localhost:8080)
```

### Build
```shell
make build.static     # Full production build (assets + static content)
make build.assets     # Compile assets for production
make build.content    # Build static site (APP_ENV=prod, clears image cache)
make build.content.without-images  # Faster build, skips image resizing
make build.slides     # Copy slide images, then compile Marp slides
```

### Lint
```shell
make lint                      # Run all linters
make lint.php-cs-fixer         # Fix PHP code style (auto-fixes)
make lint.phpstan              # Static analysis (level max)
make lint.twig                 # Lint Twig templates
make lint.yaml                 # Lint YAML files (config + content)
make lint.eslint               # Lint JS/JSON assets (auto-fixes)
make lint.container            # Lint Symfony DI container
```

### Test
```shell
make test              # Basic test: runs build.content.without-images and PHPUnit tests
bin/phpunit            # Run PHPUnit tests (functional and unit tests)
bin/phpunit --testdox  # Run with human-readable output
```

### Cache
```shell
make clear.cache     # Clear Symfony cache
make clear.assets    # Remove public/assets/
make clear.build     # Remove build/ and public/assets/
make clear.images    # Remove public/resized/ (Glide image cache)
```

## Docker development environment

The dev environment is fully containerized via Docker Compose — no host PHP install or `symfony` CLI binary required.

**How `make` routes commands:** the `Makefile` checks for the `docker` binary (`command -v docker`). When found, `PHP` / `COMPOSER` / `SYMFONY` / `NPM` / `NPX` are prefixed with `docker compose exec php`, so `make install`, `make lint`, `make test`, `make serve.assets`, etc. all execute **inside the `php` container**. When `docker` is absent (in the container, or in CI), the same targets call the binaries directly. The `@dist` targets (`install@dist`, `build@dist`) always run raw commands, for production/deploy.

**`docker-compose.yml` services:**
- **`php`** — built from the `app_php` Dockerfile stage; mounts the project at `/srv`, forwards the host SSH agent + `~/.ssh` (private Composer deps) and shares the PHP-FPM socket with nginx via the `php-socket` volume. All CLI commands run here.
- **`nginx`** — built from the `app_nginx` stage; serves the site on **http://localhost:8000**, proxying to `php` over the FPM unix socket.
- **`mailhog`** — catches dev mail; SMTP on `1025`, web UI on **http://localhost:8025**.
- **`slides`** — `marpteam/marp-cli`; Marp watch server on **http://localhost:8080** (`make serve.slides`).

**`Dockerfile`** (multi-stage):
- **`app_php`** — `php:8.5-fpm-alpine` with the required extensions (intl, gd, imagick, apcu, opcache, zip, exif, bcmath, soap, xsl…), Composer, Node 24 (copied from `node:24-alpine`), and Dart Sass (`npm install -g sass`, see Sass note below). Entrypoint `.docker/php/entrypoint.sh` sets up SSH keys, marks `/srv` as a safe git dir, and fixes `var/` + `public/` permissions.
- **`app_nginx`** — `nginx:1-alpine` with the config from `.docker/nginx/`.

**`.docker/` config files:**
- `php/conf.d/app.ini` — PHP ini (timezone Europe/Paris, `memory_limit=1024M`, OPcache tuning).
- `php/php-fpm.d/zz-docker.conf` — FPM pool listening on `/var/run/php/php-fpm.sock`.
- `php/entrypoint.sh` — container entrypoint.
- `nginx/nginx.conf`, `nginx/gzip.conf`, `nginx/templates/default.conf.template` — nginx config (root `/srv/public`, FPM passthrough).

**Typical bootstrap:**
```shell
docker compose up -d php nginx    # build images & start containers (first run builds)
make install                      # composer + npm + importmap, inside the php container
make serve                        # foreground: php + nginx + mailhog (Ctrl-C to stop)
make serve.assets                 # second terminal: Sass watcher
```

**Sass / dart-sass:** `symfonycasts/sass-bundle` needs a `sass` binary. Its `search_for_binary` option (default `true`) looks for `sass` on the `PATH` *before* downloading anything, so the image installs Dart Sass globally (`npm install -g sass`) and the bundle uses it directly — it never downloads a platform binary into `var/dart-sass/`. This matters on Alpine/musl: the bundle's auto-downloaded binary, or a glibc copy left in the bind-mounted `var/dart-sass/` by the host, would fail to exec inside the musl container. Keeping `sass` on the `PATH` sidesteps both.

## Verification workflow

After any code change, always verify in this order:

```shell
make lint      # Must pass before running tests
make test      # Run after lint passes
```

Never use `bin/phpunit` directly — always go through `make test`.

## Architecture

### How Stenope Works

Stenope reads content files (Markdown with YAML front matter) from `content/`, deserializes them into PHP model objects, and then renders static HTML pages via Symfony controllers and Twig templates. The `ContentManagerInterface` is the main entry point for fetching content in actions.

Content types and their source directories are configured in `config/packages/stenope.yaml`:
- `App\Domain\Article\Model\Article` ← `content/articles/`
- `App\Domain\Article\Model\Author` ← `content/authors/`
- `App\Domain\Page\Model\Page` ← `content/pages/`

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
- **`Domain/Article/Model/Article`** — articles de blog : `slug`, `title`, `description`, `content`, `authors[]`, `tags[]`, `publishedAt`, `image`, `lastModified`, `tableOfContent`. Méthodes `isPublished()` et `getLastModifiedOrCreated()`.
- **`Domain/Article/Model/Author`** — profils auteurs : `slug`, `name`, `avatar`, `active`, `since`.
- **`Domain/Page/Model/Page`** — pages statiques génériques.
- **`Domain/Seo/Model/MetaTrait`** — champs SEO/réseaux sociaux partagés (`metaTitle`, `metaDescription`), utilisé par `Article` et `Page`.
- **`Domain/Page/DTO/ContactDTO`** — DTO du formulaire de contact avec contraintes de validation (`NotBlank`, `Email`, `Length`).

**Repositories (services autowirés) :**
- **`Domain/Article/Repository/ArticleRepository`** — `findPublished()`, `findByTag(string $tag)`, `findByAuthor(Author $author)`. Wraps `ContentManagerInterface`.
- **`Domain/Page/Repository/PageRepository`** — `findBySlug(string $slug)` (peut lever `ContentNotFoundException`), `findAll()`. Wraps `ContentManagerInterface`.

### Infrastructure (`src/Infrastructure/`)

- **`Infrastructure/Form/ContactType`** — Symfony Form type pour la page contact, lié à `ContactDTO`.
- **`Infrastructure/Form/Handler/ContactFormHandler`** — gère la soumission du formulaire de contact (validation + envoi).
- **`Infrastructure/Mailer/ContactMailer`** — envoie l'email de contact via Brevo.
- **`Infrastructure/Twig/MenuBuilder`** — construit le fil d'Ariane pour la requête courante. Lit `_route` et `_route_params` depuis `RequestStack`. Gère : `page_home`, `page_contact`, `page_content`, `article_list`, `article_list_by_tag`, `article_list_by_author`, `article_show`. Les routes non gérées (ex: `rss`, `seo_robots`, `seo_sitemap`) retournent uniquement l'entrée home.
- **`Infrastructure/Twig/MenuExtension`** — expose `MenuBuilder::breadcrumb()` via la fonction Twig `breadcrumb()`.
- **`Infrastructure/Stenope/Processor/AssetsProcessor`** — post-traite le HTML des articles pour résoudre les URLs d'assets locaux pour les éléments `<source>` et `<video>` via le composant Asset de Symfony.

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
make serve.slides   # Watch mode via Docker (marpteam/marp-cli image, port 8080)
make build.slides   # Copy images to slides/images/, then npx marp
```
The `marp` config in `package.json`: `inputDir: ./content/videos`, `glob: **/slides.md`, `output: ./slides`, `themeSet: ./assets/styles/slides`, theme `remij`, lang `fr`.

### Responders (`src/Responder/`)

Hiérarchie des classes de base :
```
AbstractTwigResponder              ← injecte ControllerHelper::render() via #[AutowireMethodOf] comme \Closure, expose render(): Response
├── AbstractArticleResponder       ← ajoute lastModified(array) via ContentUtils
│   ├── ListResponder
│   ├── ListByTagResponder
│   ├── ListByAuthorResponder
│   ├── ShowResponder              ← utilise $article->getLastModifiedOrCreated() directement
│   └── RssResponder              ← Content-Type: application/atom+xml
└── (direct)
    ├── Page/HomeResponder
    ├── Page/ContactResponder      ← @param FormInterface<ContactDTO>
    ├── Page/ContentResponder      ← sélection template custom vs fallback via twig loader ; surcharge le constructeur pour injecter Twig\Environment séparément
    ├── Seo/RobotsResponder       ← Content-Type: text/plain
    └── Seo/SitemapResponder      ← agrège tags/authors, Content-Type: application/xml
```

**Règle :** le `Last-Modified` et les headers de Content-Type sont calculés et posés dans le Responder, pas dans l'Action.

### Actions (`src/Action/`)

Un fichier par action, organisé en sous-dossiers. Chaque action est une `readonly class` avec une seule méthode `__invoke()`. Les actions se limitent à : récupérer les données via le Repository, appeler `($this->responder)(...)`. `ContactAction` injecte `addFlash` et `redirectToRoute` via `#[AutowireMethodOf(ControllerHelper::class)]` plutôt qu'en étendant `AbstractController`.

**Convention de nommage des routes :** préfixées par le sous-dossier (ex: `seo_robots`, `seo_sitemap`). Exception explicite : `Article/RssAction` conserve le nom `rss` (pas de préfixe `article_`).

- **`Page/HomeAction`** — `GET /` → `page_home`
- **`Page/ContactAction`** — `GET|POST /contact` → `page_contact` (envoie un email via Brevo ; redirect on success reste dans l'Action)
- **`Page/ContentAction`** — `GET /{slug}` → `page_content` (catch-all, priority -500 ; redirige le slug `home` vers `page_home` ; convertit `ContentNotFoundException` en `NotFoundHttpException`)
- **`Article/ListAction`** — `GET /articles/` → `article_list`
- **`Article/ListByTagAction`** — `GET /articles/tag/{tag}` → `article_list_by_tag`
- **`Article/ListByAuthorAction`** — `GET /articles/auteur/{slug}` → `article_list_by_author`
- **`Article/ShowAction`** — `GET /articles/{slug:article}` → `article_show`
- **`Article/RssAction`** — `GET /rss.xml` → `rss`, retourne un flux Atom avec `Content-Type: application/atom+xml`
- **`Seo/RobotsAction`** — `GET /robots.txt` → `seo_robots`
- **`Seo/SitemapAction`** — `GET /sitemap.xml` → `seo_sitemap`, liste toutes les URLs publiques (articles, pages, tags, auteurs) sauf `seo_robots` et `seo_sitemap`

### Templates (`templates/`)

- `base.html.twig` / layout partials in `templates/layout/` — global layout with header, footer, breadcrumb.
- `templates/pages/` — page templates: `home.html.twig`, `page.html.twig` (generic fallback), `contact.html.twig`. Custom page templates go here, named after the content slug.
- `templates/articles/` — list, show, tag-filtered list, table of contents partial.
- `templates/seo/` — `robots.txt.twig`, `sitemap.xml.twig`.

### Assets (`assets/`)

- `app.js` — main JS entry point with Stimulus/Turbo via `bootstrap.js`.
- `assets/styles/app.scss` — main Sass entry point.
- `assets/styles/prism.scss` — syntax highlighting styles.
- `assets/controllers/` — Stimulus controllers.
- Managed via Symfony AssetMapper + sass-bundle (no webpack/vite). The `sass` binary is provided globally in the Docker image (`npm install -g sass`) and found via the bundle's `search_for_binary` — see the Sass note in [Docker development environment](#docker-development-environment).

### Site Configuration (`config/site.yaml`)

Global site metadata (title, description) and navigation menus (main + footer) are defined here and exposed to all Twig templates via `{{ site }}` global.

### Tests (`tests/`)

- **PHPUnit 13** is used for tests via `bin/phpunit`.
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
- `tests/Action/DefaultActionsTest.php` — tests `/` home (200), all slugs from `content/pages/` except `home` (redirects) and `contact` (dedicated route), and a non-existent slug (`NotFoundHttpException`).
- `tests/Action/RssActionTest.php` — tests `/rss.xml` (200, correct Content-Type, valid Atom XML, article count, ordering, Last-Modified header).
- `tests/Action/RobotsActionTest.php` — tests `/robots.txt` (200).
- `tests/Action/SitemapActionTest.php` — tests `/sitemap.xml` (200) and verifies every expected URL is present: static routes discovered via `#[Route]` attributes (excluding `Seo/` actions and non-HTML routes), plus one URL per published article, tag, author, and page.

**Tests unitaires (TestCase) :**
- `tests/Infrastructure/Twig/MenuBuilderTest.php` — unit tests for `MenuBuilder::breadcrumb()`. Data provider discovers routes dynamically from action `#[Route]` attributes via PHP Reflection (using `RouteDiscoveryTrait`); asserts exact breadcrumb item count per route. `EXPECTED_BREADCRUMB_COUNTS` must be updated when a new action route is added.
- `tests/Infrastructure/Form/ContactFormHandlerTest.php` — unit tests for `ContactFormHandler`.
- `tests/Infrastructure/Mailer/ContactMailerTest.php` — unit tests for `ContactMailer`.
- `tests/Domain/Article/Repository/ArticleRepositoryTest.php` — unit tests for `ArticleRepository`: vérifie les expressions de filtrage transmises à `ContentManagerInterface` et le filtrage effectif des résultats.
- `tests/Responder/` — un test par Responder, miroir de `src/Responder/`. Chaque test couvre : le bon template appelé, les headers HTTP spécifiques (Content-Type, Last-Modified), et les cas limites (liste vide, template fallback). Utilise de vraies instances de Domain Models plutôt que des mocks. Le constructeur reçoit une `\Closure(string, array): Response` à la place d'un `Twig\Environment` (car `AbstractTwigResponder` utilise `AutowireMethodOf`). `ContentResponder` reçoit en plus un `Twig\Environment` stub pour le check du loader.
- `tests/Helper/RouteDiscoveryTrait.php` — shared trait that scans `src/Action/` via Reflection to extract route names, paths, and parameter names. Supports excluding subdirectories and handles `{param:mapping}` syntax.
- Adding a new file to `content/` automatically adds an action test case — no code change needed.

### Git Commit Style

- Always start commit messages with the 🤖 emoji.

### Code Style Rules

- All PHP files must have `declare(strict_types=1)`.
- PHP-CS-Fixer uses `@Symfony` ruleset with `declare_strict_types`, `ordered_imports`, short array syntax.
- PHPStan runs at level `max` with strict-rules, symfony extension, and banned-code extension.
- PHPStan uses the `test` environment container for analysis (run `cache:clear` + `cache:warmup` in test env first).
