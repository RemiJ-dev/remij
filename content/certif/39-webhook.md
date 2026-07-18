# QCM — Les Webhooks

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/webhook.html](https://symfony.com/doc/8.0/webhook.html) · **Généré le :** 24 juillet 2026
>
> **70 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Introduction

### Question 1

Qu'est-ce qu'un webhook ? *(une seule bonne réponse)*

- [ ] **A.** Un format de sérialisation de données similaire à JSON
- [ ] **B.** Un mécanisme de cache distribué entre microservices
- [ ] **C.** Un mécanisme d'envoi de notifications d'événements entre systèmes, typiquement via des requêtes HTTP POST
- [ ] **D.** Un protocole de chiffrement pour sécuriser les API REST

### Question 2

Quelles sont les deux capacités principales fournies par le composant Webhook ? *(plusieurs bonnes réponses)*

- [ ] **A.** Consommer (recevoir et traiter des webhooks entrants)
- [ ] **B.** Envoyer (dispatcher des callbacks webhook vers des endpoints enregistrés)
- [ ] **C.** Chiffrer automatiquement le contenu des requêtes HTTP
- [ ] **D.** Générer une documentation OpenAPI des endpoints webhook

## Installation

### Question 3

Quelle commande installe le composant Webhook ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/remote-event`
- [ ] **B.** `composer require symfony/http-client`
- [ ] **C.** `composer require symfony/hook`
- [ ] **D.** `composer require symfony/webhook`

## Consuming Webhooks

### Question 4

Quelles sont les trois phases pour recevoir et traiter un webhook via le composant Webhook combiné à RemoteEvent ? *(plusieurs bonnes réponses)*

- [ ] **A.** Recevoir le webhook via un endpoint dédié
- [ ] **B.** Vérifier le webhook et le convertir en objet RemoteEvent
- [ ] **C.** Consommer l'événement dans la logique applicative
- [ ] **D.** Republier automatiquement le webhook vers un autre service tiers

## A Centralized Webhook Endpoint

### Question 5

Quelle classe fournit un point d'entrée unique pour recevoir tous les webhooks entrants ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\WebhookEndpoint`
- [ ] **B.** `Symfony\Component\Webhook\Controller\WebhookController`
- [ ] **C.** `Symfony\Component\Webhook\Controller\RemoteEventController`
- [ ] **D.** `Symfony\Component\RemoteEvent\Controller\WebhookController`

### Question 6

Par défaut, quel préfixe d'URL route vers le `WebhookController` ? *(une seule bonne réponse)*

- [ ] **A.** `/api/webhook`
- [ ] **B.** `/events`
- [ ] **C.** `/remote-event`
- [ ] **D.** `/webhook`

### Question 7

Comment déclare-t-on un parser de webhook nommé `acme_webhook` dans la configuration ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de configuration dédiée, tout passe par le routing Symfony classique
- [ ] **B.** Sous `framework.webhook.routing.acme_webhook`, avec les clés `service` et `secret`
- [ ] **C.** En créant un fichier `config/webhooks/acme_webhook.yaml` dédié
- [ ] **D.** Via un attribut PHP `#[AsWebhook('acme_webhook')]` uniquement, sans configuration YAML

### Question 8

À quoi correspond le nom de routing (ex : `acme_webhook`) dans l'URL finale du webhook ? *(une seule bonne réponse)*

- [ ] **A.** Il sert uniquement de clé interne, sans impact sur l'URL
- [ ] **B.** Il définit le nom de la classe du parser
- [ ] **C.** Il correspond au nom du secret d'environnement à utiliser
- [ ] **D.** Il devient un segment de l'URL, ex. `https://example.com/webhook/acme_webhook`

### Question 9

Que doit garantir chaque nom de routing défini dans `framework.webhook.routing` ? *(une seule bonne réponse)*

- [ ] **A.** Il doit être un UUID valide
- [ ] **B.** Il doit être unique, car il relie la source du webhook au code consommateur
- [ ] **C.** Il doit correspondre exactement au nom de la classe du parser
- [ ] **D.** Il doit commencer par le préfixe `webhook_`

### Question 10

L'option `secret` dans la configuration du routing d'un webhook est-elle obligatoire ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement pour les parsers personnalisés
- [ ] **B.** Non, elle est interdite si un `PayloadConverter` est utilisé
- [ ] **C.** Non, elle est optionnelle
- [ ] **D.** Oui, toujours obligatoire

### Question 11

Comment les différents parsers configurés sont-ils mis à disposition du `WebhookController` ? *(une seule bonne réponse)*

- [ ] **A.** Il faut les enregistrer manuellement dans un tableau statique
- [ ] **B.** Un seul parser peut être actif à la fois
- [ ] **C.** Ils doivent être appelés explicitement depuis une Action Symfony
- [ ] **D.** Ils sont automatiquement injectés dans le `WebhookController`

## Parsing Webhook Requests

### Question 12

Une fois qu'une requête webhook arrive, que doit accomplir le parsing avant que l'application puisse la traiter ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement journaliser la requête brute
- [ ] **B.** Rediriger la requête vers un service tiers de validation
- [ ] **C.** Convertir le payload en tableau PHP sans aucune vérification
- [ ] **D.** Vérifier l'authenticité de la requête, extraire le payload, et le convertir en objet RemoteEvent

### Question 13

Quelles sont les deux approches proposées par Symfony pour gérer le parsing d'un webhook ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le parser intégré (built-in), pour les webhooks provenant d'autres applications Symfony
- [ ] **B.** Un parser personnalisé (custom), pour les webhooks de services tiers ou d'API personnalisées
- [ ] **C.** Un parser généré automatiquement par IA à partir du payload
- [ ] **D.** Un parser universel qui devine le format sans configuration

## Using the Built-in Parser

### Question 14

Pour quels types de webhooks le parser intégré `RequestParser` est-il destiné ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les webhooks des services de mailing
- [ ] **B.** Uniquement les webhooks utilisant HMAC-SHA512
- [ ] **C.** Les webhooks provenant d'autres applications Symfony
- [ ] **D.** Tous les webhooks, quel que soit le fournisseur

### Question 15

Que gère automatiquement le parser intégré `Symfony\Component\Webhook\Client\RequestParser` ? *(une seule bonne réponse)*

- [ ] **A.** La création automatique du consommateur (Consumer)
- [ ] **B.** La validation de la requête et la vérification de signature
- [ ] **C.** La traduction du payload dans la langue de l'utilisateur
- [ ] **D.** L'envoi d'un accusé de réception au service tiers

## Creating a Custom Parser

### Question 16

Quelles sont les deux façons de créer un parser personnalisé ? *(plusieurs bonnes réponses)*

- [ ] **A.** Implémenter `RequestParserInterface`
- [ ] **B.** Étendre `AbstractRequestParser`
- [ ] **C.** Implémenter `ConsumerInterface`
- [ ] **D.** Étendre `WebhookController`

### Question 17

Quelle commande Symfony Maker génère à la fois le parser et le consommateur, et met à jour la configuration ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console make:consumer`
- [ ] **B.** `php bin/console make:webhook`
- [ ] **C.** `php bin/console make:parser`
- [ ] **D.** `php bin/console make:remote-event`

### Question 18

Quelles méthodes doit-on implémenter en étendant `AbstractRequestParser` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getRequestMatcher()`
- [ ] **B.** `doParse()`
- [ ] **C.** `getSecret()`
- [ ] **D.** `consume()`

### Question 19

À quoi sert la méthode `getRequestMatcher()` d'un parser personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** À transformer le payload en RemoteEvent
- [ ] **B.** À enregistrer le parser dans le container de services
- [ ] **C.** À valider le format de la requête entrante (ex : méthode HTTP, Content-Type JSON)
- [ ] **D.** À vérifier la signature HMAC de la requête

### Question 20

À quoi sert la méthode `doParse()` d'un parser personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** À définir le nom de la route du webhook
- [ ] **B.** À générer automatiquement les tests du parser
- [ ] **C.** À enregistrer le consommateur associé
- [ ] **D.** À vérifier le webhook et le parser en un objet RemoteEvent

### Question 21

Quels paramètres reçoit la méthode `doParse()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** La `Request` entrante
- [ ] **B.** Le secret configuré pour ce webhook, marqué `#[\SensitiveParameter]`
- [ ] **C.** L'objet RemoteEvent précédent
- [ ] **D.** Le nom de la route du webhook

### Question 22

Quel algorithme de signature est typiquement utilisé pour valider une requête webhook dans `doParse()` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune signature n'est jamais nécessaire
- [ ] **B.** HMAC-SHA256
- [ ] **C.** MD5 simple
- [ ] **D.** RSA asymétrique obligatoire

### Question 23

Quelle exception doit être levée par `doParse()` pour une requête invalide ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\Exception\InvalidSignatureException`
- [ ] **B.** `\InvalidArgumentException` générique
- [ ] **C.** `Symfony\Component\Webhook\Exception\RejectWebhookException`
- [ ] **D.** `Symfony\Component\HttpKernel\Exception\BadRequestHttpException`

### Question 24

Que doit retourner `doParse()` en cas de succès ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau associatif représentant le payload brut
- [ ] **B.** Un objet `Response` HTTP
- [ ] **C.** Un booléen `true`
- [ ] **D.** Une instance de `Symfony\Component\RemoteEvent\RemoteEvent`

## Testing Your Parser

### Question 25

Quelle classe de base permet de tester un parser personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Bundle\FrameworkBundle\Test\WebTestCase`
- [ ] **B.** `Symfony\Component\Webhook\Test\AbstractRequestParserTestCase`
- [ ] **C.** `Symfony\Component\Webhook\Test\WebhookTestCase`
- [ ] **D.** `Symfony\Component\RemoteEvent\Test\ParserTestCase`

### Question 26

Quelle méthode de test exécute automatiquement les cas définis par `getPayloads()` ? *(une seule bonne réponse)*

- [ ] **A.** `testConsume()`
- [ ] **B.** `testWebhook()`
- [ ] **C.** `testRequestMatcher()`
- [ ] **D.** `testParse()`

### Question 27

D'où `getPayloads()` charge-t-il ses cas de test par défaut ? *(une seule bonne réponse)*

- [ ] **A.** D'un tableau PHP codé en dur dans la classe de test
- [ ] **B.** D'un endpoint HTTP de test distant
- [ ] **C.** Des fichiers `Fixtures/*.json`, chacun apparié à un fichier `.php` d'attente
- [ ] **D.** D'une base de données SQLite de test

### Question 28

Quelle méthode doit obligatoirement être implémentée dans le test pour retourner l'instance du parser à tester ? *(une seule bonne réponse)*

- [ ] **A.** `buildParser()`
- [ ] **B.** `parserInstance()`
- [ ] **C.** `createRequestParser()`
- [ ] **D.** `getRequestParser()`

### Question 29

Pourquoi peut-on avoir besoin de surcharger `createRequest()` dans son test ? *(une seule bonne réponse)*

- [ ] **A.** Pour changer l'URL de routing testée, car elle est réellement vérifiée
- [ ] **B.** Pour désactiver la validation du Content-Type
- [ ] **C.** Ce n'est jamais nécessaire, `createRequest()` ne peut pas être surchargée
- [ ] **D.** Pour ajouter des en-têtes spécifiques au fournisseur (ex : signatures de webhook) ou changer la méthode HTTP

### Question 30

Que teste réellement (ou pas) le routing via la `Request` construite dans `createRequest()` par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `createRequest()` ignore complètement la `Request` générée
- [ ] **B.** Le routing n'est pas réellement testé par la requête construite dans `createRequest()`
- [ ] **C.** Le routing est strictement validé contre la configuration YAML
- [ ] **D.** Le routing doit être défini avant de lancer le test, sinon il échoue

### Question 31

Quelle méthode peut-on surcharger si le parser valide des signatures ? *(une seule bonne réponse)*

- [ ] **A.** `validateSignature()`
- [ ] **B.** `withSecret()`
- [ ] **C.** `getSecret()`
- [ ] **D.** `getSignature()`

### Question 32

Quelle méthode peut-on surcharger si les fixtures ne sont pas au format `.json` (ex : `.txt`) ? *(une seule bonne réponse)*

- [ ] **A.** `getPayloadFormat()`
- [ ] **B.** `fixtureType()`
- [ ] **C.** `getFixtureExtension()`
- [ ] **D.** `setFixtureFormat()`

## Handling Complex Payload Transformations

### Question 33

Quelle interface permet d'encapsuler la logique de transformation d'un payload webhook complexe ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\Client\PayloadTransformerInterface`
- [ ] **B.** `Symfony\Component\RemoteEvent\TransformerInterface`
- [ ] **C.** `Symfony\Component\Webhook\PayloadMapperInterface`
- [ ] **D.** `Symfony\Component\RemoteEvent\PayloadConverterInterface`

### Question 34

Quelle méthode doit implémenter un `PayloadConverterInterface` ? *(une seule bonne réponse)*

- [ ] **A.** `transform(RemoteEvent $event): array`
- [ ] **B.** `map(array $payload): array`
- [ ] **C.** `parse(Request $request): RemoteEvent`
- [ ] **D.** `convert(array $payload): RemoteEvent`

### Question 35

Comment un `PayloadConverter` est-il utilisé dans un parser personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Il ne peut être utilisé que dans un Consumer, jamais dans un parser
- [ ] **B.** Il est appelé automatiquement par le `WebhookController` sans injection
- [ ] **C.** Il est injecté dans le parser (ex : via `#[Autowire]`) et appelé depuis `doParse()`
- [ ] **D.** Il remplace entièrement `AbstractRequestParser`, qui devient inutile

### Question 36

Quel exemple concret de `PayloadConverter` est cité par la documentation comme source d'inspiration ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\RemoteEvent\DefaultPayloadConverter`
- [ ] **B.** `Symfony\Component\Mailer\Bridge\Mailgun\RemoteEvent\MailgunPayloadConverter`
- [ ] **C.** `Symfony\Component\Notifier\Bridge\Twilio\TwilioPayloadConverter`
- [ ] **D.** `Symfony\Component\Webhook\Bridge\Stripe\StripePayloadConverter`

## Consuming the RemoteEvent

### Question 37

Quelle interface doit implémenter un consommateur de RemoteEvent ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Messenger\Handler\MessageHandlerInterface`
- [ ] **B.** `Symfony\Component\RemoteEvent\Consumer\ConsumerInterface`
- [ ] **C.** `Symfony\Component\Webhook\Consumer\ConsumerInterface`
- [ ] **D.** `Symfony\Component\RemoteEvent\ConsumerInterface` (sans sous-namespace)

### Question 38

Quel attribut PHP permet de déclarer une classe comme consommateur d'un RemoteEvent, sans passer par `make:webhook` ? *(une seule bonne réponse)*

- [ ] **A.** `#[AsEventListener('acme_webhook')]`
- [ ] **B.** `#[AsMessageHandler('acme_webhook')]`
- [ ] **C.** `#[AsWebhookConsumer('acme_webhook')]`
- [ ] **D.** `#[AsRemoteEventConsumer('acme_webhook')]`

### Question 39

Que doit vérifier le nom passé à l'attribut `AsRemoteEventConsumer` ? *(une seule bonne réponse)*

- [ ] **A.** Il doit être unique dans toute l'application, sans lien avec le routing
- [ ] **B.** Il n'a aucune contrainte particulière
- [ ] **C.** Il doit correspondre exactement au nom de routing défini dans la configuration du webhook
- [ ] **D.** Il doit correspondre au nom de la classe du parser

### Question 40

Quelle méthode un `ConsumerInterface` doit-il implémenter ? *(une seule bonne réponse)*

- [ ] **A.** `process(RemoteEvent $event): Response`
- [ ] **B.** `onEvent(RemoteEvent $event): bool`
- [ ] **C.** `consume(RemoteEvent $event): void`
- [ ] **D.** `handle(RemoteEvent $event): void`

## Asynchronous Consuming

### Question 41

Par défaut, comment les consommateurs de webhook sont-ils invoqués ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne sont jamais invoqués automatiquement
- [ ] **B.** De façon synchrone, quand le RemoteEvent est dispatché
- [ ] **C.** Toujours de façon asynchrone via Messenger
- [ ] **D.** De façon synchrone, mais uniquement en environnement de test

### Question 42

Pour quelle classe faut-il configurer le routing Messenger afin de traiter les webhooks de façon asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\Messenger\ConsumeWebhookMessage`
- [ ] **B.** `Symfony\Component\RemoteEvent\Messenger\ConsumeRemoteEventMessage`
- [ ] **C.** `Symfony\Component\Webhook\Messenger\SendWebhookMessage`
- [ ] **D.** `Symfony\Component\RemoteEvent\Messenger\WebhookMessage`

### Question 43

Que se passe-t-il si aucun routing Messenger n'est configuré pour `ConsumeRemoteEventMessage` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée au démarrage de l'application
- [ ] **B.** Le message est mis en file d'attente indéfiniment sans jamais être traité
- [ ] **C.** Les consommateurs sont traités de façon synchrone pendant la requête webhook
- [ ] **D.** Les webhooks sont silencieusement ignorés

## Built-in Integrations

### Question 44

Que fournit Symfony pour les services courants (mailers, SMS) via les intégrations prédéfinies ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement une documentation, aucun code fourni
- [ ] **B.** Des consommateurs prêts à l'emploi, mais les parsers restent à créer
- [ ] **C.** Des parsers prêts à l'emploi, mais le consommateur reste à créer par le développeur
- [ ] **D.** Des parsers et des consommateurs entièrement prêts à l'emploi, sans code à écrire

## Mailer Webhooks

### Question 45

Que permettent de recevoir les Mailer Webhooks ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement des notifications d'échec d'envoi
- [ ] **B.** Des notifications de facturation du fournisseur d'emailing
- [ ] **C.** Des notifications de changement de mot de passe utilisateur
- [ ] **D.** Des notifications de livraison et d'engagement (delivery/engagement) depuis des mailers tiers

### Question 46

Quel est le nom du service parser pour Mailgun ? *(une seule bonne réponse)*

- [ ] **A.** `webhook.mailer.mailgun_parser`
- [ ] **B.** `mailer.mailgun.webhook_parser`
- [ ] **C.** `app.webhook.mailgun`
- [ ] **D.** `mailer.webhook.request_parser.mailgun`

### Question 47

Avant de configurer le webhook d'un mailer tiers comme Mailgun, que faut-il faire selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Configurer d'abord le composant Notifier, prérequis obligatoire
- [ ] **B.** Installer le fournisseur de mailer tiers correspondant, comme décrit dans la documentation du composant Mailer
- [ ] **C.** Créer manuellement un parser personnalisé, les parsers intégrés ne fonctionnant pas
- [ ] **D.** Désactiver le composant Serializer, incompatible avec les mailers tiers

### Question 48

Quels événements RemoteEvent typiques un consommateur de Mailer Webhooks peut-il recevoir ? *(plusieurs bonnes réponses)*

- [ ] **A.** `MailerDeliveryEvent`
- [ ] **B.** `MailerEngagementEvent`
- [ ] **C.** `MailerBillingEvent`
- [ ] **D.** `MailerQuotaEvent`

### Question 49

Quel type d'action l'événement `MailerEngagementEvent` représente-t-il typiquement ? *(une seule bonne réponse)*

- [ ] **A.** Le renouvellement d'un abonnement au service de mailing
- [ ] **B.** La création d'un nouveau compte utilisateur
- [ ] **C.** Ouvertures, clics, bounces (opens, clicks, bounces)
- [ ] **D.** Uniquement les erreurs de configuration DNS

### Question 50

Où stocker le secret du webhook d'un mailer tiers, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a jamais de secret pour les webhooks de mailer
- [ ] **B.** Via le système de gestion des secrets ou dans un fichier `.env`
- [ ] **C.** En dur dans le code source du consommateur
- [ ] **D.** Dans un cookie de session

### Question 51

Combien de fournisseurs de mailer tiers sont listés avec un parser intégré dans le tableau de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** 3
- [ ] **B.** 12
- [ ] **C.** 5
- [ ] **D.** 20

## Notifier Webhooks

### Question 52

Que permettent de recevoir les Notifier Webhooks ? *(une seule bonne réponse)*

- [ ] **A.** Des notifications d'e-mail entrant
- [ ] **B.** Des notifications de paiement
- [ ] **C.** Des notifications de mise à jour d'application mobile
- [ ] **D.** Des notifications de statut de SMS depuis des fournisseurs

### Question 53

Quel événement RemoteEvent consomme-t-on typiquement pour les webhooks de notification SMS ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\RemoteEvent\Event\Notifier\NotifierEvent`
- [ ] **B.** `Symfony\Component\RemoteEvent\Event\Sms\SmsEvent`
- [ ] **C.** `Symfony\Component\RemoteEvent\Event\Mailer\MailerDeliveryEvent`
- [ ] **D.** `Symfony\Component\Notifier\Event\SmsStatusEvent`

### Question 54

Lequel de ces fournisseurs SMS dispose d'un parser intégré pour les Notifier Webhooks ? *(plusieurs bonnes réponses)*

- [ ] **A.** Twilio
- [ ] **B.** Vonage
- [ ] **C.** Stripe
- [ ] **D.** Brevo

## Sending Webhooks

### Question 55

Que permet la fonctionnalité d'envoi (Sending) du composant Webhook ? *(une seule bonne réponse)*

- [ ] **A.** De transformer des webhooks entrants en emails
- [ ] **B.** De générer une documentation Swagger des endpoints
- [ ] **C.** De dispatcher des callbacks webhook vers des endpoints distants
- [ ] **D.** De recevoir des webhooks entrants uniquement

### Question 56

Quels composants supplémentaires faut-il installer pour envoyer des webhooks ? *(plusieurs bonnes réponses)*

- [ ] **A.** `symfony/http-client`
- [ ] **B.** `symfony/serializer`
- [ ] **C.** `symfony/mailer`
- [ ] **D.** `symfony/notifier`

### Question 57

Quelle commande installe les composants requis pour l'envoi de webhooks ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/webhook-client`
- [ ] **B.** `composer require symfony/http-client symfony/messenger`
- [ ] **C.** `composer require symfony/webhook symfony/mailer`
- [ ] **D.** `composer require symfony/http-client symfony/serializer`

## Basic Usage

### Question 58

Quel message faut-il dispatcher via Messenger pour envoyer un webhook ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\RemoteEvent\Messenger\ConsumeRemoteEventMessage`
- [ ] **B.** `Symfony\Component\Webhook\Messenger\WebhookMessage`
- [ ] **C.** `Symfony\Component\Messenger\WebhookEnvelope`
- [ ] **D.** `Symfony\Component\Webhook\Messenger\SendWebhookMessage`

### Question 59

Quels paramètres reçoit le constructeur de `Subscriber` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `url` (l'URL de destination du webhook)
- [ ] **B.** `secret` (le secret partagé pour la signature)
- [ ] **C.** `retries` (le nombre de tentatives en cas d'échec)
- [ ] **D.** `timeout` (le délai maximum d'attente)

### Question 60

Que reçoit le constructeur de `SendWebhookMessage` ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `Request` HTTP préconstruite
- [ ] **B.** Le `Subscriber` et l'objet `RemoteEvent`
- [ ] **C.** Uniquement l'URL du webhook, sous forme de chaîne
- [ ] **D.** Le secret et le payload JSON déjà sérialisé

### Question 61

Comment déclenche-t-on effectivement l'envoi du webhook une fois le message construit ? *(une seule bonne réponse)*

- [ ] **A.** En l'ajoutant à une file d'attente Redis manuellement
- [ ] **B.** Il est envoyé automatiquement dès l'instanciation, sans dispatch
- [ ] **C.** En le dispatchant via le `MessageBusInterface`
- [ ] **D.** En appelant directement une méthode `send()` sur le message

## SendWebhookHandler

### Question 62

Quelle classe traite le message `SendWebhookMessage` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\Server\SendWebhookHandler`
- [ ] **B.** `Symfony\Component\Webhook\Messenger\SendWebhookHandler`
- [ ] **C.** `Symfony\Component\Webhook\Client\SendWebhookHandler`
- [ ] **D.** `Symfony\Component\RemoteEvent\Messenger\SendWebhookHandler`

### Question 63

Quels en-têtes standard sont ajoutés par `SendWebhookHandler` à la requête HTTP envoyée ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Webhook-Event` (nom de l'événement)
- [ ] **B.** `Webhook-Id` (identifiant de l'événement)
- [ ] **C.** `Webhook-Signature` (signature HMAC-SHA256)
- [ ] **D.** `Webhook-Retry-Count` (nombre de tentatives déjà effectuées)

### Question 64

Comment le corps de la requête HTTP est-il construit par `SendWebhookHandler` ? *(une seule bonne réponse)*

- [ ] **A.** Le payload est encodé en XML
- [ ] **B.** Le payload est encodé en JSON
- [ ] **C.** Le payload est encodé en YAML
- [ ] **D.** Le payload est envoyé sous forme de formulaire multipart

### Question 65

Quel composant est utilisé en interne par `SendWebhookHandler` pour envoyer effectivement la requête HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Symfony Mailer
- [ ] **B.** `file_get_contents()` avec un contexte de flux HTTP
- [ ] **C.** Le composant Symfony HttpClient
- [ ] **D.** cURL directement, sans passer par un composant Symfony

## Resulting HTTP Request

### Question 66

Sur quoi se base la valeur de l'en-tête `Webhook-Signature` ? *(une seule bonne réponse)*

- [ ] **A.** La date et l'heure d'envoi de la requête
- [ ] **B.** La signature HMAC-SHA256 de la concaténation du nom de l'événement, de son ID, et du corps de la requête
- [ ] **C.** Un simple hash MD5 du corps de la requête uniquement
- [ ] **D.** Le secret partagé, envoyé tel quel sans hachage

### Question 67

Comment un endpoint récepteur doit-il vérifier l'authenticité d'un webhook reçu ? *(une seule bonne réponse)*

- [ ] **A.** En vérifiant que le `Content-Type` est bien `application/json`, rien de plus
- [ ] **B.** Il n'existe aucune méthode de vérification recommandée
- [ ] **C.** En recalculant la signature HMAC-SHA256 avec le secret partagé et en la comparant à `Webhook-Signature`
- [ ] **D.** En vérifiant uniquement l'adresse IP source de la requête

### Question 68

Quelle méthode HTTP est utilisée pour l'envoi d'un webhook ? *(une seule bonne réponse)*

- [ ] **A.** GET
- [ ] **B.** PUT
- [ ] **C.** PATCH
- [ ] **D.** POST

## Custom Sending Logic

### Question 69

Quelle interface permet d'implémenter une logique d'envoi personnalisée pour contrôler la génération des en-têtes, la signature et le transport HTTP ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Webhook\Client\TransportInterface`
- [ ] **B.** `Symfony\Component\HttpClient\TransportInterface`
- [ ] **C.** `Symfony\Component\Webhook\Messenger\TransportInterface`
- [ ] **D.** `Symfony\Component\Webhook\Server\TransportInterface`

### Question 70

Pour quels cas d'usage la documentation recommande-t-elle d'utiliser `TransportInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement pour les tests unitaires du composant
- [ ] **B.** Pour remplacer entièrement le composant HttpClient dans toute l'application
- [ ] **C.** Pour désactiver la signature HMAC par défaut sans autre alternative
- [ ] **D.** Les cas d'usage avancés nécessitant de contrôler la génération des en-têtes, la signature, et le transport HTTP

---

## Corrigé

**Question 1 : C** — « A webhook is a mechanism for sending event notifications between systems, typically delivered via HTTP POST requests. » *(§ intro)*

**Question 2 : A, B** — « The Webhook component provides two primary capabilities: Consuming (…) Sending (…) » *(§ intro)*

**Question 3 : D** — « $ composer require symfony/webhook » *(§ Installation)*

**Question 4 : A, B, C** — « enables you to receive and process webhooks through three phases: Receiving the webhook via a dedicated endpoint (…) Verifying the webhook and converting it to a RemoteEvent object (…) Consuming the event in your application logic. » *(§ Consuming Webhooks)*

**Question 5 : B** — « The `Symfony\Component\Webhook\Controller\WebhookController` provides a single entry point for receiving all incoming webhooks. » *(§ A Centralized Webhook Endpoint)*

**Question 6 : D** — « By default, any URL prefixed with `/webhook` routes to this controller. » *(§ A Centralized Webhook Endpoint)*

**Question 7 : B** — « framework: webhook: routing: acme_webhook: service: App\Webhook\AcmeWebhookRequestParser, secret: '%env(WEBHOOK_SECRET)%' # optional » *(§ A Centralized Webhook Endpoint)*

**Question 8 : D** — « The routing name becomes part of the webhook URL (e.g., `https://example.com/webhook/acme_webhook`). » *(§ A Centralized Webhook Endpoint)*

**Question 9 : B** — « Each routing name must be unique as it connects the webhook source to your consumer code. » *(§ A Centralized Webhook Endpoint)*

**Question 10 : C** — « secret: '%env(WEBHOOK_SECRET)%'  # optional » *(§ A Centralized Webhook Endpoint)*

**Question 11 : D** — « All parsers are automatically injected into the WebhookController. » *(§ A Centralized Webhook Endpoint)*

**Question 12 : D** — « Parsing involves verifying the request's authenticity (typically via signature validation), extracting the payload, and converting it into a `RemoteEvent` object. » *(§ Parsing Webhook Requests)*

**Question 13 : A, B** — « Built-in parser: use the standard `RequestParser` for webhooks from other Symfony applications; Custom parser: create your own parser for webhooks from third-party services or custom APIs. » *(§ Parsing Webhook Requests)*

**Question 14 : C** — « For webhooks originating from other Symfony applications, you can use the built-in `RequestParser` instead of creating a custom parser. » *(§ Using the Built-in Parser)*

**Question 15 : B** — « The built-in parser automatically handles request validation and signature verification. » *(§ Using the Built-in Parser)*

**Question 16 : A, B** — « implement a parser using `RequestParserInterface` or extend `AbstractRequestParser`. » *(§ Creating a Custom Parser)*

**Question 17 : B** — « $ php bin/console make:webhook » — « generates both the parser and consumer classes and updates your configuration automatically. » *(§ Creating a Custom Parser)*

**Question 18 : A, B** — « you need to implement two methods: `getRequestMatcher` (…) `doParse` (…) » *(§ Creating a Custom Parser)*

**Question 19 : C** — « `getRequestMatcher` to validate the incoming request format. » *(§ Creating a Custom Parser)*

**Question 20 : D** — « `doParse` to verify the webhook and parse it into a RemoteEvent. » *(§ Creating a Custom Parser)*

**Question 21 : A, B** — « protected function doParse(Request $request, #[\SensitiveParameter] string $secret): ?RemoteEvent » *(§ Creating a Custom Parser)*

**Question 22 : B** — « Validate the request signature (typically HMAC-SHA256) » *(§ Creating a Custom Parser)*

**Question 23 : C** — « Throw a `Symfony\Component\Webhook\Exception\RejectWebhookException` for invalid requests. » *(§ Creating a Custom Parser)*

**Question 24 : D** — « Return a `Symfony\Component\RemoteEvent\RemoteEvent` on success. » *(§ Creating a Custom Parser)*

**Question 25 : B** — « Test your custom parser by extending `Symfony\Component\Webhook\Test\AbstractRequestParserTestCase`. » *(§ Testing Your Parser)*

**Question 26 : D** — « This base class runs `AbstractRequestParserTestCase::testParse` with data from `AbstractRequestParserTestCase::getPayloads`. » *(§ Testing Your Parser)*

**Question 27 : C** — « which loads files from `Fixtures/*.json` and pairs each with a `.php` expectation file. » *(§ Testing Your Parser)*

**Question 28 : C** — « Your test must implement `AbstractRequestParserTestCase::createRequestParser` to return an instance of your `RequestParserInterface` implementation. » *(§ Testing Your Parser)*

**Question 29 : D** — « override it to add provider-specific headers (e.g., webhook signatures) or change the method » *(§ Testing Your Parser)*

**Question 30 : B** — « // the routing is not actually tested » *(§ Testing Your Parser)*

**Question 31 : C** — « `getSecret` if your parser validates signatures » *(§ Testing Your Parser)*

**Question 32 : C** — « `getFixtureExtension` if your fixtures are not `.json` (e.g., `.txt` for form-encoded payloads) » *(§ Testing Your Parser)*

**Question 33 : D** — « use `Symfony\Component\RemoteEvent\PayloadConverterInterface` to encapsulate transformation logic. » *(§ Handling Complex Payload Transformations)*

**Question 34 : D** — « public function convert(array $payload): RemoteEvent » *(§ Handling Complex Payload Transformations)*

**Question 35 : C** — « Then inject it into your parser (…) `#[Autowire(service: AcmeWebhookPayloadConverter::class)] private readonly PayloadConverterInterface $converter`. » *(§ Handling Complex Payload Transformations)*

**Question 36 : B** — « For inspiration, look at the built-in `Symfony\Component\Mailer\Bridge\Mailgun\RemoteEvent\MailgunPayloadConverter`. » *(§ Handling Complex Payload Transformations)*

**Question 37 : B** — « you need a consumer implementing `Symfony\Component\RemoteEvent\Consumer\ConsumerInterface`. » *(§ Consuming the RemoteEvent)*

**Question 38 : D** — « create it manually using the `Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer` attribute (…) `#[AsRemoteEventConsumer('acme_webhook')]  // must match routing name`. » *(§ Consuming the RemoteEvent)*

**Question 39 : C** — « The name passed to the `AsRemoteEventConsumer` attribute must match the routing name defined in your webhook configuration. » *(§ Consuming the RemoteEvent)*

**Question 40 : C** — « public function consume(RemoteEvent $event): void » *(§ Consuming the RemoteEvent)*

**Question 41 : B** — « By default, webhook consumers are invoked synchronously when the RemoteEvent is dispatched. » *(§ Asynchronous Consuming)*

**Question 42 : B** — « configure Messenger routing for `Symfony\Component\RemoteEvent\Messenger\ConsumeRemoteEventMessage`. » *(§ Asynchronous Consuming)*

**Question 43 : C** — « Without it, consumers are processed synchronously during the webhook request. » *(§ Asynchronous Consuming)*

**Question 44 : C** — « Symfony provides pre-built parsers for common services, so you don't need to create custom parsers for them. You still need to create your own consumer to handle the RemoteEvent according to your business logic. » *(§ Built-in Integrations)*

**Question 45 : D** — « Receive delivery and engagement notifications from third-party mailers. » *(§ Mailer Webhooks)*

**Question 46 : D** — « Mailgun `mailer.webhook.request_parser.mailgun` » *(§ Mailer Webhooks)*

**Question 47 : B** — « Install the third-party mailer provider you want to use as described in the documentation of the Mailer component. » *(§ Mailer Webhooks)*

**Question 48 : A, B** — « if ($event instanceof MailerDeliveryEvent) (…) elseif ($event instanceof MailerEngagementEvent) » *(§ Mailer Webhooks)*

**Question 49 : C** — « private function handleEngagement(MailerEngagementEvent $event): void { // Handle opens, clicks, bounces, etc. } » *(§ Mailer Webhooks)*

**Question 50 : B** — « store the webhook secret in your environment (via the secrets management system or in a `.env` file). » *(§ Mailer Webhooks)*

**Question 51 : B** — « AhaSend, Brevo, Mandrill, MailerSend, Mailgun, Mailjet, Mailomat, Mailtrap, Postmark, Resend, Sendgrid, Sweego » — 12 fournisseurs listés dans le tableau. *(§ Mailer Webhooks)*

**Question 52 : D** — « Receive SMS status notifications from providers. » *(§ Notifier Webhooks)*

**Question 53 : B** — « then consume `Symfony\Component\RemoteEvent\Event\Sms\SmsEvent`. » *(§ Notifier Webhooks)*

**Question 54 : A, B** — « LOX24, Smsbox, Sweego, Twilio, Vonage » — Twilio et Vonage font partie de la liste, Stripe et Brevo n'y figurent pas. *(§ Notifier Webhooks)*

**Question 55 : C** — « The Webhook component also enables your application to dispatch webhook callbacks to remote endpoints. » *(§ Sending Webhooks)*

**Question 56 : A, B** — « ensure you have installed both the HttpClient and Serializer components. » *(§ Sending Webhooks)*

**Question 57 : D** — « $ composer require symfony/http-client symfony/serializer » *(§ Sending Webhooks)*

**Question 58 : D** — « dispatch a `Symfony\Component\Webhook\Messenger\SendWebhookMessage` via the Messenger component. » *(§ Basic Usage)*

**Question 59 : A, B** — « $subscriber = new Subscriber(url: 'https://example.com/webhook/stock', secret: 'your-shared-secret'); » *(§ Basic Usage)*

**Question 60 : B** — « $this->messageBus->dispatch(new SendWebhookMessage($subscriber, $event)); » *(§ Basic Usage)*

**Question 61 : C** — « $this->messageBus->dispatch(new SendWebhookMessage($subscriber, $event)); » *(§ Basic Usage)*

**Question 62 : B** — « The message is processed by `Symfony\Component\Webhook\Messenger\SendWebhookHandler`. » *(§ SendWebhookHandler)*

**Question 63 : A, B, C** — « Adds standard headers: `Webhook-Event` (event name), `Webhook-Id` (event ID), `Webhook-Signature` (…), and `Content-Type: application/json`. » *(§ SendWebhookHandler)*

**Question 64 : B** — « Constructs the HTTP request body (JSON-encoded payload) » *(§ SendWebhookHandler)*

**Question 65 : C** — « Sends the HTTP request using the Symfony HttpClient component. » *(§ SendWebhookHandler)*

**Question 66 : B** — « By default, the signature uses HMAC-SHA256 of the concatenated event name, event ID, and JSON body. » *(§ Resulting HTTP Request)*

**Question 67 : C** — « Receiving endpoints should verify this signature using the shared secret to ensure webhook authenticity. » *(§ Resulting HTTP Request)*

**Question 68 : D** — « POST /webhook/stock HTTP/1.1 » *(§ Resulting HTTP Request)*

**Question 69 : D** — « you can implement custom sending logic using `Symfony\Component\Webhook\Server\TransportInterface`. » *(§ Custom Sending Logic)*

**Question 70 : D** — « For advanced use cases, you can implement custom sending logic using `TransportInterface` to control header generation, signing, and HTTP transport. » *(§ Custom Sending Logic)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [webhook.rst](https://github.com/symfony/symfony-docs/blob/8.0/webhook.rst)) : pas de pages annexes à couvrir pour ce QCM.
