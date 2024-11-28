<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idgrado = $_POST['idgrado'];

    // Verificar si el grado existe antes de eliminar
    $sql_check = "SELECT * FROM grados WHERE grado_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idgrado));
    $grado = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($grado) {
        // Eliminar el grado de la base de datos
        $sql = "DELETE FROM grados WHERE grado_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idgrado));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Grado eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Grado no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
