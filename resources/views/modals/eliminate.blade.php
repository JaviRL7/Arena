<div class="modal fade delete-player-modal" id="deleteModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="deleteModalLabel{{ $player->id }}">Delete {{ $player->nick }}'s appearance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-white text-center">
                <div class="player-image-wrapper" style="">
                    <img src="{{ $player->photo }}" alt="{{ $player->nick }}" class="player-image" style="border-radius: 50%;">
                </div>

                <h2>Are you sure you want to delete {{ $player->nick }}'s appearance?</h2>
                <form
                    action="{{ route('admin.teams.deleteAppearance', ['team' => $team->id, 'player' => $player->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Delete vinculation</button>
                </form>
            </div>
        </div>
    </div>
</div>
