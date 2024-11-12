FROM php:8.2-fpm

USER root

RUN apt-get update && \
    apt-get install -y \
        apt-utils \
        libpq-dev \
        bash \
        wget \
        curl \
        npm \
        tar

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/

USER www-data:www-data
