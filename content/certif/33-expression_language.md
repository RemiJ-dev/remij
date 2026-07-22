# QCM — Le composant ExpressionLanguage

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/expression_language.html](https://symfony.com/doc/8.0/components/expression_language.html) · **Généré le :** 23 juillet 2026
>
> **47 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et introduction

### Question 1

Que fait le composant ExpressionLanguage ? *(une seule bonne réponse)*

- [ ] **A.** Il fournit un ORM pour interroger une base de données via une syntaxe dédiée
- [ ] **B.** Il fournit un validateur de schémas JSON
- [ ] **C.** Il fournit un moteur capable de compiler et d'évaluer des expressions, des one-liners retournant une valeur
- [ ] **D.** Il fournit un moteur de templates complet remplaçant Twig

### Question 2

Quelle commande installe le composant ExpressionLanguage ? *(une seule bonne réponse)*

- [ ] **A.** `npm install @symfony/expression-language`
- [ ] **B.** Il est installé par défaut avec `symfony/framework-bundle`
- [ ] **C.** `composer require symfony/expression-language`
- [ ] **D.** `composer require symfony/expression`

## How can the Expression Language Help Me?

### Question 3

Dans quels cas Symfony utilise-t-il des expressions selon la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans la sécurité
- [ ] **B.** Dans les règles de validation
- [ ] **C.** Dans le matching des routes
- [ ] **D.** Dans la compilation des assets CSS/JS

### Question 4

Pour quel type d'usage le composant est-il un candidat idéal, au-delà de son utilisation dans le framework lui-même ? *(une seule bonne réponse)*

- [ ] **A.** Un système de migration de base de données
- [ ] **B.** Un client HTTP asynchrone
- [ ] **C.** Un moteur de règles métier (« business rule engine »), configurable dynamiquement sans PHP
- [ ] **D.** Un moteur de recherche full-text

### Question 5

Pourquoi les expressions sont-elles décrites comme moins vulnérables aux injections externes qu'un simple `eval()` PHP ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elles ne peuvent jamais contenir de variables utilisateur
- [ ] **B.** Parce qu'elles sont exécutées dans un processus PHP séparé et isolé
- [ ] **C.** Parce qu'il faut explicitement déclarer quelles variables sont disponibles dans une expression
- [ ] **D.** Parce que les expressions sont automatiquement chiffrées avant évaluation

### Question 6

Même en utilisant ce mécanisme de déclaration explicite des variables, que recommande tout de même la documentation ? *(une seule bonne réponse)*

- [ ] **A.** De valider chaque expression via un schéma JSON avant évaluation
- [ ] **B.** De toujours assainir (« sanitize ») les données fournies par les utilisateurs finaux et passées aux expressions
- [ ] **C.** De ne jamais passer de données utilisateur dans une expression, sous aucun prétexte
- [ ] **D.** De désactiver le cache des expressions en production

## Usage

### Question 7

Quelles sont les deux façons de travailler avec des expressions fournies par le composant ? *(une seule bonne réponse)*

- [ ] **A.** Le parsing et le linting uniquement
- [ ] **B.** La sérialisation et la désérialisation
- [ ] **C.** Le rendu et le cache
- [ ] **D.** L'évaluation et la compilation

### Question 8

Quelle est la différence entre `evaluate()` et `compile()` ? *(une seule bonne réponse)*

- [ ] **A.** `evaluate()` ne fonctionne que sur des expressions booléennes, `compile()` sur tous les types
- [ ] **B.** `evaluate()` évalue l'expression sans la compiler en PHP, tandis que `compile()` la compile en PHP pour pouvoir être mise en cache
- [ ] **C.** Les deux méthodes font exactement la même chose, `evaluate()` étant un simple alias
- [ ] **D.** `compile()` évalue immédiatement l'expression, `evaluate()` se contente de la compiler

### Question 9

Quelle est la classe principale du composant ExpressionLanguage ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\ExpressionLanguage\Evaluator`
- [ ] **B.** `Symfony\Component\ExpressionLanguage\Expression`
- [ ] **C.** `Symfony\Component\ExpressionLanguage\Compiler`
- [ ] **D.** `Symfony\Component\ExpressionLanguage\ExpressionLanguage`

### Question 10

Que retourne `$expressionLanguage->evaluate('1 + 2')` ? *(une seule bonne réponse)*

- [ ] **A.** `null`, `evaluate()` ne retournant jamais de valeur scalaire directement
- [ ] **B.** `3` (l'entier résultant du calcul)
- [ ] **C.** La chaîne `"1 + 2"`
- [ ] **D.** Un objet `ParsedExpression`

### Question 11

Que retourne `$expressionLanguage->compile('1 + 2')` ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `SyntaxError` si l'expression est valide
- [ ] **B.** Un tableau de tokens
- [ ] **C.** La chaîne `"(1 + 2)"`, soit l'expression compilée en PHP
- [ ] **D.** L'entier `3`, comme `evaluate()`

### Question 12

Où la documentation recommande-t-elle d'aller pour apprendre la syntaxe complète du langage d'expression ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucune ressource dédiée à la syntaxe
- [ ] **B.** La page de référence dédiée à la syntaxe des expressions
- [ ] **C.** Le code source du composant, aucune documentation n'existant
- [ ] **D.** La documentation de Twig, dont la syntaxe serait strictement identique et documentée uniquement là-bas

## Parsing and Linting Expressions

### Question 13

Que retourne la méthode `parse()` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen indiquant si l'expression est valide
- [ ] **B.** Directement le résultat évalué de l'expression
- [ ] **C.** Une chaîne représentant l'expression compilée
- [ ] **D.** Une instance de `ParsedExpression`, utilisable pour inspecter et manipuler l'expression

### Question 14

Que fait la méthode `lint()` si l'expression n'est pas valide ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne silencieusement `false`
- [ ] **B.** Elle retourne un tableau d'erreurs sans lever d'exception
- [ ] **C.** Elle corrige automatiquement l'expression si possible
- [ ] **D.** Elle lève une exception `SyntaxError`

### Question 15

À quoi sert le flag `IGNORE_UNKNOWN_VARIABLES` de la classe `Parser` ? *(une seule bonne réponse)*

- [ ] **A.** À forcer la définition de toutes les variables avant le parsing
- [ ] **B.** À convertir automatiquement les variables inconnues en `null`
- [ ] **C.** À ne pas lever d'exception si une variable n'est pas définie dans l'expression
- [ ] **D.** À ignorer complètement les variables, quelle que soit leur définition

### Question 16

À quoi sert le flag `IGNORE_UNKNOWN_FUNCTIONS` ? *(une seule bonne réponse)*

- [ ] **A.** À désactiver complètement l'usage de fonctions dans les expressions
- [ ] **B.** À enregistrer automatiquement toute fonction inconnue rencontrée
- [ ] **C.** À ignorer les fonctions mais pas les variables inconnues
- [ ] **D.** À ne pas lever d'exception si une fonction n'est pas définie dans l'expression

### Question 17

Comment combine-t-on plusieurs flags du `Parser` lors d'un appel à `lint()` ? *(une seule bonne réponse)*

- [ ] **A.** En les passant dans un tableau PHP
- [ ] **B.** En appelant `lint()` plusieurs fois, une fois par flag
- [ ] **C.** Ce n'est pas possible de combiner plusieurs flags
- [ ] **D.** Avec l'opérateur OR bit à bit (`|`), ex. `Parser::IGNORE_UNKNOWN_VARIABLES | Parser::IGNORE_UNKNOWN_FUNCTIONS`

### Question 18

Dans le message d'erreur `Variable "a" is not valid around position 5 for expression \`1 + a\`.`, qu'est-ce qui a déclenché cette exception ? *(une seule bonne réponse)*

- [ ] **A.** L'absence du composant Cache dans le projet
- [ ] **B.** L'appel à `lint('1 + a', [])` sans déclarer la variable `"a"` parmi les variables autorisées
- [ ] **C.** Un appel à `evaluate()` avec une syntaxe PHP invalide
- [ ] **D.** Une erreur de compilation liée à un cache corrompu

## Passing in Variables

### Question 19

Quel type de valeurs peut-on passer comme variables dans une expression ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement des tableaux associatifs
- [ ] **B.** Uniquement des objets implémentant une interface spécifique du composant
- [ ] **C.** N'importe quel type PHP valide, y compris des objets
- [ ] **D.** Uniquement des types scalaires (int, string, bool, float)

### Question 20

Dans une application Symfony, quels objets/variables sont automatiquement injectés pour être utilisés dans les expressions ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les variables disponibles dans les expressions de sécurité
- [ ] **B.** Les variables disponibles dans les expressions du conteneur de services
- [ ] **C.** Les variables disponibles dans les expressions de routing
- [ ] **D.** Les variables d'environnement système brutes (`$_ENV`)

### Question 21

Dans l'exemple `$expressionLanguage->evaluate('fruit.variety', ['fruit' => $apple])`, comment accède-t-on à la propriété d'un objet passé en variable ? *(une seule bonne réponse)*

- [ ] **A.** Via la notation crochets, ex. `fruit['variety']`
- [ ] **B.** Via un appel de méthode obligatoire, ex. `fruit.getVariety()`
- [ ] **C.** Ce n'est pas possible d'accéder aux propriétés d'un objet dans une expression
- [ ] **D.** Via la notation pointée, ex. `fruit.variety`

### Question 22

Quel est le deuxième argument de la méthode `evaluate()` ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `CacheItemPoolInterface`
- [ ] **B.** Le nom de la fonction à enregistrer
- [ ] **C.** Un tableau associatif des variables disponibles dans l'expression
- [ ] **D.** Les flags du `Parser` (`IGNORE_UNKNOWN_VARIABLES`, etc.)

## Caching

### Question 23

En plus de la méthode `compile()` permettant de mettre en cache l'expression sous forme de PHP, que fait le composant en interne ? *(une seule bonne réponse)*

- [ ] **A.** Il recompile systématiquement chaque expression à chaque appel, sans aucun cache
- [ ] **B.** Il met en cache uniquement le résultat final évalué, jamais l'AST
- [ ] **C.** Il met aussi en cache les expressions parsées (`ParsedExpression`), pour accélérer les expressions dupliquées
- [ ] **D.** Il ne fait rien d'autre, seul `compile()` offre un mécanisme de cache

### Question 24

Laquelle des deux méthodes, `evaluate()` ou `compile()`, a le plus grand overhead ? *(une seule bonne réponse)*

- [ ] **A.** Aucune des deux n'a d'overhead, le résultat étant précalculé au chargement
- [ ] **B.** `evaluate()`, car elle doit en plus boucler sur les nœuds de l'expression pour les évaluer dynamiquement
- [ ] **C.** `compile()`, car elle exécute réellement le code généré
- [ ] **D.** Les deux ont un overhead strictement identique

### Question 25

Que fait concrètement `compile()`, une fois l'expression parsée ? *(une seule bonne réponse)*

- [ ] **A.** Elle relance un second parsing complet de l'expression
- [ ] **B.** Elle retourne simplement la conversion en chaîne de l'objet `ParsedExpression`
- [ ] **C.** Elle exécute l'expression et retourne son résultat
- [ ] **D.** Elle sérialise l'AST en JSON

### Question 26

Quel standard implémente le pool utilisé pour mettre en cache les `ParsedExpression` ? *(une seule bonne réponse)*

- [ ] **A.** PSR-16 (Simple Cache)
- [ ] **B.** PSR-3 (Logger)
- [ ] **C.** Aucun standard PSR, un mécanisme propriétaire est utilisé
- [ ] **D.** PSR-6 (`CacheItemPoolInterface`)

### Question 27

Quel adaptateur de cache est utilisé par défaut si aucun n'est fourni au constructeur d'`ExpressionLanguage` ? *(une seule bonne réponse)*

- [ ] **A.** `NullAdapter` (aucun cache par défaut)
- [ ] **B.** `ArrayAdapter`
- [ ] **C.** `RedisAdapter`
- [ ] **D.** `FilesystemAdapter`

### Question 28

Comment injecter un pool de cache personnalisé (ex. Redis) dans `ExpressionLanguage` ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable d'environnement `EXPRESSION_LANGUAGE_CACHE`
- [ ] **B.** En le passant en argument du constructeur, ex. `new ExpressionLanguage($cache)`
- [ ] **C.** Ce n'est pas configurable, seul `ArrayAdapter` est utilisable
- [ ] **D.** Via une méthode `setCache()` appelée après instanciation

## Using Parsed and Serialized Expressions

### Question 29

Quelles classes `evaluate()` et `compile()` peuvent-elles gérer, en plus d'une simple chaîne de caractères ? *(plusieurs bonnes réponses)*

- [ ] **A.** `ParsedExpression`
- [ ] **B.** `SerializedParsedExpression`
- [ ] **C.** `CompiledExpression` (classe qui n'existe pas dans le composant)
- [ ] **D.** `ExpressionFunction`

### Question 30

À quoi sert la classe `SerializedParsedExpression` ? *(une seule bonne réponse)*

- [ ] **A.** À convertir n'importe quelle expression en JSON automatiquement
- [ ] **B.** À chiffrer une expression avant de la transmettre au client
- [ ] **C.** À reconstruire une expression déjà parsée à partir de ses nœuds sérialisés, sans redemander le parsing
- [ ] **D.** À sérialiser le résultat final évalué d'une expression pour le stocker

## AST Dumping and Editing

### Question 31

Que retourne la méthode `getNodes()` appelée après le parsing d'une expression ? *(une seule bonne réponse)*

- [ ] **A.** Le résultat évalué de l'expression
- [ ] **B.** Le code PHP compilé de l'expression
- [ ] **C.** La liste des variables utilisées dans l'expression
- [ ] **D.** L'AST (arbre syntaxique abstrait) de l'expression

### Question 32

Que signifie l'acronyme AST, tel qu'utilisé dans la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Automated Symbol Table
- [ ] **B.** Abstract State Transition
- [ ] **C.** Abstract Syntax Tree
- [ ] **D.** Advanced Syntax Type

### Question 33

Comment obtenir une représentation sous forme de chaîne de caractères de l'AST ? *(une seule bonne réponse)*

- [ ] **A.** En appelant directement `(string)` sur l'objet `ParsedExpression`
- [ ] **B.** Ce n'est pas possible, l'AST ne pouvant être qu'inspecté objet par objet
- [ ] **C.** En appelant `serialize()` sur l'expression
- [ ] **D.** En appelant la méthode `dump()` sur l'objet retourné par `getNodes()`

### Question 34

Comment convertir l'AST en un tableau PHP manipulable ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `json_decode(json_encode($ast))`
- [ ] **B.** En appelant `getNodes()` directement sur l'`ExpressionLanguage`, sans passer par `parse()`
- [ ] **C.** En appelant la méthode `toArray()` sur le résultat de `getNodes()`
- [ ] **D.** Les nœuds de l'AST ne peuvent jamais être convertis en tableau

## Extending the ExpressionLanguage — Registering Functions

### Question 35

Où les fonctions personnalisées sont-elles enregistrées ? *(une seule bonne réponse)*

- [ ] **A.** Dans la classe `Parser` directement
- [ ] **B.** Sur chaque instance spécifique d'`ExpressionLanguage`
- [ ] **C.** Globalement pour toutes les instances du composant dans le processus PHP
- [ ] **D.** Dans un fichier de configuration YAML dédié

### Question 36

Combien d'arguments prend la méthode `register()` ? *(une seule bonne réponse)*

- [ ] **A.** Quatre : le nom, le compiler, l'evaluator et un cache dédié
- [ ] **B.** Trois : le nom, un compiler et un evaluator
- [ ] **C.** Deux : le nom et une closure unique
- [ ] **D.** Un seul : le nom de la fonction

### Question 37

À quoi sert l'argument « compiler » de `register()` ? *(une seule bonne réponse)*

- [ ] **A.** À valider la syntaxe de la fonction avant son enregistrement
- [ ] **B.** À définir le nom affiché de la fonction dans les messages d'erreur
- [ ] **C.** À définir la fonction exécutée lors de la compilation de l'expression utilisant la fonction
- [ ] **D.** À définir la fonction exécutée uniquement lors de l'évaluation

### Question 38

Quel argument supplémentaire est passé en premier à la fonction « evaluator », en plus des arguments propres à la fonction personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** Le nom de la fonction appelée
- [ ] **B.** L'AST complet de l'expression en cours d'évaluation
- [ ] **C.** Une variable `arguments`, égale au second argument passé à `evaluate()`
- [ ] **D.** L'instance `ExpressionLanguage` elle-même

### Question 39

Dans l'exemple de la fonction « lowercase » enregistrée, que fait la partie « compiler » ? *(une seule bonne réponse)*

- [ ] **A.** Elle appelle directement `strtolower()` et retourne le résultat
- [ ] **B.** Elle ne fait rien, seule la partie evaluator étant utilisée dans cet exemple
- [ ] **C.** Elle lève une exception si l'argument n'est pas une chaîne
- [ ] **D.** Elle génère une chaîne de code PHP (ex. via `sprintf`) représentant l'appel à `strtolower()` avec vérification de type

### Question 40

Comment évaluer une expression utilisant une fonction personnalisée enregistrée, comme `lowercase("HELLO")` ? *(une seule bonne réponse)*

- [ ] **A.** Il faut d'abord appeler `registerProvider()` même pour une fonction unique enregistrée via `register()`
- [ ] **B.** En appelant simplement `$expressionLanguage->evaluate('lowercase("HELLO")')`
- [ ] **C.** Il faut obligatoirement passer par `compile()` puis exécuter le PHP généré manuellement
- [ ] **D.** Les fonctions personnalisées ne peuvent être qu'évaluées via une closure PHP directe, jamais via une chaîne d'expression

## Extending the ExpressionLanguage — Using Expression Providers

### Question 41

Pourquoi créer un « expression provider » plutôt que d'utiliser `register()` directement ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `register()` a été dépréciée au profit exclusif des providers
- [ ] **B.** Parce que les providers sont plus rapides à l'exécution
- [ ] **C.** Parce que `register()` ne permet pas de définir plusieurs fonctions à la fois
- [ ] **D.** Quand on utilise `ExpressionLanguage` dans une bibliothèque et qu'on veut ajouter des fonctions personnalisées de façon réutilisable

### Question 42

Quelle interface une classe doit-elle implémenter pour être un expression provider ? *(une seule bonne réponse)*

- [ ] **A.** `ExpressionLanguageExtensionInterface`
- [ ] **B.** `ExpressionFunctionProviderInterface`
- [ ] **C.** `ExpressionProviderInterface`
- [ ] **D.** `FunctionRegistryInterface`

### Question 43

Quelle méthode cette interface requiert-elle, et que retourne-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `getExpressions()`, qui retourne un tableau de chaînes brutes
- [ ] **B.** `getFunctions()`, qui retourne un tableau d'instances d'`ExpressionFunction`
- [ ] **C.** `register()`, qui retourne un booléen de succès
- [ ] **D.** `provide()`, qui retourne une chaîne de configuration YAML

### Question 44

Comment créer rapidement une fonction d'expression à partir d'une fonction PHP existante, comme `strtoupper` ? *(une seule bonne réponse)*

- [ ] **A.** `$expressionLanguage->register('strtoupper')`
- [ ] **B.** `ExpressionFunction::fromPhp('strtoupper')`
- [ ] **C.** `new ExpressionFunction('strtoupper')`
- [ ] **D.** `ExpressionFunctionProviderInterface::wrap('strtoupper')`

### Question 45

Que faut-il faire de particulier pour utiliser `fromPhp()` avec une fonction PHP namespacée (ex. `My\strtoupper`) ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, le namespace est automatiquement retiré
- [ ] **B.** Ce n'est pas possible, seules les fonctions du namespace global sont supportées par `fromPhp()`
- [ ] **C.** Il faut échapper le namespace avec des guillemets
- [ ] **D.** Fournir un second argument définissant le nom de la fonction dans l'expression

### Question 46

Comment enregistrer un provider une fois créé ? *(plusieurs bonnes réponses)*

- [ ] **A.** Via la méthode `registerProvider()`
- [ ] **B.** Via le second argument du constructeur d'`ExpressionLanguage`
- [ ] **C.** En l'ajoutant directement au tableau `$_SERVER`
- [ ] **D.** En le déclarant comme provider dans `services.yaml`, seule méthode possible

### Question 47

Que recommande la documentation si l'on souhaite étendre `ExpressionLanguage` dans sa propre bibliothèque ? *(une seule bonne réponse)*

- [ ] **A.** Modifier directement le code source du composant dans `vendor/`
- [ ] **B.** Utiliser exclusivement des traits PHP, aucun héritage n'étant supporté
- [ ] **C.** Créer sa propre classe qui étend `ExpressionLanguage`, en surchargeant le constructeur pour ajouter son provider par défaut
- [ ] **D.** Ne jamais étendre la classe `ExpressionLanguage`, celle-ci étant `final`

---

## Corrigé

**Question 1 : C** — « The ExpressionLanguage component provides an engine that can compile and evaluate expressions. An expression is a one-liner that returns a value. » *(§ Installation et introduction)*

**Question 2 : C** — `$ composer require symfony/expression-language`. *(§ Installation et introduction)*

**Question 3 : A, B, C** — « the Symfony Framework uses expressions in security, for validation rules and in route matching. » *(§ How can the Expression Language Help Me?)*

**Question 4 : C** — « the ExpressionLanguage component is a perfect candidate for the foundation of a *business rule engine*. The idea is to let the webmaster (…) configure things in a dynamic way without using PHP. » *(§ How can the Expression Language Help Me?)*

**Question 5 : C** — « Expressions can be seen as a very restricted PHP sandbox and are less vulnerable to external injections because you must explicitly declare which variables are available in an expression. » *(§ How can the Expression Language Help Me?)*

**Question 6 : B** — « (…) but you should still sanitize any data given by end users and passed to expressions. » *(§ How can the Expression Language Help Me?)*

**Question 7 : D** — « The component provides 2 ways to work with expressions: evaluation (…) compile. » *(§ Usage)*

**Question 8 : B** — « evaluation: the expression is evaluated without being compiled to PHP; compile: the expression is compiled to PHP, so it can be cached and evaluated. » *(§ Usage)*

**Question 9 : D** — « The main class of the component is `Symfony\Component\ExpressionLanguage\ExpressionLanguage`. » *(§ Usage)*

**Question 10 : B** — « `var_dump($expressionLanguage->evaluate('1 + 2')); // displays 3`. » *(§ Usage)*

**Question 11 : C** — « `var_dump($expressionLanguage->compile('1 + 2')); // displays (1 + 2)`. » *(§ Usage)*

**Question 12 : B** — « See `/reference/formats/expression_language` to learn the syntax of the ExpressionLanguage component. » *(§ Usage)*

**Question 13 : D** — « The `parse` method returns a `ParsedExpression` instance that can be used to inspect and manipulate the expression. » *(§ Parsing and Linting Expressions)*

**Question 14 : D** — « The `lint`, on the other hand, throws a `SyntaxError` if the expression is not valid. » *(§ Parsing and Linting Expressions)*

**Question 15 : C** — « `IGNORE_UNKNOWN_VARIABLES`: don't throw an exception if a variable is not defined in the expression. » *(§ Parsing and Linting Expressions)*

**Question 16 : D** — « `IGNORE_UNKNOWN_FUNCTIONS`: don't throw an exception if a function is not defined in the expression. » *(§ Parsing and Linting Expressions)*

**Question 17 : D** — « `Parser::IGNORE_UNKNOWN_VARIABLES | Parser::IGNORE_UNKNOWN_FUNCTIONS`. » *(§ Parsing and Linting Expressions)*

**Question 18 : B** — « `$expressionLanguage->lint('1 + a', []);` // throws a SyntaxError exception: "Variable "a" is not valid (…)". » *(§ Parsing and Linting Expressions)*

**Question 19 : C** — « You can also pass variables into the expression, which can be of any valid PHP type (including objects). » *(§ Passing in Variables)*

**Question 20 : A, B, C** — « Variables available in security expressions; Variables available in service container expressions; Variables available in routing expressions. » *(§ Passing in Variables)*

**Question 21 : D** — « `$expressionLanguage->evaluate('fruit.variety', ['fruit' => $apple])`. » *(§ Passing in Variables)*

**Question 22 : C** — deuxième argument de `evaluate('fruit.variety', ['fruit' => $apple])` : le tableau des variables. *(§ Passing in Variables)*

**Question 23 : C** — « But internally, the component also caches the parsed expressions, so duplicated expressions can be compiled/evaluated quicker. » *(§ Caching)*

**Question 24 : B** — « Both `evaluate()` and `compile()` need to do some things before each can provide the return values. For `evaluate()`, this overhead is even bigger. » *(§ Caching — The Workflow)*

**Question 25 : B** — « Now, the `compile()` method just returns the string conversion of this object [ParsedExpression]. » *(§ Caching — The Workflow)*

**Question 26 : D** — « The caching is done by a PSR-6 `CacheItemPoolInterface` instance. » *(§ Caching — The Workflow)*

**Question 27 : B** — « (by default, it uses an `Symfony\Component\Cache\Adapter\ArrayAdapter`). » *(§ Caching — The Workflow)*

**Question 28 : B** — « `$cache = new RedisAdapter(...); $expressionLanguage = new ExpressionLanguage($cache);`. » *(§ Caching — The Workflow)*

**Question 29 : A, B** — « Both `evaluate()` and `compile()` can handle `ParsedExpression` and `SerializedParsedExpression`. » *(§ Using Parsed and Serialized Expressions)*

**Question 30 : C** — « `$expression = new SerializedParsedExpression('1 + 4', serialize($expressionLanguage->parse('1 + 4', [])->getNodes()));`. » *(§ Using Parsed and Serialized Expressions)*

**Question 31 : D** — « Call the `getNodes` method after parsing any expression to get its AST. » *(§ AST Dumping and Editing)*

**Question 32 : C** — « AST (Abstract Syntax Tree) is "a tree representation of the structure of source code written in a programming language". » *(§ AST Dumping and Editing)*

**Question 33 : D** — « dump the AST nodes as a string representation: `$astAsString = $ast->dump();`. » *(§ AST Dumping and Editing)*

**Question 34 : C** — « Call the `toArray` method to turn the AST into an array. » *(§ AST Dumping and Editing)*

**Question 35 : B** — « Functions are registered on each specific `ExpressionLanguage` instance. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 36 : B** — « This method has 3 arguments: name (…) compiler (…) evaluator. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 37 : C** — « compiler - A function executed when compiling an expression using the function. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 38 : C** — « the evaluator is passed an `arguments` variable as its first argument, which is equal to the second argument of `evaluate()`. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 39 : D** — « `function ($str): string { return sprintf('(is_string(%1$s) ? strtolower(%1$s) : %1$s)', $str); }`. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 40 : B** — « `var_dump($expressionLanguage->evaluate('lowercase("HELLO")'));`. » *(§ Extending the ExpressionLanguage — Registering Functions)*

**Question 41 : D** — « When you use the `ExpressionLanguage` class in your library, you often want to add custom functions. To do so, you can create a new expression provider. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 42 : B** — « by creating a class that implements `ExpressionFunctionProviderInterface`. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 43 : B** — « This interface requires one method: `getFunctions`, which returns an array of expression functions (instances of `ExpressionFunction`). » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 44 : B** — « To create an expression function from a PHP function with the `ExpressionFunction::fromPhp` static method: `ExpressionFunction::fromPhp('strtoupper');`. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 45 : D** — « Namespaced functions are supported, but they require a second argument to define the name of the expression: `ExpressionFunction::fromPhp('My\strtoupper', 'my_strtoupper');`. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 46 : A, B** — « You can register providers using `registerProvider()` or by using the second argument of the constructor. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

**Question 47 : C** — « It is recommended to create your own `ExpressionLanguage` class in your library. Now you can add the extension by overriding the constructor. » *(§ Extending the ExpressionLanguage — Using Expression Providers)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [components/expression_language.rst](https://github.com/symfony/symfony-docs/blob/8.0/components/expression_language.rst)) : pas de pages annexes à couvrir pour ce QCM.
