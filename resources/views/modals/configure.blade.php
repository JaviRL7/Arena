<div class="modal fade modal-configura" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update email and password</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body-configure">
                <form id="updateForm" method="POST" action="{{ route('profile.configure') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="email">New email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="current_password">Actual password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            autocomplete="new-password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="updateForm" class="btn btn-boton7">Save changes</button>
                <button type="button" class="btn btn-boton8" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
