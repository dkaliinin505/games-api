FROM php:8.1-fpm AS members_core_php

RUN echo "start"

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	libmcrypt-dev
RUN pecl install memcached zlib zip
RUN docker-php-ext-install -j$(nproc) mbstring pdo pdo_mysql gd
RUN docker-php-ext-enable memcached

WORKDIR /var/www/core

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

FROM nginx AS members_core_nginx

ADD docker/nginx/members.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www/core
