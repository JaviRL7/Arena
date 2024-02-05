<div class="modal fade" id="editModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="editModalLabel{{ $player->id }}">Correct start date for {{ $player->nick }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <h2 class="titular text-center">What will be the corrected start date for {{ $player->nick }}'s contract?</h2>
                <form action="{{ route('admin.teams.correctStartDate', ['team' => $team->id, 'player' => $player->id]) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="correct_start_date" class="form-label comentarios">Correct contract start date:</label>
                        <input type="date" id="correct_start_date" name="correct_start_date" class="form-control form-control-sm text-dark" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-boton7">Correct Start Date</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
