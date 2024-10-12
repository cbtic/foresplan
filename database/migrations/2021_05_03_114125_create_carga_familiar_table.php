<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaFamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('carga_familiar');
        Schema::create('carga_familiar', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('secu_fami_fam')->nullable();
            $table->string('nomb_fami_fam', 60)->nullable()->comment('Nombres');
            $table->string('fech_naci_fam')->nullable()->comment('Fecha de nacimiento');
            $table->string('tipo_pare_fam', 1)->nullable()->comment('Código del parentesco con el empleado');
            $table->string('esta_vida_fam', 1)->nullable();
            $table->string('esta_depen_fam', 1)->nullable();
            $table->string('sexo_fami_fam', 1)->nullable()->comment('Sexo. m o f');
            $table->string('ocup_fami_fam', 40)->nullable();
            $table->string('esta_civi_fam', 1)->nullable();
            $table->string('tipo_docu_fam', 2)->nullable()->comment('Tipo de documento de identidad');
            $table->string('nume_docu_fam', 20)->nullable()->comment('Nro. de documento de identidad');
            $table->string('ape_pat_fam', 25)->nullable();
            $table->string('ape_mat_fam', 25)->nullable();
            $table->string('nomb_empl_fam', 25)->nullable();
            $table->string('codi_depa_dpt', 2)->nullable()->comment('Código de Departamento');
            $table->string('codi_prov_tpr', 2)->nullable()->comment('Código de Provincia');
            $table->string('codi_dist_tdi', 2)->nullable()->comment('Código de Distrito');
            $table->string('dire_fami_fam', 80)->nullable();
            $table->string('flag_inst_fam', 1)->nullable();
            $table->string('nomb_enti_fam', 50)->nullable();
            $table->string('fech_ingr_fam')->nullable();
            $table->string('carg_fami_fam', 30)->nullable();
            $table->string('flag_publ_fam', 1)->nullable();
            $table->string('tipo_docu_pat', 2)->nullable()->comment('Código del tipo de documento que acredita la paternidad');
            $table->string('nume_docu_pat', 20)->nullable()->comment('Nro. del documento que acredita la paternidad');
            $table->string('situ_ddhh_fam', 2)->nullable()->comment('Código de la situación del derechohabiente');
            $table->string('fech_alta_fam')->nullable()->comment('Fecha de alta del derechohabiente');
            $table->string('codi_moti_mba', 4)->nullable()->comment('Código de Motivo de Baja de Personal');
            $table->string('fech_baja_fam')->nullable()->comment('Fecha de baja del derechohabiente');
            $table->string('reso_disc_fam', 20)->nullable()->comment('Numero de la resolución directoral de incapacidad de hijo mayor de edad');
            $table->string('indi_domi_tdo', 1)->nullable()->comment('Indicador de domicilio');
            $table->string('codi_zona_tzo', 4)->nullable()->comment('Domicilio - código del tipo de zona');
            $table->string('nomb_zona_fam', 40)->nullable()->comment('Domicilio - nombre de zona');
            $table->string('domi_ddhh_fam', 80)->nullable()->comment('Domicilio - nombre de vía');
            $table->string('codi_tvia_tvi', 2)->nullable()->comment('Domicilio - código del tipo de vía');
            $table->string('nume_vvia_fam', 10)->nullable()->comment('Domicilio - numero de vía');
            $table->string('refe_dire_fam', 250)->nullable()->comment('Domicilio - referencia');
            $table->string('nume_inte_fam', 10)->nullable()->comment('Domicilio - interior');
            $table->string('apel_pate_fam', 60)->nullable()->comment('Apellido paterno');
            $table->string('apel_mate_fam', 60)->nullable()->comment('Apellido materno');
            $table->string('codi_pais_doc', 4)->nullable()->comment('Código del país emisor del documento');
            $table->string('codi_tdvf', 2)->nullable()->comment('Tipo de documento que acredita vínculo familiar');
            $table->string('nro_tdvf', 20)->nullable()->comment('Número de documento que acredita vínculo familiar');
            $table->string('mes_conc', 6)->nullable()->comment('Mes de concepción, sólo para Gestante. En formato mesaño (mmyyyy).');
            $table->string('dir1_mz', 5)->nullable()->comment('Manzana de la Dirección 1.');
            $table->string('dir1_lote', 5)->nullable()->comment('Lote de la Dirección 1.');
            $table->string('dir1_km', 5)->nullable()->comment('Kilómetro de la Dirección 1.');
            $table->string('dir1_block', 20)->nullable()->comment('Block de la Dirección 1.');
            $table->string('dir1_etapa', 20)->nullable()->comment('Etapa de la Dirección 1.');
            $table->string('dir1_dpto', 5)->nullable()->comment('Departaento de la Dirección 1');
            $table->string('dir1_nomb_via', 70)->nullable()->comment('Nombre de la vía de la Dirección 1');
            $table->string('dir2_codi_via', 2)->nullable()->comment('Código del Tipo de Vía de la Dirección 2.');
            $table->string('dir2_nomb_via', 30)->nullable()->comment('Nombre de Vía de la Dirección 2.');
            $table->string('dir2_nro_via', 5)->nullable()->comment('Número de Vía de la Dirección 2.');
            $table->string('dir2_dpto', 5)->nullable()->comment('Departamento de la Dirección 2.');
            $table->string('dir2_interior', 5)->nullable()->comment('Interior de la Dirección 2.');
            $table->string('dir2_mz', 5)->nullable()->comment('Manzana de la Dirección 2.');
            $table->string('dir2_lote', 5)->nullable()->comment('Lote de la Dirección 2.');
            $table->string('dir2_km', 5)->nullable()->comment('Kilómetro de la Dirección 2.');
            $table->string('dir2_block', 20)->nullable()->comment('Block de la Dirección 2.');
            $table->string('dir2_etapa', 20)->nullable()->comment('Etapa de la Dirección 2.');
            $table->string('dir2_codi_zona', 4)->nullable()->comment('Tipo de zona de la Dirección 2.');
            $table->string('dir2_nomb_zona', 50)->nullable()->comment('Nombre de zona de la Dirección 2.');
            $table->string('dir2_referencia', 50)->nullable()->comment('Referencia de la Dirección 2.');
            $table->string('dir2_ubi_depa', 2)->nullable()->comment('Departamento del Ubigeo de la Dirección 2.');
            $table->string('dir2_ubi_prov', 2)->nullable()->comment('Provincia del Ubigeo de la Dirección 2.');
            $table->string('dir2_ubi_dist', 2)->nullable()->comment('Distrito del Ubigeo de la Dirección 2.');
            $table->string('fg_essalud', 1)->nullable()->comment('Indicador de Centro Asistencial de EsSalud; 1=Direccion1 , 2 = Dirección2');
            $table->string('codi_telf_cldn', 2)->nullable()->comment('Código de Larga Distancia Nacional del teléfono.');
            $table->string('nro_telf', 10)->nullable()->comment('Número telefónico');
            $table->string('e_mail', 50)->nullable()->comment('Correo electrónico.');
            $table->string('fg_hijo_discapacitado', 1)->nullable()->comment('Indica si el hijo del personal es discapacitado.');
            $table->string('numero_archivo', 8)->nullable()->comment('Número de  archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_familiar');
    }
}
