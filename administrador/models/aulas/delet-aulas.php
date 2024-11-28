<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idaula = $_POST['idaula'];

    // Verificar si el aula existe antes de eliminar
    $sql_check = "SELECT * FROM aulas WHERE aula_id = ?";
    $query_check = $pdo->prepare($sql_check);
    $query_check->execute(array($idaula));
    $aula = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($aula) {
        // Eliminar el aula de la base de datos
        $sql = "DELETE FROM aulas WHERE aula_id = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idaula));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Aula eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Aula no encontrada');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
