<?php
require_once '../includes/conexion.php';

if (isset($_GET['alumno_id'])) {
    $alumno_id = $_GET['alumno_id'];
    $sql = "SELECT alumno_id, nombre_alumno, edad, direccion, documento, fecha_nac, fecha_registro, estado FROM alumnos WHERE alumno_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$alumno_id]);
    $alumno = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($alumno);
} else {
    echo json_encode([]);
}
?>
