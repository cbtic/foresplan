<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NormalizeDateFieldsInAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Normalizar campos en asistencias (solo DD-MM-YYYY)
        DB::statement("
            UPDATE asistencias
            SET fech_regi_mar = to_char(
                to_timestamp(fech_regi_mar, 'DD-MM-YYYY'),
                'YYYY-MM-DD 00:00:00'
            )
            WHERE fech_regi_mar ~ '^[0-9]{2}-[0-9]{2}-[0-9]{4}$';
        ");
        DB::statement("
            UPDATE asistencias
            SET fech_marc_rel = to_char(
                to_timestamp(fech_marc_rel, 'DD-MM-YYYY'),
                'YYYY-MM-DD 00:00:00'
            )
            WHERE fech_marc_rel ~ '^[0-9]{2}-[0-9]{2}-[0-9]{4}$';
        ");
        DB::statement("
            UPDATE asistencias
            SET fech_sali_rel = to_char(
                to_timestamp(fech_sali_rel, 'DD-MM-YYYY'),
                'YYYY-MM-DD 00:00:00'
            )
            WHERE fech_sali_rel ~ '^[0-9]{2}-[0-9]{2}-[0-9]{4}$';
        ");
        DB::statement("
            UPDATE asistencias
            SET fech_sali_rel = to_char(
                to_timestamp(fech_sali_rel, 'DD-MM-YY'),
                'YYYY-MM-DD 00:00:00'
            )
            WHERE fech_sali_rel ~ '^[0-9]{2}-[0-9]{2}-[0-9]{2}$';
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
