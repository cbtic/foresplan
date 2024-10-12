<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_operacion');
        Schema::create('tipo_operacion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_oper_top', 2)->nullable()->comment('No se usa');
            $table->string('tipo_oper_top', 1)->nullable()->comment('No se usa');
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('desc_oper_top', 50)->nullable();
            $table->string('cont_dias_top', 1)->nullable();
            $table->string('nume_dias_top')->nullable();
            $table->string('desc_pago_top', 1)->nullable();
            $table->string('veri_reso_top', 1)->nullable();
            $table->string('dcto_cts_top', 1)->nullable();
            $table->string('clas_oper_top', 2)->nullable();
            $table->string('flag_omis_top', 1)->nullable();
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
        Schema::dropIfExists('tipo_operacion');
    }
}
