<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/<?= $_SESSION['apoderado_id'] ?>.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre_apoderado'] ?></p>
          <p class="app-sidebar__user-designation">Apoderado</p>
          
        </div>
      </div>
      <ul class="app-menu">
      <li><a class="app-menu__item" href="asistenciaalumno.php"><i class="app-menu__icon fa-solid fa-calendar-days"></i><span class="app-menu__label">Ver Asistencias</span></a></li>
      <li><a class="app-menu__item" href="ver_evaluaciones.php"><i class="app-menu__icon fa-solid fa-briefcase"></i><span class="app-menu__label">Ver Tareas</span></a></li>
        <li><a class="app-menu__item" href="ver_notas.php"><i class="app-menu__icon fa-solid fa-hashtag"></i><span class="app-menu__label">Ver Notas Tareas</span></a></li>
        <li><a class="app-menu__item" href="reportes.php"><i class="app-menu__icon fa-solid fa-circle-exclamation"></i><span class="app-menu__label">Reportes</span></a></li>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>