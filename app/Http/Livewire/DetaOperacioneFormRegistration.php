<?php

namespace App\Http\Livewire;

use App\Models\DetaOperacione as deta_operaciones;
use Livewire\Component;

class DetaOperacioneFormRegistration extends Component
{
    public $deta_operacione_registration_id;
    
    public $fech_oper_ope;
    public $id_tipo_operacion;
    public $id_persona;
    public $tipo_oper_top;
    public $fech_inic_ope;
    public $fech_fina_ope;
    public $nume_dias_ope;
    public $nume_reso_ope;
    public $nomb_auto_ope;
    public $fech_reso_ope;
    public $tipo_hora_ope;
    public $fech_elab_ope;
    public $nume_minut_ope;
    public $secu_oper_ope;
    public $esta_oper_ope;
    public $obse_oper_ope;
    public $codi_relo_per;
    public $nro_citt_ope;
    public $nro_sevit_ope;
    public $nro_medi_ope;
    public $obse_jefe_ope;
    public $obse_rrhh_ope;
    public $rowidi;
    public $num_archivo;
    public $codi_moti_tmo;
    public $user_crea;
    public $fech_crea;
    public $user_modi;
    public $fech_modi;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = DetaOperaciones::where('id',$id)->first();
        $this->deta_operacione_registration_id = $id;
   
        $this->fech_oper_ope = $tabla->fech_oper_ope;
        $this->id_tipo_operacion = $tabla->id_tipo_operacion;
        $this->id_persona = $tabla->id_persona;
        $this->tipo_oper_top = $tabla->tipo_oper_top;
        $this->fech_inic_ope = $tabla->fech_inic_ope;
        $this->fech_fina_ope = $tabla->fech_fina_ope;
        $this->nume_dias_ope = $tabla->nume_dias_ope;
        $this->nume_reso_ope = $tabla->nume_reso_ope;
        $this->nomb_auto_ope = $tabla->nomb_auto_ope;
        $this->fech_reso_ope = $tabla->fech_reso_ope;
        $this->tipo_hora_ope = $tabla->tipo_hora_ope;
        $this->fech_elab_ope = $tabla->fech_elab_ope;
        $this->nume_minut_ope = $tabla->nume_minut_ope;
        $this->secu_oper_ope = $tabla->secu_oper_ope;
        $this->esta_oper_ope = $tabla->esta_oper_ope;
        $this->obse_oper_ope = $tabla->obse_oper_ope;
        $this->codi_relo_per = $tabla->codi_relo_per;
        $this->nro_citt_ope = $tabla->nro_citt_ope;
        $this->nro_sevit_ope = $tabla->nro_sevit_ope;
        $this->nro_medi_ope = $tabla->nro_medi_ope;
        $this->obse_jefe_ope = $tabla->obse_jefe_ope;
        $this->obse_rrhh_ope = $tabla->obse_rrhh_ope;
        $this->rowidi = $tabla->rowidi;
        $this->num_archivo = $tabla->num_archivo;
        $this->codi_moti_tmo = $tabla->codi_moti_tmo;
        $this->user_crea = $tabla->user_crea;
        $this->fech_crea = $tabla->fech_crea;
        $this->user_modi = $tabla->user_modi;
        $this->fech_modi = $tabla->fech_modi;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'fech_oper_ope' => 'nullable|max:255',
            'id_tipo_operacion' => 'nullable',
            'id_persona' => 'nullable',
            'tipo_oper_top' => 'nullable|max:1',
            'fech_inic_ope' => 'nullable|max:255',
            'fech_fina_ope' => 'nullable|max:255',
            'nume_dias_ope' => 'nullable|max:255',
            'nume_reso_ope' => 'nullable|max:80',
            'nomb_auto_ope' => 'nullable|max:35',
            'fech_reso_ope' => 'nullable|max:255',
            'tipo_hora_ope' => 'nullable|max:1',
            'fech_elab_ope' => 'nullable|max:255',
            'nume_minut_ope' => 'nullable|max:255',
            'secu_oper_ope' => 'nullable|max:10',
            'esta_oper_ope' => 'nullable|max:1',
            'obse_oper_ope' => 'nullable|max:300',
            'codi_relo_per' => 'nullable|max:8',
            'nro_citt_ope' => 'nullable|max:25',
            'nro_sevit_ope' => 'nullable|max:90',
            'nro_medi_ope' => 'nullable|max:200',
            'obse_jefe_ope' => 'nullable|max:300',
            'obse_rrhh_ope' => 'nullable|max:300',
            'rowidi' => 'nullable|max:10',
            'num_archivo' => 'nullable|max:8',
            'codi_moti_tmo' => 'nullable|max:4',
            'user_crea' => 'nullable|max:20',
            'fech_crea' => 'nullable|max:255',
            'user_modi' => 'nullable|max:20',
            'fech_modi' => 'nullable|max:255',
            
        ]);

        deta_operaciones::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('deta_operacione-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->fech_oper_ope = '';
        $this->id_tipo_operacion = '';
        $this->id_persona = '';
        $this->tipo_oper_top = '';
        $this->fech_inic_ope = '';
        $this->fech_fina_ope = '';
        $this->nume_dias_ope = '';
        $this->nume_reso_ope = '';
        $this->nomb_auto_ope = '';
        $this->fech_reso_ope = '';
        $this->tipo_hora_ope = '';
        $this->fech_elab_ope = '';
        $this->nume_minut_ope = '';
        $this->secu_oper_ope = '';
        $this->esta_oper_ope = '';
        $this->obse_oper_ope = '';
        $this->codi_relo_per = '';
        $this->nro_citt_ope = '';
        $this->nro_sevit_ope = '';
        $this->nro_medi_ope = '';
        $this->obse_jefe_ope = '';
        $this->obse_rrhh_ope = '';
        $this->rowidi = '';
        $this->num_archivo = '';
        $this->codi_moti_tmo = '';
        $this->user_crea = '';
        $this->fech_crea = '';
        $this->user_modi = '';
        $this->fech_modi = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'fech_oper_ope' => 'nullable|max:255',
            'id_tipo_operacion' => 'nullable',
            'id_persona' => 'nullable',
            'tipo_oper_top' => 'nullable|max:1',
            'fech_inic_ope' => 'nullable|max:255',
            'fech_fina_ope' => 'nullable|max:255',
            'nume_dias_ope' => 'nullable|max:255',
            'nume_reso_ope' => 'nullable|max:80',
            'nomb_auto_ope' => 'nullable|max:35',
            'fech_reso_ope' => 'nullable|max:255',
            'tipo_hora_ope' => 'nullable|max:1',
            'fech_elab_ope' => 'nullable|max:255',
            'nume_minut_ope' => 'nullable|max:255',
            'secu_oper_ope' => 'nullable|max:10',
            'esta_oper_ope' => 'nullable|max:1',
            'obse_oper_ope' => 'nullable|max:300',
            'codi_relo_per' => 'nullable|max:8',
            'nro_citt_ope' => 'nullable|max:25',
            'nro_sevit_ope' => 'nullable|max:90',
            'nro_medi_ope' => 'nullable|max:200',
            'obse_jefe_ope' => 'nullable|max:300',
            'obse_rrhh_ope' => 'nullable|max:300',
            'rowidi' => 'nullable|max:10',
            'num_archivo' => 'nullable|max:8',
            'codi_moti_tmo' => 'nullable|max:4',
            'user_crea' => 'nullable|max:20',
            'fech_crea' => 'nullable|max:255',
            'user_modi' => 'nullable|max:20',
            'fech_modi' => 'nullable|max:255',
            
        ]);

        if ($this->deta_operacione_registration_id) {
            $tabla = deta_operaciones::find($this->deta_operacione_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('deta_operacione-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Deta_Operaciones::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('deta_operacione-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.deta-operacione-form-registration');
    }
}
