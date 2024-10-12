<?php

namespace App\View\Forms;

use App\Models\Almacene;
use App\Models\Ubigeo;
use Grafite\Forms\Forms\ModelForm;
use Grafite\Forms\Fields\TextArea;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Fields\Email;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Date;
use Grafite\Forms\Html\Button;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Fields\PasswordWithReveal;
use Grafite\Forms\Fields\AutoSuggestSelect;
use Grafite\Forms\Fields\Hidden;
use Grafite\Forms\Forms\Form;

class AlmaceneForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Almacene::class;

    public $routeParameters = ['id'];

    public $columns = 3;

    public $hasFiles = true;

    public $instance;

    public $disableOnSubmit = true;

    // public $confirmMessage = "Confirma que desea eliminar el registro?";

    // public $confirmMethod = "confirmar";

    // public $columns = 'sections';

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'frontend.almacenes';

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

    // public function confirmar() {
    //     return "";
    // }

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            // HasOne::make('id_ubigeo', [
            //     'label' => 'Ubigeo',
            //     'model' => Ubigeo::class,
            //     'model_options' => [
            //         'label' => 'nombre_completo',
            //         'value' => 'id',
            //         'method' => 'all',
            //         'params' => null,
            //     ]
            // ])->selectOptions(['Seleccione' => null]),
            Text::make('codigo', [
                'required' => true,
            ]),
            Text::make('denominacion', [
                'required' => true,
            ]),
            Hidden::make('id_ubigeo', [
                'required' => true,
            ]),
            HasOne::make('id_departamento', [
                'label' => 'Departamento',
                'model' => Ubigeo::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'departamentos',
                    'params' => '',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Select::make('id_provincia', ['label' => 'Provincia'])
                ->selectOptions(['Seleccione' => null]),
            Select::make('id_distrito', ['label' => 'Distrito'])
                ->selectOptions(['Seleccione' => null]),
            Text::make('direccion', [
                'required' => true,
            ]),
            Text::make('telefono', [
                'required' => false,
            ]),
            Text::make('encargado', [
                'required' => false,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '0']),
            // AutoSuggestSelect::make('estado')->selectOptions(['ACTIVO' => 'ACTIVO', 'CANCELADO' => 'CANCELADO']),
            // Hidden::make('personas_id', [
            //     'required' => true,
            // ]),
            // Text::make('persona', [
            //     'required' => true,
            // ]),
        ];
    }

    // public function setSections()
    // {
    //     return [
    //         [
    //             'codigo',
    //             'denominacion',
    //         ],
    //         [
    //             'id_departamento',
    //             'id_provincia',
    //             'id_distrito'
    //         ],
    //         [
    //             'direccion',
    //             'telefono',
    //             'encargado'
    //         ]
    //     ];
    // }
}
