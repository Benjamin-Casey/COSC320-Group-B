FROM php:7.4-fpm-alpine

WORKDIR /var/www/backend

RUN apk update && apk add \
    build-base \
    vim

RUN docker-php-ext-install pdo_mysql

RUN addgroup -g 1000 -S www && \
    adduser -g 1000 -S www -G www

USER www

COPY --chown=www:www . /var/www/backend

EXPOSE 900
