<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('resumen');
        Schema::create('resumen', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
            $table->string('ano_peri_tpe', 4)->nullable()->comment('Año');
            $table->string('nume_peri_tpe', 2)->nullable()->comment('Mes');
            $table->string('codi_conc_res', 5)->nullable()->comment('Codigo del concepto');
            $table->string('cant_conc_res')->nullable()->comment('Cantidad (dias, minutos)');
            $table->string('cant_conc_rem')->nullable()->comment('No se usa');
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
        Schema::dropIfExists('resumen');
    }
}
