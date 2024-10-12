<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleTurno;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class DetalleTurnosSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/detalle_turnos.csv';
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
