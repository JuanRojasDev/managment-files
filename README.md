# Prueba técnica — Controlador de almacenamiento seguro

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

---

## Pruebas rápidas para el evaluator

- Subir un archivo grande para exceder cuota: ver error tipo "Error: Cuota de almacenamiento (10 MB) excedida".
- Subir un `.exe` o `.php`: ver mensaje "Error: El tipo de archivo '.exe' no está permitido".
- Subir un `.zip` con `script_malicioso.js`: el zip debe ser rechazado indicando el nombre del fichero interno conflictivo.

---

## Cómo subir el repo a GitHub (comandos)

1. Crea un repo vacío en GitHub.
2. Ejecuta en PowerShell dentro del proyecto:

```powershell
git init
git add .
git commit -m "Prueba técnica: controlador de almacenamiento seguro"
git branch -M main
git remote add origin <URL_DEL_REPO>
git push -u origin main
```

Si quieres que yo haga el push, puedo prepararlo si me proporcionas la URL remota y un token (por seguridad normalmente lo sube el autor).

---

## Video explicativo

Graba hasta 5 minutos mostrando:
1. Instalación rápida (composer install, migrate, serve).
2. Credenciales y acceso al admin.
3. Pruebas clave (cuota, extensiones prohibidas, zip).
4. Breve explicación de la arquitectura y decisiones (por ejemplo: por qué Laravel, por qué validarlo en backend, uso de ZipArchive, prioridades de cuota).

---

## Notas técnicas y recomendaciones

- En producción, añadir escaneo antivirus y subir a un almacenamiento controlado (S3 con políticas).
- Considerar límites por IP y rate limiting para proteger endpoints de subida.
- Todos los checks de seguridad se hacen en servidor; la UI es sólo una capa para mejorar UX.

---

Si quieres que haga el `git push` por ti, pásame la URL del repositorio remoto o indícame que quieres el script listo para ejecutar y lo preparo.

Saludos.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
