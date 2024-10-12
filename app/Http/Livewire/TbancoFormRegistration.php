<?php

namespace App\Http\Livewire;

use App\Models\Tbanco as tbancos;
use Livewire\Component;

class TbancoFormRegistration extends Component
{
    public $tbanco_registration_id;
    
    public $codi_banc_tbc;
    public $nomb_banc_tbc;
    public $nomb_cort_tbc;
    public $flag_activ_ban;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Tbancos::where('id',$id)->first();
        $this->tbanco_registration_id = $id;
   
        $this->codi_banc_tbc = $tabla->codi_banc_tbc;
        $this->nomb_banc_tbc = $tabla->nomb_banc_tbc;
        $this->nomb_cort_tbc = $tabla->nomb_cort_tbc;
        $this->flag_activ_ban = $tabla->flag_activ_ban;
        

    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'codi_banc_tbc' => 'nullable|max:2',
            'nomb_banc_tbc' => 'nullable|max:40',
            'nomb_cort_tbc' => 'nullable|max:20',
            'flag_activ_ban' => 'nullable|max:1',
            
        ]);

        tbancos::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('tbanco-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->codi_banc_tbc = '';
        $this->nomb_banc_tbc = '';
        $this->nomb_cort_tbc = '';
        $this->flag_activ_ban = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'codi_banc_tbc' => 'nullable|max:2',
            'nomb_banc_tbc' => 'nullable|max:40',
            'nomb_cort_tbc' => 'nullable|max:20',
            'flag_activ_ban' => 'nullable|max:1',
            
        ]);

        if ($this->tbanco_registration_id) {
            $tabla = tbancos::find($this->tbanco_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('tbanco-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Tbancos::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tbanco-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.tbanco-form-registration');
    }
}
