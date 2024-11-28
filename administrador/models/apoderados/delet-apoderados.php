<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idapoderado = $_POST['idapoderado'];

    // Verificar si el apoderado existe antes de eliminar
    $sql_check = "SELECT * FROM apoderado WHERE apoderado_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idapoderado));
    $apoderado = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($apoderado) {
        // Eliminar el apoderado de la base de datos
        $sql = "DELETE FROM apoderado WHERE apoderado_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idapoderado));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Apoderado eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Apoderado no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
