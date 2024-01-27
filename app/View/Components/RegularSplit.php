<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegularSplit extends Component
{
    public $series;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($series)
    {
        $this->series = $series;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.regular-split');
    }
}
