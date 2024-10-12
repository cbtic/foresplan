<?php

namespace App\Http\Livewire;

use App\Models\Tturno as tturnos;
use App\Models\DetalleTurno;
use Livewire\Component;
use Carbon\Carbon;

class TturnoFormRegistration extends Component
{
    public $tturno_registration_id;
    
    public $nomb_desc_tur;
    public $hora_entr_tur;
    public $hora_sali_tur;
    public $minu_tole_tur;
    public $tipo_refr_tur;
    public $refr_sali_tur;
    public $refr_entr_tur;
    public $refr_tole_tur;
    public $domi_dsem_tur;
    public $lune_dsem_tur;
    public $mart_dsem_tur;
    public $mier_dsem_tur;
    public $juev_dsem_tur;
    public $vier_dsem_tur;
    public $saba_dsem_tur;
    public $flag_tole_tur;
    public $hora_sema_tur;
    public $tiemp_refr_min;
    public $perm_dia_tur;
    public $updateMode = false;

	public $detalle_turno = [];
	
	//public $hora_entr_dtu = [];
	//public $nume_ndia_dtu = [];
	//public $formSlugs = [];
	
    protected $listeners = ['edit','update','delete','cancel','getHoraEntrTur'];
	
	public function getHoraEntrTur($hora_entr_tur)
    {
		$this->hora_entr_tur = $hora_entr_tur;
		
	}
	
    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = Tturnos::where('id',$id)->first();
        $this->tturno_registration_id = $id;
   		
		$tabla->hora_entr_tur = Carbon::parse($tabla->hora_entr_tur)->format('H:i');
		$tabla->hora_sali_tur = Carbon::parse($tabla->hora_sali_tur)->format('H:i');
		
		//$tabla->hora_entr_tur = Carbon::parse($tabla->hora_entr_tur)->format('g:i A');
		//$tabla->hora_sali_tur = Carbon::parse($tabla->hora_sali_tur)->format('g:i A');
		
        $this->nomb_desc_tur = $tabla->nomb_desc_tur;
        $this->hora_entr_tur = $tabla->hora_entr_tur;
        $this->hora_sali_tur = $tabla->hora_sali_tur;
        $this->minu_tole_tur = $tabla->minu_tole_tur;
        $this->tipo_refr_tur = $tabla->tipo_refr_tur;
        $this->refr_sali_tur = $tabla->refr_sali_tur;
        $this->refr_entr_tur = $tabla->refr_entr_tur;
        $this->refr_tole_tur = $tabla->refr_tole_tur;
        $this->domi_dsem_tur = $tabla->domi_dsem_tur;
        $this->lune_dsem_tur = $tabla->lune_dsem_tur;
        $this->mart_dsem_tur = $tabla->mart_dsem_tur;
        $this->mier_dsem_tur = $tabla->mier_dsem_tur;
        $this->juev_dsem_tur = $tabla->juev_dsem_tur;
        $this->vier_dsem_tur = $tabla->vier_dsem_tur;
        $this->saba_dsem_tur = $tabla->saba_dsem_tur;
        $this->flag_tole_tur = $tabla->flag_tole_tur;
        $this->hora_sema_tur = $tabla->hora_sema_tur;
        $this->tiemp_refr_min = $tabla->tiemp_refr_min;
        $this->perm_dia_tur = $tabla->perm_dia_tur;
        
		
		$this->detalle_turno = NULL;
		if(DetalleTurno::where('id_turno',$id)->count()>0){
			$this->detalle_turno = DetalleTurno::where('id_turno',$id)
			->selectRaw("detalle_turnos.*,to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')hora_entr_dtu,to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')hora_sali_dtu")
			->orderBy('nume_ndia_dtu', 'asc')->get()->toArray();
		}else{
			$this->detalle_turno[0]['nume_ndia_dtu'] = "1";
			$this->detalle_turno[1]['nume_ndia_dtu'] = "2";
			$this->detalle_turno[2]['nume_ndia_dtu'] = "3";
			$this->detalle_turno[3]['nume_ndia_dtu'] = "4";
			$this->detalle_turno[4]['nume_ndia_dtu'] = "5";
			$this->detalle_turno[5]['nume_ndia_dtu'] = "6";
			$this->detalle_turno[6]['nume_ndia_dtu'] = "7";
		}
		
    }
    
	public function store()
    {
	
		//if($this->hora_entr_tur!="")$this->hora_entr_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_entr_tur;
		//if($this->hora_sali_tur!="")$this->hora_sali_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_sali_tur;
		
		if($this->hora_entr_tur!="")$this->hora_entr_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_entr_tur;
		if($this->hora_sali_tur!="")$this->hora_sali_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_sali_tur;
		
        $validatedData = $this->validate([
            'nomb_desc_tur' => 'nullable|max:50',
            'hora_entr_tur' => 'nullable|max:255',
            'hora_sali_tur' => 'nullable|max:255',
            'minu_tole_tur' => 'nullable|max:255',
            'tipo_refr_tur' => 'nullable|max:1',
            'refr_sali_tur' => 'nullable|max:255',
            'refr_entr_tur' => 'nullable|max:255',
            'refr_tole_tur' => 'nullable|max:255',
            'domi_dsem_tur' => 'nullable|max:1',
            'lune_dsem_tur' => 'nullable|max:1',
            'mart_dsem_tur' => 'nullable|max:1',
            'mier_dsem_tur' => 'nullable|max:1',
            'juev_dsem_tur' => 'nullable|max:1',
            'vier_dsem_tur' => 'nullable|max:1',
            'saba_dsem_tur' => 'nullable|max:1',
            'flag_tole_tur' => 'nullable|max:1',
            'hora_sema_tur' => 'nullable|max:255',
            'tiemp_refr_min' => 'nullable|max:255',
            'perm_dia_tur' => 'nullable|max:255',
            
        ]);

        $turno = tturnos::create($validatedData);
		
		foreach($this->detalle_turno as $row){
			$detalle_turno = new DetalleTurno;
			$detalle_turno->id_turno = $turno->id;
			$detalle_turno->nume_ndia_dtu = $row['nume_ndia_dtu'];
			$detalle_turno->flag_labo_dtu = (isset($row['flag_labo_dtu']))?$row['flag_labo_dtu']:"N";
			//$detalle_turno->hora_sali_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_sali_dtu'];
			//$detalle_turno->hora_entr_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_entr_dtu'];
			$hora_sali_dtu=NULL;
			$hora_entr_dtu=NULL;
			if(isset($row['hora_sali_dtu']) && $row['hora_sali_dtu']!="")$hora_sali_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_sali_dtu'];
			if(isset($row['hora_entr_dtu']) && $row['hora_entr_dtu']!="")$hora_entr_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_entr_dtu'];
			$detalle_turno->hora_sali_dtu = $hora_sali_dtu;
			$detalle_turno->hora_entr_dtu = $hora_entr_dtu;
			$detalle_turno->save();
		}
		
        session()->flash('message', 'Se guardaron los datos correctamente.');

        //$this->emitTo('tturno-table', '$refresh');
		return redirect()->to('/manten/tturnos'); 
		
        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        $this->nomb_desc_tur = NULL;
        $this->hora_entr_tur = NULL;
        $this->hora_sali_tur = NULL;
        $this->minu_tole_tur = NULL;
        $this->tipo_refr_tur = NULL;
        $this->refr_sali_tur = NULL;
        $this->refr_entr_tur = NULL;
        $this->refr_tole_tur = NULL;
        $this->domi_dsem_tur = NULL;
        $this->lune_dsem_tur = NULL;
        $this->mart_dsem_tur = NULL;
        $this->mier_dsem_tur = NULL;
        $this->juev_dsem_tur = NULL;
        $this->vier_dsem_tur = NULL;
        $this->saba_dsem_tur = NULL;
        $this->flag_tole_tur = NULL;
        $this->hora_sema_tur = NULL;
        $this->tiemp_refr_min = NULL;
        $this->perm_dia_tur = NULL;
        
    }

    public function update()
    {
		//print_r($this->formSlugs);
		//print_r($this->detalle_turno);exit();
		
		if($this->hora_entr_tur!="")$this->hora_entr_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_entr_tur;
		if($this->hora_sali_tur!="")$this->hora_sali_tur = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$this->hora_sali_tur;
		
        $validatedData = $this->validate([
            'nomb_desc_tur' => 'nullable|max:50',
            'hora_entr_tur' => 'nullable|max:255',
            'hora_sali_tur' => 'nullable|max:255',
            'minu_tole_tur' => 'nullable|max:255',
            'tipo_refr_tur' => 'nullable|max:1',
            'refr_sali_tur' => 'nullable|max:255',
            'refr_entr_tur' => 'nullable|max:255',
            'refr_tole_tur' => 'nullable|max:255',
            'domi_dsem_tur' => 'nullable|max:1',
            'lune_dsem_tur' => 'nullable|max:1',
            'mart_dsem_tur' => 'nullable|max:1',
            'mier_dsem_tur' => 'nullable|max:1',
            'juev_dsem_tur' => 'nullable|max:1',
            'vier_dsem_tur' => 'nullable|max:1',
            'saba_dsem_tur' => 'nullable|max:1',
            'flag_tole_tur' => 'nullable|max:1',
            'hora_sema_tur' => 'nullable|max:255',
            'tiemp_refr_min' => 'nullable|max:255',
            'perm_dia_tur' => 'nullable|max:255',
            
        ]);

        if ($this->tturno_registration_id) {
            $tabla = tturnos::find($this->tturno_registration_id);
            $tabla->update($validatedData);
			
			/***************************/
			
			foreach($this->detalle_turno as $row){
				
				if(isset($row['id']) && $row['id'] > 0){
					$detalle_turno = DetalleTurno::find($row['id']);
				}else{
					$detalle_turno = new DetalleTurno;
					$detalle_turno->id_turno = $this->tturno_registration_id;
					$detalle_turno->nume_ndia_dtu = $row['nume_ndia_dtu'];
				}	
				
				//$detalle_turno->flag_labo_dtu = $row['flag_labo_dtu'];
				$detalle_turno->flag_labo_dtu = (isset($row['flag_labo_dtu']))?$row['flag_labo_dtu']:"N";
				
				$hora_sali_dtu=NULL;
				$hora_entr_dtu=NULL;
				if(isset($row['hora_sali_dtu']) && $row['hora_sali_dtu']!="")$hora_sali_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_sali_dtu'];
				if(isset($row['hora_entr_dtu']) && $row['hora_entr_dtu']!="")$hora_entr_dtu = Carbon::now()->timezone('America/Lima')->format('Y-m-d')." ".$row['hora_entr_dtu'];
				$detalle_turno->hora_sali_dtu = $hora_sali_dtu;
				$detalle_turno->hora_entr_dtu = $hora_entr_dtu;
				$detalle_turno->save();
			
			}
			
			/***************************/
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            //$this->emitTo('tturno-table', '$refresh');
			return redirect()->to('/manten/tturnos'); 
        }
    }

    public function delete($id)
    {
        if($id){
            Tturnos::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('tturno-table', '$refresh');
        }
    }

    public function render()
    {
		$dia[1] = "LUNES";
		$dia[2] = "MARTES";
		$dia[3] = "MIERCOLES";
		$dia[4] = "JUEVES";
		$dia[5] = "VIERNES";
		$dia[6] = "SABADO";
		$dia[7] = "DOMINGO";		
			
        return view('livewire.tturno-form-registration',compact('dia'));
    }
	
	
	public function mount(){
		
		$this->detalle_turno[0]['nume_ndia_dtu'] = "1";
		$this->detalle_turno[1]['nume_ndia_dtu'] = "2";
		$this->detalle_turno[2]['nume_ndia_dtu'] = "3";
		$this->detalle_turno[3]['nume_ndia_dtu'] = "4";
		$this->detalle_turno[4]['nume_ndia_dtu'] = "5";
		$this->detalle_turno[5]['nume_ndia_dtu'] = "6";
		$this->detalle_turno[6]['nume_ndia_dtu'] = "7";
		
	}
	//public function mount()
	//{
		//$this->detalle_turno = DetalleTurno::where('id_turno',1)->orderBy('nume_ndia_dtu', 'asc')->get();
		/*
		foreach($detalle_turno as $key=>$row){
			$this->detalle_turno[$key] = $row;
		}
		*/	
		
		/*	
		$data = [];
		$this->formSlugs = collect($this->detalle_turno)->map(function($value) use ($data) {
			$data["hora_entr_dtu"] = '';
			$data["hora_sali_dtu"] = '';
			return $data;
		})->toArray();
		*/
	//}
	/*
	public function mount(DetalleTurno $detalle_turno)
	{
		$this->detalle_turno = $detalle_turno;
		
	}
	
	public $rules = [
		//'detalle_turno' => 'required',
		'detalle_turno.0.hora_entr_dtu' => 'required',
		'detalle_turno.0.hora_sali_dtu' => 'required',
	];
	*/
	

}
