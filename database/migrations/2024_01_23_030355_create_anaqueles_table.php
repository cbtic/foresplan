<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnaquelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaqueles', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',12)->nullable();
            $table->string('denominacion')->nullable();
            $table->Integer('id_seccion')->nullable();
            $table->Integer('id_almacen')->nullable();
            $table->string('estado',1)->nullable()->default('1');
            $table->timestamps();

            $table->foreign('id_almacen')->references('id')->on('almacenes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('anaqueles');
    }
}
