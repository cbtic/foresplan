<?php

namespace App\Http\Livewire;

use App\Models\Subtplanilla as subtplanillas;
use Livewire\Component;

use App\Models\Concepto as conceptos;

class SubtplanillaFormRegistration extends Component
{
    public $subtplanilla_registration_id;
    
    public $tipo_plan_tpl;
    public $subt_plan_stp;
    public $desc_subt_stp;
    public $titu_subt_stp;
    public $tipo_docu_tpd;
    public $tipo_mcpp_stp;
    public $clase_mcpp_stp;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Subtplanillas::where('id',$id)->first();
        $this->subtplanilla_registration_id = $id;
   
        $this->tipo_plan_tpl = $tabla->tipo_plan_tpl;
        $this->subt_plan_stp = $tabla->subt_plan_stp;
        $this->desc_subt_stp = $tabla->desc_subt_stp;
        $this->titu_subt_stp = $tabla->titu_subt_stp;
        $this->tipo_docu_tpd = $tabla->tipo_docu_tpd;
        $this->tipo_mcpp_stp = $tabla->tipo_mcpp_stp;
        $this->clase_mcpp_stp = $tabla->clase_mcpp_stp;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'tipo_plan_tpl' => 'nullable|max:2',
            'subt_plan_stp' => 'nullable|max:1',
            'desc_subt_stp' => 'nullable|max:40',
            'titu_subt_stp' => 'nullable|max:100',
            'tipo_docu_tpd' => 'nullable|max:3',
            'tipo_mcpp_stp' => 'nullable|max:2',
            'clase_mcpp_stp' => 'nullable|max:2',
            
        ]);

        subtplanillas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('subtplanilla-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->tipo_plan_tpl = '';
        $this->subt_plan_stp = '';
        $this->desc_subt_stp = '';
        $this->titu_subt_stp = '';
        $this->tipo_docu_tpd = '';
        $this->tipo_mcpp_stp = '';
        $this->clase_mcpp_stp = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'tipo_plan_tpl' => 'nullable|max:2',
            'subt_plan_stp' => 'nullable|max:1',
            'desc_subt_stp' => 'nullable|max:40',
            'titu_subt_stp' => 'nullable|max:100',
            'tipo_docu_tpd' => 'nullable|max:3',
            'tipo_mcpp_stp' => 'nullable|max:2',
            'clase_mcpp_stp' => 'nullable|max:2',
            
        ]);

        if ($this->subtplanilla_registration_id) {
            $tabla = subtplanillas::find($this->subtplanilla_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('subtplanilla-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Subtplanillas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('subtplanilla-table', '$refresh');
        }
    }

    public function render()
    {
        $conceptos = conceptos::all();
        return view('livewire.subtplanilla-form-registration',compact('conceptos'));
    }
}
