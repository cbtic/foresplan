<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_sede', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('sede_id');

            $table->unsignedBigInteger('id_usuario_inserta')->nullable();
            $table->unsignedBigInteger('id_usuario_actualiza')->nullable();

            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');      // sin onDelete('cascade')

            $table->foreign('sede_id')
                ->references('id')
                ->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_sede');
    }
}
