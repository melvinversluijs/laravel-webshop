FROM php:8.0-fpm-alpine
MAINTAINER Melvin Versluijs <https://github.com/melvinversluijs>

RUN apk add \
        postgresql-dev

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

## Install required php modules.
RUN docker-php-ext-install \
        pdo \
        pdo_pgsql

WORKDIR /app

EXPOSE 9000

CMD ["php-fpm"]
