# QCM — Les événements et l'EventDispatcher

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/event_dispatcher.html](https://symfony.com/doc/8.0/event_dispatcher.html) (questions 1 à 26) et les ressources de sa section [Learn More](https://symfony.com/doc/8.0/event_dispatcher.html#learn-more) (questions 27 à 45) · **Généré le :** 19 juillet 2026
>
> **45 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Événements et listeners

### Question 1

Quelles affirmations sur le système d'événements de Symfony sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony déclenche plusieurs événements liés au kernel pendant le traitement de la requête HTTP
- [ ] **B.** Les bundles tiers peuvent aussi dispatcher leurs propres événements
- [ ] **C.** L'application peut dispatcher des événements personnalisés depuis son propre code
- [ ] **D.** Seuls les événements prédéfinis par le framework peuvent exister

### Question 2

Quel tag de service faut-il pour enregistrer une classe comme event listener via la configuration ? *(une seule bonne réponse)*

- [ ] **A.** `event.listener`
- [ ] **B.** Implémenter l'interface `EventListenerInterface` suffit
- [ ] **C.** `kernel.event_listener`
- [ ] **D.** Aucun : toute classe du répertoire `src/EventListener/` est automatiquement un listener

### Question 3

Sans attribut `method` ni `event` sur le tag `kernel.event_listener`, quelle logique Symfony suit-il pour choisir la méthode à appeler ? *(plusieurs bonnes réponses)*

- [ ] **A.** Si le tag définit l'attribut `method`, c'est cette méthode qui est appelée
- [ ] **B.** Sinon, Symfony tente d'appeler la méthode magique `__invoke()` (listener invokable)
- [ ] **C.** Si `__invoke()` n'existe pas non plus, une exception est levée
- [ ] **D.** Sinon, Symfony appelle la méthode `handle()`

### Question 4

Quelles affirmations sur l'attribut `event` du tag `kernel.event_listener` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il est utile quand l'argument `$event` du listener n'est **pas** typé
- [ ] **B.** Le configurer change le type de l'objet `$event` reçu (ex. `ExceptionEvent` pour `kernel.exception`)
- [ ] **C.** Il ajoute une convention de nommage : sans `method`, Symfony cherche `on` + nom de l'événement en PascalCase (ex. `onKernelException()` pour `kernel.exception`)
- [ ] **D.** Il est obligatoire sur tout tag `kernel.event_listener`

### Question 5

Quelles affirmations sur la priorité des listeners sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** C'est un entier positif ou négatif, avec `0` comme valeur par défaut
- [ ] **B.** Plus le nombre est élevé, plus tôt le listener est exécuté
- [ ] **C.** Les priorités des listeners internes de Symfony vont généralement de `-256` à `256`, mais les vôtres peuvent utiliser n'importe quel entier
- [ ] **D.** Deux listeners ne peuvent pas partager la même priorité sur un même événement

## L'attribut AsEventListener

### Question 6

Quel est le FQCN de l'attribut `#[AsEventListener]` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpKernel\Attribute\AsEventListener`
- [ ] **B.** `Symfony\Component\EventDispatcher\Attribute\AsEventListener`
- [ ] **C.** `Symfony\Contracts\EventDispatcher\Attribute\AsEventListener`
- [ ] **D.** `Symfony\Component\EventDispatcher\AsEventListener`

### Question 7

Quelles affirmations sur `#[AsEventListener]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Posé sur la classe, il configure le listener sans aucune configuration dans des fichiers externes
- [ ] **B.** Plusieurs attributs `#[AsEventListener]` peuvent être posés sur une même classe pour configurer différentes méthodes
- [ ] **C.** Il peut aussi être posé directement sur des méthodes
- [ ] **D.** Son paramètre `event` est toujours obligatoire

### Question 8

Une classe porte `#[AsEventListener(event: 'foo', priority: 42)]` sans paramètre `method`. Quelle méthode sera appelée ? *(une seule bonne réponse)*

- [ ] **A.** `onFoo()` — le `method` par défaut est `on` + nom de l'événement avec majuscule
- [ ] **B.** `__invoke()`
- [ ] **C.** `foo()`
- [ ] **D.** `handleFoo()`

### Question 9

Comment une même méthode de listener peut-elle écouter plusieurs événements ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible : une méthode ne peut écouter qu'un seul événement
- [ ] **B.** Avec une option `events: […]` du tag
- [ ] **C.** En dupliquant la méthode sous deux noms
- [ ] **D.** En type-hintant l'argument avec un union type : `#[AsEventListener] public function onMultipleCustomEvent(CustomEvent|AnotherCustomEvent $event)`

## Les event subscribers

### Question 10

Quelles affirmations sur les event subscribers sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un subscriber implémente `EventSubscriberInterface`
- [ ] **B.** Il définit la méthode **statique** `getSubscribedEvents()`
- [ ] **C.** La différence principale avec les listeners : le subscriber connaît lui-même les événements qu'il écoute
- [ ] **D.** Un subscriber ne peut écouter qu'un seul événement

### Question 11

Que retourne `getSubscribedEvents()` ? *(une seule bonne réponse)*

- [ ] **A.** Une liste de noms de méthodes ; Symfony déduit les événements des type-hints
- [ ] **B.** Un tableau indexé par noms d'événements, dont les valeurs sont un nom de méthode, ou des tableaux `[méthode, priorité]`
- [ ] **C.** Un objet `SubscribedEventCollection`
- [ ] **D.** Un générateur de closures

### Question 12

Un subscriber déclare sur `ExceptionEvent::class` : `['processException', 10]`, `['logException', 0]`, `['notifyException', -10]`. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'ordre d'appel est `processException`, `logException`, `notifyException` (priorité décroissante)
- [ ] **B.** La priorité est **agrégée** entre tous les listeners et subscribers de l'application
- [ ] **C.** Ces méthodes peuvent donc être appelées avant ou après celles définies dans d'autres listeners et subscribers
- [ ] **D.** Les trois méthodes d'un même subscriber sont toujours appelées consécutivement, sans qu'un autre listener puisse s'intercaler

### Question 13

Votre subscriber n'est jamais appelé. Que recommande la documentation de vérifier ? *(une seule bonne réponse)*

- [ ] **A.** Que les services du répertoire `EventSubscriber/` sont bien chargés et qu'`autoconfigure` est activé — sinon, ajouter manuellement le tag `kernel.event_subscriber`
- [ ] **B.** Que la classe implémente aussi `EventListenerInterface`
- [ ] **C.** Que le subscriber est déclaré dans `config/packages/framework.yaml`
- [ ] **D.** Que la méthode `getSubscribedEvents()` n'est pas statique

## Sous-requêtes, choix et alias

### Question 14

Pourquoi un listener sur un événement kernel peut-il avoir besoin d'appeler `$event->isMainRequest()` ? *(une seule bonne réponse)*

- [ ] **A.** Pour vérifier que la requête vient bien d'un navigateur
- [ ] **B.** Pour détecter les requêtes Ajax
- [ ] **C.** Parce qu'une même page peut déclencher plusieurs requêtes : une principale et des sous-requêtes (typiquement l'embedding de contrôleurs dans les templates), qu'on ne veut souvent pas traiter
- [ ] **D.** Pour distinguer les requêtes HTTP des commandes console

### Question 15

Quelles affirmations la documentation fait-elle dans « Listeners or Subscribers » ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les deux peuvent être utilisés indifféremment dans la même application
- [ ] **B.** Les subscribers sont plus faciles à réutiliser, la connaissance des événements restant dans la classe — c'est pourquoi Symfony les utilise en interne
- [ ] **C.** Les listeners sont plus flexibles : les bundles peuvent les activer ou les désactiver conditionnellement selon une valeur de configuration
- [ ] **D.** Les subscribers sont sensiblement plus performants que les listeners

### Question 16

Quelles affirmations sur les alias d'événements sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les événements core peuvent être référencés par le FQCN de leur classe d'événement (ex. `RequestEvent::class` au lieu de `kernel.request`)
- [ ] **B.** En interne, les FQCN sont traités comme des alias des noms d'origine, résolus dès la compilation du container
- [ ] **C.** En inspectant le dispatcher, ces listeners apparaissent sous le **nom d'origine** de l'événement
- [ ] **D.** `AddEventAliasesPass` remplace la liste d'alias existante à chaque enregistrement

### Question 17

Comment ajouter un alias pour un événement personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `framework.events.aliases` de la configuration
- [ ] **B.** En enregistrant le compiler pass `AddEventAliasesPass` (ex. dans `Kernel::build()`) avec le mapping `MyCustomEvent::class => 'my_custom_event'`
- [ ] **C.** En définissant une constante `ALIAS` dans la classe d'événement
- [ ] **D.** Ce n'est pas possible pour les événements personnalisés

## Déboguer les listeners

### Question 18

Quelles utilisations de `debug:event-dispatcher` la documentation présente-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sans argument, la commande affiche tous les événements et leurs listeners
- [ ] **B.** Avec un nom d'événement (`debug:event-dispatcher kernel.exception`), elle affiche les listeners de cet événement
- [ ] **C.** Elle accepte une correspondance partielle : `kernel` matche `kernel.exception`, `kernel.response`… et `Security` matche les FQCN des événements de sécurité
- [ ] **D.** L'option `--dispatcher=security.event_dispatcher.main` affiche les listeners d'un event dispatcher particulier

### Question 19

Pourquoi l'option `--dispatcher` de `debug:event-dispatcher` existe-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le système de sécurité utilise un event dispatcher **par firewall**
- [ ] **B.** Parce que chaque bundle possède son propre dispatcher
- [ ] **C.** Pour basculer entre les environnements `dev` et `prod`
- [ ] **D.** Pour déboguer les dispatchers des applications tierces

## Filtres before/after

### Question 20

Symfony définit-il des méthodes de hook `preExecute()` / `postExecute()` autour des contrôleurs ? *(une seule bonne réponse)*

- [ ] **A.** Oui, sur `AbstractController`
- [ ] **B.** Oui, via le trait `FilterableControllerTrait`
- [ ] **C.** Non, mais MakerBundle peut les générer
- [ ] **D.** Non — « there is no such thing in Symfony » : on utilise l'EventDispatcher pour intervenir dans le processus Request → Response

### Question 21

Quel événement utiliser pour un filtre « before », exécuté juste avant l'action du contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.request`
- [ ] **B.** `kernel.controller` (alias `KernelEvents::CONTROLLER`), notifié à chaque requête juste avant l'exécution du contrôleur
- [ ] **C.** `kernel.view`
- [ ] **D.** `kernel.finish_request`

### Question 22

Dans la recette de validation de token de la documentation, quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une **interface vide** (`TokenAuthenticatedController`) sert de marqueur pour identifier les contrôleurs à vérifier
- [ ] **B.** Quand la classe de contrôleur définit plusieurs actions, `$event->getController()` retourne un tableau `[$controllerInstance, 'methodName']`
- [ ] **C.** Si le token est invalide, le subscriber lève une `AccessDeniedHttpException`
- [ ] **D.** Le marquage des contrôleurs doit obligatoirement se faire via un attribut PHP

### Question 23

Quel événement utiliser pour un filtre « after », exécuté après que le contrôleur a produit sa réponse ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.terminate`
- [ ] **B.** `kernel.post_controller`
- [ ] **C.** `kernel.response` (alias `KernelEvents::RESPONSE`), notifié à chaque requête après que le contrôleur retourne un objet `Response`
- [ ] **D.** `kernel.finish_request`

### Question 24

Dans cette recette, comment le hook « after » (`onKernelResponse`) sait-il que la requête a passé l'authentification par token dans le hook « before » ? *(une seule bonne réponse)*

- [ ] **A.** Via une propriété statique du subscriber
- [ ] **B.** Via la session
- [ ] **C.** Via une variable globale
- [ ] **D.** Via les **attributs de la requête** : `$event->getRequest()->attributes->set('auth_token', $token)`, relu ensuite dans `onKernelResponse()`

## Customiser une méthode sans héritage

### Question 25

Comment la documentation propose-t-elle de rendre le comportement d'une méthode extensible **sans héritage** ? *(une seule bonne réponse)*

- [ ] **A.** En dispatchant un événement au début et à la fin de la méthode (ex. `mailer.pre_send` et `mailer.post_send`) — les listeners peuvent lire et modifier les arguments et la valeur de retour
- [ ] **B.** En rendant la méthode `final` et en fournissant un trait
- [ ] **C.** En passant obligatoirement par la décoration de service
- [ ] **D.** En utilisant la réflexion PHP

### Question 26

Quel type-hint utiliser pour injecter l'event dispatcher, selon le tip de la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une des interfaces du dispatcher, plutôt que la classe concrète `EventDispatcher`
- [ ] **B.** `Symfony\Contracts\EventDispatcher\EventDispatcherInterface` quand on a seulement besoin de **dispatcher** des événements
- [ ] **C.** `Symfony\Component\EventDispatcher\EventDispatcherInterface` quand on doit aussi **inspecter ou gérer** les listeners (`addListener()`, `removeListener()`)
- [ ] **D.** Les deux interfaces sont identiques, seul le namespace change

---

> Les questions 27 à 45 couvrent les ressources listées dans la section [Learn More](https://symfony.com/doc/8.0/event_dispatcher.html#learn-more) de la page (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Les événements kernel intégrés

### Question 27

Chaque événement du HttpKernel est une sous-classe de `KernelEvent`. Quelles méthodes cette classe de base expose-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getRequest()` — la `Request` en cours de traitement
- [ ] **B.** `isMainRequest()` et `getRequestType()` (`MAIN_REQUEST` / `SUB_REQUEST`)
- [ ] **C.** `getKernel()` — le kernel qui traite la requête
- [ ] **D.** `getResponse()` — la réponse en cours de construction

### Question 28

Quand `kernel.request` est-il dispatché, et à quoi sert-il ? *(une seule bonne réponse)*

- [ ] **A.** Après la résolution du contrôleur, pour en modifier les arguments
- [ ] **B.** Très tôt, **avant** que le contrôleur soit déterminé — utile pour enrichir la `Request` ou retourner une `Response` immédiatement et court-circuiter le traitement
- [ ] **C.** Après l'exécution du contrôleur, pour modifier la réponse
- [ ] **D.** Uniquement quand une erreur survient

### Question 29

Quelles affirmations sur `kernel.controller` (`ControllerEvent`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il est dispatché après que le contrôleur a été résolu, mais avant son exécution
- [ ] **B.** `$event->setController()` permet de remplacer le contrôleur par n'importe quel callable PHP
- [ ] **C.** Il est utile pour initialiser ce dont le contrôleur aura besoin (ex. les value resolvers)
- [ ] **D.** Il permet de modifier les arguments qui seront passés au contrôleur

### Question 30

Que permet l'événement `kernel.controller_arguments` (`ControllerArgumentsEvent`) ? *(une seule bonne réponse)*

- [ ] **A.** De changer la route qui a matché
- [ ] **B.** De valider le corps de la requête
- [ ] **C.** De configurer les arguments passés au contrôleur, juste avant son appel, via `$event->setArguments()`
- [ ] **D.** De transformer la valeur de retour du contrôleur en `Response`

### Question 31

Quand `kernel.view` est-il dispatché ? *(une seule bonne réponse)*

- [ ] **A.** **Seulement** quand le contrôleur ne retourne pas un objet `Response` — pour transformer la valeur retournée (`$event->getControllerResult()`) en `Response`
- [ ] **B.** Après chaque contrôleur, systématiquement
- [ ] **C.** Quand le template Twig demandé n'existe pas
- [ ] **D.** Avant `kernel.controller`

### Question 32

Quelles affirmations sur la fin du cycle requête-réponse sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `kernel.response` permet de modifier ou remplacer la réponse avant son envoi (headers, cookies…)
- [ ] **B.** `kernel.finish_request`, dispatché après `kernel.response`, sert à réinitialiser l'état global (ex. le listener du translator restaure la locale de la requête parente)
- [ ] **C.** `kernel.terminate`, dispatché **après l'envoi de la réponse**, sert aux tâches lentes qui n'ont pas besoin d'être terminées pour répondre (ex. envoi d'emails)
- [ ] **D.** `kernel.terminate` est l'endroit recommandé pour modifier les headers de la réponse

### Question 33

Sur `kernel.exception`, quelle logique Symfony suit-il pour déterminer le code de statut HTTP de la réponse ? *(plusieurs bonnes réponses)*

- [ ] **A.** Si la `Response` posée est une erreur client, une erreur serveur ou une redirection (`isClientError()`/`isServerError()`/`isRedirect()`), son code est utilisé
- [ ] **B.** Si l'exception implémente `HttpExceptionInterface`, `getStatusCode()` est utilisé et les headers de `getHeaders()` sont ajoutés
- [ ] **C.** Sinon, le code 500 est utilisé
- [ ] **D.** Une `Response('No Content', 204)` posée dans l'événement est toujours envoyée avec le code 204, sans autre précaution

## Annexe — Les événements de sécurité

### Question 34

Quelles affirmations sur les dispatchers du système de sécurité sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Chaque firewall possède son propre event dispatcher (`security.event_dispatcher.FIREWALLNAME`)
- [ ] **B.** Les événements sont dispatchés à la fois sur le dispatcher global et sur celui du firewall
- [ ] **C.** Pour n'écouter qu'un firewall précis, on tague le subscriber `kernel.event_subscriber` avec l'attribut `dispatcher: security.event_dispatcher.main`
- [ ] **D.** Un unique dispatcher global gère tous les firewalls

### Question 35

Quelles affirmations sur les événements du processus d'authentification sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `CheckPassportEvent` est dispatché après la création du passport ; ses listeners effectuent les vérifications d'authentification réelles (validation du passport, token CSRF…)
- [ ] **B.** `AuthenticationSuccessEvent` est le **dernier** événement pouvant faire échouer l'authentification, en levant une `AuthenticationException`
- [ ] **C.** `LoginSuccessEvent` et `LoginFailureEvent` permettent de modifier la réponse renvoyée à l'utilisateur
- [ ] **D.** `AuthenticationTokenCreatedEvent` est dispatché **avant** la validation du passport

### Question 36

Quel événement n'est dispatché que lorsque l'authenticator implémente `InteractiveAuthenticatorInterface` (connexion par action explicite de l'utilisateur, ex. formulaire de login) ? *(une seule bonne réponse)*

- [ ] **A.** `LoginSuccessEvent`
- [ ] **B.** `CheckPassportEvent`
- [ ] **C.** `SwitchUserEvent`
- [ ] **D.** `InteractiveLoginEvent`

### Question 37

Quel événement est dispatché quand un utilisateur est déauthentifié, par exemple parce que son mot de passe a changé ? *(une seule bonne réponse)*

- [ ] **A.** `LogoutEvent`
- [ ] **B.** `TokenDeauthenticatedEvent`
- [ ] **C.** `SwitchUserEvent`
- [ ] **D.** `LoginFailureEvent`

## Annexe — Le composant EventDispatcher

### Question 38

Quels design patterns le composant EventDispatcher implémente-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Singleton et Factory
- [ ] **B.** Strategy et Decorator
- [ ] **C.** **Mediator** et **Observer**
- [ ] **D.** Adapter et Proxy

### Question 39

Quelles affirmations sur `$dispatcher->addListener()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle prend jusqu'à trois arguments : le nom de l'événement, un callable PHP, et une priorité optionnelle (défaut `0`)
- [ ] **B.** Plus la priorité est élevée, plus tôt le listener est appelé ; à priorité égale, l'ordre d'ajout est respecté
- [ ] **C.** Une closure peut être enregistrée comme listener
- [ ] **D.** Seuls les objets implémentant une interface de listener dédiée sont acceptés

### Question 40

`$dispatcher->dispatch($event)` est appelé **sans** second argument. Quel nom d'événement est utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Le FQCN de la classe de l'objet événement
- [ ] **B.** Aucun : une exception est levée
- [ ] **C.** Le nom générique `event`
- [ ] **D.** La valeur de la constante `NAME` de la classe, obligatoire

### Question 41

Quelles affirmations sur la création d'un événement personnalisé sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La classe d'événement étend `Symfony\Contracts\EventDispatcher\Event`
- [ ] **B.** Elle transporte les données utiles aux listeners via ses propres méthodes (ex. `getOrder()`)
- [ ] **C.** Sans donnée à transmettre, on peut dispatcher la classe `Event` de base et documenter le nom dans une classe de constantes dédiée (ex. `StoreEvents::ORDER_PLACED`, à la manière de `KernelEvents`)
- [ ] **D.** Toute classe d'événement doit obligatoirement définir une constante `NAME`

### Question 42

Quelles affirmations sur l'arrêt de la propagation d'un événement sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un listener l'obtient en appelant `$event->stopPropagation()`
- [ ] **B.** Les listeners de cet événement pas encore appelés ne le seront pas
- [ ] **C.** Le code qui a dispatché l'événement peut le détecter avec `$event->isPropagationStopped()`
- [ ] **D.** `stopPropagation()` annule aussi les effets des listeners déjà exécutés

### Question 43

Quels arguments le dispatcher passe-t-il à un listener qui les demande tous ? *(une seule bonne réponse)*

- [ ] **A.** L'événement uniquement
- [ ] **B.** L'événement et le container
- [ ] **C.** L'événement et le kernel
- [ ] **D.** L'événement, le **nom** de l'événement, et une référence au **dispatcher** lui-même

### Question 44

Hors framework (container standalone), que faut-il pour que les tags `kernel.event_listener` et `kernel.event_subscriber` soient pris en compte ? *(une seule bonne réponse)*

- [ ] **A.** Rien de plus : les tags suffisent
- [ ] **B.** Enregistrer le compiler pass `RegisterListenersPass` dans le container builder
- [ ] **C.** Appeler `$dispatcher->autoRegister()`
- [ ] **D.** C'est impossible en dehors du framework complet

### Question 45

Outre `EventDispatcher`, quels autres dispatchers le composant fournit-il ? *(une seule bonne réponse)*

- [ ] **A.** `AsyncEventDispatcher` et `SyncEventDispatcher`
- [ ] **B.** `LazyEventDispatcher`
- [ ] **C.** `ImmutableEventDispatcher` et `TraceableEventDispatcher`
- [ ] **D.** Aucun autre

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Events and Event Listeners de la documentation Symfony 8.0](https://symfony.com/doc/8.0/event_dispatcher.html). Pour les questions 27 à 45 : *(Built-in Events — § …)* renvoie à la page [Built-in Symfony Events](https://symfony.com/doc/8.0/reference/events.html), *(Security — § …)* à la section [Security Events](https://symfony.com/doc/8.0/security.html#security-events), et *(Composant — § …)* à la page du [composant EventDispatcher](https://symfony.com/doc/8.0/components/event_dispatcher.html).

**Question 1 : A, B, C** — « Symfony triggers several events related to the kernel while processing the HTTP Request. Third-party bundles may also dispatch events, and you can even dispatch custom events from your own code. » D est l'inverse. *(Introduction)*

**Question 2 : C** — « You need to register it as a service and notify Symfony that it is an event listener by using a special "tag" » : `kernel.event_listener`. (Avec l'autoconfiguration, l'attribut `#[AsEventListener]` évite cette config — question 7.) *(§ Creating an Event Listener)*

**Question 3 : A, B, C** — La logique documentée : 1. l'attribut `method` du tag s'il est défini ; 2. sinon `__invoke()` (« which makes event listeners invokable ») ; 3. sinon une exception est levée. `handle()` (D) n'existe pas dans cette convention. *(§ Creating an Event Listener)*

**Question 4 : A, B, C** — L'attribut `event` « is useful when listener `$event` argument is not typed. If you configure it, it will change type of `$event` object. » Il insère aussi l'étape `on` + « PascalCased event name » (`onKernelException()` pour `kernel.exception`) dans la logique de résolution de méthode. Il est optionnel (D faux). *(§ Creating an Event Listener)*

**Question 5 : A, B, C** — « a positive or negative integer that defaults to `0` […] the higher the number, the earlier a listener is executed » ; « the priorities of the internal Symfony listeners usually range from `-256` to `256` but your own listeners can use any positive or negative integer ». Rien n'impose l'unicité (D) — à priorité égale, l'ordre d'enregistrement départage (voir question 39). *(§ Creating an Event Listener)*

**Question 6 : B** — `use Symfony\Component\EventDispatcher\Attribute\AsEventListener;` — l'attribut vient du composant EventDispatcher, pas du HttpKernel. *(§ Defining Event Listeners with PHP Attributes)*

**Question 7 : A, B, C** — L'attribut « allows you to configure the listener inside its class, without having to add any configuration in external files » ; « you can add multiple `#[AsEventListener]` attributes to configure different methods » ; et il « can also be applied to methods directly ». D est faux : « the attribute doesn't require its `event` parameter to be set if the method already type-hints the expected event ». *(§ Defining Event Listeners with PHP Attributes)*

**Question 8 : A** — « The `method` property is optional, and when not defined, it defaults to `on` + uppercased event name » : pour l'événement `foo`, « the `onFoo()` method will be called ». *(§ Defining Event Listeners with PHP Attributes)*

**Question 9 : D** — L'exemple de la doc : `#[AsEventListener] public function onMultipleCustomEvent(CustomEvent|AnotherCustomEvent $event)` — le type union suffit, l'attribut déduisant les événements du type-hint. *(§ Defining Event Listeners with PHP Attributes)*

**Question 10 : A, B, C** — Un subscriber « is a class that defines one or more methods that listen to one or various events » (D faux), implémente `EventSubscriberInterface` et sa méthode statique `getSubscribedEvents()` ; « the main difference with the event listeners is that subscribers always know the events to which they are listening ». *(§ Creating an Event Subscriber)*

**Question 11 : B** — L'exemple retourne `[ExceptionEvent::class => [['processException', 10], …]]` : « an array indexed by event names and whose values are either the method name to call or an array composed of the method name to call and a priority ». *(§ Creating an Event Subscriber ; Composant — § Using Event Subscribers)*

**Question 12 : A, B, C** — L'ordre suit la priorité décroissante ; « **Priority is aggregated for all listeners and subscribers**, so your methods could be called before or after the methods defined in other listeners and subscribers. » D est précisément ce que cette phrase infirme. *(§ Creating an Event Subscriber)*

**Question 13 : A** — Le tip : « double-check that you're loading services from the `EventSubscriber` directory and have autoconfigure enabled. You can also manually add the `kernel.event_subscriber` tag. » *(§ Creating an Event Subscriber)*

**Question 14 : C** — « A single page can make several requests (one main request, and then multiple sub-requests - typically when embedding controllers in templates). » Certaines vérifications sur la « vraie » requête n'ont pas de sens dans les sous-requêtes, d'où le `return` early si `!$event->isMainRequest()`. *(§ Request Events, Checking Types)*

**Question 15 : A, B, C** — « Listeners and subscribers can be used in the same application indistinctly » ; « **Subscribers are easier to reuse** because the knowledge of the events is kept in the class […] This is the reason why Symfony uses subscribers internally » ; « **Listeners are more flexible** because bundles can enable or disable each of them conditionally ». La performance (D) n'est pas un critère cité. *(§ Listeners or Subscribers)*

**Question 16 : A, B, C** — « Symfony's core events can also be referred to by the fully qualified class name (FQCN) of the corresponding event class » ; « internally, the event FQCN are treated as aliases for the original event names. Since the mapping already happens when compiling the service container », ces listeners « will appear under the original event name when inspecting the event dispatcher ». D est faux : « The compiler pass will always **extend** the existing list of aliases » — plusieurs enregistrements sont sûrs. *(§ Event Aliases)*

**Question 17 : B** — « This alias mapping can be extended for custom events by registering the compiler pass `AddEventAliasesPass` » dans `Kernel::build()`. *(§ Event Aliases)*

**Question 18 : A, B, C, D** — Les quatre usages sont documentés : liste complète, événement précis, correspondance partielle (`kernel`, `Security`), et `--dispatcher=` pour un dispatcher donné. *(§ Debugging Event Listeners)*

**Question 19 : A** — « The security system uses an event dispatcher **per firewall**. » D'où `--dispatcher=security.event_dispatcher.main`. *(§ Debugging Event Listeners)*

**Question 20 : D** — « Some web frameworks define methods like `preExecute()` and `postExecute()`, but there is no such thing in Symfony. The good news is that there is a much better way to interfere with the Request -> Response process using the EventDispatcher component. » *(§ How to Set Up Before and After Filters)*

**Question 21 : B** — « A `kernel.controller` (aka `KernelEvents::CONTROLLER`) listener gets notified on *every* request, right before the controller is executed. » `kernel.request` (A) est trop tôt : le contrôleur n'est pas encore déterminé. *(§ Before Filters with the kernel.controller Event)*

**Question 22 : A, B, C** — « A clean and simple way is to create an empty interface and make the controllers implement it » ; « when a controller class defines multiple action methods, the controller is returned as `[$controllerInstance, 'methodName']` » ; et le subscriber lève `AccessDeniedHttpException` si le token ne correspond pas. D est faux : l'interface marqueur est le moyen montré. *(§ Before Filters with the kernel.controller Event)*

**Question 23 : C** — « Another core Symfony event - called `kernel.response` (aka `KernelEvents::RESPONSE`) - is notified on every request, but after the controller returns a `Response` object. » `kernel.terminate` (A) arrive après l'**envoi** de la réponse — trop tard pour la modifier. *(§ After Filters with the kernel.response Event)*

**Question 24 : D** — « By storing a value in the request's "attributes" bag, the `onKernelResponse()` method knows to add the extra header » : `$event->getRequest()->attributes->set('auth_token', $token)` côté before, `$event->getRequest()->attributes->get('auth_token')` côté after. *(§ After Filters with the kernel.response Event)*

**Question 25 : A** — « If you want to do something right before, or directly after a method is called, you can dispatch an event respectively at the beginning or at the end of the method » — `mailer.pre_send` / `mailer.post_send`, avec des classes d'événement exposant getters **et** setters (`setSubject()`, `setReturnValue()`…). *(§ How to Customize a Method Behavior without Using Inheritance)*

**Question 26 : A, B, C** — Le tip : « type-hint one of its interfaces instead of the concrete `EventDispatcher` class. Use `Symfony\Contracts\EventDispatcher\EventDispatcherInterface` when you only need to dispatch events, or `Symfony\Component\EventDispatcher\EventDispatcherInterface` if you also need to inspect or manage listeners (e.g. `addListener()`, `removeListener()`). » Elles ne sont donc pas identiques (D). *(§ How to Customize a Method Behavior without Using Inheritance)*

**Question 27 : A, B, C** — `KernelEvent` fournit `getRequestType()`, `getKernel()`, `getRequest()` et `isMainRequest()`. `getResponse()` (D) n'existe que sur certaines sous-classes (ex. `ResponseEvent`). *(Built-in Events — § Kernel Events)*

**Question 28 : B** — « This event is dispatched very early in Symfony, before the controller is determined. It's useful to add information to the Request or return a Response early to stop the handling of the request. » *(Built-in Events — § kernel.request)*

**Question 29 : A, B, C** — « dispatched after the controller has been resolved but before executing it » ; « the controller can be changed to any PHP callable » via `$event->setController()` ; « useful to initialize things later needed by the controller, such as value resolvers ». D concerne `kernel.controller_arguments` (question 30). *(Built-in Events — § kernel.controller)*

**Question 30 : C** — « This event is dispatched just before a controller is called. It's useful to configure the arguments that are going to be passed to the controller » — `$event->getArguments()` / `$event->setArguments()`. *(Built-in Events — § kernel.controller_arguments)*

**Question 31 : A** — « This event is dispatched after the controller has been executed but *only* if the controller does *not* return a `Response` object. It's useful to transform the returned value […] into the `Response` object needed by Symfony » via `$event->getControllerResult()` + `$event->setResponse()`. *(Built-in Events — § kernel.view)*

**Question 32 : A, B, C** — `kernel.response` : « modify or replace the response before sending it back (e.g. add/modify HTTP headers, add cookies) » ; `kernel.finish_request` : « dispatched after the `kernel.response` event. It's useful to reset the global state » (ex. la locale) ; `kernel.terminate` : « dispatched after the response has been sent […] useful to perform slow or complex tasks that don't need to be completed to send the response (e.g. sending emails) ». D est faux : à ce stade, la réponse est déjà partie. *(Built-in Events — § kernel.response / kernel.finish_request / kernel.terminate)*

**Question 33 : A, B, C** — La logique documentée dans cet ordre : code de la `Response` si `isClientError()`/`isServerError()`/`isRedirect()` ; sinon `getStatusCode()` (+ `getHeaders()`) d'une `HttpExceptionInterface` ; sinon 500. D est faux : pour conserver un code arbitraire comme 204, il faut appeler `$event->allowCustomResponseCode()` **d'abord** — « if omitted, then the kernel will set an appropriate status code based on the type of exception thrown ». *(Built-in Events — § kernel.exception)*

**Question 34 : A, B, C** — « Every Security firewall has its own event dispatcher (`security.event_dispatcher.FIREWALLNAME`). Events are dispatched on both the global and the firewall-specific dispatcher. » Pour cibler un firewall : le tag `kernel.event_subscriber` avec `dispatcher: security.event_dispatcher.main`. D contredit A. *(Security — § Security Events)*

**Question 35 : A, B, C** — `CheckPassportEvent` : « Listeners of this event do the actual authentication checks (like checking the passport, validating the CSRF token, etc.) » ; `AuthenticationSuccessEvent` : « This is the last event that can make an authentication fail by throwing an `AuthenticationException` » ; `LoginSuccessEvent`/`LoginFailureEvent` : « Listeners to this event can modify the (error) response sent back to the user ». D est faux : `AuthenticationTokenCreatedEvent` est « dispatched **after** the passport was validated and the authenticator created the security token ». *(Security — § Authentication Events)*

**Question 36 : D** — `InteractiveLoginEvent` est « dispatched after authentication was fully successful only when the authenticator implements `InteractiveAuthenticatorInterface`, which indicates login requires explicit user action (e.g. a login form) ». *(Security — § Other Events)*

**Question 37 : B** — `TokenDeauthenticatedEvent` : « dispatched when a user is deauthenticated, for instance because the password was changed ». `LogoutEvent` (A) est la déconnexion volontaire ; `SwitchUserEvent` (C), l'impersonation. *(Security — § Other Events)*

**Question 38 : C** — « The Symfony EventDispatcher component implements the **Mediator** and **Observer** design patterns. » *(Composant — § Introduction)*

**Question 39 : A, B, C** — « The `addListener()` method takes up to three arguments » : nom d'événement, callable PHP, priorité optionnelle (défaut `0`) ; « the higher the number, the earlier the listener is called. If two listeners have the same priority, they are executed in the order that they were added » ; « you can also register PHP Closures as event listeners ». D est faux : tout callable PHP convient. *(Composant — § Connecting Listeners)*

**Question 40 : A** — `dispatch()` « takes two arguments: the `Event` instance […] and optionally the name of the event to dispatch. If it's not defined, the class of the `Event` instance will be used. » *(Composant — § Dispatch the Event)*

**Question 41 : A, B, C** — La classe custom étend `Symfony\Contracts\EventDispatcher\Event` et expose ses données (`getOrder()`) ; sans données, « you can also use the default `Event` class » et « document the event and its name in a generic `StoreEvents` class, similar to the `KernelEvents` class » : `dispatch(new Event(), StoreEvents::ORDER_PLACED)`. Aucune constante `NAME` obligatoire (D). *(Composant — § Creating and Dispatching an Event)*

**Question 42 : A, B, C** — `stopPropagation()` demande au dispatcher « to stop all propagation of the event to future listeners » : « any listeners […] that have not yet been called will *not* be called » ; le code appelant le détecte avec `isPropagationStopped()`. Les listeners déjà exécutés ne sont pas « annulés » (D). *(Composant — § Stopping Event Flow/Propagation)*

**Question 43 : D** — « The `EventDispatcher` always passes the dispatched event, the event's name and a reference to itself to the listeners » — signature `(Event $event, string $eventName, EventDispatcherInterface $dispatcher)`. *(Composant — § Event Name Introspection)*

**Question 44 : B** — « Registering service definitions and tagging them with the `kernel.event_listener` and `kernel.event_subscriber` tags is not enough […] You must also register a compiler pass called `RegisterListenersPass()` in the container builder. » (Et `AddEventAliasesPass` doit être traité **avant** `RegisterListenersPass`.) Dans le framework complet, FrameworkBundle s'en charge. *(Composant — § Connecting Listeners)*

**Question 45 : C** — « Besides the commonly used `EventDispatcher`, the component comes with some other dispatchers » : `ImmutableEventDispatcher` et `TraceableEventDispatcher`. *(Composant — § Other Dispatchers)*

---

## Pour aller plus loin

Les ressources listées dans la section [Learn More](https://symfony.com/doc/8.0/event_dispatcher.html#learn-more) de la page :

- [The Request-Response Lifecycle](https://symfony.com/doc/8.0/components/http_kernel.html#the-workflow-of-a-request) — couvert par le QCM [05-http_kernel](05-http_kernel.md)
- [Built-in Symfony Events](https://symfony.com/doc/8.0/reference/events.html) — questions 27 à 33
- [Security Events](https://symfony.com/doc/8.0/security.html#security-events) — questions 34 à 37
- [The EventDispatcher Component](https://symfony.com/doc/8.0/components/event_dispatcher.html) — questions 38 à 45
