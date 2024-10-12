<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaProductoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_producto_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_salida_productos')->nullable();
            $table->bigInteger('id_productos')->nullable();
            $table->Integer('item')->nullable();
            $table->Integer('cantidad')->nullable();
            $table->Integer('numero_lote')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('aplica_precio',1)->nullable();
            $table->double('precio_unitario')->nullable();
            $table->Integer('id_um')->nullable();
            $table->string('id_estado_productos',1)->nullable()->default('1');
            $table->Integer('id_marca')->nullable();
            $table->string('estado',1)->nullable()->default('1');
            $table->timestamps();

            $table->foreign('id_salida_productos')->references('id')->on('salida_productos');
            $table->foreign('id_productos')->references('id')->on('productos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('salida_producto_detalles');
    }
}
