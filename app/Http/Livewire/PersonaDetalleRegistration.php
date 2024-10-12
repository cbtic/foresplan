<?php

namespace App\Http\Livewire;

use App\Models\PersonaDetalle as PersonaDetalles;
use Livewire\Component;

class PersonaDetalleRegistration extends Component
{
    public $tabla_persona_id;

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

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
 
        $tabla = PersonaDetalles::where('id',$id)->first();
        $this->tabla_persona_id = $id;
        
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

        
    }
    
    public function store()
    {
        $validatedData = $this->validate([

            'id_persona' => 'nullable',
            'direccion' => 'nullable|max:200',
            'ubigeo' => 'nullable',
            'telefono' => 'nullable',
            'email' => 'nullable',
            'foto' => 'nullable',
            'fecha_ingreso' => 'nullable',
            'id_condicion_laboral' => 'nullable',
            'id_tipo_planilla' => 'nullable',
            'id_profesion' => 'nullable',
            'id_banco_sueldo' => 'nullable',
            'num_cuenta_sueldo' => 'nullable',
            'cci_sueldo' => 'nullable',
            'id_regimen_pensionario' => 'nullable',
            'id_afp' => 'nullable',
            'fecha_afiliacion_afp' => 'nullable',
            'id_tipo_comision_afp' => 'nullable',
            'cuspp' => 'nullable',
            'fecha_cese' => 'nullable',
            'fecha_termino_contrato' => 'nullable',
            'num_contrato' => 'nullable',
            'id_cargo' => 'nullable',
            'id_nivel' => 'nullable',
            'id_banco_cts' => 'nullable',
            'num_cuenta_cts' => 'nullable',
            'id_moneda_cts' => 'nullable',
            'estado' => 'nullable',
            'id_ubicacion' => 'nullable',

        ]);

        PersonaDetalles::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('persona-detalle', '$refresh');

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

            'id_persona' => 'nullable',
            'direccion' => 'nullable|max:200',
            'ubigeo' => 'nullable',
            'telefono' => 'nullable',
            'email' => 'nullable',
            'foto' => 'nullable',
            'fecha_ingreso' => 'nullable',
            'id_condicion_laboral' => 'nullable',
            'id_tipo_planilla' => 'nullable',
            'id_profesion' => 'nullable',
            'id_banco_sueldo' => 'nullable',
            'num_cuenta_sueldo' => 'nullable',
            'cci_sueldo' => 'nullable',
            'id_regimen_pensionario' => 'nullable',
            'id_afp' => 'nullable',
            'fecha_afiliacion_afp' => 'nullable',
            'id_tipo_comision_afp' => 'nullable',
            'cuspp' => 'nullable',
            'fecha_cese' => 'nullable',
            'fecha_termino_contrato' => 'nullable',
            'num_contrato' => 'nullable',
            'id_cargo' => 'nullable',
            'id_nivel' => 'nullable',
            'id_banco_cts' => 'nullable',
            'num_cuenta_cts' => 'nullable',
            'id_moneda_cts' => 'nullable',
            'estado' => 'nullable',
            'id_ubicacion' => 'nullable',
        ]);

        if ($this->tabla_persona_id) {
            $tabla = PersonaDetalles::find($this->tabla_persona_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('persona-detalle', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            PersonaDetalles::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('persona-detalle', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.persona-detalle-registration');
    }
}
