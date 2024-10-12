<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('metas_productos');
        Schema::create('metas_productos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_proy_pry', 3)->nullable()->comment('Código de Proyecto(Cadena Funcional)');
            $table->string('codi_prod_prd', 2)->nullable()->comment('Código del Producto');
            $table->string('codi_meta_met', 2)->nullable();
            $table->string('codi_medi_und', 3)->nullable()->comment('Código de Unidad de Medida');
            $table->string('desc_meta_met', 250)->nullable()->comment('Descripción de la Meta');
            $table->string('cant_meta_met')->nullable();
            $table->string('peri_anno_met', 20)->nullable();
            $table->string('flag_cuan_met', 1)->nullable();
            $table->string('anno_meta_ini', 4)->nullable();
            $table->string('dura_meta_ini')->nullable();
            $table->string('desc_larg_met', 250)->nullable();
            $table->string('nume_apro_mcl')->nullable();
            $table->string('medi_veri_met', 1000)->nullable();
            $table->string('cod_catinvbid', 20)->nullable();
            $table->string('cod_catinvbirf', 20)->nullable()->comment('Se quito el campo indi_proy_met');
            $table->string('codi_cnta_act', 15)->nullable();
            $table->string('obra_actividad_id')->nullable();
            $table->string('codi_poa', 20)->nullable();
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
        Schema::dropIfExists('metas_productos');
    }
}
