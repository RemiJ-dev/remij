# Connexion et sécurisation

## Plan

### Première partie

- Introduction
- Installation du composant `security`
- Principes du composant / Fonctionnement
  - Pourquoi ce composant ? Simplification du processus, annotations/attributs
  - Comment fonctionne-t-il ? Explication rapide du fonctionnement
- Mise en place d'un utilisateur et de la connexion
  - Création du user (+ création en BdD)
  - Création du auth
  - Configuration pour connexion sur EasyAdmin
  - Sécurisation des routes
- Création / modification des utilisateurs dans EasyAdmin malgré le hachage

### Deuxième partie

- Connexion JWT pour certaines routes
- Jeton JWT pour ne récupérer/gérer que ses recettes et seuls admins peuvent modifier les données de base
- Conclusion

## Fiches

04:14 : Découverte du JWT (@Grafikart.fr) : https://www.youtube.com/watch?v=S-xBAo47W58
04:20 : Authentification JWT (@Grafikart.fr) : https://youtu.be/XPXrNI-fux4
12:08 : Authentification Refresh JWT (@Grafikart.fr) : https://youtu.be/G5rsq2Gc6qM

## Description

### Première partie

Aujourd'hui sur Drakolab, on avance le projet Recettes en ajoutant une brique essentielle, mais pas toujours simple à comprendre : la sécurité. 

Il s'agit ici de restreindre l'accès à certaines parties du site (notre zone d'administration) aux utilisateurs connectés ayant reçu l'autorisation (ceux enregistrés en tant qu'administrateurs).

C'est aussi l'occasion de parler de hachage de mots de passe, du bundle de sécurité de Symfony et des Event Subscribers (et listeners).

Dans la prochaine vidéo du projet, nous verrons comment mettre en place un token JWT pour gérer l'authentification et la sécurité côté API.

Rendez-vous dans un mois pour la suite de cette playlist !

Sommaire

00:00 Introduction
05:05 Fonctionnement général (théorie)
11:56 Création de l'entité User (make:user)
16:53 Personnalisation de l'entité 
21:27 Création de la migration
25:04 Formulaire de connexion (merci EasyAdmin)
33:40 Erreur de format pour les rôles
34:22 La connexion fonctionne !
34:27 Sécurisation de l'espace d'administration
41:33 Modification des Users depuis EasyAdmin
46:47 Hashage et événements EasyAdmin
01:04:45 Conclusion


### Deuxième partie

Aujourd'hui sur Drakolab, on avance la sécurité du projet Recettes en prévoyant la connexion pour le front : on met en place la connexion par token JWT. 
Le but est de ne pas retenir l'état de la connexion du côté de l'API, mais seulement côté utilisateur (on dit que notre API est "stateless" ou sans états) et on autorise l'utilisateur à nous envoyer les informations (préalablement vérifiées et sécurisées) pendant une certaine durée.

Pour cela, nous allons essayer de comprendre le fonctionnement et le cas d'utilisation de JWT, puis installer Lexik JWT Authentication Bundle (https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/index.html) pour l'utiliser dans notre API.

La prochaine vidéo du projet sera consacrée à la préparation de notre serveur et à la mise en ligne de notre API. Il est également très probable que l'on mette en place nos scripts de déploiement, pour tester le fonctionnement du serveur.


Pull Request associée : https://github.com/Drakolab-yt/recettes-api/pull/12

Documentation sur JWT d'API Platform : https://api-platform.com/docs/core/jwt/

Les resources de @Grafikart.fr qui m'ont permis de comprendre le JWT et de le mettre en place simplement : 
- Découverte du JWT : https://www.youtube.com/watch?v=S-xBAo47W58
- Authentification JWT : https://grafikart.fr/tutoriels/api-platform-auth-jwt-1915
- Authentification Refresh JWT : https://grafikart.fr/tutoriels/api-platform-auth-jwt-refresh-1916


À très bientôt pour la suite de cette playlist !


Sommaire

00:00 Introduction
02:14 Objectifs
04:09 JWT (JSON Web Token), qu'est-ce que c'est ?
10:13 L'implémenter dans notre application
11:12 Pourquoi le JWT ?
13:07 Mise en place de LexikAuthenticationBundle
16:11 Debrief post-développement
24:46 Vérification de la sécurité et correction d'un bug
31:54 Résumé du déroulé et des resources utilisées 
39:00 Conclusion

## Posts RS

### LinkedIn

Bonjour tout le monde !

Aujourd'hui sur Drakolab, on avance le projet Recettes en ajoutant une brique essentielle, mais pas toujours simple à comprendre : la sécurité. 

Lien vers la vidéo : https://youtu.be/AFwRL07tF1w

Il s'agit ici de restreindre l'accès à certaines parties du site (notre zone d'administration) aux utilisateurs connectés ayant reçu l'autorisation (ceux enregistrés en tant qu'administrateurs).

C'est aussi l'occasion de parler de hachage de mots de passe, du bundle de sécurité de Symfony et des Event Subscribers (et listeners).

Dans la prochaine vidéo du projet, nous verrons comment mettre en place un token JWT pour gérer l'authentification et la sécurité côté API.

Rendez-vous dans un mois pour la suite de cette playlist !

### Twitter

Aujourd'hui sur Drakolab, on avance le projet Recettes en ajoutant une brique essentielle, mais pas toujours simple à comprendre : la sécurité. 

https://youtu.be/AFwRL07tF1w

### Deuxième partie

### LinkedIn

Bonjour tout le monde !

Aujourd'hui sur Drakolab, on ajoute la sécurité sur l'API à l'aide d'un jeton JWT (JSON Web Token). 

Lien vers la vidéo : https://www.youtube.com/watch?v=GdmODuNxX_E

Il s'agit ici de restreindre l'accès aux API selon certains critères :
- Les utilisateurs peuvent modifier leurs recettes et leurs informations d'utilisateur
- Les administrateurs peuvent modifier toutes les recettes et les informations de tous les utilisateurs

Nous parlons de : 
- Jeton JWT : qu'est-ce que c'est, pourquoi on s'en sert et comment le mettre en place sur notre API
- API stateless (sans état) : notre API ne doit pas retenir d'informations de connexion et nous faisons en sorte que l'utilisateur envoie les informations nécessaires à chaque requête

Dans la prochaine vidéo du projet, nous allons configurer le serveur et mettre en ligne une première version du site.

À bientôt pour la suite de cette playlist !

### Twitter

Aujourd'hui sur Drakolab, on avance le projet Recettes en ajoutant une connexion par token JWT sur l'API. Ainsi, seuls les auteurs des recettes et les admins peuvent les modifier.

https://youtu.be/AFwRL07tF1w

