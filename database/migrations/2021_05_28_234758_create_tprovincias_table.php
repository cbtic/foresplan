<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTprovinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tprovincias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_depa_dpt',4);
            $table->string('codi_prov_tpr',4);
            $table->string('nomb_prov_tpr');
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
        Schema::dropIfExists('tprovincias');
    }
}
