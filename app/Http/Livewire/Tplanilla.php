<?php

namespace App\Http\Livewire;

use App\Models\Tplanilla as Planillas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Tplanilla extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            Column::make('Tipo Planilla', 'tipo_plan_tpl')
                ->sortable()
                ->searchable(),
            Column::make('Descripcion', 'desc_tipo_tpl')
                ->sortable()
                ->searchable(),
            Column::make('Codigo', 'codi_oper_ope')
                ->sortable()
                ->searchable(),
            Column::make('Cond. Laboral', 'codi_cond_lab'),
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Planillas::query();
    }

}
