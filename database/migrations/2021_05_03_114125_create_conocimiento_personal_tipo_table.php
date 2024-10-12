<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConocimientoPersonalTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conocimiento_personal_tipo');
        Schema::create('conocimiento_personal_tipo', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_cono_con', 2)->nullable();
            $table->string('desc_cono_con', 200)->nullable();
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
        Schema::dropIfExists('conocimiento_personal_tipo');
    }
}
