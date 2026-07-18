# QCM — Le composant Uid (UUID/ULID)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/uid.html](https://symfony.com/doc/8.0/components/uid.html) · **Généré le :** 24 juillet 2026
>
> **73 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Quelle commande permet d'installer le composant Uid ? *(une seule bonne réponse)*

- [ ] **A.** `composer install symfony/uid`
- [ ] **B.** `npm install @symfony/uid`
- [ ] **C.** `composer require symfony/uid`
- [ ] **D.** `composer require symfony/uuid`

### Question 2

Que fournit le composant Uid ? *(une seule bonne réponse)*

- [ ] **A.** Un système de génération de tokens CSRF
- [ ] **B.** Un générateur de mots de passe sécurisés
- [ ] **C.** Un système de cache distribué basé sur des identifiants
- [ ] **D.** Des utilitaires pour travailler avec des identifiants uniques (UUID et ULID)

## UUIDs — vue d'ensemble

### Question 3

Sur combien de bits un UUID est-il représenté ? *(une seule bonne réponse)*

- [ ] **A.** 256 bits
- [ ] **B.** 128 bits
- [ ] **C.** 64 bits
- [ ] **D.** 32 bits

### Question 4

Un UUID est habituellement représenté sous quelle forme ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne base64 de 22 caractères
- [ ] **B.** Un entier 128 bits en notation décimale
- [ ] **C.** Quatre groupes de caractères séparés par des points
- [ ] **D.** Cinq groupes de caractères hexadécimaux séparés par des tirets (`xxxxxxxx-xxxx-Mxxx-Nxxx-xxxxxxxxxxxx`)

### Question 5

Dans le format `xxxxxxxx-xxxx-Mxxx-Nxxx-xxxxxxxxxxxx`, que représentent les digits `M` et `N` ? *(une seule bonne réponse)*

- [ ] **A.** `M` et `N` représentent tous deux le timestamp
- [ ] **B.** `M` est le nombre de bits, `N` est le format d'encodage
- [ ] **C.** `M` est la version de l'UUID, `N` est le variant de l'UUID
- [ ] **D.** `M` est le variant, `N` est la version

## UUID v1 (time-based)

### Question 6

Sur quoi se base la génération d'un UUID v1 ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un timestamp
- [ ] **B.** L'adresse MAC de l'appareil
- [ ] **C.** Le hash MD5 d'un nom et d'un namespace
- [ ] **D.** Une valeur aléatoire de 122 bits

### Question 7

Que recommande la documentation à la place de l'UUID v1 ? *(une seule bonne réponse)*

- [ ] **A.** UUID v3, car il est déterministe
- [ ] **B.** ULID, car il est plus court
- [ ] **C.** UUID v7, car il offre une meilleure entropie
- [ ] **D.** UUID v4, car il est plus simple à générer

## UUID v2 (DCE security)

### Question 8

Que peut-on dire de l'UUID v2 dans le composant Uid ? *(une seule bonne réponse)*

- [ ] **A.** Elle est l'implémentation par défaut de `UuidFactory`
- [ ] **B.** Cette variante n'est pas implémentée par le composant Uid
- [ ] **C.** Elle est implémentée mais dépréciée
- [ ] **D.** Elle nécessite l'extension PHP ext-uuid

## UUID v3 (name-based, MD5)

### Question 9

Comment est généré un UUID v3 ? *(une seule bonne réponse)*

- [ ] **A.** En hashant en SHA-1 la concaténation d'un namespace et d'un nom
- [ ] **B.** À partir d'un timestamp et d'une valeur aléatoire
- [ ] **C.** À partir de l'adresse MAC et d'un compteur
- [ ] **D.** En hashant en MD5 la concaténation d'un namespace et d'un nom

### Question 10

Quel est l'intérêt principal de l'UUID v3 ? *(une seule bonne réponse)*

- [ ] **A.** Maximiser l'entropie aléatoire
- [ ] **B.** Réduire la taille de l'UUID à 22 caractères
- [ ] **C.** Générer des UUID déterministes à partir de chaînes arbitraires
- [ ] **D.** Garantir un tri lexicographique

### Question 11

Parmi les constantes suivantes, lesquelles sont des namespaces UUID prédéfinis par le standard ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Uuid::NAMESPACE_DNS`
- [ ] **B.** `Uuid::NAMESPACE_URL`
- [ ] **C.** `Uuid::NAMESPACE_OID`
- [ ] **D.** `Uuid::NAMESPACE_HTTP`

## UUID v4 (random)

### Question 12

Quelles affirmations sur l'UUID v4 sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il est généré de façon aléatoire
- [ ] **B.** Il ne contient aucune information sur son lieu ou moment de génération (privacy-friendly)
- [ ] **C.** Il nécessite une entité de coordination centrale pour garantir l'unicité
- [ ] **D.** Il assure l'unicité dans des systèmes distribués sans coordination centrale

### Question 13

Quelle méthode statique génère un UUID v4 ? *(une seule bonne réponse)*

- [ ] **A.** `new Uuid(4)`
- [ ] **B.** `Uuid::v4()`
- [ ] **C.** `Uuid::random()`
- [ ] **D.** `Uuid::generate(4)`

## UUID v5 (name-based, SHA-1)

### Question 14

En quoi l'UUID v5 diffère-t-il de l'UUID v3 ? *(une seule bonne réponse)*

- [ ] **A.** Il utilise un timestamp au lieu d'un hash
- [ ] **B.** Il génère des UUID plus courts
- [ ] **C.** Il est déprécié au profit de l'UUID v3
- [ ] **D.** Il utilise SHA-1 au lieu de MD5 pour hasher le namespace et le nom

## UUID v6 (reordered time-based)

### Question 15

Que fait l'UUID v6 par rapport à l'UUID v1 ? *(une seule bonne réponse)*

- [ ] **A.** Il ajoute un hash MD5 du nom
- [ ] **B.** Il remplace le timestamp par une valeur aléatoire pure
- [ ] **C.** Il réordonne les champs temporels pour le rendre lexicographiquement triable
- [ ] **D.** Il supprime la dépendance à l'adresse MAC

### Question 16

Pourquoi l'UUID v6 est-il plus efficace pour l'indexation en base de données qu'un UUID v1 ou v4 classique ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'il est stocké en clair plutôt qu'en binaire
- [ ] **B.** Parce qu'il est lexicographiquement triable, comme les ULID
- [ ] **C.** Parce qu'il est plus court en octets
- [ ] **D.** Parce qu'il ne nécessite pas d'index du tout

## UUID v7 (UNIX timestamp)

### Question 17

Sur quoi se base la génération d'un UUID v7 ? *(une seule bonne réponse)*

- [ ] **A.** Un compteur incrémental stocké en base
- [ ] **B.** Un timestamp Unix Epoch en haute résolution (microsecondes)
- [ ] **C.** L'adresse MAC de l'appareil
- [ ] **D.** Un hash SHA-1 d'un namespace et d'un nom

### Question 18

Pourquoi recommande-t-on l'UUID v7 plutôt que v1 et v6 ? *(une seule bonne réponse)*

- [ ] **A.** Il est rétrocompatible avec les GUID Windows
- [ ] **B.** Il ne nécessite pas le composant Uid
- [ ] **C.** Il est plus court que les autres versions
- [ ] **D.** Il offre une meilleure entropie et un ordre chronologique plus strict

## UUID v8 (custom)

### Question 19

Que doit faire le développeur lorsqu'il utilise `Uuid::v8()` ? *(une seule bonne réponse)*

- [ ] **A.** Ne rien fournir, la valeur est générée automatiquement
- [ ] **B.** Fournir uniquement un timestamp
- [ ] **C.** Fournir un namespace et un nom
- [ ] **D.** Générer lui-même la valeur de l'UUID, en respectant uniquement les bits de version et de variant

### Question 20

À quoi sert l'UUID v8 ? *(une seule bonne réponse)*

- [ ] **A.** Un remplacement direct de l'UUID v4
- [ ] **B.** Un format réservé aux bases de données Doctrine
- [ ] **C.** Un format compatible RFC destiné à des cas d'usage expérimentaux ou spécifiques à un fournisseur
- [ ] **D.** Un format strictement standardisé sans aucune liberté d'implémentation

## Créer un UUID à partir d'une valeur existante

### Question 21

Quelles méthodes permettent de créer un objet `Uuid` à partir d'une valeur déjà générée dans un autre format ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Uuid::fromString()`
- [ ] **B.** `Uuid::fromBinary()`
- [ ] **C.** `Uuid::fromBase32()`
- [ ] **D.** `Uuid::fromJson()`

### Question 22

Quelle méthode est explicitement nommée pour créer un `Uuid` à partir d'un format RFC 4122 ? *(une seule bonne réponse)*

- [ ] **A.** `Uuid::fromStandard()`
- [ ] **B.** `Uuid::parse()`
- [ ] **C.** `Uuid::fromRfc4122()`
- [ ] **D.** `Uuid::fromString()`

## UuidFactory

### Question 23

Comment utilise-t-on `UuidFactory` dans un service ? *(une seule bonne réponse)*

- [ ] **A.** Il ne peut être utilisé que dans les contrôleurs
- [ ] **B.** En l'injectant via le constructeur du service (autowiring)
- [ ] **C.** En appelant une méthode statique `Uuid::factory()`
- [ ] **D.** En le récupérant depuis une variable globale `$GLOBALS['uuid_factory']`

### Question 24

Par défaut, quelle version d'UUID `UuidFactory` génère-t-il pour `create()` et pour les UUID basés sur le temps ? *(une seule bonne réponse)*

- [ ] **A.** UUIDv4
- [ ] **B.** UUIDv6
- [ ] **C.** UUIDv1
- [ ] **D.** UUIDv7

### Question 25

Par défaut, quelle version d'UUID `UuidFactory` utilise-t-il pour les UUID nommés (name-based) ? *(une seule bonne réponse)*

- [ ] **A.** UUIDv3
- [ ] **B.** UUIDv4
- [ ] **C.** UUIDv7
- [ ] **D.** UUIDv5

### Question 26

Par défaut, quelle version `UuidFactory` utilise-t-il pour les UUID aléatoires (random-based) ? *(une seule bonne réponse)*

- [ ] **A.** UUIDv6
- [ ] **B.** UUIDv1
- [ ] **C.** UUIDv4
- [ ] **D.** UUIDv7

### Question 27

Quelles options de configuration de `UuidFactory` peut-on définir dans `config/packages/uid.yaml` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `default_uuid_version`
- [ ] **B.** `name_based_uuid_version`
- [ ] **C.** `time_based_uuid_node`
- [ ] **D.** `doctrine_uuid_type`

## Convertir des UUID

### Question 28

Laquelle de ces méthodes convertit un `Uuid` en chaîne encodée en base 58 ? *(une seule bonne réponse)*

- [ ] **A.** `$uuid->toBase32()`
- [ ] **B.** `$uuid->toBinary()`
- [ ] **C.** `$uuid->toHex()`
- [ ] **D.** `$uuid->toBase58()`

### Question 29

Quelles méthodes de conversion existent sur un objet `Uuid` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `toBinary()`
- [ ] **B.** `toRfc4122()`
- [ ] **C.** `toHex()`
- [ ] **D.** `toJson()`

### Question 30

Quel est le format de sortie de la méthode `toString()` (et de la conversion implicite en chaîne) d'un `Uuid` ? *(une seule bonne réponse)*

- [ ] **A.** Le format hexadécimal préfixé par `0x`
- [ ] **B.** Le format canonique RFC 4122 (36 caractères avec tirets)
- [ ] **C.** Le format base32 (26 caractères)
- [ ] **D.** Le format binaire (16 octets)

## Convertir entre versions d'UUID

### Question 31

Quelles conversions entre versions d'UUID sont possibles avec les méthodes `toV6()`/`toV7()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Convertir un UUID v1 vers v6
- [ ] **B.** Convertir un UUID v1 vers v7
- [ ] **C.** Convertir un UUID v6 vers v7
- [ ] **D.** Convertir un UUID v4 vers v7

### Question 32

Que retourne `$uuid->toV7()` appelé sur un `UuidV1` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception, car la conversion n'est pas supportée
- [ ] **B.** Une instance de `Symfony\Component\Uid\UuidV7`
- [ ] **C.** Une chaîne de caractères au format RFC 4122
- [ ] **D.** Une instance de `Ulid`

## Travailler avec les UUID

### Question 33

Comment vérifie-t-on qu'un `Uuid` est un UUID nul ? *(une seule bonne réponse)*

- [ ] **A.** `$uuid->isNull()`
- [ ] **B.** `Uuid::isNull($uuid)`
- [ ] **C.** `$uuid instanceof NilUuid`
- [ ] **D.** `$uuid instanceof NullUuid`

### Question 34

Pourquoi la classe s'appelle-t-elle `NilUuid` et non `NullUuid` ? *(une seule bonne réponse)*

- [ ] **A.** C'est une erreur historique dans le composant, corrigée dans une version future
- [ ] **B.** Parce que « Null » est un mot réservé en PHP
- [ ] **C.** Pour suivre la notation standard des UUID (« nil UUID »)
- [ ] **D.** Pour éviter un conflit avec une classe native PHP

### Question 35

Quelle méthode retourne un `\DateTimeImmutable` à partir d'un UUID (quand la version le permet) ? *(une seule bonne réponse)*

- [ ] **A.** `$uuid->getTimestamp()`
- [ ] **B.** `$uuid->toDateTime()`
- [ ] **C.** `$uuid->extractDate()`
- [ ] **D.** `$uuid->getDateTime()`

### Question 36

Que retourne la méthode `compare()` entre deux UUID ? *(une seule bonne réponse)*

- [ ] **A.** Toujours 0, sauf en cas d'erreur
- [ ] **B.** `int(0)` si égaux, un entier positif si le premier est plus grand, négatif s'il est plus petit
- [ ] **C.** Un booléen indiquant l'égalité
- [ ] **D.** Une chaîne décrivant la différence

### Question 37

Quelle méthode permet de vérifier qu'une valeur donnée est un UUID valide ? *(une seule bonne réponse)*

- [ ] **A.** `Uuid::check()`
- [ ] **B.** `$uuid->isValid()`
- [ ] **C.** `Uuid::isValid()`
- [ ] **D.** `Uuid::validate()`

## Constantes de format

### Question 38

Par défaut, quel(s) format(s) `Uuid::isValid()` accepte-t-il si le paramètre `$format` n'est pas précisé ? *(une seule bonne réponse)*

- [ ] **A.** Tous les formats (`FORMAT_ALL`)
- [ ] **B.** Uniquement base32 et base58
- [ ] **C.** Uniquement le format binaire
- [ ] **D.** Uniquement le format RFC 4122

### Question 39

Quelles constantes de format existent sur la classe `Uuid` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Uuid::FORMAT_BINARY`
- [ ] **B.** `Uuid::FORMAT_BASE_32`
- [ ] **C.** `Uuid::FORMAT_BASE_58`
- [ ] **D.** `Uuid::FORMAT_JSON`

### Question 40

Comment accepter plusieurs formats à la fois avec `Uuid::isValid()` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `isValid()` plusieurs fois et en faisant un ET logique
- [ ] **B.** En combinant les constantes avec l'opérateur bit à bit OR (`|`)
- [ ] **C.** En passant un tableau de constantes
- [ ] **D.** Ce n'est pas possible, un seul format à la fois

## Stocker des UUID en base de données

### Question 41

Quel type Doctrine permet de convertir automatiquement une colonne en objets `Uuid` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de type dédié, il faut le faire manuellement
- [ ] **B.** Le type `uuid` (`Symfony\Bridge\Doctrine\Types\UuidType`)
- [ ] **C.** Le type `string` standard de Doctrine
- [ ] **D.** Le type `binary` natif sans conversion

### Question 42

Que se passe-t-il si l'on utilise directement `UuidGenerator::class` comme `#[ORM\CustomIdGenerator]` ? *(une seule bonne réponse)*

- [ ] **A.** Cela utilise automatiquement la version configurée dans `config/packages/uid.yaml`
- [ ] **B.** Cela lève une exception au démarrage de l'application
- [ ] **C.** Cela force l'utilisation d'UUID v4 quelle que soit la configuration
- [ ] **D.** Cela crée une nouvelle instance de générateur et contourne le service `doctrine.uuid_generator`, ignorant la version configurée dans FrameworkBundle

### Question 43

Comment configurer l'entité Doctrine pour qu'elle utilise le service générateur de Symfony (respectant la version configurée) ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant `#[ORM\CustomIdGenerator(class: UuidGenerator::class)]`
- [ ] **B.** En définissant `strategy: 'AUTO'`
- [ ] **C.** Ce n'est pas configurable, il faut générer l'UUID manuellement dans le constructeur
- [ ] **D.** En utilisant `#[ORM\CustomIdGenerator('doctrine.uuid_generator')]`

### Question 44

Pourquoi utiliser des UUID comme clés primaires est-il déconseillé pour des raisons de performance ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les index sont plus lents et prennent plus de place (128 bits vs 32/64 bits)
- [ ] **B.** La nature non séquentielle des UUID fragmente les index
- [ ] **C.** Les UUID ne peuvent pas être indexés du tout
- [ ] **D.** Doctrine ne supporte pas nativement les UUID en clé primaire

### Question 45

Quelles versions d'UUID résolvent le problème de fragmentation d'index (mais pas le problème de taille) ? *(plusieurs bonnes réponses)*

- [ ] **A.** UUID v6
- [ ] **B.** UUID v7
- [ ] **C.** UUID v4
- [ ] **D.** UUID v1

### Question 46

Lors de l'utilisation des méthodes de repository intégrées de Doctrine (ex : `findOneBy()`), comment Doctrine gère-t-il la conversion des types UUID ? *(une seule bonne réponse)*

- [ ] **A.** Il faut passer par une DQL manuelle dans tous les cas
- [ ] **B.** Doctrine sait automatiquement convertir ces types pour construire la requête SQL
- [ ] **C.** Il faut systématiquement convertir en `toBinary()` avant l'appel
- [ ] **D.** `findOneBy()` ne supporte pas les colonnes de type UUID

### Question 47

Lors de la construction d'une requête DQL avec un paramètre UUID via `setParameter()`, que doit-on préciser ? *(une seule bonne réponse)*

- [ ] **A.** Il faut obligatoirement passer par `toBinary()` et `ParameterType::BINARY`, aucune autre option n'existe
- [ ] **B.** Le nom de la colonne uniquement
- [ ] **C.** Le type `uuid` comme troisième argument (ex : `UuidType::NAME`)
- [ ] **D.** Rien, Doctrine détecte automatiquement le type

## Tester les UUID

### Question 48

Quelle classe permet de contrôler les UUID générés pendant les tests pour les rendre prévisibles ? *(une seule bonne réponse)*

- [ ] **A.** `TestUuidFactory`
- [ ] **B.** `UuidStub`
- [ ] **C.** `MockUuidFactory`
- [ ] **D.** `FakeUuidFactory`

### Question 49

Quelles méthodes de `UuidFactory` `MockUuidFactory` sait-il également mocker, en plus de `create()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `randomBased()`
- [ ] **B.** `timeBased()`
- [ ] **C.** `nameBased()`
- [ ] **D.** `customBased()`

### Question 50

Que se passe-t-il si la séquence fournie à `MockUuidFactory` est épuisée ou si le type demandé ne correspond pas ? *(une seule bonne réponse)*

- [ ] **A.** La séquence recommence depuis le début
- [ ] **B.** Un warning est loggé mais un UUID aléatoire est retourné
- [ ] **C.** Une exception est levée
- [ ] **D.** Un UUID nul (`NilUuid`) est retourné

## ULIDs — vue d'ensemble

### Question 51

Sur combien de caractères un ULID est-il habituellement représenté ? *(une seule bonne réponse)*

- [ ] **A.** 32 caractères
- [ ] **B.** 22 caractères
- [ ] **C.** 26 caractères
- [ ] **D.** 36 caractères

### Question 52

Que représentent les parties `T` et `R` dans le format `TTTTTTTTTTRRRRRRRRRRRRRRRR` d'un ULID ? *(une seule bonne réponse)*

- [ ] **A.** `T` = tag, `R` = résultat
- [ ] **B.** `T` = timestamp, `R` = bits aléatoires
- [ ] **C.** `T` = type, `R` = région
- [ ] **D.** `T` = table, `R` = référence

### Question 53

Que se passe-t-il si plusieurs ULID sont générés durant la même milliseconde dans le même processus ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée
- [ ] **B.** Le composant attend la milliseconde suivante
- [ ] **C.** Les ULID générés sont strictement identiques
- [ ] **D.** La portion aléatoire est incrémentée d'un bit pour garantir la monotonicité

## Générer des ULID

### Question 54

Comment génère-t-on un ULID aléatoire avec la classe `Ulid` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `Ulid::v4()`
- [ ] **B.** En appelant `Ulid::random()`
- [ ] **C.** En appelant `Ulid::generate()`
- [ ] **D.** En instanciant `new Ulid()`

### Question 55

Quelles méthodes permettent de créer un objet `Ulid` à partir d'une valeur déjà générée ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Ulid::fromString()`
- [ ] **B.** `Ulid::fromBinary()`
- [ ] **C.** `Ulid::fromBase58()`
- [ ] **D.** `Ulid::fromJson()`

### Question 56

Quel avantage les ULID ont-ils par rapport aux UUID classiques en termes de format ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont plus courts en tout format, y compris en binaire
- [ ] **B.** Ils ne nécessitent aucune conversion en base de données
- [ ] **C.** Ils sont toujours plus rapides à générer
- [ ] **D.** Ils sont lexicographiquement triables et encodés sur 26 caractères au lieu de 36

### Question 57

Quelle classe spéciale représente une valeur ULID « null » ? *(une seule bonne réponse)*

- [ ] **A.** `ZeroUlid`
- [ ] **B.** `NilUlid`
- [ ] **C.** `NullUlid`
- [ ] **D.** `EmptyUlid`

## UlidFactory

### Question 58

Comment utilise-t-on `UlidFactory` dans un service ? *(une seule bonne réponse)*

- [ ] **A.** `UlidFactory` n'existe pas, seule la classe `Ulid` peut être utilisée directement
- [ ] **B.** Via une façade statique `Ulid::factory()`
- [ ] **C.** En l'injectant via le constructeur (autowiring), comme `UuidFactory`
- [ ] **D.** En héritant d'une classe abstraite `AbstractUlidService`

## Convertir des ULID

### Question 59

Quelle méthode convertit un `Ulid` en représentation hexadécimale ? *(une seule bonne réponse)*

- [ ] **A.** `$ulid->toHexadecimal()`
- [ ] **B.** `$ulid->toBase16()`
- [ ] **C.** `$ulid->toHexString()`
- [ ] **D.** `$ulid->toHex()`

### Question 60

Quelles méthodes de conversion existent sur un objet `Ulid` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `toBinary()`
- [ ] **B.** `toBase32()`
- [ ] **C.** `toRfc4122()`
- [ ] **D.** `toJson()`

## Travailler avec les ULID

### Question 61

Quelle méthode retourne le `\DateTimeImmutable` encodé dans un ULID ? *(une seule bonne réponse)*

- [ ] **A.** `$ulid->extractDateTime()`
- [ ] **B.** `$ulid->toDateTime()`
- [ ] **C.** `$ulid->getDateTime()`
- [ ] **D.** `$ulid->getTimestamp()`

### Question 62

Que retourne `$ulid1->compare($ulid2)` ? *(une seule bonne réponse)*

- [ ] **A.** Un booléen indiquant si `$ulid1` est plus récent
- [ ] **B.** La différence en millisecondes entre les deux timestamps
- [ ] **C.** Toujours `0` si les deux ULID sont valides
- [ ] **D.** L'équivalent de `$ulid1 <=> $ulid2`

### Question 63

Comment vérifie-t-on qu'une valeur donnée est un ULID valide ? *(une seule bonne réponse)*

- [ ] **A.** `Ulid::check()`
- [ ] **B.** `Ulid::isValid()`
- [ ] **C.** `Ulid::validate()`
- [ ] **D.** `$ulid->isValid()`

## Stocker des ULID en base de données

### Question 64

Quel type Doctrine permet de convertir automatiquement une colonne en objets `Ulid` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas de type dédié
- [ ] **B.** Le type `ulid` (`Symfony\Bridge\Doctrine\Types\UlidType`)
- [ ] **C.** Le type `uuid`, car ULID et UUID partagent le même type Doctrine
- [ ] **D.** Le type `string` standard

### Question 65

Pourquoi l'utilisation des ULID comme clés primaires reste-t-elle déconseillée pour la performance, malgré leur nature séquentielle ? *(une seule bonne réponse)*

- [ ] **A.** Ils ne sont pas supportés par les moteurs SQL classiques
- [ ] **B.** Doctrine ne peut pas générer d'index sur une colonne ULID
- [ ] **C.** Leurs index sont plus lents et prennent plus de place car ils occupent 128 bits en binaire au lieu de 32/64 bits
- [ ] **D.** Ils souffrent toujours de fragmentation d'index comme les UUID v4

### Question 66

Contrairement aux UUID, les ULID en clé primaire évitent quel problème de performance ? *(une seule bonne réponse)*

- [ ] **A.** Le besoin de conversion en binaire
- [ ] **B.** La fragmentation d'index (car les valeurs sont séquentielles)
- [ ] **C.** Le problème de taille des index
- [ ] **D.** Le besoin d'un générateur dédié

### Question 67

Comment précise-t-on le type d'un paramètre ULID dans une requête DQL construite via `QueryBuilder` ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `toRfc4122()` avant de le passer en paramètre, seule méthode possible
- [ ] **B.** `Ulid` ne peut pas être utilisé dans une clause `WHERE`
- [ ] **C.** En passant `UlidType::NAME` comme troisième argument de `setParameter()`
- [ ] **D.** Doctrine détecte automatiquement le type ULID sans configuration

## Commandes console

### Question 68

Les commandes de génération/inspection d'UUID et ULID sont-elles activées par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Non, elles nécessitent un bundle supplémentaire (`symfony/uid-console`)
- [ ] **B.** Oui, mais uniquement en environnement dev
- [ ] **C.** Non, il faut les déclarer explicitement comme services dans la configuration
- [ ] **D.** Oui, elles sont activées automatiquement dès l'installation du composant

### Question 69

Quelles classes de commandes doit-on déclarer comme services pour utiliser les commandes UID en console ? *(plusieurs bonnes réponses)*

- [ ] **A.** `GenerateUlidCommand`
- [ ] **B.** `GenerateUuidCommand`
- [ ] **C.** `InspectUuidCommand`
- [ ] **D.** `ConvertUuidCommand`

### Question 70

Quelle commande permet de générer un UUID random-based ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console uuid:random`
- [ ] **B.** `php bin/console uid:generate:uuid --random`
- [ ] **C.** `php bin/console uuid:new --type=random`
- [ ] **D.** `php bin/console uuid:generate --random-based`

### Question 71

Quelle commande permet de générer un ULID avec un timestamp spécifique ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console ulid:generate --timestamp="2021-02-02 14:00:00"`
- [ ] **B.** `php bin/console ulid:new --at="2021-02-02 14:00:00"`
- [ ] **C.** Ce n'est pas possible, le timestamp est toujours celui de l'exécution
- [ ] **D.** `php bin/console ulid:generate --time="2021-02-02 14:00:00"`

### Question 72

Que permet de faire la commande `uuid:inspect` ? *(une seule bonne réponse)*

- [ ] **A.** Valider la signature cryptographique d'un UUID
- [ ] **B.** Afficher toutes les informations d'un UUID donné (version, formats canonique/base58/base32…)
- [ ] **C.** Générer un nouvel UUID à partir d'un UUID existant
- [ ] **D.** Supprimer un UUID d'une base de données

### Question 73

Quelle information supplémentaire est affichée par `ulid:inspect` par rapport à `uuid:inspect` (dans l'exemple de sortie de la documentation) ? *(une seule bonne réponse)*

- [ ] **A.** La version de l'ULID
- [ ] **B.** L'adresse MAC utilisée
- [ ] **C.** Le variant de l'ULID
- [ ] **D.** Le Timestamp décodé (date et heure)

---

## Corrigé

**Question 1 : C** — « $ composer require symfony/uid » *(§ Installation)*

**Question 2 : D** — « The UID component provides utilities to work with unique identifiers (UIDs) such as UUIDs and ULIDs. » *(§ intro)*

**Question 3 : B** — « UUIDs (...) are 128-bit numbers » *(§ UUIDs)*

**Question 4 : D** — « usually represented as five groups of hexadecimal characters: `xxxxxxxx-xxxx-Mxxx-Nxxx-xxxxxxxxxxxx` » *(§ UUIDs)*

**Question 5 : C** — « the `M` digit is the UUID version and the `N` digit is the UUID variant » *(§ UUIDs)*

**Question 6 : A, B** — « Generates the UUID using a timestamp and the MAC address of your device » *(§ Generating UUIDs — UUID v1)*

**Question 7 : C** — « It's recommended to use UUIDv7 instead of UUIDv1 because it provides better entropy. » *(§ Generating UUIDs — UUID v1)*

**Question 8 : B** — « This UUID variant is **not implemented** by the Uid component. » *(§ Generating UUIDs — UUID v2)*

**Question 9 : D** — « It works by populating the UUID contents with the `md5` hash of concatenating the namespace and the name » *(§ Generating UUIDs — UUID v3)*

**Question 10 : C** — « This variant is useful to generate deterministic UUIDs from arbitrary strings. » *(§ Generating UUIDs — UUID v3)*

**Question 11 : A, B, C** — « `Uuid::NAMESPACE_DNS` (...) `Uuid::NAMESPACE_URL` (...) `Uuid::NAMESPACE_OID` (...) `Uuid::NAMESPACE_X500` » — quatre namespaces prédéfinis, pas de `NAMESPACE_HTTP`. *(§ Generating UUIDs — UUID v3)*

**Question 12 : A, B, D** — « Generates a random UUID (...) it ensures uniqueness across distributed systems without the need for a central coordinating entity. It's privacy-friendly because it doesn't contain any information about where and when it was generated. » *(§ Generating UUIDs — UUID v4)*

**Question 13 : B** — « $uuid = Uuid::v4(); » *(§ Generating UUIDs — UUID v4)*

**Question 14 : D** — « It's the same as UUIDv3 (...) but it uses `sha1` instead of `md5` » *(§ Generating UUIDs — UUID v5)*

**Question 15 : C** — « It rearranges the time-based fields of the UUIDv1 to make it lexicographically sortable » *(§ Generating UUIDs — UUID v6)*

**Question 16 : B** — « It's more efficient for database indexing » — car lexicographiquement triable, comme les ULID. *(§ Generating UUIDs — UUID v6)*

**Question 17 : B** — « Generates time-ordered UUIDs based on a high-resolution Unix Epoch timestamp source (the number of microseconds since midnight 1 Jan 1970 UTC...) » *(§ Generating UUIDs — UUID v7)*

**Question 18 : D** — « It's recommended to use this version over UUIDv1 and UUIDv6 because it provides better entropy (and a more strict chronological order of UUID generation) » *(§ Generating UUIDs — UUID v7)*

**Question 19 : D** — « You must generate the UUID value yourself. The only requirement is to set the variant and version bits of the UUID correctly. » *(§ Generating UUIDs — UUID v8)*

**Question 20 : C** — « Provides an RFC-compatible format intended for experimental or vendor-specific use cases » *(§ Generating UUIDs — UUID v8)*

**Question 21 : A, B, C** — « `Uuid::fromString(...)` (...) `Uuid::fromBinary(...)` (...) `Uuid::fromBase32(...)` (...) `Uuid::fromBase58(...)` (...) `Uuid::fromRfc4122(...)` » *(§ Generating UUIDs)*

**Question 22 : C** — « $uuid = Uuid::fromRfc4122('d9e7a184-5d5b-11ea-a62a-3499710062d0'); » *(§ Generating UUIDs)*

**Question 23 : B** — « You can also use the `UuidFactory` to generate UUIDs. Inject the factory in your services and use it as follows » *(§ Generating UUIDs — UuidFactory)*

**Question 24 : D** — « Default and time-based UUIDs: UUIDv7 » *(§ Generating UUIDs — UuidFactory)*

**Question 25 : D** — « Name-based UUIDs: UUIDv5 » *(§ Generating UUIDs — UuidFactory)*

**Question 26 : C** — « Random-based UUIDs: UUIDv4 » *(§ Generating UUIDs — UuidFactory)*

**Question 27 : A, B, C** — « `default_uuid_version` (...) `name_based_uuid_version` (...) `name_based_uuid_namespace` (...) `time_based_uuid_version` (...) `time_based_uuid_node` » *(§ Generating UUIDs — UuidFactory)*

**Question 28 : D** — « $uuid->toBase58(); // string(22) "TuetYWNHhmuSQ3xPoVLv9M" » *(§ Converting UUIDs)*

**Question 29 : A, B, C** — « $uuid->toBinary(); (...) $uuid->toBase32(); (...) $uuid->toBase58(); (...) $uuid->toRfc4122(); (...) $uuid->toHex(); (...) $uuid->toString(); » *(§ Converting UUIDs)*

**Question 30 : B** — « $uuid->toString(); // string(36) "d9e7a184-5d5b-11ea-a62a-3499710062d0" » *(§ Converting UUIDs)*

**Question 31 : A, B, C** — « // convert V1 to V6 or V7 (...) // convert V6 to V7 » — pas de conversion documentée depuis V4. *(§ Converting UUIDs)*

**Question 32 : B** — « $uuid->toV7(); // returns a Symfony\Component\Uid\UuidV7 instance » *(§ Converting UUIDs)*

**Question 33 : C** — « $uuid instanceof NilUuid; // false » *(§ Working with UUIDs)*

**Question 34 : C** — « note that the class is called `NilUuid` instead of `NullUuid` to follow the UUID standard notation » *(§ Working with UUIDs)*

**Question 35 : D** — « $uuid->getDateTime(); // returns a \DateTimeImmutable instance » *(§ Working with UUIDs)*

**Question 36 : B** — « this method returns: int(0) if $uuid1 and $uuid4 are equal, int > 0 if $uuid1 is greater than $uuid4, int < 0 if $uuid1 is less than $uuid4 » *(§ Working with UUIDs)*

**Question 37 : C** — « $isValid = Uuid::isValid($uuid); // true or false » *(§ Working with UUIDs)*

**Question 38 : D** — « By default, only the RFC 4122 format is accepted. » *(§ Working with UUIDs)*

**Question 39 : A, B, C** — « `Uuid::FORMAT_BINARY` (...) `Uuid::FORMAT_BASE_32` (...) `Uuid::FORMAT_BASE_58` (...) `Uuid::FORMAT_RFC_4122` (...) `Uuid::FORMAT_RFC_9562` » *(§ Working with UUIDs)*

**Question 40 : B** — « Uuid::isValid('...', Uuid::FORMAT_BASE_32 | Uuid::FORMAT_BASE_58); // accept multiple formats » *(§ Working with UUIDs)*

**Question 41 : B** — « consider using the `uuid` Doctrine type, which converts to/from UUID objects automatically » *(§ Storing UUIDs in Databases)*

**Question 42 : D** — « Using `UuidGenerator::class` to generate UUID values creates a new generator instance and bypasses Symfony's `doctrine.uuid_generator` service. This means the UUID version configured in FrameworkBundle (...) is ignored. » *(§ Storing UUIDs in Databases)*

**Question 43 : D** — « Instead, configure the Doctrine entity to use Symfony's generator service: `#[ORM\CustomIdGenerator('doctrine.uuid_generator')]` » *(§ Storing UUIDs in Databases)*

**Question 44 : A, B** — « indexes are slower and take more space (...) and the non-sequential nature of UUIDs fragments indexes » *(§ Storing UUIDs in Databases)*

**Question 45 : A, B** — « UUID v6 and UUID v7 are the only variants that solve the fragmentation issue (but the index size issue remains). » *(§ Storing UUIDs in Databases)*

**Question 46 : B** — « Doctrine knows how to convert these UUID types to build the SQL query » *(§ Storing UUIDs in Databases)*

**Question 47 : C** — « add `UuidType::NAME` as the third argument to tell Doctrine that this is a UUID » *(§ Storing UUIDs in Databases)*

**Question 48 : C** — « The `Symfony\Component\Uid\Factory\MockUuidFactory` class allows you to control the UUIDs generated during your tests, making them predictable and reproducible. » *(§ Testing UUIDs)*

**Question 49 : A, B, C** — « In addition to the `create()` method, the `MockUuidFactory` also works for the `randomBased()`, `timeBased()`, and `nameBased()` methods. » *(§ Testing UUIDs)*

**Question 50 : C** — « `MockUuidFactory` throws an exception if the sequence is exhausted or the available UUID types don't match the requested type. » *(§ Testing UUIDs)*

**Question 51 : C** — « ULIDs (...) are 128-bit numbers usually represented as a 26-character string » *(§ ULIDs)*

**Question 52 : B** — « `TTTTTTTTTTRRRRRRRRRRRRRRRR` (where `T` represents a timestamp and `R` represents the random bits) » *(§ ULIDs)*

**Question 53 : D** — « If you generate more than one ULID during the same millisecond in the same process then the random portion is incremented by one bit in order to provide monotonicity for sorting. » *(§ ULIDs)*

**Question 54 : D** — « $ulid = new Ulid();  // e.g. 01AN4Z07BY79KA1307SR9X4MV3 » *(§ Generating ULIDs)*

**Question 55 : A, B, C** — « `Ulid::fromString(...)` (...) `Ulid::fromBinary(...)` (...) `Ulid::fromBase32(...)` (...) `Ulid::fromBase58(...)` (...) `Ulid::fromRfc4122(...)` » *(§ Generating ULIDs)*

**Question 56 : D** — « they are lexicographically sortable and they are encoded as 26-character strings (vs 36-character UUIDs) » *(§ ULIDs)*

**Question 57 : B** — « There's also a special `NilUlid` class to represent ULID `null` values » *(§ Generating ULIDs)*

**Question 58 : C** — « Like UUIDs, ULIDs have their own factory, `UlidFactory`, that can be used to generate them » *(§ Generating ULIDs)*

**Question 59 : D** — « $ulid->toHex();  // string(34) "0x0171069d593d97d38b3e23d06de5b308" » *(§ Converting ULIDs)*

**Question 60 : A, B, C** — « $ulid->toBinary(); (...) $ulid->toBase32(); (...) $ulid->toBase58(); (...) $ulid->toRfc4122(); (...) $ulid->toHex(); » *(§ Converting ULIDs)*

**Question 61 : C** — « $ulid1->getDateTime(); // returns a \DateTimeImmutable instance » *(§ Working with ULIDs)*

**Question 62 : D** — « this method returns $ulid1 <=> $ulid2 » *(§ Working with ULIDs)*

**Question 63 : B** — « $isValid = Ulid::isValid($ulidValue); // true or false » *(§ Working with ULIDs)*

**Question 64 : B** — « consider using the `ulid` Doctrine type, which converts to/from ULID objects automatically » *(§ Storing ULIDs in Databases)*

**Question 65 : C** — « their indexes are slower and take more space (because ULIDs in binary format take 128 bits instead of 32/64 bits for auto-incremental integers) » *(§ Storing ULIDs in Databases)*

**Question 66 : B** — « ULIDs don't suffer from index fragmentation issues (because the values are sequential) » *(§ Storing ULIDs in Databases)*

**Question 67 : C** — « add `UlidType::NAME` as the third argument to tell Doctrine that this is a ULID » *(§ Storing ULIDs in Databases)*

**Question 68 : C** — « They are not enabled by default, so you must add the following configuration in your application before using these commands » *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

**Question 69 : A, B, C** — « `Symfony\Component\Uid\Command\GenerateUlidCommand` (...) `GenerateUuidCommand` (...) `InspectUlidCommand` (...) `InspectUuidCommand` » *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

**Question 70 : D** — « $ php bin/console uuid:generate --random-based » *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

**Question 71 : D** — « $ php bin/console ulid:generate --time="2021-02-02 14:00:00" » *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

**Question 72 : B** — « $ php bin/console uuid:inspect d0a3a023-f515-4fe0-915c-575e63693998 » — affiche Version, Canonical (RFC 4122), Base 58, Base 32. *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

**Question 73 : D** — « $ php bin/console ulid:inspect 01F2TTCSYK1PDRH73Z41BN1C4X » — la sortie ajoute une ligne Timestamp (`2021-04-09 08:01:24.947`), absente de `uuid:inspect`. *(§ Generating and Inspecting UUIDs/ULIDs in the Console)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [components/uid.rst](https://github.com/symfony/symfony-docs/blob/8.0/components/uid.rst)) : pas de pages annexes à couvrir pour ce QCM.
