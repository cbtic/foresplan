<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie',50)->nullable();
            $table->string('codigo',12)->nullable();
            $table->string('denominacion')->nullable();
            $table->Integer('id_unidad_medida')->nullable();
            $table->bigInteger('stock_actual')->nullable();
            $table->double('precio_unitario',15,8)->nullable();
            $table->Integer('id_moneda')->nullable();
            $table->Integer('id_tipo_producto')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->Integer('id_estado_bien')->nullable();
            $table->bigInteger('stock_minimo')->nullable();
            $table->Integer('id_marca')->nullable();
            $table->string('observacion')->nullable();
            $table->Integer('id_anaquel')->nullable();

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
        //Schema::dropIfExists('productos');
    }
}
