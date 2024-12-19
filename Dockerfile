FROM php:8.3-rc-apache

COPY . /var/www/html/

RUN chmod -R 755 /var/www/html
RUN chown -R www-data:www-data /var/www/html

RUN apt-get -y update \
    && apt-get -y install git \
    && apt-get -y install libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

ADD docker-config/ /etc/apache2/sites-available

RUN service apache2 stop
RUN service apache2 start