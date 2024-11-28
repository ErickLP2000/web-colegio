<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idalumno = $_POST['idalumno'];

    // Verificar si el alumno existe antes de eliminar
    $sql_check = "SELECT * FROM alumnos WHERE alumno_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idalumno));
    $alumno = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        // Eliminar el alumno de la base de datos
        $sql = "DELETE FROM alumnos WHERE alumno_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idalumno));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Alumno eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Alumno no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
