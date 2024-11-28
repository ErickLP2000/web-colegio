<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idmateria = $_POST['idmateria'];

    // Verificar si la materia existe antes de eliminar
    $sql_check = "SELECT * FROM materias WHERE materia_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idmateria));
    $materia = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($materia) {
        // Eliminar la materia de la base de datos
        $sql = "DELETE FROM materias WHERE materia_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idmateria));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Materia eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Materia no encontrada');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
