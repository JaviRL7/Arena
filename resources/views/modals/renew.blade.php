<!-- Modal para renovar el contrato -->
<div class="modal fade renew-player-modal" id="renewModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="renewModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="renewModalLabel{{ $player->id }}">Renew {{ $player->nick }}'s contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-white text-center">
                <div class="player-image-wrapper" style="">
                    <img src="{{ $player->photo }}" alt="{{ $player->nick }}" class="player-image" style="">
                </div>

                <h2>Until what year are you going to renew {{ $player->nick }}'s contract?</h2>
                <form
                    action="{{ route('admin.teams.renewContract', ['team' => $team->id, 'player' => $player->id]) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="new_year">New contract expiration year:</label>
                        <input type="number" id="new_year" name="new_year" min="2022" max="2099" class="form-control form-control-sm text-dark" value="{{ date('Y') }}" required>
                    </div>
                    <h5>Do you want to set an exact expiration date for the new contract?</h5>
                    <div class="form-group">
                        <label for="new_date">Exact new contract expiration date (optional):</label>
                        <input type="date" id="new_date" name="new_date" class="form-control form-control-sm text-dark">
                    </div>
                    <button type="submit" class="btn btn-primary">Renew Contract</button>
                </form>
            </div>
        </div>
    </div>
</div>
