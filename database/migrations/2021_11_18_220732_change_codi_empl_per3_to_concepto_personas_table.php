<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiEmplPer3ToConceptoPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concepto_personas', function (Blueprint $table) { 
            DB::statement('ALTER TABLE concepto_personas ALTER COLUMN 
                  	  id_planilla TYPE integer USING (trim(id_planilla)::integer)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concepto_personas', function (Blueprint $table) {
            //
        });
    }
}
