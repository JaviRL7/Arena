<div class="modal fade" id="deleteModal{{ $serie->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $serie->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="deleteModalLabel{{ $serie->id }}" style="color: #495057;">Delete Series</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; text-align: center;">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}" class="team-logo mr-3" style="max-width: 80px; height: auto;">
                    <p class="subtitular mr-3">vs</p>
                    <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}" class="team-logo mr-3" style="max-width: 80px; height: auto;">
                </div>
                <p class="subtitular">
                    <strong>Result:</strong> {{ $serie->getResultSerie() }}
                </p>
                <p class="subtitular">
                    Are you sure you want to delete the series between <strong>{{ $serie->team_1->name }}</strong> and <strong>{{ $serie->team_2->name }}</strong>?
                </p>
            </div>
            <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef;">
                <button type="button" class="btn btn-boton7" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.series.delete', ['serie' => $serie]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-boton8">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
