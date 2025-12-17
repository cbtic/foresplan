<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSedesAddEsPrincipalDeletedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sedes', function (Blueprint $table) {
          $table->boolean('es_principal')->default(false)->after('estado');
          $table->softDeletes(); // agrega deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sedes', function (Blueprint $table) {
          $table->dropColumn('es_principal');
          $table->dropSoftDeletes();
        });
    }
}
