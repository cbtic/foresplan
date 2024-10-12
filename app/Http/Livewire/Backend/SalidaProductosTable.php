<?php

namespace App\Http\Livewire\Backend;

use App\Models\TablaMaestra;
use App\Models\SalidaProducto;
use Maatwebsite\Excel\Facades\Excel;
use App\View\Forms\SalidaProductosForm;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;
// use App\Exports\ConductoresExport;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class SalidaProductosTable extends DataTableComponent
{
    public $deleteId = '';

    protected $model = SalidaProducto::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return SalidaProducto::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.salida_productos.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
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
                ->sortable(),
            Column::make('Salida', 'fecha_salida')
                ->sortable()
                ->searchable(),
            Column::make('id_tipo_documento')
                ->hideIf(true),
            Column::make("Tipo Doc.")
                ->label(fn ($row) => TablaMaestra::find($row->id_tipo_documento)->denominacion)
                ->sortable(),
            Column::make('Unidad Destino', 'unidad_destino')
                ->sortable()
                ->searchable(),
            Column::make('Nro. Comprobante', 'numero_comprobante')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Comprobante', 'fecha_comprobante')
                ->sortable(),
            Column::make('Estado'),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.salida_productos.show', $row->id) . '\'">Mostrar</button>';
                        $delete = app(SalidaProductosForm::class)->delete($row)->modalTitle("Eliminar conductor: ")->confirmAsModal("Eliminar?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
