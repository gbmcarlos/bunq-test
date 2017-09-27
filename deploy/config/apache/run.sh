#!/usr/bin/env bash

echo "ServerName chat" >> /etc/apache2/apache2.conf

#service apache2 restart

touch /var/log/apache2/app.log
chmod +x /var/log/apache2/app.log

tail -F /var/log/apache2/app.log &
exec apache2ctl -D FOREGROUND