<?php

namespace App\View\Forms;

use App\Models\Seccione;
use App\Models\Almacene;
use App\Models\Anaquele;
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

class SeccioneForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Seccione::class;

    public $routeParameters = ['id',
                                'codigo',
                                'denominacion',
                                'estado'];

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
    public $routePrefix = 'frontend.secciones';

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
            HasOne::make('id_almacenes', [
                'label' => 'Almacen',
                'model' => Almacene::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('codigo', [
                'required' => true,
            ]),
            Text::make('denominacion', [
                'required' => true,
            ]),
            HasMany::make('id_anaqueles', [
                'label' => 'Escoja los anaqueles que tendrá en la sección',
                'model' => Anaquele::class,
                'model_options' => [
                    'label' => 'codigo',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Escoger' => null]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '0']),
        ];
    }
}
