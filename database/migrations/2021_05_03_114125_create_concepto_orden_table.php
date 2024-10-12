<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptoOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('concepto_orden');
        Schema::create('concepto_orden', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('id_orden')->nullable();
            $table->string('codi_conc_tco', 7)->nullable()->comment('Código de Concepto');
            $table->string('ord_conc', 3)->nullable();
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
        Schema::dropIfExists('concepto_orden');
    }
}
