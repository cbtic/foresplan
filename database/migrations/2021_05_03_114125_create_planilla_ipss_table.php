<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaIpssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('planilla_ipss');
        Schema::create('planilla_ipss', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
            $table->string('anio_plan_tpe', 4)->nullable();
            $table->string('nume_peri_tpe', 2)->nullable()->comment('Mes');
            $table->string('situ_trab_ips', 2)->nullable();
            $table->string('dias_subs_ips', 2)->nullable();
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
        Schema::dropIfExists('planilla_ipss');
    }
}
