# QCM — Configurer Symfony

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/configuration.html](https://symfony.com/doc/8.0/configuration.html) · **Généré le :** 19 juillet 2026
>
> **60 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Les fichiers de configuration

### Question 1

Quels fichiers et dossiers font partie de la structure par défaut du dossier `config/` d'une application Symfony ? *(plusieurs bonnes réponses)*

- [ ] **A.** `config/packages/`
- [ ] **B.** `config/bundles.php`
- [ ] **C.** `config/modules/`
- [ ] **D.** `config/preload.php`

### Question 2

Quel est le rôle du fichier `config/bundles.php` ? *(une seule bonne réponse)*

- [ ] **A.** Définir l'ordre de chargement des fichiers de configuration
- [ ] **B.** Activer et désactiver les packages de l'application
- [ ] **C.** Lister les classes à précharger avec OPcache
- [ ] **D.** Stocker la configuration de chaque bundle installé

### Question 3

Qu'est-ce que le fichier `config/reference.php` ? *(une seule bonne réponse)*

- [ ] **A.** Un fichier autogénéré par Symfony, qui améliore l'autocomplétion IDE et l'analyse statique quand on utilise le format PHP pour la configuration
- [ ] **B.** Un fichier listant les références de tous les services publics du container
- [ ] **C.** Un fichier à éditer manuellement pour référencer ses propres packages
- [ ] **D.** La configuration de référence du FrameworkBundle

### Question 4

Que fait Symfony Flex lors de l'installation d'un package ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il met à jour le fichier `bundles.php`
- [ ] **B.** Il crée les fichiers de configuration du package dans `config/packages/`
- [ ] **C.** Il ajoute au fichier `.env` les env vars définies par le package
- [ ] **D.** Il ajoute une entrée `extra.symfony.bundles` dans `composer.json`

### Question 5

Quelle commande permet de découvrir toutes les options de configuration disponibles ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:config`
- [ ] **B.** `php bin/console config:reference`
- [ ] **C.** `php bin/console config:dump-reference`
- [ ] **D.** `php bin/console debug:container --config`

## Les formats de configuration

### Question 6

Entre quels formats de configuration Symfony 8.0 permet-il de choisir ? *(une seule bonne réponse)*

- [ ] **A.** YAML, XML et PHP
- [ ] **B.** YAML uniquement
- [ ] **C.** YAML et PHP
- [ ] **D.** YAML, PHP et attributs PHP

### Question 7

Quelles affirmations sur les formats de configuration sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il n'y a aucune différence pratique entre les formats
- [ ] **B.** Symfony transforme toute la configuration en PHP et la met en cache avant d'exécuter l'application
- [ ] **C.** Le YAML est plus lent que le PHP à l'exécution
- [ ] **D.** Le YAML est utilisé par défaut à l'installation des packages

### Question 8

Quels avantages la documentation attribue-t-elle à chaque format ? *(plusieurs bonnes réponses)*

- [ ] **A.** YAML : simple, propre et lisible
- [ ] **B.** YAML : l'autocomplétion et la validation ne sont pas supportées par tous les IDE
- [ ] **C.** PHP : permet de créer une configuration dynamique avec des tableaux
- [ ] **D.** XML : le plus adapté à la validation par schéma

## L'import de fichiers de configuration

### Question 9

Sous quelle clé importe-t-on d'autres fichiers de configuration ? *(une seule bonne réponse)*

- [ ] **A.** `include`
- [ ] **B.** `imports`
- [ ] **C.** `resources`
- [ ] **D.** `load`

### Question 10

Quelles affirmations sur l'import de fichiers de configuration sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un fichier importé peut utiliser un format différent de celui du fichier qui l'importe
- [ ] **B.** Les expressions glob sont supportées pour charger plusieurs fichiers
- [ ] **C.** L'option `exclude` permet d'exclure certains fichiers d'un motif glob
- [ ] **D.** `ignore_errors: not_found` ignore silencieusement l'absence du fichier importé

### Question 11

Quelle est la différence entre `ignore_errors: true` et `ignore_errors: not_found` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune, ce sont des alias
- [ ] **B.** `true` ignore toutes les erreurs (y compris le code invalide), `not_found` seulement l'absence du fichier
- [ ] **C.** C'est l'inverse : `not_found` ignore toutes les erreurs
- [ ] **D.** `not_found` transforme l'erreur en warning dans les logs

## Les paramètres de configuration

### Question 12

Par convention, où définit-on les paramètres de configuration de l'application ? *(une seule bonne réponse)*

- [ ] **A.** Dans `config/parameters.yaml`
- [ ] **B.** Dans le fichier `.env`
- [ ] **C.** Dans `config/packages/parameters.yaml`
- [ ] **D.** Sous la clé `parameters` du fichier `config/services.yaml`

### Question 13

Quel préfixe la documentation recommande-t-elle pour les noms de vos paramètres ? *(une seule bonne réponse)*

- [ ] **A.** `symfony.`
- [ ] **B.** `parameters.`
- [ ] **C.** `custom.`
- [ ] **D.** `app.`

### Question 14

Quels types de valeurs un paramètre peut-il stocker ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des booléens
- [ ] **B.** Des tableaux/collections
- [ ] **C.** Du contenu binaire, via le tag `!!binary` et un encodage base64
- [ ] **D.** Des constantes PHP, via le tag `!php/const`

### Question 15

Quelle est la bonne syntaxe YAML pour utiliser un case d'enum comme valeur de paramètre ? *(une seule bonne réponse)*

- [ ] **A.** `app.some_enum: !php/const App\Enum\PostState::Published`
- [ ] **B.** `app.some_enum: App\Enum\PostState::Published`
- [ ] **C.** `app.some_enum: enum(App\Enum\PostState::Published)`
- [ ] **D.** `app.some_enum: !php/enum App\Enum\PostState::Published`

### Question 16

Comment référence-t-on la valeur d'un paramètre depuis un autre fichier de configuration YAML ? *(une seule bonne réponse)*

- [ ] **A.** `{{ app.admin_email }}`
- [ ] **B.** `$app.admin_email`
- [ ] **C.** `%app.admin_email%`
- [ ] **D.** `@app.admin_email`

### Question 17

La valeur d'un paramètre contient le caractère `%`. Que faut-il faire ? *(une seule bonne réponse)*

- [ ] **A.** L'échapper avec un antislash : `\%`
- [ ] **B.** Le doubler : `%%`
- [ ] **C.** Entourer la valeur de quotes simples
- [ ] **D.** Rien : le caractère n'a de sens qu'en début de chaîne

### Question 18

En format PHP (`App::config()`), quelles sont les bonnes façons de référencer un paramètre ? *(plusieurs bonnes réponses)*

- [ ] **A.** La fonction `param('app.admin_email')`
- [ ] **B.** La chaîne `'%app.admin_email%'`, comme en YAML
- [ ] **C.** La fonction `env('app.admin_email')`
- [ ] **D.** La fonction `parameter('app.admin_email')`

### Question 19

Que sont les paramètres dont le nom commence par un point, comme `.mailer.transport` ? *(une seule bonne réponse)*

- [ ] **A.** Des paramètres privés, inaccessibles aux bundles tiers
- [ ] **B.** Des paramètres dépréciés
- [ ] **C.** Des paramètres disponibles uniquement pendant la compilation du container, utiles dans les compiler passes
- [ ] **D.** Des paramètres chargés en dernier, après tous les autres

### Question 20

Quelles affirmations sur `$container->parameterCannotBeEmpty(...)` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une exception est levée si le paramètre vaut `null`, `''` ou `[]`
- [ ] **B.** La validation a lieu à la compilation du container
- [ ] **C.** La validation a lieu au moment où l'on tente de récupérer la valeur du paramètre
- [ ] **D.** La méthode accepte un message d'erreur personnalisé

## Les environnements de configuration

### Question 21

Quels sont les trois environnements d'une application Symfony typique ? *(une seule bonne réponse)*

- [ ] **A.** `dev`, `prod` et `test`
- [ ] **B.** `dev`, `staging` et `prod`
- [ ] **C.** `local`, `dev` et `prod`
- [ ] **D.** `debug`, `dev` et `prod`

### Question 22

Dans quel ordre Symfony charge-t-il les fichiers de configuration (les derniers pouvant surcharger les précédents) ? *(une seule bonne réponse)*

- [ ] **A.** `services.<ext>` → `packages/*.<ext>` → `packages/<env>/*.<ext>` → `services_<env>.<ext>`
- [ ] **B.** `packages/*.<ext>` → `packages/<env>/*.<ext>` → `services.<ext>` → `services_<env>.<ext>`
- [ ] **C.** `packages/<env>/*.<ext>` → `packages/*.<ext>` → `services_<env>.<ext>` → `services.<ext>`
- [ ] **D.** L'ordre alphabétique des noms de fichiers

### Question 23

Quelles affirmations sur la configuration par environnement dans un seul fichier sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le mot-clé spécial `when@prod:` permet de définir des options spécifiques à l'environnement `prod`
- [ ] **B.** Les valeurs définies sous `when@<env>` surchargent celles définies au niveau racine du fichier
- [ ] **C.** Les anchors et aliases YAML (`&nom` / `*nom`) permettent de réutiliser la configuration d'un autre environnement
- [ ] **D.** Le mot-clé `when@` ne fonctionne qu'en YAML, pas en PHP

### Question 24

Quelles affirmations sur la sélection de l'environnement actif sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** On change d'environnement en éditant la variable `APP_ENV` du fichier `.env` (ou `.env.local`)
- [ ] **B.** On change d'environnement en éditant `config/packages/environment.yaml`
- [ ] **C.** On peut surcharger l'environnement pour une commande : `APP_ENV=prod php bin/console ...`
- [ ] **D.** La valeur d'`APP_ENV` vaut à la fois pour le web et pour les commandes console

### Question 25

Quelles étapes sont nécessaires pour créer un environnement `staging` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Créer le dossier de configuration `config/packages/staging/`
- [ ] **B.** N'y définir que les différences, car les fichiers `config/packages/*.yaml` sont chargés en premier
- [ ] **C.** Sélectionner le nouvel environnement via `APP_ENV=staging`
- [ ] **D.** Déclarer le nouvel environnement dans `src/Kernel.php`

### Question 26

Que suggère la documentation quand plusieurs environnements sont très similaires ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser des liens symboliques entre les dossiers `config/packages/<environnement>/`
- [ ] **B.** Faire hériter un environnement d'un autre via une clé `extends`
- [ ] **C.** Copier-coller les fichiers de configuration
- [ ] **D.** Fusionner les environnements dans un dossier `shared/`

## Les variables d'environnement

### Question 27

Quelle syntaxe permet de référencer une variable d'environnement dans un fichier de configuration ? *(une seule bonne réponse)*

- [ ] **A.** `${DATABASE_URL}`
- [ ] **B.** `%env(DATABASE_URL)%`
- [ ] **C.** `env.DATABASE_URL`
- [ ] **D.** `%DATABASE_URL%`

### Question 28

Quelles affirmations sur la résolution des `%env(...)%` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les valeurs sont résolues au runtime, une seule fois par requête pour ne pas impacter les performances
- [ ] **B.** On peut changer le comportement de l'application sans vider le cache
- [ ] **C.** Les valeurs sont résolues à la compilation du container
- [ ] **D.** Les noms d'env vars peuvent contenir des points, par exemple `%env(FOO.BAR)%`

### Question 29

Quelles affirmations sur l'usage recommandé des env vars sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elles conviennent aux options qui dépendent de la machine (ex. credentials de base de données)
- [ ] **B.** Elles conviennent aux options qui changent dynamiquement en production (ex. une clé API expirée)
- [ ] **C.** Il est recommandé de basculer toute la configuration de l'application vers des env vars
- [ ] **D.** Par convention, les noms des env vars sont toujours en majuscules

### Question 30

L'application utilise une env var qui n'est définie nulle part. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** L'option reçoit la valeur `null`
- [ ] **B.** L'option reçoit une chaîne vide
- [ ] **C.** Une exception est levée
- [ ] **D.** Un warning est écrit dans les logs

### Question 31

Comment définit-on une valeur par défaut pour l'env var `SECRET` ? *(une seule bonne réponse)*

- [ ] **A.** En définissant `SECRET=some_secret` sous la clé `env_defaults` de `framework.yaml`
- [ ] **B.** En écrivant `%env(default:some_secret:SECRET)%`
- [ ] **C.** En ajoutant un défaut dans un fichier `.env.dist`
- [ ] **D.** En définissant un paramètre nommé `env(SECRET)` avec la valeur par défaut

### Question 32

Quelles affirmations sur les valeurs des env vars sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les valeurs des env vars ne peuvent être que des chaînes de caractères
- [ ] **B.** Les env var processors permettent de transformer leur contenu (ex. convertir en entier)
- [ ] **C.** Les env vars sont aussi accessibles via les superglobales `$_ENV` et `$_SERVER`, équivalentes
- [ ] **D.** Symfony caste automatiquement la valeur selon le type attendu par l'option de configuration

### Question 33

Quelles affirmations sur l'exposition des valeurs sensibles sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dumper le contenu de `$_SERVER` ou `$_ENV` affiche les valeurs des env vars
- [ ] **B.** La sortie de `phpinfo()` affiche les valeurs des env vars
- [ ] **C.** Le profiler Symfony expose les valeurs des env vars dans son interface web
- [ ] **D.** Le profiler masque automatiquement les valeurs des env vars sensibles

## Le fichier .env

### Question 34

Quelles affirmations sur le fichier `.env` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il est lu et parsé à chaque requête
- [ ] **B.** Ses variables sont ajoutées à `$_ENV` et `$_SERVER`
- [ ] **C.** Les env vars déjà existantes ne sont jamais écrasées par les valeurs du `.env`
- [ ] **D.** Il doit être commité dans le dépôt Git

### Question 35

Que doit contenir le fichier `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Les valeurs de production
- [ ] **B.** Des valeurs par défaut adaptées au développement local
- [ ] **C.** Uniquement des placeholders vides
- [ ] **D.** Rien : il doit rester vide et être surchargé par `.env.local`

### Question 36

Quelles syntaxes sont valides dans un fichier `.env` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les commentaires préfixés par `#`
- [ ] **B.** Référencer une autre variable : `DB_PASS=${DB_USER}pass`
- [ ] **C.** Définir une valeur par défaut si la variable n'est pas définie : `${DB_USER:-root}`
- [ ] **D.** L'interpolation de variables entre quotes simples : `'${DB_USER}pass'`

### Question 37

Quelle est la différence entre quotes simples et quotes doubles dans un `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Simples : valeur littérale (`$`, `#`… sans signification spéciale) ; doubles : les variables sont interpolées
- [ ] **B.** Aucune différence
- [ ] **C.** Doubles : valeur littérale ; simples : les variables sont interpolées
- [ ] **D.** Les quotes sont interdites dans un `.env`

### Question 38

Comment embarquer le résultat d'une commande dans une variable du `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Avec des backticks : `` START_TIME=`date` ``
- [ ] **B.** Avec le préfixe `exec:` : `START_TIME=exec:date`
- [ ] **C.** C'est impossible dans un fichier `.env`
- [ ] **D.** Avec `START_TIME=$(date)` — non supporté sur Windows

## Les fichiers .env multiples

### Question 39

Quels fichiers d'environnement doivent être commités dans le dépôt ? *(plusieurs bonnes réponses)*

- [ ] **A.** `.env`
- [ ] **B.** `.env.local`
- [ ] **C.** `.env.test`
- [ ] **D.** `.env.test.local`

### Question 40

Dans quel environnement le fichier `.env.local` est-il ignoré ? *(une seule bonne réponse)*

- [ ] **A.** `prod`
- [ ] **B.** `dev`
- [ ] **C.** Aucun : il est toujours chargé
- [ ] **D.** `test`

### Question 41

Quelle source de variables d'environnement gagne toujours sur les autres ? *(une seule bonne réponse)*

- [ ] **A.** Les « vraies » env vars, définies dans le shell ou le serveur web
- [ ] **B.** Le fichier `.env.local`
- [ ] **C.** Le fichier `.env`
- [ ] **D.** La dernière valeur définie, quel que soit l'endroit

### Question 42

Que fait le paramètre `overrideExistingVars: true` de `Dotenv::loadEnv()` ? *(une seule bonne réponse)*

- [ ] **A.** Il fait gagner les fichiers `.env` les uns sur les autres dans l'ordre inverse
- [ ] **B.** Il écrase les env vars définies par le système, mais pas celles définies dans les fichiers `.env`
- [ ] **C.** Il n'a d'effet que dans l'environnement `test`
- [ ] **D.** Il écrase toutes les env vars, y compris celles des autres fichiers `.env`

## Les env vars en production

### Question 43

Quelles affirmations sur `composer dump-env prod` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La commande parse TOUS les fichiers `.env`
- [ ] **B.** Elle dumpe les valeurs finales dans un fichier `.env.local.php`
- [ ] **C.** Ensuite, Symfony charge `.env.local.php` et ne perd plus de temps à parser les fichiers `.env`
- [ ] **D.** La documentation conseille de lancer ce dump après chaque déploiement

### Question 44

Comment utiliser la commande `dotenv:dump` quand Composer n'est pas installé en production ? *(une seule bonne réponse)*

- [ ] **A.** Elle est disponible par défaut, il suffit de la lancer
- [ ] **B.** Elle n'est pas enregistrée par défaut : il faut déclarer le service `Symfony\Component\Dotenv\Command\DotenvDumpCommand` dans `services.yaml`
- [ ] **C.** Il faut installer le bundle `symfony/dotenv-bundle`
- [ ] **D.** Elle est réservée aux applications utilisant Flex 2

## Chemins personnalisés et secrets

### Question 45

Comment changer le chemin du fichier `.env` avec le composant Runtime ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `extra.runtime.dotenv_path` du fichier `composer.json`
- [ ] **B.** Via l'option `framework.dotenv_path` de `framework.yaml`
- [ ] **C.** En définissant la variable `DOTENV_PATH`
- [ ] **D.** C'est impossible : le chemin est fixe

### Question 46

Comment l'application peut-elle connaître le chemin du fichier `.env` utilisé par Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Avec la commande `debug:dotenv --path`
- [ ] **B.** Via la constante `Dotenv::PATH`
- [ ] **C.** En lisant l'env var `SYMFONY_DOTENV_PATH`
- [ ] **D.** Via `$kernel->getDotenvPath()`

### Question 47

Une valeur de configuration est sensible (ex. une clé d'API). Que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** L'ajouter en clair dans `.env`, qui est commité
- [ ] **B.** La définir comme paramètre dans `services.yaml`
- [ ] **C.** L'encoder en base64 dans le `.env`
- [ ] **D.** La chiffrer via le système de gestion des secrets

## Déboguer la configuration

### Question 48

Quelle commande montre comment Symfony parse les différents fichiers `.env` pour établir la valeur de chaque variable ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:env`
- [ ] **B.** `php bin/console dotenv:debug`
- [ ] **C.** `php bin/console debug:dotenv`
- [ ] **D.** `php bin/console env:list`

### Question 49

Quelles affirmations sur `debug:container` appliqué aux env vars sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `--env-vars` liste toutes les env vars référencées dans la configuration du container
- [ ] **B.** La liste inclut le nombre d'occurrences de chaque env var dans le container
- [ ] **C.** `--env-var=FOO` affiche tous les détails d'une env var spécifique
- [ ] **D.** L'option `--env-vars` n'est disponible qu'en environnement `dev`

## Chargeurs d'env vars personnalisés

### Question 50

Comment implémenter sa propre logique de chargement d'env vars ? *(plusieurs bonnes réponses)*

- [ ] **A.** Créer un service dont la classe implémente `EnvVarLoaderInterface`
- [ ] **B.** Implémenter sa méthode `loadEnvVars()`, qui retourne un tableau
- [ ] **C.** Avec la configuration par défaut de `services.yaml`, l'autoconfiguration active et tague le service automatiquement
- [ ] **D.** Sans autoconfiguration, taguer le service avec `container.env_loader`

### Question 51

Comment faire en sorte qu'une env var soit définie dans un environnement, mais retombe sur les loaders dans un autre ? *(une seule bonne réponse)*

- [ ] **A.** Assigner une valeur vide à l'env var dans l'environnement où les loaders doivent s'appliquer
- [ ] **B.** Utiliser l'option `only_environments` du loader
- [ ] **C.** Entourer le loader d'une condition `when@`
- [ ] **D.** C'est impossible : les loaders s'appliquent à tous les environnements

## Les env vars dans la configuration des bundles

### Question 52

Que devient un `%env(...)%` utilisé dans la configuration d'un bundle (ex. `config/packages/doctrine.yaml`) au moment de la compilation ? *(une seule bonne réponse)*

- [ ] **A.** Il est résolu immédiatement avec la valeur courante de l'env var
- [ ] **B.** Il est remplacé par un placeholder unique ; la vraie valeur n'est résolue qu'au runtime, quand le service qui l'utilise est instancié
- [ ] **C.** Il est résolu au chargement du fichier YAML
- [ ] **D.** Rien : les `%env()%` sont interdits dans la configuration des bundles

### Question 53

Quelles règles les auteurs de bundles doivent-ils suivre pour supporter correctement les env vars au runtime ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ne pas écrire de `beforeNormalization()` qui inspecte ou transforme les *valeurs* des options
- [ ] **B.** Ne pas écrire de `validate()` qui vérifie les *valeurs* des options : à la compilation, ce sont encore des placeholders
- [ ] **C.** Dans `load()`, ne pas inspecter les valeurs traitées avant de les injecter dans les paramètres ou les définitions de services
- [ ] **D.** Suivre la règle générale : « wire the value into the container, don't inspect it »

### Question 54

Un service a besoin d'une version *parsée* d'un DSN (host, port, credentials…). Quelle est l'approche documentée ? *(une seule bonne réponse)*

- [ ] **A.** Parser le DSN dans l'extension DI, pendant la compilation du container
- [ ] **B.** Utiliser l'env var processor `dsn:`
- [ ] **C.** Créer un factory service qui parse le DSN au runtime
- [ ] **D.** Exiger des env vars séparées (`DB_HOST`, `DB_PORT`…)

## Accéder aux paramètres de configuration

### Question 55

Dans un contrôleur héritant d'`AbstractController`, comment lire un paramètre de configuration ? *(une seule bonne réponse)*

- [ ] **A.** `$this->params->get('app.admin_email')`
- [ ] **B.** `$_ENV['app.admin_email']`
- [ ] **C.** `$this->getConfig('app.admin_email')`
- [ ] **D.** `$this->getParameter('app.admin_email')`

### Question 56

Quelle est la méthode *recommandée* pour injecter un paramètre dans un service ? *(une seule bonne réponse)*

- [ ] **A.** Type-hinter `ContainerBagInterface` et appeler `get()`
- [ ] **B.** L'attribut `#[Autowire(param: 'app.contents_dir')]` sur l'argument du constructeur
- [ ] **C.** L'option `bind` de `_defaults`
- [ ] **D.** Injecter le container et appeler `getParameter()`

### Question 57

Comment injecter automatiquement `%kernel.project_dir%` dans tout service ou contrôleur définissant un argument `$projectDir` ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `bind` sous `services._defaults` : `$projectDir: '%kernel.project_dir%'`
- [ ] **B.** En répétant `#[Autowire]` sur chaque service
- [ ] **C.** Avec un trait PHP partagé
- [ ] **D.** C'est automatique dès que l'argument s'appelle `$projectDir`

### Question 58

Un service a besoin d'accéder à de nombreux paramètres. Que propose la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Type-hinter un argument du constructeur avec `ContainerBagInterface`, qui donne accès à tous les paramètres
- [ ] **B.** Injecter le service `parameter_bag_builder`
- [ ] **C.** Appeler `$this->getParameters()` hérité de la classe de base
- [ ] **D.** C'est déconseillé : il faut toujours injecter les paramètres un par un

### Question 59

Quelle commande liste tous les paramètres existants dans l'application ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:parameters`
- [ ] **B.** `php bin/console config:dump-reference`
- [ ] **C.** `php bin/console debug:container --parameters`
- [ ] **D.** `php bin/console cache:pool:list`

### Question 60

Quelles affirmations sur les paramètres définis par Symfony et les packages sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony définit lui-même des paramètres, comme `kernel.project_dir`
- [ ] **B.** Symfony définit lui-même des paramètres, comme `kernel.debug`
- [ ] **C.** Certains packages ajoutent leurs propres paramètres à `config/services.yaml` lors de leur installation
- [ ] **D.** Symfony définit un paramètre `symfony.version`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Configuring Symfony de la documentation Symfony 8.0](https://symfony.com/doc/8.0/configuration.html).

**Question 1 : A, B, D** — La structure par défaut contient `packages/`, `routes/`, `bundles.php`, `preload.php`, `reference.php`, `routes.yaml` et `services.yaml`. Pas de dossier `modules/`. *(§ Configuration Files)*

**Question 2 : B** — « The `bundles.php` file enables/disables packages in your application. » Le préchargement OPcache (C), c'est `preload.php` ; la config des bundles (D) vit dans `config/packages/`. *(§ Configuration Files)*

**Question 3 : A** — « The `reference.php` file is autogenerated by Symfony and contains definitions that improve IDE autocompletion and static analysis when using PHP as the configuration format. » *(§ Configuration Files)*

**Question 4 : A, B, C** — Flex « update the `bundles.php` file and create new files in `config/packages/` automatically during their installation », et plus loin : le `.env` « also contains the env vars defined by the third-party packages […] added automatically by Symfony Flex when installing packages ». D n'existe pas. *(§ Configuration Files / § Configuring Environment Variables in .env Files)*

**Question 5 : C** — « To learn about all the available configuration options, check out the Symfony Configuration Reference or run the `config:dump-reference` command. » `debug:config` (A) existe mais montre la configuration *actuelle*, pas toutes les options disponibles. *(§ Configuration Files)*

**Question 6 : C** — « Symfony doesn't impose a specific format on you to configure your applications, but lets you choose between YAML and PHP. » Le XML ne fait plus partie des formats proposés en Symfony 8, et les attributs PHP servent au routing, pas à la configuration générale. *(§ Configuration Formats)*

**Question 7 : A, B, D** — « There isn't any practical difference between formats. In fact, Symfony transforms all of them into PHP and caches them before running the application, so there's not even any performance difference. » « YAML is used by default when installing packages. » C contredit directement la doc. *(§ Configuration Formats)*

**Question 8 : A, B, C** — YAML : « simple, clean and readable, but not all IDEs support autocompletion and validation for it » ; PHP : « very powerful and it allows you to create dynamic configuration with arrays », avec autocomplétion et analyse statique via les array shapes. Le XML (D) n'est plus un format proposé. *(§ Configuration Formats)*

**Question 9 : B** — La clé `imports` (au pluriel), avec des entrées `{ resource: '...' }`. *(§ Importing Configuration Files)*

**Question 10 : A, B, D** — On peut importer « other configuration files, even if they use a different format », les globs sont supportés (`/etc/myapp/*.yaml`) et `ignore_errors: not_found` « silently discards errors if the loaded file doesn't exist ». Piège : l'option `exclude` sur les imports n'a été introduite qu'en **Symfony 8.1**. *(§ Importing Configuration Files)*

**Question 11 : B** — « `ignore_errors: true` silently discards all errors (including invalid code and not found) », tandis que `not_found` ne couvre que l'absence du fichier. *(§ Importing Configuration Files)*

**Question 12 : D** — « By convention, parameters are defined under the `parameters` key in the `config/services.yaml` file. » *(§ Configuration Parameters)*

**Question 13 : D** — « The `app.` prefix is recommended to better differentiate your parameters from Symfony parameters. » *(§ Configuration Parameters)*

**Question 14 : A, B, C, D** — Les quatre sont vraies : booléens, tableaux/collections, contenu binaire (`!!binary` + `base64_encode()`) et constantes PHP (`!php/const GLOBAL_CONSTANT` ou `!php/const App\Entity\BlogPost::MAX_ITEMS`). *(§ Configuration Parameters)*

**Question 15 : D** — Le tag YAML dédié aux enums est `!php/enum App\Enum\PostState::Published`. `!php/const` (A) sert aux constantes. *(§ Configuration Parameters)*

**Question 16 : C** — « Wrap the parameter name in two `%` (e.g. `%app.admin_email%`). » *(§ Configuration Parameters)*

**Question 17 : B** — « You need to escape it by adding another `%`, so Symfony doesn't consider it a reference to a parameter name » : `https://symfony.com/?foo=%%s`. *(§ Configuration Parameters)*

**Question 18 : A, B** — « When using the `param()` function, you only have to pass the parameter name […] but if you prefer it, you can also pass the name as a string surrounded by two `%`. » `env()` référence une env var, et `parameter()` n'existe pas. *(§ Configuration Parameters)*

**Question 19 : C** — « By convention, parameters whose names start with a dot `.` […] are available only during the container compilation. They are useful when working with Compiler Passes to declare some temporary parameters. » *(§ Configuration Parameters)*

**Question 20 : A, C, D** — « If a non-empty parameter is `null`, an empty string `''`, or an empty array `[]`, Symfony will throw an exception. This validation is **not** made at compile time but when attempting to retrieve the value of the parameter. » Le deuxième argument est le message personnalisé. *(§ Configuration Parameters)*

**Question 21 : A** — « A typical Symfony application begins with three environments: `dev` for local development, `prod` for production servers, `test` for automated tests. » *(§ Configuration Environments)*

**Question 22 : B** — L'ordre documenté : 1) `config/packages/*.<extension>` ; 2) `config/packages/<environment-name>/*.<extension>` ; 3) `config/services.<extension>` ; 4) `config/services_<environment-name>.<extension>`. « The last files can override the values set in the previous ones. » *(§ Configuration Environments)*

**Question 23 : A, B, C** — Le mot-clé `when@<env>` fonctionne dans un seul fichier, ses valeurs surchargent la config racine, et l'exemple de la doc réutilise une config via anchor/alias : `when@prod: &webpack_prod` puis `when@test: *webpack_prod`. D est faux : le format PHP supporte les clés `'when@prod' => [...]`. *(§ Configuration Environments)*

**Question 24 : A, C, D** — « Edit the value of the `APP_ENV` variable to change the environment » ; « This value is used both for the web and for the console commands. However, you can override it for commands by setting the `APP_ENV` value before running them: `APP_ENV=prod php bin/console command_name`. » B n'existe pas. *(§ Selecting the Active Environment)*

**Question 25 : A, B, C** — Les trois étapes documentées : créer `config/packages/staging/`, y configurer seulement les différences, sélectionner via `APP_ENV`. Aucune déclaration dans le Kernel n'est nécessaire (D). *(§ Creating a New Environment)*

**Question 26 : A** — « It's common for environments to be similar to each other, so you can use symbolic links between `config/packages/<environment-name>/` directories to reuse the same configuration. » La doc suggère aussi, en alternative, d'utiliser des env vars plutôt que de créer de nouveaux environnements. *(§ Creating a New Environment)*

**Question 27 : B** — « Use the special syntax `%env(ENV_VAR_NAME)%` to reference environment variables. » `${...}` (A) est la syntaxe interne aux fichiers `.env`. *(§ Configuration Based on Environment Variables)*

**Question 28 : A, B** — « The values of these options are resolved at runtime (only once per request, to not impact performance) so you can change the application behavior without having to clear the cache. » C est l'inverse. Piège pour D : le support des points dans les noms d'env vars (`FOO.BAR`) n'a été introduit qu'en **Symfony 8.1**. *(§ Configuration Based on Environment Variables)*

**Question 29 : A, B, D** — Les deux cas d'usage documentés (options dépendant de la machine, options dynamiques en production), et « by convention the env var names are always uppercase ». Pour le reste : « it's recommended to keep using configuration parameters » (C faux). *(§ Configuration Based on Environment Variables)*

**Question 30 : C** — « If your application tries to use an env var that hasn't been defined, you'll see an exception. » *(§ Configuration Based on Environment Variables)*

**Question 31 : D** — « Define a parameter with the same name as the env var using this syntax: `env(SECRET): 'some_secret'`. » Le processor `default:` (B) attend un nom de *paramètre* en fallback, pas une valeur littérale, et n'est pas la méthode documentée ici ; `.env.dist` (C) n'existe plus depuis longtemps. *(§ Configuration Based on Environment Variables)*

**Question 32 : A, B, C** — « The values of env vars can only be strings, but Symfony includes some env var processors to transform their contents (e.g. to turn a string value into an integer). » Et : « Your env vars can also be accessed via the PHP super globals `$_ENV` and `$_SERVER` (both are equivalent). » Aucun cast automatique (D). *(§ Configuration Based on Environment Variables)*

**Question 33 : A, B, C** — Danger documenté : « dumping the contents of the `$_SERVER` and `$_ENV` variables or outputting the `phpinfo()` contents will display the values of the environment variables », et « the values of the env vars are also exposed in the web interface of the Symfony profiler » — d'où l'interdiction absolue d'activer le profiler en production. *(§ Configuration Based on Environment Variables)*

**Question 34 : A, B, C, D** — Les quatre sont vraies : « The `.env` file is read and parsed on every request and its env vars are added to the `$_ENV` & `$_SERVER` PHP variables. Any existing env vars are *never* overwritten », et « this file should be committed to your repository ». *(§ Configuring Environment Variables in .env Files)*

**Question 35 : B** — Le `.env` « should only contain "default" values that are good for local development » et « should not contain production values ». *(§ Configuring Environment Variables in .env Files)*

**Question 36 : A, B, C** — Commentaires `#`, référence `${DB_USER}`, défaut `${DB_USER:-root}`. D est faux : « wrap values with single quotes to use them as literal strings » — pas d'interpolation entre quotes simples. *(§ .env File Syntax)*

**Question 37 : A** — Quotes simples : chaîne littérale où `$`, `#` et autres caractères spéciaux n'ont pas de signification. Quotes doubles : « variables are still interpolated but `#` and other characters are treated as literal ». *(§ .env File Syntax)*

**Question 38 : D** — « Embed commands via `$()` (not supported on Windows) » : `START_TIME=$(date)`. Warning : « using `$()` might not work depending on your shell ». *(§ .env File Syntax)*

**Question 39 : A, C** — « The `.env` and `.env.<environment>` files should be committed to the repository because they are the same for all developers and machines. However, the env files ending in `.local` **should not be committed**. » Le `.gitignore` fourni par Symfony les exclut d'ailleurs. *(§ Overriding Environment Values via .env.local)*

**Question 40 : D** — `.env.local` « is ignored in the `test` environment (because tests should produce the same results for everyone) ». *(§ Overriding Environment Values via .env.local)*

**Question 41 : A** — « *Real* environment variables always win over env vars created by any of the `.env` files. » Ce comportement dépend de `variables_order`, qui doit contenir `E` (c'est la configuration par défaut de PHP). *(§ Overriding Environment Values via .env.local)*

**Question 42 : B** — « This will override environment variables defined by the system but it **won't** override environment variables defined in `.env` files. » Le paramètre existe sur `loadEnv()`, `bootEnv()` et `populate()`. *(§ Overriding Environment Variables Defined By The System)*

**Question 43 : A, B, C, D** — Les quatre sont vraies : la commande « parses ALL .env files and dumps their final values to .env.local.php » ; ensuite « Symfony will load the `.env.local.php` file […] and will not spend time parsing the `.env` files » ; et le tip : « Update your deployment tools/workflow to run the `dotenv:dump` command after each deploy to improve the application performance. » *(§ Configuring Environment Variables in Production)*

**Question 44 : B** — « The command is not registered by default, so you must register first in your services: `Symfony\Component\Dotenv\Command\DotenvDumpCommand: ~`. » Disponible avec Flex 1.2+ (pas seulement Flex 2). *(§ Configuring Environment Variables in Production)*

**Question 45 : A** — « If you use the Runtime component, the dotenv path is part of the options you can set in your `composer.json` file » : `extra.runtime.dotenv_path`. Alternative : appeler soi-même `new Dotenv()->bootEnv(...)`. *(§ Storing Environment Variables In Other Files)*

**Question 46 : C** — « If you need to know the path to the `.env` file that Symfony is using, you can read the `SYMFONY_DOTENV_PATH` environment variable in your application. » *(§ Storing Environment Variables In Other Files)*

**Question 47 : D** — « If the value of a variable is sensitive (e.g. an API key or a database password), you can encrypt the value using the secrets management system. » *(§ Encrypting Environment Variables (Secrets))*

**Question 48 : C** — « Use the `debug:dotenv` command to understand how Symfony parses the different `.env` files. » On peut aussi lui passer un nom (complet ou partiel) de variable en argument. *(§ Listing Environment Variables)*

**Question 49 : A, B, C** — `debug:container --env-vars` liste les env vars référencées dans la config du container avec « the number of occurrences of each environment variable », et `--env-var=FOO` montre « all the details for a specific env var ». Pas de restriction à l'environnement `dev` (D). *(§ Listing Environment Variables)*

**Question 50 : A, B, C** — « Create a service whose class implements `EnvVarLoaderInterface` », dont la méthode `loadEnvVars(): array` retourne les variables. Avec la config par défaut, « the autoconfiguration feature will enable and tag this service automatically ». Piège de D : le tag exact est `container.env_var_loader`. *(§ Creating Your Own Logic To Load Env Vars)*

**Question 51 : A** — Tip : « If you want an env var to have a value on a certain environment but to fallback on loaders on another environment, assign an empty value to the env var for the environment you want to use loaders » — ex. `APP_ENV=` dans `.env.prod`. *(§ Creating Your Own Logic To Load Env Vars)*

**Question 52 : B** — « The value is **not** read at compile time. Instead, Symfony replaces it with a unique placeholder. The actual environment variable is only resolved at runtime, when the service using it is instantiated. » *(§ Environment Variables in Bundle Configuration)*

**Question 53 : A, B, C, D** — Les quatre règles sont documentées, dont la synthèse : « The general rule is: **wire the value into the container, don't inspect it**. » À la compilation, les valeurs sont des placeholders, pas les vraies valeurs. *(§ Environment Variables in Bundle Configuration)*

**Question 54 : C** — « Don't parse it in the DI extension during container compilation. Instead, create a **factory service** that parses the DSN at runtime. » C'est l'approche de DoctrineBundle avec sa `ConnectionFactory`. Le processor `dsn:` (B) n'existe pas. *(§ Handling DSNs and Values that Need Parsing)*

**Question 55 : D** — « In controllers extending from the `AbstractController`, use the `getParameter()` helper. » *(§ Accessing Configuration Parameters)*

**Question 56 : B** — « The recommended way is to use the `#[Autowire]` attribute » : `#[Autowire(param: 'app.contents_dir')]`. *(§ Accessing Configuration Parameters)*

**Question 57 : A** — « If you inject the same parameters over and over again, use the `services._defaults.bind` option instead. The arguments defined in that option are injected automatically whenever a service constructor or controller action defines an argument with that exact name. » *(§ Accessing Configuration Parameters)*

**Question 58 : A** — « Instead of injecting each of them individually, you can inject all the application parameters at once by type-hinting any of its constructor arguments with the `ContainerBagInterface`. » *(§ Accessing Configuration Parameters)*

**Question 59 : C** — « Run the following command to see all the parameters that exist in your application: `php bin/console debug:container --parameters`. » *(§ Accessing Configuration Parameters)*

**Question 60 : A, B, C** — « Symfony itself defines several parameters, including those related to the kernel configuration (e.g. `kernel.project_dir`, `kernel.debug`), and some packages add their own parameters to your `config/services.yaml` when installed. » `symfony.version` n'existe pas. *(§ Configuration Parameters)*
