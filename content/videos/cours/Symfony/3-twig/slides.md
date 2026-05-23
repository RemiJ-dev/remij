---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Twig et templates"
---

# Twig et templates

- Définitions
- Créer des templates
- `{{ }}`, `{% %}`, `|` et fonctions
- La variable `app` et autres variables globales
- Un template dans un template
- Débugguer un template
- Les extensions Twig

## Définitions

- Template
- Moteur de template

## Créer des templates

- Nommage des fichiers `*.type.twig`
- Rangement dans le dossier `templates`
- Appel depuis un contrôleur
- Transmettre des données

## `{{ }}`, `{% %}`, `|` et fonctions

- Afficher avec `{{ }}` ("moustaches")
- Calculs avec `{% %}` (tags)
- Traiter une donnée avec `|` (filtres)
- [Fonctions utiles](https://twig.symfony.com/doc/3.x/)
  - [`asset()`](https://symfony.com/doc/current/reference/twig_reference.html#asset)
  - [`path()`](https://symfony.com/doc/current/reference/twig_reference.html#path) / [`url()`](https://symfony.com/doc/current/reference/twig_reference.html#url)
  - [Échapper les caractères spéciaux](https://twig.symfony.com/doc/3.x/api.html#escaper-extension)

## La variable `app` et autres variables globales

- Accéder à de nombreuses informations :
  - Utilisateur
  - Requête
  - Session
  - Messages flash
  - etc.
- Créer des variables globales

## Un template dans un template

- [`include()`](https://twig.symfony.com/doc/3.x/functions/include.html)
- [`render()`](https://symfony.com/doc/current/reference/twig_reference.html#render)

## Débugguer un template

- `php bin/console lint:twig`
- `{{ dump() }}` et `{% dump() %}`
- `php bin/console debug:twig`

## Les extensions Twig

- Créer une extension
- Différents types

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)