<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('meses');
        Schema::create('meses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nro_mes', 2)->nullable()->comment('Código del Mes');
            $table->string('nombre_mes', 10)->nullable()->comment('Nombre del Mes');
            $table->string('trim_mes', 1)->nullable()->comment('Código de Trimestre');
            $table->string('nombre_trim', 3)->nullable()->comment('Nombre de Trimestre');
            $table->string('abre_mes', 3)->nullable();
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
        Schema::dropIfExists('meses');
    }
}
