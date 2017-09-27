#!/usr/bin/env bash

echo ">>>> Building"
docker build -t chat_app:latest ./deploy

echo ">>>> Running"

cd www && composer install --prefer-dist --no-interaction --ignore-platform-reqs && cd ..
docker rm -f chat_app || true
g
if [[ $1 == local ]]; then
    docker run --name chat_app -e APP_ENV=local -e DB_HOST=127.0.0.1 DB_USER=user DB_PASSWORD=password -d -p $1:80 -v $PWD/www:/var/www/html chat_app:latest
else
    docker run --name chat_app -e APP_ENV=$1 -e DB_HOST=$DB_HOST DB_USER=$DB_USER DB_PASSWORD=password -d -p $1:80 -v $PWD/www:/var/www/html chat_app:latest
fi
