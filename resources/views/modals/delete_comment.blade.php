<style>
    .delete-comment-modal .modal-dialog {
        height: 30vh; /* 30% de la altura de la pantalla */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .delete-comment-modal .modal-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .delete-comment-modal .modal-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="modal fade delete-comment-modal" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa fa-exclamation-triangle fa-3x"></i>
                <p>Are you sure you want to delete this comment?</p>
                <form id="deleteCommentForm" method="POST" action="" class="d-flex align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="boton2" style="margin-right: 20px">Delete</button>
                    <button type="button" class="boton1" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
