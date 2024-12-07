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
    <link rel="icon" type="image/png" href="assets/images/insignia.png">
    <title>Ingreso al Sistema</title>
</head>
<body>
<header class="main-header">
    <div class="main-cont">
        <!-- Contenedor dividido en dos partes -->
        <div class="half-section image-section" id="imageSection">
            <!-- Imagen para Profesor -->
            <img src="images/profe.webp" alt="Imagen Profesor" class="profesor-image">
            <!-- Imagen para Administrador -->
            <img src="images/admin.webp" alt="Imagen Administrador" class="admin-image">
            <p class="institucion-text">Institución Educativa 5010 Virgen de Guadalupe</p>
        </div>
        <div class="half-section form-section" id="formSection">
            <!-- Vista para profesores -->
            <div id="profesorView" class="view active-view">
                <h1>Bienvenid@ Profesor</h1>
                <form id="profesorForm" class="form">
                    <label for="usuarioProfesor">Ingresar Usuario</label>
                    <input type="text" name="usuarioProfesor" id="usuarioProfesor" placeholder="Nombre de usuario">
                    <label for="passwordProfesor">Ingresar Contraseña</label>
                    <input type="password" name="passProfesor" id="passProfesor" placeholder="Contraseña">
                    <div id="messageProfesor" class="form-message"></div>
                    <button id="loginProfesor" type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
                    <a href="indexprincipal.php" class="return-link">← Regresar a la página principal</a>
                </form>
            </div>
            <!-- Vista para administrador -->
            <div id="adminView" class="view">
                <h1>Bienvenid@ Administrador</h1>
                <form id="adminForm" class="form">
                    <label for="usuario">Ingresar Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                    <label for="password">Ingresar Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Contraseña">
                    <div id="messageUsuario" class="form-message"></div>
                    <button id="loginUsuario" type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
                    <a href="indexprincipal.php" class="return-link">← Regresar a la página principal</a>
                </form>
            </div>
        </div>
        
    </div>
    <button class="switch-btn" id="switchView">⇄</button>
</header>

       
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/script.js"></script>
    <script src="js/estilologin.js"></script>
</body>
</html>