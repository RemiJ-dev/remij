---
title: "Tant à apprendre, si peu de temps"
description: "Huit sessions sur quinze de la formation à la certification Symfony : un sacré gain. À force de lire la documentation page par page, je redécouvre des pans entiers du framework que je croyais connaître : ValueResolvers, fonctionnement du Kernel, AssetMapper, Form Type Extensions."
publishedAt: "2026-08-17"
lastModified: ~
tableOfContent: true
authors: ["remij"]
tags: ["Symfony","certification","réflexions","formation"]
---

La [formation à la certification de SensioLabs](https://sensiolabs.com/fr/formation/cours/preparation-a-la-certification-symfony-8) avance semaine après semaine et je suis ravi : à chaque session, j'apprends de nouvelles choses sur des sujets que je pensais maîtriser **et** je plonge dans la [documentation](https://symfony.com/doc/8.0) pour approfondir ce que je sais et viens d'apprendre. Après 8 sessions sur 15, j'ai déjà vraiment la sensation de progresser et j'applique une petite palette de compétences fraîchement acquises sur mes projets clients. J'ai utilisé pour la première fois le [composant Process](https://symfony.com/doc/8.0/components/process.html) pour exécuter une commande sur le serveur, grandement amélioré mon usage de [Messenger (pour les tâches asynchrones)](https://symfony.com/doc/8.0/components/messenger.html) (avant la session sur le sujet de la semaine prochaine) et commence à utiliser bien mieux [le composant de cache](https://symfony.com/doc/8.0/components/cache.html)... Il était temps, j'ai envie de dire !

## Revoir les bases

Même si je plonge régulièrement dans la documentation, je ne m'étais vraiment pas rendu compte de son évolution. Il faut admettre que, depuis la version 2.0 de Symfony, énormément de choses ont changé, tant dans le framework que dans la façon de l'expliquer.

Maintenant, je lis chaque page avec attention (et je prends des notes sur papier) et me plonge dans toutes les pages liées aux grands chapitres. Par exemple, [la page sur les controllers](https://symfony.com/doc/8.0/controller.html) a une [section « en savoir plus »](https://symfony.com/doc/8.0/controller.html#learn-more-about-controllers)... Comme une [page dédiée aux `ValueResolvers`](https://symfony.com/doc/8.0/controller/value_resolver.html). Et moi qui étais resté sur [ces bons vieux `ParamConverter`](https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html), désormais abandonnés ! Aujourd'hui, ce cher [EntityValueResolver](https://github.com/symfony/symfony/blob/8.0/src/Symfony/Bridge/Doctrine/ArgumentResolver/EntityValueResolver.php) fait le même travail, mais sous un autre nom (plus clair ?).

Et je ne parle même pas du fonctionnement du Kernel, que j'avais deviné sans jamais prendre la peine de vraiment le comprendre ! C'est vrai que, pour le coup, la [documentation du Kernel](https://symfony.com/doc/8.0/reference/configuration/kernel.html) qu'on trouve sur la page principale n'explique pas grand-chose... Par contre, si on prend le temps de regarder [les bases du HTTP avec Symfony](https://symfony.com/doc/8.0/introduction/http_fundamentals.html), on tombe sur ce schéma qui vaut un long discours, à mes yeux !

![Schéma explicatif de la gestion des requêtes HTTP par Symfony et l'interaction entre le Front Controller, le Kernel, le routing et les controllers](images/articles/2026/symfony-request-flow.svg)

*Schéma issu de la [documentation Symfony](https://symfony.com/doc/8.0/introduction/http_fundamentals.html), sous licence [CC BY-SA 3.0](https://creativecommons.org/licenses/by-sa/3.0/).*

Sur le schéma ci-dessus, trois requêtes différentes suivent un chemin similaire : le Front Controller reçoit la demande et transmet au Kernel. Ce dernier fait ensuite appel au Routing, qui renvoie le controller à appeler. Le Kernel appelle alors le controller, qui renvoie la réponse, qui est transmise au client.

Le genre de pages qu'on ne prend jamais le temps de regarder, mais qui ouvrent des perspectives, je vous dis...

## Aller plus loin

Dans les expérimentations que je n'aurais peut-être pas osées sans me plonger dans la doc, il y a l'[AssetMapper](https://symfony.com/doc/8.0/frontend/asset_mapper.html), que j'ai contourné depuis sa sortie (j'utilise Webpack Encore, encore) et les [Twig Components](https://symfony.com/bundles/ux-twig-component/current/index.html). Le premier, je l'utilise sur ce site et je l'apprécie beaucoup, quant au second, j'hésite encore un peu ! J'ai fait quelques tests en local et c'est vraiment intéressant, mais je verrai si je leur trouve une vraie utilité plus tard !

Les [Form Type Extensions](https://symfony.com/doc/8.0/form/create_form_type_extension.html) sont aussi un petit bonheur à utiliser, plutôt que de créer un Type à utiliser sur tous mes formulaires... Concrètement, l'extension permet d'étendre les fonctionnalités (ajouts d'attributs, de block prefix, etc.) d'un type et de l'appliquer à tous les types qui en héritent. Mes [Tom Selects](https://tom-select.js.org/docs/) sont maintenant mis partout sans effort !

```php
namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class TomSelectExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [ChoiceType::class];
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        // ...
    }
}
```

Avec ça, je peux définir les particularités me permettant d'appliquer un TomSelect sur **tous** les `ChoiceType` (mais aussi les `EntityType`, les `EnumType`, `LocaleType`, etc.). Il faudra juste penser à gérer les cas où le `ChoiceType` est `expanded`, vu que TomSelect n'a aucun sens sur les champs radio et checkbox !

## À voir bientôt

Comme les prochaines sessions parleront de Messenger, de la Console et des tests, je pense que je vais en apprendre encore beaucoup, d'ici à fin septembre ! Attendez-vous à relire un article du même genre très prochainement !
