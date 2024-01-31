<?php
namespace App\View\Components;

use Closure;
use App\Models\User; // Asegúrate de importar tu modelo User
use App\Models\Player; // Importa el modelo Player
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoritePlayers extends Component
{
    public $user; // Definir la propiedad user

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user) // Asegúrate de recibir $user
    {
        $this->user = $user; // Asignar $user a la propiedad user
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.favorite-players');
    }
}
