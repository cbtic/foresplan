<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\SeccioneForm;

class Seccione extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $secciones;

    public function __construct($secciones = null)
    {
        $this->secciones = $secciones;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.secciones');
        if ($this->secciones) {
            return app(SeccioneForm::class)->edit($this->secciones)->render();
        } else {
            return app(SeccioneForm::class)->create()->render();
        }
    }
}
