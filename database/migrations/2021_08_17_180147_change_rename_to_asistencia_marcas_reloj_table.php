<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRenameToAsistenciaMarcasRelojTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencia_marcas_reloj', function (Blueprint $table) {
            //
        });
        Schema::rename('asistencia_marcas_reloj', 'asistencias');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistencia_marcas_reloj', function (Blueprint $table) {
            //
        });
    }
}
