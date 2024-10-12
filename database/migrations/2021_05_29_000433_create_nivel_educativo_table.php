<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelEducativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_educativo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codi_nive_ned',2);
            $table->string('desc_nive_ned',100);
            $table->string('codi_rtps_ned',4);
            $table->string('flag_acti_ned',1);
            $table->string('servir',3)->nullable();

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
        Schema::dropIfExists('nivel_educativo');
    }
}
