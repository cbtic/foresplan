<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablasMaestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablas_maestras', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('tipo',50);
			$table->string('denominacion',100);
			$table->bigInteger('orden')->nullable();
			$table->string('codigo',3)->nullable();
			$table->string('tipo_nombre',100)->nullable();
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
        //Schema::dropIfExists('tablas_maestras');
    }
}
