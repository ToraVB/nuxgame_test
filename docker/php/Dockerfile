FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    zip unzip libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000
ARG GROUP_ID=1000
RUN addgroup --gid ${GROUP_ID} laravel && \
    adduser --uid ${USER_ID} --gid ${GROUP_ID} --disabled-password --gecos "" laravel && \
    usermod -aG www-data laravel

WORKDIR /var/www

COPY --chown=${USER_ID}:${GROUP_ID} . .

USER laravel
