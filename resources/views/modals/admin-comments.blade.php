<div class="modal fade" id="adminCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="adminCommentModalLabel{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titular" id="adminCommentModalLabel{{ $comment->id }}">Admin Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="comentarios">Are you sure you want to perform the following action on this comment?</p>

                <div class="d-flex justify-content-center">
                    <img src="{{ asset($comment->user->user_photo) }}" alt="{{ $comment->user->name }}" class="rounded-circle mb-2" style="width: 60px; height: 60px;">
                </div>
                <span class="comentarios">{{ $comment->user->name }}</span>
            </div>
            <div class="modal-footer justify-content-center">
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton6 px-4">Delete</button>
                </form>
                <form method="POST" action="{{ route('admin.user.invalidate', $comment->user->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-boton8 px-4">Ban</button>
                </form>
            </div>
        </div>
    </div>
</div>
