<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\SalidaProductosForm;

class SalidaProducto extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $salidaproducto;

    public function __construct($salidaproducto = null)
    {
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
        if ($this->salidaproducto) {
            return app(SalidaProductosForm::class)->edit($this->salidaproducto)->render();
        } else {
            return app(SalidaProductosForm::class)->create()->render();
        }
    }
}
