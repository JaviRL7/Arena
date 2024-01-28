<tr class="player-display">
    <td>
        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="img-fluid" style="width: 100px !important; height: 100px !important;">
    </td>
    <td>
        <button type="button" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#voteModalGame{{ $game->id }}Player{{ $player->id }}">
            Vote
        </button>
    </td>
    <td>
        {{ $player->nick }}
    </td>
    <td>
        {{ $player->games->where('id', $game->id)->first()->pivot->kills }} /
        {{ $player->games->where('id', $game->id)->first()->pivot->deaths }} /
        {{ $player->games->where('id', $game->id)->first()->pivot->assists }}
    </td>
    <td>
        <img src="{{ asset($player->games->where('id', $game->id)->first()->pivot->champion->square) }}" alt="{{ $player->games->where('id', $game->id)->first()->pivot->champion->name }}" class="img-fluid" style="width: 50px !important; height: 50px !important;">
    </td>
    <td>
        {{ number_format($player->averageScoreForGame($game->id), 2, '.', '') ?? ' - ' }}
    </td>
</tr>
