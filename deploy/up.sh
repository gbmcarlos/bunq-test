#!/usr/bin/env bash

echo ">>>> Building"
docker build -t chat_app:latest ./deploy

echo ">>>> Running"

cd www && composer install --prefer-dist --no-interaction --ignore-platform-reqs && cd ..
docker rm -f chat_app || true

docker run --name chat_app -e APP_ENV=$1 -e SQLITEDB_FILE=$SQLITEDB_FILE -d -p $2:80 -v $PWD/www:/var/www/html chat_app:latest
