<div class="modal fade" id="playersModal" tabindex="-1" aria-labelledby="playersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playersModalLabel">Fotos de Jugadores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($players as $player)
                        <div class="col-md-4">
                            <img src="{{ asset($player->photo) }}" class="rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px;" alt="Foto del jugador">
                            <div class="card-body">
                                <h2 class="card-title">{{ $player->nick }}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                {{ $players->links() }}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        fetch_data(url);
    });

    function fetch_data(url) {
        $.ajax({
            url: url,
            success: function(data) {
                $('#playersModal .modal-body').html($(data).find("#playersModal .modal-body").html());
            }
        });
    }
});
</script>
