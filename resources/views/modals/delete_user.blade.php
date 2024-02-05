<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titular text-center" id="deleteModalLabel{{ $user->id }}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                    <h4 class="titular">Are you sure you want to delete this user?</h4>
                    <p class="titular">{{ $user->name }}</p>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($user->user_photo) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-boton7" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
