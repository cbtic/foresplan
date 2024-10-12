<?php

namespace Database\Seeders;

use App\Models\Subtplanilla;
use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class SubtplanillasSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/subtplanillas.csv';
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
