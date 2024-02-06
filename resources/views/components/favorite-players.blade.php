<div>
    @php
        use App\Models\Player;
    @endphp
    @foreach (range(1, 5) as $number)
        @php
            $playerVar = 'favorite_player' . $number;
        @endphp

        @if ($user->$playerVar)
            @php
                $player = Player::find($user->$playerVar); // Asegúrate de tener el modelo Player
            @endphp

            @if ($player)
                <div class="player-container d-flex align-items-center mb-3"> <!-- d-flex y align-items-center para alinear elementos -->
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->name }}" class="rounded-circle shadow-1-strong player-photo mr-3"> <!-- mr-3 para margen a la derecha -->

                    <div class="player-info">
                        <h3 class="titular">{{$player->nick }}</h3> <!-- Nick en h3 -->
                        <p class="comentarios">{{ $player->name }} {{ $player->lastname1 ?? '' }} {{ $player->lastname2 ?? '' }}</p> <!-- Nombre y apellidos -->
                        <p class="d-flex align-items-center comentarios">
                            <img src="{{ asset($player->role->icono) }}" alt="{{ $player->role->name }}" class="role-icon mr-2"> <!-- Icono del rol -->
                            {{ $player->role->name }} <!-- Nombre del rol -->
                        </p>
                    </div>
                </div>
                <hr>
            @endif
        @endif
    @endforeach
</div>
