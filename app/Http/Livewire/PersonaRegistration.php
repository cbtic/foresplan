<?php

namespace App\Http\Livewire;

use App\Models\Persona as Personas;
use Livewire\Component;

class PersonaRegistration extends Component
{
    public $tabla_persona_id;
    public $tipo_documento;
    public $numero_documento;
    public $nombres;
    public $apellido_paterno;
    public $apellido_materno;
    public $fecha_nacimiento;
    public $sexo;
    public $estado;

    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Personas::where('id',$id)->first();
        $this->tabla_persona_id = $id;
   
        $this->tipo_documento = $tabla->tipo_documento;
        $this->numero_documento = $tabla->numero_documento;
        $this->nombres = $tabla->nombres;
        $this->apellido_paterno = $tabla->apellido_paterno;
        $this->apellido_materno = $tabla->apellido_materno;
        $this->fecha_nacimiento = $tabla->fecha_nacimiento;
        $this->sexo = $tabla->sexo;
        $this->estado = $tabla->estado;
        
    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:20',
            'nombres' => 'required|max:200',
            'apellido_paterno' => 'required|max:200',
            'apellido_materno' => 'required|max:200',
            'fecha_nacimiento' => 'nullable',
            'sexo' => 'required',
            'estado' => 'required',
        ]);

        Personas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('persona', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){

        $this->tipo_documento = '';
        $this->numero_documento = '';
        $this->nombres = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->fecha_nacimiento = '';
        $this->sexo = '';
        $this->estado = '';                
    }

    public function update()
    {
        $validatedData = $this->validate([
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:20',
            'nombres' => 'required|max:200',
            'apellido_paterno' => 'required|max:200',
            'apellido_materno' => 'required|max:200',
            'fecha_nacimiento' => 'nullable',
            'sexo' => 'required',
            'estado' => 'required',
        ]);

        if ($this->tabla_persona_id) {
            $tabla = Personas::find($this->tabla_persona_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('persona', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Personas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('persona', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.persona-registration');
    }
}

