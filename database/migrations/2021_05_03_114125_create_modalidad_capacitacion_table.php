<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalidadCapacitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('modalidad_capacitacion');
        Schema::create('modalidad_capacitacion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_moda_cap', 2)->nullable();
            $table->string('codi_clas_cap', 2)->nullable()->comment('Código de Tipo de Capacitación');
            $table->string('codi_tipo_cap', 2)->nullable();
            $table->string('desc_moda_cap', 50)->nullable();
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
        Schema::dropIfExists('modalidad_capacitacion');
    }
}
