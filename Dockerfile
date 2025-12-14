FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

EXPOSE 80
