# API de Gestión de Usuarios

Solución a la prueba técnica implementación de API REST.

## Tecnologías
- Laravel 11
- PHP 8.x
- MySQL

## Instalación

1. Clonar el repositorio.
2. Ejecutar `composer install`.
3. Copiar `.env.example` a `.env` y configurar las credenciales de base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4. Generar la clave de la aplicación: `php artisan key:generate`.
5. Ejecutar las migraciones: `php artisan migrate`.
6. Iniciar el servidor: `php artisan serve`.

## Endpoints Principales
- **POST** `/api/usuarios` - Registrar nuevo usuario.
- **GET** `/api/usuarios` - Listar usuarios (soporta filtro `?estado=1|0`).
- **PUT** `/api/usuarios/{id}` - Actualizar nombre y/o estado de un usuario.
- **DELETE** `/api/usuarios/{id}` - Desactiva al usuario cambiando estado a 0.

## Nota: Todas las peticiones deben incluir el header `Accept: application/json`.*