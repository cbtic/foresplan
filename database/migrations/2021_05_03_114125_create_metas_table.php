<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('metas');
        Schema::create('metas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('anno_ejec_eje', 4)->nullable()->comment('Año de ejecución');
            $table->string('secu_ejec_cin', 4)->nullable()->comment('Código de la Organización');
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
            $table->string('codi_func_fun', 2)->nullable()->comment('Código de Función');
            $table->string('codi_prog_prg', 3)->nullable()->comment('Código de Programa');
            $table->string('csub_prog_spr', 4)->nullable()->comment('Código de Sub-Programa');
            $table->string('acti_proy_acp', 7)->nullable()->comment('Código de Actividad');
            $table->string('codi_comp_com', 7)->nullable()->comment('Código de Componente');
            $table->string('codi_meta_sfu', 5)->nullable()->comment('Código de la Meta Programada');
            $table->string('codi_fina_fin', 9)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('desc_meta_sfu', 200)->nullable()->comment('Descripción de la Meta Programada');
            $table->string('cant_meta_sfu')->nullable();
            $table->string('codi_unid_med', 3)->nullable();
            $table->string('codi_depa_dpt', 2)->nullable()->comment('Código de Departamento');
            $table->string('codi_prov_tpr', 2)->nullable()->comment('Código de Provincia');
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('tipo_ppto_tpr', 4)->nullable()->comment('Tipo de Presupuesto');
            $table->string('codi_inst_ins', 8)->nullable()->comment('Código de la Institución');
            $table->string('desc_comp_com', 60)->nullable()->comment('Descripción de Componente');
            $table->string('codi_proy_pry', 3)->nullable()->comment('Código de Proyecto(Cadena Funcional)');
            $table->string('codi_prod_prd', 2)->nullable()->comment('Código del Producto');
            $table->string('codi_meta_met', 2)->nullable();
            $table->string('cade_func_mef', 4)->nullable()->comment('Código de la Meta del MEF');
            $table->string('fact_conv_met')->nullable();
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('cade_siaf_cad', 4)->nullable();
            $table->string('esta_meta_met', 1)->nullable()->comment('Estado de la Meta Programada (A=Activo, I=Inactivo)');
            $table->string('id_estructurafp')->nullable();
            $table->string('id_estructura')->nullable();
            $table->string('cod_cat_pres', 4)->nullable();
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
        Schema::dropIfExists('metas');
    }
}
