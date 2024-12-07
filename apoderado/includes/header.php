<?php
    session_start();
    if(empty($_SESSION['activeApoderado'])){
        header('Location: ./');
       
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="sistema escolar">
    <title>SISTEMA ESCOLAR</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="../assets/images/insignia.png">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <link rel="stylesheet" type="text/css" href="css/styleapode.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist[_{{{CITATION{{{_1{](https://github.com/DeVMohammedEssam/Audiolib/tree/244dfdc9d6d81a4c5ee9baf84e32fc2c94a27617/src%2Fcomponents%2Flayout%2FConfirmationModal.js)[_{{{CITATION{{{_2{](https://github.com/Mugen76600/tattoo-stories/tree/5aa5ca41305c3de4e1bd0e7bda8285bb93938043/Views%2FupdateStory.php)[_{{{CITATION{{{_3{](https://github.com/monirjhossain/lara_blog/tree/f913ef56ef93b8e551f9361f75127b01d80873ba/public%2Fbackend%2Fvendors%2Fbootstrap%2Fsite%2Fdocs%2F4.1%2Fcomponents%2Fmodal.md)[_{{{CITATION{{{_4{](https://github.com/maazarshad9/crm/tree/083e0e97067089ffe1493e2b7b26202010ffc63a/resources%2Fviews%2Fprojects%2Fpartials%2Fconfirmation.blade.php)[_{{{CITATION{{{_5{](https://github.com/vikrysurya24/perpustakaan/tree/ec861312a2c2e3f9ad8a650f30fffd35044be8a6/resources%2Fviews%2Fadmin%2Fpengarang%2Fpengarang.blade.php)" >

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/plugins/sweetalert2.min.js"></script>
     

</head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Virgen de Guadalupe</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars fa-lg"></i></a>
      
    </header>
<?php include_once 'nav.php'; ?>