# QCM — WebLink (préchargement de ressources)

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/web_link.html](https://symfony.com/doc/8.0/web_link.html) · **Généré le :** 23 juillet 2026
>
> **31 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Vue d'ensemble de WebLink

### Question 1

Que permet le composant WebLink dans Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Compiler et minifier les assets CSS/JS
- [ ] **B.** Générer un sitemap XML automatiquement
- [ ] **C.** Gérer le cache HTTP via des en-têtes `ETag`
- [ ] **D.** Gérer nativement les en-têtes HTTP `Link`, utilisés pour les capacités de préchargement des navigateurs modernes

### Question 2

Quelles optimisations WebLink permet-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** Indiquer au navigateur de précharger des ressources nécessaires à la page courante
- [ ] **B.** Envoyer des réponses 103 Early Hints pour que le navigateur commence le téléchargement avant la réponse complète
- [ ] **C.** Effectuer des résolutions DNS, poignées de main TCP ou négociations TLS en avance
- [ ] **D.** Compresser automatiquement les réponses HTTP en gzip

### Question 3

Sur quel type de connexion certaines fonctionnalités de WebLink (comme Early Hints) fonctionnent-elles le mieux ? *(une seule bonne réponse)*

- [ ] **A.** Une connexion via un tunnel SSH
- [ ] **B.** Cela ne dépend jamais du protocole utilisé
- [ ] **C.** Une connexion HTTPS sécurisée
- [ ] **D.** Une connexion HTTP/1.0 uniquement

### Question 4

Que mentionne la documentation pour faciliter l'usage de HTTPS en local avec ces fonctionnalités ? *(une seule bonne réponse)*

- [ ] **A.** Une commande `bin/console weblink:setup-https`
- [ ] **B.** Rien, HTTPS n'est jamais nécessaire
- [ ] **C.** Le Docker installer and runtime for Symfony, créé par Kévin Dunglas
- [ ] **D.** Un certificat auto-signé fourni nativement par Symfony

## Installation

### Question 5

Quelle commande installe le composant WebLink dans une application Symfony Flex ? *(une seule bonne réponse)*

- [ ] **A.** `npm install @symfony/web-link`
- [ ] **B.** `composer require symfony/weblink-bundle`
- [ ] **C.** Il est installé par défaut avec `symfony/framework-bundle`
- [ ] **D.** `composer require symfony/web-link`

## Preloading Assets

### Question 6

Dans un workflow HTTP traditionnel, que se passe-t-il pour une page HTML qui référence un fichier CSS via une balise `<link>` ? *(une seule bonne réponse)*

- [ ] **A.** Le fichier CSS est systématiquement embarqué en ligne dans le HTML
- [ ] **B.** Le navigateur télécharge le CSS avant même de recevoir le HTML
- [ ] **C.** Le navigateur fait une requête pour le document HTML, puis une autre pour le fichier CSS lié
- [ ] **D.** Les deux fichiers sont envoyés dans une seule requête HTTP/1

### Question 7

Quelle fonction Twig fournie par WebLink permet de précharger une ressource ? *(une seule bonne réponse)*

- [ ] **A.** `link()`
- [ ] **B.** `asset_preload()`
- [ ] **C.** `preload()`
- [ ] **D.** `prefetch()`

### Question 8

Quel attribut est obligatoire lors de l'appel à `preload()`, utilisé par les navigateurs pour prioriser correctement les ressources et respecter la CSP ? *(une seule bonne réponse)*

- [ ] **A.** `crossorigin`
- [ ] **B.** `as`
- [ ] **C.** `type`
- [ ] **D.** `rel`

### Question 9

Qu'ajoute concrètement la fonction `preload()` à la réponse HTTP ? *(une seule bonne réponse)*

- [ ] **A.** Rien tant que le navigateur ne supporte pas HTTP/2
- [ ] **B.** Un en-tête `Link`, ex. `Link: </fonts/myfont.woff2>; rel="preload"; as="font"`
- [ ] **C.** Une balise `<meta>` supplémentaire dans le `<head>`
- [ ] **D.** Un cookie de session dédié au préchargement

### Question 10

Avec le composant AssetMapper (ex. `importmap('app')`), faut-il ajouter manuellement une balise `<link rel="preload">` ? *(une seule bonne réponse)*

- [ ] **A.** Non, mais uniquement en environnement de production
- [ ] **B.** Oui, sauf en utilisant Webpack Encore en parallèle
- [ ] **C.** Non, la fonction `importmap()` ajoute automatiquement l'en-tête `Link` si le composant WebLink est disponible
- [ ] **D.** Oui, c'est systématiquement nécessaire, AssetMapper ne gérant pas cela

### Question 11

À quoi sert l'attribut `importance` dans un appel à `preload()`, selon la spécification Priority Hints ? *(une seule bonne réponse)*

- [ ] **A.** À indiquer si la ressource doit être mise en cache
- [ ] **B.** À forcer un téléchargement synchrone bloquant le rendu
- [ ] **C.** À signaler la priorité de téléchargement de la ressource (ex. `importance: 'low'`)
- [ ] **D.** À définir le type MIME de la ressource

### Question 12

Comment le navigateur réagit-il en recevant l'en-tête `Link` généré par `preload()` ? *(une seule bonne réponse)*

- [ ] **A.** Il envoie une requête de vérification au serveur avant de télécharger
- [ ] **B.** Il stocke l'information pour la prochaine visite uniquement
- [ ] **C.** Il commence à télécharger la ressource immédiatement, avant même de rencontrer la balise correspondante dans le HTML
- [ ] **D.** Il ignore l'en-tête tant que le HTML n'est pas entièrement parsé

### Question 13

Quels services tiers la documentation cite-t-elle comme exploitant également les en-têtes `Link` pour optimiser la livraison de ressources ? *(une seule bonne réponse)*

- [ ] **A.** Aucun CDN ne supporte les en-têtes `Link`
- [ ] **B.** Uniquement les serveurs Apache et nginx
- [ ] **C.** Cloudflare, Fastly et Akamai
- [ ] **D.** AWS CloudFront et Google Cloud CDN uniquement

## Sending Early Hints

### Question 14

Par défaut, quand les en-têtes `Link` sont-ils envoyés au client ? *(une seule bonne réponse)*

- [ ] **A.** Jamais automatiquement, il faut toujours les envoyer manuellement
- [ ] **B.** Avec la réponse finale
- [ ] **C.** Toujours avant la réponse finale, via 103 Early Hints
- [ ] **D.** Uniquement lors d'un rechargement de page

### Question 15

Que faut-il pour que les Early Hints fonctionnent réellement ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier, cela fonctionne avec n'importe quel serveur PHP
- [ ] **B.** Il faut désactiver OPcache
- [ ] **C.** Le SAPI utilisé doit supporter cette fonctionnalité, comme FrankenPHP
- [ ] **D.** Il faut activer un module Apache spécifique, quel que soit le SAPI

### Question 16

Quelle méthode d'`AbstractController` permet d'envoyer explicitement des Early Hints depuis une action de contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** `addEarlyHints()`
- [ ] **B.** `dispatchLinks()`
- [ ] **C.** `sendEarlyHints()`
- [ ] **D.** `sendPreload()`

### Question 17

Que retourne la méthode `sendEarlyHints()`, et comment doit-on l'utiliser ensuite ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne une chaîne JSON représentant les en-têtes envoyés
- [ ] **B.** Elle retourne un objet `Response` qu'il faut réutiliser pour créer/envoyer la réponse complète (ex. via `render(..., response: $response)`)
- [ ] **C.** Elle ne retourne rien, elle envoie directement la réponse complète
- [ ] **D.** Elle retourne un tableau de `Link`, à passer ensuite à la fonction `preload()`

### Question 18

Quel code de statut HTTP porte la réponse informationnelle envoyée par `sendEarlyHints()` ? *(une seule bonne réponse)*

- [ ] **A.** 204
- [ ] **B.** 103
- [ ] **C.** 100
- [ ] **D.** 202

### Question 19

Si les Early Hints sont supportés par le serveur web, comment les en-têtes `Link` ajoutés via `preload()` sont-ils envoyés ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement si l'on désactive le cache HTTP
- [ ] **B.** Automatiquement en tant que réponses 103, sans code supplémentaire
- [ ] **C.** Il faut toujours appeler manuellement `sendEarlyHints()` en plus de `preload()`
- [ ] **D.** Ils ne sont jamais envoyés en 103, uniquement avec la réponse finale

### Question 20

Avec AssetMapper, pourquoi faut-il utiliser le service `AssetMapperInterface` pour référencer une URL dans les Early Hints plutôt qu'un chemin fixe ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `sendEarlyHints()` n'accepte que des objets `AssetMapperInterface`
- [ ] **B.** Parce que AssetMapper désactive complètement la fonction `preload()`
- [ ] **C.** Ce n'est jamais nécessaire, le chemin reste toujours identique
- [ ] **D.** Parce que les noms de fichiers contiennent un hash de version (ex. `styles-3c16d9....css`), qu'il faut résoudre dynamiquement via `getAsset()->publicPath`

## Resource Hints

### Question 21

À quoi servent les Resource Hints, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** À chiffrer les échanges HTTP entre client et serveur
- [ ] **B.** À générer un sitemap listant les ressources de la page
- [ ] **C.** À aider les navigateurs à décider quelles ressources télécharger, prétraiter ou auxquelles se connecter en premier
- [ ] **D.** À minifier automatiquement les ressources CSS/JS

### Question 22

Que fait la fonction Twig `dns_prefetch()` ? *(une seule bonne réponse)*

- [ ] **A.** Elle établit une connexion TCP complète avec l'origine indiquée
- [ ] **B.** Elle précharge le contenu complet d'une ressource distante
- [ ] **C.** Elle liste toutes les origines utilisées par la page courante
- [ ] **D.** Elle indique une origine que l'agent utilisateur devrait résoudre en DNS aussi tôt que possible

### Question 23

En quoi `preconnect()` va-t-il plus loin que `dns_prefetch()` ? *(une seule bonne réponse)*

- [ ] **A.** Il télécharge immédiatement la ressource entière
- [ ] **B.** Il ne fonctionne qu'avec des ressources same-origin
- [ ] **C.** Il initie une connexion précoce incluant la résolution DNS, la poignée de main TCP et éventuellement la négociation TLS
- [ ] **D.** Il ne fait que la résolution DNS, comme `dns_prefetch()`

### Question 24

Que fait `prefetch()`, par opposition à `preload()` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne fonctionne que pour les ressources de type image
- [ ] **B.** Il identifie une ressource qui pourrait être nécessaire lors de la prochaine navigation, à récupérer pour accélérer une future requête
- [ ] **C.** Il précharge une ressource nécessaire pour la navigation courante, comme `preload()`
- [ ] **D.** Il empêche le navigateur de mettre la ressource en cache

### Question 25

Quel est le statut de la fonction `prerender()`, selon la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'existe pas dans WebLink, seule `prefetch()` existe
- [ ] **B.** Elle est encore expérimentale et non documentée
- [ ] **C.** Dépréciée, remplacée par la Speculation Rules API
- [ ] **D.** Recommandée pour tout nouveau projet, sans réserve

### Question 26

Quels standards/mécanismes le composant WebLink supporte-t-il au-delà des hints de performance ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tout lien implémentant le standard PSR-13
- [ ] **B.** Les liens définis dans la spécification HTML (ex. `rel="alternate"`)
- [ ] **C.** Le protocole WebSocket
- [ ] **D.** Les migrations de base de données Doctrine

### Question 27

Comment ajouter un lien à la réponse HTTP directement depuis un contrôleur, via le raccourci fourni par `AbstractController` ? *(une seule bonne réponse)*

- [ ] **A.** `$this->response->addHeader('Link', ...)`
- [ ] **B.** Il n'existe aucun raccourci, il faut toujours passer par `GenericLinkProvider`
- [ ] **C.** `$this->addLink($response, ...)` — le second argument est la `Response`, pas la `Request`
- [ ] **D.** `$this->addLink($request, new Link('preload', '/app.css')->withAttribute('as', 'style'))`

### Question 28

Où sont définies, sous forme de constantes, les valeurs possibles des relations de lien (ex. `'preload'`, `'preconnect'`) ? *(une seule bonne réponse)*

- [ ] **A.** Elles ne sont pas définies en constantes, uniquement en chaînes littérales
- [ ] **B.** Dans la classe `Symfony\Component\WebLink\Link` (ex. `Link::REL_PRELOAD`)
- [ ] **C.** Dans une énumération PHP `LinkRelationType`
- [ ] **D.** Dans le fichier de configuration `weblink.yaml`

## Parsing Link Headers

### Question 29

À quoi sert la classe `HttpHeaderParser` du composant WebLink ? *(une seule bonne réponse)*

- [ ] **A.** À générer un en-tête `Link` à partir d'un tableau PHP
- [ ] **B.** À valider la syntaxe d'un en-tête `Link` avant envoi
- [ ] **C.** À convertir un en-tête `Link` en JSON-LD
- [ ] **D.** À parser un en-tête HTTP `Link` (ex. fourni par une API tierce) et le transformer en instances `Link`

### Question 30

Que retourne la méthode `parse()` de `HttpHeaderParser` ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne de caractères représentant le HTML des liens
- [ ] **B.** Une exception si l'en-tête contient plus d'un lien
- [ ] **C.** Un objet dont `getLinks()` retourne la liste des instances `Link` parsées
- [ ] **D.** Directement un tableau associatif PHP

### Question 31

Sur un objet `Link` obtenu après parsing, quelles méthodes permettent de récupérer respectivement ses relations, ses attributs et son URL ? *(une seule bonne réponse)*

- [ ] **A.** `getRel()`, `getParams()`, `getLink()`
- [ ] **B.** `getRels()`, `getAttributes()`, `getHref()`
- [ ] **C.** `getRelations()`, `getOptions()`, `getUrl()`
- [ ] **D.** `getType()`, `getMeta()`, `getPath()`

---

## Corrigé

**Question 1 : D** — « Symfony provides native support (via the WebLink component) for managing `Link` HTTP headers, which are the key to improve the application performance when using preloading capabilities of modern web browsers. » *(§ Vue d'ensemble de WebLink)*

**Question 2 : A, B, C** — « Telling the browser to preload resources that will be needed for the current page; Sending 103 Early Hints responses (…); Making early DNS lookups, TCP handshakes or TLS negotiations. » *(§ Vue d'ensemble de WebLink)*

**Question 3 : C** — « Some of these features (like Early Hints or resource hints) work best over a secure HTTPS connection. » *(§ Vue d'ensemble de WebLink)*

**Question 4 : C** — « you can also use the Docker installer and runtime for Symfony created by Kévin Dunglas, from the Symfony community. » *(§ Vue d'ensemble de WebLink)*

**Question 5 : D** — `$ composer require symfony/web-link`. *(§ Installation)*

**Question 6 : C** — « In a traditional HTTP workflow, when this page is loaded, browsers make one request for the HTML document and another for the linked CSS file. » *(§ Preloading Assets)*

**Question 7 : C** — « use the `preload()` Twig function provided by WebLink. » *(§ Preloading Assets)*

**Question 8 : B** — « The "as" attribute is required, as browsers use it to prioritize resources correctly and comply with the content security policy. » *(§ Preloading Assets)*

**Question 9 : B** — « The `preload()` function adds a `Link` HTTP header to the response (e.g. `Link: </fonts/myfont.woff2>; rel="preload"; as="font"`). » *(§ Preloading Assets)*

**Question 10 : C** — « there's no need to add the `<link rel="preload">` tag. The `importmap()` Twig function automatically adds the `Link` HTTP header for you when the WebLink component is available. » *(§ Preloading Assets)*

**Question 11 : C** — « you can signal the priority of the resource to download using the `importance` attribute. » *(§ Preloading Assets)*

**Question 12 : C** — « When the browser receives this header, it starts downloading the resource right away, before it encounters the corresponding tag in the HTML. » *(§ Preloading Assets)*

**Question 13 : C** — « Popular proxy services and CDNs including Cloudflare, Fastly and Akamai also leverage `Link` headers to optimize resource delivery. » *(§ Preloading Assets)*

**Question 14 : B** — « By default, `Link` headers are sent along with the final response. » *(§ Sending Early Hints)*

**Question 15 : C** — « In order to work, the SAPI you're using must support this feature, like FrankenPHP. » *(§ Sending Early Hints)*

**Question 16 : C** — « you can send early hints explicitly from your controller action thanks to the `AbstractController::sendEarlyHints` method. » *(§ Sending Early Hints)*

**Question 17 : B** — « The `sendEarlyHints()` method also returns the `Response` object, which you must use to create the full response sent from the controller action. » *(§ Sending Early Hints)*

**Question 18 : B** — « Technically, Early Hints are an informational HTTP response with the status code `103`. » *(§ Sending Early Hints)*

**Question 19 : B** — « When early hints are supported by your web server, the `Link` headers added via `preload()` are automatically sent as `103` responses. » *(§ Sending Early Hints)*

**Question 20 : D** — « asset file names contain a version hash (…) To reference the correct versioned URL in early hints, use the `AssetMapperInterface` service (…) `getAsset('styles/app.css')->publicPath`. » *(§ Sending Early Hints)*

**Question 21 : C** — « Resource Hints are used by applications to help browsers when deciding which resources should be downloaded, preprocessed or connected to first. » *(§ Resource Hints)*

**Question 22 : D** — « `dns_prefetch()`: indicates an origin (…) that the user agent should resolve as early as possible. » *(§ Resource Hints)*

**Question 23 : C** — « `preconnect()`: (…) Initiating an early connection, which includes the DNS lookup, TCP handshake, and optional TLS negotiation. » *(§ Resource Hints)*

**Question 24 : B** — « `prefetch()`: identifies a resource that might be required by the next navigation, and that the user agent *should* fetch, such that the user agent can deliver a faster response once the resource is requested in the future. » *(§ Resource Hints)*

**Question 25 : C** — « `prerender()`: **deprecated** and superseded by the Speculation Rules API. » *(§ Resource Hints)*

**Question 26 : A, B** — « The component also supports sending HTTP links not related to performance and any link implementing the PSR-13 standard. For instance, any link defined in the HTML specification. » *(§ Resource Hints)*

**Question 27 : D** — « using the `addLink()` shortcut provided by AbstractController: `$this->addLink($request, new Link('preload', '/app.css')->withAttribute('as', 'style'));`. » *(§ Resource Hints)*

**Question 28 : B** — « The possible values of link relations (…) are also defined as constants in the `Symfony\Component\WebLink\Link` class (e.g. `Link::REL_PRELOAD`, `Link::REL_PRECONNECT`, etc.). » *(§ Resource Hints)*

**Question 29 : D** — « The WebLink component provides the `HttpHeaderParser` utility class to parse those headers and transform them into `Link` instances. » *(§ Parsing Link Headers)*

**Question 30 : C** — « `$links = $parser->parse($linkHeader)->getLinks();`. » *(§ Parsing Link Headers)*

**Question 31 : B** — « `$links[0]->getRels();`, `$links[1]->getAttributes();`, `$links[2]->getHref();`. » *(§ Parsing Link Headers)*

## Pour aller plus loin

Cette page ne comporte pas de section « Learn more » (vérifié sur la source [web_link.rst](https://github.com/symfony/symfony-docs/blob/8.0/web_link.rst)) : pas de pages annexes à couvrir pour ce QCM.
