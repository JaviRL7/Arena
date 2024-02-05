<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa;">
                <h5 class="modal-title titular" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="d-flex justify-content-center mb-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                </div>
                <div class="text-center subtitular">
                    Are you sure you want to delete this game from the series?
                </div>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <div class="mr-2">
                        <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" style="width: 80px; height: auto;">
                        <p class="comentarios">{{ $game->team_blue->name }}</p>
                    </div>
                    <div class="mx-2">
                        <p class="comentarios">{{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                    </div>
                    <div class="ml-2">
                        <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}" style="width: 80px; height: auto;">
                        <p class="comentarios">{{ $game->team_red->name }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-boton7" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.games.delete', ['game' => $game]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
