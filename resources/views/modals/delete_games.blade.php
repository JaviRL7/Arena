<div class="modal fade modal-delete" id="deleteModal{{ $game->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $game->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="deleteModalLabel{{ $game->id }}">Delete Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-white">
                <div class="modal-image-container">
                    <div class="logo-container">
                        <img src="{{ asset($game->team_blue->logo) }}" alt="" class="logo">
                    </div>
                    <div class="vs">VS</div>
                    <div class="logo-container">
                        <img src="{{ asset($game->team_red->logo) }}" alt="" class="logo">
                    </div>
                </div>
                <br>
                <br>
                <div class=" text-white modal-body-estilo">
                    <h1>¿Are you sure you want to delete this game?</h1>
                    <p>{{$game->team_blue->name}} vs {{$game->team_red->name}}</p>
                    <p>Result: {{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                </div>
            </div>
            <br>
            <br>
            <div class="modal-footer modal-footer-estilo">
                <button type="button" class="btn btn-outline-danger btn-blanco" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.games.delete', ['game' => $game]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-blanco">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
