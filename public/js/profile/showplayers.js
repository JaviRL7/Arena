$('a[data-bs-target="#playersModal"]').on('click', function(e) {
    e.preventDefault();  // Evita que se muestre la modal inmediatamente

    $.ajax({
        url: '/profile/favorite',
        method: 'GET',
        success: function(data) {
            if (data.length > 0) {
                // Si el usuario ya tiene jugadores favoritos, muéstralos
                var favoritePlayers = data.map(function(player) {
                    return '<p>' + player.name + '</p>';
                });
                $('.profile-comments-container').html(favoritePlayers.join('') + '<a href="#">Modificar</a>');
            } else {
                // Si el usuario no tiene jugadores favoritos, muestra la modal
                $('#playersModal').modal('show');
            }
        }
    });
});
