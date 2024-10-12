<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class PersonaDetallesSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/persona_detalles.csv';
		$this->encode = false;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
	    DB::disableQueryLog();
	    parent::run();
 
    }
}
