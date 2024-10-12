<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->integer('id_condicion_pago')->nullable();
            $table->integer('nro_cuotas')->nullable();
            $table->integer('detraccion')->nullable();
            $table->integer('id_detra_cod_bos')->nullable();
            $table->integer('id_detra_medio')->nullable();
            $table->bigInteger('id_comprobante_ncnd')->nullable()->index();
            $table->string('tipo_detrac',3)->nullable(); 
            $table->string('afecta_detrac',3)->nullable(); 
            $table->string('medio_pago_detrac',3)->nullable(); 
            $table->string('destinatario_2',100)->nullable();
			$table->string('direccion_2',200)->nullable();
			$table->string('cod_tributario_2',20)->nullable();
            $table->string('correo_des_2',100)->nullable();
            $table->bigInteger('correlativo_exp')->nullable();
            $table->double('total_credito',17,2)->nullable();
            $table->string('afecta_caja',1)->nullable();            
            $table->bigInteger('id_persona')->nullable();
            $table->bigInteger('id_empresa')->nullable(); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            //
        });
    }
}
