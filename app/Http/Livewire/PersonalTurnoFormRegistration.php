<?php

namespace App\Http\Livewire;

use App\Models\PersonalTurno as personal_turnos;
use Livewire\Component;
use App\Models\Tturno as tturnos;
use App\Models\Persona;
use App\Models\TablaUbicacione;
use App\Models\UnidadTrabajo;
use Carbon\Carbon;

use App\Http\Livewire\PersonalTurnoTable;

class PersonalTurnoFormRegistration extends Component
{
    public $personal_turno_registration_id;
    
    public $id_persona;
    public $id_turno;
    public $codi_tarj_etu;
    public $fech_asig_ttu;
    public $flag_cont_asis;
    public $flag_sobt_ent;
    public $updateMode = false;
	public $nomb;
	public $id_area_trabajo;
	public $id_unidad_trabajo;
    public $tipo_marcacion;
	
	//public $personalTurnoTable = PersonalTurnoTable::class;
	
    protected $listeners = ['edit','update','delete','cancel','getIdPersona','resetFilters'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = personal_turnos::where('id',$id)->first();
        $this->personal_turno_registration_id = $id;
   		
        $this->id_persona = $tabla->id_persona;
        $this->id_turno = $tabla->id_turno;
        $this->codi_tarj_etu = $tabla->codi_tarj_etu;
        $this->fech_asig_ttu = $tabla->fech_asig_ttu;
        $this->flag_cont_asis = $tabla->flag_cont_asis;
        $this->flag_sobt_ent = $tabla->flag_sobt_ent;
        $this->tipo_marcacion = $tabla->tipo_marcacion;
		
        //$pers = Persona::find($this->id_persona);
		//$this->nomb = $pers->apellido_paterno." ".$pers->apellido_materno." ".$pers->nombres;

    }
    
	public function getIdPersona($id_persona)
    {
		$this->id_persona = $id_persona;
		$pers = Persona::find($id_persona);
		$this->nomb = $pers->apellido_paterno." ".$pers->apellido_materno." ".$pers->nombres;
		
	}
	
	public function store()
    {
		
		$this->fech_asig_ttu = Carbon::now()->timezone('America/Lima')->format('Y-m-d');
	
        $validatedData = $this->validate([
            'id_persona' => 'nullable',
            'id_turno' => 'nullable',
            'codi_tarj_etu' => 'nullable|max:255',
            'fech_asig_ttu' => 'nullable|max:255',
            'flag_cont_asis' => 'nullable|max:1',
            'flag_sobt_ent' => 'nullable|max:1',
            'tipo_marcacion' => 'nullable|max:1',
            
        ]);

        personal_turnos::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        //$this->emitTo('personal_turno-table', '$refresh');
		return redirect()->to('/manten/personal_turnos'); 
		
        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->id_persona = NULL;
        $this->id_turno = NULL;
        $this->codi_tarj_etu = NULL;
        $this->fech_asig_ttu = NULL;
        $this->flag_cont_asis = NULL;
        $this->flag_sobt_ent = NULL;
		$this->nomb = NULL;
        $this->tipo_marcacion = NULL;
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'id_persona' => 'nullable',
            'id_turno' => 'nullable',
            'codi_tarj_etu' => 'nullable|max:255',
            'fech_asig_ttu' => 'nullable|max:255',
            'flag_cont_asis' => 'nullable|max:1',
            'flag_sobt_ent' => 'nullable|max:1',
            'tipo_marcacion' => 'nullable|max:1',
            
        ]);

        

        $validatedData['tipo_marcacion'] = isset($validatedData['tipo_marcacion']) ? (int) $validatedData['tipo_marcacion'] : null;

        //dd($validatedData);
        //dd($this->tipo_marcacion);

        if ($this->personal_turno_registration_id) {
            $tabla = personal_turnos::find($this->personal_turno_registration_id);
            $tabla->update($validatedData);
            $tabla->tipo_marcacion = (int) $this->tipo_marcacion;
            $tabla->save();
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            //$this->emitTo('personal_turno-table', '$refresh');
			return redirect()->to('/manten/personal_turnos'); 
        }
    }

    public function delete($id)
    {
        if($id){
            Personal_Turnos::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            //$this->emitTo('personal_turno-table', '$refresh');
			return redirect()->to('/manten/personal_turnos'); 
        }
    }
	
	public function resetFilters()
    {
		//session()->flash('message', 'Successfully.');
		//$personalTurnoTable = new PersonalTurnoTable(654);
		//$personalTurnoTable->enviar_dato(654);
        $this->emitTo('personal-turno-table', '$refresh');
		//return redirect()->to('/manten/personal_turnos?filters%5Bid_area_trabajo_%5D=654'); 
		//$this->emit('personal_turno-table:refresh');
    }

    public function render()
    {
		
		$unidad_model = new UnidadTrabajo;
		$tabla_model = new TablaUbicacione;
		
		$unidad_trabajo = NULL;
		$turno = tturnos::all();
		$personal_turnos_model = new personal_turnos();
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$id_unidad_trabajo=$this->id_unidad_trabajo;
		$id_area_trabajo=$this->id_area_trabajo;
		
		if($id_area_trabajo > 0)$unidad_trabajo = $unidad_model->getUnidad($id_area_trabajo);
		$personas = $personal_turnos_model->getPersonaSinTurno($this->id_persona,$id_area_trabajo,$id_unidad_trabajo);
		
		
		//$personalTurnoTable = new PersonalTurnoTable($id_area_trabajo);
		//$personalTurnoTable->enviar_dato($id_area_trabajo);
		
		
		//$this->emitTo('personal_turno-table', '$refresh');
		
		//personalTurnoTable
		
        return view('livewire.personal-turno-form-registration',compact('turno','personas','area_trabajo','unidad_trabajo','id_area_trabajo','id_unidad_trabajo'))
        ->with('tipos_marcacion', $this->tipos_marcacion);
    }

    public function mount()
    {
        $this->tipos_marcacion = [
            '0' => '--Seleccione Tipo Marcacion--',
            '1' => 'Presencial',
            '2' => 'Virtual',
            '3' => 'Campo',
            '4' => 'Exonerado de Marcación',
        ];
    }
}
