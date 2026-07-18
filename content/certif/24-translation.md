# QCM — Les traductions (i18n)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/translation.html](https://symfony.com/doc/8.0/translation.html) et les pages de sa section [Learn more](https://symfony.com/doc/8.0/translation.html#learn-more) · **Généré le :** 22 juillet 2026
>
> **102 questions.** Chaque question propose **4 réponses (A à D)**, dont **1 à 4 sont correctes**. La formulation indique ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le [corrigé commenté](#corrigé) se trouve en fin de fichier.

## Notions de base et installation

### Question 1

Que désigne le terme *locale* dans le contexte de l'internationalisation Symfony, et quel format est recommandé ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement le fuseau horaire de l'utilisateur, sans lien avec la langue
- [ ] **B.** Un identifiant technique interne à Symfony, sans rapport avec un standard ISO
- [ ] **C.** Le format recommandé est toujours `FR-fr`, code pays en premier
- [ ] **D.** Approximativement la langue et le pays de l'utilisateur ; le format recommandé est un code langue ISO 639-1, un underscore, puis un code pays ISO 3166-1 alpha-2 (ex. `fr_FR`)

### Question 2

Comment les traductions peuvent-elles être organisées en groupes, et quel est le groupe utilisé par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Via des « catalogues » ; le catalogue par défaut est `default`
- [ ] **B.** Via des « namespaces » PHP classiques
- [ ] **C.** Il n'existe pas de mécanisme de regroupement, chaque message étant isolé
- [ ] **D.** Via des « domaines » ; le domaine par défaut est `messages`

### Question 3

Quelle commande installe le composant Translation ? *(une seule bonne réponse)*

- [ ] **A.** `composer require symfony/i18n`
- [ ] **B.** Il est installé par défaut avec `symfony/framework-bundle`
- [ ] **C.** `composer require symfony/translator-bundle`
- [ ] **D.** `composer require symfony/translation`

### Question 4

Les polyfills d'internationalisation fournis par Symfony (`symfony/polyfill-intl-icu`…) permettent-ils de traduire vers n'importe quelle langue sans l'extension PHP `intl` ? *(une seule bonne réponse)*

- [ ] **A.** Non, ils ne fonctionnent que si l'extension `intl` est déjà installée, rendant les polyfills inutiles
- [ ] **B.** Oui, mais uniquement pour le formatage des nombres, jamais pour les messages traduits
- [ ] **C.** Non, ces polyfills ne supportent que l'anglais ; l'extension `intl` est nécessaire pour traduire vers d'autres langues
- [ ] **D.** Oui, ils couvrent toutes les langues à l'identique de l'extension `intl`

### Question 5

Que configure le fichier généré par la recipe d'installation du traducteur ? *(plusieurs bonnes réponses)*

- [ ] **A.** La locale par défaut de l'application (`default_locale`)
- [ ] **B.** Le répertoire où se trouvent les fichiers de traduction (`default_path`)
- [ ] **C.** La liste exhaustive de toutes les traductions de l'application
- [ ] **D.** Le fuseau horaire par défaut du serveur

## Traduction de base

### Question 6

Comment traduire un message statique depuis un contrôleur ? *(une seule bonne réponse)*

- [ ] **A.** En appelant une fonction globale `trans('Symfony is great')`
- [ ] **B.** En instanciant directement `new Translator()` sans passer par le container
- [ ] **C.** Via l'attribut `#[Translate]` sur la méthode du contrôleur
- [ ] **D.** En type-hintant `TranslatorInterface` et en appelant `$translator->trans('Symfony is great')`

### Question 7

Quelles sont les deux philosophies possibles pour rédiger l'identifiant d'un message à traduire, illustrées par `'Symfony is great'` vs `'symfony.great'` ? *(une seule bonne réponse)*

- [ ] **A.** Il n'existe qu'une seule philosophie possible, l'utilisation de mots-clés étant obligatoire
- [ ] **B.** Utiliser un UUID généré automatiquement pour chaque message, dans tous les cas
- [ ] **C.** Utiliser le nom de la méthode du contrôleur comme identifiant systématique
- [ ] **D.** Utiliser le message réel dans la langue par défaut comme identifiant, ou utiliser un « mot-clé » (keyword) qui doit alors aussi être traduit pour la locale par défaut

### Question 8

D'après la documentation, quelle approche est recommandée pour une application multi-langue, et laquelle pour un bundle partagé contenant ses propres traductions ? *(une seule bonne réponse)*

- [ ] **A.** L'inverse : mots-clés pour les bundles partagés, messages réels pour les applications multi-langues
- [ ] **B.** Peu importe le contexte, un seul format doit être utilisé dans toute l'application Symfony
- [ ] **C.** Les bundles partagés ne peuvent jamais contenir leurs propres ressources de traduction
- [ ] **D.** Le format « mot-clé » est souvent recommandé pour les applications multi-langues ; le message réel est recommandé pour les bundles partagés, pour rester lisible si le traducteur est désactivé

### Question 9

Les formats YAML et PHP supportent-ils des identifiants imbriqués (comme `symfony.is.great`) pour éviter les répétitions ? *(une seule bonne réponse)*

- [ ] **A.** Non, chaque identifiant doit toujours être écrit à plat, quel que soit le format
- [ ] **B.** Oui, une structure imbriquée (`symfony: is: great: ...`) est aplatie en un identifiant `symfony.is.great`
- [ ] **C.** Non, seul XLIFF supporte les identifiants imbriqués
- [ ] **D.** Oui, mais uniquement en YAML, jamais en PHP

### Question 10

Quelles sont les étapes du processus de traduction lors de l'appel à `trans()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Déterminer la locale de l'utilisateur courant, stockée sur la requête
- [ ] **B.** Charger un catalogue de messages traduits pour cette locale (incluant la locale de repli et les locales activées)
- [ ] **C.** Retourner la traduction si le message est dans le catalogue, sinon retourner le message d'origine
- [ ] **D.** Recompiler le container Symfony à chaque appel pour recharger les traductions

## Le format des messages et les placeholders

### Question 11

Comment traduire un message contenant une partie variable, par exemple un nom ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, un message contenant une variable ne peut jamais être traduit
- [ ] **B.** En créant un identifiant de traduction distinct pour chaque valeur possible de la variable
- [ ] **C.** En remplaçant la partie variable par un placeholder (ex. `%name%`), puis en passant sa valeur en second argument de `trans()`
- [ ] **D.** En concaténant directement la variable au message avant de le passer à `trans()`

### Question 12

Le symbole `%` autour des placeholders (`%name%`) est-il une exigence technique du composant Translation ? *(une seule bonne réponse)*

- [ ] **A.** Non, mais seul le séparateur `{}` est une alternative valide, aucun autre
- [ ] **B.** Oui, sauf en YAML où `{}` est requis à la place
- [ ] **C.** Non, c'est une simple convention pour repérer facilement les placeholders ; n'importe quel autre séparateur peut être utilisé tant que la clé correspond exactement
- [ ] **D.** Oui, c'est strictement obligatoire, aucun autre séparateur n'étant supporté

### Question 13

Quelle fonction PHP Symfony utilise-t-il en interne pour remplacer les placeholders par leurs valeurs ? *(une seule bonne réponse)*

- [ ] **A.** `str_replace()`
- [ ] **B.** `preg_replace()`
- [ ] **C.** `vsprintf()`
- [ ] **D.** `strtr()`

### Question 14

Quand les simples placeholders ne suffisent plus (ex. pluralisation, genre, formats liés à la locale), vers quelle syntaxe Symfony oriente-t-il, et quel suffixe de nom de fichier faut-il alors utiliser ? *(une seule bonne réponse)*

- [ ] **A.** Il faut alors obligatoirement écrire du PHP pur, aucune syntaxe de template n'étant suffisante
- [ ] **B.** Le suffixe `+plural`, réservé exclusivement à la pluralisation
- [ ] **C.** La syntaxe ICU MessageFormat, avec le suffixe `+intl-icu` dans le nom du fichier de traduction
- [ ] **D.** Une syntaxe Twig personnalisée, sans changement de nom de fichier

## Les objets traduisibles

### Question 15

Pourquoi préférer un objet « traduisible » (comme `TranslatableMessage`) à un appel direct à `$translator->trans()` dans un service, une value object ou une méthode d'enum ? *(une seule bonne réponse)*

- [ ] **A.** Parce que `TranslatableMessage` traduit toujours plus rapidement qu'un appel direct
- [ ] **B.** Il n'y a aucune différence pratique, c'est uniquement une question de style
- [ ] **C.** Pour éviter d'injecter le service `translator` partout et de devoir le mocker dans chaque test ; la traduction n'a lieu que lorsque l'objet atteint une couche consciente de la traduction (ex. Twig)
- [ ] **D.** Parce que `$translator->trans()` ne fonctionne que dans les contrôleurs, jamais ailleurs

### Question 16

Quelle interface `TranslatableMessage` implémente-t-elle, et quel raccourci fonctionnel permet d'en créer une avec moins de verbosité ? *(une seule bonne réponse)*

- [ ] **A.** `Stringable` uniquement ; aucun raccourci n'existe
- [ ] **B.** `TranslatableInterface` ; la méthode statique `TranslatableMessage::create()`
- [ ] **C.** `TranslatableInterface` ; la fonction `t()`
- [ ] **D.** `TranslatorAwareInterface` ; la fonction `trans()`

### Question 17

Les paramètres passés à un `TranslatableMessage` peuvent-ils eux-mêmes être des instances de `TranslatableMessage` ? *(une seule bonne réponse)*

- [ ] **A.** Non, seules des chaînes de caractères sont acceptées comme paramètres
- [ ] **B.** Oui, mais uniquement en PHP, jamais depuis Twig
- [ ] **C.** Non, cela provoquerait une boucle infinie de traduction
- [ ] **D.** Oui

### Question 18

Pourquoi retourner un `TranslatableMessage` depuis une méthode d'enum plutôt qu'une simple chaîne ou clé de traduction, d'après les deux inconvénients cités par la documentation ? *(une seule bonne réponse)*

- [ ] **A.** Il n'y a en réalité aucun inconvénient documenté, c'est une simple préférence stylistique
- [ ] **B.** Une simple chaîne ne permet pas d'attacher des paramètres (ex. pluralisation) ni de préciser un domaine, et la commande `translation:extract` ne peut pas détecter ces clés (risquant de les marquer comme inutilisées avec `--clean`)
- [ ] **C.** Une simple chaîne provoque systématiquement une erreur de compilation dans une méthode d'enum
- [ ] **D.** `translation:extract` ne fonctionne que sur les enums utilisant `TranslatableMessage`, jamais sur les autres classes

### Question 19

Que doit implémenter une classe pour un contrôle plus fin sur sa logique de traduction (ex. dépendant de conditions à l'exécution), au-delà d'un simple identifiant statique ? *(une seule bonne réponse)*

- [ ] **A.** `NormalizableInterface`, réutilisé du composant Serializer
- [ ] **B.** Il n'existe aucune interface pour ce cas, seul `TranslatableMessage` étant utilisable
- [ ] **C.** `Stringable`, dont la méthode `__toString()` reçoit alors le service `translator` en argument
- [ ] **D.** `TranslatableInterface`, avec sa seule méthode requise `trans(TranslatorInterface $translator, ?string $locale = null): string`

### Question 20

À quoi sert la classe `StaticMessage`, et dans quel cas est-elle utile ? *(une seule bonne réponse)*

- [ ] **A.** À forcer la traduction vers la locale par défaut, quelle que soit la locale courante
- [ ] **B.** C'est un simple alias de `TranslatableMessage`, sans différence de comportement
- [ ] **C.** À empêcher explicitement qu'un message ne soit traduit, utile par exemple pour du contenu défini par l'utilisateur qui doit rester tel quel
- [ ] **D.** À mettre en cache une traduction déjà résolue, pour accélérer les appels suivants

## Les traductions dans les templates

### Question 21

Comment définir le domaine de traduction pour un template Twig entier en une seule fois ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas configurable par template, uniquement globalement dans `translation.yaml`
- [ ] **B.** Avec le tag `{% trans_default_domain 'app' %}`
- [ ] **C.** Avec le filtre `{{ '' |trans_default_domain('app') }}`
- [ ] **D.** Via une variable globale Twig `default_domain`

### Question 22

Le tag `trans_default_domain` s'applique-t-il aussi aux templates inclus (`{% include %}`) depuis le template où il est déclaré ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend de la version de Twig utilisée
- [ ] **B.** Oui, mais uniquement si le template inclus ne définit pas lui-même de domaine
- [ ] **C.** Non, il n'influence que le template courant, pas les templates inclus, pour éviter les effets de bord
- [ ] **D.** Oui, il s'applique en cascade à tous les templates inclus, sans exception

### Question 23

Par défaut, le résultat du filtre `trans` est-il échappé automatiquement, et comment désactiver cet échappement ? *(une seule bonne réponse)*

- [ ] **A.** Non, il n'est jamais échappé, contrairement aux autres variables Twig
- [ ] **B.** Oui, et il n'existe aucun moyen de désactiver cet échappement pour le filtre `trans`
- [ ] **C.** Cela dépend uniquement du format du fichier de traduction utilisé
- [ ] **D.** Oui, il est échappé par défaut ; appliquer le filtre `raw` après `trans` désactive l'échappement automatique

### Question 24

Dans le tag Twig `{% trans %}Hello %name%{% endtrans %}`, la notation `%var%` des placeholders est-elle obligatoire ? *(une seule bonne réponse)*

- [ ] **A.** Non, aucune notation particulière n'est requise avec le tag, contrairement au filtre
- [ ] **B.** Cela dépend du domaine de traduction utilisé
- [ ] **C.** Oui, cette notation est requise lors de la traduction via le tag
- [ ] **D.** Non, `{var}` fonctionne également sans configuration supplémentaire avec le tag

### Question 25

Comment afficher littéralement un caractère `%` dans un message traduit via le tag `trans`, par exemple `Percent: %percent%%%`? *(une seule bonne réponse)*

- [ ] **A.** En utilisant l'entité HTML `&percnt;`
- [ ] **B.** En doublant le caractère `%`
- [ ] **C.** En l'échappant avec un antislash (`\%`)
- [ ] **D.** Ce n'est pas possible avec le tag `trans`, uniquement avec le filtre

### Question 26

Quelle différence majeure existe-t-il entre le tag `trans` et le filtre `trans`, concernant l'échappement automatique ? *(une seule bonne réponse)*

- [ ] **A.** Les deux appliquent systématiquement le même échappement automatique
- [ ] **B.** Le filtre n'échappe jamais, alors que le tag échappe toujours
- [ ] **C.** L'échappement dépend uniquement du moteur de rendu Twig configuré, pas du tag/filtre utilisé
- [ ] **D.** Le tag `trans` n'applique **pas** l'échappement automatique de sortie, contrairement au filtre

## Paramètres de traduction globaux

### Question 27

Comment définir un paramètre de traduction réutilisable dans plusieurs messages, par exemple le nom de l'application ? *(une seule bonne réponse)*

- [ ] **A.** En créant une constante PHP globale accessible depuis Twig
- [ ] **B.** Ce n'est pas possible, chaque paramètre doit être répété dans chaque message
- [ ] **C.** Via l'option `translator.shared_parameters`
- [ ] **D.** Via l'option `translator.globals` de la configuration

### Question 28

Quand un paramètre global utilise la syntaxe `%...%` dans `translator.globals`, faut-il l'échapper d'une façon particulière en YAML ? *(une seule bonne réponse)*

- [ ] **A.** Non, aucun échappement particulier n'est nécessaire pour ce cas
- [ ] **B.** Oui, en l'entourant de guillemets doubles au lieu de simples
- [ ] **C.** Cela ne concerne que la syntaxe `{...}`, jamais `%...%`
- [ ] **D.** Oui, en doublant les caractères `%` (ex. `'%%app_name%%'`)

### Question 29

Si un paramètre est à la fois défini comme global et passé explicitement à un appel `trans()` précis, lequel prévaut ? *(une seule bonne réponse)*

- [ ] **A.** Une exception est levée en cas de conflit entre les deux
- [ ] **B.** Les deux valeurs sont concaténées
- [ ] **C.** Le paramètre passé explicitement au message, qui surcharge le paramètre global
- [ ] **D.** Le paramètre global prévaut toujours, sans possibilité de le surcharger

## Forcer la locale du traducteur

### Question 30

Comment forcer explicitement la locale utilisée pour une traduction précise, indépendamment de la locale courante de la requête ? *(une seule bonne réponse)*

- [ ] **A.** En changeant temporairement `$request->setLocale()` juste avant l'appel
- [ ] **B.** Uniquement via le `LocaleSwitcher`, jamais directement sur `trans()`
- [ ] **C.** En passant l'argument nommé `locale` à `trans()`, par exemple `$translator->trans('Symfony is great', locale: 'fr_FR')`
- [ ] **D.** Ce n'est pas possible, la locale est toujours celle de la requête courante

## Extraire et synchroniser les catalogues de traduction

### Question 31

Quelle commande aide à extraire les messages à traduire et à synchroniser les fichiers de traduction ? *(une seule bonne réponse)*

- [ ] **A.** `debug:translation`
- [ ] **B.** `translation:scan`
- [ ] **C.** `translation:extract`
- [ ] **D.** `translation:sync`

### Question 32

Que fait l'option `--force` de `translation:extract`, par opposition à `--dump-messages` ? *(une seule bonne réponse)*

- [ ] **A.** Les deux options font strictement la même chose
- [ ] **B.** `--force` supprime tous les fichiers de traduction existants avant de les régénérer entièrement
- [ ] **C.** `--dump-messages` écrit les fichiers, `--force` ne fait qu'un aperçu
- [ ] **D.** Elle met réellement à jour les fichiers de traduction avec les chaînes manquantes, alors que `--dump-messages` se contente d'afficher les messages sans rien écrire

### Question 33

Dans quels emplacements/situations la commande `translation:extract` recherche-t-elle des messages à traduire ? *(plusieurs bonnes réponses)*

- [ ] **A.** Les templates du répertoire `templates/` (ou des chemins Twig configurés)
- [ ] **B.** Tout fichier PHP qui injecte/autowire le service `translator` et appelle `trans()`
- [ ] **C.** Tout fichier PHP de `src/` créant des objets traduisibles (constructeur ou `t()`)
- [ ] **D.** Les commentaires PHP au format `// TODO: translate`

### Question 34

Quel paquet Composer améliore les résultats de `translation:extract` en permettant une analyse AST plus poussée du code PHP ? *(une seule bonne réponse)*

- [ ] **A.** `symfony/ast`
- [ ] **B.** Aucun paquet n'est nécessaire, l'analyse AST étant native à PHP
- [ ] **C.** `nikic/php-parser`
- [ ] **D.** `phpstan/phpdoc-parser`

### Question 35

Par défaut, comment `translation:extract` marque-t-il une traduction encore en attente lors de la création d'une nouvelle entrée, et comment personnaliser ce marquage ? *(une seule bonne réponse)*

- [ ] **A.** En laissant la valeur entièrement vide par défaut ; `--prefix` la remplit alors avec un texte donné
- [ ] **B.** En ajoutant un commentaire `# TODO` au-dessus de l'entrée, sans option de personnalisation
- [ ] **C.** En dupliquant la valeur de la locale de repli, sans aucun marquage visuel
- [ ] **D.** En préfixant le contenu par `__` ; l'option `--prefix` permet de personnaliser ce préfixe

### Question 36

À quoi sert l'option `--no-fill` de `translation:extract`, et quel est son intérêt avec des outils de traduction externes ? *(une seule bonne réponse)*

- [ ] **A.** Elle a le même effet que `--prefix`, les deux options étant synonymes
- [ ] **B.** Elle laisse la traduction en attente complètement vide plutôt que d'y dupliquer le contenu source, ce qui facilite le repérage des chaînes non traduites
- [ ] **C.** Elle empêche toute création de nouvelle entrée dans le catalogue
- [ ] **D.** Elle remplit automatiquement la traduction avec une valeur générée aléatoirement

## Emplacement et nommage des fichiers de traduction

### Question 37

Quels sont les deux emplacements par défaut où Symfony recherche les fichiers de traduction, et lequel a la priorité la plus haute ? *(une seule bonne réponse)*

- [ ] **A.** `config/translations/` et `src/Resources/translations/`, à égalité de priorité
- [ ] **B.** Le répertoire du bundle a toujours la priorité la plus haute, quel que soit l'ordre des bundles
- [ ] **C.** Le répertoire `translations/` à la racine du projet (priorité la plus haute) et celui de chaque bundle
- [ ] **D.** Uniquement `translations/` à la racine, les bundles ne pouvant fournir aucune traduction

### Question 38

Comment fonctionne le mécanisme de surcharge des traductions d'un bundle par l'application ? *(une seule bonne réponse)*

- [ ] **A.** Il faut toujours dupliquer l'intégralité du fichier de traduction du bundle pour en surcharger une seule clé
- [ ] **B.** La surcharge ne fonctionne qu'au niveau du domaine entier, jamais clé par clé
- [ ] **C.** Ce mécanisme n'existe pas, un bundle ne pouvant jamais être surchargé
- [ ] **D.** Au niveau de la clé : seules les clés à surcharger doivent être présentes dans le fichier de priorité supérieure, les autres retombant sur les fichiers de priorité inférieure

### Question 39

Quelle convention de nommage doit suivre un fichier de traduction ? *(une seule bonne réponse)*

- [ ] **A.** Le nommage est libre, seul le contenu du fichier compte
- [ ] **B.** `domaine.locale.loader` (ex. `messages.fr.yaml`)
- [ ] **C.** `locale.domaine.loader` (ex. `fr.messages.yaml`)
- [ ] **D.** `loader.domaine.locale` (ex. `yaml.messages.fr`)

### Question 40

Parmi les formats suivants, lesquels sont reconnus nativement par leur extension pour les fichiers de traduction ? *(plusieurs bonnes réponses)*

- [ ] **A.** `.yaml`/`.yml` et `.xlf`/`.xliff`
- [ ] **B.** `.php`, `.csv` et `.json`
- [ ] **C.** `.mo`/`.po` (formats gettext) et `.qt`
- [ ] **D.** `.docx`

### Question 41

Que recommande la documentation quant au choix du format de fichier de traduction ? *(une seule bonne réponse)*

- [ ] **A.** Toujours utiliser JSON, quel que soit le contexte
- [ ] **B.** Il n'y a aucune recommandation, le choix étant purement arbitraire et sans conséquence
- [ ] **C.** YAML pour des projets simples, XLIFF si les traductions sont générées par des outils ou équipes spécialisés
- [ ] **D.** Toujours utiliser le format PHP, seul format réellement performant

### Question 42

Pourquoi faut-il vider le cache après avoir créé un nouveau catalogue de messages (ou installé un bundle contenant des traductions) ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement en environnement de production, jamais en développement
- [ ] **B.** Pour que Symfony puisse découvrir les nouvelles ressources de traduction
- [ ] **C.** Ce n'est jamais nécessaire, les nouvelles traductions étant toujours détectées à la volée
- [ ] **D.** Uniquement pour des raisons de performance, sans lien avec la découverte des fichiers

### Question 43

Comment ajouter un répertoire de traduction personnalisé, en plus des emplacements par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable d'environnement `TRANSLATION_PATHS`
- [ ] **B.** Via l'option `paths` de `framework.translator`
- [ ] **C.** Ce n'est pas configurable, seuls les emplacements par défaut sont pris en charge
- [ ] **D.** En renommant le répertoire personnalisé en `translations/`, seule convention reconnue

### Question 44

Comment la documentation recommande-t-elle de traduire le contenu stocké dans des entités Doctrine ? *(une seule bonne réponse)*

- [ ] **A.** En sérialisant l'entité entière dans chaque fichier de traduction
- [ ] **B.** Ce n'est jamais possible de traduire du contenu Doctrine, quelle que soit la méthode utilisée
- [ ] **C.** Ce n'est pas pratique via les catalogues de traduction classiques ; utiliser plutôt l'extension Doctrine « Translatable »
- [ ] **D.** En stockant chaque traduction comme une entrée séparée dans les fichiers `translations/`, comme n'importe quel autre message

### Question 45

Comment prendre en charge un format de traduction personnalisé, non supporté nativement par Symfony ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, seuls les formats listés nativement peuvent être utilisés
- [ ] **B.** En créant un `EncoderInterface`, le même que pour le composant Serializer
- [ ] **C.** En surchargeant directement le service `translator` dans son intégralité
- [ ] **D.** En créant une classe implémentant `LoaderInterface`

## Les fournisseurs de traduction (providers)

### Question 46

À quoi servent les fournisseurs de traduction tiers intégrés à Symfony (Crowdin, Loco, Lokalise, Phrase) ? *(une seule bonne réponse)*

- [ ] **A.** À traduire automatiquement les messages via une IA intégrée, sans intervention humaine
- [ ] **B.** À remplacer entièrement les fichiers de traduction locaux, qui deviennent alors inutiles
- [ ] **C.** À valider uniquement la syntaxe des fichiers XLIFF, sans lien avec un service externe
- [ ] **D.** À envoyer (« push ») et récupérer (« pull ») les traductions vers/depuis un service externe, pour fusionner automatiquement les résultats dans l'application

### Question 47

Le DSN d'un fournisseur de traduction tiers, par exemple `loco://API_KEY@default`, correspond-il à une adresse réelle ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est l'adresse du serveur du fournisseur
- [ ] **B.** Non, il s'agit d'une chaîne arbitraire sans signification, à ignorer
- [ ] **C.** Oui, mais uniquement pour les environnements de production
- [ ] **D.** Non, c'est un format pratique qui délègue la configuration à Symfony ; seul le `API_KEY` doit être renseigné

### Question 48

Comment activer un fournisseur de traduction une fois son DSN configuré dans `.env` ? *(une seule bonne réponse)*

- [ ] **A.** Aucune configuration supplémentaire n'est nécessaire au-delà du `.env`
- [ ] **B.** Via un fichier `providers.yaml` dédié, distinct de `translation.yaml`
- [ ] **C.** En le déclarant sous l'option `providers` de `framework.translator`, avec son DSN, ses domaines et ses locales
- [ ] **D.** En le déclarant sous `framework.translator.transports`, comme pour Mailer

### Question 49

Quelle précaution particulière la documentation mentionne-t-elle pour le fournisseur Phrase ? *(une seule bonne réponse)*

- [ ] **A.** Il ne supporte que le format YAML, jamais XLIFF
- [ ] **B.** Il nécessite obligatoirement l'installation de l'extension PHP `intl`
- [ ] **C.** Il ne peut être utilisé qu'en environnement `dev`
- [ ] **D.** Il faut configurer un user agent dans le DSN, et utiliser des noms de locale conformes à la RFC4646 (ex. `pt-BR` plutôt que `pt_BR`)

### Question 50

Comment pousser (« push ») vers un fournisseur nommé `loco` les traductions locales, sans écraser les traductions déjà existantes côté fournisseur ? *(une seule bonne réponse)*

- [ ] **A.** `php bin/console translation:pull loco`, qui pousse aussi les traductions locales par défaut
- [ ] **B.** Il n'existe aucune option pour éviter d'écraser les traductions existantes côté fournisseur
- [ ] **C.** `php bin/console translation:push loco --locales fr --domains validators` (sans `--force`)
- [ ] **D.** `php bin/console translation:push loco --force`, qui écrase toujours les traductions existantes

### Question 51

Que fait l'option `--delete-missing` de `translation:push` ? *(une seule bonne réponse)*

- [ ] **A.** Elle n'a d'effet que sur la commande `translation:pull`, jamais `translation:push`
- [ ] **B.** Elle pousse les nouvelles traductions locales et supprime côté fournisseur celles qui n'existent plus localement
- [ ] **C.** Elle supprime les fichiers de traduction locaux qui n'ont pas encore été poussés
- [ ] **D.** Elle ignore silencieusement les traductions manquantes, sans rien supprimer

### Question 52

Que fait l'option `--as-tree` de `translation:pull`, une fois les traductions récupérées ? *(une seule bonne réponse)*

- [ ] **A.** Elle organise les fichiers de traduction dans une arborescence de sous-répertoires par locale
- [ ] **B.** Elle affiche un aperçu en arbre des traductions sans les écrire sur le disque
- [ ] **C.** Elle ne concerne que le format XLIFF, jamais YAML
- [ ] **D.** Elle écrit les messages YAML sous une structure arborescente plutôt qu'à plat

### Question 53

Pour créer un fournisseur de traduction personnalisé, quelles classes faut-il créer ? *(une seule bonne réponse)*

- [ ] **A.** Il n'est pas possible de créer un fournisseur personnalisé, seuls les quatre fournisseurs intégrés étant supportés
- [ ] **B.** Une classe implémentant `ProviderInterface`, et une factory implémentant `ProviderFactoryInterface` (éventuellement en étendant `AbstractProviderFactory`)
- [ ] **C.** Une seule classe implémentant à la fois `ProviderInterface` et `ProviderFactoryInterface`
- [ ] **D.** Une classe implémentant `LoaderInterface`, la même que pour un format de fichier personnalisé

## Gérer la locale de l'utilisateur

### Question 54

Où la locale de l'utilisateur courant est-elle stockée, et comment y accéder ? *(une seule bonne réponse)*

- [ ] **A.** Dans la session utilisateur uniquement, jamais sur la requête
- [ ] **B.** Dans un cookie dédié, lu directement sans passer par l'objet `Request`
- [ ] **C.** Dans le service `translator` lui-même, sans lien avec la requête
- [ ] **D.** Sur l'objet `Request`, accessible via `$request->getLocale()`

### Question 55

Si l'on définit la locale via un event listener personnalisé, par rapport à quel autre listener celui-ci doit-il s'exécuter en premier, et comment le garantir ? *(une seule bonne réponse)*

- [ ] **A.** Après le `LocaleListener`, sans quoi le traducteur ne verrait jamais la locale personnalisée
- [ ] **B.** L'ordre des listeners n'a aucune importance pour la locale
- [ ] **C.** Avant le `LocaleListener`, mais uniquement en abaissant la priorité du listener personnalisé
- [ ] **D.** Avant le `LocaleListener` ; en donnant à son propre listener une priorité plus élevée que celle du `LocaleListener`

### Question 56

Définir la locale via `$request->setLocale()` directement dans un contrôleur est-il suffisant pour affecter le traducteur ? *(une seule bonne réponse)*

- [ ] **A.** Oui, c'est la méthode recommandée et la plus fiable pour affecter le traducteur
- [ ] **B.** Non, cette méthode n'existe pas sur l'objet `Request`
- [ ] **C.** Oui, mais uniquement si elle est appelée avant tout autre code du contrôleur
- [ ] **D.** Non, c'est trop tardif ; il faut la définir via un listener, l'URL, ou en appelant `setLocale()` directement sur le service `translator`

### Question 57

Comment inclure la locale dans l'URL elle-même, et que se passe-t-il automatiquement quand une route utilise ce paramètre spécial ? *(une seule bonne réponse)*

- [ ] **A.** En ajoutant un paramètre de requête `?locale=fr` à toute URL, interprété automatiquement par le routeur
- [ ] **B.** Ce n'est pas recommandé ni supporté nativement par le composant Routing
- [ ] **C.** Via un sous-domaine dédié par langue, seule méthode supportée nativement
- [ ] **D.** Via le paramètre spécial `{_locale}` dans le chemin de la route ; la locale correspondante est automatiquement définie sur la `Request`

## Locale par défaut et langue préférée

### Question 58

Comment garantir qu'une locale est toujours définie sur chaque requête, même si elle n'a pas pu être déterminée autrement ? *(une seule bonne réponse)*

- [ ] **A.** Via une variable d'environnement `APP_LOCALE` uniquement, sans configuration YAML possible
- [ ] **B.** En définissant `framework.default_locale`
- [ ] **C.** En définissant `framework.translator.default_locale`, une clé distincte
- [ ] **D.** Ce n'est pas configurable, une locale non déterminée provoque toujours une exception

### Question 59

Comment déterminer la meilleure langue pour un utilisateur selon ses préférences de navigateur, et que retourne cette méthode en l'absence de correspondance parfaite ou partielle ? *(une seule bonne réponse)*

- [ ] **A.** Via `$request->getPreferredLanguage()`, qui retourne toujours la locale par défaut de l'application en cas d'absence de correspondance
- [ ] **B.** Via `$request->getPreferredLanguage(array $locales)`, basé sur l'en-tête `Accept-Language` ; en l'absence de correspondance, la première locale du tableau passé en argument est retournée
- [ ] **C.** Via `$request->getBestLocale()`, qui retourne toujours `null` en l'absence de correspondance
- [ ] **D.** Cette fonctionnalité n'existe pas nativement, il faut analyser soi-même l'en-tête `Accept-Language`

## Les locales de repli (fallback)

### Question 60

Pour une locale `es_AR`, dans quel ordre Symfony recherche-t-il une traduction avant de recourir aux `fallbacks` configurés ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `es_AR` puis directement les `fallbacks`, sans étape intermédiaire
- [ ] **B.** L'ordre est aléatoire selon les ressources de traduction disponibles
- [ ] **C.** D'abord `es_AR`, puis la locale parente le cas échéant (ex. `es_419`), puis `es` seule
- [ ] **D.** D'abord la locale de repli configurée, puis `es_AR`, puis `es`

### Question 61

Si l'option `fallbacks` n'est pas définie explicitement, sur quelle autre option se rabat-elle par défaut ? *(une seule bonne réponse)*

- [ ] **A.** Sur `enabled_locales`
- [ ] **B.** Sur la locale `en`, quelle que soit la configuration de l'application
- [ ] **C.** Elle ne se rabat sur rien, une erreur étant levée en son absence
- [ ] **D.** Sur `default_locale`

### Question 62

Que se passe-t-il quand Symfony ne trouve aucune traduction dans la locale demandée ? *(une seule bonne réponse)*

- [ ] **A.** Une exception fatale est levée, interrompant la requête
- [ ] **B.** Rien de particulier n'est journalisé, l'absence de traduction étant silencieuse
- [ ] **C.** Le cache applicatif est automatiquement invalidé
- [ ] **D.** La traduction manquante est ajoutée au fichier de log

## Changer la locale programmatiquement (LocaleSwitcher)

### Question 63

Quelle classe permet de changer temporairement la locale de l'application pendant l'exécution d'un bloc de code précis ? *(une seule bonne réponse)*

- [ ] **A.** `TranslatorInterface`, via une méthode `withLocale()`
- [ ] **B.** `LocaleSwitcher`
- [ ] **C.** `LocaleContext`
- [ ] **D.** `TemporaryLocale`

### Question 64

Que fait la méthode `runWithLocale()` du `LocaleSwitcher` ? *(une seule bonne réponse)*

- [ ] **A.** Elle change définitivement la locale de l'application pour toutes les requêtes suivantes
- [ ] **B.** Elle ne fait que retourner la locale actuelle, sans exécuter aucun callback
- [ ] **C.** Elle réinitialise systématiquement la locale à `default_locale` après exécution, sans possibilité de la conserver
- [ ] **D.** Elle exécute un callback avec une locale précise, temporairement, sans changer la locale pour le reste de l'application

### Question 65

Que change concrètement le `LocaleSwitcher` lorsqu'on appelle `setLocale()` ? *(plusieurs bonnes réponses)*

- [ ] **A.** Tous les services tagués `kernel.locale_aware`
- [ ] **B.** La locale par défaut via `\Locale::setDefault()`
- [ ] **C.** Le paramètre `_locale` du `RequestContext`, pour que les URLs générées reflètent la nouvelle locale
- [ ] **D.** La configuration YAML de l'application elle-même, de façon permanente

### Question 66

L'effet du `LocaleSwitcher` persiste-t-il d'une requête à l'autre, par exemple après une redirection ? *(une seule bonne réponse)*

- [ ] **A.** Non, et il faut redémarrer le worker pour qu'un nouveau `setLocale()` soit pris en compte
- [ ] **B.** Non, son effet ne s'applique qu'à la requête courante
- [ ] **C.** Oui, il persiste indéfiniment jusqu'à un appel explicite à `reset()`
- [ ] **D.** Oui, mais uniquement si la session est démarrée

### Question 67

Sans autowiring, quel identifiant de service faut-il injecter manuellement pour obtenir le `LocaleSwitcher` ? *(une seule bonne réponse)*

- [ ] **A.** `translator.locale_switcher`
- [ ] **B.** `kernel.locale_switcher`
- [ ] **C.** `locale.switcher`
- [ ] **D.** `translation.locale_switcher`

## Trouver les messages manquants ou inutilisés (debug:translation)

### Question 68

Quelle commande aide à repérer les traductions manquantes ou inutilisées de l'application ? *(une seule bonne réponse)*

- [ ] **A.** `translation:audit`
- [ ] **B.** `debug:translation`
- [ ] **C.** `translation:debug`
- [ ] **D.** `debug:translator`

### Question 69

Les extracteurs utilisés par cette commande peuvent-ils détecter une traduction dynamique construite avec une variable Twig, comme `{% set message = 'Symfony is great' %}{{ message|trans }}` ? *(une seule bonne réponse)*

- [ ] **A.** Cela dépend uniquement du domaine de traduction utilisé
- [ ] **B.** Non, les traductions utilisant des variables ou expressions dynamiques dans les templates ne sont pas détectées
- [ ] **C.** Oui, tant que la variable est définie dans le même template
- [ ] **D.** Oui, systématiquement, quelle que soit la complexité de l'expression

### Question 70

Que signifie l'état (« State ») `unused` affiché par `debug:translation` pour un message ? *(une seule bonne réponse)*

- [ ] **A.** Le message provoque une erreur de syntaxe dans le fichier de traduction
- [ ] **B.** Le message est traduit dans le fichier de traduction, mais n'est utilisé nulle part dans l'application
- [ ] **C.** Le message est utilisé dans un template, mais n'a pas encore été traduit
- [ ] **D.** Le message est identique dans la locale courante et dans la locale de repli

### Question 71

Que signifie l'état `missing` pour un message affiché par `debug:translation` ? *(une seule bonne réponse)*

- [ ] **A.** Le message existe uniquement dans la locale de repli, jamais dans la locale demandée ni ailleurs
- [ ] **B.** Le fichier de traduction correspondant est introuvable sur le disque
- [ ] **C.** Le message n'est pas traduit dans la locale demandée, mais il est utilisé dans un template
- [ ] **D.** Le message n'est utilisé nulle part et n'a pas non plus de traduction

### Question 72

Que signifie l'état `fallback`, et que peut-il indiquer sur la qualité de la traduction ? *(une seule bonne réponse)*

- [ ] **A.** La locale de repli elle-même n'est pas configurée
- [ ] **B.** La traduction de la locale demandée est identique à celle de la locale de repli, ce qui peut indiquer un oubli de traduction (contenu copié depuis l'anglais par exemple)
- [ ] **C.** Aucune traduction n'existe ni dans la locale demandée ni dans la locale de repli
- [ ] **D.** Le message est correctement traduit et n'appelle aucune vigilance particulière

### Question 73

Comment restreindre l'inspection de `debug:translation` à un seul domaine, et comment n'afficher que les messages inutilisés ? *(une seule bonne réponse)*

- [ ] **A.** Via un argument positionnel supplémentaire, sans nom d'option particulier
- [ ] **B.** Via `--filter-domain` et `--unused-only`
- [ ] **C.** Via `--domain=messages` pour restreindre le domaine, et `--only-unused` pour n'afficher que les messages inutilisés
- [ ] **D.** Ces deux filtres n'existent pas, tous les domaines et messages étant toujours affichés

### Question 74

Comment interpréter les constantes `EXIT_CODE_MISSING` et `EXIT_CODE_UNUSED` de `TranslationDebugCommand`, utilisées pour le code de sortie de la commande ? *(une seule bonne réponse)*

- [ ] **A.** Ce sont de simples booléens exclusifs, un seul pouvant être actif à la fois
- [ ] **B.** Elles ne servent qu'à des fins de documentation, sans lien réel avec le code de sortie du processus
- [ ] **C.** Elles ne sont utilisables que dans les tests, jamais en dehors
- [ ] **D.** Ce sont des masques de bits, combinables (ex. avec `|`) pour vérifier plusieurs états à la fois

## Trouver les erreurs dans les fichiers de traduction (lint)

### Question 75

Que valident précisément les commandes `lint:yaml` et `lint:xliff`, par opposition à `lint:translations` ? *(une seule bonne réponse)*

- [ ] **A.** Elles valident le contenu des traductions, `lint:translations` ne validant que la syntaxe
- [ ] **B.** Les trois commandes font strictement la même vérification
- [ ] **C.** `lint:yaml`/`lint:xliff` ne fonctionnent que sur un seul fichier à la fois, jamais sur un répertoire entier
- [ ] **D.** Elles valident uniquement la syntaxe YAML/XML des fichiers ; `lint:translations` vérifie en plus le contenu des catalogues de traduction

### Question 76

Comment restreindre `lint:translations` à certaines locales précises, par exemple italien et japonais ? *(une seule bonne réponse)*

- [ ] **A.** Ce n'est pas possible, `lint:translations` vérifie toujours toutes les locales
- [ ] **B.** `php bin/console lint:translations --locales=it,ja`
- [ ] **C.** `php bin/console lint:translations --locale=it --locale=ja`
- [ ] **D.** `php bin/console lint:translations it ja`, en arguments positionnels

### Question 77

Comment obtenir la sortie des linters `lint:yaml`/`lint:xliff` au format attendu par GitHub Actions ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement via `--format=json`, transformé ensuite manuellement
- [ ] **B.** Via l'option `--format=github` (ou automatiquement lorsque la commande tourne dans GitHub Actions)
- [ ] **C.** Ce n'est pas possible, seul le format texte brut est disponible
- [ ] **D.** Via une variable d'environnement `GITHUB_LINT_FORMAT`

### Question 78

Le composant Yaml fournit-il un moyen de linter des fichiers YAML sans passer par une application console complète ? *(une seule bonne réponse)*

- [ ] **A.** Non, `lint:yaml` nécessite toujours une application Symfony complète
- [ ] **B.** Oui, mais uniquement en installant un bundle tiers séparé
- [ ] **C.** Non, seul XLIFF dispose d'un tel binaire autonome
- [ ] **D.** Oui, via le binaire autonome `yaml-lint`

## Tester les traductions

### Question 79

Que permet la classe `IdentityTranslator` pour tester du code utilisant le service de traduction ? *(une seule bonne réponse)*

- [ ] **A.** De mocker automatiquement toutes les méthodes du `Translator` sans configuration
- [ ] **B.** De valider que chaque clé de traduction existe bien dans tous les catalogues
- [ ] **C.** D'implémenter `TranslatorInterface` sans charger aucun catalogue de traduction, en retournant toujours le message d'origine (après substitution des paramètres et sélection de message)
- [ ] **D.** De simuler des traductions aléatoires pour tester la robustesse de l'affichage

### Question 80

Avec `IdentityTranslator`, la pluralisation (sélection de message) est-elle tout de même appliquée, même sans catalogue chargé ? *(une seule bonne réponse)*

- [ ] **A.** Non, `IdentityTranslator` ne fait que retourner la clé brute, sans aucun traitement
- [ ] **B.** Cela dépend de la locale configurée par défaut sur le système
- [ ] **C.** Oui, la sélection de message (dont la pluralisation) continue de s'appliquer normalement
- [ ] **D.** Non, seule la substitution de paramètres fonctionne, jamais la pluralisation

### Question 81

Quelle est la locale par défaut de l'`IdentityTranslator` si l'extension `intl` n'est pas disponible, et cette locale a-t-elle un impact sur le chargement d'un catalogue ? *(une seule bonne réponse)*

- [ ] **A.** `fr` par défaut, la locale de Symfony historiquement
- [ ] **B.** Elle est toujours `null`, ce qui provoque une exception si `intl` est absent
- [ ] **C.** Elle dépend de la configuration `default_locale` du framework, jamais d'une valeur PHP native
- [ ] **D.** `en` par défaut ; la locale n'affecte que la sélection de message, aucun catalogue n'étant jamais chargé

## La pseudo-localisation

### Question 82

À quoi sert la pseudo-localisation, et à quel usage est-elle destinée ? *(une seule bonne réponse)*

- [ ] **A.** À chiffrer les fichiers de traduction pour éviter qu'ils ne soient lus par des tiers
- [ ] **B.** À remplacer le texte original par une version altérée (accentuée, allongée) pour détecter les problèmes d'internationalisation (troncature, caractères spéciaux non gérés) ; réservée au développement
- [ ] **C.** À traduire automatiquement l'application dans une langue fictive utilisée en production
- [ ] **D.** À remplacer les traductions manquantes par un texte aléatoire généré par IA

### Question 83

Quels problèmes concrets la pseudo-localisation permet-elle d'anticiper ? *(plusieurs bonnes réponses)*

- [ ] **A.** Un texte traduit plus long que l'original qui déborde ou est tronqué dans l'interface
- [ ] **B.** Une interface qui ne gère pas correctement les caractères accentués ou spéciaux (ex. polonais, tchèque)
- [ ] **C.** Des identifiants de traduction dupliqués entre deux domaines
- [ ] **D.** Des fuites de connexions à la base de données

### Question 84

Que fait l'option `expansion_factor` de la configuration `pseudo_localization` ? *(une seule bonne réponse)*

- [ ] **A.** Elle définit le nombre de langues fictives générées simultanément
- [ ] **B.** Elle active ou désactive uniquement le remplacement par des caractères accentués
- [ ] **C.** Elle définit la vitesse à laquelle les traductions sont générées
- [ ] **D.** Elle contrôle le nombre de caractères supplémentaires ajoutés pour allonger artificiellement le texte

### Question 85

Que permettent respectivement `parse_html` et `localizable_html_attributes` dans la configuration de la pseudo-localisation ? *(une seule bonne réponse)*

- [ ] **A.** `localizable_html_attributes` désactive `parse_html`, les deux étant mutuellement exclusifs
- [ ] **B.** `parse_html` préserve les balises HTML d'origine du contenu traduit ; `localizable_html_attributes` étend la pseudo-traduction au contenu de certains attributs HTML (ex. `title`)
- [ ] **C.** Les deux ne concernent que le rendu console, sans lien avec le HTML
- [ ] **D.** `parse_html` supprime toutes les balises HTML du contenu ; `localizable_html_attributes` les restaure ensuite

## Traduire avec le format ICU MessageFormat

### Question 86

Pour qu'un fichier de traduction soit interprété avec la syntaxe ICU MessageFormat, quel suffixe faut-il ajouter au nom de domaine du fichier ? *(une seule bonne réponse)*

- [ ] **A.** `.icu` en extension supplémentaire
- [ ] **B.** `-icu` directement accolé à la locale
- [ ] **C.** Aucun suffixe n'est nécessaire, Symfony détecte automatiquement la syntaxe ICU
- [ ] **D.** `+intl-icu` (ex. `messages+intl-icu.en.yaml`)

### Question 87

Quelle syntaxe de placeholder utilise l'ICU MessageFormat, par opposition à la syntaxe `%name%` classique ? *(une seule bonne réponse)*

- [ ] **A.** `%name%`, identique à la syntaxe classique
- [ ] **B.** `#name#`, propre à l'ICU MessageFormat
- [ ] **C.** `${name}`, une syntaxe empruntée à JavaScript
- [ ] **D.** `{name}`, le caractère `%` n'étant plus valide avec cette syntaxe

### Question 88

À quoi sert la fonction `select` de l'ICU MessageFormat, et quelle clé y est obligatoire ? *(une seule bonne réponse)*

- [ ] **A.** À sélectionner automatiquement la locale de l'utilisateur, sans variable explicite
- [ ] **B.** À choisir aléatoirement l'une des variantes proposées
- [ ] **C.** Elle nécessite que toutes les clés possibles soient exhaustivement énumérées, `other` n'étant qu'optionnelle
- [ ] **D.** À choisir un texte différent selon la valeur d'une variable (ex. le genre) ; la clé `other` est obligatoire et sélectionnée si aucun autre cas ne correspond

### Question 89

Dans `{organizer_gender, select, female {...} male {...} other {...}}`, comment se comporte l'alternance entre mode « code » et mode « littéral » ? *(une seule bonne réponse)*

- [ ] **A.** Le mode littéral ne peut jamais contenir de nouvelle variable imbriquée
- [ ] **B.** L'alternance ne concerne que la fonction `plural`, jamais `select`
- [ ] **C.** Les accolades `{...}` alternent : le bloc `{organizer_gender, select, ...}` démarre le mode code, chaque bloc de cas (`{... a party!}`) repasse en mode littéral, et toute variable réutilisée à l'intérieur (ex. `{organizer_name}`) redémarre le mode code
- [ ] **D.** Tout le message reste en permanence en mode code, sans jamais repasser en littéral

### Question 90

Est-il possible de traduire un message au format ICU MessageFormat directement dans le code PHP, sans passer par un fichier de traduction ? *(une seule bonne réponse)*

- [ ] **A.** Non, cela ne fonctionne qu'avec la fonction `select`, jamais les autres fonctions ICU
- [ ] **B.** Oui, en passant directement la chaîne ICU à `trans()` avec le domaine suffixé `+intl-icu` (ou la constante `MessageCatalogueInterface::INTL_DOMAIN_SUFFIX`)
- [ ] **C.** Non, un fichier de traduction est toujours obligatoire pour utiliser l'ICU MessageFormat
- [ ] **D.** Oui, mais uniquement en désactivant complètement le domaine de traduction

### Question 91

À quoi sert la fonction `plural` de l'ICU MessageFormat, et comment cibler une valeur exacte (ex. zéro) plutôt qu'une catégorie grammaticale ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne gère que l'anglais, les autres langues devant utiliser `select` à la place
- [ ] **B.** Le préfixe `=` sert à exclure une valeur du traitement, plutôt qu'à la cibler
- [ ] **C.** Elle ne peut cibler que la valeur `0`, aucune autre valeur exacte n'étant supportée
- [ ] **D.** Elle gère la pluralisation des messages ; préfixer une valeur par `=` (ex. `=0`) cible une valeur exacte plutôt qu'une catégorie comme `one`/`other`

### Question 92

Les catégories grammaticales possibles pour `plural` sont-elles identiques dans toutes les langues, par exemple entre l'anglais et le russe ? *(une seule bonne réponse)*

- [ ] **A.** Le nombre de catégories est toujours fixé à quatre, quelle que soit la langue
- [ ] **B.** Non, elles diffèrent selon la langue (ex. l'anglais n'a que `one`/`other`, le russe a aussi `few` et `many`)
- [ ] **C.** Oui, toutes les langues utilisent exactement les mêmes catégories `one`/`other`
- [ ] **D.** Non, mais uniquement entre les langues n'utilisant pas l'alphabet latin

### Question 93

À quoi sert l'option `offset` de la fonction `plural`, illustrée par des messages comme « You and # other people » ? *(une seule bonne réponse)*

- [ ] **A.** À définir un délai avant l'affichage du message pluralisé
- [ ] **B.** À limiter le nombre maximal de résultats affichés
- [ ] **C.** Elle n'existe pas pour `plural`, uniquement pour `selectordinal`
- [ ] **D.** À décaler le compte affiché par la valeur indiquée, utile quand une des entités comptées (ex. l'utilisateur lui-même) ne doit pas être comptabilisée dans le nombre affiché

### Question 94

Quand on combine les fonctions `select` et `plural` dans un même message, laquelle la documentation recommande-t-elle de placer à l'extérieur ? *(une seule bonne réponse)*

- [ ] **A.** `plural`, en fonction la plus englobante
- [ ] **B.** L'ordre n'a aucune importance, le résultat étant strictement identique
- [ ] **C.** Aucune des deux ne peut être imbriquée dans l'autre
- [ ] **D.** `select`, en fonction la plus englobante

### Question 95

L'ICU MessageFormat supporte-t-il les plages personnalisées de l'ancienne syntaxe de pluralisation Symfony (ex. des messages différents pour 0-12, 12-40, 40+) ? *(une seule bonne réponse)*

- [ ] **A.** Oui, via une syntaxe équivalente à l'ancienne notation par intervalles
- [ ] **B.** Oui, mais uniquement en combinant `plural` et `selectordinal` ensemble
- [ ] **C.** Non, et il n'existe aucune alternative recommandée pour ce cas
- [ ] **D.** Non, cette logique doit être déplacée dans le code PHP (ex. via des conditions choisissant entre plusieurs clés de message distinctes)

### Question 96

À quoi sert la fonction `selectordinal`, et quelle fonction plus simple existe pour le seul formatage ordinal d'un nombre ? *(une seule bonne réponse)*

- [ ] **A.** Elle ne fonctionne qu'avec des nombres entiers négatifs
- [ ] **B.** Elle sélectionne un texte selon la position ordinale d'un nombre (1er, 2e…) ; la fonction `ordinal` seule suffit pour le simple formatage ordinal
- [ ] **C.** Elle sert uniquement à trier une liste de nombres, sans lien avec l'affichage textuel
- [ ] **D.** `ordinal` et `selectordinal` sont strictement identiques, sans différence d'usage

### Question 97

Sur quelle classe PHP repose la fonction `date`/`time` de l'ICU MessageFormat pour formater une date selon la locale cible ? *(une seule bonne réponse)*

- [ ] **A.** `DateTimeFormatter`, une classe du composant Translation
- [ ] **B.** `NumberFormatter`, réutilisée aussi pour les dates
- [ ] **C.** `DateTime::format()` directement, sans classe Intl dédiée
- [ ] **D.** `IntlDateFormatter`

### Question 98

Quelles valeurs peut prendre l'argument de style des fonctions `date`/`time` (ex. `{publication_date, time, short}`) ? *(une seule bonne réponse)*

- [ ] **A.** Uniquement `short` ou `long`, les deux autres n'existant pas
- [ ] **B.** `short`, `medium`, `long` ou `full`
- [ ] **C.** `s`, `m`, `l` ou `f`, en abrégé
- [ ] **D.** Un format `strftime` personnalisé, passé tel quel

### Question 99

Sur quelle classe PHP repose la fonction `number` de l'ICU MessageFormat, illustrée par `{progress, number, percent}` ? *(une seule bonne réponse)*

- [ ] **A.** `IntlDateFormatter`, réutilisée aussi pour les nombres
- [ ] **B.** `MessageFormatter`, sans classe de formatage de nombres dédiée
- [ ] **C.** `\NumberFormat`, une classe native de PHP sans lien avec `intl`
- [ ] **D.** `NumberFormatter`

## Le format XLIFF

### Question 100

Quelle version du format XLIFF est nécessaire pour charger/exporter des notes (`<notes>`) destinées aux traducteurs ? *(une seule bonne réponse)*

- [ ] **A.** Toutes les versions de XLIFF supportent les notes de façon identique
- [ ] **B.** Aucune version de XLIFF ne supporte les notes, cette fonctionnalité n'existant pas dans le format
- [ ] **C.** XLIFF version 2.0
- [ ] **D.** XLIFF version 1.2, la seule supportée par Symfony

### Question 101

Si un document XLIFF 2.0 contient des nœuds `<notes>`, comment Symfony les traite-t-il ? *(une seule bonne réponse)*

- [ ] **A.** Ils sont ignorés silencieusement, sauf configuration explicite pour les activer
- [ ] **B.** Ils provoquent une erreur de linting, `<notes>` n'étant pas un nœud standard
- [ ] **C.** Ils ne sont pris en compte qu'à la lecture, jamais lors de l'export
- [ ] **D.** Ils sont automatiquement chargés et exportés (dump) sans configuration supplémentaire

### Question 102

En plus des fonctionnalités communes à tous les formats de traduction Symfony, le format XLIFF propose-t-il des fonctionnalités qui lui sont spécifiques ? *(une seule bonne réponse)*

- [ ] **A.** Non, XLIFF ne fait que dupliquer les fonctionnalités de YAML sans rien y ajouter
- [ ] **B.** Non, XLIFF est en réalité plus limité que les autres formats supportés
- [ ] **C.** Oui, mais uniquement pour la pluralisation, qui ne serait pas supportée par YAML
- [ ] **D.** Oui, comme les notes destinées aux traducteurs

---

## Corrigé

Les références *(§ …)* renvoient aux sections de la [page Translation de la documentation Symfony 8.0](https://symfony.com/doc/8.0/translation.html) ; les entrées préfixées renvoient à l'une des deux pages de sa section Learn more.

**Question 1 : D** — « The term locale refers roughly to the user's language and country. (…) The ISO 639-1 language code, an underscore, then the ISO 3166-1 alpha-2 country code (e.g. `fr_FR` for French/France) is recommended. » *(§ Translations — introduction)*

**Question 2 : D** — « Translations can be organized into groups, called domains. By default, all messages use the default `messages` domain. » *(§ Translations — introduction)*

**Question 3 : D** — « run this command to install the translator before using it: `$ composer require symfony/translation` » *(§ Installation)*

**Question 4 : C** — « these polyfills only support English translations, so you must install the PHP intl extension when translating into other languages. » *(§ Installation)*

**Question 5 : A, B** — « The previous command creates an initial config file where you can define the default locale of the application and the directory where the translation files are located » — `default_locale` et `default_path`. *(§ Configuration)*

**Question 6 : D** — « use the `Translator::trans` method (…) `$translated = $translator->trans('Symfony is great');` » *(§ Basic Translation)*

**Question 7 : D** — « In the first method, messages are written in the language of the default locale (…) In the second method, messages are actually "keywords" (…) translations must be made for the default locale. » *(§ Using Real or Keyword Messages)*

**Question 8 : D** — « the "keyword" format is often recommended for multi-language applications, whereas for shared bundles that contain translation resources we recommend the real message, so your application can choose to disable the translator layer and you will see a readable message. » *(§ Using Real or Keyword Messages)*

**Question 9 : B** — « the `php` and `yaml` file formats support nested ids to avoid repeating yourself » — `symfony: is: great:` donne l'id `symfony.is.great`. *(§ Using Real or Keyword Messages)*

**Question 10 : A, B, C** — « The locale of the current user (…) is determined (…) A catalog of translated messages is loaded (…) If the message is located in the catalog, the translation is returned. If not, the translator returns the original message. » *(§ The Translation Process)*

**Question 11 : C** — « you can replace the variable parts with placeholders wrapped in `%` characters (…) pass the placeholder values as the second argument of the `trans()` method. » *(§ Message Format)*

**Question 12 : C** — « The `%` wrapping is a convention to make placeholders easy to spot, but it's not required. You can use any wrapper (…) as long as the key in the parameters array matches the placeholder in the message exactly. » *(§ Message Format)*

**Question 13 : D** — « Symfony replaces the placeholders with the given values using PHP's `strtr` function. » *(§ Message Format)*

**Question 14 : C** — « Symfony handles all these cases through the ICU MessageFormat syntax (…) ICU placeholders use `{name}` instead of `%name%` and require the `+intl-icu` suffix in the translation filename. » *(§ Message Format)*

**Question 15 : C** — « Translating those messages at creation time forces you to inject the `translator` service everywhere and to mock it in every test. A translatable object solves this by storing all the information needed for a future translation (…) without actually translating anything. » *(§ Translatable Objects)*

**Question 16 : C** — « Symfony ships with `TranslatableMessage`, which implements `TranslatableInterface`. (…) Use the `t()` shortcut function to create translatable objects with less boilerplate. » *(§ Basic Usage)*

**Question 17 : D** — « The translation parameters of a `TranslatableMessage` can themselves be `TranslatableMessage` instances. » *(§ Basic Usage)*

**Question 18 : B** — « You cannot attach translation parameters (…) or specify a translation domain. The translation:extract command cannot detect the keys, so it will not update your translation files automatically and the `--clean` option will wrongly flag those keys as unused. » *(§ Translatable Objects In Practice)*

**Question 19 : D** — « If you need more control, implement `TranslatableInterface` directly on any class. The interface requires a single `trans()` method. » *(§ Custom TranslatableInterface Implementation)*

**Question 20 : C** — « you may want to explicitly prevent a message from being translated. You can ensure this behavior by using the `StaticMessage` class. (…) useful when rendering user-defined content. » *(§ Non-Translatable Messages)*

**Question 21 : B** — « You can set the translation domain for an entire Twig template with a single tag: `{% trans_default_domain 'app' %}` » *(§ Using Twig Filters)*

**Question 22 : C** — « Note that this only influences the current template, not any "included" template (in order to avoid side effects). » *(§ Using Twig Filters)*

**Question 23 : D** — « By default, the translated messages are output escaped; apply the `raw` filter after the translation filter to avoid the automatic escaping. » *(§ Using Twig Filters)*

**Question 24 : C** — « The `%var%` notation of placeholders is required when translating in Twig templates using the tag. » *(§ Using Twig Tags)*

**Question 25 : B** — « If you need to use the percent character (`%`) in a string, escape it by doubling it: `{% trans %}Percent: %percent%%%{% endtrans %}` » *(§ Using Twig Tags)*

**Question 26 : D** — « Using the translation tag has the same effect as the filter, but with one major difference: automatic output escaping is **not** applied to translations using a tag. » *(§ Using Twig Tags)*

**Question 27 : D** — « You can configure these global parameters in the `translator.globals` option of your main configuration file. » *(§ Global Translation Parameters)*

**Question 28 : D** — « when using the '%' wrapping characters, you must escape them » — `'%%app_name%%': 'My application'`. *(§ Global Translation Parameters)*

**Question 29 : C** — « parameters passed to the message override global parameters » *(§ Global Translation Parameters)*

**Question 30 : C** — « You can also manually specify the locale to use for translation: `$translator->trans('Symfony is great', locale: 'fr_FR');` » *(§ Forcing the Translator Locale)*

**Question 31 : C** — « Symfony includes a command called `translation:extract` that helps you with these tasks. » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 32 : D** — « # shows all the messages that should be translated (…) `--dump-messages` (…) # updates the French translation files with the missing strings (…) `--force` » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 33 : A, B, C** — « Templates stored in the `templates/` directory (…) Any PHP file/class that injects or autowires the `translator` service and makes calls to the `trans()` method (…) Any PHP file/class stored in `src/` that creates translatable objects using the constructor or the `t()` method. » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 34 : C** — « Install the `nikic/php-parser` package in your project to improve the results of the `translation:extract` command. This package enables an AST parser. » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 35 : D** — « it uses the same content as both the source and the pending translation. The only difference is that the pending translation is prefixed by `__`. You can customize this prefix using the `--prefix` option. » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 36 : B** — « you can use the `--no-fill` option to leave the pending translation completely empty (…) This is particularly useful when using external translation tools, as it makes it easier to spot untranslated strings. » *(§ Extracting Translation Contents and Updating Catalogs Automatically)*

**Question 37 : C** — « the `translations/` directory (at the root of the project); the `translations/` directory inside of any bundle (…) The locations are listed here with the highest priority first. » *(§ Translation Resource/File Names and Locations)*

**Question 38 : D** — « The override mechanism works at a key level: only the overridden keys need to be listed in a higher priority message file. When a key is not found (…) the translator will automatically fall back to the lower priority message files. » *(§ Translation Resource/File Names and Locations)*

**Question 39 : B** — « each message file must be named according to the following path: `domain.locale.loader` » *(§ Translation Resource/File Names and Locations)*

**Question 40 : A, B, C** — « `.yaml` (…) `.xlf` (…) `.php` (…) `.csv` (…) `.json` (…) `.ini` (…) `.dat`, `.res` (…) `.mo` (…) `.po` (…) `.qt` » *(§ Translation Resource/File Names and Locations)*

**Question 41 : C** — « The recommended option is to use YAML for simple projects and use XLIFF if you're generating translations with specialized programs or teams. » *(§ Translation Resource/File Names and Locations)*

**Question 42 : B** — « Each time you create a new message catalog (…) be sure to clear your cache so that Symfony can discover the new translation resources. » *(§ Translation Resource/File Names and Locations)*

**Question 43 : B** — « You can add other directories with the `paths` option in the configuration. » *(§ Translation Resource/File Names and Locations)*

**Question 44 : C** — « it's not practical to translate the contents stored in Doctrine Entities using translation catalogs. Instead, use the Doctrine Translatable Extension. » *(§ Translations of Doctrine Entities)*

**Question 45 : D** — « you need to provide a custom class implementing the `LoaderInterface` interface. » *(§ Custom Translation Resources)*

**Question 46 : D** — « Symfony provides integration with several third-party translation services. You can upload and download (called "push" and "pull") translations to/from these services. » *(§ Translation Providers)*

**Question 47 : D** — « The `LOCO_DSN` isn't a *real* address: it's a convenient format that offloads most of the configuration work to Symfony. (…) The *only* part you need to change is the `API_KEY` placeholder. » *(§ Installing and Configuring a Third Party Provider)*

**Question 48 : C** — « To enable a translation provider, customize the DSN in your `.env` file and configure the `providers` option. » *(§ Installing and Configuring a Third Party Provider)*

**Question 49 : D** — « If you use Phrase as a provider you must configure a user agent in your dsn (…) the locale names in Phrase should be as defined in RFC4646 (e.g. pt-BR rather than pt_BR). » *(§ Installing and Configuring a Third Party Provider)*

**Question 50 : C** — « push new local translations to the Loco provider for the French locale and the validators domain. it will **not** update existing translations already on the provider. `$ php bin/console translation:push loco --locales fr --domains validators` » *(§ Pushing and Pulling Translations)*

**Question 51 : B** — « push new local translations and delete provider's translations that not exists anymore in local files (…) `--delete-missing` » *(§ Pushing and Pulling Translations)*

**Question 52 : D** — « the `--as-tree` option will write YAML messages as a tree-like structure instead of flat keys » *(§ Pushing and Pulling Translations)*

**Question 53 : B** — « The first class must implement `ProviderInterface`; The second class needs to be a factory (…) It must implement `ProviderFactoryInterface` (…) extend `AbstractProviderFactory`. » *(§ Creating Custom Providers)*

**Question 54 : D** — « The locale of the current user is stored in the request and is accessible via the `Request` object » — `$request->getLocale()`. *(§ Handling the User's Locale)*

**Question 55 : D** — « The custom listener must be called **before** `LocaleListener` (…) set your listener priority to a higher value than `LocaleListener` priority. » *(§ Handling the User's Locale)*

**Question 56 : D** — « Setting the locale using `$request->setLocale()` in the controller is too late to affect the translator. Either set the locale via a listener (…), the URL (…), or call `setLocale()` directly on the `translator` service. » *(§ Handling the User's Locale)*

**Question 57 : D** — « A better policy is to include the locale in the URL using the special `_locale` parameter (…) the matched locale is *automatically set on the Request*. » *(§ The Locale and the URL)*

**Question 58 : B** — « You can guarantee that a locale is set on each user's request by defining a `default_locale` for the framework. » *(§ Setting a Default Locale)*

**Question 59 : B** — « This is achieved with the `getPreferredLanguage()` method (…) If there's no perfect or partial match, this method returns the first locale passed as argument. » *(§ Selecting the Language Preferred by the User)*

**Question 60 : C** — « First, Symfony looks for the translation in a `es_AR` (…) resource (…) If it wasn't found, Symfony looks for the translation in the parent locale (…) `es_419` (…) If it wasn't found, Symfony looks for the translation in a `es` (…) resource. » *(§ Fallback Translation Locales)*

**Question 61 : D** — « When this option is not defined, it defaults to the `default_locale` setting mentioned in the previous section. » *(§ Fallback Translation Locales)*

**Question 62 : D** — « When Symfony can't find a translation in the given locale, it will add the missing translation to the log file. » *(§ Fallback Translation Locales)*

**Question 63 : B** — « The `LocaleSwitcher` class allows you to do that. » *(§ Switch Locale Programmatically)*

**Question 64 : D** — « run some code with a specific locale, temporarily, without changing the locale for the rest of the application: `$this->localeSwitcher->runWithLocale('es', function() {...});` » *(§ Switch Locale Programmatically)*

**Question 65 : A, B, C** — « The `LocaleSwitcher` class changes the locale of: All services tagged with `kernel.locale_aware`; The default locale set via `\Locale::setDefault()`; The `_locale` parameter of the `RequestContext` service (…) so generated URLs reflect the new locale. » *(§ Switch Locale Programmatically)*

**Question 66 : B** — « The LocaleSwitcher applies the new locale only for the current request, and its effect is lost on subsequent requests, such as after a redirect. » *(§ Switch Locale Programmatically)*

**Question 67 : D** — « Otherwise, configure your services manually and inject the `translation.locale_switcher` service. » *(§ Switch Locale Programmatically)*

**Question 68 : B** — « The `debug:translation` command helps you to find these missing or unused translation messages templates. » *(§ How to Find Missing or Unused Translation Messages)*

**Question 69 : B** — « Dynamic translations using variables or expressions in templates are not detected either. » *(§ How to Find Missing or Unused Translation Messages)*

**Question 70 : B** — « it indicates that the message `Symfony is great` is unused because it is translated, but you haven't used it anywhere yet. » *(§ How to Find Missing or Unused Translation Messages)*

**Question 71 : C** — « The state indicates the message is missing because it is not translated in the `fr` locale but it is still used in the template. » *(§ How to Find Missing or Unused Translation Messages)*

**Question 72 : B** — « you can see that the translations of the message are identical in the `fr` and `en` locales which means this message was probably copied from English to French and maybe you forgot to translate it. » *(§ How to Find Missing or Unused Translation Messages)*

**Question 73 : C** — « it is possible to specify a single domain: `--domain=messages` (…) `--only-unused` or `--only-missing` » *(§ How to Find Missing or Unused Translation Messages)*

**Question 74 : D** — « These constants are defined as "bit masks", so you can combine them. » *(§ Debug Command Exit Codes)*

**Question 75 : D** — « you can also validate the syntax of any YAML and XLIFF translation file using the `lint:yaml` and `lint:xliff` commands (…) Use the following command to check that the translation contents are also correct: `lint:translations` » *(§ How to Find Errors in Translation Files)*

**Question 76 : C** — « checks the contents of the translation catalogues for Italian (it) and Japanese (ja) locales: `$ php bin/console lint:translations --locale=it --locale=ja` » *(§ How to Find Errors in Translation Files)*

**Question 77 : B** — « When running these linters inside GitHub Actions, the output is automatically adapted (…) but you can force that format too: `--format=github` » *(§ How to Find Errors in Translation Files)*

**Question 78 : D** — « The Yaml component provides a stand-alone `yaml-lint` binary allowing you to lint YAML files without having to create a console application. » *(§ How to Find Errors in Translation Files)*

**Question 79 : C** — « Instead of mocking the `TranslatorInterface`, you can use the `IdentityTranslator`, which implements the interface without loading any translation catalogs. » *(§ Identity Translator)*

**Question 80 : C** — « Instead of looking up translations, `IdentityTranslator` always returns the original message after applying parameter substitution and message selection (e.g. pluralization). » *(§ Identity Translator)*

**Question 81 : D** — « The locale defaults to `\Locale::getDefault()` (or `en` when the intl extension is not available) (…) The locale only affects message selection; no translation catalog is ever used. » *(§ Identity Translator)*

**Question 82 : B** — « In this method, instead of translating the text of the software into a foreign language, the textual elements of an application are replaced with an altered version of the original language. » — « The pseudolocalization translator is meant to be used for development only. » *(§ Pseudo-localization translator)*

**Question 83 : A, B** — « different languages can be longer or shorter than the original application language. Another common issue is to only check if the application works when using basic accented letters, instead of checking for more complex characters. » *(§ Pseudo-localization translator)*

**Question 84 : D** — « expansion_factor — controls how many extra characters are added to make text longer » *(§ Pseudo-localization translator)*

**Question 85 : B** — « parse_html — maintain the original HTML tags of the translated contents (…) localizable_html_attributes — also translate the contents of these HTML attributes » *(§ Pseudo-localization translator)*

**Question 86 : D** — « the message domain has to be suffixed with `+intl-icu` » *(Message Format — § Using the ICU Message Format)*

**Question 87 : D** — « ICU placeholders use `{name}` instead of `%name%` (…) This `%` character is no longer valid with the ICU MessageFormat syntax. » *(Message Format — § Message Placeholders)*

**Question 88 : D** — « the 'other' key is required, and is selected if no other case matches (…) It acts like PHP's switch statement and allows you to use different strings based on the value of the variable. » *(Message Format — § Selecting Different Messages Based on a Condition)*

**Question 89 : C** — « The first `{organizer_gender, select, ...}` block starts the "code" mode (…) The inner `{... has invited you to her party!}` block brings you back in "literal" mode (…) Inside this block, `{organizer_name}` starts "code" mode again. » *(Message Format — § Selecting Different Messages Based on a Condition)*

**Question 90 : B** — « It's possible to translate ICU MessageFormat messages directly in code, without having to define them in any file (…) the required `+intl-icu` suffix is also defined as a constant: `MessageCatalogueInterface::INTL_DOMAIN_SUFFIX` » *(Message Format — § Selecting Different Messages Based on a Condition)*

**Question 91 : D** — « Another interesting function is `plural`. It allows you to handle pluralization in your messages (…) By prefixing with `=`, you can match exact values (like `0` in the above example). » *(Message Format — § Pluralization)*

**Question 92 : B** — « the possible cases in the `plural` function are also different for each language. For instance, Russian has `one`, `few`, `many` and `other`, while English has only `one` and `other`. » *(Message Format — § Pluralization)*

**Question 93 : D** — « You can also set an `offset` variable to determine whether the pluralization should be offset (e.g. in sentences like "You and # other people" / "You and # other person"). » *(Message Format — § Pluralization)*

**Question 94 : D** — « When combining the `select` and `plural` functions, try to still have `select` as outermost function. » *(Message Format — § Pluralization)*

**Question 95 : D** — « The ICU message format does not have this feature. Instead, this logic should be moved to PHP code » — trois messages distincts selon la plage. *(Message Format — § Using Ranges in Messages)*

**Question 96 : B** — « `selectordinal` allows you to use numbers as ordinal scale (…) when only formatting the number as ordinal (like above), you can also use the `ordinal` function. » *(Message Format — § Ordinal)*

**Question 97 : D** — « The date and time function allows you to format dates in the target locale using the `IntlDateFormatter`. » *(Message Format — § Date and Time)*

**Question 98 : B** — « The "function statement" for the `time` and `date` functions can be one of `short`, `medium`, `long` or `full`. » *(Message Format — § Date and Time)*

**Question 99 : D** — « The `number` formatter allows you to format numbers using Intl's `NumberFormatter`. » *(Message Format — § Numbers)*

**Question 100 : C** — « The only format that supports loading and dumping notes is XLIFF version 2. » *(XLIFF Format — § Adding Notes to Translation Contents)*

**Question 101 : D** — « If the XLIFF 2.0 document contains `<notes>` nodes, they are automatically loaded/dumped inside a Symfony application. » *(XLIFF Format — § Adding Notes to Translation Contents)*

**Question 102 : D** — « Besides supporting all Symfony translation features, the XLIFF format also has some specific features. » — notamment les notes destinées aux traducteurs. *(XLIFF Format — introduction)*

## Pour aller plus loin

Les pages listées dans la section [Learn more](https://symfony.com/doc/8.0/translation.html#learn-more) de la page :

- [Message Format](https://symfony.com/doc/8.0/reference/formats/message_format.html) — questions 86 à 99
- [XLIFF Format](https://symfony.com/doc/8.0/reference/formats/xliff.html) — questions 100 à 102
