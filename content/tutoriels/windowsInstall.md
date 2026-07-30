---
title:          "Installation Windows"
description:    ""
publishedAt:    "2026-07-30"
lastModified:   ~
authors:        ["remij"]
tags:           ["admin sys", "tutoriel"]
---

## Git

- [Télécharger la dernière version](https://git-scm.com/download/win)
- Lancer l'installeur. Recommandation : installer Git dans la ligne de commande Windows (c'est une option proposée durant l'installation).
- Si besoin, un [tuto de Grafikart](https://www.grafikart.fr/formations/git) est disponible pour en expliquer le fonctionnement et en particulier [l'installation de git pour Windows](https://www.grafikart.fr/tutoriels/install-git-windows-582)

## Docker

On se base sur [la documentation officielle de Docker pour Windows](https://docs.docker.com/docker-for-windows/install/). Attention, pour installer Docker, il faut une version bien à jour de Windows.

- [Télécharger l'installeur de Docker Desktop](https://hub.docker.com/editions/community/docker-ce-desktop-windows/)
- Lancer l'installeur
- Une fois l'installation complète, il est possible qu'il faille mettre à jour le noyau Linux (WSL2) et vous rendre sur cette page : [https://docs.microsoft.com/fr-fr/windows/wsl/wsl2-kernel](https://docs.microsoft.com/fr-fr/windows/wsl/wsl2-kernel). Si vous n'avez pas un message d'erreur vous demandant de l'installer, ne pas s'embêter avec cette étape
- Il est conseillé de faire le tutoriel pour bien vérifier que l'installation s'est faite correctement.

## PhpStorm

- Aller sur [la page de téléchargement de PhpStorm](https://www.jetbrains.com/fr-fr/phpstorm/download/)
- Lancer l'installeur téléchargé
- Lancer PhpStorm et entrer vos identifiants JetBrain
- Configurer ou récupérer votre configuration automatiquement (voir en bas à droite de l'écran, pour la synchronisation)

### Docker dans PhpStorm

En se basant sur [l'aide de PhpStorm sur Docker](https://www.jetbrains.com/help/phpstorm/docker.html), on obtient ça :

- Cliquer sur `Run > Edit Configurations...`
- Cliquer sur le "+" en haut à gauche de la fenêtre qui vient de s'ouvrir.
- Sélectionner `Docker > Docker-compose`
- Donner un nom au Run (Par défaut, `Docker-compose`)

Autres moyens de lancer ça (plus simples ;) ) :

- Faire un clic droit sur le fichier `docker-compose.yml` et cliquer sur le bouton "Run"

ou

- Ouvrir le fichier `docker-compose.yml` et cliquer sur les flèches à gauche de `services`
