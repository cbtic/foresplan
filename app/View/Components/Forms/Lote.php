<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\LoteForm;

class Lote extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $lotes;

    public function __construct($lotes = null)
    {
        $this->lotes = $lotes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.lotes');
        if ($this->lotes) {
            return app(LoteForm::class)->edit($this->lotes)->render();
        } else {
            return app(LoteForm::class)->create()->render();
        }
    }
}
