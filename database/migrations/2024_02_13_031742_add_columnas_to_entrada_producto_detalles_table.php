<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnasToEntradaProductoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrada_producto_detalles', function (Blueprint $table) {
            $table->bigInteger('id_producto')->unsigned()->index();
            $table->double('costo',15,8)->nullable();
            $table->date('fecha_fabricacion')->nullable();
            $table->foreign('id_producto')->references('id')->on('productos');

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
