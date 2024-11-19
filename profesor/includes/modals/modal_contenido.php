<div class="modal fade" id="modalContenido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo Contenido</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formContenido" name="formContenido" enctype="multipart/form-data">
            <input type="hidden" name="idcontenido" id="idcontenido" value="">
            <input type="hidden" name="idcurso" id="idcurso" value="<?= $curso; ?>">
            <div class="mb-3">
                <label for="control-label">Título del Contenido:</label>
                <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            <div class="mb-3">
                <label for="control-label">Descripción del Contenido:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="control-label">Adjuntar Material:</label>
                <input type="file" class="form-control" name="file" id="file">
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