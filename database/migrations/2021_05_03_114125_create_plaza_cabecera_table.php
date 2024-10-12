<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazaCabeceraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plaza_cabecera');
        Schema::create('plaza_cabecera', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('iden_cap_cap')->nullable();
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('codi_grup_pla', 3)->nullable();
            $table->string('codi_cap_cap', 8)->nullable();
            $table->string('vers_cap_cap', 3)->nullable();
            $table->string('fech_cap_cap')->nullable();
            $table->string('docu_cap_cap', 50)->nullable();
            $table->string('obse_cap_cap', 2000)->nullable();
            $table->string('esta_cap_cap', 1)->nullable()->comment('Estado: \'0\' Activo, \'*\' Inactivo');
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
        Schema::dropIfExists('plaza_cabecera');
    }
}
