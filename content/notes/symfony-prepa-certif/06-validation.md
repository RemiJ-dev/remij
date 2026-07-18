---
date: "2026-07-31"
formateur: "Guillaume Loulier"
---

# Data Validation

Le Validator ([JSR 303](https://jcp.org/en/jsr/detail?id=303)) sert à appliquer une contrainte sur une propriété (par exemple).

On peut valider :
- des valeurs simples
- des objets et des propriétés de classes
- des structures complexes imbriquées avec une logique custom

Utilise le composant PropertyAccess pour récupérer les valeurs des attributs qui ont des contraintes

On peut mettre une contrainte sur
- une propriété
- une méthode (getters, haser ou isser, pas autre chose, à cause du PropertyAccess)
- une classe

## Contraintes intégrées

`#[Assert\Valid]` permet la validation d'un sous-objet (et de leurs propriétés ayant des contraintes)

## Groupes

Validation différente en fonction du contexte.

Paramètre `groups` sur les contraintes.

Groupes existants par défaut :
- Default (= pas de groupe de validation)
- ClassName (pas FQCN, juste nom de la classe)

## Séquences

Appliquer des groupes de validation dans l'ordre (si le premier échoue, on ne passe pas au second).

## Custom callback

`#[Callback]` sur une méthode qui ne sert qu'à la validation. Reçoit un `ExecutionContextInterface` pour ajouter les violations.

Validation métier dépendant de la logique et pas forcément d'un formulaire.

## Violation Builder

Construire la violation et ajouter les informations supplémentaires si besoin (et lie à un path).


