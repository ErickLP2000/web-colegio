<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idprofesor = $_POST['idprofesor'];

    // Verificar si el profesor existe antes de eliminar
    $sql_check = "SELECT * FROM profesor WHERE profesor_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idprofesor));
    $profesor = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($profesor) {
        // Eliminar el profesor de la base de datos
        $sql = "DELETE FROM profesor WHERE profesor_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idprofesor));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Profesor eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Profesor no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
