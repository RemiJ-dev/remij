# QCM — Le système de bundles

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/bundles.html](https://symfony.com/doc/8.0/bundles.html) (questions 1 à 8) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/bundles.html#learn-more) (questions 9 à 40) · **Généré le :** 19 juillet 2026
>
> **40 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Le système de bundles

### Question 1

Depuis Symfony 4.0, quel est l'usage recommandé des bundles ? *(une seule bonne réponse)*

- [ ] **A.** Organiser le code de sa propre application en bundles
- [ ] **B.** Créer un bundle par module métier de l'application
- [ ] **C.** Uniquement **partager du code et des fonctionnalités entre plusieurs applications** — il n'est plus recommandé d'organiser son code applicatif en bundles
- [ ] **D.** Les bundles sont dépréciés, remplacés par les packages Composer

### Question 2

Quelles affirmations sur `config/bundles.php` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les bundles y sont activés **par environnement**
- [ ] **B.** `['all' => true]` active le bundle pour tous les environnements
- [ ] **C.** `['dev' => true, 'test' => true]` rend le bundle inutilisable en `prod`
- [ ] **D.** Avec Symfony Flex, ce fichier est mis à jour automatiquement à l'installation et à la suppression des bundles

### Question 3

Que faut-il au minimum pour créer un nouveau bundle ? *(une seule bonne réponse)*

- [ ] **A.** Une classe (même vide) étendant `AbstractBundle`, puis son activation dans `config/bundles.php`
- [ ] **B.** Une classe et un fichier `bundle.yaml` de manifeste
- [ ] **C.** Implémenter `BundleInterface` et ses trois méthodes obligatoires
- [ ] **D.** Exécuter la commande `php bin/console make:bundle`

### Question 4

Votre bundle doit rester compatible avec des versions de Symfony antérieures. Que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser des blocs `if (Kernel::VERSION_ID < …)` dans la classe du bundle
- [ ] **B.** Publier une branche par version de Symfony
- [ ] **C.** Rester sur `AbstractBundle`, rétrocompatible par design
- [ ] **D.** Étendre `Symfony\Component\HttpKernel\Bundle\Bundle` au lieu d'`AbstractBundle`

### Question 5

Quelles affirmations sur la structure de répertoires d'un bundle sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `public/` contient les assets web (images, CSS/JS compilés), copiés ou symlinkés dans le `public/` du projet via la commande `assets:install`
- [ ] **B.** `assets/` contient les **sources** des assets (JavaScript/TypeScript, CSS/Sass, contrôleurs Stimulus…)
- [ ] **C.** `translations/` contient les traductions organisées par domaine et locale (ex. `AcmeBlogBundle.en.xlf`)
- [ ] **D.** Les templates vivent dans `src/Resources/views/`

### Question 6

Quelle convention d'autoload la documentation recommande-t-elle dans le `composer.json` du bundle ? *(une seule bonne réponse)*

- [ ] **A.** PSR-0, pour la compatibilité maximale
- [ ] **B.** PSR-4 : le namespace en clé, l'emplacement de la classe principale (`src/`) en valeur — plus une entrée `autoload-dev` pour les tests
- [ ] **C.** Un classmap généré à chaque release
- [ ] **D.** Aucune : Symfony charge les classes du bundle lui-même

### Question 7

Quelles affirmations sur le développement local d'un bundle réutilisable sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un bundle ne peut pas s'exécuter seul : il doit être enregistré dans une application pour exécuter son code
- [ ] **B.** Bundle non publié : déclarer dans l'application un repository Composer de type `path` pointant vers le dossier local du bundle
- [ ] **C.** Bundle déjà publié : remplacer `vendor/acme/blog-bundle/` par un lien symbolique vers la copie locale de développement
- [ ] **D.** Il faut d'abord publier le bundle sur Packagist pour pouvoir le tester dans une application

### Question 8

Avec un repository de type `path`, que fait `composer require acme/blog-bundle` ? *(une seule bonne réponse)*

- [ ] **A.** Il crée un **lien symbolique** vers le répertoire local : tout changement dans le bundle est immédiatement visible dans l'application
- [ ] **B.** Il copie les fichiers — il faut relancer la commande à chaque modification
- [ ] **C.** Il télécharge malgré tout l'archive depuis Packagist
- [ ] **D.** Il échoue : le paquet doit être taggé au préalable

---

> Les questions 9 à 40 couvrent les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/bundles.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Surcharger un bundle

### Question 9

Quelles affirmations sur la surcharge des templates d'un bundle tiers sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** On les surcharge dans `templates/bundles/<BundleName>/`, en gardant le même nom et le même chemin relatif que l'original
- [ ] **B.** Pour ne surcharger que des blocks, le préfixe spécial `!` (`{% extends "@!AcmeUser/registration/confirmed.html.twig" %}`) permet d'étendre le template **original** et évite la boucle infinie
- [ ] **C.** Après l'ajout d'un template à un nouvel emplacement, il peut être nécessaire de vider le cache, même en mode debug
- [ ] **D.** La technique ne fonctionne pas pour les templates internes de Symfony

### Question 10

Comment « surcharger » le routing d'un bundle ? *(une seule bonne réponse)*

- [ ] **A.** Avec une clé `route_override` dans `config/routes.yaml`
- [ ] **B.** Impossible : les routes d'un bundle sont prioritaires
- [ ] **C.** En écrivant un compiler pass dédié
- [ ] **D.** Le routing n'est **jamais importé automatiquement** : le plus simple est de ne pas importer celui du bundle, d'en copier le fichier dans l'application, de le modifier et d'importer la copie

### Question 11

Quelles techniques la documentation donne-t-elle pour surcharger services, contrôleurs et formulaires d'un bundle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Modifier un service du bundle : la **décoration de service**
- [ ] **B.** Manipulations avancées (ex. supprimer des services) : travailler sur les définitions de services dans un **compiler pass**
- [ ] **C.** Contrôleur qui n'est pas un service : définir une nouvelle route + contrôleur avec le même path, chargée avant celle du bundle
- [ ] **D.** Form types existants : les modifier via des **form type extensions**

### Question 12

Peut-on surcharger les contraintes de validation déclarées par un bundle ? *(une seule bonne réponse)*

- [ ] **A.** Oui : le dernier fichier de validation chargé écrase les précédents
- [ ] **B.** Non — les fichiers de validation de tous les bundles sont fusionnés en un seul arbre : on peut **ajouter** des contraintes, pas les remplacer ; le contournement passe par les **groupes de validation** (que le bundle doit prévoir)
- [ ] **C.** Oui, avec l'option `framework.validation.override: true`
- [ ] **D.** Non, il faut forker le bundle

### Question 13

Comment surcharger les traductions d'un bundle ? *(une seule bonne réponse)*

- [ ] **A.** C'est impossible : les traductions d'un bundle sont figées
- [ ] **B.** Dans `translations/bundles/<BundleName>/`
- [ ] **C.** Les traductions sont liées aux **domaines**, pas aux bundles : il suffit de créer dans le `translations/` de l'application un fichier de même domaine (ex. `translations/AcmeUserBundle.es.yaml`)
- [ ] **D.** En dupliquant chaque clé dans le domaine `messages`

### Question 14

Quand peut-on surcharger le mapping des entités d'un bundle ? *(une seule bonne réponse)*

- [ ] **A.** Seulement si le bundle fournit une **mapped superclass** (comme l'entité `User` de FOSUserBundle) — attributs et associations sont alors surchargeables
- [ ] **B.** Toujours, quel que soit le mapping
- [ ] **C.** Jamais : le mapping d'un bundle est définitif
- [ ] **D.** Uniquement si le mapping est déclaré via des attributs PHP

## Annexe — Best practices des bundles réutilisables

### Question 15

Quelles affirmations sur le nommage d'un bundle sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le namespace suit PSR-4 : un segment vendor, zéro ou plusieurs segments de catégorie, et un nom court se terminant par `Bundle`
- [ ] **B.** Le nom de classe est en StudlyCaps, descriptif et court (deux mots maximum), préfixé du vendor et suffixé par `Bundle` (ex. `AcmeBlogBundle`)
- [ ] **C.** Chaque bundle a un **alias**, version courte en snake_case sans `Bundle` (`acme_blog`), utilisé pour l'unicité et les options de configuration
- [ ] **D.** Les bundles du core préfixent leur classe par `Symfony` (ex. `SymfonyFrameworkBundle`)

### Question 16

Quels fichiers sont **obligatoires** dans un bundle réutilisable ? *(plusieurs bonnes réponses)*

- [ ] **A.** `src/AcmeBlogBundle.php` — la classe qui transforme un simple répertoire en bundle
- [ ] **B.** `README.md` et `LICENSE`
- [ ] **C.** `docs/index.md` — la racine de la documentation
- [ ] **D.** `CHANGELOG.md` et `UPGRADE.md`

### Question 17

Votre bundle suit la structure recommandée mais étend `Bundle` (et non `AbstractBundle`). Que faut-il surcharger ? *(une seule bonne réponse)*

- [ ] **A.** `getName()`, pour retourner le nom du bundle
- [ ] **B.** `getPath()`, pour retourner `\dirname(__DIR__)`
- [ ] **C.** `getNamespace()`
- [ ] **D.** Rien : la structure est détectée automatiquement

### Question 18

Quelles affirmations sur le contenu d'un bundle sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un bundle ne doit **pas embarquer** de bibliothèques tierces, PHP comme JavaScript/CSS — il s'appuie sur l'autoloading standard
- [ ] **B.** Le mapping des entités Doctrine est recommandé en **XML** dans `config/doctrine/` : la surcharge du mapping est impossible quand il est déclaré via attributs
- [ ] **C.** Le répertoire du bundle est en **lecture seule** : les fichiers temporaires vont dans les répertoires `cache/` ou `log/` de l'application hôte
- [ ] **D.** La suite de tests doit couvrir au moins 80 % du code

### Question 19

Quelles affirmations sur les tests et la CI d'un bundle sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La suite de tests doit être exécutable avec un simple `phpunit` depuis une application d'exemple
- [ ] **B.** La CI doit tester au minimum : le **lower bound** des dépendances (`composer update --prefer-lowest`), les versions PHP supportées et toutes les versions majeures de Symfony supportées
- [ ] **C.** Lancer les tests avec `SYMFONY_DEPRECATIONS_HELPER=max[direct]=0` garantit que le bundle n'utilise directement aucune fonctionnalité dépréciée
- [ ] **D.** Pour accélérer la CI, il faut mettre en cache le répertoire `vendor/`

### Question 20

Quelle valeur de `type` faut-il dans le `composer.json` d'un bundle, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** `"type": "library"` — la valeur par défaut convient
- [ ] **B.** `"type": "symfony-plugin"`
- [ ] **C.** `"type": "symfony-bundle"` — Symfony Flex peut alors **activer automatiquement** le bundle à l'installation (et une recipe Flex couvre les setups supplémentaires)
- [ ] **D.** `"type": "bundle"`

### Question 21

Quelles conventions s'imposent aux routes, templates et traductions d'un bundle réutilisable ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les routes doivent être préfixées par l'alias du bundle (ex. `acme_blog_` pour AcmeBlogBundle)
- [ ] **B.** Les templates doivent utiliser Twig, et un bundle ne doit pas fournir de layout principal (sauf s'il fournit une application complète)
- [ ] **C.** Les traductions doivent être au format **XLIFF**, avec un domaine nommé d'après le bundle (`AcmeBlog` → `AcmeBlog.en.xlf`)
- [ ] **D.** Un bundle peut surcharger les messages de traduction d'un autre bundle

### Question 22

Quelles best practices s'appliquent aux services d'un bundle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les ids de services sont préfixés par l'alias du bundle (`acme_blog.`) au lieu d'utiliser des FQCN
- [ ] **B.** Pas d'autowiring ni d'autoconfiguration : tous les services sont définis **explicitement** (pour ne pas imposer d'overhead à la compilation)
- [ ] **C.** Les services internes sont **privés** ; pour les services publics, on crée des alias de l'interface vers l'id (ex. `Psr\Log\LoggerInterface` → `logger` dans MonologBundle)
- [ ] **D.** Un id préfixé d'un point (`.acme_blog.logger`) marque un service « caché », absent de la sortie par défaut de `debug:container`

### Question 23

Quel `name` mettre dans le `composer.json` d'`AcmeSocialConnectBundle`, publié par la société Acme ? *(une seule bonne réponse)*

- [ ] **A.** `acme/AcmeSocialConnectBundle`
- [ ] **B.** `acme/acme-social-connect-bundle`
- [ ] **C.** `social-connect/acme-bundle`
- [ ] **D.** `acme/social-connect-bundle` — vendor séparé, nom court **sans le vendor**, mots séparés par des tirets

### Question 24

Comment un bundle doit-il référencer ses propres ressources (fichiers de config, traductions…) ? *(une seule bonne réponse)*

- [ ] **A.** Toujours avec des chemins logiques `@AcmeBlogBundle/config/services.xml`
- [ ] **B.** Avec des **chemins physiques** (ex. `__DIR__/config/services.xml`) — les chemins logiques résolus par le resource locator ne sont plus une pratique recommandée
- [ ] **C.** Via un paramètre `%bundle_dir%`
- [ ] **D.** Via le service `file_locator` uniquement

### Question 25

Quelles affirmations sur la documentation d'un bundle sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Toutes les classes et fonctions doivent avoir un PHPDoc complet
- [ ] **B.** `docs/index.md` (ou `.rst`) est le seul fichier de documentation obligatoire et doit être le point d'entrée
- [ ] **C.** Le reStructuredText est le format utilisé pour rendre la documentation sur le site symfony.com
- [ ] **D.** La documentation est facultative si le README est suffisamment détaillé

## Annexe — Configuration sémantique d'un bundle

### Question 26

Quelles sont les deux façons de créer une configuration « friendly » pour un bundle ? *(une seule bonne réponse)*

- [ ] **A.** Via la **classe principale du bundle** (`AbstractBundle` — recommandé) ou via une **classe Extension** (méthode traditionnelle, réservée à la structure legacy)
- [ ] **B.** Via un fichier `config.yaml` embarqué ou une annotation `@Config`
- [ ] **C.** Via `parameters` ou via des variables d'environnement, exclusivement
- [ ] **D.** Il n'y en a qu'une : la classe `Configuration`

### Question 27

Quelles affirmations sur la configuration via `AbstractBundle` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `configure(DefinitionConfigurator $definition)` définit l'arbre de configuration via `$definition->rootNode()`
- [ ] **B.** `loadExtension()` reçoit un `$config` **déjà mergé et processé**
- [ ] **C.** `configure()` peut importer la définition depuis un ou plusieurs fichiers (`$definition->import('../config/definition.php')`, patterns glob acceptés)
- [ ] **D.** `configure()` et `loadExtension()` sont appelées à chaque requête

### Question 28

D'où vient la clé racine de la configuration d'un bundle (ex. `acme_social`) ? *(une seule bonne réponse)*

- [ ] **A.** De la constante `CONFIG_ROOT` de la classe du bundle
- [ ] **B.** Du paramètre `root` du fichier de configuration
- [ ] **C.** Elle est choisie librement par l'utilisateur du bundle
- [ ] **D.** Elle est déterminée automatiquement : le **snake case du nom du bundle sans le suffixe `Bundle`** (AcmeSocialBundle → `acme_social`)

### Question 29

Quelles affirmations sur la méthode traditionnelle (classe Extension + classe Configuration) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `load()` reçoit un **tableau de tableaux** : chaque fichier de configuration définissant la clé du bundle ajoute son propre tableau
- [ ] **B.** La classe `Configuration` implémente `ConfigurationInterface` et définit l'arbre dans `getConfigTreeBuilder()`
- [ ] **C.** `processConfiguration()` valide, normalise et fusionne les tableaux de configuration (une option inconnue lève une exception)
- [ ] **D.** `load()` reçoit l'instance réelle du container de l'application

### Question 30

Que permet la classe `ConfigurableExtension` ? *(une seule bonne réponse)*

- [ ] **A.** De déclarer la configuration via des attributs PHP
- [ ] **B.** De rendre la configuration modifiable à l'exécution
- [ ] **C.** D'implémenter `loadInternal(array $mergedConfig, ContainerBuilder $container)` en recevant une config **déjà traitée** — l'appel à `processConfiguration()` est fait automatiquement
- [ ] **D.** De désactiver la validation de la configuration

### Question 31

Quelle commande affiche la configuration par défaut d'un bundle ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:bundle-config acme_social`
- [ ] **B.** `php bin/console config:dump-reference` — elle affiche la configuration par défaut au format YAML dans la console
- [ ] **C.** `php bin/console config:show-defaults`
- [ ] **D.** `php bin/console lint:config`

## Annexe — Charger la configuration des services

### Question 32

Où les services d'un bundle sont-ils définis, et comment sont-ils chargés ? *(une seule bonne réponse)*

- [ ] **A.** Pas dans le `config/services.yaml` de l'application : le bundle les charge lui-même — via `loadExtension()` de sa classe principale (recommandé) ou via une classe Extension (méthode traditionnelle)
- [ ] **B.** Dans le `config/services.yaml` de l'application, importé par Flex
- [ ] **C.** Dans `config/bundles.php`, sous la clé du bundle
- [ ] **D.** Ils sont découverts automatiquement par autowiring

### Question 33

Quelles conventions une classe Extension doit-elle suivre pour être détectée automatiquement ? *(plusieurs bonnes réponses)*

- [ ] **A.** Vivre dans le namespace `DependencyInjection` du bundle
- [ ] **B.** Implémenter `ExtensionInterface` — généralement en étendant la classe `Extension`
- [ ] **C.** Porter le nom du bundle avec le suffixe `Bundle` remplacé par `Extension` (AcmeHelloBundle → `AcmeHelloExtension`)
- [ ] **D.** Être enregistrée manuellement dans tous les cas

### Question 34

La classe d'extension ne suit pas les conventions. Que faire ? *(une seule bonne réponse)*

- [ ] **A.** Rien : Symfony la trouve par réflexion
- [ ] **B.** La déclarer dans `config/bundles.php`
- [ ] **C.** Surcharger `Bundle::getContainerExtension()` pour retourner son instance — et si son nom ne suit pas la convention, surcharger aussi `Extension::getAlias()`
- [ ] **D.** Lui ajouter l'attribut `#[AsExtension]`

### Question 35

Comment l'alias DI d'une extension est-il déterminé par défaut ? *(une seule bonne réponse)*

- [ ] **A.** C'est le FQCN de la classe d'extension
- [ ] **B.** C'est la valeur de la propriété `$alias` de la classe
- [ ] **C.** C'est le nom du bundle en minuscules
- [ ] **D.** Le suffixe `Extension` est retiré et le nom converti en underscores : `AcmeHelloExtension` → `acme_hello`

### Question 36

Quels loaders la documentation mentionne-t-elle pour charger les fichiers de services dans `load()` ? *(une seule bonne réponse)*

- [ ] **A.** `XmlFileLoader` et `IniFileLoader`
- [ ] **B.** `PhpFileLoader` et `YamlFileLoader`, avec un `FileLocator` pointant vers le `config/` du bundle
- [ ] **C.** `AnnotationLoader`
- [ ] **D.** `GlobFileLoader` uniquement

## Annexe — Prepend : simplifier la configuration de plusieurs bundles

### Question 37

Quel problème le mécanisme de « prepend extension » résout-il ? *(une seule bonne réponse)*

- [ ] **A.** Il permet à une Extension de **préfixer la configuration d'autres bundles**, comme si l'utilisateur l'avait écrite explicitement — supprimant l'inconvénient des multiples petits bundles à la configuration répétitive
- [ ] **B.** Il accélère la compilation du container
- [ ] **C.** Il permet de charger les bundles dans un ordre alphabétique
- [ ] **D.** Il remplace les recipes Flex

### Question 38

Quelles affirmations sur `PrependExtensionInterface` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La méthode `prepend(ContainerBuilder $container)` est appelée **juste avant** l'appel de `load()` sur toutes les extensions enregistrées
- [ ] **B.** `prependExtensionConfig()` ne fait que préfixer les réglages : toute configuration écrite explicitement par l'utilisateur dans `config/*` garde la priorité
- [ ] **C.** Le paramètre `kernel.bundles` permet de détecter si un autre bundle est enregistré, et d'adapter la configuration en conséquence
- [ ] **D.** `prepend()` est appelée à chaque requête

### Question 39

Comment prepend de la configuration avec `AbstractBundle` ? *(une seule bonne réponse)*

- [ ] **A.** C'est impossible sans classe Extension dédiée
- [ ] **B.** En le déclarant dans `config/bundles.php`
- [ ] **C.** Dans la méthode `configure()`
- [ ] **D.** En définissant `prependExtension(ContainerConfigurator $container, ContainerBuilder $builder)` — ou via `$container->extension('framework', […], prepend: true)`

### Question 40

Deux bundles prepend la même clé de configuration de la même extension. Qui gagne ? *(une seule bonne réponse)*

- [ ] **A.** Le dernier bundle enregistré
- [ ] **B.** Une exception est levée
- [ ] **C.** Le bundle enregistré en **premier** : les suivants n'écraseront pas ce réglage
- [ ] **D.** Les valeurs sont fusionnées récursivement

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page The Bundle System de la documentation Symfony 8.0](https://symfony.com/doc/8.0/bundles.html). Pour les questions 9 à 40, le nom abrégé de la page annexe précède la section — *(Override — § …)*, *(Best Practices — § …)*, *(Configuration — § …)*, *(Extension — § …)*, *(Prepend — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : C** — Warning d'ouverture : « In Symfony versions prior to 4.0, it was recommended to organize your own application code using bundles. This is no longer recommended and bundles should only be used to share code and features between multiple applications. » *(introduction)*

**Question 2 : A, B, C, D** — Les quatre sont vraies : « Bundles used in your applications must be enabled per environment in the `config/bundles.php` file » ; `'all'` = tous les environnements ; l'exemple du WebProfilerBundle commente « enabled only in 'dev' and 'test', so you can't use it in 'prod' » ; et avec Flex, « bundles are enabled/disabled automatically for you when installing/removing them ». *(introduction)*

**Question 3 : A** — « This empty class is the only piece you need to create the new bundle » — une classe étendant `AbstractBundle`, activée ensuite dans `config/bundles.php`. *(§ Creating a Bundle)*

**Question 4 : D** — « If your bundle must be compatible with previous Symfony versions you have to extend from the `Symfony\Component\HttpKernel\Bundle\Bundle` instead. » *(§ Creating a Bundle)*

**Question 5 : A, B, C** — `public/` est « copied or symbolically linked into the project `public/` directory via the `assets:install` console command » ; `assets/` contient « the web asset sources » (JS/TS, CSS/Sass, contrôleurs Stimulus) ; `translations/` est organisé « by domain and locale ». D décrit la structure **legacy** — la structure recommandée utilise `templates/` à la racine du bundle. *(§ Bundle Directory Structure)*

**Question 6 : B** — « It's recommended to use the PSR-4 autoload standard: use the namespace as key, and the location of the bundle's main class (relative to `composer.json`) as value » + `autoload-dev` pour `Tests\`. *(§ Bundle Directory Structure)*

**Question 7 : A, B, C** — « A bundle cannot run on its own: it must be registered inside an application to execute its code » ; bundle non publié : repository `"type": "path"` ; bundle publié : `rm -rf vendor/acme/blog-bundle/` puis `ln -s ~/Projects/AcmeBlogBundle/ vendor/acme/blog-bundle`. D est faux : le repository `path` sert justement à tester **avant** publication. *(§ Developing a Reusable Bundle)*

**Question 8 : A** — « Composer will create a symbolic link (symlink) to your local bundle directory, so any change you make in the `AcmeBlogBundle/` directory is immediately visible in the application. » *(§ Using a Local Path Repository)*

**Question 9 : A, B, C** — Surcharge dans `templates/bundles/<bundle-name>/` avec « the same name and path (relative to `<bundle>/templates/`) as the original templates » ; « the special `!` prefix avoids errors when extending from an overridden template » ; et le warning : « you *may* need to clear your cache, even if you are in debug mode ». D est faux : « Symfony internals use some bundles too, so you can apply the same technique to override the core Symfony templates » (ex. pages d'erreur de TwigBundle). *(Override — § Templates)*

**Question 10 : D** — « Routing is never automatically imported in Symfony. […] The easiest way to "override" a bundle's routing is to never import it at all. Instead […] copy that routing file into your application, modify according to your needs, and import your copy instead. » *(Override — § Routing)*

**Question 11 : A, B, C, D** — Les quatre techniques documentées : décoration de service ; « removing services created by other bundles » via les définitions dans un compiler pass ; pour un contrôleur non-service, « define a new route + controller with the same path […] and make sure that the new route is loaded before the bundle one » ; et « existing form types can be modified defining form type extensions ». *(Override — § Controllers / Services & Configuration / Forms)*

**Question 12 : B** — « Symfony loads all validation configuration files from every bundle and combines them into one validation metadata tree. This means you are able to add new constraints to a property, but you cannot override them. » Contournement : les groupes de validation, que le bundle doit prévoir (ex. FOSUserBundle). *(Override — § Validation Metadata)*

**Question 13 : C** — « Translations are not related to bundles, but to translation domains. For this reason, you can override any bundle translation file from the main `translations/` directory, as long as the new file uses the same domain. » *(Override — § Translations)*

**Question 14 : A** — « Overriding entity mapping is only possible if a bundle provides a mapped superclass (such as the `User` entity in the FOSUserBundle). It's possible to override attributes and associations in this way. » *(Override — § Entities & Entity Mapping)*

**Question 15 : A, B, C** — Le namespace « starts with a vendor segment, followed by zero or more category segments, and it ends with the namespace short name, which must end with `Bundle` » ; la classe : StudlyCaps, « descriptive and short name (no more than two words) », préfixe vendor, suffixe `Bundle` ; l'alias est « the lower-cased short version of the bundle name using underscores » (`acme_blog`). D est l'inverse : « Symfony core Bundles do not prefix the Bundle class with `Symfony` » (ex. `Symfony\Bundle\FrameworkBundle\FrameworkBundle`). *(Best Practices — § Bundle Name)*

**Question 16 : A, B, C** — « The following files are mandatory » : `src/AcmeBlogBundle.php`, `README.md`, `LICENSE` et `docs/index.md` — « they ensure a structure convention that automated tools can rely on ». `CHANGELOG.md`/`UPGRADE.md` (D) ne sont pas dans la liste. *(Best Practices — § Directory Structure)*

**Question 17 : B** — « If your bundle extends the `Bundle` class, you have to override the `getPath()` method as follows: `return \dirname(__DIR__);` » — la structure recommandée n'est utilisée par défaut qu'avec `AbstractBundle`. *(Best Practices — § Directory Structure)*

**Question 18 : A, B, C** — « A bundle must not embed third-party PHP libraries […] should also not embed third-party libraries written in JavaScript, CSS » ; mapping Doctrine « using XML files stored in `config/doctrine/` […] This is not possible when using attributes » ; « The bundle directory is read-only. If you need to write temporary files, store them under the `cache/` or `log/` directory of the host application. » D est faux : « The tests should cover at least **95%** of the code base. » *(Best Practices — § Vendors / Doctrine / Tests)*

**Question 19 : A, B, C** — « The test suite must be executable with a simple `phpunit` command run from a sample application » ; la CI teste lower bound, versions PHP et « all supported major Symfony versions » ; `SYMFONY_DEPRECATIONS_HELPER` à `max[direct]=0` « ensures no code in the bundle uses deprecated features directly ». D est faux : « **do not** cache the `vendor/` directory as this has side-effects. Instead cache `$HOME/.composer/cache/files`. » *(Best Practices — § Continuous Integration)*

**Question 20 : C** — « Bundles should set `"type": "symfony-bundle"` in their `composer.json` file. With this, Symfony Flex will be able to automatically enable your bundle when it's installed » ; pour les setups supplémentaires, « you should create a Symfony Flex recipe ». *(Best Practices — § Installation)*

**Question 21 : A, B, C** — « If the bundle provides routes, they must be prefixed with the bundle alias » ; « If a bundle provides templates, they must use Twig. A bundle must not provide a main layout, except if it provides a full working application » ; traductions « defined in the XLIFF format; the domain should be named after the bundle name ». D est faux : « A bundle must not override existing messages from another bundle. » *(Best Practices — § Routing / Templates / Translation Files)*

**Question 22 : A, B, C, D** — Les quatre sont vraies : services « prefixed with the bundle alias instead of using fully qualified class names » ; « services should not use autowiring or autoconfiguration. Instead, all services should be defined explicitly » (pour ne pas imposer d'overhead) ; services internes privés + « aliases should be created from the interface/class to the service id » (ex. `Psr\Log\LoggerInterface` → `logger`) ; et le tip du service *hidden* : « prefixing it with a dot (e.g. `.acme_blog.logger`) […] prevents the service from being listed in the default `debug:container` command output ». *(Best Practices — § Services)*

**Question 23 : D** — « Exclude the vendor name from the bundle short name and separate each word with a hyphen. For example: […] AcmeSocialConnectBundle is transformed into `social-connect-bundle` » → `acme/social-connect-bundle`. *(Best Practices — § Composer Metadata)*

**Question 24 : B** — « You can use physical paths (e.g. `__DIR__/config/services.xml`). In the past, we recommended to only use logical paths (e.g. `@AcmeBlogBundle/config/services.xml`) […] but this is no longer a recommended practice. » *(Best Practices — § Resources)*

**Question 25 : A, B, C** — « All classes and functions must come with full PHPDoc » ; « The index file […] is the only mandatory file and must be the entry point for the documentation » ; « The reStructuredText (rST) is the format used to render the documentation on the Symfony website ». D contredit la règle du `docs/index.md` obligatoire. *(Best Practices — § Documentation)*

**Question 26 : A** — Les deux façons documentées : « Using the main bundle class: this is recommended for new bundles and for bundles following the recommended directory structure » ; « Using the Bundle extension class: this was the traditional way of doing it, but nowadays it's only recommended for bundles following the legacy directory structure. » *(Configuration — introduction)*

**Question 27 : A, B, C** — `configure()` construit l'arbre via `$definition->rootNode()` ; « the `$config` variable is already merged and processed » dans `loadExtension()` ; et le tip : « The `AbstractBundle::configure()` method also allows importing the configuration definition from one or more files » (globs acceptés). D est faux : « The `configure()` and `loadExtension()` methods are called only at compile time. » *(Configuration — § Using the AbstractBundle Class)*

**Question 28 : D** — « The root key of your bundle configuration […] is automatically determined from your bundle name (it's the snake case of the bundle name without the `Bundle` suffix). » *(Configuration — § Using the Bundle Extension)*

**Question 29 : A, B, C** — « Notice that this is an *array of arrays*, not just a single flat array » — chaque ressource de configuration ajoute son tableau (ex. `config/packages/dev/acme_social.yaml`) ; la classe `Configuration` implémente `ConfigurationInterface::getConfigTreeBuilder()` ; « The `processConfiguration()` method uses the configuration tree […] to validate, normalize and merge all the configuration arrays together » (option inconnue → exception). D est faux — c'est le `load()` de l'**Extension** qui reçoit une copie du container (voir la page Extension), pas l'instance réelle. *(Configuration — § Processing the $configs Array)*

**Question 30 : C** — `ConfigurableExtension` évite d'appeler `processConfiguration()` soi-même : « note that this method is called `loadInternal` and not `load` » et reçoit `$mergedConfig`. *(Configuration — § Processing the $configs Array)*

**Question 31 : B** — « The `config:dump-reference` command dumps the default configuration of a bundle in the console using the Yaml format. » Elle fonctionne automatiquement si la `Configuration` est à l'emplacement standard et sans constructeur ; sinon, surcharger `Extension::getConfiguration()`. *(Configuration — § Dump the Configuration)*

**Question 32 : A** — « Services created by bundles are not defined in the main `config/services.yaml` file used by the application but in the bundles themselves » — via `loadExtension()` (« recommended for new bundles ») ou une classe Extension (« the traditional way »). *(Extension — introduction)*

**Question 33 : A, B, C** — Les conventions : « It has to live in the `DependencyInjection` namespace of the bundle » ; « It has to implement the `ExtensionInterface`, which is usually achieved by extending the `Extension` class » ; « The name is equal to the bundle name with the `Bundle` suffix replaced by `Extension` ». D est faux : l'enregistrement manuel (via `getContainerExtension()`) n'est nécessaire que si on ne suit **pas** les conventions. *(Extension — § Creating an Extension Class)*

**Question 34 : C** — « When not following the conventions, you will have to manually register your extension […] override the `Bundle::getContainerExtension()` method » ; et si le nom de la classe ne suit pas la convention, « you must also override the `Extension::getAlias()` method to return the correct DI alias ». *(Extension — § Manually Registering an Extension Class)*

**Question 35 : D** — « By default, this is done by removing the `Extension` suffix and converting the class name to underscores (e.g. `AcmeHelloExtension`'s DI alias is `acme_hello`). » *(Extension — § Manually Registering an Extension Class)*

**Question 36 : B** — L'exemple utilise `new PhpFileLoader($container, new FileLocator(__DIR__.'/../../config'))` puis `$loader->load('services.php')` ; « The other available loader is `YamlFileLoader`. » À noter : `load()` ne reçoit pas le container réel mais une copie (avec les seuls paramètres), mergée ensuite dans le vrai container. *(Extension — § Using the load() Method)*

**Question 37 : A** — « It is possible to remove the disadvantage of the multiple bundle approach by enabling a single Extension to prepend the settings for any bundle […] just as if they had been written explicitly by the user in the application configuration. » *(Prepend — introduction)*

**Question 38 : A, B, C** — `prepend()` donne accès au `ContainerBuilder` « just before the `load()` method is called on each of the registered bundle Extensions » ; « As this method only prepends settings, any other settings done explicitly inside the `config/*` files would override these prepended settings » ; et l'exemple lit `$container->getParameter('kernel.bundles')` pour détecter AcmeGoodbyeBundle. D est faux : « The `prependExtension()` method, like `prepend()`, is called only at compile time. » *(Prepend)*

**Question 39 : D** — Avec `AbstractBundle`, « define the `prependExtension()` method » (`prependExtensionConfig()` ou import de fichier) ; « alternatively, you can use the `prepend` parameter of the `ContainerConfigurator::extension()` method » : `$container->extension('framework', […], prepend: true)`. *(Prepend — § Prepending Extension in the Bundle Class)*

**Question 40 : C** — « If there is more than one bundle that prepends the same extension and defines the same key, the bundle that is registered **first** will take priority: next bundles won't override this specific config setting. » *(Prepend — § More than one Bundle using PrependExtensionInterface)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/bundles.html#learn-more) de la page :

- [How to Override any Part of a Bundle](https://symfony.com/doc/8.0/bundles/override.html) — questions 9 à 14
- [Best Practices for Reusable Bundles](https://symfony.com/doc/8.0/bundles/best_practices.html) — questions 15 à 25
- [How to Create Friendly Configuration for a Bundle](https://symfony.com/doc/8.0/bundles/configuration.html) — questions 26 à 31
- [How to Load Service Configuration inside a Bundle](https://symfony.com/doc/8.0/bundles/extension.html) — questions 32 à 36
- [How to Simplify Configuration of Multiple Bundles](https://symfony.com/doc/8.0/bundles/prepend_extension.html) — questions 37 à 40
