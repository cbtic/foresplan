<?php

namespace App\Http\Livewire;

use App\Models\PersonaDetalle;
use App\Models\Persona;
use Livewire\Component;
use App\Models\CondicionLaborale;
use App\Models\Tplanilla;
use App\Models\DocumentoIdentidade;
use App\Models\Tprofesione;
use App\Models\tbanco;
use App\Models\RegimenPensionario;
use App\Models\tafp;
use App\Models\TipoComisione;
use App\Models\Tcargo;
use App\Models\NivelEducativo;
use App\Models\TipoMoneda;
use App\Models\UbicacionTrabajo;
use App\Models\TablaUbicacione;

class PersonaDetalleFormRegistration extends Component
{
    public $persona_detalle_registration_id;
    
    public $id_persona;
    public $direccion;
    public $ubigeo;
    public $telefono;
    public $email;
    public $foto;
    public $fecha_ingreso;
    public $id_condicion_laboral;
    public $id_tipo_planilla;
    public $id_profesion;
    public $id_banco_sueldo;
    public $num_cuenta_sueldo;
    public $cci_sueldo;
    public $id_regimen_pensionario;
    public $id_afp;
    public $fecha_afiliacion_afp;
    public $id_tipo_comision_afp;
    public $cuspp;
    public $fecha_cese;
    public $fecha_termino_contrato;
    public $num_contrato;
    public $id_cargo;
    public $id_nivel;
    public $id_banco_cts;
    public $num_cuenta_cts;
    public $id_moneda_cts;
    public $estado;
    public $id_ubicacion;
    public $updateMode = false;
	
	
	public $nomb;
    public $tDoc;
    public $nDoc;
    public $fNac;
    public $sexo;
	
    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = PersonaDetalle::where('id',$id)->first();
        $this->persona_detalle_registration_id = $id;
   
        $this->id_persona = $tabla->id_persona;
        $this->direccion = $tabla->direccion;
        $this->ubigeo = $tabla->ubigeo;
        $this->telefono = $tabla->telefono;
        $this->email = $tabla->email;
        $this->foto = $tabla->foto;
        $this->fecha_ingreso = $tabla->fecha_ingreso;
        $this->id_condicion_laboral = $tabla->id_condicion_laboral;
        $this->id_tipo_planilla = $tabla->id_tipo_planilla;
        $this->id_profesion = $tabla->id_profesion;
        $this->id_banco_sueldo = $tabla->id_banco_sueldo;
        $this->num_cuenta_sueldo = $tabla->num_cuenta_sueldo;
        $this->cci_sueldo = $tabla->cci_sueldo;
        $this->id_regimen_pensionario = $tabla->id_regimen_pensionario;
        $this->id_afp = $tabla->id_afp;
        $this->fecha_afiliacion_afp = $tabla->fecha_afiliacion_afp;
        $this->id_tipo_comision_afp = $tabla->id_tipo_comision_afp;
        $this->cuspp = $tabla->cuspp;
        $this->fecha_cese = $tabla->fecha_cese;
        $this->fecha_termino_contrato = $tabla->fecha_termino_contrato;
        $this->num_contrato = $tabla->num_contrato;
        $this->id_cargo = $tabla->id_cargo;
        $this->id_nivel = $tabla->id_nivel;
        $this->id_banco_cts = $tabla->id_banco_cts;
        $this->num_cuenta_cts = $tabla->num_cuenta_cts;
        $this->id_moneda_cts = $tabla->id_moneda_cts;
        $this->estado = $tabla->estado;
        $this->id_ubicacion = $tabla->id_ubicacion;
        
		$pers = Persona::find($this->id_persona);
        

		$this->nomb = $pers->apellido_paterno." ".$pers->apellido_materno." ".$pers->nombres;
        $this->tDoc = $pers->tipo_documento;
        $tipoD = DocumentoIdentidade::find($this->tDoc);
        $this->tDoc = $tipoD->abre_docu_did;

        $this->nDoc = $pers->numero_documento;
        $this->fNac = $pers->fecha_nacimiento;
        $this->sexo = $pers->sexo;
    }
    
public function store()
    {
        $validatedData = $this->validate([
            'id_persona' => 'required',
            'direccion' => 'nullable|max:255',
            'ubigeo' => 'nullable|max:255',
            'telefono' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'foto' => 'nullable|max:255',
            'fecha_ingreso' => 'nullable',
            'id_condicion_laboral' => 'required',
            'id_tipo_planilla' => 'required',
            'id_profesion' => 'required',
            'id_banco_sueldo' => 'required',
            'num_cuenta_sueldo' => 'nullable|max:255',
            'cci_sueldo' => 'nullable|max:255',
            'id_regimen_pensionario' => 'required',
            'id_afp' => 'required',
            'fecha_afiliacion_afp' => 'nullable',
            'id_tipo_comision_afp' => 'required',
            'cuspp' => 'nullable|max:255',
            'fecha_cese' => 'nullable',
            'fecha_termino_contrato' => 'nullable',
            'num_contrato' => 'nullable|max:255',
            'id_cargo' => 'required',
            'id_nivel' => 'required',
            'id_banco_cts' => 'required',
            'num_cuenta_cts' => 'nullable|max:255',
            'id_moneda_cts' => 'required',
            'estado' => 'required|max:1',
            'id_ubicacion' => 'nullable',
            
        ]);

        PersonaDetalle::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('persona_detalle-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->id_persona = '';
        $this->direccion = '';
        $this->ubigeo = '';
        $this->telefono = '';
        $this->email = '';
        $this->foto = '';
        $this->fecha_ingreso = '';
        $this->id_condicion_laboral = '';
        $this->id_tipo_planilla = '';
        $this->id_profesion = '';
        $this->id_banco_sueldo = '';
        $this->num_cuenta_sueldo = '';
        $this->cci_sueldo = '';
        $this->id_regimen_pensionario = '';
        $this->id_afp = '';
        $this->fecha_afiliacion_afp = '';
        $this->id_tipo_comision_afp = '';
        $this->cuspp = '';
        $this->fecha_cese = '';
        $this->fecha_termino_contrato = '';
        $this->num_contrato = '';
        $this->id_cargo = '';
        $this->id_nivel = '';
        $this->id_banco_cts = '';
        $this->num_cuenta_cts = '';
        $this->id_moneda_cts = '';
        $this->estado = '';
        $this->id_ubicacion = '';
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'id_persona' => 'required',
            'direccion' => 'nullable|max:255',
            'ubigeo' => 'nullable|max:255',
            'telefono' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'foto' => 'nullable|max:255',
            'fecha_ingreso' => 'nullable',
            'id_condicion_laboral' => 'required',
            'id_tipo_planilla' => 'required',
            'id_profesion' => 'required',
            'id_banco_sueldo' => 'required',
            'num_cuenta_sueldo' => 'nullable|max:255',
            'cci_sueldo' => 'nullable|max:255',
            'id_regimen_pensionario' => 'required',
            'id_afp' => 'required',
            'fecha_afiliacion_afp' => 'nullable',
            'id_tipo_comision_afp' => 'required',
            'cuspp' => 'nullable|max:255',
            'fecha_cese' => 'nullable',
            'fecha_termino_contrato' => 'nullable',
            'num_contrato' => 'nullable|max:255',
            'id_cargo' => 'required',
            'id_nivel' => 'required',
            'id_banco_cts' => 'required',
            'num_cuenta_cts' => 'nullable|max:255',
            'id_moneda_cts' => 'required',
            'estado' => 'required|max:1',
            'id_ubicacion' => 'nullable',
            
        ]);

        if ($this->persona_detalle_registration_id) {
            $tabla = PersonaDetalle::find($this->persona_detalle_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('persona_detalle-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            PersonaDetalle::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('persona_detalle-table', '$refresh');
        }
    }

    public function render()
    {
        $tabla_model = new TablaUbicacione;
		
        /*
        $lista_condicion = TablaUbicacione::select('tabla_ubicaciones.id as id', 'condicion_laborales.desc_cond_lab as denominacion')
        ->Join('condicion_laborales', 'condicion_laborales.id', 'tabla_ubicaciones.id_registro')
        ->where('tabla_ubicaciones.estado', '=', 'A')
        ->where('tabla_ubicaciones.id_ubicacion', '=', 1)
        ->where('tabla_ubicaciones.tabla', '=', 'condicion_laboral')
        ->get();
        */

        //$lista_condicion = CondicionLaborale::all();        
        $lista_condicion = $tabla_model->getTablaUbicacion("1","condicion_laborales","desc_cond_lab");
        //$lista_tplanilla = Tplanilla::all();
        $lista_tplanilla = $tabla_model->getTablaUbicacion("1","tplanillas","desc_tipo_tpl");
        //$lista_tprofesiones = Tprofesione::all();
        $lista_tprofesiones = $tabla_model->getTablaUbicacion("1","tprofesiones","nomb_prof_tpr");
        //$lista_tbanco = tbanco::all();
        $lista_tbanco = $tabla_model->getTablaUbicacion("1","tbancos","nomb_banc_tbc");
        //$lista_RegimenPensionario = RegimenPensionario::all();
        $lista_RegimenPensionario = $tabla_model->getTablaUbicacion("1","regimen_pensionarios","nomb_regimen");
        //$lista_tafp = tafp::all();
        $lista_tafp = $tabla_model->getTablaUbicacion("1","tafps","nomb_afp");
        //$lista_comisione = TipoComisione::all();
        $lista_comisione = $tabla_model->getTablaUbicacion("1","tipo_comisiones","nomb_tipo_comision");
        //$lista_cargo= Tcargo::all();
        $lista_cargo = $tabla_model->getTablaUbicacion("1","tcargos","desc_carg_tca");
        //$lista_nivelEducativo= NivelEducativo::all();
        $lista_nivelEducativo = $tabla_model->getTablaUbicacion("1","nivel_educativos","desc_nive_ned");
        //$lista_tipoMoneda= TipoMoneda::all();
        $lista_tipoMoneda = $tabla_model->getTablaUbicacion("1","tipo_monedas","nomb_tipo_moneda");
        
        $lista_empresa = UbicacionTrabajo::select('ubicacion_trabajos.id as id', 'empresas.razon_social as razon_social')
        ->Join('empresas', 'empresas.id', 'ubicacion_trabajos.id_empresa')->get();
        $nomb = $this->nomb;
        $tDoc = $this->tDoc;
        $nDoc = $this->nDoc;
        $fNac = $this->fNac;
        $sexo = $this->sexo;
        return view('livewire.persona-detalle-form-registration',compact('lista_condicion','lista_tplanilla','lista_tprofesiones','lista_tbanco','lista_RegimenPensionario','lista_tafp','lista_comisione','lista_nivelEducativo','lista_cargo','lista_tipoMoneda','lista_empresa','nomb','tDoc','nDoc','fNac','sexo'));

		
        
    }


}
