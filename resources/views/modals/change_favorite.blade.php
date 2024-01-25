<!-- Modal para elegir jugadores favoritos -->
<div class="modal fade" id="choose-favorites-modal" tabindex="-1" aria-labelledby="chooseFavoritesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chooseFavoritesModalLabel">Elige tus 5 jugadores favoritos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="favorites-container">
                    <!-- Los jugadores favoritos se añadirán aquí -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save-favorites-button">Guardar cambios</button>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    var selectedPlayers = [];
    var playerId; // Define playerId aquí

    // Vincula el evento 'change' a los checkboxes, incluso después de que se hayan creado
    $(document).on('change', '.choose-favorite-checkbox', function() {
        playerId = $(this).data('player-id'); // Actualiza playerId aquí

        if ($(this).is(':checked')) {
            // Si el checkbox está marcado, añade el jugador a la lista de seleccionados
            selectedPlayers.push(playerId);

            // Si se han seleccionado más de 5 jugadores, desmarca el primer jugador seleccionado
            if (selectedPlayers.length > 5) {
                var firstSelectedPlayerId = selectedPlayers.shift();
                $('.choose-favorite-checkbox[data-player-id="' + firstSelectedPlayerId + '"]').prop('checked', false);
            }
        } else {
            // Si el checkbox no está marcado, elimina el jugador de la lista de seleccionados
            var index = selectedPlayers.indexOf(playerId);
            if (index > -1) {
                selectedPlayers.splice(index, 1);
            }
        }
    });

    $('#save-favorites-button').click(function() {
        $.ajax({
            url: '/players/' + playerId + '/updateFavorites',
            method: 'POST',
            data: {
                favorite_player1: selectedPlayers[0],
                favorite_player2: selectedPlayers[1],
                favorite_player3: selectedPlayers[2],
                favorite_player4: selectedPlayers[3],
                favorite_player5: selectedPlayers[4],
                _token: '{{ csrf_token() }}' // Añade el token CSRF para proteger contra ataques CSRF
            },
            success: function(response) {
                if (response.success) {
                    // Cierra la modal y actualiza la página o muestra un mensaje de éxito
                    $('#choose-favorites-modal').modal('hide');
                    location.reload();
                } else {
                    // Muestra un mensaje de error
                    alert('Hubo un error al actualizar tus jugadores favoritos. Por favor, inténtalo de nuevo.');
                }
            }
        });
    });
});
    </script>
</div>
