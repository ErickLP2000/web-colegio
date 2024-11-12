<?php 
require_once 'includes/header.php';
require_once 'includes/modals/modal_apoderado.php'
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Lista de apoderados</h1>
          <button class="btn btn-primary" type="button" onclick="openModalApoderado()" style="margin-top: 20px;">Nuevo Apoderado</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de apoderados</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table hover table-responsive table-bordered" id="tableApoderados">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>DIRECCION</th>
                      <th>DOCUMENTO</th>
                      <th>TELEFONO</th>
                      <th>CORREO</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>