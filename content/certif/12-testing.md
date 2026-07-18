# QCM — Testing

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/testing.html](https://symfony.com/doc/8.0/testing.html) (questions 1 à 40) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/testing.html#learn-more) (questions 41 à 92) · **Généré le :** 20 juillet 2026
>
> **92 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Types de tests et installation

### Question 1

Quelles sont les trois catégories de tests définies par la documentation Symfony, et comment les distingue-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Unit Tests (une unité de code isolée), Integration Tests (une combinaison de classes, interagissant souvent avec le container), Application Tests (l'application complète, via de vraies/simulées requêtes HTTP)
- [ ] **B.** Unit Tests, Functional Tests, Acceptance Tests — les trois étant strictement synonymes
- [ ] **C.** Seuls Unit Tests et Integration Tests existent ; « Application Tests » n'est pas un terme utilisé par Symfony
- [ ] **D.** Les Integration Tests couvrent déjà l'application complète, contrairement aux Application Tests

### Question 2

Que faut-il installer avant d'écrire son premier test, et que fait ce paquet ? *(une seule bonne réponse)*

- [ ] **A.** `composer require --dev symfony/test-pack`, qui installe d'autres paquets nécessaires aux tests (dont `phpunit/phpunit`)
- [ ] **B.** `composer require symfony/test-pack` (sans `--dev`), car il est aussi nécessaire en production
- [ ] **C.** `composer require --dev phpunit/phpunit` uniquement ; `test-pack` n'existe pas
- [ ] **D.** Aucune installation n'est nécessaire, PHPUnit est fourni nativement avec Symfony

### Question 3

Quelles affirmations sur `phpunit.dist.xml` et Symfony Flex sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony Flex crée automatiquement `phpunit.dist.xml` et `tests/bootstrap.php`
- [ ] **B.** Si ces fichiers manquent, on peut relancer la recipe avec `composer recipes:install phpunit/phpunit --force -v`
- [ ] **C.** Dans les versions de PHPUnit antérieures à 10, ce fichier s'appelle `phpunit.xml.dist`
- [ ] **D.** Ce fichier ne peut jamais être modifié manuellement

### Question 4

Quelle convention de nommage et d'emplacement les tests doivent-ils suivre ? *(une seule bonne réponse)*

- [ ] **A.** Une classe de test se termine par « Test » (ex. `BlogControllerTest`) et vit dans `tests/`, dont l'arborescence doit répliquer celle de l'application (`src/Form/` → `tests/Form/`)
- [ ] **B.** Le nom du fichier de test doit commencer par « Test »
- [ ] **C.** Les tests doivent tous être placés dans un seul fichier `tests/AllTests.php`
- [ ] **D.** Aucune convention n'est imposée par Symfony

## Tests unitaires

### Question 5

Écrire un test unitaire dans une application Symfony diffère-t-il de PHPUnit standard ? *(une seule bonne réponse)*

- [ ] **A.** Non : « Writing unit tests in a Symfony application is no different from writing standard PHPUnit unit tests »
- [ ] **B.** Oui, il faut obligatoirement étendre `KernelTestCase`
- [ ] **C.** Oui, il faut démarrer le kernel avant chaque test unitaire
- [ ] **D.** Oui, un test unitaire nécessite toujours une base de données de test

### Question 6

Quelles commandes permettent de cibler l'exécution des tests ? *(plusieurs bonnes réponses)*

- [ ] **A.** `php bin/phpunit` exécute tous les tests de l'application
- [ ] **B.** `php bin/phpunit tests/Form` exécute tous les tests d'un répertoire
- [ ] **C.** `php bin/phpunit tests/Form/UserTypeTest.php` exécute les tests d'une seule classe
- [ ] **D.** Il n'existe aucun moyen de cibler un sous-ensemble de tests

## Tests d'intégration

### Question 7

Quel rôle joue `KernelTestCase` pour les tests d'intégration ? *(une seule bonne réponse)*

- [ ] **A.** Elle aide à créer et démarrer le kernel via `bootKernel()`, et s'assure que le kernel est redémarré pour chaque test afin que les tests s'exécutent indépendamment les uns des autres
- [ ] **B.** Elle simule un navigateur HTTP complet
- [ ] **C.** Elle remplace entièrement PHPUnit
- [ ] **D.** Elle ne peut être utilisée qu'avec une base de données Doctrine

### Question 8

Comment `KernelTestCase` détermine-t-elle quelle classe de kernel initialiser ? *(une seule bonne réponse)*

- [ ] **A.** Via la variable d'environnement `KERNEL_CLASS` (définie par défaut dans `.env.test`) ; on peut aussi surcharger `getKernelClass()` ou `createKernel()`, qui prennent le pas sur cette variable
- [ ] **B.** Elle scanne automatiquement `src/` à la recherche d'une classe `Kernel`
- [ ] **C.** Il faut toujours la passer en argument de `bootKernel()`
- [ ] **D.** Elle est codée en dur dans `KernelTestCase`

### Question 9

Dans quel environnement les tests s'exécutent-ils, et où placer une configuration spécifique aux tests ? *(une seule bonne réponse)*

- [ ] **A.** Dans l'environnement `test` ; la configuration spécifique va dans `config/packages/test/` ou sous la clé `when@test` (ex. `twig.strict_variables: true`)
- [ ] **B.** Dans l'environnement `dev`, sans distinction
- [ ] **C.** Il n'existe pas d'environnement dédié aux tests
- [ ] **D.** Uniquement dans un fichier `config/test.yaml` à la racine

### Question 10

Comment personnaliser l'environnement ou le mode debug utilisés par `bootKernel()`, et que recommande la documentation pour la CI ? *(une seule bonne réponse)*

- [ ] **A.** En passant `['environment' => ..., 'debug' => ...]` à `bootKernel()` ; il est recommandé de mettre `debug` à `false` sur le serveur de CI, car cela améliore significativement les performances (en désactivant le nettoyage automatique du cache)
- [ ] **B.** `bootKernel()` n'accepte aucun argument
- [ ] **C.** Le mode debug est toujours forcé à `true`, sans option pour le désactiver
- [ ] **D.** Il faut modifier `.env.test.local` pour changer l'environnement à chaque exécution

### Question 11

Comment sont chargés les fichiers d'environnement en environnement `test`, et quelle exception notable la documentation signale-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `.env`, puis `.env.test`, puis `.env.test.local` (les fichiers plus bas dans la liste écrasant les précédents) — mais `.env.local` n'est **pas** utilisé en environnement de test, pour garder un setup de test cohérent
- [ ] **B.** Seul `.env.test` est lu, tous les autres fichiers `.env*` sont ignorés
- [ ] **C.** `.env.local` est prioritaire sur `.env.test.local`
- [ ] **D.** L'ordre de lecture est aléatoire

### Question 12

Comment récupérer un service depuis le container dans un test d'intégration, et à quels services donne-t-il accès ? *(une seule bonne réponse)*

- [ ] **A.** Via `static::getContainer()` après `bootKernel()` — ce container spécial de test donne accès aux services publics et aux services privés **non supprimés** (« non-removed »)
- [ ] **B.** En instanciant directement le service avec `new`
- [ ] **C.** Le container de test ne donne accès qu'aux services publics, jamais aux services privés
- [ ] **D.** Il faut appeler `self::getKernel()->getContainer()`

### Question 13

Comment tester un service privé qui a été **supprimé** du container (car non utilisé par aucun autre service) ? *(une seule bonne réponse)*

- [ ] **A.** En le déclarant public dans `config/services_test.yaml`
- [ ] **B.** Ce n'est techniquement pas possible
- [ ] **C.** En utilisant `ReflectionClass` pour l'instancier manuellement, seule solution documentée
- [ ] **D.** En désactivant l'optimisation du container en environnement `test`

## Mocker des dépendances

### Question 14

Comment remplacer une dépendance par un mock dans un test d'intégration, sans configuration supplémentaire ? *(une seule bonne réponse)*

- [ ] **A.** En créant le mock avec `$this->createMock(...)` puis en l'injectant via `$container->set(NewsRepositoryInterface::class, $newsRepository)` — le container de test spécial permet d'interagir avec les services et alias privés
- [ ] **B.** Il faut redéfinir le service dans `services_test.yaml` avant de pouvoir le mocker
- [ ] **C.** Ce n'est possible qu'avec des services publics
- [ ] **D.** Il faut créer un compiler pass dédié pour chaque mock

## Configurer une base de données pour les tests

### Question 15

Où définir une base de données dédiée aux tests, différente des autres environnements ? *(une seule bonne réponse)*

- [ ] **A.** Dans `.env.test.local` en redéfinissant `DATABASE_URL` — utile si chaque développeur/machine utilise une base différente ; si le setup est identique partout, `.env.test` (committé) convient
- [ ] **B.** Directement dans `config/packages/doctrine.yaml`, sans variable d'environnement
- [ ] **C.** Il n'est pas recommandé d'utiliser une base séparée pour les tests
- [ ] **D.** Uniquement via un argument de `bin/phpunit`

### Question 16

Quelles commandes créent la base de test et son schéma ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console --env=test doctrine:database:create` puis `php bin/console --env=test doctrine:schema:create`
- [ ] **B.** `php bin/console doctrine:test:create`
- [ ] **C.** Ces commandes ne prennent pas d'option d'environnement, il faut changer `.env` manuellement avant de les lancer
- [ ] **D.** `php bin/phpunit --create-db`

### Question 17

Comment le DAMADoctrineTestBundle isole-t-il chaque test de la base de données ? *(une seule bonne réponse)*

- [ ] **A.** Il démarre une transaction Doctrine avant chaque test et l'annule (rollback) automatiquement à la fin, pour défaire tous les changements
- [ ] **B.** Il recrée entièrement la base de données avant chaque test
- [ ] **C.** Il exécute chaque test dans un conteneur Docker isolé
- [ ] **D.** Il utilise un cache en mémoire pour simuler la base

### Question 18

Comment enregistre-t-on `dama/doctrine-test-bundle` dans PHPUnit selon la version ? *(une seule bonne réponse)*

- [ ] **A.** Comme extension dans `phpunit.dist.xml` : `<bootstrap class="...PHPUnitExtension"/>` pour PHPUnit 10 ou plus récent, `<extension class="...">` pour les versions antérieures
- [ ] **B.** Il ne nécessite aucune configuration PHPUnit, uniquement `composer require`
- [ ] **C.** Il se configure exclusivement via `config/packages/test/doctrine.yaml`
- [ ] **D.** Il faut l'activer dans `.env.test`

### Question 19

Comment charger des données de test (« fixtures ») avec Doctrine, et quelle commande recommandée génère la classe vide ? *(une seule bonne réponse)*

- [ ] **A.** `composer require --dev doctrine/doctrine-fixtures-bundle` puis `php bin/console make:fixtures`, qui génère une classe étendant `Fixture`, avec sa méthode `load(ObjectManager $manager)`
- [ ] **B.** Les fixtures sont générées automatiquement à partir des entités, sans code à écrire
- [ ] **C.** `php bin/console doctrine:fixtures:generate`
- [ ] **D.** Les fixtures ne peuvent être écrites qu'en YAML

### Question 20

Quelle commande vide la base et recharge toutes les classes de fixtures ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console --env=test doctrine:fixtures:load`
- [ ] **B.** `php bin/console doctrine:fixtures:reload`
- [ ] **C.** `php bin/phpunit --fixtures`
- [ ] **D.** Il faut recharger les fixtures manuellement une par une

## Tests applicatifs

### Question 21

Quel est le flux de travail spécifique décrit pour les tests applicatifs (fonctionnels) ? *(une seule bonne réponse)*

- [ ] **A.** Faire une requête, interagir avec la page (cliquer un lien, soumettre un formulaire), tester la réponse, puis recommencer
- [ ] **B.** Uniquement faire une requête et vérifier le code de statut
- [ ] **C.** Écrire d'abord les assertions, puis générer la requête automatiquement
- [ ] **D.** Il n'existe pas de flux de travail standard documenté

### Question 22

Quelle classe de base les tests applicatifs étendent-ils typiquement, et où vivent-ils généralement ? *(une seule bonne réponse)*

- [ ] **A.** `WebTestCase` (qui ajoute une logique spéciale par-dessus `KernelTestCase`), dans `tests/Controller/`
- [ ] **B.** `TypeTestCase`, dans `tests/Form/`
- [ ] **C.** `PantherTestCase` obligatoirement
- [ ] **D.** `TestCase` de PHPUnit directement, sans classe Symfony

### Question 23

Que fait `static::createClient()` suivi de `$client->request('GET', '/')` ? *(une seule bonne réponse)*

- [ ] **A.** Cela démarre le kernel (via `KernelTestCase::bootKernel()`), crée un « client » agissant comme un navigateur, et retourne un `Crawler` pour la requête effectuée
- [ ] **B.** Cela envoie une vraie requête HTTP sur le réseau
- [ ] **C.** Cela ne fonctionne que si un serveur web est démarré manuellement
- [ ] **D.** Cela nécessite obligatoirement une base de données configurée

### Question 24

Quelle bonne pratique la documentation recommande-t-elle pour les URLs utilisées dans `$client->request()` ? *(une seule bonne réponse)*

- [ ] **A.** Écrire les URLs en dur (hardcoded), plutôt que de les générer via le routeur Symfony — sinon un changement d'URL applicatif ne serait pas détecté par le test, alors qu'il impacterait les utilisateurs
- [ ] **B.** Toujours générer les URLs dynamiquement via le routeur, jamais en dur
- [ ] **C.** Utiliser exclusivement des URLs relatives au répertoire courant
- [ ] **D.** Peu importe, aucune recommandation n'est donnée

### Question 25

Que se passe-t-il par défaut lors de **requêtes multiples** dans un même test, et quelles conséquences cela peut-il avoir ? *(une seule bonne réponse)*

- [ ] **A.** Le client redémarre le kernel à chaque nouvelle requête, recréant le container depuis zéro pour isoler les requêtes — ce qui efface par exemple le token de sécurité ou détache les entités Doctrine
- [ ] **B.** Le kernel n'est démarré qu'une seule fois pour tout le test, quel que soit le nombre de requêtes
- [ ] **C.** Chaque requête supplémentaire échoue automatiquement
- [ ] **D.** Les requêtes multiples sont interdites dans un même test

### Question 26

Comment éviter ce redémarrage du kernel entre deux requêtes, et quel effet de bord persiste malgré tout ? *(une seule bonne réponse)*

- [ ] **A.** Avec `$client->disableReboot()`, qui appelle `reset()` sur les services tagués `kernel.reset` au lieu de rebooter — mais cela efface **quand même** le token de sécurité et détache les entités Doctrine
- [ ] **B.** `disableReboot()` supprime tous les effets de bord sans exception
- [ ] **C.** Il n'existe aucun moyen d'éviter ce comportement
- [ ] **D.** Il faut désactiver complètement le kernel de test

### Question 27

Comment empêcher que le token de sécurité et les entités Doctrine soient réinitialisés entre deux requêtes du même test ? *(une seule bonne réponse)*

- [ ] **A.** En créant un compiler pass qui retire le tag `kernel.reset` des définitions concernées (ex. `security.token_storage`, `doctrine`) uniquement en environnement `test`
- [ ] **B.** En appelant `$client->preserveState()`
- [ ] **C.** Ce n'est pas configurable
- [ ] **D.** En passant `preserve: true` à `createClient()`

### Question 28

Quelles méthodes de navigation le client de test supporte-t-il, à l'image d'un vrai navigateur ? *(plusieurs bonnes réponses)*

- [ ] **A.** `back()` et `forward()`
- [ ] **B.** `reload()`
- [ ] **C.** `restart()`, qui efface tous les cookies et l'historique
- [ ] **D.** `back()`/`forward()` suivent les redirections qui ont pu se produire, exactement comme `request()`

### Question 29

Comment le client gère-t-il par défaut une réponse de redirection, et comment forcer le comportement inverse ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, le client ne suit pas automatiquement la redirection : il faut appeler `followRedirect()` pour l'examiner et forcer la redirection après coup
- [ ] **B.** `followRedirects()` (sans argument, ou avec `true`) force le suivi automatique de toutes les redirections pour les requêtes suivantes
- [ ] **C.** `followRedirects(false)` désactive à nouveau le suivi automatique
- [ ] **D.** Le comportement de suivi des redirections ne peut jamais être changé

### Question 30

Comment simuler la connexion d'un utilisateur dans un test applicatif, et que recommande la documentation plutôt que de se connecter avec de « vrais » utilisateurs ? *(une seule bonne réponse)*

- [ ] **A.** Avec `$client->loginUser($testUser)`, en utilisant de préférence un utilisateur créé uniquement pour les tests (ex. via des fixtures Doctrine chargées dans la base de test)
- [ ] **B.** En soumettant réellement le formulaire de connexion à chaque test
- [ ] **C.** `loginUser()` n'accepte que des entités Doctrine `User`, jamais un utilisateur en mémoire
- [ ] **D.** Il faut désactiver le firewall de sécurité pour les tests

### Question 31

Quelles affirmations sur `loginUser()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle accepte n'importe quelle instance de `UserInterface`, y compris un `InMemoryUser` instancié directement (à condition de déclarer ce provider en mémoire dans la config de sécurité de l'environnement `test`)
- [ ] **B.** Elle crée un `TestBrowserToken` spécial stocké dans la session du client de test
- [ ] **C.** On peut préciser le firewall ciblé en second argument (`main` par défaut)
- [ ] **D.** Elle fonctionne aussi bien avec des firewalls stateless que stateful, sans aucune différence de comportement

### Question 32

Comment préparer la session du client **avant** d'effectuer une requête (ex. pré-remplir un jeton CSRF) ? *(une seule bonne réponse)*

- [ ] **A.** Via `$client->getSession()`, puis `$session->set(...)` et `$session->save()`
- [ ] **B.** En passant la session en 6ᵉ argument de `request()`
- [ ] **C.** Ce n'est pas possible, la session n'est accessible qu'après la requête
- [ ] **D.** En modifiant directement `$_SESSION`

### Question 33

Comment effectuer une requête AJAX avec le client de test ? *(une seule bonne réponse)*

- [ ] **A.** Avec `$client->xmlHttpRequest(...)`, qui ajoute automatiquement l'en-tête requis `HTTP_X_REQUESTED_WITH`
- [ ] **B.** Il faut ajouter manuellement tous les en-têtes AJAX requis via `request()`
- [ ] **C.** `xmlHttpRequest()` n'existe pas, il faut utiliser un vrai navigateur
- [ ] **D.** Uniquement possible avec Panther

### Question 34

Comment nommer un en-tête HTTP personnalisé (ex. `X-Session-Token`) pour le passer au client de test ? *(une seule bonne réponse)*

- [ ] **A.** Remplacer les `-` par `_`, mettre en majuscules, et préfixer par `HTTP_` (ex. `HTTP_X_SESSION_TOKEN`), selon la RFC 3875 §4.1.18
- [ ] **B.** Le nom de l'en-tête est passé tel quel, sans transformation
- [ ] **C.** Il faut l'encoder en base64
- [ ] **D.** Seuls les en-têtes standards HTTP sont supportés

### Question 35

Comment faire en sorte que les exceptions non catchées d'un test applicatif remontent à PHPUnit plutôt que d'être seulement journalisées ? *(une seule bonne réponse)*

- [ ] **A.** `$client->catchExceptions(false)`
- [ ] **B.** `$client->throwExceptions(true)`
- [ ] **C.** Les exceptions remontent toujours par défaut, aucune configuration n'existe
- [ ] **D.** Il faut consulter uniquement les logs, aucune option ne permet de les faire remonter

### Question 36

Comment activer la collecte de données du profiler pour la requête suivante, et que faut-il vérifier avant d'utiliser `getProfile()` ? *(une seule bonne réponse)*

- [ ] **A.** `$client->enableProfiler()` avant la requête ; il faut ensuite vérifier que `$client->getProfile()` ne retourne pas `null` (le profiler doit être activé en configuration)
- [ ] **B.** Le profiler est toujours actif automatiquement en environnement `test`
- [ ] **C.** `getProfile()` ne fonctionne que si le client est « insulated »
- [ ] **D.** Il faut appeler `enableProfiler()` une seule fois pour tout le test, peu importe le nombre de requêtes

## Interagir avec la réponse

### Question 37

Comment cliquer sur un lien ou soumettre un formulaire avec le client/crawler ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$client->clickLink('texte du lien')` clique sur le premier lien (ou image cliquable via son `alt`) contenant ce texte
- [ ] **B.** `$client->submitForm('Libellé du bouton', [...])` soumet le formulaire contenant ce bouton, en écrasant certaines valeurs par défaut
- [ ] **C.** On sélectionne un **bouton**, pas un formulaire, car un formulaire peut avoir plusieurs boutons
- [ ] **D.** Il n'existe qu'une seule façon de soumettre un formulaire, sans accès à l'objet `Form` sous-jacent

### Question 38

Comment renseigner différents types de champs sur un objet `Form` récupéré via `selectButton()->form()` ? *(une seule bonne réponse)*

- [ ] **A.** `select()` pour une option/un radio, `tick()` pour une case à cocher, `upload()` pour un fichier (y compris plusieurs fichiers via des index de tableau)
- [ ] **B.** Une seule méthode générique `setValue()` suffit pour tous les types de champs
- [ ] **C.** Il faut manipuler le DOM directement, le composant ne fournit pas de méthodes dédiées
- [ ] **D.** `tick()` ne fonctionne que sur les champs texte

## Assertions fournies par Symfony

### Question 39

Que doit étendre (ou quel trait utiliser) une classe de test pour bénéficier des assertions de réponse comme `assertResponseIsSuccessful()`, et que teste par exemple `assertResponseIsUnprocessable()` ? *(une seule bonne réponse)*

- [ ] **A.** `WebTestCase` (ou `BrowserKitAssertionsTrait`/`WebTestAssertionsTrait`) ; `assertResponseIsUnprocessable()` vérifie que le statut HTTP est `422`
- [ ] **B.** `KernelTestCase` seule suffit pour toutes les assertions de réponse
- [ ] **C.** Ces assertions sont disponibles nativement dans PHPUnit, sans rien à étendre
- [ ] **D.** `assertResponseIsUnprocessable()` vérifie un statut `500`

### Question 40

Pour tester le contenu des emails envoyés pendant un test (ex. corps HTML, sujet), quelle classe faut-il étendre ou quel trait utiliser, et que vérifie `assertEmailAddressContains()` ? *(une seule bonne réponse)*

- [ ] **A.** `KernelTestCase` (ou `MailerAssertionsTrait`) ; `assertEmailAddressContains()` vérifie une adresse d'en-tête en la normalisant (ex. `Jane Smith <jane@example.com>` → `jane@example.com`)
- [ ] **B.** `WebTestCase` uniquement, jamais `KernelTestCase`
- [ ] **C.** Aucune classe particulière n'est nécessaire, ces assertions sont globales
- [ ] **D.** `assertEmailAddressContains()` ne fonctionne que sur le sujet de l'email

---

> Les questions 41 à 92 couvrent les **8 pages** listées dans la section [Learn more](https://symfony.com/doc/8.0/testing.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Personnaliser le bootstrap avant les tests

### Question 41

Pourquoi personnaliser le fichier `tests/bootstrap.php` ? *(une seule bonne réponse)*

- [ ] **A.** Pour exécuter un travail de bootstrap additionnel avant les tests (ex. vider le cache après l'ajout d'une nouvelle ressource de traduction, avant un test fonctionnel)
- [ ] **B.** Pour remplacer entièrement PHPUnit
- [ ] **C.** Pour définir les routes de l'application
- [ ] **D.** Ce fichier ne peut pas être modifié

### Question 42

Que fait l'exemple de bootstrap personnalisé donné par la documentation, en plus de charger l'autoloader et l'environnement ? *(une seule bonne réponse)*

- [ ] **A.** Il exécute la commande `cache:clear --no-warmup` via `passthru()`, dans l'environnement défini par `APP_ENV`
- [ ] **B.** Il installe automatiquement les fixtures
- [ ] **C.** Il lance le serveur web de test
- [ ] **D.** Il configure la base de données de test

### Question 43

Si l'on n'utilise pas Symfony Flex, comment s'assurer que `tests/bootstrap.php` est bien exécuté avant les tests ? *(une seule bonne réponse)*

- [ ] **A.** En le configurant explicitement comme fichier bootstrap dans `phpunit.dist.xml` (attribut `bootstrap="tests/bootstrap.php"`)
- [ ] **B.** En le renommant `bootstrap_test.php`
- [ ] **C.** En l'incluant manuellement dans chaque classe de test
- [ ] **D.** Ce n'est pas possible sans Symfony Flex

### Question 44

Que crée Symfony Flex automatiquement lors de l'installation des paquets de test, en lien avec ce fichier ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier `tests/bootstrap.php` lui-même, déjà exécuté par PHPUnit avant les tests
- [ ] **B.** Un fichier `tests/teardown.php` symétrique
- [ ] **C.** Rien, il faut toujours le créer manuellement
- [ ] **D.** Un service `test.bootstrap` dans le container

## Annexe — Tester un repository Doctrine

### Question 45

Que recommande la documentation à propos des tests unitaires (avec mocks) de repositories Doctrine ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est **pas recommandé** : les repositories sont censés être testés contre une vraie connexion de base de données
- [ ] **B.** C'est la pratique à privilégier dans tous les cas
- [ ] **C.** Les repositories ne peuvent techniquement pas être mockés
- [ ] **D.** Cette approche est uniquement réservée aux tests de performance

### Question 46

Dans l'exemple de mock (`SalaryCalculatorTest`), quels objets sont mockés et comment s'enchaînent-ils ? *(une seule bonne réponse)*

- [ ] **A.** Un `EntityRepository` mocké est configuré pour retourner un `Employee` réel via `find()`, puis un `EntityManager` mocké est configuré pour retourner ce repository via `getRepository()` — les mocks sont construits « de l'intérieur vers l'extérieur »
- [ ] **B.** Seul l'`Employee` est mocké, le reste étant réel
- [ ] **C.** Le `SalaryCalculator` lui-même est mocké
- [ ] **D.** Un mock unique remplace à la fois le repository et l'entity manager

### Question 47

Comment un test fonctionnel de repository récupère-t-il l'entity manager pour interroger la **vraie** base de test ? *(une seule bonne réponse)*

- [ ] **A.** En étendant `KernelTestCase`, en appelant `self::bootKernel()`, puis en récupérant le service `doctrine` via le container pour appeler `getManager()`
- [ ] **B.** En instanciant directement `new EntityManager(...)`
- [ ] **C.** En mockant systématiquement le repository, comme pour les tests unitaires
- [ ] **D.** Via une commande console dédiée exécutée avant le test

### Question 48

Que recommande la documentation de faire dans le `tearDown()` d'un tel test fonctionnel, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `$this->entityManager->close()` puis le mettre à `null`, pour éviter les fuites mémoire
- [ ] **B.** Ne rien faire, PHPUnit nettoie automatiquement l'entity manager
- [ ] **C.** Recréer une nouvelle base de données à chaque `tearDown()`
- [ ] **D.** Appeler `$this->entityManager->rollback()`

### Question 49

Dans l'exemple de test unitaire avec mocks, pourquoi la classe testée (`SalaryCalculator`) peut-elle recevoir facilement un `EntityManager` mocké ? *(une seule bonne réponse)*

- [ ] **A.** Parce que l'entity manager est injecté via le constructeur de `SalaryCalculator`, ce qui permet de le remplacer par un mock dans le test
- [ ] **B.** Parce que `SalaryCalculator` étend `KernelTestCase`
- [ ] **C.** Parce que Doctrine génère automatiquement une classe de test pour chaque service
- [ ] **D.** Parce que le mock est injecté via une variable globale

## Annexe — Le DOM Crawler (dans le contexte des tests)

### Question 50

À quoi sert une instance de `Crawler`, retournée par le client à chaque requête ? *(une seule bonne réponse)*

- [ ] **A.** À parcourir un document HTML ou XML : sélectionner des nœuds, trouver des liens et formulaires, récupérer des attributs ou du contenu
- [ ] **B.** Uniquement à afficher le HTML brut de la réponse
- [ ] **C.** À exécuter du JavaScript sur la page
- [ ] **D.** À remplacer entièrement les assertions PHPUnit

### Question 51

Quelles méthodes de traversée du DOM sont mentionnées, façon jQuery ? *(plusieurs bonnes réponses)*

- [ ] **A.** `filter()` (sélecteur CSS) et `filterXpath()` (expression XPath)
- [ ] **B.** `siblings()`, `nextAll()`, `previousAll()` pour les nœuds de même niveau
- [ ] **C.** `ancestors()` pour les nœuds parents, `children()` pour les enfants directs
- [ ] **D.** Seule une méthode générique `find()` existe pour toute traversée

### Question 52

Que fait `reduce($lambda)` sur un `Crawler` ? *(une seule bonne réponse)*

- [ ] **A.** Elle filtre les nœuds à l'aide d'un callback, ne conservant que ceux pour lesquels il retourne `true`
- [ ] **B.** Elle réduit le nombre d'attributs de chaque nœud
- [ ] **C.** Elle fusionne plusieurs Crawlers en un seul
- [ ] **D.** Elle retourne un simple entier, le nombre de nœuds

### Question 53

Comment obtenir le nombre de nœuds contenus dans un `Crawler`, et comment extraire plusieurs attributs pour tous les nœuds sélectionnés ? *(une seule bonne réponse)*

- [ ] **A.** `count($crawler)` pour le nombre de nœuds ; `$crawler->extract(['_text', 'href'])` pour extraire un tableau de valeurs par nœud
- [ ] **B.** `$crawler->size()` et `$crawler->getAll()`
- [ ] **C.** Il faut itérer manuellement, aucune méthode d'extraction groupée n'existe
- [ ] **D.** `$crawler->length` et `$crawler->attributes()`

### Question 54

Que retourne `$crawler->text(null, true)` par rapport à `$crawler->text()` sans second argument ? *(une seule bonne réponse)*

- [ ] **A.** Le second argument `true` supprime tous les espaces superflus, y compris internes (ex. `"  foo\n  bar    baz \n "` devient `"foo bar baz"`)
- [ ] **B.** Il retourne le texte de tous les nœuds concaténés, au lieu du seul premier nœud
- [ ] **C.** Il retourne le HTML brut au lieu du texte
- [ ] **D.** Il n'a aucun effet supplémentaire

## Annexe — Tests de bout en bout (E2E)

### Question 55

Quel composant Symfony fournit les tests de bout en bout (E2E), et en quoi diffèrent-ils des tests applicatifs classiques ? *(une seule bonne réponse)*

- [ ] **A.** Panther — contrairement aux tests applicatifs, les tests E2E s'exécutent dans un **vrai navigateur** (headless en CI, ou avec interface graphique pour le debug)
- [ ] **B.** Le composant BrowserKit, identique aux tests applicatifs
- [ ] **C.** PHPUnit seul, sans composant supplémentaire
- [ ] **D.** Le DomCrawler, en mode navigateur simulé

### Question 56

Quelles fonctionnalités Panther propose-t-il, listées par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Capture d'écran à tout moment
- [ ] **B.** Exécution de JavaScript sur les pages
- [ ] **C.** Support complet de Chrome/Firefox
- [ ] **D.** Génération automatique de rapports de couverture de code

### Question 57

Comment installer les web drivers nécessaires à Panther, selon les méthodes présentées ? *(plusieurs bonnes réponses)*

- [ ] **A.** Via `dbrekelmans/browser-driver-installer` (`composer require --dev dbrekelmans/bdi` puis `vendor/bin/bdi detect drivers`)
- [ ] **B.** Via le gestionnaire de paquets du système (ex. `apt-get install chromium-chromedriver firefox-geckodriver` sur Ubuntu)
- [ ] **C.** Panther les télécharge automatiquement au premier lancement, sans configuration
- [ ] **D.** Uniquement en compilant les drivers depuis les sources

### Question 58

Quelles méthodes d'attente (« waiting methods ») le client Panther fournit-il pour synchroniser le test avec un contenu chargé dynamiquement ? *(plusieurs bonnes réponses)*

- [ ] **A.** `waitFor('.popin')` (attend l'apparition dans le DOM) et `waitForStaleness('.popin')` (attend sa suppression)
- [ ] **B.** `waitForVisibility()`/`waitForInvisibility()`
- [ ] **C.** `waitForElementToContain()` et `waitForAttributeToContain()`
- [ ] **D.** `sleep()` est la seule méthode recommandée pour attendre du contenu dynamique

### Question 59

Comment tester une application « temps réel » impliquant plusieurs clients simultanés (ex. un chat), avec Panther ? *(une seule bonne réponse)*

- [ ] **A.** En créant un client supplémentaire avec `createAdditionalPantherClient()`, en plus du client principal `createPantherClient()`
- [ ] **B.** Panther ne supporte qu'un seul client par test
- [ ] **C.** En dupliquant entièrement le test dans deux classes distinctes
- [ ] **D.** En utilisant deux processus PHP séparés, gérés manuellement

### Question 60

Quelles variables d'environnement Panther sont mentionnées pour son fonctionnement ? *(plusieurs bonnes réponses)*

- [ ] **A.** `PANTHER_NO_HEADLESS`, pour afficher la fenêtre du navigateur
- [ ] **B.** `PANTHER_WEB_SERVER_PORT`, pour changer le port du serveur (par défaut `9080`)
- [ ] **C.** `PANTHER_ERROR_SCREENSHOT_DIR`, pour indiquer où enregistrer les captures d'écran en cas d'échec
- [ ] **D.** `PANTHER_DEBUG`, pour activer le mode debug pas à pas

### Question 61

Comment activer le mode interactif pour déboguer visuellement un test Panther ? *(une seule bonne réponse)*

- [ ] **A.** `PANTHER_NO_HEADLESS=1 bin/phpunit --debug`
- [ ] **B.** `bin/phpunit --interactive`
- [ ] **C.** En ajoutant `$client->debug()` dans le test
- [ ] **D.** Le mode interactif n'existe pas pour Panther

### Question 62

Quelles limitations connues de Panther la documentation liste-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les documents XML ne sont pas supportés (HTML uniquement)
- [ ] **B.** Impossible de mettre à jour un document existant
- [ ] **C.** Pas de syntaxe de tableau PHP multidimensionnel pour les valeurs de formulaire
- [ ] **D.** Panther ne fonctionne que sur Linux

### Question 63

Pourquoi faut-il un fichier `tests/router.php` particulier avec AssetMapper en environnement de dev pour Panther ? *(une seule bonne réponse)*

- [ ] **A.** Pour résoudre un problème de chargement des assets, en routant correctement les requêtes vers le serveur web intégré de PHP utilisé par Panther
- [ ] **B.** Pour définir les routes de l'application testée
- [ ] **C.** Pour configurer la base de données de test
- [ ] **D.** Pour activer HTTPS sur le serveur de test

## Annexe — Interaction de plusieurs clients

### Question 64

Que se passe-t-il si on appelle `createClient()` une seconde fois alors qu'un kernel est déjà démarré, sans précaution particulière ? *(une seule bonne réponse)*

- [ ] **A.** Une `LogicException` est levée ; il faut appeler `self::ensureKernelShutdown()` avant de créer le client suivant
- [ ] **B.** Le second client remplace silencieusement le premier
- [ ] **C.** Les deux clients partagent automatiquement le même kernel sans conflit
- [ ] **D.** Rien de particulier ne se passe

### Question 65

Après avoir appelé `self::ensureKernelShutdown()`, le premier client créé (`$harry`) reste-t-il utilisable ? *(une seule bonne réponse)*

- [ ] **A.** Oui — l'arrêt du kernel ne rend pas les clients précédemment créés inutilisables, ils peuvent encore effectuer des requêtes après cet appel
- [ ] **B.** Non, il faut le recréer entièrement
- [ ] **C.** Il devient utilisable uniquement en lecture seule
- [ ] **D.** Il ne peut plus faire de requêtes GET, seulement POST

### Question 66

Dans quel cas de figure la simple création de plusieurs clients (avec `ensureKernelShutdown()` entre les deux) ne suffit-elle pas, nécessitant l'« insulation » ? *(une seule bonne réponse)*

- [ ] **A.** Quand le code maintient un état global, ou dépend d'une bibliothèque tierce ayant elle-même un état global
- [ ] **B.** Dès qu'il y a plus de deux clients dans le même test
- [ ] **C.** Uniquement lors de tests impliquant des fichiers uploadés
- [ ] **D.** Ce cas ne se présente jamais en pratique

### Question 67

Comment isoler un client, et où s'exécutent alors ses requêtes ? *(une seule bonne réponse)*

- [ ] **A.** Avec `$client->insulate()` : les requêtes s'exécutent alors dans un processus PHP dédié et propre, évitant tout effet de bord
- [ ] **B.** En appelant `$client->fork()`
- [ ] **C.** Les clients sont toujours isolés par défaut, `insulate()` n'a aucun effet
- [ ] **D.** En créant un conteneur Docker par client

### Question 68

Quels compromis/avertissements la documentation associe-t-elle à l'insulation d'un client ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un client isolé est plus lent — on peut donc garder un client dans le processus principal et n'isoler que les autres
- [ ] **B.** L'insulation nécessite de la sérialisation/désérialisation ; des données non sérialisables (ex. flux de fichier avec `UploadedFile`) provoquent une exception, la seule solution étant de désactiver l'insulation pour ces tests
- [ ] **C.** Un client isolé ne peut plus jamais recevoir de réponse HTTP valide
- [ ] **D.** L'insulation est incompatible avec les assertions de réponse Symfony

## Annexe — Utiliser le profiler dans un test fonctionnel

### Question 69

Le profiler est-il actif dans l'environnement `test` par défaut, et si oui avec quel comportement particulier ? *(une seule bonne réponse)*

- [ ] **A.** Il reste activé (`enabled: true`), mais la **collecte** de données est désactivée par défaut (`collect: false`), car cela peut ralentir significativement les tests
- [ ] **B.** Il est totalement désactivé par défaut en environnement `test`
- [ ] **C.** Il collecte toujours toutes les données, sans option de désactivation
- [ ] **D.** Il n'existe pas de configuration spécifique à l'environnement `test` pour le profiler

### Question 70

Comment activer la collecte du profiler pour un seul test précis, sans changer la configuration globale ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$client->enableProfiler()` avant la requête à profiler dans ce test
- [ ] **B.** En mettant `collect: true` globalement, uniquement pour ce fichier de test
- [ ] **C.** Ce n'est pas possible, la config s'applique à tous les tests
- [ ] **D.** En passant une option `profile: true` à `createClient()`

### Question 71

Que fait précisément `$client->enableProfiler()`, et que faut-il pour que cela fonctionne vraiment ? *(une seule bonne réponse)*

- [ ] **A.** Elle active la collecte de données pour le client de test courant, mais seulement si le profiler lui-même est déjà activé via la configuration — sinon elle n'a aucun effet
- [ ] **B.** Elle active le profiler entier de l'application, pour tous les environnements
- [ ] **C.** Elle ne fonctionne qu'en environnement `dev`
- [ ] **D.** Il faut l'appeler après la requête, pas avant

### Question 72

Comment vérifier, par exemple, le nombre de requêtes SQL exécutées pendant une requête de test ? *(une seule bonne réponse)*

- [ ] **A.** Via `$profile->getCollector('db')->getQueryCount()`, `$profile` étant obtenu par `$client->getProfile()`
- [ ] **B.** En comptant manuellement les logs SQL
- [ ] **C.** Le nombre de requêtes SQL n'est pas accessible depuis un test
- [ ] **D.** Via `$client->getResponse()->getQueryCount()`

### Question 73

Les informations du profiler restent-elles disponibles si le client est « insulated » ou utilise une couche HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Oui : « The profiler information is available even if you insulate the client or if you use an HTTP layer for your tests »
- [ ] **B.** Non, l'insulation désactive systématiquement le profiler
- [ ] **C.** Uniquement pour les clients non isolés
- [ ] **D.** Uniquement pour les requêtes GET

## Annexe — Le composant DomCrawler

### Question 74

Que fait automatiquement le DomCrawler quand le HTML fourni ne respecte pas la spécification (ex. un `<p>` imbriqué dans un autre `<p>`) ? *(une seule bonne réponse)*

- [ ] **A.** Il tente de corriger automatiquement le HTML pour respecter la spécification officielle (ex. déplacer le `<p>` imbriqué au même niveau que son parent, conformément à HTML5)
- [ ] **B.** Il lève systématiquement une exception
- [ ] **C.** Il ignore silencieusement le nœud invalide
- [ ] **D.** Il conserve le HTML tel quel, sans aucune correction

### Question 75

Comment filtrer un `Crawler` avec des sélecteurs CSS plutôt qu'avec des expressions XPath, et quel composant faut-il installer pour cela ? *(une seule bonne réponse)*

- [ ] **A.** Avec la méthode `filter()`, qui nécessite le composant CssSelector installé
- [ ] **B.** `filter()` fonctionne nativement sans dépendance supplémentaire, contrairement à `filterXPath()`
- [ ] **C.** Les sélecteurs CSS ne sont pas supportés par le DomCrawler
- [ ] **D.** Il faut utiliser `filterCss()`, une méthode distincte de `filter()`

### Question 76

Quelle méthode vérifie si le nœud courant correspond à un sélecteur donné, sans le filtrer ? *(une seule bonne réponse)*

- [ ] **A.** `$crawler->matches('p.lorem')`
- [ ] **B.** `$crawler->is('p.lorem')`
- [ ] **C.** `$crawler->test('p.lorem')`
- [ ] **D.** `$crawler->contains('p.lorem')`

### Question 77

Que fait `closest()`, par opposition à `ancestors()` ? *(une seule bonne réponse)*

- [ ] **A.** `closest()` retourne le **premier** parent (en remontant vers la racine du document) qui correspond au sélecteur fourni, alors qu'`ancestors()` retourne tous les ancêtres sans filtre
- [ ] **B.** Les deux méthodes sont strictement équivalentes
- [ ] **C.** `closest()` ne fonctionne que sur les enfants directs
- [ ] **D.** `closest()` retourne toujours le nœud `<html>` racine

### Question 78

Quelle est la différence entre `text()` et `innerText()` sur un nœud comme `<p>Foo <span>Bar</span></p>` ? *(une seule bonne réponse)*

- [ ] **A.** `text()` retourne tout le texte y compris celui des enfants (« Foo Bar ») ; `innerText()` ne retourne que le texte directement descendant du nœud courant, en excluant celui des enfants (« Foo »)
- [ ] **B.** Les deux méthodes retournent exactement le même résultat
- [ ] **C.** `innerText()` retourne le HTML, pas du texte brut
- [ ] **D.** `text()` ignore le contenu des balises `<span>`, `innerText()` l'inclut

### Question 79

Que représentent les attributs spéciaux `_text` et `_name` utilisés avec la méthode `extract()` ? *(une seule bonne réponse)*

- [ ] **A.** `_text` représente la valeur du nœud, `_name` représente le nom de l'élément (le tag HTML)
- [ ] **B.** `_text` est le nom du tag, `_name` est sa valeur
- [ ] **C.** Ce sont des attributs HTML personnalisés à ajouter soi-même
- [ ] **D.** Ils ne fonctionnent qu'avec des documents XML

### Question 80

Quel piège la documentation signale-t-elle lors de l'usage de `filterXPath()` à l'intérieur d'un `each()` sur un « nested crawler » ? *(une seule bonne réponse)*

- [ ] **A.** L'expression XPath est évaluée dans le contexte du crawler courant : chercher directement `sub-tag/sub-child-tag` échoue pour un enfant direct, il faut préciser aussi le tag parent (ou utiliser `node()/...`)
- [ ] **B.** `filterXPath()` ne peut jamais être appelée dans un `each()`
- [ ] **C.** Ce piège n'existe qu'avec `filter()` (CSS), jamais avec `filterXPath()`
- [ ] **D.** Il faut toujours convertir le crawler imbriqué en tableau avant de le filtrer

### Question 81

Quelles méthodes permettent d'ajouter du contenu à un Crawler, et sont-elles cumulables ? *(une seule bonne réponse)*

- [ ] **A.** `addHtmlContent()`, `addXmlContent()`, `addContent()`, `add()` — mais elles sont **mutuellement exclusives** : on ne peut utiliser qu'une seule de ces façons pour ajouter du contenu
- [ ] **B.** Elles peuvent toutes être appelées successivement pour cumuler plusieurs documents
- [ ] **C.** Une seule méthode `add()` existe, les autres sont dépréciées
- [ ] **D.** Le Crawler ne peut être peuplé qu'au constructeur, jamais après coup

### Question 82

Que retourne `evaluate()` selon le type de résultat de l'expression XPath ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau de résultats si l'expression retourne une valeur scalaire (ex. un attribut) ; une nouvelle instance de `Crawler` si l'expression retourne un document DOM
- [ ] **B.** Toujours un tableau, quel que soit le type de résultat
- [ ] **C.** Toujours une nouvelle instance de `Crawler`
- [ ] **D.** Une chaîne JSON représentant le résultat

### Question 83

Comment récupérer l'objet `Form` associé à un bouton de soumission repéré dans le HTML, et que fait précisément `getUri()` sur ce formulaire si sa méthode est `GET` ? *(une seule bonne réponse)*

- [ ] **A.** Via `$crawler->selectButton('...')->form()` ; si la méthode est `GET`, `getUri()` imite le comportement du navigateur en retournant l'attribut `action` suivi d'une chaîne de requête construite à partir de toutes les valeurs du formulaire
- [ ] **B.** Via `$crawler->filter('form')->submit()`
- [ ] **C.** `getUri()` retourne toujours strictement l'attribut `action`, sans les valeurs du formulaire
- [ ] **D.** `selectButton()` ne fonctionne que sur des `<input type="submit">`, jamais sur des `<button>`

### Question 84

Comment gérer des champs de formulaire multidimensionnels (ex. `multi[dimensional][]`) avec `setValues()` ? *(une seule bonne réponse)*

- [ ] **A.** En passant un tableau imbriqué reproduisant la structure des noms de champs, ex. `$form->setValues(['multi' => ['dimensional' => [1, 3]]])` pour cocher certaines cases à cocher multidimensionnelles
- [ ] **B.** Ce n'est pas supporté, seuls les champs à un seul niveau fonctionnent
- [ ] **C.** Il faut appeler `setValues()` séparément pour chaque champ, un par un, sans tableau imbriqué
- [ ] **D.** Uniquement possible via `getPhpValues()`, jamais via `setValues()`

### Question 85

Comment désactiver la validation interne d'un champ `select`/`radio` pour pouvoir y assigner une valeur invalide ? *(une seule bonne réponse)*

- [ ] **A.** `$form['country']->disableValidation()->select('Invalid value')` (ou `$form->disableValidation()` pour tout le formulaire)
- [ ] **B.** Les champs `select`/`radio` n'ont aucune validation interne, toute valeur est acceptée nativement
- [ ] **C.** En modifiant directement le DOM avant de sélectionner le champ
- [ ] **D.** Ce n'est possible qu'en passant par `getPhpValues()`

### Question 86

À quoi sert la classe `UriResolver`, illustrée par `UriResolver::resolve('/foo', 'http://localhost/bar/foo/')` ? *(une seule bonne réponse)*

- [ ] **A.** À transformer une URI (relative, absolue, fragment…) en URI **absolue**, résolue par rapport à une URI de base donnée
- [ ] **B.** À valider qu'une URI est bien formée
- [ ] **C.** À raccourcir une URI longue en URI courte
- [ ] **D.** À extraire les paramètres de requête d'une URI

## Annexe — Le composant CssSelector

### Question 87

Quel est l'unique objectif du composant CssSelector ? *(une seule bonne réponse)*

- [ ] **A.** Convertir des sélecteurs CSS en expressions XPath équivalentes, via `CssSelectorConverter::toXPath()`
- [ ] **B.** Exécuter directement des sélecteurs CSS sur un document DOM
- [ ] **C.** Générer du CSS à partir de XPath
- [ ] **D.** Valider la syntaxe d'un sélecteur CSS

### Question 88

Pourquoi préférer les sélecteurs CSS à XPath selon l'introduction de cette page, tout en reconnaissant leurs limites ? *(une seule bonne réponse)*

- [ ] **A.** XPath est plus flexible/puissant mais complexe à apprendre et à écrire ; les sélecteurs CSS, plus familiers (feuilles de style, `querySelectorAll()`, jQuery), sont plus simples à lire/écrire, bien que moins puissants
- [ ] **B.** Les sélecteurs CSS sont strictement plus puissants que XPath dans tous les cas
- [ ] **C.** XPath n'est utilisable que dans un navigateur, contrairement au CSS
- [ ] **D.** Il n'y a aucune différence pratique entre les deux approches

### Question 89

Quelle méthode du composant `Crawler` utilise en interne le composant CssSelector ? *(une seule bonne réponse)*

- [ ] **A.** `filter()`
- [ ] **B.** `filterXPath()`
- [ ] **C.** `evaluate()`
- [ ] **D.** `extract()`

### Question 90

Parmi les sélecteurs CSS liés à l'état du navigateur, lesquels la documentation dit-elle **non supportés** par le composant, car ils n'ont de sens que dans le contexte d'un navigateur ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les sélecteurs d'état de lien : `:link`, `:visited`, `:target`
- [ ] **B.** Les sélecteurs basés sur une action utilisateur : `:hover`, `:focus`, `:active`
- [ ] **C.** Les sélecteurs d'état d'interface : `:invalid`, `:indeterminate`
- [ ] **D.** `:enabled`, `:disabled` et `:checked`, qui ne sont pas non plus supportés

### Question 91

Que dit la documentation sur le support des pseudo-éléments (`:before`, `:after`, `:first-line`, `:first-letter`) ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne sont pas supportés, car ils sélectionnent des portions de texte plutôt que des éléments
- [ ] **B.** Ils sont pleinement supportés, comme tout autre sélecteur
- [ ] **C.** Seul `:before` est supporté
- [ ] **D.** Ils sont convertis en commentaires XPath

### Question 92

Parmi les pseudo-classes suivantes, lesquelles sont explicitement listées comme **non supportées** avec le sélecteur universel `*` (ex. `*:first-of-type`), tout en fonctionnant avec un nom d'élément (ex. `li:first-of-type`) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `*:first-of-type` et `*:last-of-type`
- [ ] **B.** `*:nth-of-type` et `*:nth-last-of-type`
- [ ] **C.** `*:only-of-type` et `*:scope`
- [ ] **D.** `*:is` et `*:where`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Testing de la documentation Symfony 8.0](https://symfony.com/doc/8.0/testing.html). Pour les questions 41 à 92, le nom abrégé de la page annexe précède la section — *(Bootstrap — § …)*, *(Database — § …)*, *(DOM Crawler (testing) — § …)*, *(E2E — § …)*, *(Insulating Clients — § …)*, *(Profiling — § …)*, *(DomCrawler — § …)*, *(CssSelector — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : A** — « Unit Tests - These tests ensure that individual units of source code […] behave as intended. » ; « Integration Tests […] commonly interact with Symfony's service container. These tests do not yet cover the fully working application, those are called Application tests. » ; « Application Tests (also known as functional tests) test the behavior of a complete application. » *(§ Types of Tests)*

**Question 2 : A** — « install symfony/test-pack, which installs some other packages needed for testing (such as phpunit/phpunit): $ composer require --dev symfony/test-pack ». *(§ Installation)*

**Question 3 : A, B, C** — « Symfony Flex automatically creates phpunit.dist.xml and tests/bootstrap.php. If these files are missing, you can try running the recipe again using composer recipes:install phpunit/phpunit --force -v » ; « in PHPUnit versions older than 10, the file is named phpunit.xml.dist ». *(§ Installation)*

**Question 4 : A** — « Each test is a PHP class ending with "Test" (e.g. BlogControllerTest) that lives in the tests/ directory » ; « the tests/ directory should replicate the directory of your application for unit tests. So, if you're testing a class in the src/Form/ directory, put the test in the tests/Form/ directory. » *(§ Installation, § Unit Tests)*

**Question 5 : A** — « Writing unit tests in a Symfony application is no different from writing standard PHPUnit unit tests. » *(§ Unit Tests)*

**Question 6 : A, B, C** — « $ php bin/phpunit [# run all tests] […] $ php bin/phpunit tests/Form [# run all tests in the Form/ directory] […] $ php bin/phpunit tests/Form/UserTypeTest.php [# run tests for the UserType class] ». *(§ Unit Tests)*

**Question 7 : A** — « Symfony provides a KernelTestCase class to help you create and boot the kernel in your tests using bootKernel() […] The KernelTestCase also makes sure your kernel is rebooted for each test. This assures that each test is run independently from each other. » *(§ Integration Tests)*

**Question 8 : A** — « The kernel class is usually defined in the KERNEL_CLASS environment variable […] you can also override the getKernelClass() or createKernel() methods […] which takes precedence over the KERNEL_CLASS env var. » *(§ Integration Tests)*

**Question 9 : A** — « The tests create a kernel that runs in the test environment. This allows you to have special settings for your tests inside config/packages/test/ or using the when@test key. » (exemple `twig: when@test: strict_variables: true`). *(§ Set-up your Test Environment)*

**Question 10 : A** — « you can also use a different environment entirely, or override the default debug mode […] by passing each as options to the bootKernel() method » ; « It is recommended to run your test with debug set to false on your CI server, as it significantly improves test performance. This disables clearing the cache. » *(§ Set-up your Test Environment)*

**Question 11 : A** — « In the test environment, these env files are read (if vars are duplicated in them, files lower in the list override previous items): 1. .env […] 2. .env.test […] 3. .env.test.local […] Warning: The .env.local file is not used in the test environment, to make each test set-up as consistent as possible. » *(§ Customizing Environment Variables)*

**Question 12 : A** — « After booting the kernel, the container is returned by static::getContainer(). […] The container from static::getContainer() is actually a special test container. It gives you access to both the public services and the non-removed private services. » *(§ Retrieving Services in the Test)*

**Question 13 : A** — « If you need to test private services that have been removed […] you need to declare those private services as public in the config/services_test.yaml file. » *(§ Retrieving Services in the Test)*

**Question 14 : A** — Exemple : `$newsRepository = $this->createMock(NewsRepositoryInterface::class); … $container->set(NewsRepositoryInterface::class, $newsRepository);` ; « No further configuration is required, as the test service container is a special one that allows you to interact with private services and aliases. » *(§ Mocking Dependencies)*

**Question 15 : A** — « edit or create the .env.test.local file […] and define the new value for the DATABASE_URL env var […] This assumes that each developer/machine uses a different database for the tests. If the test set-up is the same on each machine, use the .env.test file instead and commit it. » *(§ Configuring a Database for Tests)*

**Question 16 : A** — « $ php bin/console --env=test doctrine:database:create […] $ php bin/console --env=test doctrine:schema:create ». *(§ Configuring a Database for Tests)*

**Question 17 : A** — « The DAMADoctrineTestBundle uses Doctrine transactions to let each test interact with an unmodified database. […] it begins a database transaction before every test and rolls it back automatically after the test finishes to undo all changes. » *(§ Resetting the Database Automatically Before each Test)*

**Question 18 : A** — « <bootstrap class="DAMA\DoctrineTestBundle\PHPUnit\PHPUnitExtension"/> <!-- use this with PHPUnit 10 or newer --> […] <extension class="DAMA\DoctrineTestBundle\PHPUnit\PHPUnitExtension"/> <!-- use this with legacy PHPUnit versions older than 10 --> ». *(§ Resetting the Database Automatically Before each Test)*

**Question 19 : A** — « composer require --dev doctrine/doctrine-fixtures-bundle […] use the make:fixtures command […] to generate an empty fixture class » ; exemple `class ProductFixture extends Fixture { public function load(ObjectManager $manager): void { ... } }`. *(§ Load Test Data Fixtures)*

**Question 20 : A** — « Empty the database and reload all the fixture classes with: $ php bin/console --env=test doctrine:fixtures:load ». *(§ Load Test Data Fixtures)*

**Question 21 : A** — « 1. Make a request; 2. Interact with the page (e.g. click on a link or submit a form); 3. Test the response; 4. Rinse and repeat. » *(§ Application Tests)*

**Question 22 : A** — « Application tests are PHP files that typically live in the tests/Controller/ directory […] They often extend WebTestCase. This class adds special logic on top of the KernelTestCase. » *(§ Write Your First Application Test)*

**Question 23 : A** — « This calls KernelTestCase::bootKernel(), and creates a "client" that is acting as the browser […] $crawler = $client->request('GET', '/'); ». *(§ Write Your First Application Test)*

**Question 24 : A** — « Tip: Hardcoding the request URLs is a best practice for application tests. If the test generates URLs using the Symfony router, it won't detect any change made to the application URLs which may impact the end users. » *(§ Making Requests)*

**Question 25 : A** — « After making a request, subsequent requests will make the client reboot the kernel. This recreates the container from scratch to ensures that requests are isolated […] for example, the security token will be cleared, Doctrine entities will be detached, etc. » *(§ Multiple Requests in One Test)*

**Question 26 : A** — « you can call the client's disableReboot() method to reset the kernel instead of rebooting it. In practice, Symfony will call the reset() method of every service tagged with kernel.reset. However, this will also clear the security token, detach Doctrine entities, etc. » *(§ Multiple Requests in One Test)*

**Question 27 : A** — « create a compiler pass to remove the kernel.reset tag from some services in your test environment » : `$container->getDefinition('security.token_storage')->clearTag('kernel.reset');` etc. *(§ Multiple Requests in One Test)*

**Question 28 : A, B, C** — « $client->back(); $client->forward(); $client->reload(); // clears all cookies and the history $client->restart(); ». D est faux : « Note: The back() and forward() methods skip the redirects that may have occurred when requesting a URL, as normal browsers do. » *(§ Browsing the Site)*

**Question 29 : A, B, C** — « the client does not follow it automatically. You can […] force a redirection afterwards with the followRedirect() method » ; « If you want the client to automatically follow all redirects, you can force them by calling the followRedirects() method » ; « If you pass false to the followRedirects() method, the redirects will no longer be followed ». *(§ Redirecting)*

**Question 30 : A** — « Symfony provides a loginUser() method to simulate logging in your functional tests. […] it's recommended to create a user only for tests. You can do that with Doctrine data fixtures ». *(§ Logging in Users (Authentication))*

**Question 31 : A, B, C** — « You can pass any UserInterface instance to loginUser() » et l'exemple avec `InMemoryUser` (à déclarer dans `when@test: security: providers: users_in_memory: memory: ...`) ; « This method creates a special TestBrowserToken object and stores in the session of the test client » ; « To set a specific firewall (main is set by default): $client->loginUser($testUser, 'my_firewall'); ». D est faux : « By design, the loginUser() method doesn't work when using stateless firewalls. » *(§ Logging in Users (Authentication))*

**Question 32 : A** — « The client provides a getSession() method, which allows you to set up the session before performing the request » (exemple `$session->set('_csrf/form', ...); $session->save();`). *(§ Setup the session)*

**Question 33 : A** — « The client provides an xmlHttpRequest() method […] the required HTTP_X_REQUESTED_WITH header is added automatically ». *(§ Making AJAX Requests)*

**Question 34 : A** — « The name of your custom headers must follow the syntax defined in the section 4.1.18 of RFC 3875: replace - by _, transform it into uppercase and prefix the result with HTTP_. For example, if your header name is X-Session-Token, pass HTTP_X_SESSION_TOKEN. » *(§ Sending Custom HTTP Headers)*

**Question 35 : A** — « Disabling catching of exceptions in the test client allows the exception to be reported by PHPUnit: $client->catchExceptions(false); ». *(§ Reporting Exceptions)*

**Question 36 : A** — « // enables the profiler for the very next request $client->enableProfiler(); […] if ($profile = $client->getProfile()) { ... } ». *(§ Accessing the Profiler Data)*

**Question 37 : A, B, C** — « Use the clickLink() method to click on the first link that contains the given text (or the first clickable image with that alt attribute) » ; « Use the submitForm() method to submit the form that contains the given button » ; « Notice that you select form buttons and not forms, as a form can have several buttons. » D est faux : `Crawler::selectButton()->form()` donne bien accès à l'objet `Form`. *(§ Clicking on Links, § Submitting Forms)*

**Question 38 : A** — « // selects an option or a radio $form[...]->select(...); // ticks a checkbox $form[...]->tick(); // uploads a file $form[...]->upload(...); // In the case of a multiple file upload $form['my_form[field][0]']->upload(...); $form['my_form[field][1]']->upload(...); ». *(§ Submitting Forms)*

**Question 39 : A** — « To use these assertions, your test class must extend WebTestCase, use BrowserKitAssertionsTrait or WebTestAssertionsTrait. […] assertResponseIsUnprocessable(...) - Asserts the response is unprocessable (HTTP status is 422) ». *(§ Response Assertions)*

**Question 40 : A** — « To use these assertions, your test class must extend KernelTestCase, or use MailerAssertionsTrait. […] assertEmailAddressContains(...) […] This assertion normalizes addresses like Jane Smith <jane@example.com> into jane@example.com. » *(§ Mailer Assertions)*

**Question 41 : A** — « Sometimes when running tests, you need to do additional bootstrap work before running those tests. For example, if you're running a functional test and have introduced a new translation resource, then you will need to clear your cache before running those tests. » *(Bootstrap — introduction)*

**Question 42 : A** — « // executes the "php bin/console cache:clear" command passthru(sprintf('APP_ENV=%s php ".../bin/console" cache:clear --no-warmup', $_ENV['APP_ENV'], __DIR__)); ». *(Bootstrap)*

**Question 43 : A** — « If you don't use Symfony Flex, make sure this file is configured as bootstrap file in your phpunit.dist.xml file: <phpunit bootstrap="tests/bootstrap.php"> ». *(Bootstrap — § Note)*

**Question 44 : A** — « When installing testing using Symfony Flex, it already created a tests/bootstrap.php file that is run by PHPUnit before your tests. » *(Bootstrap)*

**Question 45 : A** — « Unit testing Doctrine repositories is not recommended. Repositories are meant to be tested against a real database connection. » *(Database — § Mocking a Doctrine Repository in Unit Tests)*

**Question 46 : A** — « you are building the mocks from the inside out, first creating the employee which gets returned by the Repository, which itself gets returned by the EntityManager. » *(Database — § Mocking a Doctrine Repository in Unit Tests)*

**Question 47 : A** — Exemple `ProductRepositoryTest extends KernelTestCase` : `$kernel = self::bootKernel();` puis `$kernel->getContainer()->get('doctrine')->getManager();`. *(Database — § Functional Testing of a Doctrine Repository)*

**Question 48 : A** — « // doing this is recommended to avoid memory leaks $this->entityManager->close(); $this->entityManager = null; ». *(Database — § Functional Testing of a Doctrine Repository)*

**Question 49 : A** — « Since the EntityManagerInterface gets injected into the class through the constructor, you can pass a mock object within a test ». *(Database — § Mocking a Doctrine Repository in Unit Tests)*

**Question 50 : A** — « A Crawler instance is returned each time you make a request with the Client. It allows you to traverse HTML or XML documents: select nodes, find links and forms, and retrieve attributes or contents. » *(DOM Crawler (testing) — introduction)*

**Question 51 : A, B, C** — « filter('h1.title') […] filterXpath('h1') […] siblings() […] nextAll() […] previousAll() […] ancestors() […] children() ». *(DOM Crawler (testing) — § Traversing)*

**Question 52 : A** — « reduce($lambda) Filters the nodes using a callback; keeps only those for which it returns true. » *(DOM Crawler (testing) — § Traversing)*

**Question 53 : A** — « Tip: Use the count() function to get the number of nodes stored in a Crawler: count($crawler) » ; « $info = $crawler->extract(['_text', 'href']); ». *(DOM Crawler (testing) — § Traversing, § Extracting Information)*

**Question 54 : A** — « pass TRUE as the second argument of text() to remove all extra white spaces, including the internal ones (e.g. "  foo\n  bar    baz \n " is returned as "foo bar baz") ». *(DOM Crawler (testing) — § Extracting Information)*

**Question 55 : A** — « Symfony provides Panther, a component for running end-to-end tests » ; « these tests run in a real browser that can operate in headless mode for CI environments or with a graphical interface for debugging. » *(E2E — § Overview)*

**Question 56 : A, B, C** — « Screenshot capturing at any point; JavaScript execution on pages; Full Chrome/Firefox support; Simplified testing of real-time applications ». La génération de rapports de couverture (D) n'est pas listée. *(E2E — § Overview)*

**Question 57 : A, B** — « Use dbrekelmans/browser-driver-installer: composer require --dev dbrekelmans/bdi […] Or install via your system's package manager: # Ubuntu apt-get install chromium-chromedriver firefox-geckodriver ». *(E2E — § Installing Web Drivers)*

**Question 58 : A, B, C** — « $client->waitFor('.popin'); […] $client->waitForStaleness('.popin'); […] $client->waitForVisibility('.loader'); $client->waitForInvisibility('.loader'); $client->waitForElementToContain('.total', '25 €'); $client->waitForAttributeToContain(...); ». *(E2E — § Waiting Methods)*

**Question 59 : A** — « $client2 = self::createAdditionalPantherClient(); » dans l'exemple `ChatTest`, en plus de `$client1 = self::createPantherClient();`. *(E2E — § Testing Real-Time Applications)*

**Question 60 : A, B, C** — « PANTHER_NO_HEADLESS - Display browser window […] PANTHER_WEB_SERVER_PORT - Port (default 9080) […] PANTHER_ERROR_SCREENSHOT_DIR - Screenshot directory for failures ». *(E2E — § Environment Variables)*

**Question 61 : A** — « Enable debugging with: $ PANTHER_NO_HEADLESS=1 bin/phpunit --debug ». *(E2E — § Interactive Mode)*

**Question 62 : A, B, C** — « XML documents not supported (HTML only); Cannot update existing documents; No multidimensional PHP array syntax for form values ». *(E2E — § Known Limitations)*

**Question 63 : A** — Section « Asset Loading Issue » : « When using AssetMapper in dev environment, create tests/router.php » puis configuration `PANTHER_WEB_SERVER_ROUTER` dans `phpunit.dist.xml`. *(E2E — § Asset Loading Issue)*

**Question 64 : A** — « Creating another client while a kernel is still running triggers a LogicException. Call self::ensureKernelShutdown() before creating the next client. » *(Insulating Clients — introduction)*

**Question 65 : A** — « Shutting down the kernel does not make previously created clients unusable. Existing clients (like $harry in the above example) can still perform requests after the call. » *(Insulating Clients — introduction)*

**Question 66 : A** — « This works except when your code maintains a global state or if it depends on a third-party library that has some kind of global state. In such a case, you can insulate your clients. » *(Insulating Clients — § Insulating Clients)*

**Question 67 : A** — « $harry->insulate(); […] Insulated clients transparently run their requests in a dedicated and clean PHP process, thus avoiding any side effects. » *(Insulating Clients — § Insulating Clients)*

**Question 68 : A, B** — « Tip: As an insulated client is slower, you can keep one client in the main process, and insulate the other ones. » ; « Warning: Insulating tests requires some serializing and unserializing operations. If your test includes data that can't be serialized, such as file streams when using the UploadedFile class, you'll see an exception […] the only solution is to disable insulation for those tests. » *(Insulating Clients — § Insulating Clients)*

**Question 69 : A** — « Symfony keeps the profiler enabled but disables data collection by default in the test environment: framework: profiler: { enabled: true, collect: false } ». *(Profiling — § Enabling the Profiler in Tests)*

**Question 70 : A** — « if you only need profiler data in a few specific tests, you can keep collection disabled globally and enable it selectively by calling $client->enableProfiler() in those tests. » *(Profiling — § Enabling the Profiler in Tests)*

**Question 71 : A** — « Note that calling enableProfiler() does not enable the profiler itself, which must already be enabled via configuration. It only enables data collection for the current test client. » *(Profiling — § Enabling the Profiler in Tests)*

**Question 72 : A** — « $this->assertLessThan(10, $profile->getCollector('db')->getQueryCount()); ». *(Profiling — § Testing the Profiler Information)*

**Question 73 : A** — « Note: The profiler information is available even if you insulate the client or if you use an HTTP layer for your tests. » *(Profiling — § Testing the Profiler Information)*

**Question 74 : A** — « The DomCrawler will attempt to automatically fix your HTML to match the official specification. For example, if you nest a <p> tag inside another <p> tag, it will be moved to be a sibling of the parent tag. This is expected and is part of the HTML5 spec. » *(DomCrawler — § Usage)*

**Question 75 : A** — « If you prefer CSS selectors over XPath, install The CssSelector Component. It allows you to use jQuery-like selectors: $crawler = $crawler->filter('body > p'); ». *(DomCrawler — § CSS Selectors)*

**Question 76 : A** — « Verify if the current node matches a selector: $crawler->matches('p.lorem'); ». *(DomCrawler — § Matching a Selector)*

**Question 77 : A** — « Get the first parent (heading toward the document root) of the element that matches the provided selector: $crawler->closest('p.lorem'); » (par opposition à `ancestors()`, sans filtre). *(DomCrawler — § Node Traversing)*

**Question 78 : A** — « innerText() is similar to text() but returns only text that is a direct descendant of the current node, excluding text from child nodes […] if content is <p>Foo <span>Bar</span></p> […] innerText() returns 'Foo' […] and text() returns 'Foo Bar' ». *(DomCrawler — § Text Content)*

**Question 79 : A** — « Note: Special attribute _text represents a node value, while _name represents the element name (the HTML tag name). » *(DomCrawler — § Extract Multiple Values)*

**Question 80 : A** — « When using nested crawler, beware that filterXPath() is evaluated in the context of the crawler […] DON'T DO THIS: direct child can not be found […] DO THIS: specify the parent tag too […] $subCrawler = $parentCrawler->filterXPath('parent/sub-tag/sub-child-tag'); ». *(DomCrawler — § Nested Crawler Context)*

**Question 81 : A** — « The crawler supports multiple ways of adding the content, but they are mutually exclusive, so you can only use one of them to add content: addHtmlContent(), addXmlContent(), addContent(), add() ». *(DomCrawler — § Adding the Content)*

**Question 82 : A** — « The evaluate() method evaluates the given XPath expression. […] If the expression evaluates to a scalar value […] an array of results will be returned. If the expression evaluates to a DOM document, a new Crawler instance will be returned. » *(DomCrawler — § Expression Evaluation)*

**Question 83 : A** — « $form = $crawler->selectButton('My super button')->form(); » ; « The getUri() method does more than just return the action attribute of the form. If the form method is GET, then it mimics the browser's behavior and returns the action attribute followed by a query string of all of the form's values. » *(DomCrawler — § Forms, § Form Methods)*

**Question 84 : A** — « // tick multiple checkboxes at once $form->setValues(['multi' => ['dimensional' => [1, 3] // it uses the input value to determine which checkbox to tick ]]); ». *(DomCrawler — § Multi-Dimensional Fields)*

**Question 85 : A** — « By default, choice fields (select, radio) have internal validation activated to prevent you from setting invalid values. If you want to be able to set invalid values, you can use the disableValidation() method on either the whole form or specific field(s). » *(DomCrawler — § Selecting Invalid Choice Values)*

**Question 86 : A** — « The UriResolver class takes a URI (relative, absolute, fragment, etc.) and turns it into an absolute URI against another given base URI: UriResolver::resolve('/foo', 'http://localhost/bar/foo/'); // http://localhost/foo ». *(DomCrawler — § Resolving a URI)*

**Question 87 : A** — « The CssSelector component converts CSS selectors to XPath expressions. […] The component's only goal is to convert CSS selectors to their XPath equivalents, using toXPath(). » *(CssSelector — introduction)*

**Question 88 : A** — « XPath expressions are incredibly flexible […] Unfortunately, they can also become very complicated, and the learning curve is steep. […] Many developers […] are more comfortable using CSS selectors […] CSS selectors are less powerful than XPath, but far easier to write, read and understand. » *(CssSelector — § Why Use CSS selectors?)*

**Question 89 : A** — « Tip: The Crawler::filter() method uses the CssSelector component to find elements based on a CSS selector string. » *(CssSelector — § The CssSelector Component)*

**Question 90 : A, B, C** — « link-state selectors: :link, :visited, :target — selectors based on user action: :hover, :focus, :active — UI-state selectors: :invalid, :indeterminate (however, :enabled, :disabled, :checked and :unchecked are available) ». D est donc faux : ces quatre-là sont disponibles. *(CssSelector — § Limitations of the CssSelector Component)*

**Question 91 : A** — « Pseudo-elements (:before, :after, :first-line, :first-letter) are not supported because they select portions of text rather than elements. » *(CssSelector — § Limitations of the CssSelector Component)*

**Question 92 : A, B** — « Not supported: *:first-of-type, *:last-of-type, *:nth-of-type and *:nth-last-of-type (all these work with an element name (e.g. li:first-of-type) but not with the * selector). » ; « Supported: *:only-of-type, *:scope, *:is and *:where. » *(CssSelector — § Limitations of the CssSelector Component)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/testing.html#learn-more) de la page :

- [How to Customize the Bootstrap Process before Running Tests](https://symfony.com/doc/8.0/testing/bootstrap.html) — questions 41 à 44
- [How to Test a Doctrine Repository](https://symfony.com/doc/8.0/testing/database.html) — questions 45 à 49
- [The DOM Crawler](https://symfony.com/doc/8.0/testing/dom_crawler.html) — questions 50 à 54
- [End-to-End Testing](https://symfony.com/doc/8.0/testing/end_to_end.html) — questions 55 à 63
- [How to Test the Interaction of several Clients](https://symfony.com/doc/8.0/testing/insulating_clients.html) — questions 64 à 68
- [How to Use the Profiler in a Functional Test](https://symfony.com/doc/8.0/testing/profiling.html) — questions 69 à 73
- [The DomCrawler Component](https://symfony.com/doc/8.0/components/dom_crawler.html) — questions 74 à 86
- [The CssSelector Component](https://symfony.com/doc/8.0/components/css_selector.html) — questions 87 à 92
