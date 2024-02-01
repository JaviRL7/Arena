<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Closure;
use Illuminate\Contracts\View\View;

class Following extends Component
{
    public $followings; // Cambia a followings para que coincida con el nombre de la variable

    public function __construct($followings) // Asegúrate de recibir $followings
    {
        $this->followings = $followings; // Asignar $followings a la propiedad followings
    }

    public function render(): View
    {
        return view('components.following');
    }
}
