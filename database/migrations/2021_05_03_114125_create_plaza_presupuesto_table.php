<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazaPresupuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plaza_presupuesto');
        Schema::create('plaza_presupuesto', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('iden_pap_pap')->nullable();
            $table->string('codi_plaz_pla', 8)->nullable()->comment('Codigo de Plaza');
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('clas_gast_gas', 20)->nullable()->comment('Clasificador de Gasto');
            $table->string('nume_peri_pla')->nullable();
            $table->string('impo_pres_pla')->nullable();
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
        Schema::dropIfExists('plaza_presupuesto');
    }
}
