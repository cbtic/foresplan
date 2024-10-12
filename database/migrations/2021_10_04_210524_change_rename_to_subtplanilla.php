<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRenameToSubtplanilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subtplanilla', function (Blueprint $table) {
            //
        });
        Schema::rename('subtplanilla', 'subtplanillas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subtplanilla', function (Blueprint $table) {
            //
        });
    }
}
