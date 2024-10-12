<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteIdTipoMaderaToIngresoVehiculoTroncoImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingreso_vehiculo_tronco_imagenes', function (Blueprint $table) {
            $table->dropForeign('ingreso_vehiculo_tronco_imagenes_id_tipo_maderas_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingreso_vehiculo_tronco_imagenes', function (Blueprint $table) {
            //
        });
    }
}
