<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTprofesionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tprofesiones');
        Schema::create('tprofesiones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_prof_tpr', 3)->nullable()->comment('Código de Profesión');
            $table->string('nomb_prof_tpr', 55)->nullable();
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
        Schema::dropIfExists('tprofesiones');
    }
}
