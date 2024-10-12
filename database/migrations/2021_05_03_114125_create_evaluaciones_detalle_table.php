<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_detalle');
        Schema::create('evaluaciones_detalle', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nume_proc_evp')->nullable()->comment('Código de Evaluación');
            $table->string('nume_eval_eva')->nullable();
            $table->string('codi_crit_eva', 4)->nullable();
            $table->string('nota_obte_eva')->nullable();
            $table->string('nota_base_eva')->nullable();
            $table->string('obse_eval_eva', 3000)->nullable();
            $table->string('codi_grup_egc')->nullable()->comment('Código del Grupo de Evaluación');
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
        Schema::dropIfExists('evaluaciones_detalle');
    }
}
