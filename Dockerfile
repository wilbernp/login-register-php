FROM php:8.2.3-apache-buster

RUN apt-get update \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

COPY src/ /var/www/html

EXPOSE 80