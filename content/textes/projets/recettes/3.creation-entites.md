# Création des entités

## Fiches

05:27 - Nommage des classes - https://www.php-fig.org/psr/psr-1/#3-namespace-and-class-names
24:27 - Doc de StofDoctrineExtensions - https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html

## Description

Dans cette vidéo, on se base sur notre MCD pour créer nos entités et créer les tables dans notre BdD (Base de Données).

Sommaire

00:00 Introduction
02:56 Fonctionnement des traits
04:34 Création de la première entité (Recipe) 
06:34 Les types de données possibles
12:14 Le code généré et ses attributs
19:31 Factorisation avec les traits
24:12 Stof Doctrine Extensions et Timestampable
32:23 Attributs ou annotations ?
34:27 Sluggable
36:15 Seconde entité
39:34 Relation entre deux entités
45:51 Configuration de Doctrine
48:10 Les migrations pour versionner le schéma de BdD
52:00 Exécuter les migrations
54:47 Rappel du fonctionnement des modifications de la BdD
57:21 Commit, PR et relecture
01:00:42 Conclusion

On utilise la commande make:entity pour créer nos entités (classes PHP, utilisable avec Doctrine) ou y ajouter des propriétés, mais aussi les relations avec les autres entités. 
Cette commande de génération nous demande chaque propriété que l'on veut ajouter et son type et rempli notre classe PHP avec les propriétés, leurs getters/setters et les attributs nécessaires au bon fonctionnement avec Doctrine. 
C'est aussi grâce à cette commande que l'on crée les relations entre les entités (qui ne sont rien de plus que des propriétés, mais avec des types particuliers).

On crée ensuite une ou des migrations, qui nous permettront de mettre à jour la BdD, ou de revenir en arrière en cas de soucis. On peut les créer quand on veut, j'en crée une seule une fois toutes les entités créées, mais ça n'est pas obligatoire. 

Il ne reste plus qu'à les exécuter pour que notre BdD soit mise à jour !

On répétera ces opérations si l'on met à jour les propriétés de nos entités, ce que l'on fera sûrement dans d'autres vidéos.

La prochaine fois, nous verrons comment intégrer API Platform à notre projet et avoir nos premières routes d'API.

À très bientôt pour la suite de cette playlist :)


## Post LinkedIn

Nouvelle vidéo sur Drakolab ! On crée nos entités et on initialise notre BdD avec Doctrine

À partir de notre schéma, réalisé dans la précédente vidéo, nous allons générer nos entités, grâce au maker bundle de Symfony ! Cet outil très pratique nous permet de créer/modifier nos entités, d'en définir les propriétés (et donc les relations) et génère les méthodes associées.

Nous allons aussi configurer Doctrine, pour accéder à notre BdD (dans le fichier .env) et mettre à jour nos tables en 2 étapes :
- Création d'une migration : fichier contenant les requêtes SQL à exécuter pour mettre à jour la BdD, mais aussi pour annuler ces modifications si besoin !
- Application des migrations : on exécute les migrations (non exécutées) pour effectivement modifier notre BdD

Dans la prochaine vidéo, on intégrera API Platform à notre projet et on créera nos premières routes d'API.

https://www.youtube.com/watch?v=C9XNmoA0r4o

#symfony #doctrine #php #projet #drakolab