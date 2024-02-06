$(document).ready(function () {
    // Inicializa el carrousel de winrate
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
    });

    // Maneja el clic en el botón con el ID "fan-button"
    $("#fan-button").click(function (e) {
        e.preventDefault();

        var playerId = $(this).data("player-id");
        var actionUrl = "/players/" + playerId + "/addFan";
        var token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: actionUrl,
            method: "POST",
            data: {
                _token: token,
            },
            success: function (response) {
                if (response.maxFavoritesReached) {
                    // Obtiene los detalles del jugador actual
                    $.ajax({
                        url: '/players/' + playerId,
                        method: 'GET',
                        success: function(currentPlayer) {
                            // Obtiene los jugadores favoritos del usuario
                            $.ajax({
                                url: '/players/' + playerId +
                                '/getFavorites',
                                method: "GET",
                                success: function(favoritesResponse) {
                                    // Añade el jugador actual a la respuesta
                                    favoritesResponse.push(currentPlayer);

                                    // Añade los jugadores favoritos a la modal
                                    var favoritesContainer = $("#favorites-container");
                                    favoritesContainer.empty(); // Limpia el contenedor

                                    favoritesResponse.forEach(function(player) {
                                        var playerElement =
                                            '<div class="favorite-player mb-3">' + // Agregar clase mb-3 para margen
                                            '<img src="' + player.photo + '" alt="" class="player-profile-img" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 10px;">' +
                                            '<div class="player-text d-flex flex-column">' + // Hacer que player-text sea un contenedor flex en columna
                                            '<h2 class="titular">' + player.nick + '</h2>' +
                                            '<p class="subtitular" style="color: gray;">' +
                                            player.name + ' ' + (player.lastname1 || '') + ' ' + (player.lastname2 || '') +
                                            '</p>' +
                                            '</div>' +
                                            '<input type="checkbox" class="choose-favorite-checkbox" data-player-id="' + player.id + '" style="margin-left: auto; border-radius: 50%;">' +
                                            '</div>';

                                        favoritesContainer.append(playerElement);
                                    });

                                    // Abre la modal
                                    $("#choose-favorites-modal").modal("show");
                                }
                            });
                        }
                    });
                } else if (response.success) {
                    // Si se ha añadido correctamente al jugador de los favoritos, recarga la página
                    location.reload();
                } else {
                    // Muestra un mensaje de error
                    alert("Ocurrió un error. Por favor, inténtalo de nuevo.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Maneja los errores de la solicitud AJAX
                console.error(textStatus, errorThrown);
                alert(
                    "Ocurrió un error al realizar la solicitud. Por favor, inténtalo de nuevo."
                );
            },
        });
    });

    // Vincula el evento 'change' a los checkboxes, incluso después de que se hayan creado
    $(document).on("change", ".choose-favorite-checkbox", function () {
        var playerId = $(this).data("player-id");
        var selectedPlayers = [];

        if ($(this).is(":checked")) {
            // Si el checkbox está marcado, añade el jugador a la lista de seleccionados
            selectedPlayers.push(playerId);

            // Si se han seleccionado más de 5 jugadores, desmarca el primer jugador seleccionado
            if (selectedPlayers.length > 5) {
                var firstSelectedPlayerId = selectedPlayers.shift();
                $(
                    '.choose-favorite-checkbox[data-player-id="' +
                    firstSelectedPlayerId +
                    '"]'
                ).prop("checked", false);
            }
        } else {
            // Si el checkbox no está marcado, elimina el jugador de la lista de seleccionados
            var index = selectedPlayers.indexOf(playerId);
            if (index > -1) {
                selectedPlayers.splice(index, 1);
            }
        }

        $("#save-favorites-button").click(function () {
            $.ajax({
                url: "/players/" + playerId + "/updateFavorites",
                method: "POST",
                data: {
                    favorite_player1: selectedPlayers[0],
                    favorite_player2: selectedPlayers[1],
                    favorite_player3: selectedPlayers[2],
                    favorite_player4: selectedPlayers[3],
                    favorite_player5: selectedPlayers[4],
                    _token: token,
                },
                success: function (response) {
                    if (response.success) {
                        // Cierra la modal y actualiza la página o muestra un mensaje de éxito
                        $("#choose-favorites-modal").modal("hide");
                        location.reload();
                    } else {
                        // Muestra un mensaje de error
                        alert(
                            "Hubo un error al actualizar tus jugadores favoritos. Por favor, inténtalo de nuevo."
                        );
                    }
                },
            });
        });
    });
});
