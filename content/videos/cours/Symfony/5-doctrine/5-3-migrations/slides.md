---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Doctrine - Les migrations"
---

# Les migrations

- Définition
- Créer une migration
- Appliquer les migrations
- Appliquer ou annuler une migration

## Définition

- Une classe Php
- Ensemble de requêtes SQL
- Des versions de la BdD
- Pourquoi les migrations ?

## Créer une migration

- `php bin/console make:migration`
- `php bin/console doctrine:migrations:diff`

## Appliquer les migrations

- `php bin/console doctrine:migrations:migrate`

## Appliquer ou annuler une migration

- Appeler les méthodes `up` ou `down`
- `php bin/console doctrine:migrations:execute --down`

## Ranger les migrations

- `config/packages/doctrine_migrations.yaml`

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)