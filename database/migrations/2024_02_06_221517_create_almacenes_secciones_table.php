<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenesSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenes_secciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_almacenes')->unsigned()->index();
            $table->foreign('id_almacenes')->references('id')->on('almacenes')->onDelete('cascade');
            $table->integer('id_secciones')->unsigned()->index();
            $table->foreign('id_secciones')->references('id')->on('secciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('almacenes_secciones');
    }
}
