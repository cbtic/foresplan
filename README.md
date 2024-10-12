## Laravel Boilerplate (Current: Laravel 8.*) ([Demo](https://demo.laravel-boilerplate.com))

[![Latest Stable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/stable)](https://packagist.org/packages/rappasoft/laravel-boilerplate)
[![Latest Unstable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/unstable)](https://packagist.org/packages/rappasoft/laravel-boilerplate) 
<br/>
[![StyleCI](https://styleci.io/repos/30171828/shield?style=plastic)](https://github.styleci.io/repos/30171828)
![Tests](https://github.com/rappasoft/laravel-boilerplate/workflows/Tests/badge.svg?branch=master)
<br/>
![GitHub contributors](https://img.shields.io/github/contributors/rappasoft/laravel-boilerplate.svg)
![GitHub stars](https://img.shields.io/github/stars/rappasoft/laravel-boilerplate.svg?style=social)

### Enjoying this project? [Buy me a beer 🍺](https://www.buymeacoffee.com/rappasoft)

Demo
----

[Click here for the demo](https://demo.laravel-boilerplate.com)
---------------------------------------------------------------

* * *

### **Credentials:**

**Admin:**

User: admin@admin.com  
Password: secret

**User:**

User: user@user.com  
Password: secret

Download
--------

[View on GitHub](https://github.com/rappasoft/laravel-boilerplate) [Download Laravel Boilerplate](https://github.com/rappasoft/laravel-boilerplate/archive/master.zip)

Installation
------------

### 1\. Download

Download the files above and place on your server.

### 2\. Environment Files

This package ships with a **.env.example** file in the root of the project.

You must rename this file to just **.env**

**Note:** Make sure you have hidden files shown on your system.

### 3\. Composer

Laravel project dependencies are managed through the [PHP Composer tool](http://getcomposer.org). The first step is to install the depencencies by navigating into your project in terminal and typing this command:

`composer install`

### 4\. NPM/Yarn

In order to install the Javascript packages for frontend development, you will need the [Node Package Manager](https://www.npmjs.com/), and optionally the [Yarn Package Manager](https://code.facebook.com/posts/1840075619545360) by Facebook (Recommended)

If you only have NPM installed you have to run this command from the root of the project:

`npm install`

If you have Yarn installed, run this instead from the root of the project:

`yarn`

### 5\. Create Database

You must create your database on your server and on your **.env** file update the following lines:

`DB_CONNECTION=mysql   DB_HOST=127.0.0.1   DB_PORT=3306   DB_DATABASE=homestead   DB_USERNAME=homestead   DB_PASSWORD=secret`

Change these lines to reflect your new database settings.

### 6\. Artisan Commands

The first thing we are going to do is set the key that Laravel will use when doing encryption.

`php artisan key:generate`

## =>Crear Modelo, Controlador y migracion:
`php artisan make:model Producto -c -m --resource`

## =>Controlador con CRUD:
`php artisan make:controller productoController --resource`

## =>Request para las validaciones:
`php artisan make:request AlmaceneRequest`

## =>Controlador, modelo, validaciones:
`app/Http/Controllers/VehiculoController.php`
`app/Http/Requests/VehiculoRequest.php`
`app/Models/Vehiculo.php`

## =>Listado de una tabla:
`app/Http/Livewire/Backend/VehiculoTable.php   (*)`

## =>Formularios para editar un Model:
`app/View/Components/Forms/Vehiculo.php`
`app/View/Forms/VehiculoForm.php         (**)`

## =>Vistas: (**)

`resources/views/frontend/vehiculos/create.blade.php`
`resources/views/frontend/vehiculos/edit.blade.php`
`resources/views/frontend/vehiculos/index.blade.php   (*)`
`resources/views/frontend/vehiculos/show.blade.php`

## =>Otros archivos:
`routes/frontend/home.php`
`resources/views/frontend/includes/sidebar.blade.php`

## Usar Grafite Forms y Livewire Tables para Producto-ProductoDetalle:

# Models
`app/Models/EntradaProducto.php`
`app/Models/EntradaProductoDetalle.php`

# Controllers
`app/Http/Controllers/EntradaProductosController.php`
`app/Http/Controllers/EntradaProductoDetallesController.php`

# Livewire Tables
`app/Http/Livewire/Backend/EntradaProductosTable.php`
`app/Http/Livewire/Backend/EntradaProductoDetallesTable.php`

# Rules
`app/Http/Requests/EntradaProductoRequest.php`
`app/Http/Requests/EntradaProductoDetalleRequest.php`

# Forms
`app/View/Components/Forms/EntradaProducto.php`
`app/View/Components/Forms/EntradaProductoDetalle.php`
`app/View/Forms/EntradaProductosForm.php`
`app/View/Forms/EntradaProductoDetallesForm.php`

# Views
`resources/views/frontend/entrada_productos/create.blade.php`
`resources/views/frontend/entrada_productos/edit.blade.php`
`resources/views/frontend/entrada_productos/index.blade.php`
`resources/views/frontend/entrada_productos/show.blade.php`

`resources/views/frontend/entrada_producto_detalles/create.blade.php`
`resources/views/frontend/entrada_producto_detalles/edit.blade.php`
`resources/views/frontend/entrada_producto_detalles/index.blade.php`
`resources/views/frontend/entrada_producto_detalles/show.blade.php`

# Routes
`routes/frontend/home.php`

## Colores institucionales:

 - Background: #183e39
 - Front: #aed29b

You should see a green message stating your key was successfully generated. As well as you should see the **APP\_KEY** variable in your **.env** file reflected.

It's time to see if your database credentials are correct.

We are going to run the built in migrations to create the database tables:

`php artisan migrate`

## Para crear las funciones en batch: en el directorio conde estan los archivos .sql ejecutar esta línea:

`find . -iname "*.sql" | xargs printf -- ' -f %s' | xargs -t psql -d forespama -q`

You should see a message for each table migrated, if you don't and see errors, than your credentials are most likely not correct.

We are now going to set the administrator account information. To do this you need to navigate to [this file](https://github.com/rappasoft/laravel-boilerplate/blob/master/database/seeds/Auth/UserTableSeeder.php#L25) and change the name/email/password of the Administrator account.

You can delete the other dummy users, but do not delete the administrator account or you will not be able to access the backend.

Now seed the database with:

`php artisan db:seed`

You should get a message for each file seeded, you should see the information in your database tables.

Limpiar rutas, cache, configuraciones de Laravel:

`php artisan clear-compiled && php artisan cache:clear && php artisan route:clear && php artisan view:clear && php artisan config:clear && composer dumpautoload -o`

### 7\. NPM Run '\*'

Now that you have the database tables and default rows, you need to build the styles and scripts.

These files are generated using [Laravel Mix](https://laravel.com/docs/6.0/mix), which is a wrapper around many tools, and works off the **webpack.mix.js** in the root of the project.

You can build with:

`npm run <command>`

The available commands are listed at the top of the package.json file under the 'scripts' key.

You will see a lot of information flash on the screen and then be provided with a table at the end explaining what was compiled and where the files live.

At this point you are done, you should be able to hit the project in your local browser and see the project, as well as be able to log in with the administrator and view the backend.

### 8\. PHPUnit

After your project is installed, make sure you run the test suite to make sure all of the parts are working correctly. From the root of your project run:

`phpunit`

You will see a dot(.) appear for each of the hundreds of tests, and then be provided with the amount of passing tests at the end. There should be no failures with a fresh install.

### 9\. Storage:link

After your project is installed you must run this command to link your public storage folder for user avatar uploads:

`php artisan storage:link`

### 10\. Login

After your project is installed and you can access it in a browser, click the login button on the right of the navigation bar.

The administrator credentials are:

**Username:** admin@admin.com

**Password:** secret

You will be automatically redirected to the backend. If you changed these values in the seeder prior, then obviously use the ones you updated to.

What's Next?
------------

At this point you have all that you need, you can browse the code base and build the rest of your application the way you normally would. Or you can visit the [documentation](../7.0/documentation.html) to get a really good grasp on what's going on behind the scenes.
