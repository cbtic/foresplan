<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTnivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tniveles');
        Schema::create('tniveles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_nive_tni', 3)->nullable()->comment('Código de Nivel');
            $table->string('nomb_pues_tni', 55)->nullable();
            $table->string('orde_nive_tni', 2)->nullable();
            $table->string('porc_viat_tni')->nullable();
            $table->string('porc_tras_tni')->nullable();
            $table->string('mont_fijo_tni')->nullable();
            $table->string('mont_adic_tni')->nullable();
            $table->string('cant_nive_tni')->nullable();
            $table->string('codi_nive_nvl', 3)->nullable()->comment('Código de Nivel');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('codi_cate_cat', 2)->nullable()->comment('Campo no utilizado');
            $table->string('codi_subc_sbc', 2)->nullable()->comment('Campo no utilizado');
            $table->string('codi_osit_tni', 3)->nullable();
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
        Schema::dropIfExists('tniveles');
    }
}
