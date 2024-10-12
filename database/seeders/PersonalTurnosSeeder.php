<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalTurno;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class PersonalTurnosSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/personal_turnos.csv';
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
