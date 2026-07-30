---
title:          "Oh my ZSH"
description:    ""
publishedAt:    "2026-07-30"
lastModified:   ~
authors:        ["remij"]
tags:           ["admin sys", "tutoriel"]
---

Première étape, installer zsh (si ça n'est pas déjà fait) :

```bash
sudo apt install zsh
```

Ensuite passer de bash à zsh :

```bash
chsh
```

La commande va vous demander votre mot de passe, puis le chemin vers le script à utiliser :

```bash
/bin/zsh
```

Ensuite, installer Oh-My-Zsh :

```bash
sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
```

Redémarrer votre ordinateur (ou passer à l'étape de configuration avant ;) ) et vous utilisez Oh my Zsh !

## Configuration et problèmes

La configuration se fait dans le fichier `~/.zshrc`. Vous pourriez avoir besoin d'une [police "Powerline"](https://github.com/powerline/fonts) pour que tous les caractères s'affichent correctement.

Les [thèmes disponibles](https://github.com/ohmyzsh/ohmyzsh/wiki/themes)

### Un exemple de fichier zshrc

Pour cet exemple, de nombreux plugins sont à installer et il faut remplacer toutes les occurrences de YOURUSERNAME par votre identifiant (dans mon cas, `remi`) et mettre à jour les clés ssh à charger dans cette ligne : `zstyle :omz:plugins:ssh-agent identities id_rsa`.

Cet exemple utilise le thème [powerlevel10k](https://github.com/romkatv/powerlevel10k) qui fournit de nombreux outils et vous proposera de le configurer.

Une fois un plugin installé ou votre configuration terminée, lancez la commande `source ~/.zshrc` pour actualiser votre zsh/terminal.

#### Liste des plugins et thèmes installés et comment les installer

- [zsh-syntax-highlighting](https://github.com/zsh-users/zsh-syntax-highlighting) :

```bash
git clone https://github.com/zsh-users/zsh-syntax-highlighting.git ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-syntax-highlighting
``` 

- [zsh-autosuggestions](https://github.com/zsh-users/zsh-autosuggestions/) :

```bash
git clone https://github.com/zsh-users/zsh-autosuggestions ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-autosuggestions
``` 

- [Powerlevel10k](https://github.com/romkatv/powerlevel10k#oh-my-zsh)
```bash
git clone --depth=1 https://github.com/romkatv/powerlevel10k.git ${ZSH_CUSTOM:-$HOME/.oh-my-zsh/custom}/themes/powerlevel10k
```

Les autres sont disponibles dans le [répertoire des plugins pour Oh-My-zsh](https://github.com/ohmyzsh/ohmyzsh/wiki/Plugins).

- git
- [z](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/z)
- zsh-autosuggestions
- colorize
- command-not-found
- composer
- docker-compose
- docker
- git-flow
- gulp
- npm
- npx
- ssh-agent
- [sudo](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/sudo)
- colored-man-pages
- extract
- history
    
#### Le fichier `~/.zshrc` tant attendu
    
```bash
# Enable Powerlevel10k instant prompt. Should stay close to the top of ~/.zshrc.
# Initialization code that may require console input (password prompts, [y/n]
# confirmations, etc.) must go above this block; everything else may go below.
if [[ -r "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh" ]]; then
  source "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh"
fi

# If you come from bash you might have to change your $PATH.
export PATH=/snap/bin:$PATH

# Path to your oh-my-zsh installation.
export ZSH="/home/YOURUSERNAME/.oh-my-zsh"

# Set name of the theme to load --- if set to "random", it will
# load a random theme each time oh-my-zsh is loaded, in which case,
# to know which specific one was loaded, run: echo $RANDOM_THEME
# See https://github.com/ohmyzsh/ohmyzsh/wiki/Themes
ZSH_THEME="powerlevel10k/powerlevel10k"

DEFAULT_USER="YOURUSERNAME"

# Set list of themes to pick from when loading at random
# Setting this variable when ZSH_THEME=random will cause zsh to load
# a theme from this variable instead of looking in $ZSH/themes/
# If set to an empty array, this variable will have no effect.
# ZSH_THEME_RANDOM_CANDIDATES=( "robbyrussell" "agnoster" )

# Uncomment the following line to use case-sensitive completion.
# CASE_SENSITIVE="true"

# Uncomment the following line to use hyphen-insensitive completion.
# Case-sensitive completion must be off. _ and - will be interchangeable.
# HYPHEN_INSENSITIVE="true"

# Uncomment the following line to disable bi-weekly auto-update checks.
# DISABLE_AUTO_UPDATE="true"

# Uncomment the following line to automatically update without prompting.
# DISABLE_UPDATE_PROMPT="true"

# Uncomment the following line to change how often to auto-update (in days).
# export UPDATE_ZSH_DAYS=13

# Uncomment the following line if pasting URLs and other text is messed up.
# DISABLE_MAGIC_FUNCTIONS=true

# Uncomment the following line to disable colors in ls.
# DISABLE_LS_COLORS="true"

# Uncomment the following line to disable auto-setting terminal title.
# DISABLE_AUTO_TITLE="true"

# Uncomment the following line to enable command auto-correction.
# ENABLE_CORRECTION="true"

# Uncomment the following line to display red dots whilst waiting for completion.
# COMPLETION_WAITING_DOTS="true"

# Uncomment the following line if you want to disable marking untracked files
# under VCS as dirty. This makes repository status check for large repositories
# much, much faster.
# DISABLE_UNTRACKED_FILES_DIRTY="true"

# Uncomment the following line if you want to change the command execution time
# stamp shown in the history command output.
# You can set one of the optional three formats:
# "mm/dd/yyyy"|"dd.mm.yyyy"|"yyyy-mm-dd"
# or set a custom format using the strftime function format specifications,
# see 'man strftime' for details.
# HIST_STAMPS="mm/dd/yyyy"

# Would you like to use another custom folder than $ZSH/custom?
# ZSH_CUSTOM=/path/to/new-custom-folder

# Which plugins would you like to load?
# Standard plugins can be found in $ZSH/plugins/
# Custom plugins may be added to $ZSH_CUSTOM/plugins/
# Example format: plugins=(rails git textmate ruby lighthouse)
# Add wisely, as too many plugins slow down shell startup.
plugins=(git z zsh-autosuggestions colorize command-not-found composer docker-compose docker git-flow gulp npm npx ssh-agent sudo colored-man-pages extract history zsh-syntax-highlighting)
zstyle :omz:plugins:ssh-agent agent-forwarding on
zstyle :omz:plugins:ssh-agent identities id_rsa

source $ZSH/oh-my-zsh.sh

# User configuration

# export MANPATH="/usr/local/man:$MANPATH"

# You may need to manually set your language environment
# export LANG=en_US.UTF-8

# Preferred editor for local and remote sessions
# if [[ -n $SSH_CONNECTION ]]; then
#   export EDITOR='vim'
# else
#   export EDITOR='mvim'
# fi

# Compilation flags
# export ARCHFLAGS="-arch x86_64"

# Set personal aliases, overriding those provided by oh-my-zsh libs,
# plugins, and themes. Aliases can be placed here, though oh-my-zsh
# users are encouraged to define aliases within the ZSH_CUSTOM folder.
# For a full list of active aliases, run `alias`.
#
# Example aliases
# alias zshconfig="mate ~/.zshrc"
# alias ohmyzsh="mate ~/.oh-my-zsh"
source /home/YOURUSERNAME/.oh-my-zsh/custom/plugins/zsh-syntax-highlighting/zsh-syntax-highlighting.zsh

# To customize prompt, run `p10k configure` or edit ~/.p10k.zsh.
[[ ! -f ~/.p10k.zsh ]] || source ~/.p10k.zsh
```

## Visite guidée des plugins

### git

Rendez-vous dans un projet géré avec git et vous verrez des indications de l'état du repository local, ainsi que le nom de votre branche. L'affichage diffère selon les thèmes Oh My Zsh utilisés ou la configuration de p10k. 

### [z](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/z)

Déplacez-vous de manière magique entre vos dossiers couramment utilisés.
z se base sur votre historique de navigation dans les dossiers, donc il aura besoin d'un temps d'apprentissage pour connaître tous les dossiers. 

Prenons un exemple : 
- je suis dans le dossier `~` (mon dossier personnel)
- je veux aller dans le dossier `~/Work/un-dossier/un-autre/un-sous-dossier/truc`
- à condition d'être déjà allé dans ce dossier depuis que z est activé, je peux taper `z truc` et vous aurez l'équivalent de `cd ~/Work/un-dossier/un-autre/un-sous-dossier/truc`

### zsh-autosuggestions

Une fois installé et activé, ce plugin vous affiche des suggestions pendant votre frappe. Pour valider une suggestion, il faut appuyer sur la touche "droite".

### command-not-found

Vous affiche le nom des paquets et la commande pour installer un paquet manquant. Exemple : 

```bash
$ mutt
The program 'mutt' can be found in the following packages:
 * mutt
 * mutt-kz
 * mutt-patched
Try: sudo apt install <selected package>
```

### [ssh-agent](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/ssh-agent)

Charge les clés ssh demandées dans le fichier `~/.zshrc` (ligne `zstyle :omz:plugins:ssh-agent identities id_rsa` dans l'exemple au-dessus) au démarrage du terminal. En clair, cette commande vous évite de lancer un `ssh-add` à chaque démarrage de votre session.

Si vous utilisez le système de gestion de mots de passe de KDE, vous serez encore moins embêtés ;) .

### [sudo](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/sudo)

Appuyez 2 fois sur la touche `echap` pour ajouter `sudo` au début de la commande que vous êtes en train de taper ou de la commande précédemment exécutée.

### [extract](https://github.com/ohmyzsh/ohmyzsh/tree/master/plugins/extract)

Ouvrir une archive avec une seule commande : 

`extract nomDuFichier.zip` ou `extract nomDuFichier.rar` ou `extract nomDuFichier.tar`, etc.
