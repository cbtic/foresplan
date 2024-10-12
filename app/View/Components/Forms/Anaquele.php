<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use App\View\Forms\AnaqueleForm;

class Anaquele extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $anaqueles;

    public function __construct($anaqueles = null)
    {
        $this->anaqueles = $anaqueles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.forms.anaqueles');
        if ($this->anaqueles) {
            return app(AnaqueleForm::class)->edit($this->anaqueles)->render();
        } else {
            return app(AnaqueleForm::class)->create()->render();
        }
    }
}
