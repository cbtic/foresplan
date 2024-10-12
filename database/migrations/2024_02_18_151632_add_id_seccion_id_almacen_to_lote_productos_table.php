<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSeccionIdAlmacenToLoteProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lote_productos', function (Blueprint $table) {
            $table->bigInteger('id_almacen')->unsigned()->index();
            $table->bigInteger('id_seccion')->unsigned()->index();
            $table->foreign('id_almacen')->references('id')->on('almacenes');
            $table->foreign('id_seccion')->references('id')->on('secciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote_productos', function (Blueprint $table) {
            //
        });
    }
}
