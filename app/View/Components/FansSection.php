<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FansSection extends Component
{
    public $fans;

    public function __construct($fans)
    {
        $this->fans = $fans;
    }

    public function render()
    {
        return view('components.fans-section');
    }
}
