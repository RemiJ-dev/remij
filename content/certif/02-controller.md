# QCM — Les controllers Symfony

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/controller.html](https://symfony.com/doc/8.0/controller.html) · **Généré le :** 18 juillet 2026
>
> **60 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Les bases du contrôleur

### Question 1

Techniquement, que peut être un contrôleur Symfony ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une fonction PHP
- [ ] **B.** Une méthode d'un objet
- [ ] **C.** Une `Closure`
- [ ] **D.** Uniquement une méthode d'une classe dont le nom se termine par `Controller`

### Question 2

Que doit retourner une action de contrôleur dans Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne de caractères contenant le HTML
- [ ] **B.** Un tableau de données pour le template
- [ ] **C.** Un objet `Response`
- [ ] **D.** Rien (`void`) : Symfony construit la réponse tout seul

### Question 3

Quelle affirmation sur le nom de la classe de contrôleur est vraie ? *(une seule bonne réponse)*

- [ ] **A.** Le suffixe `Controller` est imposé par le framework, sinon la classe n'est pas détectée
- [ ] **B.** La classe peut techniquement s'appeler n'importe comment ; le suffixe `Controller` est une convention
- [ ] **C.** Le nom doit obligatoirement être préfixé par `App`
- [ ] **D.** Le nom de la classe doit correspondre au nom du template rendu

### Question 4

Quelle affirmation sur `AbstractController` est vraie ? *(une seule bonne réponse)*

- [ ] **A.** Tout contrôleur doit obligatoirement en hériter
- [ ] **B.** C'est une interface à implémenter
- [ ] **C.** Elle est dépréciée en Symfony 8.0 au profit de `ControllerHelper`
- [ ] **D.** C'est une classe de base **optionnelle** qui donne accès à des méthodes helpers (`render()`, etc.)

### Question 5

Quel est le FQCN d'`AbstractController` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpKernel\Controller\AbstractController`
- [ ] **B.** `Symfony\Component\Controller\AbstractController`
- [ ] **C.** `Symfony\Bundle\FrameworkBundle\Controller\AbstractController`
- [ ] **D.** `App\Controller\AbstractController`

## Générer des contrôleurs

### Question 6

Quelles commandes de génération la documentation mentionne-t-elle (via Symfony Maker) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `php bin/console make:controller BrandNewController`
- [ ] **B.** `php bin/console make:crud Product` — un CRUD complet à partir d'une entité Doctrine
- [ ] **C.** `php bin/console make:action`
- [ ] **D.** `php bin/console generate:controller`

## Les helpers d'AbstractController

### Question 7

Que fait `$this->generateUrl('app_lucky_number', ['max' => 10])` ? *(une seule bonne réponse)*

- [ ] **A.** Il redirige l'utilisateur vers la route `app_lucky_number`
- [ ] **B.** Il génère l'URL de la route `app_lucky_number` avec ses paramètres
- [ ] **C.** Il déclare une nouvelle route nommée `app_lucky_number`
- [ ] **D.** Il rend le template associé à cette route

### Question 8

Quelles affirmations sur `redirectToRoute()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, la redirection est temporaire (302)
- [ ] **B.** `$this->redirectToRoute('homepage', [], 301)` effectue une redirection permanente
- [ ] **C.** C'est un raccourci pour `new RedirectResponse($this->generateUrl('homepage'))`
- [ ] **D.** Elle accepte aussi des URLs externes complètes en premier argument

### Question 9

Quelle constante de `Response` peut remplacer le code `301` en dur dans `redirectToRoute()` ? *(une seule bonne réponse)*

- [ ] **A.** `Response::HTTP_PERMANENTLY_REDIRECT`
- [ ] **B.** `Response::HTTP_MOVED_PERMANENTLY`
- [ ] **C.** `Response::HTTP_REDIRECT_PERMANENT`
- [ ] **D.** `Response::STATUS_301`

### Question 10

Quelle est la bonne méthode pour rediriger vers une URL externe ? *(une seule bonne réponse)*

- [ ] **A.** `$this->redirectToRoute('http://symfony.com/doc')`
- [ ] **B.** `$this->forward('http://symfony.com/doc')`
- [ ] **C.** `return new Response('http://symfony.com/doc', 301)`
- [ ] **D.** `$this->redirect('http://symfony.com/doc')`

### Question 11

Pourquoi la documentation met-elle en garde contre l'usage de `redirect()` avec une URL fournie par l'utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** `redirect()` ne vérifie en rien sa destination : l'application peut être exposée à la vulnérabilité des « unvalidated redirects »
- [ ] **B.** `redirect()` n'accepte que des URLs internes et lèverait une exception
- [ ] **C.** Les redirections externes sont bloquées par la politique CORS
- [ ] **D.** `redirect()` écrit un warning dans les logs à chaque appel

### Question 12

Quelles affirmations sur les possibilités de `redirectToRoute()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `['_fragment' => 'result']` génère une URL pointant directement sur l'ancre `#result`
- [ ] **B.** L'option `'external' => true` autorise la redirection vers une URL externe
- [ ] **C.** `$this->redirectToRoute('blog_show', $request->query->all())` conserve les paramètres de query string d'origine
- [ ] **D.** `$this->redirectToRoute($request->attributes->get('_route'))` redirige vers la route courante (pattern Post/Redirect/Get)

### Question 13

Que fait `$this->render('lucky/number.html.twig', ['number' => $number])` ? *(une seule bonne réponse)*

- [ ] **A.** Il retourne la chaîne HTML produite par le template
- [ ] **B.** Il affiche directement le template (`echo`) sans retour
- [ ] **C.** Il rend le template **et** place son contenu dans un objet `Response`
- [ ] **D.** Il retourne le chemin du template compilé dans le cache

## Récupérer des services

### Question 14

Quelle est la bonne méthode documentée pour obtenir un service (ex. `LoggerInterface`) dans une action ? *(une seule bonne réponse)*

- [ ] **A.** `$this->get('logger')`
- [ ] **B.** Type-hinter un argument de l'action avec la classe (ou l'interface) du service
- [ ] **C.** `$this->container->get(LoggerInterface::class)`
- [ ] **D.** `LoggerFactory::create()`

### Question 15

Quelle commande liste tous les services que l'on peut type-hinter (autowirer) ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:services`
- [ ] **B.** `php bin/console container:show`
- [ ] **C.** `php bin/console debug:autowiring`
- [ ] **D.** `php bin/console autowire:list`

### Question 16

Quelles affirmations sur l'attribut `#[Autowire]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[Autowire(service: 'monolog.logger.request')]` injecte un service précis
- [ ] **B.** Il ne peut s'utiliser que sur les arguments du constructeur, pas sur ceux d'une action
- [ ] **C.** `#[Autowire('%kernel.project_dir%')]` injecte la valeur d'un paramètre de configuration
- [ ] **D.** L'attribut vient de `Symfony\Component\DependencyInjection\Attribute\Autowire`

## Erreurs et pages 404

### Question 17

Quelle est la bonne façon documentée de déclencher une erreur 404 depuis un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `throw $this->createNotFoundException('The product does not exist');`
- [ ] **B.** `return $this->createNotFoundException('The product does not exist');`
- [ ] **C.** `throw new NotFoundException('The product does not exist');`
- [ ] **D.** `$this->abort(404);`

### Question 18

Quelles affirmations sur la gestion des erreurs sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `createNotFoundException()` est un raccourci pour créer une `NotFoundHttpException`
- [ ] **B.** Une exception qui étend (ou est une) `HttpException` produit le code de statut HTTP approprié
- [ ] **C.** Toute autre exception (ex. `\Exception`) produit une réponse 400
- [ ] **D.** En mode debug, le développeur voit une page d'erreur détaillée

## L'objet Request en argument

### Question 19

Comment accéder à l'objet `Request` dans une action ? *(une seule bonne réponse)*

- [ ] **A.** `$this->getRequest()`
- [ ] **B.** `Request::createFromGlobals()`
- [ ] **C.** `$this->container->get('request')`
- [ ] **D.** Type-hinter un argument de l'action avec `Symfony\Component\HttpFoundation\Request`

### Question 20

Quelle est la bonne méthode pour lire le paramètre GET `page`, avec `1` comme valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `$request->query->get('page', 1)`
- [ ] **B.** `$request->getQuery('page', 1)`
- [ ] **C.** `$request->query('page', 1)`
- [ ] **D.** `$request->GET['page'] ?? 1`

## Mapping automatique de la requête

### Question 21

Que fait l'attribut `#[MapQueryParameter]` ? *(une seule bonne réponse)*

- [ ] **A.** Il mappe l'ensemble de la query string vers un objet DTO
- [ ] **B.** Il mappe individuellement un paramètre de la query string sur un argument du contrôleur
- [ ] **C.** Il ajoute un paramètre de query string aux URLs générées
- [ ] **D.** Il valide la query string sans la mapper

### Question 22

Quels types d'arguments `#[MapQueryParameter]` supporte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les scalaires `bool`, `float`, `int` et `string`
- [ ] **B.** `array`
- [ ] **C.** `\BackedEnum` et les objets étendant `Symfony\Component\Uid\AbstractUid`
- [ ] **D.** `\DateTimeImmutable`

### Question 23

`#[MapQueryParameter]` accepte une option `filter`, par exemple `#[MapQueryParameter(filter: \FILTER_VALIDATE_REGEXP, options: ['regexp' => '/^\w+$/'])]`. D'où viennent ces valeurs de filtre ? *(une seule bonne réponse)*

- [ ] **A.** D'une liste de regex prédéfinies par Symfony
- [ ] **B.** Des contraintes du composant Validator
- [ ] **C.** Des constantes de validation de PHP (« Validate Filters » de `filter_var()`)
- [ ] **D.** Des formats du composant Serializer

### Question 24

Que fait l'attribut `#[MapQueryString]` ? *(une seule bonne réponse)*

- [ ] **A.** Il mappe l'**ensemble** de la query string vers un objet DTO, avec d'éventuelles contraintes de validation
- [ ] **B.** Il mappe chaque paramètre de query string individuellement
- [ ] **C.** Il mappe le payload JSON de la requête vers un DTO
- [ ] **D.** Il sérialise un DTO en query string pour générer une URL

### Question 25

Quelles options de `#[MapQueryString]` existent en Symfony 8.0 ? *(plusieurs bonnes réponses)*

- [ ] **A.** `mapWhenEmpty: true` — invoquer le serializer même sans données
- [ ] **B.** `validationGroups` — les groupes de validation à appliquer
- [ ] **C.** `validationFailedStatusCode` — le statut HTTP en cas d'échec de validation
- [ ] **D.** `key` — mapper l'objet depuis une clé imbriquée de la query string

### Question 26

Quel est le code de statut HTTP retourné **par défaut** quand la validation de `#[MapQueryString]` échoue ? *(une seule bonne réponse)*

- [ ] **A.** 400
- [ ] **B.** 404
- [ ] **C.** 422
- [ ] **D.** 500

### Question 27

La query string est vide mais l'action a besoin d'un DTO valide. Quelle est la solution documentée en Symfony 8.0 ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter l'option `mapWhenEmpty: true` à l'attribut
- [ ] **B.** Retirer le type de l'argument
- [ ] **C.** Attraper l'exception levée par le resolver
- [ ] **D.** Donner une valeur par défaut à l'argument : `#[MapQueryString] UserDto $userDto = new UserDto()`

### Question 28

Quand utilise-t-on `#[MapRequestPayload]` plutôt que `#[MapQueryString]` ? *(une seule bonne réponse)*

- [ ] **A.** Pour les requêtes `GET` avec beaucoup de paramètres
- [ ] **B.** Jamais : les deux attributs sont des alias
- [ ] **C.** Pour mapper les données du **corps** de la requête (`POST`, `PUT`… — ex. payload JSON) vers un DTO
- [ ] **D.** Pour mapper les headers HTTP vers un DTO

### Question 29

Quelles options de `#[MapRequestPayload]` existent en Symfony 8.0 ? *(plusieurs bonnes réponses)*

- [ ] **A.** `acceptFormat: 'json'` — les formats de payload acceptés
- [ ] **B.** `resolver: App\Resolver\UserDtoResolver` — la classe responsable du mapping
- [ ] **C.** `validationGroups: [new Expression('args["user"].getType()')]` — des groupes de validation dynamiques
- [ ] **D.** `validationFailedStatusCode: Response::HTTP_NOT_FOUND` — le statut en cas d'échec de validation

### Question 30

Quel est le code de statut HTTP retourné **par défaut** quand la validation de `#[MapRequestPayload]` échoue ? *(une seule bonne réponse)*

- [ ] **A.** 422
- [ ] **B.** 404
- [ ] **C.** 400
- [ ] **D.** 500

### Question 31

Dans une API JSON, comment s'assurer que les erreurs de validation produisent une réponse JSON plutôt qu'une page HTML ? *(une seule bonne réponse)*

- [ ] **A.** Le client doit obligatoirement envoyer le header `Accept: application/json`
- [ ] **B.** Déclarer la route avec le format JSON : `#[Route('/dashboard', name: 'dashboard', format: 'json')]`
- [ ] **C.** Ajouter l'option `jsonErrors: true` à `#[MapRequestPayload]`
- [ ] **D.** Écrire un event listener sur `kernel.exception`

### Question 32

Pour mapper un tableau imbriqué de DTOs typé par PHPDoc (`@param UserDto[] $users`), que faut-il installer ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/property-info` uniquement
- [ ] **B.** `jms/serializer`
- [ ] **C.** `symfony/maker-bundle`
- [ ] **D.** `phpstan/phpdoc-parser` et `phpdocumentor/type-resolver`

### Question 33

En Symfony 8.0, le payload de la requête est un **tableau JSON racine** d'objets « user ». Quelle est la bonne signature pour le mapper ? *(une seule bonne réponse)*

- [ ] **A.** `#[MapRequestPayload(type: UserDto::class)] array $users`
- [ ] **B.** `#[MapRequestPayload] UserDto ...$users`
- [ ] **C.** `#[MapRequestPayload] array $users` — le type est déduit automatiquement
- [ ] **D.** `#[MapRequestPayload(each: UserDto::class)] array $users`

### Question 34

Le warning de la doc 8.0 sur les types personnalisés (ex. enums) dans les propriétés des DTO mappés : quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les erreurs de dénormalisation peuvent exposer des noms de classes internes à l'utilisateur final
- [ ] **B.** Ce problème est corrigé en Symfony 8.1
- [ ] **C.** Le contournement recommandé en 8.0 : utiliser des types PHP natifs (`string`, `int`…) et valider avec des contraintes, ex. `#[Assert\Choice(callback: [OrderStatus::class, 'values'])]`
- [ ] **D.** Les enums dans un DTO provoquent une erreur de compilation du container

### Question 35

Quelles affirmations sur `#[MapUploadedFile]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[MapUploadedFile] UploadedFile $picture` : le fichier est résolu d'après le **nom de l'argument** (`picture`)
- [ ] **B.** Si aucun fichier n'est soumis, une `HttpException` est levée
- [ ] **C.** Rendre l'argument nullable (`?UploadedFile $document`) évite cette exception
- [ ] **D.** Les contraintes passées à l'attribut sont vérifiées **avant** l'injection : en cas de violation, l'action n'est pas exécutée

### Question 36

Comment recevoir une **collection** de fichiers uploadés avec `#[MapUploadedFile]` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Impossible : il faut boucler manuellement sur `$request->files`
- [ ] **B.** Mapper l'argument comme un tableau : `#[MapUploadedFile(...)] array $documents`
- [ ] **C.** Utiliser un argument variadique : `#[MapUploadedFile(...)] UploadedFile ...$documents`
- [ ] **D.** La contrainte donnée s'applique à tous les fichiers ; si un seul échoue, une `HttpException` est levée

### Question 37

Comment changer le code de statut HTTP levé quand un fichier uploadé viole ses contraintes ? *(une seule bonne réponse)*

- [ ] **A.** Il faut attraper l'`HttpException` soi-même dans l'action
- [ ] **B.** C'est impossible : le code est toujours 500
- [ ] **C.** `#[MapUploadedFile(constraints: new Assert\File(maxSize: '2M'), validationFailedStatusCode: Response::HTTP_REQUEST_ENTITY_TOO_LARGE)]`
- [ ] **D.** Avec l'option `statusCode` de l'attribut `#[Route]`

### Question 38

En Symfony **8.0**, quel attribut permet de mapper directement un header HTTP (ex. `Accept-Language`) sur un argument du contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `#[MapRequestHeader] string $acceptLanguage`
- [ ] **B.** `#[MapHeader('accept-language')] string $acceptLanguage`
- [ ] **C.** Aucun : `#[MapRequestHeader]` n'existe qu'à partir de Symfony 8.1 — en 8.0 on lit `$request->headers`
- [ ] **D.** `#[Autowire(header: 'accept-language')] string $acceptLanguage`

## Session et messages flash

### Question 39

Quelle est la bonne méthode documentée pour accéder à la session dans un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `$this->getSession()`
- [ ] **B.** Via l'objet `Request` : `$session = $request->getSession();`
- [ ] **C.** `new Session()`
- [ ] **D.** La superglobale `$_SESSION`

### Question 40

Quelles affirmations sur la session sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$session->set('user_id', 42)` stocke un attribut réutilisable lors d'une requête ultérieure
- [ ] **B.** `$session->get('user_id', 0)` : le second argument est une valeur par défaut optionnelle
- [ ] **C.** La session sert à stocker des informations sur l'utilisateur entre les requêtes
- [ ] **D.** Dans un service, on accède à la session en type-hintant directement `SessionInterface` dans le constructeur, comme le documente cette page

### Question 41

Quelles affirmations sur les messages flash sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ils persistent en session tant qu'on ne les supprime pas explicitement
- [ ] **B.** Ils sont destinés à être utilisés exactement une fois
- [ ] **C.** Ils disparaissent automatiquement de la session dès qu'on les récupère
- [ ] **D.** `$this->addFlash('notice', '…')` est équivalent à `$request->getSession()->getFlashBag()->add('notice', '…')`

## Les objets Request et Response

### Question 42

Quelles affirmations sur les propriétés publiques de l'objet `Request` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$request->query->get('page')` lit les variables `GET`
- [ ] **B.** `$request->getPayload()->get('page')` lit les données du corps de la requête
- [ ] **C.** `$request->cookies->get('PHPSESSID')` lit la valeur d'un cookie
- [ ] **D.** `$request->server` permet de lire les headers HTTP avec des clés normalisées en minuscules

### Question 43

Quelle est la bonne méthode pour lire un header HTTP de la requête ? *(une seule bonne réponse)*

- [ ] **A.** `$request->server->get('content-type')`
- [ ] **B.** `$request->getHeader('Content-Type')`
- [ ] **C.** `$request->cookies->get('content-type')`
- [ ] **D.** `$request->headers->get('content-type')` — les clés sont normalisées en minuscules

### Question 44

Quelles affirmations sur l'objet `Response` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `new Response('Hello '.$name, Response::HTTP_OK)` — le code 200 est de toute façon le code par défaut
- [ ] **B.** Le contrôleur doit appeler `$response->send()` avant de terminer
- [ ] **C.** `$response->headers` est un objet de type `ResponseHeaderBag`
- [ ] **D.** Les noms de headers sont normalisés : `Content-Type` ≡ `content-type` ≡ `content_type`

### Question 45

Un contrôleur peut-il retourner autre chose qu'un objet `Response` ? *(une seule bonne réponse)*

- [ ] **A.** Non, cela provoque systématiquement une erreur fatale
- [ ] **B.** Oui, Symfony convertit automatiquement n'importe quelle valeur en `Response`
- [ ] **C.** Techniquement oui, mais l'application doit alors transformer elle-même cette valeur en `Response`, via l'événement `kernel.view`
- [ ] **D.** Oui, mais uniquement des chaînes de caractères

### Question 46

Que permet de savoir `$request->isXmlHttpRequest()` ? *(une seule bonne réponse)*

- [ ] **A.** Si la requête est une requête Ajax
- [ ] **B.** Si le payload de la requête est du XML
- [ ] **C.** Si la réponse attendue est du XML
- [ ] **D.** Si la requête provient d'un robot d'indexation

### Question 47

Quelles méthodes de l'objet `Request` la documentation présente-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$request->getPreferredLanguage(['en', 'fr'])`
- [ ] **B.** `$request->files->get('foo')` — récupère une instance d'`UploadedFile`
- [ ] **C.** `$request->headers->get('host')`
- [ ] **D.** `$request->getBody()`

## Configuration, JSON et fichiers

### Question 48

Comment lire un paramètre de configuration (ex. `kernel.project_dir`) depuis un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `$this->getConfig('kernel.project_dir')`
- [ ] **B.** `$this->getParameter('kernel.project_dir')`
- [ ] **C.** `$_ENV['KERNEL_PROJECT_DIR']`
- [ ] **D.** `Config::get('kernel.project_dir')`

### Question 49

Quelles affirmations sur le helper `json()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il retourne un objet `JsonResponse` qui encode les données et pose le bon header `Content-Type`
- [ ] **B.** Sa signature complète est `json($data, $status = 200, $headers = [], $context = [])`
- [ ] **C.** Il faut définir manuellement le header `Content-Type: application/json` sur la réponse
- [ ] **D.** Si le service serializer est activé dans l'application, il est utilisé pour la sérialisation ; sinon, c'est `json_encode()`

### Question 50

Que fait `return $this->file('/path/to/some_file.pdf');` ? *(une seule bonne réponse)*

- [ ] **A.** Il retourne une `BinaryFileResponse` qui envoie le fichier en forçant son téléchargement par le navigateur
- [ ] **B.** Il retourne le contenu du fichier sous forme de chaîne
- [ ] **C.** Il retourne une `StreamedResponse` qui affiche le fichier dans le navigateur
- [ ] **D.** Il exige un objet `SplFileInfo` en argument, jamais une chaîne

### Question 51

Comment servir un fichier en l'affichant **dans le navigateur** plutôt qu'en le téléchargeant ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `'inline' => true` en second argument de `file()`
- [ ] **B.** C'est le comportement par défaut de `file()`
- [ ] **C.** `$this->inline('invoice_3241.pdf')`
- [ ] **D.** `$this->file('invoice_3241.pdf', 'my_invoice.pdf', ResponseHeaderBag::DISPOSITION_INLINE)`

### Question 52

Que sont les « Early Hints » évoqués par la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Un mécanisme de cache HTTP côté serveur
- [ ] **B.** Des réponses `100 Continue` envoyées pendant l'upload
- [ ] **C.** Des réponses HTTP `103` envoyées avant la réponse complète, pour que le navigateur commence à télécharger des assets
- [ ] **D.** Des suggestions de performance affichées par le profiler

## Server-Sent Events (SSE)

### Question 53

Quelle classe permet de streamer des événements vers le client selon le protocole SSE ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpFoundation\StreamedResponse`
- [ ] **B.** `Symfony\Component\HttpFoundation\EventStreamResponse`
- [ ] **C.** `Symfony\Component\HttpFoundation\ServerSentEventsResponse`
- [ ] **D.** `Symfony\Component\Mercure\MercureResponse`

### Question 54

Quels headers `EventStreamResponse` pose-t-il automatiquement ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Transfer-Encoding: chunked`
- [ ] **B.** `Content-Type: text/event-stream`
- [ ] **C.** `Cache-Control: no-cache`
- [ ] **D.** `Connection: keep-alive`

### Question 55

Quels arguments du constructeur de `ServerEvent` la documentation présente-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `type` — un type d'événement personnalisé, écouté côté client via `addEventListener('my-event', …)`
- [ ] **B.** `id` — un identifiant, utile pour reprendre un flux avec le header `Last-Event-ID`
- [ ] **C.** `retry` — le délai de reconnexion demandé au client, en millisecondes
- [ ] **D.** `comment` — un commentaire, utilisable comme keep-alive

### Question 56

Quand les générateurs (`yield`) ne sont pas pratiques, comment envoyer manuellement un événement SSE ? *(une seule bonne réponse)*

- [ ] **A.** Avec `$response->sendEvent(new ServerEvent($message))` dans le callback de l'`EventStreamResponse`
- [ ] **B.** Avec `echo` suivi de `flush()`
- [ ] **C.** Avec `$response->push($message)`
- [ ] **D.** C'est impossible : l'API impose un générateur

### Question 57

Quelles affirmations sur les SSE côté client et leurs limites sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Côté client, on écoute le flux avec l'API native `EventSource`
- [ ] **B.** `eventSource.onmessage` reçoit les événements sans type ; `addEventListener('my-event', …)` ceux d'un type précis
- [ ] **C.** `EventStreamResponse` est la solution recommandée pour diffuser à un très grand nombre de clients simultanés
- [ ] **D.** Chaque client SSE garde une connexion HTTP ouverte et consomme des ressources serveur

## Découpler les contrôleurs de Symfony

### Question 58

Quelle classe expose tous les helpers d'`AbstractController` sous forme de méthodes publiques ? *(une seule bonne réponse)*

- [ ] **A.** `ControllerUtils`
- [ ] **B.** `AbstractHelper`
- [ ] **C.** `ControllerTrait`
- [ ] **D.** `ControllerHelper`

### Question 59

Quelles affirmations sur `#[AutowireMethodOf]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'attribut est fourni par le composant HttpKernel
- [ ] **B.** `#[AutowireMethodOf(ControllerHelper::class)] private \Closure $render` injecte la méthode `render()` sous forme de `\Closure`
- [ ] **C.** On peut typer l'argument avec une interface (dont `__invoke()` reprend la signature du helper) pour profiter de l'analyse statique et de l'autocomplétion
- [ ] **D.** Injecter uniquement les helpers nécessaires est plus efficace qu'injecter la classe `ControllerHelper` entière

### Question 60

Que recommande la documentation pour la majorité des applications ? *(une seule bonne réponse)*

- [ ] **A.** Étendre `AbstractController`, le découplage étant réservé à des usages avancés (testabilité, design framework-agnostique)
- [ ] **B.** Découpler systématiquement les contrôleurs du framework
- [ ] **C.** Faire hériter les contrôleurs de `ControllerHelper`
- [ ] **D.** Implémenter l'interface `ControllerInterface`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Controller de la documentation Symfony 8.0](https://symfony.com/doc/8.0/controller.html).

**Question 1 : A, B, C** — « While a controller can be any PHP callable (function, method on an object, or a `Closure`), a controller is usually a method inside a controller class. » D est trop restrictif. *(§ A Basic Controller)*

**Question 2 : C** — « A controller is a PHP function you create that reads information from the `Request` object and creates and returns a `Response` object. » Nuance avancée : voir la question 45 (`kernel.view`). *(§ A Basic Controller)*

**Question 3 : B** — « The class can technically be called anything, but it's suffixed with `Controller` by convention. » *(§ A Basic Controller)*

**Question 4 : D** — « Symfony comes with an **optional** base controller class called `AbstractController`. It can be extended to gain access to helper methods. » *(§ The Base Controller Class & Services)*

**Question 5 : C** — `Symfony\Bundle\FrameworkBundle\Controller\AbstractController` : la classe vient du FrameworkBundle, pas du composant HttpKernel. *(§ The Base Controller Class & Services)*

**Question 6 : A, B** — `make:controller` génère un contrôleur + son template ; `make:crud` génère « an entire CRUD from a Doctrine entity » (contrôleur, form type et templates). Les deux nécessitent Symfony Maker. *(§ Generating Controllers)*

**Question 7 : B** — `generateUrl()` « is just a helper method that generates the URL for a given route ». Il ne redirige pas — pour ça, voir `redirectToRoute()`. *(§ Generating URLs)*

**Question 8 : A, B, C** — La redirection est temporaire par défaut (302, code par défaut de `RedirectResponse`) ; le 3ᵉ argument permet un 301 permanent ; et la doc montre l'équivalence avec `new RedirectResponse($this->generateUrl('homepage'))`. Les URLs externes passent par `redirect()`, pas `redirectToRoute()` (D faux). *(§ Redirecting)*

**Question 9 : B** — « If you prefer, you can use PHP constants instead of hardcoded numbers » : `Response::HTTP_MOVED_PERMANENTLY` (301). Attention, `HTTP_PERMANENTLY_REDIRECT` correspond à 308. *(§ Redirecting)*

**Question 10 : D** — « redirects externally: `return $this->redirect('http://symfony.com/doc');` ». *(§ Redirecting)*

**Question 11 : A** — Bloc danger : « The `redirect()` method does not check its destination in any way. If you redirect to a URL provided by end-users, your application may be open to the unvalidated redirects security vulnerability. » *(§ Redirecting)*

**Question 12 : A, C, D** — `_fragment` pointe sur une ancre ; `$request->query->all()` conserve la query string ; `$request->attributes->get('_route')` sert le pattern Post/Redirect/Get. L'option `'external'` (B) n'existe pas. *(§ Redirecting)*

**Question 13 : C** — « The `render()` method renders a template **and** puts that content into a `Response` object for you. » *(§ Rendering Templates)*

**Question 14 : B** — « If you need a service in a controller, type-hint an argument with its class (or interface) name and Symfony will inject it automatically » — à condition que le contrôleur soit enregistré comme service (le cas par défaut). L'injection par constructeur reste aussi possible, « like with all services ». *(§ Fetching Services)*

**Question 15 : C** — « To see them, use the `debug:autowiring` console command. » *(§ Fetching Services)*

**Question 16 : A, C, D** — `#[Autowire]` permet d'injecter un service précis (`service:`) ou une valeur de paramètre (`'%kernel.project_dir%'`), et vient de `Symfony\Component\DependencyInjection\Attribute\Autowire`. B est faux : l'exemple de la doc l'utilise sur les arguments d'une action. *(§ Fetching Services)*

**Question 17 : A** — « To do this, throw a special type of exception: `throw $this->createNotFoundException('The product does not exist');` ». Une exception se lance avec `throw`, pas `return` (B) ; la classe s'appelle `NotFoundHttpException` (C). *(§ Managing Errors and 404 Pages)*

**Question 18 : A, B, D** — `createNotFoundException()` est « just a shortcut » pour créer une `NotFoundHttpException` ; une `HttpException` produit « the appropriate HTTP status code » ; et le développeur voit « a full debug error page » en mode debug. C est faux : toute autre exception produit un statut **500**. *(§ Managing Errors and 404 Pages)*

**Question 19 : D** — « To access it in your controller, add it as an argument and **type-hint it with the Request class**. » `$this->getRequest()` (A) date de Symfony 2. *(§ The Request object as a Controller Argument)*

**Question 20 : A** — `$page = $request->query->get('page', 1);` — la propriété `query` contient les variables GET et `get()` accepte une valeur par défaut. *(§ The Request object as a Controller Argument)*

**Question 21 : B** — `#[MapQueryParameter]` remplit les arguments un à un depuis la query string (`?firstName=John&lastName=Smith&age=27` → `string $firstName`, `string $lastName`, `int $age`). Mapper l'ensemble vers un DTO, c'est `#[MapQueryString]`. *(§ Mapping Query Parameters Individually)*

**Question 22 : A, B, C** — Liste documentée : `\BackedEnum`, `array`, `bool`, `float`, `int`, `string` et les objets étendant `AbstractUid`. Pas les objets date (D). *(§ Mapping Query Parameters Individually)*

**Question 23 : C** — « You can use the Validate Filters constants defined in PHP » — les constantes `FILTER_VALIDATE_*` de `filter_var()`, complétées par `options`. *(§ Mapping Query Parameters Individually)*

**Question 24 : A** — `#[MapQueryString]` « map[s] the entire query string into an object », dont les propriétés peuvent porter des contraintes de validation (`#[Assert\NotBlank]`…). *(§ Mapping The Whole Query String)*

**Question 25 : B, C, D** — `validationGroups`, `validationFailedStatusCode` et `key` (« map your object to a nested array in your query using a specific key »). Piège : `mapWhenEmpty` n'existe qu'à partir de **Symfony 8.1**. *(§ Mapping The Whole Query String)*

**Question 26 : B** — « The default status code returned if the validation fails is **404**. » (À ne pas confondre avec le 422 de `#[MapRequestPayload]`.) *(§ Mapping The Whole Query String)*

**Question 27 : D** — « If you need a valid DTO even when the request query string is empty, set a default value for your controller arguments » : `UserDto $userDto = new UserDto()`. `mapWhenEmpty` (A) est une nouveauté 8.1. *(§ Mapping The Whole Query String)*

**Question 28 : C** — Avec `POST`/`PUT`, « user's data are not stored in the query string but directly in the request payload » — c'est ce payload (ex. JSON) que `#[MapRequestPayload]` mappe vers le DTO. *(§ Mapping Request Payload)*

**Question 29 : A, B, D** — `acceptFormat`, `serializationContext`, `resolver`, `validationGroups` et `validationFailedStatusCode` sont documentés en 8.0. Piège : les groupes de validation dynamiques via `Expression` (C) n'arrivent qu'en **Symfony 8.1**. *(§ Mapping Request Payload)*

**Question 30 : A** — « The default status code returned if the validation fails is **422**. » *(§ Mapping Request Payload)*

**Question 31 : B** — Tip : « make sure to declare your route as using the JSON format. This will make the error handling output a JSON response in case of validation errors, rather than an HTML page. » *(§ Mapping Request Payload)*

**Question 32 : D** — « Make sure to install `phpstan/phpdoc-parser` and `phpdocumentor/type-resolver` if you want to map a nested array of specific DTOs. » *(§ Mapping Request Payload)*

**Question 33 : A** — En 8.0 : « map the parameter as an array and configure the type of each element using the `type` option ». L'argument variadique `UserDto ...$users` (B) n'est supporté qu'à partir de **Symfony 8.1**. *(§ Mapping Request Payload)*

**Question 34 : A, B, C** — Warning 8.0 : « denormalization errors may expose internal class names to the end user. This was fixed in Symfony 8.1 » ; en attendant, « use built-in PHP types and validate the values with constraints » (`Assert\Choice(callback: [OrderStatus::class, 'values'])`). Aucune erreur de compilation (D). *(§ Mapping Request Payload)*

**Question 35 : A, B, C, D** — Les quatre sont vraies : résolution « based on the argument name », `HttpException` si aucun fichier, argument nullable pour l'éviter, et « the validation constraints are checked before injecting the `UploadedFile` […] the controller's action is not executed ». *(§ Mapping Uploaded Files)*

**Question 36 : B, C, D** — « Map them to an array or a variadic argument. The given constraint will be applied to all files and if any of them fails, an `HttpException` is thrown. » (L'option `name` permet par ailleurs de chercher le fichier sous un autre nom que celui de l'argument.) *(§ Mapping Uploaded Files)*

**Question 37 : C** — « You can change the status code of the HTTP exception thrown when there are constraint violations » via `validationFailedStatusCode`. *(§ Mapping Uploaded Files)*

**Question 38 : C** — Piège de version : `#[MapRequestHeader]` est introduit en **Symfony 8.1**. En 8.0, on lit les headers via `$request->headers->get(…)`. *(diff doc 8.0/8.1 ; § The Request and Response Object)*

**Question 39 : B** — « You can access the session through the `Request` object » (`$request->getSession()`). Dans un service : injecter la `RequestStack`. *(§ Managing the Session)*

**Question 40 : A, B, C** — `set()`/`get()` (avec défaut optionnel) et « a session service to store information about the user between requests ». D est faux : cette page documente l'injection de la `RequestStack` pour les services, pas un type-hint `SessionInterface`. *(§ Managing the Session)*

**Question 41 : B, C, D** — « Flash messages are special session messages meant to be used exactly once: they vanish from the session automatically as soon as you retrieve them » ; et `addFlash()` ≡ `getFlashBag()->add()`. A est l'inverse de leur définition. *(§ Flash Messages)*

**Question 42 : A, B, C** — « retrieves GET and POST variables respectively » : `query` et `getPayload()` ; `cookies` pour les cookies. D est faux : `$request->server` lit les variables SERVER (`HTTP_HOST`…) ; les headers normalisés, c'est `$request->headers`. *(§ The Request and Response Object)*

**Question 43 : D** — « retrieves an HTTP request header, with normalized, lowercase keys: `$request->headers->get('host');` ». *(§ The Request and Response Object)*

**Question 44 : A, C, D** — 200 est le statut par défaut d'une `Response` ; `headers` est un `ResponseHeaderBag` ; « the name `Content-Type` is equivalent to the name `content-type` or `content_type` ». B est faux : le contrôleur **retourne** la `Response`, Symfony se charge de l'envoyer. *(§ The Request and Response Object)*

**Question 45 : C** — Note : « Technically, a controller can return a value other than a `Response`. However, your application is responsible for transforming that value into a `Response` object […] using the `kernel.view` event. » *(§ The Request and Response Object)*

**Question 46 : A** — Le commentaire de la doc : `$request->isXmlHttpRequest(); // is it an Ajax request?`. *(§ The Request and Response Object)*

**Question 47 : A, B, C** — `getPreferredLanguage(['en', 'fr'])`, `$request->files->get('foo')` (une instance d'`UploadedFile`) et `$request->headers->get('host')` figurent dans l'exemple. `getBody()` (D) n'existe pas — le corps se lit via `getContent()`/`getPayload()`. *(§ The Request and Response Object)*

**Question 48 : B** — « To get the value of any configuration parameter from a controller, use the `getParameter()` helper method. » *(§ Accessing Configuration Values)*

**Question 49 : A, B, D** — `json()` retourne une `JsonResponse` « that encodes the data automatically » (Content-Type inclus — C faux), avec la signature `json($data, $status = 200, $headers = [], $context = [])` ; le serializer est utilisé s'il est activé, sinon `json_encode()`. *(§ Returning JSON Response)*

**Question 50 : A** — « send the file contents and force the browser to download it » — `file()` retourne une `BinaryFileResponse` et accepte un chemin (string), un `File`… *(§ Streaming File Responses)*

**Question 51 : D** — « display the file contents in the browser instead of downloading it » : 3ᵉ argument `ResponseHeaderBag::DISPOSITION_INLINE` (le 2ᵉ argument sert à renommer le fichier). *(§ Streaming File Responses)*

**Question 52 : C** — « You can improve performance by sending `103` Early Hints responses to ask the browser to start downloading assets before the full response is ready. » *(§ Sending Early Hints)*

**Question 53 : B** — `EventStreamResponse` est la classe dédiée au protocole SSE. `StreamedResponse` (A) existe pour du streaming générique, mais ce n'est pas la classe SSE documentée ici. *(§ Streaming Server-Sent Events)*

**Question 54 : B, C, D** — « It automatically sets the required headers (`Content-Type: text/event-stream`, `Cache-Control: no-cache`, `Connection: keep-alive`). » *(§ Streaming Server-Sent Events)*

**Question 55 : A, B, C, D** — Les quatre arguments sont documentés : `type` (écouté via `addEventListener`), `id` (reprise avec `Last-Event-ID`), `retry` (millisecondes) et `comment` (keep-alive) — en plus de `data`. *(§ Streaming Server-Sent Events)*

**Question 56 : A** — « For use cases where generators are not practical, you can use the `sendEvent()` method for manual control » — le callback reçoit alors l'`EventStreamResponse` en argument. *(§ Streaming Server-Sent Events)*

**Question 57 : A, B, D** — Côté client : `EventSource`, `onmessage` pour les événements sans type, `addEventListener` pour les types personnalisés. C est l'inverse du warning : pour « high-traffic applications », la doc recommande **Mercure** ; chaque connexion SSE ouverte consomme des ressources serveur. *(§ Streaming Server-Sent Events)*

**Question 58 : D** — « Symfony exposes all the helpers from `AbstractController` through another class called `ControllerHelper`, where each helper is available as a public method. » *(§ Decoupling Controllers from Symfony)*

**Question 59 : B, C, D** — `#[AutowireMethodOf(ControllerHelper::class)]` injecte le helper en `\Closure` ; l'attribut fonctionne aussi avec des interfaces (dont `__invoke()` reprend la signature du helper) « with full static analysis and autocompletion benefits » ; et n'injecter que le nécessaire « makes your code more efficient ». A est faux : l'attribut vient du composant **DependencyInjection**. *(§ Decoupling Controllers from Symfony)*

**Question 60 : A** — « Extending the `AbstractController` base class simplifies controller development and is **recommended for most applications**. » Le découplage vise les besoins avancés (testabilité, design framework-agnostique). *(§ Decoupling Controllers from Symfony)*

