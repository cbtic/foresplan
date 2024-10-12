<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSubtPlanStp2ToSubtplanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        DB::statement('ALTER TABLE subtplanillas ALTER COLUMN 
                      id_planilla TYPE integer USING (trim(id_planilla)::integer)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subtplanillas', function (Blueprint $table) {
            //
        });
    }
}
