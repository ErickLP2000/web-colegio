<div class="modal fade" id="modalProfesorAlumno" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo profesor alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProfesorAlumno" name="formProfesorAlumno">
          <input type="hidden" name="idprofesoralumno" id="idprofesoralumno" value="">
            <div class="mb-3">
                <label for="listProfesor">Seleccione el Profesor:</label>
                <select class="form-control" name="listAProfesor" id="listAProfesor">
                </select>
            </div>
            <div class="mb-3">
                <label for="listProfesor">Seleccione el Alumno:</label>
                <select class="form-control" name="listAlumno" id="listAlumno">
                </select>
            </div>
            <div class="mb-3">
                <label for="listPeriodo">Seleccione el Periodo:</label>
                <select class="form-control" name="listPeriodo" id="listPeriodo">
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