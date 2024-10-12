<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNumePeriTpe1ToTperiodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tperiodos', function (Blueprint $table) {
            DB::statement('ALTER TABLE tperiodos ALTER COLUMN 
                        id_mes TYPE integer USING (trim(id_mes)::integer)');
        });
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
