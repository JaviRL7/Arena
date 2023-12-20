$('#favorites-link').on('click', function(e) {
    e.preventDefault(); // Evita que el enlace se siga
    $.ajax({
        url: '/profile/favorite',
        method: 'GET',
        success: function(data) {
            // Convertir el objeto en un array
            var dataArray = Object.values(data);

            if (Array.isArray(dataArray)) {
                if (dataArray.length === 5) {
                    var favoritePlayers = dataArray.map(function(player) {
                        return '<div class="player getFavorites-div"><h1 class="getFavorites-name">' + player.nick + '</h1><img class="getFavorites-photo" src="' + player.photo + '" alt="' + player.nick + '"></div>';
                    });
                    $('.profile-comments-container').html('<br><div class="getFavorites-text-button"><h3 class="getFavorites-text">Do you want to modify your favorite players?</h3> <button data-bs-toggle="modal" data-bs-target="#playersModal" id="modifyButton" type="button" class="btn btn-secondary getFavorites-button">Modificate</button></div><br>' + favoritePlayers.join(''));
                } else {
                    $('.profile-comments-container').html('<a class="getFavorites-link" href="#">You have not chosen your favorite players yet, choose them here</a>');
                }
            } else {
                console.error('Unexpected server response:', data);
            }
        }
    });
});
