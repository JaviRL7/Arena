<div class="modal fade" id="deleteModal{{ $team->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $team->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $team->id }}">Delete Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset($team->logo) }}" alt="Team Logo" class="team-logo img-fluid" style="max-height: 100px;">
                </div>                <h4 class="mt-3">{{ $team->name }}</h4>
                <p class="text-danger comentarios">Are you sure you want to delete this team?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-boton7" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.teams.delete', ['team' => $team->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
