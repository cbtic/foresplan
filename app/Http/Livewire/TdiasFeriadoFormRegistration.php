<?php

namespace App\Http\Livewire;

use App\Models\TdiasFeriado as tdias_feriados;
use Livewire\Component;

class TdiasFeriadoFormRegistration extends Component
{
    public $tdias_feriado_registration_id;
    
    public $fech_feri_tdf;
    public $flag_mdia_tdf;
    public $sali_mdia_tdf;
    public $moti_feri_tdf;
    public $flag_nlab_tdf;
    public $fech_frec_tdf;
    public $fech_irec_tdf;
    public $flag_recu_tdf;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = tdias_feriados::where('id',$id)->first();
        $this->tdias_feriado_registration_id = $id;
   
        $this->fech_feri_tdf = $tabla->fech_feri_tdf;
        $this->flag_mdia_tdf = $tabla->flag_mdia_tdf;
        $this->sali_mdia_tdf = $tabla->sali_mdia_tdf;
        $this->moti_feri_tdf = $tabla->moti_feri_tdf;
        $this->flag_nlab_tdf = $tabla->flag_nlab_tdf;
        $this->fech_frec_tdf = $tabla->fech_frec_tdf;
        $this->fech_irec_tdf = $tabla->fech_irec_tdf;
        $this->flag_recu_tdf = $tabla->flag_recu_tdf;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'fech_feri_tdf' => 'required',
            'flag_mdia_tdf' => 'nullable|max:1',
            'sali_mdia_tdf' => 'nullable',
            'moti_feri_tdf' => 'nullable|max:250',
            'flag_nlab_tdf' => 'nullable|max:1',
            'fech_frec_tdf' => 'nullable',
            'fech_irec_tdf' => 'nullable',
            'flag_recu_tdf' => 'nullable|max:1',
            
        ]);

        tdias_feriados::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('tdias_feriado-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->fech_feri_tdf = '';
        $this->flag_mdia_tdf = '';
        $this->sali_mdia_tdf = '';
        $this->moti_feri_tdf = '';
        $this->flag_nlab_tdf = '';
        $this->fech_frec_tdf = '';
        $this->fech_irec_tdf = '';
        $this->flag_recu_tdf = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'fech_feri_tdf' => 'required',
            'flag_mdia_tdf' => 'nullable|max:1',
            'sali_mdia_tdf' => 'nullable',
            'moti_feri_tdf' => 'nullable|max:250',
            'flag_nlab_tdf' => 'nullable|max:1',
            'fech_frec_tdf' => 'nullable',
            'fech_irec_tdf' => 'nullable',
            'flag_recu_tdf' => 'nullable|max:1',
            
        ]);

        if ($this->tdias_feriado_registration_id) {
            $tabla = tdias_feriados::find($this->tdias_feriado_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('tdias_feriado-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Tdias_Feriados::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tdias_feriado-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.tdias-feriado-form-registration');
    }
}
