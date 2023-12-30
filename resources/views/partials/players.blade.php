<!-- resources/views/partials/players.blade.php -->
<!--esto ya no sirve-->
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
<div id="pagination-container">
    {{ $players->links() }}
</div>
