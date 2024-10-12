<?php

namespace App\View\Forms;

use App\Models\Lote;
use App\Models\Almacene;
use App\Models\Anaquele;
use App\Models\Seccione;
use App\Models\Producto;
use Grafite\Forms\Forms\ModelForm;
use Grafite\Forms\Fields\TextArea;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Fields\Email;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\HasMany;
use Grafite\Forms\Fields\Date;
use Grafite\Forms\Html\Button;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Fields\Hidden;
use TablaMaestra;

class LoteForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = Lote::class;

    public $routeParameters = ['id'];

    public $columns = 2;

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
    public $routePrefix = 'frontend.lotes';

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
        'submit' => 'Guardar Lote'
    ];

    /**
     * Set the desired fields for the form
     *
     * @return array
     */
    public function fields()
    {
        return [
            HasOne::make('id_producto', [
                'label' => 'Producto',
                'model' => Producto::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Seleccione' => null]),
            HasOne::make('id_marca', [
                'label' => 'Marca',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '47',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('numero_lote', [
                'required' => true,
            ]),
            Text::make('numero_serie', [
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
            Text::make('cantidad', [
                'required' => true,
            ]),
            Text::make('costo', [
                'label' => 'Costo',
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
            Date::make('fecha_fabricacion', [
                'required' => true,
            ]),
            Date::make('fecha_vencimiento', [
                'required' => true,
            ]),
            HasOne::make('id_almacen', [
                'label' => 'Escoja el almacen',
                'model' => Almacene::class,
                'model_options' => [
                    'label' => 'codigo',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Escoger' => null]),
            HasOne::make('id_seccion', [
                'label' => 'Escoja la seccion',
                'model' => Seccione::class,
                'model_options' => [
                    'label' => 'codigo',
                    'value' => 'id',
                    'method' => 'all',
                    'params' => null,
                ]
            ])->selectOptions(['Escoger' => null]),
            HasOne::make('id_anaquel', [
                'label' => 'Escoja el anaquel',
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
