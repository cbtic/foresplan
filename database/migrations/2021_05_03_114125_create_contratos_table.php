<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contratos');
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('peri_anno_con', 4)->nullable();
            $table->string('nume_cont_con', 4)->nullable();
            $table->string('tipo_cont_con', 1)->nullable();
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('fech_inic_cnt')->nullable();
            $table->string('fech_reso_cnt')->nullable();
            $table->string('nume_reso_cnt', 30)->nullable();
            $table->string('fech_fina_cnt')->nullable();
            $table->string('fech_cese_cnt')->nullable();
            $table->string('codi_proy_pin', 4)->nullable()->comment('Campo no utilizado');
            $table->string('codi_depe_ctr', 4)->nullable();
            $table->string('ubic_fisi_ctr', 4)->nullable();
            $table->string('codi_carg_ctr', 8)->nullable();
            $table->string('codi_enca_ctr', 8)->nullable();
            $table->string('secu_func_sfu', 4)->nullable()->comment('Código de la Meta');
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('mont_cont_ctr')->nullable();
            $table->string('nume_part_cnt')->nullable();
            $table->string('mont_part_cnt')->nullable();
            $table->string('deno_part_cnt', 150)->nullable();
            $table->string('act2_cont_cnt', 70)->nullable();
            $table->string('func_cont_cnt', 3500)->nullable();
            $table->string('deno_cont', 20)->nullable();
            $table->string('nume_proc_con', 5)->nullable();
            $table->string('fech_proc_con')->nullable();
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('cont_refe_con', 4)->nullable();
            $table->string('codi_proy_pry', 3)->nullable()->comment('Código de Proyecto(Cadena Funcional)');
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('numero_archivo', 8)->nullable()->comment('Campo no utilizado');
            $table->string('cert_pres_num', 20)->nullable()->comment('Numero del documento origen');
            $table->string('user_crea', 25)->nullable();
            $table->string('fech_crea')->nullable();
            $table->string('user_modif', 25)->nullable();
            $table->string('fech_modif')->nullable();
            $table->string('cargo_cnfz', 1)->nullable();
            $table->string('codi_empl_rep', 8)->nullable();
            $table->string('codi_carg_rep', 200)->nullable();
            $table->string('resol_rep', 500)->nullable();
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
        Schema::dropIfExists('contratos');
    }
}
