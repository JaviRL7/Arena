

<div class="modal fade delete-comment-modal" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa fa-exclamation-triangle fa-3x"></i>
                <p class="titular" style="margin: 10%">Are you sure you want to delete this comment?</p>
                <form id="deleteCommentForm" method="POST" action="" class="d-flex align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-boton7" style="margin-right: 20px">Delete</button>
                    <button type="button" class="btn-boton8" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
