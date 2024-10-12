<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTparentescoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tparentesco');
        Schema::create('tparentesco', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('tipo_pare_fam', 1)->nullable()->comment('Tipo de parentesco');
            $table->string('desc_pare_par', 50)->nullable()->comment('Descripcion del parentesco.');
            $table->string('flag_deha_par', 1)->nullable()->comment('Indica si es un derechohabiente. s=si, n=no');
            $table->string('codi_rtps_par', 10)->nullable()->comment('Código usado para la planilla electrónica');
            $table->string('flag_acti_par', 1)->nullable()->comment('Estado del registro. 1=activo, 0=inactivo');
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
        Schema::dropIfExists('tparentesco');
    }
}
