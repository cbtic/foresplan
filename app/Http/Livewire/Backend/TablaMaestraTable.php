<?php

namespace App\Http\Livewire\Backend;

use App\Models\TablaMaestra;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TablaMaestraTable extends DataTableComponent
{
    protected $model = TablaMaestra::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return TablaMaestra::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.tablamaestras.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tipo", "tipo_nombre")
                ->searchable()
                ->sortable(),
            Column::make("Denominacion", "denominacion")
                ->searchable()
                ->sortable(),
            Column::make("Orden", "orden")
                ->sortable(),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[TablaMaestra::find($row->id)["estado"]])
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Grupo','tipo_nombre')
                ->options(
                    TablaMaestra::query()
                        ->orderBy('tipo_nombre')
                        ->get()
                        ->keyBy('tipo')
                        ->map(fn($row) => $row->tipo_nombre)
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('tabla_maestras.tipo', $value);
                })
                ->setFilterPillValues([
                    '3' => 'Tag 1',
                ]),
        ];
    }
}
