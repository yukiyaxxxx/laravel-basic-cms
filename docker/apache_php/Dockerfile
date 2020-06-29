ARG php_version
FROM php:${php_version}-apache

RUN apt-get update

#RUN docker-php-ext-install mysqli pdo_mysql mbstring
RUN docker-php-ext-install mysqli pdo_mysql

#RUN apt-get update
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN apt-get install -y vim

#composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# RUN apt-get -y install chromium libgconf-2-4

#imagick
RUN apt-get update && apt-get install -y libmagickwand-dev
RUN pecl install imagick-3.4.3
RUN docker-php-ext-enable imagick


#gd
RUN apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxpm-dev
#     \
#    libwebp-dev
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/lib/x86_64-linux-gnu/ \
    --with-jpeg=/usr/lib/x86_64-linux-gnu/ \
    --with-xpm=/usr/lib/x86_64-linux-gnu/
#     \
#    --with-webp-dir=/usr/lib/x86_64-linux-gnu/
RUN docker-php-ext-install gd

#RUN docker-php-ext-install libonig-dev


## apahce run user
# RUN usermod -u 1000 www-data
# RUN groupmod -g 1000 www-data


##cron
#RUN apt-get install -y cron
## laravel schedule
#RUN echo "* * * * * root /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1" >> /etc/cron.d/mycron

RUN apt-get install -y ssh
RUN apt-get install -y rsync
RUN apt-get install -y unzip

# php Speeding up
RUN docker-php-ext-install opcache

#composer speed up
RUN composer config -g repos.packagist composer https://packagist.jp
RUN composer global require hirak/prestissimo

RUN apt-get install -y libonig-dev
RUN docker-php-ext-install mbstring

#php.ini
RUN echo 'memory_limit = -1' >> /usr/local/etc/php/php.ini

#document root
ARG document_root
#ENV APACHE_DOCUMENT_ROOT /var/www
ENV APACHE_DOCUMENT_ROOT ${document_root}
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#WORKDIR ${APACHE_DOCUMENT_ROOT}
WORKDIR /var/www/html

RUN a2enmod rewrite
RUN /etc/init.d/apache2 restart

