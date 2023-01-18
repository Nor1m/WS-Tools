FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y git
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y libzip-dev

RUN docker-php-ext-install zip

ENV TZ=Europe/Moscow

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer