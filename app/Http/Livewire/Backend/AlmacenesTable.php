<?php

namespace App\Http\Livewire\Backend;

use App\Models\Almacene;
use App\Models\Ubigeo;
use Grafite\Forms\Fields\Bootstrap\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\View\Forms\AlmaceneForm;

class AlmacenesTable extends DataTableComponent
{
    protected $model = Almacene::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Almacene::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.almacenes.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function delete($id) {

        if(intval($id) == 0){
            return;
        }
        $types = Almacene::findOrFail(intval($id));
        $types->delete();

    }


    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),
            Column::make('Denominacion', 'denominacion')
                ->sortable(),
            Column::make('Ubigeo', 'ubigeos.id_ubigeo')
                ->hideIf(true)
                ->sortable()
                ->searchable(),
            Column::make("Ubicacion")
                ->label(fn ($row) => Ubigeo::UbigeoCompletoAttribute($row["ubigeos.id_ubigeo"]))
                ->sortable(),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[Almacene::find($row->id)["estado"]])
                ->sortable(),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.almacenes.show', $row->id) . '\'">Mostrar</button>';
                        $delete = app(AlmaceneForm::class)->delete($row)->modalTitle("Eliminar almacen: ")->confirmAsModal("Eliminar almacen ".$row->codigo."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
