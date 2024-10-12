<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Seccione;
use App\Models\Anaquele;
use App\Models\Almacene;
use Illuminate\Database\Eloquent\Builder;
use App\View\Forms\SeccioneForm;

class SeccionesTable extends DataTableComponent
{
    protected $model = Seccione::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Seccione::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.secciones.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function delete($id) {

        if(intval($id) == 0){
            return;
        }
        $types = Seccione::findOrFail(intval($id));
        $types->delete();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Almacen")
                ->label(fn ($row) => $row->almacenes->pluck('codigo')->implode(', ')),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Denominacion", "denominacion")
                ->sortable(),
            Column::make("Anaqueles")
                ->label(fn ($row) => $row->anaqueles->pluck('codigo')->implode(', ')),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[Seccione::find($row->id)["estado"]])
                ->sortable(),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.secciones.show', $row) . '\'">Mostrar</button>';
                        $delete = app(SeccioneForm::class)->delete($row)->modalTitle("Eliminar sección: ")->confirmAsModal("Eliminar sección ".$row->codigo."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
