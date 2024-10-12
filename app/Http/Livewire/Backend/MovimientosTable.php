<?php

namespace App\Http\Livewire\Backend;

use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\TablaMaestra;
use App\Domains\Auth\Models\User;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class MovimientosTable extends DataTableComponent
{
    protected $model = Movimiento::class;

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id');
          // Takes a callback that gives you the current row and its index

        $this->setTrAttributes(function($row, $index) {
            if ($row["tipo_movimiento"] == 'ENTRADA') {
                return [
                'class' => 'entrada',
                ];
            }

            return [
                'class' => 'salida',
                ];
        });
        }

    public function query(): Builder
    {
        return Movimiento::when($this->getFilter('search'), fn ($query, $term) => $query->search($term), function (Builder $query) {
            $query->orderBy('entrada_salida_cantidad', 'desc');
        });
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
            Column::make("Número Lote", "numero_lote")
                ->sortable(),
            Column::make("Tipo Movimiento", "tipo_movimiento")
                ->sortable(),
            Column::make("Entrada Salida Cantidad", "entrada_salida_cantidad")
                ->sortable(),
            Column::make("Costo Entrada Salida", "costo_entrada_salida")
                ->sortable(),
            Column::make("id_users")
                ->hideIf(true)
                ->sortable(),
            Column::make("Usuario")
                ->label(fn ($row) => User::find($row->id_users)->name)
                ->sortable(),
            Column::make("id_personas")
                ->hideIf(true)
                ->sortable(),
            Column::make("Persona")
                ->label(fn ($row) => Persona::find($row->id_personas)->nombres)
                ->sortable(),
            Column::make("Fecha Mov.", "fecha_movimiento")
                ->sortable()
        ];
    }
}
