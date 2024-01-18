$(document).ready(function() {
    $('#for-you-link').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/profile/' + userId + '/followings',
            type: 'GET',
            success: function(followings) {
                var followingsContainer = $('.profile-comments-container');
                followingsContainer.empty();

                followings.forEach(function(following) {
                    var followingDiv = $('<div/>', { "class": "following" }).css({
                        'border-bottom': '1px solid grey',
                        'padding-bottom': '10px',
                        'margin-bottom': '10px'
                    });
                    var photo = $('<img/>', {
                        "src": following.photo,
                        "class": "user-photo",
                        "style": "float: left; border-radius: 50%; width: 50px; height: 50px; margin-right: 15px;"
                    });
                    var userDetails = $('<div/>', { "class": "user-details" }).css({
                        'float': 'left',
                        'margin-right': '20px'
                    });
                    var name = $('<p/>', { "class": "user-name" }).text(following.name).css({
                        'margin': '0',
                        'font-weight': 'bold'
                    });
                    var nick = $('<p/>', { "class": "user-nick" }).text('@' + following.nick).css({
                        'margin': '0',
                        'color': '#555'
                    });
                    var bio = $('<p/>', { "class": "user-bio" }).text('Bio will go here...').css({
                        'margin-top': '10px',
                        'color': '#888',
                        'max-width': '300px'
                    });

                    userDetails.append(name, nick, bio);

                    var favoritesDiv = $('<div/>', { "class": "favorites" }).css({
                        'float': 'right'
                    });

                    // ... Include favorite players and team as before ...

                    followingDiv.append(photo, userDetails, favoritesDiv);
                    followingsContainer.append(followingDiv);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar followings: " + error);
            }
        });
    });
});
