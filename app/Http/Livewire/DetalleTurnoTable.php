<?php

namespace App\Http\Livewire;

use App\Models\DetalleTurno as Detalle_Turnos;
//use App\Models\Tturno;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use DB;

class DetalleTurnoTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];
	//protected $exclude=['detalle_turnos.tur', 'tur'];
	
	//public $sort_attribute = 'tturnos.nomb_desc_tur';
	
    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            /*
            Column::make('Id Turno', 'id_turno')
                ->sortable()
                ->searchable(),
			*/
			
			Column::make('Turno', 'tur')
                ->sortable()
                //->searchable(),
				->searchable(function($builder, $term) {
					return $builder->orWhereHas('tturnos', function($query) use($term) {
					   return $query->where('nomb_desc_tur', 'ilike', '%'.$term.'%');
                	});
            }),
			/*	
			Column::make('Turno', 'tturnos.nomb_desc_tur')
                ->sortable()
                ->searchable(),
			*/
			//Column::make('tturnos.nomb_desc_tur')
			//->addClass('d-none hidden-xs none')
            //->searchable(),
				
            /*
            Column::make('Dia', 'nume_ndia_dtu')
                ->sortable()
                ->searchable(),
			*/
			
            Column::make('Dia', 'dia')
                ->sortable()
                //->searchable(),
				->searchable(function($builder, $term) {
					return $builder->orWhereHas('detalle_turnos', function($query) use($term) {
					   return $query->where(
					   					/*
					   					DB::raw("(case when nume_ndia_dtu='1' then 'Lunes' when nume_ndia_dtu='2' then 'Martes' when nume_ndia_dtu='3' then 'Miercoles' when nume_ndia_dtu='4' then 'Jueves' when nume_ndia_dtu='5' then 'Viernes' when nume_ndia_dtu='6' then 'Sabado' when nume_ndia_dtu='7' then 'Domingo' end) like '%".$term."%'")
					   					);
										*/
										DB::raw("(case when nume_ndia_dtu='1' then 'LUNES' when nume_ndia_dtu='2' then 'MARTES' when nume_ndia_dtu='3' then 'MIERCOLES' when nume_ndia_dtu='4' then 'JUEVES' when nume_ndia_dtu='5' then 'VIERNES' when nume_ndia_dtu='6' then 'SABADO' when nume_ndia_dtu='7' then 'DOMINGO' end)"), 'ilike', '%'.$term.'%'
					   					);
                	});
            }),
			
            Column::make('Flag Labora', 'flag_labo_dtu')
                ->sortable()
                ->searchable(),
            
            Column::make('Minutos Tolerancia', 'tturnos.minu_tole_dtu')
                ->sortable()
                ->searchable(),
            
            Column::make('Hora Entrada', 'hora_entr_dtu')
                ->sortable()
                ->searchable(),
            
			Column::make('Hora Salida', 'hora_sali_dtu')
                ->sortable()
                ->searchable(),
				//Column::blank(),
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }
	
	//->addClass('hidden md:table-cell'),
    public function query(): Builder
    {
	
        $query = Detalle_Turnos::query()
		//->select('tturnos.nomb_desc_tur as turno','detalle_turnos.*')
		->Join('tturnos', 'tturnos.id', 'detalle_turnos.id_turno')
		
		->selectRaw("tturnos.nomb_desc_tur AS tur,detalle_turnos.*,to_char(hora_sali_tur::timestamp,'HH12:MI:SS AM')hora_sali_dtu,to_char(tturnos.hora_entr_tur::timestamp,'HH12:MI:SS AM')hora_entr_dtu,
		(case when nume_ndia_dtu='1' then 'LUNES' when nume_ndia_dtu='2' then 'MARTES' when nume_ndia_dtu='3' then 'MIERCOLES' when nume_ndia_dtu='4' then 'JUEVES' when nume_ndia_dtu='5' then 'VIERNES' when nume_ndia_dtu='6' then 'SABADO' when nume_ndia_dtu='7' then 'DOMINGO' end)dia")
		->orderBy('detalle_turnos.id', 'desc');
		
		//->selectRaw("tturnos.nomb_desc_tur as tur, tturnos.nomb_desc_tur,detalle_turnos.*,to_char(hora_sali_dtu::timestamp,'HH12:MI:SS AM')hora_sali_dtu,to_char(hora_entr_dtu::timestamp,'HH12:MI:SS AM')hora_entr_dtu");
		//->select(["tturnos.nomb_desc_tur","tturnos.nomb_desc_tur as turno","detalle_turnos.id"]);
		
		//->when($this->getFilter('search'), fn ($query, $search) => $query->search($search));
		//->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
		//->where('tturnos.nomb_desc_tur', true);
		/*
		if($this->turno) {
			$query->overdue($this->turno);
		}
		*/
		
		//->whereLike('name', $searchTerm);
		//if($search !== "") {
		   //$filmQuery = $filmQuery->where(function ($query) {
			   //$query->where('name', 'like', "%$search%")
			   //->orWhere('description', 'like', "%$search%");
		   //});
		//}
		
		return $query;
		
    }

}