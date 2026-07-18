# QCM — Le routing Symfony

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/routing.html](https://symfony.com/doc/8.0/routing.html) · **Généré le :** 18 juillet 2026
>
> **80 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Déclarer des routes

### Question 1

Quelles sont les bonnes méthodes parmi celles-ci pour déclarer une route dans Symfony 8.0 ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec un attribut PHP `#[Route]` sur la méthode du contrôleur
- [ ] **B.** Dans un fichier de configuration YAML
- [ ] **C.** Avec une annotation PHPDoc `/** @Route(...) */`
- [ ] **D.** Dans un fichier de configuration PHP

### Question 2

Quelle méthode de déclaration des routes la documentation Symfony recommande-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Le YAML, pour séparer la configuration du code
- [ ] **B.** Le PHP, pour bénéficier du typage
- [ ] **C.** Les attributs PHP, car la route et le contrôleur sont définis au même endroit
- [ ] **D.** Aucune : les formats n'étant pas équivalents en fonctionnalités, le choix dépend du projet

### Question 3

Quelle est la bonne classe à importer pour utiliser l'attribut `#[Route]` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Routing\Annotation\Route`
- [ ] **B.** `Symfony\Component\Routing\Attribute\Route`
- [ ] **C.** `Symfony\Bundle\FrameworkBundle\Attribute\Route`
- [ ] **D.** `Sensio\Bundle\FrameworkExtraBundle\Configuration\Route`

### Question 4

Votre projet n'utilise pas Symfony Flex. Quelle est la bonne configuration pour activer le routing par attributs ? *(une seule bonne réponse)*

- [ ] **A.** Rien à faire : les attributs sont toujours détectés automatiquement
- [ ] **B.** Ajouter `attributes: true` sous `framework.router` dans `config/packages/framework.yaml`
- [ ] **C.** Installer `sensio/framework-extra-bundle`
- [ ] **D.** Créer le fichier suivant :

  ```yaml
  # config/routes.yaml
  controllers:
      resource: routing.controllers
  ```

### Question 5

Une route est déclarée avec `#[Route('/blog', name: 'blog_list')]`. Quelles URLs matchent cette route ? *(plusieurs bonnes réponses)*

- [ ] **A.** `/blog`
- [ ] **B.** `/blog?foo=bar&bar=foo`
- [ ] **C.** `/blog/1`
- [ ] **D.** `/BLOG`

### Question 6

Que se passe-t-il si deux classes de contrôleur sont définies dans le même fichier PHP ? *(une seule bonne réponse)*

- [ ] **A.** Symfony ne charge que les routes de la première classe et ignore toutes les autres
- [ ] **B.** Symfony charge les routes de toutes les classes du fichier
- [ ] **C.** Symfony ne charge que les routes ayant une option `name` explicite
- [ ] **D.** Symfony lève une exception au démarrage

### Question 7

Une même route est déclarée à la fois en YAML et via un attribut `#[Route]`. Quelle déclaration est prise en compte ? *(une seule bonne réponse)*

- [ ] **A.** Celle du YAML, les fichiers de configuration étant prioritaires
- [ ] **B.** Aucune : Symfony lève une erreur « route already defined »
- [ ] **C.** Celle de l'attribut, qui gagne toujours sur les routes définies en YAML ou PHP
- [ ] **D.** La dernière chargée par le kernel

### Question 8

Quelle est la bonne déclaration YAML d'une route associant `/blog` à l'action `list()` de `App\Controller\BlogController` ? *(une seule bonne réponse)*

- [ ] **A.**

  ```yaml
  blog_list:
      url: /blog
      action: App\Controller\BlogController::list
  ```
- [ ] **B.**

  ```yaml
  blog_list:
      path: /blog
      controller: App\Controller\BlogController::list
  ```
- [ ] **C.**

  ```yaml
  blog_list:
      path: /blog
      controller: [App\Controller\BlogController, list]
  ```
- [ ] **D.**

  ```yaml
  blog_list:
      route: /blog
      controller: App\Controller\BlogController:list
  ```

### Question 9

Le contrôleur implémente son action via la méthode `__invoke()`. Quelle est la bonne façon de le référencer dans l'option `controller` en YAML ? *(une seule bonne réponse)*

- [ ] **A.** `controller: App\Controller\BlogController` — la partie `::method_name` peut être omise
- [ ] **B.** `controller: App\Controller\BlogController::invoke`
- [ ] **C.** Il faut ajouter `invokable: true` à la définition de la route
- [ ] **D.** Impossible : une route YAML exige toujours un nom de méthode explicite

## Méthodes HTTP

### Question 10

Par défaut, sans option `methods`, à quelles méthodes HTTP une route répond-elle ? *(une seule bonne réponse)*

- [ ] **A.** `GET` uniquement
- [ ] **B.** `GET` et `HEAD`
- [ ] **C.** `GET`, `HEAD` et `POST`
- [ ] **D.** Toutes les méthodes HTTP (`GET`, `POST`, `PUT`, etc.)

### Question 11

Quelles sont les bonnes syntaxes parmi celles-ci pour restreindre une route aux méthodes `GET` et `HEAD` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[Route('/api/posts/{id}', methods: ['GET', 'HEAD'])]`
- [ ] **B.** En YAML : `methods: GET|HEAD`
- [ ] **C.** `#[Route('/api/posts/{id}', method: 'GET|HEAD')]`
- [ ] **D.** En YAML : `verbs: [GET, HEAD]`

### Question 12

Un formulaire HTML doit appeler une route restreinte à la méthode `PUT`. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les formulaires HTML ne supportent nativement que les méthodes `GET` et `POST`
- [ ] **B.** On peut ajouter un champ caché nommé `_method` avec la valeur `PUT`
- [ ] **C.** Avec Symfony Forms, ce champ est ajouté automatiquement quand l'option `framework.http_method_override` vaut `true`
- [ ] **D.** Il suffit d'écrire `<form method="put">` : le navigateur enverra la requête en `PUT`

## Environnements et expressions

### Question 13

Quelles sont les bonnes méthodes parmi celles-ci pour n'enregistrer une route que dans l'environnement `dev` ? *(plusieurs bonnes réponses)*

- [ ] **A.** En YAML, déclarer la route sous la clé `when@dev:`
- [ ] **B.** En attribut : `#[Route('/tools', name: 'tools', env: 'dev')]`
- [ ] **C.** En attribut : `#[Route('/tools', name: 'tools', only: 'dev')]`
- [ ] **D.** En YAML, ajouter `defaults: { env: dev }` à la route

### Question 14

Quelles variables Symfony met-il à disposition dans une expression de l'option `condition` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `request` — l'objet `Request` de la requête courante
- [ ] **B.** `context` — une instance de `RequestContext`
- [ ] **C.** `session` — la session de l'utilisateur courant
- [ ] **D.** `params` — les paramètres de la route matchée

### Question 15

Quelles fonctions peut-on utiliser dans une expression `condition` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `env('APP_MAIN_HOST')` — lire une variable d'environnement
- [ ] **B.** `param('app.allowed_browsers')` — lire un paramètre du container
- [ ] **C.** `service('route_checker')` — appeler un service de condition de routing
- [ ] **D.** `date('Y-m-d')` — obtenir la date courante

### Question 16

Pour qu'un service soit utilisable via la fonction `service()` dans une condition de route, que faut-il faire ? *(plusieurs bonnes réponses)*

- [ ] **A.** Lui ajouter l'attribut `#[AsRoutingConditionService]`
- [ ] **B.** Lui faire implémenter une interface `RoutingConditionInterface`
- [ ] **C.** Lui ajouter le tag `routing.condition_service`
- [ ] **D.** Rien : tout service public du container est utilisable

### Question 17

Quelles affirmations sur l'option `condition` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les expressions sont compilées en PHP brut : la clé `condition` n'ajoute pas de surcoût notable
- [ ] **B.** Les conditions sont prises en compte lors de la génération d'URLs
- [ ] **C.** Une expression peut inclure un paramètre de configuration, ex. `"request.headers.get('User-Agent') matches '%app.allowed_browsers%'"`
- [ ] **D.** Une expression peut lire les valeurs des paramètres de la route via la variable `params`

## Débogage

### Question 18

Quelle commande liste toutes les routes de l'application, dans l'ordre où Symfony les évalue ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console router:debug`
- [ ] **B.** `php bin/console debug:router`
- [ ] **C.** `php bin/console debug:routes`
- [ ] **D.** `php bin/console router:list`

### Question 19

Quelles options de la commande `debug:router` existent en Symfony 8.0 ? *(plusieurs bonnes réponses)*

- [ ] **A.** `--show-controllers` — afficher les contrôleurs associés aux routes
- [ ] **B.** `--sort=path` — trier la liste par colonne
- [ ] **C.** `--show-aliases` — afficher aussi les alias de routes
- [ ] **D.** `--method=GET` — n'afficher que les routes qui matchent la méthode donnée

### Question 20

Quelle est la bonne commande pour savoir quelle route matche une URL donnée ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:router /lucky/number/8`
- [ ] **B.** `php bin/console router:test /lucky/number/8`
- [ ] **C.** `php bin/console router:match /lucky/number/8`
- [ ] **D.** `php bin/console debug:router --match=/lucky/number/8`

## Paramètres de route

### Question 21

Quelle est la bonne syntaxe pour définir une partie variable dans le chemin d'une route ? *(une seule bonne réponse)*

- [ ] **A.** `/blog/:slug`
- [ ] **B.** `/blog/{slug}`
- [ ] **C.** `/blog/<slug>`
- [ ] **D.** `/blog/*slug`

### Question 22

Quelles affirmations sur les paramètres de route sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une route peut définir autant de paramètres qu'elle veut
- [ ] **B.** Chaque paramètre ne peut être utilisé qu'une seule fois par route
- [ ] **C.** `/blog/posts-about-{category}/page/{pageNumber}` est un chemin valide
- [ ] **D.** Un paramètre doit obligatoirement occuper un segment d'URL entier, entre deux `/`

### Question 23

Ces deux routes sont définies dans cet ordre, sans `requirements` :

```yaml
blog_list:
    path:       /blog/{page}
    controller: App\Controller\BlogController::list

blog_show:
    path:       /blog/{slug}
    controller: App\Controller\BlogController::show
```

Que se passe-t-il pour une requête `GET /blog/my-first-post` ? *(une seule bonne réponse)*

- [ ] **A.** Symfony renvoie une erreur 404, aucune route ne correspondant exactement
- [ ] **B.** `blog_show` matche, car le motif `{slug}` correspond mieux à une chaîne de texte
- [ ] **C.** Symfony lève une exception d'ambiguïté, les deux routes matchant l'URL
- [ ] **D.** `blog_list` matche (première définie) et `$page` vaut `'my-first-post'`

### Question 24

Quelles sont les bonnes méthodes parmi celles-ci pour restreindre le paramètre `{page}` à des chiffres ? *(plusieurs bonnes réponses)*

- [ ] **A.** `#[Route('/blog/{page}', name: 'blog_list', requirements: ['page' => '[0-9]+'])]`
- [ ] **B.** Le requirement en ligne : `#[Route('/blog/{page<[0-9]+>}', name: 'blog_list')]`
- [ ] **C.** `#[Route('/blog/{page}', name: 'blog_list', requirements: ['page' => Requirement::DIGITS])]`
- [ ] **D.** Typer l'argument du contrôleur `int $page` : le typage restreint le matching

### Question 25

Quelle est la bonne syntaxe pour utiliser la constante `Requirement::DIGITS` dans un fichier de routes YAML ? *(une seule bonne réponse)*

- [ ] **A.**

  ```yaml
  requirements:
      page: !php/const Symfony\Component\Routing\Requirement\Requirement::DIGITS
  ```
- [ ] **B.**

  ```yaml
  requirements:
      page: 'Requirement::DIGITS'
  ```
- [ ] **C.**

  ```yaml
  requirements:
      page: '%Requirement::DIGITS%'
  ```
- [ ] **D.** Impossible : les constantes de `Requirement` sont réservées aux attributs PHP

### Question 26

Quelles affirmations sur l'option `requirements` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les requirements sont des expressions régulières PHP (PCRE)
- [ ] **B.** Les requirements (et les paths) peuvent inclure des paramètres de configuration (`%...%`)
- [ ] **C.** Les requirements supportent les propriétés Unicode PCRE, comme `\p{Lu}` ou `\p{Greek}`
- [ ] **D.** Les requirements s'appliquent aussi aux paramètres de la query string

### Question 27

Quelles sont les bonnes méthodes parmi celles-ci pour donner la valeur par défaut `1` au paramètre `{page}` ? *(plusieurs bonnes réponses)*

- [ ] **A.** En attributs : donner une valeur par défaut à l'argument du contrôleur, `int $page = 1`
- [ ] **B.** En YAML : `defaults: { page: 1 }`
- [ ] **C.** En ligne dans le path : `/blog/{page?1}`
- [ ] **D.** En YAML : `default: { page: 1 }`

### Question 28

Que signifie le chemin `/blog/{page<[0-9]+>?1}` ? *(une seule bonne réponse)*

- [ ] **A.** Rien : requirement et valeur par défaut ne peuvent pas être combinés en ligne
- [ ] **B.** `page` accepte un nombre entre 0 et 9, avec un minimum de 1
- [ ] **C.** `page` doit être numérique et vaut `1` par défaut
- [ ] **D.** `page` doit contenir exactement un chiffre et est obligatoire

### Question 29

Que produit la déclaration `/blog/{page?}` (rien après le `?`) ? *(une seule bonne réponse)*

- [ ] **A.** `page` reçoit une chaîne vide par défaut
- [ ] **B.** `page` reçoit `null` par défaut — il faut adapter le type de l'argument (`?int $page`)
- [ ] **C.** Une erreur de configuration au démarrage
- [ ] **D.** `page` reste obligatoire, le `?` seul étant ignoré

### Question 30

Quelles affirmations sur les paramètres optionnels sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tout ce qui suit un paramètre optionnel doit être optionnel
- [ ] **B.** Dans `/{page}/blog`, le paramètre `page` peut être rendu optionnel
- [ ] **C.** Une route peut avoir plusieurs paramètres optionnels
- [ ] **D.** La valeur par défaut a le droit de ne pas respecter le requirement du paramètre

### Question 31

Que fait le caractère `!` dans le chemin `/blog/{!page}` ? *(une seule bonne réponse)*

- [ ] **A.** Il interdit d'inclure `page` dans les URLs générées
- [ ] **B.** Il inverse le requirement du paramètre (négation de la regex)
- [ ] **C.** Il rend le paramètre obligatoire au matching même si un défaut existe
- [ ] **D.** Il force l'inclusion de la valeur (même par défaut) dans l'URL générée : `/blog/1` au lieu de `/blog`

### Question 32

Quelles affirmations sur la priorité des routes sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'option `priority` attend une valeur entière
- [ ] **B.** La priorité par défaut d'une route est `0`
- [ ] **C.** Les routes de priorité plus élevée sont évaluées avant celles de priorité plus basse
- [ ] **D.** En YAML ou PHP, on contrôle la priorité en déplaçant les définitions vers le haut ou le bas du fichier

### Question 33

En attributs, la route `/blog/{slug}` est définie avant `/blog/list` et l'intercepte. Quelle est la bonne solution documentée ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter `priority: 2` à la route `/blog/list`
- [ ] **B.** Ajouter `priority: -1` à la route `/blog/list`
- [ ] **C.** Rien à faire : la route la plus spécifique gagne automatiquement
- [ ] **D.** Renommer les routes pour que `/blog/list` soit chargée en premier par ordre alphabétique

## Conversion de paramètres et enums

### Question 34

Une route est déclarée `#[Route('/blog/{slug:post}')]` sur une action dont l'argument est `BlogPost $post`. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La syntaxe `{slug:post}` mappe le paramètre de route `slug` vers l'argument `$post`
- [ ] **B.** Le « param converter » cherche le `BlogPost` en base de données via son `slug`
- [ ] **C.** Si aucun objet n'est trouvé, Symfony génère automatiquement une réponse 404
- [ ] **D.** La partie `post` est une regex de validation appliquée au paramètre `slug`

### Question 35

Deux entités doivent être chargées chacune par son champ `name`. Quelle est la bonne syntaxe ? *(une seule bonne réponse)*

- [ ] **A.** `#[Route('/search-book/{name:author}/{name:category}')]`
- [ ] **B.** `#[Route('/search-book/{authorName:author.name}/{categoryName:category.name}')]`
- [ ] **C.** `#[Route('/search-book/{author.name}/{category.name}')]`
- [ ] **D.** Aucune : ce cas exige obligatoirement l'attribut `#[MapEntity]`

### Question 36

Quelles affirmations sur les backed enums PHP utilisés comme paramètres de route sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony les convertit automatiquement vers leur valeur scalaire
- [ ] **B.** Il faut écrire un value resolver personnalisé pour les supporter
- [ ] **C.** L'argument peut avoir une valeur par défaut, ex. `OrderStatusEnum $status = OrderStatusEnum::Paid`
- [ ] **D.** Seuls les enums adossés à des chaînes (`string`) sont supportés

## Paramètres spéciaux et paramètres extra

### Question 37

Lesquels de ces paramètres sont des paramètres spéciaux créés par Symfony ? *(plusieurs bonnes réponses)*

- [ ] **A.** `_controller`
- [ ] **B.** `_method`
- [ ] **C.** `_locale`
- [ ] **D.** `_format`

### Question 38

Que fait le paramètre spécial `_format` ? *(une seule bonne réponse)*

- [ ] **A.** Il force l'extension de fichier dans les URLs générées
- [ ] **B.** Il sélectionne le sérialiseur utilisé pour la réponse
- [ ] **C.** Il définit le « request format » de l'objet `Request`, utilisé notamment pour le `Content-Type` de la réponse (ex. `json` → `application/json`)
- [ ] **D.** Il définit le format d'affichage des dates dans les templates

### Question 39

Quels paramètres spéciaux disposent d'une option d'attribut équivalente « sans underscore » ? *(plusieurs bonnes réponses)*

- [ ] **A.** `_locale`, via `locale: 'en'`
- [ ] **B.** `_format`, via `format: 'html'`
- [ ] **C.** `_query`, via `query: ['page' => 1]`
- [ ] **D.** `_fragment`, via `fragment: 'top'`

### Question 40

Une route déclare `defaults: { title: 'Hello world!' }` alors que `{title}` n'apparaît pas dans son path. Que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Symfony lève une erreur « paramètre inconnu »
- [ ] **B.** La valeur est ignorée silencieusement
- [ ] **C.** La valeur est ajoutée en query string aux URLs générées
- [ ] **D.** La valeur est passée au contrôleur comme argument `$title` (paramètre « extra »)

### Question 41

À quoi sert le paramètre spécial `_query` ? *(une seule bonne réponse)*

- [ ] **A.** À lire la query string de la requête courante depuis le contrôleur
- [ ] **B.** À définir un tableau de paramètres de query string ajoutés à l'URL générée
- [ ] **C.** À contraindre la query string lors du matching de la route
- [ ] **D.** À exclure certains paramètres de la query string générée

## Slashes dans les paramètres

### Question 42

Le paramètre `{token}` de la route `/share/{token}` doit pouvoir contenir des `/`. Quelle est la bonne solution ? *(une seule bonne réponse)*

- [ ] **A.** Rien à faire : les paramètres acceptent le caractère `/` par défaut
- [ ] **B.** Ajouter `allow_slash: true` à la définition de la route
- [ ] **C.** Ajouter le requirement permissif `requirements: ['token' => '.+']`
- [ ] **D.** C'est impossible, le `/` étant réservé au découpage des URLs

### Question 43

La route est `/share/{token}.{_format}` et `token` doit accepter des slashes. Quel requirement la documentation recommande-t-elle pour `token` ? *(une seule bonne réponse)*

- [ ] **A.** `[^.]+` — tout caractère sauf le point
- [ ] **B.** `.+` — tout caractère
- [ ] **C.** `.*` — tout caractère, y compris rien
- [ ] **D.** `\S+` — tout caractère non blanc

## Alias de routes

### Question 44

Quelles sont les bonnes syntaxes parmi celles-ci pour créer un alias `product_details` de la route `product_show` ? *(plusieurs bonnes réponses)*

- [ ] **A.** En YAML :

  ```yaml
  product_details:
      alias: product_show
  ```
- [ ] **B.** En attribut : `#[Route('/product/{id}', name: 'product_show', alias: ['product_details'])]`
- [ ] **C.** En YAML :

  ```yaml
  product_details:
      alias_of: product_show
  ```
- [ ] **D.** En attribut : `#[RouteAlias('product_details', of: 'product_show')]`

### Question 45

Vous voulez créer un alias d'une route définie par un bundle tiers (une route « que vous ne possédez pas »). Quels formats le permettent ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les fichiers YAML
- [ ] **B.** Les attributs PHP
- [ ] **C.** Les fichiers PHP
- [ ] **D.** Aucun : seul le bundle propriétaire peut aliaser ses routes

### Question 46

Quelles affirmations sur la dépréciation d'un alias de route sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** En YAML, on ajoute la clé `deprecated` (avec `package` et `version`) sous la définition de l'alias
- [ ] **B.** En attribut, on utilise `alias: new DeprecatedAlias(aliasName: 'product_show', package: 'acme/package', version: '1.2')`
- [ ] **C.** Un message de dépréciation personnalisé doit contenir au moins une fois le placeholder `%alias_id%`
- [ ] **D.** La dépréciation se déclare sur la route concrète, pas sur l'alias

## Groupes de routes et préfixes

### Question 47

Soit cette configuration :

```php
#[Route('/blog', requirements: ['_locale' => 'en|es|fr'], name: 'blog_')]
class BlogController extends AbstractController
{
    #[Route('/{_locale}', name: 'index')]
    public function index(): Response
    {
        // ...
    }
}
```

Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** La route de `index()` s'appelle `blog_index`
- [ ] **B.** Son URL est `/blog/{_locale}`
- [ ] **C.** Le requirement `_locale` défini sur la classe s'applique aussi à cette route
- [ ] **D.** Son URL est `/{_locale}/blog`, le préfixe étant ajouté à la fin

### Question 48

Quelles options sont disponibles lors de l'import de routes (ex. clé `controllers` de `config/routes.yaml`) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `prefix` — ajouté au début de toutes les URLs importées
- [ ] **B.** `name_prefix` — ajouté au début de tous les noms de routes importés
- [ ] **C.** `exclude` — exclure des fichiers/sous-dossiers du chargement des attributs
- [ ] **D.** `suffix` — ajouté à la fin de toutes les URLs importées

### Question 49

Des routes sont importées avec `prefix: '/blog'`. Que devient une route importée dont le path est vide ? *(une seule bonne réponse)*

- [ ] **A.** `/blog`, sans slash final
- [ ] **B.** `/blog/` (slash final ajouté) — évitable avec l'option `trailing_slash_on_root: false`
- [ ] **C.** Une erreur de configuration, un path vide étant interdit
- [ ] **D.** `/blog/index`

### Question 50

Dans quel cas l'option `exclude` d'un import de routes est-elle ignorée ? *(une seule bonne réponse)*

- [ ] **A.** Jamais : elle est toujours appliquée
- [ ] **B.** En environnement `prod`
- [ ] **C.** Quand `exclude` contient une expression régulière
- [ ] **D.** Quand la valeur de `resource` est une chaîne simple et non un motif glob

## Route courante

### Question 51

Quelles sont les bonnes méthodes parmi celles-ci pour récupérer le nom de la route courante et ses paramètres ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans un contrôleur : `$request->attributes->get('_route')`
- [ ] **B.** Dans un contrôleur : `$request->attributes->get('_route_params')`
- [ ] **C.** Dans un template Twig : `app.current_route` et `app.current_route_parameters`
- [ ] **D.** Dans un contrôleur : `$request->query->get('_route')`

## Routes spéciales et redirections

### Question 52

Quelles affirmations sur le `RedirectController` de Symfony sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le default `route` permet de rediriger vers une autre route (avec d'éventuels arguments)
- [ ] **B.** Le default `path` accepte un chemin absolu ou une URL absolue
- [ ] **C.** Les redirections sont temporaires (302) par défaut ; `permanent: true` les rend permanentes (301)
- [ ] **D.** `keepRequestMethod: true` change les codes : 307 au lieu de 302, 308 au lieu de 301

### Question 53

La route définit le path `/foo`. Quelles affirmations sur les slashes finaux sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une requête `GET /foo/` provoque une redirection `301` vers `/foo`
- [ ] **B.** Cette redirection s'applique aussi aux requêtes `POST`
- [ ] **C.** Cette redirection ne s'applique qu'aux requêtes `GET` et `HEAD`
- [ ] **D.** Ce comportement est automatique, sans configuration à activer

## Routing par sous-domaine

### Question 54

Quelle option d'une route exige que le host HTTP de la requête corresponde à `m.example.com` ? *(une seule bonne réponse)*

- [ ] **A.** `domain: 'm.example.com'`
- [ ] **B.** `subdomain: 'm'`
- [ ] **C.** `host: 'm.example.com'`
- [ ] **D.** `server: 'm.example.com'`

### Question 55

Quelles affirmations sur l'option `host` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le host peut contenir des paramètres, ex. `host: '{subdomain}.example.com'`
- [ ] **B.** Ces paramètres peuvent être validés via `requirements`
- [ ] **C.** Donner une valeur par défaut à `subdomain` évite de devoir la fournir à chaque génération d'URL
- [ ] **D.** La syntaxe en ligne est utilisable dans le host : `{subdomain<m|mobile>?m}.example.com`

### Question 56

En tests fonctionnels, que faut-il faire pour qu'une route restreinte au host `m.example.com` matche ? *(une seule bonne réponse)*

- [ ] **A.** Passer le header : `$client->request('GET', '/', [], [], ['HTTP_HOST' => 'm.example.com'])`
- [ ] **B.** Rien : le host est ignoré dans l'environnement de test
- [ ] **C.** Configurer `framework.test.host` dans `config/packages/test/framework.yaml`
- [ ] **D.** Mocker le service `RequestContext`

## Routes localisées (i18n)

### Question 57

Quelle est la bonne syntaxe pour déclarer une route localisée en attribut ? *(une seule bonne réponse)*

- [ ] **A.** `#[Route('/about-us', translations: ['nl' => '/over-ons'])]`
- [ ] **B.** `#[Route(en: '/about-us', nl: '/over-ons', name: 'about_us')]`
- [ ] **C.** Déclarer deux attributs `#[Route]` avec le même nom, un par locale
- [ ] **D.**

  ```php
  #[Route(path: [
      'en' => '/about-us',
      'nl' => '/over-ons',
  ], name: 'about_us')]
  ```

### Question 58

Quelles affirmations sur les routes localisées sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Quand une route localisée matche, Symfony utilise automatiquement cette locale pendant toute la requête
- [ ] **B.** On peut ajouter un path sans clé de locale, utilisé pour toute locale non listée
- [ ] **C.** À l'import, on peut préfixer les URLs par locale : `prefix: { en: '', nl: '/nl' }`
- [ ] **D.** Une route définissant `locale: 'en'`, importée avec les préfixes `en` et `nl`, est disponible dans les deux locales

### Question 59

Quelle est la bonne méthode pour servir le site sur un domaine différent par locale ? *(une seule bonne réponse)*

- [ ] **A.** À l'import des routes :

  ```yaml
  controllers:
      resource: routing.controllers
      host:
          en: 'www.example.com'
          nl: 'www.example.nl'
  ```
- [ ] **B.** Déclarer `domains: { en: ..., nl: ... }` dans `config/packages/translation.yaml`
- [ ] **C.** Déployer un kernel distinct par domaine
- [ ] **D.** C'est impossible : une application Symfony n'a qu'un seul host

## Routes stateless

### Question 60

Une route est déclarée avec `stateless: true` mais la session est quand même utilisée pendant la requête. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'option déclare que la session ne devrait pas être utilisée lors du matching de cette route
- [ ] **B.** Si `kernel.debug` est activé, Symfony lève une `UnexpectedSessionUsageException`
- [ ] **C.** Si `kernel.debug` est désactivé, Symfony écrit un warning dans les logs
- [ ] **D.** La session est rendue inaccessible : toute tentative d'accès retourne `null`

## Génération d'URLs

### Question 61

Une route est déclarée sans option `name`. Que fait Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Il lève une exception : le nom est obligatoire
- [ ] **B.** Il utilise le path comme nom de route
- [ ] **C.** Il génère un nom automatique basé sur le contrôleur et l'action
- [ ] **D.** La route fonctionne au matching mais ne peut pas servir à générer des URLs

### Question 62

Quelles affirmations sur les alias de routes basés sur le FQCN sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Toute méthode qui définit exactement une route reçoit un alias du type `App\Controller\MainController::homepage`
- [ ] **B.** Une classe invokable qui ajoute exactement une route reçoit un alias correspondant à son FQCN
- [ ] **C.** Ces alias doivent être déclarés manuellement dans `config/routes.yaml`
- [ ] **D.** `debug:router --show-aliases` permet de les afficher

### Question 63

Dans un contrôleur héritant d'`AbstractController`, quelle est la bonne méthode pour générer une URL **absolue** vers la route `sign_up` ? *(une seule bonne réponse)*

- [ ] **A.** `$this->generateUrl('sign_up', ['_absolute' => true])`
- [ ] **B.** `$this->generateUrl('sign_up', [], true)`
- [ ] **C.** `$this->absoluteUrl('sign_up')`
- [ ] **D.** `$this->generateUrl('sign_up', [], UrlGeneratorInterface::ABSOLUTE_URL)`

### Question 64

La route `blog` ne définit que le paramètre `{page}`. Que génère `$this->generateUrl('blog', ['page' => 2, 'category' => 'Symfony'])` ? *(une seule bonne réponse)*

- [ ] **A.** `/blog/2?category=Symfony` — les paramètres hors route partent en query string
- [ ] **B.** `/blog/2/Symfony`
- [ ] **C.** Une exception « paramètre inconnu : category »
- [ ] **D.** `/blog/2` — `category` est ignoré

### Question 65

Quelles affirmations sur les objets passés à la génération d'URLs sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Utilisés comme valeur d'un placeholder de la route, ils sont convertis en chaîne
- [ ] **B.** Utilisés comme paramètre extra, ils sont aussi convertis automatiquement en chaîne
- [ ] **C.** Pour un paramètre extra (ex. un `Uuid`), il faut caster explicitement : `(string) $entity->getUuid()`
- [ ] **D.** Les objets sont interdits, même comme valeur de placeholder

### Question 66

Quelle est la bonne méthode documentée pour générer des URLs dans un service ? *(une seule bonne réponse)*

- [ ] **A.** Faire hériter le service d'`AbstractController` pour profiter de `generateUrl()`
- [ ] **B.** Injecter la `RequestStack` et appeler `getCurrentRequest()->generateUrl()`
- [ ] **C.** Injecter `UrlGeneratorInterface` (le service `router`) et appeler sa méthode `generate()`
- [ ] **D.** Lancer une sous-requête au kernel HTTP

### Question 67

À la génération d'une URL vers une route localisée, quelle locale Symfony utilise-t-il ? *(une seule bonne réponse)*

- [ ] **A.** La locale de la requête courante par défaut ; on peut en imposer une autre en passant un paramètre `_locale`
- [ ] **B.** Toujours la `default_locale` de la configuration
- [ ] **C.** La locale du navigateur, lue dans le header `Accept-Language`
- [ ] **D.** Aucune par défaut : le paramètre `_locale` est obligatoire à chaque appel

### Question 68

Quelles affirmations sur la génération d'URLs en JavaScript sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans un template Twig, on peut stocker `{{ path('blog_show', {slug: 'my-blog-post'})|escape('js') }}` dans une variable JavaScript
- [ ] **B.** Pour du JavaScript pur ou des URLs dynamiques, la documentation renvoie vers le FOSJsRoutingBundle
- [ ] **C.** Symfony expose nativement toutes les routes dans un objet global `window.SymfonyRoutes`
- [ ] **D.** Il suffit d'importer `{ path } from '@symfony/routing'` dans son fichier JS

### Question 69

Dans une commande console, les URLs absolues sont générées avec `http://localhost/` comme host. Quelle est la solution documentée ? *(une seule bonne réponse)*

- [ ] **A.** C'est impossible à changer hors contexte HTTP
- [ ] **B.** Injecter l'objet `Request` dans la commande
- [ ] **C.** Passer l'option `--host` à `bin/console`
- [ ] **D.** Configurer le « request context » :

  ```yaml
  # config/packages/routing.yaml
  framework:
      router:
          default_uri: 'https://example.org/my/path/'
  ```

### Question 70

Hors contexte HTTP (commandes…), quelle valeur de `_locale` est utilisée pour les routes localisées ? *(une seule bonne réponse)*

- [ ] **A.** `en`, en dur
- [ ] **B.** La locale du système d'exploitation
- [ ] **C.** La `default_locale` configurée — surchargeable en passant un `_locale` à chaque génération
- [ ] **D.** Aucune : une exception est levée

### Question 71

Quelle est la bonne méthode documentée pour vérifier qu'une route existe avant de générer son URL ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `$router->getRouteCollection()->get($routeName)`
- [ ] **B.** Tenter la génération et attraper la `RouteNotFoundException`
- [ ] **C.** Appeler `$router->has($routeName)`
- [ ] **D.** Lister les routes au runtime via la commande `debug:router`

### Question 72

La route `login` est déclarée avec `schemes: ['https']`. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les URLs générées pour cette route utilisent toujours HTTPS
- [ ] **B.** `path('login')` peut retourner une URL absolue si la requête courante est en HTTP
- [ ] **C.** Une requête entrante en HTTP sur `/login` est automatiquement redirigée vers la même URL en HTTPS
- [ ] **D.** Le scheme n'est vérifié qu'à la génération d'URL, jamais au matching

### Question 73

En Symfony 8.0, quels moyens la documentation donne-t-elle pour définir le scheme/contexte des URLs générées dans les commandes console ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le paramètre de container `router.request_context.scheme: 'https'`
- [ ] **B.** L'option de configuration `framework.router.default_uri`
- [ ] **C.** Par commande, via la méthode `getContext()` du router
- [ ] **D.** L'option `--scheme=https` de `bin/console`

## URIs signées

### Question 74

Que fait la méthode `sign()` du service `UriSigner` ? *(une seule bonne réponse)*

- [ ] **A.** Elle ajoute un paramètre de query string `_signature` à l'URL
- [ ] **B.** Elle ajoute un header HTTP `X-Signature` à la réponse
- [ ] **C.** Elle ajoute un paramètre de query string `_hash` à l'URL
- [ ] **D.** Elle chiffre l'URL complète en AES

### Question 75

Quels types accepte l'argument `$expiration` de `UriSigner::sign()` pour faire expirer une URI signée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un objet date, ex. `new \DateTimeImmutable('2050-01-01')`
- [ ] **B.** Un `\DateInterval` (durée à partir de maintenant), ex. `new \DateInterval('PT10S')`
- [ ] **C.** Un timestamp Unix (entier), ex. `4070908800`
- [ ] **D.** Une chaîne relative, ex. `'+10 seconds'`

### Question 76

Quelle est la différence entre `check()` et `verify()` du `UriSigner` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune : `verify()` est un simple alias de `check()`
- [ ] **B.** `check()` lève des exceptions, `verify()` retourne un booléen
- [ ] **C.** `verify()` ne prend pas en compte l'expiration de l'URI
- [ ] **D.** `verify()` lève des exceptions expliquant pourquoi la signature est invalide ; `check()` retourne un booléen

### Question 77

Quelles exceptions `UriSigner::verify()` peut-elle lever ? *(plusieurs bonnes réponses)*

- [ ] **A.** `UnsignedUriException` — l'URI n'est pas signée
- [ ] **B.** `ExpiredSignedUriException` — l'URI est signée mais expirée
- [ ] **C.** `UnverifiedSignedUriException` — l'URI est signée mais la signature est invalide
- [ ] **D.** `InvalidSignatureException` — la signature est mal formée

### Question 78

Quelles affirmations sur l'attribut `#[IsSignatureValid]` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il valide déclarativement la signature des requêtes entrantes, sans appeler `check()`/`verify()` soi-même
- [ ] **B.** Il peut s'appliquer au niveau de la classe pour couvrir toutes les actions du contrôleur
- [ ] **C.** Son option `methods` limite la validation à certaines méthodes HTTP, ex. `#[IsSignatureValid(methods: ['POST', 'PUT'])]`
- [ ] **D.** Il est fourni par le composant Routing

## Dépannage

### Question 79

Vous obtenez l'erreur : *« Controller "App\Controller\BlogController::show()" requires that you provide a value for the "$slug" argument »*. Quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Cause probable : le path de la route ne contient pas de paramètre `{slug}`
- [ ] **B.** Solution possible : ajouter `{slug}` au path, ex. `/blog/show/{slug}`
- [ ] **C.** Solution possible : donner une valeur par défaut à l'argument, ex. `$slug = null`
- [ ] **D.** Cause probable : le cache de routing est corrompu, il faut le vider

### Question 80

Vous obtenez l'erreur : *« Some mandatory parameters are missing ("slug") to generate a URL for route "blog_show" »*. Quelle est la bonne solution ? *(une seule bonne réponse)*

- [ ] **A.** Passer la valeur à la génération : `$this->generateUrl('blog_show', ['slug' => 'slug-value'])` ou `{{ path('blog_show', {slug: 'slug-value'}) }}`
- [ ] **B.** Vider le cache de routing avec `cache:clear`
- [ ] **C.** Utiliser `url()` au lieu de `path()` dans le template
- [ ] **D.** Déclarer `slug` dans les `requirements` de la route

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Routing de la documentation Symfony 8.0](https://symfony.com/doc/8.0/routing.html).

**Question 1 : A, B, D** — « Routes can be configured in YAML, PHP or using attributes. » Les annotations PHPDoc ne sont plus supportées depuis longtemps ; seuls les attributs PHP natifs le sont. *(§ Creating Routes)*

**Question 2 : C** — « Symfony recommends attributes because it's convenient to put the route and controller in the same place. » Le piège de D : la doc précise que tous les formats offrent les mêmes fonctionnalités et les mêmes performances. *(§ Creating Routes)*

**Question 3 : B** — `Symfony\Component\Routing\Attribute\Route` est la classe utilisée dans tous les exemples. `Annotation\Route` (A) est l'ancien namespace des annotations, et D vient du défunt SensioFrameworkExtraBundle. *(§ Creating Routes as Attributes)*

**Question 4 : D** — Sans Flex, il faut créer `config/routes.yaml` avec `controllers: { resource: routing.controllers }`, ce qui « tells Symfony to look for `#[Route]` attributes across your application ». *(§ Creating Routes as Attributes)*

**Question 5 : A, B** — « The query string of a URL is not considered when matching routes » : `/blog?foo=bar&bar=foo` matche donc aussi. `/blog/1` est un autre path, et `/BLOG` ne correspond pas au path déclaré (la comparaison est exacte). *(§ Creating Routes as Attributes)*

**Question 6 : A** — Warning explicite de la doc : « If you define multiple PHP classes in the same file, Symfony only loads the routes of the first class, ignoring all the other routes. » *(§ Creating Routes as Attributes)*

**Question 7 : C** — Même warning : « The route attribute always wins over routes defined in YAML or PHP files and Symfony will always load the route attribute. » *(§ Creating Routes as Attributes)*

**Question 8 : B** — Les clés sont `path` et `controller`, au format `'controller_class::method_name'` (deux fois deux-points). La forme tableau `[classe, méthode]` (C) est celle du format **PHP**, pas du YAML. *(§ Creating Routes in YAML or PHP Files)*

**Question 9 : A** — « If the action is implemented as the `__invoke()` method of the controller class, you can skip the `::method_name` part. » *(§ Creating Routes in YAML or PHP Files)*

**Question 10 : D** — « By default, routes match any HTTP verb (`GET`, `POST`, `PUT`, etc.) » — d'où l'intérêt de l'option `methods`. *(§ Matching HTTP Methods)*

**Question 11 : A, B** — En attributs, `methods` prend un tableau ; en YAML, la forme `GET|HEAD` est utilisée dans la doc. L'option au singulier `method` (C) et `verbs` (D) n'existent pas. *(§ Matching HTTP Methods)*

**Question 12 : A, B, C** — Tip de la doc : formulaires HTML limités à `GET`/`POST` ; champ caché `_method` pour outrepasser ; Symfony Forms le fait automatiquement si `framework.http_method_override` vaut `true` (et `framework.allowed_http_method_override` permet de restreindre les méthodes autorisées). D est faux : le navigateur enverra du `GET`/`POST`. *(§ Matching HTTP Methods)*

**Question 13 : A, B** — L'option `env` de l'attribut (qui accepte aussi un tableau : `env: ['dev', 'test']`) et la clé `when@dev:` en YAML. `only` et `defaults: { env: … }` n'existent pas. *(§ Matching Environments)*

**Question 14 : A, B, D** — Les trois variables documentées : `context` (`RequestContext`), `request` (l'objet `Request`) et `params` (paramètres de la route matchée). Pas de variable `session`. *(§ Matching Expressions)*

**Question 15 : A, C** — Les deux fonctions documentées : `env(string $name)` et `service(string $alias)`. Les paramètres de configuration s'utilisent via la syntaxe `%…%` directement dans l'expression, pas via une fonction `param()`. *(§ Matching Expressions)*

**Question 16 : A, C** — « Add the `#[AsRoutingConditionService]` attribute or `routing.condition_service` tag to the services that you want to use in route conditions. » *(§ Matching Expressions)*

**Question 17 : A, C, D** — Les expressions sont « compiled down to raw PHP » (pas de surcoût), peuvent inclure des paramètres `%…%` et lire `params`. B est le piège inverse du warning : « Conditions are *not* taken into account when generating URLs. » *(§ Matching Expressions)*

**Question 18 : B** — `debug:router` « lists all your application routes in the same order in which Symfony evaluates them ». On peut aussi lui passer un nom (ou partie de nom) de route pour voir ses détails. *(§ Debugging Routes)*

**Question 19 : A, C, D** — `--show-controllers`, `--show-aliases` et `--method` existent en 8.0. Piège : `--sort` n'a été introduite qu'en **Symfony 8.1**. *(§ Debugging Routes)*

**Question 20 : C** — `router:match` « shows which route will match the given URL ». `debug:router` prend un nom de route, pas une URL. *(§ Debugging Routes)*

**Question 21 : B** — « In Symfony routes, variable parts are wrapped in `{ }` » : `/blog/{slug}`. *(§ Route Parameters)*

**Question 22 : A, B, C** — « Routes can define any number of parameters, but each of them can only be used once on each route. » D est faux : un paramètre peut cohabiter avec du texte statique dans un segment (ex. `posts-about-{category}`, ou `{title}.{_format}`). *(§ Route Parameters)*

**Question 23 : D** — Sans requirements, les deux routes matchent : « Symfony will use the route which was defined first » — ici `blog_list`, avec `$page = 'my-first-post'`. C'est tout l'intérêt d'ajouter `requirements: ['page' => '[0-9]+']`. *(§ Parameters Validation)*

**Question 24 : A, B, C** — Regex classique, requirement en ligne `{page<[0-9]+>}`, ou constante `Requirement::DIGITS` (`Symfony\Component\Routing\Requirement\Requirement`). Le typage PHP de l'argument (D) n'influence pas le matching. *(§ Parameters Validation)*

**Question 25 : A** — En YAML, on référence une constante PHP avec le tag `!php/const Symfony\Component\Routing\Requirement\Requirement::DIGITS`. *(§ Parameters Validation)*

**Question 26 : A, B, C** — Les requirements sont des « PHP regular expressions », peuvent inclure des paramètres de configuration et supportent les propriétés Unicode PCRE (`\p{Lu}`, `\p{Greek}`…). La query string n'est jamais prise en compte au matching. *(§ Parameters Validation)*

**Question 27 : A, B, C** — En attributs, « default values are defined in the arguments of the controller action » ; sinon option `defaults` (avec un « s ») ; et la forme en ligne `{page?1}`. *(§ Optional Parameters)*

**Question 28 : C** — Requirements et défauts en ligne sont combinables dans un même paramètre : `{page<[0-9]+>?1}` = regex `[0-9]+` + défaut `1`. *(§ Optional Parameters)*

**Question 29 : B** — « To give a `null` default value to any parameter, add nothing after the `?` character. » Il faut alors accepter `null` dans le contrôleur (`?int $page`). *(§ Optional Parameters)*

**Question 30 : A, C, D** — Warning : « everything after an optional parameter must be optional » ; dans `/{page}/blog`, `page` « will always be required » (B faux) ; on peut avoir plusieurs paramètres optionnels ; et tip : « The default value is allowed to not match the requirement. » *(§ Optional Parameters)*

**Question 31 : D** — « If you want to always include some default value in the generated URL […] add the `!` character before the parameter name. » Ne concerne que la génération d'URL, pas le matching. *(§ Optional Parameters)*

**Question 32 : A, B, C, D** — Les quatre sont vraies : entier, défaut `0`, « routes with higher priority are sorted before routes with lower priority », et en YAML/PHP c'est l'ordre des définitions dans le fichier qui prime (l'option `priority` vise surtout les attributs, où réordonner est difficile). *(§ Priority Parameter)*

**Question 33 : A** — L'exemple de la doc : la route greedy `/blog/{slug}` est définie avant, `/blog/list` « could not be matched without defining a higher priority than 0 » → `priority: 2`. *(§ Priority Parameter)*

**Question 34 : A, B, C** — `{slug:post}` « maps the route parameter named `slug` to the controller argument named `$post` » et « hints the param converter » (requête en base via le slug, 404 automatique si introuvable). Ce n'est pas une regex — ça, c'est `{slug<…>}`. *(§ Parameter Conversion)*

**Question 35 : B** — Un nom de paramètre ne peut pas être déclaré deux fois (A) ; la syntaxe `{authorName:author.name}` donne des noms uniques tout en chargeant chaque entité par son champ `name`. `#[MapEntity]` (D) sert aux mappings plus avancés mais n'est pas obligatoire ici. *(§ Parameter Conversion)*

**Question 36 : A, C** — « Symfony will convert them automatically to their scalar values » — aucun resolver custom requis, et l'exemple de la doc montre un défaut `OrderStatusEnum $status = OrderStatusEnum::Paid`. Les backed enums `int` comme `string` sont concernés. *(§ Backed Enum Parameters)*

**Question 37 : A, C, D** — Les paramètres spéciaux documentés : `_controller`, `_format`, `_fragment`, `_locale` et `_query`. `_method` (B) n'en fait pas partie — c'est le nom du champ caché de formulaire pour surcharger la méthode HTTP. *(§ Special Parameters)*

**Question 38 : C** — « The matched value is used to set the "request format" of the `Request` object […] e.g. a `json` format translates into a `Content-Type` of `application/json`. » *(§ Special Parameters)*

**Question 39 : A, B, C** — Symfony définit des options « with the same name (except for the leading underscore) » : `locale`, `format` et `query`. `_fragment` est justement l'exception : il ne peut pas être défini dans les routes/imports (il s'utilise à la génération d'URL). *(§ Special Parameters)*

**Question 40 : D** — Ce sont les « extra parameters » : les `defaults` absents du path sont passés en arguments au contrôleur. *(§ Extra Parameters)*

**Question 41 : B** — « `_query`: An array of query parameters to add to the generated URL. » Il agit à la génération d'URL, pas au matching ni en lecture. *(§ Special Parameters)*

**Question 42 : C** — « Route parameters can contain any values except the `/` slash character. » La solution : un requirement plus permissif, `.+`. *(§ Slash Characters in Route Parameters)*

**Question 43 : A** — Avec `.+`, `/share/foo/bar.json` mettrait `foo/bar.json` dans `token` et laisserait `_format` vide. « This can be solved by replacing the `.+` requirement by `[^.]+` to allow any character except dots. » *(§ Slash Characters in Route Parameters)*

**Question 44 : A, B** — En YAML, une entrée dont la seule option est `alias: product_show` ; en attribut, l'argument `alias: ['product_details']`. `alias_of` et `#[RouteAlias]` n'existent pas. *(§ Route Aliasing)*

**Question 45 : A, C** — « YAML and PHP configuration formats are the only ways to define an alias for a route that you do not own. You can't do this when using PHP attributes. » L'alias et la route d'origine n'ont pas besoin d'être déclarés dans le même fichier ni le même format. *(§ Route Aliasing)*

**Question 46 : A, B, C** — La clé `deprecated` (avec `package`, `version` et éventuellement `message`) se place **sous l'alias**, pas sous la route concrète (D faux) ; en attribut on passe un objet `DeprecatedAlias` ; et « You **must** have at least one occurrence of the `%alias_id%` placeholder » dans un message personnalisé. *(§ Deprecating Route Aliases)*

**Question 47 : A, B, C** — Le `#[Route]` de classe fournit le préfixe d'URL (`/blog`), le préfixe de nom (`blog_` → `blog_index`) et les requirements partagés : « Both routes will also validate that the `_locale` parameter matches the regular expression defined in the class attribute. » *(§ Route Groups and Prefixes)*

**Question 48 : A, B, C** — `prefix`, `name_prefix` et `exclude` sont documentés (avec aussi `requirements`, `trailing_slash_on_root`, `host`, `schemes`…). `suffix` n'existe pas. *(§ Route Groups and Prefixes)*

**Question 49 : B** — « If any of the prefixed routes defines an empty path, Symfony adds a trailing slash to it » → `/blog/`. L'option `trailing_slash_on_root: false` (indisponible en attributs) désactive ce comportement. *(§ Route Groups and Prefixes)*

**Question 50 : D** — Warning : « The `exclude` option only works when the `resource` value is a glob string. If you use a regular string (e.g. `'../src/Controller'`) the `exclude` value will be ignored. » *(§ Route Groups and Prefixes)*

**Question 51 : A, B, C** — La config de routing est stockée dans les « request attributes » : `_route` et `_route_params` via `$request->attributes`, et en Twig `app.current_route` / `app.current_route_parameters`. La query string (D) n'a rien à voir. *(§ Getting the Route Name and Parameters)*

**Question 52 : A, B, C, D** — Les quatre sont vraies : `route` (redirection vers une route, avec arguments), `path` (chemin absolu ou URL absolue), 302 par défaut / `permanent: true` → 301, `keepRequestMethod: true` → 307/308. À connaître aussi : `keepQueryParams` et `ignoreAttributes`. *(§ Redirecting to URLs and Routes Directly from a Route)*

**Question 53 : A, C, D** — Symfony redirige entre URL avec et sans slash final « but only for `GET` and `HEAD` requests », en `301`, automatiquement. *(§ Redirecting URLs with Trailing Slashes)*

**Question 54 : C** — « Routes can configure a `host` option to require that the HTTP host of the incoming requests matches some specific value. » *(§ Sub-Domain Routing)*

**Question 55 : A, B, C, D** — Les quatre sont vraies : host paramétrable (`{subdomain}.example.com`), validable par `requirements`, défaut recommandé (« otherwise you need to include a subdomain value each time you generate a URL »), et syntaxe en ligne `{subdomain<m|mobile>?m}.example.com`. *(§ Sub-Domain Routing)*

**Question 56 : A** — « When using sub-domain routing, you must set the `Host` HTTP headers in functional tests or routes won't match » — d'où le 5ᵉ argument `['HTTP_HOST' => 'm.example.com']`. *(§ Sub-Domain Routing)*

**Question 57 : D** — « When using PHP attributes for localized routes, you have to use the `path` named parameter to specify the array of paths » : un tableau `locale => path`. *(§ Localized Routes (i18n))*

**Question 58 : A, B, C** — Locale appliquée automatiquement à toute la requête ; path « fallback » sans clé de locale possible ; préfixe par locale à l'import. D est l'inverse de la note : une route définissant `locale: 'en'` n'est importée **que** pour cette locale. *(§ Localized Routes (i18n))*

**Question 59 : A** — « This can be done by defining a different host for each locale » dans l'import des routes. *(§ Localized Routes (i18n))*

**Question 60 : A, B, C** — `stateless: true` déclare que la session ne doit pas être utilisée. Si elle l'est quand même : exception `UnexpectedSessionUsageException` quand `kernel.debug` est activé, simple warning en logs sinon. La session n'est pas « désactivée » pour autant (D faux). *(§ Stateless Routes)*

**Question 61 : C** — « If you don't set the route name explicitly with the `name` option, Symfony generates an automatic name based on the controller and action. » *(§ Generating URLs)*

**Question 62 : A, B, D** — Symfony ajoute automatiquement un alias `Fqcn::méthode` pour toute méthode définissant exactement une route, et un alias FQCN pour une classe invokable qui ajoute exactement une route. Rien à déclarer manuellement, et `debug:router --show-aliases` les affiche. *(§ Generating URLs / § Debugging Routes)*

**Question 63 : D** — « Generated URLs are "absolute paths" by default. Pass a third optional argument to generate different URLs » : `UrlGeneratorInterface::ABSOLUTE_URL`. Le booléen en 3ᵉ argument (B) est une syntaxe d'un autre âge. *(§ Generating URLs in Controllers)*

**Question 64 : A** — « If you pass […] some parameters that are not part of the route definition, they are included in the generated URL as a query string » → `/blog/2?category=Symfony`. *(§ Generating URLs in Controllers)*

**Question 65 : A, C** — Warning : « While objects are converted to string when used as placeholders, they are not converted when used as extra parameters » — d'où le cast explicite `(string) $entity->getUuid()` pour un paramètre extra. *(§ Generating URLs in Controllers)*

**Question 66 : C** — « Inject the `router` Symfony service into your own services and use its `generate()` method », en type-hintant `UrlGeneratorInterface` pour l'autowiring. *(§ Generating URLs in Services)*

**Question 67 : A** — « When a route is localized, Symfony uses by default the current request locale. Pass a different `_locale` value if you want to set the locale explicitly. » *(§ Generating URLs in Controllers)*

**Question 68 : A, B** — Dans un template Twig : `path()`/`url()` + filtre `|escape('js')`. « If you need to generate URLs dynamically or if you are using pure JavaScript code […] consider using the FOSJsRoutingBundle. » C et D n'existent pas. *(§ Generating URLs in JavaScript)*

**Question 69 : D** — Les commandes ne s'exécutent pas dans le contexte HTTP : « The solution is to configure the `default_uri` option to define the "request context" used by commands. » *(§ Generating URLs in Commands)*

**Question 70 : C** — « By default, routes generated outside the HTTP context use the default locale as the value of the `_locale` parameter », surchargeable au cas par cas. *(§ Generating URLs in Commands)*

**Question 71 : B** — « Don't use the `getRouteCollection()` method because that regenerates the routing cache and slows down the application. » À la place : tenter `generate()` et attraper `RouteNotFoundException`. `$router->has()` n'existe pas. *(§ Checking if a Route Exists)*

**Question 72 : A, B, C** — URLs générées toujours en HTTPS ; `path()` peut produire une URL absolue si le scheme courant diffère ; et « The scheme requirement is also enforced for incoming requests » → redirection automatique de HTTP vers HTTPS. D est donc faux. *(§ Forcing HTTPS on Generated URLs)*

**Question 73 : A, B, C** — En 8.0 : le paramètre de container `router.request_context.scheme` (accompagné d'`asset.request_context.secure` pour les assets), l'option `framework.router.default_uri`, ou `getContext()` par commande. Remarque : Symfony 8.1 déprécie les paramètres `router.request_context.*` au profit de `default_uri`. *(§ Forcing HTTPS on Generated URLs / § Generating URLs in Commands)*

**Question 74 : C** — `sign()` « adds a query parameter called `_hash` ». *(§ Signing URIs)*

**Question 75 : A, B, C** — L'argument `$expiration` accepte une date (`DateTimeImmutable`), un `DateInterval` ou un timestamp Unix ; l'échéance est embarquée dans l'URI via le paramètre `_expiration`. Par défaut, une URI signée n'expire pas. Pas de chaîne relative (D). *(§ Signing URIs — Expiring Signed URIs)*

**Question 76 : D** — « Use the `verify()` method instead of `check()` if you also want to know the reason(s) why a signature is not valid » : `verify()` lève des exceptions, `check()` (et `checkRequest()`) retournent un booléen. *(§ Signing URIs — Verifying Signed URIs)*

**Question 77 : A, B, C** — Les trois exceptions documentées : `UnsignedUriException` (non signée), `UnverifiedSignedUriException` (signature invalide), `ExpiredSignedUriException` (expirée). `InvalidSignatureException` n'existe pas. *(§ Signing URIs — Verifying Signed URIs)*

**Question 78 : A, B, C** — Validation déclarative des requêtes entrantes, applicable à l'action ou à toute la classe, avec l'option `methods`. L'attribut vient du composant **HttpKernel** (`Symfony\Component\HttpKernel\Attribute\IsSignatureValid`), pas du Routing. *(§ Signing URIs — Controller Attributes to Verify Signed URIs)*

**Question 79 : A, B, C** — L'erreur survient quand l'action a un argument (`$slug`) sans paramètre `{slug}` correspondant dans le path. Solutions documentées : ajouter `{slug}` au path, ou donner une valeur par défaut à l'argument. *(§ Troubleshooting)*

**Question 80 : A** — L'erreur signifie qu'on génère l'URL de `blog_show` sans fournir le paramètre obligatoire `slug` : il faut le passer à `generateUrl()` / `path()`. *(§ Troubleshooting)*

