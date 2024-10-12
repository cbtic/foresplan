<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleMovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('detalle_mov');
        Schema::create('detalle_mov', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('secu_ejec_cin', 4)->nullable()->comment('Código de la Organización');
            $table->string('anno_ejec_eje', 4)->nullable()->comment('Año de ejecución');
            $table->string('num_regi_cab', 8)->nullable()->comment('Código del registro de cabecera');
            $table->string('secu_regi_det', 8)->nullable()->comment('Secuencia de Registro de Detalle Mov');
            $table->string('codi_proy_pin', 4)->nullable()->comment('Campo no utilizado');
            $table->string('clas_deta_det', 20)->nullable()->comment('Clasificador de Gasto');
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
            $table->string('codi_func_fun', 2)->nullable()->comment('Código de Función');
            $table->string('codi_prog_prg', 3)->nullable()->comment('Código de Programa');
            $table->string('csub_prog_spr', 4)->nullable()->comment('Código de Sub-Programa');
            $table->string('acti_proy_acp', 7)->nullable()->comment('Código de Actividad');
            $table->string('codi_comp_com', 7)->nullable()->comment('Código de Componente');
            $table->string('codi_meta_sfu', 5)->nullable()->comment('Código de la Meta Programada');
            $table->string('codi_fina_fin', 9)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('nmes_ejec_det', 2)->nullable();
            $table->string('mnto_deta_det')->nullable();
            $table->string('mnto_naci_det')->nullable();
            $table->string('mnto_sald_det')->nullable();
            $table->string('flag_rete_det', 1)->nullable()->comment('Campo no utilizado');
            $table->string('flag_comp_det', 1)->nullable()->comment('Campo no utilizado');
            $table->string('esta_deta_det', 1)->nullable();
            $table->string('mnto_anul_det')->nullable();
            $table->string('ejec_deta_det')->nullable()->comment('Campo no utilizado');
            $table->string('ejec_naci_det')->nullable();
            $table->string('anul_deta_det')->nullable();
            $table->string('anul_naci_det')->nullable()->comment('Campo no utilizado');
            $table->string('ajus_deta_det')->nullable()->comment('Campo no utilizado');
            $table->string('ajus_naci_det')->nullable();
            $table->string('flag_modi_gas', 2)->nullable()->comment('Campo no utilizado');
            $table->string('id_gru_gast', 2)->nullable();
            $table->string('id_sgr_gast', 3)->nullable();
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
        Schema::dropIfExists('detalle_mov');
    }
}
