<div class="modal fade modal-delete" id="deleteModal{{ $team->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $team->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="deleteModalLabel{{ $team->id }}">Delete Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-white">
                <div class="modal-image-container">
                    <div class="logo-container">
                        <img src="{{ asset($team->logo) }}" alt="" class="logo">
                    </div>
                </div>
                <br>
                <br>
                <div class=" text-white modal-body-estilo">
                    <h1>¿Are you sure you want to delete this team?</h1>
                    <p>{{$team->name}}</p>
                    <p>Country: {{ $team->country }}</p>
                </div>
            </div>
            <br>
            <br>
            <div class="modal-footer modal-footer-estilo">
                <button type="button" class="btn btn-outline-danger btn-blanco" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.teams.delete', ['team' => $team->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-blanco">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
