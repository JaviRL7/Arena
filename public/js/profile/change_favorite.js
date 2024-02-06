$('#become-fan-button').click(function() {
    var playerId = $(this).data('player-id');

    $.ajax({
        url: '/players/' + playerId + '/profile/add-fan',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
        },
        success: function(response) {
            // Si el usuario se ha convertido en fan, cambia el texto del botón
            $('#become-fan-button').text('You are already a fan');
        },
        error: function(response) {
            // Muestra la modal si el usuario ya tiene todos los jugadores favoritos
            if (response.status === 400) {
                $('#choose-favorites-modal').modal('show');
            }
        }
    });
});
$('.choose-favorite-button').click(function() {
    var playerId = $(this).data('player-id');

    $.ajax({
        url: '/players/' + playerId + '/profile/update-favorites',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            favorite_player1: $('#favorite-player1-id').val(),
            favorite_player2: $('#favorite-player2-id').val(),
            favorite_player3: $('#favorite-player3-id').val(),
            favorite_player4: $('#favorite-player4-id').val(),
            favorite_player5: $('#favorite-player5-id').val(),
        },
        success: function(response) {
            alert(response.message);
            $('#choose-favorites-modal').modal('hide');
        },
        error: function(response) {
            alert('Error: ' + response.message);
        }
    });
});
