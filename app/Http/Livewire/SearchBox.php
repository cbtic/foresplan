<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;

class Searchbox extends Component
{
    public $showdiv = false;
    public $search = "";
    public $records;
    public $empDetails;

    // Fetch records
    public function searchResult()
    {

        if (!empty($this->search)) {

            $this->records = Persona::orderby('apellido_paterno', 'asc')
                ->select('*')
                ->where('apellido_paterno', 'ilike', '%' . $this->search . '%')
                ->limit(5)
                ->get();

            $this->showdiv = true;
        } else {
            $this->showdiv = false;
        }
    }

    // Fetch record by ID
    public function fetchEmployeeDetail($id = 0)
    {

        $record = Persona::select('*')
            ->where('id', $id)
            ->first();

        $this->search = $record->apellido_paterno;
        $this->empDetails = $record;
        $this->showdiv = false;
    }

    public function render()
    {
        return view('livewire.searchbox');
    }
}
