# QCM — Les commandes de console

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/console.html](https://symfony.com/doc/8.0/console.html) (questions 1 à 47) et les pages de sa section [Learn More](https://symfony.com/doc/8.0/console.html#learn-more) (questions 48 à 186) · **Généré le :** 21 juillet 2026
>
> **186 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Lister et exécuter les commandes, environnement et complétion

### Question 1

Comment lister toutes les commandes disponibles d'une application Symfony, et que se passe-t-il en exécutant `php bin/console` sans argument ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console list` ; c'est la commande par défaut, donc `php bin/console` seul fait la même chose
- [ ] **B.** `php bin/console commands` ; sans argument, rien ne s'affiche
- [ ] **C.** Il n'existe pas de commande listant toutes les commandes
- [ ] **D.** `php bin/console help --all`

### Question 2

Comment afficher la documentation d'une commande précise, par exemple `assets:install` ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant l'option `--help` à la commande
- [ ] **B.** En préfixant la commande par `man`
- [ ] **C.** Uniquement en consultant le code source
- [ ] **D.** Avec `php bin/console describe assets:install`

### Question 3

`--help` est-elle une option propre à chaque commande, ou une option globale ? *(une seule bonne réponse)*

- [ ] **A.** Une option propre, que chaque développeur doit implémenter manuellement
- [ ] **B.** Une option globale du composant Console, disponible pour toutes les commandes y compris celles qu'on crée soi-même
- [ ] **C.** Elle n'existe que pour les commandes internes de Symfony
- [ ] **D.** Elle nécessite l'installation d'un bundle tiers

### Question 4

Dans quel environnement les commandes console s'exécutent-elles par défaut, et via quelle variable cela se définit-il ? *(une seule bonne réponse)*

- [ ] **A.** `prod`, via `APP_DEBUG`
- [ ] **B.** `dev`, via `APP_ENV` — valeur par défaut du fichier `.env`
- [ ] **C.** `test`, toujours, quel que soit `.env`
- [ ] **D.** Il n'y a pas d'environnement par défaut pour les commandes

### Question 5

Comment lancer une commande dans un environnement différent sans modifier durablement le fichier `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans éditer `.env`
- [ ] **B.** En définissant la variable d'environnement au moment de l'exécution, par exemple `APP_ENV=prod php bin/console cache:clear`
- [ ] **C.** Uniquement via l'option `--environment=prod`
- [ ] **D.** En renommant `.env` en `.env.prod` temporairement

### Question 6

Quels shells sont pris en charge par le script de complétion (autocomplete) de Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement Bash
- [ ] **B.** Bash, Zsh et Fish
- [ ] **C.** PowerShell et Bash uniquement
- [ ] **D.** Tous les shells POSIX sans distinction

### Question 7

Comment installer le script de complétion, et à quelle fréquence faut-il le faire ? *(une seule bonne réponse)*

- [ ] **A.** À chaque lancement du terminal, via une commande dédiée
- [ ] **B.** Une seule fois, via `bin/console completion --help`, qui donne les instructions d'installation propres à son shell
- [ ] **C.** Il est installé automatiquement avec Symfony Flex, sans action requise
- [ ] **D.** Il faut le réinstaller après chaque mise à jour de Symfony

### Question 8

D'autres outils PHP basés sur le composant Console peuvent-ils aussi bénéficier de cette complétion, et à quelle condition ? *(une seule bonne réponse)*

- [ ] **A.** Non, la complétion est réservée aux commandes `bin/console`
- [ ] **B.** Oui, par exemple Composer, PHPStan ou Behat, à condition qu'ils utilisent la version 5.4 ou supérieure du composant Console
- [ ] **C.** Oui, mais uniquement s'ils sont écrits par l'équipe Symfony elle-même
- [ ] **D.** Oui, mais uniquement sur système Linux

## Créer une commande

### Question 9

Comment une commande invokable est-elle définie et enregistrée dans Symfony 8 ? *(une seule bonne réponse)*

- [ ] **A.** En étendant obligatoirement la classe `Command` et en implémentant `configure()`
- [ ] **B.** Dans une classe portant l'attribut `#[AsCommand(name: '...')]`, avec une méthode `__invoke()` — les commandes sont alors auto-enregistrées
- [ ] **C.** En l'ajoutant manuellement dans `config/commands.yaml`
- [ ] **D.** En la nommant `Command` dans le namespace `App\Console`

### Question 10

Que doit retourner la méthode `__invoke()` d'une commande, et que signifient les constantes `Command::SUCCESS` / `Command::FAILURE` / `Command::INVALID` ? *(une seule bonne réponse)*

- [ ] **A.** Un entier représentant le code de sortie ; `SUCCESS` = 0, `FAILURE` = 1, `INVALID` = 2 (usage incorrect, ex. option/argument invalide)
- [ ] **B.** Un booléen ; `true` pour succès
- [ ] **C.** Une instance de `Response`, comme pour un contrôleur HTTP
- [ ] **D.** Rien, la valeur de retour est ignorée par le composant Console

### Question 11

Si l'on ne peut pas utiliser les attributs PHP, comment enregistrer autrement une commande comme service ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible sans attribut
- [ ] **B.** En taguant le service avec `console.command` — déjà fait automatiquement grâce à l'autoconfiguration si la configuration par défaut de `services.yaml` est utilisée
- [ ] **C.** En la déclarant dans `config/packages/console.yaml`
- [ ] **D.** En implémentant `CommandInterface`

### Question 12

Que peut-on également définir via l'attribut `#[AsCommand]`, en plus du nom de la commande ? *(plusieurs bonnes réponses)*

- [ ] **A.** Une description, affichée par `list`
- [ ] **B.** Un texte d'aide affiché avec `--help`
- [ ] **C.** Des exemples d'usage (`usages`)
- [ ] **D.** Le niveau de log minimal de la commande

### Question 13

Pour bénéficier de fonctionnalités avancées comme les hooks de cycle de vie (`initialize()`, `interact()`), que doit faire une commande invokable ? *(une seule bonne réponse)*

- [ ] **A.** Rien de spécial, ces méthodes sont toujours disponibles
- [ ] **B.** Étendre la classe `Symfony\Component\Console\Command\Command`
- [ ] **C.** Implémenter `LifecycleAwareInterface`
- [ ] **D.** Ce n'est pas possible avec les commandes invokables, seulement avec la syntaxe historique

### Question 14

Comment définir des alias pour une commande, directement dans son nom ? *(une seule bonne réponse)*

- [ ] **A.** Via un tableau `aliases` séparé dans l'attribut
- [ ] **B.** En séparant les noms par un `|` dans le paramètre `name` — le premier nom devient le nom réel, les autres sont des alias
- [ ] **C.** Ce n'est pas possible, une commande n'a qu'un seul nom possible
- [ ] **D.** En créant une commande distincte qui appelle la première

### Question 15

`#[AsCommand(name: 'app:create-user|app:add-user|app:new-user')]` — combien de façons différentes existe-t-il pour lancer cette commande ? *(une seule bonne réponse)*

- [ ] **A.** Une seule, `app:create-user`, les autres noms sont ignorés
- [ ] **B.** Trois, `app:create-user`, `app:add-user` et `app:new-user` étant tous valides pour lancer la même commande
- [ ] **C.** Cela provoque une erreur, un seul nom pouvant être défini
- [ ] **D.** Deux seulement, le premier alias étant réservé à un usage interne

### Question 16

Une fois une commande configurée et enregistrée, mais sans logique dans `__invoke()`, que se passe-t-il en l'exécutant ? *(une seule bonne réponse)*

- [ ] **A.** Une erreur est levée automatiquement
- [ ] **B.** Elle s'exécute sans erreur mais ne fait rien, puisqu'aucune logique n'a été écrite
- [ ] **C.** Elle affiche automatiquement le contenu de `--help`
- [ ] **D.** Elle refuse de démarrer tant que `execute()` n'est pas défini

## Sortie console et output sections

### Question 17

Quelle est la différence entre `$output->writeln()` et `$output->write()` ? *(une seule bonne réponse)*

- [ ] **A.** `writeln()` ajoute un retour à la ligne (`\n`) après le message, `write()` n'en ajoute pas
- [ ] **B.** `write()` accepte un tableau de messages, `writeln()` non
- [ ] **C.** Elles sont strictement équivalentes
- [ ] **D.** `writeln()` n'existe que depuis Symfony 8.0

### Question 18

Que sont les « output sections », et à quoi servent-elles ? *(une seule bonne réponse)*

- [ ] **A.** Des sous-commandes exécutées en parallèle
- [ ] **B.** Des régions indépendantes de la sortie console qu'on peut effacer et réécrire séparément, créées via `ConsoleOutput::section()`
- [ ] **C.** Un synonyme des channels de logging
- [ ] **D.** Elles ne concernent que la coloration du texte

### Question 19

Quelle méthode remplace tout le contenu existant d'une section par un nouveau contenu ? *(une seule bonne réponse)*

- [ ] **A.** `clear()`
- [ ] **B.** `overwrite()`
- [ ] **C.** `replace()`
- [ ] **D.** `reset()`

### Question 20

Comment supprimer uniquement les deux dernières lignes d'une section, plutôt que tout son contenu ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `clear()` efface toujours tout
- [ ] **B.** En passant le nombre de lignes à `clear()`, par exemple `$section->clear(2)`
- [ ] **C.** `$section->clearLines(2)`
- [ ] **D.** En rappelant `overwrite('')` deux fois

### Question 21

Que fait `setMaxHeight()` sur une section ? *(une seule bonne réponse)*

- [ ] **A.** Elle limite le nombre total de caractères affichables
- [ ] **B.** Elle fait en sorte que les nouvelles lignes remplacent les anciennes une fois la hauteur maximale atteinte
- [ ] **C.** Elle empêche toute mise à jour de la section une fois cette hauteur atteinte
- [ ] **D.** Elle redimensionne automatiquement le terminal

### Question 22

Quelle limitation la documentation signale-t-elle concernant l'écrasement du contenu d'une section dans un terminal ? *(une seule bonne réponse)*

- [ ] **A.** Les terminaux ne permettent d'écraser que le contenu visible ; il faut donc tenir compte de la hauteur de la console
- [ ] **B.** Aucune limitation, cela fonctionne dans tous les cas
- [ ] **C.** Cela ne fonctionne que sous Linux
- [ ] **D.** Une section ne peut contenir qu'une seule ligne

## Entrée console, services et cycle de vie

### Question 23

Dans une commande invokable, quel attribut permet de définir un argument directement en paramètre de `__invoke()` ? *(une seule bonne réponse)*

- [ ] **A.** `#[Argument]`
- [ ] **B.** `#[Input]`
- [ ] **C.** `#[Param]`
- [ ] **D.** `#[CliArgument]`

### Question 24

Comment une commande accède-t-elle aux services de l'application, par exemple un `UserManager` ? *(une seule bonne réponse)*

- [ ] **A.** Via `$this->getContainer()->get(...)`, comme dans une ancienne Action Symfony
- [ ] **B.** Par injection de dépendances classique dans le constructeur, la commande étant déjà enregistrée comme service
- [ ] **C.** Ce n'est pas possible, les commandes n'ont pas accès aux services
- [ ] **D.** Uniquement via un service locator explicite `ServiceLocatorInterface`

### Question 25

Parmi les trois méthodes du cycle de vie d'une commande, laquelle est optionnelle et sert à initialiser des variables utilisées ensuite par les autres méthodes ? *(une seule bonne réponse)*

- [ ] **A.** `execute()` / `__invoke()`
- [ ] **B.** `initialize()`
- [ ] **C.** `interact()`
- [ ] **D.** `configure()`

### Question 26

Quel est le rôle de `interact()`, et quand n'est-elle **pas** appelée ? *(une seule bonne réponse)*

- [ ] **A.** Elle contient la logique principale de la commande ; elle n'est jamais appelée en mode `dev`
- [ ] **B.** Elle permet de demander interactivement les valeurs manquantes avant validation de l'input ; elle n'est pas appelée quand la commande tourne sans interaction, ex. `--no-interaction`
- [ ] **C.** Elle sert à journaliser les erreurs de la commande ; elle n'est jamais désactivable
- [ ] **D.** Elle configure les arguments et options ; elle n'est appelée qu'une seule fois par application

### Question 27

Quelle méthode est **obligatoire**, contrairement à `initialize()` et `interact()` ? *(une seule bonne réponse)*

- [ ] **A.** `configure()`
- [ ] **B.** `__invoke()` (ou `execute()`)
- [ ] **C.** `interact()`
- [ ] **D.** Aucune n'est obligatoire

### Question 28

Dans quel ordre ces trois méthodes sont-elles appelées lors de l'exécution d'une commande ? *(une seule bonne réponse)*

- [ ] **A.** `interact()`, puis `initialize()`, puis `execute()`
- [ ] **B.** `initialize()`, puis `interact()`, puis `execute()`/`__invoke()`
- [ ] **C.** `execute()`, puis `initialize()`, puis `interact()`
- [ ] **D.** L'ordre est indéterminé, dépendant du système d'exploitation

## Tester les commandes

### Question 29

Quelle classe est recommandée pour tester une commande sans passer par une vraie console ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Console\Tester\CommandTester`
- [ ] **B.** `Symfony\Component\HttpKernel\Test\CommandTestCase`
- [ ] **C.** `PHPUnit\Framework\ConsoleTestCase`
- [ ] **D.** `Symfony\Component\Process\Process`

### Question 30

Comment passer des arguments et des options à `CommandTester::execute()` ? *(une seule bonne réponse)*

- [ ] **A.** Dans un tableau associatif : les arguments par leur nom, les options préfixées de deux tirets, par exemple `'--some-option' => 'valeur'`
- [ ] **B.** Dans une chaîne unique reproduisant la ligne de commande complète
- [ ] **C.** Uniquement les arguments ; les options doivent être injectées via le constructeur
- [ ] **D.** Via une méthode séparée `setOptions()`

### Question 31

Comment tester une option de type `InputOption::VALUE_NONE` (un simple flag booléen) avec `CommandTester` ? *(une seule bonne réponse)*

- [ ] **A.** En passant `'--some-option' => null`
- [ ] **B.** En passant `'--some-option' => true`
- [ ] **C.** Ce type d'option ne peut pas être testé
- [ ] **D.** En omettant simplement la clé si elle n'est pas utilisée, sans autre précision

### Question 32

`CommandTester` dispatche-t-il les événements de la console pendant les tests, et quelle classe utiliser si on doit les tester ? *(une seule bonne réponse)*

- [ ] **A.** Oui, tous les événements sont dispatchés normalement
- [ ] **B.** Non, les événements de console ne sont pas dispatchés ; il faut utiliser `ApplicationTester` à la place pour les tester
- [ ] **C.** Non, et il n'existe aucun moyen de les tester
- [ ] **D.** Cela dépend de la version de PHPUnit utilisée

### Question 33

Quelle classe permet d'obtenir des informations comme la largeur/hauteur du terminal ou le mode couleur, utile pour comprendre comment une commande réagit à ces réglages ? *(une seule bonne réponse)*

- [ ] **A.** `Symfony\Component\Console\Terminal`
- [ ] **B.** `Symfony\Component\Console\Tester\TerminalTester`
- [ ] **C.** `Symfony\Component\Console\Helper\Terminal`
- [ ] **D.** Cette information n'est pas accessible en test

### Question 34

Pourquoi doit-on appeler `setAutoExit(false)` sur l'`Application` avant de l'utiliser avec `ApplicationTester` ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas nécessaire, `ApplicationTester` le fait automatiquement
- [ ] **B.** Sans cela, l'application appelle `exit()` après avoir exécuté la commande, ce qui terminerait le processus PHPUnit
- [ ] **C.** Pour activer le mode debug pendant les tests
- [ ] **D.** Pour permettre à plusieurs commandes de s'exécuter en parallèle

### Question 35

Pourquoi `CommandTester` ne permet-il pas d'accéder directement à des méthodes comme `section()`, et comment contourner cela ? *(une seule bonne réponse)*

- [ ] **A.** `CommandTester` n'implémente pas `ConsoleOutputInterface` ; il faut utiliser l'option `capture_stderr_separately` de `execute()`
- [ ] **B.** Ce n'est jamais possible de tester les output sections
- [ ] **C.** Il faut utiliser `ApplicationTester` exclusivement pour cela, `capture_stderr_separately` n'existant pas
- [ ] **D.** Il faut mocker manuellement `ConsoleOutputInterface`

### Question 36

Quel enregistrement Symfony ajoute-t-il automatiquement quand une commande se termine avec un code de sortie différent de `0` ? *(une seule bonne réponse)*

- [ ] **A.** Rien de particulier
- [ ] **B.** Un message de log, via un event subscriber qui écoute `ConsoleEvents::TERMINATE`
- [ ] **C.** Un email automatique à l'équipe de développement
- [ ] **D.** Une entrée dans le profiler uniquement, jamais dans les logs

## Journalisation des erreurs et événements de console

### Question 37

À quoi servent les événements de la console mentionnés dans la documentation, notamment vis-à-vis des signaux ? *(une seule bonne réponse)*

- [ ] **A.** Ils permettent, entre autres, de réagir aux signaux envoyés au processus
- [ ] **B.** Ils ne servent qu'au calcul du temps d'exécution
- [ ] **C.** Ils remplacent entièrement le cycle de vie `initialize()`/`interact()`/`execute()`
- [ ] **D.** Ils ne sont disponibles qu'en environnement `test`

## Gérer les signaux

### Question 38

Qu'est-ce qu'un « signal », d'après la documentation, et quel exemple concret est donné ? *(une seule bonne réponse)*

- [ ] **A.** Une notification asynchrone envoyée à un processus pour l'informer d'un événement, par exemple `SIGINT` envoyé quand on appuie sur `Ctrl+C`
- [ ] **B.** Un message HTTP envoyé entre deux commandes
- [ ] **C.** Un événement Symfony classique, dispatché via l'EventDispatcher
- [ ] **D.** Une entrée de log spécifique aux erreurs fatales

### Question 39

Quelle extension PHP doit être installée pour que les constantes de signaux (`SIGINT`, `SIGQUIT`…) soient disponibles ? *(une seule bonne réponse)*

- [ ] **A.** L'extension Sockets
- [ ] **B.** L'extension PCNTL
- [ ] **C.** L'extension Posix uniquement
- [ ] **D.** Aucune extension n'est nécessaire, elles sont définies par le composant Console lui-même

### Question 40

Comment une commande gère-t-elle elle-même certains signaux ? *(une seule bonne réponse)*

- [ ] **A.** En implémentant `SignalableCommandInterface`, avec `getSubscribedSignals()` et `handleSignal()`
- [ ] **B.** En surchargeant la méthode `onSignal()` héritée de `Command`
- [ ] **C.** Ce n'est pas possible au niveau d'une commande individuelle, seulement globalement via les événements
- [ ] **D.** En ajoutant l'attribut `#[HandlesSignal]`

### Question 41

Par défaut, Symfony gère-t-il les signaux reçus par une commande, même `SIGKILL`, et pourquoi ce comportement est-il volontaire ? *(une seule bonne réponse)*

- [ ] **A.** Oui, tous les signaux sont interceptés et neutralisés par défaut
- [ ] **B.** Non, Symfony ne gère aucun signal par défaut — ce choix laisse la flexibilité de gérer soi-même les signaux, par exemple pour exécuter des tâches avant l'arrêt de la commande
- [ ] **C.** Cela dépend uniquement du système d'exploitation, Symfony n'a aucune influence
- [ ] **D.** Seul `SIGTERM` est géré automatiquement, tous les autres sont ignorés

## Profiler les commandes

### Question 42

Comment activer le profilage d'une commande, et quelles conditions préalables sont nécessaires ? *(une seule bonne réponse)*

- [ ] **A.** Automatiquement, dès que le profiler est installé, sans option particulière
- [ ] **B.** En ajoutant l'option `--profile` à la commande, avec le mode debug et le profiler activés au préalable
- [ ] **C.** En ajoutant `#[Profile]` sur la classe de la commande
- [ ] **D.** Le profilage de commandes n'est pas supporté par Symfony

### Question 43

En mode verbeux (`-v`), que Symfony affiche-t-il en plus concernant le profil de la commande ? *(une seule bonne réponse)*

- [ ] **A.** Rien de plus qu'en mode normal
- [ ] **B.** Un lien cliquable vers le profil de la commande, si le terminal le supporte
- [ ] **C.** Le contenu intégral du profil directement dans la console
- [ ] **D.** Une notification système

### Question 44

Quelles précautions la documentation recommande-t-elle en profilant la commande `messenger:consume` ? *(une seule bonne réponse)*

- [ ] **A.** Ajouter l'option `--no-reset` (sinon aucun profil n'est obtenu), et envisager `--limit` pour ne traiter que quelques messages afin de garder un profil lisible
- [ ] **B.** Ne jamais profiler cette commande, ce n'est pas supporté
- [ ] **C.** Toujours utiliser `--time-limit=0`
- [ ] **D.** Désactiver le worker Messenger pendant le profilage

## Syntaxe historique de définition des commandes

### Question 45

Les deux syntaxes (invokable et héritant de `Command`) sont-elles toutes deux supportées, et laquelle est recommandée ? *(une seule bonne réponse)*

- [ ] **A.** Seule la syntaxe invokable est supportée, l'héritage de `Command` étant supprimé
- [ ] **B.** Les deux sont supportées, mais la syntaxe invokable est recommandée
- [ ] **C.** Les deux sont supportées à égalité, sans recommandation particulière
- [ ] **D.** Seul l'héritage de `Command` est officiellement supporté

### Question 46

Dans la syntaxe historique, où définit-on la description, l'aide et les arguments/options d'une commande ? *(une seule bonne réponse)*

- [ ] **A.** Dans le constructeur uniquement
- [ ] **B.** En surchargeant la méthode `configure()`
- [ ] **C.** Dans un fichier de configuration YAML dédié à chaque commande
- [ ] **D.** Dans la méthode `execute()` elle-même

### Question 47

Pourquoi la documentation recommande-t-elle d'utiliser l'attribut `#[AsCommand]` pour la description plutôt que `setDescription()` dans `configure()` ? *(une seule bonne réponse)*

- [ ] **A.** Cela n'a aucun impact, c'est purement stylistique
- [ ] **B.** Cela permet de récupérer la description sans instancier la classe de la commande, ce qui rend `php bin/console list` beaucoup plus rapide
- [ ] **C.** `setDescription()` est complètement supprimé de Symfony 8
- [ ] **D.** Parce que `configure()` ne peut pas être appelée avant l'exécution complète de la commande

---

> Les questions 48 à 186 couvrent les **9 pages « how-to »** et les **9 pages de helpers** listées dans la section [Learn More](https://symfony.com/doc/8.0/console.html#learn-more) (voir [Pour aller plus loin](#pour-aller-plus-loin)).

## Annexe — Appeler d'autres commandes

### Question 48

Quelle méthode utiliser pour appeler une autre commande depuis le code d'une commande, et quelle classe créer pour lui passer ses arguments/options ? *(une seule bonne réponse)*

- [ ] **A.** `Application::doRun()`, avec une instance d'`ArrayInput` contenant le nom de la commande et ses paramètres
- [ ] **B.** `Application::find()->execute()` directement
- [ ] **C.** `Kernel::handle()`
- [ ] **D.** `CommandRunner::invoke()`

### Question 49

Pourquoi utiliser `doRun()` plutôt que `run()` pour appeler une commande imbriquée ? *(une seule bonne réponse)*

- [ ] **A.** `doRun()` évite l'auto-exit et permet de récupérer le code de sortie ; utiliser `$application->doRun()` plutôt que `$application->find(...)->run()` permet aussi que les événements adéquats soient dispatchés pour cette commande interne
- [ ] **B.** `run()` est déprécié depuis Symfony 8.0
- [ ] **C.** `doRun()` est plus rapide car il ignore la validation des arguments
- [ ] **D.** Il n'y a aucune différence pratique entre les deux

### Question 50

Quel avertissement la documentation formule-t-elle sur le fait d'enchaîner des commandes dans le même process, en citant `cache:clear` et `cache:warmup` ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les commandes s'exécutent dans le même process ; certaines commandes internes de Symfony changent des définitions de classes, donc exécuter autre chose après elles risque de casser
- [ ] **B.** Ces deux commandes ne peuvent jamais être appelées via `doRun()`
- [ ] **C.** Il n'y a aucun risque documenté à ce sujet
- [ ] **D.** Cela ne concerne que l'environnement `prod`

### Question 51

Pourquoi la documentation déconseille-t-elle, la plupart du temps, d'appeler une commande depuis du code non exécuté en ligne de commande ? *(une seule bonne réponse)*

- [ ] **A.** Parce que la sortie de la commande est optimisée pour la console, pas pour être consommée par un autre code
- [ ] **B.** Parce que cela nécessite toujours un accès root
- [ ] **C.** Parce que les commandes n'ont pas accès aux services depuis un autre contexte
- [ ] **D.** Ce n'est pas déconseillé, c'est même l'approche recommandée par défaut

## Annexe — Appeler une commande depuis un contrôleur

### Question 52

Quel inconvénient la documentation signale-t-elle pour l'appel d'une commande console depuis un contrôleur, comparé à un appel direct en ligne de commande ? *(une seule bonne réponse)*

- [ ] **A.** Un léger impact sur les performances, dû au surcoût de la pile de requêtes (request stack)
- [ ] **B.** Cela ne fonctionne tout simplement pas
- [ ] **C.** Cela nécessite de désactiver le firewall de sécurité
- [ ] **D.** Cela nécessite obligatoirement une base de données

### Question 53

Dans quel cas la documentation recommande-t-elle malgré tout d'appeler directement une commande depuis un contrôleur, plutôt que de refactoriser sa logique dans un service ? *(une seule bonne réponse)*

- [ ] **A.** Systématiquement, c'est toujours préférable
- [ ] **B.** Quand la commande fait partie d'une bibliothèque tierce qu'on ne veut pas modifier ou dupliquer
- [ ] **C.** Uniquement pour les commandes `cache:clear` et `cache:warmup`
- [ ] **D.** Jamais, cette pratique n'est pas documentée

### Question 54

Quelle classe permet de capturer la sortie d'une commande exécutée depuis un contrôleur, pour la retourner ensuite dans une `Response` ? *(une seule bonne réponse)*

- [ ] **A.** `NullOutput`
- [ ] **B.** `BufferedOutput`
- [ ] **C.** `ConsoleOutput`
- [ ] **D.** `StreamOutput`

### Question 55

Comment obtenir une sortie colorée (codes ANSI) via `BufferedOutput`, et quel outil externe la documentation cite-t-elle pour la convertir en HTML ? *(une seule bonne réponse)*

- [ ] **A.** En passant `true` comme second paramètre du constructeur pour activer la décoration ; le convertisseur `sensiolabs/ansi-to-html` peut ensuite transformer ce contenu en HTML colorée
- [ ] **B.** La coloration ANSI n'est jamais accessible via `BufferedOutput`
- [ ] **C.** En installant `symfony/ansi-bundle`
- [ ] **D.** Il faut réécrire manuellement chaque code couleur en CSS

### Question 56

Que faut-il appeler sur l'`Application` avant de l'utiliser dans un contrôleur, pour éviter qu'elle ne termine le process PHP ? *(une seule bonne réponse)*

- [ ] **A.** `setAutoExit(false)`
- [ ] **B.** `setCatchExceptions(false)`
- [ ] **C.** `disableExit()`
- [ ] **D.** Rien de particulier, `run()` ne termine jamais le process depuis un contrôleur

## Annexe — Définir les commandes comme services

### Question 57

Si la configuration par défaut de `services.yaml` est utilisée, faut-il faire quoi que ce soit de spécial pour enregistrer une classe de commande comme service ? *(une seule bonne réponse)*

- [ ] **A.** Oui, il faut toujours ajouter un tag `console.command` manuellement
- [ ] **B.** Non, les classes de commande sont déjà enregistrées comme services automatiquement — c'est le setup recommandé
- [ ] **C.** Oui, il faut appeler `Kernel::registerCommand()`
- [ ] **D.** Non, mais il faut désactiver l'autowiring pour ce service précis

### Question 58

Peut-on accéder à des services depuis la méthode `configure()` d'une commande, et quelle précaution la documentation recommande-t-elle si la commande n'est pas lazy ? *(une seule bonne réponse)*

- [ ] **A.** Non, `configure()` n'a jamais accès aux services
- [ ] **B.** Oui, on y a accès ; mais si la commande n'est pas lazy, il faut éviter d'y effectuer un travail coûteux, ex. requêtes en base, car ce code s'exécute même si on utilise la console pour lancer une *autre* commande
- [ ] **C.** Oui, mais uniquement pour les commandes taguées `console.command.lazy`
- [ ] **D.** Non, sauf si la commande étend `Command` et pas `AsCommand`

### Question 59

Comment rendre lazy le chargement d'une commande définie via l'attribut `#[AsCommand]` ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant `lazy: true` à l'attribut
- [ ] **B.** Simplement en définissant son nom via l'attribut `AsCommand` — cela suffit à la rendre lazy
- [ ] **C.** Ce n'est possible qu'en enregistrant la commande manuellement dans `services.yaml`
- [ ] **D.** En implémentant `LazyCommandInterface`

### Question 60

Que se passe-t-il quand on exécute la commande `list`, vis-à-vis des commandes lazy ? *(une seule bonne réponse)*

- [ ] **A.** Les commandes lazy ne sont jamais instanciées, seul leur nom est affiché
- [ ] **B.** `list` instancie toutes les commandes, y compris les lazy ; mais si la commande est une `LazyCommand`, sa factory sous-jacente n'est elle-même pas exécutée
- [ ] **C.** `list` échoue si des commandes lazy existent
- [ ] **D.** Seules les commandes non lazy apparaissent dans `list`

## Annexe — Masquer des commandes

### Question 61

Comment masquer une commande pour qu'elle n'apparaisse pas dans `list`, tout en restant exécutable directement par son nom ? *(une seule bonne réponse)*

- [ ] **A.** En définissant `hidden: true` sur l'attribut `#[AsCommand]`
- [ ] **B.** En préfixant son nom par un underscore
- [ ] **C.** Ce n'est pas possible, toutes les commandes enregistrées apparaissent forcément
- [ ] **D.** En la déclarant dans un fichier `hidden_commands.yaml`

### Question 62

Quelle syntaxe alternative, basée sur les alias, permet aussi de masquer une commande ? *(une seule bonne réponse)*

- [ ] **A.** Utiliser le nom de la commande comme un des alias séparés par `|`, en laissant vide le nom principal avant le premier `|`, par exemple `'|app:legacy'`
- [ ] **B.** Ajouter le préfixe `hidden:` devant le nom
- [ ] **C.** Utiliser deux pipes consécutifs `||`
- [ ] **D.** Cette syntaxe alternative n'existe pas, seul l'attribut `hidden` fonctionne

### Question 63

Les commandes masquées restent-elles accessibles via un descripteur JSON ou XML ? *(une seule bonne réponse)*

- [ ] **A.** Non, elles sont totalement invisibles, y compris via ces formats
- [ ] **B.** Oui, les commandes masquées restent disponibles via les descripteurs JSON ou XML
- [ ] **C.** Uniquement via le descripteur XML, pas JSON
- [ ] **D.** Cela dépend de la version de Symfony

## Annexe — Charger les commandes de façon paresseuse (lazy)

### Question 64

Pourquoi vouloir lazy-loader certaines commandes selon la documentation du composant Console ? *(une seule bonne réponse)*

- [ ] **A.** Pour des raisons purement esthétiques dans l'affichage de `list`
- [ ] **B.** Parce que certaines commandes peuvent être coûteuses à instancier
- [ ] **C.** Parce que Symfony l'exige pour toute application de plus de 10 commandes
- [ ] **D.** Uniquement pour des raisons de sécurité

### Question 65

Le lazy-loading est-il absolu, d'après la documentation ? Quel exemple de commande interne montre une limite à cela ? *(une seule bonne réponse)*

- [ ] **A.** Oui, une commande lazy n'est jamais instanciée avant son exécution, sans exception
- [ ] **B.** Non : par exemple `list` doit récupérer le nom et la description de toutes les commandes, ce qui peut nécessiter de les instancier même si elles sont lazy
- [ ] **C.** Non, aucune commande native de Symfony n'utilise le lazy-loading
- [ ] **D.** Oui, sauf pour la commande `help`

### Question 66

Pour enregistrer un chargeur de commandes lazy au niveau du composant Console (hors framework complet), quelle méthode de `Application` utiliser ? *(une seule bonne réponse)*

- [ ] **A.** `Application::setCommandLoader()`, qui accepte toute implémentation de `CommandLoaderInterface`
- [ ] **B.** `Application::add()`, qui accepte directement un callable
- [ ] **C.** `Application::lazyLoad()`
- [ ] **D.** Il n'existe pas de mécanisme de chargeur, seul l'attribut `AsCommand` permet la lazy-loading

### Question 67

Que fait la classe `FactoryCommandLoader`, et quel type d'argument prend son constructeur ? *(une seule bonne réponse)*

- [ ] **A.** Elle charge les commandes depuis un container PSR-11
- [ ] **B.** Elle prend un tableau de « factories » de commandes (callables), chacune exécutée à chaque appel de `get()`
- [ ] **C.** Elle ne fonctionne qu'avec des commandes déjà instanciées
- [ ] **D.** Elle génère automatiquement le nom des commandes à partir du nom de la classe

### Question 68

Que fait la classe `ContainerCommandLoader`, et quels arguments reçoit son constructeur ? *(une seule bonne réponse)*

- [ ] **A.** Elle charge les commandes depuis un container PSR-11, avec en arguments le container et une map `nom de commande => id de service`
- [ ] **B.** Elle instancie directement les commandes sans passer par un container
- [ ] **C.** Elle ne fonctionne qu'avec le container Symfony natif, pas avec n'importe quel container PSR-11
- [ ] **D.** Elle prend uniquement une liste de noms de classes, sans map

## Annexe — Empêcher l'exécution multiple d'une commande

### Question 69

Quel trait le composant Console fournit-il pour empêcher qu'une même commande tourne plusieurs fois simultanément sur un serveur ? *(une seule bonne réponse)*

- [ ] **A.** `LockableTrait`
- [ ] **B.** `SingleRunTrait`
- [ ] **C.** `MutexTrait`
- [ ] **D.** `ExclusiveCommandTrait`

### Question 70

Quelles méthodes ce trait ajoute-t-il à une commande ? *(une seule bonne réponse)*

- [ ] **A.** `lock()` et `release()`
- [ ] **B.** `acquire()` et `free()`
- [ ] **C.** `mutex()` et `unmutex()`
- [ ] **D.** `start()` et `stop()`

### Question 71

Quel store de verrouillage `LockableTrait` utilise-t-il par défaut, et lequel en repli si celui-ci n'est pas disponible ? *(une seule bonne réponse)*

- [ ] **A.** `SemaphoreStore` par défaut si disponible, sinon repli sur `FlockStore`
- [ ] **B.** `FlockStore` uniquement, sans alternative
- [ ] **C.** Une base de données Redis par défaut
- [ ] **D.** `PdoStore` par défaut, avec repli sur `FlockStore`

### Question 72

Si le verrou n'est pas explicitement relâché via `release()`, que se passe-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Le verrou reste actif indéfiniment, bloquant toute exécution future
- [ ] **B.** Symfony le relâche automatiquement à la fin de l'exécution de la commande
- [ ] **C.** Il faut redémarrer le serveur pour le libérer
- [ ] **D.** Une exception fatale est levée

## Annexe — Niveaux de verbosité

### Question 73

Quelles options de ligne de commande permettent de contrôler la verbosité, du plus silencieux au plus verbeux ? *(une seule bonne réponse)*

- [ ] **A.** `--silent`, `-q`/`--quiet`, aucune option pour le mode normal, `-v`, `-vv`, `-vvv`
- [ ] **B.** `--level=0` à `--level=5`
- [ ] **C.** Uniquement `-v` répétable un nombre arbitraire de fois
- [ ] **D.** `--verbosity=low/medium/high`

### Question 74

Quelle est la différence entre `--silent` et `-q`/`--quiet` ? *(une seule bonne réponse)*

- [ ] **A.** Elles sont strictement identiques
- [ ] **B.** `--silent` supprime absolument toute sortie, y compris les erreurs ; `-q`/`--quiet` supprime la sortie normale mais affiche quand même les erreurs
- [ ] **C.** `-q` est plus restrictif que `--silent`
- [ ] **D.** `--silent` n'affecte que les messages de niveau `debug`

### Question 75

Comment contrôler la verbosité globalement pour toutes les commandes, via une variable d'environnement, et quelle priorité cela a-t-il face aux options `-v`/`-q` ? *(une seule bonne réponse)*

- [ ] **A.** Via `SHELL_VERBOSITY` ; les options `-q` et `-v` de la ligne de commande restent malgré tout prioritaires sur cette variable
- [ ] **B.** Via `CONSOLE_VERBOSITY`, qui prend toujours le dessus sur `-v`/`-q`
- [ ] **C.** Ce n'est pas possible de le faire globalement
- [ ] **D.** Via `APP_DEBUG` uniquement

### Question 76

Quelles méthodes sur `OutputInterface` permettent de tester le niveau de verbosité courant dans le code d'une commande ? *(une seule bonne réponse)*

- [ ] **A.** `isSilent()`, `isQuiet()`, `isVerbose()`, `isVeryVerbose()`, `isDebug()`
- [ ] **B.** `getVerbosityLevel()` uniquement, à comparer manuellement
- [ ] **C.** `checkVerbosity(int $level)`
- [ ] **D.** Il n'existe aucune méthode de ce type, il faut lire `SHELL_VERBOSITY` soi-même

### Question 77

En mode silencieux ou quiet, que fait concrètement la méthode `Output::write()` par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Elle lève une exception
- [ ] **B.** Elle retourne sans rien afficher réellement
- [ ] **C.** Elle redirige tout vers un fichier de log
- [ ] **D.** Elle continue d'afficher normalement, seule la coloration change

## Annexe — Entrées console : arguments et options

### Question 78

Comment l'attribut `#[Argument]` détermine-t-il si un argument est requis, optionnel, ou accepte un tableau de valeurs ? *(une seule bonne réponse)*

- [ ] **A.** Ces modes se configurent uniquement via un paramètre explicite `mode:` de l'attribut
- [ ] **B.** Le mode est déduit du type du paramètre : requis si pas de valeur par défaut et non nullable, optionnel s'il a une valeur par défaut, tableau si le type est `array`
- [ ] **C.** Tous les arguments définis via l'attribut sont toujours optionnels
- [ ] **D.** Le mode dépend uniquement de l'ordre des paramètres dans `__invoke()`

### Question 79

Par défaut, comment le nom affiché d'un argument ou d'une option est-il dérivé du nom du paramètre PHP, par exemple `$lastName` ? *(une seule bonne réponse)*

- [ ] **A.** Il reste identique au nom du paramètre
- [ ] **B.** Il est converti en kebab-case, par exemple `$lastName` devient `last-name`
- [ ] **C.** Il est converti en snake_case
- [ ] **D.** Il faut toujours le préciser explicitement, aucune conversion automatique n'existe

### Question 80

Peut-on utiliser un type `BackedEnum` pour un argument ou une option, et que se passe-t-il si la valeur fournie ne correspond à aucun cas de l'enum ? *(une seule bonne réponse)*

- [ ] **A.** Non, ce n'est pas supporté
- [ ] **B.** Oui : la valeur saisie est automatiquement convertie via `BackedEnum::from()`, avec autocomplétion ; si elle ne correspond à aucun cas, un message d'erreur listant les valeurs valides est affiché
- [ ] **C.** Oui, mais sans autocomplétion possible
- [ ] **D.** Oui, mais uniquement pour les arguments, jamais pour les options

### Question 81

Quelles affirmations sur les trois variantes d'`InputArgument` (méthode classique `addArgument()`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `REQUIRED` rend la commande impossible à exécuter si l'argument est absent
- [ ] **B.** `OPTIONAL` est le comportement par défaut d'un argument
- [ ] **C.** `IS_ARRAY` doit être utilisé en dernière position dans la liste des arguments
- [ ] **D.** `IS_ARRAY` ne peut jamais être combiné avec `REQUIRED` ou `OPTIONAL`

### Question 82

Comment un attribut `#[Option]` détermine-t-il qu'une option doit être un simple flag booléen (`VALUE_NONE`) ? *(une seule bonne réponse)*

- [ ] **A.** Type `bool` avec valeur par défaut `false`
- [ ] **B.** Type `bool` avec valeur par défaut `true`
- [ ] **C.** Type `string` avec valeur par défaut vide
- [ ] **D.** Il faut toujours le préciser explicitement via un paramètre `flag: true`

### Question 83

Comment obtenir une option « négatable » (utilisable en `--yell` ou `--no-yell`) via l'attribut `#[Option]` ? *(une seule bonne réponse)*

- [ ] **A.** Type `bool` avec valeur par défaut `true`, ou `?bool` avec valeur par défaut `null`
- [ ] **B.** Type `string` acceptant uniquement `'yes'`/`'no'`
- [ ] **C.** Ce n'est possible qu'avec la méthode classique `addOption()`, pas avec l'attribut
- [ ] **D.** En ajoutant `negatable: true` en paramètre de l'attribut, quel que soit le type

### Question 84

Comment obtenir une option dont la valeur est optionnelle (« value optional »), c'est-à-dire utilisable en `--output` seul ou en `--output=file.txt` ? *(une seule bonne réponse)*

- [ ] **A.** Un type union `string|bool` (ou `int|bool`, `float|bool`) avec une valeur par défaut `false`
- [ ] **B.** Un simple type `?string`
- [ ] **C.** Ce n'est pas possible avec les attributs, uniquement avec `addOption()`
- [ ] **D.** Un type `array` avec une valeur par défaut vide

### Question 85

Quelles affirmations sur les variantes d'`InputOption` (méthode classique `addOption()`) sont vraies ? *(plusieurs bonnes réponses)*

- [ ] **A.** `VALUE_NONE` est le comportement par défaut d'une option
- [ ] **B.** `VALUE_NEGATABLE` accepte à la fois le flag et sa négation, ex. `--yell`/`--no-yell`
- [ ] **C.** `VALUE_IS_ARRAY` doit être combinée avec `VALUE_REQUIRED` ou `VALUE_OPTIONAL`
- [ ] **D.** `VALUE_REQUIRED` rend l'option elle-même obligatoire à passer sur la ligne de commande

### Question 86

Pourquoi la documentation déconseille-t-elle de séparer un nom d'option long de sa valeur par un espace lorsqu'on place l'option *avant* le nom de la commande ? *(une seule bonne réponse)*

- [ ] **A.** Cela provoque toujours une erreur fatale immédiate
- [ ] **B.** Cela crée une ambiguïté : `php bin/console --iterations 5 app:greet Fabien` ferait interpréter `5` comme le nom de la commande
- [ ] **C.** Les espaces ne sont jamais autorisés dans les options longues, uniquement les `=`
- [ ] **D.** Cela ne fonctionne que sur Windows

### Question 87

À quoi sert l'attribut `#[MapInput]`, et quelles propriétés d'une classe DTO cible sont prises en compte ? *(une seule bonne réponse)*

- [ ] **A.** À grouper arguments et options dans une classe dédiée (DTO) ; seules les propriétés **publiques** portant `#[Argument]` ou `#[Option]` sont prises en compte
- [ ] **B.** À valider automatiquement toutes les propriétés via le composant Validator
- [ ] **C.** À transformer n'importe quelle classe PHP en commande console
- [ ] **D.** Seules les propriétés privées sont prises en compte, pour respecter l'encapsulation

### Question 88

Le constructeur d'un DTO d'input, utilisé avec `#[MapInput]`, est-il appelé lors de l'instanciation ? *(une seule bonne réponse)*

- [ ] **A.** Oui, toujours, avec les valeurs déjà résolues en arguments
- [ ] **B.** Non : le DTO est instancié sans appeler son constructeur, les valeurs étant assignées directement aux propriétés publiques
- [ ] **C.** Oui, mais uniquement si le DTO n'a aucune propriété publique
- [ ] **D.** Cela dépend de la version de PHP utilisée

### Question 89

Si l'on souhaite transformer ou valider une valeur d'entrée au moment où elle est assignée à une propriété du DTO, puisque le constructeur n'est pas appelé, quelle fonctionnalité PHP la documentation recommande-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** Les property hooks
- [ ] **B.** Les traits
- [ ] **C.** Les attributs `#[Validate]`
- [ ] **D.** Ce n'est tout simplement pas possible

### Question 90

Que fait l'attribut `#[Ask]` posé sur un paramètre `#[Argument]`, et sur quel type de paramètres peut-il être utilisé ? *(une seule bonne réponse)*

- [ ] **A.** Il déclenche l'affichage automatique de `--help` ; utilisable sur tout type de paramètre
- [ ] **B.** Il invite interactivement l'utilisateur à fournir la valeur manquante ; il ne peut être utilisé qu'avec des arguments **requis**, pas avec des options ni des arguments optionnels
- [ ] **C.** Il force toujours l'utilisateur à répondre, même en mode `--no-interaction`
- [ ] **D.** Il ne fonctionne que combiné à `#[Option]`

### Question 91

Que se passe-t-il automatiquement si le paramètre associé à `#[Ask]` est de type `bool` ? *(une seule bonne réponse)*

- [ ] **A.** Une erreur est levée, `#[Ask]` ne supportant pas les booléens
- [ ] **B.** L'attribut utilise automatiquement une question de confirmation oui/non
- [ ] **C.** L'utilisateur doit taper `true` ou `false` littéralement
- [ ] **D.** Le paramètre est ignoré et sa valeur par défaut est utilisée

### Question 92

À quoi sert l'attribut `#[Interact]`, et quelle contrainte porte-t-il sur la méthode qu'il annote ? *(une seule bonne réponse)*

- [ ] **A.** À marquer une méthode personnalisée appelée durant la phase interactive ; cette méthode doit être publique et non statique
- [ ] **B.** À remplacer entièrement `__invoke()`
- [ ] **C.** Il ne peut être utilisé que sur la classe de la commande, jamais sur un DTO
- [ ] **D.** Il doit obligatoirement être combiné avec `#[Ask]` sur le même paramètre

### Question 93

Quand `#[Ask]` et `#[Interact]` sont utilisés ensemble, dans quel ordre s'exécutent-ils durant la phase interactive ? *(une seule bonne réponse)*

- [ ] **A.** `#[Interact]` sur la commande, puis `#[Interact]` sur le DTO, puis les `#[Ask]`
- [ ] **B.** `#[Ask]` sur les paramètres de `__invoke()`, puis `#[Ask]` sur les propriétés du DTO, puis `#[Interact]` sur le DTO, puis `#[Interact]` sur la commande
- [ ] **C.** L'ordre est aléatoire à chaque exécution
- [ ] **D.** Seul le premier attribut rencontré dans le code source est exécuté

### Question 94

Pour une option `VALUE_OPTIONAL`, par exemple `--yell`, comment distinguer le cas « option non passée » du cas « option passée sans valeur » ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est jamais possible de distinguer ces deux cas
- [ ] **B.** En donnant à l'option une valeur par défaut `false` plutôt que `null` : `false` signifie « non passée », `null` signifie « passée sans valeur »
- [ ] **C.** En vérifiant uniquement si la chaîne retournée est vide
- [ ] **D.** Ces deux cas sont toujours traités de façon strictement identique

### Question 95

Quelle méthode permet de récupérer les tokens bruts passés à une commande, par exemple pour les retransmettre tels quels à un autre process ? *(une seule bonne réponse)*

- [ ] **A.** `InputInterface::getRawArguments()`
- [ ] **B.** `ArgvInput::getRawTokens()`
- [ ] **C.** `Input::getCommandLine()`
- [ ] **D.** Cette information n'est pas accessible depuis le code de la commande

### Question 96

Comment fournir des suggestions de complétion de valeurs pour un argument ou une option défini via attribut, et quelle méthode dédiée permet de tester cette complétion ? *(une seule bonne réponse)*

- [ ] **A.** Via le paramètre `suggestedValues` de `#[Argument]`/`#[Option]` (valeur statique ou callable) ; testable via `CommandCompletionTester`
- [ ] **B.** Ce n'est possible qu'avec la méthode classique `addArgument()`/`addOption()`, jamais avec les attributs
- [ ] **C.** Via un fichier `completion.yaml` dédié, sans code PHP
- [ ] **D.** Il n'existe pas d'outil de test dédié à la complétion

### Question 97

Parmi ces options globales, lesquelles sont prédéfinies pour **toutes** les commandes par le composant Console seul, sans nécessiter le FrameworkBundle ? *(plusieurs bonnes réponses)*

- [ ] **A.** `--verbose`/`-v`
- [ ] **B.** `--no-interaction`/`-n`
- [ ] **C.** `--profile`
- [ ] **D.** `--env`/`-e`

## Annexe — Styliser une commande console

### Question 98

Quel est l'objectif du « Symfony Style Guide » (`SymfonyStyle`) pour l'écriture de commandes ? *(une seule bonne réponse)*

- [ ] **A.** Forcer un format de sortie unique, sans personnalisation possible
- [ ] **B.** Fournir un ensemble de méthodes helper pour styliser input/output de façon cohérente, en évitant le code répétitif de mise en forme
- [ ] **C.** Remplacer entièrement `OutputInterface`
- [ ] **D.** Gérer uniquement la coloration, sans aucune autre fonctionnalité

### Question 99

Comment injecter le style Symfony dans une commande invokable, et quelle méthode affiche le titre de la commande ? *(une seule bonne réponse)*

- [ ] **A.** En typant un argument de `__invoke()` avec `SymfonyStyle`, puis en appelant `$io->title('...')`
- [ ] **B.** En instanciant manuellement `new Style()` dans le constructeur
- [ ] **C.** `$output->setStyle('title', '...')`
- [ ] **D.** Il n'existe pas de méthode dédiée au titre, il faut composer le texte soi-même

### Question 100

Quelle différence sépare `title()` de `section()` sur `SymfonyStyle` ? *(une seule bonne réponse)*

- [ ] **A.** `title()` est destiné à être utilisé une seule fois pour le titre de la commande ; `section()` sert à structurer des sous-parties dans des commandes plus complexes
- [ ] **B.** Ce sont des alias strictement équivalents
- [ ] **C.** `section()` ne peut être appelé qu'après `title()`
- [ ] **D.** `title()` n'existe que depuis Symfony 8.0

### Question 101

Quelles méthodes de contenu de `SymfonyStyle` correspondent à ces descriptions : afficher du texte simple, afficher une liste à puces, afficher un tableau ? *(une seule bonne réponse)*

- [ ] **A.** `text()`, `listing()`, `table()`
- [ ] **B.** `write()`, `bullet()`, `grid()`
- [ ] **C.** `content()`, `items()`, `dataTable()`
- [ ] **D.** `paragraph()`, `list()`, `matrix()`

### Question 102

À quoi sert `definitionList()`, et comment y insère-t-on un séparateur entre deux groupes ? *(une seule bonne réponse)*

- [ ] **A.** Elle affiche des paires clé/valeur de façon compacte ; on insère un séparateur en passant une instance de `TableSeparator` parmi les arguments
- [ ] **B.** Elle sert uniquement à afficher un glossaire figé, sans possibilité de séparateur
- [ ] **C.** Elle affiche un arbre hiérarchique, le séparateur étant une simple chaîne vide
- [ ] **D.** Elle n'accepte qu'un seul groupe de paires clé/valeur à la fois

### Question 103

Que fait `createTable()` sur `SymfonyStyle`, par rapport à `table()` directement ? *(une seule bonne réponse)*

- [ ] **A.** Elle affiche immédiatement un tableau simple, sans retour possible
- [ ] **B.** Elle retourne une instance du helper `Table`, stylée selon le Symfony Style Guide, permettant des fonctionnalités avancées comme l'ajout dynamique de lignes
- [ ] **C.** Elle est strictement identique à `table()`, juste un alias
- [ ] **D.** Elle ne fonctionne qu'avec des tableaux verticaux

### Question 104

La plupart des méthodes « admonition » (`note()`, `caution()`) et « résultat » (`success()`, `error()`…) de `SymfonyStyle` sont-elles réservées à un usage unique par commande ? *(une seule bonne réponse)*

- [ ] **A.** Oui, un appel supplémentaire lève une exception
- [ ] **B.** Non : elles sont *prévues* pour un usage typiquement unique, par exemple afficher le résultat final, mais rien n'empêche de les appeler plusieurs fois pendant l'exécution
- [ ] **C.** Oui, sauf `note()` qui peut être répétée
- [ ] **D.** Cela dépend uniquement du type de terminal utilisé

### Question 105

Quelle est la différence principale entre `note()` et `caution()` ? *(une seule bonne réponse)*

- [ ] **A.** Elles sont strictement identiques
- [ ] **B.** `caution()` met le contenu en évidence de façon plus marquée, ressemblant à un message d'erreur — à utiliser seulement si nécessaire ; `note()` est un simple encadré discret
- [ ] **C.** `note()` ne fonctionne qu'avec des tableaux de chaînes, `caution()` qu'avec des chaînes simples
- [ ] **D.** `caution()` est dépréciée au profit de `note()`

### Question 106

Quelles méthodes de `SymfonyStyle` gèrent une barre de progression, du démarrage à la fin, et laquelle avance automatiquement en itérant une collection ? *(une seule bonne réponse)*

- [ ] **A.** `progressStart()`, `progressAdvance()`, `progressFinish()` ; `progressIterate()` avance automatiquement en bouclant sur un itérable
- [ ] **B.** `barStart()`, `barTick()`, `barStop()` ; aucune méthode automatique n'existe
- [ ] **C.** `progress()` unique, gérant tout le cycle de vie sans distinction
- [ ] **D.** `startBar()`, `advanceBar()`, `endBar()` ; `iterateBar()`

### Question 107

Comment poser une question simple à l'utilisateur avec `SymfonyStyle`, avec une valeur par défaut et une validation ? *(une seule bonne réponse)*

- [ ] **A.** `$io->ask('Question ?', 'valeur par défaut', $callbackDeValidation)`
- [ ] **B.** `$io->question('...')`, sans possibilité de validation
- [ ] **C.** `$io->prompt('...')`
- [ ] **D.** `$io->input('...')`

### Question 108

En quoi `askHidden()` diffère-t-il de `ask()` ? *(une seule bonne réponse)*

- [ ] **A.** Il masque la saisie de l'utilisateur, utile pour les mots de passe, et ne peut pas définir de valeur par défaut
- [ ] **B.** Il fonctionne à l'identique, seul le style visuel change
- [ ] **C.** Il ne peut jamais être combiné à un validateur
- [ ] **D.** Il n'existe pas sur `SymfonyStyle`, uniquement sur `QuestionHelper`

### Question 109

Que retourne `$io->confirm('Question ?')`, et comment fournir une réponse par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Une chaîne `'yes'` ou `'no'` ; en passant `'yes'`/`'no'` en second argument
- [ ] **B.** Un booléen `true` ou `false` ; en passant `true` ou `false` en second argument
- [ ] **C.** Un entier `0` ou `1`, sans valeur par défaut possible
- [ ] **D.** Un objet `ConfirmationResult`

### Question 110

Avec `$io->choice()`, comment autoriser l'utilisateur à sélectionner plusieurs réponses, et comment doit-il les saisir ? *(une seule bonne réponse)*

- [ ] **A.** En passant `multiSelect: true` ; les choix multiples se séparent par une virgule, par exemple `1, 2`
- [ ] **B.** En passant un tableau de tableaux comme liste de choix
- [ ] **C.** Ce n'est pas possible, `choice()` n'accepte qu'une seule réponse
- [ ] **D.** En séparant les choix par un point-virgule

### Question 111

Par défaut, les indices numériques affichés à côté de chaque choix de `$io->choice()` commencent à quelle valeur, et comment les personnaliser ? *(une seule bonne réponse)*

- [ ] **A.** À `1` ; en passant un second tableau d'indices
- [ ] **B.** À `0` ; en passant un tableau avec des clés numériques personnalisées comme valeurs de choix
- [ ] **C.** Il n'existe aucun indice numérique, seul le texte du choix est affiché
- [ ] **D.** À `0`, sans aucune possibilité de personnalisation

### Question 112

Que gère la méthode `getOutputWrapper()->setAllowCutUrls(true)` sur `SymfonyStyle` ? *(une seule bonne réponse)*

- [ ] **A.** Elle force la coloration ANSI même sur les terminaux qui ne la supportent pas
- [ ] **B.** Elle autorise à couper (wrapper) les URLs longues comme le reste du texte, alors qu'elles sont préservées non coupées par défaut pour rester cliquables
- [ ] **C.** Elle désactive tous les liens cliquables
- [ ] **D.** Elle change le format des messages d'erreur

### Question 113

Comment utiliser un système de style personnalisé plutôt que `SymfonyStyle`, tout en gardant le code de la commande inchangé si l'on change de style plus tard ? *(une seule bonne réponse)*

- [ ] **A.** En créant une classe implémentant `StyleInterface`, puis en l'instanciant à la place de `SymfonyStyle`
- [ ] **B.** En surchargeant directement la classe `SymfonyStyle` par héritage obligatoire
- [ ] **C.** Ce n'est pas possible, `SymfonyStyle` est la seule implémentation permise
- [ ] **D.** En modifiant le composant Console lui-même

### Question 114

À quoi sert `getErrorStyle()` sur `SymfonyStyle`, et quelle condition doit remplir l'`OutputInterface` sous-jacent pour que cela fonctionne réellement ? *(une seule bonne réponse)*

- [ ] **A.** Elle retourne une nouvelle instance de `SymfonyStyle` écrivant sur la sortie d'erreur (`stderr`) ; l'output doit être une instance de `ConsoleOutputInterface`, sinon elle continue d'écrire sur la sortie standard
- [ ] **B.** Elle formate le message en rouge, sans changer le flux de sortie
- [ ] **C.** Elle nécessite que le composant Monolog soit installé
- [ ] **D.** Elle ne fonctionne qu'en mode `--no-ansi`

### Question 115

Comment colorer du texte en utilisant les tags de style intégrés à `writeln()`, par exemple pour un texte vert ou un texte blanc sur fond rouge ? *(une seule bonne réponse)*

- [ ] **A.** `<info>texte</info>` pour vert, `<error>texte</error>` pour blanc sur fond rouge
- [ ] **B.** `<green>texte</green>` et `<red-bg>texte</red-bg>`
- [ ] **C.** `<color=green>` et `<bg=red>` uniquement, `<info>`/`<error>` n'existant pas
- [ ] **D.** Il faut toujours définir un style personnalisé, aucun tag n'est prédéfini

### Question 116

Quelles options de style (`options=...`) sont documentées pour la coloration en ligne ? *(plusieurs bonnes réponses)*

- [ ] **A.** `bold` et `underscore`
- [ ] **B.** `blink` et `reverse`
- [ ] **C.** `conceal`, qui rend le texte tapé invisible
- [ ] **D.** `italic`

### Question 117

Comment afficher un lien cliquable dans le terminal, si celui-ci le supporte, et que se passe-t-il sinon ? *(une seule bonne réponse)*

- [ ] **A.** Avec le tag spécial `<href=URL>texte</>` ; si le terminal ne supporte pas les liens, le texte s'affiche normalement mais l'URL est perdue
- [ ] **B.** `<link=URL>texte</link>`, avec un message d'erreur si non supporté
- [ ] **C.** Ce n'est pas possible dans un terminal, uniquement dans un navigateur
- [ ] **D.** `<a href="URL">texte</a>`, comme en HTML

## Annexe — Le Question Helper

### Question 118

Quelle méthode unique le `QuestionHelper` expose-t-il, et quels sont ses trois arguments ? *(une seule bonne réponse)*

- [ ] **A.** `ask()`, avec `InputInterface`, `OutputInterface` et une instance de `Question`
- [ ] **B.** `prompt()`, avec seulement un message et une valeur par défaut
- [ ] **C.** `getAnswer()`, avec `InputInterface` uniquement
- [ ] **D.** `interact()`, réutilisant les paramètres de la commande

### Question 119

Pour une `ConfirmationQuestion`, quel est le regex par défaut utilisé pour déterminer qu'une réponse signifie « oui », et que se passe-t-il si aucune valeur valide n'est saisie ? *(une seule bonne réponse)*

- [ ] **A.** `/^y/i` par défaut ; si rien de valide n'est saisi, la valeur par défaut passée au constructeur est utilisée, `true` si non précisée
- [ ] **B.** `/^(yes|oui)$/`, sans valeur de repli possible
- [ ] **C.** Il n'existe pas de regex, uniquement une comparaison stricte à `'y'`
- [ ] **D.** `/^[oy]/i`, avec repli systématique sur `false`

### Question 120

Sur quel flux de sortie le `QuestionHelper` écrit-il par défaut, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** `stdout`, sans possibilité de changement
- [ ] **B.** `stderr` par défaut ; on peut passer une instance de `StreamOutput` à `ask()` pour changer cela
- [ ] **C.** Un fichier temporaire, toujours
- [ ] **D.** Le flux dépend du système d'exploitation

### Question 121

Avec une `ChoiceQuestion`, comment permettre à l'utilisateur de sélectionner plusieurs réponses, et comment doit-il les saisir ? *(une seule bonne réponse)*

- [ ] **A.** Via `setMultiselect(true)` ; les réponses multiples se séparent par des virgules, en mélangeant éventuellement libellés et index
- [ ] **B.** Ce n'est pas possible avec `ChoiceQuestion`, seulement avec `SymfonyStyle::choice()`
- [ ] **C.** En les séparant par des espaces
- [ ] **D.** En créant plusieurs instances de `ChoiceQuestion` chaînées

### Question 122

Comment fournir des suggestions d'autocomplétion pour une `Question` simple, de façon statique ou dynamique ? *(une seule bonne réponse)*

- [ ] **A.** `setAutocompleterValues()` pour une liste statique, `setAutocompleterCallback()` pour générer les suggestions à la volée
- [ ] **B.** Uniquement via `setAutocompleterValues()`, aucune génération dynamique n'étant possible
- [ ] **C.** Il faut toujours passer par `ChoiceQuestion`, `Question` seule ne supportant pas l'autocomplétion
- [ ] **D.** Via un attribut PHP `#[Autocomplete]`

### Question 123

Que permet `Question::setTrimmable(false)`, et quel est le comportement par défaut sans cet appel ? *(une seule bonne réponse)*

- [ ] **A.** Par défaut, la réponse de l'utilisateur est automatiquement « trimée » (espaces en début/fin retirés) ; `setTrimmable(false)` désactive ce comportement
- [ ] **B.** Par défaut, rien n'est trimé ; il faut l'activer explicitement
- [ ] **C.** Cette méthode ne concerne que les réponses cachées
- [ ] **D.** Elle empêche toute saisie contenant des espaces

### Question 124

Comment autoriser une réponse multi-ligne, et comment l'utilisateur signale-t-il la fin de sa saisie dans ce cas ? *(une seule bonne réponse)*

- [ ] **A.** Via `setMultiline(true)` ; la saisie se termine à un caractère de fin de transmission, `Ctrl-D` sous Unix ou `Ctrl-Z` sous Windows, plutôt qu'à la première touche Entrée
- [ ] **B.** Via `setMultiline(true)` ; elle se termine toujours par une ligne vide
- [ ] **C.** Ce n'est pas supporté par le composant Console
- [ ] **D.** En tapant `\n` littéralement

### Question 125

Que se passe-t-il si l'utilisateur ne répond pas dans le délai fixé par `Question::setTimeout()`, et cette limite s'applique-t-elle aussi aux flux non interactifs (pipes, fichiers) ? *(une seule bonne réponse)*

- [ ] **A.** Une `MissingInputException` est levée ; le timeout ne s'applique qu'aux flux d'entrée interactifs, il est ignoré pour les flux non interactifs
- [ ] **B.** La commande se termine silencieusement avec un code de succès ; le timeout s'applique dans tous les cas
- [ ] **C.** La valeur par défaut est automatiquement utilisée, sans exception ; uniquement en mode interactif
- [ ] **D.** Le composant Console ne propose aucun mécanisme de timeout pour les questions

### Question 126

Comment masquer la réponse de l'utilisateur, par exemple un mot de passe, et que se passe-t-il si aucune méthode de masquage n'est disponible sur le système ? *(une seule bonne réponse)*

- [ ] **A.** `setHidden(true)` ; par défaut la réponse redevient visible en repli, sauf si `setHiddenFallback(false)` est utilisé — dans ce cas une `RuntimeException` est levée
- [ ] **B.** `setPassword(true)` ; une exception est toujours levée si le masquage échoue
- [ ] **C.** `setHidden(true)` ; le comportement de repli n'est pas configurable
- [ ] **D.** Il faut installer une extension PHP dédiée, sans quoi `ask()` échoue systématiquement

### Question 127

Que fait `Question::setNormalizer()`, et à quel moment s'exécute-t-il par rapport au validateur ? *(une seule bonne réponse)*

- [ ] **A.** Il nettoie/transforme la réponse avant validation ; le normalizer est appelé en premier, le résultat étant ensuite passé au validateur
- [ ] **B.** Il s'exécute après le validateur, pour formater la valeur finale seulement
- [ ] **C.** Il remplace entièrement la validation, aucun `setValidator()` n'étant alors nécessaire
- [ ] **D.** Il ne peut être utilisé qu'avec une `ChoiceQuestion`

### Question 128

Que doit faire le callback passé à `Question::setValidator()` en cas de réponse invalide, et comment limiter le nombre de tentatives ? *(une seule bonne réponse)*

- [ ] **A.** Il doit lever une exception, le message étant affiché à l'utilisateur ; `setMaxAttempts()` limite le nombre de tentatives, `null` signifiant un nombre illimité
- [ ] **B.** Il doit retourner `false`, sans limite de tentatives possible
- [ ] **C.** Il doit appeler `exit()` directement
- [ ] **D.** Il doit retourner une chaîne vide ; les tentatives sont toujours limitées à 3

### Question 129

Le composant Validator peut-il être utilisé pour valider la réponse à une `Question`, et comment ? *(une seule bonne réponse)*

- [ ] **A.** Non, uniquement des callbacks manuels sont supportés
- [ ] **B.** Oui, via `Validation::createCallable()`, qui transforme une contrainte du composant Validator en callable utilisable par `setValidator()`
- [ ] **C.** Oui, mais uniquement pour les `ChoiceQuestion`
- [ ] **D.** Oui, mais cela nécessite de réimplémenter `QuestionValidatorInterface`

### Question 130

Comment simuler des entrées utilisateur dans un test de commande avec `CommandTester`, et une entrée supplémentaire est-elle nécessaire pour simuler l'appui sur Entrée ? *(une seule bonne réponse)*

- [ ] **A.** Via `setInputs(['valeur1', 'valeur2'])` ; `CommandTester` simule automatiquement l'appui sur Entrée après chaque entrée, sans rien ajouter de plus
- [ ] **B.** Via `setAnswers()`, en ajoutant manuellement `'\n'` après chaque valeur
- [ ] **C.** Ce n'est pas testable automatiquement, il faut un vrai terminal
- [ ] **D.** Via `mockInput()`, disponible uniquement en environnement `test`

### Question 131

Pourquoi les questions à réponse cachée (mots de passe) ne sont-elles pas testables sur Windows, d'après la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Symfony utilise un binaire spécial pour les questions cachées sous Windows, qui n'utilise pas l'objet `Input` standard de la console
- [ ] **B.** Windows interdit purement et simplement les questions interactives
- [ ] **C.** `CommandTester` n'est pas disponible sous Windows
- [ ] **D.** Cela concerne en réalité tous les systèmes d'exploitation, pas seulement Windows

## Annexe — Le Formatter Helper

### Question 132

À quoi sert `FormatterHelper::formatSection()`, et à quoi ressemble sa sortie ? *(une seule bonne réponse)*

- [ ] **A.** Il reproduit le style `[NomDeSection] message associé`, la section étant affichée en couleur avec des crochets
- [ ] **B.** Il affiche un tableau avec en-tête de section
- [ ] **C.** Il tronque le message à la largeur d'une section du terminal
- [ ] **D.** Il n'existe pas sur `FormatterHelper`, seulement sur `SymfonyStyle`

### Question 133

Que fait `FormatterHelper::formatBlock()` avec `true` comme troisième argument ? *(une seule bonne réponse)*

- [ ] **A.** Il colore le texte en rouge, quel que soit le style demandé
- [ ] **B.** Il ajoute un padding supplémentaire : une ligne vide au-dessus et en dessous, et 2 espaces à gauche et à droite
- [ ] **C.** Il tronque automatiquement le message à 80 caractères
- [ ] **D.** Il désactive la coloration ANSI pour ce bloc précis

### Question 134

Comment tronquer un message à une longueur donnée avec `FormatterHelper::truncate()`, par exemple à 7 caractères, et que devient-il si l'on passe une longueur négative ? *(une seule bonne réponse)*

- [ ] **A.** `truncate($message, 7)` tronque à 7 caractères puis ajoute le suffixe ; avec une longueur négative, le nombre de caractères tronqués est compté depuis la **fin** de la chaîne
- [ ] **B.** Une longueur négative provoque toujours une exception
- [ ] **C.** `truncate()` ne fonctionne que sur des chaînes de moins de 100 caractères
- [ ] **D.** Le suffixe n'est jamais ajouté si la longueur est négative

### Question 135

Quel est le suffixe par défaut ajouté par `truncate()`, et comment le personnaliser ou le supprimer ? *(une seule bonne réponse)*

- [ ] **A.** `...` par défaut ; passer une autre chaîne, ou une chaîne vide pour le supprimer, en troisième argument
- [ ] **B.** `[...]` par défaut, non personnalisable
- [ ] **C.** Aucun suffixe par défaut, il faut toujours le préciser
- [ ] **D.** `—` par défaut, personnalisable uniquement via configuration globale

### Question 136

Que fait `Helper::formatTime()`, par exemple avec `formatTime(125, 2)` ? *(une seule bonne réponse)*

- [ ] **A.** Il formate un nombre de secondes en texte lisible, avec une précision donnée, ici 2 unités — soit `2 min, 5 s`
- [ ] **B.** Il formate une date au format ISO 8601
- [ ] **C.** Il retourne toujours le nombre de secondes brut, sans conversion
- [ ] **D.** Il calcule le temps restant d'une progress bar uniquement

### Question 137

Que fait `Helper::formatMemory()`, par exemple avec `formatMemory(1024 * 1024)` ? *(une seule bonne réponse)*

- [ ] **A.** Il formate une taille en octets vers l'unité la plus lisible (GiB/MiB/KiB/B) — ici `1.0 MiB`
- [ ] **B.** Il retourne la mémoire disponible totale du serveur
- [ ] **C.** Il ne fonctionne qu'avec des tailles supérieures à 1 Go
- [ ] **D.** Il retourne systématiquement une valeur en kilo-octets (Ko), jamais en Mio/Gio

## Annexe — La Progress Bar

### Question 138

Sur quel flux de sortie la barre de progression écrit-elle par défaut, et comment changer cela ? *(une seule bonne réponse)*

- [ ] **A.** `stdout`, sans possibilité de changement
- [ ] **B.** `stderr` par défaut ; en passant une instance de `StreamOutput` au constructeur de `ProgressBar`
- [ ] **C.** Un fichier de log dédié
- [ ] **D.** Cela dépend uniquement du système d'exploitation

### Question 139

Comment faire reculer une barre de progression de 2 étapes ? *(une seule bonne réponse)*

- [ ] **A.** `$progressBar->advance(-2)`
- [ ] **B.** `$progressBar->regress(2)`
- [ ] **C.** Ce n'est pas possible, une barre de progression ne peut qu'avancer
- [ ] **D.** `$progressBar->setProgress(-2)`, en absolu uniquement

### Question 140

Que se passe-t-il si l'on crée une `ProgressBar` sans lui donner de nombre total d'étapes ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée à l'instanciation
- [ ] **B.** La progression s'affiche comme un « throbber » (indicateur d'activité) plutôt que comme un pourcentage
- [ ] **C.** La barre affiche toujours 100%, quel que soit l'avancement réel
- [ ] **D.** Il faut obligatoirement appeler `setMaxSteps()` avant `start()`

### Question 141

Quelle méthode permet de faire avancer, démarrer et terminer automatiquement une barre de progression en itérant une collection ? *(une seule bonne réponse)*

- [ ] **A.** `ProgressBar::iterate($iterable)`
- [ ] **B.** `ProgressBar::loop($iterable)`
- [ ] **C.** `ProgressBar::wrap($iterable)`
- [ ] **D.** Il n'existe pas de méthode de ce type, il faut gérer manuellement `advance()` dans la boucle

### Question 142

Par défaut, à quelle fréquence Symfony redessine-t-il l'écran pour la barre de progression, et quelles méthodes permettent d'ajuster ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les 100ms ou 10% du `max` par défaut ; `setRedrawFrequency()`, `minSecondsBetweenRedraws()` et `maxSecondsBetweenRedraws()` permettent de l'ajuster
- [ ] **B.** À chaque appel de `advance()`, sans limite configurable
- [ ] **C.** Une seule fois, à la fin de l'exécution
- [ ] **D.** Toutes les secondes, fixe et non configurable

### Question 143

Quels sont les quatre formats intégrés de barre de progression liés à la verbosité, et que faut-il utiliser si le nombre total d'étapes est inconnu ? *(une seule bonne réponse)*

- [ ] **A.** `normal`, `verbose`, `very_verbose`, `debug` ; utiliser leurs variantes `_nomax` si le nombre d'étapes est inconnu
- [ ] **B.** `low`, `medium`, `high`, `debug` ; pas de variante spécifique sans max
- [ ] **C.** Un seul format existe, `default`
- [ ] **D.** `silent`, `normal`, `verbose`, `debug` ; utiliser `_unknown` sans max

### Question 144

Parmi les placeholders intégrés d'une barre de progression, lesquels ne sont **pas** disponibles si le nombre maximal d'étapes n'est pas défini ? *(plusieurs bonnes réponses)*

- [ ] **A.** `percent`
- [ ] **B.** `remaining`
- [ ] **C.** `estimated`
- [ ] **D.** `elapsed`

### Question 145

Comment personnaliser les caractères utilisés pour la partie terminée, la partie non terminée et le curseur de progression de la barre ? *(une seule bonne réponse)*

- [ ] **A.** `setBarCharacter()`, `setEmptyBarCharacter()`, `setProgressCharacter()`
- [ ] **B.** `setBarStyle()` unique, prenant les trois caractères en arguments
- [ ] **C.** Ce n'est pas personnalisable, seule la largeur, `setBarWidth()`, l'est
- [ ] **D.** Via un fichier `progressbar.yaml` de configuration

### Question 146

Comment créer un nouveau placeholder personnalisé, par exemple pour afficher le nombre d'étapes restantes ? *(une seule bonne réponse)*

- [ ] **A.** Via `ProgressBar::setPlaceholderFormatterDefinition()`, globalement pour toutes les instances, ou via `setPlaceholderFormatter()` pour une instance précise
- [ ] **B.** Ce n'est pas possible, seuls les placeholders intégrés existent
- [ ] **C.** En sous-classant obligatoirement `ProgressBar`
- [ ] **D.** Via l'attribut PHP `#[ProgressPlaceholder]`

### Question 147

Comment afficher un message arbitraire dans la barre de progression via le placeholder `message`, sachant qu'aucun format intégré ne l'inclut par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Il faut définir son propre format contenant `%message%`, puis appeler `setMessage()` pour en définir la valeur
- [ ] **B.** `message` est inclus dans tous les formats intégrés, `setMessage()` suffit
- [ ] **C.** Ce n'est possible qu'avec le format `debug`
- [ ] **D.** Il faut utiliser `ProgressIndicator`, `ProgressBar` ne supportant pas les messages

### Question 148

Comment afficher plusieurs barres de progression indépendantes en même temps dans le terminal ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible avec le composant Console
- [ ] **B.** En les associant chacune à une output section différente, `$output->section()`, chaque section évoluant indépendamment
- [ ] **C.** En les exécutant dans des process PHP séparés obligatoirement
- [ ] **D.** En utilisant une seule instance de `ProgressBar` avec plusieurs `setMaxSteps()`

### Question 149

Que se passe-t-il si une commande est lancée avec l'option `-q` (quiet) alors qu'elle affiche une barre de progression ? *(une seule bonne réponse)*

- [ ] **A.** La barre de progression continue de s'afficher normalement
- [ ] **B.** La barre de progression ne s'affiche pas
- [ ] **C.** Une erreur est levée
- [ ] **D.** Seul le pourcentage final est affiché, sans animation

## Annexe — Le Progress Indicator

### Question 150

Dans quel cas utiliser un `ProgressIndicator` plutôt qu'une `ProgressBar` ? *(une seule bonne réponse)*

- [ ] **A.** Quand la durée de la commande est indéterminée (tâches longues, non quantifiables), plutôt qu'une progression avec un total connu
- [ ] **B.** Uniquement pour les commandes qui n'affichent aucune sortie
- [ ] **C.** `ProgressIndicator` est simplement un synonyme de `ProgressBar`
- [ ] **D.** Uniquement pour les commandes exécutées en arrière-plan via Messenger

### Question 151

Comment démarrer et terminer un `ProgressIndicator`, avec un message personnalisé à chaque étape ? *(une seule bonne réponse)*

- [ ] **A.** `start('Processing...')` puis `finish('Finished')`
- [ ] **B.** `begin()` puis `end()`, sans argument de message
- [ ] **C.** `run()` uniquement, qui gère tout le cycle de vie
- [ ] **D.** `advance('Processing...')` uniquement

### Question 152

Quels sont les formats intégrés du `ProgressIndicator`, et comment gérer un terminal sans support ANSI ? *(une seule bonne réponse)*

- [ ] **A.** `normal`, `verbose`, `very_verbose` ; utiliser les variantes `_no_ansi` correspondantes
- [ ] **B.** `normal`, `debug` uniquement ; aucune variante sans ANSI n'existe
- [ ] **C.** Un seul format universel, adaptatif automatiquement
- [ ] **D.** `slow`, `fast` ; à choisir selon la vitesse estimée de la tâche

### Question 153

Comment personnaliser les caractères d'animation affichés par le `ProgressIndicator`, par exemple pour utiliser des caractères Unicode différents ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas personnalisable, seuls les formats intégrés existent
- [ ] **B.** En passant un tableau de caractères comme quatrième argument du constructeur
- [ ] **C.** Via `setIndicatorValues()` uniquement après instanciation
- [ ] **D.** En sous-classant `ProgressIndicator`

### Question 154

Comment personnaliser l'indicateur final affiché quand la tâche se termine, par défaut ✔ ? *(une seule bonne réponse)*

- [ ] **A.** Via l'argument nommé `finishedIndicatorValue` du constructeur, ou en le passant en second argument de `finish()`
- [ ] **B.** Ce n'est pas personnalisable
- [ ] **C.** Uniquement via une configuration globale affectant toutes les instances
- [ ] **D.** En modifiant directement le code source du composant Console

### Question 155

Parmi les placeholders intégrés du `ProgressIndicator`, lequel n'existe **pas**, contrairement à `ProgressBar` qui gère une notion de total/pourcentage ? *(une seule bonne réponse)*

- [ ] **A.** `elapsed`
- [ ] **B.** `percent`
- [ ] **C.** `memory`
- [ ] **D.** `message`

## Annexe — Le Table Helper

### Question 156

Quelle est la méthode « simple » recommandée pour afficher un tableau si l'on n'a pas besoin de personnalisation avancée du design ? *(une seule bonne réponse)*

- [ ] **A.** Les méthodes de tableau de `SymfonyStyle` (`table()`/`horizontalTable()`)
- [ ] **B.** Le helper `Table` est systématiquement requis, même pour un usage basique
- [ ] **C.** `$output->writeTable()`
- [ ] **D.** Il n'existe qu'une seule façon d'afficher un tableau, sans distinction de complexité

### Question 157

Comment ajouter un séparateur visuel entre deux groupes de lignes dans un tableau créé avec le helper `Table` ? *(une seule bonne réponse)*

- [ ] **A.** En passant une instance de `TableSeparator` comme une ligne parmi les autres
- [ ] **B.** En appelant `$table->addSeparator()` après chaque ligne
- [ ] **C.** Ce n'est pas possible avec le helper `Table`, uniquement avec `SymfonyStyle`
- [ ] **D.** En insérant une ligne composée uniquement de tirets

### Question 158

Comment définir explicitement la largeur des colonnes d'un tableau, et que se passe-t-il si le contenu dépasse la largeur définie ? *(une seule bonne réponse)*

- [ ] **A.** Via `setColumnWidths()` pour toutes, ou `setColumnWidth()` pour une seule ; la largeur définie est un minimum, elle est automatiquement augmentée si le contenu est plus long
- [ ] **B.** Via `setColumnWidths()` uniquement ; le contenu qui dépasse est tronqué silencieusement
- [ ] **C.** La largeur des colonnes n'est jamais configurable manuellement
- [ ] **D.** En précisant la largeur en pixels

### Question 159

Quelle méthode permet, au contraire, de forcer le retour à la ligne du contenu trop long dans une colonne, plutôt que d'élargir la colonne ? *(une seule bonne réponse)*

- [ ] **A.** `setColumnMaxWidth()`
- [ ] **B.** `wrapColumn()`
- [ ] **C.** `setColumnWidths()`, avec une valeur négative
- [ ] **D.** Ce n'est pas possible, seul l'élargissement automatique existe

### Question 160

Comment afficher un tableau en orientation verticale plutôt qu'horizontale ? *(une seule bonne réponse)*

- [ ] **A.** `$table->setVertical()`
- [ ] **B.** `$table->setOrientation('vertical')`
- [ ] **C.** Ce n'est pas supporté par le helper `Table`
- [ ] **D.** En inversant manuellement `setHeaders()` et `setRows()`

### Question 161

Parmi ces noms, lesquels correspondent à des styles de tableau réellement intégrés au helper `Table` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `compact` et `borderless`
- [ ] **B.** `box` et `box-double`
- [ ] **C.** `markdown`
- [ ] **D.** `csv` et `json`

### Question 162

Comment appliquer un style personnalisé au niveau d'une seule **cellule** plutôt qu'à tout le tableau, par exemple pour l'alignement ou les couleurs de premier plan/fond ? *(une seule bonne réponse)*

- [ ] **A.** Via une instance de `TableCellStyle` passée en option d'un `TableCell`
- [ ] **B.** Ce n'est pas possible, le style s'applique toujours à tout le tableau
- [ ] **C.** En créant un `TableStyle` entier juste pour une cellule
- [ ] **D.** Uniquement via des tags `<info>`/`<error>` dans le texte de la cellule

### Question 163

Comment faire en sorte qu'une cellule s'étende sur plusieurs colonnes, et peut-on combiner cela avec un étalement sur plusieurs lignes ? *(une seule bonne réponse)*

- [ ] **A.** Via `TableCell` avec l'option `colspan` ; oui, `colspan` et `rowspan` peuvent être combinés pour créer des mises en page complexes
- [ ] **B.** Uniquement `colspan` existe, pas d'équivalent pour les lignes
- [ ] **C.** Ce n'est possible qu'avec le style `box-double`
- [ ] **D.** Il faut fusionner manuellement les cellules avant de construire le tableau

### Question 164

Comment ajouter dynamiquement des lignes à un tableau déjà rendu à l'écran, et quelle condition cela impose-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Via `appendRow()` ; le tableau doit avoir été rendu à l'intérieur d'une output section
- [ ] **B.** Via `addRow()` directement, sans condition particulière
- [ ] **C.** Ce n'est pas possible une fois `render()` appelé, quel que soit le contexte
- [ ] **D.** En rappelant `render()` une seconde fois avec les nouvelles lignes seulement

### Question 165

Comment ajouter plusieurs lignes en une seule fois à un tableau, avant de le rendre ? *(une seule bonne réponse)*

- [ ] **A.** `$table->addRows([...])`
- [ ] **B.** `$table->setRows()` uniquement, qui écrase les lignes existantes
- [ ] **C.** Il faut appeler `addRow()` une fois par ligne, sans méthode groupée
- [ ] **D.** `$table->pushRows([...])`

### Question 166

Comment enregistrer un style de tableau personnalisé sous un nom, pour le réutiliser ou même surcharger un style intégré ? *(une seule bonne réponse)*

- [ ] **A.** `Table::setStyleDefinition('nom', $tableStyle)`
- [ ] **B.** `$table->registerStyle('nom', $tableStyle)`
- [ ] **C.** Ce n'est pas possible, un `TableStyle` personnalisé ne peut être utilisé qu'une seule fois
- [ ] **D.** Via un fichier `config/packages/console_table.yaml`

### Question 167

Comment afficher un titre en haut et en bas d'un tableau, par exemple « Books » et « Page 1/2 » ? *(une seule bonne réponse)*

- [ ] **A.** `setHeaderTitle()` et `setFooterTitle()`
- [ ] **B.** En les ajoutant comme lignes de données classiques
- [ ] **C.** Uniquement possible avec le style `box`
- [ ] **D.** `setTitle()` unique, affiché seulement en haut

## Annexe — Le Debug Formatter Helper

### Question 168

À quoi sert le premier argument, un « identifiant », commun à toutes les méthodes du `DebugFormatterHelper` ? *(une seule bonne réponse)*

- [ ] **A.** Il définit la couleur du message
- [ ] **B.** C'est une valeur unique par programme, permettant au helper de gérer les informations de débogage de plusieurs programmes en même temps
- [ ] **C.** Il définit le niveau de verbosité minimal requis pour afficher le message
- [ ] **D.** Il correspond au code de sortie attendu du programme

### Question 169

Quel préfixe la méthode `start()` du `DebugFormatterHelper` affiche-t-elle par défaut, et comment le personnaliser ? *(une seule bonne réponse)*

- [ ] **A.** `RUN`, personnalisable via un troisième argument
- [ ] **B.** `START`, non personnalisable
- [ ] **C.** `BEGIN`, personnalisable uniquement via configuration globale
- [ ] **D.** Aucun préfixe par défaut

### Question 170

Que signale le troisième argument booléen de `DebugFormatterHelper::progress()` ? *(une seule bonne réponse)*

- [ ] **A.** Si le programme doit continuer à s'exécuter
- [ ] **B.** Si la sortie affichée est une sortie d'erreur, préfixe `ERR`, ou normale, préfixe `OUT`
- [ ] **C.** Si le message doit être répété
- [ ] **D.** Si l'affichage doit être coloré

### Question 171

Quelle méthode affiche l'information de fin d'exécution d'un programme (préfixe `RES`), et comment la couleur varie-t-elle selon le résultat ? *(une seule bonne réponse)*

- [ ] **A.** `stop()` ; en rouge en cas d'échec, en vert en cas de succès
- [ ] **B.** `end()` ; toujours affiché en blanc, sans distinction
- [ ] **C.** `finish()` ; la couleur dépend du niveau de verbosité, pas du résultat
- [ ] **D.** `terminate()` ; jamais coloré

## Annexe — Le Process Helper

### Question 172

À quel niveau de verbosité le `ProcessHelper` affiche-t-il des informations de base sur un processus, et à quel niveau affiche-t-il en plus sa sortie ? *(une seule bonne réponse)*

- [ ] **A.** `-v` pour les informations de base, `-vv` pour la sortie détaillée
- [ ] **B.** `-vv` pour les informations de base (RUN/RES), `-vvv` (debug) pour aussi voir la sortie du processus préfixée `OUT`
- [ ] **C.** Toujours affiché, quelle que soit la verbosité
- [ ] **D.** `-q` pour tout masquer, aucune autre distinction de niveau

### Question 173

Sur quel flux le `ProcessHelper` écrit-il par défaut, et comment changer ce comportement ? *(une seule bonne réponse)*

- [ ] **A.** `stdout`, non modifiable
- [ ] **B.** `stderr` par défaut ; changeable en passant une instance de `StreamOutput` à `run()`
- [ ] **C.** Un fichier de log, toujours
- [ ] **D.** Il écrit simultanément sur les deux flux par défaut

### Question 174

Comment passer un message d'erreur personnalisé et un callback de traitement de sortie à `ProcessHelper::run()` ? *(une seule bonne réponse)*

- [ ] **A.** En troisième argument le message d'erreur, en quatrième argument le callback
- [ ] **B.** Uniquement via les options du constructeur de `Process`, jamais via `run()`
- [ ] **C.** Ce n'est pas possible de personnaliser le message d'erreur
- [ ] **D.** Le callback doit obligatoirement être défini avant d'appeler `run()`, en argument du constructeur du helper

## Annexe — Le Cursor Helper

### Question 175

Quelle classe permet de déplacer le curseur à une position précise dans la sortie console, et quelle méthode l'utilise ? *(une seule bonne réponse)*

- [ ] **A.** `Cursor`, via `moveToPosition(colonne, ligne)`
- [ ] **B.** `Terminal`, via `setPosition()`
- [ ] **C.** `OutputInterface`, via `write($x, $y, $text)`
- [ ] **D.** `ConsoleSectionOutput`, via `moveTo()`

### Question 176

Comment récupérer la position actuelle du curseur, et sous quelle forme est-elle retournée ? *(une seule bonne réponse)*

- [ ] **A.** `getCurrentPosition()`, retournant un tableau avec la colonne (x) en premier élément et la ligne (y) en second
- [ ] **B.** `getPosition()`, retournant une chaîne `"x,y"`
- [ ] **C.** Ce n'est pas possible de récupérer la position actuelle
- [ ] **D.** `position()`, retournant un objet `Point`

### Question 177

Parmi ces méthodes, lesquelles permettent d'effacer du contenu affiché à l'écran via le curseur ? *(une seule bonne réponse)*

- [ ] **A.** `clearLine()`, `clearLineAfter()`, `clearOutput()`, `clearScreen()`
- [ ] **B.** `deleteAll()` uniquement
- [ ] **C.** `reset()`, qui efface tout sans distinction de portée
- [ ] **D.** Il n'existe pas de méthode d'effacement dédiée sur `Cursor`

### Question 178

Quelles méthodes permettent de masquer et réafficher le curseur lui-même ? *(une seule bonne réponse)*

- [ ] **A.** `hide()` et `show()`
- [ ] **B.** `disable()` et `enable()`
- [ ] **C.** `toggle()`, un appel par bascule
- [ ] **D.** Il n'existe aucun moyen de masquer le curseur

## Annexe — Le Tree Helper

### Question 179

Quelle méthode statique permet de créer une structure d'arbre à partir d'un tableau, et que retourne-t-elle ? *(une seule bonne réponse)*

- [ ] **A.** `TreeHelper::createTree()`, qui retourne une instance de `Tree` prête à être rendue via `render()`
- [ ] **B.** `Tree::fromArray()`, qui affiche directement l'arbre sans instance intermédiaire
- [ ] **C.** `TreeNode::render()`, appelée directement sur le tableau
- [ ] **D.** `TreeHelper::build()`, retournant une chaîne déjà formatée

### Question 180

Comment construire un arbre de façon programmatique, nœud par nœud, plutôt qu'à partir d'un tableau complet ? *(une seule bonne réponse)*

- [ ] **A.** En créant des instances de `TreeNode` et en les liant via `addChild()`
- [ ] **B.** En appelant `TreeHelper::createTree()` plusieurs fois de suite sur le même arbre
- [ ] **C.** Ce n'est pas possible, seul un tableau complet peut être utilisé
- [ ] **D.** Via un service dédié `TreeBuilder`

### Question 181

Peut-on combiner les deux approches, en partant d'un tableau puis en ajoutant d'autres nœuds ensuite ? *(une seule bonne réponse)*

- [ ] **A.** Non, il faut choisir une seule approche pour tout l'arbre
- [ ] **B.** Oui : par exemple via `TreeNode::fromValues($array)` puis `addChild(...)` sur le nœud obtenu
- [ ] **C.** Oui, mais uniquement en reconstruisant tout l'arbre depuis zéro
- [ ] **D.** Oui, mais uniquement pour le nœud racine, jamais pour les nœuds enfants

### Question 182

Parmi ces noms, lesquels correspondent à des styles d'arbre réellement intégrés à la classe `TreeStyle` ? *(plusieurs bonnes réponses)*

- [ ] **A.** `default()` et `box()`
- [ ] **B.** `doubleBox()` et `compact()`
- [ ] **C.** `light()`, `minimal()` et `rounded()`
- [ ] **D.** `fancy()` et `neon()`

### Question 183

Comment créer un style d'arbre entièrement personnalisé, y compris avec des emojis ? *(une seule bonne réponse)*

- [ ] **A.** En instanciant `TreeStyle` avec les caractères souhaités passés au constructeur
- [ ] **B.** Ce n'est pas possible, seuls les styles intégrés peuvent être utilisés
- [ ] **C.** En sous-classant obligatoirement `Tree`
- [ ] **D.** Via un fichier `tree_style.yaml`

### Question 184

Le Tree Helper est-il limité à l'affichage de structures de répertoires/fichiers ? *(une seule bonne réponse)*

- [ ] **A.** Oui, strictement, aucun autre usage n'est documenté
- [ ] **B.** Non : la documentation cite aussi les organigrammes, arbres de catégories de produits, taxonomies, etc. comme usages possibles
- [ ] **C.** Oui, sauf si l'on utilise le style `box`
- [ ] **D.** Non, mais uniquement pour des structures de moins de 3 niveaux de profondeur

### Question 185

Peut-on construire l'arbre à partir d'un tableau multi-dimensionnel avec des clés imbriquées, plutôt qu'une simple liste plate de valeurs ? *(une seule bonne réponse)*

- [ ] **A.** Non, seule une liste plate de chaînes est acceptée par `TreeHelper::createTree()`
- [ ] **B.** Oui, un tableau multi-dimensionnel avec des clés (dossiers) contenant d'autres tableaux (sous-éléments) est explicitement supporté
- [ ] **C.** Oui, mais uniquement sur deux niveaux de profondeur maximum
- [ ] **D.** Oui, mais uniquement en passant par `TreeNode::fromValues()`, jamais directement à `createTree()`

### Question 186

Via quel objet, en plus du tableau optionnel, passe-t-on toujours le contexte d'entrée/sortie à `TreeHelper::createTree()` ? *(une seule bonne réponse)*

- [ ] **A.** Une instance de `SymfonyStyle`, ou plus généralement d'`OutputInterface`, en premier argument
- [ ] **B.** Une instance de `Command`
- [ ] **C.** Un objet `TreeContext` dédié
- [ ] **D.** Ce n'est pas nécessaire, le rendu se fait uniquement via `render()` sans contexte préalable

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Console Commands de la documentation Symfony 8.0](https://symfony.com/doc/8.0/console.html). Pour les questions 48 à 186, le nom abrégé de la page annexe précède la section — *(Calling — § …)*, *(Controller — § …)*, *(Services — § …)*, *(Hide — § …)*, *(Lazy — § …)*, *(Lockable — § …)*, *(Verbosity — § …)*, *(Input — § …)*, *(Style — § …)*, *(QuestionHelper — § …)*, *(FormatterHelper — § …)*, *(ProgressBar — § …)*, *(ProgressIndicator — § …)*, *(Table — § …)*, *(DebugFormatter — § …)*, *(ProcessHelper — § …)*, *(Cursor — § …)*, *(Tree — § …)* ; les liens complets sont en [fin de fichier](#pour-aller-plus-loin).

**Question 1 : A** — « You can use the `list` command to view all available commands […] `list` is the default command, so running `php bin/console` is the same. » *(§ Running Commands)*

**Question 2 : A** — « you can run it with the `--help` option to view the command's documentation. » *(§ Running Commands)*

**Question 3 : B** — « `--help` is one of the built-in global options from the Console component, which are available for all commands, including those you can create. » *(§ Running Commands)*

**Question 4 : B** — « Console commands run in the environment defined in the `APP_ENV` variable of the `.env` file, which is `dev` by default. » *(§ APP_ENV & APP_DEBUG)*

**Question 5 : B** — « You can also define this env vars when running the command, for instance: `$ APP_ENV=prod php bin/console cache:clear` ». *(§ APP_ENV & APP_DEBUG)*

**Question 6 : B** — « If you are using the Bash, Zsh or Fish shell, you can install Symfony's completion script. » *(§ Console Completion)*

**Question 7 : B** — « First, you have to install the completion script *once*. Run `bin/console completion --help` for the installation instructions for your shell. » *(§ Console Completion)*

**Question 8 : B** — « Many PHP tools are built using the Symfony Console component (e.g. Composer, PHPStan and Behat). If they are using version 5.4 or higher, you can also install their completion script. » *(§ Console Completion)*

**Question 9 : B** — « Commands are defined in classes and auto-registered using the `#[AsCommand]` attribute. » *(§ Creating a Command)*

**Question 10 : A** — « this method must return an integer number with the "exit status code" of the command […] return this if there was no problem […] (it's equivalent to returning int(0)) […] some error happened (int(1)) […] incorrect command usage […] (int(2)) ». *(§ Creating a Command)*

**Question 11 : B** — « If you can't use PHP attributes, register the command as a service and tag it with the `console.command` tag. If you're using the default services.yaml configuration, this is already done for you, thanks to autoconfiguration. » *(§ Creating a Command)*

**Question 12 : A, B, C** — « You can also use `#[AsCommand]` to add a description, usage examples, and longer help text for the command » : `description`, `help`, `usages`. Le niveau de log (D) n'est pas un paramètre de l'attribut. *(§ Creating a Command)*

**Question 13 : B** — « you can extend the `Symfony\Component\Console\Command\Command` class to leverage advanced features like lifecycle hooks (e.g. `initialize()` and `interact()`). » *(§ Creating a Command)*

**Question 14 : B** — « You can define alternative names (aliases) for a command directly in its name using a pipe (`|`) separator. The first name in the list becomes the actual command name; the others are aliases. » *(§ Command Aliases)*

**Question 15 : B** — Exemple : `name: 'app:create-user|app:add-user|app:new-user'` — les trois noms sont valides. *(§ Command Aliases)*

**Question 16 : B** — « this command will do nothing as you didn't write any logic yet. » *(§ Running the Command)*

**Question 17 : A** — « // outputs a message followed by a "\n" `$output->writeln('Whoa!');` […] // outputs a message without adding a "\n" at the end of the line `$output->write(...)`. » *(§ Console Output)*

**Question 18 : B** — « The regular console output can be divided into multiple independent regions called "output sections". […] Sections are created with the `ConsoleOutput::section()` method. » *(§ Output Sections)*

**Question 19 : B** — « // overwrite() replaces all the existing section contents with the given content `$section1->overwrite('Goodbye');` » *(§ Output Sections)*

**Question 20 : B** — « // ...but you can also delete a given number of lines (this example deletes the last two lines of the section) `$section1->clear(2);` » *(§ Output Sections)*

**Question 21 : B** — « setting the max height of a section will make new lines replace the old ones `$section1->setMaxHeight(2);` » *(§ Output Sections)*

**Question 22 : A** — « Terminals only allow overwriting the visible content, so you must take into account the console height when trying to write/overwrite section contents. » *(§ Output Sections)*

**Question 23 : A** — « The `#[Argument]` attribute configures $username as a required input argument. » *(§ Console Input)*

**Question 24 : B** — « Since your command is already registered as a service, you can use normal dependency injection. » *(§ Getting Services from the Service Container)*

**Question 25 : B** — « `initialize()` (optional) This method is executed before the `interact()` and the `execute()` methods. Its main purpose is to initialize variables. » *(§ Command Lifecycle)*

**Question 26 : B** — « `interact()` (optional) […] check if some of the options/arguments are missing and interactively ask the user for those values. […] it will not be called when the command is run without interaction (e.g. when passing the `--no-interaction` global option flag). » *(§ Command Lifecycle)*

**Question 27 : B** — « `__invoke()` (or `execute()`) (required) This method is executed after `interact()` and `initialize()`. » *(§ Command Lifecycle)*

**Question 28 : B** — Ordre documenté : `initialize()`, puis `interact()`, puis `execute()`/`__invoke()`. *(§ Command Lifecycle)*

**Question 29 : A** — « The most useful one is the `Symfony\Component\Console\Tester\CommandTester` class. It uses special input and output classes to ease testing without a real console. » *(§ Testing Commands)*

**Question 30 : A** — Exemple : `$commandTester->execute(['username' => 'Wouter', /* '--some-option' => 'option_value' */]);` *(§ Testing Commands)*

**Question 31 : B** — « When testing `InputOption::VALUE_NONE` command options, you must pass `true` to them: `$commandTester->execute(['--some-option' => true]);` » *(§ Testing Commands)*

**Question 32 : B** — « When testing commands using the `CommandTester` class, console events are not dispatched. If you need to test those events, use the `ApplicationTester` instead. » *(§ Testing Commands)*

**Question 33 : A** — « You have access to such information thanks to the `Symfony\Component\Console\Terminal` class. » *(§ Testing Commands)*

**Question 34 : B** — « Don't forget to call `setAutoExit(false)` on the application before passing it to `ApplicationTester`. Without it, the application calls `exit()` after running the command, which would terminate the PHPUnit process. » *(§ Testing Console Applications)*

**Question 35 : A** — « The `CommandTester` class does not implement `ConsoleOutputInterface`, so methods like `section()` are not directly accessible. To test them, use the `capture_stderr_separately` option of the `execute()` method. » *(§ Testing Commands)*

**Question 36 : B** — « Symfony registers an event subscriber to listen to the `ConsoleEvents::TERMINATE` event and adds a log message whenever a command doesn't finish with the `0` exit status. » *(§ Logging Command Errors)*

**Question 37 : A** — « When a command is running, many events are dispatched, one of them allows you to react to signals. » *(§ Using Console Events)*

**Question 38 : A** — « Signals are asynchronous notifications sent to a process in order to notify it of an event that occurred. For example, when you press Ctrl + C in a command, the operating system sends the SIGINT signal to it. » *(§ Handling Signals)*

**Question 39 : B** — « All the available signals (SIGINT, SIGQUIT, etc.) are defined as constants of the PCNTL PHP extension. The extension has to be installed for these constants to be available. » *(§ Handling Signals)*

**Question 40 : A** — « a command can handle these signals by implementing the `SignalableCommandInterface` and subscribing to one or more signals » : `getSubscribedSignals()` et `handleSignal()`. *(§ Handling Signals)*

**Question 41 : B** — « Symfony doesn't handle any signal received by the command (not even SIGKILL, SIGTERM, etc). This behavior is intended, as it gives you the flexibility to handle all signals e.g. to do some tasks before terminating the command. » *(§ Handling Signals)*

**Question 42 : B** — « make sure that the debug mode and the profiler are enabled. Then, add the `--profile` option when running the command. » *(§ Profiling Commands)*

**Question 43 : B** — « If you run the command in verbose mode (adding the `-v` option), Symfony will display in the output a clickable link to the command profile. » *(§ Profiling Commands)*

**Question 44 : A** — « add the `--no-reset` option to the command or you won't get any profile. Moreover, consider using the `--limit` option to only process a few messages to make the profile more readable. » *(§ Profiling Commands)*

**Question 45 : B** — « Both syntaxes are supported, but invokable commands are recommended. » *(§ Legacy Syntax to Define Commands)*

**Question 46 : B** — « You can optionally define a description, help message and the input options and arguments by overriding the `configure()` method. » *(§ Legacy Syntax to Define Commands)*

**Question 47 : B** — « Using the `#[AsCommand]` attribute to define a description instead of the `setDescription()` method retrieves the command description without instantiating its class, which makes the `php bin/console list` command run much faster. » *(§ Legacy Syntax to Define Commands)*

**Question 48 : A** — « Use the `Application::doRun`. Then, create a new `ArrayInput` with the arguments and options you want to pass to the command. The command name must be the first argument. » *(Calling — introduction)*

**Question 49 : A** — « Using `doRun()` instead of `run()` prevents autoexiting and allows you to return the exit code instead. Also, using `$application->doRun()` instead of `$application->find('demo:greet')->run()` will allow proper events to be dispatched for that inner command as well. » *(Calling — introduction)*

**Question 50 : A** — « all the commands will run in the same process and some of Symfony's built-in commands may not work well this way. For instance, the `cache:clear` and `cache:warmup` commands change some class definitions, so running something after them is likely to break. » *(Calling — introduction)*

**Question 51 : A** — « Most of the time, calling a command from code that is not executed on the command line is not a good idea. The main reason is that the command's output is optimized for the console and not to be passed to other commands. » *(Calling — introduction)*

**Question 52 : A** — « In comparison with a direct call from the console, calling a command from a controller has a slight performance impact because of the request stack overhead. » *(Controller — introduction)*

**Question 53 : B** — « However, when the command is part of a third-party library, you don't want to modify or duplicate their code. Instead, you can run the command directly from the controller. » *(Controller — introduction)*

**Question 54 : B** — Exemple : `$output = new BufferedOutput(); $application->run($input, $output); $content = $output->fetch();` *(Controller — introduction)*

**Question 55 : A** — « By telling the `BufferedOutput` it is decorated via the second parameter, it will return the Ansi color-coded content. The SensioLabs AnsiToHtml converter can be used to convert this to colorful HTML. » *(Controller — § Showing Colorized Command Output)*

**Question 56 : A** — Exemple : `$application = new Application($kernel); $application->setAutoExit(false);` *(Controller — introduction)*

**Question 57 : B** — « If you're using the default services.yaml configuration, your command classes are already registered as services. Great! This is the recommended setup. » *(Services — introduction)*

**Question 58 : B** — « You *do* have access to services in `configure()`. However, if your command is not lazy, try to avoid doing any work (e.g. making database queries), as that code will be run, even if you're using the console to execute a different command. » *(Services — introduction)*

**Question 59 : B** — « To make your command lazily loaded, either define its name using the PHP `AsCommand` attribute. » *(Services — § Lazy Loading)*

**Question 60 : B** — « Calling the `list` command will instantiate all commands, including lazy commands. However, if the command is a `Symfony\Component\Console\Command\LazyCommand`, then the underlying command factory will not be executed. » *(Services — § Lazy Loading)*

**Question 61 : A** — « you can define the command as **hidden** by setting to `true` the `hidden` property of the `AsCommand` attribute. » *(Hide — introduction)*

**Question 62 : A** — « You can also define a command as hidden using the pipe (`|`) syntax of command aliases. To do this, use the command name as one of the aliases and leave the main command name (the part before the `|`) empty » : `#[AsCommand(name: '|app:legacy')]`. *(Hide — introduction)*

**Question 63 : B** — « Hidden commands are still available using the JSON or XML descriptor. » *(Hide — introduction)*

**Question 64 : B** — « This approach can have downsides as some commands might be expensive to instantiate in which case you may want to lazy-load them. » *(Lazy — introduction)*

**Question 65 : B** — « lazy-loading is not absolute. Indeed a few commands such as `list`, `help` or `_complete` can require instantiating other commands although they are lazy. For example `list` needs to get the name and description of all commands. » *(Lazy — introduction)*

**Question 66 : A** — « the `Application::setCommandLoader()` method accepts any `CommandLoaderInterface` instance so you can use your own implementation. » *(Lazy — introduction)*

**Question 67 : B** — « it takes an array of `Command` factories as its only constructor argument […] Factories can be any PHP callable and will be executed each time `FactoryCommandLoader::get()` is called. » *(Lazy — § Built-in Command Loaders)*

**Question 68 : A** — « its constructor takes a PSR-11 `ContainerInterface` implementation as its first argument and a command map as its last argument. The command map must be an array with command names as keys and service identifiers as values. » *(Lazy — § Built-in Command Loaders)*

**Question 69 : A** — « the Console component provides a PHP trait called `LockableTrait` that adds two convenient methods to lock and release commands. » *(Lockable — introduction)*

**Question 70 : A** — « `$this->lock()` … `$this->release();` » — les deux méthodes ajoutées par le trait. *(Lockable — introduction)*

**Question 71 : A** — « The LockableTrait will use the `SemaphoreStore` if available and will default to `FlockStore` otherwise. » *(Lockable — introduction)*

**Question 72 : B** — « if not released explicitly, Symfony releases the lock automatically when the execution of the command ends. » *(Lockable — introduction)*

**Question 73 : A** — « # suppress all output, including errors `--silent` … `-q`/`--quiet` … normal behavior, no option required … `-v` … `-vv` … `-vvv` ». *(Verbosity — introduction)*

**Question 74 : B** — « suppress all output, including errors `--silent` [vs] suppress all output (even the command result messages) but display errors `-q`/`--quiet` ». *(Verbosity — introduction)*

**Question 75 : A** — « The verbosity level can also be controlled globally for all commands with the `SHELL_VERBOSITY` environment variable (the `-q` and `-v` options still have more precedence over the value of `SHELL_VERBOSITY`). » *(Verbosity — introduction)*

**Question 76 : A** — « available methods: `->isSilent()`, `->isQuiet()`, `->isVerbose()`, `->isVeryVerbose()`, `->isDebug()` ». *(Verbosity — introduction)*

**Question 77 : B** — « When the silent or quiet level are used, all output is suppressed as the default `Output::write` method returns without actually printing. » *(Verbosity — introduction)*

**Question 78 : B** — « The argument mode (required, optional, array) is inferred from the parameter type: Required: […] not nullable; Optional: Parameters with a default value; Array: Parameters with the array type. » *(Input — § Using Arguments in Invokable Commands)*

**Question 79 : B** — « By default, it's the constructor parameter name converted to kebab-case (e.g. `$lastName` becomes `last-name`). » *(Input — § Using Arguments in Invokable Commands)*

**Question 80 : B** — « The string input is automatically converted to the corresponding enum case using `BackedEnum::from()` […] If the user provides a value that doesn't match any enum case, an error message is displayed along with the list of valid values. » *(Input — § Using Arguments in Invokable Commands)*

**Question 81 : A, B, C** — « `InputArgument::REQUIRED` The argument is mandatory. […] `InputArgument::OPTIONAL` […] This is the default behavior of arguments; `InputArgument::IS_ARRAY` […] it must be used at the end of the argument list. » D est faux : « You can combine `IS_ARRAY` with `REQUIRED` or `OPTIONAL` ». *(Input — § Using the Classic configure() Method)*

**Question 82 : A** — « Boolean flag (VALUE_NONE): bool type with default false. » *(Input — § Using Options in Invokable Commands)*

**Question 83 : A** — « Negatable flag (VALUE_NEGATABLE): bool type with default true or nullable ?bool with default null. » *(Input — § Using Options in Invokable Commands)*

**Question 84 : A** — « Value optional (VALUE_OPTIONAL): Union types string|bool, int|bool, or float|bool with default false. » *(Input — § Using Options in Invokable Commands)*

**Question 85 : A, B, C** — « `InputOption::VALUE_NONE` […] This is the default behavior of options; […] `InputOption::VALUE_NEGATABLE` Accept either the flag […] or its negation […] You need to combine `VALUE_IS_ARRAY` with `VALUE_REQUIRED` or `VALUE_OPTIONAL` ». D est faux : « `InputOption::VALUE_REQUIRED` This value is required […] the option itself is still optional ». *(Input — § Using the Classic addOption() Method)*

**Question 86 : B** — « using this form leads to an ambiguity should the option appear before the command name. For example, `php bin/console --iterations 5 app:greet Fabien` is ambiguous; Symfony would interpret `5` as the command name. » *(Input — § Using the Classic addOption() Method)*

**Question 87 : A** — « you can use the `MapInput` attribute to group arguments and options into a dedicated class […] The DTO class must have at least one public property with an `#[Argument]` or `#[Option]` attribute. Private, protected, and static properties are ignored. » *(Input — § Mapping Input to Objects)*

**Question 88 : B** — « DTOs are instantiated without calling their constructor and values are assigned directly to public properties. » *(Input — § Mapping Input to Objects)*

**Question 89 : A** — « If you need to transform or validate input values, use property hooks instead. » *(Input — § Mapping Input to Objects)*

**Question 90 : B** — « use the `Ask` attribute to prompt users for missing values […] Interactive attributes (`#[Ask]`, `#[Interact]`) can only be used with required console arguments. Using them with options or optional arguments is not supported and will raise an exception. » *(Input — § Interactive Input)*

**Question 91 : B** — « When the parameter type is bool, the `#[Ask]` attribute automatically uses a yes/no confirmation question. » *(Input — § Interactive Input)*

**Question 92 : A** — « use the `Interact` attribute to mark a method that will be called during the interactive phase […] The method marked with `#[Interact]` must be public and non-static. » *(Input — § Custom Interactive Logic with #[Interact])*

**Question 93 : B** — « When both `#[Ask]` and `#[Interact]` are used, they run in the following order […] 1. `#[Ask]` on `__invoke()` parameters 2. `#[Ask]` on DTO properties 3. `#[Interact]` on the DTO class 4. `#[Interact]` on the command class. » *(Input — § Custom Interactive Logic with #[Interact])*

**Question 94 : B** — « you have to set the option's default value to `false` […] `false === $optionValue`: option not passed; `null === $optionValue`: option passed with no value. » *(Input — § Options with optional arguments)*

**Question 95 : B** — « Symfony provides a `ArgvInput::getRawTokens` method to fetch the raw input that was passed to the command. » *(Input — § Fetching The Raw Command Input)*

**Question 96 : A** — « use the `suggestedValues` parameter to provide completion values […] The Console component comes with a special `CommandCompletionTester` class to help you unit test the completion logic. » *(Input — § Adding Argument/Option Value Completion)*

**Question 97 : A, B, C** — « The Console component adds some predefined options to all commands: `--verbose` […] `--silent` […] `--quiet|-q` […] `--no-interaction|-n` […] `--version|-V` […] `--help|-h` […] `--ansi|--no-ansi` […] `--profile` ». D est faux : « When using the FrameworkBundle, two more options are predefined: `--env|-e` […] `--no-debug` ». *(Input — § Command Global Options)*

**Question 98 : B** — « Symfony provides the Symfony Style Guide, a set of helper methods to render input and output in a consistent way. […] In order to reduce that boilerplate code […] These styles are implemented as a set of helper methods which allow you to create *semantic* commands. » *(Style — introduction)*

**Question 99 : A** — « In your `__invoke()` method, add an argument of type `SymfonyStyle`. Then, you can start using any of its helpers, such as `title()`. » *(Style — § Basic Usage)*

**Question 100 : A** — « `title()` […] This method is meant to be used only once in a given command […] `section()` […] This is only needed in complex commands which want to better separate their contents. » *(Style — § Titling Methods)*

**Question 101 : A** — « `text()` It displays the given string or array of strings as regular text. […] `listing()` It displays an unordered list of elements […] `table()` It displays the given array of headers and rows as a compact table. » *(Style — § Content Methods)*

**Question 102 : A** — « `definitionList()` It displays the given key => value pairs as a compact list of elements » ; exemple avec `new TableSeparator()` entre deux groupes. *(Style — § Content Methods)*

**Question 103 : B** — « `createTable()` Creates an instance of the `Table` helper styled according to the Symfony Style Guide, which allows you to use features such as dynamically appending rows. » *(Style — § Content Methods)*

**Question 104 : B** — « It's meant to be used once to display the final result of executing the given command, but you can use it repeatedly during the execution of the command. » *(Style — § Result Methods)*

**Question 105 : B** — « `caution()` Similar to the `note()` helper, but the contents are more prominently highlighted. The resulting contents resemble an error message, so you should avoid using this helper unless strictly necessary. » *(Style — § Admonition Methods)*

**Question 106 : A** — « `progressStart()` […] `progressAdvance()` […] `progressFinish()` […] `progressIterate()` If your progress bar loops over an iterable collection, use the `progressIterate()` helper. » *(Style — § Progress Bar Methods)*

**Question 107 : A** — « `$io->ask('Number of workers to start', '1', function (string $number): int { ... });` » *(Style — § User Input Methods)*

**Question 108 : A** — « It's very similar to the `ask()` method but the user's input will be hidden and it cannot define a default value. » *(Style — § User Input Methods)*

**Question 109 : B** — « It asks a Yes/No question to the user and it only returns `true` or `false` […] `$io->confirm('Restart the web server?', true);` » *(Style — § User Input Methods)*

**Question 110 : A** — « Finally, you can allow users to select multiple choices. To do so, users must separate each choice with a comma […] `multiSelect: true`. » *(Style — § User Input Methods)*

**Question 111 : B** — « Choice questions display both the choice value and a numeric index, which starts from 0 by default. […] To use custom indices, pass an array with custom numeric keys as the choice values. » *(Style — § User Input Methods)*

**Question 112 : B** — « If you print any URL it won't be broken/cut, it will be clickable […] If the "well formatted output" is more important, you can switch it off: `$io->getOutputWrapper()->setAllowCutUrls(true);` » *(Style — § Result Methods)*

**Question 113 : A** — « Create a class that implements the `StyleInterface` […] Then, instantiate this custom class instead of the default `SymfonyStyle` […] Thanks to the `StyleInterface` you won't need to change the code of your commands. » *(Style — § Defining your Own Styles)*

**Question 114 : A** — « provides a convenient method called `getErrorStyle()` to switch between both streams. […] If you create a `SymfonyStyle` instance with an `OutputInterface` object that is not an instance of `ConsoleOutputInterface`, the `getErrorStyle()` method will have no effect. » *(Style — § Writing to the error output)*

**Question 115 : A** — « // green text `$output->writeln('<info>foo</info>');` // white text on a red background `$output->writeln('<error>foo</error>');` » *(Style — § Using Color Styles)*

**Question 116 : A, B, C** — « available options are: `bold`, `underscore`, `blink`, `reverse` […] and `conceal` (sets the foreground color to transparent, making the typed text invisible […] commonly used when asking the user to type sensitive information). » `italic` (D) n'est pas listée. *(Style — § Using Color Styles)*

**Question 117 : A** — « Commands can use the special `<href>` tag to display links […] Otherwise, you'll see "Symfony Homepage" as regular text and the URL will be lost. » *(Style — § Displaying Clickable Links)*

**Question 118 : A** — « The Question Helper has a single method `ask` that needs an `InputInterface` instance as the first argument, an `OutputInterface` instance as the second argument and a `Question` as last argument. » *(QuestionHelper — introduction)*

**Question 119 : A** — « If the user answers with `y` […] due to default answer regex […] The regex defaults to `/^y/i`. […] The second argument […] is the default value to return if the user doesn't enter any valid input. If the second argument is not provided, `true` is assumed. » *(QuestionHelper — § Asking the User for Confirmation)*

**Question 120 : B** — « By default, the question helper uses the error output (stderr) as its default output. This behavior can be changed by passing an instance of `StreamOutput` to the `ask` method. » *(QuestionHelper — § Asking the User for Confirmation)*

**Question 121 : A** — « use `ChoiceQuestion::setMultiselect` […] The user can also enter strings […] and even mix strings and the index of the choices. » *(QuestionHelper — § Multiple Choices)*

**Question 122 : A** — « `$question->setAutocompleterValues($bundles);` […] you can provide a callback function to dynamically generate suggestions » via `setAutocompleterCallback()`. *(QuestionHelper — § Autocompletion)*

**Question 123 : A** — « You can also specify if you want to not trim the answer by setting it directly with `Question::setTrimmable`. » *(QuestionHelper — § Do not Trim the Answer)*

**Question 124 : A** — « you may specify that the response to a question should allow multiline answers by passing `true` to `Question::setMultiline` […] Multiline questions stop reading user input after receiving an end-of-transmission control character (Ctrl-D on Unix systems or Ctrl-Z on Windows). » *(QuestionHelper — § Accept Multiline Answers)*

**Question 125 : A** — « If the user doesn't respond within the specified timeout, a `MissingInputException` will be thrown […] The timeout only applies to interactive input streams. For non-interactive streams […] the timeout is ignored. » *(QuestionHelper — § Setting a Timeout for User Input)*

**Question 126 : A** — « Symfony will use either a binary, change stty mode or use another trick to hide the response. If none is available, it will fallback and allow the response to be visible unless you set this behavior to `false` using `Question::setHiddenFallback` […] a `RuntimeException` would be thrown. » *(QuestionHelper — § Hiding the User's Response)*

**Question 127 : A** — « The normalizer is called first and the returned value is used as the input of the validator. » *(QuestionHelper — § Normalizing the Answer)*

**Question 128 : A** — « The `$validator` is a callback which handles the validation. It should throw an exception if there is something wrong. […] You can set the max number of times to ask with the `Question::setMaxAttempts` method […] Using `null` means the number of attempts is infinite. » *(QuestionHelper — § Validating the Answer)*

**Question 129 : B** — « You can even use the Validator component to validate the input by using the `Validation::createCallable` method. » *(QuestionHelper — § Validating the Answer)*

**Question 130 : A** — « By calling `CommandTester::setInputs`, you imitate what the console would do internally with all user input […] The `CommandTester` automatically simulates a user hitting ENTER after each input, no need for passing an additional input. » *(QuestionHelper — § Testing a Command that Expects Input)*

**Question 131 : A** — « On Windows systems Symfony uses a special binary to implement hidden questions. This means that those questions don't use the default `Input` console object and therefore you can't test them on Windows. » *(QuestionHelper — § Testing a Command that Expects Input)*

**Question 132 : A** — « To reproduce this style, you can use the `FormatterHelper::formatSection` method » : `[SomeSection] Here is some message related to that section`. *(FormatterHelper — § Print Messages in a Section)*

**Question 133 : B** — « If you pass `true` as third parameter, the block will be formatted with more padding (one blank line above and below the messages and 2 spaces on the left and right). » *(FormatterHelper — § Print Messages in a Block)*

**Question 134 : A** — « `$truncatedMessage = $formatter->truncate($message, 7);` […] If the length is negative, the number of characters to truncate is counted from the end of the string. » *(FormatterHelper — § Print Truncated Messages)*

**Question 135 : A** — « By default, the `...` suffix is used. If you wish to use a different suffix, pass it as the third argument to the method. […] If you don't want to use suffix at all, pass an empty string. » *(FormatterHelper — § Custom Suffix)*

**Question 136 : A** — « `Helper::formatTime(125, 2); // 2 min, 5 s` » *(FormatterHelper — § Formatting Time)*

**Question 137 : A** — « `Helper::formatMemory(1024 * 1024); // 1.0 MiB` » *(FormatterHelper — § Formatting Memory)*

**Question 138 : B** — « By default, the progress bar helper uses the error output (stderr) as its default output. This behavior can be changed by passing an instance of `StreamOutput` to the `ProgressBar` constructor. » *(ProgressBar — introduction)*

**Question 139 : A** — « you can also regress the progress bar (i.e. step backwards) by calling `$progress->advance()` with a negative value. » *(ProgressBar — introduction)*

**Question 140 : B** — « Another solution is to omit the steps argument when creating the `ProgressBar` instance […] The progress will then be displayed as a throbber. » *(ProgressBar — introduction)*

**Question 141 : A** — « you can use the `ProgressBar::iterate` method, which starts, advances and finishes the progress bar automatically. » *(ProgressBar — introduction)*

**Question 142 : A** — « By default, redraw frequency is 100ms or 10% of your max. […] use the `minSecondsBetweenRedraws` method […] and the `setRedrawFrequency` method to redraw every N iterations. » *(ProgressBar — introduction)*

**Question 143 : A** — « The built-in formats are the following: `normal`, `verbose`, `very_verbose`, `debug` […] If you don't set the number of steps […] use the `_nomax` variants. » *(ProgressBar — § Built-in Formats)*

**Question 144 : A, B, C** — « `percent`: The percentage of completion (not available if no max is defined); […] `remaining`: […] (not available if no max is defined); […] `estimated`: […] (not available if no max is defined) ». `elapsed` (D) reste toujours disponible. *(ProgressBar — § Custom Formats)*

**Question 145 : A** — « // the finished part of the bar `$progressBar->setBarCharacter(...)`; // the unfinished part `setEmptyBarCharacter(...)`; // the progress character `setProgressCharacter(...)`. » *(ProgressBar — § Bar Settings)*

**Question 146 : A** — « `ProgressBar::setPlaceholderFormatterDefinition` (This definition is globally registered for all ProgressBar instances) […] It is also possible to set a placeholder formatter per ProgressBar instance with the `setPlaceholderFormatter` method. » *(ProgressBar — § Custom Placeholders)*

**Question 147 : A** — « none of the built-in formats include that placeholder, so before displaying these messages, you must define your own custom format […] use the `setMessage()` method to set the value of the `%message%` placeholder. » *(ProgressBar — § Custom Messages)*

**Question 148 : B** — « When using Console output sections it's possible to display multiple progress bars at the same time and change their progress independently » : `$section1 = $output->section(); $progress1 = new ProgressBar($section1);` *(ProgressBar — § Displaying Multiple Progress Bars)*

**Question 149 : B** — « If you call a command with the quiet flag (-q), the progress bar won't be displayed. » *(ProgressBar — § Built-in Formats)*

**Question 150 : A** — « Unlike progress bars, these indicators are used when the command duration is indeterminate (e.g. long-running commands, unquantifiable tasks, etc.) » *(ProgressIndicator — introduction)*

**Question 151 : A** — « `$progressIndicator->start('Processing...'); … $progressIndicator->finish('Finished');` » *(ProgressIndicator — introduction)*

**Question 152 : A** — « The built-in formats are the following: `normal`, `verbose`, `very_verbose` […] If your terminal doesn't support ANSI, use the `no_ansi` variants. » *(ProgressIndicator — § Built-in Formats)*

**Question 153 : B** — « `$progressIndicator = new ProgressIndicator($output, 'verbose', 100, ['⠏', '⠛', '⠹', '⢸', '⣰', '⣤', '⣆', '⡇']);` » (quatrième argument). *(ProgressIndicator — § Custom Indicator Values)*

**Question 154 : A** — « you can replace it with your own: `$progressIndicator = new ProgressIndicator($output, finishedIndicatorValue: '🎉');` […] `$progressIndicator->finish('Failed', '🚨');` » *(ProgressIndicator — § Custom Indicator Values)*

**Question 155 : B** — « Here is a list of the built-in placeholders: `indicator` […] `elapsed` […] `memory` […] `message` ». Pas de `percent`, contrairement à `ProgressBar`. *(ProgressIndicator — § Customize Placeholders)*

**Question 156 : A** — « The simplest option is to use the table methods from Symfony Style. While convenient, this approach doesn't allow customization of the table's design. For more control […] use the `Table` console helper. » *(Table — introduction)*

**Question 157 : A** — « You can add a table separator anywhere in the output by passing an instance of `TableSeparator` as a row. » *(Table — § Adding Table Separators)*

**Question 158 : A** — « Use the `Table::setColumnWidths` method to set the column widths explicitly […] the defined column widths are always considered as the minimum column widths. If the contents don't fit, the given column width is increased. » *(Table — § Setting the Column Widths Explicitly)*

**Question 159 : A** — « If you prefer to wrap long contents in multiple rows, use the `Table::setColumnMaxWidth` method. » *(Table — § Setting the Column Widths Explicitly)*

**Question 160 : A** — « By default, table contents are displayed horizontally. You can change this behavior via the `Table::setVertical` method. » *(Table — § Rendering Vertical Tables)*

**Question 161 : A, B, C** — Styles intégrés documentés : « Compact […] Borderless […] Box […] Double box […] Markdown ». `csv`/`json` (D) n'existent pas comme styles de ce helper. *(Table — § Built-in Table Styles)*

**Question 162 : A** — « you can also apply different styles to each table cell via `TableCellStyle` » : `new TableCell('...', ['style' => new TableCellStyle([...])])`. *(Table — § Making a Custom Table Style)*

**Question 163 : A** — « To make a table cell that spans multiple columns you can use a `TableCell` » avec `colspan` ; « you can use the `colspan` and `rowspan` options at the same time. » *(Table — § Spanning Multiple Columns and Rows)*

**Question 164 : A** — « use the `Table::appendRow` method […] to add rows at the bottom of an already rendered table. The only requirement to append rows is that the table must be rendered inside a Console output section. » *(Table — § Modifying Rendered Tables)*

**Question 165 : A** — « You can create multiple lines using the `Table::addRows` method. » *(Table — § Modifying Rendered Tables)*

**Question 166 : A** — « You can also register a style globally: `Table::setStyleDefinition('colorful', $tableStyle);` […] This method can also be used to override a built-in style. » *(Table — § Making a Custom Table Style)*

**Question 167 : A** — « You can optionally display titles at the top and the bottom of the table: `$table->setHeaderTitle('Books'); $table->setFooterTitle('Page 1/2');` » *(Table — § Adding Table Titles)*

**Question 168 : B** — « All methods of this helper have an identifier as the first argument. This is a unique value for each program. This way, the helper can debug information for multiple programs at the same time. » *(DebugFormatter — § Using the Debug Formatter)*

**Question 169 : A** — « This will output: `RUN Some process description` […] You can tweak the prefix using the third argument. » *(DebugFormatter — § Starting a Program)*

**Question 170 : B** — « The third argument is a boolean which tells the function if the output is error output or not. When `true`, the output is considered error output » — préfixes `OUT`/`ERR`. *(DebugFormatter — § Output Progress Information)*

**Question 171 : A** — « you can use `DebugFormatterHelper::stop` to notify this to the users […] In case of failure, this will be in red and in case of success it will be green. » *(DebugFormatter — § Stopping a Program)*

**Question 172 : B** — Exemples d'images documentées : verbosité `-vv` montre `RUN`/`RES`, verbosité `-vvv` (debug) montre en plus la sortie préfixée `OUT`. *(ProcessHelper — introduction)*

**Question 173 : B** — « By default, the process helper uses the error output (stderr) as its default output. This behavior can be changed by passing an instance of `StreamOutput` to the `ProcessHelper::run` method. » *(ProcessHelper — introduction)*

**Question 174 : A** — « You can display a customized error message using the third argument of the `ProcessHelper::run` method […] A custom process callback can be passed as the fourth argument. » *(ProcessHelper — § Customized Display)*

**Question 175 : A** — « moves the cursor to a specific column (1st argument) and row (2nd argument) position `$cursor->moveToPosition(7, 11);` » *(Cursor — introduction)*

**Question 176 : A** — « `$position = $cursor->getCurrentPosition(); // $position[0] // columns (aka x coordinate) // $position[1] // rows (aka y coordinate)` » *(Cursor — § Moving the cursor)*

**Question 177 : A** — « `$cursor->clearLine(); … $cursor->clearLineAfter(); … $cursor->clearOutput(); … $cursor->clearScreen();` » *(Cursor — § Clearing output)*

**Question 178 : A** — « You also can leverage the `Cursor::show` and `Cursor::hide` methods on the cursor. » *(Cursor — § Clearing output)*

**Question 179 : A** — « The `TreeHelper::createTree` method creates a tree structure from an array and returns a `Tree` object that can be rendered in the console. » *(Tree — introduction)*

**Question 180 : A** — « you can build the tree programmatically by creating a new instance of the `Tree` class and adding nodes to it » via `TreeNode` et `addChild()`. *(Tree — § Building a Tree Programmatically)*

**Question 181 : B** — « You can also build part of the tree from an array and then add other nodes: `$node = TreeNode::fromValues($array); $node->addChild('templates');` » *(Tree — § Building a Tree Programmatically)*

**Question 182 : A, B, C** — Styles documentés : « Default […] Box […] Double box […] Compact […] Light […] Minimal […] Rounded ». `fancy()`/`neon()` (D) n'existent pas. *(Tree — § Built-in Tree Styles)*

**Question 183 : A** — « You can create your own tree style by passing the characters to the constructor of the `TreeStyle` class » : `new TreeStyle('🟣 ', '🟠 ', ...)`. *(Tree — § Making a Custom Tree Style)*

**Question 184 : B** — « It's commonly used to render directory hierarchies, but you can also use it to render any tree-like content, such as organizational charts, product category trees, taxonomies, etc. » *(Tree — introduction)*

**Question 185 : B** — « The given contents can be defined in a multi-dimensional array » : exemple avec `'src' => ['Command', 'Controller' => ['DefaultController.php'], 'Kernel.php']`. *(Tree — § Rendering a Tree from an Array)*

**Question 186 : A** — Signature documentée : `TreeHelper::createTree($io, $node, ...)` / `TreeHelper::createTree($io, null, $array)` — `$io` (une `SymfonyStyle`/`OutputInterface`) est toujours le premier argument. *(Tree — § Rendering a Tree from an Array)*

---

## Pour aller plus loin

Les pages listées dans la section [Learn More](https://symfony.com/doc/8.0/console.html#learn-more) de la page (9 pages « how-to ») et ses 9 « helpers » :

**Pages « how-to »**

- [How to Call Other Commands](https://symfony.com/doc/8.0/console/calling_commands.html) — questions 48 à 51
- [How to Call a Command from a Controller](https://symfony.com/doc/8.0/console/command_in_controller.html) — questions 52 à 56
- [How to Define Commands as Services](https://symfony.com/doc/8.0/console/commands_as_services.html) — questions 57 à 60
- [How to Hide Console Commands](https://symfony.com/doc/8.0/console/hide_commands.html) — questions 61 à 63
- [How to Make Commands Lazily Loaded](https://symfony.com/doc/8.0/console/lazy_commands.html) — questions 64 à 68
- [Prevent Running the Same Console Command Multiple Times](https://symfony.com/doc/8.0/console/lockable_trait.html) — questions 69 à 72
- [Verbosity Levels](https://symfony.com/doc/8.0/console/verbosity.html) — questions 73 à 77
- [Console Input (Arguments & Options)](https://symfony.com/doc/8.0/console/input.html) — questions 78 à 97
- [How to Style a Console Command](https://symfony.com/doc/8.0/console/style.html) — questions 98 à 117

**Helpers du composant Console**

- [Question Helper](https://symfony.com/doc/8.0/components/console/helpers/questionhelper.html) — questions 118 à 131
- [Formatter Helper](https://symfony.com/doc/8.0/components/console/helpers/formatterhelper.html) — questions 132 à 137
- [Progress Bar](https://symfony.com/doc/8.0/components/console/helpers/progressbar.html) — questions 138 à 149
- [Progress Indicator](https://symfony.com/doc/8.0/components/console/helpers/progressindicator.html) — questions 150 à 155
- [Table Helper](https://symfony.com/doc/8.0/components/console/helpers/table.html) — questions 156 à 167
- [Debug Formatter Helper](https://symfony.com/doc/8.0/components/console/helpers/debug_formatter.html) — questions 168 à 171
- [Process Helper](https://symfony.com/doc/8.0/components/console/helpers/processhelper.html) — questions 172 à 174
- [Cursor Helper](https://symfony.com/doc/8.0/components/console/helpers/cursor.html) — questions 175 à 178
- [Tree Helper](https://symfony.com/doc/8.0/components/console/helpers/tree.html) — questions 179 à 186
