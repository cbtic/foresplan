<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertipresCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('certipres_cab');
        Schema::create('certipres_cab', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('cert_pres_id', 12)->nullable();
            $table->string('cert_pres_ori', 3)->nullable();
            $table->string('cert_pres_ano', 4)->nullable();
            $table->string('cert_pres_num', 20)->nullable();
            $table->string('esta_cert_pre', 1)->nullable();
            $table->string('cert_pres_fec')->nullable();
            $table->string('cert_pres_tip', 1)->nullable();
            $table->string('cert_pres_obs', 2000)->nullable();
            $table->string('cert_mnto_sol')->nullable();
            $table->string('cert_mnto_ano')->nullable();
            $table->string('cert_mnto_sal')->nullable();
            $table->string('user_crea', 20)->nullable();
            $table->string('fech_crea')->nullable();
            $table->string('user_modi', 20)->nullable();
            $table->string('fech_modi')->nullable();
            $table->string('tipo_camb_cer')->nullable();
            $table->string('siaf_cod_doc', 3)->nullable();
            $table->string('siaf_num_doc', 20)->nullable();
            $table->string('siaf_fech_env')->nullable();
            $table->string('codi_fuen_fto', 4)->nullable();
            $table->string('cert_tipo_id', 1)->nullable();
            $table->string('cert_ruc', 11)->nullable();
            $table->string('cert_tipo_ope', 2)->nullable();
            $table->string('intf_cer', 10)->nullable();
            $table->string('intf_sec', 4)->nullable();
            $table->string('intf_cor', 4)->nullable();
            $table->string('exis_cert_pre', 1)->nullable();
            $table->string('cert_pres_cer', 10)->nullable();
            $table->string('cert_pres_sec', 4)->nullable();
            $table->string('cert_pres_cor', 4)->nullable();
            $table->string('tipo_registro', 1)->nullable();
            $table->string('mone_cert_pre', 5)->nullable();
            $table->string('cert_pres_eta', 1)->nullable();
            $table->string('cert_mnto_sol_mon')->nullable();
            $table->string('cert_mnto_ano_mon')->nullable();
            $table->string('codi_cont_con', 8)->nullable();
            $table->string('corr_certif', 4)->nullable();
            $table->string('nota_cert_pre', 100)->nullable();
            $table->string('codi_cert_gru')->nullable()->comment('Codigo de Grupo');
            $table->string('codi_cert_sub')->nullable()->comment('Codigo de Subgrupo');
            $table->string('fech_anul_cert')->nullable();
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
        Schema::dropIfExists('certipres_cab');
    }
}
