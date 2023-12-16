
$(document).ready(function() {
    var commentsLoaded = false; // Variable de control para verificar si los comentarios ya se han cargado

    $('#comments-link').click(function(e) {
        e.preventDefault();

        // Si los comentarios ya se han cargado, no hagas nada
        if (commentsLoaded) {
            return;
        }

        $.ajax({
            url: '/profile/comments',
            type: 'GET',
            success: function(data) {
                var commentsContainer = $('.profile-comments-container');
                commentsContainer.append('<h1>These are all your comments</h1>');

                $.each(data, function(i, comment) {
                    var commentDiv = $('<div/>', {
                        "class": "comment"
                    });
                    var commentHeader = $('<div/>', {
                        "class": "comment-header"
                    });
                    var userPhoto = $('<img/>', {
                        "src": comment.user.user_photo,
                        "class": "user-photo"
                    });
                    var userInfo = $('<div/>', {
                        "class": "user-info"
                    });
                    var userName = $('<p/>', {
                        "class": "user-name"
                    }).html('<strong>' + comment.user.name + '</strong>');
                    var userNick = $('<p/>', {
                        "class": "user-nick"
                    }).text('@' + comment.user.nick);
                    var commentDate = $('<span/>', {
                        "class": "comment-date"
                    }).text(comment.date);
                    var commentBody = $('<p/>', {
                        "class": "comment-body"
                    }).text(comment.body);
                    var commentLikesContainer = $('<div/>', {
                        "class": "comment-likes"
                    });
                    var likesImage = $('<img/>', {
                        "src": "/icons/mg_1.png",
                        "alt": "Icono de likes"
                    });
                    var likesCount = $('<p/>').text(comment.likes);
                    userInfo.append(userName, userNick);
                    commentHeader.append(userPhoto, userInfo, commentDate);
                    commentLikesContainer.append(likesImage, likesCount);
                    commentDiv.append(commentHeader, commentBody, commentLikesContainer);

                    // Agrega el comentario al nuevo contenedor
                    commentsContainer.append(commentDiv);
                });

                // Desplázate hacia el contenedor de comentarios después de agregarlos
                $('html, body').animate({
                    scrollTop: commentsContainer.offset().top - ($(window)
                        .height() - commentsContainer.outerHeight()) / 2
                }, 500);

                // Marca los comentarios como cargados
                commentsLoaded = true;
            }
        });
    });
});


