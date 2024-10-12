<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('asistencia_empleado');
        Schema::create('asistencia_empleado', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('secu_regi_aem', 3)->nullable()->comment('Secuencia del registro');
            $table->string('fech_inic_aem')->nullable()->comment('Fecha de inicio del periodo de marcacion');
            $table->string('fech_fina_aem')->nullable()->comment('Fecha de termino del periodo de marcacion');
            $table->string('flag_marc_aem', 1)->nullable()->comment('Indicador marcacion. 0 = no marca, 1= si marca');
            $table->string('codi_turn_tur', 2)->nullable()->comment('Codigo del turno asignado para el periodo');
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
        Schema::dropIfExists('asistencia_empleado');
    }
}
