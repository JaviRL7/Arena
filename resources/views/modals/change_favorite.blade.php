<!-- Modal para elegir jugadores favoritos -->
<div class="modal fade" id="choose-favorites-modal" tabindex="-1" aria-labelledby="chooseFavoritesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chooseFavoritesModalLabel">Choose Your Top 5 Favorite Players</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach (Auth::user()->favoritePlayers as $player)
                    <div class="favorite-player">
                        <img src="{{ asset($player->photo) }}" alt="" class="player-profile-img">
                        <h2>{{ $player->nickname }}</h2>
                        <p style="color: gray;">{{ $player->name }} {{ $player->lastname1 }} {{ $player->lastname2 }}</p>
                        <button class="btn btn-primary choose-favorite-button" data-player-id="{{ $player->id }}">Choose as Favorite</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-favorites-button">Save Changes</button>
            </div>
        </div>
    </div>
</div>
