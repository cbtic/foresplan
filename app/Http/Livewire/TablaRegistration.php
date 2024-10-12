<?php

namespace App\Http\Livewire;

use App\Models\Tabla as Tablas;
use Livewire\Component;

class TablaRegistration extends Component
{
    public $tabla_registration_id;
    public $tab_ite1_cod;
    public $tab_ite2_cod;
    public $tab_larg_des;
    public $tab_cort_des;
    public $tab_mont_imp;
    public $tab_orde_vis;
    public $tab_tabl_est;

    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Tablas::where('id',$id)->first();
        $this->tabla_registration_id = $id;
        $this->tab_ite1_cod = $tabla->tab_ite1_cod;
        $this->tab_ite2_cod = $tabla->tab_ite2_cod;
        $this->tab_larg_des = $tabla->tab_larg_des;
        $this->tab_cort_des = $tabla->tab_cort_des;
        $this->tab_mont_imp = $tabla->tab_mont_imp;
        $this->tab_orde_vis = $tabla->tab_orde_vis;
        $this->tab_tabl_est = $tabla->tab_tabl_est;
        
    }

    public function store()
    {
        $validatedData = $this->validate([
            'tab_ite1_cod' => 'required|max:20',
            'tab_ite2_cod' => 'required|max:20',
            'tab_larg_des' => 'required|max:200',
            'tab_cort_des' => 'required|max:100',
            'tab_mont_imp' => 'nullable',
            'tab_orde_vis' => 'nullable',
            'tab_tabl_est' => 'required',
        ]);

        Tablas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('tabla', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->tab_ite1_cod = '';
        $this->tab_ite2_cod = '';
        $this->tab_larg_des = '';
        $this->tab_cort_des = '';
        $this->tab_mont_imp = 0;
        $this->tab_orde_vis = '';
        $this->tab_tabl_est = '';
    }

    public function update()
    {
        $validatedData = $this->validate([
            'tab_ite1_cod' => 'required|max:20',
            'tab_ite2_cod' => 'required|max:20',
            'tab_larg_des' => 'required|max:200',
            'tab_cort_des' => 'required|max:100',
            'tab_mont_imp' => 'nullable',
            'tab_orde_vis' => 'nullable',
            'tab_tabl_est' => 'required',
        ]);

        if ($this->tabla_registration_id) {
            $tabla = Tablas::find($this->tabla_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('tabla', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Tablas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tabla', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.tabla-registration');
    }
}
