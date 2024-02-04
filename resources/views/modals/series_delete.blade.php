<div class="modal fade modal-delete" id="deleteModal{{ $serie->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $serie->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-estilo">
        <div class="modal-content model-delete-estilo" style="background-color: #e44445;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="deleteModalLabel{{ $serie->id }}">Delete series</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-white">
                <div class="modal-image-container modal-series-photo">
                    <!-- Aquí puedes poner una imagen representativa de la serie si la tienes -->
                </div>
                <div class="text-white modal-body-estilo">
                    <h1>¿Are you sure to delete this series?</h1>
                </div>
            </div>
            <div class="modal-footer modal-footer-estilo">
                <button type="button" class="btn btn-outline-danger btn-blanco" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.series.delete', ['serie' => $serie]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-blanco">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
