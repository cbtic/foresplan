<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Cliente;
use App\Domains\Auth\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ClientesTable.
 */
class ClientesTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Cliente::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Cliente', 'denominacion')
                ->sortable(),
            Column::make(__('Estado'), 'estado')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    // public function rowView(): string
    // {
    //     return 'backend.auth.role.includes.row';
    // }
}
