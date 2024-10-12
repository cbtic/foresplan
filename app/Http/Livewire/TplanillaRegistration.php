<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tplanilla as Planillas;

class TplanillaRegistration extends Component
{
    public $planilla_registration_id;
    public $tipo_plan_tpl;
    public $desc_tipo_tpl;
    public $tarj_inic_tpl;
    public $tarj_fina_tpl;
    public $cant_peri_tpl;
    public $codi_oper_ope;
    public $tipo_clas_tpl;
    public $codi_cond_lab;
    public $codi_anex_anx;
    public $codi_peri_tpe;
    public $tipo_docu_tpd;
    public $cate_pers_tpl;
    public $nume_dia_vac;

    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Planillas::where('id',$id)->first();
        $this->planilla_registration_id = $id;
        $this->tipo_plan_tpl = $tabla->tipo_plan_tpl;
        $this->desc_tipo_tpl = $tabla->desc_tipo_tpl;
        $this->tarj_inic_tpl = $tabla->tarj_inic_tpl;
        $this->tarj_fina_tpl = $tabla->tarj_fina_tpl;
        $this->cant_peri_tpl = $tabla->cant_peri_tpl;
        $this->codi_oper_ope = $tabla->codi_oper_ope;
        $this->tipo_clas_tpl = $tabla->tipo_clas_tpl;
        $this->codi_cond_lab = $tabla->codi_cond_lab;
        $this->codi_anex_anx = $tabla->codi_anex_anx;
        $this->codi_peri_tpe = $tabla->codi_peri_tpe;
        $this->tipo_docu_tpd = $tabla->tipo_docu_tpd;
        $this->cate_pers_tpl = $tabla->cate_pers_tpl;
        $this->nume_dia_vac = $tabla->nume_dia_vac;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'tipo_plan_tpl' => 'required|max:2',
            'desc_tipo_tpl' => 'required|max:25',
            'tarj_inic_tpl' => 'nullable|max:25',
            'tarj_fina_tpl' => 'nullable|max:25',
            'cant_peri_tpl' => 'nullable|max:25',
            'codi_oper_ope' => 'nullable|max:25',
            'tipo_clas_tpl' => 'nullable|max:25',
            'codi_cond_lab' => 'nullable|max:25',
            'codi_anex_anx' => 'nullable|max:25',
            'codi_peri_tpe' => 'nullable|max:25',
            'tipo_docu_tpd' => 'nullable|max:25',
            'cate_pers_tpl' => 'nullable|max:25',
            'nume_dia_vac' => 'nullable|max:25',
        ]);

        Planillas::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('tplanilla', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->tipo_plan_tpl = '';
        $this->desc_tipo_tpl = '';
        $this->tarj_inic_tpl = '';
        $this->tarj_fina_tpl = '';
        $this->cant_peri_tpl = '';
        $this->codi_oper_ope = '';
        $this->tipo_clas_tpl = '';
        $this->codi_cond_lab = '';
        $this->codi_anex_anx = '';
        $this->codi_peri_tpe = '';
        $this->tipo_docu_tpd = '';
        $this->cate_pers_tpl = '';
        $this->nume_dia_vac = '';
    }

    public function update()
    {
        $validatedData = $this->validate([
            'tipo_plan_tpl' => 'required|max:2',
            'desc_tipo_tpl' => 'required|max:25',
            'tarj_inic_tpl' => 'nullable|max:25',
            'tarj_fina_tpl' => 'nullable|max:25',
            'cant_peri_tpl' => 'nullable|max:25',
            'codi_oper_ope' => 'nullable|max:25',
            'tipo_clas_tpl' => 'nullable|max:25',
            'codi_cond_lab' => 'nullable|max:25',
            'codi_anex_anx' => 'nullable|max:25',
            'codi_peri_tpe' => 'nullable|max:25',
            'tipo_docu_tpd' => 'nullable|max:25',
            'cate_pers_tpl' => 'nullable|max:25',
            'nume_dia_vac' => 'nullable|max:25',
        ]);

        if ($this->planilla_registration_id) {
            $tabla = Planillas::find($this->planilla_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('tplanilla', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            Planillas::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tplanilla', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.tplanilla-registration');
    }
}
