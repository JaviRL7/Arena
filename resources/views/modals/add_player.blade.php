<div class="modal fade" id="addPlayerModal{{ $team->id }}" tabindex="-1" role="dialog"
    aria-labelledby="addPlayerModalLabel{{ $team->id }}" aria-hidden="true"
    x-data="{ player_id: '', player_nick: '', start_date: '', end_date: '', player_photo: '', exact_end_date: '' }">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="max-height: 50vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlayerModalLabel{{ $team->id }}">Add player to {{ $team->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh;">
                <div id="selectedPlayerData" x-bind:style="player_id ? 'border: 2px solid #e44445; border-radius: 5px; padding: 10px; display: flex; align-items: center;' : ''">
                    <img :src="player_photo" height="100px" style="border-radius: 50%; object-fit: cover; margin-right: 10px; height:300px; " x-show="player_photo">
                    <div>
                        <h1 x-text="player_nick" x-show="player_nick"></h1>
                        <h3 x-text="exact_end_date ? exact_end_date : end_date" x-show="exact_end_date || end_date"></h3>
                        <h3 x-text="start_date" x-show="start_date"></h3>
                    </div>
                </div>
                <form action="{{ route('admin.teams.add_player', ['team' => $team->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="player_id">Player:</label>
                        <select id="player_id" name="player_id" class="form-control" required x-model="player_id" x-on:change="player_nick = $event.target.options[$event.target.selectedIndex].text; player_photo = $event.target.options[$event.target.selectedIndex].dataset.photo; start_date = '{{ date('Y-m-d') }}';">
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}" data-photo="{{ $player->photo }}">{{ $player->nick }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="start_date">Contract start date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required x-on:change="start_date = $event.target.value">
                        </div>
                    <div class="form-group">
                        <label for="contract_expiration_date">Contract end year:</label>
                        <input type="number" id="contract_expiration_date" name="contract_expiration_date" class="form-control" value="{{ date('Y') }}" required x-on:change="end_date = $event.target.value">
                    </div>
                    <div class="form-group">
                        <label for="contract_expiration_date">Exact contract end date (optional):</label>
                        <input type="date" id="contract_expiration_date" name="contract_expiration_date" class="form-control" x-on:change="exact_end_date = $event.target.value">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Player</button>
                </form>
            </div>
        </div>
    </div>
</div>
