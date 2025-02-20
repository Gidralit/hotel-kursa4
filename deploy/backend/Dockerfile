FROM php:8.3-fpm

RUN apt-get update && apt-get install -y

RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

COPY ../../project/backend .

EXPOSE 8000