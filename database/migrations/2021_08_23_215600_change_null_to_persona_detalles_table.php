<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullToPersonaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persona_detalles', function (Blueprint $table) {
            //DB::statement("ALTER TABLE persona_detalles ALTER column  DROP NOT NULL;");

            DB::statement("ALTER TABLE persona_detalles ALTER column direccion DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column ubigeo DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column telefono DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column email DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column foto DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column fecha_ingreso DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_condicion_laboral DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_tipo_planilla DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_profesion DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_banco_sueldo DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column num_cuenta_sueldo DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column cci_sueldo DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_regimen_pensionario DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_afp DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column fecha_afiliacion_afp DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_tipo_comision_afp DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column cuspp DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column fecha_cese DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column fecha_termino_contrato DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column num_contrato DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_cargo DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_nivel DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_banco_cts DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column num_cuenta_cts DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column id_moneda_cts DROP NOT NULL;");
            DB::statement("ALTER TABLE persona_detalles ALTER column estado DROP NOT NULL;");            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persona_detalles', function (Blueprint $table) {
            //
        });
    }
}
