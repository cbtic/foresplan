<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_procesos');
        Schema::create('evaluaciones_procesos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nume_proc_evp')->nullable();
            $table->string('fech_inic_evp');
            $table->string('fech_fin_evp');
            $table->string('desc_eval_evp', 500)->nullable();
            $table->string('esta_proc_evp', 1)->nullable();
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
        Schema::dropIfExists('evaluaciones_procesos');
    }
}
