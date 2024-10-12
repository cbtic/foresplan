<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmotivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tmotivos');
        Schema::create('tmotivos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_moti_tmo', 4)->nullable();
            $table->string('desc_moti_tmo', 55)->nullable();
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
        Schema::dropIfExists('tmotivos');
    }
}
