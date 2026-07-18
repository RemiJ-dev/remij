# QCM — Les Workflows

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/workflow.html](https://symfony.com/doc/8.0/workflow.html) (questions 1 à 104) et les ressources de sa section [Learn more](https://symfony.com/doc/8.0/workflow.html#learn-more) : [Workflows and State Machines](https://symfony.com/doc/8.0/workflow/workflow-and-state-machine.html) (questions 105 à 124) et [How to Dump Workflows](https://symfony.com/doc/8.0/workflow/dumping-workflows.html) (questions 125 à 146) · **Généré le :** 23 juillet 2026
>
> **146 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Que fait la commande `composer require symfony/workflow` ? *(une seule bonne réponse)*

- [ ] **A.** Elle génère automatiquement un workflow de démonstration
- [ ] **B.** Elle installe le composant Workflow dans une application utilisant Symfony Flex
- [ ] **C.** Elle active le mode debug du Workflow Profiler
- [ ] **D.** Elle crée le fichier `config/packages/workflow.yaml` avec un exemple pré-rempli

### Question 2

Quelle commande permet de voir toutes les options de configuration disponibles pour les workflows ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:config workflow`
- [ ] **B.** `php bin/console workflow:dump --config`
- [ ] **C.** `php bin/console debug:workflow`
- [ ] **D.** `php bin/console config:dump-reference framework workflows`

## Creating a Workflow

### Question 3

Qu'est-ce qu'une **définition** (« definition ») de workflow ? *(une seule bonne réponse)*

- [ ] **A.** Un ensemble de listeners et de subscribers
- [ ] **B.** Une classe implémentant `WorkflowInterface`, uniquement
- [ ] **C.** Un ensemble de places et de transitions
- [ ] **D.** Une configuration YAML uniquement, sans équivalent PHP

### Question 4

De quoi un workflow a-t-il besoin, en plus de sa `Definition` ? *(une seule bonne réponse)*

- [ ] **A.** D'une façon d'écrire les états sur les objets, via une implémentation de `MarkingStoreInterface`
- [ ] **B.** Uniquement d'un `EventDispatcher`
- [ ] **C.** D'un `Validator` obligatoire
- [ ] **D.** D'un Repository Doctrine dédié

### Question 5

Quel type de marking store un « workflow » doit-il utiliser, par opposition à un « state_machine » ? *(une seule bonne réponse)*

- [ ] **A.** "single_state" pour "workflow" et "multiple_state" pour "state_machine"
- [ ] **B.** Les deux types sont interchangeables, sans contrainte
- [ ] **C.** "single_state" pour les deux types
- [ ] **D.** "multiple_state" pour "workflow" et "single_state" pour "state_machine"

### Question 6

Quel type PHP un « single state » marking store utilise-t-il pour stocker la donnée, et lequel un « multiple state » utilise-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau pour les deux
- [ ] **B.** Une chaîne (`string`) pour le « single state » et un tableau (`array`) pour le « multiple state »
- [ ] **C.** Un objet `Marking` pour les deux
- [ ] **D.** Un entier pour le « single state » et une chaîne pour le « multiple state »

### Question 7

Que doit retourner le getter de la propriété du marking store si aucun état n'est défini, quel que soit le type de marking store ? *(une seule bonne réponse)*

- [ ] **A.** `null`, dans les deux cas
- [ ] **B.** Une chaîne vide `''`
- [ ] **C.** Un tableau vide `[]`
- [ ] **D.** Une exception doit être levée

### Question 8

Quelle est la valeur par défaut de l'attribut `property` de l'option `marking_store` ? *(une seule bonne réponse)*

- [ ] **A.** `'currentPlace'`
- [ ] **B.** `'status'`
- [ ] **C.** `'marking'`
- [ ] **D.** Aucune valeur par défaut, l'option est obligatoire

### Question 9

Que fait l'option `audit_trail.enabled` réglée à `true` ? *(une seule bonne réponse)*

- [ ] **A.** Elle active un rollback automatique en cas d'erreur
- [ ] **B.** Elle fait générer à l'application des messages de log détaillés sur l'activité du workflow
- [ ] **C.** Elle stocke un historique des transitions dans Doctrine
- [ ] **D.** Elle désactive la validation du workflow

### Question 10

Quelle est la différence entre `Workflow::can()` et `Workflow::apply()` ? *(une seule bonne réponse)*

- [ ] **A.** `can()` applique la transition, `apply()` vérifie seulement si elle est possible
- [ ] **B.** Les deux méthodes sont strictement identiques
- [ ] **C.** `can()` lève toujours une exception si la transition est impossible
- [ ] **D.** `can()` vérifie si une transition est possible, `apply()` tente de l'appliquer et peut lever une `LogicException` si elle ne l'est pas

### Question 11

Quelle est la différence entre `getEnabledTransitions()` et `getEnabledTransition()` ? *(une seule bonne réponse)*

- [ ] **A.** `getEnabledTransitions()` retourne toutes les transitions disponibles, `getEnabledTransition()` en retourne une spécifique par son nom
- [ ] **B.** Les deux méthodes retournent exactement la même chose
- [ ] **C.** `getEnabledTransition()` (singulier) n'existe pas dans le composant
- [ ] **D.** `getEnabledTransitions()` nécessite de préciser un nom de transition

### Question 12

Peut-on omettre l'option `places` de la configuration d'un workflow ? *(une seule bonne réponse)*

- [ ] **A.** Non, l'option `places` est toujours obligatoire
- [ ] **B.** Oui, si les transitions définissent déjà toutes les places utilisées : Symfony les extrait alors automatiquement
- [ ] **C.** Seulement pour les state machines, jamais pour les workflows
- [ ] **D.** Oui, mais seulement en utilisant des enums PHP

### Question 13

Comment utiliser une constante PHP comme valeur dans un fichier YAML de configuration d'un workflow ? *(une seule bonne réponse)*

- [ ] **A.** Avec la notation `!php/enum`, réservée aux enums
- [ ] **B.** Avec la notation `!php/class`
- [ ] **C.** Avec la notation `!php/const`, ex. `!php/const App\Entity\BlogPost::STATE_DRAFT`
- [ ] **D.** Avec la notation `!php/constant`, obsolète depuis Symfony 7

### Question 14

Quel type Doctrine la documentation déconseille-t-elle d'utiliser pour la colonne d'un marking store à états multiples ? *(une seule bonne réponse)*

- [ ] **A.** `json`
- [ ] **B.** `array`
- [ ] **C.** `text`
- [ ] **D.** `simple_array`, car un seul élément serait stocké comme une simple chaîne, entraînant la perte de la place courante de l'objet

### Question 15

Comment les places sont-elles stockées à l'intérieur d'un marking store à états multiples ? *(une seule bonne réponse)*

- [ ] **A.** Sous forme de clés dans un tableau, chacune avec une valeur de 1, ex. `['draft' => 1]`
- [ ] **B.** Sous forme d'une chaîne concaténée séparée par des virgules
- [ ] **C.** Sous forme d'un objet `Marking` systématiquement sérialisé en JSON
- [ ] **D.** Sous forme d'un entier représentant un masque de bits

### Question 16

Quand on utilise des propriétés publiques pour le marking store, que se passe-t-il si on ne déclare pas de setter dédié ? *(une seule bonne réponse)*

- [ ] **A.** Le getter n'est alors plus nécessaire du tout
- [ ] **B.** Le type "single_state" n'est plus utilisable
- [ ] **C.** Les transitions ne peuvent plus être appliquées
- [ ] **D.** Le contexte (« context ») n'est pas supporté ; il faut déclarer un setter pour le supporter

## Using Enums in Workflows

### Question 17

Dans quel cas peut-on utiliser des enums PHP « backed » comme places d'un workflow ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement avec le type "workflow", jamais "state_machine"
- [ ] **B.** Lorsqu'on utilise un state machine
- [ ] **C.** Avec n'importe quel type d'enum, backed ou pur
- [ ] **D.** Uniquement à partir de PHP 8.3

### Question 18

Quel type d'enum PHP est requis pour être utilisé comme place ? *(une seule bonne réponse)*

- [ ] **A.** Un enum pur, sans valeur associée
- [ ] **B.** Un enum implémentant `JsonSerializable`
- [ ] **C.** Un enum « backed » (avec des valeurs, ex. `enum BlogPostStatus: string`)
- [ ] **D.** Un enum implémentant explicitement `BackedEnum` en plus de sa déclaration

### Question 19

Quelle notation YAML permet de référencer un cas d'enum dans la configuration d'un workflow ? *(une seule bonne réponse)*

- [ ] **A.** `!php/enum App\Enumeration\BlogPostStatus::Draft`
- [ ] **B.** `!php/const`
- [ ] **C.** `!enum:App\Enumeration\BlogPostStatus::Draft`
- [ ] **D.** Il n'existe pas de notation YAML dédiée, seul PHP le permet

### Question 20

Que fait le composant avec les enums utilisés comme places, de façon transparente ? *(une seule bonne réponse)*

- [ ] **A.** Il convertit les enums en chaînes de façon permanente, uniquement en base de données
- [ ] **B.** Il caste transparemment l'enum vers sa valeur « backing » quand nécessaire, et inversement
- [ ] **C.** Il interdit l'usage d'enums dans les transitions, seulement dans les places
- [ ] **D.** Il sérialise systématiquement les enums en JSON

### Question 21

Que peut-on lister via des « glob patterns » de constantes ou d'enums PHP ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les noms de transitions
- [ ] **B.** Uniquement les noms de workflows eux-mêmes
- [ ] **C.** Les noms de fichiers YAML de configuration
- [ ] **D.** Les places d'un workflow

### Question 22

Dans une marking store à état unique (« single state »), par quel type peut-on type-hinter la propriété au lieu d'une chaîne ? *(une seule bonne réponse)*

- [ ] **A.** Un `BackedEnum`
- [ ] **B.** Un `UnitEnum`
- [ ] **C.** Un `\Stringable`
- [ ] **D.** Un `\JsonSerializable`

### Question 23

Quelle classe gère automatiquement la conversion entre l'enum et sa valeur « backing » dans ce cas ? *(une seule bonne réponse)*

- [ ] **A.** `EnumMarkingStore`
- [ ] **B.** `SingleStateMarkingStore`
- [ ] **C.** `MethodMarkingStore`
- [ ] **D.** `PropertyMarkingStore`

### Question 24

Les enums dans les marking stores sont documentés pour quel type de marking store ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le marking store à états multiples
- [ ] **B.** Le marking store à état unique (« single state »)
- [ ] **C.** Les deux types indifféremment, sans distinction
- [ ] **D.** Aucun des deux : les enums ne sont utilisables que pour les places

## Using Weighted Transitions

### Question 25

Que permettent d'introduire les « weighted transitions » (transitions pondérées) ? *(une seule bonne réponse)*

- [ ] **A.** De prioriser certaines transitions sur d'autres en cas de conflit
- [ ] **B.** De chiffrer le contenu des places sensibles
- [ ] **C.** De la multiplicité : une place peut suivre combien de fois un objet s'y trouve
- [ ] **D.** De limiter le nombre de transitions disponibles simultanément

### Question 26

Quelle particularité des workflows (par rapport aux state machines) motive l'existence des transitions pondérées ? *(une seule bonne réponse)*

- [ ] **A.** Pouvoir dupliquer un objet en plusieurs instances distinctes
- [ ] **B.** Pouvoir revenir en arrière (rollback) sur une transition déjà appliquée
- [ ] **C.** Pouvoir stocker un historique complet des transitions passées
- [ ] **D.** Le fait qu'un objet peut se trouver dans plusieurs places simultanément, contrairement à une simple marque binaire

### Question 27

Quelle classe permet de définir des transitions pondérées de façon programmatique ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Workflow\Arc`
- [ ] **B.** `Symfony\Component\Workflow\Weight`
- [ ] **C.** `Symfony\Component\Workflow\Token`
- [ ] **D.** `Symfony\Component\Workflow\Multiplicity`

### Question 28

Quels sont les deux paramètres du constructeur de cette classe ? *(une seule bonne réponse)*

- [ ] **A.** Le nom de la transition et son poids
- [ ] **B.** Le nom de la place et le poids, qui doit être supérieur ou égal à 1
- [ ] **C.** Le nom de la place uniquement, le poids étant toujours calculé automatiquement
- [ ] **D.** La place de départ et la place d'arrivée

### Question 29

Quel poids est utilisé quand une place est spécifiée comme une simple chaîne plutôt que via cette classe ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est pas possible de mélanger chaînes et objets `Arc` dans une même transition
- [ ] **B.** Un poids de 0, ce qui désactive la place
- [ ] **C.** Un poids par défaut de 1
- [ ] **D.** Une exception est levée, un `Arc` étant obligatoire

### Question 30

Dans l'exemple de la table (« make_table »), combien de fois la transition `build_leg` doit-elle être appliquée avant que `join` soit possible ? *(une seule bonne réponse)*

- [ ] **A.** Une seule fois, quel que soit le nombre de jetons
- [ ] **B.** Deux fois
- [ ] **C.** Trois fois
- [ ] **D.** Quatre fois, une fois pour chacun des 4 jetons créés dans `prepare_leg`

### Question 31

Que contient l'option `to` de la transition `start`, dans l'exemple YAML des transitions pondérées ? *(une seule bonne réponse)*

- [ ] **A.** Une liste de places, chacune associée à un `weight`
- [ ] **B.** Une simple chaîne unique, comme dans un workflow classique
- [ ] **C.** Un tableau de conditions "guard"
- [ ] **D.** Une référence vers un service Symfony

### Question 32

Dans la transition `join` de cet exemple, `top_created` est indiqué sans poids explicite. Quel poids lui est appliqué ? *(une seule bonne réponse)*

- [ ] **A.** Le poids doit obligatoirement être précisé, sinon une erreur de configuration est levée
- [ ] **B.** Le poids vaut 1 par défaut
- [ ] **C.** Le poids vaut 0, désactivant cette entrée
- [ ] **D.** Le poids est hérité de la transition `start`

### Question 33

Quels cas d'usage la documentation cite-t-elle comme adaptés aux transitions pondérées ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les processus de fabrication (« manufacturing »)
- [ ] **B.** L'allocation de ressources
- [ ] **C.** Le chiffrement de données sensibles
- [ ] **D.** Tout scénario nécessitant de produire ou consommer plusieurs instances de quelque chose

### Question 34

Quel type Doctrine est recommandé pour la colonne d'un marking store à états multiples ? *(une seule bonne réponse)*

- [ ] **A.** `Types::TEXT`
- [ ] **B.** `Types::SIMPLE_ARRAY`
- [ ] **C.** `Types::JSON`
- [ ] **D.** `Types::ARRAY` (type déprécié)

## Accessing the Workflow in a Class

### Question 35

Que crée Symfony pour chaque workflow défini en configuration ? *(une seule bonne réponse)*

- [ ] **A.** Un événement dédié uniquement
- [ ] **B.** Une route HTTP de debug
- [ ] **C.** Une commande console dédiée
- [ ] **D.** Un service

### Question 36

Quelle est la première façon documentée d'injecter un workflow précis dans un service ou contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Type-hinter l'argument avec `WorkflowInterface` et le nommer « nom du workflow en camelCase » + suffixe `Workflow` (ou `StateMachine` pour un state machine)
- [ ] **B.** Nommer l'argument exactement comme le nom du workflow en snake_case, sans suffixe
- [ ] **C.** Utiliser un suffixe `Service` après le nom du workflow
- [ ] **D.** Utiliser un suffixe `Definition` après le nom du workflow

### Question 37

Quelle est la seconde façon documentée, utile pour choisir explicitement quelle implémentation injecter ? *(une seule bonne réponse)*

- [ ] **A.** L'attribut `#[Autowire]`
- [ ] **B.** L'attribut `#[Target('blog_publishing')]`
- [ ] **C.** L'attribut `#[Service('blog_publishing')]`
- [ ] **D.** L'attribut `#[Inject('blog_publishing')]`

### Question 38

Quel nom de tag regroupe **tous** les workflows et **toutes** les state machines, pour les injecter tous en une fois ? *(une seule bonne réponse)*

- [ ] **A.** `workflow.all`
- [ ] **B.** `workflow.workflow`
- [ ] **C.** `workflow`
- [ ] **D.** `workflow.state_machine`

### Question 39

Quels sont les deux tags permettant de cibler exclusivement les workflows d'un côté, et exclusivement les state machines de l'autre ? *(une seule bonne réponse)*

- [ ] **A.** `workflow.definition` et `workflow.machine`
- [ ] **B.** `workflow.type_workflow` et `workflow.type_state_machine`
- [ ] **C.** `workflow.all` et `workflow.state`
- [ ] **D.** `workflow.workflow` (uniquement les workflows) et `workflow.state_machine` (uniquement les state machines)

### Question 40

Quelle commande liste les services de workflow disponibles pour l'autowiring ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:autowiring workflow`
- [ ] **B.** `php bin/console debug:container workflow`
- [ ] **C.** `php bin/console workflow:list`
- [ ] **D.** `php bin/console debug:workflow --all`

### Question 41

Quel attribut permet de lazy-charger tous les workflows via un `ServiceLocator` ? *(une seule bonne réponse)*

- [ ] **A.** `#[AutowireIterator]`
- [ ] **B.** `#[TaggedIterator]`
- [ ] **C.** `#[AutowireLocator('workflow', 'name')]`
- [ ] **D.** `#[ServiceLocatorInterface('workflow')]`

### Question 42

À quoi sert le second argument `'name'` de cet attribut ? *(une seule bonne réponse)*

- [ ] **A.** Il définit le nom du service de repli si le workflow demandé n'existe pas
- [ ] **B.** Il définit le nom de la méthode d'accès au workflow
- [ ] **C.** Il définit le namespace des classes de workflow
- [ ] **D.** Il indique à Symfony d'indexer les services en utilisant cette propriété du tag

### Question 43

Si l'on n'utilise pas la propriété `'name'` du tag pour indexer les services, comment récupérer un workflow depuis le `ServiceLocator` ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant le nom complet du service, avec le préfixe `workflow.` (ex. `workflow.user_registration`)
- [ ] **B.** En utilisant uniquement le nom court du workflow
- [ ] **C.** Ce n'est pas possible sans l'option `'name'`
- [ ] **D.** En itérant sur tous les services jusqu'à trouver le bon type

### Question 44

Quels tags utiliser avec `#[AutowireLocator]` pour n'injecter que les workflows d'un côté, et que les state machines de l'autre ? *(une seule bonne réponse)*

- [ ] **A.** `'workflow.workflow'` pour les workflows, `'workflow.state_machine'` pour les state machines
- [ ] **B.** `'workflow.type=workflow'` et `'workflow.type=state_machine'`
- [ ] **C.** `'workflow.only'` et `'workflow.machine_only'`
- [ ] **D.** Ce n'est pas possible, seul le tag générique `'workflow'` existe

### Question 45

À quelle interface appartient la méthode `getEnabledTransition()` (singulier) ? *(une seule bonne réponse)*

- [ ] **A.** `WorkflowValidatorInterface`
- [ ] **B.** `WorkflowInterface`
- [ ] **C.** `MarkingStoreInterface`
- [ ] **D.** `DefinitionValidatorInterface`

### Question 46

Sous quelle clé les métadonnées du workflow sont-elles attachées aux tags de service ? *(une seule bonne réponse)*

- [ ] **A.** Sous la clé `info`
- [ ] **B.** Sous la clé `attributes`
- [ ] **C.** Sous la clé `metadata`
- [ ] **D.** Elles ne sont pas accessibles via les tags, uniquement via le service direct

## Using Events

### Question 47

Combien d'événements sont dispatchés à chaque étape du cycle de vie d'une transition, et selon quel schéma ? *(une seule bonne réponse)*

- [ ] **A.** Un seul événement générique pour le workflow, sans transition ni place
- [ ] **B.** Un événement générique et un événement spécifique à la transition, jamais à la place
- [ ] **C.** Deux événements seulement : un générique et un spécifique
- [ ] **D.** Trois événements : un pour tout workflow, un pour le workflow concerné, et un pour le workflow concerné avec le nom spécifique de la transition ou de la place

### Question 48

Dans quel ordre les événements sont-ils dispatchés lorsqu'une transition d'état est initiée ? *(une seule bonne réponse)*

- [ ] **A.** guard, leave, transition, enter, entered, completed, announce
- [ ] **B.** leave, guard, enter, transition, completed, entered, announce
- [ ] **C.** transition, guard, leave, entered, enter, announce, completed
- [ ] **D.** announce, guard, leave, transition, enter, entered, completed

### Question 49

Lesquels de ces noms d'événements font partie du cycle de vie documenté d'une transition de workflow ? *(plusieurs bonnes réponses)*

- [ ] **A.** `workflow.guard`
- [ ] **B.** `workflow.enter`
- [ ] **C.** `workflow.completed`
- [ ] **D.** `workflow.announce`

### Question 50

Quel est le rôle de l'événement `workflow.guard` ? *(une seule bonne réponse)*

- [ ] **A.** Valider que le marking a bien été mis à jour
- [ ] **B.** Valider si la transition est bloquée ou non
- [ ] **C.** Déclencher l'envoi de notifications
- [ ] **D.** Vérifier des permissions Doctrine sur l'entité

### Question 51

Que n'est **pas** encore mis à jour au moment où l'événement `workflow.enter` est déclenché ? *(une seule bonne réponse)*

- [ ] **A.** Le sujet lui-même n'existe pas encore en mémoire
- [ ] **B.** La transition n'est pas encore déterminée
- [ ] **C.** Le marking du sujet, qui n'est pas encore mis à jour avec les nouvelles places
- [ ] **D.** Aucun listener ne peut encore accéder au sujet

### Question 52

Que signale l'événement `workflow.entered` ? *(une seule bonne réponse)*

- [ ] **A.** Le sujet est sur le point d'entrer dans une nouvelle place
- [ ] **B.** Le sujet est sur le point de quitter une place
- [ ] **C.** La transition est bloquée à ce stade
- [ ] **D.** Le sujet est entré dans les places et le marking est mis à jour

### Question 53

Que signale l'événement `workflow.completed` ? *(une seule bonne réponse)*

- [ ] **A.** L'objet a terminé cette transition
- [ ] **B.** C'est le tout premier événement déclenché dans le cycle
- [ ] **C.** Il ne concerne que les state machines, jamais les workflows
- [ ] **D.** Il annule automatiquement la transition en cas d'erreur

### Question 54

Que fait l'événement `workflow.announce` après qu'une transition a été appliquée ? *(une seule bonne réponse)*

- [ ] **A.** Il revalide uniquement la configuration YAML du workflow
- [ ] **B.** Il teste toutes les transitions désormais disponibles pour le sujet, ce qui redéclenche tous les guard events
- [ ] **C.** Il exécute un rollback de sécurité
- [ ] **D.** Il ne fait rien de spécial, c'est un simple alias de `workflow.completed`

### Question 55

Comment désactiver l'événement `announce` pour des raisons de performance, lors d'un appel à `apply()` ? *(une seule bonne réponse)*

- [ ] **A.** En désactivant entièrement l'`EventDispatcher`
- [ ] **B.** En configurant uniquement `events_to_dispatch: []`
- [ ] **C.** En passant `[Workflow::DISABLE_ANNOUNCE_EVENT => true]` dans le contexte de `apply()`
- [ ] **D.** Ce n'est pas configurable, l'événement `announce` est toujours déclenché

### Question 56

Les événements « leave » et « enter » sont-ils déclenchés pour une transition qui reste dans la même place ? *(une seule bonne réponse)*

- [ ] **A.** Oui, ils sont déclenchés même dans ce cas
- [ ] **B.** Non, jamais dans ce cas
- [ ] **C.** Cela dépend uniquement du type "state_machine"
- [ ] **D.** Cela dépend uniquement de l'option `audit_trail`

### Question 57

Que déclenche l'appel explicite à `$workflow->getMarking($object)` pour initialiser le marking ? *(une seule bonne réponse)*

- [ ] **A.** L'événement `workflow.guard`, avec le contexte par défaut
- [ ] **B.** Aucun événement n'est déclenché par ce simple appel
- [ ] **C.** L'événement `workflow.announce`, pour toutes les transitions initiales
- [ ] **D.** L'événement `workflow.[nom].entered.[place initiale]`, avec le contexte par défaut (`Workflow::DEFAULT_INITIAL_CONTEXT`)

### Question 58

Dans l'exemple `WorkflowLoggerSubscriber`, quel helper construit le nom exact de l'événement sans manipuler de chaînes à la main ? *(une seule bonne réponse)*

- [ ] **A.** `Workflow::getEventName()`
- [ ] **B.** `LeaveEvent::getName('blog_publishing')`
- [ ] **C.** `EventDispatcher::getSubscribedName()`
- [ ] **D.** `Definition::getEventName()`

### Question 59

Quel trait permet à des événements personnalisés de construire leur `getName()` de la même façon ? *(une seule bonne réponse)*

- [ ] **A.** `EventNameInterface`
- [ ] **B.** `WorkflowEventTrait`
- [ ] **C.** `Symfony\Component\Workflow\Event\EventNameTrait`
- [ ] **D.** `NamedEventTrait`

### Question 60

Parmi ces attributs, lesquels permettent de déclarer un listener d'événement de workflow ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[AsGuardListener]`
- [ ] **B.** `#[AsTransitionListener]`
- [ ] **C.** `#[AsLeaveListener]`
- [ ] **D.** `#[AsCompletedListener]`

### Question 61

Ces attributs fonctionnent comme quel autre attribut, issu du composant EventDispatcher ? *(une seule bonne réponse)*

- [ ] **A.** `#[AsEventListener]`
- [ ] **B.** `#[AsController]`
- [ ] **C.** `#[AsCommand]`
- [ ] **D.** `#[AsMessageHandler]`

### Question 62

Que retourne la méthode `Event::getMarking()` ? *(une seule bonne réponse)*

- [ ] **A.** Le nom du workflow qui a déclenché l'événement
- [ ] **B.** Le `Marking` du workflow
- [ ] **C.** La transition qui a déclenché l'événement
- [ ] **D.** Les métadonnées de la transition

### Question 63

Que retourne la méthode `Event::getWorkflowName()` ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `Workflow`
- [ ] **B.** Le nom de la place courante
- [ ] **C.** Le nom de la transition en cours
- [ ] **D.** Une chaîne avec le nom du workflow ayant déclenché l'événement

### Question 64

Quelles méthodes supplémentaires `GuardEvent` ajoute-t-il par rapport à la classe `Event` de base ? *(plusieurs bonnes réponses)*

- [ ] **A.** `isBlocked()`
- [ ] **B.** `setBlocked()`
- [ ] **C.** `getMarking()`
- [ ] **D.** `addTransitionBlocker()`

### Question 65

`GuardEvent::getTransitionBlockerList()` retourne une instance de quelle classe ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Workflow\TransitionBlockerList`
- [ ] **B.** `Symfony\Component\Workflow\Event\GuardEvent`
- [ ] **C.** `Symfony\Component\Workflow\Marking`
- [ ] **D.** `Symfony\Component\Workflow\Definition`

### Question 66

À quoi sert l'option de configuration `events_to_dispatch` ? *(une seule bonne réponse)*

- [ ] **A.** Retarder le déclenchement des événements de quelques millisecondes
- [ ] **B.** Rediriger les événements vers un autre workflow
- [ ] **C.** Contrôler quels événements sont déclenchés lors de chaque transition
- [ ] **D.** Désactiver totalement l'`EventDispatcher` pour ce workflow

### Question 67

Cette option s'applique-t-elle aux guard events ? *(une seule bonne réponse)*

- [ ] **A.** Oui, on peut aussi désactiver les guard events avec cette option
- [ ] **B.** Non : les guard events sont toujours déclenchés, quelle que soit cette option
- [ ] **C.** Seulement si `audit_trail` est désactivé
- [ ] **D.** Seulement en environnement de test

### Question 68

Que se passe-t-il si l'on passe un tableau vide à `events_to_dispatch` ? *(une seule bonne réponse)*

- [ ] **A.** Cela restaure le comportement par défaut (tous les événements)
- [ ] **B.** Cela lève une exception de configuration
- [ ] **C.** Cela ne dispatch que le guard event
- [ ] **D.** Cela ne dispatch aucun événement

### Question 69

Entre la désactivation d'un événement au niveau d'un `apply()` spécifique et sa configuration globale dans le workflow, laquelle prévaut ? *(une seule bonne réponse)*

- [ ] **A.** La désactivation via le contexte d'un `apply()` spécifique prend le pas sur la configuration du workflow
- [ ] **B.** La configuration globale du workflow prévaut toujours
- [ ] **C.** Les deux sont fusionnées : l'événement est déclenché si l'un des deux le permet
- [ ] **D.** Il n'est pas possible de désactiver un événement au niveau d'un `apply()` individuel

## Blocking Transitions

### Question 70

Quelles sont les deux façons documentées de définir un « guard » sur une transition ? *(une seule bonne réponse)*

- [ ] **A.** Via une méthode PHP magique `__guard()` sur l'entité
- [ ] **B.** En écoutant les guard events, ou en définissant une option de configuration `guard` sur la transition
- [ ] **C.** Uniquement via les guard events, l'option de configuration n'existant pas
- [ ] **D.** Uniquement via l'option de configuration, les guard events étant dépréciés

### Question 71

L'option de configuration `guard` accepte une expression valide de quel composant ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Validator
- [ ] **B.** Le composant Security, uniquement
- [ ] **C.** Le composant Serializer
- [ ] **D.** Le composant ExpressionLanguage

### Question 72

Dans l'exemple de guard fourni par la documentation, quelles fonctions d'expression sont explicitement citées comme utilisables ? *(plusieurs bonnes réponses)*

- [ ] **A.** `is_granted('ROLE_REVIEWER')`
- [ ] **B.** `is_authenticated`
- [ ] **C.** `is_remember_me`
- [ ] **D.** `is_fully_authenticated`

### Question 73

Dans une expression de guard, à quoi le mot-clé `subject` fait-il référence ? *(une seule bonne réponse)*

- [ ] **A.** L'utilisateur actuellement connecté
- [ ] **B.** Le workflow lui-même
- [ ] **C.** L'objet supporté par le workflow
- [ ] **D.** La transition en cours d'évaluation

### Question 74

Quel mécanisme permet de bloquer une transition tout en retournant un message d'erreur convivial pour l'utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** Une exception `BlockedTransitionException`
- [ ] **B.** Un simple `return false;` dans le listener
- [ ] **C.** La méthode `Workflow::block()`
- [ ] **D.** Les « transition blockers », via la classe `TransitionBlocker`

### Question 75

Dans l'exemple `BlogPostPublishSubscriber`, où le message de blocage est-il récupéré, pour offrir un endroit central de gestion du texte ? *(une seule bonne réponse)*

- [ ] **A.** Dans un fichier de traduction `.yaml` dédié, uniquement
- [ ] **B.** Dans les métadonnées (`metadata`) de la transition, via `$event->getMetadata()`
- [ ] **C.** Dans une constante de classe codée en dur
- [ ] **D.** Dans une requête à la base de données

### Question 76

Quels sont les deux arguments passés au constructeur de `TransitionBlocker` dans cet exemple (`new TransitionBlocker($explanation, '0')`) ? *(une seule bonne réponse)*

- [ ] **A.** Un message et une instance de `Transition`
- [ ] **B.** Un code HTTP et un message
- [ ] **C.** Un message d'explication et un code (chaîne)
- [ ] **D.** Une place et une transition

### Question 77

Pour gérer les messages en un seul endroit en production, plutôt que l'exemple simplifié, quel composant la documentation suggère-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Translation
- [ ] **B.** Le composant Serializer
- [ ] **C.** Le composant Notifier
- [ ] **D.** Le composant Templating

## Creating Your Own Marking Store

### Question 78

Quelle interface faut-il implémenter pour créer son propre marking store ? *(une seule bonne réponse)*

- [ ] **A.** `MarkingInterface`
- [ ] **B.** `Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface`
- [ ] **C.** `WorkflowStoreInterface`
- [ ] **D.** `CustomMarkingInterface`

### Question 79

Que fait la méthode `getMarking()` d'un marking store personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Elle définit la nouvelle place du sujet
- [ ] **B.** Elle retourne un tableau associatif brut, jamais un objet `Marking`
- [ ] **C.** Elle retourne une instance de `Marking` représentant l'état courant du sujet
- [ ] **D.** Elle ne prend aucun argument, contrairement à `setMarking()`

### Question 80

Quelle est la signature de la méthode `setMarking()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne un objet `Marking` mis à jour
- [ ] **B.** Elle ne prend que le sujet en argument
- [ ] **C.** Elle prend un `Marking` et retourne un booléen de succès
- [ ] **D.** Elle prend le sujet, un `Marking`, et un tableau de contexte optionnel, sans valeur de retour

### Question 81

Comment configure-t-on un workflow pour utiliser un marking store personnalisé (un service) ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `marking_store.class`
- [ ] **B.** Via l'option `marking_store.service`, en indiquant le FQCN du service
- [ ] **C.** Ce n'est pas configurable en YAML, uniquement en PHP
- [ ] **D.** Via un tag de service `workflow.marking_store` obligatoire

### Question 82

Pour quelle raison la documentation suggère-t-elle d'implémenter son propre marking store ? *(une seule bonne réponse)*

- [ ] **A.** Pour remplacer entièrement le composant `EventDispatcher`
- [ ] **B.** Pour éviter d'avoir à définir des places dans la configuration
- [ ] **C.** Pour exécuter une logique additionnelle lorsque le marking est mis à jour
- [ ] **D.** Parce que `MethodMarkingStore` ne fonctionnerait qu'avec Doctrine

## Usage in Twig

### Question 83

Que fait la fonction Twig `workflow_can()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne toutes les transitions activées pour un objet
- [ ] **B.** Elle retourne les places marquées d'un objet
- [ ] **C.** Elle retourne les blockers d'une transition
- [ ] **D.** Elle retourne `true` si l'objet donné peut effectuer la transition donnée

### Question 84

Que retourne `workflow_transitions()` ? *(une seule bonne réponse)*

- [ ] **A.** Une seule transition spécifique, par son nom
- [ ] **B.** Le nombre de transitions activées, sous forme d'entier
- [ ] **C.** Un tableau avec toutes les transitions activées pour l'objet donné
- [ ] **D.** Les places marquées de l'objet

### Question 85

Que retourne `workflow_marked_places()` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen indiquant si une place précise est marquée
- [ ] **B.** Un tableau avec les noms des places de la marque (« marking ») donnée
- [ ] **C.** Les métadonnées de toutes les places
- [ ] **D.** Uniquement la première place marquée

### Question 86

Que retourne `workflow_has_marked_place()` ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les places marquées, sous forme de tableau
- [ ] **B.** Le nombre de places actuellement marquées
- [ ] **C.** La transition permettant d'atteindre cette place
- [ ] **D.** `true` si le marking de l'objet donné a l'état (place) donné

### Question 87

Que retourne `workflow_transition_blockers()` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen indiquant si la transition est bloquée
- [ ] **B.** La liste de toutes les transitions bloquées de tout le workflow
- [ ] **C.** Une `TransitionBlockerList` pour la transition donnée
- [ ] **D.** Le message d'erreur de la dernière transition bloquée uniquement

### Question 88

À quoi sert le dernier paramètre optionnel, commun à toutes les fonctions `workflow_*` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen `$strict`
- [ ] **B.** Le nom du workflow (`$name`), utile quand l'objet est associé à plusieurs workflows
- [ ] **C.** Un tableau de contexte `$context`
- [ ] **D.** Un objet `Marking` explicite

### Question 89

Que fait le second paramètre `$placesNameOnly` de `workflow_marked_places()`, avec sa valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `false` par défaut : il retourne les objets Place complets
- [ ] **B.** `true` par défaut, mais force la sortie en JSON
- [ ] **C.** Il n'existe pas de second paramètre pour cette fonction
- [ ] **D.** `true` par défaut : il retourne uniquement les noms des places

### Question 90

Comment boucle-t-on sur les transitions activées d'un objet dans un template Twig, d'après l'exemple de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de fonction Twig équivalente pour cela
- [ ] **B.** `{{ workflow_loop(post) }}`
- [ ] **C.** `{% for transition in workflow_transitions(post) %}`
- [ ] **D.** `{% workflow_each(post) as transition %}`

## Storing Metadata

### Question 91

Sur quels éléments l'option `metadata` peut-elle être définie ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le workflow lui-même
- [ ] **B.** Les places
- [ ] **C.** Les transitions
- [ ] **D.** Les événements (`Event`) directement en configuration

### Question 92

Que peut contenir cette métadonnée, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Un simple titre, ou des objets très complexes
- [ ] **B.** Uniquement des chaînes de caractères
- [ ] **C.** Uniquement des tableaux d'entiers
- [ ] **D.** Uniquement des booléens

### Question 93

Quelle méthode retourne le tableau des métadonnées au niveau du workflow lui-même ? *(une seule bonne réponse)*

- [ ] **A.** `getMetadataStore()->getPlaceMetadata()`
- [ ] **B.** `getMetadataStore()->getWorkflowMetadata()`
- [ ] **C.** `getMetadataStore()->getGlobalMetadata()`
- [ ] **D.** `getDefinition()->getMetadata()`

### Question 94

Quel argument attend `getPlaceMetadata()` ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `Transition`
- [ ] **B.** Un objet `Marking`
- [ ] **C.** Le nom de la place, sous forme de chaîne
- [ ] **D.** Aucun argument : elle retourne toutes les places

### Question 95

Quel argument attend `getTransitionMetadata()` ? *(une seule bonne réponse)*

- [ ] **A.** Le nom de la transition, sous forme de chaîne uniquement
- [ ] **B.** Un tableau de transitions
- [ ] **C.** L'objet `Workflow` lui-même
- [ ] **D.** Un objet `Transition`

### Question 96

Comment la méthode unifiée `getMetadata()` détermine-t-elle si elle retourne une métadonnée de workflow, de place ou de transition ? *(une seule bonne réponse)*

- [ ] **A.** Via son second argument optionnel : rien (workflow), un nom de place (chaîne), ou un objet `Transition`
- [ ] **B.** Via un troisième argument obligatoire précisant le type
- [ ] **C.** Il faut appeler trois méthodes différentes, `getMetadata()` seule ne suffisant jamais
- [ ] **D.** Via le type de retour PHP (union type), déterminé automatiquement

### Question 97

En dehors des contrôleurs, où d'autre peut-on accéder aux métadonnées ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement dans les Repository Doctrine
- [ ] **B.** Dans un Listener, via l'objet `Event`
- [ ] **C.** Uniquement via la CLI `workflow:dump`
- [ ] **D.** Les métadonnées ne sont accessibles que dans les templates Twig

### Question 98

Quelle fonction Twig permet d'accéder aux métadonnées dans un template ? *(une seule bonne réponse)*

- [ ] **A.** `workflow_meta()`
- [ ] **B.** `workflow_info()`
- [ ] **C.** `workflow_metadata()`
- [ ] **D.** `workflow_data()`

### Question 99

Dans l'exemple Twig itérant sur les places marquées, que représente le troisième argument optionnel de `workflow_metadata()` (ex. `workflow_metadata(blog_post, 'max_num_of_words', place)`) ? *(une seule bonne réponse)*

- [ ] **A.** Le contexte de la dernière transition appliquée
- [ ] **B.** Un booléen forçant le format JSON
- [ ] **C.** Le nom du workflow, uniquement
- [ ] **D.** Une place ou une transition, pour cibler la métadonnée correspondante

### Question 100

Quelle clé de métadonnée, dans l'exemple de guard sur la transition `publish`, sert à limiter l'heure de publication ? *(une seule bonne réponse)*

- [ ] **A.** `hour_limit`
- [ ] **B.** `max_publish_hour`
- [ ] **C.** `publish_deadline`
- [ ] **D.** `time_limit`

## Validating Workflow Definitions

### Question 101

Quelle interface faut-il implémenter pour valider une définition de workflow avec sa propre logique ? *(une seule bonne réponse)*

- [ ] **A.** `WorkflowValidatorInterface`
- [ ] **B.** `Symfony\Component\Workflow\Validator\DefinitionValidatorInterface`
- [ ] **C.** `DefinitionCheckerInterface`
- [ ] **D.** `ConstraintValidatorInterface` (composant Validator)

### Question 102

Quelle est la signature de la méthode `validate()` de cette interface ? *(une seule bonne réponse)*

- [ ] **A.** `validate(Workflow $workflow): bool`
- [ ] **B.** `validate(array $config): array`
- [ ] **C.** `validate(Definition $definition, string $name): void`
- [ ] **D.** `validate(string $name): Definition`

### Question 103

Quelle exception l'exemple de validateur personnalisé lève-t-il si la définition est invalide ? *(une seule bonne réponse)*

- [ ] **A.** `LogicException`
- [ ] **B.** `WorkflowException`
- [ ] **C.** `ValidationFailedException`
- [ ] **D.** `Symfony\Component\Workflow\Exception\InvalidDefinitionException`

### Question 104

Quelle option de configuration permet d'enregistrer des validateurs personnalisés pour un workflow ? *(une seule bonne réponse)*

- [ ] **A.** `definition_validators`
- [ ] **B.** `validators`
- [ ] **C.** `custom_validators`
- [ ] **D.** `validation_rules`

## Annexe — Workflows and State Machines

### Question 105

Qu'est-ce qu'un workflow, selon cette page ? *(une seule bonne réponse)*

- [ ] **A.** Une architecture technique de microservices
- [ ] **B.** Un pattern de cache distribué
- [ ] **C.** Un modèle du processus d'une application
- [ ] **D.** Un ORM permettant de modéliser des transitions d'état en base de données

### Question 106

De quoi une **définition** de workflow se compose-t-elle, d'après cette page ? *(une seule bonne réponse)*

- [ ] **A.** De « Migrations » et de « Places »
- [ ] **B.** D'« États » et de « Handlers »
- [ ] **C.** De « Steps » et de « Listeners »
- [ ] **D.** De places et de transitions (les actions qui permettent de passer d'une place à une autre)

### Question 107

À quelle terminologie proche cette page fait-elle référence pour désigner workflows et state machines ? *(une seule bonne réponse)*

- [ ] **A.** Les réseaux de Petri (« Petri nets »)
- [ ] **B.** Les machines de Turing
- [ ] **C.** Les diagrammes UML de séquence
- [ ] **D.** Les grammaires formelles de Chomsky

### Question 108

Dans l'exemple de candidature à un emploi (« job application »), combien d'étapes le processus comporte-t-il, selon le poste ? *(une seule bonne réponse)*

- [ ] **A.** Toujours exactement 5 étapes
- [ ] **B.** Entre 4 et 7 étapes
- [ ] **C.** Entre 2 et 3 étapes
- [ ] **D.** Toujours 10 étapes

### Question 109

Qu'est-ce qui détermine, dans cet exemple, les prochaines étapes autorisées ? *(une seule bonne réponse)*

- [ ] **A.** Un algorithme de machine learning
- [ ] **B.** Une simple condition `if`/`else` dans le contrôleur
- [ ] **C.** Le `GuardEvent`
- [ ] **D.** Un vote de sécurité (« Voter »)

### Question 110

Quelle est la première différence clé entre workflows et state machines, concernant le nombre de places occupées à la fois ? *(une seule bonne réponse)*

- [ ] **A.** Les deux peuvent être dans plusieurs places à la fois, sans différence
- [ ] **B.** Un state machine peut être dans plusieurs places, contrairement à un workflow
- [ ] **C.** Ni l'un ni l'autre ne peut être dans plusieurs places
- [ ] **D.** Les workflows peuvent être dans plus d'une place à la fois, contrairement aux state machines

### Question 111

Quelle est la seconde différence clé, sur la condition requise pour appliquer une transition ? *(une seule bonne réponse)*

- [ ] **A.** Un workflow exige que l'objet soit dans toutes les places précédentes de la transition ; un state machine se contente d'au moins une
- [ ] **B.** C'est l'inverse : le state machine exige toutes les places, le workflow une seule
- [ ] **C.** Les deux exigent systématiquement toutes les places précédentes
- [ ] **D.** Aucun des deux ne vérifie les places précédentes avant d'appliquer une transition

### Question 112

Dans l'exemple de pull request, dans quel état se trouve la pull request une fois les tests d'intégration continue terminés ? *(une seule bonne réponse)*

- [ ] **A.** "merged"
- [ ] **B.** "review"
- [ ] **C.** "coding"
- [ ] **D.** "closed"

### Question 113

Que précise le commentaire de configuration à propos de l'option `supports`, dans l'exemple de la state machine `pull_request` ? *(une seule bonne réponse)*

- [ ] **A.** Elle est obligatoire pour toute state machine, sans exception
- [ ] **B.** Elle sert uniquement à la validation Doctrine
- [ ] **C.** Elle n'est utile que si l'on utilise les fonctions Twig (`workflow_*`)
- [ ] **D.** Elle définit les rôles de sécurité autorisés à déclencher les transitions

### Question 114

Quelle transition permet de repartir de l'état "closed" vers l'état "review" ? *(une seule bonne réponse)*

- [ ] **A.** "reopen" mène en réalité vers "coding", pas vers "review"
- [ ] **B.** Il n'existe aucune transition partant de "closed"
- [ ] **C.** "reject" permet ce retour
- [ ] **D.** "reopen", de "closed" vers "review"

### Question 115

Depuis quelles places la transition "update" est-elle possible, dans cet exemple ? *(une seule bonne réponse)*

- [ ] **A.** `[coding, test, review]`
- [ ] **B.** `[start, test]`
- [ ] **C.** Uniquement `test`
- [ ] **D.** `[review, merged, closed]`

### Question 116

En suivant la convention de nommage par autowiring, quel est le nom du paramètre pour injecter la state machine `pull_request` ? *(une seule bonne réponse)*

- [ ] **A.** `$pullRequestWorkflow`
- [ ] **B.** `$stateMachinePullRequest`
- [ ] **C.** `$pullRequestStateMachine`
- [ ] **D.** `$pull_request_state_machine`

### Question 117

Quand les workflows et state machines définis dans des fichiers de configuration sont-ils automatiquement validés ? *(une seule bonne réponse)*

- [ ] **A.** À chaque appel de `apply()`, ce qui ralentirait les performances
- [ ] **B.** Pendant le cache warmup
- [ ] **C.** Uniquement lors de l'exécution de `workflow:dump`
- [ ] **D.** Jamais automatiquement, une commande dédiée étant nécessaire

### Question 118

Si des workflows ou state machines sont définis de façon programmatique plutôt qu'en configuration, comment les valider ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont automatiquement validés au premier `apply()`, peu importe leur origine
- [ ] **B.** Ce n'est pas possible de les valider, seule la configuration YAML l'est
- [ ] **C.** Via un simple appel à `Definition::isValid()`
- [ ] **D.** En utilisant `Symfony\Component\Workflow\Validator\WorkflowValidator` ou `StateMachineValidator`

### Question 119

Dans l'exemple de définition invalide, pourquoi la seconde transition "activate" est-elle invalide ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elle duplique un événement "from" le même état "created", déjà utilisé par une autre transition "activate"
- [ ] **B.** Parce que son nom est réservé par le composant
- [ ] **C.** Parce que l'état "deleted" n'existe pas dans la liste des états
- [ ] **D.** Parce qu'elle n'a pas de méthode `to()` définie

### Question 120

Quelle exception `StateMachineValidator::validate()` lève-t-il en cas de définition invalide ? *(une seule bonne réponse)*

- [ ] **A.** `LogicException`
- [ ] **B.** `InvalidDefinitionException`
- [ ] **C.** `WorkflowValidationException`
- [ ] **D.** `StateMachineException`

### Question 121

Une validation est-elle effectuée lors de l'instanciation `new Definition($states, $stateTransitions)` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, une validation complète est systématiquement effectuée à l'instanciation
- [ ] **B.** Seulement une validation partielle des noms de transitions
- [ ] **C.** Non, aucune validation n'est faite lors de l'initialisation
- [ ] **D.** Une validation est faite uniquement en environnement de développement

### Question 122

Quel est le workflow le plus simple présenté sur cette page ? *(une seule bonne réponse)*

- [ ] **A.** Trois places et deux transitions
- [ ] **B.** Une seule place, aucune transition
- [ ] **C.** Quatre places et trois transitions (l'exemple du blog)
- [ ] **D.** Deux places et une seule transition

### Question 123

Quel est le rôle du marking store, d'après l'introduction de cette page ? *(une seule bonne réponse)*

- [ ] **A.** Il écrit la place courante sur une propriété de l'objet
- [ ] **B.** Il gère l'authentification de l'utilisateur déclenchant la transition
- [ ] **C.** Il génère les événements du workflow
- [ ] **D.** Il stocke l'historique complet de toutes les transitions passées

### Question 124

D'après cette page, où les workflows doivent-ils être définis, par rapport aux modèles de l'application ? *(une seule bonne réponse)*

- [ ] **A.** Directement dans le code des entités du modèle
- [ ] **B.** Tenus à l'écart des modèles, et définis en configuration
- [ ] **C.** Dans le contrôleur
- [ ] **D.** Peu importe, aucune recommandation n'est faite

## Annexe — How to Dump Workflows

### Question 125

À quoi sert la commande `workflow:dump` ? *(une seule bonne réponse)*

- [ ] **A.** Exporter la configuration YAML vers PHP
- [ ] **B.** Générer un jeu de tests unitaires pour le workflow
- [ ] **C.** Générer une représentation visuelle du workflow, en SVG ou PNG, pour le déboguer
- [ ] **D.** Migrer un workflow d'un environnement à un autre

### Question 126

Quels outils libres et open source la documentation cite-t-elle pour générer ces images ? *(plusieurs bonnes réponses)*

- [ ] **A.** Graphviz (commande `dot`)
- [ ] **B.** Mermaid CLI (commande `mmdc`)
- [ ] **C.** PlantUML (`plantuml.jar`, nécessite Java)
- [ ] **D.** Inkscape

### Question 127

Quelle commande de base permet de générer un SVG via Graphviz ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console workflow:dump workflow-name | dot -Tsvg -o graph.svg`
- [ ] **B.** `php bin/console workflow:dump workflow-name --format=svg`
- [ ] **C.** `php bin/console workflow:export workflow-name > graph.svg`
- [ ] **D.** `dot php bin/console workflow:dump workflow-name -o graph.svg`

### Question 128

Quelle option permet d'utiliser le format de sortie PlantUML ? *(une seule bonne réponse)*

- [ ] **A.** `--dump-format=uml`
- [ ] **B.** `--dump-format=puml`
- [ ] **C.** `--format=plantuml`
- [ ] **D.** `--plantuml`

### Question 129

Comment mettre en évidence des places précises dans le dump généré ? *(une seule bonne réponse)*

- [ ] **A.** Via une option `--highlight=place1,place2`
- [ ] **B.** Ce n'est pas possible, seul un post-traitement manuel du SVG le permet
- [ ] **C.** Via une option `--places=place1 place2`
- [ ] **D.** En les passant en arguments positionnels après le nom du workflow (ex. `workflow:dump workflow-name place1 place2`)

### Question 130

Quel format/option utiliser pour produire une image via Mermaid.js CLI ? *(une seule bonne réponse)*

- [ ] **A.** `--dump-format=mmd`
- [ ] **B.** `--format=mermaid.js`
- [ ] **C.** `--dump-format=mermaid`
- [ ] **D.** Il n'existe pas de format Mermaid, seuls DOT et PlantUML sont supportés

### Question 131

En dehors d'une application Symfony, quelle classe permet de créer des fichiers DOT pour un workflow classique ? *(une seule bonne réponse)*

- [ ] **A.** `GraphvizDumper`
- [ ] **B.** `DotDumper`
- [ ] **C.** `WorkflowDumper`
- [ ] **D.** `SvgDumper`

### Question 132

Quelle classe dédiée est utilisée pour le dump DOT spécifique d'une state machine ? *(une seule bonne réponse)*

- [ ] **A.** `GraphvizDumper` fonctionne indifféremment, sans classe dédiée
- [ ] **B.** `StateMachineGraphvizDumper`
- [ ] **C.** `StateGraphDumper`
- [ ] **D.** `MachineDumper`

### Question 133

Quelle classe permet de créer des fichiers PlantUML ? *(une seule bonne réponse)*

- [ ] **A.** `UmlDumper`
- [ ] **B.** `PlantUmlGraphvizDumper`
- [ ] **C.** Un `Dumper` générique, avec une option
- [ ] **D.** `PlantUmlDumper`

### Question 134

Quelle option permet d'inclure les places, transitions et métadonnées du workflow dans le dump ? *(une seule bonne réponse)*

- [ ] **A.** `--with-metadata`
- [ ] **B.** `--include-metadata`
- [ ] **C.** `--verbose-metadata`
- [ ] **D.** `--full`

### Question 135

Quel(s) dumper(s) supporte(nt) actuellement cette option ? *(une seule bonne réponse)*

- [ ] **A.** Tous les dumpers (DOT, PlantUML et Mermaid)
- [ ] **B.** Uniquement PlantUML
- [ ] **C.** Uniquement le dumper DOT, pour le moment
- [ ] **D.** Uniquement Mermaid

### Question 136

Pourquoi la métadonnée `label` d'une place n'est-elle pas incluse dans le dump des métadonnées ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elle est réservée à un usage interne de Symfony
- [ ] **B.** Parce qu'elle ne peut contenir que des chaînes vides
- [ ] **C.** Elle n'est pas exclue : elle est incluse comme les autres
- [ ] **D.** Parce qu'elle est utilisée comme titre de la place

### Question 137

Quelles clés de métadonnées permettent de styliser les **places** ? *(plusieurs bonnes réponses)*

- [ ] **A.** `bg_color`
- [ ] **B.** `description`
- [ ] **C.** `label`
- [ ] **D.** `arrow_color`

### Question 138

Quelles clés de métadonnées permettent de styliser les **transitions** ? *(plusieurs bonnes réponses)*

- [ ] **A.** `label`
- [ ] **B.** `color`
- [ ] **C.** `arrow_color`
- [ ] **D.** `bg_color`

### Question 139

Que peuvent contenir les chaînes de ces métadonnées, pour afficher un contenu sur plusieurs lignes ? *(une seule bonne réponse)*

- [ ] **A.** Des balises HTML `<br>`
- [ ] **B.** Des caractères `\n`
- [ ] **C.** Des balises Markdown
- [ ] **D.** Ce n'est pas supporté, tout doit tenir sur une seule ligne

### Question 140

Sous quels formats les couleurs peuvent-elles être définies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un nom de couleur de la liste de couleurs de PlantUML
- [ ] **B.** Une couleur hexadécimale au format `#AABBCC`
- [ ] **C.** Une couleur hexadécimale courte au format `#ABC`
- [ ] **D.** Un nom de couleur CSS3 générique, type `cornflowerblue`

### Question 141

Quelle est la limitation du dumper Mermaid concernant la coloration ? *(une seule bonne réponse)*

- [ ] **A.** Il ne supporte pas la coloration des têtes de flèches via `arrow_color`, Mermaid ne le permettant pas
- [ ] **B.** Il ne supporte aucune couleur du tout, ni pour les places ni pour les transitions
- [ ] **C.** Il ne supporte que les couleurs hexadécimales, pas les noms de la liste PlantUML
- [ ] **D.** Il ne supporte pas le `bg_color` des places

### Question 142

Dans l'exemple stylisé de la state machine `pull_request`, quelle métadonnée est utilisée sur la place "review" ? *(une seule bonne réponse)*

- [ ] **A.** `bg_color: Orange`
- [ ] **B.** `label: Human review`
- [ ] **C.** `description: Human review`
- [ ] **D.** `arrow_color: Turquoise`

### Question 143

Quelle métadonnée est utilisée sur la place "closed", dans ce même exemple ? *(une seule bonne réponse)*

- [ ] **A.** `description: Closed pull request`
- [ ] **B.** `label: Closed`
- [ ] **C.** `color: DeepSkyBlue`
- [ ] **D.** `bg_color: DeepSkyBlue`

### Question 144

Quelle métadonnée donne un libellé personnalisé à la transition "accept", dans ce même exemple ? *(une seule bonne réponse)*

- [ ] **A.** `description: Accept PR`
- [ ] **B.** `label: Accept PR`
- [ ] **C.** `color: Accept PR`
- [ ] **D.** `bg_color: Accept PR`

### Question 145

Quelle couleur est utilisée pour `arrow_color` sur la transition "update", dans ce même exemple ? *(une seule bonne réponse)*

- [ ] **A.** Turquoise
- [ ] **B.** Orange
- [ ] **C.** DeepSkyBlue
- [ ] **D.** Aucune couleur d'arc n'est définie pour "update"

### Question 146

Quelle couleur est utilisée via la clé `color` sur la transition "wait_for_review" ? *(une seule bonne réponse)*

- [ ] **A.** Turquoise
- [ ] **B.** DeepSkyBlue
- [ ] **C.** Orange
- [ ] **D.** Aucune couleur n'est définie pour cette transition

---

## Corrigé

**Question 1 : B** — « In applications using Symfony Flex, run this command to install the workflow feature before using it: `$ composer require symfony/workflow`. » *(§ Installation)*

**Question 2 : D** — « `$ php bin/console config:dump-reference framework workflows`. » *(§ Configuration)*

**Question 3 : C** — « A set of places and transitions creates a definition. » *(§ Creating a Workflow)*

**Question 4 : A** — « A workflow needs a `Definition` and a way to write the states to the objects (i.e. an instance of a `MarkingStoreInterface`.) » *(§ Creating a Workflow)*

**Question 5 : D** — « a "workflow" must use a "multiple_state" marking store and a "state_machine" must use a "single_state" marking store. » *(§ Creating a Workflow)*

**Question 6 : B** — « A single state marking store uses a `string` to store the data. A multiple state marking store uses an `array` to store the data. » *(§ Creating a Workflow)*

**Question 7 : A** — « If no state marking store is defined you have to return `null` in both cases. » *(§ Creating a Workflow)*

**Question 8 : C** — « `property` (default value `['marking']`) attributes of the `marking_store` option are optional. » *(§ Creating a Workflow)*

**Question 9 : B** — « Setting the `audit_trail.enabled` option to `true` makes the application generate detailed log messages for the workflow activity. » *(§ Creating a Workflow)*

**Question 10 : D** — « `$workflow->can($post, 'publish')` » vérifie, tandis que `$workflow->apply($post, 'to_review')` s'exécute dans un bloc try/catch attrapant une `LogicException`. *(§ Creating a Workflow)*

**Question 11 : A** — « See all the available transitions (…) `getEnabledTransitions($post)`; See a specific available transition (…) `getEnabledTransition($post, 'publish')`. » *(§ Creating a Workflow)*

**Question 12 : B** — « You can omit the `places` option if your transitions define all the places that are used in the workflow. Symfony will automatically extract the places from the transitions. » *(§ Creating a Workflow)*

**Question 13 : C** — « You can use PHP constants in YAML files via the `!php/const` notation. » *(§ Creating a Workflow)*

**Question 14 : D** — « You should not use the type `simple_array` for your marking store (…) this Doctrine type will store its value only as a string, resulting in the loss of the object's current place. » *(§ Using a multiple state marking store)*

**Question 15 : A** — « places are stored as keys with a value of one, such as `['draft' => 1]`. » *(§ Using a multiple state marking store)*

**Question 16 : D** — « When using public properties, context is not supported. In order to support it, you must declare a setter to write your property. » *(§ Creating a Workflow)*

**Question 17 : B** — « When using a state machine, you can use PHP backend enums as places in your workflows. » *(§ Using Enums in Workflows)*

**Question 18 : C** — « First, define your enum with backed values (…) `enum BlogPostStatus: string`. » *(§ Using Enums in Workflows)*

**Question 19 : A** — « `initial_marking: !php/enum App\Enumeration\BlogPostStatus::Draft`. » *(§ Using Enums in Workflows)*

**Question 20 : B** — « The component will now transparently cast the enum to its backing value when needed and vice-versa. » *(§ Using Enums in Workflows)*

**Question 21 : D** — « You can also use glob patterns of PHP constants and enums to list the places. » *(§ Using Enums in Workflows)*

**Question 22 : A** — « you can type-hint the property with a `BackedEnum` instead of a string. » *(§ Using Enums in Workflows — Using Enums is Marking Stores)*

**Question 23 : C** — « The `MethodMarkingStore` will automatically convert between the enum and its backing value. » *(§ Using Enums in Workflows — Using Enums is Marking Stores)*

**Question 24 : B** — cette conversion automatique est documentée « When using a single state marking store ». *(§ Using Enums in Workflows — Using Enums is Marking Stores)*

**Question 25 : C** — « Weighted transitions introduce multiplicity: a place can now track how many times an object is in that place. » *(§ Using Weighted Transitions)*

**Question 26 : D** — « A key feature of workflows (as opposed to state machines) is that an object can be in multiple places simultaneously. » *(§ Using Weighted Transitions)*

**Question 27 : A** — « Weighted transitions can also be defined programmatically using the `Symfony\Component\Workflow\Arc` class. » *(§ Using Weighted Transitions)*

**Question 28 : B** — « The `Arc` class takes two parameters: the place name and the weight (which must be greater than or equal to 1). » *(§ Using Weighted Transitions)*

**Question 29 : C** — « When a place is specified as a simple string instead of an `Arc` object, it defaults to a weight of 1. » *(§ Using Weighted Transitions)*

**Question 30 : D** — « the `build_leg` transition must be applied 4 times (once for each token). » *(§ Using Weighted Transitions)*

**Question 31 : A** — la transition `start` a un `to` sous forme de liste `place`/`weight` (`prepare_leg` poids 4, `prepare_top` poids 1, `stopwatch_running` poids 1). *(§ Using Weighted Transitions)*

**Question 32 : B** — « `'top_created', // weight defaults to 1`. » *(§ Using Weighted Transitions)*

**Question 33 : A, B, D** — « useful for modeling complex workflows such as manufacturing processes, resource allocation, or any scenario where multiple instances of something need to be produced or consumed. » *(§ Using Weighted Transitions)*

**Question 34 : C** — « `#[ORM\Column(type: Types::JSON)] private array $currentPlaces;`. » *(§ Using a multiple state marking store)*

**Question 35 : D** — « Symfony creates a service for each workflow you define. » *(§ Accessing the Workflow in a Class)*

**Question 36 : A** — « Type-hint your constructor/method argument with `WorkflowInterface` and name the argument using this pattern: "workflow name in camelCase" + `Workflow` suffix. If it is a state machine type, use the `StateMachine` suffix. » *(§ Accessing the Workflow in a Class — (1) Use a specific argument name)*

**Question 37 : B** — « the `#[Target]` attribute helps you select which one to inject (…) `#[Target('blog_publishing')] private WorkflowInterface $workflow`. » *(§ Accessing the Workflow in a Class — (2) Use the #[Target] attribute)*

**Question 38 : C** — « `workflow`: all workflows and all state machine. » *(§ Accessing the Workflow in a Class)*

**Question 39 : D** — « `workflow.workflow`: all workflows; `workflow.state_machine`: all state machines. » *(§ Accessing the Workflow in a Class)*

**Question 40 : A** — « You can find the list of available workflow services with the `php bin/console debug:autowiring workflow` command. » *(§ Accessing the Workflow in a Class)*

**Question 41 : C** — « Use the `AutowireLocator` attribute to lazy-load all workflows (…) `#[AutowireLocator('workflow', 'name')]`. » *(§ Accessing the Workflow in a Class — Injecting Multiple Workflows)*

**Question 42 : D** — « 'name' tells Symfony to index services using that tag property. » *(§ Accessing the Workflow in a Class — Injecting Multiple Workflows)*

**Question 43 : A** — « otherwise, you must use the full service name with the 'workflow.' prefix (e.g. 'workflow.user_registration'). » *(§ Accessing the Workflow in a Class — Injecting Multiple Workflows)*

**Question 44 : A** — « You can also inject only workflows or only state machines: `#[AutowireLocator('workflow.workflow', 'name')]` (…) `#[AutowireLocator('workflow.state_machine', 'name')]`. » *(§ Accessing the Workflow in a Class — Injecting Multiple Workflows)*

**Question 45 : B** — « you can use `Symfony\Component\Workflow\WorkflowInterface::getEnabledTransition` method. » *(§ Accessing the Workflow in a Class)*

**Question 46 : C** — « workflow metadata are attached to tags under the `metadata` key. » *(§ Accessing the Workflow in a Class)*

**Question 47 : D** — « An event for every workflow; An event for the workflow concerned; An event for the workflow concerned with the specific transition or place name. » *(§ Using Events)*

**Question 48 : A** — l'ordre documenté : `workflow.guard`, `workflow.leave`, `workflow.transition`, `workflow.enter`, `workflow.entered`, `workflow.completed`, `workflow.announce`. *(§ Using Events)*

**Question 49 : A, B, C, D** — les quatre noms font partie des sept événements listés dans l'ordre de dispatch (`workflow.guard`, `workflow.leave`, `workflow.transition`, `workflow.enter`, `workflow.entered`, `workflow.completed`, `workflow.announce`). *(§ Using Events)*

**Question 50 : B** — « `workflow.guard` Validate whether the transition is blocked or not. » *(§ Using Events)*

**Question 51 : C** — « This event is triggered right before the subject places are updated, which means that the marking of the subject is not yet updated with the new places. » *(§ Using Events — workflow.enter)*

**Question 52 : D** — « `workflow.entered` The subject has entered in the places and the marking is updated. » *(§ Using Events)*

**Question 53 : A** — « `workflow.completed` The object has completed this transition. » *(§ Using Events)*

**Question 54 : B** — « After a transition is applied, the announce event tests for all available transitions. That will trigger all guard events once more. » *(§ Using Events — workflow.announce)*

**Question 55 : C** — « `$workflow->apply($subject, $transitionName, [Workflow::DISABLE_ANNOUNCE_EVENT => true]);`. » *(§ Using Events — workflow.announce)*

**Question 56 : A** — « The leaving and entering events are triggered even for transitions that stay in the same place. » *(§ Using Events)*

**Question 57 : D** — « If you initialize the marking by calling `$workflow->getMarking($object);`, then the `workflow.[workflow_name].entered.[initial_place_name]` event will be called with the default context. » *(§ Using Events)*

**Question 58 : B** — « `LeaveEvent::getName('blog_publishing') => 'onLeave'`. » *(§ Using Events)*

**Question 59 : C** — « You can also use this method in your custom events via the `Symfony\Component\Workflow\Event\EventNameTrait`. » *(§ Using Events)*

**Question 60 : A, B, D** — les sept attributs listés incluent `AsGuardListener`, `AsTransitionListener` et `AsCompletedListener` (ainsi qu'`AsLeaveListener`, `AsEnterListener`, `AsEnteredListener`, `AsAnnounceListener`). *(§ Using Events)*

**Question 61 : A** — « These attributes do work like the `Symfony\Component\EventDispatcher\Attribute\AsEventListener` attributes. » *(§ Using Events)*

**Question 62 : B** — « `Event::getMarking` Returns the `Marking` of the workflow. » *(§ Using Events — Event Methods)*

**Question 63 : D** — « `Event::getWorkflowName` Returns a string with the name of the workflow that triggered the event. » *(§ Using Events — Event Methods)*

**Question 64 : A, B, D** — « `GuardEvent::isBlocked`, `GuardEvent::setBlocked`, `GuardEvent::addTransitionBlocker`. » `getMarking()` (option C) est héritée de la classe `Event` de base, pas spécifique à `GuardEvent`. *(§ Using Events — Event Methods)*

**Question 65 : A** — « `GuardEvent::getTransitionBlockerList` Returns the event `Symfony\Component\Workflow\TransitionBlockerList`. » *(§ Using Events — Event Methods)*

**Question 66 : C** — « If you prefer to control which events are fired when performing each transition, use the `events_to_dispatch` configuration option. » *(§ Using Events — Choosing which Events to Dispatch)*

**Question 67 : B** — « This option does not apply to Guard events, which are always fired. » *(§ Using Events — Choosing which Events to Dispatch)*

**Question 68 : D** — « pass an empty array to not dispatch any event. » *(§ Using Events — Choosing which Events to Dispatch)*

**Question 69 : A** — « Disabling an event for a specific transition will take precedence over any events specified in the workflow configuration. » *(§ Using Events — Choosing which Events to Dispatch)*

**Question 70 : B** — « This feature is provided by "guards", which can be used in two ways. First, you can listen to the guard events. Alternatively, you can define a `guard` configuration option for the transition. » *(§ Blocking Transitions)*

**Question 71 : D** — « The value of this option is any valid expression created with the ExpressionLanguage component. » *(§ Blocking Transitions)*

**Question 72 : A, B, C, D** — l'exemple cite `guard: "is_granted('ROLE_REVIEWER')"`, `guard: "is_authenticated"`, et le commentaire « or "is_remember_me", "is_fully_authenticated", "is_granted", "is_valid" ». *(§ Blocking Transitions)*

**Question 73 : C** — « or any valid expression language with "subject" referring to the supported object. » *(§ Blocking Transitions)*

**Question 74 : D** — « you can also use transition blockers to block and return a user-friendly error message (…) via `TransitionBlocker`. » *(§ Blocking Transitions)*

**Question 75 : B** — « we get this message from the `Event`'s metadata (…) `$event->getMetadata('explanation', $eventTransition);`. » *(§ Blocking Transitions)*

**Question 76 : C** — « `$event->addTransitionBlocker(new TransitionBlocker($explanation, '0'));`. » *(§ Blocking Transitions)*

**Question 77 : A** — « in production you may prefer to use the Translation component to manage messages in one place. » *(§ Blocking Transitions)*

**Question 78 : B** — « you need to implement the `Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface`. » *(§ Creating Your Own Marking Store)*

**Question 79 : C** — « `public function getMarking(object $subject): Marking`. » *(§ Creating Your Own Marking Store)*

**Question 80 : D** — « `public function setMarking(object $subject, Marking $marking, array $context = []): void`. » *(§ Creating Your Own Marking Store)*

**Question 81 : B** — « `marking_store: service: 'App\Workflow\MarkingStore\BlogPostMarkingStore'`. » *(§ Creating Your Own Marking Store)*

**Question 82 : C** — « You may need to implement your own store to execute some additional logic when the marking is updated. » *(§ Creating Your Own Marking Store)*

**Question 83 : D** — « `workflow_can(...)` Returns `true` if the given object can make the given transition. » *(§ Usage in Twig)*

**Question 84 : C** — « `workflow_transitions(...)` Returns an array with all the transitions enabled for the given object. » *(§ Usage in Twig)*

**Question 85 : B** — « `workflow_marked_places(...)` Returns an array with the place names of the given marking. » *(§ Usage in Twig)*

**Question 86 : D** — « `workflow_has_marked_place(...)` Returns `true` if the marking of the given object has the given state. » *(§ Usage in Twig)*

**Question 87 : C** — « `workflow_transition_blockers(...)` Returns `TransitionBlockerList` for the given transition. » *(§ Usage in Twig)*

**Question 88 : B** — « All workflow functions accept an optional `name` argument (the workflow name) as the last parameter. This is only required when the object is associated with multiple workflows. » *(§ Usage in Twig)*

**Question 89 : D** — signature `workflow_marked_places(object $subject, bool $placesNameOnly = true, ?string $name = null)`. *(§ Usage in Twig)*

**Question 90 : C** — « `{% for transition in workflow_transitions(post) %} <a href="...">{{ transition.name }}</a> {% else %} No actions available. {% endfor %}`. » *(§ Usage in Twig)*

**Question 91 : A, B, C** — « you can store arbitrary metadata in workflows, their places, and their transitions using the `metadata` option. » *(§ Storing Metadata)*

**Question 92 : A** — « This metadata can be only the title of the workflow or very complex objects. » *(§ Storing Metadata)*

**Question 93 : B** — « `$blogPublishingWorkflow->getMetadataStore()->getWorkflowMetadata()['title']`. » *(§ Storing Metadata)*

**Question 94 : C** — « `->getMetadataStore()->getPlaceMetadata('draft')['max_num_of_words']`. » *(§ Storing Metadata)*

**Question 95 : D** — « `$aTransition = $blogPublishingWorkflow->getDefinition()->getTransitions()[0]; $priority = (...)->getTransitionMetadata($aTransition)['priority']`. » *(§ Storing Metadata)*

**Question 96 : A** — « get "workflow metadata" (…) get "place metadata" passing (…) the place name as the second argument (…) get "transition metadata" passing (…) a Transition object as the second argument. » *(§ Storing Metadata)*

**Question 97 : B** — « Metadata can also be accessed in a Listener, from the `Event` object. » *(§ Storing Metadata)*

**Question 98 : C** — « In Twig templates, metadata is available via the `workflow_metadata()` function. » *(§ Storing Metadata)*

**Question 99 : D** — « `{{ workflow_metadata(blog_post, 'max_num_of_words', place) ?: 'Unlimited'}}`. » *(§ Storing Metadata)*

**Question 100 : A** — « `'metadata' => ['hour_limit' => 20, 'explanation' => 'You can not publish after 8 PM.']`. » *(§ Storing Metadata)*

**Question 101 : B** — « create a class that implements the `Symfony\Component\Workflow\Validator\DefinitionValidatorInterface`. » *(§ Validating Workflow Definitions)*

**Question 102 : C** — « `public function validate(Definition $definition, string $name): void`. » *(§ Validating Workflow Definitions)*

**Question 103 : D** — « `throw new InvalidDefinitionException(sprintf('The workflow metadata title is missing in Workflow "%s".', $name));`. » *(§ Validating Workflow Definitions)*

**Question 104 : A** — « `definition_validators: - App\Workflow\Validator\BlogPublishingValidator`. » *(§ Validating Workflow Definitions)*

**Question 105 : C** — « A workflow is a model of a process in your application. » *(Annexe — Workflows and State Machines — Workflows)*

**Question 106 : D** — « A definition of a workflow consists of places and actions to get from one place to another. The actions are called transitions. » *(Annexe — Workflows and State Machines — Workflows)*

**Question 107 : A** — « The terminology above is commonly used when discussing workflows and Petri nets. » *(Annexe — Workflows and State Machines — Workflows)*

**Question 108 : B** — « there are 4 to 7 steps depending on the job you are applying for. » *(Annexe — Workflows and State Machines — Examples)*

**Question 109 : C** — « The `GuardEvent` is used to decide what next steps are allowed for a specific application. » *(Annexe — Workflows and State Machines — Examples)*

**Question 110 : D** — « Workflows can be in more than one place at the same time, whereas state machines can't. » *(Annexe — Workflows and State Machines — State Machines)*

**Question 111 : A** — « In order to apply a transition, workflows require that the object is in all the previous places of the transition, whereas state machines only require that the object is at least in one of those places. » *(Annexe — Workflows and State Machines — State Machines)*

**Question 112 : B** — « When this is finished, the pull request is in the "review" state. » *(Annexe — Workflows and State Machines — Example)*

**Question 113 : C** — « The "supports" option is useful only if you are using Twig functions ('workflow_*'). » *(Annexe — Workflows and State Machines — Example)*

**Question 114 : D** — « `reopen: from: closed to: review`. » *(Annexe — Workflows and State Machines — Example)*

**Question 115 : A** — « `update: from: [coding, test, review] to: test`. » *(Annexe — Workflows and State Machines — Example)*

**Question 116 : C** — « using `camelCased workflow name + Workflow` as parameter name. If it is a state machine type, use `camelCased workflow name + StateMachine` (…) `private WorkflowInterface $pullRequestStateMachine`. » *(Annexe — Workflows and State Machines — Example)*

**Question 117 : B** — « During cache warmup, Symfony validates the workflows and state machines that are defined in configuration files. » *(Annexe — Workflows and State Machines — Automatic and Manual Validation)*

**Question 118 : D** — « If your workflows or state machines are defined programmatically instead of in a configuration file, you can validate them with the `WorkflowValidator` and `StateMachineValidator`. » *(Annexe — Workflows and State Machines — Automatic and Manual Validation)*

**Question 119 : A** — « // This duplicate event "from" the "created" state is invalid. » *(Annexe — Workflows and State Machines — Automatic and Manual Validation)*

**Question 120 : B** — « Throws `InvalidDefinitionException` in case of an invalid definition. » *(Annexe — Workflows and State Machines — Automatic and Manual Validation)*

**Question 121 : C** — « // No validation is done upon initialization. » *(Annexe — Workflows and State Machines — Automatic and Manual Validation)*

**Question 122 : D** — « The simplest workflow looks like this. It contains two places and one transition. » *(Annexe — Workflows and State Machines — Examples)*

**Question 123 : A** — « The marking store writes the current place to a property on the object. » *(Annexe — Workflows and State Machines — Workflows)*

**Question 124 : B** — « Such processes are best kept away from your models and should be defined in configuration. » *(Annexe — Workflows and State Machines — Workflows)*

**Question 125 : C** — « To help you debug your workflows, you can generate a visual representation of them as SVG or PNG images. » *(Annexe — How to Dump Workflows)*

**Question 126 : A, B, C** — « Graphviz, provides the `dot` command; Mermaid CLI, provides the `mmdc` command; PlantUML, provides the `plantuml.jar` file (which requires Java). » *(Annexe — How to Dump Workflows)*

**Question 127 : A** — « `$ php bin/console workflow:dump workflow-name | dot -Tsvg -o graph.svg`. » *(Annexe — How to Dump Workflows)*

**Question 128 : B** — « `$ php bin/console workflow:dump workflow_name --dump-format=puml | java -jar plantuml.jar -p > graph.png`. » *(Annexe — How to Dump Workflows)*

**Question 129 : D** — « `$ php bin/console workflow:dump workflow-name place1 place2 | dot -Tsvg -o graph.svg`. » *(Annexe — How to Dump Workflows)*

**Question 130 : C** — « `$ php bin/console workflow:dump workflow_name --dump-format=mermaid | mmdc -o graph.svg`. » *(Annexe — How to Dump Workflows)*

**Question 131 : A** — « use the `GraphvizDumper` or `StateMachineGraphvizDumper` class to create the DOT files. » *(Annexe — How to Dump Workflows)*

**Question 132 : B** — idem, `StateMachineGraphvizDumper` est la classe dédiée aux state machines. *(Annexe — How to Dump Workflows)*

**Question 133 : D** — « and `PlantUmlDumper` to create the PlantUML files. » *(Annexe — How to Dump Workflows)*

**Question 134 : A** — « You can use `--with-metadata` option in the `workflow:dump` command to include places, transitions and workflow's metadata. » *(Annexe — How to Dump Workflows — Styling)*

**Question 135 : C** — « The `--with-metadata` option only works for the DOT dumper for now. » *(Annexe — How to Dump Workflows — Styling)*

**Question 136 : D** — « The `label` metadata is not included in the dumped metadata, because it is used as a place's title. » *(Annexe — How to Dump Workflows — Styling)*

**Question 137 : A, B** — « for places: `bg_color`: a color; `description`: a string that describes the state. » *(Annexe — How to Dump Workflows — Styling)*

**Question 138 : A, B, C** — « for transitions: `label`: a string that replaces the name of the transition; `color`: a color; `arrow_color`: a color. » *(Annexe — How to Dump Workflows — Styling)*

**Question 139 : B** — « Strings can include `\n` characters to display the contents in multiple lines. » *(Annexe — How to Dump Workflows — Styling)*

**Question 140 : A, B, C** — « a color name from PlantUML's color list; an hexadecimal color (both `#AABBCC` and `#ABC` formats are supported). » *(Annexe — How to Dump Workflows — Styling)*

**Question 141 : A** — « The Mermaid dumper does not support coloring the arrow heads with `arrow_color` as there is no support in Mermaid for doing so. » *(Annexe — How to Dump Workflows — Styling)*

**Question 142 : C** — « `review: metadata: description: Human review`. » *(Annexe — How to Dump Workflows — Styling)*

**Question 143 : D** — « `closed: metadata: bg_color: DeepSkyBlue`. » *(Annexe — How to Dump Workflows — Styling)*

**Question 144 : B** — « `accept: (...) metadata: label: Accept PR`. » *(Annexe — How to Dump Workflows — Styling)*

**Question 145 : A** — « `update: (...) metadata: arrow_color: Turquoise`. » *(Annexe — How to Dump Workflows — Styling)*

**Question 146 : C** — « `wait_for_review: (...) metadata: color: Orange`. » *(Annexe — How to Dump Workflows — Styling)*
