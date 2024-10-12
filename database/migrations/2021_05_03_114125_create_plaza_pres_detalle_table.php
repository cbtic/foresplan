<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazaPresDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plaza_pres_detalle');
        Schema::create('plaza_pres_detalle', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('iden_pap_pap')->nullable();
            $table->string('codi_plaz_pla', 8)->nullable()->comment('Codigo de Plaza');
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
            $table->string('impo_pres_pla')->nullable();
            $table->string('anno_ejec_eje', 4)->nullable()->comment('Año de ejecución');
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
        Schema::dropIfExists('plaza_pres_detalle');
    }
}
