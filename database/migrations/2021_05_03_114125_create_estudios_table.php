<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('estudios');
        Schema::create('estudios', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('nume_secu_est')->nullable();
            $table->string('tipo_estu_est', 1)->nullable();
            $table->string('codi_pais_tpa', 4)->nullable()->comment('Código de País');
            $table->string('codi_prof_tpr', 3)->nullable()->comment('Código de Profesión');
            $table->string('codi_univ_tun', 3)->nullable();
            $table->string('regi_titu_est', 15)->nullable()->comment('Titulo/Estudios');
            $table->string('fech_expe_est')->nullable();
            $table->string('nume_cole_est', 15)->nullable();
            $table->string('cicl_estu_est', 2)->nullable();
            $table->string('rotu_prof_est', 30)->nullable();
            $table->string('obse_estu_est', 40)->nullable();
            $table->string('flag_supe_est', 1)->nullable();
            $table->string('cond_est_est', 30)->nullable();
            $table->string('nomb_espc_est', 1000)->nullable();
            $table->string('cent_estu_est', 250)->nullable();
            $table->string('flag_titu_est', 1)->nullable();
            $table->string('codi_grad_ins', 2)->nullable();
            $table->string('codi_tipo_grd', 2)->nullable();
            $table->string('fech_inic_est')->nullable();
            $table->string('fech_fina_est')->nullable();
            $table->string('califi_fina_est', 10)->nullable();
            $table->string('lugr_estu_est', 200)->nullable();
            $table->string('hora_lect_est')->nullable();
            $table->string('codi_clas_cap', 2)->nullable()->comment('Código de Tipo de Capacitación');
            $table->string('codi_tipo_cap', 2)->nullable();
            $table->string('codi_moda_cap', 2)->nullable();
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
        Schema::dropIfExists('estudios');
    }
}
