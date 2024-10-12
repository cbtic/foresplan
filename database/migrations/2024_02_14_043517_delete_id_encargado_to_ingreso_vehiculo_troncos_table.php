<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteIdEncargadoToIngresoVehiculoTroncosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingreso_vehiculo_troncos', function (Blueprint $table) {            
            $table->dropForeign('ingreso_vehiculo_troncos_id_encargados_foreign');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingreso_vehiculo_troncos', function (Blueprint $table) {
            //
        });
    }
}
