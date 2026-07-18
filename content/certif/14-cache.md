# QCM — Le cache

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/cache.html](https://symfony.com/doc/8.0/cache.html) · **Généré le :** 21 juillet 2026
>
> **74 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Utilisation de base et Cache Contracts

### Question 1

Que fait exactement l'exemple `$pool->get('my_cache_key', function (ItemInterface $item) {...})` fourni par la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Le callback est systématiquement exécuté, qu'il y ait un miss ou un hit
- [ ] **B.** Le callback n'est exécuté qu'en cas de cache miss
- [ ] **C.** Il retourne toujours `null` lors d'un hit
- [ ] **D.** Il ne fonctionne qu'avec l'adapter `cache.adapter.array`

### Question 2

Que fait `$item->expiresAfter(3600)` dans ce même exemple ? *(une seule bonne réponse)*

- [ ] **A.** Il définit la durée de vie de l'item mis en cache, ici 3600 secondes
- [ ] **B.** Il retarde l'exécution du callback de 3600 secondes
- [ ] **C.** Il limite l'item à 3600 lectures maximum
- [ ] **D.** Il n'a d'effet qu'avec les adapters basés sur Redis

### Question 3

Comment supprimer une entrée du cache via son identifiant de clé ? *(une seule bonne réponse)*

- [ ] **A.** `$pool->remove('my_cache_key')`
- [ ] **B.** `$pool->unset('my_cache_key')`
- [ ] **C.** `$pool->delete('my_cache_key')`
- [ ] **D.** `$pool->clear('my_cache_key')`

### Question 4

Quelles interfaces/standards le composant Cache de Symfony supporte-t-il, d'après l'introduction ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement des Cache Contracts propriétaires à Symfony
- [ ] **B.** Les Cache Contracts ainsi que les interfaces PSR-6 et PSR-16
- [ ] **C.** Seulement PSR-16, PSR-6 étant abandonné
- [ ] **D.** Aucun standard particulier, le composant est propriétaire

### Question 5

Pourquoi le composant Cache embarque-t-il autant d'adaptateurs différents ? *(une seule bonne réponse)*

- [ ] **A.** Chaque adaptateur cible un stockage différent et chacun est développé pour offrir de hautes performances
- [ ] **B.** Un seul est réellement utilisable, les autres sont dépréciés
- [ ] **C.** PSR-6 impose un minimum de cinq implémentations
- [ ] **D.** Ce n'est pas expliqué par la documentation

### Question 6

Où la documentation renvoie-t-elle pour en savoir plus sur les Cache Contracts et les interfaces PSR-6/16 ? *(une seule bonne réponse)*

- [ ] **A.** Vers la référence de configuration `framework.cache`
- [ ] **B.** Vers la documentation du composant Cache
- [ ] **C.** Vers la spécification PSR-6 du PHP-FIG uniquement, sans autre lien
- [ ] **D.** Il n'existe aucun renvoi, l'article est totalement autonome

## Configurer le cache avec FrameworkBundle

### Question 7

Que représente un « Pool » dans le vocabulaire du composant Cache ? *(une seule bonne réponse)*

- [ ] **A.** Un service avec lequel on interagit ; chaque pool a son propre namespace et ses propres items, sans jamais entrer en conflit avec un autre pool
- [ ] **B.** Un ensemble de connexions réseau ouvertes
- [ ] **C.** Un groupe de serveurs en cluster
- [ ] **D.** Une simple constante de configuration YAML

### Question 8

Que représente un « Adapter » ? *(une seule bonne réponse)*

- [ ] **A.** Un service qui gère uniquement les connexions réseau
- [ ] **B.** Un *template* utilisé pour créer des pools
- [ ] **C.** Un synonyme exact de « Pool »
- [ ] **D.** Le nom du fichier de configuration du cache

### Question 9

Que représente un « Provider », et que se passe-t-il si un DSN est utilisé comme provider ? *(une seule bonne réponse)*

- [ ] **A.** Un provider ne concerne que les pools en mode chaîne
- [ ] **B.** C'est un synonyme d'« Adapter »
- [ ] **C.** Un service que certains adapters, comme Redis ou Memcached, utilisent pour se connecter au stockage ; si un DSN est utilisé comme provider, un service est créé automatiquement
- [ ] **D.** Utiliser un DSN comme provider lève toujours une exception

### Question 10

Parmi ces adaptateurs, lesquels font partie de la liste des adaptateurs pré-configurés par le composant Cache ? *(plusieurs bonnes réponses)*

- [ ] **A.** `cache.adapter.apcu` et `cache.adapter.array`
- [ ] **B.** `cache.adapter.filesystem` et `cache.adapter.redis`
- [ ] **C.** `cache.adapter.pdo` et `cache.adapter.memcached`
- [ ] **D.** `cache.adapter.mongodb`

### Question 11

À quoi sert l'adaptateur spécial `cache.adapter.system`, et comment fonctionne-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il est recommandé pour le cache système et sélectionne dynamiquement le meilleur stockage possible : fichiers PHP ou APCu
- [ ] **B.** Il n'est utile qu'en environnement de test
- [ ] **C.** Il force toujours l'usage d'APCu, sans aucun repli
- [ ] **D.** C'est un simple alias de `cache.adapter.filesystem`

### Question 12

Quelle option de configuration `framework.cache` ne s'applique qu'à l'adapter `cache.adapter.filesystem` ? *(une seule bonne réponse)*

- [ ] **A.** `default_redis_provider`
- [ ] **B.** `default_pdo_provider`
- [ ] **C.** `directory`
- [ ] **D.** `default_psr6_provider`

### Question 13

À quoi servent des options comme `default_redis_provider`, `default_memcached_provider` ou `default_pdo_provider` ? *(une seule bonne réponse)*

- [ ] **A.** Elles activent ou désactivent l'adapter correspondant
- [ ] **B.** Elles définissent des raccourcis pour configurer le provider par défaut de chaque type d'adapter, sans devoir déclarer un service dédié
- [ ] **C.** Elles fixent le TTL par défaut de chaque adapter
- [ ] **D.** Elles ne s'appliquent qu'à l'environnement `dev`

### Question 14

Quel adaptateur Redis la documentation cite-t-elle comme spécifiquement optimisé pour fonctionner avec les tags de cache ? *(une seule bonne réponse)*

- [ ] **A.** `cache.adapter.redis`
- [ ] **B.** `cache.adapter.redis_tag_aware`
- [ ] **C.** `cache.adapter.psr6`
- [ ] **D.** `cache.adapter.doctrine_dbal`

## Cache système et cache applicatif

### Question 15

Quels sont les deux pools de cache toujours activés par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `cache.default` et `cache.custom`
- [ ] **B.** `cache.system` et `cache.app`
- [ ] **C.** `cache.internal` et `cache.external`
- [ ] **D.** `cache.global` et `cache.local`

### Question 16

Par quels éléments internes de Symfony le pool `cache.system` est-il utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement par le Profiler
- [ ] **B.** Par des composants comme les annotations, le serializer et la validation
- [ ] **C.** Uniquement par le composant Messenger
- [ ] **D.** Il n'est utilisé qu'en environnement `prod`

### Question 17

Sous quelles conditions le pool `cache.system` est-il aussi utilisable pour du code applicatif ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les entrées doivent pouvoir être dérivées du code source et régénérées pendant le warmup du cache, via un `CacheWarmer`
- [ ] **B.** Le contenu mis en cache ne doit changer que lorsque le code source change, donc au déploiement et non à l'exécution — à traiter comme lecture seule après déploiement
- [ ] **C.** Il faut au préalable désactiver `cache.app`
- [ ] **D.** Il faut obligatoirement utiliser l'adapter Redis

### Question 18

Quel adapter utilise `cache.system` par défaut, et que recommande la documentation à son sujet ? *(une seule bonne réponse)*

- [ ] **A.** `cache.adapter.redis` ; il est recommandé de le remplacer systématiquement par un adapter plus rapide
- [ ] **B.** `cache.adapter.system`, qui écrit sur le système de fichiers et chaîne APCu quand disponible ; il est recommandé de garder la configuration par défaut
- [ ] **C.** `cache.adapter.array` ; aucune recommandation particulière
- [ ] **D.** `cache.adapter.pdo` ; il est déconseillé de le laisser tel quel

### Question 19

Quel est le rôle du pool `cache.app` ? *(une seule bonne réponse)*

- [ ] **A.** Un cache réservé aux composants internes de Symfony uniquement
- [ ] **B.** Un cache de données à usage général pour le code applicatif et des bundles, dont les données n'ont pas besoin d'être vidées au déploiement
- [ ] **C.** Un cache exclusivement dédié aux sessions utilisateur
- [ ] **D.** Un cache qui se vide automatiquement à chaque déploiement

### Question 20

Quel adapter utilise `cache.app` par défaut, et que recommande la documentation quand un adapter plus rapide est disponible ? *(une seule bonne réponse)*

- [ ] **A.** `cache.adapter.filesystem` par défaut ; utiliser un adapter plus rapide comme Redis est recommandé quand disponible, car cela permet aux données de survivre aux déploiements et d'être partagées entre plusieurs instances en environnement multi-serveur
- [ ] **B.** `cache.adapter.redis` par défaut, sans recommandation particulière
- [ ] **C.** `cache.adapter.system`, identique à `cache.system`
- [ ] **D.** `cache.adapter.array`, car il est plus rapide que Redis

### Question 21

Par défaut, quel adapter utilisent les pools personnalisés si aucun n'est configuré explicitement ? *(une seule bonne réponse)*

- [ ] **A.** `cache.adapter.filesystem`
- [ ] **B.** `cache.app`
- [ ] **C.** `cache.adapter.array`
- [ ] **D.** Il n'y a pas de valeur par défaut, une erreur est levée

### Question 22

Comment `cache.app` est-il injecté automatiquement via l'autowiring ? *(une seule bonne réponse)*

- [ ] **A.** Il faut toujours préciser explicitement son id de service
- [ ] **B.** Il est injecté automatiquement dans tout argument de service typé `CacheItemPoolInterface`, `AdapterInterface` ou `CacheInterface`
- [ ] **C.** Il n'est jamais autowirable, contrairement aux pools personnalisés
- [ ] **D.** Seulement si l'argument s'appelle exactement `$cacheApp`

### Question 23

Comment reconfigurer l'adapter utilisé par les pools prédéfinis `cache.system` et `cache.app` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable, ce sont des pools figés
- [ ] **B.** Via les clés `app` et `system` de la configuration `framework.cache`
- [ ] **C.** Uniquement en redéfinissant entièrement le service dans `services.yaml`
- [ ] **D.** Via une variable d'environnement `CACHE_APP_ADAPTER`

## Créer des pools personnalisés (namespaced)

### Question 24

Comment déclare-t-on un nouveau pool de cache personnalisé, par exemple `my_cache_pool` ? *(une seule bonne réponse)*

- [ ] **A.** Sous la clé `framework.cache.pools`, en précisant son `adapter`
- [ ] **B.** En créant un fichier `config/packages/pools.yaml` dédié
- [ ] **C.** Automatiquement, dès qu'un service implémente `CacheItemPoolInterface`
- [ ] **D.** Via un attribut PHP `#[AsCachePool]`

### Question 25

Comment un pool personnalisé nommé `custom_thing.cache` devient-il autowirable, et sous quel nom d'argument ? *(une seule bonne réponse)*

- [ ] **A.** Il ne devient jamais autowirable, un alias explicite est toujours requis
- [ ] **B.** Un alias d'autowiring est créé automatiquement, en camelCase, permettant l'injection via un argument nommé `$customThingCache` et typé `CacheInterface` (ou `CacheItemPoolInterface`)
- [ ] **C.** Uniquement via l'id exact du service, jamais par typage
- [ ] **D.** Il faut ajouter manuellement un alias dans `services.yaml`

### Question 26

Comment Symfony garantit-il que les clés de deux pools différents ne collisionnent jamais, même si ces pools partagent le même backend ? *(une seule bonne réponse)*

- [ ] **A.** En interdisant à deux pools d'utiliser le même adapter
- [ ] **B.** En préfixant les clés avec un namespace généré en hachant le nom du pool, le nom de la classe de l'adapter, et un seed configurable qui vaut par défaut le répertoire du projet et la classe du container compilé
- [ ] **C.** En stockant chaque pool dans une base de données séparée physiquement
- [ ] **D.** Ce n'est pas garanti, il faut gérer les collisions manuellement

### Question 27

Comment personnaliser ce namespace généré automatiquement, par exemple pour interopérer avec une application tierce ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le namespace est toujours généré automatiquement
- [ ] **B.** En définissant l'attribut `namespace` du tag de service `cache.pool`
- [ ] **C.** En renommant directement le service
- [ ] **D.** En modifiant le `seed` global de l'application, ce qui affecte tous les pools

### Question 28

Dans l'exemple de pool `short_cache`, qui utilise le pool `foobar.cache` comme `adapter` avec `default_lifetime: 60`, que peut-on en conclure ? *(une seule bonne réponse)*

- [ ] **A.** Un pool peut utiliser un autre pool comme backend tout en définissant sa propre durée de vie par défaut, et il conserve malgré tout son propre namespace de cache séparé
- [ ] **B.** `short_cache` et `foobar.cache` partagent exactement le même namespace
- [ ] **C.** `default_lifetime` n'a d'effet que sur les adapters Redis
- [ ] **D.** Ce n'est pas une configuration valide, un pool ne peut pas référencer un autre pool comme adapter

### Question 29

Dans l'exemple `foobar.cache`, qui définit `adapter: cache.adapter.memcached` et `provider: 'memcached://user:password@example.com'`, à quoi sert la clé `provider` au niveau d'un pool ? *(une seule bonne réponse)*

- [ ] **A.** Elle permet de contrôler la configuration spécifique de l'adapter pour ce pool précis, ici le DSN de connexion Memcached
- [ ] **B.** Elle définit le nom du service qui consommera ce pool
- [ ] **C.** Elle n'a aucun effet si `default_memcached_provider` est déjà défini globalement
- [ ] **D.** Elle sert uniquement à documenter le pool, sans effet réel

### Question 30

Une fois un pool personnalisé injecté, par exemple `CacheInterface $customThingCache`, comment l'utiliser dans une méthode de contrôleur ou un service, d'après l'exemple donné ? *(une seule bonne réponse)*

- [ ] **A.** En le typant en argument de constructeur ou de méthode d'action, exactement comme n'importe quel autre service autowiré
- [ ] **B.** Il faut obligatoirement le récupérer via le container avec `$container->get()`
- [ ] **C.** Il ne peut être utilisé que dans les commandes console
- [ ] **D.** Il faut l'instancier manuellement avec `new`

## Options de provider personnalisées

### Question 31

Quelles options spécifiques la documentation cite-t-elle comme configurables sur le `RedisAdapter`, et comment les utiliser avec des valeurs non par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `timeout` et `retry_interval` ; pour utiliser des valeurs non par défaut, il faut créer son propre service provider `\Redis` et l'utiliser dans la configuration du pool
- [ ] **B.** `timeout` uniquement, configurable directement dans `framework.cache.pools`
- [ ] **C.** Aucune option spécifique n'est configurable sur cet adapter
- [ ] **D.** `ttl` et `prefix`, comme pour le handler de session Redis

### Question 32

Dans l'exemple de provider Redis personnalisé, comment le service `\Redis` est-il construit ? *(une seule bonne réponse)*

- [ ] **A.** Via `new \Redis()` directement dans `services.yaml`
- [ ] **B.** Via une `factory` pointant vers `RedisAdapter::createConnection`, avec le DSN et les options en arguments
- [ ] **C.** Il est injecté automatiquement sans configuration
- [ ] **D.** Via une commande `bin/console cache:redis:create`

### Question 33

Comment un pool référence-t-il ce service de provider personnalisé ? *(une seule bonne réponse)*

- [ ] **A.** Via la clé `provider` du pool, pointant vers l'id du service personnalisé
- [ ] **B.** Automatiquement, dès que le service `\Redis` existe dans le container
- [ ] **C.** Via `default_redis_provider`, qui prend toujours le dessus
- [ ] **D.** Ce n'est pas possible, seul un DSN littéral est accepté comme provider

## Créer une chaîne de cache

### Question 34

Pourquoi utiliser une chaîne de cache combinant plusieurs adapters ? *(une seule bonne réponse)*

- [ ] **A.** Parce que différents adapters ont des forces et faiblesses différentes, rapidité contre capacité de stockage ; la chaîne permet de cumuler les avantages de plusieurs
- [ ] **B.** Uniquement pour la redondance en cas de panne, sans gain de performance
- [ ] **C.** Parce qu'un seul adapter ne peut jamais être utilisé seul
- [ ] **D.** Pour répartir la charge réseau entre plusieurs serveurs identiques

### Question 35

Que se passe-t-il en écriture, lors du stockage d'un item, dans une chaîne de cache ? *(une seule bonne réponse)*

- [ ] **A.** L'item n'est stocké que dans le premier pool de la chaîne
- [ ] **B.** L'item est stocké séquentiellement dans tous les pools de la chaîne
- [ ] **C.** L'item est stocké aléatoirement dans un seul pool de la chaîne
- [ ] **D.** L'item est stocké uniquement dans le dernier pool, le plus lent

### Question 36

Que se passe-t-il en lecture, lors de la récupération d'un item, dans une chaîne de cache ? *(une seule bonne réponse)*

- [ ] **A.** Symfony interroge tous les pools simultanément et retourne le premier résultat obtenu
- [ ] **B.** Symfony essaie d'abord le premier pool, puis les suivants un par un jusqu'à trouver l'item ou épuiser tous les pools
- [ ] **C.** Symfony interroge uniquement le dernier pool de la chaîne
- [ ] **D.** La lecture échoue systématiquement si le premier pool ne contient pas l'item

### Question 37

Dans quel ordre la documentation recommande-t-elle de définir les adapters d'une chaîne ? *(une seule bonne réponse)*

- [ ] **A.** Du plus lent au plus rapide
- [ ] **B.** Du plus rapide au plus lent
- [ ] **C.** Par ordre alphabétique du nom de l'adapter
- [ ] **D.** L'ordre n'a aucune importance

### Question 38

Que se passe-t-il si une erreur survient lors du stockage d'un item dans l'un des pools de la chaîne ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est immédiatement levée, interrompant tout le processus
- [ ] **B.** L'item est tout de même stocké dans les autres pools, sans qu'aucune exception ne soit levée ; à la prochaine lecture, l'item sera automatiquement restocké dans les pools manquants
- [ ] **C.** La chaîne entière devient indisponible jusqu'au prochain déploiement
- [ ] **D.** L'erreur est silencieusement ignorée sans aucun autre effet

### Question 39

Comment configure-t-on les pools d'une chaîne de cache, par opposition à un pool simple ? *(une seule bonne réponse)*

- [ ] **A.** Avec une clé `adapters` listant plusieurs adapters, au lieu de la clé `adapter` unique
- [ ] **B.** En déclarant plusieurs pools séparés reliés entre eux via un service `ChainAdapterFactory`
- [ ] **C.** Uniquement via un compiler pass personnalisé
- [ ] **D.** En listant les adapters dans le fichier `services.yaml`, jamais dans `framework.cache`

### Question 40

Dans l'exemple `my_cache_pool` avec `default_lifetime: 31536000`, à quoi correspond cette valeur ? *(une seule bonne réponse)*

- [ ] **A.** Une durée d'un an
- [ ] **B.** Une durée d'un mois
- [ ] **C.** Un nombre maximal d'entrées, pas une durée
- [ ] **D.** Le TTL minimal, pas maximal, de chaque item

## Utiliser les tags de cache

### Question 41

Quel est l'intérêt principal des tags de cache dans une application avec de nombreuses clés ? *(une seule bonne réponse)*

- [ ] **A.** Réduire la taille de chaque entrée de cache
- [ ] **B.** Pouvoir invalider en un seul appel toutes les entrées partageant un même tag, pour une invalidation plus efficace
- [ ] **C.** Chiffrer automatiquement les entrées taguées
- [ ] **D.** Accélérer la lecture de toutes les entrées, taguées ou non

### Question 42

Quelle interface l'adapter de cache doit-il implémenter pour permettre l'usage des tags ? *(une seule bonne réponse)*

- [ ] **A.** `CacheItemPoolInterface`
- [ ] **B.** `TagAwareCacheInterface`
- [ ] **C.** `AdapterInterface`
- [ ] **D.** `PruneableInterface`

### Question 43

Comment ajoute-t-on un ou plusieurs tags à un item de cache lors de sa création ? *(une seule bonne réponse)*

- [ ] **A.** `$item->tag(['foo', 'bar'])` ou `$item->tag('foo')` dans le callback passé à `get()`
- [ ] **B.** `$pool->addTag($item, 'foo')`
- [ ] **C.** Via un attribut PHP `#[CacheTag('foo')]` sur la méthode
- [ ] **D.** Les tags ne peuvent être ajoutés qu'après coup, jamais à la création

### Question 44

Comment invalide-t-on toutes les entrées associées au tag `bar` ? *(une seule bonne réponse)*

- [ ] **A.** `$pool->delete('bar')`
- [ ] **B.** `$pool->invalidateTags(['bar'])`
- [ ] **C.** `$pool->clear('bar')`
- [ ] **D.** `$pool->removeTag('bar')`

### Question 45

Comment activer la fonctionnalité de tags sur un pool quelconque, sans changer d'adapter ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est possible qu'en changeant d'adapter pour `cache.adapter.redis_tag_aware`
- [ ] **B.** En ajoutant l'option `tags: true` à la configuration du pool
- [ ] **C.** En ajoutant le service `TagAwareCacheInterface` manuellement au container
- [ ] **D.** Les tags sont activés par défaut sur tous les pools, aucune configuration requise

### Question 46

Où les tags sont-ils stockés par défaut, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** Toujours dans un pool séparé et dédié, non configurable
- [ ] **B.** Dans le même pool que les données par défaut ; on peut spécifier un pool différent via `tags: <nom_du_pool>`
- [ ] **C.** Toujours en base de données, indépendamment de l'adapter de données
- [ ] **D.** Les tags ne sont jamais persistés, uniquement en mémoire du process

### Question 47

À quel service `TagAwareCacheInterface` est-il autowiré par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `cache.system`
- [ ] **B.** `cache.app`
- [ ] **C.** Aucun, il faut toujours déclarer explicitement quel pool utiliser
- [ ] **D.** Le premier pool taggable déclaré dans la configuration

### Question 48

Quel adaptateur Redis dédié permet d'utiliser les tags sans devoir ajouter `tags: true` manuellement dans la configuration ? *(une seule bonne réponse)*

- [ ] **A.** `cache.adapter.redis`
- [ ] **B.** `cache.adapter.redis_tag_aware`
- [ ] **C.** `cache.adapter.psr6`
- [ ] **D.** `cache.adapter.array`

### Question 49

Dans l'exemple de code sur les tags, quel autowiring type-hint permet d'injecter un pool taguable ? *(une seule bonne réponse)*

- [ ] **A.** `CacheItemPoolInterface`
- [ ] **B.** `TagAwareCacheInterface`
- [ ] **C.** `AdapterInterface`
- [ ] **D.** `PoolInterface`

## Vider le cache

### Question 50

Que fait `bin/console cache:pool:clear [pool]`, et quelle conséquence cela a-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il supprime toutes les entrées du stockage du pool ; toutes les valeurs devront être recalculées
- [ ] **B.** Il ne fait que marquer les entrées comme expirées, sans les supprimer
- [ ] **C.** Il supprime uniquement les entrées taguées
- [ ] **D.** Il ne fonctionne que sur le pool `cache.app`

### Question 51

Combien de « cache clearers » existent par défaut, et lesquels ? *(une seule bonne réponse)*

- [ ] **A.** Deux : `cache.app_clearer` et `cache.system_clearer`
- [ ] **B.** Trois : `cache.global_clearer`, `cache.system_clearer` et `cache.app_clearer`
- [ ] **C.** Un seul : `cache.default_clearer`
- [ ] **D.** Quatre, un par adapter principal

### Question 52

Que fait le `cache.global_clearer`, et lequel des clearers est utilisé par la commande `bin/console cache:clear` ? *(une seule bonne réponse)*

- [ ] **A.** Le clearer global vide tous les items de tous les pools ; c'est le `cache.system_clearer` qui est utilisé par `cache:clear`
- [ ] **B.** Le clearer global ne vide que `cache.app` ; `cache:clear` utilise le clearer global
- [ ] **C.** Le clearer global ne fait rien par lui-même, il faut toujours préciser un pool
- [ ] **D.** C'est `cache.app_clearer` qui est utilisé par `cache:clear`

### Question 53

Quel clearer est le clearer par défaut si aucun n'est précisé ? *(une seule bonne réponse)*

- [ ] **A.** `cache.global_clearer`
- [ ] **B.** `cache.system_clearer`
- [ ] **C.** `cache.app_clearer`
- [ ] **D.** Il n'y a pas de clearer par défaut, il faut toujours en préciser un

### Question 54

Quelle commande permet de lister tous les pools de cache disponibles ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console cache:pool:list`
- [ ] **B.** `php bin/console debug:cache-pools`
- [ ] **C.** `php bin/console cache:pool:show`
- [ ] **D.** `php bin/console cache:list`

### Question 55

Comment vider tous les pools personnalisés sauf certains, en une seule commande ? *(une seule bonne réponse)*

- [ ] **A.** `cache:pool:clear --all --exclude=my_cache_pool --exclude=another_cache_pool`
- [ ] **B.** `cache:pool:clear cache.app_clearer --skip=my_cache_pool`
- [ ] **C.** Ce n'est pas possible, il faut vider chaque pool un par un
- [ ] **D.** `cache:pool:clear --except=my_cache_pool`

### Question 56

Comment vider absolument tous les caches, y compris le cache système ? *(une seule bonne réponse)*

- [ ] **A.** `cache:pool:clear --all`, qui inclut toujours le cache système
- [ ] **B.** `cache:pool:clear cache.global_clearer`
- [ ] **C.** `cache:clear --deep`
- [ ] **D.** Ce n'est pas possible en une seule commande

### Question 57

Comment invalider un ou plusieurs tags sur tous les pools taguables d'un coup ? *(une seule bonne réponse)*

- [ ] **A.** `cache:pool:invalidate-tags tag1 tag2`
- [ ] **B.** `cache:pool:clear --tags=tag1,tag2`
- [ ] **C.** `cache:pool:delete-tags tag1 tag2`
- [ ] **D.** Ce n'est possible qu'en PHP, pas via la console

### Question 58

Comment restreindre l'invalidation de tags à un ou plusieurs pools précis via la console ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, l'invalidation par tag touche toujours tous les pools
- [ ] **B.** Avec l'option `--pool=`, ou son raccourci `-p`, répétable pour plusieurs pools
- [ ] **C.** En créant un clearer dédié par pool
- [ ] **D.** En précisant le pool en dernier argument positionnel, sans option dédiée

## Chiffrer le cache

### Question 59

Quelle bibliothèque et quelle classe la documentation utilise-t-elle pour chiffrer le cache ? *(une seule bonne réponse)*

- [ ] **A.** OpenSSL, via une classe `OpenSslMarshaller`
- [ ] **B.** libsodium, via la classe `SodiumMarshaller`
- [ ] **C.** Sodium n'est pas supporté, seul un chiffrement applicatif manuel est documenté
- [ ] **D.** libsodium, via un décorateur `EncryptedCacheAdapter`

### Question 60

Comment génère-t-on la clé nécessaire, et sous quel nom la stocker dans le stockage de secrets ? *(une seule bonne réponse)*

- [ ] **A.** `php -r 'echo base64_encode(sodium_crypto_box_keypair());'`, stockée comme `CACHE_DECRYPTION_KEY`
- [ ] **B.** `openssl rand -hex 32`, stockée comme `CACHE_SECRET`
- [ ] **C.** Elle est générée automatiquement au premier accès au cache
- [ ] **D.** Via `bin/console secrets:generate-cache-key`

### Question 61

Comment déclare-t-on le service `SodiumMarshaller` pour qu'il s'applique effectivement au cache ? *(une seule bonne réponse)*

- [ ] **A.** En le déclarant avec `decorates: cache.default_marshaller`, avec la clé et `'@.inner'` en arguments
- [ ] **B.** En le taguant `cache.marshaller`
- [ ] **C.** En le nommant `cache.default_marshaller` pour écraser le service existant
- [ ] **D.** Ce n'est pas possible de décorer ce service

### Question 62

Que permet de faire la configuration avec plusieurs clés, par exemple `CACHE_DECRYPTION_KEY` et `OLD_CACHE_DECRYPTION_KEY` ? *(une seule bonne réponse)*

- [ ] **A.** Chiffrer les données avec deux algorithmes différents simultanément
- [ ] **B.** Faire tourner les clés : la première sert en lecture et écriture, les clés additionnelles ne servent qu'en lecture, le temps que les anciennes entrées expirent
- [ ] **C.** Chiffrer séparément les clés de cache et les valeurs
- [ ] **D.** Répartir le chiffrement entre plusieurs pools différents

### Question 63

Une fois toutes les entrées chiffrées avec l'ancienne clé expirées, que peut-on faire ? *(une seule bonne réponse)*

- [ ] **A.** Rien, il faut garder toutes les anciennes clés indéfiniment
- [ ] **B.** Supprimer complètement `OLD_CACHE_DECRYPTION_KEY`
- [ ] **C.** Régénérer immédiatement `CACHE_DECRYPTION_KEY`
- [ ] **D.** Vider tout le cache avant de pouvoir retirer l'ancienne clé

### Question 64

Quel avertissement « danger » la documentation formule-t-elle sur ce chiffrement ? *(une seule bonne réponse)*

- [ ] **A.** Il chiffre les valeurs des items de cache, mais pas les clés de cache — il faut donc éviter d'y exposer des données sensibles
- [ ] **B.** Il ne fonctionne pas avec les pools taggables
- [ ] **C.** Il double le temps de calcul de chaque `get()`
- [ ] **D.** Il est incompatible avec les chaînes de cache

## Calculer les valeurs de cache de façon asynchrone

### Question 65

Quel algorithme le composant Cache utilise-t-il pour se protéger contre le problème du « cache stampede » ? *(une seule bonne réponse)*

- [ ] **A.** Le « round-robin expiration »
- [ ] **B.** La « probabilistic early expiration »
- [ ] **C.** Le « least recently used eviction »
- [ ] **D.** Le « write-through caching »

### Question 66

Que signifie concrètement qu'un item soit « élu pour early-expiration » ? *(une seule bonne réponse)*

- [ ] **A.** Il est supprimé immédiatement du cache, avant sa date d'expiration réelle
- [ ] **B.** Il est considéré comme à rafraîchir alors qu'il est encore frais, donc non expiré
- [ ] **C.** Il est dupliqué dans tous les pools de la chaîne
- [ ] **D.** Son TTL est automatiquement doublé

### Question 67

Par défaut, comment les items de cache expirés sont-ils recalculés ? *(une seule bonne réponse)*

- [ ] **A.** De façon asynchrone, via un worker en tâche de fond
- [ ] **B.** De façon synchrone, dans la requête qui déclenche le miss ou l'expiration
- [ ] **C.** Ils ne sont jamais recalculés automatiquement
- [ ] **D.** Uniquement via une commande cron dédiée

### Question 68

Quel composant permet de déléguer le calcul de la valeur à un worker en arrière-plan ? *(une seule bonne réponse)*

- [ ] **A.** Le composant Scheduler
- [ ] **B.** Le composant Messenger
- [ ] **C.** Le composant Workflow
- [ ] **D.** Le composant Lock

### Question 69

Que se passe-t-il quand un item éligible à l'early-expiration est interrogé, dans le mode asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** La requête bloque jusqu'à ce que la nouvelle valeur soit calculée
- [ ] **B.** La valeur en cache est immédiatement retournée telle quelle, et un `EarlyExpirationMessage` est dispatché via un bus Messenger pour recalculer la valeur en tâche de fond
- [ ] **C.** Une exception est levée, forçant l'appelant à réessayer plus tard
- [ ] **D.** La valeur est supprimée du cache en attendant le recalcul

### Question 70

Une fois le `EarlyExpirationMessage` traité par un consumer, que se passe-t-il à la prochaine interrogation de l'item ? *(une seule bonne réponse)*

- [ ] **A.** Rien ne change, la valeur reste identique indéfiniment
- [ ] **B.** La valeur rafraîchie, calculée de façon asynchrone, est désormais retournée
- [ ] **C.** L'item est automatiquement supprimé du cache
- [ ] **D.** Un nouveau `EarlyExpirationMessage` est systématiquement redispatché

### Question 71

Quelle interface le service chargé de calculer la valeur du cache doit-il implémenter pour ce mécanisme asynchrone, et quelle est sa signature ? *(une seule bonne réponse)*

- [ ] **A.** `CallableInterface`, avec une méthode `compute()`
- [ ] **B.** `CallbackInterface`, via une méthode `__invoke(CacheItemInterface $item, bool &$save)`
- [ ] **C.** `CacheComputerInterface`, avec une méthode `handle()`
- [ ] **D.** Aucune interface n'est requise, une simple closure suffit toujours

### Question 72

Comment configure-t-on un pool pour qu'il utilise ce mécanisme de calcul asynchrone ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `async: true` sur le pool
- [ ] **B.** Avec l'option `early_expiration_message_bus`, pointant vers un bus Messenger
- [ ] **C.** En taguant le pool `cache.async`
- [ ] **D.** Ce n'est configurable qu'au niveau global de l'application, pas par pool

### Question 73

Que faut-il aussi configurer côté Messenger pour que ce mécanisme fonctionne ? *(une seule bonne réponse)*

- [ ] **A.** Router la classe `EarlyExpirationMessage` vers un transport, par exemple `async_bus`
- [ ] **B.** Rien, le routage est automatique dès qu'un pool asynchrone existe
- [ ] **C.** Un handler dédié explicitement enregistré, sans routing nécessaire
- [ ] **D.** Une commande `messenger:setup-cache` à exécuter une fois

### Question 74

Comment démarre-t-on le worker qui va effectivement recalculer les valeurs de cache en tâche de fond ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console cache:worker:start`
- [ ] **B.** `php bin/console messenger:consume async_bus`
- [ ] **C.** Il démarre automatiquement avec FrankenPHP en mode worker
- [ ] **D.** `php bin/console cache:pool:warmup --async`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Cache de la documentation Symfony 8.0](https://symfony.com/doc/8.0/cache.html).

**Question 1 : B** — « The callable will only be executed on a cache miss. » *(introduction)*

**Question 2 : A** — `$item->expiresAfter(3600);` dans l'exemple de base, avant de calculer et retourner la valeur. *(introduction)*

**Question 3 : C** — « // ... and to remove the cache key `$pool->delete('my_cache_key');` » *(introduction)*

**Question 4 : B** — « Symfony supports Cache Contracts and PSR-6/16 interfaces. » *(introduction)*

**Question 5 : A** — « Using a cache is a great way of making your application run quicker. The Symfony cache component ships with many adapters to different storages. Every adapter is developed for high performance. » *(introduction)*

**Question 6 : B** — « You can read more about these at the component documentation (`/components/cache`). » *(introduction)*

**Question 7 : A** — « **Pool** This is a service that you will interact with. Each pool will always have its own namespace and cache items. There are never conflicts between pools. » *(§ Configuring Cache with FrameworkBundle)*

**Question 8 : B** — « **Adapter** An adapter is a *template* that you use to create pools. » *(§ Configuring Cache with FrameworkBundle)*

**Question 9 : C** — « **Provider** A provider is a service that some adapters use to connect to the storage. Redis and Memcached are examples of such adapters. If a DSN is used as the provider then a service is automatically created. » *(§ Configuring Cache with FrameworkBundle)*

**Question 10 : A, B, C** — Liste des neuf adapters pré-configurés : `cache.adapter.apcu`, `cache.adapter.array`, `cache.adapter.doctrine_dbal`, `cache.adapter.filesystem`, `cache.adapter.memcached`, `cache.adapter.pdo`, `cache.adapter.psr6`, `cache.adapter.redis`, `cache.adapter.redis_tag_aware`. `cache.adapter.mongodb` (D) n'existe pas dans cette liste. *(§ Configuring Cache with FrameworkBundle)*

**Question 11 : A** — « There's also a special `cache.adapter.system` adapter. It's recommended to use it for the system cache. This adapter uses some logic to dynamically select the best possible storage based on your system (either PHP files or APCu). » *(§ Configuring Cache with FrameworkBundle)*

**Question 12 : C** — « `directory: '%kernel.cache_dir%/pools'` # Only used with cache.adapter.filesystem ». *(§ Configuring Cache with FrameworkBundle)*

**Question 13 : B** — « Some of these adapters could be configured via shortcuts » : `default_doctrine_dbal_provider`, `default_psr6_provider`, `default_redis_provider`, `default_memcached_provider`, `default_pdo_provider`. *(§ Configuring Cache with FrameworkBundle)*

**Question 14 : B** — « `cache.adapter.redis_tag_aware` (Redis adapter optimized to work with tags) ». *(§ Configuring Cache with FrameworkBundle)*

**Question 15 : B** — « Two cache pools are always enabled by default: `cache.system` and `cache.app`. » *(§ System Cache and Application Cache)*

**Question 16 : B** — « `cache.system` is used **internally** by Symfony components such as annotations, the serializer, and validation. » *(§ System Cache and Application Cache)*

**Question 17 : A, B** — « It is also **available for application** code, but only under specific constraints: 1. Entries must be derivable from source code and regeneratable during cache warmup via a `CacheWarmer`. 2. Cached content must only change when the source code changes (i.e. on deployment, not at runtime); treat it as read-only after deployment. » *(§ System Cache and Application Cache)*

**Question 18 : B** — « By default, `cache.system` uses `cache.adapter.system`, which writes to the filesystem and chains APCu when available. […] it's recommended to keep the default configuration applied to it by Symfony. » *(§ System Cache and Application Cache)*

**Question 19 : B** — « `cache.app` is a **general-purpose data cache** for application and bundle code. Data in this pool does not need to be flushed on deployment. » *(§ System Cache and Application Cache)*

**Question 20 : A** — « It defaults to `cache.adapter.filesystem`, but configuring a faster adapter like Redis is recommended when available (this ensures cached data survives deployments and is shared across multiple instances in a multi-server setup). » *(§ System Cache and Application Cache)*

**Question 21 : B** — « Custom pools default to `cache.app` as their adapter unless configured otherwise. » *(§ System Cache and Application Cache)*

**Question 22 : B** — « When using **autowiring**, `cache.app` is injected automatically into any service argument typed as `CacheItemPoolInterface`, `AdapterInterface`, or `CacheInterface`. » *(§ System Cache and Application Cache)*

**Question 23 : B** — « You can configure the adapter used by each predefined pool via the `app` and `system` keys. » *(§ System Cache and Application Cache)*

**Question 24 : A** — Exemple : `framework: cache: pools: my_cache_pool: adapter: cache.adapter.filesystem`. *(§ Creating Custom (Namespaced) Pools)*

**Question 25 : B** — « An autowiring alias is also created for each pool using the camel case version of its name - e.g. `custom_thing.cache` can be injected automatically by naming the argument `$customThingCache` and type-hinting it with either `CacheInterface` or `Psr\Cache\CacheItemPoolInterface`. » *(§ Creating Custom (Namespaced) Pools)*

**Question 26 : B** — « Each pool manages a set of independent cache keys: keys from different pools *never* collide, even if they share the same backend. This is achieved by prefixing keys with a namespace that's generated by hashing the name of the pool, the name of the cache adapter class and a configurable seed that defaults to the project directory and compiled container class. » *(§ Creating Custom (Namespaced) Pools)*

**Question 27 : B** — « If you need the namespace to be interoperable with a third-party app, you can take control over auto-generation by setting the `namespace` attribute of the `cache.pool` service tag. » *(§ Creating Custom (Namespaced) Pools)*

**Question 28 : A** — Exemple : `short_cache: adapter: foobar.cache default_lifetime: 60` — « uses the "foobar.cache" pool as its backend but controls the lifetime and (like all pools) has a separate cache namespace ». *(§ Creating Custom (Namespaced) Pools)*

**Question 29 : A** — « # control adapter's configuration `foobar.cache: adapter: cache.adapter.memcached provider: 'memcached://user:password@example.com'` ». *(§ Creating Custom (Namespaced) Pools)*

**Question 30 : A** — Exemples de la doc : injection via constructeur de service ou argument de méthode de contrôleur, en typant `CacheInterface $customThingCache`. *(§ Creating Custom (Namespaced) Pools)*

**Question 31 : A** — « The RedisAdapter allows you to create providers with the options `timeout`, `retry_interval`. etc. To use these options with non-default values you need to create your own `\Redis` provider and use that when configuring the pool. » *(§ Custom Provider Options)*

**Question 32 : B** — « `factory: ['Symfony\Component\Cache\Adapter\RedisAdapter', 'createConnection'] arguments: - 'redis://localhost' - { retry_interval: 2, timeout: 10 }` » *(§ Custom Provider Options)*

**Question 33 : A** — « `cache.my_redis: adapter: cache.adapter.redis provider: app.my_custom_redis_provider` » *(§ Custom Provider Options)*

**Question 34 : A** — « Different cache adapters have different strengths and weaknesses. Some might be really quick but optimized to store small items and some may be able to contain a lot of data but are quite slow. To get the best of both worlds you may use a chain of adapters. » *(§ Creating a Cache Chain)*

**Question 35 : B** — « When storing an item in a cache chain, Symfony stores it in all pools sequentially. » *(§ Creating a Cache Chain)*

**Question 36 : B** — « When retrieving an item, Symfony tries to get it from the first pool. If it's not found, it tries the next pools until the item is found or an exception is thrown. » *(§ Creating a Cache Chain)*

**Question 37 : B** — « Because of this behavior, it's recommended to define the adapters in the chain in order from fastest to slowest. » *(§ Creating a Cache Chain)*

**Question 38 : B** — « If an error happens when storing an item in a pool, Symfony stores it in the other pools and no exception is thrown. Later, when the item is retrieved, Symfony stores the item automatically in all the missing pools. » *(§ Creating a Cache Chain)*

**Question 39 : A** — Exemple : `my_cache_pool: default_lifetime: 31536000 adapters: - cache.adapter.array - cache.adapter.apcu - {name: cache.adapter.redis, provider: '…'}`. *(§ Creating a Cache Chain)*

**Question 40 : A** — Commentaire dans l'exemple : `default_lifetime: 31536000  # One year`. *(§ Creating a Cache Chain)*

**Question 41 : B** — « In applications with many cache keys it could be useful to organize the data stored to be able to invalidate the cache more efficiently. One way to achieve that is to use cache tags. […] All items with the same tag could be invalidated with one function call. » *(§ Using Cache Tags)*

**Question 42 : B** — « The cache adapter needs to implement `TagAwareCacheInterface` to enable this feature. » *(§ Using Cache Tags)*

**Question 43 : A** — « `$item->tag(['foo', 'bar']);` … `$item->tag('foo');` » dans le callback passé à `get()`. *(§ Using Cache Tags)*

**Question 44 : B** — « // Remove all cache keys tagged with "bar" `$this->myCachePool->invalidateTags(['bar']);` » *(§ Using Cache Tags)*

**Question 45 : B** — « `my_cache_pool: adapter: cache.adapter.redis_tag_aware tags: true` » — l'option `tags: true` active la fonctionnalité sur n'importe quel adapter. *(§ Using Cache Tags)*

**Question 46 : B** — « Tags are stored in the same pool by default. […] sometimes it might be better to store the tags in a different pool. That could be achieved by specifying the adapter » : `my_cache_pool: adapter: cache.adapter.redis tags: tag_pool`. *(§ Using Cache Tags)*

**Question 47 : B** — « The interface `TagAwareCacheInterface` is autowired to the `cache.app` service. » *(§ Using Cache Tags)*

**Question 48 : B** — Voir aussi Question 14 : `cache.adapter.redis_tag_aware` (Redis adapter optimized to work with tags), utilisable directement comme `adapter` sans besoin de `tags: true`. *(§ Using Cache Tags)*

**Question 49 : B** — « use Symfony\Contracts\Cache\TagAwareCacheInterface; … public function __construct(private TagAwareCacheInterface $myCachePool) » *(§ Using Cache Tags)*

**Question 50 : A** — « To clear the cache you can use the `bin/console cache:pool:clear [pool]` command. That will remove all the entries from your storage and you will have to recalculate all the values. » *(§ Clearing the Cache)*

**Question 51 : B** — « There are 3 cache clearers by default: `cache.global_clearer`, `cache.system_clearer`, `cache.app_clearer`. » *(§ Clearing the Cache)*

**Question 52 : A** — « The global clearer clears all the cache items in every pool. The system cache clearer is used in the `bin/console cache:clear` command. » *(§ Clearing the Cache)*

**Question 53 : C** — « The app clearer is the default clearer. » *(§ Clearing the Cache)*

**Question 54 : A** — « To see all available cache pools: `$ php bin/console cache:pool:list` » *(§ Clearing the Cache)*

**Question 55 : A** — « Clear all cache pools except some: `$ php bin/console cache:pool:clear --all --exclude=my_cache_pool --exclude=another_cache_pool` » *(§ Clearing the Cache)*

**Question 56 : B** — « Clear all caches everywhere: `$ php bin/console cache:pool:clear cache.global_clearer` » *(§ Clearing the Cache)*

**Question 57 : A** — « # invalidate tag1 & tag2 from all taggable pools `$ php bin/console cache:pool:invalidate-tags tag1 tag2` » *(§ Clearing the Cache)*

**Question 58 : B** — « # invalidate tag1 & tag2 from cache.app pool `$ php bin/console cache:pool:invalidate-tags tag1 tag2 --pool=cache.app` … `-p cache1 -p cache2` » *(§ Clearing the Cache)*

**Question 59 : B** — « To encrypt the cache using `libsodium`, you can use the `Symfony\Component\Cache\Marshaller\SodiumMarshaller`. » *(§ Encrypting the Cache)*

**Question 60 : A** — « you need to generate a secure key and add it to your secret store as `CACHE_DECRYPTION_KEY`: `$ php -r 'echo base64_encode(sodium_crypto_box_keypair());'` » *(§ Encrypting the Cache)*

**Question 61 : A** — « `Symfony\Component\Cache\Marshaller\SodiumMarshaller: decorates: cache.default_marshaller arguments: - ['%env(base64:CACHE_DECRYPTION_KEY)%'] - '@.inner'` » *(§ Encrypting the Cache)*

**Question 62 : B** — « When configuring multiple keys, the first key will be used for reading and writing, and the additional key(s) will only be used for reading. » *(§ Encrypting the Cache)*

**Question 63 : B** — « Once all cache items encrypted with the old key have expired, you can completely remove `OLD_CACHE_DECRYPTION_KEY`. » *(§ Encrypting the Cache)*

**Question 64 : A** — « This will encrypt the values of the cache items, but not the cache keys. Be careful not to leak sensitive data in the keys. » *(§ Encrypting the Cache)*

**Question 65 : B** — « The Cache component uses the probabilistic early expiration algorithm to protect against the cache stampede problem. » *(§ Computing Cache Values Asynchronously)*

**Question 66 : B** — « This means that some cache items are elected for early-expiration while they are still fresh. » *(§ Computing Cache Values Asynchronously)*

**Question 67 : B** — « By default, expired cache items are computed synchronously. » *(§ Computing Cache Values Asynchronously)*

**Question 68 : B** — « However, you can compute them asynchronously by delegating the value computation to a background worker using the Messenger component. » *(§ Computing Cache Values Asynchronously)*

**Question 69 : B** — « In this case, when an item is queried, its cached value is immediately returned and a `EarlyExpirationMessage` is dispatched through a Messenger bus. » *(§ Computing Cache Values Asynchronously)*

**Question 70 : B** — « When this message is handled by a message consumer, the refreshed cache value is computed asynchronously. The next time the item is queried, the refreshed value will be fresh and returned. » *(§ Computing Cache Values Asynchronously)*

**Question 71 : B** — « class CacheComputation implements CallbackInterface { public function __invoke(CacheItemInterface $item, bool &$save): string { … } } » *(§ Computing Cache Values Asynchronously)*

**Question 72 : B** — « `async.cache: early_expiration_message_bus: messenger.default_bus` » *(§ Computing Cache Values Asynchronously)*

**Question 73 : A** — « `messenger: transports: async_bus: '%env(MESSENGER_TRANSPORT_DSN)%' routing: 'Symfony\Component\Cache\Messenger\EarlyExpirationMessage': async_bus` » *(§ Computing Cache Values Asynchronously)*

**Question 74 : B** — « You can now start the consumer: `$ php bin/console messenger:consume async_bus` » *(§ Computing Cache Values Asynchronously)*
