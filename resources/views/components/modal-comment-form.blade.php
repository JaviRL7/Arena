<form id="modalCommentForm{{ $game->id }}Player{{ $player->id }}" action="{{ route('comments.storeModal', $serie) }}" method="POST" class="space-y-4">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="body" id="body" rows="4" style="background: #fffbfb; width: 100%;"
            placeholder="Write a comment..."></textarea>
        <label class="form-labe" for="body"></label>
    </div>
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <input type="hidden" name="serie_id" value="{{ $serie->id }}">
    <div class="float-end mt-2 pt-1">
        <button type="submit" class="btn-boton7">Enviar</button>
        <input type="hidden" id="serie" value="{{ $serie->id }}">
    </div>
</form>
