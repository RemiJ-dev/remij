# QCM — Symfony Contracts et les PSR (PHP-FIG)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/components/contracts.html](https://symfony.com/doc/8.0/components/contracts.html) (questions 1 à 6) et les **PSR acceptés** du [PHP-FIG](https://www.php-fig.org/psr/#accepted) (questions 7 à 45) · **Généré le :** 19 juillet 2026
>
> **45 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Le composant Contracts

### Question 1

Que fournit le composant Symfony Contracts ? *(une seule bonne réponse)*

- [ ] **A.** Des implémentations complètes prêtes à l'emploi des services Symfony
- [ ] **B.** Un ensemble d'**abstractions** extraites des composants Symfony, fondées sur des sémantiques éprouvées par des implémentations « battle-tested »
- [ ] **C.** Un pont de compatibilité entre Symfony et les autres frameworks PHP
- [ ] **D.** La définition officielle des PSR du PHP-FIG

### Question 2

Sous quels paquets les Contracts sont-ils distribués ? *(plusieurs bonnes réponses)*

- [ ] **A.** `symfony/cache-contracts` et `symfony/deprecation-contracts`
- [ ] **B.** `symfony/event-dispatcher-contracts` et `symfony/http-client-contracts`
- [ ] **C.** `symfony/service-contracts` et `symfony/translation-contracts`
- [ ] **D.** `symfony/routing-contracts`

### Question 3

Quelles affirmations sur l'usage des Contracts sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Leurs abstractions servent à obtenir du **couplage faible** et de l'**interopérabilité**
- [ ] **B.** En les utilisant comme type-hints, on peut réutiliser toute implémentation qui respecte leur contrat — un composant Symfony ou un autre paquet de la communauté
- [ ] **C.** Selon leur sémantique, certaines interfaces se combinent avec l'**autowiring** pour injecter un service
- [ ] **D.** Ils imposent d'utiliser l'implémentation fournie par Symfony

### Question 4

Quels sont les principes de design des Contracts ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ils sont découpés par domaine, chacun dans son propre sous-namespace
- [ ] **B.** Ce sont de petits ensembles cohérents d'interfaces, de traits, de docblocks normatifs et de suites de tests de référence le cas échéant
- [ ] **C.** Un contrat doit avoir une **implémentation éprouvée** pour entrer dans le dépôt
- [ ] **D.** Un contrat peut casser la compatibilité avec les composants Symfony existants

### Question 5

Comment un paquet déclare-t-il qu'il implémente un contrat ? *(une seule bonne réponse)*

- [ ] **A.** En le listant dans la section `require` de son `composer.json`
- [ ] **B.** Avec une clé `implements` dans la section `extra`
- [ ] **C.** En le listant dans la section `provide` de son `composer.json`, avec la convention `symfony/*-implementation` (ex. `"symfony/cache-implementation": "3.0"`)
- [ ] **D.** Aucune déclaration : Composer le détecte automatiquement

### Question 6

Quel est le rapport entre Symfony Contracts et les PSR du PHP-FIG, selon la FAQ de la page ? *(une seule bonne réponse)*

- [ ] **A.** Quand c'est applicable, les contracts sont **construits au-dessus des PSR** — mais PHP-FIG a d'autres buts et d'autres processus ; les Contracts se concentrent sur des abstractions utiles en soi, tout en restant compatibles avec les implémentations Symfony
- [ ] **B.** Les Contracts remplacent les PSR, jugés obsolètes
- [ ] **C.** Aucun lien : les deux initiatives s'ignorent
- [ ] **D.** Les PSR sont générés automatiquement à partir des Contracts

## PHP-FIG et les PSR

### Question 7

Que signifie « PSR » et qui publie ces documents ? *(une seule bonne réponse)*

- [ ] **A.** PHP Symfony Recommendation, publiées par SensioLabs
- [ ] **B.** PHP Standard Requirements, publiées par le PHP Group
- [ ] **C.** Portable Standard Rules, publiées par Composer
- [ ] **D.** **PHP Standards Recommendation**, publiées par le **PHP-FIG** (Framework Interoperability Group)

### Question 8

Quels PSR sont au statut **accepted** ? *(plusieurs bonnes réponses)*

- [ ] **A.** PSR-1, PSR-4 et PSR-12 (standards de code et d'autoloading)
- [ ] **B.** PSR-3 (Logger), PSR-11 (Container) et PSR-14 (Event Dispatcher)
- [ ] **C.** PSR-6 et PSR-16 (caches), PSR-7/15/17/18 (HTTP), PSR-13 (liens) et PSR-20 (Clock)
- [ ] **D.** PSR-5 et PSR-19 (PHPDoc)

### Question 9

Quel est le statut de PSR-0 et PSR-2 ? *(une seule bonne réponse)*

- [ ] **A.** Acceptés : ils restent des standards de référence
- [ ] **B.** **Dépréciés** — remplacés en pratique par PSR-4 (autoloading) et PSR-12 (style de code)
- [ ] **C.** Draft : en cours de rédaction
- [ ] **D.** Abandonnés, comme PSR-8

### Question 10

Comment interpréter les mots-clés MUST, SHOULD, MAY… dans les PSR ? *(une seule bonne réponse)*

- [ ] **A.** Selon la RFC 7231
- [ ] **B.** Chaque PSR les redéfinit librement
- [ ] **C.** Selon la **RFC 2119**
- [ ] **D.** Ce sont de simples emphases sans valeur normative

### Question 11

Quels paquets Packagist fournissent les interfaces des PSR ? *(plusieurs bonnes réponses)*

- [ ] **A.** `psr/log` (PSR-3) et `psr/container` (PSR-11)
- [ ] **B.** `psr/cache` (PSR-6) et `psr/simple-cache` (PSR-16)
- [ ] **C.** `psr/http-message` (PSR-7) et `psr/clock` (PSR-20)
- [ ] **D.** `psr/coding-standard` (PSR-12)

## PSR-1 — Basic Coding Standard

### Question 12

Quelles règles PSR-1 impose-t-il aux fichiers PHP ? *(plusieurs bonnes réponses)*

- [ ] **A.** Seuls les tags `<?php` et `<?=` sont autorisés
- [ ] **B.** L'encodage doit être UTF-8 **sans BOM**
- [ ] **C.** Un fichier devrait soit déclarer des symboles (classes, fonctions, constantes…), soit exécuter de la logique à effets de bord — mais pas les deux
- [ ] **D.** Une déclaration conditionnelle (`if (!function_exists('bar'))`) est considérée comme un effet de bord

### Question 13

Quelles conventions de nommage PSR-1 impose-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les noms de classes en `StudlyCaps`
- [ ] **B.** Les constantes de classe en majuscules avec underscores (`DATE_APPROVED`)
- [ ] **C.** Les noms de méthodes en `camelCase`
- [ ] **D.** Les noms de propriétés obligatoirement en `$camelCase`

## PSR-12 — Extended Coding Style

### Question 14

Quelle est la relation de PSR-12 avec PSR-1 et PSR-2 ? *(une seule bonne réponse)*

- [ ] **A.** PSR-12 « extends, expands and replaces » PSR-2, et exige la conformité à PSR-1
- [ ] **B.** PSR-12 est un sous-ensemble allégé de PSR-2
- [ ] **C.** PSR-12 est indépendant des deux
- [ ] **D.** PSR-2 reste le standard de style accepté le plus récent

### Question 15

Quelles règles PSR-12 impose-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une indentation de **4 espaces** par niveau, jamais de tabulations
- [ ] **B.** Pas de limite dure de longueur de ligne ; limite souple à **120** caractères ; les lignes ne devraient pas dépasser 80
- [ ] **C.** La visibilité doit être déclarée sur toutes les propriétés et toutes les méthodes
- [ ] **D.** L'indentation par tabulations est tolérée si elle est cohérente dans le projet

### Question 16

Quelle est la forme exacte imposée pour la directive strict types ? *(une seule bonne réponse)*

- [ ] **A.** `declare( strict_types = 1 );` — les espaces sont libres
- [ ] **B.** `declare(strict_types = 1)` — un espace autour du `=` est recommandé
- [ ] **C.** La directive doit être placée en dernière ligne du fichier
- [ ] **D.** Exactement `declare(strict_types=1)` — « Declare statements MUST contain no spaces »

## PSR-4 — Autoloader

### Question 17

Quelles affirmations sur la spécification PSR-4 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le FQCN doit avoir un namespace de premier niveau, le « vendor namespace »
- [ ] **B.** Le « namespace prefix » correspond à au moins un « base directory » ; les sous-namespaces suivants correspondent à des sous-répertoires (le séparateur de namespace = séparateur de répertoire)
- [ ] **C.** Le nom de classe terminal correspond à un fichier `.php` **de même casse**
- [ ] **D.** Les underscores dans le nom de classe sont convertis en séparateurs de répertoires

### Question 18

Que doit faire un autoloader PSR-4 quand il ne trouve pas la classe demandée ? *(une seule bonne réponse)*

- [ ] **A.** Lever une `ClassNotFoundException`
- [ ] **B.** Rien : il ne doit **ni lever d'exception, ni émettre d'erreur** d'aucun niveau, et ne devrait pas retourner de valeur
- [ ] **C.** Retourner obligatoirement `false`
- [ ] **D.** Déclencher un `E_USER_WARNING`

## PSR-3 — Logger Interface

### Question 19

Quelles affirmations sur les niveaux de log de `LoggerInterface` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Huit méthodes correspondent aux huit niveaux de la RFC 5424 : `debug`, `info`, `notice`, `warning`, `error`, `critical`, `alert`, `emergency`
- [ ] **B.** Une neuvième méthode, `log()`, accepte le niveau en premier argument, avec le même résultat que la méthode dédiée
- [ ] **C.** Appeler `log()` avec un niveau inconnu de l'implémentation doit lever une `Psr\Log\InvalidArgumentException`
- [ ] **D.** La spécification définit aussi les niveaux `trace` et `fatal`

### Question 20

Quelles affirmations sur le message et le contexte sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le message peut contenir des placeholders délimités par accolades (`{username}`), dont le nom correspond à une clé du tableau de contexte
- [ ] **B.** Une exception passée dans le contexte **doit** être sous la clé `'exception'`
- [ ] **C.** Le message est une chaîne, ou un objet avec une méthode `__toString()`
- [ ] **D.** Une valeur de contexte invalide peut légitimement lever une exception

### Question 21

Quelles classes utilitaires le paquet `psr/log` fournit-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** `AbstractLogger` et `LoggerTrait` : il ne reste qu'à implémenter la méthode générique `log()`, les huit autres y délèguent
- [ ] **B.** `NullLogger` : une implémentation « trou noir » utilisable en repli quand aucun logger n'est fourni
- [ ] **C.** `LoggerAwareInterface`, qui ne contient que `setLogger()` (avec `LoggerAwareTrait` pour l'implémenter)
- [ ] **D.** `LogLevel`, qui définit dix niveaux de log

## PSR-6 et PSR-16 — Caching

### Question 22

Quelles affirmations sur PSR-6 (Caching Interface) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Deux interfaces centrales : `CacheItemPoolInterface` (le pool) et `CacheItemInterface` (l'item)
- [ ] **B.** `getItem($key)` retourne toujours un objet item ; c'est `isHit()` qui indique si la valeur existe en cache
- [ ] **C.** `saveDeferred()` diffère la persistance d'un item, finalisée par `commit()`
- [ ] **D.** Le pool expose directement `get($key, $default)`

### Question 23

Quelles méthodes de `CacheItemInterface` contrôlent l'expiration ? *(une seule bonne réponse)*

- [ ] **A.** `expiresAt()` — un moment absolu (`\DateTimeInterface`) — et `expiresAfter()` — une durée relative (secondes ou `\DateInterval`)
- [ ] **B.** `setTtl()` et `setExpiration()`
- [ ] **C.** Un seul paramètre `$ttl` sur `save()`
- [ ] **D.** L'expiration n'est pas couverte par PSR-6

### Question 24

Quelles affirmations sur PSR-16 (Simple Cache) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `CacheInterface` expose `get`/`set`/`delete`/`clear`/`has`, plus `getMultiple`/`setMultiple`/`deleteMultiple`
- [ ] **B.** `get($key, $default = null)` retourne `$default` en cas de cache miss
- [ ] **C.** Un miss retourne `null` : il est donc impossible de distinguer un `null` stocké d'un miss — la déviation principale par rapport à PSR-6
- [ ] **D.** Comme PSR-6, PSR-16 fait transiter les valeurs par un objet « item »

### Question 25

Quels caractères sont **réservés** (interdits) dans les clés de cache PSR-6 et PSR-16 ? *(une seule bonne réponse)*

- [ ] **A.** `<>[]#`
- [ ] **B.** `$%&!`
- [ ] **C.** `{}()/\@:`
- [ ] **D.** Aucun : tout caractère UTF-8 est permis

### Question 26

Quelle est la relation entre PSR-16 et PSR-6 ? *(une seule bonne réponse)*

- [ ] **A.** PSR-16 étend les interfaces de PSR-6
- [ ] **B.** PSR-6 est déprécié au profit de PSR-16
- [ ] **C.** PSR-16 exige une implémentation PSR-6 sous-jacente
- [ ] **D.** PSR-16 est une interface simplifiée, **indépendante** de PSR-6 mais conçue pour une compatibilité directe — une instance de `CacheInterface` équivaut à un « Pool » PSR-6

## PSR-7 et PSR-17 — Messages HTTP

### Question 27

Quelles interfaces PSR-7 définit-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** `MessageInterface`, `RequestInterface` et `ResponseInterface`
- [ ] **B.** `ServerRequestInterface` et `UploadedFileInterface`
- [ ] **C.** `StreamInterface` et `UriInterface`
- [ ] **D.** `MiddlewareInterface`

### Question 28

Quelles affirmations sur l'immutabilité en PSR-7 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les messages sont immuables : les méthodes `with*()` conservent l'état interne et retournent une **nouvelle instance** portant le changement
- [ ] **B.** Exception notable : `StreamInterface` ne modélise **pas** l'immutabilité — impossible à garantir sur une ressource de flux
- [ ] **C.** Les noms de headers sont manipulés de façon insensible à la casse
- [ ] **D.** `setHeader()` permet de modifier un message en place

### Question 29

Que retourne `getHeader($name)` sur un message PSR-7 ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne unique, la première valeur du header
- [ ] **B.** Un **tableau de chaînes** (toutes les valeurs du header) — `getHeaderLine($name)` les concatène en une chaîne séparée par des virgules
- [ ] **C.** Un objet `HeaderBag`
- [ ] **D.** `true` ou `false` selon la présence du header

### Question 30

Pourquoi PSR-17 (HTTP Factories) existe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Parce que PSR-7 n'a pas défini **comment créer** les objets HTTP : les factories (`RequestFactoryInterface`, `ResponseFactoryInterface`, `StreamFactoryInterface`…) permettent d'instancier des objets PSR-7 sans dépendre d'une implémentation précise
- [ ] **B.** Pour remplacer les constructeurs jugés trop lents
- [ ] **C.** Pour standardiser la sérialisation des messages
- [ ] **D.** Pour définir le protocole HTTP/2 en PHP

## PSR-11 — Container Interface

### Question 31

Quelles affirmations sur `Psr\Container\ContainerInterface` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle expose exactement deux méthodes : `get()` et `has()`
- [ ] **B.** `get()` avec un identifiant inconnu doit lever une `NotFoundExceptionInterface`
- [ ] **C.** Si `has($id)` retourne `false`, alors `get($id)` **doit** lever une `NotFoundExceptionInterface`
- [ ] **D.** Deux appels successifs à `get()` avec le même id garantissent la même instance

### Question 32

Quel usage la spécification PSR-11 décourage-t-elle explicitement ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser des identifiants d'entrée contenant des points
- [ ] **B.** Combiner plusieurs containers dans une application
- [ ] **C.** Passer le container à un objet pour qu'il récupère **ses propres dépendances** — c'est le pattern Service Locator, généralement découragé
- [ ] **D.** Stocker des paramètres scalaires dans le container

## PSR-13 — Hypermedia Links

### Question 33

Quelles affirmations sur PSR-13 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `LinkInterface` expose `getHref()`, `isTemplated()`, `getRels()` et `getAttributes()`
- [ ] **B.** `EvolvableLinkInterface` ajoute des méthodes immuables `withHref()`, `withRel()`, `withAttribute()`…
- [ ] **C.** `LinkProviderInterface` expose `getLinks()` et `getLinksByRel()`
- [ ] **D.** Les interfaces vivent dans le namespace `Psr\Hypermedia`

## PSR-14 — Event Dispatcher

### Question 34

Quelles affirmations sur les rôles définis par PSR-14 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un **Event** peut être n'importe quel objet PHP
- [ ] **B.** Le **Dispatcher** doit déléguer la détermination des listeners concernés à un **Listener Provider**
- [ ] **C.** Le Listener Provider détermine les listeners pertinents mais ne doit **pas** les appeler lui-même
- [ ] **D.** Un **Listener** doit implémenter une interface `ListenerInterface` dédiée

### Question 35

Quelles règles le Dispatcher PSR-14 doit-il respecter ? *(plusieurs bonnes réponses)*

- [ ] **A.** `dispatch(object $event)` retourne le **même objet** événement une fois les listeners invoqués
- [ ] **B.** Pour un événement `StoppableEventInterface`, `isPropagationStopped()` est vérifié avant chaque listener ; s'il retourne `true`, plus aucun listener n'est appelé
- [ ] **C.** Une exception levée par un listener bloque les listeners suivants et doit remonter à l'émetteur (le dispatcher peut l'attraper pour la journaliser, mais doit la relancer)
- [ ] **D.** Les valeurs de retour des listeners sont agrégées et retournées à l'émetteur

### Question 36

Quel est le lien entre l'EventDispatcher de Symfony et PSR-14 ? *(une seule bonne réponse)*

- [ ] **A.** Aucun : les deux systèmes sont incompatibles
- [ ] **B.** `Symfony\Contracts\EventDispatcher\EventDispatcherInterface` **étend** `Psr\EventDispatcher\EventDispatcherInterface` — le dispatcher de Symfony est une implémentation PSR-14
- [ ] **C.** C'est PSR-14 qui étend l'interface de Symfony
- [ ] **D.** Symfony a retiré le support PSR-14 en 7.0

## PSR-15 — HTTP Server Request Handlers

### Question 37

Quelles affirmations sur PSR-15 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `RequestHandlerInterface` définit `handle(ServerRequestInterface $request): ResponseInterface`
- [ ] **B.** `MiddlewareInterface` définit `process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface`
- [ ] **C.** Un middleware peut créer et retourner une réponse **sans déléguer** au request handler, si les conditions le permettent
- [ ] **D.** Ces interfaces vivent dans le namespace `Psr\Middleware`

## PSR-18 — HTTP Client

### Question 38

Quelles affirmations sur le client PSR-18 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `ClientInterface` définit `sendRequest(RequestInterface $request): ResponseInterface` (messages PSR-7)
- [ ] **B.** Une réponse bien formée avec un statut 4xx ou 5xx ne doit **pas** lever d'exception : elle est retournée normalement
- [ ] **C.** Un échec réseau, y compris un timeout, doit lever une `NetworkExceptionInterface`
- [ ] **D.** Toute réponse portant un code d'erreur HTTP doit lever une `ClientExceptionInterface`

### Question 39

Quand le client doit-il lever une `RequestExceptionInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Quand le serveur répond 404
- [ ] **B.** Quand la connexion expire (timeout)
- [ ] **C.** Quand la réponse ne peut pas être parsée
- [ ] **D.** Quand la requête n'est pas un message HTTP bien formé ou qu'il lui manque une information critique (ex. Host ou méthode)

## PSR-20 — Clock

### Question 40

Que définit `Psr\Clock\ClockInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Une unique méthode `now()`, qui doit retourner un `\DateTimeImmutable`
- [ ] **B.** Une méthode `now()` retournant un `\DateTime` mutable
- [ ] **C.** Une méthode `getTimestamp()` retournant un entier
- [ ] **D.** Les méthodes `now()`, `sleep()` et `timezone()`

### Question 41

Quel problème PSR-20 résout-il ? *(une seule bonne réponse)*

- [ ] **A.** La synchronisation NTP des serveurs PHP
- [ ] **B.** La gestion des fuseaux horaires en base de données
- [ ] **C.** L'impossibilité de **mocker l'heure courante** dans les tests quand le code appelle directement `\time()` ou `new \DateTimeImmutable('now')`
- [ ] **D.** La précision à la microseconde des timestamps

## Symfony et les PSR

### Question 42

Quels composants Symfony implémentent des PSR ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le composant Cache implémente PSR-6 **et** PSR-16
- [ ] **B.** Le container du composant DependencyInjection implémente PSR-11
- [ ] **C.** Le composant Clock implémente PSR-20 (avec `MockClock` pour les tests)
- [ ] **D.** Le composant WebLink implémente PSR-13

### Question 43

Les `Request`/`Response` de HttpFoundation implémentent-ils PSR-7 ? *(une seule bonne réponse)*

- [ ] **A.** Oui, nativement depuis Symfony 6
- [ ] **B.** Non — HttpFoundation a ses propres classes ; le bridge `symfony/psr-http-message-bridge` assure la conversion dans les deux sens
- [ ] **C.** Oui, mais uniquement la `Response`
- [ ] **D.** Non, et aucune conversion n'est possible

### Question 44

Comment utiliser Symfony HttpClient là où une bibliothèque attend un client PSR-18 ? *(une seule bonne réponse)*

- [ ] **A.** C'est impossible : HttpClient n'est pas compatible PSR
- [ ] **B.** En passant directement `HttpClientInterface`, identique à `ClientInterface`
- [ ] **C.** En écrivant soi-même un adaptateur
- [ ] **D.** Via la classe `Psr18Client` fournie par `symfony/http-client`, qui implémente `Psr\Http\Client\ClientInterface`

### Question 45

Comment injecte-t-on le logger dans un service Symfony ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant `Psr\Log\LoggerInterface` (PSR-3) — l'implémentation est fournie par Monolog via MonologBundle
- [ ] **B.** En type-hintant `Symfony\Component\Log\LoggerInterface`
- [ ] **C.** Avec la façade statique `Log::`
- [ ] **D.** En héritant d'`AbstractLoggerAware`

---

## Corrigé

Les références *(Contracts — § …)* renvoient à la [page du composant Contracts de la documentation Symfony 8.0](https://symfony.com/doc/8.0/components/contracts.html) ; *(PSR-N — § …)* aux [spécifications officielles du PHP-FIG](https://www.php-fig.org/psr/) ; *(Symfony)* aux pages de documentation Symfony des composants concernés.

**Question 1 : B** — « The Contracts component provides a set of abstractions extracted out of the Symfony components. They can be used to build on semantics that the Symfony components proved useful - and that already have battle-tested implementations. » *(Contracts — introduction)*

**Question 2 : A, B, C** — « Contracts are provided as separate packages, so you can install only the ones your projects really need » : `cache-contracts`, `event-dispatcher-contracts`, `deprecation-contracts`, `http-client-contracts`, `service-contracts`, `translation-contracts`. `symfony/routing-contracts` (D) n'existe pas. *(Contracts — § Installation)*

**Question 3 : A, B, C** — « The abstractions in this package are useful to achieve loose coupling and interoperability. By using the provided interfaces as type hints, you are able to reuse any implementations that match their contracts. It could be a Symfony component, or another package provided by the PHP community at large. » Certaines se combinent avec l'autowiring, d'autres servent d'interfaces « étiquettes » avec l'autoconfiguration. D est l'inverse de l'objectif. *(Contracts — § Usage)*

**Question 4 : A, B, C** — Les principes documentés : découpage par domaine en sous-namespaces ; « small and consistent sets of PHP interfaces, traits, normative docblocks and reference test suites » ; « must have a proven implementation to enter this repository » ; et « must be **backward compatible** with existing Symfony components » — D affirme le contraire. *(Contracts — § Design Principles)*

**Question 5 : C** — « Packages that implement specific contracts should list them in the `provide` section of their `composer.json` file, using the `symfony/*-implementation` convention » — ex. `"provide": {"symfony/cache-implementation": "3.0"}`. *(Contracts — § Design Principles)*

**Question 6 : A** — « When applicable, the provided contracts are built on top of PHP-FIG's PSRs. However, PHP-FIG has different goals and different processes. Symfony Contracts focuses on providing abstractions that are useful on their own while still compatible with implementations provided by Symfony. » *(Contracts — § FAQ)*

**Question 7 : D** — PSR = PHP Standards Recommendation, publiées par le PHP Framework Interoperability Group (PHP-FIG), dont les membres sont des projets PHP majeurs (frameworks, CMS…). *(php-fig.org)*

**Question 8 : A, B, C** — Les 14 PSR acceptés : 1, 3, 4, 6, 7, 11, 12, 13, 14, 15, 16, 17, 18 et 20. PSR-5 et PSR-19 (PHPDoc) sont en **Draft** (D) ; PSR-8 (Huggable), 9 et 10 sont abandonnés ; PSR-0 et PSR-2 dépréciés. *(php-fig.org — PSRs by status)*

**Question 9 : B** — PSR-0 (Autoloading) et PSR-2 (Coding Style) sont **Deprecated**, remplacés dans les faits par PSR-4 et PSR-12. *(php-fig.org)*

**Question 10 : C** — Chaque spécification l'énonce : « The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be interpreted as described in RFC 2119. » *(toutes les PSR)*

**Question 11 : A, B, C** — Chaque PSR d'interfaces a son paquet : `psr/log`, `psr/container`, `psr/cache`, `psr/simple-cache`, `psr/http-message`, `psr/clock` (mais aussi `psr/event-dispatcher`, `psr/link`, `psr/http-factory`, `psr/http-client`, `psr/http-server-handler`/`-middleware`). Les standards de style (PSR-1, PSR-12) ne définissent pas d'interfaces — pas de paquet (D). *(php-fig.org ; Packagist)*

**Question 12 : A, B, C** — « Files MUST use only `<?php` and `<?=` tags » ; « MUST use only UTF-8 without BOM » ; « SHOULD either declare symbols […] or cause side-effects […] but SHOULD NOT do both ». D est faux : « conditional declaration is *not* a side effect ». *(PSR-1 — § 2. Files)*

**Question 13 : A, B, C** — `StudlyCaps` pour les classes, majuscules + underscores pour les constantes, `camelCase()` pour les méthodes. D est faux : « This guide intentionally avoids any recommendation regarding the use of `$StudlyCaps`, `$camelCase`, or `$under_score` property names » — seule exigence, la cohérence dans un périmètre raisonnable. *(PSR-1 — § 4)*

**Question 14 : A** — « This specification extends, expands and replaces PSR-2, the coding style guide and requires adherence to PSR-1, the basic coding standard. » *(PSR-12 — § Overview)*

**Question 15 : A, B, C** — « Code MUST use an indent of 4 spaces for each indent level, and MUST NOT use tabs for indenting » ; « There MUST NOT be a hard limit on line length. The soft limit […] MUST be 120 characters » (et SHOULD ≤ 80) ; « Visibility MUST be declared on all properties » / « on all methods ». D contredit la règle d'indentation. *(PSR-12 — § 2)*

**Question 16 : D** — « Declare statements MUST contain no spaces and MUST be exactly `declare(strict_types=1)` » — et le bloc declare se place en tête de fichier, après `<?php`. *(PSR-12 — § 3)*

**Question 17 : A, B, C** — « The fully qualified class name MUST have a top-level namespace name, also known as a "vendor namespace" » ; le préfixe correspond « to at least one "base directory" », les sous-namespaces à des sous-répertoires de même casse ; « the terminating class name corresponds to a file name ending in `.php` » de même casse. D est faux — c'était la règle de **PSR-0** ; en PSR-4, « underscores have no special meaning in any portion of the fully qualified class name ». *(PSR-4 — § 2. Specification)*

**Question 18 : B** — « Autoloader implementations MUST NOT throw exceptions, MUST NOT raise errors of any level, and SHOULD NOT return a value » — un autre autoloader enregistré peut encore trouver la classe. *(PSR-4 — § 2. Specification)*

**Question 19 : A, B, C** — « The `LoggerInterface` exposes eight methods to write logs to the eight RFC 5424 levels » ; la neuvième, `log`, « accepts a log level as the first argument » avec résultat identique ; un niveau inconnu « MUST throw a `Psr\Log\InvalidArgumentException` ». `trace` et `fatal` (D) n'existent pas en PSR-3. *(PSR-3 — § 1.1 Basics)*

**Question 20 : A, B, C** — Placeholders « delimited with a single opening brace `{` and a single closing brace `}` », correspondant aux clés du contexte ; « If an `Exception` object is passed in the context data, it MUST be in the `'exception'` key » ; le message est une chaîne ou un objet `__toString()`. D est faux : « A given value in the context MUST NOT throw an exception nor raise any php error, warning or notice. » *(PSR-3 — § 1.2 / 1.3)*

**Question 21 : A, B, C** — `AbstractLogger`/`LoggerTrait` (implémenter seulement `log()`), `NullLogger` (« a fall-back "black hole" implementation »), `LoggerAwareInterface` (« only contains a `setLogger(LoggerInterface $logger)` method ») + `LoggerAwareTrait`. D est faux : `LogLevel` « holds constants for the **eight** log levels ». *(PSR-3 — § 1.4)*

**Question 22 : A, B, C** — Le pool (`CacheItemPoolInterface` : `getItem`, `getItems`, `hasItem`, `clear`, `deleteItem(s)`, `save`, `saveDeferred`, `commit`) manipule des items (`CacheItemInterface` : `getKey`, `get`, `isHit`, `set`, `expiresAt`, `expiresAfter`). `get($key, $default)` (D) est la signature de PSR-16. *(PSR-6 — § Interfaces)*

**Question 23 : A** — `expiresAt($expiration)` accepte un `\DateTimeInterface` (moment absolu), `expiresAfter($time)` un entier en secondes ou un `\DateInterval` (durée relative) ; `null` restaure la valeur par défaut de l'implémentation. *(PSR-6 — § CacheItemInterface)*

**Question 24 : A, B, C** — `CacheInterface` couvre lecture/écriture/suppression simples et multiples ; `get($key, $default = null)` retourne le défaut en cas de miss ; « A cache miss will return null and therefore detecting if one stored `null` is not possible. This is the main deviation from PSR-6's assumptions. » D est faux : pas d'objet item en PSR-16, c'est justement sa simplification. *(PSR-16 — § 1.2 / 2.1)*

**Question 25 : C** — « The following characters are reserved for future extensions and MUST NOT be supported by implementing libraries: `{}()/\@:` » — support minimum requis : `A-Z`, `a-z`, `0-9`, `_` et `.`, jusqu'à 64 caractères. *(PSR-6 / PSR-16 — § Key)*

**Question 26 : D** — « It is independent of PSR-6 but has been designed to make compatibility with PSR-6 as straightforward as possible » ; « An instance of CacheInterface corresponds to a single collection of cache items with a single key namespace, and is equivalent to a "Pool" in PSR-6. » Aucun des deux ne déprécie l'autre (B). *(PSR-16 — § 1.1 / 2.1)*

**Question 27 : A, B, C** — Les sept interfaces PSR-7 : `MessageInterface`, `RequestInterface`, `ServerRequestInterface`, `ResponseInterface`, `StreamInterface`, `UriInterface`, `UploadedFileInterface`. `MiddlewareInterface` (D) appartient à PSR-15. *(PSR-7 — § 3. Interfaces)*

**Question 28 : A, B, C** — « Messages are considered immutable; all methods that might change state MUST […] return an instance that contains the changed state » (méthodes `with*()`) ; « Unlike the request and response interfaces, `StreamInterface` does not model immutability […] as any code that interacts with the resource can potentially change its state » ; les headers s'accèdent par nom « case-insensitive ». `setHeader()` (D) n'existe pas. *(PSR-7 — § What is a message / 3.4)*

**Question 29 : B** — `getHeader($name)` retourne un tableau de toutes les valeurs du header ; `getHeaderLine($name)` retourne ces valeurs « concatenated together using a comma ». *(PSR-7 — § MessageInterface)*

**Question 30 : A** — « PSR-7 did not include a recommendation on how to create HTTP objects, which leads to difficulties when needing to create new HTTP objects within components that are not tied to a specific implementation of PSR-7. » D'où les six factories (`Request`, `Response`, `ServerRequest`, `Stream`, `Uri`, `UploadedFile`). *(PSR-17 — introduction)*

**Question 31 : A, B, C** — « The `Psr\Container\ContainerInterface` exposes two methods: `get` and `has` » ; « A call to the `get` method with a non-existing id MUST throw a `Psr\Container\NotFoundExceptionInterface` » ; « If `has($id)` returns false, `get($id)` MUST throw a `NotFoundExceptionInterface`. » D est faux : « `user` SHOULD NOT rely on getting the same value on 2 successive calls. » *(PSR-11 — § 1.1)*

**Question 32 : C** — « Users SHOULD NOT pass a container into an object so that the object can retrieve *its own dependencies*. This means the container is used as a Service Locator which is a pattern that is generally discouraged. » *(PSR-11 — § 1.3 Recommended usage)*

**Question 33 : A, B, C** — `LinkInterface` (`getHref`, `isTemplated`, `getRels`, `getAttributes`), `EvolvableLinkInterface` (`withHref`, `withRel`, `withoutRel`, `withAttribute`…), `LinkProviderInterface` (`getLinks`, `getLinksByRel`) et `EvolvableLinkProviderInterface`. Le namespace (D) est `Psr\Link` — c'est ce PSR qu'implémente le composant Symfony WebLink. *(PSR-13 — § 3. Interfaces)*

**Question 34 : A, B, C** — « An Event is a message produced by an Emitter. It may be any arbitrary PHP object » ; le Dispatcher « MUST defer determining the responsible listeners to a Listener Provider » ; le Listener Provider « MUST NOT call the Listeners itself ». D est faux : « A Listener may be any PHP callable » avec « one and only one parameter ». *(PSR-14 — § Definitions / Listeners)*

**Question 35 : A, B, C** — Le Dispatcher « MUST return the same Event object it was passed after it is done invoking Listeners » ; pour un Stoppable Event, il « MUST call `isPropagationStopped()` on the Event before each Listener has been called » ; « An Exception or Error thrown by a Listener MUST block the execution of any further Listeners [and] MUST be allowed to propagate back up to the Emitter » (catch possible « but then MUST rethrow the original throwable »). D est faux : « A Dispatcher MUST ignore return values from Listeners. » *(PSR-14 — § Dispatcher)*

**Question 36 : B** — `Symfony\Contracts\EventDispatcher\EventDispatcherInterface` étend `Psr\EventDispatcher\EventDispatcherInterface` : l'EventDispatcher de Symfony est utilisable partout où un dispatcher PSR-14 est attendu — illustration du principe « built on top of PHP-FIG's PSRs » des Contracts. *(Symfony — event-dispatcher-contracts ; Contracts — § FAQ)*

**Question 37 : A, B, C** — Les deux interfaces avec ces signatures exactes ; et « a middleware component MAY create and return a response without delegating to a request handler, if sufficient conditions are met ». D est faux : le namespace est `Psr\Http\Server`. *(PSR-15 — § 2. Interfaces)*

**Question 38 : A, B, C** — `sendRequest()` échange des messages PSR-7 ; « response status codes in the 400 and 500 range MUST NOT cause an exception and MUST be returned to the Calling Library as normal » ; « if the request cannot be sent due to a network failure of any kind, including a timeout, the Client MUST throw an instance of `NetworkExceptionInterface` ». D contredit B — une exception `ClientExceptionInterface` n'est levée que si la requête n'a pas pu être envoyée ou la réponse pas parsée. *(PSR-18 — § Error handling)*

**Question 39 : D** — « If a request cannot be sent because the request message is not a well-formed HTTP request or is missing some critical piece of information (such as a Host or Method), the Client MUST throw an instance of `RequestExceptionInterface`. » *(PSR-18 — § Error handling)*

**Question 40 : A** — « The clock interface defines the most basic operations to read the current time and date from the clock. It MUST return the time as a `\DateTimeImmutable` » : `public function now(): \DateTimeImmutable;`. Le timestamp s'obtient via `$clock->now()->getTimestamp()`. *(PSR-20 — § 2.1)*

**Question 41 : C** — « Creating a standard way of accessing the clock would allow interoperability during testing […] Common ways to get the current time include calling `\time()` or `new \DateTimeImmutable('now')`. However, this makes mocking the current time impossible in some situations. » *(PSR-20 — § 1.1)*

**Question 42 : A, B, C, D** — Les quatre sont vraies : le composant Cache implémente PSR-6 **et** PSR-16 ; le `ContainerInterface` de DependencyInjection étend `Psr\Container\ContainerInterface` (PSR-11) ; le composant Clock implémente PSR-20 (`MockClock` pour figer le temps en test — cf. QCM controller, `DateTimeValueResolver`) ; WebLink implémente PSR-13 (preload/Early Hints). *(Symfony — docs Cache, DependencyInjection, Clock, WebLink)*

**Question 43 : B** — HttpFoundation est antérieur à PSR-7 et garde son propre modèle objet ; le bridge `symfony/psr-http-message-bridge` convertit HttpFoundation ↔ PSR-7 dans les deux sens (c'est lui qu'utilise le « PSR-7 Objects Resolver » vu dans le QCM controller). *(Symfony — doc PSR-7 Bridge)*

**Question 44 : D** — `Symfony\Component\HttpClient\Psr18Client` implémente `Psr\Http\Client\ClientInterface` (et s'appuie sur des factories PSR-17) : HttpClient devient utilisable par toute bibliothèque attendant un client PSR-18. `HttpClientInterface` (B) est l'interface propre à Symfony, différente de `ClientInterface`. *(Symfony — doc HttpClient)*

**Question 45 : A** — On type-hint `Psr\Log\LoggerInterface` (PSR-3) et l'autowiring injecte le logger Monolog fourni par MonologBundle — exemple canonique d'interopérabilité PSR. *(Symfony — doc Logging)*
