<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiEmplPerIntToPersonalTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_turnos', function (Blueprint $table) {
            DB::statement("ALTER TABLE personal_turnos alter column id_persona TYPE bigint USING(id_persona::bigint)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_turnos', function (Blueprint $table) {
            //
        });
    }
}
