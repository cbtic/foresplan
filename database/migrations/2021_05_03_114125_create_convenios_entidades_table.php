<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosEntidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('convenios_entidades');
        Schema::create('convenios_entidades', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_enti_ent', 8)->nullable()->comment('Código del eps');
            $table->string('nomb_enti_ent', 80)->nullable();
            $table->string('repr_lega_ent', 80)->nullable();
            $table->string('num_ruc_ent', 11)->nullable();
            $table->string('codi_rtps_ent', 10)->nullable()->comment('Código usado en la planilla electrónica');
            $table->string('flag_acti_ent', 1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
            $table->string('codi_conc_tco', 5)->nullable();
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
        Schema::dropIfExists('convenios_entidades');
    }
}
