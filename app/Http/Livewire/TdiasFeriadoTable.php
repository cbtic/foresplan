<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use App\Models\TdiasFeriado as Tdias_Feriados;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TdiasFeriadoTable extends DataTableComponent
{
    protected $year;

    public function __construct() 
    {
        $this->year = Carbon::now()->format('Y');
        $this->filters = array('date' => $this->year);
    }

    protected $listeners = [
        '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            
            Column::make('Fech Feri Tdf', 'fecha_feriado')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Mdia Tdf', 'flag_mdia_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Sali Mdia Tdf', 'sali_mdia_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Moti Feri Tdf', 'moti_feri_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Nlab Tdf', 'flag_nlab_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Frec Tdf', 'fech_frec_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Fech Irec Tdf', 'fech_irec_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Flag Recu Tdf', 'flag_recu_tdf')
                ->sortable()
                ->searchable(),
            
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }

    public function filters(): array
    {
        $years = Tdias_Feriados::select(\DB::raw('extract(year from fech_feri_tdf) as year'))
                    ->groupBy(\DB::raw('year'))
                    ->orderBy(\DB::raw('year'), 'desc')
                    ->get();

        // $filtered = $years->map(function ($year) {return $year;})->toArray();
        $array_years = array_column($years->toArray(), 'year');
        $filtered = array_combine($array_years, $array_years);
        
        return [
            'date' => Filter::make('Año')
                ->select($filtered)
        ];
    }

    public function query(): Builder
    {
        return Tdias_Feriados::query()
            ->selectRaw("tdias_feriados.*,to_char(fech_feri_tdf::timestamp,'DD/MM/YYYY')fecha_feriado")
            ->when($this->getFilter('date'), fn ($query, $year) => $query
                ->where('fech_feri_tdf', '>=', $year."-01-01")
                ->where('fech_feri_tdf', '<=', $year."-12-31"))
            ->OrderBy('fech_feri_tdf','asc');
    }

}