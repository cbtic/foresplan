<?php

namespace App\Http\Livewire;

use App\Models\PersonaDetalle as Persona_Detalles;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PersonaDetalleTable extends DataTableComponent
{
    protected $listeners = [
        '$refresh'
    ];

    public function setTableRowId($row): ?string
    {
        return 'row-' . $row->nombres.'-'. $row->apellido_paterno;
    }
    
    public function setTableDataAttributes(Column $column, $row): array
    {
        if ($column->column() === 'nombres') {
            return ['value' => 'that'];
        }

        return [];
    }

    public function setTableRowAttributes($row): array
    {
        return $row->nombres ? ['this' => 'that'] : [];
    }

    public function columns(): array
    {
        return [
            
            Column::make('id')
                ->sortable(),
            /*
            Column::make('Id Persona', 'id_persona')
                ->sortable()
                ->searchable(),
            */
            Column::make('T_Doc', 'abre_docu_did')
                ->sortable()
                ->searchable(),              
            Column::make('DNI', 'numero_documento')
                ->sortable()
                ->searchable(),            
			Column::make('A_Paterno', 'apellido_paterno')
                ->sortable()
                ->searchable(),
            Column::make('A_Materno', 'apellido_materno')
                ->sortable()
                ->searchable(),
            Column::make('Nombres', 'nombres')
                ->sortable()
                ->searchable(),              
            Column::make('Condicion_Laboral', 'desc_cond_lab')
                ->sortable()
                ->searchable(),
                /*
            Column::make('Cargo', 'desc_carg_tca')
                ->sortable()
                ->searchable(),  
                */          
            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),  
                /*
            Column::make('Direccion', 'direccion')
                ->sortable()
                ->searchable(),
            				
            Column::make('Ubigeo', 'ubigeo')
                ->sortable()
                ->searchable(),
            
            Column::make('Telefono', 'telefono')
                ->sortable()
                ->searchable(),
            
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            
            Column::make('Foto', 'foto')
                ->sortable()
                ->searchable(),
            
            Column::make('Fecha Ingreso', 'fecha_ingreso')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Condicion Laboral', 'id_condicion_laboral')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Tipo Planilla', 'id_tipo_planilla')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Profesion', 'id_profesion')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Banco Sueldo', 'id_banco_sueldo')
                ->sortable()
                ->searchable(),
            
            Column::make('Num Cuenta Sueldo', 'num_cuenta_sueldo')
                ->sortable()
                ->searchable(),
            
            Column::make('Cci Sueldo', 'cci_sueldo')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Regimen Pensionario', 'id_regimen_pensionario')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Afp', 'id_afp')
                ->sortable()
                ->searchable(),
            
            Column::make('Fecha Afiliacion Afp', 'fecha_afiliacion_afp')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Tipo Comision Afp', 'id_tipo_comision_afp')
                ->sortable()
                ->searchable(),
            
            Column::make('Cuspp', 'cuspp')
                ->sortable()
                ->searchable(),
            
            Column::make('Fecha Cese', 'fecha_cese')
                ->sortable()
                ->searchable(),
            
            Column::make('Fecha Termino Contrato', 'fecha_termino_contrato')
                ->sortable()
                ->searchable(),
            
            Column::make('Num Contrato', 'num_contrato')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Cargo', 'id_cargo')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Nivel', 'id_nivel')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Banco Cts', 'id_banco_cts')
                ->sortable()
                ->searchable(),
            
            Column::make('Num Cuenta Cts', 'num_cuenta_cts')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Moneda Cts', 'id_moneda_cts')
                ->sortable()
                ->searchable(),
            
            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),
            
            Column::make('Id Ubicacion', 'id_ubicacion')
                ->sortable()
                ->searchable(),
                */
            
            Column::make('Acciones', 'id')
                ->format(function($value) {
                    return "<button onclick=\"event.preventDefault();Livewire.emit('edit','$value')\" class='btn btn-primary btn-sm'>Edit</button> <button onclick=\"event.preventDefault();Livewire.emit('delete','$value')\" class='btn btn-primary btn-sm'>Delete</button>";
                })
                ->asHtml(),
        ];
    }
	/*
    public function query(): Builder
    {
        return Persona_Detalles::query()->orderBy('id', 'desc');
    }
	*/
	public function query(): Builder
    {
        return Persona_Detalles::query()                
		->select('documento_identidades.abre_docu_did as abre_docu_did', 'personas.numero_documento as numero_documento', 'personas.nombres as nombres', 'personas.apellido_paterno as apellido_paterno', 'personas.apellido_materno as apellido_materno', 'condicion_laborales.desc_cond_lab as desc_cond_lab','persona_detalles.*')
		/*->select('documento_identidades.abre_docu_did as abre_docu_did', 'personas.numero_documento as numero_documento', 'personas.nombres as nombres', 'personas.apellido_paterno as apellido_paterno', 'personas.apellido_materno as apellido_materno', 'condicion_laborales.desc_cond_lab as desc_cond_lab','tcargos.desc_carg_tca as desc_carg_tca','persona_detalles.*')        */
        ->Join('tabla_ubicaciones', 'tabla_ubicaciones.id', 'persona_detalles.id_condicion_laboral')
        ->Join('personas', 'personas.id', 'persona_detalles.id_persona')
        ->Join('condicion_laborales', 'condicion_laborales.id', 'tabla_ubicaciones.id_registro')
        //->leftJoin('tcargos', 'tcargos.id', 'tabla_ubicaciones.id_registro')
        ->Join('documento_identidades', 'documento_identidades.id', 'personas.tipo_documento')
        ->where([            
            ['tabla_ubicaciones.id_ubicacion', '=', '1'],
            ['tabla_ubicaciones.tabla', '=', 'condicion_laborales'],
            ['tabla_ubicaciones.estado', '=', 'A'],
        ])
        ->orderBy('apellido_paterno', 'asc', 'apellido_materno', 'asc', 'nombres','asc');


    }
	
}