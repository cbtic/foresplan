<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodiOperOpe1ToTplanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        DB::statement('ALTER TABLE tplanillas ALTER COLUMN  
                      id_operacion TYPE integer USING (trim(id_operacion)::integer)');
        DB::statement('ALTER TABLE tplanillas ALTER COLUMN 
                  	  id_condicion_laboral TYPE integer USING (trim(id_condicion_laboral)::integer)');
		DB::statement('ALTER TABLE tplanillas ALTER COLUMN 
                  	  id_tipo_periodo TYPE integer USING (trim(id_tipo_periodo)::integer)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tplanillas', function (Blueprint $table) {
            //
        });
    }
}
