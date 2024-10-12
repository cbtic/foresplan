<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('movimiento_personal');
        Schema::create('movimiento_personal', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('tipo_movi_mvp', 2)->nullable()->comment('Tipo movimiento. vc=vacaciones, lg=licencia c/g, ls=licencia s/g, dm=descanso médico, ds=subsidio');
            $table->string('secu_movi_mvp', 5)->nullable()->comment('Secuencia del movimiento');
            $table->string('nume_docu_mvp', 30)->nullable()->comment('Documento del movimiento');
            $table->string('fech_inic_mvp')->nullable()->comment('Fecha inicio movimiento');
            $table->string('fech_fina_mvp')->nullable()->comment('Fecha termino movimiento');
            $table->string('cant_dias_mvp')->nullable()->comment('Cantidad de días de duración del movimiento');
            $table->string('esta_movi_mvp', 1)->nullable()->comment('Estado del movimiento');
            $table->string('obse_movi_mvp', 300)->nullable()->comment('Observaciones del movimiento');
            $table->string('codi_susp_sus', 2)->nullable()->comment('Código de Tipo de Supervisión');
            $table->string('peri_gene_mvp', 9)->nullable()->comment('Periodo de generación de vacaciones');
            $table->string('flag_tipo_mvp', 1)->nullable();
            $table->string('cant_minu_mvp')->nullable();
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
        Schema::dropIfExists('movimiento_personal');
    }
}
