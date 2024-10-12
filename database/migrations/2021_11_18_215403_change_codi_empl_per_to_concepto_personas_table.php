<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiEmplPerToConceptoPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concepto_personas', function (Blueprint $table) {
            $table->renameColumn('codi_empl_per', 'id_persona');
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
        Schema::table('concepto_personas', function (Blueprint $table) {
            //
        });
    }
}
