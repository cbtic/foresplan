<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdepartamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_depa_dpt',4);
            $table->string('nomb_dpto_dpt');
            $table->string('valo_desp_dpt');
            $table->string('flag_acti_dpt',1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
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
        Schema::dropIfExists('tdepartamentos');
    }
}
