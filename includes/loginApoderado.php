<?php
session_start();
if (!empty($_POST)) {
    if (empty($_POST['loginApoderado']) || empty($_POST['passApoderado'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php';
        $login = $_POST['loginApoderado'];
        $pass = $_POST['passApoderado'];

        $sql = 'SELECT * FROM apoderado WHERE correo = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($query->rowCount() > 0) {
            if (password_verify($pass, $result['clave'])) {
                $_SESSION['activeApoderado'] = true;
                $_SESSION['apoderado_id'] = $result['apoderado_id'];
                $_SESSION['nombre_apoderado'] = $result['nombre_apoderado'];
                $_SESSION['correo'] = $result['correo'];

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirigiendo</div>';
            } else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o clave incorrecto</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o clave incorrecto</div>';
        }
    }
}
?>
