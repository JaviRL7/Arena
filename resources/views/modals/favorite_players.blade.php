<div class="modal fade" id="playersModal" tabindex="-1" aria-labelledby="playersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playersModalLabel">Fotos de Jugadores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="playersTable" class="display">
                    <tbody>
                        @foreach ($players as $player)
                            <tr>
                                <td>
                                    <img src={{ asset($player->photo)}}>
                                    <img src={{ asset($player->currentTeam()->logo)}}>
                                </td>

                                <td><h1>{{ $player->nick }}</h1></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="addButton" type="button">Añadir</button>
            </div>
        </div>
    </div>
</div>
