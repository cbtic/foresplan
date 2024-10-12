<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIgvToSalidaProductoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salida_producto_detalles', function (Blueprint $table) {
            $table->double('sub_total')->nullable();
            $table->double('igv')->nullable();
            $table->double('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salida_producto_detalles', function (Blueprint $table) {
            //
        });
    }
}
