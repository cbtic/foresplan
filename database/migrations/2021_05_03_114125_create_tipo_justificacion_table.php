<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoJustificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_justificacion');
        Schema::create('tipo_justificacion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_just_jus', 2)->nullable()->comment('Codigo del tipo de justificacion.');
            $table->string('desc_just_jus', 100)->nullable()->comment('Descripcion del tipo de justificacion.');
            $table->string('flag_deta_jus', 1)->nullable()->comment('Flag que indica que el tipo de justificacion requiere detalle en el registro de justificaciones por trabajador.');
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
        Schema::dropIfExists('tipo_justificacion');
    }
}
