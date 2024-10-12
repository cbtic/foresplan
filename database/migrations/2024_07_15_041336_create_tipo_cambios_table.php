<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cambios', function (Blueprint $table) {
            $table->id();
			$table->datetime('fecha')->nullable();
			$table->bigInteger('id_tipo_moneda_compra')->unsigned()->index()->nullable();
			$table->bigInteger('id_tipo_moneda_venta')->unsigned()->index()->nullable();
			$table->decimal('valor_compra',12,3)->nullable();
			$table->decimal('valor_venta',12,3)->nullable();
			$table->string('estado',1)->nullable();
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
        Schema::dropIfExists('tipo_cambios');
    }
}
