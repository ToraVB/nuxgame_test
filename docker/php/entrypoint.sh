#!/bin/bash
set -e

if [ ! -d "vendor" ]; then
    composer install --optimize-autoloader --no-interaction --no-dev
fi

if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
fi

exec "$@"
