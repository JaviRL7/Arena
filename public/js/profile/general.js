
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar controles y contenedores para la interacción de la UI
    const commentsButton = document.getElementById('comments-link');
    const commentsContainer = document.querySelector('.comments-container');
    const favoritesButton = document.getElementById('favorites-link');
    const favoritesContainer = document.querySelector('.favorites-container');
    const forYouButton = document.getElementById('for-you-link');
    const forYouContainer = document.querySelector('.for-you-activities-container');
    const followersLink = document.getElementById('followers-link');
    const followersContainer = document.querySelector('.followers-container');
    const followingLink = document.getElementById('following-link');
    const followingContainer = document.querySelector('.following-container');
    const reviewsButton = document.getElementById('reviews-link');
    const reviewsContainer = document.querySelector('.reviews-container');
    const deleteModal = document.getElementById('deleteCommentModal');
    const editModal = document.getElementById('editCommentModal');
    const reviewsLink = document.getElementById('reviews-link');

    followersLink.addEventListener('click', function() {
        hideAllContainers();
        followersContainer.style.display = 'block';
        });

        followingLink.addEventListener('click', function() {
        hideAllContainers();
        followingContainer.style.display = 'block';
        });
        reviewsLink.addEventListener('click', function() {
            hideAllContainers();
            reviewsContainer.style.display = 'block';
            });

    // Función para ocultar todos los contenedores
    function hideAllContainers() {
        commentsContainer.style.display = 'none';
        favoritesContainer.style.display = 'none';
        forYouContainer.style.display = 'none';
        followersContainer.style.display = 'none';
        followingContainer.style.display = 'none';
        reviewsContainer.style.display = 'none';
    }


    // Manejar clics en los botones para mostrar/ocultar contenedores
    commentsButton.addEventListener('click', function() {
        hideAllContainers();
        commentsContainer.style.display = 'block';
    });

    favoritesButton.addEventListener('click', function() {
        hideAllContainers();
        favoritesContainer.style.display = 'block';
    });

    forYouButton.addEventListener('click', function() {
        hideAllContainers();
        forYouContainer.style.display = 'block';
    });

    followersLink.addEventListener('click', function() {
        hideAllContainers();
        followersContainer.style.display = 'block';
    });

    followingLink.addEventListener('click', function() {
        hideAllContainers();
        followingContainer.style.display = 'block';
    });

    reviewsButton.addEventListener('click', function() {
        hideAllContainers();
        reviewsContainer.style.display = 'block';
    });
    // Modal de eliminación de comentarios
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const commentId = button.getAttribute('data-comment-id');
            const form = deleteModal.querySelector('form');
            form.action = `/comments/${commentId}`;
        });
    }

    // Modal de edición de comentarios
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const commentId = button.getAttribute('data-comment-id');
            const commentBody = button.getAttribute('data-comment-body');
            const commentIdField = editModal.querySelector('#editCommentId');
            const commentBodyField = editModal.querySelector('#editCommentBody');
            const form = editModal.querySelector('form');
            commentIdField.value = commentId;
            commentBodyField.value = commentBody;
            form.action = `/comments/${commentId}/update`;
        });
    }
});

// Función para editar comentarios
function editComment(commentId, commentBody) {
    const editModal = document.getElementById('editCommentModal');
    const commentIdField = editModal.querySelector('#editCommentId');
    const commentBodyField = editModal.querySelector('#editCommentBody');
    const form = editModal.querySelector('form');
    commentIdField.value = commentId;
    commentBodyField.value = commentBody;
    form.action = `/comments/${commentId}/update`;
}

// Manejar clics en los enlaces de 'like'
$(document).ready(function() {
    $('.link-muted').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var likeLink = $(this);
        $.ajax({
            url: href,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    likeLink.closest('.comment-container').find('.likes-count').text(response.likesCount);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
