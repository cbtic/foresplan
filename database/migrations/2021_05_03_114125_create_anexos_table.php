<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('anexos');
        Schema::create('anexos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_anex_anx', 9)->nullable()->comment('Código de Anexo');
            $table->string('codi_cont_con', 8)->nullable()->comment('Código único de Contratista');
            $table->string('tipo_anex_tan', 3)->nullable()->comment('Tipo de Anexo');
            $table->string('desc_anex_anx', 1000)->nullable()->comment('Descripción del Anexo');
            $table->string('nume_rucs_anx', 11)->nullable()->comment('Número de RUC');
            $table->string('codi_orig_anx', 8)->nullable()->comment('Código Original Anexo');
            $table->string('sec_ejec_r', 6)->nullable();
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
        Schema::dropIfExists('anexos');
    }
}
