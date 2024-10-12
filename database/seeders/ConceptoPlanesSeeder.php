<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ConceptoPlanesSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/concepto_planes.csv';
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
