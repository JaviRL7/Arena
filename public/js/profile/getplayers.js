$(document).ready(function() {
    var selectedPlayers = []; // Array para almacenar los IDs de los jugadores seleccionados

    var table = $('#playersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/profile/getplayers',
        pageLength: 5,
        searching: false,
        lengthChange: false,
        ordering: false,
        columnDefs: [
            { width: '100%', targets: 0 },
            { width: '100%', targets: 1 }
        ],
        columns: [
            { data: 'photo', name: 'photo' },
            { data: 'nick', name: 'nick' }
        ]
    });

    $('#playersTable tbody').on('click', 'td', function() {
        if (selectedPlayers.length >= 5) {
            alert('Ya has seleccionado 5 jugadores.');
            return;
        }

        $(this).css('background-color', 'red');

        var data = table.row(this).data();
        selectedPlayers.push(data);

        if (selectedPlayers.length == 5) {
            $.ajax({
                url: '/update-favorite-players',
                method: 'POST',
                data: {
                    favorite_player1: selectedPlayers[0],
                    favorite_player2: selectedPlayers[1],
                    favorite_player3: selectedPlayers[2],
                    favorite_player4: selectedPlayers[3],
                    favorite_player5: selectedPlayers[4]
                },
                success: function(response) {
                    alert('Jugadores favoritos actualizados con éxito.');
                }
            });
        }
    });
});
