---
date: "2026-07-17"
formateur: "Benjamin Zaslavsky"
---

# Twig

## Intro

Twig est un **moteur de template** pour **PHP**

- Lib pour générer du HTML à partir de block préconçus et dynamiques (templates),
- Moteur par défaut de Symfony (2),
- syntaxe claire et concise pour générer du HTML
- Emphase sur la sécurité (échappement et prévention des XSS attacks)

Par défaut, tout est échappé (|raw pour afficher en brut, |e ou |escape pour échapper manuellement)
{% autoescape %} pour des sections.

macro et parent-like sont échappés par défaut

## Variables et expressions

arrow functions depuis Twig 3.15

Dans Twig, ne faire que de l'affichage. Si ce sont des calculs liés au modèle, pas dans Twig

On peut ajouter des tests (instanceof)

### Test `empty` vs condition booléenne

Attention, les deux ne suivent pas les mêmes règles.

La **condition** d'un ternaire / d'un `if` utilise le transtypage PHP standard : `0`, `'0'`, `''`, `[]`, `false` et `null` sont *falsy*.

Le test **`empty`** de Twig est plus strict que le `empty()` de PHP — `CoreExtension::testEmpty()` se réduit à :

```php
if ($value instanceof \Countable) {
    return 0 === \count($value);
}
if ($value instanceof \Traversable) {
    return !iterator_count($value);
}
if (\is_object($value) && method_exists($value, '__toString')) {
    return '' === (string) $value;
}

return '' === $value || false === $value || null === $value || [] === $value;
```

Donc **`0` et `'0'` ne sont PAS vides pour Twig**, contrairement à PHP :

```twig
{{ 0 ? 'foo' : 'bar' }}                     {# bar : 0 est falsy #}
{{ 0 is not empty ? 'foo' : 'bar' }}        {# foo : 0 n'est pas "empty" #}

{{ '0' ? 'foo' : 'bar' }}                   {# bar : '0' est falsy #}
{{ '0' is not empty ? 'foo' : 'bar' }}      {# foo : '0' n'est pas "empty" #}

{{ '' ? 'foo' : 'bar' }}                    {# bar #}
{{ '' is not empty ? 'foo' : 'bar' }}       {# bar #}

{{ [] ? 'foo' : 'bar' }}                    {# bar #}
{{ [] is not empty ? 'foo' : 'bar' }}       {# bar #}
```

## String interpolation

```twig
{{ "The value is #{1 + 3}" }} {# Outputs "The value is 4" #}
```

```twig
{% set myVariable = 'World' %}

{{ "Hello #{myVariable}!" }} {# Outputs "Hello World!" #}
```

## Globals

On peut utiliser GlobalsInterface (sur une extension Twig) pour définir des variables globales dans Twig 

Déjà définies :
- _self
- _context
- _charset

Ajoutées par Symfony :
- app Symfony\Bridge\Twig\AppVariable

## Héritage

Dynamique (premier trouvé est utilisé) :

```twig
{% extends [
    'first_template.html.twig', 
    'second_template.html.twig', 
    'third_template.html.twig', 
] %}
```

Horizontal :

```twig
{% use 'block.html.twig' %}
```

## Inclusion

Préférer la fonction include() plutôt que le tag.

## Extension Lazy loaded 

```php
use Twig\{Extension\AbstractExtension, TwigFunction};
use App\Twig\AppRuntime;

class DemoExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('my_function', [AppRuntime::class, 'myFunction']), // fonction à charger à la demande dans une classe séparée
        ];
    }
}
```

```php
// ...
use Twig\Extension\RuntimeExtensionInterface;

final class AppRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private SomeService $service,
    ) {
    }

    public function myFunction(): array
    {
        return $this->service->myFunction();
    }
}
```

## Traduction

ICU recommandé (standard de facto)

- logout_path() pour appeler la route de logout



