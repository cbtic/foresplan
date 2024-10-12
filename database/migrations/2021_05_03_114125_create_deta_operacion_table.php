<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetaOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('deta_operacion');
        Schema::create('deta_operacion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('fech_oper_ope')->nullable()->comment('Fecha');
            $table->string('codi_oper_top', 2)->nullable()->comment('Código de la operación');
            $table->string('codi_empl_per', 8)->nullable()->comment('Código del empleado');
            $table->string('tipo_oper_top', 1)->nullable()->comment('Tipo de operación');
            $table->string('fech_inic_ope')->nullable()->comment('Fecha de inicio');
            $table->string('fech_fina_ope')->nullable()->comment('Fecha de término');
            $table->string('nume_dias_ope')->nullable()->comment('Cantidad de dia');
            $table->string('nume_reso_ope', 80)->nullable()->comment('Número de documento');
            $table->string('nomb_auto_ope', 35)->nullable()->comment('Nombre de quien autoriza');
            $table->string('fech_reso_ope')->nullable()->comment('Fecha del documento');
            $table->string('tipo_hora_ope', 1)->nullable();
            $table->string('fech_elab_ope')->nullable()->comment('Fecha de elaboración');
            $table->string('nume_minut_ope')->nullable();
            $table->string('secu_oper_ope', 10)->nullable();
            $table->string('esta_oper_ope', 1)->nullable()->comment('Estado de la operación');
            $table->string('obse_oper_ope', 300)->nullable()->comment('Observacion de la operación');
            $table->string('codi_relo_per', 8)->nullable()->comment('Codigo del reloj');
            $table->string('nro_citt_ope', 25)->nullable();
            $table->string('nro_sevit_ope', 90)->nullable();
            $table->string('nro_medi_ope', 200)->nullable();
            $table->string('obse_jefe_ope', 300)->nullable()->comment('Observacio del Jefe');
            $table->string('obse_rrhh_ope', 300)->nullable()->comment('Observaciond e RRHH');
            $table->string('rowidi', 10)->nullable();
            $table->string('num_archivo', 8)->nullable()->comment('Número de archivo');
            $table->string('codi_moti_tmo', 4)->nullable()->comment('Codigo del Motivo');
            $table->string('user_crea', 20)->nullable();
            $table->string('fech_crea')->nullable();
            $table->string('user_modi', 20)->nullable();
            $table->string('fech_modi')->nullable();
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
        Schema::dropIfExists('deta_operacion');
    }
}
