<?php

namespace App\View\Forms;

use App\Models\Producto;
use App\Models\Almacene;
use App\Models\Anaquele;
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
use TablaMaestra;

class ProductoForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Producto::class;

    public $routeParameters = ['id'];

    public $submitViaAjax = true;

    public $confirmMessage = 'Esta grabando datos';
    public $confirmSubmission = 'Se enviaron los datos';

    public $submitMethod = 'ajax';

    public $columns = 2;

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
    public $routePrefix = 'frontend.productos';

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
        'submit' => 'Guardar'
    ];

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('numero_serie', [
                'required' => true,
            ]),
            Text::make('codigo', [
                'required' => true,
            ]),
            Text::make('denominacion', [
                'required' => true,
            ]),
            HasOne::make('id_unidad_medida', [
                'label' => 'Unidades',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '43',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('stock_actual', [
                'required' => true,
            ]),
            Text::make('costo_unitario', [
                'label' => 'Costo Unitario',
                'required' => true,
            ]),
            HasOne::make('id_moneda', [
                'label' => 'Moneda',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '1',
                ]
            ])->selectOptions(['Seleccione' => null]),
            HasOne::make('id_tipo_producto', [
                'label' => 'Tipo de Producto',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '44',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Date::make('fecha_vencimiento', [
                'required' => true,
            ]),
            HasOne::make('id_estado_bien', [
                'label' => 'Estado del Bien',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '4',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('stock_minimo', [
                'required' => true,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '0']),
        ];
    }
}
