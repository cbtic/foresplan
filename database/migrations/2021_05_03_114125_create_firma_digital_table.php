<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmaDigitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('firma_digital');
        Schema::create('firma_digital', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('id_tipo', 20)->nullable()->comment('SISTEMA ORIGEN');
            $table->string('id_firm_dig', 50)->nullable()->comment('CODIGO UNICO');
            $table->string('fech_firma')->nullable()->comment('FECHA DE FIRMA');
            $table->string('user_firma', 30)->nullable()->comment('USUARIO FIRMANTE');
            $table->string('ubic_arch_firm', 200)->nullable()->comment('UBICACION DEL ARCHIVO EN EL SERVIDOR');
            $table->string('is_signed', 1)->nullable()->comment('FLAG SI ESTA FIRMADO');
            $table->string('id_version')->nullable();
            $table->string('fech_anula')->nullable();
            $table->string('user_anula', 30)->nullable();
            $table->string('est_firma', 1)->nullable();
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
        Schema::dropIfExists('firma_digital');
    }
}
