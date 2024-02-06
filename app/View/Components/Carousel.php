<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $series;
    public $name;

    public function __construct($series, $name)
    {
        $this->series = $series;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.carousel');
    }
}
