<?php

namespace App\Http\Livewire;

use App\Models\{{ Model_name.title().replace("_","") }} as {{ Model_name.title() }}s;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class {{ Model_name.title().replace("_","") }}Table extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            {% for campo in campos %}
            Column::make('{{ campo.name.replace("_", " ").title() }}', '{{ campo.name }}')
                ->sortable()
                ->searchable(),
            {% endfor %}
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return {{ Model_name.title() }}s::query();
    }

}
