FROM php:8.2-fpm
RUN mkdir /var/www/data && mkdir /var/www/data/logs && mkdir /var/www/data/cache && chown -R www-data:www-data /var/www/data

RUN pecl install redis-6.0.1 \
        && pecl install xdebug-3.2.1 \
        && touch /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
        && docker-php-ext-enable xdebug redis

RUN apt-get update  \
    && apt-get install -y procps net-tools lsof vim iputils-ping dnsutils ncdu

