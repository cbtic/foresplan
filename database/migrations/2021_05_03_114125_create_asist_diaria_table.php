<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistDiariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('asist_diaria');
        Schema::create('asist_diaria', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código de Empleado');
            $table->string('fech_regi_eas')->comment('Fecha de Registro');
            $table->string('tipo_dias_dia', 1)->nullable()->comment('Tipo de dias');
            $table->string('minu_tare_dia')->nullable()->comment('Minutos tardanza entrada del día');
            $table->string('minu_tars_dia')->nullable()->comment('Minutos tardanza salida del día');
            $table->string('minu_tarr_dia')->nullable()->comment('Minutos tardanza refrigerio del día');
            $table->string('minu_taro_dia')->nullable()->comment('Minutos tardanza otros del día');
            $table->string('hora_perm_dia')->nullable()->comment('Horas de permanencia');
            $table->string('hora_trab_dia')->nullable()->comment('Horas trabajadas');
            $table->string('minu_desc_dia')->nullable()->comment('Minutos descanzo del dia');
            $table->string('minu_ext_ent')->nullable()->comment('Minutos extras entrada');
            $table->string('minu_ext_sal')->nullable()->comment('Minutos extras salida');
            $table->string('anno_peri_dia', 6)->nullable()->comment('Año del proceso');
            $table->string('tipo_dia_sem', 1)->nullable()->comment('Tipo dia de la semana');
            $table->string('dia_lab_dia', 1)->nullable()->comment('Día laborado');
            $table->string('minu_per_ref')->nullable()->comment('Minutos de permanencia');
            $table->string('min_desc_acum')->nullable()->comment('Minutos Descuento Acumulado por día');
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
        Schema::dropIfExists('asist_diaria');
    }
}
