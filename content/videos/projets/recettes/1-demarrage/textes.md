# Démarrage du projet Symfony

## Plan

- Démarrage du timer
- Installation de Symfony 
  - choix du dossier de rangement
  - utilisation de la commande Symfony pour créer le projet
  - push des premiers commits sur main
  - création de la branche dédiée (avec Trello)
- Explication des dossiers et fichiers importants
- Mise en place des outils
  - `.gitignore` (`.idea`)
  - php cs fixer
  - php stan
  - docker-compose
  - Makefile

### Fiches

01:40:00 : playlist Xavki (docker compose) : https://www.youtube.com/playlist?list=PLn6POgpklwWqaC1pdx02SrrgOaL2ZL7G0

## Description

Dans cette vidéo, on démarre le projet Symfony en initialisant les fichiers, puis en ajoutant quelques outils pour nous simplifier la vie.

Sommaire :

00:00 Introduction
01:13 Gestion de projet
01:54 Création du projet sur GitHub
03:39 initialisation du projet local
06:54 Premier push sur GitHub
16:17 Fonctionnement de composer 
28:50 Commandes de composer et installation de dépendances
43:05 Composer en bref 
47:40 Premier commit
52:49 Premier push
55:08 La structure de Symfony
58:07 les fichiers .env en détail
01:02:54 Résumé du .env
01:04:53 Le dossier templates/
01:05:28 Le dossier src/
01:08:17 Le dossier public/
01:08:58 Le dossier migrations/
01:08:10 Le dossier config/ et les fichiers yaml
01:10:54 Le dossier bin/ et la console de Symfony
01:11:43 Php CS Fixer et normes PSR
01:21:59 Php Stan, pour anticiper les erreurs
01:27:31 Mise en place de docker-compose
01:33:25 Trouver des images sur Docker Hub
01:41:42 Le fichier docker-compose.yml en détails
01:49:12 Makefile (une commande pour les centraliser toutes)
01:55:17 Commit / push final et relecture
01:59:56 Conclusion

Les resources mentionnées dans la vidéo :

- La (très bonne) chaîne de @xavki : https://www.youtube.com/c/xavki-linux
- Sa playlist Docker Compose : https://www.youtube.com/playlist?list=PLn6POgpklwWqaC1pdx02SrrgOaL2ZL7G0

Dans l'ordre, on va :
- utiliser la commande symfony pour démarrer un projet
- détailler la structure et les fichiers de base d'un projet Symfony
- mettre en place les différents outils
  - PHP CS Fixer (https://cs.symfony.com/)
  - php Stan (https://phpstan.org/)
  - docker (grâce à docker-compose et un ensemble d'images Docker déjà prêtes)
  - Makefile (outil pour centraliser les différentes commandes)
- utiliser Git et GitHub pour versionner, relire et valider nos modifications

L'ensemble des modifications se trouvent dans la PR associée : https://github.com/Drakolab-yt/recettes-api/pull/1

Une vidéo longue et plutôt dense, pour mettre en route notre projet et partir sur de bonnes bases ;) .

Dans la prochaine vidéo, nous créerons notre MCD (modèle conceptuel de données), pour avoir une bonne représentation de notre base de données et créerons nos entités.

À très bientôt pour la suite de cette playlist :)