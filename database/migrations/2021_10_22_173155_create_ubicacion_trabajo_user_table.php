<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionTrabajoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_trabajo_user', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id')->unsigned()->index();
			$table->bigInteger('ubicacion_trabajo_id')->unsigned()->index();
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
        Schema::dropIfExists('ubicacion_trabajo_user');
    }
}
