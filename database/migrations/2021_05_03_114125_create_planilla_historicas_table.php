<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaHistoricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('planilla_historicas');
        Schema::create('planilla_historicas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
            $table->string('ano_peri_tpe', 4)->nullable()->comment('Año');
            $table->string('nume_peri_tpe', 2)->nullable()->comment('Mes');
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('valo_calc_phi')->nullable();
            $table->string('valo_real_phi')->nullable();
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
        Schema::dropIfExists('planilla_historicas');
    }
}
