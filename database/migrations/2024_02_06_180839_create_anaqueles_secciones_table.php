<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnaquelesSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaqueles_secciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_anaqueles')->unsigned()->index();
            $table->foreign('id_anaqueles')->references('id')->on('anaqueles')->onDelete('cascade');
            $table->integer('id_secciones')->unsigned()->index();
            $table->foreign('id_secciones')->references('id')->on('secciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('anaqueles_secciones');
    }
}
