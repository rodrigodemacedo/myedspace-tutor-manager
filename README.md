# Laravel Project Environment Setup

This guide will walk you through setting up the development environment for the `myedspace-tutor-manager` project using Laravel.

## 1. Initialize a Laravel 11.x Project

1. Run the command to create a new Laravel project:
    ```bash
    composer create-project --prefer-dist laravel/laravel myedspace-tutor-manager "11.*"
    cd myedspace-tutor-manager
    ```

2. Check if PHP 8.3 is installed:
    ```bash
    php -v
    ```
   - If necessary, adjust your local environment configuration to use PHP 8.3.

## 2. Configure the Database

1. Create a MySQL database for the project:
    ```bash
    mysql -u root -p
    CREATE DATABASE myedspace_tutor_manager;
    ```

2. In the `.env` file, configure the database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=myedspace_tutor_manager
    DB_USERNAME=yourUsername
    DB_PASSWORD=yourPassword
    ```

3. Generate the application key:
    ```bash
    php artisan key:generate
    ```

4. Run the migrations, as after configuring MySQL and providing an empty database, it will be necessary to recreate the tables:
    ```bash
    php artisan migrate
    ```

## 3. Install Filament 3.x

1. Install Filament:
    ```bash
    composer require filament/filament:"^3.0"
    ```

2. Publish Filament's configuration files and assets:
    ```bash
    php artisan filament:install
    ```

## 4. Install Tailwind CSS 3.x

1. Install Node.js dependencies, including Tailwind CSS:
    ```bash
    npm install
    npm install tailwindcss postcss autoprefixer --save-dev
    ```

2. Initialize Tailwind CSS and configure the `tailwind.config.js` file:
    ```bash
    npx tailwindcss init
    ```

   - Edit the `tailwind.config.js`:
     ```javascript
     module.exports = {
         content: [
             './resources/**/*.blade.php',
             './resources/**/*.js',
             './resources/**/*.vue',
         ],
         theme: {
             extend: {},
         },
         plugins: [],
     }
     ```

3. Create the `resources/css/app.css` file and add Tailwind directives:
    ```css
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    ```

4. Update the `vite.config.js` file to process the CSS:
    ```javascript
    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';

    export default defineConfig({
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
    });
    ```

5. Compile the assets:
    ```bash
    npm run dev
    ```

## 5. Configure Laravel Pint for Code Styling

1. Install Laravel Pint:
    ```bash
    composer require laravel/pint --dev
    ```

2. Run Pint to ensure the code follows PSR-12 standards:
    ```bash
    ./vendor/bin/pint
    ```









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
