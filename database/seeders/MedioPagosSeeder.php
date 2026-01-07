<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MedioPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medio_pagos')->insert([
            ['codigo' => '001', 'descripcion' => 'Depósito en Cuenta'],
            ['codigo' => '002', 'descripcion' => 'Giro'],
            ['codigo' => '003', 'descripcion' => 'Transferencia de Fondos'],
            ['codigo' => '004', 'descripcion' => 'Orden de Pago'],
            ['codigo' => '005', 'descripcion' => 'Tarjeta de Débito'],
            ['codigo' => '006', 'descripcion' => 'Tarjeta de Crédito emitida en el país por una empresa del Sistema Financiero'],
            ['codigo' => '007', 'descripcion' => 'Cheques con cláusula: no negociables - intransferibles - no a la orden o similar'],
            ['codigo' => '008', 'descripcion' => 'Efectivo - por operaciones donde no existe obligación de utilizar Medios de Pago'],
            ['codigo' => '009', 'descripcion' => 'Efectivo -  en los demás casos'],
            ['codigo' => '010', 'descripcion' => 'Medios de Pago Usados en Comercio Exterior'],
            ['codigo' => '011', 'descripcion' => 'Documentos de EDPYMES y Cooperativas de Ahorro y Crédito'],
            ['codigo' => '012', 'descripcion' => 'Tarjeta de crédito emitida o no en el país por entes ajenos al Sistema F.'],
            ['codigo' => '013', 'descripcion' => 'Tarjetas de crédito emitidas en el exterior por bancos o F. no domiciliadas'],
        ]);
    }
}
