<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### How to run this project

1. Install the dependencies from Laravel

```
composer install
```

2. Generate the APP_KEY

```
php artisan key:generate
```

3. Run the Migration

```
php artisan migrate:fresh
```

4. Run the project using 2 ports, 8000 for the API and 9000 for the Front End

```
php artisan serve --port=8000
php artisan serve --port=9000
```

5. Make 1 account first by login into the Web App

6. Run the Seeder

```
php artisan db:seed --class=CompanySeeder
php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=ProjectRoleSeeder
php artisan db:seed --class=RefferenceSeeder
php artisan db:seed --class=ApplicationSeeder
```
