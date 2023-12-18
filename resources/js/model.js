$('#favorites-link').click(function(e) {
    e.preventDefault();

    $.ajax({
        url: '/profile/favorites',
        type: 'GET',
        success: function(data) {
            var modal = $('<div/>', {
                "class": "modal"
            });
            var modalContent = $('<div/>', {
                "class": "modal-content"
            });
            var closeBtn = $('<span/>', {
                "class": "close-button"
            }).text('X');
            var playersContainer = $('<div/>', {
                "class": "players-container"
            });

            $.each(data, function(i, player) {
                var playerDiv = $('<div/>', {
                    "class": "player",
                    "data-id": player.id
                }).text(player.name);

                playersContainer.append(playerDiv);
            });

            modalContent.append(closeBtn, playersContainer);
            modal.append(modalContent);
            $('body').append(modal);

            $('.player').click(function() {
                $(this).toggleClass('selected');
            });

            $('.close-button').click(function() {
                var selectedPlayers = $('.player.selected');
                if (selectedPlayers.length != 5) {
                    alert('Debes seleccionar exactamente 5 jugadores.');
                    return;
                }

                var playerIds = [];
                selectedPlayers.each(function() {
                    playerIds.push($(this).data('id'));
                });

                $.ajax({
                    url: '/profile/update-favorites',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'favorite_player1': playerIds[0],
                        'favorite_player2': playerIds[1],
                        'favorite_player3': playerIds[2],
                        'favorite_player4': playerIds[3],
                        'favorite_player5': playerIds[4]
                    },
                    success: function() {
                        alert('Jugadores favoritos actualizados con éxito.');
                        modal.remove();
                    }
                });
            });
        }
    });
});
