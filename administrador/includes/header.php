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
      
    </header>
<?php include_once 'nav.php'; ?>