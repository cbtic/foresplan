<?php

namespace App\Http\Livewire;

use App\Models\Vacacione as Vacaciones;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use DB;

class VacacioneTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Codi Empl Per', 'codi_empl_per')
                ->sortable()
                ->searchable(),
            
			Column::make('Nombre', 'primer_nombre')
                ->sortable()
                ->searchable(),
				
            Column::make('Ano Peri Vac', 'ano_peri_vac')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Peri Vac', 'nume_peri_vac')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Inic Vac', 'fech_inic_vac')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Fina Vac', 'fech_fina_vac')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Corr', 'id_corr')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Corrant', 'id_corrant')
                ->sortable()
                ->searchable(),
            
            Column::make('Fg Estado', 'fg_estado')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Registro', 'fech_registro')
                ->sortable()
                ->searchable(),
            
            Column::make('Secu Oper Ope', 'secu_oper_ope')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Reso Ope', 'nume_reso_ope')
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
        return Vacaciones::query()
		->Join('personas', 'personas.id', 'vacaciones.codi_empl_per')->select('personas.nombres as primer_nombre','vacaciones.*');
		//->leftJoin('personas', 'personas.id', 'vacaciones.codi_empl_per')->select('personas.nombres as primer_nombre','vacaciones.*');
		

		
    }

}