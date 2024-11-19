<?php 
if(!empty($_GET['curso'])){
    $curso = $_GET['curso'];
}else{
    header("location: profesor/");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM profesor_alumno as pa INNER JOIN profesor_grado as pg ON pa.pg_id = pg.pg_id INNER JOIN alumnos as a ON pa.alumno_id = a.alumno_id WHERE pg.pg_id = $curso";
$query = $pdo->prepare($sql);
$query -> execute();
$row = $query ->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Lista de alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de alumnos</a></li>
        </ul>
      </div>
      <div class="row">
      
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table hover table-responsive table-bordered" id="tableAlumnos">
                  <thead>
                    <tr>
                      <th>ALUMNO</th>
                      <th>DOCUMENTO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($row > 0) {
                        while ($data = $query->fetch()) { 
                            ?>
                        <tr>
                            <th><?= $data['nombre_alumno']; ?></th>
                            <th><?= $data['documento']; ?></th>
                        </tr>
                    </tr>
                    <?php } 
                        } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <a href="index.php" class="btn btn-info"><< Volver Atrás</a>
      </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>