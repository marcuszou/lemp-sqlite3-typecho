# Addon: Typecho Blog System for LEMP

by Marcus Zou | 26 Feb 2025



## Intro 

I've been bringing the Chinese-made [Typecho](https://typecho.org) came into my LEMP-Sqlite3 project.

`Typecho` is a blogging app developed with PHP by a Chinese IT company, supporting MySQL, PostgreSQL and SQLite. 

`Typecho` is the BEST of the BESTs as it's -

- Lightweight
- Supporting MySQL, PostgreSQL and SQLite
- Just-in-time, fit-for-purpose
- State of Art design
- Chinese oriented

#### Prerequisites

- An Debian 12 / Debian 20/22/24 server with a non-root account having `sudo` privileges.
- A fully registered domain name pointed to your server's IP address.
- A LEMP+SQLite container already in place.



## Install Typecho Blog system

a). Make sure the prerequisites are met as per the official website: https://docs.typecho.org/install.

- PHP 7.4+

- PHP extensions: curl, mbstring or iconv

- Database: MySQL, or PostgreSQL, or SQLite and its relevant PHP extension.


b). Download stable version of `Typecho` from https://github.com/typecho/typecho/releases/latest/download/typecho.zip, and  the language pack from: https://github.com/typecho/languages/releases/download/ci/langs.zip then unzip both zip files to the web folder:

```shell
## make a new folder for TYpecho system
mkdir -p www/typecho
## Download
wget https://github.com/typecho/typecho/releases/latest/download/typecho.zip
## unzip the installer of Typecho to the main folder
sudo unzip ./typecho.zip -d www/typecho/

wget https://github.com/typecho/languages/releases/download/ci/langs.zip
## Unzip the language pack to subfolder: /usr/langs
sudo unzip ./langs.zip -d www/typecho/usr/langs/
```

Now check out the folder structure, be like:

```shell
## tree www/typecho -L 1
www/typecho
├── LICENSE.txt
├── admin
├── index.php
├── install
├── install.php
├── usr
└── var
```

```shell
## tree www/typecho/usr -L 1
www/typecho/usr
├── langs
├── plugins
├── themes
└── uploads
```

Then download and install the themes and plugins:

```shell
## theme download & install
wget https://github.com/marcuszou/caddy-typecho/blob/master/themes/theme-MWordStar-2.6-bundle.zip
sudo unzip ./theme-MWordStar-2.6-bundle.zip -d www/typecho/usr/themes/

## plugin diwnload and install
wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-ColorHighlight-for-typecho.zip
sudo unzip ./plugin-ColorHighlight-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-Likes-for-typecho.zip
sudo unzip ./plugin-Likes-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-PostTOC-for-typecho.zip
sudo unzip ./plugin-PostTOC-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-TypechoPDF.zip
sudo unzip ./plugin-TypechoPDF.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-ViewsCounter-for-typecho.zip
sudo unzip ./plugin-ViewsCounter-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-YoutubeEmdedding-for-typecho.zip 
sudo unzip ./plugin-YoutubeEmdedding-for-typecho.zip -d www/typecho/usr/plugins/

rm *.zip

## Write a placeholder.txt file for avoiding future hiccup
echo "placeholder" > www/typecho/usr/uploads/placeholder.txt

## Check the folder structure with the just-installed langs, themes, and plugins.
## tree www/typecho/usr -L 2
```

```shell
www/typecho/usr
├── langs
│   ├── ceb.mo
│   ├── el_GR.mo
│   ├── en_US.mo
│   ├── es_ES.mo
│   ├── fil_PH.mo
│   ├── fr_FR.mo
│   ├── ja_JP.mo
│   ├── pt_BR.mo
│   ├── ru_RU.mo
│   ├── tr_TR.mo
│   ├── ug_CN.mo
│   └── zh_TW.mo
├── plugins
│   ├── ColorHighlight
│   ├── HelloWorld
│   ├── Like
│   ├── PostToc
│   ├── TypechoPDF
│   ├── ViewsCounter
│   └── Youtube
├── themes
│   ├── MWordStar
│   └── default
└── uploads
    └── placeholder.txt
```

c). Configure the ownership and privileges of the web root folder prior to the setup journey. Otherwise you will encounter error:  "`File not exist`" or likewise:

```shell
## change the ownership of the folder
sudo chown -R www-data:www-data www/typecho
## Change the mode/privileges of the folder
sudo chmod -Rf 755 www/typecho

```



## Try it out

Change the volume mapping:

```shell
    volumes:
      #- ./www/html/:/var/www/html/
      - ./www/typecho/:/var/www/html/
```

Optionally comment out the `SqliteBrowser` container part in `docker-compose.yml` file to save some diskspace.

Then spin up the containers:

```shell
docker compose up -d
```

Open a browser to http://localhost:8080 to enjoy the `Typecho Blog` system. 



## The End
