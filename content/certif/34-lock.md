# QCM — Le composant Lock

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/components/lock.html](https://symfony.com/doc/8.0/components/lock.html) · **Généré le :** 23 juillet 2026
>
> **91 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation

### Question 1

Que fournit le composant Lock ? *(une seule bonne réponse)*

- [ ] **A.** Un mécanisme de mise en cache distribué basé sur Redis
- [ ] **B.** Un ORM pour gérer les transactions concurrentes
- [ ] **C.** Un mécanisme fournissant un accès exclusif à une ressource partagée (les « locks »)
- [ ] **D.** Un système de files d'attente pour tâches asynchrones

### Question 2

Quelle commande installe le composant Lock ? *(une seule bonne réponse)*

- [ ] **A.** `npm install @symfony/lock`
- [ ] **B.** `composer require symfony/semaphore`
- [ ] **C.** `composer require symfony/mutex`
- [ ] **D.** `composer require symfony/lock`

## Usage

### Question 3

Quelle classe permet de créer des locks ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Lock\LockFactory`
- [ ] **B.** `Symfony\Component\Lock\Lock`
- [ ] **C.** `Symfony\Component\Lock\Key`
- [ ] **D.** `Symfony\Component\Lock\Store\SemaphoreStore`

### Question 4

Que faut-il fournir en plus à `LockFactory` pour créer des locks ? *(une seule bonne réponse)*

- [ ] **A.** Un `Serializer`
- [ ] **B.** Une classe `Store` qui gère le stockage des locks
- [ ] **C.** Un `EventDispatcher`
- [ ] **D.** Un cache PSR-6

### Question 5

Quel est le premier argument de la méthode `createLock()` ? *(une seule bonne réponse)*

- [ ] **A.** Le TTL du lock en secondes
- [ ] **B.** Une chaîne arbitraire représentant la ressource verrouillée
- [ ] **C.** Un booléen indiquant le mode blocking
- [ ] **D.** Une instance de `Key`

### Question 6

Que retourne `acquire()` si le lock ne peut pas être acquis, en mode non bloquant ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne `false`
- [ ] **B.** Elle lève une exception `LockConflictedException`
- [ ] **C.** Elle retourne `null`
- [ ] **D.** Elle bloque indéfiniment jusqu'à obtention du lock

### Question 7

Peut-on appeler `acquire()` plusieurs fois de suite sans risque, même si le lock est déjà acquis ? *(une seule bonne réponse)*

- [ ] **A.** Non, cela lève systématiquement une exception
- [ ] **B.** Non, il faut d'abord appeler `release()`
- [ ] **C.** Oui, la méthode peut être appelée de façon répétée en toute sécurité
- [ ] **D.** Cela dépend uniquement du store utilisé, ce n'est jamais garanti par le composant

### Question 8

Que dit la documentation sur la distinction entre instances de lock, contrairement à d'autres implémentations ? *(une seule bonne réponse)*

- [ ] **A.** Le composant fusionne automatiquement toutes les instances portant sur la même ressource
- [ ] **B.** Deux instances distinctes ne peuvent jamais représenter la même ressource
- [ ] **C.** Chaque appel à `createLock()` régénère systématiquement un nouveau store
- [ ] **D.** Le composant distingue les instances de lock même créées pour la même ressource ; pour un scope et une ressource donnés, une instance peut être acquise plusieurs fois

### Question 9

Si plusieurs services doivent utiliser un même lock, que recommande la documentation ? *(une seule bonne réponse)*

- [ ] **A.** De créer une instance `Lock` séparée par service, le composant les synchronisant automatiquement
- [ ] **B.** Qu'ils partagent la même instance `Lock` retournée par `LockFactory::createLock`
- [ ] **C.** D'utiliser un événement Symfony dédié à la synchronisation
- [ ] **D.** De stocker le lock dans la session HTTP

### Question 10

Que se passe-t-il si l'on ne libère pas explicitement un lock ? *(une seule bonne réponse)*

- [ ] **A.** Il sera libéré automatiquement lors de la destruction de l'instance
- [ ] **B.** Il ne sera jamais libéré, une fuite de ressource est garantie
- [ ] **C.** Le kernel lève une exception à la fin de la requête
- [ ] **D.** Le prochain appel à `createLock()` échoue

### Question 11

Comment désactiver le comportement de libération automatique du lock à la destruction ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `$lock->disableAutoRelease()`
- [ ] **B.** Ce n'est pas possible, la libération automatique est toujours active
- [ ] **C.** En configurant le store avec une option `autoRelease: false` dans le DSN
- [ ] **D.** En passant `false` comme troisième argument de `createLock()`

## Serializing Locks

### Question 12

À quoi sert la classe `Key` ? *(une seule bonne réponse)*

- [ ] **A.** Elle représente le store utilisé pour persister le lock
- [ ] **B.** Elle contient l'état du `Lock` et peut être sérialisée
- [ ] **C.** Elle sert uniquement d'identifiant de log
- [ ] **D.** Elle remplace `LockFactory` dans les tests

### Question 13

Que permet la sérialisation de la `Key` ? *(une seule bonne réponse)*

- [ ] **A.** De partager un même lock entre plusieurs threads du même processus uniquement
- [ ] **B.** De convertir le lock en verrou JSON exploitable côté client
- [ ] **C.** De commencer un job dans un processus en acquérant le lock, puis de continuer ce job dans un autre processus en utilisant la même `Key`
- [ ] **D.** De chiffrer automatiquement le contenu du lock

### Question 14

Dans l'exemple `$factory->createLockFromKey($key, 300, false)`, que représentent le deuxième et le troisième argument, en plus de la `Key` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le TTL
- [ ] **B.** Le store à utiliser
- [ ] **C.** Le flag `autoRelease`
- [ ] **D.** Le nom de la ressource verrouillée

### Question 15

Pourquoi faut-il explicitement mettre `autoRelease` à `false` dans cet exemple de sérialisation ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le store `SemaphoreStore` l'exige systématiquement
- [ ] **B.** Pour permettre au bus de messages de sérialiser correctement l'objet
- [ ] **C.** Pour activer le mode blocking par défaut
- [ ] **D.** Pour éviter que le lock soit libéré lors de l'appel du destructeur, avant que l'autre processus ait terminé le job

### Question 16

Que se passe-t-il si on tente de sérialiser la clé d'un lock utilisant un store incompatible avec la sérialisation, comme `SemaphoreStore` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée
- [ ] **B.** Le lock est silencieusement converti vers un `FlockStore`
- [ ] **C.** La sérialisation réussit mais le lock ne sera jamais restauré
- [ ] **D.** Rien de particulier, tous les stores supportent la sérialisation

### Question 17

Quelles sont les façons de sérialiser des locks selon la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le système de sérialisation natif de PHP et sa fonction `serialize()`
- [ ] **B.** Une extension PECL dédiée, obligatoire
- [ ] **C.** Le composant Serializer
- [ ] **D.** Le format JSON exclusivement

## Blocking Locks

### Question 18

Comment demander un blocking lock via `acquire()` ? *(une seule bonne réponse)*

- [ ] **A.** En configurant le store avec une option `blocking: true`
- [ ] **B.** En passant `true` comme argument de la méthode `acquire()`
- [ ] **C.** Ce n'est pas possible avec ce composant
- [ ] **D.** En appelant une méthode dédiée `acquireBlocking()`

### Question 19

Que fait exactement un blocking lock ? *(une seule bonne réponse)*

- [ ] **A.** Il empêche uniquement les processus situés sur la même machine physique d'acquérir le lock
- [ ] **B.** Il retourne immédiatement `false` si la ressource est occupée, comme le mode non bloquant
- [ ] **C.** Il arrête l'exécution de l'application jusqu'à ce que le lock soit acquis
- [ ] **D.** Il place le job dans une file d'attente Messenger

### Question 20

Que fait la classe `Lock` si le store ne supporte pas nativement les blocking locks (n'implémente pas `BlockingStoreInterface`) ? *(une seule bonne réponse)*

- [ ] **A.** Elle lève immédiatement une exception `LockConflictedException`
- [ ] **B.** Elle retourne `false` sans jamais réessayer
- [ ] **C.** Elle bascule automatiquement vers un `FlockStore` local
- [ ] **D.** Elle réessaie d'acquérir le lock en mode non bloquant jusqu'à ce qu'il soit acquis

### Question 21

Dans quel cas une `LockConflictedException` est-elle levée pour un blocking lock ? *(une seule bonne réponse)*

- [ ] **A.** Si le lock ne peut pas être acquis malgré le mode blocking, par exemple parce que le mécanisme de blocage du store échoue alors que le lock est encore détenu par un autre processus
- [ ] **B.** Systématiquement dès le premier appel à `acquire(true)`
- [ ] **C.** Uniquement lorsque le TTL est dépassé
- [ ] **D.** Jamais, cette exception n'existe pas dans ce composant

## Expiring Locks

### Question 22

Pourquoi les locks créés à distance (remote) sont-ils difficiles à gérer sans mécanisme d'expiration ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le réseau introduit systématiquement une latence de plusieurs secondes
- [ ] **B.** Parce que le store distant ne peut pas savoir si le processus qui a posé le lock est toujours vivant
- [ ] **C.** Parce que PHP ne supporte pas nativement les appels distants
- [ ] **D.** Parce que le token du lock expire après 60 secondes par défaut

### Question 23

Comment configure-t-on la durée de vie (TTL) d'un lock expirant ? *(une seule bonne réponse)*

- [ ] **A.** Via le second argument de la méthode `createLock()`
- [ ] **B.** Via une variable d'environnement `LOCK_TTL`
- [ ] **C.** Le TTL est fixé une fois pour toutes lors de la création du store
- [ ] **D.** Via une méthode `setTtl()` appelée après `acquire()`

### Question 24

Quelle est la valeur par défaut du TTL d'un lock si aucune n'est précisée ? *(une seule bonne réponse)*

- [ ] **A.** 30 secondes
- [ ] **B.** 3600 secondes
- [ ] **C.** 300.0 secondes
- [ ] **D.** Il n'y a pas de valeur par défaut, le TTL est obligatoire

### Question 25

Quel est le principal risque si le TTL choisi est trop court ? *(une seule bonne réponse)*

- [ ] **A.** Le composant refuse de créer le lock
- [ ] **B.** Le store consomme davantage de mémoire
- [ ] **C.** Le lock ne peut plus jamais être rafraîchi
- [ ] **D.** D'autres processus pourraient acquérir le lock avant que le job en cours ne soit terminé

### Question 26

Que recommande la documentation pour ne pas laisser un lock dans un état verrouillé en cas d'erreur pendant le job ? *(une seule bonne réponse)*

- [ ] **A.** De désactiver systématiquement le TTL
- [ ] **B.** D'envelopper le job dans un bloc try/catch/finally pour toujours tenter de libérer le lock expirant
- [ ] **C.** De ne jamais utiliser de locks expirants pour les tâches critiques
- [ ] **D.** D'utiliser exclusivement `acquireRead()` pour ce cas

### Question 27

Pour des tâches longues, quelle méthode permet de réinitialiser le TTL du lock à sa valeur d'origine ? *(une seule bonne réponse)*

- [ ] **A.** `renew()`
- [ ] **B.** `extend()`
- [ ] **C.** `refresh()`
- [ ] **D.** `reset()`

### Question 28

Dans l'exemple d'un lock créé avec `ttl: 30`, après un appel `$lock->refresh(600);`, que se passe-t-il lors de l'appel suivant à `refresh()` sans argument ? *(une seule bonne réponse)*

- [ ] **A.** Il rafraîchit à nouveau pour 600 secondes, cette valeur devenant permanente
- [ ] **B.** Il lève une exception car le TTL a déjà été modifié une fois
- [ ] **C.** Le lock est automatiquement libéré
- [ ] **D.** Il rafraîchit pour 30 secondes, la valeur TTL par défaut du lock

### Question 29

Quelles méthodes sont mentionnées dans la section consacrée aux locks expirants, pour gérer leur cycle de vie ? *(plusieurs bonnes réponses)*

- [ ] **A.** `refresh()`, pour réinitialiser le TTL à sa valeur d'origine
- [ ] **B.** `getRemainingLifetime()`, qui retourne le temps de vie restant
- [ ] **C.** `isExpired()`, qui indique si le lock a expiré
- [ ] **D.** `release()`, pour libérer le lock avant son expiration naturelle

### Question 30

Quand les locks sont-ils automatiquement libérés, selon la sous-section « Automatically Releasing The Lock » ? *(une seule bonne réponse)*

- [ ] **A.** Lorsque leurs objets `Lock` sont détruits
- [ ] **B.** Uniquement lors d'un appel explicite à `release()`
- [ ] **C.** Après exactement 300 secondes, quel que soit le TTL configuré
- [ ] **D.** Jamais automatiquement, il faut toujours appeler `release()`

### Question 31

Dans l'exemple utilisant `pcntl_fork()`, quelle extension PHP doit être installée pour que l'exemple fonctionne ? *(une seule bonne réponse)*

- [ ] **A.** L'extension Sockets
- [ ] **B.** L'extension PCNTL
- [ ] **C.** L'extension Sysvsem
- [ ] **D.** L'extension « Process Control » (différente de PCNTL)

### Question 32

Pour désactiver la libération automatique du lock et le garder acquis 3600 secondes ou jusqu'à `release()` explicite, quel argument de `createLock()` faut-il positionner à `false` ? *(une seule bonne réponse)*

- [ ] **A.** Le premier argument (ressource)
- [ ] **B.** Le deuxième argument (ttl)
- [ ] **C.** Le troisième argument (`autoRelease`)
- [ ] **D.** Il n'existe pas d'argument pour ce comportement, il faut créer un store dédié

## Shared Locks

### Question 33

Que permet un shared lock (« readers-writer lock ») ? *(une seule bonne réponse)*

- [ ] **A.** Un accès concurrent pour les opérations en lecture seule, tandis que les opérations d'écriture nécessitent un accès exclusif
- [ ] **B.** Un accès exclusif systématique, aussi bien pour la lecture que pour l'écriture
- [ ] **C.** Un accès concurrent illimité, y compris en écriture
- [ ] **D.** Un mécanisme de réplication automatique entre plusieurs stores

### Question 34

Quelle méthode permet d'acquérir un lock en lecture seule ? *(une seule bonne réponse)*

- [ ] **A.** `LockInterface::acquire()`
- [ ] **B.** `LockInterface::acquireShared()`
- [ ] **C.** `SharedLockInterface::read()`
- [ ] **D.** `SharedLockInterface::acquireRead()`

### Question 35

De quoi dépend la politique de priorité (« priority policy ») des shared locks de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Elle est toujours identique, quel que soit le store
- [ ] **B.** Du store sous-jacent utilisé — par exemple, le store Redis priorise les lecteurs par rapport aux writers
- [ ] **C.** De l'ordre d'appel entre `acquire()` et `acquireRead()`
- [ ] **D.** D'un paramètre de configuration global du `LockFactory`

### Question 36

Que signifie « promouvoir » un lock en lecture, dans le contexte des shared locks ? *(une seule bonne réponse)*

- [ ] **A.** Le convertir en lock d'écriture en appelant `acquire()`
- [ ] **B.** Prolonger sa durée de vie via `refresh()`
- [ ] **C.** Le partager avec un autre processus via sa `Key` sérialisée
- [ ] **D.** Le transformer en lock non bloquant

### Question 37

De la même façon, comment « démote »-t-on (rétrograde-t-on) un lock d'écriture en lock de lecture ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `release()` puis `createLock()` à nouveau
- [ ] **B.** Ce n'est pas possible, seule la promotion est supportée
- [ ] **C.** Via une méthode `demote()` dédiée
- [ ] **D.** En appelant la méthode `acquireRead()`

### Question 38

Que se passe-t-il si le store fourni n'implémente pas `SharedLockStoreInterface` ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée immédiatement à la création du lock
- [ ] **B.** `acquireRead()` retourne systématiquement `true` sans jamais verrouiller
- [ ] **C.** La classe `Lock` bascule (« fallback ») vers un lock d'écriture, en appelant `acquire()`
- [ ] **D.** Le composant utilise automatiquement `FlockStore` en remplacement

## The Owner of The Lock

### Question 39

Quelle méthode permet de vérifier si l'instance `Lock` courante est (encore) propriétaire du lock ? *(une seule bonne réponse)*

- [ ] **A.** `isOwner()`
- [ ] **B.** `isLocked()`
- [ ] **C.** `hasLock()`
- [ ] **D.** `isAcquired()`

### Question 40

Selon l'avertissement de la documentation, à quoi sert vraiment `isAcquired()` ? *(une seule bonne réponse)*

- [ ] **A.** À vérifier si un lock a déjà été acquis par n'importe quel processus
- [ ] **B.** À vérifier si le lock a été acquis par le processus courant uniquement
- [ ] **C.** À déclencher l'acquisition du lock si ce n'est pas déjà fait
- [ ] **D.** À libérer le lock s'il a expiré

### Question 41

Pourquoi une instance peut-elle perdre automatiquement le lock qu'elle avait acquis ? *(une seule bonne réponse)*

- [ ] **A.** Parce que certains stores ont des locks expirants
- [ ] **B.** Parce que `LockFactory` régénère une nouvelle `Key` à chaque requête
- [ ] **C.** Parce que `release()` est appelé automatiquement toutes les 300 secondes
- [ ] **D.** Ce n'est jamais possible avec ce composant

### Question 42

Techniquement, qui sont les véritables propriétaires du lock selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Les instances de `LockFactory`
- [ ] **B.** Les instances qui partagent la même instance de `Key`, et non de `Lock`
- [ ] **C.** Le store lui-même, indépendamment de tout objet PHP
- [ ] **D.** Les processus PHP identifiés par leur PID

## Available Stores

### Question 43

Quelles interfaces les Stores implémentent-ils ? *(plusieurs bonnes réponses)*

- [ ] **A.** `PersistingStoreInterface`, obligatoire
- [ ] **B.** `SerializableStoreInterface`, obligatoire
- [ ] **C.** `CacheItemPoolInterface`, obligatoire
- [ ] **D.** `BlockingStoreInterface`, optionnelle

### Question 44

D'après le tableau comparatif des stores, lesquels supportent nativement le partage (colonne « Sharing » = yes) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `FlockStore`
- [ ] **B.** `PostgreSqlStore`
- [ ] **C.** `RedisStore`
- [ ] **D.** `DoctrineDbalPostgreSqlStore`

### Question 45

D'après le même tableau, lesquels de ces stores ne supportent pas l'expiration (colonne « Expiring » = no) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `FlockStore`
- [ ] **B.** `RedisStore`
- [ ] **C.** `SemaphoreStore`
- [ ] **D.** `ZookeeperStore`

### Question 46

Quels stores spéciaux Symfony fournit-il, utiles surtout pour les tests ? *(plusieurs bonnes réponses)*

- [ ] **A.** `InMemoryStore` (`LOCK_DSN=in-memory`), qui sauvegarde les locks en mémoire durant un process
- [ ] **B.** `TestStore` (`LOCK_DSN=test`), qui simule des locks aléatoires
- [ ] **C.** `NullStore` (`LOCK_DSN=null`), qui ne persiste rien
- [ ] **D.** `FakeStore` (`LOCK_DSN=fake`), utilisé uniquement en environnement de test

## Available Stores — FlockStore, MemcachedStore, MongoDbStore

### Question 47

Sur quoi s'appuie le `FlockStore` pour créer les locks ? *(une seule bonne réponse)*

- [ ] **A.** Sur un serveur Redis local
- [ ] **B.** Sur le système de fichiers de l'ordinateur local
- [ ] **C.** Sur les fonctions de sémaphore PHP
- [ ] **D.** Sur une base de données SQLite embarquée

### Question 48

Si aucun argument n'est fourni au constructeur de `FlockStore`, quel répertoire est utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Le répertoire courant du script
- [ ] **B.** `/var/lock`
- [ ] **C.** Le répertoire `var/` du projet Symfony
- [ ] **D.** `sys_get_temp_dir()`

### Question 49

Quel type de système de fichiers la documentation déconseille-t-elle pour le `FlockStore` ? *(une seule bonne réponse)*

- [ ] **A.** Certains types de NFS, qui ne supportent pas le verrouillage
- [ ] **B.** ext4
- [ ] **C.** Btrfs
- [ ] **D.** tmpfs, décrit comme plus lent que NFS

### Question 50

Que requiert le `MemcachedStore` pour fonctionner ? *(une seule bonne réponse)*

- [ ] **A.** Une connexion PDO
- [ ] **B.** Une connexion implémentant la classe `\Memcached`
- [ ] **C.** Un client `DynamoDbClient`
- [ ] **D.** Une connexion Doctrine DBAL

### Question 51

Quelle est la limite mentionnée sur le TTL avec Memcached ? *(une seule bonne réponse)*

- [ ] **A.** Memcached exige un TTL d'au moins 300 secondes
- [ ] **B.** Il n'y a aucune limite sur le TTL avec Memcached
- [ ] **C.** Memcached ne supporte pas un TTL inférieur à 1 seconde
- [ ] **D.** Le TTL maximal est de 3600 secondes

### Question 52

Quelle version minimale de MongoDB le `MongoDbStore` requiert-il ? *(une seule bonne réponse)*

- [ ] **A.** `>=4.0`
- [ ] **B.** `>=5.0`
- [ ] **C.** Aucune version minimale n'est précisée
- [ ] **D.** `>=2.2`

### Question 53

Que peut-on passer comme premier paramètre au constructeur de `MongoDbStore` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une instance `\MongoDB\Collection`
- [ ] **B.** Une instance PDO configurée pour MongoDB
- [ ] **C.** Une instance `\MongoDB\Client`
- [ ] **D.** Une MongoDB Connection String

### Question 54

Quand le premier paramètre est une MongoDB Connection String, que faut-il fournir au minimum, entre le nom de la base et celui de la collection ? *(une seule bonne réponse)*

- [ ] **A.** Au moins l'un des deux (base de données et/ou collection)
- [ ] **B.** Le nom d'utilisateur et le mot de passe
- [ ] **C.** L'option `driverOptions` uniquement
- [ ] **D.** L'option `gcProbability`, qui est obligatoire dans ce cas

## Available Stores — PdoStore, DoctrineDbalStore, PostgreSqlStore, DoctrineDbalPostgreSqlStore

### Question 55

Que requiert le `PdoStore` ? *(une seule bonne réponse)*

- [ ] **A.** Une connexion Doctrine DBAL exclusivement
- [ ] **B.** Une connexion PDO ou un DSN
- [ ] **C.** Un client Redis
- [ ] **D.** Un client HTTP asynchrone

### Question 56

Quand la table utilisée par `PdoStore` est-elle créée automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'est jamais créée automatiquement, il faut toujours appeler `createTable()`
- [ ] **B.** Lors de l'instanciation du store
- [ ] **C.** Lors du premier appel à `acquire()`
- [ ] **D.** Lors du premier appel à la méthode `save()`

### Question 57

En quoi le `DoctrineDbalStore` diffère-t-il du `PdoStore` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne supporte pas le TTL, contrairement au `PdoStore`
- [ ] **B.** Il supporte nativement le blocking, contrairement au `PdoStore`
- [ ] **C.** Il est identique, mais requiert une connexion Doctrine DBAL ou une Doctrine DBAL URL
- [ ] **D.** Il ne nécessite aucune table

### Question 58

Quelle commande génère automatiquement la table utilisée par `DoctrineDbalStore` ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console make:migration`
- [ ] **B.** `php bin/console doctrine:schema:update`
- [ ] **C.** `php bin/console lock:create-table`
- [ ] **D.** `php bin/console doctrine:lock:init`

### Question 59

Sur quel mécanisme PostgreSQL le `PostgreSqlStore` s'appuie-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Les triggers PL/pgSQL
- [ ] **B.** Les Advisory Locks
- [ ] **C.** Les contraintes UNIQUE
- [ ] **D.** Le mécanisme LISTEN/NOTIFY

### Question 60

Contrairement au `PdoStore`, que peut-on dire du `PostgreSqlStore` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il n'a pas besoin de table pour stocker les locks
- [ ] **B.** Il nécessite obligatoirement une connexion Doctrine DBAL
- [ ] **C.** Il n'expire pas
- [ ] **D.** Il supporte le blocking natif ainsi que le partage (sharing) des locks

### Question 61

Le `DoctrineDbalPostgreSqlStore` est identique à quel autre store, mais avec quelle connexion ? *(une seule bonne réponse)*

- [ ] **A.** Identique au `PdoStore`, avec une connexion Doctrine DBAL
- [ ] **B.** Identique au `RedisStore`, avec une connexion Predis
- [ ] **C.** Identique au `DoctrineDbalStore`, avec un DSN PostgreSQL brut
- [ ] **D.** Identique au `PostgreSqlStore`, avec une connexion Doctrine DBAL Connection ou une Doctrine DBAL URL

## Available Stores — RedisStore, SemaphoreStore, CombinedStore

### Question 62

Quelles classes de connexion Redis le `RedisStore` accepte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** `\Redis`, `\RedisArray`, `\RedisCluster`
- [ ] **B.** `\PhpRedis\Client` (nom fictif)
- [ ] **C.** `\Relay\Relay`, `\Relay\Cluster`
- [ ] **D.** `\Predis`

### Question 63

Sur quoi repose le `SemaphoreStore` ? *(une seule bonne réponse)*

- [ ] **A.** Les fonctions de sémaphore PHP
- [ ] **B.** Le système de fichiers local
- [ ] **C.** Une extension Memcached
- [ ] **D.** Le composant Cache PSR-6

### Question 64

Pour quel usage le `CombinedStore` est-il conçu ? *(une seule bonne réponse)*

- [ ] **A.** Les tests unitaires exclusivement
- [ ] **B.** Les applications de haute disponibilité (High Availability), en gérant plusieurs stores en synchronisation
- [ ] **C.** Le stockage temporaire de locks sans persistance
- [ ] **D.** Le partage de locks entre plusieurs environnements Symfony (dev/prod)

### Question 65

Avec la `ConsensusStrategy`, quand le lock est-il considéré comme acquis ? *(une seule bonne réponse)*

- [ ] **A.** Dès qu'un seul store parmi tous a acquis le lock
- [ ] **B.** Uniquement si tous les stores ont acquis le lock
- [ ] **C.** Si une majorité simple des stores gérés a acquis le lock
- [ ] **D.** Jamais automatiquement, il faut appeler une méthode `confirm()` explicite

### Question 66

Quelle stratégie alternative exige que le lock soit acquis dans absolument tous les stores gérés ? *(une seule bonne réponse)*

- [ ] **A.** `StrictStrategy`
- [ ] **B.** `AllOrNothingStrategy`
- [ ] **C.** `FullConsensusStrategy`
- [ ] **D.** `UnanimousStrategy`

### Question 67

Pour garantir la haute disponibilité avec `ConsensusStrategy`, quelle est la taille minimale de cluster recommandée ? *(une seule bonne réponse)*

- [ ] **A.** Deux serveurs
- [ ] **B.** Trois serveurs
- [ ] **C.** Cinq serveurs
- [ ] **D.** Il n'y a pas de taille minimale recommandée

## Available Stores — ZookeeperStore, DynamoDbStore

### Question 68

Que requiert le `ZookeeperStore` ? *(une seule bonne réponse)*

- [ ] **A.** Une connexion implémentant la classe `\Zookeeper`
- [ ] **B.** Une connexion PDO
- [ ] **C.** Un client HTTP REST vers l'API ZooKeeper
- [ ] **D.** Une instance `\Redis` configurée en mode cluster

### Question 69

Pourquoi ZooKeeper n'a-t-il pas besoin de TTL selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ZooKeeper gère nativement l'expiration comme Redis
- [ ] **B.** Parce que le TTL est toujours fixé à une valeur infinie par défaut
- [ ] **C.** Parce que les nœuds utilisés pour le verrouillage sont éphémères et meurent quand le processus PHP se termine
- [ ] **D.** Parce que ZooKeeper ne persiste jamais aucune donnée

### Question 70

Quel package faut-il installer en plus pour utiliser le `DynamoDbStore` ? *(une seule bonne réponse)*

- [ ] **A.** `composer require aws/aws-sdk-php`
- [ ] **B.** `composer require symfony/dynamodb-lock`
- [ ] **C.** Aucun package supplémentaire n'est nécessaire, il est inclus dans `symfony/lock`
- [ ] **D.** `composer require symfony/amazon-dynamo-db-lock`

### Question 71

D'après le tableau comparatif, quels stores utilisent un mécanisme de « retry » car ils ne supportent pas nativement le blocking (colonne « Blocking » = retry) ? *(plusieurs bonnes réponses)*

- [ ] **A.** `DoctrineDbalStore`
- [ ] **B.** `MemcachedStore`
- [ ] **C.** `RedisStore`
- [ ] **D.** `ZookeeperStore`

## Reliability — Remote Stores et Expiring Stores

### Question 72

Comment les stores distants reconnaissent-ils le véritable propriétaire d'un lock ? *(une seule bonne réponse)*

- [ ] **A.** Via l'adresse IP du processus client
- [ ] **B.** Via un identifiant de session PHP
- [ ] **C.** Via un token unique, stocké dans l'objet `Key`
- [ ] **D.** Via un hash calculé sur le nom de la ressource

### Question 73

Que doivent impérativement faire tous les processus concurrents utilisant un store distant ? *(une seule bonne réponse)*

- [ ] **A.** Stocker le `Lock` sur le même serveur
- [ ] **B.** Utiliser des TTL identiques pour tous les locks
- [ ] **C.** Partager la même instance de `LockFactory` en mémoire
- [ ] **D.** Utiliser exclusivement des locks non expirants

### Question 74

Concernant Memcached, que déconseille formellement la documentation pour garantir la fiabilité ? *(une seule bonne réponse)*

- [ ] **A.** D'utiliser plusieurs instances Memcached en parallèle
- [ ] **B.** D'utiliser Memcached derrière un LoadBalancer, un cluster ou un DNS round-robin
- [ ] **C.** De configurer un TTL supérieur à 300 secondes
- [ ] **D.** D'utiliser Memcached pour des locks non expirants

### Question 75

Que garantissent les stores expirants ? *(une seule bonne réponse)*

- [ ] **A.** Que le lock ne peut jamais être perdu, quel que soit le TTL
- [ ] **B.** Qu'aucun autre processus ne pourra jamais acquérir la ressource, même après expiration
- [ ] **C.** Que le TTL est automatiquement doublé en cas de charge élevée
- [ ] **D.** Que le lock est acquis pour la durée exacte définie ; si la tâche dure plus longtemps, le store peut le libérer et un autre processus peut l'acquérir

### Question 76

Que doit faire un code robuste, selon l'exemple fourni, lorsque `getRemainingLifetime()` est inférieur ou égal à 5 secondes ? *(une seule bonne réponse)*

- [ ] **A.** Vérifier si le lock est expiré (`isExpired()`) et sinon le rafraîchir (`refresh()`)
- [ ] **B.** Appeler immédiatement `release()` par précaution
- [ ] **C.** Recréer un nouveau lock via `createLock()`
- [ ] **D.** Ignorer cette information, elle n'est utile qu'à des fins de logging

### Question 77

Que recommande la documentation concernant le service NTP, pour garantir la fiabilité des locks expirants ? *(une seule bonne réponse)*

- [ ] **A.** De synchroniser NTP toutes les secondes
- [ ] **B.** NTP n'a aucun impact sur la fiabilité des locks
- [ ] **C.** De désactiver le service NTP et de mettre à jour la date manuellement quand le service est arrêté
- [ ] **D.** D'utiliser exclusivement UTC, sans jamais désactiver NTP

## Reliability — FlockStore, MemcachedStore, MongoDbStore

### Question 78

Pour que le `FlockStore` reste fiable, que doivent utiliser tous les processus concurrents ? *(une seule bonne réponse)*

- [ ] **A.** Le même port réseau
- [ ] **B.** Le même répertoire physique pour stocker les locks
- [ ] **C.** La même version de PHP
- [ ] **D.** Le même utilisateur système

### Question 79

Pourquoi faut-il être prudent avec les symlinks pour le `FlockStore` ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les symlinks ne sont jamais supportés sous Linux
- [ ] **B.** Parce qu'ils ralentissent l'accès disque
- [ ] **C.** Parce qu'ils cassent systématiquement le mécanisme de garbage collection
- [ ] **D.** Parce que le chemin absolu du répertoire doit rester le même, or les symlinks peuvent changer (par exemple lors de déploiements blue/green)

### Question 80

Selon la documentation, dans quel cas est-il dangereux de stocker des locks `FlockStore` sur un système de fichiers volatile (ex. tmpfs) ? *(une seule bonne réponse)*

- [ ] **A.** Si le lock doit être réutilisé sur plusieurs requêtes
- [ ] **B.** Si le lock a un TTL supérieur à 300 secondes
- [ ] **C.** Ce n'est jamais dangereux, tmpfs étant recommandé
- [ ] **D.** Uniquement en environnement de test

### Question 81

Quelles affirmations sur la fiabilité du `MemcachedStore` sont vraies selon la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les locks ne sont pas persistés, Memcached stockant les items en mémoire, et peuvent donc disparaître par erreur à tout moment
- [ ] **B.** Si le service Memcached ou sa machine hôte redémarre, tous les locks seraient perdus sans notifier les processus en cours
- [ ] **C.** Il est recommandé de retarder le démarrage du service après un redémarrage, en attendant au moins aussi longtemps que le TTL de lock le plus long
- [ ] **D.** Par défaut, Memcached utilise un mécanisme LRU qui peut supprimer d'anciennes entrées — y compris des locks — quand il a besoin de place

### Question 82

Quelle méthode Memcached ne doit jamais être appelée sur un service partagé avec du cache, sous peine de supprimer les locks ? *(une seule bonne réponse)*

- [ ] **A.** `delete()`
- [ ] **B.** `increment()`
- [ ] **C.** `flush()`
- [ ] **D.** `touch()`

### Question 83

Que faut-il mettre en place pour nettoyer automatiquement les locks expirés dans MongoDB ? *(une seule bonne réponse)*

- [ ] **A.** Un cron externe exécutant une requête `DELETE` périodique
- [ ] **B.** Un index TTL
- [ ] **C.** Un trigger de collection
- [ ] **D.** Aucun mécanisme n'est nécessaire, MongoDB nettoie automatiquement toutes les données après 24h

### Question 84

Quelle méthode permet de créer cet index TTL directement depuis le store ? *(une seule bonne réponse)*

- [ ] **A.** `MongoDbStore::createTtlIndex(int $expireAfterSeconds = 0)`
- [ ] **B.** `MongoDbStore::createTable()`
- [ ] **C.** `MongoDbStore::setupIndexes()`
- [ ] **D.** `MongoDbStore::gc()`

## Reliability — PdoStore, PostgreSqlStore, RedisStore, CombinedStore, SemaphoreStore, ZookeeperStore et Overall

### Question 85

Sur quelles propriétés le `PdoStore` s'appuie-t-il pour sa fiabilité ? *(une seule bonne réponse)*

- [ ] **A.** Le mécanisme MVCC exclusivement
- [ ] **B.** Les triggers BEFORE INSERT
- [ ] **C.** Le mode `STRICT_TRANS_TABLES` de MySQL
- [ ] **D.** Les propriétés ACID du moteur SQL

### Question 86

Que se passe-t-il pour les locks du `PostgreSqlStore` si le client ne peut pas les déverrouiller, pour une raison quelconque ? *(une seule bonne réponse)*

- [ ] **A.** Ils restent verrouillés indéfiniment jusqu'à intervention manuelle
- [ ] **B.** Ils sont automatiquement libérés à la fin de la session
- [ ] **C.** PostgreSQL les convertit automatiquement en locks partagés
- [ ] **D.** Un job cron interne les libère après 24h

### Question 87

Quelle commande Redis ne doit jamais être appelée sur un service partagé avec du cache, sous peine de supprimer les locks ? *(une seule bonne réponse)*

- [ ] **A.** `DEL`
- [ ] **B.** `EXPIRE`
- [ ] **C.** `FLUSHDB`
- [ ] **D.** `PERSIST`

### Question 88

Quelle idée fausse courante la documentation met-elle en garde à propos du `CombinedStore` ? *(une seule bonne réponse)*

- [ ] **A.** Qu'il rendrait le mécanisme de lock plus fiable — en réalité il n'est fiable qu'à hauteur du store le moins fiable parmi ceux gérés
- [ ] **B.** Qu'il serait plus rapide que n'importe quel store simple
- [ ] **C.** Qu'il ne fonctionnerait qu'avec Redis
- [ ] **D.** Qu'il nécessiterait obligatoirement trois stores minimum

### Question 89

Concernant systemd, quel piège est mentionné pour le `SemaphoreStore` ? *(une seule bonne réponse)*

- [ ] **A.** systemd désactive automatiquement les sémaphores IPC au démarrage
- [ ] **B.** Les sémaphores ne fonctionnent pas du tout sous systemd
- [ ] **C.** systemd limite les sémaphores à un maximum de 10 par utilisateur
- [ ] **D.** Avec l'option `RemoveIPC=yes` (valeur par défaut) sur un utilisateur non-système, les locks sont supprimés par systemd quand cet utilisateur se déconnecte

### Question 90

Comment le `ZookeeperStore` maintient-il les locks sur le serveur ? *(une seule bonne réponse)*

- [ ] **A.** Sous forme de fichiers verrouillés classiques
- [ ] **B.** Sous forme de nœuds éphémères
- [ ] **C.** Sous forme d'entrées dans une table SQL dédiée
- [ ] **D.** Sous forme de clés Redis répliquées

### Question 91

Que recommande la section « Overall » lors d'un changement de configuration des stores, par exemple pendant un déploiement ? *(une seule bonne réponse)*

- [ ] **A.** De redémarrer immédiatement tous les processus, anciens et nouveaux, en parallèle
- [ ] **B.** Ce changement n'a aucun impact particulier sur la fiabilité
- [ ] **C.** Que les processus avec la nouvelle configuration ne doivent pas démarrer tant que les anciens processus avec l'ancienne configuration tournent encore
- [ ] **D.** De désactiver temporairement tous les locks pendant le déploiement

---

## Corrigé

**Question 1 : C** — « The Lock Component creates and manages locks, a mechanism to provide exclusive access to a shared resource. » *(§ Introduction)*

**Question 2 : D** — `$ composer require symfony/lock`. *(§ Installation)*

**Question 3 : A** — « Locks are created using a `Symfony\Component\Lock\LockFactory` class. » *(§ Usage)*

**Question 4 : B** — « which in turn requires another class to manage the storage of locks. » *(§ Usage)*

**Question 5 : B** — « Its first argument is an arbitrary string that represents the locked resource. » *(§ Usage)*

**Question 6 : A** — « If the lock can not be acquired, the method returns `false`. » *(§ Usage)*

**Question 7 : C** — « The `acquire()` method can be safely called repeatedly, even if the lock is already acquired. » *(§ Usage)*

**Question 8 : D** — « the Lock Component distinguishes lock instances even when they are created for the same resource. It means that for a given scope and resource one lock instance can be acquired multiple times. » *(§ Usage)*

**Question 9 : B** — « If a lock has to be used by several services, they should share the same `Lock` instance returned by the `LockFactory::createLock` method. » *(§ Usage)*

**Question 10 : A** — « If you don't release the lock explicitly, it will be released automatically upon instance destruction. » *(§ Usage)*

**Question 11 : D** — « To disable the automatic release behavior, set the third argument of the `createLock()` method to `false`. » *(§ Usage)*

**Question 12 : B** — « The `Key` contains the state of the `Lock` and can be serialized. » *(§ Serializing Locks)*

**Question 13 : C** — « This allows the user to begin a long job in a process by acquiring the lock, and continue the job in another process using the same lock. » *(§ Serializing Locks)*

**Question 14 : A, C** — `$factory->createLockFromKey($key, 300, false);` → `300` est le `ttl`, `false` est `autoRelease`. *(§ Serializing Locks)*

**Question 15 : D** — « Don't forget to set the `autoRelease` argument to `false` (…) to avoid releasing the lock when the destructor is called. » *(§ Serializing Locks)*

**Question 16 : A** — « If you use an incompatible store (…) an exception will be thrown when the application tries to serialize the key. » *(§ Serializing Locks)*

**Question 17 : A, C** — « Locks can be serialized using both the native PHP serialization system and its `serialize` function, or using the Serializer component. » *(§ Serializing Locks)*

**Question 18 : B** — « pass `true` as the argument of the `acquire()` method. » *(§ Blocking Locks)*

**Question 19 : C** — « This is called a blocking lock because the execution of your application stops until the lock is acquired. » *(§ Blocking Locks)*

**Question 20 : D** — « the `Lock` class will retry to acquire the lock in a non-blocking way until the lock is acquired. » *(§ Blocking Locks)*

**Question 21 : A** — « If the lock cannot be acquired despite blocking (e.g. because the store's blocking mechanism failed while the lock is still held by another process), a `LockConflictedException` is thrown. » *(§ Blocking Locks)*

**Question 22 : B** — « there is no way for the remote `Store` to know if the locker process is still alive. » *(§ Expiring Locks)*

**Question 23 : A** — « This time, in seconds, is configured as the second argument of the `createLock()` method. » *(§ Expiring Locks)*

**Question 24 : C** — « create an expiring lock that lasts 30 seconds (default is 300.0). » *(§ Expiring Locks)*

**Question 25 : D** — « If it's too short, other processes could acquire the lock before finishing the job. » *(§ Expiring Locks)*

**Question 26 : B** — « it's recommended to wrap the job in a try/catch/finally block to always try to release the expiring lock. » *(§ Expiring Locks)*

**Question 27 : C** — « use the `refresh` method to reset the TTL to its original value. » *(§ Expiring Locks)*

**Question 28 : D** — « refresh the lock for 600 seconds (next `refresh()` call will be 30 seconds again). » *(§ Expiring Locks)*

**Question 29 : A, B, C, D** — les quatre méthodes sont explicitement citées dans cette section : `refresh()` (renouvellement du TTL), `release()` (dans l'exemple try/finally), `getRemainingLifetime()` et `isExpired()` (méthodes de vérification de l'état du lock). *(§ Expiring Locks)*

**Question 30 : A** — « Locks are automatically released when their Lock objects are destroyed. » *(§ Expiring Locks — Automatically Releasing The Lock)*

**Question 31 : B** — « In order for the above example to work, the PCNTL extension must be installed. » *(§ Expiring Locks — Automatically Releasing The Lock)*

**Question 32 : C** — « set the `autoRelease` argument of `LockFactory::createLock()` to `false`. That will make the lock acquired for 3600 seconds or until `Lock::release()` is called. » *(§ Expiring Locks — Automatically Releasing The Lock)*

**Question 33 : A** — « A shared or readers-writer lock is a synchronization primitive that allows concurrent access for read-only operations, while write operations require exclusive access. » *(§ Shared Locks)*

**Question 34 : D** — « Use the `SharedLockInterface::acquireRead` method to acquire a read-only lock. » *(§ Shared Locks)*

**Question 35 : B** — « The priority policy of Symfony's shared locks depends on the underlying store (e.g. Redis store prioritizes readers vs writers). » *(§ Shared Locks)*

**Question 36 : A** — « it's possible to promote the lock, and change it to a write lock, by calling the `acquire()` method. » *(§ Shared Locks)*

**Question 37 : D** — « it's possible to demote a write lock, and change it to a read-only lock by calling the `acquireRead()` method. » *(§ Shared Locks)*

**Question 38 : C** — « When the provided store does not implement the `SharedLockStoreInterface` interface (…) the `Lock` class will fallback to a write lock by calling the `acquire()` method. » *(§ Shared Locks)*

**Question 39 : D** — « you can use the `isAcquired()` method [to check whether the current Lock instance is (still) the owner of a lock]. » *(§ The Owner of The Lock)*

**Question 40 : B** — « The `isAcquired()` method is used to check if the lock has been acquired by the current process only. » *(§ The Owner of The Lock)*

**Question 41 : A** — « Because some lock stores have expiring locks, it is possible for an instance to lose the lock it acquired automatically. » *(§ The Owner of The Lock)*

**Question 42 : B** — « the true owners of the lock are the ones that share the same instance of `Key`, not `Lock`. » *(§ The Owner of The Lock)*

**Question 43 : A, D** — « classes that implement `PersistingStoreInterface` and, optionally, `BlockingStoreInterface`. » *(§ Available Stores)*

**Question 44 : A, B, C, D** — les quatre stores affichent « yes » dans la colonne Sharing du tableau : `DoctrineDbalPostgreSqlStore`, `FlockStore`, `PostgreSqlStore`, `RedisStore`. *(§ Available Stores)*

**Question 45 : A, C, D** — la colonne Expiring vaut « no » pour `FlockStore`, `SemaphoreStore` et `ZookeeperStore` (ainsi que `DoctrineDbalPostgreSqlStore` et `PostgreSqlStore`) ; `RedisStore` (option B) a « yes » dans cette colonne — piège. *(§ Available Stores)*

**Question 46 : A, C** — « Symfony includes two other special stores that are mostly useful for testing: `InMemoryStore` (…) `NullStore` (…). » *(§ Available Stores)*

**Question 47 : B** — « The FlockStore uses the file system on the local computer to create the locks. » *(§ Available Stores — FlockStore)*

**Question 48 : D** — « if none is given, `sys_get_temp_dir()` is used internally. » *(§ Available Stores — FlockStore)*

**Question 49 : A** — « Beware that some file systems (such as some types of NFS) do not support locking. » *(§ Available Stores — FlockStore)*

**Question 50 : B** — « it requires a Memcached connection implementing the `\Memcached` class. » *(§ Available Stores — MemcachedStore)*

**Question 51 : C** — « Memcached does not support TTL lower than 1 second. » *(§ Available Stores — MemcachedStore)*

**Question 52 : D** — « The MongoDbStore saves locks on a MongoDB server `>=2.2`. » *(§ Available Stores — MongoDbStore)*

**Question 53 : A, C, D** — « it requires a `\MongoDB\Collection` or `\MongoDB\Client` from mongodb/mongodb or a MongoDB Connection String. » *(§ Available Stores — MongoDbStore)*

**Question 54 : A** — « [database] is used otherwise `/path` from the DSN, at least one is mandatory; [collection] is used otherwise `?collection=` from the DSN, at least one is mandatory. » *(§ Available Stores — MongoDbStore)*

**Question 55 : B** — « The PdoStore saves locks in an SQL database. It requires a PDO connection or a Data Source Name (DSN). » *(§ Available Stores — PdoStore)*

**Question 56 : D** — « The table where values are stored is created automatically on the first call to the `PdoStore::save` method. » *(§ Available Stores — PdoStore)*

**Question 57 : C** — « The DoctrineDbalStore saves locks in an SQL database. It is identical to PdoStore but requires a Doctrine DBAL Connection, or a Doctrine DBAL URL. » *(§ Available Stores — DoctrineDbalStore)*

**Question 58 : A** — « The table where values are stored will be automatically generated when your run the command: `$ php bin/console make:migration`. » *(§ Available Stores — DoctrineDbalStore)*

**Question 59 : B** — « The PostgreSqlStore uses Advisory Locks provided by PostgreSQL. » *(§ Available Stores — PostgreSqlStore)*

**Question 60 : A, C, D** — « Unlike the PdoStore, the PostgreSqlStore does not need a table to store locks and it does not expire. » et « It supports native blocking, as well as sharing locks. » *(§ Available Stores — PostgreSqlStore)*

**Question 61 : D** — « The DoctrineDbalPostgreSqlStore uses Advisory Locks provided by PostgreSQL. It is identical to PostgreSqlStore but requires a Doctrine DBAL Connection or a Doctrine DBAL URL. » *(§ Available Stores — DoctrineDbalPostgreSqlStore)*

**Question 62 : A, C, D** — « it requires a Redis connection implementing the `\Redis`, `\RedisArray`, `\RedisCluster`, `\Relay\Relay`, `\Relay\Cluster` or `\Predis` classes. » *(§ Available Stores — RedisStore)*

**Question 63 : A** — « The SemaphoreStore uses the PHP semaphore functions to create the locks. » *(§ Available Stores — SemaphoreStore)*

**Question 64 : B** — « The CombinedStore is designed for High Availability applications because it manages several stores in sync. » *(§ Available Stores — CombinedStore)*

**Question 65 : C** — « If a simple majority of stores have acquired the lock, then the lock is considered acquired. » *(§ Available Stores — CombinedStore)*

**Question 66 : D** — « an `UnanimousStrategy` can be used to require the lock to be acquired in all the stores. » *(§ Available Stores — CombinedStore)*

**Question 67 : B** — « the minimum cluster size must be three servers. » *(§ Available Stores — CombinedStore)*

**Question 68 : A** — « It requires a ZooKeeper connection implementing the `\Zookeeper` class. » *(§ Available Stores — ZookeeperStore)*

**Question 69 : C** — « Zookeeper does not require a TTL as the nodes used for locking are ephemeral and die when the PHP process is terminated. » *(§ Available Stores — ZookeeperStore)*

**Question 70 : D** — « Install it by running: `$ composer require symfony/amazon-dynamo-db-lock`. » *(§ Available Stores — DynamoDbStore)*

**Question 71 : A, B, C, D** — les quatre stores affichent « retry » dans la colonne Blocking du tableau (`DoctrineDbalStore`, `MemcachedStore`, `RedisStore`, `ZookeeperStore`, tout comme `DynamoDbStore`, `MongoDbStore` et `PdoStore`). *(§ Available Stores)*

**Question 72 : C** — « Remote stores (…) use a unique token to recognize the true owner of the lock. This token is stored in the `Key` object. » *(§ Reliability — Remote Stores)*

**Question 73 : A** — « Every concurrent process must store the `Lock` on the same server. » *(§ Reliability — Remote Stores)*

**Question 74 : B** — « do not use Memcached behind a LoadBalancer, a cluster or round-robin DNS. » *(§ Reliability — Remote Stores)*

**Question 75 : D** — « Expiring stores (…) guarantee that the lock is acquired only for the defined duration of time. If the task takes longer to be accomplished, then the lock can be released by the store and acquired by someone else. » *(§ Reliability — Expiring Stores)*

**Question 76 : A** — « if (`$lock->getRemainingLifetime() <= 5`) { if (`$lock->isExpired()`) { … } `$lock->refresh();` }. » *(§ Reliability — Expiring Stores)*

**Question 77 : C** — « To guarantee that date won't change, the NTP service should be disabled and the date should be updated when the service is stopped. » *(§ Reliability — Expiring Stores)*

**Question 78 : B** — « this Store is reliable as long as concurrent processes use the same physical directory to store locks. » *(§ Reliability — FlockStore)*

**Question 79 : D** — « Be careful of symlinks that could change at anytime: symlink-based release strategies and blue/green deployment often use that trick. » *(§ Reliability — FlockStore)*

**Question 80 : A** — « Do not store locks on a volatile file system if they have to be reused in several requests. » *(§ Reliability — FlockStore)*

**Question 81 : A, B, C, D** — « the locks are not persisted and may disappear by mistake at any time. » ; « every lock would be lost without notifying the running processes. » ; « it's recommended to delay service start and wait at least as long as the longest lock TTL. » ; « By default Memcached uses a LRU mechanism to remove old entries when the service needs space to add new items. » *(§ Reliability — MemcachedStore)*

**Question 82 : C** — « The method `flush()` must not be called, or locks should be stored in a dedicated Memcached service away from Cache. » *(§ Reliability — MemcachedStore)*

**Question 83 : B** — « A TTL index must be used to automatically clean up expired locks. » *(§ Reliability — MongoDbStore)*

**Question 84 : A** — « the method `MongoDbStore::createTtlIndex(int $expireAfterSeconds = 0)` can be called once to create the TTL index during database setup. » *(§ Reliability — MongoDbStore)*

**Question 85 : D** — « The PdoStore relies on the ACID properties of the SQL engine. » *(§ Reliability — PdoStore)*

**Question 86 : B** — « that by using PostgreSqlStore the locks will be automatically released at the end of the session in case the client cannot unlock for any reason. » *(§ Reliability — PostgreSqlStore)*

**Question 87 : C** — « The command `FLUSHDB` must not be called, or locks should be stored in a dedicated Redis service away from Cache. » *(§ Reliability — RedisStore)*

**Question 88 : A** — « It's a common mistake to think that the lock mechanism will be more reliable. This is wrong. The `CombinedStore` will be, at best, as reliable as the least reliable of all managed stores. » *(§ Reliability — CombinedStore)*

**Question 89 : D** — « When running on systemd with non-system user and option `RemoveIPC=yes` (default value), locks are deleted by systemd when that user logs out. » *(§ Reliability — SemaphoreStore)*

**Question 90 : B** — « The way ZookeeperStore works is by maintaining locks as ephemeral nodes on the server. » *(§ Reliability — ZookeeperStore)*

**Question 91 : C** — « Processes with new configuration must not be started while old processes with old configuration are still running. » *(§ Reliability — Overall)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [components/lock.rst](https://github.com/symfony/symfony-docs/blob/8.0/components/lock.rst)) : pas de pages annexes à couvrir pour ce QCM.
