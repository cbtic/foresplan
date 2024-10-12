<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertipresDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('certipres_det');
        Schema::create('certipres_det', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('cert_pres_id', 12)->nullable();
            $table->string('cert_pres_sec')->nullable();
            $table->string('cert_pres_ano', 4)->nullable();
            $table->string('secu_func_sfu', 4)->nullable();
            $table->string('codi_fuen_fto', 4)->nullable();
            $table->string('clas_gast_gas', 20)->nullable();
            $table->string('cant_cert_pre')->nullable();
            $table->string('mnto_cert_pre')->nullable();
            $table->string('codi_bser_cat', 12)->nullable();
            $table->string('mnto_cert_ano')->nullable();
            $table->string('mnto_cert_sol_mon')->nullable();
            $table->string('mnto_cert_ano_mon')->nullable();
            $table->string('id_po')->nullable();
            $table->string('id_gru_gast', 100)->nullable();
            $table->string('id_sgr_gast', 100)->nullable();
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
        Schema::dropIfExists('certipres_det');
    }
}
