<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NormalizeDateFieldsInAsistenciasFixed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Normalizar campos en asistencias (timestamp a formato)
        DB::statement("
            UPDATE asistencias
            SET fech_regi_mar = to_char(
                to_timestamp(fech_regi_mar, 'YYYY-MM-DD HH24:MI:SS'), 'YYYY-MM-DD'
            )
            WHERE fech_regi_mar ~ '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$';
        ");
        DB::statement("
            UPDATE asistencias
            SET fech_marc_rel = to_char(
                to_timestamp(fech_marc_rel, 'YYYY-MM-DD HH24:MI:SS'), 'YYYY-MM-DD'
            )
            WHERE fech_marc_rel ~ '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$';
        ");
        DB::statement("
            UPDATE asistencias
            SET fech_sali_rel = to_char(
                to_timestamp(fech_sali_rel, 'YYYY-MM-DD HH24:MI:SS'), 'YYYY-MM-DD'
            )
            WHERE fech_sali_rel ~ '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$';
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No es reversible de forma segura
    }
}
