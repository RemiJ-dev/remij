---
title: "Quelques essais du pattern ADR avec Symfony"
description: "Dans mon article précédent sur les controllers Symfony, je mentionnais le pattern ADR (Action Domain Responder) en conclusion. Difficile de s'en tenir là. Je me suis donc lancé dans l'expérimentation directement sur ce site : refactoring de toutes les actions, extraction de responders, isolation du domaine. Ce billet revient sur la démarche, les exemples concrets que j'en ai tirés, et les quelques zones d'ombre qui subsistent (notamment la frontière entre domaine et infrastructure, sur laquelle je n'ai pas encore tranché)."
publishedAt: "2026-05-26"
lastModified: ~
tableOfContent: true
authors: ["remij"]
tags: ["Symfony","technique","tutoriel","réflexions","pattern"]
---

Dans [le précédent article sur les controllers](./2026-02-controllers-symfony.md), je mentionne à la toute fin le pattern ADR (Action Domain Responder). Figurez-vous que je me suis mis en tête de faire quelques essais et, même si je n'irais peut-être pas m'en servir sur tous les projets (mes projets clients, notamment, qui seraient bien trop massifs à transformer), ça m'a bien plu ! Je me suis beaucoup basé sur un article sur [l'utilisation de ADR avec Laravel](https://wendelladriel.com/blog/using-the-adr-action-domain-responder-pattern-in-laravel) et je vais beaucoup le paraphraser. Du coup, si vous utilisez Laravel, je vous recommande surtout l'article mentionné !

Je reviendrai sur les pours et les contres vers [la fin de cet article](#conclusion). Pour l'heure, voyons un peu la démarche et ce que j'en ai fait.

## Définitions

Tout d'abord, voyons de quoi on parle ! Le pattern <abbr title="Action Domain Responder">ADR</abbr> change (un peu) de la logique <abbr title="Model View Controller">MVC</abbr> classique. On suit beaucoup plus un principe que j'apprécie : un page web reçoit une requête et doit renvoyer une réponse (pareil pour une API, mais c'est pour faire plus court ;) ). Pour moi, une action de controller avec le pattern MVC devait déjà respecter ce principe, mais on se retrouve souvent à y injecter de la logique métier. Le but est que le controller reçoive la requête, appelle le modèle, transmette les données à la vue et renvoie une réponse.

Avec <abbr title="Action Domain Responder">ADR</abbr>, on twiste un peu la formule : 
- L'action reçoit la requête,
- demande le traitement des données au domaine
- transmet le tout au responser
- et renvoie le résultat

À mes yeux, ça permet (surtout dans les actions complexes) d'éviter de mettre de la logique dans un controller et de réduire considérablement la complexité des actions.

## Grands principes

Une **action** devient donc un point d'entrée pour la requête HTTP. Elle reçoit la requête, transmet les infos au domaine, donne cette réponse au responder et en renvoie le résultat. L'action n'a plus qu'un rôle de cheffe d'orchestre et a un fonctionnement assez constant (on reparlera de quelques questions que je me pose plus tard).

Le **domaine** contient toute la logique métier. Toutes les règles sous-jacentes, invariants et décisions y sont prises. Ça permet de cloisonner et le domaine fonctionne de la même manière dans le cadre d'un site web, d'une API, d'une application Console ou autre.

Le **responder** récupère un résultat du domaine et le transcrit en une réponse adaptée. Dans mon cas, une réponse HTTP, mais on pourrait avoir des responders pour une application Console, tout aussi bien !

## Structurer le code

Je vais prendre en exemple ce que j'ai mis en place sur ce site. Je vous mets une version condensée et choisie de la structure, ci-dessous. Vous pouvez aller [jeter directement un coup d'œil au code du site](https://github.com/RemiJ-dev/remij).

```
src/
├── Action/
│   ├── Article/
│   │   ├── ListAction.php
│   │   └── ...
│   ├── Page/
│   │   ├── ContactAction.php
│   │   └── ...
│   └── ...
│
├── Domain/
│   ├── Article/
│   │   ├── Model/
│   │   │   ├── Article.php
│   │   │   └── Author.php
│   │   └── Repository/
│   │       └── ArticleRepository.php
│   ├── Page/
│   │   └── DTO/
│   │       └── ContactDTO.php
│   └── ...
│
├── Responder/
│   ├── Article/
│   │   ├── AbstractArticleResponder.php
│   │   ├── ListResponder.php
│   │   └── ...
│   └── AbstractTwigResponder.php
│
└── Infrastructure/
    ├── Form/
    │   ├── Handler/
    │   │   └── ContactFormHandler.php
    │   ├── Result/
    │   │   └── ContactFormResult.php
    │   └── ContactType.php
    ├── Mailer/
    │   └── ContactMailer.php
    └── ...
```

Vous noterez la présence du dossier `Infrastructure` qui contient un ensemble d'éléments très dépendant du framework. 

J'hésite toujours sur les éléments présentés ci-dessus dans le dossier `Infrastructure`... Faudrait-il les intégrer au domaine ? C'est très tentant, mais j'ai l'impression que ça romprait la logique agnostique (non dépendante d'un framework) du domaine.

Les trois principaux dossiers ont tous des sous-dossiers similaires (Article, Page et Seo) pour refléter le domaine, mais j'aurais aussi pu faire un découpage légèrement différent. J'ai par exemple hésité à sortir les pages d'accueil et de contact du dossier `Page` et idem pour leurs responders.

## La liste des articles

Au lieu d'avoir une méthode dans un controller pour tout faire, j'ai donc maintenant : 
- une action,
- un repository,
- un responder

L'avantage est que ces trois fichiers sont courts, faciles à relire et indépendants.

### L'action

```php
namespace App\Action\Article;

use App\Domain\Article\Repository\ArticleRepository;
use App\Responder\Article\ListResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

readonly class ListAction
{
    #[Route('/articles/', name: 'article_list')]
    public function __invoke(
        ArticleRepository $repository,
        ListResponder $responder,
    ): Response {
        return ($responder)($repository->findPublished());
    }
}
```

C'est assez condensé, avec un appel des services nécessaires directement dans la méthode `__invoke()` et on a juste à définir la route et à transmettre les données nécessaires au responder. 

Le fait que le responder soit invocable me dérange un peu dans la lecture et je me demande si, à l'usage, je ne vais pas lui donner une méthode, pour gagner un peu en clarté. Si c'est le cas, j'ajouterai une interface pour que tous les responders suivent le même contrat.

### Le repository

```php
namespace App\Domain\Article\Repository;

use App\Domain\Article\Model\Article;
use Stenope\Bundle\ContentManagerInterface;

class ArticleRepository
{
    public const string CLASS_NAME = Article::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    /**
     * @return array<string, Article>
     */
    public function findPublished(): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished()');
    }
    //...
}

```

Pour le coup, ça ne me change pas trop des repositories de Doctrine : j'ai une classe dédiée aux différentes méthodes me permettant de récupérer mes éléments d'un type précis. Une méthode par requête que je veux faire, à factoriser si des éléments se répètent. Du classique !

### Le responder

```php
namespace App\Responder\Article;

use App\Domain\Article\Model\Article;
use Symfony\Component\HttpFoundation\Response;

class ListResponder extends AbstractArticleResponder
{
    /**
     * @param array<string, Article> $articles
     */
    public function __invoke(array $articles): Response
    {
        return $this->render('articles/list.html.twig', [
            'articles' => $articles,
        ])
        ->setLastModified($this->getLastModified($articles));
    }
}
```

Le responder est la classe la plus complexe, vu que j'ai 2 niveaux d'héritage au-dessus : 
- un pour fournir la méthode `getLastModified()` spécifique aux responders des articles
- un autre pour fournir la méthode `render()` qui sert à tous les responders nécessitant un appel à Twig.

Rien de sorcier non plus, on récupère notre tableau de données, on construit une vue (et on modifie la date de dernière modification de la réponse). La méthode `render()` est celle disponible dans le `ControllerHelper` de Symfony. Notez l'injection directe de la méthode dans le `AbstractTwigResponder` ci-dessous. Une [astuce venue tout droit de la documentation](https://symfony.com/doc/current/controller.html#decoupling-controllers-from-symfony) de Symfony. Un jouet que je ne connaissais pas encore, c'est une belle occasion de le découvrir !

```php
namespace App\Responder;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractTwigResponder
{
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        private readonly \Closure $render,
    ) {
    }

    /**
     * @param array<string, mixed> $parameters
     */
    protected function render(string $template, array $parameters = []): Response
    {
        return ($this->render)($template, $parameters);
    }
}
```

### Des tests

Personnellement, et comme un certain [Grafikart](https://grafikart.fr) (dont je ne peux que recommander le travail) dans une vidéo très intéressante sur [les choix techniques d'une refonte du site grafikart.fr](https://www.youtube.com/watch?v=mWpvFGw2c7I), mes tests parfaits sont des tests fonctionnels. 

Pour ce cas-là, je le rejoins tout à fait sur le fait que Symfony n'est, par défaut, pas pratique pour réaliser ces tests et on doit ruser ou mettre en place des tests compliqués et particulièrement longs à écrire. 

C'est là que le pattern <abbr title="Action Domain Responder">ADR</abbr> prend une valeur supplémentaire à mes yeux : vu qu'il n'y a plus grand-chose dans les actions, on peut tester les services sur domaine et les responders séparément et ça permet d'avoir une meilleure couverture sans forcément faire des tests fonctionnels. Bon, par contre, comme les tests unitaires ne sont pas encore mon point fort (#shame), je les ai générés avec Claude et je n'en suis pas super satisfait. Du coup, il est grand temps que je me forme un peu (sur [SymfonyCasts](https://symfonycasts.com/) par exemple) sur le sujet et que je reprenne ça proprement !

## Conclusion

Outre l'exercice de pensée, j'ai trouvé plusieurs avantages à ce pattern, même pour un site aussi petit que celui-ci :

- les fichiers sont très légers et rapides à relire
- le rangement est rapide à lire et le domaine contient vraiment toute la logique
- le rendu est géré par le responder et, si je veux faire une API, je n'ai pas à toucher au domaine et à la logique, "juste" aux deux autres types de fichiers
- le framework a un impact limité sur les fichiers... et surtout aucun sur le domaine
- chaque fichier a un et un seul but précis et clair
- il est beaucoup plus facile de tester l'ensemble des fichiers et tester domaine et responders peut suffire

Bien sûr, tout n'est pas rose et quelques points me semblent perfectibles / peu pratiques :

- on crée vite beaucoup de fichiers : on pourrait clairement se passer de certains responders
- la limite entre domaine et infrastructure ne m'est pas encore très claire
- c'est une architecture très pratique quand on crée un nouveau projet, mais je ne me vois pas appliquer une telle transformation à un projet existant (et complexe).

Bref, je vais continuer cette expérimentation, pour essayer d'en voir un peu les limites et affiner le modèle. 
