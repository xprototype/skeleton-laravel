#!/usr/bin/env bash

cd ${1}

echo " ~> [hooks\pre-checkout.sh] on [${1}, ${2}]"

if [[ $(docker ps -q -f name=xprototype-api) ]]; then
  docker-compose down
fi

rm -rf app/ database/ public/ resources/ routes/
