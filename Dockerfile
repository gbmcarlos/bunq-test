FROM php:7.0-apache

# Install Apache PHP mod and its dependencies (including Apache and PHP!)
RUN    apt-get update \
    && apt-get -yq install \
        curl \
        php5-curl \
    && rm -rf /var/lib/apt/lists/*


WORKDIR /var/www/html

# Configure Apahce
## Virtual host
ADD config/apache/main.conf /etc/apache2/sites-available/main.conf
## Apache user
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data
## Enable rewrite module
RUN a2enmod rewrite
## Enable our site
RUN a2dissite 000-default && a2ensite main
## Always reload the configuration
RUN service apache2 restart

# Run apache
ADD ./deployconfig/apache/run.sh  /run.sh
RUN chmod 777 /run.sh
CMD ["/run.sh"]
