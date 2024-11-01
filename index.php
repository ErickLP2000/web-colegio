<?php
    session_start();
    if(!empty($_SESSION['active'])){
        header('Location: administrador/');
    } else if(!empty($_SESSION['activeP'])){
        header('Location: profesor/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>INGRESO AL SISTEMA</title>
</head>
<body>
    <header class="main-header">
        <div class="main-cont">
            <div class="desc-header">
                <img src="images/school.svg" alt="image school">    
                <p>School</p>
            </div>
        </div>   
        <div class="cont-header">
            <h1>Bienvenid@</h1>
            <div class="form">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Adminstrador</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profesor</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="" onsubmit="return validar()">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                            <label for="password">Contraseña</label>
                            <input type="password" name="pass" id="pass" placeholder="Contraseña">
                            <div id="messageUsuario"></div>
                            <button id="loginUsuario" type="button">INICIAR SESION</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="" onsubmit="return validar()">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuarioProfesor" id="usuarioProfesor" placeholder="Nombre de usuario">
                            <label for="password">Contraseña</label>
                            <input type="password" name="passProfesor" id="passProfesor" placeholder="Contraseña">
                            <div id="messageProfesor"></div>
                            <button id="loginProfesor" type="button">INICIAR SESION</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
        
    </header>

       
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/script.js"></script>
</body>
</html>