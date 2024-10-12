<?php

namespace App\Http\Livewire;

use App\Models\TipoOperacione as Tipo_Operaciones;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TipoOperacioneTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Codi Oper Top', 'codi_oper_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Tipo Oper Top', 'tipo_oper_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Codi Conc Tco', 'codi_conc_tco')
                ->sortable()
                ->searchable(),
            
            Column::make('Desc Oper Top', 'desc_oper_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Cont Dias Top', 'cont_dias_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Nume Dias Top', 'nume_dias_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Desc Pago Top', 'desc_pago_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Veri Reso Top', 'veri_reso_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Dcto Cts Top', 'dcto_cts_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Clas Oper Top', 'clas_oper_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Omis Top', 'flag_omis_top')
                ->sortable()
                ->searchable(),
            
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Tipo_Operaciones::query();
    }

}