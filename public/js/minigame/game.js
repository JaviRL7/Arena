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
            console.log(response);
            var clue = response.clue;
            if (clue.endsWith('.jpg') || clue.endsWith('.png') || clue.endsWith('.webp')) {
                $('#clue' + clueIndex).html('<img src="' + clue + '" alt="Pista">');
            } else {
                $('#clue' + clueIndex).text(clue);
            }
            clueIndex++;
        },
        error: function(xhr, status, error) {
            console.error(error);
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
                $('#guessedPlayerPhoto').attr('src', response.photo);
                $('#playerNick').text(response.nick);
                $('#correctGuessModal').modal('show');
            } else {
                var randomNumS = Math.floor(Math.random() * 10) + 1; // generates a random number between 1 and 10
                document.getElementById('randomEmoteS').src = '/emotes/s' + randomNumS + '.png';
                $('#wrongGuessModal').modal('show');
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const tribute = new Tribute({
        values: function(text, cb) {

            const filteredPlayers = players.filter(player => player.nick.toLowerCase().startsWith(text.toLowerCase()));

            cb(filteredPlayers);
        },
        lookup: 'nick',
        fillAttr: 'nick',
        menuContainer: document.body,
        minimumChars: 1,
        selectTemplate: function(item) {
            if (typeof item === 'undefined') return null;
            if (this.range.isContentEditable(this.current.element)) {
                return '<a href="#" class="mention">' + item.original.value + '</a>';
            }

            return item.original.nick;
        },
        trigger: '',
    });

    tribute.attach(document.getElementById('suposicion'));

    document.getElementById('suposicion').addEventListener('input', function(e) {
        const val = e.target.value;
        if (val.length > 0) {
            tribute.showMenuForCollection(e.target);
        } else {
            tribute.hideMenu();
        }
    });
});
