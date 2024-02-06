<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BanPhaseDisplay extends Component
{
    public $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    public function render()
    {
        return view('components.ban-phase-display');
    }
}
