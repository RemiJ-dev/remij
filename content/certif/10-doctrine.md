# QCM — Databases and the Doctrine ORM

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/doctrine.html](https://symfony.com/doc/8.0/doctrine.html) (questions 1 à 21) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/doctrine.html#learn-more) (questions 22 à 64) · **Généré le :** 20 juillet 2026
>
> **64 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Installation et configuration de la base de données

### Question 1

Quelles affirmations sur l'installation de Doctrine sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `composer require symfony/orm-pack` installe le support ORM
- [ ] **B.** `composer require --dev symfony/maker-bundle` aide à générer du code (`make:entity`, `make:migration`…)
- [ ] **C.** Les deux commandes sont interchangeables : l'une remplace l'autre
- [ ] **D.** L'information de connexion à la base est stockée dans la variable d'environnement `DATABASE_URL`

### Question 2

Le mot de passe de connexion contient des caractères spéciaux (`@`, `#`, `$`…). Quelles solutions la documentation propose-t-elle ? *(plusieurs bonnes réponses)*

- [ ] **A.** Encoder les caractères réservés (RFC 3986) avec la fonction/le processor `urlencode`, en retirant le préfixe `resolve:` de l'URL
- [ ] **B.** Utiliser des paramètres de connexion séparés (`DATABASE_USER`, `DATABASE_PASSWORD`…) entourés de guillemets simples dans `.env`, avec un `driver` explicite (ex. `pdo_mysql`)
- [ ] **C.** Stocker le mot de passe en clair dans `config/packages/doctrine.yaml`
- [ ] **D.** Toujours basculer sur SQLite pour éviter le problème

### Question 3

Une fois la connexion configurée, quelle commande crée la base `db_name` ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console doctrine:database:create`
- [ ] **B.** `php bin/console doctrine:schema:create`
- [ ] **C.** `php bin/console make:database`
- [ ] **D.** `php bin/console doctrine:migrations:migrate`

## Créer une entité et ses types de champs

### Question 4

Que fait `php bin/console make:entity` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Il pose des questions interactives sur le nom de la classe et ses propriétés (type, longueur, nullable…)
- [ ] **B.** Il génère une classe avec les attributs `#[ORM\Entity]`, `#[ORM\Id]`, `#[ORM\GeneratedValue]`, `#[ORM\Column]`
- [ ] **C.** Il accepte les options `--with-uuid` ou `--with-ulid` pour typer l'id en `Uuid`/`Ulid` via le composant Uid
- [ ] **D.** Il exécute automatiquement la migration correspondante

### Question 5

Quel piège MySQL la documentation signale-t-elle pour les colonnes `string` uniques ? *(une seule bonne réponse)*

- [ ] **A.** Un index sur une colonne `string(255)` en `utf8mb4` unique peut dépasser la limite de 767 octets d'InnoDB (MySQL ≤ 5.6) : il faut limiter `length` à 190
- [ ] **B.** Les colonnes uniques doivent obligatoirement être de type `integer`
- [ ] **C.** MySQL n'autorise pas les colonnes `unique=true` sur les types `string`
- [ ] **D.** Il faut désactiver `utf8mb4` globalement

### Question 6

Quelles affirmations sur les enums en tant que type de champ Doctrine sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Seuls les enums **backed** (avec valeur scalaire) peuvent être utilisés pour une propriété d'entité
- [ ] **B.** On associe la propriété à l'enum via l'option `enumType` de `#[ORM\Column]`
- [ ] **C.** Les enums purs (sans valeur scalaire) sont automatiquement convertis en chaîne
- [ ] **D.** Doctrine génère l'enum PHP automatiquement à partir de la colonne

### Question 7

Quelles affirmations sur les types `uuid`/`ulid`/DatePoint fournis par Symfony sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `UuidType`/`UlidType` stockent la valeur comme GUID natif si possible, sinon en binaire 16 octets
- [ ] **B.** Le type `date_point` étend le type Doctrine `datetime_immutable` et convertit automatiquement vers/depuis un `DatePoint` du composant Clock
- [ ] **C.** Symfony détecte automatiquement le type `date_point` en type-hintant simplement la propriété avec `DatePoint`
- [ ] **D.** `day_point` et `time_point` sont de simples alias de `date_point`, sans différence de comportement

## Migrations

### Question 8

Quelles affirmations sur le flux `make:migration` / `doctrine:migrations:migrate` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `make:migration` compare les entités à l'état actuel de la base et génère le SQL nécessaire pour les synchroniser
- [ ] **B.** `doctrine:migrations:migrate` exécute tous les fichiers de migration qui n'ont pas encore été joués
- [ ] **C.** DoctrineMigrationsBundle gère une table `migration_versions` pour savoir quelles migrations ont déjà été exécutées
- [ ] **D.** Chaque `flush()` régénère automatiquement une migration

### Question 9

Sous SQLite, l'ajout d'une colonne `description` non nullable sans valeur par défaut provoque une erreur (`Cannot add a NOT NULL column with default value NULL`). Que recommande la doc ? *(une seule bonne réponse)*

- [ ] **A.** Passer la propriété en `nullable=true`
- [ ] **B.** Recréer entièrement la base de données
- [ ] **C.** Ajouter une valeur par défaut vide directement dans la migration générée
- [ ] **D.** Changer de SGBD, SQLite ne supportant pas les migrations

## Persister, valider et récupérer des objets

### Question 10

Quelles affirmations sur `persist()`/`flush()` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `persist($product)` dit à Doctrine de « gérer » l'objet, sans exécuter de requête
- [ ] **B.** `flush()` regarde tous les objets gérés et exécute les requêtes nécessaires (`INSERT`/`UPDATE`)
- [ ] **C.** Un échec de `flush()` lève une exception `Doctrine\ORM\ORMException`
- [ ] **D.** Il faut appeler `persist()` avant chaque `flush()`, y compris pour une simple mise à jour d'une entité déjà récupérée

### Question 11

Comment Doctrine décide-t-il d'un `INSERT` ou d'un `UPDATE` lors du `flush()` ? *(une seule bonne réponse)*

- [ ] **A.** Il faut appeler explicitement `insert()` ou `update()` sur l'entity manager
- [ ] **B.** Le workflow persist/flush est identique pour la création et la mise à jour : Doctrine est assez « intelligent » pour choisir lui-même
- [ ] **C.** Il faut un attribut `#[ORM\Operation]` sur chaque propriété modifiée
- [ ] **D.** C'est le repository qui décide via une méthode `save()`

### Question 12

Quelles affirmations sur la validation automatique basée sur les métadonnées Doctrine sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** L'option `auto_mapping` définit quelles entités sont introspectées pour ajouter des contraintes de validation automatiques
- [ ] **B.** `nullable=false` ajoute automatiquement une contrainte `NotNull` (nécessite le composant PropertyInfo)
- [ ] **C.** `unique=true` ajoute automatiquement une contrainte `UniqueEntity`
- [ ] **D.** Cette validation automatique remplace entièrement la nécessité de configurer des contraintes de validation

### Question 13

Quelles méthodes de repository sont présentées pour récupérer des objets ? *(plusieurs bonnes réponses)*

- [ ] **A.** `find($id)`
- [ ] **B.** `findOneBy(['name' => 'Keyboard'])`
- [ ] **C.** `findBy(['name' => 'Keyboard'], ['price' => 'ASC'])`
- [ ] **D.** `findAll()`

## EntityValueResolver

### Question 14

Comment l'`EntityValueResolver` récupère-t-il automatiquement une entité depuis la route ? *(plusieurs bonnes réponses)*

- [ ] **A.** Avec le wildcard `{id}`, il effectue un `find($id)`
- [ ] **B.** Avec la syntaxe `{param:argument}` (ex. `{slug:product}`), il effectue un `findOneBy(['slug' => $slug])`
- [ ] **C.** Si l'entité n'est pas trouvée, une erreur 404 est levée automatiquement — sauf si l'argument du contrôleur est rendu **optionnel** (nullable), auquel cas c'est au code de gérer le cas manquant
- [ ] **D.** Il faut toujours déclarer explicitement l'option `id` de `MapEntity`, sinon rien ne se passe

### Question 15

Quelles options de l'attribut `MapEntity` sont mentionnées par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `mapping` — associe un placeholder de route à une propriété Doctrine pour `findOneBy()`
- [ ] **B.** `stripNull` — ignore dans la requête les valeurs de route qui valent `null`
- [ ] **C.** `evictCache` — force la récupération depuis la base plutôt que depuis le cache
- [ ] **D.** `readOnly` — empêche toute modification de l'entité récupérée

### Question 16

Que permet une expression `MapEntity(expr: …)` avec le composant ExpressionLanguage ? *(plusieurs bonnes réponses)*

- [ ] **A.** Appeler une méthode du repository de l'entité (variable `repository`) en utilisant les wildcards de route comme variables
- [ ] **B.** Retourner une liste d'entités si l'argument du contrôleur est typé en `iterable`
- [ ] **C.** Accéder à la requête courante via la variable `request` (ex. pour lire un paramètre de query string)
- [ ] **D.** Exécuter du SQL brut directement dans l'expression

### Question 17

Comment référencer une entité par une **interface** plutôt que par sa classe concrète dans un argument de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec l'`EntityValueResolver`
- [ ] **B.** En configurant `resolve_target_entities`, puis en type-hintant l'interface avec l'attribut `#[MapEntity]`
- [ ] **C.** En créant systématiquement un DTO intermédiaire
- [ ] **D.** Avec `#[MapEntity(interface: true)]`

## Mettre à jour, supprimer et interroger

### Question 18

Quelles sont les trois étapes pour mettre à jour un objet Doctrine existant ? *(une seule bonne réponse)*

- [ ] **A.** Récupérer l'objet, le modifier, appeler `flush()`
- [ ] **B.** Récupérer l'objet, appeler `persist()`, appeler `flush()`
- [ ] **C.** Créer un nouvel objet, appeler `merge()`, appeler `flush()`
- [ ] **D.** Récupérer l'objet, appeler `detach()`, le modifier, puis `persist()`

### Question 19

Comment supprimer une entité ? *(une seule bonne réponse)*

- [ ] **A.** `$entityManager->remove($product); $entityManager->flush();` — la requête `DELETE` n'est exécutée qu'au `flush()`
- [ ] **B.** `$repository->delete($product)`
- [ ] **C.** `$product->delete()`
- [ ] **D.** `$entityManager->remove($product)` suffit seul, sans `flush()`

### Question 20

Quelles affirmations sur les requêtes personnalisées d'un repository sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une méthode custom peut utiliser `createQuery()` avec du DQL (Doctrine Query Language), qui référence des objets PHP plutôt que des tables SQL
- [ ] **B.** Le Query Builder est recommandé quand la requête est construite dynamiquement selon des conditions PHP
- [ ] **C.** Une requête SQL brute via la connexion retourne des tableaux associatifs, pas des objets (sauf via NativeQuery)
- [ ] **D.** Le DQL et le SQL brut produisent toujours des objets d'entité

### Question 21

Quelles affirmations sur les Doctrine Extensions communautaires (ex. Timestampable) sont vraies ? *(une seule bonne réponse)*

- [ ] **A.** Elles couvrent des besoins courants et s'intègrent via `StofDoctrineExtensionsBundle`
- [ ] **B.** Elles font partie du cœur de Doctrine ORM
- [ ] **C.** Elles nécessitent de réécrire le SchemaTool
- [ ] **D.** Elles sont incompatibles avec les lifecycle callbacks

---

> Les questions 22 à 64 couvrent les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/doctrine.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Associations et relations

### Question 22

Quels sont les deux grands types de relations couverts par la page ? *(une seule bonne réponse)*

- [ ] **A.** ManyToOne/OneToMany (la plus courante, clé étrangère) et ManyToMany (table de jointure)
- [ ] **B.** OneToOne uniquement
- [ ] **C.** Composition et héritage
- [ ] **D.** Embeddables et Discriminator Map

### Question 23

Dans une relation ManyToOne/OneToMany entre `Product` et `Category`, quelles affirmations sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le mapping `ManyToOne` (côté `Product`) est **obligatoire**
- [ ] **B.** Le mapping `OneToMany` (côté `Category`, avec `mappedBy`) est **optionnel**, utile pour interroger depuis le sens inverse
- [ ] **C.** `Product` est le **côté propriétaire** (owning side) : c'est lui qui doit être à jour pour que les changements soient répercutés en base
- [ ] **D.** `Category` est obligatoirement le côté propriétaire

### Question 24

Quelles affirmations sur le chargement des objets liés sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Par défaut, accéder à `$product->getCategory()` déclenche un **lazy loading** : une seconde requête est exécutée
- [ ] **B.** Doctrine s'appuie sur des **classes proxy** pour permettre ce chargement différé
- [ ] **C.** Pour éviter le problème des requêtes N+1, on peut écrire une requête DQL avec un `INNER JOIN` (eager loading)
- [ ] **D.** Le lazy loading est désactivé par défaut ; il faut l'activer explicitement

### Question 25

Que font les méthodes `addProduct()`/`removeProduct()` générées par `make:entity` côté inverse (`Category`) ? *(une seule bonne réponse)*

- [ ] **A.** Elles maintiennent la cohérence bidirectionnelle en appelant aussi `setCategory()`/`setCategory(null)` côté `Product`
- [ ] **B.** Elles suffisent seules, sans jamais toucher au côté `Product`
- [ ] **C.** Elles exécutent un `flush()` immédiat
- [ ] **D.** Elles ne sont générées que pour les relations ManyToMany

### Question 26

À quoi sert l'option `orphanRemoval: true` sur une relation `OneToMany` ? *(une seule bonne réponse)*

- [ ] **A.** À supprimer automatiquement les produits qui se retrouvent détachés de leur catégorie (retirés de la collection)
- [ ] **B.** À empêcher la suppression d'une catégorie ayant des produits
- [ ] **C.** À dupliquer les produits orphelins dans une table d'archive
- [ ] **D.** À rendre la relation obligatoire (non nullable)

### Question 27

Après avoir configuré une nouvelle relation, quelles commandes génèrent puis appliquent la migration correspondante (ex. colonne `category_id`) ? *(une seule bonne réponse)*

- [ ] **A.** `doctrine:migrations:diff` puis `doctrine:migrations:migrate`
- [ ] **B.** `make:migration` uniquement
- [ ] **C.** `doctrine:schema:update --force`
- [ ] **D.** `doctrine:database:create`

### Question 28

Quelle affirmation sur les collections Doctrine est vraie ? *(une seule bonne réponse)*

- [ ] **A.** Les collections doivent implémenter l'interface `Collection` de Doctrine, `ArrayCollection` en étant une implémentation courante
- [ ] **B.** Une simple `array` PHP suffit toujours pour une relation `*ToMany`
- [ ] **C.** Doctrine impose `SplObjectStorage`
- [ ] **D.** Les collections ne sont utilisées que côté propriétaire

## Annexe — Événements Doctrine

### Question 29

Quels sont les trois types de listeners Doctrine décrits, du plus simple au plus « partagé » ? *(une seule bonne réponse)*

- [ ] **A.** Lifecycle callbacks (méthodes sur l'entité) → Entity listeners (classe dédiée à une entité) → Lifecycle listeners (classe pour toutes les entités)
- [ ] **B.** Global listeners → Local listeners → Entity listeners
- [ ] **C.** Pre listeners → Post listeners → Around listeners
- [ ] **D.** Subscribers → Listeners → Observers

### Question 30

Quelles affirmations sur les usages et performances de chaque type de listener sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les lifecycle callbacks ne peuvent pas utiliser de services : adaptés à une logique **très simple** sur une seule entité
- [ ] **B.** Les entity listeners peuvent utiliser des services, mais ne sont appelés que pour une classe d'entité donnée — logique complexe liée à une seule entité
- [ ] **C.** Les lifecycle listeners s'appliquent à **toutes** les entités — pour partager une logique entre entités
- [ ] **D.** Les lifecycle callbacks sont **plus lents** que les entity listeners

### Question 31

Pour utiliser un lifecycle callback (ex. `prePersist`) via les attributs PHP, que faut-il faire en plus de la méthode annotée ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter `#[ORM\HasLifecycleCallbacks]` sur la classe de l'entité
- [ ] **B.** Rien : Doctrine détecte automatiquement toute méthode nommée `prePersist`
- [ ] **C.** Implémenter `LifecycleCallbackInterface`
- [ ] **D.** Déclarer la méthode comme statique

### Question 32

Comment enregistrer un **entity listener** (ex. `postUpdate` sur `User`) sans utiliser d'attribut PHP ? *(une seule bonne réponse)*

- [ ] **A.** En taguant le service avec `doctrine.orm.entity_listener`, en précisant les options `event` et `entity`
- [ ] **B.** En l'ajoutant à `config/bundles.php`
- [ ] **C.** En implémentant `EventSubscriberInterface`
- [ ] **D.** Ce n'est possible qu'avec l'attribut `#[AsEntityListener]`, sans alternative YAML/PHP

### Question 33

Par défaut, quelle méthode Doctrine cherche-t-il à appeler sur un entity listener, et quel est le repli si elle n'existe pas ? *(une seule bonne réponse)*

- [ ] **A.** Une méthode nommée d'après l'événement (ex. `postUpdate()`) ; à défaut, `__invoke()`
- [ ] **B.** Toujours `__invoke()`, sans exception
- [ ] **C.** `handle()`, sans repli possible
- [ ] **D.** Le nom de la méthode doit toujours être configuré explicitement via l'option `method`

### Question 34

Quelles affirmations sur les **lifecycle listeners** (ex. `SearchIndexer` sur `postPersist`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Ils reçoivent un argument (ex. `PostPersistEventArgs`) donnant accès à l'objet et à l'object manager, et doivent filtrer eux-mêmes le type d'entité qui les intéresse
- [ ] **B.** On les enregistre via l'attribut `#[AsDoctrineListener]` ou le tag de service `doctrine.event_listener`
- [ ] **C.** Le tag `doctrine.event_listener` accepte une option `priority` (plus la valeur est haute, plus le listener s'exécute tôt) et une option `connection`
- [ ] **D.** Ils sont automatiquement limités à une seule classe d'entité, comme les entity listeners

### Question 35

Où la logique métier partagée par **plusieurs types d'entités** doit-elle vivre, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Dans un lifecycle listener (`doctrine.event_listener` / `#[AsDoctrineListener]`)
- [ ] **B.** Dans un lifecycle callback
- [ ] **C.** Dans le contrôleur
- [ ] **D.** Dans un entity listener

### Question 36

Que reçoit en plus un callback `preUpdate`, contrairement à un simple `prePersist` sans paramètre ? *(une seule bonne réponse)*

- [ ] **A.** Un objet donnant accès à des informations utiles comme l'entity manager courant (ex. `PreUpdateEventArgs $event`)
- [ ] **B.** Rien de plus : la signature est identique
- [ ] **C.** Le tableau complet des instructions SQL brutes
- [ ] **D.** L'ancienne et la nouvelle valeur sous forme de chaîne concaténée

## Annexe — Fonctions DQL personnalisées

### Question 37

Sous quelles catégories enregistre-t-on une fonction DQL personnalisée dans `config/packages/doctrine.yaml` ? *(une seule bonne réponse)*

- [ ] **A.** `string_functions`, `numeric_functions`, `datetime_functions`, sous la clé `doctrine.orm.dql`
- [ ] **B.** `custom_functions` uniquement
- [ ] **C.** `dql_extensions`
- [ ] **D.** Il n'existe qu'une seule catégorie générique

### Question 38

Le projet utilise des `entity_managers` nommés explicitement. Où doit alors vivre le bloc `dql` ? *(une seule bonne réponse)*

- [ ] **A.** Sous `doctrine.orm` directement, comme dans le cas par défaut
- [ ] **B.** Sous l'entity manager nommé concerné (`doctrine.orm.entity_managers.<nom>.dql`), sous peine d'une exception « Unrecognized option "dql" under "doctrine.orm" »
- [ ] **C.** Dans un fichier séparé `dql.yaml`
- [ ] **D.** Dans `config/services.yaml`

### Question 39

Quelle limitation la documentation signale-t-elle sur les fonctions DQL personnalisées ? *(une seule bonne réponse)*

- [ ] **A.** Elles sont instanciées par Doctrine **en dehors** du container Symfony : impossible d'y injecter des services ou des paramètres
- [ ] **B.** Elles ne peuvent pas retourner de valeur numérique
- [ ] **C.** Elles doivent obligatoirement être des classes `final`
- [ ] **D.** Elles ne fonctionnent qu'en environnement `dev`

### Question 40

Pour approfondir la syntaxe même des fonctions DQL personnalisées (au-delà de leur enregistrement Symfony), vers quelle ressource la doc renvoie-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Le cookbook Doctrine « DQL User Defined Functions »
- [ ] **B.** La RFC PHP sur les fonctions
- [ ] **C.** La documentation Symfony sur le Query Builder
- [ ] **D.** Le composant ExpressionLanguage

## Annexe — Doctrine DBAL

### Question 41

Quelle est la relation entre DBAL et ORM selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Le DBAL est une couche d'abstraction au-dessus de PDO ; l'ORM, de plus haut niveau, l'utilise en coulisses pour communiquer avec la base
- [ ] **B.** L'ORM est une couche au-dessus du DBAL, mais totalement indépendante à l'exécution
- [ ] **C.** Le DBAL remplace l'ORM depuis Symfony 8
- [ ] **D.** Le DBAL ne peut être utilisé qu'en l'absence de l'ORM

### Question 42

Comment accède-t-on à la connexion DBAL dans un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** En autowirant `Doctrine\DBAL\Connection`, qui correspond au service `database_connection`
- [ ] **B.** Via `$this->getConnection()` sur `AbstractController`
- [ ] **C.** Uniquement en récupérant le container avec `ContainerInterface`
- [ ] **D.** Via une façade statique `DB::`

### Question 43

Quelles affirmations sur les connexions primaire/réplica (read replicas) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les opérations de lecture (ex. `fetchAllAssociative()`, `executeQuery()`) sont envoyées à une réplique, les écritures et transactions à la primaire
- [ ] **B.** Une fois la primaire utilisée, **toutes les opérations suivantes** sur cette connexion repassent par la primaire (cohérence lecture-après-écriture)
- [ ] **C.** Le routage se base sur le type de requête SQL détecté automatiquement (SELECT vs INSERT), pas sur la méthode DBAL appelée
- [ ] **D.** On peut configurer plusieurs réplicas ; Doctrine en choisit une au hasard puis la réutilise pour la connexion

### Question 44

À quoi sert l'option `keep_replica: true` ? *(une seule bonne réponse)*

- [ ] **A.** À continuer d'utiliser la réplique pour les lectures même après une opération d'écriture, quand une cohérence éventuelle est acceptable
- [ ] **B.** À garder la réplique connectée en permanence même sans requête
- [ ] **C.** À dupliquer chaque écriture sur toutes les réplicas
- [ ] **D.** À forcer systématiquement la primaire

### Question 45

Comment forcer explicitement la connexion primaire pour une lecture (ex. juste après une écriture) ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `ensureConnectedToPrimary()` sur la connexion, après avoir vérifié qu'elle est bien une instance de `PrimaryReadReplicaConnection`
- [ ] **B.** En passant `force_primary: true` en argument de `fetchAllAssociative()`
- [ ] **C.** En redémarrant la connexion
- [ ] **D.** Ce n'est pas possible ; il faut attendre la prochaine écriture

### Question 46

Dans un processus long (ex. worker Messenger), quelle précision la doc apporte-t-elle sur le comportement primaire/réplica ? *(une seule bonne réponse)*

- [ ] **A.** Le « bascule vers la primaire » s'applique pour toute la durée de vie de l'instance de connexion, pas seulement pour une requête HTTP
- [ ] **B.** Chaque message Messenger réinitialise systématiquement la connexion sur une réplique
- [ ] **C.** Les workers n'ont jamais accès aux réplicas
- [ ] **D.** Le comportement est désactivé en environnement `worker`

### Question 47

Quelles affirmations sur les types de mapping DBAL personnalisés sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `doctrine.dbal.types` enregistre un type custom, appliqué à toutes les connexions configurées
- [ ] **B.** `doctrine.dbal.mapping_types` indique au SchemaTool quel type Doctrine utiliser pour un type de colonne du SGBD non supporté nativement (ex. mapper `enum` vers `string`)
- [ ] **C.** Les deux clés (`types` et `mapping_types`) sont strictement synonymes
- [ ] **D.** Le SchemaTool utilise `mapping_types` pour comparer le schéma en base avec le mapping des entités

### Question 48

Quel est l'objectif principal de la Doctrine DBAL, indépendamment de l'ORM ? *(une seule bonne réponse)*

- [ ] **A.** Écrire des requêtes indépendamment des modèles ORM (ex. rapports, manipulations directes de données)
- [ ] **B.** Générer les entités PHP à partir du schéma
- [ ] **C.** Remplacer complètement Doctrine ORM à terme
- [ ] **D.** Gérer uniquement les migrations

## Annexe — Entity managers et connexions multiples

### Question 49

Dans quels cas la documentation recommande-t-elle plusieurs entity managers ? *(une seule bonne réponse)*

- [ ] **A.** Bases de données/vendeurs différents pour des ensembles d'entités distincts, ou un même ensemble géré avec des connexions/caches séparés — à n'ajouter que si réellement nécessaire
- [ ] **B.** Systématiquement, dès qu'une application dépasse dix entités
- [ ] **C.** Uniquement pour séparer lecture et écriture (cas déjà couvert par les réplicas DBAL)
- [ ] **D.** Jamais recommandé, quel que soit le besoin

### Question 50

Quelle limitation structurelle la documentation signale-t-elle sur les entity managers multiples ? *(une seule bonne réponse)*

- [ ] **A.** Les entités ne peuvent pas définir d'associations entre plusieurs entity managers différents
- [ ] **B.** Deux entity managers ne peuvent jamais partager la même connexion
- [ ] **C.** Il ne peut y avoir plus de deux entity managers par application
- [ ] **D.** Les migrations sont impossibles dès qu'il y a plusieurs entity managers

### Question 51

Si l'entity manager par défaut est renommé (différent de `default`), où faut-il le redéfinir explicitement ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dans la configuration Doctrine de l'environnement `prod` (`config/packages/prod/doctrine.yaml`)
- [ ] **B.** Dans la configuration `doctrine_migrations.yaml` (clé `em`)
- [ ] **C.** Dans `config/bundles.php`
- [ ] **D.** Dans `.env`, via une variable `DEFAULT_ENTITY_MANAGER`

### Question 52

Comment cibler explicitement la connexion/l'entity manager `customer` avec les commandes de la console ? *(plusieurs bonnes réponses)*

- [ ] **A.** `doctrine:database:create --connection=customer`
- [ ] **B.** `doctrine:migrations:diff --em=customer` puis `doctrine:migrations:migrate --em=customer`
- [ ] **C.** `doctrine:migrations:migrate --connection=customer` (le flag `--em` n'existerait pas pour cette commande)
- [ ] **D.** Sans option, ces commandes agissent sur la connexion/l'entity manager `default`

### Question 53

Comment injecter directement l'entity manager `customer` par autowiring dans un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant `EntityManagerInterface $customerEntityManager` — grâce aux alias d'autowiring générés par le FrameworkBundle
- [ ] **B.** C'est impossible : il faut toujours passer par `ManagerRegistry::getManager('customer')`
- [ ] **C.** En ajoutant `#[Autowire('customer')]`
- [ ] **D.** En héritant d'une classe `CustomerAwareController`

### Question 54

Une entité est gérée par plus d'un entity manager. Quel problème cela pose-t-il pour un repository custom, et quelle est la solution recommandée ? *(une seule bonne réponse)*

- [ ] **A.** `ServiceEntityRepository` utilise toujours l'entity manager **configuré** pour cette entité (comportement inattendu) → étendre `EntityRepository` à la place, et récupérer le repository via `ManagerRegistry::getRepository()`
- [ ] **B.** Aucun problème : `ServiceEntityRepository` détecte automatiquement le bon entity manager selon le contexte
- [ ] **C.** Il faut dupliquer la classe repository une fois par entity manager
- [ ] **D.** Il faut passer par une classe `MultiManagerRepository` dédiée

### Question 55

Quelles affirmations sur l'accès aux repositories via `ManagerRegistry` sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$doctrine->getRepository(Product::class)` utilise implicitement l'entity manager par défaut
- [ ] **B.** `$doctrine->getRepository(Customer::class, 'customer')` cible explicitement l'entity manager `customer`
- [ ] **C.** Il est impossible de préciser explicitement l'entity manager `default` — c'est toujours implicite
- [ ] **D.** `getManager()` sans argument et `getManager('default')` sont équivalents

## Annexe — Référencer des entités par interface (resolve_target_entity)

### Question 56

À quel problème le `ResolveTargetEntityListener` répond-il ? *(une seule bonne réponse)*

- [ ] **A.** Découpler des modules en permettant de référencer une **interface ou classe abstraite** dans le mapping d'une relation, résolue en une entité concrète au runtime
- [ ] **B.** Optimiser les performances des jointures SQL
- [ ] **C.** Générer automatiquement les migrations entre modules
- [ ] **D.** Remplacer les DTO par des interfaces

### Question 57

Comment fonctionne techniquement le `ResolveTargetEntityListener` ? *(une seule bonne réponse)*

- [ ] **A.** Il intercepte certains appels dans Doctrine et réécrit les paramètres `targetEntity` du mapping de métadonnées au runtime
- [ ] **B.** Il génère une classe PHP concrète à la volée à partir de l'interface
- [ ] **C.** Il modifie le fichier de mapping source sur le disque
- [ ] **D.** Il s'appuie sur un compiler pass du container Symfony

### Question 58

Comment configure-t-on la résolution d'une interface vers une entité concrète ? *(une seule bonne réponse)*

- [ ] **A.** Via l'option `doctrine.orm.resolve_target_entities`, un tableau `Interface::class => EntiteConcrete::class`
- [ ] **B.** Via un attribut `#[ORM\TargetEntity]` posé sur l'interface elle-même
- [ ] **C.** Via `config/bundles.php`
- [ ] **D.** Automatiquement, dès qu'une seule classe implémente l'interface

### Question 59

Cette fonctionnalité est-elle compatible avec l'`EntityValueResolver` vu dans la page principale de l'ORM ? *(une seule bonne réponse)*

- [ ] **A.** Oui, la documentation le précise explicitement
- [ ] **B.** Non, les deux mécanismes sont incompatibles
- [ ] **C.** Seulement en désactivant l'autowiring
- [ ] **D.** Seulement pour les relations ManyToMany

## Annexe — Tester un repository Doctrine

### Question 60

Que recommande la documentation à propos des tests unitaires de repositories Doctrine ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est **pas recommandé** : les repositories sont censés être testés contre une vraie connexion de base de données
- [ ] **B.** C'est la méthode privilégiée, plus rapide que les tests fonctionnels
- [ ] **C.** Il est techniquement impossible de mocker un repository Doctrine
- [ ] **D.** Recommandé uniquement pour les méthodes natives `find()`/`findAll()`

### Question 61

Dans l'exemple de mock donné (`SalaryCalculatorTest`), comment les mocks sont-ils construits ? *(une seule bonne réponse)*

- [ ] **A.** De l'intérieur vers l'extérieur : d'abord l'entité, puis le repository mocké pour la retourner, puis l'`EntityManager` mocké pour retourner ce repository
- [ ] **B.** En mockant directement la classe `SalaryCalculator`
- [ ] **C.** En utilisant une base SQLite en mémoire
- [ ] **D.** En mockant uniquement l'entité, le reste restant réel

### Question 62

Comment un test fonctionnel récupère-t-il l'entity manager pour interroger une vraie base ? *(une seule bonne réponse)*

- [ ] **A.** En étendant `KernelTestCase`, en démarrant le kernel (`self::bootKernel()`) puis en récupérant le service `doctrine` depuis le container
- [ ] **B.** En instanciant directement `new EntityManager()`
- [ ] **C.** En étendant obligatoirement `WebTestCase`
- [ ] **D.** Via une façade statique `Doctrine::getManager()`

### Question 63

Que recommande la documentation de faire dans le `tearDown()` d'un test fonctionnel utilisant l'entity manager, et pourquoi ? *(une seule bonne réponse)*

- [ ] **A.** Appeler `$this->entityManager->close()` puis le mettre à `null`, pour éviter les fuites mémoire
- [ ] **B.** Appeler `$this->entityManager->rollback()`
- [ ] **C.** Ne rien faire : PHPUnit s'en charge automatiquement
- [ ] **D.** Appeler uniquement `$this->entityManager->clear()`

### Question 64

Quelle affirmation reflète le mieux la différence entre les deux approches de test (mock vs fonctionnel) présentées ? *(une seule bonne réponse)*

- [ ] **A.** Le mock isole totalement la classe testée de toute dépendance réelle (« no real class is involved »), tandis que le test fonctionnel exécute de vraies requêtes contre la base via le repository réel
- [ ] **B.** Les deux approches offrent des garanties strictement équivalentes
- [ ] **C.** Le test fonctionnel ne doit jamais être utilisé avec Doctrine
- [ ] **D.** Le mock nécessite lui aussi une vraie connexion à la base

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Databases and the Doctrine ORM de la documentation Symfony 8.0](https://symfony.com/doc/8.0/doctrine.html). Pour les questions 22 à 64, le nom abrégé de la page annexe précède la section — *(Associations — § …)*, *(Events — § …)*, *(DQL Functions — § …)*, *(DBAL — § …)*, *(Multiple EM — § …)*, *(Resolve Target Entity — § …)*, *(Testing — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : A, B, D** — « First, install Doctrine support via the `orm` Symfony pack, as well as the MakerBundle, which will help generate some code » (`composer require symfony/orm-pack` + `composer require --dev symfony/maker-bundle`) ; « The database connection information is stored as an environment variable called `DATABASE_URL`. » C est faux : les deux paquets sont complémentaires, pas interchangeables. *(§ Installing Doctrine)*

**Question 2 : A, B** — Warning : caractères réservés (RFC 3986) à encoder via `urlencode`, en retirant le préfixe `resolve:` (`url: '%env(DATABASE_URL)%'`) ; Tip : paramètres séparés (`DATABASE_USER`, `DATABASE_PASSWORD='p@ss$wo#rd'`…) entourés de guillemets simples, avec `driver: pdo_mysql`. *(§ Configuring the Database)*

**Question 3 : A** — « Doctrine can create the `db_name` database for you: `$ php bin/console doctrine:database:create` ». *(§ Configuring the Database)*

**Question 4 : A, B, C** — Le flux interactif de questions (nom, type, longueur, nullable) ; la classe générée avec `#[ORM\Entity(...)]`, `#[ORM\Id]`, `#[ORM\GeneratedValue]`, `#[ORM\Column]` ; « You can pass either `--with-uuid` or `--with-ulid` to `make:entity`. Leveraging Symfony's Uid Component, this generates an entity with the `id` type as Uuid or Ulid instead of `int`. » La migration (D) est une étape séparée (`make:migration`). *(§ Creating an Entity Class)*

**Question 5 : A** — « There is a limit of 767 bytes for the index key prefix when using InnoDB tables in MySQL 5.6 and earlier versions. […] any column of type `string` and `unique=true` must set its maximum `length` to `190`. » *(§ Creating an Entity Class)*

**Question 6 : A, B** — « You can only use backed enums for entity properties, as Doctrine uses their scalar values for persistence. » ; « use the `enumType` option of the `#[ORM\Column]` attribute to associate the property with the enum ». Les enums purs ne sont pas utilisables (C est inventé), et Doctrine ne génère pas l'enum PHP (D). *(§ Entity Field Types)*

**Question 7 : A, B, C** — `uuid`/`ulid` : « Stores a UUID [or ULID] as a native GUID type if available, or as a 16-byte binary otherwise » ; le tableau des DatePoint types montre `date_point` étendant `datetime_immutable` ; « Symfony autodetects the 'date_point' type when type-hinting with DatePoint ». D est faux : `day_point` étend `date_immutable` et `time_point` étend `time_immutable` — ce ne sont pas de simples alias. *(§ Entity Field Types)*

**Question 8 : A, B, C** — « The migration system is smart. It compares all of your entities with the current state of the database and generates the SQL needed to synchronize them! » ; « This command executes all migration files that have not already been run against your database. » ; « Internally, it manages a `migration_versions` table to track this. » *(§ Migrations: Creating the Database Tables/Schema, § Migrations & Adding more Fields)*

**Question 9 : A** — « If you are using an SQLite database, you'll see the following error: […] Add a `nullable=true` option to the `description` property to fix the problem. » *(§ Migrations & Adding more Fields)*

**Question 10 : A, B, C** — « The `persist($product)` call tells Doctrine to "manage" the `$product` object. This does not cause a query to be made to the database. » ; « When the `flush()` method is called, Doctrine looks through all of the objects that it's managing […] » (INSERT/UPDATE) ; « If the `flush()` call fails, a `Doctrine\ORM\ORMException` exception is thrown. » D est faux pour une mise à jour : « You can call `$entityManager->persist($product)`, but it isn't necessary: Doctrine is already "watching" your object for changes. » *(§ Persisting Objects to the Database, § Updating an Object)*

**Question 11 : B** — « Whether you're creating or updating objects, the workflow is always the same: Doctrine is smart enough to know if it should INSERT or UPDATE your entity. » *(§ Persisting Objects to the Database)*

**Question 12 : A, B, C** — `auto_mapping` « define which entities should be introspected by Symfony to add automatic validation constraints » ; le tableau : `nullable=false` → `NotNull` (« Requires installing the PropertyInfo component ») ; `unique=true` → `UniqueEntity`. D est faux : « This automatic validation […] doesn't replace the validation configuration entirely. » *(§ Validating Objects)*

**Question 13 : A, B, C, D** — Les quatre méthodes citées : « look for a single Product by its primary key […] `$repository->find($id)` » ; `findOneBy(['name' => 'Keyboard'])` ; `findBy(['name' => 'Keyboard'], ['price' => 'ASC'])` ; « look for *all* Product objects `$repository->findAll();` ». *(§ Fetching Objects from the Database)*

**Question 14 : A, B, C** — « performs a `find($id)` query to find the `$product` object » pour `{id}` ; « performs a `findOneBy(['slug' => $slug])` query » pour `{slug:product}` ; « If it's not found, a 404 error is thrown. You can change this behavior by making the controller argument optional. In that case, no 404 is thrown automatically and you're free to handle the missing entity yourself. » D est faux : le comportement par défaut fonctionne sans configurer explicitement `id`. *(§ Automatically Fetching Objects (EntityValueResolver), § Fetch Automatically)*

**Question 15 : A, B, C** — Les options documentées : `mapping` (« Configures the properties and values to use with the `findOneBy()` method ») ; `stripNull` (« If true, then when `findOneBy()` is used, any values that are `null` will not be used for the query ») ; `evictCache` (« If true, forces Doctrine to always fetch the entity from the database instead of cache »). `readOnly` (D) n'existe pas dans la liste. *(§ MapEntity Options)*

**Question 16 : A, B, C** — L'exemple `repository.find(product_id)` ; « The repository method called in the expression can also return a list of entities. In that case, update the type of your controller argument [to `iterable`]. » ; « you can also access the request in your expression thanks to the `request` variable […] `request.query.get("sort", "DESC")` ». *(§ Fetch via an Expression)*

**Question 17 : B** — « To enable this, first configure the `resolve_target_entities` option. Then, your controller can type-hint the interface, and the entity will be resolved automatically » avec `#[MapEntity] ProductInterface $product`. *(§ Fetch via Interfaces)*

**Question 18 : A** — « Using Doctrine to edit an existing product consists of three steps: fetching the object from Doctrine; modifying the object; calling `flush()` on the entity manager. » *(§ Updating an Object)*

**Question 19 : A** — « `$entityManager->remove($product); $entityManager->flush();` […] the `DELETE` query isn't actually executed until the `flush()` method is called. » *(§ Deleting an Object)*

**Question 20 : A, B, C** — « The string passed to `createQuery()` might look like SQL, but it is Doctrine Query Language. This allows you to type queries […] referencing PHP objects instead. » ; « It is recommended to use [the Query Builder] when queries are built dynamically (i.e. based on PHP conditions). » ; « With SQL, you will get back raw data, not objects (unless you use the NativeQuery functionality). » *(§ Querying for Objects: The Repository, § Querying with the Query Builder, § Querying with SQL)*

**Question 21 : A** — « Doctrine community has created some extensions to implement common needs such as "set the value of the createdAt property automatically when creating an entity". Read more about the available Doctrine extensions and use the StofDoctrineExtensionsBundle to integrate them in your application. » *(§ Doctrine Extensions (Timestampable, Translatable, etc.))*

**Question 22 : A** — « There are two main relationship types: 1. ManyToOne / OneToMany - The most common relationship, mapped with a foreign key column; 2. ManyToMany - Uses a join table when both sides can have many of the other side. » *(Associations — § Overview)*

**Question 23 : A, B, C** — « The `ManyToOne` mapping is required. The `OneToMany` is optional but useful for querying from the inverse direction. » ; « Owning Side: Where the `ManyToOne` mapping is defined (must be updated for database changes). » *(Associations — § Mapping the ManyToOne Relationship, § Key Concepts)*

**Question 24 : A, B, C** — « When you access `getCategory()`, Doctrine lazily loads the related Category object with a second query. » ; « Proxy Classes: Doctrine uses proxy objects to enable lazy loading » ; l'exemple `findOneByIdJoinedToCategory` avec `INNER JOIN p.category c` en eager loading. *(Associations — § Fetching Related Objects)*

**Question 25 : A** — Le code généré : `addProduct()` appelle `$product->setCategory($this)` (commenté « Sets the owning side ») et `removeProduct()` appelle `$product->setCategory(null)`. *(Associations — § Setting Information from the Inverse Side)*

**Question 26 : A** — « To automatically delete products when removed from a category: `#[ORM\OneToMany(..., orphanRemoval: true)]`. » *(Associations — § Orphan Removal)*

**Question 27 : A** — « `$ php bin/console doctrine:migrations:diff` / `$ php bin/console doctrine:migrations:migrate` — This creates the necessary `category_id` foreign key column on the product table. » *(Associations — § Database Migrations)*

**Question 28 : A** — « ArrayCollection: Collections must implement Doctrine's `Collection` interface. » *(Associations — § Key Concepts)*

**Question 29 : A** — « Lifecycle callbacks, they are defined as public methods on the entity classes […] ; Entity listeners, they are defined as classes […] only called for the entities of a certain class […] ; Lifecycle listeners, they are similar to entity listeners but their event methods are called for all entities. » *(Events — § Doctrine Events)*

**Question 30 : A, B, C** — « Lifecycle callbacks […] can't use services, so they are intended for very simple logic related to a single entity » ; « Entity listeners […] can use services, but they are only called for the entities of a certain class […] ideal for complex event logic related to a single entity » ; « Lifecycle listeners […] called for all entities, not only those of a certain type. They are ideal to share event logic between entities. » D est faux : « lifecycle callbacks are faster than entity listeners, which in turn are faster than lifecycle listeners. » *(Events — § Doctrine Events)*

**Question 31 : A** — « When using attributes, don't forget to add `#[ORM\HasLifecycleCallbacks]` to the class of the entity where you define the callback » (en plus de `#[ORM\PrePersist]` sur la méthode). *(Events — § Doctrine Lifecycle Callbacks)*

**Question 32 : A** — Alternative sans attribut : « configure a service for the entity listener and tag it with the `doctrine.orm.entity_listener` tag », avec les options `event` et `entity`. *(Events — § Doctrine Entity Listeners)*

**Question 33 : A** — « by default, Symfony looks for a method called after the event (e.g. `postUpdate()`) if it doesn't exist, it tries to execute the `__invoke()` method, but you can configure a custom method name with the `method` option. » *(Events — § Doctrine Entity Listeners)*

**Question 34 : A, B, C** — « the listener methods receive an argument which gives you access to both the entity object of the event and the entity manager itself » + « if this listener only applies to certain entity types, add some code to check the entity type as early as possible » ; enregistrement via `#[AsDoctrineListener]` ou le tag `doctrine.event_listener` ; « listeners can define their priority […] (default priority = 0; higher numbers = listener is run earlier) » et l'option `connection`. D est faux : c'est justement pour cela qu'il faut filtrer soi-même le type d'entité (A). *(Events — § Doctrine Lifecycle Listeners)*

**Question 35 : A** — « Lifecycle listeners […] ideal to share event logic between entities. » *(Events — § Doctrine Events)*

**Question 36 : A** — « Some lifecycle callbacks receive an argument that provides access to useful information such as the current entity manager (e.g. the `preUpdate` callback receives a `PreUpdateEventArgs $event` argument). » *(Events — § Doctrine Lifecycle Callbacks)*

**Question 37 : A** — Exemple de configuration : `doctrine.orm.dql.string_functions`, `numeric_functions`, `datetime_functions`, chacune associant un nom de fonction à une classe PHP. *(DQL Functions)*

**Question 38 : B** — « In case the `entity_managers` were named explicitly, configuring the functions with the ORM directly will trigger the exception `Unrecognized option "dql" under "doctrine.orm"`. The `dql` configuration block must be defined under the named entity manager. » *(DQL Functions — § Note)*

**Question 39 : A** — « DQL functions are instantiated by Doctrine outside of the Symfony service container so you can't inject services or parameters into a custom DQL function. » *(DQL Functions — § Warning)*

**Question 40 : A** — « For more information on this topic, read Doctrine's cookbook article DQL User Defined Functions. » *(DQL Functions)*

**Question 41 : A** — « This article is about the Doctrine DBAL. Typically, you'll work with the higher level Doctrine ORM layer, which uses the DBAL behind the scenes to actually communicate with the database. » ; « an abstraction layer that sits on top of PDO ». *(DBAL — § Note)*

**Question 42 : A** — « You can then access the Doctrine DBAL connection by autowiring the `Connection` object […] This will pass you the `database_connection` service. » *(DBAL)*

**Question 43 : A, B, D** — « Read operations […] are sent to a replica; Write operations […] and transactions are sent to the primary; Once the primary has been used, all subsequent operations on that connection use the primary too, ensuring read-your-writes consistency. » ; « You can add as many replicas as needed […] Doctrine randomly selects one when connecting to a replica and keeps using it for subsequent read operations on that connection. » C est faux : « The routing is based on which DBAL method your code calls, not on SQL-level detection. » *(DBAL — § Using Primary/Replica Connections)*

**Question 44 : A** — « Set the `keep_replica` option to `true` to keep using the replica for read queries even after a write operation. This is useful when eventual consistency is acceptable for subsequent reads. » *(DBAL — § Tip)*

**Question 45 : A** — « you may need to force the primary connection […] You can do so by calling the `ensureConnectedToPrimary()` method » avec un `instanceof PrimaryReadReplicaConnection` préalable. *(DBAL — § Forcing the Primary Connection)*

**Question 46 : A** — « In long-running processes (e.g. messenger workers), the connection instance persists across multiple messages, so the "switch to primary" behavior applies for the lifetime of that connection instance, not just a single HTTP request. » *(DBAL — § Note)*

**Question 47 : A, B, D** — « You can register custom mapping types through Symfony's configuration. They will be added to all configured connections » (`doctrine.dbal.types`) ; « The SchemaTool is used to inspect the database to compare the schema. To achieve this task, it needs to know which mapping type needs to be used for each database type » (`doctrine.dbal.mapping_types`, ex. `enum: string`). C est faux : ce sont deux mécanismes distincts (type DBAL custom vs correspondance pour le SchemaTool). *(DBAL — § Registering custom Mapping Types, § Registering custom Mapping Types in the SchemaTool)*

**Question 48 : A** — « The DBAL library allows you to write queries independently of your ORM models, e.g. for building reports or direct data manipulations. » *(DBAL — § introduction)*

**Question 49 : A** — « This is necessary if you are using different databases or even vendors with entirely different sets of entities. […] It is also possible to use multiple entity managers to manage a common set of entities, each with their own database connection strings or separate cache configuration. » ; « Using multiple entity managers is not complicated to configure, but more advanced and not usually required. Be sure you actually need multiple entity managers before adding in this layer of complexity. » *(Multiple EM — § introduction, § Note)*

**Question 50 : A** — « Entities cannot define associations across different entity managers. » *(Multiple EM — § Warning)*

**Question 51 : A, B** — « If you use a different name than `default` for the default entity manager, you will need to redefine the default entity manager in the `prod` environment configuration and in the Doctrine migrations configuration » : `config/packages/prod/doctrine.yaml` (`default_entity_manager`) et `config/packages/doctrine_migrations.yaml` (`em`). *(Multiple EM — § Redefining the Default Entity Manager)*

**Question 52 : A, B, D** — `doctrine:database:create --connection=customer` ; `doctrine:migrations:diff --em=customer` puis `doctrine:migrations:migrate --em=customer` ; « If you _do_ omit the name of the connection or entity manager, the default (i.e. `default`) is used. » C est faux : le flag pour les migrations est bien `--em`, pas `--connection`. *(Multiple EM — § Working with Multiple Connections, § Working with Multiple Entity Managers)*

**Question 53 : A** — « Entity managers also benefit from autowiring aliases when the framework bundle is used. For example, to inject the `customer` entity manager, type-hint your method with `EntityManagerInterface $customerEntityManager`. » *(Multiple EM — § Accessing Entity Managers in Controllers)*

**Question 54 : A** — « One entity can be managed by more than one entity manager. This however results in unexpected behavior when extending from `ServiceEntityRepository` […] The `ServiceEntityRepository` always uses the configured entity manager for that entity. In order to fix this situation, extend `EntityRepository` instead […] You should now always fetch this repository using `ManagerRegistry::getRepository()`. » *(Multiple EM — § Custom Repositories with Multiple Entity Managers)*

**Question 55 : A, B, D** — « Retrieves a repository managed by the "default" entity manager `$doctrine->getRepository(Product::class)->findAll();` » ; « Retrieves a repository managed by the "customer" entity manager `$doctrine->getRepository(Customer::class, 'customer')->findAll();` » ; « Both methods return the default entity manager » pour `getManager()` et `getManager('default')`. L'exemple montre aussi qu'on **peut** préciser explicitement `'default'` (C est donc faux). *(Multiple EM — § Accessing Entity Managers in Controllers, § Repository Calls)*

**Question 56 : A** — « Doctrine provides a utility called the `ResolveTargetEntityListener` to solve this issue. […] This allows you to reference an interface or abstract class in your mappings and have it resolved to a concrete entity at runtime. » *(Resolve Target Entity — § Background)*

**Question 57 : A** — « It works by intercepting certain calls within Doctrine and rewriting `targetEntity` parameters in your metadata mapping at runtime. » *(Resolve Target Entity — § Background)*

**Question 58 : A** — Exemple de configuration `doctrine.orm.resolve_target_entities: App\Model\InvoiceSubjectInterface: App\Entity\Customer`. *(Resolve Target Entity — § Set up)*

**Question 59 : A** — « This feature also works with the `EntityValueResolver` as explained in the main Doctrine article. » *(Resolve Target Entity — § Background)*

**Question 60 : A** — « Unit testing Doctrine repositories is not recommended. Repositories are meant to be tested against a real database connection. » *(Testing — § Mocking a Doctrine Repository in Unit Tests)*

**Question 61 : A** — « you are building the mocks from the inside out, first creating the employee which gets returned by the Repository, which itself gets returned by the EntityManager. This way, no real class is involved in testing. » *(Testing — § Mocking a Doctrine Repository in Unit Tests)*

**Question 62 : A** — Exemple `ProductRepositoryTest extends KernelTestCase` : `$kernel = self::bootKernel();` puis `$kernel->getContainer()->get('doctrine')->getManager()`. *(Testing — § Functional Testing of a Doctrine Repository)*

**Question 63 : A** — « // doing this is recommended to avoid memory leaks `$this->entityManager->close(); $this->entityManager = null;` » *(Testing — § Functional Testing of a Doctrine Repository)*

**Question 64 : A** — Le test unitaire construit des mocks « from the inside out […] no real class is involved in testing » ; le test fonctionnel « make queries to the database using the actual Doctrine repositories, instead of mocking them ». *(Testing — § Mocking a Doctrine Repository in Unit Tests, § Functional Testing of a Doctrine Repository)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/doctrine.html#learn-more) de la page :

- [How to Work with Doctrine Associations / Relations](https://symfony.com/doc/8.0/doctrine/associations.html) — questions 22 à 28
- [Doctrine Events](https://symfony.com/doc/8.0/doctrine/events.html) — questions 29 à 36
- [How to Register custom DQL Functions](https://symfony.com/doc/8.0/doctrine/custom_dql_functions.html) — questions 37 à 40
- [How to Use Doctrine DBAL](https://symfony.com/doc/8.0/doctrine/dbal.html) — questions 41 à 48
- [How to Work with Multiple Entity Managers and Connections](https://symfony.com/doc/8.0/doctrine/multiple_entity_managers.html) — questions 49 à 55
- [Referencing Entities with Abstract Classes and Interfaces](https://symfony.com/doc/8.0/doctrine/resolve_target_entity.html) — questions 56 à 59
- [How to Test a Doctrine Repository](https://symfony.com/doc/8.0/testing/database.html) — questions 60 à 64
