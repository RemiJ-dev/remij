---
title:          "Installation Ubuntu"
description:    ""
publishedAt:    "2026-07-30"
lastModified:   ~
authors:        ["remij"]
tags:           ["admin sys", "tutoriel"]
---

## Paquets Ubuntu

### Sans php local (utilisez Docker)

```bash
sudo apt install curl git gitk htop python rar tar thefuck unrar unzip vim vlc zip zsh
```

Sautez ensuite à [la section sur Docker](#docker)

### Avec un php local

```bash
sudo add-apt-repository ppa:ondrej/php
sudo add-apt-repository ppa:ondrej/nginx
```

```bash
sudo apt install curl git htop imagemagick imagemagick-common pandoc php-pear php8.5 php8.5-{cli,common,curl,dev,fpm,gd,intl,mbstring,mysql,xml} tar unzip vim zip zsh
```

## Docker

- [Documentation officielle](https://docs.docker.com/engine/install/ubuntu/)
- [Post-install officielle](https://docs.docker.com/engine/install/linux-postinstall/)

Supprimez les anciens paquets éventuellement installés 

```bash
sudo apt-get remove docker docker-engine docker.io containerd runc
```

Ajoutez les dépendances et le repository

```bash
sudo apt-get update
sudo apt-get install ca-certificates curl lsb-release
sudo mkdir -m 0755 -p /etc/apt/keyrings
 curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

Installez Docker et docker-compose 

```bash
sudo apt-get update
 sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
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

## NodeJs & NPM (optionnel si vous utilisez Docker)

```bash
curl -sL https://deb.nodesource.com/setup_24.x | sudo -E bash -
sudo apt install -y nodejs
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

## PhpStorm

Installez PhpStorm

```bash
sudo snap install phpstorm --classic
```

Puis configurez un raccourci si les paquets snap sont mal pris en compte sur votre machine :

`vim /usr/share/applications/jetbrains-phpstorm.desktop`

```bash
[Desktop Entry]
Version=1.0
Type=Application
Name=PhpStorm
Icon=/snap/phpstorm/current/bin/phpstorm.png
Exec="/snap/phpstorm/current/bin/phpstorm.sh" %f
Comment=Un IDE pour PHP
Categories=Development;IDE;
Terminal=false
StartupWMClass=jetbrains-phpstorm
```

## Composer

```bash
sudo apt update
sudo apt install php-cli unzip
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm -rf composer-setup.php
```

Vérifiez

```bash
composer --version
```
