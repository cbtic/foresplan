<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\TablaMaestraForm;

class TablaMaestra extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tablamaestras;

    public function __construct($tablamaestras = null)
    {
        $this->tablamaestras = $tablamaestras;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.tablamaestra');
        if ($this->tablamaestras) {
            return app(TablaMaestraForm::class)->edit($this->tablamaestras)->render();
        } else {
            return app(TablaMaestraForm::class)->create()->render();
        }
    }
}
