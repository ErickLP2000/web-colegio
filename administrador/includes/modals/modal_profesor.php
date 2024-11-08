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
            <input type="text" class="form-control" name="nombre" id="nombre" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Cédula:</label>
            <input type="text" class="form-control" name="cedula" id="cedula" autocomplete="username" required>
          </div>
            <div class="mb-3">
            <label for="control-label">Contraseña:</label>
            <input type="password" class="form-control" name="clave" id="clave" minlength="6" autocomplete="current-password">
            </div>
          <div class="mb-3">
            <label for="control-label">Telefono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" pattern="^[0-9]+$" title="Solo se permiten números" required>
          </div>
          <div class="mb-3">
            <label for="control-label">Correo:</label>
            <input type="email" class="form-control" name="correo" id="correo" required>
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