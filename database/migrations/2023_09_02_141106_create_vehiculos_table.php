<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('placa',10);
            $table->integer('ejes');
            $table->integer('peso_tracto')->nullable()->default(2);
            $table->integer('peso_carreta')->nullable()->default(2);
            $table->integer('peso_seco')->nullable()->default(2);
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
        //Schema::dropIfExists('vehiculos');
    }
}
