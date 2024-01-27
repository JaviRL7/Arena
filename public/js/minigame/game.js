

let clueIndex = 1;
$('.card').on('click', function() {
    $(this).toggleClass('flipped');
    if (!$(this).hasClass('flipped')) {
        return;
    }
    $.ajax({
        url: '/minigame/get-clue',
        method: 'GET',
        success: function(response) {
            console.log(response); // Añade este console.log para ver la respuesta del servidor
            var clue = response.clue;
            if (clue.endsWith('.jpg') || clue.endsWith('.png') || clue.endsWith('.webp')) {
                // Si la pista termina con una extensión de archivo de imagen, la tratamos como una imagen
                $('#clue' + clueIndex).html('<img src="' + clue + '" alt="Pista">');
            } else {
                // Si la pista no termina con una extensión de archivo de imagen, la tratamos como texto
                $('#clue' + clueIndex).text(clue);
            }
            clueIndex++;
        },
        error: function(xhr, status, error) {
            console.error(error); // También es útil para capturar y mostrar errores
        }
    });
});

$('#get-clue').on('click', function() {
    if (clueIndex <= 5) {
        $('.card').eq(clueIndex - 1).click();
    } else {
        alert('No hay más pistas disponibles.');
    }
});

$('#form-suposicion').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: '/minigame/check-response',
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.result === 'correct') {
                // Actualiza la foto del jugador en la modal
                $('#guessedPlayerPhoto').attr('src', response.photo);

                // Muestra la modal de acierto
                $('#correctGuessModal').modal('show');
            } else {
                alert('Inténtalo de nuevo.');
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const tribute = new Tribute({
        values: function(text, cb) {
            // Asegúrate de que los objetos en 'players' tienen una propiedad 'nick'
            const filteredPlayers = players.filter(player => player.nick.toLowerCase().startsWith(text.toLowerCase()));
            // Llamar al callback con los jugadores filtrados
            cb(filteredPlayers);
        },
        lookup: 'nick',
        fillAttr: 'nick',  // Asegúrate de que los objetos en 'players' tienen esta propiedad
        menuContainer: document.body, // Esto asegura que el menú de Tribute se coloca en el cuerpo del documento
        minimumChars: 1, // Muestra sugerencias después de escribir 1 carácter
        selectTemplate: function(item) {
            if (typeof item === 'undefined') return null;
            if (this.range.isContentEditable(this.current.element)) {
                return '<a href="#" class="mention">' + item.original.value + '</a>';
            }

            // Asegúrate de que 'item.original' tiene una propiedad que coincida con 'fillAttr'
            return item.original.nick;  // Cambiar 'value' por 'nick' o la propiedad correcta
        },
        // No requerir carácter especial para activar Tribute
        trigger: '',
    });

    // Adjuntar Tribute al campo de búsqueda
    tribute.attach(document.getElementById('suposicion'));

    // Escuchar eventos de entrada para activar Tribute cada vez que el usuario escribe
    document.getElementById('suposicion').addEventListener('input', function(e) {
        const val = e.target.value;
        if (val.length > 0) {
            // Mostrar las sugerencias de Tribute si hay texto
            tribute.showMenuForCollection(e.target);
        } else {
            // Ocultar las sugerencias de Tribute si el campo está vacío
            tribute.hideMenu();
        }
    });
});
