# QCM — Le déploiement

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/deployment.html](https://symfony.com/doc/8.0/deployment.html) et la page de sa section [Learn More](https://symfony.com/doc/8.0/deployment.html#learn-more) · **Généré le :** 24 juillet 2026
>
> **40 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Symfony Deployment Basics

### Question 1

Quelles sont les étapes typiques d'un déploiement Symfony ? *(plusieurs bonnes réponses)*

- [ ] **A.** Uploader le code vers le serveur de production
- [ ] **B.** Installer les dépendances vendor (typiquement via Composer)
- [ ] **C.** Exécuter les migrations de base de données ou tâches similaires
- [ ] **D.** Générer automatiquement un certificat SSL

### Question 2

Quelle est la quatrième étape typique listée par la documentation, après upload, dépendances et migrations ? *(une seule bonne réponse)*

- [ ] **A.** Exécuter les tests unitaires
- [ ] **B.** Vider (et éventuellement réchauffer) le cache
- [ ] **C.** Redémarrer le serveur web
- [ ] **D.** Envoyer une notification Slack

### Question 3

Parmi les tâches additionnelles de déploiement mentionnées, lesquelles sont citées ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tagger une version du code comme release dans le contrôle de source
- [ ] **B.** Créer une zone de staging temporaire pour construire hors-ligne
- [ ] **C.** Chiffrer automatiquement la base de données
- [ ] **D.** Vider les systèmes de cache externes (Memcached, Redis)

## How to Deploy a Symfony Application

### Question 4

Quel est le principal inconvénient du transfert de fichiers basique (FTP/SCP) ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne pas avec Symfony
- [ ] **B.** Il nécessite un abonnement payant
- [ ] **C.** Le manque de contrôle sur le système pendant la mise à niveau
- [ ] **D.** Il est plus lent que Git

### Question 5

Avec le contrôle de source (Git/SVN), quelle approche courante est recommandée pour chaque release ? *(une seule bonne réponse)*

- [ ] **A.** Créer une nouvelle branche pour chaque déploiement
- [ ] **B.** Forcer un rebase avant chaque déploiement
- [ ] **C.** Supprimer l'historique Git avant transfert
- [ ] **D.** Créer un tag pour chaque release et checkout le tag approprié au déploiement

### Question 6

Quelle plateforme (PaaS) la documentation recommande-t-elle explicitement ? *(une seule bonne réponse)*

- [ ] **A.** AWS Elastic Beanstalk
- [ ] **B.** Vercel
- [ ] **C.** Upsun
- [ ] **D.** Heroku

### Question 7

Quel outil écrit en PHP fournit des recettes prêtes à l'emploi pour les tâches de déploiement Symfony courantes ? *(une seule bonne réponse)*

- [ ] **A.** Terraform
- [ ] **B.** Deployer
- [ ] **C.** Ansible
- [ ] **D.** Capistrano

## Common Deployment Tasks

### Question 8

Quel package installer pour vérifier les prérequis techniques sur un serveur de production sans installer Symfony CLI ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/preflight`
- [ ] **B.** `symfony/system-check`
- [ ] **C.** `symfony/requirements-checker`
- [ ] **D.** `symfony/health-check`

### Question 9

Sur production, quelles sont les deux options documentées pour gérer les variables d'environnement ? *(plusieurs bonnes réponses)*

- [ ] **A.** Créer de « vraies » variables d'environnement système
- [ ] **B.** Créer un fichier `.env.prod.local` avec les valeurs spécifiques à la production
- [ ] **C.** Stocker les secrets directement dans le code source
- [ ] **D.** Utiliser exclusivement un service tiers de gestion de secrets

### Question 10

Quelle commande génère un fichier `.env.local.php` optimisé qui surcharge toutes les autres configurations ? *(une seule bonne réponse)*

- [ ] **A.** `composer env:compile prod`
- [ ] **B.** `php bin/console env:dump prod`
- [ ] **C.** `composer install --env=prod`
- [ ] **D.** `composer dump-env prod`

### Question 11

Comment générer un `.env.local.php` sans aucune valeur, pour ne dépendre que des vraies variables d'environnement ? *(une seule bonne réponse)*

- [ ] **A.** `composer dump-env prod --strict`
- [ ] **B.** `composer dump-env --production`
- [ ] **C.** `composer dump-env prod --empty`
- [ ] **D.** `composer dump-env prod --no-values`

### Question 12

Si Composer n'est pas installé sur le serveur de production, quelle alternative est proposée pour `dump-env` ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser un script bash personnalisé, aucune commande Symfony n'existe
- [ ] **B.** Installer temporairement Composer, aucune alternative n'existe
- [ ] **C.** La commande Symfony `dotenv:dump`
- [ ] **D.** Copier manuellement le fichier `.env`

### Question 13

Quelle commande met à jour les vendors pour la production ? *(une seule bonne réponse)*

- [ ] **A.** `composer update --production`
- [ ] **B.** `composer install --prod`
- [ ] **C.** `composer require --no-dev`
- [ ] **D.** `composer install --no-dev --optimize-autoloader`

### Question 14

À quoi sert le flag `--optimize-autoloader` de Composer ? *(une seule bonne réponse)*

- [ ] **A.** Il supprime les dépendances inutilisées
- [ ] **B.** Il compresse les fichiers PHP
- [ ] **C.** Il génère automatiquement le cache Symfony
- [ ] **D.** Il améliore significativement les performances de l'autoloader en construisant une « class map »

### Question 15

Que faire si une erreur « class not found » apparaît lors de l'installation des vendors en production ? *(une seule bonne réponse)*

- [ ] **A.** Réinstaller PHP entièrement
- [ ] **B.** Désactiver Composer et copier `vendor/` manuellement
- [ ] **C.** Ignorer l'erreur, elle est sans conséquence
- [ ] **D.** Exécuter `export APP_ENV=prod` avant la commande, pour que les scripts `post-install-cmd` s'exécutent dans le bon environnement

### Question 16

Quelle commande vide (et réchauffe) le cache Symfony en production ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console cache:flush --prod`
- [ ] **B.** `APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear`
- [ ] **C.** `php bin/console cache:warmup --env=prod`
- [ ] **D.** `composer cache:clear`

### Question 17

Parmi les « autres choses » possibles listées après un déploiement, lesquelles sont citées ? *(plusieurs bonnes réponses)*

- [ ] **A.** Exécuter les migrations de base de données
- [ ] **B.** Vider le cache APCu
- [ ] **C.** Réinitialiser tous les mots de passe utilisateurs
- [ ] **D.** Redémarrer les workers

### Question 18

Que peut-il être nécessaire de faire spécifiquement si l'on utilise le composant AssetMapper, comme tâche de déploiement ? *(une seule bonne réponse)*

- [ ] **A.** Redémarrer les workers
- [ ] **B.** Compiler ses assets
- [ ] **C.** Désinstaller Webpack Encore
- [ ] **D.** Ajouter des jobs CRON

### Question 19

Que peut-on faire concernant les pages d'erreur, comme tâche de déploiement optionnelle ? *(une seule bonne réponse)*

- [ ] **A.** Les traduire automatiquement dans toutes les langues
- [ ] **B.** Les remplacer par une redirection vers une page tierce
- [ ] **C.** Les dumper en fichiers HTML statiques
- [ ] **D.** Les supprimer entièrement de l'application

### Question 20

Sur une plateforme d'hébergement mutualisé utilisant Apache, quel package peut-il être nécessaire d'installer ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/webserver-bundle`
- [ ] **B.** `symfony/apache-bridge`
- [ ] **C.** `symfony/apache-pack`
- [ ] **D.** `symfony/nginx-pack`

## Application Lifecycle: Continuous Integration, QA, etc.

### Question 21

Que recommande fortement la documentation concernant le cycle de vie complet d'une application (au-delà du simple déploiement technique) ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'utilisation d'un environnement de staging et de QA
- [ ] **B.** L'intégration continue
- [ ] **C.** La possibilité de rollback en cas d'échec
- [ ] **D.** La suppression de tous les tests automatisés pour accélérer le déploiement

## Troubleshooting

### Question 22

Comment le répertoire racine du projet (`kernel.project_dir`) est-il normalement calculé par Symfony ? *(une seule bonne réponse)*

- [ ] **A.** À partir d'une variable d'environnement `APP_ROOT_DIR` obligatoire
- [ ] **B.** À partir du fichier `.env` uniquement
- [ ] **C.** Automatiquement, comme le répertoire où se trouve le fichier `composer.json` principal
- [ ] **D.** Toujours `/var/www/html`, en dur

### Question 23

Que faut-il faire si le déploiement n'utilise pas de fichier `composer.json` ? *(une seule bonne réponse)*

- [ ] **A.** Créer un fichier `composer.json` vide comme leurre
- [ ] **B.** Définir une constante PHP `PROJECT_DIR` globale
- [ ] **C.** Surcharger la méthode `Kernel::getProjectDir()`
- [ ] **D.** Symfony ne peut tout simplement pas fonctionner sans `composer.json`

## Solution: setTrustedProxies()

### Question 24

Quel problème se pose quand une requête passe par un proxy sans configuration adaptée ? *(une seule bonne réponse)*

- [ ] **A.** Les sessions PHP ne fonctionnent plus du tout
- [ ] **B.** Symfony obtient des informations incorrectes sur l'IP du client, le protocole HTTPS, le port et le hostname
- [ ] **C.** La requête est systématiquement rejetée avec une erreur 502
- [ ] **D.** Le cache HTTP est désactivé automatiquement

### Question 25

Quels en-têtes standard transportent l'IP réelle du client à travers un proxy ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'en-tête standard `Forwarded`
- [ ] **B.** Les en-têtes `X-Forwarded-*`
- [ ] **C.** L'en-tête `REMOTE_ADDR` (qui reste toujours celle du client)
- [ ] **D.** L'en-tête `Content-Length`

### Question 26

Quelles variables d'environnement permettent de configurer les proxies de confiance sans passer par la configuration YAML ? *(plusieurs bonnes réponses)*

- [ ] **A.** `SYMFONY_TRUSTED_PROXIES`
- [ ] **B.** `SYMFONY_TRUSTED_HEADERS`
- [ ] **C.** `SYMFONY_PROXY_MODE`
- [ ] **D.** `SYMFONY_FORWARDED_FOR`

### Question 27

Que permet le raccourci `'private_ranges'` pour `trusted_proxies` ? *(une seule bonne réponse)*

- [ ] **A.** De faire confiance uniquement à `localhost` (127.0.0.1)
- [ ] **B.** De faire confiance aux plages d'adresses IP privées
- [ ] **C.** De faire confiance à toutes les IP sans exception
- [ ] **D.** De désactiver la vérification de proxy

### Question 28

Quel risque comporte l'activation de l'option `Request::HEADER_X_FORWARDED_HOST` ? *(une seule bonne réponse)*

- [ ] **A.** Bloquer les requêtes provenant de proxies légitimes
- [ ] **B.** Exposer l'application à des attaques HTTP Host header
- [ ] **C.** Ralentir chaque requête de façon significative
- [ ] **D.** Désactiver le cache HTTP

### Question 29

Avec quel module doit-on éviter d'utiliser la fonctionnalité « trusted proxies » de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Le module OPcache de PHP
- [ ] **B.** Le module `ssl_module` de nginx
- [ ] **C.** Le module `realip` de nginx
- [ ] **D.** Le module `mod_rewrite` d'Apache

## But what if the IP of my Reverse Proxy Changes Constantly!

### Question 30

Que faut-il faire en premier si l'IP du reverse proxy change constamment (ex : AWS Elastic Load Balancing) ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver complètement le trusted proxy
- [ ] **B.** Changer de fournisseur cloud
- [ ] **C.** Ignorer le problème, Symfony gère cela automatiquement
- [ ] **D.** Configurer les serveurs web pour ne répondre qu'au trafic provenant des load balancers (ex : security groups AWS)

### Question 31

Comment configure-t-on Symfony pour faire confiance à toutes les requêtes entrantes, une fois le trafic garanti sécurisé ? *(une seule bonne réponse)*

- [ ] **A.** `trusted_proxies: 'ANY_IP'`
- [ ] **B.** `trusted_proxies: '127.0.0.1,REMOTE_ADDR'`
- [ ] **C.** `trusted_proxies: 'ALL'`
- [ ] **D.** `trusted_proxies: '*'`

### Question 32

Que remplace la chaîne `PRIVATE_SUBNETS` à l'exécution ? *(une seule bonne réponse)*

- [ ] **A.** Une liste vide, désactivant le trusted proxy
- [ ] **B.** L'adresse IP publique du serveur
- [ ] **C.** La constante `IpUtils::PRIVATE_SUBNETS`
- [ ] **D.** La valeur de `$_SERVER['REMOTE_ADDR']`

### Question 33

Si un reverse proxy supplémentaire est ajouté au-dessus du load balancer (ex : CloudFront), que faut-il faire ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver CloudFront, incompatible avec Symfony
- [ ] **B.** Utiliser exclusivement `$request->server->get('REMOTE_ADDR')` sans configuration supplémentaire
- [ ] **C.** Ajouter les plages d'IP de ce proxy supplémentaire à la liste des trusted proxies
- [ ] **D.** Rien, le load balancer suffit toujours

## Reverse proxy in a subpath / subfolder

### Question 34

Quel en-tête permet de corriger la génération d'URL quand l'application est servie sous un sous-dossier via un reverse proxy ? *(une seule bonne réponse)*

- [ ] **A.** `X-Forwarded-Path`
- [ ] **B.** `X-Base-Path`
- [ ] **C.** `X-Forwarded-Root`
- [ ] **D.** `X-Forwarded-Prefix`

### Question 35

Que faut-il faire pour que `X-Forwarded-Prefix` soit pris en compte par Symfony ? *(une seule bonne réponse)*

- [ ] **A.** L'ajouter dans le fichier `.htaccess`
- [ ] **B.** Rien, il est pris en compte automatiquement sans configuration
- [ ] **C.** Désactiver le cache HTTP
- [ ] **D.** Le configurer comme en-tête de confiance (trusted header)

### Question 36

Sans l'en-tête `X-Forwarded-Prefix`, comment Symfony détermine-t-il la base URL ? *(une seule bonne réponse)*

- [ ] **A.** À partir d'un fichier de configuration YAML obligatoire
- [ ] **B.** À partir de la variable `APP_URL`
- [ ] **C.** Il ne peut tout simplement pas démarrer
- [ ] **D.** Uniquement à partir de la configuration du serveur web exécutant Symfony

## Custom Headers When Using a Reverse Proxy

### Question 37

Quand un reverse proxy utilise un en-tête personnalisé (ex : `Custom-Forwarded-Proto` au lieu de `X-Forwarded-Proto`), que faut-il faire ? *(une seule bonne réponse)*

- [ ] **A.** Modifier le code source du composant HttpFoundation
- [ ] **B.** Réaffecter la valeur à `$_SERVER['HTTP_X_FORWARDED_PROTO']` avant que la requête soit gérée par le kernel
- [ ] **C.** Configurer directement `Custom-Forwarded-Proto` comme trusted header
- [ ] **D.** Ce cas n'est pas supporté par Symfony

## Overriding Configuration Behind Hidden SSL Termination

### Question 38

Dans quel cas la fonctionnalité « trusted proxy » de Symfony ne suffit-elle pas pour détecter HTTPS ? *(une seule bonne réponse)*

- [ ] **A.** Quand APCu n'est pas installé
- [ ] **B.** Quand le proxy fait la terminaison SSL sans changer l'adresse distante ni définir les en-têtes `X-Forwarded-*`
- [ ] **C.** Quand le certificat SSL est auto-signé
- [ ] **D.** Quand Symfony tourne en mode debug

### Question 39

Comment contourner ce problème via la configuration Nginx, selon l'exemple documenté ? *(une seule bonne réponse)*

- [ ] **A.** En désactivant complètement le trusted proxy
- [ ] **B.** En forçant une redirection 301 vers HTTPS côté Nginx
- [ ] **C.** En définissant `fastcgi_param HTTPS "on"` pour indiquer à Symfony le bon protocole
- [ ] **D.** En installant un certificat SSL directement sur le serveur d'application

### Question 40

Quelle précaution doit être prise avant d'utiliser cette technique consistant à indiquer un faux protocole à Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser exclusivement Apache, jamais Nginx
- [ ] **B.** S'assurer que le serveur n'est joignable que via le proxy cloud en HTTPS, jamais directement en HTTP
- [ ] **C.** Désactiver tous les logs d'accès
- [ ] **D.** Configurer un second reverse proxy en parallèle

---

## Corrigé

**Question 1 : A, B, C** — « The typical steps taken while deploying a Symfony application include: Upload your code (…) Install your vendor dependencies (…) Running database migrations or similar tasks (…) » *(§ Symfony Deployment Basics)*

**Question 2 : B** — « Clearing (and optionally, warming up) your cache. » *(§ Symfony Deployment Basics)*

**Question 3 : A, B, D** — « Tagging a particular version of your code as a release (…) Creating a temporary staging area to build your updated setup "offline" (…) Clearing of external cache systems (like Memcached or Redis). » *(§ Symfony Deployment Basics)*

**Question 4 : C** — « This has its disadvantages as you lack control over the system as the upgrade progresses. » *(§ Basic File Transfer)*

**Question 5 : D** — « When using Git, a common approach is to create a tag for each release and check out the appropriate tag on deployment. » *(§ Using Source Control)*

**Question 6 : C** — « we recommend Upsun as it provides a dedicated Symfony integration and helps fund the Symfony development. » *(§ Using Platforms as a Service)*

**Question 7 : B** — « Deployer is a deployment tool written in PHP that provides ready-to-use recipes for common Symfony deployment tasks. » *(§ Using Build Scripts and other Tools)*

**Question 8 : C** — « install this other package in your application: `$ composer require symfony/requirements-checker`. » *(§ A) Check Requirements)*

**Question 9 : A, B** — « Create "real" environment variables (…) Or, create a `.env.prod.local` file that contains values specific to your production environment. » *(§ B) Configure your Environment Variables)*

**Question 10 : D** — « You can generate an optimized `.env.local.php` (…) `$ composer dump-env prod`. » *(§ B) Configure your Environment Variables)*

**Question 11 : C** — « If you want to rely only on environment variables, generate one without any values using: `$ composer dump-env prod --empty`. » *(§ B) Configure your Environment Variables)*

**Question 12 : C** — « If you don't have Composer installed on the production server, use instead the `dotenv:dump` Symfony command. » *(§ B) Configure your Environment Variables)*

**Question 13 : D** — « $ composer install --no-dev --optimize-autoloader » *(§ C) Install/Update your Vendors)*

**Question 14 : D** — « The `--optimize-autoloader` flag improves Composer's autoloader performance significantly by building a "class map". » *(§ C) Install/Update your Vendors)*

**Question 15 : D** — « you may need to run `export APP_ENV=prod` (…) before running this command so that the `post-install-cmd` scripts run in the `prod` environment. » *(§ C) Install/Update your Vendors)*

**Question 16 : B** — « $ APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear » *(§ D) Clear your Symfony Cache)*

**Question 17 : A, B, D** — « Running any database migrations (…) Clearing your APCu cache (…) Restarting your workers. » *(§ E) Other Things!)*

**Question 18 : B** — « Compile your assets if you're using the AssetMapper component. » *(§ E) Other Things!)*

**Question 19 : C** — « Dumping error pages as static HTML files. » *(§ E) Other Things!)*

**Question 20 : C** — « On a shared hosting platform using the Apache web server, you may need to install the `symfony/apache-pack` package. » *(§ E) Other Things!)*

**Question 21 : A, B, C** — « The use of staging, testing, QA, continuous integration, database migrations and the capability to roll back in case of failure are all strongly advised. » *(§ Application Lifecycle: Continuous Integration, QA, etc.)*

**Question 22 : C** — « is calculated automatically by Symfony as the directory where the main `composer.json` file is stored. » *(§ Deployments not Using the composer.json File)*

**Question 23 : C** — « you'll need to override the `Kernel::getProjectDir()` method. » *(§ Deployments not Using the composer.json File)*

**Question 24 : B** — « If you don't configure Symfony to look for these headers, you'll get incorrect information about the client's IP address, whether or not the client is connecting via HTTPS, the client's port and the hostname being requested. » *(§ Solution: setTrustedProxies())*

**Question 25 : A, B** — « certain request information is sent using either the standard `Forwarded` header or `X-Forwarded-*` headers. » *(§ Solution: setTrustedProxies())*

**Question 26 : A, B** — « You can do that by setting the `SYMFONY_TRUSTED_PROXIES` and `SYMFONY_TRUSTED_HEADERS` environment variables. » *(§ Solution: setTrustedProxies())*

**Question 27 : B** — « # shortcut for private IP address ranges of your proxy `trusted_proxies: 'private_ranges'`. » *(§ Solution: setTrustedProxies())*

**Question 28 : B** — « Enabling the `Request::HEADER_X_FORWARDED_HOST` option exposes the application to HTTP Host header attacks. » *(§ Solution: setTrustedProxies())*

**Question 29 : C** — « The "trusted proxies" feature does not work as expected when using the nginx realip module. Disable that module. » *(§ Solution: setTrustedProxies())*

**Question 30 : D** — « Configure your web server(s) to *not* respond to traffic from *any* clients other than your load balancers. For AWS, this can be done with security groups. » *(§ But what if the IP of my Reverse Proxy Changes Constantly!)*

**Question 31 : B** — « trust *all* requests (…) `trusted_proxies: '127.0.0.1,REMOTE_ADDR'`. » *(§ But what if the IP of my Reverse Proxy Changes Constantly!)*

**Question 32 : C** — « the 'PRIVATE_SUBNETS' string, which is replaced at runtime by the `IpUtils::PRIVATE_SUBNETS` constant. » *(§ But what if the IP of my Reverse Proxy Changes Constantly!)*

**Question 33 : C** — « You also need to append the IP addresses or ranges of any additional proxy (e.g. CloudFront IP ranges) to the array of trusted proxies. » *(§ But what if the IP of my Reverse Proxy Changes Constantly!)*

**Question 34 : D** — « you need to pass the subpath/subfolder route prefix of the reverse proxy to Symfony by setting the `X-Forwarded-Prefix` header. » *(§ Reverse proxy in a subpath / subfolder)*

**Question 35 : D** — « Configure `X-Forwarded-Prefix` as trusted header to be able to use this feature. » *(§ Reverse proxy in a subpath / subfolder)*

**Question 36 : D** — « Without the header, the base URL would be only determined based on the configuration of the web server running Symfony. » *(§ Reverse proxy in a subpath / subfolder)*

**Question 37 : B** — « you'll need to set the header `X-Forwarded-Proto` with the value of `Custom-Forwarded-Proto` early enough in your application, i.e. before handling the request: `$_SERVER['HTTP_X_FORWARDED_PROTO'] = $_SERVER['HTTP_CUSTOM_FORWARDED_PROTO'];`. » *(§ Custom Headers When Using a Reverse Proxy)*

**Question 38 : B** — « do SSL termination and contact your web server over HTTP, but do not change the remote address nor set the `X-Forwarded-*` headers. This means the trusted proxy feature of Symfony can't help you. » *(§ Overriding Configuration Behind Hidden SSL Termination)*

**Question 39 : C** — « fastcgi_param SERVER_PORT "443"; fastcgi_param HTTPS "on"; # Lie to Symfony about the protocol and port » *(§ Overriding Configuration Behind Hidden SSL Termination)*

**Question 40 : B** — « Once you made sure your server is only reachable through the cloud proxy over HTTPS and not through HTTP, you can override the information your web server sends to PHP. » *(§ Overriding Configuration Behind Hidden SSL Termination)*

## Pour aller plus loin

Une seule page dans la section [Learn More](https://symfony.com/doc/8.0/deployment.html#learn-more) de la page :

- [How to Configure Symfony to Work behind a Load Balancer or a Reverse Proxy](https://symfony.com/doc/8.0/deployment/proxies.html)
