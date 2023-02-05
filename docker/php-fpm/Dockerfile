ARG php_version=8.1
FROM php:${php_version}-fpm

ENV COMPOSER_HOME /var/www/.composer

RUN apt-get update && apt-get install -y \
  git \
  libfreetype6-dev \
  libjpeg-dev \
  libpng-dev \
  libzip-dev \
  libxml2-dev \
  libxslt-dev \
  zlib1g-dev \
  vim \
  htop \
  procps \
  iputils-ping \
  && pecl install xdebug \
#  && docker-php-ext-enable xdebug \
  && docker-php-ext-install bcmath \
  && docker-php-ext-install intl \
  && docker-php-ext-install opcache \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install soap \
  && docker-php-ext-install xsl \
  && docker-php-ext-install zip \
  && docker-php-ext-install sockets \
&& rm -rf /var/lib/apt/lists/*

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

COPY www.conf /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /var/www/.composer \
  && mkdir /var/www/.ssh \
  && chown www-data:www-data /var/www/.ssh

USER www-data

WORKDIR /var/www/app

