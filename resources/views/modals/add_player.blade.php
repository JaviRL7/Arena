<div class="modal fade" id="addPlayerModal{{ $team->id }}" tabindex="-1" role="dialog"
    aria-labelledby="addPlayerModalLabel{{ $team->id }}" aria-hidden="true"
    x-data="{ player_id: '', player_nick: '', start_date: '', end_date: '', player_photo: '', exact_end_date: '' }">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="addPlayerModalLabel{{ $team->id }}">Add player to {{ $team->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; max-height: 70vh;">
                <div id="selectedPlayerData" class="d-flex align-items-center mb-4" x-bind:class="{ '': player_id }">
                    <img :src="player_photo" class="rounded-circle mr-3" style="width: 100px; height: 100px; object-fit: cover;" x-show="player_photo">
                    <div>
                        <h3 class="titular" x-text="player_nick" x-show="player_nick"></h3>
                        <p class="comentarios" x-text="exact_end_date ? exact_end_date : end_date" x-show="exact_end_date || end_date"></p>
                        <p class="comentarios" x-text="start_date" x-show="start_date"></p>
                    </div>
                </div>
                <form action="{{ route('admin.teams.add_player', ['team' => $team->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="player_id" class="form-label titular">Player:</label>
                        <select id="player_id" name="player_id" class="form-control rounded-lg" required x-model="player_id" x-on:change="player_nick = $event.target.options[$event.target.selectedIndex].text; player_photo = $event.target.options[$event.target.selectedIndex].dataset.photo; start_date = '{{ date('Y-m-d') }}';">
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}" data-photo="{{ $player->photo }}">{{ $player->nick }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label titular">Contract start date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control rounded-lg" value="{{ date('Y-m-d') }}" required x-on:change="start_date = $event.target.value">
                    </div>
                    <div class="mb-3">
                        <label for="contract_expiration_date" class="form-label titular">Contract end year:</label>
                        <input type="number" id="contract_expiration_date" name="contract_expiration_date" class="form-control rounded-lg" value="{{ date('Y') }}" required x-on:change="end_date = $event.target.value">
                    </div>
                    <div class="mb-3">
                        <label for="contract_expiration_date" class="form-label titular">Exact contract end date (optional):</label>
                        <input type="date" id="contract_expiration_date" name="contract_expiration_date" class="form-control rounded-lg" x-on:change="exact_end_date = $event.target.value">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-boton7">Add Player</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
