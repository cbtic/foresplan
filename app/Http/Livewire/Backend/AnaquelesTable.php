<?php

namespace App\Http\Livewire\Backend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Anaquele;
use Illuminate\Database\Eloquent\Builder;
use App\View\Forms\AnaqueleForm;

class AnaquelesTable extends DataTableComponent
{
    protected $model = Anaquele::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Anaquele::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.anaqueles.edit', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            return '_self';
        });
    }

    public function delete($id) {

        if(intval($id) == 0){
            return;
        }
        $types = Anaquele::findOrFail(intval($id));
        $types->delete();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Denominacion", "denominacion")
                ->sortable(),
            Column::make("Estado")
                ->label(fn($row) => array("CANCELADO","ACTIVO")[Anaquele::find($row->id)["estado"]])
                ->sortable(),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.anaqueles.show', $row) . '\'">Mostrar</button>';
                        $delete = app(AnaqueleForm::class)->delete($row)->modalTitle("Eliminar anaquel: ")->confirmAsModal("Eliminar anaquel ".$row->codigo."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
