<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\ConductoresForm;

class Conductores extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $conductores;

    public function __construct($conductores = null)
    {
        $this->conductores = $conductores;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.conductores');
        if ($this->conductores) {
            return app(ConductoresForm::class)->edit($this->conductores)->render();
        } else {
            return app(ConductoresForm::class)->create()->render();
        }
    }
}
