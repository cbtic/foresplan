<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRenameToPlanillaCalculada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planilla_calculada', function (Blueprint $table) {
            //
        });
        Schema::rename('planilla_calculada', 'planilla_calculadas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planilla_calculada', function (Blueprint $table) {
            //
        });
    }
}
