<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_terceros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tercero_id');
            $table->unsignedBigInteger('medio_pago_id');
            $table->text('descripcion');
            $table->text('observacion')->nullable();
            $table->decimal('importe', 12, 2);
            $table->date('fecha_emision');
            $table->date('fecha_pago');
            $table->boolean('retencion')->default(false);
            $table->decimal('importe_retenido', 12, 2)->nullable();
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
        Schema::dropIfExists('recibos_terceros');
    }
}
