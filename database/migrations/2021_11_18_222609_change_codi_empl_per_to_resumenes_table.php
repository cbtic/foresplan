<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiEmplPerToResumenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumenes', function (Blueprint $table) {
            $table->renameColumn('codi_empl_per', 'id_persona');
			$table->renameColumn('tipo_plan_tpl', 'id_planilla');
			$table->renameColumn('subt_plan_tpl', 'id_subplanilla');
			$table->renameColumn('codi_conc_res', 'id_concepto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resumenes', function (Blueprint $table) {
            //
        });
    }
}
