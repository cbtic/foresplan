## Laravel Boilerplate (Current: Laravel 8.*) ([Demo](https://demo.laravel-boilerplate.com))

[![Latest Stable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/stable)](https://packagist.org/packages/rappasoft/laravel-boilerplate)
[![Latest Unstable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/unstable)](https://packagist.org/packages/rappasoft/laravel-boilerplate)
<br/>
[![StyleCI](https://styleci.io/repos/30171828/shield?style=plastic)](https://github.styleci.io/repos/30171828)
![Tests](https://github.com/rappasoft/laravel-boilerplate/workflows/Tests/badge.svg?branch=master)
<br/>
![GitHub contributors](https://img.shields.io/github/contributors/rappasoft/laravel-boilerplate.svg)
![GitHub stars](https://img.shields.io/github/stars/rappasoft/laravel-boilerplate.svg?style=social)

### Demo Credentials

**Admin:** admin@admin.com
**Password:** secret

**User:** user@user.com
**Password:** secret

### Docker steps

```console
docker-compose build app
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan storage:link
docker-compose exec app yarn
docker-compose exec app npm run dev
docker-compose exec app php artisan serve --host=0.0.0.0

# Si algo falla probar con:
docker-compose exec app php artisan clear-compiled
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan config:clear

docker-compose exec app composer dumpautoload -o
```

URL: http://localhost:8080/

### Laravel Generators

php artisan make:controller Frontend/EmpresaController --model=Empresa --resource

### Python Generators (Python 3 y pip3)

* Requisito: Instalar Python3
pip install virtualenv
python -m venv env
source env/Scripts/activate
pip install -r ./requirements.txt

* Si tienen python 2 y 3 solo usar 3l 3
pip3 install virtualenv
python3 -m venv env
source env/bin/activate
pip3 install -r ./requirements.txt

* Si es necesario instalar una nueva libreria de python usar:

pip install python-dotenv && pip freeze > requirements.txt

* Para usar el generador:

python generators/template_generator.py nombre_de_la_tabla

* Para salir del entorno de python usar:

deactivate

* Finalmente copiar los archivos a sus respectivos directorios:

Archivos blade a resources/views/livewire
Archivos php class a app/Http/livewire/Frontend o Backend

* TABLAS LIVEWIRE: https://rappasoft.com/docs/laravel-livewire-tables/v2/introduction

### Official Documentation

[Click here for the official documentation](http://laravel-boilerplate.com)

### Slack Channel

Please join us in our Slack channel to get faster responses to your questions. Get your invite here: https://laravel-5-boilerplate.herokuapp.com

### Introduction

Laravel Boilerplate provides you with a massive head start on any size web application. Out of the box it has features like a backend built on CoreUI with Spatie/Permission authorization. It has a frontend scaffold built on Bootstrap 4. Other features such as Two Factor Authentication, User/Role management, searchable/sortable tables built on my [Laravel Livewire tables plugin](https://github.com/rappasoft/laravel-livewire-tables), user impersonation, timezone support, multi-lingual support with 20+ built in languages, demo mode, and much more.

### Issues

If you come across any issues please [report them here](https://github.com/rappasoft/laravel-boilerplate/issues).

### Contributing

Thank you for considering contributing to the Laravel Boilerplate project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future to Anthony Rappa at rappa819@gmail.com.

### Security Vulnerabilities

If you discover a security vulnerability within this boilerplate, please send an e-mail to Anthony Rappa at rappa819@gmail.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

### License

MIT: [http://anthony.mit-license.org](http://anthony.mit-license.org)


### Troubleshooting & FAQ

## Yarn:
# Si tienes problemas de incompatibilidad con yarn:
# PASO 1 — BORRAR POR COMPLETO node_modules Y EL LOCK DEL CONTENEDOR

Desde tu host:

```console
docker compose exec app rm -rf node_modules
docker compose exec app rm -f yarn.lock

# PASO 2 — BORRAR TAMBIÉN EL LOCKFILE DE TU HOST

Tu host podría estar montando el mismo archivo:

```console
rm -f yarn.lock

# PASO 3 — REGENERAR UN NUEVO LOCKFILE YARN 1 DENTRO DEL CONTENEDOR

Ahora sí:

```console
docker compose exec app yarn install

# PASO 4 - COMPILAR EL FRONTEND DENTRO DEL CONTENEDOR
```console
docker compose exec app npm run dev
