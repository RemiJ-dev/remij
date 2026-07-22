# QCM — Le client HTTP (HttpClient)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/http_client.html](https://symfony.com/doc/8.0/http_client.html) · **Généré le :** 23 juillet 2026
>
> **157 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

> **Remarque :** page volumineuse (~2400 lignes de source), découpée en groupes de questions par grande sous-section : Installation, Basic Usage, Configuration, Making Requests, Performance, Processing Responses, Concurrent Requests, Caching Requests and Responses, Limit the Number of Requests, Consuming Server-Sent Events, Interoperability, Extensibility, Testing.

## Installation

### Question 1

Qu'est-ce que le composant HttpClient, décrit dans son introduction ? *(une seule bonne réponse)*

- [ ] **A.** Un composant de cache HTTP RFC 9111
- [ ] **B.** Un client HTTP bas niveau supportant à la fois les wrappers de flux PHP et cURL, permettant de consommer des API de façon synchrone et asynchrone
- [ ] **C.** Un client HTTP haut niveau dédié exclusivement aux appels REST JSON
- [ ] **D.** Un serveur HTTP embarqué pour les tests fonctionnels

## Basic Usage

### Question 2

Dans une application Symfony, sous quel nom de service le client HTTP est-il disponible, et comment est-il injecté ? *(une seule bonne réponse)*

- [ ] **A.** Service `http.client.default`, injecté via un tag manuel
- [ ] **B.** Service `http_client`, autowiré automatiquement via le type `HttpClientInterface`
- [ ] **C.** Service `symfony.http_client`, à injecter explicitement par son id
- [ ] **D.** Il n'existe aucun service, il faut toujours instancier `HttpClient::create()` soi-même

### Question 3

Que retourne `$response->toArray()` sur la réponse d'une requête HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Le code de statut HTTP sous forme de tableau
- [ ] **B.** Un tableau contenant à la fois le corps et les en-têtes
- [ ] **C.** Le contenu JSON de la réponse converti en tableau PHP
- [ ] **D.** Les en-têtes de la réponse sous forme de tableau

### Question 4

En dehors du framework Symfony, comment crée-t-on un client HTTP autonome ? *(une seule bonne réponse)*

- [ ] **A.** `Client::createDefault()`
- [ ] **B.** `HttpClient::create()`
- [ ] **C.** `new HttpClient()`
- [ ] **D.** `HttpClientFactory::build()`

### Question 5

Avec quelles abstractions de client HTTP courantes en PHP le composant est-il interopérable, selon l'astuce de la section Basic Usage ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement Guzzle
- [ ] **B.** Uniquement les flux natifs PHP
- [ ] **C.** Plusieurs abstractions, ce qui permet aussi de profiter de l'autowiring (détaillé dans la section Interoperability)
- [ ] **D.** Aucune, le composant impose sa propre interface incompatible avec les autres

## Configuration

### Question 6

Comment définir des options HTTP par défaut appliquées à toutes les requêtes d'un client, au niveau de la configuration Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible qu'en PHP, jamais en YAML
- [ ] **B.** Via l'option `global_options`
- [ ] **C.** Via l'option `default_options` de `framework.http_client`
- [ ] **D.** Via un fichier `http_client.yaml` dédié, distinct de `framework.yaml`

### Question 7

Que fait la méthode `withOptions()` de `HttpClientInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Elle modifie les options du client existant en place (mutation)
- [ ] **B.** Elle ne s'applique qu'à la requête suivante, puis revient aux options d'origine
- [ ] **C.** Elle supprime toutes les options par défaut sans possibilité d'en ajouter
- [ ] **D.** Elle retourne une nouvelle instance du client avec de nouvelles options par défaut

### Question 8

Quelle différence y a-t-il entre `setHeaders()` et `setHeader()` sur la classe `HttpOptions` ? *(une seule bonne réponse)*

- [ ] **A.** `setHeader()` efface tous les en-têtes précédents, `setHeaders()` n'en ajoute qu'un
- [ ] **B.** `setHeaders()` n'existe pas, seule `setHeader()` est disponible
- [ ] **C.** `setHeaders()` remplace tous les en-têtes à la fois (supprimant ceux non fournis), `setHeader()` en définit/remplace un seul
- [ ] **D.** Les deux méthodes sont strictement équivalentes

### Question 9

L'option `max_host_connections` peut-elle être surchargée au niveau d'une requête individuelle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, comme la plupart des autres options
- [ ] **B.** Oui, mais uniquement en mode debug
- [ ] **C.** Non, elle a été supprimée depuis Symfony 8.0
- [ ] **D.** Non, elle ne peut être définie qu'au niveau de la configuration globale du client

### Question 10

Quels types de réglages le client HTTP permet-il de configurer, selon l'introduction de la section Configuration ? *(plusieurs bonnes réponses)*

- [ ] **A.** La pré-résolution DNS
- [ ] **B.** Les paramètres SSL
- [ ] **C.** Le public key pinning
- [ ] **D.** Le moteur de template Twig utilisé pour le rendu des réponses

### Question 11

À quoi servent les « scoped clients » (`ScopingHttpClient`) ? *(une seule bonne réponse)*

- [ ] **A.** À restreindre le client à un seul thread d'exécution
- [ ] **B.** À forcer l'usage exclusif de cURL pour certaines URLs
- [ ] **C.** À autoconfigurer le client HTTP en fonction de l'URL demandée, quand certaines options ne doivent s'appliquer qu'à certains hôtes
- [ ] **D.** À limiter le nombre de requêtes envoyées par seconde

### Question 12

Comment un client scopé est-il configuré pour ne s'appliquer qu'aux requêtes correspondant à un certain motif d'URL ? *(une seule bonne réponse)*

- [ ] **A.** Le scope ne peut être défini que via `base_uri`, jamais via une regex
- [ ] **B.** Via l'option `scope`, une expression régulière
- [ ] **C.** Via l'option `pattern`, une glob
- [ ] **D.** Via l'option `allowed_hosts`, une liste de domaines

### Question 13

Quand plusieurs scopes sont définis et qu'une requête est faite via `request()`, comment les options passées à `request()` interagissent-elles avec celles du client scopé ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée si les deux définissent la même option
- [ ] **B.** Elles sont fusionnées avec les options par défaut du client scopé, les options de `request()` prenant précédence
- [ ] **C.** Les options de `request()` sont totalement ignorées si un client scopé est utilisé
- [ ] **D.** Les options du client scopé sont toujours prioritaires, quelles que soient celles de `request()`

### Question 14

Dans le contexte du framework Symfony, comment un client scopé est-il exposé pour être injecté par autowiring ? *(une seule bonne réponse)*

- [ ] **A.** Un seul client scopé peut être défini par application
- [ ] **B.** Les clients scopés ne sont accessibles que via le conteneur de test
- [ ] **C.** Chaque client scopé définit un alias d'autowiring nommé d'après sa configuration (ex. paramètre `$githubClient` pour le service `github.client`)
- [ ] **D.** Il faut toujours utiliser un service locator manuel, l'autowiring ne fonctionnant pas avec les clients scopés

### Question 15

Comment crée-t-on un `ScopingHttpClient` qui utilise une `base_uri` pour les URLs relatives, en dehors du framework Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `new ScopingHttpClient($client)->withBaseUri(...)`
- [ ] **B.** `HttpClient::createScoped($client, ...)`
- [ ] **C.** `ScopingHttpClient::create($client)`
- [ ] **D.** `ScopingHttpClient::forBaseUri($client, 'https://api.github.com/', [...])`

### Question 16

Que permet la classe `HttpOptions` par rapport à un simple tableau d'options ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne permet de configurer que les en-têtes, pas les autres options
- [ ] **B.** Elle remplace entièrement le tableau d'options, qui n'est plus supporté
- [ ] **C.** Elle apporte la plupart des options disponibles avec des getters/setters typés
- [ ] **D.** Elle est strictement identique à un tableau, seulement avec une syntaxe différente

## Making Requests

### Question 17

Combien de méthodes le client HTTP expose-t-il pour effectuer tous les types de requêtes HTTP (GET, POST, PUT, etc.) ? *(une seule bonne réponse)*

- [ ] **A.** Aucune méthode unifiée, chaque transport a sa propre API
- [ ] **B.** Une seule méthode `request()`, avec la méthode HTTP en premier argument
- [ ] **C.** Une méthode dédiée par verbe HTTP (`get()`, `post()`, `put()`...)
- [ ] **D.** Deux méthodes : `requestSync()` et `requestAsync()`

### Question 18

Le client HTTP de Symfony est-il synchrone ou asynchrone par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Synchrone par défaut, il faut activer explicitement le mode asynchrone
- [ ] **B.** Cela dépend uniquement du transport choisi (cURL vs natif)
- [ ] **C.** Toujours synchrone, quel que soit le transport
- [ ] **D.** Asynchrone par défaut : la requête démarre immédiatement mais `request()` ne bloque pas en attendant la réponse

### Question 19

À quel moment le code bloque-t-il réellement lors de l'utilisation du client HTTP asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, même l'accès au contenu reste non bloquant
- [ ] **B.** Uniquement lors de l'appel à `cancel()`
- [ ] **C.** Seulement quand on accède réellement aux données de la réponse (ex. `getHeaders()`, `getContent()`)
- [ ] **D.** Dès l'appel à `request()`, avant même l'envoi de la requête

### Question 20

Quels mécanismes d'authentification le client HTTP supporte-t-il nativement via des options dédiées ? *(plusieurs bonnes réponses)*

- [ ] **A.** `auth_basic` (HTTP Basic)
- [ ] **B.** `auth_bearer` (Bearer/token)
- [ ] **C.** `auth_ntlm` (NTLM Microsoft)
- [ ] **D.** `auth_oauth2` (OAuth2 intégré nativement)

### Question 21

Comment peut-on également définir une authentification HTTP Basic, sans utiliser l'option `auth_basic` ? *(une seule bonne réponse)*

- [ ] **A.** Via un cookie de session dédié
- [ ] **B.** En incluant les identifiants directement dans l'URL, ex. `http://the-username:the-password@example.com`
- [ ] **C.** Ce n'est pas possible autrement que via `auth_basic`
- [ ] **D.** En les passant en en-tête `X-Auth-Basic`

### Question 22

Quel transport est obligatoire pour utiliser l'authentification NTLM ? *(une seule bonne réponse)*

- [ ] **A.** Le transport natif PHP streams
- [ ] **B.** `AmpHttpClient`
- [ ] **C.** N'importe quel transport, NTLM étant indépendant du transport
- [ ] **D.** Le transport cURL

### Question 23

Pourquoi la documentation recommande-t-elle d'utiliser `HttpClient::createForBaseUri()` lorsqu'on configure une authentification ? *(une seule bonne réponse)*

- [ ] **A.** Pour forcer HTTP/2 sur toutes les requêtes
- [ ] **B.** Pour garantir que les identifiants d'authentification ne soient envoyés qu'à l'hôte de cette base URI, pas à d'autres hôtes
- [ ] **C.** Parce que `createForBaseUri()` est la seule méthode supportant `auth_basic`
- [ ] **D.** Pour activer automatiquement le cache des réponses

### Question 24

Comment ajouter des paramètres de query string à une requête sans les concaténer manuellement dans l'URL ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, il faut toujours les inclure manuellement dans l'URL
- [ ] **B.** Via l'option `body`, comme pour les requêtes POST
- [ ] **C.** Via l'option `query`, un tableau associatif automatiquement encodé et fusionné à l'URL
- [ ] **D.** Via l'option `params`, qui remplace entièrement l'URL

### Question 25

Comment définir des en-têtes par défaut appliqués à toutes les requêtes d'un client ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, seuls les en-têtes HTTP standards sont envoyés
- [ ] **B.** Via l'option `headers` du client (ex. dans `default_options` ou `HttpClient::create()`)
- [ ] **C.** Uniquement au niveau de chaque appel à `request()`, jamais globalement
- [ ] **D.** Via un fichier `headers.yaml` séparé

### Question 26

Si un en-tête est défini à la fois globalement (sur le client) et pour une requête spécifique, lequel est utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Celui défini globalement, qui ne peut jamais être surchargé
- [ ] **B.** Les deux valeurs sont concaténées automatiquement
- [ ] **C.** Une exception est levée en cas de conflit
- [ ] **D.** Celui défini pour la requête spécifique, qui prend le dessus sur la valeur globale

### Question 27

Quels types de valeurs peut prendre l'option `body` pour envoyer des données ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une chaîne de caractères brute
- [ ] **B.** Une closure générant les données
- [ ] **C.** Une ressource de flux (ex. `fopen()`)
- [ ] **D.** Un objet `DateTime`, converti automatiquement en timestamp

### Question 28

Lors d'une requête POST sans en-tête Content-Type explicite, que fait Symfony par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il envoie toujours `Content-Type: application/json` par défaut
- [ ] **B.** Il laisse le Content-Type vide, laissant le serveur deviner
- [ ] **C.** Il suppose que l'on envoie des données de formulaire et ajoute `Content-Type: application/x-www-form-urlencoded`
- [ ] **D.** Il refuse d'envoyer la requête tant que le Content-Type n'est pas précisé

### Question 29

Quand l'option `body` est une closure, quand celle-ci cesse-t-elle d'être appelée ? *(une seule bonne réponse)*

- [ ] **A.** Après exactement un seul appel
- [ ] **B.** Elle est appelée en boucle infinie tant que la connexion est ouverte
- [ ] **C.** Dès qu'elle retourne `null`
- [ ] **D.** Quand elle retourne une chaîne vide, signalant la fin du corps

### Question 30

Que fait l'option `json`, par rapport à `body` ? *(une seule bonne réponse)*

- [ ] **A.** Elle est strictement identique à `body`, juste un alias
- [ ] **B.** Elle nécessite d'encoder soi-même le contenu au préalable avec `json_encode()`
- [ ] **C.** Elle encode automatiquement le contenu donné en JSON et ajoute l'en-tête `Content-Type: application/json`
- [ ] **D.** Elle ne fait qu'ajouter l'en-tête Content-Type, sans encoder le contenu

### Question 31

Lors d'un envoi de fichier via un handle `fopen()` dans l'option `body`, que se passe-t-il par défaut concernant le nom de fichier et le content-type ? *(une seule bonne réponse)*

- [ ] **A.** Ils doivent toujours être précisés manuellement, aucune valeur par défaut n'existe
- [ ] **B.** Le nom de fichier est toujours `"upload.bin"`, quel que soit le fichier réel
- [ ] **C.** Le content-type est toujours `text/plain` par défaut
- [ ] **D.** Ils sont automatiquement déduits des données du fichier ouvert, mais peuvent être configurés via `stream_context_set_option()`

### Question 32

Que fait `FormDataPart` lorsqu'on lui passe un tableau multidimensionnel comme valeur d'un champ ? *(une seule bonne réponse)*

- [ ] **A.** Elle fusionne toutes les valeurs en une seule chaîne séparée par des virgules
- [ ] **B.** Elle ignore silencieusement les valeurs au-delà de la première
- [ ] **C.** Elle ajoute automatiquement `[key]` au nom du champ pour chaque valeur (ex. `array_field[0]`, `array_field[1]`)
- [ ] **D.** Elle lève une exception, les tableaux multidimensionnels n'étant pas supportés

### Question 33

Pourquoi peut-il être nécessaire de convertir le corps de la requête en chaîne via `bodyToString()`, au prix d'une consommation mémoire plus élevée ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les closures ne peuvent jamais être utilisées comme source de données
- [ ] **B.** Par défaut, HttpClient streame le contenu du corps, ce qui peut causer une erreur 411 « Length Required » sur certains serveurs faute d'en-tête Content-Length
- [ ] **C.** Parce que le streaming du corps est totalement désactivé depuis Symfony 8.0
- [ ] **D.** Parce que `bodyToString()` est la seule façon de définir des en-têtes personnalisés

### Question 34

Pourquoi le composant HttpClient ne gère-t-il pas automatiquement les cookies ? *(une seule bonne réponse)*

- [ ] **A.** Parce que cela poserait un problème de sécurité insurmontable
- [ ] **B.** Parce que le client est sans état (stateless), alors que la gestion des cookies nécessite un stockage avec état
- [ ] **C.** Parce que les cookies sont un concept obsolète non supporté par les API modernes
- [ ] **D.** Parce que cURL ne supporte pas les cookies

### Question 35

Quelles sont les deux façons proposées pour gérer les cookies avec HttpClient ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser la session PHP native, seule option supportée
- [ ] **B.** Utiliser le composant BrowserKit, ou définir manuellement l'en-tête HTTP `Cookie`
- [ ] **C.** Utiliser exclusivement un cookie jar automatique fourni par cURL
- [ ] **D.** Ce n'est possible qu'en désactivant le mode asynchrone

### Question 36

Par défaut, combien de redirections le client HTTP suit-il au maximum ? *(une seule bonne réponse)*

- [ ] **A.** 5
- [ ] **B.** 0 (aucune redirection suivie par défaut)
- [ ] **C.** Il n'y a aucune limite par défaut
- [ ] **D.** 20

### Question 37

Que se passe-t-il si l'on positionne `max_redirects` à `0` ? *(une seule bonne réponse)*

- [ ] **A.** Cela désactive uniquement les redirections HTTPS vers HTTP
- [ ] **B.** Aucune redirection n'est suivie
- [ ] **C.** Le nombre maximal de redirections passe à l'infini
- [ ] **D.** La requête échoue immédiatement avec une erreur

### Question 38

Par défaut, combien de fois une requête échouée est-elle retentée par le client HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Jusqu'à 5 fois
- [ ] **B.** Aucune retentative par défaut, il faut toujours l'activer explicitement
- [ ] **C.** Jusqu'à 3 fois
- [ ] **D.** Une seule fois

### Question 39

Quel type de délai est appliqué entre les tentatives par défaut (ex. 1s puis 4s) ? *(une seule bonne réponse)*

- [ ] **A.** Aucun délai, les tentatives sont immédiates
- [ ] **B.** Un délai exponentiel
- [ ] **C.** Un délai fixe identique entre chaque tentative
- [ ] **D.** Un délai aléatoire sans logique particulière

### Question 40

Pour quels codes de statut HTTP une requête est-elle retentée par défaut, quelle que soit la méthode HTTP utilisée ? *(plusieurs bonnes réponses)*

- [ ] **A.** 423
- [ ] **B.** 425
- [ ] **C.** 429, 502, 503
- [ ] **D.** 404 (Not Found)

### Question 41

Les codes 500, 504, 507 et 510 déclenchent-ils une retentative automatique pour n'importe quelle méthode HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Non, ces codes ne déclenchent jamais de retentative
- [ ] **B.** Cela dépend uniquement du transport (cURL vs natif)
- [ ] **C.** Non, uniquement lorsque la méthode HTTP utilisée est idempotente
- [ ] **D.** Oui, pour toutes les méthodes sans exception

### Question 42

En dehors du framework Symfony, quelle classe faut-il utiliser pour ajouter la fonctionnalité de retry à un client HTTP ? *(une seule bonne réponse)*

- [ ] **A.** `AutoRetryHttpClient`
- [ ] **B.** `RetryableHttpClient`, en décorant le client d'origine
- [ ] **C.** `RetryHttpClient`
- [ ] **D.** Il faut réimplémenter soi-même la logique de retry, aucune classe n'étant fournie

### Question 43

Que permet de faire la fonctionnalité « Retry Over Several Base URIs » de `RetryableHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** Envoyer la même requête simultanément à plusieurs URIs et garder la première réponse reçue
- [ ] **B.** Répartir aléatoirement chaque nouvelle requête entre toutes les URIs, sans lien avec les échecs précédents
- [ ] **C.** Limiter le nombre total de `base_uri` utilisables à deux
- [ ] **D.** Utiliser plusieurs `base_uri` : si la requête échoue avec la première, la suivante est utilisée pour la retentative

### Question 44

Comment demander que l'ordre des base URIs soit mélangé (aléatoire) à chaque tentative de retry ? *(une seule bonne réponse)*

- [ ] **A.** En listant les URIs dans un ordre alphabétique inverse
- [ ] **B.** En imbriquant les URIs à mélanger dans un tableau supplémentaire (tableau imbriqué)
- [ ] **C.** Ce n'est pas possible, l'ordre est toujours figé
- [ ] **D.** En utilisant l'option `shuffle_base_uri` à `true`

### Question 45

Par défaut, comment le client HTTP détermine-t-il le proxy à utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Il utilise toujours un proxy Symfony intégré
- [ ] **B.** Il ignore systématiquement tout proxy configuré au niveau système
- [ ] **C.** Il honore les variables d'environnement standard du système d'exploitation
- [ ] **D.** Il faut toujours configurer explicitement un proxy, sinon aucune requête ne fonctionne

### Question 46

Quelles options permettent de surcharger le comportement des variables d'environnement de proxy ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucune option pour surcharger cela
- [ ] **B.** `proxy` et `no_proxy`
- [ ] **C.** `http_proxy` et `https_proxy` uniquement en PHP
- [ ] **D.** `proxy_url`, sans option d'exclusion possible

### Question 47

À quels moments l'appel `on_progress` est-il garanti d'être déclenché ? *(plusieurs bonnes réponses)*

- [ ] **A.** Lors de la résolution DNS
- [ ] **B.** À l'arrivée des en-têtes
- [ ] **C.** À la complétion de la requête
- [ ] **D.** Uniquement au tout début, jamais pendant le transfert

### Question 48

À quelle fréquence minimale le callback `on_progress` est-il appelé pendant le transfert de données ? *(une seule bonne réponse)*

- [ ] **A.** Une seule fois, au tout début
- [ ] **B.** Il n'y a aucune garantie de fréquence
- [ ] **C.** Au moins une fois par seconde
- [ ] **D.** Au moins une fois par minute

### Question 49

Que se passe-t-il si une exception est levée depuis le callback `on_progress` ? *(une seule bonne réponse)*

- [ ] **A.** Elle est loggée mais la requête continue normalement
- [ ] **B.** Elle est enveloppée dans une `TransportExceptionInterface` et la requête est annulée
- [ ] **C.** Elle est silencieusement ignorée
- [ ] **D.** Elle interrompt tout le processus PHP (fatal error)

### Question 50

Le client HTTP valide-t-il les certificats SSL de la même façon qu'un navigateur ? *(une seule bonne réponse)*

- [ ] **A.** Oui, exactement de la même façon
- [ ] **B.** Non, il ne valide jamais les certificats SSL
- [ ] **C.** Cela dépend uniquement du système d'exploitation, jamais du composant
- [ ] **D.** Non, il utilise le magasin de certificats du système, alors que les navigateurs utilisent leur propre magasin

### Question 51

Que permettent de faire les options `verify_host` et `verify_peer`, et est-ce recommandé en production ? *(une seule bonne réponse)*

- [ ] **A.** Elles ne concernent que le transport cURL, jamais les autres transports
- [ ] **B.** Désactiver la vérification SSL ; ce n'est pas recommandé en production
- [ ] **C.** Activer une vérification SSL renforcée ; recommandé systématiquement
- [ ] **D.** Ces options n'existent pas dans HttpClient

### Question 52

Que permet une attaque SSRF (Server-Side Request Forgery) ? *(une seule bonne réponse)*

- [ ] **A.** Intercepter le trafic HTTPS via un certificat falsifié
- [ ] **B.** Épuiser la mémoire du serveur via des réponses volumineuses
- [ ] **C.** Inciter l'application backend à faire des requêtes HTTP vers un domaine arbitraire, y compris des hôtes/IP internes
- [ ] **D.** Injecter du code SQL via les en-têtes HTTP

### Question 53

Quelle classe est recommandée pour se protéger des attaques SSRF lorsqu'on utilise des URIs fournies par l'utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** `ValidatingHttpClient`
- [ ] **B.** `NoPrivateNetworkHttpClient`, qui rend les réseaux locaux inaccessibles par défaut
- [ ] **C.** `SecureHttpClient`
- [ ] **D.** `SSRFProtectedHttpClient`

### Question 54

Que permet le second argument optionnel du constructeur de `NoPrivateNetworkHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** Définir un timeout spécifique pour les requêtes bloquées
- [ ] **B.** Activer un mode de journalisation détaillé des tentatives bloquées
- [ ] **C.** Désactiver totalement la protection SSRF
- [ ] **D.** Définir les réseaux (ex. une plage d'IP) à bloquer spécifiquement, en plus/à la place des réseaux privés par défaut

### Question 55

Comment éviter que `TraceableHttpClient` ne garde le contenu complet des réponses en mémoire, au risque de l'épuiser ? *(une seule bonne réponse)*

- [ ] **A.** En désactivant complètement le profiler Symfony
- [ ] **B.** Ce comportement ne peut pas être désactivé
- [ ] **C.** En utilisant `CurlHttpClient` à la place de `TraceableHttpClient`
- [ ] **D.** En positionnant l'option `extra.trace_content` à `false`

### Question 56

Sur quelle RFC se basent les URI Templates supportés par `UriTemplateHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** RFC 3986
- [ ] **B.** RFC 6570
- [ ] **C.** RFC 9111
- [ ] **D.** RFC 7230

### Question 57

Que faut-il installer avant de pouvoir utiliser les URI templates, en plus du composant HttpClient lui-même ? *(une seule bonne réponse)*

- [ ] **A.** Rien, cette fonctionnalité est incluse nativement sans dépendance
- [ ] **B.** Le composant Routing, obligatoire pour toute URL templatée
- [ ] **C.** Le composant Serializer
- [ ] **D.** Un package tiers d'expansion d'URI template (ex. `league/uri`, `guzzlehttp/uri-template` ou `rize/uri-template`)

### Question 58

Dans le contexte du framework Symfony, la fonctionnalité URI template est-elle activée par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut explicitement décorer chaque client soi-même
- [ ] **B.** Non, cette fonctionnalité n'est disponible qu'en utilisant le client de façon autonome (hors framework)
- [ ] **C.** Oui, mais uniquement pour le client par défaut, jamais pour les clients scopés
- [ ] **D.** Oui, tous les clients HTTP existants sont décorés par `UriTemplateHttpClient` automatiquement

### Question 59

Comment définir des variables globalement substituées dans tous les URI templates de l'application ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible qu'au niveau de chaque appel à `request()`
- [ ] **B.** Via une variable d'environnement `URI_TEMPLATE_VARS`
- [ ] **C.** Via l'option `vars` de `default_options`
- [ ] **D.** Via un fichier `uri_templates.yaml` séparé

### Question 60

Comment redéfinir la logique de résolution des variables d'URI template avec sa propre implémentation ? *(une seule bonne réponse)*

- [ ] **A.** En sous-classant `HttpClient` directement
- [ ] **B.** En implémentant l'interface `UriTemplateExpanderInterface` et en la déclarant comme service prioritaire, sans alias
- [ ] **C.** En redéfinissant l'alias de service `http_client.uri_template_expander`, qui doit être invokable
- [ ] **D.** Ce n'est pas possible, la logique est figée

## Performance

### Question 61

Que permet la conception du composant HttpClient, même pour des appels synchrones classiques ? *(une seule bonne réponse)*

- [ ] **A.** Compresser systématiquement toutes les requêtes sortantes
- [ ] **B.** Mettre en cache automatiquement toutes les réponses, sans configuration
- [ ] **C.** Convertir automatiquement toutes les requêtes synchrones en requêtes asynchrones stockées en file d'attente
- [ ] **D.** Garder les connexions ouvertes vers les hôtes distants entre les requêtes, économisant la résolution DNS et la négociation SSL répétées

### Question 62

Quelle extension PHP est nécessaire pour profiter de tous les bénéfices de conception du composant (HTTP/2, multiplexage) ? *(une seule bonne réponse)*

- [ ] **A.** L'extension OpenSSL
- [ ] **B.** L'extension Zlib
- [ ] **C.** L'extension mbstring
- [ ] **D.** L'extension cURL

### Question 63

Quels trois mécanismes le composant peut-il utiliser pour effectuer des requêtes HTTP ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les flux natifs PHP
- [ ] **B.** cURL
- [ ] **C.** Le package `amphp/http-client`
- [ ] **D.** Le protocole WebSocket

### Question 64

Le support HTTP/2 est-il disponible avec les flux natifs PHP seuls ? *(une seule bonne réponse)*

- [ ] **A.** Non, HTTP/2 n'est supporté par aucun transport de ce composant
- [ ] **B.** Oui, mais uniquement depuis Symfony 8.0
- [ ] **C.** Non, HTTP/2 n'est supporté qu'en utilisant cURL ou `amphp/http-client`
- [ ] **D.** Oui, tous les transports supportent HTTP/2 de façon identique

### Question 65

Quel ordre de sélection `HttpClient::create()` suit-il pour choisir le transport ? *(une seule bonne réponse)*

- [ ] **A.** Toujours `AmpHttpClient`, quelle que soit la disponibilité de cURL
- [ ] **B.** L'ordre est aléatoire à chaque appel
- [ ] **C.** cURL en priorité s'il est activé, sinon `AmpHttpClient`, sinon les flux natifs PHP
- [ ] **D.** Toujours les flux natifs PHP en premier, cURL en dernier recours

### Question 66

Depuis Symfony 8.0, quelle version minimale du package `amphp/http-client` est requise ? *(une seule bonne réponse)*

- [ ] **A.** 1.0
- [ ] **B.** 5.3.2
- [ ] **C.** 4.2
- [ ] **D.** 3.0

### Question 67

Dans une application Symfony full-stack, ce choix de transport est-il configurable manuellement ? *(une seule bonne réponse)*

- [ ] **A.** Non, seul `AmpHttpClient` est utilisable dans le framework
- [ ] **B.** Oui, mais uniquement via une variable d'environnement `HTTPCLIENT_TRANSPORT`
- [ ] **C.** Non, cURL est utilisé automatiquement s'il est disponible, avec les mêmes règles de repli
- [ ] **D.** Oui, entièrement configurable via `framework.http_client.transport`

### Question 68

Comment passer des options cURL brutes (ex. `CURLOPT_IPRESOLVE`) à une requête utilisant `CurlHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** En sous-classant obligatoirement `CurlHttpClient`
- [ ] **B.** Via l'option `extra.curl` du tableau d'options de la requête
- [ ] **C.** Ce n'est jamais possible, seules les options abstraites du composant sont disponibles
- [ ] **D.** Via une variable globale `$curlOptions`

### Question 69

Que se passe-t-il si l'on tente de surcharger une option cURL impossible à modifier (ex. pour des raisons de thread-safety) ? *(une seule bonne réponse)*

- [ ] **A.** L'option est appliquée mais sans effet visible
- [ ] **B.** Une exception est levée
- [ ] **C.** L'option est silencieusement ignorée
- [ ] **D.** Le processus PHP plante immédiatement (segfault)

### Question 70

Sous quelles conditions l'en-tête `Accept-Encoding: gzip` est-il ajouté automatiquement ? *(plusieurs bonnes réponses)*

- [ ] **A.** cURL compilé avec le support ZLib
- [ ] **B.** L'extension PHP Zlib installée, pour le client natif
- [ ] **C.** Uniquement si l'utilisateur l'active explicitement via une option `compression: true`
- [ ] **D.** Jamais automatiquement, il faut toujours l'ajouter manuellement

### Question 71

Comment désactiver la compression HTTP des réponses ? *(une seule bonne réponse)*

- [ ] **A.** En désinstallant l'extension Zlib, seule méthode possible
- [ ] **B.** Ce n'est pas configurable
- [ ] **C.** En passant l'option `compression` à `false`
- [ ] **D.** En envoyant un en-tête `Accept-Encoding: identity`

### Question 72

Que se passe-t-il si l'on définit soi-même l'en-tête `Accept-Encoding` (ex. à `gzip`) ? *(une seule bonne réponse)*

- [ ] **A.** Le client décompresse toujours automatiquement, quel que soit l'en-tête défini
- [ ] **B.** Cela lève systématiquement une exception
- [ ] **C.** L'en-tête personnalisé est ignoré au profit du comportement par défaut
- [ ] **D.** Il faut alors gérer soi-même la décompression de la réponse

### Question 73

HTTP/2 est-il activé par défaut pour les URLs en https ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, indépendamment des outils installés
- [ ] **B.** Non, HTTP/2 n'est jamais supporté par ce composant
- [ ] **C.** Oui, si un outil compatible est installé (libcurl >= 7.36 ou `amphp/http-client` >= 4.2)
- [ ] **D.** Non, il faut toujours l'activer explicitement quel que soit le protocole

### Question 74

Comment forcer HTTP/2 pour des URLs en http (non sécurisées) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, HTTP/2 nécessite obligatoirement HTTPS
- [ ] **B.** En installant uniquement libcurl, sans autre configuration
- [ ] **C.** Via l'option `force_http2` à `true`
- [ ] **D.** En définissant explicitement l'option `http_version` à `'2.0'`

### Question 75

Comment fonctionne le support HTTP/2 PUSH avec un client compatible ? *(une seule bonne réponse)*

- [ ] **A.** HTTP/2 PUSH n'est jamais supporté par ce composant
- [ ] **B.** Les réponses poussées sont toujours ignorées par défaut
- [ ] **C.** Automatiquement : les réponses poussées sont mises dans un cache temporaire et utilisées lors d'une requête ultérieure correspondante
- [ ] **D.** Il faut explicitement activer PUSH via une option dédiée à chaque requête

## Processing Responses

### Question 76

Comment les noms d'en-têtes sont-ils formatés dans le tableau retourné par `getHeaders()` ? *(une seule bonne réponse)*

- [ ] **A.** Dans la casse Titre (Title-Case)
- [ ] **B.** En minuscules
- [ ] **C.** En majuscules
- [ ] **D.** Tels qu'envoyés par le serveur, sans transformation

### Question 77

Que retourne `getInfo()` sur un objet réponse ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le code de statut HTTP
- [ ] **B.** Le corps de la réponse converti en tableau
- [ ] **C.** La liste des en-têtes de la requête envoyée, jamais ceux de la réponse
- [ ] **D.** Des informations issues de la couche transport (`response_headers`, `redirect_count`, `start_time`, `redirect_url`, etc.)

### Question 78

L'appel à `getInfo()` est-il bloquant ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend du transport utilisé (cURL bloque, natif ne bloque pas)
- [ ] **B.** Non, il est non-bloquant et retourne des informations en direct (certaines pouvant être encore inconnues)
- [ ] **C.** Oui, il attend toujours la fin complète de la requête
- [ ] **D.** Oui, mais uniquement pour les requêtes HTTP/2

### Question 79

À quoi sert l'élément spécial `"pause_handler"` de `getInfo()` ? *(une seule bonne réponse)*

- [ ] **A.** Il retourne le temps total écoulé depuis le début de la requête
- [ ] **B.** Il force la requête à devenir synchrone
- [ ] **C.** C'est un callable permettant de retarder la requête pendant un nombre de secondes donné (utile pour retarder des retries, limiter le débit, etc.)
- [ ] **D.** Il permet d'annuler définitivement la requête

### Question 80

À quelle interface appartient la méthode `toStream()` de la réponse ? *(une seule bonne réponse)*

- [ ] **A.** `StreamWrapperInterface`
- [ ] **B.** `ChunkInterface`
- [ ] **C.** `StreamableInterface`
- [ ] **D.** `ResponseInterface` uniquement, sans interface dédiée

### Question 81

Comment obtenir une information individuelle (ex. l'URL finale après redirections) plutôt que toutes les infos de transport ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seul le tableau complet est accessible
- [ ] **B.** Via une méthode dédiée `getUrl()`, distincte de `getInfo()`
- [ ] **C.** En passant la clé souhaitée en argument de `getInfo()`, ex. `getInfo('url')`
- [ ] **D.** En parsant manuellement le résultat complet de `getInfo()`

### Question 82

Que retourne concrètement `$response->toArray()` par rapport à `getContent()` ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau contenant le code de statut et les en-têtes uniquement
- [ ] **B.** Le contenu JSON de la réponse casté en tableau PHP, alors que `getContent()` retourne une chaîne brute
- [ ] **C.** Exactement la même chose que `getContent()`, sous un nom différent
- [ ] **D.** Uniquement les en-têtes, jamais le corps

### Question 83

Que retourne la méthode `stream()` du client HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Un flux binaire non exploitable directement en PHP
- [ ] **B.** Les morceaux (chunks) de la réponse de façon séquentielle, au lieu d'attendre la réponse complète
- [ ] **C.** Toujours la réponse complète d'un coup, comme `getContent()`
- [ ] **D.** Uniquement les en-têtes de la réponse

### Question 84

Que signifie le fait que les réponses soient « lazy » (paresseuses) dans ce contexte ? *(une seule bonne réponse)*

- [ ] **A.** Le serveur retarde volontairement l'envoi de la réponse
- [ ] **B.** Cela signifie que la requête est mise en file d'attente indéfiniment
- [ ] **C.** Le code peut s'exécuter dès que les en-têtes sont reçus, sans attendre le corps complet
- [ ] **D.** La réponse n'est jamais réellement envoyée tant qu'on ne l'exige pas explicitement

### Question 85

Quels types de corps de réponse sont mis en buffer par défaut dans un flux `php://temp` local ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les réponses JSON
- [ ] **B.** Toutes les réponses, sans exception, quel que soit leur Content-Type
- [ ] **C.** Aucune réponse n'est mise en buffer par défaut
- [ ] **D.** `text/*`, JSON et XML

### Question 86

Quelles sont les deux façons d'annuler une requête en cours ? *(plusieurs bonnes réponses)*

- [ ] **A.** Appeler `$response->cancel()`
- [ ] **B.** Lever une exception depuis le callback `on_progress`
- [ ] **C.** Fermer manuellement la connexion TCP depuis PHP
- [ ] **D.** Désinstaller l'extension cURL en cours d'exécution

### Question 87

Comment vérifier après coup qu'une réponse a bien été annulée via `cancel()` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucun moyen de le vérifier après coup
- [ ] **B.** `$response->getInfo('canceled')` retourne `true`
- [ ] **C.** `$response->getStatusCode()` retourne `0`
- [ ] **D.** Une exception `CanceledException` est systématiquement levée immédiatement

### Question 88

Quels sont les trois types d'exceptions possibles lors de l'utilisation du client HTTP, qui implémentent tous `ExceptionInterface` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `HttpExceptionInterface` (codes de statut 300-599 non gérés)
- [ ] **B.** `TransportExceptionInterface` (problème de niveau inférieur, réseau)
- [ ] **C.** `DecodingExceptionInterface` (contenu impossible à décoder dans le format attendu)
- [ ] **D.** `ValidationExceptionInterface` (échec de validation des données du formulaire)

### Question 89

Que se passe-t-il par défaut si le code de statut HTTP est dans la plage 300-599 et qu'on appelle `getContent()` ? *(une seule bonne réponse)*

- [ ] **A.** Rien de spécial, le contenu est retourné normalement quel que soit le code
- [ ] **B.** Une exception fatale PHP interrompt le script
- [ ] **C.** Une exception implémentant `HttpExceptionInterface` est levée
- [ ] **D.** La méthode retourne simplement une chaîne vide

### Question 90

Comment désactiver ce comportement d'exception automatique pour un appel donné (ex. `getHeaders()`) ? *(une seule bonne réponse)*

- [ ] **A.** En catchant simplement l'exception, sans autre changement de code
- [ ] **B.** En passant `false` comme argument optionnel, ex. `$response->getHeaders(false)`
- [ ] **C.** Ce comportement ne peut jamais être désactivé
- [ ] **D.** En appelant d'abord `$response->disableExceptions()`

### Question 91

Si aucune des trois méthodes (`getHeaders`/`getContent`/`toArray`) n'est appelée du tout, l'exception peut-elle quand même être levée ? *(une seule bonne réponse)*

- [ ] **A.** Non, dans ce cas l'erreur est totalement silencieuse
- [ ] **B.** Oui, mais uniquement si l'on active un mode strict spécifique
- [ ] **C.** Oui, elle sera levée lors de la destruction de l'objet `$response`
- [ ] **D.** Non, l'exception ne peut être levée que par un appel explicite à l'une de ces méthodes

### Question 92

Quel appel simple permet de désactiver ce comportement de vérification au moment de la destruction (tout en devant vérifier soi-même le code de statut) ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `$response->getInfo()`
- [ ] **B.** Appeler `$response->cancel()`
- [ ] **C.** Aucun appel ne permet de désactiver ce comportement
- [ ] **D.** Appeler `$response->getStatusCode()`

### Question 93

Que se passe-t-il si l'on stocke plusieurs réponses non consommées dans un tableau puis qu'on fait `unset($responses)` ? *(une seule bonne réponse)*

- [ ] **A.** Seule la première réponse du tableau est réellement traitée
- [ ] **B.** Le destructeur de toutes les réponses est déclenché, elles se complètent de façon concurrente et une exception peut être levée en cas de code 300-599
- [ ] **C.** Rien, les réponses sont simplement libérées sans jamais avoir été envoyées
- [ ] **D.** Cela lève systématiquement une exception, quel que soit le code de statut

## Concurrent Requests

### Question 94

Faut-il configurer quelque chose de spécial pour envoyer plusieurs requêtes HTTP en parallèle avec ce client ? *(une seule bonne réponse)*

- [ ] **A.** Non, mais uniquement si l'on utilise cURL comme transport
- [ ] **B.** Non, le client est asynchrone par défaut, aucune configuration spéciale n'est nécessaire
- [ ] **C.** Oui, il faut activer explicitement l'option `concurrent: true`
- [ ] **D.** Oui, il faut obligatoirement utiliser un Promise/async wrapper tiers

### Question 95

Quelle est la clé pour obtenir une exécution vraiment parallèle et concurrente des requêtes ? *(une seule bonne réponse)*

- [ ] **A.** Toujours utiliser le transport natif PHP, jamais cURL
- [ ] **B.** Envoyer (dispatch) toutes les requêtes d'abord, puis lire leurs réponses ensuite
- [ ] **C.** Lire chaque réponse immédiatement après avoir envoyé sa requête, dans la même itération
- [ ] **D.** Utiliser un seul appel à `request()` avec un tableau d'URLs

### Question 96

Quel est le nombre maximal de connexions concurrentes ouvertes par hôte, par défaut ? *(une seule bonne réponse)*

- [ ] **A.** 20
- [ ] **B.** Il n'y a aucune limite par défaut
- [ ] **C.** 6
- [ ] **D.** 1

### Question 97

Pourquoi utiliser `stream()` avec une liste de réponses plutôt qu'une simple boucle `foreach` classique pour un traitement pleinement asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `stream()` est plus rapide en termes de bande passante réseau
- [ ] **B.** Parce que `foreach` ne peut traiter qu'une seule réponse à la fois, jamais plusieurs
- [ ] **C.** Parce que `stream()` retourne les chunks au fur et à mesure de leur arrivée réseau, dans n'importe quel ordre, permettant un traitement vraiment asynchrone
- [ ] **D.** Parce que `foreach` ne fonctionne pas du tout avec des tableaux de réponses

### Question 98

À quoi servent l'option `user_data` et `$response->getInfo('user_data')` ? *(une seule bonne réponse)*

- [ ] **A.** À définir des en-têtes personnalisés supplémentaires
- [ ] **B.** À forcer un identifiant de session utilisateur dans chaque requête
- [ ] **C.** À identifier chaque réponse individuellement pendant le streaming
- [ ] **D.** À stocker le contenu brut de la réponse

### Question 99

Que configure l'option `timeout` d'une requête ? *(une seule bonne réponse)*

- [ ] **A.** Le temps total maximum autorisé pour toute la requête/réponse, quelle que soit l'activité
- [ ] **B.** Le délai avant la première tentative de connexion uniquement
- [ ] **C.** Le délai maximum de mise en cache de la réponse
- [ ] **D.** Le temps maximum d'inactivité de la transaction HTTP (ex. résolution DNS, connexion TCP, pause de contenu) avant qu'une exception ne soit levée

### Question 100

Quelle option PHP ini est utilisée si l'option `timeout` n'est pas définie explicitement ? *(une seule bonne réponse)*

- [ ] **A.** `max_execution_time`
- [ ] **B.** `default_charset`
- [ ] **C.** Il n'existe aucune valeur par défaut, une exception est levée immédiatement
- [ ] **D.** `default_socket_timeout`

### Question 101

Comment surveiller plusieurs réponses à la fois avec un même timeout de groupe ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, chaque réponse doit avoir son propre timeout individuel
- [ ] **B.** En définissant l'option `group_timeout` au niveau du client
- [ ] **C.** En utilisant obligatoirement `CachingHttpClient`
- [ ] **D.** En passant ce timeout comme second argument de la méthode `stream()`

### Question 102

Quelle option permet de limiter la durée totale que peut prendre une requête/réponse complète, indépendamment des périodes d'inactivité ? *(une seule bonne réponse)*

- [ ] **A.** `ttl`
- [ ] **B.** `max_duration`
- [ ] **C.** `timeout`
- [ ] **D.** `max_redirects`

### Question 103

Sous quelle forme les erreurs réseau (pipe cassé, échec de résolution DNS, etc.) sont-elles levées ? *(une seule bonne réponse)*

- [ ] **A.** Elles ne sont jamais levées, seulement loggées silencieusement
- [ ] **B.** Comme des instances de `TransportExceptionInterface`
- [ ] **C.** Comme des erreurs PHP fatales non catchables
- [ ] **D.** Comme des instances de `HttpExceptionInterface`

### Question 104

Pourquoi faut-il envelopper non seulement l'appel à `request()` mais aussi les appels sur l'objet réponse retourné dans un bloc try/catch ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `request()` ne peut jamais lever d'exception, contrairement aux méthodes de la réponse
- [ ] **B.** Ce n'est utile qu'en mode synchrone, jamais en mode asynchrone
- [ ] **C.** Ce n'est jamais nécessaire, toutes les erreurs sont silencieuses
- [ ] **D.** Parce que les réponses sont « lazy » : une erreur réseau peut survenir même lors d'un appel ultérieur comme `getStatusCode()`

### Question 105

`getInfo()` peut-il lever une exception réseau ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement pour les requêtes utilisant HTTP/2
- [ ] **B.** Cela dépend uniquement du transport utilisé
- [ ] **C.** Non, par conception, comme il est non-bloquant, il ne devrait pas lever d'exception
- [ ] **D.** Oui, systématiquement à chaque appel

## Caching Requests and Responses

### Question 106

Sur quelle RFC se base le mécanisme de mise en cache HTTP fourni par `CachingHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** RFC 2616
- [ ] **B.** RFC 9111
- [ ] **C.** RFC 6570
- [ ] **D.** RFC 7234 (ancienne RFC HTTP caching, remplacée)

### Question 107

De quel composant `CachingHttpClient` dépend-il en interne pour stocker les réponses en cache ? *(une seule bonne réponse)*

- [ ] **A.** Aucun, il utilise un stockage en mémoire interne propriétaire
- [ ] **B.** Le composant Lock
- [ ] **C.** Le composant Cache, via une interface de cache tag-aware
- [ ] **D.** Le composant Serializer

### Question 108

Le mécanisme de cache de `CachingHttpClient` est-il synchrone ou asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Le cache n'est jamais rempli automatiquement, il faut toujours l'écrire manuellement
- [ ] **B.** Asynchrone : la réponse doit être entièrement consommée (ex. via `getContent()` ou un stream) pour être stockée en cache
- [ ] **C.** Synchrone : la réponse est mise en cache dès réception des en-têtes, sans attendre le corps
- [ ] **D.** Cela dépend uniquement de l'adaptateur de cache configuré

### Question 109

Comment configurer le pool de cache utilisé par un client scopé pour la mise en cache HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est configurable qu'en PHP, jamais en YAML
- [ ] **B.** Le pool de cache est toujours celui par défaut de l'application, non configurable
- [ ] **C.** Via l'option `caching.cache_pool` du client scopé
- [ ] **D.** Via une variable d'environnement `CACHE_POOL_HTTP`

### Question 110

Que recommande fortement la documentation de configurer en complément de `CachingHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** Un client scopé dédié exclusivement au cache
- [ ] **B.** La désactivation complète des redirections
- [ ] **C.** Une stratégie de retry, pour gérer les incohérences temporaires du cache ou les échecs de validation
- [ ] **D.** Un rate limiter, pour éviter de saturer le cache

## Limit the Number of Requests

### Question 111

Que permet de faire le décorateur `ThrottlingHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** Mettre en cache automatiquement les réponses selon une politique TTL
- [ ] **B.** Bloquer complètement les requêtes vers les réseaux privés
- [ ] **C.** Compresser automatiquement les requêtes sortantes
- [ ] **D.** Limiter le nombre de requêtes envoyées sur une certaine période, en retardant potentiellement les appels selon une politique de limitation

### Question 112

Sur quel composant Symfony repose l'implémentation de `ThrottlingHttpClient` ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Lock
- [ ] **B.** Le composant Cache
- [ ] **C.** Le composant Messenger
- [ ] **D.** Le composant Rate Limiter, via `LimiterInterface`

### Question 113

Dans l'exemple de configuration donné, quelle politique de limitation est utilisée pour ne pas dépasser 10 requêtes en 5 secondes ? *(une seule bonne réponse)*

- [ ] **A.** `fixed_window`
- [ ] **B.** `no_limit`
- [ ] **C.** `token_bucket`
- [ ] **D.** `sliding_window`

## Consuming Server-Sent Events

### Question 114

À quel type MIME les événements envoyés par le serveur (server-sent events) sont-ils servis ? *(une seule bonne réponse)*

- [ ] **A.** `text/plain`
- [ ] **B.** `text/event-stream`
- [ ] **C.** `application/json`
- [ ] **D.** `multipart/form-data`

### Question 115

Quelle classe permet à Symfony's HttpClient de consommer un flux de server-sent events ? *(une seule bonne réponse)*

- [ ] **A.** `PushHttpClient`
- [ ] **B.** `EventSourceHttpClient`
- [ ] **C.** `ServerSentEventClient`
- [ ] **D.** `StreamingHttpClient`

### Question 116

Quelle est la valeur par défaut du délai de reconnexion (second argument optionnel du constructeur d'`EventSourceHttpClient`) ? *(une seule bonne réponse)*

- [ ] **A.** 30 secondes
- [ ] **B.** Il n'y a pas de reconnexion automatique par défaut
- [ ] **C.** 10 secondes
- [ ] **D.** 1 seconde

### Question 117

Comment décoder directement en tableau le contenu JSON d'un `ServerSentEvent` reçu ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `json_decode()` manuellement, aucune méthode dédiée n'existant
- [ ] **B.** Via `$response->toArray()`, comme pour une réponse classique
- [ ] **C.** Ce n'est pas possible, le contenu JSON n'est jamais exploitable directement
- [ ] **D.** Via la méthode `getArrayData()` du chunk `ServerSentEvent`

## Interoperability

### Question 118

Avec combien d'abstractions différentes de client HTTP le composant est-il interopérable ? *(une seule bonne réponse)*

- [ ] **A.** Deux : PSR-18 et HTTPlug
- [ ] **B.** Aucune, il impose sa propre API incompatible
- [ ] **C.** Quatre : Symfony Contracts, PSR-18, HTTPlug v1/v2 et les flux natifs PHP
- [ ] **D.** Une seule, Symfony Contracts

### Question 119

Quelle abstraction la documentation recommande-t-elle en priorité pour les auteurs de bibliothèques qui font des requêtes HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Aucune recommandation particulière n'est faite
- [ ] **B.** Toujours coder directement contre `CurlHttpClient`
- [ ] **C.** Symfony Contracts (avec PSR-18 ou HTTPlug v2 comme alternatives)
- [ ] **D.** HTTPlug v1, la plus ancienne et la plus stable

### Question 120

Quelle est la différence majeure entre Symfony Contracts et les autres abstractions (PSR-18, HTTPlug) concernant les options de requête ? *(une seule bonne réponse)*

- [ ] **A.** Les options ne sont définies que dans la documentation, jamais dans le code de l'interface
- [ ] **B.** Il n'y a aucune différence, les trois abstractions sont strictement équivalentes
- [ ] **C.** Toutes les options de requête (ex. gestion du timeout) sont définies dans l'interface elle-même, garantissant leur disponibilité pour toute implémentation conforme
- [ ] **D.** Symfony Contracts ne définit aucune option, contrairement aux autres

### Question 121

Quelle autre fonctionnalité majeure est couverte par Symfony Contracts, en plus des options de requête ? *(une seule bonne réponse)*

- [ ] **A.** Le chiffrement de bout en bout
- [ ] **B.** La génération de documentation OpenAPI
- [ ] **C.** L'async/multiplexage
- [ ] **D.** La compression gzip automatique

### Question 122

Quelle classe adapte un client Symfony `HttpClientInterface` en client conforme PSR-18 ? *(une seule bonne réponse)*

- [ ] **A.** `HttpClientAdapter`
- [ ] **B.** `PsrCompatibleClient`
- [ ] **C.** `Psr18Client`
- [ ] **D.** `Psr17Client`

### Question 123

En plus de PSR-18, quelles méthodes pertinentes `Psr18Client` implémente-t-il également ? *(une seule bonne réponse)*

- [ ] **A.** Aucune autre norme, uniquement PSR-18
- [ ] **B.** Celles de PSR-17 (pour faciliter la création d'objets requête)
- [ ] **C.** Celles de PSR-7 uniquement
- [ ] **D.** Celles de PSR-15 (middlewares)

### Question 124

Quels packages faut-il installer pour utiliser `Psr18Client`, en plus de `psr/http-client` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une implémentation PSR-17 comme `nyholm/psr7`
- [ ] **B.** Alternativement, `php-http/discovery` pour auto-découvrir une implémentation déjà installée
- [ ] **C.** Le composant Serializer, obligatoire pour PSR-18
- [ ] **D.** `guzzlehttp/guzzle`, seule implémentation PSR-17 supportée

### Question 125

À quoi sert l'option `auto_upgrade_http_version` de `Psr18Client` ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne s'applique qu'aux requêtes HTTP/2
- [ ] **B.** À contrôler si la version du protocole HTTP est automatiquement mise à niveau selon la réponse du serveur
- [ ] **C.** À forcer HTTP/1.0 pour toutes les requêtes PSR-18
- [ ] **D.** À activer automatiquement le support HTTP/3

### Question 126

Pour quel type de requêtes l'option `auto_upgrade_http_version` est-elle ignorée ? *(une seule bonne réponse)*

- [ ] **A.** Les requêtes utilisant l'authentification Basic
- [ ] **B.** Les requêtes GET uniquement
- [ ] **C.** Elle n'est jamais ignorée, quel que soit le type de requête
- [ ] **D.** Les requêtes HTTP/1.0, qui conservent toujours cette version de protocole

### Question 127

Le standard HTTPlug v1 est-il recommandé pour du code nouvellement écrit ? *(une seule bonne réponse)*

- [ ] **A.** HTTPlug n'existe qu'en version 2, il n'y a jamais eu de version 1
- [ ] **B.** Oui, mais uniquement pour les projets utilisant Guzzle
- [ ] **C.** Non, il a été remplacé par PSR-18 et ne devrait pas être utilisé dans du code nouveau
- [ ] **D.** Oui, c'est le standard recommandé en priorité

### Question 128

Quelle classe permet d'utiliser le composant HttpClient avec des bibliothèques nécessitant HTTPlug ? *(une seule bonne réponse)*

- [ ] **A.** `HttpClientBridge`
- [ ] **B.** `HttplugClient`
- [ ] **C.** `HttpPlugAdapter`
- [ ] **D.** `Psr18Client`, qui gère aussi HTTPlug

### Question 129

Quel package supplémentaire faut-il installer pour utiliser `HttplugClient` avec des promesses (promises) ? *(une seule bonne réponse)*

- [ ] **A.** `amphp/amp`
- [ ] **B.** `symfony/promise`
- [ ] **C.** `guzzlehttp/promises`
- [ ] **D.** `react/promise`

### Question 130

Quelle interface `HttplugClient` implémente-t-il pour permettre l'utilisation de promesses ? *(une seule bonne réponse)*

- [ ] **A.** `AsyncClientInterface`
- [ ] **B.** `DeferredInterface`
- [ ] **C.** `HttpAsyncClient`
- [ ] **D.** `PromiseInterface`

### Question 131

Comment attendre la résolution de toutes les promesses restantes avec `HttplugClient` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `PromiseInterface::resolveAll()`
- [ ] **B.** En appelant `$httpClient->wait()`, sans argument
- [ ] **C.** En appelant `$httpClient->waitAll()`
- [ ] **D.** Ce n'est pas possible, il faut attendre chaque promesse individuellement

### Question 132

Comment convertir un objet réponse HttpClient en une ressource de flux PHP natif ? *(une seule bonne réponse)*

- [ ] **A.** Via `file_get_contents()` sur l'URL d'origine
- [ ] **B.** Via `StreamWrapper::createResource($response, $client)`, ou via `$response->toStream()`
- [ ] **C.** Ce n'est pas possible, les réponses HttpClient ne sont jamais compatibles avec les flux PHP
- [ ] **D.** Uniquement via `serialize()`/`unserialize()`

### Question 133

Quel avantage `$response->toStream()` offre-t-il par rapport à `StreamWrapper::createResource()` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne qu'en mode synchrone
- [ ] **B.** Il ne peut être utilisé qu'une seule fois, contrairement à l'autre méthode
- [ ] **C.** Il retourne une ressource seekable et potentiellement utilisable avec `stream_select()`
- [ ] **D.** Il est strictement identique, sans aucune différence

## Extensibility

### Question 134

Quel mécanisme Symfony est utilisé pour étendre le comportement d'un client HTTP de base ? *(une seule bonne réponse)*

- [ ] **A.** L'héritage obligatoire de `CurlHttpClient`
- [ ] **B.** Les traits PHP, exclusivement
- [ ] **C.** Les event listeners du composant EventDispatcher
- [ ] **D.** La décoration de service

### Question 135

Pourquoi appeler une méthode sur l'objet réponse (ex. `getContent()`) directement à l'intérieur de la méthode `request()` d'un décorateur casse-t-il l'asynchronisme ? *(une seule bonne réponse)*

- [ ] **A.** Cela ne casse jamais l'asynchronisme, quel que soit l'endroit où l'appel est fait
- [ ] **B.** Parce que cela n'est autorisé qu'avec le transport cURL
- [ ] **C.** Parce que cela déclenche systématiquement une exception fatale
- [ ] **D.** Parce que cela force une opération synchrone, bloquant l'exécution avant le retour de `request()`

### Question 136

Quelle solution la documentation propose-t-elle pour éviter de casser l'asynchronisme tout en traitant la réponse ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, il faut se contenter du décorateur de client seul
- [ ] **B.** Décorer également l'objet réponse lui-même (ex. comme `TraceableHttpClient` / `TraceableResponse`)
- [ ] **C.** Toujours désactiver le mode asynchrone avant tout traitement personnalisé
- [ ] **D.** Utiliser exclusivement des callbacks synchrones dans `on_progress`

### Question 137

Quel trait aide à écrire des processeurs de réponse avancés traitant le flux de chunks au fur et à mesure de leur arrivée ? *(une seule bonne réponse)*

- [ ] **A.** `ChunkProcessorTrait`
- [ ] **B.** `ResponseDecoratorTrait`
- [ ] **C.** `AsyncDecoratorTrait`
- [ ] **D.** `StreamableTrait`

### Question 138

Que doit retourner la méthode `request()` d'une classe utilisant `AsyncDecoratorTrait` ? *(une seule bonne réponse)*

- [ ] **A.** Un générateur PHP brut, sans wrapper
- [ ] **B.** Une instance de `AsyncResponse`
- [ ] **C.** Un simple tableau de chunks
- [ ] **D.** Une instance de `MockResponse`

### Question 139

Quels arguments reçoit le générateur `$passthru` utilisé avec `AsyncDecoratorTrait` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement la réponse complète, sous forme de chaîne
- [ ] **B.** Le code de statut HTTP et les en-têtes, sous forme de deux arguments séparés
- [ ] **C.** Aucun argument, le générateur lit directement une variable globale
- [ ] **D.** Un `ChunkInterface` et un `AsyncContext`

### Question 140

Que se passe-t-il si le `$passthru` ne se comporte pas correctement (ex. un chunk émis après un chunk `isLast()`) ? *(une seule bonne réponse)*

- [ ] **A.** Rien, le comportement incorrect est silencieusement ignoré
- [ ] **B.** Le processus PHP se termine brutalement (fatal error) sans message
- [ ] **C.** La réponse est automatiquement mise en cache pour éviter de reproduire l'erreur
- [ ] **D.** Une `LogicException` est levée par les vérifications de sécurité d'`AsyncResponse`

## Testing

### Question 141

Quelles classes le composant fournit-il pour écrire des tests qui ne font pas de vraies requêtes HTTP ? *(une seule bonne réponse)*

- [ ] **A.** `NullHttpClient` et `EmptyResponse`
- [ ] **B.** `MockHttpClient` et `MockResponse`
- [ ] **C.** `FakeHttpClient` et `StubResponse`
- [ ] **D.** `TestHttpClient` et `DummyResponse`

### Question 142

Pourquoi `MockHttpClient` peut-il remplacer un vrai client HTTP dans les tests sans changer le code de production ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'il désactive complètement le composant HttpClient
- [ ] **B.** Parce qu'il ne peut être utilisé que dans les tests fonctionnels, jamais unitaires
- [ ] **C.** Parce qu'il implémente la même interface `HttpClientInterface` que n'importe quel client réel
- [ ] **D.** Parce qu'il intercepte les appels réseau au niveau du système d'exploitation

### Question 143

Comment `MockHttpClient` répond-il si on lui passe une liste de réponses dans son constructeur ? *(une seule bonne réponse)*

- [ ] **A.** Seule la première réponse de la liste est jamais utilisée
- [ ] **B.** Il faut obligatoirement une réponse par URL exacte, sinon une exception est levée
- [ ] **C.** Elles sont retournées dans le même ordre que les requêtes faites
- [ ] **D.** Elles sont retournées dans un ordre aléatoire

### Question 144

Comment créer une `MockResponse` directement à partir d'un fichier de snapshot ? *(une seule bonne réponse)*

- [ ] **A.** `new MockResponse(file_get_contents('chemin'))`
- [ ] **B.** `MockResponse::load('chemin')`
- [ ] **C.** Ce n'est pas possible, il faut toujours lire le fichier manuellement au préalable
- [ ] **D.** `MockResponse::fromFile('chemin/vers/le/fichier')`

### Question 145

Que permet de faire un callback passé à `MockHttpClient` au lieu d'une liste statique de réponses ? *(une seule bonne réponse)*

- [ ] **A.** Remplacer complètement la nécessité d'instancier `MockHttpClient`
- [ ] **B.** Générer les réponses dynamiquement à l'appel, avec accès à la méthode, l'URL et les options de la requête
- [ ] **C.** Uniquement retourner toujours la même réponse statique
- [ ] **D.** Simuler un délai réseau artificiel, rien d'autre

### Question 146

Comment définir un code de statut HTTP différent de 200 pour une réponse simulée ? *(une seule bonne réponse)*

- [ ] **A.** Via une méthode `setStatusCode()` appelée après création
- [ ] **B.** Via l'option `http_code` du constructeur de `MockResponse`
- [ ] **C.** En modifiant directement une propriété publique `statusCode`
- [ ] **D.** Ce n'est pas possible de simuler un code différent de 200

### Question 147

Les réponses fournies à `MockHttpClient` doivent-elles obligatoirement être des instances de `MockResponse` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, absolument aucune autre classe n'est acceptée
- [ ] **B.** Non, mais uniquement des sous-classes directes de `MockResponse`
- [ ] **C.** Oui, sauf en environnement de test fonctionnel
- [ ] **D.** Non, toute classe implémentant `ResponseInterface` fonctionne (ex. un mock créé via `createMock(ResponseInterface::class)`)

### Question 148

Comment simuler un timeout au sein d'un corps de réponse généré par un générateur PHP passé à `MockResponse` ? *(une seule bonne réponse)*

- [ ] **A.** En levant une exception `TimeoutException` depuis le générateur
- [ ] **B.** En faisant `yield` une chaîne vide, automatiquement transformée en timeout
- [ ] **C.** En faisant `yield null`
- [ ] **D.** Ce n'est pas possible de simuler un timeout avec `MockResponse`

### Question 149

Comment configurer Symfony pour qu'un callback personnalisé (classe invokable) génère les réponses simulées dans tout le test ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucune option de configuration dédiée à cela
- [ ] **B.** Via l'option `mock_response_factory` de `framework.http_client`, généralement sous `when@test`
- [ ] **C.** Ce n'est configurable qu'au niveau du code, jamais via la configuration Symfony
- [ ] **D.** Via un tag de service `#[AsMockResponseFactory]`

### Question 150

Quelles méthodes de `MockResponse` permettent de vérifier les caractéristiques de la requête qui a été envoyée ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getRequestMethod()`
- [ ] **B.** `getRequestUrl()`
- [ ] **C.** `getRequestOptions()`
- [ ] **D.** `getRequestBody()`, qui remplace `getRequestOptions()`

### Question 151

Que retourne `getRequestOptions()` sur une `MockResponse` ? *(une seule bonne réponse)*

- [ ] **A.** Rien, cette méthode n'existe pas sur `MockResponse`
- [ ] **B.** Un tableau contenant les informations de la requête comme les en-têtes, paramètres de requête, contenu du corps, etc.
- [ ] **C.** Uniquement le code de statut HTTP simulé
- [ ] **D.** Le nom du client HTTP utilisé

### Question 152

Quel format de fichier standard, exportable depuis l'onglet réseau d'un navigateur, peut être utilisé pour construire des tests avec le client HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Le format OpenAPI/Swagger
- [ ] **B.** Le format HAR (HTTP Archive)
- [ ] **C.** Le format PCAP
- [ ] **D.** Le format cURL `--libcurl`

### Question 153

Sur quels critères `HarFileResponseFactory` retrouve-t-il la réponse associée à une requête dans un fichier `.har` contenant plusieurs paires requête/réponse ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les en-têtes de la requête
- [ ] **B.** Un identifiant unique généré aléatoirement par le fichier `.har`
- [ ] **C.** La méthode HTTP, l'URL et le corps de la requête (le cas échéant)
- [ ] **D.** Uniquement l'ordre d'apparition dans le fichier

### Question 154

Comment simuler une erreur de transport survenant avant même la réception des en-têtes (ex. hôte injoignable) ? *(une seule bonne réponse)*

- [ ] **A.** En définissant `http_code` à 0
- [ ] **B.** En définissant l'option `error` dans les infos de la `MockResponse`
- [ ] **C.** En passant directement une exception comme premier argument du constructeur
- [ ] **D.** Ce type d'erreur ne peut pas être simulé, seules les erreurs après réception des en-têtes le peuvent

### Question 155

Dans le cas d'une erreur simulée via l'option `error`, quand la `TransportException` est-elle levée ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, cette option ne fait que logguer l'erreur
- [ ] **B.** Uniquement lors de la destruction de l'objet réponse
- [ ] **C.** Dès qu'une méthode comme `getStatusCode()` ou `getHeaders()` est appelée sur la réponse
- [ ] **D.** Immédiatement à la création de la `MockResponse`, avant même l'appel à `request()`

### Question 156

Comment simuler une erreur survenant pendant le streaming de la réponse, après que les en-têtes ont déjà été reçus avec succès ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible de simuler ce type spécifique d'erreur
- [ ] **B.** En définissant `http_code` à une valeur négative
- [ ] **C.** En fournissant l'exception comme partie du paramètre `body` (directement ou via un générateur qui la `yield`)
- [ ] **D.** En définissant l'option `error`, comme pour les erreurs avant en-têtes

### Question 157

Dans ce cas (erreur pendant le streaming), que peut indiquer `getStatusCode()` alors que `getContent()` échoue ? *(une seule bonne réponse)*

- [ ] **A.** `getStatusCode()` échoue systématiquement dans ce cas aussi
- [ ] **B.** Un succès (ex. 200), malgré l'échec ultérieur de la récupération du contenu
- [ ] **C.** Toujours une erreur 5xx, cohérente avec l'échec de `getContent()`
- [ ] **D.** Un code 0, indiquant qu'aucune réponse n'a été reçue

---

## Corrigé

**Question 1 : B** — « The HttpClient component is a low-level HTTP client with support for both PHP stream wrappers and cURL. It provides utilities to consume APIs and supports synchronous and asynchronous operations. » *(§ Installation)*

**Question 2 : B** — « In the Symfony framework, this class is available as the `http_client` service. This service will be autowired automatically when type-hinting for `HttpClientInterface`. » *(§ Basic Usage)*

**Question 3 : C** — « `$content = $response->toArray(); // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]` » *(§ Basic Usage)*

**Question 4 : B** — « `$client = HttpClient::create();` » *(§ Basic Usage)*

**Question 5 : C** — « The HTTP client is interoperable with many common HTTP client abstractions in PHP. You can also use any of these abstractions to profit from autowirings. See Interoperability for more information. » *(§ Basic Usage)*

**Question 6 : C** — « You can configure the global options using the `default_options` option. » *(§ Configuration)*

**Question 7 : D** — « You can also use the `withOptions` method to retrieve a new instance of the client with new default options. » *(§ Configuration)*

**Question 8 : C** — « replaces *all* headers at once, and deletes the headers you do not provide (…) set or replace a single header using `setHeader()`. » *(§ Configuration)*

**Question 9 : D** — « The HTTP client also has a configuration option called `max_host_connections`. This option cannot be overridden per request. » *(§ Configuration)*

**Question 10 : A, B, C** — « including DNS pre-resolution, SSL parameters, public key pinning, etc. » *(§ Configuration)*

**Question 11 : C** — « the component provides scoped clients (…) to autoconfigure the HTTP client based on the requested URL. » *(§ Configuration — Scoping Client)*

**Question 12 : B** — « only requests matching scope will use these options (…) `scope: 'https://api\.github\.com'`. » *(§ Configuration — Scoping Client)*

**Question 13 : B** — « The options passed to the `request()` method are merged with the default options defined in the scoped client. The options passed to `request()` take precedence. » *(§ Configuration — Scoping Client)*

**Question 14 : C** — « Each scoped client also defines a corresponding named autowiring alias. If you use for example `HttpClientInterface $githubClient` (…) autowiring will inject the `github.client` service. » *(§ Configuration — Scoping Client)*

**Question 15 : D** — « `$client = ScopingHttpClient::forBaseUri($client, 'https://api.github.com/', [...]);` » *(§ Configuration — Scoping Client)*

**Question 16 : C** — « the `HttpOptions` class brings most of the available options with type-hinted getters and setters. » *(§ Configuration)*

**Question 17 : B** — « The HTTP client provides a single `request()` method to perform all kinds of HTTP requests. » *(§ Making Requests)*

**Question 18 : D** — « Symfony's HTTP client is asynchronous by default. When you call `request()`, the HTTP request starts immediately, but the method returns without waiting for a response. » *(§ Making Requests)*

**Question 19 : C** — « Your code only blocks when you actually need the response data. » *(§ Making Requests)*

**Question 20 : A, B, C** — « HTTP Basic authentication (…) HTTP Bearer authentication (…) Microsoft NTLM authentication » (`auth_basic`, `auth_bearer`, `auth_ntlm`). *(§ Making Requests — Authentication)*

**Question 21 : B** — « Basic Authentication can also be set by including the credentials in the URL, such as: `http://the-username:the-password@example.com` » *(§ Making Requests — Authentication)*

**Question 22 : D** — « The NTLM authentication mechanism requires using the cURL transport. » *(§ Making Requests — Authentication)*

**Question 23 : B** — « By using `HttpClient::createForBaseUri()`, we ensure that the auth credentials won't be sent to any other hosts than https://example.com/. » *(§ Making Requests — Authentication)*

**Question 24 : C** — « define them as an associative array via the `query` option, that will be merged with the URL. » *(§ Making Requests — Query String Parameters)*

**Question 25 : B** — « Use the `headers` option to define the default headers added to all requests. » *(§ Making Requests — Headers)*

**Question 26 : D** — « this header is only included in this request and overrides the value of the same header if defined globally by the HTTP client. » *(§ Making Requests — Headers)*

**Question 27 : A, B, C** — « You can use regular strings, closures, iterables and resources. » *(§ Making Requests — Uploading Data)*

**Question 28 : C** — « if you don't define the Content-Type HTTP header explicitly, Symfony assumes that you're uploading form data and adds the required `Content-Type: application/x-www-form-urlencoded` header. » *(§ Making Requests — Uploading Data)*

**Question 29 : D** — « it will be called several times until it returns the empty string, which signals the end of the body. » *(§ Making Requests — Uploading Data)*

**Question 30 : C** — « When uploading JSON payloads, use the `json` option instead of `body`. The given content will be JSON-encoded automatically and the request will add the `Content-Type: application/json` automatically too. » *(§ Making Requests — Uploading Data)*

**Question 31 : D** — « this code will populate the filename and content-type with the data of the opened file, but you can configure both with the PHP streaming configuration. » *(§ Making Requests — Uploading Data)*

**Question 32 : C** — « the `FormDataPart` class automatically appends `[key]` to the name of the field (…) `"array_field[0]"` and `"array_field[1]"`. » *(§ Making Requests — Uploading Data)*

**Question 33 : B** — « This might not work with all servers, resulting in HTTP status code 411 ("Length Required") because there is no `Content-Length` header. The solution is to turn the body into a string. » *(§ Making Requests — Uploading Data)*

**Question 34 : B** — « The HTTP client provided by this component is stateless but handling cookies requires a stateful storage. » *(§ Making Requests — Cookies)*

**Question 35 : B** — « You can either send cookies with the BrowserKit component (…) or manually setting the Cookie HTTP request header. » *(§ Making Requests — Cookies)*

**Question 36 : D** — « By default, the HTTP client follows redirects, up to a maximum of 20. » *(§ Making Requests — Redirects)*

**Question 37 : B** — « `// 0 means to not follow any redirect` `'max_redirects' => 0,` » *(§ Making Requests — Redirects)*

**Question 38 : C** — « By default, failed requests are retried up to 3 times. » *(§ Making Requests — Retry Failed Requests)*

**Question 39 : B** — « with an exponential delay between retries (first retry = 1 second; third retry: 4 seconds). » *(§ Making Requests — Retry Failed Requests)*

**Question 40 : A, B, C** — « only for the following HTTP status codes: 423, 425, 429, 502 and 503 when using any HTTP method. » *(§ Making Requests — Retry Failed Requests)*

**Question 41 : C** — « and 500, 504, 507 and 510 when using an HTTP idempotent method. » *(§ Making Requests — Retry Failed Requests)*

**Question 42 : B** — « use the `RetryableHttpClient` class to wrap your original HTTP client. » *(§ Making Requests — Retry Failed Requests)*

**Question 43 : D** — « Pass an array of base URIs as option `base_uri` when making a request (…) if first request fails, the following base URI will be used. » *(§ Making Requests — Retry Over Several Base URIs)*

**Question 44 : B** — « nest the base URIs you want to shuffle in an additional array. » *(§ Making Requests — Retry Over Several Base URIs)*

**Question 45 : C** — « By default, this component honors the standard environment variables that your Operating System defines to direct the HTTP traffic through your local proxy. » *(§ Making Requests — HTTP Proxies)*

**Question 46 : B** — « You can still set or override these settings using the `proxy` and `no_proxy` options. » *(§ Making Requests — HTTP Proxies)*

**Question 47 : A, B, C** — « This callback is guaranteed to be called on DNS resolution, on arrival of headers and on completion. » *(§ Making Requests — Progress Callback)*

**Question 48 : C** — « additionally it is called when new data is uploaded or downloaded and at least once per second. » *(§ Making Requests — Progress Callback)*

**Question 49 : B** — « Any exceptions thrown from the callback will be wrapped in an instance of `TransportExceptionInterface` and will abort the request. » *(§ Making Requests — Progress Callback)*

**Question 50 : D** — « HttpClient uses the system's certificate store to validate SSL certificates (while browsers use their own stores). » *(§ Making Requests — HTTPS Certificates)*

**Question 51 : B** — « you can also disable `verify_host` and `verify_peer` (…) but this is not recommended in production. » *(§ Making Requests — HTTPS Certificates)*

**Question 52 : C** — « SSRF allows an attacker to induce the backend application to make HTTP requests to an arbitrary domain. These attacks can also target the internal hosts and IPs. » *(§ Making Requests — SSRF Handling)*

**Question 53 : B** — « it is probably a good idea to decorate it with a `NoPrivateNetworkHttpClient`. This will ensure local networks are made inaccessible. » *(§ Making Requests — SSRF Handling)*

**Question 54 : D** — « the second optional argument defines the networks to block (…) requests from 104.26.14.0 to 104.26.15.255 will result in an exception. » *(§ Making Requests — SSRF Handling)*

**Question 55 : D** — « You can disable this behavior by setting the `extra.trace_content` option to `false`. » *(§ Making Requests — Profiling)*

**Question 56 : B** — « `UriTemplateHttpClient` provides a client that eases the use of URI templates, as described in the RFC 6570. » *(§ Making Requests — Using URI Templates)*

**Question 57 : D** — « you must install a third-party package that expands those URI templates (…) `composer require league/uri` (…) `guzzlehttp/uri-template` (…) `rize/uri-template`. » *(§ Making Requests — Using URI Templates)*

**Question 58 : D** — « all existing HTTP clients are decorated by the `UriTemplateHttpClient`. This means that URI template feature is enabled by default. » *(§ Making Requests — Using URI Templates)*

**Question 59 : C** — « You can configure variables that will be replaced globally in all URI templates of your application (…) `default_options: vars: - secret: 'secret-token'`. » *(§ Making Requests — Using URI Templates)*

**Question 60 : C** — « you can do so by redefining the `http_client.uri_template_expander` alias. Your service must be invokable. » *(§ Making Requests — Using URI Templates)*

**Question 61 : D** — « this design allows keeping connections to remote hosts open between requests, improving performance by saving repetitive DNS resolution, SSL negotiation, etc. » *(§ Performance)*

**Question 62 : D** — « To leverage all these design benefits, the cURL extension is needed. » *(§ Performance)*

**Question 63 : A, B, C** — « This component can make HTTP requests using native PHP streams and the `amphp/http-client` (…) and cURL libraries. » *(§ Performance — Enabling cURL Support)*

**Question 64 : C** — « HTTP/2 is only supported when using cURL or `amphp/http-client`. » *(§ Performance — Enabling cURL Support)*

**Question 65 : C** — « The `HttpClient::create` method selects the cURL transport if the cURL PHP extension is enabled. It falls back to `AmpHttpClient` (…) Finally (…) it falls back to PHP streams. » *(§ Performance — Enabling cURL Support)*

**Question 66 : B** — « Symfony started requiring `amphp/http-client` version 5.3.2 or higher in Symfony 8.0. » *(§ Performance — Enabling cURL Support)*

**Question 67 : C** — « When using this component in a full-stack Symfony application, this behavior is not configurable and cURL will be used automatically. » *(§ Performance — Enabling cURL Support)*

**Question 68 : B** — « Add an `extra.curl` option in your configuration to pass those extra options. » *(§ Performance — Configuring CurlHttpClient Options)*

**Question 69 : B** — « Some cURL options are impossible to override (e.g. because of thread safety) and you'll get an exception when trying to override them. » *(§ Performance — Configuring CurlHttpClient Options)*

**Question 70 : A, B** — « using cURL client: cURL was compiled with ZLib support (…) using the native HTTP client: Zlib PHP extension is installed. » *(§ Performance — HTTP Compression)*

**Question 71 : D** — « To disable HTTP compression, send an `Accept-Encoding: identity` HTTP header. » *(§ Performance — HTTP Compression)*

**Question 72 : D** — « If you set `Accept-Encoding` to e.g. `gzip`, you will need to handle the decompression yourself. » *(§ Performance — HTTP Compression)*

**Question 73 : C** — « When requesting an https URL, HTTP/2 is enabled by default if one of the following tools is installed: libcurl (…) 7.36 or higher (…) `amphp/http-client` (…) 4.2 or higher. » *(§ Performance — HTTP/2 Support)*

**Question 74 : D** — « To force HTTP/2 for http URLs, you need to enable it explicitly via the `http_version` option. » *(§ Performance — HTTP/2 Support)*

**Question 75 : C** — « Support for HTTP/2 PUSH works automatically (…) pushed responses are put into a temporary cache and are used when a subsequent request is triggered. » *(§ Performance — HTTP/2 Support)*

**Question 76 : B** — « gets the HTTP headers as string[][] with the header names lower-cased. » *(§ Processing Responses)*

**Question 77 : D** — « returns info coming from the transport layer, such as "response_headers", "redirect_count", "start_time", "redirect_url", etc. » *(§ Processing Responses)*

**Question 78 : B** — « `$response->getInfo()` is non-blocking: it returns *live* information about the response. Some of them might not be known yet. » *(§ Processing Responses)*

**Question 79 : C** — « the special "pause_handler" info item is a callable that allows you to delay the request for a given number of seconds; this allows you to delay retries, throttle streams, etc. » *(§ Processing Responses)*

**Question 80 : C** — « `$response->toStream()` is part of `Symfony\Component\HttpClient\Response\StreamableInterface`. » *(§ Processing Responses)*

**Question 81 : C** — « you can get individual info too (…) `$startTime = $response->getInfo('start_time');`. » *(§ Processing Responses)*

**Question 82 : B** — « casts the response JSON content to a PHP array » (`toArray()`) vs « gets the response body as a string » (`getContent()`). *(§ Processing Responses)*

**Question 83 : B** — « Call the `stream` method to get *chunks* of the response sequentially instead of waiting for the entire response. » *(§ Processing Responses — Streaming Responses)*

**Question 84 : C** — « Responses are lazy: this code is executed as soon as headers are received. » *(§ Processing Responses — Streaming Responses)*

**Question 85 : D** — « By default, `text/*`, JSON and XML response bodies are buffered in a local `php://temp` stream. » *(§ Processing Responses — Streaming Responses)*

**Question 86 : A, B** — « you can either use the `ResponseInterface::cancel` (…) Or throw an exception from a progress callback. » *(§ Processing Responses — Canceling Responses)*

**Question 87 : B** — « In case the response was canceled using `$response->cancel()`, `$response->getInfo('canceled')` will return `true`. » *(§ Processing Responses — Canceling Responses)*

**Question 88 : A, B, C** — « Exceptions implementing `HttpExceptionInterface` (…) `TransportExceptionInterface` (…) `DecodingExceptionInterface`. » *(§ Processing Responses — Handling Exceptions)*

**Question 89 : C** — « the `getHeaders()`, `getContent()` and `toArray()` methods throw an appropriate exception, all of which implement `HttpExceptionInterface`. » *(§ Processing Responses — Handling Exceptions)*

**Question 90 : B** — « pass `false` as the optional argument to every call of those methods, e.g. `$response->getHeaders(false);`. » *(§ Processing Responses — Handling Exceptions)*

**Question 91 : C** — « If you do not call any of these 3 methods at all, the exception will still be thrown when the `$response` object is destructed. » *(§ Processing Responses — Handling Exceptions)*

**Question 92 : D** — « Calling `$response->getStatusCode()` is enough to disable this behavior. » *(§ Processing Responses — Handling Exceptions)*

**Question 93 : B** — « This line will trigger the destructor of all responses stored in the array; they will complete concurrently and an exception will be thrown in case a status code in the 300-599 range is returned. » *(§ Processing Responses — Handling Exceptions)*

**Question 94 : B** — « Symfony's HTTP client makes asynchronous HTTP requests by default. This means you don't need to configure anything special. » *(§ Concurrent Requests)*

**Question 95 : B** — « This is the key to achieving parallel and concurrent execution: dispatch all requests first, and read them later. » *(§ Concurrent Requests)*

**Question 96 : C** — « There is (…) a maximum amount of concurrent connections that can be open per host (`6` by default). » *(§ Concurrent Requests)*

**Question 97 : C** — « this method yields response chunks as soon as they arrive over the network (…) enables true asynchronous behavior. » *(§ Concurrent Requests — Multiplexing Responses)*

**Question 98 : C** — « Use the `user_data` option along with `$response->getInfo('user_data')` to identify each response during streaming. » *(§ Concurrent Requests — Multiplexing Responses)*

**Question 99 : D** — « A timeout can happen when e.g. DNS resolution takes too much time, when the TCP connection cannot be opened (…) or when the response content pauses for too long. » *(§ Concurrent Requests — Dealing with Network Timeouts)*

**Question 100 : D** — « The `default_socket_timeout` PHP ini setting is used if the option is not set. » *(§ Concurrent Requests — Dealing with Network Timeouts)*

**Question 101 : D** — « The option can be overridden by using the 2nd argument of the `stream()` method. This allows monitoring several responses at once. » *(§ Concurrent Requests — Dealing with Network Timeouts)*

**Question 102 : B** — « Use the `max_duration` option to limit the time a full request/response can last. » *(§ Concurrent Requests — Dealing with Network Timeouts)*

**Question 103 : B** — « Network errors (broken pipe, failed DNS resolution, etc.) are thrown as instances of `TransportExceptionInterface`. » *(§ Concurrent Requests — Dealing with Network Errors)*

**Question 104 : D** — « you need to wrap calls to `$client->request()` but also calls to any methods of the returned responses. This is because responses are lazy. » *(§ Concurrent Requests — Dealing with Network Errors)*

**Question 105 : C** — « Because `$response->getInfo()` is non-blocking, it shouldn't throw by design. » *(§ Concurrent Requests — Dealing with Network Errors)*

**Question 106 : B** — « This component provides a `CachingHttpClient` decorator that enables caching of HTTP responses (…) as described in RFC 9111. » *(§ Caching Requests and Responses)*

**Question 107 : C** — « Internally, it relies on a tag aware cache, so the Cache component must be installed in your application. » *(§ Caching Requests and Responses)*

**Question 108 : B** — « The caching mechanism is asynchronous. The response must be fully consumed (…) for it to be stored in the cache. » *(§ Caching Requests and Responses)*

**Question 109 : C** — « `scoped_clients: example.client: base_uri: '...' caching: cache_pool: example_cache_pool`. » *(§ Caching Requests and Responses)*

**Question 110 : C** — « It is strongly recommended to configure a retry strategy to gracefully handle temporary cache inconsistencies or validation failures. » *(§ Caching Requests and Responses)*

**Question 111 : D** — « This component provides a `ThrottlingHttpClient` decorator that allows you to limit the number of requests within a certain period, potentially delaying calls. » *(§ Limit the Number of Requests)*

**Question 112 : D** — « The implementation leverages the `LimiterInterface` class under the hood so the Rate Limiter component needs to be installed. » *(§ Limit the Number of Requests)*

**Question 113 : C** — « `http_example_limiter: policy: 'token_bucket' limit: 10 rate: { interval: '5 seconds', amount: 10 }`. » *(§ Limit the Number of Requests)*

**Question 114 : B** — « The events are a stream of data (served with the `text/event-stream` MIME type). » *(§ Consuming Server-Sent Events)*

**Question 115 : B** — « Use the `EventSourceHttpClient` to wrap your HTTP client, open a connection to a server that responds with a `text/event-stream` content type. » *(§ Consuming Server-Sent Events)*

**Question 116 : C** — « the second optional argument is the reconnection time in seconds (default = 10). » *(§ Consuming Server-Sent Events)*

**Question 117 : D** — « you can use the `ServerSentEvent::getArrayData` method to directly get the decoded JSON as array. » *(§ Consuming Server-Sent Events)*

**Question 118 : C** — « The component is interoperable with four different abstractions for HTTP clients: Symfony Contracts, PSR-18, HTTPlug v1/v2 and native PHP streams. » *(§ Interoperability)*

**Question 119 : C** — « you can decouple it from any specific HTTP client implementations by coding against either Symfony Contracts (recommended), PSR-18 or HTTPlug v2. » *(§ Interoperability)*

**Question 120 : C** — « All request options mentioned above (…) are also defined in the wordings of the interface, so that any compliant implementations (…) is guaranteed to provide them. » *(§ Interoperability — Symfony Contracts)*

**Question 121 : C** — « Another major feature covered by the Symfony Contracts is async/multiplexing. » *(§ Interoperability — Symfony Contracts)*

**Question 122 : C** — « This component implements the PSR-18 (HTTP Client) specifications via the `Psr18Client` class. » *(§ Interoperability — PSR-18 and PSR-17)*

**Question 123 : B** — « This class also implements the relevant methods of PSR-17 to ease creating request objects. » *(§ Interoperability — PSR-18 and PSR-17)*

**Question 124 : A, B** — « `composer require nyholm/psr7` (…) alternatively, install the `php-http/discovery` package to auto-discover any already installed implementations. » *(§ Interoperability — PSR-18 and PSR-17)*

**Question 125 : B** — « You can use the `auto_upgrade_http_version` option to control whether the HTTP protocol version is automatically upgraded. » *(§ Interoperability — PSR-18 and PSR-17)*

**Question 126 : D** — « The `auto_upgrade_http_version` option is ignored for HTTP/1.0 requests, which always keep that protocol version. » *(§ Interoperability — PSR-18 and PSR-17)*

**Question 127 : C** — « The HTTPlug v1 specification was published before PSR-18 and is superseded by it. As such, you should not use it in newly written code. » *(§ Interoperability — HTTPlug)*

**Question 128 : B** — « The component is still interoperable with libraries that require it thanks to the `HttplugClient` class. » *(§ Interoperability — HTTPlug)*

**Question 129 : C** — « If you'd like to work with promises, `HttplugClient` also implements the `HttpAsyncClient` interface. To use it, you need to install the `guzzlehttp/promises` package. » *(§ Interoperability — HTTPlug)*

**Question 130 : C** — « `HttplugClient` also implements the `HttpAsyncClient` interface. » *(§ Interoperability — HTTPlug)*

**Question 131 : B** — « wait for all remaining promises to resolve: `$httpClient->wait();`. » *(§ Interoperability — HTTPlug)*

**Question 132 : B** — « Responses (…) can be cast to native PHP streams with `StreamWrapper::createResource` (…) `$streamResource = $response->toStream();`. » *(§ Interoperability — Native PHP Streams)*

**Question 133 : C** — « this returns a resource that is seekable and potentially `stream_select()`-able. » *(§ Interoperability — Native PHP Streams)*

**Question 134 : D** — « If you want to extend the behavior of a base HTTP client, you can use service decoration. » *(§ Extensibility)*

**Question 135 : D** — « since calling responses' methods forces synchronous operations, doing so inside `request()` will break async. » *(§ Extensibility)*

**Question 136 : B** — « The solution is to also decorate the response object itself. `TraceableHttpClient` and `TraceableResponse` are good examples as a starting point. » *(§ Extensibility)*

**Question 137 : C** — « the component provides an `AsyncDecoratorTrait`. This trait allows processing the stream of chunks as they come back from the network. » *(§ Extensibility)*

**Question 138 : B** — « it shall return an `AsyncResponse`. » *(§ Extensibility)*

**Question 139 : D** — « `$passthru = function (ChunkInterface $chunk, AsyncContext $context): \Generator { ... };`. » *(§ Extensibility)*

**Question 140 : D** — « The logic in `AsyncResponse` has many safety checks that will throw a `LogicException` if the chunk passthru doesn't behave correctly. » *(§ Extensibility)*

**Question 141 : B** — « This component includes the `MockHttpClient` and `MockResponse` classes to use in tests that shouldn't make actual HTTP requests. » *(§ Testing)*

**Question 142 : C** — « `MockHttpClient` implements the `HttpClientInterface`, just like any actual HTTP client (…) your code will accept the real client outside tests, while replacing it with `MockHttpClient` in the test. » *(§ Testing)*

**Question 143 : C** — « pass a list of responses to its constructor. These will be yielded in order when requests are made (…) responses are returned in the same order as passed to `MockHttpClient`. » *(§ Testing — HTTP Client and Responses)*

**Question 144 : D** — « `$response = MockResponse::fromFile('tests/fixtures/response.xml');`. » *(§ Testing — HTTP Client and Responses)*

**Question 145 : B** — « pass a callback that generates the responses dynamically when it's called. » *(§ Testing — HTTP Client and Responses)*

**Question 146 : B** — « If you need to test responses with HTTP status codes different than 200, define the `http_code` option. » *(§ Testing — HTTP Client and Responses)*

**Question 147 : D** — « The responses provided to the mock client don't have to be instances of `MockResponse`. Any class implementing `ResponseInterface` will work (e.g. `$this->createMock(ResponseInterface::class)`). » *(§ Testing — HTTP Client and Responses)*

**Question 148 : B** — « empty strings are turned into timeouts so that they are easy to test. » *(§ Testing — HTTP Client and Responses)*

**Question 149 : B** — « `when@test: framework: http_client: mock_response_factory: App\Tests\MockClientCallback`. » *(§ Testing — HTTP Client and Responses)*

**Question 150 : A, B, C** — « `getRequestMethod()` (…) `getRequestUrl()` (…) `getRequestOptions()`. » *(§ Testing — Testing Request Data)*

**Question 151 : B** — « returns an array containing other information about the request such as headers, query parameters, body content etc. » *(§ Testing — Testing Request Data)*

**Question 152 : B** — « Modern browsers (via their network tab) and HTTP clients allow you to export the information of one or more HTTP requests using the HAR (HTTP Archive) format. » *(§ Testing — Testing Using HAR Files)*

**Question 153 : C** — « the `HarFileResponseFactory` will find the associated response based on the request method, URL and body (if any). » *(§ Testing — Testing Using HAR Files)*

**Question 154 : B** — « In order to test errors that occur before headers have been received, set the `error` option value when creating the `MockResponse`. » *(§ Testing — Testing Network Transport Exceptions)*

**Question 155 : C** — « The `TransportException` will be thrown as soon as a method like `getStatusCode()` or `getHeaders()` is called. » *(§ Testing — Testing Network Transport Exceptions)*

**Question 156 : C** — « provide the exception to `MockResponse` as part of the `body` parameter. You can either use an exception directly, or yield the exception from a callback. » *(§ Testing — Testing Network Transport Exceptions)*

**Question 157 : B** — « `getStatusCode()` may indicate a success (200), but accessing `getContent()` fails. » *(§ Testing — Testing Network Transport Exceptions)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [http_client.rst](https://github.com/symfony/symfony-docs/blob/8.0/http_client.rst)) : pas de pages annexes à couvrir pour ce QCM.
