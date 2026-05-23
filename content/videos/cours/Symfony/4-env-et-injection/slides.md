---
headingDivider: 2
paginate: true
auto-scaling: true
header: "<span>![](https://demo.drakona.fr/build/images/Logo-picto.svg) Drakolab</span> Variables d'environnement, configuration et injection de dépendances"
---

# Configuration et injection

- Définitions
- Configurer une app Symfony
- Variables d'environnement
- Services
- Exemple concret

## Définitions

- Configuration
- Variables d'environnement
- Services
- Injection de dépendances

## Configurer une app Symfony

- Dossier `config`
- Un fichier `yaml`
- Des paramètres
  - Types
  - Utilisation
- Environnement (dev/prod/etc.)

## Variables d'environnement

- Fichiers `.env*`
- Environnement et versioning
- Utilisation des variables
- `php bin/console debug:dotenv`

## Services

- Déclarer un service
- Injecter un service
  - dans un contrôleur
  - dans un service
- Injecter un paramètre

## Exemple concret

- Création d'un service (`DiceThrower`)
- Utiliser ce service dans un Controller
- Ajout de configuration du service (+ environnement)
  - Nombre de dés par défaut
  - Nombre de faces par défaut

## Et voilà !

![Et voilà](https://media.giphy.com/media/lD76yTC5zxZPG/giphy.gif)