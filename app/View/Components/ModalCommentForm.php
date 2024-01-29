<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalCommentForm extends Component
{
    public $game;
    public $player;
    public $serie;
    public $teamColor;
    public function __construct($game, $player, $serie, $teamColor)
{
    $this->game = $game;
    $this->player = $player;
    $this->serie = $serie;
    $this->teamColor = $teamColor;
}


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-comment-form');
    }
}
