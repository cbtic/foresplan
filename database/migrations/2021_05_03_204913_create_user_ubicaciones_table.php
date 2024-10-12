<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('id_usuario')->unsigned()->index();
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
        Schema::dropIfExists('user_ubicaciones');
    }
}
