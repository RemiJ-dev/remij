# QCM — Le cache HTTP

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/http_cache.html](https://symfony.com/doc/8.0/http_cache.html) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/http_cache.html#learn-more) · **Généré le :** 24 juillet 2026
>
> **123 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Caching with a Gateway Cache

### Question 1

Que fait le cache HTTP en pratique ? *(une seule bonne réponse)*

- [ ] **A.** Il met en cache uniquement les requêtes SQL exécutées par l'application
- [ ] **B.** Il précompile les templates Twig
- [ ] **C.** Il compresse le code source PHP
- [ ] **D.** Il met en cache la sortie complète d'une page (la réponse) et contourne entièrement l'application aux requêtes suivantes

### Question 2

Sur quelle spécification le système de cache de Symfony s'appuie-t-il ? *(une seule bonne réponse)*

- [ ] **A.** La spécification GraphQL
- [ ] **B.** Le protocole Memcached
- [ ] **C.** RFC 7234 - Caching, le standard HTTP
- [ ] **D.** Une spécification propriétaire à Symfony

### Question 3

Que permet Edge Side Includes (ESI), que ne permet pas un cache HTTP classique de page entière ? *(une seule bonne réponse)*

- [ ] **A.** Mettre en cache les requêtes POST par défaut
- [ ] **B.** Ignorer complètement le protocole HTTP
- [ ] **C.** Remplacer entièrement le besoin d'un reverse proxy
- [ ] **D.** Utiliser la puissance du cache HTTP sur uniquement des fragments d'une page

### Question 4

Dans le modèle du gateway cache, quel rôle joue le cache ? *(une seule bonne réponse)*

- [ ] **A.** Il remplace la base de données
- [ ] **B.** Il ne fait que journaliser les requêtes sans jamais les intercepter
- [ ] **C.** Il se place entre le client et l'application, comme un intermédiaire (« middle-man ») des requêtes/réponses
- [ ] **D.** Il fait partie intégrante du code de l'application

### Question 5

Comment appelle-t-on également ce type de cache HTTP gateway ? *(plusieurs bonnes réponses)*

- [ ] **A.** Reverse proxy cache
- [ ] **B.** Surrogate cache
- [ ] **C.** Cache applicatif
- [ ] **D.** HTTP accelerator

## Symfony Reverse Proxy

### Question 6

Quelle option active le reverse proxy Symfony pour l'environnement prod ? *(une seule bonne réponse)*

- [ ] **A.** `framework.proxy.enabled: true`
- [ ] **B.** `framework.http_cache: true`
- [ ] **C.** `framework.reverse_proxy: true`
- [ ] **D.** `framework.cache.gateway: true`

### Question 7

Le reverse proxy Symfony est-il un remplacement complet d'un cache comme Varnish ? *(une seule bonne réponse)*

- [ ] **A.** Oui, car il est écrit en C comme Varnish
- [ ] **B.** Non, ce n'est pas un cache aussi complet que Varnish, mais c'est un bon point de départ
- [ ] **C.** Oui, il est strictement équivalent et plus rapide
- [ ] **D.** Non, il ne fait rien du tout sans configuration Varnish

### Question 8

En mode debug, quel en-tête Symfony ajoute-t-il automatiquement aux réponses ? *(une seule bonne réponse)*

- [ ] **A.** `X-Symfony-Trace`
- [ ] **B.** `X-Cache-Status`
- [ ] **C.** `X-Symfony-Cache`
- [ ] **D.** `X-Debug-Cache`

### Question 9

Quelles valeurs peut prendre l'option `trace_level` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `none`
- [ ] **B.** `short`
- [ ] **C.** `full`
- [ ] **D.** `verbose`

### Question 10

Quelle option permet de changer le nom de l'en-tête utilisé pour les informations de trace ? *(une seule bonne réponse)*

- [ ] **A.** `header_trace`
- [ ] **B.** `trace_header`
- [ ] **C.** `trace_name`
- [ ] **D.** `cache_header_name`

### Question 11

Pourquoi peut-on vouloir remplacer le reverse proxy Symfony par Varnish ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est jamais recommandé, le reverse proxy Symfony suffit toujours en production
- [ ] **B.** Parce qu'étant écrit en PHP, il ne peut pas être aussi rapide qu'un proxy écrit en C
- [ ] **C.** Parce que le reverse proxy Symfony ne supporte pas du tout le Cache-Control
- [ ] **D.** Parce que Varnish est gratuit alors que le reverse proxy Symfony est payant

## Making your Responses HTTP Cacheable

### Question 12

Quels en-têtes de réponse HTTP permettent d'activer le cache ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Cache-Control`
- [ ] **B.** `Expires`
- [ ] **C.** `ETag`
- [ ] **D.** `Content-Type`

### Question 13

Quels sont les deux modèles utilisés pour mettre en cache les réponses via ces en-têtes ? *(plusieurs bonnes réponses)*

- [ ] **A.** Le modèle d'expiration (Expiration Caching)
- [ ] **B.** Le modèle de validation (Validation Caching)
- [ ] **C.** Le modèle de compression
- [ ] **D.** Le modèle de purge automatique

### Question 14

Quelle est la principale limite du modèle d'expiration par rapport au modèle de validation ? *(une seule bonne réponse)*

- [ ] **A.** Il nécessite obligatoirement Varnish
- [ ] **B.** L'invalidation du cache est plus difficile
- [ ] **C.** Il est beaucoup plus lent à mettre en place
- [ ] **D.** Il ne fonctionne qu'avec HTTPS

## Expiration Caching

### Question 15

Quel attribut PHP permet de configurer le cache directement sur une action de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `#[Cacheable(ttl: 3600)]`
- [ ] **B.** `#[HttpCache(3600)]`
- [ ] **C.** `#[ResponseCache(maxAge: 3600)]`
- [ ] **D.** `#[Cache(public: true, maxage: 3600, mustRevalidate: true)]`

### Question 16

Quelles méthodes de `Response` permettent d'obtenir un résultat équivalent à l'attribut `#[Cache]` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$response->setPublic()`
- [ ] **B.** `$response->setMaxAge(3600)`
- [ ] **C.** `$response->headers->addCacheControlDirective('must-revalidate', true)`
- [ ] **D.** `$response->setImmutable(3600)`

### Question 17

Si les deux sont utilisés, lequel prend le pas entre les en-têtes définis dans le contrôleur et l'attribut `#[Cache]` ? *(une seule bonne réponse)*

- [ ] **A.** Les deux sont fusionnés sans priorité définie
- [ ] **B.** Les en-têtes définis dans le contrôleur prennent le dessus sur ceux de l'attribut `#[Cache]`
- [ ] **C.** L'attribut `#[Cache]` a toujours la priorité
- [ ] **D.** Une exception est levée en cas de conflit

### Question 18

Qu'utilise le reverse proxy comme clé de cache par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Le contenu complet du corps de la requête
- [ ] **B.** L'URI de la requête
- [ ] **C.** L'adresse IP du client
- [ ] **D.** Le user-agent du navigateur

### Question 19

L'invalidation du cache est-elle supportée nativement par le modèle d'expiration ? *(une seule bonne réponse)*

- [ ] **A.** Oui, automatiquement dès qu'une entité change en base
- [ ] **B.** Oui, via un simple appel à `$response->invalidate()`
- [ ] **C.** Non, l'expiration n'existe pas dans Symfony
- [ ] **D.** Non, ce n'est pas supporté ; il faut attendre l'expiration du cache pour voir le contenu mis à jour

### Question 20

Quel bundle tiers est recommandé pour définir des en-têtes de cache pour de nombreuses actions différentes ? *(une seule bonne réponse)*

- [ ] **A.** LiipCacheControlBundle
- [ ] **B.** FOSHttpCacheBundle
- [ ] **C.** SncRedisBundle
- [ ] **D.** DoctrineCacheBundle

## Validation Caching

### Question 21

Quand faut-il privilégier le modèle de validation plutôt que le modèle d'expiration ? *(une seule bonne réponse)*

- [ ] **A.** Quand on utilise exclusivement des requêtes POST
- [ ] **B.** Quand on a besoin de voir le contenu mis à jour immédiatement après un changement
- [ ] **C.** Quand on ne veut jamais invalider le cache
- [ ] **D.** Quand l'application ne gère aucune session

## Safe Methods: Only caching GET or HEAD requests

### Question 22

Pour quelles méthodes HTTP le cache HTTP fonctionne-t-il (« safe methods ») ? *(plusieurs bonnes réponses)*

- [ ] **A.** GET
- [ ] **B.** HEAD
- [ ] **C.** PUT
- [ ] **D.** DELETE

### Question 23

Pourquoi ne faut-il jamais changer l'état de l'application en réponse à une requête GET ou HEAD ? *(une seule bonne réponse)*

- [ ] **A.** Parce que PHP l'interdit techniquement au niveau du langage
- [ ] **B.** Parce que GET et HEAD ne peuvent pas transporter de paramètres
- [ ] **C.** Parce que cela ralentirait le serveur de façon significative
- [ ] **D.** Parce que si ces requêtes sont mises en cache, les requêtes futures pourraient ne jamais atteindre le serveur

### Question 24

Les requêtes POST peuvent-elles être mises en cache ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, le protocole HTTP l'interdit formellement
- [ ] **B.** Oui, systématiquement et sans configuration particulière
- [ ] **C.** Uniquement si Varnish est utilisé comme reverse proxy
- [ ] **D.** Techniquement oui avec des informations de fraîcheur explicites, mais ce n'est pas largement implémenté et à éviter

## More Response Methods

### Question 25

Que fait la méthode `$response->expire()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle prolonge automatiquement la durée de vie du cache
- [ ] **B.** Elle marque la réponse comme périmée (stale)
- [ ] **C.** Elle supprime définitivement la réponse
- [ ] **D.** Elle force un code 500

### Question 26

Que fait `$response->setNotModified()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle empêche toute modification future de la réponse
- [ ] **B.** Elle désactive le cache pour cette réponse
- [ ] **C.** Elle recalcule automatiquement l'ETag
- [ ] **D.** Elle force la réponse à retourner un code 304 propre, sans contenu

### Question 27

Quelle méthode unique permet de définir plusieurs réglages de cache en un seul appel ? *(une seule bonne réponse)*

- [ ] **A.** `Response::setCacheOptions()`
- [ ] **B.** `Response::configureCache()`
- [ ] **C.** `Response::applyCacheHeaders()`
- [ ] **D.** `Response::setCache()`

## Cache Invalidation

### Question 28

L'invalidation du cache fait-elle partie de la spécification HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est une exigence stricte du RFC 7234
- [ ] **B.** Oui, mais uniquement pour les réponses privées
- [ ] **C.** Non, et cette fonctionnalité n'existe donc pas du tout dans Symfony
- [ ] **D.** Non, ce n'est pas partie de la spécification HTTP, mais cela peut être utile

## HTTP Caching and User Sessions

### Question 29

Que fait Symfony par défaut dès qu'une session est démarrée pendant une requête ? *(une seule bonne réponse)*

- [ ] **A.** Il supprime automatiquement le cookie de session
- [ ] **B.** Il transforme la réponse en réponse privée et non-cacheable
- [ ] **C.** Il force la réponse à devenir publique et cacheable
- [ ] **D.** Il ignore la session pour le calcul du cache

### Question 30

Quel en-tête interne permet de désactiver ce comportement par défaut (rendre une réponse avec session quand même cacheable) ? *(une seule bonne réponse)*

- [ ] **A.** `Response::FORCE_CACHEABLE_HEADER`
- [ ] **B.** `HttpCache::IGNORE_SESSION_HEADER`
- [ ] **C.** `AbstractSessionListener::NO_AUTO_CACHE_CONTROL_HEADER`
- [ ] **D.** `SessionListener::DISABLE_CACHE_HEADER`

### Question 31

Quel bundle tiers peut aider à gérer des scénarios de cache avancés impliquant des sessions (ex : cache par groupe d'utilisateurs) ? *(une seule bonne réponse)*

- [ ] **A.** NelmioApiDocBundle
- [ ] **B.** SncRedisBundle
- [ ] **C.** FOSHttpCacheBundle
- [ ] **D.** KnpPaginatorBundle

## Cache Invalidation (annexe)

### Question 32

Que se passe-t-il une fois qu'une URL est mise en cache par un gateway cache ? *(une seule bonne réponse)*

- [ ] **A.** Le cache redirige systématiquement vers l'application pour validation
- [ ] **B.** Le cache ne redemande plus ce contenu à l'application
- [ ] **C.** L'application est systématiquement interrogée à chaque requête, en parallèle du cache
- [ ] **D.** Le contenu est automatiquement invalidé après 60 secondes

### Question 33

Quelle citation célèbre est mentionnée en introduction de cette page à propos de l'invalidation de cache ? *(une seule bonne réponse)*

- [ ] **A.** « Cache invalidation is trivial once you understand HTTP. »
- [ ] **B.** « Premature optimization is the root of all evil. »
- [ ] **C.** « There are only two hard things: distributed systems and cache invalidation. »
- [ ] **D.** « There are only two hard things in Computer Science: cache invalidation and naming things. »

### Question 34

Que recommande la documentation de faire plutôt que d'invalider explicitement le cache, quand c'est possible ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver complètement le cache HTTP
- [ ] **B.** Ne jamais utiliser de reverse proxy
- [ ] **C.** Utiliser des durées de cache courtes ou le modèle de validation
- [ ] **D.** Toujours invalider explicitement, c'est la meilleure pratique

### Question 35

Quel bundle tiers fournit des services pour aider avec les différents concepts d'invalidation de cache ? *(une seule bonne réponse)*

- [ ] **A.** LiipImagineBundle
- [ ] **B.** KnpMenuBundle
- [ ] **C.** SncRedisBundle
- [ ] **D.** FOSHttpCacheBundle

### Question 36

Quel modèle fonctionne bien quand un contenu correspond à une seule URL ? *(une seule bonne réponse)*

- [ ] **A.** Le modèle REFRESH
- [ ] **B.** Le modèle PURGE
- [ ] **C.** Le modèle BAN
- [ ] **D.** Le modèle TAG

### Question 37

Comment fonctionne le modèle PURGE ? *(une seule bonne réponse)*

- [ ] **A.** On modifie directement les fichiers de cache sur disque
- [ ] **B.** On envoie une requête avec la méthode HTTP PURGE au lieu de GET, et le proxy retire la donnée du cache
- [ ] **C.** On envoie un header spécial `Cache-Purge: true` en GET
- [ ] **D.** On redémarre le serveur de cache entièrement

### Question 38

Pour configurer le reverse proxy Symfony afin qu'il supporte PURGE, quelle méthode de `HttpCache` doit-on surcharger ? *(une seule bonne réponse)*

- [ ] **A.** `handle()`
- [ ] **B.** `fetch()`
- [ ] **C.** `invalidate()`
- [ ] **D.** `purge()`

### Question 39

Comment enregistre-t-on la classe `CacheKernel` personnalisée pour qu'elle prenne effet ? *(une seule bonne réponse)*

- [ ] **A.** En la déclarant comme listener d'événement `kernel.request`
- [ ] **B.** Il n'y a rien à faire, elle est détectée automatiquement par convention de nom
- [ ] **C.** En la déclarant comme service qui décore `http_cache`
- [ ] **D.** En l'ajoutant au fichier `.env`

### Question 40

Quelle précaution de sécurité est explicitement mentionnée pour la méthode PURGE ? *(une seule bonne réponse)*

- [ ] **A.** Elle nécessite un token CSRF
- [ ] **B.** Elle doit être limitée à une seule requête par seconde
- [ ] **C.** Il faut la protéger pour éviter que n'importe qui puisse purger le cache
- [ ] **D.** Elle doit toujours être appelée en HTTPS uniquement

### Question 41

Que fait le « Purge » par rapport aux différents variants d'une ressource (liés à l'en-tête `Vary`) ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne que si aucun en-tête `Vary` n'est défini
- [ ] **B.** Il supprime uniquement la variante demandée dans la requête PURGE
- [ ] **C.** Il instruit le cache de supprimer la ressource dans toutes ses variantes
- [ ] **D.** Il ne supprime que la variante par défaut, jamais les autres

### Question 42

Qu'est-ce que le « Refreshing », par opposition au « Purging » ? *(une seule bonne réponse)*

- [ ] **A.** C'est une technique qui ne s'applique qu'aux ESI
- [ ] **B.** Le proxy de cache est instruit de jeter son cache local et de récupérer à nouveau le contenu (mais les variants ne sont pas invalidés)
- [ ] **C.** C'est un synonyme exact de purge, sans différence
- [ ] **D.** C'est une purge qui s'applique uniquement aux variantes, jamais au contenu principal

### Question 43

Qu'est-ce que le « Banning » comme technique d'invalidation plus flexible ? *(une seule bonne réponse)*

- [ ] **A.** Interdire l'utilisation du cache HTTP pour un utilisateur donné
- [ ] **B.** Bloquer certains user-agents connus pour du scraping
- [ ] **C.** Invalider les réponses correspondant à des expressions régulières sur l'URL ou d'autres critères
- [ ] **D.** Bannir une adresse IP spécifique de tout accès au site

### Question 44

Qu'est-ce que le « Cache tagging » ? *(une seule bonne réponse)*

- [ ] **A.** Un mécanisme de versionning des assets statiques
- [ ] **B.** Ajouter un tag à chaque contenu utilisé dans une réponse, pour invalider toutes les URLs contenant ce contenu
- [ ] **C.** Ajouter des métadonnées SEO à chaque page mise en cache
- [ ] **D.** Une technique de nommage des clés de cache dans Redis

## Varying the Response for HTTP Cache (annexe)

### Question 45

Par défaut, qu'utilise le cache HTTP comme clé de cache pour une ressource ? *(une seule bonne réponse)*

- [ ] **A.** L'URI et tous les en-têtes de la requête
- [ ] **B.** Uniquement la méthode HTTP
- [ ] **C.** Le corps de la requête
- [ ] **D.** L'URI de la ressource uniquement

### Question 46

Pourquoi peut-on avoir besoin de mettre en cache plusieurs versions d'une même URI ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le cache HTTP ne fonctionne jamais avec une seule version
- [ ] **B.** Parce que chaque méthode HTTP nécessite une clé de cache distincte
- [ ] **C.** Par exemple, si le contenu est compressé différemment selon le support du client (`Accept-Encoding`)
- [ ] **D.** Parce que chaque utilisateur doit toujours avoir sa propre version unique

### Question 47

Quel en-tête de réponse permet de faire varier le cache selon la valeur d'autres en-têtes de requête ? *(une seule bonne réponse)*

- [ ] **A.** `Cache-Control`
- [ ] **B.** `Content-Variation`
- [ ] **C.** `X-Cache-Key`
- [ ] **D.** `Vary`

### Question 48

Que signifie l'en-tête `Vary: Accept-Encoding, User-Agent` ? *(une seule bonne réponse)*

- [ ] **A.** Cela désactive le cache pour tous les navigateurs listés
- [ ] **B.** Différentes versions de chaque ressource seront mises en cache selon la valeur des en-têtes `Accept-Encoding` et `User-Agent`
- [ ] **C.** Le cache ignore complètement `Accept-Encoding` et `User-Agent`
- [ ] **D.** Seul le premier en-tête listé est pris en compte

### Question 49

Comment définir l'en-tête `Vary` via l'attribut `#[Cache]` ? *(une seule bonne réponse)*

- [ ] **A.** `#[Cache(varyBy: 'Accept-Encoding')]`
- [ ] **B.** `#[Vary(['Accept-Encoding'])]`
- [ ] **C.** `#[Cache(headers: ['Accept-Encoding'])]`
- [ ] **D.** `#[Cache(vary: ['Accept-Encoding'])]`

### Question 50

Quelle méthode de `Response` permet de définir l'en-tête `Vary` directement ? *(une seule bonne réponse)*

- [ ] **A.** `$response->addVaryHeader('Accept-Encoding')`
- [ ] **B.** `$response->vary('Accept-Encoding')`
- [ ] **C.** `$response->headers->setVary('Accept-Encoding')`
- [ ] **D.** `$response->setVary('Accept-Encoding')`

## Working with Edge Side Includes (annexe)

### Question 51

Quelle est la principale limitation des gateway caches que résout ESI ? *(une seule bonne réponse)*

- [ ] **A.** Ils nécessitent obligatoirement Varnish
- [ ] **B.** Ils ne peuvent mettre en cache que des pages entières, pas des parties dynamiques
- [ ] **C.** Ils ne supportent pas HTTPS
- [ ] **D.** Ils ne peuvent pas mettre en cache plus d'une page à la fois

### Question 52

Qui a écrit la spécification ESI, et en quelle année ? *(une seule bonne réponse)*

- [ ] **A.** W3C, en 1999
- [ ] **B.** Akamai, en 2001
- [ ] **C.** Google, en 2005
- [ ] **D.** Varnish Software, en 2010

### Question 53

Quel tag ESI Symfony implémente-t-il (le seul utile en dehors du contexte Akamai) ? *(une seule bonne réponse)*

- [ ] **A.** `<esi:comment>`
- [ ] **B.** `<esi:include>`
- [ ] **C.** `<esi:vars>`
- [ ] **D.** `<esi:choose>`

### Question 54

Que doit obligatoirement contenir un tag ESI include ? *(une seule bonne réponse)*

- [ ] **A.** Un simple nom de fragment sans URL
- [ ] **B.** Un identifiant numérique de contrôleur
- [ ] **C.** Un chemin relatif uniquement
- [ ] **D.** Une URL complète et qualifiée (fully-qualified)

### Question 55

Comment le gateway cache traite-t-il les tags ESI présents dans une réponse ? *(une seule bonne réponse)*

- [ ] **A.** Il renvoie une erreur 500 si un tag ESI est présent
- [ ] **B.** Il transmet les tags ESI tels quels au navigateur, qui les résout côté client
- [ ] **C.** Il récupère chaque fragment inclus depuis son cache ou le redemande à l'application, puis fusionne le tout avant d'envoyer au client
- [ ] **D.** Il ignore systématiquement les tags ESI qu'il ne reconnaît pas

### Question 56

Quelle option de configuration active ESI dans une application Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `framework.http_cache.esi: true`
- [ ] **B.** `framework.esi: true`
- [ ] **C.** `framework.fragments.esi: true`
- [ ] **D.** `framework.cache.esi: true`

### Question 57

Quelle fonction Twig permet de générer un tag ESI pour une action incluse ? *(une seule bonne réponse)*

- [ ] **A.** `esi_include()`
- [ ] **B.** `render_fragment('esi')`
- [ ] **C.** `embed_esi()`
- [ ] **D.** `render_esi()`

### Question 58

Pourquoi utiliser le helper `render_esi()` plutôt qu'écrire soi-même le tag ESI ? *(une seule bonne réponse)*

- [ ] **A.** C'est strictement identique, aucune différence
- [ ] **B.** Le helper est plus rapide à l'exécution
- [ ] **C.** Le tag ESI manuel n'est pas supporté par Twig
- [ ] **D.** Cela fait fonctionner l'application même en l'absence de gateway cache installé

### Question 59

Que deviennent les variables passées via `render_esi` (ex : `maxPerPage`) ? *(plusieurs bonnes réponses)*

- [ ] **A.** Elles sont disponibles comme argument du contrôleur
- [ ] **B.** Elles font partie de la clé de cache
- [ ] **C.** Elles sont automatiquement traduites
- [ ] **D.** Elles sont ignorées si un gateway cache est présent

### Question 60

Comment Symfony détermine-t-il si le gateway cache en face supporte ESI ? *(une seule bonne réponse)*

- [ ] **A.** En vérifiant la version de Varnish installée
- [ ] **B.** En testant une requête OPTIONS préalable
- [ ] **C.** Cela ne peut jamais être détecté automatiquement, il faut le configurer manuellement
- [ ] **D.** Si la requête contient l'en-tête `Surrogate-Capability` avec la valeur `ESI/1.0`

### Question 61

Que se passe-t-il si `render_esi()` est utilisé mais qu'aucun gateway cache supportant ESI n'est détecté ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée
- [ ] **B.** Le fragment n'est simplement pas affiché
- [ ] **C.** La page entière devient non cacheable
- [ ] **D.** Symfony fusionne simplement le contenu inclus dans la page principale, comme avec `render()`

### Question 62

Quel attribut permet de définir un `s-maxage` spécifique pour l'action embarquée en ESI ? *(une seule bonne réponse)*

- [ ] **A.** `#[EsiCache(maxage: 60)]`
- [ ] **B.** `#[Cache(sharedMaxAge: 60)]`
- [ ] **C.** `#[Cache(smaxage: 60)]`
- [ ] **D.** `#[Cache(esiMaxAge: 60)]`

### Question 63

Quel service Symfony est responsable de router les références de contrôleur générées pour les fragments ESI vers une URL accessible ? *(une seule bonne réponse)*

- [ ] **A.** `FragmentRouter`
- [ ] **B.** `FragmentListener`
- [ ] **C.** `EsiListener`
- [ ] **D.** `ControllerResolver`

### Question 64

Quelle option de configuration active le `FragmentListener` avec un chemin donné ? *(une seule bonne réponse)*

- [ ] **A.** `framework.routing.fragments: /_fragment`
- [ ] **B.** `framework.fragment_listener.enabled: true`
- [ ] **C.** `framework.fragments: { path: /_fragment }`
- [ ] **D.** `framework.esi.fragment_path: /_fragment`

### Question 65

Le fragment listener répond-il à n'importe quelle requête vers son chemin ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement en environnement de production
- [ ] **B.** Non, il ne répond jamais, c'est juste un point d'entrée théorique
- [ ] **C.** Non, il ne répond qu'aux requêtes signées, générées via le fragment renderer et `render_esi`
- [ ] **D.** Oui, à toute requête GET vers ce chemin

### Question 66

À quoi sert l'option `alt` du helper `render_esi` ? *(une seule bonne réponse)*

- [ ] **A.** À définir un timeout alternatif
- [ ] **B.** À spécifier une URL alternative à utiliser si le `src` ne peut pas être trouvé
- [ ] **C.** À définir un texte alternatif pour l'accessibilité
- [ ] **D.** À indiquer la locale alternative à utiliser

### Question 67

Que fait l'option `ignore_errors` du helper `render_esi` si elle vaut `true` ? *(une seule bonne réponse)*

- [ ] **A.** Le fragment est systématiquement mis en cache, même en cas d'erreur HTTP
- [ ] **B.** Les logs d'erreur sont désactivés pour ce fragment
- [ ] **C.** Un attribut `onerror="continue"` est ajouté, indiquant que le gateway cache retire silencieusement le tag ESI en cas d'échec
- [ ] **D.** Toutes les erreurs PHP sont masquées globalement

### Question 68

Quelle est la valeur par défaut de l'option `absolute_uri` du helper `render_esi` ? *(une seule bonne réponse)*

- [ ] **A.** Elle dépend de l'environnement (dev vs prod)
- [ ] **B.** Elle n'a pas de valeur par défaut, elle est obligatoire
- [ ] **C.** `false`
- [ ] **D.** `true`

### Question 69

Dans l'exemple documenté (page principale 600s, ticker `s-maxage` 60s), combien de temps chaque composant reste-t-il en cache ? *(une seule bonne réponse)*

- [ ] **A.** 60 secondes pour les deux
- [ ] **B.** La page complète n'est jamais mise en cache dans cet exemple
- [ ] **C.** 60 secondes pour le ticker, 600 secondes pour la page complète
- [ ] **D.** 600 secondes pour les deux

### Question 70

Que se passe-t-il par défaut avec `render()` (renderer `inline`), à la différence de `render_esi()` ? *(une seule bonne réponse)*

- [ ] **A.** `inline` n'existe pas comme renderer, seul `esi` existe
- [ ] **B.** Cela ne s'applique qu'aux fragments SSI, jamais ESI
- [ ] **C.** Symfony fusionne alors le contenu inclus dans la page principale avant l'envoi au client
- [ ] **D.** Cela ne fonctionne que si ESI n'est pas installé sur le serveur, jamais autrement

## HTTP Cache Expiration (annexe)

### Question 71

Pourquoi le modèle d'expiration est-il qualifié de plus efficace et direct des deux modèles de cache ? *(une seule bonne réponse)*

- [ ] **A.** Parce qu'il ne nécessite aucun en-tête HTTP
- [ ] **B.** Parce qu'il est plus rapide à configurer que le modèle de validation, mais moins performant à l'exécution
- [ ] **C.** Parce qu'il fonctionne uniquement avec Varnish
- [ ] **D.** Parce que le cache retourne directement la réponse sans jamais toucher l'application tant qu'elle n'expire pas

### Question 72

Quels sont les deux en-têtes HTTP quasi identiques utilisables pour le modèle d'expiration ? *(plusieurs bonnes réponses)*

- [ ] **A.** `Expires`
- [ ] **B.** `Cache-Control`
- [ ] **C.** `ETag`
- [ ] **D.** `Last-Modified`

### Question 73

Quel attribut PHP permet de définir `Cache-Control: public, max-age=600` ? *(une seule bonne réponse)*

- [ ] **A.** `#[Cache(expires: 600)]`
- [ ] **B.** `#[Cache(public: true, maxage: 600)]`
- [ ] **C.** `#[Cache(sharedMaxAge: 600)]`
- [ ] **D.** `#[CacheControl(public: true, age: 600)]`

### Question 74

`setSharedMaxAge()` est-il équivalent à appeler à la fois `setPublic()` et `setMaxAge()` ? *(une seule bonne réponse)*

- [ ] **A.** Oui, mais uniquement pour les réponses privées
- [ ] **B.** Non, le réglage `s-maxage` interdit au cache d'utiliser une réponse périmée dans les scénarios `stale-if-error`, contrairement à `public`+`max-age`
- [ ] **C.** Oui, c'est strictement équivalent selon la RFC 7234
- [ ] **D.** Non, `setSharedMaxAge()` est en réalité déprécié et ne doit jamais être utilisé

### Question 75

Quel est l'en-tête alternatif à `Cache-Control` pour l'expiration ? *(une seule bonne réponse)*

- [ ] **A.** `Age`
- [ ] **B.** `Retry-After`
- [ ] **C.** `X-Expires-After`
- [ ] **D.** `Expires`

### Question 76

Comment définir l'en-tête `Expires` via l'attribut `#[Cache]` ? *(une seule bonne réponse)*

- [ ] **A.** `#[Cache(expiresIn: 600)]`
- [ ] **B.** `#[Expires('+600 seconds')]`
- [ ] **C.** `#[Cache(ttl: '+600 seconds')]`
- [ ] **D.** `#[Cache(expires: '+600 seconds')]`

### Question 77

Dans quel fuseau horaire l'en-tête `Expires` est-il automatiquement converti par l'option `expires` ou `setExpires()` ? *(une seule bonne réponse)*

- [ ] **A.** UTC+1
- [ ] **B.** Le fuseau horaire du serveur, sans conversion
- [ ] **C.** Le fuseau horaire du client déduit de sa locale
- [ ] **D.** GMT

### Question 78

Que dit la spécification à propos de la durée maximale que peut indiquer l'en-tête `Expires` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a aucune limite mentionnée par la spécification
- [ ] **B.** La limite est de 10 ans, comme pour les certificats SSL
- [ ] **C.** Les serveurs HTTP/1.1 ne devraient pas envoyer de dates `Expires` à plus d'un an dans le futur
- [ ] **D.** La durée maximale est strictement de 24 heures

### Question 79

Pourquoi l'en-tête `Expires` est-il vulnérable au « clock skew » dans les versions HTTP antérieures à 1.1 ? *(une seule bonne réponse)*

- [ ] **A.** Parce que les fuseaux horaires n'existaient pas encore dans le protocole
- [ ] **B.** Parce que les caches ne supportaient pas les dates avant HTTP/1.1
- [ ] **C.** Le serveur d'origine n'était pas obligé d'envoyer l'en-tête `Date`, donc le cache pouvait devoir se fier à son horloge locale
- [ ] **D.** Parce qu'`Expires` n'existait pas avant HTTP/1.1

### Question 80

Que se passe-t-il si à la fois `Cache-Control` (`max-age`/`s-maxage`) et `Expires` sont présents ? *(une seule bonne réponse)*

- [ ] **A.** La valeur de `max-age`/`s-maxage` est ignorée au profit d'`Expires`
- [ ] **B.** Une exception est levée, les deux ne peuvent coexister
- [ ] **C.** Les deux valeurs sont additionnées
- [ ] **D.** La valeur de l'en-tête `Expires` est ignorée

## Working with Server Side Includes (annexe)

### Question 81

Quelle est la principale différence entre SSI et ESI ? *(une seule bonne réponse)*

- [ ] **A.** SSI ne fonctionne qu'avec Varnish, ESI qu'avec Symfony
- [ ] **B.** SSI est plus récent qu'ESI
- [ ] **C.** SSI ne peut pas inclure de fragments dynamiques
- [ ] **D.** SSI est directement connu par la plupart des serveurs web (Apache, Nginx), contrairement à ESI

### Question 82

Sous quelle forme les instructions SSI sont-elles exprimées dans le HTML ? *(une seule bonne réponse)*

- [ ] **A.** Des attributs `data-*` sur les balises HTML
- [ ] **B.** Des directives PHP embarquées
- [ ] **C.** Des commentaires HTML
- [ ] **D.** Des balises XML personnalisées

### Question 83

Quelle directive SSI Symfony gère-t-il (parmi celles disponibles) ? *(une seule bonne réponse)*

- [ ] **A.** `#exec`
- [ ] **B.** `#flastmod`
- [ ] **C.** `#include virtual`
- [ ] **D.** `#config`

### Question 84

À quel risque de sécurité l'utilisation de SSI expose-t-elle potentiellement le site ? *(une seule bonne réponse)*

- [ ] **A.** Au vol de cookies de session
- [ ] **B.** Aux injections SSI (SSI injection)
- [ ] **C.** Aux injections SQL
- [ ] **D.** Aux attaques XXE

### Question 85

Quelle option de configuration active SSI dans une application Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `framework.server_side_includes: true`
- [ ] **B.** `framework.ssi: { enabled: true }`
- [ ] **C.** `framework.esi.ssi: true`
- [ ] **D.** `framework.cache.ssi: true`

### Question 86

Quelle fonction Twig permet de générer une instruction SSI pour une action incluse ? *(une seule bonne réponse)*

- [ ] **A.** `embed_ssi()`
- [ ] **B.** `render_ssi()`
- [ ] **C.** `ssi_include()`
- [ ] **D.** `render_fragment('ssi')`

### Question 87

Dans la configuration SSI côté serveur, quel type de chemin est-il courant d'utiliser plutôt que des URLs absolues ? *(une seule bonne réponse)*

- [ ] **A.** Des chemins encodés en base64
- [ ] **B.** Des URLs raccourcies via un service tiers
- [ ] **C.** Des chemins relatifs
- [ ] **D.** Des URLs signées avec un token

### Question 88

À quelle condition `render_ssi` génère-t-il effectivement une directive SSI (plutôt que d'embarquer directement la sous-réponse) ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en environnement de production
- [ ] **B.** Jamais automatiquement, il faut le forcer explicitement
- [ ] **C.** Si la requête a l'en-tête `Surrogate-Capability` avec `device="SSI/1.0"`
- [ ] **D.** Toujours, quel que soit le serveur

### Question 89

Dans l'exemple documenté (page de profil), quelle partie reste privée et laquelle devient publique avec expiration ? *(une seule bonne réponse)*

- [ ] **A.** La page de profil devient publique, le bloc GDPR reste privé
- [ ] **B.** Les deux deviennent publiques avec la même expiration
- [ ] **C.** Les deux restent privées, SSI ne change rien à la visibilité
- [ ] **D.** La page de profil reste privée, le bloc GDPR devient public avec 10 minutes d'expiration

### Question 90

Quel avertissement la documentation formule-t-elle concernant SSI ? *(une seule bonne réponse)*

- [ ] **A.** SSI est déprécié depuis Symfony 6.0
- [ ] **B.** SSI ne doit jamais être combiné avec ESI
- [ ] **C.** SSI nécessite une licence commerciale
- [ ] **D.** Il faut lire l'article OWASP sur les injections SSI avant de l'utiliser

### Question 91

Où trouver plus d'informations sur les fragments de cache Symfony en général (ESI et SSI) ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe aucune documentation complémentaire
- [ ] **B.** Dans la documentation du composant HttpClient
- [ ] **C.** Dans la documentation ESI, qui couvre le concept général de fragments
- [ ] **D.** Uniquement dans le code source du FrameworkBundle

## HTTP Cache Validation (annexe)

### Question 92

Pourquoi le modèle d'expiration est-il insuffisant quand une ressource doit être mise à jour dès qu'un changement est fait ? *(une seule bonne réponse)*

- [ ] **A.** Parce que le modèle d'expiration ne fonctionne qu'avec les requêtes POST
- [ ] **B.** L'application ne sera pas interrogée pour retourner la réponse à jour tant que le cache n'est pas devenu périmé
- [ ] **C.** Parce que le modèle d'expiration ne gère pas les en-têtes HTTP
- [ ] **D.** Parce qu'il nécessite toujours Varnish

### Question 93

Sous le modèle de validation, que fait le cache à chaque requête ? *(une seule bonne réponse)*

- [ ] **A.** Il ignore l'application et retourne toujours la version en cache
- [ ] **B.** Il compare uniquement le user-agent du client
- [ ] **C.** Il demande à l'application si la réponse mise en cache est toujours valide
- [ ] **D.** Il redemande systématiquement le contenu complet, sans jamais utiliser le cache

### Question 94

Que doit retourner l'application si la réponse en cache est toujours valide, sous le modèle de validation ? *(une seule bonne réponse)*

- [ ] **A.** Un code 412
- [ ] **B.** Un code 304 sans contenu
- [ ] **C.** Un code 200 avec le contenu complet
- [ ] **D.** Un code 204 avec un en-tête personnalisé

### Question 95

Sous quelle condition économise-t-on réellement du CPU avec le modèle de validation ? *(une seule bonne réponse)*

- [ ] **A.** Jamais, ce modèle ne fait économiser que de la bande passante
- [ ] **B.** Si déterminer la validité de la réponse en cache prend moins de travail que de régénérer toute la page
- [ ] **C.** Toujours, quelle que soit l'implémentation
- [ ] **D.** Uniquement si `ETag` est utilisé, jamais avec `Last-Modified`

### Question 96

Que signifie le code de statut 304 ? *(une seule bonne réponse)*

- [ ] **A.** Temporary Redirect
- [ ] **B.** Not Modified — la réponse ne contient pas le contenu demandé, seulement des en-têtes indiquant que le cache peut utiliser sa version stockée
- [ ] **C.** Moved Permanently
- [ ] **D.** No Content, la ressource a été supprimée

### Question 97

Quels sont les deux en-têtes HTTP utilisables pour implémenter le modèle de validation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `ETag`
- [ ] **B.** `Last-Modified`
- [ ] **C.** `Cache-Control`
- [ ] **D.** `Expires`

### Question 98

Qu'est-ce qu'un `ETag` (« entity-tag ») ? *(une seule bonne réponse)*

- [ ] **A.** Un identifiant unique généré par le serveur web, jamais par l'application
- [ ] **B.** Un hash automatiquement calculé par Varnish
- [ ] **C.** Un cookie de session spécifique au cache
- [ ] **D.** Une chaîne arbitraire générée par l'application qui identifie de façon unique une représentation d'une ressource

### Question 99

Comment l'exemple documenté génère-t-il un `ETag` simple ? *(une seule bonne réponse)*

- [ ] **A.** En utilisant un UUID aléatoire à chaque requête
- [ ] **B.** En hashant l'URL de la requête en SHA-256
- [ ] **C.** En utilisant le timestamp de la dernière modification
- [ ] **D.** En calculant le `md5` du contenu de la réponse

### Question 100

Que compare la méthode `Response::isNotModified()` pour `ETag` ? *(une seule bonne réponse)*

- [ ] **A.** Le corps complet de la requête et de la réponse
- [ ] **B.** Uniquement les cookies de session
- [ ] **C.** L'en-tête `If-None-Match` de la requête avec l'en-tête `ETag` de la réponse
- [ ] **D.** L'en-tête `If-Modified-Since` avec `Last-Modified`

### Question 101

Quel problème posent `mod_deflate` ou `mod_brotli` d'Apache 2.4 avec les ETags ? *(une seule bonne réponse)*

- [ ] **A.** Ils ignorent totalement les réponses avec un `ETag`
- [ ] **B.** Ils modifient la valeur de l'`ETag` original (ex : ajout de `-gzip` ou `-br`), cassant la validation basée sur l'`ETag`
- [ ] **C.** Ils suppriment complètement l'en-tête `ETag`
- [ ] **D.** Ils dupliquent l'en-tête `ETag`, provoquant une erreur HTTP

### Question 102

Comment générer un `ETag` « faible » (weak ETag) avec Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas supporté par Symfony
- [ ] **B.** En utilisant une méthode dédiée `setWeakEtag()`
- [ ] **C.** En passant `true` comme second argument de `setEtag()`
- [ ] **D.** En préfixant manuellement la chaîne avec `W/`

### Question 103

Que représente l'en-tête `Last-Modified` selon la spécification HTTP ? *(une seule bonne réponse)*

- [ ] **A.** La date d'expiration du cache
- [ ] **B.** La date de la dernière requête reçue pour cette ressource
- [ ] **C.** La date et l'heure auxquelles le serveur d'origine estime que la représentation a été modifiée pour la dernière fois
- [ ] **D.** La date de création initiale de la ressource, jamais modifiée ensuite

### Question 104

Que compare `Response::isNotModified()` pour `Last-Modified` ? *(une seule bonne réponse)*

- [ ] **A.** L'en-tête `If-None-Match` avec `ETag`
- [ ] **B.** Le `Content-Length` de la requête et de la réponse
- [ ] **C.** La date système du serveur avec celle du client
- [ ] **D.** L'en-tête `If-Modified-Since` de la requête avec l'en-tête `Last-Modified` de la réponse

### Question 105

Quel est l'objectif principal de l'optimisation du code avec la validation ? *(une seule bonne réponse)*

- [ ] **A.** Toujours calculer l'`ETag` après avoir généré la réponse complète
- [ ] **B.** Ne jamais utiliser `Last-Modified`, uniquement `ETag`
- [ ] **C.** Désactiver complètement la validation pour les pages coûteuses à générer
- [ ] **D.** Calculer l'`ETag`/`Last-Modified` avec le minimum d'information possible, avant de faire le travail coûteux de génération du reste de la réponse

### Question 106

Que fait `isNotModified()` automatiquement quand la réponse n'est pas modifiée ? *(une seule bonne réponse)*

- [ ] **A.** Elle relance automatiquement `isNotModified()` en boucle
- [ ] **B.** Elle met le code de statut à 304, retire le contenu, et retire certains en-têtes interdits pour les réponses 304
- [ ] **C.** Elle supprime uniquement le contenu, en conservant tous les en-têtes
- [ ] **D.** Elle redirige automatiquement vers une page d'erreur

## How to Use Varnish to Speed up my Website (annexe)

### Question 107

Pourquoi peut-on remplacer le reverse proxy Symfony par Varnish sans problème ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Varnish utilise un format de cache propriétaire compatible uniquement avec Symfony
- [ ] **B.** Ce n'est en réalité pas recommandé par la documentation
- [ ] **C.** Parce que le cache Symfony utilise les en-têtes HTTP standard, compatibles avec n'importe quel reverse proxy
- [ ] **D.** Parce que Varnish est développé par l'équipe Symfony

### Question 108

Que fait Varnish automatiquement avec l'adresse IP du client ? *(une seule bonne réponse)*

- [ ] **A.** Il la chiffre avant transmission
- [ ] **B.** Il la supprime complètement de la requête
- [ ] **C.** Il la transmet via l'en-tête `X-Forwarded-For`
- [ ] **D.** Il la remplace systématiquement par `127.0.0.1`

### Question 109

Que faut-il appeler dans le front controller pour que Symfony fasse confiance à Varnish comme proxy ? *(une seule bonne réponse)*

- [ ] **A.** `HttpCache::enableProxyTrust()`
- [ ] **B.** `Kernel::setTrustedGateway()`
- [ ] **C.** `Request::setTrustedProxies()`
- [ ] **D.** `Request::trustVarnish()`

### Question 110

Pourquoi un en-tête `X-Forwarded-Port` est-il nécessaire pour que le Router Symfony génère les URLs correctement avec Varnish ? *(une seule bonne réponse)*

- [ ] **A.** Pour rediriger automatiquement vers le bon sous-domaine
- [ ] **B.** Pour que Symfony utilise le bon numéro de port lors de la génération d'URL
- [ ] **C.** Pour chiffrer les URLs générées
- [ ] **D.** Pour désactiver le cache sur certains ports

### Question 111

Pourquoi Varnish ne gère-t-il pas lui-même la terminaison HTTPS ? *(une seule bonne réponse)*

- [ ] **A.** Parce que HTTPS n'est pas supporté par le protocole VCL
- [ ] **B.** Varnish ne fait pas de HTTPS ; un autre proxy s'en charge et transmet en HTTP avec `X-Forwarded-Proto`
- [ ] **C.** Varnish supporte HTTPS nativement sans configuration
- [ ] **D.** Ce n'est pas vrai, Varnish gère HTTPS par défaut

### Question 112

Pourquoi la plupart des proxies de cache ne mettent-ils rien en cache par défaut quand une requête contient des cookies ou un en-tête d'authentification basique ? *(une seule bonne réponse)*

- [ ] **A.** Parce que cela viole la RFC 7234
- [ ] **B.** Parce que le contenu de la page est supposé dépendre de la valeur du cookie ou de l'en-tête d'authentification
- [ ] **C.** Parce que les cookies sont toujours invalides en HTTP/2
- [ ] **D.** Parce que Varnish interdit techniquement les cookies

### Question 113

Si le backend n'utilise jamais de sessions ni d'authentification basique, que peut faire Varnish pour éviter que les clients contournent le cache ? *(une seule bonne réponse)*

- [ ] **A.** Rediriger toutes les requêtes avec cookies vers l'application directement, sans jamais les mettre en cache
- [ ] **B.** Ignorer complètement la question, ce n'est pas un problème réel
- [ ] **C.** Retirer l'en-tête `Cookie` correspondant des requêtes
- [ ] **D.** Forcer tous les clients à désactiver les cookies dans leur navigateur

### Question 114

Quel nom porte typiquement le cookie de session PHP par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `SYMFONY_SESSION`
- [ ] **B.** `PHP_SESSION_ID`
- [ ] **C.** `SF_SESSID`
- [ ] **D.** `PHPSESSID`

### Question 115

Quel autre cookie lié à l'authentification est mentionné comme devant être préservé (pour « remember me ») ? *(une seule bonne réponse)*

- [ ] **A.** `SF_REMEMBER`
- [ ] **B.** `AUTH_PERSIST`
- [ ] **C.** `LOGIN_TOKEN`
- [ ] **D.** `REMEMBERME`

### Question 116

Que fait la configuration VCL documentée pour retirer les cookies non essentiels ? *(une seule bonne réponse)*

- [ ] **A.** Elle supprime tous les cookies sans exception
- [ ] **B.** Elle chiffre tous les cookies restants
- [ ] **C.** Elle transforme tous les cookies en en-têtes personnalisés
- [ ] **D.** Elle conserve uniquement les cookies `PHPSESSID` et `REMEMBERME`, retirant tous les autres

### Question 117

Comment gérer un cache différent selon le rôle d'un utilisateur plutôt que par utilisateur individuel ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec Varnish
- [ ] **B.** Il faut désactiver le cache pour tous les utilisateurs authentifiés
- [ ] **C.** Il faut utiliser exclusivement des sessions Redis partagées
- [ ] **D.** Le pattern « User Context » du FOSHttpCacheBundle permet de séparer le cache par groupe

### Question 118

Quel comportement des versions de Varnish antérieures à la version 4 posait problème pour la cohérence du cache ? *(une seule bonne réponse)*

- [ ] **A.** Elles mettaient en cache les requêtes POST par défaut
- [ ] **B.** Elles ne respectaient pas `Cache-Control: no-cache`, `no-store` et `private`
- [ ] **C.** Elles ignoraient systématiquement l'en-tête `Cache-Control` tout entier
- [ ] **D.** Elles ne supportaient pas du tout le HTTP/1.1

### Question 119

Quelle directive VCL Varnish 3 permet de corriger ce problème de cohérence ? *(une seule bonne réponse)*

- [ ] **A.** `unset beresp.http.Cache-Control` dans tous les cas
- [ ] **B.** `set req.backend = default;` sans autre condition
- [ ] **C.** `return (hit_for_pass)` dans `vcl_fetch`, quand `Cache-Control` contient `private`/`no-cache`/`no-store`
- [ ] **D.** `return (pipe)` dans `vcl_recv` systématiquement

### Question 120

Quel en-tête Symfony utilise-t-il, issu de l'Edge Architecture d'Akamai, pour détecter si le proxy supporte ESI ? *(une seule bonne réponse)*

- [ ] **A.** `Edge-Control`
- [ ] **B.** `Accept-Surrogate`
- [ ] **C.** `Surrogate-Capability`
- [ ] **D.** `X-ESI-Support`

### Question 121

Quels attributs des tags ESI Varnish supporte-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `onerror` et `alt`, jamais `src`
- [ ] **B.** Aucun, Varnish ne supporte pas du tout ESI nativement
- [ ] **C.** Uniquement l'attribut `src` (`onerror` et `alt` sont ignorés)
- [ ] **D.** Tous les attributs (`src`, `onerror`, `alt`) sans exception

### Question 122

Quelle configuration VCL permet à Varnish d'annoncer son support ESI au backend applicatif ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter un en-tête `X-Varnish-ESI` dans `vcl_deliver`
- [ ] **B.** Configurer `esi_support = true;` dans `varnish.conf`
- [ ] **C.** Aucune configuration n'est nécessaire, c'est automatique
- [ ] **D.** Ajouter un en-tête `Surrogate-Capability` dans `vcl_recv`

### Question 123

Comment Varnish optimise-t-il le traitement en ne parsant le contenu de la réponse que si un tag ESI existe ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, Varnish parse toujours l'intégralité de chaque réponse
- [ ] **B.** En vérifiant l'en-tête `Surrogate-Control` ajouté automatiquement par Symfony
- [ ] **C.** En analysant systématiquement tout le HTML avec une regex à chaque réponse
- [ ] **D.** En interrogeant une base de données de fragments connus

---

## Corrigé

**Question 1 : D** — « With HTTP Caching, you cache the full output of a page (i.e. the response) and bypass your application *entirely* on subsequent requests. » *(§ Caching on the Shoulders of Giants)*

**Question 2 : C** — « the Symfony cache system (…) relies on the simplicity and power of the HTTP cache as defined in RFC 7234 - Caching. » *(§ Caching on the Shoulders of Giants)*

**Question 3 : D** — « With Edge Side Includes (ESI), you can use the power of HTTP caching on only *fragments* of your site. » *(§ Caching on the Shoulders of Giants)*

**Question 4 : C** — « The cache is the "middle-man" of the request-response communication between the client and your application. » *(§ Caching with a Gateway Cache)*

**Question 5 : A, B, D** — « Gateway caches are sometimes referred to as reverse proxy caches, surrogate caches, or even HTTP accelerators. » *(§ Caching with a Gateway Cache)*

**Question 6 : B** — « Use the `framework.http_cache` option to enable the proxy for the prod environment: `http_cache: true`. » *(§ Symfony Reverse Proxy)*

**Question 7 : B** — « It's not a fully-featured reverse proxy cache like Varnish, but it is a great way to start. » *(§ Symfony Reverse Proxy)*

**Question 8 : C** — « When in debug mode, Symfony automatically adds an `X-Symfony-Cache` header to the response. » *(§ Symfony Reverse Proxy)*

**Question 9 : A, B, C** — « use the `trace_level` config option and set it to either `none`, `short` or `full`. » *(§ Symfony Reverse Proxy)*

**Question 10 : B** — « You can change the name of the header used for the trace information using the `trace_header` config option. » *(§ Symfony Reverse Proxy)*

**Question 11 : B** — « being written in PHP, it cannot be as fast as a proxy written in C. » *(§ Changing from one Reverse Proxy to another)*

**Question 12 : A, B, C** — « HTTP specifies four response cache headers that you can set to enable caching: Cache-Control, Expires, ETag, Last-Modified. » *(§ Making your Responses HTTP Cacheable)*

**Question 13 : A, B** — « These four headers are used to help cache your responses via *two* different models: Expiration Caching (…) Validation Caching. » *(§ Making your Responses HTTP Cacheable)*

**Question 14 : B** — « Used to cache your entire response for a specific amount of time (…) Simple, but cache invalidation is more difficult. » *(§ Making your Responses HTTP Cacheable)*

**Question 15 : D** — « `#[Cache(public: true, maxage: 3600, mustRevalidate: true)]` » *(§ Expiration Caching)*

**Question 16 : A, B, C** — « $response->setPublic(); $response->setMaxAge(3600); (…) $response->headers->addCacheControlDirective('must-revalidate', true); » *(§ Expiration Caching)*

**Question 17 : B** — « When both are used, the cache headers defined in the controller take precedence over those configured with the `#[Cache]` attribute. » *(§ Expiration Caching)*

**Question 18 : B** — « The URI of the request is used as the cache key (unless you vary). » *(§ Expiration Caching)*

**Question 19 : D** — « cache *invalidation* is not supported. If your content change, you'll need to wait until your cache expires for the page to update. » *(§ Expiration Caching)*

**Question 20 : B** — « If you need to set cache headers for many different controller actions, check out FOSHttpCacheBundle. » *(§ Expiration Caching)*

**Question 21 : B** — « If you need to see updated content *immediately*, you either need to invalidate your cache *or* use the validation caching model. » *(§ Validation Caching)*

**Question 22 : A, B** — « HTTP caching only works for "safe" HTTP methods (like GET and HEAD). » *(§ Safe Methods: Only caching GET or HEAD requests)*

**Question 23 : D** — « If those requests are cached, future requests may not actually hit your server. » *(§ Safe Methods: Only caching GET or HEAD requests)*

**Question 24 : D** — « POST requests are generally considered uncacheable, but they can be cached when they include explicit freshness information. However, POST caching is not widely implemented, so you should avoid it if possible. » *(§ Safe Methods: Only caching GET or HEAD requests)*

**Question 25 : B** — « // marks the Response stale `$response->expire();` » *(§ More Response Methods)*

**Question 26 : D** — « // forces the response to return a proper 304 response with no content `$response->setNotModified();` » *(§ More Response Methods)*

**Question 27 : D** — « most cache-related HTTP headers can be set via the single `Response::setCache` method. » *(§ More Response Methods)*

**Question 28 : D** — « Cache invalidation is *not* part of the HTTP specification. Still, it can be really useful (…) » *(§ Cache Invalidation)*

**Question 29 : B** — « Whenever the session is started during a request, Symfony turns the response into a private non-cacheable response. » *(§ HTTP Caching and User Sessions)*

**Question 30 : C** — « add the following internal header to your response and Symfony won't modify it: `AbstractSessionListener::NO_AUTO_CACHE_CONTROL_HEADER`. » *(§ HTTP Caching and User Sessions)*

**Question 31 : C** — « information related to some user group could be cached for all the users belonging to that group (…) they can be solved with the FOSHttpCacheBundle. » *(§ HTTP Caching and User Sessions)*

**Question 32 : B** — « Once a URL is cached by a gateway cache, the cache will not ask the application for that content anymore. » *(§ Cache Invalidation (annexe))*

**Question 33 : D** — « "There are only two hard things in Computer Science: cache invalidation and naming things." -- Phil Karlton » *(§ Cache Invalidation (annexe))*

**Question 34 : C** — « avoid it when possible (…) use short cache lifetimes or use the validation model. » *(§ Cache Invalidation (annexe))*

**Question 35 : D** — « have a look at the FOSHttpCacheBundle. This bundle provides services to help with various cache invalidation concepts. » *(§ Cache Invalidation (annexe))*

**Question 36 : B** — « If one content corresponds to one URL, the `PURGE` model works well. » *(§ Cache Invalidation (annexe))*

**Question 37 : B** — « You send a request to the cache proxy with the HTTP method `PURGE` (…) instead of `GET` and make the cache proxy detect this and remove the data from the cache. » *(§ Cache Invalidation (annexe))*

**Question 38 : C** — « First create a caching kernel that overrides the `HttpCache::invalidate` method. » *(§ Cache Invalidation (annexe))*

**Question 39 : C** — « register the class as a service that decorates `http_cache`. » *(§ Cache Invalidation (annexe))*

**Question 40 : C** — « You must protect the `PURGE` HTTP method somehow to avoid random people purging your cached data. » *(§ Cache Invalidation (annexe))*

**Question 41 : C** — « Purge instructs the cache to drop a resource in *all its variants* (according to the `Vary` header). » *(§ Cache Invalidation (annexe))*

**Question 42 : B** — « Refreshing means that the caching proxy is instructed to discard its local cache and fetch the content again (…) The drawback (…) is that variants are not invalidated. » *(§ Cache Invalidation (annexe))*

**Question 43 : C** — « Banning invalidates responses matching regular expressions on the URL or other criteria. » *(§ Cache Invalidation (annexe))*

**Question 44 : B** — « Cache tagging lets you add a tag for each content used in a response so that you can invalidate all URLs containing a certain content. » *(§ Cache Invalidation (annexe))*

**Question 45 : D** — « By default, HTTP caching is done by using the URI of the resource as the cache key. » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 46 : C** — « if you compress pages when the client supports it, any given URI has two representations (…) determination is done by the value of the `Accept-Encoding` request header. » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 47 : D** — « This is done by using the `Vary` response header. » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 48 : B** — « This particular `Vary` header would cache different versions of each resource based on the URI and the value of the `Accept-Encoding` and `User-Agent` request header. » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 49 : D** — « `#[Cache(vary: ['Accept-Encoding'])]` » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 50 : D** — « $response->setVary('Accept-Encoding'); » *(§ Varying the Response for HTTP Cache (annexe))*

**Question 51 : B** — « Gateway caches (…) have one limitation: they can only cache whole pages. If your pages contain dynamic sections (…) you are out of luck. » *(§ Working with Edge Side Includes (annexe))*

**Question 52 : B** — « Akamai wrote this specification in 2001. » *(§ Working with Edge Side Includes (annexe))*

**Question 53 : B** — « Only one tag is implemented in Symfony, `include`. » *(§ Working with Edge Side Includes (annexe))*

**Question 54 : D** — « Notice from the example that each ESI tag requires a fully-qualified URL. » *(§ Working with Edge Side Includes (annexe))*

**Question 55 : C** — « the gateway cache either retrieves the included page fragment from its cache or requests the page fragment from the backend application again. When all the ESI tags have been resolved, the gateway cache merges each into the main page. » *(§ Working with Edge Side Includes (annexe))*

**Question 56 : B** — « framework: esi: true » *(§ Using ESI in Symfony)*

**Question 57 : D** — « {{ render_esi(controller('App\\Controller\\NewsController::latest', { 'maxPerPage': 5 })) }} » *(§ Using ESI in Symfony)*

**Question 58 : D** — « using a helper makes your application work even if there is no gateway cache installed. » *(§ Using ESI in Symfony)*

**Question 59 : A, B** — « the `maxPerPage` variable you pass is available as an argument to your controller (…) The variables passed through `render_esi` also become part of the cache key. » *(§ Using ESI in Symfony)*

**Question 60 : D** — « Symfony considers that a gateway cache supports ESI if its request include the `Surrogate-Capability` HTTP header and the value of that header contains the `ESI/1.0` string. » *(§ Using ESI in Symfony)*

**Question 61 : D** — « if there is no gateway cache or if it does not support ESI, Symfony will just merge the included page content within the main one as it would have done if you had used `render()`. » *(§ Using ESI in Symfony)*

**Question 62 : C** — « `#[Cache(smaxage: 60)]` » *(§ Using ESI in Symfony)*

**Question 63 : B** — « Symfony takes care of generating a unique URL for any controller reference and it is able to route them properly thanks to the `FragmentListener`. » *(§ Using ESI in Symfony)*

**Question 64 : C** — « framework: fragments: { path: /_fragment } » *(§ Using ESI in Symfony)*

**Question 65 : C** — « The fragment listener only responds to signed requests. Requests are only signed when using the fragment renderer and the `render_esi` Twig function. » *(§ Using ESI in Symfony)*

**Question 66 : B** — « `alt`: Used as the `alt` attribute on the ESI tag, which allows you to specify an alternative URL to be used if the `src` cannot be found. » *(§ Using ESI in Symfony)*

**Question 67 : C** — « `ignore_errors`: If set to true, an `onerror` attribute will be added to the ESI with a value of `continue` indicating that (…) the gateway cache will remove the ESI tag silently. » *(§ Using ESI in Symfony)*

**Question 68 : C** — « `absolute_uri`: If set to true, an absolute URI will be generated. **default**: `false`. » *(§ Using ESI in Symfony)*

**Question 69 : C** — « with ESI the full page cache will be valid for 600 seconds, but the news component cache will only last for 60 seconds. » *(§ Using ESI in Symfony)*

**Question 70 : C** — « When using the default `render()` function (or setting the renderer to `inline`), Symfony merges the included page content into the main one before sending the response. » *(§ Using ESI in Symfony)*

**Question 71 : D** — « When a response is cached with an expiration, the cache returns it directly without hitting the application until the cached response expires. » *(§ HTTP Cache Expiration (annexe))*

**Question 72 : A, B** — « The expiration model can be accomplished using one of two, nearly identical, HTTP headers: `Expires` or `Cache-Control`. » *(§ HTTP Cache Expiration (annexe))*

**Question 73 : B** — « `#[Cache(public: true, maxage: 600)]` » *(§ Expiration with the Cache-Control Header)*

**Question 74 : B** — « the `s-maxage` setting (added by `setSharedMaxAge()` method) prohibits a cache to use a stale response in `stale-if-error` scenarios. That's why it's recommended to use both `public` and `max-age` directives. » *(§ Expiration with the Cache-Control Header)*

**Question 75 : D** — « An alternative to the `Cache-Control` header is `Expires`. » *(§ Expiration with the Expires Header)*

**Question 76 : D** — « `#[Cache(expires: '+600 seconds')]` » *(§ Expiration with the Expires Header)*

**Question 77 : D** — « The `expires` option and the `setExpires()` method automatically convert the date to the GMT timezone. » *(§ Expiration with the Expires Header)*

**Question 78 : C** — « "HTTP/1.1 servers should not send `Expires` dates more than one year in the future." » *(§ Expiration with the Expires Header)*

**Question 79 : C** — « the origin server wasn't required to send the `Date` header. Consequently, the cache (…) might need to rely on the local clock to evaluate the `Expires` header making the lifetime calculation vulnerable to clock skew. » *(§ Expiration with the Expires Header)*

**Question 80 : D** — « the `Expires` header value is ignored when the `s-maxage` or `max-age` directive of the `Cache-Control` header is defined. » *(§ Expiration with the Expires Header)*

**Question 81 : D** — « The most important difference is that SSI is known directly by most web servers like Apache, Nginx etc. » *(§ Working with Server Side Includes (annexe))*

**Question 82 : C** — « The SSI instructions are done via HTML comments. » *(§ Working with Server Side Includes (annexe))*

**Question 83 : C** — « There are some other available directives but Symfony manages only the `#include virtual` one. » *(§ Working with Server Side Includes (annexe))*

**Question 84 : B** — « Be careful with SSI, your website may fall victim to injections. » *(§ Working with Server Side Includes (annexe))*

**Question 85 : B** — « framework: ssi: { enabled: true } » *(§ Using SSI in Symfony)*

**Question 86 : B** — « {{ render_ssi(controller('App\\Controller\\ProfileController::gdpr')) }} » *(§ Using SSI in Symfony)*

**Question 87 : C** — « or a path (in server's SSI configuration is common to use relative paths instead of absolute URLs) » *(§ Using SSI in Symfony)*

**Question 88 : C** — « `render_ssi` ensures that SSI directive is generated only if the request has the header requirement like `Surrogate-Capability: device="SSI/1.0"`. » *(§ Using SSI in Symfony)*

**Question 89 : D** — « The profile index page has not public caching, but the GDPR block has 10 minutes of expiration. » *(§ Using SSI in Symfony)*

**Question 90 : D** — « Please read this OWASP article first! » *(§ Working with Server Side Includes (annexe))*

**Question 91 : C** — « For more information about Symfony cache fragments, take a tour on the ESI documentation. » *(§ Using SSI in Symfony)*

**Question 92 : B** — « With the expiration model, the application won't be asked to return the updated response until the cache finally becomes stale. » *(§ HTTP Cache Validation (annexe))*

**Question 93 : C** — « for each request, the cache asks the application if the cached response is still valid or if it needs to be regenerated. » *(§ HTTP Cache Validation (annexe))*

**Question 94 : B** — « If the cache *is* still valid, your application should return a 304 status code and no content. » *(§ HTTP Cache Validation (annexe))*

**Question 95 : B** — « you only save CPU if you're able to determine that the cached response is still valid by doing *less* work than generating the whole page again. » *(§ HTTP Cache Validation (annexe))*

**Question 96 : B** — « The 304 status code means "Not Modified" (…) the response does *not* contain the actual content being requested. » *(§ HTTP Cache Validation (annexe))*

**Question 97 : A, B** — « there are two different HTTP headers that can be used to implement the validation model: `ETag` and `Last-Modified`. » *(§ HTTP Cache Validation (annexe))*

**Question 98 : D** — « The HTTP ETag ("entity-tag") header is an optional HTTP header whose value is an arbitrary string that uniquely identifies one representation of the target resource. » *(§ Validation with the ETag Header)*

**Question 99 : D** — « generate the `ETag` as the `md5` of the content. » *(§ Validation with the ETag Header)*

**Question 100 : C** — « The `Response::isNotModified` method compares the `If-None-Match` header with the `ETag` response header. » *(§ Validation with the ETag Header)*

**Question 101 : B** — « When using `mod_deflate` or `mod_brotli` in Apache 2.4, the original `ETag` value is modified (e.g. if `ETag` was `foo`, Apache turns it into `foo-gzip` or `foo-br`), which breaks the `ETag`-based validation. » *(§ Validation with the ETag Header)*

**Question 102 : C** — « Symfony also supports weak `ETag`s by passing `true` as the second argument to the `Response::setEtag` method. » *(§ Validation with the ETag Header)*

**Question 103 : C** — « "The `Last-Modified` header field indicates the date and time at which the origin server believes the representation was last modified." » *(§ Validation with the Last-Modified Header)*

**Question 104 : D** — « The `Response::isNotModified` method compares the `If-Modified-Since` header with the `Last-Modified` response header. » *(§ Validation with the Last-Modified Header)*

**Question 105 : D** — « The less you do in your application to return a 304 response, the better. » *(§ Optimizing your Code with Validation)*

**Question 106 : B** — « When the `Response` is not modified, the `isNotModified()` automatically sets the response status code to `304`, removes the content, and removes some headers that must not be present for `304` responses. » *(§ Optimizing your Code with Validation)*

**Question 107 : C** — « Because Symfony's cache uses the standard HTTP cache headers, the symfony-gateway-cache can be replaced with any other reverse proxy. » *(§ How to Use Varnish to Speed up my Website (annexe))*

**Question 108 : C** — « Varnish automatically forwards the IP as `X-Forwarded-For`. » *(§ Make Symfony Trust the Reverse Proxy)*

**Question 109 : C** — « Remember to call the `Request::setTrustedProxies()` method in your front controller. » *(§ Make Symfony Trust the Reverse Proxy)*

**Question 110 : B** — « an `X-Forwarded-Port` header must be present for Symfony to use the correct port number. » *(§ Routing and X-FORWARDED Headers)*

**Question 111 : B** — « there could be another proxy (as Varnish does not do HTTPS itself) on the default HTTPS port 443 that handles the SSL termination and forwards the requests as HTTP requests to Varnish with an `X-Forwarded-Proto` header. » *(§ Routing and X-FORWARDED Headers)*

**Question 112 : B** — « most caching proxies do not cache anything when a request is sent with cookies or a basic authentication header. This is because the content of the page is supposed to depend on the cookie value or authentication header. » *(§ Cookies and Caching)*

**Question 113 : C** — « have Varnish remove the corresponding header from requests to prevent clients from bypassing the cache. » *(§ Cookies and Caching)*

**Question 114 : D** — « If you are using PHP with its default configuration, the session cookie is typically named `PHPSESSID`. » *(§ Cookies and Caching)*

**Question 115 : D** — « a `REMEMBERME` cookie for remember me functionality (…) these cookies should also be preserved. » *(§ Cookies and Caching)*

**Question 116 : D** — « set req.http.Cookie = regsuball(req.http.Cookie, ";(PHPSESSID|REMEMBERME)=", "; \1="); (…) // Remove all cookies except for essential ones. » *(§ Cookies and Caching)*

**Question 117 : D** — « a solution is to separate the cache per group. This pattern is implemented and explained by the FOSHttpCacheBundle under the name User Context. » *(§ Cookies and Caching)*

**Question 118 : B** — « versions prior to Varnish 4 did not respect `Cache-Control: no-cache`, `no-store` and `private`. » *(§ Ensure Consistent Caching Behavior)*

**Question 119 : C** — « if (beresp.http.Cache-Control ~ "private" || beresp.http.Cache-Control ~ "no-cache" || beresp.http.Cache-Control ~ "no-store") { return (hit_for_pass); } » *(§ Ensure Consistent Caching Behavior)*

**Question 120 : C** — « Symfony uses the `Surrogate-Capability` header from the Edge Architecture described by Akamai. » *(§ Enable Edge Side Includes (ESI))*

**Question 121 : C** — « Varnish only supports the `src` attribute for ESI tags (`onerror` and `alt` attributes are ignored). » *(§ Enable Edge Side Includes (ESI))*

**Question 122 : D** — « configure Varnish so that it advertises its ESI support by adding a `Surrogate-Capability` header to requests forwarded to the backend application (…) sub vcl_recv » *(§ Enable Edge Side Includes (ESI))*

**Question 123 : B** — « optimize Varnish so that it only parses the response contents when there is at least one ESI tag by checking the `Surrogate-Control` header that Symfony adds automatically. » *(§ Enable Edge Side Includes (ESI))*

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/http_cache.html#learn-more) de la page :

- [Cache Invalidation](https://symfony.com/doc/8.0/http_cache/cache_invalidation.html)
- [Varying the Response for HTTP Cache](https://symfony.com/doc/8.0/http_cache/cache_vary.html)
- [Working with Edge Side Includes](https://symfony.com/doc/8.0/http_cache/esi.html)
- [HTTP Cache Expiration](https://symfony.com/doc/8.0/http_cache/expiration.html)
- [Working with Server Side Includes](https://symfony.com/doc/8.0/http_cache/ssi.html)
- [HTTP Cache Validation](https://symfony.com/doc/8.0/http_cache/validation.html)
- [How to Use Varnish to Speed up my Website](https://symfony.com/doc/8.0/http_cache/varnish.html) — également référencée depuis `41-performance.md`, voir la remarque là-bas pour ne pas dupliquer les questions
