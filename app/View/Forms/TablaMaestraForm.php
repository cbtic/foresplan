<?php

namespace App\View\Forms;

use App\Models\TablaMaestra;
use Grafite\Forms\Forms\ModelForm;
use Grafite\Forms\Fields\TextArea;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Fields\Email;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Date;
use Grafite\Forms\Html\Button;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Fields\Number;
use Grafite\Forms\Fields\PasswordWithReveal;
use Grafite\Forms\Fields\AutoSuggestSelect;
use Grafite\Forms\Fields\Hidden;

class TablaMaestraForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = TablaMaestra::class;

    public $routeParameters = ['id','tipo', 'denominacion', 'orden', 'estado', 'codigo', 'tipo_nombre'];

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
    public $routePrefix = 'frontend.tablamaestras';

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
            Number::make('tipo'),
            Text::make('denominacion', [
                'required' => true,
            ]),
            Number::make('codigo', [
                'required' => true,
            ]),
            Text::make('tipo_nombre', [
                'required' => true,
            ]),
            Text::make('sub_codigo', [
                'required' => false,
            ]),
            Text::make('abreviatura', [
                'required' => false,
            ]),
            Number::make('orden', [
                'required' => true,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '2']),
        ];
    }
}
