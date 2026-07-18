# QCM — La sécurité (authentification et autorisation)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/security.html](https://symfony.com/doc/8.0/security.html) (couvre à la fois Introduction, The User, The Firewall et Access Control/Authorization — ce sont des ancres de cette même page, pas des pages séparées) et les pages de sa section [Learn More](https://symfony.com/doc/8.0/security.html#learn-more) · **Généré le :** 22 juillet 2026
>
> **299 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et vue d'ensemble

### Question 1

Quelle commande installe le SecurityBundle ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/authentication-bundle`
- [ ] **B.** `composer require symfony/security-bundle`
- [ ] **C.** `composer require symfony/security`
- [ ] **D.** Il est installé par défaut avec `symfony/framework-bundle`

### Question 2

Que crée automatiquement l'installation via Symfony Flex ? *(une seule bonne réponse)*

- [ ] **A.** Une base de données d'utilisateurs de test
- [ ] **B.** Un contrôleur de connexion complet, prêt à l'emploi
- [ ] **C.** Rien, toute la configuration doit être écrite manuellement
- [ ] **D.** Un fichier `config/packages/security.yaml` déjà pré-configuré

### Question 3

Quels sont les trois éléments principaux autour desquels s'articule la configuration de sécurité ? *(plusieurs bonnes réponses)*

- [ ] **A.** `providers` (the User)
- [ ] **B.** `firewalls` (the Firewall & Authenticating Users)
- [ ] **C.** `access_control` (Authorization)
- [ ] **D.** `routers` (le routage des utilisateurs)

## La classe User

### Question 4

Quelle interface une classe utilisateur doit-elle implémenter pour être reconnue par Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `PrincipalInterface`
- [ ] **B.** `UserInterface`
- [ ] **C.** `SecurityUserInterface`
- [ ] **D.** `AuthenticatableInterface`

### Question 5

Quelle commande du MakerBundle génère la classe utilisateur la plus simplement possible ? *(une seule bonne réponse)*

- [ ] **A.** `make:security:user`
- [ ] **B.** `make:entity:user`
- [ ] **C.** `make:security:form-login`
- [ ] **D.** `make:user`

### Question 6

Quelles options peut-on passer à `make:user` pour utiliser un type d'identifiant spécifique plutôt qu'un entier ? *(plusieurs bonnes réponses)*

- [ ] **A.** `--with-uuid`
- [ ] **B.** `--with-ulid`
- [ ] **C.** `--with-guid`
- [ ] **D.** `--with-snowflake`

### Question 7

Si la classe utilisateur est une entité Doctrine, que faut-il faire après sa génération pour que la table existe en base ? *(une seule bonne réponse)*

- [ ] **A.** Redémarrer le serveur, qui synchronise automatiquement le schéma
- [ ] **B.** Créer puis exécuter une migration (`make:migration` puis `doctrine:migrations:migrate`)
- [ ] **C.** Rien, la table est créée automatiquement au premier accès
- [ ] **D.** Exécuter `doctrine:database:create` uniquement

## Charger l'utilisateur : le user provider

### Question 8

À quoi sert un « user provider » ? *(une seule bonne réponse)*

- [ ] **A.** À décider si un utilisateur a le rôle requis pour accéder à une ressource
- [ ] **B.** À générer les tokens CSRF pour les formulaires de connexion
- [ ] **C.** À charger (et recharger) les utilisateurs depuis un stockage, sur la base d'un « identifiant utilisateur »
- [ ] **D.** À hasher les mots de passe des utilisateurs avant stockage

### Question 9

À quels deux moments du cycle de vie de la sécurité un user provider est-il sollicité ? *(plusieurs bonnes réponses)*

- [ ] **A.** Au chargement de l'utilisateur à partir d'un identifiant (ex. lors du login)
- [ ] **B.** Au rechargement de l'utilisateur depuis la session, en début de chaque requête (sauf firewall stateless)
- [ ] **C.** À chaque appel à `isGranted()`, pour revalider entièrement l'utilisateur
- [ ] **D.** Uniquement lors de la déconnexion

### Question 10

Quels sont les user providers intégrés à Symfony ? *(plusieurs bonnes réponses)*

- [ ] **A.** Entity (via Doctrine) et LDAP
- [ ] **B.** Memory (fichier de configuration) et Chain (fusion de plusieurs providers)
- [ ] **C.** Redis et Elasticsearch
- [ ] **D.** JWT

### Question 11

Combien de user providers un firewall peut-il avoir, et quel intérêt cela donne-t-il au provider « chain » ? *(une seule bonne réponse)*

- [ ] **A.** Zéro ou un, le firewall pouvant fonctionner totalement sans provider
- [ ] **B.** Exactement deux, un pour le login et un pour le rechargement de session
- [ ] **C.** Exactement un seul ; le provider « chain » permet de fusionner plusieurs providers en un seul pour contourner cette limite
- [ ] **D.** Autant que nécessaire, sans limite, ce qui rend le provider « chain » inutile

### Question 12

Quel est le format de l'identifiant de service généré pour chaque user provider configuré ? *(une seule bonne réponse)*

- [ ] **A.** `security.provider.<nom-du-provider>.user`
- [ ] **B.** `app.user_provider.<nom-du-provider>`
- [ ] **C.** Il n'existe pas de convention de nommage prévisible pour ces services
- [ ] **D.** `security.user.provider.concrete.<nom-du-provider>`

### Question 13

Comment injecter automatiquement l'unique user provider d'une application dans un service personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est jamais possible sans référencer explicitement le service par son ID
- [ ] **B.** En type-hintant directement la classe `User` de l'application
- [ ] **C.** Uniquement via une factory manuelle, l'autowiring ne fonctionnant pas pour les providers
- [ ] **D.** En type-hintant `UserProviderInterface`, qui sera autowiré

## Enregistrer l'utilisateur : hasher les mots de passe

### Question 14

Quelle interface la classe User doit-elle implémenter pour bénéficier du hashing/vérification de mot de passe ? *(une seule bonne réponse)*

- [ ] **A.** `HashableUserInterface`
- [ ] **B.** `CredentialsInterface`
- [ ] **C.** `PasswordHasherAwareInterface` uniquement, qui suffit à elle seule
- [ ] **D.** `PasswordAuthenticatedUserInterface`

### Question 15

Quel réglage de `password_hashers` sélectionne automatiquement le meilleur algorithme disponible sur le système ? *(une seule bonne réponse)*

- [ ] **A.** `'native'`, qui est en réalité l'algorithme recommandé par défaut
- [ ] **B.** `'auto'`
- [ ] **C.** `'best'`
- [ ] **D.** `'default'`

### Question 16

Quel service utilise-t-on pour hasher un mot de passe en clair avant de l'enregistrer sur l'objet utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de service dédié, il faut utiliser `password_hash()` de PHP directement
- [ ] **B.** `UserPasswordHasherInterface`, via sa méthode `hashPassword()`
- [ ] **C.** `PasswordHasherFactory`, injecté directement dans le contrôleur
- [ ] **D.** Le service `translator`, qui gère aussi le hashing en interne

### Question 17

Si la classe utilisateur est une entité Doctrine et que les mots de passe sont hashés, quelle interface le repository associé doit-il implémenter ? *(une seule bonne réponse)*

- [ ] **A.** `PasswordAuthenticatedUserInterface`, la même que sur l'entité
- [ ] **B.** `RepositoryPasswordInterface`
- [ ] **C.** Aucune interface supplémentaire n'est nécessaire pour le repository
- [ ] **D.** `PasswordUpgraderInterface`

### Question 18

Quel bundle tiers, combiné au MakerBundle, aide à mettre en place un flux d'inscription avec vérification d'email ? *(une seule bonne réponse)*

- [ ] **A.** Aucun bundle n'est nécessaire, cette fonctionnalité étant native au SecurityBundle
- [ ] **B.** `symfonycasts/reset-password-bundle`, le même que pour la réinitialisation de mot de passe
- [ ] **C.** `symfonycasts/verify-email-bundle`, via la commande `make:registration-form`
- [ ] **D.** `symfony/verify-email-bundle`, maintenu par l'équipe cœur de Symfony

### Question 19

Quelle commande permet de hasher manuellement un mot de passe depuis la console ? *(une seule bonne réponse)*

- [ ] **A.** `make:password-hash`
- [ ] **B.** `debug:security:hash`
- [ ] **C.** `security:hash-password`
- [ ] **D.** `security:password:hash`

## Le firewall

### Question 20

Que représente un « firewall » dans la configuration de sécurité Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Une simple alias de configuration pour le `access_control`
- [ ] **B.** Le système d'authentification : il définit quelles parties de l'application sont sécurisées et comment les utilisateurs peuvent s'authentifier
- [ ] **C.** Un pare-feu réseau au sens strict, filtrant les adresses IP
- [ ] **D.** Le mécanisme exclusif de gestion des rôles et permissions

### Question 21

Un firewall sans clé `pattern` correspond-il à toutes les requêtes, et où doit-il être placé dans la configuration ? *(une seule bonne réponse)*

- [ ] **A.** Non, un firewall sans `pattern` ne correspond à aucune requête
- [ ] **B.** Oui, mais son ordre de déclaration n'a aucune importance
- [ ] **C.** Non, un `pattern` implicite `^/` est toujours ajouté automatiquement
- [ ] **D.** Oui, il correspond à toutes les URLs ; il doit être défini en dernier, car l'ordre de déclaration des firewalls est important

### Question 22

À quoi sert typiquement le firewall `dev` avec un `pattern` ciblant `_profiler`/`_wdt`/`assets`/`build`, combiné à `security: false` ? *(une seule bonne réponse)*

- [ ] **A.** À désactiver complètement la sécurité en environnement de développement
- [ ] **B.** À forcer l'authentification sur les outils de développement
- [ ] **C.** À rediriger les requêtes de développement vers un environnement de test
- [ ] **D.** À s'assurer que les outils de développement Symfony et les assets statiques ne sont jamais bloqués accidentellement

### Question 23

Que permet l'option `lazy: true` sur un firewall, et pourquoi est-ce important pour la mise en cache HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Elle retarde le chargement du firewall jusqu'à la fin de la requête
- [ ] **B.** Elle désactive totalement le cache HTTP pour ce firewall
- [ ] **C.** Elle force le démarrage systématique de la session dès la première requête
- [ ] **D.** Elle évite de démarrer la session s'il n'y a pas besoin d'autorisation explicite, ce qui garde les requêtes « cacheables »

### Question 24

Comment faire correspondre un firewall à plusieurs routes distinctes sans écrire une seule regex complexe ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `patterns` (au pluriel), distincte de `pattern`
- [ ] **B.** En passant un tableau de regex plus simples à l'option `pattern`
- [ ] **C.** Ce n'est pas possible, une seule regex `pattern` étant acceptée
- [ ] **D.** En déclarant plusieurs firewalls portant le même nom

### Question 25

Comment récupérer, depuis un service, la configuration du firewall qui a géré la requête courante ? *(une seule bonne réponse)*

- [ ] **A.** Via `$request->getFirewall()`, une méthode native de l'objet `Request`
- [ ] **B.** En injectant le service `Security` et en appelant `getFirewallConfig($request)`
- [ ] **C.** En appelant cette méthode directement dans le constructeur du service, dès l'injection
- [ ] **D.** Ce n'est accessible que depuis un contrôleur, jamais depuis un service

## Authentifier les utilisateurs

### Question 26

Parmi les mécanismes suivants, lesquels sont des authenticators intégrés au SecurityBundle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Form Login et JSON Login
- [ ] **B.** HTTP Basic et Login Link
- [ ] **C.** X.509 Client Certificates et Remote Users
- [ ] **D.** OAuth2 et SAML, intégrés nativement au composant Security

## Form Login

### Question 27

Quelle commande génère automatiquement le contrôleur, le template et la configuration nécessaires à un formulaire de connexion ? *(une seule bonne réponse)*

- [ ] **A.** `make:login-form`
- [ ] **B.** `make:security:login`
- [ ] **C.** `make:controller:login`
- [ ] **D.** `make:security:form-login`

### Question 28

Quelles options du firewall activent le `FormLoginAuthenticator` et définissent les routes de login/soumission ? *(une seule bonne réponse)*

- [ ] **A.** `form_login` avec `route` et `target`
- [ ] **B.** `login_form` avec `path` et `submit_path`
- [ ] **C.** `authentication` avec `login` et `check`
- [ ] **D.** `form_login` avec `login_path` et `check_path`

### Question 29

Que se passe-t-il, une fois `form_login` activé, quand un visiteur non authentifié tente d'accéder à une page sécurisée ? *(une seule bonne réponse)*

- [ ] **A.** Il est automatiquement authentifié en tant qu'utilisateur anonyme
- [ ] **B.** La page s'affiche normalement, sans aucune redirection
- [ ] **C.** Il est redirigé vers le `login_path` configuré
- [ ] **D.** Une erreur 500 est levée systématiquement

### Question 30

Quelle classe permet de récupérer, dans le contrôleur du formulaire de connexion, la dernière erreur d'authentification et le dernier nom d'utilisateur saisi ? *(une seule bonne réponse)*

- [ ] **A.** `AuthenticationException`, directement injectée dans le contrôleur
- [ ] **B.** `AuthenticationUtils`
- [ ] **C.** `SecurityContext`
- [ ] **D.** `LoginErrorResolver`

### Question 31

Pourquoi ne faut-il jamais afficher `error.message` dans le template de connexion, et que faut-il utiliser à la place ? *(une seule bonne réponse)*

- [ ] **A.** `error.message` n'existe pas sur `AuthenticationException`, seul `messageKey` existe
- [ ] **B.** `error.message` est toujours vide, contrairement à `messageKey`
- [ ] **C.** Il n'y a pas de différence réelle, c'est une simple recommandation stylistique
- [ ] **D.** `error.message` peut contenir des informations sensibles ; il faut utiliser `error.messageKey` (avec `error.messageData`), toujours sûr à afficher

### Question 32

Quels noms de champs le formulaire de connexion doit-il utiliser par convention pour l'identifiant et le mot de passe ? *(une seule bonne réponse)*

- [ ] **A.** `email` et `secret`
- [ ] **B.** `_username` et `_password`
- [ ] **C.** `username` et `password`, sans underscore
- [ ] **D.** `login` et `pwd`

### Question 33

Que dit l'avertissement (« danger ») de la documentation à propos du formulaire de connexion basique généré dans l'exemple ? *(une seule bonne réponse)*

- [ ] **A.** Il expose le mot de passe en clair dans les logs
- [ ] **B.** Il ne fonctionne qu'en HTTPS, jamais en HTTP
- [ ] **C.** Il ne peut être utilisé qu'une seule fois par session
- [ ] **D.** Il n'est pas protégé contre les attaques CSRF par défaut, une configuration additionnelle étant nécessaire

### Question 34

Comment activer la protection CSRF sur le formulaire de connexion, et quel est le nom de champ/valeur de token attendus par défaut ? *(une seule bonne réponse)*

- [ ] **A.** La protection CSRF du login est toujours activée automatiquement, sans configuration
- [ ] **B.** Via l'attribut `#[IsCsrfTokenValid]` posé directement sur le contrôleur de login
- [ ] **C.** Via `form_login.enable_csrf: true` ; le champ caché doit s'appeler `_csrf_token` et la chaîne générant le token doit être `authenticate`
- [ ] **D.** Via `form_login.csrf: true` ; aucun nom de champ particulier n'est requis

### Question 35

Comment personnaliser le nom du champ CSRF et l'identifiant du token du formulaire de connexion ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement via un thème de formulaire personnalisé, aucune option de configuration n'existant
- [ ] **B.** Via les options `csrf_parameter` et `csrf_token_id`
- [ ] **C.** Via les options `csrf_field_name` et `csrf_domain`
- [ ] **D.** Ce n'est pas personnalisable pour le formulaire de connexion

## JSON Login

### Question 36

Quelle option de firewall active l'authenticator pour une API basée sur JSON ? *(une seule bonne réponse)*

- [ ] **A.** `api_login`
- [ ] **B.** `form_login` avec l'option `format: json`
- [ ] **C.** `json_authenticator`
- [ ] **D.** `json_login`, avec l'option `check_path`

### Question 37

Sous quelle forme un client doit-il envoyer ses identifiants pour déclencher le JSON Login ? *(une seule bonne réponse)*

- [ ] **A.** Une requête POST classique avec un corps `application/x-www-form-urlencoded`
- [ ] **B.** Les identifiants doivent toujours être encodés en Base64 dans l'en-tête `Authorization`
- [ ] **C.** Une requête POST avec l'en-tête `Content-Type: application/json` et un corps contenant `username`/`password`
- [ ] **D.** Une requête GET avec les identifiants en paramètres de requête

### Question 38

Que se passe-t-il si les identifiants soumis au JSON Login sont incorrects ? *(une seule bonne réponse)*

- [ ] **A.** Une exception fatale PHP est levée, sans réponse HTTP structurée
- [ ] **B.** L'utilisateur est silencieusement connecté en tant qu'invité
- [ ] **C.** Une réponse JSON HTTP 401 Unauthorized est retournée
- [ ] **D.** Le contrôleur défini pour `check_path` est appelé normalement, à charge pour lui de détecter l'échec

### Question 39

L'attribut `#[CurrentUser]` peut-il être utilisé pour récupérer l'utilisateur authentifié depuis un service quelconque ? *(une seule bonne réponse)*

- [ ] **A.** Non, cet attribut n'existe que pour les formulaires, jamais pour JSON Login
- [ ] **B.** Oui, mais uniquement si le service implémente `UserAwareInterface`
- [ ] **C.** Non, il ne peut être utilisé que sur un argument de contrôleur ; dans un service, il faut utiliser `Security::getUser()`
- [ ] **D.** Oui, il fonctionne de façon identique dans les contrôleurs et les services

## HTTP Basic, Login Link, Access Tokens

### Question 40

Comment active-t-on l'authentification HTTP Basic sur un firewall ? *(une seule bonne réponse)*

- [ ] **A.** Via `basic_auth: true`
- [ ] **B.** HTTP Basic est toujours activé par défaut, sans configuration
- [ ] **C.** Via `http_basic_ldap`, la seule variante disponible
- [ ] **D.** Via la clé `http_basic`, avec une option `realm` optionnelle

### Question 41

La déconnexion (« log out ») fonctionne-t-elle avec l'authenticator HTTP Basic ? *(une seule bonne réponse)*

- [ ] **A.** Non, HTTP Basic ne supporte tout simplement aucune notion de session
- [ ] **B.** Oui, mais uniquement si `stateless: false` est configuré
- [ ] **C.** Non, car le navigateur « se souvient » des identifiants et les renvoie à chaque requête, même après déconnexion côté Symfony
- [ ] **D.** Oui, exactement comme avec n'importe quel autre authenticator

### Question 42

Quel est le principe des « login links », comme mécanisme d'authentification ? *(une seule bonne réponse)*

- [ ] **A.** Un simple alias de la fonctionnalité "remember me"
- [ ] **B.** Un mécanisme réservé exclusivement aux API, jamais aux applications web classiques
- [ ] **C.** Un mécanisme sans mot de passe : l'utilisateur reçoit un lien à courte durée de vie (ex. par email) qui l'authentifie
- [ ] **D.** Un lien permanent qui authentifie l'utilisateur indéfiniment, sans expiration

## X.509 et utilisateurs distants

### Question 43

Avec l'authenticator X.509, qui effectue réellement l'authentification du client ? *(une seule bonne réponse)*

- [ ] **A.** L'utilisateur, en saisissant manuellement les informations du certificat
- [ ] **B.** Le serveur web lui-même, l'authenticator Symfony se contentant d'extraire l'email depuis le certificat client
- [ ] **C.** Le composant Security de Symfony, qui valide directement le certificat
- [ ] **D.** Un service tiers externe interrogé à chaque requête

### Question 44

Comment Symfony extrait-il par défaut l'adresse email depuis le certificat client X.509 ? *(une seule bonne réponse)*

- [ ] **A.** Via un en-tête HTTP personnalisé `X-Client-Email` à définir manuellement
- [ ] **B.** D'abord via `SSL_CLIENT_S_DN_Email` (Apache) ; sinon, via `SSL_CLIENT_S_DN` en cherchant la valeur après `emailAddress`
- [ ] **C.** Uniquement via `SSL_CLIENT_S_DN`, `SSL_CLIENT_S_DN_Email` n'étant jamais utilisé
- [ ] **D.** En interrogeant systématiquement un annuaire LDAP externe

### Question 45

Comment l'authenticator « Remote User » identifie-t-il l'utilisateur, typiquement utilisé avec des modules serveur comme Kerberos ? *(une seule bonne réponse)*

- [ ] **A.** Via un cookie de session dédié
- [ ] **B.** Via le corps de la requête HTTP, au format JSON
- [ ] **C.** Via une base de données partagée entre le serveur web et Symfony
- [ ] **D.** Via la variable d'environnement `REMOTE_USER`, exposée par ces modules serveur

## Limiter les tentatives de connexion (login throttling)

### Question 46

Sur quel composant Symfony repose la protection contre les attaques par force brute sur le login ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Cache
- [ ] **B.** Le composant Lock
- [ ] **C.** Le composant Workflow
- [ ] **D.** Le composant RateLimiter

### Question 47

Par défaut, combien de tentatives de connexion par minute la fonctionnalité `login_throttling` autorise-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a pas de valeur par défaut, `max_attempts` étant toujours obligatoire
- [ ] **B.** 5
- [ ] **C.** 3
- [ ] **D.** 10

### Question 48

En plus de la limite par IP + nom d'utilisateur, quelle seconde limite Symfony applique-t-il, et dans quel but ? *(une seule bonne réponse)*

- [ ] **A.** Une limite par nom d'utilisateur seul, sans lien avec l'IP
- [ ] **B.** Une limite de `5 * max_attempts` par IP seule, pour empêcher un attaquant utilisant plusieurs noms d'utilisateur de contourner la première limite
- [ ] **C.** Une limite globale pour toute l'application, tous utilisateurs et IP confondus
- [ ] **D.** Aucune seconde limite n'existe, seule la limite IP + nom d'utilisateur s'applique

### Question 49

Comment utiliser un algorithme de limitation personnalisé plus complexe que celui fourni par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seul l'algorithme par défaut peut être utilisé
- [ ] **B.** En surchargeant directement le service `security.login_throttling` dans son ensemble
- [ ] **C.** Via une option `custom_algorithm` dédiée
- [ ] **D.** En créant une classe implémentant `RequestRateLimiterInterface` (ou en utilisant `DefaultLoginRateLimiter`) et en la référençant via l'option `limiter`

### Question 50

Où sont stockées par défaut les tentatives de connexion précédentes pour le rate limiter de login ? *(une seule bonne réponse)*

- [ ] **A.** Dans un fichier de log dédié
- [ ] **B.** En base de données uniquement, via Doctrine
- [ ] **C.** Dans le cache de Symfony, avec possibilité de configurer le pool ou un stockage personnalisé
- [ ] **D.** Toujours en session, jamais en cache

### Question 51

Quelles options de `login_throttling` permettent de choisir où sont stockées les données du limiteur ? *(plusieurs bonnes réponses)*

- [ ] **A.** `cache_pool`, pour utiliser un pool de cache spécifique
- [ ] **B.** `storage_service`, un service de stockage personnalisé qui prend le pas sur `cache_pool`
- [ ] **C.** `database_url`, pour une connexion Doctrine dédiée
- [ ] **D.** `session_key`, pour stocker les tentatives directement en session

### Question 52

Comment personnaliser le comportement suite à une authentification réussie ou échouée, sans réécrire les listeners globaux ? *(une seule bonne réponse)*

- [ ] **A.** En surchargeant directement la classe `FormLoginAuthenticator`
- [ ] **B.** Ce n'est possible qu'en modifiant le fichier `security.yaml`, sans code PHP
- [ ] **C.** Via un unique `AuthenticationResultHandlerInterface` gérant les deux cas
- [ ] **D.** En implémentant `AuthenticationSuccessHandlerInterface` ou `AuthenticationFailureHandlerInterface`

## Se connecter et se déconnecter par programmation

### Question 53

Quelle méthode du service `Security` permet de connecter un utilisateur par programmation ? *(une seule bonne réponse)*

- [ ] **A.** `signIn($user)`
- [ ] **B.** `forceLogin($user)`, une méthode dépréciée mais encore utilisée
- [ ] **C.** `login($user)`, avec des arguments optionnels pour l'authenticator, le firewall, les badges et les attributs
- [ ] **D.** `authenticate($user)`

### Question 54

Que retourne `Security::login($user)` par défaut, utilisable directement comme réponse de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `null`, une réponse devant toujours être construite manuellement
- [ ] **B.** Un booléen indiquant le succès de la connexion
- [ ] **C.** L'objet `User` connecté, sans réponse HTTP associée
- [ ] **D.** Une `RedirectResponse` utilisant la logique de redirection habituelle du login

### Question 55

Si le firewall utilisé possède plusieurs authenticators, que faut-il préciser à `Security::login()` ? *(une seule bonne réponse)*

- [ ] **A.** Il faut désactiver tous les autres authenticators avant l'appel
- [ ] **B.** Le nom du firewall suffit, sans préciser d'authenticator
- [ ] **C.** L'authenticator à utiliser, explicitement (nom d'un authenticator natif ou service id d'un authenticator personnalisé)
- [ ] **D.** Rien, Symfony choisit toujours automatiquement le premier authenticator déclaré

## Déconnexion

### Question 56

Comment activer la déconnexion sur un firewall ? *(une seule bonne réponse)*

- [ ] **A.** La déconnexion est toujours activée par défaut sur tout firewall
- [ ] **B.** Via une route dédiée déclarée manuellement dans `routes.yaml`, sans configuration `security.yaml`
- [ ] **C.** Via la clé `logout`, avec une option `path` (et optionnellement `target`)
- [ ] **D.** Via `enable_logout: true`

### Question 57

Quel nom de route Symfony génère-t-il automatiquement pour la déconnexion d'un firewall nommé `main` ? *(une seule bonne réponse)*

- [ ] **A.** `security_logout_main`
- [ ] **B.** `main_logout`
- [ ] **C.** `_logout_main`
- [ ] **D.** `app_logout_main`

### Question 58

Si le projet n'utilise pas Symfony Flex, que faut-il importer manuellement pour que la route de déconnexion fonctionne ? *(une seule bonne réponse)*

- [ ] **A.** Rien, la route est toujours générée automatiquement quel que soit l'usage de Flex
- [ ] **B.** Un contrôleur `LogoutController` fourni par le bundle
- [ ] **C.** Un fichier `logout.yaml` téléchargé séparément
- [ ] **D.** Le loader de route `security.route_loader.logout`, en tant que ressource de type `service`

### Question 59

Que fait `Security::logout(false)`, par opposition à `Security::logout()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle force une déconnexion sur tous les firewalls simultanément
- [ ] **B.** Elle ne fait que journaliser la déconnexion sans l'exécuter réellement
- [ ] **C.** Elle désactive la vérification CSRF pour cette déconnexion
- [ ] **D.** Elle empêche la déconnexion effective de l'utilisateur

### Question 60

Que se passe-t-il si `Security::logout()` est appelée alors que la requête courante n'est derrière aucun firewall ? *(une seule bonne réponse)*

- [ ] **A.** L'utilisateur par défaut du premier firewall déclaré est déconnecté
- [ ] **B.** Une redirection vers la page d'accueil est toujours renvoyée
- [ ] **C.** Une `\LogicException` est levée
- [ ] **D.** La méthode ne fait rien silencieusement

### Question 61

Quel événement est dispatché pendant le processus de déconnexion, permettant d'exécuter une logique personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** `UserLoggedOutEvent`
- [ ] **B.** `TokenDeauthenticatedEvent`, le même que pour un changement de mot de passe
- [ ] **C.** `LogoutEvent`
- [ ] **D.** `SecurityLogoutEvent`

### Question 62

Comment définir un chemin de déconnexion dynamique (ex. traduit selon la locale) plutôt qu'un chemin fixe ? *(une seule bonne réponse)*

- [ ] **A.** Via une clé `dynamic_path` dédiée à cet usage
- [ ] **B.** En dupliquant la configuration `logout` une fois par locale
- [ ] **C.** En configurant `path` avec un nom de route que l'on a soi-même déclarée (avec des chemins différents par locale)
- [ ] **D.** Ce n'est pas possible, `path` n'acceptant qu'une URL brute

## Récupérer l'objet utilisateur

### Question 63

Quel attribut permet de récupérer l'utilisateur authentifié comme argument de méthode de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `#[Authenticated]`
- [ ] **B.** `#[SecurityUser]`
- [ ] **C.** `#[CurrentUser]`
- [ ] **D.** `#[LoggedInUser]`

### Question 64

Que se passe-t-il si l'argument marqué `#[CurrentUser]` est déclaré non-nullable et qu'aucun utilisateur n'est authentifié ? *(une seule bonne réponse)*

- [ ] **A.** La méthode du contrôleur n'est jamais appelée, sans aucune réponse générée
- [ ] **B.** Symfony lève automatiquement une erreur 403
- [ ] **C.** L'argument reçoit `null` malgré tout, sans erreur
- [ ] **D.** Une exception fatale PHP de type non respecté est levée

### Question 65

Pourquoi `#[CurrentUser]` est-il préféré à la méthode `getUser()` du contrôleur de base, d'après la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il fournit un typage correct sans annotation `@var`
- [ ] **B.** Il fonctionne dans n'importe quel contrôleur, pas seulement ceux étendant `AbstractController`
- [ ] **C.** Il rend explicite, dans la signature de la méthode, la dépendance à l'utilisateur authentifié
- [ ] **D.** Il est strictement plus rapide en termes de performance d'exécution

### Question 66

Comment récupérer l'utilisateur connecté depuis un service (pas un contrôleur) ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable globale `$GLOBALS['current_user']`
- [ ] **B.** En injectant le service `Security` et en appelant `getUser()`
- [ ] **C.** En injectant `TokenStorageInterface` directement dans le constructeur et en l'appelant immédiatement
- [ ] **D.** Ce n'est pas possible depuis un service, uniquement depuis un contrôleur

### Question 67

Sous quel nom l'utilisateur courant est-il disponible dans un template Twig ? *(une seule bonne réponse)*

- [ ] **A.** `user`, une variable globale directe
- [ ] **B.** `app.user`
- [ ] **C.** `security.user`
- [ ] **D.** `current_user`

### Question 68

`#[CurrentUser]` peut-il cibler une union de plusieurs classes utilisateur possibles ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement via une interface commune, jamais une union de types
- [ ] **B.** Non, les unions de type ne sont pas supportées par PHP dans ce contexte
- [ ] **C.** Oui, par exemple `#[CurrentUser] Admin|Customer|User $user`
- [ ] **D.** Non, une seule classe utilisateur peut être ciblée à la fois

## Rôles et contrôle d'accès

### Question 69

Comment Symfony détermine-t-il les rôles d'un utilisateur lors de sa connexion ? *(une seule bonne réponse)*

- [ ] **A.** En lisant une colonne fixe `roles` en base de données, sans passer par une méthode
- [ ] **B.** En interrogeant systématiquement le user provider à chaque vérification de rôle
- [ ] **C.** Via une configuration statique dans `security.yaml`, jamais dans le code
- [ ] **D.** En appelant la méthode `getRoles()` de l'objet User

### Question 70

Quelle est la seule règle imposée sur le nom d'un rôle personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Il ne doit contenir aucun underscore
- [ ] **B.** Il doit commencer par le préfixe `ROLE_`
- [ ] **C.** Il doit être entièrement en majuscules, sans préfixe particulier
- [ ] **D.** Il doit correspondre à une constante PHP déclarée

### Question 71

Comment définir une hiérarchie où `ROLE_ADMIN` hérite automatiquement de `ROLE_USER` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible nativement, il faut un voter personnalisé pour toute hiérarchie
- [ ] **B.** Via l'option `role_hierarchy` de la configuration `security`
- [ ] **C.** En listant explicitement tous les rôles hérités dans `getRoles()` de chaque type d'utilisateur
- [ ] **D.** Via un attribut `#[InheritsFrom]` sur la classe User

### Question 72

Pourquoi la documentation déconseille-t-elle d'appeler directement `$user->getRoles()` pour vérifier un accès, plutôt que `isGranted()` ? *(une seule bonne réponse)*

- [ ] **A.** `getRoles()` a été supprimée dans Symfony 8, remplacée entièrement par `isGranted()`
- [ ] **B.** `getRoles()` ne prend pas en compte la hiérarchie de rôles configurée, contrairement à `isGranted()`
- [ ] **C.** `getRoles()` ne fonctionne que pour les utilisateurs anonymes
- [ ] **D.** `getRoles()` est plus lent que `isGranted()`, sans différence fonctionnelle

### Question 73

Les valeurs de `role_hierarchy` peuvent-elles être stockées dynamiquement en base de données ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement en passant par le user provider LDAP
- [ ] **B.** Non, et il n'existe aucune alternative pour rendre la hiérarchie dynamique
- [ ] **C.** Non, ces valeurs sont statiques ; pour une hiérarchie dynamique, il faut créer un voter personnalisé
- [ ] **D.** Oui, nativement, via une simple table `role_hierarchy`

### Question 74

Comment générer une représentation visuelle (SVG/PNG) de sa hiérarchie de rôles pour la déboguer ? *(une seule bonne réponse)*

- [ ] **A.** Via une interface web intégrée au profiler, sans outil externe
- [ ] **B.** Ce n'est pas possible, seule une représentation textuelle existe
- [ ] **C.** Via `php bin/console debug:router --graph`, qui gère aussi les rôles
- [ ] **D.** En combinant `php bin/console debug:security:role-hierarchy` avec l'outil externe `mmdc` (Mermaid CLI)

### Question 75

Quelles sont les deux façons principales de refuser l'accès à une ressource dans Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en code PHP, `access_control` étant une fonctionnalité dépréciée
- [ ] **B.** Via un fichier `.htaccess` dédié, indépendant de Symfony
- [ ] **C.** Via `access_control` dans `security.yaml` (simple mais moins flexible), ou directement dans le contrôleur (ou tout autre code)
- [ ] **D.** Uniquement via `access_control`, aucune autre méthode n'étant disponible

### Question 76

Comment exiger `ROLE_ADMIN` pour toutes les URLs commençant par `/admin` via `security.yaml` ? *(une seule bonne réponse)*

- [ ] **A.** `roles_by_path: { '/admin': ROLE_ADMIN }`
- [ ] **B.** `access_control: [{ path: '^/admin', roles: ROLE_ADMIN }]`
- [ ] **C.** `firewalls: { admin: { roles: ROLE_ADMIN } }`
- [ ] **D.** `access_control` ne peut cibler que des routes nommées, jamais des motifs d'URL

### Question 77

Si plusieurs règles `access_control` correspondent à une même requête, laquelle est appliquée ? *(une seule bonne réponse)*

- [ ] **A.** La dernière règle qui correspond, les précédentes étant ignorées
- [ ] **B.** Uniquement la première règle qui correspond, dans l'ordre de la liste
- [ ] **C.** Toutes les règles correspondantes sont cumulées
- [ ] **D.** La règle la plus restrictive parmi celles qui correspondent

### Question 78

Que change le préfixe `^` devant un chemin `access_control`, par exemple `^/admin` par rapport à `/admin` seul ? *(une seule bonne réponse)*

- [ ] **A.** `^` n'a aucun effet, les deux formes étant strictement équivalentes
- [ ] **B.** `^` restreint la règle aux requêtes HTTPS uniquement
- [ ] **C.** Sans `^`, la règle ne correspond plus à aucune URL
- [ ] **D.** Avec `^`, seules les URLs *commençant* par le motif correspondent ; sans lui, un chemin comme `/foo/admin` correspondrait aussi

### Question 79

Comment refuser l'accès depuis l'intérieur d'un contrôleur, et que se passe-t-il ensuite selon que l'utilisateur est connecté ou non ? *(une seule bonne réponse)*

- [ ] **A.** Via `throw new \Exception('Access Denied')` uniquement, sans mécanisme dédié
- [ ] **B.** `denyAccessUnlessGranted()` affiche systématiquement une page 403, qu'importe l'état de connexion
- [ ] **C.** Il n'est pas possible de refuser l'accès depuis un contrôleur, seul `access_control` le permettant
- [ ] **D.** Via `denyAccessUnlessGranted('ROLE_ADMIN')` ; si l'utilisateur n'est pas connecté, il est invité à se connecter, sinon la page 403 est affichée

### Question 80

Comment sécuriser une action de contrôleur (ou toutes les actions d'une classe) via un attribut PHP ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement via `access_control`, aucun attribut de contrôleur n'existant pour cela
- [ ] **B.** Avec `#[IsGranted('ROLE_ADMIN')]`, utilisable sur la classe ou sur une méthode
- [ ] **C.** Avec `#[Secured('ROLE_ADMIN')]`
- [ ] **D.** Avec `#[RequireRole('ROLE_ADMIN')]`

### Question 81

Comment référencer un argument de contrôleur (ex. l'entité `$post`) comme sujet d'un voter via `#[IsGranted]` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `#[IsGranted]` ne pouvant vérifier que des rôles simples
- [ ] **B.** En créant une méthode `getSubject()` sur le contrôleur
- [ ] **C.** Via une propriété statique nommée `$subject` sur la classe du contrôleur
- [ ] **D.** En passant son nom en second argument, ex. `#[IsGranted('edit', 'post')]`

### Question 82

Comment changer le code de statut HTTP retourné par défaut (403) lorsque `#[IsGranted]` refuse l'accès ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, 403 étant toujours le seul code possible
- [ ] **B.** Via l'argument `httpCode`
- [ ] **C.** En levant soi-même une exception dans le corps de la méthode, l'attribut ne le permettant pas
- [ ] **D.** Via l'argument `statusCode` de l'attribut

### Question 83

Peut-on également définir le code d'exception interne (`exceptionCode`) de l'`AccessDeniedException` levée par `#[IsGranted]` ? *(une seule bonne réponse)*

- [ ] **A.** Non, ce code est toujours généré aléatoirement
- [ ] **B.** Oui, mais uniquement en combinaison avec `statusCode: 403`
- [ ] **C.** Non, cette fonctionnalité n'existe pas pour `IsGranted`
- [ ] **D.** Oui, via l'argument `exceptionCode` de l'attribut

### Question 84

Peut-on créer ses propres attributs raccourcis en étendant `IsGranted`, par exemple un attribut `IsAdmin` ? *(une seule bonne réponse)*

- [ ] **A.** Non, `IsGranted` est une classe `final`, non extensible
- [ ] **B.** Oui, mais uniquement en dupliquant entièrement le code de l'attribut d'origine
- [ ] **C.** Non, seuls les attributs natifs de Symfony peuvent être utilisés pour la sécurité
- [ ] **D.** Oui, en créant une classe qui étend `IsGranted` et appelle `parent::__construct('ROLE_ADMIN')`

### Question 85

Comment restreindre la vérification d'accès de `#[IsGranted]` à certaines méthodes HTTP seulement ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `#[IsGranted]` s'appliquant toujours à toutes les méthodes HTTP
- [ ] **B.** En créant une route distincte par méthode HTTP, seule solution disponible
- [ ] **C.** Via l'argument `httpMethods`, au pluriel complet
- [ ] **D.** Via l'argument `methods`, acceptant une chaîne ou un tableau de méthodes

## Le contrôle d'accès dans les templates et les services

### Question 86

Quelle fonction Twig permet de vérifier si l'utilisateur courant a un rôle donné ? *(une seule bonne réponse)*

- [ ] **A.** `check_access('ROLE_ADMIN')`
- [ ] **B.** `user.hasRole('ROLE_ADMIN')`
- [ ] **C.** `is_granted('ROLE_ADMIN')`
- [ ] **D.** `has_role('ROLE_ADMIN')`

### Question 87

Quelle fonction Twig permet de vérifier un rôle pour un utilisateur *précis*, différent de l'utilisateur courant ? *(une seule bonne réponse)*

- [ ] **A.** `is_granted('ROLE_ADMIN', user)`, le second argument désignant l'utilisateur ciblé
- [ ] **B.** Ce n'est pas possible depuis Twig, uniquement depuis PHP
- [ ] **C.** `check_user_role(user, 'ROLE_ADMIN')`
- [ ] **D.** `is_granted_for_user(user, 'ROLE_ADMIN')`

### Question 88

À quoi servent les fonctions Twig `access_decision()` et `access_decision_for_user()` ? *(une seule bonne réponse)*

- [ ] **A.** À forcer la reconnexion de l'utilisateur directement depuis le template
- [ ] **B.** Elles sont strictement identiques à `is_granted()`, sans valeur ajoutée
- [ ] **C.** À vérifier l'autorisation tout en récupérant les raisons du refus données par les voters personnalisés
- [ ] **D.** À afficher la liste de tous les rôles disponibles dans l'application

### Question 89

Comment vérifier une autorisation depuis n'importe quel service PHP (pas un contrôleur) ? *(une seule bonne réponse)*

- [ ] **A.** Via une fonction globale PHP `is_granted()`, disponible partout
- [ ] **B.** En injectant le service `Security` et en appelant `isGranted()`
- [ ] **C.** Ce n'est possible que depuis un contrôleur ou un template Twig
- [ ] **D.** En injectant directement l'entité `User`, qui expose une méthode `isGranted()`

### Question 90

Quand utiliser `isGrantedForUser()` plutôt que `isGranted()` sur le service `Security` ? *(une seule bonne réponse)*

- [ ] **A.** `isGrantedForUser()` n'existe pas réellement, seul `isGranted()` étant disponible
- [ ] **B.** Uniquement pour vérifier des rôles hiérarchiques, jamais des rôles simples
- [ ] **C.** `isGrantedForUser()` remplace entièrement `isGranted()` depuis Symfony 8
- [ ] **D.** Pour vérifier l'autorisation d'un utilisateur différent de l'utilisateur courant, ou quand la session n'est pas disponible (ex. contexte CLI)

### Question 91

Quelle interface de plus bas niveau peut-on type-hinter à la place du service `Security`, pour ne dépendre que de la vérification d'autorisation ? *(une seule bonne réponse)*

- [ ] **A.** `AccessCheckerInterface`
- [ ] **B.** `RoleCheckerInterface`
- [ ] **C.** `PermissionInterface`
- [ ] **D.** `AuthorizationCheckerInterface`

## Accès anonyme et vérification de connexion

### Question 92

Quel attribut spécial permet, dans `access_control`, d'autoriser explicitement les utilisateurs non authentifiés sur certaines routes ? *(une seule bonne réponse)*

- [ ] **A.** `ROLE_ANONYMOUS`
- [ ] **B.** `IS_PUBLIC`
- [ ] **C.** `ROLE_PUBLIC`
- [ ] **D.** `PUBLIC_ACCESS`

### Question 93

Dans un voter personnalisé, comment vérifier que l'utilisateur courant n'est pas authentifié pour n'autoriser, par exemple, que la vue des posts publics ? *(une seule bonne réponse)*

- [ ] **A.** En vérifiant que le rôle `PUBLIC_ACCESS` est présent dans les rôles du token
- [ ] **B.** Ce n'est pas possible dans un voter, uniquement dans `access_control`
- [ ] **C.** En vérifiant que `$token->getUser()` n'est pas une instance de `UserInterface`
- [ ] **D.** En appelant `$token->isAnonymous()`

### Question 94

Quel attribut spécial vérifie simplement que l'utilisateur est connecté, sans se soucier de ses rôles ? *(une seule bonne réponse)*

- [ ] **A.** `ROLE_LOGGED_IN`
- [ ] **B.** `HAS_SESSION`
- [ ] **C.** `IS_LOGGED_IN`
- [ ] **D.** `IS_AUTHENTICATED`

### Question 95

Quelle est la différence entre `IS_AUTHENTICATED_FULLY` et `IS_AUTHENTICATED_REMEMBERED` ? *(une seule bonne réponse)*

- [ ] **A.** `IS_AUTHENTICATED_REMEMBERED` est plus strict que `IS_AUTHENTICATED_FULLY`
- [ ] **B.** Un utilisateur connecté uniquement via un cookie "remember me" a `IS_AUTHENTICATED_REMEMBERED` mais pas `IS_AUTHENTICATED_FULLY`
- [ ] **C.** Les deux attributs sont strictement équivalents, l'un étant un alias historique de l'autre
- [ ] **D.** `IS_AUTHENTICATED_FULLY` ne concerne que les administrateurs

### Question 96

Que vérifie l'attribut spécial `IS_IMPERSONATOR` ? *(une seule bonne réponse)*

- [ ] **A.** Que l'utilisateur est un administrateur système au niveau serveur
- [ ] **B.** Que l'utilisateur a été authentifié via LDAP
- [ ] **C.** Que l'utilisateur courant est en train d'usurper l'identité d'un autre utilisateur (impersonation) dans cette session
- [ ] **D.** Que l'utilisateur a le rôle `ROLE_ALLOWED_TO_SWITCH`, sans que l'impersonation soit forcément active

## Rafraîchissement de l'utilisateur depuis la session

### Question 97

À la fin de chaque requête (firewall non stateless), que devient l'objet User, et que se passe-t-il au début de la requête suivante ? *(une seule bonne réponse)*

- [ ] **A.** Il reste en mémoire du processus PHP, sans aucune sérialisation
- [ ] **B.** Il est sérialisé en session ; à la requête suivante, il est désérialisé puis « rafraîchi » via le user provider
- [ ] **C.** Il est stocké tel quel en base de données, sans passer par la session
- [ ] **D.** Il est détruit systématiquement, forçant une reconnexion à chaque requête

### Question 98

Sur quelles méthodes repose par défaut la comparaison entre l'utilisateur en session et l'utilisateur fraîchement rechargé, pour décider si l'utilisateur doit être déconnecté ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `getUserIdentifier()`, les autres méthodes n'étant jamais comparées
- [ ] **B.** `getRoles()` uniquement
- [ ] **C.** Aucune comparaison n'est faite par défaut, l'utilisateur restant toujours connecté
- [ ] **D.** `getPassword()`, `getSalt()` et `getUserIdentifier()`

### Question 99

Quelles sont les deux stratégies proposées pour éviter de stocker le mot de passe en clair (ou son hash complet) dans la session sérialisée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Retirer complètement le mot de passe via `__serialize()` (adapté uniquement si les mots de passe sont stockés en clair, ce qui n'est pas recommandé)
- [ ] **B.** Hasher le mot de passe avec l'algorithme `crc32c` avant de le stocker dans la session sérialisée
- [ ] **C.** Chiffrer toute la session avec une clé AES dédiée
- [ ] **D.** Stocker le mot de passe dans un cookie séparé plutôt qu'en session

### Question 100

Comment reprendre un contrôle plus fin sur la comparaison des utilisateurs, plutôt que d'utiliser la logique par défaut d'`AbstractToken` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas personnalisable, la logique de comparaison étant fixée par le framework
- [ ] **B.** Via une option `comparison_strategy` dans `security.yaml`
- [ ] **C.** En implémentant `EquatableInterface` et sa méthode `isEqualTo()` sur la classe User
- [ ] **D.** En surchargeant directement `AbstractToken::hasUserChanged()`

## Les événements de sécurité

### Question 101

Chaque firewall dispose-t-il de son propre event dispatcher, en plus du dispatcher global ? *(une seule bonne réponse)*

- [ ] **A.** Non, cette fonctionnalité n'existe que pour les événements de déconnexion
- [ ] **B.** Oui, nommé `security.event_dispatcher.<NOMDUFIREWALL>` ; les événements sont dispatchés sur les deux dispatchers
- [ ] **C.** Non, un seul event dispatcher global existe pour toute l'application
- [ ] **D.** Oui, mais les événements ne sont dispatchés que sur le dispatcher spécifique au firewall, jamais sur le global

### Question 102

Quel événement est dispatché juste après que l'authenticator a créé le « passport » de sécurité, et où la vérification effective des identifiants a lieu ? *(une seule bonne réponse)*

- [ ] **A.** `AuthenticationSuccessEvent`
- [ ] **B.** `CheckPassportEvent`
- [ ] **C.** `AuthenticationTokenCreatedEvent`
- [ ] **D.** `LoginSuccessEvent`

### Question 103

Quel événement représente le dernier moment où l'authentification peut encore échouer, en levant une `AuthenticationException` ? *(une seule bonne réponse)*

- [ ] **A.** `LoginSuccessEvent`
- [ ] **B.** `CheckPassportEvent`
- [ ] **C.** `AuthenticationTokenCreatedEvent`
- [ ] **D.** `AuthenticationSuccessEvent`

### Question 104

Quel événement permet de modifier la réponse envoyée à l'utilisateur après une authentification totalement réussie ? *(une seule bonne réponse)*

- [ ] **A.** `InteractiveLoginEvent` uniquement
- [ ] **B.** `CheckPassportEvent`
- [ ] **C.** `LoginSuccessEvent`
- [ ] **D.** `AuthenticationSuccessEvent`

### Question 105

Quel événement n'est dispatché que si l'authenticator implémente `InteractiveAuthenticatorInterface`, indiquant une action explicite de l'utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** `AuthenticationTokenCreatedEvent`
- [ ] **B.** `SwitchUserEvent`
- [ ] **C.** `InteractiveLoginEvent`
- [ ] **D.** `LoginSuccessEvent`

### Question 106

Quel événement est dispatché quand un utilisateur est déauthentifié suite à un changement de données critiques (ex. mot de passe modifié) ? *(une seule bonne réponse)*

- [ ] **A.** `UserChangedEvent`
- [ ] **B.** `TokenDeauthenticatedEvent`
- [ ] **C.** `LogoutEvent`
- [ ] **D.** `AuthenticationSuccessEvent`

## FAQ

### Question 107

Peut-on avoir plusieurs firewalls, et être authentifié dans l'un rend-il automatiquement authentifié dans un autre ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais le partage d'authentification n'est possible qu'entre exactement deux firewalls maximum
- [ ] **B.** Oui, on peut en avoir plusieurs, mais être authentifié sur l'un ne rend pas automatiquement authentifié sur un autre, sauf à partager explicitement le même `context`
- [ ] **C.** Non, un seul firewall est autorisé par application
- [ ] **D.** Oui, et l'authentification est toujours automatiquement partagée entre tous les firewalls

### Question 108

Pourquoi la sécurité ne semble-t-elle pas fonctionner sur les pages d'erreur 404 ? *(une seule bonne réponse)*

- [ ] **A.** Les pages 404 sont toujours couvertes par un firewall spécial nommé `error`
- [ ] **B.** C'est un bug connu qui sera corrigé dans une version future
- [ ] **C.** Les pages d'erreur nécessitent une configuration `access_control` dédiée obligatoire
- [ ] **D.** Le routage se fait avant la sécurité, donc les pages 404 ne sont couvertes par aucun firewall

## Hasher et vérifier les mots de passe

### Question 109

Quelle option de `password_hashers` permet de configurer, pour une classe donnée, l'algorithme de hashing à utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Via une méthode `getAlgorithm()` obligatoire sur chaque classe utilisateur
- [ ] **B.** En associant la classe (ou une interface qu'elle implémente) à un algorithme, ex. `App\Entity\User: 'auto'`
- [ ] **C.** Uniquement via une variable d'environnement globale `PASSWORD_ALGORITHM`
- [ ] **D.** Il n'existe qu'un seul algorithme possible, non configurable

### Question 110

Pourquoi la documentation recommande-t-elle de configurer un hasher moins coûteux dans l'environnement `test` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas recommandé, la documentation insistant au contraire sur l'usage du même coût partout
- [ ] **B.** Pour accélérer l'exécution des tests, la sécurité des hashs n'étant pas un enjeu dans ce contexte
- [ ] **C.** Parce que l'algorithme `auto` ne fonctionne pas du tout en environnement de test
- [ ] **D.** Pour éviter tout risque de fuite de mots de passe réels pendant les tests

### Question 111

Comment injecter un hasher de mot de passe qui n'est pas lié à une classe utilisateur, par exemple un hasher nommé `recovery_code` pour des codes de récupération ? *(une seule bonne réponse)*

- [ ] **A.** Via une méthode statique `PasswordHasherFactory::forName('recovery_code')`
- [ ] **B.** Via l'attribut `#[Target('recovery_code')]` sur le paramètre type-hinté `PasswordHasherInterface`
- [ ] **C.** L'autowiring standard suffit, Symfony devinant automatiquement le bon hasher
- [ ] **D.** Ce n'est pas possible, un hasher devant toujours être lié à une classe implémentant `PasswordAuthenticatedUserInterface`

### Question 112

Pour hasher un jeton qui n'est pas un mot de passe d'objet `UserInterface`, quelle méthode du hasher utilise-t-on plutôt que `hashPassword()` ? *(une seule bonne réponse)*

- [ ] **A.** `encode()`
- [ ] **B.** `hashPassword()` reste la seule méthode disponible, quel que soit le contexte
- [ ] **C.** `hash()`
- [ ] **D.** `hashToken()`

### Question 113

Quelle option permet de faire migrer automatiquement un mot de passe hashé avec un ancien algorithme vers un nouveau, lors de la prochaine connexion réussie ? *(une seule bonne réponse)*

- [ ] **A.** Cette migration se fait toujours manuellement, aucune option de configuration n'existant
- [ ] **B.** `migrate_from`, listant les anciens hashers à partir desquels migrer
- [ ] **C.** `upgrade_from`
- [ ] **D.** `legacy_algorithm`

### Question 114

Les hashers `auto`, `native`, `bcrypt` et `argon` activent-ils automatiquement une migration, et à partir de quels algorithmes ? *(une seule bonne réponse)*

- [ ] **A.** Non, `migrate_from` est toujours strictement obligatoire pour ces quatre hashers
- [ ] **B.** Oui, mais uniquement pour l'algorithme `bcrypt`, les trois autres ne le faisant pas
- [ ] **C.** Non, ces hashers ne supportent aucune forme de migration
- [ ] **D.** Oui, ils activent automatiquement une migration depuis PBKDF2 et le « message digest », sans besoin d'ajouter `migrate_from` explicitement

### Question 115

Comment déclencher l'enregistrement du nouveau mot de passe hashé lorsqu'on utilise un provider Doctrine ? *(une seule bonne réponse)*

- [ ] **A.** Via un event listener sur `kernel.terminate`, seule méthode possible
- [ ] **B.** En implémentant `PasswordUpgraderInterface` dans le repository de l'entité User
- [ ] **C.** En implémentant cette interface directement sur l'entité User elle-même
- [ ] **D.** Cela se fait automatiquement, sans interface à implémenter, dès que Doctrine est utilisé

### Question 116

Pour un hasher personnalisé, comment déclencher la migration d'un mot de passe (rehash) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible pour un hasher personnalisé, seuls les hashers natifs supportant la migration
- [ ] **B.** En retournant `true` depuis la méthode `needsRehash()`
- [ ] **C.** En levant une exception `PasswordOutdatedException`
- [ ] **D.** En retournant `false` depuis `hash()`

### Question 117

Comment appliquer un hasher différent (plus coûteux) selon le type d'utilisateur, par exemple pour les administrateurs uniquement ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `dynamic_hashers: true`, sans interface à implémenter
- [ ] **B.** En définissant un hasher « nommé » et en implémentant `PasswordHasherAwareInterface::getPasswordHasherName()` sur la classe User
- [ ] **C.** En créant une seconde classe `AdminUser` totalement distincte de `User`
- [ ] **D.** Ce n'est pas configurable dynamiquement par utilisateur, seulement par classe entière

### Question 118

En cas de migration de mots de passe (`migrate_from`), faut-il implémenter `PasswordHasherAwareInterface` pour indiquer l'ancien hasher ? *(une seule bonne réponse)*

- [ ] **A.** Non, mais uniquement si l'algorithme legacy est `bcrypt`
- [ ] **B.** Oui, mais uniquement pour les hashers personnalisés, jamais pour les hashers natifs
- [ ] **C.** Non, Symfony détecte automatiquement l'ancien hasher via la configuration `migrate_from`
- [ ] **D.** Oui, c'est absolument indispensable dans tous les cas de migration

### Question 119

Comment hasher/vérifier une chaîne de manière autonome, indépendamment de tout objet utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le composant PasswordHasher nécessitant toujours un objet `UserInterface`
- [ ] **B.** Uniquement via `password_hash()` natif de PHP, en dehors du composant Symfony
- [ ] **C.** Via le service `security.helper`, qui expose une méthode `hashString()`
- [ ] **D.** En utilisant `PasswordHasherFactory` pour déclarer plusieurs hashers nommés, récupérables via `getPasswordHasher()`

### Question 120

Quel algorithme le hasher `auto` sélectionne-t-il actuellement, et pourquoi faut-il prévoir une colonne assez large pour stocker le résultat ? *(une seule bonne réponse)*

- [ ] **A.** PBKDF2, l'algorithme le plus sûr recommandé par la documentation
- [ ] **B.** Bcrypt actuellement ; la longueur du hash peut changer si un meilleur algorithme est ajouté à l'avenir, d'où la recommandation `varchar(255)`
- [ ] **C.** Argon2 actuellement ; la longueur est fixe et ne changera jamais
- [ ] **D.** SHA-256 ; aucune précaution de taille de colonne n'est nécessaire

### Question 121

Quelle est l'option de configuration principale du hasher Bcrypt, et quel effet a chaque incrément ? *(une seule bonne réponse)*

- [ ] **A.** `rounds`, sans lien avec le temps de calcul
- [ ] **B.** `iterations`, dont l'effet est linéaire et non exponentiel
- [ ] **C.** `cost` (entre 4 et 31, par défaut 13) ; chaque incrément double le temps de hashing
- [ ] **D.** `cost` (entre 1 et 10) ; chaque incrément multiplie le temps par dix

### Question 122

Peut-on changer le `cost` du hasher Bcrypt après coup, sans invalider les mots de passe déjà hashés avec l'ancien coût ? *(une seule bonne réponse)*

- [ ] **A.** Non, changer le coût invalide immédiatement tous les mots de passe existants
- [ ] **B.** Oui, mais il faut alors relancer manuellement le hashing de tous les mots de passe existants
- [ ] **C.** Non, le coût est figé définitivement dès le premier déploiement
- [ ] **D.** Oui, les nouveaux mots de passe utilisent le nouveau coût, les anciens restant validés avec le coût utilisé lors de leur hashing

### Question 123

Sur quelle fonction cryptographique repose le hasher Sodium, et via quelle extension PHP est-elle disponible ? *(une seule bonne réponse)*

- [ ] **A.** Bcrypt, via l'extension `openssl`
- [ ] **B.** SHA-3, via l'extension `hash`
- [ ] **C.** PBKDF2, via l'extension `sodium` uniquement en mode de compatibilité
- [ ] **D.** Argon2, via l'extension `libsodium`

### Question 124

Le hasher PBKDF2 est-il encore recommandé par la documentation Symfony 8.0 ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est même le hasher recommandé par défaut pour toute nouvelle application
- [ ] **B.** Oui, mais uniquement pour les applications utilisant LDAP
- [ ] **C.** Le hasher PBKDF2 a été totalement retiré du composant PasswordHasher
- [ ] **D.** Non, son usage n'est plus recommandé depuis que PHP supporte Sodium et Bcrypt

### Question 125

Quelles obligations un hasher de mot de passe personnalisé doit-il respecter concernant la longueur du mot de passe, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** La limite ne s'applique qu'aux hashers utilisant Bcrypt en interne
- [ ] **B.** Ses méthodes `hash()`/`verify()` doivent valider que le mot de passe ne dépasse pas 4096 caractères, pour des raisons de sécurité liées à la CVE-2013-5750
- [ ] **C.** Il n'y a aucune limite de longueur à respecter, contrairement aux hashers natifs
- [ ] **D.** La limite est de 255 caractères, alignée sur la longueur habituelle d'une colonne `varchar`

### Question 126

Quel trait facilite la vérification de cette limite de longueur dans un hasher personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `PasswordHasherTrait`, qui gère bien plus que la seule longueur
- [ ] **B.** `CheckPasswordLengthTrait`, avec sa méthode `isPasswordTooLong()`
- [ ] **C.** `PasswordLengthValidatorTrait`
- [ ] **D.** Aucun trait n'existe, il faut implémenter la vérification manuellement à chaque fois

## S'authentifier via un serveur LDAP

### Question 127

Quel composant Symfony faut-il installer pour utiliser l'authentification LDAP ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/security-ldap`
- [ ] **B.** `symfony/directory`
- [ ] **C.** Aucune installation n'est nécessaire, LDAP étant intégré au cœur du composant Security
- [ ] **D.** `symfony/ldap`

### Question 128

Quels sont les trois mécanismes fournis par Symfony pour travailler avec un serveur LDAP ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le user provider `ldap`
- [ ] **B.** L'authenticator `form_login_ldap`
- [ ] **C.** L'authenticator `http_basic_ldap`
- [ ] **D.** Un firewall dédié nommé `ldap_firewall`

### Question 129

Quel utilisateur, configuré dans `search_dn`/`search_password` du provider LDAP, est utilisé pour interroger le serveur ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a jamais besoin d'authentification pour interroger un serveur LDAP
- [ ] **B.** Un utilisateur statique en lecture seule, dont le mot de passe est de préférence défini via une variable d'environnement
- [ ] **C.** L'utilisateur qui tente de se connecter lui-même
- [ ] **D.** Un compte administrateur créé automatiquement par Symfony

### Question 130

Que se passe-t-il si `default_roles` n'est pas configuré sur le provider LDAP ? *(une seule bonne réponse)*

- [ ] **A.** Ils reçoivent tous les rôles définis dans `role_hierarchy`
- [ ] **B.** Les utilisateurs chargés n'auront aucun rôle et ne seront pas considérés comme pleinement authentifiés
- [ ] **C.** Ils reçoivent automatiquement `ROLE_USER` par défaut
- [ ] **D.** Une exception est levée au démarrage de l'application

### Question 131

Quelle clé d'entrée LDAP est utilisée par défaut comme UID si `uid_key` vaut `null` ? *(une seule bonne réponse)*

- [ ] **A.** `uid`
- [ ] **B.** `cn`
- [ ] **C.** `sAMAccountName`
- [ ] **D.** `userPrincipalName`

### Question 132

À quoi sert l'option `role_fetcher`, et que fournit `MemberOfRoles` comme implémentation concrète ? *(une seule bonne réponse)*

- [ ] **A.** Elle sert uniquement à trier les résultats de la recherche LDAP
- [ ] **B.** Elle remplace le `search_dn`, sans lien avec les rôles
- [ ] **C.** Elle ne fonctionne qu'en combinaison avec `default_roles`, jamais seule
- [ ] **D.** Elle définit un service récupérant les rôles depuis le serveur LDAP ; `MemberOfRoles` les extrait de l'attribut `ismemberof`

### Question 133

Que se passe-t-il si `role_fetcher` est configuré en même temps que `default_roles` ? *(une seule bonne réponse)*

- [ ] **A.** `role_fetcher` est ignoré, `default_roles` prévalant toujours
- [ ] **B.** `default_roles` est ignoré au profit de `role_fetcher`
- [ ] **C.** Les deux sont fusionnés, chaque utilisateur recevant l'union des deux
- [ ] **D.** Une exception de configuration est levée, les deux options étant mutuellement exclusives

### Question 134

À quoi sert l'option `filter` du provider LDAP, et quel filtre est utilisé par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de filtre par défaut, `filter` étant toujours obligatoire
- [ ] **B.** Elle définit la requête LDAP utilisée pour rechercher l'utilisateur ; par défaut `({uid_key}={user_identifier})`
- [ ] **C.** Elle filtre les rôles retournés par le serveur LDAP
- [ ] **D.** Elle définit un filtre IP pour restreindre les connexions au serveur LDAP

### Question 135

Le composant Ldap échappe-t-il automatiquement les entrées pour prévenir les injections LDAP quand il est utilisé directement (hors provider Security) ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, quel que soit le point d'entrée utilisé
- [ ] **B.** Non, et aucun mécanisme d'échappement n'existe nulle part dans l'écosystème Symfony pour ce cas
- [ ] **C.** Oui, mais uniquement pour les filtres, jamais pour le `dn_string`
- [ ] **D.** Non ; le composant Security échappe les entrées côté provider, mais le composant Ldap lui-même ne le fait pas — c'est à l'utilisateur de s'en charger

### Question 136

Que définit l'option `dn_string` pour les authenticators `form_login_ldap`/`http_basic_ldap` ? *(une seule bonne réponse)*

- [ ] **A.** Le mot de passe utilisé pour la connexion administrative
- [ ] **B.** Le format du DN de l'utilisateur, où `{user_identifier}` est remplacé par le nom d'utilisateur saisi
- [ ] **C.** Le nom du serveur LDAP à contacter
- [ ] **D.** La liste des rôles par défaut à assigner

### Question 137

À quoi sert l'option `query_string`, utile notamment avec plusieurs providers LDAP ayant des `base_dn` différents ? *(une seule bonne réponse)*

- [ ] **A.** Elle remplace entièrement `dn_string`, qui devient alors inutile
- [ ] **B.** Elle ne sert qu'à des fins de journalisation, sans impact sur l'authentification
- [ ] **C.** Elle est réservée exclusivement à `http_basic_ldap`, jamais à `form_login_ldap`
- [ ] **D.** Elle fait rechercher un utilisateur puis utilise le DN trouvé pour le bind, utile pour choisir entre plusieurs branches d'annuaire

## La fonctionnalité « remember me »

### Question 138

Quelle option de firewall active la fonctionnalité « rester connecté » via un cookie ? *(une seule bonne réponse)*

- [ ] **A.** `persistent_login`
- [ ] **B.** Cette fonctionnalité est toujours active par défaut, sans configuration
- [ ] **C.** `remember_me`, avec au minimum un `secret`
- [ ] **D.** `stay_logged_in`

### Question 139

Par défaut, comment un utilisateur active-t-il le « remember me » pour un formulaire de connexion classique ? *(une seule bonne réponse)*

- [ ] **A.** Il est toujours activé automatiquement, sans opt-in nécessaire
- [ ] **B.** En ajoutant `?remember=1` à l'URL de connexion
- [ ] **C.** En cliquant sur un lien distinct après la connexion
- [ ] **D.** En cochant une case nommée `_remember_me` dans le formulaire

### Question 140

Comment activer le « remember me » via une API utilisant JSON Login ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant `remember_me=1` comme paramètre de requête (query string)
- [ ] **B.** En ajoutant une clé `_remember_me: true` au corps JSON de la requête
- [ ] **C.** Ce n'est pas supporté par JSON Login, uniquement par le formulaire classique
- [ ] **D.** Via un en-tête HTTP dédié `X-Remember-Me`

### Question 141

Comment forcer l'activation systématique du « remember me » sans laisser l'utilisateur choisir ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est jamais possible, l'opt-in étant toujours requis pour des raisons de sécurité
- [ ] **B.** Via `force_remember_me: true`
- [ ] **C.** Via l'option `always_remember_me: true`
- [ ] **D.** En supprimant simplement la case à cocher du formulaire, sans configuration additionnelle

### Question 142

Pourquoi certains authenticators (comme HTTP Basic) ne supportent-ils pas le « remember me », et comment un authenticator indique-t-il son support ? *(une seule bonne réponse)*

- [ ] **A.** Le support du remember me dépend uniquement du user provider utilisé, jamais de l'authenticator
- [ ] **B.** En ajoutant un `RememberMeBadge` au passeport ; sans ce badge, le remember me n'est jamais activé, quels que soient les autres réglages
- [ ] **C.** Tous les authenticators supportent le remember me par défaut, sans configuration
- [ ] **D.** Via une méthode `supportsRememberMe(): bool` à implémenter sur l'authenticator

### Question 143

Quelles sont les deux façons dont Symfony peut valider les tokens « remember me » ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des tokens basés sur une signature (par défaut), invalidés si les propriétés surveillées de l'utilisateur changent
- [ ] **B.** Des tokens persistants, stockés (ex. en base de données), invalidables en modifiant les lignes stockées
- [ ] **C.** Des tokens chiffrés avec la clé privée du serveur web
- [ ] **D.** Des tokens à usage unique, invalidés après chaque requête

### Question 144

Quelles informations sont toujours incluses dans le hash de signature d'un cookie « remember me », en plus des propriétés personnalisées ? *(une seule bonne réponse)*

- [ ] **A.** L'adresse IP du client au moment de la connexion
- [ ] **B.** Le nom du firewall utilisé, seul élément inclus par défaut
- [ ] **C.** L'identifiant utilisateur (`getUserIdentifier()`) et l'horodatage d'expiration
- [ ] **D.** Uniquement le mot de passe hashé

### Question 145

Quelle option permet de configurer des propriétés supplémentaires de l'utilisateur à inclure dans la signature du token, par exemple `updatedAt`, et quelle est sa valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `extra_properties`, sans valeur par défaut
- [ ] **B.** `token_properties`, qui vaut `[]` par défaut
- [ ] **C.** Cette personnalisation n'est pas possible, seul l'identifiant utilisateur étant pris en compte
- [ ] **D.** `signature_properties`, qui vaut `password` par défaut

### Question 146

Comment activer le stockage des tokens « remember me » en base de données plutôt que la signature par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Via `remember_me.persistent: true`
- [ ] **B.** Via l'option `token_provider.doctrine: true`
- [ ] **C.** Via `remember_me.storage: database`
- [ ] **D.** C'est le comportement par défaut, aucune configuration n'étant nécessaire

### Question 147

Comment créer un fournisseur de tokens « remember me » personnalisé, stocké autrement qu'avec Doctrine ? *(une seule bonne réponse)*

- [ ] **A.** En surchargeant directement le service `security.remember_me` dans son ensemble
- [ ] **B.** Via un fichier `remember_me_tokens.yaml` dédié
- [ ] **C.** En créant une classe implémentant `TokenProviderInterface`, référencée via l'option `service`
- [ ] **D.** Ce n'est pas possible, seul le stockage Doctrine étant supporté nativement

### Question 148

Quel attribut spécial force un utilisateur à se reconnecter réellement (pas seulement via un cookie remember me) pour accéder à une ressource sensible ? *(une seule bonne réponse)*

- [ ] **A.** `IS_AUTHENTICATED_REMEMBERED`, qui exclut justement les connexions "remember me"
- [ ] **B.** `IS_REMEMBERED`, qui force au contraire l'usage du cookie remember me
- [ ] **C.** `ROLE_FULLY_AUTHENTICATED`
- [ ] **D.** `IS_AUTHENTICATED_FULLY`

### Question 149

À quoi sert l'attribut spécial `IS_REMEMBERED` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas, seul `IS_AUTHENTICATED_REMEMBERED` étant disponible
- [ ] **B.** Il n'accorde l'accès que si l'utilisateur est authentifié spécifiquement via le mécanisme « remember me »
- [ ] **C.** Il accorde l'accès à tout utilisateur ayant déjà coché la case remember me au moins une fois dans le passé
- [ ] **D.** Il est un simple synonyme de `IS_AUTHENTICATED_FULLY`

### Question 150

Pourquoi faut-il utiliser un nom de cookie différent pour chaque firewall si le « remember me » est activé sur plusieurs firewalls d'une même application ? *(une seule bonne réponse)*

- [ ] **A.** Parce que deux cookies ne peuvent techniquement pas exister avec le même nom, même sur des chemins différents
- [ ] **B.** Pour éviter des problèmes de sécurité liés à la confusion entre cookies partageant le même nom
- [ ] **C.** Ce n'est pas nécessaire, Symfony gère automatiquement l'isolation par firewall
- [ ] **D.** Uniquement pour des raisons esthétiques dans les outils de développement navigateur

### Question 151

Quelle est la durée de vie par défaut du cookie « remember me » (option `lifetime`) ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a pas de valeur par défaut, `lifetime` étant toujours obligatoire
- [ ] **B.** 31 536 000 secondes (1 an)
- [ ] **C.** 604 800 secondes (1 semaine)
- [ ] **D.** 86 400 secondes (1 jour)

## Usurper l'identité d'un utilisateur (impersonation)

### Question 152

Quelle option de firewall active la possibilité de « switcher » vers un autre utilisateur sans se déconnecter ? *(une seule bonne réponse)*

- [ ] **A.** `su`
- [ ] **B.** `switch_user`
- [ ] **C.** `impersonate`
- [ ] **D.** `become_user`

### Question 153

Comment déclenche-t-on le passage vers un autre utilisateur, par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement via la commande console `security:switch-user`
- [ ] **B.** En ajoutant un paramètre de requête `_switch_user` avec l'identifiant de l'utilisateur cible
- [ ] **C.** Via un en-tête HTTP `X-Impersonate` par défaut
- [ ] **D.** En rappelant la méthode `login()` du service `Security` avec le nouvel utilisateur

### Question 154

Quelle valeur spéciale de `_switch_user` permet de revenir à l'utilisateur d'origine ? *(une seule bonne réponse)*

- [ ] **A.** `_back`
- [ ] **B.** `_original`
- [ ] **C.** `null`
- [ ] **D.** `_exit`

### Question 155

Quel rôle un utilisateur doit-il posséder par défaut pour être autorisé à usurper l'identité d'un autre ? *(une seule bonne réponse)*

- [ ] **A.** `ROLE_IMPERSONATOR`
- [ ] **B.** `ROLE_SWITCH_USER`
- [ ] **C.** `ROLE_SUPER_ADMIN`, seul rôle capable d'usurper une identité
- [ ] **D.** `ROLE_ALLOWED_TO_SWITCH`

### Question 156

Comment récupérer, pendant l'impersonation, l'utilisateur qui usurpe l'identité (et non l'utilisateur usurpé) ? *(une seule bonne réponse)*

- [ ] **A.** En consultant la session, où l'ancien utilisateur reste toujours stocké sous une clé séparée
- [ ] **B.** En vérifiant que le token courant est une instance de `SwitchUserToken`, puis en appelant `getOriginalToken()->getUser()`
- [ ] **C.** Via `Security::getOriginalUser()`, une méthode dédiée à cet effet
- [ ] **D.** Ce n'est pas possible techniquement une fois l'impersonation démarrée

### Question 157

Comment adapter le nom du rôle requis et le nom du paramètre de requête pour l'impersonation ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en surchargeant intégralement le listener `switch_user`
- [ ] **B.** Via les options `role` et `parameter` de `switch_user`
- [ ] **C.** Ce n'est pas personnalisable, `ROLE_ALLOWED_TO_SWITCH` et `_switch_user` étant fixes
- [ ] **D.** Via `custom_role` et `custom_param`

### Question 158

L'option `target_route` de `switch_user` fonctionne-t-elle avec n'importe quel type de firewall ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement en combinaison avec `remember_me`
- [ ] **B.** Non, elle ne fonctionne qu'avec un firewall stateful
- [ ] **C.** Oui, y compris avec un firewall stateless
- [ ] **D.** Non, elle ne fonctionne qu'avec les firewalls stateless

### Question 159

Comment prendre un contrôle plus fin sur qui peut usurper l'identité de qui, au-delà d'un simple rôle statique ? *(une seule bonne réponse)*

- [ ] **A.** En modifiant directement le code source du listener `SwitchUserListener`
- [ ] **B.** Via une expression `allow_if` dans `access_control`, seule méthode disponible
- [ ] **C.** En configurant `switch_user.role` avec un attribut personnalisé (ne commençant pas par `ROLE_`) et en créant un voter dédié à cet attribut
- [ ] **D.** Ce n'est pas possible, seul le rôle `ROLE_ALLOWED_TO_SWITCH` pouvant être vérifié

### Question 160

Que faut-il configurer si plusieurs firewalls partageant un même `context` utilisent des user providers différents pour l'impersonateur et l'utilisateur cible ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, la sortie d'impersonation fonctionne toujours quel que soit le provider
- [ ] **B.** Il faut fusionner les deux firewalls en un seul, aucune autre solution n'existant
- [ ] **C.** Un unique provider `entity` référençant les deux classes utilisateur à la fois
- [ ] **D.** Un provider `chain` combinant les deux providers, référencé dans l'option `provider` de `switch_user`

### Question 161

Quel événement est dispatché juste avant qu'une impersonation ne soit pleinement effective (et aussi juste avant qu'elle ne soit pleinement terminée) ? *(une seule bonne réponse)*

- [ ] **A.** `LoginSuccessEvent`, réutilisé pour ce cas
- [ ] **B.** Aucun événement dédié n'existe pour l'impersonation
- [ ] **C.** `security.switch_user` (classe `SwitchUserEvent`)
- [ ] **D.** `security.impersonation`

### Question 162

Avec quel mécanisme d'authentification l'impersonation d'utilisateur est-elle explicitement incompatible ? *(une seule bonne réponse)*

- [ ] **A.** Le login par formulaire classique
- [ ] **B.** L'authentification LDAP
- [ ] **C.** `REMOTE_USER`, où les informations d'authentification doivent être envoyées à chaque requête
- [ ] **D.** HTTP Basic, pour les mêmes raisons que la déconnexion

## Créer des « user checkers » personnalisés

### Question 163

Quelle interface une classe doit-elle implémenter pour effectuer des vérifications supplémentaires avant/après l'authentification d'un utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** `UserValidatorInterface`
- [ ] **B.** `AuthenticationCheckerInterface`
- [ ] **C.** `UserCheckerInterface`, avec une unique méthode `check()`
- [ ] **D.** `UserCheckerInterface`, avec ses méthodes `checkPreAuth()` et `checkPostAuth()`

### Question 164

Quelle classe d'exception faut-il lever si une condition n'est pas remplie dans un user checker, et quelle sous-classe permet de personnaliser le message affiché ? *(une seule bonne réponse)*

- [ ] **A.** `AccessDeniedException`, la même que pour les voters
- [ ] **B.** `AuthenticationException` directement, sans sous-classe spécifique aux comptes
- [ ] **C.** Une exception étendant `AccountStatusException` ; `CustomUserMessageAccountStatusException` permet de personnaliser le message
- [ ] **D.** Une simple `\RuntimeException`, sans classe dédiée

### Question 165

Comment attribuer un user checker personnalisé à un firewall précis ? *(une seule bonne réponse)*

- [ ] **A.** En taguant le service `kernel.event_subscriber`, sans option de firewall dédiée
- [ ] **B.** Ce n'est pas configurable par firewall, un seul user checker s'appliquant à toute l'application
- [ ] **C.** Via l'option `user_checker` du firewall, avec l'ID du service
- [ ] **D.** Via une configuration globale `security.user_checker`, sans distinction par firewall

### Question 166

Comment utiliser plusieurs user checkers sur un même firewall, avec un ordre d'exécution défini ? *(une seule bonne réponse)*

- [ ] **A.** En listant plusieurs classes séparées par des virgules dans l'option `user_checker`
- [ ] **B.** Via un tableau PHP `user_checkers` au pluriel, remplaçant `user_checker`
- [ ] **C.** En taguant chaque checker avec `security.user_checker.<firewall>` (avec une `priority`), puis en configurant `user_checker: security.user_checker.chain.<firewall>`
- [ ] **D.** Ce n'est pas possible, un seul user checker pouvant être actif par firewall

## Restreindre un firewall à une requête précise

### Question 167

Sur quelle base un firewall détermine-t-il, par défaut, s'il doit prendre en charge une requête ? *(une seule bonne réponse)*

- [ ] **A.** Sur la présence systématique d'un en-tête `Authorization`
- [ ] **B.** Sur la correspondance du chemin de la requête avec l'option `pattern`
- [ ] **C.** Sur la présence d'un cookie de session valide
- [ ] **D.** Sur le user-agent du client

### Question 168

Comment restreindre un firewall à un nom d'hôte précis, par exemple `admin.example.com` ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `vhost`
- [ ] **B.** Via l'option `host`, une expression régulière
- [ ] **C.** Via l'option `domain`, une chaîne exacte sans regex
- [ ] **D.** Ce n'est pas possible, seul le chemin (`pattern`) pouvant restreindre un firewall

### Question 169

Comment restreindre un firewall à certaines méthodes HTTP uniquement ? *(une seule bonne réponse)*

- [ ] **A.** Via `verbs`
- [ ] **B.** Via l'option `methods`, un tableau de méthodes HTTP
- [ ] **C.** Ce n'est pas possible au niveau du firewall, uniquement au niveau des routes
- [ ] **D.** Via l'option `http_methods`

### Question 170

Peut-on combiner les restrictions par chemin, hôte et méthode sur un même firewall ? *(une seule bonne réponse)*

- [ ] **A.** Non, une seule restriction peut être active à la fois par firewall
- [ ] **B.** Oui, mais uniquement en combinant `pattern` et `host`, jamais `methods`
- [ ] **C.** Non, il faut choisir entre une restriction simple et un `request_matcher` personnalisé, jamais les deux approches ensemble
- [ ] **D.** Oui, ces restrictions peuvent être combinées librement

### Question 171

Comment aller au-delà des restrictions simples (path/host/methods) pour un besoin de correspondance de requête totalement personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, les seules options `pattern`/`host`/`methods` étant disponibles
- [ ] **B.** En créant un événement personnalisé sur `kernel.request`
- [ ] **C.** Via un attribut PHP `#[FirewallMatcher]` sur une classe dédiée
- [ ] **D.** En configurant un service implémentant `RequestMatcherInterface` via l'option `request_matcher`

### Question 172

Quel firewall peut être défini sans aucun matcher (pattern, host, etc.) ? *(une seule bonne réponse)*

- [ ] **A.** Aucun firewall ne peut être défini sans un matcher explicite
- [ ] **B.** Uniquement le firewall nommé `main`, par convention obligatoire
- [ ] **C.** Le dernier firewall de la liste, pour qu'il gère toute requête non prise en charge par les précédents
- [ ] **D.** Le premier firewall, qui doit toujours être générique

### Question 173

Peut-on combiner (mixer) plusieurs types de restrictions de firewall (path, host, methods) sur une même entrée de configuration ? *(une seule bonne réponse)*

- [ ] **A.** Non, un seul type de restriction peut être utilisé à la fois
- [ ] **B.** Oui, mais uniquement deux des trois types simultanément, jamais les trois
- [ ] **C.** Non, mélanger les types de restrictions provoque une erreur de configuration
- [ ] **D.** Oui, individuellement ou combinées, selon la configuration désirée

## Implémenter la protection CSRF

### Question 174

Sur quel principe repose une attaque CSRF (Cross-Site Request Forgery) ? *(une seule bonne réponse)*

- [ ] **A.** Elle consiste à intercepter le trafic réseau non chiffré entre le client et le serveur
- [ ] **B.** Elle exploite une faille d'injection SQL dans le formulaire ciblé
- [ ] **C.** Elle consiste à deviner le mot de passe de l'utilisateur par force brute
- [ ] **D.** Elle exploite la confiance qu'une application web accorde au navigateur d'un utilisateur (ex. cookies de session) pour lui faire exécuter une action à son insu

### Question 175

Quelles sont les deux approches possibles pour gérer les tokens anti-CSRF ? *(plusieurs bonnes réponses)*

- [ ] **A.** Stateful : les tokens sont stockés en session, uniques par utilisateur et action
- [ ] **B.** Stateless : les tokens sont générés côté client, sans dépendre de la session
- [ ] **C.** Distribuée : les tokens sont synchronisés entre plusieurs serveurs via un bus de messages
- [ ] **D.** Chiffrée : les tokens sont systématiquement chiffrés avec la clé privée du serveur

### Question 176

Quelle commande installe le composant nécessaire à la génération et validation des tokens anti-CSRF ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/csrf-protection`
- [ ] **B.** Il est installé par défaut avec `symfony/security-bundle`
- [ ] **C.** `composer require symfony/security-http`
- [ ] **D.** `composer require symfony/security-csrf`

### Question 177

Pourquoi une session est-elle démarrée automatiquement dès qu'un formulaire protégé par CSRF est rendu, par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas le cas, aucune session n'est jamais nécessaire pour le CSRF
- [ ] **B.** Uniquement en environnement de développement, jamais en production
- [ ] **C.** Parce que les tokens CSRF sont stockés en session par défaut (approche stateful)
- [ ] **D.** Parce que Symfony démarre systématiquement une session sur toute requête, sans lien avec le CSRF

### Question 178

D'après les bonnes pratiques OWASP citées, la protection CSRF est-elle nécessaire pour les requêtes `GET` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, absolument toutes les requêtes doivent être protégées, y compris `GET`
- [ ] **B.** Non, et il est même recommandé d'inclure le token CSRF dans les paramètres `GET` pour plus de simplicité
- [ ] **C.** Cela dépend uniquement du framework CSS utilisé pour le formulaire
- [ ] **D.** Non, elle n'est requise que pour les opérations modifiant un état, qui ne doivent de toute façon jamais utiliser `GET`

### Question 179

Comment personnaliser globalement le nom du champ caché contenant le token CSRF pour tous les formulaires Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.form.csrf_field`, sans clé `field_name` imbriquée
- [ ] **B.** Via `framework.form.csrf_protection.field_name`
- [ ] **C.** Via `framework.csrf_protection.field_name`
- [ ] **D.** Ce n'est personnalisable que formulaire par formulaire, jamais globalement

### Question 180

Comment personnaliser, pour un seul formulaire, le nom du champ CSRF et l'identifiant du token ? *(une seule bonne réponse)*

- [ ] **A.** Via `field_name` et `token_id`, sans préfixe `csrf_`
- [ ] **B.** En surchargeant directement le service `security.csrf.token_manager`
- [ ] **C.** Via les options `csrf_field_name` et `csrf_token_id` de `configureOptions()`
- [ ] **D.** Ce n'est possible que globalement, jamais formulaire par formulaire

### Question 181

Comment générer et vérifier manuellement un token CSRF pour un formulaire HTML classique (non géré par le composant Form) ? *(une seule bonne réponse)*

- [ ] **A.** En stockant manuellement le token dans un cookie, sans passer par Twig
- [ ] **B.** Générer avec la fonction Twig `csrf_token('id')`, puis vérifier avec `isCsrfTokenValid('id', $token)` dans le contrôleur
- [ ] **C.** Ce n'est possible qu'avec le composant Form, jamais avec un formulaire HTML brut
- [ ] **D.** Via la fonction Twig `generate_token()`, sans méthode de vérification dédiée côté contrôleur

### Question 182

Comment appliquer une vérification CSRF déclarative directement sur une méthode de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Avec `#[Csrf('token-id')]`
- [ ] **B.** Il n'existe pas d'attribut dédié, seule la méthode manuelle `isCsrfTokenValid()` étant disponible
- [ ] **C.** Avec `#[RequireCsrf]`, sans argument
- [ ] **D.** Avec l'attribut `#[IsCsrfTokenValid('token-id', tokenKey: 'token')]`

### Question 183

Si `#[IsCsrfTokenValid]` est posé sur une classe de contrôleur entière, à quelles actions s'applique la vérification ? *(une seule bonne réponse)*

- [ ] **A.** À aucune, l'attribut ne fonctionnant qu'au niveau méthode
- [ ] **B.** Uniquement aux actions explicitement listées dans un second argument
- [ ] **C.** À toutes les actions définies dans ce contrôleur
- [ ] **D.** Uniquement à la première action déclarée

### Question 184

L'attribut `#[IsCsrfTokenValid]` peut-il accepter un identifiant de token dynamique, calculé à partir des arguments de la méthode ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement via une méthode PHP nommée `getCsrfId()`
- [ ] **B.** Non, ce cas nécessite toujours de revenir à la vérification manuelle
- [ ] **C.** Oui, en passant un objet `Expression` évalué pour obtenir l'id
- [ ] **D.** Non, l'identifiant doit toujours être une chaîne statique

### Question 185

Comment restreindre la vérification CSRF de `#[IsCsrfTokenValid]` à certaines méthodes HTTP uniquement, et que se passe-t-il pour les autres méthodes ? *(une seule bonne réponse)*

- [ ] **A.** Via `httpMethods`, qui bloque systématiquement les méthodes non listées
- [ ] **B.** Via l'argument `methods` ; pour une méthode HTTP non listée, l'attribut est ignoré et aucune validation n'a lieu
- [ ] **C.** Via `methods` ; pour une méthode non listée, une erreur 405 est automatiquement renvoyée
- [ ] **D.** Ce n'est pas configurable, la vérification s'appliquant toujours à toutes les méthodes HTTP

### Question 186

Quelles sources de token peut-on combiner via le paramètre `tokenSource` de `#[IsCsrfTokenValid]` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `SOURCE_PAYLOAD` (corps de la requête, POST/JSON), la source par défaut
- [ ] **B.** `SOURCE_QUERY` (chaîne de requête)
- [ ] **C.** `SOURCE_HEADER` (en-tête de requête)
- [ ] **D.** `SOURCE_COOKIE`, qui n'existe pas comme constante de cette classe

### Question 187

Comment Symfony atténue-t-il les attaques par canal auxiliaire de compression (BREACH/CRIME) sur les tokens CSRF ? *(une seule bonne réponse)*

- [ ] **A.** En chiffrant intégralement le corps de la réponse contenant le formulaire
- [ ] **B.** Ces attaques ne concernent pas les tokens CSRF, seulement les cookies de session
- [ ] **C.** En préfixant le token d'un masque aléatoire utilisé pour le brouiller
- [ ] **D.** En désactivant systématiquement la compression HTTP dès qu'un token CSRF est présent

### Question 188

Comment déclarer certains identifiants de token CSRF comme « stateless » (sans dépendre de la session) ? *(une seule bonne réponse)*

- [ ] **A.** En désinstallant le composant Session, ce qui force automatiquement le mode stateless
- [ ] **B.** Via l'option `stateless_token_ids`, activée par défaut dans les applications utilisant Symfony Flex
- [ ] **C.** Ce n'est pas configurable, tous les tokens CSRF étant toujours stateful
- [ ] **D.** Via `csrf_protection.mode: stateless`, une bascule globale sans granularité par identifiant

### Question 189

Quel avantage principal les tokens CSRF stateless offrent-ils en matière de mise en cache HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne changent rien en matière de cache, uniquement en matière de performance de génération du token
- [ ] **B.** Ils ne fonctionnent qu'en combinaison avec un CDN, jamais avec le cache HTTP natif de Symfony
- [ ] **C.** Ils permettent de mettre en cache entièrement une page contenant un formulaire protégé, sans dépendre de la session
- [ ] **D.** Ils suppriment totalement le besoin de protection CSRF sur les pages cachées

### Question 190

Lors de la validation d'un token CSRF stateless, quels en-têtes HTTP Symfony vérifie-t-il pour confirmer l'origine de la requête ? *(une seule bonne réponse)*

- [ ] **A.** `X-Forwarded-For` et `Host`
- [ ] **B.** `Authorization` et `Cookie`
- [ ] **C.** `Accept` et `User-Agent`
- [ ] **D.** `Origin` et `Referer`

### Question 191

Pourquoi les identifiants `authenticate` et `logout` sont-ils listés par défaut dans `stateless_token_ids` ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'ils sont les seuls identifiants compatibles avec le mode stateless
- [ ] **B.** Parce qu'ils sont utilisés par défaut par le composant Security lui-même
- [ ] **C.** Parce qu'ils correspondent aux seuls formulaires réellement sensibles de l'application
- [ ] **D.** Ils ne sont en réalité jamais inclus par défaut, contrairement à ce que suggère la documentation

### Question 192

À quoi sert l'identifiant `submit`, et via quelle option de configuration devient-il l'identifiant de token par défaut des formulaires autoconfigurés ? *(une seule bonne réponse)*

- [ ] **A.** Il ne concerne que les formulaires de connexion, jamais les formulaires métier de l'application
- [ ] **B.** Il s'agit d'un identifiant réservé, non configurable par l'utilisateur
- [ ] **C.** Il sert uniquement de nom de bouton HTML, sans lien avec la configuration CSRF
- [ ] **D.** Il permet aux types de formulaires de l'application d'utiliser eux aussi la protection CSRF stateless par défaut, via `framework.form.csrf_protection.token_id`

### Question 193

Quel mécanisme optionnel de « défense en profondeur » la protection CSRF stateless propose-t-elle en plus des en-têtes `Origin`/`Referer`, nécessitant du JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** Une double signature du corps de la requête avec deux clés distinctes
- [ ] **B.** Une vérification par double soumission (« double-submit ») via un cookie et un en-tête générés dynamiquement lors de la soumission du formulaire
- [ ] **C.** Une vérification par SMS envoyé à chaque soumission de formulaire
- [ ] **D.** Un CAPTCHA affiché systématiquement avant validation du formulaire

### Question 194

Quels attributs de cookie renforcent la protection du mécanisme de double soumission JavaScript, en plus de générer un nouveau token à chaque soumission ? *(une seule bonne réponse)*

- [ ] **A.** `domain=*`, pour couvrir tous les sous-domaines de l'application
- [ ] **B.** `samesite=strict` et le préfixe `__Host-`
- [ ] **C.** `secure=false` et `httponly=false`, pour laisser JavaScript lire et écrire le cookie librement
- [ ] **D.** Aucun attribut particulier n'est nécessaire pour ce mécanisme

### Question 195

La documentation recommande-t-elle de rendre obligatoire la validation par double soumission sur toutes les requêtes ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est la seule configuration recommandée en production
- [ ] **B.** Non, ce mécanisme est en réalité complètement déconseillé et absent de Symfony 8.0
- [ ] **C.** Oui, mais uniquement pour les utilisateurs authentifiés
- [ ] **D.** Non, l'approche opportuniste (repli sur `Origin`/`Referer` si JavaScript est indisponible) est préférée pour éviter de casser l'expérience utilisateur

## Personnaliser les réponses du formulaire de connexion

### Question 196

Vers quelle URL un utilisateur est-il redirigé par défaut après une connexion réussie ? *(une seule bonne réponse)*

- [ ] **A.** La dernière page visitée par n'importe quel utilisateur de l'application
- [ ] **B.** L'URL initialement demandée avant d'être redirigé vers le formulaire de connexion (ou `/` si aucune URL n'était stockée)
- [ ] **C.** Toujours la page d'accueil (`/`), quelle que soit l'URL demandée initialement
- [ ] **D.** Toujours la page de profil de l'utilisateur, par convention

### Question 197

Quelle option permet de changer la page de redirection par défaut après connexion (utilisée si aucune URL n'était stockée en session) ? *(une seule bonne réponse)*

- [ ] **A.** `success_redirect`
- [ ] **B.** `after_login_path`
- [ ] **C.** `home_path`
- [ ] **D.** `default_target_path`

### Question 198

Quelle option force systématiquement la redirection vers la page par défaut, en ignorant l'URL initialement demandée ? *(une seule bonne réponse)*

- [ ] **A.** `ignore_referer: true`
- [ ] **B.** `force_default_path: true`
- [ ] **C.** C'est le comportement systématique par défaut, sans option pour le changer
- [ ] **D.** `always_use_default_target_path: true`

### Question 199

Comment contrôler dynamiquement, depuis le formulaire de connexion lui-même, l'URL de redirection après succès ? *(une seule bonne réponse)*

- [ ] **A.** Via un paramètre `redirect_to`, toujours en GET uniquement
- [ ] **B.** Ce n'est pas possible dynamiquement, uniquement via `default_target_path` en configuration statique
- [ ] **C.** Via un en-tête HTTP `X-Redirect-After-Login`
- [ ] **D.** Via le paramètre `_target_path`, en GET (query string) ou POST (champ caché)

### Question 200

Que doit contenir la valeur du paramètre `_target_path`, un nom de route ou une URL ? *(une seule bonne réponse)*

- [ ] **A.** Un identifiant numérique correspondant à une route enregistrée
- [ ] **B.** Une URL relative ou absolue, jamais un nom de route Symfony
- [ ] **C.** Toujours un nom de route Symfony valide
- [ ] **D.** Les deux formes sont acceptées indifféremment

### Question 201

À quoi sert l'option `use_referer`, et dans quel cas précis l'en-tête `Referer` n'est-il pas utilisé malgré cette option activée ? *(une seule bonne réponse)*

- [ ] **A.** Elle remplace entièrement `default_target_path`, qui devient alors inutile
- [ ] **B.** Elle utilise l'en-tête `HTTP_REFERER` comme URL de redirection à défaut d'URL stockée ou de `_target_path` ; elle est ignorée si le referer correspond exactement à la route `login_path` (pour éviter une boucle)
- [ ] **C.** Elle force toujours la redirection vers le referer, sans aucune exception
- [ ] **D.** Elle ne s'applique qu'aux requêtes POST, jamais aux requêtes GET

### Question 202

Quelle option définit une page de redirection spécifique en cas d'échec de connexion ? *(une seule bonne réponse)*

- [ ] **A.** `on_failure_redirect`
- [ ] **B.** Il n'existe pas d'option dédiée, le formulaire de connexion étant toujours réaffiché
- [ ] **C.** `failure_path`
- [ ] **D.** `error_target_path`

### Question 203

Comment personnaliser le nom des paramètres de requête utilisés pour les redirections de succès et d'échec du login ? *(une seule bonne réponse)*

- [ ] **A.** Via `success_param_name` et `error_param_name`
- [ ] **B.** Uniquement en surchargeant `FormLoginAuthenticator` entièrement
- [ ] **C.** Via les options `target_path_parameter` et `failure_path_parameter`
- [ ] **D.** Ce n'est pas personnalisable, `_target_path` et `_failure_path` étant fixes

## Écrire un authenticator personnalisé

### Question 204

Quelle commande génère le squelette d'un authenticator personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `make:custom-authenticator`
- [ ] **B.** `make:security:custom`
- [ ] **C.** `make:authenticator`
- [ ] **D.** `make:security:authenticator`

### Question 205

Quelle interface tout authenticator doit-il implémenter, et quelle classe abstraite simplifie généralement cette implémentation ? *(une seule bonne réponse)*

- [ ] **A.** `AuthenticatorInterface` ; `BaseAuthenticator`, dépréciée depuis Symfony 7
- [ ] **B.** `AuthenticatorInterface` ; `AbstractAuthenticator` fournit une implémentation par défaut de `createToken()`
- [ ] **C.** `AuthenticationInterface` ; aucune classe abstraite n'est fournie
- [ ] **D.** `LoginInterface` ; `AbstractLogin`

### Question 206

Pour un authenticator qui est un formulaire de connexion, quelle classe abstraite spécialisée peut-on étendre pour simplifier l'implémentation ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de classe spécialisée, `AbstractAuthenticator` suffisant dans tous les cas
- [ ] **B.** `AbstractLoginFormAuthenticator`
- [ ] **C.** `AbstractFormAuthenticator`
- [ ] **D.** `LoginFormAbstractAuthenticator`

### Question 207

Comment déclarer qu'un authenticator personnalisé doit être pris en compte par un firewall ? *(une seule bonne réponse)*

- [ ] **A.** En le taguant `security.custom_authenticator`, sans configuration de firewall nécessaire
- [ ] **B.** En le listant dans l'option `custom_authenticators` du firewall
- [ ] **C.** Il est automatiquement détecté dès qu'il implémente `AuthenticatorInterface`, sans configuration
- [ ] **D.** Via l'option `authenticators` (sans le préfixe `custom_`)

### Question 208

Quel est le rôle de la méthode `supports()` d'un authenticator ? *(une seule bonne réponse)*

- [ ] **A.** Déterminer si l'utilisateur a le rôle requis pour la ressource demandée
- [ ] **B.** Décider, pour chaque requête, si cet authenticator doit être utilisé ; retourner `false` le fait ignorer
- [ ] **C.** Vérifier si les identifiants soumis sont corrects
- [ ] **D.** Générer le token de sécurité final

### Question 209

Quel est le rôle de la méthode `authenticate()` d'un authenticator ? *(une seule bonne réponse)*

- [ ] **A.** Décider si l'authenticator doit s'appliquer à cette requête
- [ ] **B.** Générer la réponse HTTP finale envoyée au client
- [ ] **C.** Rafraîchir l'utilisateur depuis la session à chaque requête
- [ ] **D.** Extraire les identifiants de la requête et les transformer en objet `Passport`

### Question 210

Si `onAuthenticationSuccess()` retourne `null`, que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** L'authentification est annulée malgré son succès apparent
- [ ] **B.** La requête courante continue son cours normalement, l'utilisateur étant authentifié — utile pour des routes API protégées par une simple clé
- [ ] **C.** Une exception fatale est levée, une réponse étant toujours obligatoire
- [ ] **D.** L'utilisateur est automatiquement redirigé vers la page d'accueil

### Question 211

Si `onAuthenticationFailure()` retourne `null`, que se passe-t-il, et pour quel cas d'usage cela est-il utile ? *(une seule bonne réponse)*

- [ ] **A.** Le firewall entier est désactivé pour le reste de la session
- [ ] **B.** La requête continue mais l'utilisateur n'est pas authentifié — utile pour les formulaires de connexion, où le contrôleur de login est réexécuté avec les erreurs
- [ ] **C.** Une exception HTTP 500 est automatiquement levée
- [ ] **D.** L'utilisateur est authentifié malgré l'échec signalé

### Question 212

Que ne faut-il jamais utiliser pour afficher un message d'erreur d'authentification à l'utilisateur, et que faut-il utiliser à la place ? *(une seule bonne réponse)*

- [ ] **A.** Ne jamais utiliser `getMessageKey()`, réservée à un usage interne ; toujours utiliser `getMessage()`
- [ ] **B.** Les deux méthodes sont strictement équivalentes et sans risque
- [ ] **C.** Ne jamais afficher aucun message, quel qu'il soit, pour des raisons de sécurité absolue
- [ ] **D.** Ne jamais utiliser `$exception->getMessage()` (peut contenir des informations sensibles) ; utiliser `getMessageKey()`/`getMessageData()`

### Question 213

Quelle exception spécifique peut-on détecter dans `onAuthenticationFailure()` pour savoir si l'échec est dû à une limitation de tentatives (login throttling) ? *(une seule bonne réponse)*

- [ ] **A.** `LoginThrottledException`
- [ ] **B.** `RateLimitExceededException`
- [ ] **C.** `BruteForceAuthenticationException`
- [ ] **D.** `TooManyLoginAttemptsAuthenticationException`

### Question 214

Quelle interface un authenticator « interactif » (ex. formulaire de connexion) devrait-il implémenter pour que `InteractiveLoginEvent` soit dispatché ? *(une seule bonne réponse)*

- [ ] **A.** Aucune interface n'est requise, l'événement étant toujours dispatché pour tout authenticator
- [ ] **B.** `InteractiveLoginInterface`, un nom différent de celui de l'événement
- [ ] **C.** `InteractiveAuthenticatorInterface`
- [ ] **D.** `UserInteractionAwareInterface`

### Question 215

Qu'est-ce qu'un « passeport » (Passport) dans le contexte d'un authenticator ? *(une seule bonne réponse)*

- [ ] **A.** Un simple alias de la classe `Request`
- [ ] **B.** Le nom donné au cookie de session de l'utilisateur
- [ ] **C.** Un objet contenant l'utilisateur à authentifier et d'autres informations (ex. si le mot de passe doit être vérifié, si remember me doit être activé)
- [ ] **D.** Un jeton JWT signé représentant la session

### Question 216

Quel badge attache l'utilisateur au passeport, et quelle information minimale requiert-il ? *(une seule bonne réponse)*

- [ ] **A.** `IdentityBadge`, qui requiert un objet `User` déjà instancié
- [ ] **B.** `AuthBadge`, qui requiert un mot de passe en clair
- [ ] **C.** `PassportBadge`, redondant avec le passeport lui-même
- [ ] **D.** `UserBadge`, qui requiert un identifiant utilisateur

### Question 217

Quelle est la longueur maximale autorisée pour l'identifiant utilisateur passé à `UserBadge`, et pourquoi cette limite existe-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a aucune limite technique imposée par Symfony
- [ ] **B.** 64 caractères, pour des raisons de performance de hashing
- [ ] **C.** 4096 caractères, pour prévenir les attaques de type « session storage flooding »
- [ ] **D.** 255 caractères, alignés sur la taille classique d'une colonne `varchar`

### Question 218

Comment personnaliser la façon dont `UserBadge` charge l'utilisateur, plutôt que de passer par le user provider configuré ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `UserBadge` utilisant toujours le user provider du firewall
- [ ] **B.** En créant une classe `CustomUserBadge` qui remplace entièrement `UserBadge`
- [ ] **C.** Via une méthode statique `UserBadge::withLoader()`
- [ ] **D.** En passant un callable en second argument, recevant l'identifiant et devant retourner un `UserInterface` (ou lever `UserNotFoundException`)

### Question 219

À quoi sert le troisième argument (callable normaliseur) de `UserBadge`, par exemple pour uniformiser la casse d'un identifiant ? *(une seule bonne réponse)*

- [ ] **A.** Il ne concerne que l'affichage de l'identifiant dans les logs, sans effet sur la logique de chargement
- [ ] **B.** Il remplace le user loader, les deux callables étant mutuellement exclusifs
- [ ] **C.** Il reçoit l'identifiant utilisateur et doit retourner une chaîne normalisée (ex. en minuscules), pour que des variantes comme "John.Doe" et "JOHN.DOE" soient traitées comme équivalentes
- [ ] **D.** Il sert à chiffrer l'identifiant avant de le transmettre au user provider

### Question 220

Quelle classe de credentials vérifie un mot de passe en clair via le hasher configuré pour l'utilisateur ? *(une seule bonne réponse)*

- [ ] **A.** `UserPasswordCredentials`
- [ ] **B.** `PasswordCredentials`
- [ ] **C.** `PlaintextCredentials`
- [ ] **D.** `HashedCredentials`

### Question 221

Quelle classe de credentials permet de vérifier les identifiants via une closure personnalisée, par exemple pour comparer un token d'API ? *(une seule bonne réponse)*

- [ ] **A.** `ClosureCredentials`
- [ ] **B.** `TokenCredentials`
- [ ] **C.** `ApiCredentials`
- [ ] **D.** `CustomCredentials`

### Question 222

Quand utiliser un `SelfValidatingPassport` plutôt qu'un `Passport` classique ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement pour les formulaires de connexion classiques avec mot de passe
- [ ] **B.** `SelfValidatingPassport` est en réalité un strict synonyme de `Passport`, sans différence
- [ ] **C.** Uniquement pour l'authentification LDAP
- [ ] **D.** Quand aucune vérification de credentials n'est nécessaire (ex. authentification par token d'API déjà validé)

### Question 223

Quel badge indique que l'authenticator supporte la fonctionnalité « remember me », sans lequel celle-ci ne s'active jamais ? *(une seule bonne réponse)*

- [ ] **A.** `StayLoggedInBadge`
- [ ] **B.** `RememberMeBadge`
- [ ] **C.** `PersistentLoginBadge`
- [ ] **D.** Aucun badge n'est nécessaire, `remember_me` étant activé automatiquement pour tout authenticator

### Question 224

À quoi sert le `PasswordUpgradeBadge`, et est-il ajouté manuellement en présence de `PasswordCredentials` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'a aucun rapport avec la migration de mot de passe, malgré son nom
- [ ] **B.** Il permet la migration automatique du hash du mot de passe après connexion réussie ; il est ajouté automatiquement dès que le passeport contient des `PasswordCredentials`
- [ ] **C.** Il faut toujours l'ajouter manuellement, même en présence de `PasswordCredentials`
- [ ] **D.** Il sert à forcer un changement de mot de passe obligatoire à la prochaine connexion

### Question 225

À quoi sert le `PreAuthenticatedUserBadge`, notamment vis-à-vis du « user checker » de pré-authentification ? *(une seule bonne réponse)*

- [ ] **A.** Il désactive totalement les user checkers pour toute la durée de la session
- [ ] **B.** Il indique que l'utilisateur a été pré-authentifié avant même l'initialisation de Symfony, ce qui saute le user checker de pré-authentification
- [ ] **C.** Il force l'exécution systématique de tous les user checkers, sans exception
- [ ] **D.** Il n'a d'effet que sur le remember me, pas sur les user checkers

### Question 226

Comment un authenticator personnalisé stocke-t-il une information arbitraire dans le passeport (ex. un « scope ») pour la récupérer plus tard, par exemple dans `createToken()` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, un passeport ne pouvant contenir que des badges prédéfinis
- [ ] **B.** Via la session HTTP directement, sans passer par le passeport
- [ ] **C.** Via `$passport->setAttribute('scope', $valeur)`, récupérable ensuite avec `$passport->getAttribute('scope')`
- [ ] **D.** En stockant l'information dans une propriété statique de la classe authenticator

## Le point d'entrée d'authentification

### Question 227

Dans quel cas de figure faut-il explicitement configurer un « point d'entrée » (entry point) sur un firewall ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement quand aucun authenticator n'est configuré
- [ ] **B.** Uniquement en environnement de production, jamais en développement
- [ ] **C.** Quand un firewall propose plusieurs façons de s'authentifier (ex. formulaire de connexion et connexion sociale), Symfony devant savoir laquelle utiliser pour démarrer l'authentification
- [ ] **D.** Systématiquement, un firewall sans `entry_point` explicite refusant de démarrer

### Question 228

Comment configure-t-on le formulaire de connexion comme point d'entrée d'un firewall proposant à la fois `form_login` et un authenticator personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `primary_entry: form_login`
- [ ] **B.** Ce n'est pas configurable, Symfony choisissant automatiquement au hasard
- [ ] **C.** `entry_point: form_login`
- [ ] **D.** `default_authenticator: form_login`

### Question 229

Peut-on définir son propre point d'entrée d'authentification, et si oui comment ? *(une seule bonne réponse)*

- [ ] **A.** Non, seul `form_login` peut être utilisé comme point d'entrée
- [ ] **B.** Oui, mais uniquement en redéfinissant intégralement le firewall par un bundle tiers
- [ ] **C.** Oui, en implémentant `EntryPointInterface` (sans le préfixe `Authentication`)
- [ ] **D.** Oui, en créant une classe implémentant `AuthenticationEntryPointInterface` et en la référençant via `entry_point: <id du service>`

### Question 230

Un firewall protège à la fois un site web classique (formulaire de connexion) et des endpoints d'API (clé API), et un seul point d'entrée peut être configuré par firewall. Quelle est la solution recommandée ? *(une seule bonne réponse)*

- [ ] **A.** Configurer deux valeurs pour `entry_point`, séparées par une virgule
- [ ] **B.** Ce cas de figure est impossible à gérer avec Symfony Security
- [ ] **C.** Utiliser `access_control` pour définir un point d'entrée différent par route
- [ ] **D.** Scinder la configuration en deux firewalls séparés, chacun avec son propre point d'entrée

### Question 231

Dans l'exemple de deux firewalls séparés (« api » et « main »), comment `access_control` distingue-t-il les rôles requis pour chaque zone ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `entry_point` de chaque règle `access_control`
- [ ] **B.** Par des entrées distinctes basées sur le `path` (ex. `^/api` → `ROLE_API_USER`, `^/` → `ROLE_USER`)
- [ ] **C.** `access_control` ne peut pas être utilisé conjointement à plusieurs firewalls
- [ ] **D.** En dupliquant l'intégralité de la configuration de sécurité pour chaque firewall

### Question 232

Combien de points d'entrée au maximum peut-on configurer pour un seul firewall ? *(une seule bonne réponse)*

- [ ] **A.** Un par authenticator configuré sur ce firewall
- [ ] **B.** Deux : un pour les requêtes HTML, un pour les requêtes API
- [ ] **C.** Il n'y a pas de limite, tous étant essayés dans l'ordre jusqu'à ce que l'un réponde
- [ ] **D.** Un seul

## Les voters pour vérifier les permissions

### Question 233

Quand tous les voters de l'application sont-ils appelés ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement lors de la connexion de l'utilisateur
- [ ] **B.** Une seule fois par session, le résultat étant ensuite mis en cache indéfiniment
- [ ] **C.** Uniquement si aucun rôle simple n'est défini sur la route
- [ ] **D.** À chaque appel de `isGranted()`, `denyAccessUnlessGranted()`, ou lors de l'évaluation d'un `access_control`

### Question 234

Quelle interface un voter personnalisé doit-il implémenter, et quelle classe abstraite simplifie généralement son écriture ? *(une seule bonne réponse)*

- [ ] **A.** `PermissionInterface` ; `AbstractPermission`
- [ ] **B.** `VoterInterface`, sans classe abstraite disponible
- [ ] **C.** `AccessInterface` ; `AbstractVoter`, dépréciée
- [ ] **D.** `VoterInterface` ; la classe abstraite `Voter` simplifie l'écriture

### Question 235

Quelle interface la classe abstraite `Voter` implémente-t-elle également, utilisée pour améliorer les performances par mise en cache ? *(une seule bonne réponse)*

- [ ] **A.** Aucune, la classe abstraite `Voter` ne gérant pas la performance
- [ ] **B.** `CacheableVoterInterface`
- [ ] **C.** `PerformantVoterInterface`
- [ ] **D.** `CachedVoterInterface`

### Question 236

Quel est le rôle de la méthode `supports(string $attribute, mixed $subject)` d'un voter ? *(une seule bonne réponse)*

- [ ] **A.** Vérifier si l'utilisateur est authentifié, indépendamment de l'attribut
- [ ] **B.** Charger le sujet depuis la base de données si nécessaire
- [ ] **C.** Déterminer si ce voter doit se prononcer sur la combinaison attribut/sujet donnée ; si `false`, `voteOnAttribute()` n'est pas appelée
- [ ] **D.** Retourner directement la décision d'autorisation finale

### Question 237

Dans `voteOnAttribute()`, quel paramètre permet de fournir une explication du vote, utilisée dans les logs et les pages d'exception ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucun mécanisme d'explication des votes
- [ ] **B.** Le paramètre `?Vote $vote`, via sa méthode `addReason()`
- [ ] **C.** Une exception personnalisée à lever systématiquement
- [ ] **D.** Le paramètre `$subject`, en lui ajoutant une propriété dynamique

### Question 238

Sur l'objet `Vote`, quelle propriété permet de stocker une donnée arbitraire réutilisable plus tard (par exemple par une stratégie de décision personnalisée) ? *(une seule bonne réponse)*

- [ ] **A.** `$customData`
- [ ] **B.** `$payload`
- [ ] **C.** `$extraData`
- [ ] **D.** `$metadata`

### Question 239

Comment un voter est-il déclaré auprès de la couche de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** En l'ajoutant manuellement dans `security.yaml` sous la clé `voters`
- [ ] **B.** En implémentant `VoterInterface`, la taguer étant alors superflu même sans configuration par défaut
- [ ] **C.** Via une commande `make:voter:register` obligatoire
- [ ] **D.** En le taguant `security.voter` ; automatique avec la configuration par défaut `services.yaml`

### Question 240

Pour vérifier un rôle (ex. `ROLE_SUPER_ADMIN`) depuis l'intérieur d'un voter, quel service doit-on utiliser plutôt que `Security::isGranted()` ? *(une seule bonne réponse)*

- [ ] **A.** `AuthorizationCheckerInterface`, en l'injectant une seconde fois
- [ ] **B.** `TokenStorageInterface` directement, sans passer par un service dédié
- [ ] **C.** Il est recommandé d'utiliser `Security::isGranted()`, aucune alternative n'étant fournie
- [ ] **D.** `AccessDecisionManagerInterface`, via sa méthode `decide()`

### Question 241

Pourquoi est-il déconseillé d'utiliser `Security::isGranted()` à l'intérieur d'un voter ? *(une seule bonne réponse)*

- [ ] **A.** Cela provoque systématiquement une boucle infinie entre voters
- [ ] **B.** `Security::isGranted()` ne peut être appelée que depuis un contrôleur, jamais depuis un service
- [ ] **C.** Cela ne garantit pas que la vérification porte sur le même token que celui utilisé par le voter, le token en stockage pouvant changer entre-temps
- [ ] **D.** La méthode `isGranted()` du service `Security` n'existe pas, seule celle du contrôleur existe

### Question 242

Quelle méthode surcharger sur un voter pour indiquer à Symfony qu'il ne s'applique qu'à certains attributs, permettant de mettre en cache la résolution du voter et d'éviter de le rappeler pour un attribut non supporté ? *(une seule bonne réponse)*

- [ ] **A.** `cacheAttribute(string $attribute): bool`
- [ ] **B.** `isAttributeSupported(string $attribute): bool`
- [ ] **C.** `attributeCache(string $attribute): bool`
- [ ] **D.** `supportsAttribute(string $attribute): bool`

### Question 243

Quelle méthode surcharger sur un voter pour indiquer à Symfony le(s) type(s) d'objet supporté(s), permettant d'éviter de rappeler le voter pour un type non pertinent ? *(une seule bonne réponse)*

- [ ] **A.** `isTypeSupported(string $subjectType): bool`
- [ ] **B.** `acceptsSubject(string $subjectType): bool`
- [ ] **C.** `supportsType(string $subjectType): bool`
- [ ] **D.** `supportsClass(string $className): bool`

### Question 244

Pourquoi une comparaison stricte `Post::class === $subjectType` est-elle déconseillée dans `supportsType()` ? *(une seule bonne réponse)*

- [ ] **A.** `$subjectType` est toujours un objet, jamais une chaîne de caractères
- [ ] **B.** Cette comparaison lève systématiquement une `TypeError`
- [ ] **C.** Le type de sujet peut être une classe proxy Doctrine ; il faut utiliser `is_a($subjectType, Post::class, true)`
- [ ] **D.** `Post::class` n'existe pas encore à ce stade du cycle de requête

### Question 245

Par défaut, si `#[IsGranted]` refuse l'accès, quel code de statut HTTP et quel message sont retournés ? *(une seule bonne réponse)*

- [ ] **A.** HTTP 401 avec le message « Unauthorized »
- [ ] **B.** HTTP 404 avec un message vide
- [ ] **C.** HTTP 500 avec le message « Access Denied »
- [ ] **D.** HTTP 403 avec le message « Access Denied »

### Question 246

Sur `#[IsGranted]`, si un code de statut différent de 403 est spécifié (ex. 404 pour masquer l'existence d'une ressource), que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Le code personnalisé est ignoré, Symfony renvoyant toujours 403
- [ ] **B.** Une exception fatale est levée, seul 403 étant autorisé
- [ ] **C.** Le code personnalisé n'est appliqué qu'en environnement `dev`
- [ ] **D.** Une `HttpException` est levée avec ce code, à la place de l'`AccessDeniedException` par défaut

### Question 247

Quelle est la stratégie de décision par défaut de l'access decision manager ? *(une seule bonne réponse)*

- [ ] **A.** `consensus` — compare le nombre de votes pour et contre
- [ ] **B.** `priority` — se base sur le premier voter non abstentionniste
- [ ] **C.** `affirmative` — accorde l'accès dès qu'un voter l'accorde
- [ ] **D.** `unanimous` — nécessite qu'aucun voter ne refuse

### Question 248

Avec la stratégie `consensus`, comment est tranché un cas d'égalité entre votes favorables et défavorables ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée, un cas d'égalité étant considéré comme une erreur de configuration
- [ ] **B.** Selon l'option `allow_if_equal_granted_denied`, qui vaut `true` par défaut
- [ ] **C.** L'accès est toujours refusé en cas d'égalité, sans option de configuration
- [ ] **D.** Le premier voter à s'être prononcé l'emporte automatiquement

### Question 249

Avec la stratégie `unanimous`, quelle condition suffit à refuser l'accès ? *(une seule bonne réponse)*

- [ ] **A.** Qu'aucun voter ne se prononce (abstention totale)
- [ ] **B.** Qu'au moins un voter refuse l'accès
- [ ] **C.** Que la majorité des voters refusent l'accès
- [ ] **D.** Que tous les voters refusent l'accès

### Question 250

Que se passe-t-il si tous les voters s'abstiennent, quelle que soit la stratégie choisie ? *(une seule bonne réponse)*

- [ ] **A.** Une exception `NoVoterAppliedException` est systématiquement levée
- [ ] **B.** La stratégie `priority` est automatiquement appliquée en secours
- [ ] **C.** La décision dépend de l'option `allow_if_all_abstain`, qui vaut `false` par défaut
- [ ] **D.** L'accès est toujours accordé par défaut, indépendamment de toute option

### Question 251

Comment configure-t-on la stratégie `unanimous` pour l'access decision manager ? *(une seule bonne réponse)*

- [ ] **A.** `security.access_control.strategy: unanimous`
- [ ] **B.** `security.firewalls.main.strategy: unanimous`
- [ ] **C.** `security.access_decision_manager.strategy: unanimous`
- [ ] **D.** `security.voters.strategy: unanimous`

### Question 252

Comment fournir une stratégie de décision entièrement personnalisée plutôt que l'une des quatre stratégies intégrées ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seules les quatre stratégies intégrées étant disponibles
- [ ] **B.** Via `access_decision_manager.custom_strategy`, sans interface à implémenter
- [ ] **C.** Via `access_decision_manager.strategy_service`, pointant vers un service implémentant `AccessDecisionStrategyInterface`
- [ ] **D.** En surchargeant directement la constante `AccessDecisionManager::STRATEGY_CUSTOM`

### Question 253

Comment remplacer entièrement l'access decision manager par une implémentation personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seule la stratégie étant personnalisable, jamais le manager entier
- [ ] **B.** En taguant un service `security.access_decision_manager`, sans option de configuration dédiée
- [ ] **C.** Via `access_decision_manager.strategy_service` (le même mécanisme que pour une stratégie personnalisée)
- [ ] **D.** Via `access_decision_manager.service`, pointant vers un service implémentant `AccessDecisionManagerInterface`

### Question 254

Dans l'exemple d'utilisation depuis un contrôleur, à quoi sert le second argument de `#[IsGranted('edit', 'post')]` ? *(une seule bonne réponse)*

- [ ] **A.** Il indique le nom du voter à appeler explicitement, en ignorant les autres
- [ ] **B.** Il désigne le nom de l'argument du contrôleur à passer comme sujet au voter
- [ ] **C.** Il définit le rôle minimal requis, en plus de l'attribut `edit`
- [ ] **D.** Il précise le message d'erreur à afficher en cas de refus

### Question 255

Dans l'exemple du blog, quelle logique un utilisateur non authentifié rencontre-t-il dans `voteOnAttribute()` ? *(une seule bonne réponse)*

- [ ] **A.** L'accès est automatiquement accordé en lecture seule
- [ ] **B.** Une exception est levée immédiatement, interrompant le processus de vote
- [ ] **C.** Le voter s'abstient systématiquement en l'absence d'utilisateur authentifié
- [ ] **D.** L'accès est refusé (`return false`), une raison étant ajoutée au vote via `addReason()`

### Question 256

Si aucun rôle simple ne suffit et que la logique de permission n'est utilisée qu'à un seul endroit du code, quelle alternative aux voters est suggérée ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser exclusivement `access_control`, les voters étant réservés aux cas complexes
- [ ] **B.** Créer un firewall dédié pour cette unique vérification
- [ ] **C.** Mettre directement la logique dans le contrôleur, avec `createAccessDeniedException()` si nécessaire
- [ ] **D.** Il n'existe aucune alternative, un voter étant obligatoire dans tous les cas

## Le fonctionnement détaillé d'access_control

### Question 257

Pour chaque requête entrante, combien d'entrées `access_control` Symfony applique-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Aucune par défaut, `access_control` devant être explicitement activé par route
- [ ] **B.** Une seule : la première entrée qui correspond
- [ ] **C.** Toutes les entrées qui correspondent, cumulées
- [ ] **D.** Les deux premières entrées correspondantes, en cas d'égalité de priorité

### Question 258

Quelle classe Symfony utilise-t-il en interne pour déterminer si une entrée `access_control` correspond à la requête ? *(une seule bonne réponse)*

- [ ] **A.** `RequestVoter`
- [ ] **B.** `SecurityRequestMatcher`
- [ ] **C.** `ChainRequestMatcher`
- [ ] **D.** `AccessControlMatcher`

### Question 259

Parmi les options suivantes, laquelle n'est PAS une option de **correspondance** (matching) d'une entrée `access_control` ? *(une seule bonne réponse)*

- [ ] **A.** `methods`
- [ ] **B.** `host`
- [ ] **C.** `requires_channel`
- [ ] **D.** `path`

### Question 260

Comment cibler une entrée `access_control` sur un nom de route précis, en plus (ou à la place) de `path` ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `controller: 'nom_de_la_route'`
- [ ] **B.** Via `path` uniquement, en y indiquant le nom de la route entre accolades
- [ ] **C.** Via l'option `route: 'nom_de_la_route'`, raccourci de `attributes: {'_route': 'nom_de_la_route'}`
- [ ] **D.** Ce n'est pas possible, seul `path` permettant de cibler une URL

### Question 261

Que se passe-t-il si `ip`, `port`, `host` ou `methods` ne sont pas spécifiés sur une entrée `access_control` ? *(une seule bonne réponse)*

- [ ] **A.** Cette entrée ne correspond alors jamais, l'option étant considérée comme requise
- [ ] **B.** Symfony lève une exception de configuration au démarrage
- [ ] **C.** La valeur par défaut `localhost`/`80`/`GET` est appliquée automatiquement
- [ ] **D.** Cette entrée correspond à n'importe quelle valeur pour l'option omise

### Question 262

Une requête vers `/admin/user` (IP `168.0.0.1`, port `80`, host `symfony.com`, méthode `GET`) est testée contre des règles ciblant successivement port 8080, une IP `127.0.0.1`, le host `symfony.com`, puis la méthode `POST/PUT`. Quelle règle s'applique ? *(une seule bonne réponse)*

- [ ] **A.** La règle basée sur la méthode (quatrième règle), car les précédentes sont ignorées sans IP fournie
- [ ] **B.** La règle basée sur le `host` (troisième règle), les deux premières ne correspondant pas sur l'IP/le port
- [ ] **C.** La règle basée sur le port 8080 (première règle), car `path` correspond déjà
- [ ] **D.** Aucune règle ne s'applique, la méthode `GET` n'étant listée dans aucune d'elles

### Question 263

Une requête vers `/foo` ne correspond à aucune entrée `access_control` dont les `path` ciblent tous `^/admin`. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** La première entrée de la liste est appliquée par défaut
- [ ] **B.** Une exception `NoMatchingAccessControlException` est levée
- [ ] **C.** Aucune restriction `access_control` n'est appliquée à cette requête
- [ ] **D.** La requête est automatiquement refusée par sécurité

### Question 264

Le matching du `path` d'une entrée `access_control` prend-il en compte les paramètres `$_GET` de la requête ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend de la version de Symfony, le comportement ayant changé en 8.0
- [ ] **B.** Non ; pour restreindre l'accès selon des paramètres GET, il faut le faire en PHP dans le contrôleur
- [ ] **C.** Oui, `path` inclut nativement la query string complète
- [ ] **D.** Oui, mais uniquement si l'option `match_query_string: true` est ajoutée

### Question 265

Une fois une entrée `access_control` matchée, quelles options servent à l'**enforcement** (restriction effective de l'accès) ? *(une seule bonne réponse)*

- [ ] **A.** `path`, `ip` et `host`
- [ ] **B.** `methods` et `port` uniquement
- [ ] **C.** `request_matcher` exclusivement
- [ ] **D.** `roles`, `allow_if` et `requires_channel`

### Question 266

Si l'utilisateur n'a pas le rôle requis par une entrée `access_control` matchée, quelle exception est levée en interne ? *(une seule bonne réponse)*

- [ ] **A.** `ForbiddenHttpException`
- [ ] **B.** `AccessDeniedException`
- [ ] **C.** `AuthenticationException`
- [ ] **D.** `InsufficientRoleException`

### Question 267

Comment le tableau de `roles` d'une entrée `access_control` est-il transmis aux voters de l'application ? *(une seule bonne réponse)*

- [ ] **A.** Les voters ne sont jamais appelés pour les entrées `access_control`, seul un contrôle de rôle simple étant fait
- [ ] **B.** Via un événement dédié `security.access_control_check`, séparé du système de voters
- [ ] **C.** Comme argument `$attributes`, avec la `Request` courante comme `$subject`
- [ ] **D.** Comme argument `$subject`, la `Request` étant passée en `$attributes`

### Question 268

Si `roles` et `allow_if` sont définis simultanément sur une même entrée, avec la stratégie de décision par défaut (`affirmative`), quel est le comportement ? *(une seule bonne réponse)*

- [ ] **A.** Les deux conditions doivent être vraies simultanément (comportement de type AND)
- [ ] **B.** Seul `allow_if` est pris en compte, `roles` étant alors ignoré
- [ ] **C.** Une exception de configuration est levée, les deux options étant mutuellement exclusives
- [ ] **D.** L'accès est accordé s'il y a au moins une condition valide parmi les deux (comportement de type OR)

### Question 269

Si l'accès est refusé par `access_control` et que l'utilisateur n'est pas encore authentifié, que tente Symfony ? *(une seule bonne réponse)*

- [ ] **A.** D'afficher directement la page d'erreur 403, sans tentative d'authentification
- [ ] **B.** De rediriger systématiquement vers la page d'accueil, sans passer par le firewall
- [ ] **C.** De renvoyer une réponse 500, l'authentification différée n'étant pas supportée
- [ ] **D.** D'authentifier l'utilisateur (ex. redirection vers la page de connexion) avant d'afficher une éventuelle erreur 403

### Question 270

Concernant l'option `ips`/`ip` d'une entrée `access_control`, quel est le piège à connaître sur son effet réel ? *(une seule bonne réponse)*

- [ ] **A.** Elle bloque strictement toute IP différente de celle spécifiée, sans possibilité de fallback
- [ ] **B.** Elle n'accepte qu'une seule adresse IP, jamais une plage ou un masque de sous-réseau
- [ ] **C.** Elle ne peut être combinée avec aucune autre option de matching
- [ ] **D.** Elle ne restreint pas l'accès à cette IP : elle fait seulement que l'entrée ne matche que pour cette IP, les autres requêtes continuant vers les entrées suivantes

### Question 271

Dans l'exemple `/internal*`, une requête arrivant de `10.0.0.1` (IP externe non listée) rencontre une règle `ips: [127.0.0.1, ::1, 192.168.0.1/24]` puis une règle `roles: ROLE_NO_ACCESS` sans restriction d'IP. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** L'accès est automatiquement autorisé, faute de règle explicitement adaptée à cette IP
- [ ] **B.** La première règle est ignorée (IP non listée), la seconde s'applique et l'accès est refusé si personne n'a `ROLE_NO_ACCESS`
- [ ] **C.** La première règle s'applique quand même, car `path` correspond indépendamment de l'IP
- [ ] **D.** Aucune règle ne s'applique, l'IP non listée annulant tout `access_control` sur ce chemin

### Question 272

Comment restreindre une entrée `access_control` à un port spécifique (ex. `8080`) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible nativement, un reverse proxy étant nécessaire
- [ ] **B.** Via l'option `port: 8080`
- [ ] **C.** En l'intégrant dans `path` sous la forme `^:8080/`
- [ ] **D.** Via l'option `host` suffixée du port (ex. `host: 'localhost:8080'`)

### Question 273

Comment forcer HTTPS sur une entrée `access_control` particulière, en redirigeant automatiquement les requêtes HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `force_ssl: true`
- [ ] **B.** Via l'option `requires_channel: https`
- [ ] **C.** Via l'option `roles: REQUIRE_HTTPS`
- [ ] **D.** Via l'option `secure: true`

### Question 274

Dans une expression `allow_if`, quel objet est disponible pour, par exemple, vérifier l'IP cliente ou un header de la requête ? *(une seule bonne réponse)*

- [ ] **A.** `context`, un objet propre au moteur d'expression de sécurité
- [ ] **B.** `httpRequest`, un alias déprécié de `request`
- [ ] **C.** Aucun objet requête n'est accessible dans `allow_if`, contrairement à `#[IsGranted]`
- [ ] **D.** `request`, l'objet `Request` de Symfony

## Utiliser des expressions dans les contrôles de sécurité

### Question 275

En plus des rôles simples comme `ROLE_ADMIN`, quel type d'objet `isGranted()` et `#[IsGranted]` acceptent-ils pour des règles d'autorisation complexes ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau associatif de règles, sans langage d'expression
- [ ] **B.** Un objet `Symfony\Component\ExpressionLanguage\Expression`
- [ ] **C.** Une closure PHP anonyme uniquement, jamais un objet dédié
- [ ] **D.** Une chaîne SQL évaluée dynamiquement

### Question 276

Selon la documentation, quelle est la « meilleure » solution pour gérer des règles d'autorisation complexes, à privilégier avant de recourir aux expressions ? *(une seule bonne réponse)*

- [ ] **A.** Les expressions `allow_if` dans `access_control`
- [ ] **B.** Un event listener sur `kernel.request`
- [ ] **C.** Un middleware Symfony dédié
- [ ] **D.** Le système de voters

### Question 277

Dans une expression de sécurité, que représente la variable `user` ? *(une seule bonne réponse)*

- [ ] **A.** Le nom d'utilisateur (chaîne de caractères) uniquement, jamais l'objet complet
- [ ] **B.** L'entité Doctrine `User`, indépendamment de l'implémentation de `UserInterface`
- [ ] **C.** Toujours non-null, une valeur anonyme spéciale étant utilisée en l'absence d'authentification
- [ ] **D.** L'instance `UserInterface` de l'utilisateur courant, ou `null` si non authentifié

### Question 278

Que contient la variable `role_names` dans une expression de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `RoleHierarchy` complet, pas un simple tableau
- [ ] **B.** La liste de tous les rôles définis dans l'application, pas seulement ceux de l'utilisateur
- [ ] **C.** Un tableau des rôles de l'utilisateur (y compris ceux hérités via la hiérarchie de rôles), sans les attributs `IS_AUTHENTICATED_*`
- [ ] **D.** Uniquement les rôles directement attribués à l'utilisateur, sans la hiérarchie

### Question 279

Quelle relation existe-t-il entre les variables `object` et `subject` dans une expression de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** `object` est l'ancien nom déprécié, `subject` devant systématiquement être préféré
- [ ] **B.** `subject` ne contient qu'une partie de `object`, filtrée par les voters
- [ ] **C.** Elles ne peuvent pas coexister dans la même expression
- [ ] **D.** Elles sont équivalentes : `subject` stocke la même valeur que `object`

### Question 280

Que retourne la fonction `is_authenticated()` dans une expression de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** `true` uniquement si l'utilisateur s'est connecté durant la session courante (remember-me exclu)
- [ ] **B.** `true` uniquement si l'utilisateur a `ROLE_ADMIN`
- [ ] **C.** Toujours `true`, même pour un utilisateur anonyme
- [ ] **D.** `true` si l'utilisateur est authentifié via remember-me ou pleinement authentifié — c'est-à-dire s'il est « connecté »

### Question 281

En quoi `is_remember_me()` diffère-t-elle du contrôle `IS_AUTHENTICATED_REMEMBERED` via `isGranted()`, bien qu'elles semblent similaires ? *(une seule bonne réponse)*

- [ ] **A.** `IS_AUTHENTICATED_REMEMBERED` est dépréciée au profit exclusif de `is_remember_me()`
- [ ] **B.** `is_remember_me()` retourne `true` uniquement si l'utilisateur est authentifié via un cookie remember-me, alors que `IS_AUTHENTICATED_REMEMBERED` peut aussi être vrai pour une authentification complète
- [ ] **C.** Elles sont strictement identiques dans tous les cas, sans aucune nuance
- [ ] **D.** `is_remember_me()` ne fonctionne que dans `access_control`, jamais dans `#[IsGranted]`

### Question 282

Que vérifie la fonction `is_fully_authenticated()`, par équivalence avec quel rôle ? *(une seule bonne réponse)*

- [ ] **A.** Équivalent à `is_authenticated() and is_remember_me()` combinés
- [ ] **B.** Équivalent à vérifier `IS_AUTHENTICATED_FULLY`
- [ ] **C.** Équivalent à vérifier `ROLE_USER`
- [ ] **D.** Équivalent à vérifier `IS_AUTHENTICATED_REMEMBERED`

### Question 283

Que fait la fonction `is_granted()` utilisée à l'intérieur d'une expression de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** Ne peut vérifier que des rôles simples, jamais un attribut de voter personnalisé
- [ ] **B.** N'est utilisable que dans `access_control`, pas dans `#[IsGranted]`
- [ ] **C.** Vérifie si l'utilisateur a la permission donnée, avec un second argument optionnel pour l'objet concerné — équivalent à la méthode `isGranted()` du service de sécurité
- [ ] **D.** Retourne toujours `true`, servant uniquement à documenter l'intention

### Question 284

Dans `#[IsGranted]`, quand le `subject` est un `Expression`, quelles variables sont accessibles à l'intérieur de cette expression de sujet ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `object`, `subject` ne pouvant pas être une expression imbriquée
- [ ] **B.** Aucune, une expression de sujet ne pouvant référencer que des constantes littérales
- [ ] **C.** `request` (l'objet `Request`) et `args` (les arguments du contrôleur)
- [ ] **D.** `user` et `role_names` uniquement, les mêmes que pour l'attribut principal

### Question 285

Quand le `subject` de `#[IsGranted]` est un tableau associatif, à quoi sert la clé de chaque entrée ? *(une seule bonne réponse)*

- [ ] **A.** Elle doit obligatoirement correspondre au nom d'un rôle existant
- [ ] **B.** Elle est ignorée, seule la valeur de chaque entrée comptant
- [ ] **C.** Elle sert d'alias pour le résultat de l'expression correspondante, réutilisable dans l'expression de l'attribut principal
- [ ] **D.** Elle définit l'ordre d'évaluation des expressions, sans autre effet

### Question 286

En plus des expressions, quel autre type de valeur `#[IsGranted]` accepte-t-il pour l'attribut, permettant une logique personnalisée en pur PHP ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne contenant du code PHP évalué dynamiquement via `eval()`
- [ ] **B.** Un service tagué `security.custom_attribute`, jamais une closure inline
- [ ] **C.** Ce n'est pas possible, seules les expressions et les rôles simples étant acceptés
- [ ] **D.** Une closure statique retournant un booléen, recevant un `IsGrantedContext` et le sujet

### Question 287

Quand le `subject` de `#[IsGranted]` est lui-même une closure, que doit-elle retourner ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `Vote`, comme dans un voter classique
- [ ] **B.** Une chaîne représentant le nom du sujet, résolue ensuite par Symfony
- [ ] **C.** Un tableau de valeurs qui sera injecté dans la closure de l'attribut
- [ ] **D.** Un booléen indiquant si l'accès est autorisé, directement

## Personnaliser les réponses de refus d'accès

### Question 288

Quelle exception faut-il lever pour interdire l'accès à un utilisateur, que Symfony transforme ensuite en réponse adaptée à l'état d'authentification ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpKernel\Exception\ForbiddenHttpException`
- [ ] **B.** `Symfony\Component\Security\Core\Exception\AuthorizationException`
- [ ] **C.** `Symfony\Component\HttpFoundation\Exception\AccessDeniedException`
- [ ] **D.** `Symfony\Component\Security\Core\Exception\AccessDeniedException`

### Question 289

Si l'utilisateur n'est pas authentifié (ou authentifié anonymement) et qu'une `AccessDeniedException` est levée, quel type de réponse Symfony génère-t-il typiquement ? *(une seule bonne réponse)*

- [ ] **A.** Toujours et uniquement une réponse 403 Forbidden
- [ ] **B.** Une réponse 500 Internal Server Error
- [ ] **C.** Une réponse 200 avec un message d'erreur inline dans le corps
- [ ] **D.** Une réponse via le point d'entrée d'authentification (souvent une redirection vers la page de connexion, ou un 401)

### Question 290

Si l'utilisateur est authentifié mais ne possède pas les permissions requises, quelle réponse est générée ? *(une seule bonne réponse)*

- [ ] **A.** Une réponse 401 Unauthorized
- [ ] **B.** Une réponse 404 Not Found, pour masquer l'existence de la ressource
- [ ] **C.** Une réponse 403 Forbidden
- [ ] **D.** Une redirection vers la page de connexion, comme pour un utilisateur non authentifié

### Question 291

Quelle méthode de `AuthenticationEntryPointInterface` est appelée pour générer la réponse d'un utilisateur non authentifié tentant d'accéder à une ressource protégée ? *(une seule bonne réponse)*

- [ ] **A.** `respond(Request $request)`
- [ ] **B.** `onAccessDenied(Request $request)`
- [ ] **C.** `handle(Request $request, AuthenticationException $authException)`
- [ ] **D.** `start(Request $request, ?AuthenticationException $authException = null)`

### Question 292

Quelle méthode de `AccessDeniedHandlerInterface` permet de personnaliser la réponse 403 pour un utilisateur authentifié sans les permissions requises ? *(une seule bonne réponse)*

- [ ] **A.** `start(Request $request, ?AuthenticationException $authException = null)`
- [ ] **B.** `respond(Request $request, AccessDeniedException $exception): Response`
- [ ] **C.** `denyAccess(Request $request): Response`
- [ ] **D.** `handle(Request $request, AccessDeniedException $accessDeniedException): ?Response`

### Question 293

Comment enregistre-t-on un handler d'accès refusé personnalisé sur un firewall ? *(une seule bonne réponse)*

- [ ] **A.** Via `access_control`, en ajoutant une clé `handler` à chaque entrée
- [ ] **B.** Il n'existe pas d'option dédiée, seul un event listener global étant possible
- [ ] **C.** Via l'option `access_denied_handler` du firewall, pointant vers l'id du service
- [ ] **D.** Via l'option `access_denied_url` du firewall

### Question 294

Pour personnaliser à la fois la réponse d'authentification et la réponse de refus d'accès en un seul endroit (ex. pour systématiquement logger l'exception), quelle approche est recommandée ? *(une seule bonne réponse)*

- [ ] **A.** Surcharger le firewall par défaut de Symfony directement
- [ ] **B.** Ce n'est pas possible, les deux réponses devant nécessairement être configurées séparément
- [ ] **C.** Configurer un listener sur l'événement `kernel.exception`
- [ ] **D.** Implémenter à la fois `AuthenticationEntryPointInterface` et `AccessDeniedHandlerInterface` dans une seule classe fusionnée

### Question 295

Dans l'exemple de listener sur `kernel.exception`, pourquoi la priorité configurée doit-elle être supérieure à celle de l'`ExceptionListener` HTTP de sécurité ? *(une seule bonne réponse)*

- [ ] **A.** La priorité n'a aucune importance, tous les listeners `kernel.exception` étant exécutés dans l'ordre d'enregistrement
- [ ] **B.** Pour que le listener ne s'exécute qu'en environnement de production
- [ ] **C.** Pour éviter que Symfony ne déclenche deux fois le même événement
- [ ] **D.** Pour garantir que le listener personnalisé est appelé avant le listener d'exception par défaut de la sécurité

## Forcer HTTPS (ou HTTP) selon les URLs

### Question 296

Quelle est, selon la documentation, la « meilleure » politique concernant HTTPS pour un site ? *(une seule bonne réponse)*

- [ ] **A.** N'utiliser HTTPS qu'en environnement de production, jamais en configuration `access_control`
- [ ] **B.** Forcer HTTPS sur toutes les URLs, via la configuration du serveur web ou `access_control`
- [ ] **C.** Forcer HTTPS uniquement sur les pages de connexion et de paiement
- [ ] **D.** Laisser HTTP disponible par défaut et n'activer HTTPS qu'à la demande explicite de l'utilisateur

### Question 297

Quelle astuce permet de faciliter le développement local en gardant HTTP tout en forçant HTTPS en production, via `requires_channel` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `requires_channel` devant être une valeur littérale fixe
- [ ] **B.** Activer un mode `dev_insecure: true` global qui désactive `requires_channel`
- [ ] **C.** Utiliser une variable d'environnement, ex. `requires_channel: '%env(REQUIRED_SCHEME)%'`, valant `http` en dev et `https` en prod
- [ ] **D.** Définir deux fichiers `security.yaml` distincts par environnement, sans variable d'environnement

### Question 298

En dehors d'`access_control`, quelle autre option native permet de forcer un schéma HTTP/HTTPS sur une route ou un groupe de routes ? *(une seule bonne réponse)*

- [ ] **A.** L'option `requires_channel`, également disponible directement sur les routes
- [ ] **B.** Il n'existe pas d'équivalent au niveau du routing, `access_control` étant la seule solution
- [ ] **C.** L'option `scheme` du routing
- [ ] **D.** L'option `protocol` du routing

### Question 299

Quelle précaution particulière faut-il prendre pour forcer HTTPS lorsque l'application tourne derrière un reverse proxy ou un load balancer ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver `requires_channel` et gérer HTTPS uniquement au niveau du proxy, sans jamais le configurer côté Symfony
- [ ] **B.** Utiliser exclusivement l'option `scheme` du routing, `access_control` étant incompatible avec les proxies
- [ ] **C.** Configurer correctement les proxies de confiance, sous peine de boucles de redirection infinies
- [ ] **D.** Aucune précaution particulière n'est nécessaire, le comportement étant identique avec ou sans proxy

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Security de la documentation Symfony 8.0](https://symfony.com/doc/8.0/security.html) ; les entrées préfixées renvoient à l'une des pages de sa section Learn more (Passwords, LDAP, Remember Me, Impersonating User, User Checkers, Firewall Restriction, CSRF, Form Login, Custom Authenticator, Entry Point, Voters, Access Control, Expressions, Access Denied Handler, Force HTTPS).

**Question 1 : B** — « `$ composer require symfony/security-bundle` » *(§ Installation)*

**Question 2 : D** — « If you have Symfony Flex installed, this also creates a `security.yaml` configuration file for you » *(§ Installation)*

**Question 3 : A, B, C** — « In the next sections, the three main elements are discussed: The User (`providers`) (…) The Firewall & Authenticating Users (`firewalls`) (…) Access Control (Authorization) (`access_control`) » *(§ Installation)*

**Question 4 : B** — « This is a class that implements `Symfony\Component\Security\Core\User\UserInterface`. » *(§ The User)*

**Question 5 : D** — « The easiest way to generate a user class is using the `make:user` command from the MakerBundle » *(§ The User)*

**Question 6 : A, B** — options `--with-uuid` et `--with-ulid` de `make:user`, pour un identifiant `Uuid`/`Ulid` plutôt qu'un entier auto-incrémenté. *(§ The User)*

**Question 7 : B** — après génération de l'entité, il faut créer puis exécuter une migration Doctrine (`make:migration`, `doctrine:migrations:migrate`) pour que la table existe en base. *(§ The User)*

**Question 8 : C** — « the `make:user` command also adds config for a user provider in your security configuration » — un user provider charge (et recharge) les utilisateurs depuis un stockage à partir d'un « user identifier ». *(§ Loading the User: The User Provider)*

**Question 9 : A, B** — « A user provider (…) is used in a few different places "behind the scenes": (1) The system uses the user provider to reload the user (…) at the start of every request (…) (2) (…) uses the correct user provider (…) when a user submits their username and password » *(§ Loading the User: The User Provider)*

**Question 10 : A, B** — les quatre providers intégrés : Entity, LDAP, Memory, Chain. *(§ Loading the User: The User Provider)*

**Question 11 : C** — « Each firewall has exactly one user provider (…) But what if you want to specify a few providers (…)? You can do this by creating a "chain provider" » *(§ Loading the User: The User Provider)*

**Question 12 : D** — le service généré pour chaque provider suit le format `security.user.provider.concrete.<provider-name>`. *(§ Loading the User: The User Provider)*

**Question 13 : D** — en type-hintant `UserProviderInterface`, autowiré automatiquement quand une seule provider existe. *(§ Loading the User: The User Provider)*

**Question 14 : D** — la classe User doit implémenter `PasswordAuthenticatedUserInterface` pour bénéficier du hashing de mot de passe. *(§ Encoding the Password)*

**Question 15 : B** — l'option `'auto'` de `password_hashers` sélectionne automatiquement le meilleur algorithme disponible. *(§ Encoding the Password)*

**Question 16 : B** — le service `UserPasswordHasherInterface`, via sa méthode `hashPassword()`. *(§ Encoding the Password)*

**Question 17 : D** — le repository de l'entité User doit implémenter `PasswordUpgraderInterface` pour bénéficier de la migration automatique. *(§ Encoding the Password)*

**Question 18 : C** — le bundle `symfonycasts/verify-email-bundle`, combiné à la commande `make:registration-form`. *(§ Encoding the Password)*

**Question 19 : C** — la commande `security:hash-password`, pour hasher un mot de passe manuellement depuis la console. *(§ Encoding the Password)*

**Question 20 : B** — le firewall définit le système d'authentification : quelles parties de l'application sont sécurisées et comment les utilisateurs peuvent s'authentifier. *(§ The Firewall)*

**Question 21 : D** — un firewall sans `pattern` correspond à toutes les URLs ; l'ordre de déclaration des firewalls est important, ce firewall catch-all devant être placé en dernier. *(§ The Firewall)*

**Question 22 : D** — le firewall `dev` (pattern `^/(_(profiler|wdt)|css|images|js)/`, `security: false`) garantit que les outils de développement et les assets ne sont jamais bloqués. *(§ The Firewall)*

**Question 23 : D** — `lazy: true` évite de démarrer la session sans besoin explicite d'autorisation, gardant ainsi les requêtes cacheables. *(§ The Firewall)*

**Question 24 : B** — en passant un tableau de regex plus simples à l'option `pattern`. *(§ The Firewall)*

**Question 25 : B** — en injectant le service `Security` et en appelant `getFirewallConfig($request)`. *(§ The Firewall)*

**Question 26 : A, B, C** — Form Login, JSON Login, HTTP Basic, Login Link, X.509 Client Certificates et Remote Users sont tous des authenticators intégrés au SecurityBundle. *(§ Authenticating Users)*

**Question 27 : D** — la commande `make:security:form-login` génère automatiquement contrôleur, template et configuration. *(§ Form Login — Learn more)*

**Question 28 : D** — la clé `form_login`, avec les options `login_path` et `check_path`. *(§ Form Login — Learn more)*

**Question 29 : C** — un visiteur non authentifié est redirigé vers le `login_path` configuré. *(§ Form Login — Learn more)*

**Question 30 : B** — la classe `AuthenticationUtils`, dont les méthodes récupèrent la dernière erreur et le dernier nom d'utilisateur saisi. *(§ Form Login — Learn more)*

**Question 31 : D** — `error.message` peut contenir des informations sensibles ; il faut afficher `error.messageKey` (avec `error.messageData`), toujours sûr. *(§ Form Login — Learn more)*

**Question 32 : B** — les champs `_username` et `_password`, par convention. *(§ Form Login — Learn more)*

**Question 33 : D** — le formulaire de connexion basique de l'exemple n'est pas protégé contre les attaques CSRF par défaut. *(§ Form Login — Learn more)*

**Question 34 : C** — via `form_login.enable_csrf: true` ; champ caché `_csrf_token`, valeur générée à partir de la chaîne `authenticate`. *(§ CSRF Protection in Login Forms)*

**Question 35 : B** — les options `csrf_parameter` et `csrf_token_id`. *(§ CSRF Protection in Login Forms)*

**Question 36 : D** — l'option `json_login`, avec `check_path`. *(§ JSON Login)*

**Question 37 : C** — une requête POST avec `Content-Type: application/json` et un corps contenant `username`/`password`. *(§ JSON Login)*

**Question 38 : C** — une réponse JSON HTTP 401 Unauthorized. *(§ JSON Login)*

**Question 39 : C** — « The `#[CurrentUser]` can only be used in controller arguments to retrieve the authenticated user. In services, you would use `Security::getUser()`. » *(§ JSON Login)*

**Question 40 : D** — la clé `http_basic`, avec une option `realm` optionnelle. *(§ HTTP Basic)*

**Question 41 : C** — le log out ne fonctionne pas avec HTTP Basic, le navigateur renvoyant les identifiants à chaque requête. *(§ HTTP Basic)*

**Question 42 : C** — les login links sont un mécanisme sans mot de passe : un lien à courte durée de vie authentifie l'utilisateur. *(§ Login Link)*

**Question 43 : B** — le serveur web effectue réellement l'authentification ; l'authenticator Symfony extrait l'email du certificat client. *(§ X.509 Client Certificates)*

**Question 44 : B** — d'abord via `SSL_CLIENT_S_DN_Email` (Apache), sinon via `SSL_CLIENT_S_DN` en cherchant la valeur après `emailAddress`. *(§ X.509 Client Certificates)*

**Question 45 : D** — via la variable d'environnement `REMOTE_USER`, exposée par des modules serveur comme Kerberos. *(§ Remote Users)*

**Question 46 : D** — la protection contre les attaques par force brute repose sur le composant RateLimiter. *(§ Limiting Login Attempts)*

**Question 47 : B** — 5 tentatives par minute par défaut (`max_attempts`). *(§ Limiting Login Attempts)*

**Question 48 : B** — une limite de `5 * max_attempts` par IP seule, pour empêcher un attaquant utilisant plusieurs noms d'utilisateur de contourner la première limite. *(§ Limiting Login Attempts)*

**Question 49 : D** — en créant une classe implémentant `RequestRateLimiterInterface` (ou en étendant `DefaultLoginRateLimiter`), référencée via l'option `limiter`. *(§ Limiting Login Attempts)*

**Question 50 : C** — dans le cache de Symfony par défaut, avec possibilité de configurer le pool ou un stockage personnalisé. *(§ Limiting Login Attempts)*

**Question 51 : A, B** — « use a specific cache pool for storing limiter state: `cache_pool: 'cache.rate_limiter'` (…) or use a custom storage service (takes precedence over cache_pool): `storage_service: 'app.my_custom_storage'` » *(§ Limiting Login Attempts)*

**Question 52 : D** — en implémentant `AuthenticationSuccessHandlerInterface` ou `AuthenticationFailureHandlerInterface`. *(§ Limiting Login Attempts)*

**Question 53 : C** — « You can log in a user programmatically using the `login()` method of the `Symfony\Bundle\SecurityBundle\Security` helper » *(§ Login Programmatically)*

**Question 54 : D** — « use the redirection logic applied to regular login: `$redirectResponse = $security->login($user);` » — une `RedirectResponse`. *(§ Login Programmatically)*

**Question 55 : C** — « if the firewall has more than one authenticator, you must pass it explicitly (…) by using the name of built-in authenticators (…) or the service id of custom authenticators » *(§ Login Programmatically)*

**Question 56 : C** — la clé `logout`, avec une option `path` (et optionnellement `target`). *(§ Logging Out)*

**Question 57 : C** — « If you need to reference the logout path, you can use the `_logout_<firewallname>` route name (e.g. `_logout_main`). » *(§ Logging Out)*

**Question 58 : D** — le loader `security.route_loader.logout`, en tant que ressource de type `service`, à importer manuellement dans les routes. *(§ Logging Out)*

**Question 59 : C** — « you can also disable the CSRF protection: `$response = $security->logout(false);` » *(§ Logging Out)*

**Question 60 : C** — « The user will be logged out from the firewall of the request. If the request is not behind a firewall a `\LogicException` will be thrown. » *(§ Logging Out)*

**Question 61 : C** — « During logout, a `Symfony\Component\Security\Http\Event\LogoutEvent` is dispatched. » *(§ Logging Out)*

**Question 62 : C** — en configurant `path` avec un nom de route déclarée soi-même (avec des chemins différents par locale). *(§ Logging Out)*

**Question 63 : C** — l'attribut `#[CurrentUser]`, sur un argument de méthode de contrôleur. *(§ Retrieving the User Object)*

**Question 64 : B** — « Make the argument nullable to allow anonymous access, or non-nullable to automatically deny access when no user is authenticated (Symfony will throw a `403` error). » *(§ Retrieving the User Object)*

**Question 65 : A, B, C** — « `#[CurrentUser]` is preferred because it provides proper type-hinting without a `@var` annotation, works in any controller (not only those extending `AbstractController`), and makes the dependency on the authenticated user explicit in the method signature » *(§ Retrieving the User Object)*

**Question 66 : B** — en injectant le service `Security` et en appelant `getUser()`. *(§ Retrieving the User Object)*

**Question 67 : B** — `app.user`, disponible dans tout template Twig. *(§ Retrieving the User Object)*

**Question 68 : C** — oui, une union de types est possible, ex. `#[CurrentUser] Admin|Customer|User $user`. *(§ Retrieving the User Object)*

**Question 69 : D** — « When a user logs in, Symfony calls the `getRoles()` method on your `User` object to determine which roles this user has. » *(§ Roles)*

**Question 70 : B** — « The only rule is that every role **must start with** the `ROLE_` prefix - otherwise, things won't work as expected. » *(§ Roles)*

**Question 71 : B** — l'option `role_hierarchy` de la configuration `security`. *(§ Hierarchical Roles)*

**Question 72 : B** — « For role hierarchy to work, do not use `$user->getRoles()` manually. (…) `$user->getRoles()` will not know about the role hierarchy » *(§ Hierarchical Roles)*

**Question 73 : C** — « The `role_hierarchy` values are static - you can't, for example, store the role hierarchy in a database. If you need that, create a custom security voter » *(§ Hierarchical Roles)*

**Question 74 : D** — « install the free and open-source Mermaid CLI, which provides the `mmdc` command, and then run: `$ php bin/console debug:security:role-hierarchy | mmdc -o roles.svg` » *(§ Hierarchical Roles)*

**Question 75 : C** — via `access_control` dans `security.yaml` (simple mais moins flexible) ou directement dans le contrôleur. *(§ Add Code to Deny Access)*

**Question 76 : B** — `access_control: [{ path: '^/admin', roles: ROLE_ADMIN }]`. *(§ Securing by Pattern)*

**Question 77 : B** — « only the **first** matching `access_control` is used » — la première règle correspondante, dans l'ordre de la liste. *(§ Securing by Pattern)*

**Question 78 : D** — avec `^`, seules les URLs commençant par le motif correspondent ; sans lui, un chemin comme `/foo/admin` correspondrait aussi. *(§ Securing by Pattern)*

**Question 79 : D** — via `denyAccessUnlessGranted('ROLE_ADMIN')` ; si l'utilisateur n'est pas connecté, il est invité à se connecter, sinon la page 403 s'affiche. *(§ Securing Controllers and other Code)*

**Question 80 : B** — `#[IsGranted('ROLE_ADMIN')]`, utilisable sur la classe ou une méthode du contrôleur. *(§ Securing Controllers and other Code)*

**Question 81 : D** — en passant le nom de l'argument du contrôleur en second paramètre, ex. `#[IsGranted('edit', 'post')]`. *(§ Securing Controllers and other Code)*

**Question 82 : D** — via l'argument `statusCode` de l'attribut `#[IsGranted]`. *(§ Securing Controllers and other Code)*

**Question 83 : D** — oui, via l'argument `exceptionCode` de l'attribut. *(§ Securing Controllers and other Code)*

**Question 84 : D** — oui, en créant une classe qui étend `IsGranted` et appelle `parent::__construct('ROLE_ADMIN')`. *(§ Securing Controllers and other Code)*

**Question 85 : D** — via l'argument `methods`, acceptant une chaîne ou un tableau de méthodes HTTP. *(§ Securing Controllers and other Code)*

**Question 86 : C** — la fonction Twig `is_granted('ROLE_ADMIN')`. *(§ Access Control in Templates)*

**Question 87 : D** — `is_granted_for_user(user, 'ROLE_ADMIN')`, pour un utilisateur précis différent de l'utilisateur courant. *(§ Access Control in Templates)*

**Question 88 : C** — `access_decision()` et `access_decision_for_user()` vérifient l'autorisation tout en récupérant les raisons du refus données par les voters personnalisés. *(§ Access Control in Templates)*

**Question 89 : B** — en injectant le service `Security` et en appelant `isGranted()`. *(§ Access Control in Services)*

**Question 90 : D** — `isGrantedForUser()` pour un utilisateur différent de l'utilisateur courant, ou quand la session n'est pas disponible (ex. CLI). *(§ Access Control in Services)*

**Question 91 : D** — `AuthorizationCheckerInterface`, l'interface de plus bas niveau. *(§ Access Control in Services)*

**Question 92 : D** — l'attribut spécial `PUBLIC_ACCESS`, utilisable dans `access_control` pour autoriser l'accès anonyme. *(§ Access Control)*

**Question 93 : C** — en vérifiant que `$token->getUser()` n'est pas une instance de `UserInterface`. *(§ Granting Anonymous Users Access in a Custom Voter)*

**Question 94 : D** — l'attribut spécial `IS_AUTHENTICATED`, qui vérifie simplement que l'utilisateur est connecté. *(§ Access Control)*

**Question 95 : B** — « Users who are logged in only because of a "remember me cookie" will have `IS_AUTHENTICATED_REMEMBERED` but will not have `IS_AUTHENTICATED_FULLY`. » *(§ Access Control)*

**Question 96 : C** — « `IS_IMPERSONATOR`: When the current user is impersonating another user in this session, this attribute will match. » *(§ Access Control)*

**Question 97 : B** — « At the end of every request (unless your firewall is `stateless`), your `User` object is serialized to the session. » ; au début de la requête suivante, il est désérialisé puis « rafraîchi ». *(§ Understanding how Users are Refreshed from the Session)*

**Question 98 : D** — la comparaison par défaut repose sur `getPassword()`, `getSalt()` et `getUserIdentifier()`. *(§ Understanding how Users are Refreshed from the Session)*

**Question 99 : A, B** — « Two strategies are supported: (1) Remove the password completely. (…) Use this only if you store plaintext passwords (not recommended). (2) Hash the password using the `crc32c` algorithm. » *(§ Understanding how Users are Refreshed from the Session)*

**Question 100 : C** — en implémentant `EquatableInterface` et sa méthode `isEqualTo()`. *(§ Comparing Users Manually with EquatableInterface)*

**Question 101 : B** — « Every Security firewall has its own event dispatcher (`security.event_dispatcher.FIREWALLNAME`). Events are dispatched on both the global and the firewall-specific dispatcher. » *(§ Security Events)*

**Question 102 : B** — « `CheckPassportEvent` — Dispatched after the authenticator created the security passport. Listeners of this event do the actual authentication checks » *(§ Security Events)*

**Question 103 : D** — « `AuthenticationSuccessEvent` — Dispatched when authentication is nearing success. This is the last event that can make an authentication fail by throwing an `AuthenticationException`. » *(§ Security Events)*

**Question 104 : C** — « `LoginSuccessEvent` — Dispatched after authentication was fully successful. Listeners to this event can modify the response sent back to the user. » *(§ Security Events)*

**Question 105 : C** — « `InteractiveLoginEvent` — Dispatched (…) only when the authenticator implements `InteractiveAuthenticatorInterface`, which indicates login requires explicit user action » *(§ Security Events)*

**Question 106 : B** — « `TokenDeauthenticatedEvent` — Dispatched when a user is deauthenticated, for instance because the password was changed. » *(§ Security Events)*

**Question 107 : B** — « Yes! However, each firewall is like a separate security system: being authenticated in one firewall doesn't make you authenticated in another one. (…) If you want to share authentication between firewalls, you have to explicitly specify the same context » *(§ FAQ)*

**Question 108 : D** — « As routing is done *before* security, 404 error pages are not covered by any firewall. » *(§ FAQ)*

**Question 109 : B** — « `password_hashers: App\Entity\User: 'auto'` » — associer la classe (ou une interface qu'elle implémente) à un algorithme. *(Passwords — § Configuration)*

**Question 110 : B** — « In tests however, secure hashes are not important, so you can change the password hasher configuration in `test` environment to run tests faster » *(Passwords — § Configuration)*

**Question 111 : B** — « `#[Target('recovery_code')] private readonly PasswordHasherInterface $passwordHasher` » *(Passwords — § Hashing Passwords not Linked to a User Class)*

**Question 112 : C** — « Note: use `hash()`, not `hashPassword()`, as we are not using a `UserInterface` object » *(Passwords — § Hashing Passwords not Linked to a User Class)*

**Question 113 : B** — « Set the `migrate_from` option on the new hasher to point to the old, legacy hasher(s) » *(Passwords — § Password Migration)*

**Question 114 : D** — « The *auto*, *native*, *bcrypt* and *argon* hashers automatically enable password migration using the following list of `migrate_from` algorithms: PBKDF2 (…); Message digest (…) » *(Passwords — § Password Migration)*

**Question 115 : B** — en implémentant `PasswordUpgraderInterface` dans le `UserRepository`, avec sa méthode `upgradePassword()`. *(Passwords — § Upgrade the Password when using Doctrine)*

**Question 116 : B** — « you can trigger the password migration by returning `true` in the `needsRehash()` method » *(Passwords — § Password Migration)*

**Question 117 : B** — en définissant un hasher nommé et en implémentant `PasswordHasherAwareInterface::getPasswordHasherName()` sur la classe User. *(Passwords — § Hashers with a Named Configuration)*

**Question 118 : C** — « When migrating passwords, you don't need to implement `PasswordHasherAwareInterface` to return the legacy hasher name: Symfony will detect it from your `migrate_from` configuration. » *(Passwords — § Hashers with a Named Configuration)*

**Question 119 : D** — via `PasswordHasherFactory`, permettant de déclarer plusieurs hashers nommés récupérables via `getPasswordHasher()`. *(Passwords — § Hashing a Stand-Alone String)*

**Question 120 : B** — « It produces hashed passwords with the bcrypt password hashing function. Hashed passwords are `60` characters long, so make sure to allocate enough space » — l'algorithme actuel du hasher `auto`. *(Passwords — § The Bcrypt Password Hasher)*

**Question 121 : C** — « Its only configuration option is `cost`, which is an integer in the range of `4-31` (by default, `13`). Each single increment of the cost **doubles the time** it takes to hash a password. » *(Passwords — § The Bcrypt Password Hasher)*

**Question 122 : D** — « You can change the cost at any time — even if you already have some passwords hashed using a different cost. New passwords will be hashed using the new (cost) » *(Passwords — § The Bcrypt Password Hasher)*

**Question 123 : D** — « It uses the Argon2 key derivation function. Argon2 support is available in PHP via the bundled `libsodium` extension. » *(Passwords — § The Sodium Password Hasher)*

**Question 124 : D** — « Using the PBKDF2 hasher is no longer recommended since PHP added support for Sodium and BCrypt. » *(Passwords — § The PBKDF2 Hasher)*

**Question 125 : B** — « The implementations of `hash` and `verify` **must validate that the password length is no longer than 4096 characters.** This is for security reasons (see CVE-2013-5750). » *(Passwords — § Creating a custom Password Hasher)*

**Question 126 : B** — « You can use the `CheckPasswordLengthTrait::isPasswordTooLong` method for this check. » *(Passwords — § Creating a custom Password Hasher)*

**Question 127 : D** — « `$ composer require symfony/ldap` » *(LDAP — § Authenticating against an LDAP server)*

**Question 128 : A, B, C** — « The `ldap` user provider (…) The `form_login_ldap` authentication provider (…) The `http_basic_ldap` authentication provider » *(LDAP — § Authenticating against an LDAP server)*

**Question 129 : B** — « `search_dn` — This is your read-only user's DN, which will be used to authenticate against the LDAP server to fetch the user's information. » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 130 : B** — « `default_roles` — This is the default role you wish to give to a user fetched from the LDAP server. If you do not configure this key, your users won't have any roles, and will not be considered as authenticated fully. » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 131 : C** — « `uid_key` — If you pass `null` as the value of this option, the default UID key is used `sAMAccountName`. » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 132 : D** — « `role_fetcher` (…) allows you to define the service that retrieves these roles (…) Symfony provides `Symfony\Component\Ldap\Security\MemberOfRoles` (…) that fetches roles from the `ismemberof` attribute » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 133 : B** — « When this option is set, the `default_roles` option is ignored. » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 134 : B** — « `filter` — This key lets you configure which LDAP query will be used. (…) If you pass `null` (…) the default filter is used `({uid_key}={user_identifier})`. » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 135 : D** — « The Security component escapes provided input data when the LDAP user provider is used. However, the LDAP component itself does not provide any escaping yet. Thus, it's your responsibility to prevent LDAP injection » *(LDAP — § Fetching Users Using the LDAP User Provider)*

**Question 136 : B** — « `dn_string` (…) defines the form of the string used to compose the DN of the user, from the username. The `{user_identifier}` string is replaced by the actual username » *(LDAP — § Using LDAP for Login)*

**Question 137 : D** — « `query_string` — This (optional) key makes the user provider search for a user and then use the found DN for the bind process. This is useful when using multiple LDAP user providers with different `base_dn`. » *(LDAP — § Using LDAP for Login)*

**Question 138 : C** — « You can allow users to choose to stay logged in (…) using a cookie with the `remember_me` firewall option: `remember_me: secret: '%kernel.secret%'` » *(Remember Me — § How to Add "Remember Me" Login Functionality)*

**Question 139 : D** — « This checkbox must have a name of `_remember_me` » *(Remember Me — § How to Add "Remember Me" Login Functionality)*

**Question 140 : B** — « If you implement the login via an API that uses JSON Login you can add a `_remember_me` key to the body of your POST request. » *(Remember Me — § Remember Me for JSON Login)*

**Question 141 : C** — « uncomment the following line to always enable it: `#always_remember_me: true` » *(Remember Me — § How to Add "Remember Me" Login Functionality)*

**Question 142 : B** — « Not all authentication methods support remember me (e.g. HTTP Basic authentication doesn't have support). An authenticator indicates support using a `RememberMeBadge` (…) Without this badge, remember me will not be activated (regardless of all other settings). » *(Remember Me — § Add Remember Me Support to Custom Authenticators)*

**Question 143 : A, B** — « Symfony provides two ways to validate remember me tokens: Signature based tokens (…) if the properties change, the signature changes and already generated tokens are no longer considered valid (…) Persistent tokens (…) store any generated token (e.g. in a database). This allows you to invalidate tokens by changing the rows in the database. » *(Remember Me — § Customize how Remember Me Tokens are Stored)*

**Question 144 : C** — « These properties are always included in the hash: The user identifier (…) The expiration timestamp. » *(Remember Me — § Using Signed Remember Me Tokens)*

**Question 145 : D** — « you can configure custom properties using the `signature_properties` setting (defaults to `password`). » *(Remember Me — § Using Signed Remember Me Tokens)*

**Question 146 : B** — « `remember_me: token_provider: doctrine: true` » — active le stockage des tokens en base de données. *(Remember Me — § Storing Remember Me Tokens in the Database)*

**Question 147 : C** — « You can also create a custom token provider by creating a class that implements `TokenProviderInterface`. Then, configure the service ID of your custom token provider as `service` » *(Remember Me — § Customize how Remember Me Tokens are Stored)*

**Question 148 : D** — « require the user to log in during *this* session (…) `$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');` » *(Remember Me — § Forcing the User to Re-authenticate)*

**Question 149 : B** — « There is also a `IS_REMEMBERED` attribute that grants access *only* when the user is authenticated via the remember me mechanism. » *(Remember Me — § Forcing the User to Re-authenticate)*

**Question 150 : B** — « If you enable the `remember_me` feature in several firewalls of the same application, make sure to choose a different name for the cookie of each firewall. Otherwise, you'll face lots of security related problems. » *(Remember Me — § Customizing the Remember Me Cookie)*

**Question 151 : B** — « `lifetime` (default value: `31536000` i.e. 1 year in seconds) » *(Remember Me — § Customizing the Remember Me Cookie)*

**Question 152 : B** — « Impersonating the user can be done by activating the `switch_user` firewall listener » *(Impersonating User — § How to Impersonate a User)*

**Question 153 : B** — « To switch to another user, add a query string with the `_switch_user` parameter and the username (…) as the value to the current URL: `http://example.com/somewhere?_switch_user=thomas` » *(Impersonating User — § How to Impersonate a User)*

**Question 154 : D** — « To switch back to the original user, use the special `_exit` username: `http://example.com/somewhere?_switch_user=_exit` » *(Impersonating User — § How to Impersonate a User)*

**Question 155 : D** — « This feature is only available to users with a special role called `ROLE_ALLOWED_TO_SWITCH`. » *(Impersonating User — § How to Impersonate a User)*

**Question 156 : B** — « When a user is impersonated the token stored in the token storage will be a `SwitchUserToken` instance. (…) `$impersonatorUser = $token->getOriginalToken()->getUser();` » *(Impersonating User — § Knowing When Impersonation Is Active)*

**Question 157 : B** — « The name of this role can be modified via the `role` setting. You can also adjust the query parameter name via the `parameter` setting » *(Impersonating User — § Controlling the Query Parameter)*

**Question 158 : B** — « This feature allows you to control the redirection target route via `target_route`. » — précédé de l'avertissement « It works only in a stateful firewall. » *(Impersonating User — § Controlling the Query Parameter)*

**Question 159 : C** — « configure `switch_user` to check for some new, custom attribute. This can be anything, but *cannot* start with `ROLE_` (to enforce that only your voter will (…) grant it) » *(Impersonating User — § Limiting User Switching)*

**Question 160 : D** — « configure `switch_user` with a chain user provider that includes both the impersonator's provider and the impersonated user's provider (…) The chain provider `all_users` allows the `switch_user` listener to load both admin users (…) and regular users » *(Impersonating User — § Impersonating for Multiple User Providers)*

**Question 161 : C** — « The `security.switch_user` event is dispatched just before the impersonation is fully completed. (…) receive a `SwitchUserEvent` (…) This event is also dispatched just before impersonation is fully exited. » *(Impersonating User — § Events)*

**Question 162 : C** — « User impersonation is not compatible with some authentication mechanisms (e.g. `REMOTE_USER`) where the authentication information is expected to be sent on each request. » *(Impersonating User — § How to Impersonate a User)*

**Question 163 : D** — « User checkers are classes that must implement the `UserCheckerInterface`. This interface defines two methods called `checkPreAuth()` and `checkPostAuth()` to perform checks before and after user authentication. » *(User Checkers — § Creating a Custom User Checker)*

**Question 164 : C** — « throw an exception which extends the `AccountStatusException` class. Consider using `CustomUserMessageAccountStatusException`, which extends `AccountStatusException` and allows you to customize the error message displayed to the user » *(User Checkers — § Creating a Custom User Checker)*

**Question 165 : C** — « add the checker to the desired firewall where the value is the service id of your user checker: `user_checker: App\Security\UserChecker` » *(User Checkers — § Enabling the Custom User Checker)*

**Question 166 : C** — « tag your user checker services with the `security.user_checker.<firewall>` tag (…) The service tag also supports the priority attribute (…) configure your firewalls to use the `security.user_checker.chain.<firewall>` service » *(User Checkers — § Using Multiple User Checkers)*

**Question 167 : B** — « This is the default restriction and restricts a firewall to only be initialized if the request path matches the configured `pattern`. » *(Firewall Restriction — § Restricting by Path)*

**Question 168 : B** — « the request can also be matched against `host`. When the configuration option `host` is set, the firewall will be restricted to only initialize if the host from the request matches against the configuration. » *(Firewall Restriction — § Restricting by Host)*

**Question 169 : B** — « The configuration option `methods` restricts the initialization of the firewall to the provided HTTP methods. » *(Firewall Restriction — § Restricting by HTTP Methods)*

**Question 170 : D** — « You can use any of the following restrictions individually or mix them together to get your desired firewall configuration. » *(Firewall Restriction — § Restricting by Configuration)*

**Question 171 : D** — « If the above options don't fit your needs you can configure any service implementing `RequestMatcherInterface` as `request_matcher`. » *(Firewall Restriction — § Restricting by Service)*

**Question 172 : C** — « The last firewall can be configured without any matcher to handle every incoming request. » *(Firewall Restriction — § How to Restrict Firewalls to a Request)*

**Question 173 : D** — « You can use any of the following restrictions individually or mix them together » *(Firewall Restriction — § Restricting by Configuration)*

**Question 174 : D** — « The attack is based on the trust that a web application has in a user's browser (e.g. on session cookies). » *(CSRF — § How to Implement CSRF Protection)*

**Question 175 : A, B** — « Anti-CSRF tokens can be managed in two ways: using a **stateful** approach, where tokens are stored in the session and are unique per user and action; or a **stateless** approach, where tokens are generated on the client side. » *(CSRF — § How to Implement CSRF Protection)*

**Question 176 : D** — « `$ composer require symfony/security-csrf` » *(CSRF — § Installation)*

**Question 177 : C** — « By default, the tokens used for CSRF protection are stored in the session. That's why a session is started automatically as soon as you render a form with CSRF protection. » *(CSRF — § Installation)*

**Question 178 : D** — « CSRF protection is only required for **state-changing operations**, which must not use `GET` requests (as per the HTTP specification). » *(CSRF — § CSRF Protection in Symfony Forms)*

**Question 179 : B** — « Globally, you can configure it under the `framework.form` option: `form: csrf_protection: field_name: 'custom_token_name'` » *(CSRF — § CSRF Protection in Symfony Forms)*

**Question 180 : C** — « `'csrf_field_name' => 'custom_token_name', (…) 'csrf_token_id' => 'task_item',` » dans `configureOptions()`. *(CSRF — § CSRF Protection in Symfony Forms)*

**Question 181 : B** — « use the `csrf_token()` Twig function to generate a CSRF token (…) use the `isCsrfTokenValid` method to check its validity, passing the same token ID used in the template » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 182 : D** — « you can use the `IsCsrfTokenValid` attribute on the controller action: `#[IsCsrfTokenValid('delete-item', tokenKey: 'token')]` » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 183 : C** — « This attribute can also be applied to a controller class. When used this way, the CSRF token validation will be applied to **all actions** defined in that controller. » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 184 : C** — « The `IsCsrfTokenValid` attribute also accepts an `Expression` object evaluated to the id: `#[IsCsrfTokenValid(new Expression('"delete-item-" ~ args["post"].getId()'), tokenKey: 'token')]` » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 185 : B** — « You can restrict this validation to specific methods using the `methods` parameter. If the request uses a method not listed in the `methods` array, the attribute is ignored for that request, and no CSRF validation occurs » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 186 : A, B, C** — « `IsCsrfTokenValid::SOURCE_PAYLOAD` (default) (…) `IsCsrfTokenValid::SOURCE_QUERY` (…) `IsCsrfTokenValid::SOURCE_HEADER` » *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 187 : C** — « To mitigate these attacks, and prevent an attacker from guessing the CSRF tokens, a random mask is prepended to the token and used to scramble it. » *(CSRF — § CSRF Tokens and Compression Side-Channel Attacks)*

**Question 188 : B** — « some token IDs can be declared as stateless using the `stateless_token_ids` option. Stateless CSRF tokens are enabled by default in applications using Symfony Flex. » *(CSRF — § Stateless CSRF Tokens)*

**Question 189 : C** — « Stateless CSRF tokens provide protection without relying on the session. This allows you to fully cache pages while still protecting against CSRF attacks. » *(CSRF — § Stateless CSRF Tokens)*

**Question 190 : D** — « When validating a stateless CSRF token, Symfony checks the `Origin` and `Referer` headers of the incoming HTTP request. » *(CSRF — § Stateless CSRF Tokens)*

**Question 191 : B** — « the `authenticate` and `logout` identifiers are listed because they are used by default in the Symfony Security component. » *(CSRF — § Using a Default Token ID)*

**Question 192 : D** — « The `submit` identifier is included so that form types defined by the application can also use CSRF protection by default. (…) `form: csrf_protection: token_id: 'submit'` » *(CSRF — § Using a Default Token ID)*

**Question 193 : B** — « stateless CSRF protection can also validate tokens using a cookie and a header (…) This "double-submit" protection relies on the browser's same-origin policy » *(CSRF — § Generating CSRF Token Using Javascript)*

**Question 194 : B** — « generating a new token for each submission (to prevent cookie fixation); using `samesite=strict` and `__Host-` cookie attributes (to enforce HTTPS and limit the cookie to the current domain). » *(CSRF — § Generating CSRF Token Using Javascript)*

**Question 195 : D** — « Enforcing "double-submit" validation on all requests is not recommended, as it may lead to a broken user experience. The opportunistic approach described above is preferred » *(CSRF — § Generating CSRF Token Using Javascript)*

**Question 196 : B** — « By default, the form will redirect to the URL the user requested (…) If no URL is present in the session (…) then the user is redirected to `/` (i.e. the homepage). » *(Form Login — § Redirecting after Success)*

**Question 197 : D** — « Define the `default_target_path` option to change the page where the user is redirected to if no previous page was stored in the session. » *(Form Login — § Changing the default Page)*

**Question 198 : D** — « Define the `always_use_default_target_path` boolean option to ignore the previously requested URL and always redirect to the default page » *(Form Login — § Always Redirect to the default Page)*

**Question 199 : D** — « The URL to redirect to after the login can be dynamically defined using the `_target_path` parameter of the GET or POST request. » *(Form Login — § Control the Redirect Using Request Parameters)*

**Question 200 : B** — « Its value must be a relative or absolute URL, not a Symfony route name. » *(Form Login — § Control the Redirect Using Request Parameters)*

**Question 201 : B** — « you may use the value of the `HTTP_REFERER` header instead (…) Define the `use_referer` boolean option to enable this behavior (…) The referrer URL is only used when it is different from the URL generated by the `login_path` route to avoid a redirection loop. » *(Form Login — § Using the Referring URL)*

**Question 202 : C** — « Use the `failure_path` option to define a new target via a relative/absolute URL or a Symfony route name » *(Form Login — § Redirecting on Failure)*

**Question 203 : C** — « The name of the request attributes used to define the success and failure login redirects can be customized using the `target_path_parameter` and `failure_path_parameter` options » *(Form Login — § Customizing the Target and Failure Request Parameters)*

**Question 204 : B** — « `$ php bin/console make:security:custom` » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 205 : B** — « Authenticators must implement the `AuthenticatorInterface`. You can also extend `AbstractAuthenticator`, which provides a default implementation of the `createToken()` method suitable for most use cases. » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 206 : B** — « If your custom authenticator is a login form, consider extending `AbstractLoginFormAuthenticator` to simplify your implementation. » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 207 : B** — « Custom authenticators must be explicitly enabled in the security configuration using the `custom_authenticators` setting of your firewall(s). » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 208 : B** — « Called on every request to decide if this authenticator should be used for the request. Returning `false` will cause this authenticator to be skipped. » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 209 : D** — « Its job is to extract credentials (…) from the `Request` object and transform these into a security `Passport` » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 210 : B** — « If `null` is returned, the current request will continue (and the user will be authenticated). This is useful for API routes where each route is protected by an API key header. » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 211 : B** — « If `null` is returned, the request continues (but the user will **not** be authenticated). This is useful for login forms, where the login controller is run again with the login errors. » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 212 : D** — « **Caution**: Never use `$exception->getMessage()` for `AuthenticationException` instances. This message might contain sensitive information (…) Instead, use `$exception->getMessageKey()` and `$exception->getMessageData()` » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 213 : D** — « you can check if `$exception` is an instance of `TooManyLoginAttemptsAuthenticationException` (e.g. to display an appropriate message). » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 214 : C** — « If your login method is interactive, which means that the user actively logged into your application, you may want your authenticator to implement the `InteractiveAuthenticatorInterface` so that it dispatches an `InteractiveLoginEvent` » *(Custom Authenticator — § How to Create a Custom Authenticator)*

**Question 215 : C** — « A passport is an object that contains the user that will be authenticated as well as other pieces of information, like whether a password should be checked or if "remember me" functionality should be enabled. » *(Custom Authenticator — § Security Passports)*

**Question 216 : D** — « Use the `UserBadge` to attach the user to the passport. The `UserBadge` requires a user identifier (e.g. the username or email) » *(Custom Authenticator — § Security Passports)*

**Question 217 : C** — « The maximum length allowed for the user identifier is 4096 characters to prevent session storage flooding attacks. » *(Custom Authenticator — § User Identifier)*

**Question 218 : D** — « You can optionally pass a user loader as second argument to the `UserBadge`. This callable receives the `$userIdentifier` and must return a `UserInterface` object (otherwise a `UserNotFoundException` is thrown) » *(Custom Authenticator — § User Identifier)*

**Question 219 : C** — « If needed, you can pass a normalizer as the third argument to `UserBadge`. This callable receives the `$userIdentifier` and must return a string. » — pour traiter "John.Doe" et "JOHN.DOE" comme équivalents. *(Custom Authenticator — § User Identifier)*

**Question 220 : B** — « `PasswordCredentials` — This requires a plaintext `$password`, which is validated using the password encoder configured for the user » *(Custom Authenticator — § User Credential)*

**Question 221 : D** — « `CustomCredentials` — Allows a custom closure to check credentials » *(Custom Authenticator — § User Credential)*

**Question 222 : D** — « If you don't need any credentials to be checked (e.g. when using API tokens), you can use the `SelfValidatingPassport`. » *(Custom Authenticator — § Self Validating Passport)*

**Question 223 : B** — « `RememberMeBadge` — When this badge is added to the passport, the authenticator indicates remember me is supported. » *(Custom Authenticator — § Passport Badges)*

**Question 224 : B** — « `PasswordUpgradeBadge` — This is used to automatically upgrade the password to a new hash upon successful login (…) The `PasswordUpgradeBadge` is automatically added to the passport if the passport has `PasswordCredentials`. » *(Custom Authenticator — § Passport Badges)*

**Question 225 : B** — « `PreAuthenticatedUserBadge` — Indicates that this user was pre-authenticated (i.e. before Symfony was initiated). This skips the pre-authentication user checker. » *(Custom Authenticator — § Passport Badges)*

**Question 226 : C** — « passports can define attributes (…) `$passport->setAttribute('scope', $oauthScope);` (…) `$passport->getAttribute('scope')` » *(Custom Authenticator — § Passport Attributes)*

**Question 227 : C** — « sometimes, one firewall has multiple ways to authenticate (e.g. both a form login and a social login). In these cases, it is required to configure the *authentication entry point*. » *(Entry Point — § The Entry Point: Helping Users Start Authentication)*

**Question 228 : C** — « `entry_point: form_login` » — configure la génération du formulaire comme point d'entrée. *(Entry Point — § The Entry Point: Helping Users Start Authentication)*

**Question 229 : D** — « You can also create your own authentication entry point by creating a class that implements `AuthenticationEntryPointInterface`. You can then set `entry_point` to the service id » *(Entry Point — § The Entry Point: Helping Users Start Authentication)*

**Question 230 : D** — « As you can only configure one entry point per firewall, the solution is to split the configuration into two separate firewalls » *(Entry Point — § Multiple Authenticators with Separate Entry Points)*

**Question 231 : B** — « `access_control: - { path: '^/login', roles: PUBLIC_ACCESS } - { path: '^/api', roles: ROLE_API_USER } - { path: '^/', roles: ROLE_USER }` » *(Entry Point — § Multiple Authenticators with Separate Entry Points)*

**Question 232 : D** — « However, there are use cases where you have authenticators that protect different parts of your application (…) As you can only configure one entry point per firewall » *(Entry Point — § Multiple Authenticators with Separate Entry Points)*

**Question 233 : D** — « All voters are called each time you use the `isGranted()` method on Symfony's authorization checker or call `denyAccessUnlessGranted()` in a controller (…) or by access controls. » *(Voters — § How to Use Voters to Check User Permissions)*

**Question 234 : D** — « A custom voter needs to implement `VoterInterface` or extend `Voter`, which makes creating a voter even easier » *(Voters — § The Voter Interface)*

**Question 235 : B** — « The Voter class also implements `CacheableVoterInterface` with methods used to improve voting performance thanks to caching. » *(Voters — § The Voter Interface)*

**Question 236 : C** — « `Voter::supports(string $attribute, mixed $subject)` — (…) Your job is to determine if your voter should vote on the attribute/subject combination. If you return true, `voteOnAttribute()` will be called. Otherwise, your voter is done » *(Voters — § Creating the Custom Voter)*

**Question 237 : B** — « The `$vote` argument can be used to provide an explanation for the vote. This explanation is included in log messages and on exception pages. » *(Voters — § Creating the Custom Voter)*

**Question 238 : C** — « Votes define an `$extraData` property that you can use to store any data that you might need later » *(Voters — § Creating the Custom Voter)*

**Question 239 : D** — « you must declare it as a service and tag it with `security.voter`. But if you're using the default services.yaml configuration, that's done automatically for you! » *(Voters — § Configuring the Voter)*

**Question 240 : D** — « That's possible by using an access decision manager inside your voter. (…) `if ($this->accessDecisionManager->decide($token, ['ROLE_SUPER_ADMIN']))` » *(Voters — § Checking for Roles inside a Voter)*

**Question 241 : C** — « The `Security::isGranted()` method inside a voter has a significant drawback: it does not guarantee that the checks are performed on the same token as the one in your voter. The token in the token storage might have changed » *(Voters — § Checking for Roles inside a Voter)*

**Question 242 : D** — « this method returns true if the voter applies to the given attribute; if it returns false, Symfony won't call it again for this attribute — `public function supportsAttribute(string $attribute): bool` » *(Voters — § Improving Voter Performance)*

**Question 243 : C** — « this method returns true if the voter applies to the given object class/type (…) `public function supportsType(string $subjectType): bool`  » *(Voters — § Improving Voter Performance)*

**Question 244 : C** — « you can't use a simple `Post::class === $subjectType` comparison because the subject type might be a Doctrine proxy class — `return is_a($subjectType, Post::class, true);` » *(Voters — § Improving Voter Performance)*

**Question 245 : D** — « By default, the `#[IsGranted]` attribute will throw an `AccessDeniedException` and return an http **403** status code with **Access Denied** as message. » *(Voters — § Changing the message and status code returned)*

**Question 246 : D** — « If the status code is different than 403, an `HttpException` will be thrown instead. » *(Voters — § Changing the message and status code returned)*

**Question 247 : C** — « `affirmative` (default) — This grants access as soon as there is *one* voter granting access » *(Voters — § Changing the Access Decision Strategy)*

**Question 248 : B** — « `consensus` — (…) In case of a tie the decision is based on the `allow_if_equal_granted_denied` config option (defaulting to `true`) » *(Voters — § Changing the Access Decision Strategy)*

**Question 249 : B** — « `unanimous` — This only grants access if there is no voter denying access. » *(Voters — § Changing the Access Decision Strategy)*

**Question 250 : C** — « Regardless the chosen strategy, if all voters abstained from voting, the decision is based on the `allow_if_all_abstain` config option (which defaults to `false`). » *(Voters — § Changing the Access Decision Strategy)*

**Question 251 : C** — « `access_decision_manager: strategy: unanimous` » *(Voters — § Changing the Access Decision Strategy)*

**Question 252 : C** — « If none of the built-in strategies fits your use case, define the `strategy_service` option to use a custom service (your service must implement the `AccessDecisionStrategyInterface`) » *(Voters — § Custom Access Decision Strategy)*

**Question 253 : D** — « If you need to provide an entirely custom access decision manager, define the `service` option to use a custom service as the Access Decision Manager (your service must implement the `AccessDecisionManagerInterface`) » *(Voters — § Custom Access Decision Manager)*

**Question 254 : B** — « `#[IsGranted('edit', 'post')]` — (…) the second argument is the name of the controller argument passed to the voter » *(Voters — § Setup: Checking for Access in a Controller)*

**Question 255 : D** — « if (!$user instanceof User) { // the user must be logged in; if not, deny access `$vote?->addReason('The user is not logged in.'); return false;` } » *(Voters — § Creating the Custom Voter)*

**Question 256 : C** — « if you don't reuse permissions or your rules are basic, you can always put that logic directly into your controller instead (…) `throw $this->createAccessDeniedException();` » *(Voters — § How to Use Voters to Check User Permissions)*

**Question 257 : B** — « For each incoming request, Symfony checks each `access_control` entry to find *one* that matches the current request. As soon as it finds a matching `access_control` entry, it stops - only the **first** matching `access_control` is used to enforce access. » *(Access Control — § How Does the Security access_control Work?)*

**Question 258 : C** — « Symfony uses `Symfony\Component\HttpFoundation\ChainRequestMatcher` for each `access_control` entry, which determines which implementation of `RequestMatcherInterface` should be used » *(Access Control — § 1. Matching Options)*

**Question 259 : C** — « The following `access_control` options are used for matching: `path` (…) `ip` or `ips` (…) `port` (…) `host` (…) `methods` (…) `request_matcher` (…) `attributes` (…) `route` » — `requires_channel` est une option d'*enforcement*, pas de matching. *(Access Control — § 1. Matching Options)*

**Question 260 : C** — « require ROLE_ADMIN for 'admin' route. You can use the shortcut "route: "xxx", instead of "attributes": ["_route": "xxx"] » *(Access Control — § 1. Matching Options)*

**Question 261 : D** — « if `ip`, `port`, `host` or `method` are not specified for an entry, that `access_control` will match any `ip`, `port`, `host` or `method`. » *(Access Control — § 1. Matching Options)*

**Question 262 : B** — « Example #4 (…) **Rule applied**: rule #3 (`ROLE_USER_HOST`) — **Why?** The `ip` doesn't match neither the first rule nor the second rule. So the third rule (which matches) is used. » *(Access Control — § 1. Matching Options)*

**Question 263 : C** — « Example #7 (…) **Rule applied**: matches no entries — **Why?** This doesn't match any `access_control` rules, since its URI doesn't match any of the `path` values. » *(Access Control — § 1. Matching Options)*

**Question 264 : B** — « Matching the URI is done without `$_GET` parameters. Deny access in PHP code if you want to disallow access based on `$_GET` parameter values. » *(Access Control — § 1. Matching Options)*

**Question 265 : D** — « Once Symfony has decided which `access_control` entry matches (if any), it then *enforces* access restrictions based on the `roles`, `allow_if` and `requires_channel` options » *(Access Control — § 2. Access Enforcement)*

**Question 266 : B** — « `roles` If the user does not have the given role, then access is denied (internally, an `AccessDeniedException` is thrown). » *(Access Control — § 2. Access Enforcement)*

**Question 267 : C** — « the array value of `roles` is passed as the `$attributes` argument to each voter in the application with the `Request` as `$subject`. » *(Access Control — § 2. Access Enforcement)*

**Question 268 : D** — « If you define both `roles` and `allow_if`, and your Access Decision Strategy is the default one (`affirmative`), then the user will be granted access if there's at least one valid condition. » *(Access Control — § 2. Access Enforcement)*

**Question 269 : D** — « If access is denied, the system will try to authenticate the user if not already (e.g. redirect the user to the login page). If the user is already logged in, the 403 "access denied" error page will be shown. » *(Access Control — § 2. Access Enforcement)*

**Question 270 : D** — « the `ips` option does not restrict to a specific IP address. Instead, using the `ips` key means that the `access_control` entry will only match this IP address, and users accessing it from a different IP address will continue down the `access_control` list. » *(Access Control — § Matching access_control By IP)*

**Question 271 : B** — « The first access control rule is ignored as the `path` matches but the IP address does not match either of the IPs listed; The second access control rule is enabled (…) and so it matches. If you make sure that no users ever have `ROLE_NO_ACCESS`, then access is denied » *(Access Control — § Matching access_control By IP)*

**Question 272 : B** — « Add the `port` option to any `access_control` entries to require users to access those URLs via a specific port. » *(Access Control — § Restrict to a port)*

**Question 273 : B** — « use the `requires_channel` argument in any `access_control` entries. If this `access_control` is matched and the request is using the `http` channel, the user will be redirected to `https` » *(Access Control — § Forcing a Channel (http, https))*

**Question 274 : D** — « Inside the expression, you have access to a number of different variables and functions including `request`, which is the Symfony `Request` object » *(Access Control — § Securing by an Expression)*

**Question 275 : B** — « In addition to security roles like `ROLE_ADMIN`, the `isGranted()` method and `#[IsGranted]` attribute also accept an `Expression` object » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 276 : D** — « The best solution for handling complex authorization rules is to use the Voter System. » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 277 : D** — « `user` — An instance of `UserInterface` that represents the current user or `null` if you're not authenticated. » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 278 : C** — « `role_names` — An array with the string representation of the roles the user has. This array includes any roles granted indirectly via the role hierarchy but it does not include the `IS_AUTHENTICATED_*` attributes » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 279 : D** — « `subject` — It stores the same value as `object`, so they are equivalent. » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 280 : D** — « `is_authenticated()` — Returns `true` if the user is authenticated via "remember-me" or authenticated "fully" - i.e. returns true if the user is "logged in". » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 281 : B** — « the `is_remember_me()` function *only* returns true if the user is authenticated via a remember-me cookie and `is_fully_authenticated()` *only* returns true if the user has actually logged in during this session » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 282 : B** — « `is_fully_authenticated()` — Equal to checking if the user has the `IS_AUTHENTICATED_FULLY` role. » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 283 : C** — « `is_granted()` — Checks if the user has the given permission. Optionally accepts a second argument with the object where permission is checked on. It's equivalent to using the `isGranted()` method » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 284 : C** — « Inside the subject's expression, you have access to two variables: `request` — The Symfony Request object (…) `args` — An array of controller arguments » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 285 : C** — « The subject may also be an array where the key can be used as an alias for the result of an expression » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 286 : D** — « the `#[IsGranted]` attribute also accepts closures that return a boolean value. » — signature `static function (IsGrantedContext $context, mixed $subject)`. *(Expressions — § Using Expressions in Security Access Controls)*

**Question 287 : C** — « The subject can also be a closure that returns an array of values that will be injected into the closure » *(Expressions — § Using Expressions in Security Access Controls)*

**Question 288 : D** — « In Symfony, you can throw an `AccessDeniedException` to disallow access to the user. Symfony will handle this exception and generates a response based on the authentication state » *(Access Denied Handler — § How to Customize Access Denied Responses)*

**Question 289 : D** — « If the user is not authenticated (or authenticated anonymously), an authentication entry point is used to generate a response (typically a redirect to the login page or an *401 Unauthorized* response) » *(Access Denied Handler — § How to Customize Access Denied Responses)*

**Question 290 : C** — « If the user is authenticated, but does not have the required permissions, a *403 Forbidden* response is generated. » *(Access Denied Handler — § How to Customize Access Denied Responses)*

**Question 291 : D** — « This interface has one method (`start()`) that is called whenever an unauthenticated user tries to access a protected resource — `start(Request $request, ?AuthenticationException $authException = null): RedirectResponse` » *(Access Denied Handler — § Customize the Unauthorized Response)*

**Question 292 : D** — « This interface defines one method called `handle()` where you can implement whatever logic that should execute when access is denied for the current user (…) `handle(Request $request, AccessDeniedException $accessDeniedException): ?Response` » *(Access Denied Handler — § Customize the Forbidden Response)*

**Question 293 : C** — « you can then configure it under your firewall: `access_denied_handler: App\Security\AccessDeniedHandler` » *(Access Denied Handler — § Customize the Forbidden Response)*

**Question 294 : C** — « In this case, configure a kernel.exception listener » *(Access Denied Handler — § Customizing All Access Denied Responses)*

**Question 295 : D** — « the priority must be greater than the Security HTTP ExceptionListener, to make sure it's called before the default exception listener » *(Access Denied Handler — § Customizing All Access Denied Responses)*

**Question 296 : B** — « The *best* policy is to force `https` on all URLs, which can be done via your web server configuration or `access_control`. » *(Force HTTPS — § How to Force HTTPS or HTTP for different URLs)*

**Question 297 : C** — « you can also use an environment variable, like `requires_channel: '%env(REQUIRED_SCHEME)%'`. In your `.env` file, set `REQUIRED_SCHEME` to `http` by default, but override it to `https` on production. » *(Force HTTPS — § How to Force HTTPS or HTTP for different URLs)*

**Question 298 : C** — « An alternative way to enforce HTTP or HTTPS is to use the scheme option of a route or group of routes. » *(Force HTTPS — § How to Force HTTPS or HTTP for different URLs)*

**Question 299 : C** — « Forcing HTTPS while using a reverse proxy or load balancer requires a proper configuration to avoid infinite redirect loops » *(Force HTTPS — § How to Force HTTPS or HTTP for different URLs)*

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/security.html#learn-more) de la page :

**Authentication (Identifying/Logging in the User)**

- [Passwords](https://symfony.com/doc/8.0/security/passwords.html) — questions 109 à 126
- [LDAP](https://symfony.com/doc/8.0/security/ldap.html) — questions 127 à 137
- [Remember Me](https://symfony.com/doc/8.0/security/remember_me.html) — questions 138 à 151
- [Impersonating User](https://symfony.com/doc/8.0/security/impersonating_user.html) — questions 152 à 162
- [User Checkers](https://symfony.com/doc/8.0/security/user_checkers.html) — questions 163 à 166
- [Firewall Restriction](https://symfony.com/doc/8.0/security/firewall_restriction.html) — questions 167 à 173
- [CSRF](https://symfony.com/doc/8.0/security/csrf.html) — questions 174 à 195
- [Form Login](https://symfony.com/doc/8.0/security/form_login.html) — questions 196 à 203
- [Custom Authenticator](https://symfony.com/doc/8.0/security/custom_authenticator.html) — questions 204 à 226
- [Entry Point](https://symfony.com/doc/8.0/security/entry_point.html) — questions 227 à 232

**Authorization (Denying Access)**

- [Voters](https://symfony.com/doc/8.0/security/voters.html) — questions 233 à 256
- [Access Control](https://symfony.com/doc/8.0/security/access_control.html) — questions 257 à 274
- [Expressions](https://symfony.com/doc/8.0/security/expressions.html) — questions 275 à 287
- [Access Denied Handler](https://symfony.com/doc/8.0/security/access_denied_handler.html) — questions 288 à 295
- [Force HTTPS](https://symfony.com/doc/8.0/security/force_https.html) — questions 296 à 299
