<?php

namespace App\Http\Livewire;

use App\Models\Asistencia as Asistencias;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AsistenciaTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

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
			Column::make('Persona', 'persona')
                ->sortable()
                //->searchable(),
			->searchable(function($builder, $term) {
					return $builder->orWhereHas('persona', function($query) use($term) {
					   return $query->where('apellido_paterno', 'ilike', '%'.$term.'%');
                	});
			}),
			
			Column::make('Doc Identidad', 'doc_iden_per')
                ->sortable()
                //->searchable(),
			->searchable(function($builder, $term) {
					return $builder->orWhereHas('persona', function($query) use($term) {
					   return $query->where('numero_documento', 'ilike', '%'.$term.'%');
                	});
			}),
				
            Column::make('Fecha Entrada', 'fech_marc_rel')
                ->sortable()
                ->searchable(),
            
            Column::make('Hora Entrada', 'hora_entr_rel')
                ->sortable()
                ->searchable(),
            
			Column::make('Fecha Salida', 'fech_sali_rel')
                ->sortable()
                ->searchable(),
				
            Column::make('Hora Salida', 'hora_sali_rel')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Refr Sali Rel', 'refr_sali_rel')
                ->sortable()
                ->searchable(),
            
            Column::make('Refr Entr Rel', 'refr_entr_rel')
                ->sortable()
                ->searchable(),
            */
			/*
            Column::make('Nro Doc Rel', 'nro_doc_rel')
                ->sortable()
                ->searchable(),
            */
            Column::make('Fech Regi Eas', 'fech_regi_eas')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Tipo Erro Eas', 'tipo_erro_eas')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Dias Eas', 'tipo_dias_eas')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Marc Eas', 'tipo_marc_eas')
                ->sortable()
                ->searchable(),
            
            Column::make('Hora Marc Eas', 'hora_marc_eas')
                ->sortable()
                ->searchable(),
            */
            Column::make('Minutos Tardanza', 'minu_tard_eas')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Minu Apor Eas', 'minu_apor_eas')
                ->sortable()
                ->searchable(),
            */
            Column::make('Minutos Tolerancia', 'minu_tole_eas')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Minu Dife Eas', 'minu_dife_eas')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Marc Eas', 'flag_marc_eas')
                ->sortable()
                ->searchable(),
            */
            Column::make('Nume Bole Eas', 'nume_bole_eas')
                ->sortable()
                ->searchable(),
            /*
            Column::make('Flag Bole Eas', 'flag_bole_eas')
                ->sortable()
                ->searchable(),
			*/
            /*
            Column::make('Id Corr Rel', 'id_corr_rel')
                ->sortable()
                ->searchable(),
            */
            Column::make('Fech Regi Mar', 'fech_regi_mar')
                ->sortable()
                ->searchable(),
            
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Asistencias::query()
		->selectRaw("CONCAT(personas.apellido_paterno,' ',personas.apellido_materno,' ',personas.nombres) as persona,asistencias.*,personas.numero_documento as doc_iden_per")
		->Join('personas', 'personas.id', 'asistencias.id_persona');
    }

}