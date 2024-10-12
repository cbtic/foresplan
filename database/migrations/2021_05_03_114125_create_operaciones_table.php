<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('operaciones');
        Schema::create('operaciones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_cicl_cic', 1)->nullable()->comment('Código de Ciclo');
            $table->string('codi_oper_ope', 9)->nullable()->comment('Código de Operación');
            $table->string('nume_secu_ope', 3)->nullable();
            $table->string('clas_gast_gas', 20)->nullable()->comment('Clasificador de Gasto');
            $table->string('clas_ingr_ing', 20)->nullable()->comment('Código de Clasificador de Ingreso');
            $table->string('clas_comp_com', 20)->nullable();
            $table->string('desc_oper_ope', 80)->nullable();
            $table->string('esta_oper_ope', 1)->nullable();
            $table->string('flag_tipo_ope', 1)->nullable();
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
        Schema::dropIfExists('operaciones');
    }
}
