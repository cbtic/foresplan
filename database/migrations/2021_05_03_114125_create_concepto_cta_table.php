<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptoCtaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('concepto_cta');
        Schema::create('concepto_cta', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_conc_tco', 5)->nullable()->comment('Código de Concepto');
            $table->string('tipo_plan_tpl', 2)->nullable();
            $table->string('subt_plan_tpl', 1)->nullable();
            $table->string('cnta_debe_cta', 20)->nullable();
            $table->string('cnta_habe_cta', 20)->nullable();
            $table->string('codi_ope_cta', 20)->nullable();
            $table->string('flag_pago_cta', 1)->nullable();
            $table->string('cnta_haber_esp', 20)->nullable();
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
        Schema::dropIfExists('concepto_cta');
    }
}
