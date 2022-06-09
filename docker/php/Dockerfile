# Base image
FROM php:apache

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Run apt update and upgrade any older packages
RUN apt-get update && apt-get upgrade -y --force-yes

# install some dependencies
RUN apt install -y --force-yes apt-utils sendmail mariadb-client pngquant unzip zip libpng-dev libjpeg-dev  libmcrypt-dev git \
  curl libicu-dev libxml2-dev libssl-dev libcurl3 libcurl4-gnutls-dev libsqlite3-dev libsqlite3-0 libzip-dev


RUN apt install -y --force-yes libjpeg62-turbo-dev libpng-dev libxpm-dev libpng-dev libfreetype6-dev

# Install php extensions
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/lib --with-png-dir=/usr/lib --with-jpeg-dir=/usr/lib
RUN docker-php-ext-install gd mysql mysqli json
RUN docker-php-ext-enable gd.so json.so mysql.so mysqli.so
RUN pecl install apcu-4.0.11 && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini

# Install sudo for running cache clearing scripts
RUN apt-get install -y --force-yes sudo

# You can specify apache user there
ENV APACHE_RUN_USER=1000

# Update public web root
ENV APACHE_DOCUMENT_ROOT /var/www/html
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# RUN sudo -u www-data php ./bin/php/ezpgenerateautoloads.php -o
# RUN sudo -u www-data php ./bin/php/ezpgenerateautoloads.php -k
# RUN sudo -u www-data php ./bin/php/ezpgenerateautoloads.php -e

# Enable mod_rewrite
RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod expires
# Install mailhog sendmail
#RUN curl -fsSL "https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64" -o /usr/local/bin/mhsendmail && chmod +x /usr/local/bin/mhsendmail
