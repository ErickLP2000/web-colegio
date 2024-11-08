<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="lista_usuarios.php"><i class="app-menu__icon fa-solid fa-users"></i><span class="app-menu__label">Usuarios</span></a></li>
        <li><a class="app-menu__item" href="lista_profesores.php"><i class="app-menu__icon fa-solid fa-chalkboard-user"></i><span class="app-menu__label">Profesores</span></a></li>
        <li><a class="app-menu__item" href="lista_alumnos.php"><i class="app-menu__icon fa-solid fa-graduation-cap"></i><span class="app-menu__label">Alumnos</span></a></li>
        <li><a class="app-menu__item" href="lista_grados.php"><i class="app-menu__icon fa-solid fa-book"></i><span class="app-menu__label">Grados</span></a></li>
        <li><a class="app-menu__item" href="lista_aulas.php"><i class="app-menu__icon fa-solid fa-book"></i><span class="app-menu__label">Aulas</span></a></li>
        <li><a class="app-menu__item" href="lista_materias.php"><i class="app-menu__icon fa-solid fa-book"></i><span class="app-menu__label">Materias</span></a></li>
        <li><a class="app-menu__item" href="lista_periodos.php"><i class="app-menu__icon fa-solid fa-book"></i></i><span class="app-menu__label">Periodos</span></a></li>
        <li><a class="app-menu__item" href="lista_actividades.php"><i class="app-menu__icon fa-solid fa-book"></i></i><span class="app-menu__label">Actividades</span></a></li>
        <li><a class="app-menu__item" href="lista_profesor_grados.php"><i class="app-menu__icon fa-solid fa-book"></i><span class="app-menu__label">Profesor Grado</span></a></li>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>