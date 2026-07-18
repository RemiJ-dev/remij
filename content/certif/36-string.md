# QCM — Le composant String (chaînes et Unicode)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/string.html](https://symfony.com/doc/8.0/components/string.html) · **Généré le :** 23 juillet 2026
>
> **78 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

> **Remarque :** malgré l'URL `components/string.html`, le fichier source vit à la racine du dépôt (`string.rst`), pas dans `components/`.

## What is a String?

### Question 1

Pourquoi des langues comme l'anglais peuvent-elles être encodées avec des standards aussi limités que l'ASCII ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'elles n'utilisent aucun caractère spécial
- [ ] **B.** Parce qu'elles nécessitent un ensemble très limité de caractères et de symboles pour afficher leur contenu
- [ ] **C.** Parce qu'elles n'ont pas de notion de « grapheme cluster »
- [ ] **D.** Parce qu'elles sont plus anciennes que l'Unicode

### Question 2

Qu'est-ce qu'un « code point » ? *(une seule bonne réponse)*

- [ ] **A.** Un caractère affiché à l'écran, toujours identique à un octet
- [ ] **B.** Une séquence de plusieurs octets représentant toujours un seul caractère visible
- [ ] **C.** Un identifiant de police de caractères
- [ ] **D.** L'unité atomique d'information : un nombre dont la signification est donnée par le standard Unicode

### Question 3

Qu'est-ce qu'un « grapheme cluster » ? *(une seule bonne réponse)*

- [ ] **A.** Une séquence d'un ou plusieurs code points affichée comme une seule unité graphique
- [ ] **B.** Un synonyme strict de « byte »
- [ ] **C.** Un caractère ASCII unique, par définition
- [ ] **D.** Un ensemble de polices Unicode compatibles

### Question 4

Dans l'exemple de la lettre espagnole « ñ », combien de code points composent ce grapheme cluster ? *(une seule bonne réponse)*

- [ ] **A.** Un seul, `U+006E`
- [ ] **B.** Trois
- [ ] **C.** Deux : `U+006E` (« latin small letter N ») et `U+0303` (« combining tilde »)
- [ ] **D.** Cela dépend uniquement de l'encodage, UTF-8 ou UTF-16

## Usage

### Question 5

Quelles classes le composant fournit-il pour manipuler des chaînes avec son API orientée objet ? *(plusieurs bonnes réponses)*

- [ ] **A.** `ByteString`
- [ ] **B.** `CodePointString`
- [ ] **C.** `UnicodeString`
- [ ] **D.** `RawString`

### Question 6

Dans l'exemple `new UnicodeString('...')->trimEnd('.')->replace(...)->append('!')`, quelle caractéristique de l'API est illustrée ? *(une seule bonne réponse)*

- [ ] **A.** L'immutabilité empêchant tout chaînage de méthodes
- [ ] **B.** Le chaînage fluide (« fluent ») des méthodes de transformation
- [ ] **C.** L'utilisation obligatoire d'un `ServiceLocator`
- [ ] **D.** La nécessité de convertir en `ByteString` avant tout chaînage

## Method Reference — Methods to Create String Objects

### Question 7

Quelle est la classe la plus couramment utilisée parmi les trois classes de chaînes ? *(une seule bonne réponse)*

- [ ] **A.** `ByteString`
- [ ] **B.** `CodePointString`
- [ ] **C.** `AsciiString`
- [ ] **D.** `UnicodeString`

### Question 8

Quelle méthode statique permet d'instancier plusieurs objets de chaîne en une fois, à partir d'un tableau ? *(une seule bonne réponse)*

- [ ] **A.** `wrap()`
- [ ] **B.** `create()`
- [ ] **C.** `fromArray()`
- [ ] **D.** `batch()`

### Question 9

Quelle méthode statique effectue l'opération inverse de `wrap()`, en reconvertissant des objets de chaîne en chaînes PHP natives ? *(une seule bonne réponse)*

- [ ] **A.** `toArray()`
- [ ] **B.** `strings()`
- [ ] **C.** `unwrap()`
- [ ] **D.** `raw()`

### Question 10

À quoi servent les fonctions raccourcies `b()`, `u()` et `s()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `b()` crée une chaîne d'octets (`ByteString`)
- [ ] **B.** `u()` crée une chaîne Unicode (`UnicodeString`)
- [ ] **C.** `s()` crée une `ByteString` ou une `UnicodeString` selon le contenu donné
- [ ] **D.** `s()` convertit systématiquement son argument en majuscules

### Question 11

Quelle méthode statique de `ByteString` génère une chaîne aléatoire ? *(une seule bonne réponse)*

- [ ] **A.** `random()`
- [ ] **B.** `fromRandom(12)`
- [ ] **C.** `generateRandom(12)`
- [ ] **D.** `newRandom(12)`

### Question 12

Par défaut, quel jeu de caractères `ByteString::fromRandom()` utilise-t-il si aucun n'est précisé en second argument ? *(une seule bonne réponse)*

- [ ] **A.** Base64
- [ ] **B.** Hexadécimal
- [ ] **C.** L'ensemble ASCII imprimable complet
- [ ] **D.** Base58

### Question 13

Quelle méthode statique permet de créer une chaîne à partir d'une liste de code points (ex. `0x928, 0x92E, ...`) ? *(une seule bonne réponse)*

- [ ] **A.** `UnicodeString::fromCodePoints(...)`
- [ ] **B.** `UnicodeString::fromHex(...)`
- [ ] **C.** `CodePointString::build(...)`
- [ ] **D.** `UnicodeString::decode(...)`

## Method Reference — Methods to Transform String Objects

### Question 14

Que permettent les méthodes `toCodePointString()`, `toUnicodeString()` et `toByteString()` ? *(une seule bonne réponse)*

- [ ] **A.** Elles modifient l'objet en place, sans retourner de nouvel objet
- [ ] **B.** Elles ne fonctionnent que sur `ByteString`, jamais sur les deux autres classes
- [ ] **C.** Elles transforment un objet de chaîne vers l'un des deux autres types
- [ ] **D.** Elles ne conservent jamais l'encodage d'origine

### Question 15

À quoi sert l'argument optionnel `$toEncoding` de `toByteString()` ? *(une seule bonne réponse)*

- [ ] **A.** Il définit l'encodage de la chaîne d'origine
- [ ] **B.** Il définit l'encodage de la chaîne cible
- [ ] **C.** Il force l'utilisation d'UTF-8 uniquement
- [ ] **D.** Il n'existe pas ; seul `$fromEncoding` existe

### Question 16

Que se passe-t-il si une conversion entre types de chaînes n'est pas possible ? *(une seule bonne réponse)*

- [ ] **A.** La méthode retourne `null` silencieusement
- [ ] **B.** La méthode retourne une chaîne vide
- [ ] **C.** PHP lève une `TypeError` native
- [ ] **D.** Une `Symfony\Component\String\Exception\InvalidArgumentException` est levée

### Question 17

Que retourne la méthode `bytesAt()` ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau des octets stockés à la position donnée
- [ ] **B.** Un seul octet, sous forme d'entier
- [ ] **C.** Le nombre total d'octets de la chaîne
- [ ] **D.** Une chaîne hexadécimale représentant l'octet

## Method Reference — Methods Related to Length and Whitespace Characters

### Question 18

Pour le mot « नमस्ते », que retournent respectivement `length()` sur un `ByteString`, un `CodePointString` et un `UnicodeString` ? *(une seule bonne réponse)*

- [ ] **A.** 6, 4, 18
- [ ] **B.** 4, 4, 4
- [ ] **C.** 18 (octets), 6 (code points), 4 (graphèmes)
- [ ] **D.** 18, 18, 18

### Question 19

À quoi sert la méthode `width()` ? *(une seule bonne réponse)*

- [ ] **A.** À compter le nombre d'octets uniquement
- [ ] **B.** À retourner la largeur totale nécessaire pour représenter le texte avec une police à chasse fixe, certains symboles nécessitant le double de largeur des autres
- [ ] **C.** À retourner la largeur en pixels pour un rendu HTML
- [ ] **D.** À indiquer si la chaîne contient des emojis

### Question 20

Quand la méthode `isEmpty()` retourne-t-elle `true` ? *(une seule bonne réponse)*

- [ ] **A.** Dès que la chaîne ne contient que des espaces
- [ ] **B.** Dès que la chaîne fait moins de 3 caractères
- [ ] **C.** Cette méthode n'existe pas dans le composant
- [ ] **D.** Uniquement si la chaîne est exactement une chaîne vide, pas même des espaces

### Question 21

Que fait la méthode `collapseWhitespace()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle retire les espaces en début/fin de chaîne et remplace deux espaces consécutifs ou plus par un seul espace
- [ ] **B.** Elle retire tous les espaces de la chaîne, y compris au milieu
- [ ] **C.** Elle remplace les espaces par des underscores
- [ ] **D.** Elle ne fonctionne que sur les tabulations, pas sur les espaces classiques

## Method Reference — Methods to Change Case

### Question 22

Quelle est la différence entre `lower()` et `localeLower()` ? *(une seule bonne réponse)*

- [ ] **A.** `lower()` n'existe pas, seul `localeLower()` est disponible
- [ ] **B.** `localeLower()` applique des règles de mise en casse spécifiques à une locale donnée, contrairement à `lower()`
- [ ] **C.** Elles sont strictement identiques
- [ ] **D.** `lower()` ne s'applique qu'aux chaînes ASCII

### Question 23

À quoi sert la méthode `folded()` ? *(une seule bonne réponse)*

- [ ] **A.** À replier visuellement le texte sur plusieurs lignes
- [ ] **B.** À convertir en majuscules uniquement
- [ ] **C.** À supprimer tous les accents d'une chaîne
- [ ] **D.** À retourner une chaîne utilisable dans des comparaisons insensibles à la casse, en gérant les subtilités propres à différentes langues

### Question 24

Que fait la méthode `title()` par défaut, sans argument, sur `u('foo ijssel')` ? *(une seule bonne réponse)*

- [ ] **A.** Elle met en majuscule chaque mot : `'Foo Ijssel'`
- [ ] **B.** Elle ne change rien : `'foo ijssel'`
- [ ] **C.** Elle met en majuscule uniquement le premier mot : `'Foo ijssel'`
- [ ] **D.** Elle lève une exception si aucun argument n'est fourni

### Question 25

Comment obtenir la mise en majuscule de **tous** les mots avec `title()` ? *(une seule bonne réponse)*

- [ ] **A.** En passant l'argument nommé `allWords: true`
- [ ] **B.** En appelant `title()` puis `upper()`
- [ ] **C.** Ce n'est pas possible avec `title()`, il faut utiliser `localeTitle()`
- [ ] **D.** En passant `true` comme premier argument positionnel

### Question 26

Quelles méthodes de changement de casse convertissent respectivement une chaîne en camelCase, snake_case, kebab-case et PascalCase ? *(plusieurs bonnes réponses)*

- [ ] **A.** `camel()`
- [ ] **B.** `snake()`
- [ ] **C.** `kebab()`
- [ ] **D.** `pascal()`

### Question 27

Comment obtenir un résultat qui n'est fourni par aucune méthode dédiée seule, comme du "MAJUSCULES-CAMEL" ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec ce composant
- [ ] **B.** En chaînant les méthodes, ex. `->camel()->upper()`
- [ ] **C.** En utilisant une méthode dédiée `camelUpper()`
- [ ] **D.** En passant un flag à `camel(uppercase: true)`

### Question 28

Par défaut, les méthodes des classes de chaînes sont-elles sensibles à la casse ? *(une seule bonne réponse)*

- [ ] **A.** Oui, par défaut ; on peut les rendre insensibles à la casse avec `ignoreCase()`
- [ ] **B.** Non, elles sont toutes insensibles à la casse par défaut
- [ ] **C.** Cela dépend uniquement de la locale du système
- [ ] **D.** Seules les méthodes de recherche sont sensibles à la casse, pas les autres

### Question 29

Que retourne `u('abc')->indexOf('B')`, comparé à `u('abc')->ignoreCase()->indexOf('B')` ? *(une seule bonne réponse)*

- [ ] **A.** `0` puis `1`
- [ ] **B.** `null` dans les deux cas
- [ ] **C.** `1` puis `null`
- [ ] **D.** `null` (sensible à la casse), puis `1` (insensible à la casse)

## Method Reference — Methods to Append and Prepend

### Question 30

Que fait `ensureStart()` si la chaîne commence déjà par le contenu donné, ex. `u('getName')->ensureStart('get')` ? *(une seule bonne réponse)*

- [ ] **A.** Elle duplique le préfixe : `'getgetName'`
- [ ] **B.** Elle lève une exception
- [ ] **C.** Elle ne fait rien, la chaîne reste `'getName'`
- [ ] **D.** Elle retire le préfixe existant

### Question 31

Que fait `ensureEnd()` sur `u('UserControllerController')->ensureEnd('Controller')` ? *(une seule bonne réponse)*

- [ ] **A.** Elle ajoute un second suffixe : `'UserControllerControllerController'`
- [ ] **B.** Elle normalise le doublon en un seul suffixe : `'UserController'`
- [ ] **C.** Elle lève une exception car le suffixe est déjà présent deux fois
- [ ] **D.** Elle retourne la chaîne inchangée

### Question 32

Que retourne `u('hello world')->before('o', includeNeedle: true)` ? *(une seule bonne réponse)*

- [ ] **A.** `'hello'`
- [ ] **B.** `'hell'`
- [ ] **C.** `'hello '`
- [ ] **D.** `'world'`

### Question 33

Quelle est la différence entre `before()`/`after()` et `beforeLast()`/`afterLast()` ? *(une seule bonne réponse)*

- [ ] **A.** `before()` cherche depuis la fin, `beforeLast()` depuis le début
- [ ] **B.** Il n'y a aucune différence, ce sont des alias
- [ ] **C.** `beforeLast()` ne fonctionne que sur des `ByteString`
- [ ] **D.** `before()`/`after()` se basent sur la première occurrence, `beforeLast()`/`afterLast()` sur la dernière

### Question 34

Que retourne `u('hello world')->after('o')`, sans l'argument `includeNeedle` ? *(une seule bonne réponse)*

- [ ] **A.** `'o world'`
- [ ] **B.** `' world'`
- [ ] **C.** `'world'`
- [ ] **D.** `'hello'`

## Method Reference — Methods to Pad and Trim

### Question 35

Que fait `padBoth(20, '-')` sur une chaîne plus courte que 20 caractères ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'ajoute des tirets qu'au début
- [ ] **B.** Elle n'ajoute des tirets qu'à la fin
- [ ] **C.** Elle ajoute des tirets des deux côtés, pour atteindre une longueur totale de 20
- [ ] **D.** Elle lève une exception si la longueur cible est inférieure à celle de la chaîne

### Question 36

Que fait `repeat(10)` sur `u('_.')` ? *(une seule bonne réponse)*

- [ ] **A.** Elle répète la chaîne `'_.'` dix fois de suite
- [ ] **B.** Elle répète chaque caractère individuellement dix fois
- [ ] **C.** Elle retourne un tableau de 10 copies de la chaîne
- [ ] **D.** Elle tronque la chaîne à 10 caractères

### Question 37

Par défaut, sans argument, que retire la méthode `trim()` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les espaces classiques `' '`, pas les tabulations
- [ ] **B.** Rien : un argument est obligatoire
- [ ] **C.** Tous les chiffres en début et fin de chaîne
- [ ] **D.** Les caractères d'espacement (whitespace) par défaut

### Question 38

Quand on passe un tableau de préfixes/suffixes à `trimPrefix()` ou `trimSuffix()`, quel comportement documente la doc ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée si plusieurs éléments du tableau correspondent
- [ ] **B.** Tous les suffixes du tableau qui correspondent sont retirés successivement
- [ ] **C.** L'ordre des éléments du tableau n'a aucune importance
- [ ] **D.** Seul le premier retrouvé dans le tableau est retiré

### Question 39

Quelle méthode retire un contenu précis en début de chaîne (pas uniquement des espaces), comme dans `trimPrefix('file-')` ? *(une seule bonne réponse)*

- [ ] **A.** `trimStart()`, qui ne retire que des espaces
- [ ] **B.** `ensureStart()`
- [ ] **C.** `trimPrefix()`
- [ ] **D.** `before()`

## Method Reference — Methods to Search and Replace

### Question 40

Que retourne `u('avatar-73647.png')->match('/avatar-(\d+)\.png/')` ? *(une seule bonne réponse)*

- [ ] **A.** Un tableau de correspondances façon `preg_match` : `['avatar-73647.png', '73647', null]`
- [ ] **B.** Un simple booléen `true`/`false`
- [ ] **C.** Directement la sous-chaîne capturée `'73647'`
- [ ] **D.** `null`, si le pattern est valide

### Question 41

Que fait la méthode `containsAny()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle vérifie que la chaîne contient TOUTES les sous-chaînes du tableau donné
- [ ] **B.** Elle est un simple alias de `startsWith()`
- [ ] **C.** Elle vérifie si la chaîne contient AU MOINS une des sous-chaînes données
- [ ] **D.** Elle ne fonctionne qu'avec des expressions régulières

### Question 42

Que retourne `indexOf()` si la sous-chaîne recherchée n'est pas trouvée ? *(une seule bonne réponse)*

- [ ] **A.** `-1`, comme en JavaScript
- [ ] **B.** `null`
- [ ] **C.** `false`, comme la fonction PHP native `strpos()`
- [ ] **D.** Une exception `NotFoundException` est levée

### Question 43

Comment se comporte un second argument négatif de `indexOf()`, par exemple `-4` ? *(une seule bonne réponse)*

- [ ] **A.** Il provoque une erreur : seuls les entiers positifs sont acceptés
- [ ] **B.** Il est ignoré silencieusement
- [ ] **C.** Il ne recherche que dans les 4 premiers caractères
- [ ] **D.** Il a la même signification que dans les fonctions PHP natives : il compte depuis la fin de la chaîne

### Question 44

Quelle est la différence entre `indexOf()` et `indexOfLast()` ? *(une seule bonne réponse)*

- [ ] **A.** `indexOf()` trouve la première occurrence, `indexOfLast()` la dernière
- [ ] **B.** Elles sont strictement identiques
- [ ] **C.** `indexOfLast()` ne fonctionne que sur `ByteString`
- [ ] **D.** `indexOf()` est sensible à la casse, `indexOfLast()` ne l'est jamais

### Question 45

Comment passer une fonction de remplacement personnalisée à `replaceMatches()` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seul un remplacement fixe est supporté
- [ ] **B.** En utilisant une syntaxe séparée façon `preg_replace_callback`, incompatible avec ce composant
- [ ] **C.** En passant un callable comme second argument, ex. `function (string $match): string { return '['.$match[0].']'; }`
- [ ] **D.** En héritant de la classe `UnicodeString`

### Question 46

Que se passe-t-il si l'on passe `PREG_PATTERN_ORDER` ou `PREG_SET_ORDER` comme second argument de `match()` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée, ces flags n'étant pas supportés
- [ ] **B.** Rien : ces flags sont ignorés par `match()`
- [ ] **C.** `preg_match_all()` est utilisé en interne, au lieu de `preg_match()`
- [ ] **D.** Le comportement devient celui de `containsAny()`

## Method Reference — Methods to Join, Split, Truncate and Reverse

### Question 47

Que fait la méthode `join()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle divise une chaîne en morceaux selon un délimiteur
- [ ] **B.** Elle utilise la chaîne comme « colle » pour fusionner plusieurs chaînes données en argument
- [ ] **C.** Elle concatène simplement deux chaînes sans séparateur
- [ ] **D.** Elle fusionne deux objets `UnicodeString`, sans argument supplémentaire

### Question 48

Que fait le second argument optionnel de `split()`, ex. `split('.', 2)` ? *(une seule bonne réponse)*

- [ ] **A.** Il limite le nombre maximum de morceaux retournés
- [ ] **B.** Il définit la longueur minimale de chaque morceau
- [ ] **C.** Il indique le nombre d'occurrences du délimiteur à ignorer
- [ ] **D.** Il active un mode insensible à la casse pour le délimiteur

### Question 49

Concernant `slice()`, que fait un second argument négatif, ex. `slice(0, -6)` ? *(une seule bonne réponse)*

- [ ] **A.** Il provoque une exception, les valeurs négatives n'étant pas supportées
- [ ] **B.** Il compte depuis le début de la chaîne, comme un argument positif
- [ ] **C.** Il tronque systématiquement à 6 caractères
- [ ] **D.** Il a la même signification que dans les fonctions PHP natives

### Question 50

Quel est le mode par défaut de troncature de `truncate()`, quand la longueur donnée est dépassée ? *(une seule bonne réponse)*

- [ ] **A.** `TruncateMode::WordBefore`
- [ ] **B.** `TruncateMode::WordAfter`
- [ ] **C.** `TruncateMode::Char`, qui coupe la chaîne à la longueur exacte donnée
- [ ] **D.** Il n'y a pas de mode par défaut, l'argument est obligatoire

### Question 51

Quelle est la différence entre `TruncateMode::WordBefore` et `TruncateMode::WordAfter` ? *(une seule bonne réponse)*

- [ ] **A.** `WordBefore` coupe toujours au caractère exact, `WordAfter` au mot suivant
- [ ] **B.** `WordBefore` retourne le dernier mot complet qui tient dans la longueur SANS la dépasser ; `WordAfter` peut la dépasser pour compléter le mot en cours
- [ ] **C.** Ce sont deux alias d'un même comportement
- [ ] **D.** `WordAfter` ignore totalement l'argument de longueur

### Question 52

Que fait la méthode `wordwrap()` par défaut, sans passer `cut: true` ? *(une seule bonne réponse)*

- [ ] **A.** Elle découpe le texte en lignes en respectant les espaces, sans couper un mot au milieu
- [ ] **B.** Elle coupe arbitrairement chaque ligne à la longueur exacte, y compris au milieu d'un mot
- [ ] **C.** Elle supprime tous les espaces avant de découper
- [ ] **D.** Elle ne fonctionne que sur des chaînes ASCII

### Question 53

Que fait la méthode `splice()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle inverse l'ordre des caractères d'une chaîne
- [ ] **B.** Elle divise la chaîne en plusieurs morceaux de taille fixe
- [ ] **C.** Elle recherche et remplace toutes les occurrences d'un motif
- [ ] **D.** Elle remplace une portion de la chaîne par un contenu donné, à une position et sur une longueur précisées

## Method Reference — Methods Added by ByteString

### Question 54

À quoi sert la méthode `isUtf8()`, disponible uniquement sur `ByteString` ? *(une seule bonne réponse)*

- [ ] **A.** Elle convertit la chaîne en UTF-8
- [ ] **B.** Elle retourne le nombre d'octets non-UTF-8
- [ ] **C.** Elle retourne `true` si le contenu de la chaîne est un contenu UTF-8 valide
- [ ] **D.** Elle force l'encodage UTF-8 sur l'objet, en le modifiant

### Question 55

Pourquoi cette méthode n'est-elle disponible que sur `ByteString`, et pas sur `CodePointString`/`UnicodeString` ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ces deux autres classes travaillent déjà sur des données décodées (code points/graphèmes) : la validité UTF-8 des octets bruts n'a de sens qu'au niveau de `ByteString`
- [ ] **B.** Parce que `UnicodeString` ne supporte que l'ASCII
- [ ] **C.** Parce que `CodePointString` ne supporte que l'UTF-16
- [ ] **D.** Parce qu'il s'agit d'un oubli documenté comme un bug connu

## Method Reference — Methods Added by CodePointString and UnicodeString

### Question 56

Que fait la méthode `ascii()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle supprime tous les caractères non alphabétiques
- [ ] **B.** Elle chiffre la chaîne selon le standard ASCII
- [ ] **C.** Elle sert à construire un slugger, comme le recommande la documentation
- [ ] **D.** Elle translittère n'importe quelle chaîne vers l'alphabet latin défini par l'encodage ASCII

### Question 57

La documentation recommande-t-elle d'utiliser `ascii()` pour construire un slugger ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est au contraire la méthode recommandée pour cela
- [ ] **B.** Non : le composant fournit déjà un slugger dédié, décrit plus loin dans l'article
- [ ] **C.** La question ne se pose pas, `ascii()` et le slugger étant la même chose
- [ ] **D.** Oui, car `ascii()` est dépréciée au profit du slugger depuis Symfony 7

### Question 58

Que retourne `codePointsAt()` ? *(une seule bonne réponse)*

- [ ] **A.** Un unique entier représentant le premier code point
- [ ] **B.** Le nombre total de code points de la chaîne
- [ ] **C.** Un tableau contenant le ou les code points stockés à la position donnée
- [ ] **D.** Une chaîne hexadécimale du code point

### Question 59

À quoi sert la méthode `normalize()` et le concept d'« Unicode equivalence » qu'elle illustre ? *(une seule bonne réponse)*

- [ ] **A.** Différentes séquences de code points peuvent représenter le même caractère (ex. `å` en un seul ou en deux code points) ; `normalize()` permet de choisir le mode de normalisation
- [ ] **B.** Elle convertit systématiquement la chaîne en minuscules
- [ ] **C.** Elle sert uniquement à valider qu'une chaîne est en UTF-8
- [ ] **D.** Elle supprime les caractères non normalisés (invalides) de la chaîne

## Lazy-loaded Strings

### Question 60

Dans quel cas la documentation recommande-t-elle d'utiliser `LazyString` ? *(une seule bonne réponse)*

- [ ] **A.** Pour accélérer systématiquement toutes les opérations sur les chaînes
- [ ] **B.** Pour remplacer complètement `UnicodeString` dans tout le composant
- [ ] **C.** Quand la valeur nécessite un calcul coûteux qui pourrait ne jamais être utilisé, ex. un hash
- [ ] **D.** Uniquement pour les chaînes provenant de traductions

### Question 61

Quand le callback passé à `LazyString::fromCallable()` est-il exécuté ? *(une seule bonne réponse)*

- [ ] **A.** Immédiatement, à la création de l'objet `LazyString`
- [ ] **B.** À chaque appel à une méthode de transformation de chaîne
- [ ] **C.** Jamais automatiquement : il faut appeler explicitement une méthode `compute()`
- [ ] **D.** Uniquement quand la valeur de la lazy string est effectivement demandée pendant l'exécution du programme

### Question 62

Comment créer une `LazyString` à partir d'un objet implémentant `\Stringable` ? *(une seule bonne réponse)*

- [ ] **A.** `LazyString::fromCallable($object)`
- [ ] **B.** `LazyString::fromStringable($object)`
- [ ] **C.** `new LazyString($object)`
- [ ] **D.** `LazyString::wrap($object)`

## Working with Emojis

### Question 63

Où se trouve désormais la documentation détaillée sur la gestion des emojis, qui vivait auparavant dans cette page ? *(une seule bonne réponse)*

- [ ] **A.** Dans la documentation du composant Emoji, dédié
- [ ] **B.** Elle a été supprimée sans remplacement
- [ ] **C.** Dans la documentation du composant Notifier
- [ ] **D.** Dans la documentation du composant Intl

## Slugger

### Question 64

À quoi sert un « slugger » ? *(une seule bonne réponse)*

- [ ] **A.** À valider qu'une chaîne est un slug déjà existant en base de données
- [ ] **B.** À chiffrer une chaîne pour un usage dans une URL
- [ ] **C.** À traduire une chaîne dans une autre langue
- [ ] **D.** À transformer une chaîne en une autre chaîne ne comportant que des caractères ASCII sûrs, pour les URLs ou noms de fichiers

### Question 65

Quel est le séparateur utilisé par défaut entre les mots par `AsciiSlugger` ? *(une seule bonne réponse)*

- [ ] **A.** Un underscore `_`
- [ ] **B.** Un point `.`
- [ ] **C.** Un tiret `-`
- [ ] **D.** Un espace

### Question 66

Comment ajouter des substitutions de caractères personnalisées au slugger, comme `%` → `percent` ? *(une seule bonne réponse)*

- [ ] **A.** En passant un tableau associatif par locale en second argument du constructeur, ex. `new AsciiSlugger('en', ['en' => ['%' => 'percent']])`
- [ ] **B.** En surchargeant la méthode `slug()`
- [ ] **C.** Ce n'est pas configurable, seule la table par défaut est utilisée
- [ ] **D.** Via un fichier de configuration YAML dédié au composant String

### Question 67

Que se passe-t-il si aucune table de substitutions n'existe pour la locale demandée (ex. `'en_GB'`) ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée immédiatement
- [ ] **B.** La table de substitutions de la locale parente est utilisée à la place (ex. `'en'`)
- [ ] **C.** Aucune substitution n'est appliquée du tout
- [ ] **D.** La locale par défaut du serveur est utilisée

### Question 68

Comment personnaliser dynamiquement les substitutions, plutôt que via un simple tableau ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seuls les tableaux sont acceptés
- [ ] **B.** En étendant obligatoirement la classe `AsciiSlugger`
- [ ] **C.** En implémentant une interface `SubstitutionMapInterface`
- [ ] **D.** En passant une closure PHP en second argument du constructeur, à la place d'un tableau

### Question 69

Comment un service Symfony peut-il obtenir automatiquement un slugger dont la locale correspond à celle de la requête courante ? *(une seule bonne réponse)*

- [ ] **A.** En instanciant manuellement `new AsciiSlugger($request->getLocale())`
- [ ] **B.** En type-hintant un argument de constructeur avec `SluggerInterface`, grâce à l'autowiring
- [ ] **C.** En injectant le service `translator` et en appelant `->slug()` dessus
- [ ] **D.** Ce n'est pas possible automatiquement, la locale devant toujours être précisée manuellement

### Question 70

Comment forcer explicitement la locale d'origine utilisée pour la translittération, plutôt que la détection automatique ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, la détection est toujours automatique
- [ ] **B.** Via une variable d'environnement `SLUGGER_LOCALE`
- [ ] **C.** En la passant comme troisième argument optionnel de la méthode `slug()`
- [ ] **D.** En appelant une méthode `setLocale()` avant `slug()`

## Slugger — Slug Emojis

### Question 71

Que permet la méthode `withEmoji()` sur un `AsciiSlugger` ? *(une seule bonne réponse)*

- [ ] **A.** De transformer les emojis en leur représentation textuelle avant de générer le slug
- [ ] **B.** De supprimer purement et simplement tous les emojis de la chaîne
- [ ] **C.** De remplacer les emojis par des points d'interrogation
- [ ] **D.** De convertir automatiquement tous les emojis vers une seule locale universelle

### Question 72

Que peut-on passer comme premier argument de `withEmoji()` ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement un booléen `true`/`false`
- [ ] **B.** Un objet `Locale`
- [ ] **C.** Une instance de `EmojiTransliterator`, obligatoirement
- [ ] **D.** Une locale spécifique (ex. `'en'`, `'fr'`), ou les short codes de GitHub, Gitlab ou Slack (ex. `'github'`)

### Question 73

Sans argument passé à `withEmoji()`, sur quoi se base-t-elle pour choisir la représentation textuelle des emojis ? *(une seule bonne réponse)*

- [ ] **A.** Sur la locale du serveur PHP
- [ ] **B.** Sur la locale passée à la méthode `slug()` (son troisième argument), comme dans `slug(..., '-', 'en')` / `slug(..., '-', 'fr')`
- [ ] **C.** Toujours sur l'anglais, quelle que soit la locale de `slug()`
- [ ] **D.** Sur un fichier de configuration à créer manuellement

## Inflector

### Question 74

À quoi sert l'`EnglishInflector` ? *(une seule bonne réponse)*

- [ ] **A.** À traduire des mots anglais vers d'autres langues
- [ ] **B.** À vérifier l'orthographe de mots anglais
- [ ] **C.** À convertir des mots anglais du singulier au pluriel, et inversement
- [ ] **D.** À générer des noms de variables PHP valides à partir de texte libre

### Question 75

Pourquoi la valeur retournée par `singularize()`/`pluralize()` est-elle toujours un tableau ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'il n'est parfois pas possible de déterminer une forme singulière/plurielle unique pour un mot donné
- [ ] **B.** Pour des raisons de compatibilité historique avec PHP 5
- [ ] **C.** Parce que la méthode traite toujours plusieurs mots à la fois
- [ ] **D.** Parce que chaque élément du tableau représente une langue différente

### Question 76

Que retourne `$inflector->singularize('leaves')` avec `EnglishInflector` ? *(une seule bonne réponse)*

- [ ] **A.** `['leaf']` uniquement
- [ ] **B.** `['leave']` uniquement
- [ ] **C.** Une exception, "leaves" n'ayant pas de singulier unique
- [ ] **D.** `['leaf', 'leave', 'leaff']`

### Question 77

Que retourne `$inflector->pluralize('person')` ? *(une seule bonne réponse)*

- [ ] **A.** `['persons']` uniquement
- [ ] **B.** `['persons', 'people']`
- [ ] **C.** `['people']` uniquement
- [ ] **D.** Une exception, car "person" aurait plusieurs pluriels

### Question 78

En plus de l'anglais, quelles autres langues Symfony fournit-il nativement comme inflecteurs ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le français, via `FrenchInflector`
- [ ] **B.** L'espagnol, via `SpanishInflector`
- [ ] **C.** L'allemand, via `GermanInflector`
- [ ] **D.** L'italien, via `ItalianInflector`

---

## Corrigé

**Question 1 : B** — « Languages like English require a very limited set of characters and symbols to display any content. » *(§ What is a String?)*

**Question 2 : D** — « Code points: they are the atomic units of information. (…) Each code point is a number whose meaning is given by the Unicode standard. » *(§ What is a String?)*

**Question 3 : A** — « Grapheme clusters: they are a sequence of one or more code points which are displayed as a single graphical unit. » *(§ What is a String?)*

**Question 4 : C** — « the Spanish letter `ñ` is a grapheme cluster that contains two code points: `U+006E` = `n` + `U+0303` = combining tilde. » *(§ What is a String?)*

**Question 5 : A, B, C** — « Create a new object of type `Symfony\Component\String\ByteString`, `Symfony\Component\String\CodePointString` or `Symfony\Component\String\UnicodeString`. » *(§ Usage)*

**Question 6 : B** — l'exemple enchaîne `->trimEnd('.')->replace(...)->append('!')` directement sur l'objet retourné. *(§ Usage)*

**Question 7 : D** — « `UnicodeString` is the most commonly used class. » *(§ Method Reference — Methods to Create String Objects)*

**Question 8 : A** — « Use the `wrap()` static method to instantiate more than one string object. » *(§ Method Reference — Methods to Create String Objects)*

**Question 9 : C** — « use the `unwrap` method to make the inverse conversion. » *(§ Method Reference — Methods to Create String Objects)*

**Question 10 : A, B, C** — « the `b()` function creates byte strings (…) the `u()` function creates Unicode strings (…) the `s()` function creates a byte string or Unicode string depending on the given contents. » *(§ Method Reference — Methods to Create String Objects)*

**Question 11 : B** — « `ByteString` can create a random string of the given length: `$foo = ByteString::fromRandom(12);`. » *(§ Method Reference — Methods to Create String Objects)*

**Question 12 : D** — « by default, random strings use base58 characters. » *(§ Method Reference — Methods to Create String Objects)*

**Question 13 : A** — « `CodePointString` and `UnicodeString` can create a string from code points: `$foo = UnicodeString::fromCodePoints(0x928, 0x92E, ...)`. » *(§ Method Reference — Methods to Create String Objects)*

**Question 14 : C** — « Each string object can be transformed into the other two types of objects. » *(§ Method Reference — Methods to Transform String Objects)*

**Question 15 : B** — « the optional `$toEncoding` argument defines the encoding of the target string. » *(§ Method Reference — Methods to Transform String Objects)*

**Question 16 : D** — « If the conversion is not possible for any reason, you'll get an `InvalidArgumentException`. » *(§ Method Reference — Methods to Transform String Objects)*

**Question 17 : A** — « There is also a method to get the bytes stored at some position (…) `b('नमस्ते')->bytesAt(0); // [224]`. » *(§ Method Reference — Methods to Transform String Objects)*

**Question 18 : C** — « `new ByteString($word)->length(); // 18 (bytes)`, `new CodePointString($word)->length(); // 6 (code points)`, `new UnicodeString($word)->length(); // 4 (graphemes)`. » *(§ Method Reference — Methods Related to Length and Whitespace Characters)*

**Question 19 : B** — « some symbols require double the width of others to represent them when using a monospaced font (…) This method returns the total width needed to represent the entire word. » *(§ Method Reference — Methods Related to Length and Whitespace Characters)*

**Question 20 : D** — « only returns TRUE if the string is exactly an empty string (not even whitespace) » — `u('     ')->isEmpty(); // false`. *(§ Method Reference — Methods Related to Length and Whitespace Characters)*

**Question 21 : A** — « removes all whitespace (…) from the start and end of the string and replaces two or more consecutive whitespace characters with a single space character. » *(§ Method Reference — Methods Related to Length and Whitespace Characters)*

**Question 22 : B** — « changes all graphemes/code points to lower case according to locale-specific case mappings » pour `localeLower()`, contre un `lower()` non localisé. *(§ Method Reference — Methods to Change Case)*

**Question 23 : D** — « this method returns a string that you can use in case-insensitive comparisons » (`folded()`). *(§ Method Reference — Methods to Change Case)*

**Question 24 : C** — « `u('foo ijssel')->title(); // 'Foo ijssel'`. » *(§ Method Reference — Methods to Change Case)*

**Question 25 : A** — « `u('foo ijssel')->title(allWords: true); // 'Foo Ijssel'`. » *(§ Method Reference — Methods to Change Case)*

**Question 26 : A, B, C, D** — « `->camel()`, `->snake()`, `->kebab()`, `->pascal()`. » *(§ Method Reference — Methods to Change Case)*

**Question 27 : B** — « other cases can be achieved by chaining methods, e.g.: `u('Foo: Bar-baz.')->camel()->upper(); // 'FOOBARBAZ'`. » *(§ Method Reference — Methods to Change Case)*

**Question 28 : A** — « The methods of all string classes are case-sensitive by default. You can perform case-insensitive operations with the `ignoreCase()` method. » *(§ Method Reference — Methods to Change Case)*

**Question 29 : D** — « `u('abc')->indexOf('B'); // null` / `u('abc')->ignoreCase()->indexOf('B'); // 1`. » *(§ Method Reference — Methods to Change Case)*

**Question 30 : C** — « `u('getName')->ensureStart('get'); // 'getName'`. » *(§ Method Reference — Methods to Append and Prepend)*

**Question 31 : B** — « `u('UserControllerController')->ensureEnd('Controller'); // 'UserController'`. » *(§ Method Reference — Methods to Append and Prepend)*

**Question 32 : A** — « `u('hello world')->before('o', includeNeedle: true); // 'hello'`. » *(§ Method Reference — Methods to Append and Prepend)*

**Question 33 : D** — « returns the contents found before/after the first occurrence » vs « (…) before/after the last occurrence ». *(§ Method Reference — Methods to Append and Prepend)*

**Question 34 : B** — « `u('hello world')->after('hello'); // ' world'` / `u('hello world')->after('o'); // ' world'`. » *(§ Method Reference — Methods to Append and Prepend)*

**Question 35 : C** — « `u(' Lorem Ipsum ')->padBoth(20, '-'); // '--- Lorem Ipsum ----'`. » *(§ Method Reference — Methods to Pad and Trim)*

**Question 36 : A** — « `u('_.')->repeat(10); // '_._._._._._._._._._.'`. » *(§ Method Reference — Methods to Pad and Trim)*

**Question 37 : D** — « removes the given characters (default: whitespace characters) from the beginning and end of a string. » *(§ Method Reference — Methods to Pad and Trim)*

**Question 38 : D** — « when passing an array of prefix/suffix, only the first one found is trimmed. » *(§ Method Reference — Methods to Pad and Trim)*

**Question 39 : C** — « removes the given content from the start/end of the string » via `trimPrefix()`/`trimSuffix()`, à ne pas confondre avec `trimStart()`/`trimEnd()` qui ne retirent que des espaces. *(§ Method Reference — Methods to Pad and Trim)*

**Question 40 : A** — « `u('avatar-73647.png')->match('/avatar-(\d+)\.png/'); // result = ['avatar-73647.png', '73647', null]`. » *(§ Method Reference — Methods to Search and Replace)*

**Question 41 : C** — « checks if the string contains any of the other given strings » — `u('aeiou')->containsAny(['eio', 'foo', 'z']); // true`. *(§ Method Reference — Methods to Search and Replace)*

**Question 42 : B** — « `u('abcdeabcde')->indexOf('k'); // null`. » *(§ Method Reference — Methods to Search and Replace)*

**Question 43 : D** — « the second argument is the position where the search starts and negative values have the same meaning as in PHP functions. » *(§ Method Reference — Methods to Search and Replace)*

**Question 44 : A** — « finds the position of the first occurrence » (`indexOf`) contre « finds the position of the last occurrence » (`indexOfLast`). *(§ Method Reference — Methods to Search and Replace)*

**Question 45 : C** — « you can pass a callable as the second argument to perform advanced replacements: `u('123')->replaceMatches('/\d/', function (string $match): string { return '['.$match[0].']'; });`. » *(§ Method Reference — Methods to Search and Replace)*

**Question 46 : C** — « If `PREG_PATTERN_ORDER` or `PREG_SET_ORDER` are passed, `preg_match_all()` will be used. » *(§ Method Reference — Methods to Search and Replace)*

**Question 47 : B** — « uses the string as the "glue" to merge all the given strings: `u(', ')->join(['foo', 'bar']); // 'foo, bar'`. » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 48 : A** — « you can set the maximum number of pieces as the second argument: `u('template_name.html.twig')->split('.', 2); // ['template_name', 'html.twig']`. » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 49 : D** — « returns a substring which starts at the first argument and has the length of the second optional argument (negative values have the same meaning as in PHP functions). » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 50 : C** — « the default value is `TruncateMode::Char` which cuts the string at the exact given length. » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 51 : B** — « returns up to the last complete word that fits in the given length without surpassing it » (`WordBefore`) contre « (…) surpassing it if needed » (`WordAfter`). *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 52 : A** — « breaks the string into lines of the given length (…) by default it breaks by white space; pass TRUE to break unconditionally. » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 53 : D** — « replaces a portion of the string with the given contents: the second argument is the position where the replacement starts; the third argument is the number of graphemes/code points removed. » *(§ Method Reference — Methods to Join, Split, Truncate and Reverse)*

**Question 54 : C** — « returns TRUE if the string contents are valid UTF-8 contents. » *(§ Method Reference — Methods Added by ByteString)*

**Question 55 : A** — cette méthode figure dans la section « Methods Added by ByteString », dédiée aux octets bruts ; `CodePointString`/`UnicodeString` travaillent déjà sur des données décodées. *(§ Method Reference — Methods Added by ByteString)*

**Question 56 : D** — « transliterates any string into the latin alphabet defined by the ASCII encoding. » *(§ Method Reference — Methods Added by CodePointString and UnicodeString)*

**Question 57 : B** — « don't use this method to build a slugger because this component already provides a slugger, as explained later in this article. » *(§ Method Reference — Methods Added by CodePointString and UnicodeString)*

**Question 58 : C** — « returns an array with the code point or points stored at the given position. » *(§ Method Reference — Methods Added by CodePointString and UnicodeString)*

**Question 59 : A** — « Unicode equivalence is the specification (…) that different sequences of code points represent the same character (…) The `normalize()` method allows you to pick the normalization mode. » *(§ Method Reference — Methods Added by CodePointString and UnicodeString)*

**Question 60 : C** — « consider a hash value that requires certain computation to obtain and which you might end up not using it. » *(§ Lazy-loaded Strings)*

**Question 61 : D** — « The callback will only be executed when the value of the lazy string is requested during the program execution. » *(§ Lazy-loaded Strings)*

**Question 62 : B** — « You can also create lazy strings from a `Stringable` object (…) `$lazyHash = LazyString::fromStringable(new Hash());`. » *(§ Lazy-loaded Strings)*

**Question 63 : A** — « These contents have been moved to the Emoji component docs. » *(§ Working with Emojis)*

**Question 64 : D** — « A slugger transforms a given string into another string that only includes safe ASCII characters. » *(§ Slugger)*

**Question 65 : C** — « The separator between words is a dash (`-`) by default. » *(§ Slugger)*

**Question 66 : A** — « you can also pass an array with additional character substitutions: `new AsciiSlugger('en', ['en' => ['%' => 'percent', '€' => 'euro']]);`. » *(§ Slugger)*

**Question 67 : B** — « if there is no symbols map for your locale (e.g. 'en_GB') then the parent locale's symbols map will be used instead (i.e. 'en'). » *(§ Slugger)*

**Question 68 : D** — « for more dynamic substitutions, pass a PHP closure instead of an array. » *(§ Slugger)*

**Question 69 : B** — « you can inject a slugger by type-hinting a service constructor argument with the `SluggerInterface`. The locale of the injected slugger is the same as the request locale. » *(§ Slugger)*

**Question 70 : C** — « you can override the locale as the third optional parameter of `slug()`. » *(§ Slugger)*

**Question 71 : A** — « You can also combine the emoji transliterator with the slugger to transform any emojis into their textual representation. » *(§ Slugger — Slug Emojis)*

**Question 72 : D** — « If you want to use a specific locale for the emoji, or to use the short codes from GitHub, Gitlab or Slack, use the first argument of `withEmoji()` method (…) `$slugger->withEmoji('github'); // or "en", or "fr", etc.`. » *(§ Slugger — Slug Emojis)*

**Question 73 : B** — l'exemple appelle `$slugger->slug('...', '-', 'en')` puis `$slugger->slug('...', '-', 'fr')` sans reconfigurer `withEmoji()` entre les deux, la locale de `slug()` pilotant la représentation choisie. *(§ Slugger — Slug Emojis)*

**Question 74 : C** — « This component provides an `EnglishInflector` class to convert English words from/to singular/plural with confidence. » *(§ Inflector)*

**Question 75 : A** — « The value returned by both methods is always an array because sometimes it's not possible to determine a unique singular/plural form for the given word. » *(§ Inflector)*

**Question 76 : D** — « `$result = $inflector->singularize('leaves'); // ['leaf', 'leave', 'leaff']`. » *(§ Inflector)*

**Question 77 : B** — « `$result = $inflector->pluralize('person'); // ['persons', 'people']`. » *(§ Inflector)*

**Question 78 : A, B** — « Symfony also provides inflectors for other languages: `FrenchInflector` (…) `SpanishInflector`. » *(§ Inflector)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [string.rst](https://github.com/symfony/symfony-docs/blob/8.0/string.rst)) : pas de pages annexes à couvrir pour ce QCM.
