<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoSuspensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_suspension');
        Schema::create('tipo_suspension', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_susp_sus', 2)->nullable()->comment('Código de Tipo de Supervisión');
            $table->string('desc_susp_sus', 200)->nullable()->comment('Descripción');
            $table->string('codi_rtps_sus', 10)->nullable()->comment('Código usado en la planilla electrónica');
            $table->string('flag_acti_sus', 1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
            $table->string('tipo_apli_sus', 2)->nullable()->comment('Determina el tipo de aplicación. lc=para licencias, vc=para vacaciones ó fl=para faltas.');
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
        Schema::dropIfExists('tipo_suspension');
    }
}
