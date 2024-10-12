<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiOperTopToDetaOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deta_operaciones', function (Blueprint $table) {
            $table->renameColumn('codi_oper_top', 'id_tipo_operacion'); 
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
        Schema::table('deta_operaciones', function (Blueprint $table) {
            //
        });
    }
}
