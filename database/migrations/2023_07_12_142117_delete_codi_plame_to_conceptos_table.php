<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteCodiPlameToConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conceptos', function (Blueprint $table) {
            //
            $table->dropColumn('codi_oper_ope');
            $table->dropColumn('tipo_conc_tco');
            $table->dropColumn('tipo_calc_tco');
            $table->dropColumn('secu_calc_tco');
            $table->dropColumn('flag_asoc_tco');
            $table->dropColumn('flag_recu_tco');
            $table->dropColumn('rnta_qnta_tco');
            $table->dropColumn('cts_cts_tco');
            $table->dropColumn('codi_conc_onc');
            $table->dropColumn('codi_enti_ent');
            $table->dropColumn('cnta_debe_tco');
            $table->dropColumn('cnta_habe_tco');
            $table->dropColumn('clas_conc_tco');
            $table->dropColumn('flag_pago_tco');
            $table->dropColumn('codi_cova_tco');
            $table->dropColumn('codi_rtps_tco');
            $table->dropColumn('tipo_conc_pla');
            $table->dropColumn('codi_conc_pla');
            $table->dropColumn('desc_conc_pla');
            $table->dropColumn('codi_plame');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conceptos', function (Blueprint $table) {
            //
        });
    }
}
