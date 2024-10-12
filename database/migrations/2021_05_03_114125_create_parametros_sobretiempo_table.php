<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosSobretiempoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('parametros_sobretiempo');
        Schema::create('parametros_sobretiempo', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable();
            $table->string('fech_oper_pst')->nullable();
            $table->string('tipo_oper_pst', 1)->nullable();
            $table->string('mint_razo_pst')->nullable();
            $table->string('mint_sobr_pst')->nullable();
            $table->string('flag_eraz_pst', 1)->nullable();
            $table->string('flag_esob_pst', 1)->nullable();
            $table->string('mint_comp_pst')->nullable()->comment('Minutos Aprobados para Compensar');
            $table->string('tipo_reg_pst', 1)->nullable();
            $table->string('mint_tota_pst')->nullable()->comment('Suma de Tiempo de Racionamiento y Compensacion');
            $table->string('mint_scom_pst')->nullable()->comment('Minutos Solicitados para compensar');
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
        Schema::dropIfExists('parametros_sobretiempo');
    }
}
