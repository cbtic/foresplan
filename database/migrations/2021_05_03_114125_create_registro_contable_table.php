<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('registro_contable');
        Schema::create('registro_contable', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nume_regi_reg', 8)->nullable()->comment('Número de Registro Contable');
            $table->string('codi_cicl_cic', 1)->nullable()->comment('Código de Ciclo');
            $table->string('anno_docu_reg', 4)->nullable();
            $table->string('tipo_docu_reg', 3)->nullable();
            $table->string('nume_docu_reg', 25)->nullable();
            $table->string('codi_docu_reg', 5)->nullable();
            $table->string('fech_docu_reg');
            $table->string('fech_regi_reg');
            $table->string('codi_anex_anx', 9)->nullable()->comment('Código de Anexo');
            $table->string('nume_siaf_reg', 8)->nullable();
            $table->string('simb_mone_mon', 5)->nullable()->comment('Tipo de Moneda');
            $table->string('tipo_camb_reg')->nullable();
            $table->string('mnto_naci_reg')->nullable();
            $table->string('mnto_dola_reg')->nullable();
            $table->string('mnto_rete_reg')->nullable();
            $table->string('esta_regi_reg', 1)->nullable();
            $table->string('usu_cre_reg', 10)->nullable()->comment('Usuario creo registro');
            $table->string('fec_cre_reg')->nullable()->comment('Fecha de creacion de registro');
            $table->string('usu_modi_reg', 10)->nullable()->comment('Usuario modifico registro');
            $table->string('fec_modi_reg')->nullable()->comment('Fecha de modufucacion registro');
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
        Schema::dropIfExists('registro_contable');
    }
}
