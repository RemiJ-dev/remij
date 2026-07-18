# QCM — Les notifications (Notifier)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/notifier.html](https://symfony.com/doc/8.0/notifier.html) · **Généré le :** 22 juillet 2026
>
> **39 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et canaux

### Question 1

Quelle commande installe le composant Notifier ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/notifications`
- [ ] **B.** `composer require symfony/notifier`
- [ ] **C.** Il est installé par défaut avec `symfony/mailer`
- [ ] **D.** `composer require symfony/alert`

### Question 2

Qu'est-ce que le composant Notifier propose, conceptuellement ? *(une seule bonne réponse)*

- [ ] **A.** Un service de templating dédié aux notifications HTML
- [ ] **B.** Un simple remplaçant du composant Mailer, limité aux emails
- [ ] **C.** Une abstraction au-dessus de multiples canaux (SMS, Slack, email, push…), avec une façon dynamique de gérer l'envoi des messages
- [ ] **D.** Un client HTTP générique sans lien avec les canaux de notification

### Question 3

Quels canaux le composant Notifier supporte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** SMS et Chat (Slack, Telegram…)
- [ ] **B.** Email et Browser (messages flash)
- [ ] **C.** Push et Desktop
- [ ] **D.** FTP, comme canal de diffusion de fichiers

## Le canal SMS

### Question 4

Quelles classes le canal SMS utilise-t-il pour envoyer des SMS, et que faut-il faire au préalable ? *(une seule bonne réponse)*

- [ ] **A.** Des classes `Texter`, mais uniquement via le composant Mailer sous-jacent
- [ ] **B.** Des classes `Chatter` ; aucune souscription tierce n'est nécessaire
- [ ] **C.** Les SMS sont envoyés directement via le composant HttpClient, sans classe dédiée
- [ ] **D.** Des classes `Texter` ; il faut souscrire à un service tiers d'envoi de SMS

### Question 5

Comment activer un texter, une fois le bridge du fournisseur installé et le DSN placé dans `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune configuration n'est nécessaire, le DSN dans `.env` suffit
- [ ] **B.** En le configurant sous la clé `sms_providers` de `framework.notifier`
- [ ] **C.** En le configurant sous la clé `texter_transports` de `framework.notifier`
- [ ] **D.** En l'ajoutant à `framework.mailer.transports`

### Question 6

Comment envoyer un SMS via `TexterInterface`, et quels arguments accepte `SmsMessage` ? *(une seule bonne réponse)*

- [ ] **A.** `new SmsMessage($message)` uniquement, le numéro de téléphone étant toujours défini au niveau du transport
- [ ] **B.** `new SmsMessage($phone, $message, $from, $options)` ; le `$from` et les `$options` sont optionnels, `$from` surchargeant celui défini par défaut sur le transport
- [ ] **C.** `$texter->sendSms($phone, $message)`, une méthode dédiée distincte de `send()`
- [ ] **D.** `new SmsMessage($phone, $message)`, sans possibilité de surcharger le `from` ni de passer d'options

### Question 7

Que retourne la méthode `send()` d'un `Texter`, et quelles informations expose cet objet ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne contenant uniquement l'identifiant du message, sans autre métadonnée
- [ ] **B.** Un simple booléen indiquant le succès ou l'échec de l'envoi
- [ ] **C.** Rien, `send()` ne retourne jamais de valeur exploitable
- [ ] **D.** Un `SentMessage`, qui fournit notamment l'identifiant du message et le contenu du message d'origine

### Question 8

Que faut-il faire si une valeur du DSN d'un texter contient un caractère spécial d'URI ? *(une seule bonne réponse)*

- [ ] **A.** L'encoder, par exemple via `urlencode()`
- [ ] **B.** Rien, ces caractères sont automatiquement échappés par Symfony
- [ ] **C.** Utiliser un fichier de configuration séparé pour ce champ
- [ ] **D.** Ce n'est jamais autorisé, il faut changer la valeur du champ concerné

## Le canal Chat

### Question 9

Quelles classes le canal Chat utilise-t-il pour envoyer des messages aux services de discussion ? *(une seule bonne réponse)*

- [ ] **A.** Une classe unique `ChatMessenger`, commune à tous les fournisseurs
- [ ] **B.** Des classes `Texter`, les mêmes que pour le canal SMS
- [ ] **C.** Des classes `Chatter`
- [ ] **D.** Le canal Chat n'a pas de classe dédiée, il réutilise directement `MailerInterface`

### Question 10

Si aucun transport n'est explicitement défini sur un `ChatMessage`, lequel est utilisé par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Le transport nommé `default`, quel que soit l'ordre de configuration
- [ ] **B.** Le dernier transport de chat configuré
- [ ] **C.** Une exception est levée, un transport devant toujours être explicite
- [ ] **D.** Le premier transport de chat configuré

### Question 11

Comment configure-t-on les transports de chat (chatters) ? *(une seule bonne réponse)*

- [ ] **A.** Via la clé `texter_transports`, partagée avec les SMS
- [ ] **B.** Via la clé `chatter_transports` de `framework.notifier`
- [ ] **C.** Via la clé `chat_providers`
- [ ] **D.** Uniquement en PHP, aucune configuration YAML n'étant possible

## Intégration avec Messenger

### Question 12

Par défaut, si le composant Messenger est installé, comment les notifications sont-elles envoyées, et quel risque cela comporte-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Elles sont automatiquement envoyées de façon synchrone dès qu'un consommateur Messenger existe ailleurs dans l'application, même arrêté
- [ ] **B.** Elles sont toujours envoyées directement, Messenger n'ayant aucun effet sur le Notifier
- [ ] **C.** Elles sont mises en cache jusqu'à ce qu'un consommateur les traite, sans jamais être perdues
- [ ] **D.** Elles sont envoyées via le bus de messages (MessageBus) ; si aucun consommateur de messages ne tourne, les messages ne seront jamais envoyés

### Question 13

Comment forcer l'envoi des notifications directement via le transport, sans passer par le bus Messenger ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant l'option `--sync` à chaque appel `send()`
- [ ] **B.** En désinstallant complètement le composant Messenger
- [ ] **C.** En configurant `framework.notifier.message_bus: false`
- [ ] **D.** Ce n'est pas configurable, Messenger prend systématiquement le contrôle dès qu'il est installé

### Question 14

Quand Messenger est activé, chaque canal (email, SMS, chat…) dispatche-t-il un seul message global ou un message indépendant par canal ? Quelle conséquence cela a-t-il en cas d'échec ? *(une seule bonne réponse)*

- [ ] **A.** Un seul message global est dispatché pour tous les canaux ; si un canal échoue, tous les canaux sont retentés ensemble
- [ ] **B.** Chaque canal dispatche son propre message indépendamment ; si un canal échoue et qu'un transport d'échec est configuré, seul ce canal sera retenté, pas les autres
- [ ] **C.** Chaque canal dispatche son propre message, mais aucun n'est jamais retenté en cas d'échec, quelle que soit la configuration
- [ ] **D.** Cela dépend uniquement du canal email, les autres canaux n'étant jamais dispatchés via Messenger

## Le canal Email

### Question 15

Sur quoi repose le canal Email, et quelles dépendances supplémentaires faut-il installer ? *(une seule bonne réponse)*

- [ ] **A.** Sur le composant Messenger uniquement, sans lien avec Mailer
- [ ] **B.** Sur une implémentation SMTP indépendante du composant Mailer
- [ ] **C.** Sur le composant Mailer seul, sans dépendance Twig supplémentaire
- [ ] **D.** Sur le composant Mailer et une classe spéciale `NotificationEmail` ; il faut installer le bridge Twig ainsi que les extensions Twig Inky et CSS Inliner

### Question 16

Comment définir l'adresse d'expéditeur par défaut utilisée pour les emails de notification ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.mailer.envelope.sender`, comme pour n'importe quel email Mailer classique
- [ ] **B.** Via une option dédiée `framework.notifier.default_from`
- [ ] **C.** Ce n'est pas configurable, l'expéditeur est toujours l'adresse du serveur SMTP
- [ ] **D.** Uniquement en surchargeant `NotificationEmail::getFrom()`

## Les canaux Push et Desktop

### Question 17

Quelles classes le canal Push utilise-t-il pour envoyer des notifications aux téléphones et navigateurs ? *(une seule bonne réponse)*

- [ ] **A.** Des classes `Chatter`, comme pour le canal Chat
- [ ] **B.** Des classes `Pusher`, dédiées à ce seul canal
- [ ] **C.** Des classes `Texter`, comme pour le canal SMS
- [ ] **D.** Une classe unique `PushNotifier`, indépendante du reste du composant

### Question 18

À quoi sert le canal Desktop, et via quelles classes est-il implémenté ? *(une seule bonne réponse)*

- [ ] **A.** À envoyer des notifications à des applications de bureau distantes via HTTP
- [ ] **B.** À afficher des notifications de bureau locales sur la même machine hôte, via des classes `Texter`
- [ ] **C.** À afficher des notifications dans le navigateur de l'utilisateur final
- [ ] **D.** Il s'agit d'un simple alias du canal Push, sans différence réelle

### Question 19

Comment envoyer une notification de bureau personnalisée, avec par exemple une icône et un son particuliers (via le fournisseur JoliNotif) ? *(une seule bonne réponse)*

- [ ] **A.** Via un objet `DesktopOptions` générique, commun à tous les fournisseurs de bureau
- [ ] **B.** Ce n'est pas possible, les notifications de bureau ne supportent aucune personnalisation
- [ ] **C.** En configurant l'icône et le son globalement dans `notifier.yaml`, sans possibilité de les définir par message
- [ ] **D.** En passant un objet `JoliNotifOptions` (avec `setIconPath()`, `setExtraOption()`…) en dernier argument de `DesktopMessage`

## Transports en cascade : failover et round-robin

### Question 20

Comment configurer un transport de secours (failover), pour utiliser Telegram si Slack échoue ? *(une seule bonne réponse)*

- [ ] **A.** En déclarant deux transports séparés et en les routant manuellement à chaque envoi
- [ ] **B.** En combinant les deux DSN avec `&&`
- [ ] **C.** En combinant les deux DSN avec `||`, par exemple `'%env(SLACK_DSN)% || %env(TELEGRAM_DSN)%'`
- [ ] **D.** Le failover n'est pas supporté par le Notifier, contrairement au Mailer

### Question 21

Que fait la syntaxe `&&` entre deux DSN de transports de chat, par exemple `'%env(SLACK_DSN)% && %env(TELEGRAM_DSN)%'` ? *(une seule bonne réponse)*

- [ ] **A.** Elle envoie chaque notification au prochain transport programmé, selon une logique de répartition round-robin
- [ ] **B.** Elle envoie systématiquement la notification aux deux transports simultanément
- [ ] **C.** Elle désactive le second transport tant que le premier fonctionne
- [ ] **D.** Elle n'a aucun effet particulier, `&&` étant un simple séparateur visuel

## Créer et envoyer des notifications

### Question 22

Comment envoyer une notification à un destinataire, via quel service et quelle méthode ? *(une seule bonne réponse)*

- [ ] **A.** En injectant `MailerInterface`, le Notifier s'appuyant toujours sur Mailer en interne
- [ ] **B.** En autowirant directement `Chatter` ou `Texter`, `NotifierInterface` n'existant pas
- [ ] **C.** En appelant une méthode statique `Notification::sendTo($recipient)`
- [ ] **D.** En autowirant `NotifierInterface` (service `notifier`) et en appelant `send(Notification $notification, Recipient $recipient)`

### Question 23

Comment construit-on une `Notification`, et à quoi sert le second argument du constructeur ? *(une seule bonne réponse)*

- [ ] **A.** `new Notification($subject, $recipient)` ; le second argument est directement le destinataire
- [ ] **B.** `new Notification($subject, $channels)` ; `$channels` (ex. `['email', 'sms']`) précise le(s) canal(aux)/transport(s) à utiliser pour l'envoi
- [ ] **C.** `new Notification($channels)` uniquement, le sujet étant défini séparément via `subject()`
- [ ] **D.** `new Notification($subject)` uniquement, les canaux étant toujours déduits automatiquement du type de destinataire

### Question 24

Quelles méthodes une `Notification` propose-t-elle pour définir son contenu et son icône ? *(une seule bonne réponse)*

- [ ] **A.** `setContent()` et `setEmoji()`
- [ ] **B.** `body()` et `icon()`
- [ ] **C.** `content()` et `emoji()`
- [ ] **D.** `text()` et `pictogram()`

### Question 25

Quelle est la différence entre `NoRecipient` et `Recipient` ? *(une seule bonne réponse)*

- [ ] **A.** Les deux classes sont strictement interchangeables, sans différence de comportement
- [ ] **B.** `NoRecipient` est réservé aux tests, jamais utilisé en production
- [ ] **C.** `Recipient` ne peut contenir qu'une adresse email, jamais de numéro de téléphone
- [ ] **D.** `NoRecipient` est le destinataire par défaut, utile quand aucune information sur le destinataire n'est nécessaire (ex. canal browser, qui utilise le flashbag de la session courante) ; `Recipient` peut porter à la fois l'email et le numéro de téléphone

## Politiques de canal (Channel Policies)

### Question 26

Plutôt que de spécifier les canaux à chaque création de notification, comment les faire dépendre d'un niveau d'importance ? *(une seule bonne réponse)*

- [ ] **A.** En créant une sous-classe de `Notification` par niveau d'importance, sans configuration centrale possible
- [ ] **B.** Via la configuration `channel_policy`, associant chaque niveau d'importance (`urgent`, `high`, `medium`, `low`) à une liste de canaux
- [ ] **C.** Via l'option `importance_routing` de `framework.notifier`
- [ ] **D.** Ce n'est pas possible, les canaux doivent toujours être précisés explicitement à la création

### Question 27

Une fois `channel_policy` configuré, comment définir l'importance d'une notification pour qu'elle utilise la politique correspondante ? *(une seule bonne réponse)*

- [ ] **A.** Via une propriété publique `$notification->importance` assignée directement
- [ ] **B.** En passant l'importance en troisième argument de `$notifier->send()`
- [ ] **C.** Via `->importance(Notification::IMPORTANCE_HIGH)` sur l'objet `Notification`
- [ ] **D.** En créant un `Recipient` distinct par niveau d'importance

### Question 28

Dans la configuration `channel_policy` de l'exemple, la clé `high` référence `['chat/slack']` — que signifie ce format `chat/slack` ? *(une seule bonne réponse)*

- [ ] **A.** Le canal `chat` combiné obligatoirement à un second canal `slack` distinct
- [ ] **B.** Une simple convention de nommage sans effet, équivalente à `chat`
- [ ] **C.** Il s'agit d'un chemin de fichier de configuration à charger
- [ ] **D.** Le canal `chat`, restreint spécifiquement au transport nommé `slack`

## Personnaliser les notifications

### Question 29

Comment personnaliser dynamiquement les canaux utilisés selon le destinataire ou le contenu de la notification (ex. SMS uniquement si le montant dépasse un seuil et que le destinataire a un téléphone) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, les canaux sont toujours figés à la création de l'objet
- [ ] **B.** En sous-classant `Notification` et en surchargeant sa méthode `getChannels(RecipientInterface $recipient)`
- [ ] **C.** En créant un `EventSubscriber` sur `MessageEvent`, seule méthode possible
- [ ] **D.** En surchargeant la méthode `send()` du service `notifier` lui-même

### Question 30

Comment personnaliser le contenu d'une notification spécifiquement lorsqu'elle est envoyée via Slack, sans affecter les autres canaux ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible qu'en configuration YAML, jamais en PHP
- [ ] **B.** En créant une classe `SlackNotification` totalement distincte de `Notification`
- [ ] **C.** En implémentant `ChatNotificationInterface` sur la sous-classe de `Notification`, et sa méthode `asChatMessage(RecipientInterface $recipient, ?string $transport = null)`, en vérifiant `$transport`
- [ ] **D.** En modifiant directement le service `chatter.slack`

### Question 31

Si la méthode `asChatMessage()` d'une notification retourne `null`, que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Le message est envoyé vide, sans sujet ni contenu
- [ ] **B.** Aucun message n'est envoyé du tout sur ce canal
- [ ] **C.** Une exception `LogicException` est levée
- [ ] **D.** Le Notifier construit le `ChatMessage` comme il l'aurait fait sans cette méthode (comportement par défaut)

### Question 32

En plus de `ChatNotificationInterface`, quelles autres interfaces existent pour personnaliser un message selon son canal ? *(plusieurs bonnes réponses)*

- [ ] **A.** `BrowserNotificationInterface`, pour personnaliser les messages flash
- [ ] **B.** `WebhookNotificationInterface`, pour les callbacks de statut
- [ ] **C.** `SmsNotificationInterface` et `EmailNotificationInterface`
- [ ] **D.** `PushNotificationInterface` et `DesktopNotificationInterface`

## Personnaliser les notifications du navigateur (messages flash)

### Question 33

Quel est le comportement par défaut du canal browser pour une notification ? *(une seule bonne réponse)*

- [ ] **A.** Afficher une popup JavaScript native, sans passer par les messages flash
- [ ] **B.** Ajouter un message flash avec `notification` comme clé
- [ ] **C.** Écrire la notification dans les logs Monolog uniquement
- [ ] **D.** Rediriger automatiquement l'utilisateur vers une page dédiée aux notifications

### Question 34

Comment faire correspondre le niveau d'importance d'une notification au type de message flash affiché (par exemple pour un style Bootstrap) ? *(une seule bonne réponse)*

- [ ] **A.** Via une option `framework.notifier.flash_style` dans la configuration
- [ ] **B.** En modifiant directement le template Twig affichant les messages flash
- [ ] **C.** Ce n'est pas configurable, la clé du message flash est toujours `notification`
- [ ] **D.** En surchargeant le service `notifier.flash_message_importance_mapper` par sa propre implémentation de `FlashMessageImportanceMapperInterface` (Symfony fournit `BootstrapFlashMessageImportanceMapper` prêt à l'emploi)

## Tester le Notifier

### Question 35

Quel trait Symfony fournit-il des assertions utiles pour tester une implémentation du Notifier ? *(une seule bonne réponse)*

- [ ] **A.** `MailerAssertionsTrait`, réutilisé tel quel pour le Notifier
- [ ] **B.** `NotifierTestTrait`
- [ ] **C.** `NotificationAssertionsTrait`
- [ ] **D.** Il n'existe aucun trait dédié, il faut mocker manuellement `NotifierInterface`

## Désactiver l'envoi

### Question 36

Comment désactiver entièrement l'envoi des notifications en développement (ou en test) ? *(une seule bonne réponse)*

- [ ] **A.** En supprimant temporairement les DSN de `.env`, ce qui suffit à désactiver l'envoi proprement
- [ ] **B.** En forçant les transports texter/chatter concernés à utiliser `null://null`, par exemple dans un bloc `when@dev`
- [ ] **C.** En mettant `framework.notifier.enabled: false`
- [ ] **D.** En désinstallant les bridges de fournisseurs le temps du développement

## Utiliser les événements

### Question 37

À quoi sert `MessageEvent`, et à quel moment est-il dispatché ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est dispatché que pour les canaux SMS et Chat, jamais pour l'email
- [ ] **B.** Juste après l'envoi réussi du message
- [ ] **C.** Uniquement en cas d'échec de l'envoi
- [ ] **D.** Juste avant l'envoi du message, utile par exemple pour journaliser le message qui va être envoyé

### Question 38

À quoi sert `FailedMessageEvent`, et quelles informations expose-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il n'expose que l'erreur, jamais le message d'origine
- [ ] **B.** Il est dispatché après que l'exception a été levée et interceptée par un listener global
- [ ] **C.** Il est dispatché avant qu'une exception ne soit levée suite à un échec d'envoi, exposant à la fois le message (`getMessage()`) et l'erreur (`getError()`)
- [ ] **D.** Il ne concerne que les échecs liés au canal email

### Question 39

À quoi sert `SentMessageEvent`, typiquement ? *(une seule bonne réponse)*

- [ ] **A.** À empêcher l'envoi d'un message avant qu'il ne soit traité
- [ ] **B.** À effectuer une action une fois le message envoyé avec succès, par exemple récupérer l'identifiant retourné (`getMessageId()`)
- [ ] **C.** À modifier le contenu du message avant son envoi
- [ ] **D.** Il ne se déclenche que si un transport de secours (failover) a été utilisé

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Notifier de la documentation Symfony 8.0](https://symfony.com/doc/8.0/notifier.html). Cette page n'a pas de section Learn more.

**Question 1 : B** — « Get the Notifier installed using: `$ composer require symfony/notifier` » *(§ Installation)*

**Question 2 : C** — « The Notifier component in Symfony is an abstraction on top of all these channels. It provides a dynamic way to manage how the messages are sent. » *(§ Installation)*

**Question 3 : A, B, C** — « SMS channel (…) Chat channel (…) Email channel (…) Browser channel uses flash messages. Push channel (…) Desktop channel. » *(§ Channels)*

**Question 4 : D** — « The SMS channel uses `Texter` classes to send SMS messages to mobile phones. This feature requires subscribing to a third-party service. » *(§ SMS Channel)*

**Question 5 : C** — « To enable a texter, add the correct DSN in your `.env` file and configure the `texter_transports`. » *(§ SMS Channel)*

**Question 6 : B** — « `new SmsMessage($phone, $message, $from, $options)` (…) optionally, you can override default "from" defined in transports (…) you can also add options object implementing `MessageOptionsInterface`. » *(§ SMS Channel)*

**Question 7 : D** — « The `send()` method returns a variable of type `SentMessage` which provides information such as the message ID and the original message contents. » *(§ SMS Channel)*

**Question 8 : A** — « If any of the DSN values contains any character considered special in a URI (…), you must encode them. (…) use the `urlencode` function to encode them. » *(§ SMS Channel)*

**Question 9 : C** — « The chat channel is used to send chat messages to users by using `Chatter` classes. » *(§ Chat Channel)*

**Question 10 : D** — « if not set explicitly, the message is sent to the default transport (the first one configured). » *(§ Chat Channel)*

**Question 11 : B** — « Chatters are configured using the `chatter_transports` setting. » *(§ Chat Channel)*

**Question 12 : D** — « By default, if you have the Messenger component installed, the notifications will be sent through the MessageBus. If you don't have a message consumer running, messages will never be sent. » *(§ Chat Channel)*

**Question 13 : C** — « To change this behavior, add the following configuration to send messages directly via the transport: `message_bus: false` » *(§ Chat Channel)*

**Question 14 : B** — « When Messenger is enabled, each channel (email, SMS, chat, etc.) dispatches its own message independently on the bus. If one channel fails and you have configured a failure transport, only that specific channel will be retried; the other channels won't be sent again. » *(§ Chat Channel)*

**Question 15 : D** — « The email channel uses the Symfony Mailer to send notifications using the special `NotificationEmail`. It is required to install the Twig bridge along with the Inky and CSS Inliner Twig extensions. » *(§ Email Channel)*

**Question 16 : A** — « You can also set the default "from" email address (…) `framework: mailer: dsn: ... envelope: sender: 'notifications@example.com'` » *(§ Email Channel)*

**Question 17 : C** — « The push channel is used to send notifications to users by using `Texter` classes. » *(§ Push Channel)*

**Question 18 : B** — « The desktop channel is used to display local desktop notifications on the same host machine using `Texter` classes. » *(§ Desktop Channel)*

**Question 19 : D** — « `$message = new DesktopMessage('Production is down', <<<CONTENT ... CONTENT, $options);` » avec `$options` un `JoliNotifOptions`. *(§ Desktop Channel)*

**Question 20 : C** — « you can also use the special `||` and `&&` characters to implement a failover or round-robin transport » : `main: '%env(SLACK_DSN)% || %env(TELEGRAM_DSN)%'`. *(§ Configure to use Failover or Round-Robin Transports)*

**Question 21 : A** — « Send notifications to the next scheduled transport calculated by round robin: `roundrobin: '%env(SLACK_DSN)% && %env(TELEGRAM_DSN)%'` » *(§ Configure to use Failover or Round-Robin Transports)*

**Question 22 : D** — « autowire the `NotifierInterface` (service ID `notifier`). This class has a `send()` method that allows you to send a `Notification` to a `Recipient`. » *(§ Creating & Sending Notifications)*

**Question 23 : B** — « The `Notification` is created by using two arguments: the subject and channels. (…) `['email', 'sms']` will send both an email and sms notification. » *(§ Creating & Sending Notifications)*

**Question 24 : C** — « The default notification also has a `content()` and `emoji()` method to set the notification content and icon. » *(§ Creating & Sending Notifications)*

**Question 25 : D** — « `NoRecipient` — This is the default (…) for example, the browser channel uses the current request's session flashbag. `Recipient` — This can contain both the email address and the phone number of the user. » *(§ Creating & Sending Notifications)*

**Question 26 : B** — « Symfony also allows you to use notification importance levels. Update the configuration to specify what channels should be used for specific levels (using `channel_policy`). » *(§ Configuring Channel Policies)*

**Question 27 : C** — « `$notification = new Notification('New Invoice')->content('...')->importance(Notification::IMPORTANCE_HIGH);` » *(§ Configuring Channel Policies)*

**Question 28 : D** — configuration `high: ['chat/slack']` — canal `chat`, restreint au transport `slack`. *(§ Configuring Channel Policies)*

**Question 29 : B** — « you can overwrite the `getChannels()` method to only return `sms` if the invoice price is very high and the recipient has a phone number. » *(§ Customize Notifications)*

**Question 30 : C** — « implement `ChatNotificationInterface` and its `asChatMessage()` method » — `public function asChatMessage(RecipientInterface $recipient, ?string $transport = null): ?ChatMessage`. *(§ Customize Notification Messages)*

**Question 31 : D** — « If you return null, the Notifier will create the `ChatMessage` based on this notification as it would without this method. » *(§ Customize Notification Messages)*

**Question 32 : C, D** — « The `SmsNotificationInterface`, `EmailNotificationInterface`, `PushNotificationInterface` and `DesktopNotificationInterface` also exists to modify messages sent to those channels. » *(§ Customize Notification Messages)*

**Question 33 : B** — « The default behavior for browser channel notifications is to add a flash message with `notification` as its key. » *(§ Customize Browser Notifications (Flash Messages))*

**Question 34 : D** — « You can do that by overriding the default `notifier.flash_message_importance_mapper` service with your own implementation of `FlashMessageImportanceMapperInterface` (…) Symfony currently provides an implementation for the Bootstrap CSS framework's typical alert levels. » *(§ Customize Browser Notifications (Flash Messages))*

**Question 35 : C** — « Symfony provides a `NotificationAssertionsTrait` which provide useful methods for testing your Notifier implementation. » *(§ Testing Notifier)*

**Question 36 : B** — « you may want to disable delivery of notifications entirely. You can do this by forcing Notifier to use the `NullTransport` for all configured texter and chatter transports only in the `dev` (and/or `test`) environment. » *(§ Disabling Delivery)*

**Question 37 : D** — « Just before sending the message, the event class `MessageEvent` is dispatched. » — « Typical Purposes: Doing something before the message is sent, like logging which message is going to be sent. » *(§ The MessageEvent Event)*

**Question 38 : C** — « Whenever an exception is thrown while sending the message, the event class `FailedMessageEvent` is dispatched. » — expose `$event->getMessage()` et `$event->getError()`. *(§ The FailedMessageEvent Event)*

**Question 39 : B** — « After the message has been successfully sent, the event class `SentMessageEvent` is dispatched. » — « Typical Purposes: To perform some action when the message is successfully sent (like retrieve the id returned when the message is sent). » *(§ The SentMessageEvent Event)*
