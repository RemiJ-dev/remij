# QCM — La performance

> **Version :** Symfony **8.0** · **Source :** [symfony.com/doc/8.0/performance.html](https://symfony.com/doc/8.0/performance.html) · **Généré le :** 24 juillet 2026
>
> **40 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Performance Checklists

### Question 1

Quels éléments font partie de la « Production Server Checklist » de performance ? *(plusieurs bonnes réponses)*

- [ ] **A.** Dumper le service container dans un seul fichier
- [ ] **B.** Utiliser le cache de bytecode OPcache
- [ ] **C.** Restreindre le nombre de locales activées dans l'application
- [ ] **D.** Optimiser l'autoloader Composer

### Question 2

À quelle checklist appartient la recommandation de restreindre le nombre de locales actives ? *(une seule bonne réponse)*

- [ ] **A.** La Production Server Checklist
- [ ] **B.** Aucune des deux, c'est une recommandation de sécurité séparée
- [ ] **C.** Les deux checklists, de façon identique
- [ ] **D.** La Symfony Application Checklist

### Question 3

Quelle option permet de ne générer que les fichiers de traduction réellement utilisés par l'application ? *(une seule bonne réponse)*

- [ ] **A.** `framework.translator.paths`
- [ ] **B.** `framework.enabled_locales`
- [ ] **C.** `framework.translator.fallbacks`
- [ ] **D.** `framework.default_locale`

## Dump the Service Container into a Single File

### Question 4

Par défaut, comment Symfony compile-t-il le service container ? *(une seule bonne réponse)*

- [ ] **A.** En un seul fichier unique
- [ ] **B.** En un seul fichier XML
- [ ] **C.** Il n'est jamais compilé, uniquement interprété à la volée
- [ ] **D.** En plusieurs petits fichiers

### Question 5

Quel paramètre permet de compiler le container entier en un seul fichier ? *(une seule bonne réponse)*

- [ ] **A.** `.container.compile_mode`
- [ ] **B.** `.container.dumper.inline_factories`
- [ ] **C.** `container.single_file`
- [ ] **D.** `framework.container.dump_single_file`

### Question 6

Avec quelle fonctionnalité PHP la compilation en fichier unique peut-elle particulièrement améliorer les performances ? *(une seule bonne réponse)*

- [ ] **A.** Les fibers PHP
- [ ] **B.** Le JIT d'OPcache
- [ ] **C.** Le class preloading d'OPcache
- [ ] **D.** Les générateurs PHP

## Use the OPcache Bytecode Cache

### Question 7

Que fait OPcache ? *(une seule bonne réponse)*

- [ ] **A.** Il met en cache les réponses HTTP complètes
- [ ] **B.** Il met en cache les requêtes SQL
- [ ] **C.** Il met en cache uniquement les assets statiques
- [ ] **D.** Il met en cache le bytecode compilé des scripts PHP pour éviter de les recompiler à chaque requête

## Use the OPcache class preloading

### Question 8

Que permet le class preloading d'OPcache ? *(une seule bonne réponse)*

- [ ] **A.** Précharger uniquement les traductions
- [ ] **B.** Précharger le cache HTTP Varnish
- [ ] **C.** Compiler les templates Twig à l'avance uniquement
- [ ] **D.** Compiler et charger les classes au démarrage, les rendant disponibles pour toutes les requêtes jusqu'au redémarrage du serveur

### Question 9

Quel fichier, généré par Symfony Flex, doit-on utiliser (plutôt que celui généré directement dans `var/cache/`) pour configurer `opcache.preload` ? *(une seule bonne réponse)*

- [ ] **A.** `public/preload.php`
- [ ] **B.** `config/preload.php`
- [ ] **C.** `var/cache/preload_classes.php`
- [ ] **D.** `config/opcache.php`

### Question 10

Que faire si le fichier `config/preload.php` est manquant ? *(une seule bonne réponse)*

- [ ] **A.** Désactiver purement et simplement le preloading
- [ ] **B.** Réinstaller PHP avec le support OPcache
- [ ] **C.** Exécuter `composer recipes:update symfony/framework-bundle`
- [ ] **D.** Le créer manuellement en copiant un exemple depuis la documentation

### Question 11

Quels tags de service permettent de définir quelles classes doivent (ou ne doivent pas) être préchargées ? *(plusieurs bonnes réponses)*

- [ ] **A.** `container.preload`
- [ ] **B.** `container.no_preload`
- [ ] **C.** `container.eager_load`
- [ ] **D.** `container.lazy`

### Question 12

Quel réglage `php.ini` est requis en complément de `opcache.preload` pour spécifier l'utilisateur exécutant le preload ? *(une seule bonne réponse)*

- [ ] **A.** `opcache.preload_as`
- [ ] **B.** `opcache.preload_user`
- [ ] **C.** `opcache.preload_owner`
- [ ] **D.** `opcache.preload_uid`

## Configure OPcache for Maximum Performance

### Question 13

Quel réglage définit la mémoire maximale qu'OPcache peut utiliser pour stocker les fichiers PHP compilés ? *(une seule bonne réponse)*

- [ ] **A.** `opcache.validate_timestamps`
- [ ] **B.** `opcache.memory_consumption`
- [ ] **C.** `opcache.max_accelerated_files`
- [ ] **D.** `opcache.interned_strings_buffer`

### Question 14

Pourquoi la documentation recommande-t-elle d'augmenter `opcache.interned_strings_buffer` au-delà de sa valeur par défaut (8 Mo) pour Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Parce que Symfony ne fonctionne pas sans cette augmentation
- [ ] **B.** Parce que cette valeur contrôle le nombre de requêtes simultanées
- [ ] **C.** Parce qu'elle est ignorée par défaut sous PHP 8.5
- [ ] **D.** Parce que les applications Symfony utilisent de nombreux noms de classes pleinement qualifiés

### Question 15

À quoi sert `opcache.max_accelerated_files` ? *(une seule bonne réponse)*

- [ ] **A.** Il désactive le cache au-delà d'un certain nombre de déploiements
- [ ] **B.** Il définit le nombre maximum de fichiers pouvant être stockés dans le cache
- [ ] **C.** Il définit le nombre maximum de requêtes HTTP simultanées
- [ ] **D.** Il définit la taille maximale d'un fichier PHP pouvant être mis en cache

## Don't Check PHP Files Timestamps

### Question 16

Que vérifie OPcache par défaut à chaque requête, ce qui introduit un surcoût évitable en production ? *(une seule bonne réponse)*

- [ ] **A.** Si le serveur dispose de suffisamment de mémoire libre
- [ ] **B.** Si une nouvelle version de PHP est disponible
- [ ] **C.** Si le contenu des fichiers mis en cache a changé depuis leur mise en cache
- [ ] **D.** Si l'utilisateur est authentifié

### Question 17

Quel réglage `php.ini` désactive cette vérification de timestamp ? *(une seule bonne réponse)*

- [ ] **A.** `opcache.disable_timestamp_check=1`
- [ ] **B.** `opcache.validate_timestamps=0`
- [ ] **C.** `opcache.check_timestamps=false`
- [ ] **D.** `opcache.revalidate_freq=0`

### Question 18

Pourquoi ne peut-on pas vider l'OPcache du serveur web en exécutant une commande depuis le terminal ? *(une seule bonne réponse)*

- [ ] **A.** Parce que cela nécessiterait un redémarrage complet du serveur physique
- [ ] **B.** Ce n'est pas vrai, une simple commande CLI suffit toujours
- [ ] **C.** Parce que le CLI et les processus web ne partagent pas le même OPcache
- [ ] **D.** Parce qu'OPcache n'expose aucune fonction de reset

### Question 19

Quelles solutions sont proposées pour vider l'OPcache du serveur web après un déploiement ? *(plusieurs bonnes réponses)*

- [ ] **A.** Redémarrer le serveur web
- [ ] **B.** Appeler la fonction `opcache_reset()` via le serveur web
- [ ] **C.** Utiliser l'utilitaire `cachetool` pour contrôler OPcache depuis la CLI
- [ ] **D.** Redémarrer uniquement PHP-CLI, jamais le serveur web

## Configure the PHP realpath Cache

### Question 20

À quoi sert le cache `realpath` de PHP ? *(une seule bonne réponse)*

- [ ] **A.** À mettre en cache les routes de l'application
- [ ] **B.** À mettre en cache le résultat de la transformation d'un chemin relatif en chemin réel et absolu
- [ ] **C.** À mettre en cache le contenu des fichiers de configuration YAML
- [ ] **D.** À mettre en cache les résultats des requêtes de base de données

### Question 21

Quels réglages sont recommandés pour `realpath_cache_size` et `realpath_cache_ttl` pour des projets Symfony ? *(une seule bonne réponse)*

- [ ] **A.** `realpath_cache_size=1M` et `realpath_cache_ttl=3600`
- [ ] **B.** Aucune valeur par défaut n'est recommandée
- [ ] **C.** `realpath_cache_size=4096K` et `realpath_cache_ttl=600`
- [ ] **D.** `realpath_cache_size=64K` et `realpath_cache_ttl=60`

### Question 22

Dans quel cas PHP désactive-t-il le cache `realpath`, quel que soit son réglage ? *(une seule bonne réponse)*

- [ ] **A.** Quand le mode debug est actif
- [ ] **B.** Quand plus de 100 requêtes simultanées sont en cours
- [ ] **C.** Quand l'option `open_basedir` est activée
- [ ] **D.** Quand OPcache est désactivé

## Optimize Composer Autoloader

### Question 23

Quelle commande génère la class map optimisée de Composer pour la production ? *(une seule bonne réponse)*

- [ ] **A.** `composer optimize --production`
- [ ] **B.** `composer install --optimize-classmap`
- [ ] **C.** `composer autoload:build --prod`
- [ ] **D.** `composer dump-autoload --no-dev --classmap-authoritative`

### Question 24

Où est stockée la class map générée par Composer ? *(une seule bonne réponse)*

- [ ] **A.** `var/cache/prod/classmap.php`
- [ ] **B.** `config/autoload_classmap.php`
- [ ] **C.** `public/classmap.php`
- [ ] **D.** `vendor/composer/autoload_classmap.php`

### Question 25

Que fait le flag `--no-dev` de `dump-autoload` ? *(une seule bonne réponse)*

- [ ] **A.** Il force le rechargement du cache Symfony
- [ ] **B.** Il exclut les classes qui ne sont nécessaires qu'en environnement de développement
- [ ] **C.** Il désactive le mode debug de Symfony
- [ ] **D.** Il empêche la génération du fichier `autoload_classmap.php`

### Question 26

Que fait le flag `--classmap-authoritative` ? *(une seule bonne réponse)*

- [ ] **A.** Il génère uniquement une class map pour les classes PSR-0, jamais PSR-4
- [ ] **B.** Il désactive complètement l'autoloading Composer au profit d'un autoloading manuel
- [ ] **C.** Il crée une class map et empêche Composer de scanner le système de fichiers pour des classes non trouvées dans cette map
- [ ] **D.** Il autorise Composer à scanner l'intégralité du système de fichiers à chaque requête

## Disable Dumping the Container as XML in Debug Mode

### Question 27

En mode debug, que génère Symfony en plus du container compilé habituel ? *(une seule bonne réponse)*

- [ ] **A.** Une capture d'écran du profiler
- [ ] **B.** Un export CSV des services
- [ ] **C.** Un fichier XML avec toutes les informations du service container
- [ ] **D.** Un fichier JSON de métriques de performance

### Question 28

Quelles commandes de debug utilisent ce fichier XML du container ? *(plusieurs bonnes réponses)*

- [ ] **A.** `debug:container`
- [ ] **B.** `debug:autowiring`
- [ ] **C.** `debug:router`
- [ ] **D.** `debug:event-dispatcher`

### Question 29

Quel paramètre permet de désactiver la génération de ce fichier XML si son coût dépasse son intérêt ? *(une seule bonne réponse)*

- [ ] **A.** `framework.debug.container_dump`
- [ ] **B.** `container.debug.disable_xml`
- [ ] **C.** `debug.dump_container`
- [ ] **D.** `debug.container.dump`

## Profiling with Blackfire

### Question 30

Que propose Blackfire, en plus d'être un service commercial ? *(une seule bonne réponse)*

- [ ] **A.** Un remplacement complet du profiler Symfony
- [ ] **B.** Une démo complète (full-featured demo)
- [ ] **C.** Une licence open source gratuite illimitée
- [ ] **D.** Une intégration exclusive avec Symfony Cloud

## Profiling with Symfony Stopwatch

### Question 31

Où le profileur de performance basique de Symfony est-il disponible ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement via une commande console dédiée
- [ ] **B.** Il n'existe aucun profileur basique intégré à Symfony
- [ ] **C.** Dans l'environnement de développement, via le panneau « time » de la web debug toolbar
- [ ] **D.** Uniquement en production, pour surveiller les vraies performances

### Question 32

Comment injecter le service de chronométrage dans un service applicatif ? *(une seule bonne réponse)*

- [ ] **A.** En appelant `Stopwatch::getInstance()` de façon statique
- [ ] **B.** En l'injectant uniquement dans les contrôleurs, jamais dans les services
- [ ] **C.** En l'activant via une configuration YAML obligatoire, aucune injection n'est possible
- [ ] **D.** En type-hintant un argument avec la classe `Symfony\Component\Stopwatch\Stopwatch`, Symfony injectant le service `debug.stopwatch`

### Question 33

Que retournent les méthodes `start()`, `stop()` et `getEvent()` du Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** Rien, ce sont des méthodes void
- [ ] **B.** Un objet `StopwatchEvent` fournissant des informations sur l'événement en cours
- [ ] **C.** Un simple float représentant la durée en millisecondes
- [ ] **D.** Un tableau associatif brut sans objet dédié

### Question 34

Comment peut-on obtenir un résumé rapide (durée, mémoire) d'un événement Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** En sérialisant l'objet en JSON
- [ ] **B.** En convertissant l'objet `StopwatchEvent` en chaîne de caractères
- [ ] **C.** En appelant une méthode dédiée `toSummary()`
- [ ] **D.** Ce n'est possible qu'en lisant directement le profiler web

### Question 35

Comment profiler du code dans un template Twig avec le Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** Twig chronomètre automatiquement chaque bloc sans configuration
- [ ] **B.** Avec le tag Twig `{% stopwatch 'nom-evenement' %}...{% endstopwatch %}`
- [ ] **C.** Ce n'est pas possible depuis Twig, uniquement depuis le PHP
- [ ] **D.** En appelant `{{ stopwatch_start('nom') }}` comme filtre

### Question 36

Que fait la méthode `reset()` du Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** Elle réinitialise uniquement la mémoire, pas la durée
- [ ] **B.** Elle supprime toutes les données mesurées jusqu'à présent
- [ ] **C.** Elle relance immédiatement le chronométrage de l'événement courant
- [ ] **D.** Elle exporte les données vers Blackfire

## Profiling Categories

### Question 37

À quoi sert le second argument optionnel de la méthode `start()` ? *(une seule bonne réponse)*

- [ ] **A.** À définir le nom affiché dans le profiler
- [ ] **B.** À définir si l'événement doit être loggé ou non
- [ ] **C.** À définir la catégorie ou le tag de l'événement, pour les garder organisés par type
- [ ] **D.** À définir la durée maximale de l'événement

## Profiling Periods

### Question 38

Que fait la méthode `lap()` du Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** Elle met en pause l'événement sans le redémarrer
- [ ] **B.** Elle crée un nouvel événement totalement indépendant
- [ ] **C.** Elle supprime la dernière period enregistrée
- [ ] **D.** Elle arrête un événement puis le redémarre immédiatement, créant une « period »

## Profiling Sections

### Question 39

À quoi servent les « sections » du Stopwatch ? *(une seule bonne réponse)*

- [ ] **A.** À chiffrer les données de profiling
- [ ] **B.** À limiter le nombre d'événements trackés simultanément
- [ ] **C.** À exporter automatiquement vers un fichier CSV
- [ ] **D.** À diviser la timeline de profiling en groupes

### Question 40

Comment sont nommés les événements qui n'appartiennent à aucune section nommée ? *(une seule bonne réponse)*

- [ ] **A.** `__global__`
- [ ] **B.** `__none__`
- [ ] **C.** `__root__`
- [ ] **D.** `__default__`

---

## Corrigé

**Question 1 : A, B, D** — « **Production Server Checklist**: Dump the service container into a single file (…) Use the OPcache bytecode cache (…) Optimize Composer Autoloader » *(§ Performance Checklists)*

**Question 2 : D** — « **Symfony Application Checklist**: Restrict the number of locales enabled in the application » *(§ Performance Checklists)*

**Question 3 : B** — « Use the `framework.enabled_locales` option to only generate the translation files actually used in your application. » *(§ Restrict the Number of Locales Enabled in the Application)*

**Question 4 : D** — « Symfony compiles the service container into multiple small files by default. » *(§ Dump the Service Container into a Single File)*

**Question 5 : B** — « Set this parameter to `true` to compile the entire container into a single file: `.container.dumper.inline_factories: true`. » *(§ Dump the Service Container into a Single File)*

**Question 6 : C** — « which could improve performance when using PHP class preloading. » *(§ Dump the Service Container into a Single File)*

**Question 7 : D** — « OPcache caches the compiled bytecode of PHP scripts to avoid recompiling them on each request. » *(§ Use the OPcache Bytecode Cache)*

**Question 8 : D** — « OPcache can compile and load classes at start-up and make them available to all requests until the server is restarted, improving performance significantly. » *(§ Use the OPcache class preloading)*

**Question 9 : B** — « Rather than use this file directly, use the `config/preload.php` file that is created when using Symfony Flex. » *(§ Use the OPcache class preloading)*

**Question 10 : C** — « If this file is missing, run this command to update the Symfony Flex recipe: `composer recipes:update symfony/framework-bundle`. » *(§ Use the OPcache class preloading)*

**Question 11 : A, B** — « Use the `container.preload` and `container.no_preload` service tags to define which classes should or should not be preloaded by PHP. » *(§ Use the OPcache class preloading)*

**Question 12 : B** — « ; required for opcache.preload: `opcache.preload_user=www-data` » *(§ Use the OPcache class preloading)*

**Question 13 : B** — « maximum memory that OPcache can use to store compiled PHP files: `opcache.memory_consumption=256`. » *(§ Configure OPcache for Maximum Performance)*

**Question 14 : D** — « memory (in MB) for interned strings; the default value (8 MB) is too low for Symfony applications, which use many fully-qualified class names. » *(§ Configure OPcache for Maximum Performance)*

**Question 15 : B** — « maximum number of files that can be stored in the cache: `opcache.max_accelerated_files=32531`. » *(§ Configure OPcache for Maximum Performance)*

**Question 16 : C** — « by default OPcache checks if cached files have changed their contents since they were cached. This check introduces some overhead. » *(§ Don't Check PHP Files Timestamps)*

**Question 17 : B** — « This check introduces some overhead that can be avoided as follows: `opcache.validate_timestamps=0`. » *(§ Don't Check PHP Files Timestamps)*

**Question 18 : C** — « Given that in PHP, the CLI and the web processes don't share the same OPcache, you cannot clear the web server OPcache by executing some command in your terminal. » *(§ Don't Check PHP Files Timestamps)*

**Question 19 : A, B, C** — « Restart the web server; Call the `opcache_reset()` function via the web server (…); Use the cachetool utility to control OPcache from the CLI. » *(§ Don't Check PHP Files Timestamps)*

**Question 20 : B** — « When a relative path is transformed into its real and absolute path, PHP caches the result to improve performance. » *(§ Configure the PHP realpath Cache)*

**Question 21 : C** — « maximum memory allocated to store the results: `realpath_cache_size=4096K` (…) save the results for 10 minutes (600 seconds): `realpath_cache_ttl=600`. » *(§ Configure the PHP realpath Cache)*

**Question 22 : C** — « PHP disables the `realpath` cache when the `open_basedir` config option is enabled. » *(§ Configure the PHP realpath Cache)*

**Question 23 : D** — « $ composer dump-autoload --no-dev --classmap-authoritative » *(§ Optimize Composer Autoloader)*

**Question 24 : D** — « a big array of the locations of all the classes and it's stored in `vendor/composer/autoload_classmap.php`. » *(§ Optimize Composer Autoloader)*

**Question 25 : B** — « `--no-dev` excludes the classes that are only needed in the development environment. » *(§ Optimize Composer Autoloader)*

**Question 26 : C** — « `--classmap-authoritative` creates a class map for PSR-0 and PSR-4 compatible classes (…) and prevents Composer from scanning the file system for classes that are not found in the class map. » *(§ Optimize Composer Autoloader)*

**Question 27 : C** — « In debug mode, Symfony generates an XML file with all the service container information (services, arguments, etc.) » *(§ Disable Dumping the Container as XML in Debug Mode)*

**Question 28 : A, B** — « This XML file is used by various debugging commands such as `debug:container` and `debug:autowiring`. » *(§ Disable Dumping the Container as XML in Debug Mode)*

**Question 29 : D** — « you can stop generating the file as follows: `debug.container.dump: false`. » *(§ Disable Dumping the Container as XML in Debug Mode)*

**Question 30 : B** — « It's a commercial service, but provides a full-featured demo. » *(§ Profiling with Blackfire)*

**Question 31 : C** — « Symfony provides a basic performance profiler in the development config environment. Click on the "time panel" of the web debug toolbar. » *(§ Profiling with Symfony Stopwatch)*

**Question 32 : D** — « type-hint any controller or service argument with the `Symfony\Component\Stopwatch\Stopwatch` class and Symfony will inject the `debug.stopwatch` service. » *(§ Profiling with Symfony Stopwatch)*

**Question 33 : B** — « The `start()`, `stop()` and `getEvent()` methods return a `Symfony\Component\Stopwatch\StopwatchEvent` object that provides information about the current event, even while it's still running. » *(§ Profiling with Symfony Stopwatch)*

**Question 34 : B** — « This object can be converted to a string for a quick summary: `dump((string) $this->stopwatch->getEvent('export-data'));  // dumps e.g. '4.50 MiB - 26 ms'`. » *(§ Profiling with Symfony Stopwatch)*

**Question 35 : B** — « You can also profile your template code with the stopwatch Twig tag: `{% stopwatch 'render-blog-posts' %}...{% endstopwatch %}`. » *(§ Profiling with Symfony Stopwatch)*

**Question 36 : B** — « reset the stopwatch to delete all the data measured so far » *(§ Profiling with Symfony Stopwatch)*

**Question 37 : C** — « Use the second optional argument of the `start()` method to define the category or tag of the event. This helps keep events organized by type. » *(§ Profiling Categories)*

**Question 38 : D** — « This is exactly what the `lap()` method does, which stops an event and then restarts it immediately (…) Lap information is stored as "periods" within the event. » *(§ Profiling Periods)*

**Question 39 : D** — « Sections are a way to split the profile timeline into groups. » *(§ Profiling Sections)*

**Question 40 : C** — « All events that don't belong to any named section are added to the special section called `__root__`. » *(§ Profiling Sections)*

## Pour aller plus loin

Un seul lien dans la section « Learn more » de la page, qui pointe vers une page **déjà couverte** par le fichier `42-http_cache.md` (elle fait partie du Learn More de `http_cache.html`) — les questions Varnish sont regroupées là-bas plutôt que dupliquées ici :

- [How to Use Varnish to Speed up my Website](https://symfony.com/doc/8.0/http_cache/varnish.html)
