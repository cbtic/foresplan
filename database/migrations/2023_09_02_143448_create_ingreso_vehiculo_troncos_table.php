<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoVehiculoTroncosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_vehiculo_troncos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida');
            $table->bigInteger('id_empresa_transportista')->unsigned()->index();
            $table->bigInteger('id_empresa_proveedor')->unsigned()->index();
            $table->bigInteger('id_vehiculos')->unsigned()->index();
            $table->bigInteger('id_conductores')->unsigned()->index();
            $table->bigInteger('id_encargados')->unsigned()->index();
            $table->bigInteger('id_procedencias')->unsigned()->index();
			$table->string('guia_numero',10)->nullable();
			$table->string('estado_ingreso',1)->default('1');
            $table->timestamps();
            //Foreign Keys
            $table->foreign('id_empresa_transportista')->references('id')->on('empresas');
            $table->foreign('id_empresa_proveedor')->references('id')->on('empresas');
            $table->foreign('id_vehiculos')->references('id')->on('vehiculos');
            $table->foreign('id_conductores')->references('id')->on('conductores');
            $table->foreign('id_encargados')->references('id')->on('encargados_empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('ingreso_vehiculo_troncos');
    }
}
