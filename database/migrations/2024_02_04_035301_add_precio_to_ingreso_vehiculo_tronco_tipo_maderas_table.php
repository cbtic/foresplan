<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecioToIngresoVehiculoTroncoTipoMaderasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingreso_vehiculo_tronco_tipo_maderas', function (Blueprint $table) {
            $table->double('subtotal',15,8)->nullable();
            $table->double('impuesto',15,8)->nullable();
            $table->double('total',15,8)->nullable();
            $table->Integer('id_moneda')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingreso_vehiculo_tronco_tipo_maderas', function (Blueprint $table) {
            //
        });
    }
}
