<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdTipoOperacionToDetaOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE deta_operaciones ALTER COLUMN 
                      id_tipo_operacion TYPE integer USING (trim(id_tipo_operacion)::integer)');
        DB::statement('ALTER TABLE deta_operaciones ALTER COLUMN 
                  id_persona TYPE integer USING (trim(id_persona)::integer)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deta_operaciones', function (Blueprint $table) {
            //
        });
    }
}
