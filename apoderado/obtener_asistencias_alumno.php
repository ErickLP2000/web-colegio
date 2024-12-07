<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/conexion.php';

if (!isset($_SESSION['apoderado_id'])) {
    echo json_encode(['error' => 'Sesión no válida']);
    exit;
}

$apoderado_id = $_SESSION['apoderado_id'];

if (isset($_GET['alumno_id']) && isset($_GET['fecha'])) {
    $alumno_id = $_GET['alumno_id'];
    $fecha = $_GET['fecha'];

    try {
        $sql = "SELECT a.nombre_alumno, asis.fecha, asis.estado, p.nombre AS nombre_docente 
                FROM asistencias asis
                JOIN alumnos a ON asis.alumno_id = a.alumno_id
                JOIN profesor p ON asis.profesor_id = p.profesor_id
                WHERE a.alumno_id = :alumno_id 
                  AND a.apoderado_id = :apoderado_id 
                  AND asis.fecha = :fecha";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':alumno_id' => $alumno_id, 
            ':apoderado_id' => $apoderado_id, 
            ':fecha' => $fecha
        ]);
        $asistencias = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($asistencias);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>
