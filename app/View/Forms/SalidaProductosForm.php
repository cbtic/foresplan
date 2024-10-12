<?php

namespace App\View\Forms;

use App\Models\SalidaProducto;
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

class SalidaProductosForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = SalidaProducto::class;

    public $routeParameters = ['id'];

    public $columns = 3;

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
    public $routePrefix = 'frontend.salida_productos';

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
            Date::make('fecha_salida', [
                'required' => true,
            ]),
            HasOne::make('id_tipo_documento', [
                'label' => 'Tipo Doc.',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '49',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('unidad_destino', [
                'required' => true,
            ]),
            Text::make('numero_comprobante', [
                'label' => 'Numero Comprobante',
                'required' => true,
            ]),
            Date::make('fecha_comprobante', [
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
            Text::make('tipo_cambio_dolar', [
                'required' => true,
            ]),
            Text::make('sub_total_compra', [
                'required' => true,
            ]),
            Text::make('igv_compra', [
                'required' => true,
            ]),
            Text::make('total_compra', [
                'required' => true,
            ]),
            Text::make('cerrado', [
                'required' => true,
            ]),
            Text::make('observacion', [
                'required' => true,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '0']),
        ];
    }
}
