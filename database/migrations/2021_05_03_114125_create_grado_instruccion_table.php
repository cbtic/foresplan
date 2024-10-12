<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoInstruccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('grado_instruccion');
        Schema::create('grado_instruccion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_grad_ins', 2)->nullable();
            $table->string('codi_tipo_grd', 2)->nullable();
            $table->string('desc_grad_ins', 100)->nullable();
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
        Schema::dropIfExists('grado_instruccion');
    }
}
