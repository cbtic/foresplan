<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdiasFeriadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdias_feriados', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fech_feri_tdf');
            $table->string('flag_mdia_tdf', 1)->nullable();
            $table->timestamp('sali_mdia_tdf')->nullable();
            $table->string('moti_feri_tdf', 250)->nullable()->comment('Descripcion del feriado');
            $table->string('flag_nlab_tdf', 1)->nullable()->comment('Indica si es un dia no laborable. 1 = si, 0 = no');
            $table->timestamp('fech_frec_tdf')->nullable();
            $table->timestamp('fech_irec_tdf')->nullable();
            $table->string('flag_recu_tdf',1)->nullable();
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
        Schema::dropIfExists('tdias_feriados');
    }
}
