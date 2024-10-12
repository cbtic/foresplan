<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestroPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('maestro_personal');
        Schema::create('maestro_personal', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable()->comment('Código único de personal');
            $table->string('ape_pat_per', 30)->nullable();
            $table->string('ape_mat_per', 30)->nullable();
            $table->string('nom_emp_per', 30)->nullable();
            $table->string('nomb_cort_per', 60)->nullable()->comment('Nombre del Personal');
            $table->string('dir_emp_per', 200)->nullable();
            $table->string('codi_depa_dpt', 2)->nullable()->comment('Código de Departamento');
            $table->string('codi_prov_tpr', 2)->nullable()->comment('Código de Provincia');
            $table->string('codi_dist_tdi', 2)->nullable()->comment('Código de Distrito');
            $table->string('num_tel_per', 50)->nullable();
            $table->string('fec_ing_per')->nullable();
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('est_civ_per', 1)->nullable()->comment('1:SOLTERO, 2:CASADO, 3:VIUDO, 4:DIVORCIADO, 5:CONVIVIENTE, 6:SEPARADO');
            $table->string('sex_emp_per', 1)->nullable();
            $table->string('gra_ins_per', 1)->nullable()->comment('Grado de Intrucción del Personal');
            $table->string('fec_nac_per')->nullable();
            $table->string('pais_naci_tpa', 4)->nullable()->comment('Pais de Nacimiento del Personal');
            $table->string('depa_naci_dpt', 2)->nullable();
            $table->string('prov_naci_tpr', 2)->nullable();
            $table->string('dist_naci_tdi', 2)->nullable();
            $table->string('codi_depe_tde', 4)->nullable()->comment('Código de Dependencia');
            $table->string('ubic_fisi_tde', 4)->nullable();
            $table->string('codi_nive_tni', 3)->nullable()->comment('Código de Nivel');
            $table->string('nive_enc_tni', 3)->nullable();
            $table->string('esta_trab_per', 1)->nullable();
            $table->string('con_tra_per', 2)->nullable()->comment('Tipo de Contrato');
            $table->string('reg_lab_per', 8)->nullable();
            $table->string('reg_pen_per', 8)->nullable();
            $table->string('codi_carg_tca', 8)->nullable()->comment('Código del Cargo del Personal');
            $table->string('carg_enc_tca', 8)->nullable();
            $table->string('flag_afp_per', 1)->nullable();
            $table->string('codi_afp', 2)->nullable()->comment('Código AFP');
            $table->string('fech_afp_per')->nullable();
            $table->string('codi_cuspp_per', 20)->nullable();
            $table->string('libr_elec_per', 20)->nullable();
            $table->string('libr_mili_per', 10)->nullable()->comment('Número de Documento');
            $table->string('codi_ipss_per', 16)->nullable();
            $table->string('nume_brev_per', 15)->nullable()->comment('Número de Brevete');
            $table->string('gru_sang_per', 4)->nullable();
            $table->string('cod_mon_suel_per', 2)->nullable();
            $table->string('flag_suel_per', 1)->nullable();
            $table->string('banc_suel_tbc', 2)->nullable();
            $table->string('suel_cta_per', 32)->nullable()->comment('De 18 a 25');
            $table->string('banc_cts_tbc', 2)->nullable()->comment('Codigo del banco para el deposito de cts');
            $table->string('cts_cta_per', 18)->nullable()->comment('Numero de cuenta para el deposito de cts');
            $table->string('cod_mon_cts_per', 2)->nullable();
            $table->string('nume_plaz_per', 8)->nullable();
            $table->string('fech_rnom_per')->nullable();
            $table->string('bloq_dato_per', 1)->nullable()->comment('0:Desbloqueado para editar, 1:Bloqueado para editar');
            $table->string('sede_actu_per', 3)->nullable();
            $table->string('fing_adm_per')->nullable();
            $table->string('fing_carrp_per')->nullable();
            $table->string('otro_docu_per', 15)->nullable();
            $table->string('observa_per', 100)->nullable()->comment('email Personal');
            $table->string('cargo_remu_per', 8)->nullable();
            $table->string('nivel_remu_per', 3)->nullable();
            $table->string('plaza_remu_per', 8)->nullable();
            $table->string('depe_remu_per', 4)->nullable();
            $table->string('obser_remu_per', 100)->nullable();
            $table->string('tipo_cuen_per', 1)->nullable();
            $table->string('segu_medi_per', 1)->nullable();
            $table->string('sede_remu_per', 3)->nullable();
            $table->string('apep_solt_per', 30)->nullable();
            $table->string('apem_solt_per', 30)->nullable();
            $table->string('nomb_solt_er', 30)->nullable();
            $table->string('codi_prof_tpr', 3)->nullable()->comment('Código de Profesión');
            $table->string('fech_cese_per')->nullable();
            $table->string('nume_pasa_per', 12)->nullable();
            $table->string('anno_prog_pla', 4)->nullable()->comment('Codigo de Plaza');
            $table->string('codi_plaz_pla', 8)->nullable();
            $table->string('codi_ante_per', 8)->nullable();
            $table->string('nive_viat_nvi', 3)->nullable();
            $table->string('codi_cond_lab', 2)->nullable()->comment('Código de Condición Laboral del Personal');
            $table->string('flag_mosc_per', 1)->nullable();
            $table->string('tipo_docu_per', 2)->nullable();
            $table->string('nume_celu_per', 10)->nullable();
            $table->string('codi_nive_nvl', 3)->nullable()->comment('Código de Nivel');
            $table->string('cant_anno_exp')->nullable();
            $table->string('cant_mese_exp')->nullable();
            $table->string('plaz_enca_per', 4)->nullable();
            $table->string('nume_depe_per')->nullable();
            $table->string('flag_afil_eps', 1)->nullable();
            $table->string('codi_jefe_per', 8)->nullable();
            $table->string('sctr_pens_per', 1)->nullable()->comment('Sctr pensión. 0=ninguno, 1=onp, 2=seguro privado');
            $table->string('essa_vida_per', 1)->nullable()->comment('Indica si tiene essalud + vida. 1=tiene, 0=no tiene');
            $table->string('indi_domi_per', 1)->nullable()->comment('Indicador de domiciliado. 1=domiciliado 2=no domiciliado');
            $table->string('codi_tvia_tvi', 2)->nullable()->comment('Código del tipo de vía');
            $table->string('nume_tvia_per', 10)->nullable()->comment('Número de vía');
            $table->string('inte_tvia_per', 10)->nullable()->comment('Interior');
            $table->string('codi_zona_tzo', 4)->nullable()->comment('Código del tipo de zona');
            $table->string('nomb_zona_per', 30)->nullable()->comment('Nombre de la zona');
            $table->string('refe_domi_per', 100)->nullable()->comment('Referencia del domicilio');
            $table->string('codi_pers_tpe', 4)->nullable()->comment('Código de Tipo de Personal');
            $table->string('codi_nive_ned', 2)->nullable()->comment('Código del nivel educativo');
            $table->string('codi_ocup_ocu', 4)->nullable()->comment('Código de la ocupación');
            $table->string('indi_disc_per', 1)->nullable()->comment('Indicador de discapacidad. 1=si, 0=no');
            $table->string('codi_regi_rpe', 4)->nullable()->comment('Código del regimen pensionario');
            $table->string('fech_incr_per')->nullable()->comment('Fecha de inscripción al regimen pensionario');
            $table->string('codi_cont_tco', 4)->nullable()->comment('Código del tipo de contrato');
            $table->string('regi_alte_per', 1)->nullable()->comment('Indicador de regimen alternativo. 1=si, 0=no');
            $table->string('hora_maxi_per', 1)->nullable()->comment('Indicador de jornada de trabajo máxima. 1=si, 0=no');
            $table->string('hora_noct_per', 1)->nullable()->comment('Indicador horario nocturno. 1=si, 0=no');
            $table->string('codi_enti_ent', 8)->nullable()->comment('Código del eps');
            $table->string('codi_situ_sem', 4)->nullable()->comment('Código de la situación del empleado');
            $table->string('rent_exon_per', 1)->nullable()->comment('Indicador de rentas de quinta exoneradas. 1=si, 0=no');
            $table->string('codi_pago_tpa', 4)->nullable()->comment('Código del tipo de pago');
            $table->string('indi_madr_per', 1)->nullable()->comment('Indicador madre con responsabilidad. 1=si, 0=no');
            $table->string('cent_form_per', 1)->nullable()->comment('Tipo de centro formativo');
            $table->string('codi_cont_con', 8)->nullable()->comment('Código único de Contratista');
            $table->string('codi_sede_sem', 3)->nullable()->comment('Código de la sede de la empresa donde labora');
            $table->string('cate_empl_per', 1)->nullable()->comment('Categoría del empleado');
            $table->string('codi_moti_mce', 4)->nullable()->comment('Código del motivo de cese');
            $table->string('codi_moda_mfo', 4)->nullable()->comment('Código de la modalidad formativo. sólo practicantes');
            $table->string('sctr_salu_per', 1)->nullable()->comment('Sctr salud. 0=ninguno, 1=essalud, 2=eps');
            $table->string('indi_sind_per', 1)->nullable()->comment('Indicador es sindicalizado. 1=si, 0=no');
            $table->string('afil_eps_per', 1)->nullable()->comment('Indicador afiliado a eps. 1=si, 0=no');
            $table->string('indi_qnta_per', 1)->nullable()->comment('Indicador otros ingresos 5ta cat. 1=si, 0=no');
            $table->string('situ_espe_per', 1)->nullable()->comment('Indicador situación especial');
            $table->string('medi_pres_per', 1)->nullable();
            $table->string('anio_ejer_per', 4)->nullable();
            $table->string('fech_pres_per')->nullable();
            $table->string('soli_susp_per', 15)->nullable();
            $table->string('tipo_cont_per', 2)->nullable();
            $table->string('aseg_pens_per', 1)->nullable()->comment('Indicador de afiliación asegura tu pensión. 1=si, 0=no');
            $table->string('codi_cate_cto', 4)->nullable()->comment('Codigo de la categoría ocupacional del empleado');
            $table->string('codi_conv_ctr', 4)->nullable()->comment('Codigo del convenio para tributación del empleado');
            $table->string('fech_term_cnt')->nullable()->comment('Fecha de término de contrato para el cálculo de la planilla');
            $table->string('imag_foto_per')->nullable();
            $table->string('numero_registro', 8)->nullable()->comment('Registro de firma digitalizada');
            $table->string('numero_archivo', 8)->nullable()->comment('Campo no utilizado');
            $table->string('numero_foto', 8)->nullable();
            $table->string('nume_agen_cts', 4)->nullable()->comment('Numero de agencia para el deposito de pago de cts');
            $table->string('nume_segu_cts', 2)->nullable()->comment('Numero de control para el deposito de pago de cts');
            $table->string('tipo_mone_cts', 1)->nullable()->comment('Tipo de moneda para cts');
            $table->string('user_crea', 20)->nullable()->comment('Usuario que crea el registro');
            $table->string('fech_crea')->nullable()->comment('Fecha de creación del registro');
            $table->string('user_modi', 20)->nullable()->comment('Usuario que modifica el registro');
            $table->string('fech_modi')->nullable()->comment('Fecha de modificación');
            $table->string('num_recon_per', 30)->nullable();
            $table->string('codi_rel_per', 10)->nullable();
            $table->string('num_cel_per', 10)->nullable();
            $table->string('tel_emer_per', 30)->nullable();
            $table->string('nomb_emer_per', 50)->nullable();
            $table->string('codi_regsal')->nullable();
            $table->string('fg_reqpoa', 1)->nullable();
            $table->string('dir1_mz', 5)->nullable()->comment('Manzana de la Dirección 1.');
            $table->string('dir1_lote', 5)->nullable()->comment('Lote de la Dirección 1.');
            $table->string('dir1_km', 5)->nullable()->comment('Kilómetro de la Dirección 1.');
            $table->string('dir1_block', 20)->nullable()->comment('Block de la Dirección 1.');
            $table->string('dir1_etapa', 20)->nullable()->comment('Etapa de la Dirección 1.');
            $table->string('dir1_dpto', 5)->nullable()->comment('Departamento de la Dirección 1.');
            $table->string('dir1_nomb_via', 70)->nullable()->comment('Nombre de vía de la Dirección 1.');
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
            $table->string('dir2_codi_zona', 4)->nullable()->comment('Código del Tipo de zona de la Dirección 2.');
            $table->string('dir2_nomb_zona', 50)->nullable()->comment('Nombre de zona de la Dirección 2.');
            $table->string('dir2_referencia', 50)->nullable()->comment('Referencia de la Dirección 2.');
            $table->string('dir2_ubi_depa', 2)->nullable()->comment('Departamento de la Dirección 2.');
            $table->string('dir2_ubi_prov', 2)->nullable()->comment('Provincia de la Dirección 2.');
            $table->string('dir2_ubi_dist', 2)->nullable()->comment('Distrito de la Dirección 2.');
            $table->string('codi_telf_cldn', 2)->nullable()->comment('Código de larga distancia nacional del teléfono');
            $table->string('ruc_5cat_per', 11)->nullable()->comment('RUC de la empresa del cual el trabajador percibe otras rentas de quinta categoría.');
            $table->string('codi_pais_doc', 4)->nullable()->comment('Código del país emisor del documento');
            $table->string('flag_arti_per', 1)->nullable();
            $table->string('fg_essalud', 1)->nullable();
            $table->string('esta_rep_leg', 1)->nullable();
            $table->string('emai_empl_per', 100)->nullable()->comment('Email de trabajador');
            $table->string('cci_cta_per', 60)->nullable();
            $table->string('flag_comi_afp', 1)->nullable();
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
        Schema::dropIfExists('maestro_personal');
    }
}
