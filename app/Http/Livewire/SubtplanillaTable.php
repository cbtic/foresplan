<?php

namespace App\Http\Livewire;

use App\Models\Subtplanilla as Subtplanillas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SubtplanillaTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Tipo Plan Tpl', 'tipo_plan_tpl')
                ->sortable()
                ->searchable(),
            
            Column::make('Subt Plan Stp', 'subt_plan_stp')
                ->sortable()
                ->searchable(),
            
            Column::make('Desc Subt Stp', 'desc_subt_stp')
                ->sortable()
                ->searchable(),
            
            Column::make('Titu Subt Stp', 'titu_subt_stp')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Docu Tpd', 'tipo_docu_tpd')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Mcpp Stp', 'tipo_mcpp_stp')
                ->sortable()
                ->searchable(),
            
            Column::make('Clase Mcpp Stp', 'clase_mcpp_stp')
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
        return Subtplanillas::query();
    }

}