<?php

namespace App\Http\Livewire;

use App\Models\Empresa as Empresas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EmpresaTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Ruc', 'ruc')
                ->sortable()
                ->searchable(),
            
            Column::make('Nombre Comercial', 'nombre_comercial')
                ->sortable()
                ->searchable(),
            
            Column::make('Razon Social', 'razon_social')
                ->sortable()
                ->searchable(),
            
            Column::make('Direccion', 'direccion')
                ->sortable()
                ->searchable(),
            
            Column::make('Representante', 'representante')
                ->sortable()
                ->searchable(),
            
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            
            Column::make('Telefono', 'telefono')
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
        return Empresas::query();
    }

}