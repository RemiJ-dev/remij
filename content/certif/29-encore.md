# QCM — Webpack Encore

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/frontend/encore/index.html](https://symfony.com/doc/8.0/frontend/encore/index.html) et l'ensemble des ~21 pages qu'elle indexe (voir [Pour aller plus loin](#pour-aller-plus-loin) en fin de fichier) · **Généré le :** 23 juillet 2026
>
> **190 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

> **Remarque :** `frontend/encore/index.html` n'a quasiment pas de contenu propre — c'est une page d'index qui liste ~21 sous-pages groupées en 5 catégories (Getting Started, Adding more Features, Optimizing, Guides, Issues & Questions). Les questions ci-dessous sont donc réparties par catégorie et par sous-page plutôt que par « page principale + annexes ».

## Installation d'Encore

### Question 1

Quel changement majeur apporte Webpack Encore 7.0 concernant le format du package ? *(une seule bonne réponse)*

- [ ] **A.** Il abandonne Webpack au profit d'esbuild
- [ ] **B.** Il nécessite PHP 8.3 minimum côté Symfony
- [ ] **C.** Il rend obsolète le fichier `webpack.config.js`, remplacé par une configuration YAML
- [ ] **D.** Il devient ESM-only : `webpack.config.js` doit utiliser `import`/`export`, `package.json` doit déclarer `"type": "module"` (ou le fichier doit être renommé `webpack.config.mjs`), et `getWebpackConfig()` devient asynchrone

### Question 2

Avant Encore 7.0, comment `webpack.config.js` était-il écrit ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existait pas de fichier de configuration avant la 7.0
- [ ] **B.** En CommonJS (`const Encore = require(...)`, `module.exports = Encore.getWebpackConfig()`), et `getWebpackConfig()` était synchrone
- [ ] **C.** Déjà en ESM, seule la structure des entrées changeait
- [ ] **D.** En TypeScript obligatoirement

### Question 3

Que se passe-t-il en installant Encore dans une application Symfony qui utilise Flex, après `composer require symfony/webpack-encore-bundle` et `npm install` ? *(une seule bonne réponse)*

- [ ] **A.** Flex configure aussi automatiquement Sass, React et TypeScript
- [ ] **B.** Flex installe/active `WebpackEncoreBundle`, crée le répertoire `assets/`, ajoute un fichier `webpack.config.js`, et ajoute `node_modules/` au `.gitignore`
- [ ] **C.** Rien d'automatique, tous ces fichiers doivent être créés à la main
- [ ] **D.** Flex installe uniquement le bundle PHP, sans toucher au répertoire `assets/`

### Question 4

Comment installer Encore dans un projet qui n'est **pas** basé sur Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `yarn global add webpack-encore`
- [ ] **B.** `npm install @symfony/webpack-encore --save-dev`, ce qui crée/modifie `package.json` et installe les dépendances dans `node_modules/`
- [ ] **C.** `composer require symfony/webpack-encore-bundle`, sans dépendance npm
- [ ] **D.** Ce n'est pas possible, Encore nécessite obligatoirement Symfony

### Question 5

Que recommande la documentation de committer ou d'ignorer dans le contrôle de version ? *(une seule bonne réponse)*

- [ ] **A.** Committer `package-lock.json` mais pas `package.json`
- [ ] **B.** Committer `package.json` et `package-lock.json`, ignorer `node_modules/`
- [ ] **C.** Committer `node_modules/` pour garantir des builds reproductibles
- [ ] **D.** Ignorer `package.json`, uniquement utile en local

### Question 6

Que configurent respectivement `setOutputPath()` et `setPublicPath()` ? *(une seule bonne réponse)*

- [ ] **A.** Les deux définissent la même chose, redondants l'un avec l'autre
- [ ] **B.** `setOutputPath()` configure le CDN, `setPublicPath()` le répertoire local
- [ ] **C.** `setPublicPath()` n'existe plus depuis Encore 7.0
- [ ] **D.** `setOutputPath()` définit le répertoire où seront stockés les assets compilés ; `setPublicPath()` définit le chemin public utilisé par le serveur web pour y accéder

### Question 7

Quand faut-il utiliser `setManifestKeyPrefix()`, d'après le commentaire du fichier de configuration généré par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en environnement de développement
- [ ] **B.** Seulement quand `enableVersioning()` est désactivé
- [ ] **C.** Uniquement pour les CDN ou un déploiement dans un sous-répertoire
- [ ] **D.** À chaque projet, sans exception

### Question 8

Que fait `enableSingleRuntimeChunk()` ? *(une seule bonne réponse)*

- [ ] **A.** Il fusionne obligatoirement tous les fichiers CSS en un seul
- [ ] **B.** Il empêche l'utilisation de `splitEntryChunks()`
- [ ] **C.** Il nécessite une balise `<script>` supplémentaire pour `runtime.js`, mais c'est recommandé sauf si l'on construit une single-page app
- [ ] **D.** Il désactive le découpage en chunks pour tous les entries

### Question 9

À partir de quelle version de WebpackEncoreBundle `enableIntegrityHashes()` (attributs `integrity="..."`) est-elle disponible ? *(une seule bonne réponse)*

- [ ] **A.** 3.0
- [ ] **B.** 1.0
- [ ] **C.** 1.4
- [ ] **D.** 2.0

### Question 10

Pourquoi utiliser `autoProvidejQuery()`, selon le commentaire du fichier de configuration par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Pour désactiver Babel
- [ ] **B.** Pour forcer l'utilisation de Sass
- [ ] **C.** Si l'on rencontre des problèmes avec un plugin jQuery
- [ ] **D.** Pour activer TypeScript

### Question 11

Que contient le fichier `assets/controllers.json` généré à l'installation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une clé `"controllers"`
- [ ] **B.** Une clé `"entrypoints"`
- [ ] **C.** Une clé `"presets"`
- [ ] **D.** Une clé `"loaders"`

### Question 12

Que produisent respectivement les scripts npm `watch`, `dev` et `build` ajoutés dans `package.json` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `watch` : `encore dev --watch`, compile et recompile automatiquement au changement de fichier
- [ ] **B.** `dev` : `encore dev`, compile une seule fois
- [ ] **C.** `build` : `encore production --progress`, pour un build de production
- [ ] **D.** `build` : lance les tests unitaires PHPUnit

## Premiers pas : configuration et structure du projet

### Question 13

Que fait le job d'Encore (via Webpack), décrit dans la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Remplacer PHP par du JavaScript côté serveur
- [ ] **B.** Lire et suivre tous les imports puis créer un `app.js` (et `app.css`) final contenant tout ce dont l'app a besoin
- [ ] **C.** Uniquement minifier les fichiers, sans suivre les imports
- [ ] **D.** Générer directement du HTML statique

### Question 14

Quel est le rôle clé de `addEntry()` dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** Il active la minification en production
- [ ] **B.** Il indique à Encore de charger le fichier donné et de suivre tous ses imports, pour produire les fichiers finaux (ex. `app.js`/`app.css`) dans `public/build`
- [ ] **C.** Il sert uniquement à déclarer des alias de chemins
- [ ] **D.** Il configure le serveur de développement

### Question 15

Que font respectivement les commandes `npm run watch` et `npm run dev-server` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `watch` : compile les assets et recompile automatiquement au changement de fichier
- [ ] **B.** `dev-server` : lance un serveur qui peut parfois mettre à jour le code sans recharger la page
- [ ] **C.** Les deux commandes sont strictement identiques
- [ ] **D.** `dev-server` compile toujours pour la production

### Question 16

Que faut-il faire après toute modification du fichier `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** Rien, les changements sont pris en compte à chaud automatiquement
- [ ] **B.** Relancer `composer install`
- [ ] **C.** Vider le cache Symfony via `bin/console cache:clear`
- [ ] **D.** Arrêter puis redémarrer `encore`

### Question 17

Quels fichiers sont créés après un premier build avec une seule entrée `app` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `public/build/app.js`
- [ ] **B.** `public/build/app.css`
- [ ] **C.** `public/build/runtime.js`
- [ ] **D.** `public/build/manifest.php`

### Question 18

À quoi servent les fonctions Twig `encore_entry_link_tags()` et `encore_entry_script_tags()` ? *(une seule bonne réponse)*

- [ ] **A.** Elles remplacent le fichier `webpack.config.js`
- [ ] **B.** Elles lisent le fichier `entrypoints.json` pour rendre les balises `<link>`/`<script>` avec les noms de fichiers exacts générés par Encore
- [ ] **C.** Elles compilent directement le Sass à la volée dans le navigateur
- [ ] **D.** Elles ne fonctionnent qu'en environnement de production

### Question 19

Pourquoi le fichier `entrypoints.json` est-il particulièrement utile ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il permet d'activer le versionnement des assets sans modifier les templates
- [ ] **B.** Il permet de pointer les assets vers un CDN sans modifier les templates
- [ ] **C.** Il rend automatiques les balises supplémentaires nécessaires avec `splitEntryChunks()`
- [ ] **D.** Il remplace entièrement le fichier `webpack.config.js`

### Question 20

Si l'on n'utilise pas Symfony, comment exploiter les fichiers finaux générés par Encore ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser uniquement `manifest.json`, `entrypoints.json` étant réservé à Symfony
- [ ] **B.** Pointer directement vers les fichiers construits, ou écrire du code pour analyser manuellement `entrypoints.json`
- [ ] **C.** Ce n'est pas possible sans Symfony
- [ ] **D.** Il faut obligatoirement installer WebpackEncoreBundle malgré tout

### Question 21

À quoi sert l'attribut `defer` sur les balises `<script>` générées, et comment est-il activé par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il doit être ajouté manuellement à chaque balise `<script>`
- [ ] **B.** Il retarde l'exécution du JavaScript jusqu'au chargement de la page ; il est activé automatiquement par la recette de WebpackEncoreBundle
- [ ] **C.** Il bloque le rendu de la page tant que le script n'est pas exécuté
- [ ] **D.** Il n'a aucun effet avec Webpack Encore

### Question 22

Depuis Encore 7.0, quelle contrainte s'applique aux imports relatifs comme `import greet from './greet.js'` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune contrainte nouvelle, l'extension reste optionnelle comme avant
- [ ] **B.** Il faut désormais utiliser `require()` à la place de `import`
- [ ] **C.** L'extension de fichier est désormais obligatoire, à cause de `resolve.fullySpecified` activé par défaut (le projet utilisant `"type": "module"`)
- [ ] **D.** Les imports relatifs sont interdits, seuls les imports depuis `node_modules` fonctionnent

### Question 23

Que dit la documentation à propos de `addStyleEntry()` ? *(une seule bonne réponse)*

- [ ] **A.** C'est la méthode recommandée pour toute compilation CSS
- [ ] **B.** Elle a été supprimée depuis Encore 7.0
- [ ] **C.** Elle ne fonctionne qu'en combinaison avec `enableSassLoader()`
- [ ] **D.** C'est supporté mais non recommandé ; il vaut mieux utiliser `addEntry()` vers un fichier JS qui importe le CSS nécessaire

### Question 24

Que se passe-t-il en redémarrant Encore juste après avoir appelé `enableSassLoader()` sans avoir installé les dépendances nécessaires ? *(une seule bonne réponse)*

- [ ] **A.** Le build échoue sans aucun message
- [ ] **B.** Une erreur explicite apparaît, indiquant d'installer `sass-loader` et `sass`
- [ ] **C.** Encore installe automatiquement les dépendances manquantes
- [ ] **D.** Une erreur silencieuse ; les fichiers Sass sont simplement ignorés

### Question 25

Que recommande la documentation pour écrire l'application JavaScript plutôt que de tout mettre dans `app.js` ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser Angular
- [ ] **B.** N'utiliser aucun framework, uniquement du JavaScript natif
- [ ] **C.** Utiliser Stimulus, un petit framework JavaScript facilitant l'ajout de comportement au HTML
- [ ] **D.** Utiliser exclusivement jQuery

### Question 26

D'après l'exemple Stimulus donné, que génère `stimulus_controller('say-hello')` dans un template Twig ? *(une seule bonne réponse)*

- [ ] **A.** Rien tant que le contrôleur n'est pas explicitement appelé en JavaScript
- [ ] **B.** Une balise `<div>` complète avec son contenu HTML
- [ ] **C.** Un attribut `data-controller="say-hello"`, qui déclenche l'initialisation automatique du contrôleur `say-hello-controller.js`
- [ ] **D.** Un `<script>` inline contenant tout le JavaScript du contrôleur

## Stimulus, Turbo et JavaScript spécifique par page

### Question 27

Que crée la recette Flex de `symfony/stimulus-bundle` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement un fichier de configuration YAML, sans aucun fichier JavaScript
- [ ] **B.** `webpack.config.js` à la place de celui généré par Encore
- [ ] **C.** Un contrôleur Symfony PHP nommé `StimulusController`
- [ ] **D.** `assets/bootstrap.js` (initialise Stimulus), `assets/controllers/` (répertoire des contrôleurs), `assets/controllers.json` (aide au chargement des contrôleurs des packages UX)

### Question 28

Comment la documentation décrit-elle l'intégration de Turbo avec Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Turbo nécessite de réécrire entièrement les contrôleurs Symfony en JavaScript
- [ ] **B.** Turbo remplace Stimulus, les deux étant incompatibles
- [ ] **C.** Turbo n'est utilisable qu'avec Vue.js
- [ ] **D.** Turbo transforme automatiquement les clics de lien et les soumissions de formulaire en appels Ajax, avec zéro (ou quasiment zéro) changement de code Symfony

### Question 29

À quoi sert le commentaire `/* stimulusFetch: 'lazy' */` au-dessus d'une classe de contrôleur Stimulus ? *(une seule bonne réponse)*

- [ ] **A.** À activer le Hot Module Replacement pour ce contrôleur
- [ ] **B.** À faire découper ce contrôleur (et ses imports) dans un fichier séparé par Encore, téléchargé seulement quand un élément correspondant apparaît sur la page
- [ ] **C.** À désactiver totalement le contrôleur
- [ ] **D.** À forcer le préchargement du contrôleur avant même le chargement de la page

### Question 30

Quelle précaution faut-il prendre si l'on écrit ses contrôleurs Stimulus « lazy » en TypeScript ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter manuellement le commentaire dans le fichier `.js` compilé
- [ ] **B.** Désactiver `enableTypeScriptLoader()`
- [ ] **C.** Utiliser obligatoirement Babel plutôt que `ts-loader`
- [ ] **D.** S'assurer que `removeComments` n'est pas positionné à `true` dans la configuration TypeScript

### Question 31

Pour créer du JavaScript/CSS spécifique à certaines pages (ex. checkout, account), que faut-il faire ? *(plusieurs bonnes réponses)*

- [ ] **A.** Créer un nouveau fichier JavaScript « entry » par page (ex. `assets/checkout.js`)
- [ ] **B.** Appeler `addEntry()` pour chaque nouveau fichier dans `webpack.config.js`
- [ ] **C.** Redémarrer Encore après avoir modifié `webpack.config.js`
- [ ] **D.** Utiliser obligatoirement `addStyleEntry()` plutôt que `addEntry()`

### Question 32

Dans un template qui étend `base.html.twig`, comment inclure les tags spécifiques à l'entry « checkout » en plus de ceux de « app » ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `encore_entry_script_tags('app', 'checkout')` avec deux arguments
- [ ] **B.** Surcharger les blocks `stylesheets`/`javascripts` avec `{{ parent() }}` suivi de `encore_entry_link_tags('checkout')` / `encore_entry_script_tags('checkout')`
- [ ] **C.** Dupliquer entièrement le contenu du `<head>` de `base.html.twig`
- [ ] **D.** Ce n'est pas possible, un template ne peut inclure qu'une seule entry

### Question 33

Pour utiliser jQuery et un module local dans `app.js`, quelle syntaxe faut-il utiliser ? *(une seule bonne réponse)*

- [ ] **A.** `require('jquery')` uniquement, `import` n'étant pas supporté par Encore
- [ ] **B.** `<script src="jquery.js">` directement dans le template
- [ ] **C.** `Encore.enableJquery()` dans `webpack.config.js`
- [ ] **D.** `import $ from 'jquery';` puis `import greet from './greet.js';`

### Question 34

D'où vient le message d'erreur « Install sass-loader & sass to use enableSassLoader() » ? *(une seule bonne réponse)*

- [ ] **A.** De l'absence du fichier `tsconfig.json`
- [ ] **B.** Encore détecte que la fonctionnalité est activée mais que les dépendances npm nécessaires ne sont pas installées, et indique la commande à lancer
- [ ] **C.** D'une mauvaise configuration de `composer.json`
- [ ] **D.** D'un conflit de version entre Node.js et PHP

### Question 35

Où trouver la référence complète des fonctionnalités d'Encore, selon la section « Keep Going! » ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement la documentation Webpack officielle, Encore n'ayant pas sa propre référence
- [ ] **B.** La commande `encore --help`, seule source de vérité
- [ ] **C.** Le fichier `composer.json` du projet
- [ ] **D.** Le fichier `index.js` du dépôt GitHub `symfony/webpack-encore`

### Question 36

Que peut faire Encore, au-delà de la simple compilation de base, selon l'introduction de la page ? *(plusieurs bonnes réponses)*

- [ ] **A.** Minifier les fichiers
- [ ] **B.** Pré-traiter Sass/LESS
- [ ] **C.** Supporter React, Vue.js, etc.
- [ ] **D.** Générer automatiquement des migrations Doctrine

### Question 37

Où doit-on inclure les balises générées par Encore, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Dans un fichier PHP séparé exécuté avant le contrôleur
- [ ] **B.** Dans le fichier `robots.txt`
- [ ] **C.** Directement dans le fichier `webpack.config.js`
- [ ] **D.** Dans `templates/base.html.twig`, à l'intérieur des blocks `stylesheets` et `javascripts` du `<head>`

### Question 38

Que se passe-t-il, en pratique, quand on ajoute `.addEntry('checkout', './assets/checkout.js')` et que ce fichier importe du CSS ? *(une seule bonne réponse)*

- [ ] **A.** Le CSS est fusionné automatiquement dans `app.css`
- [ ] **B.** Webpack produit également un fichier `checkout.css` en plus de `checkout.js`
- [ ] **C.** Le CSS est ignoré, `addEntry()` ne traitant que le JavaScript
- [ ] **D.** Il faut appeler séparément `addStyleEntry('checkout', ...)` pour obtenir le CSS

## Préprocesseurs CSS (Sass, LESS, Stylus)

### Question 39

Quelles méthodes activent respectivement Sass/SCSS, LESS et Stylus ? *(plusieurs bonnes réponses)*

- [ ] **A.** `enableSassLoader()` traite les fichiers `.scss` ou `.sass`
- [ ] **B.** `enableLessLoader()` traite les fichiers `.less`
- [ ] **C.** `enableStylusLoader()` traite les fichiers `.styl`
- [ ] **D.** `enableCssPreprocessor()` active les trois en une seule méthode

### Question 40

Que se passe-t-il quand on active un préprocesseur CSS sans avoir installé les dépendances correspondantes ? *(une seule bonne réponse)*

- [ ] **A.** Une exception PHP est levée côté Symfony
- [ ] **B.** Après redémarrage, Encore indique la commande à exécuter pour installer les dépendances manquantes
- [ ] **C.** Le build échoue silencieusement
- [ ] **D.** Encore installe automatiquement les paquets nécessaires

### Question 41

Depuis quelle version d'Encore `sass-loader` utilise-t-il la Modern Sass API par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Cela a toujours été le comportement par défaut
- [ ] **B.** Encore 5.0
- [ ] **C.** Encore 6.0
- [ ] **D.** Encore 7.0

### Question 42

Avec la Modern Sass API, quelle option remplace l'ancienne option `includePaths` ? *(une seule bonne réponse)*

- [ ] **A.** `importPaths`
- [ ] **B.** `loadPaths`
- [ ] **C.** `resolvePaths`
- [ ] **D.** `sassPaths`

### Question 43

Comment revenir à l'ancienne (legacy) API Sass si nécessaire ? *(une seule bonne réponse)*

- [ ] **A.** En définissant une variable d'environnement `SASS_LEGACY=1`
- [ ] **B.** En passant `options.api = 'legacy'` dans le callback de `enableSassLoader()`
- [ ] **C.** Ce n'est plus possible depuis Encore 6.0
- [ ] **D.** En installant une version antérieure de `node-sass`

## PostCSS et l'autoprefixing

### Question 44

Que fait PostCSS d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Un outil de minification JavaScript
- [ ] **B.** Un linter PHP intégré à Encore
- [ ] **C.** Un outil de post-traitement CSS permettant l'autoprefixing, le linting, et bien plus
- [ ] **D.** Un préprocesseur remplaçant Sass et LESS

### Question 45

Comment active-t-on `postcss-loader` dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `.addPostCssPlugin()`
- [ ] **B.** `.enablePostCssLoader()`
- [ ] **C.** `.enableAutoprefixer()`
- [ ] **D.** `.configurePostCss()`

### Question 46

Depuis Encore 7.0, dans quel format faut-il écrire `postcss.config.js`, sauf à le renommer en `.cjs` ? *(une seule bonne réponse)*

- [ ] **A.** En JSON strict, sans JavaScript
- [ ] **B.** En YAML
- [ ] **C.** Syntaxe ESM (`import` / `export default`), car le projet utilise `"type": "module"`
- [ ] **D.** Toujours en CommonJS, quel que soit le projet

### Question 47

Une fois `postcss-loader` activé, à quels types de fichiers s'applique-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement aux fichiers `.css`, jamais au Sass
- [ ] **B.** Uniquement en environnement de production
- [ ] **C.** Uniquement aux fichiers importés depuis `node_modules`
- [ ] **D.** Tout le CSS, y compris le Sass, etc.

### Question 48

Comment personnaliser le chemin du fichier de configuration PostCSS via `enablePostCssLoader()` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, le fichier doit toujours être à la racine
- [ ] **B.** En modifiant directement le fichier `node_modules/postcss-loader/index.js`
- [ ] **C.** Via une variable d'environnement `POSTCSS_CONFIG_PATH`
- [ ] **D.** En passant un callback qui définit `options.postcssOptions.config` avec le chemin résolu

### Question 49

Que recommande la documentation de configurer dans `package.json` pour qu'autoprefixer sache quels navigateurs cibler ? *(une seule bonne réponse)*

- [ ] **A.** Une entrée `targets`
- [ ] **B.** Une entrée `compatibility`
- [ ] **C.** Une entrée `postcss.targets`
- [ ] **D.** Une entrée `browserslist`

### Question 50

À quoi correspond l'option `browserslist` `"defaults"` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `> 0.5%`
- [ ] **B.** `last 2 versions`
- [ ] **C.** `Firefox ESR`
- [ ] **D.** `not dead`

## Enabling React.js

### Question 51

Quelles dépendances npm faut-il installer pour utiliser React avec Encore ? *(une seule bonne réponse)*

- [ ] **A.** `react` et `webpack-react-loader` uniquement
- [ ] **B.** `react-scripts`
- [ ] **C.** Aucune, React est fourni nativement par Encore
- [ ] **D.** `react`, `react-dom` et `prop-types`

### Question 52

Comment active-t-on React dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `.addReactLoader()`
- [ ] **B.** `.configureReact()`
- [ ] **C.** `.enableReactPreset()`
- [ ] **D.** `.enableReact()`

### Question 53

Une fois React activé, à travers quel outil les fichiers `.js` et `.jsx` sont-ils transformés ? *(une seule bonne réponse)*

- [ ] **A.** `ts-loader`
- [ ] **B.** Le loader Sass
- [ ] **C.** PostCSS
- [ ] **D.** `babel-preset-react`, via `babel-loader`

### Question 54

Que se passe-t-il si l'on redémarre Encore juste après avoir appelé `enableReactPreset()` sans avoir installé les dépendances requises ? *(une seule bonne réponse)*

- [ ] **A.** Une erreur PHP est levée côté Symfony
- [ ] **B.** Encore affiche une commande à exécuter pour installer les dépendances manquantes
- [ ] **C.** Le serveur de développement plante définitivement
- [ ] **D.** Rien, React fonctionne sans dépendance supplémentaire

## Enabling Vue.js (vue-loader)

### Question 55

Comment active-t-on `vue-loader` dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `.configureVueLoader()`
- [ ] **B.** `.enableVueLoader()`
- [ ] **C.** `.enableVue()`
- [ ] **D.** `.addVueLoader()`

### Question 56

Par défaut, quel type de build Vue Encore utilise-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Un build minimal sans aucun compilateur
- [ ] **B.** Le choix dépend uniquement de la version de Vue installée, Encore n'a pas d'influence
- [ ] **C.** Un build « runtime + compiler », qui permet de compiler des templates à l'exécution (ex. `template: '<div>{{ hi }}</div>'`)
- [ ] **D.** Un build « runtime only », qui interdit toute compilation de template à l'exécution

### Question 57

Comment obtenir un build Vue plus petit, respectant une Content Security Policy stricte, quand on utilise des composants monofichiers ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable
- [ ] **B.** `.enableVueLoader(() => {}, { runtimeCompilerBuild: false })`
- [ ] **C.** `.enableVueLoader({ csp: true })`
- [ ] **D.** `.disableVueRuntimeCompiler()`

### Question 58

Le Hot Module Replacement de `vue-loader` fonctionne-t-il pour les changements de style dans un fichier `.vue` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, entièrement, y compris les styles
- [ ] **B.** Cela dépend uniquement de la version de `webpack-dev-server`
- [ ] **C.** HMR n'existe pas du tout pour `vue-loader`
- [ ] **D.** Non, un rafraîchissement de la page reste nécessaire pour voir les styles mis à jour

### Question 59

Comment active-t-on le support JSX avec Vue.js via `enableVueLoader()` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `.enableReactPreset()` en complément
- [ ] **B.** En passant `{ useJsx: true }` comme second paramètre
- [ ] **C.** En installant uniquement `@vitejs/plugin-vue-jsx`, sans configuration Encore
- [ ] **D.** JSX n'est pas supporté avec Vue.js dans Encore

### Question 60

Une fois `useJsx: true` activé, à travers quel outil les fichiers `.jsx` sont-ils transformés ? *(une seule bonne réponse)*

- [ ] **A.** `ts-loader`
- [ ] **B.** `@vue/babel-plugin-jsx`
- [ ] **C.** `babel-preset-react`
- [ ] **D.** `vue-jsx-loader`

### Question 61

Peut-on utiliser une balise `<style>` directement dans un fichier `.jsx` avec Vue ? *(une seule bonne réponse)*

- [ ] **A.** Oui, exactement comme dans un fichier `.vue` classique
- [ ] **B.** Non, et il n'existe aucun contournement possible
- [ ] **C.** Oui, mais uniquement en production
- [ ] **D.** Non ; il faut importer les fichiers CSS/Sass manuellement, ce qui les rend globaux

### Question 62

Comment scoper des styles à un composant `.jsx`, puisque `<style scoped>` n'y est pas utilisable ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant `enableSassLoader()` avec l'option `scoped: true`
- [ ] **B.** En utilisant les CSS Modules, en suffixant le chemin d'import par `?module`
- [ ] **C.** En renommant le fichier `.vue` plutôt que `.jsx`
- [ ] **D.** Ce n'est pas possible, les styles JSX sont toujours globaux

### Question 63

Depuis Encore 7.0, comment importer une image dans un composant `.jsx`, le `require()` CommonJS n'étant plus disponible ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est plus possible du tout depuis la 7.0
- [ ] **B.** Via un import ES au niveau supérieur du fichier (`import imageUrl from './image.png'`)
- [ ] **C.** Toujours via `require()`, qui reste disponible pour les images uniquement
- [ ] **D.** En passant par une balise `<img>` avec un chemin absolu codé en dur

### Question 64

Pourquoi faut-il configurer l'option `delimiters` de Vue.js quand on l'utilise dans des templates Twig ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Twig ne supporte pas les accolades doubles
- [ ] **B.** Parce que Twig et Vue.js utilisent par défaut les mêmes délimiteurs de variables (`{{ }}`), il faut donc changer ceux de Vue pour éviter les conflits
- [ ] **C.** Parce que Vue.js n'accepte aucun caractère spécial par défaut
- [ ] **D.** Ce n'est nécessaire que si l'on utilise TypeScript

### Question 65

Comment silencer la recommandation d'Encore concernant le runtime compiler build, sans changer réellement de build ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le message reste toujours affiché
- [ ] **B.** En passant `silenceWarnings: true`
- [ ] **C.** En passant `runtimeCompilerBuild: true` explicitement
- [ ] **D.** En désinstallant `vue-loader` puis en le réinstallant

### Question 66

Que permet de configurer le premier paramètre (callback) de `enableVueLoader()` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les options Sass utilisées à l'intérieur des fichiers `.vue`
- [ ] **B.** Rien, ce paramètre est réservé à un usage interne d'Encore
- [ ] **C.** Les options du `vue-loader` lui-même (voir la documentation de `vue-loader`)
- [ ] **D.** Uniquement les options JSX

## Copier et référencer des fichiers/images

### Question 67

Que se passe-t-il quand on importe (`require`/`import`) un fichier image depuis un fichier JavaScript traité par Webpack ? *(une seule bonne réponse)*

- [ ] **A.** Rien, il faut obligatoirement passer par `copyFiles()`
- [ ] **B.** Le fichier est encodé en base64 et injecté directement dans le JS
- [ ] **C.** Une erreur est levée, les images ne pouvant être importées en JS
- [ ] **D.** Webpack copie le fichier dans le répertoire de sortie et retourne le chemin public final de ce fichier

### Question 68

Pour référencer un fichier image depuis un template (hors JavaScript traité par Webpack), quelle méthode faut-il activer ? *(une seule bonne réponse)*

- [ ] **A.** `enableImageLoader()`
- [ ] **B.** `addStyleEntry()`
- [ ] **C.** `configureImageRule()`
- [ ] **D.** `copyFiles()`

### Question 69

Quelles options accepte la méthode `copyFiles()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `from` : le répertoire source à copier
- [ ] **B.** `to` : le chemin cible (relatif au répertoire de sortie), optionnel
- [ ] **C.** `pattern` : pour ne copier que les fichiers correspondant à une expression régulière
- [ ] **D.** `hash` : pour désactiver le hash de contenu, toujours calculé par défaut

### Question 70

Si le versionnement des assets est activé, que contiennent les noms des fichiers copiés via `copyFiles()` ? *(une seule bonne réponse)*

- [ ] **A.** Le numéro de version de l'application uniquement
- [ ] **B.** Un hash basé sur le contenu du fichier
- [ ] **C.** Un simple horodatage Unix
- [ ] **D.** Aucun changement, le versionnement ne concerne que le JS et le CSS

### Question 71

Comment rendre dans Twig une image copiée via `copyFiles()` ? *(une seule bonne réponse)*

- [ ] **A.** Via `copy_files_asset()`
- [ ] **B.** Via la fonction `asset()`, ex. `asset('build/images/logo.png')`
- [ ] **C.** Directement via un chemin en dur, sans fonction Twig
- [ ] **D.** Via `encore_entry_link_tags()`

### Question 72

Si l'on ne sait pas quel chemin passer à la fonction `asset()`, que recommande la documentation de faire ? *(une seule bonne réponse)*

- [ ] **A.** Ouvrir `entrypoints.json`, qui contient exactement les mêmes informations
- [ ] **B.** Ne pas utiliser `asset()` du tout dans ce cas
- [ ] **C.** Chercher le fichier dans `manifest.json` et utiliser sa clé comme argument
- [ ] **D.** Toujours utiliser le chemin absolu du système de fichiers

## Configuring Babel

### Question 73

Comment Babel est-il configuré par défaut pour les fichiers `.js` et `.jsx` ? *(une seule bonne réponse)*

- [ ] **A.** Babel doit être activé explicitement via `enableBabel()`
- [ ] **B.** Automatiquement via `babel-loader`, avec des valeurs par défaut sensées (ex. `@babel/preset-env`, et `@babel/preset-react` si demandé)
- [ ] **C.** Il faut toujours créer un `.babelrc` manuellement, Encore ne configure jamais Babel seul
- [ ] **D.** Babel n'est utilisé que pour TypeScript

### Question 74

Quelle méthode permet d'étendre la configuration Babel générée par Encore (ajouter des presets/plugins) ? *(une seule bonne réponse)*

- [ ] **A.** `extendBabel()`
- [ ] **B.** `addBabelPreset()`
- [ ] **C.** `enableBabelConfig()`
- [ ] **D.** `configureBabel()`

### Question 75

Concernant `includeNodeModules` et `exclude` dans les options de `configureBabel()`, que dit la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont toujours utilisés ensemble, l'un complétant l'autre
- [ ] **B.** `exclude` est déprécié au profit de `includeNodeModules`
- [ ] **C.** `includeNodeModules` n'existe pas, seul `exclude` est disponible
- [ ] **D.** On ne peut pas utiliser les deux en même temps

### Question 76

Depuis Encore 7.0 (Babel 8), que se passe-t-il si aucune configuration `browserslist` n'est définie ? *(une seule bonne réponse)*

- [ ] **A.** Le build échoue systématiquement, une configuration `browserslist` étant obligatoire
- [ ] **B.** Comportement inchangé par rapport à Babel 7 : compilation vers ES5 par défaut
- [ ] **C.** Babel ignore simplement `preset-env` et ne transpile rien
- [ ] **D.** `@babel/preset-env` cible par défaut les navigateurs modernes, au lieu de compiler vers ES5 comme avant la 7.0

### Question 77

Que faut-il faire manuellement après avoir changé la configuration `browserslist` du projet ? *(une seule bonne réponse)*

- [ ] **A.** Réinstaller entièrement `node_modules`
- [ ] **B.** Rien, le cache est invalidé automatiquement
- [ ] **C.** Supprimer le répertoire de cache `node_modules/.cache/babel-loader/`
- [ ] **D.** Redémarrer uniquement le serveur PHP

### Question 78

Que sont devenues les options `useBuiltIns` et `corejs` de `@babel/preset-env` depuis Webpack Encore 7.0 ? *(une seule bonne réponse)*

- [ ] **A.** Elles ne concernent que TypeScript, pas JavaScript
- [ ] **B.** Elles ne sont plus supportées (Babel 8 les a retirées de `preset-env`) ; Encore lève une erreur explicite si on les définit
- [ ] **C.** Elles sont devenues activées par défaut, sans configuration nécessaire
- [ ] **D.** Elles ont simplement été renommées `useBuiltinsV2` et `corejsVersion`

### Question 79

Comment ajouter des polyfills avec Babel 8, à la place de `useBuiltIns`/`corejs` ? *(une seule bonne réponse)*

- [ ] **A.** En installant `core-js` directement dans `app.js` sans configuration Babel
- [ ] **B.** Via l'option `polyfills: true` de `configureBabel()`
- [ ] **C.** Via `babel-plugin-polyfill-corejs3`, ex. `babelConfig.plugins.push(['polyfill-corejs3', { method: 'usage-global' }])`
- [ ] **D.** Ce n'est plus possible du tout d'ajouter des polyfills

### Question 80

Que se passe-t-il dès qu'un fichier `.babelrc` est présent à la racine du projet ? *(une seule bonne réponse)*

- [ ] **A.** Encore fusionne intelligemment sa propre config avec `.babelrc`, sans perte de fonctionnalité
- [ ] **B.** Cela provoque systématiquement une erreur au démarrage d'Encore
- [ ] **C.** Encore ne peut plus ajouter aucune configuration Babel automatiquement (ex. le preset `react` ne sera pas ajouté même avec `enableReactPreset()`)
- [ ] **D.** Le fichier `.babelrc` est simplement ignoré par Encore

### Question 81

Quelle méthode permet de personnaliser spécifiquement les options de `@babel/preset-env` ? *(une seule bonne réponse)*

- [ ] **A.** `enableBabelPresetEnv()`
- [ ] **B.** `configureBabelPresetEnv()`
- [ ] **C.** `configureBabel()`
- [ ] **D.** `configurePresetEnv()`

## Source maps

### Question 82

À quoi servent les source maps, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** À générer automatiquement la documentation du code
- [ ] **B.** À permettre aux navigateurs d'accéder au code original (ex. Sass ou TypeScript) pour le débogage
- [ ] **C.** À minifier le code plus efficacement
- [ ] **D.** À accélérer le chargement des assets en production

### Question 83

Comment le fichier de configuration par défaut d'Encore active-t-il les source maps ? *(une seule bonne réponse)*

- [ ] **A.** `.enableSourceMaps(true)` — toujours activées, y compris en production
- [ ] **B.** Les source maps sont activées automatiquement, sans méthode dédiée
- [ ] **C.** `.enableSourceMaps()` n'accepte aucun argument
- [ ] **D.** `.enableSourceMaps(!Encore.isProduction())` — activées uniquement en dev

## Enabling TypeScript (ts-loader)

### Question 84

Comment active-t-on le support TypeScript dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `.enableTsLoader()`
- [ ] **B.** `.addTypeScript()`
- [ ] **C.** `.configureTypeScript()`
- [ ] **D.** `.enableTypeScriptLoader()`

### Question 85

Que faut-il créer, au minimum, pour que TypeScript fonctionne (même sans options particulières) ? *(une seule bonne réponse)*

- [ ] **A.** Un fichier `.babelrc` dédié à TypeScript
- [ ] **B.** Rien, aucun fichier de configuration n'est nécessaire
- [ ] **C.** Un fichier `ts.config.js` (et non `.json`)
- [ ] **D.** Un fichier `tsconfig.json` vide, avec le contenu `{}`

### Question 86

À quoi sert `enableForkedTypeScriptTypesChecking()` ? *(une seule bonne réponse)*

- [ ] **A.** À activer TypeScript en plus de Babel simultanément sur les mêmes fichiers
- [ ] **B.** À transformer les fichiers `.ts` en `.js` sans passer par `ts-loader`
- [ ] **C.** À accélérer les builds en vérifiant les types dans un processus séparé (`fork-ts-checker-webpack-plugin`), nécessite un `tsconfig.json` correctement configuré
- [ ] **D.** À désactiver totalement la vérification de types

### Question 87

Comment personnaliser les options de `ts-loader` via `enableTypeScriptLoader()` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant une méthode séparée `configureTsLoader()`
- [ ] **B.** En passant une fonction callback recevant la configuration `ts-loader` (ex. `tsConfig.silent = false`)
- [ ] **C.** Ce n'est pas configurable directement, il faut modifier `ts-loader` dans `node_modules`
- [ ] **D.** Via une propriété `tsLoaderOptions` du fichier `tsconfig.json`

### Question 88

Si React est activé (`enableReactPreset()`) en plus de TypeScript, quels fichiers sont également traités par `ts-loader` ? *(une seule bonne réponse)*

- [ ] **A.** Aucun fichier supplémentaire, React et TypeScript restent indépendants
- [ ] **B.** Tous les fichiers `.js` du projet, sans distinction
- [ ] **C.** Les fichiers `.tsx`
- [ ] **D.** Uniquement les fichiers `.jsx`, jamais `.tsx`

## Asset Versioning

### Question 89

Que fait `enableVersioning()` ? *(une seule bonne réponse)*

- [ ] **A.** Il désactive complètement le cache des assets, quel que soit le navigateur
- [ ] **B.** Il ne fonctionne qu'en environnement de développement
- [ ] **C.** Chaque nom de fichier inclut désormais un hash qui change quand le contenu du fichier change (ex. `app.123abc.js`), permettant une mise en cache agressive
- [ ] **D.** Il force l'invalidation systématique du cache navigateur à chaque déploiement, sans hash

### Question 90

Quels fichiers Encore génère-t-il pour permettre de lier vers les assets versionnés ? *(plusieurs bonnes réponses)*

- [ ] **A.** `entrypoints.json`
- [ ] **B.** `manifest.json`
- [ ] **C.** `versions.lock`
- [ ] **D.** `assets.map`

### Question 91

À quoi sert principalement `entrypoints.json` ? *(une seule bonne réponse)*

- [ ] **A.** Il sert uniquement au débogage, sans usage en production
- [ ] **B.** Il remplace `webpack.config.js` après le premier build
- [ ] **C.** Il ne contient que les chemins des fichiers image
- [ ] **D.** Il est utilisé par les fonctions Twig `encore_entry_script_tags()`/`encore_entry_link_tags()`

### Question 92

Pourquoi `manifest.json` reste-t-il utile même en utilisant les fonctions Twig d'Encore ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est jamais nécessaire quand Symfony est utilisé
- [ ] **B.** Il remplace intégralement `entrypoints.json`
- [ ] **C.** Il ne concerne que les fichiers JavaScript
- [ ] **D.** Il permet d'obtenir le nom de fichier versionné d'autres fichiers, comme des polices ou des images

### Question 93

Quelle option de configuration Symfony faut-il activer pour lire `manifest.json` (stratégie `json_manifest_file`) ? *(une seule bonne réponse)*

- [ ] **A.** `webpack_encore.manifest_path`
- [ ] **B.** `framework.assets.json_manifest_path`
- [ ] **C.** `framework.assets.manifest_strategy`
- [ ] **D.** `framework.assets.versioning`

### Question 94

Comment doit-on référencer un asset versionné dans un template Twig ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable globale `${MANIFEST}`
- [ ] **B.** Ce n'est pas nécessaire, les templates sont réécrits automatiquement au build
- [ ] **C.** En l'enveloppant dans la fonction `asset()`, ex. `asset('build/images/logo.png')`
- [ ] **D.** En codant en dur le nom de fichier haché

### Question 95

D'après la section troubleshooting, le versionnement pose-t-il un problème avec les stratégies de déploiement rolling update, blue/green ou symlink ? *(une seule bonne réponse)*

- [ ] **A.** Oui, systématiquement, ces stratégies sont incompatibles avec le versionnement
- [ ] **B.** Non, ces stratégies désactivent automatiquement le cache
- [ ] **C.** Le versionnement est incompatible avec tout déploiement autre que manuel
- [ ] **D.** Généralement non, sauf lapse de temps où une réponse mise en cache pourrait référencer d'anciens assets déjà supprimés

### Question 96

Quelle solution la documentation recommande-t-elle si l'application ne peut se permettre de servir un asset cassé pendant un déploiement ? *(une seule bonne réponse)*

- [ ] **A.** Multiplier le nombre de releases conservées sur le serveur, sans autre changement
- [ ] **B.** Utiliser un CDN (ou un service équivalent) qui garde les anciens assets en cache pendant un certain temps
- [ ] **C.** Désactiver totalement le versionnement des assets
- [ ] **D.** Forcer un rechargement complet du navigateur de chaque utilisateur au déploiement

## Minifying JavaScript and CSS

### Question 97

Depuis Encore 7.0, quel plugin unifié gère la minification JavaScript et CSS ? *(une seule bonne réponse)*

- [ ] **A.** `css-minimizer-webpack-plugin`
- [ ] **B.** `uglify-webpack-plugin`
- [ ] **C.** `minimizer-webpack-plugin`
- [ ] **D.** `terser-webpack-plugin`

### Question 98

Avant Encore 7.0, quels plugins géraient respectivement la minification JS et CSS (tous deux désormais archivés) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `terser-webpack-plugin` pour le JavaScript, configuré via `configureTerserPlugin()`
- [ ] **B.** `css-minimizer-webpack-plugin` pour le CSS
- [ ] **C.** `minimizer-webpack-plugin` pour les deux, déjà utilisé avant la 7.0
- [ ] **D.** `babel-minify-webpack-plugin` pour le CSS

### Question 99

Que devient `configureTerserPlugin()` depuis Encore 7.0 ? *(une seule bonne réponse)*

- [ ] **A.** Elle a été renommée `configureTerserPluginV2()`
- [ ] **B.** Elle ne concerne plus que la CSS
- [ ] **C.** Elle a été supprimée ; il faut utiliser `configureJsMinimizerPlugin()` à la place, qui prend le même callback
- [ ] **D.** Elle reste identique, sans changement

### Question 100

Depuis Encore 7.0, la CSS est-elle minifiée par défaut en production ? *(une seule bonne réponse)*

- [ ] **A.** Oui, comme avant, sans aucune configuration nécessaire
- [ ] **B.** Oui, mais uniquement si Sass est activé
- [ ] **C.** Non, la minification CSS a été totalement retirée d'Encore
- [ ] **D.** Non, il faut choisir et configurer explicitement un minifieur CSS via `configureCssMinimizerPlugin()`

### Question 101

Le JavaScript est-il minifié « out of the box » en production, sans package supplémentaire à installer ? *(une seule bonne réponse)*

- [ ] **A.** Non, seule la CSS est minifiée par défaut
- [ ] **B.** Oui, mais uniquement si `enableVersioning()` est actif
- [ ] **C.** Oui, via Terser, qui est fourni intégré (« bundled ») dans `minimizer-webpack-plugin`
- [ ] **D.** Non, il faut toujours installer un package supplémentaire pour le JS

### Question 102

Quels minifieurs JavaScript sont disponibles via `configureJsMinimizerPlugin()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `terserMinify` (par défaut)
- [ ] **B.** `uglifyJsMinify`
- [ ] **C.** `swcMinify`
- [ ] **D.** `cssnanoMinify`

### Question 103

Quels minifieurs CSS sont proposés en plus de `lightningcss` et `cssnano` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `csso`
- [ ] **B.** `clean-css`
- [ ] **C.** `esbuild` (`esbuildMinifyCss`)
- [ ] **D.** `terser` (`terserMinifyCss`)

### Question 104

Comment le second argument (`MinimizerPlugin`) est-il fourni au callback de `configureJsMinimizerPlugin()` / `configureCssMinimizerPlugin()` ? *(une seule bonne réponse)*

- [ ] **A.** Il faut appeler `Encore.getMinimizerPlugin()` séparément
- [ ] **B.** Automatiquement, sans avoir besoin d'importer `minimizer-webpack-plugin` soi-même (ce qui ne résoudrait pas sous pnpm)
- [ ] **C.** Il faut l'importer manuellement dans `webpack.config.js`
- [ ] **D.** Il n'est jamais nécessaire, seul le premier argument `options` est utilisé

### Question 105

Si l'on met à niveau depuis Encore 6.0 et que l'on souhaite garder le comportement précédent (CSS minifiée avec `cssnano`), que faut-il faire ? *(une seule bonne réponse)*

- [ ] **A.** Rien, `cssnano` reste le comportement par défaut en 7.0
- [ ] **B.** Installer uniquement `lightningcss`, qui remplace `cssnano` de façon transparente
- [ ] **C.** Configurer `configureTerserPlugin()` avec l'option `cssnano: true`
- [ ] **D.** Installer `cssnano` et `postcss`, puis configurer `cssnanoMinify` via `configureCssMinimizerPlugin()`

## Using a CDN

### Question 106

Comment indiquer à Encore d'utiliser un CDN en production ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable dans Encore, il faut le faire côté serveur web
- [ ] **B.** Utiliser exclusivement `enableVersioning()` pour activer le support CDN
- [ ] **C.** Appeler `Encore.setPublicPath()` avec l'URL complète du CDN, généralement dans un bloc `if (Encore.isProduction())`
- [ ] **D.** Ajouter une variable d'environnement `CDN_URL`, sans autre configuration

### Question 107

À quoi sert `setManifestKeyPrefix('build/')` quand on utilise un CDN ? *(une seule bonne réponse)*

- [ ] **A.** À forcer Webpack à ignorer le CDN en développement
- [ ] **B.** À garantir que les clés du `manifest.json` restent préfixées par `build/`, même si la valeur pointe vers l'URL complète du CDN
- [ ] **C.** À définir le sous-répertoire local où seront copiés les fichiers avant upload
- [ ] **D.** À activer automatiquement le versionnement des assets

### Question 108

Qui a la responsabilité de réellement déposer les fichiers construits sur le CDN ? *(une seule bonne réponse)*

- [ ] **A.** Encore le fait automatiquement dès que `setPublicPath()` pointe vers un CDN
- [ ] **B.** WebpackEncoreBundle s'en charge via une commande dédiée
- [ ] **C.** Cela se fait automatiquement au moment du `composer install`
- [ ] **D.** Toujours l'utilisateur/l'équipe, via upload ou origin pull ; Encore ne le fait pas automatiquement

### Question 109

Comment adapter `setPublicPath()` si le CDN pointe vers un sous-répertoire (ex. `/awesome-website`) ? *(une seule bonne réponse)*

- [ ] **A.** Configurer un second `webpack.config.js` dédié
- [ ] **B.** Ajouter ce chemin à la fin de l'URL du CDN passée à `setPublicPath()`
- [ ] **C.** Ce n'est pas supporté, un CDN ne peut pointer que vers la racine
- [ ] **D.** Utiliser `setManifestKeyPrefix()` avec le sous-répertoire à la place

### Question 110

Quand faut-il configurer l'option `crossorigin` dans `webpack_encore.yaml` en lien avec le CDN ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en développement, jamais en production
- [ ] **B.** Uniquement si Sass est activé
- [ ] **C.** Si `enableIntegrityHashes()` est utilisé et que le CDN n'est pas de même origine que le domaine principal, pour éviter des erreurs CORS
- [ ] **D.** Systématiquement, dès qu'un CDN est utilisé, sans condition

## Async Code Splitting

### Question 111

Comment charger un module de façon asynchrone (uniquement quand nécessaire) avec Encore/Webpack ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans une configuration Babel spécifique
- [ ] **B.** Via `require.ensure()`, la seule méthode supportée
- [ ] **C.** En utilisant `import()` comme une fonction, qui retourne une Promise
- [ ] **D.** En important normalement en haut du fichier, Webpack décidant seul du moment du chargement

### Question 112

Pourquoi le callback `.then()` d'un `import()` dynamique reçoit-il un objet du type `{ default: VideoPlayer }` plutôt que directement `VideoPlayer` ? *(une seule bonne réponse)*

- [ ] **A.** Cela ne se produit que si le module exporte plusieurs valeurs nommées
- [ ] **B.** C'est spécifique à TypeScript, jamais au JavaScript pur
- [ ] **C.** C'est la convention des imports dynamiques ; le module réel est accessible via la propriété `.default`
- [ ] **D.** C'est une erreur de la documentation, cela ne devrait jamais arriver

### Question 113

Que fait Webpack en interne quand on utilise `import()` de façon dynamique ? *(une seule bonne réponse)*

- [ ] **A.** Il refuse de compiler si `import()` est utilisé comme une fonction
- [ ] **B.** Il transforme automatiquement le module en Web Worker
- [ ] **C.** Il empaquette le module concerné dans un fichier séparé (ex. `0.js`), téléchargé de façon asynchrone
- [ ] **D.** Il inclut systématiquement le module dans le fichier principal, sans fichier séparé

### Question 114

Comment gérer une erreur de chargement lors d'un `import()` dynamique ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, les erreurs sont silencieusement ignorées
- [ ] **B.** En utilisant un bloc `try`/`catch` synchrone autour de l'appel
- [ ] **C.** En passant un second argument callback d'erreur à `import()`
- [ ] **D.** En chaînant un `.catch()` après le `.then()`

## Split Chunks

### Question 115

Pourquoi utiliser `splitEntryChunks()` lorsqu'on a plusieurs entries qui importent toutes `jquery` ? *(une seule bonne réponse)*

- [ ] **A.** Pour empêcher complètement l'utilisation de jQuery dans le projet
- [ ] **B.** Pour éviter que chaque fichier de sortie contienne sa propre copie de jQuery, en extrayant le code partagé dans des fichiers séparés
- [ ] **C.** Pour fusionner toutes les entries en un seul fichier final
- [ ] **D.** Pour désactiver le cache navigateur sur les fichiers partagés

### Question 116

Une fois `splitEntryChunks()` activé, qu'est-ce qui peut changer concernant les balises à inclure dans le template ? *(une seule bonne réponse)*

- [ ] **A.** Seule la balise CSS change, jamais le JavaScript
- [ ] **B.** Il peut être nécessaire d'inclure plusieurs balises `<script>`/`<link>` par entry, listées dans `entrypoints.json`
- [ ] **C.** Rien ne change, une seule balise par entry reste toujours nécessaire
- [ ] **D.** Il faut retirer complètement les balises `<script>`, remplacées par du chargement automatique

### Question 117

Que font automatiquement `encore_entry_link_tags()` et `encore_entry_script_tags()` une fois `splitEntryChunks()` activé ? *(une seule bonne réponse)*

- [ ] **A.** Elles ignorent les fichiers supplémentaires générés par le split
- [ ] **B.** Elles nécessitent un argument booléen supplémentaire pour fonctionner correctement
- [ ] **C.** Elles ne fonctionnent plus, il faut coder les balises à la main
- [ ] **D.** Elles lisent `entrypoints.json` et rendent autant de balises que nécessaire

### Question 118

Quel plugin Webpack sous-jacent contrôle la logique de quand et comment splitter les fichiers ? *(une seule bonne réponse)*

- [ ] **A.** `OptimizeCssAssetsPlugin`
- [ ] **B.** `RuntimeChunkPlugin`
- [ ] **C.** `SplitChunksPlugin`
- [ ] **D.** `CommonsChunkPlugin`

### Question 119

Quelle méthode permet de personnaliser la configuration passée au `SplitChunksPlugin` (ex. changer `minSize`) ? *(une seule bonne réponse)*

- [ ] **A.** `enableSplitChunksOptions()`
- [ ] **B.** `configureSplitChunks()`
- [ ] **C.** `splitEntryChunks(options)`
- [ ] **D.** `configureChunks()`

## The url-loader

### Question 120

À quel besoin répond la technique décrite dans la page url-loader (inliner images et polices) ? *(une seule bonne réponse)*

- [ ] **A.** Compresser les images sans perte de qualité
- [ ] **B.** Convertir automatiquement les polices en WOFF2
- [ ] **C.** Générer des sprites CSS automatiquement
- [ ] **D.** Réduire le nombre de requêtes HTTP en intégrant les petits fichiers en base64 directement dans le CSS généré

### Question 121

Quelles méthodes permettent d'activer l'inlining respectivement pour les images et les polices ? *(une seule bonne réponse)*

- [ ] **A.** `configureUrlLoader()` pour les deux
- [ ] **B.** `configureImageRule()` et `configureFontRule()`
- [ ] **C.** `enableImageInlining()` et `enableFontInlining()`
- [ ] **D.** `addAssetRule()` pour les deux

### Question 122

Quelle est la taille par défaut en dessous de laquelle un fichier est considéré pour l'inlining (`maxSize`), selon le commentaire du fichier d'exemple ? *(une seule bonne réponse)*

- [ ] **A.** 16 ko
- [ ] **B.** 1 Mo
- [ ] **C.** 8 ko
- [ ] **D.** 4 ko

## Using Bootstrap CSS & JS

### Question 123

Comment installer Bootstrap pour l'utiliser avec Webpack Encore ? *(une seule bonne réponse)*

- [ ] **A.** `npm install @symfony/bootstrap --save-dev`
- [ ] **B.** Bootstrap est fourni nativement avec Encore, sans installation
- [ ] **C.** `npm install bootstrap --save-dev`
- [ ] **D.** `composer require twbs/bootstrap`

### Question 124

Comment importer les styles Bootstrap depuis un fichier Sass, en utilisant `node_modules` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans copier manuellement les fichiers Bootstrap dans `assets/`
- [ ] **B.** `@import "~bootstrap/scss/bootstrap";`, le tilde permettant de référencer `node_modules`
- [ ] **C.** `@import "bootstrap.scss";` directement, sans préfixe particulier
- [ ] **D.** `@use "bootstrap" from "node_modules";`

### Question 125

Peut-on importer uniquement certains fichiers de Bootstrap plutôt que l'intégralité du framework ? *(une seule bonne réponse)*

- [ ] **A.** Non, l'import complet de `bootstrap.scss` est obligatoire
- [ ] **B.** Oui, mais uniquement pour le JavaScript, jamais pour le Sass
- [ ] **C.** Non, sauf en recompilant Bootstrap depuis les sources
- [ ] **D.** Oui, ex. `~bootstrap/scss/alert` pour n'inclure que ce composant

### Question 126

Quelles dépendances JavaScript sont nécessaires pour utiliser Bootstrap dans une version antérieure à Bootstrap 5 ? *(une seule bonne réponse)*

- [ ] **A.** `lodash` et `moment`
- [ ] **B.** `jquery` et `@popperjs/core`
- [ ] **C.** `react` et `react-dom`
- [ ] **D.** Aucune dépendance supplémentaire, quelle que soit la version

### Question 127

Que fait l'instruction `import 'bootstrap';` dans un fichier JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** Elle échoue si jQuery n'est pas déjà chargé au niveau global
- [ ] **B.** Elle « modifie » le module `jquery` en lui ajoutant du comportement ; le module `bootstrap` lui-même n'exporte/ne retourne rien
- [ ] **C.** Elle exporte un objet `Bootstrap` contenant toutes les fonctions du framework
- [ ] **D.** Elle charge Bootstrap de façon asynchrone via `import()` dynamique

### Question 128

Si l'on utilise Bootstrap avec Turbo Drive, comment s'assurer que le JavaScript se réinitialise à chaque changement de page ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant `enableSingleRuntimeChunk()` spécifiquement pour Bootstrap
- [ ] **B.** En enveloppant l'initialisation dans un écouteur de l'événement `turbo:load`
- [ ] **C.** En rechargeant complètement la page à chaque navigation, désactivant de fait Turbo
- [ ] **D.** Ce n'est pas nécessaire, Turbo Drive réexécute automatiquement tous les scripts sans configuration

### Question 129

Pourquoi peut-on avoir besoin de `autoProvidejQuery()` pour utiliser certains plugins Bootstrap/jQuery tiers ? *(une seule bonne réponse)*

- [ ] **A.** Pour transpiler automatiquement ces plugins en TypeScript
- [ ] **B.** Pour activer le support CSS Modules sur ces plugins
- [ ] **C.** Pour désactiver Popper.js, rendu inutile par `autoProvidejQuery()`
- [ ] **D.** Pour que ces plugins, qui s'attendent à trouver jQuery en variable globale, puissent la localiser

## jQuery Plugins and Legacy Applications

### Question 130

Pourquoi `import $ from 'jquery'` ne définit-il pas de variable globale `$` ou `jQuery` ? *(une seule bonne réponse)*

- [ ] **A.** Ce comportement n'existe pas, la variable globale est toujours définie automatiquement
- [ ] **B.** Parce que Webpack ne définit (généralement) pas de variable globale quand on importe un module ; il retourne simplement une valeur
- [ ] **C.** Parce que jQuery a changé son API et ne fonctionne plus avec Webpack
- [ ] **D.** Parce qu'il faut toujours passer par un CDN pour jQuery

### Question 131

Quelle méthode réécrit automatiquement le code utilisant des variables `$` ou `jQuery` non définies pour les fournir correctement ? *(une seule bonne réponse)*

- [ ] **A.** `enableLegacyMode()`
- [ ] **B.** `configureJqueryRule()`
- [ ] **C.** `addLoader({ test: /jquery/ })`
- [ ] **D.** `autoProvidejQuery()`

### Question 132

À quoi est équivalent, en interne, l'appel à `autoProvidejQuery()` ? *(une seule bonne réponse)*

- [ ] **A.** Un simple alias vers `enableSassLoader()`
- [ ] **B.** `Encore.autoProvideVariables({ $: 'jquery', jQuery: 'jquery', 'window.jQuery': 'jquery' })`
- [ ] **C.** `Encore.addExternals({ jquery: 'jQuery' })`
- [ ] **D.** `Encore.configureLoaderRule('js', ...)`

### Question 133

Peut-on utiliser `autoProvideVariables()` pour d'autres bibliothèques que jQuery, comme underscore ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement pour les bibliothèques officiellement supportées par Symfony UX
- [ ] **B.** Oui, ex. en fournissant `_: 'underscore'` en plus de jQuery
- [ ] **C.** Non, cette méthode est strictement réservée à jQuery
- [ ] **D.** Non, il faut une méthode dédiée par bibliothèque

### Question 134

Si du JavaScript hors Webpack (ex. inline dans un template) a besoin d'accéder à jQuery, comment l'exposer depuis un fichier traité par Webpack ? *(une seule bonne réponse)*

- [ ] **A.** En passant par `window.jQuery = $`, qui fonctionne dans tous les cas y compris avec `autoProvidejQuery()`
- [ ] **B.** En définissant explicitement `global.$ = global.jQuery = $;` après l'import normal de `jquery`
- [ ] **C.** En appelant uniquement `autoProvidejQuery()`, qui suffit dans tous les cas
- [ ] **D.** Ce n'est pas possible, le JavaScript inline ne peut jamais accéder à jQuery

### Question 135

Pourquoi utiliser `global` plutôt que `window` pour exposer une variable, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `global` est plus rapide à l'exécution
- [ ] **B.** Parce que `window` n'existe pas dans un contexte Webpack
- [ ] **C.** Il n'y a en réalité aucune différence, les deux termes sont interchangeables sans réserve
- [ ] **D.** Parce que `window.jQuery` ne fonctionnera pas si `autoProvidejQuery()` est utilisé, alors que `global` fonctionne dans les deux cas

### Question 136

Quelle option faut-il positionner à `false` dans `webpack_encore.yaml` pour du JavaScript legacy qui a besoin d'accéder aux variables globales dès le chargement de la page ? *(une seule bonne réponse)*

- [ ] **A.** `script_attributes.async`
- [ ] **B.** `strict_mode`
- [ ] **C.** `entrypoints.json_manifest`
- [ ] **D.** `script_attributes.defer`

## webpack-dev-server et Hot Module Replacement (HMR)

### Question 137

Sur quel port le `webpack-dev-server` tourne-t-il par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `localhost:3000`
- [ ] **B.** `localhost:443`
- [ ] **C.** `localhost:8000`
- [ ] **D.** `localhost:8080`

### Question 138

Comment le dev-server sert-il les assets construits, par rapport à `npm run watch` ? *(une seule bonne réponse)*

- [ ] **A.** Il les écrit sur le disque exactement comme `watch`, sans différence
- [ ] **B.** Il les envoie directement au navigateur via WebSocket sans jamais les construire
- [ ] **C.** Il nécessite un serveur PHP séparé pour fonctionner
- [ ] **D.** Il ne les écrit pas sur le disque, il les sert depuis la mémoire, ce qui permet le hot module reloading

### Question 139

Si l'on utilise les fonctions Twig `encore_entry_script_tags()`/`encore_entry_link_tags()`, que faut-il faire pour que les templates pointent vers le dev-server ? *(une seule bonne réponse)*

- [ ] **A.** Configurer un proxy nginx supplémentaire
- [ ] **B.** Rien, les chemins pointeront automatiquement vers le dev-server
- [ ] **C.** Modifier manuellement chaque template pour ajouter `localhost:8080`
- [ ] **D.** Écrire un middleware Symfony dédié

### Question 140

Comment configurer les options du dev-server directement dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** Via un fichier `dev-server.config.js` séparé
- [ ] **B.** Via `Encore.configureDevServerOptions()`
- [ ] **C.** Via `Encore.setDevServerOptions()`
- [ ] **D.** Ce n'est pas possible, seules les options en ligne de commande fonctionnent

### Question 141

Pour réutiliser le certificat SSL du serveur web local Symfony avec le dev-server en HTTPS, quel type de fichier faut-il référencer ? *(une seule bonne réponse)*

- [ ] **A.** Un fichier `.pem` uniquement
- [ ] **B.** Un fichier `.crt` généré manuellement avec OpenSSL
- [ ] **C.** Aucun fichier, la configuration se fait uniquement via une variable d'environnement
- [ ] **D.** Un fichier `.p12` (ex. `~/.symfony5/certs/default.p12`)

### Question 142

Que faire si le dev-server échoue avec une erreur TLS sous Node.js 17 ou plus récent ? *(une seule bonne réponse)*

- [ ] **A.** Réinstaller Encore depuis zéro
- [ ] **B.** Mettre à jour symfony-cli vers la dernière version, supprimer l'ancien `default.p12` et relancer le serveur Symfony pour régénérer un certificat compatible
- [ ] **C.** Revenir obligatoirement à une version de Node.js antérieure à 17
- [ ] **D.** Désactiver totalement HTTPS, aucune autre solution n'existant

### Question 143

Quelle option permet de résoudre des erreurs CORS avec le dev-server, bien que non recommandée en général ? *(une seule bonne réponse)*

- [ ] **A.** `Encore.disableCors()`
- [ ] **B.** `options.strictSSL = false`
- [ ] **C.** `options.allowedHosts = 'all'` dans `configureDevServerOptions()`
- [ ] **D.** `options.cors = true`

### Question 144

Le Hot Module Replacement fonctionne-t-il automatiquement avec le CSS, en utilisant le dev-server ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement si Sass est désactivé
- [ ] **B.** Le HMR ne concerne que le JavaScript, jamais le CSS
- [ ] **C.** Oui, automatiquement (dès Encore 1.0), contrairement au JavaScript qui n'est supporté que par certains outils comme Vue.js
- [ ] **D.** Non, le CSS nécessite toujours un rechargement complet de la page

### Question 145

Quelles options faut-il configurer pour activer le live reload sur les changements de fichiers PHP/Twig en plus du HMR ? *(plusieurs bonnes réponses)*

- [ ] **A.** `options.liveReload = true`
- [ ] **B.** `options.static = { watch: false }`
- [ ] **C.** `options.watchFiles = { paths: ['src/**/*.php', 'templates/**/*'] }`
- [ ] **D.** `options.hotOnly = true`, seule option réellement nécessaire

### Question 146

Pourquoi faut-il désactiver `static.watch` en configurant le live reload pour PHP/Twig ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elle désactive totalement le dev-server
- [ ] **B.** Pour éviter le rechargement par défaut des fichiers du répertoire statique, déjà gérés par le HMR
- [ ] **C.** Parce que cette option n'existe pas réellement dans `webpack-dev-server`
- [ ] **D.** Parce qu'elle entre en conflit avec `allowedHosts`

## Adding Custom Loaders & Plugins

### Question 147

Quelle méthode permet d'ajouter un loader Webpack non fourni nativement par Encore ? *(une seule bonne réponse)*

- [ ] **A.** `enableLoader()`
- [ ] **B.** `addLoader()`
- [ ] **C.** `addCustomLoader()`
- [ ] **D.** `configureLoader()`

### Question 148

Quel type de configuration accepte `addLoader()` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement un nom de package npm, sans options
- [ ] **B.** Uniquement les loaders déjà supportés nativement par Encore
- [ ] **C.** Une chaîne de caractères représentant l'extension de fichier
- [ ] **D.** N'importe quelle configuration de règle Webpack valide (« webpack rules config »)

### Question 149

Depuis Encore 7.0 (ESM-only), quelle variable globale CommonJS n'est plus disponible dans `webpack.config.js`, et par quoi est-elle remplacée ? *(une seule bonne réponse)*

- [ ] **A.** `require`, remplacé par `import.meta.require`
- [ ] **B.** `__dirname`, remplacé par `import.meta.dirname`
- [ ] **C.** `process.env`, remplacé par `import.meta.env`
- [ ] **D.** `module.exports`, remplacé par `export.default`

### Question 150

Quelle méthode permet d'ajouter un plugin Webpack personnalisé, comme `IgnorePlugin` pour ignorer les locales de Moment.js ? *(une seule bonne réponse)*

- [ ] **A.** `registerPlugin()`
- [ ] **B.** `configurePlugin()`
- [ ] **C.** `usePlugin()`
- [ ] **D.** `addPlugin()`

### Question 151

Que dit la documentation à propos des plugins internes déjà utilisés par Encore ? *(une seule bonne réponse)*

- [ ] **A.** Les plugins internes ne peuvent jamais être complétés par l'utilisateur
- [ ] **B.** Encore utilise déjà une variété de plugins Webpack en interne, mais on peut en ajouter d'autres via `addPlugin()`
- [ ] **C.** Encore n'utilise aucun plugin en interne, tout passe par des loaders
- [ ] **D.** Un seul plugin interne est utilisé, `HtmlWebpackPlugin`

## Advanced Webpack Configuration (I) — configuration manuelle et multi-configs

### Question 152

Comment récupérer et modifier manuellement la configuration Webpack générée par Encore, sans écraser sa configuration existante ? *(une seule bonne réponse)*

- [ ] **A.** En réaffectant directement les tableaux, ex. `config.resolve.extensions = ['json']`
- [ ] **B.** En modifiant directement le fichier `node_modules/@symfony/webpack-encore/index.js`
- [ ] **C.** Ce n'est pas possible, la configuration générée est figée
- [ ] **D.** En appelant `await Encore.getWebpackConfig()`, puis en poussant (`push`) dans les tableaux existants, ex. `config.resolve.extensions.push('json')`

### Question 153

Pourquoi remplacer directement `config.resolve.extensions = ['json']` (plutôt que `.push('json')`) est-il qualifié de mauvaise pratique ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a en réalité aucune différence entre les deux syntaxes
- [ ] **B.** Parce que cela écrase toutes les extensions déjà ajoutées par Encore
- [ ] **C.** Parce que cette syntaxe provoque une erreur de syntaxe JavaScript
- [ ] **D.** Parce que `resolve.extensions` ne peut jamais être un tableau

### Question 154

À quoi sert `configureWatchOptions()`, notamment utile pour Encore dans une machine virtuelle ? *(une seule bonne réponse)*

- [ ] **A.** À choisir le préprocesseur CSS utilisé
- [ ] **B.** À configurer les options de watch de Webpack (ex. activer le polling, `watchOptions.poll = 250`)
- [ ] **C.** À définir l'URL du serveur de développement
- [ ] **D.** À activer la minification pendant le développement

### Question 155

Que permet la méthode `reset()` d'Encore lorsqu'on définit plusieurs configurations Webpack ? *(une seule bonne réponse)*

- [ ] **A.** Revenir à la configuration par défaut de Symfony
- [ ] **B.** Supprimer tous les fichiers déjà construits dans `public/build`
- [ ] **C.** Réinitialiser l'état de la configuration courante pour en construire une nouvelle indépendante
- [ ] **D.** Réinitialiser tout le cache `node_modules`

### Question 156

Pourquoi faut-il donner un nom unique (`.name`) à chaque configuration Webpack quand on en exporte plusieurs dans un tableau ? *(une seule bonne réponse)*

- [ ] **A.** Pour que Symfony sache dans quel ordre les compiler
- [ ] **B.** Pour éviter les conflits de ports entre les deux configurations
- [ ] **C.** Pour pouvoir cibler une configuration précise via l'option `--config-name` en ligne de commande
- [ ] **D.** Ce n'est qu'une convention esthétique, sans effet fonctionnel

### Question 157

Dans `webpack_encore.yaml`, comment déclarer les répertoires de sortie de plusieurs configurations (builds) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, une seule configuration de sortie étant supportée
- [ ] **B.** Via un fichier `.env.builds` dédié
- [ ] **C.** Via l'option `builds:`, associant chaque nom de configuration à son chemin de sortie
- [ ] **D.** Via une section `outputs:` dans `package.json`

### Question 158

Que faut-il également définir dans `assets.yaml` lorsqu'on utilise plusieurs configurations Webpack (builds) ? *(une seule bonne réponse)*

- [ ] **A.** Rien de plus, un seul manifest global suffit toujours
- [ ] **B.** Une clé `build_priority` pour définir l'ordre de résolution
- [ ] **C.** La désactivation de `json_manifest_path`, incompatible avec le multi-build
- [ ] **D.** Un package par build, chacun avec son propre `json_manifest_path`

### Question 159

Comment préciser, dans un appel à `encore_entry_script_tags()`, quelle configuration (build) utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable globale Twig `build_name` à définir avant l'appel
- [ ] **B.** Via le troisième argument optionnel de la fonction
- [ ] **C.** En modifiant le nom de l'entry lui-même, en le préfixant du nom du build
- [ ] **D.** Ce n'est pas possible, chaque template ne peut utiliser que la configuration par défaut

### Question 160

Pourquoi faut-il appeler `reset()` sur l'`EntrypointLookupInterface` entre le rendu de deux templates dans la même requête (ex. deux e-mails) ? *(une seule bonne réponse)*

- [ ] **A.** Pour forcer la régénération d'`entrypoints.json`
- [ ] **B.** Pour éviter que le CSS d'un des deux rendus ne manque, chaque lookup ne réémettant certains tags qu'une seule fois par requête
- [ ] **C.** Pour vider le cache HTTP du navigateur
- [ ] **D.** Ce n'est utile qu'en développement, jamais en production

### Question 161

Quelle commande permet de retrouver le nom exact du service `EntrypointLookupInterface` associé à une configuration donnée (ex. « email ») ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console webpack_encore:list`
- [ ] **B.** `php bin/console debug:autowiring EntrypointLookupInterface`
- [ ] **C.** `php bin/console debug:container entrypoint_lookup`
- [ ] **D.** `php bin/console debug:router entrypoint_lookup`

### Question 162

Comment injecter le service `entrypoint_lookup` spécifique à une configuration (ex. email) dans une classe, en gardant l'autowiring par type ? *(une seule bonne réponse)*

- [ ] **A.** En renommant la classe pour qu'elle corresponde exactement au nom du service
- [ ] **B.** En injectant systématiquement `webpack_encore.entrypoint_lookup_collection`, sans distinction
- [ ] **C.** Via l'option `bind` dans `config/services.yaml`, en liant le type et le nom du paramètre du constructeur au service précis
- [ ] **D.** Ce n'est pas possible avec l'autowiring, il faut le désactiver pour cette classe

## Advanced Webpack Configuration (II) — loaders, alias, externals

### Question 163

À quoi sert `configureCssLoader()`, avec l'exemple donné d'ignorer les chemins `/uploads/` ? *(une seule bonne réponse)*

- [ ] **A.** À activer la minification CSS
- [ ] **B.** À définir le chemin de sortie des fichiers CSS
- [ ] **C.** À personnaliser la façon dont `css-loader` traite les assets CSS, ex. en filtrant certaines URLs à ne pas résoudre par Webpack
- [ ] **D.** À changer le préprocesseur CSS utilisé (Sass, LESS, Stylus)

### Question 164

Pourquoi voudrait-on ignorer certaines URLs (ex. `/uploads/`) dans le CSS traité par Webpack ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ces URLs contiennent toujours des caractères invalides
- [ ] **B.** Parce que Webpack refuse par défaut de traiter tout chemin commençant par un slash
- [ ] **C.** Parce que cela accélère systématiquement le build de 50%
- [ ] **D.** Parce que ces chemins pointent vers des assets uploadés par les utilisateurs, qui peuvent ne pas exister au moment du build

### Question 165

Pourquoi peut-on avoir besoin de `configureRuntimeEnvironment()` en dehors de l'utilisation classique de la CLI `encore` ? *(une seule bonne réponse)*

- [ ] **A.** Pour forcer le mode production même en développement
- [ ] **B.** Pour générer un objet de configuration Webpack utilisable par un outil tiers ne passant pas par la commande `encore` (ex. Karma)
- [ ] **C.** Pour désactiver complètement Encore dans les tests
- [ ] **D.** Pour remplacer `webpack-dev-server` par un autre serveur

### Question 166

Quel message d'erreur apparaît si l'on tente de générer la configuration Webpack sans que l'environnement d'exécution ait été configuré ? *(une seule bonne réponse)*

- [ ] **A.** Aucune erreur, la configuration utilise silencieusement des valeurs par défaut
- [ ] **B.** Un message expliquant qu'il faut utiliser l'exécutable `encore` ou appeler `Encore.configureRuntimeEnvironment()` soi-même
- [ ] **C.** Une simple page blanche, sans message
- [ ] **D.** Une erreur PHP Fatal Error

### Question 167

Quand doit être appelée `configureRuntimeEnvironment()`, par rapport à l'import de `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** Peu importe l'ordre, cela n'a aucune incidence
- [ ] **B.** Uniquement après le premier build réussi
- [ ] **C.** Avant d'importer `webpack.config.js`
- [ ] **D.** Après avoir importé `webpack.config.js`, jamais avant

### Question 168

Quels loaders peuvent être configurés via `configureLoaderRule()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `sass` (alias `scss`) et `less`
- [ ] **B.** `typescript` (alias `ts`) et `vue`
- [ ] **C.** `handlebars`
- [ ] **D.** La minification, qui n'est pas un loader mais un plugin

### Question 169

Pour les images et les polices, que recommande la documentation d'utiliser plutôt que `configureLoaderRule()` directement ? *(une seule bonne réponse)*

- [ ] **A.** `addLoader()`, qui remplace totalement `configureLoaderRule()` pour tous les cas
- [ ] **B.** `enableAssetsLoader()`
- [ ] **C.** `configureImageRule()` et `configureFontRule()`, dédiées à ces cas
- [ ] **D.** `configureLoaderRule()` reste la seule option, aucune alternative n'existant

### Question 170

Quelle méthode permet de créer des alias d'import, comme `Utilities` pointant vers `src/utilities/` ? *(une seule bonne réponse)*

- [ ] **A.** `configureLoaderRule('alias', ...)`
- [ ] **B.** `setImportPath()`
- [ ] **C.** `addExternals()`
- [ ] **D.** `addAliases()`

### Question 171

Depuis Encore 7.0, par quoi faut-il remplacer les globales CommonJS `__dirname` et `__filename` dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** Ces globales restent disponibles sans changement en 7.0
- [ ] **B.** `path.resolve('.')` pour les deux cas
- [ ] **C.** `import.meta.dirname` et `import.meta.filename`
- [ ] **D.** `process.cwd()` et `process.argv[1]`

### Question 172

À quoi sert la méthode `addExternals()`, et à qui s'adresse-t-elle principalement ? *(une seule bonne réponse)*

- [ ] **A.** À ajouter des dépendances externes automatiquement dans `node_modules`
- [ ] **B.** À charger des scripts distants directement depuis un CDN sans configuration supplémentaire
- [ ] **C.** À la configuration des tests end-to-end
- [ ] **D.** À exclure certains paquets importés du bundle final, pour les récupérer à l'exécution (ex. via une balise `<script>`) ; utile surtout aux développeurs de bibliothèques JavaScript

### Question 173

Pourquoi `configureLoaderRule()` est-elle décrite comme une méthode « bas niveau », à utiliser avec précaution ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elle est réservée exclusivement à un usage interne inaccessible aux utilisateurs
- [ ] **B.** Parce que les modifications sont appliquées juste avant de transmettre les règles à Webpack et peuvent casser la configuration par défaut d'Encore
- [ ] **C.** Parce que c'est au contraire la méthode la plus sûre et recommandée en priorité
- [ ] **D.** Parce qu'elle ne peut jamais modifier le comportement d'un loader existant

## Using Encore in a Virtual Machine

### Question 174

Pourquoi le watch de fichiers pose-t-il problème dans une machine virtuelle, et comment le corriger ? *(une seule bonne réponse)*

- [ ] **A.** Le watch ne fonctionne jamais dans une VM, quelle que soit la configuration
- [ ] **B.** C'est un problème réseau qui se corrige uniquement côté hyperviseur, jamais dans Encore
- [ ] **C.** Il faut désactiver complètement Encore et utiliser Gulp à la place
- [ ] **D.** Le répertoire du projet est partagé via NFS, ce qui casse le watch ; il faut activer l'option polling via `configureWatchOptions()`

### Question 175

Dans quel cas peut-on ignorer la section sur la configuration du public path pour le dev-server dans une VM ? *(une seule bonne réponse)*

- [ ] **A.** Si l'on utilise HTTPS, quel que soit le nom de domaine
- [ ] **B.** Si l'on utilise uniquement Sass, sans JavaScript
- [ ] **C.** Si l'application tourne sur `http://localhost` plutôt que sur un nom de domaine local personnalisé
- [ ] **D.** Jamais, cette configuration est toujours nécessaire dans une VM

### Question 176

Comment configurer le dev-server pour qu'il accepte les connexions depuis l'extérieur de la VM (ex. depuis la machine hôte) ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible depuis une VM
- [ ] **B.** Configurer un tunnel SSH manuel, seule solution supportée
- [ ] **C.** Ajouter `--public 0.0.0.0` à la place de `--host`
- [ ] **D.** Ajouter l'argument `--host 0.0.0.0` à la commande dev-server

### Question 177

Quelle mise en garde la documentation formule-t-elle à propos de `--host 0.0.0.0` ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne fonctionne que sur Windows
- [ ] **B.** Elle désactive automatiquement le HMR
- [ ] **C.** S'assurer de ne lancer le dev-server qu'à l'intérieur de la VM, sinon d'autres machines pourraient y accéder
- [ ] **D.** Cette option est interdite en environnement de développement

### Question 178

Comment corriger l'erreur « Invalid Host header » rencontrée en accédant au dev-server depuis une VM ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver complètement le dev-server et utiliser uniquement `npm run watch`
- [ ] **B.** Modifier le fichier `/etc/hosts` de la VM
- [ ] **C.** Ajouter un certificat SSL supplémentaire
- [ ] **D.** Configurer `options.allowedHosts = 'all'` via `configureDevServerOptions()`

### Question 179

Que faut-il modifier dans `package.json` si l'application tourne sur un nom de domaine local personnalisé (ex. `http://app.vm`) plutôt que `localhost` ? *(une seule bonne réponse)*

- [ ] **A.** Le champ `"main"` de `package.json`
- [ ] **B.** Rien, Encore détecte automatiquement le domaine personnalisé
- [ ] **C.** Le fichier `browserslist`
- [ ] **D.** Le script `dev-server`, en ajoutant `--public http://app.vm:8080`

## FAQ & Common Issues

### Question 180

Quelles sont les deux choses importantes à retenir pour déployer ses assets Encore, selon la FAQ ? *(plusieurs bonnes réponses)*

- [ ] **A.** Compiler les assets pour la production (`encore production`)
- [ ] **B.** Ne déployer que les assets finaux déjà construits (ex. le répertoire `public/build`)
- [ ] **C.** Toujours installer Node.js sur le serveur de production, sans exception
- [ ] **D.** Toujours committer `node_modules/` pour accélérer le déploiement

### Question 181

Faut-il installer Node.js sur le serveur de production ? *(une seule bonne réponse)*

- [ ] **A.** Non, jamais, même pour builder sur le serveur
- [ ] **B.** Uniquement si Sass est utilisé
- [ ] **C.** Non, sauf si l'on prévoit de construire les assets de production directement sur ce serveur (ce qui n'est pas recommandé)
- [ ] **D.** Oui, systématiquement, quelle que soit la stratégie de déploiement

### Question 182

Que doit contenir le fichier `.gitignore` d'un projet Encore, selon la FAQ ? *(plusieurs bonnes réponses)*

- [ ] **A.** `/node_modules/`
- [ ] **B.** Le répertoire passé à `Encore.setOutputPath()` (ex. `/public/build`)
- [ ] **C.** `package.json`
- [ ] **D.** `package-lock.json`

### Question 183

Si l'application ne vit pas à la racine du serveur web mais dans un sous-répertoire, quelles méthodes faut-il combiner dans `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `addAliases()`, pour rediriger les imports vers le bon sous-répertoire
- [ ] **B.** `setPublicPath()` avec le sous-répertoire, et `setManifestKeyPrefix()` pour garder des clés `manifest.json` cohérentes (ex. `build/foo.js`)
- [ ] **C.** `setOutputPath()` seul suffit, sans autre changement
- [ ] **D.** Il faut créer un second projet Encore dédié au sous-répertoire

### Question 184

Que faire face à l'erreur « Uncaught ReferenceError: webpackJsonp is not defined » ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter jQuery en variable globale
- [ ] **B.** Vérifier qu'une balise `<script>` pour `runtime.js` est bien présente (ce qui ne devrait jamais manquer avec `encore_entry_script_tags()`)
- [ ] **C.** Réinstaller intégralement `node_modules`
- [ ] **D.** Désactiver `splitEntryChunks()`, seule cause possible

### Question 185

Que signifie l'erreur « This dependency was not found: some-module in ./path/to/file.js » après un `npm install` réussi ? *(une seule bonne réponse)*

- [ ] **A.** Le package n'a pas été correctement installé par npm, il faut relancer l'installation
- [ ] **B.** Il s'agit toujours d'un problème de version de Node.js
- [ ] **C.** C'est une erreur qui ne peut être corrigée qu'en passant par Yarn
- [ ] **D.** Le package n'a pas de clé `"main"` indiquant son fichier principal ; il faut importer le fichier précis à utiliser (idéalement une version non minifiée)

### Question 186

Comment faire passer un module tiers de `node_modules/` à travers Babel, alors qu'Encore ne le fait pas par défaut pour des raisons de performance ? *(une seule bonne réponse)*

- [ ] **A.** En renommant le module avec l'extension `.jsx`
- [ ] **B.** En désactivant Babel entièrement pour tout le projet
- [ ] **C.** Via `configureBabel()`, en utilisant l'option `includeNodeModules`
- [ ] **D.** Ce n'est jamais possible, `node_modules` étant toujours exclu de Babel

### Question 187

Comment intégrer Encore avec un IDE (ex. PhpStorm) qui a besoin de générer la configuration Webpack en dehors de la commande `encore` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seule la CLI `encore` peut générer la configuration
- [ ] **B.** En installant un plugin PhpStorm dédié à Encore, seule solution supportée
- [ ] **C.** En copiant manuellement `package.json` dans le répertoire de configuration de l'IDE
- [ ] **D.** En vérifiant `Encore.isRuntimeEnvironmentConfigured()` puis en appelant `Encore.configureRuntimeEnvironment()` si nécessaire, avant le reste de la configuration

### Question 188

Pourquoi les tests peuvent-ils échouer avec une erreur liée à `entrypoints.json` introuvable ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Symfony ignore systématiquement les assets en environnement de test
- [ ] **B.** Parce que les assets Encore n'ont pas été construits, donc le fichier `entrypoints.json` n'existe pas encore à cet emplacement
- [ ] **C.** Parce que PHPUnit ne supporte pas Encore, quel que soit l'environnement
- [ ] **D.** Parce que le fichier a été renommé `manifest.json` depuis une version récente

### Question 189

Quelle option permet d'éviter que les fonctions Twig d'Encore ne lèvent une exception quand `entrypoints.json` est absent (typiquement en environnement de test) ? *(une seule bonne réponse)*

- [ ] **A.** `ignore_missing_manifest: true`
- [ ] **B.** `entrypoints.json` est toujours généré automatiquement en environnement de test, cette option est inutile
- [ ] **C.** `strict_mode: false`, dans la configuration `webpack_encore` (ex. sous `when@test`)
- [ ] **D.** `debug_mode: true`

### Question 190

Que recommande la FAQ pour résoudre une erreur « jQuery is not defined » / « $ is not defined » apparaissant dans du code tiers ou son propre code ? *(une seule bonne réponse)*

- [ ] **A.** Charger jQuery via une balise `<script>` classique en plus de Webpack, dans tous les cas
- [ ] **B.** Ce n'est jamais réparable avec Webpack, il faut migrer entièrement vers un import global
- [ ] **C.** Se référer à la page dédiée aux applications legacy et plugins jQuery, la solution dépendant de l'origine exacte du code fautif
- [ ] **D.** Toujours appeler `autoProvidejQuery()`, sans exception, quelle que soit la source du problème

---

## Corrigé

**Question 1 : D** — « Webpack Encore 7.0 made the package ESM-only. (…) you must use ESM syntax (`import` / `export`), add `"type": "module"` (…) and `getWebpackConfig()` returns a `Promise` that must be awaited. » *(§ Installation d'Encore)*

**Question 2 : B** — avant 7.0 : `const Encore = require(...)`, `module.exports = Encore.getWebpackConfig()`, méthode synchrone. *(§ Installation d'Encore)*

**Question 3 : B** — « this will install and enable the WebpackEncoreBundle, create the `assets/` directory, add a `webpack.config.js` file, and add `node_modules/` to `.gitignore`. » *(§ Installation d'Encore)*

**Question 4 : B** — « `npm install @symfony/webpack-encore --save-dev` (…) creates (or modifies) a `package.json` file and downloads dependencies into a `node_modules/` directory. » *(§ Installation d'Encore)*

**Question 5 : B** — « You *should* commit `package.json` and `package-lock.json` to version control, but ignore `node_modules/`. » *(§ Installation d'Encore)*

**Question 6 : D** — commentaires du fichier généré : `setOutputPath()` = « directory where compiled assets will be stored » ; `setPublicPath()` = « public path used by the web server to access the output path ». *(§ Installation d'Encore)*

**Question 7 : C** — « only needed for CDN's or sub-directory deploy » (commentaire sur `setManifestKeyPrefix()`). *(§ Installation d'Encore)*

**Question 8 : C** — « will require an extra script tag for runtime.js but, you probably want this, unless you're building a single-page app ». *(§ Installation d'Encore)*

**Question 9 : B** — « requires WebpackEncoreBundle 1.4 or higher » (commentaire sur `enableIntegrityHashes()`). *(§ Installation d'Encore)*

**Question 10 : C** — « uncomment if you're having problems with a jQuery plugin » (commentaire sur `autoProvidejQuery()`). *(§ Installation d'Encore)*

**Question 11 : A, B** — `assets/controllers.json` : `{ "controllers": [], "entrypoints": [] }`. *(§ Installation d'Encore)*

**Question 12 : A, B, C** — scripts `package.json` : `"dev-server": "encore dev-server"`, `"dev": "encore dev"`, `"watch": "encore dev --watch"`, `"build": "encore production --progress"`. *(§ Installation d'Encore)*

**Question 13 : B** — « Encore's job (via Webpack) is simple: to read and follow *all* the `import` statements and create one final `app.js` (and `app.css`) that contains *everything* your app needs. » *(§ Premiers pas)*

**Question 14 : B** — « The *key* part is `addEntry()`: this tells Encore to load the `assets/app.js` file and follow *all* the `import` statements. » *(§ Premiers pas)*

**Question 15 : A, B** — « compile assets and automatically re-compile when files change » (`watch`) ; « run a dev-server that can sometimes update your code without refreshing the page » (`dev-server`). *(§ Premiers pas)*

**Question 16 : D** — « Whenever you make changes in your `webpack.config.js` file, you must stop and restart `encore`. » *(§ Premiers pas)*

**Question 17 : A, B, C** — « `public/build/app.js`, `public/build/app.css`, `public/build/runtime.js` ». *(§ Premiers pas)*

**Question 18 : B** — « The `encore_entry_link_tags()` and `encore_entry_script_tags()` functions read from a `public/build/entrypoints.json` file (…) to know the exact filename(s) to render. » *(§ Premiers pas)*

**Question 19 : A, B, C** — « you can enable versioning or point assets to a CDN without making *any* changes to your template (…) And if you use `splitEntryChunks()` (…) all the necessary `script` and `link` tags will render automatically. » *(§ Premiers pas)*

**Question 20 : B** — « you can point directly to the final built files or write code to parse `entrypoints.json` manually. » *(§ Premiers pas)*

**Question 21 : B** — « The `defer` attribute (…) delays the execution of the JavaScript until the page loads (…) automatically enabled in that bundle's recipe. » *(§ Premiers pas)*

**Question 22 : C** — « Webpack enables `resolve.fullySpecified` by default. This means the file extension is now required for relative imports. » *(§ Premiers pas)*

**Question 23 : D** — « Using `addStyleEntry()` is supported, but not recommended. A better option is (…) `addEntry()` to point to a JavaScript file, then require the CSS needed from inside of that. » *(§ Premiers pas)*

**Question 24 : B** — « `Error: Install sass-loader & sass to use enableSassLoader()` ». *(§ Premiers pas)*

**Question 25 : C** — « we recommend Stimulus: a small JavaScript framework that makes it easy to attach behavior to HTML. » *(§ Premiers pas)*

**Question 26 : C** — « The `stimulus_controller('say-hello')` renders a `data-controller="say-hello"` attribute. Whenever this element appears on the page, Stimulus will automatically look for and initialize a controller. » *(§ Premiers pas)*

**Question 27 : D** — « The Flex recipe should add several files/directories: `assets/bootstrap.js`, `assets/controllers/`, `assets/controllers.json`. » *(§ Stimulus, Turbo et JavaScript spécifique par page)*

**Question 28 : D** — « Turbo automatically transforms all link clicks and form submits into an Ajax call, with zero (or nearly zero) changes to your Symfony code! » *(§ Stimulus, Turbo…)*

**Question 29 : B** — « leverage lazy controllers (…) this controller's code (…) will be split to *separate* files by Encore (…) not downloaded until the moment a matching element (…) appears on the page. » *(§ Stimulus, Turbo…)*

**Question 30 : D** — « If you write your controllers using TypeScript, make sure `removeComments` is not set to `true`. » *(§ Stimulus, Turbo…)*

**Question 31 : A, B, C** — créer un fichier entry par page, `addEntry()`, puis restart Encore. *(§ Stimulus, Turbo…)*

**Question 32 : B** — bloc `{% block stylesheets %} {{ parent() }} {{ encore_entry_link_tags('checkout') }} {% endblock %}` (idem javascripts). *(§ Stimulus, Turbo…)*

**Question 33 : D** — `import $ from 'jquery'; import greet from './greet.js';`. *(§ Stimulus, Turbo…)*

**Question 34 : B** — même message d'erreur qu'à la Q24 : Encore indique la commande d'installation manquante. *(§ Stimulus, Turbo…)*

**Question 35 : D** — « For a full list of what you can do, see Encore's index.js file. » *(§ Stimulus, Turbo…)*

**Question 36 : A, B, C** — « Encore can do a lot more: minify files, pre-process Sass/LESS, support React, Vue.js, etc. » *(§ Stimulus, Turbo…)*

**Question 37 : D** — balises incluses dans `templates/base.html.twig`, blocks `stylesheets`/`javascripts` du `<head>`. *(§ Stimulus, Turbo…)*

**Question 38 : B** — « Webpack will now output a new `checkout.js` file (…) And, if any of those files require/import CSS, Webpack will *also* output `checkout.css`. » *(§ Stimulus, Turbo…)*

**Question 39 : A, B, C** — « processes files ending in `.scss` or `.sass` / `.less` / `.styl` ». *(§ Préprocesseurs CSS)*

**Question 40 : B** — « restart Encore. When you do, it will give you a command you can run to install any missing dependencies. » *(§ Préprocesseurs CSS)*

**Question 41 : B** — « Since Encore 6.0, `sass-loader` uses the modern Sass API by default. » *(§ Préprocesseurs CSS)*

**Question 42 : B** — « `includePaths` is now `loadPaths` ». *(§ Préprocesseurs CSS)*

**Question 43 : B** — « if you need the legacy API (not recommended): `options.api = 'legacy';`. » *(§ Préprocesseurs CSS)*

**Question 44 : C** — « PostCSS is a CSS post-processing tool that can transform your CSS in a lot of cool ways, like autoprefixing, linting and more! » *(§ PostCSS)*

**Question 45 : B** — `.enablePostCssLoader()`. *(§ PostCSS)*

**Question 46 : C** — « configuration files like `postcss.config.js` must use ESM syntax (…) If you prefer to keep CommonJS syntax, rename the file to `postcss.config.cjs`. » *(§ PostCSS)*

**Question 47 : D** — « The `postcss-loader` will now be used for all CSS, Sass, etc files. » *(§ PostCSS)*

**Question 48 : D** — `options.postcssOptions = { config: path.resolve(import.meta.dirname, 'sub-dir', 'custom.config.js') }`. *(§ PostCSS)*

**Question 49 : D** — « The best-practice is to configure this directly in your `package.json` », clé `browserslist`. *(§ PostCSS)*

**Question 50 : A, B, C, D** — « `"defaults"` (…) would be equivalent to (…) `"> 0.5%", "last 2 versions", "Firefox ESR", "not dead"`. » *(§ PostCSS)*

**Question 51 : D** — `npm install react react-dom prop-types --save`. *(§ Enabling React.js)*

**Question 52 : C** — `.enableReactPreset()`. *(§ Enabling React.js)*

**Question 53 : D** — « Your `.js` and `.jsx` files will now be transformed through `babel-preset-react`. » *(§ Enabling React.js)*

**Question 54 : B** — même mécanisme que Q24/Q34 : Encore affiche la commande d'installation manquante après redémarrage. *(§ Enabling React.js)*

**Question 55 : B** — `.enableVueLoader()`. *(§ Enabling Vue.js)*

**Question 56 : C** — « By default, Encore uses a Vue "build" that allows you to compile templates at runtime. » *(§ Enabling Vue.js)*

**Question 57 : B** — `.enableVueLoader(() => {}, { runtimeCompilerBuild: false })`. *(§ Enabling Vue.js)*

**Question 58 : D** — « this does *not* currently work for *style* changes in a `.vue` file. Seeing updated styles still requires a page refresh. » *(§ Enabling Vue.js)*

**Question 59 : B** — `.enableVueLoader(() => {}, { useJsx: true })`. *(§ Enabling Vue.js)*

**Question 60 : B** — « Your `.jsx` files will now be transformed through `@vue/babel-plugin-jsx`. » *(§ Enabling Vue.js)*

**Question 61 : D** — « You can't use `<style>` in `.jsx` files. As a workaround, you can import `.css`, `.scss`, etc. files manually (…) makes them global. » *(§ Enabling Vue.js)*

**Question 62 : B** — « you can use CSS Modules by suffixing import paths with `?module`. » *(§ Enabling Vue.js)*

**Question 63 : B** — « Since Webpack Encore 7.0 is ESM-only, the CommonJS `require()` function is no longer available (…) use a top-level `import` instead. » *(§ Enabling Vue.js)*

**Question 64 : B** — « given that both Twig and Vue.js use the same delimiters for variables, you should configure the `delimiters` Vue.js option. » *(§ Enabling Vue.js)*

**Question 65 : C** — « You can also silence the recommendation by passing `runtimeCompilerBuild: true`. » *(§ Enabling Vue.js)*

**Question 66 : C** — « You can (…) configure the vue-loader options by passing an options callback to `enableVueLoader()`. » *(§ Enabling Vue.js)*

**Question 67 : D** — « When you `require` (or `import`) an image file, Webpack copies it into your output directory and returns the final, *public* path to that file. » *(§ Copier et référencer des fichiers/images)*

**Question 68 : D** — « you can use the `copyFiles()` method to copy those files into your final output directory. » *(§ Copier et référencer des fichiers/images)*

**Question 69 : A, B, C** — options de `copyFiles()` : `from`, `to` (optionnel), `pattern`. *(§ Copier et référencer des fichiers/images)*

**Question 70 : B** — « If you have versioning enabled, the copied files will include a hash based on their content. » *(§ Copier et référencer des fichiers/images)*

**Question 71 : B** — « To render inside Twig, use the `asset()` function. » *(§ Copier et référencer des fichiers/images)*

**Question 72 : C** — « If you're not sure what path argument to pass to the `asset()` function, find the file in `manifest.json` and use the *key* as the argument. » *(§ Copier et référencer des fichiers/images)*

**Question 73 : B** — « Babel is automatically configured for all `.js` and `.jsx` files via the `babel-loader` with sensible defaults. » *(§ Configuring Babel)*

**Question 74 : D** — « The easiest way is via `configureBabel()`. » *(§ Configuring Babel)*

**Question 75 : D** — « note that you can't use both "includeNodeModules" and "exclude" at the same time ». *(§ Configuring Babel)*

**Question 76 : D** — « Without a `browserslist` configuration, `@babel/preset-env` in Babel 8 targets modern browsers by default instead of compiling down to ES5. » *(§ Configuring Babel)*

**Question 77 : C** — « you will need to manually remove the babel cache directory: `rm -rf node_modules/.cache/babel-loader/`. » *(§ Configuring Babel)*

**Question 78 : B** — « The `useBuiltIns` and `corejs` options are no longer supported since Webpack Encore 7.0, because Babel 8 removed them from `@babel/preset-env`. Encore throws an explicit error if you set them. » *(§ Configuring Babel)*

**Question 79 : C** — « To add polyfills with Babel 8, use `babel-plugin-polyfill-corejs3` instead. » *(§ Configuring Babel)*

**Question 80 : C** — « as soon as a `.babelrc` file is present, Encore can no longer add any Babel configuration for you. » *(§ Configuring Babel)*

**Question 81 : B** — « use the `configureBabelPresetEnv()` method to add any of the `@babel/preset-env` configuration options. » *(§ Configuring Babel)*

**Question 82 : B** — « Source maps allow browsers to access the original code related to some asset (…) useful for debugging purposes but unnecessary (…) in production. » *(§ Source maps)*

**Question 83 : D** — `.enableSourceMaps(!Encore.isProduction())`. *(§ Source maps)*

**Question 84 : D** — `.enableTypeScriptLoader()`. *(§ Enabling TypeScript)*

**Question 85 : D** — « create an empty `tsconfig.json` file with the contents `{}`. » *(§ Enabling TypeScript)*

**Question 86 : C** — « optionally enable forked type script for faster builds (…) requires that you have a `tsconfig.json` file that is setup correctly. » *(§ Enabling TypeScript)*

**Question 87 : B** — « `.enableTypeScriptLoader(function(tsConfig) { ... })` — adjust `ts-loader` settings. » *(§ Enabling TypeScript)*

**Question 88 : C** — « If React is enabled (`.enableReactPreset()`), any `.tsx` file will also be processed by `ts-loader`. » *(§ Enabling TypeScript)*

**Question 89 : C** — « each filename will now include a hash that changes whenever the *contents* of that file change (…) allows you to use aggressive caching strategies. » *(§ Asset Versioning)*

**Question 90 : A, B** — « To link to these assets, Encore creates two files `entrypoints.json` and `manifest.json`. » *(§ Asset Versioning)*

**Question 91 : D** — « `entrypoints.json` – is used by the `encore_entry_script_tags()` and `encore_entry_link_tags()` Twig helpers. » *(§ Asset Versioning)*

**Question 92 : D** — « The `manifest.json` file is only needed to get the versioned filename of *other* files, like font files or image files. » *(§ Asset Versioning)*

**Question 93 : B** — `framework: assets: json_manifest_path: '...'`. *(§ Asset Versioning)*

**Question 94 : C** — « Be sure to wrap each path in the Twig `asset()` function. » *(§ Asset Versioning)*

**Question 95 : D** — « This is usually not a problem when deploying applications using a rolling update, blue/green or symlink strategies. However (…) there could be a lapse of time. » *(§ Asset Versioning)*

**Question 96 : B** — « the best solution is to use a CDN (or custom made service) that keeps all the old assets cached for some time. » *(§ Asset Versioning)*

**Question 97 : C** — « Both JavaScript and CSS minification are backed by the unified `minimizer-webpack-plugin`. » *(§ Minifying JavaScript and CSS)*

**Question 98 : A, B** — « Before Encore 7.0, JavaScript minification was handled by `terser-webpack-plugin` (…) and CSS minification by `css-minimizer-webpack-plugin`. » *(§ Minifying JavaScript and CSS)*

**Question 99 : C** — « `configureTerserPlugin()` was removed; use the new `configureJsMinimizerPlugin()` instead (it takes the same callback). » *(§ Minifying JavaScript and CSS)*

**Question 100 : D** — « CSS minification is no longer enabled by default. You must choose and configure a CSS minifier. » *(§ Minifying JavaScript and CSS)*

**Question 101 : C** — « JavaScript is minified out of the box (no extra package required) using Terser, which is bundled inside `minimizer-webpack-plugin`. » *(§ Minifying JavaScript and CSS)*

**Question 102 : A, B, C** — « Available JS minimizers: `terserMinify` (default, bundled), `uglifyJsMinify`, `swcMinify` and `esbuildMinify`. » *(§ Minifying JavaScript and CSS)*

**Question 103 : A, B, C** — « Other supported CSS minimizers: `csso`, `clean-css`, `esbuild` (`esbuildMinifyCss`) and `@swc/css` (`swcMinifyCss`). » *(§ Minifying JavaScript and CSS)*

**Question 104 : B** — « The `MinimizerPlugin` class is passed as the second argument of the callback, so you don't need to import `minimizer-webpack-plugin` yourself (it would not resolve under pnpm). » *(§ Minifying JavaScript and CSS)*

**Question 105 : D** — « If you are upgrading from Encore 6.0 and want to keep the previous behavior (…) install `cssnano` and `postcss`, then add the `cssnanoMinify` configuration. » *(§ Minifying JavaScript and CSS)*

**Question 106 : C** — `if (Encore.isProduction()) { Encore.setPublicPath('https://my-cool-app.com...'); }`. *(§ Using a CDN)*

**Question 107 : B** — « guarantee that the keys in `manifest.json` are *still* prefixed with `build/`. » *(§ Using a CDN)*

**Question 108 : D** — « It's still your responsibility to put your assets on the CDN. » *(§ Using a CDN)*

**Question 109 : B** — « you must add the path at the end of your URL. » *(§ Using a CDN)*

**Question 110 : C** — « If you are using `Encore.enableIntegrityHashes()` and your CDN and your domain are not the same-origin, you may need to set the `crossorigin` option (…) to overcome CORS errors. » *(§ Using a CDN)*

**Question 111 : C** — « use `import()` as a function - it returns a Promise. » *(§ Async Code Splitting)*

**Question 112 : C** — « your `.then()` callback is passed an object, where the *actual* module is on a `.default` key. » *(§ Async Code Splitting)*

**Question 113 : C** — « Webpack will package the `VideoPlayer` module into a separate file (e.g. `0.js`) so it can be downloaded. » *(§ Async Code Splitting)*

**Question 114 : D** — « `.catch(error => 'An error occurred while loading the component')`. » *(§ Async Code Splitting)*

**Question 115 : B** — « *each* output file will contain jQuery, making your files much larger than necessary. To solve this, you can ask webpack to (…) *split* them. » *(§ Split Chunks)*

**Question 116 : B** — « each output file (…) *may* be split into multiple file (…) you *may* need to include *multiple* `script` tags. » *(§ Split Chunks)*

**Question 117 : D** — « These functions automatically read this file and render as many `script` or `link` tags as needed. » *(§ Split Chunks)*

**Question 118 : C** — « The logic (…) is controlled by the `SplitChunksPlugin from Webpack`. » *(§ Split Chunks)*

**Question 119 : B** — « You can control the configuration passed to this plugin with the `configureSplitChunks()` function. » *(§ Split Chunks)*

**Question 120 : D** — « reduce the number of HTTP requests inlining small files as base64 encoded URLs in the generated CSS files. » *(§ The url-loader)*

**Question 121 : B** — `.configureImageRule({ type: 'asset' })` / `.configureFontRule({ type: 'asset' })`. *(§ The url-loader)*

**Question 122 : C** — « `maxSize: 4 * 1024, // 4 kb - the default is 8kb` ». *(§ The url-loader)*

**Question 123 : C** — `npm install bootstrap --save-dev`. *(§ Using Bootstrap CSS & JS)*

**Question 124 : B** — « the `~` allows you to reference things in `node_modules` : `@import "~bootstrap/scss/bootstrap";`. » *(§ Using Bootstrap CSS & JS)*

**Question 125 : D** — « you can include specific files in the `bootstrap` directory instead - e.g. `~bootstrap/scss/alert`. » *(§ Using Bootstrap CSS & JS)*

**Question 126 : B** — « jQuery is only required in versions prior to Bootstrap 5 : `npm install jquery @popperjs/core --save-dev`. » *(§ Using Bootstrap CSS & JS)*

**Question 127 : B** — « this "modifies" the jquery module: adding behavior to it — the bootstrap module doesn't export/return anything. » *(§ Using Bootstrap CSS & JS)*

**Question 128 : B** — « wrap the initialization in a `turbo:load` event listener. » *(§ Using Bootstrap CSS & JS)*

**Question 129 : D** — « you may need to use Encore's `autoProvidejQuery()` method so that these plugins know where to find jQuery. » *(§ Using Bootstrap CSS & JS)*

**Question 130 : B** — « when you require a module, it does *not* (usually) set a global variable. Instead, it just returns a value. » *(§ jQuery Plugins and Legacy Applications)*

**Question 131 : D** — « call `autoProvidejQuery()` from your `webpack.config.js` file (…) It "rewrites" the "bad" code to be correct. » *(§ jQuery Plugins and Legacy Applications)*

**Question 132 : B** — « this `autoProvidejQuery()` method calls the `autoProvideVariables()` method (…) equivalent to `.autoProvideVariables({ $: 'jquery', jQuery: 'jquery', 'window.jQuery': 'jquery' })`. » *(§ jQuery Plugins and Legacy Applications)*

**Question 133 : B** — « you can use this method to provide other common global variables, such as `_` for the 'underscore' library. » *(§ jQuery Plugins and Legacy Applications)*

**Question 134 : B** — « `global.$ = global.jQuery = $;` ». *(§ jQuery Plugins and Legacy Applications)*

**Question 135 : D** — « using `global` and `window` are equivalent, except that `window.jQuery` won't work when using `autoProvidejQuery()`. In other words, use `global`. » *(§ jQuery Plugins and Legacy Applications)*

**Question 136 : D** — « set the `script_attributes.defer` option to `false`. » *(§ jQuery Plugins and Legacy Applications)*

**Question 137 : D** — « This server runs at `localhost:8080` by default. » *(§ webpack-dev-server et HMR)*

**Question 138 : D** — « This server does not actually write the files to disk; instead it serves them from memory, allowing for hot module reloading. » *(§ webpack-dev-server et HMR)*

**Question 139 : B** — « you're done: the paths in your templates will automatically point to the dev server. » *(§ webpack-dev-server et HMR)*

**Question 140 : B** — « using the `Encore.configureDevServerOptions()` method. » *(§ webpack-dev-server et HMR)*

**Question 141 : D** — « `pfx: path.join(process.env.HOME, '.symfony5/certs/default.p12')`. » *(§ webpack-dev-server et HMR)*

**Question 142 : B** — « Upgrade symfony-cli to the latest version, delete the old `~/.symfony5/certs/default.p12` file, and start symfony server again. » *(§ webpack-dev-server et HMR)*

**Question 143 : C** — « `options.allowedHosts = 'all';` (…) not a recommended security practice in general, but here it's required. » *(§ webpack-dev-server et HMR)*

**Question 144 : C** — « HMR works automatically with CSS (…) but only works with some JavaScript (like Vue.js). » *(§ webpack-dev-server et HMR)*

**Question 145 : A, B, C** — `options.liveReload = true; options.static = { watch: false }; options.watchFiles = { paths: [...] };`. *(§ webpack-dev-server et HMR)*

**Question 146 : B** — « The `static.watch` option is required to disable the default reloading of files from the static directory, as those files are already handled by HMR. » *(§ webpack-dev-server et HMR)*

**Question 147 : B** — « you can add your own loader through the `addLoader` function. » *(§ Adding Custom Loaders & Plugins)*

**Question 148 : D** — « The `addLoader` takes any valid webpack rules config. » *(§ Adding Custom Loaders & Plugins)*

**Question 149 : B** — « the CommonJS `__dirname` global is no longer available (…) Use `import.meta.dirname` instead. » *(§ Adding Custom Loaders & Plugins)*

**Question 150 : D** — « you can add your own via the `addPlugin()` method. » *(§ Adding Custom Loaders & Plugins)*

**Question 151 : B** — « Encore uses a variety of different plugins internally. But, you can add your own via `addPlugin()`. » *(§ Adding Custom Loaders & Plugins)*

**Question 152 : D** — « fetch the config, then modify it! `config.resolve.extensions.push('json');`. » *(§ Advanced Webpack Configuration (I))*

**Question 153 : B** — « BAD - this replaces any extensions added by Encore: `config.resolve.extensions = ['json'];`. » *(§ Advanced Webpack Configuration (I))*

**Question 154 : B** — « `Encore.configureWatchOptions(function(watchOptions) { watchOptions.poll = 250; });` ». *(§ Advanced Webpack Configuration (I))*

**Question 155 : C** — « Webpack Encore includes a `reset()` object allowing to reset the state of the current configuration to build a new one. » *(§ Advanced Webpack Configuration (I))*

**Question 156 : C** — « Set a unique name for the config (needed later!) (…) pass the `--config-name` option. » *(§ Advanced Webpack Configuration (I))*

**Question 157 : C** — « `webpack_encore: builds: firstConfig: '...' secondConfig: '...'` ». *(§ Advanced Webpack Configuration (I))*

**Question 158 : D** — « `assets: packages: first_build: json_manifest_path: '...' second_build: json_manifest_path: '...'` ». *(§ Advanced Webpack Configuration (I))*

**Question 159 : B** — « use the third optional parameter of the `encore_entry_*_tags()` functions to specify which build to use. » *(§ Advanced Webpack Configuration (I))*

**Question 160 : B** — « When you render two or more templates in the same request (…) you should call the `reset()` method on the `EntrypointLookupInterface`. » *(§ Advanced Webpack Configuration (I))*

**Question 161 : C** — `php bin/console debug:container entrypoint_lookup`. *(§ Advanced Webpack Configuration (I))*

**Question 162 : C** — « use the `bind` option (…) `Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface $entryPointLookupEmail: '@webpack_encore.entrypoint_lookup[email]'`. » *(§ Advanced Webpack Configuration (I))*

**Question 163 : C** — « Encore provides the `configureCssLoader()` method to customize how `css-loader` processes your CSS assets. » *(§ Advanced Webpack Configuration (II))*

**Question 164 : D** — « if your application serves user-uploaded assets from a specific directory, you'll want Webpack to ignore these paths since they may not exist during the build process. » *(§ Advanced Webpack Configuration (II))*

**Question 165 : B** — « having access to the generated Webpack configuration can be required by tools that don't use Encore (for instance a test-runner such as Karma). » *(§ Advanced Webpack Configuration (II))*

**Question 166 : B** — « Error: Encore.setOutputPath() cannot be called yet because the runtime environment doesn't appear to be configured. Make sure you're using the encore executable or call Encore.configureRuntimeEnvironment() first. » *(§ Advanced Webpack Configuration (II))*

**Question 167 : C** — « This method must be called from a JavaScript file **before** importing `webpack.config.js`. » *(§ Advanced Webpack Configuration (II))*

**Question 168 : A, B, C** — « `sass` (alias `scss`), `less`, `stylus`, `svelte`, `vue`, `typescript` (alias `ts`), `handlebars` ». *(§ Advanced Webpack Configuration (II))*

**Question 169 : C** — « `images` (but use `configureImageRule()` instead), `fonts` (but use `configureFontRule()` instead) ». *(§ Advanced Webpack Configuration (II))*

**Question 170 : D** — « you can use this option via the `addAliases()` method. » *(§ Advanced Webpack Configuration (II))*

**Question 171 : C** — « the CommonJS globals `__dirname` and `__filename` are no longer available (…) Use `import.meta.dirname` and `import.meta.filename` instead. » *(§ Advanced Webpack Configuration (II))*

**Question 172 : D** — « you can use this option via the `addExternals()` method (…) mostly useful for JavaScript library developers. » *(§ Advanced Webpack Configuration (II))*

**Question 173 : B** — « This is a low-level method. All your modifications will be applied just before pushing the loaders rules to Webpack (…) may break things. » *(§ Advanced Webpack Configuration (II))*

**Question 174 : D** — « your project root directory is shared with the virtual machine using NFS. This introduces issues with files watching, so you must enable the polling option. » *(§ Using Encore in a Virtual Machine)*

**Question 175 : C** — « You can skip this section if your application is running on `http://localhost` instead a custom local domain-name. » *(§ Using Encore in a Virtual Machine)*

**Question 176 : D** — « Add the `--host 0.0.0.0` argument to the dev-server configuration (…) to accept all incoming connections. » *(§ Using Encore in a Virtual Machine)*

**Question 177 : C** — « Make sure to run the development server inside your virtual machine only; otherwise other computers can have access to it. » *(§ Using Encore in a Virtual Machine)*

**Question 178 : D** — « Webpack will respond `Invalid Host header` (…) set the `allowedHosts` option. » *(§ Using Encore in a Virtual Machine)*

**Question 179 : D** — « `"dev-server": "encore dev-server --public http://app.vm:8080"`. » *(§ Using Encore in a Virtual Machine)*

**Question 180 : A, B** — « **1) Compile Assets for Production** (…) **2) Only Deploy the Built Assets**. » *(§ FAQ & Common Issues)*

**Question 181 : C** — « No, unless you plan to build your production assets on your production server, which is not recommended. » *(§ FAQ & Common Issues)*

**Question 182 : A, B** — « Your `.gitignore` file should include: `/node_modules/`, `/public/build`. » *(§ FAQ & Common Issues)*

**Question 183 : B** — « `.setPublicPath('/myAppSubdir/build')` (…) `.setManifestKeyPrefix('build')` — this is now needed so that your `manifest.json` keys are still `build/foo.js`. » *(§ FAQ & Common Issues)*

**Question 184 : B** — « it's probably because you've forgotten to add a `script` tag for the `runtime.js` file (…) If you're using the `encore_entry_script_tags()` Twig function, this should never happen. » *(§ FAQ & Common Issues)*

**Question 185 : D** — « a package will "advertise" its "main" file by adding a `main` key (…) sometimes, old libraries won't have this. Instead, you'll need to specifically import the file you need (…) import a non-minified file whenever possible. » *(§ FAQ & Common Issues)*

**Question 186 : C** — « Encore does not process libraries inside `node_modules/` through Babel. But, you can change that via the `configureBabel()` method. » *(§ FAQ & Common Issues)*

**Question 187 : D** — « Fix this issue calling to `Encore.isRuntimeEnvironmentConfigured()` and `Encore.configureRuntimeEnvironment()` methods. » *(§ FAQ & Common Issues)*

**Question 188 : B** — « This is happening because you did not build your Encore assets, so there is no `entrypoints.json` file. » *(§ FAQ & Common Issues)*

**Question 189 : C** — « set the `strict_mode` option to `false` (…) `when@test: webpack_encore: strict_mode: false`. » *(§ FAQ & Common Issues)*

**Question 190 : C** — « The fix depends on if the error is happening in your code or inside some third-party code that you're using. See `/frontend/encore/legacy-applications` for the fix. » *(§ FAQ & Common Issues)*

## Pour aller plus loin

Les pages indexées par `frontend/encore/index.html`, groupées comme sur la page source (voir la remarque en tête de fichier — cette liste *est* le contenu couvert par ce QCM, pas une annexe à un article principal) :

**Getting Started**

- [Installation](https://symfony.com/doc/8.0/frontend/encore/installation.html) — questions 1 à 12
- [Using Webpack Encore](https://symfony.com/doc/8.0/frontend/encore/simple-example.html) — questions 13 à 38

**Adding more Features**

- [CSS Preprocessors: Sass, LESS, etc.](https://symfony.com/doc/8.0/frontend/encore/css-preprocessors.html) — questions 39 à 43
- [PostCSS and autoprefixing](https://symfony.com/doc/8.0/frontend/encore/postcss.html) — questions 44 à 50
- [Enabling React.js](https://symfony.com/doc/8.0/frontend/encore/reactjs.html) — questions 51 à 54
- [Enabling Vue.js (vue-loader)](https://symfony.com/doc/8.0/frontend/encore/vuejs.html) — questions 55 à 66
- [Copying Files/Folders](https://symfony.com/doc/8.0/frontend/encore/copy-files.html) — questions 67 à 72
- [Configuring Babel](https://symfony.com/doc/8.0/frontend/encore/babel.html) — questions 73 à 81
- [Source maps](https://symfony.com/doc/8.0/frontend/encore/sourcemaps.html) — questions 82 à 83
- [Enabling TypeScript (ts-loader)](https://symfony.com/doc/8.0/frontend/encore/typescript.html) — questions 84 à 88

**Optimizing**

- [Versioning (and the entrypoints.json/manifest.json files)](https://symfony.com/doc/8.0/frontend/encore/versioning.html) — questions 89 à 96
- [Minifying JavaScript and CSS](https://symfony.com/doc/8.0/frontend/encore/minification.html) — questions 97 à 105
- [Using a CDN](https://symfony.com/doc/8.0/frontend/encore/cdn.html) — questions 106 à 110
- [Code Splitting](https://symfony.com/doc/8.0/frontend/encore/code-splitting.html) — questions 111 à 114
- [Split Chunks](https://symfony.com/doc/8.0/frontend/encore/split-chunks.html) — questions 115 à 119
- [The url-loader](https://symfony.com/doc/8.0/frontend/encore/url-loader.html) — questions 120 à 122

**Guides**

- [Using Bootstrap CSS & JS](https://symfony.com/doc/8.0/frontend/encore/bootstrap.html) — questions 123 à 129
- [jQuery and Legacy Applications](https://symfony.com/doc/8.0/frontend/encore/legacy-applications.html) — questions 130 à 136
- [webpack-dev-server and Hot Module Replacement (HMR)](https://symfony.com/doc/8.0/frontend/encore/dev-server.html) — questions 137 à 146
- [Adding custom loaders & plugins](https://symfony.com/doc/8.0/frontend/encore/custom-loaders-plugins.html) — questions 147 à 151
- [Advanced Webpack Configuration](https://symfony.com/doc/8.0/frontend/encore/advanced-config.html) — questions 152 à 173
- [Using Encore in a Virtual Machine](https://symfony.com/doc/8.0/frontend/encore/virtual-machine.html) — questions 174 à 179

**Issues & Questions**

- [FAQ & Common Issues](https://symfony.com/doc/8.0/frontend/encore/faq.html) — questions 180 à 190

**Full API** (lien externe, hors périmètre QCM)

- [Full API](https://github.com/symfony/webpack-encore/blob/master/index.js)
