<div class="modal fade edit-comment-modal" id="editCommentModal" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="comment_id" id="editCommentId">

                <div class="modal-body d-flex align-items-start"  style="height: 400px">
                    <img class="rounded-circle shadow-1-strong me-3 user-photo" src="{{ asset($comment->user->user_photo) }}" alt="avatar"/>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-2" id="editUserNick">@{{$comment->user->nick}}</h6>
                        <textarea class="form-control" name="comment_body" id="editCommentBody" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="boton1">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .edit-comment-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100vh - 3.5rem);
    }

    .edit-comment-modal .modal-body {
        display: flex;
    }
</style>
