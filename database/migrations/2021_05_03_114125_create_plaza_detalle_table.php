<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plaza_detalle');
        Schema::create('plaza_detalle', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('iden_cap_cap')->nullable();
            $table->string('codi_plaz_pla', 8)->nullable()->comment('Codigo de Plaza');
            $table->string('nume_plaz_cap', 10)->nullable();
            $table->string('nume_depe_cap', 10)->nullable();
            $table->string('desc_plaz_pla', 100)->nullable()->comment('Descripción de Plaza de Trabajo');
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('codi_carg_tca', 8)->nullable()->comment('Código del Cargo del Personal');
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('esta_plaz_cap', 1)->nullable();
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
        Schema::dropIfExists('plaza_detalle');
    }
}
