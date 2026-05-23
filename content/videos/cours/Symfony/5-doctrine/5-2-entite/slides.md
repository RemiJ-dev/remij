---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Doctrine - Créer des entités"
---

# Les entités

- Une entité
- Utiliser le Maker Bundle
- Sans le Maker Bundle
- Détail des attributs et options
- Les relations

## Une entité

- Classe PHP
- Informations pour Doctrine 
  - Attributs
  - Annotations
  - Yaml
  - ...
- 1 classe = 1 table
- 1 objet = 1 ligne

## Utiliser le Maker Bundle

- `bin/console make:entity`
- Permet de créer/modifier une entité :
  - un nom
  - un type
  - peut être `null` ?
  - ...

## Sans le Maker Bundle

- Créer soit même la classe
- Modifier les attributs / la configuration

## Détail des attributs et options

Sur la classe :
- `Entity` pour des options de classe
- `Table` pour des options de la table

Sur les propriétés :
- `Column` pour les options de la colonne

## Les relations

- Utiliser `make:entity` 
  - pour ne pas se tromper : type `relation` (assistant)
  - en connaissant déjà le bon type (`OneToMany`, etc.)
- Écrire directement les attributs et les méthodes (déconseillé)
- Des attributs spécifiques (`OneToMany`, `JoinColumn`, etc.)

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)