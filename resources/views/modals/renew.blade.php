<div class="modal fade" id="renewModal{{ $player->id }}" tabindex="-1" role="dialog"
    aria-labelledby="renewModalLabel{{ $player->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="renewModalLabel{{ $player->id }}">Renew {{ $player->nick }}'s Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <h2 class="titular text-center">Until what year are you going to renew {{ $player->nick }}'s contract?</h2>
                <form action="{{ route('admin.teams.renewContract', ['team' => $team->id, 'player' => $player->id]) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="new_year" class="form-label comentarios">New contract expiration year:</label>
                        <input type="number" id="new_year" name="new_year" min="{{ date('Y') }}" max="2099" class="form-control form-control-sm text-dark" value="{{ date('Y') }}" required>
                    </div>
                    <div class="form-group">
                        <span class="comentarios">Do you want to enter an exact date?</span>
                        <button style="margin: 0%; margin-left:5px" type="button" id="showDateInput" class="btn btn-boton6 mb-2">Add</button>
                    </div>
                    <div id="exactDateInput" class="form-group" style="display: none;">
                        <label for="new_date" class="form-label comentarios">Exact new contract expiration date:</label>
                        <input type="date" id="new_date" name="new_date" class="form-control form-control-sm text-dark">
                    </div>

                    <script>
                    document.getElementById('showDateInput').addEventListener('click', function() {
                        var exactDateInput = document.getElementById('exactDateInput');
                        var showDateInput = document.getElementById('showDateInput');
                        if (exactDateInput.style.display === 'none') {
                            exactDateInput.style.display = 'block';
                            showDateInput.textContent = 'Close';
                        } else {
                            exactDateInput.style.display = 'none';
                            showDateInput.textContent = 'Add';
                        }
                    });
                    </script>
                    <hr class="custom-hr2">
                    <div class="">
                        <button type="submit" class="btn btn-boton7">Renew Contract</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
