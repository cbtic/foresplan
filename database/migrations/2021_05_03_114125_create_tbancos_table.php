<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbancos');
        Schema::create('tbancos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_banc_tbc', 2)->nullable();
            $table->string('nomb_banc_tbc', 40)->nullable();
            $table->string('nomb_cort_tbc', 20)->nullable();
            $table->string('flag_activ_ban', 1)->nullable();
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
        Schema::dropIfExists('tbancos');
    }
}
