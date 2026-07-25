# ---------- Build Stage ----------
FROM node:22 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# ---------- PHP Stage ----------
FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libicu-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000