<?php
session_start();
if (!empty($_SESSION['activeApoderado'])) {
    header('Location: apoderado/');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="assets/images/insignia.png">
    <title>Ingreso Apoderados</title>
</head>
<body>
    <header class="main-header">
    <div class="main-cont">
        <!-- Contenedor dividido en dos partes -->
        <div class="half-section image-section" id="imageSection">
            <!-- Imagen para Profesor -->
            <img src="images/alum.webp" alt="Imagen Profesor" class="profesor-image">
            <p class="institucion-text">Institución Educativa 5010 Virgen de Guadalupe</p>
        </div>
        <div class="half-section form-section" id="formSection">
            <div id="profesorView" class="view active-view">
                <h1>Bienvenid@</h1>
                <form class="form" id="apoderadoForm">
                    <label for="usuario">Ingresar Usuario</label>
                    <input type="text" name="usuarioApoderado" id="usuarioApoderado" placeholder="Correo Electrónico del Apoderado">
                    <label for="password">Ingresar Contraseña</label>
                    <input type="password" name="passApoderado" id="passApoderado" placeholder="Contraseña">
                    <div id="messageApoderado" class="form-message"></div>
                    <button id="loginApoderado" type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
                    <a href="indexprincipal.php" class="return-link">← Regresar a la página principal</a>
                </form>
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
