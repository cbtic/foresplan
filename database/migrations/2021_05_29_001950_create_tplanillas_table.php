<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTplanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tplanillas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_plan_tpl',2);
            $table->string('desc_tipo_tpl',25);
            $table->string('tarj_inic_tpl',25)->nullable();
            $table->string('tarj_fina_tpl',25)->nullable();
            $table->string('cant_peri_tpl',25)->nullable();
            $table->string('codi_oper_ope',25)->nullable();
            $table->string('tipo_clas_tpl',25)->nullable();
            $table->string('codi_cond_lab',25)->nullable();
            $table->string('codi_anex_anx',25)->nullable();
            $table->string('codi_peri_tpe',25)->nullable();
            $table->string('tipo_docu_tpd',25)->nullable();
            $table->string('cate_pers_tpl',25)->nullable();
            $table->string('nume_dia_vac',25)->nullable();
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
        Schema::dropIfExists('tplanillas');
    }
}
