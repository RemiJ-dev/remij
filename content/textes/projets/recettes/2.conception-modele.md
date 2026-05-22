# Conception du MCD

## Fiches

- 03:01 : VuePress (https://vuepress.vuejs.org/)

## Description

Dans cette vidéo, on crée notre Modèle Conceptuel de Données (MCD) pour notre site de recettes.

Sommaire

00:00 Introduction
01:39 Demande initiale
02:54 Analyse de l'existant
04:39 D'autres sites de recettes
08:59 Schéma (MCD)
22:12 Conclusion 

Dans un premier temps, il s'agit de bien comprendre la demande initiale (relativement succinte) et de voir d'autres sites existants, pour inspiration, mais aussi enrichir notre propre site.
À partir de ces réflexions, on va créer un diagramme de classes pour préparer le travail de création des entités. 
Notre schéma contiendra :
- les entités
- les relations entre ces entités
- les propriétés (avec leur type)

Le schéma a été créé directement dans PhpStorm, à l'aide du plugin Diagrams.net Integration (https://plugins.jetbrains.com/plugin/15635-diagrams-net-integration).

Dans la vidéo suivante, nous créerons nos entités et mettrons notre base de données à jour grâce aux migrations.

La Pull Request pour cette vidéo et la suivante est sur GitHub : https://github.com/Drakolab-yt/recettes-api
Le schéma est visible sur le README du projet (https://github.com/Drakolab-yt/recettes-api#le-sch%C3%A9ma-dentit%C3%A9s) ou dans le fichier dédié (https://github.com/Drakolab-yt/recettes-api/blob/main/docs/mcd.svg)

À très bientôt pour la suite de cette playlist :)

## Post LinkedIn

Nouvelle vidéo sur Drakolab ! On conçoit notre schéma de base de données (BdD).

Après avoir mis en place Symfony et quelques outils de qualité de code, on passe à une étape cruciale du projet : réfléchir au MCD (modèle conceptuel de données). On va donc essayer d'organiser les éléments à stocker en BdD en différentes tables, et définir ce qui doit y être stocké ou non. Pour se simplifier la tâche pour la suite, on va directement dessiner un diagramme de classes, avec les relations et les propriétés, nous permettant de rester au plus près de ce qu'on créera avec Doctrine.

La vidéo suivante sera sur la création des entités (classes PHP liées à la BdD) à l'aide de Doctrine et à la factorisation du code généré.

https://www.youtube.com/watch?v=g4xVe_LjGXs

#symfony #php #projet #drakolab #mcd