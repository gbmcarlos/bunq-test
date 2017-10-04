#!/usr/bin/env bash

# Always reload the configuration
#service apache2 restart

touch /var/log/apache2/app.log
chmod 777 /var/log/apache2/app.log

tail -F /var/log/apache2/app.log &
exec apache2ctl -D FOREGROUND