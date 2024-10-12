<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCapacitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_capacitacion');
        Schema::create('tipo_capacitacion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_tipo_cap', 2)->nullable();
            $table->string('codi_clas_cap', 2)->nullable()->comment('Código de Tipo de Capacitación');
            $table->string('desc_tipo_cap', 50)->nullable();
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
        Schema::dropIfExists('tipo_capacitacion');
    }
}
