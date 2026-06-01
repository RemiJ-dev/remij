---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Doctrine - Installation et principe"
---

# Doctrine et la <abbr title="Base de Données">BdD</abbr>

- Définitions
- Installation
- Principes généraux

## Définitions

- <abbr title="Object Relational Mapping">ORM</abbr>
- Doctrine

## Installation

- Base : `composer require symfony/orm-pack`
- Pour générer les entités : `composer require --dev symfony/maker-bundle`

## Principes généraux

| Type d'objet           | Utilité                                                                    |
|------------------------|----------------------------------------------------------------------------|
| Entité                 | lien entre code et table                                                   |
| Migration              | appliquer les modifications de la <abbr title="Base de Données">BdD</abbr> |
| Repository             | récupérer depuis la table                                                  |
| EntityManagerInterface | insérer / modifier / supprimer des entrées                                 |

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)