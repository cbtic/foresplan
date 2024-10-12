<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote_productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_producto')->unsigned()->index();
            $table->bigInteger('numero_lote')->nullable()->index();
            $table->string('numero_serie',50)->nullable();
            $table->Integer('id_unidad_medida')->nullable();
            $table->bigInteger('cantidad')->nullable();
            $table->double('costo',15,8)->nullable();
            $table->Integer('id_moneda')->nullable();
            $table->date('fecha_fabricacion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->Integer('id_anaquel')->nullable();
            $table->string('estado',1)->nullable()->default('1');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_anaquel')->references('id')->on('anaqueles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('lote_productos');
    }
}
