<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('id_producto')->unsigned()->index();
			$table->string('numero_lote')->nullable();
            $table->enum('tipo_movimiento', ['ENTRADA', 'SALIDA']);
            $table->double('entrada_salida_cantidad',15,8)->nullable();
            $table->double('costo_entrada_salida',15,8)->nullable();
            $table->bigInteger('id_users')->unsigned()->index();
            $table->bigInteger('id_personas')->unsigned()->index();
            $table->date('fecha_movimiento')->nullable();
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
        Schema::dropIfExists('movimientos');
    }
}
