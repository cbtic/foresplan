<?php

namespace App\Http\Livewire;

use App\Models\Persona as Personas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

use Livewire\Component;

class Persona extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];
	

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable(),
            Column::make('Tipo', 'tipo_documento')
                ->sortable()
                ->searchable(),
            Column::make('dni', 'numero_documento')
                ->sortable()
                ->searchable(),
            Column::make('A Paterno', 'apellido_paterno')
                ->sortable()
                ->searchable(),
            Column::make('A Materno', 'apellido_materno')
                ->sortable()
                ->searchable(),
            Column::make('Nombres', 'nombres')
                ->sortable()
                ->searchable(),
            Column::make('A Nacimiento', 'fecha_nacimiento')
                ->sortable()
                ->searchable(),                                                
            Column::make('Sexo', 'sexo'),
            Column::make('Estado', 'estado'),
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Personas::query();
    }
}

