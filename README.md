# VIP2CARS - Prueba Técnica Laravel

🚗 Sistema CRUD de vehículos y clientes desarrollado con **Laravel 12**, con documentación de modelado para encuestas anónimas.

## 🧰 Requisitos del Entorno
- PHP 8.2+
- Laravel 12.53.0
- MySQL
- Composer 2+

## ⚙️ Entorno Local (Windows)
- **XAMPP es opcional**. Se puede usar para levantar Apache/MySQL rapidamente en Windows.
- El proyecto tambien funciona con cualquier entorno equivalente que provea `PHP + Composer + MySQL + Node/NPM` (por ejemplo Laragon, WAMP o Docker).

## 🛠️ Tecnologías
- Laravel 12
- Eloquent ORM
- Bootstrap 5.3.3 (CDN)
- SweetAlert2
- Font Awesome

## ✨ Características
- **Buscador dinámico:** filtrado de vehículos por placa o DNI.
- **Paginación:** gestión optimizada de registros a 5 por página.
- **UX robusta:** manejo de errores con `try-catch` y alertas interactivas con SweetAlert2.

## 🗄️ Modelado de Base de Datos (Punto 1)
El material de modelado se encuentra en:

`/BBDD_script_SQL/`

Contenido de la carpeta:
- Script SQL del modelo de encuestas anónimas (`Encuestas anónimas.sql`).
- Diagrama ERD del sistema.

Descripción técnica del modelado:
El diseño permite encuestas dinámicas donde una encuesta contiene múltiples preguntas y cada pregunta múltiples opciones de respuesta (**relaciones 1:N**). Las respuestas se registran en una entidad desacoplada para no almacenar identidad del usuario, garantizando el anonimato y facilitando el análisis estadístico posterior.

## 📌 Nota Importante
- Esta entrega **NO** incluye login ni autenticación.
- No se requiere script SQL externo ya que la estructura y datos de prueba se gestionan íntegramente mediante migraciones y seeders de Laravel.

## 🚀 Guía de Instalación (Laravel 12)
1. Instalar dependencias backend:
```bash
composer install
```

2. Compilar frontend (CRÍTICO en Laravel 12):
```bash
npm install
npm run build
```

3. Crear archivo de entorno:
```bash
cp .env.example .env
```
En Windows PowerShell:
```powershell
Copy-Item .env.example .env
```

4. Configurar la base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vip2cars_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Generar clave de aplicación:
```bash
php artisan key:generate
```

6. Ejecutar migraciones y seeders:
```bash
php artisan migrate --seed
```

7. Levantar servidor de desarrollo:
```bash
php artisan serve
```

## ▶️ Uso
Acceso directo al sistema:

`http://127.0.0.1:8000/vehiculos`

## 🌱 Seeders de Prueba
- `ClientSeeder`
- `VehicleSeeder`

## 🧭 Rutas Principales
- `GET /vehiculos`
- `POST /vehiculos`
- `PUT/PATCH /vehiculos/{vehiculo}`
- `DELETE /vehiculos/{vehiculo}`
