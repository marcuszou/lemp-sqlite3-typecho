FROM php:8.2-fpm

# Installing dependencies for the PHP modules
RUN apt-get update
RUN apt-get install -y curl unzip zip libbz2-dev libcurl3-dev libjpeg62-turbo-dev libpng-dev libonig-dev libssl-dev libsqlite3-dev libxml2-dev libzip-dev
# libonig-dev is needed for oniguruma which is needed for php-mbstring
RUN rm -rf /var/lib/apt/lists/*

# Installing PHP modules: curl, mbstring, pdo, pdo_sqilte ...
RUN docker-php-ext-install curl gd mbstring pdo pdo_sqlite xml zip

# COMPOSER - the PHP dependency manager
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
