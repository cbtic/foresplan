<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenCompraDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_orden_compra')->nullable();
            $table->bigInteger('id_producto')->nullable();
            $table->Integer('cantidad')->nullable();
            $table->double('precio')->nullable();
            $table->bigInteger('id_descuento')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('igv')->nullable();
            $table->double('total')->nullable();
            $table->date('fecha_fabricacion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->bigInteger('id_estado_producto')->nullable();
            $table->bigInteger('id_unidad_medida')->nullable();
            $table->bigInteger('id_marca')->nullable();
            $table->string('estado',1)->nullable()->default('1');

            $table->bigInteger('id_usuario_inserta')->unsigned()->index();
			$table->bigInteger('id_usuario_actualiza')->nullable()->unsigned()->index();

            $table->foreign('id_orden_compra')->references('id')->on('orden_compras');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_marca')->references('id')->on('marcas');

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
        Schema::dropIfExists('orden_compra_detalles');
    }
}
