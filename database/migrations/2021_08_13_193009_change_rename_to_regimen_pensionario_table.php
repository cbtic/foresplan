<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRenameToRegimenPensionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regimen_pensionario', function (Blueprint $table) {
            //
        });
        Schema::rename('regimen_pensionario', 'regimen_pensionarios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regimen_pensionario', function (Blueprint $table) {
            //
        });
    }
}
