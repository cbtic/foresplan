<?php

namespace App\Http\Livewire\Backend;

use App\Models\Kardex;
use App\Models\Producto;
use App\Models\TablaMaestra;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class KardexTable extends DataTableComponent
{
    protected $model = Kardex::class;

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id');
    }

    public function query(): Builder
    {
        return Kardex::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("id_producto")
                ->hideIf(true)
                ->sortable(),
            Column::make("Producto")
                ->label(fn ($row) => Producto::find($row->id_producto)->denominacion)
                ->sortable(),
            Column::make("Entradas", "entradas_cantidad")
                ->sortable(),
            Column::make("Costo Entradas", "costo_entradas_cantidad")
                ->sortable(),
            Column::make("Total Entrada", "total_entradas_cantidad")
                ->sortable(),
            Column::make("Salidas", "salidas_cantidad")
                ->sortable(),
            Column::make("Costo Salidas", "costo_salidas_cantidad")
                ->sortable(),
            Column::make("Total Salida", "total_salidas_cantidad")
                ->sortable(),
            Column::make("Saldos", "saldos_cantidad")
                ->sortable(),
            Column::make("Costo saldos", "costo_saldos_cantidad")
                ->sortable(),
            Column::make("Total Saldos", "total_saldos_cantidad")
            ->sortable()
        ];
    }
}
