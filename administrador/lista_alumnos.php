<?php 
require_once 'includes/header.php';
require_once 'includes/modals/modal_alumno.php'
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Lista de alumnos</h1>
          <button class="btn btn-primary" type="button" onclick="openModalAlumno()" style="margin-top: 20px;">Nuevo Alumno</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de alumnos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table hover table-bordered" id="tableAlumnos">
                  <thead>
                    <tr>
                      <th >ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>EDAD</th>
                      <th>DIRECCION</th>
                      <th>DOCUMENTO</th>
                      <th>APODERADO</th>
                      <th>FECHA NAC.</th>
                      <th>FECHA REGISTRO</th>
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