# Vich Uploader

## Plan

- Pourquoi VichUploader
- Installation (https://github.com/dustin10/VichUploaderBundle)
  - composer require
  - [OFF] chown
- Configuration
  - Lien entre entités et fichiers (mapping)
- Ajout des attributs dans `Image`
- Namer et DirectoryNamer
  - Création d'un DirectoryNamer
    - Où le ranger ?
- Test dans la prochaine vidéo !

## Fiches

04:51 LiipImagineBundle (https://symfony.com/bundles/LiipImagineBundle/current/index.html)
05:14 Paramètres https://symfony.com/doc/current/configuration.html#configuration-parameters

## Description

Dans cette vidéo, on installe Vich Uploader Bundle dans notre projet Symfony. Ce bundle va nous permettre de gérer le rangement des fichiers lors de leur upload et les lier dans notre base de données.
Dans cette vidéo, nous n'allons pas encore en voir l'usage, mais l'outil servira dans les prochaines vidéos (Fixtures et EasyAdminBundle) et nous gagnera pas mal de temps ;) .

Sommaire

00:00 Introduction
01:05 Installation de VichUploader
01:30 Configurations
06:37 Fonctionnement du SmartUniqueNamer
09:11 Ajout des attributs dans l'entité
11:57 Comment VichUploader traite-t-il les données ?
17:40 Les namers de VichUploader
20:12 Un nom de dossier lié à l'entité (DirectoryNamer)
31:21 Conclusion

PR associée : https://github.com/Drakolab-yt/recettes-api/pull/7

LiipImagineBundle : https://symfony.com/bundles/LiipImagineBundle/current/index.html (mentionné à 04:51)
Les paramètres de Symfony : https://symfony.com/doc/current/configuration.html#configuration-parameters (mentionné à 05:14)

Dans la prochaine vidéo, nous créerons un jeu de fausses données (fixtures) pour avoir une BdD remplie et nous permettre de tester correctement notre site.

À très bientôt pour la suite de cette playlist :)

## Posts

Nouvelle vidéo, sur l'installation et la configuration de VichUploader dans le projet Recettes.

Ce bundle de gestion d'image s'intègre parfaitement avec les formulaires de Symfony et Doctrine, il serait dommage de s'en passer ;).

https://www.youtube.com/watch?v=KJ62Or94P0E