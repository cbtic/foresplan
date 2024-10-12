
# Models
`app/Models/SalidaProducto.php`
`app/Models/SalidaProductoDetalle.php`

# Controllers
`app/Http/Controllers/SalidaProducto(s)Controller.php`
`app/Http/Controllers/SalidaProductoDetalle(s)Controller.php`

> php artisan make:model SalidaProducto -c

# Livewire Tables
`app/Http/Livewire/Backend/SalidaProductosTable.php`
`app/Http/Livewire/Backend/SalidaProductoDetallesTable.php`

> php artisan make:datatable SalidaProductosTable SalidaProducto

# Rules
`app/Http/Requests/SalidaProductoRequest.php`
`app/Http/Requests/SalidaProductoDetalleRequest.php`

> php artisan make:request SalidaProductoRequest 

# Forms
`app/View/Components/Forms/SalidaProducto.php`
`app/View/Components/Forms/SalidaProductoDetalle.php`
`app/View/Forms/SalidaProductosForm.php`
`app/View/Forms/SalidaProductoDetallesForm.php`

> touch app/View/Components/Forms/SalidaProducto.php
> touch app/View/Forms/SalidaProductosForm.php

# Views
`resources/views/frontend/salida_productos/create.blade.php`
`resources/views/frontend/salida_productos/edit.blade.php`
`resources/views/frontend/salida_productos/index.blade.php`

> cp -r resources/views/frontend/salida_productos resources/views/frontend/salida_productos

# Routes (Añadir al archivo con las rutas)

`Route::get('salida_productos', 'App\Http\Controllers\SalidaProductoController@index')->name('salida_productos.index');`
`Route::post('salida_productos', 'App\Http\Controllers\SalidaProductoController@store')->name('salida_productos.store');`
`Route::get('salida_productos/create', 'App\Http\Controllers\SalidaProductoController@create')->name('salida_productos.create');`
`Route::put('salida_productos/{salida_productos}', 'App\Http\Controllers\SalidaProductoController@update')->name('salida_productos.update');`
`Route::delete('salida_productos/{salida_productos}', 'App\Http\Controllers\SalidaProductoController@destroy')->name('salida_productos.destroy');`
`Route::get('salida_productos/edit/{salida_productos}', 'App\Http\Controllers\SalidaProductoController@edit')->name('salida_productos.edit');`

`Route::post('salida_producto_detalles', 'App\Http\Controllers\SalidaProductoDetalleController@store')->name('salida_producto_detalles.store');`
`Route::put('salida_producto_detalles/{salida_producto_detalles}', 'App\Http\Controllers\SalidaProductoDetalleController@update')->name('salida_producto_detalles.update');`
`Route::delete('salida_producto_detalles/{salida_producto_detalles}', 'App\Http\Controllers\SalidaProductoDetalleController@destroy')->name('salida_producto_detalles.destroy');`
