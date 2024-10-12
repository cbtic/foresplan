<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class UsersTable extends DataTableComponent
{

    protected $model = User::class;

    /**
     * @var
     */
    public $status;

    /**
     * @var array|string[]
     */
    public array $sortNames = [
        'email_verified_at' => 'Verified',
        'two_factor_auth_count' => '2FA',
    ];

    /**
     * @var array|string[]
     */
    public array $filterNames = [
        'type' => 'User Type',
        'verified' => 'E-mail Verified',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = User::with('roles', 'twoFactorAuth');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getFilter('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'));
    }


    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make('Type')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
            Column::make('E-mail', 'email')
                ->sortable(),
            Column::make('Verified', 'email_verified_at')
                ->sortable(),
            // Column::make('Acciones')
            //     ->unclickable()
            //     ->label(
            //         function ($row, Column $column) {
            //             $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('admin.auth.user.edit', $row ) . '\'">Editar</button>';
            //             $delete = '<button class="btn btn-xs btn-danger text-white" wire:click="delete(' . $row->id . ')">Eliminar</button>';
            //             return $edit . " " . $delete;
            //         }
            //     )->html(),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.user.includes.row';
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('admin.auth.user.edit', User::where('email', $row->email)->pluck("id")[0]);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }
}
