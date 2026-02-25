---
title:          "Les controllers Symfony"
description:    "Où l'on réfléchit sur l'implémentation des controllers et des routes dans une application Symfony"
publishedAt:    "2026-02-23"
lastModified:   ~
tableOfContent: true
authors:        ["remij"]
tags:           ["Symfony","technique","tutoriel","réflexion"]
---

Voilà quelques années que j'utilise Symfony (juillet 2011, ça ne me rajeunit pas) et, ces derniers mois, je me rends compte que je n'ai presque jamais remis en cause certaines pratiques.

Dans cette série d'articles, je vais revenir sur différemment points du framework, ma manière de l'utiliser et vous présenter quelques idées de changements. Comme c'est un espace de réflexion et d'analyse, les retours sont bienvenus, que ce soit [par email](mailto:contact@remij.dev) ou sur [mon Mattermost](https://chat.remij.dev/signup_user_complete/?id=croru1qgqtgauy8z36yjqc835y).

## Utilisation des controllers aujourd'hui

### Autour de AbstractController

À l'heure actuelle, tous mes controllers étendent la classe AbstractController de Symfony. Une classe fort pratique, fournissant diverses méthodes utiles (redirections, construction de la réponse, gestion des templates, etc.), [recommandée par la documentation](https://symfony.com/doc/current/controller.html#the-base-controller-class-services).

Ma question là autour est : ai-je vraiment besoin d'injecter plein de services pour tous mes controllers ? Entre les attributs et l'injection de services (y compris de l'objet Request), ne pourrais-je pas les rendre plus légers en me passant de cet héritage ?


### Des controllers légers

Le but d'un controller restant, pour moi, de recevoir une requête et de renvoyer une réponse, tous les traitements réalisés au milieu doivent être gérés par un ou plusieurs autres services. Un controller est là pour orchestrer le tout, mais doit rester léger et lisible. Du coup, mes controllers se basent beaucoup sur l'injection de dépendances (que ce soit du niveau du constructeur ou directement de la méthode) pour fonctionner et rester léger.

Historiquement, j'ai mis beaucoup de choses dans mes actions (méthodes de controller) et me suis régulièrement retrouvé avec des controllers de plusieurs centaines de lignes (voir un bon millier), ce qui les rend très difficiles à relire et manipuler. En tant que services (parce que je les considère comme tels), ces controllers se retrouvent donc à faire nettement plus que leur travail initial de chef d'orchestre !

Une "astuce" que j'ai pu utiliser est la présence d'un "méga-service", très volumineux et contenant toute la logique pour un controller, mais ça n'est pas une solution qui me semble plus viable sur le long terme, mais c'est un autre sujet ;).


### Routing intégré

Ayant utilisé la configuration des routes au format `.yaml` pendant longtemps, je reviens aujourd'hui à la définition des routes par attributs et... c'est un soulagement pour moi !

C'est [ce que recommande la documentation de Symfony sur le routing](https://symfony.com/doc/current/routing.html) pour, justement, éviter d'avoir à gérer plusieurs fichiers lors de la mise en place d'une nouvelle url pour le site. Combiné avec un controller léger, ça permet d'avoir tous les éléments de gestion d'une requête et de construction de la réponse au même endroit, de manière assez synthétique.

Pour ne pas me répéter, j'ai tendance à [utiliser les préfixes, tant pour le chemin que pour les noms de route](https://symfony.com/doc/current/routing.html#route-groups-and-prefixes) sur la déclaration de la classe. Au moins, je ne répète pas d'informations et mon <abbr title="Integrated Development Environment ou Environnement de Développement Intégré en français">IDE</abbr> comprend ça très bien. Par contre, je trouve qu'on perd un peu en clarté : être obligé de regarder la définition de la classe pour voir les préfixes utilisés et avoir les informations complètes, ça n'est pas toujours idéal et peut mener à des confusions (dans les situations de stress, par exemple).

### Exemple succinct de Controller

Un exemple (classique) d'un controller pour gérer les pages d'un blog (j'enlève le contenu des actions, peu intéressant ici) :

```php
namespace App\Controller;

use App\Entity\Article;
use App\Handler\CommentHandler;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/blog', name: 'blog_')]
class BlogController extends AbstractController
{
    public function __construct(private readonly ArticleRepository $articleRepository) 
    {
    }
    
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        // Contenu de l'action
    }

    #[Route('/article/{slug}', name: 'show')]
    public function show(Article $article, CommentHandler $commentHandler, Request $request): Response
    {
        // Contenu de l'action
    }

    #[Route('/tag/{slug}', name: 'by_tag')]
    public function byTag(Tag $tag): Response
    {
        // Contenu de l'action
    }
}
```

Bien sûr, plusieurs éléments sont tout à fait discutables ici, je ne dis pas que c'est le controller "parfait", mais il résume plutôt bien ce vers quoi j'ai tendu ces dernières années en termes de concision et des questions que je me pose. 

En voici quelques-unes :

- Faut-il injecter `ArticleRepository` dans les deux actions qui en ont besoin ou au niveau du constructeur ? Dans un cas, je me répète, dans l'autre, j'ajoute un service inutile lorsque l'action `show()` est appelée.
- La lecture des routes est-elle assez claire ? Et si mon controller grandi ? Par exemple parce que j'ai beaucoup de [paramètres à mapper](https://symfony.com/doc/current/controller.html#automatic-mapping-of-the-request).
- Je profite de Doctrine pour récupérer automatiquement mes articles ou tags à partir de leur slug. Est-ce trop de magie ? Je fais ça depuis des années, mais si quelqu'un d'autre reprend le projet, est-ce suffisamment clair ? L'utilisation d'une [conversion plus explicite des paramètres](https://symfony.com/doc/current/routing.html#parameter-conversion) me semble plus appropriée.


## Des pistes pour l'avenir

### Un fichier par action

Ayant très souvent sous les yeux des controllers interminables (je parlais d'un millier de lignes tout à l'heure), je me dis qu'avoir chaque action dans son propre fichier ne ferait pas de mal. Ce qui est actuellement dans un seul controller se retrouverait alors dans un dossier (`src/Controller/Blog/` dans mon exemple ci-dessus) et j'aurais un fichier par action (`BlogIndexAction.php`, `BlogShowAction.php` et `BlogByTagAction.php` par exemple). Voir la [documentation sur les invokable controllers](https://symfony.com/doc/current/controller/service.html#invokable-controllers).

Le nom du dossier (et des sous-dossiers) permettraient de montrer le nom des routes plutôt clairement, à mes yeux (voir une bonne idée du chemin également).

### Un service presque comme un autre

Ainsi, chaque action est un service indépendant, pouvant récupérer les services nécessaires à son fonctionnement, sans injecter autant d'éléments qu'avec le `AbstractController`. Après, rien n'empêche de définir des actions abstraites que je pourrais étendre, pour les cas classiques de l'application. J'imagine un `AbstractFormAction` par exemple, pour me fournir les éléments classiques de gestion d'un formulaire (avec par exemple l'injection de la `FormFactory`, de `Twig` et d'autres services utiles). Entre les méthodes `__construct()` et `__invoke()`, je devrais pouvoir gérer facilement la plupart des cas de figure.

### Définition des routes

Autre avantage : une action = une route. La définition de cette route (au niveau de la classe ou de la méthode) permet à Symfony de reconnaitre un controller, ce qui est un gain de temps, même si [plusieurs moyens existent pour prévenir le framework](https://symfony.com/doc/current/controller/service.html#using-the-route-attribute).

Par contre, que faire des histoires de préfixes (de nom de routes et de chemins) ? À priori, il faudra répéter ces éléments. À moins, bien sûr, qu'il soit possible de définir le nom des routes à partir des noms de dossiers, mais ça me semble déjà trop complexe / magique !

### Exemple d'action

Si je reprends mon action d'affichage d'un article, ça donnerait quelque chose comme ceci :

```php
namespace App\Controller;

use App\Entity\Article;
use App\Handler\CommentHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogShowAction
{
    public function __construct(
        private CommentHandler $commentHandler,
    ) {
    }
    
    #[Route(path: '/article/{slug:article}', name: 'blog_show')]
    public function show(Article $article, Request $request): Response
    {
        // Contenu de l'action
    }
}
```

## Conclusions

Je vois plusieurs avantages à cette seconde méthode :
- des fichiers plus courts
- moins d'injection de services inutilisés
- possibilité d'utiliser l'héritage pour me préparer les basiques pour chaque type d'actions
- un rangement qui me semble plus clair

Mais aussi certains inconvénients qui me font penser à ne pas utiliser cette méthode pour tous les projets :
- pour une application avec beaucoup de <abbr title="Create Read Update Delete">CRUD</abbr>, la répétition va être infernale (un héritage bien défini peut aider, peut être ?)
- l'obligation d'écrire soit même les fichiers (et ne pas utiliser les commandes `make:controller` et surtout `make:crud` de Symfony)
- on multiplie très vite les fichiers

Cette réflexion ne répond pas vraiment à la question "quelle méthode est la meilleure ?". Comme d'habitude, je dirais que ça va dépendre des projets ! En tout cas, je pense que j'éviterai de mélanger des controllers étendant `AbstractController` et des services `Action`, pour conserver une logique un peu constante.
