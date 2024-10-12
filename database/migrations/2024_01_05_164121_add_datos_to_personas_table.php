<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatosToPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('sexo');
            $table->Integer('id_sexo')->nullable();
            $table->string('grupo_sanguineo',5)->nullable();
            $table->string('id_ubigeo_nacimiento',6)->nullable();
            $table->string('lugar_nacimiento',200)->nullable();
            $table->Integer('id_nacionalidad')->nullable();            
            $table->string('numero_ruc', 11)->nullable();  
            $table->string('desc_cliente_Sunat',300)->nullable();
            $table->string('direccion_sunat',400)->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            //
        });
    }
}
