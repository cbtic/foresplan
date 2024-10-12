<?php

namespace App\View\Forms;

use TablaMaestra;
use App\Models\Producto;
use Grafite\Forms\Fields\Date;
use Grafite\Forms\Fields\Text;
use Grafite\Forms\Html\Button;
use Grafite\Forms\Fields\Email;
use Grafite\Forms\Fields\HasOne;
use Grafite\Forms\Fields\Hidden;
use Grafite\Forms\Fields\Select;
use Grafite\Forms\Fields\HasMany;
// use Grafite\Forms\Forms\BaseForm;
// use Grafite\Forms\Forms\ModalForm;
use Grafite\Forms\Fields\TextArea;
use Grafite\Forms\Forms\ModelForm;
use App\Models\SalidaProductoDetalle;
use Grafite\Forms\Fields\AutoSuggestSelect;
use Grafite\Forms\Fields\PasswordWithReveal;

class SalidaProductoDetallesForm extends ModelForm
{
    /**
     * The model for the form
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model = SalidaProductoDetalle::class;

    public $routeParameters = ['id'];

    public $entradaproducto;

    public $method = 'put';

    public $columns = 2;

    public $hasFiles = true;

    public $instance;

    //public $submitMethod = 'ajax';
    public $submitViaAjax = true;

    public $disableOnSubmit = true;

    /**
     * Required prefix of routes
     *
     * Can be `user` for all `user.`
     * name routes.
     *
     * @var string
     */
    public $routePrefix = 'frontend.salida_producto_detalles';

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
            Text::make('id', [
                'required' => true,
            ]),
            Hidden::make('id_salida_productos', [
                'required' => true,
                'value' => array_reverse(explode('/',\Request::getRequestUri()))[0]
            ]),
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
            Text::make('item', [
                'required' => true,
            ]),
            Text::make('cantidad', [
                'required' => true,
            ]),
            Text::make('numero_lote', [
                'required' => true,
            ]),
            Date::make('fecha_vencimiento', [
                'required' => true,
            ]),
            Text::make('aplica_precio', [
                'required' => true,
            ]),
            HasOne::make('id_um', [
                'label' => 'Unidades',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '43',
                ]
            ])->selectOptions(['Seleccione' => null]),
            HasOne::make('id_estado_productos', [
                'label' => 'Estado del Bien',
                'model' => TablaMaestra::class,
                'model_options' => [
                    'label' => 'denominacion',
                    'value' => 'id',
                    'method' => 'por_tipo',
                    'params' => '4',
                ]
            ])->selectOptions(['Seleccione' => null]),
            Text::make('id_marca', [
                'required' => true,
            ]),
            Select::make('estado')->selectOptions(['ACTIVO' => '1', 'CANCELADO' => '0']),
        ];
    }

    public function js() {
        return <<<EOT
            $(".btn.btn-primary").click(function(e){
                e.preventDefault();
                let form = $('#company_form')[0];
                let data = new FormData(form);

                $.ajax({
                url: "{{ route('company.store') }}",
                type: "POST",
                data : data,
                dataType:"JSON",
                processData : false,
                contentType:false,

                success: function(response) {

                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            errorMsg += error + '<br>';
                        });
                    });
                    iziToast.error({
                        message: errorMsg,
                        position: 'topRight'
                    });

                } else {
                    iziToast.success({
                    message: response.success,
                    position: 'topRight'

                            });
                }

            },
            error: function(xhr, status, error) {

                iziToast.error({
                    message: 'An error occurred: ' + error,
                    position: 'topRight'
                });
            }

                });

        })
        EOT;
    }
}
