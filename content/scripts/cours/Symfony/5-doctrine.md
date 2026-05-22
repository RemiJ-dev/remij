# Doctrine et la <abbr title="Base de Données">BdD</abbr>

> Face caméra, avec les slides derrière

Bonjour tout le monde,

Bienvenue sur DrakoLab, le laboratoire de Drakona.


Aujourd'hui, nous allons voir comment utiliser Doctrine pour manipuler une base de données (ou BdD pour faire plus court) dans un projet Symfony.

C'est une vidéo assez dense, où nous allons faire le tour du fonctionnement de Doctrine. Ce qui implique de comprendre :
- comment créer notre BdD
- comment créer des tables
- comment ajouter des entrées dans ces tables
- et comment les récupérer

Et vous allez voir qu'avec la couche d'abstraction que fournit Doctrine, tout cela nécessite de penser légèrement différemment, si vous n'avez pas l'habitude d'utiliser un ORM.

Il faut penser en termes d'objets **uniquement** et non plus en termes de BdD.

Après cette vidéo, vous ne m'entendrez d'ailleurs plus parler de BdD directement, mais toujours des entités, de leurs propriétés, etc.

J'insiste, tout passera par des classes et des objets. C'est ça le but d'un ORM : ne plus penser à la BdD.


Pour faire tout cela, nous allons passer par un ensemble d'objets et de commandes, que je vais vous détailler après quelques définitions.



## Définitions

Commençons directement par les gros mots et parlons de l'ORM.

Un ORM, pour Object Relational Mapping est un outil permettant de gérer une base de données sous forme d'objets. 

Le but est de s'affranchir (autant que possible) des contraintes purement liées à la BdD pour se concentrer sur nos objets et avec, malgré tout, une BdD pour persister nos données. 

Par exemple, on peut avoir une base de données aussi bien avec MySQL qu'avec PostGreSQL et, en théorie du moins, notre code sera identique, malgré les contraintes différentes de ces deux systèmes de gestion de base de données.

Le travail de l'ORM est donc, à partir de nos objets (qu'on va appeler Entités dans notre cas) de gérer la création, la modification, la suppression et la récupération des lignes de notre BdD.


Maintenant, Doctrine...

C'est un ensemble de librairies PHP (dont un ORM) permettant de manipuler notre base avec des objets, mais aussi de créer nos entités et des objets de manipulation. 

J'insiste sur le fait que le travail de Doctrine est de nous permettre de nous concentrer sur notre code (le PHP) et réduire radicalement la gestion de la BdD elle-même.

Il vient aussi résoudre certains problèmes liés au travail d'équipe et à la base de données (on reparlera des migrations un peu plus tard) à travers plusieurs outils, ou outils annexes que l'on pourra ajouter.


## Installation et principes

> PHPStorm uniquement



Vous noterez que je vous fais installer 2 paquets un peu spéciaux :

- symfony/orm-pack, qui installe Doctrine, son intégration dans Symfony et quelques outils bien utiles pour utiliser Doctrine dans Symfony

- symfony/maker-bundle, pour nous permettre de générer des classes qui vont nous être utiles. 
 
Notez qu'il est installé uniquement en mode de dev, ce n'est pas quelque chose que l'on veut en production, seulement quand on code.


Je me suis créé un projet vierge et minimal, mais vous verrez que ces deux paquets sont déjà installés sur notre projet de blog. 

C'est parce que nous avons demandé à créer une webapp, avec la commande symfony new.


> Créer une entité, un repository et une migration pour l'exemple


Maintenant, regardons un peu le fonctionnement général, et quels fichiers nous avons.

Tout d'abord, la configuration.

Dans `config/packages`, nous avons deux fichiers créés : doctrine.yaml et doctrine_migrations.yaml

Si vous avez regardé la vidéo précédente sur la configuration d'un projet Symfony, vous ne devriez pas être perdus (sinon, je vous invite à la regarder, bien évidemment) !

Le fichier doctrine.yaml est partagé en 2 parties : 

DBAL, pour la configuration du "dabatase abstraction layer", la partie qui gère la connexion à la BdD. Notez l'appel à une variable d'environnement, que nous allons mettre à jour dans un instant. 

ORM pour la configuration de l'ORM... C'est-à-dire configurer le lien entre nos entités et les tables (nommage des tables, où il peut trouver les entités, etc.)

Comme vous vous en doutez, je reviendrai un peu plus tard sur le fichier doctrine_migrations

Donc, qu'avons-nous à modifier dans cette configuration. Théoriquement, rien !

En pratique, si on range nos entités ailleurs que dans src/Entity, il faudrait qu'on modifie ces lignes "mappings", mais nous n'allons pas voir ce cas.

Et si on regarde plus haut, cette variable d'environnement doit être définie. 

Allons donc dans notre fichier .env et regardons notre variable DATABASE_URL. Nous allons la mettre à jour pour une configuration basique de mysql, mais il faudra bien évidemment l'adapter à votre cas.

Cette variable se décompose en 5 parties :

L'identifiant de BdD (je vais mettre root), le mot de passe (je n'en ai pas), l'adresse de MySQL (127.0.0.1 convient bien, je suis sur ma machine), le port (3306 est standard) et le nom de la base de données (je vais l'appeler `test`).

Je précise que nous n'avons pas besoin de créer la BdD depuis un outil externe, nous allons le faire à l'aide d'une commande Symfony tout de suite.

La commande `php bin/console doctrine:database:create` permet de créer la base de données... Et de tester si notre connexion (et notre fichier .env) est bonne !


## Créer une entité

Maintenant que le lien avec notre BdD fonctionne, nous pouvons commencer à créer des entités !

Rappelez-vous qu'une classe va correspondre à une table de notre base, et les propriétés à une colonne. 

De la même manière, un objet (une instance de cette classe), correspondra à une ligne dans cette table.

Pour créer une entité, nous pouvons utiliser une commande fournie par le MakerBundle : `make:entity`.

Elle nous permet à la fois de créer une entité, ou d'ajouter des propriétés à une entité existante. 

C'est bien pratique et ça évite de faire le fichier "à la main" !

Créons d'abord une entité `Tag`. 

Par défaut, elle va être rangée dans le dossier `src/Entity` et, pour le moment, ça va nous convenir.

Elle va avoir une seule propriété : un nom (name en anglais).

C'est une chaîne de caractères, que je vais arbitrairement limiter à 64 caractères. 

Notez que, si je ne connais pas les types disponibles, je peux les demander au maker en entrant un point d'interrogation comme type.

Plus qu'à remplir.


Voilà ! Maintenant, allons jeter un œil à notre entité.


La première chose à voir, c'est qu'elle est truffée d'attributs commençant par "ORM". 

Nous en avons à la fois sur la classe et chacune des propriétés. 

Il n'y en a actuellement pas sur les méthodes, car elles ne sont pas utiles à Doctrine, pour le moment.

Alors, à quoi servent ces attributs ? 

Tout simplement à expliquer à Doctrine que notre classe est une entité, 
c'est-à-dire qu'il devra créer une table à partir de son nom et des colonnes depuis les différentes propriétés ayant un attribut ORM\Column.

Au niveau de la classe, l'attribut ORM\Entity définit non seulement que c'est une entité, mais définit également un paramètre "repositoryClass".
Nous reparlerons plus en détail des repositories, mais, pour faire simple, ce sont les services qui vont nous permettre de réaliser des requêtes de sélection pour cette entité.


On peut également ajouter un attribut ORM\Table, qui permet par exemple de nommer notre table nous-même, ou de définir une contrainte d'unicité sur la table.

Par exemple, nous pouvons déclarer que tous les noms de nos tags doivent être différents comme ceci. 

```php 
#[ORM\Table(uniqueConstraints: [
    new ORM\UniqueConstraint(columns: ['name']),
])]
```

Notez qu'il y a d'autres paramètres possibles pour ORM\Table, dont `name`, pour nommer vous-même la table. Dans mon cas, je laisse Doctrine gérer... Il devrait s'en sortir !


Quant aux propriétés, on a un attribut ORM\Column, dont le travail est de lier une propriété à une colonne de la table.

Si je veux définir moi-même les options de ma colonne, je peux :

Remplir le paramètre `name`

En changer le type avec l'option `type`. Les différents types sont définis dans une constante Types de Doctrine, si vous voulez tous les voir. 

Définir si la valeur peut être nulle ou non avec `nullable`. Par défaut, je vais la passer à `false` pour être sûr que le nom ne puisse pas être null.


Il y a pléthore d'autres paramètres, que l'on peut voir dans la définition de l'attribut, mais sur lesquels je ne vais pas m'étendre.

On en verra quelques exemples dans la partie "pratique", pour qu'ils soient un peu concrets !

Dans tous les cas, notre entité a non seulement la propriété qu'on a demandée, mais aussi des méthodes associées (getter et setter).


## Des relations entre nos entités

Avoir une entité, c'est bien, mais la plupart du temps, nous avons une myriade d'entités, liées entre elles.

Créons donc une seconde entité `Article`, avec un titre, une description et des tags.

Le champ `title` va être de type `string`, de longueur 255 (valeur par défaut) et non `null`.

Le champ `content` va être de type `text` et non `null` aussi.

Maintenant, la pièce de résistance. 

Nous voulons que notre entité `Article` puisse être associée à des tags.

On déclare une propriété tags. Notez le pluriel, vu que l'on veut avoir plusieurs tags liés à notre article. 

C'est juste une convention, mais ça aide à s'y retrouver.

Pour le type, j'en ai 5 possibles, mais je vais entrer le plus pratique : "relation". 

Il me permet d'avoir une aide pour trouver le bon type de relation. Personnellement, je me mélange les pinceaux très souvent, donc cette aide ne m'est pas négligeable.

Je dois ensuite entrer l'entité à laquelle je veux me lier. J'entre donc `Tag`. 

Ici, je veux une relation `ManyToMany`. Chaque tag est lié à plusieurs articles et chaque article à plusieurs tags.

J'admets, je n'ai pas choisi le cas le plus dur à deviner !

J'aurais même pu mettre le type `ManyToMany` dès le départ, à la place de "relation".

Est-ce que je veux ajouter une propriété dans `Tag`, pour récupérer les articles ? Oui, ça me serait bien utile !

Avoir des relations bidirectionnelles dans nos entités ne changera rien au niveau de la BdD, c'est Doctrine qui va faire le travail, mais nous simplifiera la vie au quotidien.

Cette propriété s'appellera `articles` dans notre entité Tag.

Et voilà !

Allons voir nos entités.

Des deux côtés, nous avons des propriétés avec un attribut `ManyToMany` et un paramètre `targetEntity`, permettant de créer ce lien, aux yeux de Doctrine.

Côté `Tag`, nous avons un paramètre `mappedBy`, indiquant que la relation est définie dans l'autre entité (`Article`) et que celle-ci est le côté "inverse" de la relation.

Côté `Article`, le paramètre `inversedBy` indique qu'on est dans l'entité porteuse de la relation, et que `Tag` est l'inverse.

Concrètement, Doctrine va nous créer une table de relation `article_tag` dont l'ordre dans le nom est défini par le sens de la relation. 

En général, ce sens nous importe peu, à part pour quelques maniaques comme moi.




## Avoir une table en <abbr title="Base de Données">BdD</abbr>

Bon, notre entité est bien belle, mais nous n'avons toujours pas de table dans notre base. 

C'est normal, nous n'avons pas encore dit à Doctrine de le faire, ni comment le faire ! 

Pour ça, nous allons faire deux opérations : créer les requêtes SQL pour mettre à jour les tables et les champs, puis appliquer ces requêtes SQL.

Pourquoi ce fonctionnement ? 

Pour pouvoir versionner ces changements. Autrement dit, tous les collaborateurs du projet pourront avoir le même schéma en appliquant ces requêtes, qu'on appelle des migrations.

Le but est ici d'avoir des versions du schéma de BdD de notre application pour, entre autre, mettre à jour notre production automatiquement, sans avoir à modifier manuellement la BdD.

Pour ce faire, commençons par la commande `bin/console make:migration`, pour créer notre première migration.

Cette commande regarde notre schéma de BdD, le compare avec celui attendu par nos entités et crée les requêtes nécessaires.

Si on regarde le fichier généré, son nom contient la date et l'heure de création de la migration et la classe contient 2 méthodes : up et down.

La méthode up permet d'appliquer nos modifications, alors que la méthode down nous permet de revenir en arrière. 

Cette dernière est bien pratique si, par exemple, une fonctionnalité qu'on a mise en production ne fonctionne pas comme attendu et qu'on veut la supprimer.

Pour du code, il suffit de revenir en arrière de quelques commits, mais pour la BdD, les migrations permettent d'avoir un mécanisme similaire.

Vu que c'est notre première migration dans ce projet, nous avons quelques éléments supplémentaires, comme la création d'une table `messenger_messages`, dont nous parlerons bien plus tard !

Comment appeler cette méthode `up()` ? 

Grâce à la commande `bin/console doctrine:migrations:migrate`, nous pouvons appeler les méthodes `up()` de **toutes** les migrations qui n'ont pas déjà été exécutées.

Parce que oui, Doctrine retient les migrations exécutées, dans la table `doctrine_migrations_version`.

Appliquons notre migration et jetons un œil à la BdD. 

> Commit des changements en Off

> Face caméra, avec PhpStorm derrière

Et voilà !

Je vais en profiter pour insister sur un point important : pourquoi fait-on tout ça, juste pour mettre à jour notre BdD ?

Notre problème est en fait assez simple : une base de données n'est pas du code et n'est pas versionnée. 

Les données vont et viennent et sont spécifiques à chaque machine qui fait tourner le projet.


Du coup, ces migrations nous permettent d'avoir des versions du schéma de la BdD, directement dans le code. 

Comme ça, toute personne travaillant sur le projet peut accéder aux modifications des autres quand le besoin se fait sentir.

Bien sûr, cette méthode a des inconvénients.

Déjà, ça implique tout un protocole pour mettre à jour la BdD (modifier la ou les entités, créer une migration, la relire, l'exécuter).

Pour chaque nouvelle fonctionnalité, débug, etc. impliquant la BdD, nous allons avoir **au moins** une nouvelle migration. 

Ce qui veut dire qu'elles vont s'accumuler et le dossier de migrations peut vite devenir un sacré capharnaüm !

Dans la partie pratique, nous verrons comment organiser nos fichiers. Ça sera fait automatiquement par le bundle, donc c'est plutôt efficace.

Ensuite, dès qu'on travaille à plusieurs, qu'on passe d'un ticket à l'autre et qu'on change de branche, il faut bien penser à l'état de notre BdD !

Par exemple, j'ai créé une migration dans cette branche. Si je reviens sur ma branche principale, je n'ai plus ma migration, mais ma BdD n'a pas été modifiée, elle. 

J'ai donc une BdD qui ne correspond plus à ma branche principale, et ça peut être problématique.

Pour gérer ça, je vais retourner sur ma branche et annuler ma ou mes migrations avec la commande `bin/console doctrine:migrations:execute --down`, suivi du <abbr title="Fully Qualified Class Name">FQCN</abbr> de ma migration. 

Dans mon cas, ça donne ça ! 

> Lancer la commande `bin/console doctrine:migrations:execute --down 'App\Migrations\VersionXXX'`

Et maintenant, je peux revenir sur ma branche principale avec beaucoup moins de problèmes.

J'en profite : la commande `doctrine:migrations:execute` peut être exécutée avec l'option `up` ou l'option `down`, selon si vous voulez appeler la méthode `up()` ou `down()` de votre migration.

Et cela a une autre implication : essayer de ne pas avoir trop de migrations dans une branche, si vous risquez de faire de tels allers et retours.

Personnellement, j'essaie de n'avoir qu'une migration max par branche. C'est nettement plus pratique ! 

Nous verrons d'ailleurs comment gérer ce cas dans la partie pratique.


## Manipuler des données

> Avoir inséré des données random dans la base (tags + articles)

> Face caméra, avec slides derrière

Fiou ! Le schéma, c'est bon !

Maintenant, revenons (enfin) à du code, pour ajouter des lignes dans nos tables !

Dans un premier temps, je vais tester tout ça directement dans un controller. 

C'est pas le plus propre, mais vous verrez mieux l'idée.

Dans la partie pratique, nous verrons un exemple plus propre et courant.

Pendant la création des entités, vous avez sûrement remarqué que Symfony nous a créé non seulement une entité dans `src/Entity`, mais aussi un repository dans `src/Repository`.

Ces repositories servent à récupérer les entités d'un type à la fois.

Mon ArticleRepository pour gérer les entités d'article, TagRepository pour les tags.

Ce sont des services, que nous allons donc pouvoir appeler dans notre controller.

Petite parenthèse, si vous ne savez pas ce que sont les services dans Symfony, je vous renvoie sur ma vidéo précédente, juste là.

> Lien vers la vidéo précédente à mettre dans les fiches.

Je crée quelques objets Tag et Article, avec des données bidons. 

> Créer 4 objets Tag et 2 articles, pour bien remplir les tables et améliorer la récupération

Si je charge ma page, aucune entrée n'a été ajoutée en base. C'est normal, nous ne lui avons pas dit de sauvegarder.

Pour faire ça, j'injecte le service EntityManagerInterface. 

Il dispose de 2 méthodes `persist()` et `flush()` pour sauvegarder n'importe quel type d'entité. 

`persist()` permet de dire à Doctrine qu'on voudra sauvegarder l'entité qu'on passe en paramètre, de préciser ce que l'on veut sauvegarder.

`flush()` lui dit de faire la sauvegarde, d'exécuter réellement les requêtes. 

Je fais toujours le parallèle entre `persist()` et la commande `add` de Git, alors que `flush()` serait la commande `commit`.

Du coup, il faut bien préciser à Doctrine tout ce que je veux sauvegarder, et je flush à la fin, pour qu'il passe toutes les requêtes en une fois.

En cas de pépin, rien ne sera sauvegardé, ce qui n'est peut-être pas plus mal.

Si je recharge ma page... Tout a l'air de marcher et mes données sont bien enregistrées.

Avant de vous parler de la suppression, voyons comment récupérer nos données. 

Comme je le disais plus tôt, nous allons utiliser les repositories pour le faire. 

Prenons la page d'accueil de notre blog, où nous aimerions voir tous les articles.

Pour ça, nous pouvons injecter notre ArticleRepository et utiliser ses différentes méthodes. 

**Tous** les repositories ont 4 méthodes de base :

- `find()`, pour récupérer un élément par son identifiant (encore faut-il l'avoir)

- `findAll()` pour récupérer toutes les entités d'un type

- `findOneBy()` pour récupérer **une seule** entrée selon un ensemble de critères

- `findBy()` pour récupérer **un tableau** d'entrées selon un ensemble de critères

Contentons-nous d'utiliser la méthode `findAll()` pour tout récupérer. Dans la partie pratique, nous verrons plus avant les autres méthodes et leur utilisation.

> Charger la page d'accueil avec un dd() sur les résultats

Nous récupérons bien nos différentes entités, avec leurs propriétés.

Notez bien que les entités liées, comme notre propriété `tags`, ne sont pas initialisées par défaut, et la collection va nous sembler bien vide !

C'est lié à un comportement de Doctrine, qui ne charge les autres entités que lors de leur utilisation. 

Dans notre application, nous verrons que nous pourrons bel et bien nous en servir directement, pas besoin de faire d'autres requêtes, c'est Doctrine qui s'en chargera discrètement.

Dans notre exemple, si je récupère un article lié à 10 tags, j'aurais potentiellement 1 requête pour récupérer mon article, puis 10 requêtes pour récupérer chacun des tags.

Soit 11 requêtes, quand même !

Dans la partie pratique, nous essaierons de réduire le nombre de requêtes de la page et verrons en détails comment ça se passe.

> Afficher la page, regarder le profiler

J'en profite pour mentionner le profiler, qui a toute une partie Doctrine, pour nous montrer exactement ce qu'il se passe en interne.

Ce panneau présente les différentes requêtes, leur durée, etc. 

Très pratique pour bien tout comprendre !

> Ouvrir le TagRepository, créer une requête pour récupérer tous les tags ayant au moins un article

Pour réaliser des requêtes plus complexes, nous allons pouvoir créer de nouvelles méthodes dans notre repository.

Ce sont ces méthodes que nous appellerons dans nos différents services pour exécuter les requêtes.

Prenons un exemple : nous voulons créer une requête permettant de récupérer tous les tags associés à **au moins** un article.

Nous allons créer une méthode, que nous pouvons nommer comme bon nous semble... 

Disons... `findWithArticles()`, qui nous retournera un tableau de tags.

Pour ça, je vais utiliser un QueryBuilder, c'est-à-dire un objet de construction de requête. 

Cet objet ne construit pas une requête SQL, mais utilise un sous-langage, le DQL, pour Doctrine Query Language, qui se base sur nos **classes** pour construire ensuite la requête SQL.

Tout d'abord, créons notre QueryBuilder avec la méthode `createQueryBuilder()` du repository.

Elle attend un paramètre : un alias pour l'entité que l'on recherche. 

Disons `t`, c'est difficile de faire plus court !

> Afficher la complétion sur le QueryBuilder
> Fiche : https://www.doctrine-project.org/projects/doctrine-orm/en/2.16/reference/query-builder.html#high-level-api-methods


On a alors accès à de nombreuses méthodes, comme `select()`, `andWhere()`, `having()`, etc. qui vont nous permettre de construire une requête cohérente.

> Écrire la requête en entier

Ici, je crée une requête pour mon entité `t`, où la jointure avec un `innerJoin()` se fait sur `t.articles`, soit la propriété articles, contenue dans `Tag`. 

Vous voyez que je m'abstrais totalement des tables ici.

Qu'il y ait une table de jointures ou non m'importe peu, je suis seulement les propriétés de mon entité.

Nous en verrons un peu plus dans la partie pratique, encore une fois, et je vous renvoie vers les documentations que vous trouverez dans les fiches, en attendant.


## Des entités et des routes

> PhpStorm, sur l'action d'affichage d'un article

Une petite "astuce" bien pratique : vous pouvez demander à Doctrine d'aller chercher une entité, en fonction des paramètres de votre route.

Si j'ai un identifiant en paramètre de ma route, je peux le récupérer dans les paramètres de mon action et appeler la méthode `find()` de mon repository, ou demander à Doctrine d'aller la chercher, comme ceci.

C'est ce qu'on appelle l'EntityValueResolver !

Pour faire simple, si les paramètres de votre route correspondent aux propriétés de l'entité demandée, Doctrine va appeler la méthode `findOneBy()` du repository pour aller chercher l'entité.

Dans cet exemple, on a une correspondance entre le paramètre `id` et la propriété `id`, donc Doctrine va chercher un article ayant l'identifiant présent dans l'url.

Pratique et puissant, n'est-ce pas ? 

Si vous avez besoin d'une expression plus complexe, vous pouvez utiliser l'attribut `MapEntity` pour personnaliser le comportement.

> fiche : https://symfony.com/doc/current/doctrine.html#fetch-via-an-expression

La documentation montre comment s'en servir et nous attendrons d'avoir un cas pratique pour approfondir le sujet !


## Étendre Doctrine dans Symfony

> Ouvrir dans 2 onglets les deux documentations : 
> - [StofDoctrineExtensionsBundle](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)
> - [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)


> Ouvrir [StofDoctrineExtensionsBundle](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)

Nos entités vont avoir des comportements assez récurrents, et les coder à chaque fois peut être assez frustrant. 

Pour ça, il existe un bundle -- Stof Doctrine Extensions Bundle -- fournissant les outils nécessaires, sans avoir besoin de tout refaire soit-même.

Deux comportements reviennent dans beaucoup de projets :
- Sluggable, qui permet de convertir un texte quelconque en un texte valide pour une url
- Timestampable, qui permet de retenir une date de création et/ou de modification d'une entité

Nous implémenterons ces deux cas dans la partie pratique, bien sûr !

Il y en a bien sûr plein d'autres, que je vous laisserai découvrir.

Attention toutefois, la configuration de ce bundle n'est pas toujours aisée, et la documentation n'aide pas forcément...

> Ouvrir [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)
 
Un autre bundle que j'utilise beaucoup moins, beberlei/DoctrineExtensions. Lui permet d'appeler des fonctions natives, mais **spécifiques** de votre base de données. 

Doctrine se concentre sur les éléments communs, et son travail est de s'abstraire du système de BdD derrière. 

Du coup, de nombreuses fonctions utiles ne sont pas disponibles. 

Personnellement, j'évite d'utiliser ce genre d'astuces, pour conserver une certaine souplesse et éviter de me coincer complètement avec un système précis.

Sachez toutefois qu'il existe et peut vous permettre de mieux exploiter votre BdD.

## Et voilà !

Vous avez pu le voir, Doctrine est complet, complexe et nécessite un peu de pratique pour être maîtrisé.

Par contre, son travail est de nous simplifier la vie, sur le long terme. 

Il nous permet de ne plus avoir à penser en termes de BdD, mais seulement d'objets PHP, avec des compositions, des héritages, etc.

Bon, il faut quand même se rappeler comment faire des requêtes SQL, ne serait-ce que pour le QueryBuilder et les migrations...

