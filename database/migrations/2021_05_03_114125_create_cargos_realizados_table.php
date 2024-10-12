<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosRealizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cargos_realizados');
        Schema::create('cargos_realizados', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('secu_carg_car', 2)->nullable();
            $table->string('tipo_carg_car', 1)->nullable()->comment('Tipo de Cargo (S=Interno, N=Externo)');
            $table->string('fech_inic_car')->comment('Fecha de Inicio del Cargo');
            $table->string('fech_fina_car')->nullable()->comment('Fecha de termino del Cargo');
            $table->string('codi_carg_tca', 8)->nullable()->comment('Código del Cargo del Personal');
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('codi_moti_tmo', 4)->nullable();
            $table->string('inst_exte_car', 100)->nullable();
            $table->string('nume_reso_car', 10)->nullable();
            $table->string('fech_reso_car')->nullable();
            $table->string('obse_car', 60)->nullable()->comment('Observación del Cargo Realizado');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('tipo_inst_car', 1)->nullable();
            $table->string('desc_carg_car', 100)->nullable();
            $table->string('desc_moti_car', 1000)->nullable();
            $table->string('fech_inic_nue')->nullable();
            $table->string('fech_fina_nue')->nullable();
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
        Schema::dropIfExists('cargos_realizados');
    }
}
