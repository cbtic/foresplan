<?php

namespace App\Http\Livewire;

use App\Models\Tbanco as Tbancos;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TbancoTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Codi Banc Tbc', 'codi_banc_tbc')
                ->sortable()
                ->searchable(),
            
            Column::make('Nomb Banc Tbc', 'nomb_banc_tbc')
                ->sortable()
                ->searchable(),
            
            Column::make('Nomb Cort Tbc', 'nomb_cort_tbc')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Activ Ban', 'flag_activ_ban')
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
        return Tbancos::query();
    }

}