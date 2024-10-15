#!/bin/sh

set -e

chmod +x bin/console

composer self-update

if [ ! -d vendor ]; then
    composer install
fi


exec "$@"
