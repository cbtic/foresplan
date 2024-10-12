<?php

namespace Database\Seeders;

use App\Models\DocumentoIdentidad;
use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;
use DB;

class DocumentoIdentidadSeeder extends CsvSeeder
{
    public function __construct(){
        $this->file = '/database/seeders/csv/documento_identidades.csv';
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