<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idperiodo = $_POST['idperiodo'];

    // Verificar si el periodo existe antes de eliminar
    $sql_check = "SELECT * FROM periodos WHERE periodo_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idperiodo));
    $periodo = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($periodo) {
        // Eliminar el periodo de la base de datos
        $sql = "DELETE FROM periodos WHERE periodo_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idperiodo));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Periodo eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Periodo no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
