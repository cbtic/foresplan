<?php

namespace App\View\Forms;

use App\Models\Conductores;
use App\Models\Persona;
use App\Models\Empresa;
use App\Models\Vehiculo;
use Grafite\Forms\Forms\ModelForm;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\HasOne;
use Str;

class VehiculoForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Vehiculo::class;

    public $routeParameters = [
                                'id',
                                'placa',
                                'ejes',
                                'peso_tracto',
                                'peso_carreta',
                                'peso_seco',
                                'estado',
                            ];
    public $columns = 1;

    public $hasFiles = true;

    public $instance;

    public $disableOnSubmit = true;

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'frontend.vehiculos';

    /**
     * Buttons and values
     *
     * You can add a `cancel => Cancel`
     * which will create a cancel button.
     * Then you can set it's route with the
     * `buttonLinks` property.
     *
     * @var array
     */
    public $buttons = [
        'cancel' => 'Cancelar',
        'submit' => 'Guardar',
        'delete' => 'Borrar'
    ];

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            HasOne::make('id_empresas', [
                'label' => 'Empresa',
                'model' => Empresa::class,
                'model_options' => [
                    'label' => 'nombre_comercial',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Seleccione' => null]),
            HasMany::make('id_conductores', [
                'label' => 'Conductores',
                'model' => Conductores::class,
                'model_options' => [
                    'label' => 'nombre_completo_sin_dni',
                    'value' => 'id',
                    'method' => 'full_name',
                    'params' => 'ACTIVO',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('placa', [
                'required' => true,
            ]),
            Text::make('ejes', [
                'required' => true,
            ]),
            Text::make('peso_tracto', [
                'required' => false,
            ]),
            Text::make('peso_carreta', [
                'required' => false,
            ]),
            Text::make('peso_seco', [
                'required' => false,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '2']),
        ];
    }
}
