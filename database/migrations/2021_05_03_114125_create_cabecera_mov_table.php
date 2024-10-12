<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabeceraMovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cabecera_mov');
        Schema::create('cabecera_mov', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('secu_ejec_cin', 4)->nullable()->comment('Código de la Organización');
            $table->string('anno_ejec_eje', 4)->nullable()->comment('Año de ejecución');
            $table->string('num_regi_cab', 8)->nullable()->comment('Código del registro de cabecera');
            $table->string('codi_proy_pin', 4)->nullable()->comment('Campo no utilizado');
            $table->string('codi_cicl_cic', 1)->nullable()->comment('Código de Ciclo');
            $table->string('codi_fase_fas', 1)->nullable()->comment('Código de fase');
            $table->string('codi_oper_ope', 9)->nullable()->comment('Código de Operación');
            $table->string('tipo_regi_trg', 1)->nullable()->comment('Tipo registro');
            $table->string('nmes_ejec_cab', 2)->nullable()->comment('Mes de Ejecución');
            $table->string('codi_anex_anx', 9)->nullable()->comment('Código de Anexo');
            $table->string('tipo_refe_cab', 3)->nullable()->comment('Tipo referencia');
            $table->string('num_refe_cab', 20)->nullable()->comment('Numero de referencia');
            $table->string('fech_refe_cab')->nullable()->comment('Fecha referencia');
            $table->string('codi_prov_cab', 8)->nullable()->comment('Codigo proveedor, personal');
            $table->string('text_refe_cab', 500)->nullable()->comment('Detalle de refencia');
            $table->string('esta_regi_cab', 1)->nullable()->comment('Estado de la cabecera (0=pre-comprometido, 1=comprometido, 2=devengado, 3=girado, 4=pagado, *=anulado)');
            $table->string('tipo_camb_cab')->nullable()->comment('Tipo de cambio');
            $table->string('mnto_naci_cab')->nullable()->comment('Importe en soles');
            $table->string('mejo_fech_cab')->nullable()->comment('Fecha del documento');
            $table->string('codi_mone_cab', 5)->nullable()->comment('Codigo del tipo de moneda');
            $table->string('mnto_igv_cab')->nullable()->comment('Monto del igv');
            $table->string('fech_anul_cab')->nullable()->comment('Fecha de anulacion');
            $table->string('flag_comp_cab', 1)->nullable()->comment('Campo no utilizado');
            $table->string('num_ruc_cab', 11)->nullable()->comment('Numero de ruc');
            $table->string('fech_comp_cab')->nullable()->comment('Fecha de compromiso');
            $table->string('num_man_cab', 200)->nullable()->comment('Campo no utilizado');
            $table->string('fech_dev_cab')->nullable()->comment('Fecha de devengado');
            $table->string('codi_fuen_fto', 4)->nullable()->comment('Código de Fuente de Financiamiento');
            $table->string('mnto_otro_cab')->nullable()->comment('Campo no utilizado');
            $table->string('flag_prev_cab', 1)->nullable()->comment('Comprometido (0=no, 1=si)');
            $table->string('fech_prev_cab')->nullable()->comment('Campo no utilizado');
            $table->string('nume_nota_cab', 8)->nullable()->comment('Número de Nota de Cabecera');
            $table->string('flag_anti_cab', 1)->nullable()->comment('A/g');
            $table->string('nume_siaf_cab', 10)->nullable()->comment('Número SIAF');
            $table->string('codi_cont_cab', 12)->nullable()->comment('Codigo del contrato');
            $table->string('nume_regi_reg', 8)->nullable()->comment('Número de Registro Contable');
            $table->string('codi_cci_con', 40)->nullable()->comment('Campo no utilizado');
            $table->string('tcam_deve_cab')->nullable()->comment('Campo no utilizado');
            $table->string('fech_crea')->comment('Fecha de creación del registro');
            $table->string('user_modi', 30)->nullable()->comment('Usuario que modifica el registro');
            $table->string('fech_modi')->comment('Fecha de modificación');
            $table->string('user_crea', 30)->nullable()->comment('Usuario que crea el registro');
            $table->string('codi_inst_ins', 8)->nullable()->comment('Código de la Institución');
            $table->string('anno_deve_cab', 4)->nullable()->comment('Campo no utilizado');
            $table->string('nota_deve_cab', 8)->nullable()->comment('Nota devengado');
            $table->string('siaf_tipo_ope', 2)->nullable()->comment('Tipo de operacion - siaf');
            $table->string('siaf_mod_comp', 2)->nullable()->comment('Modalidad de compra - siaf');
            $table->string('siaf_tipo_proc', 2)->nullable()->comment('Tipo de proceso - siaf');
            $table->string('siaf_cod_doc', 3)->nullable()->comment('Tipo de documento - siaf');
            $table->string('siaf_ps_id_proc', 8)->nullable()->comment('Campo no utilizado');
            $table->string('siaf_ps_id_cont', 8)->nullable()->comment('Campo no utilizado');
            $table->string('siaf_ps_f_contr', 1)->nullable()->comment('Campo no utilizado');
            $table->string('siaf_ps_t_camb')->nullable()->comment('Campo no utilizado');
            $table->string('siaf_tipo_id', 1)->nullable()->comment('Tipo - siaf');
            $table->string('siaf_estado_compromiso', 1)->nullable()->comment('Estado compromiso - siaf');
            $table->string('siaf_estado_devengado', 1)->nullable()->comment('Estado devengado - siaf');
            $table->string('siaf_estado_girado', 1)->nullable()->comment('Estado girado - siaf');
            $table->string('siaf_cert_pre', 10)->nullable()->comment('Certificado - siaf');
            $table->string('siaf_sec_cert', 4)->nullable()->comment('Secuencia - siaf');
            $table->string('esta_deve_cab', 1)->nullable()->comment('Estado de la cabecera devengado (1=pendiente, 2 atendido)');
            $table->string('id_fuente', 4)->nullable()->comment('ID_FUENTE');
            $table->string('siaf_proy_siaf', 3)->nullable()->comment('Código del Proyecto SIAF');
            $table->string('siaf_secuencia', 4)->nullable();
            $table->string('num_refe_cab_siaf', 100)->nullable();
            $table->string('siaf_tipo_rec', 2)->nullable();
            $table->string('id_reqpoa')->nullable();
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
        Schema::dropIfExists('cabecera_mov');
    }
}
