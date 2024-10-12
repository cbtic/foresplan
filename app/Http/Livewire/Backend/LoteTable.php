<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Producto;
use App\Models\Lote;
use App\Models\TablaMaestra;
use App\Models\Anaquele;
use Illuminate\Database\Eloquent\Builder;
use App\View\Forms\LoteForm;

class LoteTable extends DataTableComponent
{
    protected $model = Lote::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Lote::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.lotes.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function delete($id) {

        if(intval($id) == 0){
            return;
        }
        $types = Lote::findOrFail(intval($id));
        $types->delete();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("id_producto", "id_producto")
                ->hideIf(true)
                ->sortable(),
            Column::make("Producto")
                ->label(fn ($row) => Producto::find($row->id_producto)->denominacion)
                ->sortable(),
            Column::make("id_marca")
                ->hideIf(true)
                ->sortable(),
            Column::make("Marca")
                ->label(fn ($row) => TablaMaestra::find($row->id_marca)->abreviatura)
                ->sortable(),
            Column::make("Numero Lote", "numero_lote")
                ->sortable(),
            Column::make("Numero Serie", "numero_serie")
                ->sortable(),
            Column::make("Unidad", "id_unidad_medida")
                ->sortable(),
            Column::make("Cantidad", "cantidad")
                ->sortable(),
            Column::make("Costo", "costo")
                ->sortable(),
            Column::make("Moneda", "id_moneda")
                ->hideIf(true)
                ->sortable(),
            Column::make("Moneda")
                ->label(fn ($row) => TablaMaestra::find($row->id_moneda)->abreviatura)
                ->sortable(),
            Column::make("fecha_fabricacion", "fecha_fabricacion")
                ->sortable(),
            Column::make("fecha_vencimiento", "fecha_vencimiento")
                ->sortable(),
            Column::make("Anaquel", "id_anaquel")
                ->hideIf(true)
                ->sortable(),
            Column::make("Anaquel")
                ->label(fn ($row) => Anaquele::find($row->id_anaquel)->codigo)
                ->sortable(),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[Lote::find($row->id)["estado"]])
                ->sortable(),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.lotes.show', $row) . '\'">Mostrar</button>';
                        $delete = app(LoteForm::class)->delete($row)->modalTitle("Eliminar lote: ")->confirmAsModal("Eliminar lote ".$row->numero_lote."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
