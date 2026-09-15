ARG PHP_VERSION=8.5
FROM php:${PHP_VERSION}-fpm

ARG APP_UID=1000
ARG APP_GID=1000

RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libicu-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli zip intl gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php/conf.d/zz-app.ini

# Run php-fpm as the host user so bind-mounted files stay writable on both sides.
RUN groupmod -o -g "${APP_GID}" www-data \
    && usermod  -o -u "${APP_UID}" -g "${APP_GID}" www-data

WORKDIR /var/www/html
USER www-data
