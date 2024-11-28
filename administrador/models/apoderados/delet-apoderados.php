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
        // Verificar si el apoderado tiene alumnos asignados
        $sql_alumnos_check = "SELECT COUNT(*) as total FROM alumnos WHERE apoderado_id = ?";
        $query_alumnos_check = $pdo->prepare($sql_alumnos_check);
        $query_alumnos_check->execute(array($idapoderado));
        $alumnos_asignados = $query_alumnos_check->fetch(PDO::FETCH_ASSOC);

        if ($alumnos_asignados['total'] > 0) {
            // Si tiene alumnos asignados, no permitir la eliminación
            $respuesta = array('status' => false, 'msg' => 'El apoderado tiene alumnos asignados');
        } else {
            // Si no tiene alumnos asignados, proceder a la eliminación
            $sql = "DELETE FROM apoderado WHERE apoderado_id = ?";
            $query = $pdo->prepare($sql);
            $result = $query->execute(array($idapoderado));

            if ($result) {
                $respuesta = array('status' => true, 'msg' => 'Apoderado eliminado correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
            }
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Apoderado no encontrado');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
