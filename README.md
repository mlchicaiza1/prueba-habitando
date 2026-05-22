# FakeStore Project

Este es un proyecto construido siguiendo los principios de **Clean Architecture** para consumir la API pública de [FakeStore](https://fakestoreapi.com/).

La entidad de Productos se gestiona puramente en memoria consumiendo la API externa, utilizando Data Transfer Objects (DTOs) en lugar de modelos tradicionales de base de datos. Se implementaron mecanismos de caché para optimizar el rendimiento y evitar el límite de peticiones (rate limits) de la API externa.

## Tecnologías Utilizadas

- **Backend:** Laravel 12
- **Arquitectura:** Clean Architecture (Capas: Domain, Application, Infrastructure, Presentation)
- **Frontend:** Vue 3 + InertiaJS
- **Estilos:** Tailwind CSS
- **Manejo de Datos:** `spatie/laravel-data` para tipado estricto de DTOs.
- **Base de datos (Sesiones/Usuarios):** SQLite (Solo para Autenticación)

## Características

- 🛒 Listado interactivo de productos simulados.
- 🔍 Búsqueda en tiempo real por nombre o descripción.
- 🏷️ Filtrado por categoría.
- 💰 Ordenamiento por precio.
- ➕ Simulación de creación de productos (POST).
- 🔐 Autenticación de usuarios obligatoria para acceder a las rutas de productos.

## Autenticación
**Sí**, se requiere estar autenticado para acceder al panel de productos. Al tratarse de un entorno de prueba local con SQLite, puedes crear cualquier cuenta de usuario a través del enlace de `Register` o iniciar sesión desde `Log in`.

## URLs Importantes

| Recurso | URL |
|---|---|
| **Inicio** | `http://localhost:8000/` |
| **Login** | `http://localhost:8000/login` |
| **Registro** | `http://localhost:8000/register` |
| **Catálogo Productos** | `http://localhost:8000/products` |

## Despliegue Local

Para levantar este proyecto en tu máquina local sin usar Docker, sigue estos pasos:

1. **Clonar e instalar dependencias:**
   ```bash
   composer install
   npm install
   ```

2. **Configurar el entorno:**
   Copia el archivo de configuración si no existe:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Preparar la base de datos (para Autenticación):**
   Asegúrate de que la base de datos SQLite esté creada y corre las migraciones:
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

4. **Levantar los servidores:**
   Necesitarás dos terminales.
   
   En la primera, levanta el backend de Laravel:
   ```bash
   php artisan serve
   ```
   
   En la segunda, levanta el compilador de assets (Vite):
   ```bash
   npm run dev
   ```

5. **Acceder:**
   Abre tu navegador en `http://localhost:8000/register`, crea una cuenta y navega hacia la opción "Productos" en el menú principal.
