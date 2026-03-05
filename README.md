# VIP2CARS - Prueba Tecnica Laravel

Proyecto CRUD de vehiculos y clientes desarrollado en Laravel.

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

## Importante
- Esta entrega NO incluye login ni autenticacion.
- No se requiere script SQL externo ya que la estructura y datos de prueba se gestionan íntegramente mediante migraciones y seeders de Laravel.

## Instalacion
1. Instalar dependencias:
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

4. Generar clave de aplicacion:
```bash
php artisan key:generate
```

5. Ejecutar migraciones y seeders:
```bash
php artisan migrate --seed
```

## Uso
- Levantar servidor:
```bash
php artisan serve
```
- Acceder directamente a:
```text
http://127.0.0.1:8000/vehiculos
```

## Seeders de Prueba
- `ClientSeeder`
- `VehicleSeeder`

## Rutas principales
- `GET /vehiculos`
- `POST /vehiculos`
- `PUT/PATCH /vehiculos/{vehiculo}`
- `DELETE /vehiculos/{vehiculo}`
