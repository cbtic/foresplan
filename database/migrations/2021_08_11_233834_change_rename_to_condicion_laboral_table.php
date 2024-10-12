<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRenameToCondicionLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condicion_laboral', function (Blueprint $table) {
            //
        });
		
		Schema::rename('condicion_laboral', 'condicion_laborales');
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condicion_laboral', function (Blueprint $table) {
            //
        });
    }
}
