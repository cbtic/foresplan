<?php

namespace App\Http\Livewire;

use App\Models\Asistencia as asistencias;
use Livewire\Component;

class AsistenciaFormRegistration extends Component
{
    public $asistencia_registration_id;
    
    public $id_persona;
    public $fech_marc_rel;
    public $hora_entr_rel;
    public $hora_sali_rel;
    public $refr_sali_rel;
    public $refr_entr_rel;
    public $doc_iden_per;
    public $nro_doc_rel;
    public $fech_regi_eas;
    public $tipo_erro_eas;
    public $tipo_dias_eas;
    public $tipo_marc_eas;
    public $hora_marc_eas;
    public $minu_tard_eas;
    public $minu_apor_eas;
    public $minu_tole_eas;
    public $minu_dife_eas;
    public $flag_marc_eas;
    public $nume_bole_eas;
    public $flag_bole_eas;
    public $id_corr_rel;
    public $fech_regi_mar;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Asistencias::where('id',$id)->first();
        $this->asistencia_registration_id = $id;
   
        $this->id_persona = $tabla->id_persona;
        $this->fech_marc_rel = $tabla->fech_marc_rel;
        $this->hora_entr_rel = $tabla->hora_entr_rel;
        $this->hora_sali_rel = $tabla->hora_sali_rel;
        $this->refr_sali_rel = $tabla->refr_sali_rel;
        $this->refr_entr_rel = $tabla->refr_entr_rel;
        $this->doc_iden_per = $tabla->doc_iden_per;
        $this->nro_doc_rel = $tabla->nro_doc_rel;
        $this->fech_regi_eas = $tabla->fech_regi_eas;
        $this->tipo_erro_eas = $tabla->tipo_erro_eas;
        $this->tipo_dias_eas = $tabla->tipo_dias_eas;
        $this->tipo_marc_eas = $tabla->tipo_marc_eas;
        $this->hora_marc_eas = $tabla->hora_marc_eas;
        $this->minu_tard_eas = $tabla->minu_tard_eas;
        $this->minu_apor_eas = $tabla->minu_apor_eas;
        $this->minu_tole_eas = $tabla->minu_tole_eas;
        $this->minu_dife_eas = $tabla->minu_dife_eas;
        $this->flag_marc_eas = $tabla->flag_marc_eas;
        $this->nume_bole_eas = $tabla->nume_bole_eas;
        $this->flag_bole_eas = $tabla->flag_bole_eas;
        $this->id_corr_rel = $tabla->id_corr_rel;
        $this->fech_regi_mar = $tabla->fech_regi_mar;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'id_persona' => 'nullable',
            'fech_marc_rel' => 'required|max:255',
            'hora_entr_rel' => 'nullable|max:255',
            'hora_sali_rel' => 'nullable|max:255',
            'refr_sali_rel' => 'nullable|max:255',
            'refr_entr_rel' => 'nullable|max:255',
            'doc_iden_per' => 'nullable|max:8',
            'nro_doc_rel' => 'nullable|max:8',
            'fech_regi_eas' => 'nullable|max:255',
            'tipo_erro_eas' => 'nullable|max:18',
            'tipo_dias_eas' => 'nullable|max:1',
            'tipo_marc_eas' => 'nullable|max:1',
            'hora_marc_eas' => 'nullable|max:255',
            'minu_tard_eas' => 'nullable|max:255',
            'minu_apor_eas' => 'nullable|max:255',
            'minu_tole_eas' => 'nullable|max:255',
            'minu_dife_eas' => 'nullable|max:255',
            'flag_marc_eas' => 'nullable|max:1',
            'nume_bole_eas' => 'nullable|max:5',
            'flag_bole_eas' => 'nullable|max:1',
            'id_corr_rel' => 'nullable|max:255',
            'fech_regi_mar' => 'nullable|max:255',
            
        ]);

        asistencias::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('asistencia-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->id_persona = '';
        $this->fech_marc_rel = '';
        $this->hora_entr_rel = '';
        $this->hora_sali_rel = '';
        $this->refr_sali_rel = '';
        $this->refr_entr_rel = '';
        $this->doc_iden_per = '';
        $this->nro_doc_rel = '';
        $this->fech_regi_eas = '';
        $this->tipo_erro_eas = '';
        $this->tipo_dias_eas = '';
        $this->tipo_marc_eas = '';
        $this->hora_marc_eas = '';
        $this->minu_tard_eas = '';
        $this->minu_apor_eas = '';
        $this->minu_tole_eas = '';
        $this->minu_dife_eas = '';
        $this->flag_marc_eas = '';
        $this->nume_bole_eas = '';
        $this->flag_bole_eas = '';
        $this->id_corr_rel = '';
        $this->fech_regi_mar = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'id_persona' => 'nullable',
            'fech_marc_rel' => 'required|max:255',
            'hora_entr_rel' => 'nullable|max:255',
            'hora_sali_rel' => 'nullable|max:255',
            'refr_sali_rel' => 'nullable|max:255',
            'refr_entr_rel' => 'nullable|max:255',
            'doc_iden_per' => 'nullable|max:8',
            'nro_doc_rel' => 'nullable|max:8',
            'fech_regi_eas' => 'nullable|max:255',
            'tipo_erro_eas' => 'nullable|max:18',
            'tipo_dias_eas' => 'nullable|max:1',
            'tipo_marc_eas' => 'nullable|max:1',
            'hora_marc_eas' => 'nullable|max:255',
            'minu_tard_eas' => 'nullable|max:255',
            'minu_apor_eas' => 'nullable|max:255',
            'minu_tole_eas' => 'nullable|max:255',
            'minu_dife_eas' => 'nullable|max:255',
            'flag_marc_eas' => 'nullable|max:1',
            'nume_bole_eas' => 'nullable|max:5',
            'flag_bole_eas' => 'nullable|max:1',
            'id_corr_rel' => 'nullable|max:255',
            'fech_regi_mar' => 'nullable|max:255',
            
        ]);

        if ($this->asistencia_registration_id) {
            $tabla = asistencias::find($this->asistencia_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('asistencia-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Asistencias::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('asistencia-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.asistencia-form-registration');
    }
}
