FROM php:8.4.1-fpm
RUN mkdir /var/www/data && mkdir /var/www/data/logs && mkdir /var/www/data/cache && chown -R www-data:www-data /var/www/data


RUN apt-get update  \
    && apt-get install -y unzip git procps net-tools lsof vim iputils-ping dnsutils ncdu \
    && apt-get upgrade -y

RUN pecl install redis-6.1.0 \
    && pecl install xdebug-3.4.0 \
    && touch /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && docker-php-ext-enable xdebug redis

