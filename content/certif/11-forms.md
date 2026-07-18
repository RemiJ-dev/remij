# QCM — Forms

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/forms.html](https://symfony.com/doc/8.0/forms.html) (questions 1 à 36) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/forms.html#learn-more) (questions 37 à 161) · **Généré le :** 20 juillet 2026
>
> **161 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> C'est un très gros sujet : la page principale a **22 liens** dans sa section Learn more (contre 5 à 7 pour les autres QCM de cette série). Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Comprendre le fonctionnement des formulaires

### Question 1

Comment la documentation décrit-elle un formulaire Symfony sur le plan conceptuel ? *(une seule bonne réponse)*

- [ ] **A.** Comme une couche de mapping **bidirectionnelle** entre des objets PHP (ou tableaux) et un formulaire HTML
- [ ] **B.** Comme un simple générateur de balises HTML sans lien avec les objets PHP
- [ ] **C.** Comme une extension du composant Validator
- [ ] **D.** Comme un ORM dédié aux données de formulaire

### Question 2

Quelles sont les trois représentations (« data layers ») par lesquelles passent les données d'un champ ? *(une seule bonne réponse)*

- [ ] **A.** Model Data, Normalized Data, View Data
- [ ] **B.** Raw Data, Clean Data, Final Data
- [ ] **C.** Input Data, Output Data, Cache Data
- [ ] **D.** Entity Data, DTO Data, Array Data

### Question 3

Pour un champ `DateType` rendu en trois `<select>`, que valent respectivement les Model, Norm et View data ? *(une seule bonne réponse)*

- [ ] **A.** Model : un objet `DateTime` ; Norm : un tableau `['year' => 2026, 'month' => 10, 'day' => 18]` (entiers) ; View : le même tableau mais en chaînes
- [ ] **B.** Les trois représentations sont strictement identiques pour `DateType`
- [ ] **C.** Model et Norm sont identiques, seule la View diffère en type scalaire
- [ ] **D.** Il n'y a pas de Norm Data pour les champs composés

### Question 4

Quelles affirmations sur le flux de rendu / soumission d'un formulaire sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Au rendu, les model transformers convertissent d'abord la donnée du modèle en donnée normalisée, puis les view transformers la convertissent en donnée de vue
- [ ] **B.** À la soumission, les view transformers inversent la donnée de vue en donnée normalisée, puis les model transformers l'inversent en donnée modèle
- [ ] **C.** La plupart du temps, il n'est pas nécessaire de penser à ces couches — elles ne deviennent utiles qu'en debug ou pour des transformers personnalisés
- [ ] **D.** Le flux de soumission ignore toujours les model transformers

## Les « form types »

### Question 5

Quelle est la particularité du concept de « form type » dans Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Un simple champ, un groupe de champs, ou un `<form>` entier sont tous des « form types » — un concept unifié qui rend le composant plus flexible et composable
- [ ] **B.** Symfony distingue strictement les « form types » (champs) des « forms » (formulaires complets), comme dans d'autres frameworks
- [ ] **C.** Seuls les champs natifs (`TextType`, `ChoiceType`…) sont des form types ; les classes créées par l'utilisateur n'en sont pas
- [ ] **D.** Un form type ne peut contenir qu'un seul champ HTML

### Question 6

Quelles affirmations sur la hiérarchie des form types sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Chaque form type a un parent, qui détermine son comportement, ses options et son rendu de base ; `FormType` est la racine de tous les types
- [ ] **B.** `EmailType` réutilise le rendu et les options de `TextType` grâce à cette hiérarchie
- [ ] **C.** Le parent d'un type personnalisé se définit via la méthode `getParent()`
- [ ] **D.** Un form type ne peut avoir qu'un seul enfant direct

### Question 7

À quoi sert la commande `debug:form` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Lister tous les types disponibles, leurs extensions de type et leurs devineurs (« guessers »)
- [ ] **B.** Affichée avec le FQCN (ou le nom court pour un type natif) d'un type, elle montre les options de ce type, de ses parents et de ses extensions
- [ ] **C.** Affichée avec en plus un nom d'option, elle montre la définition complète de cette seule option
- [ ] **D.** Elle génère automatiquement une classe de formulaire

## Construire un formulaire

### Question 8

Comment créer un formulaire directement dans un contrôleur qui étend `AbstractController` ? *(une seule bonne réponse)*

- [ ] **A.** Avec le helper `createFormBuilder()`
- [ ] **B.** En instanciant directement `new Form()`
- [ ] **C.** Uniquement via une classe de formulaire dédiée
- [ ] **D.** Avec `$this->formFactory->create()`

### Question 9

Quelles affirmations sur les classes de formulaire (ex. `TaskType extends AbstractType`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Symfony recommande de déplacer la logique de formulaire complexe hors du contrôleur, dans des classes dédiées et réutilisables
- [ ] **B.** `AbstractType` implémente déjà `FormTypeInterface` et fournit des utilitaires
- [ ] **C.** Il est généralement conseillé de déclarer explicitement l'option `data_class`, car le nom de la classe sous-jacente n'est sinon deviné qu'à partir de l'objet passé — ce qui ne suffira plus dès qu'on imbrique des formulaires
- [ ] **D.** Une classe de formulaire ne peut jamais être testée unitairement

### Question 10

Quelles affirmations sur le mapping des champs vers les propriétés de l'objet sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, un champ `dueDate` lit/écrit la propriété `dueDate` via le composant PropertyAccess (accesseurs `get*/is*/has*/set*` ou propriété publique)
- [ ] **B.** L'option `property_path` permet de faire pointer un champ vers une propriété différente, y compris une propriété imbriquée via la notation pointée (ex. `category.name`)
- [ ] **C.** Les champs qui ne doivent pas être réécrits sur l'objet sous-jacent doivent utiliser les champs non mappés (`mapped: false`)
- [ ] **D.** `property_path` ne fonctionne que sur des propriétés de premier niveau

### Question 11

Comment injecter des services dans une classe de formulaire ? *(une seule bonne réponse)*

- [ ] **A.** Une classe de formulaire est un service classique : on injecte les dépendances via son constructeur, avec l'autowiring habituel (actif par défaut avec `services.yaml`)
- [ ] **B.** Ce n'est pas possible, les form types sont instanciés en dehors du container
- [ ] **C.** Uniquement via le service `form.factory`
- [ ] **D.** En important le container complet dans `buildForm()`

## Afficher (rendre) un formulaire

### Question 12

Que fait la fonction Twig `form(form)` ? *(une seule bonne réponse)*

- [ ] **A.** Elle rend tous les champs ainsi que les balises d'ouverture et de fermeture `<form>` ; par défaut la méthode est `POST` et l'URL cible est celle qui a affiché le formulaire
- [ ] **B.** Elle ne rend que les champs, sans les balises `<form>`
- [ ] **C.** Elle nécessite obligatoirement de préciser la méthode et l'action
- [ ] **D.** Elle appelle automatiquement `$form->handleRequest()`

### Question 13

Quelles affirmations sur les thèmes de formulaire natifs sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Configurer `twig.form_themes` permet, par exemple, d'utiliser le thème Bootstrap 5 pour tous les formulaires
- [ ] **B.** Les thèmes intégrés incluent Bootstrap 3, 4 et 5, Foundation 5 et 6, ainsi que Tailwind 2
- [ ] **C.** On ne peut pas créer son propre thème de formulaire
- [ ] **D.** En plus des thèmes, Symfony permet de personnaliser le rendu en appelant séparément les fonctions pour le widget, le label, les erreurs, l'aide, etc.

## Traiter (processer) un formulaire

### Question 14

Quels sont les chemins possibles décrits pour un contrôleur qui affiche et traite le formulaire dans une seule action ? *(plusieurs bonnes réponses)*

- [ ] **A.** Chargement initial : le formulaire n'est pas soumis (`isSubmitted()` = `false`), il est simplement créé et rendu
- [ ] **B.** Soumission avec données invalides : `handleRequest()` écrit les données puis `isValid()` retourne `false`, le formulaire est rendu à nouveau avec les erreurs
- [ ] **C.** Soumission avec données valides : on effectue une action puis on redirige l'utilisateur
- [ ] **D.** Il n'existe que deux chemins possibles : soumis ou non soumis

### Question 15

Quand un formulaire soumis est invalide et qu'on passe `$form` (et non `$form->createView()`) à `render()`, que se passe-t-il automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** Le code de réponse est mis à `HTTP 422 Unprocessable Content`, pour rester compatible avec des outils comme Symfony UX Turbo
- [ ] **B.** Une exception est levée
- [ ] **C.** La page redirige automatiquement vers l'accueil
- [ ] **D.** Rien de spécial, le code reste 200

### Question 16

Quelles méthodes d'accès aux données d'un formulaire sont décrites, et que retournent-elles ? *(plusieurs bonnes réponses)*

- [ ] **A.** `getData()` retourne la donnée **modèle**, la plus couramment utilisée
- [ ] **B.** `getNormData()` retourne la donnée **normalisée**, utile pour déboguer les transformers
- [ ] **C.** `getViewData()` retourne la donnée de **vue**, ce qui est rendu en HTML et reçu à la soumission
- [ ] **D.** `getExtraData()` retourne uniquement les erreurs de validation

### Question 17

Que signifie qu'un formulaire (ou un champ) n'est pas « synchronisé » (`isSynchronized()` retourne `false`) ? *(une seule bonne réponse)*

- [ ] **A.** Qu'un transformer a échoué lors de la transformation des données
- [ ] **B.** Que le formulaire n'a pas encore été soumis
- [ ] **C.** Que la validation a échoué
- [ ] **D.** Que le formulaire n'a pas de `data_class`

### Question 18

Quelles affirmations sur la méthode `submit()` (alternative à `handleRequest()`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elle offre un contrôle plus fin sur le moment exact de la soumission et sur les données transmises
- [ ] **B.** La liste des champs soumis doit correspondre à celle définie par la classe de formulaire, sinon une erreur de validation apparaît
- [ ] **C.** On peut soumettre un champ individuel directement via `$form->get('firstName')->submit('Fabien')`
- [ ] **D.** `submit()` ne peut jamais être utilisée avec une requête `PATCH`

### Question 19

Lors d'une requête `PATCH`, à quoi sert le second argument booléen de `submit()`, et quel avertissement l'accompagne ? *(une seule bonne réponse)*

- [ ] **A.** Passer `false` conserve les champs absents de la soumission (au lieu de les mettre à `null`) — mais la validation ne s'applique alors qu'aux champs soumis, sauf à ajouter manuellement les champs requis
- [ ] **B.** Il détermine si le formulaire redirige après soumission
- [ ] **C.** Il active ou désactive le CSRF
- [ ] **D.** Il n'a aucun effet documenté

### Question 20

Comment déterminer quel bouton de soumission a été cliqué quand un formulaire en a plusieurs ? *(plusieurs bonnes réponses)*

- [ ] **A.** En appelant `isClicked()` sur le bouton via `$form->get('saveAndAdd')->isClicked()`
- [ ] **B.** En utilisant `$form->getClickedButton()->getName()`
- [ ] **C.** Pour des formulaires imbriqués où deux boutons portent le même nom, comparer les objets bouton entre eux plutôt que les noms
- [ ] **D.** Il est impossible de savoir quel bouton a été cliqué depuis le contrôleur

## Valider un formulaire

### Question 21

Quelles affirmations sur la validation d'un formulaire sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$form->isValid()` est un raccourci qui demande en réalité à l'objet sous-jacent (`$task`) s'il est valide, une fois les données appliquées
- [ ] **B.** Il faut installer `composer require symfony/validator` avant de pouvoir valider
- [ ] **C.** Les contraintes de validation peuvent être ajoutées à la classe de l'entité, ou via l'option `constraints` des form types — les deux approches sont utilisables ensemble
- [ ] **D.** La validation ne peut être configurée que sur l'entité, jamais sur le form type

### Question 22

Comment désactiver entièrement la validation d'un formulaire, et que se passe-t-il malgré tout ? *(une seule bonne réponse)*

- [ ] **A.** En mettant l'option `validation_groups` à `false` — des vérifications d'intégrité basiques (taille de fichier uploadé, champs inexistants…) s'exécutent quand même
- [ ] **B.** En supprimant toutes les contraintes de l'entité
- [ ] **C.** En passant `novalidate` côté serveur
- [ ] **D.** Ce n'est pas possible de désactiver la validation

### Question 23

Dans un formulaire multi-étapes avec un bouton « Previous », comment éviter que cliquer dessus déclenche la validation ? *(une seule bonne réponse)*

- [ ] **A.** En mettant `'validation_groups' => false` sur ce bouton spécifiquement
- [ ] **B.** En supprimant le bouton du formulaire
- [ ] **C.** Ce n'est configurable qu'au niveau du formulaire entier, pas par bouton
- [ ] **D.** En ajoutant `novalidate` sur ce bouton

## Autres fonctionnalités courantes

### Question 24

Comment passer des options personnalisées à un formulaire construit en classe, et que faut-il faire côté form type ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les passer comme 3ᵉ argument optionnel de `createForm()`
- [ ] **B.** Déclarer chaque option acceptée (avec sa valeur par défaut) dans `configureOptions()`, sinon une erreur « The option … does not exist » apparaît
- [ ] **C.** Les options ne sont ensuite disponibles que dans `configureOptions()`, jamais dans `buildForm()`
- [ ] **D.** `OptionsResolver` permet aussi de définir les types autorisés pour une option (`setAllowedTypes()`)

### Question 25

Quelle affirmation sur l'option `required` est vraie ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne déclenche qu'une validation HTML5 côté client ; côté serveur, une valeur vide sera acceptée sauf à utiliser en plus une contrainte `NotBlank`/`NotNull`
- [ ] **B.** Elle empêche systématiquement la soumission de valeurs vides, y compris côté serveur
- [ ] **C.** Elle est fausse par défaut
- [ ] **D.** Elle ne s'applique qu'aux champs de type `ChoiceType`

### Question 26

Comment est déterminé le label par défaut d'un champ, et comment le personnaliser ? *(une seule bonne réponse)*

- [ ] **A.** C'est la version « humanisée » du nom de la propriété (ex. `postalAddress` → « Postal Address ») ; l'option `label` permet de le définir explicitement, ou de le masquer avec `false`
- [ ] **B.** Le label est toujours identique au nom technique du champ
- [ ] **C.** Il faut un fichier de traduction dédié, aucune autre option n'existe
- [ ] **D.** Le label est généré à partir du type du champ (`TextType` → « Text »)

### Question 27

Quelles affirmations sur l'action et la méthode HTTP d'un formulaire sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, le formulaire est soumis en `POST` vers l'URL qui l'a affiché ; `setAction()`/`setMethod()` (ou les options `action`/`method`) permettent de changer cela
- [ ] **B.** Si la méthode est `PUT`, `PATCH` ou `DELETE`, Symfony insère un champ caché `_method` et soumet réellement en `POST` ; le routing interprète ensuite ce paramètre — à condition que l'option `http_method_override` soit activée
- [ ] **C.** On peut restreindre quelles méthodes HTTP peuvent être ainsi surchargées via l'option `allowed_http_method_override`
- [ ] **D.** L'action et la méthode ne peuvent être définies que dans le contrôleur, jamais dans le template

### Question 28

Quelles conventions Symfony applique-t-il pour les attributs `name` et `id` des champs rendus ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le `name` suit le motif `formName[fieldName]` (imbriqué pour les formulaires imbriqués)
- [ ] **B.** L'`id` suit un motif similaire mais avec des underscores : `formName_fieldName`
- [ ] **C.** Dans les templates Twig, il est préférable d'utiliser `form.vars.full_name` et `form.vars.id` plutôt que de reconstruire ces noms manuellement
- [ ] **D.** Ces conventions sont fixes et ne peuvent jamais être modifiées

### Question 29

Comment personnaliser le nom par défaut d'un formulaire (utilisé comme préfixe des champs) ? *(plusieurs bonnes réponses)*

- [ ] **A.** En surchargeant `getBlockPrefix()` dans la classe du form type
- [ ] **B.** En créant le formulaire avec `createNamed('my_task', TaskType::class, $task)`
- [ ] **C.** En passant un nom vide à `createNamed('', ...)` pour supprimer tout préfixe
- [ ] **D.** Le nom par défaut est toujours dérivé du nom de la classe métier (`Task`), jamais de la classe form type

### Question 30

Comment fonctionne le mécanisme de « form type guessing » ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il s'active en omettant le second argument de `add()`, ou en passant `null`
- [ ] **B.** Symfony peut deviner à la fois le type du champ et certaines options (`required`, `maxlength`) à partir des contraintes de validation ou des métadonnées Doctrine
- [ ] **C.** Même en utilisant un groupe de validation spécifique, le guesser prend en compte **toutes** les contraintes de validation, y compris celles hors du groupe utilisé
- [ ] **D.** Le guessing ne fonctionne qu'avec des entités Doctrine, jamais avec de simples contraintes de validation

### Question 31

Que se passe-t-il si un champ du formulaire ne correspond à aucune propriété de l'objet sous-jacent, et comment l'autoriser volontairement ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée par défaut ; pour un champ volontairement « hors modèle », il faut mettre l'option `mapped` à `false`
- [ ] **B.** Le champ est silencieusement ignoré
- [ ] **C.** Il est automatiquement ajouté comme propriété dynamique sur l'objet
- [ ] **D.** Il faut désactiver toute validation pour l'autoriser

### Question 32

Comment accéder aux champs « extra » (soumis mais non définis dans le formulaire), et quelle option faut-il activer pour les accepter ? *(une seule bonne réponse)*

- [ ] **A.** Via `$form->getExtraData()`, à condition d'avoir activé l'option `allow_extra_fields` (sinon le formulaire est invalide)
- [ ] **B.** Ils sont automatiquement mappés sur l'objet sous-jacent
- [ ] **C.** Ils provoquent systématiquement une exception fatale, sans option pour les autoriser
- [ ] **D.** Via l'option `mapped => false` sur le formulaire entier

## Formulaire sans classe de données, et dépannage

### Question 33

Quelles sont les deux façons de lier un formulaire à un objet plutôt qu'à un tableau ? *(une seule bonne réponse)*

- [ ] **A.** Passer un objet à la création (1ᵉʳ argument de `createFormBuilder()` ou 2ᵉ de `createForm()`), ou déclarer l'option `data_class`
- [ ] **B.** Toujours passer `data_class` : c'est la seule façon
- [ ] **C.** Ce comportement est automatique dès qu'on ajoute un champ `EntityType`
- [ ] **D.** Il faut implémenter `DataMapperInterface`

### Question 34

Pour un formulaire non lié à une classe de données (tableau), comment ajouter des contraintes de validation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Au niveau du champ, via l'option `constraints` (une contrainte ou un tableau de contraintes)
- [ ] **B.** Au niveau du formulaire entier, via l'option `constraints` de `configureOptions()` avec par exemple `Assert\Collection`
- [ ] **C.** Automatiquement, sans rien configurer
- [ ] **D.** Uniquement en créant une entité Doctrine dédiée

### Question 35

Comment définir une contrainte conditionnelle (un champ requis seulement si un autre champ a une certaine valeur) ? *(une seule bonne réponse)*

- [ ] **A.** Avec la contrainte `Assert\When`, dont l'option `expression` référence l'autre champ (ex. `this.getParent().get("how_did_you_hear").getData() == "other"`)
- [ ] **B.** Ce n'est pas possible avec le composant Form
- [ ] **C.** En dupliquant le formulaire pour chaque cas
- [ ] **D.** Avec une option `depends_on` du champ

### Question 36

Parmi les causes de dysfonctionnement listées dans le dépannage, lesquelles sont correctement associées à leur symptôme ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un champ affiché vide malgré une donnée existante peut venir d'un accesseur manquant, d'un nom de champ différent du nom de propriété, ou de données peuplées **après** la création du formulaire (il faut peupler l'objet avant `createForm()`)
- [ ] **B.** Des données soumises non sauvegardées sur l'objet peuvent venir d'une propriété non inscriptible, d'un champ non mappé, ou d'un formulaire désynchronisé suite à l'échec d'un transformer
- [ ] **C.** `getData()` qui retourne `null` après soumission peut venir de l'absence de donnée initiale (revoir `data_class`/`empty_data`), d'une désynchronisation, ou du fait que le formulaire n'est pas soumis/valide
- [ ] **D.** Ces trois problèmes n'ont chacun qu'une seule cause possible

---

> Les questions 37 à 161 couvrent les **22 pages** listées dans la section [Learn more](https://symfony.com/doc/8.0/forms.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Référence des types de champ

### Question 37

Comment la documentation catégorise-t-elle les form types natifs ? *(plusieurs bonnes réponses)*

- [ ] **A.** Text Fields, Choice Fields, Date and Time Fields, Other Fields
- [ ] **B.** Symfony UX Fields, UID Fields, Field Groups, Hidden Fields, Buttons, Base Fields
- [ ] **C.** Il n'existe qu'une seule catégorie plate listant tous les types
- [ ] **D.** « Security Fields » est une catégorie à part

### Question 38

Dans quelle catégorie trouve-t-on `ChoiceType`, `EnumType`, `EntityType`, `CountryType`, `LanguageType` ? *(une seule bonne réponse)*

- [ ] **A.** Choice Fields
- [ ] **B.** Text Fields
- [ ] **C.** Field Groups
- [ ] **D.** Other Fields

### Question 39

`CollectionType` et `RepeatedType` appartiennent à quelle catégorie ? *(une seule bonne réponse)*

- [ ] **A.** Field Groups
- [ ] **B.** Buttons
- [ ] **C.** Base Fields
- [ ] **D.** Hidden Fields

### Question 40

Quelles affirmations sur `FormType` et les « Symfony UX Fields » sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `FormType` est listé dans la catégorie « Base Fields »
- [ ] **B.** `CropperType` et `DropzoneType` font partie des Symfony UX Packages, pas du composant Form natif
- [ ] **C.** `UuidType` et `UlidType` sont dans la catégorie « UID Fields »
- [ ] **D.** `ButtonType`, `ResetType`, `SubmitType` sont dans la catégorie « Field Groups »

## Annexe — Upload de fichiers

### Question 41

Pourquoi ajoute-t-on l'option `mapped: false` au champ `FileType` d'un formulaire d'upload ? *(une seule bonne réponse)*

- [ ] **A.** Pour empêcher Symfony d'essayer automatiquement de lire/écrire la valeur du champ sur une propriété de l'objet (qui ne stocke qu'un nom de fichier, pas un fichier)
- [ ] **B.** Pour désactiver la validation du fichier
- [ ] **C.** Pour permettre l'upload de plusieurs fichiers
- [ ] **D.** Pour rendre le champ obligatoire

### Question 42

Comment activer l'upload de plusieurs fichiers pour un même champ, et comment valider chaque fichier ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `multiple: true`, en enveloppant la contrainte `Assert\File` dans une contrainte `Assert\All`
- [ ] **B.** En ajoutant autant de champs `FileType` que de fichiers attendus
- [ ] **C.** En passant un tableau à l'option `constraints` sans autre changement
- [ ] **D.** Ce n'est pas supporté nativement

### Question 43

Quelles bonnes pratiques de sécurité la documentation recommande-t-elle pour le nommage des fichiers uploadés ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ne jamais faire confiance au nom de fichier fourni par l'utilisateur
- [ ] **B.** Utiliser `guessExtension()` (basé sur le type MIME) plutôt que l'extension fournie par le client
- [ ] **C.** Générer des noms de fichiers uniques, par exemple avec `uniqid()`
- [ ] **D.** Toujours conserver le nom original du fichier tel quel, pour la traçabilité

### Question 44

Que doit stocker la base de données pour un fichier uploadé, et comment générer l'URL vers ce fichier dans un template ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le nom du fichier (pas son contenu) ; le helper `asset()` permet de construire l'URL (ex. `asset('uploads/brochures/' ~ product.brochureFilename)`)
- [ ] **B.** Le contenu binaire du fichier, encodé en base64
- [ ] **C.** Le chemin absolu complet sur le serveur
- [ ] **D.** Rien : le fichier est retrouvé uniquement par l'`id` de l'entité

### Question 45

Où recommande-t-on d'extraire la logique d'upload pour garder le contrôleur propre ? *(une seule bonne réponse)*

- [ ] **A.** Dans un service dédié (ex. `FileUploader`), enregistré avec injection de dépendances
- [ ] **B.** Dans un Event Listener Doctrine `prePersist`
- [ ] **C.** Directement dans le form type
- [ ] **D.** Dans le template Twig

### Question 46

Pour des cas d'usage plus avancés que ceux couverts par cet article, quel bundle la documentation recommande-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `VichUploaderBundle`
- [ ] **B.** `LiipImagineBundle`
- [ ] **C.** `SonataMediaBundle`
- [ ] **D.** `OneupUploaderBundle`

### Question 47

Que dit la documentation à propos de l'usage des listeners Doctrine pour la logique d'upload de fichiers ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est plus recommandé
- [ ] **B.** C'est la méthode recommandée en priorité
- [ ] **C.** C'est obligatoire dès qu'on utilise une entité Doctrine
- [ ] **D.** La documentation ne mentionne pas Doctrine

## Annexe — Protection CSRF

### Question 48

Que protège la protection CSRF, et quelle recommandation OWASP la documentation rappelle-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Elle protège les opérations qui changent un état ; elle ne doit pas être utilisée pour les requêtes `GET`, selon les bonnes pratiques OWASP
- [ ] **B.** Elle protège uniquement les requêtes `GET`
- [ ] **C.** Elle remplace entièrement l'authentification
- [ ] **D.** Elle protège contre les injections SQL

### Question 49

Comment active-t-on la protection CSRF dans une application Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/security-csrf` puis `framework.csrf_protection: true`
- [ ] **B.** Elle est active par défaut sans aucune configuration ni dépendance
- [ ] **C.** Uniquement via un attribut PHP sur chaque contrôleur
- [ ] **D.** En ajoutant un middleware Caddy

### Question 50

Que fait Symfony Form vis-à-vis du CSRF par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Les formulaires Symfony incluent un jeton CSRF par défaut et le valident automatiquement, sans action supplémentaire
- [ ] **B.** Il faut ajouter manuellement le champ CSRF à chaque formulaire
- [ ] **C.** Le CSRF n'est disponible que pour les formulaires liés à une entité Doctrine
- [ ] **D.** Il faut appeler `$form->enableCsrf()` explicitement

### Question 51

Comment personnaliser le nom du champ CSRF et l'identifiant de jeton pour un formulaire donné ? *(une seule bonne réponse)*

- [ ] **A.** Via les options `csrf_field_name` et `csrf_token_id` dans `configureOptions()`
- [ ] **B.** Uniquement de façon globale, jamais par formulaire
- [ ] **C.** Via un attribut `#[CsrfFieldName]`
- [ ] **D.** En renommant la classe du formulaire

### Question 52

Comment vérifier manuellement un jeton CSRF dans un contrôleur, avec les approches présentées ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec `$this->isCsrfTokenValid('delete-item', $submittedToken)`
- [ ] **B.** Avec l'attribut `#[IsCsrfTokenValid('delete-item', tokenKey: 'token')]` sur la méthode du contrôleur
- [ ] **C.** L'attribut peut aussi restreindre la vérification à certaines méthodes HTTP via l'option `methods`
- [ ] **D.** Uniquement en interrogeant directement la session PHP

### Question 53

D'où l'attribut `IsCsrfTokenValid` peut-il lire le jeton soumis, via l'option `tokenSource` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `SOURCE_PAYLOAD` (par défaut) — corps POST/JSON
- [ ] **B.** `SOURCE_QUERY` — chaîne de requête
- [ ] **C.** `SOURCE_HEADER` — en-tête de requête
- [ ] **D.** `SOURCE_COOKIE` uniquement

### Question 54

Que sont les jetons CSRF « stateless », et à quoi servent-ils ? *(une seule bonne réponse)*

- [ ] **A.** Des jetons qui ne dépendent pas de la session, permettant la mise en cache complète de la page tout en restant protégé contre le CSRF
- [ ] **B.** Des jetons qui ne sont jamais vérifiés
- [ ] **C.** Des jetons stockés uniquement côté client dans le `localStorage`
- [ ] **D.** Une fonctionnalité réservée à l'API Platform

### Question 55

Lors de la validation d'un jeton CSRF stateless, quels éléments Symfony vérifie-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'en-tête `Origin`
- [ ] **B.** L'en-tête `Referer`
- [ ] **C.** Optionnellement, une protection « double-submit » via cookie et en-tête (JavaScript)
- [ ] **D.** L'adresse IP du client

### Question 56

Comment Symfony atténue-t-il les attaques par compression (BREACH/CRIME) contre les jetons CSRF sur HTTPS ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant un masquage aléatoire préfixé au jeton
- [ ] **B.** En désactivant la compression HTTP globalement
- [ ] **C.** En chiffrant le jeton avec AES
- [ ] **D.** Il ne fait rien de spécifique contre ces attaques

## Annexe — Créer un type de champ personnalisé

### Question 57

Quelles sont les deux grandes approches pour créer un form type personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Se baser sur un type natif existant (via `getParent()`), ou en créer un entièrement nouveau en étendant `AbstractType`
- [ ] **B.** Uniquement en créant un bundle dédié
- [ ] **C.** Uniquement en JavaScript
- [ ] **D.** En dupliquant le code source de `ChoiceType`

### Question 58

Pour un type basé sur un type existant (ex. `ShippingType`), comment indique-t-on son parent ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `getParent(): string`, qui retourne le FQCN du type parent (ex. `ChoiceType::class`)
- [ ] **B.** Via l'option `parent` de `configureOptions()`
- [ ] **C.** En étendant directement la classe `ChoiceType`
- [ ] **D.** Ce n'est pas configurable, c'est toujours `FormType`

### Question 59

Parmi les méthodes d'un form type créé de zéro, à quoi servent respectivement `buildForm()` et `buildView()` ? *(une seule bonne réponse)*

- [ ] **A.** `buildForm()` configure les champs et la structure ; `buildView()` définit les variables disponibles dans le template
- [ ] **B.** Les deux font exactement la même chose
- [ ] **C.** `buildView()` configure les champs, `buildForm()` le template
- [ ] **D.** Seul `buildForm()` existe ; `buildView()` n'est pas une méthode du composant Form

### Question 60

Que permet `setNormalizer()` sur l'`OptionsResolver`, illustré par l'option `allowed_states` de `PostalAddressType` ? *(une seule bonne réponse)*

- [ ] **A.** Transformer/normaliser la valeur fournie pour une option avant qu'elle soit utilisée (ex. convertir une chaîne unique en tableau)
- [ ] **B.** Définir la valeur par défaut de l'option
- [ ] **C.** Interdire l'option en environnement de production
- [ ] **D.** Générer automatiquement une contrainte de validation

### Question 61

Quel est le motif de nommage des blocs Twig d'un form type personnalisé, illustré par `postal_address_row`, `postal_address_state_widget` ? *(une seule bonne réponse)*

- [ ] **A.** `{nom_du_type}_{partie}` (ex. `_row`, `_widget`, `_label`, `_help`, éventuellement précédé du nom du champ enfant)
- [ ] **B.** `{partie}_{nom_du_type}`
- [ ] **C.** Le nom du bloc est toujours identique au nom de la classe PHP
- [ ] **D.** Les blocs ne peuvent pas être nommés par champ enfant, seulement globalement

### Question 62

Quel piège la documentation signale-t-elle si le nom de la classe de form type personnalisée entre en collision avec un type natif ? *(une seule bonne réponse)*

- [ ] **A.** Il faut surcharger `getBlockPrefix()` pour éviter la collision
- [ ] **B.** Aucun risque, Symfony gère cela automatiquement
- [ ] **C.** Il faut renommer le fichier PHP
- [ ] **D.** Il faut désactiver le cache Twig

### Question 63

À quoi sert `buildView()` dans l'exemple avec les variables `image_url`/`notification` ? *(une seule bonne réponse)*

- [ ] **A.** À passer des variables personnalisées (`$view->vars[...]`), ensuite disponibles dans le template du form type
- [ ] **B.** À définir les options par défaut du type
- [ ] **C.** À enregistrer le type comme service
- [ ] **D.** À déclarer les contraintes de validation du type

## Annexe — Data transformers

### Question 64

À quoi servent les data transformers, et à quel type de champ ne s'appliquent-ils jamais ? *(une seule bonne réponse)*

- [ ] **A.** Ils traduisent la donnée d'un champ pour l'affichage et inversement à la soumission ; ils ne s'appliquent pas aux champs ayant l'option `inherit_data` à `true`
- [ ] **B.** Ils valident les données soumises
- [ ] **C.** Ils ne s'appliquent qu'aux champs `DateType`
- [ ] **D.** Ils remplacent entièrement le composant Validator

### Question 65

Dans l'exemple `CallbackTransformer` pour les tags (chaîne ↔ tableau), quel est le rôle du premier et du second callback ? *(une seule bonne réponse)*

- [ ] **A.** Le premier transforme la valeur d'origine pour l'affichage (array → string), le second inverse la transformation à la soumission (string → array)
- [ ] **B.** Les deux callbacks font la même transformation, dans le même sens
- [ ] **C.** Le premier valide, le second transforme
- [ ] **D.** Le second callback n'est appelé qu'en cas d'erreur

### Question 66

Dans un `DataTransformerInterface` personnalisé (ex. `IssueToNumberTransformer`), quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `reverseTransform()` doit lever une `TransformationFailedException` si l'objet correspondant n'existe pas
- [ ] **B.** `transform()` doit retourner une valeur vide équivalente (chaîne vide, `0`…) pour une entrée `null`
- [ ] **C.** On peut définir un message d'erreur public distinct via `setInvalidMessage()` sur l'exception
- [ ] **D.** `reverseTransform()` ne doit jamais lever d'exception, quelle que soit l'entrée

### Question 67

Quelle est la différence entre model transformers et view transformers en termes de couches de données ? *(une seule bonne réponse)*

- [ ] **A.** Les model transformers convertissent entre donnée modèle et donnée normalisée ; les view transformers convertissent entre donnée normalisée et donnée de vue
- [ ] **B.** Les deux convertissent exactement les mêmes couches
- [ ] **C.** Seuls les view transformers peuvent lever une `TransformationFailedException`
- [ ] **D.** Les model transformers ne s'utilisent que sur des champs de type date

### Question 68

Quels avertissements la documentation formule-t-elle sur l'usage des data transformers ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ne pas appliquer un transformer à un formulaire entier, seulement à des champs spécifiques
- [ ] **B.** Un model transformer ne peut pas filtrer les éléments d'une `Collection` — il faut alors passer par des DTO en contournement
- [ ] **C.** Avec la configuration par défaut de `services.yaml`, les transformers ne sont jamais autowirés
- [ ] **D.** Un transformer doit toujours être appliqué à tout le formulaire, jamais à un champ isolé

### Question 69

Comment crée-t-on un type de champ réutilisable encapsulant un transformer (ex. `IssueSelectorType`) ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant le transformer dans `buildForm()` du type personnalisé via `addModelTransformer()`, et en définissant son parent avec `getParent()`
- [ ] **B.** En dupliquant le transformer dans chaque form type qui en a besoin
- [ ] **C.** En le déclarant dans `config/services.yaml` uniquement, sans code PHP
- [ ] **D.** Ce n'est pas possible : un transformer est toujours lié à un champ précis d'un formulaire donné

### Question 70

Que reçoit un `CallbackTransformer`, et en quoi se distingue-t-il d'une classe implémentant `DataTransformerInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Il prend deux callables (`transform`/`reverseTransform`) directement en paramètres du constructeur, pratique pour une transformation simple et locale
- [ ] **B.** Il ne peut être utilisé qu'avec des services injectés
- [ ] **C.** Il remplace `DataTransformerInterface`, qui est dépréciée
- [ ] **D.** Il ne fonctionne que côté vue, jamais côté modèle

## Annexe — Data mappers

### Question 71

Quelle est la différence entre un data transformer et un data mapper ? *(une seule bonne réponse)*

- [ ] **A.** Le transformer change la représentation d'une **seule** valeur ; le mapper fait correspondre une donnée (objet/tableau) à **plusieurs** champs de formulaire et inversement
- [ ] **B.** Ce sont des synonymes stricts
- [ ] **C.** Le mapper ne s'utilise que pour les champs de type fichier
- [ ] **D.** Le transformer s'applique à un formulaire entier, le mapper à un seul champ

### Question 72

Pour un objet immuable comme `Color` (rouge/vert/bleu passés au constructeur), pourquoi un data mapper est-il utile ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'un nouvel objet doit être recréé à chaque changement de valeur ; le mapper contrôle cette construction via `mapFormsToData()`
- [ ] **B.** Parce que Doctrine l'exige pour tous les value objects
- [ ] **C.** Parce que sans mapper, l'objet ne peut pas être rendu en lecture seule
- [ ] **D.** Un data mapper n'apporte rien pour un objet immuable

### Question 73

Que font respectivement `mapDataToForms()` et `mapFormsToData()` d'un `DataMapperInterface` ? *(une seule bonne réponse)*

- [ ] **A.** `mapDataToForms()` pré-remplit les champs enfants à partir de l'objet (view data) ; `mapFormsToData()` reconstruit l'objet à partir des champs (la donnée étant passée par référence)
- [ ] **B.** Les deux méthodes sont interchangeables
- [ ] **C.** `mapFormsToData()` s'exécute uniquement au rendu, jamais à la soumission
- [ ] **D.** `mapDataToForms()` valide les données

### Question 74

Quel avertissement la documentation donne-t-elle sur l'état des données passées au mapper ? *(une seule bonne réponse)*

- [ ] **A.** Les données ne sont **pas encore validées** : les objets doivent pouvoir être créés dans un état invalide, pour produire des erreurs conviviales
- [ ] **B.** Les données sont toujours déjà validées à ce stade
- [ ] **C.** Le mapper doit lui-même appeler le validateur
- [ ] **D.** Aucune donnée n'atteint jamais le mapper avant validation complète du formulaire parent

### Question 75

Quelles affirmations sur les options `getter`/`setter` et sur `inherit_data` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les options `getter`/`setter` permettent de mapper un champ précis via un callable, prioritaire sur le PropertyAccess pour ce champ — les autres champs continuent d'utiliser le data mapper par défaut
- [ ] **B.** Quand `inherit_data` est à `true`, le formulaire n'utilise pas de data mapper et laisse son parent gérer les valeurs internes
- [ ] **C.** `getter`/`setter` remplacent obligatoirement `setDataMapper()` pour tout le formulaire
- [ ] **D.** `inherit_data` force l'utilisation d'un data mapper personnalisé

## Annexe — Créer une extension de form type

### Question 76

Quelle est la seule méthode **obligatoire** à implémenter dans une extension de form type, et à quoi sert-elle ? *(une seule bonne réponse)*

- [ ] **A.** `getExtendedTypes()`, qui retourne la liste des types de champs modifiés par l'extension
- [ ] **B.** `buildForm()`
- [ ] **C.** `configureOptions()`
- [ ] **D.** `getParent()`

### Question 77

Quels sont les deux cas d'usage principaux présentés pour une extension de form type ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter une fonctionnalité spécifique à un seul type (ex. `FileType`), ou une fonctionnalité générique à plusieurs types (ex. un texte d'aide sur tous les champs texte)
- [ ] **B.** Uniquement remplacer un type existant par un autre
- [ ] **C.** Uniquement ajouter des routes
- [ ] **D.** Uniquement modifier le CSS des formulaires

### Question 78

Comment une extension de form type est-elle enregistrée, et quel rôle joue l'attribut `priority` du tag ? *(une seule bonne réponse)*

- [ ] **A.** Elle est taguée `form.type_extension` (automatique avec l'autoconfiguration par défaut) ; `priority` (défaut `0`) contrôle l'ordre de chargement, les valeurs hautes étant chargées en premier
- [ ] **B.** Elle doit être déclarée dans `config/bundles.php`
- [ ] **C.** `priority` ne sert qu'à l'affichage dans `debug:form`
- [ ] **D.** Le tag est `form.extension`, sans option de priorité

### Question 79

Pour appliquer une extension à plusieurs types de champs à la fois (ex. `DateTimeType`, `DateType`, `TimeType`), comment fait-on ? *(une seule bonne réponse)*

- [ ] **A.** En retournant plusieurs FQCN dans le tableau de `getExtendedTypes()`
- [ ] **B.** En créant une extension distincte par type
- [ ] **C.** Ce n'est pas possible : une extension ne cible qu'un seul type
- [ ] **D.** En héritant de chacun des trois types

### Question 80

Une extension cible `FormType::class` pour s'appliquer largement. Quelle exception notable la documentation signale-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Les types `ButtonType` n'héritent pas de `FormType`, donc l'extension ne s'y applique pas
- [ ] **B.** `TextType` est également exclu
- [ ] **C.** Toutes les extensions sur `FormType` s'appliquent aussi aux boutons
- [ ] **D.** Aucune exception n'existe : tous les types héritent de `FormType`

## Annexe — Créer un « type guesser » personnalisé

### Question 81

Dans quels cas les type guessers sont-ils utilisés ? *(plusieurs bonnes réponses)*

- [ ] **A.** Lors de l'appel à `createForProperty()` ou `createBuilderForProperty()`
- [ ] **B.** Lors de l'appel à `add()`/`create()` sans type explicite, dans un contexte où le formulaire parent a défini une `data_class`
- [ ] **C.** À chaque rendu de formulaire, quel que soit le contexte
- [ ] **D.** Uniquement lors de l'exécution de `php bin/console make:form`

### Question 82

Quel type guesser fourni par un bridge Symfony est mentionné, et par quel composant est-il fourni ? *(une seule bonne réponse)*

- [ ] **A.** `DoctrineOrmTypeGuesser`, fourni par le bridge Doctrine
- [ ] **B.** `ValidatorTypeGuesser`, fourni par le composant Validator
- [ ] **C.** `SecurityTypeGuesser`, fourni par le composant Security
- [ ] **D.** Aucun guesser n'est fourni nativement en dehors du composant Validation

### Question 83

Quelles sont les quatre méthodes que doit implémenter `FormTypeGuesserInterface` ? *(une seule bonne réponse)*

- [ ] **A.** `guessType()`, `guessRequired()`, `guessMaxLength()`, `guessPattern()`
- [ ] **B.** `guessType()`, `guessLabel()`, `guessOptions()`, `guessDefault()`
- [ ] **C.** `guess()`, `guessAll()`, `guessOne()`, `guessNone()`
- [ ] **D.** Seule `guessType()` existe réellement, les trois autres sont optionnelles

### Question 84

Que retourne `guessType()`, et quels sont les trois arguments attendus par le constructeur de `TypeGuess` ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `TypeGuess` (ou rien) construite avec : le nom du type, les options additionnelles, et le niveau de confiance (`LOW_CONFIDENCE`, `MEDIUM_CONFIDENCE`, `HIGH_CONFIDENCE`, `VERY_HIGH_CONFIDENCE`)
- [ ] **B.** Un simple booléen
- [ ] **C.** Une chaîne représentant le nom du type, sans plus d'information
- [ ] **D.** Une instance de `ValueGuess`

### Question 85

Quelle mise en garde la documentation formule-t-elle à propos de `guessMaxLength()` pour un champ de type flottant ? *(une seule bonne réponse)*

- [ ] **A.** On ne peut pas fiabiliser une longueur pour un flottant (la comparaison de longueur de chaîne ne reflète pas la comparaison numérique) : il vaut mieux retourner `null` avec `MEDIUM_CONFIDENCE`
- [ ] **B.** Il faut toujours retourner `0`
- [ ] **C.** Les flottants ne peuvent jamais avoir de `maxlength`
- [ ] **D.** Il faut convertir le flottant en entier avant de deviner

### Question 86

Comment enregistrer un type guesser personnalisé dans une application Symfony classique ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement si autowire/autoconfigure sont actifs ; sinon en taguant le service avec `form.type_guesser`
- [ ] **B.** En l'ajoutant à `config/bundles.php`
- [ ] **C.** Uniquement via `FormFactoryBuilder::addTypeGuesser()`, seule méthode possible dans une application Symfony
- [ ] **D.** Ce n'est pas configurable, seul le guesser Validator est utilisable

## Annexe — Thème Bootstrap 4

### Question 87

Comment appliquer le thème Bootstrap 4 à tous les formulaires de l'application ? *(une seule bonne réponse)*

- [ ] **A.** En configurant `twig.form_themes: ['bootstrap_4_layout.html.twig']`
- [ ] **B.** En ajoutant une classe CSS `bootstrap-4` sur `<body>`
- [ ] **C.** Bootstrap 4 est appliqué par défaut, sans configuration
- [ ] **D.** Uniquement via le tag `{% form_theme %}`, jamais globalement

### Question 88

Pourquoi ne faut-il pas appeler `form_errors()` en plus de `form_label()` avec le thème Bootstrap 4 ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les erreurs sont rendues **à l'intérieur** du `<label>` (conformité WCAG 2.0) : `form_label()` appelle déjà `form_errors()` en interne — les appeler toutes les deux affiche les erreurs en double
- [ ] **B.** Parce que `form_errors()` n'existe pas dans ce thème
- [ ] **C.** Parce que cela génère une exception
- [ ] **D.** Parce que les erreurs Bootstrap 4 ne sont jamais affichées automatiquement

### Question 89

Pour les champs case à cocher/radio, que se passe-t-il si on appelle `form_label()` avec le thème Bootstrap 4 ? *(une seule bonne réponse)*

- [ ] **A.** Rien n'est rendu : le label est déjà généré par `form_widget()` en interne, pour des raisons liées au fonctionnement de Bootstrap
- [ ] **B.** Le label est rendu deux fois
- [ ] **C.** Une exception est levée
- [ ] **D.** Le comportement est identique à un champ texte classique

### Question 90

Comment activer les « custom forms » de Bootstrap 4 (radio/checkbox personnalisés, switch) sur un champ Symfony ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant une classe CSS au label (`radio-custom`, `checkbox-custom`, ou `switch-custom`) via `label_attr`
- [ ] **B.** En changeant le type du champ pour un `SwitchType` dédié
- [ ] **C.** Automatiquement, sans configuration
- [ ] **D.** En modifiant le thème Twig complet

## Annexe — Thème Bootstrap 5

### Question 91

Où le thème Bootstrap 5 place-t-il les messages d'erreur, contrairement au thème Bootstrap 4 ? *(une seule bonne réponse)*

- [ ] **A.** **Après** l'élément `<input>` (contre **dans** le `<label>` en Bootstrap 4), tout en respectant la connexion requise par le WCAG 2.0
- [ ] **B.** Toujours dans un tooltip JavaScript
- [ ] **C.** Bootstrap 5 n'affiche jamais les erreurs de validation
- [ ] **D.** Dans le `<head>` du document

### Question 92

Quelle classe CSS le thème Bootstrap 5 ajoute-t-il par défaut sur le conteneur de chaque champ, et quel effet a la surcharge de `row_attr` ? *(une seule bonne réponse)*

- [ ] **A.** La classe `mb-3` ; si on surcharge l'option `row_attr`, elle est également écrasée et doit être rajoutée explicitement
- [ ] **B.** La classe `form-control`, jamais affectée par `row_attr`
- [ ] **C.** Aucune classe n'est ajoutée par défaut
- [ ] **D.** La classe est déterminée par le type du champ, jamais uniforme

### Question 93

Comment rendre un switch Bootstrap 5 à partir d'un `CheckboxType`, et quelle restriction s'applique ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant la classe `checkbox-switch` via `label_attr` ; cela ne fonctionne qu'avec les champs de type `checkbox` (pas les radios)
- [ ] **B.** En utilisant un type `SwitchType` dédié
- [ ] **C.** Cela fonctionne aussi bien pour les radios que pour les checkboxes
- [ ] **D.** Il faut écrire du JavaScript personnalisé, aucune option native n'existe

### Question 94

Comment créer un « input group » Bootstrap 5 pour un champ Symfony ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant la classe `input-group` à l'option `row_attr` du champ
- [ ] **B.** En ajoutant la classe `input-group` sur le `<form>` entier
- [ ] **C.** Ce n'est pas supporté par le thème Bootstrap 5 de Symfony
- [ ] **D.** En définissant `group: true` sur le champ

### Question 95

Que faut-il fournir obligatoirement pour qu'un « floating label » Bootstrap 5 fonctionne correctement ? *(une seule bonne réponse)*

- [ ] **A.** Un `label`, un `placeholder`, et la classe `form-floating` sur `row_attr`
- [ ] **B.** Uniquement un `placeholder`
- [ ] **C.** Uniquement la classe `form-floating`, le reste est automatique
- [ ] **D.** Un `id` personnalisé sur le champ

### Question 96

Comment rendre les cases à cocher ou boutons radio en ligne (« inline ») avec Bootstrap 5 ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant la classe `checkbox-inline` ou `radio-inline` (selon le type) via `label_attr`
- [ ] **B.** En passant l'option `expanded => false`
- [ ] **C.** En utilisant `ChoiceType` avec `multiple => true` uniquement
- [ ] **D.** Ce n'est pas possible avec le thème Bootstrap 5 de Symfony

## Annexe — Thème Tailwind CSS

### Question 97

Quel plugin officiel Tailwind le thème de formulaire Symfony nécessite-t-il, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** Le plugin de formulaire officiel Tailwind, qui fournit une remise à zéro de base standardisant l'apparence des formulaires sur tous les navigateurs
- [ ] **B.** Aucun plugin n'est requis, uniquement Tailwind de base
- [ ] **C.** Le plugin `daisyUI`
- [ ] **D.** Un plugin Symfony UX dédié

### Question 98

Quelle différence de comportement la documentation signale-t-elle entre le thème Tailwind et les autres thèmes lors de la personnalisation des classes via `form_row()` ? *(une seule bonne réponse)*

- [ ] **A.** Les classes personnalisées (`row_class`, `widget_class`…) **remplacent** les classes par défaut du thème, au lieu de les fusionner comme le font les autres thèmes
- [ ] **B.** Les classes sont toujours fusionnées, exactement comme les autres thèmes
- [ ] **C.** Il est impossible de personnaliser les classes CSS avec ce thème
- [ ] **D.** Les classes ne peuvent être changées que globalement, jamais champ par champ

### Question 99

Comment créer un style de formulaire Tailwind générique et cohérent pour tout un projet ? *(une seule bonne réponse)*

- [ ] **A.** En créant un thème personnalisé qui fait `{% use 'tailwind_2_layout.html.twig' %}` et surcharge les blocs (`form_row`, `widget_attributes`…) en appelant `parent()`
- [ ] **B.** En copiant-collant le CSS de Tailwind dans chaque template
- [ ] **C.** Ce n'est pas possible : chaque champ doit être personnalisé individuellement
- [ ] **D.** En modifiant directement le fichier `tailwind_2_layout.html.twig` du vendor

## Annexe — Personnaliser le rendu d'un formulaire

### Question 100

Quelle est la bonne pratique systématiquement recommandée juste avant `form_end()` lorsqu'on rend les champs un par un ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `{{ form_rest(form) }}`, pour s'assurer que les champs cachés (ex. jeton CSRF) et tout champ oublié sont bien rendus
- [ ] **B.** Appeler `{{ form_errors(form) }}` une seconde fois
- [ ] **C.** Appeler `{{ form_widget(form) }}` à nouveau
- [ ] **D.** Rien de particulier n'est recommandé

### Question 101

Que fait `form_end(form, {render_rest: false})` ? *(une seule bonne réponse)*

- [ ] **A.** Rend la balise fermante `</form>` sans appeler automatiquement `form_rest()`
- [ ] **B.** Empêche le rendu de la balise `</form>`
- [ ] **C.** Supprime les erreurs de validation affichées
- [ ] **D.** Désactive le CSRF pour ce formulaire

### Question 102

Que fait le second argument de `form_label(form.name, 'Your Name', {...})`, et par quoi est-il équivalent ? *(une seule bonne réponse)*

- [ ] **A.** Il surcharge le libellé par défaut du champ ; c'est équivalent à passer l'option `label` dans le tableau de variables du 3ᵉ argument
- [ ] **B.** Il définit l'attribut `for` du label
- [ ] **C.** Il n'a aucun effet si l'option `label` du champ est déjà définie en PHP
- [ ] **D.** Il désactive totalement le rendu du label

### Question 103

Que se passe-t-il automatiquement, dans tous les thèmes de formulaire intégrés, quand un champ a des erreurs de validation ? *(une seule bonne réponse)*

- [ ] **A.** L'attribut `aria-invalid="true"` est ajouté à l'`<input>`, relié aux messages d'erreur via `aria-describedby`
- [ ] **B.** Le champ est automatiquement vidé
- [ ] **C.** Rien de spécifique à l'accessibilité n'est ajouté
- [ ] **D.** Le champ est désactivé (`disabled`)

### Question 104

À quoi servent les fonctions `field_*()` (ex. `field_name()`, `field_value()`, `field_choices()`) ? *(une seule bonne réponse)*

- [ ] **A.** À obtenir des valeurs brutes (nom, valeur, libellé, choix…) pour construire du HTML entièrement personnalisé, en contournant les thèmes de formulaire
- [ ] **B.** À remplacer entièrement `form_row()` dans tous les cas
- [ ] **C.** Elles ne fonctionnent que sur des champs de type `ChoiceType`
- [ ] **D.** Elles nécessitent de désactiver les thèmes de formulaire au préalable

### Question 105

Que teste le test Twig `is rootform`, et à quoi sert-il typiquement ? *(une seule bonne réponse)*

- [ ] **A.** Il vérifie qu'une `FormView` est le formulaire racine (sans parent) — utile par exemple pour n'afficher les erreurs globales qu'une fois
- [ ] **B.** Il vérifie que le formulaire a été soumis
- [ ] **C.** Il vérifie que le formulaire est valide
- [ ] **D.** Il vérifie qu'un champ est de type texte

## Annexe — Thèmes de formulaire et personnalisation

### Question 106

Décrivez la « chaîne de recherche » de bloc Twig pour un champ `EmailType` nommé `contact` dans un formulaire `user`, telle que donnée en exemple. *(une seule bonne réponse)*

- [ ] **A.** `_user_contact_widget` → `email_widget` → `text_widget` → trouvé dans `form_div_layout.html.twig`
- [ ] **B.** `form_div_layout.html.twig` → `text_widget` → `email_widget` → `_user_contact_widget`
- [ ] **C.** La recherche se fait uniquement sur le nom du champ, jamais sur son type
- [ ] **D.** Il n'y a pas de mécanisme de repli : chaque champ doit avoir un bloc explicite

### Question 107

Quels sont les thèmes de formulaire intégrés listés par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `form_div_layout.html.twig` (par défaut) et `form_table_layout.html.twig`
- [ ] **B.** `bootstrap_3/4/5_layout.html.twig` (et leurs variantes `_horizontal_layout`)
- [ ] **C.** `foundation_5_layout.html.twig` et `foundation_6_layout.html.twig`
- [ ] **D.** `tailwind_2_layout.html.twig`

### Question 108

Quand plusieurs thèmes sont configurés dans `twig.form_themes`, dans quel ordre Symfony les recherche-t-il ? *(une seule bonne réponse)*

- [ ] **A.** En ordre **inverse** de la liste : le dernier thème déclaré est recherché en premier
- [ ] **B.** Dans l'ordre de déclaration, le premier étant recherché en premier
- [ ] **C.** Par ordre alphabétique
- [ ] **D.** L'ordre n'a aucune importance, tous les thèmes sont fusionnés sans priorité

### Question 109

Que fait le mot-clé `only` dans `{% form_theme form with [...] only %}`, et quelle contrainte cela impose-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il désactive les thèmes globaux pour ce formulaire ; le thème fourni doit alors définir tous les blocs nécessaires (ou en étendre un existant via `{% use %}`)
- [ ] **B.** Il force le rendu en table HTML
- [ ] **C.** Il n'a aucun effet particulier, c'est un alias de la syntaxe standard
- [ ] **D.** Il applique le thème à tous les formulaires de la page, pas seulement à celui-ci

### Question 110

Quel est le motif de bloc pour personnaliser un champ précis d'un formulaire donné (ex. l'email dans `UserType`), par opposition à tous les champs d'un type donné ? *(une seule bonne réponse)*

- [ ] **A.** `_{formulaire}_{champ}_{partie}` (ex. `_user_email_widget`), contre `{type}_{partie}` (ex. `text_widget`) pour tous les champs d'un type
- [ ] **B.** Les deux utilisent exactement le même motif
- [ ] **C.** Il n'existe pas de moyen de cibler un champ précis, uniquement un type
- [ ] **D.** `{champ}_{formulaire}_{partie}`

### Question 111

Comment personnaliser le nom utilisé dans les noms de blocs d'un champ précis, sans changer son nom réel dans le formulaire ? *(plusieurs bonnes réponses)*

- [ ] **A.** Via l'option `block_name` sur le champ, pour renommer le bloc cible
- [ ] **B.** Via l'option `block_prefix`, pour ajouter/rediriger un préfixe utilisé dans le nom des blocs (ex. `book_author_widget`)
- [ ] **C.** En renommant purement et simplement le champ dans `buildForm()`
- [ ] **D.** Ce n'est pas configurable : seul le nom réel du champ détermine le nom du bloc

### Question 112

Pour une `CollectionType` nommée `tags` dans `ArticleType`, quels blocs ciblent respectivement la collection entière et chaque entrée individuelle ? *(une seule bonne réponse)*

- [ ] **A.** `_article_tags_row` pour la collection entière ; `_article_tags_entry_row` (suffixe `_entry`) pour chaque entrée individuelle
- [ ] **B.** Les deux utilisent le même bloc `collection_row`
- [ ] **C.** `_article_tags_entry_row` cible la collection entière, `_article_tags_row` chaque entrée
- [ ] **D.** Il n'existe pas de moyen de cibler les entrées individuellement

## Annexe — Événements de formulaire

### Question 113

Quel événement utiliser pour modifier la **donnée initiale** avant que le formulaire ne la traite, et lequel pour modifier la **structure** en fonction de cette donnée initiale ? *(une seule bonne réponse)*

- [ ] **A.** `PRE_SET_DATA` pour la donnée initiale ; `POST_SET_DATA` pour la structure basée sur la donnée initiale
- [ ] **B.** Les deux cas utilisent `PRE_SUBMIT`
- [ ] **C.** `SUBMIT` sert à modifier la structure du formulaire
- [ ] **D.** Il n'existe pas de distinction, un seul événement couvre les deux besoins

### Question 114

Pour quels besoins la documentation recommande-t-elle explicitement de **ne pas** utiliser les événements de formulaire ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des champs conditionnels **statiques** (dépendant d'une option de formulaire connue à l'avance) — utiliser plutôt les options de formulaire
- [ ] **B.** Une donnée dépendant de l'utilisateur connecté — injecter le service Security plutôt que d'utiliser un événement
- [ ] **C.** La transformation de données — utiliser les data transformers
- [ ] **D.** L'ajout dynamique d'un champ selon une valeur soumise par l'utilisateur

### Question 115

Dans quel ordre les événements se déclenchent-ils pour des formulaires imbriqués (`TaskType` contenant `CategoryType`) lors du pré-remplissage (`setData`) ? *(une seule bonne réponse)*

- [ ] **A.** `TaskType::PRE_SET_DATA` → `CategoryType::PRE_SET_DATA` → `CategoryType::POST_SET_DATA` → `TaskType::POST_SET_DATA`
- [ ] **B.** `CategoryType::PRE_SET_DATA` → `TaskType::PRE_SET_DATA` → `TaskType::POST_SET_DATA` → `CategoryType::POST_SET_DATA`
- [ ] **C.** Les deux formulaires déclenchent leurs événements simultanément
- [ ] **D.** Seul le formulaire parent (`TaskType`) déclenche des événements

### Question 116

Quelle est la différence d'usage recommandée entre un event listener (closure) et un event subscriber pour les formulaires ? *(une seule bonne réponse)*

- [ ] **A.** Le listener convient à une logique simple et spécifique à un formulaire ; le subscriber convient à une logique réutilisable entre plusieurs formulaires
- [ ] **B.** Les deux mécanismes sont strictement interchangeables, sans différence d'usage
- [ ] **C.** Seul le subscriber peut être attaché à `PRE_SET_DATA`
- [ ] **D.** Seul le listener peut recevoir les données du formulaire

### Question 117

À quel moment `FormEvents::PRE_SUBMIT` se déclenche-t-il, et avec quelles données ? *(une seule bonne réponse)*

- [ ] **A.** Au début de `submit()`, avec les données brutes de la requête (chaînes/tableaux)
- [ ] **B.** Après validation complète du formulaire
- [ ] **C.** Avec la donnée modèle déjà transformée
- [ ] **D.** Uniquement si le formulaire est invalide

### Question 118

Que peut-on faire, et que ne peut-on **pas** faire, pendant `FormEvents::SUBMIT` ? *(une seule bonne réponse)*

- [ ] **A.** On peut modifier la donnée normalisée déjà transformée depuis la vue ; on **ne peut pas** ajouter ou retirer des champs (la structure est verrouillée)
- [ ] **B.** On peut librement ajouter et retirer des champs
- [ ] **C.** On ne peut rien faire du tout à ce stade
- [ ] **D.** On peut modifier la structure mais pas les données

### Question 119

Sur `FormEvents::POST_SUBMIT`, que peut-on faire concernant l'ajout de champs, et quelle est la limite précise ? *(une seule bonne réponse)*

- [ ] **A.** On peut ajouter des champs au formulaire **parent**, mais pas au formulaire sur lequel le listener est directement attaché
- [ ] **B.** On peut ajouter ou retirer librement des champs sur le formulaire courant
- [ ] **C.** Aucune modification de formulaire n'est possible à ce stade, seulement la lecture
- [ ] **D.** On ne peut agir que sur les données, jamais sur les champs

### Question 120

D'après la section dépannage, à quoi peut être dû le message « This form should not contain extra fields », et à quoi peut être due une exception de data transformer pendant la soumission ? *(une seule bonne réponse)*

- [ ] **A.** Une structure de formulaire à la soumission qui ne correspond pas à celle du rendu ; et une valeur soumise ne correspondant pas à ce qu'attend le transformer
- [ ] **B.** Un problème de configuration CSRF dans les deux cas
- [ ] **C.** Un champ non traduit
- [ ] **D.** Une erreur de connexion à la base de données

## Annexe — Modifier dynamiquement un formulaire via les événements

### Question 121

Dans le pattern « pays/état dépendant », quel événement gère le rendu **initial** du champ État à partir du pays de l'entité, et quel événement gère sa mise à jour à la **soumission** ? *(une seule bonne réponse)*

- [ ] **A.** `POST_SET_DATA` sur le formulaire pour le rendu initial ; `POST_SUBMIT` sur le champ Pays (enfant) pour la mise à jour à la soumission
- [ ] **B.** `PRE_SUBMIT` pour les deux cas
- [ ] **C.** `PRE_SET_DATA` pour les deux cas
- [ ] **D.** Un seul événement suffit pour les deux besoins

### Question 122

Dans l'exemple `AddressType`, pourquoi le listener `POST_SUBMIT` est-il attaché au champ `country` (enfant) plutôt qu'au formulaire `AddressType` lui-même pour ajouter le champ `state` ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'on ne peut pas modifier le formulaire qui a déclenché l'événement, seulement son **parent** — écouter sur l'enfant `country` permet d'ajouter `state` sur le formulaire parent
- [ ] **B.** Parce que `country` est traité avant tous les autres champs, sans rapport avec cette restriction
- [ ] **C.** Parce que `POST_SUBMIT` n'existe pas au niveau du formulaire parent
- [ ] **D.** C'est un choix arbitraire sans contrainte technique

### Question 123

Comment crée-t-on un subscriber d'événements de formulaire avec des dépendances injectées (ex. `UserRepository`), en l'excluant du câblage service automatique ? *(une seule bonne réponse)*

- [ ] **A.** En marquant la classe du subscriber avec l'attribut `#[Exclude]`, puis en l'instanciant manuellement avec ses dépendances via `addEventSubscriber(new ...($this->userRepository))` dans le form type
- [ ] **B.** En le déclarant comme un service classique autowiré directement en tant que subscriber global
- [ ] **C.** Un subscriber ne peut jamais recevoir de dépendances
- [ ] **D.** En passant les dépendances comme arguments de `getSubscribedEvents()`

### Question 124

Quel avertissement de performance la documentation formule-t-elle à propos des appels à des services externes dans des écouteurs d'événements de formulaire ? *(une seule bonne réponse)*

- [ ] **A.** Ces appels s'exécutent à **chaque** rendu et soumission du formulaire, ce qui peut causer des problèmes de performance
- [ ] **B.** Ils ne s'exécutent qu'une seule fois par déploiement
- [ ] **C.** Ils sont automatiquement mis en cache par Symfony
- [ ] **D.** Aucun avertissement particulier n'est donné

### Question 125

Dans l'exemple du pattern pays/état, à quoi sert la fermeture (`closure`) partagée `$addStateField`, appelée depuis les deux listeners ? *(une seule bonne réponse)*

- [ ] **A.** À factoriser la logique d'ajout du champ `state` (avec les bons choix selon le pays) pour éviter de la dupliquer entre le listener de rendu initial et celui de soumission
- [ ] **B.** Elle ne sert qu'au rendu initial, jamais à la soumission
- [ ] **C.** Elle remplace le repository des états
- [ ] **D.** Elle est appelée uniquement si le pays est `null`

## Annexe — Groupes de validation dans les formulaires

### Question 126

Comment restreindre la validation d'un formulaire à un groupe précis, et comment inclure en plus les contraintes hors groupe ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `validation_groups` (ex. `['registration']`) ; ajouter le groupe spécial `Default` pour inclure aussi les contraintes sans groupe explicite
- [ ] **B.** En supprimant les contraintes des autres groupes de la classe
- [ ] **C.** Il n'existe qu'un seul groupe possible par formulaire
- [ ] **D.** `validation_groups` n'accepte qu'une chaîne, jamais un tableau

### Question 127

Quelle convention de nommage Symfony recommande-t-il pour des groupes de validation personnalisés, par opposition aux groupes générés automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** « lower snake case » (ex. `foo_bar`) pour les groupes personnalisés, contre « UpperCamelCase » (ex. `Default`) pour les groupes générés automatiquement
- [ ] **B.** Toujours en majuscules
- [ ] **C.** Aucune convention n'est recommandée
- [ ] **D.** Les groupes personnalisés doivent obligatoirement commencer par `Custom`

### Question 128

Comment déterminer dynamiquement les groupes de validation en fonction des **données soumises** (ex. type de client) ? *(une seule bonne réponse)*

- [ ] **A.** En passant une closure (ou un callback statique de classe) à l'option `validation_groups`, appelée après soumission mais avant validation, recevant le formulaire en argument
- [ ] **B.** Ce n'est pas possible dynamiquement, seulement de façon statique
- [ ] **C.** En créant un événement `PRE_VALIDATE` dédié
- [ ] **D.** En modifiant directement la base de données

### Question 129

Quand la logique de détermination des groupes de validation nécessite des services complexes ne tenant pas dans une closure, que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Créer un service dédié invokable (`__invoke(FormInterface $form): array`) et le passer directement comme valeur de `validation_groups`
- [ ] **B.** Écrire la logique dans le contrôleur avant l'appel à `handleRequest()`
- [ ] **C.** Utiliser exclusivement une classe statique sans service
- [ ] **D.** Ce cas n'est pas couvert par la documentation

### Question 130

Comment désactiver la validation uniquement pour un bouton de soumission donné (ex. « previousStep » d'un formulaire multi-étapes) ? *(une seule bonne réponse)*

- [ ] **A.** En mettant `'validation_groups' => false` sur ce bouton précisément
- [ ] **B.** En retirant le bouton de la validation globale via `configureOptions()`
- [ ] **C.** Ce n'est configurable qu'au niveau du formulaire entier
- [ ] **D.** En ajoutant l'attribut HTML `formnovalidate`, seule option possible

## Annexe — Formulaires imbriqués

### Question 131

Pour qu'un objet `Category` imbriqué dans `Task` soit lui-même validé, quelle contrainte doit être ajoutée sur la propriété `category` de `Task` ? *(une seule bonne réponse)*

- [ ] **A.** `#[Assert\Valid]`, qui « cascade » la validation vers l'entité enfant — sans elle, l'entité enfant ne serait pas validée
- [ ] **B.** `#[Assert\NotBlank]` suffit à lui seul
- [ ] **C.** Aucune contrainte n'est nécessaire, la cascade est automatique
- [ ] **D.** `#[Assert\Type(Category::class)]` suffit à lui seul pour cascader la validation

### Question 132

Comment imbrique-t-on un formulaire `CategoryType` à l'intérieur de `TaskType` ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un champ dont le type est directement la classe du form type imbriqué : `$builder->add('category', CategoryType::class)`
- [ ] **B.** En copiant tous les champs de `CategoryType` un par un dans `TaskType`
- [ ] **C.** Ce n'est possible qu'avec `CollectionType`
- [ ] **D.** En liant les deux formulaires via une route commune

### Question 133

Une fois le formulaire soumis, comment l'instance de `Category` construite à partir des champs imbriqués est-elle accessible ? *(une seule bonne réponse)*

- [ ] **A.** Naturellement via `$task->getCategory()`, car les données du sous-formulaire ont été écrites sur la propriété `category` de l'objet `Task`
- [ ] **B.** Il faut la récupérer séparément via `$form->get('category')->getData()`, seule méthode possible
- [ ] **C.** Elle n'est jamais accessible directement, seulement persistée
- [ ] **D.** Il faut appeler une méthode `mergeCategory()` manuellement

## Annexe — Collections de formulaires

### Question 134

Comment configure-t-on `CollectionType` pour éditer une collection de sous-formulaires `TagType` ? *(une seule bonne réponse)*

- [ ] **A.** Avec les options `entry_type` (le form type de chaque entrée) et `entry_options` (options passées à chaque entrée, ex. `label: false`)
- [ ] **B.** En ajoutant manuellement autant de champs `TagType` que d'éléments dans la collection
- [ ] **C.** `CollectionType` ne fonctionne qu'avec des entités Doctrine
- [ ] **D.** Avec l'option `collection_type`

### Question 135

À quoi servent l'option `allow_add` et l'attribut `data-prototype` dans le template pour ajouter dynamiquement de nouveaux éléments ? *(une seule bonne réponse)*

- [ ] **A.** `allow_add: true` autorise l'ajout d'éléments non présents initialement ; `form.tags.vars.prototype` expose un gabarit HTML (contenant `__name__`) que du JavaScript peut dupliquer et insérer
- [ ] **B.** `allow_add` supprime automatiquement les éléments vides
- [ ] **C.** `data-prototype` sert uniquement au style CSS
- [ ] **D.** Ces mécanismes ne fonctionnent qu'avec Stimulus, jamais en JavaScript natif

### Question 136

Pourquoi passer `by_reference: false` sur le champ `CollectionType`, et quelle conséquence cela a-t-il côté entité ? *(une seule bonne réponse)*

- [ ] **A.** Cela force Symfony à utiliser les méthodes **adder/remover** (`addTag()`/`removeTag()`) de l'entité plutôt que d'écrire directement dans la collection par référence
- [ ] **B.** Cela désactive totalement la persistance des nouveaux éléments
- [ ] **C.** Cela n'a aucun effet observable
- [ ] **D.** Cela remplace `allow_add` et `allow_delete`

### Question 137

Que faut-il activer pour permettre la **suppression** d'éléments d'une collection, côté formulaire et côté entité ? *(une seule bonne réponse)*

- [ ] **A.** L'option `allow_delete: true` côté formulaire, et une méthode `removeTag()` (ex. `$this->tags->removeElement($tag)`) côté entité
- [ ] **B.** Uniquement `allow_add: false`
- [ ] **C.** Aucune configuration n'est nécessaire, JavaScript suffit
- [ ] **D.** L'option `deletable: true`

### Question 138

Quelle configuration Doctrine facilite la persistance automatique des nouveaux éléments ajoutés à une collection `ManyToMany` ? *(une seule bonne réponse)*

- [ ] **A.** `cascade: ['persist']` sur l'association
- [ ] **B.** `orphanRemoval: true`
- [ ] **C.** `fetch: 'EAGER'`
- [ ] **D.** Aucune configuration Doctrine n'est nécessaire dans ce cas

### Question 139

Quand `Task` est le côté **inverse** d'une relation Many-to-Many avec `Tag`, comment gérer proprement la suppression d'un tag retiré du formulaire (exemple du contrôleur) ? *(une seule bonne réponse)*

- [ ] **A.** En comparant la collection de tags d'origine (clonée avant soumission) à la collection après soumission, puis en retirant manuellement le `Task` du côté propriétaire (`$tag->getTasks()->removeElement($task)`) pour chaque tag disparu
- [ ] **B.** Doctrine gère cela automatiquement sans code supplémentaire
- [ ] **C.** Il suffit d'activer `orphanRemoval` sur le côté inverse
- [ ] **D.** Il faut supprimer et recréer l'entité `Task` à chaque modification

### Question 140

Quels rôles jouent respectivement `addTag()` et `removeTag()` sur l'entité `Task`, requis par l'option `by_reference: false` ? *(une seule bonne réponse)*

- [ ] **A.** Ce sont les méthodes que Symfony Form appelle pour ajouter/retirer un élément de la collection, potentiellement en synchronisant aussi le côté propriétaire de la relation (ex. `$tag->addTask($this)`)
- [ ] **B.** Elles ne servent qu'à l'affichage, jamais à la soumission
- [ ] **C.** Elles sont générées automatiquement par `CollectionType`, sans code à écrire
- [ ] **D.** Elles remplacent `getTags()`

## Annexe — Formulaires multi-étapes

### Question 141

Comment définit-on les étapes d'un formulaire multi-étapes avec le système `FormFlow` ? *(une seule bonne réponse)*

- [ ] **A.** En étendant `AbstractFlowType` et en implémentant `buildFormFlow()`, où chaque étape est ajoutée via `addStep('nom', TypeDeLetape::class)`
- [ ] **B.** En créant une route distincte par étape, sans classe dédiée
- [ ] **C.** En utilisant plusieurs `createForm()` successifs dans le même contrôleur
- [ ] **D.** `FormFlow` n'existe pas nativement, il faut un bundle tiers

### Question 142

À quels groupes de validation une étape est-elle automatiquement soumise par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `['Default', '<nom_de_l_étape_courante>']`
- [ ] **B.** Uniquement `['Default']`
- [ ] **C.** Tous les groupes de toutes les étapes en même temps
- [ ] **D.** Aucun groupe par défaut, il faut toujours les définir explicitement

### Question 143

À quoi sert l'option `step_property_path`, et comment est-elle mise à jour ? *(une seule bonne réponse)*

- [ ] **A.** Elle indique la propriété de l'objet de données qui stocke l'étape courante ; elle est automatiquement mise à jour quand l'utilisateur navigue entre les étapes
- [ ] **B.** Elle définit le chemin de la route associée à chaque étape
- [ ] **C.** Elle n'est utilisée qu'en environnement de test
- [ ] **D.** Elle stocke le nombre total d'étapes du flow

### Question 144

Quel avertissement précis la documentation donne-t-elle sur l'appel à `getStepForm()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle fait à la fois transitionner le flow vers l'étape suivante **et** retourne le formulaire de cette étape : il faut l'appeler une seule fois par requête, après tous les contrôles d'état (`isSubmitted()`, `isValid()`, `isFinished()`)
- [ ] **B.** Elle ne doit jamais être appelée directement, seulement en interne par le composant
- [ ] **C.** Elle ne fonctionne qu'à la toute dernière étape
- [ ] **D.** Elle doit être appelée avant `handleRequest()`

### Question 145

Quelles sont les implémentations de stockage des données entre requêtes mentionnées pour un form flow ? *(plusieurs bonnes réponses)*

- [ ] **A.** `SessionDataStorage` (par défaut, nécessite une session HTTP active)
- [ ] **B.** `InMemoryDataStorage` (principalement pour les tests)
- [ ] **C.** `NullDataStorage` (aucune persistance)
- [ ] **D.** `DatabaseDataStorage` (persistance en base par défaut)

### Question 146

Comment un flow peut-il conditionnellement ignorer une étape, et comment ordonne-t-on les étapes entre elles ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `skip` (callable recevant la donnée) sur `addStep()` ; l'ordre suit la `priority` (plus élevé = plus tôt), ou l'ordre d'insertion à défaut
- [ ] **B.** Il n'est pas possible d'ignorer une étape dynamiquement
- [ ] **C.** L'ordre des étapes est toujours alphabétique
- [ ] **D.** `skip` ne peut être qu'un booléen statique, jamais un callable

### Question 147

Avec Symfony UX Turbo activé sur un formulaire multi-étapes, quels codes de statut HTTP la documentation associe-t-elle respectivement au rendu initial, à une soumission invalide, et à une étape validée avec succès ? *(une seule bonne réponse)*

- [ ] **A.** `200` (rendu initial), `422` (invalide, Turbo réaffiche en place), `303` (valide, Turbo suit la redirection vers l'étape suivante)
- [ ] **B.** `200` pour les trois cas
- [ ] **C.** `201`, `400`, `302`
- [ ] **D.** Le statut HTTP n'a aucune importance pour Turbo

### Question 148

Quelles sont les limites connues (« Known Limitations ») du système de form flow listées par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les flows imbriqués ne sont pas supportés (une étape ne peut pas être elle-même un flow)
- [ ] **B.** Une seule étape est traitée par requête ; il n'est pas possible de soumettre plusieurs étapes en une seule requête
- [ ] **C.** Les étapes doivent être déclarées explicitement dans `buildFormFlow()` ; pas d'étapes générées dynamiquement à l'exécution
- [ ] **D.** Le nombre maximal d'étapes est limité à 5

## Annexe — Réduire la duplication avec `inherit_data`

### Question 149

Quel problème l'option `inherit_data` résout-elle, illustré par les entités `Company` et `Customer` partageant des champs d'adresse ? *(une seule bonne réponse)*

- [ ] **A.** Elle évite de dupliquer la définition des mêmes champs (`address`, `zipcode`, `city`, `country`) dans plusieurs form types, en les extrayant dans un form type partagé
- [ ] **B.** Elle permet de fusionner deux entités Doctrine en une seule table
- [ ] **C.** Elle sert uniquement à améliorer les performances de rendu
- [ ] **D.** Elle remplace les data transformers

### Question 150

Quand un form type comme `LocationType` a l'option `inherit_data: true` et est imbriqué dans `CompanyType` puis dans `CustomerType`, sur quel objet ses champs lisent-ils et écrivent-ils leurs données ? *(une seule bonne réponse)*

- [ ] **A.** Directement sur les propriétés de l'objet du formulaire **parent** (`Company` ou `Customer` selon le contexte d'imbrication), sans avoir sa propre donnée
- [ ] **B.** Toujours sur une instance dédiée de `LocationType`
- [ ] **C.** Sur un tableau associatif indépendant, jamais sur l'objet parent
- [ ] **D.** Cela dépend d'une configuration Doctrine spécifique

### Question 151

Quel avertissement la documentation donne-t-elle sur les événements de formulaire pour un form type avec `inherit_data` activé ? *(une seule bonne réponse)*

- [ ] **A.** Il ne déclenche pas `PRE_SET_DATA`/`POST_SET_DATA`, faute de cycle de vie de donnée propre ; pour réagir dynamiquement, il faut attacher les listeners au formulaire **parent**
- [ ] **B.** Il déclenche ces événements deux fois
- [ ] **C.** Il déclenche uniquement `POST_SUBMIT`
- [ ] **D.** Aucune restriction particulière ne s'applique aux événements

### Question 152

Où l'option `inherit_data` peut-elle être définie, en plus de `configureOptions()` de la classe du form type ? *(une seule bonne réponse)*

- [ ] **A.** Directement dans le 3ᵉ argument de `$builder->add()`, comme n'importe quelle autre option
- [ ] **B.** Uniquement dans un fichier de configuration YAML dédié
- [ ] **C.** Elle ne peut être définie que dans `configureOptions()`
- [ ] **D.** Uniquement via un attribut PHP

## Annexe — Tester unitairement ses formulaires

### Question 153

Quelle classe de base la documentation recommande-t-elle pour tester unitairement un form type personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Form\Test\TypeTestCase`
- [ ] **B.** `Symfony\Bundle\FrameworkBundle\Test\KernelTestCase`
- [ ] **C.** `PHPUnit\Framework\TestCase` seule, sans classe spécialisée
- [ ] **D.** `Symfony\Bundle\FrameworkBundle\Test\WebTestCase`

### Question 154

Quelle extension de test permet de tester un form type enregistré comme service, avec ses dépendances (ex. `EntityManager` mocké) ? *(une seule bonne réponse)*

- [ ] **A.** `PreloadedExtension`, en surchargeant `getExtensions()` pour y injecter une instance du type déjà construite avec ses dépendances
- [ ] **B.** `ValidatorExtension` uniquement
- [ ] **C.** Il n'est pas possible de tester un form type avec dépendances
- [ ] **D.** `DoctrineTestExtension`

### Question 155

Quelle extension permet de tester également la validation d'un formulaire dans ce cadre ? *(une seule bonne réponse)*

- [ ] **A.** `ValidatorExtension`, construite avec un `Validator` réel (`Validation::createValidator()`), retournée depuis `getExtensions()`
- [ ] **B.** Il est techniquement impossible de tester la validation en test unitaire, quelle que soit l'extension
- [ ] **C.** `SecurityExtension`
- [ ] **D.** Aucune extension n'est nécessaire, la validation est active par défaut

### Question 156

Par défaut, quelle est la seule extension de formulaire enregistrée dans `TypeTestCase`, avant tout ajout via `getExtensions()` ? *(une seule bonne réponse)*

- [ ] **A.** `CoreExtension`
- [ ] **B.** `ValidatorExtension`
- [ ] **C.** Toutes les extensions de l'application sont chargées automatiquement
- [ ] **D.** Aucune extension n'est chargée par défaut

### Question 157

Quelle recommandation la documentation formule-t-elle sur le test de la validation dans des tests unitaires de form type ? *(une seule bonne réponse)*

- [ ] **A.** Ne pas tester la validation en test unitaire, car elle dépend de la configuration de validation — plutôt du ressort de tests fonctionnels/d'intégration
- [ ] **B.** Toujours tester la validation avec `ValidatorExtension` : c'est la méthode privilégiée
- [ ] **C.** La validation ne peut techniquement pas être testée du tout
- [ ] **D.** Il faut un `KernelTestCase` complet pour tester la validation

## Annexe — Configurer les données vides d'une classe de formulaire

### Question 158

Quand l'option `empty_data` est-elle utilisée ? *(une seule bonne réponse)*

- [ ] **A.** Quand le formulaire est soumis mais qu'aucune donnée n'a été passée via `setData()` ou à la création du formulaire — elle fournit la donnée « de départ »
- [ ] **B.** À chaque rendu du formulaire, quelle que soit la situation
- [ ] **C.** Uniquement pour les champs non mappés
- [ ] **D.** Uniquement pour les formulaires liés à Doctrine

### Question 159

Quelle est la valeur par défaut de `empty_data`, selon que l'option `data_class` est définie ou non ? *(une seule bonne réponse)*

- [ ] **A.** `null` par défaut ; si `data_class` est défini, une nouvelle instance de cette classe, créée en appelant le constructeur **sans argument**
- [ ] **B.** Toujours un tableau vide
- [ ] **C.** Toujours une nouvelle instance, même sans `data_class`
- [ ] **D.** Il n'y a pas de valeur par défaut, une erreur est levée si elle n'est pas définie

### Question 160

Quelles sont les deux façons de surcharger le comportement par défaut de `empty_data`, et laquelle est préférée ? *(une seule bonne réponse)*

- [ ] **A.** Instancier directement une nouvelle classe (utile pour un constructeur avec arguments), ou fournir une closure — la closure est préférée car elle ne crée l'objet **que si nécessaire**
- [ ] **B.** Uniquement via une closure, aucune autre méthode n'existe
- [ ] **C.** Uniquement en instanciant une classe : les closures ne sont pas supportées
- [ ] **D.** Via une configuration YAML dédiée uniquement

### Question 161

Quel argument la closure passée à `empty_data` doit-elle accepter ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `FormInterface`
- [ ] **B.** Aucun argument
- [ ] **C.** La `Request` HTTP courante
- [ ] **D.** Le nom de la classe `data_class`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Forms de la documentation Symfony 8.0](https://symfony.com/doc/8.0/forms.html). Pour les questions 37 à 161, le nom abrégé de la page annexe précède la section ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : A** — « Think of a form as a bidirectional mapping layer between your PHP objects (or arrays) and HTML forms. » *(§ Understanding How Forms Work)*

**Question 2 : A** — « Data in a form goes through three representations, often called data layers » : Model Data, Normalized Data, View Data. *(§ The Data Transformation Lifecycle)*

**Question 3 : A** — « Model data: a DateTime object; Norm data: an array like ['year' => 2026, 'month' => 10, 'day' => 18]; (values are integers); View data: an array like [...] (values are strings, as submitted by the browser). » *(§ The Data Transformation Lifecycle)*

**Question 4 : A, B, C** — « Form Rendering: […] Model transformers convert it to normalized data. […] View transformers convert it to view data » ; « Form Submission: […] View transformers reverse the data into normalized data. […] Model transformers reverse the data into model data » ; « Most of the time you don't need to think about these layers. They become relevant when debugging […] or when creating custom data transformers. » *(§ The Data Transformation Lifecycle)*

**Question 5 : A** — « In Symfony, all of them are "form types" » : un champ, un groupe de champs, ou un formulaire entier. « This unified concept makes the Form component more flexible. » *(§ Form Types)*

**Question 6 : A, B, C** — « Every form type has a parent. The parent determines the base behavior, options, and rendering that your type inherits » ; « This is why EmailType reuses the rendering and options from TextType » ; « When you create a custom form type and specify a parent (via getParent())… ». *(§ Form Types — The Form Type Hierarchy)*

**Question 7 : A, B, C** — « You can use the debug:form to list all the available types, type extensions and type guessers in your application » ; passer le FQCN (ou nom court) affiche les options du type, ses parents et extensions ; passer aussi un nom d'option affiche « the full definition of that option ». *(§ Form Types)*

**Question 8 : A** — « If your controller extends from the AbstractController, use the createFormBuilder() helper. » (Sinon, `createBuilder()` du service `form.factory`.) *(§ Creating Forms in Controllers)*

**Question 9 : A, B, C** — « Symfony recommends putting as little logic as possible in controllers […] it's better to move complex forms to dedicated classes » ; « it's better to extend from AbstractType, which already implements the interface and provides some utilities » ; « it's generally a good idea to explicitly specify the data_class option […] Later, when you begin embedding forms, this will no longer be sufficient [to rely on guessing]. » *(§ Creating Form Classes)*

**Question 10 : A, B, C** — « a form field named dueDate reads and writes the dueDate property […] This uses the PropertyAccess component » ; `property_path` pour un nom différent, et « You can access nested object properties using dot notation » (ex. `category.name`) ; « For fields that shouldn't be written back to the underlying data, use unmapped fields. » *(§ Mapping Fields to Object Properties)*

**Question 11 : A** — « Form classes are regular services, which means you can inject other services using autowiring […] If you're using the default services.yaml configuration, this works automatically. » *(§ Injecting Services in Form Classes)*

**Question 12 : A** — « The form() function renders all fields and the <form> start and end tags. By default, the form method is POST and the target URL is the same that displayed the form. » *(§ Rendering Forms)*

**Question 13 : A, B, D** — Exemple `twig.form_themes: ['bootstrap_5_layout.html.twig']` ; « The built-in Symfony form themes include Bootstrap 3, 4 and 5, Foundation 5 and 6, as well as Tailwind 2. You can also create your own Symfony form theme » (C est donc faux) ; « Symfony allows you to customize the way fields are rendered with multiple functions to render each field part separately ». *(§ Rendering Forms)*

**Question 14 : A, B, C** — Les trois chemins décrits : chargement initial (« the form hasn't been submitted yet and isSubmitted() returns false ») ; soumission invalide (« isValid() returns false and the form is rendered again […] with validation errors ») ; soumission valide (« you have the opportunity to perform some actions […] before redirecting the user »). *(§ Processing Forms)*

**Question 15 : A** — « By passing $form to the render() method (instead of $form->createView()), the response code is automatically set to HTTP 422 Unprocessable Content. This ensures compatibility with tools relying on the HTTP specification, like Symfony UX Turbo. » *(§ Processing Forms)*

**Question 16 : A, B, C** — « getData() Returns the model data. […] getNormData() Returns the normalized data. […] getViewData() Returns the view data. » `getExtraData()` sert à récupérer les données soumises hors formulaire, pas les erreurs (D faux). *(§ Accessing Form Data)*

**Question 17 : A** — « If a transformer fails, the form (or the affected field) may be marked as not synchronized. » *(§ Accessing Form Data)*

**Question 18 : A, B, C** — « you can also use the submit() method for finer control over when exactly your form is submitted and what data is passed to it » ; « The list of fields submitted with the submit() method must be the same as the fields defined by the form class. Otherwise, you'll see a form validation error » ; « You can also submit individual fields by calling submit() directly on the field: $form->get('firstName')->submit('Fabien'); ». *(§ Using the submit() Method)*

**Question 19 : A** — « When submitting a form via a "PATCH" request […] Passing false will remove any missing fields within the form object. Otherwise, the missing fields will be set to null. […] the validation will only apply to the submitted fields. If you need to validate all the underlying data, add the required fields manually ». *(§ Using the submit() Method)*

**Question 20 : A, B, C** — « use the button's isClicked() method » ; « use the getClickedButton() method to get the clicked button's name » ; « when using nested forms, two or more buttons can have the same name; in those cases, compare the button objects instead of the button names ». *(§ Handling Multiple Submit Buttons)*

**Question 21 : A, B, C** — « the question isn't whether the "form" is valid, but whether or not the underlying object […] is valid […] Calling $form->isValid() is a shortcut that asks the $task object » ; « composer require symfony/validator » ; « You can add them either to the entity class or by using the constraints option of form types » et « Both approaches can be used together. » *(§ Validating Forms)*

**Question 22 : A** — « set the validation_groups option to false […] the form will still run basic integrity checks, for example whether an uploaded file was too large or whether non-existing fields were submitted. » *(§ Disabling Validation)*

**Question 23 : A** — « You can also disable validation for specific submit buttons using 'validation_groups' => false. This is useful in multi-step forms when you want a "Previous" button to save data without running validation. » *(§ Disabling Validation)*

**Question 24 : A, B, D** — « you can pass custom options to it as the third optional argument of createForm() » ; « forms must declare all the options they accept using the configureOptions() method », sinon « The option "require_due_date" does not exist » ; « you can also define the allowed types, allowed values […] supported by the OptionsResolver component » (`setAllowedTypes()`). C est faux, l'option est bien utilisable dans `buildForm()`. *(§ Passing Options to Forms)*

**Question 25 : A** — « The required option does not perform any server-side validation. If a user submits a blank value […] it will be accepted as a valid value unless you also use Symfony's NotBlank or NotNull validation constraints. » *(§ The required Option)*

**Question 26 : A** — « By default, the label of form fields are the humanized version of the property name […] Set the label option on fields to define their labels explicitly […] set it to FALSE to not display the label ». *(§ The label Option)*

**Question 27 : A, B, C** — « By default, the <form> tag is rendered with a method="post" attribute, and no action attribute […] use the setAction() and setMethod() methods to change this » ; « If the form's method is not GET or POST, but PUT, PATCH or DELETE, Symfony will insert a hidden field […] The http_method_override option must be enabled for this to work » ; « you can restrict which HTTP methods can be overridden using the allowed_http_method_override option. » *(§ Changing the Action and HTTP Method)*

**Question 28 : A, B, C** — « Field names follow the pattern: formName[fieldName] » ; « The id attribute follows a similar pattern but uses underscores instead of brackets: formName_fieldName » ; « In Twig templates, prefer form.vars.full_name and form.vars.id as the source of truth, instead of reconstructing names manually. » *(§ Changing the Form Field Names and Ids)*

**Question 29 : A, B, C** — « You can customize this by returning a different value from the getBlockPrefix() method » ; « You can also customize this by creating the form with the createNamed() method » (`createNamed('my_task', ...)`) ; « To create a form without any name prefix […] $formFactory->createNamed('', TaskType::class, $task); ». D est faux : « The default form name is derived from the form type class (for example, TaskType becomes task…) ». *(§ Customizing the Form Name)*

**Question 30 : A, B, C** — « To enable Symfony's "guessing mechanism", omit the second argument to the add() method, or pass null to it » ; `required` deviné depuis les contraintes/Doctrine `nullable`, `maxlength` depuis `Length`/`Range`/longueur Doctrine ; « When using a specific form validation group, the field type guesser will still consider all validation constraints when guessing your field types ». *(§ Form Type Guessing, § Form Type Options Guessing)*

**Question 31 : A** — « Any fields on the form that do not exist on the object will cause an exception to be thrown. […] set the mapped option to false in those fields ». *(§ Unmapped Fields)*

**Question 32 : A** — « Any additional submitted fields are treated as "extra fields". You can access them via the FormInterface::getExtraData() method. […] To accept extra fields, set the allow_extra_fields option to true. Otherwise, the form will be invalid. » *(§ Extra fields)*

**Question 33 : A** — « There are exactly two ways that you can change this behavior and tie the form to an object instead: 1) Pass an object when creating the form […]; 2) Declare the data_class option on your form. » *(§ Using a Form without a Data Class)*

**Question 34 : A, B** — « there are two ways to add constraints to the form data » : au niveau du champ via l'option `constraints`, et « at the class level […] by setting the constraints option in the configureOptions() method » (ex. `Assert\Collection`). *(§ Adding Validation)*

**Question 35 : A** — « use the expression option of the When constraint to reference the other field […] expression: 'this.getParent().get("how_did_you_hear").getData() == "other"'. » *(§ Conditional Constraints)*

**Question 36 : A, B, C** — Les trois FAQ du dépannage : « Populate your object before passing it to createForm() » ; propriété non inscriptible / champ non mappé / formulaire non synchronisé ; absence de donnée initiale ou `data_class`/`empty_data` mal configurés, désynchronisation, ou formulaire non soumis/invalide. *(§ Troubleshooting)*

**Question 37 : A, B** — Les six catégories : Text Fields, Choice Fields, Date and Time Fields, Other Fields, Symfony UX Fields, UID Fields, Field Groups, Hidden Fields, Buttons, Base Fields (huit au total, réparties dans les options A et B). *(Reference — § Supported Field Types)*

**Question 38 : A** — `ChoiceType`, `EnumType`, `EntityType`, `CountryType`, `LanguageType`, `LocaleType`, `TimezoneType`, `CurrencyType` sont listés sous « Choice Fields ». *(Reference)*

**Question 39 : A** — `CollectionType` et `RepeatedType` sont listés sous « Field Groups ». *(Reference)*

**Question 40 : A, B, C** — `FormType` est sous « Base Fields » ; « These types are part of the Symfony UX Packages » pour Cropper/Dropzone ; `UuidType`/`UlidType` sont sous « UID Fields ». `ButtonType`/`ResetType`/`SubmitType` sont sous « Buttons », pas « Field Groups » (D faux). *(Reference)*

**Question 41 : A** — « Add a FileType field with mapped: false so Symfony doesn't try to automatically get/set values ». *(Upload — § Form Configuration)*

**Question 42 : A** — « Set the multiple option to true […] 'constraints' => [new Assert\All([new Assert\File(...)])] ». *(Upload — § Multiple File Uploads)*

**Question 43 : A, B, C** — « Never trust user-provided filenames » ; « Use guessExtension() based on MIME type instead of client-provided extensions » ; « Generate unique filenames using methods like uniqid() ». *(Upload — § Security Best Practices)*

**Question 44 : A** — « Store only filenames in the database, not file contents » ; « Use the Asset helper to link to uploaded files: asset('uploads/brochures/' ~ product.brochureFilename) ». *(Upload — § Important Notes)*

**Question 45 : A** — « Extract upload logic into a dedicated service to keep controllers clean […] class FileUploader ». *(Upload — § Creating an Uploader Service)*

**Question 46 : A** — « The documentation recommends using VichUploaderBundle for more advanced use cases. » *(Upload — § Important Notes)*

**Question 47 : A** — « Doctrine listeners are no longer recommended for file upload logic. » *(Upload — § Important Notes)*

**Question 48 : A** — « CSRF […] is an attack where a malicious actor tricks users into performing unwanted actions […] CSRF protection should only be used for state-changing operations, not GET requests, as per OWASP best practices. » *(CSRF — § Overview)*

**Question 49 : A** — « composer require symfony/security-csrf » puis `framework.csrf_protection: true`. *(CSRF — § Installation)*

**Question 50 : A** — « Symfony Forms include CSRF tokens by default and automatically validate them. No additional action is needed when using Symfony Forms. » *(CSRF — § CSRF Protection in Symfony Forms)*

**Question 51 : A** — Options `csrf_field_name` et `csrf_token_id` dans `configureOptions()`. *(CSRF — § Customizing Token Field Name)*

**Question 52 : A, B, C** — `$this->isCsrfTokenValid('delete-item', $submittedToken)` ; `#[IsCsrfTokenValid('delete-item', tokenKey: 'token')]` ; « Restricting to Specific HTTP Methods » via l'option `methods`. *(CSRF — § Generating and Checking CSRF Tokens Manually)*

**Question 53 : A, B, C** — « Token Sources: SOURCE_PAYLOAD (default) […] SOURCE_QUERY […] SOURCE_HEADER ». Pas de `SOURCE_COOKIE` listé (D faux). *(CSRF — § Specifying Token Source)*

**Question 54 : A** — « Stateless CSRF tokens don't rely on sessions, allowing full page caching while still protecting against CSRF attacks. » *(CSRF — § Stateless CSRF Tokens)*

**Question 55 : A, B, C** — « When validating stateless CSRF tokens, Symfony checks: 1. The Origin header 2. The Referer header 3. Optional: Cookie and header-based "double-submit" protection (via JavaScript) ». *(CSRF — § Validation Mechanism)*

**Question 56 : A** — « Symfony uses random masking prepended to tokens to mitigate BREACH and CRIME attacks against HTTPS with compression enabled. » *(CSRF — § CSRF Protection and Compression Attacks)*

**Question 57 : A** — « There are two main approaches: 1. Based on Symfony Built-in Types […] 2. Created From Scratch. » *(Custom Field Type — § Overview)*

**Question 58 : A** — `public function getParent(): string { return ChoiceType::class; }`. *(Custom Field Type — § Creating Form Types Based on Symfony Built-in Types)*

**Question 59 : A** — Tableau des méthodes clés : `buildForm()` « Configure fields and structure » ; `buildView()` « Set template variables ». *(Custom Field Type — § Creating Form Types From Scratch)*

**Question 60 : A** — `setNormalizer('allowed_states', ...)` convertit par exemple une chaîne unique en tableau normalisé. *(Custom Field Type — § Adding Configuration Options)*

**Question 61 : A** — Exemples donnés : `postal_address_row`, `postal_address_addressLine1_help`, `postal_address_state_widget`, `postal_address_zipCode_label` — motif `{type_name}_{part}`. *(Custom Field Type — § Template Block Naming)*

**Question 62 : A** — « Warning: Override getBlockPrefix() if your form class name matches built-in types to avoid collisions. » *(Custom Field Type — § Template Block Naming)*

**Question 63 : A** — « Use buildView() to pass custom variables: $view->vars['isExtendedAddress'] = ...; ». *(Custom Field Type — § Passing Variables to the Template)*

**Question 64 : A** — « Data transformers translate field data into a format that can be displayed in a form and back on submit. […] Note: Data transformers are not applied to fields with inherit_data option set to true. » *(Data Transformers — § Overview)*

**Question 65 : A** — « The first callback transforms the original value for display; the second reverses the transformation on submission. » *(Data Transformers — § Example #1)*

**Question 66 : A, B, C** — « throw TransformationFailedException for validation errors » ; « Return equivalent empty values for null inputs » ; « You can also set custom error messages in the transformer […] $failure->setInvalidMessage(...) ». *(Data Transformers — § Example #2)*

**Question 67 : A** — « Model transformers: transform(): model data → norm data […] View transformers […]: transform(): norm data → view data ». *(Data Transformers — § Model vs. View Transformers)*

**Question 68 : A, B** — « Don't apply transformers to entire forms—only specific fields » ; « Model transformers cannot filter Collection items (use DTOs as workaround) ». C est faux : « With default services.yaml, transformers are auto-wired via autoconfigure ». *(Data Transformers — § Important Notes)*

**Question 69 : A** — Exemple `IssueSelectorType` : `buildForm()` ajoute `addModelTransformer($this->transformer)`, et `getParent(): string { return TextType::class; }`. *(Data Transformers — § Creating a Reusable Custom Field Type)*

**Question 70 : A** — Le `CallbackTransformer` prend deux callables directement dans son constructeur (voir Exemple #1), pratique pour une transformation locale simple. *(Data Transformers — § Example #1)*

**Question 71 : A** — « Data transformers change the representation of a single value […]; Data mappers map data (e.g. an object or array) to one or many form fields, and vice versa. » *(Data Mappers — § The Difference between Data Transformers and Mappers)*

**Question 72 : A** — « because you've decided to make the Color object immutable, a new color object has to be created each time one of the values is changed […] It's time for a data mapper. » *(Data Mappers — § Creating a Data Mapper)*

**Question 73 : A** — `mapDataToForms($viewData, $forms)` pré-remplit les champs ; `mapFormsToData($forms, &$viewData)` reconstruit l'objet, « as data is passed by reference ». *(Data Mappers — § Creating a Data Mapper)*

**Question 74 : A** — « Warning: The data passed to the mapper is not yet validated. This means that your objects should allow being created in an invalid state in order to produce user-friendly errors. » *(Data Mappers — § Creating a Data Mapper)*

**Question 75 : A, B** — « If available, these options [getter/setter] have priority over the property path accessor and the default data mapper will still use the PropertyAccess component for the other form fields » ; « When a form has the inherit_data option set to true, it does not use the data mapper and lets its parent map inner values. » *(Data Mappers — § Mapping Form Fields Using Callbacks)*

**Question 76 : A** — « The only method you must implement is getExtendedTypes(), which configures which field types you want to modify. » *(Form Type Extension — § Defining the Form Type Extension)*

**Question 77 : A** — « 1. Add a specific feature to a single form type […] 2. Add a generic feature to several types ». *(Form Type Extension — § Two Main Use-Cases)*

**Question 78 : A** — « tagged with the form.type_extension tag. […] this is already done for you, thanks to autoconfiguration » ; « an optional tag attribute called priority, which defaults to 0 and controls the order […] the higher the priority, the earlier an extension is loaded ». *(Form Type Extension — § Registering your Form Type Extension as a Service)*

**Question 79 : A** — « return [DateTimeType::class, DateType::class, TimeType::class]; » dans `getExtendedTypes()`. *(Form Type Extension — § Multiple Form Types Example)*

**Question 80 : A** — « since most form types natively available in Symfony inherit from the FormType form type […] (notable exceptions are the ButtonType form types). » *(Form Type Extension — § Generic Form Type Extensions)*

**Question 81 : A, B** — « Guessers are used only in the following cases: Using createForProperty() or createBuilderForProperty(); Calling add() or create() […] without an explicit type, in a context where the parent form has defined a data class. » *(Type Guesser — introduction)*

**Question 82 : A** — « Symfony also provides some form type guessers in the bridges: DoctrineOrmTypeGuesser provided by the Doctrine bridge. » *(Type Guesser — § Form Type Guessers in the Bridges)*

**Question 83 : A** — « This interface requires four methods: guessType() […] guessRequired() […] guessMaxLength() […] guessPattern() ». *(Type Guesser — § Create a PHPDoc Type Guesser)*

**Question 84 : A** — « The TypeGuess constructor requires three options: The type name […]; Additional options […]; The confidence […] one of the constants of the Guess class: LOW_CONFIDENCE, MEDIUM_CONFIDENCE, HIGH_CONFIDENCE, VERY_HIGH_CONFIDENCE. » *(Type Guesser — § Guessing the Type)*

**Question 85 : A** — « You should be very careful using the guessMaxLength() method. When the type is a float, you cannot determine a length […] the value should be set to null with a MEDIUM_CONFIDENCE. » *(Type Guesser — § Guessing Field Options)*

**Question 86 : A** — « If you're using autowire and autoconfigure, you're done! […] If you're not using autowire and autoconfigure, register your service manually and tag it with form.type_guesser. » *(Type Guesser — § Registering a Type Guesser)*

**Question 87 : A** — « define this configuration: twig: form_themes: ['bootstrap_4_layout.html.twig'] ». *(Bootstrap 4)*

**Question 88 : A** — « form_errors() is called by form_label() internally. If you call to form_errors() in your template, you'll get the error messages displayed twice. » *(Bootstrap 4 — § Error Messages)*

**Question 89 : A** — « For a checkbox/radio field, calling form_label() doesn't render anything. Due to Bootstrap internals, the label is already rendered by form_widget(). » *(Bootstrap 4 — § Checkboxes and Radios)*

**Question 90 : A** — « you can enable that on your Symfony Form RadioType and CheckboxType by adding some classes to the label: radio-custom, checkbox-custom, switch-custom. » *(Bootstrap 4 — § Custom Forms)*

**Question 91 : A** — « Unlike in the Bootstrap 4 theme, errors are rendered after the input element. However, this still makes a strong connection […] as required by the WCAG 2.0 standard. » *(Bootstrap 5 — § Error Messages)*

**Question 92 : A** — « By default, all inputs are rendered with the mb-3 class on their container. If you override the row_attr class option, the mb-3 will be overridden too and you will need to explicitly add it. » *(Bootstrap 5 — § Setup)*

**Question 93 : A** — « you can enable this feature on your Symfony Form CheckboxType by adding the checkbox-switch class to the label […] Warning: Switches only work with checkbox. » *(Bootstrap 5 — § Switches)*

**Question 94 : A** — « simply add the input-group class to the row_attr option. » *(Bootstrap 5 — § Input group)*

**Question 95 : A** — « you must add a label, a placeholder and the form-floating class to the row_attr option […] Warning: You must provide a label and a placeholder to make floating labels work properly. » *(Bootstrap 5 — § Floating labels)*

**Question 96 : A** — « you can add the checkbox-inline or radio-inline class […] to the label class. » *(Bootstrap 5 — § Inline Checkboxes and Radios)*

**Question 97 : A** — « Tailwind has an official form plugin that provides a basic form reset that standardizes their look on all browsers. This form theme requires this plugin. » *(Tailwind CSS)*

**Question 98 : A** — « When customizing the classes this way the defaults provided by the theme are overridden opposed to merged as is the case with other themes. » *(Tailwind CSS — § Twig Form Functions)*

**Question 99 : A** — « If you have a generic Tailwind style for all your forms, you can create a custom form theme using the Tailwind CSS theme as a base » via `{% use 'tailwind_2_layout.html.twig' %}` et `{{ parent() }}`. *(Tailwind CSS — § Project Specific Form Layout)*

**Question 100 : A** — « Best Practice: Always include {{ form_rest(form) }} before form_end() to ensure hidden fields (such as CSRF tokens) and any forgotten fields are properly rendered. » *(Form Customization — § Rendering Forms)*

**Question 101 : A** — « form_end(form_view, variables) Renders the </form> closing tag. By default, calls form_rest(): […] {{ form_end(form, {render_rest: false}) }} ». *(Form Customization — § Twig Form Functions)*

**Question 102 : A** — « form_label(form_view, label, variables) […] The second argument overrides the default label […] this is equivalent [to passing label in the variables array]. » *(Form Customization — § Twig Form Functions)*

**Question 103 : A** — « When a form field has validation errors, all built-in form themes automatically add the aria-invalid="true" attribute to the <input> element and link it to error messages using aria-describedby. » *(Form Customization — § form_parent)*

**Question 104 : A** — « When you need full control over the HTML (bypassing themes), use the field_*() helpers that return raw values. » *(Form Customization — § Form Field Helpers)*

**Question 105 : A** — « rootform Checks if a form view is the root form (has no parent). » *(Form Customization — § Twig Form Tests)*

**Question 106 : A** — « Example lookup chain for an EmailType field named contact in a form called user: _user_contact_widget → email_widget → text_widget → found in form_div_layout.html.twig ». *(Form Theming — § The Rendering Pipeline)*

**Question 107 : A, B, C, D** — Les quatre familles listées sous « Built-In Form Themes » : sans framework (`form_div_layout`/`form_table_layout`), Bootstrap 3/4/5 (+ variantes horizontales), Foundation 5/6, Tailwind 2. *(Form Theming — § Using Form Themes)*

**Question 108 : A** — « Using Multiple Themes: Symfony searches themes in reverse order (last theme checked first). » *(Form Theming — § Applying Themes Globally)*

**Question 109 : A** — « Disabling global themes: {% form_theme form with ['form/standalone_theme.html.twig'] only %} […] When using only, your theme must define all necessary blocks or extend a built-in one. » *(Form Theming — § Applying Themes to Single Forms)*

**Question 110 : A** — Tableaux comparatifs : `{type}_{part}` (ex. `text_widget`) pour « Customizing by Field Type », contre `_{form}_{field}_{part}` (ex. `_user_email_widget`) pour « Customizing Individual Fields ». *(Form Theming — § Block Naming Rules)*

**Question 111 : A, B** — « $builder->add('name', TextType::class, ['block_name' => 'custom_name']); » ; « Use the block_prefix option: […] Now you can define book_author_widget, book_author_row, etc. ». *(Form Theming — § Customizing Individual Fields, § Customizing Specific Field Instances)*

**Question 112 : A** — « {% block _article_tags_row %} {# the entire tags collection #} {% endblock %} […] {% block _article_tags_entry_row %} {# each individual TagType entry #} {% endblock %} ». *(Form Theming — § Customizing Collections)*

**Question 113 : A** — Tableau « Choosing the Right Event » : « Modify initial data before the form processes it → PRE_SET_DATA » ; « Modify form structure based on initial data → POST_SET_DATA ». *(Events — § Choosing the Right Event)*

**Question 114 : A, B, C** — « For static conditional fields, use form options » ; « For data depending on the logged-in user, inject the Security service instead of using events » ; « For data transformation, use data transformers instead. » *(Events — § When NOT to Use Form Events)*

**Question 115 : A** — « During pre-population (setData): 1. TaskType::PRE_SET_DATA 2. CategoryType::PRE_SET_DATA 3. CategoryType::POST_SET_DATA 4. TaskType::POST_SET_DATA ». *(Events — § Events in Nested Forms)*

**Question 116 : A** — « Event Listeners: Best for simple, form-specific logic […] Event Subscribers: Best for reusable logic across multiple forms. » *(Events — § Form Event Listeners vs Subscribers)*

**Question 117 : A** — « PRE_SUBMIT: Fires at the start of submit() with raw request data. » *(Events — § PRE_SUBMIT)*

**Question 118 : A** — « SUBMIT: Fires after view-to-norm transformation, before norm-to-model transformation. […] What you cannot do: Add or remove fields. » *(Events — § SUBMIT)*

**Question 119 : A** — « POST_SUBMIT […] What you can do: Add fields to parent form […] What you cannot do: Add or remove fields on the form the listener is attached to. » *(Events — § POST_SUBMIT)*

**Question 120 : A** — « "This Form Should Not Contain Extra Fields" Error: The form structure at submission doesn't match rendering. » ; « Data Transformer Exception During Submit: The submitted value doesn't match what the transformer expects. » *(Events — § Troubleshooting)*

**Question 121 : A** — « handle initial render: add State based on entity's Country » via `FormEvents::POST_SET_DATA` ; « handle submission: update State when Country changes » via `POST_SUBMIT` sur `$builder->get('country')`. *(Dynamic Modification — § Dependent Selects)*

**Question 122 : A** — Note : « The key is to listen to POST_SUBMIT on the Country field (child), then modify the State field on the parent form. You cannot modify the form that fired the event, but you can modify its parent. » *(Dynamic Modification — § Note)*

**Question 123 : A** — Classe annotée `#[Exclude]`, puis « inject the dependencies into your form type and instantiate the subscriber: […] ->addEventSubscriber(new AuditFieldsSubscriber($this->userRepository)) ». *(Dynamic Modification — § Creating Reusable Event Subscribers with Dependencies)*

**Question 124 : A** — « Warning: Be careful with external service calls in form events. They run on every form render and submission, which can cause performance issues. » *(Dynamic Modification — § Warning about External Services)*

**Question 125 : A** — La fermeture `$addStateField` est définie une fois puis appelée depuis le listener `POST_SET_DATA` (rendu initial) et depuis le listener `POST_SUBMIT` du champ `country` (soumission), pour ne pas dupliquer la logique de choix des états. *(Dynamic Modification — § Dependent Selects)*

**Question 126 : A** — « only the registration group will be used to validate the object. To apply the registration group and all constraints not in any other group, add the special Default group. » *(Validation Groups — introduction)*

**Question 127 : A** — « Symfony recommends using "lower snake case" (e.g. foo_bar), while automatically generated groups use "UpperCamelCase" (e.g. Default, SomeClassName). » *(Validation Groups — introduction)*

**Question 128 : A** — « To determine validation groups dynamically based on submitted data, use a callback. This is called after the form is submitted, but before validation is invoked. The callback receives the form object as its first argument. » *(Validation Groups — § Choosing Validation Groups Based on Submitted Data)*

**Question 129 : A** — « If validation group logic requires services or can't fit in a closure, use a dedicated validation group resolver service. The class of this service must be invokable and receives the form object as its first argument. » *(Validation Groups — § Choosing Validation Groups via a Service)*

**Question 130 : A** — « configure the validation groups of the previousStep button to false, which is a special value that skips validation. » *(Validation Groups — § Choosing Validation Groups Based on the Clicked Button)*

**Question 131 : A** — « The Valid Constraint has been added to the property category. This cascades the validation to the corresponding entity. If you omit this constraint, the child entity would not be validated. » *(Embedded — § Embedding a Single Object)*

**Question 132 : A** — « add a category field to the TaskType object whose type is an instance of the new CategoryType class: $builder->add('category', CategoryType::class); ». *(Embedded — § Embedding a Single Object)*

**Question 133 : A** — « the submitted data for the Category fields are used to construct an instance of Category, which is then set on the category field of the Task instance. The Category instance is accessible naturally via $task->getCategory() ». *(Embedded — § Embedding a Single Object)*

**Question 134 : A** — « $builder->add('tags', CollectionType::class, ['entry_type' => TagType::class, 'entry_options' => ['label' => false]]); ». *(Form Collections — § Basic Setup)*

**Question 135 : A** — « Enable the allow_add option […] data-prototype="{{ form_widget(form.tags.vars.prototype)|e('html_attr') }}" […] item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, ...). » *(Form Collections — § Allowing New Tags with Prototype)*

**Question 136 : A** — « Set by_reference to false in TaskType » pour forcer l'appel de `addTag()`/`removeTag()` plutôt qu'une écriture directe par référence. *(Form Collections — § Handling New Tags in PHP)*

**Question 137 : A** — « Enable the allow_delete option […] Task Entity: public function removeTag(Tag $tag): void { $this->tags->removeElement($tag); } ». *(Form Collections — § Allowing Tags to be Removed)*

**Question 138 : A** — « Add cascade persist to handle new tags automatically: #[ORM\ManyToMany(targetEntity: Tag::class, cascade: ['persist'])] ». *(Form Collections — § Doctrine Configuration)*

**Question 139 : A** — Le contrôleur clone la collection d'origine (`$originalTags`), puis pour chaque tag disparu de la nouvelle collection : « $tag->getTasks()->removeElement($task); $entityManager->persist($tag); ». *(Form Collections — § Removing Relationships)*

**Question 140 : A** — « Add adder/remover methods to the Task class » ; côté relation inverse, « $tag->addTask($this); // for many-to-many […] $this->tags->add($tag); ». *(Form Collections — § Handling New Tags in PHP, § Handling Inverse Side Relationships)*

**Question 141 : A** — « A form flow is created by extending AbstractFlowType and implementing buildFormFlow() […] $builder->addStep('personal', PersonalType::class); ». *(Form Flow — § Creating a Multi-Step Form)*

**Question 142 : A** — « Note: Validation groups are automatically scoped to the current step. By default, the active groups are ['Default', '<current_step_name>']. » *(Form Flow — § Creating a Multi-Step Form)*

**Question 143 : A** — « A form flow needs to know which step is currently active. By default, this is done via a property path on the form data. […] The property is automatically updated when the user moves between steps. » *(Form Flow — § Storing the Current Step)*

**Question 144 : A** — « Warning: getStepForm() both transitions the flow to the next step and returns the form for that step. Call it only once per request, and only after all state checks […] are complete. » *(Form Flow — § Processing a Multi-Step Form)*

**Question 145 : A, B, C** — « SessionDataStorage: stores data in the session (used by default) […] Note: SessionDataStorage requires an active HTTP session » ; « InMemoryDataStorage: stores data in memory (mainly for tests) » ; « NullDataStorage: does not persist data ». Pas de `DatabaseDataStorage` mentionné (D faux). *(Form Flow — § Persisting Data Between Requests)*

**Question 146 : A** — « Steps can be conditionally skipped using a callable […] Steps are ordered by priority (higher first). If no priority is defined, steps are ordered by insertion order. » *(Form Flow — § Step Ordering and Priority, § Skipping Steps)*

**Question 147 : A** — « The expected status codes are: 200: initial rendering […]; 422: form submitted but invalid (Turbo re-renders the form in place); 303: form submitted and valid, advancing to the next step (Turbo follows the redirect). » *(Form Flow — § Using Multi-Step Forms with Turbo)*

**Question 148 : A, B, C** — « Nested form flows are not supported; a flow step cannot itself be a flow. » ; « One step per request: only the active step's form is processed on each request. » ; « Steps must be declared explicitly in buildFormFlow(). Dynamic or runtime-generated steps are not supported. » *(Form Flow — § Known Limitations)*

**Question 149 : A** — « Instead of including the duplicated fields address, zipcode, city and country in both of these forms, create a third form called LocationType for that ». *(inherit_data — introduction)*

**Question 150 : A** — « This option lets the form inherit its data from its parent form. If embedded in the company form, the fields of the location form will access the properties of the Company instance. If embedded in the customer form, the fields will access the properties of the Customer instance instead. » *(inherit_data — introduction)*

**Question 151 : A** — « Warning: Forms with the inherit_data option set do not dispatch the PRE_SET_DATA and POST_SET_DATA form events, because they don't have their own data lifecycle. To modify fields dynamically […] add the event listeners to the parent form instead. » *(inherit_data — fin d'article)*

**Question 152 : A** — « Note: Instead of setting the inherit_data option inside LocationType, you can also (just like with any option) pass it in the third argument of $builder->add(). » *(inherit_data — introduction)*

**Question 153 : A** — « The recommended approach uses TypeTestCase, which is part of Symfony's testing utilities. » *(Unit Testing — § The Basics)*

**Question 154 : A** — « For form types with dependencies (e.g., Doctrine entity manager), use PreloadedExtension […] protected function getExtensions(): array { $type = new TestedType($this->entityManager); return [new PreloadedExtension([$type], [])]; } ». *(Unit Testing — § Testing Types Registered as Services)*

**Question 155 : A** — « To load additional extensions (like ValidatorExtension) […] $validator = Validation::createValidator(); return [new ValidatorExtension($validator)]; ». *(Unit Testing — § Adding Custom Extensions)*

**Question 156 : A** — « By default, only CoreExtension is registered in tests. » *(Unit Testing — § Important Notes)*

**Question 157 : A** — « Don't test validation in unit tests—it relies on validation configuration. » *(Unit Testing — § Important Notes)*

**Question 158 : A** — « The empty_data option allows you to specify an empty data set for your form class. This empty data set would be used if you submit your form, but haven't called setData() on your form or passed in data when you created your form. » *(empty_data — introduction)*

**Question 159 : A** — « By default, empty_data is set to null. Or, if you have specified a data_class option for your form class, it will default to a new instance of that class. That instance will be created by calling the constructor with no arguments. » *(empty_data — introduction)*

**Question 160 : A** — « Option 1: Instantiate a new Class […] Option 2: Provide a Closure […] Using a closure is the preferred method, since it will only create the object if it is needed. » *(empty_data — § Option 1, § Option 2)*

**Question 161 : A** — « The closure must accept a FormInterface instance as the first argument ». *(empty_data — § Option 2)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/forms.html#learn-more) de la page (22 liens, groupés par la documentation elle-même) :

**Reference**
- [Form Types Reference](https://symfony.com/doc/8.0/reference/forms/types.html) — questions 37 à 40

**Advanced Features**
- [How to Upload Files](https://symfony.com/doc/8.0/controller/upload_file.html) — questions 41 à 47
- [How to Implement CSRF Protection](https://symfony.com/doc/8.0/security/csrf.html) — questions 48 à 56
- [How to Create a Custom Form Field Type](https://symfony.com/doc/8.0/form/create_custom_field_type.html) — questions 57 à 63
- [How to Use Data Transformers](https://symfony.com/doc/8.0/form/data_transformers.html) — questions 64 à 70
- [When and How to Use Data Mappers](https://symfony.com/doc/8.0/form/data_mappers.html) — questions 71 à 75
- [How to Create a Form Type Extension](https://symfony.com/doc/8.0/form/create_form_type_extension.html) — questions 76 à 80
- [Creating a custom Type Guesser](https://symfony.com/doc/8.0/form/type_guesser.html) — questions 81 à 86

**Form Themes and Customization**
- [Bootstrap 4 Form Theme](https://symfony.com/doc/8.0/form/bootstrap4.html) — questions 87 à 90
- [Bootstrap 5 Form Theme](https://symfony.com/doc/8.0/form/bootstrap5.html) — questions 91 à 96
- [Tailwind CSS Form Theme](https://symfony.com/doc/8.0/form/tailwindcss.html) — questions 97 à 99
- [How to Customize Form Rendering](https://symfony.com/doc/8.0/form/form_customization.html) — questions 100 à 105
- [Form Theming and Customization](https://symfony.com/doc/8.0/form/form_themes.html) — questions 106 à 112

**Events**
- [Form Events](https://symfony.com/doc/8.0/form/events.html) — questions 113 à 120
- [How to Dynamically Modify Forms Using Form Events](https://symfony.com/doc/8.0/form/dynamic_form_modification.html) — questions 121 à 125

**Validation**
- [Configuring Validation Groups in Forms](https://symfony.com/doc/8.0/form/validation_groups.html) — questions 126 à 130

**Misc.**
- [How to Embed Forms](https://symfony.com/doc/8.0/form/embedded.html) — questions 131 à 133
- [How to Embed a Collection of Forms](https://symfony.com/doc/8.0/form/form_collections.html) — questions 134 à 140
- [Multi-Step Forms](https://symfony.com/doc/8.0/form/form_flow.html) — questions 141 à 148
- [How to Reduce Code Duplication with "inherit_data"](https://symfony.com/doc/8.0/form/inherit_data_option.html) — questions 149 à 152
- [How to Unit Test your Forms](https://symfony.com/doc/8.0/form/unit_testing.html) — questions 153 à 157
- [How to Configure empty Data for a Form Class](https://symfony.com/doc/8.0/form/use_empty_data.html) — questions 158 à 161
