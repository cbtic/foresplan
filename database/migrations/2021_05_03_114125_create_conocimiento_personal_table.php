<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConocimientoPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conocimiento_personal');
        Schema::create('conocimiento_personal', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('tipo_cono_con', 2)->nullable();
            $table->string('nume_secu_con')->nullable();
            $table->string('desc_prod_con', 300)->nullable()->comment('Descripción del Conocimiento Personal');
            $table->string('nive_prod_con', 1)->nullable();
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
        Schema::dropIfExists('conocimiento_personal');
    }
}
