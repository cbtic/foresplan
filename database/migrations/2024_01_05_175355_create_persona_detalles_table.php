<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('id_personas')->unsigned()->index();
			$table->bigInteger('id_empresas')->unsigned()->index();
			$table->string('ubigeo',8);
			$table->string('pais')->nullable();
			$table->string('departamento')->nullable();
			$table->string('provincia')->nullable();
			$table->string('distrito')->nullable();
			$table->string('direccion');
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
			$table->date('fecha_ingreso')->nullable();
			$table->bigInteger('id_condicion_laboral')->nullable();
			$table->bigInteger('id_tipo_planilla')->nullable();
			$table->bigInteger('id_profesion')->nullable();
			$table->bigInteger('id_banco_sueldo')->nullable();
			$table->string('num_cuenta_sueldo')->nullable();
			$table->string('cci_sueldo')->nullable();
			$table->bigInteger('id_regimen_pensionario')->nullable();
			$table->bigInteger('id_afp')->nullable();
			$table->date('fecha_afiliacion_afp')->nullable();
			$table->bigInteger('id_tipo_comision_afp')->nullable();
			$table->string('cuspp')->nullable();
			$table->date('fecha_cese')->nullable();
			$table->date('fecha_termino_contrato')->nullable();
			$table->string('num_contrato')->nullable();
			$table->bigInteger('id_cargo')->nullable();
			$table->bigInteger('id_nivel')->nullable();
			$table->bigInteger('id_banco_cts')->nullable();
			$table->string('num_cuenta_cts')->nullable();
			$table->bigInteger('id_moneda_cts')->nullable();
			$table->string('estado',1)->default('1');
			$table->string('eliminado',1)->default('1');
            $table->timestamps();

			//Foreign Keys
			$table->foreign('id_personas')->references('id')->on('personas');
			$table->foreign('id_empresas')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('persona_detalles');
    }
}
