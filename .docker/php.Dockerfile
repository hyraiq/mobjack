FROM php:8.1-fpm-alpine as fpm

RUN docker-php-ext-install \
    pdo_mysql \
    opcache

RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY config/php.xdebug.ini "$PHP_INI_DIR/conf.d/xdebug.ini"


FROM php:8.1-alpine as cli

RUN docker-php-ext-install \
    pdo_mysql \
    opcache

RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY config/php.xdebug.ini "$PHP_INI_DIR/conf.d/xdebug.ini"
