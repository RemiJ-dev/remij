# QCM — Les controllers Symfony

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/controller.html](https://symfony.com/doc/8.0/controller.html) et ses pages annexes (questions 61 à 86) · **Généré le :** 18 juillet 2026 · **Complété le :** 19 juillet 2026
>
> **86 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
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

> Les questions 61 à 86 couvrent les pages annexes listées dans la section [Pour aller plus loin](#pour-aller-plus-loin).

## Pages d'erreur personnalisées

### Question 61

Comment le renderer d'erreur Twig choisit-il le template d'erreur en production ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il cherche d'abord un template nommé d'après le code de statut, ex. `error404.html.twig`
- [ ] **B.** Si ce template n'existe pas, il retombe sur le template générique `error.html.twig`
- [ ] **C.** Les templates de remplacement se placent dans `templates/bundles/TwigBundle/Exception/`
- [ ] **D.** Les templates de remplacement se placent dans `templates/exception/`

### Question 62

Quelles variables sont disponibles dans un template d'erreur personnalisé ? *(plusieurs bonnes réponses)*

- [ ] **A.** `status_code` — le code de statut HTTP
- [ ] **B.** `status_text` — le message associé au code de statut
- [ ] **C.** `exception` — ex. `{{ exception.message }}`, voire `{{ exception.traceAsString }}` (déconseillé pour l'utilisateur final)
- [ ] **D.** `logger` — pour journaliser depuis le template

### Question 63

Quelle affirmation sur la sécurité et les pages 404 est vraie ? *(une seule bonne réponse)*

- [ ] **A.** Les informations de sécurité sont disponibles normalement sur les pages 404
- [ ] **B.** Elles ne sont indisponibles que si le firewall est `stateless`
- [ ] **C.** À cause de l'ordre de chargement du routing et de la sécurité, elles ne sont **pas** disponibles : l'utilisateur apparaît déconnecté sur la page 404
- [ ] **D.** Leur disponibilité dépend de l'option `framework.error_controller`

### Question 64

Comment prévisualiser ses pages d'*erreur* pendant le développement, où Symfony affiche la page d'*exception* à la place ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console error:preview 404`
- [ ] **B.** En chargeant les routes dédiées de FrameworkBundle, puis en visitant `http://localhost/_error/{statusCode}` (ou `/_error/{statusCode}.{format}`)
- [ ] **C.** En passant temporairement `APP_ENV=prod`
- [ ] **D.** Ce n'est pas possible sans désactiver le mode debug

### Question 65

Comment personnaliser le contenu des erreurs dans les formats non-HTML (JSON, XML…) ? *(une seule bonne réponse)*

- [ ] **A.** Surcharger le template `error.json.twig`
- [ ] **B.** Configurer l'option `framework.serializer.error_format`
- [ ] **C.** C'est impossible sans écrire un listener `kernel.exception`
- [ ] **D.** Créer un normalizer qui supporte l'entrée `FlattenException` (le composant Serializer étant installé)

### Question 66

Quelles affirmations sur la surcharge de l'`ErrorController` par défaut sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** On désigne son propre contrôleur via l'option de configuration `framework.error_controller`
- [ ] **B.** Le contrôleur reçoit un paramètre `exception` : l'instance `Throwable` originale
- [ ] **C.** Le contrôleur reçoit un paramètre `logger` (`DebugLoggerInterface`), qui peut être `null`
- [ ] **D.** La prévisualisation `/_error/{statusCode}` ne fonctionne pas avec un contrôleur d'erreur personnalisé

### Question 67

Quelles affirmations sur l'événement `kernel.exception` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Quand une exception est levée, `HttpKernel` l'attrape et dispatche l'événement `kernel.exception`
- [ ] **B.** Si un listener appelle `setResponse()` sur l'`ExceptionEvent`, la propagation est stoppée et la réponse envoyée au client
- [ ] **C.** Cette approche permet une gestion d'erreurs centralisée et en couches, au lieu d'attraper les mêmes exceptions dans chaque contrôleur
- [ ] **D.** Ce mécanisme ne s'applique qu'aux exceptions héritant de `HttpException`

### Question 68

Quelles affirmations sur la commande `error:dump` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle génère les pages d'erreur de l'application sous forme de fichiers HTML statiques
- [ ] **B.** Par défaut, elle génère les pages de toutes les erreurs 4xx et 5xx, mais on peut lui passer une liste de codes
- [ ] **C.** Elle permet au serveur web (ex. `error_page` de Nginx) de servir vos pages même quand l'erreur survient avant d'atteindre l'application Symfony
- [ ] **D.** Elle génère et installe automatiquement la configuration Nginx correspondante

## Forward vers un autre contrôleur

### Question 69

Quelles affirmations sur `$this->forward()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle effectue une sous-requête « interne » au lieu de rediriger le navigateur de l'utilisateur
- [ ] **B.** Elle retourne l'objet `Response` retourné par le contrôleur cible
- [ ] **C.** Le tableau passé en second argument devient les arguments du contrôleur cible, appariés par **nom**
- [ ] **D.** L'ordre des arguments de la méthode cible doit correspondre à l'ordre des clés du tableau

### Question 70

Après un `$this->forward(...)`, que valent `app.current_route` et `_route_params` dans Twig ? *(une seule bonne réponse)*

- [ ] **A.** Les valeurs de la requête d'origine
- [ ] **B.** Les valeurs de la route du contrôleur cible
- [ ] **C.** Ils sont vides — sauf à les définir manuellement via les clés `_route` et `_route_params` du tableau d'arguments
- [ ] **D.** Une exception est levée si on y accède

## Contrôleurs définis comme services

### Question 71

Un contrôleur n'étend pas `AbstractController`. Par quels moyens documentés peut-on l'enregistrer comme service (avec l'injection de services dans les arguments d'action) ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec l'attribut `#[Route]`
- [ ] **B.** Avec l'attribut `#[AsController]`
- [ ] **C.** Avec le tag de service `controller.service_arguments`
- [ ] **D.** Avec l'attribut `#[AsService]`

### Question 72

Quelles affirmations sur les contrôleurs enregistrés comme services sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec la configuration `services.yaml` par défaut, les contrôleurs qui étendent `AbstractController` sont automatiquement enregistrés comme services
- [ ] **B.** Le service contrôleur est marqué **public** et **non-lazy**
- [ ] **C.** Il est public parce que le controller resolver le récupère du container par son id de service à l'exécution
- [ ] **D.** Quand on utilise déjà `#[Route]`, ajouter `#[AsController]` est nécessaire pour activer l'injection dans les actions

### Question 73

Quelle syntaxe référence un contrôleur-service dans la configuration de routing ? *(une seule bonne réponse)*

- [ ] **A.** `service_id:method_name` (un seul deux-points)
- [ ] **B.** `service_id::method_name` — identique à `App\Controller\HelloController::index` quand l'id de service est le FQCN
- [ ] **C.** `service_id->method_name`
- [ ] **D.** `@service_id/method_name`

### Question 74

Quelles affirmations sur les contrôleurs invokables sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un contrôleur peut définir une action unique via la méthode `__invoke()`
- [ ] **B.** C'est une pratique courante du pattern **ADR** (Action-Domain-Responder)
- [ ] **C.** Avec `#[Route]` posé sur la classe, `__invoke()` bénéficie de l'injection de services dans ses arguments, comme n'importe quelle action
- [ ] **D.** Dans la configuration de routing, il faut référencer explicitement `App\Controller\HelloController::__invoke`

### Question 75

Pour des raisons de sécurité, Symfony maintient une allowlist de contrôleurs. Lesquels sont automatiquement autorisés ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les classes portant l'attribut `#[AsController]`
- [ ] **B.** Les classes étendant `AbstractController`
- [ ] **C.** Le `TemplateController` natif et tous les services tagués `controller.service_arguments`
- [ ] **D.** Tous les callables PHP, sans restriction

## Upload de fichiers

### Question 76

Un formulaire doit uploader une brochure PDF pour une entité `Product` qui ne stocke que le **nom** du fichier. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le champ du formulaire doit être un `FileType`, pour que le navigateur affiche le widget d'upload
- [ ] **B.** Le champ se déclare `'mapped' => false`, pour que Symfony ne tente pas de lire/écrire la valeur depuis l'entité
- [ ] **C.** Les contraintes de validation se posent alors via l'option `constraints` du champ (ex. `new Assert\File(maxSize: '1024k', extensions: ['pdf'])`)
- [ ] **D.** La colonne Doctrine doit être de type `blob` pour stocker le fichier

### Question 77

Quelles affirmations sur la sécurité des fichiers uploadés sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getClientOriginalName()`, `getClientOriginalExtension()` et `getSize()` sont considérées **non sûres**, car un utilisateur malveillant peut falsifier ces informations
- [ ] **B.** Il est recommandé de générer soi-même un nom de fichier unique
- [ ] **C.** `guessExtension()` laisse Symfony deviner la bonne extension d'après le type MIME du fichier
- [ ] **D.** `getClientOriginalName()` est fiable, car le navigateur valide le nom du fichier

### Question 78

Comment permettre l'upload de plusieurs fichiers à la fois ? *(plusieurs bonnes réponses)*

- [ ] **A.** Passer l'option `'multiple' => true` au `FileType`
- [ ] **B.** La donnée du champ devient alors un tableau d'instances `UploadedFile`
- [ ] **C.** Envelopper la contrainte `File` dans la contrainte `All` pour valider chaque fichier
- [ ] **D.** Modifier le template pour ajouter l'attribut HTML `multiple` sur l'`<input type="file">`

### Question 79

À l'édition d'une entité déjà persistée (qui ne stocke que le chemin relatif du fichier), qu'attend le champ `FileType` comme donnée initiale ? *(une seule bonne réponse)*

- [ ] **A.** La chaîne du chemin relatif stockée en base
- [ ] **B.** Une instance d'`UploadedFile`
- [ ] **C.** `null` — le champ est ignoré à l'édition
- [ ] **D.** Une instance de `File`, construite en concaténant le répertoire d'upload configuré et le nom de fichier stocké

### Question 80

Que dit la documentation de la gestion des uploads via des listeners **Doctrine** ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est plus recommandé : les événements Doctrine ne devraient pas être utilisés pour la logique métier ; préférer les événements et listeners Symfony
- [ ] **B.** C'est la méthode mise en avant par la documentation
- [ ] **C.** C'est obligatoire pour utiliser VichUploaderBundle
- [ ] **D.** C'est techniquement impossible depuis Doctrine 3

## Étendre la résolution des arguments (value resolvers)

### Question 81

Quelles affirmations sur les value resolvers natifs du composant HttpKernel sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `BackedEnumValueResolver` résout un case d'enum depuis un paramètre de route ; une valeur invalide produit une réponse 404
- [ ] **B.** `UidValueResolver` convertit un paramètre de route en objet UID ; une valeur invalide produit une réponse 404
- [ ] **C.** `DateTimeValueResolver` injecte un objet `DateTimeInterface`, dont le format accepté peut être restreint via l'attribut `#[MapDateTime]`
- [ ] **D.** `EntityValueResolver` fait partie du composant HttpKernel

### Question 82

En Symfony **8.0**, comment une entité Doctrine est-elle injectée comme argument du contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement, dès qu'un argument est type-hinté avec une classe d'entité
- [ ] **B.** Via `#[MapRequestPayload]`
- [ ] **C.** Le mapping automatique a été **retiré en 8.0** : il faut utiliser l'attribut `#[MapEntity]` ou la syntaxe de mapping de route `{param:argument}`
- [ ] **D.** Uniquement en appelant manuellement le repository dans l'action

### Question 83

Quelles affirmations sur les value resolvers fournis par la sécurité sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `UserValueResolver` injecte l'utilisateur connecté quand l'argument est type-hinté `UserInterface`
- [ ] **B.** Pour type-hinter sa propre classe `User`, il faut ajouter l'attribut `#[CurrentUser]` à l'argument
- [ ] **C.** Les union types sont supportés, ex. `#[CurrentUser] Admin|Member $user`
- [ ] **D.** Si l'argument est non nullable et qu'aucun utilisateur n'est connecté, le resolver injecte `null`

### Question 84

Quelles affirmations sur la gestion et l'ordre des value resolvers sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Pour chaque argument, chaque resolver tagué `controller.argument_value_resolver` est appelé — dans l'ordre de leurs priorités — jusqu'à ce que l'un fournisse une valeur
- [ ] **B.** `#[ValueResolver(SessionValueResolver::class)]` posé sur un argument fait appeler ce resolver en premier ; le nom des resolvers natifs est leur FQCN
- [ ] **C.** L'argument `disabled: true` de `#[ValueResolver]` désactive un resolver ciblé — c'est ainsi que `MapEntity`, qui **étend** `ValueResolver`, permet de désactiver l'`EntityValueResolver`
- [ ] **D.** La commande `php bin/console debug:value-resolvers` liste les resolvers dans leur ordre d'exécution

### Question 85

Quelles affirmations sur la création d'un value resolver personnalisé sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il faut implémenter `ValueResolverInterface` et sa méthode `resolve()`, qui reçoit la `Request` et un `ArgumentMetadata`
- [ ] **B.** `resolve()` retourne un tableau vide quand le resolver ne peut pas résoudre l'argument
- [ ] **C.** `resolve()` doit toujours retourner un tableau, même pour une valeur unique — les arguments variadiques peuvent en recevoir plusieurs
- [ ] **D.** Le tag `controller.argument_value_resolver` doit être ajouté manuellement au service

### Question 86

Comment faire qu'un resolver personnalisé ne soit appelé que lorsqu'il est explicitement ciblé par un attribut `#[ValueResolver]` ? *(une seule bonne réponse)*

- [ ] **A.** Le taguer `controller.targeted_value_resolver`, ou lui poser l'attribut `#[AsTargetedValueResolver('mon_nom')]`
- [ ] **B.** Lui donner une priorité négative
- [ ] **C.** Ce n'est pas possible : tous les resolvers sont appelés pour chaque argument
- [ ] **D.** Le retirer de l'autoconfiguration dans `services.yaml`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Controller de la documentation Symfony 8.0](https://symfony.com/doc/8.0/controller.html). Pour les questions 61 à 86, le nom abrégé de la page annexe précède la section — ex. *(Error Pages — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

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

**Question 61 : A, B, C** — Le `TwigErrorRenderer` « look[s] for a template for the given status code (like `error500.html.twig`) ; if the previous template doesn't exist, discard the status code and look for a generic error template (`error.html.twig`) ». La surcharge suit le mécanisme standard des templates de bundle : `templates/bundles/TwigBundle/Exception/` (D faux). Prérequis : TwigBundle **et** TwigBridge (`composer require symfony/twig-pack`). *(Error Pages — § Overriding the Default Error Templates)*

**Question 62 : A, B, C** — « The `TwigErrorRenderer` passes some information to the error template via the `status_code` and `status_text` variables » ; l'objet `HttpException` est accessible via la variable `exception` (`{{ exception.message }}`, `{{ exception.traceAsString }}` — jamais pour l'utilisateur final, la trace contient des données sensibles). Astuce : sans `HttpExceptionInterface::getStatusCode()`, `status_code` vaut 500 par défaut. *(Error Pages — § Example 404 Error Template)*

**Question 63 : C** — « Due to the order of how routing and security are loaded, security information will **not** be available on your 404 pages » — l'utilisateur apparaît déconnecté. Piège supplémentaire de la doc : « it will work while testing, but not on production. » *(Error Pages — § Security & 404 Pages)*

**Question 64 : B** — L'`ErrorController` par défaut permet de prévisualiser les pages d'*erreur* via des routes de FrameworkBundle (préfixe `/_error`, chargées en `when@dev` — automatiquement avec Symfony Flex) : `/_error/{statusCode}` pour le HTML, `/_error/{statusCode}.{format}` pour les autres formats. *(Error Pages — § Testing Error Pages during Development)*

**Question 65 : D** — « If you want to change the output contents, create a new Normalizer that supports the `FlattenException` input » (`supportsNormalization()` → `$data instanceof FlattenException`). Le Serializer embarque déjà le `ProblemNormalizer` et des encodeurs JSON/XML/CSV/YAML. *(Error Pages — § Overriding Error output for non-HTML formats)*

**Question 66 : A, B, C** — On pointe son contrôleur via `framework.error_controller` ; c'est l'`ErrorListener` (listener de `kernel.exception`) qui crée la requête dispatchée, avec deux paramètres : `exception` (le `Throwable` original) et `logger` (`DebugLoggerInterface`, « may be `null` in some circumstances »). D est faux : « The error page preview also works for your own controllers set up this way. » *(Error Pages — § Overriding the Default ErrorController)*

**Question 67 : A, B, C** — `HttpKernel` attrape l'exception et dispatche `kernel.exception` ; « if your listener calls `setResponse()` on the `ExceptionEvent`, propagation will be stopped and the response will be sent to the client » ; l'approche permet « centralized and layered error handling ». D est faux : le mécanisme vaut pour toute exception — l'`ExceptionListener` du composant Security en est l'exemple réel cité (redirection vers le login sur `AccessDeniedException`, etc.). *(Error Pages — § Working with the kernel.exception Event)*

**Question 68 : A, B, C** — `APP_ENV=prod php bin/console error:dump var/cache/prod/error_pages/ [codes…]` : « by default, it generates the pages of all 4xx and 5xx errors, but you can pass a list of HTTP status codes » ; utile car « if an error occurs before reaching your Symfony application, web servers display their own default error pages ». D est faux : « You must also configure your web server to use these generated pages » — la config Nginx reste à écrire soi-même. *(Error Pages — § Dumping Error Pages as Static HTML Files)*

**Question 69 : A, B, C** — « Instead of redirecting the user's browser, this makes an "internal" sub-request and calls the defined controller » ; `forward()` retourne « the `Response` object that is returned from *that* controller » ; « the array passed to the method becomes the arguments for the resulting controller ». D est l'inverse de la doc : « the order of the arguments of the target method doesn't matter: the matching is done by name. » *(Forwarding)*

**Question 70 : C** — Note de la doc : « Twig's `app.current_route`, `app.current_route_parameters`, and `_route_params` will be empty after such a `->forward()` call. However, you can set them manually by adding a `_route` and `_route_params` keys to the array. » *(Forwarding)*

**Question 71 : A, B, C** — Les trois approches documentées « rely on the same underlying mechanism: they apply the `controller.service_arguments` tag to the controller service » — elles ne diffèrent que par la façon d'opter pour ce tag. `#[AsService]` (D) n'existe pas. *(Controllers as Services)*

**Question 72 : A, B, C** — Avec la config par défaut, les contrôleurs étendant `AbstractController` « *are* automatically registered as services » ; Symfony marque le service « public and non-lazy » ; public parce que « Symfony's controller resolver fetches them from the container by their service id at runtime ». D est faux : « using the `#[AsController]` attribute is redundant » quand `#[Route]` est déjà là. *(Controllers as Services)*

**Question 73 : B** — « Use the `service_id::method_name` syntax to refer to the controller method. » Si l'id de service est le FQCN, comme Symfony le recommande, « the syntax is the same as if the controller was not a service » : `App\Controller\HelloController::index`. *(Controllers as Services)*

**Question 74 : A, B, C** — « Any controller […] can also define a single action using the `__invoke()` method, which is a common practice when following the ADR pattern (Action-Domain-Responder) » ; avec `#[Route]` sur la classe, `__invoke()` « benefits from service argument injection just like any other action method ». D est faux : dans le routing, `controller: App\Controller\HelloController` suffit, sans `::__invoke`. *(Controllers as Services — § Invokable Controllers)*

**Question 75 : A, B, C** — Liste documentée : classes `#[AsController]`, classes étendant `AbstractController`, le `TemplateController` natif, et les services tagués `controller.service_arguments`. L'allowlist est vérifiée « when Symfony needs to verify their legitimacy (e.g. when rendering ESI fragments or using the fragment renderer) » ; pour les cas avancés, `allowControllers()` sur le service `controller_resolver`. *(Controllers as Services — § Controller Allowlist)*

**Question 76 : A, B, C** — `FileType` pour le widget d'upload ; « the trick to make it work is to add the form field as "unmapped", so Symfony doesn't try to get/set its value from the related entity » ; « unmapped fields can't define their validation using attributes in the associated entity, so you can use the PHP constraint classes » (option `constraints`). D est faux : la colonne est de type `string` « because it only stores the PDF file name instead of the file contents ». *(Upload Files)*

**Question 77 : A, B, C** — Les méthodes `getClientOriginal*()` et `getSize()` « are considered *not safe* because a malicious user could tamper that information. That's why it's always better to generate a unique name and use the `guessExtension()` method to let Symfony guess the right extension according to the file MIME type. » *(Upload Files)*

**Question 78 : A, B, C** — « Set the `multiple` option of `FileType` to `true`. The form field's data is then an array of `UploadedFile` instances […] so you must wrap the `File` constraint inside the `All` constraint to validate each uploaded file. » D est faux : « The `multiple` option automatically adds the `multiple` HTML attribute to the `<input type="file">` element, so no template changes are required. » *(Upload Files — § Uploading Multiple Files)*

**Question 79 : D** — « The file form type still expects a `File` instance. As the persisted entity now contains only the relative file path, you first have to concatenate the configured upload path with the stored filename and create a new `File` class. » *(Upload Files)*

**Question 80 : A** — « This is no longer recommended, because Doctrine events shouldn't be used for your domain logic » — s'y ajoutent la dépendance aux comportements internes de Doctrine et des risques de performance ; « as an alternative, you can use Symfony events, listeners and subscribers ». (VichUploaderBundle reste l'alternative communautaire citée pour tout gérer.) *(Upload Files — § Using a Doctrine Listener)*

**Question 81 : A, B, C** — `BackedEnumValueResolver` : « leads to a 404 Not Found response if the value isn't a valid backing value for the enum type » ; `UidValueResolver` : idem pour un UID invalide ; `DateTimeValueResolver` accepte tout ce que PHP sait parser comme date, restreignable avec `#[MapDateTime]` (et générée via le composant Clock — testable avec `MockClock`). D est faux : `EntityValueResolver` vient du **bridge Doctrine** (`Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver`). *(Value Resolvers — § Built-In Value Resolvers)*

**Question 82 : C** — Encadré 8.0 : « Automatic mapping of Doctrine entities to controller arguments has been removed. Use the `#[MapEntity]` attribute or the route mapping syntax (`{param:argument}`). » *(Value Resolvers — § Built-In Value Resolvers)*

**Question 83 : A, B, C** — `UserValueResolver` (SecurityBundle requis) injecte l'utilisateur courant sur un type-hint `UserInterface` ; « you can also type-hint your own `User` class but you must then add the `#[CurrentUser]` attribute » ; « union types are also supported » (`#[CurrentUser] Admin|Member $user`). D est faux : argument non nullable sans utilisateur connecté → « an `AccessDeniedException` is thrown by the resolver » (et pour `SecurityTokenValueResolver`, une `HttpException` 401). *(Value Resolvers — § Built-In Value Resolvers)*

**Question 84 : A, B, C** — « For each argument, every resolver tagged with `controller.argument_value_resolver` will be called until one provides a value », dans l'ordre de leurs priorités ; l'attribut `#[ValueResolver]` cible un resolver par son nom (« for convenience, built-in resolvers' name are their FQCN ») et le fait appeler en premier ; `disabled: true` le désactive — « this is how `MapEntity` allows you to disable the `EntityValueResolver` […] Yes, `MapEntity` extends `ValueResolver`! ». D est faux : la commande est `php bin/console debug:container debug.argument_resolver.inner`. *(Value Resolvers — § Managing Value Resolvers)*

**Question 85 : A, B, C** — `resolve(Request $request, ArgumentMetadata $argument): iterable` ; « the `resolve()` method should return either an empty array (if it cannot resolve this argument) or an array with the resolved value(s) […] you must always return an array, even for single values » (à cause des arguments variadiques). D est faux : « this tag is automatically added to every service implementing `ValueResolverInterface` » — on ne le déclare soi-même que pour changer `priority` ou `name` (repère : `RequestAttributeValueResolver` a la priorité 100). *(Value Resolvers — § Adding a Custom Value Resolver)*

**Question 86 : A** — « Set this tag [`controller.targeted_value_resolver`] if you want your resolver to be called only if it is targeted by a `ValueResolver` attribute. » Alternative : l'attribut `#[AsTargetedValueResolver('mon_nom')]`, le nom étant ensuite passé à `#[ValueResolver('mon_nom')]` sur l'argument. *(Value Resolvers — § controller.targeted_value_resolver)*

---

## Pour aller plus loin

Les sujets connexes listés en fin de la [page Controller](https://symfony.com/doc/8.0/controller.html#learn-more-about-controllers), couverts par les questions 61 à 86 :

- [How to Customize Error Pages](https://symfony.com/doc/8.0/controller/error_pages.html)
- [How to Forward Requests to another Controller](https://symfony.com/doc/8.0/controller/forwarding.html)
- [How to Define Controllers as Services](https://symfony.com/doc/8.0/controller/service.html)
- [How to Upload Files](https://symfony.com/doc/8.0/controller/upload_file.html)
- [Extending Action Argument Resolving](https://symfony.com/doc/8.0/controller/value_resolver.html)

