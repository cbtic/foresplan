<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tcargos');
        Schema::create('tcargos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_carg_tca', 8)->nullable()->comment('Código del Cargo del Personal');
            $table->string('desc_carg_tca', 150)->nullable()->comment('Descripción del Cargo');
            $table->string('suel_carg_tca')->nullable();
            $table->string('orde_carg_tca', 2)->nullable();
            $table->string('codi_nive_tni', 3)->nullable()->comment('Código de Nivel');
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
        Schema::dropIfExists('tcargos');
    }
}
