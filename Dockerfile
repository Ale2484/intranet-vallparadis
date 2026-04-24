# Compila los assets de Vite para no depender de Node
FROM node:20-bookworm-slim AS frontend-builder

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build

# Imagen final con PHP, Composer y las extensiones necesarias para Laravel
FROM php:8.3-cli-bookworm

ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /var/www/html

# Instala extensiones de PHP necesarias para Laravel y las librerías usadas
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        zip \
        curl \
        libicu-dev \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        intl \
        pdo_mysql \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependencias PHP antes de copiar todo el proyecto para aprovechar mejor la caché.
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-ansi \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

COPY . .

# Ajusta permisos y prepara directorios que Laravel necesita en tiempo de ejecución.
RUN composer dump-autoload --optimize --no-dev \
    && mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

# Copia los assets compilados y el script de arranque del contenedor.
COPY --from=frontend-builder /app/public/build /var/www/html/public/build
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
