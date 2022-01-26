FROM php:8.1-fpm-alpine
MAINTAINER Melvin Versluijs <https://github.com/melvinversluijs>

## Install alpine packages.
RUN apk add \
        postgresql-dev

## Install composer.
COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

## Install Redis.
ENV PHPREDIS_VERSION 5.3.4
RUN curl -L -o /tmp/redis.tar.gz "https://github.com/phpredis/phpredis/archive/${PHPREDIS_VERSION}.tar.gz" \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv phpredis-* /usr/src/php/ext/redis

## Install required php extensions.
RUN docker-php-ext-install \
        pdo \
        pdo_pgsql \
        redis

## Set development php ini file.
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

## Set working directory.
WORKDIR /app

CMD ["php-fpm"]
