<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('evaluaciones_criterios');
        Schema::create('evaluaciones_criterios', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_crit_eva', 4)->nullable();
            $table->string('desc_crit_eva', 50)->nullable();
            $table->string('porc_crit_eva')->nullable();
            $table->string('punt_maxi_eva')->nullable();
            $table->string('padr_crit_eva', 1)->nullable();
            $table->string('codi_padr_eva', 4)->nullable();
            $table->string('obse_crit_eva', 2000)->nullable();
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
        Schema::dropIfExists('evaluaciones_criterios');
    }
}
