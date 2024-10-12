<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiTurnTurPerIntToDetalleTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_turnos', function (Blueprint $table) {
            DB::statement("ALTER TABLE detalle_turnos alter column id_turno TYPE bigint USING(id_turno::bigint)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_turnos', function (Blueprint $table) {
            //
        });
    }
}
