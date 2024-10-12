<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCambioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_cambio');
        Schema::create('tipo_cambio', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('fech_camb_tip');
            $table->string('simb_mone_mon', 5)->nullable()->comment('Tipo de Moneda');
            $table->string('valo_dola_tip')->nullable();
            $table->string('valo_sole_tip')->nullable()->comment('Venta');
            $table->string('sole_comp_tip')->nullable()->comment('Compra');
            $table->string('valo_bid_tip')->nullable();
            $table->string('valo_birf_tip')->nullable();
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
        Schema::dropIfExists('tipo_cambio');
    }
}
