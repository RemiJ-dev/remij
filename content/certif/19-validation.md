# QCM — La validation

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/validation.html](https://symfony.com/doc/8.0/validation.html) (questions principales) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/validation.html#learn-more) · **Généré le :** 22 juillet 2026
>
> **83 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande installe le composant Validator dans une application utilisant Symfony Flex ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/validator`
- [ ] **B.** `composer require symfony/validation`
- [ ] **C.** Il est installé par défaut avec `symfony/framework-bundle`, aucune commande n'est nécessaire
- [ ] **D.** `composer require symfony/constraints`

## Les bases de la validation

### Question 2

Quel format ne fait **pas** partie des façons natives de définir les contraintes de validation d'une classe ? *(une seule bonne réponse)*

- [ ] **A.** Un fichier JSON dédié
- [ ] **B.** Des attributs PHP
- [ ] **C.** Un fichier YAML dans `config/validator/`
- [ ] **D.** Une méthode statique `loadValidatorMetadata()` en PHP

### Question 3

Ajouter une contrainte comme `#[Assert\NotBlank]` sur une propriété suffit-il à garantir que sa valeur ne sera jamais vide ? *(une seule bonne réponse)*

- [ ] **A.** Oui, la valeur est automatiquement forcée dès l'ajout de la contrainte
- [ ] **B.** Non, il faut aussi passer l'objet au service `validator` pour que la contrainte soit effectivement vérifiée
- [ ] **C.** Oui, mais uniquement en environnement `prod`
- [ ] **D.** Non, il faut recompiler le container Symfony au préalable

### Question 4

Comment le validator de Symfony accède-t-il à la valeur d'une propriété lors de la validation ? *(une seule bonne réponse)*

- [ ] **A.** Via la réflexion PHP ainsi que des méthodes « getter », ce qui fonctionne aussi bien pour des propriétés publiques, privées ou protégées
- [ ] **B.** Uniquement via des propriétés publiques
- [ ] **C.** Uniquement via un getter explicitement déclaré dans une interface
- [ ] **D.** En sérialisant d'abord l'objet en tableau associatif

### Question 5

À quoi sert la clé `$schema` que Symfony fournit pour les fichiers de mapping YAML de validation ? *(une seule bonne réponse)*

- [ ] **A.** À valider automatiquement les données au runtime
- [ ] **B.** À activer l'autocomplétion et la validation dans les IDE comme PhpStorm
- [ ] **C.** À générer automatiquement les classes de contraintes personnalisées
- [ ] **D.** Ce n'est utile qu'en environnement de test

### Question 6

Comment valider un objet et récupérer la liste des erreurs de validation ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `validate()` sur le service `validator` (qui implémente `ValidatorInterface`), ce qui retourne un `ConstraintViolationList`
- [ ] **B.** En appelant `check()` sur un service `ConstraintChecker` dédié
- [ ] **C.** Automatiquement à chaque `flush()` Doctrine
- [ ] **D.** En implémentant une interface `Validatable` sur l'entité

### Question 7

Que représente chaque erreur individuelle retournée par le validator, et quelle méthode permet d'obtenir la contrainte à l'origine de la violation ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `ConstraintViolation`, via sa méthode `getConstraint()`
- [ ] **B.** Une simple chaîne de caractères, sans lien avec la contrainte d'origine
- [ ] **C.** Un tableau associatif, accessible via la clé `'constraint'`
- [ ] **D.** Un objet `Error` générique du framework

### Question 8

Que permettent `Validation::createCallable()` et `Validation::createIsValidCallable()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ils retournent tous deux une closure permettant de valider une valeur contre un ensemble de contraintes
- [ ] **B.** `createCallable()` retourne une closure qui lève une `ValidationFailedException` quand les contraintes ne sont pas respectées
- [ ] **C.** `createIsValidCallable()` retourne une closure qui retourne `false` quand les contraintes ne sont pas respectées
- [ ] **D.** Elles ne sont utilisables que dans le contexte du composant Console

## Les contraintes et leur configuration

### Question 9

Que représente une « contrainte » (constraint) dans le composant Validator ? *(une seule bonne réponse)*

- [ ] **A.** Un objet PHP qui exprime une affirmation (une règle) qu'une valeur doit respecter
- [ ] **B.** Une simple chaîne de caractères décrivant une règle métier
- [ ] **C.** Une classe de contrôleur dédiée à la validation
- [ ] **D.** Un fichier de configuration YAML uniquement

### Question 10

Comment configurer les options d'une contrainte plus complexe comme `Choice`, par exemple la liste de valeurs autorisées et un message d'erreur personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** En sous-classant `Choice` pour chaque jeu d'options
- [ ] **B.** En passant les options directement au constructeur ou à l'attribut, par exemple `#[Assert\Choice(choices: ['fiction', 'non-fiction'], message: 'Choose a valid genre.')]`
- [ ] **C.** Les options de `Choice` ne peuvent être définies que via un fichier XML
- [ ] **D.** En définissant une constante globale `VALID_CHOICES` dans le kernel

## Contraintes dans les formulaires

### Question 11

Comment ajouter des contraintes de validation directement lors de la construction d'un champ de formulaire, sans les définir sur l'entité ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `constraints` du champ, par exemple `'constraints' => [new Assert\Length(min: 3)]`
- [ ] **B.** Ce n'est pas possible, les contraintes doivent toujours être définies sur la classe validée
- [ ] **C.** Via une méthode `addConstraint()` appelée sur le `FormBuilder`
- [ ] **D.** Uniquement via un `EventSubscriber` sur `FormEvents::POST_SUBMIT`

## Cibles des contraintes : propriétés, getters, classes

### Question 12

Quels sont les niveaux (« targets ») auxquels une contrainte peut être appliquée ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une propriété de classe
- [ ] **B.** Une méthode « getter » (nom commençant par `get`, `is` ou `has`)
- [ ] **C.** Une classe entière
- [ ] **D.** Un paramètre de méthode de contrôleur

### Question 13

Quelles propriétés Symfony permet-il de valider ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les propriétés publiques
- [ ] **B.** Les propriétés privées, protégées ou publiques
- [ ] **C.** Uniquement les propriétés promues dans le constructeur
- [ ] **D.** Uniquement les propriétés typées `string`

### Question 14

Que se passe-t-il si une propriété typée n'a pas été initialisée au moment de la validation ? *(une seule bonne réponse)*

- [ ] **A.** Une `TypeError` fatale est levée immédiatement
- [ ] **B.** Le validator utilise la valeur `null`, ce qui peut causer un comportement inattendu — il faut s'assurer que toutes les propriétés sont initialisées avant de valider
- [ ] **C.** La propriété est ignorée silencieusement par toutes les contraintes
- [ ] **D.** Une valeur par défaut est déduite automatiquement du type déclaré

### Question 15

Quels noms de méthode Symfony reconnaît-il comme des « getters » pouvant porter une contrainte ? *(une seule bonne réponse)*

- [ ] **A.** Les méthodes dont le nom commence par `get`, `is` ou `has`
- [ ] **B.** Uniquement les méthodes commençant par `get`
- [ ] **C.** N'importe quelle méthode publique sans argument
- [ ] **D.** Uniquement les méthodes marquées par un attribut `#[Getter]`

### Question 16

Pourquoi le préfixe (`get`, `is` ou `has`) du getter est-il omis dans le mapping YAML/XML/PHP d'une contrainte de getter ? *(une seule bonne réponse)*

- [ ] **A.** Pour des raisons purement esthétiques, sans impact fonctionnel
- [ ] **B.** Pour permettre de déplacer plus tard la contrainte vers une propriété du même nom (ou inversement) sans changer la logique de validation
- [ ] **C.** Parce que le préfixe est interdit par la spécification JSR303
- [ ] **D.** Parce que seules les méthodes `is`/`has` sont réellement supportées, `get` étant juste toléré

### Question 17

Comment une contrainte comme `Callback` peut-elle s'appliquer à une classe entière plutôt qu'à une seule propriété ? *(une seule bonne réponse)*

- [ ] **A.** En la plaçant sur la classe elle-même ; quand la classe est validée, les méthodes spécifiées par la contrainte sont simplement exécutées pour fournir une validation personnalisée
- [ ] **B.** Ce n'est pas possible nativement, il faut toujours cibler une propriété précise
- [ ] **C.** En dupliquant la contrainte sur chacune des propriétés de la classe
- [ ] **D.** Uniquement via le fichier `services.yaml`

## Validation d'objets avec héritage

### Question 18

Que se passe-t-il quand une classe enfant surcharge une contrainte définie sur une propriété de la classe parente ? *(une seule bonne réponse)*

- [ ] **A.** Seule la contrainte de la classe enfant est appliquée, celle du parent est ignorée
- [ ] **B.** Les contraintes définies sur les propriétés parentes sont toujours fusionnées et appliquées aux propriétés enfant, même si celles-ci surchargent ces contraintes ; on ne peut contourner ce comportement qu'en utilisant des groupes de validation différents
- [ ] **C.** Une exception est levée au moment de la validation
- [ ] **D.** Seule la contrainte la plus récemment définie (parent ou enfant) est retenue, selon l'ordre de déclaration

## Étendre la validation pour une classe

### Question 19

Comment ajouter ou surcharger des contraintes de validation sur une classe qu'on ne peut pas modifier soi-même (par exemple une classe d'une bibliothèque tierce) ? *(une seule bonne réponse)*

- [ ] **A.** En créant une classe séparée (souvent `abstract`) portant l'attribut `#[ExtendsValidationFor(TargetClass::class)]`, dont les contraintes s'appliquent à la classe cible comme si elles y étaient définies
- [ ] **B.** Ce n'est pas possible, il faut forker la bibliothèque tierce
- [ ] **C.** En redéfinissant la classe cible dans son propre namespace `App\`
- [ ] **D.** Uniquement via un décorateur de service sur le `validator`

### Question 20

Que se passe-t-il si une classe utilisant `#[ExtendsValidationFor]` définit une contrainte sur une propriété qui n'existe pas dans la classe cible ? *(une seule bonne réponse)*

- [ ] **A.** La contrainte est silencieusement ignorée
- [ ] **B.** Une `MappingException` est levée
- [ ] **C.** La propriété est automatiquement ajoutée à la classe cible via une trait
- [ ] **D.** Cela ne provoque une erreur qu'en environnement `prod`

## Déboguer les contraintes

### Question 21

Quelle commande liste les contraintes de validation configurées pour une classe donnée ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console debug:validator 'App\Entity\SomeClass'`
- [ ] **B.** `php bin/console validator:debug 'App\Entity\SomeClass'`
- [ ] **C.** `php bin/console debug:container --tag=validator.constraint`
- [ ] **D.** `php bin/console cache:warmup --validator`

### Question 22

La commande de débogage du validator peut-elle cibler un répertoire entier plutôt qu'une seule classe ? *(une seule bonne réponse)*

- [ ] **A.** Non, un seul nom de classe complet peut être passé à la fois
- [ ] **B.** Oui, par exemple `php bin/console debug:validator src/Entity` valide toutes les classes stockées dans ce répertoire
- [ ] **C.** Oui, mais uniquement avec l'option `--recursive`
- [ ] **D.** Non, il faut écrire un script PHP dédié pour parcourir un répertoire

## Créer une contrainte de validation personnalisée

### Question 23

Comment crée-t-on une contrainte de validation personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** En créant une classe qui étend `Symfony\Component\Validator\Constraint`
- [ ] **B.** En implémentant l'interface `ConstraintInterface`
- [ ] **C.** En taguant un service avec `validator.custom_constraint`
- [ ] **D.** Ce n'est possible qu'en modifiant le composant Validator lui-même

### Question 24

Que faut-il ajouter à la classe de contrainte pour pouvoir l'utiliser comme attribut PHP sur d'autres classes ? *(une seule bonne réponse)*

- [ ] **A.** L'interface `AttributableConstraint`
- [ ] **B.** L'attribut `#[\Attribute]` sur la classe de contrainte
- [ ] **C.** Une méthode `asAttribute(): static`
- [ ] **D.** Rien de particulier, c'est automatique dès l'extension de `Constraint`

### Question 25

Que permet l'attribut `#[HasNamedArguments]` sur le constructeur d'une contrainte personnalisée ? *(une seule bonne réponse)*

- [ ] **A.** De rendre certaines options de la contrainte obligatoires
- [ ] **B.** D'autoriser l'usage de la contrainte en dehors d'une classe PHP
- [ ] **C.** De désactiver la mise en cache de la contrainte
- [ ] **D.** De permettre la validation asynchrone de la contrainte

### Question 26

Pourquoi peut-on utiliser des propriétés privées dans une contrainte personnalisée sans configuration supplémentaire ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les contraintes ne sont jamais mises en cache
- [ ] **B.** Parce que la classe `Constraint` de base implémente `__serialize()`, qui gère automatiquement toutes les propriétés, y compris privées, pour la mise en cache
- [ ] **C.** Parce que PHP rend toutes les propriétés publiques lors de la sérialisation
- [ ] **D.** Ce n'est en réalité pas possible, seules les propriétés publiques fonctionnent

### Question 27

Comment Symfony détermine-t-il par défaut quelle classe « constraint validator » exécute la validation d'une contrainte personnalisée ``MyConstraint`` ? *(une seule bonne réponse)*

- [ ] **A.** Via la méthode `validatedBy()` de la contrainte, qui retourne par défaut `static::class.'Validator'`, donc Symfony cherche `MyConstraintValidator`
- [ ] **B.** Via un fichier de configuration `validator_mapping.yaml` listant chaque paire contrainte/validator
- [ ] **C.** Via le nom du fichier PHP, qui doit obligatoirement se terminer par `Validator.php`
- [ ] **D.** Il n'y a pas de convention, il faut toujours le déclarer explicitement dans `services.yaml`

### Question 28

Combien de méthodes une classe de « constraint validator » doit-elle obligatoirement implémenter ? *(une seule bonne réponse)*

- [ ] **A.** Une seule : `validate(mixed $value, Constraint $constraint): void`
- [ ] **B.** Deux : `validate()` et `supports()`
- [ ] **C.** Trois : `validate()`, `initialize()` et `getTargets()`
- [ ] **D.** Aucune, il suffit d'étendre `ConstraintValidator` sans rien surcharger

### Question 29

Quelles sont les bonnes pratiques recommandées lors de l'écriture d'un « constraint validator » personnalisé ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ignorer les valeurs `null` et vides pour laisser d'autres contraintes (`NotBlank`, `NotNull`…) s'en occuper
- [ ] **B.** Lever une `UnexpectedValueException` si la valeur reçue n'a pas le type attendu
- [ ] **C.** Lever une `UnexpectedTypeException` si l'objet contrainte reçu n'est pas de la classe attendue
- [ ] **D.** Toujours retourner explicitement `false` en cas de valeur invalide

### Question 30

Comment un « constraint validator » signale-t-il qu'une valeur est invalide ? *(une seule bonne réponse)*

- [ ] **A.** En construisant une violation via `$this->context->buildViolation($message)->addViolation()`
- [ ] **B.** En retournant `false` depuis la méthode `validate()`
- [ ] **C.** En levant une exception `ValidationException`
- [ ] **D.** En appelant `$constraint->fail()`

### Question 31

Les messages d'erreur de validation sont-ils automatiquement traduits, et comment désactiver ce comportement si besoin ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut toujours les traduire manuellement dans le code du validator
- [ ] **B.** Oui, ils sont automatiquement traduits dans la locale courante de l'application ; on peut désactiver ce comportement via `disableTranslation()` sur le `ConstraintViolationBuilderInterface`
- [ ] **C.** Oui, mais uniquement si le bundle Translation est explicitement configuré avec `auto_translate: true`
- [ ] **D.** Non, la traduction n'est disponible que pour les contraintes natives de Symfony

### Question 32

Où doivent être déclarées les options d'une contrainte personnalisée pour être configurables comme celles des contraintes natives ? *(une seule bonne réponse)*

- [ ] **A.** Dans des propriétés `private`, accessibles via des getters dédiés
- [ ] **B.** Comme des propriétés publiques de la classe de contrainte
- [ ] **C.** Dans un tableau statique `OPTIONS` de la classe
- [ ] **D.** Dans un fichier `.env` séparé

### Question 33

Si l'application utilise la configuration par défaut de `services.yaml`, qu'implique le fait qu'un « constraint validator » soit déjà enregistré comme service et tagué `validator.constraint_validator` ? *(une seule bonne réponse)*

- [ ] **A.** Il peut recevoir des services ou de la configuration injectés dans son constructeur, comme n'importe quel autre service
- [ ] **B.** Il ne peut recevoir aucune dépendance, pour des raisons de performance de cache
- [ ] **C.** Il doit obligatoirement être déclaré `public: true`
- [ ] **D.** Il ne peut être utilisé que via des attributs PHP, jamais via YAML

### Question 34

Comment définir des options obligatoires sur une contrainte personnalisée, en plus des options optionnelles ? *(une seule bonne réponse)*

- [ ] **A.** En les déclarant comme propriétés publiques et arguments obligatoires du constructeur, celui-ci étant marqué `#[HasNamedArguments]`
- [ ] **B.** Ce n'est pas possible, toutes les options de contrainte sont nécessairement optionnelles
- [ ] **C.** En les listant dans une méthode statique `requiredOptions(): array`
- [ ] **D.** En les passant uniquement via le second argument du constructeur de `Constraint`

### Question 35

Comment appliquer de façon cohérente un même ensemble de contraintes à travers l'application, sans les répéter à chaque fois ? *(une seule bonne réponse)*

- [ ] **A.** En créant une contrainte qui étend `Assert\Compound` et définit ce jeu de contraintes dans `getConstraints()`
- [ ] **B.** En créant un `EventSubscriber` qui ajoute les contraintes dynamiquement à chaque validation
- [ ] **C.** Ce n'est pas possible nativement, il faut dupliquer les contraintes sur chaque propriété
- [ ] **D.** En utilisant un `trait` PHP contenant les appels à `addPropertyConstraint()`

### Question 36

Comment une contrainte personnalisée peut-elle s'appliquer à une classe entière plutôt qu'à une seule propriété ? *(une seule bonne réponse)*

- [ ] **A.** En surchargeant sa méthode `getTargets()` pour retourner `self::CLASS_CONSTRAINT`
- [ ] **B.** En implémentant l'interface `ClassScopedConstraint`
- [ ] **C.** En ajoutant l'attribut `#[ClassLevel]` sur la contrainte
- [ ] **D.** Ce n'est possible que pour les contraintes natives de Symfony, pas pour les contraintes personnalisées

### Question 37

Quand une contrainte cible une classe entière (via `getTargets()`), que reçoit la méthode `validate()` du « constraint validator » comme premier argument ? *(une seule bonne réponse)*

- [ ] **A.** La valeur d'une propriété arbitraire de l'objet
- [ ] **B.** L'objet lui-même (l'instance de la classe validée), et non la valeur d'une seule propriété
- [ ] **C.** Un tableau contenant toutes les propriétés publiques de l'objet
- [ ] **D.** Le nom de la classe sous forme de chaîne

### Question 38

À quoi sert la méthode `atPath()` sur le builder de violation (`ConstraintViolationBuilderInterface`) ? *(une seule bonne réponse)*

- [ ] **A.** À définir la propriété avec laquelle l'erreur de validation est associée, en utilisant n'importe quelle syntaxe PropertyAccess valide
- [ ] **B.** À définir le chemin du fichier de traduction à utiliser pour le message
- [ ] **C.** À indiquer le chemin du template Twig affichant l'erreur
- [ ] **D.** À définir l'ordre d'exécution des contraintes de la classe

### Question 39

Une contrainte de type « class constraint validator » peut-elle être appliquée directement sur une propriété plutôt que sur la classe ? *(une seule bonne réponse)*

- [ ] **A.** Oui, indifféremment, cela ne change rien à son comportement
- [ ] **B.** Non, une contrainte visant la classe entière doit être appliquée sur la classe elle-même
- [ ] **C.** Oui, mais uniquement sur des propriétés publiques
- [ ] **D.** Non, elle ne peut être appliquée que via un getter

### Question 40

Quelle classe de test Symfony fournit-il pour simplifier l'écriture de tests unitaires d'une contrainte personnalisée « atomique » ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Validator\Test\ConstraintValidatorTestCase`
- [ ] **B.** `Symfony\Bundle\FrameworkBundle\Test\ValidatorTestCase`
- [ ] **C.** `PHPUnit\Framework\Constraint\ValidatorAssertion`
- [ ] **D.** `Symfony\Component\Validator\Test\WebTestCase`

### Question 41

Dans un test étendant `ConstraintValidatorTestCase`, quelles méthodes permettent d'affirmer qu'aucune violation, ou qu'une violation précise, a été levée ? *(une seule bonne réponse)*

- [ ] **A.** `$this->assertNoViolation()` pour l'absence de violation, et `$this->buildViolation('message')->assertRaised()` pour une violation attendue
- [ ] **B.** `$this->assertValid()` et `$this->assertInvalid()`
- [ ] **C.** `$this->expectException(ConstraintViolationException::class)`
- [ ] **D.** Il faut inspecter manuellement le `ConstraintViolationList` retourné par `validate()`

### Question 42

Quelle classe de test dédiée existe pour tester spécifiquement une contrainte `Compound` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Validator\Test\CompoundConstraintTestCase`
- [ ] **B.** `Symfony\Component\Validator\Test\ConstraintValidatorTestCase`, sans particularité
- [ ] **C.** Il n'existe pas de classe dédiée, il faut tester chaque sous-contrainte séparément
- [ ] **D.** `Symfony\Bundle\FrameworkBundle\Test\CompoundTestCase`

### Question 43

Que permet la méthode `assertViolationsRaisedByCompound()` d'un test `CompoundConstraintTestCase` ? *(une seule bonne réponse)*

- [ ] **A.** De vérifier précisément lesquelles des sous-contraintes composant la `Compound` ont échoué
- [ ] **B.** De vérifier uniquement que la validation globale a échoué, sans détail
- [ ] **C.** De désactiver certaines sous-contraintes pendant le test
- [ ] **D.** De générer automatiquement un rapport de couverture des sous-contraintes

## Groupes de validation

### Question 44

À quoi servent les groupes de validation ? *(une seule bonne réponse)*

- [ ] **A.** À valider un objet contre seulement certaines des contraintes qui lui sont associées, plutôt que toutes systématiquement
- [ ] **B.** À valider plusieurs objets en une seule fois pour des raisons de performance
- [ ] **C.** À définir l'ordre d'affichage des erreurs dans un template Twig
- [ ] **D.** À restreindre la validation à un seul environnement (dev/prod)

### Question 45

Dans l'exemple classique d'une classe `User` avec des contraintes `Email`/`NotBlank`/`Length` taguées `groups: ['registration']` et une contrainte `Length` sur `city` sans groupe explicite, quels groupes de validation existent ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Default`
- [ ] **B.** `User` (le nom de la classe)
- [ ] **C.** `registration`
- [ ] **D.** `Strict`

### Question 46

Quelles contraintes appartiennent au groupe `Default` d'une classe ? *(une seule bonne réponse)*

- [ ] **A.** Celles qui n'ont aucun groupe explicitement configuré, ou dont le groupe est égal au nom de la classe ou à la chaîne `Default`
- [ ] **B.** Uniquement celles explicitement taguées `groups: ['Default']`
- [ ] **C.** Toutes les contraintes de la classe, sans exception
- [ ] **D.** Aucune, `Default` est un groupe réservé qui reste toujours vide

### Question 47

Quand valide-t-on un objet `User` seul (sans objets imbriqués), le groupe `Default` et le groupe portant le nom de la classe (`User`) se comportent-ils différemment ? *(une seule bonne réponse)*

- [ ] **A.** Non, ils sont alors identiques ; la différence apparaît uniquement quand la classe est imbriquée dans un autre objet réellement validé
- [ ] **B.** Oui, `Default` valide toujours strictement moins de contraintes que `User`
- [ ] **C.** Oui, `User` ignore systématiquement les contraintes de propriété
- [ ] **D.** Non, ils sont toujours rigoureusement identiques, y compris avec des objets imbriqués

### Question 48

Dans quel cas la distinction entre le groupe `Default` et le groupe portant le nom de la classe devient-elle significative ? *(une seule bonne réponse)*

- [ ] **A.** Quand la classe est imbriquée dans un autre objet (par exemple un `User` avec une propriété `address` de type `Address`, validée via la contrainte `Valid`) qui est lui-même l'objet réellement validé
- [ ] **B.** Uniquement quand l'application utilise plusieurs environnements
- [ ] **C.** Jamais, ces deux groupes sont toujours strictement équivalents dans tous les cas
- [ ] **D.** Uniquement quand la validation se fait via un formulaire

### Question 49

En cas d'héritage (`User extends BaseUser`), quelle différence y a-t-il entre valider avec le groupe `User` et valider avec le groupe `BaseUser` ? *(une seule bonne réponse)*

- [ ] **A.** Valider avec `User` valide toutes les contraintes définies dans `User` et `BaseUser` ; valider avec `BaseUser` ne valide que les contraintes par défaut de `BaseUser`
- [ ] **B.** Il n'y a aucune différence, l'héritage n'affecte jamais les groupes de validation
- [ ] **C.** Valider avec `BaseUser` valide systématiquement plus de contraintes que valider avec `User`
- [ ] **D.** `BaseUser` n'est jamais un groupe de validation valide

### Question 50

Comment demander au validator de n'utiliser qu'un groupe de validation précis, par exemple `registration` ? *(une seule bonne réponse)*

- [ ] **A.** En passant le nom du groupe comme troisième argument de `validate()`, par exemple `$validator->validate($author, null, ['registration'])`
- [ ] **B.** En ajoutant `?group=registration` à l'URL de la requête
- [ ] **C.** En définissant une variable d'environnement `VALIDATION_GROUP`
- [ ] **D.** Ce n'est possible que via le composant Form, jamais directement via le service `validator`

### Question 51

Que se passe-t-il si aucun groupe n'est spécifié lors de l'appel à `validate()` ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les contraintes de toutes les classes liées sont validées, sans exception
- [ ] **B.** Toutes les contraintes appartenant au groupe `Default` sont appliquées
- [ ] **C.** Aucune contrainte n'est validée
- [ ] **D.** Seules les contraintes sans aucun groupe configuré sont validées, `Default` étant ignoré

### Question 52

Où la documentation Symfony renvoie-t-elle pour apprendre à utiliser les groupes de validation à l'intérieur d'un formulaire ? *(une seule bonne réponse)*

- [ ] **A.** Vers la documentation `/form/validation_groups`
- [ ] **B.** Vers la documentation du composant Security
- [ ] **C.** Il n'existe aucune intégration entre groupes de validation et formulaires
- [ ] **D.** Vers la documentation `/validation/severity`

## Valider des valeurs brutes (scalaires et tableaux)

### Question 53

Comment valider une simple valeur scalaire (par exemple une chaîne représentant un email), sans passer par un objet métier ? *(une seule bonne réponse)*

- [ ] **A.** En passant la valeur brute et un objet contrainte à `$validator->validate($email, $emailConstraint)`
- [ ] **B.** Ce n'est pas possible, le validator ne fonctionne que sur des objets
- [ ] **C.** En créant une classe `ScalarWrapper` uniquement pour l'occasion
- [ ] **D.** En appelant `Assert\Email::validate($email)` de façon statique

### Question 54

Peut-on modifier une option d'une contrainte, comme son message d'erreur, après l'avoir instanciée mais avant de valider ? *(une seule bonne réponse)*

- [ ] **A.** Non, toutes les options doivent être passées au constructeur
- [ ] **B.** Oui, les options des contraintes sont des propriétés publiques modifiables directement, par exemple `$emailConstraint->message = 'Invalid email address';`
- [ ] **C.** Oui, mais uniquement via une méthode `setOption()` dédiée
- [ ] **D.** Non, il faut recréer entièrement l'objet contrainte

### Question 55

Comment valider la structure d'un tableau associatif (par exemple une entrée de formulaire brute) ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant la contrainte `Collection`, qui associe une sous-contrainte à chaque clé attendue du tableau
- [ ] **B.** Ce n'est pas supporté, il faut toujours convertir le tableau en objet au préalable
- [ ] **C.** Uniquement via la contrainte `Type(type: 'array')`, sans validation clé par clé
- [ ] **D.** En sérialisant le tableau en JSON puis en validant la chaîne résultante

### Question 56

Dans la contrainte `Collection`, à quoi correspondent les clés du tableau `fields` passé en option ? *(une seule bonne réponse)*

- [ ] **A.** Aux clés du tableau d'entrée à valider, chacune associée à sa (ou ses) contrainte(s)
- [ ] **B.** À des noms de groupes de validation
- [ ] **C.** À des noms de propriétés d'une entité Doctrine, indépendamment du tableau réellement validé
- [ ] **D.** À l'ordre de validation des champs, sans lien avec les clés du tableau

### Question 57

Peut-on passer des groupes de validation (par exemple via `GroupSequence`) au troisième argument de `validate()` quand on valide un tableau avec `Collection`, comme pour un objet classique ? *(une seule bonne réponse)*

- [ ] **A.** Non, les groupes ne s'appliquent qu'à la validation d'objets métier
- [ ] **B.** Oui, `$validator->validate($input, $constraint, $groups)` fonctionne de la même façon que pour un objet
- [ ] **C.** Oui, mais uniquement avec un `GroupSequenceProvider`
- [ ] **D.** Non, `Collection` ignore systématiquement tout groupe passé en argument

### Question 58

Que retourne `validate()`, et que contient chaque élément de ce retour ? *(une seule bonne réponse)*

- [ ] **A.** Un `ConstraintViolationList`, qui se comporte comme un tableau d'erreurs ; chaque élément est un `ConstraintViolation` exposant le message via `getMessage()`
- [ ] **B.** Un simple booléen indiquant si la valeur est valide ou non
- [ ] **C.** Un tableau associatif `['valid' => bool, 'errors' => array]`
- [ ] **D.** Une exception, qu'il faut systématiquement intercepter

### Question 59

Que recommande la documentation lorsqu'on utilise des groupes avec la contrainte `Collection` ? *(une seule bonne réponse)*

- [ ] **A.** D'utiliser la contrainte `Optional` là où c'est pertinent, comme expliqué dans sa documentation de référence
- [ ] **B.** De toujours désactiver les groupes pour `Collection`, qui ne les supporte pas correctement
- [ ] **C.** De dupliquer la contrainte `Collection` une fois par groupe
- [ ] **D.** De valider chaque clé du tableau séparément dans des appels distincts à `validate()`

## Appliquer les groupes de validation séquentiellement

### Question 60

À quoi sert la fonctionnalité `GroupSequence` ? *(une seule bonne réponse)*

- [ ] **A.** À déterminer l'ordre dans lequel les groupes de validation d'un objet doivent être validés, par étapes
- [ ] **B.** À fusionner plusieurs groupes en un seul groupe unique
- [ ] **C.** À paralléliser la validation de plusieurs groupes simultanément
- [ ] **D.** À définir l'ordre d'affichage des messages d'erreur dans un template

### Question 61

Avec une `GroupSequence(['User', 'Strict'])`, dans quel ordre et sous quelle condition les groupes sont-ils validés ? *(une seule bonne réponse)*

- [ ] **A.** Les deux groupes sont toujours validés simultanément, sans ordre particulier
- [ ] **B.** Le groupe `User` est validé en premier ; ce n'est que si toutes ses contraintes sont valides que le groupe `Strict` est ensuite validé
- [ ] **C.** Le groupe `Strict` est toujours validé en premier, `User` servant uniquement de repli
- [ ] **D.** L'ordre est déterminé aléatoirement à chaque appel

### Question 62

Quand une classe définit une `GroupSequence`, le groupe `Default` reste-t-il identique au groupe portant le nom de la classe ? *(une seule bonne réponse)*

- [ ] **A.** Oui, cela ne change absolument rien à la sémantique de `Default`
- [ ] **B.** Non : `Default` fait alors référence à la séquence de groupes elle-même, au lieu de désigner les contraintes sans groupe explicite
- [ ] **C.** Non, `Default` devient alors totalement vide et inutilisable
- [ ] **D.** Oui, sauf si la séquence contient plus de deux groupes

### Question 63

Pourquoi ne faut-il jamais inclure `Default` dans une `GroupSequence` définie sur `{ClassName}` ? *(une seule bonne réponse)*

- [ ] **A.** Parce que cela provoquerait une récursion infinie : `Default` référence la séquence, qui contiendrait `Default`, qui référence la même séquence, etc.
- [ ] **B.** Parce que `Default` est un mot réservé du composant Validator, syntaxiquement interdit dans une séquence
- [ ] **C.** Ce n'est en réalité pas un problème, c'est même l'usage recommandé
- [ ] **D.** Parce que cela désactiverait totalement la validation

### Question 64

Si on appelle `validate($object, null, ['Strict'])` alors que `Strict` fait partie d'une `GroupSequence` définie sur la classe, la séquence complète est-elle appliquée ? *(une seule bonne réponse)*

- [ ] **A.** Oui, toute la séquence (`User` puis `Strict`) est systématiquement validée
- [ ] **B.** Non, seule la validation avec le groupe `Strict` a lieu ; la séquence n'intervient que via la validation du groupe `Default`
- [ ] **C.** Non, cela lève une exception car `Strict` ne peut pas être appelé isolément
- [ ] **D.** Cela dépend uniquement de l'ordre de déclaration des propriétés

### Question 65

Une `GroupSequence` peut-elle aussi être définie au niveau d'un formulaire ? *(une seule bonne réponse)*

- [ ] **A.** Non, `GroupSequence` ne s'utilise que directement sur une entité
- [ ] **B.** Oui, via l'option `validation_groups` de `configureOptions()`, par exemple `'validation_groups' => new GroupSequence(['First', 'Second'])`
- [ ] **C.** Oui, mais uniquement en la déclarant dans `config/packages/validator.yaml`
- [ ] **D.** Non, il faut alors nécessairement passer par un Group Sequence Provider

### Question 66

Comment déterminer dynamiquement, selon l'état de l'entité (par exemple un utilisateur « premium »), quels groupes de validation activer ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `GroupSequenceProviderInterface` sur l'entité, avec sa méthode `getGroupSequence()`
- [ ] **B.** Ce n'est possible qu'en dupliquant l'entité en deux classes distinctes
- [ ] **C.** En ajoutant une propriété `groups` publique sur l'entité, lue automatiquement par le validator
- [ ] **D.** Uniquement via un `EventSubscriber` sur l'événement de validation

### Question 67

Que retourne `getGroupSequence()`, et quelles en sont les implications ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un tableau simple, par exemple `['User', 'Premium', 'Api']` : si un groupe échoue, les groupes suivants ne sont pas validés
- [ ] **B.** Un tableau imbriqué, par exemple `[['User', 'Premium'], 'Api']` : tous les groupes d'un même sous-tableau sont validés même si l'un d'eux échoue
- [ ] **C.** Un tableau imbriqué arrête systématiquement toute validation dès le premier sous-tableau, quel que soit son contenu
- [ ] **D.** Le type de retour peut être `array` ou une instance de `GroupSequence`

### Question 68

Comment notifier le composant Validator qu'une classe fournit dynamiquement sa séquence de groupes ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant l'attribut `#[Assert\GroupSequenceProvider]` (ou l'équivalent YAML/XML `group_sequence_provider: true`) sur la classe
- [ ] **B.** Cela se fait automatiquement dès qu'une classe implémente `GroupSequenceProviderInterface`, sans configuration supplémentaire
- [ ] **C.** En renommant la méthode `getGroupSequence()` en `__getGroupSequence()`
- [ ] **D.** En taguant le service `validator` lui-même

### Question 69

Pour des cas plus avancés, comment déléguer la logique de séquence de groupes à un service externe plutôt qu'à l'entité elle-même ? *(une seule bonne réponse)*

- [ ] **A.** En créant une classe séparée implémentant `GroupProviderInterface`, enregistrée comme fournisseur de groupes
- [ ] **B.** Ce n'est pas possible, la logique doit toujours résider dans l'entité
- [ ] **C.** En surchargeant directement le service `validator` dans le container
- [ ] **D.** En passant un callable anonyme directement dans l'attribut `#[Assert\NotBlank]`

### Question 70

Comment relie-t-on une entité à sa classe de fournisseur de groupes externe (« group provider ») ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `provider` de l'attribut `#[Assert\GroupSequenceProvider(provider: UserGroupProvider::class)]`
- [ ] **B.** En nommant le service exactement comme la classe, sans configuration explicite
- [ ] **C.** Via une méthode `setProvider()` appelée manuellement dans le contrôleur
- [ ] **D.** Ce lien ne peut être fait que via le fichier `services.yaml`, jamais via un attribut

### Question 71

Si l'autowiring n'est pas activé, comment enregistrer manuellement un « group provider » personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** En taguant son service avec `validator.group_provider`
- [ ] **B.** En l'ajoutant à un tableau statique dans le `Kernel`
- [ ] **C.** En le déclarant `public: true` uniquement, aucun tag n'est nécessaire
- [ ] **D.** En le nommant explicitement `App\Validator\GroupProvider`, seule convention reconnue

### Question 72

Comment appliquer plusieurs contraintes à une seule propriété de façon strictement séquentielle (arrêt à la première qui échoue), plus simplement qu'avec une `GroupSequence` ? *(une seule bonne réponse)*

- [ ] **A.** Avec la contrainte `Sequentially`, prévue pour ce cas d'usage précis sur une seule propriété
- [ ] **B.** Ce n'est possible qu'avec une `GroupSequence` complète, il n'existe pas de raccourci
- [ ] **C.** En listant les contraintes dans un ordre précis dans le fichier YAML, l'ordre étant alors automatiquement respecté
- [ ] **D.** Avec la contrainte `Ordered`, spécifique aux propriétés

## Gérer différents niveaux d'erreur

### Question 73

Quelles sont les deux étapes du processus permettant d'afficher différemment les erreurs de validation selon leur gravité ? *(une seule bonne réponse)*

- [ ] **A.** Attribuer un niveau d'erreur aux contraintes via l'option `payload`, puis personnaliser le template de message d'erreur en fonction de ce niveau
- [ ] **B.** Créer une classe d'exception dédiée par niveau de gravité, puis les intercepter séparément
- [ ] **C.** Définir un groupe de validation par niveau de gravité, puis les valider un par un
- [ ] **D.** Configurer un canal de log Monolog dédié par niveau, sans modification des contraintes

### Question 74

Comment attribue-t-on concrètement un niveau de sévérité (par exemple `error` ou `warning`) à une contrainte comme `NotBlank` ou `Iban` ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `payload`, par exemple `#[Assert\Iban(payload: ['severity' => 'warning'])]`
- [ ] **B.** Via une option dédiée `severity` disponible sur toutes les contraintes natives
- [ ] **C.** En créant une sous-classe de la contrainte par niveau de sévérité
- [ ] **D.** Ce n'est configurable que via un événement `kernel.exception`

### Question 75

Une fois la validation échouée, comment récupérer la contrainte responsable d'une violation donnée, et où se trouve le niveau de sévérité qui lui a été attribué ? *(une seule bonne réponse)*

- [ ] **A.** Via `ConstraintViolation::getConstraint()`, le payload étant ensuite exposé comme propriété publique de la contrainte (`$constraint->payload['severity']`)
- [ ] **B.** Via `ConstraintViolation::getSeverity()`, une méthode dédiée
- [ ] **C.** Ce n'est pas accessible depuis la violation, il faut revalider séparément avec chaque contrainte
- [ ] **D.** Via `$constraint->getPayload()->getSeverityLevel()`

### Question 76

Comment exploiter ce niveau de sévérité pour personnaliser l'affichage des erreurs d'un formulaire en Twig ? *(une seule bonne réponse)*

- [ ] **A.** En surchargeant le bloc `form_errors` pour ajouter, par exemple, `error.cause.constraint.payload.severity` comme classe HTML sur chaque erreur
- [ ] **B.** Ce n'est pas possible depuis Twig, il faut post-traiter le rendu HTML en JavaScript
- [ ] **C.** En utilisant un filtre Twig `severity_class` fourni nativement par le TwigBundle
- [ ] **D.** En passant la sévérité comme paramètre d'URL au template d'erreur

## Traduire les messages de contrainte de validation

### Question 77

Dans quel domaine de traduction les messages d'erreur de validation sont-ils recherchés par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Le domaine `validators`
- [ ] **B.** Le domaine `messages`, comme toutes les autres traductions
- [ ] **C.** Le domaine `errors`
- [ ] **D.** Il n'existe pas de domaine dédié, seule la locale compte

### Question 78

Comment traduire le message d'une contrainte comme `#[Assert\NotBlank(message: 'author.name.not_blank')]` ? *(une seule bonne réponse)*

- [ ] **A.** En définissant le `message` comme clé de traduction, puis en créant un catalogue `translations/validators/validators.<locale>.xlf` (ou `.yaml`/`.php`) associant cette clé à un texte traduit
- [ ] **B.** En modifiant directement le fichier de traduction interne du composant Validator
- [ ] **C.** Ce n'est pas possible, seuls les messages par défaut des contraintes natives sont traduisibles
- [ ] **D.** En passant le message déjà traduit en dur dans l'attribut, sans fichier de catalogue

### Question 79

Que faut-il faire après avoir créé pour la première fois un fichier de catalogue de traduction pour les messages de validation ? *(une seule bonne réponse)*

- [ ] **A.** Rien, le fichier est pris en compte immédiatement, y compris en environnement `dev`
- [ ] **B.** Vider le cache, même en environnement `dev`
- [ ] **C.** Redémarrer entièrement le serveur PHP
- [ ] **D.** Recompiler le container avec `bin/console cache:warmup --translations`

### Question 80

À quoi sert l'option `enabled_locales` en lien avec les traductions des messages de validation intégrés ? *(une seule bonne réponse)*

- [ ] **A.** À restreindre les locales disponibles dans l'application, ce qui améliore les performances puisque Symfony ne génère les fichiers de traduction que pour ces locales
- [ ] **B.** À définir la locale par défaut utilisée en l'absence de préférence utilisateur
- [ ] **C.** À forcer la traduction de tous les messages, même les personnalisés, quelle que soit la locale du visiteur
- [ ] **D.** À désactiver totalement la traduction des messages de validation intégrés

### Question 81

Comment construire un message de violation traduisible directement depuis un `Callback`, en spécifiant explicitement un domaine de traduction ? *(une seule bonne réponse)*

- [ ] **A.** En passant un objet `TranslatableMessage` à `buildViolation()`, par exemple `buildViolation(new TranslatableMessage('author.name.fake', [], 'validators'))`
- [ ] **B.** En appelant `buildViolation()->translate('validators')`
- [ ] **C.** Ce n'est pas possible dans un `Callback`, seules les contraintes natives le permettent
- [ ] **D.** En passant le domaine comme cinquième argument positionnel de `buildViolation()`

### Question 82

Comment changer globalement, pour toute l'application, le domaine de traduction par défaut utilisé pour les messages de validation ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `framework.validation.translation_domain` dans la configuration
- [ ] **B.** En renommant le fichier `translations/validators/validators.<locale>.yaml`
- [ ] **C.** Ce n'est pas configurable globalement, uniquement violation par violation
- [ ] **D.** Via la variable d'environnement `VALIDATOR_TRANSLATION_DOMAIN`

### Question 83

Peut-on personnaliser le domaine de traduction pour une violation précise, directement depuis un constraint validator ? *(une seule bonne réponse)*

- [ ] **A.** Oui, en appelant `->setTranslationDomain('validation_errors')` sur le builder de violation avant `addViolation()`
- [ ] **B.** Non, le domaine ne peut être défini qu'au niveau global de l'application
- [ ] **C.** Oui, mais uniquement en redéfinissant tout le service `translator`
- [ ] **D.** Non, chaque contrainte est irrémédiablement liée au domaine `validators`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Validation de la documentation Symfony 8.0](https://symfony.com/doc/8.0/validation.html) ; les entrées annotées d'un préfixe (ex. *Custom Constraint —*) renvoient à l'une des pages listées dans sa section Learn more.

**Question 1 : A** — « Get them installed with: `$ composer require symfony/validator` » *(§ Installation)*

**Question 2 : A** — « These rules are usually defined using PHP code or attributes but they can also be defined as `.yaml` or `.xml` files inside the `config/validator/` directory. » — le JSON n'est pas un format de mapping supporté nativement. *(§ The Basics of Validation)*

**Question 3 : B** — « Adding this configuration by itself does not yet guarantee that the value will not be blank (…) the object must be passed to the validator service to be checked. » *(§ The Basics of Validation)*

**Question 4 : A** — « Symfony's validator uses PHP reflection, as well as "getter" methods, to get the value of any property, so they can be public, private or protected. » *(§ The Basics of Validation)*

**Question 5 : B** — « Symfony provides a JSON schema for validation mapping files that enables autocompletion and validation in IDEs like PhpStorm. » *(§ The Basics of Validation)*

**Question 6 : A** — « use the `validate()` method on the `validator` service (which implements `ValidatorInterface`). (…) If validation fails, a non-empty list of errors (`ConstraintViolationList` class) is returned. » *(§ Using the Validator Service)*

**Question 7 : A** — « Each validation error (called a "constraint violation"), is represented by a `ConstraintViolation` object. This object allows you (…) to get the constraint that caused this violation thanks to the `ConstraintViolation::getConstraint()` method. » *(§ Using the Validator Service)*

**Question 8 : A, B, C** — « `Validation::createCallable` — This returns a closure that throws `ValidationFailedException` when the constraints aren't matched. `Validation::createIsValidCallable` — This returns a closure that returns `false` when the constraints aren't matched. » *(§ Validation Callables)*

**Question 9 : A** — « a constraint is a PHP object that makes an assertive statement. (…) Given a value, a constraint will tell you if that value adheres to the rules of the constraint. » *(§ Constraints)*

**Question 10 : B** — « the `Choice` constraint, have several configuration options available (…) `#[Assert\Choice(choices: ['fiction', 'non-fiction'], message: 'Choose a valid genre.')]` » *(§ Constraint Configuration)*

**Question 11 : A** — « Constraints can be defined while building the form via the `constraints` option of the form fields » *(§ Constraints in Form Classes)*

**Question 12 : A, B, C** — « Constraints can be applied to a class property (…), a getter method (…) or an entire class. » *(§ Constraint Targets)*

**Question 13 : B** — « Symfony allows you to validate private, protected or public properties. » *(§ Properties)*

**Question 14 : B** — « The validator will use a value `null` if a typed property is uninitialized. This can cause unexpected behavior (…) make sure all properties are initialized before validating them. » *(§ Properties)*

**Question 15 : A** — « Symfony allows you to add a constraint to any private, protected or public method whose name starts with "get", "is" or "has". » *(§ Getters)*

**Question 16 : B** — « This allows you to move the constraint to a property with the same name later (or vice versa) without changing your validation logic. » *(§ Getters)*

**Question 17 : A** — « the `Callback` constraint is a generic constraint that's applied to the class itself. When that class is validated, methods specified by that constraint are simply executed. » *(§ Classes)*

**Question 18 : B** — « The constraints defined in the parent properties will be applied to the child properties even if the child properties override those constraints. Symfony will always merge the parent constraints for each property. (…) you can overcome it by defining the parent and the child constraints in different validation groups. » *(§ Validating Object With Inheritance)*

**Question 19 : A** — « create a separate class and use the `#[ExtendsValidationFor]` attribute to tell the Validator which class should receive these constraints. » *(§ Extending Validation for a Class)*

**Question 20 : B** — « You can only define constraints for properties that exist on the target class. Otherwise, a `MappingException` is thrown. » *(§ Extending Validation for a Class)*

**Question 21 : A** — « Use the `debug:validator` command to list the validation constraints of a given class: `$ php bin/console debug:validator 'App\Entity\SomeClass'` » *(§ Debugging the Constraints)*

**Question 22 : B** — « You can also validate all the classes stored in a given directory: `$ php bin/console debug:validator src/Entity` » *(§ Debugging the Constraints)*

**Question 23 : A** — « You can create a custom constraint by extending the base constraint class, `Symfony\Component\Validator\Constraint`. » *(Custom Constraint — § Creating the Constraint Class)*

**Question 24 : B** — « Add `#[\Attribute]` to the constraint class if you want to use it as an attribute in other classes. » *(Custom Constraint — § Creating the Constraint Class)*

**Question 25 : A** — « You can use `#[HasNamedArguments]` to make some constraint options required. » *(Custom Constraint — § Creating the Constraint Class)*

**Question 26 : B** — « Constraints are cached for performance reasons. The base `Constraint` class implements `__serialize()`, which automatically handles all properties, including private ones defined in child classes. » *(Custom Constraint — § Creating the Constraint Class)*

**Question 27 : A** — « The constraint validator class is specified by the constraint's `validatedBy()` method (…) `return static::class.'Validator';` (…) if you create a custom `Constraint` (e.g. `MyConstraint`), Symfony will automatically look for another class, `MyConstraintValidator`. » *(Custom Constraint — § Creating the Validator itself)*

**Question 28 : A** — « The validator class only has one required method `validate()`. » *(Custom Constraint — § Creating the Validator itself)*

**Question 29 : A, B, C** — « custom constraints should ignore null and empty values (…) throw this exception if your validator cannot handle the passed type (`UnexpectedValueException`) (…) » et `throw new UnexpectedTypeException($constraint, ContainsAlphanumeric::class);` si la contrainte n'est pas du bon type. *(Custom Constraint — § Creating the Validator itself)*

**Question 30 : A** — « `$this->context->buildViolation($constraint->message)->setParameter('{{ string }}', $value)->addViolation();` » *(Custom Constraint — § Creating the Validator itself)*

**Question 31 : B** — « Validation error messages are automatically translated to the current application locale. If your application doesn't use translations, you can disable this behavior by calling the `disableTranslation()` method. » *(Custom Constraint — § Creating the Validator itself)*

**Question 32 : B** — « If your constraint contains options, then they must be public properties on the custom Constraint class you created earlier. » *(Custom Constraint — § Using the new Validator)*

**Question 33 : A** — « your validator is already registered as a service and tagged with the necessary `validator.constraint_validator`. This means you can inject services or configuration like any other service. » *(Custom Constraint — § Constraint Validators with Dependencies)*

**Question 34 : A** — « declare them as public properties on the constraint class, add them as mandatory constructor arguments, and apply the `#[HasNamedArguments]` attribute to the constructor. » *(Custom Constraint — § Constraint Validators with Custom Options)*

**Question 35 : A** — « you can extend the Compound constraint. » *(Custom Constraint — § Create a Reusable Set of Constraints)*

**Question 36 : A** — « create a constraint and override the `getTargets()` method (…) `return self::CLASS_CONSTRAINT;` » *(Custom Constraint — § Class Constraint Validator)*

**Question 37 : B** — « Now, the constraint validator will get an object as the first argument to `validate()`. » *(Custom Constraint — § Class Constraint Validator)*

**Question 38 : A** — « The `atPath()` method defines the property with which the validation error is associated. Use any valid PropertyAccess syntax to define that property. » *(Custom Constraint — § Class Constraint Validator)*

**Question 39 : B** — « A class constraint validator must be applied to the class itself. » *(Custom Constraint — § Class Constraint Validator)*

**Question 40 : A** — « Use the `Symfony\Component\Validator\Test\ConstraintValidatorTestCase` class to simplify writing unit tests for your custom constraints. » *(Custom Constraint — § Atomic Constraints)*

**Question 41 : A** — « `$this->assertNoViolation();` » et « `$this->buildViolation('myMessage')->setParameter('{{ string }}', '...')->assertRaised();` » *(Custom Constraint — § Atomic Constraints)*

**Question 42 : A** — « You can use the `Symfony\Component\Validator\Test\CompoundConstraintTestCase` class to check precisely which of the constraints failed to pass. » *(Custom Constraint — § Compound Constraints)*

**Question 43 : A** — « `$this->assertViolationsRaisedByCompound([new Assert\NotCompromisedPassword(), new Assert\Regex('/[A-Z]+/')]);` » — vérifie précisément quelles sous-contraintes ont échoué. *(Custom Constraint — § Compound Constraints)*

**Question 44 : A** — « In some cases, however, you will need to validate an object against only *some* constraints on that class. To do this, you can organize each constraint into one or more "validation groups". » *(Groups — introduction)*

**Question 45 : A, B, C** — « With this configuration, there are three validation groups: `Default` (…), `User` — Equivalent to all constraints of the `User` object in the `Default` group (…), `registration` — This is a custom validation group. » *(Groups — introduction)*

**Question 46 : A** — « Constraints in the `Default` group of a class are the constraints that have either no explicit group configured or that are configured to a group equal to the class name or the string `Default`. » *(Groups — introduction)*

**Question 47 : A** — « When validating *just* the User object, there is no difference between the `Default` group and the `User` group. » *(Groups — introduction)*

**Question 48 : A** — « there is a difference if `User` has embedded objects. For example, imagine `User` has an `address` property that contains some `Address` object (…) validated when you validate the `User` object. » *(Groups — introduction)*

**Question 49 : A** — « If you have inheritance (…) and you validate with the class name of the subclass (…), then all constraints in the `User` and `BaseUser` will be validated. However, if you validate using the base class (…), then only the default constraints in the `BaseUser` class will be validated. » *(Groups — introduction)*

**Question 50 : A** — « To tell the validator to use a specific group, pass one or more group names as the third argument to the `validate()` method: `$errors = $validator->validate($author, null, ['registration']);` » *(Groups — introduction)*

**Question 51 : B** — « If no groups are specified, all constraints that belong to the group `Default` will be applied. » *(Groups — introduction)*

**Question 52 : A** — « For information on how to use validation groups inside forms, see `/form/validation_groups`. » *(Groups — introduction)*

**Question 53 : A** — « use the validator to validate the value: `$errors = $validator->validate($email, $emailConstraint);` » *(Raw Values — introduction)*

**Question 54 : B** — « all constraint "options" can be set this way: `$emailConstraint->message = 'Invalid email address';` » *(Raw Values — introduction)*

**Question 55 : A** — « Validation of arrays is possible using the `Collection` constraint. » *(Raw Values — introduction)*

**Question 56 : A** — « the keys correspond to the keys in the input array » *(Raw Values — introduction)*

**Question 57 : B** — « `$violations = $validator->validate($input, $constraint, $groups);` » où `$groups` est une `GroupSequence`, exactement comme pour un objet. *(Raw Values — introduction)*

**Question 58 : A** — « The `validate()` method returns a `ConstraintViolationList` object, which acts like an array of errors. Each error (…) is a `ConstraintViolation` object, which holds the error message on its `getMessage()` method. » *(Raw Values — introduction)*

**Question 59 : A** — « When using groups with the Collection constraint, be sure to use the `Optional` constraint when appropriate as explained in its reference documentation. » *(Raw Values — introduction)*

**Question 60 : A** — « In some cases, you want to validate your groups by steps. To do this, you can use the `GroupSequence` feature. (…) an object defines a group sequence, which determines the order groups should be validated. » *(Sequence Provider — introduction)*

**Question 61 : B** — « it will first validate all constraints in the group `User` (…). Only if all constraints in that group are valid, the second group, `Strict`, will be validated. » *(Sequence Provider — introduction)*

**Question 62 : B** — « when using Group Sequences, they are no longer identical. The `Default` group will now reference the group sequence, instead of all constraints that do not belong to any group. » *(Sequence Provider — introduction)*

**Question 63 : A** — « When using `Default`, you get an infinite recursion (as the `Default` group references the group sequence, which will contain the `Default` group which references the same group sequence, ...). » *(Sequence Provider — introduction)*

**Question 64 : B** — « Calling `validate()` with a group in the sequence (`Strict` in previous example) will cause a validation **only** with that group and not with all the groups in the sequence. This is because sequence is now referred to `Default` group validation. » *(Sequence Provider — introduction)*

**Question 65 : B** — « You can also define a group sequence in the `validation_groups` form option: `'validation_groups' => new GroupSequence(['First', 'Second']),` » *(Sequence Provider — introduction)*

**Question 66 : A** — « you can create a Group Sequence Provider. (…) change the `User` class to implement `GroupSequenceProviderInterface` and add the `getGroupSequence()` method. » *(Sequence Provider — § Group Sequence Providers)*

**Question 67 : A, B, D** — « when returning a simple array, if there's a violation in any group the rest of the groups are not validated. (…) when returning a nested array, all the groups included in each array are validated. » ; signature `getGroupSequence(): array|GroupSequence`. *(Sequence Provider — § Group Sequence Providers)*

**Question 68 : A** — « you have to notify the Validator component that your `User` class provides a sequence of groups to be validated » via `#[Assert\GroupSequenceProvider]` (ou `group_sequence_provider: true`). *(Sequence Provider — § Group Sequence Providers)*

**Question 69 : A** — « you can configure the implementation of the `GroupProviderInterface` outside of the entity, and even register the group provider as a service. » *(Sequence Provider — § Advanced Validation Group Provider)*

**Question 70 : A** — « use the `provider` option within the `GroupSequenceProvider` attribute to link the entity with the provider class. » *(Sequence Provider — § Advanced Validation Group Provider)*

**Question 71 : A** — « if autowiring is enabled, your custom provider will be automatically linked. Otherwise, you must tag your service manually with the `validator.group_provider` tag. » *(Sequence Provider — § Advanced Validation Group Provider)*

**Question 72 : A** — « Sometimes, you may want to apply constraints sequentially on a single property. The `Sequentially` constraint can solve this for you in a more straightforward way than using a `GroupSequence`. » *(Sequence Provider — § How to Sequentially Apply Constraints on a Single Property)*

**Question 73 : A** — « The process to achieve this behavior consists of two steps: Apply different error levels to the validation constraints; Customize your error messages depending on the configured error level. » *(Severity — introduction)*

**Question 74 : A** — « Use the `payload` option to configure the error level for each constraint » — ex. `#[Assert\Iban(payload: ['severity' => 'warning'])]`. *(Severity — § Assigning the Error Level)*

**Question 75 : A** — « you can retrieve the constraint that caused a particular failure using the `ConstraintViolation::getConstraint` method. Each constraint exposes the attached payload as a public property: `$severity = $constraint->payload['severity'] ?? null;` » *(Severity — § Customize the Error Message Template)*

**Question 76 : A** — « you can leverage this to customize the `form_errors` block so that the severity is added as an additional HTML class: `<li class="{{ error.cause.constraint.payload.severity ?? '' }}">` » *(Severity — § Customize the Error Message Template)*

**Question 77 : A** — « The validation constraints used in forms can translate their error messages by creating a translation resource for the `validators` translation domain. » *(Translations — introduction)*

**Question 78 : A** — « Set the message option to the translation source text (…) Now, create a `validators` catalog file in the `translations/` directory. » *(Translations — introduction)*

**Question 79 : B** — « You may need to clear your cache (even in the dev environment) after creating this file for the first time. » *(Translations — introduction)*

**Question 80 : A** — « You can optionally set the `enabled_locales` option to restrict the available locales in your application. This will improve performance a bit because Symfony will only generate the translation files for those locales instead of all of them. » *(Translations — introduction)*

**Question 81 : A** — « `$context->buildViolation(new TranslatableMessage('author.name.fake', [], 'validators'))->atPath('firstName')->addViolation();` » *(Translations — introduction)*

**Question 82 : A** — « The default translation domain can be changed globally using the `FrameworkBundle` configuration: `framework: validation: translation_domain: validation_errors` » *(Translations — § Custom Translation Domain)*

**Question 83 : A** — « Or it can be customized for a specific violation from a constraint validator: `->setTranslationDomain('validation_errors')` » *(Translations — § Custom Translation Domain)*

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/validation.html#learn-more) de la page :

- [How to Create a Custom Validation Constraint](https://symfony.com/doc/8.0/validation/custom_constraint.html) — questions 23 à 43
- [How to Apply only a Subset of all Your Validation Constraints (Validation Groups)](https://symfony.com/doc/8.0/validation/groups.html) — questions 44 à 52
- [How to Validate Raw Values (Scalar Values and Arrays)](https://symfony.com/doc/8.0/validation/raw_values.html) — questions 53 à 59
- [How to Sequentially Apply Validation Groups](https://symfony.com/doc/8.0/validation/sequence_provider.html) — questions 60 à 72
- [How to Handle Different Error Levels](https://symfony.com/doc/8.0/validation/severity.html) — questions 73 à 76
- [How to Translate Validation Constraint Messages](https://symfony.com/doc/8.0/validation/translations.html) — questions 77 à 83
