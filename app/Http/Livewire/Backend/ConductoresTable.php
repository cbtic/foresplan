<?php

namespace App\Http\Livewire\Backend;

use App\Models\Conductores;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Exports\ConductoresExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\View\Forms\ConductoresForm;

class ConductoresTable extends DataTableComponent
{
    public $deleteId = '';

    protected $model = Conductores::class;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Conductores::when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function configure(): void
    {
        $this->setPerPageAccepted([50, 100, 150]);

        $this->setPerPage(50);

        $this->setDefaultSort('id', 'desc');

        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('frontend.conductores.edit', $row);
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
            'export' => 'Exportar a Excel',
        ];
    }

    public function export()
    {
        if ($this->getSelected()) {
            $conductores = $this->getSelected();

            $this->clearSelected();

            return Excel::download(new ConductoresExport($conductores), 'conductores.xlsx');
        }

        // Announcement::create([
        //     'area' => null,
        //     'type' => 'info',
        //     'message' => 'This is a <strong>Global</strong> announcement that will show on both the frontend and backend. <em>See <strong>AnnouncementSeeder</strong> for more usage examples.</em>',
        //     'enabled' => true,
        // ]);
        // $this->notify(__('You did not select any users to export.'), 'danger');
        Alert::success('Success Title', 'Success Message');

    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Nombre', 'personas.nombres')
                ->sortable()
                ->searchable(),
            Column::make('Ap. Pat.', 'personas.apellido_paterno')
                ->sortable()
                ->searchable(),
            Column::make('Ap. Mat.', 'personas.apellido_materno')
                ->sortable()
                ->searchable(),
            Column::make('Documento', 'personas.numero_documento')
                ->sortable(),
            Column::make('Licencia')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Emision', 'fecha_licencia')
                ->sortable(),
            Column::make('Estado'),
            Column::make('Acciones')
                ->unclickable()
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="btn btn-xs btn-success text-white" onclick="window.location.href=\'' . route('frontend.conductores.show', $row->id) . '\'">Mostrar</button>';
                        $delete = app(ConductoresForm::class)->delete($row)->modalTitle("Eliminar conductor: ")->confirmAsModal("Eliminar a ".((Conductores::find($row->id))->personas["nombre_completo_sin_dni"])."?", "Eliminar", "btn btn-danger");
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }
}
