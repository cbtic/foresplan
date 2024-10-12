<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipoPlanTplToTperiodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tperiodos', function (Blueprint $table) {
            $table->renameColumn('tipo_plan_tpl', 'id_planilla');
			$table->renameColumn('subt_plan_tpl', 'id_subplanilla');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tperiodos', function (Blueprint $table) {
            //
        });
    }
}
