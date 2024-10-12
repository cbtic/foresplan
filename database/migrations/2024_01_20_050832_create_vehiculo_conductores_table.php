<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos_conductores', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vehiculos')->unsigned()->index();
            $table->foreign('id_vehiculos')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->integer('id_conductores')->unsigned()->index();
            $table->foreign('id_conductores')->references('id')->on('conductores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('vehiculo_conductores');
    }
}
