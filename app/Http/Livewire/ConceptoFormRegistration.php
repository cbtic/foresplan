<?php

namespace App\Http\Livewire;

use App\Models\Concepto as conceptos;
use Livewire\Component;

class ConceptoFormRegistration extends Component
{
    public $concepto_registration_id;
    
    public $codi_conc_tco;
    public $codi_cicl_cic;
    public $desc_conc_tco;
    public $desc_cort_tco;
    public $estado;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Conceptos::where('id',$id)->first();
        $this->concepto_registration_id = $id;
   
        $this->codi_conc_tco = $tabla->codi_conc_tco;
        $this->codi_cicl_cic = $tabla->codi_cicl_cic;
        $this->desc_conc_tco = $tabla->desc_conc_tco;
        $this->desc_cort_tco = $tabla->desc_cort_tco;
        $this->estado = $tabla->estado;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'codi_conc_tco' => 'nullable|max:5',
            'codi_cicl_cic' => 'nullable|max:1',
            'desc_conc_tco' => 'nullable|max:50',
            'desc_cort_tco' => 'nullable|max:25',
            'estado' => 'nullable|max:1',
            
        ]);

        conceptos::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('concepto-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->codi_conc_tco = '';
        $this->codi_cicl_cic = '';
        $this->desc_conc_tco = '';
        $this->desc_cort_tco = '';
        $this->estado = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'codi_conc_tco' => 'nullable|max:5',
            'codi_cicl_cic' => 'nullable|max:1',
            'desc_conc_tco' => 'nullable|max:50',
            'desc_cort_tco' => 'nullable|max:25',
            'estado' => 'nullable|max:1',
            
        ]);

        if ($this->concepto_registration_id) {
            $tabla = conceptos::find($this->concepto_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('concepto-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Conceptos::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('concepto-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.concepto-form-registration');
    }
}
