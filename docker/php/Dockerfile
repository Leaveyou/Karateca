FROM php:8.1.1-fpm
RUN mkdir /var/www/data && mkdir /var/www/data/logs && mkdir /var/www/data/cache && chown -R www-data:www-data /var/www/data
COPY vendor /var/www/html/vendor
RUN pecl install xdebug-3.1.2 \
    && touch /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && docker-php-ext-enable xdebug