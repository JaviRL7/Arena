<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PlayerMatchupDisplay extends Component
{
    public $playerBlue;
    public $playerRed;
    public $game;

    public function __construct($playerBlue, $playerRed, $game)
    {
        $this->playerBlue = $playerBlue;
        $this->playerRed = $playerRed;
        $this->game = $game;
    }

    public function render()
    {
        return view('components.player-matchup-display');
    }
}
