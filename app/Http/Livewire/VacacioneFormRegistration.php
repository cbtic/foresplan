<?php

namespace App\Http\Livewire;

use App\Models\Vacacione as vacaciones;
use Livewire\Component;

class VacacioneFormRegistration extends Component
{
    public $vacacione_registration_id;
    
    public $codi_empl_per;
    public $ano_peri_vac;
    public $nume_peri_vac;
    public $fech_inic_vac;
    public $fech_fina_vac;
    public $id_corr;
    public $id_corrant;
    public $fg_estado;
    public $fech_registro;
    public $secu_oper_ope;
    public $nume_reso_ope;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Vacaciones::where('id',$id)->first();
        $this->vacacione_registration_id = $id;
   
        $this->codi_empl_per = $tabla->codi_empl_per;
        $this->ano_peri_vac = $tabla->ano_peri_vac;
        $this->nume_peri_vac = $tabla->nume_peri_vac;
        $this->fech_inic_vac = $tabla->fech_inic_vac;
        $this->fech_fina_vac = $tabla->fech_fina_vac;
        $this->id_corr = $tabla->id_corr;
        $this->id_corrant = $tabla->id_corrant;
        $this->fg_estado = $tabla->fg_estado;
        $this->fech_registro = $tabla->fech_registro;
        $this->secu_oper_ope = $tabla->secu_oper_ope;
        $this->nume_reso_ope = $tabla->nume_reso_ope;
        

    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'codi_empl_per' => 'nullable|max:8',
            'ano_peri_vac' => 'nullable|max:4',
            'nume_peri_vac' => 'nullable|max:2',
            'fech_inic_vac' => 'nullable|max:255',
            'fech_fina_vac' => 'nullable|max:255',
            'id_corr' => 'nullable|max:255',
            'id_corrant' => 'nullable|max:255',
            'fg_estado' => 'nullable|max:1',
            'fech_registro' => 'nullable|max:255',
            'secu_oper_ope' => 'nullable|max:5',
            'nume_reso_ope' => 'nullable|max:25',
            
        ]);

        vacaciones::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('vacacione-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->codi_empl_per = '';
        $this->ano_peri_vac = '';
        $this->nume_peri_vac = '';
        $this->fech_inic_vac = '';
        $this->fech_fina_vac = '';
        $this->id_corr = '';
        $this->id_corrant = '';
        $this->fg_estado = '';
        $this->fech_registro = '';
        $this->secu_oper_ope = '';
        $this->nume_reso_ope = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'codi_empl_per' => 'nullable|max:8',
            'ano_peri_vac' => 'nullable|max:4',
            'nume_peri_vac' => 'nullable|max:2',
            'fech_inic_vac' => 'nullable|max:255',
            'fech_fina_vac' => 'nullable|max:255',
            'id_corr' => 'nullable|max:255',
            'id_corrant' => 'nullable|max:255',
            'fg_estado' => 'nullable|max:1',
            'fech_registro' => 'nullable|max:255',
            'secu_oper_ope' => 'nullable|max:5',
            'nume_reso_ope' => 'nullable|max:25',
            
        ]);

        if ($this->vacacione_registration_id) {
            $tabla = vacaciones::find($this->vacacione_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('vacacione-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Vacaciones::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('vacacione-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.vacacione-form-registration');
    }
}
