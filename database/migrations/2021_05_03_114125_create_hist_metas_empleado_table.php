<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistMetasEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hist_metas_empleado');
        Schema::create('hist_metas_empleado', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
            $table->string('ano_peri_hme', 4)->nullable();
            $table->string('nume_peri_hme', 2)->nullable();
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('anno_ejec_eje', 4)->nullable()->comment('Año de ejecución');
            $table->string('secu_ejec_cin', 4)->nullable()->comment('Código de la Organización');
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
            $table->string('codi_func_fun', 2)->nullable()->comment('Código de Función');
            $table->string('codi_prog_prg', 3)->nullable()->comment('Código de Programa');
            $table->string('csub_prog_spr', 4)->nullable()->comment('Código de Sub-Programa');
            $table->string('acti_proy_acp', 6)->nullable()->comment('Código de Actividad');
            $table->string('codi_comp_com', 5)->nullable()->comment('Código de Componente');
            $table->string('codi_meta_sfu', 5)->nullable()->comment('Código de la Meta Programada');
            $table->string('codi_fina_fin', 7)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('moti_asig_hme', 30)->nullable();
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('codi_carg_hme', 8)->nullable();
            $table->string('codi_proy_hme', 4)->nullable();
            $table->string('sede_actu_per', 3)->nullable();
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('codi_nive_nvl', 3)->nullable()->comment('Código de Nivel');
            $table->string('situ_cont_per', 1)->nullable();
            $table->string('tipo_movi_afp', 2)->nullable();
            $table->string('fech_movi_afp')->nullable();
            $table->string('sede_asis_hme', 3)->nullable();
            $table->string('depe_asis_hme', 4)->nullable();
            $table->string('codi_afp', 2)->nullable()->comment('Código AFP');
            $table->string('nume_depe_hme')->nullable();
            $table->string('codi_cont_eps', 4)->nullable();
            $table->string('codi_plan_eps', 2)->nullable();
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
        Schema::dropIfExists('hist_metas_empleado');
    }
}
