# QCM — Le Scheduler (tâches planifiées)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/scheduler.html](https://symfony.com/doc/8.0/scheduler.html) · **Généré le :** 22 juillet 2026
>
> **64 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande installe le composant Scheduler ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/scheduler`
- [ ] **B.** `composer require symfony/cron`
- [ ] **C.** Il est installé par défaut avec `symfony/messenger`
- [ ] **D.** `composer require symfony/task-scheduler`

### Question 2

Que fait la recipe Symfony Flex lors de l'installation du composant Scheduler ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, il faut tout configurer manuellement
- [ ] **B.** Elle crée un planning (« schedule ») initial, prêt à accueillir des tâches
- [ ] **C.** Elle installe automatiquement un serveur cron système
- [ ] **D.** Elle crée directement trois tâches d'exemple actives

## Les bases du Scheduler

### Question 3

Quel est le principal avantage de gérer l'automatisation via le Scheduler plutôt que via des tâches cron classiques ? *(une seule bonne réponse)*

- [ ] **A.** L'automatisation est gérée par l'application elle-même, offrant une flexibilité impossible avec cron (ex. plannings dynamiques selon certaines conditions)
- [ ] **B.** Le Scheduler est toujours plus rapide à exécuter qu'une tâche cron
- [ ] **C.** Le Scheduler ne nécessite aucun worker ni processus en tâche de fond
- [ ] **D.** Contrairement à cron, le Scheduler ne peut gérer qu'une seule tâche à la fois

### Question 4

Quelle est la principale différence entre le Scheduler et le Messenger, bien qu'ils partagent des concepts similaires (message, handler, bus, transport) ? *(une seule bonne réponse)*

- [ ] **A.** Le Scheduler ne peut traiter que des messages synchrones, contrairement à Messenger
- [ ] **B.** Messenger ne peut pas gérer nativement des tâches répétitives à intervalles réguliers, ce que fait le Scheduler
- [ ] **C.** Le Scheduler n'a pas de notion de handler, contrairement à Messenger
- [ ] **D.** Messenger ne supporte qu'un seul transport, contrairement au Scheduler

### Question 5

Qu'est-ce qu'un `RecurringMessage` ? *(une seule bonne réponse)*

- [ ] **A.** Un message associé à un trigger, qui configure la fréquence de génération du message
- [ ] **B.** Un simple alias de la classe `Message` de Messenger
- [ ] **C.** Une interface que doit implémenter tout handler planifié
- [ ] **D.** Un message qui ne peut être envoyé qu'une seule fois, jamais répété

### Question 6

À quoi sert le `SchedulerTransport`, et en quoi diffère-t-il d'un transport Messenger classique ? *(une seule bonne réponse)*

- [ ] **A.** C'est un transport spécial qui génère lui-même, de façon autonome, les différents messages selon les fréquences assignées
- [ ] **B.** Il ne fait que relayer des messages déjà créés ailleurs, sans aucune génération autonome
- [ ] **C.** Il ne peut être utilisé qu'avec le transport Doctrine sous-jacent
- [ ] **D.** Il fonctionne à l'identique d'un transport Messenger standard, sans aucune différence

### Question 7

Au démarrage du Scheduler, les messages sont-ils envoyés immédiatement au bus, comme avec Messenger ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, dès le démarrage du worker
- [ ] **B.** Non, ils sont créés en fonction d'une fréquence prédéfinie plutôt qu'envoyés immédiatement
- [ ] **C.** Non, ils ne sont jamais envoyés tant qu'aucune commande `messenger:consume` n'a été lancée manuellement au moins une fois
- [ ] **D.** Oui, mais uniquement le tout premier message de chaque `RecurringMessage`

## Attacher des messages récurrents à un schedule

### Question 8

Où est stockée la configuration de la fréquence des messages, et quelle méthode expose-t-elle le planning ? *(une seule bonne réponse)*

- [ ] **A.** Dans une classe implémentant `ScheduleProviderInterface`, via sa méthode `getSchedule()`
- [ ] **B.** Dans un fichier YAML dédié `config/packages/scheduler.yaml`, sans code PHP
- [ ] **C.** Directement dans le handler du message, via une méthode `getFrequency()`
- [ ] **D.** Dans les attributs de routage de `messenger.yaml`

### Question 9

À quoi sert l'attribut `#[AsSchedule]`, et quel nom de planning utilise-t-il par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il permet d'enregistrer un fournisseur sur un planning particulier ; par défaut, il référence le planning nommé `default`
- [ ] **B.** Il sert uniquement à activer le mode debug du Scheduler
- [ ] **C.** Il définit la fréquence d'exécution du planning entier
- [ ] **D.** Il n'a pas de valeur par défaut, un nom doit toujours être fourni explicitement

### Question 10

Quelle est la convention de nommage du transport associé à un planning nommé `sales` ? *(une seule bonne réponse)*

- [ ] **A.** `scheduler_sales`
- [ ] **B.** `sales_scheduler`
- [ ] **C.** `messenger_sales`
- [ ] **D.** Simplement `sales`, sans préfixe

### Question 11

Pourquoi la documentation recommande-t-elle de « mémoïser » (memoize) son planning dans `getSchedule()` ? *(une seule bonne réponse)*

- [ ] **A.** Pour éviter une reconstruction inutile du planning si la méthode est vérifiée par un autre service
- [ ] **B.** C'est obligatoire, sans quoi le Scheduler refuse de démarrer
- [ ] **C.** Pour activer automatiquement l'option `stateful`
- [ ] **D.** Cela n'a aucun effet, ce n'est qu'une convention de style

## Les types de triggers

### Question 12

Quels types de triggers Symfony fournit-il nativement ? *(plusieurs bonnes réponses)*

- [ ] **A.** `CronExpressionTrigger` et `PeriodicalTrigger`
- [ ] **B.** `CallbackTrigger`, qui utilise un callback pour déterminer la prochaine date d'exécution
- [ ] **C.** `JitterTrigger` et `ExcludeTimeTrigger`
- [ ] **D.** `RandomTrigger`, qui exécute le message à un moment totalement aléatoire

### Question 13

Que sont `JitterTrigger` et `ExcludeTimeTrigger`, et comment accéder au trigger qu'ils enveloppent ? *(une seule bonne réponse)*

- [ ] **A.** Ce sont des décorateurs qui modifient le comportement d'un autre trigger ; on accède au trigger décoré via `inner()` et à la liste des décorateurs via `decorators()`
- [ ] **B.** Ce sont des triggers indépendants, sans lien avec un trigger sous-jacent
- [ ] **C.** Ce sont de simples alias de `CronExpressionTrigger`
- [ ] **D.** Ils ne peuvent être combinés à aucun autre type de trigger

### Question 14

À quoi sert le `JitterTrigger` ? *(une seule bonne réponse)*

- [ ] **A.** À ajouter un délai aléatoire à la date/heure de déclenchement d'origine, pour répartir la charge des tâches planifiées plutôt que de toutes les exécuter au même instant
- [ ] **B.** À exclure certaines plages horaires d'un trigger donné
- [ ] **C.** À garantir qu'un message ne sera jamais exécuté deux fois de suite
- [ ] **D.** À convertir un trigger cron en trigger périodique

### Question 15

À quoi sert l'`ExcludeTimeTrigger` ? *(une seule bonne réponse)*

- [ ] **A.** À exclure certains créneaux horaires d'un trigger donné
- [ ] **B.** À ajouter un délai aléatoire au trigger, comme `JitterTrigger`
- [ ] **C.** À exécuter le message uniquement en dehors des heures de bureau, sans configuration possible
- [ ] **D.** À convertir automatiquement une expression cron en intervalle périodique

## Les triggers à expression cron

### Question 16

Quelle dépendance faut-il installer avant d'utiliser des triggers cron ? *(une seule bonne réponse)*

- [ ] **A.** `dragonmantank/cron-expression`
- [ ] **B.** `symfony/cron-expression`
- [ ] **C.** Aucune, le support cron est intégré nativement au composant Scheduler
- [ ] **D.** `cron/php-cron-scheduler`

### Question 17

Comment définir un trigger cron avec un fuseau horaire particulier ? *(une seule bonne réponse)*

- [ ] **A.** `RecurringMessage::cron('* * * * *', new Message(), new \DateTimeZone('Africa/Malabo'))`, le fuseau étant un troisième argument optionnel
- [ ] **B.** Le fuseau horaire n'est jamais configurable pour un trigger cron
- [ ] **C.** Via une méthode séparée `->withTimezone()` appelée après coup
- [ ] **D.** En codant le décalage horaire directement dans l'expression cron elle-même

### Question 18

Que signifie la valeur spéciale `@daily` (ou `@midnight`) dans une expression cron du Scheduler ? *(une seule bonne réponse)*

- [ ] **A.** Une exécution une fois par jour à minuit, équivalente à `0 0 * * *`
- [ ] **B.** Une exécution une fois par semaine à minuit le dimanche
- [ ] **C.** Une exécution toutes les heures, à la première minute
- [ ] **D.** Une exécution une fois par mois, le premier jour à minuit

## Les expressions cron hachées (hashed)

### Question 19

Pourquoi utiliser le symbole `#` dans une expression cron plutôt qu'une valeur fixe ? *(une seule bonne réponse)*

- [ ] **A.** Pour éviter qu'un grand nombre de triggers planifiés à l'exact même instant (ex. minuit) ne créent une longue liste de tâches simultanées, ce qui peut poser problème en cas de fuite mémoire sur l'une d'elles
- [ ] **B.** Pour désactiver complètement l'expression cron correspondante
- [ ] **C.** Pour forcer l'exécution immédiate du message, sans attendre le prochain créneau
- [ ] **D.** Le symbole `#` n'existe pas dans la syntaxe du Scheduler

### Question 20

Les valeurs générées par un `#` dans une expression hachée sont-elles réellement aléatoires d'une exécution à l'autre ? *(une seule bonne réponse)*

- [ ] **A.** Oui, une nouvelle valeur aléatoire est tirée à chaque calcul de la prochaine date d'exécution
- [ ] **B.** Non : bien qu'aléatoires en apparence, elles sont générées de façon prévisible et cohérente car dérivées du message lui-même (fréquence idempotente)
- [ ] **C.** Non, elles sont toujours égales à zéro par défaut
- [ ] **D.** Oui, mais uniquement si l'expression contient plusieurs symboles `#`

### Question 21

Que permettent les plages de hachage, comme `#(0-7)` dans `# #(0-7) * * *` ? *(une seule bonne réponse)*

- [ ] **A.** De restreindre les valeurs aléatoires possibles à un intervalle donné (ici, une heure entre minuit et 7h du matin)
- [ ] **B.** De définir un intervalle de dates de début et de fin pour le trigger
- [ ] **C.** De répéter l'exécution un nombre de fois compris entre 0 et 7
- [ ] **D.** De définir une plage de fuseaux horaires acceptés

### Question 22

À quoi correspond l'expression `# # # # #`, entièrement composée de hachages sans champ fixe ? *(une seule bonne réponse)*

- [ ] **A.** Un raccourci pour `#(0-59) #(0-23) #(1-28) #(1-12) #(0-6)`
- [ ] **B.** Une erreur de syntaxe, au moins un champ doit être fixe
- [ ] **C.** L'équivalent exact de `* * * * *`, sans aucun hachage réel
- [ ] **D.** Un raccourci pour `#hourly`

### Question 23

Pourquoi la plage de hachage du jour du mois est-elle limitée à `1-28` plutôt qu'à `1-31` ? *(une seule bonne réponse)*

- [ ] **A.** Pour tenir compte de février, qui compte au minimum 28 jours
- [ ] **B.** Pour des raisons de performance uniquement
- [ ] **C.** C'est une limitation technique de l'extension `dragonmantank/cron-expression`, sans rapport avec le calendrier
- [ ] **D.** Parce que les jours 29 à 31 sont réservés à un usage interne du Scheduler

### Question 24

À quoi correspond l'alias `#midnight` ? *(une seule bonne réponse)*

- [ ] **A.** `# #(0-2) * * *`, soit une exécution quotidienne à un instant aléatoire mais cohérent entre minuit et 2h59
- [ ] **B.** `0 0 * * *`, une exécution fixe et non hachée à minuit précis
- [ ] **C.** `# # * * #`, une exécution hebdomadaire
- [ ] **D.** Il n'existe pas d'alias `#midnight`, seul `@midnight` est disponible

## Les triggers périodiques

### Question 25

Sous quels formats la fréquence d'un `PeriodicalTrigger` peut-elle être exprimée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une chaîne de caractères comme `'10 seconds'` ou `'3 weeks'`
- [ ] **B.** Un entier représentant un nombre de secondes
- [ ] **C.** Un objet `DateInterval`
- [ ] **D.** Un tableau associatif de composants de date (`['days' => 3]`)

### Question 26

La méthode `RecurringMessage::every()` supporte-t-elle une liste de jours séparés par des virgules, comme `'Monday, Thursday, Saturday'` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, nativement, sans configuration supplémentaire
- [ ] **B.** Non : pour plusieurs jours de la semaine, il faut utiliser une expression cron à la place, par exemple `'5 12 * * 1,4,6'`
- [ ] **C.** Oui, mais uniquement si les jours sont dans l'ordre chronologique de la semaine
- [ ] **D.** Non, et il n'existe aucune alternative pour exprimer plusieurs jours de la semaine

### Question 27

Comment définir une fenêtre de temps bornée (début et fin) pour un `RecurringMessage` périodique ? *(une seule bonne réponse)*

- [ ] **A.** Via les 3ᵉ et 4ᵉ arguments de `RecurringMessage::every()`, respectivement `from` et `until`
- [ ] **B.** Ce n'est possible qu'avec les triggers cron, jamais avec `every()`
- [ ] **C.** Via une méthode séparée `->between()` appelée sur le trigger
- [ ] **D.** Uniquement en combinant deux `RecurringMessage` distincts

### Question 28

Si aucun paramètre `from` n'est défini pour un trigger périodique et que le scheduler démarre à 8h33 avec une fréquence horaire, quand aura lieu la première exécution ? *(une seule bonne réponse)*

- [ ] **A.** Immédiatement à 8h33, puis toutes les heures ensuite
- [ ] **B.** La première période de fréquence démarre au moment où le scheduler tourne : la première exécution aura lieu à 9h33, puis 10h33, etc.
- [ ] **C.** À la prochaine heure ronde, soit 9h00
- [ ] **D.** Le comportement est indéterminé sans `from` explicite

## Les triggers personnalisés

### Question 29

Comment créer un trigger totalement personnalisé pour une fréquence dynamique arbitraire ? *(une seule bonne réponse)*

- [ ] **A.** En créant un service qui implémente `TriggerInterface`, avec sa méthode `getNextRunDate()`
- [ ] **B.** En surchargeant directement la classe `CronExpressionTrigger`
- [ ] **C.** Ce n'est pas possible, seuls les triggers natifs sont supportés
- [ ] **D.** En définissant une expression cron avec des caractères génériques personnalisés

### Question 30

À quoi sert la méthode `__toString()` recommandée sur un trigger personnalisé, comme dans l'exemple `ExcludeHolidaysTrigger` ? *(une seule bonne réponse)*

- [ ] **A.** À donner un nom affichable et identifiable au trigger, ce qui facilite le débogage
- [ ] **B.** Elle est obligatoire techniquement, sans elle le trigger ne fonctionne pas
- [ ] **C.** À sérialiser le trigger pour le stockage en cache
- [ ] **D.** À définir le format de date utilisé par `getNextRunDate()`

### Question 31

Comment combine-t-on un trigger personnalisé avec le message qu'il doit déclencher ? *(une seule bonne réponse)*

- [ ] **A.** Via `RecurringMessage::trigger($monTrigger, $monMessage)`
- [ ] **B.** Le trigger personnalisé doit obligatoirement implémenter lui-même une méthode `getMessage()`
- [ ] **C.** En les passant tous les deux séparément à `Schedule::with()`, sans les lier explicitement
- [ ] **D.** Ce n'est pas possible, seuls les triggers natifs peuvent être associés à `RecurringMessage`

## Génération dynamique des messages

### Question 32

À quoi sert `CallbackMessageProvider`, et dans quel cas est-il particulièrement utile ? *(une seule bonne réponse)*

- [ ] **A.** À définir dynamiquement, via un callback exécuté à chaque vérification du transport, le(s) message(s) à générer — utile quand le message dépend de données en base ou d'un service tiers
- [ ] **B.** À planifier un message une seule fois, de façon différée
- [ ] **C.** À transformer un trigger cron en trigger périodique automatiquement
- [ ] **D.** À définir un callback exécuté uniquement en cas d'échec du message

### Question 33

Le callback d'un `CallbackMessageProvider` peut-il générer plusieurs messages à la fois ? *(une seule bonne réponse)*

- [ ] **A.** Non, un seul message par appel de callback
- [ ] **B.** Oui, en utilisant `yield` pour produire successivement plusieurs messages depuis le callback
- [ ] **C.** Oui, mais uniquement en retournant un tableau, jamais via `yield`
- [ ] **D.** Non, cette fonctionnalité est réservée aux triggers cron

## Les attributs `AsCronTask` et `AsPeriodicTask`

### Question 34

Sur quels types d'éléments les attributs `#[AsCronTask]` et `#[AsPeriodicTask]` peuvent-ils être posés ? *(une seule bonne réponse)*

- [ ] **A.** Sur un service quelconque ou sur une commande Symfony
- [ ] **B.** Uniquement sur une classe de message Messenger
- [ ] **C.** Uniquement sur un contrôleur
- [ ] **D.** Uniquement sur une commande, jamais sur un service classique

### Question 35

Par défaut, quelle méthode de la classe portant `#[AsCronTask]` ou `#[AsPeriodicTask]` est appelée, et comment la changer ? *(une seule bonne réponse)*

- [ ] **A.** `__invoke()` par défaut ; personnalisable via l'option `method`
- [ ] **B.** `handle()` par défaut ; personnalisable via l'option `handler`
- [ ] **C.** `run()` par défaut, sans possibilité de la changer
- [ ] **D.** `execute()` par défaut ; personnalisable via l'option `entrypoint`

### Question 36

Quel schedule est utilisé par défaut par `#[AsCronTask]`/`#[AsPeriodicTask]` si l'option `schedule` n'est pas précisée ? *(une seule bonne réponse)*

- [ ] **A.** Le schedule nommé `default`
- [ ] **B.** Aucun, l'option `schedule` est obligatoire
- [ ] **C.** Le premier schedule déclaré dans l'ordre alphabétique des classes
- [ ] **D.** Un schedule distinct est créé automatiquement pour chaque tâche

### Question 37

À quoi sert l'option `jitter` de `#[AsCronTask]` (par exemple `jitter: 6`) ? *(une seule bonne réponse)*

- [ ] **A.** À ajouter aléatoirement jusqu'à 6 secondes au moment du déclenchement, pour éviter les pics de charge
- [ ] **B.** À retenter la tâche jusqu'à 6 fois en cas d'échec
- [ ] **C.** À limiter la tâche à 6 exécutions maximum
- [ ] **D.** À définir un délai fixe de 6 secondes avant chaque exécution, sans aléa

### Question 38

Comment passer des arguments à une commande Symfony via `#[AsCronTask]` ou `#[AsPeriodicTask]` ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `arguments`, en lui passant la ligne d'arguments/options telle qu'elle serait tapée en CLI
- [ ] **B.** Ce n'est pas possible sur une commande, seulement sur un service classique
- [ ] **C.** Via un second attribut `#[WithArguments(...)]` dédié
- [ ] **D.** En surchargeant la méthode `configure()` de la commande

### Question 39

Comment exprimer la fréquence d'un `#[AsPeriodicTask]` en secondes plutôt qu'en chaîne de caractères, et que se passe-t-il si `from`/`until` ne sont pas définis ? *(une seule bonne réponse)*

- [ ] **A.** En passant un entier à `frequency` (ex. `frequency: 86400`) ; sans `from`/`until`, la tâche s'exécute indéfiniment
- [ ] **B.** Ce n'est pas possible, `frequency` n'accepte que des chaînes relatives
- [ ] **C.** En passant un entier à `frequency` ; sans `from`/`until`, la tâche ne s'exécute qu'une seule fois
- [ ] **D.** Il faut toujours définir `from` et `until`, ces options n'étant jamais optionnelles

## Gérer les messages planifiés en temps réel

### Question 40

Pourquoi les messages récurrents d'un planning sont-ils normalement conservés en mémoire plutôt que recalculés à chaque fois ? *(une seule bonne réponse)*

- [ ] **A.** Pour alléger la charge de travail en évitant un recalcul systématique à chaque génération de messages par le transport
- [ ] **B.** Parce que Symfony l'exige techniquement, aucune autre approche n'étant possible
- [ ] **C.** Pour des raisons de sécurité, afin d'empêcher toute modification du planning
- [ ] **D.** Cela ne concerne que les triggers cron, jamais les triggers périodiques

### Question 41

Quelles méthodes de `Schedule` permettent de modifier dynamiquement l'ensemble des messages récurrents, avec quel effet sur la pile interne ? *(une seule bonne réponse)*

- [ ] **A.** `add()`, `remove()` et `clear()`, qui provoquent la réinitialisation et le recalcul de la pile en mémoire des messages récurrents
- [ ] **B.** Uniquement `refresh()`, qui recharge tout le planning depuis la configuration YAML
- [ ] **C.** `add()` et `remove()` uniquement, `clear()` n'existant pas
- [ ] **D.** Ces méthodes n'existent pas, le planning est immuable une fois construit

### Question 42

Quelle est la différence entre `Schedule::remove()` et `Schedule::removeById()` ? *(une seule bonne réponse)*

- [ ] **A.** `remove()` retire un `RecurringMessage` par référence d'objet, `removeById()` le retire via l'identifiant du contexte du message
- [ ] **B.** Elles sont strictement équivalentes, `removeById()` n'étant qu'un alias historique
- [ ] **C.** `removeById()` ne fonctionne qu'avec les triggers cron
- [ ] **D.** `remove()` supprime tout le planning, `removeById()` un seul message

### Question 43

Quelle limite la documentation souligne-t-elle si un handler tente lui-même de supprimer son propre `RecurringMessage` selon une condition métier ? *(une seule bonne réponse)*

- [ ] **A.** Une fois qu'il n'y a plus de messages de ce type, le handler ne sera plus jamais appelé — ce qui rend difficile, depuis ce même handler, l'ajout ultérieur d'un nouveau message récurrent suite à un événement externe
- [ ] **B.** Un handler ne peut techniquement jamais accéder au `Schedule`, quelle que soit l'approche
- [ ] **C.** Cette approche est impossible : seul un `EventListener` peut modifier le planning
- [ ] **D.** Supprimer un `RecurringMessage` depuis un handler provoque systématiquement une exception fatale

## Gérer les messages planifiés via les événements

### Question 44

Quels sont les trois types d'événements introduits par le Scheduler ? *(plusieurs bonnes réponses)*

- [ ] **A.** `PRE_RUN_EVENT`
- [ ] **B.** `POST_RUN_EVENT`
- [ ] **C.** `FAILURE_EVENT`
- [ ] **D.** `RETRY_EVENT`

### Question 45

Comment empêcher qu'un message ne soit transféré et traité par son handler, depuis un listener de `PreRunEvent` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$event->shouldCancel(true)`
- [ ] **B.** En levant une exception depuis le listener
- [ ] **C.** En appelant `$event->stopPropagation()` uniquement
- [ ] **D.** Ce n'est pas possible depuis `PreRunEvent`, seul `FailureEvent` le permet

### Question 46

Quelles informations un listener de `PostRunEvent` peut-il récupérer, en plus du planning, du contexte et du message ? *(une seule bonne réponse)*

- [ ] **A.** Le résultat du traitement, via `$event->getResult()`
- [ ] **B.** Le nombre total d'exécutions précédentes de ce message
- [ ] **C.** La date de la prochaine exécution planifiée
- [ ] **D.** Aucune information supplémentaire, `PostRunEvent` n'exposant que le message

### Question 47

Comment un listener de `FailureEvent` peut-il ignorer l'échec plutôt que de le laisser se propager ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$event->shouldIgnore(true)`
- [ ] **B.** En appelant `$event->shouldCancel(true)`, comme pour `PreRunEvent`
- [ ] **C.** Ce n'est pas possible, un échec ne peut jamais être ignoré
- [ ] **D.** En retournant `false` depuis le listener

### Question 48

Quelle commande permet de découvrir les listeners enregistrés pour un événement du Scheduler, comme `PreRunEvent` ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:event-dispatcher "Symfony\Component\Scheduler\Event\PreRunEvent"`
- [ ] **B.** `php bin/console debug:scheduler --events`
- [ ] **C.** `php bin/console scheduler:debug-events`
- [ ] **D.** Il n'existe pas de commande dédiée pour cela

### Question 49

Comment brancher des listeners directement sur la construction d'un `Schedule`, sans passer par un service tagué séparé ? *(une seule bonne réponse)*

- [ ] **A.** En passant un `EventDispatcherInterface` au constructeur de `Schedule`, puis en utilisant ses méthodes `->before()`, `->after()` et `->onFailure()`
- [ ] **B.** Ce n'est pas possible, seuls les `EventSubscriber` classiques peuvent écouter les événements du Scheduler
- [ ] **C.** En surchargeant directement la méthode `getSchedule()` pour y inclure la logique du listener
- [ ] **D.** Via une option `listeners` du constructeur de `RecurringMessage`

## Consommer les messages

### Question 50

Quelles sont les deux façons de consommer les messages générés par le Scheduler, et laquelle est recommandée dans une application Symfony complète ? *(une seule bonne réponse)*

- [ ] **A.** La commande `messenger:consume`, recommandée en full-stack, ou la création programmatique d'un worker, plutôt réservée à un usage du composant en standalone
- [ ] **B.** Uniquement `messenger:consume`, la création programmatique d'un worker n'existant pas
- [ ] **C.** Uniquement un worker créé programmatiquement, `messenger:consume` ne fonctionnant pas avec le Scheduler
- [ ] **D.** Les deux sont strictement équivalentes, sans recommandation particulière selon le contexte

### Question 51

Comment consommer les messages d'un schedule nommé `sales` via Messenger ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console messenger:consume scheduler_sales`
- [ ] **B.** `php bin/console scheduler:consume sales`
- [ ] **C.** `php bin/console messenger:consume sales`
- [ ] **D.** `php bin/console debug:scheduler --consume=sales`

### Question 52

Comment utiliser le composant Scheduler de façon totalement autonome (standalone), sans passer par Messenger ni `messenger:consume` ? *(une seule bonne réponse)*

- [ ] **A.** En instanciant `Symfony\Component\Scheduler\Scheduler` avec des handlers et des schedules, puis en appelant `run()`
- [ ] **B.** Ce n'est pas possible, le composant Scheduler nécessite toujours Messenger et le framework complet
- [ ] **C.** En appelant directement `Schedule::run()`
- [ ] **D.** En utilisant `messenger:consume --standalone`

## Modifier le schedule à l'exécution

### Question 53

Que se passe-t-il en interne lorsqu'un message récurrent est ajouté ou retiré du planning à l'exécution ? *(une seule bonne réponse)*

- [ ] **A.** Le scheduler redémarre automatiquement et recalcule le tas (heap) interne des triggers
- [ ] **B.** Rien, le changement ne prend effet qu'au prochain déploiement de l'application
- [ ] **C.** Une exception est levée, le planning ne pouvant être modifié qu'à froid
- [ ] **D.** Seuls les triggers cron sont recalculés, les triggers périodiques restant figés

## Déboguer le schedule

### Question 54

Quelle commande liste les plannings et leurs messages récurrents ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:scheduler`
- [ ] **B.** `php bin/console scheduler:list`
- [ ] **C.** `php bin/console debug:messenger --scheduler`
- [ ] **D.** `php bin/console scheduler:debug`

### Question 55

Comment demander à `debug:scheduler` de calculer la prochaine exécution à partir d'une date précise plutôt que d'aujourd'hui ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `--date`, par exemple `debug:scheduler --date=2025-10-18`
- [ ] **B.** Via l'argument positionnel `--from`
- [ ] **C.** Ce n'est pas configurable, la commande utilise toujours la date courante
- [ ] **D.** En modifiant temporairement l'horloge système avant d'exécuter la commande

### Question 56

Par défaut, `debug:scheduler` affiche-t-il les messages récurrents déjà terminés (dont la fenêtre `until` est dépassée) ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut utiliser l'option `--all` pour aussi les afficher
- [ ] **B.** Oui, systématiquement, sans option pour les masquer
- [ ] **C.** Non, et il n'existe aucun moyen de les afficher
- [ ] **D.** Oui, mais uniquement si l'option `--date` est aussi précisée

## Gestion efficace du Scheduler

### Question 57

Que se passe-t-il pour les messages qui auraient dû être générés pendant qu'un worker était à l'arrêt ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont automatiquement mis en file d'attente et envoyés dès le redémarrage du worker
- [ ] **B.** Comme les messages sont créés à la volée par le transport du scheduler, ils ne sont pas générés pendant l'inactivité ; au redémarrage, le calcul reprend à partir de ce point
- [ ] **C.** Ils sont perdus définitivement, sans aucune option pour changer ce comportement
- [ ] **D.** Ils sont journalisés dans les logs Monolog mais jamais réellement traités

### Question 58

Pour un message récurrent toutes les 3 jours, si le worker est redémarré le jour 2, quand le prochain message sera-t-il envoyé par défaut (sans option `stateful`) ? *(une seule bonne réponse)*

- [ ] **A.** Le jour 3, comme prévu initialement
- [ ] **B.** Le jour 5, soit 3 jours après le redémarrage, et non 3 jours après l'échéance initiale
- [ ] **C.** Immédiatement au redémarrage, pour rattraper le retard
- [ ] **D.** Jamais, ce type de message est définitivement perdu après un redémarrage

### Question 59

Comment permettre au Scheduler de se souvenir de la dernière date d'exécution d'un message, pour reprendre exactement où il s'était arrêté après un redémarrage ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `stateful` de `Schedule`, combinée au composant Cache
- [ ] **B.** Ce n'est pas configurable, ce comportement dépend uniquement du transport utilisé
- [ ] **C.** Via l'option `persistent` du trigger cron
- [ ] **D.** En stockant manuellement la date dans une table Doctrine dédiée, aucune option native n'existant

### Question 60

Avec l'option `stateful` seule, tous les messages manqués sont-ils traités au redémarrage, ou seulement le dernier ? *(une seule bonne réponse)*

- [ ] **A.** Tous les messages manqués sont traités par défaut ; pour n'en traiter qu'un seul, il faut combiner `processOnlyLastMissedRun(true)`
- [ ] **B.** Seul le dernier message manqué est traité par défaut, sans option supplémentaire nécessaire
- [ ] **C.** `stateful` seul ne traite jamais aucun message manqué, quel que soit son réglage
- [ ] **D.** Le nombre de messages traités est toujours limité à trois, quelle que soit la configuration

### Question 61

Pourquoi la documentation recommande-t-elle d'ajouter un verrou (lock) lorsqu'on utilise plusieurs workers pour un même planning ? *(une seule bonne réponse)*

- [ ] **A.** Pour empêcher qu'une même tâche ne soit exécutée plus d'une fois simultanément par différents workers
- [ ] **B.** Pour accélérer le traitement en distribuant la charge entre les workers
- [ ] **C.** Le verrou est obligatoire techniquement, sans lui le Scheduler refuse de démarrer avec plusieurs workers
- [ ] **D.** Pour empêcher toute modification du planning pendant l'exécution d'un message

### Question 62

Que recommande la documentation concernant la fréquence d'un message récurrent par rapport à son temps de traitement ? *(une seule bonne réponse)*

- [ ] **A.** Prévoir une fréquence supérieure au temps de traitement du message, sous peine de retarder les traitements suivants si celui-ci est long
- [ ] **B.** Le temps de traitement n'a aucun impact sur la fréquence, le Scheduler parallélisant toujours les exécutions
- [ ] **C.** Toujours définir la fréquence la plus courte possible, indépendamment du temps de traitement
- [ ] **D.** Utiliser systématiquement une fréquence de type `#` (hachée) pour compenser les temps de traitement longs

### Question 63

Comment mieux faire évoluer (scale) un schedule en redirigeant le traitement final du message vers un autre transport, avant qu'il n'atteigne son handler ? *(une seule bonne réponse)*

- [ ] **A.** En enveloppant le message dans un `RedispatchMessage`, en précisant le transport cible
- [ ] **B.** En dupliquant le `RecurringMessage` une fois par transport souhaité
- [ ] **C.** Ce n'est pas possible, un message planifié ne peut être redirigé vers un autre transport
- [ ] **D.** En modifiant directement le `SchedulerTransport` pour qu'il pointe vers un autre transport

### Question 64

Quel stamp Symfony attache-t-il automatiquement à un message enveloppé dans un `RedispatchMessage` par le Scheduler ? *(une seule bonne réponse)*

- [ ] **A.** `ScheduledStamp`, utile pour identifier ces messages
- [ ] **B.** `SchedulerRedispatchStamp`
- [ ] **C.** Aucun stamp n'est ajouté automatiquement dans ce cas
- [ ] **D.** `TransportNamesStamp`, le même que pour un routage Messenger classique

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Scheduler de la documentation Symfony 8.0](https://symfony.com/doc/8.0/scheduler.html). Cette page n'a pas de section Learn more.

**Question 1 : A** — « Run this command to install the scheduler component: `$ composer require symfony/scheduler` » *(§ Installation)*

**Question 2 : B** — « In applications using Symfony Flex, installing the component also creates an initial schedule that's ready to start adding your tasks. » *(§ Installation)*

**Question 3 : A** — « The main benefit of using this component is that automation is managed by your application, which gives you a lot of flexibility that is not possible with cron jobs (e.g. dynamic schedules based on certain conditions). » *(§ Symfony Scheduler Basics)*

**Question 4 : B** — « It has some similarities with the Symfony Messenger component (…) but the main difference is that Messenger can't deal with repetitive tasks at regular intervals. » *(§ Symfony Scheduler Basics)*

**Question 5 : A** — « messages in the Scheduler component are recurring. They are represented via the `RecurringMessage` class. » *(§ Symfony Scheduler Basics)*

**Question 6 : A** — « this is possible thanks to `SchedulerTransport`, a special transport for Scheduler messages. The transport generates, autonomously, various messages according to the assigned frequencies. » *(§ Symfony Scheduler Basics)*

**Question 7 : B** — « When starting the scheduler, the message isn't sent to the messenger immediately. If you don't set a `from` parameter, the first frequency period starts from the moment the scheduler runs. » *(§ Periodical Triggers)*

**Question 8 : A** — « The configuration of the message frequency is stored in a class that implements `ScheduleProviderInterface`. This provider uses the method `getSchedule` to return a schedule. » *(§ Attaching Recurring Messages to a Schedule)*

**Question 9 : A** — « The `AsSchedule` attribute, which by default references the schedule named `default`, allows you to register on a particular schedule. » *(§ Attaching Recurring Messages to a Schedule)*

**Question 10 : A** — « The schedule name must be unique and by default, it is `default`. The transport name follows the syntax: `scheduler_nameofyourschedule`. » *(§ Attaching Recurring Messages to a Schedule)*

**Question 11 : A** — « Memoizing your schedule is a good practice to prevent unnecessary reconstruction if the `getSchedule()` method is checked by another service. » *(§ Attaching Recurring Messages to a Schedule)*

**Question 12 : A, B, C** — `CronExpressionTrigger`, `CallbackTrigger` (« a trigger that uses a callback to determine the next run date »), `ExcludeTimeTrigger`, `JitterTrigger`, `PeriodicalTrigger`. *(§ Scheduling Recurring Messages)*

**Question 13 : A** — « The `JitterTrigger` and `ExcludeTimeTrigger` are decorators and modify the behavior of the trigger they wrap. You can get the decorated trigger (…) by calling the `inner` and `decorators` methods. » *(§ Scheduling Recurring Messages)*

**Question 14 : A** — « A trigger that adds a random jitter to a given trigger (…) This allows distributing the load of the scheduled tasks instead of running them all at the exact same time. » *(§ Scheduling Recurring Messages)*

**Question 15 : A** — « A trigger that excludes certain times from a given trigger. » *(§ Scheduling Recurring Messages)*

**Question 16 : A** — « Before using cron triggers, you have to install the following dependency: `$ composer require dragonmantank/cron-expression` » *(§ Cron Expression Triggers)*

**Question 17 : A** — « `RecurringMessage::cron('* * * * *', new Message(), new \DateTimeZone('Africa/Malabo'));` — optionally you can define the timezone used by the cron expression. » *(§ Cron Expression Triggers)*

**Question 18 : A** — « `@daily`, `@midnight` - Run once a day, midnight - `0 0 * * *` » *(§ Cron Expression Triggers)*

**Question 19 : A** — « If you have many triggers scheduled at same time (…) this will create a very long running list of schedules at that exact time. This may cause an issue if a task has a memory leak. » *(§ Hashed Cron Expressions)*

**Question 20 : B** — « Although the values are random, they are predictable and consistent because they are generated based on the message (…) will have an idempotent frequency. » *(§ Hashed Cron Expressions)*

**Question 21 : A** — « you can also use hash ranges (`#(x-y)`) to define the list of possible values for that random part. For example, `# #(0-7) * * *` means daily, some time between midnight and 7am. » *(§ Hashed Cron Expressions)*

**Question 22 : A** — « `# # # # #` is short for `#(0-59) #(0-23) #(1-28) #(1-12) #(0-6)`. » *(§ Hashed Cron Expressions)*

**Question 23 : A** — « The day of month range is `1-28`, this is to account for February which has a minimum of 28 days. » *(§ Hashed Cron Expressions)*

**Question 24 : A** — « `#midnight` — `# #(0-2) * * *` (at some time between midnight and 2:59am, every day) » *(§ Hashed Cron Expressions)*

**Question 25 : A, B, C** — « These triggers allows you to configure the frequency using different data types (`string`, `integer`, `DateInterval`). » *(§ Periodical Triggers)*

**Question 26 : B** — « Comma-separated weekdays (…) are not supported by the `every()` method. For multiple weekdays, use cron expressions instead: `RecurringMessage::cron('5 12 * * 1,4,6', new Message());` » *(§ Periodical Triggers)*

**Question 27 : A** — « You can also define `from` and `until` times for your schedule » — 3ᵉ et 4ᵉ arguments de `RecurringMessage::every()`. *(§ Periodical Triggers)*

**Question 28 : B** — « If you don't set a `from` parameter, the first frequency period starts from the moment the scheduler runs. For example, if you start it at 8:33 and the message is scheduled hourly, it will run at 9:33, 10:33, 11:33, etc. » *(§ Periodical Triggers)*

**Question 29 : A** — « Custom triggers (…) are created as services that implement `TriggerInterface`. » *(§ Custom Triggers)*

**Question 30 : A** — « use this method to give a nice displayable name to identify your trigger (it eases debugging) » — `__toString()`. *(§ Custom Triggers)*

**Question 31 : A** — « `RecurringMessage::trigger(new ExcludeHolidaysTrigger(...), new SendDailySalesReports('...'));` » *(§ Custom Triggers)*

**Question 32 : A** — « This proves particularly useful when the message depends on data stored in databases or third-party services (…) this is achieved by defining a `CallbackMessageProvider`. » *(§ A Dynamic Vision for the Messages Generated)*

**Question 33 : B** — « `public function generateReports(MessageContext $context) { yield new SendDailySalesReports(); yield new ReportSomethingReportSomethingElse(); }` » *(§ A Dynamic Vision for the Messages Generated)*

**Question 34 : A** — « this can be done by adding one of these attributes to a service or a command: `AsPeriodicTask` and `AsCronTask`. » *(§ Exploring Alternatives for Crafting your Recurring Messages)*

**Question 35 : A** — « by default, the `__invoke` method of your service will be called but, it's also possible to specify the method to call via the `method` option. » *(§ Exploring Alternatives for Crafting your Recurring Messages)*

**Question 36 : A** — « you have the ability to define the schedule to use via the `schedule` option. By default, the `default` named schedule will be used. » *(§ Exploring Alternatives for Crafting your Recurring Messages)*

**Question 37 : A** — « `#[AsCronTask('0 0 * * *', jitter: 6)]` — adds randomly up to 6 seconds to the trigger time to avoid load spikes. » *(§ AsCronTask Example)*

**Question 38 : A** — « when applying this attribute to a Symfony console command, you can pass arguments and options to the command using the `arguments` option: `#[AsCronTask('0 0 * * *', arguments: 'some_argument --some-option --another-option=some_value')]` » *(§ AsCronTask Example)*

**Question 39 : A** — « the frequency can be defined as an integer representing the number of seconds `#[AsPeriodicTask(frequency: 86400)]` (…) The `from` and `until` options are optional. If not defined, the task will be executed indefinitely. » *(§ AsPeriodicTask Example)*

**Question 40 : A** — « the recurring messages in the schedules are stored in memory to avoid recalculation each time the scheduler transport generates messages. » *(§ Modifying Scheduled Messages in Real-Time)*

**Question 41 : A** — « The schedule provides you with the ability to `Schedule::add`, `Schedule::remove`, or `Schedule::clear` all associated recurring messages, resulting in the reset and recalculation of the in-memory stack. » *(§ Strategies for Adding, Removing, and Modifying Entries within the Schedule)*

**Question 42 : A** — « the `Schedule` offers a `remove` or a `removeById` method » — `$schedule->remove($this->removeOldReports)` vs. suppression par identifiant de contexte. *(§ Strategies for Adding, Removing, and Modifying Entries within the Schedule)*

**Question 43 : A** — « the handler will no longer be called or executed once there are no more messages of that type » — ce qui complique l'ajout d'un nouveau message récurrent depuis ce même handler suite à un événement externe. *(§ Strategies for Adding, Removing, and Modifying Entries within the Schedule)*

**Question 44 : A, B, C** — « Three primary event types have been introduced: `PRE_RUN_EVENT`, `POST_RUN_EVENT`, `FAILURE_EVENT`. » *(§ A Strategic Event Handling)*

**Question 45 : A** — « it reveals a specific feature `PreRunEvent::shouldCancel` that allows you to prevent the message (…) from being transferred and processed by its handler. » *(§ A Strategic Event Handling)*

**Question 46 : A** — « `PostRunEvent` allows you to modify the `Schedule` after a message is consumed (…) `$result = $event->getResult();` » *(§ PostRunEvent)*

**Question 47 : A** — « `FailureEvent` allows you to modify the `Schedule` when a message consumption throws an exception (…) and/or ignore failure event: `$event->shouldIgnore(true);` » *(§ FailureEvent)*

**Question 48 : A** — « Execute this command to find out which listeners are registered for this event and their priorities: `$ php bin/console debug:event-dispatcher "Symfony\Component\Scheduler\Event\PreRunEvent"` » *(§ PreRunEvent)*

**Question 49 : A** — « `return $this->schedule ??= new Schedule($this->dispatcher)->with(...)->before(function(PreRunEvent $event) {...})->after(function(PostRunEvent $event) {...})->onFailure(function(FailureEvent $event) {...});` » *(§ A Strategic Event Handling)*

**Question 50 : A** — « using the `messenger:consume` command or creating a worker programmatically. The first solution is the recommended one when using the Scheduler component in the context of a full stack Symfony application. » *(§ Consuming Messages)*

**Question 51 : A** — « `$ php bin/console messenger:consume scheduler_nameofyourschedule` » *(§ Running a Worker)*

**Question 52 : A** — « The component comes with a ready-to-use worker named `Scheduler` that you can use in your code (…) `$scheduler->run();` » *(§ Creating a Consumer Programmatically)*

**Question 53 : A** — « When a recurring message is added to or removed from the schedule, the scheduler automatically restarts and recalculates the internal trigger heap. » *(§ Modifying the Schedule at Runtime)*

**Question 54 : A** — « The `debug:scheduler` command provides a list of schedules along with their recurring messages. » *(§ Debugging the Schedule)*

**Question 55 : A** — « you can also specify a date to use for the next run date: `$ php bin/console debug:scheduler --date=2025-10-18` » *(§ Debugging the Schedule)*

**Question 56 : A** — « use the `--all` option to also display the terminated recurring messages » *(§ Debugging the Schedule)*

**Question 57 : B** — « When a worker is restarted or undergoes shutdown for a period, the Scheduler transport won't be able to generate the messages (because they are created on-the-fly by the scheduler transport). (…) Upon restart, it will recalculate the messages to be generated from that point onward. » *(§ Efficient management with Symfony Scheduler)*

**Question 58 : B** — « consider a recurring message set to be sent every 3 days. If a worker is restarted on day 2, the message will be sent 3 days from the restart, on day 5. » *(§ Efficient management with Symfony Scheduler)*

**Question 59 : A** — « the scheduler allows you to remember the last execution date of a message via the `stateful` option (and the Cache component). » *(§ Efficient management with Symfony Scheduler)*

**Question 60 : A** — « With the `stateful` option, all missed messages will be handled. If you need to handle a message only once, you can use the `processOnlyLastMissedRun` option. » *(§ Efficient management with Symfony Scheduler)*

**Question 61 : A** — « To scale your schedules more effectively, you can use multiple workers. In such cases, a good practice is to add a lock to prevent the same task running more than once. » *(§ Efficient management with Symfony Scheduler)*

**Question 62 : A** — « The processing time of a message matters. If it takes a long time, all subsequent message processing may be delayed. So, it's a good practice (…) to plan for frequencies greater than the processing time of a message. » *(§ Efficient management with Symfony Scheduler)*

**Question 63 : A** — « you have the option to wrap your message in a `RedispatchMessage`. This allows you to specify a transport on which your message will be redispatched before being further redispatched to its corresponding handler. » *(§ Efficient management with Symfony Scheduler)*

**Question 64 : A** — « When using the `RedispatchMessage`, Symfony will attach a `ScheduledStamp` to the message, helping you identify those messages when needed. » *(§ Efficient management with Symfony Scheduler)*
