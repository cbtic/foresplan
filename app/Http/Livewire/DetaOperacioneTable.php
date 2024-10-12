<?php

namespace App\Http\Livewire;

use App\Models\DetaOperacione as Deta_Operaciones;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DetaOperacioneTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),

            Column::make('Persona', 'persona')
                ->sortable()
                //->searchable(),
			->searchable(function($builder, $term) {
					return $builder->orWhereHas('persona', function($query) use($term) {
					   return $query->where('apellido_paterno', 'ilike', '%'.$term.'%');
                	});
			}),

            
/*
            Column::make('Fech Oper Ope', 'fech_oper_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Tipo Operacion', 'id_tipo_operacion')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Persona', 'id_persona')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Oper Top', 'tipo_oper_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Inic Ope', 'fech_inic_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Fina Ope', 'fech_fina_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Dias Ope', 'nume_dias_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Reso Ope', 'nume_reso_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nomb Auto Ope', 'nomb_auto_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Reso Ope', 'fech_reso_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Hora Ope', 'tipo_hora_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Elab Ope', 'fech_elab_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Minut Ope', 'nume_minut_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Secu Oper Ope', 'secu_oper_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Esta Oper Ope', 'esta_oper_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Obse Oper Ope', 'obse_oper_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Codi Relo Per', 'codi_relo_per')
                ->sortable()
                ->searchable(),
            
            Column::make('Nro Citt Ope', 'nro_citt_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nro Sevit Ope', 'nro_sevit_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nro Medi Ope', 'nro_medi_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Obse Jefe Ope', 'obse_jefe_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Obse Rrhh Ope', 'obse_rrhh_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Rowidi', 'rowidi')
                ->sortable()
                ->searchable(),
            
            Column::make('Num Archivo', 'num_archivo')
                ->sortable()
                ->searchable(),
            
            Column::make('Codi Moti Tmo', 'codi_moti_tmo')
                ->sortable()
                ->searchable(),
            
            Column::make('User Crea', 'user_crea')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Crea', 'fech_crea')
                ->sortable()
                ->searchable(),
            
            Column::make('User Modi', 'user_modi')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Modi', 'fech_modi')
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
        return Deta_Operaciones::query();
    }

}