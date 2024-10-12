<?php

namespace App\Http\Livewire;

use App\Models\Empresa as empresas;
use Livewire\Component;

class EmpresaFormRegistration extends Component
{
    public $empresa_registration_id;
    
    public $ruc;
    public $nombre_comercial;
    public $razon_social;
    public $direccion;
    public $representante;
    public $email;
    public $telefono;
    public $estado;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Empresas::where('id',$id)->first();
        $this->empresa_registration_id = $id;
   
        $this->ruc = $tabla->ruc;
        $this->nombre_comercial = $tabla->nombre_comercial;
        $this->razon_social = $tabla->razon_social;
        $this->direccion = $tabla->direccion;
        $this->representante = $tabla->representante;
        $this->email = $tabla->email;
        $this->telefono = $tabla->telefono;
        $this->estado = $tabla->estado;
        

    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'ruc' => 'required|max:255',
            'nombre_comercial' => 'nullable|max:255',
            'razon_social' => 'required|max:255',
            'direccion' => 'nullable|max:255',
            'representante' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'telefono' => 'nullable|max:255',
            'estado' => 'required|max:1',
            
        ]);

        empresas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('empresa-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->ruc = '';
        $this->nombre_comercial = '';
        $this->razon_social = '';
        $this->direccion = '';
        $this->representante = '';
        $this->email = '';
        $this->telefono = '';
        $this->estado = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'ruc' => 'required|max:255',
            'nombre_comercial' => 'nullable|max:255',
            'razon_social' => 'required|max:255',
            'direccion' => 'nullable|max:255',
            'representante' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'telefono' => 'nullable|max:255',
            'estado' => 'required|max:1',
            
        ]);

        if ($this->empresa_registration_id) {
            $tabla = empresas::find($this->empresa_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('empresa-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Empresas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('empresa-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.empresa-form-registration');
    }
}
