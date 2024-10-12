<?php

namespace App\Http\Livewire;

use App\Models\TipoOperacione as tipo_operaciones;
use Livewire\Component;

class TipoOperacioneFormRegistration extends Component
{
    public $tipo_operacione_registration_id;
    
    public $codi_oper_top;
    public $tipo_oper_top;
    public $codi_conc_tco;
    public $desc_oper_top;
    public $cont_dias_top;
    public $nume_dias_top;
    public $desc_pago_top;
    public $veri_reso_top;
    public $dcto_cts_top;
    public $clas_oper_top;
    public $flag_omis_top;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = tipo_operaciones::where('id',$id)->first();
        $this->tipo_operacione_registration_id = $id;
   
        $this->codi_oper_top = $tabla->codi_oper_top;
        $this->tipo_oper_top = $tabla->tipo_oper_top;
        $this->codi_conc_tco = $tabla->codi_conc_tco;
        $this->desc_oper_top = $tabla->desc_oper_top;
        $this->cont_dias_top = $tabla->cont_dias_top;
        $this->nume_dias_top = $tabla->nume_dias_top;
        $this->desc_pago_top = $tabla->desc_pago_top;
        $this->veri_reso_top = $tabla->veri_reso_top;
        $this->dcto_cts_top = $tabla->dcto_cts_top;
        $this->clas_oper_top = $tabla->clas_oper_top;
        $this->flag_omis_top = $tabla->flag_omis_top;
        

    }
    
public function store()
    {
        $validatedData = $this->validate([
            'codi_oper_top' => 'nullable|max:2',
            'tipo_oper_top' => 'nullable|max:1',
            'codi_conc_tco' => 'nullable|max:5',
            'desc_oper_top' => 'nullable|max:50',
            'cont_dias_top' => 'nullable|max:1',
            'nume_dias_top' => 'nullable|max:255',
            'desc_pago_top' => 'nullable|max:1',
            'veri_reso_top' => 'nullable|max:1',
            'dcto_cts_top' => 'nullable|max:1',
            'clas_oper_top' => 'nullable|max:2',
            'flag_omis_top' => 'nullable|max:1',
            
        ]);

        tipo_operaciones::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('tipo_operacione-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->codi_oper_top = '';
        $this->tipo_oper_top = '';
        $this->codi_conc_tco = '';
        $this->desc_oper_top = '';
        $this->cont_dias_top = '';
        $this->nume_dias_top = '';
        $this->desc_pago_top = '';
        $this->veri_reso_top = '';
        $this->dcto_cts_top = '';
        $this->clas_oper_top = '';
        $this->flag_omis_top = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'codi_oper_top' => 'nullable|max:2',
            'tipo_oper_top' => 'nullable|max:1',
            'codi_conc_tco' => 'nullable|max:5',
            'desc_oper_top' => 'nullable|max:50',
            'cont_dias_top' => 'nullable|max:1',
            'nume_dias_top' => 'nullable|max:255',
            'desc_pago_top' => 'nullable|max:1',
            'veri_reso_top' => 'nullable|max:1',
            'dcto_cts_top' => 'nullable|max:1',
            'clas_oper_top' => 'nullable|max:2',
            'flag_omis_top' => 'nullable|max:1',
            
        ]);

        if ($this->tipo_operacione_registration_id) {
            $tabla = tipo_operaciones::find($this->tipo_operacione_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('tipo_operacione-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Tipo_Operaciones::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tipo_operacione-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.tipo-operacione-form-registration');
    }
}
