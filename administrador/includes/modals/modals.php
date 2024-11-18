
<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario">
          <input type="hidden" name="idusuario" id="idusuario" value="">
          <div class="mb-3">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="El nombre solo puede contener letras y espacios" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Usuario:</label>
            <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="username" required>
          </div>
            <div class="mb-3">
            <label for="control-label">Contraseña:</label>
            <div class="input-group">
              <input type="password" class="form-control" name="clave" id="clave" minlength="6"  autocomplete="current-password">
              <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                <i class="fa-regular fa-eye"></i>
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label for="listRol">Rol:</label>
                <select class="form-control" name="listRol" id="listRol">
                    <option value="1">Administrador</option>
                    <option value="2">Asistente</option>
                </select>
          </div>
          <div class="mb-3">
                <label for="listEstado">Estado:</label>
                <select class="form-control" name="listEstado" id="listEstado">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" id="action" type="submit">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>