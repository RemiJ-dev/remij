# QCM — Le Serializer

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/serializer.html](https://symfony.com/doc/8.0/serializer.html) et les pages de sa section [Going Further with the Serializer](https://symfony.com/doc/8.0/serializer.html#going-further-with-the-serializer) (équivalent du « Learn more ») · **Généré le :** 22 juillet 2026
>
> **144 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande installe le pack recommandé pour utiliser le Serializer dans une application Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/serializer`
- [ ] **B.** Il est installé par défaut avec `symfony/framework-bundle`
- [ ] **C.** `composer require symfony/serializer-bundle`
- [ ] **D.** `composer require symfony/serializer-pack`

## Sérialiser un objet

### Question 2

Comment obtenir le service serializer et transformer un objet en JSON ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `json_encode($person)` directement, le Serializer ne faisant qu'envelopper cette fonction
- [ ] **B.** En type-hintant `SerializerInterface` et en appelant `$serializer->serialize($person, 'json')`
- [ ] **C.** En appelant une méthode statique `Serializer::toJson($person)`
- [ ] **D.** En type-hintant `NormalizerInterface` uniquement, `serialize()` n'existant que sur cette interface

### Question 3

Quel raccourci `AbstractController` propose-t-il pour créer une réponse JSON à partir d'un objet en utilisant le Serializer ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de raccourci, il faut toujours injecter `SerializerInterface` explicitement
- [ ] **B.** La méthode `json()`
- [ ] **C.** La méthode `serializeResponse()`
- [ ] **D.** La méthode `toJsonResponse()`

### Question 4

Comment sérialiser un objet directement dans un template Twig ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible depuis Twig, il faut toujours sérialiser en PHP avant de passer la donnée au template
- [ ] **B.** Avec la fonction Twig `serializer_encode(person)`
- [ ] **C.** Avec le filtre `json_encode` natif de Twig, `serialize` n'existant pas
- [ ] **D.** Avec le filtre `serialize`, par exemple `{{ person|serialize(format = 'json') }}`

## Désérialiser un objet

### Question 5

Quels sont les trois paramètres attendus par `Serializer::deserialize()` ? *(une seule bonne réponse)*

- [ ] **A.** Le nom de la classe cible, un tableau de contexte, et le format
- [ ] **B.** Uniquement les données à décoder et le nom de la classe cible, le format étant toujours déduit automatiquement
- [ ] **C.** Les données à décoder, le nom de la classe cible, et le nom de l'encodeur (format d'entrée)
- [ ] **D.** Les données à décoder, le format de sortie, et un tableau de contexte obligatoire

### Question 6

Par défaut, que fait le Serializer avec les attributs présents dans les données désérialisées mais qui ne correspondent à aucune propriété de l'objet cible ? *(une seule bonne réponse)*

- [ ] **A.** Il interrompt la désérialisation et retourne `null`
- [ ] **B.** Il les ignore silencieusement
- [ ] **C.** Il lève systématiquement une exception
- [ ] **D.** Il les ajoute comme propriétés dynamiques de l'objet

## Le processus de sérialisation : normaliseurs et encodeurs

### Question 7

Quelles sont les deux responsabilités du processus de (dé)sérialisation, et quel rôle joue chacune ? *(une seule bonne réponse)*

- [ ] **A.** Les normaliseurs ne concernent que la désérialisation, les encodeurs que la sérialisation
- [ ] **B.** Les normaliseurs convertissent entre objets et tableaux ; les encodeurs convertissent entre tableaux et un format spécifique (JSON, XML…)
- [ ] **C.** Les encodeurs convertissent entre objets et tableaux ; les normaliseurs convertissent entre tableaux et un format spécifique
- [ ] **D.** Les deux font exactement la même chose, dans un ordre interchangeable

### Question 8

Quel est le normaliseur le plus important configuré par défaut, et sur quoi repose-t-il ? *(une seule bonne réponse)*

- [ ] **A.** `CustomNormalizer`, activé par défaut dans toute application Symfony
- [ ] **B.** `ObjectNormalizer`, qui utilise la réflexion et le composant PropertyAccess
- [ ] **C.** `ArrayNormalizer`, qui repose uniquement sur `get_object_vars()`
- [ ] **D.** `ReflectionNormalizer`, qui n'utilise jamais de getters/setters

### Question 9

Quels encodeurs sont configurés par défaut avec le service `serializer` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `JsonEncoder` et `XmlEncoder`
- [ ] **B.** `CsvEncoder` et `YamlEncoder`
- [ ] **C.** `NeonEncoder`
- [ ] **D.** `GraphQLEncoder`

## Le contexte du serializer

### Question 10

À quels endroits peut-on configurer le contexte du serializer ? *(plusieurs bonnes réponses)*

- [ ] **A.** Globalement via la configuration du framework
- [ ] **B.** Au moment d'un appel précis à `serialize()`/`deserialize()`
- [ ] **C.** Pour une propriété spécifique
- [ ] **D.** Uniquement dans le fichier `.env`, jamais ailleurs

### Question 11

Si le même réglage de contexte est configuré à la fois globalement et sur une propriété spécifique, lequel l'emporte ? *(une seule bonne réponse)*

- [ ] **A.** Celui défini globalement, qui ne peut jamais être surchargé
- [ ] **B.** Une exception est levée en cas de conflit
- [ ] **C.** Les deux sont fusionnés en tableau, sans priorité de l'un sur l'autre
- [ ] **D.** Celui défini sur la propriété spécifique

### Question 12

Comment configurer un contexte par défaut pour toute l'application, par exemple pour interdire les attributs supplémentaires en désérialisation ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable d'environnement `SERIALIZER_CONTEXT`
- [ ] **B.** Via `framework.serializer.default_context`
- [ ] **C.** Via `framework.serializer.global_context`
- [ ] **D.** Ce n'est configurable qu'au cas par cas, jamais globalement

### Question 13

À quoi servent les « context builders », et quel avantage offrent-ils par rapport à un tableau de contexte brut ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne servent qu'à des fins de test, jamais en production
- [ ] **B.** Ils remplacent entièrement les normaliseurs, qui deviennent alors inutiles
- [ ] **C.** Ils ne fonctionnent qu'avec l'encodeur JSON
- [ ] **D.** Ce sont des objets PHP qui offrent autocomplétion, validation et documentation des options de contexte

### Question 14

Comment chaîner plusieurs context builders pour construire un contexte plus complexe ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, un seul context builder peut être utilisé à la fois
- [ ] **B.** En les additionnant avec l'opérateur `+`
- [ ] **C.** Via un tableau `[$builder1, $builder2]` passé directement à `serialize()`
- [ ] **D.** Via la méthode `withContext()`, en imbriquant un builder dans un autre

### Question 15

Comment configurer un contexte spécifique à une seule propriété d'une classe, par exemple le format d'une date ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le contexte est toujours global à la classe entière
- [ ] **B.** En créant un normaliseur dédié pour chaque propriété ayant un contexte particulier
- [ ] **C.** Uniquement via `default_context`, sans granularité par propriété
- [ ] **D.** Avec l'attribut `#[Context]` sur la propriété (ou via un mapping YAML/XML équivalent)

### Question 16

Dans quels emplacements les fichiers de mapping YAML/XML du serializer doivent-ils se trouver pour être détectés ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tous les fichiers `*.yaml`/`*.xml` du répertoire `config/serializer/`
- [ ] **B.** Le fichier `serialization.yaml`/`serialization.xml` dans `Resources/config/` d'un bundle
- [ ] **C.** Tous les fichiers `*.yaml`/`*.xml` de `Resources/config/serialization/` d'un bundle
- [ ] **D.** N'importe quel fichier `*.yaml` du projet, sans emplacement particulier requis

### Question 17

L'attribut `#[Context]` permet-il de définir un contexte différent pour la normalisation et la dénormalisation d'une même propriété ? *(une seule bonne réponse)*

- [ ] **A.** Non, cette distinction n'existe que via la configuration YAML, pas via l'attribut
- [ ] **B.** Oui, via les paramètres `normalizationContext` et `denormalizationContext`
- [ ] **C.** Non, un seul contexte s'applique indifféremment aux deux directions
- [ ] **D.** Oui, mais uniquement en créant deux propriétés PHP distinctes

### Question 18

Peut-on restreindre l'application d'un `#[Context]` à certains groupes de sérialisation, et comment plusieurs contextes se combinent-ils sur une même propriété ? *(une seule bonne réponse)*

- [ ] **A.** Non, `#[Context]` ne peut jamais être combiné avec `#[Groups]`
- [ ] **B.** Oui, mais un seul `#[Context]` est autorisé par propriété, quel que soit le nombre de groupes
- [ ] **C.** Oui, mais les contextes de groupe sont toujours appliqués avant le contexte sans groupe
- [ ] **D.** Oui, via le paramètre `groups` de l'attribut ; le contexte sans groupe s'applique toujours en premier, puis les contextes des groupes correspondants sont fusionnés dans l'ordre fourni

### Question 19

Si le même réglage de contexte doit s'appliquer à toutes les propriétés d'une classe, comment éviter de répéter l'attribut `#[Context]` sur chacune d'elles ? *(une seule bonne réponse)*

- [ ] **A.** En créant un trait PHP contenant la configuration de contexte
- [ ] **B.** Via une méthode statique `getDefaultContext()` sur la classe
- [ ] **C.** En posant l'attribut `#[Context]` directement sur la classe
- [ ] **D.** Ce n'est pas possible, il faut toujours répéter l'attribut propriété par propriété

## Sérialiser du JSON en flux (streams)

### Question 20

Sur quel composant Symfony le Serializer s'appuie-t-il pour encoder/décoder du JSON en flux (streaming), sans charger tout le contenu en mémoire ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Process, en déléguant à un outil externe
- [ ] **B.** Le composant **JsonStreamer**
- [ ] **C.** Le composant HttpFoundation, via `StreamedResponse` uniquement
- [ ] **D.** Le composant Serializer lui-même, sans dépendance supplémentaire

### Question 21

D'après la documentation, quand privilégier le composant Serializer plutôt que JsonStreamer ? *(une seule bonne réponse)*

- [ ] **A.** Les deux composants sont strictement interchangeables, sans critère de choix particulier
- [ ] **B.** Quand on a besoin de flexibilité (manipulation dynamique d'objets via des normaliseurs/dénormaliseurs, objets complexes, formats multiples au-delà de JSON)
- [ ] **C.** Uniquement pour des jeux de données JSON très volumineux
- [ ] **D.** Uniquement quand la performance et la faible consommation mémoire priment sur tout le reste

## Sérialiser vers ou depuis des tableaux PHP

### Question 22

Comment n'effectuer qu'une seule étape du processus de (dé)sérialisation, par exemple juste la conversion objet ↔ tableau sans passer par un format externe ? *(une seule bonne réponse)*

- [ ] **A.** En passant `null` comme format à `serialize()`
- [ ] **B.** En utilisant les méthodes `normalize()`/`denormalize()` du serializer, via `NormalizerInterface`/`DenormalizerInterface`
- [ ] **C.** Ce n'est pas possible, `serialize()`/`deserialize()` exécutent toujours les deux étapes ensemble
- [ ] **D.** En appelant `encode()`/`decode()`, qui font la conversion objet ↔ tableau

### Question 23

Que font respectivement `encode()` et `decode()` du serializer ? *(une seule bonne réponse)*

- [ ] **A.** `encode()` ne fonctionne qu'avec le format JSON, `decode()` avec tous les formats
- [ ] **B.** `encode()` transforme un tableau PHP vers un format donné ; `decode()` transforme ce format en tableau PHP (pas en objets)
- [ ] **C.** `encode()` transforme un objet en tableau ; `decode()` fait l'inverse
- [ ] **D.** Les deux méthodes sont des alias de `serialize()`/`deserialize()`, sans différence

## Ignorer des propriétés

### Question 24

Comment exclure définitivement une propriété ou méthode de toute sérialisation/désérialisation ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'attribut `#[Groups([])]`, un tableau vide excluant la propriété
- [ ] **B.** Avec l'attribut `#[Ignore]`
- [ ] **C.** Avec l'attribut `#[Exclude]`
- [ ] **D.** En la rendant `private` sans getter, ce qui suffit à l'exclure automatiquement

### Question 25

Comment exclure des attributs uniquement pour un appel précis, sans les exclure définitivement de la classe ? *(une seule bonne réponse)*

- [ ] **A.** En les marquant `#[Ignore]` puis en retirant cet attribut après l'appel
- [ ] **B.** Ce n'est pas possible, `#[Ignore]` étant la seule méthode d'exclusion
- [ ] **C.** Via l'option `excluded_attributes`, un alias historique d'`ignored_attributes`
- [ ] **D.** Via l'option de contexte `ignored_attributes` (constante `AbstractNormalizer::IGNORED_ATTRIBUTES`)

### Question 26

Que recommande la documentation si l'on a besoin d'exclure fréquemment des propriétés différentes selon le contexte d'utilisation ? *(une seule bonne réponse)*

- [ ] **A.** Créer une classe DTO distincte pour chaque cas d'usage
- [ ] **B.** Toujours utiliser `#[Ignore]`, qui reste la solution la plus simple dans tous les cas
- [ ] **C.** Désactiver entièrement l'`ObjectNormalizer` au profit d'un normaliseur personnalisé
- [ ] **D.** Utiliser les groupes de sérialisation plutôt que `ignored_attributes`, cette dernière approche devenant vite difficile à maintenir si utilisée excessivement

## Sélectionner des propriétés spécifiques (groupes)

### Question 27

Comment associer une propriété à un ou plusieurs groupes de sérialisation ? *(une seule bonne réponse)*

- [ ] **A.** Via une interface `GroupedPropertyInterface` à implémenter sur la classe
- [ ] **B.** Avec l'attribut `#[Groups(['admin-view'])]`
- [ ] **C.** Avec l'attribut `#[Context(['groups' => 'admin-view'])]`
- [ ] **D.** En préfixant le nom de la propriété par le nom du groupe

### Question 28

Comment sérialiser un objet en incluant *toutes* ses propriétés, y compris celles sans aucun groupe défini ? *(une seule bonne réponse)*

- [ ] **A.** En omettant totalement l'option `groups`, ce qui inclut toujours tout par défaut
- [ ] **B.** En passant un tableau vide `[]` à l'option `groups`
- [ ] **C.** Ce n'est pas possible, une propriété sans groupe ne peut jamais être sérialisée si `groups` est utilisé
- [ ] **D.** En passant la valeur spéciale `'*'` à l'option `groups` du contexte

### Question 29

Comment sélectionner des propriétés précises (y compris des sous-propriétés d'un objet imbriqué) directement via le contexte, sans définir de groupes ? *(une seule bonne réponse)*

- [ ] **A.** En créant un DTO intermédiaire ne portant que les propriétés voulues
- [ ] **B.** Via l'option de contexte `attributes` (constante `AbstractNormalizer::ATTRIBUTES`), par exemple `['name', 'company' => ['name']]`
- [ ] **C.** Ce n'est pas possible sans passer par des groupes de sérialisation
- [ ] **D.** Via l'option `select`, propre à chaque normaliseur

### Question 30

L'option de contexte `attributes` peut-elle sélectionner une propriété marquée `#[Ignore]`, ou exclue par les groupes actifs ? *(une seule bonne réponse)*

- [ ] **A.** Oui, `attributes` prévaut toujours sur `#[Ignore]` et sur les groupes
- [ ] **B.** Oui, mais uniquement si aucun groupe n'est configuré sur la classe
- [ ] **C.** Non, `attributes` ne peut jamais être combiné à `#[Ignore]`, une exception étant levée
- [ ] **D.** Non, seuls les attributs non ignorés et autorisés par les groupes actifs (le cas échéant) sont disponibles via `attributes`

## Gérer les tableaux

### Question 31

Comment désérialiser une chaîne JSON représentant une liste d'objets `Person` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `deserializeArray()` plutôt que `deserialize()`
- [ ] **B.** Ce n'est pas supporté nativement, il faut boucler manuellement sur chaque élément du tableau JSON
- [ ] **C.** En passant `'array'` comme troisième argument à la place du format
- [ ] **D.** En ajoutant `[]` au nom de la classe cible, par exemple `Person::class.'[]'`

### Question 32

Pour qu'une propriété contenant un tableau d'objets imbriqués (ex. `Person[] $members`) soit correctement désérialisée, que faut-il faire ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, le type est toujours déduit automatiquement sans annotation
- [ ] **B.** Créer une méthode `getMembersType(): string` dédiée sur la classe
- [ ] **C.** Utiliser obligatoirement un tableau associatif plutôt qu'une liste indexée
- [ ] **D.** Ajouter un type PHPDoc adapté sur la propriété, le constructeur ou le setter (ex. `@param Person[] $members`)

### Question 33

En plus des annotations PHPDoc classiques (`Person[]`), quels types de tableaux utilisés pour l'analyse statique le Serializer supporte-t-il, et quels paquets sont nécessaires ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les types natifs PHP `array`, sans aucune notation générique supportée
- [ ] **B.** `Collection<Person>` uniquement, avec Doctrine Collections comme dépendance obligatoire
- [ ] **C.** Aucun type générique n'est supporté, seule la notation `Person[]` fonctionne
- [ ] **D.** `list<Person>` et `array<Person>`, à condition d'avoir `phpstan/phpdoc-parser` et `phpdocumentor/reflection-docblock` installés

## Désérialiser des structures imbriquées

### Question 34

Comment mapper une propriété PHP vers un chemin imbriqué dans les données sérialisées, par exemple `[profile][username]` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, la structure sérialisée doit toujours être plate
- [ ] **B.** En créant un normaliseur personnalisé, seule solution pour ce besoin
- [ ] **C.** Avec l'attribut `#[SerializedPath]`, en utilisant une syntaxe PropertyAccess valide
- [ ] **D.** Avec l'attribut `#[NestedPath]`

### Question 35

Peut-on combiner `#[SerializedPath]` et `#[SerializedName]` sur la même propriété ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais `SerializedName` est alors toujours ignoré silencieusement
- [ ] **B.** Non, la documentation l'interdit explicitement
- [ ] **C.** Oui, sans restriction particulière
- [ ] **D.** Oui, mais uniquement en XML, pas via les attributs PHP

## Convertir les noms de propriétés

### Question 36

Quel name converter le service `serializer` utilise-t-il par défaut, et quel attribut permet de renommer un attribut sérialisé ? *(une seule bonne réponse)*

- [ ] **A.** Aucun name converter n'est actif par défaut
- [ ] **B.** `PropertyInfoNameConverter`, combiné à l'attribut `#[Alias]`
- [ ] **C.** `MetadataAwareNameConverter`, combiné à l'attribut `#[SerializedName]`
- [ ] **D.** `CamelCaseToSnakeCaseNameConverter`, activé par défaut sans configuration

### Question 37

Quel service intégré permet de convertir automatiquement les propriétés camelCase en snake_case lors de la (dé)sérialisation ? *(une seule bonne réponse)*

- [ ] **A.** `serializer.name_converter.snake_case_to_camel_case`
- [ ] **B.** `serializer.name_converter.metadata_aware`
- [ ] **C.** Il n'existe pas de convertisseur intégré pour ce sens, il faut toujours en écrire un
- [ ] **D.** `serializer.name_converter.camel_case_to_snake_case`

### Question 38

Quel service intégré permet la conversion inverse, de snake_case vers CamelCase ? *(une seule bonne réponse)*

- [ ] **A.** `serializer.name_converter.underscore`
- [ ] **B.** Il n'existe pas de convertisseur intégré pour ce sens
- [ ] **C.** `serializer.name_converter.snake_case_to_camel_case`
- [ ] **D.** `serializer.name_converter.camel_case_to_snake_case`

## Les normaliseurs intégrés

### Question 39

À quoi sert l'`UnwrappingDenormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** À empêcher toute référence circulaire
- [ ] **B.** À ne dénormaliser qu'une partie de l'entrée
- [ ] **C.** À convertir des exceptions selon la spec API Problem RFC 7807
- [ ] **D.** À normaliser des objets `Uuid`/`Ulid`

### Question 40

Que fait le `ProblemNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne qu'avec les erreurs de formulaire
- [ ] **B.** Il normalise les `FlattenException` selon la spec API Problem (RFC 7807)
- [ ] **C.** Il normalise les objets `DateTimeInterface`
- [ ] **D.** Il normalise les violations de contraintes de validation

### Question 41

Quels sont les formats de normalisation par défaut pour les objets `Uuid` et `Ulid` via l'`UidNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Base 58 pour les deux
- [ ] **B.** Format RFC 4122 pour les deux
- [ ] **C.** Base 32 pour `Uuid`, RFC 4122 pour `Ulid`
- [ ] **D.** Format RFC 4122 pour `Uuid`, Base 32 pour `Ulid`

### Question 42

Le format d'un `Uuid`/`Ulid` importe-t-il lors de la **dénormalisation** d'une chaîne vers ces objets ? *(une seule bonne réponse)*

- [ ] **A.** Oui, il faut préciser le format exact via le contexte, sinon une exception est levée
- [ ] **B.** La dénormalisation de chaînes en `Uuid`/`Ulid` n'est pas supportée par ce normaliseur
- [ ] **C.** Non, l'`UidNormalizer` peut dénormaliser une chaîne `uuid`/`ulid` quel que soit son format
- [ ] **D.** Oui, seul le format RFC 4122 est accepté en entrée

### Question 43

Dans quel format le `DateTimeNormalizer` convertit-il par défaut les objets `DateTime`/`DateTimeImmutable`, et quelle option de contexte force l'utilisation du fuseau horaire du contexte ? *(une seule bonne réponse)*

- [ ] **A.** Le format RFC 3339 par défaut ; `DateTimeNormalizer::TIMEZONE_KEY` force systématiquement le fuseau, sans distinction avec le format d'entrée
- [ ] **B.** Le format ISO 8601 étendu ; le fuseau horaire n'est jamais configurable
- [ ] **C.** Le format RFC 3339 par défaut ; `DateTimeNormalizer::FORCE_TIMEZONE_KEY` à `true` force le fuseau du contexte en ignorant celui de l'entrée
- [ ] **D.** Le format `Y-m-d` par défaut ; aucune option ne permet de forcer un fuseau horaire

### Question 44

Comment convertir un `DateTimeInterface` en entier ou en flottant plutôt qu'en chaîne, via le `DateTimeNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seule une conversion en chaîne est supportée
- [ ] **B.** En utilisant le `NumberNormalizer` à la place, dédié à ce cas
- [ ] **C.** En définissant l'option de contexte `DateTimeNormalizer::CAST_KEY` à `int` ou `float`
- [ ] **D.** En définissant `DateTimeNormalizer::FORMAT_KEY` à `'timestamp'`

### Question 45

Que normalise le `ConstraintViolationListNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Les identifiants uniques (`Uuid`/`Ulid`)
- [ ] **B.** Les objets implémentant `ConstraintViolationListInterface`, en une liste d'erreurs selon la RFC 7807
- [ ] **C.** Les objets `FormInterface`
- [ ] **D.** Les fuseaux horaires (`DateTimeZone`)

### Question 46

Quel normaliseur gère la conversion entre objets `DateTimeZone` et chaînes représentant un fuseau horaire ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de normaliseur dédié, `DateTimeZone` n'étant pas nativement supporté
- [ ] **B.** Le `DateTimeZoneNormalizer`
- [ ] **C.** Le `DateTimeNormalizer`, qui gère aussi les fuseaux horaires
- [ ] **D.** Le `DateIntervalNormalizer`

### Question 47

Quel format `DateIntervalNormalizer` utilise-t-il par défaut pour convertir un `DateInterval` en chaîne ? *(une seule bonne réponse)*

- [ ] **A.** Un simple nombre de secondes
- [ ] **B.** `%y-%m-%d %h:%i:%s`
- [ ] **C.** `P%yY%mM%dDT%hH%iM%sS`
- [ ] **D.** Le format ISO 8601 standard, sans possibilité de le changer

### Question 48

Sur quel type d'objet travaille le `FormErrorNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les erreurs de validation, pas les erreurs de formulaire à proprement parler
- [ ] **B.** Les objets implémentant `FormInterface`, dont il normalise les erreurs selon la RFC 7807
- [ ] **C.** Les objets `ConstraintViolationListInterface`
- [ ] **D.** N'importe quel objet contenant une propriété `$errors`

### Question 49

À quoi sert le `TranslatableNormalizer`, et comment définir la locale utilisée ? *(une seule bonne réponse)*

- [ ] **A.** La locale est toujours déduite de la requête HTTP courante, sans option de contexte dédiée
- [ ] **B.** Il convertit les objets implémentant `TranslatableInterface` en chaîne traduite via le traducteur ; la locale se définit via l'option `TranslatableNormalizer::NORMALIZATION_LOCALE_KEY`
- [ ] **C.** Il traduit automatiquement tous les messages d'erreur du serializer, sans lien avec un type d'objet particulier
- [ ] **D.** Il ne fonctionne qu'en combinaison avec le `FormErrorNormalizer`

### Question 50

Que se passe-t-il par défaut si le `BackedEnumNormalizer` reçoit une valeur qui ne correspond à aucun cas de l'énumération lors de la dénormalisation ? *(une seule bonne réponse)*

- [ ] **A.** Le premier cas de l'énumération est utilisé par défaut
- [ ] **B.** Une valeur `false` est retournée
- [ ] **C.** Une exception est levée, sauf si l'option `BackedEnumNormalizer::ALLOW_INVALID_VALUES` est activée (retourne alors `null`)
- [ ] **D.** La valeur `null` est toujours retournée silencieusement, sans option pour changer ce comportement

### Question 51

Quel normaliseur gère la conversion entre objets `BcMath\Number`/`GMP` et chaînes ou entiers ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de normaliseur dédié à ce type
- [ ] **B.** Le `NumberNormalizer`
- [ ] **C.** Le `DataUriNormalizer`
- [ ] **D.** L'`UidNormalizer`, qui gère aussi les grands nombres

### Question 52

À quoi sert le `DataUriNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** À sérialiser des flux de données JSON volumineux
- [ ] **B.** À convertir des chemins de fichiers relatifs en chemins absolus
- [ ] **C.** À convertir des objets `SplFileInfo` en chaîne `data:...` afin d'embarquer des fichiers dans les données sérialisées
- [ ] **D.** À convertir des URLs en objets `Uri`

### Question 53

Sur quelles classes travaille le `JsonSerializableNormalizer`, et quel avantage a-t-il par rapport à `json_encode()` seul ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les classes qui implémentent aussi `NormalizableInterface`
- [ ] **B.** Il fonctionne à l'identique de `json_encode()`, sans aucun avantage particulier
- [ ] **C.** Les classes implémentant `JsonSerializable` ; contrairement à `json_encode()`, il peut gérer les références circulaires
- [ ] **D.** Toutes les classes, sans restriction, en remplacement systématique de `json_encode()`

### Question 54

Que fait l'`ArrayDenormalizer`, et de quel composant a-t-il besoin pour interpréter des annotations comme `@var Person[]` ? *(une seule bonne réponse)*

- [ ] **A.** Il convertit un objet en tableau associatif simple, sans lien avec les annotations de type
- [ ] **B.** Il ne fonctionne qu'avec des tableaux associatifs, jamais avec des listes d'objets
- [ ] **C.** Il remplace entièrement l'`ObjectNormalizer` pour tout type de tableau
- [ ] **D.** Il convertit un tableau de tableaux en tableau d'objets typés ; il s'appuie sur `PropertyInfoExtractor` pour lire ces indices de type

### Question 55

Comment l'`ObjectNormalizer` génère-t-il les noms d'attributs à partir des méthodes de la classe, par exemple `getFirstName()` ? *(une seule bonne réponse)*

- [ ] **A.** En ne retirant que le préfixe `get`, les autres préfixes n'étant pas reconnus
- [ ] **B.** En utilisant le nom du paramètre du constructeur uniquement, jamais celui des méthodes
- [ ] **C.** En retirant le préfixe (`get`, `set`, `has`, `is`, `can`, `add` ou `remove`) et en mettant en minuscule la première lettre restante (ex. `getFirstName()` → `firstName`)
- [ ] **D.** En conservant le nom de méthode tel quel, préfixe inclus

### Question 56

Que met en garde l'avertissement (« danger ») de la documentation à propos du `DateTimeNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne qu'avec le format JSON, jamais avec XML ou CSV
- [ ] **B.** Il faut toujours s'assurer qu'il est enregistré pour sérialiser `DateTime`/`DateTimeImmutable`, sous peine de consommation mémoire excessive et d'exposition de détails internes
- [ ] **C.** Il ne doit jamais être utilisé en environnement de production
- [ ] **D.** Il entre en conflit systématique avec le `DateTimeZoneNormalizer`

## Normaliseurs supplémentaires (à enregistrer manuellement)

### Question 57

Que doit implémenter un objet pour pouvoir être normalisé/dénormalisé par le `CustomNormalizer` ? *(une seule bonne réponse)*

- [ ] **A.** `JsonSerializable` uniquement
- [ ] **B.** `Stringable`
- [ ] **C.** Aucune interface particulière, `CustomNormalizer` fonctionnant sur n'importe quel objet
- [ ] **D.** `NormalizableInterface` et/ou `DenormalizableInterface`

### Question 58

Comment le `GetSetMethodNormalizer` lit-il et écrit-il les données d'un objet ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne qu'en lecture, jamais en désérialisation
- [ ] **B.** Il utilise exclusivement le constructeur, sans jamais appeler de setters
- [ ] **C.** En appelant les « getters » (`get`, `has`, `is`, `can`) en lecture, et le constructeur ainsi que les « setters » en écriture
- [ ] **D.** Il accède directement aux propriétés privées via réflexion, sans passer par les méthodes

### Question 59

Quelle est la particularité du `PropertyNormalizer` par rapport à l'`ObjectNormalizer`, et comment restreindre les propriétés traitées selon leur visibilité ? *(une seule bonne réponse)*

- [ ] **A.** Il ne peut lire que les propriétés publiques, comme l'`ObjectNormalizer`
- [ ] **B.** Il ne fonctionne que sur les propriétés `readonly`
- [ ] **C.** Il n'existe aucune option pour restreindre par visibilité, toutes les propriétés étant toujours traitées
- [ ] **D.** Il lit/écrit directement les propriétés publiques, privées et protégées via réflexion ; l'option `PropertyNormalizer::NORMALIZE_VISIBILITY` permet de restreindre à certaines visibilités (combinaison de `NORMALIZE_PUBLIC`, `NORMALIZE_PROTECTED`, `NORMALIZE_PRIVATE`)

## Serializers nommés

### Question 60

À quoi servent les « named serializers » (`named_serializers`) ? *(une seule bonne réponse)*

- [ ] **A.** À restreindre l'accès au service serializer selon les rôles de sécurité
- [ ] **B.** À configurer plusieurs instances de serializer avec des réglages différents (contexte par défaut, name converter, normaliseurs/encodeurs), par exemple pour communiquer avec plusieurs API ayant chacune ses propres règles
- [ ] **C.** À nommer explicitement chaque appel à `serialize()` pour faciliter le débogage
- [ ] **D.** À définir un alias unique pour le service `serializer` par défaut, sans permettre plusieurs configurations

### Question 61

Comment injecter une instance spécifique d'un serializer nommé, par exemple `api_client2`, plutôt que le serializer par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible d'injecter un serializer nommé autrement que le service par défaut
- [ ] **B.** Via une méthode statique `Serializer::named('api_client2')`
- [ ] **C.** Via l'attribut `#[Target('apiClient2.serializer')]` sur le paramètre `SerializerInterface`
- [ ] **D.** En renommant le paramètre du constructeur en `$apiClient2`, sans attribut particulier

### Question 62

Comment ajouter un normaliseur personnalisé uniquement à un (ou plusieurs) serializer(s) nommé(s), sans l'ajouter au serializer par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `only_for` du tag `serializer.normalizer`
- [ ] **B.** En ajoutant un attribut `serializer` au tag `serializer.normalizer`, par exemple `{ serializer: 'api_client1' }` ou une liste de noms
- [ ] **C.** Ce n'est pas possible, tout normaliseur tagué `serializer.normalizer` s'applique automatiquement à tous les serializers, nommés ou non
- [ ] **D.** En créant une classe de normaliseur distincte par serializer nommé, sans mécanisme de tag partagé

### Question 63

Si l'attribut `serializer` d'un tag `serializer.normalizer`/`serializer.encoder` n'est pas défini, à quel(s) serializer(s) le service est-il rattaché ? *(une seule bonne réponse)*

- [ ] **A.** À tous les serializers nommés, mais pas au serializer par défaut
- [ ] **B.** À tous les serializers, y compris tous les nommés et le défaut
- [ ] **C.** À aucun serializer tant que l'attribut n'est pas explicitement renseigné
- [ ] **D.** Uniquement au serializer par défaut

### Question 64

Comment exclure les normaliseurs/encodeurs intégrés par défaut d'un serializer nommé, pour ne conserver que ceux explicitement enregistrés pour lui ? *(une seule bonne réponse)*

- [ ] **A.** En taguant chaque normaliseur par défaut avec `exclude: true`
- [ ] **B.** En supprimant le service `serializer` du container, ce qui affecte aussi les serializers nommés
- [ ] **C.** En mettant `include_built_in_normalizers`/`include_built_in_encoders` à `false` pour ce serializer nommé
- [ ] **D.** Ce n'est pas configurable, un serializer nommé hérite toujours de tous les normaliseurs/encodeurs par défaut

### Question 65

Comment inspecter les priorités des normaliseurs/encodeurs enregistrés pour un serializer nommé donné ? *(une seule bonne réponse)*

- [ ] **A.** Via `php bin/console debug:serializer --named=<name>`
- [ ] **B.** Il n'existe aucun moyen d'inspecter cela, seule la lecture du code source le permet
- [ ] **C.** Via `php bin/console debug:autowiring <name>`
- [ ] **D.** Via `php bin/console debug:container --tag serializer.<normalizer|encoder>.<name>`

## Déboguer le serializer

### Question 66

Quelle commande affiche les métadonnées de sérialisation (groupes, maxDepth, serializedName…) d'une classe donnée ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console serializer:debug 'App\Entity\Book'`
- [ ] **B.** `php bin/console debug:container 'App\Entity\Book'`
- [ ] **C.** `php bin/console debug:mapping serializer 'App\Entity\Book'`
- [ ] **D.** `php bin/console debug:serializer 'App\Entity\Book'`

## Sérialisation avancée

### Question 67

Comment ignorer les propriétés ayant une valeur `null` plutôt que de les conserver, sachant que le Serializer les préserve par défaut ? *(une seule bonne réponse)*

- [ ] **A.** C'est le comportement par défaut, aucune option n'est nécessaire
- [ ] **B.** En définissant `AbstractNormalizer::IGNORED_ATTRIBUTES` à `['null']`
- [ ] **C.** En définissant l'option de contexte `AbstractObjectNormalizer::SKIP_NULL_VALUES` à `true`
- [ ] **D.** En marquant chaque propriété nullable avec `#[Ignore]`

### Question 68

Que produit la sérialisation d'un `\ArrayObject()` vide lorsque `AbstractObjectNormalizer::PRESERVE_EMPTY_OBJECTS` est activé, plutôt que le tableau vide habituel ? *(une seule bonne réponse)*

- [ ] **A.** `[]`, comme sans cette option
- [ ] **B.** `null`
- [ ] **C.** Une exception, `PRESERVE_EMPTY_OBJECTS` ne s'appliquant pas aux `ArrayObject`
- [ ] **D.** `{}`

### Question 69

Que fait l'`ObjectNormalizer` par défaut face à une propriété typée non initialisée, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** Il l'ignore toujours, cette option n'existant que pour les propriétés `readonly`
- [ ] **B.** Il capture l'erreur et ignore la propriété ; mettre `AbstractObjectNormalizer::SKIP_UNINITIALIZED_VALUES` à `false` fait au contraire lever une `UninitializedPropertyException`
- [ ] **C.** Il lève systématiquement une exception fatale, sans option pour l'éviter
- [ ] **D.** Il retourne `null` pour cette propriété, comme pour une propriété non typée

### Question 70

Avec `PropertyNormalizer` ou `GetSetMethodNormalizer`, que se passe-t-il si `SKIP_UNINITIALIZED_VALUES` est mis à `false` face à une propriété non initialisée ? *(une seule bonne réponse)*

- [ ] **A.** Le comportement est strictement identique à celui de l'`ObjectNormalizer`
- [ ] **B.** La propriété est silencieusement ignorée, quelle que soit la valeur de l'option
- [ ] **C.** Une valeur par défaut est déduite automatiquement du type déclaré
- [ ] **D.** Une instance de `\Error` est levée, ces normaliseurs ne pouvant pas lire une propriété non initialisée

### Question 71

Que se passe-t-il par défaut lorsque le Serializer rencontre une référence circulaire entre objets associés ? *(une seule bonne réponse)*

- [ ] **A.** Le Serializer bascule automatiquement sur `JsonSerializableNormalizer`, seul capable de gérer ce cas
- [ ] **B.** Une `CircularReferenceException` est levée
- [ ] **C.** La boucle est parcourue indéfiniment jusqu'à épuisement de la mémoire
- [ ] **D.** La propriété provoquant la référence circulaire est silencieusement mise à `null`

### Question 72

Que définit l'option de contexte `circular_reference_limit`, et quelle est sa valeur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Le délai en secondes avant qu'une exception ne soit levée ; par défaut `1`
- [ ] **B.** Le nombre de fois qu'un même objet peut être sérialisé avant d'être considéré comme une référence circulaire ; la valeur par défaut est `1`
- [ ] **C.** Le nombre maximal d'objets différents pouvant être sérialisés au total ; par défaut `100`
- [ ] **D.** La profondeur maximale de l'arbre d'objets, tous types confondus ; par défaut `10`

### Question 73

Comment gérer une référence circulaire autrement qu'en levant une exception, par exemple pour ne sérialiser qu'un identifiant de l'objet déjà rencontré ? *(une seule bonne réponse)*

- [ ] **A.** En augmentant `circular_reference_limit` à une valeur suffisamment grande pour ne jamais l'atteindre
- [ ] **B.** Ce n'est pas configurable, seule l'exception est disponible
- [ ] **C.** En implémentant `CircularReferenceAwareInterface` sur la classe concernée
- [ ] **D.** En fournissant un callable via l'option de contexte `AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER`

### Question 74

Comment limiter la profondeur de sérialisation d'une structure arborescente (ex. un arbre généalogique), et quelle option de contexte faut-il activer pour que cette limite soit effectivement appliquée ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable nativement, il faut un normaliseur personnalisé
- [ ] **B.** Avec l'attribut `#[MaxDepth(n)]` sur la propriété, combiné à l'option de contexte `AbstractObjectNormalizer::ENABLE_MAX_DEPTH` mise à `true`
- [ ] **C.** Avec `#[MaxDepth(n)]` seul, qui suffit à activer la limite sans configuration de contexte supplémentaire
- [ ] **D.** Uniquement via l'option de contexte `max_depth`, sans attribut sur la propriété

### Question 75

Comment personnaliser ce qui est renvoyé lorsque la profondeur maximale est atteinte, plutôt que d'omettre simplement la propriété ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, la propriété est toujours omise une fois la profondeur atteinte
- [ ] **B.** Via l'option `circular_reference_limit`, partagée avec la gestion des références circulaires
- [ ] **C.** En fournissant un callable via l'option de contexte `AbstractObjectNormalizer::MAX_DEPTH_HANDLER`
- [ ] **D.** En augmentant simplement la valeur de `#[MaxDepth]`

### Question 76

Comment formater une propriété précise (ex. `createdAt`) avec une logique personnalisée au moment de la sérialisation, sans créer de normaliseur dédié ? *(une seule bonne réponse)*

- [ ] **A.** En surchargeant la méthode `getCreatedAt()` de la classe
- [ ] **B.** Via l'option de contexte `AbstractNormalizer::CALLBACKS`, associant un nom de propriété à un callable
- [ ] **C.** Ce n'est possible qu'en créant un normaliseur personnalisé complet
- [ ] **D.** Via l'attribut `#[Callback]` sur la propriété concernée

## Désérialisation avancée

### Question 77

Par défaut, que fait le Serializer si un paramètre nullable du constructeur n'est pas fourni dans les données désérialisées, et comment forcer une erreur dans ce cas ? *(une seule bonne réponse)*

- [ ] **A.** Il utilise systématiquement la valeur `0` ou une chaîne vide selon le type
- [ ] **B.** Il assigne `null` à ce paramètre ; l'option `AbstractNormalizer::REQUIRE_ALL_PROPERTIES` à `true` fait lever une `MissingConstructorArgumentException` à la place
- [ ] **C.** Il lève toujours une exception, qu'il soit nullable ou non
- [ ] **D.** Il ignore silencieusement toute la désérialisation

### Question 78

Comment collecter *toutes* les erreurs de type lors d'une désérialisation, plutôt que d'échouer à la première erreur rencontrée ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `deserialize()` une fois par propriété séparément
- [ ] **B.** Avec l'option `DenormalizerInterface::COLLECT_DENORMALIZATION_ERRORS`, qui fait lever une `PartialDenormalizationException` contenant toutes les erreurs et l'objet partiellement dénormalisé
- [ ] **C.** Ce n'est pas possible, la première erreur de type interrompt toujours immédiatement le processus sans recours
- [ ] **D.** En désactivant complètement l'enforcement de type via `DISABLE_TYPE_ENFORCEMENT`

### Question 79

Comment mettre à jour un objet existant plutôt que d'en créer un nouveau lors de la désérialisation, et quelle limite s'applique à cette option pour les objets imbriqués ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `deserialize()` crée toujours un nouvel objet
- [ ] **B.** Via un second appel à `serializer->update($object, $data)`, une méthode dédiée
- [ ] **C.** Via l'option `AbstractNormalizer::OBJECT_TO_POPULATE` ; elle ne s'applique qu'à l'objet racine, les enfants étant recréés en nouvelles instances sauf si `DEEP_OBJECT_TO_POPULATE` est activé (et seulement pour les objets enfants uniques, pas les tableaux d'objets)
- [ ] **D.** Via `OBJECT_TO_POPULATE`, qui s'applique automatiquement en profondeur à tous les objets imbriqués, sans option supplémentaire

### Question 80

Comment le Serializer sait-il quelle classe concrète instancier lors de la désérialisation d'une propriété typée avec une interface ou une classe abstraite ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seules les classes concrètes peuvent être désérialisées
- [ ] **B.** Via un simple commentaire PHPDoc `@concrete-class`, sans attribut dédié
- [ ] **C.** Grâce à un « discriminator class mapping », défini via l'attribut `#[DiscriminatorMap]` sur l'interface, associant un nom de type à une classe concrète
- [ ] **D.** Le Serializer choisit toujours arbitrairement la première classe implémentant l'interface trouvée dans l'application

### Question 81

À quoi sert l'option `defaultType` de `#[DiscriminatorMap]` ? *(une seule bonne réponse)*

- [ ] **A.** À rendre le `type_property` optionnel dans la classe cible elle-même
- [ ] **B.** Elle n'existe pas, un type doit toujours être explicitement présent dans les données
- [ ] **C.** À définir la classe concrète utilisée quand l'attribut discriminant est absent des données désérialisées
- [ ] **D.** À définir la classe utilisée uniquement pour la sérialisation, jamais la désérialisation

### Question 82

Comment ne désérialiser qu'une sous-partie précise d'une réponse JSON complète, sans avoir à traiter toute la structure ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le Serializer désérialise toujours l'intégralité de la chaîne d'entrée
- [ ] **B.** En appelant `decode()` puis en filtrant manuellement le tableau PHP obtenu avant de le repasser à `denormalize()`
- [ ] **C.** Via l'option `partial_deserialization`, qui accepte directement un chemin JSONPath
- [ ] **D.** Avec l'`UnwrappingDenormalizer` et l'option `UnwrappingDenormalizer::UNWRAP_PATH`, un chemin PropertyAccess appliqué au tableau dénormalisé

### Question 83

Si des paramètres du constructeur sont manquants dans les données désérialisées et qu'une exception serait normalement levée, comment fournir des valeurs par défaut pour ces paramètres ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `object_to_populate`, réutilisée à cet effet
- [ ] **B.** Ce n'est pas configurable, il faut toujours fournir tous les arguments du constructeur
- [ ] **C.** Via l'option de contexte `AbstractNormalizer::DEFAULT_CONSTRUCTOR_ARGUMENTS`
- [ ] **D.** En rendant tous les paramètres du constructeur optionnels dans le code PHP, seule solution possible

### Question 84

Comment désactiver la vérification stricte des types lors de la dénormalisation récursive (par exemple accepter une chaîne là où un entier est attendu) ? *(une seule bonne réponse)*

- [ ] **A.** Via `AbstractNormalizer::REQUIRE_ALL_PROPERTIES`, qui contrôle aussi ce comportement
- [ ] **B.** En définissant `ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT` à `true`
- [ ] **C.** Ce n'est jamais possible, le typage est toujours strictement vérifié dès qu'un `PropertyTypeExtractor` est disponible
- [ ] **D.** En supprimant le `PropertyTypeExtractor` du container, ce qui désactive toute vérification de type globalement

### Question 85

Comment convertir automatiquement des valeurs comme `"yes"` ou `"1"` en booléen lors de la désérialisation ? *(une seule bonne réponse)*

- [ ] **A.** Via le `BackedEnumNormalizer`, qui gère aussi les valeurs booléennes
- [ ] **B.** En castant la propriété en `bool` dans le code PHP uniquement, sans option de contexte associée
- [ ] **C.** Avec l'option de contexte `AbstractNormalizer::FILTER_BOOL`, qui se comporte comme `filter_var()` avec `FILTER_VALIDATE_BOOL`
- [ ] **D.** Ce n'est pas possible nativement, il faut convertir la valeur manuellement avant de la passer au Serializer

## Étendre la sérialisation pour une classe

### Question 86

Comment ajouter ou surcharger des métadonnées de sérialisation sur une classe qu'on ne peut pas modifier soi-même (ex. une classe d'une bibliothèque tierce) ? *(une seule bonne réponse)*

- [ ] **A.** En redéfinissant entièrement la classe tierce dans son propre namespace `App\`
- [ ] **B.** En surchargeant le service `serializer.mapping.class_metadata_factory`
- [ ] **C.** En créant une classe séparée (souvent `abstract`) portant l'attribut `#[ExtendsSerializationFor(TargetClass::class)]`, dont les attributs de sérialisation s'appliquent à la classe cible comme s'ils y étaient définis
- [ ] **D.** Ce n'est possible qu'en créant un fichier de mapping YAML/XML, jamais via un attribut PHP

### Question 87

Que se passe-t-il si une classe utilisant `#[ExtendsSerializationFor]` définit des métadonnées pour une propriété qui n'existe pas sur la classe cible ? *(une seule bonne réponse)*

- [ ] **A.** Cela ne provoque une erreur qu'à l'exécution, jamais à la compilation
- [ ] **B.** Une `MappingException` est levée lors de la compilation du container
- [ ] **C.** La métadonnée est silencieusement ignorée
- [ ] **D.** La propriété est automatiquement ajoutée à la classe cible via une trait

### Question 88

Pourquoi les classes utilisant des attributs de sérialisation sont-elles automatiquement découvertes à la compilation lorsque l'autoconfiguration est active, et quel avantage cela procure-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Cela ne concerne que le débogage, sans impact sur les performances
- [ ] **B.** Cela remplace entièrement le cache de métadonnées, qui devient alors inutile
- [ ] **C.** Cela ne fonctionne que pour les classes définies comme services explicites, jamais pour les modèles simples
- [ ] **D.** Cela permet au chargeur d'attributs de ne traiter que les classes réellement concernées par ces attributs, ce qui améliore les performances en production

### Question 89

Comment enregistrer explicitement une classe tierce (non définie comme service) qui utilise des attributs de sérialisation, pour qu'elle soit prise en compte ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible pour une classe qui n'est pas un service
- [ ] **B.** En la taguant uniquement avec `serializer.normalizer`
- [ ] **C.** En la taguant avec `serializer.attribute_metadata` et `container.excluded`
- [ ] **D.** En l'ajoutant manuellement à `config/serializer/` sous forme de mapping YAML dupliquant les attributs

## Configurer le cache des métadonnées

### Question 90

Quel pool de cache le serializer utilise-t-il par défaut pour mettre en cache ses métadonnées ? *(une seule bonne réponse)*

- [ ] **A.** `cache.app`
- [ ] **B.** Aucun cache n'est utilisé par défaut, les métadonnées étant recalculées à chaque requête
- [ ] **C.** `cache.serializer`, un pool dédié créé automatiquement
- [ ] **D.** `cache.system`

## Créer son propre context builder

### Question 91

Dans l'exemple d'un `ZeroDateTimeDenormalizer` qui convertit les dates `0000-00-00` en `null`, quelles interfaces/traits la classe utilise-t-elle pour déléguer le reste de la dénormalisation au dénormaliseur par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `NormalizerAwareInterface` uniquement, car la dénormalisation ne nécessite jamais de déléguer
- [ ] **B.** Aucune, il faut réimplémenter toute la logique de dénormalisation par défaut soi-même
- [ ] **C.** `SerializerAwareInterface`, qui donne accès à l'ensemble du service `serializer`
- [ ] **D.** `DenormalizerAwareInterface` et `DenormalizerAwareTrait`, donnant accès à une propriété `$this->denormalizer`

### Question 92

Dans ce même exemple, comment `supportsDenormalization()` détermine-t-il s'il doit prendre en charge la donnée ? *(une seule bonne réponse)*

- [ ] **A.** En vérifiant uniquement que la valeur brute vaut exactement `'0000-00-00'`, sans condition sur le contexte
- [ ] **B.** En vérifiant le format de sortie (JSON, XML…) demandé
- [ ] **C.** Ce dénormaliseur personnalisé ne définit jamais `supportsDenormalization()`, une valeur `true` étant supposée par défaut
- [ ] **D.** En vérifiant qu'une clé de contexte personnalisée (ex. `zero_datetime_to_null`) est activée et que le type cible est bien une date

### Question 93

Pourquoi créer un context builder dédié (ex. `LegacyContextBuilder`) plutôt que de continuer à utiliser directement la clé de contexte brute (`zero_datetime_to_null`) ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Symfony l'exige : tout dénormaliseur personnalisé doit obligatoirement avoir un context builder associé
- [ ] **B.** Pour éviter d'avoir à se souvenir du nom exact de cette clé de contexte à chaque utilisation, en l'encapsulant dans une méthode explicite comme `withLegacyDates()`
- [ ] **C.** Parce qu'un tableau de contexte brut ne fonctionne plus du tout dès qu'un dénormaliseur personnalisé est utilisé
- [ ] **D.** Parce que les context builders sont plus rapides à l'exécution que les tableaux de contexte

### Question 94

Quelles interface et trait un context builder personnalisé implémente-t-il typiquement, et quelle méthode interne permet de définir une clé de contexte ? *(une seule bonne réponse)*

- [ ] **A.** `ContextInterface` et `ContextTrait`, avec la méthode `set()`
- [ ] **B.** `NormalizerInterface`, les context builders étant eux-mêmes des normaliseurs
- [ ] **C.** Aucune interface commune n'existe, chaque context builder définissant sa propre structure
- [ ] **D.** `ContextBuilderInterface` et `ContextBuilderTrait`, avec la méthode `with()` pour ajouter une clé

### Question 95

Une fois le context builder construit avec ses méthodes fluides (ex. `->withLegacyDates(true)`), comment l'utiliser concrètement pour un appel à `deserialize()` ? *(une seule bonne réponse)*

- [ ] **A.** En passant directement l'objet builder à `deserialize()`, sans conversion préalable
- [ ] **B.** En appelant `->build()`, qui retourne directement une instance de `Serializer` préconfigurée
- [ ] **C.** Le context builder ne peut être utilisé qu'avec `serialize()`, jamais `deserialize()`
- [ ] **D.** En appelant `->toArray()` sur le builder, et en passant le résultat comme contexte

## Créer son propre name converter

### Question 96

Quelles méthodes une classe doit-elle implémenter pour être un name converter valide (`NameConverterInterface`) ? *(une seule bonne réponse)*

- [ ] **A.** Une seule méthode `convert()`, appelée dans les deux sens
- [ ] **B.** `normalize(string $propertyName, ...)` et `denormalize(string $propertyName, ...)`
- [ ] **C.** `encode()` et `decode()`, les mêmes que pour un encodeur
- [ ] **D.** `toSerialized()` et `fromSerialized()`

### Question 97

Dans l'exemple d'un `OrgPrefixNameConverter` qui préfixe tous les attributs par `org_`, que doit faire la méthode `denormalize()` ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter le préfixe `org_`, comme `normalize()`
- [ ] **B.** Ne rien faire, `denormalize()` n'étant jamais appelée sur un name converter
- [ ] **C.** Lever une exception si le préfixe est absent
- [ ] **D.** Retirer le préfixe `org_` du nom d'attribut reçu, pour retrouver le nom de propriété PHP d'origine

### Question 98

Comment configurer le serializer pour qu'il utilise ce name converter personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** En taguant le service avec `serializer.name_converter`, sans configuration `framework.serializer` nécessaire
- [ ] **B.** Ce n'est configurable qu'en PHP standalone, jamais via `framework.serializer`
- [ ] **C.** En renommant la classe pour qu'elle corresponde à une convention `App\Serializer\NameConverter`
- [ ] **D.** Via `framework.serializer.name_converter`, en y passant l'identifiant du service (ex. le nom de la classe)

## Créer son propre normaliseur

### Question 99

Pour ajouter, modifier ou supprimer des propriétés lors de la normalisation, que recommande la documentation plutôt que de réécrire toute la logique de normalisation ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser exclusivement `json_encode()` puis `json_decode()` pour reconstruire le tableau
- [ ] **B.** Injecter le service `serializer.normalizer.object` (l'`ObjectNormalizer` par défaut) et l'utiliser pour faire le gros du travail, puis modifier le tableau obtenu
- [ ] **C.** Toujours réimplémenter entièrement `normalize()` sans dépendre d'un autre normaliseur
- [ ] **D.** Étendre directement la classe `Serializer` elle-même

### Question 100

Dans l'exemple `TopicNormalizer`, quelles méthodes doit implémenter un normaliseur personnalisé conforme à `NormalizerInterface` ? *(une seule bonne réponse)*

- [ ] **A.** `transform()` et `supports()`
- [ ] **B.** `normalize()`, `supportsNormalization()` et `getSupportedTypes()`
- [ ] **C.** Uniquement `normalize()`, les deux autres étant optionnelles dans tous les cas
- [ ] **D.** `normalize()` et `encode()`

### Question 101

Une fois enregistré comme service, comment un normaliseur personnalisé est-il pris en compte par le serializer si l'autoconfiguration par défaut de `services.yaml` est active ? *(une seule bonne réponse)*

- [ ] **A.** Il faut l'ajouter à un fichier `normalizers.yaml` dédié
- [ ] **B.** Il faut l'enregistrer comme décorateur du service `serializer` par défaut
- [ ] **C.** Automatiquement, sans avoir besoin de le tagger manuellement
- [ ] **D.** Il faut systématiquement le tagger manuellement avec `serializer.normalizer`, l'autoconfiguration ne s'appliquant jamais aux normaliseurs

### Question 102

Sans autoconfiguration, comment enregistrer un normaliseur personnalisé et lui donner une priorité plus haute (appelé plus tôt) que les normaliseurs par défaut ? *(une seule bonne réponse)*

- [ ] **A.** La priorité des normaliseurs n'est pas configurable, seul l'ordre de déclaration dans `services.yaml` compte
- [ ] **B.** En le nommant `PrimaryNormalizer`, seule convention reconnue pour la priorité
- [ ] **C.** En le taguant `serializer.normalizer` avec une option `priority` élevée
- [ ] **D.** En le déclarant `public: true`, ce qui suffit à lui donner la priorité la plus haute

### Question 103

Que permet réellement de mettre en cache la méthode `getSupportedTypes()`, et ce qu'elle ne met **pas** en cache ? *(une seule bonne réponse)*

- [ ] **A.** Elle met en cache uniquement les erreurs de normalisation rencontrées
- [ ] **B.** Elle ne met jamais rien en cache, son seul rôle étant documentaire
- [ ] **C.** Elle met en cache uniquement la *décision* (le normaliseur supporte-t-il ce type ?), pas le résultat de la normalisation/dénormalisation elle-même
- [ ] **D.** Elle met en cache le résultat complet de la normalisation pour chaque objet, évitant tout recalcul

### Question 104

Dans le tableau retourné par `getSupportedTypes()`, que signifient respectivement les clés spéciales `object` et `*` ? *(une seule bonne réponse)*

- [ ] **A.** `object` et `*` sont strictement synonymes, l'un étant un alias de l'autre
- [ ] **B.** `object` signifie que le normaliseur ne supporte que les tableaux ; `*` que seuls les scalaires sont supportés
- [ ] **C.** Ces clés spéciales n'existent pas, seuls des noms de classes concrètes sont acceptés
- [ ] **D.** `object` indique le support de n'importe quelle classe ou interface ; `*` indique le support potentiel de n'importe quel type

### Question 105

Dans `getSupportedTypes()`, que signifie une valeur booléenne associée à un type, et que signifie une valeur `null` ? *(une seule bonne réponse)*

- [ ] **A.** Le booléen indique si le type est un objet (`true`) ou un scalaire (`false`) ; `null` signifie que le support est indéterminé à l'exécution
- [ ] **B.** Le booléen active ou désactive complètement le normaliseur ; `null` équivaut à `true`
- [ ] **C.** Ces valeurs ne servent qu'à la documentation générée, sans effet sur le comportement réel
- [ ] **D.** Le booléen indique si la décision de support pour ce type est mise en cache (`true`) ou non (`false`) ; `null` signifie que ce type n'est pas supporté

### Question 106

Comment déclarer dans `getSupportedTypes()` qu'un normaliseur supporte des valeurs scalaires natives comme les chaînes ou les entiers ? *(une seule bonne réponse)*

- [ ] **A.** En listant `'scalar' => true`, une clé spéciale dédiée aux types natifs
- [ ] **B.** Ce n'est pas possible, `getSupportedTypes()` ne concernant que les objets
- [ ] **C.** En utilisant les noms de types PHP natifs directement, sans le préfixe `native-`
- [ ] **D.** Avec des chaînes `native-<type>` (ex. `native-string`, `native-integer`), basées sur les noms retournés par `gettype()`

### Question 107

Une implémentation de `supports*()` peut-elle supposer que `getSupportedTypes()` a déjà été appelée avant elle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement pour les dénormaliseurs, jamais pour les normaliseurs
- [ ] **B.** Non, elle ne doit jamais faire cette supposition
- [ ] **C.** Oui, `getSupportedTypes()` est toujours appelée en premier par le Serializer
- [ ] **D.** Cela dépend de la présence ou non d'un cache configuré

## Les encodeurs du serializer

### Question 108

Quels sont les quatre encodeurs fournis nativement par le composant Serializer ? *(plusieurs bonnes réponses)*

- [ ] **A.** `JsonEncoder` et `XmlEncoder`
- [ ] **B.** `YamlEncoder` (nécessite le composant Yaml) et `CsvEncoder`
- [ ] **C.** `NeonEncoder`
- [ ] **D.** `PhpArrayEncoder`

### Question 109

Comment passer des options natives de `json_encode()`/`json_decode()` (ex. `JSON_PRESERVE_ZERO_FRACTION`) via le `JsonEncoder` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seules les options par défaut de `json_encode()` sont utilisées
- [ ] **B.** En sous-classant `JsonEncoder` pour chaque combinaison d'options souhaitée
- [ ] **C.** Via une seule clé `json_options` partagée entre encodage et décodage
- [ ] **D.** Via les clés de contexte `json_encode_options` et `json_decode_options`

### Question 110

Par défaut, l'option `json_decode_associative` du `JsonEncoder` retourne-t-elle un tableau associatif ou une hiérarchie de `stdClass` ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend uniquement de la version de PHP utilisée
- [ ] **B.** Toujours un tableau associatif, cette option ne concernant que l'encodage
- [ ] **C.** Une hiérarchie de `stdClass` par défaut (`false`) ; un tableau si mise à `true`
- [ ] **D.** Un tableau associatif par défaut, sans possibilité de revenir à des `stdClass`

### Question 111

Dans le format interne utilisé par le `XmlEncoder`, à quoi correspondent respectivement la clé spéciale `#` et un préfixe `@` sur une clé ? *(une seule bonne réponse)*

- [ ] **A.** `#` et `@` sont strictement équivalents dans la syntaxe du `XmlEncoder`
- [ ] **B.** `#` définit la donnée textuelle d'un nœud ; les clés préfixées par `@` deviennent des attributs XML
- [ ] **C.** `#` définit un attribut XML ; `@` définit le contenu textuel d'un nœud
- [ ] **D.** Les deux ne servent qu'à générer des commentaires XML

### Question 112

Comment le `XmlEncoder` encode-t-il une clé `#comment` ? *(une seule bonne réponse)*

- [ ] **A.** Cette clé n'a aucun effet particulier, elle est traitée comme une clé de donnée normale
- [ ] **B.** En un commentaire XML (`<!-- ... -->`)
- [ ] **C.** En un attribut XML nommé `comment`
- [ ] **D.** En un nœud `<comment>` classique contenant le texte

### Question 113

À quoi sert l'option `as_collection` partagée par plusieurs encodeurs (XML, CSV) ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne concerne que l'encodage, jamais le décodage
- [ ] **B.** À toujours retourner les résultats sous forme de collection, même si une seule ligne/un seul élément est décodé
- [ ] **C.** À forcer l'encodage sous forme de tableau JSON, quel que soit le format cible
- [ ] **D.** À limiter le nombre maximal d'éléments décodés

### Question 114

Que permet l'option `cdata_wrapping` (et `cdata_wrapping_pattern`) du `XmlEncoder` ? *(une seule bonne réponse)*

- [ ] **A.** De convertir automatiquement le XML généré en JSON
- [ ] **B.** De définir l'encodage de caractères du document XML (UTF-8, ISO-8859-1…)
- [ ] **C.** De contrôler si (et selon quel motif) une valeur contenant des caractères comme `<`, `>` ou `&` est enveloppée dans une section `CDATA`
- [ ] **D.** De forcer tous les nœuds XML à être vides, sans contenu texte

### Question 115

Que fait l'option `preserve_numeric_keys` du `XmlEncoder` lorsqu'elle est activée ? *(une seule bonne réponse)*

- [ ] **A.** Elle supprime tous les indices numériques du document généré
- [ ] **B.** Elle n'a d'effet que sur le décodage, jamais sur l'encodage
- [ ] **C.** Elle conserve les indices numériques des tableaux (ex. `<item key="0">`) au lieu de les regrouper en nœuds `<item>` sans distinction
- [ ] **D.** Elle convertit tous les indices numériques en chaînes de caractères

### Question 116

Comment définir l'ordre des colonnes d'un CSV généré par le `CsvEncoder`, indépendamment de l'ordre des clés dans les données d'entrée ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `csv_key_separator`
- [ ] **B.** En triant alphabétiquement les clés, seul comportement possible
- [ ] **C.** Via l'option `csv_headers`, en fournissant explicitement la liste ordonnée des en-têtes
- [ ] **D.** Ce n'est pas configurable, l'ordre des colonnes suit toujours celui des clés du tableau d'entrée

### Question 117

À quoi sert l'option `csv_escape_formulas` du `CsvEncoder` ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne concerne que le décodage, jamais l'encodage
- [ ] **B.** À préfixer d'une tabulation les champs contenant des formules, pour éviter les injections de formule dans les tableurs
- [ ] **C.** À convertir automatiquement les formules Excel en valeurs calculées
- [ ] **D.** À interdire purement et simplement tout champ contenant un signe `=`

### Question 118

De quel composant Symfony le `YamlEncoder` a-t-il besoin, et via quelle option peut-on personnaliser les indicateurs de dump/parse YAML utilisés ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Yaml ; mais aucune option de personnalisation n'est disponible
- [ ] **B.** Le composant Yaml ; via l'option `yaml_flags`, un champ de bits de constantes `Yaml::DUMP_*`/`Yaml::PARSE_*`
- [ ] **C.** Le composant Serializer se suffit à lui-même, aucune dépendance supplémentaire n'étant nécessaire
- [ ] **D.** Le composant Config ; via l'option `yaml_config_flags`

### Question 119

Quelles interfaces un encodeur personnalisé (ex. pour le format NEON) doit-il implémenter ? *(une seule bonne réponse)*

- [ ] **A.** `NormalizerInterface` et `DenormalizerInterface`, les mêmes que pour un normaliseur
- [ ] **B.** Une seule interface `CodecInterface`, combinant encodage et décodage
- [ ] **C.** `SerializerAwareInterface` uniquement
- [ ] **D.** `EncoderInterface` et `DecoderInterface`

### Question 120

Si un encodeur personnalisé a besoin d'accéder au `$context` dans ses méthodes `supportsEncoding()`/`supportsDecoding()`, quelles interfaces supplémentaires doit-il implémenter ? *(une seule bonne réponse)*

- [ ] **A.** Aucune, `$context` est toujours disponible nativement dans `supportsEncoding()`/`supportsDecoding()`
- [ ] **B.** `NormalizerAwareInterface`/`DenormalizerAwareInterface`
- [ ] **C.** Ce n'est jamais possible d'accéder au contexte depuis ces méthodes
- [ ] **D.** `ContextAwareEncoderInterface`/`ContextAwareDecoderInterface`

### Question 121

Comment enregistrer un encodeur personnalisé si l'autoconfiguration par défaut n'est pas utilisée ? *(une seule bonne réponse)*

- [ ] **A.** En l'ajoutant à un fichier `encoders.yaml` dédié
- [ ] **B.** Ce n'est pas possible sans autoconfiguration, elle est alors obligatoire
- [ ] **C.** En le taguant `serializer.encoder`
- [ ] **D.** En le taguant `serializer.normalizer`, le même tag que pour les normaliseurs

## Le JsonStreamer : installation et bases

### Question 122

Quelle commande installe le composant JsonStreamer ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/stream-json`
- [ ] **B.** `composer require symfony/json-streamer`
- [ ] **C.** `composer require symfony/serializer-streaming`
- [ ] **D.** Il fait partie du composant Serializer, aucune installation séparée n'est nécessaire

### Question 123

Sur quel type de classes PHP le JsonStreamer fonctionne-t-il ? *(une seule bonne réponse)*

- [ ] **A.** N'importe quelle classe, y compris celles avec un constructeur complexe et des propriétés privées
- [ ] **B.** Uniquement des classes implémentant `JsonSerializable`
- [ ] **C.** Uniquement des classes `readonly` avec un constructeur promu
- [ ] **D.** Des classes sans constructeur, composées uniquement de propriétés publiques (à la manière de DTO)

### Question 124

À quoi sert l'attribut `#[JsonStreamable]`, et est-il obligatoire ? *(une seule bonne réponse)*

- [ ] **A.** Il sert uniquement à activer le support des types génériques PHPDoc, sans lien avec les performances
- [ ] **B.** Il remplace entièrement le besoin d'un service `json_streamer.stream_writer`
- [ ] **C.** Il est optionnel mais fortement recommandé : il améliore les performances en pré-générant les fichiers d'encodage/décodage lors du warm-up du cache
- [ ] **D.** Il est strictement obligatoire, sans quoi aucune classe ne peut être traitée par le JsonStreamer

### Question 125

Que définissent les propriétés optionnelles `asObject` et `asList` de `#[JsonStreamable]` ? *(une seule bonne réponse)*

- [ ] **A.** Elles n'existent pas, seul le nom de la classe suffit à l'attribut
- [ ] **B.** Si la classe doit être traitée comme immuable (`asObject`) ou comme collection (`asList`) au sens PHP
- [ ] **C.** Comment la classe doit être préparée (pré-générée) durant le warm-up du cache
- [ ] **D.** Si la classe doit être sérialisée en objet JSON ou en tableau JSON au moment de l'appel, au cas par cas

### Question 126

Comment obtenir le service d'écriture JSON en flux, et quelle méthode déclenche la conversion ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant `SerializerInterface` classique, `write()` étant alors disponible nativement
- [ ] **B.** En appelant la méthode statique `JsonStreamer::write()`
- [ ] **C.** En type-hintant `StreamReaderInterface`, utilisé indifféremment pour la lecture et l'écriture
- [ ] **D.** En type-hintant `StreamWriterInterface` (service `json_streamer.stream_writer`) et en appelant sa méthode `write()`

### Question 127

Comment obtenir le service de lecture JSON en flux, et par quel type-hint explicite peut-on aussi l'injecter ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de service dédié, il faut toujours utiliser `file_get_contents()` puis `Serializer::deserialize()`
- [ ] **B.** Via `#[Autowire(service: 'serializer')]` uniquement
- [ ] **C.** Via `StreamReaderInterface` (service `json_streamer.stream_reader`), ou explicitement via `#[Target('json_streamer.stream_reader')]`
- [ ] **D.** Via `StreamWriterInterface`, le même service gérant lecture et écriture

## Décoder depuis un flux ou depuis une chaîne

### Question 128

Quelles sont les deux approches possibles pour décoder du JSON avec le `StreamReaderInterface`, et quel est le compromis entre elles ? *(une seule bonne réponse)*

- [ ] **A.** Depuis une chaîne uniquement ; les flux ne sont pas supportés par le JsonStreamer
- [ ] **B.** Depuis un flux (`fopen()`) ou depuis une chaîne (`file_get_contents()`) ; les flux économisent la mémoire mais sont plus lents, les chaînes sont plus rapides mais consomment plus de mémoire
- [ ] **C.** Depuis un flux ou depuis une base de données ; il n'y a pas de différence de performance entre les deux
- [ ] **D.** Il n'existe qu'une seule approche possible, toujours basée sur un flux

### Question 129

Pourquoi le décodage depuis un flux est-il plus économe en mémoire, grâce à quel mécanisme interne ? *(une seule bonne réponse)*

- [ ] **A.** Il compresse automatiquement les données en mémoire via gzip
- [ ] **B.** Il n'y a en réalité aucune différence technique, seule la taille du fichier d'entrée change
- [ ] **C.** Le JsonStreamer crée des « ghost objects », des objets légers dont l'instanciation réelle est différée jusqu'à ce que la donnée soit effectivement nécessaire
- [ ] **D.** Il ne charge que les 100 premiers éléments du flux, quel que soit le besoin réel

### Question 130

Que fait le décodage depuis une chaîne (`file_get_contents()` + lecture), par opposition au flux ? *(une seule bonne réponse)*

- [ ] **A.** Il est à la fois plus lent et plus gourmand en mémoire que le mode flux, sans aucun avantage
- [ ] **B.** Il instancie immédiatement tous les objets, ce qui le rend plus rapide mais plus gourmand en mémoire
- [ ] **C.** Il utilise aussi des « ghost objects », comme le mode flux
- [ ] **D.** Il ne peut décoder qu'un seul objet à la fois, jamais une liste

## PHPDoc avancé et généricité

### Question 131

Quel paquet Composer faut-il installer pour permettre au JsonStreamer d'interpréter des types PHPDoc avancés comme les génériques (`@template`) ? *(une seule bonne réponse)*

- [ ] **A.** Aucun paquet n'est nécessaire, les génériques PHPDoc sont supportés nativement
- [ ] **B.** `phpstan/phpdoc-parser`
- [ ] **C.** `phpdocumentor/reflection-docblock` seul suffit, sans autre dépendance
- [ ] **D.** `symfony/type-info` seul suffit, sans dépendance PHPStan

### Question 132

Comment spécifier, au moment de l'appel, quel type concret correspond à un paramètre générique PHPDoc comme `@template TAnimal of Cat|Dog` ? *(une seule bonne réponse)*

- [ ] **A.** En dupliquant la classe `Shelter` une fois par type concret possible
- [ ] **B.** Ce n'est pas possible, un seul type concret par générique doit être fixé une fois pour toutes dans le code
- [ ] **C.** Via un attribut `#[GenericType(Cat::class)]` sur la propriété `$animals`
- [ ] **D.** Via `Type::generic(Type::object(Shelter::class), Type::object(Cat::class))`

## Configurer l'encodage et le décodage

### Question 133

Par défaut, les propriétés à valeur `null` apparaissent-elles dans la sortie JSON générée par le JsonStreamer, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** Oui, elles apparaissent toujours par défaut, sans option pour les exclure
- [ ] **B.** Non, et il n'existe aucune option pour les inclure
- [ ] **C.** Cela dépend uniquement du type PHP déclaré de la propriété, sans option de configuration
- [ ] **D.** Non, elles sont exclues par défaut ; l'option `include_null_properties` à `true` les inclut explicitement

### Question 134

Comment renommer la clé JSON associée à une propriété, par exemple pour mapper `$id` vers la clé `@id` ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'attribut `#[SerializedName('@id')]`, le même que pour le composant Serializer classique
- [ ] **B.** Ce n'est pas configurable, le nom de la propriété PHP est toujours utilisé tel quel
- [ ] **C.** Via l'option de contexte `renamed_properties`
- [ ] **D.** Avec l'attribut `#[StreamedName('@id')]`

### Question 135

Quelle signature doit respecter le callable utilisé par l'option `nativeToStream` de `#[ValueTransformer]`, et où peut-il pointer ? *(une seule bonne réponse)*

- [ ] **A.** Une closure anonyme uniquement, aucune méthode statique n'étant acceptée
- [ ] **B.** `function (object $entity): mixed`, recevant toujours l'objet entier plutôt que la seule valeur de la propriété
- [ ] **C.** `function (mixed $data, array $options = []): mixed`, pouvant être une fonction non anonyme ou une méthode statique publique
- [ ] **D.** `function (mixed $data): void`, une méthode qui modifie la propriété par référence

### Question 136

À quoi sert l'option `streamToNative` de `#[ValueTransformer]`, par opposition à `nativeToStream` ? *(une seule bonne réponse)*

- [ ] **A.** Les deux options sont strictement équivalentes, l'une étant un simple alias de l'autre
- [ ] **B.** `streamToNative` ne s'applique qu'aux propriétés de type `string`
- [ ] **C.** `streamToNative` s'applique uniquement lors de l'encodage, jamais du décodage
- [ ] **D.** Elle transforme la valeur pendant le *décodage* (du JSON vers la valeur PHP), alors que `nativeToStream` transforme pendant l'*encodage*

### Question 137

Quand un simple callable ne suffit pas, comment utiliser un service (avec ses propres dépendances injectées) comme transformateur de valeur ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seuls des callables statiques sans dépendance sont acceptés
- [ ] **B.** En injectant le service directement comme argument du constructeur du DTO, ce qui contredit l'exigence « propriétés publiques uniquement »
- [ ] **C.** Via un `EventListener` sur un événement `ValueTransformEvent`
- [ ] **D.** En créant une classe implémentant `ValueTransformerInterface`, référencée par son nom de service dans l'attribut `#[ValueTransformer]`

### Question 138

Que doit retourner la méthode `getStreamValueType()` d'un `ValueTransformerInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen indiquant si la transformation a réussi
- [ ] **B.** Cette méthode n'existe pas sur `ValueTransformerInterface`
- [ ] **C.** Le type de la valeur telle qu'elle doit apparaître dans le flux JSON (ex. `Type::string()`)
- [ ] **D.** Le type PHP natif de la propriété avant transformation

### Question 139

Dans la méthode `transform()` d'un `ValueTransformerInterface`, à quoi sert l'option spéciale `_current_object` disponible dans `$options` ? *(une seule bonne réponse)*

- [ ] **A.** Elle contient toujours la valeur brute avant transformation, en double de `$value`
- [ ] **B.** Elle sert à indiquer si la transformation a lieu en encodage ou en décodage
- [ ] **C.** Elle n'existe que pour les transformateurs utilisés en lecture, jamais en écriture
- [ ] **D.** Elle donne accès à l'objet qui porte la propriété en cours de transformation (ou `null` si aucun)

### Question 140

Que recommande la documentation à propos des value transformers en termes de performance ? *(une seule bonne réponse)*

- [ ] **A.** Les réserver exclusivement à un usage en environnement de développement
- [ ] **B.** Toujours les envelopper dans une transaction Doctrine
- [ ] **C.** Les garder légers et éviter les appels à des API externes ou à la base de données, car ils sont appelés fréquemment
- [ ] **D.** Toujours effectuer un appel réseau pour valider la donnée transformée

## Configurer dynamiquement clés et valeurs

### Question 141

Quelle interface les services capables de contrôler dynamiquement la forme des objets encodés/décodés par le JsonStreamer implémentent-ils ? *(une seule bonne réponse)*

- [ ] **A.** `PropertyMetadataLoaderInterface` n'existe pas, seuls les attributs PHP permettent une configuration dynamique
- [ ] **B.** `JsonStreamableInterface`
- [ ] **C.** `PropertyMetadataLoaderInterface`
- [ ] **D.** `DynamicMappingInterface`

### Question 142

Comment personnaliser dynamiquement ce comportement pour certaines classes, sans modifier chaque attribut individuellement ? *(une seule bonne réponse)*

- [ ] **A.** Via un événement `PropertyMetadataEvent` dispatché à chaque propriété
- [ ] **B.** En décorant le service `json_streamer.write.property_metadata_loader` (ou son équivalent en lecture) via `#[AsDecorator]`
- [ ] **C.** En modifiant directement le code source du composant JsonStreamer
- [ ] **D.** Ce n'est pas possible, seule la configuration statique par attributs est supportée

### Question 143

Un `PropertyMetadataLoaderInterface` personnalisé peut-il ajouter des propriétés « synthétiques », non portées par une vraie propriété de classe ? *(une seule bonne réponse)*

- [ ] **A.** Non, toute propriété exposée doit obligatoirement correspondre à une propriété PHP réelle
- [ ] **B.** Oui, via `PropertyMetadata::createSynthetic()`, en lui associant un type et des value transformers
- [ ] **C.** Non, il ne peut que renommer ou supprimer des propriétés existantes, jamais en ajouter de nouvelles
- [ ] **D.** Oui, mais uniquement en lecture (décodage), jamais en écriture (encodage)

### Question 144

Que recommande la documentation quant à l'usage de cette approche par décoration de property metadata loader, comparée à la configuration par attributs ? *(une seule bonne réponse)*

- [ ] **A.** La privilégier systématiquement, les attributs étant considérés comme obsolètes
- [ ] **B.** Elle est strictement équivalente en complexité aux attributs, sans préférence particulière
- [ ] **C.** Elle ne doit être utilisée qu'en environnement de test, jamais en production
- [ ] **D.** La réserver aux scénarios avancés : c'est une approche puissante mais complexe, alors que les attributs suffisent pour la plupart des cas d'usage

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Serializer de la documentation Symfony 8.0](https://symfony.com/doc/8.0/serializer.html) ; les entrées préfixées renvoient à l'une des pages de sa section « Going Further with the Serializer ».

**Question 1 : D** — « run this command to install the serializer Symfony pack before using it: `$ composer require symfony/serializer-pack` » *(§ Installation)*

**Question 2 : B** — « get the `serializer` service by using the `SerializerInterface` parameter type (…) `$jsonContent = $serializer->serialize($person, 'json');` » *(§ Serializing an Object)*

**Question 3 : B** — « you can simplify your controller by using the `AbstractController::json` method to create a JSON response from an object using the Serializer. » *(§ Serializing an Object)*

**Question 4 : D** — « You can also serialize objects in any Twig template using the `serialize` filter: `{{ person|serialize(format = 'json') }}` » *(§ Using the Serializer in Twig Templates)*

**Question 5 : C** — « The data to be decoded (…) The name of the class this information will be decoded to (…) The name of the encoder used to convert the data to an array. » *(§ Deserializing an Object)*

**Question 6 : B** — « By default, additional attributes that are not mapped to the denormalized object will be ignored by the Serializer component. » *(§ Deserializing an Object)*

**Question 7 : B** — « Normalizers — These classes convert objects into arrays and vice versa (…) Encoders — Encoders convert arrays into a specific format and the other way around. » *(§ The Serialization Process: Normalizers and Encoders)*

**Question 8 : B** — « The most important normalizer is the `ObjectNormalizer`. This normalizer uses reflection and the PropertyAccess component. » *(§ The Serialization Process: Normalizers and Encoders)*

**Question 9 : A, B** — « The default serializer is also configured with some encoders (…) `JsonEncoder`, `XmlEncoder`, `CsvEncoder`, `YamlEncoder`. » *(§ The Serialization Process: Normalizers and Encoders)*

**Question 10 : A, B, C** — « This context can be configured in multiple places: Globally through the framework configuration / While serializing/deserializing / For a specific property. » *(§ Serializer Context)*

**Question 11 : D** — « When the same setting is configured in multiple places, the latter in the list above will override the previous one (e.g. the setting on a specific property overrides the one configured globally). » *(§ Serializer Context)*

**Question 12 : B** — « You can configure a default context in the framework configuration (…) `framework: serializer: default_context: allow_extra_attributes: false` » *(§ Configure a Default Context)*

**Question 13 : D** — « Context builders are PHP objects that provide autocompletion, validation, and documentation of context options. » *(§ Using Context Builders)*

**Question 14 : D** — « To create a more complex (de)serialization context, you can chain them using the `withContext()` method. » *(§ Using Context Builders)*

**Question 15 : D** — « you can also configure context values on a specific object property (…) `#[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]` » *(§ Configure Context on a Specific Property)*

**Question 16 : A, B, C** — « the mapping files must be placed in one of these locations: All `*.yaml`/`*.xml` files in `config/serializer/` (…) The `serialization.yaml`/`serialization.xml` file in `Resources/config/` of a bundle (…) All `*.yaml`/`*.xml` files in `Resources/config/serialization/` of a bundle. » *(§ Configure Context on a Specific Property)*

**Question 17 : B** — « you can also specify a context specific to normalization or denormalization » via `normalizationContext`/`denormalizationContext`. *(§ Configure Context on a Specific Property)*

**Question 18 : D** — « Context without group is always applied first. Then context for the matching groups are merged in the provided order. » *(§ Configure Context on a Specific Property)*

**Question 19 : C** — « consider using the `#[Context]` attribute on your class to apply that context configuration to all the properties of the class. » *(§ Configure Context on a Specific Property)*

**Question 20 : B** — « it relies on the JsonStreamer component, which is designed for high efficiency and can process large JSON data incrementally, without needing to load the entire content into memory. » *(§ Serializing JSON Using Streams)*

**Question 21 : B** — « Serializer Component: Best suited for use cases that require flexibility, such as dynamically manipulating object structures using normalizers and denormalizers (…) supports output formats beyond JSON. » *(§ Serializing JSON Using Streams)*

**Question 22 : B** — « The default `Serializer` can also be used to only perform one step of the two step serialization process by using the respective interface » : `normalize()`/`denormalize()`. *(§ Serializing to or from PHP Arrays)*

**Question 23 : B** — « use `encode()` to transform PHP arrays into another format (…) and `decode()` to transform any format to just PHP arrays (instead of objects). » *(§ Serializing to or from PHP Arrays)*

**Question 24 : B** — « You can exclude them using the `#[Ignore]` attribute. » *(§ Ignoring Properties)*

**Question 25 : D** — « you can also pass an array of attribute names to ignore at runtime using the `ignored_attributes` context options. » *(§ Ignoring Attributes Using the Context)*

**Question 26 : D** — « this can quickly become unmaintainable if used excessively. See the next section about serialization groups for a better solution. » *(§ Ignoring Attributes Using the Context)*

**Question 27 : B** — « You can add the `#[Groups]` attribute to your class » — `#[Groups(["admin-view"])]`. *(§ Selecting Specific Properties)*

**Question 28 : D** — « or use the special "*" value to serialize all properties (including those without any groups). » *(§ Selecting Specific Properties)*

**Question 29 : B** — « you can also use the `attributes` context option to select properties at runtime (…) `AbstractNormalizer::ATTRIBUTES => ['name', 'company' => ['name']]` » *(§ Using the Serialization Context)*

**Question 30 : D** — « Only attributes that are not ignored are available. If serialization groups are set, only attributes allowed by those groups can be used. » *(§ Using the Serialization Context)*

**Question 31 : D** — « To deserialize a list of objects, you have to append `[]` to the type parameter. » *(§ Handling Arrays)*

**Question 32 : D** — « For nested classes, you have to add a PHPDoc type to the property, constructor or setter » — `@param Person[] $members`. *(§ Handling Arrays)*

**Question 33 : D** — « The Serializer also supports array types used in static analysis, like `list<Person>` and `array<Person>`. Make sure the `phpstan/phpdoc-parser` and `phpdocumentor/reflection-docblock` packages are installed. » *(§ Handling Arrays)*

**Question 34 : C** — « Use the `#[SerializedPath]` to specify the path of the nested property using valid PropertyAccess syntax. » *(§ Deserializing Nested Structures)*

**Question 35 : B** — « The `SerializedPath` cannot be used in combination with a `SerializedName` for the same property. » — la documentation l'interdit explicitement. *(§ Deserializing Nested Structures)*

**Question 36 : C** — « The serializer service uses the `MetadataAwareNameConverter`. With this name converter, you can change the name of an attribute using the `#[SerializedName]` attribute. » *(§ Converting Property Names when Serializing and Deserializing)*

**Question 37 : D** — « You can use it instead of the metadata aware name converter by setting the `name_converter` setting to `serializer.name_converter.camel_case_to_snake_case`. » *(§ CamelCase to snake_case)*

**Question 38 : C** — « by setting the `name_converter` setting to `serializer.name_converter.snake_case_to_camel_case`. » *(§ snake_case to CamelCase)*

**Question 39 : B** — « `UnwrappingDenormalizer` — Can be used to only denormalize a part of the input. » *(§ Serializer Normalizers)*

**Question 40 : B** — « `ProblemNormalizer` — Normalizes `FlattenException` errors according to the API Problem spec RFC 7807. » *(§ Serializer Normalizers)*

**Question 41 : D** — « The default normalization format for objects that implement `Uuid` is the RFC 4122 format (…) for objects that implement `Ulid` is the Base 32 format. » *(§ Serializer Normalizers)*

**Question 42 : C** — « it can denormalize `uuid` or `ulid` strings to `Uuid` or `Ulid`. The format does not matter. » *(§ Serializer Normalizers)*

**Question 43 : C** — « By default, it converts them to strings using the RFC 3339 format (…) To always create DateTime (…) objects using the time zone specified in the context, set the `DateTimeNormalizer::FORCE_TIMEZONE_KEY` context option to `true`. This forces the context time zone and ignores any time zone provided in the input. » *(§ Serializer Normalizers)*

**Question 44 : C** — « To convert the objects to integers or floats, set the serializer context option `DateTimeNormalizer::CAST_KEY` to `int` or `float`. » *(§ Serializer Normalizers)*

**Question 45 : B** — « `ConstraintViolationListNormalizer` — This normalizer converts objects that implement `ConstraintViolationListInterface` into a list of errors according to the RFC 7807 standard. » *(§ Serializer Normalizers)*

**Question 46 : B** — « `DateTimeZoneNormalizer` — This normalizer converts between `DateTimeZone` objects and strings that represent the name of the timezone. » *(§ Serializer Normalizers)*

**Question 47 : C** — « `DateIntervalNormalizer` — By default, the `P%yY%mM%dDT%hH%iM%sS` format is used. » *(§ Serializer Normalizers)*

**Question 48 : B** — « `FormErrorNormalizer` — This normalizer works with classes that implement `FormInterface`. It will get errors from the form and normalize them according to the API Problem spec RFC 7807. » *(§ Serializer Normalizers)*

**Question 49 : B** — « `TranslatableNormalizer` — This normalizer converts objects implementing `TranslatableInterface` to a translated string using the translator. You can define the locale (…) by setting the `TranslatableNormalizer::NORMALIZATION_LOCALE_KEY` context option. » *(§ Serializer Normalizers)*

**Question 50 : C** — « By default, an exception is thrown when data is not a valid backed enumeration. If you want `null` instead, you can set the `BackedEnumNormalizer::ALLOW_INVALID_VALUES` option. » *(§ Serializer Normalizers)*

**Question 51 : B** — « `NumberNormalizer` — This normalizer converts between `BcMath\Number` or `GMP` objects and strings or integers. » *(§ Serializer Normalizers)*

**Question 52 : C** — « `DataUriNormalizer` — This normalizer converts between `SplFileInfo` objects and a data URI string (`data:...`) such that files can be embedded into serialized data. » *(§ Serializer Normalizers)*

**Question 53 : C** — « `JsonSerializableNormalizer` — This normalizer works with classes that implement `JsonSerializable`. (…) Unlike with `json_encode` circular references can be handled. » *(§ Serializer Normalizers)*

**Question 54 : D** — « `ArrayDenormalizer` — This denormalizer converts an array of arrays to an array of objects (…) Use `PropertyInfoExtractor` to provide hints with annotations like `@var Person[]`. » *(§ Serializer Normalizers)*

**Question 55 : C** — « Names are generated by removing the `get`, `set`, `has`, `is`, `can`, `add` or `remove` prefix from the method name and transforming the first letter to lowercase (e.g. `getFirstName()` -> `firstName`). » *(§ Serializer Normalizers)*

**Question 56 : B** — « Always make sure the `DateTimeNormalizer` is registered when serializing the `DateTime` or `DateTimeImmutable` classes to avoid excessive memory usage and exposing internal details. » *(§ Serializer Normalizers)*

**Question 57 : D** — « The PHP object must implement `NormalizableInterface` and/or `DenormalizableInterface`. » *(§ Built-in Normalizers)*

**Question 58 : C** — « It reads the content of the class by calling the "getters" (…) It will denormalize data by calling the constructor and the "setters". » *(§ Built-in Normalizers)*

**Question 59 : D** — « This normalizer directly reads and writes public properties as well as private and protected properties (…) using PHP reflection (…) using the `PropertyNormalizer::NORMALIZE_VISIBILITY` context option. » *(§ Built-in Normalizers)*

**Question 60 : B** — « you may need multiple configurations for the serializer (…) depending on the use case. For example, when your application communicates with multiple APIs, each of which follows its own set of serialization rules. » *(§ Named Serializers)*

**Question 61 : C** — « `#[Target('apiClient2.serializer')] SerializerInterface $customName` » *(§ Named Serializers)*

**Question 62 : B** — « add a `serializer` attribute to the `serializer.normalizer` or `serializer.encoder` tags » — `{ serializer: 'api_client1' }`. *(§ Named Serializers)*

**Question 63 : D** — « When the `serializer` attribute is not set, the service is registered only with the default serializer. » *(§ Named Serializers)*

**Question 64 : C** — « you can exclude the default set of normalizers and encoders from a named serializer by setting the `include_built_in_normalizers` and `include_built_in_encoders` options to `false`. » *(§ Named Serializers)*

**Question 65 : D** — « You can inspect their priorities using the following command: `$ php bin/console debug:container --tag serializer.<normalizer|encoder>.<name>` » *(§ Named Serializers)*

**Question 66 : D** — « Use the `debug:serializer` command to dump the serializer metadata of a given class. » *(§ Debugging the Serializer)*

**Question 67 : C** — « You can change this behavior by setting the `AbstractObjectNormalizer::SKIP_NULL_VALUES` context option to `true`. » *(§ Skipping null Values)*

**Question 68 : D** — « When the value is an instance of `\ArrayObject()`, the serialized data will be `{}`. » *(§ Preserving Empty Objects)*

**Question 69 : B** — « by default the `ObjectNormalizer` catches these errors and ignores such properties. You can disable this behavior by setting `AbstractObjectNormalizer::SKIP_UNINITIALIZED_VALUES` to `false`. » *(§ Handling Uninitialized Properties)*

**Question 70 : D** — « Using `PropertyNormalizer` or `GetSetMethodNormalizer` with `SKIP_UNINITIALIZED_VALUES` set to `false` will throw an `\Error` instance if the given object has uninitialized properties. » *(§ Handling Uninitialized Properties)*

**Question 71 : B** — « To avoid infinite loops, the normalizers throw a `CircularReferenceException` when such a case is encountered. » *(§ Handling Circular References)*

**Question 72 : B** — « The key `circular_reference_limit` in the context sets the number of times it will serialize the same object before considering it a circular reference. The default value is `1`. » *(§ Handling Circular References)*

**Question 73 : D** — « circular references can also be handled by custom callables » via `AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER`. *(§ Handling Circular References)*

**Question 74 : B** — « To limit the serialization depth, you must set the `AbstractObjectNormalizer::ENABLE_MAX_DEPTH` key to `true` in the context. » — combiné à `#[MaxDepth(1)]`. *(§ Handling Serialization Depth)*

**Question 75 : C** — « you can also configure a custom callable that is used when the maximum depth is reached » via `MAX_DEPTH_HANDLER`. *(§ Handling Serialization Depth)*

**Question 76 : B** — « you can set a callback to format a specific object property » via `AbstractNormalizer::CALLBACKS`. *(§ Using Callbacks to Serialize Properties with Object Instances)*

**Question 77 : B** — « the Serializer will add `null` to nullable properties when the parameters (…) are not provided. You can change this behavior by setting `AbstractNormalizer::REQUIRE_ALL_PROPERTIES` to `true` » — lève alors `MissingConstructorArgumentException`. *(§ Require all Properties)*

**Question 78 : B** — « Use the `COLLECT_DENORMALIZATION_ERRORS` option to collect all exceptions at once, and to get the object partially denormalized » — `catch (PartialDenormalizationException $e)`. *(§ Collecting Type Errors While Denormalizing)*

**Question 79 : C** — « The `OBJECT_TO_POPULATE` option is only used for the top level object. (…) When `DEEP_OBJECT_TO_POPULATE` is set to `true`, existing children (…) are updated (…) This only works for single child objects, not for arrays of objects. » *(§ Deserializing in an Existing Object)*

**Question 80 : C** — « This is done using a discriminator class mapping » via `#[DiscriminatorMap(typeProperty: 'type', mapping: [...])]`. *(§ Deserializing Interfaces and Abstract Classes)*

**Question 81 : C** — « You can add a default type to avoid the need to add the type property when deserializing » via `defaultType`. *(§ Deserializing Interfaces and Abstract Classes)*

**Question 82 : D** — « you can use the `UnwrappingDenormalizer` and "unwrap" the input data (…) `UnwrappingDenormalizer::UNWRAP_PATH => '[data][person]'` (…) a property path of the PropertyAccess component. » *(§ Deserializing Input Partially (Unwrapping))*

**Question 83 : C** — « use the `default_constructor_arguments` context option to define default values for the missing parameters. » *(§ Handling Constructor Arguments)*

**Question 84 : B** — « The type enforcement of the properties can be disabled by setting the serializer context option `ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT` to `true`. » *(§ Recursive Denormalization and Type Safety)*

**Question 85 : C** — « This can be done by using the `AbstractNormalizer::FILTER_BOOL` context option. (…) This context makes the deserialization process behave like `filter_var` with the `FILTER_VALIDATE_BOOL` flag. » *(§ Handling Boolean Values)*

**Question 86 : C** — « create a separate class and use the `#[ExtendsSerializationFor]` attribute to tell the Serializer which class should receive this metadata. » *(§ Extending Serialization for a Class)*

**Question 87 : B** — « You can only define metadata for properties that exist on the target class. Otherwise, a `MappingException` is thrown during container compilation. » *(§ Extending Serialization for a Class)*

**Question 88 : D** — « This allows the attribute loader to only process the classes that are known to have serializer attributes, improving performance in production. » *(§ Compile-Time Attribute Metadata)*

**Question 89 : C** — « tag it with `serializer.attribute_metadata` and `container.excluded`. » *(§ Compile-Time Attribute Metadata)*

**Question 90 : D** — « By default, the serializer uses the `cache.system` cache pool. » *(§ Configuring the Metadata Cache)*

**Question 91 : D** — « `final class ZeroDateTimeDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface { use DenormalizerAwareTrait; ... }` » *(Custom Context Builders — § Creating a new Context Builder)*

**Question 92 : D** — « `return true === ($context['zero_datetime_to_null'] ?? false) && is_a($type, \DateTimeInterface::class, true);` » *(Custom Context Builders — § Creating a new Context Builder)*

**Question 93 : B** — « to avoid having to remember about this specific `zero_date_to_null` context key, you can create a dedicated context builder. » *(Custom Context Builders — § Creating a new Context Builder)*

**Question 94 : D** — « `final class LegacyContextBuilder implements ContextBuilderInterface { use ContextBuilderTrait; public function withLegacyDates(bool $legacy): static { return $this->with('zero_datetime_to_null', $legacy); } }` » *(Custom Context Builders — § Creating a new Context Builder)*

**Question 95 : D** — « `$context = (new LegacyContextBuilder())->withLegacyDates(true)->toArray(); $serializer->deserialize($legacyData, MyModel::class, 'json', $context);` » *(Custom Context Builders — § Creating a new Context Builder)*

**Question 96 : B** — « `class OrgPrefixNameConverter implements NameConverterInterface { public function normalize(...): string {...} public function denormalize(...): string {...} }` » *(Custom Name Converter)*

**Question 97 : D** — « `public function denormalize(...): string { return str_starts_with($propertyName, 'org_') ? substr($propertyName, 4) : $propertyName; }` — remove the 'org_' prefix on denormalizing. » *(Custom Name Converter)*

**Question 98 : D** — « configure the serializer to use your name converter (…) `framework: serializer: name_converter: 'App\Serializer\OrgPrefixNameConverter'` » *(Custom Name Converter)*

**Question 99 : B** — « it's usually preferable to let Symfony normalize the object, then hook into the normalization to customize the normalized data. To do that, you can inject a `NormalizerInterface` and wire it to Symfony's object normalizer. » *(Custom Normalizer — § Creating a New Normalizer)*

**Question 100 : B** — « `class TopicNormalizer implements NormalizerInterface { public function normalize(...): array {...} public function supportsNormalization($data, ...): bool {...} public function getSupportedTypes(?string $format): array {...} }` » *(Custom Normalizer — § Creating a New Normalizer)*

**Question 101 : C** — « it must be registered as a service and tagged with `serializer.normalizer`. If you're using the default services.yaml configuration, this is done automatically! » *(Custom Normalizer — § Registering it in your Application)*

**Question 102 : C** — « you have to tag the service with `serializer.normalizer`. You can also use this method to set a priority (higher means it's called earlier in the process). » *(Custom Normalizer — § Registering it in your Application)*

**Question 103 : C** — « This does not cache the actual normalization or denormalization result. It only caches the decision of whether a normalizer supports a given type. » *(Custom Normalizer — § Improving Performance of Normalizers/Denormalizers)*

**Question 104 : D** — « The special key `object` can be used to indicate that the normalizer or denormalizer supports any classes or interfaces. The special key `*` can be used to indicate that the normalizer or denormalizer might support any type. » *(Custom Normalizer — § Improving Performance of Normalizers/Denormalizers)*

**Question 105 : D** — « The values should be booleans indicating whether the result of the `supports*()` call for that type is cacheable. (…) A `null` value means the normalizer or denormalizer does not support that type. » *(Custom Normalizer — § Improving Performance of Normalizers/Denormalizers)*

**Question 106 : D** — « The `native-<type>` strings (e.g. `native-string`, `native-integer`, `native-boolean`) declare support for scalar values, using the names returned by `gettype`. » *(Custom Normalizer — § Improving Performance of Normalizers/Denormalizers)*

**Question 107 : B** — « The `supports*()` method implementations should not assume that `getSupportedTypes()` has been called before. » *(Custom Normalizer — § Improving Performance of Normalizers/Denormalizers)*

**Question 108 : A, B** — « `JsonEncoder` (…) `XmlEncoder` (…) `YamlEncoder` (…) requires the Yaml Component. (…) `CsvEncoder`. » *(Encoders — introduction)*

**Question 109 : D** — « you can use the serialization context to pass in these options using the key `json_encode_options` or `json_decode_options`. » *(Encoders — § The JsonEncoder)*

**Question 110 : C** — « `json_decode_associative` (default: `false`) — If set to `true` returns the result as an array, returns a nested `stdClass` hierarchy otherwise. » *(Encoders — § The JsonEncoder)*

**Question 111 : B** — « The special `#` key can be used to define the data of a node (…) keys beginning with `@` will be considered attributes. » *(Encoders — § The XmlEncoder)*

**Question 112 : B** — « the key `#comment` can be used for encoding XML comments » — `['qux' => ['#comment' => 'A comment']]` s'encode en `<qux><!-- A comment --!><qux>`. *(Encoders — § The XmlEncoder)*

**Question 113 : B** — « `as_collection` — Always returns results as a collection, even if only one line is decoded. » *(Encoders — § The XmlEncoder / § The CsvEncoder)*

**Question 114 : C** — « `cdata_wrapping` (default: `true`) — If set to `false`, will not wrap any value containing one of the following characters (`<`, `>`, `&`) in a CDATA section (…) `cdata_wrapping_pattern` — A regular expression pattern to determine if a value should be wrapped in a CDATA section. » *(Encoders — § The XmlEncoder Context Options)*

**Question 115 : C** — « `preserve_numeric_keys` (default: `false`) — If set to true, it keeps numeric array indexes (e.g. `<item key="0">`) instead of collapsing them into `<item>` nodes. » *(Encoders — § The XmlEncoder Context Options)*

**Question 116 : C** — « `csv_headers` (default: `[]`, inferred from input data's keys) — Sets the order of the header and data columns. E.g. if you set it to `['a', 'b', 'c']` (…) the order will be `a,b,c` instead of the input order. » *(Encoders — § The CsvEncoder)*

**Question 117 : B** — « `csv_escape_formulas` (default: `false`) — Escapes fields containing formulas by prepending them with a `\t` character. » *(Encoders — § The CsvEncoder)*

**Question 118 : B** — « This encoder requires the Yaml Component (…) `yaml_flags` (default: `0`) — A bit field of `Yaml::DUMP_*`/`Yaml::PARSE_*` constants. » *(Encoders — § The YamlEncoder)*

**Question 119 : D** — « `class NeonEncoder implements EncoderInterface, DecoderInterface { ... }` » *(Encoders — § Creating a Custom Encoder)*

**Question 120 : D** — « make sure to implement `Symfony\Component\Serializer\Encoder\ContextAwareDecoderInterface` or `Symfony\Component\Serializer\Encoder\ContextAwareEncoderInterface` accordingly. » *(Encoders — § Creating a Custom Encoder)*

**Question 121 : C** — « make sure to register your class as a service and tag it with `serializer.encoder`. » *(Encoders — § Registering it in Your App)*

**Question 122 : B** — « run this command to install the JsonStreamer component: `$ composer require symfony/json-streamer` » *(Streaming JSON — § Installation)*

**Question 123 : D** — « JsonStreamer only works with PHP classes that have no constructor and are composed solely of public properties, like DTO classes. » *(Streaming JSON — § Encoding Objects)*

**Question 124 : C** — « This attribute is optional, but it's highly recommended as it improves performance by pre-generating encoding and decoding files during cache warm-up. » *(Streaming JSON — § Encoding Objects)*

**Question 125 : C** — « It includes two optional properties: `asObject` and `asList`, which define how the class should be prepared during cache warm-up. » *(Streaming JSON — § Encoding Objects)*

**Question 126 : D** — « inject the JSON stream writer into your service. The service id is `json_streamer.stream_writer` (…) Use the `write` method. » *(Streaming JSON — § Encoding Objects)*

**Question 127 : C** — « inject the JSON stream reader into your service. The service id is `json_streamer.stream_reader` (…) You can explicitly inject (…) by using the `#[Target('json_streamer.stream_reader')]` autowire attribute. » *(Streaming JSON — § Decoding Objects)*

**Question 128 : B** — « decoding from a stream (…) decoding from a string (…) Use streams if optimizing memory usage is more important. Use strings if performance is more important. » *(Streaming JSON — § Decoding Objects)*

**Question 129 : C** — « JsonStreamer creates ghost objects instead of fully instantiating them. These lightweight placeholders delay object creation until the data is actually needed. » *(Streaming JSON — § Decoding from a Stream)*

**Question 130 : B** — « the entire JSON file is read into a string (…) The decoder then instantiates all the objects immediately. This approach is faster (…) but it requires more memory. » *(Streaming JSON — § Decoding from a String)*

**Question 131 : B** — « To enable PHPDoc parsing, run: `$ composer require phpstan/phpdoc-parser` » *(Streaming JSON — § Enabling PHPDoc Reading)*

**Question 132 : D** — « `$type = Type::generic(Type::object(Shelter::class), Type::object(Cat::class));` — maps the TAnimal template in Shelter to the Cat concrete type. » *(Streaming JSON — § Enabling PHPDoc Reading)*

**Question 133 : D** — « By default, properties with `null` values are excluded from the JSON output. Pass the `include_null_properties` option to include them explicitly. » *(Streaming JSON — § Including Null Properties)*

**Question 134 : D** — « You can configure the JSON key for a property using the `StreamedName` attribute (…) `#[StreamedName('@id')]` » *(Streaming JSON — § Configuring the Encoded Name)*

**Question 135 : C** — « Its `nativeToStream` option accepts a callable or a value transformer service id. The callable must be a public static method or non-anonymous function with this signature. » *(Streaming JSON — § Configuring the Encoded Value)*

**Question 136 : D** — « To transform a property's value during decoding, use the `ValueTransformer` attribute. Its `streamToNative` option accepts a callable. » *(Streaming JSON — § Configuring the Decoded Value)*

**Question 137 : D** — « When callables are not enough, you can use a service implementing the `ValueTransformerInterface`. » *(Streaming JSON — § Transforming Value Using Services)*

**Question 138 : C** — « The `getStreamValueType()` method must return the value's type as it will appear in the JSON stream. » *(Streaming JSON — § Transforming Value Using Services)*

**Question 139 : D** — « The `$options` argument of the `transform()` method includes a special option called `_current_object` which gives access to the object holding the current property (or `null` if there's none). » *(Streaming JSON — § Transforming Value Using Services)*

**Question 140 : C** — « Value transformers are called frequently during encoding and decoding. Keep them lightweight and avoid calls to external APIs or the database. » *(Streaming JSON — § Transforming Value Using Services)*

**Question 141 : C** — « JsonStreamer uses services that implement the `PropertyMetadataLoaderInterface` to control the shape and values of objects during encoding/decoding. » *(Streaming JSON — § Configuring Keys and Values Dynamically)*

**Question 142 : B** — « These services are highly flexible and can be decorated to support dynamic configurations (…) `#[AsDecorator('json_streamer.write.property_metadata_loader')]` » *(Streaming JSON — § Configuring Keys and Values Dynamically)*

**Question 143 : B** — « you can add synthetic properties (not backed by a class property) `PropertyMetadata::createSynthetic(type: Type::bool(), valueTransformers: [fn() => true])` » *(Streaming JSON — § Configuring Keys and Values Dynamically)*

**Question 144 : D** — « Although powerful, this approach introduces complexity (…) For most use cases, attribute-based configuration is sufficient. Reserve dynamic loaders for advanced scenarios. » *(Streaming JSON — § Configuring Keys and Values Dynamically)*

## Pour aller plus loin

Les pages listées dans la section [Going Further with the Serializer](https://symfony.com/doc/8.0/serializer.html#going-further-with-the-serializer) de la page :

- [How to Create your Custom Context Builder](https://symfony.com/doc/8.0/serializer/custom_context_builders.html) — questions 91 à 95
- [How to Create your Custom Name Converter](https://symfony.com/doc/8.0/serializer/custom_name_converter.html) — questions 96 à 98
- [How to Create your Custom Normalizer](https://symfony.com/doc/8.0/serializer/custom_normalizer.html) — questions 99 à 107
- [Serializer Encoders](https://symfony.com/doc/8.0/serializer/encoders.html) — questions 108 à 121
- [Streaming JSON](https://symfony.com/doc/8.0/serializer/streaming_json.html) — questions 122 à 144
