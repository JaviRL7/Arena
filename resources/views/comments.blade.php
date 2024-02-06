<style>
    /* Estilo para los enlaces con iconos */
    .link-muted {
        color: gray !important;
        /* Gris por defecto */
        text-decoration: none;
        /* Elimina el subrayado de los enlaces */
    }

    .link-muted:hover {
        color: blue !important;
        /* Azul al pasar el ratón por encima */
    }
</style>
<div class="d-flex flex-start mb-4" style="margin-top: 30px;">
    <a href="{{ route('profile.index', $comment->user->id) }}" class="me-3">
        <img class="rounded-circle shadow-1-strong user-photo" src="{{ asset($comment->user->user_photo) }}"
            alt="avatar" />
    </a>

    <div>
        <!-- Nombre del usuario -->
        <p class="mb-0 fw-bold titular">{{ $comment->user->name }}</p>

        <!-- Nick del usuario (sin enlace) -->
        <p class="mb-0 fw-bold subtitular">&#64;{{ $comment->user->nick }}</p>

        <div class="d-flex align-items-start">
            <div class="text-muted">
                <p class="mb-0 subtitular" style="font-size: small; margin-top:5px">
                    <span>{{ $comment->created_at->format('F d, Y') }}</span>
                </p>
            </div>

            <div class="ms-2">
                <!-- Iconos de editar y borrar (solo si el comentario es del usuario autenticado) -->
                @if (Auth::id() == $comment->user_id)
                    <a href="#!" class="link-muted" data-bs-toggle="modal" data-bs-target="#editCommentModal"
                        onclick="editComment({{ $comment->id }}, '{{ $comment->body }}')"><i
                            class="fas fa-edit ms-2"></i></a>
                    <a href="#!" class="link-muted" data-bs-toggle="modal" data-bs-target="#deleteCommentModal"
                        data-comment-id="{{ $comment->id }}"><i class="fas fa-trash ms-2"></i></a>
                @endif
                @if (Auth::user()->admin && Auth::id() != $comment->user_id)
                    <a href="#" class="ms-2 text-muted" data-bs-toggle="modal"
                        data-bs-target="#adminCommentModal{{ $comment->id }}">
                        <i class="fas fa-gavel"></i>
                    </a>
                @endif

                <!-- Botón de 'like' -->
                <button data-url="{{ route('comments.like', $comment->id) }}" class="link-muted like-button"><i
                        class="fas fa-heart ms-2"></i></button>
            </div>
        </div>

        <br>
        <p class="mb-0 comentarios">{{ $comment->body }}</p>
        <br>
        <br>
        <p class="mb-0">
            <span class="likes-count">{{ $comment->getLikesCountAttribute() }}</span> <!-- Añade esta clase -->
            <i class="fas fa-heart text-danger"></i>
        </p>
    </div>
</div>
<hr class="custom-hr" />
