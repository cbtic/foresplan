<?php

namespace App\Http\Livewire;

use App\Models\Cliente as clientes;
use Livewire\Component;

class ClienteFormRegistration extends Component
{
    public $cliente_registration_id;
    
    public $denominacion;
    public $estado;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Clientes::where('id',$id)->first();
        $this->cliente_registration_id = $id;
   
        $this->denominacion = $tabla->denominacion;
        $this->estado = $tabla->estado;
        

    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'denominacion' => 'required|max:255',
            'estado' => 'required|max:1',
            
        ]);

        clientes::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('cliente-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->denominacion = '';
        $this->estado = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'denominacion' => 'required|max:255',
            'estado' => 'required|max:1',
            
        ]);

        if ($this->cliente_registration_id) {
            $tabla = clientes::find($this->cliente_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('cliente-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Clientes::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('cliente-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.cliente-form-registration');
    }
}
