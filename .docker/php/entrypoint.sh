#!/bin/sh
set -eux

if [ -d /ssh-host ]; then
  mkdir -p /root/.ssh
  cp -a /ssh-host/. /root/.ssh
  chown -R root:root /root/.ssh
  chmod 700 /root/.ssh
  find /root/.ssh -type f -exec chmod 600 {} +
fi

git config --global --add safe.directory /srv

chmod -R 777 var/ public/

exec docker-php-entrypoint "$@"
