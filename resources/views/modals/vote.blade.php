<div class="modal fade" id="voteModalGame{{ $game->id }}Player{{ $player_blue->id }}" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voteModalLabel">Player Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset($player_blue->photo) }}" alt="{{ $player_blue->photo }}" class="img-fluid" style="width: 100px !important; height: 100px !important;">
                <p>Game ID: {{ $game->id }}</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


