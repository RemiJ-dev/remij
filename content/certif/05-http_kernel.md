# QCM — Le composant HttpKernel et la configuration du Kernel

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/components/http_kernel.html](https://symfony.com/doc/8.0/components/http_kernel.html) et [symfony.com/doc/8.0/reference/configuration/kernel.html](https://symfony.com/doc/8.0/reference/configuration/kernel.html) · **Généré le :** 19 juillet 2026
>
> **60 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Le composant HttpKernel

### Question 1

Quel est le rôle du composant HttpKernel ? *(une seule bonne réponse)*

- [ ] **A.** Fournir un processus structuré pour convertir une `Request` en `Response`, en s'appuyant sur le composant EventDispatcher
- [ ] **B.** Gérer le routage des requêtes HTTP entrantes
- [ ] **C.** Fournir une abstraction orientée objet des messages HTTP (requête, réponse, session)
- [ ] **D.** Servir de serveur web PHP embarqué pour le développement

### Question 2

Quelle est la signature de `HttpKernelInterface::handle()` ? *(une seule bonne réponse)*

- [ ] **A.** `handle(Request $request): ?Response`
- [ ] **B.** `handle(Request $request, bool $catch = true, int $type = self::MAIN_REQUEST): Response`
- [ ] **C.** `handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response`
- [ ] **D.** `handle(Request $request, string $env, bool $debug): Response`

### Question 3

Quelles affirmations sur le fonctionnement interne de `HttpKernel::handle()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La méthode fonctionne en dispatchant des événements
- [ ] **B.** Tout le « travail » d'un framework construit sur HttpKernel est en réalité effectué dans des event listeners
- [ ] **C.** Cela rend la méthode à la fois flexible et un peu abstraite
- [ ] **D.** Chaque étape du cycle appelle directement des services câblés en dur dans le kernel

### Question 4

Quels arguments le constructeur de `HttpKernel` reçoit-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un event dispatcher
- [ ] **B.** Un controller resolver
- [ ] **C.** Une `RequestStack`
- [ ] **D.** Un argument resolver

### Question 5

Avec quelle méthode envoie-t-on ensuite la `Response` retournée par `handle()` au client ? *(une seule bonne réponse)*

- [ ] **A.** `$response->flush()`
- [ ] **B.** `$response->send()`
- [ ] **C.** `$kernel->send($response)`
- [ ] **D.** `echo $response`

## L'événement kernel.request

### Question 6

Quels sont les buts typiques d'un listener de `kernel.request` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ajouter des informations à la `Request` (ex. déterminer et poser la locale)
- [ ] **B.** Initialiser certaines parties du système
- [ ] **C.** Retourner une `Response` directement quand c'est possible (ex. une couche de sécurité qui refuse l'accès)
- [ ] **D.** Transformer en `Response` la valeur de retour du contrôleur

### Question 7

Un listener de `kernel.request` définit une `Response`. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Le contrôleur est quand même résolu et appelé, puis sa réponse est ignorée
- [ ] **B.** Le processus saute directement à l'événement `kernel.response`
- [ ] **C.** L'événement `kernel.view` est dispatché avec cette réponse
- [ ] **D.** Une exception est levée : seul un contrôleur peut créer la `Response`

### Question 8

Dans le framework Symfony, quel est le listener le plus important de `kernel.request` ? *(une seule bonne réponse)*

- [ ] **A.** `ControllerResolver`
- [ ] **B.** `FirewallListener`
- [ ] **C.** `LocaleListener`
- [ ] **D.** `RouterListener`

### Question 9

Quelles affirmations sur le `RouterListener` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il exécute la couche de routing
- [ ] **B.** Le routing retourne un tableau d'informations, dont `_controller` et les placeholders de la route (ex. `{slug}`)
- [ ] **C.** Ces informations sont stockées dans l'attributes bag de la `Request`
- [ ] **D.** Il instancie immédiatement le contrôleur trouvé

## La résolution du contrôleur

### Question 10

Pour HttpKernel, qu'est-ce qu'un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Une classe qui étend `AbstractController`
- [ ] **B.** Une classe portant l'attribut `#[AsController]`
- [ ] **C.** Une classe implémentant `ControllerInterface`
- [ ] **D.** N'importe quel callable PHP : une fonction, une méthode d'objet ou une `Closure`

### Question 11

Quelle est la signature de `ControllerResolverInterface::getController()` ? *(une seule bonne réponse)*

- [ ] **A.** `getController(Request $request): callable|false`
- [ ] **B.** `getController(Request $request): callable`
- [ ] **C.** `getController(Request $request): ?callable`
- [ ] **D.** `getController(string $controller): callable`

### Question 12

Quelles affirmations sur le `ControllerResolver` utilisé par le framework Symfony sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il cherche une clé `_controller` dans les attributs de la `Request`
- [ ] **B.** Cette information y a typiquement été placée par le `RouterListener`
- [ ] **C.** La classe du contrôleur est instanciée sans arguments de constructeur
- [ ] **D.** Il résout aussi les arguments à passer à la méthode du contrôleur

## L'événement kernel.controller

### Question 13

Que peut faire un listener de l'événement `kernel.controller` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Initialiser des choses après la détermination du contrôleur mais avant son exécution
- [ ] **B.** Récupérer les attributs PHP du contrôleur via `ControllerEvent::getAttributes()`
- [ ] **C.** Remplacer complètement le contrôleur via `ControllerEvent::setController()`
- [ ] **D.** Modifier les arguments déjà résolus du contrôleur

### Question 14

Que fait le `CacheAttributeListener` du framework Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Il met en cache le résultat de l'exécution du contrôleur
- [ ] **B.** Il lit la configuration de l'attribut `#[Cache]` du contrôleur et l'utilise pour configurer le cache HTTP de la réponse
- [ ] **C.** Il vide le cache applicatif avant chaque requête
- [ ] **D.** Il génère automatiquement les headers `ETag` de toutes les réponses

## Les arguments du contrôleur

### Question 15

Quel service détermine le tableau d'arguments à passer au contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Le `ControllerResolver`, via `getController()`
- [ ] **B.** Le `Router`, au moment du matching
- [ ] **C.** Le `ValueResolver`, appelé directement par le kernel
- [ ] **D.** L'`ArgumentResolver`, via `ArgumentResolverInterface::getArguments()`

### Question 16

Selon quelles règles l'`ArgumentResolver` du framework choisit-il la valeur de chaque argument ? *(plusieurs bonnes réponses)*

- [ ] **A.** Si l'attributes bag de la `Request` contient une clé du même nom que l'argument (ex. `$slug` ← clé `slug`), cette valeur est utilisée
- [ ] **B.** Un argument type-hinté avec `Request` reçoit l'objet `Request` courant
- [ ] **C.** Un argument variadic reçoit toutes les valeurs du tableau correspondant de l'attributes bag
- [ ] **D.** Les paramètres de la query string sont injectés automatiquement par nom

### Question 17

Comment étendre la logique de résolution des arguments ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `ValueResolverInterface` et en le passant à l'`ArgumentResolver`
- [ ] **B.** En étendant la classe finale `ArgumentResolver`
- [ ] **C.** En décorant le kernel HTTP
- [ ] **D.** C'est impossible : la résolution est figée

## L'appel du contrôleur et kernel.view

### Question 18

Le contrôleur retourne `null`. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Une réponse vide avec le status 204 est générée
- [ ] **B.** L'événement `kernel.view` est dispatché avec `null`
- [ ] **C.** Une exception est levée immédiatement
- [ ] **D.** Une réponse 500 est envoyée, sans exception

### Question 19

Le contrôleur retourne un tableau de données (pas une `Response`). Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée immédiatement
- [ ] **B.** Le tableau est automatiquement converti en `JsonResponse`
- [ ] **C.** L'événement `kernel.response` reçoit le tableau tel quel
- [ ] **D.** L'événement `kernel.view` est dispatché, pour transformer cette valeur en `Response`

### Question 20

Quelles affirmations sur l'événement `kernel.view` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le job d'un listener est d'utiliser la valeur de retour du contrôleur pour créer une `Response`
- [ ] **B.** Si aucun listener ne définit de `Response`, une exception est levée
- [ ] **C.** Quand un listener définit une `Response`, la propagation est stoppée
- [ ] **D.** Il est aussi dispatché quand le contrôleur retourne une `Response`

### Question 21

Dans le framework Symfony, que fait le listener par défaut de `kernel.view` ? *(une seule bonne réponse)*

- [ ] **A.** Si l'action retourne un tableau et porte l'attribut `#[Template]`, il rend le template avec ce tableau et crée la `Response`
- [ ] **B.** Il sérialise automatiquement la valeur de retour en JSON
- [ ] **C.** Il n'y a aucun listener par défaut sur cet événement
- [ ] **D.** Il rend automatiquement le template `<controller>.html.twig`

## L'événement kernel.response

### Question 22

Par qui la `Response` finale peut-elle avoir été créée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un listener de `kernel.request`
- [ ] **B.** Le contrôleur
- [ ] **C.** Un listener de `kernel.view`
- [ ] **D.** Un listener de `kernel.exception`

### Question 23

Quels listeners du framework Symfony écoutent `kernel.response` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `WebDebugToolbarListener`, qui injecte le JavaScript de la debug toolbar en environnement `dev`
- [ ] **B.** `ContextListener` (Security), qui sérialise les informations de l'utilisateur courant en session
- [ ] **C.** `RouterListener`, qui génère les URLs de la page
- [ ] **D.** `ErrorListener`, qui convertit les exceptions en réponses d'erreur

## L'événement kernel.terminate

### Question 24

Quelles affirmations sur `kernel.terminate` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il se produit après `HttpKernel::handle()`, une fois la réponse envoyée à l'utilisateur
- [ ] **B.** Il est déclenché par l'appel explicite `$kernel->terminate($request, $response)`
- [ ] **C.** Il sert à exécuter des actions « lourdes » qu'on a retardées pour répondre plus vite (ex. envoi d'emails)
- [ ] **D.** Il est dispatché à l'intérieur de la méthode `handle()`, juste après `kernel.response`

### Question 25

Grâce à `fastcgi_finish_request()`, quels serveurs peuvent envoyer la réponse au client pendant que le process PHP exécute encore les listeners de terminate ? *(une seule bonne réponse)*

- [ ] **A.** Tous les SAPI PHP
- [ ] **B.** Apache avec mod_php uniquement
- [ ] **C.** PHP-FPM et FrankenPHP
- [ ] **D.** Aucun : la réponse part toujours après l'exécution de tous les listeners

### Question 26

Quelles affirmations sur la modification de la `Response` dans un listener de `kernel.terminate` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sur les serveurs qui flushent tôt (PHP-FPM, FrankenPHP), la réponse est déjà envoyée : les modifications sont jetées
- [ ] **B.** En mode debug (`kernel.debug = true`), la réponse n'est pas finalisée avant `kernel.terminate` : les modifications peuvent encore l'affecter
- [ ] **C.** Cela peut produire des comportements incohérents entre développement et production
- [ ] **D.** C'est le moyen recommandé d'ajouter des headers à la réponse

### Question 27

À quelle condition peut-on utiliser l'événement `kernel.terminate` ? *(une seule bonne réponse)*

- [ ] **A.** Le kernel doit implémenter `TerminableInterface`
- [ ] **B.** L'application doit tourner derrière un reverse proxy
- [ ] **C.** L'option `framework.terminate` doit être activée
- [ ] **D.** Aucune : l'événement est toujours dispatché automatiquement

### Question 28

Quels sont le premier et le dernier événement d'un cycle requête/réponse réussi ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.request` et `kernel.finish_request`
- [ ] **B.** `kernel.boot` et `kernel.terminate`
- [ ] **C.** `kernel.request` et `kernel.terminate`
- [ ] **D.** `kernel.controller` et `kernel.response`

## L'événement kernel.exception

### Question 29

Quelles affirmations sur la gestion des exceptions dans `handle()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le corps de la méthode `handle()` est entouré d'un bloc try-catch
- [ ] **B.** Toute exception levée pendant `handle()` déclenche l'événement `kernel.exception`
- [ ] **C.** Un listener accède à l'exception d'origine via `ExceptionEvent::getThrowable()`
- [ ] **D.** La propagation continue même après qu'un listener a défini une `Response`

### Question 30

Que permet de savoir la méthode `ExceptionEvent::isKernelTerminating()` ? *(une seule bonne réponse)*

- [ ] **A.** Si la réponse a déjà été envoyée au client
- [ ] **B.** Si l'exception va interrompre le worker
- [ ] **C.** Si le kernel implémente `TerminableInterface`
- [ ] **D.** Si le kernel était en train de terminer au moment où l'exception a été levée

### Question 31

Quelles affirmations sur l'`ErrorListener` du composant HttpKernel sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il convertit l'exception en un objet `FlattenException`, imprimable et sérialisable
- [ ] **B.** Si l'exception implémente `HttpExceptionInterface`, `getStatusCode()` et `getHeaders()` alimentent la `FlattenException`
- [ ] **C.** Si l'exception implémente `RequestExceptionInterface`, le status est 400 et aucun autre header n'est modifié
- [ ] **D.** Il exécute un contrôleur (passé en argument de son constructeur) qui reçoit l'exception aplatie et rend la page d'erreur

### Question 32

Comment générer une page 404 avec le composant HttpKernel ? *(une seule bonne réponse)*

- [ ] **A.** Retourner `null` depuis le contrôleur
- [ ] **B.** Lancer un type d'exception spécifique, et ajouter un listener sur `kernel.exception` qui le détecte et crée une `Response` 404
- [ ] **C.** Appeler `$kernel->abort(404)`
- [ ] **D.** Définir un attribut `_status` sur la `Request`

### Question 33

Comment définir des headers HTTP personnalisés sur une réponse d'erreur ? *(une seule bonne réponse)*

- [ ] **A.** Avec la méthode `setHeaders()` des exceptions dérivées de `HttpException`
- [ ] **B.** En modifiant la `Response` dans un listener de `kernel.terminate`
- [ ] **C.** Via l'option `framework.error_headers`
- [ ] **D.** C'est impossible : les réponses d'erreur ont des headers figés

### Question 34

Quel listener du composant Security écoute `kernel.exception` ? *(une seule bonne réponse)*

- [ ] **A.** `FirewallListener`
- [ ] **B.** `AccessDeniedListener`
- [ ] **C.** `ExceptionListener`, qui gère les exceptions de sécurité et aide l'utilisateur à s'authentifier (ex. redirection vers la page de login)
- [ ] **D.** `GuardAuthenticatorListener`

## La réinitialisation de l'état

### Question 35

Comment éviter qu'un service accumule de l'état entre les requêtes dans un runtime long-vivant (ex. FrankenPHP en mode worker) ? *(plusieurs bonnes réponses)*

- [ ] **A.** Faire implémenter `ResetInterface` au service
- [ ] **B.** Nettoyer l'état accumulé dans sa méthode `reset()`
- [ ] **C.** Le kernel appelle `reset()` automatiquement après chaque cycle requête/réponse
- [ ] **D.** Définir l'env var `FRANKENPHP_RESET_KERNEL`, documentée à cet effet en Symfony 8.0

## Les événements du kernel

### Question 36

Où les noms des événements du kernel sont-ils définis ? *(une seule bonne réponse)*

- [ ] **A.** Comme constantes de la classe `KernelEvents`
- [ ] **B.** Dans l'interface `KernelEventsInterface`
- [ ] **C.** Sous la clé `framework.events` de la configuration
- [ ] **D.** Dans l'enum `KernelEvent`

### Question 37

Quelles associations « événement → objet passé au listener » sont correctes ? *(plusieurs bonnes réponses)*

- [ ] **A.** `kernel.request` → `RequestEvent`
- [ ] **B.** `kernel.controller_arguments` → `ControllerArgumentsEvent`
- [ ] **C.** `kernel.finish_request` → `FinishRequestEvent`
- [ ] **D.** `kernel.exception` → `ErrorEvent`

### Question 38

Lequel de ces événements du kernel n'existe pas ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.finish_request`
- [ ] **B.** `kernel.view`
- [ ] **C.** `kernel.send_response`
- [ ] **D.** `kernel.terminate`

### Question 39

Pour quels événements la propagation est-elle stoppée dès qu'un listener définit une `Response` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `kernel.request`
- [ ] **B.** `kernel.view`
- [ ] **C.** `kernel.exception`
- [ ] **D.** `kernel.finish_request`

### Question 40

En Symfony 8.0, comment un listener peut-il réagir uniquement quand le contrôleur porte l'attribut `#[Cache]` ? *(une seule bonne réponse)*

- [ ] **A.** En s'abonnant à l'événement `kernel.controller_arguments.Symfony\Component\HttpKernel\Attribute\Cache`
- [ ] **B.** En recevant un `ControllerAttributeEvent` dédié à cet attribut
- [ ] **C.** En écoutant un événement kernel générique et en inspectant lui-même les attributs du contrôleur (ex. via `ControllerEvent::getAttributes()`)
- [ ] **D.** C'est impossible, même en inspectant manuellement

## Les sous-requêtes

### Question 41

Comment exécute-t-on une sous-requête ? *(une seule bonne réponse)*

- [ ] **A.** `$kernel->subRequest($request)`
- [ ] **B.** `$kernel->handle($request, HttpKernelInterface::SUB_REQUEST)`
- [ ] **C.** `$kernel->forward($request)`
- [ ] **D.** `$kernel->handle($request, Request::SUB)`

### Question 42

Quelles affirmations sur les sous-requêtes sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elles servent typiquement à rendre une petite portion de page plutôt qu'une page complète
- [ ] **B.** Elles déclenchent un cycle requête/réponse complet
- [ ] **C.** Certains listeners (ex. la sécurité) peuvent n'agir que sur la requête principale
- [ ] **D.** Un listener distingue requête principale et sous-requête via `KernelEvent::isMainRequest()`

### Question 43

Quel est le `_format` par défaut d'une sous-requête ? *(une seule bonne réponse)*

- [ ] **A.** `json`
- [ ] **B.** Celui de la requête principale
- [ ] **C.** Celui négocié via le header `Accept`
- [ ] **D.** `html` — à définir explicitement (`$request->attributes->set('_format', 'json')`) si la sous-requête retourne un autre format

## La localisation de ressources

### Question 44

Que fait `$kernel->locateResource('@FooBundle/Resources/config/services.xml')` ? *(une seule bonne réponse)*

- [ ] **A.** Elle copie la ressource dans `var/cache/`
- [ ] **B.** Elle transforme ce chemin logique en chemin physique vers le fichier du bundle
- [ ] **C.** Elle retourne l'URL publique de la ressource
- [ ] **D.** Rien : cette méthode n'existe plus en Symfony 8

## La configuration du Kernel

### Question 45

Où la classe kernel d'une application est-elle définie par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `config/Kernel.php`
- [ ] **B.** `bin/kernel.php`
- [ ] **C.** `src/Kernel.php`
- [ ] **D.** `public/index.php`

### Question 46

Quelles affirmations sur `kernel.project_dir` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sa valeur par défaut est le dossier où se trouve le `composer.json` principal
- [ ] **B.** On peut la changer en surchargeant `getProjectDir()` (utile si le `composer.json` a été déplacé ou supprimé en production)
- [ ] **C.** Elle est aussi exposée via l'env var `APP_PROJECT_DIR`, en lecture seule
- [ ] **D.** On peut la changer en définissant l'env var `APP_PROJECT_DIR`

### Question 47

Quelle est la valeur par défaut de `kernel.cache_dir` ? *(une seule bonne réponse)*

- [ ] **A.** `<projet>/var/cache/<environnement>`
- [ ] **B.** `<projet>/var/cache`
- [ ] **C.** `/tmp/symfony/cache`
- [ ] **D.** `<projet>/cache`

### Question 48

Quelle est la valeur par défaut de `kernel.logs_dir` ? *(une seule bonne réponse)*

- [ ] **A.** `<projet>/var/log/<environnement>`
- [ ] **B.** `<projet>/logs`
- [ ] **C.** `<projet>/var/log`
- [ ] **D.** `/var/log/symfony`

### Question 49

Quelles affirmations sur `kernel.build_dir` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sa valeur par défaut est celle du cache dir
- [ ] **B.** Il permet de séparer le cache en lecture seule (le container compilé) du cache en lecture/écriture (les cache pools)
- [ ] **C.** Un chemin différent est utile quand l'application est déployée sur un filesystem en lecture seule (conteneur Docker, AWS Lambda)
- [ ] **D.** Il faut vider ce dossier à chaque requête en production

### Question 50

Quelle est la valeur par défaut de `kernel.charset` ? *(une seule bonne réponse)*

- [ ] **A.** `ISO-8859-1`
- [ ] **B.** `UTF-8`
- [ ] **C.** Le charset de la locale système
- [ ] **D.** `ASCII`

### Question 51

Quels paramètres de container Symfony expose-t-il autour de la reproductibilité des builds ? *(plusieurs bonnes réponses)*

- [ ] **A.** `container.build_hash` — un hash du contenu de tous les fichiers sources
- [ ] **B.** `container.build_time` — un timestamp du moment de la compilation (résultat de `time()`)
- [ ] **C.** `container.build_id` — la fusion des deux précédents, encodée en CRC32
- [ ] **D.** En 8.0, l'env var standardisée `SOURCE_DATE_EPOCH` permet aussi de fixer le build time

### Question 52

Comment rendre le build du container strictement reproductible ? *(une seule bonne réponse)*

- [ ] **A.** Compiler le container avec `--reproducible`
- [ ] **B.** Supprimer le paramètre `container.build_time`
- [ ] **C.** Définir le paramètre `kernel.container_build_time` avec une valeur fixe
- [ ] **D.** Passer `kernel.debug` à `false`

### Question 53

L'application a son kernel dans le namespace `App`, tourne en environnement `dev` avec le mode debug activé. Quelle est la valeur de `kernel.container_class` ? *(une seule bonne réponse)*

- [ ] **A.** `AppKernelContainer`
- [ ] **B.** `DevDebugContainer`
- [ ] **C.** `App_KernelDevDebugContainer`
- [ ] **D.** `ContainerAppDevDebug`

### Question 54

Quelle est la différence entre `kernel.environment` et `kernel.runtime_environment` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune : le second est un alias du premier
- [ ] **B.** `kernel.environment` définit les options de configuration utilisées ; `kernel.runtime_environment` définit le lieu où l'application est déployée (ex. `staging`, `production`)
- [ ] **C.** C'est l'inverse : `kernel.runtime_environment` définit la configuration chargée
- [ ] **D.** `kernel.runtime_environment` n'existe pas

### Question 55

Quelles affirmations sur `kernel.runtime_mode` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sa valeur est une query string, par exemple `web=1&worker=0`
- [ ] **B.** Elle peut être définie via l'env var `APP_RUNTIME_MODE`
- [ ] **C.** Elle est déclinée en paramètres booléens `kernel.runtime_mode.web`, `kernel.runtime_mode.cli` et `kernel.runtime_mode.worker`
- [ ] **D.** `kernel.runtime_mode.worker` vaut `true` dès que l'application tourne sous PHP-FPM

### Question 56

Quelle particularité le paramètre `kernel.bundles_metadata` a-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est exposé par aucune méthode du kernel : on ne peut l'obtenir que via le paramètre de container
- [ ] **B.** Il est exposé via `Kernel::getBundlesMetadata()`
- [ ] **C.** Il contient les numéros de version des bundles
- [ ] **D.** Il n'existe plus en Symfony 8

### Question 57

Que contient le paramètre `kernel.bundles` ? *(une seule bonne réponse)*

- [ ] **A.** La liste des chemins d'installation des bundles
- [ ] **B.** Un tableau associatif « nom du bundle → FQCN de sa classe principale », aussi exposé via `Kernel::getBundles()`
- [ ] **C.** La liste des FQCN uniquement, sans clés
- [ ] **D.** Un tableau « nom du bundle → namespace »

### Question 58

Quelle est la valeur par défaut de `kernel.secret` ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne aléatoire régénérée à chaque compilation
- [ ] **B.** Une chaîne vide
- [ ] **C.** `%env(APP_SECRET)%`
- [ ] **D.** Le hash du dossier projet

### Question 59

Quels paramètres `kernel.*` sont des miroirs d'options `framework.*` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `kernel.default_locale`
- [ ] **B.** `kernel.http_method_override`
- [ ] **C.** `kernel.trusted_proxies`
- [ ] **D.** `kernel.project_dir`

### Question 60

Quelles affirmations sur `kernel.environment` et `kernel.debug` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Leurs valeurs sont passées en argument au moment du boot du kernel
- [ ] **B.** `kernel.debug` stocke le mode debug courant de l'application
- [ ] **C.** `kernel.environment` stocke le nom de l'environnement de configuration courant
- [ ] **D.** Les deux valeurs sont déduites automatiquement du nom de domaine de la requête

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page du composant HttpKernel](https://symfony.com/doc/8.0/components/http_kernel.html) et de la [référence de configuration du Kernel](https://symfony.com/doc/8.0/reference/configuration/kernel.html) de la documentation Symfony 8.0.

**Question 1 : A** — « The HttpKernel component provides a structured process for converting a `Request` into a `Response` by making use of the EventDispatcher component. » Assez flexible pour créer un framework full-stack (Symfony) ou un CMS avancé (Drupal). Le routage (B) est le composant Routing, l'abstraction HTTP (C) est HttpFoundation. *(§ Introduction)*

**Question 2 : C** — `handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response`. B inverse l'ordre des deux derniers arguments. *(§ The Request-Response Lifecycle)*

**Question 3 : A, B, C** — « The `HttpKernel::handle()` method works internally by dispatching events. This makes the method both flexible, but also a bit abstract, since all the "work" of a framework/application built with HttpKernel is actually done in event listeners. » *(§ HttpKernel: Driven by Events)*

**Question 4 : A, B, C, D** — Les quatre sont vrais : `new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver)`. *(§ HttpKernel: Driven by Events)*

**Question 5 : B** — `$response->send()` « sends the headers and prints the `Response` content ». On appelle ensuite `$kernel->terminate($request, $response)`. *(§ The kernel.response Event)*

**Question 6 : A, B, C** — « The purpose of the `kernel.request` event is either to create and return a `Response` directly, or to add information to the `Request`. » Exemple sécurité : retourner une `RedirectResponse` vers le login ou une réponse 403. Transformer la valeur de retour du contrôleur (D), c'est `kernel.view`. *(§ The kernel.request Event)*

**Question 7 : B** — « If a `Response` is returned at this stage, the process skips directly to the `kernel.response` event. » Et la propagation est stoppée : les listeners de priorité inférieure ne sont pas exécutés. *(§ The kernel.request Event)*

**Question 8 : D** — « The most important listener to `kernel.request` in the Symfony Framework is the `RouterListener`. » *(§ The kernel.request Event)*

**Question 9 : A, B, C** — « This class executes the routing layer, which returns an *array* of information about the matched request, including the `_controller` and any placeholders that are in the route's pattern (e.g. `{slug}`). This array of information is stored in the `Request` object's `attributes` array. » L'instanciation du contrôleur (D) vient plus tard, dans le controller resolver. *(§ The kernel.request Event)*

**Question 10 : D** — « The only requirement is that it is a PHP callable - i.e. a function, method on an object or a `Closure`. » *(§ Resolve the Controller)*

**Question 11 : A** — `public function getController(Request $request): callable|false;`. *(§ Resolve the Controller)*

**Question 12 : A, B, C** — « The `ControllerResolver` looks for a `_controller` key on the `Request` object's attributes property (recall that this information is typically placed on the `Request` via the `RouterListener`) », puis « a new instance of your controller class is instantiated with no constructor arguments ». Les arguments (D) sont le job de l'`ArgumentResolver`. *(§ Resolve the Controller)*

**Question 13 : A, B, C** — Initialiser après détermination du contrôleur, récupérer ses attributs via `getAttributes()`, ou « change the controller callable completely by calling `ControllerEvent::setController` ». Les arguments (D) ne sont pas encore résolus à ce stade — ils le sont à l'étape suivante. *(§ The kernel.controller Event)*

**Question 14 : B** — « This class fetches `#[Cache]` attribute configuration from the controller and uses it to configure HTTP caching on the response. » À savoir pour éviter les pièges : le stockage des attributs dans `_controller_attributes` et la méthode `ControllerEvent::evaluate()` n'existent qu'à partir de **Symfony 8.1**. *(§ The kernel.controller Event)*

**Question 15 : D** — « Next, `HttpKernel::handle()` calls `ArgumentResolverInterface::getArguments()` », qui « return[s] the array of arguments that should be passed to that controller ». *(§ Getting the Controller Arguments)*

**Question 16 : A, B, C** — Les trois règles documentées : correspondance par nom avec l'attributes bag (valeur typiquement issue du `RouterListener`), type-hint `Request`, argument variadic. La query string (D) n'est pas utilisée. *(§ Getting the Controller Arguments)*

**Question 17 : A** — « By implementing the `ValueResolverInterface` yourself and passing this to the `ArgumentResolver`, you can extend this functionality. » La doc précise que quatre implémentations fournissent le comportement par défaut de Symfony. *(§ Getting the Controller Arguments)*

**Question 18 : C** — « A controller must return *something*. If a controller returns `null`, an exception will be thrown immediately. » *(§ Calling the Controller)*

**Question 19 : D** — « If the controller returns anything besides a `Response`, then the kernel has a little bit more work to do - `kernel.view` (since the end goal is *always* to generate a `Response` object). » *(§ Calling the Controller)*

**Question 20 : A, B, C** — « The job of a listener to this event is to use the return value of the controller […] to create a `Response` » ; « if no listener sets a response on the event, then an exception is thrown » ; « when setting a response for the `kernel.view` event, the propagation is stopped ». D est faux : si le contrôleur retourne une `Response`, on passe directement à `kernel.response`. *(§ The kernel.view Event)*

**Question 21 : A** — « If your controller action returns an array, and you apply the `#[Template]` attribute to that controller action, then this listener renders a template, passes the array […] and creates a `Response`. » Le FOSRestBundle ajoute aussi un listener sur cet événement. *(§ The kernel.view Event)*

**Question 22 : A, B, C, D** — « The `Response` might be created during the `kernel.request` event, returned from the controller, or returned by one of the listeners to the `kernel.view` event. » Et en cas d'erreur, un listener de `kernel.exception` crée la `Response` d'erreur. Dans tous les cas, `kernel.response` est dispatché ensuite. *(§ The kernel.response Event / § Handling Exceptions)*

**Question 23 : A, B** — « The `WebDebugToolbarListener` injects some JavaScript at the bottom of your page in the `dev` environment » ; « Another listener, `ContextListener` serializes the current user's information into the session so that it can be reloaded on the next request. » Le `RouterListener` écoute `kernel.request`, l'`ErrorListener` écoute `kernel.exception`. *(§ The kernel.response Event)*

**Question 24 : A, B, C** — « The final event of the HttpKernel process is `kernel.terminate` and is unique because it occurs *after* the `HttpKernel::handle()` method, and after the response is sent to the user », via l'appel `$kernel->terminate($request, $response)` — pour des actions retardées comme l'envoi d'emails. D est donc faux : il est dispatché *hors* de `handle()`. *(§ The kernel.terminate Event)*

**Question 25 : C** — « Only the PHP FPM API and the FrankenPHP server are able to send a response to the client while the server's PHP process still performs some tasks. » Avec les autres SAPI, les listeners s'exécutent mais la réponse n'est envoyée qu'à la fin. *(§ The kernel.terminate Event)*

**Question 26 : A, B, C** — Warning de la doc : avec early flush, « modifications to the `Response` made from a terminate listener are discarded », mais « in debug mode, the response is *not* finalized before `kernel.terminate` is dispatched » — d'où des incohérences possibles entre dev et prod (corps corrompus, status différents). Les headers se posent dans `kernel.response` (D faux). *(§ The kernel.terminate Event)*

**Question 27 : A** — « Using the `kernel.terminate` event is optional, and should only be called if your kernel implements `TerminableInterface`. » *(§ The kernel.terminate Event)*

**Question 28 : C** — `kernel.request` « is the first event that is dispatched inside `HttpKernel::handle` » et `kernel.terminate` est « the final event of the HttpKernel process ». `kernel.boot` n'existe pas. *(§ The kernel.request Event / § The kernel.terminate Event)*

**Question 29 : A, B, C** — « Internally, the body of the `handle()` method is wrapped in a try-catch block. When any exception is thrown, the `kernel.exception` event is dispatched », et l'exception s'obtient via `ExceptionEvent::getThrowable()`. D est faux : « when setting a response for the `kernel.exception` event, the propagation is stopped ». *(§ Handling Exceptions: the kernel.exception Event)*

**Question 30 : D** — « The `ExceptionEvent` exposes the `isKernelTerminating()` method, which you can use to determine if the kernel is currently terminating at the moment the exception was thrown. » *(§ Handling Exceptions: the kernel.exception Event)*

**Question 31 : A, B, C, D** — Les quatre étapes documentées de l'`ErrorListener` : conversion en `FlattenException` ; `HttpExceptionInterface` → status et headers ; `RequestExceptionInterface` → status 400, « no other headers are modified » ; exécution d'un contrôleur d'erreur « passed as a constructor argument to this listener ». *(§ Handling Exceptions: the kernel.exception Event)*

**Question 32 : B** — « To generate a 404 page, you might throw a special type of exception and then add a listener on this event that looks for this exception and creates and returns a 404 `Response`. » L'`ErrorListener` fourni par le composant fait cela (et plus) par défaut. *(§ Handling Exceptions: the kernel.exception Event)*

**Question 33 : A** — « If you want to set custom HTTP headers, you can always use the `setHeaders()` method on exceptions derived from the `HttpException` class. » *(§ Handling Exceptions: the kernel.exception Event)*

**Question 34 : C** — « The other important listener is the `ExceptionListener` [du composant Security]. The goal of this listener is to handle security exceptions and, when appropriate, *help* the user to authenticate (e.g. redirect to the login page). » *(§ Handling Exceptions: the kernel.exception Event)*

**Question 35 : A, B, C** — « Make your service implement `ResetInterface` and clean up any accumulated state in the `reset()` method. The kernel calls this method automatically after each request/response cycle in long-running processes. » Piège : l'alternative `FRANKENPHP_RESET_KERNEL` n'est documentée qu'à partir de **Symfony 8.1**. *(§ Resetting the State After the Request/Response Cycle)*

**Question 36 : A** — « The name of each of the "kernel" events is defined as a constant on the `KernelEvents` class » (ex. `KernelEvents::REQUEST`). *(§ Creating an Event Listener)*

**Question 37 : A, B, C** — Conformes à la table des événements. D est le piège : `kernel.exception` reçoit un `ExceptionEvent`, pas un `ErrorEvent`. *(§ Creating an Event Listener)*

**Question 38 : C** — Les huit événements sont : `request`, `controller`, `controller_arguments`, `view`, `response`, `finish_request`, `terminate` et `exception`. `kernel.send_response` n'existe pas. *(§ Creating an Event Listener)*

**Question 39 : A, B, C** — Les trois notes identiques de la doc : « When setting a response for the `kernel.request` / `kernel.view` / `kernel.exception` event, the propagation is stopped. » Rien de tel n'est documenté pour `kernel.finish_request`. *(§ The kernel.request Event / § The kernel.view Event / § Handling Exceptions)*

**Question 40 : C** — En 8.0, il faut écouter un événement générique et inspecter soi-même les attributs (c'est ce que fait le `CacheAttributeListener`). Le mécanisme des « controller attribute events » — événements nommés `{kernelEvent}.{AttributeClassName}` avec un `ControllerAttributeEvent` (A et B) — n'a été introduit qu'en **Symfony 8.1**. *(§ The kernel.controller Event)*

**Question 41 : B** — « To execute a sub request, use `HttpKernel::handle()`, but change the second argument » : `HttpKernelInterface::SUB_REQUEST`. *(§ Sub Requests)*

**Question 42 : A, B, C, D** — Les quatre sont vraies : une sous-requête « typically serves to render just one small portion of a page », « creates another full request-response cycle », « some listeners (e.g. security) may only act upon the main request », et `isMainRequest()` permet la distinction. *(§ Sub Requests)*

**Question 43 : D** — « The default value of the `_format` request attribute is `html`. If your sub request returns a different format (e.g. `json`) you can set it by defining the `_format` attribute explicitly on the request. » *(§ Sub Requests)*

**Question 44 : B** — La méthode « transforms logical paths into physical paths », permettant de référencer les ressources d'un bundle sans connaître son emplacement sur le disque. *(§ Locating Resources)*

**Question 45 : C** — « Symfony applications define a kernel class (which is located by default at `src/Kernel.php`). » *(§ Configuring in the Kernel)*

**Question 46 : A, B, C** — « Its value is calculated automatically as the directory where the main `composer.json` file is stored » ; on surcharge `getProjectDir()` si besoin (sans slash final) ; et « this project directory is also available through the `APP_PROJECT_DIR` environment variable. This variable is read-only, so you cannot override it to change the project directory » — d'où D faux. *(§ kernel.project_dir)*

**Question 47 : A** — « **default**: `$this->getProjectDir()/var/cache/$this->environment` » — le dossier dépend de l'environnement courant. *(§ kernel.cache_dir)*

**Question 48 : C** — « **default**: `$this->getProjectDir()/var/log` » — contrairement au cache, pas de sous-dossier par environnement. *(§ kernel.logs_dir)*

**Question 49 : A, B, C** — Défaut : `$this->getCacheDir()` ; « this directory can be used to separate read-only cache (i.e. the compiled container) from read-write cache (i.e. cache pools). Specify a non-default value when the application is deployed in a read-only filesystem like a Docker container or AWS Lambda. » Modifiable aussi via l'env var `APP_BUILD_DIR` ou en surchargeant `getBuildDir()`. *(§ kernel.build_dir)*

**Question 50 : B** — « **default**: `UTF-8` ». La valeur est exposée via `getCharset()`, surchargeable pour retourner par exemple `ISO-8859-1`. *(§ kernel.charset)*

**Question 51 : A, B, C** — Les trois paramètres documentés : `container.build_hash` (hash des sources), `container.build_time` (résultat de `time()`), `container.build_id` (fusion des deux, encodée CRC32). Piège pour D : le support de `SOURCE_DATE_EPOCH` n'a été introduit qu'en **Symfony 8.1**. *(§ kernel.container_build_time)*

**Question 52 : C** — « The solution is to use another container parameter called `kernel.container_build_time` and set it to a non-changing build time to achieve a strict reproducible build » (ex. `'1234567890'`). *(§ kernel.container_build_time)*

**Question 53 : C** — « If your application kernel is defined in the `App` namespace, runs in the `dev` environment and the `debug` mode is enabled, the value of this parameter is `App_KernelDevDebugContainer`. » Surtout important avec plusieurs kernels ; surchargeable via `getContainerClass()`. *(§ kernel.container_class)*

**Question 54 : B** — « This value [environment] defines the configuration options used to run the application, whereas the `kernel.runtime_environment` option defines the place where the application is deployed » — ce qui permet de tourner avec la config `prod` en `staging` comme en `production`. *(§ kernel.environment / § kernel.runtime_environment)*

**Question 55 : A, B, C** — « The query string looks like `web=1&worker=0` when the application is running in web mode », définissable via `APP_RUNTIME_MODE`, avec les booléens dérivés `.web`, `.cli` (l'opposé de `.web`) et `.worker`. D est faux : le mode worker requiert un serveur long-running comme FrankenPHP — pas PHP-FPM. *(§ kernel.runtime_mode)*

**Question 56 : A** — « This value is not exposed via any method of the kernel class, so you can only obtain it via the container parameter » — contrairement à `kernel.bundles`, exposé via `getBundles()`. *(§ kernel.bundles_metadata)*

**Question 57 : B** — Le paramètre stocke « the list of bundles registered in the application and the FQCN of their main bundle class », ex. `'FrameworkBundle' => 'Symfony\Bundle\FrameworkBundle\FrameworkBundle'`. *(§ kernel.bundles)*

**Question 58 : C** — « **default**: `%env(APP_SECRET)%` » — la valeur du paramètre `framework.secret`, alimentée par l'env var `APP_SECRET`. *(§ kernel.secret)*

**Question 59 : A, B, C** — `kernel.default_locale`, `kernel.http_method_override` et `kernel.trusted_proxies` (comme `kernel.enabled_locales`, `kernel.error_controller`, `kernel.trusted_headers`, `kernel.trusted_hosts`…) stockent la valeur du paramètre `framework.*` correspondant. `kernel.project_dir` (D) est calculé par le kernel lui-même. *(§ kernel.default_locale et suivants)*

**Question 60 : A, B, C** — Pour les deux paramètres, la doc indique : « the value is passed as an argument when booting the kernel ». `kernel.debug` stocke le mode debug courant, `kernel.environment` le nom de l'environnement de configuration. Rien n'est déduit du nom de domaine (D). *(§ kernel.debug / § kernel.environment)*
