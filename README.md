# Prueba Técnica Laravel - Sistema de Clientes

Este proyecto es una aplicación web desarrollada con Laravel que implementa un sistema de gestión de clientes con paginación, búsqueda y API REST.

## Requisitos Previos

- PHP >= 8.1
- Composer
- XAMPP (u otro servidor local con MySQL)
- Git

## Instalación

1. Clonar el repositorio
```bash
git clone https://github.com/piodois/Prueba-t-cnica-Laravel.git
cd Prueba-t-cnica-Laravel
```

2. Instalar dependencias
```bash
composer install
```

3. Configurar el entorno
```bash
# Copiar el archivo de ejemplo de variables de entorno
cp .env.example .env

# Generar la clave de la aplicación
php artisan key:generate
```

4. Configurar la base de datos
- Abrir XAMPP y iniciar Apache y MySQL
- Crear una nueva base de datos en phpMyAdmin
- Editar el archivo .env con tus credenciales de base de datos:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=practica_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

6. Iniciar el servidor
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## Características

- ✅ Listado de clientes paginado
- ✅ Búsqueda por nombre, apellido y RUT
- ✅ API REST con paginación
- ✅ Interfaz responsiva
- ✅ Diseño moderno con Bootstrap 5

## Estructura del Proyecto

- `app/Http/Controllers/ClienteController.php`: Controlador principal
- `app/Http/Resources/ClienteResource.php`: Recurso para la API
- `app/Models/Cliente.php`: Modelo de datos
- `resources/views/clientes/index.blade.php`: Vista principal
- `routes/web.php`: Definición de rutas web
- `routes/api.php`: Definición de rutas API

## Endpoints

- Web: `GET /` - Vista principal con tabla de clientes
- API: `GET /api/clientes` - Retorna JSON con clientes paginados
- API: `GET /api/clientes?search=texto` - Búsqueda en la API
- API: `GET /api/clientes?page=2` - Paginación en la API

## Mantenimiento

Para limpiar el caché y reoptimizar:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.
