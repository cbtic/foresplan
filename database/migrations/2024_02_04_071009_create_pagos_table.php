<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_modulo')->unsigned()->index();
            $table->bigInteger('pk_registro')->unsigned()->index();
            $table->datetime('fecha')->nullable();
            $table->string('comprobante_serie',10);
			$table->bigInteger('comprobante_numero')->unsigned()->index()->nullable();
			$table->string('comprobante_tipo',2)->nullable();
			$table->string('comprobante_destinatario',100)->nullable();
			$table->string('comprobante_direccion',200)->nullable();
			$table->string('comprobante_ruc',20)->nullable();
			$table->double('subtotal',15,8)->nullable();
			$table->double('impuesto',15,8)->nullable();
			$table->double('total',15,8)->nullable();
			$table->string('letras',200)->nullable();
			$table->Integer('id_moneda')->nullable();
			$table->double('impuesto_factor',15,8)->nullable();
			$table->double('tipo_cambio',15,8)->nullable();
            $table->bigInteger('id_forma_pago')->unsigned()->index()->nullable();
			$table->string('estado_pago',1)->nullable();
			$table->datetime('fecha_pago')->nullable();
			$table->datetime('fecha_recepcion')->nullable();
			$table->datetime('fecha_vencimiento')->nullable();
			$table->datetime('fecha_programado')->nullable();
			$table->string('observacion',500)->nullable();
			$table->string('anulado',1)->nullable();
			$table->string('afecta',20)->nullable();
            $table->bigInteger('id_caja_ingreso')->nullable()->unsigned()->index();
            $table->string('estado',1)->nullable()->default('1');

            $table->bigInteger('id_usuario_inserta')->unsigned()->index();
			$table->bigInteger('id_usuario_actualiza')->nullable()->unsigned()->index();

            $table->foreign('id_caja_ingreso')->references('id')->on('caja_ingresos');

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
        //Schema::dropIfExists('pagos');
    }
}
