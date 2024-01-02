<div class="modal fade renew-player-modal" id="editModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="editModalLabel{{ $player->id }}">Correct start date for {{ $player->nick }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-white text-center">
                <div class="player-image-wrapper">
                    <img src="{{ $player->photo }}" alt="{{ $player->nick }}" class="player-image">
                </div>

                <h2>What will be the corrected start date for {{ $player->nick }}'s contract?</h2>
                <form
                    action="{{ route('admin.teams.correctStartDate', ['team' => $team->id, 'player' => $player->id]) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="correct_start_date">Correct contract start date:</label>
                        <input type="date" id="correct_start_date" name="correct_start_date" class="form-control form-control-sm text-dark" value="{{ date('Y-m-d') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Correct Start Date</button>
                </form>
            </div>
        </div>
    </div>
</div>
