<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoIdentidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('documento_identidad');
        Schema::create('documento_identidad', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('docu_iden_did', 2)->nullable()->comment('Codigo del documento de identidad.');
            $table->string('desc_docu_did', 200)->nullable()->comment('Descripcion de documento de identidad.');
            $table->string('codi_rtps_did', 2)->nullable()->comment('Codigo de equivalencia con la tabla de documentos de identidad rtps.');
            $table->string('flag_acti_did', 1)->nullable()->comment('Flag que indica si e registro esta activo');
            $table->string('abre_docu_did', 5)->nullable()->comment('Abreviatura del tipo de documento.');
            $table->string('long_docu_did', 2)->nullable();
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
        Schema::dropIfExists('documento_identidad');
    }
}
