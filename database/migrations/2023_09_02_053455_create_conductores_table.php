<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->string('licencia');
            $table->date('fecha_licencia');
            $table->enum('estado', ['ACTIVO', 'CANCELADO']);
            $table->bigInteger('id_personas')->unsigned()->index();
            $table->timestamps();
            //Foreign Keys
            $table->foreign('id_personas')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('conductores');
    }
}
