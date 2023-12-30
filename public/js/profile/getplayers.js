$(document).ready(function() {
    var selectedPlayers = JSON.parse(localStorage.getItem('selectedPlayers')) || [];

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
        drawCallback: function() {
            var data = this.api().rows().data();
            data.each(function(rowData, index) {
                var row = this.api().row(index).node();
                if (selectedPlayers.includes(rowData.id)) {
                    $(row).css('background-color', '#e44445');
                } else {
                    $(row).css('background-color', '');
                }
            }.bind(this));
        },
        rowCallback: function(row, data) {
            if (selectedPlayers.includes(data.id)) {
                $(row).css('background-color', '#e44445');
            }
        }
    });

    $('#playersTable tbody').on('click', 'tr', function() {
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
            $(this).css('background-color', '#e44445');
        }

        localStorage.setItem('selectedPlayers', JSON.stringify(selectedPlayers));
    });

    $('#addButton').on('click', function() {
        console.log(csrfToken);  // Imprime el valor del token CSRF

        $.ajax({
            url: '/profile/favorite',
            method: 'POST',
            data: {
                favorite_player1: selectedPlayers[0],
                favorite_player2: selectedPlayers[1],
                favorite_player3: selectedPlayers[2],
                favorite_player4: selectedPlayers[3],
                favorite_player5: selectedPlayers[4],
                _token: csrfToken  // Usa la variable csrfToken
            },
            success: function() {
                alert('Jugadores favoritos actualizados con éxito!');
                $('#playersModal').modal('hide');
            }
        });
    });
});
