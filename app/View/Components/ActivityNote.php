<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityNote extends Component
{
    public $note;
    public $playerNick;

    public function __construct($note, $playerNick)
    {
        $this->note = $note;
        $this->playerNick = $playerNick;
    }

    public function render()
    {
        return view('components.activity-note');
    }
}
