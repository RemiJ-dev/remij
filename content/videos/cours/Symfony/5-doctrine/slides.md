---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Doctrine et la BdD"
---

# Doctrine et la <abbr title="Base de Données">BdD</abbr>

- Définitions
- Installation
- Créer une entité
- Avoir une table en <abbr title="Base de Données">BdD</abbr>
- Manipuler des données
- Des entités et des routes

## Définitions

- <abbr title="Object Relational Mapping">ORM</abbr>
- Doctrine

## Installation et principes

- `composer require symfony/orm-pack`
- `composer require --dev symfony/maker-bundle`
- Fonctionnement général

## Créer une entité

- `bin/console make:entity`
  - Créer une entité
  - Ajouter des propriétés
- Les attributs et leurs options

## Des relations entre nos entités

- Créer une seconde entité
  - Ajouter quelques propriétés
  - Ajouter une relation entre nos entités
- Relation bi-directionnelle

## Avoir une table en <abbr title="Base de Données">BdD</abbr>

- Créer une migration avec `make:migration`
- Lancer les migrations avec `doctrine:migrations:migrate`
- Gérer les migrations sur le long terme
  - Accumulation des migrations
  - Changements de branche pendant le développement

## Manipuler des données

- EntityManagerInterface
  - Requêtes d'insertion, de mise à jour et de suppression
  - Méthodes `persist()`, `remove()` et `flush()`
- Repository
  - Requêtes de récupération
  - Méthodes `find*` et `QueryBuilder`

## Des entités et des routes

- Le [`EntityValueResolver`](https://symfony.com/doc/current/doctrine.html#automatically-fetching-objects-entityvalueresolver)
- L'attribut [`MapEntity`](https://symfony.com/doc/current/doctrine.html#mapentity-options)

## Étendre Doctrine dans Symfony

- [Stof Doctrine Extensions Bundle](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)
  - Ajouter des comportements
- [beberlei Doctrine Extensions](https://github.com/beberlei/DoctrineExtensions)
  - Ajouter des fonctions SQL non présentes

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)