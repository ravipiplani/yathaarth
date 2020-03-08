FROM php:7.2-fpm

WORKDIR /var/www

RUN mkdir -p /usr/share/man/man1mkdir -p /usr/share/man/man1

RUN apt-get update && apt-get -y install git \
        default-jre-headless \
        zip \
        unzip \
        pdftk \
        libmcrypt-dev \
        libmagickwand-dev --no-install-recommends \
        libpq-dev \
        && pecl install mcrypt-1.0.2 \
        && docker-php-ext-install pdo_pgsql \
        && docker-php-ext-enable mcrypt

RUN curl -sS https://getcomposer.org/installer | php&& mv composer.phar /usr/local/bin/composer && composer global require hirak/prestissimo --no-plugins --no-scripts

COPY composer.lock composer.json /var/www/

RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer

COPY . /var/www

RUN composer dump-autoload --no-scripts --no-dev --optimize

RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache
