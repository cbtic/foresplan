<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoVehiculoTroncoTipoMaderasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_vehiculo_tronco_tipo_maderas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_ingreso_vehiculo_troncos')->unsigned()->index();
            $table->bigInteger('id_tipo_maderas')->unsigned()->index();
            $table->double('cantidad',15,8);
			$table->string('estado',1)->default('1');
            $table->timestamps();
            //Foreign Keys
            $table->foreign('id_ingreso_vehiculo_troncos')->references('id')->on('ingreso_vehiculo_troncos');
            $table->foreign('id_tipo_maderas')->references('id')->on('tipo_maderas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('ingreso_vehiculo_tronco_tipo_maderas');
    }
}
