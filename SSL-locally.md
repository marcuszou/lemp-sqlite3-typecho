# Connect Local Containers with SSL
**This guide shows you how to connect your local containers with SSL.**

by Marcus Zou | 20 Feb 2025 | 3 minutes Reading - 20 minutes Hands-on



## Local TLS/SSL Connection to Containers

Since extra energy and needs exist, let's give a try of a local SSL connector by https://mkcert.dev or https://github.com/FiloSottile/mkcert. I have a detailed document of how to apply it at https://github.com/marcuszou/mkcert-ng-app.git.

1- Install a certifier: `mkcert` locally:

```shell
## For Linux - if you use Firefox browser
sudo apt install libnss3-tools 
## Install mkcert
sudo apt install mkcert
```

2- Install the service, create the cert and key files:

```shell
## Install the local RootCA service in Linux/macOS/Windows
mkcert -install
## Where is the RootCA?
mkcert -CAROOT
## /home/zenusr/.local/share/mkcert

## create a simple certificate in subfolder: devcerts
mkdir devcerts
mkcert -cert-file ./devcerts/cert.pem -key-file ./devcerts/key.pem localhost 127.0.0.1 ::1
```

3- Introduce SSL server by appending the following contents into `nginx/conf/default.conf` file:

```shell
server {
    ## SSL part begins
    listen 443 ssl;
    listen [::]:443 ssl;
    ssl_certificate /etc/nginx/certs/cert.pem;
    ssl_certificate_key /etc/nginx/certs/key.pem;
    ## SSL part ends

    server_name localhost;
    charset utf-8;

    root /var/www/html;
    index index.php index.html;

    # access_log off;
    access_log /var/log/nginx/access.log main;
    error_log /var/log/nginx/error.log error;

    sendfile off;
    client_max_body_size 100m;

    # Support Yii2 pretty URL routing
    location / {
      try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt { access_log off; log_not_found off; }

    location ~ .php$ {  
      fastcgi_split_path_info ^(.+.php)(/.+)$;  
      fastcgi_pass php:9000;  
      fastcgi_index index.php;
      include fastcgi_params;  
      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;  
      fastcgi_intercept_errors off;  
      fastcgi_buffer_size 16k;  
      fastcgi_buffers 4 16k;  
    }
}
```

4- Adding port 443 and `./devcerts/` volume into the `docker-compose.yml` file:

```shell
# Services
services:

  # Nginx Service
  nginx:
    container_name: web
    image: nginx:alpine
    ports:
      - 8080:80
      - 443:443
    restart: always
    environment:
      - TZ=America/Edmonton
    links:
      - php
    volumes:
      - ./www/html/:/var/www/html/
      - ./nginx/conf/:/etc/nginx/conf.d/
      - ./nginx/logs/:/var/log/nginx/
      - ./devcerts/:/etc/nginx/certs/
    depends_on:
      - php
    networks:
      - lemp-sqlite3-net

  # PHP-FPM Service
  php:
    container_name: php8
    build: php
    expose:
      - 9000
    restart: always
    environment:
      - TZ=America/Edmonton
    volumes:
      - ./www/html/:/var/www/html/
      # php-fpm config files are located at /usr/local/etc/php-fpm.d/ folder
      - ./php/php-log.conf:/usr/local/etc/php-fpm.d/zz-log.conf
      - ./php/php.ini:/usr/local/etc/php/conf.d/php.ini
      - ./db/data/:/data/
    networks:
      - lemp-sqlite3-net

  # SQLiteBrowser Service
  sqlitebrowser:
    container_name: sqlitebrowser
    image: evgeniydoctor/sqlitebrowser:latest
    ports:
      - 5800:5800
    restart: unless-stopped
    environment:
      - VNC_PASSWORD=vncP@ss2024
      - KEEP_APP_RUNNING=1
      - TZ=America/Edmonton
    volumes:
      - ./db/dir:/dbs/dir
      - ./db/data:/dbs/data
    depends_on: 
      - php
    networks:
      - lemp-sqlite3-net

# Networks
networks:
  lemp-sqlite3-net:
```

5- Give a try:

```shell
docker compose up -d
```

then visit the SSL site: https://localhost. Amazing.

Please notice: running this against WSL Linux will introduce a little glitch. better try this in a real VM or physical box.




## End

