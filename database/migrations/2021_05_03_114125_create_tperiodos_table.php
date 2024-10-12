<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTperiodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tperiodos');
        Schema::create('tperiodos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_plan_tpl', 2)->nullable()->comment('Código de Sub Planilla');
            $table->string('subt_plan_tpl', 1)->nullable()->comment('Año');
            $table->string('ano_peri_tpe', 4)->nullable()->comment('Mes');
            $table->string('nume_peri_tpe', 2)->nullable();
            $table->string('fech_inic_tpe')->nullable();
            $table->string('fech_fina_tpe')->nullable();
            $table->string('desc_peri_tpe', 30)->nullable()->comment('Descripción del Periodo');
            $table->string('esta_plan_tpe', 1)->nullable();
            $table->string('fech_resu_tpe')->nullable();
            $table->string('usua_resu_tpe', 18)->nullable();
            $table->string('fech_proc_tpe')->nullable();
            $table->string('usua_proc_tpe', 18)->nullable();
            $table->string('fech_cier_tpe')->nullable();
            $table->string('usua_cier_tpe', 18)->nullable();
            $table->string('ultm_repo_tpe')->nullable();
            $table->string('num_regi_cab', 8)->nullable()->comment('Código del registro de cabecera');
            $table->string('hora_comp_tpe')->nullable();
            $table->string('esta_asis_tpe', 1)->nullable();
            $table->string('esta_reci_tpe', 1)->nullable();
            $table->string('nume_orde_oco', 5)->nullable();
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('cert_pres_id', 12)->nullable()->comment('Código de la certificacion presupuestal');
            $table->string('esta_plan_cer', 1)->nullable();
            $table->string('fech_pago_tpe')->nullable()->comment('Fecha de Pago');
            $table->string('fech_inic_plan')->nullable()->comment('Fecha Inicio de Asistenciia');
            $table->string('fech_fina_plan')->nullable()->comment('Fecha de fin de Asistencia');
            $table->string('fech_crea')->nullable()->comment('Usuario que crea');
            $table->string('user_crea', 20)->nullable();
            $table->string('fech_modi')->nullable()->comment('fecha de modificacion');
            $table->string('user_modi', 20)->nullable()->comment('Usuario de Modificación');
            $table->string('fech_pdt_tpe')->nullable();
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
        Schema::dropIfExists('tperiodos');
    }
}
