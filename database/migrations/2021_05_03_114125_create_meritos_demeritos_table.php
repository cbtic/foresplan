<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritosDemeritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('meritos_demeritos');
        Schema::create('meritos_demeritos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 10)->nullable()->comment('Código único de personal');
            $table->string('fech_reso_mde');
            $table->string('tipo_mede_mde', 1)->nullable();
            $table->string('nume_reso_mde', 50)->nullable();
            $table->string('moti_mede_mde', 55)->nullable();
            $table->string('inst_mede_mde', 50)->nullable();
            $table->string('obse_mde')->nullable();
            $table->string('codi_moti_tmo', 4)->nullable();
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
        Schema::dropIfExists('meritos_demeritos');
    }
}
