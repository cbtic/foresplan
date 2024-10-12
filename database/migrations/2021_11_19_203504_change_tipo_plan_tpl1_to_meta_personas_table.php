<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipoPlanTpl1ToMetaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_personas', function (Blueprint $table) {        
            DB::statement('ALTER TABLE meta_personas ALTER COLUMN 
                        id_persona TYPE integer USING (trim(id_persona)::integer)');
            DB::statement('ALTER TABLE meta_personas ALTER COLUMN 
                        id_planilla TYPE integer USING (trim(id_planilla)::integer)');
            DB::statement('ALTER TABLE meta_personas ALTER COLUMN 
                        id_subplanilla TYPE integer USING (trim(id_subplanilla)::integer)');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_personas', function (Blueprint $table) {
            //
        });
    }
}
