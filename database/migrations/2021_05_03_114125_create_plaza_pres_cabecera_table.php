<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazaPresCabeceraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plaza_pres_cabecera');
        Schema::create('plaza_pres_cabecera', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('iden_pap_pap')->nullable();
            $table->string('anno_pres_pla', 4)->nullable();
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('codi_grup_pla', 3)->nullable();
            $table->string('nume_pap_pap')->nullable();
            $table->string('nume_vers_pla')->nullable();
            $table->string('fech_apro_pap')->nullable();
            $table->string('docu_apro_pap', 100)->nullable();
            $table->string('obse_apro_pap', 1000)->nullable();
            $table->string('esta_pap_pap', 1)->nullable();
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
        Schema::dropIfExists('plaza_pres_cabecera');
    }
}
