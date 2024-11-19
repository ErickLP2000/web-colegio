<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM profesor_grado as pg INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN aulas as a ON pg.aula_id = a.aula_id INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id INNER JOIN materias as m ON pg.materia_id = m.materia_id WHERE pg.estadopg !=0 AND pg.profesor_id = $idprofesor";
$query = $pdo->prepare($sql);
$query -> execute();
$row = $query ->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-gauge-high"></i>  Cursos Respectivos</h1> 
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">Principal</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Sistema Escolar - Virgen de Guadalupe</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h4>Mis cursos</h4>
        </div>
      </div>
    <div class="container"> 
    <div class="row">
      <?php if ($row > 0) {
        while ($data = $query->fetch()) { ?>
          <div class="col-md-4 text-center bordered mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 100%;">
              <img src="images/curso.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title text-center"><?= $data['nombre_materia'] ?></h5>
                <p class="card-text">Grado: <kbd class="bg-info"><?= $data['nombre_grado'] ?></kbd> - Aula: <kbd class="bg-info"><?= $data['nombre_aula'] ?></kbd></p>
                <a href="contenido.php?curso=<?= $data['pg_id'] ?>" class="btn btn-primary">Acceder</a>
                <a href="alumnos.php?curso=<?= $data['pg_id'] ?>" class="btn btn-warning">Ver Alumnos</a>
              </div>
            </div>
          </div>
        <?php } 
      } ?>
    </div>
  </div>
</main>

<?php 
require_once 'includes/footer.php';
?>
