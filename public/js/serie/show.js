
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteCommentModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var commentId = button.getAttribute('data-comment-id');
            var form = deleteModal.querySelector('form');
            form.action = '/comments/' + commentId;
        });
    });

    function editComment(commentId, commentBody) {
        document.getElementById('editCommentId').value = commentId;
        document.getElementById('editCommentBody').value = commentBody;
        var form = document.getElementById('editForm');
        form.action = '/comments/' + commentId + '/update';
    }

    var titulo1 = document.getElementById('titulo1');
    var titulo2 = document.getElementById('titulo2');

    if (/\d/.test(titulo1.textContent)) {
        titulo1.style.fontFamily = 'mol';
    }
    if (/\d/.test(titulo2.textContent)) {
        titulo2.style.fontFamily = 'mol';
    }

    var tributePlayers, tributeTeams;
    var serie = document.getElementById('serie').value;

    // Autocompletar nombres de jugadores
    $.getJSON("/series/" + serie + "/getPlayerNames", function(data) {
        var players = data.map(function(player) {
            return {
                key: player,
                value: player
            };
        });

        tributePlayers = new Tribute({
            trigger: '@',
            values: players
        });

        tributePlayers.attach(document.getElementById('body'));
    });

    // Autocompletar nombres de equipos
    $.getJSON("/series/" + serie + "/getTeamNames", function(data) {
        var teams = data.map(function(team) {
            return {
                key: team,
                value: team
            };
        });

        tributeTeams = new Tribute({
            trigger: '#',
            values: teams
        });

        tributeTeams.attach(document.getElementById('body'));
    });

    $(document).ready(function() {
        $('.open-modal').click(function() {
            var gameId = $(this).data('game-id');
            var modalId = $(this).data('bs-target');
            // Actualiza el atributo 'data-game-id' de la modal
            $(modalId).attr('data-game-id', gameId);
            // Muestra la modal
            $(modalId).modal('show');
        });

        $('.open-modal').on('shown.bs.modal', function() {
            var modalId = $(this).data('bs-target');
            var gameId = $(modalId).data('game-id');
            console.log('Game ID: ' + gameId);
        });
    });

    $(document).ready(function() {
        console.log("Documento listo");
        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });

        $('.owl-carousel').on('initialized.owl.carousel', function(event) {
            $('.btn-primary').each(function() {
                var target = $(this).data('bs-target');
                var modal = new bootstrap.Modal(document.querySelector(target));
                $(this).click(function() {
                    modal.show();
                });
            });
        });
    });

