<img width="1905" height="884" alt="image" src="https://github.com/user-attachments/assets/befb49ed-ba55-47d2-a1c5-7cc2f819d8de" /><img width="1892" height="914" alt="image" src="https://github.com/user-attachments/assets/6ede3822-e679-42bc-9726-c82171556e42" /># Prueba técnica — Controlador de almacenamiento seguro

Este repositorio contiene una implementación de ejemplo para la prueba técnica: una mini-aplicación de gestión de archivos con reglas de seguridad (cuotas, extensiones prohibidas, análisis de ZIP) implementada sobre Laravel + Livewire + TailwindCSS.

## Objetivo

Desarrollar un controlador/servicio de subida y un panel de administración que permitan aplicar reglas de negocio sobre el almacenamiento: cuotas por usuario/grupo/global, lista de extensiones prohibidas y escaneo de archivos .zip antes de aceptar la subida.

---

## Instalación (Windows / PowerShell)

1. Clona el repositorio y entra a la carpeta:

```powershell
git clone <URL_DEL_REPO>
cd <repo>
```

2. Instala dependencias PHP:

```powershell
composer install
```

3. Configura `.env` y la base de datos (desarrollo con sqlite recomendado):

```powershell
copy .env.example .env
New-Item -ItemType File -Path .\database\database.sqlite -Force
# En .env: setear DB_CONNECTION=sqlite y DB_DATABASE="D:/ruta/absoluta/a/database/database.sqlite"
```

4. Genera APP_KEY, ejecuta migraciones y seeders:

```powershell
php artisan key:generate
php artisan migrate --seed
```

5. Enlaza storage si corresponde:

```powershell
php artisan storage:link
```

6. Arranca el servidor local:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

> Nota: si tu ruta contiene espacios (ej. "Juan Rojas"), asegura que `DB_DATABASE` en `.env` esté entre comillas.

---

## Credenciales de ejemplo

- Administrador: `admin@example.com` / `Password123!`
- Usuario normal: `user@example.com` / `Password123!`

(Ver `database/seeders/DatabaseSeeder.php` para confirmar o regenerar credenciales.)

---

## Funcionalidades implementadas

1. Roles y grupos
   - `role` en users (`usuario`, `admin`).
   - `Group` model y relación `group_id` en `users`.

2. Interfaz
   - Panel de usuario: ver archivos y subir nuevos.
   - Panel de admin: gestionar usuarios, grupos y configuración (límites y extensiones prohibidas).

3. Lógica de subida
   - Comprobación de cuota: el backend calcula `uso_actual + tamaño_nuevo` y compara con la cuota asignada (prioridad: usuario > grupo > global).
   - Restricción de extensiones: lista configurable de extensiones prohibidas; rechazadas en backend.
   - Escaneo de `.zip`: si el archivo subido es `.zip`, se itera su contenido con `ZipArchive` y se rechaza si cualquier archivo interno tiene una extensión prohibida.
   - Todas las validaciones de seguridad se ejecutan en PHP; el frontend usa `fetch`/Livewire para subir sin recargar.

## Capturas de la Aplicacion

<img width="1901" height="900" alt="image" src="https://github.com/user-attachments/assets/b9c47364-04ad-47d9-8304-d9c5b7560b7e" />
<img width="1892" height="914" alt="image" src="https://github.com/user-attachments/assets/523e986d-f457-4788-9a8b-7262cb72a8bc" />
<img width="1899" height="911" alt="image" src="https://github.com/user-attachments/assets/754a1e4c-d64d-49d2-a0ef-720a091b02e4" />
<img width="1905" height="884" alt="image" src="https://github.com/user-attachments/assets/54bfcff5-f1cc-49fc-a4bc-0e3a21dd1c87" />
<img width="1903" height="870" alt="image" src="https://github.com/user-attachments/assets/b9f9f68c-04e8-4c04-9796-5b69298d1451" />

---

## Notas técnicas y recomendaciones

- En producción, añadir escaneo antivirus y subir a un almacenamiento controlado (S3 con políticas).
- Considerar límites por IP y rate limiting para proteger endpoints de subida.
- Todos los checks de seguridad se hacen en servidor; la UI es sólo una capa para mejorar UX.

---
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
