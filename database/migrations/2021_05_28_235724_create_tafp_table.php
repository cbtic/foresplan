<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTafpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tafp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_afp',2);
            $table->string('nomb_afp',25);
            $table->string('codi_conc_tco',25)->nullable();
            $table->string('flag_activ_afp',1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');;
            $table->string('cnta_habe_cta',50)->nullable();
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
        Schema::dropIfExists('tafp');
    }
}
