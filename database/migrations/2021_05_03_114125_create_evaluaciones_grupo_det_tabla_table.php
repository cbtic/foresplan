<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesGrupoDetTablaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_grupo_det_tabla');
        Schema::create('evaluaciones_grupo_det_tabla', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_grup_egc')->nullable()->comment('Código del Grupo de Evaluación');
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('codi_grup_pla', 3)->nullable();
            $table->string('codi_plaz_pla', 8)->nullable()->comment('Codigo de Plaza');
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
        Schema::dropIfExists('evaluaciones_grupo_det_tabla');
    }
}
