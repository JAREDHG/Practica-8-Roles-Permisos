# Práctica 06: Relaciones Eloquent

Práctica enfocada en la implementación de una arquitectura escalable para la gestión de catálogos mediante paginación del lado del servidor y filtrado avanzado de productos. 

## Descripción del Proyecto
El catálogo de productos debe soportar miles de registros. Implementarás paginación en Laravel (15 items por página), búsqueda por nombre, filtro por categoría y rango de precio. Los filtros activos se reflejarán en la URL como query params (?busqueda=camisa&categoria=2&pagina=3).

## Tecnologías Utilizadas

### Backend
- **Laravel 10:** Implementación de Query Scopes para consultas dinámicas y reutilizables.
- **Paginación del lado del servidor:** Optimización mediante paginate() para un manejo eficiente de miles de registros.
- **API Resources:** Respuesta estructurada con metadatos de paginación (meta).

### Frontend
- **Vue 3 (Vite):** Implementación de Composables para la gestión de estado de filtros.
- **Vue Router:** Sincronización bidireccional entre la interfaz y los parámetros de la URL.
- **Debounce:** Optimización de peticiones en la búsqueda por texto.

## Características Implementadas
- **Query Scopes:** Lógica de filtrado modularizada en el modelo Producto.
- **Filtros Avanzados:** Búsqueda por nombre (LIKE), filtro por categoría, y rangos de precio (min/max).
- **URL Dinámica:** Sincronización automática de filtros y número de página con los parámetros de la URL.
- **Paginación Nav:** Componente reutilizable para la navegación entre páginas con metadatos de Laravel.
- **Filtros Panel:** Panel lateral intuitivo con controles reactivos y botón de limpieza de estados.
- **Sincronización:** Uso de Watchers para disparar peticiones a la API solo cuando los filtros o la URL cambian.

## Instrucciones de Instalación

### Backend (Laravel)
```bash
composer install
cp .env.example .env
# Configura DB_DATABASE en .env
php artisan migrate:fresh --seed --seeder=CategoriaProductoSeeder
php artisan storage:link
php artisan serve
```

## Frontend (Vue.js)
```bash
npm install
npm run dev
```

**Desarrollado por:** Jared Hernández González - Universidad Politécnica de Texcoco (UPTex) 