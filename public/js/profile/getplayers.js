$(document).ready(function() {
    var selectedPlayers = JSON.parse(localStorage.getItem('selectedPlayers')) || []; // Array para almacenar los IDs de los jugadores seleccionados

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
        ],
        rowCallback: function(row, data) {
            if (selectedPlayers.includes(data.id)) {
                $(row).css('background-color', 'red');
            }
        }
    });

    $('#playersTable tbody').on('click', 'td', function() {
        var data = table.row(this).data();
        var index = selectedPlayers.indexOf(data.id);

        if (index !== -1) {
            selectedPlayers.splice(index, 1);
            $(this).css('background-color', '');
        } else {
            if (selectedPlayers.length >= 5) {
                alert('Ya has seleccionado 5 jugadores.');
                return;
            }

            selectedPlayers.push(data.id);
            $(this).css('background-color', 'red');
        }

        localStorage.setItem('selectedPlayers', JSON.stringify(selectedPlayers));
    });

    $('#addButton').click(function() {
        if (selectedPlayers.length == 5) {
            $.ajax({
                url: '/profile', // URL de la ruta que maneja el método update
                method: 'PATCH', // Método HTTP para actualizar recursos
                data: {
                    favorite_player1: selectedPlayers[0],
                    favorite_player2: selectedPlayers[1],
                    favorite_player3: selectedPlayers[2],
                    favorite_player4: selectedPlayers[3],
                    favorite_player5: selectedPlayers[4],
                    _token: '{{ csrf_token() }}' // Token CSRF para proteger contra ataques de falsificación de solicitudes entre sitios
                },
                success: function(response) {
                    alert('Jugadores favoritos actualizados con éxito.');
                    $('#playersModal').modal('hide'); // Cierra la modal
                }
            });
        } else {
            alert('Por favor, selecciona 5 jugadores antes de añadir.');
        }
    });
});
