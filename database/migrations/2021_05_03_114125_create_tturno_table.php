<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTturnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tturno');
        Schema::create('tturno', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_turn_tur', 2)->nullable()->comment('Codigo del turno');
            $table->string('nomb_desc_tur', 20)->nullable();
            $table->string('hora_entr_tur')->nullable()->comment('Hora de entrada del turno');
            $table->string('hora_sali_tur')->nullable()->comment('Hora de salida del turno');
            $table->string('minu_tole_tur')->nullable();
            $table->string('tipo_refr_tur', 1)->nullable();
            $table->string('refr_sali_tur')->nullable();
            $table->string('refr_entr_tur')->nullable();
            $table->string('refr_tole_tur')->nullable();
            $table->string('domi_dsem_tur', 1)->nullable();
            $table->string('lune_dsem_tur', 1)->nullable();
            $table->string('mart_dsem_tur', 1)->nullable();
            $table->string('mier_dsem_tur', 1)->nullable();
            $table->string('juev_dsem_tur', 1)->nullable();
            $table->string('vier_dsem_tur', 1)->nullable();
            $table->string('saba_dsem_tur', 1)->nullable();
            $table->string('flag_tole_tur', 1)->nullable()->comment('Indica como se controla la tolerancia. 0 = por día, 1 = acumulado x mes');
            $table->string('hora_sema_tur')->nullable();
            $table->string('tiemp_refr_min')->nullable();
            $table->string('perm_dia_tur')->nullable();
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
        Schema::dropIfExists('tturno');
    }
}
