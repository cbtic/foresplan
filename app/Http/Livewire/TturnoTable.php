<?php

namespace App\Http\Livewire;

use App\Models\Tturno;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TturnoTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Turno', 'nomb_desc_tur')
                ->sortable()
                //->searchable(),
				->searchable(function($builder, $term) {
					return $builder->orWhereHas('tturnos', function($query) use($term) {
					   return $query->where('nomb_desc_tur', 'ilike', '%'.$term.'%');
                	});
            	}),
          	/*  
            Column::make('Hora Entrada', 'hora_entr_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Hora Salida', 'hora_sali_tur')
                ->sortable()
                ->searchable(),
            */
			Column::make('Toler', 'flag_tole_tur')
                ->sortable()
                ->searchable(),
				
            Column::make('Min. Toler', 'minu_tole_tur')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Tipo Refr Tur', 'tipo_refr_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Refr Sali Tur', 'refr_sali_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Refr Entr Tur', 'refr_entr_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Refr Tole Tur', 'refr_tole_tur')
                ->sortable()
                ->searchable(),
			*/
            
            Column::make('Dom', 'domi_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Lun', 'lune_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Mar', 'mart_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Mie', 'mier_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Jue', 'juev_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Vie', 'vier_dsem_tur')
                ->sortable()
                ->searchable(),
            
            Column::make('Sab', 'saba_dsem_tur')
                ->sortable()
                ->searchable(),
            
            /*
            Column::make('Hora Sema Tur', 'hora_sema_tur')
                ->sortable()
                ->searchable(),
			*/
            /*
            Column::make('Tiemp Refr Min', 'tiemp_refr_min')
                ->sortable()
                ->searchable(),
			*/
            /*
            Column::make('Perm Dia Tur', 'perm_dia_tur')
                ->sortable()
                ->searchable(),
            */
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Tturno::query()
		//->selectRaw("tturnos.*,to_char(hora_entr_tur::timestamp,'HH12:MI:SS AM')hora_entr_tur,to_char(hora_sali_tur::timestamp,'HH12:MI:SS AM')hora_sali_tur")
		->selectRaw("tturnos.*,to_char(hora_entr_tur::timestamp,'HH12:MI:SS AM')hora_entr_tur,to_char(hora_sali_tur::timestamp,'HH12:MI:SS AM')hora_sali_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='1') lune_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='2') mart_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='3') mier_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='4') juev_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='5') vier_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='6') saba_dsem_tur
		,(select case when flag_labo_dtu = 'S' then flag_labo_dtu||'('||to_char(hora_entr_dtu::timestamp,'HH24:MI:SS')||'-'||to_char(hora_sali_dtu::timestamp,'HH24:MI:SS')||')' else flag_labo_dtu end from detalle_turnos where id_turno=tturnos.id and nume_ndia_dtu='7') domi_dsem_tur
		")
		->orderBy('tturnos.id', 'desc');
    }

}