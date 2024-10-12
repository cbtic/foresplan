<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('vacaciones');
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código del empleado');
            $table->string('ano_peri_vac', 4)->nullable()->comment('Año o período');
            $table->string('nume_peri_vac', 2)->nullable()->comment('Mes');
            $table->string('fech_inic_vac')->nullable();
            $table->string('fech_fina_vac')->nullable();
            $table->string('id_corr')->nullable();
            $table->string('id_corrant')->nullable();
            $table->string('fg_estado', 1)->nullable()->comment('1 GOZADO');
            $table->string('fech_registro')->nullable();
            $table->string('secu_oper_ope', 5)->nullable();
            $table->string('nume_reso_ope', 25)->nullable();
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
        Schema::dropIfExists('vacaciones');
    }
}
