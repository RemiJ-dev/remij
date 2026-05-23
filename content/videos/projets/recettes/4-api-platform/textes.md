# API Platform

## Plan

- Intro
- Installation API Platform (composer)
- Configuration (on enlève l'araignée)
- Ajout de ApiResource aux entités
- Démonstration de la doc
  - Affichage
  - Ajout d'un objet simple (Source)
  - Ajout d'un objet plus complexe (Recipe) et difficultés
- Enlever les routes inutiles
- La sérialisation
  - Explications
  - En pratique avec les groupes
  - Les groupes pour des sous-entités
- Conclusion


## Fiches

38:41 @GrafikArt nommage des groupes de sérialisation https://www.youtube.com/playlist?list=PLjwdMgw5TTLU7DcDwEt39EvPBi9EiJnF4

## Description

Dans cette vidéo, on installe API Platform dans notre projet Symfony et on crée des routes pour toutes nos entités. Gros avantage : c'est très simple et très rapide.

On parcourt ensuite la documentation, pour personnaliser les routes disponibles et la manière de récupérer des données. On veut, par exemple, récupérer toutes les données d'une recette d'un coup, tant la recette que les ingrédients associés, ses images, etc. 

C'est l'occasion de voir plus en détail le fonctionnement de la sérialisation et les possibilités qu'elle nous offre.

Sommaire

00:00 Introduction
00:47 Prise du ticket, timer et branche
02:25 Installation de API Platform
03:36 Documentation de notre API
04:20 Créer nos routes et les tester
15:21 Configuration 
22:31 Choisir les routes adaptées
31:42 La sérialisation
35:05 Des groupes de sérialisation
52:41 Conclusion et suite 

PR associée : https://github.com/Drakolab-yt/recettes-api/pull/5

Les différents verbes HTTP : https://developer.mozilla.org/fr/docs/Web/HTTP/Methods

Dans la prochaine vidéo, nous installerons Vich Uploader Bundle pour gérer l'envoi des images (tant le rangement dans un dossier que le lien avec la BdD).

À très bientôt pour la suite de cette playlist :)