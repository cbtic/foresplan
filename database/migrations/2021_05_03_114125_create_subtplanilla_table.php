<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtplanillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('subtplanilla');
        Schema::create('subtplanilla', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_stp', 1)->nullable();
            $table->string('desc_subt_stp', 40)->nullable();
            $table->string('titu_subt_stp', 100)->nullable();
            $table->string('tipo_docu_tpd', 3)->nullable();
            $table->string('tipo_mcpp_stp', 2)->nullable();
            $table->string('clase_mcpp_stp', 2)->nullable();
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
        Schema::dropIfExists('subtplanilla');
    }
}
