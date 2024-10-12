<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class ClienteEmpresaTableSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/cliente_empresa.csv';
		// $this->encode = false;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
