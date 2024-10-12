<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaTemporalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('planilla_temporal');
        Schema::create('planilla_temporal', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_plan_tem', 2)->nullable();
            $table->string('subt_plan_tem', 1)->nullable();
            $table->string('ano_peri_tem', 4)->nullable();
            $table->string('nume_peri_tem', 2)->nullable();
            $table->string('codi_empl_tem', 8)->nullable();
            $table->string('nume_regi_tem')->nullable();
            $table->string('conc_ingr_tem', 5)->nullable();
            $table->string('valo_ingr_tem')->nullable();
            $table->string('conc_egre_tem', 5)->nullable();
            $table->string('valo_egre_tem')->nullable();
            $table->string('conc_apor_tem', 5)->nullable();
            $table->string('valo_apor_tem')->nullable();
            $table->string('secu_hoja_tem')->nullable();
            $table->string('nume_plaz_tem', 8)->nullable();
            $table->string('secu_line_tem')->nullable();
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
        Schema::dropIfExists('planilla_temporal');
    }
}
