<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaMarcasRelojTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('asistencia_marcas_reloj');
        Schema::create('asistencia_marcas_reloj', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Codigo del empleado');
            $table->string('fech_marc_rel')->comment('Fecha de marcacion');
            $table->string('hora_entr_rel')->nullable()->comment('Hora de entrada');
            $table->string('hora_sali_rel')->nullable()->comment('Hora de salida');
            $table->string('refr_sali_rel')->nullable()->comment('Hora de salida al refrigerio');
            $table->string('refr_entr_rel')->nullable()->comment('Hora de retorno del refrigerio');
            $table->string('doc_iden_per', 8)->nullable()->comment('Documento de Identidad');
            $table->string('nro_doc_rel', 8)->nullable()->comment('Número de Documento');
            $table->string('fech_regi_eas')->nullable()->comment('Fecha de Registro');
            $table->string('tipo_erro_eas', 18)->nullable()->comment('Tipo de error');
            $table->string('tipo_dias_eas', 1)->nullable()->comment('Tipo de dias');
            $table->string('tipo_marc_eas', 1)->nullable()->comment('Tipo de marciones');
            $table->string('hora_marc_eas')->nullable()->comment('Hora de marcacion');
            $table->string('minu_tard_eas')->nullable()->comment('Minutos de tardanza');
            $table->string('minu_apor_eas')->nullable()->comment('Minuto de aporte');
            $table->string('minu_tole_eas')->nullable()->comment('Minutos de tolerancia');
            $table->string('minu_dife_eas')->nullable()->comment('Minutos de diferencia');
            $table->string('flag_marc_eas', 1)->nullable()->comment('Flag de boleta');
            $table->string('nume_bole_eas', 5)->nullable()->comment('Número de boleta');
            $table->string('flag_bole_eas', 1)->nullable()->comment('Flag de boleta');
            $table->string('id_corr_rel')->nullable();
            $table->string('fech_regi_mar')->nullable();
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
        Schema::dropIfExists('asistencia_marcas_reloj');
    }
}
