<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('condicion_laboral');
        Schema::create('condicion_laboral', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('desc_cond_lab', 50)->nullable();
            $table->string('nomb_cort_lab', 10)->nullable();
            $table->string('flag_vinc_lab', 1)->nullable();
            $table->string('servir', 2)->nullable();
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
        Schema::dropIfExists('condicion_laboral');
    }
}
