<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdProveedorToSalidaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salida_productos', function (Blueprint $table) {
            $table->bigInteger('id_proveedor')->nullable();
            $table->bigInteger('id_empresa_compra')->nullable();
            $table->string('codigo',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salida_productos', function (Blueprint $table) {
            //
        });
    }
}
