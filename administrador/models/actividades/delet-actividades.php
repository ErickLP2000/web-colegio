<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idactividad = $_POST['idactividad'];

    // Verificar si la actividad existe antes de eliminar
    $sql_check = "SELECT * FROM actividad WHERE actividad_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idactividad));
    $actividad = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($actividad) {
        // Eliminar la actividad de la base de datos
        $sql = "DELETE FROM actividad WHERE actividad_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idactividad));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Actividad eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Actividad no encontrada');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
