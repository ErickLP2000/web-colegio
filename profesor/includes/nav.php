<?php 
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM profesor_grado as pg INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN aulas as a ON pg.aula_id = a.aula_id INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id INNER JOIN materias as m ON pg.materia_id = m.materia_id WHERE pg.estadopg !=0 AND pg.profesor_id = $idprofesor";
$query = $pdo->prepare($sql);
$query -> execute();
$row = $query ->rowCount();

$sqln = "SELECT * FROM profesor_grado as pg INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN aulas as a ON pg.aula_id = a.aula_id INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id INNER JOIN materias as m ON pg.materia_id = m.materia_id WHERE pg.estadopg !=0 AND pg.profesor_id = $idprofesor";
$queryn = $pdo->prepare($sql);
$queryn -> execute();
$rown = $query ->rowCount();
?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre'] ?></p>
          <p class="app-sidebar__user-designation">Docente</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa-solid fa-house"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa-solid fa-laptop"></i>
            <span class="app-menu__label">Mis Cursos</span>
          </a>
          <ul class="treeview-menu">
          <?php if ($row > 0) {
            while ($data = $query->fetch()) { 
            ?>
            <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pg_id'] ?>"><i class="app-menu__icon fa-solid fa-book"></i><?= $data['nombre_materia'] ?> - <?= $data['nombre_grado'] ?> - <?= $data['nombre_aula'] ?></a></li>
            <?php } } ?>
          </ul>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa-solid fa-check-to-slot"></i>
            <span class="app-menu__label">Calificaciones</span>
          </a>
          <ul class="treeview-menu">
          <?php if ($rown > 0) {
            while ($datan = $queryn->fetch()) { 
            ?>
            <li><a class="treeview-item" href="notas.php?curso=<?= $datan['pg_id'] ?>"><i class="app-menu__icon fa-solid fa-book"></i><?= $datan['nombre_materia'] ?> - <?= $datan['nombre_grado'] ?> - <?= $datan['nombre_aula'] ?></a></li>
            <?php } } ?>
          </ul>
        </li>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>