<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## Simplecom - Ecommerce

Before to start, It's important for you already have installed Docker or Docker desktop in your machine. Then later, you must to request the corresponding API Keys and Credentials of the project for use the AWS resources if it's needed.

## Installation and setup

- Clone the project. If you want to cloning using SSH and you use WSL, remember to [copy and share the ssh keys between your host and WSL](https://devblogs.microsoft.com/commandline/sharing-ssh-keys-between-windows-and-wsl-2/)
- Copy the .env.example file as .env <br>
``` cp .env.example .env ```
- Run the [temporal docker container](https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects) for install the composer dependencies, including the sail binaries <br>
``` 
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs 
```
- Create the Application Key with artisan
```
    ./vendor/bin/sail artisan key:generate
```
- Add "mysql" as database host (DB_HOST=mysql) <br>
- Run the application containers with sail
```
    ./vendor/bin/sail up -d
```
- Run the application migrations and seeders
```
    ./vendor/bin/sail artisan migrate --seed
```
- Install and run the assets compiler
```
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
```
- Enjoy developing 😎