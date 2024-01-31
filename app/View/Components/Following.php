<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Closure;
use Illuminate\Contracts\View\View;

class Following extends Component
{
    public $following;

    public function __construct($following)
    {
        $this->following = $following;
    }

    public function render()
    {
        return view('components.following');
    }
}
