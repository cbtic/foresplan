<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\AlmaceneForm;

class Almacene extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $almacenes;

    public function __construct($almacenes = null)
    {
        $this->almacenes = $almacenes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.almacenes');
        if ($this->almacenes) {
            return app(AlmaceneForm::class)->edit($this->almacenes)->render();
        } else {
            return app(AlmaceneForm::class)->create()->render();
        }
    }
}
