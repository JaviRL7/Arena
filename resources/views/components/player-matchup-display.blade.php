<tr class="player-matchup-display">
    <!-- Player Blue -->
    @if ($playerBlue)
        <td>
            <div class="player-info">
                <img src="{{ asset($playerBlue->photo) }}" alt="{{ $playerBlue->nick }}"  class="img-fluid" style="max-width: 100px !important; max-height: 100px !important;">
                <button type="button" class="btn-boton7 open-modal" data-bs-toggle="modal" data-bs-target="#voteModalGame{{ $game->id }}Player{{ $playerBlue->id }}">
                    Vote
                </button>
            </div>
        </td>
        <td class="player-name-column d-none d-md-table-cell">
            <div class="player-details">
                <div class="player-nick">{{ $playerBlue->nick }}</div>
                <div class="player-name">{{ $playerBlue->name }} {{ $playerBlue->lastname1 }}{{ $playerBlue->lastname2 ? ' ' . $playerBlue->lastname2 : '' }}</div>
            </div>
        </td>
        <td class="kda-column titular d-none d-md-table-cell">
            {{ $playerBlue->games->where('id', $game->id)->first()->pivot->kills }}
            /
            {{ $playerBlue->games->where('id', $game->id)->first()->pivot->deaths }}
            /
            {{ $playerBlue->games->where('id', $game->id)->first()->pivot->assists }}
        </td>
        <td class="d-none d-md-table-cell">
            <img src="{{ asset($playerBlue->games->where('id', $game->id)->first()->pivot->champion->square) }}" alt="{{ $playerBlue->games->where('id', $game->id)->first()->pivot->champion->name }}" class="img-fluid" style="max-width: 50px !important; max-height: 50px !important;">
        </td>
        <td>
            <div class="note-blue">
                {{ number_format($playerBlue->averageScoreForGame($game->id), 2, '.', '') ?? ' - ' }}
            </div>
        </td>
    @else
        <td colspan="5">No player</td>
    @endif

    <!-- VS -->
    <td style="font-family: mol">VS</td>

    <!-- Player Red -->
    @if ($playerRed)
        <td>
            <div class="note-red">
                {{ number_format($playerRed->averageScoreForGame($game->id), 2, '.', '') ?? ' - ' }}
            </div>
        </td>
        <td class="d-none d-md-table-cell">
            <img src="{{ asset($playerRed->games->where('id', $game->id)->first()->pivot->champion->square) }}" alt="{{ $playerRed->games->where('id', $game->id)->first()->pivot->champion->name }}" class="img-fluid" style="max-width: 50px !important; max-height: 50px !important;">
        </td>
        <td class="kda-column titular d-none d-md-table-cell">
            {{ $playerRed->games->where('id', $game->id)->first()->pivot->kills }}
            /
            {{ $playerRed->games->where('id', $game->id)->first()->pivot->deaths }}
            /
            {{ $playerRed->games->where('id', $game->id)->first()->pivot->assists }}
        </td>
        <td class="player-name-column d-none d-md-table-cell">
            <div class="player-details">
                <div class="player-nick">{{ $playerRed->nick }}</div>
                <div class="player-name">{{ $playerRed->name }} {{ $playerRed->lastname1 }}{{ $playerRed->lastname2 ? ' ' . $playerRed->lastname2 : '' }}</div>
            </div>
        </td>
        <td>
            <div class="player-info ">
                <img src="{{ asset($playerRed->photo) }}" alt="{{ $playerRed->nick }}" class="img-fluid"style="max-width: 100px !important; max-height: 100px !important;">
                <button type="button" class="btn-boton8" data-bs-toggle="modal" data-bs-target="#voteModalGame{{ $game->id }}Player{{ $playerRed->id }}">
                    Vote
                </button>
            </div>

        </td>
    @else
        <td colspan="6">No player</td>
    @endif
</tr>
<script>
window.onload = function() {
    var nickElements = document.querySelectorAll('.player-nick');

    nickElements.forEach(function(nickElement) {
        var nick = nickElement.textContent;
        if (/\d/.test(nick)) { // Comprueba si el apodo contiene un dígito
            nickElement.classList.add('titular'); // Agrega la clase 'titular' al elemento
        }
    });
};
</script>
