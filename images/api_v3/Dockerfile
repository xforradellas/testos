FROM php:8.3-fpm

RUN apt update -yqq && apt install --no-install-recommends -y unzip libzip-dev zip curl && apt-get clean

RUN docker-php-ext-install pdo_mysql zip

RUN pecl install redis-5.3.7 \
    && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY apache2/default.conf /etc/apache2/sites-enabled/000-default.conf
COPY php/timezone.ini "$PHP_INI_DIR/conf.d/timezone.ini"
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

#RUN a2enmod rewrite
