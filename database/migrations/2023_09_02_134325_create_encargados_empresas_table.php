<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargadosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargados_empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_personas')->unsigned()->index();
            $table->bigInteger('id_empresas')->unsigned()->index();
            $table->string('estado',1)->default('1');
            //Foreign Keys
            $table->foreign('id_personas')->references('id')->on('personas');
            $table->foreign('id_empresas')->references('id')->on('empresas');
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
        //Schema::dropIfExists('encargados_empresas');
    }
}
