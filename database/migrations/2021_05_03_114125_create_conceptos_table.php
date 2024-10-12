<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conceptos');
        Schema::create('conceptos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('codi_oper_ope', 9)->nullable()->comment('Código de Operación');
            $table->string('codi_cicl_cic', 1)->nullable()->comment('Código de Ciclo');
            $table->string('desc_conc_tco', 50)->nullable();
            $table->string('desc_cort_tco', 25)->nullable();
            $table->string('tipo_conc_tco', 1)->nullable();
            $table->string('tipo_calc_tco', 1)->nullable();
            $table->string('secu_calc_tco', 2)->nullable();
            $table->string('flag_asoc_tco', 1)->nullable();
            $table->string('flag_recu_tco', 1)->nullable();
            $table->string('rnta_qnta_tco', 1)->nullable();
            $table->string('cts_cts_tco', 1)->nullable();
            $table->string('codi_conc_onc', 5)->nullable()->comment('Código de Concepto');
            $table->string('codi_enti_ent', 8)->nullable()->comment('Código del eps');
            $table->string('cnta_debe_tco', 15)->nullable();
            $table->string('cnta_habe_tco', 15)->nullable();
            $table->string('clas_conc_tco', 1)->nullable();
            $table->string('flag_pago_tco', 1)->nullable();
            $table->string('codi_cova_tco', 2)->nullable()->comment('Codigo de variabilidad (determina cuando es rta. 5ta., rem. basica, etc.)');
            $table->string('codi_rtps_tco', 10)->nullable()->comment('Código usado en la planilla electrónica');
            $table->string('tipo_conc_pla', 1)->nullable();
            $table->string('codi_conc_pla', 4)->nullable();
            $table->string('desc_conc_pla', 50)->nullable();
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
        Schema::dropIfExists('conceptos');
    }
}
