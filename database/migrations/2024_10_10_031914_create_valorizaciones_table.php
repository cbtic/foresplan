<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorizaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_modulo')->unsigned()->index();
            $table->bigInteger('pk_registro')->unsigned()->index();
            $table->bigInteger('id_concepto')->unsigned()->index();
            $table->bigInteger('id_agremido')->nullable();
            $table->bigInteger('id_empresa')->nullable();            
            $table->bigInteger('id_persona')->unsigned()->index()->nullable();
            $table->datetime('fecha')->nullable();    
            $table->double('monto',17,2)->nullable();
            $table->bigInteger('id_comprobante')->nullable();            
            $table->bigInteger('id_moneda')->unsigned()->index()->nullable();
			$table->string('moneda',50)->nullable();
            $table->double('descuento_porcentaje',17,2)->nullable();            
            $table->datetime('fecha_proceso')->nullable();
            $table->string('descripcion',300)->nullable();
            $table->string('pagado',1)->nullable()->default('0');
            $table->bigInteger('pk_fraccionamiento')->unsigned()->index()->nullable();
            $table->bigInteger('codigo_fraccionamiento')->unsigned()->index()->nullable();
            //$table->integer('id_familia')->nullable()->unsigned()->index(); 
            $table->integer('id_pronto_pago')->nullable()->unsigned()->index();            
                
            $table->double('valor_unitario',17,2)->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('otro_concepto',1)->nullable()->default('0');
            $table->string('exonerado',1)->nullable()->default('0');
            $table->string('exonerado_motivo',5000)->nullable();
            $table->string('pagado_post',1)->nullable()->default('0');
            $table->string('nro_operacion_pos',250)->nullable();
            $table->date('fecha_pago_pos')->nullable();
            $table->string('estado',1)->nullable()->default('1');

            $table->bigInteger('id_usuario_inserta')->unsigned()->index();
			$table->bigInteger('id_usuario_actualiza')->nullable()->unsigned()->index();

           // $table->foreign('id_pronto_pago')->references('id')->on('pronto_pagos'); 
           // $table->foreign('id_modulo')->references('id')->on('modulos');
            //$table->foreign('id_concepto')->references('id')->on('conceptos');


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
        Schema::dropIfExists('valorizaciones');
    }
}
