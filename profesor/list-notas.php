<?php 
if(!empty($_GET['curso']) && !empty($_GET['alumno'])){
    $curso = $_GET['curso'];
    $alumno = $_GET['alumno'];
}else{
    header("location: profesor/");
    exit; // Asegúrate de salir del script después del redireccionamiento
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once 'includes/funciones.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM notas as n 
        INNER JOIN ev_entregadas as eve ON n.ev_entregada_id = eve.ev_entregada_id 
        INNER JOIN alumnos as a ON eve.alumno_id = a.alumno_id 
        INNER JOIN evaluaciones as ev ON eve.evaluacion_id = ev.evaluacion_id 
        INNER JOIN contenidos as c ON ev.contenido_id = c.contenido_id 
        INNER JOIN profesor_grado as pg ON c.pg_id = pg.pg_id 
        WHERE a.alumno_id = ? AND pg.pg_id = ?";
$query = $pdo->prepare($sql);
$query->execute(array($alumno, $curso));
$row = $query->rowCount();
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
                                <tr>Evaluacion</tr>
                                <tr>Nota</tr>
                            </thead>
                            <tbody>
                                <?php if($row>0){
                                    while($data = $query->fetch()){
                                ?>
                                <tr>
                                    <td><?= $data['nombre_evaluacion']; ?></td>
                                    <td><?= $data['valor_nota']; ?></td>
                                </tr>
                            <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
                <ul class="list-group">
                    <li class="list-group-item"><span class="tag tag-default tag-pill float-xs-right"><strong>PROMEDIO: <?= formato(promedio($alumno)); ?></strong></span></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="mt-3">
        <a href="index.php" class="btn btn-info"><< Volver Atrás</a>
      </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>  