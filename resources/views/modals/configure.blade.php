<div class="modal fade modal-configura" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titular">Update email and password</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"></button>
            </div>
            <div class="text-center mt-3">
                <i class="fas fa-cog fa-3x text-secondary"></i> <!-- Icono más grande y más abajo -->
            </div>

            <div class="modal-body-configure">
                <form id="updateForm" method="POST" action="{{ route('profile.configure') }}">
                    @csrf
                    @method('POST')

                    <div class="form-group mb-3">
                        <label for="email" class="comentarios">New email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                        <div id="emailError" class="text-danger"></div> <!-- Mensaje de error para el correo electrónico -->
                    </div>
                    <div class="form-group mb-3">
                        <label for="current_password" class="comentarios">Actual password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="comentarios">New password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            autocomplete="new-password">
                        <div id="passwordError" class="text-danger"></div> <!-- Mensaje de error para la contraseña -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="updateForm" class="btn btn-boton7">Save</button>
                <button type="button" class="btn btn-boton8" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('updateForm').addEventListener('submit', function(e) {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Validación de correo electrónico
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').textContent = 'Please enter a valid email address.';
            e.preventDefault();
            return;
        } else {
            document.getElementById('emailError').textContent = '';
        }

        // Validación de contraseña
        if (password.length < 8) {
            document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long.';
            e.preventDefault();
            return;
        } else {
            document.getElementById('passwordError').textContent = '';
        }
    });
</script>
