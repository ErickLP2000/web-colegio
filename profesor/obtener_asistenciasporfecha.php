<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/conexion.php';

if (!isset($_SESSION['profesor_id'])) {
    echo json_encode([]);
    exit;
}

$profesor_id = $_SESSION['profesor_id'];

if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];

    $sql = "SELECT a.nombre_alumno, asis.estado, asis.alumno_id, asis.fecha 
            FROM asistencias asis
            INNER JOIN alumnos a ON asis.alumno_id = a.alumno_id
            WHERE asis.fecha = ? AND asis.profesor_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$fecha, $profesor_id]);
    $asistencias = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($asistencias);
} else {
    echo json_encode([]);
}



?>
