# QCM — Messenger (messages synchrones et asynchrones)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/messenger.html](https://symfony.com/doc/8.0/messenger.html) et la page de sa section [Learn more](https://symfony.com/doc/8.0/messenger.html#learn-more) · **Généré le :** 22 juillet 2026
>
> **136 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande installe le composant Messenger dans une application utilisant Symfony Flex ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/messenger`
- [ ] **B.** `composer require symfony/queue`
- [ ] **C.** Il est installé par défaut avec `symfony/framework-bundle`
- [ ] **D.** `composer require symfony/message-bus`

## Créer un message et son handler

### Question 2

Quelle est la seule contrainte réelle sur une classe de message Messenger ? *(une seule bonne réponse)*

- [ ] **A.** Elle doit implémenter `MessageInterface`
- [ ] **B.** Elle doit pouvoir être sérialisée
- [ ] **C.** Elle doit obligatoirement être `final` et `readonly`
- [ ] **D.** Elle doit contenir un identifiant `Uuid`

### Question 3

Comment créer, de la manière recommandée, un handler pour un message ? *(une seule bonne réponse)*

- [ ] **A.** Une classe portant l'attribut `#[AsMessageHandler]` avec une méthode `__invoke()` type-hintée avec la classe du message (ou une interface de message)
- [ ] **B.** Une classe implémentant obligatoirement `MessageHandlerInterface`
- [ ] **C.** Une méthode `handle()` déclarée dans le message lui-même
- [ ] **D.** Un service tagué `messenger.handler_class` sans convention de méthode particulière

### Question 4

L'attribut `#[AsMessageHandler]` peut-il être utilisé sur plusieurs méthodes d'une même classe ? *(une seule bonne réponse)*

- [ ] **A.** Non, une seule méthode par classe peut porter cet attribut
- [ ] **B.** Oui, autant de fois que nécessaire, ce qui permet de regrouper la gestion de plusieurs types de messages liés dans une même classe
- [ ] **C.** Oui, mais uniquement deux fois maximum
- [ ] **D.** Non, il faut alors créer autant de classes que de messages à gérer

### Question 5

Grâce à quels mécanismes Symfony sait-il automatiquement qu'un handler doit être appelé pour un message donné, sans configuration manuelle ? *(une seule bonne réponse)*

- [ ] **A.** Grâce à l'autoconfiguration et au type-hint du message sur la méthode `__invoke()`
- [ ] **B.** Grâce au nom du fichier, qui doit se terminer par `Handler.php`
- [ ] **C.** Grâce à un fichier `handlers.yaml` généré automatiquement
- [ ] **D.** Grâce à l'ordre alphabétique des classes dans `src/MessageHandler/`

### Question 6

Quelle commande liste tous les handlers configurés dans l'application ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console messenger:handlers`
- [ ] **B.** `php bin/console debug:messenger`
- [ ] **C.** `php bin/console debug:container --tag=messenger.message_handler`
- [ ] **D.** `php bin/console messenger:debug-handlers`

### Question 7

Comment dispatcher un message pour appeler son (ses) handler(s) ? *(une seule bonne réponse)*

- [ ] **A.** En injectant le service `messenger.default_bus` via `MessageBusInterface`, puis en appelant `$bus->dispatch(new MyMessage(...))`
- [ ] **B.** En appelant une méthode statique `MyMessage::dispatch()`
- [ ] **C.** En injectant directement la classe du handler dans le contrôleur
- [ ] **D.** En publiant le message sur un canal Redis manuellement

## Transports et routage des messages

### Question 8

Par défaut, quand sont traités les messages dispatchés si aucun transport n'est configuré pour eux ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont traités immédiatement (de façon synchrone), dès leur dispatch
- [ ] **B.** Ils sont automatiquement mis en file d'attente en mémoire
- [ ] **C.** Une exception est levée, un transport étant obligatoire
- [ ] **D.** Ils sont perdus si aucun transport n'est configuré

### Question 9

Comment enregistre-t-on un transport dans Messenger ? *(une seule bonne réponse)*

- [ ] **A.** Via un DSN, par exemple `async: "%env(MESSENGER_TRANSPORT_DSN)%"` dans `config/packages/messenger.yaml`
- [ ] **B.** Uniquement via une classe PHP dédiée par transport
- [ ] **C.** Via une variable d'environnement `MESSENGER_TRANSPORTS` listant tous les noms
- [ ] **D.** Les transports sont détectés automatiquement selon les bundles installés

### Question 10

Comment router une classe de message vers un transport nommé ``async`` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec l'attribut `#[AsMessage('async')]` sur la classe de message
- [ ] **B.** En listant `'App\Message\SmsNotification': async` sous la clé `routing` de la configuration
- [ ] **C.** En renommant le fichier du message en `SmsNotificationAsync.php`
- [ ] **D.** En ajoutant un commentaire `// @async` au-dessus de la classe

### Question 11

Si un message est routé à la fois par attribut `#[AsMessage]` et par configuration YAML/PHP, laquelle prévaut ? *(une seule bonne réponse)*

- [ ] **A.** L'attribut PHP prévaut toujours sur la configuration
- [ ] **B.** La configuration YAML/PHP prévaut toujours sur l'attribut de la classe, ce qui permet de surcharger le routage par environnement
- [ ] **C.** Une exception est levée en cas de conflit
- [ ] **D.** Le dernier chargé (ordre alphabétique des fichiers) l'emporte

### Question 12

Comment router en une seule règle tous les messages d'un namespace donné ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant un namespace PHP partiel comme `'App\Message\*'`, le caractère `*` devant obligatoirement être placé en fin de namespace
- [ ] **B.** En listant chaque classe individuellement, aucun wildcard n'étant supporté
- [ ] **C.** En utilisant une expression régulière dans la clé `routing`
- [ ] **D.** En taguant chaque classe manuellement avec `messenger.routed`

### Question 13

Que permet d'utiliser `'*'` comme classe de message dans la configuration `routing`, et quel inconvénient cela comporte-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Une règle de routage par défaut pour tout message non matché ailleurs ; l'inconvénient est qu'elle s'applique aussi aux emails du Mailer (`SendEmailMessage`), ce qui peut poser problème s'ils ne sont pas sérialisables
- [ ] **B.** Cela désactive complètement le routage pour tous les messages
- [ ] **C.** Cela ne fonctionne que combiné à l'option `--all` de `messenger:consume`
- [ ] **D.** Cela route uniquement les messages qui n'ont aucun handler

### Question 14

Si le routage est configuré à la fois pour une classe parente et sa classe enfant, que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Seule la règle de la classe enfant est appliquée
- [ ] **B.** Les deux règles sont utilisées : le message est routé à la fois selon la règle du parent et celle de l'enfant
- [ ] **C.** Seule la règle du parent est appliquée
- [ ] **D.** Une exception est levée pour ambiguïté de routage

### Question 15

Comment surcharger, au moment de l'envoi, le(s) transport(s) utilisé(s) pour un message précis ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un `TransportNamesStamp` (avec un tableau de noms de transports) à l'enveloppe du message
- [ ] **B.** Ce n'est pas possible, le routage est figé à la configuration
- [ ] **C.** En modifiant l'attribut `#[AsMessage]` dynamiquement à l'exécution
- [ ] **D.** En passant un second argument à `MessageBusInterface::dispatch()`

### Question 16

Comment créer soi-même un transport pour envoyer/recevoir des messages via un système non supporté nativement ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans forker le composant Messenger
- [ ] **B.** En suivant le guide dédié à la création de son propre transport (implémentation de `TransportInterface` et d'une factory)
- [ ] **C.** Uniquement en contribuant directement au dépôt `symfony/symfony`
- [ ] **D.** En héritant obligatoirement de la classe `DoctrineTransport`

## Entités Doctrine dans les messages

### Question 17

Que recommande la documentation lorsqu'on doit faire référence à une entité Doctrine dans un message ? *(une seule bonne réponse)*

- [ ] **A.** Passer l'entité elle-même, Messenger sachant la sérialiser nativement
- [ ] **B.** Passer sa clé primaire (ou toute information pertinente comme un email), puis requêter un objet frais dans le handler
- [ ] **C.** Passer l'entité sérialisée en JSON manuellement dans le message
- [ ] **D.** Ce n'est jamais recommandé d'utiliser Doctrine avec Messenger

### Question 18

Pourquoi vaut-il mieux passer la clé primaire plutôt que l'entité elle-même dans un message asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Pour des raisons purement esthétiques
- [ ] **B.** Pour éviter des erreurs liées à l'Entity Manager (l'entité sérialisée pouvant devenir obsolète ou détachée le temps que le message soit traité)
- [ ] **C.** Parce que Doctrine interdit la sérialisation de toute entité
- [ ] **D.** Parce que la clé primaire est plus rapide à transmettre sur le réseau

## Versionner les classes de message

### Question 19

Pourquoi la version d'une classe de message importe-t-elle particulièrement dans un contexte asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Une classe de message définit le contrat entre le code qui dispatche et le worker qui gère le message ; des messages plus anciens peuvent rester en file d'attente au moment d'un déploiement et échouer à se désérialiser si la classe a changé
- [ ] **B.** Ce n'est jamais un problème, PHP gère la compatibilité ascendante nativement pour toute classe sérialisée
- [ ] **C.** Cela ne concerne que les messages routés vers Doctrine
- [ ] **D.** Cela ne concerne que les applications utilisant le sérialiseur Symfony

### Question 20

Comment garder la compatibilité ascendante pour un changement mineur, comme l'ajout d'un nouvel argument au constructeur d'un message ? *(une seule bonne réponse)*

- [ ] **A.** En rendant le nouvel argument optionnel avec une valeur par défaut sensée
- [ ] **B.** En créant systématiquement une nouvelle classe de message
- [ ] **C.** Ce n'est pas possible, tout changement de constructeur casse la compatibilité
- [ ] **D.** En marquant l'ancien argument comme `@deprecated` uniquement

### Question 21

Quelles approches la documentation propose-t-elle pour retirer une propriété d'une classe de message sans casser les messages déjà en file ? *(plusieurs bonnes réponses)*

- [ ] **A.** Garder temporairement la propriété (par exemple nullable) jusqu'à ce que tous les anciens messages soient traités
- [ ] **B.** Ajouter l'attribut `#[\AllowDynamicProperties]` à la classe
- [ ] **C.** Implémenter une logique de sérialisation personnalisée
- [ ] **D.** Toujours ignorer les avertissements de dépréciation PHP 8.2 sur les propriétés dynamiques, sans autre action

### Question 22

Si un changement altère la signification du message plutôt que de simplement l'étendre, que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Créer une nouvelle version de la classe de message (ex. `SendInvoiceV2`), en gardant temporairement l'ancienne et sa gestion en parallèle le temps que la file soit vidée
- [ ] **B.** Modifier directement la classe existante, sans précaution particulière
- [ ] **C.** Supprimer immédiatement l'ancienne classe dès le déploiement de la nouvelle
- [ ] **D.** Utiliser un `GroupSequence` pour gérer les deux versions

### Question 23

Que risque-t-il de se passer si l'ancienne classe de message est supprimée trop tôt lors d'un déploiement progressif ? *(une seule bonne réponse)*

- [ ] **A.** Rien, Symfony régénère automatiquement les classes manquantes
- [ ] **B.** Les workers peuvent échouer à désérialiser des messages qui avaient été dispatchés avant le déploiement
- [ ] **C.** Cela ne pose problème qu'avec le transport AMQP
- [ ] **D.** Les messages concernés sont automatiquement convertis vers la nouvelle classe

## Traiter les messages de façon synchrone

### Question 24

Comment forcer explicitement le traitement synchrone d'un message qui, autrement, ne matcherait aucune règle de routage ? *(une seule bonne réponse)*

- [ ] **A.** En créant un transport `sync: 'sync://'` et en y routant le message
- [ ] **B.** Ce n'est jamais nécessaire, l'absence de règle de routage suffit déjà
- [ ] **C.** En ajoutant l'option `--sync` à `messenger:consume`
- [ ] **D.** En taguant le handler avec `messenger.sync_handler`

## Consommer les messages (le worker)

### Question 25

Quelle commande consomme les messages d'un transport nommé `async` ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console messenger:consume async`
- [ ] **B.** `php bin/console messenger:worker async`
- [ ] **C.** `php bin/console messenger:run async`
- [ ] **D.** `php bin/console messenger:process async`

### Question 26

Comment consommer les messages de tous les récepteurs disponibles, et comment en exclure certains ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `--all` ; l'option `--exclude-receivers` (raccourci `-eq`) ne peut être utilisée qu'avec `--all`, et il n'est pas possible d'exclure tous les récepteurs
- [ ] **B.** Avec l'option `--every` ; `--skip` fonctionne indépendamment de tout autre argument
- [ ] **C.** En listant chaque transport manuellement, `--all` n'existant pas
- [ ] **D.** Avec `--all`, sans possibilité d'exclure quoi que ce soit

### Question 27

À quoi sert l'option `--keepalive` de `messenger:consume`, et pour quels transports est-elle disponible ? *(une seule bonne réponse)*

- [ ] **A.** À marquer périodiquement (toutes les 5 secondes par défaut) un message comme « en cours de traitement » pour éviter sa redistribution prématurée ; disponible pour Beanstalkd, AmazonSQS, Doctrine et Redis uniquement
- [ ] **B.** À garder la connexion HTTP ouverte entre deux requêtes du worker
- [ ] **C.** À redémarrer automatiquement le worker toutes les 5 secondes
- [ ] **D.** Elle est disponible pour tous les transports sans exception

### Question 28

Comment arrêter proprement un worker Messenger depuis l'intérieur d'un handler ou d'un service ? *(une seule bonne réponse)*

- [ ] **A.** En levant une instance de `StopWorkerException`
- [ ] **B.** En appelant `exit()` directement
- [ ] **C.** En retournant `false` depuis le handler
- [ ] **D.** En envoyant le signal `SIGKILL` au process courant

### Question 29

Pourquoi la documentation déconseille-t-elle de laisser un worker tourner indéfiniment en production, et quelles options permettent de limiter sa durée de vie ? *(plusieurs bonnes réponses)*

- [ ] **A.** Certains services (comme l'`EntityManager` de Doctrine) consomment de plus en plus de mémoire avec le temps
- [ ] **B.** L'option `--limit` permet de limiter le nombre de messages traités avant que le worker ne s'arrête
- [ ] **C.** L'option `--memory-limit` permet de fixer une limite de mémoire
- [ ] **D.** Un worker Messenger ne peut de toute façon jamais consommer plus de mémoire qu'une requête HTTP classique

### Question 30

Comment fait-on redémarrer proprement tous les workers après un déploiement, et sur quel mécanisme cette commande s'appuie-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `messenger:stop-workers`, qui s'appuie sur le cache applicatif — sur plusieurs hôtes, ce cache doit utiliser un adaptateur partagé (ex. Redis)
- [ ] **B.** En envoyant manuellement `SIGKILL` à chaque process worker
- [ ] **C.** `messenger:restart-workers`, qui redémarre immédiatement chaque worker sans attendre la fin du message en cours
- [ ] **D.** En redémarrant le serveur entier à chaque déploiement

### Question 31

Dans un environnement Kubernetes, à quoi faut-il faire attention pour qu'un rolling restart de workers reproduise l'effet de `messenger:stop-workers` ? *(une seule bonne réponse)*

- [ ] **A.** `terminationGracePeriodSeconds` doit être suffisamment long pour laisser le handler le plus long se terminer, sans quoi `SIGKILL` peut interrompre un handler en plein traitement
- [ ] **B.** Il suffit d'utiliser n'importe quel type de ressource Kubernetes, le comportement est toujours identique
- [ ] **C.** Il faut désactiver complètement les sondes de liveness pendant le déploiement
- [ ] **D.** Kubernetes gère cela nativement sans aucune configuration additionnelle

### Question 32

Pourquoi la documentation recommande-t-elle de configurer `cache.prefix_seed` si le déploiement crée de nouveaux répertoires cibles à chaque fois ? *(une seule bonne réponse)*

- [ ] **A.** Pour garder le même espace de nommage de cache entre déploiements, plutôt que de changer d'espace de nommage à chaque fois que `kernel.project_dir` change
- [ ] **B.** Pour accélérer la compilation du container Symfony
- [ ] **C.** Pour chiffrer le contenu du cache applicatif
- [ ] **D.** Cette option ne concerne que le cache HTTP, pas les workers

## Transports priorisés et limitation aux files d'attente

### Question 33

Pourquoi utiliser des transports séparés pour des types de messages ayant des exigences de latence ou d'échec différentes ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Symfony l'impose techniquement, un seul type de message par transport étant autorisé
- [ ] **B.** Pour éviter qu'un handler lent ou défaillant sur un type de message ne retarde le traitement des autres messages partageant le même transport
- [ ] **C.** Parce que chaque transport ne peut gérer qu'un seul message à la fois de toute façon
- [ ] **D.** Uniquement pour des raisons de facturation chez les fournisseurs cloud

### Question 34

Si un worker consomme `messenger:consume async_priority_high async_priority_low`, dans quel ordre les messages sont-ils traités ? *(une seule bonne réponse)*

- [ ] **A.** Le worker cherche toujours d'abord des messages sur `async_priority_high` ; ce n'est que s'il n'y en a aucun qu'il consulte `async_priority_low`
- [ ] **B.** Les deux transports sont consommés en parallèle par le même process
- [ ] **C.** L'ordre est alterné à chaque message consommé
- [ ] **D.** Seul le premier transport listé est réellement consommé

### Question 35

Que faut-il pour que l'option `--queues` de `messenger:consume` fonctionne, et à quoi sert-elle ? *(une seule bonne réponse)*

- [ ] **A.** À limiter le worker à des files d'attente spécifiques d'un transport à exchanges (ex. AMQP) ; le récepteur doit implémenter `QueueReceiverInterface`
- [ ] **B.** Elle fonctionne avec n'importe quel transport sans prérequis particulier
- [ ] **C.** À définir le nombre maximal de messages consommés avant arrêt du worker
- [ ] **D.** Elle est réservée exclusivement au transport Doctrine

## Statistiques des transports

### Question 36

Quelle commande affiche le nombre de messages en attente dans les transports, et quel prérequis le récepteur doit-il remplir ? *(une seule bonne réponse)*

- [ ] **A.** `messenger:stats`, le récepteur devant implémenter `MessageCountAwareInterface`
- [ ] **B.** `messenger:queue-size`, sans prérequis particulier
- [ ] **C.** `debug:messenger --count`
- [ ] **D.** `messenger:stats`, disponible pour tous les transports sans exception

## Supervisor, systemd et arrêt propre

### Question 37

Que fait Supervisor lorsqu'une commande `messenger:consume` échoue à démarrer plusieurs fois de suite, et quel risque cela comporte-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il retente `startretries` fois en augmentant le délai d'une seconde à chaque tentative ; si ce nombre est trop bas, la commande peut finir dans un état FATAL qui ne redémarre plus jamais
- [ ] **B.** Il abandonne immédiatement après un seul échec, sans configuration possible
- [ ] **C.** Il redémarre indéfiniment sans jamais passer en état FATAL, quel que soit `startretries`
- [ ] **D.** Il ignore silencieusement l'échec et considère le process comme démarré

### Question 38

Pourquoi chaque worker Redis doit-il avoir un nom de consommateur unique, et comment est-ce généralement configuré avec Supervisor ? *(une seule bonne réponse)*

- [ ] **A.** Pour éviter qu'un même message ne soit traité par plusieurs workers ; via une variable d'environnement définie dans la configuration Supervisor et référencée dans `messenger.yaml`
- [ ] **B.** Ce n'est utile que pour le logging, sans impact sur le traitement des messages
- [ ] **C.** Le nom de consommateur est toujours généré automatiquement, aucune configuration n'est nécessaire
- [ ] **D.** Uniquement pour respecter une convention de nommage, sans conséquence fonctionnelle

### Question 39

Comment un worker gère-t-il un arrêt propre (« graceful shutdown »), et comment personnaliser les signaux concernés ? *(une seule bonne réponse)*

- [ ] **A.** Si l'extension PCNTL est installée, le worker termine le traitement du message courant avant de s'arrêter sur `SIGTERM`/`SIGINT` ; ces signaux sont personnalisables via `framework.messenger.stop_worker_on_signals`
- [ ] **B.** Le worker s'arrête toujours immédiatement, sans terminer le message en cours, quel que soit le signal reçu
- [ ] **C.** L'arrêt propre ne fonctionne qu'avec systemd, jamais avec Supervisor
- [ ] **D.** PCNTL n'a aucun rôle dans la gestion des signaux d'un worker Messenger

### Question 40

Systemd étant une alternative à Supervisor, quel avantage la documentation lui reconnaît-elle ? *(une seule bonne réponse)*

- [ ] **A.** Il ne nécessite pas d'accès système, grâce aux « user services »
- [ ] **B.** Il est toujours plus rapide à démarrer qu'un processus Supervisor
- [ ] **C.** Il ne fonctionne que sur les distributions basées sur Debian
- [ ] **D.** Il gère nativement le multi-transport sans configuration additionnelle

## Worker sans état

### Question 41

Pourquoi faut-il être vigilant sur l'état interne des services dans un worker de longue durée ? *(une seule bonne réponse)*

- [ ] **A.** Symfony injecte la même instance d'un service dans le traitement de tous les messages, ce qui préserve son état interne d'un message à l'autre — contrairement au contexte HTTP classique où tout est nettoyé après chaque requête
- [ ] **B.** Ce n'est jamais un problème, PHP réinitialise automatiquement tous les services entre deux messages
- [ ] **C.** Cela ne concerne que les services tagués `messenger.message_handler`
- [ ] **D.** Cela ne concerne que le transport Doctrine

### Question 42

Comment Symfony permet-il à un service de nettoyer son état interne entre deux messages, et comment désactiver ce comportement automatique ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `Symfony\Contracts\Service\ResetInterface` (méthode `reset()`), appelée automatiquement entre deux messages ; l'option `--no-reset` de `messenger:consume` désactive ce reset du container
- [ ] **B.** En appelant manuellement `$container->reset()` dans chaque handler
- [ ] **C.** Ce nettoyage n'est disponible que pour les services Doctrine
- [ ] **D.** Il n'existe aucun moyen de désactiver ce comportement automatique

## Transport à limitation de débit (Rate Limited)

### Question 43

Comment limiter le débit de traitement d'un worker sur un transport donné, et quelle mise en garde s'applique ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `rate_limiter` du transport (nécessite le composant RateLimiter) ; le rate limiter bloque tout le worker une fois la limite atteinte, il faut donc dédier un worker à ce transport
- [ ] **B.** Via l'option `rate_limiter`, sans aucun effet secondaire sur les autres transports consommés par le même worker
- [ ] **C.** Cette fonctionnalité nécessite le composant HttpClient, pas RateLimiter
- [ ] **D.** Ce n'est configurable que globalement pour tous les transports à la fois

## Retries et échecs

### Question 44

Que se passe-t-il par défaut si une exception est levée lors du traitement d'un message consommé depuis un transport ? *(une seule bonne réponse)*

- [ ] **A.** Le message est automatiquement renvoyé au transport pour être retenté, jusqu'à 3 fois par défaut avant d'être écarté (ou envoyé au transport d'échec)
- [ ] **B.** Le message est immédiatement écarté, sans aucune tentative supplémentaire
- [ ] **C.** Le worker entier s'arrête définitivement
- [ ] **D.** Le message est automatiquement routé vers tous les autres transports configurés

### Question 45

Quelles options de `retry_strategy` peuvent être configurées pour un transport ? *(plusieurs bonnes réponses)*

- [ ] **A.** `max_retries` et `delay` (délai avant la première nouvelle tentative)
- [ ] **B.** `multiplier` (multiplicateur appliqué au délai à chaque nouvelle tentative) et `max_delay`
- [ ] **C.** `jitter`, un facteur d'aléa pour éviter que plusieurs messages échoués ne soient retentés simultanément
- [ ] **D.** `backoff_curve`, une fonction mathématique personnalisée obligatoire

### Question 46

Quel événement Symfony déclenche-t-il lorsqu'un message est retenté, et quel avantage apporte le `SerializedMessageStamp` dans ce contexte ? *(une seule bonne réponse)*

- [ ] **A.** `WorkerMessageRetriedEvent` ; le `SerializedMessageStamp` évite de sérialiser à nouveau le message lors d'une nouvelle tentative
- [ ] **B.** `WorkerMessageRetryEvent` ; le stamp force au contraire une nouvelle sérialisation systématique
- [ ] **C.** Aucun événement n'est dispatché lors d'un retry
- [ ] **D.** `MessageRetriedEvent` ; le stamp ne concerne que le chiffrement du message

### Question 47

Que se passe-t-il si un handler lève une `UnrecoverableMessageHandlingException` ? *(une seule bonne réponse)*

- [ ] **A.** Le message n'est pas retenté ; il apparaîtra malgré tout dans le transport d'échec configuré, sauf si l'erreur est gérée soi-même en laissant le handler se terminer avec succès
- [ ] **B.** Le message est retenté indéfiniment, comme avec `RecoverableMessageHandlingException`
- [ ] **C.** Le worker entier s'arrête immédiatement
- [ ] **D.** Le message est automatiquement supprimé sans jamais apparaître dans le transport d'échec

### Question 48

Que se passe-t-il si un handler lève une `RecoverableMessageHandlingException`, et comment personnaliser le délai de nouvelle tentative ? *(une seule bonne réponse)*

- [ ] **A.** Le message sera toujours retenté indéfiniment, la configuration `max_retries` étant ignorée ; le délai peut être personnalisé via l'argument `retryDelay` du constructeur de l'exception
- [ ] **B.** Le message n'est jamais retenté, contrairement à `UnrecoverableMessageHandlingException`
- [ ] **C.** Le nombre de tentatives reste limité par `max_retries`, comme pour toute autre exception
- [ ] **D.** Le délai de nouvelle tentative ne peut être défini que globalement, jamais par exception levée

### Question 49

Comment configure-t-on un transport pour que les messages ayant épuisé leurs tentatives soient conservés plutôt que perdus ? *(une seule bonne réponse)*

- [ ] **A.** En configurant un `failure_transport` (globalement ou par transport), vers lequel les messages sont envoyés après épuisement des tentatives
- [ ] **B.** En augmentant `max_retries` à une valeur suffisamment grande pour ne jamais épuiser les tentatives
- [ ] **C.** Ce n'est pas configurable, les messages en échec sont toujours perdus après le nombre de tentatives configuré
- [ ] **D.** En activant l'option `--keep-failed` sur `messenger:consume`

### Question 50

Quelles commandes permettent de gérer les messages du transport d'échec ? *(plusieurs bonnes réponses)*

- [ ] **A.** `messenger:failed:show`, pour lister les messages en échec (avec filtres `--class-filter`, `--stats`…)
- [ ] **B.** `messenger:failed:retry`, qui demande pour chaque message s'il faut le retenter, l'ignorer ou le supprimer
- [ ] **C.** `messenger:failed:remove`, pour supprimer un ou plusieurs messages sans les retenter
- [ ] **D.** `messenger:failed:purge`, seule commande capable de vider entièrement le transport d'échec

### Question 51

Peut-on définir un transport d'échec différent selon le transport d'origine du message ? *(une seule bonne réponse)*

- [ ] **A.** Non, un seul `failure_transport` global s'applique à tous les transports
- [ ] **B.** Oui, en définissant `failure_transport` au niveau d'un transport particulier, qui prévaut alors sur le `failure_transport` global
- [ ] **C.** Oui, mais uniquement en dupliquant entièrement la configuration `messenger.yaml`
- [ ] **D.** Non, cette fonctionnalité est réservée au transport Doctrine

## Écrire des handlers idempotents

### Question 52

Pourquoi un message Messenger peut-il être délivré plus d'une fois dans des conditions normales de fonctionnement ? *(une seule bonne réponse)*

- [ ] **A.** Un worker peut traiter un message avec succès mais planter avant de l'accuser réception (« ack ») auprès du transport, qui le redistribuera alors
- [ ] **B.** Ce n'est jamais le cas si le transport implémente `MessageCountAwareInterface`
- [ ] **C.** Cela n'arrive qu'en cas d'utilisation explicite de `RedispatchMessage`
- [ ] **D.** Cela ne concerne que les messages envoyés en mode `--all`

### Question 53

Que doit respecter une clé d'idempotence pour des opérations non naturellement idempotentes, comme un paiement ? *(une seule bonne réponse)*

- [ ] **A.** Être dérivée de l'événement métier lui-même (par exemple à partir de l'identifiant de commande), et non générée au moment du dispatch, pour que toute redélivrance du même événement logique utilise la même clé
- [ ] **B.** Être un UUID généré à chaque dispatch, pour garantir son unicité
- [ ] **C.** Être identique pour tous les messages, quel que soit l'événement métier
- [ ] **D.** Être stockée uniquement en mémoire, jamais persistée en base

### Question 54

Pourquoi un UUID généré au moment du dispatch n'est-il *pas* adapté comme clé d'idempotence ? *(une seule bonne réponse)*

- [ ] **A.** Parce que si le même événement métier est dispatché deux fois (ex. double soumission de formulaire), chaque dispatch génère un UUID différent, et les deux exécutions auront donc lieu
- [ ] **B.** Parce que les UUID ne sont pas sérialisables par Messenger
- [ ] **C.** Parce qu'un UUID est trop long pour être stocké en base de données
- [ ] **D.** Parce que Messenger interdit explicitement l'usage d'UUID dans les messages

## Configuration des transports

### Question 55

Quand des options sont définies à la fois dans le DSN d'un transport et sous sa clé `options`, lesquelles l'emportent ? *(une seule bonne réponse)*

- [ ] **A.** Celles définies sous `options` prennent le pas sur celles du DSN
- [ ] **B.** Celles du DSN prennent toujours le pas sur `options`
- [ ] **C.** Une exception est levée en cas de conflit entre les deux
- [ ] **D.** Seules les options du DSN sont prises en compte, `options` étant ignoré

### Question 56

Que faut-il installer pour utiliser le transport AMQP, et que se passe-t-il si l'auto-création des exchanges/queues est désactivée ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/amqp-messenger` ; désactiver l'auto-création (`queues: []`) peut casser certaines fonctionnalités, comme les files d'attente différées (delayed queues)
- [ ] **B.** L'extension AMQP seule suffit, aucun paquet Composer n'est nécessaire
- [ ] **C.** `composer require symfony/rabbitmq-messenger` ; désactiver l'auto-création n'a aucun effet de bord
- [ ] **D.** Le transport AMQP ne nécessite aucune installation, il est inclus dans `symfony/messenger`

### Question 57

Pourquoi les consommateurs du transport AMQP n'apparaissent-ils pas dans un panneau d'administration, d'après l'avertissement de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ce transport ne s'appuie pas sur `\AmqpQueue::consume()`, qui est bloquant — le worker doit pouvoir itérer et vérifier ses conditions d'arrêt (`--time-limit`, `--memory-limit`, `messenger:stop-workers`) sans être bloqué indéfiniment
- [ ] **B.** Parce que le transport AMQP ne supporte pas l'authentification
- [ ] **C.** Parce qu'aucune extension PHP AMQP n'existe réellement
- [ ] **D.** Parce que le panneau d'administration RabbitMQ est payant

### Question 58

Comment personnaliser la clé de routage AMQP d'un message précis lors de son envoi ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un `AmqpStamp` (avec la clé de routage souhaitée) à l'enveloppe lors du `dispatch()`
- [ ] **B.** En modifiant le nom de la classe du message
- [ ] **C.** Ce n'est pas possible, la clé de routage est toujours dérivée automatiquement du nom du message
- [ ] **D.** Via l'option `routing_key` du `MESSENGER_TRANSPORT_DSN` uniquement, jamais par message

### Question 59

Que faut-il installer pour utiliser le transport Doctrine, et quel est son comportement par défaut concernant la table de stockage ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/doctrine-messenger` ; la table `messenger_messages` est créée automatiquement dès le premier message dispatché
- [ ] **B.** `composer require symfony/orm-messenger` ; il faut toujours créer la table manuellement, même en développement
- [ ] **C.** Aucune installation supplémentaire n'est nécessaire si `doctrine/orm` est déjà présent
- [ ] **D.** `composer require symfony/doctrine-messenger` ; la table est nommée automatiquement selon le nom du transport

### Question 60

En production, que recommande la documentation à propos de l'auto-création de la table Doctrine, et à quoi sert l'option `redeliver_timeout` ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver `auto_setup` et créer la table via une migration explicite ; `redeliver_timeout` définit le délai avant de retenter un message resté trop longtemps à l'état « en cours de traitement » — il doit être supérieur à la durée du message le plus long, sous peine de double traitement
- [ ] **B.** Laisser `auto_setup` activé même en production, cela n'a aucun impact sur les performances
- [ ] **C.** `redeliver_timeout` désigne le nombre maximal de messages traités avant redémarrage du worker
- [ ] **D.** Il n'existe aucune option pour changer le nom de la table Doctrine

### Question 61

Quelle fonctionnalité PostgreSQL le transport Doctrine peut-il exploiter pour être plus performant que le polling classique, via quelle option ? *(une seule bonne réponse)*

- [ ] **A.** `LISTEN`/`NOTIFY`, activé par défaut via l'option `use_notify`
- [ ] **B.** Les triggers PL/pgSQL, activés via l'option `use_triggers`
- [ ] **C.** Les vues matérialisées, via l'option `use_materialized_view`
- [ ] **D.** PostgreSQL ne propose aucune fonctionnalité de ce type, seul le polling est possible

### Question 62

Comment le transport Beanstalkd permet-il de définir la priorité d'un message dispatché, et comment interpréter la valeur numérique ? *(une seule bonne réponse)*

- [ ] **A.** Via un `BeanstalkdPriorityStamp` ; plus le nombre est bas, plus la priorité est haute (0 = priorité la plus haute)
- [ ] **B.** Via l'option `priority` du DSN uniquement, plus le nombre est haut, plus la priorité est haute
- [ ] **C.** Beanstalkd ne supporte pas la notion de priorité par message
- [ ] **D.** Via un `BeanstalkdPriorityStamp`, plus le nombre est haut, plus la priorité est haute

### Question 63

Comment le transport Beanstalkd implémente-t-il le support de l'option `--keepalive` ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant la commande `touch` de Beanstalkd pour réinitialiser périodiquement le `ttr` (time to run) du job
- [ ] **B.** En rouvrant une nouvelle connexion toutes les 5 secondes
- [ ] **C.** Beanstalkd ne supporte pas l'option `--keepalive`
- [ ] **D.** En republiant le message dans une file dédiée au keepalive

### Question 64

Sur quoi repose le transport Redis, et quels prérequis logiciels sont nécessaires ? *(une seule bonne réponse)*

- [ ] **A.** Les « streams » Redis ; l'extension PHP Redis (≥ 4.3) et un serveur Redis (^5.0) sont requis
- [ ] **B.** Les listes (« lists ») Redis classiques ; aucune version minimale n'est requise
- [ ] **C.** Pub/Sub Redis ; nécessite obligatoirement Redis Cluster
- [ ] **D.** Le transport Redis n'existe pas nativement, il faut un bridge tiers

### Question 65

Pourquoi chaque worker consommant un même stream/groupe Redis doit-il avoir un nom de consommateur (`consumer`) unique, d'après l'avertissement de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Sinon, un même message pourrait être traité plus d'une fois par plusieurs workers
- [ ] **B.** Cela ne sert qu'à des fins de journalisation, sans impact sur le traitement
- [ ] **C.** Redis rejette la connexion si deux workers partagent le même nom de consommateur
- [ ] **D.** Ce n'est nécessaire qu'en environnement Kubernetes

### Question 66

Quelles options Redis recommandées permettent d'éviter que les messages ne s'accumulent indéfiniment (fuite mémoire) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `delete_after_ack` à `true` si un seul groupe est utilisé
- [ ] **B.** `stream_max_entries`, pour borner le nombre d'entrées conservées dans le stream
- [ ] **C.** `persistent_id`, pour rendre la connexion persistante
- [ ] **D.** `sentinel_master`, pour activer le support Sentinel

### Question 67

Comment le transport Redis implémente-t-il le support de l'option `--keepalive` ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant la commande `XCLAIM` pour réinitialiser périodiquement à zéro le temps d'inactivité du message
- [ ] **B.** En republiant le message dans le stream toutes les 5 secondes
- [ ] **C.** Redis ne supporte pas l'option `--keepalive`
- [ ] **D.** En incrémentant un compteur `TTL` sur la clé du message

### Question 68

À quoi sert le transport `in-memory://`, et où voit-on son effet le plus concrètement dans les tests ? *(une seule bonne réponse)*

- [ ] **A.** Il ne délivre jamais réellement les messages, les conservant en mémoire durant la requête ; on peut ainsi vérifier via `InMemoryTransport::getSent()` qu'un message précis a bien été dispatché
- [ ] **B.** Il stocke les messages de façon persistante dans un fichier temporaire
- [ ] **C.** Il fonctionne uniquement en environnement `prod` pour des raisons de performance
- [ ] **D.** Il délivre réellement les messages mais en supprime la trace immédiatement après

### Question 69

Que se passe-t-il automatiquement avec les transports `in-memory` dans les tests étendant `KernelTestCase` ou `WebTestCase` ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont réinitialisés automatiquement après chaque test
- [ ] **B.** Ils conservent leur état entre les tests, il faut les réinitialiser manuellement
- [ ] **C.** Ils sont automatiquement convertis en transport `sync://` pendant les tests
- [ ] **D.** Ils lèvent une exception si utilisés en dehors de l'environnement `test`

### Question 70

D'après la documentation, quelles sont les deux stratégies de test complémentaires proposées pour un handler Messenger ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tester le handler comme une simple classe PHP, en injectant des mocks et en appelant `__invoke()` directement, sans infrastructure Messenger
- [ ] **B.** Utiliser le transport `in-memory://` en test fonctionnel pour vérifier que le bon message est dispatché vers le bon transport
- [ ] **C.** Désactiver systématiquement Messenger dans `phpunit.xml.dist`
- [ ] **D.** Ne tester que via des appels HTTP réels au transport de production

### Question 71

Que faut-il installer pour utiliser le transport Amazon SQS, et que se passe-t-il par défaut avec les files nécessaires ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/amazon-sqs-messenger` ; les files nécessaires sont créées automatiquement (désactivable via `auto_setup: false`)
- [ ] **B.** `composer require symfony/aws-messenger` ; il faut toujours créer les files manuellement via la console AWS
- [ ] **C.** Aucune installation Composer supplémentaire n'est nécessaire, seul l'AWS CLI est requis
- [ ] **D.** `composer require symfony/amazon-sqs-messenger` ; les files ne peuvent jamais être créées automatiquement

### Question 72

Quelle est la différence entre les options `wait_time` et `poll_timeout` du transport SQS ? *(une seule bonne réponse)*

- [ ] **A.** `wait_time` définit la durée maximale que SQS attend avant de répondre s'il n'y a pas de message (long polling) ; `poll_timeout` définit la durée pendant laquelle le récepteur attend avant de retourner `null`, pour ne pas bloquer les autres récepteurs
- [ ] **B.** Elles sont strictement équivalentes, l'une étant juste un alias historique de l'autre
- [ ] **C.** `wait_time` concerne uniquement l'envoi de messages, `poll_timeout` uniquement leur réception
- [ ] **D.** `poll_timeout` définit le nombre maximal de messages récupérés par appel

### Question 73

Comment SQS détermine-t-il qu'une file doit être une file FIFO, et quelle stamp/middleware Symfony propose-t-il pour gérer la déduplication et le regroupement ? *(une seule bonne réponse)*

- [ ] **A.** Le suffixe `.fifo` sur le nom de la file ; `AmazonSqsFifoStamp` (manuellement, ou automatiquement via `AddFifoStampMiddleware` si le message implémente les interfaces dédiées) permet de définir le « Message group ID » et le « Message deduplication ID »
- [ ] **B.** Une option `fifo: true` dans le DSN, sans lien avec le nom de la file
- [ ] **C.** SQS ne propose aucune notion de file FIFO
- [ ] **D.** Le suffixe `.ordered`, avec un stamp `AmazonSqsOrderedStamp`

### Question 74

Selon l'avertissement de la documentation, la déduplication de messages SQS est-elle basée sur la file d'attente ou sur le temps ? *(une seule bonne réponse)*

- [ ] **A.** Sur la file d'attente : un ID de déduplication ne peut jamais être réutilisé, même après suppression du message d'origine
- [ ] **B.** Sur le temps : une fois un ID de déduplication utilisé, SQS rejette tout message avec le même ID pendant les 5 minutes suivantes, que le message d'origine ait été consommé ou non
- [ ] **C.** SQS ne fait aucune déduplication, celle-ci devant être gérée entièrement côté application
- [ ] **D.** Sur le contenu du message uniquement, indépendamment de tout ID de déduplication

### Question 75

Comment le transport SQS implémente-t-il le support de l'option `--keepalive` ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant l'action `ChangeMessageVisibility` pour mettre à jour périodiquement le `VisibilityTimeout` du message
- [ ] **B.** En republiant un message identique toutes les 5 secondes
- [ ] **C.** SQS ne supporte pas l'option `--keepalive`
- [ ] **D.** En augmentant automatiquement le `wait_time` de la file

## Sérialiser les messages et fermer les connexions

### Question 76

Comment les messages sont-ils sérialisés par défaut lors de leur envoi vers/depuis un transport, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** Via `serialize()`/`unserialize()` PHP natifs ; on peut le changer globalement ou par transport via un service implémentant `SerializerInterface`, comme le service intégré basé sur le composant Serializer
- [ ] **B.** Via `json_encode()`/`json_decode()` PHP natifs, sans possibilité de changement
- [ ] **C.** Via le composant Serializer uniquement, PHP natif n'étant jamais utilisé
- [ ] **D.** La sérialisation n'est configurable que globalement, jamais par transport

### Question 77

Comment contrôler, au cas par cas, le contexte de sérialisation utilisé par le sérialiseur Symfony pour un message donné ? *(une seule bonne réponse)*

- [ ] **A.** Via le `SerializerStamp`, ajouté à l'enveloppe du message
- [ ] **B.** Ce n'est configurable que globalement via `messenger.yaml`, jamais par message
- [ ] **C.** Via un attribut `#[SerializationContext]` sur la classe de message
- [ ] **D.** En surchargeant la méthode `getContext()` du message lui-même

### Question 78

Quels transports implémentent `CloseableTransportInterface`, permettant de libérer explicitement leurs ressources dans un process long ? *(une seule bonne réponse)*

- [ ] **A.** AmazonSqs, Amqp et Redis
- [ ] **B.** Uniquement Doctrine, via cette même interface
- [ ] **C.** Tous les transports intégrés, sans exception
- [ ] **D.** Aucun transport ne l'implémente nativement, il faut toujours une implémentation personnalisée

## Déclencher des commandes et des processus externes

### Question 79

Comment déclencher l'exécution d'une commande Symfony depuis n'importe quel service, via Messenger ? *(une seule bonne réponse)*

- [ ] **A.** En dispatchant un `RunCommandMessage` contenant la ligne de commande à exécuter
- [ ] **B.** En appelant directement `Application::run()` depuis le service
- [ ] **C.** Ce n'est possible que depuis un contrôleur, jamais depuis un service quelconque
- [ ] **D.** En dispatchant un `RunProcessMessage` avec le binaire `php bin/console` en argument

### Question 80

Quels paramètres de `RunCommandMessage` permettent de configurer le comportement en cas d'échec de la commande exécutée ? *(une seule bonne réponse)*

- [ ] **A.** `throwOnFailure` et `catchExceptions`
- [ ] **B.** `onError` et `retryOnFailure`
- [ ] **C.** `strict` et `silent`
- [ ] **D.** Aucun paramètre de ce type n'existe, l'échec est toujours silencieux

### Question 81

Que retourne le handler d'un `RunCommandMessage` une fois la commande traitée, et qu'y trouve-t-on ? *(une seule bonne réponse)*

- [ ] **A.** Un `RunCommandContext`, contenant notamment le code de sortie et la sortie du process
- [ ] **B.** Un simple booléen indiquant le succès ou l'échec
- [ ] **C.** Rien, le retour du handler est toujours `null`
- [ ] **D.** L'objet `Command` lui-même, réhydraté

### Question 82

Comment exécuter un processus externe en profitant des fonctionnalités du shell (redirections, pipes) via Messenger ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant la factory statique `RunProcessMessage::fromShellCommandline()`
- [ ] **B.** Le constructeur standard de `RunProcessMessage` suffit toujours, quelle que soit la syntaxe utilisée
- [ ] **C.** Ce n'est pas possible via Messenger, il faut utiliser le composant Process directement, hors de tout message
- [ ] **D.** En passant l'option `shell: true` au constructeur de `RunProcessMessage`

## Sécuriser les messages avec des signatures

### Question 83

Quel handler Symfony a la signature de message activée par défaut, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** `RunProcessHandler`, car il exécute des commandes ou des processus, ce qui rend la protection contre les charges utiles falsifiées particulièrement importante
- [ ] **B.** `SendEmailHandler`, pour éviter l'usurpation d'expéditeur
- [ ] **C.** Aucun handler n'a la signature activée par défaut, elle doit toujours être configurée explicitement
- [ ] **D.** `RunCommandHandler`, mais uniquement en environnement `prod`

### Question 84

Comment activer la signature d'un message pour un handler donné, et sur quoi repose cette signature ? *(une seule bonne réponse)*

- [ ] **A.** En passant `sign: true` à `#[AsMessageHandler]` (ou au tag `messenger.message_handler`) ; la signature est une HMAC calculée avec le secret de l'application (`kernel.secret`)
- [ ] **B.** En installant obligatoirement le composant Lock, sans autre configuration
- [ ] **C.** En signant manuellement chaque message avec une clé privée RSA générée à part
- [ ] **D.** La signature est toujours activée globalement pour tous les handlers, sans option individuelle

### Question 85

Que se passe-t-il si la signature d'un message reçu est absente ou invalide, alors que la signature est activée pour son handler ? *(une seule bonne réponse)*

- [ ] **A.** Une `InvalidMessageSignatureException` est levée et le message n'est pas traité
- [ ] **B.** Le message est traité normalement, un simple avertissement étant journalisé
- [ ] **C.** Le message est automatiquement re-signé puis traité
- [ ] **D.** Le worker entier s'arrête définitivement

## Interroger un service web

### Question 86

Comment dispatcher une requête de type « ping » vers un service web via Messenger, et que retourne le handler ? *(une seule bonne réponse)*

- [ ] **A.** En dispatchant un `PingWebhookMessage` (méthode HTTP + URL) ; le handler retourne un objet `ResponseInterface`
- [ ] **B.** En dispatchant un `RunProcessMessage` avec `curl` en ligne de commande
- [ ] **C.** Il n'existe pas de mécanisme dédié, il faut utiliser directement `HttpClientInterface` hors de Messenger
- [ ] **D.** En dispatchant un `PingWebhookMessage`, qui ne retourne jamais rien

## Obtenir le résultat des handlers

### Question 87

Comment récupérer la valeur retournée par le(s) handler(s) d'un message après son dispatch ? *(une seule bonne réponse)*

- [ ] **A.** Via le `HandledStamp` (ajouté par `HandleMessageMiddleware`), accessible via `$envelope->last(HandledStamp::class)->getResult()`
- [ ] **B.** `dispatch()` retourne directement la valeur du handler
- [ ] **C.** Il faut obligatoirement passer par un événement `WorkerMessageHandledEvent` pour récupérer le résultat
- [ ] **D.** Ce n'est possible qu'en désactivant l'asynchrone pour ce message

### Question 88

À quoi sert le `HandleTrait`, utile notamment dans une architecture CQRS avec bus de requêtes ? *(une seule bonne réponse)*

- [ ] **A.** Il permet d'obtenir le résultat du handler en traitement synchrone, et garantit qu'exactement un seul handler est enregistré pour ce message
- [ ] **B.** Il permet de dispatcher un message vers plusieurs bus simultanément
- [ ] **C.** Il transforme automatiquement un bus synchrone en bus asynchrone
- [ ] **D.** Il ne fonctionne qu'avec des messages de type « commande », jamais de type « requête »

### Question 89

Quelle contrainte le `HandleTrait` impose-t-il sur la classe qui l'utilise ? *(une seule bonne réponse)*

- [ ] **A.** Elle doit posséder une propriété nommée `$messageBus`
- [ ] **B.** Elle doit implémenter `MessageBusInterface` elle-même
- [ ] **C.** Elle doit obligatoirement être un contrôleur
- [ ] **D.** Elle doit être déclarée `final`

### Question 90

Peut-on ajouter des stamps supplémentaires lors de l'appel à la méthode `handle()` du `HandleTrait` ? *(une seule bonne réponse)*

- [ ] **A.** Non, seuls les stamps ajoutés au dispatch initial sont conservés
- [ ] **B.** Oui, ils viennent s'ajouter aux stamps déjà présents sur l'enveloppe
- [ ] **C.** Oui, mais ils remplacent alors tous les stamps existants
- [ ] **D.** Ce n'est possible qu'avec un bus dédié aux requêtes, jamais aux commandes

## Personnaliser les handlers

### Question 91

Quelles options peut-on configurer sur un handler via `#[AsMessageHandler]` ou le tag `messenger.message_handler` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `bus` (bus autorisé) et `from_transport` (transport autorisé)
- [ ] **B.** `handles` (type de message, si non déductible du type-hint) et `method` (méthode traitant le message)
- [ ] **C.** `priority`, qui définit l'ordre d'exécution entre plusieurs handlers pour le même message
- [ ] **D.** `timeout`, qui interrompt automatiquement un handler trop lent

### Question 92

Quand plusieurs handlers traitent le même message avec des priorités différentes, comment s'enchaînent-ils ? *(une seule bonne réponse)*

- [ ] **A.** Les handlers de priorité plus haute s'exécutent d'abord, chacun démarrant seulement après que le précédent se soit entièrement terminé
- [ ] **B.** Tous les handlers s'exécutent en parallèle, quelle que soit leur priorité
- [ ] **C.** Seul le handler de priorité la plus haute est réellement exécuté, les autres sont ignorés
- [ ] **D.** La priorité ne détermine que l'ordre d'affichage dans `debug:messenger`, sans effet sur l'exécution

### Question 93

Comment permettre à une seule classe de gérer plusieurs types de messages différents ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant l'attribut `#[AsMessageHandler]` à chacune des méthodes concernées, chacune type-hintée avec son propre message
- [ ] **B.** Ce n'est pas possible, une classe ne peut gérer qu'un seul type de message
- [ ] **C.** En implémentant une méthode `handles(): array` listant les classes gérées
- [ ] **D.** En utilisant un `switch` dans une unique méthode `__invoke(object $message)`

### Question 94

Dans l'exemple du processus `RegisterUser`, quel problème peut survenir si un handler d'événement (envoi d'email de bienvenue) lève une exception, en présence du middleware `DoctrineTransactionMiddleware` ? *(une seule bonne réponse)*

- [ ] **A.** La transaction Doctrine dans laquelle l'utilisateur venait d'être créé est annulée (rollback), alors que l'échec ne concerne que l'envoi de l'email
- [ ] **B.** L'email est simplement renvoyé automatiquement, sans autre conséquence
- [ ] **C.** Seul le message d'événement échoue, sans jamais affecter la transaction du handler de commande d'origine
- [ ] **D.** Le worker entier redémarre automatiquement

### Question 95

Comment garantir qu'un message d'événement dispatché depuis un handler ne sera traité qu'une fois ce handler entièrement terminé (et sans exception) ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un `DispatchAfterCurrentBusStamp` à l'enveloppe du message, traité par le `DispatchAfterCurrentBusMiddleware`
- [ ] **B.** En dispatchant le message d'événement dans un `try/finally` manuel
- [ ] **C.** Ce comportement n'est pas configurable, tous les messages sont toujours traités immédiatement
- [ ] **D.** En augmentant la priorité du handler d'événement

### Question 96

Le middleware `dispatch_after_current_bus` est-il activé par défaut, et où doit-il être positionné par rapport à `doctrine_transaction` si la configuration est manuelle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, activé par défaut ; il doit être positionné avant `doctrine_transaction` dans la chaîne, et chargé sur tous les bus utilisés
- [ ] **B.** Non, il doit toujours être ajouté manuellement, et sa position dans la chaîne n'a aucune importance
- [ ] **C.** Oui, activé par défaut, mais il doit être positionné après `doctrine_transaction`
- [ ] **D.** Il ne concerne que le bus par défaut, jamais les bus additionnels

### Question 97

Si `WhenUserRegisteredThenSendWelcomeEmail` lève une exception alors que le message a été dispatché avec un `DispatchAfterCurrentBusStamp`, dans quel type d'exception est-elle enveloppée ? *(une seule bonne réponse)*

- [ ] **A.** `DelayedMessageHandlingException`, dont `getWrappedExceptions()` donne accès à toutes les exceptions levées
- [ ] **B.** `UnrecoverableMessageHandlingException`, empêchant tout nouvel essai
- [ ] **C.** Aucune exception n'est levée dans ce cas précis, l'erreur étant silencieusement ignorée
- [ ] **D.** `DispatchAfterCurrentBusException`, sans accès aux exceptions d'origine

### Question 98

Comment faire en sorte qu'un handler ne soit appelé que lorsqu'un message est reçu depuis un transport précis, et que se passe-t-il en l'absence de cette configuration ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `from_transport` du handler ; sans elle, le handler est exécuté sur *chaque* transport depuis lequel le message est reçu
- [ ] **B.** Via l'option `only_transport`, un handler sans cette option n'étant alors jamais exécuté
- [ ] **C.** Ce n'est pas configurable, tous les handlers d'un message s'exécutent systématiquement une seule fois, peu importe le transport
- [ ] **D.** En créant un bus dédié par transport, seule solution possible

### Question 99

Comment implémente-t-on un handler qui traite les messages par lots plutôt qu'un par un ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `BatchHandlerInterface` et en utilisant `BatchHandlerTrait`, avec une méthode `process(array $jobs)`
- [ ] **B.** En configurant l'option `batch_size` directement sur le transport
- [ ] **C.** Ce n'est possible qu'avec le transport Doctrine
- [ ] **D.** En appelant manuellement `messenger:consume` avec l'option `--batch`

### Question 100

Quelle est la taille de lot par défaut pour un `BatchHandlerInterface`, et comment la modifier ? *(une seule bonne réponse)*

- [ ] **A.** 10 messages par défaut ; surchargeable via la méthode `getBatchSize()`
- [ ] **B.** 100 messages par défaut ; surchargeable via une option de configuration YAML
- [ ] **C.** Il n'y a pas de taille par défaut, elle doit toujours être définie explicitement
- [ ] **D.** 1 message par défaut, ce qui revient à désactiver le traitement par lots

### Question 101

Quand les lots en attente (« pending batches ») sont-ils vidés (flush), d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Quand le worker est inactif (idle) ou quand il s'arrête
- [ ] **B.** Uniquement quand la taille de lot configurée est atteinte, jamais avant
- [ ] **C.** Toutes les 60 secondes, quel que soit l'état du worker
- [ ] **D.** Uniquement sur demande explicite via `messenger:flush-batches`

## Enveloppes, stamps et middlewares

### Question 102

Qu'est-ce qu'une « enveloppe » (`Envelope`) dans Messenger ? *(une seule bonne réponse)*

- [ ] **A.** Un objet qui enveloppe le message et l'ensemble de ses « stamps », utilisé en interne pour transporter des informations additionnelles (bus utilisé, statut de retry…)
- [ ] **B.** Le format sérialisé final du message tel qu'envoyé au transport
- [ ] **C.** Une classe abstraite que chaque message doit obligatoirement étendre
- [ ] **D.** Un synonyme du concept de « stamp », les deux termes étant interchangeables

### Question 103

Symfony injecte-t-il automatiquement l'`Envelope` si on la type-hinte comme argument de la méthode `__invoke()` d'un handler ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, sans configuration additionnelle
- [ ] **B.** Non ; il faut créer un middleware personnalisé qui ajoute un `HandlerArgumentsStamp` contenant l'enveloppe avant que `HandleMessageMiddleware` ne s'exécute
- [ ] **C.** Oui, mais uniquement si le message implémente une interface `EnvelopeAware`
- [ ] **D.** Non, et il n'existe aucun moyen de le faire, même avec un middleware personnalisé

### Question 104

Comment un message peut-il déclarer ses propres stamps par défaut, appliqués automatiquement à chaque dispatch ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `DefaultStampsProviderInterface` et sa méthode `getDefaultStamps()`
- [ ] **B.** En ajoutant un attribut `#[DefaultStamps(...)]` sur la classe de message
- [ ] **C.** Ce n'est pas possible, les stamps doivent toujours être passés explicitement à chaque `dispatch()`
- [ ] **D.** En surchargeant le constructeur de `Envelope`

### Question 105

Si un message implémentant `DefaultStampsProviderInterface` est dispatché avec un stamp explicite du même type que l'un de ses stamps par défaut, lequel est utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Le stamp explicite passé au dispatch, qui prévaut sur le stamp par défaut du même type
- [ ] **B.** Les deux stamps sont conservés et appliqués simultanément, sans conflit possible
- [ ] **C.** Le stamp par défaut du message prévaut toujours, quel que soit le stamp explicite
- [ ] **D.** Une exception est levée en cas de doublon de type de stamp

### Question 106

Dans quel ordre s'exécute la chaîne de middleware par défaut d'un bus, entre l'ajout du stamp de bus et l'appel effectif du handler ? *(une seule bonne réponse)*

- [ ] **A.** `add_bus_name_stamp_middleware` → `dispatch_after_current_bus` → `failed_message_processing_middleware` → middlewares personnels → `send_message` → `handle_message`
- [ ] **B.** `handle_message` → `send_message` → middlewares personnels → `add_bus_name_stamp_middleware`
- [ ] **C.** `send_message` s'exécute systématiquement en tout dernier, après `handle_message`
- [ ] **D.** L'ordre est indéterminé et recalculé aléatoirement à chaque dispatch

### Question 107

Que fait le middleware `send_message` s'il existe une route de transport configurée pour le message ? *(une seule bonne réponse)*

- [ ] **A.** Il envoie le message au transport et arrête la chaîne de middleware, `handle_message` n'étant alors pas appelé sur ce dispatch
- [ ] **B.** Il envoie le message au transport puis appelle immédiatement `handle_message` en synchrone en plus
- [ ] **C.** Il ignore la route configurée si le message a déjà un handler synchrone
- [ ] **D.** Il duplique le message vers tous les transports configurés dans l'application

### Question 108

Les middlewares s'exécutent-ils uniquement au moment du dispatch initial d'un message, ou aussi lors de sa réception par le worker ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement au dispatch initial
- [ ] **B.** À la fois au dispatch et de nouveau à la réception par le worker, pour les messages envoyés à un transport
- [ ] **C.** Uniquement à la réception par le worker, jamais au dispatch
- [ ] **D.** Seulement si le message est asynchrone ET signé

### Question 109

Comment désactiver entièrement les middlewares par défaut d'un bus pour ne conserver que les siens ? *(une seule bonne réponse)*

- [ ] **A.** En définissant `default_middleware: false` sur ce bus, puis en listant uniquement les middlewares souhaités sous `middleware`
- [ ] **B.** Ce n'est pas possible, les middlewares par défaut sont toujours actifs sur tous les bus
- [ ] **C.** En supprimant le bundle FrameworkBundle de la configuration
- [ ] **D.** En définissant `middleware: []`, ce qui désactive automatiquement aussi les middlewares par défaut

### Question 110

Comment prévenir qu'un même message ne soit dispatché ou traité plusieurs fois, via un mécanisme intégré basé sur le composant Lock ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un `DeduplicateStamp` (avec une clé de déduplication) à l'enveloppe du message
- [ ] **B.** En taguant le handler avec `messenger.deduplicate`
- [ ] **C.** Ce n'est pas possible nativement, il faut toujours une solution applicative maison
- [ ] **D.** En configurant `deduplicate: true` directement sur le transport

### Question 111

La clé passée à `DeduplicateStamp` doit-elle être globalement unique ? Et que se passe-t-il si son troisième argument est `true` ? *(une seule bonne réponse)*

- [ ] **A.** Non, c'est un choix métier qui définit ce que signifie « même message » pour l'application ; avec le troisième argument à `true`, le verrou est relâché dès que le worker reçoit le message, permettant un traitement concurrent d'un message similaire
- [ ] **B.** Oui, elle doit être unique au niveau mondial, sous peine de comportement indéfini
- [ ] **C.** Non, mais le troisième argument à `true` désactive complètement la déduplication
- [ ] **D.** Oui, et le troisième argument ne fait que définir le TTL du verrou en secondes

### Question 112

Quand le middleware de déduplication des messages est-il automatiquement activé ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement dès que le composant Lock est installé
- [ ] **B.** Il faut toujours l'activer explicitement dans `messenger.yaml`, quel que soit les composants installés
- [ ] **C.** Automatiquement dès que Doctrine est installé
- [ ] **D.** Il n'est jamais activé automatiquement, contrairement aux autres middlewares Doctrine

### Question 113

Parmi les middlewares Doctrine optionnels proposés, lequel évite d'avoir à appeler `flush()` dans chaque handler, en enveloppant tous les handlers dans une seule transaction ? *(une seule bonne réponse)*

- [ ] **A.** `doctrine_transaction`
- [ ] **B.** `doctrine_ping_connection`
- [ ] **C.** `doctrine_close_connection`
- [ ] **D.** `doctrine_open_transaction_logger`

### Question 114

À quoi servent respectivement les middlewares `doctrine_ping_connection` et `doctrine_close_connection` ? *(une seule bonne réponse)*

- [ ] **A.** Le premier reconnecte la connexion Doctrine si elle a été fermée (utile pour des workers de longue durée) ; le second ferme la connexion après traitement, pour libérer des connexions
- [ ] **B.** Les deux font strictement la même chose, l'un étant un simple alias de l'autre
- [ ] **C.** `doctrine_ping_connection` journalise les transactions ouvertes non fermées, sans lien avec la reconnexion
- [ ] **D.** `doctrine_close_connection` reconnecte automatiquement après chaque message, l'inverse de ce que son nom suggère

### Question 115

À quoi servent respectivement les middlewares `router_context` et `validation` ? *(une seule bonne réponse)*

- [ ] **A.** `router_context` conserve le contexte de la requête d'origine (hôte, port…) pour générer des URLs absolues dans le worker ; `validation` valide l'objet message avec le composant Validator avant traitement, via `ValidationFailedException` en cas d'échec
- [ ] **B.** Les deux ne concernent que le rendu Twig dans le worker
- [ ] **C.** `router_context` valide le message, `validation` génère les URLs absolues — les rôles inverses de ce que suggèrent leurs noms
- [ ] **D.** Ils ne sont utilisables que sur le bus par défaut, jamais sur un bus personnalisé

### Question 116

Le `MessageSentToTransportsEvent` est-il dispatché une fois par transport quand un message est envoyé à plusieurs transports à la fois ? *(une seule bonne réponse)*

- [ ] **A.** Oui, une fois par transport concerné
- [ ] **B.** Non, il n'est dispatché qu'une seule fois, après l'envoi à au moins un transport
- [ ] **C.** Il n'est jamais dispatché en cas d'envoi à plusieurs transports
- [ ] **D.** Il est dispatché avant l'envoi, pas après

### Question 117

Parmi les événements Messenger suivants, lesquels concernent le cycle de vie du **worker** lui-même plutôt que celui d'un message précis ? *(plusieurs bonnes réponses)*

- [ ] **A.** `WorkerStartedEvent`
- [ ] **B.** `WorkerStoppedEvent`
- [ ] **C.** `WorkerRunningEvent`
- [ ] **D.** `WorkerMessageHandledEvent`

### Question 118

Comment transmettre à un handler une donnée additionnelle qui n'est pas portée par le message lui-même ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un `HandlerArgumentsStamp` à l'enveloppe depuis un middleware personnalisé, avec les arguments supplémentaires à fournir au handler
- [ ] **B.** En modifiant directement la signature de `HandleMessageMiddleware`
- [ ] **C.** Ce n'est pas possible, un handler ne peut recevoir que le message en argument
- [ ] **D.** En stockant la donnée dans une propriété statique globale

### Question 119

Pourquoi peut-on avoir besoin d'implémenter son propre `SerializerInterface` pour un transport ? *(une seule bonne réponse)*

- [ ] **A.** Quand les messages reçus d'une autre application n'utilisent pas exactement le format JSON `body`/`headers` attendu par défaut par Symfony
- [ ] **B.** Uniquement pour chiffrer les messages, ce que le sérialiseur par défaut ne permet jamais
- [ ] **C.** C'est obligatoire dès qu'on utilise plus d'un transport
- [ ] **D.** Ce n'est jamais nécessaire, le sérialiseur par défaut couvrant tous les formats existants

## Bus multiples : commandes, requêtes et événements

### Question 120

Combien de bus de message Symfony configure-t-il par défaut, et peut-on en ajouter d'autres ? *(une seule bonne réponse)*

- [ ] **A.** Un seul par défaut, mais on peut en configurer autant que nécessaire (bus de commandes, de requêtes, d'événements…)
- [ ] **B.** Trois par défaut (commande, requête, événement), non modifiables
- [ ] **C.** Aucun par défaut, au moins un bus doit toujours être configuré manuellement
- [ ] **D.** Un seul, et il est impossible d'en ajouter d'autres

### Question 121

D'après le conseil de la documentation, quand faut-il ajouter un bus supplémentaire à son application ? *(une seule bonne réponse)*

- [ ] **A.** Dès que l'on adopte une architecture CQRS, quel que soit le besoin réel
- [ ] **B.** Uniquement quand on a besoin d'une pile de middleware différente, pas simplement parce qu'un pattern architectural le suggère
- [ ] **C.** Systématiquement, un seul bus étant toujours insuffisant en production
- [ ] **D.** Uniquement si l'application utilise Doctrine

### Question 122

Comment définir quel bus est injecté par défaut lorsqu'on type-hinte `MessageBusInterface` sans autre précision ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `default_bus` de la configuration `framework.messenger`
- [ ] **B.** C'est toujours le premier bus déclaré dans l'ordre alphabétique
- [ ] **C.** Ce n'est pas configurable, `MessageBusInterface` correspond toujours à un bus nommé `messenger.default_bus` fixe
- [ ] **D.** Via une variable d'environnement `MESSENGER_DEFAULT_BUS`

### Question 123

À quoi servent les options `allow_no_handlers` et `allow_no_senders` sur un bus, par exemple un bus d'événements ? *(une seule bonne réponse)*

- [ ] **A.** Elles permettent respectivement de ne pas lever d'exception si aucun handler, ou aucun expéditeur (sender), n'est configuré pour ce bus
- [ ] **B.** Elles désactivent complètement la validation des messages sur ce bus
- [ ] **C.** Elles ne concernent que les bus de commandes, jamais les bus d'événements
- [ ] **D.** Elles définissent le nombre maximal de handlers autorisés sur ce bus

### Question 124

Comment restreindre un handler à un seul bus précis, pour éviter qu'un message ne soit géré sur le mauvais bus sans erreur explicite ? *(une seule bonne réponse)*

- [ ] **A.** En précisant l'option `bus` du tag `messenger.message_handler` pour ce handler
- [ ] **B.** Ce n'est pas configurable, tout handler est disponible sur tous les bus par défaut, sans exception possible
- [ ] **C.** En créant une classe de message distincte par bus
- [ ] **D.** En renommant le bus pour qu'il corresponde au nom du handler

### Question 125

Comment assigner automatiquement un groupe de handlers à un bus précis selon une interface qu'ils implémentent, sans les tagger un par un ? *(une seule bonne réponse)*

- [ ] **A.** Via la configuration `_instanceof` de `services.yaml`, en taguant `messenger.message_handler` (avec l'option `bus`) pour chaque interface concernée
- [ ] **B.** Ce n'est possible qu'en modifiant chaque classe individuellement
- [ ] **C.** Via un attribut `#[AsMessageHandler(autoBus: true)]`
- [ ] **D.** En créant un compiler pass personnalisé, seule méthode disponible

### Question 126

Que montre la commande `debug:messenger`, et peut-on la restreindre à un seul bus ? *(une seule bonne réponse)*

- [ ] **A.** Les messages et handlers disponibles par bus ; on peut la restreindre en passant le nom du bus en argument
- [ ] **B.** Uniquement la liste des transports configurés, sans lien avec les bus
- [ ] **C.** Elle liste les messages en échec, un synonyme de `messenger:failed:show`
- [ ] **D.** Elle ne peut afficher que le bus par défaut, jamais un bus nommé

## Rediffuser un message

### Question 127

Comment rediffuser (redispatch) un message en réutilisant le même transport et la même enveloppe qu'à l'origine ? *(une seule bonne réponse)*

- [ ] **A.** En créant un `RedispatchMessage` à partir du message d'origine et en le dispatchant via le bus
- [ ] **B.** En appelant `$envelope->resend()` directement
- [ ] **C.** Ce n'est pas possible nativement, il faut redispatcher manuellement une nouvelle instance du message d'origine
- [ ] **D.** En taguant le handler avec `messenger.redispatchable`

### Question 128

Le `RedispatchMessage` permet-il de choisir explicitement d'autres transports que ceux d'origine pour la rediffusion ? *(une seule bonne réponse)*

- [ ] **A.** Non, il utilise toujours exactement les mêmes transports que le dispatch original
- [ ] **B.** Oui, via le second argument de son constructeur
- [ ] **C.** Oui, mais uniquement en modifiant directement `RedispatchMessageHandler`
- [ ] **D.** Non, la rediffusion se fait toujours de façon synchrone, sans transport

## Créer son propre transport Messenger

### Question 129

Quelles deux interfaces principales une classe doit-elle combiner pour agir comme un transport Messenger complet ? *(une seule bonne réponse)*

- [ ] **A.** `TransportInterface`, qui combine `SenderInterface` et `ReceiverInterface`
- [ ] **B.** `SenderInterface` uniquement, `ReceiverInterface` étant optionnelle
- [ ] **C.** `MessageBusInterface` et `SerializerInterface`
- [ ] **D.** `TransportFactoryInterface` et `TransportInterface`, sans lien de composition entre elles

### Question 130

Quelles méthodes une « transport factory » personnalisée doit-elle implémenter, via `TransportFactoryInterface` ? *(une seule bonne réponse)*

- [ ] **A.** `createTransport(string $dsn, array $options, SerializerInterface $serializer)` et `supports(string $dsn, array $options): bool`
- [ ] **B.** `create()` et `getSupportedSchemes()` uniquement
- [ ] **C.** `build()` et `matches()`
- [ ] **D.** Une seule méthode, `connect(string $dsn)`

### Question 131

Comment la factory `supports()` détermine-t-elle, dans l'exemple de la documentation, qu'elle doit prendre en charge un DSN donné ? *(une seule bonne réponse)*

- [ ] **A.** En vérifiant que le DSN commence par le schéma personnalisé, par exemple `0 === strpos($dsn, 'my-transport://')`
- [ ] **B.** En interrogeant un registre central de schémas DSN enregistrés
- [ ] **C.** Elle accepte systématiquement tous les DSN, à charge pour `createTransport()` de rejeter les DSN invalides
- [ ] **D.** En comparant le DSN à une liste blanche définie dans `messenger.yaml`

### Question 132

Une fois la classe de transport et sa factory écrites, comment enregistrer cette dernière si l'autoconfiguration par défaut de `services.yaml` est utilisée ? *(une seule bonne réponse)*

- [ ] **A.** Rien à faire de plus, l'autoconfiguration l'enregistre déjà automatiquement
- [ ] **B.** Il faut systématiquement la tagger manuellement avec `messenger.transport_factory`, l'autoconfiguration ne s'appliquant jamais aux factories
- [ ] **C.** Il faut l'ajouter à un fichier `transports.yaml` dédié
- [ ] **D.** Il faut l'enregistrer comme alias du service `messenger.transport_factory` par défaut

### Question 133

Si l'autoconfiguration n'est pas utilisée, comment enregistrer manuellement une transport factory personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** En taguant son service avec `messenger.transport_factory`
- [ ] **B.** En l'ajoutant à un tableau statique du `Kernel`
- [ ] **C.** En la déclarant `public: true`, ce qui suffit sans tag additionnel
- [ ] **D.** En la nommant explicitement `App\Transport\CustomTransportFactory`, seule convention reconnue

### Question 134

Une fois la factory enregistrée, comment déclarer un transport nommé utilisant ce DSN personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Comme n'importe quel autre transport, sous `framework.messenger.transports`, par exemple `yours: 'my-transport://...'`
- [ ] **B.** Il faut une clé de configuration séparée `custom_transports`, distincte de `transports`
- [ ] **C.** Ce n'est pas possible via la configuration YAML, uniquement en PHP
- [ ] **D.** En le déclarant directement dans le DSN de `MESSENGER_TRANSPORT_DSN`, sans lui donner de nom

### Question 135

Une fois un transport personnalisé nommé `yours` configuré, quels services Symfony met-il à disposition ? *(une seule bonne réponse)*

- [ ] **A.** `messenger.sender.yours` et `messenger.receiver.yours`
- [ ] **B.** Uniquement `messenger.transport.yours`, sans distinction sender/receiver
- [ ] **C.** `messenger.yours.sender` et `messenger.yours.receiver` (ordre inversé)
- [ ] **D.** Aucun service dédié n'est exposé, seul le routage interne y accède

### Question 136

Pour des implémentations réelles de `TransportInterface` à étudier en exemple, vers quelles classes la documentation renvoie-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `InMemoryTransport` et `DoctrineReceiver`
- [ ] **B.** `AmqpTransport` et `RedisTransport` uniquement
- [ ] **C.** Aucune classe concrète n'est citée en exemple, seul le pseudo-code de la page suffit
- [ ] **D.** `SyncTransport` et `NullTransport`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Messenger de la documentation Symfony 8.0](https://symfony.com/doc/8.0/messenger.html) ; les entrées préfixées *Custom Transport —* renvoient à sa page Learn more.

**Question 1 : A** — « Get them installed with: `$ composer require symfony/messenger` » *(§ Installation)*

**Question 2 : B** — « There are no specific requirements for a message class, except that it can be serialized. » *(§ Creating a Message & Handler)*

**Question 3 : A** — « the recommended way to create it is to create a class that has the `AsMessageHandler` attribute and has an `__invoke()` method that's type-hinted with the message class (or a message interface). » *(§ Creating a Message & Handler)*

**Question 4 : B** — « You can also use the `#[AsMessageHandler]` attribute on individual class methods. You may use the attribute on as many methods in a single class as you like. » *(§ Creating a Message & Handler)*

**Question 5 : A** — « Thanks to autoconfiguration and the `SmsNotification` type-hint, Symfony knows that this handler should be called. » *(§ Creating a Message & Handler)*

**Question 6 : B** — « To see all the configured handlers, run: `$ php bin/console debug:messenger` » *(§ Creating a Message & Handler)*

**Question 7 : A** — « inject the `messenger.default_bus` service (via the `MessageBusInterface`) (…) `$bus->dispatch(new SmsNotification(...));` » *(§ Dispatching the Message)*

**Question 8 : A** — « By default, messages are handled as soon as they are dispatched. If you want to handle a message asynchronously, you can configure a transport. » *(§ Transports: Async/Queued Messages)*

**Question 9 : A** — « A transport is registered using a "DSN". » *(§ Transports: Async/Queued Messages)*

**Question 10 : A, B** — attribut `#[AsMessage('async')]` sur la classe, ou entrée `routing: 'App\Message\SmsNotification': async` dans la configuration. *(§ Routing Messages to a Transport)*

**Question 11 : B** — « If you configure routing with both YAML/PHP configuration files and PHP attributes, the configuration always takes precedence over the class attribute. This behavior allows you to override routing on a per-environment basis. » *(§ Routing Messages to a Transport)*

**Question 12 : A** — « you can use a partial PHP namespace like `'App\Message\*'` to match all the messages within the matching namespace. The only requirement is that the `'*'` wildcard has to be placed at the end of the namespace. » *(§ Routing Messages to a Transport)*

**Question 13 : A** — « You may use `'*'` as the message class. This will act as a default routing rule (…) The only drawback is that `'*'` will also apply to the emails sent with the Symfony Mailer (…) This could cause issues if your emails are not serializable. » *(§ Routing Messages to a Transport)*

**Question 14 : B** — « If you configure routing for both a child and parent class, both rules are used. » *(§ Routing Messages to a Transport)*

**Question 15 : A** — « You can define and override the transport that a message is using at runtime by using the `TransportNamesStamp` on the envelope of the message. » *(§ Routing Messages to a Transport)*

**Question 16 : B** — « You can also create your own transport if you need to send or receive messages from something that is not supported. See `/messenger/custom-transport`. » *(§ Creating your Own Transport)*

**Question 17 : B** — « it's better to pass the entity's primary key (or whatever relevant information the handler actually needs, like `email`) instead of the object. » *(§ Doctrine Entities in Messages)*

**Question 18 : B** — « otherwise you might see errors related to the Entity Manager (…) This guarantees the entity contains fresh data. » *(§ Doctrine Entities in Messages)*

**Question 19 : A** — « A message class defines the **contract** between the code that dispatches the message and the worker that handles it. (…) some messages may still be pending in the queue when you deploy a new version (…) those older messages may no longer deserialize correctly. » *(§ Versioning Message Classes)*

**Question 20 : A** — « For minor changes, keep backward compatibility by making new constructor arguments optional and providing a sensible default value. » *(§ Versioning Message Classes)*

**Question 21 : A, B, C** — « Keep the property temporarily (…) until all old messages have been processed. Add the `#[\AllowDynamicProperties]` attribute (…). Implement custom serialization logic. » *(§ Versioning Message Classes)*

**Question 22 : A** — « create a **new version of the message class** instead of modifying the existing one (…) During deployment, both versions may need to coexist temporarily. » *(§ Versioning Message Classes)*

**Question 23 : B** — « Removing the old class too early can cause workers to fail when they attempt to deserialize messages that were dispatched before the deployment. » *(§ Versioning Message Classes)*

**Question 24 : A** — « by creating a `sync` transport and "sending" messages there to be handled immediately » : `sync: 'sync://'`. *(§ Handling Messages Synchronously)*

**Question 25 : A** — « You can do this with the `messenger:consume` command: `$ php bin/console messenger:consume async` » *(§ Consuming Messages (Running the Worker))*

**Question 26 : A** — « you can use the command with the `--all` option (…) The `--exclude-receivers` option can only be used together with `--all`. Also, you cannot exclude all receivers. » *(§ Consuming Messages (Running the Worker))*

**Question 27 : A** — « use the `--keepalive` command option to specify an interval (…) default value = `5` (…) This option is only available for the following transports: Beanstalkd, AmazonSQS, Doctrine and Redis. » *(§ Consuming Messages (Running the Worker))*

**Question 28 : A** — « To properly stop a worker, throw an instance of `StopWorkerException`. » *(§ Consuming Messages (Running the Worker))*

**Question 29 : A, B, C** — « Some services (like Doctrine's `EntityManager`) will consume more memory over time. (…) use a flag like `messenger:consume --limit=10` (…) There are also other options like `--memory-limit=128M` and `--time-limit=3600`. » *(§ Deploying to Production)*

**Question 30 : A** — « run `messenger:stop-workers` (…) The command uses the app cache internally. If your application runs on multiple hosts, configure the app cache to use a shared adapter. » *(§ Deploying to Production)*

**Question 31 : A** — « a rolling restart of the worker `Deployment` achieves the same result, but only if `terminationGracePeriodSeconds` is long enough for the longest-running handler to complete (…) `SIGKILL` does not give workers a chance to finish the current message. » *(§ Deploying to Production)*

**Question 32 : A** — « you should set a value for the `cache.prefix_seed` configuration option in order to use the same cache namespace between deployments. » *(§ Deploying to Production)*

**Question 33 : B** — « When multiple message types share the same transport, a slow or failing handler for one type can delay all others in the same queue. » *(§ Prioritized Transports)*

**Question 34 : A** — « The worker will always first look for messages waiting on `async_priority_high`. If there are none, *then* it will consume messages from `async_priority_low`. » *(§ Prioritized Transports)*

**Question 35 : A** — « You can limit the worker to only process messages from specific queue(s) (…) To allow using the `queues` option, the receiver must implement `QueueReceiverInterface`. » *(§ Limit Consuming to Specific Queues)*

**Question 36 : A** — « Run the `messenger:stats` command (…) the configured transport's receiver must implement `MessageCountAwareInterface`. » *(§ Checking the Number of Queued Messages Per Transport)*

**Question 37 : A** — « Supervisor will try `startretries` number of times to restart the command. (…) avoid getting the command in a FATAL state, which will never restart again. Each restart, Supervisor increases the delay by 1 second. » *(§ Supervisor Configuration)*

**Question 38 : A** — « each worker needs a unique consumer name to avoid the same message being handled by multiple workers. One way to achieve this is to set an environment variable in the Supervisor configuration file. » *(§ Supervisor Configuration)*

**Question 39 : A** — « If you install the PCNTL PHP extension (…) workers will handle the `SIGTERM` or `SIGINT` POSIX signals to finish processing their current message (…) override default ones by setting the `framework.messenger.stop_worker_on_signals` configuration option. » *(§ Graceful Shutdown)*

**Question 40 : A** — « Systemd has become the standard (…) and has a good alternative called *user services* » — pas besoin d'accès système. *(§ Systemd Configuration)*

**Question 41 : A** — « it's common for workers to process messages sequentially in long-running CLI processes (…) Symfony will inject the same instance of a service in all messages, preserving the internal state of the services. » *(§ Stateless Worker)*

**Question 42 : A** — « the service must implement `ResetInterface` where you can reset the properties in the `reset()` method. If you don't want to reset the container, add the `--no-reset` option. » *(§ Stateless Worker)*

**Question 43 : A** — « you can configure a rate limiter on a transport (requires the RateLimiter component) by setting its `rate_limiter` option. (…) it will block the whole worker when the limit is hit. » *(§ Rate Limited Transport)*

**Question 44 : A** — « If an exception is thrown while consuming a message from a transport it will automatically be re-sent to the transport to be tried again. By default, a message will be retried 3 times. » *(§ Retries & Failures)*

**Question 45 : A, B, C** — options `max_retries`, `delay`, `multiplier`, `max_delay`, `jitter` (« randomness factor (…) to prevent multiple failed messages from being retried simultaneously »). *(§ Retries & Failures)*

**Question 46 : A** — « Symfony triggers a `WorkerMessageRetriedEvent` when a message is retried (…) the serialized form of the message is saved, which prevents to serialize it again if the message is later retried. » *(§ Retries & Failures)*

**Question 47 : A** — « If you throw `UnrecoverableMessageHandlingException`, the message will not be retried. (…) Messages that will not be retried, will still show up in the configured failure transport. » *(§ Avoiding Retrying)*

**Question 48 : A** — « If you throw `RecoverableMessageHandlingException`, the message will always be retried infinitely and `max_retries` setting will be ignored. You can define a custom retry delay (…) by setting the `retryDelay` argument. » *(§ Forcing Retrying)*

**Question 49 : A** — « To avoid this happening, you can instead configure a `failure_transport`. » *(§ Saving & Retrying Failed Messages)*

**Question 50 : A, B, C** — `messenger:failed:show`, `messenger:failed:retry` (« this command asks whether to retry, skip, or delete »), `messenger:failed:remove`. *(§ Saving & Retrying Failed Messages)*

**Question 51 : B** — « you can override the failure transport for only specific transports » via l'option `failure_transport` définie au niveau du transport. *(§ Multiple Failed Transports)*

**Question 52 : A** — « a worker may process a message successfully but crash before acknowledging it to the transport. In that case, the transport will redeliver the message. » *(§ Writing Idempotent Handlers)*

**Question 53 : A** — « The key should be derived from the business event, not generated at dispatch time, so that any redelivery of the same logical event uses the same key. » *(§ Writing Idempotent Handlers)*

**Question 54 : A** — « A UUID generated at dispatch time is not suitable as an idempotency key. If the same business event is dispatched twice (…) each dispatch generates a different UUID and both executions will proceed. » *(§ Writing Idempotent Handlers)*

**Question 55 : A** — « Options defined under `options` take precedence over ones defined in the DSN. » *(§ Transport Configuration)*

**Question 56 : A** — « `$ composer require symfony/amqp-messenger` (…) that can be disabled, but some functionality may not work correctly (like delayed queues). » *(§ AMQP Transport)*

**Question 57 : A** — « this transport does not rely on `\AmqpQueue::consume()` which is blocking (…) the worker's stop logic cannot be reached if it is stuck in a blocking call. » *(§ AMQP Transport)*

**Question 58 : A** — « you can also configure AMQP-specific settings on your message by adding `AmqpStamp` to your Envelope. » *(§ AMQP Transport)*

**Question 59 : A** — « `$ composer require symfony/doctrine-messenger` (…) The transport will automatically create a table named `messenger_messages`. » *(§ Doctrine Transport)*

**Question 60 : A** — « in production you may prefer to set `auto_setup` to `false` (…) generate a migration and create the table explicitly (…) Set `redeliver_timeout` to a greater value than your longest message duration. » *(§ Doctrine Transport)*

**Question 61 : A** — « When using PostgreSQL, you have access to (…) the LISTEN/NOTIFY feature (…) `use_notify` (default: `true`) — Whether to use LISTEN/NOTIFY. » *(§ Doctrine Transport)*

**Question 62 : A** — « pass a number to specify the priority (default = `1024`; lower numbers mean higher priority). » *(§ Beanstalkd Transport)*

**Question 63 : A** — « The Beanstalkd transport supports the `--keepalive` option by using Beanstalkd's `touch` command to periodically reset the job's `ttr`. » *(§ Beanstalkd Transport)*

**Question 64 : A** — « The Redis transport uses streams to queue messages. This transport requires the Redis PHP extension (>=4.3) and a running Redis server (^5.0). » *(§ Redis Transport)*

**Question 65 : A** — « There should never be more than one `messenger:consume` command running with the same combination of `stream`, `group` and `consumer`, or messages could end up being handled more than once. » *(§ Redis Transport)*

**Question 66 : A, B** — « Set `delete_after_ack` to `true` (if you use a single group) or define `stream_max_entries` (…) to avoid memory leaks. » *(§ Redis Transport)*

**Question 67 : A** — « The Redis transport supports the `--keepalive` option by using Redis's `XCLAIM` command to periodically reset the message's idle time to zero. » *(§ Redis Transport)*

**Question 68 : A** — « The `in-memory` transport does not actually deliver messages. Instead, it holds them in memory during the request (…) you can check that exactly one message was sent during a request. » *(§ In Memory Transport)*

**Question 69 : A** — « All `in-memory` transports will be reset automatically after each test in test classes extending `KernelTestCase` or `WebTestCase`. » *(§ In Memory Transport)*

**Question 70 : A, B** — « First, test handlers as plain PHP classes by injecting mocks and calling `__invoke()` directly, without any Messenger infrastructure. (…) use the `in-memory://` transport in functional tests to verify that the correct message is dispatched to the expected transport. » *(§ In Memory Transport)*

**Question 71 : A** — « `$ composer require symfony/amazon-sqs-messenger` (…) The transport will automatically create queues that are needed. This can be disabled by setting the `auto_setup` option to `false`. » *(§ Amazon SQS)*

**Question 72 : A** — « The `wait_time` parameter defines the maximum duration Amazon SQS should wait until a message is available (…) The `poll_timeout` parameter defines the duration the receiver should wait before returning null. » *(§ Amazon SQS)*

**Question 73 : A** — « If the queue name is suffixed by `.fifo`, AWS will create a FIFO queue. Use the stamp `AmazonSqsFifoStamp` (…) Another possibility is to enable the `AddFifoStampMiddleware`. » *(§ Amazon SQS)*

**Question 74 : B** — « AWS SQS message deduplication is time-based, not queue-based. Once a Message deduplication ID has been used, SQS rejects any message sent with the same ID for the next 5 minutes, regardless of whether the original message has already been consumed. » *(§ Amazon SQS)*

**Question 75 : A** — « The SQS transport supports the `--keepalive` option by using the `ChangeMessageVisibility` action to periodically update the `VisibilityTimeout` of the message. » *(§ Amazon SQS)*

**Question 76 : A** — « they're serialized using PHP's native `serialize()` & `unserialize()` functions. You can change this globally (or for each transport) to a service that implements `SerializerInterface`. » *(§ Serializing Messages)*

**Question 77 : A** — « you can control the context on a case-by-case basis via the `SerializerStamp`. » *(§ Serializing Messages)*

**Question 78 : A** — « This interface is implemented by the following transports: AmazonSqs, Amqp, and Redis. » *(§ Closing Connections)*

**Question 79 : A** — « It is possible to trigger any command by dispatching a `RunCommandMessage`. » *(§ Trigger a Command)*

**Question 80 : A** — « you can use the `throwOnFailure` and `catchExceptions` parameters when creating your instance of `RunCommandMessage`. » *(§ Trigger a Command)*

**Question 81 : A** — « Once handled, the handler will return a `RunCommandContext` which contains many useful information such as the exit code or the output of the process. » *(§ Trigger a Command)*

**Question 82 : A** — « If you want to use shell features such as redirections or pipes, use the static `RunProcessMessage::fromShellCommandline` factory method. » *(§ Trigger An External Process)*

**Question 83 : A** — « This is particularly important for handlers that execute commands or processes, which is why the `RunProcessHandler` has message signing **enabled by default**. » *(§ Securing Messages with Signatures)*

**Question 84 : A** — « set the `sign` option to `true` (…) Messages are signed using an HMAC signature computed with your application's secret key (`kernel.secret` parameter). » *(§ Enabling Message Signing)*

**Question 85 : A** — « If the signature is missing or invalid, an `InvalidMessageSignatureException` is thrown, and the message will not be handled. » *(§ Enabling Message Signing)*

**Question 86 : A** — « dispatching a `PingWebhookMessage` (…) The handler will return a `ResponseInterface`. » *(§ Pinging A Webservice)*

**Question 87 : A** — « the `HandleMessageMiddleware` adds a `HandledStamp` (…) `$handledStamp = $envelope->last(HandledStamp::class); $handledStamp->getResult();` » *(§ Getting Results from your Handlers)*

**Question 88 : A** — « A `HandleTrait` exists to get the result of the handler when processing synchronously. It also ensures that exactly one handler is registered. » *(§ Getting Results when Working with Command & Query Buses)*

**Question 89 : A** — « The `HandleTrait` can be used in any class that has a `$messageBus` property. » *(§ Getting Results when Working with Command & Query Buses)*

**Question 90 : B** — « You can also add new stamps when handling a message; they will be appended to the existing ones. » *(§ Getting Results when Working with Command & Query Buses)*

**Question 91 : A, B, C** — options `bus`, `from_transport`, `handles`, `method`, et « `priority` — Defines the order in which the handler is executed when multiple handlers can process the same message. » *(§ Manually Configuring Handlers)*

**Question 92 : A** — « Handlers with a higher priority run first, and each handler starts only after the previous one has fully completed. » *(§ Manually Configuring Handlers)*

**Question 93 : A** — « A single handler class can handle multiple messages. For that add the `#AsMessageHandler` attribute to all the handling methods. » *(§ Handling Multiple Messages)*

**Question 94 : A** — « If using the `DoctrineTransactionMiddleware` and a dispatched message throws an exception, then any database transactions in the original handler will be rolled back. » *(§ Transactional Messages)*

**Question 95 : A** — « This can be done by using the `DispatchAfterCurrentBusMiddleware` and adding a `DispatchAfterCurrentBusStamp` stamp to the message Envelope. » *(§ DispatchAfterCurrentBusMiddleware Middleware)*

**Question 96 : A** — « The `dispatch_after_current_bus` middleware is enabled by default. (…) be sure to register `dispatch_after_current_bus` before `doctrine_transaction` (…) must be loaded for *all* of the buses being used. » *(§ DispatchAfterCurrentBusMiddleware Middleware)*

**Question 97 : A** — « that exception will be wrapped into a `DelayedMessageHandlingException`. Using `DelayedMessageHandlingException::getWrappedExceptions` will give you all exceptions. » *(§ DispatchAfterCurrentBusMiddleware Middleware)*

**Question 98 : A** — « add the `from_transport` option to each handler. (…) If a handler does *not* have `from_transport` config, it will be executed on *every* transport that the message is received from. » *(§ Binding Handlers to Different Transports)*

**Question 99 : A** — « To create a batch handler, implement `BatchHandlerInterface` and use `BatchHandlerTrait`. » *(§ Process Messages by Batches)*

**Question 100 : A** — « By default, batches are processed in groups of `10` messages. Override the `getBatchSize()` method to change this. » *(§ Process Messages by Batches)*

**Question 101 : A** — « By default, pending batches are flushed when the worker is idle as well as when it is stopped. » *(§ Process Messages by Batches)*

**Question 102 : A** — « each message is wrapped in an `Envelope`, which holds the message and stamps. (…) they're used internally to track information about a message. » *(§ Envelopes & Stamps)*

**Question 103 : B** — « Symfony doesn't inject the `Envelope` automatically when you add it as an argument of the `__invoke()` method (…) you can create the following custom middleware to stamp the envelope (…) with a `HandlerArgumentsStamp`. » *(§ Envelopes & Stamps)*

**Question 104 : A** — « Messages can define their own default stamps when dispatched by implementing `DefaultStampsProviderInterface`. » *(§ Default Stamps on Messages)*

**Question 105 : A** — « When dispatching the message, default stamps are added only if no other stamp of the same class already exists on the envelope (…) the explicit `DelayStamp(500)` overrides the default one. » *(§ Default Stamps on Messages)*

**Question 106 : A** — liste ordonnée : « `add_bus_name_stamp_middleware` (…) `dispatch_after_current_bus` (…) `failed_message_processing_middleware` (…) Your own collection of middleware (…) `send_message` (…) `handle_message`. » *(§ Middleware)*

**Question 107 : A** — « `send_message` - if routing is configured for the transport, this sends messages to that transport and stops the middleware chain. » *(§ Middleware)*

**Question 108 : B** — « The middleware are executed when the message is dispatched but *also* again when a message is received via the worker. » *(§ Middleware)*

**Question 109 : A** — « you can add your own middleware to this list, or completely disable the default middleware and *only* include your own » via `default_middleware: false`. *(§ Middleware)*

**Question 110 : A** — « This behavior is enabled by adding a `DeduplicateStamp` to the message envelope. » *(§ Message Deduplication)*

**Question 111 : A** — « The deduplication key is a **business-level choice** (…) If you want deduplication only while the message is queued, set the third argument to `true` (…) the lock is released as soon as the worker receives the message. » *(§ Message Deduplication)*

**Question 112 : A** — « This middleware is automatically enabled when the Lock component is installed. » *(§ Message Deduplication)*

**Question 113 : A** — « wraps all handlers in a single Doctrine transaction — handlers do not need to call `flush()` and an error in any handler will cause a rollback. » *(§ Middleware for Doctrine)*

**Question 114 : A** — « each time a message is handled, the Doctrine connection is "pinged" and reconnected if it's closed (…) After handling, the Doctrine connection is closed, which can free up database connections in a worker. » *(§ Middleware for Doctrine)*

**Question 115 : A** — « Add the `router_context` middleware if you need to generate absolute URLs in the consumer (…) Add the `validation` middleware if you need to validate the message object (…) If validation fails, a `ValidationFailedException` will be thrown. » *(§ Other Middlewares)*

**Question 116 : B** — « The `MessageSentToTransportsEvent` event is dispatched **only** after a message was sent to at least one transport. If the message was sent to multiple transports, the event is dispatched only once. » *(§ Messenger Events)*

**Question 117 : A, B, C** — `WorkerStartedEvent`, `WorkerStoppedEvent`, `WorkerRunningEvent` (vs. `WorkerMessageHandledEvent`, propre au traitement d'un message précis). *(§ Messenger Events)*

**Question 118 : A** — « It's possible to have messenger pass additional data to the message handler using the `HandlerArgumentsStamp`. Add this stamp to the envelope in a middleware. » *(§ Additional Handler Arguments)*

**Question 119 : A** — « Not all applications will return a JSON message with `body` and `headers` fields. In those cases, you'll need to create a new message serializer. » *(§ Message Serializer For Custom Data Formats)*

**Question 120 : A** — « Messenger gives you a single message bus service by default. But, you can configure as many as you want. » *(§ Multiple Buses, Command & Event Buses)*

**Question 121 : B** — « A single bus is a **good default**. Add another bus only when you need a different middleware stack, not because an architecture pattern suggests it. » *(§ Multiple Buses, Command & Event Buses)*

**Question 122 : A** — « `default_bus: command.bus` — The bus that is going to be injected when injecting `MessageBusInterface`. » *(§ Multiple Buses, Command & Event Buses)*

**Question 123 : A** — « set "allow_no_handlers" to true (…) to allow having no handler configured for this bus without throwing an exception (…) set "allow_no_senders" (…) to throw an exception if no sender is configured. » *(§ Multiple Buses, Command & Event Buses)*

**Question 124 : A** — « you can restrict each handler to a specific bus using the `messenger.message_handler` tag » — option `bus`. *(§ Restrict Handlers per Bus)*

**Question 125 : A** — « You can also automatically add this tag to a number of classes by using the `_instanceof` service configuration. Using this, you can determine the message bus based on an implemented interface. » *(§ Restrict Handlers per Bus)*

**Question 126 : A** — « The `debug:messenger` command lists available messages & handlers per bus. You can also restrict the list to a specific bus by providing its name as an argument. » *(§ Debugging the Buses)*

**Question 127 : A** — « create a new `RedispatchMessage` and dispatch it through your bus (…) The built-in `RedispatchMessageHandler` will take care of this message to redispatch it through the same bus it was dispatched at first. » *(§ Redispatching a Message)*

**Question 128 : B** — « You can also use the second argument of the `RedispatchMessage` constructor to provide transports to use when redispatching the message. » *(§ Redispatching a Message)*

**Question 129 : A** — « The transport object needs to implement the `TransportInterface` (which combines the `SenderInterface` and `ReceiverInterface`). » *(Custom Transport — § Creating your Transport Factory)*

**Question 130 : A** — « `public function createTransport(string $dsn, array $options, SerializerInterface $serializer): TransportInterface` » et « `public function supports(string $dsn, array $options): bool` ». *(Custom Transport — § Create your Transport Factory)*

**Question 131 : A** — « `return 0 === strpos($dsn, 'my-transport://');` » *(Custom Transport — § Create your Transport Factory)*

**Question 132 : A** — « If you're using the default services.yaml configuration, this is already done for you, thanks to autoconfiguration. » *(Custom Transport — § Register your Factory)*

**Question 133 : A** — « Otherwise, add the following: (…) `tags: [messenger.transport_factory]` » *(Custom Transport — § Register your Factory)*

**Question 134 : A** — « Within the `framework.messenger.transports.*` configuration, create your named transport using your own DSN: `yours: 'my-transport://...'` » *(Custom Transport — § Use your Transport)*

**Question 135 : A** — « this will give you access to the following services: `messenger.sender.yours`: the sender; `messenger.receiver.yours`: the receiver. » *(Custom Transport — § Use your Transport)*

**Question 136 : A** — « For real implementations see `Symfony\Component\Messenger\Transport\InMemory\InMemoryTransport` and `Symfony\Component\Messenger\Bridge\Doctrine\Transport\DoctrineReceiver`. » *(Custom Transport — § Create your Transport Factory)*

## Pour aller plus loin

Une seule page dans la section [Learn more](https://symfony.com/doc/8.0/messenger.html#learn-more) de la page :

- [How to Create your own Messenger Transport](https://symfony.com/doc/8.0/messenger/custom-transport.html) — questions 129 à 136
