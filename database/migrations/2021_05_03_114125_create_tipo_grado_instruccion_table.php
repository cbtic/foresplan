<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoGradoInstruccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_grado_instruccion');
        Schema::create('tipo_grado_instruccion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_tipo_grd', 2)->nullable();
            $table->string('desc_tipo_grd', 50)->nullable();
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
        Schema::dropIfExists('tipo_grado_instruccion');
    }
}
