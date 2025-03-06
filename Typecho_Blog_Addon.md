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
wget https://github.com/typecho/typecho/releases/latest/download/typecho.zip --no-check-certificate
## unzip the installer of Typecho to the main folder
sudo unzip ./typecho.zip -d www/typecho/

wget https://github.com/typecho/languages/releases/download/ci/langs.zip --no-check-certificate
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
wget https://github.com/marcuszou/caddy-typecho/blob/master/themes/theme-MWordStar-2.6-bundle.zip --no-check-certificate
sudo unzip ./theme-MWordStar-2.6-bundle.zip -d www/typecho/usr/themes/

## plugin diwnload and install
wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-ColorHighlight-for-typecho.zip --no-check-certificate
sudo unzip ./plugin-ColorHighlight-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-Likes-for-typecho.zip --no-check-certificate
sudo unzip ./plugin-Likes-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-PostTOC-for-typecho.zip --no-check-certificate
sudo unzip ./plugin-PostTOC-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-TypechoPDF.zip --no-check-certificate
sudo unzip ./plugin-TypechoPDF.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-ViewsCounter-for-typecho.zip --no-check-certificate
sudo unzip ./plugin-ViewsCounter-for-typecho.zip -d www/typecho/usr/plugins/

wget https://github.com/marcuszou/caddy-typecho/blob/master/plugins/plugin-YoutubeEmdedding-for-typecho.zip --no-check-certificate
sudo unzip ./plugin-YoutubeEmdedding-for-typecho.zip -d www/typecho/usr/plugins/

rm *.zip
@@ CHeck the folder structure 
```

```shell
www/typecho/usr/plugins/
├── ColorHighlight
├── HelloWorld
├── Like
├── PostToc
├── TypechoPDF
├── ViewsCounter
└── Youtube
```



c). Configure the ownership and privileges of the web root folder prior to the setup journey. Otherwise you will encounter error:  "`File not exist`" or likewise:

```shell
## change the ownership of the folder
sudo chown -R www-data:www-data www/typecho
## Change the mode/privileges of the folder
sudo chmod -Rf 755 www/typecho

```

Open a browser to http://localhost. The website will be re-directed to the install process: http://172.31.111.215/install.php, which be like:

![Install](assets/p3.png)

I'll switch to "English" edition by clicking the lower-right dropdown box, then you will have:

![Install-Eng](assets/p3-eng.png)

Most likely you will encounter an issue of:

> 上传目录无法写入, 请手动将安装目录下的 /usr/uploads 目录的权限设置为可写然后继续升级
>
> The upload directory cannot be written. Please manually set the permissions of the /usr/uploads directory under the installation directory to be writable and then continue the upgrade

Then we have to go back to the web server directory and set the `/var/www/example.com/html/usr/uploads` folder writable by user `caddy`.

```shell
cd /var/www/example.com/html
sudo chown caddy:caddy -Rf ./usr/uploads/
## For other cases: sudo chown www-data:www-data ./usr/uploads/
sudo chmod 755 -R ./usr/uploads/
```

Then refresh the webpage, you should be able to proceed to the "Initial configuration".

![init-config](assets/p4.png)

if you forget to change the ownership of step 6c), most likely, you will encounter another issue of:

> The installer cannot automatically create the **config.inc.php** file. You can manually create the **config.inc.php**
> file in the root directory of the website and copy the following code into it.

The reason is because `.../example.com/html/` folder is owned by `root` user while all operations shall be done with user `caddy`. Considering future operations are all by user `caddy`, then best solution is not manually creating the `config.inc.php` file, but modify the ownership of the `.../example.com/htm;/` folder:

```shell
sudo chown -R caddy:caddy /var/www/html/
## For other cases: sudo chown www-data:www-data /var/www/typecho/
```

Then refresh the webpage of `Initial Configuration`, the you will be okay to proceed to next page:

![Image](assets/p5.png)

Then you will reach the final step:

![Done](assets/p6.png)

Enjoy the show!



## The End
