<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiConcTco1ToConceptoOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        DB::statement('ALTER TABLE concepto_ordenes ALTER COLUMN 
                      id_concepto TYPE integer USING (trim(id_concepto)::integer)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concepto_ordenes', function (Blueprint $table) {
            //
        });
    }
}
