<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('tabla')->nullable();
			$table->bigInteger('id_registro')->unsigned()->index();
			$table->bigInteger('id_ubicacion')->unsigned()->index();
			$table->string('estado','1')->default('1');
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
        Schema::dropIfExists('tabla_ubicaciones');
    }
}
