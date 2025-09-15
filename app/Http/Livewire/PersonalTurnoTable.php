<?php

namespace App\Http\Livewire;

use App\Models\PersonalTurno as Personal_Turnos;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

use Rappasoft\LaravelLivewireTables\Views\Filter;
//use App\Models\TdiasFeriado as Tdias_Feriados;
use Illuminate\Http\Request;
use App\Models\TablaUbicacione;
//use DB;

class PersonalTurnoTable extends DataTableComponent
{
    public $listeners = [
        '$refresh'
    ];
	
	//protected $id_area_trabajo_;
	public $id_area_trabajo_;
	public $id_tipo_marcacion;

    public function __construct($id) 
    {
        //$this->year = Carbon::now()->format('Y');
		//$this->id_area_trabajo_=654;
		$this->id_area_trabajo_=$id;
		//echo Input::query('id_area_trabajo_');
		//$id_area_trabajo_ = $request->input('id_area_trabajo_');
		//echo "es: ".$this->id_area_trabajo_;
		//echo $id_area_trabajo_;
		//echo $_GET["5Bid_area_trabajo_"];
        $this->filters = array('id_area_trabajo_' => $this->id_area_trabajo_);
		
    }
	
	
	public function enviar_dato($id_area_trabajo_) 
    {
        //$this->year = Carbon::now()->format('Y');
		//$this->id_area_trabajo_=$id_area_trabajo_;
		//$this->filters = array('id_area_trabajo_' => $this->id_area_trabajo_);
		
		//echo Input::query('id_area_trabajo_');
		//$id_area_trabajo_ = $request->input('id_area_trabajo_');
		//echo "es=".$this->id_area_trabajo_;
		//echo $_GET["5Bid_area_trabajo_"];
        //$this->filters = array('id_area_trabajo_' => $this->id_area_trabajo_);
		
    }
	
    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            /*
            Column::make('Id Persona', 'id_persona')
                ->sortable()
                ->searchable(),
            */
			Column::make('Persona', 'personal')
                ->sortable()
                //->searchable(),
			->searchable(function($builder, $term) {
					return $builder->orWhereHas('persona', function($query) use($term) {
					   return $query->where('apellido_paterno', 'ilike', '%'.$term.'%')->orwhere('apellido_materno', 'ilike', '%'.$term.'%')->orwhere('nombres', 'ilike', '%'.$term.'%');
					   //return $query->where("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombres)", 'ilike', '%'.$term.'%');
					   
					   //return $query->orWhere(DB::raw("CONCAT('apellido_paterno', 'apellido_materno')"), 'ILIKE', "%".$term."%");
					   
					   //->selectRaw("CONCAT(personas.apellido_paterno,' ',personas.apellido_materno,' ',personas.nombres) as persona")
                	});
			}),
			/*
            Column::make('Id Turno', 'id_turno')
                ->sortable()
                ->searchable(),
            */
			
			Column::make('Turno', 'turno')
                ->sortable()
			->searchable(function($builder, $term) {
					return $builder->orWhereHas('tturno', function($query) use($term) {
					   return $query->where('nomb_desc_tur', 'ilike', '%'.$term.'%');
                	});
            }),
			
			
			/*
            Column::make('Codi Tarj Etu', 'codi_tarj_etu')
                ->sortable()
                ->searchable(),
            */
            Column::make('Fech Asignacion', 'fech_asig_ttu')
                ->sortable()
                ->searchable(),
            
            Column::make('Marcacion', 'flag_cont_asis')
                ->sortable()
                ->searchable(),
            
            Column::make('Sobretiempo', 'flag_sobt_ent')
                ->sortable()
                ->searchable(),

            Column::make('Tipo Marcacion', 'tipo_marcacion')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    $tipos_marcacion = [
                        0 => '--Seleccione Tipo Marcacion--',
                        1 => 'Presencial',
                        2 => 'Virtual',
                        3 => 'Campo',
                        4 => 'Exonerado de Marcación',
                    ];

        return $tipos_marcacion[$value] ?? '';
    }),
            
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }
	
	public function filters(): array
    {
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$array_id = array_column($area_trabajo, 'id');
		$array_id[0] = "-1";
		$array_years = array_column($area_trabajo, 'denominacion');
		$array_years[0] = "Todos";
        $filtered = array_combine($array_id, $array_years);

		return [
            'id_area_trabajo_' => Filter::make('Area')
                ->select($filtered),
            
        ];
		
    }
	
    public function query(): Builder
    {
        return Personal_Turnos::query()
		//->selectRaw("CONCAT(personas.apellido_paterno,' ',personas.apellido_materno,' ',personas.nombres) as persona,tturnos.nomb_desc_tur as turno, personal_turnos.*, fech_asig_ttu")
		->distinct()
        ->selectRaw("CONCAT(personas.apellido_paterno,' ',personas.apellido_materno,' ',personas.nombres) as personal,tturnos.nomb_desc_tur as turno, personal_turnos.*,to_char(fech_asig_ttu::date,'dd/mm/yyyy')fech_asig_ttu")
		->Join('personas', 'personas.id', 'personal_turnos.id_persona')
		->Join('persona_detalles', 'personas.id', 'persona_detalles.id_persona')
		->Join('tturnos', 'tturnos.id', 'personal_turnos.id_turno')
		//->where('id_area_trabajo', '=', $this->id_area_trabajo_)
        ->whereNull('tturnos.deleted_at')
		->when($this->getFilter('id_area_trabajo_'), fn ($query, $id_area_trabajo_) => $query->where('id_area_trabajo', '=', $id_area_trabajo_));
		
    }
	
	/*
	public function render()
    {
		return view('livewire.personal_turno-table');
	}
	*/
	/*
	public function mount($id_area_trabajo_){
		$this->id_area_trabajo_=$id_area_trabajo_;
	}
	*/
	
}