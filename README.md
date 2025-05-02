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

<!-- Este parte es de prueba falata hacer commit-->
<p align="center"><a href="https://www.fusertech.com.pe/" target="_blank"><img src="https://fusertech.com.pe/fusertech/img/Logo_original.png" width="400" alt="FuserTech Internet Logo"></a></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Build-Passing-brightgreen" alt="Build Status"></a>
<a href="#"><img src="https://img.shields.io/badge/License-MIT-blue" alt="License"></a>
</p>

## Acerca de FuserTech Internet

**FuserTech Internet** es una plataforma diseñada para ofrecer soluciones innovadoras en el ámbito de la conectividad y servicios de internet. Nuestro objetivo es proporcionar herramientas eficientes y accesibles para gestionar y optimizar redes de manera sencilla.

### Características principales

- Gestión avanzada de usuarios y planes de internet.
- Monitoreo en tiempo real del uso de ancho de banda.
- Integración con sistemas de facturación automatizada.
- Panel de administración intuitivo y fácil de usar.
- Soporte para múltiples idiomas y personalización.

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local (XAMPP):

1. Clona este repositorio:
   ```bash
   git clone https://github.com/tu-usuario/fusertechinternet.git

2. Instala las dependencias:
    ``` bash
    composer install
    npm install

3. configura el archivo .env:
    ```bash
    cp .env.example .env
    php artisan key:generate

4. Configura la base de datos en el archivo `.env` y ejecuta las migraciones:
    ```bash
    php artisan migrate --seed

5. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve