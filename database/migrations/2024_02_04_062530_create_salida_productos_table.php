<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_productos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_salida')->nullable();
            $table->Integer('id_tipo_documento')->nullable();
            $table->string('unidad_destino',50)->nullable();

            $table->bigInteger('numero_comprobante')->nullable();
            $table->date('fecha_comprobante')->nullable();
            $table->Integer('id_moneda')->nullable();
            $table->double('tipo_cambio_dolar')->nullable();
            $table->double('sub_total_compra')->nullable();
            $table->double('igv_compra')->nullable();
            $table->double('total_compra')->nullable();
            $table->string('cerrado',1)->nullable()->default('0');
            $table->string('observacion')->nullable();

            $table->string('estado',1)->nullable()->default('1');
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
        //Schema::dropIfExists('salida_productos');
    }
}
