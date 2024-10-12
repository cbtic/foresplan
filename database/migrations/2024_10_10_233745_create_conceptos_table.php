<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_regional')->unsigned()->index();
            $table->string('codigo',10);
            $table->string('denominacion',100);
 
         
            $table->string('estado',1)->nullable()->default('1');

  

            $table->bigInteger('id_tipo_concepto')->unsigned()->index();
            $table->foreign('id_tipo_concepto')->references('id')->on('tipo_conceptos');

            $table->double('importe',15,8)->nullable();
        

            $table->bigInteger('id_moneda')->unsigned()->index()->nullable();
			
            $table->string('moneda',50)->nullable();
            $table->string('periodo',8)->nullable()->index();
            $table->string('cuenta_contable',20)->nullable();
            $table->string('denominacion', 150)->change();
            $table->bigInteger('id_tipo_afectacion')->unsigned()->index()->nullable();
            $table->integer('cuenta_contable_debe')->nullable()->unsigned()->index(); 
            $table->integer('cuenta_contable_al_haber1')->nullable()->unsigned()->index(); 
            $table->integer('cuenta_contable_al_haber2')->nullable()->unsigned()->index(); 
            $table->integer('partida_presupuestal')->nullable()->unsigned()->index(); 
            $table->integer('centro_costo')->nullable()->unsigned()->index(); 
            $table->string('genera_pago',1)->nullable()->default('0');
            $table->string('estado',1)->nullable()->default('1');

            $table->bigInteger('id_usuario_inserta')->unsigned()->index();
			$table->bigInteger('id_usuario_actualiza')->nullable()->unsigned()->index();
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
        Schema::dropIfExists('conceptos');
    }
}
