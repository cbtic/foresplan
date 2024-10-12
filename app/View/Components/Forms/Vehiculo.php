<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\VehiculoForm;

class Vehiculo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $vehiculos;

    public function __construct($vehiculos = null)
    {
        $this->vehiculos = $vehiculos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.tablamaestra');
        if ($this->vehiculos) {
            return app(VehiculoForm::class)->edit($this->vehiculos)->render();
        } else {
            return app(VehiculoForm::class)->create()->render();
        }
    }
}
