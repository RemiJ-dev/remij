# QCM — Le logging

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/logging.html](https://symfony.com/doc/8.0/logging.html) (questions 1 à 26) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/logging.html#learn-more) (questions 27 à 74) · **Généré le :** 21 juillet 2026
>
> **74 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Les loggers PSR-3 par défaut

### Question 1

Quels sont les deux loggers PSR-3 minimalistes fournis nativement par Symfony, et pour quel contexte chacun est-il prévu ? *(une seule bonne réponse)*

- [ ] **A.** `Logger` (contexte HTTP) et `ConsoleLogger` (contexte CLI)
- [ ] **B.** `MonologLogger` et `ConsoleLogger`, tous deux pour le contexte HTTP
- [ ] **C.** `NullLogger` et `FileLogger`
- [ ] **D.** Un seul logger universel, `Symfony\Component\Log\Logger`, pour les deux contextes

### Question 2

En conformité avec quelle méthodologie ces loggers envoient-ils les messages à partir du niveau `WARNING` vers `stderr` ? *(une seule bonne réponse)*

- [ ] **A.** La méthodologie des « douze facteurs » (*the twelve-factor app methodology*)
- [ ] **B.** La méthodologie PSR-3 elle-même
- [ ] **C.** La méthodologie « Clean Architecture »
- [ ] **D.** Aucune méthodologie particulière n'est citée

### Question 3

À quels niveaux de log minimum correspondent ces valeurs de la variable d'environnement `SHELL_VERBOSITY` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `-1` → `ERROR`
- [ ] **B.** `2` → `INFO`
- [ ] **C.** `3` → `DEBUG`
- [ ] **D.** `1` → `WARNING`

### Question 4

En dehors de `SHELL_VERBOSITY`, comment personnaliser le niveau minimal, la sortie par défaut et le format des deux loggers PSR-3 natifs ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, ces réglages sont figés
- [ ] **B.** En passant les arguments appropriés au constructeur de `Logger` et de `ConsoleLogger`
- [ ] **C.** Uniquement via une variable d'environnement `LOG_LEVEL`
- [ ] **D.** En modifiant le fichier `php.ini`

### Question 5

Comment le logger HTTP (`Symfony\Component\HttpKernel\Log\Logger`) est-il exposé, et comment le reconfigurer ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est pas exposé comme service, seulement instancié manuellement
- [ ] **B.** Il est disponible via le service `logger` ; on peut surcharger sa définition de service pour passer sa propre configuration
- [ ] **C.** Il est disponible via le service `monolog.logger.main` uniquement
- [ ] **D.** Il faut toujours passer par Monolog pour le configurer, même sans l'avoir installé

## Logger un message

### Question 6

Comment injecter le logger par défaut dans un contrôleur ou un service, et comment utiliser des placeholders dans un message ? *(une seule bonne réponse)*

- [ ] **A.** En type-hintant `Psr\Log\LoggerInterface`, puis par exemple `$logger->debug('User {userId} has logged in', ['userId' => ...])`
- [ ] **B.** En type-hintant `Monolog\Logger` directement, obligatoirement
- [ ] **C.** Les placeholders ne sont pas supportés par l'interface PSR-3
- [ ] **D.** En injectant `LoggerAwareInterface` comme argument de constructeur

### Question 7

Pourquoi la documentation recommande-t-elle d'utiliser des placeholders dans les messages de log plutôt que de la concaténation directe ? *(plusieurs bonnes réponses)*

- [ ] **A.** C'est plus facile à vérifier, car de nombreux outils de log regroupent les messages identiques hormis certaines valeurs variables
- [ ] **B.** C'est beaucoup plus facile à traduire
- [ ] **C.** C'est meilleur pour la sécurité, l'échappement pouvant alors être fait de façon contextuelle par l'implémentation
- [ ] **D.** C'est la seule façon d'ajouter du contexte additionnel (« extra ») à un log

### Question 8

Où trouver la liste complète des méthodes disponibles sur le service `logger`, une par niveau de log ? *(une seule bonne réponse)*

- [ ] **A.** Dans `Psr\Log\LoggerInterface`
- [ ] **B.** Dans la classe `Monolog\Logger` uniquement
- [ ] **C.** Il n'existe pas de liste exhaustive, chaque bundle peut ajouter ses propres niveaux
- [ ] **D.** Dans le fichier `config/packages/monolog.yaml`

## Monolog : présentation, installation et emplacement des logs

### Question 9

À quoi sert l'intégration de Monolog dans Symfony, au-delà des deux loggers PSR-3 basiques ? *(une seule bonne réponse)*

- [ ] **A.** Créer et stocker les messages de log à des endroits variés, et déclencher diverses actions selon le niveau du message (ex. envoyer un email en cas d'erreur)
- [ ] **B.** Uniquement remplacer `Psr\Log\LoggerInterface` par une interface propriétaire
- [ ] **C.** Monolog ne fait qu'ajouter de la coloration dans la console
- [ ] **D.** Monolog est requis dès l'installation de base de Symfony, sans installation supplémentaire

### Question 10

Quelle commande installe le logger basé sur Monolog ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/monolog-bundle`
- [ ] **B.** `composer require monolog/monolog-bridge`
- [ ] **C.** Monolog est déjà installé par défaut avec `symfony/framework-bundle`
- [ ] **D.** `composer require symfony/logger-bundle`

### Question 11

Où les logs sont-ils écrits par défaut en environnement `dev`, et en environnement `prod` ? *(une seule bonne réponse)*

- [ ] **A.** `dev` : `var/log/dev.log` ; `prod` : le flux `STDERR` PHP, ce qui convient bien aux applications conteneurisées sans permission d'écriture disque
- [ ] **B.** `dev` et `prod` utilisent tous deux `var/log/prod.log`
- [ ] **C.** `dev` : `STDERR` ; `prod` : `var/log/prod.log`
- [ ] **D.** Les logs ne sont jamais écrits sur disque par défaut, dans aucun environnement

### Question 12

Comment stocker malgré tout les logs de production dans un fichier plutôt que sur `STDERR` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible en production
- [ ] **B.** En définissant l'option `path` du ou des handlers de log vers le chemin de fichier souhaité ; Monolog crée automatiquement le répertoire de logs s'il n'existe pas
- [ ] **C.** En désinstallant `symfony/monolog-bundle`
- [ ] **D.** Uniquement en modifiant `php.ini`

## Les handlers : écrire les logs à différents endroits

### Question 13

Que représente la « pile de handlers » du logger, et à quoi sert la fonctionnalité de « channels » (canaux) évoquée en complément ? *(une seule bonne réponse)*

- [ ] **A.** Chaque handler peut écrire les entrées de log à un endroit différent (fichier, base de données, Slack…) ; les canaux permettent en plus à chaque catégorie de log d'avoir ses propres handlers, pour stocker différents messages à différents endroits
- [ ] **B.** La pile de handlers ne sert qu'à la mise en forme (formatting), les canaux gèrent le stockage
- [ ] **C.** Un seul handler peut être actif à la fois
- [ ] **D.** Les canaux et les handlers sont deux noms pour le même concept

### Question 14

Que contrôle l'option `priority` d'un handler, et quel est son comportement par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Sa position dans la pile de handlers : ceux avec une priorité plus haute sont appelés en premier, ceux de même priorité gardent l'ordre de déclaration ; la valeur par défaut est `0`
- [ ] **B.** Le niveau de log minimal qu'il traite
- [ ] **C.** Le nombre maximal de handlers pouvant être déclarés
- [ ] **D.** La fréquence à laquelle le handler écrit sur le disque

### Question 15

Que recommande la documentation quand des handlers sont ajoutés dans d'autres fichiers de configuration ? *(une seule bonne réponse)*

- [ ] **A.** De ne jamais leur définir de priorité, pour garder l'ordre naturel
- [ ] **B.** De définir une priorité explicite, pour garantir qu'ils sont ordonnés comme attendu
- [ ] **C.** De toujours les regrouper dans un seul fichier `monolog.yaml`
- [ ] **D.** De désactiver l'autoconfiguration des handlers

### Question 16

Que fait l'option `enabled: false` sur un handler, et depuis quelle version de Monolog est-elle disponible ? *(une seule bonne réponse)*

- [ ] **A.** Elle réduit simplement le niveau de log du handler au minimum ; disponible depuis Monolog 3.0
- [ ] **B.** Elle permet de désactiver un handler sans retirer sa configuration : le handler est alors complètement ignoré ; introduite dans Monolog 3.11.0
- [ ] **C.** Elle supprime définitivement la configuration du handler au prochain `cache:clear`
- [ ] **D.** Cette option n'existe pas, il faut commenter la configuration manuellement

## Handlers qui modifient les entrées de log (fingers_crossed)

### Question 17

Comment fonctionne le handler `fingers_crossed`, utilisé par défaut en environnement `prod` ? *(une seule bonne réponse)*

- [ ] **A.** Il écrit chaque message immédiatement, sans filtrage particulier
- [ ] **B.** Il stocke *tous* les messages de log pendant une requête, mais ne les transmet à un second handler que si l'un des messages atteint un `action_level` donné
- [ ] **C.** Il ignore systématiquement les messages de niveau `debug`
- [ ] **D.** Il envoie tous les logs par email dès qu'une erreur critique survient

### Question 18

Dans l'exemple `filter_for_errors` (fingers_crossed, `action_level: error`, `handler: file_log`), que se passe-t-il si un seul message de la requête atteint le niveau `error` ? *(une seule bonne réponse)*

- [ ] **A.** Seul ce message précis est transmis au handler `file_log`
- [ ] **B.** *Tous* les messages de la requête, quel que soit leur niveau, sont transmis et enregistrés via `file_log` — ce qui facilite le débogage en donnant le contexte complet
- [ ] **C.** La requête entière est immédiatement interrompue
- [ ] **D.** Rien ne se passe, `action_level` ne s'applique qu'aux niveaux `critical` et supérieurs

### Question 19

D'après le tip de la documentation, le handler `file_log` utilisé comme cible du `fingers_crossed` apparaît-il dans la pile de handlers elle-même ? *(une seule bonne réponse)*

- [ ] **A.** Oui, comme n'importe quel autre handler de premier niveau
- [ ] **B.** Non : en tant que handler imbriqué (nested) du `fingers_crossed`, il n'est pas inclus dans la pile en tant que telle
- [ ] **C.** Il apparaît deux fois dans la pile, une fois en tant que nested et une fois en tant que top-level
- [ ] **D.** Cela dépend uniquement de sa priorité

## Tous les handlers intégrés, et rotation des logs

### Question 20

Où trouve-t-on la liste exhaustive de tous les handlers intégrés à Monolog (email, Loggly, Slack…) ? *(une seule bonne réponse)*

- [ ] **A.** Directement dans le composant HttpKernel
- [ ] **B.** Dans la documentation interne de MonologBundle lui-même, via le lien « Monolog Configuration »
- [ ] **C.** Cette page ne fournit aucun pointeur vers cette liste
- [ ] **D.** Uniquement dans le code source du composant Console

### Question 21

Quels sont les deux moyens documentés pour faire tourner (rotate) ses fichiers de logs afin d'éviter qu'ils deviennent trop volumineux ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser l'outil Linux `logrotate`, ou utiliser le handler Monolog `rotating_file`
- [ ] **B.** Uniquement `logrotate`, Monolog ne proposant aucune alternative
- [ ] **C.** Uniquement le handler `rotating_file`, `logrotate` n'étant pas mentionné
- [ ] **D.** Il faut écrire un script cron personnalisé, aucune solution existante n'étant documentée

### Question 22

Que fait le handler `rotating_file`, et à quoi correspond l'option `max_files` ? *(une seule bonne réponse)*

- [ ] **A.** Il crée un nouveau fichier de log chaque jour et peut supprimer automatiquement les anciens fichiers ; `max_files` définit le nombre maximal de fichiers à conserver, avec `0` par défaut signifiant un nombre infini de fichiers
- [ ] **B.** Il fusionne tous les logs en un seul fichier compressé chaque semaine
- [ ] **C.** `max_files` définit la taille maximale en Mo de chaque fichier
- [ ] **D.** Il ne fonctionne qu'avec le handler `stream`, jamais seul

## Utiliser un logger dans un service, et logs des processus longue durée

### Question 23

Si un service implémente `Psr\Log\LoggerAwareInterface` et que l'autoconfiguration des services est utilisée, que se passe-t-il automatiquement ? *(une seule bonne réponse)*

- [ ] **A.** Rien, il faut toujours appeler `setLogger()` manuellement
- [ ] **B.** Ce service reçoit un appel automatique à sa méthode `setLogger()`, avec le logger par défaut passé en argument
- [ ] **C.** Le service est automatiquement tagué `monolog.processor`
- [ ] **D.** Le service devient automatiquement un handler Monolog

### Question 24

Comment utiliser, dans son propre service, un logger préconfiguré pour un canal (channel) spécifique plutôt que le canal `app` par défaut ? *(une seule bonne réponse)*

- [ ] **A.** En autowirant les channels Monolog, ou en utilisant le tag `monolog.logger` avec la propriété `channel`
- [ ] **B.** Ce n'est possible qu'en modifiant directement le service `logger` global
- [ ] **C.** En renommant le service en `logger.<channel>`
- [ ] **D.** Les canaux ne sont pas configurables par service, seulement de façon globale

### Question 25

À quoi servent les « processors » de Monolog, brièvement évoqués dans la page principale ? *(une seule bonne réponse)*

- [ ] **A.** Ils suppriment les anciens logs automatiquement
- [ ] **B.** Ce sont des fonctions qui ajoutent dynamiquement des informations supplémentaires aux entrées de log
- [ ] **C.** Ils convertissent les logs au format PSR-3
- [ ] **D.** Ils compressent les fichiers de log avant écriture

### Question 26

Quel problème peut survenir dans les processus de longue durée à cause de l'accumulation de données en mémoire par Monolog, et comment y remédier ? *(une seule bonne réponse)*

- [ ] **A.** Un dépassement de mémoire tampon, une augmentation de la mémoire utilisée, voire des logs incohérents ; on peut appeler la méthode `reset()` sur une instance de `Monolog\Logger`, typiquement entre chaque tâche traitée
- [ ] **B.** Aucun problème n'est documenté pour ce cas d'usage
- [ ] **C.** Il faut redémarrer complètement le processus PHP après chaque tâche
- [ ] **D.** Il faut désactiver tous les handlers en dehors de `stream`

---

> Les questions 27 à 74 couvrent les **7 pages** listées dans la section [Learn more](https://symfony.com/doc/8.0/logging.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Emailer les erreurs avec Monolog

### Question 27

Dans l'exemple de configuration pour l'envoi d'email sur erreur, quel niveau déclenche le handler `main` (fingers_crossed), et à quel type d'erreurs HTTP cela correspond-il par défaut ? *(une seule bonne réponse)*

- [ ] **A.** `action_level: critical`, qui correspond aux erreurs HTTP 5xx
- [ ] **B.** `action_level: error`, qui correspond aux erreurs HTTP 4xx uniquement
- [ ] **C.** `action_level: warning`, sans lien avec un code HTTP précis
- [ ] **D.** `action_level: emergency`, réservé aux pannes serveur totales

### Question 28

Comment inclure aussi les erreurs de niveau 400 dans les emails, d'après le tip de la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec ce mécanisme
- [ ] **B.** En changeant `action_level` de `critical` à `error`
- [ ] **C.** En ajoutant un second handler `fingers_crossed` dédié aux erreurs 400
- [ ] **D.** En modifiant le paramètre `excluded_http_codes`

### Question 29

Quel est le rôle du handler `deduplication`, et quel est le comportement par défaut de son option `time` ? *(une seule bonne réponse)*

- [ ] **A.** Il conserve tous les messages d'une requête et ne les transmet au handler suivant que s'ils sont uniques sur une période donnée, 60 secondes par défaut ; les doublons sont éliminés
- [ ] **B.** Il fusionne plusieurs requêtes en un seul email toutes les 60 minutes
- [ ] **C.** Il supprime définitivement les messages dupliqués de la base de données
- [ ] **D.** `time` définit le délai avant l'envoi du premier email, jamais la déduplication elle-même

### Question 30

À quoi sert le handler `symfony_mailer` dans cette configuration, et quelles options peut-on lui passer ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe pas, il faut utiliser un handler `swift_mailer` legacy
- [ ] **B.** C'est le handler qui envoie effectivement l'email d'erreur ; il accepte notamment `from_email`, `to_email` (adresse ou liste), `subject`, `level`, `formatter` et `content_type`
- [ ] **C.** Il se contente de journaliser un message indiquant qu'un email *devrait* être envoyé, sans réellement l'envoyer
- [ ] **D.** Il ne peut envoyer qu'à une seule adresse email, jamais une liste

### Question 31

Comment combiner l'envoi d'email avec un enregistrement classique des erreurs dans un fichier, selon l'exemple donné ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, il faut choisir l'un ou l'autre
- [ ] **B.** En utilisant un handler de type `group`, dont les `members` listent les handlers `stream` et `deduplication` à utiliser ensemble
- [ ] **C.** En dupliquant entièrement la configuration `monolog.yaml`
- [ ] **D.** En appelant manuellement `error_log()` en plus du logger Symfony

### Question 32

Quel format de contenu est utilisé pour l'email d'erreur dans l'exemple `symfony_mailer`, et quel formatter cela implique-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Texte brut, avec `monolog.formatter.line`
- [ ] **B.** HTML, avec `monolog.formatter.html` et `content_type: text/html`
- [ ] **C.** JSON, avec `monolog.formatter.json`
- [ ] **D.** XML, sans formatter spécifique nécessaire

### Question 33

Pourquoi le sujet de l'email (`subject`) contient-il `%%message%%` avec un double signe pourcentage plutôt qu'un simple `%message%` ? *(une seule bonne réponse)*

- [ ] **A.** C'est une erreur de frappe dans la documentation
- [ ] **B.** Le simple `%` est déjà utilisé par la syntaxe des paramètres de configuration Symfony ; le double `%%` permet d'obtenir un `%` littéral dans la valeur, ici pour le placeholder Monolog `%message%`
- [ ] **C.** `%%message%%` désigne un tableau de messages plutôt qu'un seul
- [ ] **D.** Cela active un mode de formatage Markdown

## Annexe — Canaux (channels) et fichiers de logs séparés

### Question 34

Que sont les « channels » (canaux) de log dans Symfony, et quel comportement ont-ils par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Des catégories de log (ex. `app`, `doctrine`, `event`, `security`, `request`…), le canal étant imprimé dans le message de log ; par défaut, Symfony écrit tous les messages dans un seul fichier, quel que soit le canal
- [ ] **B.** Des groupes de serveurs sur lesquels les logs sont répliqués
- [ ] **C.** Un synonyme des « handlers »
- [ ] **D.** Une fonctionnalité disponible uniquement en environnement `prod`

### Question 35

À quoi correspond chaque canal en termes de services, et quelle commande permet de les lister ? *(une seule bonne réponse)*

- [ ] **A.** Chaque canal correspond à un service logger dédié (`monolog.logger.XXX`) ; `php bin/console debug:container monolog` permet de les lister
- [ ] **B.** Les canaux ne sont pas des services, seulement des préfixes de texte dans les logs
- [ ] **C.** Un seul service `monolog.channels` gère tous les canaux
- [ ] **D.** `php bin/console debug:monolog:channels`

### Question 36

Comment restreindre un handler pour qu'il ne traite que les messages d'un canal donné, par exemple `security` ? *(une seule bonne réponse)*

- [ ] **A.** Avec l'option `channels: [security]` sur ce handler
- [ ] **B.** En renommant le handler `security_handler`
- [ ] **C.** En créant un fichier `config/packages/security_monolog.yaml` séparé
- [ ] **D.** Ce n'est pas possible, tous les handlers reçoivent tous les canaux

### Question 37

Quelle limitation importante la documentation signale-t-elle sur l'option `channels` d'un handler ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne fonctionne que pour les handlers de premier niveau (top-level) : les handlers imbriqués dans un group, buffer, filter, fingers-crossed ou autre l'ignorent et traitent tous les messages qui leur sont transmis
- [ ] **B.** Elle ne fonctionne que sur l'adapter `stream`
- [ ] **C.** Elle nécessite obligatoirement Monolog 4.0 ou supérieur
- [ ] **D.** Elle ne peut cibler qu'un seul canal à la fois, jamais une liste

### Question 38

Quelles syntaxes valides pour l'option `channels` sont documentées ? *(plusieurs bonnes réponses)*

- [ ] **A.** `channels: foo` pour n'inclure que le canal `foo`
- [ ] **B.** `channels: '!foo'` pour inclure tous les canaux sauf `foo`
- [ ] **C.** `channels: [foo, bar]` pour n'inclure que `foo` et `bar`
- [ ] **D.** Omettre l'option `channels` exclut tous les canaux par défaut

### Question 39

Comment déclarer de nouveaux canaux personnalisés sans avoir à tagger un service précis ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans tagger explicitement au moins un service
- [ ] **B.** Via `monolog.channels: ['foo', 'bar', 'foo_bar']` dans la configuration ; Symfony enregistre alors automatiquement un service par canal, par exemple `monolog.logger.foo`
- [ ] **C.** En créant un fichier `channels.yaml` dans `config/`
- [ ] **D.** En créant une classe implémentant `ChannelInterface`

### Question 40

Depuis quelle version de MonologBundle peut-on autowirer un canal Monolog spécifique par simple type-hint, et quelle syntaxe utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Depuis MonologBundle 3.5, en type-hintant `Psr\Log\LoggerInterface` avec un argument nommé `<camelCased channel name>Logger`, par exemple `$fooBarLogger` pour le canal `foo_bar`
- [ ] **B.** Depuis la première version de MonologBundle, via `LoggerInterface $logger`
- [ ] **C.** Ce n'est possible qu'en PHP 8.3 ou supérieur
- [ ] **D.** En nommant l'argument exactement comme le canal, sans suffixe

### Question 41

Quelle alternative aux tags manuels permet, depuis Monolog 3.5, de configurer le canal d'un service directement sur sa classe ? *(une seule bonne réponse)*

- [ ] **A.** L'attribut `#[WithMonologChannel('fixtures')]`
- [ ] **B.** L'interface `ChannelAwareInterface`
- [ ] **C.** Un attribut `#[MonologChannel]` sans argument
- [ ] **D.** Cette fonctionnalité n'existe pas encore, seule la configuration YAML est possible

### Question 42

Le canal doit-il être « prédéfini » dans la configuration Monolog pour pouvoir être autowiré via le type-hint camelCase ? *(une seule bonne réponse)*

- [ ] **A.** Oui, le canal doit avoir été prédéfini dans la configuration Monolog
- [ ] **B.** Non, n'importe quel nom d'argument crée automatiquement un nouveau canal
- [ ] **C.** Non, seuls les canaux internes de Symfony (`app`, `doctrine`…) sont autowirables ainsi
- [ ] **D.** Cela dépend uniquement de la version de PHP utilisée

## Annexe — Formatters personnalisés

### Question 43

Quel rôle joue un `Formatter` dans un handler Monolog, et quelle interface un formatter personnalisé doit-il implémenter ? *(une seule bonne réponse)*

- [ ] **A.** Il formate l'enregistrement (record) avant sa journalisation ; il doit implémenter `Monolog\Formatter\FormatterInterface`
- [ ] **B.** Il détermine le niveau de log minimal du handler
- [ ] **C.** Il chiffre les données sensibles avant écriture
- [ ] **D.** Il gère uniquement la rotation des fichiers

### Question 44

Quel formatter est utilisé par défaut par tous les handlers Monolog ? *(une seule bonne réponse)*

- [ ] **A.** `Monolog\Formatter\JsonFormatter`
- [ ] **B.** `Monolog\Formatter\LineFormatter`
- [ ] **C.** `Monolog\Formatter\HtmlFormatter`
- [ ] **D.** Aucun formatter par défaut, il faut toujours en configurer un explicitement

### Question 45

Comment utiliser le `JsonFormatter` uniquement en environnement `prod` pour un handler donné ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible de restreindre un formatter à un seul environnement
- [ ] **B.** En l'enregistrant comme service puis en définissant l'option `formatter: 'monolog.formatter.json'` du handler, dans un bloc `when@prod`
- [ ] **C.** En renommant le handler `file_prod`
- [ ] **D.** En ajoutant `env: prod` directement sur le formatter

### Question 46

Parmi ces formatters Monolog pré-déclarés comme services, lesquels correspondent à la description donnée par la documentation ? *(plusieurs bonnes réponses)*

- [ ] **A.** `monolog.formatter.html` : formate un enregistrement en tableau HTML
- [ ] **B.** `monolog.formatter.json` : sérialise un enregistrement en objet JSON
- [ ] **C.** `monolog.formatter.logstash` : sérialise un enregistrement au format Logstash Event Format
- [ ] **D.** `monolog.formatter.line` : formate un enregistrement en tableau multi-lignes indenté

### Question 47

Que fait `monolog.formatter.scalar` ? *(une seule bonne réponse)*

- [ ] **A.** Il ne conserve que les logs de niveau `error` et supérieur
- [ ] **B.** Il formate un enregistrement en tableau associatif de valeurs scalaires, plus `null` ; les objets et tableaux sont encodés en JSON
- [ ] **C.** Il convertit chaque log en une seule valeur numérique
- [ ] **D.** Il est un simple alias de `monolog.formatter.json`

## Annexe — Ajouter des données aux logs via un Processor

### Question 48

Qu'est-ce qu'un « processor » Monolog, et à quel niveau peut-il s'appliquer ? *(une seule bonne réponse)*

- [ ] **A.** Un callable qui reçoit l'enregistrement de log en premier argument, et qui peut être appliqué à toute la pile de handlers, ou seulement à un handler ou canal spécifique
- [ ] **B.** Un service qui traite les logs de manière asynchrone via Messenger
- [ ] **C.** Un formatter spécialisé pour les logs JSON
- [ ] **D.** Une classe qui remplace entièrement `LoggerInterface`

### Question 49

Comment un processor est-il déclaré/enregistré auprès de Monolog ? *(une seule bonne réponse)*

- [ ] **A.** Via le tag de service `monolog.processor`
- [ ] **B.** En implémentant automatiquement l'interface `LoggerAwareInterface`
- [ ] **C.** En le déclarant dans `config/packages/processors.yaml`
- [ ] **D.** Il n'y a pas de mécanisme de déclaration, tous les services publics sont candidats

### Question 50

Dans l'exemple `SessionRequestProcessor`, quelle interface le processor implémente-t-il, et quelle est la signature de sa méthode principale ? *(une seule bonne réponse)*

- [ ] **A.** `ProcessorInterface`, avec `__invoke(LogRecord $record): LogRecord`
- [ ] **B.** `LoggerAwareInterface`, avec `setLogger(LoggerInterface $logger): void`
- [ ] **C.** `EventSubscriberInterface`, avec `onKernelRequest()`
- [ ] **D.** `CallbackInterface`, avec `__invoke(CacheItemInterface $item, bool &$save)`

### Question 51

Que fait ce processor si aucune session n'est disponible (`SessionNotFoundException`) ou si la session n'est pas démarrée ? *(une seule bonne réponse)*

- [ ] **A.** Il lève une exception fatale, interrompant le traitement du log
- [ ] **B.** Il retourne l'enregistrement (`$record`) inchangé, sans y ajouter de token
- [ ] **C.** Il force le démarrage d'une nouvelle session
- [ ] **D.** Il remplace le message de log par un message d'erreur générique

### Question 52

Comment un processor personnalisé peut-il être enregistré sans ajouter manuellement le tag `monolog.processor` en configuration ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, le tag manuel est obligatoire
- [ ] **B.** En utilisant l'attribut `#[AsMonologProcessor]` directement sur la classe, ou une méthode
- [ ] **C.** En nommant la classe avec le suffixe `Processor`
- [ ] **D.** En l'enregistrant comme handler plutôt que comme service classique

### Question 53

Quels arguments optionnels l'attribut `#[AsMonologProcessor]` accepte-t-il ? *(plusieurs bonnes réponses)*

- [ ] **A.** `channel` : le canal auquel le processor doit être appliqué
- [ ] **B.** `handler` : le handler auquel le processor doit être appliqué
- [ ] **C.** `method` : la méthode qui traite les enregistrements, utile en l'appliquant sur toute la classe
- [ ] **D.** `priority` : l'ordre d'exécution du processor par rapport aux autres

### Question 54

Parmi ces processors fournis par le MonologBridge de Symfony, lesquels correspondent à leur description réelle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `TokenProcessor` : ajoute des informations du token de l'utilisateur courant (nom d'utilisateur, rôles, authentifié ou non)
- [ ] **B.** `WebProcessor` : surcharge les données à partir de l'objet requête de Symfony
- [ ] **C.** `RouteProcessor` : ajoute des informations sur la route courante (contrôleur, action, paramètres de route)
- [ ] **D.** `SwitchUserTokenProcessor` : ajoute des informations sur l'utilisateur qui a été déconnecté de force

### Question 55

Quel processor du MonologBridge ajoute des informations utiles au débogage, comme un horodatage ou un message d'erreur ? *(une seule bonne réponse)*

- [ ] **A.** `DebugProcessor`
- [ ] **B.** `ConsoleCommandProcessor`
- [ ] **C.** `RouteProcessor`
- [ ] **D.** `TokenProcessor`

### Question 56

Comment restreindre l'application d'un processor à un seul handler précis, par exemple `main` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, un processor s'applique toujours à toute la pile
- [ ] **B.** Avec l'option `handler` du tag `monolog.processor`
- [ ] **C.** En le déclarant dans la configuration du handler lui-même, jamais via un tag de service
- [ ] **D.** En renommant le service du processor à l'identique du handler

### Question 57

Par défaut, à quels canaux un processor est-il appliqué, et comment restreindre son application à un seul canal ? *(une seule bonne réponse)*

- [ ] **A.** Par défaut à tous les canaux ; on peut le restreindre via l'option `channel` du tag `monolog.processor`
- [ ] **B.** Par défaut à aucun canal, il faut toujours en préciser un
- [ ] **C.** Uniquement au canal `app`, sans possibilité de changement
- [ ] **D.** Par défaut au canal du handler principal, jamais aux autres

## Annexe — Le handler ElasticsearchLogstashHandler

### Question 58

Comment `ElasticsearchLogstashHandler` communique-t-il avec Elasticsearch, et quel impact cela peut-il avoir sur l'application ? *(une seule bonne réponse)*

- [ ] **A.** Il passe systématiquement par un fichier intermédiaire lu en tâche de fond, sans impact sur les performances
- [ ] **B.** Il utilise directement l'interface HTTP d'Elasticsearch, ce qui peut ralentir l'application si Elasticsearch met du temps à répondre, même avec des appels HTTP asynchrones
- [ ] **C.** Il utilise exclusivement le protocole TCP natif d'Elasticsearch
- [ ] **D.** Il ne fonctionne qu'avec Elasticsearch installé en local sur le même serveur

### Question 59

Parmi les arguments du constructeur d'`ElasticsearchLogstashHandler`, lesquels correspondent à leur valeur par défaut réelle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `$endpoint` par défaut `http://127.0.0.1:9200`
- [ ] **B.** `$index` par défaut `monolog`
- [ ] **C.** `$bubble` par défaut `true`
- [ ] **D.** `$level` par défaut `Level::Error`

### Question 60

Comment référence-t-on ce handler, une fois déclaré comme service, dans la configuration Monolog ? *(une seule bonne réponse)*

- [ ] **A.** Avec `type: service` et `id: <FQCN du handler>`
- [ ] **B.** Avec `type: elasticsearch` directement
- [ ] **C.** Il ne peut pas être référencé via `monolog.yaml`, seulement instancié en PHP
- [ ] **D.** Avec `type: stream` et un `path` pointant vers l'URL Elasticsearch

### Question 61

Que recommande la documentation en environnement de **production** pour l'usage de ce handler ? *(une seule bonne réponse)*

- [ ] **A.** De l'utiliser tel quel, sans précaution particulière
- [ ] **B.** De le désactiver complètement en production
- [ ] **C.** De le combiner à un handler de type `fingers_crossed` ou `group`, pour ne faire qu'un seul appel HTTP groupé plutôt qu'un appel par log
- [ ] **D.** De le remplacer entièrement par un handler `syslog`

### Question 62

Pour une meilleure performance et tolérance aux pannes, quelle solution la documentation recommande-t-elle en complément ? *(une seule bonne réponse)*

- [ ] **A.** Un vrai stack ELK (Elasticsearch/Logstash/Kibana)
- [ ] **B.** Un cluster Redis dédié aux logs
- [ ] **C.** Le handler `rotating_file` en complément
- [ ] **D.** Aucune solution supplémentaire n'est recommandée

## Annexe — Exclure des codes HTTP du log

### Question 63

À quoi sert l'option `excluded_http_codes` d'un handler `fingers_crossed` ? *(une seule bonne réponse)*

- [ ] **A.** À exclure du log certains codes HTTP bruyants et sans intérêt, par exemple 403 et 404
- [ ] **B.** À bloquer certaines routes de l'application
- [ ] **C.** À rediriger automatiquement ces codes vers une page d'erreur personnalisée
- [ ] **D.** À forcer le passage de ces codes au niveau `critical`

### Question 64

Que permet la syntaxe `excluded_http_codes: [403, 404, { 400: ['^/foo', '^/bar'] }]` ? *(une seule bonne réponse)*

- [ ] **A.** Exclure globalement les codes 403 et 404, et n'exclure le code 400 que pour les chemins correspondant aux patterns donnés
- [ ] **B.** Exclure uniquement le code 400, les autres valeurs étant ignorées
- [ ] **C.** Bloquer l'accès aux chemins `^/foo` et `^/bar` avec un code 400
- [ ] **D.** Cette syntaxe n'est pas valide, seule une liste plate d'entiers est acceptée

### Question 65

Quel piège la documentation signale-t-elle en combinant `excluded_http_codes` avec un `passthru_level` inférieur à `error`, par exemple `debug` ou `notice` ? *(une seule bonne réponse)*

- [ ] **A.** Aucun, les deux options sont totalement indépendantes
- [ ] **B.** Les codes HTTP normalement exclus ne le seront en réalité pas, car ils sont journalisés au niveau `error` ou supérieur et `passthru_level` prend le pas sur `excluded_http_codes`
- [ ] **C.** Cela provoque une erreur de configuration au démarrage de l'application
- [ ] **D.** Cela désactive complètement le handler `fingers_crossed`

## Annexe — Afficher les logs dans la console

### Question 66

Quel problème le `ConsoleHandler` du MonologBridge résout-il par rapport à l'usage manuel de méthodes comme `$output->isDebug()`/`isVerbose()` ? *(une seule bonne réponse)*

- [ ] **A.** Il évite d'avoir à conditionner chaque affichage à la verbosité manuellement : il écoute les événements de la console et écrit les messages de log selon le niveau de log et la verbosité courante
- [ ] **B.** Il remplace entièrement `OutputInterface`
- [ ] **C.** Il force toujours l'affichage de tous les messages, quelle que soit la verbosité
- [ ] **D.** Il ne concerne que les messages de niveau `error`

### Question 67

D'après le tableau de correspondance de la documentation, quelles paires méthode de `LoggerInterface` / option de ligne de commande sont correctes ? *(plusieurs bonnes réponses)*

- [ ] **A.** `->error()` correspond à `VERBOSITY_QUIET` et s'affiche sur `stderr`
- [ ] **B.** `->warning()` correspond à `VERBOSITY_NORMAL` et s'affiche sur `stdout`
- [ ] **C.** `->debug()` correspond à `VERBOSITY_DEBUG`, activé par `-vvv`
- [ ] **D.** `->notice()` correspond à `VERBOSITY_VERY_VERBOSE`, activé par `-vv`

### Question 68

Le `ConsoleHandler` est-il activé par défaut, et sur quel flux les logs d'erreur sont-ils en plus systématiquement écrits ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut l'activer explicitement dans chaque environnement
- [ ] **B.** Oui, il est activé par défaut ; les logs d'erreur sont en plus toujours écrits sur la sortie d'erreur (`php://stderr`)
- [ ] **C.** Oui, mais uniquement en environnement `prod`
- [ ] **D.** Oui, mais les logs d'erreur ne sont jamais dupliqués sur `stderr`

### Question 69

Dans l'exemple de configuration du handler `console`, pourquoi les canaux `event`, `doctrine` et `console` sont-ils exclus (`channels: ['!event', '!doctrine', '!console']`) ? *(une seule bonne réponse)*

- [ ] **A.** Parce que ces canaux n'existent pas réellement
- [ ] **B.** Pour réduire le bruit dans la console ; le canal `console` en particulier correspond aux événements du cycle de vie des commandes Symfony (ex. « Command exited with code »)
- [ ] **C.** Parce que ces canaux ne peuvent techniquement pas être affichés en console
- [ ] **D.** Pour forcer leur redirection systématique vers un fichier

### Question 70

Exclure le canal `console` du handler affecte-t-il les messages que l'on journalise soi-même à l'intérieur d'une commande ? *(une seule bonne réponse)*

- [ ] **A.** Oui, aucun message de log n'apparaît plus dans une commande une fois ce canal exclu
- [ ] **B.** Non : ces messages utilisent d'autres canaux et continuent de s'afficher normalement — seuls les événements de cycle de vie des commandes sont concernés
- [ ] **C.** Oui, mais uniquement les messages de niveau `debug`
- [ ] **D.** Cela dépend de la version de Symfony utilisée

### Question 71

À la verbosité normale (par défaut), quels niveaux de log sont affichés dans la console, et que se passe-t-il en mode « full verbosity » ? *(une seule bonne réponse)*

- [ ] **A.** Seuls les messages `warning` et supérieurs sont affichés par défaut ; en verbosité complète, tous les messages sont affichés
- [ ] **B.** Tous les messages sont affichés par défaut, y compris `debug`
- [ ] **C.** Aucun message n'est affiché par défaut, quelle que soit la verbosité
- [ ] **D.** Seuls les messages `error` sont jamais affichés, peu importe la verbosité

### Question 72

À quoi sert l'option `interactive_only: true` sur le handler `console` ? *(une seule bonne réponse)*

- [ ] **A.** Elle limite l'affichage des logs aux seules commandes interactives, au sens de demander une saisie utilisateur
- [ ] **B.** Quand elle vaut `true`, le handler console n'affiche des logs, et empêche leur propagation aux autres handlers, que lorsque la commande tourne dans un terminal interactif ; en mode non interactif (ex. `--no-interaction`, scripts automatisés), les logs sont propagés aux autres handlers à la place
- [ ] **C.** Elle désactive complètement le handler console dans tous les cas
- [ ] **D.** Elle n'a d'effet qu'en environnement `dev`

### Question 73

Dans quel type de contexte cette option `interactive_only` est-elle particulièrement utile, d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Dans les environnements automatisés comme les pipelines CI/CD ou les tâches cron, où la sortie des logs pourrait interférer avec la sortie de la commande ou créer un bruit inutile
- [ ] **B.** Uniquement pour les commandes nécessitant une authentification
- [ ] **C.** Uniquement pour les commandes Messenger (`messenger:consume`)
- [ ] **D.** Elle n'a aucun cas d'usage pratique documenté

### Question 74

Que signifie `type: console` dans la configuration d'un handler Monolog, et quelle classe cela sélectionne-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Il ne s'agit que d'un renommage arbitraire, sans lien avec une classe précise
- [ ] **B.** Cela sélectionne le `Symfony\Bridge\Monolog\Handler\ConsoleHandler`, qui écrit les messages de log vers la sortie de la commande
- [ ] **C.** Cela active le mode debug de la console Symfony
- [ ] **D.** Cela redirige tous les logs vers `bin/console debug:log`

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Logging de la documentation Symfony 8.0](https://symfony.com/doc/8.0/logging.html). Pour les questions 27 à 74, le nom abrégé de la page annexe précède la section — *(Email — § …)*, *(Channels — § …)*, *(Formatter — § …)*, *(Processors — § …)*, *(Handlers — § …)*, *(Exclude HTTP Codes — § …)*, *(Console — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : A** — « Symfony comes with two minimalist PSR-3 loggers: Logger for the HTTP context and ConsoleLogger for the CLI context. » *(introduction)*

**Question 2 : A** — « In conformance with the twelve-factor app methodology, they send messages starting from the WARNING level to stderr. » *(introduction)*

**Question 3 : A, B, C** — Tableau : `-1` → `ERROR`, `1` → `NOTICE`, `2` → `INFO`, `3` → `DEBUG`. D est faux : `1` correspond à `NOTICE`, pas `WARNING`. *(introduction)*

**Question 4 : B** — « The minimum log level, the default output and the log format can also be changed by passing the appropriate arguments to the constructor of Logger and ConsoleLogger. » *(introduction)*

**Question 5 : B** — « The Logger class is available through the logger service. To pass your configuration, you can override the "logger" service definition. » *(introduction)*

**Question 6 : A** — « $logger->debug('User {userId} has logged in', ['userId' => $this->getUserId()]); » *(§ Logging a Message)*

**Question 7 : A, B, C** — « It's easier to check log messages because many logging tools group log messages that are the same except for some variable values inside them; It's much easier to translate those log messages; It's better for security, because escaping can then be done by the implementation in a context-aware fashion. » D est faux : le contexte additionnel se passe via le second argument de la méthode, indépendamment des placeholders (ex. `$logger->critical('...', ['cause' => 'in_hurry'])`). *(§ Logging a Message)*

**Question 8 : A** — « The logger service has different methods for different logging levels/priorities. See LoggerInterface for a list of all of the methods on the logger. » *(§ Logging a Message)*

**Question 9 : A** — « Symfony integrates seamlessly with Monolog […] to create and store log messages in a variety of different places and trigger various actions. […] configure the logger to do different things based on the level of a message (e.g. send an email when an error occurs). » *(§ Monolog)*

**Question 10 : A** — « Run this command to install the Monolog based logger before using it: $ composer require symfony/monolog-bundle » *(§ Monolog)*

**Question 11 : A** — « By default, log entries are written to the var/log/dev.log file when you're in the dev environment. In the prod environment, logs are written to STDERR PHP stream, which works best in modern containerized applications deployed to servers without disk write permissions. » *(§ Where Logs are Stored)*

**Question 12 : B** — « If you prefer to store production logs in a file, set the path option of your log handler(s) to the desired file path […] Monolog creates the log directory automatically if it doesn't exist. » *(§ Where Logs are Stored)*

**Question 13 : A** — « The logger has a stack of handlers, and each can be used to write the log entries to different locations […] you can also configure logging "channels", which are like categories. Each channel can have its own handlers, which means you can store different log messages in different places. » *(§ Handlers: Writing Logs to different Locations)*

**Question 14 : A** — « Each handler can define a priority (default 0) to control its position in the stack. Handlers with a higher priority are called first, while those with the same priority keep the order in which they are defined. » *(§ Handlers: Writing Logs to different Locations)*

**Question 15 : B** — « When adding handlers in other configuration files, it's recommended to set an explicit priority to ensure they are ordered as expected. » *(§ Handlers: Writing Logs to different Locations)*

**Question 16 : B** — « Use the enabled option to enable or disable a handler without removing its configuration […] When enabled is set to false, the handler is completely ignored. » ; « The enabled option was introduced in Monolog 3.11.0. » *(§ Handlers: Writing Logs to different Locations)*

**Question 17 : B** — « It stores all log messages during a request but only passes them to a second handler if one of the messages reaches an action_level. » *(§ Handlers that Modify Log Entries)*

**Question 18 : B** — « Now, if even one log entry has an LogLevel::ERROR level or higher, then all log entries for that request are saved to a file via the file_log handler. That means that your log file will contain all the details about the problematic request. » *(§ Handlers that Modify Log Entries)*

**Question 19 : B** — « The handler named "file_log" will not be included in the stack itself as it is used as a nested handler of the fingers_crossed handler. » *(§ Handlers that Modify Log Entries)*

**Question 20 : B** — « Monolog comes with many built-in handlers for emailing logs, sending them to Loggly, or notifying you in Slack. These are documented inside of MonologBundle itself. For a full list, see Monolog Configuration. » *(§ All Built-in Handlers)*

**Question 21 : A** — « One best-practice solution is to use a tool like the logrotate Linux command […] Another option is to have Monolog rotate the files for you by using the rotating_file handler. » *(§ How to Rotate your Log Files)*

**Question 22 : A** — « This handler creates a new log file every day and can also remove old files automatically. […] max_files: max number of log files to keep, defaults to zero, which means infinite files. » *(§ How to Rotate your Log Files)*

**Question 23 : B** — « If your application uses service autoconfiguration, any service whose class implements Psr\Log\LoggerAwareInterface will receive a call to its method setLogger() with the default logger service passed as a service. » *(§ Using a Logger inside a Service)*

**Question 24 : A** — « If you want to use in your own services a pre-configured logger which uses a specific channel (app by default), you can either autowire monolog channels or use the monolog.logger tag with the channel property. » *(§ Using a Logger inside a Service)*

**Question 25 : B** — « Monolog also supports processors: functions that can dynamically add extra information to your log entries. » *(§ Adding extra Data to each Log)*

**Question 26 : A** — « logs can be accumulated into Monolog and cause some buffer overflow, memory increase or even non logical logs. Monolog in-memory data can be cleared using the reset() method on a Monolog\Logger instance. This should typically be called between every job or task. » *(§ Handling Logs in Long Running Processes)*

**Question 27 : A** — « main: type: fingers_crossed # 500 errors are logged at the critical level action_level: critical ». *(Email — introduction)*

**Question 28 : B** — « If you want both 400 level and 500 level errors to trigger an email, set the action_level to error instead of critical. » *(Email — introduction)*

**Question 29 : A** — « The deduplicated handler keeps all the messages for a request and then passes them onto the nested handler in one go, but only if the records are unique over a given period of time (60 seconds by default). Duplicated records are discarded. » *(Email — introduction)*

**Question 30 : B** — « The messages are then passed to the symfony_mailer handler. This is the handler that actually deals with emailing you the error. […] the to and from addresses, the formatter, the content type and the subject. » *(Email — introduction)*

**Question 31 : B** — « This uses the grouped handler to send the messages to the two group members, the deduplicated and the stream handlers. The messages will now be both written to the log file and emailed. » *(Email — introduction)*

**Question 32 : B** — Exemple : `formatter: monolog.formatter.html` et `content_type: text/html`. *(Email — introduction)*

**Question 33 : B** — Ceci est une règle générale de la configuration Symfony (échappement du caractère `%`), appliquée ici à `subject: 'An Error Occurred! %%message%%'` pour produire le placeholder Monolog `%message%`. *(Email — introduction)*

**Question 34 : A** — « The Symfony Framework organizes log messages into channels. By default, there are several channels, including app, doctrine, event, security, request and more. […] By default, Symfony logs every message into a single file (regardless of the channel). » *(Channels — introduction)*

**Question 35 : A** — « Each channel corresponds to a different logger service (monolog.logger.XXX) Use the php bin/console debug:container monolog command to see a full list of services. » *(Channels — introduction)*

**Question 36 : A** — « create a new handler and configure it to log only messages from the security channel » : `security: … channels: [security]`. *(Channels — § Switching a Channel to a different Handler)*

**Question 37 : A** — « The channels configuration only works for top-level handlers. Handlers that are nested inside a group, buffer, filter, fingers crossed or other such handler will ignore this configuration and will process every message passed to them. » *(Channels — § Switching a Channel to a different Handler)*

**Question 38 : A, B, C** — « channels: foo # Include only channel 'foo' … channels: '!foo' # Include all channels, except 'foo' … channels: [foo, bar] # Include only channels 'foo' and 'bar' ». D est faux : « omit the 'channels' option to include all channels ». *(Channels — § Switching a Channel to a different Handler)*

**Question 39 : B** — « You can also configure additional channels without the need to tag your services: monolog: channels: ['foo', 'bar', 'foo_bar'] Symfony automatically registers one service per channel (in this example, the channel foo creates a service called monolog.logger.foo). » *(Channels — § Configure Additional Channels without Tagged Services)*

**Question 40 : A** — « Starting from MonologBundle 3.5 you can autowire different Monolog channels by type-hinting your service arguments with the following syntax: Psr\Log\LoggerInterface $<camelCased channel name> + Logger. » *(Channels — § How to Autowire Logger Channels)*

**Question 41 : A** — « Starting from Monolog 3.5 you can also configure the logger channel by using the #[WithMonologChannel] attribute directly on your service class. » *(Channels — § Configure Logger Channels with Attributes)*

**Question 42 : A** — « The <channel> must have been predefined in your Monolog configuration. » *(Channels — § How to Autowire Logger Channels)*

**Question 43 : A** — « Each logging handler uses a Formatter to format the record before logging it. […] Your formatter must implement Monolog\Formatter\FormatterInterface. » *(Formatter — introduction)*

**Question 44 : B** — « All Monolog handlers use an instance of Monolog\Formatter\LineFormatter by default but you can replace it. » *(Formatter — introduction)*

**Question 45 : B** — Exemple : bloc `when@prod`, service `monolog.formatter.json`, puis `formatter: 'monolog.formatter.json'` sur le handler `file`. *(Formatter — introduction)*

**Question 46 : A, B, C** — « monolog.formatter.html: formats a record into an HTML table » ; « monolog.formatter.json: serializes a record into a JSON object » ; « monolog.formatter.logstash: serializes a record to Logstash Event Format ». D est faux : « monolog.formatter.line: formats a record into a one-line string », pas multi-lignes indenté. *(Formatter — introduction)*

**Question 47 : B** — « monolog.formatter.scalar: formats a record into an associative array of scalar (+ null) values (objects and arrays will be JSON encoded). » *(Formatter — introduction)*

**Question 48 : A** — « Monolog allows you to process every record before logging it by adding some extra data. This is the role of a processor, which can be applied for the whole handler stack or only for a specific handler or channel. » *(Processors — introduction)*

**Question 49 : A** — « Processors are configured using the monolog.processor DIC tag. » *(Processors — introduction)*

**Question 50 : A** — « class SessionRequestProcessor implements ProcessorInterface { … public function __invoke(LogRecord $record): LogRecord { … } } » *(Processors — § Adding a Session/Request Token)*

**Question 51 : B** — « try { $session = $this->requestStack->getSession(); } catch (SessionNotFoundException $e) { return $record; } if (!$session->isStarted()) { return $record; } » *(Processors — § Adding a Session/Request Token)*

**Question 52 : B** — « instead of adding the tag manually in your configuration files, you can use the #[AsMonologProcessor] attribute to apply it on the processor class. » *(Processors — § Adding a Session/Request Token)*

**Question 53 : A, B, C** — « The #[AsMonologProcessor] attribute takes these optional arguments: channel […] handler […] method: the method that processes the records (useful when applying the attribute to the entire class instead of a single method). » `priority` (D) n'est pas listé. *(Processors — § Adding a Session/Request Token)*

**Question 54 : A, B, C** — « TokenProcessor Adds information from the current user's token to the record namely username, roles and whether the user is authenticated. » ; « WebProcessor Overrides data from the request using the data inside Symfony's request object. » ; « RouteProcessor Adds information about current route (controller, action, route parameters). » D est faux : `SwitchUserTokenProcessor` documente l'utilisateur qui **usurpe l'identité** (« impersonating ») de l'utilisateur connecté, pas un utilisateur déconnecté de force. *(Processors — § Adding a Session/Request Token)*

**Question 55 : A** — « DebugProcessor Adds additional information useful for debugging like a timestamp or an error message to the record. » *(Processors — § Adding a Session/Request Token)*

**Question 56 : B** — « You can register a processor per handler using the handler option of the monolog.processor tag. » *(Processors — § Registering Processors per Handler)*

**Question 57 : A** — « By default, processors are applied to all channels. Add the channel option to the monolog.processor tag to only apply a processor for the given channel. » *(Processors — § Registering Processors per Channel)*

**Question 58 : B** — « This handler deals directly with the HTTP interface of Elasticsearch. This means it will slow down your application if Elasticsearch takes time to answer. Even if all HTTP calls are done asynchronously. » *(Handlers — § ElasticsearchLogstashHandler)*

**Question 59 : A, B, C** — Arguments par défaut : `$endpoint: "http://127.0.0.1:9200"`, `$index: "monolog"`, `$bubble: true`. D est faux : `$level: !php/enum Monolog\Level::Debug`, pas `Error`. *(Handlers — § ElasticsearchLogstashHandler)*

**Question 60 : A** — « es: type: service id: Symfony\Bridge\Monolog\Handler\ElasticsearchLogstashHandler ». *(Handlers — § ElasticsearchLogstashHandler)*

**Question 61 : C** — « it's highly recommended to wrap this handler in a handler with buffering capabilities (like the FingersCrossedHandler or BufferHandler) in order to call Elasticsearch only once with a bulk push. » *(Handlers — § ElasticsearchLogstashHandler)*

**Question 62 : A** — « For even better performance and fault tolerance, a proper ELK stack is recommended. » *(Handlers — § ElasticsearchLogstashHandler)*

**Question 63 : A** — « Sometimes your logs become flooded with unwanted HTTP errors, for example, 403s and 404s. When using a fingers_crossed handler, you can exclude logging these HTTP codes. » *(Exclude HTTP Codes — introduction)*

**Question 64 : A** — Exemple : `excluded_http_codes: [403, 404, { 400: ['^/foo', '^/bar'] }]`, qui exclut globalement 403/404 et n'exclut 400 que pour les chemins listés. *(Exclude HTTP Codes — introduction)*

**Question 65 : B** — « Combining excluded_http_codes with a passthru_level lower than error (i.e. debug, info, notice or warning) will not actually exclude log messages for those HTTP codes because they are logged with level of error or higher and passthru_level takes precedence over the HTTP codes being listed in excluded_http_codes. » *(Exclude HTTP Codes — introduction)*

**Question 66 : A** — « the MonologBridge provides a ConsoleHandler that listens to console events and writes log messages to the console output depending on the current log level and the console verbosity. » *(Console — introduction)*

**Question 67 : A, B, C** — Tableau : `->error()` → `VERBOSITY_QUIET` / stderr ; `->warning()` → `VERBOSITY_NORMAL` / stdout ; `->debug()` → `VERBOSITY_DEBUG` / `-vvv`. D est faux : `->notice()` correspond à `VERBOSITY_VERBOSE` (`-v`) ; c'est `->info()` qui correspond à `VERBOSITY_VERY_VERBOSE` (`-vv`). *(Console — introduction)*

**Question 68 : B** — « The Monolog console handler is enabled by default […] Additionally, error logs are written to the error output (php://stderr). » *(Console — introduction)*

**Question 69 : B** — « The console channel is excluded to reduce noise. This is the channel where Symfony logs command lifecycle events (e.g. Command "{command}" exited with code "{code}"). » *(Console — introduction)*

**Question 70 : B** — « Excluding this channel does not affect any log messages you write yourself inside your commands, which use different channels and will still appear normally. » *(Console — introduction)*

**Question 71 : A** — « By default (normal verbosity level), warnings and higher will be shown. But in full verbosity mode, all messages will be shown. » *(Console — introduction)*

**Question 72 : B** — « When interactive_only is set to true, the console handler will only output logs and prevent propagation to other handlers when the command is running in an interactive terminal. In non-interactive mode […] logs will be propagated to other handlers instead. » *(Console — § Limiting Output to Interactive Mode)*

**Question 73 : A** — « In automated environments like CI/CD pipelines or cron jobs, console log output may interfere with command output or create unnecessary clutter. » *(Console — § Limiting Output to Interactive Mode)*

**Question 74 : B** — « The type: console option selects the Symfony\Bridge\Monolog\Handler\ConsoleHandler, which writes log messages to the command output. » *(Console — introduction)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/logging.html#learn-more) de la page :

- [How to Configure Monolog to Email Errors](https://symfony.com/doc/8.0/logging/monolog_email.html) — questions 27 à 33
- [How to Log Messages to different Files](https://symfony.com/doc/8.0/logging/channels_handlers.html) — questions 34 à 42
- [How to Define a Custom Logging Formatter](https://symfony.com/doc/8.0/logging/formatter.html) — questions 43 à 47
- [How to Add extra Data to Log Messages via a Processor](https://symfony.com/doc/8.0/logging/processors.html) — questions 48 à 57
- [Handlers](https://symfony.com/doc/8.0/logging/handlers.html) — questions 58 à 62
- [How to Configure Monolog to Exclude Specific HTTP Codes from the Log](https://symfony.com/doc/8.0/logging/monolog_exclude_http_codes.html) — questions 63 à 65
- [How to Configure Monolog to Display Console Messages](https://symfony.com/doc/8.0/logging/monolog_console.html) — questions 66 à 74
