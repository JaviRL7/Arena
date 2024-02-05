<div class="modal fade" id="deleteModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="deleteModalLabel{{ $player->id }}">Delete {{ $player->nick }}'s appearance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <h2 class="titular text-center">Are you sure you want to delete {{ $player->nick }}'s appearance?</h2>
                <form action="{{ route('admin.teams.deleteAppearance', ['team' => $team->id, 'player' => $player->id]) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-boton7">Delete vinculation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
