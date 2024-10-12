<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomasCursadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('idiomas_cursados');
        Schema::create('idiomas_cursados', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('codi_idio_tid', 2)->nullable();
            $table->string('cond_estu_idi', 1)->nullable();
            $table->string('cent_estu_idi', 50)->nullable();
            $table->string('obse_estu_idi', 50)->nullable();
            $table->string('tipo_info_idi', 2)->nullable();
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
        Schema::dropIfExists('idiomas_cursados');
    }
}
