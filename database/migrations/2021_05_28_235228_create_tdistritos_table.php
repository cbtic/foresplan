<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdistritos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_depa_dpt',4);
            $table->string('codi_prov_tpr',4);
            $table->string('codi_dist_tdi',4);
            $table->string('nomb_dist_tdi');
            $table->string('codi_sede_sed',3)->nullable();
            $table->string('flag_acti_tpr',1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
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
        Schema::dropIfExists('tdistritos');
    }
}
