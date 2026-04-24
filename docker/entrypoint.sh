#!/bin/sh
set -eu

# Ejecuta siempre desde la raíz del proyecto Laravel dentro del contenedor.
cd /var/www/html

# Crea directorios necesarios y deja permisos válidos para escritura.
mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# Si no existe .env, usa la configuración de ejemplo incluida en la imagen.
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Genera la clave de Laravel solo la primera vez.
if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force --no-interaction
fi

# Crea el enlace public/storage para servir archivos subidos.
php artisan storage:link --force --no-interaction

# Espera a que MySQL acepte conexiones antes de lanzar migraciones.
echo "Waiting for MySQL..."
until php -r '
    $host = getenv("DB_HOST") ?: "db";
    $port = getenv("DB_PORT") ?: "3306";
    $database = getenv("DB_DATABASE") ?: "vallparadis";
    $username = getenv("DB_USERNAME") ?: "vallparadis";
    $password = getenv("DB_PASSWORD") ?: "secret";

    try {
        new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);
        exit(0);
    } catch (Throwable $exception) {
        exit(1);
    }
'; do
    sleep 2
done

# Con seeders activos se recrea la base de datos; si no, solo aplica migraciones pendientes.
if [ "${RUN_SEEDERS:-false}" = "true" ]; then
    php artisan migrate:fresh --seed --force --no-interaction
else
    php artisan migrate --force --no-interaction
fi

# Ejecuta el comando principal del contenedor.
exec "$@"
