<?php 
if(!empty($_GET['curso'])){
    $curso = $_GET['curso'];
}else{
    header("location: profesor/");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['profesor_id'];

$sqlc = "SELECT * FROM profesor_alumno as pa INNER JOIN profesor_grado as pg ON pa.pg_id = pg.pg_id INNER JOIN alumnos as a ON pa.alumno_id = a.alumno_id WHERE pg.profesor_id = $idprofesor AND pg.pg_id=$curso GROUP BY a.alumno_id";
$queryc = $pdo->prepare($sqlc);
$queryc -> execute();
$rowc = $queryc ->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Notas Cargadas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">Contenidos a Evaluar</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="title-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>Alumno</tr>
                                <tr>VER NOTAS</tr>
                            </thead>
                            <tbody>
                                <?php if($rowc>0){
                                    while($data = $queryc->fetch()){
                                ?>
                                <tr>
                                    <td><?= $data['nombre_alumno']; ?></td>
                                    <td><a class="btn btn-primary btn-sm" title="Ver notas" href="list-notas.php?alumno=<?= $data['alumno_id']; ?>&curso=<?= $data['pg_id']; ?>">
                                        <i class="fa-solid fa-list"></i>
                                    </a></td>
                                </tr>
                            <?php }} ?>
                            </tbody>
                        </table>
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