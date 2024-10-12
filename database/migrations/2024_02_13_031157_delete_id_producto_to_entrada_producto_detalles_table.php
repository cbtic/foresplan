<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteIdProductoToEntradaProductoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrada_producto_detalles', function (Blueprint $table) {
            $table->dropColumn('id_productos');
            $table->dropColumn('precio_unitario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrada_producto_detalles', function (Blueprint $table) {
            //
        });
    }
}
