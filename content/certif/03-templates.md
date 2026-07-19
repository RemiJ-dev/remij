# QCM — Les templates Symfony (Twig)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/templates.html](https://symfony.com/doc/8.0/templates.html) (questions 1 à 60) et la [documentation Twig 3.x](https://twig.symfony.com/doc/3.x/) (questions 61 à 90) · **Généré le :** 18 juillet 2026 · **Complété le :** 19 juillet 2026
>
> **90 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Le langage Twig

### Question 1

Quelle est la bonne commande pour installer Twig et son intégration Symfony dans une application utilisant Flex ? *(une seule bonne réponse)*

- [ ] **A.** `composer require twig/twig`
- [ ] **B.** `composer require symfony/twig-bundle`
- [ ] **C.** `composer require symfony/templating`
- [ ] **D.** `composer require twig`

### Question 2

Quelles sont les constructions de base de la syntaxe Twig ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{{ ... }}` — afficher le contenu d'une variable ou le résultat d'une expression
- [ ] **B.** `{% ... %}` — exécuter de la logique (condition, boucle…)
- [ ] **C.** `{# ... #}` — ajouter des commentaires
- [ ] **D.** `{! ... !}` — désactiver l'échappement

### Question 3

Que deviennent les commentaires Twig `{# ... #}` dans la page rendue ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont convertis en commentaires HTML `<!-- ... -->`
- [ ] **B.** Ils sont inclus uniquement dans l'environnement `dev`
- [ ] **C.** Ils ne sont pas inclus dans la page rendue, contrairement aux commentaires HTML
- [ ] **D.** Ils provoquent une erreur de syntaxe en production

### Question 4

Peut-on exécuter du code PHP dans un template Twig ? *(une seule bonne réponse)*

- [ ] **A.** Oui, avec le tag `{% php %} ... {% endphp %}`
- [ ] **B.** Oui, mais uniquement en environnement de production
- [ ] **C.** Oui, en activant une option de configuration dédiée
- [ ] **D.** Non — Twig fournit ses propres utilitaires (filtres, fonctions, tags) pour exécuter de la logique

### Question 5

Quelles affirmations sur les performances de Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** En `prod`, les templates sont compilés en PHP et mis en cache automatiquement
- [ ] **B.** En `dev`, les templates sont recompilés automatiquement quand on les modifie
- [ ] **C.** En `dev`, il faut vider le cache manuellement après chaque modification de template
- [ ] **D.** En `prod`, les templates sont interprétés à chaque requête

### Question 6

Que fait `{{ title|upper }}` ? *(une seule bonne réponse)*

- [ ] **A.** Il applique le filtre `upper` : le contenu de `title` est mis en majuscules avant affichage
- [ ] **B.** Il appelle la méthode `upper()` de l'objet `title`
- [ ] **C.** Il déclare une variable `upper` initialisée avec `title`
- [ ] **D.** Il force l'échappement de la variable `title`

### Question 7

Quelle convention de nommage Twig recommande-t-il pour les variables passées aux templates ? *(une seule bonne réponse)*

- [ ] **A.** `camelCase` : `fooBar`
- [ ] **B.** `snake_case` : `foo_bar`
- [ ] **C.** `PascalCase` : `FooBar`
- [ ] **D.** `kebab-case` : `foo-bar`

## Création, nommage et emplacement

### Question 8

Quelles recommandations de Symfony pour nommer les templates sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Utiliser le snake case pour les noms de fichiers et de dossiers (ex. `blog_posts.html.twig`)
- [ ] **B.** L'extension `.twig` est optionnelle
- [ ] **C.** Définir deux extensions pour les noms de fichiers (ex. `index.html.twig`)
- [ ] **D.** La première extension (`html`, `xml`…) est le format final que le template va générer

### Question 9

Dans quel répertoire les templates sont-ils stockés par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `templates/` à la racine du projet
- [ ] **B.** `src/Resources/views/`
- [ ] **C.** `app/views/`
- [ ] **D.** `public/templates/`

### Question 10

Dans `$this->render('user/notifications.html.twig', [...])`, à quoi le chemin du template est-il relatif ? *(une seule bonne réponse)*

- [ ] **A.** À la racine du projet
- [ ] **B.** Au répertoire du contrôleur qui effectue le rendu
- [ ] **C.** Au répertoire `templates/`
- [ ] **D.** Au répertoire `public/`

### Question 11

Quelle option de configuration permet de changer le répertoire de templates par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `twig.template_dir`
- [ ] **B.** `framework.templates.path`
- [ ] **C.** `twig.default_path`
- [ ] **D.** `twig.root_path`

## Les variables dans les templates

### Question 12

Avec la notation `foo.bar`, quel accès Twig essaie-t-il **en premier** ? *(une seule bonne réponse)*

- [ ] **A.** `$foo->getBar()` (getter)
- [ ] **B.** `$foo['bar']` (tableau et élément)
- [ ] **C.** `$foo->bar` (propriété publique)
- [ ] **D.** `$foo->bar()` (méthode publique)

### Question 13

Avec `foo.bar`, aucun des accès essayés par Twig n'existe (ni clé de tableau, ni propriété, ni méthode `bar()`/`getBar()`/`isBar()`/`hasBar()`). Que se passe-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, la valeur `null` est utilisée
- [ ] **B.** Si l'option `strict_variables` est activée, une exception `Twig\Error\RuntimeError` est levée
- [ ] **C.** Une exception est toujours levée, quelle que soit la configuration
- [ ] **D.** La chaîne vide `''` est utilisée

## Générer des liens et référencer des assets

### Question 14

Que fait la fonction Twig `path('blog_post', {slug: post.slug})` ? *(une seule bonne réponse)*

- [ ] **A.** Elle génère une URL absolue incluant le scheme et le host
- [ ] **B.** Elle inclut le template associé à la route `blog_post`
- [ ] **C.** Elle vérifie seulement que la route `blog_post` existe
- [ ] **D.** Elle génère l'URL relative de la route à partir de son nom et de ses paramètres

### Question 15

Vous générez un template pour un email ou un flux RSS et il vous faut des URLs absolues. Quelle fonction utiliser ? *(une seule bonne réponse)*

- [ ] **A.** `url()`, qui prend les mêmes arguments que `path()`
- [ ] **B.** `path()` avec l'option `{absolute: true}`
- [ ] **C.** `absolute_path()`
- [ ] **D.** `link()`

### Question 16

Quelles affirmations sur la fonction `asset()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle gère le versioning des assets (hash ajouté aux URLs pour le cache busting)
- [ ] **B.** Elle nécessite d'installer le paquet `symfony/asset`
- [ ] **C.** Elle génère toujours des URLs absolues
- [ ] **D.** Elle rend l'application portable : le chemin généré s'adapte si l'app est hébergée dans un sous-répertoire

### Question 17

Comment obtenir l'URL **absolue** d'un asset ? *(une seule bonne réponse)*

- [ ] **A.** `{{ asset('images/logo.png', absolute: true) }}`
- [ ] **B.** `{{ url(asset('images/logo.png')) }}`
- [ ] **C.** `{{ asset_url('images/logo.png') }}`
- [ ] **D.** `{{ absolute_url(asset('images/logo.png')) }}`

## La variable app et les variables globales

### Question 18

Quelles propriétés la variable globale `app` expose-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `app.request` — l'objet `Request` courant
- [ ] **B.** `app.container` — le container de services
- [ ] **C.** `app.user` — l'utilisateur courant, ou `null` s'il n'est pas authentifié
- [ ] **D.** `app.flashes` — les messages flash stockés en session

### Question 19

De quelle classe la variable `app` est-elle une instance ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Bridge\Twig\AppVariable`
- [ ] **B.** `Twig\AppVariable`
- [ ] **C.** `Symfony\Component\Twig\GlobalVariables`
- [ ] **D.** `Symfony\Bundle\TwigBundle\AppGlobals`

### Question 20

Quelles autres propriétés de `app` existent ? *(plusieurs bonnes réponses)*

- [ ] **A.** `app.kernel` — l'instance du kernel Symfony
- [ ] **B.** `app.environment` — le nom de l'environnement courant (`dev`, `prod`…)
- [ ] **C.** `app.debug` — `true` en mode debug
- [ ] **D.** `app.current_route` — le nom de la route courante

### Question 21

Quelles affirmations sur les variables globales définies dans `twig.globals` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elles sont injectées automatiquement dans tous les templates Twig
- [ ] **B.** Un service se référence en préfixant son id par `@` : `uuid: '@App\Generator\UuidGenerator'`
- [ ] **C.** Les services référencés sont chargés en lazy : ils ne sont instanciés que si la variable est utilisée
- [ ] **D.** Elles peuvent contenir des valeurs statiques, ex. `ga_tracking: 'UA-xxxxx-x'`

## Réutiliser des contenus : include et héritage

### Question 22

Que signifie le préfixe `_` dans un nom de template comme `blog/_user_profile.html.twig` ? *(une seule bonne réponse)*

- [ ] **A.** Il rend le template privé : impossible de le rendre directement depuis un contrôleur
- [ ] **B.** C'est une convention **optionnelle** pour distinguer les fragments des templates complets
- [ ] **C.** Il exclut le template de la compilation en production
- [ ] **D.** Il est obligatoire pour pouvoir utiliser le template avec `include()`

### Question 23

Quelles affirmations sur la fonction `include()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le template inclus a accès à toutes les variables du template qui l'inclut
- [ ] **B.** Ce comportement se contrôle avec l'option `with_context`
- [ ] **C.** On peut passer (et donc renommer) des variables : `{{ include('blog/_user_profile.html.twig', {user: blog_post.author}) }}`
- [ ] **D.** Les variables du template parent doivent être re-déclarées une à une, sinon une erreur est levée

### Question 24

Quels sont les trois niveaux d'héritage de templates que Symfony recommande pour les applications moyennes et complexes ? *(une seule bonne réponse)*

- [ ] **A.** `header.html.twig` → `body.html.twig` → `footer.html.twig`
- [ ] **B.** `base.html.twig` → les templates des bundles → les pages de l'application
- [ ] **C.** `base.html.twig` (éléments communs) → `layout.html.twig` (structure du contenu) → les pages de l'application
- [ ] **D.** `base.html.twig` → `base.xml.twig` → `base.txt.twig`

### Question 25

Quelles affirmations sur les blocks Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le tag `{% block %}` définit les sections qu'un template enfant peut surcharger
- [ ] **B.** Un template enfant doit surcharger **tous** les blocks définis par son parent
- [ ] **C.** Un block peut être vide, comme `{% block content %}{% endblock %}`
- [ ] **D.** Un block peut définir un contenu par défaut, affiché quand les enfants ne le surchargent pas

### Question 26

Dans un template qui utilise `{% extends %}`, que se passe-t-il si du contenu est défini **en dehors** d'un block ? *(une seule bonne réponse)*

- [ ] **A.** Le contenu est ignoré silencieusement
- [ ] **B.** Le contenu est affiché avant le layout
- [ ] **C.** Twig lève une `SyntaxError`
- [ ] **D.** Le contenu est injecté automatiquement dans le block `body`

### Question 27

Selon la documentation, quelle est la méthode **recommandée** pour rendre et réutiliser de petits fragments de template (une alerte, une modale, une sidebar…) ? *(une seule bonne réponse)*

- [ ] **A.** La fonction `include()`
- [ ] **B.** L'embedding de contrôleurs avec `render(controller(...))`
- [ ] **C.** La librairie `hinclude.js`
- [ ] **D.** Les Twig Components

### Question 28

Quelles affirmations sur les Twig Components sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ils s'utilisent avec une syntaxe de type balise HTML : `<twig:RecentArticles max="3"/>`
- [ ] **B.** Chaque composant associe un template à une « classe composant » optionnelle qui porte la logique
- [ ] **C.** Ils sont fournis nativement par Twig, sans dépendance supplémentaire
- [ ] **D.** Ils peuvent devenir « live » : se re-rendre via Ajax quand l'utilisateur interagit

## Embarquer des contrôleurs et contenus asynchrones

### Question 29

Quelles sont les bonnes méthodes parmi celles-ci pour embarquer le résultat d'un contrôleur dans un template ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{{ render(path('latest_articles', {max: 3})) }}` — si le contrôleur est associé à une route
- [ ] **B.** `{{ render(controller('App\\Controller\\BlogController::recentArticles', {max: 3})) }}` — sans exposer d'URL publique
- [ ] **C.** Avec `controller()`, configurer l'URL spéciale des fragments : `framework: { fragments: { path: /_fragment } }`
- [ ] **D.** L'embedding de contrôleurs n'a aucun impact sur les performances

### Question 30

Dans quel cas l'embedding de contrôleur reste-t-il pertinent face aux Twig Components ? *(une seule bonne réponse)*

- [ ] **A.** Quand on a spécifiquement besoin d'exécuter le contrôleur comme une sous-requête, par exemple pour cacher ce fragment séparément avec ESI
- [ ] **B.** Quand le fragment a besoin de recevoir des props
- [ ] **C.** Quand le fragment doit se mettre à jour via Ajax
- [ ] **D.** Quand le fragment est utilisé dans plus de deux templates

### Question 31

Quelles affirmations sur `hinclude.js` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** C'est la technique moderne recommandée en Symfony 8.0 pour le contenu asynchrone
- [ ] **B.** On l'utilise avec `{{ render_hinclude(controller('...')) }}` ou `{{ render_hinclude(url('...')) }}`
- [ ] **C.** Un contenu par défaut peut être défini globalement via `framework.fragments.hinclude_default_template`, ou par appel via l'option `default`
- [ ] **D.** Par défaut, le JavaScript inclus dans les contenus chargés n'est pas exécuté ; l'attribut `evaljs: 'true'` l'active

## Rendre un template

### Question 32

Quelles affirmations sur `render()` et `renderView()` (dans un contrôleur) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `render()` retourne un objet `Response` contenant le rendu du template
- [ ] **B.** `renderView()` retourne uniquement le contenu produit par le template
- [ ] **C.** `render()` affiche directement le contenu, sans valeur de retour
- [ ] **D.** `renderView()` est utile pour construire soi-même l'objet `Response` ensuite

### Question 33

Avec l'attribut `#[Template('product/index.html.twig')]` sur une action, que doit retourner cette action ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `Response` construit avec `$this->render()`
- [ ] **B.** Un tableau des paramètres à passer au template — l'attribut se charge de créer la `Response`
- [ ] **C.** Le nom du template sous forme de chaîne
- [ ] **D.** Rien : l'attribut rend le template sans données

### Question 34

Quel est le FQCN de l'attribut `#[Template]` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\HttpKernel\Attribute\Template`
- [ ] **B.** `Twig\Attribute\Template`
- [ ] **C.** `Symfony\Bundle\FrameworkBundle\Attribute\Template`
- [ ] **D.** `Symfony\Bridge\Twig\Attribute\Template`

### Question 35

Quelles affirmations sur le rendu de blocks individuels sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$this->renderBlock('product/index.html.twig', 'price_block', [...])` retourne une `Response` avec le contenu du block
- [ ] **B.** `$this->renderBlockView(...)` retourne uniquement le contenu du block
- [ ] **C.** L'attribut permet aussi de cibler un block : `#[Template('product.html.twig', block: 'price_block')]`
- [ ] **D.** C'est utile avec l'héritage de templates ou les Turbo Streams

### Question 36

Comment rendre un template dans un service (hors contrôleur) ? *(une seule bonne réponse)*

- [ ] **A.** Injecter `Twig\Environment` (le service `twig`) et appeler sa méthode `render()`
- [ ] **B.** Faire hériter le service d'`AbstractController`
- [ ] **C.** Injecter `TemplateRendererInterface`
- [ ] **D.** Utiliser la façade statique `Twig::render()`

### Question 37

Quelles affirmations sur `TemplateController` (rendu direct depuis une route) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il permet de rendre des pages statiques sans écrire de contrôleur, directement depuis la définition de la route
- [ ] **B.** Le default `template` définit le template à rendre, et `statusCode` le code HTTP (200 par défaut)
- [ ] **C.** Les defaults `maxAge`, `sharedAge` et `private` contrôlent le cache de la page
- [ ] **D.** Le default `context` permet de passer des variables au template

### Question 38

Comment vérifier qu'un template existe avant de le rendre ? *(une seule bonne réponse)*

- [ ] **A.** `$twig->templateExists('theme/layout_responsive.html.twig')`
- [ ] **B.** `file_exists('templates/theme/layout_responsive.html.twig')`
- [ ] **C.** `$twig->getLoader()->exists('theme/layout_responsive.html.twig')`
- [ ] **D.** Tenter le rendu et attraper l'exception `TemplateNotFoundException`

## Déboguer les templates

### Question 39

Quelles affirmations sur la commande `lint:twig` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle vérifie que les templates ne contiennent pas d'erreurs de syntaxe
- [ ] **B.** Elle corrige automatiquement les erreurs qu'elle détecte
- [ ] **C.** `--show-deprecations` affiche les fonctionnalités dépréciées utilisées dans les templates
- [ ] **D.** `--excludes=data_collector` permet d'exclure des répertoires de l'analyse

### Question 40

Comment obtenir la sortie de `lint:twig` au format attendu par GitHub ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `--output=github-actions`
- [ ] **B.** La sortie est adaptée automatiquement quand le linter tourne dans GitHub Actions ; on peut aussi forcer `--format=github`
- [ ] **C.** En définissant la variable d'environnement `GITHUB_FORMAT=1`
- [ ] **D.** Ce n'est pas possible : il faut un reformateur externe

### Question 41

Quelles affirmations sur la commande `debug:twig` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle liste les informations disponibles sur Twig : fonctions, filtres, variables globales…
- [ ] **B.** `--filter=date` filtre la sortie par mot-clé
- [ ] **C.** Elle exécute les templates pour détecter les erreurs d'exécution
- [ ] **D.** En lui passant un chemin de template (ex. `@Twig/Exception/error.html.twig`), elle affiche le fichier physique qui sera chargé

### Question 42

Quelle est la différence entre le tag `{% dump articles %}` et la fonction `{{ dump(article) }}` ? *(une seule bonne réponse)*

- [ ] **A.** Le tag envoie le contenu vers la Web Debug Toolbar ; la fonction dumpe le contenu dans la page
- [ ] **B.** Le tag dumpe dans la page ; la fonction envoie vers la Web Debug Toolbar
- [ ] **C.** Aucune : ce sont deux syntaxes équivalentes
- [ ] **D.** Le tag fonctionne en production, pas la fonction

### Question 43

Quelles affirmations sur les utilitaires `dump` de Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** En production, `dump()` est ignoré silencieusement
- [ ] **B.** Il faut d'abord installer le VarDumper : `composer require --dev symfony/debug-bundle`
- [ ] **C.** Les arguments nommés servent de labels : `{{ dump(blog_posts: articles, user: app.user) }}`
- [ ] **D.** `dump()` n'est disponible que dans les environnements `dev` et `test`

## Échappement de sortie et XSS

### Question 44

Pourquoi les applications Symfony sont-elles protégées par défaut contre les attaques XSS dans les templates ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Twig supprime toutes les balises `<script>` du contenu affiché
- [ ] **B.** Parce que Twig applique automatiquement l'échappement de sortie (« output escaping »)
- [ ] **C.** Parce qu'un pare-feu applicatif filtre les entrées utilisateur
- [ ] **D.** Parce que les variables sont validées par le composant Validator avant affichage

### Question 45

Une variable de confiance contient du HTML à afficher tel quel. Quelle est la bonne solution ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver l'échappement globalement dans `twig.yaml`
- [ ] **B.** Utiliser `{{ product.title|escape('html') }}`
- [ ] **C.** Encadrer l'affichage avec `{% verbatim %}`
- [ ] **D.** Utiliser le filtre `raw` : `{{ product.title|raw }}`

### Question 46

`{{ name }}` est rendu avec `name` valant `<script>alert('hello!')</script>`. Qu'affiche Twig ? *(une seule bonne réponse)*

- [ ] **A.** Rien : la valeur est rejetée
- [ ] **B.** Le script est exécuté par le navigateur
- [ ] **C.** La chaîne échappée : `&lt;script&gt;alert(&#39;hello!&#39;)&lt;/script&gt;`
- [ ] **D.** La valeur avec les balises supprimées : `alert('hello!')`

### Question 47

En Symfony 8.0, quelles sont les bonnes méthodes documentées pour désactiver l'échappement de sortie ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le filtre `raw` sur une variable précise
- [ ] **B.** La désactivation pour un block ou un template entier (documentation d'échappement de Twig)
- [ ] **C.** Le tag de service `twig.safe_class` sur une classe de value object
- [ ] **D.** Aucune désactivation n'est nécessaire pour les variables contenant du HTML valide

## Namespaces de templates

### Question 48

Comment référencer le template `layout.html.twig` du namespace `admin` ? *(une seule bonne réponse)*

- [ ] **A.** `@admin/layout.html.twig`
- [ ] **B.** `admin:layout.html.twig`
- [ ] **C.** `admin::layout.html.twig`
- [ ] **D.** `#admin/layout.html.twig`

### Question 49

Quelles affirmations sur l'option `twig.paths` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Chaque entrée est une paire `clé: valeur` où la clé est le répertoire et la valeur le namespace
- [ ] **B.** Les répertoires sont relatifs à la racine du projet (les chemins absolus sont aussi acceptés)
- [ ] **C.** Un répertoire déclaré **sans** namespace est consulté avant le répertoire par défaut `templates/`
- [ ] **D.** Le répertoire par défaut `templates/` est toujours consulté en premier

### Question 50

Un même namespace Twig peut-il être associé à plusieurs répertoires ? *(une seule bonne réponse)*

- [ ] **A.** Non, un namespace correspond à exactement un répertoire
- [ ] **B.** Oui, et les répertoires sont fusionnés sans ordre particulier
- [ ] **C.** Oui, mais uniquement pour les bundles
- [ ] **D.** Oui — l'ordre de déclaration compte : Twig cherche les templates à partir du premier chemin défini

### Question 51

Le bundle `AcmeBlogBundle` fournit le template `vendor/acme/blog-bundle/templates/user/profile.html.twig`. Comment le référencer ? *(une seule bonne réponse)*

- [ ] **A.** `@AcmeBlogBundle/user/profile.html.twig`
- [ ] **B.** `bundles/acme_blog/user/profile.html.twig`
- [ ] **C.** `@AcmeBlog/user/profile.html.twig`
- [ ] **D.** `AcmeBlog:user:profile.html.twig`

## Écrire une extension Twig

### Question 52

En Symfony 8.0, quelle est la bonne méthode « moderne » pour créer un filtre Twig personnalisé `price` ? *(une seule bonne réponse)*

- [ ] **A.** Hériter d'`AbstractExtension` et déclarer le filtre dans `getFilters()` — c'est la seule méthode possible
- [ ] **B.** Ajouter l'attribut `#[AsTwigFilter('price')]` sur une méthode d'une classe PHP ordinaire
- [ ] **C.** Déclarer le filtre dans `config/packages/twig.yaml` sous la clé `filters:`
- [ ] **D.** Implémenter `TwigFilterInterface`

### Question 53

Et pour créer une **fonction** Twig personnalisée plutôt qu'un filtre ? *(une seule bonne réponse)*

- [ ] **A.** `#[TwigCallback('area')]`
- [ ] **B.** `#[AsTwigHelper('area')]`
- [ ] **C.** L'attribut `#[AsTwigFunction('area')]` sur la méthode
- [ ] **D.** Les fonctions personnalisées n'existent pas, seuls les filtres sont extensibles

### Question 54

De quel namespace viennent les attributs `AsTwigFilter` et `AsTwigFunction` ? *(une seule bonne réponse)*

- [ ] **A.** `Twig\Attribute\` — ils sont fournis par Twig lui-même
- [ ] **B.** `Symfony\Bridge\Twig\Attribute\`
- [ ] **C.** `Symfony\Component\Twig\Attribute\`
- [ ] **D.** `Symfony\Bundle\TwigBundle\Attribute\`

### Question 55

Avant d'écrire sa propre extension Twig, la documentation recommande de vérifier si le filtre ou la fonction n'existe pas déjà. Où ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans les filtres et fonctions par défaut de Twig
- [ ] **B.** Dans les filtres et fonctions ajoutés par Symfony
- [ ] **C.** Dans les extensions Twig officielles (strings, HTML, Markdown, internationalisation…)
- [ ] **D.** Dans le code source du `CoreExtension` de Twig, à modifier directement

### Question 56

Sans la configuration `services.yaml` par défaut (pas d'autoconfiguration), quel tag faut-il ajouter au service d'une classe utilisant `#[AsTwigFilter]` ? *(une seule bonne réponse)*

- [ ] **A.** `twig.extension`
- [ ] **B.** `twig.attribute_extension`
- [ ] **C.** `twig.runtime`
- [ ] **D.** `twig.filter`

### Question 57

Quelles affirmations sur le lazy loading des extensions Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les extensions définies avec les attributs (`#[AsTwigFilter]`…) sont déjà lazy-loaded, rien à faire
- [ ] **B.** Le lazy loading est impossible avec l'approche legacy (`AbstractExtension`)
- [ ] **C.** Avec l'approche legacy, Twig initialise toutes les extensions avant de rendre le moindre template, même inutilisées
- [ ] **D.** La solution legacy consiste à référencer un callable : `new TwigFilter('price', [AppRuntime::class, 'formatPrice'])`, la logique vivant dans une classe séparée

### Question 58

Quelles affirmations sur la classe « runtime » d'une extension legacy découplée sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle implémente `Twig\Extension\RuntimeExtensionInterface`
- [ ] **B.** Le suffixe `Runtime` est une convention, pas une obligation
- [ ] **C.** Sans la configuration par défaut, son service doit être taggué `twig.runtime`
- [ ] **D.** Elle doit hériter d'`AbstractExtension`

### Question 59

Comment vérifier qu'un filtre personnalisé `price` a bien été enregistré ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console lint:twig --filter=price`
- [ ] **B.** `php bin/console twig:filters`
- [ ] **C.** `php bin/console debug:container --tag=twig.extension`
- [ ] **D.** `php bin/console debug:twig --filter=price`

### Question 60

Un template peut-il surcharger des blocks définis à **différents niveaux** de la hiérarchie d'héritage (son parent direct et le template de base) ? *(une seule bonne réponse)*

- [ ] **A.** Non : seuls les blocks du parent direct sont surchargeables
- [ ] **B.** Oui — l'exemple de la doc surcharge `page_contents` (défini dans `blog/layout.html.twig`) et `title` (défini dans `base.html.twig`)
- [ ] **C.** Oui, mais uniquement avec le tag `{% use %}`
- [ ] **D.** Non : il faut répéter le block dans chaque niveau intermédiaire

---

> Les questions 61 à 90 portent sur le **langage Twig** lui-même, à partir de la [documentation officielle Twig 3.x](https://twig.symfony.com/doc/3.x/).

## Le langage Twig : expressions et opérateurs

### Question 61

Quelles variables globales sont toujours disponibles dans les templates Twig ? *(plusieurs bonnes réponses)*

- [ ] **A.** `_self` — le nom du template courant
- [ ] **B.** `_context` — le contexte courant
- [ ] **C.** `_charset` — le charset courant
- [ ] **D.** `_env` — l'environnement Twig courant

### Question 62

Dans quel type de chaîne l'interpolation `#{expression}` fonctionne-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Dans les chaînes à guillemets simples et doubles
- [ ] **B.** Dans aucune : l'interpolation s'écrit `${expression}`
- [ ] **C.** Uniquement dans les chaînes à guillemets **simples**
- [ ] **D.** Uniquement dans les chaînes à guillemets **doubles**

### Question 63

Quels opérateurs de comparaison de chaînes existent en Twig ? *(plusieurs bonnes réponses)*

- [ ] **A.** `starts with` — teste si une chaîne commence par une sous-chaîne
- [ ] **B.** `ends with` — teste si une chaîne se termine par une sous-chaîne
- [ ] **C.** `matches` — compare avec une expression régulière
- [ ] **D.** `contains` — teste si une chaîne contient une sous-chaîne

### Question 64

Que vaut `{{ 20 // 7 }}` ? *(une seule bonne réponse)*

- [ ] **A.** `2`
- [ ] **B.** `2.857…`
- [ ] **C.** `3`
- [ ] **D.** Une erreur de syntaxe : `//` n'existe pas en Twig

### Question 65

Quelles affirmations sur les opérateurs de Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `~` convertit ses opérandes en chaînes et les concatène
- [ ] **B.** `..` crée une séquence — c'est du sucre syntaxique pour la fonction `range()`
- [ ] **C.** Combiné à un filtre, `..` exige des parenthèses : `{{ (1..5)|join(', ') }}`
- [ ] **D.** `+` concatène aussi les chaînes, comme en JavaScript

### Question 66

Quelles affirmations sur `??`, `?:` et le filtre `default` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{{ result ?? 'no' }}` retourne `result` si défini et non null, `'no'` sinon
- [ ] **B.** `{{ result ?: 'no' }}` est équivalent à `{{ result ? result : 'no' }}`
- [ ] **C.** Sur un booléen valant `false`, `{{ value|default(true) }}` affiche `true` — le filtre traite `false` comme vide ; préférer `??` dans ce cas
- [ ] **D.** `??` et `|default()` sont strictement équivalents

### Question 67

Que produit `{{ user?.address.city }}` quand `user` vaut `null` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception `RuntimeError`
- [ ] **B.** `null` — et le reste de la chaîne (`address.city`) n'est pas évalué
- [ ] **C.** Une chaîne vide, mais `address.city` est quand même évalué
- [ ] **D.** Une erreur de syntaxe : l'opérateur `?.` n'existe pas en Twig

### Question 68

Quelles affirmations sur le contrôle des espaces (whitespace control) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le modificateur `-` supprime tous les espaces, sauts de ligne compris
- [ ] **B.** Le modificateur `~` supprime les espaces **sans** les sauts de ligne
- [ ] **C.** Les modificateurs s'utilisent de chaque côté des tags : `{%-`, `-%}`, et aussi sur les commentaires (`{#- -#}`)
- [ ] **D.** Par défaut, le premier saut de ligne après un tag est conservé

### Question 69

Quelles affirmations sur l'opérateur de test `is` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il applique un test à une variable : `{{ name is odd }}`
- [ ] **B.** Les tests peuvent accepter des arguments : `{% if post.status is constant('Post::PUBLISHED') %}`
- [ ] **C.** Un test se nie avec `is not`
- [ ] **D.** L'opérateur `===` provoque une erreur de syntaxe en Twig

### Question 70

Que vaut `{{ true in ['foo', 'bar'] }}` ? *(une seule bonne réponse)*

- [ ] **A.** `false` : `true` ne figure pas dans la liste
- [ ] **B.** `true` — l'opérateur `in` fait une comparaison **lâche** (comme `in_array()`, `true == 'foo'`) ; utiliser le test `same as` pour du strict
- [ ] **C.** Une erreur : `in` n'accepte pas de booléen
- [ ] **D.** `null`

## Structures de contrôle et boucles

### Question 71

Quelles affirmations sur la variable `loop` disponible dans un `{% for %}` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `loop.index` est l'itération courante, indexée à partir de **1** (`loop.index0` à partir de 0)
- [ ] **B.** `loop.first` et `loop.last` indiquent la première et la dernière itération
- [ ] **C.** `loop.revindex` compte le nombre d'itérations depuis la fin, et `loop.parent` donne le contexte parent
- [ ] **D.** `loop.length` et `loop.last` sont disponibles pour n'importe quel itérable, y compris les générateurs

### Question 72

Dans un `{% for %}`, quand la clause `{% else %}` est-elle rendue ? *(une seule bonne réponse)*

- [ ] **A.** À la dernière itération de la boucle
- [ ] **B.** Quand une condition `if` interne à la boucle échoue
- [ ] **C.** Quand aucune itération n'a eu lieu, la séquence étant vide
- [ ] **D.** Jamais : la clause `else` n'existe pas pour `for`

### Question 73

Quelle syntaxe itère à la fois sur les clés et les valeurs d'un mapping ? *(une seule bonne réponse)*

- [ ] **A.** `{% for key, user in users %}`
- [ ] **B.** `{% for users as key => user %}`
- [ ] **C.** `{% for key of users %}`
- [ ] **D.** `{% foreach users key user %}`

### Question 74

Une variable est définie par `{% set %}` **à l'intérieur** d'un `{% for %}`. Est-elle accessible après la boucle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, comme en PHP
- [ ] **B.** Oui, mais seulement si la boucle a itéré au moins une fois
- [ ] **C.** Non, sauf à utiliser `{% set global %}`
- [ ] **D.** Non — les boucles sont scopées en Twig ; il faut déclarer la variable **avant** la boucle pour y accéder après

### Question 75

Quelles affirmations sur le tag `{% set %}` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il permet des assignations multiples : `{% set first, last = 'Fabien', 'Potencier' %}`
- [ ] **B.** Il peut capturer un bloc de contenu : `{% set content %} … {% endset %}`
- [ ] **C.** Avec l'échappement automatique activé, le contenu ainsi capturé est considéré comme **sûr**
- [ ] **D.** Il ne peut assigner que des chaînes de caractères

## Macros

### Question 76

Quelles affirmations sur les macros Twig sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les arguments d'une macro sont toujours optionnels
- [ ] **B.** Les arguments positionnels supplémentaires arrivent dans la variable spéciale `varargs`
- [ ] **C.** Un argument peut définir une valeur par défaut : `{% macro input(name, value, type = "text") %}`
- [ ] **D.** Comme les fonctions PHP, les macros n'ont **pas** accès aux variables du template courant

### Question 77

Quelles affirmations sur l'import de macros sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{% import "forms.html.twig" as forms %}` importe toutes les macros comme attributs de la variable `forms`
- [ ] **B.** `{% from 'forms.html.twig' import input as input_field, textarea %}` importe des macros précises, avec alias possible
- [ ] **C.** Dans le template où elles sont définies, les macros sont automatiquement disponibles via `_self`, sans import
- [ ] **D.** Les macros importées sont disponibles dans les templates inclus et enfants, sans ré-import

### Question 78

Comment une macro peut-elle accéder à l'ensemble des variables du template appelant ? *(une seule bonne réponse)*

- [ ] **A.** C'est impossible : une macro est complètement isolée
- [ ] **B.** En ajoutant le suffixe `with context` lors de l'import
- [ ] **C.** En lui passant la variable spéciale `_context` en argument
- [ ] **D.** Le contexte est transmis automatiquement, comme pour `include`

## Héritage avancé et réutilisation

### Question 79

Quelles affirmations sur le tag `{% extends %}` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il devrait être le premier tag du template
- [ ] **B.** Twig ne supporte pas l'héritage multiple : un seul `extends` par rendu
- [ ] **C.** Un block non surchargé par l'enfant garde le contenu défini dans le parent
- [ ] **D.** On peut définir deux `{% block %}` du même nom dans un même template

### Question 80

Comment afficher le contenu d'un block à plusieurs endroits d'un template ? *(une seule bonne réponse)*

- [ ] **A.** En définissant deux `{% block %}` du même nom
- [ ] **B.** Avec `{{ parent() }}`
- [ ] **C.** Avec la fonction `block` : `{{ block('title') }}`
- [ ] **D.** Ce n'est pas possible

### Question 81

Quelles formes dynamiques le tag `{% extends %}` accepte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une variable : `{% extends some_var %}` (y compris une instance `\Twig\Template` ou `\Twig\TemplateWrapper`)
- [ ] **B.** Une liste de templates : `{% extends ['layout.html.twig', 'base_layout.html.twig'] %}` — le premier qui existe est utilisé
- [ ] **C.** Une expression conditionnelle : `{% extends standalone ? "minimum.html.twig" : "base.html.twig" %}`
- [ ] **D.** Aucune : le nom du parent doit être une chaîne littérale

### Question 82

Quelles affirmations sur le tag `{% use %}` (réutilisation horizontale) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il importe les **blocks** d'un autre template — « comme les macros, mais pour les blocks »
- [ ] **B.** Le template importé ne doit pas étendre d'autre template, ne pas définir de macros, et avoir un corps vide
- [ ] **C.** On peut renommer les blocks importés : `{% use "blocks.html.twig" with sidebar as base_sidebar %}`
- [ ] **D.** La référence du template peut être une expression dynamique

### Question 83

Quelles affirmations sur le tag `{% embed %}` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il combine les comportements d'`include` et d'`extends`
- [ ] **B.** Il permet de surcharger les blocks définis dans le template embarqué
- [ ] **C.** Il accepte exactement les mêmes arguments qu'`include` : `with`, `only`, `ignore missing`
- [ ] **D.** Les macros importées dans le template hôte restent disponibles dans le corps du `embed`

### Question 84

Quelles affirmations sur l'inclusion de templates sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La documentation Twig recommande la **fonction** `include()` plutôt que le tag `{% include %}` (plus correcte sémantiquement, plus composable)
- [ ] **B.** `ignore missing`, placé juste après le nom du template, fait ignorer silencieusement un template manquant
- [ ] **C.** On peut passer une liste : `{% include ['page_detailed.html.twig', 'page.html.twig'] %}` — le premier template existant est inclus
- [ ] **D.** Le mot-clé `only` rend accessibles **toutes** les variables du contexte courant

## Échappement et syntaxe avancée

### Question 85

Quelles affirmations sur l'échappement manuel avec le filtre `escape` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `e` est un alias du filtre `escape` : `{{ user.username|e }}`
- [ ] **B.** La stratégie par défaut est `html`
- [ ] **C.** D'autres stratégies existent selon le contexte : `e('js')`, `e('css')`, `e('url')`, `e('html_attr')`
- [ ] **D.** Une stratégie `e('sql')` protège des injections SQL

### Question 86

Comment désactiver l'échappement automatique pour toute une section de template ? *(une seule bonne réponse)*

- [ ] **A.** `{% raw %} … {% endraw %}`
- [ ] **B.** Ce n'est possible que variable par variable, avec `|raw`
- [ ] **C.** `{% escape false %} … {% endescape %}`
- [ ] **D.** `{% autoescape false %} … {% endautoescape %}`

### Question 87

Comment afficher les délimiteurs Twig (`{{`, `{% … %}`) comme du texte brut, sans que Twig les interprète ? *(plusieurs bonnes réponses)*

- [ ] **A.** Encadrer la section avec `{% verbatim %} … {% endverbatim %}`
- [ ] **B.** Afficher le délimiteur via une expression chaîne : `{{ '{{' }}`
- [ ] **C.** Encadrer la section avec `{% raw %} … {% endraw %}`
- [ ] **D.** Préfixer les délimiteurs d'un antislash : `\{{`

### Question 88

Avec `{% set greeting = 'Hello ' %}` et `{% set name = 'Fabien' %}`, qu'affiche `{{ greeting ~ name|lower }}` ? *(une seule bonne réponse)*

- [ ] **A.** `hello fabien`
- [ ] **B.** `Hello fabien`
- [ ] **C.** `Hello Fabien`
- [ ] **D.** Une erreur de syntaxe

### Question 89

Quelles affirmations sur les fonctions fléchées (`=>`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `{{ people|map(p => p.first_name)|join(', ') }}` extrait le prénom de chaque élément
- [ ] **B.** Les filtres natifs `map`, `reduce`, `sort`, `filter` et `find` acceptent des fonctions fléchées
- [ ] **C.** Une fonction fléchée peut être stockée dans une variable puis passée à un filtre
- [ ] **D.** Les fonctions fléchées ne fonctionnent qu'avec le filtre `map`

### Question 90

Que fait le tag `{% do %}` ? *(une seule bonne réponse)*

- [ ] **A.** Il évalue une expression exactement comme `{{ … }}`, mais sans rien afficher
- [ ] **B.** Il répète un bloc tant qu'une condition est vraie
- [ ] **C.** C'est un équivalent du `dump()` de débogage
- [ ] **D.** Il exécute du code PHP arbitraire

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Creating and Using Templates de la documentation Symfony 8.0](https://symfony.com/doc/8.0/templates.html). Pour les questions 61 à 90, elles renvoient à la [documentation Twig 3.x](https://twig.symfony.com/doc/3.x/) : *(Twig — Templates, § …)* désigne la page « Twig for Template Designers », *(Twig — tag `xxx`)* la page du tag correspondant.

**Question 1 : B** — « run the following command to install both Twig language support and its integration with Symfony applications: `composer require symfony/twig-bundle` ». *(§ Installation)*

**Question 2 : A, B, C** — Les trois constructions documentées : affichage, logique, commentaires. `{! ... !}` n'existe pas. *(§ Twig Templating Language)*

**Question 3 : C** — « unlike HTML comments, these comments are not included in the rendered page ». *(§ Twig Templating Language)*

**Question 4 : D** — « You can't run PHP code inside Twig templates, but Twig provides utilities to run some logic in the templates » (filtres, tags, fonctions…). *(§ Twig Templating Language)*

**Question 5 : A, B** — « Twig is fast in the `prod` environment (because templates are compiled into PHP and cached automatically), but convenient to use in the `dev` environment (because templates are recompiled automatically when you change them). » *(§ Twig Templating Language)*

**Question 6 : A** — Les **filtres** « modify content before being rendered, like the `upper` filter to uppercase contents ». *(§ Twig Templating Language)*

**Question 7 : B** — Commentaire de l'exemple : « Twig recommends using snake_case variable names: `'foo_bar'` instead of `'fooBar'` ». *(§ Creating Templates)*

**Question 8 : A, C, D** — Snake case pour fichiers et dossiers ; deux extensions, la première étant « the final format that the template will generate ». Le `.twig` n'est pas optionnel dans cette convention (B). *(§ Template Naming)*

**Question 9 : A** — « Templates are stored by default in the `templates/` directory » du projet. *(§ Template Location)*

**Question 10 : C** — « the template path is the relative file path from `templates/` » : `product/index.html.twig` → `<your-project>/templates/product/index.html.twig`. *(§ Creating Templates / Template Location)*

**Question 11 : C** — « The default templates directory is configurable with the `twig.default_path` option. » *(§ Template Location)*

**Question 12 : B** — L'ordre documenté commence par `$foo['bar']` (tableau et élément), puis propriété publique, méthode publique, getter, isser, hasser. *(§ Template Variables)*

**Question 13 : A, B** — « If none of the above exists, use `null` (or throw a `Twig\Error\RuntimeError` exception if the `strict_variables` option is enabled). » *(§ Template Variables)*

**Question 14 : D** — `path()` génère les URLs « based on the routing configuration », à partir du nom de route et de ses paramètres ; les URLs générées sont relatives. *(§ Linking to Pages)*

**Question 15 : A** — « If you need to generate absolute URLs (for example when rendering templates for emails or RSS feeds), use the `url()` function, which takes the same arguments as `path()`. » *(§ Linking to Pages)*

**Question 16 : A, B, D** — Il faut `composer require symfony/asset` ; `asset()` apporte le versioning (cache busting) et la portabilité (`/images/logo.png` vs `/my_app/images/logo.png`). Les URLs générées ne sont pas absolues (C) — voir `absolute_url()`. *(§ Linking to CSS, JavaScript and Image Assets)*

**Question 17 : D** — « If you need absolute URLs for assets, use the `absolute_url()` Twig function » : `absolute_url(asset('images/logo.png'))`. *(§ Linking to CSS, JavaScript and Image Assets)*

**Question 18 : A, C, D** — `app.request`, `app.user` (ou `null` si non authentifié) et `app.flashes` (qui accepte aussi un type : `app.flashes('notice')`). Pas de `app.container` (B). *(§ The App Global Variable)*

**Question 19 : A** — « The `app` variable (which is an instance of `Symfony\Bridge\Twig\AppVariable`)… ». *(§ The App Global Variable)*

**Question 20 : B, C, D** — `app.environment`, `app.debug` et `app.current_route` (avec aussi `app.session`, `app.token`, `app.current_route_parameters`, `app.locale`, `app.enabled_locales`). Pas de `app.kernel` (A). *(§ The App Global Variable)*

**Question 21 : A, B, D** — `twig.globals` injecte des variables (statiques ou services préfixés par `@`) dans tous les templates. C est l'inverse du drawback documenté : « these services are **not** loaded lazily […] as soon as Twig is loaded, your service is instantiated ». *(§ Global Variables)*

**Question 22 : B** — « the `_` prefix is optional, but it's a convention used to better differentiate between full templates and template fragments ». *(§ Including Templates)*

**Question 23 : A, B, C** — « The included template has access to all the variables of the template that includes it (use the `with_context` option to control this) » ; et on peut passer des variables pour les renommer. *(§ Including Templates)*

**Question 24 : C** — Les trois niveaux recommandés : `base.html.twig` (éléments communs `<head>`, header, footer…), `layout.html.twig` (structure du contenu, ex. deux colonnes), puis les pages de l'application. *(§ Template Inheritance and Layouts)*

**Question 25 : A, C, D** — Les blocks définissent les sections surchargeables ; ils « can be empty, like the `content` block or define a default content, like the `title` block, which is displayed when child templates don't override them ». Rien n'oblige à tout surcharger (B). *(§ Template Inheritance and Layouts)*

**Question 26 : C** — Warning : « a child template is forbidden to define template parts outside of a block. The following code throws a `SyntaxError`. » *(§ Template Inheritance and Layouts)*

**Question 27 : D** — « Twig components are the **recommended way to render and reuse small template fragments**, like an alert, a modal, a category sidebar… ». *(§ Twig Components)*

**Question 28 : A, B, D** — Syntaxe `<twig:RecentArticles max="3"/>` ; « each component pairs a template with an optional "component class" » ; et les Live Components se re-rendent via Ajax. C est faux : ils viennent des paquets UX Twig Component / UX Live Component. *(§ Twig Components)*

**Question 29 : A, B, C** — `render(path(...))`/`render(url(...))` pour un contrôleur routé, `render(controller(...))` sinon — ce dernier requiert l'option `fragments: { path: /_fragment }`. D contredit le warning : embarquer beaucoup de contrôleurs « can have a significant impact on the application performance » (d'où le cache ESI). *(§ Embedding Controllers)*

**Question 30 : A** — Note : « Embedding controllers still makes sense when you specifically need to run a controller as a sub-request; for example to cache that fragment separately with ESI. » Props et Ajax sont justement les points forts des composants (B, C). *(§ Embedding Controllers)*

**Question 31 : B, C, D** — `render_hinclude(controller(...))`/`render_hinclude(url(...))` ; défaut global via `hinclude_default_template` ou par appel (`{default: 'Loading...'}`) ; et « by default, the JavaScript code included in the loaded contents is not run » (`evaljs: 'true'` pour l'exécuter). A est faux : « `hinclude.js` is a legacy technique », préférer les Live Components. *(§ How to Embed Asynchronous Content with hinclude.js)*

**Question 32 : A, B, D** — `render()` « returns a `Response` object with the contents created by the template » ; `renderView()` « only returns the contents », à placer soi-même dans une `Response`. C est faux : rien n'est affiché directement. *(§ Rendering a Template in Controllers)*

**Question 33 : B** — « you only need to return an array with the parameters to pass to the template (the attribute is the one which will create and return the `Response` object) ». *(§ Rendering a Template in Controllers)*

**Question 34 : D** — `use Symfony\Bridge\Twig\Attribute\Template;` — l'attribut vient du bridge Twig. *(§ Rendering a Template in Controllers)*

**Question 35 : A, B, C, D** — Les quatre sont vraies : `renderBlock()` (Response), `renderBlockView()` (contenu seul), l'option `block:` de `#[Template]`, et l'usage « when dealing with blocks in templates inheritance or when using Turbo Streams ». *(§ Rendering a Template in Controllers)*

**Question 36 : A** — « Inject the `twig` Symfony service into your own services and use its `render()` method », en type-hintant `Twig\Environment` pour l'autowiring. *(§ Rendering a Template in Services)*

**Question 37 : A, B, C, D** — Les quatre sont vraies : `TemplateController` rend des pages statiques depuis la route, avec les defaults `template`, `statusCode` (200 par défaut), les options de cache `maxAge`/`sharedAge`/`private`, `context` (variables) et aussi `headers`. *(§ Rendering a Template Directly from a Route)*

**Question 38 : C** — Récupérer le loader (`$twig->getLoader()`) puis appeler sa méthode `exists()`. *(§ Checking if a Template Exists)*

**Question 39 : A, C, D** — `lint:twig` « checks that your Twig templates don't have any syntax errors », avec `--show-deprecations` et `--excludes`. Elle ne corrige rien (B). *(§ Linting Twig Templates)*

**Question 40 : B** — « When running the linter inside GitHub Actions, the output is automatically adapted to the format required by GitHub, but you can force that format too: `--format=github`. » *(§ Linting Twig Templates)*

**Question 41 : A, B, D** — `debug:twig` liste fonctions, filtres, globales… ; `--filter=` filtre par mot-clé ; un chemin de template affiche « the physical file which will be loaded ». Elle n'exécute pas les templates (C). *(§ Inspecting Twig Information)*

**Question 42 : A** — « the contents of this variable are sent to the Web Debug Toolbar » pour le **tag** `{% dump %}` ; « dumped inside the page contents » pour la **fonction** `{{ dump() }}`. *(§ The Dump Twig Utilities)*

**Question 43 : B, C, D** — VarDumper via `composer require --dev symfony/debug-bundle` ; arguments nommés affichés comme labels ; disponible uniquement en `dev` et `test`. A est faux : « If you try to use it in the `prod` environment, you will see a PHP error. » *(§ The Dump Twig Utilities)*

**Question 44 : B** — « Symfony applications are safe by default because they perform automatic output escaping » (les caractères spéciaux comme `<` deviennent `&lt;`). *(§ Output Escaping and XSS Attacks)*

**Question 45 : D** — « If you are rendering a variable that is trusted and contains HTML contents, use the Twig raw filter to disable the output escaping for that variable. » *(§ Output Escaping and XSS Attacks)*

**Question 46 : C** — L'exemple exact de la doc : `<p>Hello &lt;script&gt;alert(&#39;hello!&#39;)&lt;/script&gt;</p>` — le script est neutralisé, pas exécuté. *(§ Output Escaping and XSS Attacks)*

**Question 47 : A, B** — Le filtre `raw`, et la désactivation par block ou template entier (via la doc d'échappement de Twig). Piège : le tag `twig.safe_class` (C) n'apparaît qu'en **Symfony 8.1**. D est dangereux et faux. *(§ Output Escaping and XSS Attacks)*

**Question 48 : A** — « Use the special syntax `@` + namespace to refer to the other namespaced templates (e.g. `@email/layout.html.twig` and `@admin/layout.html.twig`). » *(§ Template Namespaces)*

**Question 49 : A, B, C** — Paires `répertoire: namespace`, chemins relatifs à la racine du projet (ou absolus) ; et « Symfony looks for it first in the `twig.paths` directories that don't define a namespace and then falls back to the default template directory » — D est donc l'inverse. *(§ Template Namespaces)*

**Question 50 : D** — Note : « A single Twig namespace can be associated with more than one template directory. In that case, the order in which paths are added is important because Twig will start looking for templates from the first defined path. » *(§ Template Namespaces)*

**Question 51 : C** — « the templates of a bundle called `AcmeBlogBundle` are available under the `AcmeBlog` namespace » : `@AcmeBlog/user/profile.html.twig` (namespace = nom du bundle sans le suffixe `Bundle`). Les templates de bundles peuvent d'ailleurs être surchargés dans l'application. *(§ Bundle Templates)*

**Question 52 : B** — « Create a regular PHP class with a method that contains the filter logic. Then, add the `#[AsTwigFilter]` attribute to define the name and options of the Twig filter. » L'héritage d'`AbstractExtension` (A) est l'approche legacy, pas la seule possible. *(§ Create the Extension Class)*

**Question 53 : C** — « If you want to create a function instead of a filter, use the `#[AsTwigFunction]` attribute. » *(§ Create the Extension Class)*

**Question 54 : A** — `use Twig\Attribute\AsTwigFilter;` / `use Twig\Attribute\AsTwigFunction;` — ces attributs appartiennent à Twig lui-même, pas à Symfony. *(§ Create the Extension Class)*

**Question 55 : A, B, C** — « check if the filter/function that you need is not already implemented in: the default Twig filters and functions; the Twig filters and functions added by Symfony; the official Twig extensions related to strings, HTML, Markdown, internationalization, etc. » *(§ Writing a Twig Extension)*

**Question 56 : B** — Sans autoconfiguration, « you need to define a service manually and tag it with the `twig.attribute_extension` tag ». Le tag `twig.extension` (A) concerne l'approche legacy `AbstractExtension`, et `twig.runtime` (C) les classes runtime. *(§ Create the Extension Class)*

**Question 57 : A, C, D** — Avec les attributs, « the Twig extensions are already lazy-loaded » ; en legacy, « Twig initializes all the extensions before rendering any template » ; la solution : déclarer le callable `[AppRuntime::class, 'formatPrice']` et déplacer la logique dans une classe runtime. B est faux — c'est précisément ce que permet ce découplage. *(§ Creating Lazy-Loaded Twig Extensions)*

**Question 58 : A, B, C** — La classe runtime implémente `RuntimeExtensionInterface`, est suffixée `Runtime` par convention (« it's not required »), et se tagge `twig.runtime` hors config par défaut. Elle n'hérite pas d'`AbstractExtension` (D) — c'est l'extension qui le fait. *(§ Creating Lazy-Loaded Twig Extensions)*

**Question 59 : D** — « execute this command to confirm that your new filter was successfully registered: `php bin/console debug:twig --filter=price`. » *(§ Register an Extension as a Service)*

**Question 60 : B** — L'exemple de la doc : `blog/index.html.twig` « overrides blocks of different parent templates: `page_contents` from `blog/layout.html.twig` and `title` from `base.html.twig` » — trois templates participent au rendu final. *(§ Template Inheritance and Layouts)*

**Question 61 : A, B, C** — « The following variables are always available in templates: `_self` (references the current template name), `_context` (references the current context), `_charset` (references the current charset). » `_env` (D) n'existe pas. *(Twig — Templates, § Global Variables)*

**Question 62 : D** — « String interpolation (`#{expression}`) allows any valid expression to appear within a *double-quoted string*. » Les guillemets simples ne l'activent pas (et n'ont aucun impact sur les performances) ; on peut la neutraliser avec un antislash : `\#{1 + 2}`. *(Twig — Templates, § String Interpolation)*

**Question 63 : A, B, C** — `starts with`, `ends with`, et `matches` (« allows you to use regular expressions », PCRE). `contains` (D) n'existe pas : le test de contenance est l'opérateur `in` (`{{ 'cd' in 'abcde' }}`). *(Twig — Templates, § Containment Operators)*

**Question 64 : A** — `//` « divides two numbers and returns the **floored** integer result » : `20 // 7` vaut `2` (et `-20 // 7` vaut `-3`) — sucre syntaxique du filtre `round`. Ne pas confondre avec `/`, qui retourne un flottant, ni `%` (reste de la division). *(Twig — Templates, § Math)*

**Question 65 : A, B, C** — `~` « converts all operands into strings and concatenates them » ; `..` est « syntactic sugar for the `range` function » ; et comme l'opérateur de filtre a la précédence la plus haute, `(1..5)|join(', ')` exige les parenthèses. D est faux : `+` caste ses opérandes en **nombres**, il ne concatène jamais. *(Twig — Templates, § Math / Other Operators)*

**Question 66 : A, B, C** — `??` : « returns the value of result if it is defined and not null, 'no' otherwise » ; `result ?: 'no'` ≡ `result ? result : 'no'` ; et la doc du filtre `default` avertit : « using the `default` filter on a boolean variable might trigger unexpected behavior, as `false` is treated as an empty value. Consider using `??` instead » — `{{ false|default(true) }}` affiche `true`, `{{ false ?? true }}` affiche `false`. D est donc faux. *(Twig — Templates, § Other Operators ; filtre `default`)*

**Question 67 : B** — L'opérateur null-safe (Twig 3.23+) « works like the dot operator but returns `null` instead of throwing an exception when the left operand is `null`. If the operand is part of a chain, the rest of the chain is skipped. » *(Twig — Templates, § dot operator)*

**Question 68 : A, B, C** — `-` : « removes all whitespace (including newlines) » ; `~` : « removes all whitespace (excluding newlines) » ; utilisables d'un côté ou des deux (`{%-`, `-%}`), y compris sur les commentaires (`{#--#}` pour coller deux tags). D est l'inverse de la règle : « The first newline after a template tag is removed automatically (like in PHP). » *(Twig — Templates, § Whitespace Control)*

**Question 69 : A, B, C** — `is` applique un test, avec arguments possibles (`is constant(…)`) et négation `is not`. D est faux : « the `===` and `!==` strict comparison operators are supported (they are equivalent to the `same as` and `not same as` tests) ». *(Twig — Templates, § Test Operator / Comparisons)*

**Question 70 : B** — Note de la doc : « returns true because `true == 'foo'` under PHP loose comparison » — `in` compare de façon lâche, « like PHP's `in_array()` » ; utiliser `same as` pour une comparaison stricte. *(Twig — Templates, § Containment Operators)*

**Question 71 : A, B, C** — Le tableau documenté : `loop.index`/`index0`, `loop.revindex`/`revindex0`, `loop.first`, `loop.last`, `loop.length`, `loop.parent`. D est faux : « The `loop.length`, `loop.revindex`, `loop.revindex0`, and `loop.last` variables are only available for PHP arrays, or objects that implement the `Countable` interface. » *(Twig — tag `for`)*

**Question 72 : C** — « If no iteration took place because the sequence was empty, you can render a replacement block by using `else`. » *(Twig — tag `for`)*

**Question 73 : A** — `{% for key, user in users %}` itère sur clés et valeurs. Pour les clés seules : `{% for key in users|keys %}`. Les autres syntaxes n'existent pas en Twig. *(Twig — tag `for`)*

**Question 74 : D** — « Loops are scoped in Twig; therefore a variable declared inside a `for` loop is not accessible outside the loop itself. If you want to access the variable, just declare it before the loop. » *(Twig — tag `set`)*

**Question 75 : A, B, C** — Assignations multiples, capture de bloc `{% set content %}…{% endset %}`, et le caution : « If you enable automatic output escaping, Twig will only consider the content to be safe when capturing chunks of text. » D est faux : « The assigned value can be any valid Twig expression. » *(Twig — tag `set`)*

**Question 76 : A, B, C, D** — Les quatre sont vraies : « Arguments of a macro are always optional » ; « if extra positional arguments are passed to a macro, they end up in the special `varargs` variable » ; les valeurs par défaut (`type = "text"`) ; et « as with PHP functions, macros don't have access to the current template variables » (le tip : passer la variable spéciale `_context` en argument). *(Twig — tag `macro`)*

**Question 77 : A, B, C** — `import` importe toutes les macros « as attributes of the `forms` local variable » ; `from … import … as …` importe des macros ciblées (attention : elles peuvent masquer des fonctions natives) ; et « when macro usages and definitions are in the same template, you don't need to import the macros as they are automatically available under the special `_self` variable ». D est faux : « Imported macros are always **local** to the current template […] they are not available in included templates or child templates; you need to explicitly re-import macros in each template. » *(Twig — tag `macro`)*

**Question 78 : C** — Tip de la doc : « You can pass the whole context as an argument by using the special `_context` variable. » (`with context` (B) est la syntaxe d'import de Twig 1/2, retirée en Twig 3.) *(Twig — tag `macro`)*

**Question 79 : A, B, C** — « The extends tag should be the first tag in the template » ; « Like PHP, Twig does not support multiple inheritance. So you can only have one extends tag called per rendering » ; et un block non surchargé garde « the value from the parent template ». D est faux : « You can't define multiple `block` tags with the same name in the same template » — un block remplit aussi le slot du parent, deux homonymes seraient ambigus. *(Twig — tag `extends`)*

**Question 80 : C** — « If you want to print a block multiple times you can however use the `block` function: `<h1>{{ block('title') }}</h1>` ». `parent()` (B) affiche le contenu du block **parent**, c'est un autre usage. *(Twig — tag `extends`)*

**Question 81 : A, B, C** — L'héritage dynamique accepte une variable (y compris une instance `\Twig\Template`/`\Twig\TemplateWrapper`), une liste (« The first template that exists will be used as a parent ») et toute expression valide, dont le ternaire conditionnel. *(Twig — tag `extends`, § Dynamic/Conditional Inheritance)*

**Question 82 : A, B, C** — « The `use` statement tells Twig to import the blocks defined in `blocks.html.twig` into the current template (it's like macros, but for blocks) » ; conditions : « only imports a template if it does not extend another template, if it does not define macros, and if the body is empty » ; renommage avec `with sidebar as base_sidebar`. D est faux : « Because `use` statements are resolved independently of the context passed to the template, the template reference cannot be an expression. » *(Twig — tag `use`)*

**Question 83 : A, B, C** — « The `embed` tag combines the behavior of `include` and `extends` » : il inclut un template **et** permet d'en surcharger les blocks (« micro layout skeleton ») ; « the `embed` tag takes the exact same arguments as the `include` tag ». D est faux : « Imported macros are not available in the body of `embed` tags, you need to explicitly re-import macros inside the tag. » *(Twig — tags `embed` et `macro`)*

**Question 84 : A, B, C** — La note du tag `include` : « It is recommended to use the `include` **function** instead as it provides the same features with a bit more flexibility » (sémantiquement plus correcte, composable, arguments nommés) ; `ignore missing` « has to be placed just after the template name » ; avec une liste, « the first template that exists will be included » (exception si aucun n'existe, sauf `ignore missing`). D est l'inverse : `only` **restreint** le template inclus aux seules variables passées via `with`. *(Twig — tag `include`)*

**Question 85 : A, B, C** — « Escaping works by using the `escape` or `e` filter » ; « by default, the `escape` filter uses the `html` strategy » ; selon le contexte : `js`, `css`, `url`, `html_attr`. `e('sql')` (D) n'existe pas — l'échappement SQL n'est pas le rôle du moteur de templates. *(Twig — Templates, § Working with Manual Escaping)*

**Question 86 : D** — `{% autoescape false %} … {% endautoescape %}` : « Everything will be outputted as is in this block. » Le tag accepte aussi une stratégie : `{% autoescape 'js' %}`. `{% raw %}` (A) n'existe pas en Twig 3, et `verbatim` a un autre rôle (question 87). *(Twig — tag `autoescape`)*

**Question 87 : A, B** — « The easiest way is to output the variable delimiter (`{{`) by using a variable expression: `{{ '{{' }}` » ; « for bigger sections it makes sense to mark a block `verbatim` ». `{% raw %}` (C) est l'ancien nom du tag, retiré ; l'antislash (D) ne neutralise que l'interpolation `\#{…}`. *(Twig — Templates, § Escaping)*

**Question 88 : B** — L'exemple exact de la doc : `{{ greeting ~ name|lower }}` affiche `Hello fabien` — le filtre, prioritaire, ne s'applique qu'à `name`. Pour tout passer en minuscules, grouper : `{{ (greeting ~ name)|lower }}` → `hello fabien`. *(Twig — Templates, § Operators)*

**Question 89 : A, B, C** — « The built-in `map`, `reduce`, `sort`, `filter`, and `find` filters accept arrow functions as arguments » ; « arrow functions can be stored in variables » puis passées à un filtre. D est faux — et depuis Twig 3.15, les fonctions fléchées sont aussi acceptées par les fonctions, macros et appels de méthodes. *(Twig — Templates, § Other Operators)*

**Question 90 : A** — « The `do` tag works exactly like the regular variable expression (`{{ … }}`) just that it doesn't print anything. » Utile pour évaluer une expression pour ses effets (assignation, appel de méthode…). *(Twig — tag `do`)*

