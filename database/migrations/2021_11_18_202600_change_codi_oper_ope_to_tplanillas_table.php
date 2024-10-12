<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiOperOpeToTplanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tplanillas', function (Blueprint $table) {
            $table->renameColumn('codi_oper_ope', 'id_operacion'); 
            $table->renameColumn('codi_cond_lab', 'id_condicion_laboral');
			$table->renameColumn('codi_peri_tpe', 'id_tipo_periodo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tplanillas', function (Blueprint $table) {
            //
        });
    }
}
