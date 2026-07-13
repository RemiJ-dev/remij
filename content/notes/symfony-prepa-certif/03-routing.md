---
date: "2026-07-10"
formateur: "Benjamin Zaslavsky"
---

# Routing

## Intro

- Url -> controllers/actions 
  - requête -> route -> controller (lui s'en "fiche" de la requête)
- Au coeur de Symfony
- URL dynamiques et flexibles
- Routes définies en Attributs PHP, Yaml ou PHP (conf) (XML abandonné)
  - Peuvent être statiques ou dynamiques (avec paramètres)

Rôle du routeur :
1. faire matcher une requête et une route (et potentiellement un controller)
2. générer des URLs à partir d'une route (UrlGeneratorInterface)

Pourquoi le routeur est important :
1. URLs SEO-friendly **et** user-friendly
2. l'application peut gérer des patterns d'URL très complexes
3. Structure unifiée pour toute l'application (décorréler arborescence des URLs de la structure du code)


## Configuration

Controller est **toujours** un callable.

requirements en regex; condition en expression Symfony

## Parameters Validation

Utiliser la classe Requirements !

Attention, si on utilise une valeur par défaut sur le paramètre, c'est défini au dernier moment, pas au moment du match avec le routing

Aliases pour les paramètres d'URL ({slug:category} pour $category)

## Default values for URL parameters

`#[MapQueryString]` <= récupère les paramètres GET pour les mettre dans un objet (avec type hinting + contraintes de validation)
`#[MapQueryParameter]` <= rempli une valeur
`#[MapRequestPayload]` <= Comme MapQueryString mais avec les données POST

## Générer des URLs

Dans les controllers, on a un RequestContext (pour avoir host & scheme)

Pour les commandes, avoir une valeur à : framework.router.default_uri

## Special Internal Route Attributes

$request->attributes contient uniquement des éléments internes à Symfony

On peut récupérer les attributs en paramètre du controller avec $_route par exemple

- _locale (Request::getLocale() est mieux)
- _controller
- _format (html, json...)
- _fragment
- _route
- _route_params

## Domain Matching

## Conditional Request Matching

Besoin de `symfony/expression-language` et attention, les routes peuvent être générées, même si elles ne peuvent pas être atteintes par la personne qui la voit, rien ne bloque.

On peut matcher à partir de la méthode également

## Locale Guessing

```yaml
# config/packages/translation.yaml
framework:
  set_locale_from_accept_language: true
  set_content_language_from_locale: true
```

Service `LocaleSwitcher` est récent, mais bien pratique !
