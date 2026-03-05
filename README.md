# VIP2CARS - Prueba Tecnica Laravel

Sistema CRUD de vehiculos y clientes desarrollado con Laravel 12.

## Requisitos del Entorno
- PHP 8.2+
- Laravel 12.53.0
- MySQL
- Composer 2+

## Tecnologias
- Laravel 12
- Eloquent ORM
- Bootstrap 5.3.3 (CDN)
- SweetAlert2
- Font Awesome

## Modelado de Base de Datos (Punto 1)
El modelado de la base de datos de encuestas anonimas y el diagrama ERD se encuentran en la carpeta:

`/BBDD_script_SQL/`

Contenido esperado en esa carpeta:
- Script SQL del modelo de encuestas.
- Diagrama ERD.

## Nota importante
- Esta entrega NO incluye login ni autenticacion.
- No se requiere script SQL externo ya que la estructura y datos de prueba se gestionan íntegramente mediante migraciones y seeders de Laravel.

## Guia de Instalacion (Laravel 12)
1. Instalar dependencias del proyecto:
```bash
composer install
```

2. Crear archivo de entorno:
```bash
cp .env.example .env
```
En Windows PowerShell:
```powershell
Copy-Item .env.example .env
```

3. Configurar base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vip2cars_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Generar APP_KEY:
```bash
php artisan key:generate
```

5. Ejecutar migraciones y seeders:
```bash
php artisan migrate --seed
```

6. Levantar servidor de desarrollo:
```bash
php artisan serve
```

## Uso
Acceso directo al sistema:

`http://127.0.0.1:8000/vehiculos`

## Seeders de Prueba
- `ClientSeeder`
- `VehicleSeeder`

## Rutas principales
- `GET /vehiculos`
- `POST /vehiculos`
- `PUT/PATCH /vehiculos/{vehiculo}`
- `DELETE /vehiculos/{vehiculo}`
