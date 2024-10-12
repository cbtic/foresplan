<?php

namespace App\Http\Livewire\Backend;

use App\Models\Producto;
use App\Models\TablaMaestra;
use App\Models\SalidaProducto;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SalidaProductoDetalle;
use App\View\Forms\SalidaProductosForm;
use RealRashid\SweetAlert\Facades\Alert;
// use App\Exports\ConductoresExport;
use Illuminate\Database\Eloquent\Builder;
use App\View\Forms\SalidaProductoDetallesForm;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class SalidaProductoDetallesTable extends DataTableComponent
{
    public $deleteId = '';
    public $id_salida_productos;

    protected $model = SalidaProductoDetalle::class;

    public function mount($salida_producto)
    {
        $this->id_salida_productos = $salida_producto;
    }

    public function builder(): Builder
    {
        return SalidaProductoDetalle::where('id_salida_productos','=', $this->id_salida_productos);
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return "javascript:'); rowclick(this); ('";
            });
        // ->setTableRowUrlTarget(function($row) {
        //     return '_self';
        // });
    }

    // public function deleteId($id)
    // {
    //     $this->deleteId = $id;
    // }

    // public function delete()
    // {
    //     Conductores::find($this->deleteId)->delete();
    // }

    public function bulkActions(): array
    {
        return [
        ];
    }


    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('id_salida_productos')
                ->hideIf(true)
                ->sortable()
                ->searchable(),
            Column::make("id_producto")
                ->hideIf(true)
                ->sortable(),
            Column::make('Producto')
                ->label(fn ($row) => Producto::find($row->id_producto)->denominacion)
                ->sortable()
                ->searchable(),
            Column::make('Item', 'item')
                ->sortable()
                ->searchable(),
            Column::make('Cantidad', 'cantidad')
                ->sortable(),
            Column::make('Numero Lote', 'numero_lote')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Vcto.', 'fecha_vencimiento')
                ->sortable(),
            Column::make('aplica_precio')
                ->hideIf(true)
                ->sortable(),
            Column::make('id_um')
                ->hideIf(true)
                ->sortable(),
            Column::make("Unidad de medida")
                ->label(fn ($row) => TablaMaestra::find($row->id_um)->denominacion)
                ->sortable(),
            Column::make('id_estado_productos')
                ->hideIf(true)
                ->sortable(),
            Column::make("Estado del bien")
                ->label(fn ($row) => TablaMaestra::find($row->id_estado_productos)->denominacion)
                ->sortable(),
            Column::make('id_marca')
                ->hideIf(true)
                ->sortable(),
            Column::make("Marca")
                ->label(fn ($row) => TablaMaestra::find($row->id_marca)->abreviatura)
                ->sortable(),
            Column::make('costo')
                ->hideIf(true)
                ->sortable(),
            Column::make('Estado'),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        // $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.salida_producto_detalles.show', ['salida_producto' => $row->id_salida_productos, 'salida_producto_detalles' => $row->id]) . '\'">Mostrarme</button>';
                        $delete = app(SalidaProductoDetallesForm::class)->delete($row)->modalTitle("Eliminar producto: ")->confirmAsModal("Eliminar?", "Eliminar", "btn btn-danger");

                        $edit = app(SalidaProductoDetallesForm::class)->edit($row)->asModal($triggerContent = 'Editar', $triggerClass = 'btn btn-success btn-salida', $message = null, $modalTitle = 'Editar el producto');
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
