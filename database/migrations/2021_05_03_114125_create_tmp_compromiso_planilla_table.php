<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpCompromisoPlanillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tmp_compromiso_planilla');
        Schema::create('tmp_compromiso_planilla', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('anno_plan_tmp', 4)->nullable();
            $table->string('nmes_plan_tmp', 2)->nullable();
            $table->string('codi_fuen_tmp', 4)->nullable();
            $table->string('secu_func_tmp', 4)->nullable();
            $table->string('espe_gast_tmp', 20)->nullable();
            $table->string('mont_cale_tmp')->nullable();
            $table->string('mont_plan_tmp')->nullable();
            $table->string('codi_proy_pry', 3)->nullable()->comment('Código de Proyecto(Cadena Funcional)');
            $table->string('codi_prod_prd', 2)->nullable()->comment('Código del Producto');
            $table->string('codi_meta_met', 2)->nullable();
            $table->string('mont_ret_tmp')->nullable();
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Código de Sub Planilla');
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
        Schema::dropIfExists('tmp_compromiso_planilla');
    }
}
