console.log('Ejecutando showplayers.js');
$('a[data-bs-target="#playersModal"]').on('click', function(e) {
    console.log('se esta ejecutando show.js');
    e.preventDefault(); // Evita que se muestre la modal inmediatamente

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
