<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Producto;
use App\Models\Anaquele;
use App\Models\Almacene;
use App\Models\Seccione;
use Illuminate\Database\Eloquent\Builder;
use TablaMaestra;
use App\View\Forms\ProductoForm;

class ProductosTable extends DataTableComponent
{
    protected $model = Producto::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Producto::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.productos.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function delete($id) {

        if(intval($id) == 0){
            return;
        }
        $types = Producto::findOrFail(intval($id));
        $types->delete();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            // Column::make("numero_serie")
            //     ->label(fn ($row) => $row->empresas->pluck('nombre_comercial')->implode(', ')),
            // Column::make("codigo")
            //     ->sortable()
            //     ->label(fn ($row) => $row->conductores->pluck('licencia')->implode(', ')),
            // Column::make("Conductor")
            //     ->sortable()
            //     ->label(fn ($row) => Producto::find(($row->conductores->pluck('id')[0]))->personas['nombre_completo_sin_dni']),
            Column::make("Serie", "numero_serie")
                ->sortable(),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Denominacion", "denominacion")
                ->sortable(),
            Column::make("Unidad", "id_unidad_medida")
                ->hideIf(true)
                ->sortable(),
            Column::make("Unidad")
                ->label(fn ($row) => TablaMaestra::find($row->id_unidad_medida)->denominacion)
                ->sortable(),
            Column::make("Stock", "stock_actual")
                ->sortable(),
            Column::make("Vencimiento", "fecha_vencimiento")
                ->sortable(),
            Column::make("Estado del bien", "id_estado_bien")
                ->hideIf(true)
                ->sortable(),
            Column::make("Estado del bien")
                ->label(fn ($row) => TablaMaestra::find($row->id_estado_bien)->denominacion)
                ->sortable(),
            Column::make("Stock mínimo", "stock_minimo")
                ->sortable(),
            Column::make("Stock Actual", "stock_actual")
                ->sortable(),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[Producto::find($row->id)["estado"]])
                ->sortable(),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.productos.show', $row) . '\'">Mostrar</button>';
                        $delete = app(ProductoForm::class)->delete($row)->modalTitle("Eliminar producto: ")->confirmAsModal("Eliminar producto ".$row->codigo."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
