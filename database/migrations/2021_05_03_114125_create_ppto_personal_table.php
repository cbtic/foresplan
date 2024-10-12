<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptoPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ppto_personal');
        Schema::create('ppto_personal', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('anno_prog_per', 4)->nullable();
            $table->string('nmes_prog_per', 2)->nullable();
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_proy_pry', 3)->nullable()->comment('Código de Proyecto(Cadena Funcional)');
            $table->string('codi_prod_prd', 2)->nullable()->comment('Código del Producto');
            $table->string('codi_meta_met', 2)->nullable();
            $table->string('codi_plaz_pla', 8)->nullable()->comment('Codigo de Plaza');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('codi_nive_nvl', 3)->nullable()->comment('Código de Nivel');
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('proc_prog_per')->nullable();
            $table->string('mont_comp_per')->nullable();
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
            $table->string('cade_siaf_cad', 4)->nullable();
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
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
        Schema::dropIfExists('ppto_personal');
    }
}
