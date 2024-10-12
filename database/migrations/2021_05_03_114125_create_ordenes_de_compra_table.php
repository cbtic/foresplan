<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ordenes_de_compra');
        Schema::create('ordenes_de_compra', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('ano_proc_oco', 4)->nullable()->comment('Año del Proceso');
            $table->string('nro_orde_oco', 5)->nullable()->comment('Código de la Orden de Compra o Servicio');
            $table->string('tipo_bser_oco', 1)->nullable()->comment('Tipo de Orden (B = Bien, S = Servicio)');
            $table->string('tipo_ppto_tpr', 4)->nullable()->comment('Tipo de Presupuesto');
            $table->string('fval_coti_oco')->nullable()->comment('Campo no utilizado');
            $table->string('ano_proc_pse', 4)->nullable()->comment('Año del proceso de seleccion');
            $table->string('codi_sele_pse', 2)->nullable()->comment('Campo no utilizado');
            $table->string('codi_alma_alm', 3)->nullable()->comment('Código de Almacen INEI');
            $table->string('orig_orde_oco', 1)->nullable()->comment('Origen de la orden (t=contrato,r=registro de adquisisiones,p=proceso de seleccion)');
            $table->string('nro_plan_adqu', 5)->nullable()->comment('Campo no utilizado');
            $table->string('codi_cont_con', 8)->nullable()->comment('Código único de Contratista');
            $table->string('ano_proc_pla', 4)->nullable()->comment('Campo no utilizado');
            $table->string('mes_cale_oco', 2)->nullable()->comment('Mes de la orden');
            $table->string('fech_orde_oco')->nullable()->comment('Fecha de la orden');
            $table->string('nro_cont_oco', 5)->nullable()->comment('Campo no utilizado');
            $table->string('soli_coti_oco', 5)->nullable()->comment('Campo no utilizado');
            $table->string('nro_coti_oco', 5)->nullable()->comment('Campo no utilizado');
            $table->string('plaz_entr_oco', 80)->nullable()->comment('Campo no utilizado');
            $table->string('tpo_gara_oco', 80)->nullable()->comment('Garantia');
            $table->string('tipo_mone_oco', 1)->nullable()->comment('Tipo moneda');
            $table->string('tipo_camb_oco')->nullable()->comment('Tipo de cambio');
            $table->string('espe_tecn_oco', 500)->nullable()->comment('Especificacion tecnica');
            $table->string('tipo_comp_oco', 40)->nullable()->comment('Campo no utilizado');
            $table->string('fech_canc_oco')->nullable()->comment('Campo no utilizado');
            $table->string('fte_fina_oco', 4)->nullable()->comment('Campo no utilizado');
            $table->string('codi_area_oco', 4)->nullable()->comment('Campo no utilizado');
            $table->string('nro_rece_oco', 5)->nullable()->comment('Campo no utilizado');
            $table->string('fech_rece_oco')->nullable()->comment('Campo no utilizado');
            $table->string('fech_urec_oco')->nullable()->comment('Campo no utilizado');
            $table->string('nro_guia_oco')->nullable()->comment('Campo no utilizado');
            $table->string('incl_igv_oco', 1)->nullable()->comment('Incluye igv (s=si)');
            $table->string('incl_dsct_oco', 1)->nullable()->comment('Campo no utilizado');
            $table->string('porc_igv_oco')->nullable()->comment('Campo no utilizado');
            $table->string('mto_tota_oco')->nullable()->comment('Monto total de la orden');
            $table->string('tota_dsct_oco')->nullable()->comment('Descuento');
            $table->string('sub_total_oco')->nullable()->comment('Sub total');
            $table->string('tota_igv_oco')->nullable()->comment('Total igv soles');
            $table->string('tota_fact_oco')->nullable()->comment('Monto a facturar a soles');
            $table->string('tota_dola_oco')->nullable()->comment('Monto a facturar en dolares');
            $table->string('dsct_dola_oco')->nullable()->comment('Descuento en dolares');
            $table->string('subt_dola_oco')->nullable()->comment('Sub total en dolares');
            $table->string('igv_dola_oco')->nullable()->comment('Monto igv en dolares');
            $table->string('fact_dola_oco')->nullable()->comment('Total a facturar en dolares');
            $table->string('sit_orde_oco', 1)->nullable()->comment('Situacion de la orden (0=pendiente, 1=compromiso total, 2=atendido parcial, 3=atendido total, 4=anulado, 5=compromiso parcial)');
            $table->string('num_regi_cab', 8)->nullable()->comment('Código del registro de cabecera');
            $table->string('fech_comp_cab')->nullable()->comment('Campo no utilizado');
            $table->string('fech_regi_oco')->nullable()->comment('Fecha de registro de la orden');
            $table->string('nro_fact_oco', 20)->nullable()->comment('Campo no utilizado');
            $table->string('desc_apro_oco', 100)->nullable()->comment('Campo no utilizado');
            $table->string('resp_apro_oco', 80)->nullable()->comment('Campo no utilizado');
            $table->string('fech_apro_oco')->nullable()->comment('Campo no utilizado');
            $table->string('nro_adde_cco', 2)->nullable()->comment('Nro contrato');
            $table->string('incl_rete_oco', 1)->nullable()->comment('Incluye retencion (s=si)');
            $table->string('incl_fonv_oco', 1)->nullable()->comment('Campo no utilizado');
            $table->string('codi_inst_ins', 8)->nullable()->comment('Código de la Institución');
            $table->string('tota_otro_oco')->nullable()->comment('Campo no utilizado');
            $table->string('dola_otro_oco')->nullable()->comment('Campo no utilizado');
            $table->string('nro_soli_srm', 100)->nullable()->comment('Campo no utilizado');
            $table->string('ies_sole_oco')->nullable()->comment('Campo no utilizado');
            $table->string('ies_dola_oco')->nullable()->comment('Campo no utilizado');
            $table->string('rta_sole_oco')->nullable()->comment('Monto retencion en soles');
            $table->string('rta_dola_oco')->nullable()->comment('Monto retencion en dolares');
            $table->string('flag_alma_oco', 1)->nullable()->comment('Ingreso almacen (1=pendiente, 2=generado, 3=en almacen)');
            $table->string('codi_pais_tpa', 4)->nullable()->comment('Código de País');
            $table->string('cond_adic_oco', 4000)->nullable()->comment('Campo no utilizado');
            $table->string('codi_bid_oco', 10)->nullable()->comment('Campo no utilizado');
            $table->string('codi_cont_cco', 12)->nullable()->comment('Código de Contrato');
            $table->string('fech_apro_bid')->nullable()->comment('Campo no utilizado');
            $table->string('codi_regi_adq', 12)->nullable()->comment('Código del Registro de Adquisiciones');
            $table->string('codi_norm_sel', 2)->nullable()->comment('Código de la Norma de Selección');
            $table->string('orig_proc_adq', 1)->nullable()->comment('Codigo del objeto del proceso de seleccion');
            $table->string('nume_nobj_cco', 50)->nullable()->comment('Numero de objecion');
            $table->string('codi_sede_sed', 3)->nullable()->comment('Código de la Sede');
            $table->string('codi_proc_adq', 12)->nullable()->comment('Código del Proceso de Adquisición');
            $table->string('nume_conv_pse')->nullable()->comment('Número de convocatoria');
            $table->string('nume_proc_pse', 5)->nullable()->comment('Numero del proceso de seleccion');
            $table->string('codi_proc_sel', 2)->nullable()->comment('Código del Proceso de Selección');
            $table->string('codi_obje_pro', 2)->nullable()->comment('Código del Objeto del Proceso');
            $table->string('codi_proc_paa', 12)->nullable()->comment('Código del Consolidado del Plan de Adquisición');
            $table->string('codi_nume_rnp', 12)->nullable()->comment('Codigo del requerimiento no programado');
            $table->string('user_crea', 30)->nullable()->comment('Usuario que crea el registro');
            $table->string('fech_crea')->nullable()->comment('Fecha de creación del registro');
            $table->string('user_modi', 30)->nullable()->comment('Usuario que modifica el registro');
            $table->string('fech_modi')->nullable()->comment('Fecha de modificación');
            $table->string('user_anul', 30)->nullable()->comment('Campo no utilizado');
            $table->string('fech_anul')->nullable()->comment('Campo no utilizado');
            $table->string('tipo_proceso', 100)->nullable()->comment('Tipo de proceso');
            $table->string('tipo_comp', 1)->nullable()->comment('Tipo comprobante (r=recibo, f=factura)');
            $table->string('ext_contrato', 1)->nullable()->comment('Provienen de Extensión de Contrato (1=SI)');
            $table->string('nume_siaf', 10)->nullable();
            $table->string('codi_depe_tde', 4)->nullable();
            $table->string('flag_dupl_men', 1)->nullable();
            $table->string('fech_inic_oco')->nullable()->comment('FECHA DE INICIO');
            $table->string('fech_fin_oco')->nullable()->comment('FECHA FIN ORDEN');
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
        Schema::dropIfExists('ordenes_de_compra');
    }
}
