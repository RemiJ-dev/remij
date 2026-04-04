# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is **RémiJ** — a personal blog and static website built with [Stenope](https://stenopephp.github.io/Stenope/) (a Symfony-based static site generator). The site is a French-language PHP/Symfony developer blog. Content is written in Markdown and compiled into a static site.

**Stack:** PHP 8.5, Symfony 8.0, Stenope (fork RemiJ-dev/Stenope, branche `update-to-sf-80-php-85`), Symfony AssetMapper, Sass, Turbo/Stimulus

## Commands

All commands use the Symfony CLI (`symfony`) and `make`.

### Setup
```shell
make install          # Install all dependencies (Composer + npm + importmap assets)
```

### Development
```shell
make serve            # Start dev server (PHP + Sass watcher in parallel)
make serve.php        # Start Symfony server only (no TLS)
make serve.assets     # Watch and compile Sass only
```

### Build
```shell
make build.static     # Full production build (assets + static content)
make build.assets     # Compile assets for production
make build.content    # Build static site (APP_ENV=prod, clears image cache)
make build.content.without-images  # Faster build, skips image resizing
make serve.static     # Serve the built static site on localhost:8000
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
bin/phpunit            # Run PHPUnit tests (functional controller tests)
bin/phpunit --testdox  # Run with human-readable output
```

### Cache
```shell
make clear.cache     # Clear Symfony cache
make clear.assets    # Remove public/assets/
make clear.build     # Remove build/ and public/assets/
make clear.images    # Remove public/resized/ (Glide image cache)
```

## Architecture

### How Stenope Works

Stenope reads content files (Markdown with YAML front matter) from `content/`, deserializes them into PHP model objects, and then renders static HTML pages via Symfony controllers and Twig templates. The `ContentManagerInterface` is the main entry point for fetching content in controllers.

Content types and their source directories are configured in `config/packages/stenope.yaml`:
- `App\Model\Article` ← `content/articles/`
- `App\Model\Author` ← `content/authors/`
- `App\Model\Page` ← `content/pages/`

### Content Models (`src/Model/`)

- **Article** — blog posts with `slug`, `title`, `description`, `content`, `authors[]`, `tags[]`, `publishedAt`, `image`, `lastModified`, optional `tableOfContent`. Has `isPublished()` (based on `publishedAt` date).
- **Author** — contributor profiles with `slug`, `name`, `avatar`, `active`, `since`.
- **Page** — generic static pages. `DefaultController` looks for a template named `pages/{slug}.html.twig` first, then falls back to `pages/page.html.twig`.
- **MetaTrait** — shared SEO/meta fields used by Article and Page.

### Forms (`src/Form/`)

- **ContactType** — Symfony form type for the contact page, bound to `ContactDTO`.
- **DTO/ContactDTO** — data transfer object for the contact form with validator constraints (`NotBlank`, `Email`, `Length`).

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

### Controllers (`src/Controller/`)

- **DefaultController** — handles `/` (home), `/contact` (GET+POST, sends email via Brevo), and `/{slug}` (catch-all for pages, priority -500).
- **ArticleController** — handles `/articles/` (list), `/articles/tag/{tag}` (filter), `/articles/{article}` (show). Uses `ContentManagerInterface::getContents()` with Symfony Expression Language filters/orders.
- **RssAction** — handles `/rss.xml` (GET), returns an Atom feed of published articles with `Content-Type: application/atom+xml`.

### Services (`src/Menu/`)

- **MenuBuilder** — builds the breadcrumb for the current request. Reads `_route` and `_route_params` from `RequestStack`. Handles routes: `page_home`, `page_contact`, `page_content`, `article_list`, `article_list_by_tag`, `article_show`. Unhandled routes (e.g. `rss`) return only the home entry.

### Custom Stenope Processor (`src/Stenope/Processor/`)

- **AssetsProcessor** — post-processes article HTML to resolve local asset URLs for `<source>` and `<video>` elements using Symfony's Asset component.

### Templates (`templates/`)

- `base.html.twig` / layout partials in `templates/layout/` — global layout with header, footer, breadcrumb.
- `templates/pages/` — page templates: `home.html.twig`, `page.html.twig` (generic fallback), `contact.html.twig`. Custom page templates go here, named after the content slug.
- `templates/articles/` — list, show, tag-filtered list, table of contents partial.

### Assets (`assets/`)

- `app.js` — main JS entry point with Stimulus/Turbo via `bootstrap.js`.
- `assets/styles/app.scss` — main Sass entry point.
- `assets/styles/prism.scss` — syntax highlighting styles.
- `assets/controllers/` — Stimulus controllers.
- Managed via Symfony AssetMapper + sass-bundle (no webpack/vite).

### Site Configuration (`config/site.yaml`)

Global site metadata (title, description) and navigation menus (main + footer) are defined here and exposed to all Twig templates via `{{ site }}` global.

### Tests (`tests/`)

- **PHPUnit 13** is used for tests via `bin/phpunit`.
- `phpunit.xml.dist` uses `Symfony\Bridge\PhpUnit\SymfonyExtension` (replaces the old `SymfonyTestsListener`).
- **Every new service** in `src/` must have a corresponding unit test in `tests/` (mirroring the `src/` directory structure). Use plain `PHPUnit\Framework\TestCase` for services with no kernel dependency.
- Controller tests use `WebTestCase` for functional (HTTP) testing. Service tests use `TestCase` with `RequestStack`/`Request` objects directly (no mocks needed for lightweight Symfony value objects).
- Data providers use `symfony/finder` (`Finder`) to scan directories dynamically — no hardcoded slugs or route names.
- `tests/Controller/ArticleControllerTest.php` — tests `/articles/` list (200), all slugs from `content/articles/` (200 each), and a non-existent slug (`ContentNotFoundException` via `catchExceptions(false)`).
- `tests/Controller/DefaultControllerTest.php` — tests `/` home (200), all slugs from `content/pages/` except `home` (redirects) and `contact` (dedicated route), and a non-existent slug (`NotFoundHttpException`).
- `tests/Controller/RssActionTest.php` — tests `/rss.xml` (200, correct Content-Type, valid Atom XML, article count, ordering, Last-Modified header).
- `tests/Menu/MenuBuilderTest.php` — unit tests for `MenuBuilder::breadcrumb()`. Data provider discovers routes dynamically from controller `#[Route]` attributes via PHP Reflection; asserts exact breadcrumb item count per route. `EXPECTED_BREADCRUMB_COUNTS` must be updated when a new controller route is added.
- Adding a new file to `content/` automatically adds a controller test case — no code change needed.

### Code Style Rules

- All PHP files must have `declare(strict_types=1)`.
- PHP-CS-Fixer uses `@Symfony` ruleset with `declare_strict_types`, `ordered_imports`, short array syntax.
- PHPStan runs at level `max` with strict-rules, symfony extension, and banned-code extension.
- PHPStan uses the `test` environment container for analysis (run `cache:clear` + `cache:warmup` in test env first).
