<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesGrupoCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_grupo_criterios');
        Schema::create('evaluaciones_grupo_criterios', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nume_proc_evp')->nullable()->comment('Código de Evaluación');
            $table->string('codi_grup_egc')->nullable()->comment('Código del Grupo de Evaluación');
            $table->string('codi_crit_eva', 4)->nullable();
            $table->string('porc_crit_eva')->nullable();
            $table->string('punt_maxi_eva')->nullable();
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
        Schema::dropIfExists('evaluaciones_grupo_criterios');
    }
}
