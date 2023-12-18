<div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarPerfilModalLabel">Editar perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nick">Nick</label>
              <input type="text" class="form-control" id="nick" placeholder="Ingresa tu nick">
            </div>
            <div class="form-group">
              <label for="birth_date">Fecha de nacimiento</label>
              <input type="date" class="form-control" id="birth_date">
            </div>
            <div class="form-group">
              <label for="user_photo">Foto de perfil</label>
              <input type="file" class="form-control-file" id="user_photo">
            </div>
            <div class="form-group">
              <label for="header_photo">Foto de encabezado</label>
              <input type="file" class="form-control-file" id="header_photo">
            </div>
            <div class="form-group">
              <label for="biography">Biografía</label>
              <textarea class="form-control" id="biography" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
