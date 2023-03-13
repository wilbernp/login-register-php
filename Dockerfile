FROM php:8.2.3-apache-buster

COPY src/ /var/www/html

EXPOSE 80