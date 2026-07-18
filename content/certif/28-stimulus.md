# QCM — StimulusBundle et Symfony UX

> **Version :** Symfony **8.0** (bundle documenté hors du dépôt `symfony-docs`, dans `symfony/ux`) · **Source :** [symfony.com/bundles/StimulusBundle/current/index.html](https://symfony.com/bundles/StimulusBundle/current/index.html) · **Généré le :** 22 juillet 2026
>
> **57 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Vue d'ensemble

### Question 1

Quelles sont les deux intégrations principales que StimulusBundle ajoute entre Symfony, Stimulus et les paquets Symfony UX ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des fonctions/filtres Twig `stimulus_` pour ajouter contrôleurs, actions et cibles dans les templates
- [ ] **B.** Une intégration pour charger les paquets UX (contrôleurs Stimulus supplémentaires)
- [ ] **C.** Un compilateur TypeScript intégré, sans bundle supplémentaire
- [ ] **D.** Un serveur de développement Stimulus autonome, indépendant de Symfony

### Question 2

Où peut-on voir des démonstrations en direct des paquets Symfony UX ? *(une seule bonne réponse)*

- [ ] **A.** https://stimulus.hotwired.dev/demos
- [ ] **B.** Aucune démo en ligne n'est proposée
- [ ] **C.** https://ux.symfony.com
- [ ] **D.** https://symfony.com/demos

## Installation

### Question 3

Quels systèmes de gestion d'assets fonctionnent tous deux très bien avec StimulusBundle, au choix ? *(plusieurs bonnes réponses)*

- [ ] **A.** AssetMapper
- [ ] **B.** Webpack Encore
- [ ] **C.** Vite natif, sans bundle Symfony dédié
- [ ] **D.** Parcel

### Question 4

Quelle commande installe StimulusBundle ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/ux-turbo`
- [ ] **B.** `symfony new --stimulus`
- [ ] **C.** `composer require symfony/stimulus-bundle`
- [ ] **D.** `npm install @symfony/stimulus-bundle`

### Question 5

Si l'on utilise Symfony Flex, que se passe-t-il après l'installation du bundle ? *(une seule bonne réponse)*

- [ ] **A.** Il faut systématiquement lancer une commande `make:stimulus` pour finaliser l'installation
- [ ] **B.** Aucun fichier n'est modifié automatiquement, même avec Flex
- [ ] **C.** Seul le fichier `composer.json` est mis à jour, tout le reste étant manuel
- [ ] **D.** La recette met à jour automatiquement tous les fichiers nécessaires, sans action manuelle

### Question 6

Si l'on utilise Webpack Encore, que recommande la documentation de faire après l'installation du bundle ? *(une seule bonne réponse)*

- [ ] **A.** Vider le cache Symfony puis relancer `composer install`
- [ ] **B.** Supprimer le dossier `node_modules/` avant de le régénérer
- [ ] **C.** Aucune action supplémentaire n'est nécessaire avec Encore
- [ ] **D.** Installer les assets (ex. `npm install`) et redémarrer Encore

## Utilisation

### Question 7

Dans quel dossier crée-t-on ses contrôleurs Stimulus personnalisés, et quel fichier d'exemple y trouve-t-on déjà ? *(une seule bonne réponse)*

- [ ] **A.** `templates/controllers/`, avec l'exemple `hello.js`
- [ ] **B.** `assets/controllers/`, avec l'exemple `hello_controller.js`
- [ ] **C.** `assets/stimulus/`, avec l'exemple `default_controller.js`
- [ ] **D.** `src/Controller/Stimulus/`, avec l'exemple `HelloController.js`

### Question 8

Comment active-t-on un contrôleur Stimulus sur un élément HTML, en pur HTML sans fonction Twig ? *(une seule bonne réponse)*

- [ ] **A.** `<div class="stimulus-hello">`
- [ ] **B.** `<div data-controller="hello">`
- [ ] **C.** `<div stimulus-controller="hello">`
- [ ] **D.** `<div data-stimulus="hello">`

### Question 9

Que rend la fonction Twig `{{ stimulus_controller('hello') }}`, en équivalent de l'attribut HTML manuel ? *(une seule bonne réponse)*

- [ ] **A.** `data-stimulus-controller="hello"`
- [ ] **B.** `stimulus-controller="hello"`
- [ ] **C.** `data-action="hello"`
- [ ] **D.** `data-controller="hello"`

### Question 10

Pour écrire ses contrôleurs Stimulus en TypeScript, quel bundle faut-il installer et configurer ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/ux-typescript`
- [ ] **B.** Aucun bundle n'est nécessaire, TypeScript étant supporté nativement
- [ ] **C.** `sensiolabs/typescript-bundle`
- [ ] **D.** `symfonycasts/typescript-bundle`

### Question 11

Quelle configuration faut-il ajouter pour que le bundle TypeScript prenne en compte le dossier des contrôleurs Stimulus ? *(une seule bonne réponse)*

- [ ] **A.** Créer un fichier `tsconfig.stimulus.json` dédié
- [ ] **B.** Aucune configuration additionnelle n'est nécessaire, la détection étant automatique
- [ ] **C.** Ajouter `assets/controllers` à `sensiolabs_typescript.source_dir`
- [ ] **D.** Ajouter `assets/controllers` à `framework.asset_mapper.paths`

### Question 12

À quoi sert le fichier `assets/controllers.json`, et quand est-il mis à jour ? *(une seule bonne réponse)*

- [ ] **A.** Il liste les routes protégées par un contrôleur Stimulus, mis à jour manuellement
- [ ] **B.** Il contient la configuration TypeScript des contrôleurs, généré une seule fois
- [ ] **C.** Il n'est utilisé qu'en environnement de production
- [ ] **D.** Il active les contrôleurs Stimulus tiers mentionnés, et il est mis à jour à chaque installation d'un paquet UX

### Question 13

Où trouver la liste des paquets UX officiels proposant des contrôleurs Stimulus supplémentaires ? *(une seule bonne réponse)*

- [ ] **A.** https://symfony.com/doc/8.0/ux-packages.html
- [ ] **B.** https://ux.symfony.com/packages
- [ ] **C.** https://packagist.org/ux
- [ ] **D.** https://stimulus.hotwired.dev/packages

### Question 14

Par défaut, quand tous les contrôleurs de l'application (fichiers de `assets/controllers/` et entrées de `controllers.json`) sont-ils téléchargés et chargés ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en environnement de production
- [ ] **B.** Jamais automatiquement, il faut toujours les charger explicitement
- [ ] **C.** Sur chaque page
- [ ] **D.** Uniquement sur la page où l'élément avec `data-controller` apparaît, par défaut

### Question 15

Que se passe-t-il quand un contrôleur est rendu « paresseux » (lazy) ? *(une seule bonne réponse)*

- [ ] **A.** Il est chargé uniquement au survol de la souris sur l'élément
- [ ] **B.** Il n'est pas téléchargé au chargement initial ; dès qu'un élément correspondant apparaît sur la page, il est chargé de façon asynchrone via Ajax
- [ ] **C.** Il est téléchargé au chargement initial mais exécuté seulement après un délai fixe
- [ ] **D.** Il n'est jamais téléchargé, quel que soit le contenu de la page

### Question 16

Comment marque-t-on un contrôleur personnalisé comme paresseux (lazy) dans son propre fichier JavaScript ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant `export const lazy = true;` dans le fichier
- [ ] **B.** En le renommant avec le suffixe `_lazy_controller.js`
- [ ] **C.** En ajoutant l'attribut `data-lazy="true"` sur l'élément HTML
- [ ] **D.** En ajoutant le commentaire spécial `/* stimulusFetch: 'lazy' */` au-dessus de la classe

### Question 17

Comment rend-on paresseux un contrôleur tiers déclaré dans `controllers.json` ? *(une seule bonne réponse)*

- [ ] **A.** En le retirant du fichier puis en le réinstallant avec l'option `--lazy`
- [ ] **B.** Ce n'est pas possible pour un contrôleur tiers, seuls les contrôleurs personnalisés pouvant être paresseux
- [ ] **C.** En ajoutant `lazy: true` au niveau racine de `controllers.json`
- [ ] **D.** En positionnant `fetch` à `lazy` pour ce contrôleur

### Question 18

Quelle précaution la documentation mentionne-t-elle pour les contrôleurs écrits en TypeScript sous StimulusBundle 2.21.0 ou antérieur, concernant le mode lazy ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver totalement le mode strict de TypeScript
- [ ] **B.** Ne jamais utiliser d'export par défaut (`export default`)
- [ ] **C.** Toujours compiler séparément chaque contrôleur lazy dans son propre bundle Webpack
- [ ] **D.** S'assurer que `removeComments` n'est pas activé à `true` dans la configuration TypeScript

## Les outils Stimulus dans le monde

### Question 19

Quel outil ajoute des comportements composables aux contrôleurs Stimulus, comme le debouncing ou la détection de clic en dehors d'un élément ? *(une seule bonne réponse)*

- [ ] **A.** `@symfony/stimulus-bridge`
- [ ] **B.** `stimulus-toolkit`
- [ ] **C.** `stimulus-use`
- [ ] **D.** `stimulus-components`

### Question 20

Quel outil propose un grand nombre de contrôleurs Stimulus préfabriqués (copie dans le presse-papiers, tri, popover…) ? *(une seule bonne réponse)*

- [ ] **A.** `@symfony/ux-live-component`
- [ ] **B.** `stimulus-presets`
- [ ] **C.** `stimulus-components`
- [ ] **D.** `stimulus-use`

## Les aides Twig pour Stimulus

### Question 21

Bien que ce bundle fournisse des fonctions/filtres Twig dédiés, que recommande malgré tout la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Éviter complètement Twig pour tout ce qui touche à Stimulus
- [ ] **B.** Utiliser plutôt les attributs `data-*` bruts, jugés plus directs
- [ ] **C.** Toujours utiliser les fonctions Twig, les attributs bruts étant dépréciés
- [ ] **D.** N'utiliser les fonctions Twig qu'en environnement de production

### Question 22

Quel plugin PhpStorm la documentation recommande-t-elle pour bénéficier d'une bonne auto-complétion sur les attributs Stimulus ? *(une seule bonne réponse)*

- [ ] **A.** Le plugin Twig Enhanced
- [ ] **B.** Aucun plugin n'existe pour cet usage
- [ ] **C.** Le plugin Stimulus
- [ ] **D.** Le plugin Symfony UX

## La fonction stimulus_controller

### Question 23

Quel format prennent les valeurs (« values ») passées en second argument de `stimulus_controller()`, dans les attributs générés ? *(une seule bonne réponse)*

- [ ] **A.** `data-value-<contrôleur>-<nom>`
- [ ] **B.** `data-<nom>="World"` directement, sans préfixe de contrôleur
- [ ] **C.** `stimulus-<contrôleur>-<nom>="World"`
- [ ] **D.** `data-<contrôleur>-<nom>-value`, ex. `data-hello-name-value="World"`

### Question 24

Comment les valeurs non scalaires (ex. un tableau `[1, 2, 3, 4]`) sont-elles représentées dans l'attribut généré ? *(une seule bonne réponse)*

- [ ] **A.** Ignorées : seules les valeurs scalaires peuvent être passées
- [ ] **B.** Sérialisées en base64
- [ ] **C.** Encodées en JSON, avec échappement correct des caractères spéciaux (ex. `[` devient `&#x5B;`)
- [ ] **D.** Converties en chaîne séparée par des virgules sans encodage JSON

### Question 25

Comment ajouter des classes CSS Stimulus (« CSS Classes ») via `stimulus_controller()`, en argument nommé plutôt que positionnel ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible en argument nommé, uniquement en troisième position positionnelle
- [ ] **B.** Via une fonction Twig séparée `stimulus_classes()`
- [ ] **C.** Via l'argument nommé `controllerClasses`, ex. `stimulus_controller('hello', controllerClasses: { 'loading': 'spinner' })`
- [ ] **D.** Via l'argument nommé `cssClasses` uniquement, sans forme positionnelle possible

### Question 26

Comment ajouter des « outlets » Stimulus via `stimulus_controller()`, en argument nommé ? *(une seule bonne réponse)*

- [ ] **A.** Via l'argument nommé `outlets` uniquement en position positionnelle
- [ ] **B.** Les outlets ne peuvent être configurés que directement en JavaScript, jamais depuis Twig
- [ ] **C.** Via une fonction séparée `stimulus_outlet()`
- [ ] **D.** Via l'argument nommé `controllerOutlets`

### Question 27

Comment chaîner plusieurs contrôleurs Stimulus sur un même élément avec `stimulus_controller()` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible : un élément ne peut avoir qu'un seul contrôleur
- [ ] **B.** En passant un tableau de noms de contrôleurs en premier argument
- [ ] **C.** En utilisant le filtre `stimulus_controller`, ex. `stimulus_controller('hello', {...})|stimulus_controller('other-controller')`
- [ ] **D.** En appelant deux fois la fonction dans le même attribut HTML, séparées par un espace

### Question 28

Comment récupérer les attributs générés par `stimulus_controller()` sous forme de tableau PHP, utile par exemple pour les formulaires Symfony ? *(une seule bonne réponse)*

- [ ] **A.** En castant directement la valeur retournée avec `(array)`
- [ ] **B.** Via la méthode `.toArray()`, ex. `stimulus_controller('hello', {...}).toArray()`
- [ ] **C.** Via un filtre Twig séparé `|stimulus_to_array`
- [ ] **D.** Ce n'est pas possible, seule la sortie HTML brute étant accessible

### Question 29

Les contrôleurs peuvent-ils référencer d'autres contrôleurs Stimulus depuis `stimulus_controller()`, et via quel mécanisme ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement via un événement JavaScript personnalisé
- [ ] **B.** Non, chaque contrôleur est totalement isolé des autres
- [ ] **C.** Oui, mais uniquement en dupliquant les valeurs sur chaque contrôleur
- [ ] **D.** Oui, via les outlets

### Question 30

Peut-on utiliser `stimulus_controller()` sans passer de valeurs ni de classes CSS, en ne renseignant que les outlets ? *(une seule bonne réponse)*

- [ ] **A.** Non, un appel à `stimulus_controller()` doit obligatoirement fournir les trois arguments positionnels
- [ ] **B.** Non, il faut passer un objet vide `{}` explicite pour les valeurs et les classes avant de pouvoir passer un outlet
- [ ] **C.** Ce n'est possible qu'en JavaScript, jamais depuis Twig
- [ ] **D.** Oui, via l'argument nommé `controllerOutlets` seul, ex. `stimulus_controller('hello', controllerOutlets: { 'other': '.target' })`

## La fonction stimulus_action

### Question 31

Que rend `{{ stimulus_action('controller', 'method') }}` sans nom d'événement précisé ? *(une seule bonne réponse)*

- [ ] **A.** `data-action="click->controller#method"` (click étant le défaut implicite pour tous les éléments)
- [ ] **B.** `data-action-controller="method"`
- [ ] **C.** Rien : un nom d'événement est obligatoire
- [ ] **D.** `data-action="controller#method"`

### Question 32

Que rend `{{ stimulus_action('controller', 'method', 'click') }}`, avec le nom d'événement explicite ? *(une seule bonne réponse)*

- [ ] **A.** `data-action="controller.click.method"`
- [ ] **B.** `data-action="click->controller#method"`
- [ ] **C.** `data-action="controller#method@click"`
- [ ] **D.** `data-click-action="controller#method"`

### Question 33

Comment chaîner plusieurs actions sur le même élément avec `stimulus_action()` ? *(une seule bonne réponse)*

- [ ] **A.** En listant les actions séparées par des virgules dans le premier argument
- [ ] **B.** Ce n'est pas possible, un élément ne pouvant déclencher qu'une seule action
- [ ] **C.** En imbriquant les appels à `stimulus_action()` les uns dans les autres
- [ ] **D.** Via le filtre `stimulus_action`, ex. `stimulus_action('controller', 'method')|stimulus_action('other-controller', 'test')`

### Question 34

Comment récupérer les attributs de `stimulus_action()` sous forme de tableau, pour les injecter dans un champ de formulaire Symfony ? *(une seule bonne réponse)*

- [ ] **A.** En castant le résultat avec `(array)` directement dans le template
- [ ] **B.** Via `.toArray()`, ex. dans l'option `attr` de `form_row()`
- [ ] **C.** Ce n'est pas supporté pour `stimulus_action()`, contrairement à `stimulus_controller()`
- [ ] **D.** En appelant `stimulus_action_to_array()`

### Question 35

Comment passer un paramètre (« parameter ») à une action via `stimulus_action()`, et quel attribut cela génère-t-il ? *(une seule bonne réponse)*

- [ ] **A.** En l'ajoutant directement dans le nom de la méthode, ex. `'method(count=3)'`
- [ ] **B.** En quatrième argument sous forme de tableau, ex. `{ 'count': 3 }`, générant `data-hello-controller-count-param="3"`
- [ ] **C.** Via un cinquième argument nommé `params`, générant `data-param-count="3"`
- [ ] **D.** Ce n'est pas possible via la fonction Twig, uniquement en JavaScript

## La fonction stimulus_target

### Question 36

Comment déclarer plusieurs cibles (« targets ») sur un même élément via un seul appel à `stimulus_target()` ? *(une seule bonne réponse)*

- [ ] **A.** En passant un tableau PHP de noms de cibles
- [ ] **B.** Ce n'est pas possible, un seul target étant autorisé par appel
- [ ] **C.** En chaînant deux appels positionnels sans filtre
- [ ] **D.** En les séparant par un espace dans le second argument, ex. `stimulus_target('controller', 'myTarget secondTarget')`

### Question 37

Comment chaîner des cibles de contrôleurs différents sur un même élément ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `stimulus_target()` dans une boucle Twig `for`
- [ ] **B.** Via le filtre `stimulus_target`, ex. `stimulus_target('controller', 'myTarget')|stimulus_target('other-controller', 'anotherTarget')`
- [ ] **C.** En listant tous les contrôleurs dans le premier argument, séparés par une virgule
- [ ] **D.** Ce n'est pas possible, un élément ne pouvant cibler qu'un seul contrôleur

### Question 38

Comme pour `stimulus_controller()` et `stimulus_action()`, quelle méthode permet de récupérer les attributs de `stimulus_target()` sous forme de tableau ? *(une seule bonne réponse)*

- [ ] **A.** `.asArray()`
- [ ] **B.** `.export()`
- [ ] **C.** `.toArray()`
- [ ] **D.** `.toAttributes()`

## Configuration

### Question 39

Avec AssetMapper, quelle option de `config/packages/stimulus.yaml` configure le(s) dossier(s) contenant les contrôleurs ? *(une seule bonne réponse)*

- [ ] **A.** `asset_mapper.controllers`
- [ ] **B.** `controller_paths`
- [ ] **C.** `controllers_directory`
- [ ] **D.** `stimulus_paths`

### Question 40

Quelle est la valeur par défaut de `controllers_json`, le chemin vers le fichier listant les contrôleurs tiers ? *(une seule bonne réponse)*

- [ ] **A.** `'%kernel.project_dir%/config/controllers.json'`
- [ ] **B.** `'%kernel.project_dir%/var/controllers.json'`
- [ ] **C.** Il n'y a pas de valeur par défaut, cette option étant obligatoire
- [ ] **D.** `'%kernel.project_dir%/assets/controllers.json'`

## Détails de l'installation manuelle

### Question 41

Quel fichier démarre l'application Stimulus et charge les contrôleurs, importé depuis `assets/app.js` ? *(une seule bonne réponse)*

- [ ] **A.** `assets/init.js`
- [ ] **B.** `assets/controllers/index.js`
- [ ] **C.** `assets/bootstrap.js`
- [ ] **D.** `assets/stimulus.js`

### Question 42

Que contient au départ le fichier `assets/controllers.json` généré par la recette Flex, avant toute installation de paquet UX ? *(une seule bonne réponse)*

- [ ] **A.** La liste complète de tous les paquets UX officiels disponibles
- [ ] **B.** Un exemple de contrôleur commenté, à décommenter manuellement
- [ ] **C.** Uniquement la configuration TypeScript par défaut
- [ ] **D.** Un fichier (presque) vide, mis à jour automatiquement à chaque installation d'un paquet UX

### Question 43

Que contient par défaut le dossier `assets/controllers/` généré par la recette Flex ? *(une seule bonne réponse)*

- [ ] **A.** Une copie du contrôleur `stimulus-use`
- [ ] **B.** Un fichier d'exemple `hello_controller.js`
- [ ] **C.** Un dossier vide, sans aucun fichier
- [ ] **D.** Un fichier `index.js` listant tous les contrôleurs

### Question 44

Avec AssetMapper, quelles nouvelles entrées la recette Flex ajoute-t-elle à `importmap.php` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `@symfony/stimulus-bundle`, pointant vers `@symfony/stimulus-bundle/loader.js`
- [ ] **B.** `@hotwired/stimulus`, avec un numéro de version
- [ ] **C.** `@symfony/stimulus-bridge`
- [ ] **D.** `@symfony/ux-turbo`

### Question 45

Avec AssetMapper, à quoi ressemble le fichier `assets/bootstrap.js` généré par la recette ? *(une seule bonne réponse)*

- [ ] **A.** Il ne contient qu'un simple `import '@hotwired/stimulus';`, sans appel de fonction
- [ ] **B.** Il nécessite un `require.context()` explicite, identique à Webpack Encore
- [ ] **C.** Il importe `startStimulusApp` depuis `@symfony/stimulus-bundle` et l'appelle pour créer l'app
- [ ] **D.** Il importe `startStimulusApp` depuis `@symfony/stimulus-bridge`, comme avec Encore

### Question 46

Le fichier référencé par l'entrée `@symfony/stimulus-bundle` de l'importmap est-il un fichier statique fixe, et que fait-il ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est un fichier statique livré tel quel dans le paquet npm
- [ ] **B.** Il ne fait que réexporter Stimulus lui-même, sans logique de chargement de contrôleurs
- [ ] **C.** Il est généré une seule fois à l'installation et ne change plus jamais ensuite
- [ ] **D.** Non, il est construit dynamiquement par le bundle pour importer tous les contrôleurs personnalisés et ceux de `controllers.json`, en activant le mode debug si nécessaire

### Question 47

Quelle exception concerne spécifiquement AssetMapper 6.3, contrairement aux versions 6.4 et supérieures ? *(une seule bonne réponse)*

- [ ] **A.** Il faut installer un paquet npm supplémentaire `@symfony/asset-mapper-legacy`
- [ ] **B.** Le mode lazy des contrôleurs n'est pas supporté
- [ ] **C.** Il faut désactiver manuellement le cache OPcache
- [ ] **D.** Il faut ajouter `{{ ux_controller_link_tags() }}` dans `base.html.twig`

### Question 48

Avec Webpack Encore, quelle ligne la recette ajoute-t-elle à `webpack.config.js` ? *(une seule bonne réponse)*

- [ ] **A.** `.addStimulusEntry('./assets/bootstrap.js')`
- [ ] **B.** `.configureStimulusBridge({ lazy: true })`
- [ ] **C.** `.enableStimulusBridge('./assets/controllers.json')`
- [ ] **D.** `.enableStimulusLoader('./assets/controllers/')`

### Question 49

Avec Webpack Encore, à quoi ressemble le fichier `assets/bootstrap.js` généré, comparé à la version AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Il n'importe rien de Stimulus directement, tout étant géré par `webpack.config.js`
- [ ] **B.** Il utilise `startStimulusApp` depuis `@symfony/stimulus-bundle`, comme AssetMapper
- [ ] **C.** Il importe `startStimulusApp` depuis `@symfony/stimulus-bridge` et utilise `require.context()` avec le loader lazy des contrôleurs
- [ ] **D.** Il est strictement identique à la version AssetMapper, seul `importmap.php` différant

### Question 50

Avec Webpack Encore, quels paquets npm sont ajoutés à `package.json` par la recette ? *(une seule bonne réponse)*

- [ ] **A.** `stimulus-use` et `stimulus-components`
- [ ] **B.** Aucun paquet npm n'est ajouté, tout passant par Composer
- [ ] **C.** `@hotwired/stimulus` et `@symfony/stimulus-bridge`
- [ ] **D.** `@symfony/stimulus-bundle` uniquement

### Question 51

Que faut-il exécuter après avoir modifié `webpack.config.js` et `package.json` via la recette Encore, pour que les changements prennent effet ? *(une seule bonne réponse)*

- [ ] **A.** Rien, les changements étant pris en compte à chaud sans redémarrage
- [ ] **B.** Relancer uniquement `composer install`
- [ ] **C.** Vider le cache Symfony avec `cache:clear`
- [ ] **D.** Installer les assets (ex. `npm install`) et redémarrer Encore

## Comment les contrôleurs Stimulus sont-ils chargés ?

### Question 52

Quand on installe un paquet UX PHP, comment Symfony Flex met-il à jour `package.json` (si l'on utilise Webpack Encore) ? *(une seule bonne réponse)*

- [ ] **A.** En téléchargeant réellement le paquet npm correspondant depuis le registre npm
- [ ] **B.** `package.json` n'est jamais modifié automatiquement, même avec Encore
- [ ] **C.** En ajoutant une dépendance Git directe vers le dépôt du paquet UX
- [ ] **D.** En pointant vers un « paquet virtuel » via un chemin `file:vendor/...`, qui référence des fichiers déjà présents dans `vendor/`

### Question 53

`package.json` est-il modifié lors de l'installation d'un paquet UX si l'on utilise AssetMapper ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend uniquement de la version de PHP utilisée
- [ ] **B.** Non, ce n'est ni fait ni nécessaire avec AssetMapper
- [ ] **C.** Oui, exactement de la même façon qu'avec Webpack Encore
- [ ] **D.** Oui, mais uniquement pour ajouter la version de Node.js requise

### Question 54

Dans `assets/controllers.json`, à quoi correspondent les clés `enabled` et `fetch` d'un contrôleur déclaré ? *(une seule bonne réponse)*

- [ ] **A.** Elles ne concernent que les contrôleurs personnalisés, jamais ceux d'un paquet UX
- [ ] **B.** `enabled` active ou désactive le contrôleur, `fetch` définit son mode de chargement (ex. `eager`)
- [ ] **C.** `enabled` définit le mode de chargement, `fetch` active ou désactive le contrôleur
- [ ] **D.** Ce sont des clés obsolètes, remplacées par `active` et `loading` dans les versions récentes

### Question 55

Que fait automatiquement `assets/bootstrap.js`, une fois la recette installée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Enregistrer tous les fichiers de `assets/controllers/` comme contrôleurs Stimulus
- [ ] **B.** Enregistrer tous les contrôleurs décrits dans `assets/controllers.json`
- [ ] **C.** Compiler automatiquement le CSS associé à chaque contrôleur
- [ ] **D.** Supprimer les contrôleurs non utilisés du bundle final

### Question 56

Avec quel outil `bootstrap.js` travaille-t-il en partenariat si l'on utilise Webpack Encore, par opposition à AssetMapper qui passe directement par ce bundle ? *(une seule bonne réponse)*

- [ ] **A.** `webpack-stimulus-loader`
- [ ] **B.** `@symfony/stimulus-bridge`
- [ ] **C.** `@symfony/stimulus-bundle`
- [ ] **D.** `stimulus-use`

### Question 57

Un contrôleur nommé techniquement `@symfony/ux-chartjs/chart` devient quel nom Stimulus final, et comment passer le nom original malgré tout à `stimulus_controller()` ? *(une seule bonne réponse)*

- [ ] **A.** `chartjs` seul, le préfixe du paquet étant toujours supprimé
- [ ] **B.** `ChartjsController` ; il faut toujours utiliser le nom de classe PHP complet
- [ ] **C.** `symfony--ux-chartjs--chart` ; on peut passer le nom original (`@symfony/ux-chartjs/chart`) à `stimulus_controller()`, qui le normalise automatiquement
- [ ] **D.** `symfony_ux_chartjs_chart` ; le nom original ne peut jamais être utilisé directement dans Twig

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [documentation StimulusBundle](https://symfony.com/bundles/StimulusBundle/current/index.html), qui vit dans le dépôt `symfony/ux` (et non `symfony-docs`).

**Question 1 : A, B** — « This bundle adds integration between Symfony, Stimulus and the Symfony UX packages: Twig `stimulus_` functions & filters (…) Integration to load UX Packages » *(§ StimulusBundle: Symfony integration with Stimulus)*

**Question 2 : C** — « Check out live demos of Symfony UX at https://ux.symfony.com! » *(§ StimulusBundle: Symfony integration with Stimulus)*

**Question 3 : A, B** — « choose and install an asset handling system; both work great with StimulusBundle: AssetMapper (…) or Webpack Encore » *(§ Installation)*

**Question 4 : C** — « `$ composer require symfony/stimulus-bundle` » *(§ Installation)*

**Question 5 : D** — « If you're using Symfony Flex, you're done! The recipe will update the necessary files. » *(§ Installation)*

**Question 6 : D** — « If you're using Encore, be sure to install your assets (e.g. `npm install`) and restart Encore. » *(§ Installation)*

**Question 7 : B** — « You can now create custom Stimulus controllers inside of the `assets/controllers` directory. In fact, you should have an example controller there already: `hello_controller.js` » *(§ Usage)*

**Question 8 : B** — « Then, activate the controller in your HTML: `<div data-controller="hello">` » *(§ Usage)*

**Question 9 : D** — « `{{ stimulus_controller('hello') }}` (…) would render `<div data-controller="hello">` » *(§ Usage)*

**Question 10 : C** — « Install and set up the `sensiolabs/typescript-bundle`. » *(§ TypeScript Controllers)*

**Question 11 : C** — « be sure to add the `assets/controllers` path to the `sensiolabs_typescript.source_dir` configuration. » *(§ TypeScript Controllers)*

**Question 12 : D** — « StimulusBundle activates any 3rd party Stimulus controllers that are mentioned in your `assets/controllers.json` file. This file is updated whenever you install a UX package. » *(§ The UX Packages)*

**Question 13 : B** — « Check out the official UX packages » — https://ux.symfony.com/packages *(§ The UX Packages)*

**Question 14 : C** — « By default, all of your controllers (…) will be downloaded and loaded on every page. » *(§ Lazy Stimulus Controllers)*

**Question 15 : B** — « will *not* be downloaded on initial page load. Instead, as soon as an element appears on the page matching the controller (…) the controller (…) will be lazily-loaded via Ajax. » *(§ Lazy Stimulus Controllers)*

**Question 16 : D** — « To make one of your custom controllers lazy, add a special comment on top: `/* stimulusFetch: 'lazy' */` » *(§ Lazy Stimulus Controllers)*

**Question 17 : D** — « To make a third-party controller lazy, in `assets/controllers.json`, set `fetch` to `lazy`. » *(§ Lazy Stimulus Controllers)*

**Question 18 : D** — « If you write your controllers using TypeScript and you're using StimulusBundle 2.21.0 or earlier, make sure `removeComments` is not set to `true` in your TypeScript config. » *(§ Lazy Stimulus Controllers)*

**Question 19 : C** — « `stimulus-use`: Add composable behaviors to your Stimulus controllers, like debouncing, detecting outside clicks and many other things. » *(§ Stimulus Tools around the World)*

**Question 20 : C** — « `stimulus-components` A large number of pre-made Stimulus controllers, like for Copying to clipboard, Sortable, Popover (…) and much more. » *(§ Stimulus Tools around the World)*

**Question 21 : B** — « Though this bundle provides these helpful Twig functions/filters, it's recommended to use raw data attributes instead, as they're straightforward. » *(§ Stimulus Twig Helpers)*

**Question 22 : C** — « If you use PhpStorm IDE - you may want to install Stimulus plugin to get nice auto-completion for the attributes. » *(§ Stimulus Twig Helpers)*

**Question 23 : D** — « would render: `data-controller="hello" data-hello-name-value="World" data-hello-data-value="..."` » *(§ stimulus_controller)*

**Question 24 : C** — « Any non-scalar values (like `data: [1, 2, 3, 4]`) are JSON-encoded. And all values are properly escaped (the string `&#x5B;` is an escaped `[` character (…)) » *(§ stimulus_controller)*

**Question 25 : C** — « or without values: `{{ stimulus_controller('hello', controllerClasses: { 'loading': 'spinner' }) }}` » *(§ stimulus_controller)*

**Question 26 : D** — « or without values/classes: `{{ stimulus_controller('hello', controllerOutlets: { 'other': '.target' }) }}` » *(§ stimulus_controller)*

**Question 27 : C** — « If you have multiple controllers on the same element, you can chain them as there's also a `stimulus_controller` filter » *(§ stimulus_controller)*

**Question 28 : B** — « You can also retrieve the generated attributes as an array, which can be helpful e.g. for forms: `{{ form_start(form, { attr: stimulus_controller('hello', { 'name': 'World' }).toArray() }) }}` » *(§ stimulus_controller)*

**Question 29 : D** — « Stimulus Controllers can also reference other controllers by using Outlets. » *(§ stimulus_controller)*

**Question 30 : D** — « or without values/classes: `{{ stimulus_controller('hello', controllerOutlets: { 'other': '.target' }) }}` » *(§ stimulus_controller)*

**Question 31 : D** — « `<div {{ stimulus_action('controller', 'method') }}>Hello</div>` (…) would render `<div data-action="controller#method">Hello</div>` » *(§ stimulus_action)*

**Question 32 : B** — « `<div {{ stimulus_action('controller', 'method', 'click') }}>Hello</div>` (…) would render `<div data-action="click->controller#method">Hello</div>` » *(§ stimulus_action)*

**Question 33 : D** — « If you have multiple actions and/or methods on the same element, you can chain them as there's also a `stimulus_action` filter » *(§ stimulus_action)*

**Question 34 : B** — « You can also retrieve the generated attributes as an array (…): `{{ form_row(form.password, { attr: stimulus_action('hello-controller', 'checkPasswordStrength').toArray() }) }}` » *(§ stimulus_action)*

**Question 35 : B** — « `<div {{ stimulus_action('hello-controller', 'method', 'click', { 'count': 3 }) }}>Hello</div>` would render `<div data-action="click->hello-controller#method" data-hello-controller-count-param="3">Hello</div>` » *(§ stimulus_action)*

**Question 36 : D** — « `<div {{ stimulus_target('controller', 'myTarget secondTarget') }}>Hello</div>` (…) would render `<div data-controller-target="myTarget secondTarget">Hello</div>` » *(§ stimulus_target)*

**Question 37 : B** — « If you have multiple targets on the same element, you can chain them as there's also a `stimulus_target` filter » *(§ stimulus_target)*

**Question 38 : C** — « You can also retrieve the generated attributes as an array (…): `{{ form_row(form.password, { attr: stimulus_target('hello-controller', 'myTarget').toArray() }) }}` » *(§ stimulus_target)*

**Question 39 : B** — « `stimulus: controller_paths: - '%kernel.project_dir%/assets/controllers'` » *(§ Configuration)*

**Question 40 : D** — « `controllers_json: '%kernel.project_dir%/assets/controllers.json'` » *(§ Configuration)*

**Question 41 : C** — « `assets/bootstrap.js` starts the Stimulus application and loads your controllers. It's imported by `assets/app.js` » *(§ Manual Installation Details)*

**Question 42 : D** — « `assets/controllers.json` This file starts (mostly) empty and is automatically updated as your install UX packages that provide Stimulus controllers. » *(§ Manual Installation Details)*

**Question 43 : B** — « `assets/controllers/` This directory is where you should put your custom Stimulus controllers. It comes with one example `hello_controller.js` file. » *(§ Manual Installation Details)*

**Question 44 : A, B** — « two new entries will be added to your `importmap.php` file: `'@symfony/stimulus-bundle' => ['path' => '@symfony/stimulus-bundle/loader.js']`, `'@hotwired/stimulus' => ['version' => '3.2.2']` » *(§ With AssetMapper)*

**Question 45 : C** — « The recipe will update your `assets/bootstrap.js` file to look like this: `import { startStimulusApp } from '@symfony/stimulus-bundle'; const app = startStimulusApp();` » *(§ With AssetMapper)*

**Question 46 : D** — « This file is dynamically built by the bundle and will import all your custom controllers as well as those from `controllers.json`. It will also dynamically enable "debug" mode in Stimulus when your application is running in debug mode. » *(§ With AssetMapper)*

**Question 47 : D** — « For AssetMapper 6.3 only, you also need a `{{ ux_controller_link_tags() }}` in `base.html.twig`. This is not needed in AssetMapper 6.4+. » *(§ With AssetMapper)*

**Question 48 : C** — « the recipe will also update your `webpack.config.js` file to include this line: `.enableStimulusBridge('./assets/controllers.json')` » *(§ With WebpackEncoreBundle)*

**Question 49 : C** — « `import { startStimulusApp } from '@symfony/stimulus-bridge'; export const app = startStimulusApp(require.context('@symfony/stimulus-bridge/lazy-controller-loader!./controllers', ...))` » *(§ With WebpackEncoreBundle)*

**Question 50 : C** — « And 2 new packages - `@hotwired/stimulus` and `@symfony/stimulus-bridge` - will be added to your `package.json` file. » *(§ With WebpackEncoreBundle)*

**Question 51 : D** — « If you're using Encore, be sure to install your assets (e.g. `npm install`) and restart Encore. » *(§ Installation)*

**Question 52 : D** — « Symfony Flex will automatically update your `package.json` file (…) to point to a "virtual package" that lives inside that PHP package. (…) `"@symfony/ux-chartjs": "file:vendor/symfony/ux-chartjs/assets"` » *(§ How are the Stimulus Controllers Loaded?)*

**Question 53 : B** — « Symfony Flex will automatically update your `package.json` file (not done or needed if using AssetMapper) » *(§ How are the Stimulus Controllers Loaded?)*

**Question 54 : B** — « `"chart": { "enabled": true, "fetch": "eager" }` » — `enabled` active/désactive le contrôleur, `fetch` définit son mode de chargement. *(§ How are the Stimulus Controllers Loaded?)*

**Question 55 : A, B** — « your `assets/bootstrap.js` file will automatically register: All files in `assets/controllers/` as Stimulus controllers; And all controllers described in `assets/controllers.json` as Stimulus controllers. » *(§ How are the Stimulus Controllers Loaded?)*

**Question 56 : B** — « If you're using WebpackEncore, the `bootstrap.js` file works in partnership with `@symfony/stimulus-bridge`. With AssetMapper, the `bootstrap.js` file works directly with this bundle » *(§ How are the Stimulus Controllers Loaded?)*

**Question 57 : C** — « it will be called `symfony--ux-chartjs--chart`. However, you can pass the original name into the `{{ stimulus_controller() }}` function (…) and it will normalize it » *(§ How are the Stimulus Controllers Loaded?)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » / toctree annexe : pas de pages annexes à couvrir pour ce QCM.
