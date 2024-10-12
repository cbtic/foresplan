<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tdiasferiado;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class TdiasFeriadosSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/tdias_feriados.csv';
		// $this->encode = false;
    }
    #use DisableForeignKeys;
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