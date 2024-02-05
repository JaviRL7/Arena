<style>
    .user-header-photo-overlay img,
.user-photo-overlay img {
    width: 100%; /* Esto garantiza que la imagen ocupe el ancho completo del contenedor */
    height: 100%; /* Esto garantiza que la imagen ocupe la altura completa del contenedor */
    object-fit: cover; /* Esto recorta la imagen para cubrir el área sin deformarse */
     /* Esto hará que la imagen de perfil sea redonda */
}
.user-photo-overlay img{
    border-radius: 50%;
}
    .user-header-photo-overlay {
        position: relative;
        height: 200px;

        background-color: #343a40; /* Color de fondo si no hay imagen */
        background-size: cover;
        background-position: center;
    }

    .user-header-photo-overlay .overlay-icon {
        position: absolute;
        bottom: 60px; /* Ajusta según sea necesario */
        right: 360px; /* Ajusta según sea necesario */
        background-color: rgba(0, 0, 0, 0.5); /* Círculo semi-transparente */
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;

        align-items: center;
        justify-content: center;
    }

    .user-photo-overlay .overlay-icon {
        position: absolute;
        top: 250px; /* Ajusta según sea necesario */
        left: 45px; /* Ajusta según sea necesario */
        background-color: rgba(0, 0, 0, 0.5); /* Círculo semi-transparente */
        padding: 10px;
        border-radius: 50%; /* Hace el fondo redondo */
        cursor: pointer;

        align-items: center;
        justify-content: center;
    }

    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
</style>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- User header photo with icon overlay for adding new photo -->
                    <div class="user-header-photo-overlay">
                        <img src="{{ asset(Auth::user()->user_header_photo) }}" alt="Header Photo" style="width: 100%; height: 100%;">
                        <label class="overlay-icon" for="user_header_photo">
                            <i class="fas fa-camera fa-lg text-white"></i>
                            <input type="file" id="user_header_photo" name="user_header_photo" class="visually-hidden" accept="image/*">
                        </label>
                    </div>

                    <!-- User photo with icon overlay for adding new photo -->
                    <div class="user-photo-overlay">
                        <img src="{{ asset(Auth::user()->user_photo) }}" alt="User Photo" class="rounded-circle" style="width: 100px; height: 100px;">
                        <label class="overlay-icon" for="user_photo">
                            <i class="fas fa-camera fa-lg text-white"></i>
                            <input type="file" id="user_photo" name="user_photo" class="visually-hidden" accept="image/*">
                        </label>
                    </div>

                    <!-- Name input -->
                    <div class="mb-3">
                        <label for="name" class="form-label titular">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        <div id="nameError" class="text-danger"></div>
                    </div>

                    <!-- Nick input -->
                    <div class="mb-3">
                        <label for="nick" class="form-label titular">Nick</label>
                        <input type="text" class="form-control" id="nick" name="nick" value="{{ Auth::user()->nick }}">
                        <div id="nickError" class="text-danger"></div>
                    </div>

                    <!-- Bio input -->
                    <div class="mb-3">
                        <label for="bio" class="form-label titular">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" maxlength="150">{{ Auth::user()->bio }}</textarea>
                        <div id="bioError" class="text-danger"></div>
                    </div>

                    <!-- Birthdate input -->
                    <div class="mb-3">
                        <label for="birth_date" class="form-label titular">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') : '' }}">
                    </div>

                    <!-- Discord input -->
                    <div class="mb-3">
                        <label for="discord" class="form-label titular">Discord Account</label>
                        <input type="text" class="form-control" id="discord" name="discord" value="{{ Auth::user()->discord }}">
                    </div>

                    <!-- Twitter input -->
                    <div class="mb-3">
                        <label for="twitter" class="form-label titular">Twitter Account</label>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ Auth::user()->twitter }}">
                    </div>

                    <!-- Modal footer for action buttons -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-boton7">Save</button>
                        <button type="button" class="btn btn-boton8" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('editProfileModal').addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const nick = document.getElementById('nick').value;
        const bio = document.getElementById('bio').value;

        let isValid = true;
        const nameError = document.getElementById('nameError');
        const nickError = document.getElementById('nickError');
        const bioError = document.getElementById('bioError');

        // Validación para el nombre
        if (/[\d]/.test(name)) {
            nameError.textContent = 'Name cannot contain numbers.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        // Validación para el nick
        if (nick.length < 3 || nick.length > 10 || /\s/.test(nick)) {
            nickError.textContent = 'Nick must be between 3 and 10 characters and cannot contain spaces.';
            isValid = false;
        } else {
            nickError.textContent = '';
        }

        // Validación para la bio
        if (/<[a-z][\s\S]*>/i.test(bio)) {
            bioError.textContent = 'Bio cannot contain HTML.';
            isValid = false;
        } else if (bio.length > 150) {
            bioError.textContent = 'Bio cannot be longer than 150 characters.';
            isValid = false;
        } else {
            bioError.textContent = '';
        }

        if (isValid) {
            event.target.submit();
        }
    });
    </script>
