<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class RolesTable extends DataTableComponent
{
    protected $model = Role::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make('Type')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
            //Column::make('Permissions'),
            //Column::make(__('Number of Users'), 'users_count')
            //    ->sortable(),
            // Column::make('Actions'),
        ];
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            // return route('admin.auth.role.edit', $row);
        });

    }

    public function rowView(): string
    {
        return 'backend.auth.role.includes.row';
    }
}
