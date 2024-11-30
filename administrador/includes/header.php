<?php
    session_start();
    if(empty($_SESSION['active'])){
        header('Location: ./');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="sistema escolar">
    <title>Sistema Escolar</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../assets/images/insignia.png">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
    <script src="../js/plugins/sweetalert2.min.js"></script>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Virgen de Guadalupe</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars fa-lg"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Buscar">
          <button class="app-search__button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="fas fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Configuración</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
<?php include_once 'nav.php'; ?>