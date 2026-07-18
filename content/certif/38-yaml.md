# QCM — Le composant Yaml

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/yaml.html](https://symfony.com/doc/8.0/components/yaml.html) · **Généré le :** 24 juillet 2026
>
> **72 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande installe le composant Yaml ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/parser`
- [ ] **B.** `npm install yaml`
- [ ] **C.** `composer create-project symfony/yaml`
- [ ] **D.** `composer require symfony/yaml`

### Question 2

Que fait le composant Symfony Yaml ? *(une seule bonne réponse)*

- [ ] **A.** Il sert exclusivement à générer de la documentation au format YAML
- [ ] **B.** Il charge et dump des fichiers YAML, en parsant des chaînes YAML vers des tableaux PHP et inversement
- [ ] **C.** Il compile des fichiers YAML en fichiers PHP exécutables
- [ ] **D.** Il valide uniquement la syntaxe YAML sans jamais la convertir

## Why?

### Question 3

Concernant l'objectif de rapidité (« Fast ») du composant, quelles fonctionnalités sont explicitement listées comme volontairement absentes ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les directives de document (document directives)
- [ ] **B.** Les messages multi-lignes entre guillemets (multi-line quoted messages)
- [ ] **C.** Les fichiers multi-documents (multi-document files)
- [ ] **D.** Les ancres et alias YAML

### Question 4

Que signifie « Real Parser » pour ce composant ? *(une seule bonne réponse)*

- [ ] **A.** Il utilise une simple expression régulière pour parser le YAML
- [ ] **B.** Il délègue le parsing à une extension C native obligatoire
- [ ] **C.** Il ne supporte que la syntaxe JSON, un sous-ensemble de YAML
- [ ] **D.** Il implémente un vrai analyseur syntaxique capable de parser un large sous-ensemble de la spécification YAML

### Question 5

Que garantissent les « Clear Error Messages » du composant ? *(une seule bonne réponse)*

- [ ] **A.** Un lien vers la documentation officielle YAML
- [ ] **B.** Un message d'erreur incluant le nom du fichier et le numéro de ligne où le problème est survenu
- [ ] **C.** Un code d'erreur numérique uniquement, sans texte
- [ ] **D.** Une trace de la pile d'appels complète systématiquement

### Question 6

Que permet le « Dump Support » du composant ? *(une seule bonne réponse)*

- [ ] **A.** Dumper des objets uniquement, jamais des tableaux
- [ ] **B.** Dumper des tableaux PHP vers YAML, avec support des objets et une configuration du niveau d'inline
- [ ] **C.** Uniquement parser du YAML vers PHP, sans opération inverse
- [ ] **D.** Dumper uniquement vers du JSON, jamais vers du YAML

### Question 7

Que couvre le « Types Support » du composant ? *(une seule bonne réponse)*

- [ ] **A.** Les types scalaires PHP mais jamais les tableaux
- [ ] **B.** Uniquement les types définis par l'utilisateur
- [ ] **C.** La plupart des types natifs YAML : dates, entiers, nombres octaux, booléens, etc.
- [ ] **D.** Uniquement les chaînes de caractères

### Question 8

Que permet le « Full Merge Key Support » ? *(une seule bonne réponse)*

- [ ] **A.** Un mécanisme de migration entre versions du composant
- [ ] **B.** Un support complet des références, alias et clés de fusion (merge key), pour éviter la répétition de configuration
- [ ] **C.** La fusion automatique de deux fichiers YAML distincts sur le disque
- [ ] **D.** La fusion des clés dupliquées uniquement en cas d'erreur de syntaxe

## Using the Symfony YAML Component

### Question 9

De quelles classes principales se compose le composant Yaml ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Parser`
- [ ] **B.** `Dumper`
- [ ] **C.** `Yaml` (wrapper simplifié)
- [ ] **D.** `Serializer`

### Question 10

Quel rôle joue la classe `Yaml` par rapport à `Parser` et `Dumper` ? *(une seule bonne réponse)*

- [ ] **A.** Elle remplace complètement `Parser` et `Dumper`, qui sont dépréciés
- [ ] **B.** Elle ne fait que déléguer au composant Serializer
- [ ] **C.** Elle est utilisée uniquement en interne, jamais directement par le développeur
- [ ] **D.** Elle agit comme un wrapper léger qui simplifie les usages courants

## Reading YAML Contents

### Question 11

Quelle méthode parse une chaîne YAML et la convertit en tableau PHP ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::load()`
- [ ] **B.** `Yaml::decode()`
- [ ] **C.** `Yaml::fromString()`
- [ ] **D.** `Yaml::parse()`

### Question 12

Que se passe-t-il si une erreur survient pendant le parsing avec `Yaml::parse()` ? *(une seule bonne réponse)*

- [ ] **A.** Le composant tente automatiquement de corriger la syntaxe
- [ ] **B.** Une exception `ParseException` est levée, indiquant le type d'erreur et la ligne concernée
- [ ] **C.** La méthode retourne silencieusement `null`
- [ ] **D.** Un warning PHP est émis mais l'exécution continue avec un tableau vide

### Question 13

Que retourne `Yaml::parse("foo: bar")` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception, car la syntaxe est trop simple
- [ ] **B.** `['foo' => 'bar']`
- [ ] **C.** `'foo: bar'`
- [ ] **D.** `new Yaml('foo', 'bar')`

## Reading YAML Files

### Question 14

Quelle méthode parse le contenu YAML d'un fichier donné par son chemin ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::readFile()`
- [ ] **B.** `Yaml::loadFile()`
- [ ] **C.** `Yaml::fromFile()`
- [ ] **D.** `Yaml::parseFile()`

### Question 15

Que se passe-t-il en cas d'erreur de parsing avec `Yaml::parseFile()` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception différente, `FileParseException`, est levée
- [ ] **B.** Le fichier est ignoré silencieusement
- [ ] **C.** Une exception `FileNotFoundException` est systématiquement levée, même si le fichier existe
- [ ] **D.** Une exception `ParseException` est levée, comme avec `Yaml::parse()`

## Writing YAML Files

### Question 16

Quelle méthode dump un tableau PHP vers sa représentation YAML ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::stringify()`
- [ ] **B.** `Yaml::toYaml()`
- [ ] **C.** `Yaml::dump()`
- [ ] **D.** `Yaml::export()`

### Question 17

Que se passe-t-il si une erreur survient pendant le dump ? *(une seule bonne réponse)*

- [ ] **A.** Une exception `ParseException` est levée, la même que pour le parsing
- [ ] **B.** La méthode retourne une chaîne vide
- [ ] **C.** PHP lève une `TypeError` native
- [ ] **D.** Une exception `DumpException` est levée

## Expanded and Inlined Arrays

### Question 18

Par défaut, quelle représentation le dumper utilise-t-il pour les tableaux ? *(une seule bonne réponse)*

- [ ] **A.** Toujours la représentation JSON
- [ ] **B.** La représentation étendue (expanded)
- [ ] **C.** La représentation inline
- [ ] **D.** Un mélange des deux, choisi aléatoirement

### Question 19

À quoi sert le second argument de `Yaml::dump()` ? *(une seule bonne réponse)*

- [ ] **A.** Il définit le nombre d'espaces utilisés pour l'indentation
- [ ] **B.** Il active ou désactive la validation stricte du YAML généré
- [ ] **C.** Il force l'utilisation exclusive de guillemets doubles
- [ ] **D.** Il définit le niveau à partir duquel la sortie passe de la représentation étendue à la représentation inline

### Question 20

Dans `Yaml::dump($array, 1)`, que signifie la valeur `1` ? *(une seule bonne réponse)*

- [ ] **A.** Le nombre de lignes maximum du fichier généré
- [ ] **B.** La version du format YAML utilisée
- [ ] **C.** Le niveau de profondeur au-delà duquel le YAML généré passe en notation inline (ex : `{ foo: bar, bar: baz }`)
- [ ] **D.** Le nombre d'espaces d'indentation

## Indentation

### Question 21

Par défaut, combien d'espaces le composant Yaml utilise-t-il pour l'indentation ? *(une seule bonne réponse)*

- [ ] **A.** 2 espaces
- [ ] **B.** 8 espaces
- [ ] **C.** Une tabulation
- [ ] **D.** 4 espaces

### Question 22

Comment changer le nombre d'espaces d'indentation utilisé par le dumper ? *(une seule bonne réponse)*

- [ ] **A.** Via une constante globale `YAML_INDENT` à définir avant l'appel
- [ ] **B.** Ce n'est pas configurable, toujours 4 espaces
- [ ] **C.** Via le premier argument de `Yaml::dump()`
- [ ] **D.** Via le troisième argument de `Yaml::dump()`, ex. `Yaml::dump($array, 2, 8)`

## Numeric Literals

### Question 23

Pourquoi le composant permet-il d'ajouter des underscores dans les littéraux numériques YAML (ex : `1234_5678_9012_3456`) ? *(une seule bonne réponse)*

- [ ] **A.** Pour forcer l'interprétation en tant que chaîne de caractères
- [ ] **B.** Pour séparer les milliers uniquement, avec un underscore maximum par nombre
- [ ] **C.** Pour améliorer la lisibilité de longs nombres, sans limite sur le nombre ou le regroupement des underscores
- [ ] **D.** Pour indiquer un nombre négatif

### Question 24

Que fait le parser des underscores présents dans un littéral numérique lors du parsing ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont conservés tels quels dans la valeur PHP résultante (sous forme de chaîne)
- [ ] **B.** Ils provoquent une erreur de syntaxe
- [ ] **C.** Ils sont convertis en points décimaux
- [ ] **D.** Tous les caractères `_` sont retirés du contenu du littéral numérique

## Parsing Untrusted YAML

### Question 25

Que sont les « YAML anchors » (ancres) ? *(une seule bonne réponse)*

- [ ] **A.** Un système de commentaires YAML
- [ ] **B.** Une syntaxe réservée aux nombres hexadécimaux
- [ ] **C.** Un tag exclusivement utilisé pour les dates
- [ ] **D.** Un mécanisme permettant à un nœud de référencer un autre nœud (`&anchor` et `*anchor`)

### Question 26

Quel risque posent des alias YAML chaînés pointant vers des collections imbriquées, dans un document malveillant ? *(une seule bonne réponse)*

- [ ] **A.** Aucun risque, les alias étant toujours résolus en O(1)
- [ ] **B.** Une croissance exponentielle de la mémoire lors de leur résolution, pouvant épuiser le processus
- [ ] **C.** Une simple erreur de syntaxe sans conséquence
- [ ] **D.** Un ralentissement linéaire négligeable

### Question 27

Quel flag permet de rejeter d'emblée tout document contenant des alias ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_NO_ALIAS`
- [ ] **B.** `Yaml::REJECT_ALIAS`
- [ ] **C.** `Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE`
- [ ] **D.** `Yaml::PARSE_EXCEPTION_ON_ALIAS`

### Question 28

Si l'application a besoin des alias, quelles limites le parser applique-t-il par défaut ? *(plusieurs bonnes réponses)*

- [ ] **A.** Au plus 128 niveaux d'imbrication (nesting levels)
- [ ] **B.** Au plus 128 résolutions d'alias de collection par document
- [ ] **C.** Un temps d'exécution maximum de 5 secondes
- [ ] **D.** Une taille de fichier maximum de 1 Mo

### Question 29

Comment ajuster `maxNestingLevel` et `maxAliasesForCollections` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est réglable que via un fichier de configuration global
- [ ] **B.** Uniquement en sous-classant la classe `Parser`
- [ ] **C.** Ces limites sont fixes et non configurables
- [ ] **D.** Via les arguments optionnels de `Yaml::parse()` et `Yaml::parseFile()` (ainsi que le constructeur de `Parser`)

### Question 30

Que précise la documentation à propos de ces limites (nesting/alias) ? *(une seule bonne réponse)*

- [ ] **A.** Elles garantissent une sécurité totale contre toute attaque par déni de service
- [ ] **B.** Elles ne s'appliquent qu'en environnement de production
- [ ] **C.** Elles ne sont activées que si `PARSE_EXCEPTION_ON_ALIAS` est aussi utilisé
- [ ] **D.** Elles rendent les documents malveillants plus difficiles à exploiter, mais ne remplacent pas la validation des entrées non fiables

## Object Parsing and Dumping

### Question 31

Quel flag permet de dumper des objets PHP en YAML ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_OBJECT`
- [ ] **B.** `Yaml::DUMP_OBJECT_SUPPORT`
- [ ] **C.** `Yaml::DUMP_OBJECT`
- [ ] **D.** `Yaml::DUMP_OBJECT_AS_MAP`

### Question 32

Quel flag permet de parser un objet dumpé (avec le tag `!php/object`) en instance PHP ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_OBJECT`
- [ ] **B.** `Yaml::PARSE_OBJECT_FOR_MAP`
- [ ] **C.** `Yaml::PARSE_CONSTANT`
- [ ] **D.** `Yaml::PARSE_OBJECT`

### Question 33

Quelle méthode PHP le composant Yaml utilise-t-il en interne pour générer la représentation d'un objet lors du dump avec `DUMP_OBJECT` ? *(une seule bonne réponse)*

- [ ] **A.** `get_object_vars()`
- [ ] **B.** `serialize()`
- [ ] **C.** `json_encode()`
- [ ] **D.** `var_export()`

### Question 34

Pourquoi la documentation déconseille-t-elle l'usage du tag `!php/object` avec d'autres implémentations YAML ? *(une seule bonne réponse)*

- [ ] **A.** Ce tag ne fonctionne qu'avec des objets `stdClass`
- [ ] **B.** Ce tag nécessite l'extension PHP intl
- [ ] **C.** La sérialisation d'objets est spécifique à cette implémentation ; les autres parsers PHP risquent de ne pas reconnaître ce tag, et les implémentations non-PHP ne le reconnaîtront certainement pas
- [ ] **D.** Ce tag est déprécié dans Symfony 8.0

### Question 35

Pourquoi ne faut-il jamais activer `PARSE_OBJECT` pour du contenu YAML non fiable ? *(une seule bonne réponse)*

- [ ] **A.** Cela consomme deux fois plus de mémoire sans raison de sécurité
- [ ] **B.** Cela n'est pas supporté par les versions PHP récentes
- [ ] **C.** Parser des tags `!php/object` utilise la désérialisation PHP en interne, un vecteur d'attaque classique
- [ ] **D.** Cela ralentit le parsing de façon significative

## Parsing and Dumping Objects as Maps

### Question 36

Quel flag permet de dumper un objet comme une map YAML plutôt qu'avec le tag `!php/object` ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_OBJECT`
- [ ] **B.** `Yaml::PARSE_OBJECT_FOR_MAP`
- [ ] **C.** `Yaml::DUMP_AS_MAP`
- [ ] **D.** `Yaml::DUMP_OBJECT_AS_MAP`

### Question 37

Quel flag permet de parser une telle map YAML en objet PHP ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_OBJECT`
- [ ] **B.** `Yaml::DUMP_OBJECT_AS_MAP`
- [ ] **C.** `Yaml::PARSE_MAP_AS_OBJECT`
- [ ] **D.** `Yaml::PARSE_OBJECT_FOR_MAP`

### Question 38

Quel mécanisme PHP est utilisé en interne pour représenter l'objet comme une map lors du dump avec `DUMP_OBJECT_AS_MAP` ? *(une seule bonne réponse)*

- [ ] **A.** La réflexion (`ReflectionObject`)
- [ ] **B.** `json_decode()`
- [ ] **C.** Le cast `(array)`
- [ ] **D.** `serialize()`

## Handling Invalid Types

### Question 39

Que fait le parser par défaut lorsqu'il rencontre un type invalide ? *(une seule bonne réponse)*

- [ ] **A.** Il ignore silencieusement toute la ligne concernée
- [ ] **B.** Il lève une erreur fatale PHP
- [ ] **C.** Il encode le type invalide en tant que `null`
- [ ] **D.** Il lève systématiquement une exception

### Question 40

Quel flag force le parser à lever une exception sur un type invalide plutôt que de retourner `null` ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_STRICT_TYPES`
- [ ] **B.** `Yaml::PARSE_EXCEPTION_ON_ALIAS`
- [ ] **C.** `Yaml::THROW_ON_INVALID`
- [ ] **D.** `Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE`

### Question 41

Quel flag équivalent existe pour le dump ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_STRICT_TYPES`
- [ ] **B.** `Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE` (le même que pour le parsing)
- [ ] **C.** `Yaml::DUMP_OBJECT` (car les objets sont toujours invalides)
- [ ] **D.** `Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE`

## Date Handling

### Question 42

Par défaut, comment le parser YAML traite-t-il une chaîne non quotée qui ressemble à une date, ex. `2016-05-27` ? *(une seule bonne réponse)*

- [ ] **A.** Il la convertit automatiquement en objet `DateTimeImmutable`
- [ ] **B.** Il la convertit en timestamp Unix
- [ ] **C.** Il la conserve telle quelle comme chaîne de caractères
- [ ] **D.** Il lève une exception, les dates devant être quotées

### Question 43

Quel flag permet de convertir une date parsée en instance `DateTime` plutôt qu'en timestamp ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_DATE`
- [ ] **B.** `Yaml::PARSE_OBJECT`
- [ ] **C.** `Yaml::DUMP_DATETIME`
- [ ] **D.** `Yaml::PARSE_DATETIME`

### Question 44

Quels formats de chaîne non quotée le parser interprète-t-il automatiquement comme une date ou une date-heure ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le format simple `YYYY-MM-DD`, ex. `2016-05-27`
- [ ] **B.** Le format ISO-8601 complet avec heure, ex. `2016-05-27T02:59:43.1Z`
- [ ] **C.** Le format américain `MM/DD/YYYY`
- [ ] **D.** Le timestamp Unix sous forme de chaîne, ex. `"1464307200"`

## Dumping Multi-line Literal Blocks

### Question 45

Par défaut, comment le dumper encode-t-il une chaîne PHP contenant des retours à la ligne ? *(une seule bonne réponse)*

- [ ] **A.** Toujours comme un bloc littéral avec le symbole `|`
- [ ] **B.** En la découpant en plusieurs clés numérotées
- [ ] **C.** En levant une exception, les retours à la ligne n'étant pas supportés
- [ ] **D.** Comme une chaîne inline avec des `\n` échappés

### Question 46

Quel flag permet de dumper une chaîne multi-lignes sous forme de bloc littéral YAML (avec `|`) ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_LITERAL_BLOCK`
- [ ] **B.** `Yaml::DUMP_MULTILINE`
- [ ] **C.** `Yaml::PARSE_MULTI_LINE_LITERAL_BLOCK`
- [ ] **D.** `Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK`

## Parsing PHP Constants

### Question 47

Par défaut, comment le parser YAML traite-t-il les constantes PHP présentes dans le contenu ? *(une seule bonne réponse)*

- [ ] **A.** Il les convertit en entiers
- [ ] **B.** Comme de simples chaînes de caractères
- [ ] **C.** Il les résout immédiatement en leur valeur PHP réelle
- [ ] **D.** Il lève une exception, les constantes n'étant pas supportées

### Question 48

Quel flag, combiné à la syntaxe `!php/const`, permet de résoudre les constantes PHP dans le YAML ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_PHP_CONST`
- [ ] **B.** `Yaml::PARSE_OBJECT`
- [ ] **C.** `Yaml::PARSE_CUSTOM_TAGS`
- [ ] **D.** `Yaml::PARSE_CONSTANT`

### Question 49

Que prévient la documentation à propos du flag `PARSE_CONSTANT` ? *(une seule bonne réponse)*

- [ ] **A.** Il nécessite obligatoirement la syntaxe `!php/enum`
- [ ] **B.** Il permet au contenu YAML de résoudre des constantes et cas d'enum PHP arbitraires ; ne l'activer que pour du contenu de confiance
- [ ] **C.** Il ralentit fortement le parsing, à réserver aux petits fichiers
- [ ] **D.** Il est incompatible avec `PARSE_DATETIME`

## Parsing PHP Enumerations

### Question 50

Quels types d'enums PHP le parser YAML supporte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les enums simples (unit enums)
- [ ] **B.** Les enums avec valeur (backed enums)
- [ ] **C.** Les enums implémentant une interface personnalisée uniquement
- [ ] **D.** Uniquement les enums de type `int`

### Question 51

Quelle syntaxe, combinée au flag `PARSE_CONSTANT`, permet de parser une valeur comme un cas d'enum PHP réel ? *(une seule bonne réponse)*

- [ ] **A.** `!!enum`
- [ ] **B.** `!php/case`
- [ ] **C.** `!php/enum`
- [ ] **D.** `!php/const`

### Question 52

Sans la syntaxe `!php/enum` (mais avec `PARSE_CONSTANT`), comment une valeur comme `FooEnum::Foo` est-elle interprétée ? *(une seule bonne réponse)*

- [ ] **A.** Comme le cas d'enum réel `FooEnum::Foo`
- [ ] **B.** Comme une exception de parsing
- [ ] **C.** Comme `null`
- [ ] **D.** Comme une simple chaîne de caractères

### Question 53

Que retourne le parsing de `{ bar: !php/enum FooEnum }` (en donnant uniquement le FQCN de l'enum, sans `->case`) ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le premier cas de l'énumération
- [ ] **B.** `null`
- [ ] **C.** Un tableau contenant toutes les valeurs des cas de l'énumération
- [ ] **D.** Une exception, un cas précis étant obligatoire

## Parsing and Dumping of Binary Data

### Question 54

Comment les chaînes non encodées en UTF-8 sont-elles dumpées par le composant Yaml ? *(une seule bonne réponse)*

- [ ] **A.** Elles provoquent une exception
- [ ] **B.** Elles sont tronquées aux premiers octets valides
- [ ] **C.** Elles sont converties de force en UTF-8 avant le dump
- [ ] **D.** Encodées en base64 avec le tag `!!binary`

### Question 55

Comment les données binaires marquées par le tag `!!binary` sont-elles traitées au parsing ? *(une seule bonne réponse)*

- [ ] **A.** Elles provoquent systématiquement une exception
- [ ] **B.** Elles sont ignorées et remplacées par `null`
- [ ] **C.** Elles sont automatiquement décodées
- [ ] **D.** Elles restent des chaînes base64 brutes, sans décodage

## Parsing and Dumping Custom Tags

### Question 56

Quel flag permet de parser des tags YAML personnalisés définis par l'utilisateur, comme `!my_tag` ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::PARSE_CONSTANT`
- [ ] **B.** `Yaml::PARSE_OBJECT`
- [ ] **C.** `Yaml::PARSE_TAGS`
- [ ] **D.** `Yaml::PARSE_CUSTOM_TAGS`

### Question 57

Quelle classe représente une valeur associée à un tag personnalisé après parsing avec `PARSE_CUSTOM_TAGS` ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Yaml\Tag\CustomTag`
- [ ] **B.** `Symfony\Component\Yaml\Tag\Tag`
- [ ] **C.** `Symfony\Component\Yaml\CustomValue`
- [ ] **D.** `Symfony\Component\Yaml\Tag\TaggedValue`

### Question 58

Que se passe-t-il si le contenu à dumper contient des objets `TaggedValue` ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont ignorés silencieusement
- [ ] **B.** Ils sont automatiquement transformés en tags YAML
- [ ] **C.** Une exception est levée, car `TaggedValue` n'est pas dumpable
- [ ] **D.** Ils sont convertis en chaînes JSON

## Dumping Null Values

### Question 59

Par défaut, comment le composant dump-t-il une valeur `null` ? *(une seule bonne réponse)*

- [ ] **A.** `foo: NULL` (en majuscules)
- [ ] **B.** `foo: null`
- [ ] **C.** `foo: ~`
- [ ] **D.** `foo:` (rien après les deux-points)

### Question 60

Quels flags permettent respectivement de dumper `null` comme `~` et comme chaîne vide ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Yaml::DUMP_NULL_AS_TILDE`
- [ ] **B.** `Yaml::DUMP_NULL_AS_EMPTY`
- [ ] **C.** `Yaml::DUMP_NULL_AS_STRING`
- [ ] **D.** `Yaml::PARSE_NULL_AS_EMPTY`

## Dumping Numeric Keys as Strings

### Question 61

Par défaut, comment les clés de tableau composées uniquement de chiffres sont-elles dumpées ? *(une seule bonne réponse)*

- [ ] **A.** Elles provoquent une exception
- [ ] **B.** Elles sont converties en clés séquentielles à partir de 0
- [ ] **C.** Comme des entiers
- [ ] **D.** Comme des chaînes entre guillemets

### Question 62

Quel flag force le dump des clés numériques en tant que chaînes ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_NUMERIC_AS_STRING`
- [ ] **B.** `Yaml::DUMP_NUMERIC_KEY_AS_STRING`
- [ ] **C.** `Yaml::DUMP_KEYS_AS_STRING`
- [ ] **D.** `Yaml::DUMP_FORCE_STRING_KEYS`

## Dumping Double Quotes on Values

### Question 63

Par défaut, quelles valeurs de chaîne sont entourées de guillemets doubles lors du dump ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les valeurs de chaîne, systématiquement
- [ ] **B.** Aucune valeur, jamais de guillemets automatiques
- [ ] **C.** Uniquement les clés, jamais les valeurs
- [ ] **D.** Seulement les valeurs « non sûres » (mots réservés, retours à la ligne, espaces...)

### Question 64

Quel flag force l'ajout de guillemets doubles à toutes les valeurs de chaîne ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_FORCE_QUOTES`
- [ ] **B.** `Yaml::DUMP_FORCE_DOUBLE_QUOTES_ON_VALUES`
- [ ] **C.** `Yaml::DUMP_QUOTE_ALL`
- [ ] **D.** `Yaml::DUMP_STRICT_QUOTES`

## Dumping Collection of Maps

### Question 65

Par défaut, comment le composant dump-t-il une collection de maps (ex. une liste d'objets) ? *(une seule bonne réponse)*

- [ ] **A.** Avec le tiret et la première clé sur la même ligne, systématiquement
- [ ] **B.** Sous forme d'un tableau JSON inline
- [ ] **C.** Sans aucun délimiteur visuel entre les éléments
- [ ] **D.** Avec un tiret sur une ligne séparée comme délimiteur

### Question 66

Quel flag produit une sortie plus compacte où le délimiteur est inclus dans la map (tiret et première clé sur la même ligne) ? *(une seule bonne réponse)*

- [ ] **A.** `Yaml::DUMP_INLINE_COLLECTION`
- [ ] **B.** `Yaml::DUMP_COMPACT`
- [ ] **C.** `Yaml::DUMP_COMPACT_NESTED_MAPPING`
- [ ] **D.** `Yaml::DUMP_COMPACT_MAPS`

## Syntax Validation

### Question 67

Quelle classe permet de valider la syntaxe d'un contenu YAML en CLI ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Yaml\Command\CheckCommand`
- [ ] **B.** `Symfony\Component\Yaml\Linter`
- [ ] **C.** `Symfony\Component\Yaml\Command\LintCommand`
- [ ] **D.** `Symfony\Component\Yaml\Command\ValidateCommand`

### Question 68

Quel composant supplémentaire faut-il installer pour utiliser `LintCommand` en CLI de façon autonome ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/process`
- [ ] **B.** `symfony/finder`
- [ ] **C.** `symfony/validator`
- [ ] **D.** `symfony/console`

### Question 69

Quelles sources de contenu la commande `lint:yaml` peut-elle valider ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un ou plusieurs fichiers passés en argument
- [ ] **B.** Tous les fichiers d'un ou plusieurs répertoires
- [ ] **C.** Un contenu passé via STDIN
- [ ] **D.** Uniquement des fichiers avec l'extension `.yml`, jamais `.yaml`

### Question 70

Quelle option permet d'exclure certains fichiers d'un répertoire lors du lint ? *(une seule bonne réponse)*

- [ ] **A.** `--without=path/to/file.yaml`
- [ ] **B.** `--exclude=path/to/file.yaml`
- [ ] **C.** `--ignore=path/to/file.yaml`
- [ ] **D.** `--skip=path/to/file.yaml`

### Question 71

Quelle option permet d'obtenir la sortie du lint au format JSON plutôt qu'en texte brut ? *(une seule bonne réponse)*

- [ ] **A.** `--as=json`
- [ ] **B.** `--format=json`
- [ ] **C.** `--output=json`
- [ ] **D.** `--json`

### Question 72

En plus des erreurs de syntaxe, que peut également signaler la commande de lint ? *(une seule bonne réponse)*

- [ ] **A.** Les doublons de clés uniquement
- [ ] **B.** Rien d'autre que la validité syntaxique stricte
- [ ] **C.** Les dépréciations présentes dans les fichiers YAML vérifiés
- [ ] **D.** Les vulnérabilités de sécurité connues

---

## Corrigé

**Question 1 : D** — « $ composer require symfony/yaml » *(§ Installation)*

**Question 2 : B** — « The Symfony Yaml component loads and dumps YAML files. It parses YAML strings into PHP arrays and can also convert PHP arrays back into YAML strings. » *(§ intro)*

**Question 3 : A, B, C** — « Notable lacking features are: document directives, multi-line quoted messages, compact block collections and multi-document files. » *(§ Why? — Fast)*

**Question 4 : D** — « It supports a real parser and is able to parse a large subset of the YAML specification (…) the parser is pretty robust, easy to understand, and simple enough to extend. » *(§ Why? — Real Parser)*

**Question 5 : B** — « the library outputs a helpful message with the filename and the line number where the problem occurred. » *(§ Why? — Clear Error Messages)*

**Question 6 : B** — « It is also able to dump PHP arrays to YAML with object support, and inline level configuration for pretty outputs. » *(§ Why? — Dump Support)*

**Question 7 : C** — « It supports most of the YAML built-in types like dates, integers, octal numbers, booleans, and much more... » *(§ Why? — Types Support)*

**Question 8 : B** — « Full support for references, aliases, and full merge key. Don't repeat yourself by referencing common configuration bits. » *(§ Why? — Full Merge Key Support)*

**Question 9 : A, B, C** — « The Symfony Yaml component consists of two main classes: one parses YAML strings (Parser), and the other dumps a PHP array to a YAML string (Dumper). On top of these two classes, the Yaml class acts as a thin wrapper. » *(§ Using the Symfony YAML Component)*

**Question 10 : D** — « the `Yaml` class acts as a thin wrapper that simplifies common uses. » *(§ Using the Symfony YAML Component)*

**Question 11 : D** — « The `Yaml::parse` method parses a YAML string and converts it to a PHP array. » *(§ Reading YAML Contents)*

**Question 12 : B** — « If an error occurs during parsing, the parser throws a `Symfony\Component\Yaml\Exception\ParseException` exception indicating the error type and the line in the original YAML string where the error occurred. » *(§ Reading YAML Contents)*

**Question 13 : B** — « $value = Yaml::parse("foo: bar"); // $value = ['foo' => 'bar'] » *(§ Reading YAML Contents)*

**Question 14 : D** — « The `Yaml::parseFile` method parses the YAML contents of the given file path and converts them to a PHP value. » *(§ Reading YAML Files)*

**Question 15 : D** — « If an error occurs during parsing, the parser throws a `ParseException` exception. » *(§ Reading YAML Files)*

**Question 16 : C** — « The `Yaml::dump` method dumps any PHP array to its YAML representation. » *(§ Writing YAML Files)*

**Question 17 : D** — « If an error occurs during the dump, the parser throws a `Symfony\Component\Yaml\Exception\DumpException` exception. » *(§ Writing YAML Files)*

**Question 18 : B** — « The YAML format supports two kind of representation for arrays, the expanded one, and the inline one. By default, the dumper uses the expanded representation. » *(§ Expanded and Inlined Arrays)*

**Question 19 : D** — « The second argument of the `Yaml::dump` method customizes the level at which the output switches from the expanded representation to the inline one. » *(§ Expanded and Inlined Arrays)*

**Question 20 : C** — « echo Yaml::dump($array, 1); » produit `bar: { foo: bar, bar: baz }` — le second argument est le niveau de bascule vers l'inline. *(§ Expanded and Inlined Arrays)*

**Question 21 : D** — « By default, the YAML component will use 4 spaces for indentation. » *(§ Indentation)*

**Question 22 : D** — « This can be changed using the third argument as follows: `echo Yaml::dump($array, 2, 8);` // uses 8 spaces for indentation. » *(§ Indentation)*

**Question 23 : C** — « YAML files allow adding underscores to improve their readability (…) there is not a limit in the number of underscores you can include or the way you group contents. » *(§ Numeric Literals)*

**Question 24 : D** — « During the parsing of the YAML contents, all the `_` characters are removed from the numeric literal contents. » *(§ Numeric Literals)*

**Question 25 : D** — « YAML anchors or aliases let one node reference another (`&anchor` and `*anchor`). » *(§ Parsing Untrusted YAML)*

**Question 26 : B** — « When a malicious document chains aliases that point at nested collections, resolving them produces exponential memory growth and can exhaust the process. » *(§ Parsing Untrusted YAML)*

**Question 27 : D** — « reject them outright with the `PARSE_EXCEPTION_ON_ALIAS` flag. » *(§ Parsing Untrusted YAML)*

**Question 28 : A, B** — « the parser enforces two limits by default: at most 128 nesting levels and at most 128 collection alias resolutions per document. » *(§ Parsing Untrusted YAML)*

**Question 29 : D** — « You can tune both with the optional arguments of `Yaml::parse()` and `Yaml::parseFile()` (…) The same arguments are available on the `Parser` constructor. » *(§ Parsing Untrusted YAML)*

**Question 30 : D** — « These limits make malicious documents harder to weaponize, but they are not a substitute for validating and constraining input received from untrusted sources. » *(§ Parsing Untrusted YAML)*

**Question 31 : C** — « You can dump objects by using the `DUMP_OBJECT` flag. » *(§ Object Parsing and Dumping)*

**Question 32 : D** — « And parse them by using the `PARSE_OBJECT` flag. » *(§ Object Parsing and Dumping)*

**Question 33 : B** — « The YAML component uses PHP's `serialize()` method to generate a string representation of the object. » *(§ Object Parsing and Dumping)*

**Question 34 : C** — « Object serialization is specific to this implementation, other PHP YAML parsers will likely not recognize the `php/object` tag and non-PHP implementations certainly won't. » *(§ Object Parsing and Dumping)*

**Question 35 : C** — « Parsing `!php/object` tags uses PHP deserialization internally. Never enable `PARSE_OBJECT` for untrusted YAML contents. » *(§ Object Parsing and Dumping)*

**Question 36 : D** — « You can dump objects as Yaml maps by using the `DUMP_OBJECT_AS_MAP` flag. » *(§ Parsing and Dumping Objects as Maps)*

**Question 37 : D** — « And parse them by using the `PARSE_OBJECT_FOR_MAP` flag. » *(§ Parsing and Dumping Objects as Maps)*

**Question 38 : C** — « The YAML component uses PHP's `(array)` casting to generate a string representation of the object as a map. » *(§ Parsing and Dumping Objects as Maps)*

**Question 39 : C** — « By default, the parser will encode invalid types as `null`. » *(§ Handling Invalid Types)*

**Question 40 : D** — « You can make the parser throw exceptions by using the `PARSE_EXCEPTION_ON_INVALID_TYPE` flag. » *(§ Handling Invalid Types)*

**Question 41 : D** — « Similarly you can use `DUMP_EXCEPTION_ON_INVALID_TYPE` when dumping. » *(§ Handling Invalid Types)*

**Question 42 : B** — « the YAML parser will convert unquoted strings which look like a date or a date-time into a Unix timestamp. » *(§ Date Handling)*

**Question 43 : D** — « You can make it convert to a `DateTime` instance by using the `PARSE_DATETIME` flag. » *(§ Date Handling)*

**Question 44 : A, B** — « for example `2016-05-27` or `2016-05-27T02:59:43.1Z` (ISO-8601) » *(§ Date Handling)*

**Question 45 : D** — « By default, the dumper will encode multiple lines as an inline string: `string: "Multiple\nLine\nString"`. » *(§ Dumping Multi-line Literal Blocks)*

**Question 46 : D** — « You can make it use a literal block with the `DUMP_MULTI_LINE_LITERAL_BLOCK` flag. » *(§ Dumping Multi-line Literal Blocks)*

**Question 47 : B** — « By default, the YAML parser treats the PHP constants included in the contents as regular strings. » *(§ Parsing PHP Constants)*

**Question 48 : D** — « Use the `PARSE_CONSTANT` flag and the special `!php/const` syntax to parse them as proper PHP constants. » *(§ Parsing PHP Constants)*

**Question 49 : B** — « Enabling `PARSE_CONSTANT` allows YAML contents to resolve arbitrary PHP constants and enum cases. Only enable it for trusted input. » *(§ Parsing PHP Constants)*

**Question 50 : A, B** — « The YAML parser supports PHP enumerations, both unit and backed enums. » *(§ Parsing PHP Enumerations)*

**Question 51 : C** — « Use the `PARSE_CONSTANT` flag and the special `!php/enum` syntax to parse them as proper PHP enums. » *(§ Parsing PHP Enumerations)*

**Question 52 : D** — « the value of the 'foo' key is a string because it missed the `!php/enum` syntax. » *(§ Parsing PHP Enumerations)*

**Question 53 : C** — « You can also use `!php/enum` to get all the enumeration cases by only giving the enumeration FQCN: `$parameters = ['bar' => ['foo', 'bar']];`. » *(§ Parsing PHP Enumerations)*

**Question 54 : D** — « Non UTF-8 encoded strings are dumped as base64 encoded data: `logo: !!binary iVBORw0KGgoAAAANSUhEUgAAA6oAAADqCAY...`. » *(§ Parsing and Dumping of Binary Data)*

**Question 55 : C** — « Binary data is automatically parsed if they include the `!!binary` YAML tag. » *(§ Parsing and Dumping of Binary Data)*

**Question 56 : D** — « you can define your own custom YAML tags and parse them with the `PARSE_CUSTOM_TAGS` flag. » *(§ Parsing and Dumping Custom Tags)*

**Question 57 : D** — « $parsed = Symfony\Component\Yaml\Tag\TaggedValue('my_tag', ['foo' => 'bar']); » *(§ Parsing and Dumping Custom Tags)*

**Question 58 : B** — « If the contents to dump contain `TaggedValue` objects, they are automatically transformed into YAML tags. » *(§ Parsing and Dumping Custom Tags)*

**Question 59 : B** — « This component uses `null` by default when dumping null values (…) $dumped = Yaml::dump(['foo' => null]); // foo: null » *(§ Dumping Null Values)*

**Question 60 : A, B** — « you can dump them as `~` with the `DUMP_NULL_AS_TILDE` flag (…) You can use the `DUMP_NULL_AS_EMPTY` flag to dump null values as empty strings. » *(§ Dumping Null Values)*

**Question 61 : C** — « By default, digit-only array keys are dumped as integers: `$dumped = Yaml::dump([200 => 'foo']); // 200: foo`. » *(§ Dumping Numeric Keys as Strings)*

**Question 62 : B** — « You can use the `DUMP_NUMERIC_KEY_AS_STRING` flag if you want to dump string-only keys. » *(§ Dumping Numeric Keys as Strings)*

**Question 63 : D** — « By default, only unsafe string values are enclosed in double quotes (for example, if they are reserved words or contain newlines and spaces). » *(§ Dumping Double Quotes on Values)*

**Question 64 : B** — « Use the `DUMP_FORCE_DOUBLE_QUOTES_ON_VALUES` flag to add double quotes to all string values. » *(§ Dumping Double Quotes on Values)*

**Question 65 : D** — « When the YAML component dumps collections of maps, it uses a hyphen on a separate line as a delimiter. » *(§ Dumping Collection of Maps)*

**Question 66 : C** — « To produce a more compact output where the delimiter is included within the map, use the `Yaml::DUMP_COMPACT_NESTED_MAPPING` flag. » *(§ Dumping Collection of Maps)*

**Question 67 : C** — « The syntax of YAML contents can be validated through the CLI using the `Symfony\Component\Yaml\Command\LintCommand` command. » *(§ Syntax Validation)*

**Question 68 : D** — « First, install the Console component: `$ composer require symfony/console`. » *(§ Syntax Validation)*

**Question 69 : A, B, C** — « validates a single file (…) or all the files in a directory (…) or contents passed to STDIN. » *(§ Syntax Validation)*

**Question 70 : B** — « you can also exclude one or more files from linting: `$ php lint.php path/to/directory --exclude=path/to/directory/foo.yaml`. » *(§ Syntax Validation)*

**Question 71 : B** — « Add the `--format` option to get the output in JSON format: `$ php lint.php path/to/file.yaml --format=json`. » *(§ Syntax Validation)*

**Question 72 : C** — « The linting command will also report any deprecations in the checked YAML files. » *(§ Syntax Validation)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [components/yaml.rst](https://github.com/symfony/symfony-docs/blob/8.0/components/yaml.rst)) : pas de pages annexes à couvrir pour ce QCM.
