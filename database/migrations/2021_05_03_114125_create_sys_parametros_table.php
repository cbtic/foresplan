<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_parametros');
        Schema::create('sys_parametros', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nom_var_par', 15)->nullable();
            $table->string('desc_var_par', 80)->nullable();
            $table->string('valor_nume_par')->nullable();
            $table->string('valor_char_par', 200)->nullable();
            $table->string('valor_date_par')->nullable();
            $table->string('tipo_dato_par', 1)->nullable();
            $table->string('esta_var_par', 1)->nullable();
            $table->string('peri_anno_par', 4)->nullable();
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
        Schema::dropIfExists('sys_parametros');
    }
}
