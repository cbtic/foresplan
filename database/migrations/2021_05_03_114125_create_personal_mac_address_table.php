<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalMacAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personal_mac_address');
        Schema::create('personal_mac_address', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('codi_empl_per', 8)->nullable();
            $table->string('nro_doc_per', 12)->nullable();
            $table->string('nro_mac_pma', 20)->nullable();
            $table->string('nro_ip_pma', 20)->nullable();
            $table->string('estado_pma', 1)->nullable();
            $table->string('fech_crea_pma')->nullable();
            $table->string('user_crea_pma', 20)->nullable();
            $table->string('fech_modi_pma')->nullable();
            $table->string('user_modi_pma', 20)->nullable();
            $table->string('hab_cam_pma', 1)->nullable();
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
        Schema::dropIfExists('personal_mac_address');
    }
}
