FROM php:7.0-apache

# Install Apache PHP mod and its dependencies (including Apache and PHP!)
RUN    apt-get update \
    && apt-get -yq install \
        libapache2-mod-macro \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

# Copy composer json and lock
COPY ./www/composer.json /var/www/html/www/composer.json
COPY ./www/composer.lock /var/www/html/www/composer.json

# Now install the dependences
RUN composer install --no-scripts --no-autoloader --working-dir=/var/www/html/www

# Now copy de application's source code
COPY ./www /var/www/html

# And now dump the autoload
RUN composer dump-autoload --optimize

WORKDIR /var/www/html

# Configure Apahce
## Virtual host
#ADD ./deploy/config/apache/vhost.macro /etc/apache2/conf.d/vhost.macro
ADD ./config/apache/main.conf /etc/apache2/sites-available/main.conf

## Enable rewrite module
RUN a2enmod rewrite macro
## Enable our site
RUN a2dissite 000-default && a2ensite main

RUN sed -i 's/^Listen 80/#Listen80/' /etc/apache2/ports.conf
#RUN service apache2 restart

# Run apache
ADD ./config/apache/run.sh  /run.sh
RUN chmod 777 /run.sh
USER www-data
CMD ["/run.sh"]
