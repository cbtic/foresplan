<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\SalidaProductoDetallesForm;

class SalidaProductoDetalle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $salidaproductodetalles;
    public $salidaproducto;

    public function __construct($salidaproductodetalles = null, $salidaproducto = null)
    {
        $this->salidaproductodetalles = $salidaproductodetalles;
        $this->salidaproducto = $salidaproducto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.productos');
        if ($this->salidaproductodetalles) {
            return app(SalidaProductoDetallesForm::class)->edit($this->salidaproductodetalles)->asModal($triggerContent = 'Editar #'.$this->salidaproducto, $triggerClass = 'btn btn-default', $message = null, $modalTitle = 'Editar Producto');
        } else {
            // return app(SalidaProductoDetallesForm::class)->viaAjax()->create();
            return app(SalidaProductoDetallesForm::class)->viaAjax()->create()->asModal($triggerContent = '+ Producto en salida', $triggerClass = 'btn btn-default', $message = null, $modalTitle = 'Nuevo Producto (Salida #'.$this->salidaproducto.')');
        }
    }
}
