<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipoPlanTpl1ToPlanillaCalculadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::table('planilla_calculadas', function (Blueprint $table) {
            DB::statement('ALTER TABLE planilla_calculadas ALTER COLUMN 
                  	  id_planilla TYPE integer USING (trim(id_planilla)::integer)');
			DB::statement('ALTER TABLE planilla_calculadas ALTER COLUMN 
                  	  id_subplanilla TYPE integer USING (trim(id_subplanilla)::integer)');
			DB::statement('ALTER TABLE planilla_calculadas ALTER COLUMN 
                  	  id_concepto TYPE integer USING (trim(id_concepto)::integer)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planilla_calculadas', function (Blueprint $table) {
            //
        });
    }
}
