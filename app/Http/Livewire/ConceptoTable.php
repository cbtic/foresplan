<?php

namespace App\Http\Livewire;

use App\Models\Concepto as Conceptos;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ConceptoTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Codi Conc Tco', 'codi_conc_tco')
                ->sortable()
                ->searchable(),
            
            Column::make('Desc Conc Tco', 'desc_conc_tco')
                ->sortable()
                ->searchable(),
            
            Column::make('Desc Cort Tco', 'desc_cort_tco')
                ->sortable()
                ->searchable(),
            
            Column::make('Estado', 'estado')
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
        return Conceptos::query();
    }

}