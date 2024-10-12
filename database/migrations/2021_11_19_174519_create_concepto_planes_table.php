<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptoPlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_planes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_planilla')->nullable();
            $table->bigInteger('id_subplanilla')->nullable();
            $table->bigInteger('id_concepto')->nullable();            
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
        Schema::dropIfExists('concepto_planes');
    }
}
