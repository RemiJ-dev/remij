# QCM — Le composant Filesystem

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/filesystem.html](https://symfony.com/doc/8.0/components/filesystem.html) · **Généré le :** 23 juillet 2026
>
> **72 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et usage de base

### Question 1

Que fournit le composant Filesystem ? *(une seule bonne réponse)*

- [ ] **A.** Un ORM pour stocker des fichiers en base de données
- [ ] **B.** Un système de cache de fichiers avec expiration
- [ ] **C.** Un client FTP/SFTP intégré
- [ ] **D.** Des utilitaires indépendants de la plateforme pour les opérations sur le système de fichiers et la manipulation de chemins

### Question 2

Quelles sont les deux classes principales du composant ? *(une seule bonne réponse)*

- [ ] **A.** `FileHandler` et `DirectoryHandler`
- [ ] **B.** `Filesystem` et `Path`
- [ ] **C.** `FileManager` et `PathResolver`
- [ ] **D.** `Filesystem` et `Finder`

### Question 3

Dans l'exemple d'utilisation de base, quelle interface d'exception est catchée autour de l'appel à `mkdir()` ? *(une seule bonne réponse)*

- [ ] **A.** `FilesystemExceptionInterface`
- [ ] **B.** `\Exception` générique, aucune interface dédiée n'existant
- [ ] **C.** `IOException`, sans interface, uniquement la classe concrète
- [ ] **D.** `IOExceptionInterface`

## mkdir

### Question 4

Que fait `Filesystem::mkdir()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle renomme un répertoire existant
- [ ] **B.** Elle vérifie seulement si un répertoire existe, sans le créer
- [ ] **C.** Elle crée un répertoire de façon récursive
- [ ] **D.** Elle crée uniquement un seul niveau de répertoire, jamais récursivement

### Question 5

Quel mode par défaut est utilisé pour créer les répertoires sur les systèmes de fichiers POSIX ? *(une seule bonne réponse)*

- [ ] **A.** `0755`
- [ ] **B.** `0700`
- [ ] **C.** `0644`
- [ ] **D.** `0777`

### Question 6

Que se passe-t-il si l'on appelle `mkdir()` sur un répertoire qui existe déjà ? *(une seule bonne réponse)*

- [ ] **A.** Le répertoire existant est supprimé puis recréé
- [ ] **B.** Une erreur PHP fatale est déclenchée
- [ ] **C.** La fonction ignore silencieusement les répertoires déjà existants
- [ ] **D.** Une exception est systématiquement levée

### Question 7

Qu'est-ce qui affecte les permissions réelles du répertoire créé, en plus du mode passé en argument ? *(une seule bonne réponse)*

- [ ] **A.** La version de PHP utilisée
- [ ] **B.** Le fuseau horaire configuré
- [ ] **C.** Rien d'autre, le mode passé est toujours appliqué tel quel
- [ ] **D.** L'`umask` courant

## exists

### Question 8

Que retourne `Filesystem::exists()` si on lui passe un tableau de plusieurs chemins ? *(une seule bonne réponse)*

- [ ] **A.** `true` tant qu'au moins un des chemins existe
- [ ] **B.** Un tableau de booléens, un par chemin
- [ ] **C.** Toujours `true`, sans vérification réelle pour les tableaux
- [ ] **D.** `false` si au moins un des chemins est manquant

### Question 9

Comment sont résolus les chemins non absolus passés à `exists()` ? *(une seule bonne réponse)*

- [ ] **A.** Relativement au répertoire personnel de l'utilisateur système
- [ ] **B.** Ils provoquent toujours une exception, seuls les chemins absolus étant acceptés
- [ ] **C.** Relativement au répertoire où se trouve le script PHP en cours d'exécution
- [ ] **D.** Relativement au répertoire racine du serveur web

## copy

### Question 10

Que fait `Filesystem::copy()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle déplace un fichier plutôt que de le copier
- [ ] **B.** Elle crée uniquement un lien symbolique vers le fichier source
- [ ] **C.** Elle copie un unique fichier (utiliser `mirror()` pour copier des répertoires)
- [ ] **D.** Elle copie aussi bien des fichiers que des répertoires entiers

### Question 11

Par défaut, sous quelle condition le fichier cible est-il réellement copié si la cible existe déjà ? *(une seule bonne réponse)*

- [ ] **A.** Seulement si les deux fichiers ont une taille identique
- [ ] **B.** Seulement si la date de modification de la source est postérieure à celle de la cible
- [ ] **C.** Toujours, la cible étant systématiquement écrasée
- [ ] **D.** Jamais, il faut toujours supprimer la cible manuellement avant

### Question 12

Comment forcer l'écrasement de la cible même si elle n'est pas plus ancienne que la source ? *(une seule bonne réponse)*

- [ ] **A.** En passant `force: true` dans un tableau d'options
- [ ] **B.** En passant `true` comme troisième argument
- [ ] **C.** En appelant `remove()` avant `copy()`, aucune option n'existant sur `copy()`
- [ ] **D.** Ce n'est pas possible, `copy()` refuse toujours d'écraser un fichier plus récent

## touch

### Question 13

Que configure `Filesystem::touch()` par défaut, si aucun argument supplémentaire n'est fourni ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement les permissions du fichier
- [ ] **B.** Le propriétaire du fichier
- [ ] **C.** Les dates d'accès et de modification sont mises à l'heure courante
- [ ] **D.** Uniquement la date de création du fichier

### Question 14

Que représentent respectivement le deuxième et le troisième argument de `touch()` ? *(une seule bonne réponse)*

- [ ] **A.** Le deuxième est le temps d'accès, le troisième le temps de modification
- [ ] **B.** Les deux arguments définissent la même valeur, dupliquée pour compatibilité
- [ ] **C.** Le deuxième est un booléen `recursive`, le troisième le temps de modification
- [ ] **D.** Le deuxième est le temps de modification, le troisième le temps d'accès

## chown / chgrp

### Question 15

Que représente le troisième argument de `Filesystem::chown()` ? *(une seule bonne réponse)*

- [ ] **A.** Le mode de permission à appliquer en même temps
- [ ] **B.** Le groupe à associer au fichier
- [ ] **C.** Un booléen indiquant s'il faut suivre les liens symboliques
- [ ] **D.** Un booléen indiquant si le changement de propriétaire doit être récursif

### Question 16

À quoi sert `Filesystem::chgrp()` ? *(une seule bonne réponse)*

- [ ] **A.** À changer l'utilisateur propriétaire d'un fichier
- [ ] **B.** À changer les permissions d'un fichier
- [ ] **C.** À vérifier à quel groupe appartient un fichier, sans le modifier
- [ ] **D.** À changer le groupe propriétaire d'un fichier, avec un troisième argument booléen pour le mode récursif

## chmod

### Question 17

Quel est le quatrième argument de `Filesystem::chmod()` ? *(une seule bonne réponse)*

- [ ] **A.** Le propriétaire à appliquer en même temps que le mode
- [ ] **B.** Un umask à appliquer avant le mode récursif, le quatrième argument étant en réalité le mode lui-même
- [ ] **C.** Une liste d'exclusions de fichiers à ne pas modifier
- [ ] **D.** Un booléen indiquant si le changement de mode doit être récursif

### Question 18

Dans l'exemple `$filesystem->chmod('src', 0700, 0000, true)`, à quoi correspond le troisième argument (`0000`) ? *(une seule bonne réponse)*

- [ ] **A.** Le mode à appliquer aux sous-répertoires uniquement
- [ ] **B.** Le nombre de niveaux de récursivité
- [ ] **C.** Le propriétaire numérique (UID)
- [ ] **D.** Un umask

## remove

### Question 19

Que peut supprimer `Filesystem::remove()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Des fichiers
- [ ] **B.** Des répertoires
- [ ] **C.** Des liens symboliques
- [ ] **D.** Des utilisateurs système

## rename

### Question 20

Que fait `Filesystem::rename()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle renomme récursivement tous les fichiers d'un répertoire
- [ ] **B.** Elle ne fonctionne que sur les fichiers, jamais sur les répertoires
- [ ] **C.** Elle crée une copie renommée, en conservant l'original
- [ ] **D.** Elle change le nom d'un unique fichier ou répertoire

### Question 21

Que permet le troisième argument booléen optionnel de `rename()` ? *(une seule bonne réponse)*

- [ ] **A.** De créer un lien symbolique plutôt que de renommer réellement
- [ ] **B.** D'écraser la cible si elle existe déjà
- [ ] **C.** De renommer récursivement les sous-répertoires
- [ ] **D.** D'annuler l'opération si la cible existe déjà (comportement inverse du défaut)

## symlink

### Question 22

Que fait `Filesystem::symlink()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle copie un fichier en dupliquant son contenu
- [ ] **B.** Elle déplace un fichier en supprimant l'original
- [ ] **C.** Elle vérifie si un chemin est déjà un lien symbolique
- [ ] **D.** Elle crée un lien symbolique depuis la cible vers la destination

### Question 23

Que permet le troisième argument booléen de `symlink()`, si le système de fichiers ne supporte pas les liens symboliques ? *(une seule bonne réponse)*

- [ ] **A.** De forcer la création du lien malgré tout, provoquant une erreur silencieuse
- [ ] **B.** De basculer automatiquement vers un lien physique (hard link)
- [ ] **C.** De lever systématiquement une exception explicite
- [ ] **D.** De dupliquer le répertoire source au lieu de créer un lien

## readlink

### Question 24

Contrairement à la fonction `readlink()` native de PHP, comment se comporte `Filesystem::readlink()` ? *(une seule bonne réponse)*

- [ ] **A.** Il est strictement identique à la fonction native, sans différence
- [ ] **B.** Il se comporte de la même façon sur tous les systèmes d'exploitation
- [ ] **C.** Il ne fonctionne que sous Windows, contrairement à la fonction PHP native
- [ ] **D.** Il nécessite l'extension POSIX, contrairement à la fonction native

### Question 25

Que retourne `readlink()` quand `$canonicalize` vaut `false` et que le chemin n'existe pas ou n'est pas un lien ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne vide
- [ ] **B.** `false`
- [ ] **C.** Une exception est levée
- [ ] **D.** `null`

### Question 26

Que retourne `readlink()` quand `$canonicalize` vaut `true` et que le chemin existe ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le lien direct suivant, sans résolution complète
- [ ] **B.** Le chemin passé en argument, inchangé
- [ ] **C.** Toujours `null`, quel que soit le chemin
- [ ] **D.** Sa version absolue totalement résolue (liens imbriqués compris)

### Question 27

Que recommande la documentation d'utiliser si l'on veut canonicaliser un chemin sans vérifier son existence ? *(une seule bonne réponse)*

- [ ] **A.** La fonction PHP `realpath()`
- [ ] **B.** `Filesystem::normalize()`
- [ ] **C.** `Path::canonicalize()`
- [ ] **D.** `Filesystem::readlink()` avec `canonicalize` à `true`

## makePathRelative

### Question 28

Que fait `Filesystem::makePathRelative()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle convertit un chemin relatif en chemin absolu
- [ ] **B.** Elle vérifie si un chemin est relatif ou absolu
- [ ] **C.** Elle fusionne deux chemins en un seul chemin absolu
- [ ] **D.** Elle prend deux chemins absolus et retourne le chemin relatif du second vers le premier

### Question 29

Que retourne `makePathRelative('/tmp/videos', '/tmp')` ? *(une seule bonne réponse)*

- [ ] **A.** `'tmp/videos/'`
- [ ] **B.** `'videos/'`
- [ ] **C.** `'/tmp/videos'`
- [ ] **D.** `'../videos'`

## mirror

### Question 30

Que fait `Filesystem::mirror()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle copie un unique fichier vers une destination
- [ ] **B.** Elle crée un lien symbolique du répertoire source vers la cible
- [ ] **C.** Elle synchronise en temps réel deux répertoires via un watcher
- [ ] **D.** Elle copie tout le contenu du répertoire source dans le répertoire cible

### Question 31

Que fait l'option `override` (par défaut `false`) de `mirror()` ? *(une seule bonne réponse)*

- [ ] **A.** Si `true`, le répertoire cible est entièrement supprimé avant la copie
- [ ] **B.** Elle n'a aucun effet, dépréciée depuis les dernières versions
- [ ] **C.** Si `true`, les fichiers cibles plus récents que les fichiers source sont écrasés
- [ ] **D.** Si `true`, seuls les nouveaux fichiers sont copiés, les autres étant ignorés

### Question 32

À quoi sert l'option `copy_on_windows` de `mirror()` ? *(une seule bonne réponse)*

- [ ] **A.** À activer le support `mirror()` exclusivement sous Windows
- [ ] **B.** À convertir automatiquement les chemins Windows en chemins UNIX
- [ ] **C.** À forcer l'utilisation de liens symboliques même sous Windows
- [ ] **D.** À copier les fichiers plutôt que les liens sous Windows

### Question 33

Que fait l'option `delete` (par défaut `false`) de `mirror()` ? *(une seule bonne réponse)*

- [ ] **A.** Supprime tous les fichiers cachés de la cible
- [ ] **B.** Désactive la vérification des dates de modification
- [ ] **C.** Supprime dans la cible les fichiers qui ne sont pas présents dans la source
- [ ] **D.** Supprime le répertoire source une fois la copie terminée

## isAbsolutePath

### Question 34

Que retourne `Filesystem::isAbsolutePath('c:\\Windows')` ? *(une seule bonne réponse)*

- [ ] **A.** `null`, car le chemin ne commence pas par un slash
- [ ] **B.** `true`
- [ ] **C.** `false`
- [ ] **D.** Une exception, les chemins Windows n'étant pas supportés par cette méthode

## tempnam

### Question 35

Que fait `Filesystem::tempnam()`, et que se passe-t-il en cas d'échec ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne `null` silencieusement en cas d'échec, sans exception
- [ ] **B.** Elle crée un fichier temporaire avec un nom unique et retourne son chemin, ou lève une exception en cas d'échec
- [ ] **C.** Elle crée un fichier temporaire et retourne toujours `true`/`false` selon le succès
- [ ] **D.** Elle ne fait que générer un nom de fichier, sans créer réellement le fichier

### Question 36

À quoi sert le troisième argument optionnel de `tempnam()` (ex. `'.png'`) ? *(une seule bonne réponse)*

- [ ] **A.** À définir un préfixe supplémentaire, en plus du deuxième argument
- [ ] **B.** À définir un suffixe pour le nom du fichier temporaire généré
- [ ] **C.** À définir le mode de permission du fichier
- [ ] **D.** À forcer une extension MIME spécifique

## dumpFile

### Question 37

Comment `Filesystem::dumpFile()` garantit-elle qu'un utilisateur ne verra jamais un fichier partiellement écrit ? *(une seule bonne réponse)*

- [ ] **A.** Elle écrit directement dans le fichier final, mais désactive temporairement les lectures concurrentes
- [ ] **B.** Elle ne garantit rien de particulier à ce sujet
- [ ] **C.** Elle écrit d'abord un fichier temporaire puis le déplace vers l'emplacement final (écriture atomique)
- [ ] **D.** Elle verrouille le fichier final pendant toute la durée de l'écriture

### Question 38

Que fait `dumpFile()` si le répertoire cible n'existe pas encore ? *(une seule bonne réponse)*

- [ ] **A.** Elle lève systématiquement une exception
- [ ] **B.** Elle échoue silencieusement, sans écrire le fichier
- [ ] **C.** Elle écrit le fichier dans le répertoire courant à la place
- [ ] **D.** Elle crée le fichier et son répertoire s'ils n'existent pas

### Question 39

Quel type d'écriture (atomique ou non) caractérise `dumpFile()`, par opposition à un simple `file_put_contents()` ? *(une seule bonne réponse)*

- [ ] **A.** Une écriture asynchrone en arrière-plan
- [ ] **B.** Il n'y a aucune différence avec `file_put_contents()`
- [ ] **C.** Une écriture atomique
- [ ] **D.** Une écriture bufferisée mais non atomique

## appendToFile

### Question 40

Que fait `Filesystem::appendToFile()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle fusionne deux fichiers en un seul
- [ ] **B.** Elle ajoute du nouveau contenu à la fin d'un fichier existant
- [ ] **C.** Elle remplace entièrement le contenu d'un fichier
- [ ] **D.** Elle insère du contenu au début du fichier

### Question 41

Que permet le troisième argument optionnel d'`appendToFile()` ? *(une seule bonne réponse)*

- [ ] **A.** De limiter la taille maximale du contenu ajouté
- [ ] **B.** D'indiquer si le fichier doit être verrouillé pendant l'écriture
- [ ] **C.** De définir un préfixe à ajouter avant le contenu
- [ ] **D.** De définir le mode de permission du fichier

### Question 42

Que se passe-t-il si ni le fichier ni son répertoire parent n'existent lors de l'appel à `appendToFile()` ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier est créé mais son répertoire parent doit exister au préalable
- [ ] **B.** La méthode les crée avant d'ajouter le contenu
- [ ] **C.** Une exception est systématiquement levée
- [ ] **D.** Le contenu est simplement ignoré, sans erreur

## readFile

### Question 43

En quoi `Filesystem::readFile()` diffère-t-il de la fonction PHP `file_get_contents()` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne que sur des fichiers distants (URLs), jamais en local
- [ ] **B.** Il est strictement identique, seul le nom de la méthode change
- [ ] **C.** Il lève une exception quand le chemin n'est pas lisible ou pointe vers un répertoire plutôt qu'un fichier
- [ ] **D.** Il retourne toujours un tableau de lignes, jamais une chaîne unique

### Question 44

Que retourne `readFile()` ? *(une seule bonne réponse)*

- [ ] **A.** Un objet `SplFileObject` représentant le fichier
- [ ] **B.** Le nombre d'octets lus, sans le contenu lui-même
- [ ] **C.** Un tableau associatif ligne par ligne
- [ ] **D.** L'ensemble du contenu du fichier sous forme de chaîne

## Path Manipulation Utilities

### Question 45

Quelles difficultés typiques la documentation cite-t-elle concernant la manipulation de chemins de fichiers ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les différences de plateforme (UNIX vs Windows)
- [ ] **B.** La conversion entre chemins absolus et relatifs
- [ ] **C.** Le chiffrement des noms de fichiers
- [ ] **D.** La compression automatique des chemins longs

### Question 46

Sous Windows, les séparateurs de chemin de type slash (`/`) fonctionnent-ils, en plus des antislashs ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend uniquement de la version de PHP installée
- [ ] **B.** Oui, Windows accepte aussi les slashs, les deux types de séparateurs fonctionnant généralement
- [ ] **C.** Non, Windows n'accepte que les antislashs
- [ ] **D.** Non, il faut toujours utiliser `Path::normalize()` au préalable pour convertir les slashs

## Canonicalization

### Question 47

Que fait `Path::canonicalize()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle vérifie si le chemin existe réellement sur le disque
- [ ] **B.** Elle convertit un chemin relatif en chemin absolu, sans autre traitement
- [ ] **C.** Elle chiffre le chemin pour le stocker de façon sécurisée
- [ ] **D.** Elle retourne le nom de chemin le plus court équivalent au chemin donné

### Question 48

Que deviennent les antislashs lors de la canonicalisation d'un chemin ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont doublés pour l'échappement
- [ ] **B.** Ils restent inchangés, uniquement les segments `".."` étant traités
- [ ] **C.** Ils sont convertis en slashs (forward slashes)
- [ ] **D.** Ils sont supprimés purement et simplement

### Question 49

Les chemins racines (comme `/` ou `C:/`) se terminent-ils par un slash après canonicalisation, contrairement aux chemins non racines ? *(une seule bonne réponse)*

- [ ] **A.** Non, aucun chemin ne se termine jamais par un slash après canonicalisation
- [ ] **B.** Oui, mais uniquement sous Windows
- [ ] **C.** Cela dépend du système de fichiers utilisé, jamais garanti
- [ ] **D.** Oui, les chemins racines se terminent toujours par un slash, les chemins non racines jamais

### Question 50

Que se passe-t-il avec les segments `".."` situés au tout début d'un chemin relatif lors de la canonicalisation ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont remplacés par le répertoire personnel de l'utilisateur
- [ ] **B.** Ils sont conservés tels quels
- [ ] **C.** Ils sont toujours supprimés, quel que soit le contexte
- [ ] **D.** Ils provoquent systématiquement une exception

### Question 51

Que fait `canonicalize()` face à un chemin malformé (ex. `'C:Programs/PHP/php.ini'`) ? *(une seule bonne réponse)*

- [ ] **A.** Il tente de le corriger automatiquement en devinant l'intention
- [ ] **B.** Il retourne toujours une chaîne vide dans ce cas
- [ ] **C.** Il le retourne inchangé
- [ ] **D.** Il lève une exception explicite

## Joining Paths

### Question 52

Que fait `Path::join()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle vérifie uniquement si deux chemins sont identiques
- [ ] **B.** Elle sépare un chemin en ses différents segments
- [ ] **C.** Elle transforme un chemin relatif en chemin absolu uniquement
- [ ] **D.** Elle concatène les chemins donnés et normalise les séparateurs

### Question 53

Que se passe-t-il si l'un des arguments passés à `join()` est une chaîne vide ? *(une seule bonne réponse)*

- [ ] **A.** Le résultat final est une chaîne vide
- [ ] **B.** Un slash supplémentaire est inséré à sa place
- [ ] **C.** Cette partie vide est ignorée
- [ ] **D.** Une exception est levée

### Question 54

Que se passe-t-il avec un slash de tête (leading slash) dans un argument autre que le premier passé à `join()` ? *(une seule bonne réponse)*

- [ ] **A.** Il transforme tout le chemin résultant en chemin absolu, peu importe le premier argument
- [ ] **B.** Il est supprimé
- [ ] **C.** Il est conservé tel quel, dupliquant potentiellement les séparateurs
- [ ] **D.** Il provoque une exception

### Question 55

Les slashs de fin (trailing slashes) sont-ils conservés par `join()`, sauf pour les chemins racines ? *(une seule bonne réponse)*

- [ ] **A.** Non, ils sont toujours retirés, sans exception pour les racines
- [ ] **B.** Cela dépend uniquement du système d'exploitation
- [ ] **C.** Non, ils sont retirés sauf s'il s'agit d'un chemin racine (ex. `Path::join('/', '')` => `'/'`)
- [ ] **D.** Oui, ils sont toujours conservés, quel que soit le chemin

### Question 56

Combien d'arguments `Path::join()` peut-il accepter ? *(une seule bonne réponse)*

- [ ] **A.** Au maximum trois
- [ ] **B.** Un seul argument, un tableau de segments
- [ ] **C.** Un nombre quelconque
- [ ] **D.** Exactement deux

## Converting Absolute/Relative Paths

### Question 57

Que fait `Path::makeAbsolute()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle transforme n'importe quel chemin absolu en chemin relatif
- [ ] **B.** Elle vérifie si un chemin est déjà absolu, sans le transformer
- [ ] **C.** Elle attend un chemin relatif et un chemin de base, pour construire le chemin absolu correspondant
- [ ] **D.** Elle attend uniquement un chemin absolu et le retourne canonicalisé

### Question 58

Que se passe-t-il si un chemin déjà absolu est passé en premier argument à `makeAbsolute()` ? *(une seule bonne réponse)*

- [ ] **A.** Le chemin absolu est ignoré silencieusement, seul le chemin de base est retourné
- [ ] **B.** Le chemin absolu est retourné inchangé
- [ ] **C.** Une exception est levée, seul un chemin relatif étant accepté
- [ ] **D.** Le chemin de base remplace entièrement le chemin absolu fourni

### Question 59

`makeAbsolute()` résout-elle les segments `".."` présents dans le chemin ? *(une seule bonne réponse)*

- [ ] **A.** Non, cela provoque une exception
- [ ] **B.** Uniquement si le chemin de base est lui-même relatif
- [ ] **C.** Oui, elle les résout s'il y en a
- [ ] **D.** Non, ils sont laissés tels quels dans le résultat

### Question 60

Que fait `Path::makeRelative()` par rapport à `makeAbsolute()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle fait exactement la même chose, sous un nom différent
- [ ] **B.** Elle canonicalise le chemin sans changer son caractère absolu/relatif
- [ ] **C.** Elle vérifie uniquement si un chemin est relatif, sans le transformer
- [ ] **D.** C'est l'opération inverse : elle rend un chemin absolu relatif à un chemin de base

### Question 61

Si le chemin donné à `makeRelative()` n'est pas contenu dans le chemin de base, que fait la méthode ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne une chaîne vide
- [ ] **B.** Elle ajoute autant de segments `".."` que nécessaire au début du résultat
- [ ] **C.** Elle lève systématiquement une exception
- [ ] **D.** Elle retourne le chemin absolu inchangé

### Question 62

Les méthodes `makeAbsolute()`, `makeRelative()`, `isAbsolute()` et `isRelative()` canonicalisent-elles en interne le chemin passé ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend d'une option à activer explicitement
- [ ] **B.** Oui, toutes les quatre canonicalisent le chemin en interne
- [ ] **C.** Non, aucune d'entre elles ne le fait
- [ ] **D.** Seules `makeAbsolute()` et `makeRelative()` le font, pas les deux méthodes `isXxx()`

## Finding Longest Common Base Paths

### Question 63

À quoi sert `Path::getLongestCommonBasePath()` ? *(une seule bonne réponse)*

- [ ] **A.** À trouver le chemin le plus court parmi une liste
- [ ] **B.** À fusionner plusieurs chemins en un seul chemin absolu
- [ ] **C.** À vérifier si tous les chemins d'une liste existent réellement sur le disque
- [ ] **D.** À trouver le chemin de base commun le plus long parmi une liste de chemins

### Question 64

Pourquoi cette méthode est-elle utile pour stocker des chemins de fichiers absolus ? *(une seule bonne réponse)*

- [ ] **A.** Elle permet de convertir automatiquement les chemins en URLs
- [ ] **B.** Elle garantit l'unicité des noms de fichiers
- [ ] **C.** Elle permet de raccourcir les chemins stockés en évitant la duplication d'informations
- [ ] **D.** Elle permet de chiffrer les chemins avant stockage

### Question 65

`getLongestCommonBasePath()` retourne-t-elle des chemins canoniques ? *(une seule bonne réponse)*

- [ ] **A.** Non, elle retourne le chemin tel quel, sans normalisation
- [ ] **B.** Cela dépend du système d'exploitation
- [ ] **C.** Non, seulement si on le demande explicitement via une option
- [ ] **D.** Oui, elle retourne toujours des chemins canoniques

### Question 66

Que fait `Path::isBasePath()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle vérifie si un chemin est absolu
- [ ] **B.** Elle transforme un chemin relatif en chemin de base absolu
- [ ] **C.** Elle teste si un chemin est un chemin de base d'un autre chemin
- [ ] **D.** Elle retourne le chemin de base commun à deux chemins

## Finding Directories/Root Directories

### Question 67

Parmi les défauts cités de la fonction PHP native `dirname()`, lesquels sont corrects ? *(plusieurs bonnes réponses)*

- [ ] **A.** `dirname("C:/Programs")` retourne `"C:"`, pas `"C:/"`
- [ ] **B.** `dirname()` ne canonicalise pas le résultat
- [ ] **C.** `dirname()` n'accepte pas les antislashs sous UNIX
- [ ] **D.** `dirname()` lève toujours une exception sur un chemin Windows

### Question 68

Que fait `Path::getDirectory()` par rapport à `dirname()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle est strictement identique à `dirname()`, sans aucune différence
- [ ] **B.** Elle ne fonctionne que sur les chemins UNIX, jamais sur les chemins Windows
- [ ] **C.** Elle retourne toujours un chemin relatif, jamais absolu
- [ ] **D.** Elle corrige les défauts (« quirks ») de `dirname()`, notamment sur les chemins Windows et la canonicalisation

### Question 69

Que retourne `Path::getRoot("C:\\Programs\\Apache\\Config")` ? *(une seule bonne réponse)*

- [ ] **A.** `/`
- [ ] **B.** `Programs/`
- [ ] **C.** `C:/`
- [ ] **D.** `C:\`

### Question 70

À quoi sert `Path::getRoot()` ? *(une seule bonne réponse)*

- [ ] **A.** À obtenir le répertoire parent immédiat d'un chemin
- [ ] **B.** À vérifier si un chemin est déjà une racine
- [ ] **C.** À lister tous les disques/points de montage disponibles sur le système
- [ ] **D.** À obtenir la racine d'un chemin donné

## Error Handling

### Question 71

Quelles interfaces d'exception le composant Filesystem peut-il lever en cas de problème ? *(plusieurs bonnes réponses)*

- [ ] **A.** `ExceptionInterface`
- [ ] **B.** `IOExceptionInterface`
- [ ] **C.** `RuntimeExceptionInterface` (interface générique PHP)
- [ ] **D.** `FileNotFoundExceptionInterface`

### Question 72

Dans quel cas précis une `IOException` est-elle explicitement mentionnée comme étant levée ? *(une seule bonne réponse)*

- [ ] **A.** Si un fichier est manquant lors d'une lecture
- [ ] **B.** Si les permissions sont insuffisantes pour lire un fichier
- [ ] **C.** Si le disque est plein
- [ ] **D.** Si la création d'un répertoire échoue

---

## Corrigé

**Question 1 : D** — « The Filesystem component provides platform-independent utilities for filesystem operations and for file/directory paths manipulation. » *(§ Installation et usage de base)*

**Question 2 : B** — « The component contains two main classes called `Filesystem` and `Path`. » *(§ Installation et usage de base)*

**Question 3 : D** — « `use Symfony\Component\Filesystem\Exception\IOExceptionInterface;` (…) `} catch (IOExceptionInterface $exception) { ... }`. » *(§ Installation et usage de base)*

**Question 4 : C** — « `Filesystem::mkdir` creates a directory recursively. » *(§ mkdir)*

**Question 5 : D** — « On POSIX filesystems, directories are created with a default mode value `0777`. » *(§ mkdir)*

**Question 6 : C** — « This function ignores already existing directories. » *(§ mkdir)*

**Question 7 : D** — « The directory permissions are affected by the current umask. » *(§ mkdir)*

**Question 8 : D** — « `Filesystem::exists` checks for the presence of one or more files or directories and returns `false` if any of them is missing. » *(§ exists)*

**Question 9 : C** — « non-absolute paths are relative to the directory where the running PHP script is stored. » *(§ exists)*

**Question 10 : C** — « `Filesystem::copy` makes a copy of a single file (use `mirror` to copy directories). » *(§ copy)*

**Question 11 : B** — « If the target already exists, the file is copied only if the source modification date is later than the target. » *(§ copy)*

**Question 12 : B** — « This behavior can be overridden by the third boolean argument: `$filesystem->copy('image-ICC.jpg', 'image.jpg', true);`. » *(§ copy)*

**Question 13 : C** — « `Filesystem::touch` sets access and modification time for a file. The current time is used by default. » *(§ touch)*

**Question 14 : D** — « `$filesystem->touch('file.txt', time() + 10);` (…) `$filesystem->touch('file.txt', time(), time() - 10);` — the second argument sets modification time, the third the access time. » *(§ touch)*

**Question 15 : D** — « `Filesystem::chown` changes the owner of a file. The third argument is a boolean recursive option. » *(§ chown / chgrp)*

**Question 16 : D** — « `Filesystem::chgrp` changes the group of a file. The third argument is a boolean recursive option. » *(§ chown / chgrp)*

**Question 17 : D** — « `Filesystem::chmod` changes the mode or permissions of a file. The fourth argument is a boolean recursive option. » *(§ chmod)*

**Question 18 : D** — « `$filesystem->chmod('src', 0700, 0000, true);` » — le troisième argument est un umask. *(§ chmod)*

**Question 19 : A, B, C** — « `Filesystem::remove` deletes files, directories and symlinks. » *(§ remove)*

**Question 20 : D** — « `Filesystem::rename` changes the name of a single file or directory. » *(§ rename)*

**Question 21 : B** — « if the target already exists, a third boolean argument is available to overwrite. » *(§ rename)*

**Question 22 : D** — « `Filesystem::symlink` creates a symbolic link from the target to the destination. » *(§ symlink)*

**Question 23 : D** — « If the filesystem does not support symbolic links, a third boolean argument is available: (…) duplicates the source directory. » *(§ symlink)*

**Question 24 : B** — « The `Filesystem::readlink` method (…) behaves in the same way on all operating systems (unlike PHP's `readlink` function). » *(§ readlink)*

**Question 25 : D** — « When `$canonicalize` is `false`: if `$path` does not exist or is not a link, it returns `null`. » *(§ readlink)*

**Question 26 : D** — « When `$canonicalize` is `true`: if `$path` exists, it returns its absolute fully resolved final version. » *(§ readlink)*

**Question 27 : C** — « If you wish to canonicalize the path without checking its existence, you can use `Path::canonicalize` method instead. » *(§ readlink)*

**Question 28 : D** — « `Filesystem::makePathRelative` takes two absolute paths and returns the relative path from the second path to the first one. » *(§ makePathRelative)*

**Question 29 : B** — « `$filesystem->makePathRelative('/tmp/videos', '/tmp'); // returns 'videos/'`. » *(§ makePathRelative)*

**Question 30 : D** — « `Filesystem::mirror` copies all the contents of the source directory into the target one. » *(§ mirror)*

**Question 31 : C** — « `override` (default: `false`): If true, target files newer than origin files are overwritten. » *(§ mirror)*

**Question 32 : D** — « `copy_on_windows` (default: `false`): Whether to copy files instead of links on Windows. » *(§ mirror)*

**Question 33 : C** — « `delete` (default: `false`): Whether to delete files that are not in the source directory. » *(§ mirror)*

**Question 34 : B** — « `$filesystem->isAbsolutePath('c:\Windows'); // returns true`. » *(§ isAbsolutePath)*

**Question 35 : B** — « `Filesystem::tempnam` creates a temporary file with a unique filename, and returns its path, or throw an exception on failure. » *(§ tempnam)*

**Question 36 : B** — « `$filesystem->tempnam('/tmp', 'prefix_', '.png'); // returns a path like : /tmp/prefix_wyjgtF.png`. » *(§ tempnam)*

**Question 37 : C** — « `Filesystem::dumpFile` saves the given contents into a file (…) It does this in an atomic manner: it writes a temporary file first and then moves it. » *(§ dumpFile)*

**Question 38 : D** — « saves the given contents into a file (creating the file and its directory if they don't exist). » *(§ dumpFile)*

**Question 39 : C** — « It does this in an atomic manner (…) the user will always see either the complete old file or complete new file (but never a partially-written file). » *(§ dumpFile)*

**Question 40 : B** — « `Filesystem::appendToFile` adds new contents at the end of some file. » *(§ appendToFile)*

**Question 41 : B** — « the third argument tells whether the file should be locked when writing to it. » *(§ appendToFile)*

**Question 42 : B** — « If either the file or its containing directory doesn't exist, this method creates them before appending the contents. » *(§ appendToFile)*

**Question 43 : C** — « Unlike the `file_get_contents` function from PHP, it throws an exception when the given file path is not readable and when passing the path to a directory instead of a file. » *(§ readFile)*

**Question 44 : D** — « `Filesystem::readFile` returns all the contents of a file as a string. » *(§ readFile)*

**Question 45 : A, B** — « Platform differences: file paths look different on different platforms (…) Absolute/relative paths: web applications frequently need to deal with absolute and relative paths. » *(§ Path Manipulation Utilities)*

**Question 46 : B** — « Windows also accepts forward slashes, so both types of separators generally work. » *(§ Path Manipulation Utilities)*

**Question 47 : D** — « Returns the shortest path name equivalent to the given path. » *(§ Canonicalization)*

**Question 48 : C** — « backslashes ("\\") are converted into forward slashes ("/"). » *(§ Canonicalization)*

**Question 49 : D** — « root paths ("/" and "C:/") always terminate with a slash; non-root paths never terminate with a slash. » *(§ Canonicalization)*

**Question 50 : B** — « When a relative path is passed, ".." segments at the beginning of the path are kept. » *(§ Canonicalization)*

**Question 51 : C** — « Malformed paths are returned unchanged: `Path::canonicalize('C:Programs/PHP/php.ini'); // => C:Programs/PHP/php.ini`. » *(§ Canonicalization)*

**Question 52 : D** — « The `Path::join` method concatenates the given paths and normalizes separators. » *(§ Joining Paths)*

**Question 53 : C** — « Empty parts are ignored. » *(§ Joining Paths)*

**Question 54 : B** — « Leading slashes in subsequent arguments are removed. » *(§ Joining Paths)*

**Question 55 : C** — « Trailing slashes are preserved only for root paths (…) `Path::join('/', ''); // => /`. » *(§ Joining Paths)*

**Question 56 : C** — « Works with any number of arguments. » *(§ Joining Paths)*

**Question 57 : C** — « `Path::makeAbsolute` method expects a relative path and a base path to base that relative path upon. » *(§ Converting Absolute/Relative Paths)*

**Question 58 : B** — « If an absolute path is passed in the first argument, the absolute path is returned unchanged. » *(§ Converting Absolute/Relative Paths)*

**Question 59 : C** — « The method resolves ".." segments, if there are any. » *(§ Converting Absolute/Relative Paths)*

**Question 60 : D** — « `Path::makeRelative` is the inverse operation to `Path::makeAbsolute`. » *(§ Converting Absolute/Relative Paths)*

**Question 61 : B** — « If the path is not within the base path, the method will prepend ".." segments as necessary. » *(§ Converting Absolute/Relative Paths)*

**Question 62 : B** — « All four methods internally canonicalize the passed path. » *(§ Converting Absolute/Relative Paths)*

**Question 63 : D** — « You can use `Path::getLongestCommonBasePath` to check a list of paths for a common base path. » *(§ Finding Longest Common Base Paths)*

**Question 64 : C** — « Especially when storing many paths, the amount of duplicated information is noticeable (…) Use this common base path to shorten the stored paths. » *(§ Finding Longest Common Base Paths)*

**Question 65 : D** — « `Path::getLongestCommonBasePath` always returns canonical paths. » *(§ Finding Longest Common Base Paths)*

**Question 66 : C** — « Use `Path::isBasePath` to test whether a path is a base path of another path. » *(§ Finding Longest Common Base Paths)*

**Question 67 : A, B, C** — « `dirname()` does not accept backslashes on UNIX (…) `dirname("C:/Programs")` returns "C:", not "C:/" (…) `dirname()` does not canonicalize the result. » *(§ Finding Directories/Root Directories)*

**Question 68 : D** — « `Path::getDirectory` fixes these shortcomings. » *(§ Finding Directories/Root Directories)*

**Question 69 : C** — « `echo Path::getRoot("C:\Programs\Apache\Config"); // => C:/`. » *(§ Finding Directories/Root Directories)*

**Question 70 : D** — « you can use `Path::getRoot` to obtain the root of a path. » *(§ Finding Directories/Root Directories)*

**Question 71 : A, B** — « an exception implementing `Symfony\Component\Filesystem\Exception\ExceptionInterface` or `Symfony\Component\Filesystem\Exception\IOExceptionInterface` is thrown. » *(§ Error Handling)*

**Question 72 : D** — « An `IOException` is thrown if directory creation fails. » *(§ Error Handling)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [components/filesystem.rst](https://github.com/symfony/symfony-docs/blob/8.0/components/filesystem.rst)) : pas de pages annexes à couvrir pour ce QCM.
