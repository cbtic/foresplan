<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesGrupoCabTablaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_grupo_cab_tabla');
        Schema::create('evaluaciones_grupo_cab_tabla', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_grup_egc')->nullable()->comment('Código del Grupo de Evaluación');
            $table->string('desc_eval_evp', 500)->nullable();
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
        Schema::dropIfExists('evaluaciones_grupo_cab_tabla');
    }
}
