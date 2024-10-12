<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tablas');
        Schema::create('tablas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tab_ite1_cod', 3)->nullable();
            $table->string('tab_ite2_cod', 3)->nullable()->comment('Código de Tabla secundaria');
            $table->string('tab_larg_des', 50)->nullable();
            $table->string('tab_cort_des', 20)->nullable();
            $table->float('tab_mont_imp')->nullable();
            $table->string('tab_orde_vis', 1)->nullable();
            $table->string('tab_tabl_est', 2)->nullable();
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
        Schema::dropIfExists('tablas');
    }
}
