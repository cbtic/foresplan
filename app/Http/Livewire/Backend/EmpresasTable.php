<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Empresa;
use App\Domains\Auth\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ClientesTable.
 */
class EmpresasTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Empresa::query();
        return Empresa::with('permissions:ruc,nombre_comercial,razon_social,direccion,representante,email,telefono,estado')
            ->withCount('users')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make('RUC', 'ruc')
                ->sortable(),
            Column::make('NOMBRE', 'nombre_comercial')
                ->sortable(),
            Column::make('NOM COMER', 'razon_social')
                ->sortable(),
            Column::make('DIRECCION', 'direccion')
                ->sortable(),
            Column::make('REPRES', 'representante')
                    ->sortable(),
            Column::make('EMAIL', 'email')
                ->sortable(),
            Column::make('TELEFONO', 'telefono')
                ->sortable(),
            Column::make(__('Estado'), 'estado')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }
    
    public function rowView(): string
    {
        return 'backend.auth.empresa.includes.row';
    }
}
