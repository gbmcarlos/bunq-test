FROM php:7.0-apache

# Install Apache PHP mod and its dependencies (including Apache and PHP!)
RUN    apt-get update \
    && apt-get -yq install \
        curl \
        php5-curl \
        libapache2-mod-macro \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Configure Apahce
## Virtual host
#ADD ./deploy/config/apache/vhost.macro /etc/apache2/conf.d/vhost.macro
ADD ./deploy/config/apache/main.conf /etc/apache2/sites-available/main.conf

## Enable rewrite module
RUN a2enmod rewrite macro
## Enable our site
RUN a2dissite 000-default && a2ensite main

RUN sed -i 's/^Listen 80/#Listen80/' /etc/apache2/ports.conf
#RUN service apache2 restart

# Run apache
ADD ./deploy/config/apache/run.sh  /run.sh
RUN chmod 777 /run.sh
USER www-data
CMD ["/run.sh"]
