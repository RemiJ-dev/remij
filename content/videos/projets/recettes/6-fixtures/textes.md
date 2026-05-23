# Fausses données

## Plan

- Installation / configuration (https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)
- Fonctionnement général
  - Création d'une première fixture (tag => TagFixtures)
    - Sauvegarde de données avec Doctrine
    - Utilisation de FakerPhp (https://fakerphp.github.io)
  - Ajout d'autres fixtures en lien (recipe)
    - Dépendances entre les fixtures
    - Injection de dépendances
      - Qu'est-ce qu'un service ?
      - Injecter des repositories
    - Fonctionnement des repositories
- Gestion des images
  - Prendre des images bidons
  - Créer la fixture correspondante
  - Lier à des étapes et recettes

## Fiches


## Description

Dans cette vidéo, on remplit notre BdD de fausses données (fixtures), uniquement utilisées pour le développement. C'est aussi l'occasion de parler des repositories de Doctrine, de la récupération de données dans la BdD et l'injection de dépendances.

Sommaire

00:00 Introduction
02:41 Notions importantes abordées
03:15 Prise du ticket
04:06 Installation de DoctrineFixturesBundle
05:06 Une première fixture (Tag)
11:56 Principes de Faker
14:08 Installation et recherche dans la doc
14:37 Utilisation dans la fixture (Tag) 
21:01 Récupérer un parent aléatoire
23:43 Un fichier de fixtures par entité
26:43 Lier deux fixtures (définir l'ordre d'exécution)
29:07 Récupérer depuis la BdD (intro aux repositories)
30:32 Injection de dépendances, principe et utilisation
33:45 services.yaml, là où la magie se produit
37:33 Points à retenir sur les services et l'injection de dépendances
37:50 Les méthodes par défaut des repositories
38:43 Récapitulatif après avoir fini les fixtures
40:17 Cas particulier des images et problèmes rencontrés
47:04 Conséquences de ces soucis et gérer les estimations de temps
50:18 Conclusion

Dans un premier temps, on installe DoctrineFixturesBundle et crée une première fixture simple.

Une fois cela fait, on va utiliser FakerPHP (librairie de génération de fausses données) pour générer des données plus crédibles (surtout en termes de volume et d'aléatoire).

On crée ensuite un fichier de fixtures pour chaque entité et on va les lier entre elles (et s'assurer qu'elles soient chargées dans le bon ordre). On utilisera les repositories pour récupérer des données déjà insérées avec les fixtures précédentes et on parlera donc d'injection de dépendances (concept central de Symfony).


La documentation sur les Fixtures : https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html
La documentation de FakerPHP : https://fakerphp.github.io

Pull Request associée : https://github.com/Drakolab-yt/recettes-api/pull/8

Fichier le plus complet, commenté pour plus d'explications : https://github.com/Drakolab-yt/recettes-api/pull/8/files#diff-8f951b9ff06d5ec88350bdc9d537d0969038419a0216b93501252dc8ddd9e969


Nous voilà maintenant avec une BdD remplie de données "réalistes" que l'on pourra tester.

À très bientôt pour la suite de cette playlist :)

## Posts

### LinkedIn

Nouvelle vidéo du projet Recettes, où l'on crée des fixtures (fausses données) pour notre environnement de dev. 
Elles nous permettront de tester notre application avec des données réalistes (mais pas réelles).

Pour en arriver là, nous devons aborder des notions importantes : 
- les services
- l'injection de dépendances
- les repositories (services liés à Doctrine permettant de modifier les entrées d'une table)

Un gros morceau qui va condenser des notions que nous allons utiliser par la suite !

#symfony #fixtures #doctrine

https://www.youtube.com/watch?v=4ht1sDPElrU

## Twitter

Nouvelle vidéo du projet Recettes sur les fixtures.

Notions importantes :
- les fixtures
- les repositories
- les services
- l'injection de dépendances

Un sacré morceau !

#symfony #fixtures #doctrine

https://www.youtube.com/watch?v=4ht1sDPElrU