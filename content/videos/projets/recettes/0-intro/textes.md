# Introduction au projet Recettes

## Plan

- Introduction au concept 
  + Projet de A à Z, dont plusieurs éléments me sont inconnus
  + Utilisation de plusieurs technos et outils, dont plusieurs que je ne connais/maîtrise pas
  + Explications au fur et à mesure, depuis 0
- Méthodologie
  + Présentation des problèmes rencontrés, des solutions trouvées et une partie du code en direct
  + Code disponible sur GitHub
  + Enregistrements à des moments divers, mais diffusion d’une vidéo par quinzaine / par mois
  + Suivi des tâches sur Trello et avancement du projet à chaque vidéo
- Présentation des outils utilisés
  + Trello
  + Git + GitHub 
  + CI/CD (habitudes GitLab)
  + Symfony + composer
  + VueJS + Quasar + npm
  + Docker et docker-compose
  + Serveur (Debian 11, etc.)

## Rédaction

### Introduction / concept

Bonjour tout le monde,

Dans cette vidéo, je vais vous présenter un peu le fonctionnement de cette playlist. 

L’idée :
- projet de A à Z
- découvrir différentes technologies et outils. 

Concept :
- site de recettes
- chercher des recettes, 
- filtrer des listes en fonctions de restrictions (végé, végan, sans gluten, etc.)
- trouver quoi préparer 
- utilisable sur mobile
- application mobile à l'avenir =>

2 sites distincts : 
- Le back : une API, faites avec Symfony (Framework PHP que je connais bien)
- Le front : une PWA (Progressive Web App) réalisée avec VueJS et Quasar que je connais très peu.

+ outils :
- environnement de travail
- intégration continue
- Makefile

Tous outils pas maitrisés => introduction à ma manière d'apprendre 

Connaissances préalables :
- POO
- Git / gestion de version

### Méthodologie

- Partie du code en live coding (points essentiels)
- présentation des problèmes rencontrés et des solutions trouvées
- Code (lien vers PR) sur GitHub
- Projet lié à un tableau Trello =>

### Outils utilisés

#### Trello

[Trello](https://trello.com/) est un outil de gestion de projet, permettant de créer des tickets pour les différentes tâches à accomplir et de les organiser dans des colonnes (listes). Je l'utilise de manière assez proche d'un [Kanban](https://fr.wikipedia.org/wiki/Kanban_(d%C3%A9veloppement)), pour voir rapidement où j'en suis, ce qu'il reste à faire et où chaque tâche en est. Comme vous pouvez le voir, j'ai actuellement 7 colonnes :
- Resources : toutes les ressources qui vont me suivre tout au long du projet (MCD, maquettes, etc.)
- Backlog : tous les tickets à faire dans un futur plus ou moins proche. C'est ici que je vais noter les bugs ou les éléments à faire plus tard. Vous savez, ceux qu'on oublie tout le temps parce qu'on les a noté sur un post-it...
- To Do : les tickets à faire prochainement. Normalement, ce sont les tickets du sprint en cours, mais dans notre cas, ce seront les tickets traités dans la vidéo
- In Progress : les tickets en cours. Cette colonne sert surtout à indiquer à des collègues sur quoi chacun travaille actuellement
- To Review : les tickets traités, à faire relire par des collègues ou d'autres devs. En cas de retours, les tickets re-parent dans To Do
- Done : les tickets terminés, en attente de fusion et de mise en ligne

Remarquez que sur chaque ticket Trello, j'ai le numéro affiché. C'est une extension Firefox qui fait ce travail-là et je vous mets le lien en description. Elle n'est pas essentielle, mais me fait gagner un peu de temps.

-- https://github.com/fain182/trello-extras --

Ça va donc être le point central de la gestion du projet !

#### Git + GitHub

[Git](https://git-scm.com/) et [GitHub](https://github.com/) vont être nos outils pour versionner le projet, le sauvegarder en ligne et permettre de travailler à plusieurs si besoin. C'est aussi un outil assez central, et je vais travailler comme lorsque je travaille avec mes collègues.

En somme, chaque ticket Trello va être lié à une branche, chaque branche contiendra le nom du ticket

-- **Prendre exemple https://trello.com/c/WpxYXoRa/1-conception-mod%C3%A8le-mcd pour créer une branche feature/1-conception-modele-mcd** --

En général, je suis fainéant et je prends simplement le slug du ticket pour créer ma branche. Ici, j'adapte un peu pour enlever les caractères spéciaux et je précise que c'est une fonctionnalité dans le nom de la branche, en préfixant par `feature/`.

Nous verrons au fur et à mesure du projet comme cela se traduit concrètement !

#### Toggl

J'utilise aussi un outil de suivi de temps, qui me sert aussi parfois de chronomètre Pomodoro.

#### CI/CD

Nous verrons également plusieurs outils intégrés au développement de notre projet, comme les tests, la vérification de la qualité du code, les déploiements (car nous allons mettre les nouveautés en ligne trèèèès rapidement) et bien d'autres. Nous allons voir pour exécuter ces tâches au fur et à mesure du développement. En général, le gros des tâches de vérifications vont être lancées sur les Pull Requests (autrement appelées PR) et la mise en ligne lors de la fusion des PR. Sur GitHub, c'est ce qu'on appelle les [actions](https://github.com/features/actions).

-- https://github.com/features/actions --

Le but est d'avoir un ensemble de vérifications **automatiques** de notre code, pour s'assurer de sa qualité et diverses actions nous simplifiant la vie au quotidien. Les déploiements peuvent être longs sur certains projets... Et on veut éviter de bloquer un développeur pendant ce temps !

Je suis habitué à utiliser les outils de GitLab, un concurrent de GitHub, donc je vais découvrir un peu en route et adapter ce que je connais déjà.

#### Symfony

Pour le back (la partie logique, que les utilisateurs ne voient pas), je vais utiliser le framework Symfony, dans sa version 6 (qui est la plus récente au moment où je tourne) pour créer une API qui me permettra de stocker mes données et de les renvoyer de manière structurée. On y reviendra plus longuement lors de la mise en route du projet.

#### VueJS + Quasar

Pour le front (ce que les utilisateurs voient), je vais utiliser les frameworks [VueJS 3](https://vuejs.org/) et [Quasar](https://quasar.dev/), qui devraient me permettre de construire une interface sympa rapidement. C'est la partie que je maîtrise le moins, donc attendez-vous à pas mal de quacks et n'hésitez pas à m'envoyer les bonnes pratiques si vous les connaissez ou à me corriger !

#### Docker et Docker-compose

Pour l'environnement de travail, je suis parti sur un outil dont on se sert beaucoup chez Drakona : Docker. Comme nous nous sommes déjà créé quelques outils sur mesure, je n'hésiterai pas à m'en servir et à vous les présenter. L'idée est d'avoir un environnement de travail clé en main et proche du serveur final, sans avoir besoin d'installer plusieurs versions des programmes. Par exemple, les projets vont utiliser NodeJS 16 et PHP 8.1, mais ça n'est pas le cas de mes projets clients. Si je veux passer d'une version à l'autre sur ma machine, cela peut être plus ou moins compliqué, alors qu'avec Docker, il me suffit de lancer mes conteneurs et le tour est joué.

### Serveur

Enfin, et c'est l'un des éléments les plus importants, il va falloir que je mette mon site en ligne. Pour ça, je vais me servir d'un serveur déjà existant, dont je me sers pour d'autres projets. C'est un VPS (serveur privé virtuel) avec Debian 11. Il est déjà configuré et n'attend plus que le code !




### Conclusion

Voilà, vous avez un aperçu de ce dont on va parler dans les nombreuses autres vidéos de cette playlist !
Dans la suite, nous allons initialiser le projet sur GitHub et en local, préparer un environnement de travail, puis nous passerons à la conception des différentes composantes de ce projet.

À très bientôt et portez-vous bien !

## Description de la vidéo 

Bonjour tout le monde,
Dans cette vidéo, je vous présente le fonctionnement de cette playlist.

Sommaire :

00:00 Introduction
00:26 Concept de la playlist
01:27 Connaissances préalables
02:09 Le projet
03:17 Technos utilisées
04:01 Méthodologie
05:43 Liste des outils
07:11 Trello
12:03 Git et GitHub
19:41 Toggl
21:55 GitHub Actions (CI/CD)
23:33 Symfony et API Platform
26:34 VueJS Quasar
31:47 Docker et Docker-compose
33:00 Serveur (VPS)
34:03 Conclusion et suite

Nous allons réaliser un projet de A à Z, en utilisant les frameworks Symfony 6 (avec php 8.2), VueJS 3 (avec NodeJS 16) et Quasar. 

Ce projet sera un site de recettes, composés de 2 applications : 
- une API (réalisée en Symfony)
- un front (en VueJS/Quasar)

Le site permettra d'afficher des recettes, de chercher dans le site avec différents critères :
- en fonction de restrictions alimentaires (végétarien, végan, sans gluten, etc.)
- par texte
- par ingrédients (pour trouver en fonction du contenu de mon frigo et de mes placards)

Pour ce faire, nous allons utiliser un ensemble d'outils, présentés dans la vidéo :
- Symfony (https://symfony.com/doc/current/index.html) pour le code de notre API
- VueJS (https://vuejs.org) et Quasar (https://quasar.dev/) pour l'affichage du site
- Trello (https://trello.com/) pour la gestion de projet (avec https://github.com/fain182/trello-extras pour ajouter des numéros de ticket)
- Git (https://git-scm.com/) et GitHub (https://github.com/) pour la gestion de version
- Toggl (https://track.toggl.com/timer) pour le suivi de temps
- GitHub Actions (https://github.com/features/actions) pour l'intégration continue 
- Docker (https://www.docker.com/) pour les environnements de travail
- Un serveur (VPS déjà configuré) pour héberger nos sites

Tous ces outils vont être détaillés dans les vidéos suivantes, que je vous invite à suivre.

À très bientôt pour la suite de cette playlist :)

## Post LinkedIn

Bonjour tout le monde :)

Dans cette vidéo, on dévoile une série ambitieuse : réaliser un projet de A à Z, avec Symfony (6) et VueJS (3).

https://www.youtube.com/watch?v=7lLjwkQUhhM&t=130s

Vous ne connaissez pas Symfony, ni VueJS ? Ça tombe bien, très peu de connaissances sont nécessaires :
- Php orienté objet (https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php)
- des bases de Git et de GitHub (https://openclassrooms.com/fr/courses/7162856-gerez-du-code-avec-git-et-github)

Nous allons réaliser un site de recette en 2 parties : 
- une API (avec Symfony et le formidable API Platform (https://api-platform.com/))
- une application front en VueJS avec Quasar (https://quasar.dev/)

Bien entendu, c'est aussi l'occasion de présenter et d'utiliser d'autres outils utiles au quotidien d'un dev web :
- Git
- GitHub
- Trello
- Docker (avec docker-compose)
- un Makefile
- et bien d'autres

À très vite pour la suite !