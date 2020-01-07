FROM php:7.1-cli-alpine

WORKDIR /app

RUN docker-php-ext-install -j$(nproc) bcmath

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require "hirak/prestissimo"