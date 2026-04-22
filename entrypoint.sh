#!/bin/bash

echo "Esperando a MySQL..."
while ! nc -z db 3306; do
    sleep 1
done
echo "MySQL listo!"

cd /var/www/html

if [ ! -d "vendor" ]; then
    echo "Instalando Composer..."
    composer install --no-interaction --no-progress
fi

if [ ! -f ".env" ]; then
    echo "Copiando .env.example a .env..."
    cp .env.example .env
fi

php artisan key:generate --no-interaction
php artisan migrate:fresh --seed

apache2-foreground