FROM php:8.3-fpm-alpine AS fpm

RUN docker-php-ext-install \
    pdo_mysql \
    opcache

RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY config/php.xdebug.ini "$PHP_INI_DIR/conf.d/xdebug.ini"


FROM php:8.3-alpine AS cli

RUN docker-php-ext-install \
    pdo_mysql \
    opcache

RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY config/php.xdebug.ini "$PHP_INI_DIR/conf.d/xdebug.ini"
