<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuentesFtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fuentes_fto');
        Schema::create('fuentes_fto', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('desc_fuen_fto', 60)->nullable();
            $table->string('esta_fuen_fto', 1)->nullable();
            $table->string('desc_cort_fto', 20)->nullable();
            $table->string('corr_comp_fte', 3)->nullable();
            $table->string('pref_fuen_fto', 2)->nullable();
            $table->string('clas_fuen_fto', 1)->nullable();
            $table->string('esta_fuen_log', 1)->nullable();
            $table->string('rubr_fuen_fto', 2)->nullable();
            $table->string('codigo_siaf', 2)->nullable();
            $table->string('ind_tipofto', 1)->nullable();
            $table->string('flag_acti_tpa', 1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
            $table->string('siaf_convenio', 3)->nullable();
            $table->string('id_fuen_grupo')->nullable();
            $table->string('codigo_fte', 1)->nullable();
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
        Schema::dropIfExists('fuentes_fto');
    }
}
