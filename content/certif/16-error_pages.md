# QCM — Personnaliser les pages d'erreur

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/controller/error_pages.html](https://symfony.com/doc/8.0/controller/error_pages.html) · **Généré le :** 21 juillet 2026
>
> **37 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Vue d'ensemble et pages d'exception

### Question 1

Comment Symfony traite-t-il toutes les erreurs, qu'il s'agisse d'une erreur 404 Not Found ou d'une erreur fatale déclenchée par une exception dans le code ? *(une seule bonne réponse)*

- [ ] **A.** Chaque type d'erreur a son propre mécanisme de traitement, indépendant les uns des autres
- [ ] **B.** Toutes les erreurs sont traitées comme des exceptions, sans distinction de leur origine
- [ ] **C.** Seules les erreurs 5xx sont traitées comme des exceptions, les 4xx étant gérées différemment
- [ ] **D.** Les erreurs ne sont traitées comme des exceptions qu'en environnement `dev`

### Question 2

Que montre Symfony en environnement de développement lorsqu'une exception survient ? *(une seule bonne réponse)*

- [ ] **A.** Directement la page d'erreur générique de production
- [ ] **B.** Une page d'exception spéciale contenant de nombreuses informations de débogage pour aider à trouver la cause du problème
- [ ] **C.** Une page blanche, sans aucune information
- [ ] **D.** Un simple code HTTP, sans corps de réponse

### Question 3

Pourquoi Symfony n'affiche-t-il pas cette page d'exception détaillée en environnement de production ? *(une seule bonne réponse)*

- [ ] **A.** Pour des raisons de performance uniquement
- [ ] **B.** Parce que ces pages contiennent beaucoup d'informations internes sensibles ; une page d'erreur minimale et générique est affichée à la place
- [ ] **C.** Parce que Twig n'est pas disponible en production
- [ ] **D.** Ce n'est pas vrai, la même page détaillée est affichée dans les deux environnements

### Question 4

Quelles sont les façons documentées de personnaliser les pages d'erreur de production, selon le besoin ? *(plusieurs bonnes réponses)*

- [ ] **A.** Surcharger les templates d'erreur par défaut, pour changer le contenu et le style
- [ ] **B.** Créer un nouveau normalizer, pour changer le contenu de la sortie d'erreur non-HTML
- [ ] **C.** Surcharger le contrôleur d'erreur par défaut, pour modifier la logique de génération des pages
- [ ] **D.** Utiliser l'événement `kernel.exception`, pour un contrôle total du traitement des exceptions

## Surcharger les templates d'erreur par défaut

### Question 5

Quels composants doivent être installés pour pouvoir surcharger les templates d'erreur par défaut, et quelle commande les installe ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Serializer uniquement, via `composer require symfony/serializer-pack`
- [ ] **B.** TwigBundle et TwigBridge, via `composer require symfony/twig-pack`
- [ ] **C.** Aucune installation supplémentaire n'est nécessaire
- [ ] **D.** Le composant ErrorHandler, via `composer require symfony/error-handler`

### Question 6

Quelle classe se charge de rendre le template Twig de la page d'erreur ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Bridge\Twig\ErrorRenderer\TwigErrorRenderer`
- [ ] **B.** `Symfony\Component\HttpKernel\EventListener\ErrorListener`
- [ ] **C.** `Symfony\Component\ErrorHandler\Exception\FlattenException`
- [ ] **D.** `Symfony\Component\Serializer\Normalizer\ProblemNormalizer`

### Question 7

Quelle logique ce renderer applique-t-il pour déterminer le nom du fichier de template à utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Il cherche toujours `error.html.twig`, sans jamais tenir compte du code de statut
- [ ] **B.** Il cherche d'abord un template spécifique au code de statut, par exemple `error500.html.twig` ; s'il n'existe pas, il se rabat sur un template générique (`error.html.twig`)
- [ ] **C.** Il génère dynamiquement le nom du template à partir du message d'exception
- [ ] **D.** Il utilise systématiquement un contrôleur PHP, jamais un template Twig

### Question 8

Où doit-on placer ses templates d'erreur personnalisés pour les faire prendre en compte ? *(une seule bonne réponse)*

- [ ] **A.** Directement à la racine de `templates/`
- [ ] **B.** Dans `templates/bundles/TwigBundle/Exception/`, selon la méthode standard de surcharge de templates d'un bundle
- [ ] **C.** Dans `templates/errors/`
- [ ] **D.** Dans `config/packages/twig/errors/`

### Question 9

Dans l'arborescence d'exemple (`error404.html.twig`, `error403.html.twig`, `error.html.twig`), à quoi sert précisément `error.html.twig` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement à l'erreur 500
- [ ] **B.** À toutes les erreurs HTML qui n'ont pas de template dédié, y compris la 500
- [ ] **C.** Uniquement aux erreurs 4xx
- [ ] **D.** C'est un template obsolète, à ne plus utiliser

### Question 10

Quelles variables Twig le `TwigErrorRenderer` transmet-il au template d'erreur pour donner des informations sur l'erreur HTTP ? *(une seule bonne réponse)*

- [ ] **A.** `http_code` et `http_message`
- [ ] **B.** `status_code` et `status_text`
- [ ] **C.** `error_code` uniquement
- [ ] **D.** Aucune variable n'est transmise automatiquement

### Question 11

Comment personnaliser le code de statut associé à une exception, et que vaut-il par défaut si rien n'est fait ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `HttpExceptionInterface` et sa méthode `getStatusCode()` ; sinon `status_code` vaut `500` par défaut
- [ ] **B.** En définissant une propriété publique `$statusCode` sur n'importe quelle exception
- [ ] **C.** Ce n'est pas personnalisable, le code est toujours déterminé par le serveur web
- [ ] **D.** En passant le code en second argument du constructeur de toute `\Exception`

## Exemple : template pour l'erreur 404

### Question 12

Comment accéder au message de l'exception dans le template d'erreur, par exemple pour afficher `'The product does not exist'` levé via `createNotFoundException()` ? *(une seule bonne réponse)*

- [ ] **A.** `{{ exception.message }}`, via la variable Twig `exception`
- [ ] **B.** `{{ error.text }}`
- [ ] **C.** Ce n'est jamais accessible depuis le template, pour des raisons de sécurité
- [ ] **D.** `{{ app.exception.getMessage() }}`

### Question 13

La documentation recommande-t-elle d'afficher `{{ exception.traceAsString }}` aux utilisateurs finaux ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est même encouragé pour aider au support utilisateur
- [ ] **B.** Non : c'est possible techniquement, mais déconseillé pour les utilisateurs finaux car la stack trace contient des données sensibles
- [ ] **C.** Cette propriété n'existe pas sur la variable `exception`
- [ ] **D.** Oui, mais uniquement en environnement `dev`

### Question 14

Les erreurs PHP natives, non levées explicitement via `throw`, sont-elles aussi accessibles via la variable `exception` du template ? *(une seule bonne réponse)*

- [ ] **A.** Non, seules les exceptions explicitement levées sont concernées
- [ ] **B.** Oui : les erreurs PHP sont, elles aussi, transformées en exceptions par défaut
- [ ] **C.** Uniquement les `TypeError`, pas les autres types d'erreurs PHP
- [ ] **D.** Uniquement en environnement `prod`

## Sécurité et pages 404

### Question 15

Pourquoi les informations de sécurité (utilisateur connecté, rôles…) ne sont-elles *pas* disponibles sur les pages 404 ? *(une seule bonne réponse)*

- [ ] **A.** À cause de l'ordre de chargement du routing et de la sécurité
- [ ] **B.** Parce que le firewall bloque systématiquement toutes les routes 404
- [ ] **C.** Ce n'est pas vrai, les informations de sécurité sont toujours disponibles
- [ ] **D.** Parce que la page 404 est rendue avant le démarrage du kernel

### Question 16

Concrètement, quel effet cette absence d'information de sécurité a-t-elle, et où cela se remarque-t-il différemment selon l'environnement ? *(une seule bonne réponse)*

- [ ] **A.** L'utilisateur apparaît comme déconnecté sur la page 404 — cela fonctionne correctement en phase de test, mais pas en production
- [ ] **B.** L'application plante systématiquement sur toute page 404
- [ ] **C.** L'utilisateur apparaît toujours comme connecté, même s'il ne l'est pas
- [ ] **D.** Le comportement est strictement identique en test et en production

## Tester les pages d'erreur en développement

### Question 17

Pourquoi est-il difficile, par défaut, de voir à quoi ressemble sa page d'erreur personnalisée pendant le développement ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'en environnement de développement, Symfony affiche la grande page d'*exception* plutôt que la page d'erreur personnalisée
- [ ] **B.** Parce que les templates d'erreur ne peuvent être testés qu'en production
- [ ] **C.** Parce que Twig désactive le rendu des templates d'erreur en mode debug
- [ ] **D.** Ce n'est pas difficile, il suffit de couper sa connexion internet pour provoquer une 404

### Question 18

Quelle fonctionnalité du `ErrorController` par défaut permet de prévisualiser ses pages d'erreur pendant le développement ? *(une seule bonne réponse)*

- [ ] **A.** Une commande `bin/console error:preview`
- [ ] **B.** Des routes spéciales fournies par FrameworkBundle, chargées automatiquement avec Symfony Flex à l'installation de `symfony/framework-bundle`
- [ ] **C.** Un panneau dédié dans la barre de débogage web
- [ ] **D.** Il faut désactiver le mode `dev` pour voir la page telle qu'elle sera en production

### Question 19

Quel est le format des URLs permettant de prévisualiser la page d'erreur pour un code de statut donné, en HTML ou dans un autre format ? *(une seule bonne réponse)*

- [ ] **A.** `/_error/{statusCode}` pour le HTML, `/_error/{statusCode}.{format}` pour un autre format
- [ ] **B.** `/error/preview/{statusCode}`
- [ ] **C.** `/_profiler/error/{statusCode}`
- [ ] **D.** `/_wdt/error/{statusCode}`

### Question 20

Ces routes de prévisualisation sont-elles chargées dans tous les environnements ? *(une seule bonne réponse)*

- [ ] **A.** Oui, y compris en production, pour des raisons de simplicité
- [ ] **B.** Non, elles sont chargées uniquement sous la condition `when@dev`
- [ ] **C.** Non, uniquement en environnement `test`
- [ ] **D.** Elles ne dépendent d'aucun environnement, seulement de Symfony Flex

## Surcharger la sortie d'erreur pour les formats non-HTML

### Question 21

Quel composant faut-il installer pour pouvoir surcharger la sortie d'erreur dans des formats non-HTML (JSON, XML…), et quelle commande l'installe ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Validator, via `composer require symfony/validator`
- [ ] **B.** Le composant Serializer, via `composer require symfony/serializer-pack`
- [ ] **C.** Le composant HttpClient, via `composer require symfony/http-client`
- [ ] **D.** Aucune installation supplémentaire n'est nécessaire, c'est fourni par HttpFoundation

### Question 22

Quel normalizer intégré au composant Serializer gère la conversion d'un `FlattenException`, et quels formats d'encodage sont disponibles nativement ? *(une seule bonne réponse)*

- [ ] **A.** `ProblemNormalizer`, avec les encoders JSON, XML, CSV et YAML
- [ ] **B.** `ExceptionNormalizer`, avec uniquement l'encoder JSON
- [ ] **C.** `ErrorNormalizer`, sans encoder particulier
- [ ] **D.** Il n'existe aucun normalizer intégré pour ce cas, il faut toujours en écrire un soi-même

### Question 23

Pour créer un normalizer personnalisé remplaçant le comportement par défaut, quelle méthode doit vérifier que l'entrée est bien une exception aplatie ? *(une seule bonne réponse)*

- [ ] **A.** `normalize()`, en vérifiant `$data instanceof \Throwable`
- [ ] **B.** `supportsNormalization()`, en vérifiant `$data instanceof FlattenException`
- [ ] **C.** `denormalize()`, en vérifiant le type de retour
- [ ] **D.** Un normalizer personnalisé n'a pas besoin de vérifier le type de l'entrée

## Surcharger l'ErrorController par défaut

### Question 24

Comment surcharger le contrôleur qui génère la page d'erreur, pour par exemple lui passer des variables additionnelles ? *(une seule bonne réponse)*

- [ ] **A.** En modifiant directement `Symfony\Component\HttpKernel\EventListener\ErrorListener`
- [ ] **B.** En créant un nouveau contrôleur puis en le référençant via l'option de configuration `framework.error_controller`
- [ ] **C.** Ce n'est pas possible, seule la surcharge de template est envisageable
- [ ] **D.** En renommant le contrôleur en `App\Controller\ErrorController`, détecté automatiquement par convention

### Question 25

Quelle classe crée la requête qui sera dispatchée vers ce contrôleur d'erreur personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpKernel\EventListener\ErrorListener`, écoutant l'événement `kernel.exception`
- [ ] **B.** `TwigErrorRenderer`
- [ ] **C.** Le contrôleur d'erreur lui-même, dans sa propre logique
- [ ] **D.** `RequestStack`, via une méthode dédiée `createErrorRequest()`

### Question 26

Quels paramètres sont automatiquement transmis au contrôleur d'erreur personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `exception`, l'instance `Throwable` d'origine, et `logger`, une instance de `DebugLoggerInterface` potentiellement `null`
- [ ] **B.** Uniquement `exception`, jamais de logger
- [ ] **C.** `request` et `response` uniquement
- [ ] **D.** `statusCode` et `statusText` sous forme de chaînes

### Question 27

La fonctionnalité de prévisualisation des pages d'erreur (`/_error/{statusCode}`) fonctionne-t-elle aussi avec un contrôleur d'erreur personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Non, elle ne fonctionne qu'avec le `ErrorController` par défaut
- [ ] **B.** Oui, elle fonctionne aussi avec un contrôleur d'erreur personnalisé configuré de cette façon
- [ ] **C.** Uniquement si le contrôleur personnalisé étend explicitement `ErrorController`
- [ ] **D.** Uniquement en environnement `prod`

## Travailler avec l'événement kernel.exception

### Question 28

Quel événement le kernel HTTP dispatche-t-il lorsqu'une exception est levée, et que permet-il de faire ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.exception`, qui permet de convertir l'exception en `Response` de différentes façons
- [ ] **B.** `kernel.terminate`, qui ne permet que de journaliser l'exception
- [ ] **C.** `kernel.controller`, qui relance automatiquement le contrôleur précédent
- [ ] **D.** Aucun événement n'est dispatché, la gestion des exceptions étant purement interne au kernel

### Question 29

Que permet de faire l'écriture d'un event listener personnalisé pour `kernel.exception`, dans le cas d'exceptions métier spécialisées ? *(une seule bonne réponse)*

- [ ] **A.** Regarder l'exception de plus près et prendre des actions différentes selon son type : journalisation, redirection, rendu de pages d'erreur spécialisées
- [ ] **B.** Uniquement modifier le message de l'exception avant qu'elle ne soit journalisée
- [ ] **C.** Empêcher totalement l'exception d'être journalisée
- [ ] **D.** Ce n'est utile que pour les exceptions de sécurité, aucun autre cas d'usage n'est cité

### Question 30

Que se passe-t-il si un listener appelle `setResponse()` sur l'objet `ExceptionEvent` ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, les autres listeners continuent à être appelés normalement
- [ ] **B.** La propagation de l'événement est arrêtée, et la réponse définie est envoyée au client
- [ ] **C.** Cela lève une nouvelle exception
- [ ] **D.** Cela force un code de statut 500, quel que soit le contenu de la réponse

### Question 31

Quel est l'intérêt de centraliser le traitement des exceptions dans un ou plusieurs listeners de `kernel.exception`, plutôt que de les intercepter dans chaque contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Cela évite de dupliquer la même logique de capture/traitement d'exception dans de multiples contrôleurs, au profit d'un traitement centralisé et en couches
- [ ] **B.** Cela améliore uniquement les performances, sans bénéfice d'architecture
- [ ] **C.** Un seul listener peut exister par application, ce qui simplifie forcément le code
- [ ] **D.** Cela ne concerne que les exceptions de validation de formulaire

### Question 32

Quel exemple concret de listener avancé sur `kernel.exception` la documentation cite-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Le `ExceptionListener` du composant Security, qui gère des exceptions comme `AccessDeniedException` et prend des mesures telles que rediriger vers la page de login ou déconnecter l'utilisateur
- [ ] **B.** Le `DebugProcessor` de Monolog
- [ ] **C.** Le `TwigErrorRenderer`
- [ ] **D.** Aucun exemple concret n'est fourni dans la documentation

## Générer des pages d'erreur statiques en HTML

### Question 33

Pourquoi générer ses pages d'erreur en fichiers HTML statiques, plutôt que de toujours passer par l'application Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement pour réduire la taille du dépôt Git
- [ ] **B.** Parce que si une erreur survient avant même d'atteindre l'application Symfony, c'est le serveur web qui affiche ses propres pages par défaut ; générer des pages statiques garantit que l'utilisateur voit toujours les pages personnalisées, tout en améliorant la performance
- [ ] **C.** Parce que Twig ne peut pas être utilisé en production
- [ ] **D.** Parce que les pages HTML statiques sont les seules compatibles avec HTTPS

### Question 34

Quelle commande génère les pages d'erreur statiques, et quels codes HTTP couvre-t-elle par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console error:dump <chemin>` ; par défaut, tous les codes 4xx et 5xx
- [ ] **B.** `php bin/console cache:warmup --errors`
- [ ] **C.** `php bin/console assets:install --errors`
- [ ] **D.** `php bin/console debug:router --errors`

### Question 35

Peut-on ne générer les pages statiques que pour certains codes HTTP précis ? *(une seule bonne réponse)*

- [ ] **A.** Non, c'est tout ou rien
- [ ] **B.** Oui, en passant la liste des codes HTTP souhaités en argument de la commande, par exemple `error:dump <chemin> 401 403 404 500`
- [ ] **C.** Oui, mais uniquement via un fichier de configuration YAML dédié
- [ ] **D.** Oui, mais uniquement pour un seul code à la fois

### Question 36

Une fois les pages statiques générées, que reste-t-il à faire pour qu'elles soient effectivement utilisées ? *(une seule bonne réponse)*

- [ ] **A.** Rien, Symfony les sert automatiquement dès qu'elles existent sur le disque
- [ ] **B.** Configurer le serveur web, par exemple Nginx, pour qu'il utilise ces pages générées via ses propres directives d'erreur
- [ ] **C.** Redémarrer PHP-FPM uniquement, sans autre configuration
- [ ] **D.** Les copier manuellement dans `public/`, aucune configuration serveur n'étant nécessaire

### Question 37

Dans l'exemple de configuration Nginx donné, à quoi sert la directive `internal;` sur le bloc `location ^~ /error_pages/` ? *(une seule bonne réponse)*

- [ ] **A.** À activer la compression gzip pour ces fichiers
- [ ] **B.** À empêcher l'accès direct par URL à ce répertoire, ces pages ne devant être servies que via la redirection `error_page`
- [ ] **C.** À forcer HTTPS sur ces pages
- [ ] **D.** À rediriger automatiquement vers la page d'accueil

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page How to Customize Error Pages de la documentation Symfony 8.0](https://symfony.com/doc/8.0/controller/error_pages.html).

**Question 1 : B** — « In Symfony applications, all errors are treated as exceptions, no matter if they are a 404 Not Found error or a fatal error triggered by throwing some exception in your code. » *(introduction)*

**Question 2 : B** — « In the development environment, Symfony catches all the exceptions and displays a special exception page with lots of debug information to help you discover the root problem. » *(introduction)*

**Question 3 : B** — « Since these pages contain a lot of sensitive internal information, Symfony won't display them in the production environment. Instead, it'll show a minimal and generic error page. » *(introduction)*

**Question 4 : A, B, C, D** — Les quatre approches sont explicitement listées : surcharger les templates d'erreur, créer un nouveau normalizer, surcharger le contrôleur d'erreur, ou utiliser l'événement `kernel.exception`. *(introduction)*

**Question 5 : B** — « You can use the built-in Twig error renderer to override the default error templates. Both the TwigBundle and TwigBridge need to be installed for this. Run this command to ensure both are installed: $ composer require symfony/twig-pack ». *(§ Overriding the Default Error Templates)*

**Question 6 : A** — « When the error page loads, TwigErrorRenderer is used to render a Twig template to show the user. » *(§ Overriding the Default Error Templates)*

**Question 7 : B** — « Look for a template for the given status code (like error500.html.twig); If the previous template doesn't exist, discard the status code and look for a generic error template (error.html.twig). » *(§ Overriding the Default Error Templates)*

**Question 8 : B** — « To override these templates, rely on the standard Symfony method for overriding templates that live inside a bundle and put them in the templates/bundles/TwigBundle/Exception/ directory. » *(§ Overriding the Default Error Templates)*

**Question 9 : B** — Dans l'arborescence d'exemple : « error.html.twig # All other HTML errors (including 500) ». *(§ Overriding the Default Error Templates)*

**Question 10 : B** — « the TwigErrorRenderer passes some information to the error template via the status_code and status_text variables that store the HTTP status code and message respectively. » *(§ Example 404 Error Template)*

**Question 11 : A** — « You can customize the status code of an exception by implementing HttpExceptionInterface and its required getStatusCode() method. Otherwise, the status_code will default to 500. » *(§ Example 404 Error Template)*

**Question 12 : A** — « if the exception sets a message (e.g. using throw $this->createNotFoundException('The product does not exist')), use {{ exception.message }} to print that message. » *(§ Example 404 Error Template)*

**Question 13 : B** — « You can also output the stack trace using {{ exception.traceAsString }}, but don't do that for end users because the trace contains sensitive data. » *(§ Example 404 Error Template)*

**Question 14 : B** — « PHP errors are turned into exceptions as well by default, so you can also access these error details using exception. » *(§ Example 404 Error Template)*

**Question 15 : A** — « Due to the order of how routing and security are loaded, security information will not be available on your 404 pages. » *(§ Security & 404 Pages)*

**Question 16 : A** — « This means that it will appear as if your user is logged out on the 404 page (it will work while testing, but not on production). » *(§ Security & 404 Pages)*

**Question 17 : A** — « While you're in the development environment, Symfony shows the big exception page instead of your shiny new customized error page. » *(§ Testing Error Pages during Development)*

**Question 18 : B** — « the default ErrorController allows you to preview your error pages during development. To use this feature, you need to load some special routes provided by FrameworkBundle (if the application uses Symfony Flex they are loaded automatically when installing symfony/framework-bundle). » *(§ Testing Error Pages during Development)*

**Question 19 : A** — « http://localhost/_error/{statusCode} for HTML […] http://localhost/_error/{statusCode}.{format} for any other format ». *(§ Testing Error Pages during Development)*

**Question 20 : B** — Exemple de configuration des routes : `when@dev: _errors: resource: '@FrameworkBundle/Resources/config/routing/errors.php' …`. *(§ Testing Error Pages during Development)*

**Question 21 : B** — « To override non-HTML error output, the Serializer component needs to be installed. $ composer require symfony/serializer-pack ». *(§ Overriding Error output for non-HTML formats)*

**Question 22 : A** — « The Serializer component has a built-in FlattenException normalizer (ProblemNormalizer) and JSON/XML/CSV/YAML encoders. » *(§ Overriding Error output for non-HTML formats)*

**Question 23 : B** — « public function supportsNormalization($data, ?string $format = null, array $context = []): bool { return $data instanceof FlattenException; } » *(§ Overriding Error output for non-HTML formats)*

**Question 24 : B** — « create a new controller anywhere in your application and set the framework.error_controller configuration option to point to it. » *(§ Overriding the Default ErrorController)*

**Question 25 : A** — « The ErrorListener class used by the FrameworkBundle as a listener of the kernel.exception event creates the request that will be dispatched to your controller. » *(§ Overriding the Default ErrorController)*

**Question 26 : A** — « your controller will be passed two parameters: exception — The original Throwable instance being handled. logger — A DebugLoggerInterface instance which may be null in some circumstances. » *(§ Overriding the Default ErrorController)*

**Question 27 : B** — « The error page preview also works for your own controllers set up this way. » *(§ Overriding the Default ErrorController)*

**Question 28 : A** — « When an exception is thrown, the HttpKernel class catches it and dispatches a kernel.exception event. This gives you the power to convert the exception into a Response in a few different ways. » *(§ Working with the kernel.exception Event)*

**Question 29 : A** — « Writing your own event listener for the kernel.exception event allows you to have a closer look at the exception and take different actions depending on it. Those actions might include logging the exception, redirecting the user to another page or rendering specialized error pages. » *(§ Working with the kernel.exception Event)*

**Question 30 : B** — « If your listener calls setResponse() on the ExceptionEvent event, propagation will be stopped and the response will be sent to the client. » *(§ Working with the kernel.exception Event)*

**Question 31 : A** — « This approach allows you to create centralized and layered error handling: instead of catching (and handling) the same exceptions in various controllers time and again, you can have just one (or several) listeners deal with them. » *(§ Working with the kernel.exception Event)*

**Question 32 : A** — « See Symfony\Component\Security\Http\Firewall\ExceptionListener class code for a real example of an advanced listener of this type. This listener handles various security-related exceptions […] and takes measures like redirecting the user to the login page, logging them out and other things. » *(§ Working with the kernel.exception Event)*

**Question 33 : B** — « If an error occurs before reaching your Symfony application, web servers display their own default error pages instead of your custom ones. Dumping your application's error pages to static HTML ensures users always see your defined pages and improves performance by allowing the server to deliver errors instantly without calling your application. » *(§ Dumping Error Pages as Static HTML Files)*

**Question 34 : A** — « $ APP_ENV=prod php bin/console error:dump var/cache/prod/error_pages/ … by default, it generates the pages of all 4xx and 5xx errors ». *(§ Dumping Error Pages as Static HTML Files)*

**Question 35 : B** — « but you can pass a list of HTTP status codes to only generate those: $ APP_ENV=prod php bin/console error:dump var/cache/prod/error_pages/ 401 403 404 500 ». *(§ Dumping Error Pages as Static HTML Files)*

**Question 36 : B** — « You must also configure your web server to use these generated pages. For example, if you use Nginx: […] » *(§ Dumping Error Pages as Static HTML Files)*

**Question 37 : B** — « location ^~ /error_pages/ { root /path/to/your/symfony/var/cache/error_pages; internal; # prevent direct URL access } » *(§ Dumping Error Pages as Static HTML Files)*
