# QCM — Le service container

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/service_container.html](https://symfony.com/doc/8.0/service_container.html) · **Généré le :** 19 juillet 2026
>
> **60 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Notions de base

### Question 1

Quelles affirmations sur les services et le service container sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans Symfony, les objets utiles de l'application sont appelés « services »
- [ ] **B.** Chaque service vit dans un objet spécial appelé le service container
- [ ] **C.** Le container centralise la façon dont les objets sont construits
- [ ] **D.** Un service doit hériter d'une classe de base `AbstractService`

### Question 2

Dans quel fichier configure-t-on par défaut les services de l'application ? *(une seule bonne réponse)*

- [ ] **A.** `config/packages/services.yaml`
- [ ] **B.** `config/container.yaml`
- [ ] **C.** `config/services.yaml`
- [ ] **D.** `src/Kernel.php`

### Question 3

Comment demande-t-on un service depuis un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$this->container->get('logger')`
- [ ] **B.** En type-hintant un argument avec la classe ou l'interface du service (ex. `LoggerInterface $logger`)
- [ ] **C.** En appelant `Container::getInstance()->fetch(LoggerInterface::class)`
- [ ] **D.** Avec l'annotation `@Inject("logger")`

### Question 4

Où peut-on recevoir des services par type-hint ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans les arguments des méthodes de contrôleur
- [ ] **B.** Dans le constructeur de ses propres services
- [ ] **C.** Dans n'importe quelle méthode de n'importe quelle classe PHP
- [ ] **D.** Dans les propriétés statiques d'une classe

### Question 5

Quelle commande liste les classes et interfaces utilisables comme type-hints pour l'autowiring ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:container --types`
- [ ] **B.** `php bin/console debug:services`
- [ ] **C.** `php bin/console autowiring:list`
- [ ] **D.** `php bin/console debug:autowiring`

### Question 6

Quelles affirmations sur la commande `debug:autowiring` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle liste les classes et interfaces utilisables comme type-hints
- [ ] **B.** Elle montre le service concret derrière chaque type (ex. `Psr\Log\LoggerInterface - alias:logger`)
- [ ] **C.** Elle accepte un argument pour filtrer les résultats (ex. `debug:autowiring logger`)
- [ ] **D.** Elle liste aussi tous les paramètres du container

### Question 7

Quelle commande liste *tous* les services du container, avec leurs ids ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:container`
- [ ] **B.** `php bin/console debug:autowiring --all`
- [ ] **C.** `php bin/console container:list`
- [ ] **D.** `php bin/console lint:container`

### Question 8

Quelles affirmations sur l'instanciation des services par le container sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un service jamais demandé n'est jamais construit, ce qui économise mémoire et temps
- [ ] **B.** Un service n'est créé qu'une seule fois : la même instance est retournée à chaque demande
- [ ] **C.** Chaque service a un id unique dans le container (ex. `request_stack`, `router.default`)
- [ ] **D.** Une nouvelle instance est créée à chaque injection du service

## La configuration par défaut de services.yaml

### Question 9

Que fait la configuration par défaut de `services.yaml` d'un nouveau projet ? *(plusieurs bonnes réponses)*

- [ ] **A.** `autowire: true` dans `_defaults` : les dépendances sont injectées automatiquement
- [ ] **B.** `autoconfigure: true` dans `_defaults` : les services sont enregistrés automatiquement comme commandes, event subscribers, etc.
- [ ] **C.** `App\: { resource: '../src/' }` rend les classes de `src/` disponibles comme services
- [ ] **D.** L'id de chaque service ainsi créé est le nom complet (FQCN) de sa classe

### Question 10

Pourquoi l'ordre des définitions est-il important dans `services.yaml` ? *(une seule bonne réponse)*

- [ ] **A.** Les premières définitions sont prioritaires sur les suivantes
- [ ] **B.** Le container charge les services dans l'ordre du fichier au démarrage
- [ ] **C.** Les définitions de services *remplacent* toujours les précédentes
- [ ] **D.** Il ne l'est pas : l'ordre est purement cosmétique

### Question 11

Quelle option empêche certains fichiers ou dossiers de devenir des services ? *(une seule bonne réponse)*

- [ ] **A.** `ignore`
- [ ] **B.** `exclude`
- [ ] **C.** `skip`
- [ ] **D.** `except`

### Question 12

Quelles affirmations sur les options `resource` et `exclude` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Leurs valeurs peuvent être n'importe quel glob pattern valide
- [ ] **B.** Exclure des chemins améliore légèrement les performances en `dev` : les chemins exclus ne sont pas trackés et leur modification ne reconstruit pas le container
- [ ] **C.** L'attribut `#[Exclude]` posé directement sur une classe permet de l'exclure individuellement
- [ ] **D.** `exclude` est obligatoire dès qu'on utilise `resource`

### Question 13

Avec l'import `App\: { resource: '../src/' }`, toutes les classes de `src/` (même les modèles) deviennent-elles des services dans le container final ? *(une seule bonne réponse)*

- [ ] **A.** Oui, toutes les classes sont instanciées au démarrage
- [ ] **B.** Oui, mais seulement en environnement `dev`
- [ ] **C.** Non : les modèles sont détectés et ignorés grâce à une heuristique sur leurs méthodes
- [ ] **D.** Non : tant que les services importés restent privés, les classes non utilisées comme services sont automatiquement retirées du container final

### Question 14

En YAML, comment définir *deux* configurations différentes pour des classes du même namespace ? *(plusieurs bonnes réponses)*

- [ ] **A.** C'est impossible directement : le namespace sert de clé de configuration, il ne peut apparaître qu'une fois
- [ ] **B.** En ajoutant l'option `namespace` et en utilisant une chaîne unique quelconque comme clé de chaque config
- [ ] **C.** Chaque définition peut alors avoir son propre `resource` et ses propres `tags`
- [ ] **D.** En suffixant le namespace d'un numéro : `App\Domain\1:`, `App\Domain\2:`

## Limiter des services à un environnement

### Question 15

Quelles affirmations sur l'attribut `#[When]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[When(env: 'dev')]` n'enregistre la classe comme service que dans l'environnement `dev`
- [ ] **B.** On peut appliquer plusieurs attributs `#[When]` à la même classe
- [ ] **C.** En YAML, l'équivalent est de déclarer le service sous un bloc `when@dev:`
- [ ] **D.** L'attribut peut aussi s'appliquer à une méthode individuelle du service

### Question 16

Un bloc `when@prod:` définit des services dans `services.yaml`. Qu'en est-il du `_defaults` de la section `services` principale ? *(une seule bonne réponse)*

- [ ] **A.** Il s'applique automatiquement à tous les blocs du fichier
- [ ] **B.** Chaque bloc `when@<env>` a son propre scope et n'en hérite pas : il faut y redéfinir `_defaults`
- [ ] **C.** Il s'applique seulement si le bloc `when@prod` ne définit aucun service
- [ ] **D.** `_defaults` est interdit dans les blocs `when@<env>`

### Question 17

Comment enregistrer une classe comme service dans tous les environnements *sauf* `dev` ? *(une seule bonne réponse)*

- [ ] **A.** `#[When(env: '!dev')]`
- [ ] **B.** `#[Unless(env: 'dev')]`
- [ ] **C.** `#[WhenNot(env: 'dev')]`
- [ ] **D.** `#[When(env: 'prod')]` suffit, `test` héritant de `prod`

## L'injection de dépendances

### Question 18

Comment s'appelle le pattern consistant à ajouter ses dépendances comme arguments du `__construct()` ? *(une seule bonne réponse)*

- [ ] **A.** Le service location
- [ ] **B.** La composition de services
- [ ] **C.** L'injection de dépendances (dependency injection)
- [ ] **D.** Le lazy loading

### Question 19

Quels types de valeurs peut-on passer comme arguments d'un service dans sa configuration ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des scalaires (chaînes, nombres, booléens), passés tels quels
- [ ] **B.** Des constantes PHP — natives, utilisateur ou enums — via le tag `!php/const`
- [ ] **C.** Des contenus binaires, encodés en base64 via le tag `!!binary`
- [ ] **D.** Des collections (tableaux), pouvant contenir tout type d'argument

### Question 20

En YAML, que signifie la valeur `'@some-service-id'` dans les arguments d'un service ? *(une seule bonne réponse)*

- [ ] **A.** C'est une référence au *service* dont l'id est `some-service-id`, pas une chaîne
- [ ] **B.** C'est la chaîne littérale `@some-service-id`
- [ ] **C.** C'est une référence au paramètre `some-service-id`
- [ ] **D.** C'est un alias de route

### Question 21

Que signifie la valeur `'@?some-service-id'` ? *(une seule bonne réponse)*

- [ ] **A.** Le service est injecté de façon paresseuse (lazy)
- [ ] **B.** `null` est passé si le service n'existe pas
- [ ] **C.** Le service est optionnel : une exception silencieuse est loggée s'il manque
- [ ] **D.** Le container demande confirmation à la compilation

### Question 22

Comment passer la *chaîne littérale* `@securepassword` comme argument d'un service en YAML ? *(une seule bonne réponse)*

- [ ] **A.** `'\@securepassword'`
- [ ] **B.** `'%securepassword%'`
- [ ] **C.** `'!string @securepassword'`
- [ ] **D.** `'@@securepassword'`

### Question 23

Vous obtenez l'erreur : *« Cannot autowire service "App\Service\SiteUpdateManager": argument "$adminEmail" of method "__construct()" must have a type-hint or be given a value explicitly. »* Quelle est la solution documentée ? *(une seule bonne réponse)*

- [ ] **A.** Configurer explicitement l'argument : `arguments: { $adminEmail: 'manager@example.com' }`
- [ ] **B.** Ajouter un type-hint `mixed` à l'argument
- [ ] **C.** Passer l'argument en propriété publique
- [ ] **D.** Désactiver l'autowiring de toute l'application

### Question 24

Un service a un argument `$adminEmail` câblé manuellement, les autres arguments étant type-hintés. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les autres arguments restent autowirés normalement
- [ ] **B.** Si l'argument est renommé (ex. `$mainEmail`), une exception claire apparaît au rechargement, même sur une page qui n'utilise pas ce service
- [ ] **C.** L'attribut `#[Autowire]` permet aussi d'injecter ce scalaire directement dans le service
- [ ] **D.** Le câblage manuel d'un argument désactive l'autowiring de tous les autres

## Les paramètres du container

### Question 25

Quelles méthodes d'accès aux paramètres le container propose-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** `hasParameter()` — vérifier qu'un paramètre est défini (noms sensibles à la casse)
- [ ] **B.** `getParameter()` — lire la valeur d'un paramètre
- [ ] **C.** `setParameter()` — ajouter un nouveau paramètre
- [ ] **D.** `removeParameter()` — supprimer un paramètre

### Question 26

Que signifie la notation à points des noms de paramètres, comme `app.admin_email` ? *(une seule bonne réponse)*

- [ ] **A.** Elle crée un tableau imbriqué `app['admin_email']`
- [ ] **B.** Elle rattache le paramètre au bundle `app`
- [ ] **C.** C'est une simple convention Symfony de lisibilité : les paramètres restent des éléments clé-valeur plats, sans imbrication
- [ ] **D.** Elle rend le paramètre privé

### Question 27

Quand peut-on définir un paramètre du container ? *(une seule bonne réponse)*

- [ ] **A.** À tout moment, y compris pendant le traitement d'une requête
- [ ] **B.** Seulement avant la compilation du container, pas au runtime
- [ ] **C.** Seulement dans un contrôleur
- [ ] **D.** Seulement en environnement `dev`

## Choisir un service spécifique

### Question 28

Plusieurs services implémentent `LoggerInterface` (`logger`, `monolog.logger.request`…). Comment injecter spécifiquement `monolog.logger.request` dans l'argument `$logger` d'un service ? *(une seule bonne réponse)*

- [ ] **A.** `arguments: { $logger: 'monolog.logger.request' }`
- [ ] **B.** `arguments: { $logger: '%monolog.logger.request%' }`
- [ ] **C.** Renommer l'argument en `$monologLoggerRequest`
- [ ] **D.** `arguments: { $logger: '@monolog.logger.request' }`

### Question 29

Quelle commande liste les services de type logger utilisables avec l'autowiring ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:autowiring logger`
- [ ] **B.** `php bin/console debug:container --tag=logger`
- [ ] **C.** `php bin/console monolog:list`
- [ ] **D.** `php bin/console debug:logger`

### Question 30

Pour choisir entre plusieurs implémentations d'un même type dans toute l'application, que suggère la documentation à la place du câblage manuel de chaque point d'injection ? *(une seule bonne réponse)*

- [ ] **A.** Rendre publics les services concernés
- [ ] **B.** Utiliser les named autowiring aliases
- [ ] **C.** Créer une sous-interface par implémentation
- [ ] **D.** Utiliser un compiler pass

## Supprimer des services

### Question 31

Comment rendre le service `App\RemovedService` indisponible dans l'environnement `test` ? *(une seule bonne réponse)*

- [ ] **A.** Avec `removed: true` dans sa définition YAML
- [ ] **B.** En appelant `$services->remove(RemovedService::class)` dans `config/services_test.php`
- [ ] **C.** Avec `#[When(env: 'test', enabled: false)]`
- [ ] **D.** En le déclarant `abstract: true` dans l'environnement `test`

## Injecter un callable

### Question 32

Un constructeur attend un argument `callable $generateMessageHash`, et `App\Hash\MessageHashGenerator` est un service invokable. Quelle syntaxe YAML permet de l'injecter comme callable ? *(une seule bonne réponse)*

- [ ] **A.** `$generateMessageHash: '@App\Hash\MessageHashGenerator'`
- [ ] **B.** `$generateMessageHash: !callable '@App\Hash\MessageHashGenerator'`
- [ ] **C.** `$generateMessageHash: !closure '@App\Hash\MessageHashGenerator'`
- [ ] **D.** `$generateMessageHash: '@App\Hash\MessageHashGenerator::__invoke'`

## Lier des arguments par nom ou par type

### Question 33

Quelles formes de liaison la clé `bind` accepte-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par nom d'argument : `$adminEmail: 'manager@example.com'`
- [ ] **B.** Par type : `Psr\Log\LoggerInterface: '@monolog.logger.request'`
- [ ] **C.** Par nom *et* type : `Psr\Log\LoggerInterface $requestLogger: '@monolog.logger.request'`
- [ ] **D.** La liaison s'applique à tous les services de l'application, même ceux définis dans d'autres fichiers

### Question 34

À quels services s'applique un `bind` défini sous `_defaults` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement aux services explicitement listés en dessous
- [ ] **B.** À tous les services de l'application
- [ ] **C.** Uniquement aux contrôleurs
- [ ] **D.** À tout service défini dans le même fichier, y compris les arguments de contrôleurs

## Les arguments abstraits

### Question 35

À quoi sert le type d'argument `!abstract` (ou `abstract_arg()` en PHP) ? *(une seule bonne réponse)*

- [ ] **A.** À déclarer un argument dont la valeur sera calculée au runtime par un compiler pass ou une extension de bundle, avec une courte description de son rôle
- [ ] **B.** À marquer le service entier comme abstrait
- [ ] **C.** À injecter automatiquement une implémentation abstraite
- [ ] **D.** À rendre l'argument optionnel

### Question 36

Que se passe-t-il si la valeur d'un argument abstrait n'est jamais remplacée ? *(une seule bonne réponse)*

- [ ] **A.** L'argument reçoit `null`
- [ ] **B.** Le service est retiré silencieusement du container
- [ ] **C.** Une `RuntimeException` est levée, avec un message du type « Argument "$rootNamespace" of service "App\Service\MyService" is abstract: should be defined by Pass. »
- [ ] **D.** Une erreur de compilation du container empêche le cache de se construire

## Les options autowire et autoconfigure

### Question 37

Que permet l'option `autowire: true` ? *(une seule bonne réponse)*

- [ ] **A.** D'enregistrer automatiquement toutes les classes de `src/` comme services
- [ ] **B.** De type-hinter les arguments du `__construct()` de ses services et de laisser le container passer automatiquement les bons arguments
- [ ] **C.** D'appliquer automatiquement des tags aux services
- [ ] **D.** De rendre tous les services publics

### Question 38

L'autowiring ne trouve aucun service correspondant à un type-hint. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** L'argument reçoit `null`
- [ ] **B.** Le service est créé sans cet argument
- [ ] **C.** Un warning est logué et l'application continue
- [ ] **D.** Une exception claire est levée, avec une suggestion utile

### Question 39

Quelles affirmations sur l'option `autoconfigure` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le container applique automatiquement certaines configurations à vos services selon la *classe* du service
- [ ] **B.** Elle sert principalement à *auto-taguer* les services
- [ ] **C.** Exemple : une classe implémentant `Twig\Extension\ExtensionInterface` reçoit automatiquement le tag `twig.extension`
- [ ] **D.** Elle remplace l'autowiring, qui devient inutile

### Question 40

Quels attributs la documentation cite-t-elle comme enregistrés pour l'autoconfiguration ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[AsMessageHandler]`
- [ ] **B.** `#[AsEventListener]`
- [ ] **C.** `#[AsCommand]`
- [ ] **D.** `#[AsService]`

## Linter les définitions de services

### Question 41

Quelles affirmations sur la commande `lint:container` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle effectue des vérifications supplémentaires pour s'assurer que le container est correctement configuré
- [ ] **B.** Il est utile de la lancer avant un déploiement en production, par exemple en intégration continue
- [ ] **C.** L'option `--resolve-env-vars` force la résolution des env vars et fait échouer la commande si l'une d'elles manque
- [ ] **D.** Ses vérifications sont désactivées par défaut lors des compilations normales du container, pour ne pas dégrader les performances

### Question 42

Dans quoi les vérifications de `lint:container` sont-elles implémentées ? *(une seule bonne réponse)*

- [ ] **A.** Dans un event listener sur `kernel.request`
- [ ] **B.** Dans le constructeur du Kernel
- [ ] **C.** Dans un middleware de la console
- [ ] **D.** Dans les compiler passes `CheckTypeDeclarationsPass` et `CheckAliasValidityPass`, activables aussi en permanence si on accepte le coût

## Services publics et privés

### Question 43

Quelles affirmations sur les services publics et privés sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tout service défini est privé par défaut
- [ ] **B.** Un service privé ne peut pas être récupéré directement via `$container->get()`
- [ ] **C.** La bonne pratique : ne créer que des services privés et les obtenir par injection de dépendances
- [ ] **D.** Les services publics sont dépréciés et seront supprimés en Symfony 9

### Question 44

Comment rendre un service public via sa configuration ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant `public: true` à sa définition
- [ ] **B.** En ajoutant `visibility: public`
- [ ] **C.** En le déclarant dans `config/packages/public_services.yaml`
- [ ] **D.** En préfixant son id par `public.`

### Question 45

Comment rendre un service public directement depuis sa classe ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'attribut `#[Public]`
- [ ] **B.** Avec l'attribut `#[AsPublicService]`
- [ ] **C.** Avec l'attribut `#[Autoconfigure(public: true)]` sur la classe
- [ ] **D.** C'est impossible : seule la configuration YAML/PHP le permet

### Question 46

Pour récupérer des services de façon paresseuse, que conseille la documentation plutôt que de rendre les services publics ? *(une seule bonne réponse)*

- [ ] **A.** Un event subscriber
- [ ] **B.** Un service locator
- [ ] **C.** Une factory statique
- [ ] **D.** L'injection de la `RequestStack`

## Importer plusieurs services avec resource

### Question 47

Quel est l'id d'un service importé via `App\: { resource: '../src/' }` ? *(une seule bonne réponse)*

- [ ] **A.** Un identifiant aléatoire généré à la compilation
- [ ] **B.** Le nom complet (FQCN) de sa classe
- [ ] **C.** Le nom du fichier sans extension
- [ ] **D.** Le nom de classe en snake_case

### Question 48

Quelles affirmations sur la surcharge d'un service importé sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** On peut surcharger tout service importé en le redéfinissant plus bas avec son id (le nom de classe)
- [ ] **B.** Le service surchargé n'hérite d'aucune option de l'import (ex. `public`)
- [ ] **C.** Le service surchargé hérite tout de même de `_defaults`
- [ ] **D.** La surcharge doit obligatoirement être placée dans un autre fichier de configuration

### Question 49

Quels chemins l'import par défaut de Symfony exclut-il ? *(une seule bonne réponse)*

- [ ] **A.** `../src/{DependencyInjection,Entity,Kernel.php}`
- [ ] **B.** `../src/{Controller,Entity}`
- [ ] **C.** `../src/{Tests,var,vendor}`
- [ ] **D.** Rien : aucun `exclude` par défaut

## Configurer explicitement services et arguments

### Question 50

Vous enregistrez deux services pour la classe `SiteUpdateManager`, chacun avec un email différent. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Chaque service doit avoir un id unique (ex. `site_update_manager.superadmin`, `site_update_manager.normal_users`)
- [ ] **B.** La clé `class` de chaque définition indique la classe à instancier
- [ ] **C.** L'alias `App\Service\SiteUpdateManager: '@site_update_manager.superadmin'` fait que le type-hint injecte le service superadmin
- [ ] **D.** Sans cet alias, avec le chargement automatique de `src/`, *trois* services existent et c'est le service auto-chargé qui est injecté par défaut

### Question 51

Un service défini avec un id personnalisé (`site_update_manager.superadmin`) peut-il utiliser l'autowiring ? *(une seule bonne réponse)*

- [ ] **A.** Oui — la doc le désactive dans son exemple uniquement pour montrer à quoi ressemble un câblage entièrement manuel
- [ ] **B.** Non : un id personnalisé désactive l'autowiring
- [ ] **C.** Oui, mais seulement si l'id correspond au FQCN de la classe
- [ ] **D.** Non : `autowire: false` est obligatoire avec la clé `class`

### Question 52

Que signifie la ligne `App\Service\SiteUpdateManager: '@site_update_manager.superadmin'` dans `services.yaml` ? *(une seule bonne réponse)*

- [ ] **A.** Elle définit un service décoré
- [ ] **B.** Elle rend le service `site_update_manager.superadmin` public
- [ ] **C.** Elle importe le service depuis un autre fichier
- [ ] **D.** Elle crée un alias : quand on type-hint `SiteUpdateManager`, c'est `site_update_manager.superadmin` qui est injecté

### Question 53

Comment injecter le *second* service (`site_update_manager.normal_users`) dans une classe ? *(une seule bonne réponse)*

- [ ] **A.** En le demandant via `$container->get()`
- [ ] **B.** En câblant manuellement le service, ou en créant un named autowiring alias
- [ ] **C.** C'est impossible tant que l'alias existe
- [ ] **D.** En inversant l'ordre des définitions dans le fichier

### Question 54

En configuration PHP par closure, comment connaître l'environnement courant pour en faire dépendre les services ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$_ENV['APP_ENV']` dans la closure
- [ ] **B.** En injectant le kernel dans la closure
- [ ] **C.** En ajoutant un argument `string $env` à la closure : il est rempli automatiquement
- [ ] **D.** C'est impossible : il faut un fichier par environnement

## Le format PHP de configuration

### Question 55

Quelles affirmations sur le format PHP de configuration des services sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec `App::config()`, l'autowiring et l'autoconfiguration sont activés par défaut
- [ ] **B.** La fonction `service('some-service-id')` référence un service
- [ ] **C.** `service('some-service-id')->nullOnInvalid()` passe `null` si le service n'existe pas
- [ ] **D.** La fonction `param()` référence un service par son id

### Question 56

Quel est l'équivalent PHP du tag YAML `!abstract` ? *(une seule bonne réponse)*

- [ ] **A.** `abstract_arg('should be defined by Pass')`
- [ ] **B.** `abstract('should be defined by Pass')`
- [ ] **C.** `arg_abstract('should be defined by Pass')`
- [ ] **D.** `placeholder('should be defined by Pass')`

### Question 57

En configuration PHP avec `ContainerConfigurator`, comment n'enregistrer un service qu'en environnement `dev` ? *(une seule bonne réponse)*

- [ ] **A.** `$services->set(SomeClass::class)->env('dev')`
- [ ] **B.** `$services->when('dev')->set(SomeClass::class)`
- [ ] **C.** `if ($container->isDev()) { ... }`
- [ ] **D.** `if ('dev' === $container->env()) { $services->set(SomeClass::class); }`

## Les adapters d'interfaces fonctionnelles

### Question 58

Qu'est-ce qu'une interface fonctionnelle ? *(une seule bonne réponse)*

- [ ] **A.** Une interface avec une seule méthode, conceptuellement proche d'une closure mais dont la méthode a un nom — et utilisable comme type-hint
- [ ] **B.** Une interface dont toutes les méthodes sont statiques
- [ ] **C.** Une interface marquée `#[Functional]`
- [ ] **D.** Une interface sans méthode (marker interface)

### Question 59

`MessageUtils` est un service avec de nombreuses méthodes, dont `format()`, identique à l'unique méthode de `MessageFormatterInterface`. Comment injecter `MessageUtils` comme implémentation de cette interface ? *(une seule bonne réponse)*

- [ ] **A.** En faisant implémenter l'interface à `MessageUtils`
- [ ] **B.** Avec `#[AutowireLocator(MessageUtils::class)]`
- [ ] **C.** Avec un alias `MessageFormatterInterface: '@App\Service\MessageUtils'`
- [ ] **D.** Avec `#[AutowireCallable(service: MessageUtils::class, method: 'format')]` sur l'argument type-hinté `MessageFormatterInterface`

### Question 60

Quelles affirmations sur la génération d'adapters via la configuration sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'option `from_callable` permet de générer l'adapter sans attribut
- [ ] **B.** Symfony génère une classe (l'*adapter*) implémentant l'interface fonctionnelle
- [ ] **C.** L'adapter transmet les appels de `MessageFormatterInterface::format()` à la méthode `format()` du service sous-jacent, avec tous ses arguments
- [ ] **D.** L'interface doit étendre `\Closure` pour que cela fonctionne

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Service Container de la documentation Symfony 8.0](https://symfony.com/doc/8.0/service_container.html).

**Question 1 : A, B, C** — « In Symfony, these useful objects are called **services** and each service lives inside a very special object called the **service container**. The container allows you to centralize the way objects are constructed. » Aucune classe de base n'est requise : un service est une classe PHP ordinaire. *(§ Introduction)*

**Question 2 : C** — Toute la page s'appuie sur `config/services.yaml` (ou `config/services.php`), qui contient la configuration par défaut des services d'un nouveau projet. *(§ Creating/Configuring Services in the Container)*

**Question 3 : B** — « You can "ask" for a service from the container by type-hinting an argument with the service's class or interface name. » Ex. `public function list(LoggerInterface $logger)`. *(§ Fetching and using Services)*

**Question 4 : A, B** — « When you use these type-hints in your controller methods or inside your own services, Symfony will automatically pass you the service object matching that type. » Une classe quelconque non enregistrée comme service (C) n'est pas servie par le container. *(§ Fetching and using Services)*

**Question 5 : D** — `php bin/console debug:autowiring` liste « the following classes & interfaces can be used as type-hints when autowiring ». *(§ Fetching and using Services)*

**Question 6 : A, B, C** — La sortie montre chaque type avec son service concret (ex. `Psr\Log\LoggerInterface - alias:logger`), et la commande accepte un filtre : `debug:autowiring logger`. Les paramètres se listent avec `debug:container --parameters`. *(§ Fetching and using Services / § Choose a Specific Service)*

**Question 7 : A** — « For a full list, you can run `php bin/console debug:container`. » Chaque service y apparaît avec son id unique. *(§ Fetching and using Services)*

**Question 8 : A, B, C** — « If you never ask for the service, it's *never* constructed: saving memory and speed. As a bonus, the service is only created *once*: the same instance is returned each time you ask for it. » D contredit ce comportement. *(§ Creating/Configuring Services in the Container)*

**Question 9 : A, B, C, D** — Les quatre sont vraies : `autowire: true` (« Automatically injects dependencies in your services »), `autoconfigure: true` (« Automatically registers your services as commands, event subscribers, etc. »), et l'import `App\` qui « creates a service per class whose id is the fully-qualified class name ». *(§ Automatic Service Loading in services.yaml)*

**Question 10 : C** — Commentaire du fichier par défaut : « order is important in this file because service definitions always *replace* previous ones ». *(§ Automatic Service Loading in services.yaml)*

**Question 11 : B** — « If some files or directories in your project should not become services, you can exclude them using the `exclude` option. » *(§ Automatic Service Loading in services.yaml)*

**Question 12 : A, B, C** — « The value of the `resource` and `exclude` options can be any valid glob pattern » ; « excluded paths are not tracked and so modifying them will not cause the container to be rebuilt » (léger gain en `dev`) ; et l'attribut `#[Exclude]` s'applique directement sur une classe. `exclude` reste optionnel (D). *(§ Importing Many Services at once with resource)*

**Question 13 : D** — « As long as you keep your imported services as private, all classes in `src/` that are *not* explicitly used as services are automatically removed from the final container. » L'import signifie seulement que les classes sont « available to be *used* as services ». *(§ Importing Many Services at once with resource)*

**Question 14 : A, B, C** — « The PHP namespace is used as the key of each configuration, so you can't define different service configs for classes under the same namespace. In order to have multiple definitions, add the `namespace` option and use any unique string as the key of each service config » — chaque bloc avec son `resource` et ses `tags` (ex. `command_handlers` / `event_subscribers`). *(§ Multiple Service Definitions Using the Same Namespace)*

**Question 15 : A, B, C** — `#[When(env: 'dev')]` limite l'enregistrement à un environnement, plusieurs attributs sont cumulables sur la même classe, et le YAML utilise `when@dev:`. La doc n'applique l'attribut qu'à des classes (D). *(§ Limiting Services to a specific Symfony Environment)*

**Question 16 : B** — Warning : « Each `when@<env>` block has its own scope and does not inherit `_defaults` from the main `services` section. Redefine `_defaults` in every `when@<env>` block where you need it. » *(§ Limiting Services to a specific Symfony Environment)*

**Question 17 : C** — « If you want to exclude a service from being registered in a specific environment, you can use the `#[WhenNot]` attribute » : `#[WhenNot(env: 'dev')]`, cumulable lui aussi. *(§ Limiting Services to a specific Symfony Environment)*

**Question 18 : C** — « This method of adding dependencies to your `__construct()` method is called *dependency injection*. » *(§ Injecting Services/Config into a Service)*

**Question 19 : A, B, C, D** — Les quatre sont vraies : scalaires « as is », constantes (« built-in, user-defined, or Enums ») via `!php/const`, binaire via `!!binary` (base64), et collections « can include any type of argument ». *(§ Injecting Services/Config into a Service)*

**Question 20 : A** — « The leading `@` tells this is a service ID, not a string. » En YAML, « any string starting with `@` is interpreted as a service ID rather than a regular string ». *(§ Injecting Services/Config into a Service / § Container Parameters and Service References)*

**Question 21 : B** — « Using `?` means to pass null if service doesn't exist » : `'@?some-service-id'`. En PHP : `service('...')->nullOnInvalid()`. *(§ Injecting Services/Config into a Service)*

**Question 22 : D** — « If the value of a string argument starts with `@`, you need to escape it by adding another `@` » : `'@@securepassword'` est parsé comme la chaîne `@securepassword`. *(§ Container Parameters and Service References)*

**Question 23 : A** — « In your configuration, you can explicitly set this argument » : `arguments: { $adminEmail: 'manager@example.com' }`. Le tip ajoute qu'on peut aussi injecter les scalaires via l'attribut `#[Autowire]`. *(§ Manually Wiring Arguments)*

**Question 24 : A, B, C** — « The other arguments will still be autowired » ; et ce n'est pas fragile : « If you rename the `$adminEmail` argument to something else […] you will get a clear exception when you reload the next page (even if that page doesn't use this service). » D est l'inverse de A. *(§ Manually Wiring Arguments)*

**Question 25 : A, B, C** — Les trois accesseurs documentés : `hasParameter()` (« parameter names are case-sensitive »), `getParameter()`, `setParameter()`. Pas de `removeParameter()` dans cette page. *(§ Container Parameters and Service References)*

**Question 26 : C** — « The used `.` notation is a Symfony convention to make parameters easier to read. Parameters are flat key-value elements, they can't be organized into a nested array. » *(§ Container Parameters and Service References)*

**Question 27 : B** — « You can only set a parameter before the container is compiled, not at run-time. » *(§ Container Parameters and Service References)*

**Question 28 : D** — `$logger: '@monolog.logger.request'` — « the `@` symbol is important: that's what tells the container you want to pass the *service* whose id is `monolog.logger.request`, and not just the *string* ». *(§ Choose a Specific Service)*

**Question 29 : A** — « For a list of possible logger services that can be used with autowiring, run: `php bin/console debug:autowiring logger`. » *(§ Choose a Specific Service)*

**Question 30 : B** — Tip : « If you need to choose between multiple implementations of the same type across your application, you can use named autowiring aliases instead of manually wiring each injection point. » *(§ Choose a Specific Service)*

**Question 31 : B** — L'exemple de la doc : dans `config/services_test.php`, `$services->remove(RemovedService::class);` — « the container will not contain the `App\RemovedService` in the `test` environment ». *(§ Remove Services)*

**Question 32 : C** — Le tag YAML `!closure` : `$generateMessageHash: !closure '@App\Hash\MessageHashGenerator'` (en PHP : `closure('App\Hash\MessageHashGenerator')`). Sans lui (A), c'est l'objet service qui serait injecté, pas un callable. *(§ Injecting a Closure as an Argument)*

**Question 33 : A, B, C** — « You can bind arguments by name (e.g. `$adminEmail`), by type (e.g. `Psr\Log\LoggerInterface`) or both (e.g. `Psr\Log\LoggerInterface $requestLogger`). » Un bind peut même référencer un tagged iterator (`iterable $rules: !tagged_iterator app.foo.rule`). D est faux : la portée est limitée au fichier. *(§ Binding Arguments by Name or Type)*

**Question 34 : D** — « By putting the `bind` key under `_defaults`, you can specify the value of *any* argument for *any* service defined in this file » — y compris les arguments de contrôleurs. Le `bind` peut aussi s'appliquer à des services spécifiques ou à un import `resource`. *(§ Binding Arguments by Name or Type)*

**Question 35 : A** — « The values of some service arguments can't be defined in the configuration files because they are calculated at runtime using a compiler pass or bundle extension. In those cases, you can use the `abstract` argument type to define at least the name of the argument and some short description about its purpose. » *(§ Abstract Service Arguments)*

**Question 36 : C** — « If you don't replace the value of an abstract argument during runtime, a `RuntimeException` will be thrown » avec un message reprenant la description fournie. *(§ Abstract Service Arguments)*

**Question 37 : B** — « With this setting, you're able to type-hint arguments in the `__construct()` method of your services and the container will automatically pass you the correct arguments. » L'enregistrement des classes (A), c'est l'import `resource` ; les tags automatiques (C), c'est `autoconfigure`. *(§ The autowire Option)*

**Question 38 : D** — « When you type-hint an argument, the container will automatically find the matching service. If it can't, you'll see a clear exception with a helpful suggestion. » *(§ Injecting Services/Config into a Service)*

**Question 39 : A, B, C** — « The container will automatically apply certain configuration to your services, based on your service's *class*. This is mostly used to *auto-tag* your services. » Exemple documenté : le tag `twig.extension` ajouté aux classes implémentant `Twig\Extension\ExtensionInterface`. `autoconfigure` complète l'autowiring, il ne le remplace pas (D). *(§ The autoconfigure Option)*

**Question 40 : A, B, C** — « Some attributes like `AsMessageHandler`, `AsEventListener` and `AsCommand` are registered for autoconfiguration. Any class using these attributes will have tags applied to them. » `#[AsService]` n'existe pas. *(§ The autoconfigure Option)*

**Question 41 : A, B, C, D** — Les quatre sont vraies : la commande « performs additional checks to ensure the container is properly configured », « useful to run before deploying your application to production (e.g. in your continuous integration server) », avec `--resolve-env-vars` qui « will fail if any of those environment variables are missing » ; et « performing those checks whenever the container is compiled can hurt performance. That's why they are […] disabled by default ». *(§ Linting Service Definitions)*

**Question 42 : D** — Les checks « are implemented in compiler passes called `CheckTypeDeclarationsPass` and `CheckAliasValidityPass`, which are disabled by default and enabled only when executing the `lint:container` command. If you don't mind the performance loss, you can enable these compiler passes in your application. » *(§ Linting Service Definitions)*

**Question 43 : A, B, C** — « Every service defined is private by default. When a service is private, you cannot access it directly from the container using `$container->get()`. As a best practice, you should only create *private* services and you should fetch services using dependency injection. » Rien n'annonce la dépréciation des services publics (D). *(§ Public Versus Private Services)*

**Question 44 : A** — « If you *do* need to make a service public, override the `public` setting » : `public: true`. *(§ Public Versus Private Services)*

**Question 45 : C** — « It is also possible to define a service as public thanks to the `#[Autoconfigure]` attribute. This attribute must be used directly on the class » : `#[Autoconfigure(public: true)]`. *(§ Public Versus Private Services)*

**Question 46 : B** — « If you need to fetch services lazily, instead of using public services you should consider using a service locator. » *(§ Public Versus Private Services)*

**Question 47 : B** — « The `id` of each service is its fully-qualified class name. » *(§ Importing Many Services at once with resource)*

**Question 48 : A, B, C** — « You can override any service that's imported by using its id (class name) below. If you override a service, none of the options (e.g. `public`) are inherited from the import (but the overridden service *does* still inherit from `_defaults`). » La surcharge se fait dans le même fichier, sous l'import (D faux). *(§ Importing Many Services at once with resource)*

**Question 49 : A** — La configuration par défaut : `exclude: '../src/{DependencyInjection,Entity,Kernel.php}'`. *(§ Importing Many Services at once with resource)*

**Question 50 : A, B, C, D** — Les quatre sont vraies : ids uniques, clé `class`, alias qui oriente le type-hint vers `site_update_manager.superadmin`, et le warning : sans alias avec le chargement automatique, « *three* services have been created (the automatic service + your two services) and the automatically loaded service will be passed - by default ». *(§ Explicitly Configuring Services and Arguments)*

**Question 51 : A** — Commentaire de l'exemple : « you CAN still use autowiring: we just want to show what it looks like without ». `autowire: false` n'y est que démonstratif. *(§ Explicitly Configuring Services and Arguments)*

**Question 52 : D** — « Create an alias, so that - by default - if you type-hint `SiteUpdateManager`, the `site_update_manager.superadmin` will be used. » *(§ Explicitly Configuring Services and Arguments)*

**Question 53 : B** — « If you want to pass the second, you'll need to manually wire the service or to create a named autowiring alias. » *(§ Explicitly Configuring Services and Arguments)*

**Question 54 : C** — « It is possible to automatically inject the current environment value by adding a string argument named `$env` to the closure. » *(§ Explicitly Configuring Services and Arguments)*

**Question 55 : A, B, C** — Le commentaire du fichier PHP par défaut : « Autowiring and autoconfiguration are enabled by default when using `App::config()` » ; `service()` référence un service et `->nullOnInvalid()` est l'équivalent du `@?` YAML. `param()` (D) référence un *paramètre*, pas un service. *(§ Automatic Service Loading in services.yaml / § Injecting Services/Config into a Service)*

**Question 56 : A** — En PHP : `'$rootNamespace' => abstract_arg('should be defined by Pass')`, équivalent du YAML `!abstract 'should be defined by Pass'`. *(§ Abstract Service Arguments)*

**Question 57 : D** — L'exemple PHP de la doc : `if ('dev' === $container->env()) { $services->set(App\Service\AnotherClass::class); }`. *(§ Limiting Services to a specific Symfony Environment)*

**Question 58 : A** — « Functional interfaces are interfaces with a single method. They are conceptually very similar to a closure except that their only method has a name. Moreover, they can be used as type-hints across your code. » *(§ Generating Adapters for Functional Interfaces)*

**Question 59 : D** — « Thanks to the `#[AutowireCallable]` attribute, you can now inject this `MessageUtils` service as a functional interface implementation » : `#[AutowireCallable(service: MessageUtils::class, method: 'format')]`. Un simple alias (C) ne marcherait pas : `MessageUtils` n'implémente pas l'interface. *(§ Generating Adapters for Functional Interfaces)*

**Question 60 : A, B, C** — L'option `from_callable` est l'alternative à l'attribut : « Symfony will generate a class (also called an *adapter*) implementing `MessageFormatterInterface` that will forward calls of `MessageFormatterInterface::format()` to your underlying service's method `MessageUtils::format()`, with all its arguments. » Aucune contrainte d'héritage de `\Closure` (D). *(§ Generating Adapters for Functional Interfaces)*
