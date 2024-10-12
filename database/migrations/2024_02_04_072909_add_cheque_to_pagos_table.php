<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChequeToPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->string('cheque_serie',20)->nullable();
            $table->string('cheque_numero',100)->nullable();            
            $table->bigInteger('id_empresa_cuenta_bancaria')->unsigned()->nullable();
            $table->string('nombre_archivo',100)->nullable();

            $table->foreign('id_empresa_cuenta_bancaria')->references('id')->on('empresa_cuenta_bancaria');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            //
        });
    }
}
