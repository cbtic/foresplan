<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiaMensualCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pia_mensual_cab');
        Schema::create('pia_mensual_cab', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('id_proyecto')->nullable();
            $table->string('ds_po', 25)->nullable();
            $table->string('id_obje_estra', 10)->nullable();
            $table->string('id_acci_estra', 10)->nullable();
            $table->string('id_unid_org', 10)->nullable();
            $table->string('id_cent_costo', 15)->nullable();
            $table->string('id_unidad_responsable', 15)->nullable();
            $table->string('id_act_maes', 10)->nullable();
            $table->string('id_tar_maes', 10)->nullable();
            $table->string('id_unidad_medida')->nullable();
            $table->string('anno_ejec_eje', 4)->nullable();
            $table->string('cade_func_mef', 4)->nullable();
            $table->string('meta_anio_fis')->nullable();
            $table->string('meta_mes_fis')->nullable();
            $table->string('poi_tot')->nullable();
            $table->string('poi_mod')->nullable();
            $table->string('codi_fuen_fto', 4)->nullable();
            $table->string('codi_fuen_rub', 4)->nullable();
            $table->string('gasto_modo', 50)->nullable();
            $table->string('sec_func', 4)->nullable();
            $table->string('tipo_bserv', 50)->nullable()->comment('B: Bienes S:Servicios P:Planilla');
            $table->string('anio_eje', 4)->nullable();
            $table->string('ds_observacion', 50)->nullable();
            $table->string('id_pmc', 5)->nullable();
            $table->string('user_crea', 50)->nullable();
            $table->string('fech_crea')->nullable();
            $table->string('user_modif', 50)->nullable();
            $table->string('fech_modif')->nullable();
            $table->string('id_anio')->nullable();
            $table->string('id_po')->nullable();
            $table->string('id_piamensual_cab')->nullable();
            $table->string('flag_act_pia', 1)->nullable();
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
        Schema::dropIfExists('pia_mensual_cab');
    }
}
