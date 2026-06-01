---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Doctrine - Enregistrer des données"
---

# Enregistrer des données

- `EntityManagerInterface`
- Les méthodes `persist()` et `flush()`
- Remplir la base : des Fixtures
- Des outils de fixtures

## `EntityManagerInterface`

- Gestionnaire des entités
- Permet d'enregistrer et d'accéder aux repositories
- D'autres méthodes plus rarement utiles

## Les méthodes `persist()` et `flush()`

- La [documentation sur le sujet](https://symfony.com/doc/current/doctrine.html#persisting-objects-to-the-database)
- `persist()` pour préparer l'enregistrement
- `flush()` pour effectivement enregistrer

## Remplir la base : des Fixtures

- [`DoctrineFixturesBundle`](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)
- Créer une première fixture
- Créer des fixtures dépendantes les unes des autres
- Charger les fixtures `php bin/console doctrine:fixtures:load`
- L'option `--append`

## Des outils de fixtures

- La librairie [Faker](https://fakerphp.org/)
- Le bundle [Alice de Nelmio](https://github.com/theofidry/AliceBundle)
- Le bundle [Foundry de Zenstruck](https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html)

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)