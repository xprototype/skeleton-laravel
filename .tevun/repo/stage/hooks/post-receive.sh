#!/usr/bin/env bash

DIR_NAME=$(dirname $(readlink -f ${0}))
BASE=$(dirname $(readlink -f "${DIR_NAME}/../.."))
DOMAIN="stage"
APP=${BASE}/${DOMAIN}/app
BRANCH="master"

cd ${APP}

# hook pre-checkout
if [[ -f .tevun/hooks/pre-checkout.sh ]]; then
  sh .tevun/hooks/pre-checkout.sh ${APP} ${DOMAIN}
fi

# hook setup
if [[ -f .tevun/hooks/setup.sh ]]; then
  READY=$(echo ${DOMAIN} | md5sum)
  if [[ ! -f .${READY} ]]; then
    sh .tevun/hooks/setup.sh ${APP} ${DOMAIN}
  fi
  touch ".${READY}"
fi

cd $(dirname ${DIR_NAME})

GIT_WORK_TREE="${APP}" git checkout -f ${BRANCH}

# hook post-checkout
cd ${APP}
if [[ -f .tevun/hooks/post-checkout.sh ]]; then
  sh .tevun/hooks/post-checkout.sh ${APP} ${DOMAIN}
fi

# hook install
if [[ -f .tevun/hooks/install.sh ]]; then
  sh .tevun/hooks/install.sh ${APP} ${DOMAIN}
fi
