<?php 
if(!empty($_GET['curso'])){
    $curso = $_GET['curso'];
}else{
    header("location: profesor/");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once 'includes/modals/modal_contenido.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM contenidos as c INNER JOIN profesor_grado as pg ON pg.pg_id = c.pg_id WHERE pg.pg_id = $curso";
$query = $pdo->prepare($sql);
$query -> execute();
$row = $query ->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Contenidos a Evaluar</h1>
          <button class="btn btn-primary" type="button" onclick="openModalContenido()" style="margin-top: 20px;">Nuevo Contenido</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">Contenidos a Evaluar</a></li>
        </ul>
      </div>
      <div class="row">
      <?php if ($row > 0) {
        while ($data = $query->fetch()) { ?>
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="title-title-w-btn">
                <h3 class="title"><?= $data['nombre_contenido'] ?></h3>
                <p class="col text-end">
                    <button class="btn btn-info icon-btn" onclick="editarContenido(<?= $data['contenido_id']; ?>)"><i class="fa-solid fa-pen-to-square"></i> Editar Contenido</button> 
                    <button class="btn btn-danger icon-btn" onclick="eliminarContenido(<?= $data['contenido_id']; ?>)"><i class="fa-solid fa-trash"></i> Eliminar Contenido</button> 
                    <button class="btn btn-warning icon-btn" href="evaluacion.php?curso=<?= $data['pg_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa-solid fa-list"></i> Asignar Evaluación</button>
                </p>
              </div>
              <div class="title-body">
                <b><?= $data['descripcion']; ?></b>
              </div>
              <div class="title-footer mt-4">
                <div class="input-group">
                    <div class="input-group">
                        <div class="input-group-text">
                          <i class="fa-solid fa-download"></i>
                        </div>
                        <a class="btn btn-primary <?= empty($data['material']) ? 'disabled' : ''; ?>" href="<?= !empty($data['material']) ? 'profesor/profesor/' . $data['material'] : '#'; ?>" target="_blank">
                          Material de Descarga
                        </a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } 
      } ?>
      </div>
      <div class="">
        <a href="index.php" class="btn btn-info text-white"><< Volver Atrás</a>
      </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>