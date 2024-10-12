<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTurnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('detalle_turno');
        Schema::create('detalle_turno', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_turn_tur', 2)->nullable()->comment('Codigo del turno');
            $table->string('nume_ndia_dtu', 2)->nullable()->comment('Numero de dia');
            $table->string('flag_labo_dtu', 1)->nullable()->comment('Indicador de laborable: s=es laborable, n=no es laborable');
            $table->string('minu_tole_dtu')->nullable()->comment('Minutos de tolerancia');
            $table->string('hora_sali_dtu')->nullable()->comment('Hora de salida');
            $table->string('hora_entr_dtu')->nullable()->comment('Hora de entrada');
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
        Schema::dropIfExists('detalle_turno');
    }
}
