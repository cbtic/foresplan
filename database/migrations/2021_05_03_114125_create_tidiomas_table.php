<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTidiomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tidiomas');
        Schema::create('tidiomas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_idio_tid', 2)->nullable();
            $table->string('desc_idio_tid', 20)->nullable();
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
        Schema::dropIfExists('tidiomas');
    }
}
