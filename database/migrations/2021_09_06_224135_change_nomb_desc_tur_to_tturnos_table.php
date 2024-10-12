<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNombDescTurToTturnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tturnos', function (Blueprint $table) {
            DB::statement("ALTER TABLE tturnos alter column nomb_desc_tur TYPE varchar(50)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tturnos', function (Blueprint $table) {
            //
        });
    }
}
