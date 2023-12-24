<div class="modal fade" id="deleteModal{{ $game->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $game->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $game->id }}">Delete Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this game?
                <p>{{$game->team_blue->name}} vs {{$game->team_red->name}}</p>
                <p>Result: {{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                <img src="{{ asset($game->team_blue->logo) }}" alt="" class="w-20 h-auto">
                <img src="{{ asset($game->team_red->logo) }}" alt="" class="w-20 h-auto">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('admin.games.delete', ['game' => $game]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
