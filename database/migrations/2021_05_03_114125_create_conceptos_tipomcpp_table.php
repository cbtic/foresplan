<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosTipomcppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conceptos_tipomcpp');
        Schema::create('conceptos_tipomcpp', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_conc_tco', 5)->nullable()->comment('Codigo de concepto');
            $table->string('tipo_plan_tpl', 2)->nullable()->comment('Código del tipo de planilla');
            $table->string('codi_conc_pla', 5)->nullable()->comment('Codigo del conceptos de la planilla');
            $table->string('tipo_conc_pla', 1)->nullable()->comment('Tipo de concepto planilla');
            $table->string('desc_conc_pla', 50)->nullable()->comment('Descripción del concepto planilla');
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
        Schema::dropIfExists('conceptos_tipomcpp');
    }
}
