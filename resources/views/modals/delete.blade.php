<div class="modal fade modal-delete" id="deleteModal{{ $player->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="deleteModalLabel{{ $player->id }}">Delete player</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-white">
                <div class="modal-image-container modal-player-photo">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="w-36 h-36 object-cover rounded-full">
                </div>
                <div class=" text-white modal-body-estilo">
                    <h1>¿Are you sure to delete {{ $player->nick }}?</h1>
                </div>
            </div>
            <div class="modal-footer modal-footer-estilo">
                <button type="button" class="btn btn-outline-danger btn-blanco" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.players.destroy', ['player' => $player]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-blanco">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
