#!/bin/bash
set -e

# Проверка и установка зависимостей Composer
if [ ! -d "vendor" ]; then
    composer install --optimize-autoloader --no-interaction --no-dev
fi

# Генерация .env файла, если его нет
if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
fi

exec "$@"
