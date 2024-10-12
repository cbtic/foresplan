<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcumuConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('acumu_conceptos');
        Schema::create('acumu_conceptos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_acum_tac', 5)->nullable();
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('flag_usar_tca', 1)->nullable();
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
        Schema::dropIfExists('acumu_conceptos');
    }
}
