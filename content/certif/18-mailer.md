# QCM — L'envoi d'emails (Mailer)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/mailer.html](https://symfony.com/doc/8.0/mailer.html) · **Généré le :** 21 juillet 2026
>
> **88 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et transport SMTP

### Question 1

Quelle commande installe les composants Mailer et Mime ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/mailer`
- [ ] **B.** `composer require symfony/mail`
- [ ] **C.** Ils sont installés par défaut avec `symfony/framework-bundle`
- [ ] **D.** `composer require symfony/mime-bundle`

### Question 2

Comment configure-t-on le transport par défaut (SMTP) via variable d'environnement ? *(une seule bonne réponse)*

- [ ] **A.** `MAILER_DSN=smtp://user:pass@smtp.example.com:port` dans `.env`, référencé via `framework.mailer.dsn: '%env(MAILER_DSN)%'`
- [ ] **B.** `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS` définies séparément
- [ ] **C.** Uniquement via un fichier `mailer.php` dédié, sans variable d'environnement
- [ ] **D.** `MAIL_DSN`, sans le préfixe `MAILER`

### Question 3

Que faut-il faire si le nom d'utilisateur, le mot de passe ou l'hôte du DSN contiennent des caractères spéciaux d'URI ? *(une seule bonne réponse)*

- [ ] **A.** Les encoder, par exemple via la fonction `urlencode()`
- [ ] **B.** Rien, Symfony les échappe automatiquement
- [ ] **C.** Utiliser un fichier de configuration séparé pour les identifiants
- [ ] **D.** Ce n'est jamais autorisé, il faut changer les identifiants

### Question 4

Quels sont les trois protocoles de transport intégrés (built-in), et quelle mise en garde la documentation formule-t-elle sur `native://default` ? *(une seule bonne réponse)*

- [ ] **A.** `smtp`, `sendmail`, `native` ; `native://default` est déconseillé car on ne contrôle pas comment sendmail est configuré, `sendmail://default` étant préféré
- [ ] **B.** `smtp`, `imap`, `pop3` ; aucune mise en garde particulière
- [ ] **C.** `http`, `smtp`, `ftp` ; `native://default` est le plus recommandé
- [ ] **D.** `smtp` uniquement, les deux autres étant dépréciés

### Question 5

Avec `native://default`, quel effet de bord la documentation signale-t-elle si `php.ini` utilise `sendmail -t` ? *(une seule bonne réponse)*

- [ ] **A.** Aucun, cette combinaison fonctionne parfaitement
- [ ] **B.** Pas de rapport d'erreur, et les en-têtes `Bcc` ne sont pas retirés du message
- [ ] **C.** L'envoi est bloqué systématiquement
- [ ] **D.** Les emails HTML sont convertis de force en texte brut

## Transports tiers (fournisseurs)

### Question 6

Comment utiliser un fournisseur tiers, par exemple SendGrid, plutôt que son propre serveur SMTP ? *(une seule bonne réponse)*

- [ ] **A.** En installant le bridge dédié via Composer, par exemple `composer require symfony/sendgrid-mailer`, qui ajoute une ligne `MAILER_DSN` à décommenter dans `.env` via une recipe Flex
- [ ] **B.** En modifiant directement le composant Mailer
- [ ] **C.** Ce n'est pas supporté, seul SMTP/sendmail natif est disponible
- [ ] **D.** En installant un bundle générique `symfony/third-party-mailer`

### Question 7

Le `MAILER_DSN` d'un fournisseur tiers, par exemple `sendgrid://KEY@default`, correspond-il à une adresse réelle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est l'adresse IP du serveur SendGrid
- [ ] **B.** Non, c'est un format pratique qui délègue la configuration au Mailer ; seul le placeholder `KEY` doit être renseigné
- [ ] **C.** Oui, mais uniquement en environnement `prod`
- [ ] **D.** Non, il s'agit d'une simple chaîne arbitraire sans signification

### Question 8

Comment forcer un fournisseur tiers à utiliser SMTP plutôt que HTTP, le transport par défaut pour certains d'entre eux ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible de changer de protocole de transport
- [ ] **B.** En ajoutant `+smtp` au schéma du DSN, par exemple `sendgrid+smtp://KEY@default`
- [ ] **C.** En passant `--protocol=smtp` à la commande `mailer:test`
- [ ] **D.** En définissant `MAILER_TRANSPORT=smtp` séparément

### Question 9

Comment certains fournisseurs, comme Amazon SES, Mailgun ou Scaleway, acceptent-ils des options supplémentaires comme la région ? *(une seule bonne réponse)*

- [ ] **A.** Via des paramètres de requête (query parameters) ajoutés à la fin du `MAILER_DSN`, par exemple `?region=`
- [ ] **B.** Via un fichier de configuration séparé par fournisseur
- [ ] **C.** Ce n'est jamais configurable, une seule région existe par fournisseur
- [ ] **D.** Via une variable d'environnement dédiée `AWS_REGION` uniquement

### Question 10

Peut-on utiliser Gmail en production, d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est même l'option recommandée pour la production
- [ ] **B.** Non, Gmail ne devrait être utilisé qu'à des fins de test ; en développement, un email catcher est préférable
- [ ] **C.** Oui, à condition d'utiliser XOAUTH2
- [ ] **D.** Non, Gmail n'est pas du tout supporté par Symfony

### Question 11

Comment authentifier Gmail pour l'utiliser à des fins de test, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Avec un compte Google ayant la validation en 2 étapes (2FA) activée et un mot de passe d'application (App Password)
- [ ] **B.** Avec l'API Gmail officielle et OAuth2, seule méthode supportée
- [ ] **C.** Avec le mot de passe habituel du compte Google, sans configuration supplémentaire
- [ ] **D.** Gmail ne nécessite aucune authentification particulière

### Question 12

Certains fournisseurs tiers supportent des callbacks de statut par webhook — à quoi cela sert-il, et où trouver plus de détails ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas documenté pour le Mailer
- [ ] **B.** Aux notifications d'événements liés à l'envoi, ex. livraison, ouverture… ; la documentation renvoie vers l'article dédié au composant Webhook
- [ ] **C.** Uniquement à la facturation du fournisseur
- [ ] **D.** Cela concerne exclusivement le composant Messenger

## Haute disponibilité et répartition de charge

### Question 13

Comment configurer un transport « failover » combinant plusieurs transports ? *(une seule bonne réponse)*

- [ ] **A.** En listant les transports séparés par un espace entre parenthèses, précédés du mot-clé `failover` dans le `MAILER_DSN`
- [ ] **B.** En créant une classe PHP `FailoverTransport` personnalisée obligatoirement
- [ ] **C.** `failover` n'existe pas, seul `roundrobin` est disponible
- [ ] **D.** En listant les transports séparés par une virgule dans `framework.mailer.transports`

### Question 14

Comment se comporte le transport failover en cas d'échec du premier transport ? *(une seule bonne réponse)*

- [ ] **A.** Il abandonne immédiatement l'envoi
- [ ] **B.** Il retente le même envoi avec les transports suivants jusqu'à ce que l'un d'eux réussisse, ou que tous échouent
- [ ] **C.** Il répartit systématiquement la charge entre tous les transports dès le départ
- [ ] **D.** Il attend une intervention manuelle avant de retenter

### Question 15

Quelle est la différence de comportement entre `failover` et `roundrobin` ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont strictement identiques
- [ ] **B.** `roundrobin` démarre avec un transport choisi aléatoirement et bascule vers le suivant à chaque email, répartissant la charge, alors que `failover` privilégie toujours le premier transport tant qu'il fonctionne
- [ ] **C.** `failover` répartit la charge, `roundrobin` ne fait que basculer en cas de panne
- [ ] **D.** `roundrobin` ne fonctionne qu'avec exactement deux transports

### Question 16

Par défaut, au bout de combien de temps un nouvel essai est-il retenté après un échec, pour `failover` et `roundrobin`, et comment ajuster ce délai ? *(une seule bonne réponse)*

- [ ] **A.** 60 secondes par défaut ; ajustable via l'option `retry_period` dans le DSN
- [ ] **B.** 5 secondes, non configurable
- [ ] **C.** Il n'y a jamais de nouvel essai automatique
- [ ] **D.** 60 minutes par défaut, ajustable uniquement en PHP

## Options TLS et réglages SMTP avancés

### Question 17

Comment désactiver la vérification TLS du pair (peer verification), et pourquoi la documentation déconseille-t-elle cette pratique ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `verify_peer=0` dans le DSN ; déconseillé pour des raisons de sécurité, sauf en développement ou avec un certificat auto-signé
- [ ] **B.** Via `disable_tls=true` ; recommandé en toutes circonstances
- [ ] **C.** Ce n'est pas configurable
- [ ] **D.** En supprimant le préfixe `smtps://` du DSN uniquement

### Question 18

Comment forcer une vérification supplémentaire de l'empreinte (fingerprint) du certificat, et sous quels formats ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `peer_fingerprint`, en hash SHA1 ou MD5
- [ ] **B.** Via `peer_fingerprint`, en Base64 uniquement
- [ ] **C.** Ce n'est possible qu'en désactivant complètement `verify_peer`
- [ ] **D.** Via un fichier de certificat séparé, sans option DSN

### Question 19

Quand le composant Mailer utilise-t-il automatiquement le chiffrement TLS, et comment le désactiver ? *(une seule bonne réponse)*

- [ ] **A.** Quand l'extension OpenSSL est activée et que le serveur SMTP supporte STARTTLS ; désactivable via `setAutoTls(false)` ou `auto_tls=false` dans le DSN
- [ ] **B.** Toujours, sans possibilité de désactivation
- [ ] **C.** Uniquement si `require_tls=true` est explicitement défini
- [ ] **D.** Jamais automatiquement, il faut toujours l'activer manuellement

### Question 20

Comment forcer l'usage de TLS, directement ou via STARTTLS, et que se passe-t-il si la connexion TLS échoue ? *(une seule bonne réponse)*

- [ ] **A.** Via `setRequireTls(true)` ou `require_tls=true` dans le DSN ; une `TransportException` est levée si la connexion TLS ne peut être établie
- [ ] **B.** Ce n'est pas possible de forcer TLS, seulement de le désactiver
- [ ] **C.** Via `force_tls=true`, sans exception levée en cas d'échec
- [ ] **D.** En utilisant obligatoirement le protocole `smtps://` à la place de `smtp://`

### Question 21

Comment forcer la liaison à une adresse IPv4 ou IPv6 spécifique, et quelle est la particularité de la syntaxe pour IPv6 ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `source_ip` ; les adresses IPv6 doivent être entourées de crochets, par exemple `source_ip=[::]`
- [ ] **B.** Via `bind_ip`, sans particularité de syntaxe pour IPv6
- [ ] **C.** Ce n'est configurable que via `php.ini`, jamais via le DSN
- [ ] **D.** Via `source_ip`, mais uniquement pour IPv4, IPv6 n'étant pas supporté

### Question 22

Comment redéfinir les méthodes d'authentification SMTP supportées et leur ordre de préférence ? *(une seule bonne réponse)*

- [ ] **A.** Via le constructeur d'`EsmtpTransport` (argument `authenticators`) ou la méthode `setAuthenticators()`
- [ ] **B.** Ce n'est pas configurable, Symfony choisit toujours automatiquement
- [ ] **C.** Uniquement via une variable d'environnement `SMTP_AUTH_METHODS`
- [ ] **D.** Via un fichier de configuration YAML dédié à l'authentification

### Question 23

À quoi servent les options `restart_threshold` et `restart_threshold_sleep` du DSN ? *(une seule bonne réponse)*

- [ ] **A.** Elles n'existent pas dans la documentation
- [ ] **B.** `restart_threshold` définit le nombre maximal de messages avant de redémarrer le transport, `restart_threshold_sleep` le nombre de secondes de pause entre l'arrêt et le redémarrage
- [ ] **C.** Elles définissent le nombre de tentatives de connexion avant abandon
- [ ] **D.** Elles s'appliquent uniquement au transport `sendmail`

### Question 24

Que fait l'option `max_per_second` du DSN ? *(une seule bonne réponse)*

- [ ] **A.** Elle limite le nombre de messages envoyés par seconde, `0` pour désactiver cette limitation
- [ ] **B.** Elle définit un délai fixe entre deux tentatives de connexion
- [ ] **C.** Elle limite le nombre de destinataires par message
- [ ] **D.** Elle n'existe pas pour le transport SMTP

## Transports personnalisés

### Question 25

Comment créer un transport personnalisé pour un DSN sur mesure, par exemple `acme://` ? *(une seule bonne réponse)*

- [ ] **A.** En créant une classe implémentant `TransportFactoryInterface`, ou étendant `AbstractTransportFactory`, avec une méthode `create()` et `getSupportedSchemes()`
- [ ] **B.** En modifiant directement le code source du composant Mailer
- [ ] **C.** Ce n'est pas possible, seuls les schémas DSN intégrés sont supportés
- [ ] **D.** Via un fichier de configuration `mailer_transports.yaml`

### Question 26

Une fois la classe de transport personnalisée créée, comment l'enregistrer pour que Symfony la prenne en compte ? *(une seule bonne réponse)*

- [ ] **A.** En l'enregistrant comme service et en la taguant avec `mailer.transport_factory`
- [ ] **B.** Automatiquement, dès qu'elle est placée dans `src/Mailer/`
- [ ] **C.** En l'ajoutant à un tableau statique dans le `Kernel`
- [ ] **D.** Ce n'est pas nécessaire, elle est détectée par convention de nommage

## Créer et envoyer des messages

### Question 27

Comment obtenir le service mailer et envoyer un email basique ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant `MailerInterface`, en créant un objet `Email` (from/to/subject/text/html), puis en appelant `$mailer->send($email)`
- [ ] **B.** En instanciant directement `new Mailer()` sans passer par le container
- [ ] **C.** Via un appel statique `Mailer::send($email)`
- [ ] **D.** En injectant `TransportInterface` obligatoirement pour tout envoi simple

### Question 28

Les méthodes comme `from()`/`to()` acceptent-elles uniquement des chaînes de caractères ? *(une seule bonne réponse)*

- [ ] **A.** Oui, uniquement des chaînes au format `'email@example.com'`
- [ ] **B.** Non, elles acceptent aussi bien des chaînes que des objets `Address`, avec ou sans nom associé
- [ ] **C.** Non, uniquement des objets `Address`, jamais de chaînes
- [ ] **D.** Oui, sauf pour `from()` qui accepte aussi un objet `User`

### Question 29

Comment ajouter plusieurs destinataires en Cc, en plus du premier ? *(une seule bonne réponse)*

- [ ] **A.** En rappelant simplement `cc()` plusieurs fois, ce qui remplace la valeur précédente à chaque fois
- [ ] **B.** Via la méthode `addCc()`, ou en passant plusieurs adresses en une seule fois à `cc()`
- [ ] **C.** Ce n'est possible qu'en Bcc, jamais en Cc
- [ ] **D.** En les séparant par une virgule dans une seule chaîne passée à `cc()`

### Question 30

Que dit la documentation sur les caractères non-ASCII dans une adresse email, dans la partie locale et le domaine ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne sont jamais supportés
- [ ] **B.** Ils sont supportés à la fois dans la partie locale et le domaine ; si le serveur SMTP ne le supporte pas, une exception apparaît
- [ ] **C.** Ils ne sont supportés que dans le domaine, jamais dans la partie locale
- [ ] **D.** Ils ne sont supportés que pour l'adresse de l'expéditeur (`from`)

### Question 31

Comment ajouter un en-tête personnalisé à un email, par exemple pour désactiver les réponses automatiques ? *(une seule bonne réponse)*

- [ ] **A.** Via `$email->getHeaders()->addTextHeader('X-Auto-Response-Suppress', '...')`
- [ ] **B.** Via `$email->setHeader('X-Auto-Response-Suppress', '...')` directement sur l'objet `Email`
- [ ] **C.** Ce n'est pas possible, seuls les en-têtes standards sont supportés
- [ ] **D.** Via un fichier de configuration `mailer_headers.yaml`

### Question 32

Comment le contenu texte et HTML d'un email peut-il être fourni, en plus de simples chaînes ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement sous forme de chaînes, aucune autre source n'est supportée
- [ ] **B.** Aussi sous forme de ressources PHP (streams), par exemple le résultat de `fopen()`
- [ ] **C.** Uniquement via un template Twig, jamais directement en PHP
- [ ] **D.** Uniquement sous forme de tableaux associatifs

### Question 33

Comment attacher un fichier existant sur le disque à un email ? *(une seule bonne réponse)*

- [ ] **A.** Avec une méthode `attach()` prenant un chemin de fichier en argument
- [ ] **B.** Avec `addPart(new DataPart(new File('/chemin/vers/fichier')))`, avec un nom et un type MIME optionnels en arguments supplémentaires
- [ ] **C.** Il faut obligatoirement convertir le fichier en base64 manuellement au préalable
- [ ] **D.** Uniquement via un stream, jamais depuis un chemin de fichier direct

### Question 34

Comment intégrer une image directement dans le corps de l'email plutôt que comme pièce jointe, et comment la référencer ensuite en HTML ? *(une seule bonne réponse)*

- [ ] **A.** Avec `asInline()` sur le `DataPart`, puis en la référençant via `cid:` + le nom donné à l'image dans le `src` de la balise `img`
- [ ] **B.** En l'attachant normalement, toutes les images étant automatiquement affichées inline par les clients mail
- [ ] **C.** Ce n'est pas possible sans passer par Twig
- [ ] **D.** En l'encodant en URL `data:` base64 uniquement

### Question 35

Le « Content-ID » d'une image intégrée est-il choisi par Symfony ou par le développeur ? *(une seule bonne réponse)*

- [ ] **A.** Toujours généré aléatoirement par Symfony, sans possibilité de le personnaliser
- [ ] **B.** Généré aléatoirement par défaut, mais personnalisable via `setContentId()`, qui doit inclure au moins un caractère `@` selon la spec
- [ ] **C.** Toujours défini manuellement, Symfony ne peut pas le générer automatiquement
- [ ] **D.** Dérivé automatiquement du nom du fichier, sans possibilité de changement

## Configurer les emails globalement

### Question 36

Comment définir un expéditeur (From) ou des en-têtes par défaut pour tous les emails envoyés par l'application, sans les répéter à chaque fois ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.mailer.envelope` (`sender`/`recipients`) et `framework.mailer.headers` dans la configuration
- [ ] **B.** Ce n'est pas possible, il faut toujours appeler `->from()` sur chaque `Email`
- [ ] **C.** Uniquement via un `EventSubscriber` personnalisé, aucune configuration native n'existe
- [ ] **D.** Via un service `GlobalEmailDefaults` obligatoire

### Question 37

Quel avertissement la documentation formule-t-elle sur l'usage de mots-clés comme `from` dans les en-têtes globaux ? *(une seule bonne réponse)*

- [ ] **A.** Aucun avertissement particulier
- [ ] **B.** Certains fournisseurs tiers ne supportent pas l'usage de tels mots-clés dans `headers` ; il faut vérifier la documentation du fournisseur avant de définir un en-tête global
- [ ] **C.** C'est totalement interdit par le composant Mailer lui-même
- [ ] **D.** Cela ne fonctionne qu'avec le transport SMTP natif

## Gérer les échecs d'envoi et déboguer les emails

### Question 38

Quand Symfony Mailer considère-t-il qu'un envoi a réussi ? *(une seule bonne réponse)*

- [ ] **A.** Quand l'email a effectivement été ouvert par le destinataire
- [ ] **B.** Quand le transport (serveur SMTP ou fournisseur tiers) a accepté l'email pour livraison ultérieure — la perte éventuelle après coup est hors de portée de l'application
- [ ] **C.** Quand un accusé de réception a été reçu
- [ ] **D.** Uniquement quand la commande `mailer:test` confirme la livraison

### Question 39

Quelle exception est levée en cas d'erreur lors de la remise de l'email au transport ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Mailer\Exception\TransportExceptionInterface`
- [ ] **B.** `Symfony\Component\Mime\Exception\MimeException`
- [ ] **C.** Une simple `\RuntimeException` générique
- [ ] **D.** Aucune exception, l'erreur est seulement journalisée silencieusement

### Question 40

Pourquoi le service injecté via `MailerInterface` ne permet-il pas d'accéder aux informations du message envoyé, et comment contourner cela ? *(une seule bonne réponse)*

- [ ] **A.** Parce que l'envoi se fait de façon asynchrone quand Messenger est utilisé, `send()` ne retournant rien ; il faut injecter `TransportInterface` à la place pour obtenir un objet `SentMessage`
- [ ] **B.** Ce n'est jamais possible d'accéder à ces informations
- [ ] **C.** Il faut toujours passer par un event listener, aucune autre solution n'existe
- [ ] **D.** `MailerInterface` retourne toujours un `SentMessage`, contrairement à `TransportInterface`

### Question 41

`TransportInterface::send()` envoie-t-il toujours les emails de façon synchrone, même si Messenger est utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Non, il respecte toujours la configuration Messenger
- [ ] **B.** Oui, contrairement à `MailerInterface`, `TransportInterface` envoie toujours de façon synchrone
- [ ] **C.** Cela dépend de l'environnement (dev/prod)
- [ ] **D.** Non, seul le catcher d'email en dev est synchrone

### Question 42

Que fournit l'objet `SentMessage`, utile pour déboguer les erreurs ? *(une seule bonne réponse)*

- [ ] **A.** `getOriginalMessage()`, le message d'origine, et `getDebug()`, des informations de debug comme les appels HTTP effectués par les transports HTTP
- [ ] **B.** Uniquement l'identifiant du message, rien d'autre
- [ ] **C.** Le contenu HTML rendu final, sans autre métadonnée
- [ ] **D.** Une copie chiffrée du message envoyé

## Twig : contenu HTML et CSS

### Question 43

Quelle classe utiliser pour définir le contenu d'un email via des templates Twig ? *(une seule bonne réponse)*

- [ ] **A.** `TemplatedEmail`, qui étend la classe `Email` standard en ajoutant des méthodes pour les templates Twig
- [ ] **B.** `TwigEmail`, une classe totalement indépendante d'`Email`
- [ ] **C.** `EmailTemplate`, qui remplace complètement `Email`
- [ ] **D.** Il faut utiliser directement le service `twig` dans le contrôleur, sans classe dédiée

### Question 44

Comment passer des variables au template Twig d'un `TemplatedEmail` ? *(une seule bonne réponse)*

- [ ] **A.** Via la méthode `context(['nom' => valeur, ...])`
- [ ] **B.** Via un tableau passé directement en second argument du constructeur
- [ ] **C.** Uniquement via des attributs globaux Twig, jamais par email
- [ ] **D.** Via `setVariables()`, `context()` étant réservée aux en-têtes

### Question 45

À quelle variable spéciale le template Twig d'un `TemplatedEmail` a-t-il accès, en plus des variables du contexte ? *(une seule bonne réponse)*

- [ ] **A.** `mailer`, qui référence le service `MailerInterface`
- [ ] **B.** `email`, une instance de `WrappedTemplatedEmail`
- [ ] **C.** `transport`, qui référence le transport utilisé
- [ ] **D.** Aucune variable spéciale n'est ajoutée automatiquement

### Question 46

Si le contenu texte n'est pas explicitement défini sur un `TemplatedEmail`, comment Symfony le génère-t-il, par ordre de priorité ? *(une seule bonne réponse)*

- [ ] **A.** Un convertisseur HTML-vers-texte explicitement configuré s'il existe ; sinon `league/html-to-markdown` si installé ; sinon un simple `strip_tags()` sur le contenu HTML
- [ ] **B.** Il reste toujours vide si non défini explicitement
- [ ] **C.** Il est systématiquement identique au contenu HTML, balises incluses
- [ ] **D.** Une erreur est levée obligeant à définir le texte manuellement

### Question 47

Comment définir explicitement le contenu texte via un template Twig séparé du template HTML ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant la méthode `textTemplate()` de `TemplatedEmail`
- [ ] **B.** Ce n'est pas possible, seul `text()` avec une chaîne brute fonctionne
- [ ] **C.** En dupliquant le fichier HTML avec l'extension `.txt`
- [ ] **D.** Via un second appel à `htmlTemplate()` avec un paramètre `format: 'text'`

### Question 48

Comment intégrer des images dans un email Twig sans manipuler manuellement la syntaxe `cid:` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec Twig, il faut toujours utiliser `addPart()` manuellement
- [ ] **B.** En définissant un namespace Twig dédié aux images, puis en utilisant le helper `email.image('@images/logo.png')` dans le template
- [ ] **C.** En utilisant directement un chemin de fichier absolu dans la balise `img`
- [ ] **D.** Uniquement en passant par le composant AssetMapper

### Question 49

Pourquoi Twig propose-t-il une extension d'« inlining » CSS (`CssInlinerExtension`), et comment l'appliquer à un template ? *(une seule bonne réponse)*

- [ ] **A.** Parce que des clients mail populaires comme Gmail ne supportent pas les balises `<style>`, obligeant à mettre chaque style en attribut `style` inline ; on applique le filtre `inline_css` autour du template
- [ ] **B.** Pour optimiser la taille du message uniquement, sans lien avec la compatibilité client
- [ ] **C.** Pour remplacer entièrement le HTML par du Markdown
- [ ] **D.** Ce n'est utile qu'avec le transport SMTP, pas avec les fournisseurs HTTP

### Question 50

Comment charger des styles CSS depuis un fichier externe plutôt que de les écrire en dur dans le template ? *(une seule bonne réponse)*

- [ ] **A.** En passant le résultat de `source('@styles/email.css')` en argument du filtre `inline_css()`
- [ ] **B.** Ce n'est pas possible, tous les styles doivent être écrits dans le même template
- [ ] **C.** En important le fichier CSS via `{% import %}`
- [ ] **D.** Via un attribut PHP `#[InlineStyle]` sur le contrôleur

### Question 51

Quelle extension Twig permet d'écrire le contenu d'un email en Markdown, et quel filtre ajoute-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `MarkdownExtension`, avec le filtre `markdown_to_html`
- [ ] **B.** `CommonMarkExtension`, avec le filtre `to_markdown`
- [ ] **C.** Aucune extension de ce type n'existe pour Twig
- [ ] **D.** `MarkdownExtension`, mais uniquement utilisable hors du contexte email

### Question 52

Que propose le framework Inky pour la création d'emails, et par quel filtre Twig l'intègre-t-on ? *(une seule bonne réponse)*

- [ ] **A.** Une syntaxe de balises proches du HTML (`container`, `row`, `columns`…) transformées en HTML final, via le filtre `inky_to_html`
- [ ] **B.** Un moteur de template concurrent de Twig, incompatible avec ce dernier
- [ ] **C.** Un simple thème CSS, sans balises spécifiques
- [ ] **D.** Inky ne concerne que la génération de PDF, pas d'emails

## Signer et chiffrer les messages

### Question 53

Que faut-il avoir en place avant de signer ou chiffrer des messages, d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** L'extension PHP OpenSSL correctement installée et configurée, et un certificat de sécurité S/MIME valide
- [ ] **B.** Uniquement une clé API du fournisseur d'email
- [ ] **C.** Le composant Messenger installé et configuré
- [ ] **D.** Rien de particulier, cela fonctionne nativement sans dépendance

### Question 54

Quel est l'objectif principal de la signature d'un message (S/MIME ou DKIM), et quelle limite cela a-t-il sur la confidentialité du contenu ? *(une seule bonne réponse)*

- [ ] **A.** Elle garantit l'intégrité du message en ajoutant un hash cryptographique, mais le contenu original reste lisible pour les agents ne supportant pas les messages signés — il faut aussi chiffrer pour cacher le contenu
- [ ] **B.** Elle chiffre entièrement le contenu, empêchant toute lecture non autorisée
- [ ] **C.** Elle ne concerne que les pièces jointes, jamais le corps du message
- [ ] **D.** Elle remplace entièrement le besoin d'authentification SMTP

### Question 55

Que se passe-t-il pour les destinataires en Bcc si l'on signe un message, et comment gérer plusieurs destinataires dans ce cas ? *(une seule bonne réponse)*

- [ ] **A.** Les destinataires Bcc sont retirés du message signé ; il faut calculer une nouvelle signature pour chaque destinataire si l'on veut envoyer à plusieurs personnes
- [ ] **B.** Les Bcc restent inchangés, aucune précaution particulière n'est nécessaire
- [ ] **C.** La signature échoue systématiquement s'il y a des Bcc
- [ ] **D.** Seul le premier destinataire Bcc conserve la signature

### Question 56

Quels arguments minimaux le constructeur de `SMimeSigner` attend-il ? *(une seule bonne réponse)*

- [ ] **A.** Le chemin vers le certificat et le chemin vers la clé privée, tous deux au format PEM
- [ ] **B.** Uniquement un mot de passe
- [ ] **C.** Une chaîne de connexion DSN, comme pour les transports
- [ ] **D.** Le contenu brut du certificat encodé en base64

### Question 57

Qu'attend le constructeur de `DkimSigner`, en plus de la clé privée ? *(une seule bonne réponse)*

- [ ] **A.** Le nom de domaine et un « sélecteur » utilisés pour effectuer une recherche DNS
- [ ] **B.** Un certificat X.509, comme pour S/MIME
- [ ] **C.** Uniquement la clé privée, sans autre paramètre obligatoire
- [ ] **D.** L'adresse IP du serveur SMTP

### Question 58

Comment configurer un signataire, DKIM ou S/MIME, une bonne fois pour toutes, plutôt que d'en instancier un pour chaque email ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, il faut toujours signer manuellement chaque message
- [ ] **B.** Via les clés `dkim_signer` et `smime_signer` de la configuration `framework.mailer`, appliquées automatiquement à tous les messages sortants
- [ ] **C.** Uniquement via un event listener personnalisé, aucune configuration native
- [ ] **D.** Via une variable d'environnement `MAILER_SIGNER`

### Question 59

Quand un message est chiffré (encrypted), qui peut en lire le contenu original ? *(une seule bonne réponse)*

- [ ] **A.** N'importe quel client mail, le chiffrement ne concernant que les pièces jointes
- [ ] **B.** Seuls les destinataires possédant la clé privée correspondant au certificat utilisé pour le chiffrement
- [ ] **C.** Uniquement l'expéditeur du message
- [ ] **D.** Tous les destinataires, y compris ceux en Bcc, sans restriction

### Question 60

Comment `SMimeEncrypter` gère-t-il l'envoi à plusieurs destinataires ayant chacun leur propre certificat ? *(une seule bonne réponse)*

- [ ] **A.** Il faut créer une instance séparée de `SMimeEncrypter` par destinataire, sans possibilité de mutualiser
- [ ] **B.** On peut passer plusieurs certificats au constructeur, un tableau adresse => chemin du certificat, et il sélectionne automatiquement le bon certificat selon l'option `To`
- [ ] **C.** Un seul certificat peut être utilisé pour tous les destinataires simultanément
- [ ] **D.** `SMimeEncrypter` ne supporte qu'un seul destinataire par message, sans exception

### Question 61

Comment configurer un chiffrement S/MIME global, dynamique selon le destinataire, plutôt que via un chemin de certificat fixe ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible de rendre le chiffrement global dynamique
- [ ] **B.** Via l'option `smime_encrypter.repository`, pointant vers un service implémentant `SmimeCertificateRepositoryInterface`
- [ ] **C.** Uniquement via un tableau statique de correspondances dans le fichier YAML
- [ ] **D.** Via l'option `smime_signer`, partagée avec la signature

### Question 62

Quelle méthode unique une classe implémentant `SmimeCertificateRepositoryInterface` doit-elle fournir ? *(une seule bonne réponse)*

- [ ] **A.** `getCertificate()`, retournant directement le contenu du certificat
- [ ] **B.** `findCertificatePathFor(string $email)`, retournant le chemin vers le fichier de certificat associé à cette adresse
- [ ] **C.** `resolve(Email $email): SMimeEncrypter`
- [ ] **D.** `sign(Email $email): Email`

## Transports multiples

### Question 63

Comment configurer plusieurs transports de mailer nommés, par exemple `main` et `alternative` ? *(une seule bonne réponse)*

- [ ] **A.** En remplaçant l'entrée `dsn` par une entrée `transports`, sous forme de tableau nom => DSN
- [ ] **B.** Ce n'est pas possible, un seul transport peut être configuré par application
- [ ] **C.** En dupliquant entièrement le fichier `mailer.yaml`, un par transport
- [ ] **D.** Via plusieurs variables d'environnement `MAILER_DSN_1`, `MAILER_DSN_2`…

### Question 64

Quel transport est utilisé par défaut, et comment sélectionner explicitement un autre transport nommé pour un email donné ? *(une seule bonne réponse)*

- [ ] **A.** Le premier de la liste par défaut ; en ajoutant l'en-tête `X-Transport` avec le nom du transport souhaité, retiré automatiquement du message final
- [ ] **B.** Le dernier de la liste par défaut ; via un argument supplémentaire de `send()`
- [ ] **C.** Aucun ordre par défaut, il faut toujours préciser explicitement le transport
- [ ] **D.** Le transport est choisi aléatoirement à chaque envoi

## Envoi asynchrone des messages

### Question 65

Que se passe-t-il par défaut quand on appelle `$mailer->send($email)`, sans configuration Messenger ? *(une seule bonne réponse)*

- [ ] **A.** L'email est envoyé immédiatement au transport
- [ ] **B.** Il est systématiquement mis en file d'attente, même sans Messenger configuré
- [ ] **C.** Rien, il faut toujours explicitement appeler `flush()`
- [ ] **D.** Il attend la fin de la requête HTTP avant d'être traité

### Question 66

Quelle classe de message est dispatchée sur le bus par défaut quand l'envoi asynchrone via Messenger est configuré ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Mailer\Messenger\SendEmailMessage`
- [ ] **B.** `Symfony\Component\Mime\Messenger\EmailMessage`
- [ ] **C.** `Symfony\Component\Mailer\Event\MessageEvent`, réutilisé comme message Messenger
- [ ] **D.** Il n'existe pas de classe dédiée, un tableau brut est envoyé

### Question 67

Quand l'envoi est asynchrone, à quel moment le rendu de l'email (calcul des en-têtes, du corps…) a-t-il réellement lieu ? *(une seule bonne réponse)*

- [ ] **A.** Immédiatement, au moment de l'appel à `send()`, avant la mise en file d'attente
- [ ] **B.** Il est différé et n'a lieu que juste avant l'envoi effectif par le worker Messenger
- [ ] **C.** Il n'a jamais lieu si l'envoi est asynchrone, seul un identifiant est transmis
- [ ] **D.** Au moment de la création de l'objet `Email`, avant même l'appel à `send()`

### Question 68

Pourquoi un `TemplatedEmail` contenant des entités Doctrine dans son `context` peut-il poser problème en envoi asynchrone, et comment y remédier ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le message doit être sérialisable pour transiter par le transport Messenger ; il faut remplacer les entités par des variables plus spécifiques ou rendre l'email avant l'appel à `send()` via `BodyRendererInterface`
- [ ] **B.** Ce n'est jamais un problème, Doctrine gère nativement la sérialisation Messenger
- [ ] **C.** Il faut désactiver complètement l'envoi asynchrone dans ce cas précis
- [ ] **D.** Il faut convertir les entités en tableaux JSON manuellement avant de les passer au contexte

### Question 69

Comment choisir un autre bus que le bus par défaut pour dispatcher les messages d'email, et comment désactiver complètement l'envoi asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `message_bus` de la configuration mailer ; passer `false` à cette option désactive l'asynchrone et appelle directement le transport Mailer
- [ ] **B.** Ce n'est pas configurable, seul le bus par défaut peut être utilisé
- [ ] **C.** Via une variable d'environnement `MAILER_BUS` uniquement
- [ ] **D.** En renommant le service `messenger.default_bus`

### Question 70

Dans le cas de scripts de longue durée utilisant `SmtpTransport`, que recommande la documentation pour éviter de garder une connexion SMTP ouverte inutilement ? *(une seule bonne réponse)*

- [ ] **A.** Appeler manuellement la méthode `stop()` pour se déconnecter
- [ ] **B.** Redémarrer le script après chaque envoi
- [ ] **C.** Utiliser exclusivement des transports HTTP, jamais SMTP
- [ ] **D.** Aucune action n'est nécessaire, la connexion se ferme automatiquement après chaque email

## Ajouter des tags et métadonnées

### Question 71

Comment ajouter des tags et métadonnées à un email pour le groupement/suivi chez certains fournisseurs tiers ? *(une seule bonne réponse)*

- [ ] **A.** Via les classes `TagHeader` et `MetadataHeader` ajoutées aux en-têtes de l'email
- [ ] **B.** Via des paramètres supplémentaires de la méthode `send()`
- [ ] **C.** Ce n'est supporté par aucun fournisseur tiers
- [ ] **D.** Uniquement via le corps HTML de l'email, en tant que commentaires

### Question 72

Que se passe-t-il si le transport utilisé ne supporte pas nativement les tags et métadonnées ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée, empêchant l'envoi
- [ ] **B.** Ils sont ajoutés comme en-têtes personnalisés classiques, par exemple `X-Tag`, `X-Metadata-*`
- [ ] **C.** Ils sont silencieusement ignorés sans aucune trace
- [ ] **D.** Le message est automatiquement basculé vers un autre transport qui les supporte

### Question 73

Amazon SES a-t-il une terminologie différente pour ce que Symfony appelle « metadata » ? *(une seule bonne réponse)*

- [ ] **A.** Non, la terminologie est identique partout
- [ ] **B.** Oui : Amazon SES appelle cette fonctionnalité « tags », alors que Symfony l'appelle « metadata » car elle contient une clé et une valeur
- [ ] **C.** Amazon SES ne supporte ni les tags ni les metadata
- [ ] **D.** Amazon SES les appelle « labels », Symfony les appelle « tags »

## Emails brouillon (DraftEmail)

### Question 74

À quoi sert la classe `DraftEmail`, et quel en-tête particulier porte le fichier `.eml` généré ? *(une seule bonne réponse)*

- [ ] **A.** À préparer un email téléchargeable en tant que brouillon, que les clients mail peuvent interpréter comme tel grâce à l'en-tête `X-Unsent`
- [ ] **B.** À enregistrer automatiquement une copie de chaque email envoyé dans une base de données
- [ ] **C.** À planifier l'envoi différé d'un email à une date précise
- [ ] **D.** C'est un simple alias de `Email`, sans différence fonctionnelle

### Question 75

Un `DraftEmail` créé sans destinataire (To) ni expéditeur (From) peut-il être envoyé directement via le Mailer ? *(une seule bonne réponse)*

- [ ] **A.** Oui, sans aucune restriction
- [ ] **B.** Non, ce n'est pas possible : son usage prévu est le téléchargement, pas l'envoi direct
- [ ] **C.** Oui, mais uniquement en environnement `dev`
- [ ] **D.** Non, mais uniquement s'il contient des pièces jointes

## Événements du Mailer

### Question 76

À quoi sert `MessageEvent`, et comment empêcher l'envoi d'un message depuis un listener de cet événement ? *(une seule bonne réponse)*

- [ ] **A.** Il permet de modifier le message et l'enveloppe avant l'envoi ; appeler `reject()` empêche l'envoi et arrête aussi la propagation de l'événement
- [ ] **B.** Il ne sert qu'à journaliser après l'envoi, sans possibilité de modification
- [ ] **C.** `reject()` ne fait qu'ajouter un avertissement dans les logs, sans bloquer l'envoi
- [ ] **D.** `MessageEvent` n'est dispatché qu'après l'envoi effectif du message

### Question 77

Quelle commande permet de découvrir quels listeners sont enregistrés pour un événement du Mailer, avec leurs priorités ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:event-dispatcher "Symfony\Component\Mailer\Event\MessageEvent"` (ou l'un des autres événements du Mailer)
- [ ] **B.** `php bin/console mailer:debug-events`
- [ ] **C.** `php bin/console debug:container mailer.events`
- [ ] **D.** Il n'existe aucune commande pour cela

### Question 78

À quoi sert `SentMessageEvent`, et quelles informations expose-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il permet d'agir sur le `SentMessage` après un envoi réussi, avec accès au message original et aux informations de débogage, par exemple les appels HTTP
- [ ] **B.** Il se déclenche uniquement en cas d'échec de l'envoi
- [ ] **C.** Il ne permet que de lire le sujet de l'email envoyé
- [ ] **D.** Il remplace entièrement `MessageEvent` depuis Symfony 7

### Question 79

Que permet `FailedMessageEvent`, notamment via `getError()` ? *(une seule bonne réponse)*

- [ ] **A.** D'agir sur le message initial en cas d'échec d'envoi, et d'obtenir des informations de débogage supplémentaires si l'erreur implémente `TransportExceptionInterface`
- [ ] **B.** De relancer automatiquement l'envoi du message
- [ ] **C.** De rediriger l'email vers une adresse de secours automatiquement
- [ ] **D.** Il ne fournit aucune information exploitable sur l'erreur

### Question 80

Ces trois événements du Mailer (`MessageEvent`, `SentMessageEvent`, `FailedMessageEvent`) nécessitent-ils une configuration particulière pour être écoutés ? *(une seule bonne réponse)*

- [ ] **A.** Oui, un bundle tiers dédié doit être installé
- [ ] **B.** Non, il suffit d'écrire un event listener/subscriber classique comme pour n'importe quel autre événement Symfony
- [ ] **C.** Oui, ils ne sont disponibles qu'en passant par Messenger
- [ ] **D.** Non, mais ils ne peuvent être écoutés qu'en environnement de test

## Développement et débogage

### Question 81

Comment obtenir un « email catcher » automatiquement configuré en développement local ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est jamais automatique, il faut toujours l'installer manuellement
- [ ] **B.** En activant le support Docker via les recipes Symfony, l'email catcher est alors configuré automatiquement
- [ ] **C.** En installant obligatoirement Mailtrap
- [ ] **D.** En désactivant complètement le transport Mailer en développement

### Question 82

Quelle commande permet de tester l'envoi d'un email en développement, et quel argument est obligatoire ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console mailer:test`, avec l'adresse du destinataire comme seul argument obligatoire
- [ ] **B.** `php bin/console mailer:send-test --to=...`
- [ ] **C.** `php bin/console debug:mailer`
- [ ] **D.** Il n'existe pas de commande dédiée, il faut écrire un contrôleur de test

### Question 83

La commande `mailer:test` passe-t-elle par le bus Messenger si celui-ci est configuré ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, comme tout autre envoi d'email
- [ ] **B.** Non, elle contourne le bus Messenger pour faciliter les tests même si le consumer ne tourne pas
- [ ] **C.** Cela dépend d'une option `--async` à passer explicitement
- [ ] **D.** Non, mais uniquement en environnement `test`

### Question 84

Comment désactiver complètement l'envoi des emails pendant le développement, ou les tests ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant `null://null` comme DSN du mailer
- [ ] **B.** En désinstallant temporairement `symfony/mailer`
- [ ] **C.** En mettant `framework.mailer.enabled: false`
- [ ] **D.** En vidant le cache avant chaque test

### Question 85

Si Messenger route les emails vers un transport, la configuration `null://null` empêche-t-elle réellement leur envoi ? *(une seule bonne réponse)*

- [ ] **A.** Oui, dans tous les cas
- [ ] **B.** Non : le message sera malgré tout envoyé à ce transport
- [ ] **C.** Cela dépend de la version de Messenger installée
- [ ] **D.** Non, mais uniquement si le DSN `null://null` est mal configuré

### Question 86

Comment faire en sorte que tous les emails d'une application soient envoyés à une adresse fixe en développement, plutôt que d'être bloqués ? *(une seule bonne réponse)*

- [ ] **A.** Via `framework.mailer.envelope.recipients`, qui redirige tous les destinataires vers l'adresse ou les adresses indiquées
- [ ] **B.** En modifiant manuellement chaque appel à `->to()` dans le code
- [ ] **C.** Ce n'est pas possible sans un event listener personnalisé
- [ ] **D.** Via `null://null`, qui redirige automatiquement vers une adresse de test

### Question 87

À quoi sert l'option `allowed_recipients` en complément de `recipients` ? *(une seule bonne réponse)*

- [ ] **A.** Elle définit des adresses, ou expressions régulières, qui continueront à recevoir les emails à leur adresse d'origine, en plus de l'adresse de redirection
- [ ] **B.** Elle liste les seules adresses autorisées à envoyer des emails
- [ ] **C.** Elle remplace entièrement `recipients`, sans effet combiné
- [ ] **D.** Elle ne fonctionne qu'en environnement `prod`

### Question 88

Comment tester fonctionnellement qu'un email a bien été envoyé, avec son contenu et ses en-têtes ? *(une seule bonne réponse)*

- [ ] **A.** Via les assertions mailer intégrées, par exemple `assertEmailCount()`, `assertEmailHtmlBodyContains()`, disponibles dans les classes de test étendant `KernelTestCase` ou utilisant `MailerAssertionsTrait`
- [ ] **B.** Il faut toujours mocker manuellement `MailerInterface`
- [ ] **C.** Ce n'est pas testable fonctionnellement, seulement unitairement
- [ ] **D.** Uniquement en interceptant les logs Monolog liés à l'envoi

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Mailer de la documentation Symfony 8.0](https://symfony.com/doc/8.0/mailer.html).

**Question 1 : A** — « Symfony's Mailer & Mime components form a *powerful* system for creating and sending emails (…). Get them installed with: `$ composer require symfony/mailer` » *(§ Installation)*

**Question 2 : A** — « By default, you can deliver emails over SMTP by configuring the DSN in your `.env` file (…) `MAILER_DSN=smtp://user:pass@smtp.example.com:port` », référencé via `dsn: '%env(MAILER_DSN)%'` dans `config/packages/mailer.yaml`. *(§ Transport Setup)*

**Question 3 : A** — « If the username, password or host contain any character considered special in a URI (…), you must encode them. (…) or use the `urlencode` function to encode them. » *(§ Transport Setup)*

**Question 4 : A** — Les trois protocoles intégrés sont `smtp`, `sendmail`, `native` : « It's highly recommended to NOT use `native://default` as you cannot control how sendmail is configured (prefer using `sendmail://default` if possible). » *(§ Using Built-in Transports)*

**Question 5 : B** — « When using `native://default`, if `php.ini` uses the `sendmail -t` command, you won't have error reporting and `Bcc` headers won't be removed. » *(§ Using Built-in Transports)*

**Question 6 : A** — « Each library includes a Symfony Flex recipe that will add a configuration example to your `.env` file. » — exemple : `$ composer require symfony/sendgrid-mailer`. *(§ Using a 3rd Party Transport)*

**Question 7 : B** — « The `MAILER_DSN` isn't a *real* address: it's a convenient format that offloads most of the configuration work to mailer. (…) The *only* part you need to change is the `KEY` placeholder. » *(§ Using a 3rd Party Transport)*

**Question 8 : B** — « # force to use SMTP instead of HTTP (which is the default) `MAILER_DSN=sendgrid+smtp://$SENDGRID_KEY@default` » *(§ Using a 3rd Party Transport)*

**Question 9 : A** — « Some also have options that can be configured with query parameters at the end of the `MAILER_DSN` — like `?region=` for Amazon SES, Mailgun or Scaleway. » *(§ Using a 3rd Party Transport)*

**Question 10 : B** — « (…) this should not be used in production. In development, you should probably use an email catcher instead. » *(§ Using a 3rd Party Transport)*

**Question 11 : A** — « To use Google Gmail, you must have a Google Account with 2-Step-Verification (2FA) enabled and you must use App Password to authenticate. » *(§ Using a 3rd Party Transport)*

**Question 12 : B** — « Some third party mailers, when using the API, support status callbacks via webhooks. See the Webhook documentation for more details. » *(§ Using a 3rd Party Transport)*

**Question 13 : A** — « A failover transport is configured with two or more transports and the `failover` keyword: `MAILER_DSN="failover(postmark+api://ID@default sendgrid+smtp://KEY@default)"` » *(§ High Availability)*

**Question 14 : B** — « The failover-transport starts using the first transport and if it fails, it will retry the same delivery with the next transports until one of them succeeds (or until all of them fail). » *(§ High Availability)*

**Question 15 : B** — « The round-robin transport starts with a *randomly* selected transport and then switches to the next available transport for each subsequent email. (…) In contrast to the failover transport, it *spreads* the load across all its transports. » *(§ Load Balancing)*

**Question 16 : A** — « By default, delivery is retried 60 seconds after a failed attempt. You can adjust the retry period by setting the `retry_period` option in the DSN. » *(§ High Availability)*

**Question 17 : A** — « This behavior is configurable with the `verify_peer` option. Although it's not recommended to disable this verification for security reasons, it can be useful while developing the application or when using a self-signed certificate: `?verify_peer=0` » *(§ TLS Peer Verification)*

**Question 18 : A** — « Additional fingerprint verification can be enforced with the `peer_fingerprint` option. (…) Fingerprint may be specified as SHA1 or MD5 hash. » *(§ TLS Peer Fingerprint Verification)*

**Question 19 : A** — « By default, the Mailer component will use encryption when the OpenSSL extension is enabled and the SMTP server supports `STARTTLS`. This behavior can be turned off by calling `setAutoTls(false)` (…), or by setting the `auto_tls` option to `false` in the DSN. » *(§ Disabling Automatic TLS)*

**Question 20 : A** — « To require TLS, call `setRequireTls(true)` (…), or set the `require_tls` option to `true` in the DSN. When TLS is required, a `TransportException` is thrown if a TLS connection cannot be established during the initial communication with the SMTP server. » *(§ Ensure TLS)*

**Question 21 : A** — « you can enforce binding to a specific protocol or IP address by using the `source_ip` option. (…) As per RFC2732, IPv6 addresses must be enclosed in square brackets: `?source_ip=[::]` » *(§ Binding to IPv4 or IPv6)*

**Question 22 : A** — « This can be done from `EsmtpTransport` constructor or using the `setAuthenticators()` method. » *(§ Overriding default SMTP authenticators)*

**Question 23 : B** — « `restart_threshold` — The maximum number of messages to send before re-starting the transport. (…) `restart_threshold_sleep` — The number of seconds to sleep between stopping and re-starting the transport. » *(§ Other Options)*

**Question 24 : A** — « `max_per_second` — The number of messages to send per second (0 to disable this limitation). » *(§ Other Options)*

**Question 25 : A** — « create a class that implements `TransportFactoryInterface` or, if you prefer, extend the `AbstractTransportFactory` class to save some boilerplate code. » *(§ Custom Transport Factories)*

**Question 26 : A** — « register it as a service in your application and tag it with the `mailer.transport_factory` tag. » *(§ Custom Transport Factories)*

**Question 27 : A** — « get a `Mailer` instance by type-hinting `MailerInterface` and create an `Email` object (…) `$mailer->send($email);` » *(§ Creating & Sending Messages)*

**Question 28 : B** — « All the methods that require email addresses (`from()`, `to()`, etc.) accept both strings or address objects. » *(§ Email Addresses)*

**Question 29 : B** — « Use `addTo()`, `addCc()`, or `addBcc()` methods to add more addresses. » — ou en passant plusieurs adresses directement à `cc()`. *(§ Email Addresses)*

**Question 30 : B** — « non-ASCII characters are supported both in the local part and the domain; if the SMTP server doesn't support this feature, you'll see an exception. » *(§ Email Addresses)*

**Question 31 : A** — « `->getHeaders()->addTextHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply')` » *(§ Message Headers)*

**Question 32 : B** — « The text and HTML contents of the email messages can be strings (usually the result of rendering some template) or PHP resources. » *(§ Message Contents)*

**Question 33 : B** — « Use the `addPart()` method with a `File` to add files that exist on your file system (…) optionally you can tell email clients to display a custom name for the file. » *(§ File Attachments)*

**Question 34 : A** — « Use the `asInline()` method to embed the content instead of attaching it. (…) reference images using the syntax 'cid:' + "image embed name" » *(§ Embedding Images)*

**Question 35 : B** — « The actual Content-ID value present in the e-mail source will be randomly generated by Symfony. You can also use the `DataPart::setContentId()` method to define a custom Content-ID (…) the Content-ID value must include at least one '@' character. » *(§ Embedding Images)*

**Question 36 : A** — configuration `framework.mailer.envelope` (`sender`/`recipients`) et `framework.mailer.headers`, pour « configure this value globally so that it is set on all sent emails ». *(§ Configuring Emails Globally)*

**Question 37 : B** — « Some third-party providers don't support the usage of keywords like `from` in the `headers`. Check out your provider's documentation before setting any global header. » *(§ Configuring Emails Globally)*

**Question 38 : B** — « Symfony Mailer considers that sending was successful when your transport (SMTP server or third-party provider) accepts the mail for further delivery. The message can later be lost or not delivered because of some problem in your provider, but that's out of reach for your Symfony application. » *(§ Handling Sending Failures)*

**Question 39 : A** — « If there's an error when handing over the email to your transport, Symfony throws a `TransportExceptionInterface`. » *(§ Handling Sending Failures)*

**Question 40 : A** — « The `send()` method of the mailer service injected when using `MailerInterface` doesn't return anything (…) This is because it sends email messages **asynchronously** when the Messenger component is used (…) replace `MailerInterface` with `TransportInterface`. » *(§ Debugging Emails)*

**Question 41 : B** — « The `send()` method of `TransportInterface` returns an object of type `SentMessage`. This is because it always sends the emails **synchronously**, even if your application uses the Messenger component. » *(§ Debugging Emails)*

**Question 42 : A** — « The `SentMessage` object provides access to the original message (`getOriginalMessage()`) and to some debug information (`getDebug()`) such as the HTTP calls done by the HTTP transports, which is useful to debug errors. » *(§ Debugging Emails)*

**Question 43 : A** — « use the `TemplatedEmail` class. This class extends the normal `Email` class but adds some new methods for Twig templates. » *(§ HTML Content)*

**Question 44 : A** — « pass variables (name => value) to the template » via `->context(['expiration_date' => ..., 'username' => ...])`. *(§ HTML Content)*

**Question 45 : B** — « The Twig template has access to any of the parameters passed in the `context()` method (…) and also to a special variable called `email`, which is an instance of `WrappedTemplatedEmail`. » *(§ HTML Content)*

**Question 46 : A** — « If an explicit HTML to text converter has been configured (…), it calls it; If not, and if you have `league/html-to-markdown` installed (…), it uses it (…); Otherwise, it applies the `strip_tags` PHP function to the original HTML contents. » *(§ Text Content)*

**Question 47 : A** — « the `textTemplate()` method provided by the `TemplatedEmail` class » *(§ Text Content)*

**Question 48 : B** — « define a Twig namespace called `images` that points to whatever directory your images are stored in (…) use the special `email.image()` Twig helper to embed the images inside the email contents. » *(§ Embedding Images — intégration Twig)*

**Question 49 : A** — « popular email clients like Gmail don't support defining styles inside `<style> ... </style>` sections and you must **inline all the CSS styles**. (…) Twig provides a `CssInlinerExtension` (…) wrap the entire template with the `inline_css` filter. » *(§ Inlining CSS Styles)*

**Question 50 : A** — « You can also define CSS styles in external files and pass them as arguments to the filter » : `{% apply inline_css(source('@styles/email.css')) %}`. *(§ Inlining CSS Styles — Using External CSS Files)*

**Question 51 : A** — « Twig provides another extension called `MarkdownExtension` that lets you define the email contents using Markdown syntax. (…) The extension adds a `markdown_to_html` filter. » *(§ Rendering Markdown Content)*

**Question 52 : A** — « It defines a syntax based on some HTML-like tags which are later transformed into the real HTML code sent to users (…) Twig provides integration with Inky via the `InkyExtension`. (…) The extension adds an `inky_to_html` filter. » *(§ Inky Email Templating Language)*

**Question 53 : A** — « Before signing/encrypting messages, make sure to have: The OpenSSL PHP extension properly installed and configured; A valid S/MIME security certificate. » *(§ Signing and Encrypting Messages)*

**Question 54 : A** — « When signing a message, a cryptographic hash is generated for the entire content of the message (…). However, the contents of the original message are still readable for mailing agents not supporting signed messages, so you must also encrypt the message if you want to hide its contents. » *(§ Signing Messages)*

**Question 55 : A** — « If you use message signature, sending to `Bcc` will be removed from the message. If you need to send a message to multiple recipients, you need to compute a new signature for each recipient. » *(§ Signing Messages)*

**Question 56 : A** — « `new SMimeSigner('/path/to/certificate.crt', '/path/to/certificate-private-key.key');` » *(§ S/MIME Signer)*

**Question 57 : A** — « second and third arguments: the domain name and "selector" used to perform a DNS lookup » — `new DkimSigner('file:///path/to/private-key.key', 'example.com', 'sf');` *(§ DKIM Signer)*

**Question 58 : B** — configuration `dkim_signer` (`key`/`domain`/`select`) et `smime_signer` (`key`/`certificate`/`passphrase`) sous `framework.mailer`, pour appliquer une signature « globally (…) to all outgoing messages ». *(§ Signing Messages Globally)*

**Question 59 : B** — « only the recipients that have the corresponding private key can read the original message contents. » *(§ Encrypting Messages)*

**Question 60 : B** — « You can pass more than one certificate to the `SMimeEncrypter` constructor and it will select the appropriate certificate depending on the `To` option. » *(§ Encrypting Messages)*

**Question 61 : B** — configuration `smime_encrypter.repository`, pointant vers un service qui « implements `SmimeCertificateRepositoryInterface` ». *(§ Encrypting Messages Globally)*

**Question 62 : B** — « This interface requires only one method: `findCertificatePathFor()`, which must return the file path to the certificate associated with the given email address. » *(§ Encrypting Messages Globally)*

**Question 63 : A** — « This can be configured by replacing the `dsn` configuration entry with a `transports` entry » : `transports: { main: '%env(MAILER_DSN)%', alternative: '%env(MAILER_DSN_IMPORTANT)%' }`. *(§ Multiple Email Transports)*

**Question 64 : A** — « By default the first transport is used. The other transports can be selected by adding an `X-Transport` header (which Mailer will remove automatically from the final email). » *(§ Multiple Email Transports)*

**Question 65 : A** — « When you call `$mailer->send($email)`, the email is sent to the transport immediately. » *(§ Sending Messages Async)*

**Question 66 : A** — « a `Symfony\Component\Mailer\Messenger\SendEmailMessage` message will be dispatched through the default message bus (`messenger.default_bus`). » *(§ Sending Messages Async)*

**Question 67 : B** — « Note that the "rendering" of the email (computed headers, body rendering, ...) is also deferred and will only happen just before the email is sent by the Messenger handler. » *(§ Sending Messages Async)*

**Question 68 : A** — « its instance must be serializable (…) If you have non-serializable variables, like Doctrine entities, either replace them with more specific variables or render the email before calling `$mailer->send($email)` », via `BodyRendererInterface::render()`. *(§ Sending Messages Async)*

**Question 69 : A** — « You can configure which bus is used to dispatch the message using the `message_bus` option. You can also set this to `false` to call the Mailer transport directly and disable asynchronous delivery. » *(§ Sending Messages Async)*

**Question 70 : A** — « you may manually disconnect from the SMTP server to avoid keeping an open connection (…). You can do so by using the `stop()` method. » *(§ Sending Messages Async)*

**Question 71 : A** — « You can add those by using the `TagHeader` and `MetadataHeader` classes. » *(§ Adding Tags and Metadata to Emails)*

**Question 72 : B** — « If your transport does not support tags and metadata, they will be added as custom headers: `X-Tag: password-reset`, `X-Metadata-Color: blue`… » *(§ Adding Tags and Metadata to Emails)*

**Question 73 : B** — « Amazon SES (note that Amazon refers to this feature as "tags", but Symfony calls it "metadata" because it contains a key and a value). » *(§ Adding Tags and Metadata to Emails)*

**Question 74 : A** — « Its purpose is to build up an email (with body, attachments, etc) and make available to download as an `.eml` with the `X-Unsent` header. » *(§ Draft Emails)*

**Question 75 : B** — « As it's possible for `DraftEmail`'s to be created without a To/From they cannot be sent with the mailer. » *(§ Draft Emails)*

**Question 76 : A** — « `MessageEvent` allows changing the Mailer message and the envelope before the email is sent. (…) If you want to stop the Message from being sent, call `reject()` (it will also stop the event propagation). » *(§ MessageEvent)*

**Question 77 : A** — « Execute this command to find out which listeners are registered for this event and their priorities: `$ php bin/console debug:event-dispatcher "Symfony\Component\Mailer\Event\MessageEvent"` » *(§ MessageEvent)*

**Question 78 : A** — « `SentMessageEvent` allows you to act on the `SentMessage` class to access the original message (`getOriginalMessage()`) and some debugging information (`getDebug()`) such as the HTTP calls made by the HTTP transports. » *(§ SentMessageEvent)*

**Question 79 : A** — « `FailedMessageEvent` allows acting on the initial message in case of a failure and some debugging information (`getDebug()`) (…) `if ($error instanceof TransportExceptionInterface) { $error->getDebug(); }` » *(§ FailedMessageEvent)*

**Question 80 : B** — les trois événements se gèrent comme n'importe quel autre événement Symfony, via `EventSubscriberInterface`, sans configuration additionnelle documentée. *(§ Mailer Events)*

**Question 81 : B** — « If you have enabled Docker support via Symfony recipes, an email catcher is automatically configured. » *(§ Enabling an Email Catcher)*

**Question 82 : A** — « `$ php bin/console mailer:test someone@example.com` — the only mandatory argument is the recipient address ». *(§ Sending Test Emails)*

**Question 83 : B** — « This command bypasses the Messenger bus, if configured, to ease testing emails even when the Messenger consumer is not running. » *(§ Sending Test Emails)*

**Question 84 : A** — « you may want to disable delivery of messages entirely. You can do this by using `null://null` as the mailer DSN. » *(§ Disabling Delivery)*

**Question 85 : B** — « If you're using Messenger and routing to a transport, the message will *still* be sent to that transport. » *(§ Disabling Delivery)*

**Question 86 : A** — configuration `framework.mailer.envelope.recipients: ['youremail@example.com']`, pour « *always* send emails to a specific address, instead of the *real* address ». *(§ Always Send to the same Address)*

**Question 87 : A** — « Use the `allowed_recipients` option to define specific addresses that should still receive their original emails. These messages will also be sent to the address(es) defined in `recipients`, as with all other emails. » *(§ Always Send to the same Address)*

**Question 88 : A** — « Symfony provides lots of built-in mailer assertions to functionally test that an email was sent, its contents or headers, etc. They are available in test classes extending `KernelTestCase` or when using (…) `MailerAssertionsTrait`. » — ex. `assertEmailCount()`, `assertEmailHtmlBodyContains()`. *(§ Write a Functional Test)*
