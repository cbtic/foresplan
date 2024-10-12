<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTurnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('empleados_turno');
        Schema::create('empleados_turno', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_turn_tur', 2)->nullable()->comment('Codigo del turno');
            $table->string('codi_tarj_etu')->nullable();
            $table->string('fech_asig_ttu')->nullable();
            $table->string('flag_cont_asis', 1)->nullable()->comment('Indicador de marcacion: 0=marca, 1=no marca');
            $table->string('flag_sobt_ent', 1)->nullable()->comment('Sobretiempo: 0= SI, 1= NO');
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
        Schema::dropIfExists('empleados_turno');
    }
}
