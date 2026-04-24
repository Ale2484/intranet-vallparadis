# Vallparadis con Laravel 12, Docker y Docker Hub

Este proyecto incluye una configuración completa para ejecutar la aplicación Vallparadis con Laravel 12 y MySQL usando Docker. La solución está pensada para que cualquier usuario pueda levantar el proyecto sin instalar PHP, Composer, Node o MySQL en su máquina.

## Requisitos

- Docker
- Docker Compose

## 1. Preparar el entorno

Copiar el fichero de ejemplo:

```bash
cp .env.example .env
```

Si quieres datos de prueba, cambia esta variable en `.env`:

```dotenv
DOCKER_RUN_SEEDERS=true
```

## 2. Levantar el proyecto

Arranque completo:

```bash
docker compose up --build
```

La aplicación quedará disponible en:

```text
http://localhost:8080
```

Qué hace el arranque automáticamente:

- Inicia MySQL 8.4.
- Espera a que la base de datos esté lista.
- Genera `APP_KEY` si aún no existe.
- Ejecuta `php artisan storage:link --force`.
- Ejecuta `php artisan migrate --force` si `DOCKER_RUN_SEEDERS=false`.
- Ejecuta `php artisan migrate:fresh --seed --force` si `DOCKER_RUN_SEEDERS=true`.

## 3. Persistencia de datos

`compose.yaml` crea estos volúmenes:

- `mysql_data`: persiste la base de datos MySQL.
- `storage_data`: persiste el directorio `storage` de Laravel.

## 4. Comandos útiles

Parar los contenedores:

```bash
docker compose down
```

Parar y borrar contenedores, red y volúmenes:

```bash
docker compose down -v
```

Ver logs de la aplicación:

```bash
docker compose logs -f app
```

Entrar en el contenedor de Laravel:

```bash
docker compose exec app sh
```