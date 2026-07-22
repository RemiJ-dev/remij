# QCM — Front-end : vue d'ensemble (AssetMapper, Reprise, Encore)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/frontend.html](https://symfony.com/doc/8.0/frontend.html) et les pages de sa section [Other Front-End Articles](https://symfony.com/doc/8.0/frontend.html#other-front-end-articles) (équivalent du « Learn more ») · **Généré le :** 22 juillet 2026
>
> **56 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Deux approches pour le front-end

### Question 1

Quelles sont les deux approches générales que Symfony permet pour construire le front-end d'une application ? *(plusieurs bonnes réponses)*

- [ ] **A.** Construire le HTML avec PHP & Twig
- [ ] **B.** Construire le front-end avec un framework JavaScript (React, Vue, Svelte…)
- [ ] **C.** Utiliser exclusivement un CMS headless tiers
- [ ] **D.** Générer le HTML côté client via WebAssembly

### Question 2

Quel outil est recommandé par la documentation pour utiliser Symfony comme une pure API derrière un framework front-end comme React ou Vue ? *(une seule bonne réponse)*

- [ ] **A.** Symfony Reprise
- [ ] **B.** Webpack Encore
- [ ] **C.** AssetMapper
- [ ] **D.** API Platform

### Question 3

Que fournit la distribution standard d'API Platform évoquée dans la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un backend API propulsé par Symfony
- [ ] **B.** Un scaffolding front-end en Next.js (d'autres frameworks sont aussi supportés)
- [ ] **C.** Une interface d'administration React
- [ ] **D.** Un serveur de base de données MongoDB préconfiguré

## Comparaison AssetMapper / Reprise / Encore

### Question 4

Selon le tableau comparatif, quels systèmes sont considérés comme « Production Ready » et « Stable » ? *(plusieurs bonnes réponses)*

- [ ] **A.** AssetMapper
- [ ] **B.** Symfony Reprise
- [ ] **C.** Webpack Encore
- [ ] **D.** Aucun des trois n'est actuellement stable

### Question 5

Quels prérequis techniques AssetMapper nécessite-t-il, par opposition à Reprise et Encore ? *(une seule bonne réponse)*

- [ ] **A.** Une installation de Node.js, comme Reprise et Encore
- [ ] **B.** Une base de données dédiée au cache des assets
- [ ] **C.** Un serveur Redis pour le cache de compilation
- [ ] **D.** Aucun prérequis particulier ; Reprise et Encore nécessitent tous deux Node.js

### Question 6

Parmi AssetMapper, Reprise et Encore, lesquels nécessitent une étape de build explicite avant de pouvoir servir les assets ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony Reprise
- [ ] **B.** Webpack Encore
- [ ] **C.** AssetMapper
- [ ] **D.** Aucun des trois ne nécessite de build

### Question 7

D'après le tableau, les trois systèmes fonctionnent-ils dans tous les navigateurs et supportent-ils Stimulus/UX ? *(une seule bonne réponse)*

- [ ] **A.** Seul AssetMapper supporte Stimulus/UX
- [ ] **B.** Reprise ne fonctionne que sur les navigateurs basés sur Chromium
- [ ] **C.** Oui pour les deux critères, dans les trois systèmes
- [ ] **D.** Seul Encore fonctionne dans tous les navigateurs

### Question 8

Concernant le support de React/Vue/Svelte, que précise la note [1] du tableau à propos d'AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** AssetMapper ne supporte aucun de ces frameworks, contrairement à Reprise et Encore
- [ ] **B.** Seul React est supporté par AssetMapper, pas Vue ni Svelte
- [ ] **C.** Le support de ces frameworks nécessite l'installation d'un plugin AssetMapper tiers non maintenu par Symfony
- [ ] **D.** Leur usage est possible mais nécessite les outils natifs de pré-compilation de ces frameworks, et certaines fonctionnalités (comme les composants monofichiers Vue) ne peuvent pas être compilées en JavaScript pur exécutable par un navigateur

### Question 9

Que propose la note [2] du tableau pour retirer les commentaires du JavaScript/CSS lors de la compilation des assets avec AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec AssetMapper, quel que soit l'outil utilisé
- [ ] **B.** Installer le SensioLabs Minify Bundle
- [ ] **C.** Configurer `Encore.configureCssMinimizerPlugin()`
- [ ] **D.** Activer une option native `strip_comments: true` d'AssetMapper

### Question 10

Comment Webpack Encore retire-t-il les commentaires CSS, selon la note [4] du tableau ? *(une seule bonne réponse)*

- [ ] **A.** Encore ne retire jamais les commentaires CSS, contrairement au JavaScript
- [ ] **B.** Via une dépendance Node.js externe non fournie par Encore
- [ ] **C.** Via `CssMinimizerPlugin`, inclus dans Webpack Encore et configurable via `Encore.configureCssMinimizerPlugin()`
- [ ] **D.** Via le SensioLabs Minify Bundle, comme pour AssetMapper

### Question 11

Concernant le versionnement des assets, quelle différence le tableau établit-il entre AssetMapper/Reprise et Encore ? *(une seule bonne réponse)*

- [ ] **A.** Encore versionne toujours les assets, alors que c'est optionnel avec AssetMapper et Reprise
- [ ] **B.** Aucun des trois systèmes ne verse les assets par défaut
- [ ] **C.** Seul Reprise propose le versionnement, les deux autres systèmes en étant dépourvus
- [ ] **D.** AssetMapper et Reprise versionnent toujours les assets, alors que c'est optionnel avec Encore

### Question 12

D'après la note [3] du tableau, comment mettre à jour les paquets tiers avec Reprise ou Encore, qui ne le permettent pas nativement contrairement à AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible avec aucun des trois systèmes
- [ ] **B.** En passant par la commande `bin/console assets:update`
- [ ] **C.** En utilisant des outils npm de vérification de mises à jour, comme `npm-check`
- [ ] **D.** En réinstallant intégralement le projet à chaque mise à jour

## AssetMapper

### Question 13

Sur quelle fonctionnalité du navigateur AssetMapper s'appuie-t-il pour fonctionner entièrement en PHP sans étape de build complexe, disponible dans tous les navigateurs grâce à un polyfill ? *(une seule bonne réponse)*

- [ ] **A.** Les Service Workers
- [ ] **B.** WebAssembly
- [ ] **C.** La fonctionnalité `importmap`
- [ ] **D.** Les Web Workers

## Symfony Reprise

### Question 14

Quel est le statut officiel de Symfony Reprise dans la documentation Symfony 8.0 ? *(une seule bonne réponse)*

- [ ] **A.** Stable et recommandé pour tous les nouveaux projets, en remplacement d'AssetMapper
- [ ] **B.** Déprécié au profit de Webpack Encore
- [ ] **C.** Réservé exclusivement aux projets internes de l'équipe Symfony
- [ ] **D.** Expérimental : son API et son comportement peuvent encore changer, parfois radicalement

### Question 15

Sur quels bundlers JavaScript modernes Symfony Reprise s'appuie-t-il, contrairement à Encore qui enveloppe Webpack ? *(une seule bonne réponse)*

- [ ] **A.** Turbopack et Bun
- [ ] **B.** Vite et Rsbuild
- [ ] **C.** Parcel et esbuild directement
- [ ] **D.** Rollup et Snowpack

### Question 16

Que gèrent déjà Vite et Rsbuild par eux-mêmes, sans que Reprise ait besoin de le fournir ? *(plusieurs bonnes réponses)*

- [ ] **A.** Sass/PostCSS et TypeScript
- [ ] **B.** JSX/Vue/Svelte, le code splitting, la minification et le Hot Module Replacement
- [ ] **C.** La génération d'`entrypoints.json` et de `manifest.json`
- [ ] **D.** L'intégration Symfony UX / Stimulus

### Question 17

Quelle « glue » côté Symfony Reprise ajoute-t-il par-dessus Vite/Rsbuild ? *(plusieurs bonnes réponses)*

- [ ] **A.** La génération d'`entrypoints.json` et de `manifest.json`, le versionnement des assets
- [ ] **B.** Le câblage du serveur de développement et des fonctions Twig pour générer les balises `<script>`/`<link>`
- [ ] **C.** L'intégration Symfony UX / Stimulus
- [ ] **D.** La compilation Sass/PostCSS, qui n'existe pas nativement dans Vite/Rsbuild

### Question 18

Pourquoi migrer depuis Webpack Encore vers Symfony Reprise est-il décrit comme un simple « tag-for-tag swap » dans les templates ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les deux bundlers partagent exactement la même configuration Webpack
- [ ] **B.** Parce qu'Encore et Reprise utilisent tous deux Vite en interne
- [ ] **C.** Ce n'est pas un swap simple : une réécriture complète des templates est nécessaire
- [ ] **D.** Parce que Reprise génère les mêmes `entrypoints.json` et `manifest.json` qu'Encore ; les fonctions `encore_entry_*` deviennent `reprise_entry_*`

### Question 19

Quelles commandes installent Symfony Reprise dans un projet ? *(une seule bonne réponse)*

- [ ] **A.** `npm install @symfony/reprise` uniquement, sans dépendance Composer
- [ ] **B.** `symfony new --reprise`
- [ ] **C.** `composer require symfony/reprise` puis `npm install @symfony/reprise --save-dev`
- [ ] **D.** `composer require symfony/webpack-encore-bundle` puis `npm install`

## Webpack Encore

### Question 20

Que fait Webpack Encore, décrit comme « une manière plus simple d'intégrer Webpack » à l'application ? *(une seule bonne réponse)*

- [ ] **A.** Il remplace entièrement Webpack par un bundler écrit en PHP
- [ ] **B.** Il ne fait que fournir une configuration Webpack par défaut, sans API dédiée
- [ ] **C.** Il s'agit d'un simple alias de ligne de commande vers `webpack-cli`
- [ ] **D.** Il enveloppe Webpack, offrant une API propre pour bundler des modules JavaScript, pré-traiter CSS/JS et compiler/minifier les assets

### Question 21

Quel conseil la documentation donne-t-elle concernant le choix entre AssetMapper et Webpack Encore pour un nouveau projet ? *(une seule bonne réponse)*

- [ ] **A.** Encore est recommandé pour tous les nouveaux projets, AssetMapper étant réservé à la maintenance de l'existant
- [ ] **B.** Les deux sont strictement équivalents, le choix étant purement une question de goût
- [ ] **C.** AssetMapper est déprécié au profit d'Encore depuis Symfony 8.0
- [ ] **D.** AssetMapper est recommandé pour les nouveaux projets ; Encore doit être choisi si on l'utilise déjà ou si un bundler JavaScript complet est nécessaire

### Question 22

Comment la documentation qualifie-t-elle désormais Webpack Encore par rapport à Symfony Reprise ? *(une seule bonne réponse)*

- [ ] **A.** Encore reste la seule option recommandée, Reprise n'étant qu'un projet expérimental sans avenir
- [ ] **B.** Encore va être supprimé de Symfony 9.0 au profit exclusif de Reprise
- [ ] **C.** Encore et Reprise sont interchangeables sans aucune nuance de recommandation
- [ ] **D.** C'est désormais l'option « bundler » historique (legacy) de Symfony ; pour un nouveau projet nécessitant un bundler, Reprise est conseillé comme alternative plus moderne et rapide

### Question 23

Par défaut, quel système utilisent les nouveaux projets webapp créés avec `symfony new --webapp myapp` ? *(une seule bonne réponse)*

- [ ] **A.** Webpack Encore
- [ ] **B.** Symfony Reprise
- [ ] **C.** Aucun système d'assets n'est installé par défaut
- [ ] **D.** AssetMapper

### Question 24

Que faut-il faire pour basculer un nouveau projet webapp d'AssetMapper vers Webpack Encore, en conservant Turbo/Stimulus ? *(une seule bonne réponse)*

- [ ] **A.** Simplement lancer `composer require symfony/webpack-encore-bundle`, sans autre modification
- [ ] **B.** Ce n'est pas possible : une fois AssetMapper choisi à la création du projet, il ne peut plus être remplacé
- [ ] **C.** Modifier uniquement le fichier `importmap.php`, sans toucher aux dépendances Composer
- [ ] **D.** Retirer `symfony/ux-turbo`, `symfony/asset-mapper` et `symfony/stimulus-bundle`, puis réinstaller `symfony/webpack-encore-bundle`, `symfony/ux-turbo` et `symfony/stimulus-bundle`, puis lancer `npm install` et `npm run dev`

## Stimulus, Symfony UX et frameworks front-end

### Question 25

Une fois AssetMapper ou Webpack Encore installé, quels outils la documentation recommande-t-elle pour écrire le JavaScript de l'application ? *(plusieurs bonnes réponses)*

- [ ] **A.** Stimulus
- [ ] **B.** Turbo
- [ ] **C.** Symfony UX
- [ ] **D.** jQuery, systématiquement recommandé en complément

### Question 26

Si l'on souhaite utiliser un framework front-end comme Next.js, React, Vue ou Svelte, quelle approche la documentation recommande-t-elle plutôt que d'utiliser Symfony pour générer le HTML ? *(une seule bonne réponse)*

- [ ] **A.** Toujours utiliser AssetMapper avec un import map pointant vers le framework
- [ ] **B.** Éviter ces frameworks, Symfony n'ayant pas de solution recommandée pour ce cas
- [ ] **C.** Utiliser les outils natifs du framework et employer Symfony comme une pure API
- [ ] **D.** Toujours utiliser Webpack Encore pour intégrer le framework directement dans les templates Twig

## Créer un bundle UX

### Question 27

Quel mot-clé le fichier `composer.json` d'un bundle doit-il contenir pour s'installer comme un « bundle UX » ? *(une seule bonne réponse)*

- [ ] **A.** `symfony-bundle`
- [ ] **B.** `symfony-stimulus`
- [ ] **C.** `ux-component`
- [ ] **D.** `symfony-ux`

### Question 28

Dans quels répertoires les assets d'un bundle UX peuvent-ils être placés pour que Flex les gère à l'installation/mise à jour ? *(plusieurs bonnes réponses)*

- [ ] **A.** `/assets` (recommandé)
- [ ] **B.** `/Resources/assets`
- [ ] **C.** `/src/Resources/assets`
- [ ] **D.** `/public/vendor-assets`

### Question 29

Que doit contenir le fichier `package.json` d'un bundle UX, en plus de la configuration `symfony.controllers` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `peerDependencies`, `importmap` n'étant pas nécessaire pour un bundle UX
- [ ] **B.** Uniquement `importmap`, `peerDependencies` étant réservé aux applications, jamais aux bundles
- [ ] **C.** Un fichier `symfony.lock` listant les versions figées des dépendances
- [ ] **D.** Les paquets requis à la fois dans `peerDependencies` et dans `importmap`, avec la même liste dans les deux

### Question 30

Dans la configuration `symfony.controllers` du `package.json`, à quoi sert l'option `fetch: 'lazy'` d'un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver totalement le contrôleur par défaut
- [ ] **B.** Précharger le contrôleur avant même que la page ne soit demandée par le navigateur
- [ ] **C.** Isoler le contrôleur et ses dépendances dans un fichier séparé, téléchargé de manière asynchrone seulement quand le `data-controller` apparaît sur la page
- [ ] **D.** Retarder le chargement de la page entière tant que le contrôleur n'est pas téléchargé

### Question 31

Quelle est la valeur par défaut de l'option `fetch`, qui inclut le contrôleur et ses dépendances dans le JavaScript téléchargé au chargement de la page ? *(une seule bonne réponse)*

- [ ] **A.** `immediate`
- [ ] **B.** `eager`
- [ ] **C.** `lazy`
- [ ] **D.** `preload`

### Question 32

À quoi sert l'option `autoimport` d'un contrôleur dans `package.json` ? *(une seule bonne réponse)*

- [ ] **A.** Définir automatiquement les imports ES6 du fichier `controller.js`, sans intervention du développeur
- [ ] **B.** Importer automatiquement toutes les dépendances listées dans `peerDependencies`
- [ ] **C.** Activer le rechargement à chaud (HMR) du contrôleur
- [ ] **D.** Lister des fichiers à importer avec le contrôleur (ex. plusieurs thèmes CSS Bootstrap 4/5), chaque fichier étant associé à un booléen indiquant s'il doit être importé

### Question 33

Comment un contrôleur Stimulus écrit en TypeScript est-il transpilé en JavaScript, selon l'exemple donné (avec quel outil) ? *(une seule bonne réponse)*

- [ ] **A.** Via Webpack Encore uniquement, quel que soit le système d'assets utilisé
- [ ] **B.** Via Babel (`@babel/preset-typescript`), avec un script `build` dans `package.json` et un fichier `babel.config.js`
- [ ] **C.** Via `tsc`, le compilateur officiel de TypeScript, sans configuration Babel
- [ ] **D.** La transpilation est faite automatiquement par AssetMapper, sans outil supplémentaire

### Question 34

Quelle fonction Twig permet d'utiliser un contrôleur Stimulus d'un bundle dans un template, et que génère-t-elle concrètement ? *(une seule bonne réponse)*

- [ ] **A.** `ux_controller()`, réservée aux composants Symfony UX officiels
- [ ] **B.** `encore_entry_script_tags()`, commune à tous les bundles UX
- [ ] **C.** `stimulus_controller()`, qui génère les attributs `data-controller` et `data-*-value` correspondants
- [ ] **D.** `stimulus_action()`, qui génère uniquement l'attribut `data-action`

### Question 35

Quelle dépendance Composer minimale faut-il ajouter pour utiliser les fonctions Twig `stimulus_*` ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/webpack-encore-bundle:^2.0`
- [ ] **B.** `symfony/stimulus-bundle:^2.9`
- [ ] **C.** `symfony/ux-turbo:^2.0`
- [ ] **D.** `symfony/asset-mapper:^7.0`

### Question 36

Si le nom du paquet PHP est `acme/feature` et que le contrôleur s'appelle `slug` dans `package.json`, quel est le nom complet du contrôleur côté Stimulus (utilisé dans l'attribut `data-controller` généré) ? *(une seule bonne réponse)*

- [ ] **A.** `AcmeFeatureSlug`
- [ ] **B.** `acme--feature--slug`
- [ ] **C.** `acme/feature/slug`
- [ ] **D.** `acme.feature.slug`

### Question 37

Pour rendre les assets d'un bundle compatibles avec AssetMapper, que doit faire la classe du bundle (étendant `AbstractBundle`) en plus de la config `importmap` dans `package.json` ? *(une seule bonne réponse)*

- [ ] **A.** Créer un fichier `assets.yaml` séparé à la racine du bundle
- [ ] **B.** Utiliser `prependExtensionConfig()` dans `prependExtension()` pour ajouter un chemin `asset_mapper.paths` pointant vers le dossier des assets compilés du bundle
- [ ] **C.** Rien de plus : la configuration `package.json` suffit intégralement pour AssetMapper
- [ ] **D.** Déclarer un service taggé `asset_mapper.bundle_path`

### Question 38

Comment un bundle vérifie-t-il, avant de prépendre sa configuration AssetMapper, que ce composant est bien disponible dans l'application hôte ? *(une seule bonne réponse)*

- [ ] **A.** AssetMapper étant toujours disponible depuis Symfony 6.3, aucune vérification n'est nécessaire
- [ ] **B.** En vérifiant `interface_exists(AssetMapperInterface::class)` et la présence des métadonnées du bundle FrameworkBundle (fichier `asset_mapper.php`)
- [ ] **C.** En interrogeant le conteneur de services à l'exécution via `$container->has('asset_mapper')`
- [ ] **D.** En vérifiant simplement la version de Symfony installée dans `composer.lock`

## Stratégie de versionnement personnalisée des assets

### Question 39

À quoi sert la technique de versionnement des assets (ajout d'un identifiant de version à l'URL des assets statiques) ? *(une seule bonne réponse)*

- [ ] **A.** Réduire la taille des fichiers grâce à la minification
- [ ] **B.** Empêcher tout accès direct aux fichiers d'assets depuis une URL publique
- [ ] **C.** Forcer le navigateur à retélécharger l'asset quand son contenu change, au lieu de réutiliser une version en cache
- [ ] **D.** Chiffrer le contenu des fichiers CSS/JS pour les protéger du vol de code

### Question 40

Quelles options de configuration natives Symfony fournit-il pour le cache busting des assets, avant d'avoir besoin d'une stratégie personnalisée ? *(plusieurs bonnes réponses)*

- [ ] **A.** `version`
- [ ] **B.** `version_format`
- [ ] **C.** `json_manifest_path`
- [ ] **D.** `cache_buster_secret`

### Question 41

Quelle interface une stratégie de versionnement d'assets personnalisée doit-elle implémenter ? *(une seule bonne réponse)*

- [ ] **A.** `CacheBusterInterface`
- [ ] **B.** `AssetMapperInterface`
- [ ] **C.** `VersionStrategyInterface`
- [ ] **D.** `AssetVersionInterface`

### Question 42

Dans l'exemple `JsonHashVersionStrategy`, à quoi correspond la valeur retournée par `getVersion()` pour un asset donné ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le hash de contenu du fichier, sans référence à la version de l'application
- [ ] **B.** Un horodatage Unix généré à chaque requête
- [ ] **C.** Toujours la même chaîne statique définie dans le constructeur
- [ ] **D.** La combinaison de la version globale de l'application et du hash de contenu du fichier lu dans le fichier de mapping JSON

### Question 43

Que fait la méthode `applyVersion()` de l'exemple `JsonHashVersionStrategy` si `getVersion()` retourne une chaîne vide (asset absent du mapping) ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne une chaîne vide, sans le chemin de l'asset
- [ ] **B.** Elle utilise un hash de secours généré aléatoirement
- [ ] **C.** Elle retourne le chemin de l'asset inchangé
- [ ] **D.** Elle lève une exception `AssetNotFoundException`

### Question 44

Quelle est la valeur par défaut du format de version (`$format`) dans le constructeur de `JsonHashVersionStrategy`, s'il n'est pas fourni ? *(une seule bonne réponse)*

- [ ] **A.** `'%s.%s'`
- [ ] **B.** `'%s#%s'`
- [ ] **C.** `'v%s/%s'`
- [ ] **D.** `'%s?%s'`

### Question 45

Une fois la classe de stratégie créée, comment est-elle enregistrée comme service, en particulier ses arguments ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement par autowiring, sans configuration explicite des arguments
- [ ] **B.** Via une commande `bin/console assets:register-strategy`
- [ ] **C.** En l'ajoutant à `config/packages/framework.yaml` directement comme argument de `version_strategy`
- [ ] **D.** Via `config/services.yaml`, avec trois arguments : le chemin du fichier manifeste, la version de l'application (`%env(APP_VERSION)%`), et le format

### Question 46

À quoi sert la variable d'environnement `APP_VERSION` utilisée par la stratégie de versionnement de l'exemple, et quand doit-elle être définie ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'est utilisée qu'en environnement de test, jamais en production
- [ ] **B.** Elle contient la version courante de l'application (ex. hash de commit Git ou tag de release), à définir pendant le déploiement pour qu'elle change à chaque nouvelle release
- [ ] **C.** Elle contient la version de PHP utilisée par le serveur, définie une fois pour toutes à l'installation
- [ ] **D.** Elle contient le numéro de version de Symfony, mise à jour automatiquement par Composer

### Question 47

Quelle option de configuration active la stratégie de versionnement personnalisée pour l'ensemble des assets de l'application ? *(une seule bonne réponse)*

- [ ] **A.** `framework.assets.custom_strategy`
- [ ] **B.** `framework.asset_mapper.version_strategy`
- [ ] **C.** `framework.assets.strategy_service`
- [ ] **D.** `framework.assets.version_strategy`

## Passer des données de Twig vers JavaScript

### Question 48

Quelle technique la documentation recommande-t-elle pour transmettre des données dynamiques (ex. informations utilisateur) de Twig vers du code JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser exclusivement les cookies de session pour transmettre ces données
- [ ] **B.** Stocker les informations dans des attributs `data-*` et les lire ensuite en JavaScript
- [ ] **C.** Injecter directement du PHP dans un fichier `.js` via un contrôleur dédié
- [ ] **D.** Passer systématiquement par un appel AJAX supplémentaire après le chargement de la page

### Question 49

Comment les noms des attributs `data-*` sont-ils convertis lorsqu'on y accède via la propriété `dataset` de JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** Les tirets sont remplacés par des underscores, sans passage en camelCase
- [ ] **B.** Du style à tirets vers le camelCase, ex. `data-number-of-reviews` devient `dataset.numberOfReviews`
- [ ] **C.** Du camelCase vers le style à tirets, dans le sens inverse
- [ ] **D.** Aucune conversion n'est appliquée, le nom reste identique

### Question 50

Existe-t-il une limite de taille pour la valeur d'un attribut `data-*` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, une limite de 4096 caractères, comme pour les tokens CSRF
- [ ] **B.** Oui, une limite de 255 caractères
- [ ] **C.** Oui, mais uniquement dans les navigateurs basés sur WebKit
- [ ] **D.** Non, il n'y a aucune limite de taille, on peut y stocker n'importe quel contenu

### Question 51

Quelle stratégie d'échappement Twig faut-il utiliser pour stocker du JSON dans un attribut `data-*` sans casser le HTML ? *(une seule bonne réponse)*

- [ ] **A.** La stratégie d'échappement `js`, réservée aux balises `<script>`
- [ ] **B.** Aucun échappement n'est nécessaire pour les attributs `data-*`
- [ ] **C.** La stratégie d'échappement `css`
- [ ] **D.** La stratégie d'échappement `html`, ex. `|json_encode|e('html')`

## Récapitulatif

### Question 52

Quels sont les trois systèmes comparés par la page d'introduction du front-end Symfony 8.0 ? *(plusieurs bonnes réponses)*

- [ ] **A.** AssetMapper
- [ ] **B.** Symfony Reprise
- [ ] **C.** Webpack Encore
- [ ] **D.** Vite CLI, utilisé indépendamment des trois autres

### Question 53

Symfony Reprise est-il référencé sur la page d'accueil de la documentation Symfony (symfony.com/doc/8.0), au même titre qu'AssetMapper et Encore ? *(une seule bonne réponse)*

- [ ] **A.** Non, Reprise n'est mentionné nulle part dans la documentation officielle Symfony 8.0
- [ ] **B.** Oui, mais uniquement dans la section « Production »
- [ ] **C.** Non, probablement en raison de son statut expérimental ; il n'apparaît que sur la page d'introduction du Front-end
- [ ] **D.** Oui, il dispose de sa propre entrée dédiée sur la page d'accueil

### Question 54

Quels sont, au total, les trois articles listés dans la section « Other Front-End Articles » de la page d'introduction ? *(plusieurs bonnes réponses)*

- [ ] **A.** Create a UX bundle
- [ ] **B.** How to Use a Custom Version Strategy for Assets
- [ ] **C.** Passing Information from Twig to JavaScript
- [ ] **D.** How to Configure Webpack Encore from Scratch

### Question 55

Quel projet Symfony propose des captures d'écran (« screencasts ») pour AssetMapper, Webpack Encore et l'utilisation d'un framework front-end via API Platform ? *(une seule bonne réponse)*

- [ ] **A.** Le blog officiel Symfony
- [ ] **B.** La chaîne YouTube SensioLabs
- [ ] **C.** SymfonyCasts
- [ ] **D.** Symfony UX

### Question 56

Le tableau comparatif liste-t-il le support de Stimulus/UX comme identique pour AssetMapper, Reprise et Encore ? *(une seule bonne réponse)*

- [ ] **A.** Non, aucun des trois ne le supporte directement sans plugin tiers
- [ ] **B.** Oui, les trois systèmes supportent Stimulus/UX
- [ ] **C.** Non, seul AssetMapper le supporte nativement
- [ ] **D.** Non, seul Encore le supporte, Reprise étant encore expérimental sur ce point

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Front-end de la documentation Symfony 8.0](https://symfony.com/doc/8.0/frontend.html) ; les entrées préfixées renvoient à l'une des pages de sa section Other Front-End Articles (Create a UX bundle, Custom Version Strategy, Server-data).

**Question 1 : A, B** — « There are generally two approaches: building your HTML with PHP & Twig; building your frontend with a JavaScript framework like React, Vue, Svelte, etc. Both work great » *(§ Front-end Tools: Handling CSS & JavaScript)*

**Question 2 : D** — « we recommend using their native tools and using Symfony as a pure API. A wonderful tool to do that is API Platform. » *(§ Using a Front-end Framework)*

**Question 3 : A, B, C** — « Their standard distribution comes with a Symfony-powered API backend, frontend scaffolding in Next.js (other frameworks are also supported) and a React admin interface. » *(§ Using a Front-end Framework)*

**Question 4 : A, C** — tableau comparatif : « Production Ready? — AssetMapper: yes, Reprise: no, Encore: yes » et « Stable? — AssetMapper: yes, Reprise: no, Encore: yes ». *(§ Using PHP & Twig)*

**Question 5 : D** — tableau comparatif : « Requirements — AssetMapper: none, Reprise: Node.js, Encore: Node.js » *(§ Using PHP & Twig)*

**Question 6 : A, B** — tableau comparatif : « Requires a build step? — AssetMapper: no, Reprise: yes, Encore: yes » *(§ Using PHP & Twig)*

**Question 7 : C** — tableau comparatif : « Works in all browsers? — yes/yes/yes » et « Supports Stimulus/UX — yes/yes/yes » *(§ Using PHP & Twig)*

**Question 8 : D** — « **[1]** Using JSX (React), Vue, etc with AssetMapper is possible, but you'll need to use their native tools for pre-compilation. Also, some features (like Vue single-file components) cannot be compiled down to pure JavaScript that can be executed by a browser. » *(§ Using PHP & Twig)*

**Question 9 : B** — « **[2]** You can install the SensioLabs Minify Bundle to minify CSS/JS code (and remove all comments) when compiling assets with AssetMapper. » *(§ Using PHP & Twig)*

**Question 10 : C** — « **[4]** CSS comments can be removed using CssMinimizerPlugin, which is included in Webpack Encore and configurable via `Encore.configureCssMinimizerPlugin()`. » *(§ Using PHP & Twig)*

**Question 11 : D** — tableau comparatif : « Versioned assets — AssetMapper: always, Reprise: always, Encore: optional » *(§ Using PHP & Twig)*

**Question 12 : C** — « **[3]** If you use `npm`, there are update checkers available (e.g. `npm-check`). » *(§ Using PHP & Twig)*

**Question 13 : C** — « It does this by leveraging the `importmap` feature of your browser, which is available in all browsers thanks to a polyfill. » *(§ AssetMapper (Recommended))*

**Question 14 : D** — « Symfony Reprise is **experimental**: its API and behavior may still change, sometimes drastically. » *(§ Symfony Reprise)*

**Question 15 : B** — « Instead of wrapping Webpack, it brings first-class Symfony integration to today's JavaScript bundlers, Vite and Rsbuild » *(§ Symfony Reprise)*

**Question 16 : A, B** — « Vite and Rsbuild already handle Sass/PostCSS, TypeScript, JSX/Vue/Svelte, code splitting, minification and Hot Module Replacement on their own. » *(§ Symfony Reprise)*

**Question 17 : A, B, C** — « Reprise adds the Symfony-side glue those bundlers leave out: `entrypoints.json` and `manifest.json` generation, asset versioning, the dev server wiring, Twig functions to render the `<script>` and `<link>` tags, and Symfony UX / Stimulus integration. » *(§ Symfony Reprise)*

**Question 18 : D** — « Because it generates the same `entrypoints.json` and `manifest.json` as Webpack Encore, moving from Encore is mostly a tag-for-tag swap in your templates (`encore_entry_*` becomes `reprise_entry_*`). » *(§ Symfony Reprise)*

**Question 19 : C** — « `$ composer require symfony/reprise` / `$ npm install @symfony/reprise --save-dev` » *(§ Symfony Reprise)*

**Question 20 : D** — « Webpack Encore is a simpler way to integrate Webpack into your application. It wraps Webpack, giving you a clean & powerful API for bundling JavaScript modules, pre-processing CSS & JS and compiling and minifying assets. » *(§ Webpack Encore)*

**Question 21 : D** — « Webpack Encore is fully supported, but **for new projects AssetMapper is recommended**. Choose Encore when you already use it, or when you need a full JavaScript bundler. » *(§ Webpack Encore)*

**Question 22 : D** — « Webpack Encore is now Symfony's legacy bundler-based option. It's still supported, but if you're starting a new project that needs a bundler, consider Symfony Reprise, a more modern and faster alternative » *(§ Webpack Encore)*

**Question 23 : D** — « By default, new Symfony webapp projects (created with `symfony new --webapp myapp`) use AssetMapper. » *(§ Switch from AssetMapper)*

**Question 24 : D** — « `composer remove symfony/ux-turbo symfony/asset-mapper symfony/stimulus-bundle` (…) `composer require symfony/webpack-encore-bundle symfony/ux-turbo symfony/stimulus-bundle` (…) `npm install` / `npm run dev` » *(§ Switch from AssetMapper)*

**Question 25 : A, B, C** — « we recommend using Stimulus, Turbo and a set of tools called Symfony UX. » *(§ Stimulus & Symfony UX Components)*

**Question 26 : C** — « we recommend using their native tools and using Symfony as a pure API. » *(§ Using a Front-end Framework)*

**Question 27 : D** — « Your `composer.json` file must have the `symfony-ux` keyword » *(Create a UX bundle — § composer.json file)*

**Question 28 : A, B, C** — « Your assets must be located in one of the following directories (…): `/assets` (recommended), `/Resources/assets`, `/src/Resources/assets` » *(Create a UX bundle — § Assets location)*

**Question 29 : D** — « Your `package.json` file must contain a `symfony` config with controllers defined, and also add required packages to the `peerDependencies` and `importmap` (the list of packages in `importmap` should be the same as the ones in `peerDependencies`) » *(Create a UX bundle — § package.json file)*

**Question 30 : C** — « Use `lazy` to make controller & dependencies isolated into a separate file and only downloaded asynchronously if (and when) the data-controller HTML appears on the page. » *(Create a UX bundle — § package.json file)*

**Question 31 : B** — « Use `eager` (default) to make controller & dependencies included in the JavaScript that's downloaded when the page is loaded. » *(Create a UX bundle — § package.json file)*

**Question 32 : D** — « `autoimport`: List of files to be imported with the controller. Useful e.g. when there are several CSS styles depending on the frontend framework used (…) The value must be an object with files as keys, and a boolean as value for each file » *(Create a UX bundle — § package.json file)*

**Question 33 : B** — « Add the following to your `package.json` file: `"build": "babel src --extensions .ts -d dist"` (…) Add the following to your `babel.config.js` file (…) `@babel/preset-typescript` » *(Create a UX bundle — § package.json file)*

**Question 34 : C** — « `{{ stimulus_controller('acme/feature/slug', { modal: 'my-value' }) }}` will render: `data-controller="acme--feature--slug"` `data-acme--feature--slug-modal-value="my-value"` » *(Create a UX bundle — § package.json file)*

**Question 35 : B** — « Don't forget to add `symfony/stimulus-bundle:^2.9` as a composer dependency to use Twig `stimulus_*` functions. » *(Create a UX bundle — § package.json file)*

**Question 36 : B** — « the `name` of the PHP package is `acme/feature` and the name of the controller in `package.json` is `slug`. So, the full controller name for Stimulus will be `acme--feature--slug` » *(Create a UX bundle — § package.json file)*

**Question 37 : B** — « you must add the `importmap` config like above in your `package.json` file, and prepend some configuration to the container (…) `$builder->prependExtensionConfig('framework', ['asset_mapper' => ['paths' => [...]]])` » *(Create a UX bundle — § Specifics for Asset Mapper)*

**Question 38 : B** — « `interface_exists(AssetMapperInterface::class)` (…) check that FrameworkBundle 6.3 or higher is installed (…) `is_file($bundlesMetadata['FrameworkBundle']['path'] . '/Resources/config/asset_mapper.php')` » *(Create a UX bundle — § Specifics for Asset Mapper)*

**Question 39 : C** — « adding a version identifier to the URL of the static assets (…) When the content of the asset changes, its identifier is also modified to force the browser to download it again instead of reusing the cached asset. » *(Custom Version Strategy — § How to Use a Custom Version Strategy for Assets)*

**Question 40 : A, B, C** — « Symfony provides various cache busting implementations via the `version`, `version_format`, and `json_manifest_path` configuration options. » *(Custom Version Strategy — § How to Use a Custom Version Strategy for Assets)*

**Question 41 : C** — « Asset version strategies are PHP classes that implement the `VersionStrategyInterface`. » *(Custom Version Strategy — § Implement VersionStrategyInterface)*

**Question 42 : D** — « combine the global application version with the file content hash, so the URL changes both on every release and whenever the file changes — `return $this->appVersion.'.'.$this->hashes[$path];` » *(Custom Version Strategy — § Implement VersionStrategyInterface)*

**Question 43 : C** — « `if ('' === $version) { return $path; }` » *(Custom Version Strategy — § Implement VersionStrategyInterface)*

**Question 44 : D** — « `$this->format = $format ?: '%s?%s';` » *(Custom Version Strategy — § Implement VersionStrategyInterface)*

**Question 45 : D** — « register it as a Symfony service (…) `arguments: - "%kernel.project_dir%/hashes.json" - "%env(APP_VERSION)%" - "%%s?version=%%s"` » *(Custom Version Strategy — § Register the Strategy Service)*

**Question 46 : B** — « The `APP_VERSION` environment variable holds the current application version (e.g. the Git commit hash or the release tag). Define it during your deployment process so it changes with every new release. » *(Custom Version Strategy — § Register the Strategy Service)*

**Question 47 : D** — « enable the new asset versioning for all the application assets (…) thanks to the `version_strategy` option: `framework: assets: version_strategy: 'App\Asset\VersionStrategy\JsonHashVersionStrategy'` » *(Custom Version Strategy — § Register the Strategy Service)*

**Question 48 : B** — « One great way to pass dynamic configuration is by storing information in `data-*` attributes and reading them later in JavaScript. » *(Server-data — § Passing Information from Twig to JavaScript)*

**Question 49 : B** — « the attribute names are converted from dash-style to camelCase. For example, `data-number-of-reviews` becomes `dataset.numberOfReviews` » *(Server-data — § Passing Information from Twig to JavaScript)*

**Question 50 : D** — « There is no size limit for the value of the `data-*` attributes, so you can store any content. » *(Server-data — § Passing Information from Twig to JavaScript)*

**Question 51 : D** — « In Twig, use the `html` escaping strategy to avoid messing with HTML attributes. » *(Server-data — § Passing Information from Twig to JavaScript)*

**Question 52 : A, B, C** — le tableau comparatif de la page d'introduction compare AssetMapper, Symfony Reprise et Webpack Encore. *(§ Using PHP & Twig)*

**Question 53 : C** — constat éditorial du corpus : Reprise n'est pas listé sur la page d'accueil de la documentation (probablement en raison de son statut expérimental), mais est bien documenté sur la page Front-end elle-même. *(§ Symfony Reprise)*

**Question 54 : A, B, C** — « Other Front-End Articles: `/frontend/create_ux_bundle`, `/frontend/custom_version_strategy`, `/frontend/server-data` » *(§ Other Front-End Articles)*

**Question 55 : C** — « Check out the AssetMapper screencast series (…) Webpack Encore screencast series (…) API Platform screencast series » — toutes hébergées sur SymfonyCasts. *(§ AssetMapper (Recommended) / Webpack Encore / Using a Front-end Framework)*

**Question 56 : B** — tableau comparatif : « Supports Stimulus/UX — yes / yes / yes » *(§ Using PHP & Twig)*

## Pour aller plus loin

Les pages listées dans la section [Other Front-End Articles](https://symfony.com/doc/8.0/frontend.html#other-front-end-articles) de la page :

- [How to Create a UX Bundle](https://symfony.com/doc/8.0/frontend/create_ux_bundle.html) — questions 27 à 38
- [How to Create a Custom Version Strategy](https://symfony.com/doc/8.0/frontend/custom_version_strategy.html) — questions 39 à 47
- [How to Pass Server-Side Data to JavaScript](https://symfony.com/doc/8.0/frontend/server-data.html) — questions 48 à 51
