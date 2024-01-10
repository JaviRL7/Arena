<div class="modal fade" id="voteModal{{ $players_blue[$i]->id }}" tabindex="-1" aria-labelledby="voteModalLabel{{ $players_blue[$i]->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="voteModalLabel{{ $players_blue[$i]->id }}">Votar a {{ $players_blue[$i]->nick }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="{{ asset($players_blue[$i]->photo) }}" alt="{{ $players_blue[$i]->photo }}" class="img-fluid">
          <p>{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->kills }} / {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->deaths }} / {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->assists }}</p>
          <div class="rating">
            @for ($j = 1; $j <= 10; $j++)
              <span class="fa fa-star" data-rating="{{ $j }}"></span>
            @endfor
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
<script>
    $(document).ready(function() {
  $('.fa-star').on('click', function() {
    var rating = $(this).data('rating');
    // Aquí puedes hacer una petición AJAX para guardar el voto
    console.log('Has votado ' + rating + ' estrellas');
  });
});
</script>
