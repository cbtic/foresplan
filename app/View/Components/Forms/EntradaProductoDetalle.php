<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\EntradaProductoDetallesForm;
use App\View\Forms\EntradaProductoDetallesModalForm;

class EntradaProductoDetalle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $entradaproductodetalles;
    public $entradaproducto;

    public function __construct($entradaproductodetalles = null, $entradaproducto = null)
    {
        $this->entradaproductodetalles = $entradaproductodetalles;
        $this->entradaproducto = $entradaproducto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.productos');
        if ($this->entradaproductodetalles) {
            return app(EntradaProductoDetallesForm::class)->edit($this->entradaproductodetalles)->asModal($triggerContent = 'Editar #'.$this->entradaproducto, $triggerClass = 'btn btn-default', $message = null, $modalTitle = 'Editar Producto');
        } else {
            // return app(EntradaProductoDetallesForm::class)->viaAjax()->create();
            return app(EntradaProductoDetallesModalForm::class)->viaAjax()->create()->asModal($triggerContent = '+ Nuevo Ingreso de Producto', $triggerClass = 'btn btn-default', $message = null, $modalTitle = 'Ingreso de Producto (Entrada #'.$this->entradaproducto.')');
        }
    }
}
