<?php

namespace App\Http\Livewire;

use App\Models\DetalleTurno as detalle_turnos;
use Livewire\Component;
use App\Models\Tturno as tturnos;
use Carbon\Carbon;

class DetalleTurnoFormRegistration extends Component
{
    public $detalle_turno_registration_id;
    
    public $id_turno;
    public $nume_ndia_dtu;
    public $flag_labo_dtu;
    public $minu_tole_dtu;
    public $hora_sali_dtu;
    public $hora_entr_dtu;
	public $tur;
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = detalle_turnos::where('id',$id)->first();
        $this->detalle_turno_registration_id = $id;
   		
		$tabla->hora_entr_dtu = Carbon::parse($tabla->hora_entr_dtu)->format('H:i:s');
		$tabla->hora_sali_dtu = Carbon::parse($tabla->hora_sali_dtu)->format('H:i:s');
		
        $this->id_turno = $tabla->id_turno;
        $this->nume_ndia_dtu = $tabla->nume_ndia_dtu;
        $this->flag_labo_dtu = $tabla->flag_labo_dtu;
        $this->minu_tole_dtu = $tabla->minu_tole_dtu;
        $this->hora_sali_dtu = $tabla->hora_sali_dtu;
        $this->hora_entr_dtu = $tabla->hora_entr_dtu;
        

    }
    
	public function store()
    {
	
		if($this->hora_entr_dtu!="")$this->hora_entr_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_entr_dtu;
		if($this->hora_sali_dtu!="")$this->hora_sali_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_sali_dtu;
	
        $validatedData = $this->validate([
            'id_turno' => 'nullable',
            'nume_ndia_dtu' => 'nullable|max:2',
            'flag_labo_dtu' => 'nullable|max:1',
            'minu_tole_dtu' => 'nullable|max:255',
            'hora_sali_dtu' => 'nullable|max:255',
            'hora_entr_dtu' => 'nullable|max:255',
            
        ]);

        detalle_turnos::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        //$this->emitTo('detalle_turno-table', '$refresh');
		return redirect()->to('/manten/detalle_turnos'); 
		
        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->id_turno = NULL;
        $this->nume_ndia_dtu = NULL;
        $this->flag_labo_dtu = NULL;
        $this->minu_tole_dtu = NULL;
        $this->hora_sali_dtu = NULL;
        $this->hora_entr_dtu = NULL;
        
    }

    public function update()
    {
	
		if($this->hora_entr_dtu!="")$this->hora_entr_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_entr_dtu;
		if($this->hora_sali_dtu!="")$this->hora_sali_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_sali_dtu;
		
        $validatedData = $this->validate([
            'id_turno' => 'nullable',
            'nume_ndia_dtu' => 'nullable|max:2',
            'flag_labo_dtu' => 'nullable|max:1',
            'minu_tole_dtu' => 'nullable|max:255',
            'hora_sali_dtu' => 'nullable|max:255',
            'hora_entr_dtu' => 'nullable|max:255',
            
        ]);

        if ($this->detalle_turno_registration_id) {
            $tabla = detalle_turnos::find($this->detalle_turno_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();
            //$this->emitTo('detalle_turno-table', '$refresh');
			return redirect()->to('/manten/detalle_turnos'); 
        }
		
    }

    public function delete($id)
    {
        if($id){
            Detalle_Turnos::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            //$this->emitTo('detalle_turno-table', '$refresh');
			return redirect()->to('/manten/detalle_turnos'); 
        }
    }

    public function render()
    {
		$turno = tturnos::all();
		$dia[1] = "LUNES";
		$dia[2] = "MARTES";
		$dia[3] = "MIERCOLES";
		$dia[4] = "JUEVES";
		$dia[5] = "VIERNES";
		$dia[6] = "SABADO";
		$dia[7] = "DOMINGO";
		
        return view('livewire.detalle-turno-form-registration',compact('turno','dia'));
    }
}
