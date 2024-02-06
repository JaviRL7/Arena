<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Followers extends Component
{
    public $followers;

    public function __construct($followers)
    {
        $this->followers = $followers;
    }

    public function render()
    {
        return view('components.followers');
    }
}
