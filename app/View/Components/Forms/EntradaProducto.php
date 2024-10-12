<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\EntradaProductosForm;

class EntradaProducto extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $entradaproductos;

    public function __construct($entradaproductos = null)
    {
        $this->entradaproductos = $entradaproductos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.productos');
        if ($this->entradaproductos) {
            return app(EntradaProductosForm::class)->edit($this->entradaproductos)->render();
        } else {
            return app(EntradaProductosForm::class)->create()->render();
        }
    }
}
