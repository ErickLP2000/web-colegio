<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idusuario = $_POST['idusuario'];

    // Verificar si el usuario existe antes de eliminar
    $sql_check = "SELECT * FROM usuarios WHERE usuario_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idusuario));
    $user = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Eliminar el usuario de la base de datos
        $sql = "DELETE FROM usuarios WHERE usuario_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idusuario));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Usuario eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Usuario no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
