<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpaises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_pais_tpa',4)->comment('Código de País');
            $table->string('nomb_pais_tpa',200)->comment('Nombre');
            $table->string('codi_rtps_tpa',10)->nullable()->comment('Código usado en la planilla electrónica');
            $table->string('flag_acti_tpa',1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
            $table->string('abr_bid_tpa',20)->nullable();
            $table->string('abr_birf_tpa',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tpaises');
    }
}
