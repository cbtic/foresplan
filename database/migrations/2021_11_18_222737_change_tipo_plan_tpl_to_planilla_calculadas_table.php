<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipoPlanTplToPlanillaCalculadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planilla_calculadas', function (Blueprint $table) {
            $table->renameColumn('tipo_plan_tpl', 'id_planilla');
			$table->renameColumn('subt_plan_tpl', 'id_subplanilla');
			$table->renameColumn('codi_conc_tco', 'id_concepto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planilla_calculadas', function (Blueprint $table) {
            //
        });
    }
}
