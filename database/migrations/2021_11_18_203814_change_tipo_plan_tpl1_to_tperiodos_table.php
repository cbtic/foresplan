<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipoPlanTpl1ToTperiodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
            DB::statement('ALTER TABLE tperiodos ALTER COLUMN 
                      id_planilla TYPE integer USING (trim(id_planilla)::integer)');
        	DB::statement('ALTER TABLE tperiodos ALTER COLUMN 
                  	  id_subplanilla TYPE integer USING (trim(id_subplanilla)::integer)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tperiodos', function (Blueprint $table) {
            //
        });
    }
}
