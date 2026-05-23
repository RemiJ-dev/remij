# Cours Symfony - Doctrine

## Fiches

https://symfony.com/doc/current/doctrine.html
https://www.doctrine-project.org/projects/doctrine-orm/en/2.16/index.html

## Description

Bonjour tout le monde !

Aujourd'hui, dans le cours Symfony, nous faisons en sorte de remplir nos tables avec des données. On va voir comment ajouter (brutalement) des données depuis un contrôleur, avant de créer des objets de Fixtures pour remplir nos tables avec de fausses données. Nous verrons également (rapidement) quelques outils pour avoir des données plus cohérentes et, surtout, aléatoires. 

Documentations :
- Doctrine dans Symfony : https://symfony.com/doc/current/doctrine.html
- Celle de Doctrine : https://www.doctrine-project.org/projects/doctrine-orm/en/2.16/index.html

Outils utiles : 
- La librairie Faker : https://fakerphp.org/
- Le bundle Alice de Nelmio : https://github.com/theofidry/AliceBundle
- Le bundle Foundry de Zenstruck : https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html

Projet fil rouge : https://github.com/Drakolab-yt/blog

Pull Request associée : https://github.com/Drakolab-yt/blog/pull/9

À très bientôt pour la suite de ce cours !

Sommaire

00:00 Introduction
01:56 EntityManagerInterface
05:18 Utilisation de persist() et flush() 
11:28 Récupérer la liste des articles
14:32 La méthode getRepository() pour récupérer la liste
16:01 Suppression avec remove() et flush()
18:51 Installation et première fixture avec DoctrineFixturesBundle
22:27 L'option append
24:44 Des fixtures dépendantes les unes des autres
29:44 Utilisation de Faker pour de l'aléatoire
37:40 D'autres outils pour créer simplement des fixtures complexes
39:37 Conclusion
