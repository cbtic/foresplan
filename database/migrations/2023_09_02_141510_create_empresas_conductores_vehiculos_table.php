<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasConductoresVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_conductores_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_empresas')->unsigned()->index();
            $table->bigInteger('id_vehiculos')->unsigned()->index();
            $table->bigInteger('id_conductores')->unsigned()->index();
			$table->string('estado',1)->default('1');
            $table->timestamps();
            //Foreign Keys
            $table->foreign('id_empresas')->references('id')->on('empresas');
            $table->foreign('id_vehiculos')->references('id')->on('vehiculos');
            $table->foreign('id_conductores')->references('id')->on('conductores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('empresas_conductores_vehiculos');
    }
}
