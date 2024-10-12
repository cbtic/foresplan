<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tdependencias');
        Schema::create('tdependencias', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('desc_depe_tde', 150)->nullable();
            $table->string('depe_auto_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('flag_auto_tde', 1)->nullable();
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_ejec_eje', 4)->nullable()->comment('Campo no utilizado');
            $table->string('flag_info_inf', 1)->nullable();
            $table->string('orde_cap_tde')->nullable();
            $table->string('tipo_depe_tde', 2)->nullable();
            $table->string('flag_orga_tde', 3)->nullable()->comment('Organos : odi= de direccion, oco= de control, oas= de asesoria, oap= de apoyo, oli= de linea');
            $table->string('sigl_depe_tde', 10)->nullable()->comment('Sigla');
            $table->string('id_cent_costo', 10)->nullable();
            $table->string('flag_esta_tde', 1)->nullable()->comment('Estados: A=Activos; I=Inactivos');
            $table->string('codi_sede_pat', 3)->nullable();
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
        Schema::dropIfExists('tdependencias');
    }
}
