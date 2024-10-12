<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones');
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nume_proc_evp')->nullable()->comment('Código de Evaluación');
            $table->string('nume_eval_eva')->nullable();
            $table->string('tipo_eval_eva', 2)->nullable();
            $table->string('corr_eval_eva', 2)->nullable();
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_eval_eva', 8)->nullable();
            $table->string('rela_eval_eva', 2)->nullable();
            $table->string('fech_eval_eva');
            $table->string('nota_obte_eva')->nullable();
            $table->string('nota_base_eva')->nullable();
            $table->string('desc_eval_eva', 3000)->nullable();
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
        Schema::dropIfExists('evaluaciones');
    }
}
