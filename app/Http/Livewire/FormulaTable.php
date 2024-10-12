<?php

namespace App\Http\Livewire;

use App\Models\Formula as Formulas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FormulaTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Tipo Plan Tpl', 'planilla.desc_tipo_tpl')
                ->sortable()
                ->searchable(),
            
            Column::make('Subt Plan Tpl', 'subplanilla.titu_subt_stp')
                ->sortable()
                ->searchable(),
            
            Column::make('Codi Conc Tco', 'concepto.desc_conc_tco')
                ->sortable()
                ->searchable(),
            
            Column::make('Formula For', 'formula_for')
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
        return Formulas::query();
    }

}