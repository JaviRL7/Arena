<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar perfil</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!--Div para la user_header_photo-->
                <div
                    style="width: 100%; height: 200px; background-image: url('{{ asset(Auth::user()->user_header_photo) }}'); background-size: cover; background-position:center;">
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <!--Imagen de user_photo-->
                    <br>
                    <br>
                    <div class="mb-3 modal_user_photo">
                        <!-- Contenedor de la foto de perfil -->
                        <div>
                            <img src="{{ asset(Auth::user()->user_photo) }}" alt="Foto de perfil"
                                class="modal-user-photo">
                            <!-- Nueva imagen de add_photo.png -->
                            <label for="user_photo" class="form-label">
                                <img src="{{ asset('icons/add_photo.png') }}" alt="Agregar foto" class="add-photo-icon">
                            </label>
                        </div>
                        <!-- Input para user_photo -->
                        <input type="file" class="form-control visually-hidden" id="user_photo" name="user_photo">
                    </div>


                    <!--Imagen de user_header_photo-->
                    <div class="mb-3 position-relative">
                        <label for="user_header_photo" class="form-label position-absolute top-0 end-0">
                            <!--Imagen de edit-->

                            <input type="file" class="form-control visually-hidden" id="user_header_photo"
                                name="user_header_photo">
                        </label>
                    </div>

                    <!-- Nuevos campos de entrada -->
                    <div class="mb-3">
                        <label for="name" class="name-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="nick" class="name-label">Nick</label>
                        <input type="text" class="form-control" id="nick" name="nick"
                            value="{{ Auth::user()->nick }}">
                    </div>
                    <div class="mb-3">
                        <label for="birth_date" class="name-label">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date"
                            value="{{ Auth::user()->birth_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="discord" class="name-label">Discord Account</label>
                        <input type="text" class="form-control" id="discord" name="discord"
                            value="{{ Auth::user()->discord }}">
                    </div>
                    <div class="mb-3">
                        <label for="twitter" class="name-label">Twitter Account</label>
                        <input type="text" class="form-control" id="twitter" name="twitter"
                            value="{{ Auth::user()->twitter}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
