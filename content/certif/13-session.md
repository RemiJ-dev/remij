# QCM — Les sessions

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/session.html](https://symfony.com/doc/8.0/session.html) · **Généré le :** 21 juillet 2026
>
> **111 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et récupération de la session

### Question 1

Quel composant faut-il installer pour gérer les sessions, et que remplace le système de sessions de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/http-foundation` ; il remplace l'usage du super-global `$_SESSION` et des fonctions natives PHP comme `session_start()`, `session_regenerate_id()`, `session_id()`, `session_name()` et `session_destroy()`
- [ ] **B.** `composer require symfony/session` ; il ne remplace que `session_start()`
- [ ] **C.** Aucune installation n'est nécessaire, le composant est fourni par `symfony/framework-bundle`
- [ ] **D.** `composer require symfony/http-foundation` ; il remplace uniquement les fonctions de cookies

### Question 2

Quand une session Symfony est-elle réellement démarrée ? *(une seule bonne réponse)*

- [ ] **A.** Systématiquement au démarrage du kernel
- [ ] **B.** Seulement si on lit ou écrit dedans
- [ ] **C.** Uniquement si `session.auto_start = 1` est activé dans `php.ini`
- [ ] **D.** Seulement pour les utilisateurs authentifiés

### Question 3

Comment récupère-t-on la session depuis un service ou un contrôleur (méthode recommandée) ? *(une seule bonne réponse)*

- [ ] **A.** En injectant `RequestStack` et en appelant `getSession()` dessus — l'accéder directement dans le constructeur n'est *pas* recommandé, car elle pourrait ne pas être accessible ou provoquer des effets de bord
- [ ] **B.** En injectant directement `Session` dans le constructeur du service
- [ ] **C.** Via `$_SESSION` global comme en PHP natif
- [ ] **D.** Uniquement via un attribut `#[CurrentSession]`

### Question 4

Dans un contrôleur, comment accéder à la session sans passer explicitement par `RequestStack` ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant l'action avec `SessionInterface`
- [ ] **B.** En type-hintant l'action avec `Request` et en appelant `$request->getSession()`
- [ ] **C.** Ce n'est pas possible depuis un contrôleur
- [ ] **D.** Via `$this->getSession()` sur `AbstractController`

### Question 5

En dehors du framework Symfony complet (usage « standalone » du composant), comment démarrer une session ? *(une seule bonne réponse)*

- [ ] **A.** `new Session(); $session->start();`
- [ ] **B.** `Session::start()` (méthode statique)
- [ ] **C.** Le composant ne peut pas être utilisé hors du framework complet
- [ ] **D.** `new RequestStack(); $requestStack->start();`

## Attributs de session

### Question 6

Pourquoi Symfony utilise-t-il des « session bags » plutôt que le `$_SESSION` global directement ? *(une seule bonne réponse)*

- [ ] **A.** Pour la performance uniquement
- [ ] **B.** Pour encapsuler un ensemble de données (« attributs ») sous un namespace unique par bag, évitant la pollution du namespace `$_SESSION` et permettant la coexistence avec d'autres bibliothèques utilisant `$_SESSION`
- [ ] **C.** Parce que `$_SESSION` est déprécié en PHP 8.5
- [ ] **D.** Pour forcer le chiffrement des données de session

### Question 7

Comment stocker et lire un attribut de session, et que fait le second argument de `get()` ? *(une seule bonne réponse)*

- [ ] **A.** `$session->set('nom', 'valeur')` / `$session->get('nom')` ; le second argument de `get()` est la valeur retournée si l'attribut n'existe pas
- [ ] **B.** `$session->write()` / `$session->read()` ; pas de second argument possible
- [ ] **C.** `$session['nom'] = 'valeur'` uniquement, via `ArrayAccess`
- [ ] **D.** `$session->set('nom', 'valeur')` ; le second argument de `get()` force le rafraîchissement du cache

### Question 8

Quelle classe gère par défaut les attributs de session sous forme de paires clé-valeur ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag`
- [ ] **B.** `Symfony\Component\HttpFoundation\Session\Session`
- [ ] **C.** `Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage`
- [ ] **D.** `Symfony\Component\HttpFoundation\Session\Flash\FlashBag`

### Question 9

Quelles affirmations sur le démarrage automatique de la session sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une session démarre automatiquement dès qu'on lit, écrit, ou même vérifie l'existence d'une donnée en session
- [ ] **B.** Cela peut nuire aux performances car tous les utilisateurs, y compris anonymes, recevraient alors un cookie de session
- [ ] **C.** Pour éviter de démarrer une session pour les utilisateurs anonymes, il faut *complètement* éviter d'accéder à la session
- [ ] **D.** Certaines fonctionnalités comme la protection CSRF *stateless* démarrent aussi la session automatiquement

## Messages flash

### Question 10

Quelle est la particularité des messages « flash » en session ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont chiffrés automatiquement
- [ ] **B.** Ils sont conçus pour être utilisés exactement une fois : ils disparaissent automatiquement de la session dès qu'on les récupère
- [ ] **C.** Ils expirent après 24h peu importe s'ils ont été lus
- [ ] **D.** Ils ne peuvent contenir que des chaînes de caractères

### Question 11

Que fait exactement `$this->addFlash('notice', 'message')` dans un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Un raccourci équivalent à `$request->getSession()->getFlashBag()->add('notice', 'message')`
- [ ] **B.** Il écrit directement dans `$_SESSION['flash']`
- [ ] **C.** Il envoie un email de notification
- [ ] **D.** Il stocke le message dans le cache HTTP, pas en session

### Question 12

Dans un template Twig, comment lire les messages flash d'un seul type (« notice ») en les « consommant », donc en les effaçant du bag ? *(une seule bonne réponse)*

- [ ] **A.** `{% for message in app.session.flashbag.peek('notice') %}`
- [ ] **B.** `{% for message in app.flashes('notice') %}`, via la variable globale Twig `app`
- [ ] **C.** `{{ flash('notice') }}`
- [ ] **D.** `{% for message in session.flashes.notice %}`

### Question 13

Quelle méthode permet de lire un message flash *sans* le retirer du bag ? *(une seule bonne réponse)*

- [ ] **A.** `getFlashBag()->all()`
- [ ] **B.** `getFlashBag()->clear()`
- [ ] **C.** `getFlashBag()->peek()` (ou `peekAll()` pour tous les types)
- [ ] **D.** Ce n'est pas possible, la lecture vide toujours le bag

### Question 14

Quelles syntaxes Twig valides pour lire les messages flash sont documentées ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{% for message in app.flashes('notice') %}` pour un seul type
- [ ] **B.** `{% for label, messages in app.flashes(['success', 'warning']) %}` pour plusieurs types
- [ ] **C.** `{% for label, messages in app.flashes %}` pour tous les types
- [ ] **D.** `{% for message in app.flashes.all() %}` pour tous les types en une fois

### Question 15

Quelles clés la documentation cite-t-elle comme habituelles pour les types de messages flash, sans être imposées ? *(une seule bonne réponse)*

- [ ] **A.** `success`, `info`, `debug`
- [ ] **B.** `notice`, `warning`, `error` — mais n'importe quelle clé peut être utilisée
- [ ] **C.** `flash1`, `flash2`, `flash3`
- [ ] **D.** Les clés doivent obligatoirement correspondre à un niveau de log PSR-3

### Question 16

Pourquoi une page affichant des messages flash ne peut-elle en général pas être mise en cache HTTP, et quelle alternative la documentation propose-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Accéder aux messages flash démarre la session, ce qui marque la réponse comme `private` ; l'alternative est de charger les flashs de façon asynchrone via une requête séparée (ex. un Twig Live Component), pour garder la page principale entièrement cacheable
- [ ] **B.** Les messages flash empêchent toute mise en cache définitivement, sans contournement possible
- [ ] **C.** Il suffit d'ajouter l'en-tête `Cache-Control: public` manuellement
- [ ] **D.** Le cache HTTP n'a jamais de rapport avec les sessions

### Question 17

Dans l'exemple d'utilisation autonome (hors framework complet) des messages flash, comment récupère-t-on le bag de flash ? *(une seule bonne réponse)*

- [ ] **A.** `$session->getFlashBag()`
- [ ] **B.** `$session->flashes()`
- [ ] **C.** `Flash::get($session)`
- [ ] **D.** Il n'existe pas d'API standalone, uniquement via Twig

### Question 18

Dans le contexte d'un traitement de formulaire réussi, où le flash est-il ajouté d'après l'exemple de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Avant `$form->isSubmitted()`
- [ ] **B.** Après validation réussie du formulaire (`$form->isSubmitted() && $form->isValid()`), avant la redirection
- [ ] **C.** Dans le constructeur du contrôleur
- [ ] **D.** Dans un event listener sur `kernel.response` uniquement

### Question 19

En PHP « standalone », comment afficher tous les messages flash de tous les types à la fois sans vider le bag ? *(une seule bonne réponse)*

- [ ] **A.** `foreach ($session->getFlashBag()->all() as $type => $messages)`
- [ ] **B.** `foreach ($session->getFlashBag()->peekAll() as $type => $messages)`
- [ ] **C.** `$session->getFlashBag()->display()`
- [ ] **D.** `foreach ($session->getFlashBag()->get() as $message)`

## Configuration

### Question 20

Les sessions sont-elles activées par défaut dans le framework Symfony, et où se configurent-elles ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut explicitement les activer dans `config/packages/framework.yaml`
- [ ] **B.** Oui, elles sont activées par défaut ; leur configuration vit sous la clé `framework.session` de `config/packages/framework.yaml`
- [ ] **C.** Oui, mais uniquement configurables via des variables d'environnement
- [ ] **D.** Non, elles nécessitent l'installation d'un bundle tiers

### Question 21

Que signifie `handler_id: null` dans la configuration des sessions ? *(une seule bonne réponse)*

- [ ] **A.** Les sessions sont désactivées
- [ ] **B.** Symfony utilise le mécanisme de session par défaut de PHP ; les fichiers de métadonnées de session sont stockés en dehors de l'application, dans un répertoire contrôlé par PHP
- [ ] **C.** Aucun handler n'est utilisé, les sessions sont uniquement en mémoire
- [ ] **D.** Symfony choisit automatiquement un handler Redis si disponible

### Question 22

Quel piège la documentation signale-t-elle avec `handler_id: null` si d'autres applications écrivent dans le même répertoire de sessions PHP ? *(une seule bonne réponse)*

- [ ] **A.** Aucun risque, PHP isole toujours les sessions par application
- [ ] **B.** Certaines options liées à l'expiration de session peuvent ne pas fonctionner comme prévu si ces autres applications ont des réglages de durée de vie courts
- [ ] **C.** Cela provoque systématiquement une erreur fatale au démarrage
- [ ] **D.** Les sessions sont alors partagées entre toutes les applications du serveur

### Question 23

Quelle option utiliser pour que Symfony gère lui-même les sessions dans des fichiers, et où définir le répertoire de stockage ? *(une seule bonne réponse)*

- [ ] **A.** `handler_id: 'session.handler.native_file'`, avec l'option `save_path`
- [ ] **B.** `handler_id: 'session.handler.symfony_native'`, avec l'option `storage_path`
- [ ] **C.** Ce n'est pas configurable, Symfony utilise toujours le répertoire PHP par défaut
- [ ] **D.** `storage_factory_id: 'session.storage.factory.symfony_file'`

### Question 24

Avec quelle directive `php.ini` les sessions Symfony sont-elles **incompatibles**, et qu'en faire ? *(une seule bonne réponse)*

- [ ] **A.** `session.gc_probability` : il faut la mettre à 0
- [ ] **B.** `session.auto_start = 1` : cette directive doit être désactivée, dans `php.ini`, les directives du serveur web ou `.htaccess`
- [ ] **C.** `session.save_handler = files` : elle doit être supprimée
- [ ] **D.** `session.cookie_secure` : elle doit être forcée à `1`

### Question 25

Le cookie de session est-il accessible ailleurs que via l'objet `Session`, et dans quel contexte cela est-il utile ? *(une seule bonne réponse)*

- [ ] **A.** Non, il n'est accessible que via l'objet `Session`
- [ ] **B.** Oui, via l'objet `Response` — utile pour récupérer ce cookie en contexte CLI ou avec des runners PHP comme RoadRunner ou Swoole
- [ ] **C.** Oui, mais uniquement via une variable d'environnement
- [ ] **D.** Oui, mais seulement en environnement `dev`

### Question 26

Parmi les valeurs par défaut visibles dans l'exemple de configuration `framework.session` de la documentation, lesquelles sont correctes ? *(plusieurs bonnes réponses)*

- [ ] **A.** `cookie_secure: auto`
- [ ] **B.** `cookie_samesite: lax`
- [ ] **C.** `storage_factory_id: session.storage.factory.native`
- [ ] **D.** `handler_id: session.handler.native_file` par défaut

### Question 27

En PHP standalone (sans le framework complet), quelle classe utilise-t-on pour configurer directement le stockage natif des sessions (avec `cookie_secure`, `cookie_samesite`…) ? *(une seule bonne réponse)*

- [ ] **A.** `NativeSessionStorage`, passée ensuite au constructeur de `Session`
- [ ] **B.** `SessionConfiguration`
- [ ] **C.** `FrameworkSessionFactory`
- [ ] **D.** Il n'existe pas d'équivalent standalone à cette configuration

### Question 28

Où consulter la liste complète des options de configuration de session disponibles selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement dans le code source de `NativeSessionStorage`
- [ ] **B.** Dans la référence de configuration Symfony, section Session configuration
- [ ] **C.** Il n'existe pas de référence, seules les options citées dans l'article existent
- [ ] **D.** Dans le fichier `config/packages/session.yaml`

### Question 29

Que faire si l'on préfère laisser Symfony gérer lui-même les fichiers de session plutôt que d'utiliser le mécanisme natif de PHP (`handler_id: null`) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `handler_id: null` est la seule option pour un stockage fichier
- [ ] **B.** Utiliser le service `session.handler.native_file` comme `handler_id`, ce qui permet à Symfony de gérer les sessions lui-même
- [ ] **C.** Il faut désinstaller `symfony/http-foundation`
- [ ] **D.** Il faut passer par un bundle tiers, aucune solution native n'existe

## Durée d'inactivité (Idle Time / Keep Alive)

### Question 30

Pourquoi ne faut-il pas se contenter du `cookie_lifetime` pour implémenter une expiration de session par inactivité (ex. déconnexion après 5-10 minutes, comme dans une application bancaire) ? *(une seule bonne réponse)*

- [ ] **A.** `cookie_lifetime` est ignoré par tous les navigateurs modernes
- [ ] **B.** Il peut être manipulé côté client ; l'expiration doit donc se faire côté serveur
- [ ] **C.** `cookie_lifetime` ne peut être défini qu'en secondes entières
- [ ] **D.** Ce n'est pas vrai, `cookie_lifetime` seul suffit largement

### Question 31

Quelle est la façon la plus simple documentée pour implémenter l'expiration par inactivité ? *(une seule bonne réponse)*

- [ ] **A.** Via la garbage collection de session : `cookie_lifetime` à une valeur relativement haute, et `gc_maxlifetime` réglé sur la durée d'inactivité souhaitée
- [ ] **B.** En interrogeant une base de données à chaque requête
- [ ] **C.** En stockant un timestamp dans un cookie séparé non lié à la session
- [ ] **D.** Il n'existe qu'une seule méthode : vérifier l'expiration manuellement

### Question 32

Quelle est l'alternative à la garbage collection pour gérer l'expiration par inactivité, et quel avantage offre-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Vérifier explicitement si la session a expiré après son démarrage, ce qui permet d'intégrer cette expiration à l'expérience utilisateur, par exemple en affichant un message
- [ ] **B.** Désactiver complètement les sessions
- [ ] **C.** Utiliser uniquement `session.gc_probability = 0`
- [ ] **D.** Il n'existe aucune alternative documentée

### Question 33

Quelles méthodes de `getMetadataBag()` la documentation mentionne-t-elle, et que retournent-elles ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getCreated()` et `getLastUsed()`, qui retournent tous deux un timestamp Unix relatif au serveur
- [ ] **B.** `getLifetime()`, qui indique la valeur de `cookie_lifetime` définie pour un cookie donné
- [ ] **C.** `getExpiresAt()`, qui retourne une instance de `DateTimeImmutable`
- [ ] **D.** `getIdleTime()`, qui retourne directement la durée d'inactivité en secondes

### Question 34

Dans l'exemple d'expiration explicite de session, que fait le code après avoir détecté une inactivité trop longue ? *(une seule bonne réponse)*

- [ ] **A.** Il appelle `$session->invalidate()` puis lève une exception dédiée pour rediriger vers une page de session expirée
- [ ] **B.** Il appelle `$session->clear()` uniquement, sans invalider la session
- [ ] **C.** Il redémarre automatiquement une nouvelle session anonyme sans notifier l'utilisateur
- [ ] **D.** Il modifie directement le cookie côté client via JavaScript

### Question 35

Comment calcule-t-on le moment d'expiration théorique d'un cookie de session à partir des métadonnées disponibles ? *(une seule bonne réponse)*

- [ ] **A.** En additionnant le timestamp de création (`getCreated()`) et la durée de vie (`getLifetime()`)
- [ ] **B.** En soustrayant `getLastUsed()` de `getCreated()`
- [ ] **C.** Ce calcul n'est pas possible avec les métadonnées disponibles
- [ ] **D.** En multipliant `getLifetime()` par le nombre de requêtes effectuées

### Question 36

Que représentent les valeurs retournées par `getCreated()` et `getLastUsed()` ? *(une seule bonne réponse)*

- [ ] **A.** Des chaînes de caractères au format ISO 8601
- [ ] **B.** Des timestamps Unix, relatifs au serveur
- [ ] **C.** Des objets `DateTime`
- [ ] **D.** Le nombre de secondes écoulées depuis le début de la requête courante

## Garbage collection

### Question 37

Selon quelle logique PHP décide-t-il d'invoquer le handler de garbage collection à l'ouverture d'une session ? *(une seule bonne réponse)*

- [ ] **A.** À chaque ouverture de session, systématiquement
- [ ] **B.** Aléatoirement, selon la probabilité définie par `session.gc_probability` / `session.gc_divisor` (ex. 5/100 = 5 % de chances)
- [ ] **C.** Une seule fois par jour, à heure fixe
- [ ] **D.** Uniquement quand le disque atteint un seuil de remplissage

### Question 38

Que signifie la directive `session.gc_maxlifetime` transmise au handler de garbage collection ? *(une seule bonne réponse)*

- [ ] **A.** Toute session sauvegardée il y a plus longtemps que cette valeur doit être supprimée
- [ ] **B.** C'est la durée de vie maximale du cookie de session côté navigateur
- [ ] **C.** C'est le nombre maximal de sessions simultanées autorisées
- [ ] **D.** C'est le délai avant le premier appel au garbage collector, jamais répété ensuite

### Question 39

Pourquoi certains systèmes d'exploitation (ex. Debian) mettent-ils `session.gc_probability` à `0`, et comment Symfony se comporte-t-il par défaut face à cela ? *(une seule bonne réponse)*

- [ ] **A.** Pour empêcher PHP de faire lui-même le garbage collection, ce système gérant la purge autrement ; par défaut Symfony utilise la valeur de `gc_probability` définie dans `php.ini`
- [ ] **B.** C'est un bug de ces distributions, sans conséquence sur Symfony
- [ ] **C.** Symfony ignore totalement la valeur de `php.ini` et impose toujours 1 %
- [ ] **D.** Cela empêche complètement l'utilisation des sessions sur ces systèmes

### Question 40

Si l'on ne peut pas modifier ce réglage PHP directement, comment configurer `gc_probability` dans Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans modifier `php.ini`
- [ ] **B.** En le configurant directement sous `framework.session.gc_probability` dans `config/packages/framework.yaml`
- [ ] **C.** Via une variable d'environnement `GC_PROBABILITY` uniquement
- [ ] **D.** Uniquement en PHP standalone, jamais avec le framework complet

### Question 41

En dehors de la configuration `framework.session`, comment peut-on aussi régler `gc_probability`, `gc_divisor` et `gc_maxlifetime` ? *(une seule bonne réponse)*

- [ ] **A.** En les passant dans un tableau au constructeur de `NativeSessionStorage`, ou via sa méthode `setOptions()`
- [ ] **B.** Uniquement via des attributs PHP sur la classe `Session`
- [ ] **C.** Ce n'est pas possible en dehors de la configuration YAML
- [ ] **D.** Via un compiler pass obligatoire

### Question 42

Un ratio `session.gc_probability` / `session.gc_divisor` de `3/4` correspond à quelle probabilité d'appel du garbage collector ? *(une seule bonne réponse)*

- [ ] **A.** 3 %
- [ ] **B.** 4 %
- [ ] **C.** 75 %
- [ ] **D.** 34 %

## Stocker les sessions en base — Redis

### Question 43

Pourquoi faut-il envisager une base de données pour stocker les sessions, et quel type de base la documentation recommande-t-elle pour la performance ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement si l'application est servie par plusieurs serveurs, le stockage fichier par défaut ne fonctionnant plus alors ; les bases clé-valeur comme Redis sont recommandées pour de meilleures performances
- [ ] **B.** Toujours, quel que soit le nombre de serveurs, pour des raisons de sécurité
- [ ] **C.** Une base relationnelle est systématiquement recommandée avant toute autre option
- [ ] **D.** Une base de données n'est jamais nécessaire, le stockage fichier suffit toujours

### Question 44

Quelles sont les deux façons documentées d'utiliser Redis pour stocker les sessions ? *(plusieurs bonnes réponses)*

- [ ] **A.** Configurer le handler Redis directement dans le `php.ini` du serveur (`session.save_handler = redis`), avec le verrouillage natif de session de PHP
- [ ] **B.** Configurer un service Symfony `RedisSessionHandler` utilisé comme `handler_id`
- [ ] **C.** Écrire un compiler pass qui redirige automatiquement `handler_id` vers Redis
- [ ] **D.** Installer un bundle `symfony/redis-session-bundle`, seule méthode possible

### Question 45

Quel avantage l'option « handler Redis configuré dans `php.ini` » a-t-elle par rapport au service `RedisSessionHandler` de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Elle est plus simple à configurer
- [ ] **B.** Elle utilise le verrouillage natif de session de PHP, qui empêche les race conditions quand plusieurs requêtes accèdent à la même session
- [ ] **C.** Elle ne nécessite pas de serveur Redis
- [ ] **D.** Elle fonctionne sans l'extension `phpredis`

### Question 46

Une fois le service `RedisSessionHandler` défini, comment dit-on à Symfony de l'utiliser comme handler de session ? *(une seule bonne réponse)*

- [ ] **A.** Via `storage_factory_id: RedisSessionHandler`
- [ ] **B.** Via `framework.session.handler_id` pointant vers l'id du service `RedisSessionHandler`
- [ ] **C.** Automatiquement dès que le service `Redis` existe dans le container
- [ ] **D.** Via une variable d'environnement `SESSION_HANDLER=redis`

### Question 47

Quelles classes peut-on utiliser pour le service `Redis` injecté dans `RedisSessionHandler`, d'après la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `\Redis`
- [ ] **B.** `\RedisArray`, `\RedisCluster`
- [ ] **C.** `\Relay\Relay`, `\Predis\Client`
- [ ] **D.** `\Memcached`

### Question 48

Quelles options accepte `RedisSessionHandler`, et quelles sont leurs valeurs par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `prefix` et `ttl`, avec pour défauts respectifs `'sf_s'` et `null`
- [ ] **B.** `namespace` et `expire`, sans défaut
- [ ] **C.** Une seule option, `ttl`, par défaut à 3600
- [ ] **D.** Aucune option n'est configurable

### Question 49

Quelle limitation importante `RedisSessionHandler` a-t-il, et quel symptôme typique cela peut-il causer ? *(une seule bonne réponse)*

- [ ] **A.** Il ne supporte pas les clusters Redis
- [ ] **B.** Il n'effectue pas de verrouillage de session ; des requêtes concurrentes, par exemple des requêtes JavaScript, écrivant sur la session peuvent causer des race conditions et une perte de données — un symptôme typique étant une erreur « Invalid CSRF token »
- [ ] **C.** Il ne peut stocker que des chaînes de moins de 1 Ko
- [ ] **D.** Il force la régénération de l'id de session à chaque requête

### Question 50

Pour obtenir le verrouillage de session avec Redis malgré la limitation de `RedisSessionHandler`, que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser l'option `php.ini`-based décrite plus haut, qui s'appuie sur le handler Redis natif de PHP
- [ ] **B.** Passer `locking: true` en option du service `RedisSessionHandler`
- [ ] **C.** Ce n'est pas possible, il faut changer de système de stockage
- [ ] **D.** Utiliser `MemcachedSessionHandler` à la place, qui ne supporte pas non plus le verrouillage

### Question 51

Comment adapter la solution Redis pour utiliser Memcached à la place ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, Memcached n'a pas d'équivalent
- [ ] **B.** Suivre la même approche en remplaçant `RedisSessionHandler` par `MemcachedSessionHandler` — la même limitation de verrouillage s'applique, sauf via la configuration `php.ini`, l'extension PECL Memcached activant le verrouillage par défaut dans ce cas
- [ ] **C.** Utiliser `RedisSessionHandler` tel quel, Memcached étant compatible avec le protocole Redis
- [ ] **D.** Installer un bridge dédié `symfony/memcached-bridge`

### Question 52

Comment utiliser un serveur Valkey plutôt que Redis pour le stockage des sessions ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas supporté nativement
- [ ] **B.** En utilisant les schémas de DSN `valkey:` ou `valkeys:` à la place de `redis:`/`rediss:` dans la configuration du handler de session
- [ ] **C.** En installant un bundle tiers spécifique à Valkey
- [ ] **D.** Valkey n'est utilisable qu'en remplaçant complètement l'extension `phpredis`

## Stocker les sessions en base — SGBD relationnel (PDO)

### Question 53

Quelle classe Symfony fournit-il pour stocker les sessions dans une base relationnelle comme MariaDB, MySQL ou PostgreSQL ? *(une seule bonne réponse)*

- [ ] **A.** `PdoSessionHandler`
- [ ] **B.** `DoctrineSessionHandler`
- [ ] **C.** `RelationalSessionHandler`
- [ ] **D.** `SqlSessionStorage`

### Question 54

Quel argument minimal faut-il passer au service `PdoSessionHandler` pour qu'il se connecte à la base ? *(une seule bonne réponse)*

- [ ] **A.** La variable d'environnement `%env(DATABASE_URL)%`
- [ ] **B.** Un objet `Connection` Doctrine, obligatoirement
- [ ] **C.** Aucun argument, la connexion est détectée automatiquement
- [ ] **D.** Le nom de la base de données uniquement

### Question 55

Quelles options de query string la documentation cite-t-elle comme utilisables dans le DSN `DATABASE_URL` pour MySQL avec `PdoSessionHandler` ? *(une seule bonne réponse)*

- [ ] **A.** `charset` et `unix_socket`
- [ ] **B.** `timeout` et `retries`
- [ ] **C.** `ssl` et `verify_peer`
- [ ] **D.** Aucune, seule l'URL de base est utilisée

### Question 56

Parmi ces paramètres configurables du `PdoSessionHandler`, lesquels correspondent à leur valeur par défaut réelle indiquée par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `db_table` par défaut `sessions`
- [ ] **B.** `db_id_col` par défaut `sess_id`
- [ ] **C.** `lock_mode` par défaut `LOCK_TRANSACTIONAL`
- [ ] **D.** `db_data_col` par défaut `session_data`

### Question 57

Que fait le paramètre `lock_mode` de `PdoSessionHandler`, et quelles valeurs peut-il prendre ? *(une seule bonne réponse)*

- [ ] **A.** Il choisit la stratégie de verrouillage de la base pour éviter les race conditions : `LOCK_NONE` (aucun verrouillage), `LOCK_ADVISORY` (verrouillage applicatif) ou `LOCK_TRANSACTIONAL` (verrouillage au niveau ligne)
- [ ] **B.** Il définit si la session est en lecture seule
- [ ] **C.** Il choisit entre verrouillage optimiste et pessimiste au niveau Doctrine
- [ ] **D.** Il n'existe pas de tel paramètre, seul `db_lifetime_col` gère l'expiration

### Question 58

Si Doctrine est installé, comment la table de sessions peut-elle être créée automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement lors de l'exécution de `make:migration`, si la base ciblée par Doctrine est identique à celle utilisée par ce composant
- [ ] **B.** Automatiquement au premier accès à une session
- [ ] **C.** Via une commande `doctrine:session:create-table`
- [ ] **D.** Ce n'est jamais automatique, même avec Doctrine installé

### Question 59

Si l'on préfère créer la table manuellement via le handler lui-même, quelle méthode utiliser, et que se passe-t-il si la table existe déjà ? *(une seule bonne réponse)*

- [ ] **A.** `createTable()` ; une exception est levée si la table existe déjà
- [ ] **B.** `initTable()` ; la table existante est silencieusement écrasée
- [ ] **C.** `install()` ; aucune vérification n'est faite
- [ ] **D.** Il n'existe pas de méthode dédiée, il faut écrire le SQL à la main dans tous les cas

### Question 60

D'après le schéma SQL MariaDB/MySQL donné par la documentation, quel type de colonne stocke l'identifiant de session (`sess_id`), et quelle est sa contrainte ? *(une seule bonne réponse)*

- [ ] **A.** `VARBINARY(128) NOT NULL PRIMARY KEY`
- [ ] **B.** `INT AUTO_INCREMENT PRIMARY KEY`
- [ ] **C.** `UUID NOT NULL UNIQUE`
- [ ] **D.** `TEXT NOT NULL`

### Question 61

Quel piège la documentation signale-t-elle à propos du type `BLOB` utilisé par défaut pour `sess_data`, et quelle solution propose-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `BLOB` ne stocke que jusqu'à 64 ko ; au-delà, une exception peut être levée ou la session silencieusement réinitialisée — utiliser `MEDIUMBLOB` pour plus d'espace
- [ ] **B.** `BLOB` n'accepte pas de données binaires, il faut utiliser `TEXT`
- [ ] **C.** Il n'y a aucune limite de taille documentée pour ce champ
- [ ] **D.** `BLOB` doit être remplacé par `JSON` pour les grosses sessions

### Question 62

Comment personnalise-t-on le nom de la table ou des colonnes utilisées par `PdoSessionHandler`, par exemple `customer_session` / `guid` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, les noms sont figés
- [ ] **B.** Via le second argument, un tableau, passé au constructeur du service `PdoSessionHandler`, avec des clés comme `db_table`, `db_id_col`
- [ ] **C.** En renommant directement la table en base, sans configuration côté Symfony
- [ ] **D.** Via une méthode `configureTableNames()` à appeler après l'injection

### Question 63

Comment générer une migration vide pour créer soi-même la table de sessions, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console doctrine:migrations:generate`, puis y ajouter le SQL approprié avant de lancer `doctrine:migrations:migrate`
- [ ] **B.** `php bin/console make:session-table`
- [ ] **C.** `php bin/console doctrine:schema:update --session`
- [ ] **D.** Il n'existe pas de commande pour cela, il faut créer le fichier de migration à la main de A à Z

### Question 64

Quelle méthode du handler permet d'ajouter la table de sessions au schéma Doctrine plutôt que de la créer directement ? *(une seule bonne réponse)*

- [ ] **A.** `configureSchema()`
- [ ] **B.** `addToSchema()`
- [ ] **C.** `registerTable()`
- [ ] **D.** `mapSchema()`

### Question 65

Le schéma PostgreSQL donné par la documentation pour la table `sessions` diffère du schéma MariaDB/MySQL sur quel point notable ? *(une seule bonne réponse)*

- [ ] **A.** Il n'a pas de colonne d'identifiant de session
- [ ] **B.** Le type de la colonne de données est `BYTEA` au lieu de `BLOB`, et l'index sur `sess_lifetime` est créé séparément via `CREATE INDEX`
- [ ] **C.** Il ne définit aucune clé primaire
- [ ] **D.** Les schémas sont rigoureusement identiques entre PostgreSQL et MySQL

## Stocker les sessions en base — MongoDB

### Question 66

Quelle classe Symfony fournit-il pour stocker les sessions dans MongoDB ? *(une seule bonne réponse)*

- [ ] **A.** `MongoSessionHandler`
- [ ] **B.** `MongoDbSessionHandler`
- [ ] **C.** `NoSqlSessionHandler`
- [ ] **D.** `DocumentSessionHandler`

### Question 67

Quels sont les deux paramètres obligatoires à passer au service `MongoDbSessionHandler` ? *(une seule bonne réponse)*

- [ ] **A.** `host` et `port`
- [ ] **B.** `database` et `collection`
- [ ] **C.** `dsn` uniquement
- [ ] **D.** `client` et `options`

### Question 68

Faut-il initialiser manuellement la collection MongoDB avant utilisation, et que recommande la documentation pour la performance de la garbage collection ? *(une seule bonne réponse)*

- [ ] **A.** Oui, il faut créer la collection manuellement au préalable
- [ ] **B.** Non, aucune initialisation n'est nécessaire ; il est en revanche recommandé d'ajouter un index sur `expires_at` avec `expireAfterSeconds: 0` via le shell MongoDB
- [ ] **C.** Non, mais un index unique sur `_id` est obligatoire à créer manuellement
- [ ] **D.** Oui, une commande Symfony dédiée `mongodb:session:init` est nécessaire

### Question 69

Parmi ces noms de champs configurables pour `MongoDbSessionHandler`, lesquels correspondent à leur valeur par défaut réelle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `id_field` par défaut `_id`
- [ ] **B.** `data_field` par défaut `data`
- [ ] **C.** `expiry_field` par défaut `expires_at`
- [ ] **D.** `time_field` par défaut `created_at`

### Question 70

Quel prérequis la documentation suppose-t-elle avant de configurer `MongoDbSessionHandler` ? *(une seule bonne réponse)*

- [ ] **A.** Avoir installé `doctrine/mongodb-odm-bundle` uniquement, sans connexion active
- [ ] **B.** Avoir une connexion MongoDB fonctionnelle dans l'application, comme expliqué dans la documentation de configuration de `DoctrineMongoDBBundle`
- [ ] **C.** Avoir désinstallé toute autre configuration Doctrine ORM
- [ ] **D.** Utiliser exclusivement MongoDB Atlas, le service cloud

### Question 71

Comment indique-t-on à Symfony d'utiliser `MongoDbSessionHandler` comme handler de session ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.session.handler_id` pointant vers l'id du service `MongoDbSessionHandler`
- [ ] **B.** Automatiquement dès qu'une connexion MongoDB est détectée
- [ ] **C.** Via `storage_factory_id: session.storage.factory.mongodb`
- [ ] **D.** Ce n'est pas possible, MongoDB n'est pas supporté nativement pour les sessions

### Question 72

Dans l'exemple de service pour `MongoDbSessionHandler`, quel service est injecté comme connexion MongoDB ? *(une seule bonne réponse)*

- [ ] **A.** `doctrine.dbal.default_connection`
- [ ] **B.** `doctrine_mongodb.odm.default_connection`
- [ ] **C.** `mongodb.client.default`
- [ ] **D.** `App\Mongo\ConnectionFactory`

### Question 73

Que dit la documentation à propos du champ `expiry_field` et de son rôle ? *(une seule bonne réponse)*

- [ ] **A.** Il stocke le nom de la collection utilisée
- [ ] **B.** Il stocke le champ définissant la durée de vie (lifetime) de la session, avec `expires_at` comme valeur par défaut
- [ ] **C.** Il n'a aucun lien avec l'expiration, seulement avec l'audit
- [ ] **D.** Il stocke un booléen indiquant si la session a expiré

## Migrer entre handlers de session

### Question 74

Quelle classe permet de migrer d'un handler de session à un autre sans perdre les données existantes ? *(une seule bonne réponse)*

- [ ] **A.** `SessionMigrationHandler`
- [ ] **B.** `MigratingSessionHandler`
- [ ] **C.** `DualWriteSessionHandler`
- [ ] **D.** `HandlerBridge`

### Question 75

Dans la première étape du workflow de migration recommandé, comment instancie-t-on `MigratingSessionHandler`, et quel est le comportement obtenu ? *(une seule bonne réponse)*

- [ ] **A.** `new MigratingSessionHandler($oldSessionStorage, $newSessionStorage)` — l'ancien handler continue de fonctionner normalement pendant que les sessions sont aussi écrites vers le nouveau
- [ ] **B.** `new MigratingSessionHandler($newSessionStorage, $oldSessionStorage)` dès la première étape
- [ ] **C.** Il faut d'abord vider toutes les sessions existantes
- [ ] **D.** Les deux handlers sont utilisés en lecture simultanément dès le début

### Question 76

Après la première étape, que faut-il vérifier avant de continuer la migration, et à quel moment ? *(une seule bonne réponse)*

- [ ] **A.** Immédiatement, sans attendre
- [ ] **B.** Que les données du nouveau handler sont correctes, après la période de garbage collection des sessions
- [ ] **C.** Que l'ancien handler a été complètement désinstallé
- [ ] **D.** Que le nombre de sessions actives a doublé

### Question 77

Pourquoi inverser l'ordre des arguments de `MigratingSessionHandler` lors de la deuxième étape, `new MigratingSessionHandler($newSessionStorage, $oldSessionStorage)` ? *(une seule bonne réponse)*

- [ ] **A.** Pour lire désormais depuis le nouveau handler, tout en gardant l'ancien en écriture — ce qui facilite un rollback si besoin
- [ ] **B.** Pour supprimer définitivement l'ancien handler immédiatement
- [ ] **C.** Cet ordre n'a aucune importance, les deux handlers sont interchangeables
- [ ] **D.** Pour forcer la régénération de toutes les sessions existantes

### Question 78

Quelle est la dernière étape du workflow de migration entre handlers de session ? *(une seule bonne réponse)*

- [ ] **A.** Revenir à l'étape 1 pour vérifier une seconde fois
- [ ] **B.** Une fois les sessions vérifiées comme fonctionnelles, basculer complètement du handler de migration vers le nouveau handler seul
- [ ] **C.** Supprimer `MigratingSessionHandler` du container sans changer `handler_id`
- [ ] **D.** Il n'y a pas d'étape finale, le `MigratingSessionHandler` reste utilisé indéfiniment

## Configurer le TTL de la session

### Question 79

Quelle est la valeur de TTL utilisée par défaut par Symfony pour les sessions ? *(une seule bonne réponse)*

- [ ] **A.** Une valeur fixe de 1440 secondes, indépendante de PHP
- [ ] **B.** Le réglage ini `session.gc_maxlifetime` de PHP
- [ ] **C.** 24 heures, codées en dur dans le composant
- [ ] **D.** Il n'existe pas de TTL par défaut, les sessions n'expirent jamais

### Question 80

Pourquoi ne peut-on pas simplement changer le réglage ini pour obtenir un TTL différent selon l'utilisateur connecté ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ce réglage ne peut pas être modifié une fois la session démarrée — il faut alors passer par un callback à l'exécution
- [ ] **B.** Parce que PHP interdit toute modification de `session.gc_maxlifetime`
- [ ] **C.** Parce que le TTL par utilisateur n'est pas du tout supporté par Symfony
- [ ] **D.** Parce que cela nécessiterait de redémarrer le serveur PHP

### Question 81

Comment configure-t-on un TTL fixe pour un handler de session stocké en base, par exemple Redis ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `ttl` passée dans le tableau d'options du service handler, ex. `RedisSessionHandler` avec `{ 'ttl': 600 }`
- [ ] **B.** Via `framework.session.ttl` directement
- [ ] **C.** Ce n'est configurable qu'au niveau du serveur Redis lui-même
- [ ] **D.** Via une variable d'environnement `SESSION_TTL` lue automatiquement

### Question 82

Comment configurer un TTL **dynamique**, différent selon l'utilisateur ou la session ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seul un TTL fixe est supporté
- [ ] **B.** En passant un callback comme valeur de l'option `ttl` ; ce callback est appelé juste avant l'écriture de la session et doit retourner un entier
- [ ] **C.** En définissant plusieurs services `RedisSessionHandler`, un par groupe d'utilisateurs
- [ ] **D.** En modifiant `gc_maxlifetime` à chaque requête via un event listener

### Question 83

Dans l'exemple YAML de TTL dynamique, comment le callback est-il déclaré comme valeur de l'option `ttl` ? *(une seule bonne réponse)*

- [ ] **A.** Avec le tag `!closure`, référençant un service dont la classe possède une méthode `__invoke()`
- [ ] **B.** Avec la syntaxe `!php/callable`
- [ ] **C.** En listant directement le nom de la méthode sous forme de chaîne
- [ ] **D.** Via un attribut PHP `#[TtlCallback]`

### Question 84

Que doit obligatoirement faire, ou retourner, le callback utilisé pour un TTL dynamique ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne de caractères représentant une date
- [ ] **B.** Un entier, utilisé comme valeur du TTL
- [ ] **C.** Un objet `DateInterval`
- [ ] **D.** Un booléen indiquant si la session doit expirer ou non

## Rendre la locale « sticky » pendant la session

### Question 85

Par défaut, la locale définie sur la `Request` est-elle automatiquement conservée (« sticky ») d'une requête à l'autre ? *(une seule bonne réponse)*

- [ ] **A.** Oui, automatiquement, sans configuration
- [ ] **B.** Non — mais on peut la stocker en session pour qu'elle soit réutilisée sur les requêtes suivantes
- [ ] **C.** Oui, mais seulement si un cookie dédié à la locale est présent
- [ ] **D.** Non, et il n'existe aucun moyen de la rendre persistante

### Question 86

À quel événement s'abonne le `LocaleSubscriber` recommandé par la documentation pour rendre la locale « sticky » ? *(une seule bonne réponse)*

- [ ] **A.** `kernel.response`
- [ ] **B.** `kernel.request` (`KernelEvents::REQUEST`)
- [ ] **C.** `kernel.controller`
- [ ] **D.** `kernel.finish_request`

### Question 87

Que vérifie le `LocaleSubscriber` avant toute chose au début de sa méthode `onKernelRequest()` ? *(une seule bonne réponse)*

- [ ] **A.** Que l'utilisateur est authentifié
- [ ] **B.** Que la requête a bien une session précédente, via `$request->hasPreviousSession()`
- [ ] **C.** Que le paramètre `_locale` est présent dans l'URL
- [ ] **D.** Que la locale par défaut de l'application est bien configurée

### Question 88

Dans la logique du `LocaleSubscriber`, que se passe-t-il si le paramètre de routing `_locale` est présent sur la requête ? *(une seule bonne réponse)*

- [ ] **A.** Il est ignoré au profit de la session
- [ ] **B.** Il est stocké dans la session via `$request->getSession()->set('_locale', $locale)`
- [ ] **C.** Il provoque une exception si une locale différente est déjà en session
- [ ] **D.** Il est immédiatement supprimé de la requête

### Question 89

Que se passe-t-il si aucune locale explicite n'est présente sur la requête ? *(une seule bonne réponse)*

- [ ] **A.** La requête échoue avec une erreur 400
- [ ] **B.** La locale de la requête est définie à partir de celle stockée en session, avec repli sur une locale par défaut
- [ ] **C.** La locale par défaut du serveur PHP est toujours utilisée
- [ ] **D.** Aucune locale n'est appliquée, laissant Twig gérer la traduction

### Question 90

Pourquoi la priorité de l'écouteur `onKernelRequest` du `LocaleSubscriber`, par exemple `20`, est-elle importante ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'a aucune importance particulière
- [ ] **B.** Le listener doit être enregistré avant, donc avec une priorité plus haute que, le listener par défaut de gestion de la locale
- [ ] **C.** Une priorité de `20` désactive automatiquement le cache HTTP
- [ ] **D.** Elle détermine l'ordre d'affichage des messages flash

### Question 91

Le `LocaleSubscriber` est-il détecté automatiquement par Symfony, et dans quelles conditions ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, un enregistrement manuel est toujours obligatoire
- [ ] **B.** Oui, automatiquement, si la configuration par défaut de `services.yaml`, avec autoconfiguration, est utilisée
- [ ] **C.** Uniquement en environnement `prod`
- [ ] **D.** Uniquement s'il implémente aussi `EventListenerInterface` en plus de `EventSubscriberInterface`

### Question 92

Pourquoi le `LocaleSubscriber` ne peut-il pas directement se baser sur l'utilisateur connecté pour définir sa locale préférée ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `RequestStack` ne permet pas d'accéder à la session dans un subscriber
- [ ] **B.** Parce qu'il est appelé avant le `FirewallListener`, responsable de l'authentification et du token utilisateur — l'utilisateur connecté n'est donc pas encore accessible à ce stade
- [ ] **C.** Parce que Symfony interdit l'accès à l'entité `User` depuis un event subscriber
- [ ] **D.** Parce que la locale ne peut jamais dépendre de l'utilisateur, seulement de l'URL

### Question 93

Quelle solution la documentation propose-t-elle pour appliquer la locale préférée de l'utilisateur dès sa connexion ? *(une seule bonne réponse)*

- [ ] **A.** S'abonner à l'événement `LoginSuccessEvent` et y stocker la locale de l'utilisateur en session, réutilisée ensuite par le `LocaleSubscriber`
- [ ] **B.** Modifier directement le `FirewallListener`
- [ ] **C.** Ajouter la locale comme claim dans le token de sécurité
- [ ] **D.** Ce n'est pas possible avant la page suivante, après un rechargement manuel

### Question 94

D'après la documentation, que faut-il faire si l'on veut que le changement de langue d'un utilisateur soit pris en compte **immédiatement**, sans attendre sa prochaine connexion ? *(une seule bonne réponse)*

- [ ] **A.** Rien de spécial, cela fonctionne automatiquement
- [ ] **B.** Mettre également à jour la session au moment où l'on modifie l'entité `User`
- [ ] **C.** Forcer une déconnexion/reconnexion de l'utilisateur
- [ ] **D.** Vider le cache HTTP de toutes les pages traduites

## Session Proxies : chiffrement et sessions invité

### Question 95

Comment créer un handler de sauvegarde personnalisé via le mécanisme des « session proxies » ? *(une seule bonne réponse)*

- [ ] **A.** En définissant une classe qui étend `Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy`
- [ ] **B.** En implémentant `SessionHandlerInterface` directement, sans classe de base
- [ ] **C.** En créant un compiler pass dédié, sans classe PHP
- [ ] **D.** En surchargeant `NativeSessionStorage` directement

### Question 96

Une fois la classe de proxy définie comme service, comment indique-t-on à Symfony de l'utiliser à la place du handler par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.session.storage_factory_id`
- [ ] **B.** Via l'option de configuration `framework.session.handler_id`
- [ ] **C.** Automatiquement, dès que la classe étend `SessionHandlerProxy`
- [ ] **D.** Via un tag de service `session.proxy`

### Question 97

Quels sont les deux cas d'usage courants illustrés par la documentation pour les session proxies ? *(une seule bonne réponse)*

- [ ] **A.** Chiffrer les informations de session, et définir des sessions invité en lecture seule
- [ ] **B.** Compresser les données de session, et les répliquer sur plusieurs serveurs
- [ ] **C.** Journaliser les sessions, et les migrer entre handlers
- [ ] **D.** Limiter la taille des sessions, et forcer leur expiration immédiate

### Question 98

Dans l'exemple `EncryptedSessionProxy` utilisant la bibliothèque `php-encryption`, quelles méthodes sont surchargées, et que font-elles ? *(plusieurs bonnes réponses)*

- [ ] **A.** `read($id)`, qui déchiffre les données lues via le parent avant de les retourner
- [ ] **B.** `write($id, $data)`, qui chiffre les données avant de les transmettre au parent
- [ ] **C.** `open()` et `close()`, qui gèrent l'ouverture/fermeture d'une connexion chiffrée dédiée
- [ ] **D.** Le constructeur, qui reçoit le handler sous-jacent et une clé de chiffrement, transmis au parent via `parent::__construct($handler)`

### Question 99

Quelle est l'autre méthode documentée pour chiffrer les données de session, alternative à un proxy dédié ? *(une seule bonne réponse)*

- [ ] **A.** Décorer le service `session.marshaller`, qui pointe vers `MarshallingSessionHandler`, avec un marshaller de chiffrement comme `SodiumMarshaller`
- [ ] **B.** Activer `framework.session.encryption: true`
- [ ] **C.** Chiffrer manuellement chaque appel à `$session->set()`
- [ ] **D.** Utiliser exclusivement `EncryptedSessionProxy`, aucune autre méthode n'existe

### Question 100

Comment génère-t-on la clé sécurisée nécessaire à `SodiumMarshaller`, et où la stocker ? *(une seule bonne réponse)*

- [ ] **A.** Avec `php -r 'echo base64_encode(sodium_crypto_box_keypair());'`, à ajouter au stockage de secrets sous un nom comme `SESSION_DECRYPTION_FILE`
- [ ] **B.** Avec `openssl rand -hex 32`, stockée directement dans `config/packages/framework.yaml`
- [ ] **C.** Elle est générée automatiquement au premier démarrage de session
- [ ] **D.** Avec une commande `bin/console secrets:generate-session-key`

### Question 101

Comment déclare-t-on le service `SodiumMarshaller` pour qu'il décore effectivement `session.marshaller` ? *(une seule bonne réponse)*

- [ ] **A.** Avec `decorates: 'session.marshaller'`, en lui passant la clé et le service décoré (`'@.inner'`) en arguments
- [ ] **B.** En le taguant `kernel.session_marshaller`
- [ ] **C.** En le nommant explicitement `session.marshaller` pour écraser le service existant
- [ ] **D.** Ce n'est pas possible de décorer ce service précis

### Question 102

Quel avertissement « danger » la documentation formule-t-elle à propos du chiffrement via `SodiumMarshaller` ? *(une seule bonne réponse)*

- [ ] **A.** Il chiffre les valeurs des éléments mais pas les clés de cache — il faut donc veiller à ne pas exposer de données sensibles dans les clés
- [ ] **B.** Il ne fonctionne qu'avec PHP compilé sans l'extension `sodium`
- [ ] **C.** Il rend les sessions incompatibles avec la garbage collection
- [ ] **D.** Il double la taille de toutes les données de session

### Question 103

Dans l'exemple `ReadOnlySessionProxy`, à quelle condition l'écriture de la session est-elle simplement ignorée ? *(une seule bonne réponse)*

- [ ] **A.** Quand la session dépasse une certaine taille
- [ ] **B.** Quand l'utilisateur courant existe et est un invité, `isGuest()`
- [ ] **C.** Quand la requête est une requête AJAX
- [ ] **D.** Quand aucun token CSRF n'est présent

### Question 104

Quel est l'intérêt documenté des sessions invité en lecture seule ? *(une seule bonne réponse)*

- [ ] **A.** Économiser de la bande passante réseau
- [ ] **B.** Permettre une session aux utilisateurs invités sans avoir besoin de la persister
- [ ] **C.** Empêcher tout accès aux pages du site pour les invités
- [ ] **D.** Forcer les invités à créer un compte avant toute navigation

### Question 105

Dans `ReadOnlySessionProxy`, quel service est utilisé pour déterminer si l'utilisateur courant est un invité ? *(une seule bonne réponse)*

- [ ] **A.** Le service `security.token_storage` directement
- [ ] **B.** Le service `Symfony\Bundle\SecurityBundle\Security`, via sa méthode `getUser()`
- [ ] **C.** Le service `request_stack`
- [ ] **D.** Une simple vérification de la présence d'un cookie de session

## Intégration avec des applications legacy

### Question 106

Dans quel contexte le « PHP Bridge session » est-il utile ? *(une seule bonne réponse)*

- [ ] **A.** Pour intégrer Symfony dans une application legacy qui démarre elle-même la session via `session_start()`
- [ ] **B.** Uniquement pour les tests fonctionnels
- [ ] **C.** Pour connecter Symfony à une session stockée sur un CDN
- [ ] **D.** Pour désactiver complètement les sessions Symfony

### Question 107

Si l'application legacy possède son propre handler de sauvegarde PHP, comment configurer Symfony pour s'y interfacer ? *(une seule bonne réponse)*

- [ ] **A.** `storage_factory_id: session.storage.factory.php_bridge` avec `handler_id: ~`
- [ ] **B.** `storage_factory_id: session.storage.factory.native` avec `handler_id: legacy`
- [ ] **C.** Il faut désactiver complètement le composant HttpFoundation
- [ ] **D.** `handler_id: session.handler.native_file` uniquement, sans changer `storage_factory_id`

### Question 108

Dans l'exemple PHP standalone du pont avec une application legacy, quelle classe de stockage est utilisée ? *(une seule bonne réponse)*

- [ ] **A.** `NativeSessionStorage`
- [ ] **B.** `PhpBridgeSessionStorage`
- [ ] **C.** `LegacySessionStorage`
- [ ] **D.** `MigratingSessionStorage`

### Question 109

Si l'on ne peut pas empêcher l'application legacy d'appeler `session_start()`, mais que l'on souhaite quand même utiliser un handler Symfony, quelle configuration utiliser ? *(une seule bonne réponse)*

- [ ] **A.** `storage_factory_id: session.storage.factory.php_bridge` avec `handler_id: session.handler.native_file`
- [ ] **B.** `storage_factory_id: session.storage.factory.native` avec `handler_id: ~`
- [ ] **C.** Ce cas n'est pas gérable, il faut migrer complètement l'application
- [ ] **D.** `handler_id` doit rester vide dans tous les cas

### Question 110

Pourquoi ne faut-il **pas** surcharger le save handler si l'application legacy a déjà démarré sa propre session avant l'initialisation de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'un save handler ne peut plus être changé une fois la session démarrée — il faut alors utiliser `handler_id: ~`
- [ ] **B.** Parce que cela provoque systématiquement une perte totale des données de session
- [ ] **C.** Parce que PHP l'interdit uniquement en production
- [ ] **D.** Ce n'est qu'une recommandation de style, sans conséquence technique réelle

### Question 111

Sous quelle condition la documentation autorise-t-elle malgré tout à surcharger le save handler d'une application legacy ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, c'est totalement déconseillé dans tous les cas
- [ ] **B.** Seulement si l'on est certain que l'application legacy peut utiliser le save handler Symfony sans effet de bord, et que la session n'a pas été démarrée avant l'initialisation de Symfony
- [ ] **C.** Uniquement en environnement `dev`
- [ ] **D.** Uniquement si l'application legacy est elle-même écrite en Symfony 3

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Sessions de la documentation Symfony 8.0](https://symfony.com/doc/8.0/session.html).

**Question 1 : A** — « The Symfony HttpFoundation component has a very powerful and flexible session subsystem […] Symfony sessions are designed to replace the usage of the `$_SESSION` super global and native PHP functions related to manipulating the session like `session_start()`, `session_regenerate_id()`, `session_id()`, `session_name()`, and `session_destroy()`. » *(introduction)*

**Question 2 : B** — « Sessions are only started if you read or write from it. » *(introduction)*

**Question 3 : A** — « Symfony injects the `request_stack` service in services and controllers if you type-hint an argument with `RequestStack` […] Accessing the session in the constructor is *NOT* recommended, since it might not be accessible yet or lead to unwanted side-effects. » *(§ Basic Usage)*

**Question 4 : B** — « From a Symfony controller, you can also type-hint an argument with `Request` […] `$session = $request->getSession();` » *(§ Basic Usage)*

**Question 5 : A** — Exemple standalone : `$session = new Session(); $session->start();` *(§ Basic Usage)*

**Question 6 : B** — « Symfony uses *session bags* linked to the session to encapsulate a specific dataset of **attributes**. This approach mitigates namespace pollution within the `$_SESSION` super-global because each bag stores all its data under a unique namespace […] allows Symfony to peacefully co-exist with other applications or libraries that might use the `$_SESSION` super-global. » *(§ Session Attributes)*

**Question 7 : A** — « `$session->set('attribute-name', 'attribute-value'); … $foo = $session->get('foo'); … $filters = $session->get('filters', []);` » — le second argument de `get()` est « the value returned when the attribute doesn't exist ». *(§ Session Attributes)*

**Question 8 : A** — « By default, session attributes are key-value pairs managed with the `AttributeBag` class. » *(§ Session Attributes)*

**Question 9 : A, B, C** — « Sessions are automatically started whenever you read, write or even check for the existence of data in the session. This may hurt your application performance because all users will receive a session cookie. In order to prevent starting sessions for anonymous users, you must *completely* avoid accessing the session. » D est faux : c'est la protection CSRF **stateful** (« the stateful CSRF protection in forms ») qui est citée, pas stateless. *(§ Session Attributes)*

**Question 10 : B** — « By design, flash messages are meant to be used exactly once: they vanish from the session automatically as soon as you retrieve them. » *(§ Flash Messages)*

**Question 11 : A** — « `$this->addFlash('notice', 'Your changes were saved!');` // `$this->addFlash()` is equivalent to `$request->getSession()->getFlashBag()->add()` » *(§ Flash Messages)*

**Question 12 : B** — « read any flash messages from the session using the `flashes()` method provided by the Twig global `app` variable » : `{% for message in app.flashes('notice') %}`. *(§ Flash Messages)*

**Question 13 : C** — « Alternatively, you can use the `FlashBagInterface::peek` method to retrieve the message while keeping it in the bag » ; l'exemple Twig montre aussi `peekAll()`. *(§ Flash Messages)*

**Question 14 : A, B, C** — Les trois exemples documentés : `app.flashes('notice')`, `app.flashes(['success', 'warning'])`, et `app.flashes` seul pour tout récupérer. `app.flashes.all()` (D) n'est pas une syntaxe de l'article. *(§ Flash Messages)*

**Question 15 : B** — « It's common to use `notice`, `warning` and `error` as the keys of the different types of flash messages, but you can use any key that fits your needs. » *(§ Flash Messages)*

**Question 16 : A** — « Accessing flash messages requires starting the session, which in turn causes Symfony to mark the response as `private`. […] As an alternative, you can load flash messages asynchronously through another HTTP request (for example, using a Twig Live Component), making the original page fully cacheable. » *(§ Flash Messages)*

**Question 17 : A** — Exemple standalone : « // retrieve the flash messages bag `$flashes = $session->getFlashBag();` » *(§ Flash Messages)*

**Question 18 : B** — L'exemple ajoute le flash « if ($form->isSubmitted() && $form->isValid()) { … $this->addFlash(...); return $this->redirectToRoute(...); } ». *(§ Flash Messages)*

**Question 19 : B** — « // display all flashes at once without clearing the flash bag `foreach ($session->getFlashBag()->peekAll() as $type => $messages)` ». *(§ Flash Messages)*

**Question 20 : B** — « In the Symfony framework, sessions are enabled by default. Session storage and other configuration can be controlled under the `framework.session` configuration in `config/packages/framework.yaml`. » *(§ Configuration)*

**Question 21 : B** — « Setting the `handler_id` config option to `null` means that Symfony will use the native PHP session mechanism. The session metadata files will be stored outside of the Symfony application, in a directory controlled by PHP. » *(§ Configuration)*

**Question 22 : B** — « Although this usually simplifies things, some session expiration related options may not work as expected if other applications that write to the same directory have short max lifetime settings. » *(§ Configuration)*

**Question 23 : A** — « If you prefer, you can use the `session.handler.native_file` service as `handler_id` to let Symfony manage the sessions itself. Another useful option is `save_path` […] » *(§ Configuration)*

**Question 24 : B** — « Symfony sessions are incompatible with `php.ini` directive `session.auto_start = 1` This directive should be turned off in `php.ini`, in the web server directives or in `.htaccess`. » *(§ Configuration)*

**Question 25 : B** — « The session cookie is also available in the Response object. This is useful to get that cookie in the CLI context or when using PHP runners like Roadrunner or Swoole. » *(§ Configuration)*

**Question 26 : A, B, C** — Extrait de l'exemple : `cookie_secure: auto`, `cookie_samesite: lax`, `storage_factory_id: session.storage.factory.native`. D est faux : la valeur par défaut montrée pour `handler_id` est `null`, pas `session.handler.native_file`. *(§ Configuration)*

**Question 27 : A** — Exemple standalone : `$storage = new NativeSessionStorage([...]); $session = new Session($storage);` *(§ Configuration)*

**Question 28 : B** — « Check out the Symfony config reference to learn more about the other available Session configuration options. » *(§ Configuration)*

**Question 29 : B** — Voir Question 23 : « you can use the `session.handler.native_file` service as `handler_id` to let Symfony manage the sessions itself. » *(§ Configuration)*

**Question 30 : B** — « Setting the cookie lifetime here is not appropriate because that can be manipulated by the client, so we must do the expiry on the server side. » *(§ Session Idle Time/Keep Alive)*

**Question 31 : A** — « The easiest way is to implement this via session garbage collection which runs reasonably frequently. The `cookie_lifetime` would be set to a relatively high value, and the garbage collection `gc_maxlifetime` would be set to destroy sessions at whatever the desired idle period is. » *(§ Session Idle Time/Keep Alive)*

**Question 32 : A** — « The other option is specifically check if a session has expired after the session is started. […] This method of processing can allow the expiry of sessions to be integrated into the user experience, for example, by displaying a message. » *(§ Session Idle Time/Keep Alive)*

**Question 33 : A, B** — « `$session->getMetadataBag()->getCreated(); $session->getMetadataBag()->getLastUsed();` Both methods return a Unix timestamp (relative to the server). » ; « It is also possible to tell what the `cookie_lifetime` was set to for a particular cookie by reading the `getLifetime()` method. » `getExpiresAt()` et `getIdleTime()` (C, D) ne sont pas des méthodes documentées. *(§ Session Idle Time/Keep Alive)*

**Question 34 : A** — « `$session->start(); if (time() - $session->getMetadataBag()->getLastUsed() > $maxIdleTime) { $session->invalidate(); throw new SessionExpired(); // redirect to expired session page }` » *(§ Session Idle Time/Keep Alive)*

**Question 35 : A** — « The expiry time of the cookie can be determined by adding the created timestamp and the lifetime. » *(§ Session Idle Time/Keep Alive)*

**Question 36 : B** — Voir Question 33 : « Both methods return a Unix timestamp (relative to the server). » *(§ Session Idle Time/Keep Alive)*

**Question 37 : B** — « When a session opens, PHP will call the `gc` handler randomly according to the probability set by `session.gc_probability` / `session.gc_divisor`. For example if these were set to `5/100` respectively, it would mean a probability of 5%. » *(§ Configuring Garbage Collection)*

**Question 38 : A** — « If the garbage collection handler is invoked, PHP will pass the value stored in the `php.ini` directive `session.gc_maxlifetime`. […] any stored session that was saved more than `gc_maxlifetime` ago should be deleted. » *(§ Configuring Garbage Collection)*

**Question 39 : A** — « some operating systems (e.g. Debian) manage session handling differently and set the `session.gc_probability` variable to `0` to prevent PHP from performing garbage collection. By default, Symfony uses the value of the `gc_probability` directive set in the `php.ini` file. » *(§ Configuring Garbage Collection)*

**Question 40 : B** — « If you can't modify this PHP setting, you can configure it directly in Symfony: `framework: session: gc_probability: 1` » *(§ Configuring Garbage Collection)*

**Question 41 : A** — « Alternatively, you can configure these settings by passing `gc_probability`, `gc_divisor` and `gc_maxlifetime` in an array to the constructor of `NativeSessionStorage` or to the `setOptions()` method. » *(§ Configuring Garbage Collection)*

**Question 42 : C** — « Similarly, `3/4` would mean a 3 in 4 chance of being called, i.e. 75%. » *(§ Configuring Garbage Collection)*

**Question 43 : A** — « Symfony stores sessions in files by default. If your application is served by multiple servers, you'll need to use a database instead to make sessions work across different servers. Symfony can store sessions in all kinds of databases […] but recommends key-value databases like Redis to get best performance. » *(§ Store Sessions in a Database)*

**Question 44 : A, B** — « The first option is to configure the Redis session handler directly in the server `php.ini` file. This approach uses PHP's native session locking […] The second option is to configure Redis sessions in Symfony » via le service `RedisSessionHandler`. *(§ Store Sessions in a key-value Database (Redis))*

**Question 45 : B** — « This approach uses PHP's native session locking, which prevents race conditions when multiple requests access the same session. » *(§ Store Sessions in a key-value Database (Redis))*

**Question 46 : B** — « use the `handler_id` configuration option to tell Symfony to use this service as the session handler: `framework: session: handler_id: Symfony\…\RedisSessionHandler` » *(§ Store Sessions in a key-value Database (Redis))*

**Question 47 : A, B, C** — « you can also use `\RedisArray`, `\RedisCluster`, `\Relay\Relay` or `\Predis\Client` classes ». `\Memcached` (D) a son propre handler dédié (`MemcachedSessionHandler`), cité séparément. *(§ Store Sessions in a key-value Database (Redis))*

**Question 48 : A** — « The only options are 'prefix' and 'ttl', which define the prefix to use for the keys to avoid collision on the Redis server and the expiration time for any given entry (in seconds), defaults are 'sf_s' and null. » *(§ Store Sessions in a key-value Database (Redis))*

**Question 49 : B** — « `RedisSessionHandler` does not perform session locking. If your application makes concurrent requests that write to the session (e.g. JavaScript requests), this can cause *race conditions* and data loss. A typical symptom is an *"Invalid CSRF token"* error when two requests run in parallel and only one stores the CSRF token. » *(§ Store Sessions in a key-value Database (Redis))*

**Question 50 : A** — « To get session locking, use the `php.ini`-based option described above, which relies on PHP's native Redis session handler. » *(§ Store Sessions in a key-value Database (Redis))*

**Question 51 : B** — « If you use Memcached instead of Redis, follow a similar approach but replace `RedisSessionHandler` by `MemcachedSessionHandler`. The same session locking limitation applies; to enable locking, configure Memcached as the session handler via `php.ini` instead (the Memcached PECL extension enables session locking by default). » *(§ Store Sessions in a key-value Database (Redis))*

**Question 52 : B** — « When using Valkey servers, you can use the `valkey:` or `valkeys:` DSN schemes instead of `redis:` or `rediss:` in the session handler configuration. » *(§ Store Sessions in a key-value Database (Redis))*

**Question 53 : A** — « Symfony includes a `PdoSessionHandler` to store sessions in relational databases like MariaDB, MySQL and PostgreSQL. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 54 : A** — Exemple de service : `PdoSessionHandler: arguments: - '%env(DATABASE_URL)%'`. *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 55 : A** — « When using MySQL as the database, the DSN defined in `DATABASE_URL` can contain the `charset` and `unix_socket` options as query string parameters. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 56 : A, B, C** — « `db_table` (default `sessions`) […] `db_id_col` (default `sess_id`) […] `lock_mode` (default: `LOCK_TRANSACTIONAL`) ». D est faux : le défaut de `db_data_col` est `sess_data`, pas `session_data`. *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 57 : A** — « `lock_mode` (default: `LOCK_TRANSACTIONAL`) The strategy for locking the database to avoid *race conditions*. Possible values are `LOCK_NONE` (no locking), `LOCK_ADVISORY` (application-level locking) and `LOCK_TRANSACTIONAL` (row-level locking). » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 58 : A** — « With Doctrine installed, the session table will be automatically generated when you run the `make:migration` command if the database targeted by doctrine is identical to the one used by this component. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 59 : A** — « the session handler provides a method called `createTable` to set up this table for you […] If the table already exists an exception will be thrown. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 60 : A** — Schéma SQL MariaDB/MySQL : `` `sess_id` VARBINARY(128) NOT NULL PRIMARY KEY ``. *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 61 : A** — « A `BLOB` column type (which is the one used by default by `createTable()`) stores up to 64 kb. If the user session data exceeds this, an exception may be thrown or their session will be silently reset. Consider using a `MEDIUMBLOB` if you need more space. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 62 : B** — « You can configure these values with the second argument passed to the `PdoSessionHandler` service » : `arguments: - '%env(DATABASE_URL)%' - { db_table: 'customer_session', db_id_col: 'guid' }`. *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 63 : A** — « it's recommended to generate an empty database migration with the following command: `$ php bin/console doctrine:migrations:generate` […] run the migration with […] `$ php bin/console doctrine:migrations:migrate` » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 64 : A** — « you can also add this table to your schema by calling `PdoSessionHandler::configureSchema` method in your code. » *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 65 : B** — Schéma PostgreSQL : `sess_data BYTEA NOT NULL` (contre `BLOB` en MySQL) et « `CREATE INDEX sess_lifetime_idx ON sessions (sess_lifetime);` » en instruction séparée. *(§ Store Sessions in a Relational Database (MariaDB, MySQL, PostgreSQL))*

**Question 66 : B** — « Symfony includes a `MongoDbSessionHandler` to store sessions in the MongoDB NoSQL database. » *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 67 : B** — « the required parameters: `database`: The name of the database ; `collection`: The name of the collection ». *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 68 : B** — « You do not need to do anything to initialize your session collection. However, you may want to add an index to improve garbage collection performance […] `db.session.createIndex( { "expires_at": 1 }, { expireAfterSeconds: 0 } )` » *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 69 : A, B, C** — « `id_field` (default `_id`) […] `data_field` (default `data`) […] `expiry_field` (default `expires_at`) ». D est faux : le défaut de `time_field` est `time`, pas `created_at`. *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 70 : B** — « make sure to have a working MongoDB connection in your Symfony application as explained in the `DoctrineMongoDBBundle configuration` article. » *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 71 : A** — « use the `handler_id` configuration option to tell Symfony to use this service as the session handler: `handler_id: Symfony\…\MongoDbSessionHandler` » *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 72 : B** — Exemple de service : `arguments: - '@doctrine_mongodb.odm.default_connection'`. *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 73 : B** — « `expiry_field` (default `expires_at`): The name of the field where to store the session lifetime. » *(§ Store Sessions in a NoSQL Database (MongoDB))*

**Question 74 : B** — « use the `MigratingSessionHandler` to migrate between old and new save handlers without losing session data. » *(§ Migrating Between Session Handlers)*

**Question 75 : A** — « Switch to the migrating handler, with your new handler as the write-only one. The old handler behaves as usual and sessions get written to the new one: `$sessionStorage = new MigratingSessionHandler($oldSessionStorage, $newSessionStorage);` » *(§ Migrating Between Session Handlers)*

**Question 76 : B** — « After your session gc period, verify that the data in the new handler is correct. » *(§ Migrating Between Session Handlers)*

**Question 77 : A** — « Update the migrating handler to use the old handler as the write-only one, so the sessions will now be read from the new handler. This step allows easier rollbacks. » *(§ Migrating Between Session Handlers)*

**Question 78 : B** — « After verifying that the sessions in your application are working, switch from the migrating handler to the new handler. » *(§ Migrating Between Session Handlers)*

**Question 79 : B** — « Symfony by default will use PHP's ini setting `session.gc_maxlifetime` as session lifetime. » *(§ Configuring the Session TTL)*

**Question 80 : A** — « Changing the ini setting is not possible once the session is started so if you want to use a different TTL depending on which user is logged in, you must do it at runtime using the callback method below. » *(§ Configuring the Session TTL)*

**Question 81 : A** — Exemple : `RedisSessionHandler: arguments: - '@Redis' - { 'ttl': 600 }`. *(§ Configuring the Session TTL)*

**Question 82 : B** — « this is also possible by passing a callback as the TTL value. The callback will be called right before the session is written and has to return an integer which will be used as TTL. » *(§ Configuring the Session TTL)*

**Question 83 : A** — Exemple YAML : `- { 'ttl': !closure '@my.ttl.handler' }`, avec `my.ttl.handler: class: Some\InvokableClass # some class with an __invoke() method`. *(§ Configuring the Session TTL)*

**Question 84 : B** — « has to return an integer which will be used as TTL. » *(§ Configuring the Session TTL)*

**Question 85 : B** — « Symfony stores the locale setting in the Request, which means that this setting is not automatically saved ("sticky") across requests. But, you *can* store the locale in the session, so that it's used on subsequent requests. » *(§ Making the Locale "Sticky" during a User's Session)*

**Question 86 : B** — Le subscriber déclare `KernelEvents::REQUEST => [['onKernelRequest', 20]]`. *(§ Creating a LocaleSubscriber)*

**Question 87 : B** — « if (!$request->hasPreviousSession()) { return; } » en tout début de méthode. *(§ Creating a LocaleSubscriber)*

**Question 88 : B** — « if ($locale = $request->attributes->get('_locale')) { $request->getSession()->set('_locale', $locale); } » *(§ Creating a LocaleSubscriber)*

**Question 89 : B** — « else { // if no explicit locale has been set on this request, use one from the session `$request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));` } » *(§ Creating a LocaleSubscriber)*

**Question 90 : B** — « // must be registered before (i.e. with a higher priority than) the default Locale listener `KernelEvents::REQUEST => [['onKernelRequest', 20]]` » *(§ Creating a LocaleSubscriber)*

**Question 91 : B** — « If you're using the default `services.yaml` configuration, you're done! Symfony will automatically know about the event subscriber and call the `onKernelRequest` method on each request. » *(§ Creating a LocaleSubscriber)*

**Question 92 : B** — « since the `LocaleSubscriber` is called before the `FirewallListener`, which is responsible for handling authentication and setting the user token on the `TokenStorage`, you have no access to the user which is logged in. » *(§ Setting the Locale Based on the User's Preferences)*

**Question 93 : A** — « To do this, you need an event subscriber on the `LoginSuccessEvent::class` event » : `UserLocaleSubscriber::onLoginSuccess()` stocke `$user->getLocale()` en session. *(§ Setting the Locale Based on the User's Preferences)*

**Question 94 : B** — « In order to update the language immediately after a user has changed their language preferences, you also need to update the session when you change the `User` entity. » *(§ Setting the Locale Based on the User's Preferences)*

**Question 95 : A** — « Rather than using the regular session handler, you can create a custom save handler by defining a class that extends the `SessionHandlerProxy` class. » *(§ Session Proxies)*

**Question 96 : B** — « use the `framework.session.handler_id` configuration option to tell Symfony to use your session handler instead of the default one. » *(§ Session Proxies)*

**Question 97 : A** — « this article demonstrates two common ones […] two common use cases: encrypt session information and define read-only guest sessions. » *(§ Session Proxies)*

**Question 98 : A, B, D** — La classe `EncryptedSessionProxy` surcharge `read($id)` (déchiffre via `Crypto::decrypt`) et `write($id, $data)` (chiffre via `Crypto::encrypt`), et son constructeur reçoit `\SessionHandlerInterface $handler` + `Key $key`, transmis via `parent::__construct($handler)`. `open()`/`close()` (C) ne figurent pas dans l'exemple. *(§ Encryption of Session Data)*

**Question 99 : A** — « Another way to encrypt session data is to decorate the `session.marshaller` service, which points to `MarshallingSessionHandler`. You can decorate this handler with a marshaller that uses encryption, like the `SodiumMarshaller`. » *(§ Encryption of Session Data)*

**Question 100 : A** — « First, you need to generate a secure key and add it to your secret store as `SESSION_DECRYPTION_FILE`: `$ php -r 'echo base64_encode(sodium_crypto_box_keypair());'` » *(§ Encryption of Session Data)*

**Question 101 : A** — Exemple : `SodiumMarshaller: decorates: 'session.marshaller' arguments: - ['%env(file:resolve:SESSION_DECRYPTION_FILE)%'] - '@.inner'`. *(§ Encryption of Session Data)*

**Question 102 : A** — « This will encrypt the values of the cache items, but not the cache keys. Be careful not to leak sensitive data in the keys. » *(§ Encryption of Session Data)*

**Question 103 : B** — « public function write($id, $data): string { if ($this->getUser() && $this->getUser()->isGuest()) { return; } return parent::write($id, $data); } » *(§ Read-only Guest Sessions)*

**Question 104 : B** — « There are some applications where a session is required for guest users, but where there is no particular need to persist the session. » *(§ Read-only Guest Sessions)*

**Question 105 : B** — Le constructeur de `ReadOnlySessionProxy` reçoit un `Symfony\Bundle\SecurityBundle\Security $security`, et `getUser()` privée appelle `$this->security->getUser()`. *(§ Read-only Guest Sessions)*

**Question 106 : A** — « If you're integrating the Symfony full-stack Framework into a legacy application that starts the session with `session_start()`, you may still be able to use Symfony's session management by using the PHP Bridge session. » *(§ Integrating with Legacy Applications)*

**Question 107 : A** — « If the application has its own PHP save handler, you can specify `null` for the `handler_id`: `storage_factory_id: session.storage.factory.php_bridge handler_id: ~` » *(§ Integrating with Legacy Applications)*

**Question 108 : B** — Exemple standalone : « `$session = new Session(new PhpBridgeSessionStorage());` » *(§ Integrating with Legacy Applications)*

**Question 109 : A** — « if the problem is that you cannot avoid the application starting the session with `session_start()`, you can still make use of a Symfony based session save handler […] `storage_factory_id: session.storage.factory.php_bridge handler_id: session.handler.native_file` » *(§ Integrating with Legacy Applications)*

**Question 110 : A** — « Note that a save handler cannot be changed once the session has been started. If the application starts the session before Symfony is initialized, the save handler will have already been set. In this case, you will need `handler_id: ~`. » *(§ Integrating with Legacy Applications)*

**Question 111 : B** — « Only override the save handler if you are sure the legacy application can use the Symfony save handler without side effects and that the session has not been started before Symfony is initialized. » *(§ Integrating with Legacy Applications)*
