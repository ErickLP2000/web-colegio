<?php 
require_once 'includes/header.php';
require_once 'includes/modals/modal_materia.php'
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Lista de materias</h1>
          <button class="btn btn-primary" type="button" onclick="openModalMateria()" style="margin-top: 20px;">Nueva Materia</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de materias</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table hover table-responsive table-bordered" id="tableMaterias">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
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