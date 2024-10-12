<?php

namespace App\Http\Livewire;

use App\Models\Formula as formulas;
use Livewire\Component;
use App\Models\Tplanilla as planilla;
use App\Models\Subtplanilla as subplanilla;
use App\Models\Concepto as conceptos;

class FormulaFormRegistration extends Component
{
    public $formula_registration_id;
    
    public $id_planilla;
    public $id_subplanilla;
    public $id_concepto;
    public $formula_for;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Formulas::where('id',$id)->first();
        $this->formula_registration_id = $id;
   
        $this->id_planilla = $tabla->id_planilla;
        $this->id_subplanilla = $tabla->id_subplanilla;
        $this->id_concepto = $tabla->id_concepto;
        $this->formula_for = $tabla->formula_for;
        

    }
    
	public function store()
    {
        $validatedData = $this->validate([
            'id_planilla' => 'required',
            'id_subplanilla' => 'required',
            'id_concepto' => 'required',
            'formula_for' => 'nullable|max:500',
            
        ]);

        formulas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('formula-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->id_planilla = '';
        $this->id_subplanilla = '';
        $this->id_concepto = '';
        $this->formula_for = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            //'id_planilla' => 'required',
            //'id_subplanilla' => 'required',
            //'id_concepto' => 'required',
            'formula_for' => 'nullable|max:500',
            
        ]);

        if ($this->formula_registration_id) {
            $tabla = formulas::find($this->formula_registration_id);
			//json_encode($tabla);
			//$tabla = $this->formula_for;
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('formula-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Formulas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('formula-table', '$refresh');
        }
    }

    public function render()
    {
        $conceptos = conceptos::all();
        $planillas = planilla::all();
        $subplanillas = subplanilla::all();

        return view('livewire.formula-form-registration',compact('conceptos','planillas','subplanillas'));
    }
}
