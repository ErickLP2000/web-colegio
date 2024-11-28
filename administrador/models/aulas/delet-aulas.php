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
        // Verificar si el aula tiene grados asignados
        $sql_grados_check = "SELECT COUNT(*) as total FROM profesor_grado WHERE aula_id = ?";
        $query_grados_check = $pdo->prepare($sql_grados_check);
        $query_grados_check->execute(array($idaula));
        $grados_asignados = $query_grados_check->fetch(PDO::FETCH_ASSOC);

        if ($grados_asignados['total'] > 0) {
            // Si tiene grados asignados, no permitir la eliminación
            $respuesta = array('status' => false, 'msg' => 'El aula tiene grados asignados');
        } else {
            // Eliminar el aula de la base de datos
            $sql = "DELETE FROM aulas WHERE aula_id = ?";
            $query = $pdo->prepare($sql);
            $result = $query->execute(array($idaula));

            if ($result) {
                $respuesta = array('status' => true, 'msg' => 'Aula eliminada correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
            }
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Aula no encontrada');
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
