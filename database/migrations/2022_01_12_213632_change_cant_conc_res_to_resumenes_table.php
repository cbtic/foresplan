<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCantConcResToResumenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumenes', function (Blueprint $table) {
            DB::statement('ALTER TABLE resumenes ALTER COLUMN 
            cant_conc_res TYPE float8 USING (cant_conc_res)::double precision');

            DB::statement('ALTER TABLE resumenes ALTER COLUMN 
            cant_conc_rem TYPE float8 USING (cant_conc_rem)::double precision');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resumenes', function (Blueprint $table) {
            //
        });
    }
}
