<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaCuentaBancariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_cuenta_bancaria', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_empresa')->unsigned()->index();
            $table->bigInteger('id_banco')->unsigned()->index();
            $table->string('numero_cuenta',100)->nullable();
            $table->string('cci',100)->nullable();

            $table->string('estado',1)->nullable()->default('1');
            $table->bigInteger('id_usuario_inserta')->unsigned()->index();
			$table->bigInteger('id_usuario_actualiza')->nullable()->unsigned()->index();

            $table->foreign('id_empresa')->references('id')->on('empresas');


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
        //Schema::dropIfExists('empresa_cuenta_bancaria');
    }
}
