<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesIneiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sedes_inei');
        Schema::create('sedes_inei', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('indi_agen_sed', 1)->nullable()->comment('Tipo de local. 0=sede, 1=agencia, 2=depósito');
            $table->string('desc_sede_sed', 40)->nullable()->comment('Descripción de la Sede');
            $table->string('dire_sede_sed', 100)->nullable()->comment('Dirección');
            $table->string('refe_sede_sed', 40)->nullable()->comment('Referencia');
            $table->string('tele_sede_sed', 20)->nullable()->comment('Teléfono');
            $table->string('depa_sede_sed', 2)->nullable()->comment('Departamento');
            $table->string('prov_sede_sed', 2)->nullable()->comment('Provincia');
            $table->string('dist_sede_sed', 2)->nullable()->comment('Distrito');
            $table->string('fech_regi_sed')->nullable()->comment('Fecha registro');
            $table->string('pswd_sede_sed', 8)->nullable()->comment('No se usa');
            $table->string('desc_cort_sed', 5)->nullable()->comment('No se usa');
            $table->string('resp_sede_sed', 8)->nullable();
            $table->string('nive_cent_sed', 1)->nullable();
            $table->string('codi_regi_reg', 2)->nullable();
            $table->string('codi_sede_tse', 4)->nullable()->comment('Código del tipo de establecimiento');
            $table->string('nume_codi_sed', 10)->nullable()->comment('Código del establecimiento (ficha ruc)');
            $table->string('indi_ries_sed', 1)->nullable()->comment('Indicador centro de riesgo. 0=no, 1=si');
            $table->string('tasa_ries_sed')->nullable()->comment('Tasa en caso sea centro de riesgo');
            $table->string('flag_segu_sed', 1)->nullable();
            $table->string('codi_sede_rem', 3)->nullable();
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
        Schema::dropIfExists('sedes_inei');
    }
}
