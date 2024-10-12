<?php

namespace App\View\Forms;

use App\Models\Anaquele;
use App\Models\Almacene;
use App\Models\Seccione;
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

class AnaqueleForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Anaquele::class;

    public $routeParameters = [
                                'id',
                                'codigo',
                                'denominacion',
                                'id_secciones',
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
    public $routePrefix = 'frontend.anaqueles';

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
            Text::make('codigo', [
                'required' => true,
            ]),
            Text::make('denominacion', [
                'label' => 'denominacion',
                'required' => true,
            ]),
            // HasMany::make('id_secciones', [
            //     'label' => 'Seccion',
            //     'model' => Seccione::class,
            //     'model_options' => [
            //         'label' => 'denominacion',
            //         'value' => 'id',
            //         'method' => 'all',
            //         'params' => null,
            //     ]
            // ])->selectOptions(['Seleccione' => null]),
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
}
