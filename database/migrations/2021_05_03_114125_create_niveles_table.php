<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('niveles');
        Schema::create('niveles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_nive_nvl', 3)->nullable()->comment('Código de Nivel');
            $table->string('desc_nive_nvl', 55)->nullable();
            $table->string('nive_viat_nvi', 3)->nullable();
            $table->string('desc_cort_nvl', 10)->nullable();
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
        Schema::dropIfExists('niveles');
    }
}
