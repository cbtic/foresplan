<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vehiculos')->unsigned()->index();
            $table->foreign('id_vehiculos')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->integer('id_empresas')->unsigned()->index();
            $table->foreign('id_empresas')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('empresas_vehiculos');
    }
}
