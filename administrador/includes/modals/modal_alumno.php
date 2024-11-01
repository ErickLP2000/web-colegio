<div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo profesor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAlumno" name="formAlumno">
          <input type="hidden" name="idalumno" id="idalumno" value="">
          <div class="mb-3">
            <label for="control-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <div class="mb-3">
            <label for="control-label">Edad:</label>
            <input type="text" class="form-control" name="edad" id="edad">
          </div>
          <div class="mb-3">
            <label for="control-label">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
          <div class="mb-3">
            <label for="control-label">Cédula:</label>
            <input type="text" class="form-control" name="cedula" id="cedula" autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="control-label">Telefono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono">
          </div>
          <div class="mb-3">
            <label for="control-label">Correo:</label>
            <input type="text" class="form-control" name="correo" id="correo">
          </div>
          <div class="mb-3">
            <label for="control-label">Fecha de nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
          </div>
          <div class="mb-3">
            <label for="control-label">Fecha de registro:</label>
            <input type="date" class="form-control" name="fecha_reg" id="fecha_reg">
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