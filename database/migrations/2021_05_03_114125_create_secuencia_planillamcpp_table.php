<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecuenciaPlanillamcppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('secuencia_planillamcpp');
        Schema::create('secuencia_planillamcpp', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('ano_peri_tpe', 4)->nullable();
            $table->string('nume_peri_tpe', 2)->nullable();
            $table->string('tipo_mcpp_stp', 2)->nullable();
            $table->string('clase_mcpp_stp', 2)->nullable();
            $table->string('secu_plan_mcp', 4)->nullable();
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
        Schema::dropIfExists('secuencia_planillamcpp');
    }
}
