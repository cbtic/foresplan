<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tturno;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class TturnosSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/tturnos.csv';
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
