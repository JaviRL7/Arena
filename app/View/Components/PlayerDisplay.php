<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PlayerDisplay extends Component
{
    public $player;
    public $game;

    public function __construct($player, $game)
    {
        $this->player = $player;
        $this->game = $game;
    }

    public function render()
    {
        return view('components.player-display');
    }
}
