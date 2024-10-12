<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuniversidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tuniversidades');
        Schema::create('tuniversidades', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_univ_tun', 3)->nullable();
            $table->string('desc_univ_tun', 55)->nullable();
            $table->string('tipo_cent_tun', 1)->nullable();
            $table->string('nomb_cort_tun', 10)->nullable();
            $table->string('nume_rruc_tun', 11)->nullable();
            $table->string('dire_univ_tun', 200)->nullable();
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
        Schema::dropIfExists('tuniversidades');
    }
}
