<?php 
if(!empty($_GET['curso']) || empty($_GET['contenido'])){
    $curso = $_GET['curso'];
    $contenido =$_GET['contenido'];
}else{
    header("location: profesor/");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once 'includes/modals/modal_evaluacion.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT *,date_format(fecha, '%d,%m,%Y') as fecha FROM evaluaciones WHERE contenido_id = $contenido";
$query = $pdo->prepare($sql);
$query -> execute();
$row = $query ->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Asignar Evaluación</h1>
          <button class="btn btn-primary" type="button" onclick="openModalEvaluacion()" style="margin-top: 20px;">Nueva Evaluación</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">Asignar Evaluación</a></li>
        </ul>
      </div>
      <div class="row">
      <?php if ($row > 0) {
        while ($data = $query->fetch()) { ?>
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="title-title-w-btn">
                <h3 class="title"><?= $data['nombre_evaluacion'] ?></h3>
                <p class="col text-end">
                    <button class="btn btn-info icon-btn" onclick="editarEvaluacion(<?= $data['evaluacion_id']; ?>)"><i class="fa-solid fa-pen-to-square"></i> Editar Evaluación</button> 
                    <button class="btn btn-danger icon-btn" onclick="eliminarEvaluacion(<?= $data['evaluacion_id']; ?>)"><i class="fa-solid fa-trash"></i> Eliminar Evaluación</button> 
                    <a class="btn btn-warning icon-btn" 
                      href="entregas.php?curso=<?= $curso ?>&contenido=<?= $data['contenido_id']; ?>&eva=<?= $data['evaluacion_id']; ?>">
                      <i class="fa-solid fa-list"></i> Asignar Entregas
                    </a>
                </p>
              </div>
              <div class="title-body">
                <b><?= $data['descripcion']; ?></b><br><br>
                <b>Fecha: <kbd><?= $data['fecha']; ?></kbd></b><br><br>
                <b>Valor: <?= $data['porcentaje']; ?></b>
              </div>
            </div>
          </div>
        </div>
        <?php } 
      } ?>
      </div>
      <div class="">
        <a href="contenido.php?curso=<?= $curso ?>" class="btn btn-info text-white"><< Volver Atrás</a>
      </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>