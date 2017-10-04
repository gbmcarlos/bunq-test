#!/usr/bin/env bash

echo ">>>> Moving to $(dirname "$0")"
cd "$(dirname "$0")"

echo ">>>> Building docker image"
docker build -t chat_app:latest $PWD/..

echo ">>>> Installing dependencies"
composer install --prefer-dist --no-interaction --ignore-platform-reqs --working-dir=$PWD/..

echo ">>>> Removing old container"
docker rm -f chat_app || true

echo ">>>> Running new container"
docker run --name chat_app -e APP_ENV=local -e SQLITEDB_FILE=/var/www/html/phpsqlte.db -e APP_DEBUG=TRUE -d -p $2:80 -v $PWD/../www:/var/www/html chat_app:latest

echo ">>>> Tailing logs"