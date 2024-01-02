<div class="modal fade renew-player-modal" id="setEndDateModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="setEndDateModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="setEndDateModalLabel{{ $player->id }}">Set new end date for {{ $player->nick }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-white text-center">
                <div class="player-image-wrapper" style="">
                    <img src="{{ $player->photo }}" alt="{{ $player->nick }}" class="player-image" style="">
                </div>

                <h2>What will be the new end date for {{ $player->nick }}'s contract?</h2>
                <form
                    action="{{ route('admin.teams.setEndDate', ['team' => $team->id, 'player' => $player->id]) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="new_end_date">New contract end date:</label>
                        <input type="date" id="new_end_date" name="new_end_date" class="form-control form-control-sm text-dark" value="{{ date('Y-m-d') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Set End Date</button>
                </form>
            </div>
        </div>
    </div>
</div>
