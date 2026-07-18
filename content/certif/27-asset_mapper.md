# QCM — AssetMapper

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/frontend/asset_mapper.html](https://symfony.com/doc/8.0/frontend/asset_mapper.html) · **Généré le :** 22 juillet 2026
>
> **109 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Vue d'ensemble

### Question 1

Quelles sont les deux fonctionnalités principales du composant AssetMapper ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le mapping et le versionnement des assets
- [ ] **B.** Les importmaps
- [ ] **C.** La minification automatique du JavaScript
- [ ] **D.** La combinaison (bundling) des fichiers en un seul

### Question 2

Pourquoi la documentation affirme-t-elle que combiner les assets pour réduire le nombre de requêtes HTTP n'est plus une urgence aujourd'hui ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les CDN combinent automatiquement les fichiers à la volée
- [ ] **B.** Grâce au protocole HTTP/2, qui permet de télécharger les assets en parallèle
- [ ] **C.** Parce que les navigateurs limitent désormais le nombre de connexions à un seul fichier
- [ ] **D.** Parce que tous les navigateurs supportent nativement la minification

## Installation

### Question 3

Quelle commande installe le composant AssetMapper avec ses dépendances recommandées ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/webpack-encore-bundle`
- [ ] **B.** `composer require symfony/asset-mapper symfony/asset symfony/twig-pack`
- [ ] **C.** `composer require symfony/asset-mapper` seul, sans autre dépendance
- [ ] **D.** `npm install @symfony/asset-mapper`

### Question 4

Quels fichiers la recette Symfony Flex ajoute-t-elle automatiquement à l'installation d'AssetMapper ? *(plusieurs bonnes réponses)*

- [ ] **A.** `assets/app.js` et `assets/styles/app.css`
- [ ] **B.** `config/packages/asset_mapper.yaml`
- [ ] **C.** `importmap.php`
- [ ] **D.** `webpack.config.js`

### Question 5

Quel fichier la recette Flex met-elle à jour pour appeler la fonction Twig `importmap()` ? *(une seule bonne réponse)*

- [ ] **A.** `config/routes.yaml`
- [ ] **B.** `public/index.php`
- [ ] **C.** `templates/layout/head.html.twig`
- [ ] **D.** `templates/base.html.twig`

### Question 6

Si l'on n'utilise pas Symfony Flex, comment obtenir le contenu exact des fichiers générés par l'installation d'AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans Flex, l'installation manuelle n'étant pas documentée
- [ ] **B.** En exécutant `bin/console make:asset-mapper`
- [ ] **C.** En copiant les fichiers d'un projet Symfony Demo
- [ ] **D.** En consultant la dernière recette `asset-mapper` sur le dépôt des recettes Symfony

## Mapping et référencement des assets

### Question 7

Grâce à quel fichier de configuration l'application démarre-t-elle avec un chemin déjà mappé, celui du dossier `assets/` ? *(une seule bonne réponse)*

- [ ] **A.** `services.yaml`
- [ ] **B.** `asset_mapper.yaml`
- [ ] **C.** `importmap.php`
- [ ] **D.** `framework.yaml`

### Question 8

Comment appelle-t-on le chemin relatif au dossier mappé (ex. `images/duck.png` pour `assets/images/duck.png`) utilisé pour référencer un asset ? *(une seule bonne réponse)*

- [ ] **A.** L'identifiant de version
- [ ] **B.** Le chemin canonique
- [ ] **C.** Le chemin logique (« logical path »)
- [ ] **D.** Le chemin physique

### Question 9

Dans quel environnement l'URL versionnée d'un asset (ex. `/assets/images/duck-3c16d92m.png`) est-elle directement gérée et retournée par l'application Symfony elle-même ? *(une seule bonne réponse)*

- [ ] **A.** Dans les deux environnements de la même façon
- [ ] **B.** Uniquement en environnement `test`
- [ ] **C.** En environnement `dev`
- [ ] **D.** En environnement `prod`, après `asset-map:compile`

### Question 10

Que fait la commande `asset-map:compile`, à exécuter avant un déploiement en production ? *(une seule bonne réponse)*

- [ ] **A.** Elle supprime les fichiers non référencés du dossier `assets/`
- [ ] **B.** Elle génère un fichier `webpack.config.js` équivalent
- [ ] **C.** Elle copie physiquement tous les fichiers des répertoires mappés vers `public/assets/`, pour qu'ils soient servis directement par le serveur web
- [ ] **D.** Elle minifie tous les fichiers CSS/JS de l'application

### Question 11

Après avoir exécuté `asset-map:compile` sur sa machine de développement, un développeur ne voit plus ses modifications d'assets en rechargeant la page. Quelle est la cause et la solution ? *(une seule bonne réponse)*

- [ ] **A.** Le cache OPcache doit être vidé manuellement
- [ ] **B.** Il faut redémarrer le serveur FrankenPHP
- [ ] **C.** Il faut relancer `composer dump-autoload`
- [ ] **D.** Les fichiers compilés dans `public/assets/` prennent le pas sur le service dynamique ; il faut vider le contenu de `public/assets/` pour que Symfony recommence à servir les assets dynamiquement

### Question 12

Comment remplacer le service de copie des assets compilés (par exemple pour les uploader vers S3 plutôt que vers `public/assets/`) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, `public/assets/` étant la seule destination possible
- [ ] **B.** En modifiant directement le code source du composant AssetMapper
- [ ] **C.** Via l'option `framework.assets.base_path` uniquement
- [ ] **D.** En créant un service implémentant `PublicAssetsFilesystemInterface` et en l'aliasant à `asset_mapper.local_public_assets_filesystem`

### Question 13

Quelle commande liste tous les chemins mappés et tous les assets qu'ils contiennent ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console cache:pool:list asset_mapper`
- [ ] **B.** `bin/console debug:asset-map`
- [ ] **C.** `bin/console asset-map:compile --dry-run`
- [ ] **D.** `bin/console debug:container asset_mapper`

### Question 14

Que montre la colonne « Logical Path » affichée par `debug:asset-map` ? *(une seule bonne réponse)*

- [ ] **A.** Le chemin absolu sur le disque du serveur
- [ ] **B.** L'URL finale versionnée telle que servie au navigateur
- [ ] **C.** Le hash de version calculé pour l'asset
- [ ] **D.** Le chemin à utiliser pour référencer l'asset, par exemple depuis un template

### Question 15

Quelles options de filtrage `debug:asset-map` accepte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un nom ou un dossier d'asset en argument, pour ne montrer que les résultats correspondants
- [ ] **B.** `--ext=css` pour ne montrer qu'un type de fichier
- [ ] **C.** `--vendor` / `--no-vendor` pour inclure ou exclure le dossier `vendor/`
- [ ] **D.** `--min-size` pour filtrer par taille de fichier minimale

### Question 16

Ces filtres de `debug:asset-map` peuvent-ils être combinés entre eux ? *(une seule bonne réponse)*

- [ ] **A.** Non, un seul filtre peut être utilisé à la fois
- [ ] **B.** Seuls `--ext` et `--vendor` peuvent être combinés, pas l'argument de nom
- [ ] **C.** La combinaison de filtres nécessite une option `--combine` explicite
- [ ] **D.** Oui, par exemple pour trouver des polices web en gras dans ses propres dossiers d'assets (`bold --no-vendor --ext=woff2`)

## Importmaps et écriture du JavaScript

### Question 17

Sur quelles fonctionnalités natives du navigateur AssetMapper s'appuie-t-il pour que du JavaScript avec `import` et des classes ES6 « fonctionne tout simplement » ? *(une seule bonne réponse)*

- [ ] **A.** Le rendu côté serveur (SSR) de tout le JavaScript
- [ ] **B.** Le support natif de l'instruction `import` et des fonctionnalités ES6 par les navigateurs modernes
- [ ] **C.** Un polyfill Babel injecté automatiquement dans chaque fichier
- [ ] **D.** La transpilation systématique du code vers ES5

### Question 18

Lors d'un import relatif entre fichiers JavaScript (ex. `import Duck from './duck.js'`), quelle règle faut-il respecter, contrairement à Node.js ? *(une seule bonne réponse)*

- [ ] **A.** L'extension doit être omise, comme en Node.js
- [ ] **B.** L'extension `.js` doit être explicitement incluse, l'environnement navigateur l'exigeant
- [ ] **C.** Le chemin doit toujours être absolu, jamais relatif
- [ ] **D.** Le fichier importé doit être déclaré dans `importmap.php`

### Question 19

Quelle commande ajoute un paquet npm (ex. `bootstrap`) à l'importmap de l'application, plutôt que d'importer son URL CDN complète à la main ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console asset-map:add bootstrap`
- [ ] **B.** `composer require npm/bootstrap`
- [ ] **C.** `bin/console importmap:require bootstrap`
- [ ] **D.** `npm install bootstrap --save`

### Question 20

À quoi sert l'option `--dry-run` de `importmap:require` ? *(une seule bonne réponse)*

- [ ] **A.** Ignorer les dépendances du paquet lors de l'installation
- [ ] **B.** Forcer le téléchargement depuis npm plutôt que depuis le CDN
- [ ] **C.** Simuler l'installation du paquet sans effectuer réellement de modification
- [ ] **D.** Installer le paquet uniquement en environnement de développement

### Question 21

Que fait `importmap:require` lorsqu'un paquet comme `bootstrap` a des dépendances (ex. `@popperjs/core`) ou un fichier CSS principal ? *(une seule bonne réponse)*

- [ ] **A.** Il n'ajoute que le paquet principal ; les dépendances doivent être ajoutées manuellement une par une
- [ ] **B.** Il ignore systématiquement les fichiers CSS, quel que soit le paquet
- [ ] **C.** Il refuse d'installer un paquet ayant des dépendances
- [ ] **D.** Il ajoute automatiquement le paquet principal, ses dépendances, et son fichier CSS principal s'il est annoncé dans le `package.json`

### Question 22

Que signifie généralement une erreur de type « Failed to resolve module specifier "bootstrap" » dans la console du navigateur ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier `importmap.php` contient une erreur de syntaxe PHP
- [ ] **B.** Le cache Symfony n'a pas été vidé après une modification de template
- [ ] **C.** Le paquet est importé quelque part dans le JavaScript mais n'est pas déclaré dans l'importmap
- [ ] **D.** Le serveur web ne supporte pas HTTP/2

### Question 23

Que propose la documentation si le CDN jsDelivr renvoie une erreur réseau du type « Connection was reset », potentiellement causée par un pare-feu ou un proxy ? *(une seule bonne réponse)*

- [ ] **A.** Ignorer l'erreur, celle-ci disparaissant automatiquement après un redémarrage
- [ ] **B.** Configurer temporairement un proxy HTTP via `framework.http_client.default_options.proxy`
- [ ] **C.** Désinstaller et réinstaller le paquet concerné
- [ ] **D.** Passer en HTTP/1.1 pour contourner le problème

### Question 24

Dans quel dossier tous les paquets listés dans `importmap.php` sont-ils téléchargés, dossier qui doit être ignoré par git ? *(une seule bonne réponse)*

- [ ] **A.** `var/asset_mapper/`
- [ ] **B.** `assets/vendor/`
- [ ] **C.** `public/vendor/`
- [ ] **D.** `node_modules/`

### Question 25

Quelle commande télécharge les fichiers de `assets/vendor/` manquants sur une autre machine (ex. après un clone du dépôt) ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console importmap:require --all`
- [ ] **B.** `npm install`
- [ ] **C.** `bin/console asset-map:compile`
- [ ] **D.** `bin/console importmap:install`

### Question 26

Quelles commandes permettent respectivement de lister les paquets tiers obsolètes et de les mettre à jour ? *(une seule bonne réponse)*

- [ ] **A.** `importmap:list --outdated` et `importmap:install --force`
- [ ] **B.** `importmap:outdated` et `importmap:update`
- [ ] **C.** `importmap:check` et `importmap:upgrade`
- [ ] **D.** `importmap:audit` et `importmap:fix`

### Question 27

Comment installer des paquets depuis `node_modules/` plutôt que depuis le CDN, en pointant AssetMapper vers le bon dossier ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `importmap:require` ne fonctionnant qu'avec le CDN jsDelivr
- [ ] **B.** En créant un lien symbolique de `node_modules/` vers `assets/vendor/`
- [ ] **C.** En important directement le chemin absolu `file:///node_modules/...`
- [ ] **D.** En enregistrant le dossier `node_modules/<paquet>/dist/` dans `framework.asset_mapper.paths`, avec un namespace dédié

### Question 28

Pourquoi la documentation recommande-t-elle fortement d'utiliser un namespace pour les répertoires enregistrés en dehors de `assets/` ? *(une seule bonne réponse)*

- [ ] **A.** Pour permettre le versionnement des assets, qui ne fonctionne pas sans namespace
- [ ] **B.** Pour éviter les collisions de chemins logiques si plusieurs dossiers contiennent des fichiers de même nom (ex. deux `index.js`)
- [ ] **C.** Pour des raisons de performance de scan des fichiers uniquement
- [ ] **D.** Un namespace est obligatoire techniquement, sans quoi la configuration YAML est invalide

### Question 29

Une fois le dossier `node_modules/@hpcc-js/wasm-graphviz/dist/` enregistré avec le namespace `hpcc`, quelle option de `importmap:require` permet de pointer vers le fichier local exact via son chemin logique ? *(une seule bonne réponse)*

- [ ] **A.** `--namespace=hpcc`
- [ ] **B.** `--source=node_modules`
- [ ] **C.** `--path=hpcc/index.js`
- [ ] **D.** `--local=hpcc/index.js`

### Question 30

Quelle commande retire un paquet précédemment ajouté à `importmap.php`, avec ses dépendances associées ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console importmap:require --remove lodash`
- [ ] **B.** `bin/console asset-map:remove lodash`
- [ ] **C.** `bin/console importmap:remove lodash`
- [ ] **D.** `bin/console importmap:uninstall lodash`

### Question 31

Après avoir retiré un paquet avec `importmap:remove`, que recommande la documentation de faire ensuite, et que ne fait PAS cette commande automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** Vider tout le cache Symfony, sans quoi l'application ne démarre plus
- [ ] **B.** Lancer `importmap:install` pour resynchroniser `assets/vendor/` ; la commande ne retire pas non plus les instructions `import` restées dans le code JavaScript
- [ ] **C.** Lancer `composer dump-autoload`, la commande retirant automatiquement les imports orphelins
- [ ] **D.** Rien, la commande gère entièrement la synchronisation et le nettoyage du code

### Question 32

Que génère la fonction Twig `{{ importmap() }}` dans `base.html.twig`, en plus du `<script type="importmap">` ? *(une seule bonne réponse)*

- [ ] **A.** Une balise `<noscript>` de repli pour les navigateurs sans JavaScript
- [ ] **B.** Un service worker d'installation automatique
- [ ] **C.** Un ES module shim pour que les anciens navigateurs comprennent les importmaps
- [ ] **D.** Un fichier `manifest.json` complet inclus en base64

### Question 33

D'où provient l'entrée `/assets/duck.js` dans l'importmap généré, alors qu'elle ne figure pas dans `importmap.php` ? *(une seule bonne réponse)*

- [ ] **A.** Elle provient du fichier `config/packages/asset_mapper.yaml`
- [ ] **B.** Elle est générée uniquement en environnement de production
- [ ] **C.** AssetMapper détecte l'import relatif dans `app.js` et ajoute automatiquement le mapping vers le nom de fichier versionné correspondant
- [ ] **D.** Elle est ajoutée manuellement par le développeur lors de l'installation de Flex

### Question 34

Qu'est-ce qu'un « entrypoint » dans le contexte d'AssetMapper, et par quel fichier l'application démarre-t-elle par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Le premier fichier CSS déclaré dans le projet
- [ ] **B.** Le point d'entrée HTTP de l'API, indépendant du JavaScript
- [ ] **C.** Le fichier `importmap.php` lui-même, considéré comme l'entrypoint unique
- [ ] **D.** Le fichier JavaScript principal chargé par le navigateur ; par défaut `assets/app.js`, marqué `'entrypoint' => true` dans `importmap.php`

### Question 35

Que fait la ligne `<script type="module">import 'app';</script>` générée par `{{ importmap('app') }}` ? *(une seule bonne réponse)*

- [ ] **A.** Elle déclare uniquement le type MIME du module, sans effet de chargement
- [ ] **B.** Elle précharge l'entrée sans l'exécuter
- [ ] **C.** Elle est un vestige technique sans effet, l'exécution se faisant via `<link rel="modulepreload">`
- [ ] **D.** Elle indique au navigateur de charger l'entrée d'importmap `app`, ce qui exécute le code de `assets/app.js`

### Question 36

Quel type de balise `{{ importmap() }}` ajoute-t-il pour chaque fichier JavaScript importé, afin d'optimiser les performances de chargement ? *(une seule bonne réponse)*

- [ ] **A.** `<link rel="preconnect">`
- [ ] **B.** `<meta http-equiv="preload">`
- [ ] **C.** `<link rel="modulepreload">`
- [ ] **D.** `<link rel="prefetch">`

### Question 37

Pourquoi ajouter directement `highlight.js` à `importmap.php` via `importmap:require highlight.js` ne fonctionne-t-il pas si l'on importe `highlight.js/lib/core` dans le code ? *(une seule bonne réponse)*

- [ ] **A.** Il faut obligatoirement passer par `importmap:require --all`
- [ ] **B.** Ce que l'on importe doit correspondre *exactement* à une entrée de `importmap.php` ; il faut requérir directement les sous-chemins exacts utilisés
- [ ] **C.** `highlight.js` n'est disponible que via npm local, jamais via le CDN
- [ ] **D.** Les imports de sous-chemins ne sont jamais supportés par les navigateurs, quel que soit l'outil

### Question 38

Peut-on requérir plusieurs chemins de paquets en une seule commande `importmap:require` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais au maximum deux chemins par commande
- [ ] **B.** Oui, ex. `importmap:require highlight.js/lib/core highlight.js/lib/languages/javascript`
- [ ] **C.** Non, une seule commande ne peut traiter qu'un seul chemin à la fois
- [ ] **D.** Oui, mais uniquement pour des paquets du même éditeur npm

### Question 39

Pourquoi importer une bibliothèque comme jQuery via `import 'jquery'` ne rend-elle pas la variable globale `$` disponible dans les autres fichiers, contrairement à un usage classique sans module ? *(une seule bonne réponse)*

- [ ] **A.** jQuery n'est pas compatible avec les importmaps, quelle que soit la méthode utilisée
- [ ] **B.** AssetMapper bloque explicitement la création de variables globales pour des raisons de sécurité
- [ ] **C.** Il faut obligatoirement passer par un fichier `globals.js` dédié
- [ ] **D.** Dans un environnement de modules, importer une bibliothèque ne crée pas de variable globale ; il faut l'importer et l'assigner à une variable dans chaque fichier qui en a besoin

### Question 40

Comment rendre volontairement une bibliothèque disponible comme variable globale (`window.$`) malgré l'environnement de modules ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible qu'en désactivant complètement les importmaps
- [ ] **B.** En renommant le fichier `app.js` en `globals.js`
- [ ] **C.** En l'assignant manuellement à `window` depuis `app.js`, ex. `window.$ = $;`
- [ ] **D.** En ajoutant l'option `global: true` dans `importmap.php` pour ce paquet

### Question 41

Peut-on assigner une variable globale directement depuis une balise `<script type="module">` inline, sans passer par `app.js` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement en environnement `dev`
- [ ] **B.** Oui, un import et une assignation à `window` peuvent être faits directement dans un `<script type="module">` inline
- [ ] **C.** Non, seuls les fichiers `.js` externes peuvent définir des variables globales
- [ ] **D.** Non, les scripts inline de type module sont interdits par AssetMapper

## Gestion du CSS

### Question 42

Comment le CSS est-il ajouté à une page, sachant que le fichier `assets/app.js` par défaut importe déjà `assets/styles/app.css` ? *(une seule bonne réponse)*

- [ ] **A.** Via une balise `<link>` codée en dur dans chaque template
- [ ] **B.** Via une directive PHP `use_stylesheet()` dans le contrôleur
- [ ] **C.** Le CSS ne peut être ajouté que via `config/packages/asset_mapper.yaml`
- [ ] **D.** En l'important depuis un fichier JavaScript, ex. `import '../styles/app.css';`

### Question 43

Comment AssetMapper détermine-t-il quels fichiers CSS inclure sur la page lors de l'appel à `importmap('app')` ? *(une seule bonne réponse)*

- [ ] **A.** Il se base sur les balises `<link>` déjà présentes dans le template
- [ ] **B.** Il analyse `assets/app.js` (et les fichiers JavaScript qu'il importe) à la recherche d'instructions `import` de fichiers CSS
- [ ] **C.** Il scanne tout le dossier `assets/styles/` sans tenir compte des imports
- [ ] **D.** Il lit une liste de fichiers CSS déclarée manuellement dans `importmap.php`

### Question 44

Comment AssetMapper fait-il fonctionner l'import de CSS depuis du JavaScript, alors que ce n'est pas nativement supporté par les modules JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** En transpilant le CSS en JavaScript exécutable
- [ ] **B.** En injectant le CSS directement en ligne dans le HTML
- [ ] **C.** En passant systématiquement par un Service Worker
- [ ] **D.** En ajoutant une entrée d'importmap vide pour chaque fichier CSS (ex. `"/assets/app.css": "data:application/javascript,"`), tout en générant la balise `<link>` correspondante

### Question 45

Quel problème l'astuce `data:application/javascript,` pour l'import CSS peut-elle poser avec une Content-Security-Policy `script-src 'self'` ? *(une seule bonne réponse)*

- [ ] **A.** Elle nécessite de désactiver complètement la CSP pour fonctionner
- [ ] **B.** Elle déclenche une erreur CSP à cause de l'URL `data:` ; il faut soit l'ignorer, soit assouplir la directive vers `script-src 'strict-dynamic'`
- [ ] **C.** Elle bloque totalement le chargement du JavaScript, quelle que soit la CSP configurée
- [ ] **D.** Elle n'a aucun impact sur la CSP, celle-ci ne s'appliquant jamais au CSS

### Question 46

Comment inclure un fichier CSS fourni par un paquet npm (ex. `bootstrap/dist/css/bootstrap.min.css`) ? *(une seule bonne réponse)*

- [ ] **A.** L'inclure via une balise `<link>` pointant directement vers le CDN jsDelivr
- [ ] **B.** Ce n'est pas possible, seul le propre CSS de l'application pouvant être importé
- [ ] **C.** Le requérir via `importmap:require`, puis l'importer depuis un fichier JavaScript comme n'importe quel fichier CSS
- [ ] **D.** Copier manuellement le fichier CSS dans `assets/styles/`

### Question 47

Quand `importmap:require bootstrap` ajoute-t-il automatiquement le fichier CSS du paquet à `importmap.php`, sans commande supplémentaire ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement si le paquet s'appelle littéralement `bootstrap`
- [ ] **B.** Quand le paquet annonce son fichier CSS dans la propriété `style` de son `package.json`
- [ ] **C.** Systématiquement pour tous les paquets, sans condition
- [ ] **D.** Jamais automatiquement, il faut toujours une commande séparée pour le CSS

### Question 48

Depuis un fichier CSS, comment référencer une image (ex. via `url('../images/duck.png')`), et que se passe-t-il au niveau de l'URL finale ? *(une seule bonne réponse)*

- [ ] **A.** Il faut utiliser un chemin absolu commençant par `/assets/`
- [ ] **B.** Les références `url()` ne sont pas supportées par AssetMapper
- [ ] **C.** Il faut déclarer chaque image référencée dans `importmap.php`
- [ ] **D.** Via la fonction CSS `url()` avec un chemin relatif ; l'URL finale inclura automatiquement la version de l'image référencée

### Question 49

Quels bundles la documentation recommande-t-elle pour utiliser Tailwind CSS ou Sass avec AssetMapper ? *(plusieurs bonnes réponses)*

- [ ] **A.** `symfonycasts/tailwind-bundle` pour Tailwind
- [ ] **B.** `symfonycasts/sass-bundle` pour Sass
- [ ] **C.** `sensiolabs/minify-bundle` pour les deux
- [ ] **D.** Aucun bundle n'est nécessaire, Tailwind et Sass étant supportés nativement

### Question 50

Comment charger un fichier CSS de manière paresseuse (lazy) depuis un fichier JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** En le déclarant avec l'option `lazy: true` dans `importmap.php`
- [ ] **B.** Ce n'est pas possible, seul le JavaScript pouvant être chargé paresseusement
- [ ] **C.** Via la syntaxe d'import dynamique, ex. `import('./lazy.css');`
- [ ] **D.** Via une balise `<link rel="lazy">`

## Importer des fichiers JSON

### Question 51

Pourquoi AssetMapper propose-t-il une alternative à la syntaxe native `import data from './foo.json' with { type: 'json' }` ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elle ne fonctionne que côté serveur, jamais dans le navigateur
- [ ] **B.** Parce qu'elle nécessite obligatoirement un bundler comme Webpack
- [ ] **C.** Parce que le support navigateur de cette syntaxe native est encore limité
- [ ] **D.** Parce que cette syntaxe native est dépréciée par le W3C

### Question 52

Que retourne un import de fichier JSON via l'alternative AssetMapper (ex. `import dataPromise from './data.json';`) ? *(une seule bonne réponse)*

- [ ] **A.** Directement l'objet JSON désérialisé, de façon synchrone
- [ ] **B.** Une chaîne de caractères brute, à parser soi-même avec `JSON.parse()`
- [ ] **C.** Un objet `Response` qu'il faut appeler avec `.json()`
- [ ] **D.** Une Promise qui se résout avec le contenu JSON

### Question 53

Le fichier JSON importé est-il versionné comme les autres assets ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement si l'extension `.json` est explicitement ajoutée à `excluded_patterns`
- [ ] **B.** Oui ; un changement de contenu JSON produit un nouveau nom de fichier, forçant les navigateurs à charger la version à jour
- [ ] **C.** Non, les fichiers JSON ne sont jamais versionnés par AssetMapper
- [ ] **D.** Seulement en environnement `dev`, jamais en `prod`

## Problèmes courants et débogage

### Question 54

Un message d'erreur du type « The specifier "bootstrap" was a bare specifier, but was not remapped to anything » signifie généralement quoi, et quelle est la correction habituelle ? *(une seule bonne réponse)*

- [ ] **A.** Il faut désactiver le mode strict du navigateur
- [ ] **B.** Le paquet n'est pas dans l'importmap ; la correction habituelle est de l'y ajouter via `importmap:require bootstrap`
- [ ] **C.** Le serveur web ne supporte pas les types MIME modernes
- [ ] **D.** Le fichier `assets/app.js` a été supprimé par erreur

### Question 55

Un fichier JavaScript, CSS ou image renvoie une 404 dont l'URL ne contient pas de hash de version (ex. `/assets/duck.js` au lieu de `/assets/duck-1b7a64b3.js`). Que cela indique-t-il généralement ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier `manifest.json` est corrompu
- [ ] **B.** Le composant AssetMapper n'est pas correctement installé
- [ ] **C.** Le chemin référencé est incorrect (logique depuis Twig, ou relatif depuis un import CSS/JS)
- [ ] **D.** Le serveur web n'a pas encore redémarré depuis le dernier déploiement

### Question 56

Lorsqu'un asset est référencé directement depuis Twig via `asset('images/duck.png')`, quel type de chemin doit être passé à cette fonction ? *(une seule bonne réponse)*

- [ ] **A.** L'URL finale versionnée, hash inclus
- [ ] **B.** Un chemin relatif au template courant
- [ ] **C.** Le chemin logique de l'asset, visible via `debug:asset-map`
- [ ] **D.** Le chemin absolu sur le système de fichiers du serveur

### Question 57

Comment voir la liste de tous les imports invalides de l'application, et quel prérequis est mentionné pour voir les avertissements associés ? *(une seule bonne réponse)*

- [ ] **A.** Activer `framework.asset_mapper.strict_mode: true`
- [ ] **B.** Lancer `cache:clear` puis `debug:asset-map` ; avoir `symfony/monolog-bundle` installé pour voir les avertissements en haut de l'écran
- [ ] **C.** Lancer `importmap:audit`, sans prérequis particulier
- [ ] **D.** Consulter uniquement les logs du serveur web, aucune commande Symfony ne les affichant

### Question 58

Que se passe-t-il si l'on commente une instruction `import` dans un fichier JavaScript, plutôt que de la supprimer ? *(une seule bonne réponse)*

- [ ] **A.** Cela provoque une erreur de compilation bloquante
- [ ] **B.** AssetMapper supprime automatiquement les lignes commentées avant analyse
- [ ] **C.** AssetMapper (fonctionnant par regex) la détecte et l'ajoute quand même à l'importmap, ce qui ne cause pas de tort mais peut surprendre
- [ ] **D.** L'import commenté est totalement ignoré, comme attendu

## Déploiement avec AssetMapper

### Question 59

En plus des fichiers versionnés, quels fichiers JSON `asset-map:compile` écrit-il dans `public/assets/` pour que l'importmap se rende rapidement ? *(une seule bonne réponse)*

- [ ] **A.** `package.json` et `package-lock.json`
- [ ] **B.** `webpack-manifest.json` uniquement
- [ ] **C.** Aucun fichier JSON supplémentaire n'est généré
- [ ] **D.** `manifest.json` et `importmap.json`, entre autres

## Optimiser les performances

### Question 60

Parmi les recommandations de performance de la documentation, laquelle porte sur le protocole utilisé par le serveur web ? *(une seule bonne réponse)*

- [ ] **A.** Passer par un tunnel SSH pour chaque requête d'asset
- [ ] **B.** Utiliser HTTP/2 ou HTTP/3, pour permettre le téléchargement en parallèle des assets
- [ ] **C.** Désactiver HTTP/1.1 sur tous les serveurs
- [ ] **D.** Forcer l'usage exclusif de WebSockets pour les assets

### Question 61

Quel service tiers est cité comme raccourci pouvant automatiser la plupart des optimisations de performance (HTTP/2, compression) ? *(une seule bonne réponse)*

- [ ] **A.** AWS Lambda
- [ ] **B.** Netlify
- [ ] **C.** Cloudflare
- [ ] **D.** GitHub Pages

### Question 62

Pourquoi peut-on configurer sans risque une expiration de cache très longue (`max-age`, ex. 1 an) sur les assets AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Parce que HTTP/2 rend le cache navigateur obsolète
- [ ] **B.** Parce que chaque asset inclut un hash de version dans son nom de fichier, qui change si le contenu change
- [ ] **C.** Parce que les navigateurs ignorent de toute façon l'en-tête `Cache-Control` pour les assets statiques
- [ ] **D.** Parce qu'AssetMapper purge automatiquement le cache CDN à chaque déploiement

### Question 63

Dans le scénario où `app.js` importe `duck.js` qui importe `bootstrap`, quel problème de performance Lighthouse peut-il signaler sans préchargement (« preloading ») ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier `bootstrap` est toujours téléchargé deux fois
- [ ] **B.** Il n'existe aucun problème de performance dans ce scénario
- [ ] **C.** Le navigateur doit télécharger les fichiers un par un au fur et à mesure qu'il les découvre, au lieu de les télécharger en parallèle
- [ ] **D.** Le navigateur télécharge tous les fichiers dès la première requête, gaspillant de la bande passante

### Question 64

Comment AssetMapper résout-il ce problème de « chaînage de requêtes critiques » ? *(une seule bonne réponse)*

- [ ] **A.** En forçant le navigateur à utiliser le cache HTTP même sans en-tête `Cache-Control`
- [ ] **B.** En retardant volontairement le chargement de `bootstrap`
- [ ] **C.** En analysant `app.js` (et les fichiers qu'il importe) pour générer des balises `<link rel="preload">` pour tous les fichiers concernés
- [ ] **D.** En combinant tous les fichiers JavaScript en un seul fichier

### Question 65

Si le composant WebLink est disponible dans l'application, que fait Symfony en plus des balises `<link rel="preload">` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'a aucun effet supplémentaire, WebLink n'étant utilisé que pour les images
- [ ] **B.** Il ajoute un en-tête HTTP `Link` dans la réponse pour précharger les fichiers CSS
- [ ] **C.** Il désactive le préchargement HTML au profit de l'en-tête HTTP uniquement
- [ ] **D.** Il génère un fichier `weblink.json` séparé

## Pré-compression des assets

### Question 66

Quels formats de compression AssetMapper supporte-t-il nativement pour pré-compresser les assets ? *(plusieurs bonnes réponses)*

- [ ] **A.** Brotli
- [ ] **B.** Zstandard
- [ ] **C.** gzip
- [ ] **D.** LZMA

### Question 67

Pour utiliser la pré-compression gzip, quelle commande CLI (offrant de meilleurs résultats) ou extension PHP faut-il avoir installée ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement l'extension PHP `brotli`, quel que soit le format cible
- [ ] **B.** `7zip` en ligne de commande
- [ ] **C.** Aucun outil supplémentaire n'est requis, gzip étant toujours inclus dans PHP
- [ ] **D.** `zopfli` (meilleur) ou `gzip`, ou l'extension PHP `zlib`

### Question 68

Quelle option de configuration `precompress` définit le ou les formats de compression à utiliser, en acceptant éventuellement plusieurs valeurs ? *(une seule bonne réponse)*

- [ ] **A.** `algorithms`
- [ ] **B.** `compression_type`
- [ ] **C.** `codec`
- [ ] **D.** `format`

### Question 69

Si l'option `extensions` de `precompress` n'est pas définie explicitement, que fait AssetMapper par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il ne compresse aucun fichier tant que l'option n'est pas explicitement renseignée
- [ ] **B.** Il compresse uniquement les fichiers `.js`
- [ ] **C.** Il compresse tous les fichiers sans exception, y compris les images déjà compressées
- [ ] **D.** Il compresse toutes les extensions considérées sûres (css, js, json, svg, xml, ttf, otf, wasm, etc.)

### Question 70

Une fois `asset-map:compile` exécuté avec la pré-compression activée, quelle extension est ajoutée aux fichiers compressés (ex. pour Zstandard) ? *(une seule bonne réponse)*

- [ ] **A.** `.z`
- [ ] **B.** `.zst`
- [ ] **C.** `.zstd`
- [ ] **D.** `.zs`

### Question 71

Quelle commande et quel service AssetMapper fournit-il pour compresser n'importe quel type de fichier dans l'application (ex. des fichiers uploadés par les utilisateurs) ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas d'outil réutilisable en dehors de `asset-map:compile`
- [ ] **B.** La commande `importmap:compress` et le service `framework.compressor`
- [ ] **C.** La commande `assets:compress` et le service `asset_mapper.compressor`
- [ ] **D.** La commande `asset-map:compress-all` et le service `asset_mapper.gzip`

## FAQ

### Question 72

Le composant AssetMapper combine-t-il les assets en un seul fichier, comme le faisaient historiquement les bundlers ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement en environnement de production
- [ ] **B.** Non, car cela casserait le système de versionnement des assets
- [ ] **C.** Non, ce n'est plus nécessaire grâce aux avancées comme HTTP/2, qui permet le téléchargement parallèle
- [ ] **D.** Oui, il combine systématiquement tous les fichiers JavaScript en un seul

### Question 73

Pourquoi garder les assets séparés (plutôt que combinés) est-il présenté comme un avantage pour le cache navigateur ? *(une seule bonne réponse)*

- [ ] **A.** Les fichiers séparés se compressent toujours mieux que les fichiers combinés
- [ ] **B.** Cela réduit le nombre total d'octets téléchargés, quel que soit le nombre de requêtes
- [ ] **C.** Cela n'a aucun impact sur le cache, seul le nombre de requêtes changeant
- [ ] **D.** Quand un asset est mis à jour, le navigateur peut continuer à utiliser la version en cache de tous les autres assets

### Question 74

Le composant AssetMapper minifie-t-il les assets par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement les fichiers CSS, jamais le JavaScript
- [ ] **B.** Non, et aucune solution de minification n'est proposée dans l'écosystème Symfony
- [ ] **C.** Non ; si besoin, on peut utiliser le SensioLabs Minify Bundle, qui s'intègre avec `asset-map:compile`
- [ ] **D.** Oui, systématiquement, sans configuration nécessaire

### Question 75

Quel exemple concret la documentation cite-t-elle pour illustrer que le composant AssetMapper est performant en production ? *(une seule bonne réponse)*

- [ ] **A.** Un benchmark interne non public réalisé par l'équipe SensioLabs
- [ ] **B.** Aucun exemple concret n'est cité, uniquement des affirmations théoriques
- [ ] **C.** Le site https://ux.symfony.com, qui tourne sur AssetMapper avec un score Google Lighthouse de 99%
- [ ] **D.** Le site symfony.com lui-même, qui n'utilise pourtant pas AssetMapper

### Question 76

Quelle distinction la documentation fait-elle entre le support de l'instruction `import` et celui de la fonctionnalité `importmap` par les navigateurs anciens ? *(une seule bonne réponse)*

- [ ] **A.** Ni l'une ni l'autre ne peuvent être polyfillées, quel que soit le navigateur
- [ ] **B.** L'instruction `import` ne peut pas être polyfillée sur tous les navigateurs, alors qu'`importmap` est shimée pour fonctionner partout grâce à `es-module-shims`
- [ ] **C.** Les deux fonctionnalités sont polyfillées de la même manière par AssetMapper
- [ ] **D.** `import` est shimée pour tous les navigateurs, mais `importmap` ne l'est pas

### Question 77

Concernant les imports dynamiques avec un littéral de chaîne (ex. `import('./math.js')`), que fait AssetMapper, et quelle limite subsiste ? *(une seule bonne réponse)*

- [ ] **A.** Les imports dynamiques ne sont jamais supportés par AssetMapper, quel que soit le navigateur
- [ ] **B.** Le shim `es-module-shims` rend `import()` disponible nativement sur tous les navigateurs, sans exception
- [ ] **C.** AssetMapper réécrit correctement l'import dynamique, mais le navigateur doit tout de même supporter nativement `import()`, qui ne peut pas être shimé
- [ ] **D.** AssetMapper le transforme systématiquement en import statique classique

### Question 78

Si l'on utilise un transpileur (Babel, TypeScript) qui transforme les appels `import()`, dans quel ordre faut-il l'exécuter par rapport à la compilation AssetMapper, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** L'ordre n'a strictement aucune importance
- [ ] **B.** Les deux doivent être exécutés simultanément dans le même processus
- [ ] **C.** Avant la compilation AssetMapper, sinon les hash de fichiers changeraient après transpilation et casseraient les URLs versionnées
- [ ] **D.** Après la compilation AssetMapper, pour que la transpilation s'applique aux fichiers déjà versionnés

### Question 79

Peut-on utiliser AssetMapper avec des composants monofichiers Vue (`.vue`) ou du JSX complexe ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement Vue est supporté, jamais le JSX
- [ ] **B.** Probablement pas de façon satisfaisante ; les fichiers `.vue` nécessitent un système de build, et pour beaucoup de JSX, un outil comme Encore est préférable
- [ ] **C.** Oui, sans aucune restriction, quel que soit le volume de JSX ou de composants Vue
- [ ] **D.** Uniquement le JSX est supporté, jamais Vue sous aucune forme

### Question 80

Quel bundle la documentation recommande-t-elle pour linter et formater du code front-end (JS/TS/CSS) sans configuration, en alternative plus rapide à Prettier ? *(une seule bonne réponse)*

- [ ] **A.** `symfonycasts/eslint-bundle`
- [ ] **B.** `sensiolabs/prettier-bundle`
- [ ] **C.** AssetMapper ne propose aucune solution de lint/format, même via un bundle tiers
- [ ] **D.** `kocal/biome-js-bundle`

### Question 81

Où trouver la documentation d'intégration de TypeScript avec AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Via une configuration native `framework.asset_mapper.typescript: true`
- [ ] **B.** Uniquement en passant par Webpack Encore, jamais directement avec AssetMapper
- [ ] **C.** Via le bundle `sensiolabs/typescript-bundle`
- [ ] **D.** TypeScript n'est pas supporté du tout avec AssetMapper

## Bundles tiers et chemins d'assets personnalisés

### Question 82

Quel namespace est automatiquement utilisé pour les assets d'un bundle disposant d'un dossier `Resources/public/` ou `public/` ? *(une seule bonne réponse)*

- [ ] **A.** `<BundleName>/assets`
- [ ] **B.** `bundles/<BundleName>`
- [ ] **C.** `vendor/<BundleName>`
- [ ] **D.** `third-party/<BundleName>`

### Question 83

Un chemin comme `bundles/babdevpagerfanta/css/pagerfanta.css` fonctionne-t-il aussi dans une application *sans* AssetMapper ? Si oui, pourquoi, et qu'apporte AssetMapper en plus ? *(une seule bonne réponse)*

- [ ] **A.** Non, `assets:install` est une commande obsolète depuis Symfony 7.0
- [ ] **B.** Oui, grâce à la commande `assets:install` qui copie les assets vers `public/bundles/` ; AssetMapper ajoute en plus le versionnement automatique
- [ ] **C.** Non, ce chemin ne fonctionne que si AssetMapper est activé
- [ ] **D.** Oui, mais uniquement si le bundle est un bundle UX

### Question 84

Comment surcharger (« override ») un asset tiers, par exemple `pagerfanta.css` ? *(une seule bonne réponse)*

- [ ] **A.** En désinstallant le bundle puis en réinstallant une version patchée
- [ ] **B.** En créant un fichier de même nom dans son propre dossier `assets/`, au même chemin logique
- [ ] **C.** Ce n'est pas possible, les assets de bundles tiers étant immuables
- [ ] **D.** En modifiant directement le fichier dans `vendor/`

### Question 85

Dans quel cas de figure AssetMapper n'est-il PAS utilisé pour les assets propres d'un bundle, malgré leur présence dans un dossier public ? *(une seule bonne réponse)*

- [ ] **A.** AssetMapper est toujours utilisé, sans exception, pour tout bundle ayant un dossier d'assets public
- [ ] **B.** Quand le bundle utilise un package d'assets non par défaut (« non-default asset package »), comme c'est le cas avec EasyAdminBundle
- [ ] **C.** Quand le bundle est publié après 2024
- [ ] **D.** Quand le bundle ne déclare pas de fichier `composer.json`

## Importer des assets en dehors du dossier `assets/`

### Question 86

Peut-on importer, par exemple depuis un fichier CSS, un asset situé en dehors du chemin mappé (`assets/`) ? *(une seule bonne réponse)*

- [ ] **A.** Non, seuls les fichiers situés dans `assets/` peuvent être importés
- [ ] **B.** Oui, mais uniquement depuis un fichier JavaScript, jamais depuis du CSS
- [ ] **C.** Non, cela nécessite obligatoirement de copier le fichier dans `assets/` au préalable
- [ ] **D.** Oui, par exemple via `@import url('../../vendor/babdev/pagerfanta-bundle/Resources/public/css/pagerfanta.css')`

### Question 87

Si l'on obtient une erreur indiquant qu'un chemin ne semble faire partie d'aucun chemin d'assets, comment la résoudre ? *(une seule bonne réponse)*

- [ ] **A.** Renommer le fichier pour qu'il corresponde à un motif reconnu
- [ ] **B.** Cette erreur est fatale et ne peut pas être corrigée sans renoncer à l'import
- [ ] **C.** Ajouter le fichier à `excluded_patterns` pour qu'il soit ignoré
- [ ] **D.** Ajouter le chemin concerné à la liste `framework.asset_mapper.paths` dans `asset_mapper.yaml`

## Options de configuration

### Question 88

Quelle commande liste toutes les options de configuration disponibles pour AssetMapper, avec des informations sur chacune ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console debug:config asset_mapper --all`
- [ ] **B.** `bin/console asset-map:config`
- [ ] **C.** `bin/console debug:asset-map --config`
- [ ] **D.** `bin/console config:dump framework asset_mapper`

### Question 89

Comment l'option `framework.asset_mapper.paths` peut-elle être configurée pour donner un « namespace » à un chemin, plutôt qu'une simple liste ? *(une seule bonne réponse)*

- [ ] **A.** Il faut créer un fichier `namespaces.yaml` distinct
- [ ] **B.** En la définissant comme un mapping chemin → namespace, ex. `vendor/some/package/assets/: 'some-package'`
- [ ] **C.** Un namespace ne peut être défini que via une option séparée `namespaces`
- [ ] **D.** Les namespaces ne sont possibles que pour le chemin `assets/` lui-même

### Question 90

À quoi sert l'option `framework.asset_mapper.excluded_patterns` ? *(une seule bonne réponse)*

- [ ] **A.** Définir les extensions de fichiers à pré-compresser
- [ ] **B.** Exclure certains bundles de l'auto-configuration
- [ ] **C.** Définir une liste de motifs glob à exclure de la carte des assets (ex. `*/*.scss`)
- [ ] **D.** Exclure des routes HTTP de la vérification de sécurité

### Question 91

Que fait l'option `framework.asset_mapper.exclude_dotfiles`, et quelle est sa valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'a aucun effet documenté et est réservée à un usage interne
- [ ] **B.** Elle exclut les fichiers commençant par un point (ex. `.env`, `.gitignore`) de la publication ; activée par défaut
- [ ] **C.** Elle exclut les fichiers cachés du système d'exploitation uniquement sous Linux ; désactivée par défaut
- [ ] **D.** Elle exclut les fichiers de configuration YAML ; activée par défaut

### Question 92

Quelle option configure le polyfill utilisé pour les anciens navigateurs, et quelle est sa valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas d'option de configuration pour le polyfill, celui-ci étant toujours actif et non désactivable
- [ ] **B.** `framework.asset_mapper.importmap_polyfill`, avec `es-module-shims` comme valeur par défaut, chargé via un CDN
- [ ] **C.** `framework.asset_mapper.polyfill_source`, valant `null` par défaut
- [ ] **D.** `framework.asset_mapper.legacy_support`, désactivée par défaut

### Question 93

Comment charger le shim ES Module localement plutôt que depuis un CDN, sans changer la configuration `importmap_polyfill` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le CDN étant obligatoire pour ce shim
- [ ] **B.** En copiant manuellement le fichier dans `public/vendor/`
- [ ] **C.** En exécutant `bin/console importmap:require es-module-shims`
- [ ] **D.** En définissant `importmap_polyfill: 'local'`

### Question 94

Que se passe-t-il si l'on définit `importmap_polyfill: false` ? *(une seule bonne réponse)*

- [ ] **A.** Le polyfill est simplement chargé de façon asynchrone au lieu de façon synchrone
- [ ] **B.** Le shim est complètement désactivé ; l'application ne fonctionnera plus dans les anciens navigateurs
- [ ] **C.** Cela active un mode de compatibilité renforcé pour tous les navigateurs
- [ ] **D.** Cela n'a aucun effet, `false` n'étant pas une valeur valide pour cette option

### Question 95

À quoi sert l'option `framework.asset_mapper.importmap_script_attributes` ? *(une seule bonne réponse)*

- [ ] **A.** Lister les scripts à exclure du rendu de l'importmap
- [ ] **B.** Ajouter des attributs personnalisés (ex. `crossorigin: 'anonymous'`) aux balises `<script>` générées par `{{ importmap() }}`
- [ ] **C.** Définir les attributs HTML des balises `<link>` de préchargement uniquement
- [ ] **D.** Configurer les en-têtes HTTP renvoyés pour chaque script

## CSS et JavaScript spécifiques à une page

### Question 96

Quelle est la façon la plus simple de charger un fichier JavaScript uniquement sur certaines pages, sans créer un nouvel entrypoint ? *(une seule bonne réponse)*

- [ ] **A.** Créer un fichier `page.yaml` listant les scripts par route
- [ ] **B.** Ce n'est pas possible sans passer par un entrypoint dédié
- [ ] **C.** Utiliser un import dynamique conditionnel, ex. `if (someCondition) { import('./some-file.js'); }`
- [ ] **D.** Dupliquer entièrement `app.js` pour chaque page

### Question 97

Comment déclarer un second entrypoint (ex. `checkout`) dans `importmap.php`, pour du CSS/JS spécifique à une page ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant `checkout` à la liste `framework.asset_mapper.entrypoints`
- [ ] **B.** En ajoutant une entrée avec `'path' => './assets/checkout.js'` et `'entrypoint' => true`
- [ ] **C.** En créant un fichier `checkout.importmap.php` séparé
- [ ] **D.** Les entrypoints multiples ne sont pas supportés par AssetMapper

### Question 98

Comment appeler `importmap()` pour charger à la fois l'entrypoint `app` et un entrypoint additionnel `checkout` sur une page spécifique ? *(une seule bonne réponse)*

- [ ] **A.** `{{ importmap('app+checkout') }}`
- [ ] **B.** `{{ importmap(['app', 'checkout']) }}`
- [ ] **C.** `{{ importmap('app') }}{{ importmap('checkout') }}` (deux appels successifs)
- [ ] **D.** `{{ importmap('app', 'checkout') }}` avec des arguments positionnels séparés

### Question 99

Pourquoi la documentation avertit-elle de ne pas appeler `parent()` dans le bloc `{% block importmap %}` lorsqu'on le surcharge ? *(une seule bonne réponse)*

- [ ] **A.** `parent()` provoquerait une boucle infinie de rendu Twig
- [ ] **B.** Cela désactiverait complètement le CSS de la page
- [ ] **C.** `parent()` n'existe pas pour les blocs Twig nommés `importmap`
- [ ] **D.** Chaque page ne peut inclure qu'un seul importmap ; la fonction `importmap()` doit être appelée exactement une fois

### Question 100

Si l'on appelle uniquement `{{ importmap('checkout') }}` (sans `app`), l'importmap complet est-il tout de même inclus dans la page, et quels fichiers sont réellement exécutés ? *(une seule bonne réponse)*

- [ ] **A.** Oui, et cela charge et exécute automatiquement tous les entrypoints déclarés, y compris `app`
- [ ] **B.** Cela lève une erreur, `app` étant obligatoire à chaque appel de `importmap()`
- [ ] **C.** Oui, l'importmap complet reste inclus pour que toutes les définitions de modules soient disponibles, mais seul `checkout.js` est réellement chargé et exécuté
- [ ] **D.** Non, seule la portion de l'importmap liée à `checkout` est incluse

## Content Security Policy (CSP)

### Question 101

Pourquoi les balises `<script>` inline générées par `importmap()` peuvent-elles être bloquées par une Content-Security-Policy stricte ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ces scripts contiennent toujours des appels réseau externes
- [ ] **B.** Parce que ce sont des scripts inline, généralement interdits par une CSP sans autorisation explicite
- [ ] **C.** Parce qu'`importmap()` génère toujours du JavaScript obfusqué
- [ ] **D.** Parce que la CSP bloque systématiquement tout usage d'importmaps, quelle que soit sa configuration

### Question 102

Comment autoriser ces scripts inline à s'exécuter sans désactiver la protection CSP, via un « nonce » ? *(une seule bonne réponse)*

- [ ] **A.** Un nonce n'est pas nécessaire, `importmap()` générant automatiquement les en-têtes CSP requis
- [ ] **B.** Utiliser exclusivement des scripts externes (`<script src="...">`), les scripts inline n'étant jamais compatibles avec la CSP
- [ ] **C.** Générer un nonce aléatoire par requête, l'inclure dans l'en-tête CSP et le passer en second argument à `importmap()`, ex. `importmap('app', {'nonce': csp_nonce('script')})`
- [ ] **D.** Ajouter l'option `csp: 'disabled'` à la configuration AssetMapper

### Question 103

Quel bundle est cité pour générer le nonce et l'inclure dans l'en-tête CSP ? *(une seule bonne réponse)*

- [ ] **A.** StimulusBundle
- [ ] **B.** SymfonyCasts Verify-Email Bundle
- [ ] **C.** NelmioSecurityBundle
- [ ] **D.** SensioLabs Minify Bundle

### Question 104

Pourquoi l'astuce `data:application/javascript` utilisée pour le CSS peut-elle poser un problème CSP, et quelle directive permet de le résoudre ? *(une seule bonne réponse)*

- [ ] **A.** Il faut ajouter `unsafe-inline` en remplacement complet de la politique existante, sans autre option
- [ ] **B.** Elle peut être bloquée par la CSP ; ajouter `strict-dynamic` à la directive `script-src` autorise l'importmap à charger d'autres ressources
- [ ] **C.** Elle n'a jamais d'impact sur la CSP, quelle que soit la configuration
- [ ] **D.** Il faut désactiver complètement `script-src`, aucune directive ne pouvant résoudre le problème

## Le système de cache d'AssetMapper en développement

### Question 105

Comment le composant AssetMapper gère-t-il le contenu des fichiers en mode debug ? *(une seule bonne réponse)*

- [ ] **A.** Il ne met en cache que les fichiers CSS, jamais le JavaScript
- [ ] **B.** Le cache n'est actif qu'en environnement de production
- [ ] **C.** Il calcule et met en cache le contenu de chaque fichier, en le recalculant automatiquement dès que le fichier change
- [ ] **D.** Il recalcule systématiquement tous les fichiers à chaque requête, sans aucun cache

### Question 106

Pourquoi la modification de `other.css` (importé via `@import` dans `app.css`) provoque-t-elle aussi le recalcul du contenu de `app.css` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement si le fichier `other.css` est explicitement listé dans `asset_mapper.yaml`
- [ ] **B.** Le hash de version de `other.css` change, ce qui modifie le contenu final de `app.css` puisqu'il référence ce nom de fichier
- [ ] **C.** Symfony recalcule systématiquement tous les fichiers CSS de l'application à chaque changement, sans lien de dépendance
- [ ] **D.** Ce n'est pas le cas : `app.css` n'est jamais recalculé automatiquement dans ce scénario

## Audits de sécurité sur les dépendances

### Question 107

Quelle commande vérifie les vulnérabilités de sécurité connues dans les dépendances front-end de l'application, à la manière de `npm audit` ? *(une seule bonne réponse)*

- [ ] **A.** `bin/console asset-map:security-check`
- [ ] **B.** `bin/console importmap:check-security`
- [ ] **C.** `bin/console security:check-assets`
- [ ] **D.** `bin/console importmap:audit`

### Question 108

Quel code de sortie cette commande retourne-t-elle si aucune vulnérabilité n'est trouvée, et quel intérêt cela présente-t-il pour la CI ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne retourne jamais de code d'erreur, quel que soit le résultat
- [ ] **B.** Le code `0` uniquement si l'option `--strict` est passée
- [ ] **C.** Le code `0` ; cela permet d'intégrer la commande dans une CI pour être alerté dès qu'une nouvelle vulnérabilité apparaît
- [ ] **D.** Le code `1`, comme pour toute commande Symfony réussie

### Question 109

Quelle option permet de choisir le format de sortie de la commande d'audit ? *(une seule bonne réponse)*

- [ ] **A.** `--report-type`, entre `short` et `full`
- [ ] **B.** `--format`, entre `txt` et `json`
- [ ] **C.** `--output`, entre `table` et `csv`
- [ ] **D.** Il n'existe pas d'option de format, la sortie étant toujours au format table

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page AssetMapper de la documentation Symfony 8.0](https://symfony.com/doc/8.0/frontend/asset_mapper.html).

**Question 1 : A, B** — « The component has two main features: Mapping & Versioning Assets (…) Importmaps » *(§ AssetMapper: Simple, Modern CSS & JS Management)*

**Question 2 : B** — « the HTTP/2 protocol means that combining your assets to reduce HTTP connections is no longer urgent. » *(§ AssetMapper: Simple, Modern CSS & JS Management)*

**Question 3 : B** — « `$ composer require symfony/asset-mapper symfony/asset symfony/twig-pack` » *(§ Installation)*

**Question 4 : A, B, C** — « the recipe just added a number of files: `assets/app.js` (…) `assets/styles/app.css` (…) `config/packages/asset_mapper.yaml` (…) `importmap.php` » *(§ Installation)*

**Question 5 : D** — « It also *updated* the `templates/base.html.twig` file » *(§ Installation)*

**Question 6 : D** — « If you're not using Flex, you'll need to create & update these files manually. See the latest asset-mapper recipe for the exact content of these files. » *(§ Installation)*

**Question 7 : B** — « Thanks to the `asset_mapper.yaml` file, your app starts with one mapped path: the `assets/` directory. » *(§ Mapping and Referencing Assets)*

**Question 8 : C** — « The path - `images/duck.png` - is relative to your mapped directory (`assets/`). This is known as the **logical path** to your asset. » *(§ Mapping and Referencing Assets)*

**Question 9 : C** — « In the `dev` environment, the URL `/assets/images/duck-3c16d92m.png` is handled and returned by your Symfony app. » *(§ Serving Assets in dev vs prod)*

**Question 10 : C** — « This will physically copy all the files from your mapped directories to `public/assets/` so that they're served directly by your web server. » *(§ Serving Assets in dev vs prod)*

**Question 11 : D** — « If you run the `asset-map:compile` command on your development machine, you won't see any changes made to your assets when reloading the page. To resolve this, delete the contents of the `public/assets/` directory. » *(§ Serving Assets in dev vs prod)*

**Question 12 : D** — « create a service that implements `PublicAssetsFilesystemInterface` and set its service id (or an alias) to `asset_mapper.local_public_assets_filesystem` » *(§ Serving Assets in dev vs prod)*

**Question 13 : B** — « `$ php bin/console debug:asset-map` » *(§ Debugging: Seeing All Mapped Assets)*

**Question 14 : D** — « The "Logical Path" is the path to use when referencing the asset, like from a template. » *(§ Debugging: Seeing All Mapped Assets)*

**Question 15 : A, B, C** — « provide an asset name or dir to only show results that match it (…) provide an extension to only show that file type (…) you can also only show assets in vendor/ dir or exclude any results from it » *(§ Debugging: Seeing All Mapped Assets)*

**Question 16 : D** — « you can also combine all filters (e.g. find bold web fonts in your own asset dirs): `debug:asset-map bold --no-vendor --ext=woff2` » *(§ Debugging: Seeing All Mapped Assets)*

**Question 17 : B** — « All modern browsers support the JavaScript import statement and modern ES6 features like classes. So this code "just works" » *(§ Importmaps & Writing JavaScript)*

**Question 18 : B** — « When importing relative files, be sure to include the `.js` filename extension. Unlike in Node.js, this extension is required in the browser environment. » *(§ Importmaps & Writing JavaScript)*

**Question 19 : C** — « we can add this package to our "importmap" via the `importmap:require` command (…) `$ php bin/console importmap:require bootstrap` » *(§ Importing 3rd Party JavaScript Packages)*

**Question 20 : C** — « Add the `--dry-run` option to simulate package installation without actually making any changes » *(§ Importing 3rd Party JavaScript Packages)*

**Question 21 : D** — « The `importmap:require` command will add both the main package *and* its dependencies. If a package includes a main CSS file, that will also be added » *(§ Importing 3rd Party JavaScript Packages)*

**Question 22 : C** — « This means that, somewhere in your JavaScript, you're importing a 3rd party package (…) The browser tries to find this package in your `importmap` file, but it's not there. » *(§ Importing 3rd Party JavaScript Packages)*

**Question 23 : B** — « If you see a network error like *Connection was reset* (…) it may be caused by a proxy or firewall restriction. In that case, you can temporarily configure a proxy » *(§ Importing 3rd Party JavaScript Packages)*

**Question 24 : B** — « All packages in `importmap.php` are downloaded into an `assets/vendor/` directory, which should be ignored by git » *(§ Importing 3rd Party JavaScript Packages)*

**Question 25 : D** — « You'll need to run the following command to download the files on other computers if some are missing: `$ php bin/console importmap:install` » *(§ Importing 3rd Party JavaScript Packages)*

**Question 26 : B** — « `$ php bin/console importmap:outdated` (…) `$ php bin/console importmap:update` » *(§ Importing 3rd Party JavaScript Packages)*

**Question 27 : D** — « register the directory containing its browser-compatible files in your AssetMapper paths: `node_modules/@hpcc-js/wasm-graphviz/dist/: 'hpcc'` » *(§ Using Local npm Packages)*

**Question 28 : B** — « Using a namespace (…) is highly recommended to avoid collisions in logical paths. For example, if both (…) contained an `index.js` file, only one of them would be mapped without namespaces. » *(§ Using Local npm Packages)*

**Question 29 : C** — « require the package in the importmap using the `--path` option to point to the local file using its logical path: `importmap:require @hpcc-js/wasm-graphviz --path=hpcc/index.js` » *(§ Using Local npm Packages)*

**Question 30 : C** — « use the `importmap:remove` command. For example, to remove the `lodash` package: `$ php bin/console importmap:remove lodash` » *(§ Removing JavaScript Packages)*

**Question 31 : B** — « it's recommended to also run the following to ensure that your `assets/vendor/` directory is in sync (…) Removing a package from the import map does not automatically remove any references to it in your JavaScript files. » *(§ Removing JavaScript Packages)*

**Question 32 : C** — « The `importmap()` function also outputs an ES module shim so that older browsers understand importmaps » *(§ How does the importmap Work?)*

**Question 33 : C** — « the AssetMapper component sees the import and adds a mapping from `/assets/duck.js` to the correct, versioned filename. The result: importing `./duck.js` just works! » *(§ How does the importmap Work?)*

**Question 34 : D** — « An "entrypoint" is the main JavaScript file that the browser loads, and your app starts with one by default (…) `'app' => ['path' => './assets/app.js', 'entrypoint' => true]` » *(§ The "app" Entrypoint & Preloading)*

**Question 35 : D** — « `<script type="module">import 'app';</script>` This line tells the browser to load the `app` importmap entry, which causes the code in `assets/app.js` to be executed. » *(§ The "app" Entrypoint & Preloading)*

**Question 36 : C** — « The `importmap()` function also outputs a set of "preloads": `<link rel="modulepreload" href="...">` » *(§ The "app" Entrypoint & Preloading)*

**Question 37 : B** — « whatever you import - e.g. `highlight.js/lib/core` - needs to *exactly* match an entry in the `importmap.php` file. » *(§ Importing Specific Files From a 3rd Party Package)*

**Question 38 : B** — « This also shows how you can require multiple packages at once: `importmap:require highlight.js/lib/core highlight.js/lib/languages/javascript` » *(§ Importing Specific Files From a 3rd Party Package)*

**Question 39 : D** — « in a module environment (…) when you import a library like `jquery`, it does *not* create a global variable. Instead, you should import it and set it to a variable in *every* file you need it » *(§ Global Variables like jQuery)*

**Question 40 : C** — « If you *do* need something to become a global variable, you do it manually from inside `app.js`: `window.$ = $;` » *(§ Global Variables like jQuery)*

**Question 41 : B** — « You can even do this from an inline script tag: `<script type="module"> import $ from 'jquery'; $('.something').hide(); </script>` » *(§ Global Variables like jQuery)*

**Question 42 : D** — « CSS can be added to your page by importing it from a JavaScript file. (…) `import '../styles/app.css';` » *(§ Handling CSS)*

**Question 43 : B** — « When you call `importmap('app')` in `base.html.twig`, AssetMapper parses `assets/app.js` (and any JavaScript files that it imports) looking for `import` statements for CSS files. » *(§ Handling CSS)*

**Question 44 : D** — « AssetMapper makes this work by adding an empty importmap entry for each CSS file (e.g. `"/assets/app.css": "data:application/javascript,"`) (…) AssetMapper adds a `<link>` tag for each CSS file » *(§ Handling CSS)*

**Question 45 : B** — « When using a **Content-Security-Policy** with `script-src 'self'`, this triggers an error because of the `data:` URL. You can either ignore the error or relax the directive to `script-src 'strict-dynamic'`. » *(§ Handling CSS)*

**Question 46 : C** — « You can require CSS files in the same way as JavaScript files (…) To include it on the page, import it from a JavaScript file » *(§ Handling 3rd-Party CSS)*

**Question 47 : B** — « when you `importmap:require bootstrap`, the CSS file is also added to `importmap.php` for convenience. If some package doesn't advertise its CSS file in the `style` property of the package.json » *(§ Handling 3rd-Party CSS)*

**Question 48 : D** — « you can reference other files using the normal CSS `url()` function and a relative path (…) The path in the final `app.css` file will automatically include the versioned URL » *(§ Paths Inside of CSS Files)*

**Question 49 : A, B** — « To use the Tailwind CSS framework with the AssetMapper component, check out `symfonycasts/tailwind-bundle`. (…) To use Sass with AssetMapper component, check out `symfonycasts/sass-bundle`. » *(§ Using Tailwind CSS / Using Sass)*

**Question 50 : C** — « If you have some CSS that you want to load lazily, you can do that via the normal, "dynamic" import syntax: `import('./lazy.css');` » *(§ Lazily Importing CSS from a JavaScript File)*

**Question 51 : C** — « Modern browsers support importing JSON files (…) but browser support is still limited. AssetMapper provides a compatible alternative » *(§ Importing JSON files)*

**Question 52 : D** — « The import returns a Promise that resolves to the JSON content » *(§ Importing JSON files)*

**Question 53 : B** — « The imported JSON file is versioned like any other asset, so changes to the JSON content will produce a new filename and browsers will load the updated version. » *(§ Importing JSON files)*

**Question 54 : B** — « This means that, somewhere in your JavaScript, you're importing a 3rd party package (…) The fix is almost always to add it to your `importmap`: `importmap:require bootstrap` » *(§ Missing importmap Entry)*

**Question 55 : C** — « This is usually because the path is wrong. » *(§ 404 Not Found for a JavaScript, CSS or Image File)*

**Question 56 : C** — « the path that you pass `asset()` should be the "logical path" to the file. Use the `debug:asset-map` command to see all valid logical paths » *(§ 404 Not Found for a JavaScript, CSS or Image File)*

**Question 57 : B** — « `$ php bin/console cache:clear` `$ php bin/console debug:asset-map` (…) make sure you have `symfony/monolog-bundle` installed » *(§ 404 Not Found for a JavaScript, CSS or Image File)*

**Question 58 : C** — « This is done via regex and works very well, though it isn't perfect. If you comment-out an import, it will still be found and added to your importmap. That doesn't harm anything, but could be surprising. » *(§ Missing Asset Warnings on Commented-out Code)*

**Question 59 : D** — « This will write all your versioned asset files into the `public/assets/` directory, along with a few JSON files (`manifest.json`, `importmap.json`, etc.) » *(§ Deploying with the AssetMapper Component)*

**Question 60 : B** — « **Use HTTP/2**: Your web server should be running HTTP/2 or HTTP/3 so the browser can download assets in parallel. » *(§ Optimizing Performance)*

**Question 61 : C** — « you can use a service like Cloudflare, which will automatically do most of these things for you » *(§ Optimizing Performance)*

**Question 62 : B** — « Because the AssetMapper component includes a version hash in the filename of each asset, you can safely set `max-age` to a very long time » *(§ Optimizing Performance)*

**Question 63 : C** — « Without preloading (…) the browser would be forced to download them one-by-one as it discovers them. That would hurt performance. » *(§ Performance: Understanding Preloading)*

**Question 64 : C** — « AssetMapper avoids this problem by outputting "preload" link tags. (…) looks at the `assets/app.js` file and finds all of the JavaScript files that it imports (…) It then outputs a `link` tag for each » *(§ Performance: Understanding Preloading)*

**Question 65 : B** — « if the WebLink Component is available in your application, Symfony will add a `Link` header in the response to preload the CSS files. » *(§ Performance: Understanding Preloading)*

**Question 66 : A, B, C** — « AssetMapper supports Brotli, Zstandard and gzip compression formats. » *(§ Pre-Compressing Assets)*

**Question 67 : D** — « gzip: `zopfli` (better) or `gzip` CLI command; zlib PHP extension » *(§ Pre-Compressing Assets)*

**Question 68 : D** — « `precompress: format: 'zstandard'` » *(§ Pre-Compressing Assets)*

**Question 69 : D** — « if you don't define the following option, AssetMapper will compress all the extensions considered safe (css, js, json, svg, xml, ttf, otf, wasm, etc.) » *(§ Pre-Compressing Assets)*

**Question 70 : B** — « The compressed files are created with the same name as the original but with the `.br`, `.zst`, or `.gz` extension appended. » *(§ Pre-Compressing Assets)*

**Question 71 : C** — « AssetMapper provides an `assets:compress` CLI command and a service called `asset_mapper.compressor` that you can use anywhere in your application to compress any kind of files » *(§ Pre-Compressing Assets)*

**Question 72 : C** — « Nope! But that's because this is no longer necessary! (…) Thanks to advances in web servers like HTTP/2, it's typically not a problem to keep your assets separate » *(§ Does the AssetMapper Component Combine Assets?)*

**Question 73 : D** — « by keeping them separate, when you update one asset, the browser can continue to use the cached version of all of your other assets. » *(§ Does the AssetMapper Component Combine Assets?)*

**Question 74 : C** — « Nope! (…) if you think you could benefit from minifying assets (…) you can use the SensioLabs Minify Bundle. This bundle integrates seamlessly with AssetMapper (…) when running the `asset-map:compile` command » *(§ Does the AssetMapper Component Minify Assets?)*

**Question 75 : C** — « The https://ux.symfony.com site runs on the AssetMapper component and has a 99% Google Lighthouse score. » *(§ Is the AssetMapper Component Production Ready? Is it Performant?)*

**Question 76 : B** — « The import statement can't be polyfilled or shimmed to work on *every* browser. (…) The `importmap` feature **is** shimmed to work in **all** browsers by the AssetMapper component (using es-module-shims). » *(§ Does the AssetMapper Component work in All Browsers?)*

**Question 77 : C** — « AssetMapper correctly rewrites dynamic imports when the path is a string literal (…) requires the browser to support import() natively (…) Browsers without native import support will fail regardless of AssetMapper. » *(§ Does the AssetMapper Component work in All Browsers?)*

**Question 78 : C** — « If you use a transpiler (e.g. Babel, TypeScript) that transforms `import()` calls, make sure to run it **before** AssetMapper compiles the assets. Otherwise the file hashes will change after transpilation and the versioned URLs will break. » *(§ Does the AssetMapper Component work in All Browsers?)*

**Question 79 : B** — « Probably not. And if you're writing an application in React, Svelte or another frontend framework, you'll probably be better off using *their* tools directly. (…) you cannot write single-file components (i.e. `.vue` files) (…) those must be used in a build system. » *(§ Can I Use it with JSX or Vue?)*

**Question 80 : D** — « you can install `kocal/biome-js-bundle` in your project to lint and format your front-end assets. It's much faster than alternatives like Prettier and requires no configuration » *(§ Can I Lint and Format My Code?)*

**Question 81 : C** — « To use TypeScript with the AssetMapper component, check out `sensiolabs/typescript-bundle`. » *(§ Using TypeScript)*

**Question 82 : B** — « All bundles that have a `Resources/public/` or `public/` directory will automatically have that directory added as an "asset path", using the namespace: `bundles/<BundleName>`. » *(§ Third-Party Bundles & Custom Asset Paths)*

**Question 83 : B** — « this path (…) already works in applications *without* the AssetMapper component, because the `assets:install` command copies the assets from bundles into `public/bundles/`. However, when the AssetMapper component is enabled, the (…) file will automatically be versioned! » *(§ Third-Party Bundles & Custom Asset Paths)*

**Question 84 : B** — « If you want to override a 3rd-party asset, you can do that by creating a file in your `assets/` directory with the same name. » *(§ Overriding 3rd-Party Assets)*

**Question 85 : B** — « If a bundle renders their *own* assets, but they use a non-default asset package, then the AssetMapper component will not be used. This happens, for example, with EasyAdminBundle. » *(§ Overriding 3rd-Party Assets)*

**Question 86 : D** — « You *can* import assets that live outside of your asset path (i.e. the `assets/` directory). For example: `@import url('../../vendor/babdev/pagerfanta-bundle/Resources/public/css/pagerfanta.css');` » *(§ Importing Assets Outside of the assets/ Directory)*

**Question 87 : D** — « You can fix this by adding the path to your `asset_mapper.yaml` file: `paths: - assets/ - vendor/some/package/assets` » *(§ Importing Assets Outside of the assets/ Directory)*

**Question 88 : D** — « You can see every available configuration options and some info by running: `$ php bin/console config:dump framework asset_mapper` » *(§ Configuration Options)*

**Question 89 : B** — « Or you can give each path a "namespace" that will be used in the asset map: `vendor/some/package/assets/: 'some-package'` » *(§ framework.asset_mapper.paths)*

**Question 90 : C** — « This is a list of glob patterns that will be excluded from the asset map » *(§ framework.asset_mapper.excluded_patterns)*

**Question 91 : B** — « Whether to exclude any file starting with a `.` from the asset mapper. (…) This option is enabled by default. » *(§ framework.asset_mapper.exclude_dotfiles)*

**Question 92 : B** — « Configure the polyfill for older browsers. By default, the ES module shim is loaded via a CDN (i.e. the default value for this setting is `es-module-shims`) » *(§ framework.asset_mapper.importmap_polyfill)*

**Question 93 : C** — « You can tell the AssetMapper to load the ES module shim locally by using the following command, without changing your configuration: `$ php bin/console importmap:require es-module-shims` » *(§ framework.asset_mapper.importmap_polyfill)*

**Question 94 : B** — « set this option to false to disable the shim entirely (your website/web app won't work in old browsers) » *(§ framework.asset_mapper.importmap_polyfill)*

**Question 95 : B** — « This is a list of attributes that will be added to the `<script>` tags rendered by the `{{ importmap() }}` Twig function: `importmap_script_attributes: crossorigin: 'anonymous'` » *(§ framework.asset_mapper.importmap_script_attributes)*

**Question 96 : C** — « For JavaScript, an easy way is to load the file with a dynamic import: `if (someCondition) { import('./some-file.js'); }` » *(§ Page-Specific CSS & JavaScript)*

**Question 97 : B** — « add this to `importmap.php` and mark it as an entrypoint: `'checkout' => ['path' => './assets/checkout.js', 'entrypoint' => true]` » *(§ Page-Specific CSS & JavaScript)*

**Question 98 : B** — « call `importmap()` and pass both `app` and `checkout`: `{{ importmap(['app', 'checkout']) }}` » *(§ Page-Specific CSS & JavaScript)*

**Question 99 : D** — « Do not call `parent()` inside the `{% block importmap %}` Twig block. Each page can include only one import map, so `importmap()` must be called exactly once. » *(§ Page-Specific CSS & JavaScript)*

**Question 100 : C** — « If you want to execute *only* `checkout.js` (…) call `{{ importmap('checkout') }}`. In this case, the full import map will still be included in the page, but only the `checkout.js` file will actually be loaded. » *(§ Page-Specific CSS & JavaScript)*

**Question 101 : B** — « the inline `<script>` tags rendered by the `importmap()` function will likely violate that policy and will not be executed by the browser. » *(§ Using a Content Security Policy (CSP))*

**Question 102 : C** — « generate a secure random string for every request (called a *nonce*) and include it in the CSP header and in a `nonce` attribute (…) `{{ importmap('app', {'nonce': csp_nonce('script')}) }}` » *(§ Using a Content Security Policy (CSP))*

**Question 103 : C** — « You can use the NelmioSecurityBundle to generate the nonce and include it in the CSP header » *(§ Using a Content Security Policy (CSP))*

**Question 104 : B** — « This can cause browsers to report CSP violations and block the CSS files from being loaded. To prevent this, you can add strict-dynamic to the `script-src` directive » *(§ Content Security Policy and CSS Files)*

**Question 105 : C** — « the AssetMapper component will calculate the content of each asset file and cache it. Whenever that file changes, the component will automatically re-calculate the content. » *(§ The AssetMapper Component Caching System in dev)*

**Question 106 : B** — « the `app.css` file contents will also be re-calculated whenever `other.css` changes. This is because the version hash of `other.css` will change... which will cause the final content of `app.css` to change » *(§ The AssetMapper Component Caching System in dev)*

**Question 107 : D** — « the AssetMapper component comes bundled with a command that checks security vulnerabilities in the dependencies of your application: `$ php bin/console importmap:audit` » *(§ Run Security Audits on Your Dependencies)*

**Question 108 : C** — « The command will return the `0` exit code if no vulnerability is found, or the `1` exit code otherwise. (…) you can seamlessly integrate this command as part of your CI » *(§ Run Security Audits on Your Dependencies)*

**Question 109 : B** — « The command takes a `--format` option to choose the output format between `txt` and `json`. » *(§ Run Security Audits on Your Dependencies)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » dédiée (vérifié sur la source [asset_mapper.rst](https://github.com/symfony/symfony-docs/blob/8.0/frontend/asset_mapper.rst)) : pas de pages annexes à couvrir pour ce QCM.
