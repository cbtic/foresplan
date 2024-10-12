<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcumuladoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('acumuladores');
        Schema::create('acumuladores', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_acum_tac', 5)->nullable();
            $table->string('nomb_acum_tac', 20)->nullable();
            $table->string('mont_acum_tac')->nullable();
            $table->string('flag_ante_tac', 1)->nullable();
            $table->string('user_crea', 30)->nullable()->comment('Usuario que crea el registro');
            $table->string('fech_crea')->nullable()->comment('Fecha de creación del registro');
            $table->string('user_modi', 30)->nullable()->comment('Usuario que modifica el registro');
            $table->string('fech_modi')->nullable()->comment('Fecha de modificación');
            $table->string('tipo_acum_tac', 1)->nullable();
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
        Schema::dropIfExists('acumuladores');
    }
}
