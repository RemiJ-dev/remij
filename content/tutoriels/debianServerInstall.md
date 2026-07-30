---
title:          "Installation d'un serveur Debian"
description:    ""
publishedAt:    "2026-07-30"
lastModified:   ~
authors:        ["remij"]
tags:           ["admin sys", "tutoriel"]
---

## Paquets

Des paquets nécessaires à la vie quotidienne du serveur :

- `curl` : pour faire des requêtes http(s) vers l'extérieur et récupérer le contenu
- `git` : pour récupérer le code de nos projets
- `htop` : pour voir l'état du serveur, les processus en cours, etc.
- `tar` : (dé)compresser des fichiers
- `unzip` : décompresser des fichiers zip (nécessaire pour composer)
- `nano` : éditeur de texte en ligne de commande
- `vim` : éditeur de texte en ligne de commande
- `zip` : pour compresser des fichiers au format zip (utile pour certains scripts PHP)
- `lsb-release` : pour récupérer la version de notre Debian depuis la ligne de commande (utile pour installer certains logiciels, comme nodeJs)
- `apt-transport-https` : pour permettre à apt (gestionnaire de paquets) de communiquer en https
- `ca-certificates` : pour gérer les certificats SSL (utile pour `apt-transport-https` par exemple)

```bash
sudo apt update && sudo apt install curl git htop tar unzip nano vim zip lsb-release apt-transport-https ca-certificates 
```

### Php et Nginx

Ajoute un repository (pour apt) de PHP (pour avoir des versions plus à jour que celles fournies par Debian).

```bash
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
```

Installe tous les paquets dont on a besoin

```bash
sudo apt update && sudo apt install php-pear php8.5 php8.5-{cli,common,curl,dev,fpm,gd,intl,mbstring,mysql,xml}
```

Désactive Apache (serveur web) et installe nginx et PHP.

```bash
sudo systemctl disable --now apache2
```

Apache étant désactivé, on peut installer Nginx sans problème (ça nous évite des soucis de compatibilité de ports)

```bash
sudo apt update && sudo apt install nginx
```

### NodeJs & NPM

Installe la version 24 de nodeJS (pour une autre version, remplacer 24 par la version voulue).

```bash
curl -sL https://deb.nodesource.com/setup_24.x | sudo -E bash - && sudo apt install -y nodejs
```

### Composer (dernière version)

```bash
sudo apt update && curl -sS https://getcomposer.org/installer -o composer-setup.php && sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm -rf composer-setup.php
```

### MySQL

```bash
sudo apt update && sudo apt install mysql-server
```

```bash
sudo systemctl restart mysql.service # équivalent à sudo service mysql restart
```

```bash
sudo mysql_secure_installation
```

## Importer la base de données

```bash
sudo mysql -u utilisateur -p nomDeLaBaseDeDonnées < fichierSqlAImporter.sql 
```

## Exporter la base de données

```bash
sudo mysqldump -u utilisateur -p nomDeLaBaseDeDonnées > fichierSqlAExporter.sql 
```

# Commandes utiles au quotidien 

## Voir l'état et redémarrer des services

Voir l'état du service `nomDuService` (à remplacer par php7.2-fpm, nginx ou apache2, selon les serveurs et les besoins)

```bash
sudo service nomDuService status
```

Redémarrer le service `nomDuService` (à remplacer par php7.2-fpm, nginx ou apache2, selon les serveurs et les besoins)

```bash
sudo service nomDuService restart
```

## Renouveler les certificats SSL

```bash
sudo certbot renew
```

## Trouver les fichiers de configuration Nginx ou Apache

- Apache : les VHosts (fichiers de configuration d'un site) se trouvent dans `/etc/apache2/sites-available/`
- Nginx : les servers (fichiers de configuration d'un site) se trouvent dans `/etc/nginx/sites-available/`

Dans les deux cas, pour activer un site, il faut l'ajouter (on fait un lien symbolique) dans le dossier `sites-enabled` et on redémarre le service.

- Apache :
```bash
sudo a2ensite test.conf
sudo service apache2 restart
```

- Nginx :
```bash
sudo ln -s /etc/nginx/sites-available/test.conf /etc/nginx/sites-enabled/
sudo service nginx restart
```

## Ajouter un certificat SSL sur un ou des noms de domaine

Installation des plugins nécessaires :

```bash
sudo apt install python3-certbot-dns-cloudflare
```

Pour les certificats, nous utilisons Let's Encrypt (et son programme Certbot).
La plupart du temps, nous utilisons Cloudflare pour gérer les questions de DNS (pour faire le lien entre le nom de domaine et le serveur), afin de réduire les temps de propagation et utiliser plusieurs outils qui nous simplifient la vie :

```bash
sudo certbot --dns-cloudflare --dns-cloudflare-credentials /chemin/vers/le/fichier/.cloudflare-api certonly -d "test.fr" -d "*.test.fr" # Générer un certificat pour test.fr et tous ses sous-domaines
sudo certbot -d "test.fr" -d "*.test.fr" # pour installer le certificat généré
```

Pour assurer le renouvellement du certificat, il suffit d'ajouter dans le cron (avec la commande `sudo crontab -e` par exemple) :

```cron
0 2 * * * certbot renew # Renouvelle les certificats tous les jours à 2h du matin
15 2 * * * /etc/init.d/nginx restart # Important ! Redémarre Nginx après le renouvellement des certificats, pour qu'ils soient bien pris en compte
```


## Un utilisateur pour le groupe www-data

Créer l'utilisateur

```bash
sudo useradd -m [USERNAME] -p [PASSWORD]
```

Associer l'utilisateur au groupe www-data

```bash
sudo usermod -a -G www-data [USERNAME]
```

Créer une crontab pour l'utilisateur 

```bash
sudo crontab -u [USERNAME] -e
```
