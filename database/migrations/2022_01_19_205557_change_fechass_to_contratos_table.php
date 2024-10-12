<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFechassToContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            DB::statement("ALTER TABLE contratos ALTER COLUMN fech_reso_cnt TYPE TIMESTAMP without time zone USING(fech_reso_cnt::timestamp)");
            DB::statement("ALTER TABLE contratos ALTER COLUMN fech_fina_cnt TYPE TIMESTAMP without time zone USING(fech_fina_cnt::timestamp)");
            DB::statement("ALTER TABLE contratos ALTER COLUMN fech_cese_cnt TYPE TIMESTAMP without time zone USING(fech_cese_cnt::timestamp)");
            DB::statement("ALTER TABLE contratos ALTER COLUMN fech_proc_con TYPE TIMESTAMP without time zone USING(fech_proc_con::timestamp)");                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratos', function (Blueprint $table) {
            //
        });
    }
}
