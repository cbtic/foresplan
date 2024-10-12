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
			$table->bigInteger('id_persona')->unsigned()->index();
			$table->string('direccion');
			$table->string('ubigeo');
			$table->string('telefono');
            $table->string('email');
            $table->string('foto');
			$table->date('fecha_ingreso');
			$table->bigInteger('id_condicion_laboral');
			$table->bigInteger('id_tipo_planilla');
			$table->bigInteger('id_profesion');
			$table->bigInteger('id_banco_sueldo');
			$table->string('num_cuenta_sueldo');
			$table->string('cci_sueldo');
			$table->bigInteger('id_regimen_pensionario');
			$table->bigInteger('id_afp');
			$table->date('fecha_afiliacion_afp');
			$table->bigInteger('id_tipo_comision_afp');
			$table->string('cuspp');
			$table->date('fecha_cese');
			$table->date('fecha_termino_contrato');
			$table->string('num_contrato');
			$table->bigInteger('id_cargo');
			$table->bigInteger('id_nivel');
			$table->bigInteger('id_banco_cts');
			$table->string('num_cuenta_cts');
			$table->bigInteger('id_moneda_cts');
			$table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_detalles');
    }
}
