<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiEmplPerToMetaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_personas', function (Blueprint $table) {
            $table->renameColumn('tipo_plan_tpl', 'id_planilla');
			$table->renameColumn('subt_plan_tpl', 'id_subplanilla');
			$table->renameColumn('codi_empl_per', 'id_persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_personas', function (Blueprint $table) {
            //
        });
    }
}
