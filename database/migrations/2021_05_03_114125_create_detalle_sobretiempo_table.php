<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSobretiempoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('detalle_sobretiempo');
        Schema::create('detalle_sobretiempo', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('fech_oper_dst')->nullable();
            $table->string('secu_oper_dst', 5)->nullable();
            $table->string('mint_sobr_dst')->nullable();
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
        Schema::dropIfExists('detalle_sobretiempo');
    }
}
