#!/usr/bin/env bash

cd ${1}

echo " ~> [hooks\post-checkout.sh] on [${1}, ${2}]"

cp .env.stage .env
cp docker-compose.yml.stage docker-compose.yml

if [[ -f docker-compose.yml ]]; then
  docker-compose rm -f
  docker-compose up -d
fi
