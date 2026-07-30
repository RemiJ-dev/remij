---
title:          "Installation Windows WSL"
description:    ""
publishedAt:    "2026-07-30"
lastModified:   ~
authors:        ["remij"]
tags:           ["admin sys", "tutoriel"]
---
## Installer WSL et Ubuntu

- Ouvrir un PowerShell en **mode administrateur**
- Lancer la commande `wsl --install` pour installer WSL
- `wsl --install -d Ubuntu` pour installer une image Ubuntu
- Normalement, un nouveau terminal s'ouvre et vous demande un nom d'utilisateur (format UNIX : sans espace, caractères spéciaux ou majuscules). Entrez-le et entrez un mot de passe. Si cette fenêtre n'apparait pas, ouvrez un terminal "Ubuntu" (disponible dans le menu Windows)

## Installer Ubuntu

Installez quelques paquets de base 

```bash
sudo apt update
sudo apt install curl git htop tar unzip vim zip zsh ca-certificates lsb-release make
```

## Docker

- [Documentation officielle](https://docs.docker.com/engine/install/ubuntu/)
- [Post-install officielle](https://docs.docker.com/engine/install/linux-postinstall/)

Supprimez les anciens paquets éventuellement installés 

```bash
sudo apt remove docker docker-engine docker.io containerd runc
```

Ajoutez les dépendances et le repository

```bash
sudo apt update
sudo mkdir -m 0755 -p /etc/apt/keyrings
 curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

Installez Docker et docker-compose 

```bash
sudo apt update
 sudo apt install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
 ```

Assurez-vous que votre utilisateur appartienne au groupe `docker` et lui dire de démarrer au lancement de l'ordinateur

```bash
sudo groupadd docker
sudo usermod -aG docker $USER
sudo systemctl enable docker.service
sudo systemctl enable containerd.service
```

Pour que l'installation soit complètement opérationnelle, il faut *fermer et rouvrir votre session* ou *redémarrer l'ordinateur*.

Pour modifier le répertoire de stockage des containers, suivre les commandes suivantes : 

```bash
sudo service docker stop
mv /var/lib/docker /[MON_REPERTOIRE]/
sudo ln -s /[MON_REPERTOIRE]/docker /var/lib/docker
sudo service docker start
```

## Oh-my-zsh

Premièrement, changer de shell (passer de bash, installé par défaut, à zsh) :

```bash
chsh
```

Entrez votre mot de passe puis, lorsqu'on vous demande le nouveau shell à utiliser : 

```bash
/bin/zsh
```

Ensuite, installez Oh-My-Zsh:

```bash
sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
```

Vous pouvez ensuite lancer un nouveau terminal pour en voir les effets ou relancer votre session ;) .

### Config and problems

Pour une [documentation plus complète, voir la documentation dédiée](./oh-my-zsh.md) sur ce site. 

### Installation de Powerline

Sur Windows, lancez un PowerShell en **mode administrateur**

Lancer la commande `Set-ExecutionPolicy Bypass` et sélectionnez "Oui pour tous"

Ouvrez un autre PowerShell (pas en mode admin) et téléchargez Powerline :

- `git clone https://github.com/powerline/fonts.git`
- `cd fonts`
- `.\install.ps1`

#### Installer Powerline sur Ubuntu

:warning: Normalement, cette étape n'est pas nécessaire !

- Ouvrir votre terminal Ubuntu
- `git clone https://github.com/powerline/fonts.git`
- `cd fonts`
- `./install.sh`

## Configuration SSH

Par défaut, votre configuration SSH est vide. Il va falloir créer 2-3 éléments pour la faire fonctionner.

- `mkdir -p ~/.ssh -m 755`

Collez dans ce dossier vos clés ssh. Par exemple, depuis vos clés Windows : 

`cp -R /mnt/c/Users/VotreNom/.ssh/* ~/.ssh`

Mettez à jour les droits sur les fichiers : 

- `chmod 644 ~/.ssh/*`
- `chmod 600 ~/.ssh/id_rsa` (faites de même pour vos autres clés privées)

Installer `ssh-askpass` :

`sudo apt update && sudo apt install ssh-askpass`

Lancer ssh avec Ubuntu :

`sudo systemctl enable ssh`

