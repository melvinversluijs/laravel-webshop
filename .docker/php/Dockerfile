FROM php:8.0-fpm-alpine
MAINTAINER Melvin Versluijs <https://github.com/melvinversluijs>

RUN apk add \
		php7-mbstring \
        php7-mcrypt \
        php7-pdo \
        php7-pdo_pgsql \
        php7-pdo_sqlite

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

EXPOSE 9000

CMD ["php-fpm"]
