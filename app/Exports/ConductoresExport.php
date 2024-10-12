<?php

namespace App\Exports;

use App\Models\Conductores;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConductoresExport implements FromCollection
{
    public $conductores;

    public function __construct($conductores) {
        $this->conductores = $conductores;
    }

    public function collection()
    {
        return Conductores::whereIn('id', $this->conductores)->get();
    }
}
