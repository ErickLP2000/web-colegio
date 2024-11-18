<div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo profesor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProfesor" name="formProfesor">
          <input type="hidden" name="idprofesor" id="idprofesor" value="">
          <div class="mb-3">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="El nombre solo puede contener letras y espacios" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Documento:</label>
            <input type="text" class="form-control" name="cedula" id="cedula" autocomplete="username" pattern="^[A-Za-z0-9Ññ]{7,12}$" title="El documento debe tener entre 7 y 12 caracteres" required>
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
            <label for="control-label">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" pattern="^\d{7,15}$" 
            title="El teléfono debe contener entre 7 y 15 dígitos." required>
          </div>
          <div class="mb-3">
            <label for="control-label">Correo:</label>
            <input type="text" class="form-control" name="correo" id="correo" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$|^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-zÑñ]{2,}$" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Nivel de estudio:</label>
            <input type="text" class="form-control" name="nivel_est" id="nivel_est" required>
          </div>
            <div class="mb-3">
                <label for="listEstado">Estado:</label>
                <select class="form-control" name="listEstado" id="listEstado" required>
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