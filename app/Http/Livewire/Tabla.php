<?php

namespace App\Http\Livewire;

use App\Models\Tabla as Tablas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Tabla extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            Column::make('Codigo', 'tab_ite1_cod')
                ->sortable()
                ->searchable(),
            Column::make('Nombre', 'tab_larg_des')
                ->sortable()
                ->searchable(),
            Column::make('ACRONIMO', 'tab_cort_des')
                ->sortable()
                ->searchable(),
            Column::make('Estado', 'tab_tabl_est'),
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Tablas::query();
    }

}