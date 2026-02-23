# Landing Page Editable con PHP y SQLite

Esta landing page ahora es editable a través de un panel de administración simple. El contenido se almacena en una base de datos SQLite y se carga dinámicamente.

## Archivos principales

- `index.php`: Página pública que carga contenido desde BD.
- `admin.php`: Panel de administración con login y formulario de edición.
- `db.php`: Helper para conectar a la BD.
- `init_db.php`: Script para crear la BD y sembrar contenido inicial.
- `data/content.db`: Base de datos SQLite (creada automáticamente).
- `uploads/`: Carpeta para imágenes/videos subidos.

## Configuración inicial

1. Ejecutar el script de inicialización:
   ```bash
   php init_db.php
   ```

2. Iniciar servidor local:
   ```bash
   php -S localhost:8000
   ```

3. Acceder a la página: http://localhost:8000/index.php

4. Acceder al admin: http://localhost:8000/admin.php
   - Usuario: admin
   - Contraseña: password (cambiar en `admin.php`)

## Estructura de la BD

Tabla `content`:
- `id`: INTEGER PRIMARY KEY
- `section`: TEXT (ej: hero, why, footer)
- `key`: TEXT (ej: title, text, image)
- `value`: TEXT (contenido)

## Edición

- En `admin.php`, editar textos e imágenes.
- Para imágenes/videos: subir archivos que se guardan en `uploads/` y se referencia la ruta en BD.
- Cambios se guardan inmediatamente en BD.

## Seguridad

- Login simple con session.
- Cambiar credenciales en `admin.php`.
- .htaccess restringe acceso remoto a admin.php (solo local).

## Notas

- No se edita diseño/CSS, solo contenido.
- Para producción: cambiar credenciales, añadir HTTPS, backups de BD.
- Si necesitas más campos, editar `init_db.php` y `admin.php`.