<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSubtPlanStpToSubtplanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subtplanillas', function (Blueprint $table) {
            $table->renameColumn('subt_plan_stp', 'id_planilla');
        });
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
