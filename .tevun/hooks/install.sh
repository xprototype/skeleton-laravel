#!/usr/bin/env bash

cd ${1}

echo " ~> [hooks\install.sh] on [${1}, ${2}]"

docker exec xprototype-api composer install\
 --no-ansi --no-dev --no-interaction\
 --optimize-autoloader
# --no-progress --no-scripts

if [[ ! -f .installed ]]; then
    docker exec xprototype-api php artisan key:generate
    touch .installed
fi

docker exec xprototype-api php artisan migrate --force
