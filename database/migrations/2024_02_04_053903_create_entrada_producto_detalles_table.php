<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaProductoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_producto_detalles', function (Blueprint $table) {
            $table->bigInteger('id_entrada_productos')->nullable();
            $table->bigInteger('id_productos')->nullable();
            $table->Integer('item')->nullable();
            $table->Integer('cantidad')->nullable();
            $table->Integer('numero_lote')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('aplica_precio',1)->nullable();
            $table->double('precio_unitario')->nullable();
            $table->Integer('id_um')->nullable();
            $table->string('id_estado_bien',1)->nullable()->default('1');
            $table->Integer('id_marca')->nullable();
            $table->string('estado',1)->nullable()->default('1');
            $table->timestamps();

            $table->foreign('id_entrada_productos')->references('id')->on('entrada_productos');
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
        //Schema::dropIfExists('entrada_producto_detalles');
    }
}
