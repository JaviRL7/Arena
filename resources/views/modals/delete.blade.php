<div class="modal fade" id="deleteModal{{ $player->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="deleteModalLabel{{ $player->id }}" style="color: #495057;">Delete Player</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; text-align: center;">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="mr-3" style="width: 150px; height: auto; border-radius: 50%;">
                </div>
                <p class="titular">
                    Are you sure you want to delete <strong>{{ $player->nick }}</strong>?
                </p>
            </div>
            <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef;">
                <button type="button" class="btn btn-boton7" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.players.destroy', ['player' => $player]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
