FROM php:8.1-fpm
RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "vim"]
RUN ["apt-get", "install", "-y", "libpng-dev"]
RUN ["apt-get", "install", "-y", "zlib1g-dev"]
RUN ["apt-get", "install", "-y", "libonig-dev"]
RUN ["apt-get", "install", "-y", "libpq-dev"]

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && docker-php-ext-install mbstring gd pdo pdo_mysql mysqli pdo_pgsql

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip

RUN echo 'error_reporting = E_ALL' >> /usr/local/etc/php/conf.d/99_myconf.ini
RUN echo 'date.timezone = Asia/Tokyo' >> /usr/local/etc/php/conf.d/99_myconf.ini
RUN echo 'max_input_vars = 10000' >> /usr/local/etc/php/conf.d/99_myconf.ini

RUN mkdir -p /var/www/html/logs

#Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
