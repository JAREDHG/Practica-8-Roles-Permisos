# Práctica 08: Roles y Permisos (RBAC)

Práctica enfocada en la implementación de un sistema de control de acceso basado en roles (RBAC) y permisos granulares, garantizando la seguridad mediante una arquitectura de tres capas: Frontend, Backend y API.

## Descripción del Proyecto
Agregarás un campo rol al modelo User (admin, editor, cliente). Los admins pueden todo: crear, editar y eliminar. Los editores pueden crear y editar pero no eliminar. Los clientes solo pueden ver. El frontend refleja estos permisos dinámicamente en la UI.

## Tecnologías Utilizadas

### Backend
- **Laravel Gates:** Definición de reglas de autorización centralizadas en el AppServiceProvider.
- **Laravel Policies:** Implementación de políticas de autorización vinculadas a modelos (ProductoPolicy) para blindar el controlador.
- **Sanctum & API:** Expansión del endpoint /api/me para retornar un mapa de permisos en tiempo real al frontend.

### Frontend
- **Vue 3 Directives:** Creación de una directiva personalizada v-can para el filtrado dinámico de elementos de UI según el rol.
- **Pinia State Management:** Gestión centralizada del estado de autenticación y persistencia de permisos del usuario.
- **Vue Router:** Implementación de Guardias Globales para proteger rutas administrativas basadas en roles.

## Características Implementadas
- **Control de Acceso (RBAC):** Definición de permisos específicos (Crear, Editar, Eliminar) asignados a cada rol .  
- **Seguridad en Capas:** Protección redundante entre la interfaz (ocultamiento de botones) y el servidor (validación 403 vía Policies).  
- **Interfaz Adaptativa (v-can):** Directiva reactiva que oculta botones de administración para usuarios sin privilegios .  
- **Sincronización de Sesión:** Carga automática de permisos tras el login para una experiencia de usuario fluida.  
- **Validación de Backend:** Protección de endpoints mediante $this->authorize() para evitar manipulaciones externas . 

## Instrucciones de Instalación

### Backend (Laravel)
```bash
# Migración de roles
php artisan make:migration add_rol_to_users_table
php artisan migrate

# Configuración de políticas y gates en AppServiceProvider y ProductoPolicy
php artisan make:policy ProductoPolicy --model=Producto
php artisan serve
```

## Frontend (Vue.js)
```bash
# Instalación de directivas personalizadas y registro en main.js
npm install
npm run dev
```

**Desarrollado por:** Jared Hernández González - Universidad Politécnica de Texcoco (UPTex) 