<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->enum('tipo_documento', ['DNI', 'CARNET_EXTRANJERIA', 'PASAPORTE', 'CEDULA', 'PTP/PTEP']);
            $table->string('numero_documento');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['F', 'M']);
            $table->string('estado',1)->default('1');

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
        //Schema::dropIfExists('personas');
    }
}
